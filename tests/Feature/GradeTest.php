<?php

namespace Tests\Feature;

use App\Models\Assignment;
use App\Models\Grade;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GradeTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->teacher1 = User::factory()->create([
            'id' => 1,
            'role_id' => 2,
            'email_verified_at' => now()
        ]);
        $this->teacher2 = User::factory()->create([
            'id' => 2,
            'role_id' => 2,
            'email_verified_at' => now()
        ]);
        $this->teacher3 = User::factory()->create([
            'id' => 3,
            'role_id' => 2,
            'email_verified_at' => now()
        ]);
        $this->admin = User::factory()->create([
            'role_id' => 3,
            'email_verified_at' => now()
        ]);
        $this->student = User::factory()->create([
            'role_id' => 1,
            'email_verified_at' => now()
        ]);

        $this->assignment = Assignment::factory()->create([
            'assignment_name' => 'Test Assignment',
            'assignment_info' => 'Test assignment info'
        ]);

        $this->grade = Grade::factory()->create([
            'assignment_id' => $this->assignment->id,
            'student_id' => $this->student->id,
            'grade' => 7.5,
            'approved' => false,
            'teacher1_id' => null,
            'teacher2_id' => null
        ]);
    }


    public function test_teacher_can_approve_grade_as_first_approver()
    {
        $this->actingAs($this->teacher1);

        $response = $this->post(route('grades.approve', $this->grade->id));

        $response->assertRedirect();
        $response->assertSessionHas('success', 'Item approved!');

        $this->grade->refresh();
        $this->assertEquals($this->teacher1->id, $this->grade->teacher1_id);
        $this->assertNull($this->grade->teacher2_id);
        $this->assertEquals(0, $this->grade->approved);
    }


    public function test_teacher_can_approve_grade_as_second_approver()
    {
        $this->grade->update(['teacher1_id' => $this->teacher1->id]);

        $this->actingAs($this->teacher2);

        $response = $this->post(route('grades.approve', $this->grade->id));

        $response->assertRedirect();
        $response->assertSessionHas('success', 'Item approved!');

        $this->grade->refresh();
        $this->assertEquals($this->teacher1->id, $this->grade->teacher1_id);
        $this->assertEquals($this->teacher2->id, $this->grade->teacher2_id);
        $this->assertEquals(0, $this->grade->approved);
    }

    public function test_teacher_cannot_approve_grade_twice()
    {
        $this->grade->update(['teacher1_id' => $this->teacher1->id]);

        $this->actingAs($this->teacher1);

        $response = $this->post(route('grades.approve', $this->grade->id));

        $response->assertRedirect();
        $response->assertSessionHas('error', 'You have already approved this item.');

        $this->grade->refresh();
        $this->assertEquals($this->teacher1->id, $this->grade->teacher1_id);
        $this->assertNull($this->grade->teacher2_id);
    }

    public function test_teacher_cannot_approve_when_both_slots_are_filled()
    {
        $this->grade->update([
            'teacher1_id' => $this->teacher1->id,
            'teacher2_id' => $this->teacher2->id
        ]);

        $this->actingAs($this->teacher3);

        $response = $this->post(route('grades.approve', $this->grade->id));

        $response->assertRedirect();
        $response->assertSessionHas('error', 'This item has already been approved.');

        $this->grade->refresh();
        $this->assertEquals($this->teacher1->id, $this->grade->teacher1_id);
        $this->assertEquals($this->teacher2->id, $this->grade->teacher2_id);
    }

    public function test_teacher_can_submit_grade_with_two_approvals()
    {
        $this->grade->update([
            'teacher1_id' => $this->teacher1->id,
            'teacher2_id' => $this->teacher2->id
        ]);

        $this->actingAs($this->teacher3);

        $response = $this->post(route('grades.submit', $this->grade->id));

        $response->assertRedirect();
        $response->assertSessionHas('success', 'Item has been submitted!');

        $this->grade->refresh();
        $this->assertEquals(1, $this->grade->approved);
    }

    public function test_teacher_cannot_submit_grade_without_two_approvals()
    {
        $this->grade->update(['teacher1_id' => $this->teacher1->id]);

        $this->actingAs($this->teacher2);

        $response = $this->post(route('grades.submit', $this->grade->id));

        $response->assertRedirect();
        $response->assertSessionHas('error', 'You can only submit once two approvals have been made.');

        $this->grade->refresh();
        $this->assertEquals(0, $this->grade->approved);
    }

    public function test_teacher_cannot_submit_grade_with_no_approvals()
    {
        $this->actingAs($this->teacher1);

        $response = $this->post(route('grades.submit', $this->grade->id));

        $response->assertRedirect();
        $response->assertSessionHas('error', 'You can only submit once two approvals have been made.');

        $this->grade->refresh();
        $this->assertEquals(0, $this->grade->approved);
    }

    public function test_admin_can_submit_grade_with_new_grade_value()
    {
        $this->actingAs($this->admin);

        $newGrade = '8,5';

        $response = $this->post(route('grades.submit', $this->grade->id), [
            'newGrade' => $newGrade
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success', 'Item has been submitted!');

        $this->grade->refresh();
        $this->assertEquals(8.5, $this->grade->grade);
        $this->assertEquals(1, $this->grade->approved);
    }

    public function test_admin_can_submit_grade_with_dot_decimal_separator()
    {
        $this->actingAs($this->admin);

        $newGrade = '9.2';

        $response = $this->post(route('grades.submit', $this->grade->id), [
            'newGrade' => $newGrade
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success', 'Item has been submitted!');

        $this->grade->refresh();
        $this->assertEquals(9.2, $this->grade->grade);
        $this->assertEquals(1, $this->grade->approved);
    }

    public function test_admin_can_submit_grade_without_approvals()
    {
        $this->actingAs($this->admin);

        $response = $this->post(route('grades.submit', $this->grade->id), [
            'newGrade' => '6.5'
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success', 'Item has been submitted!');

        $this->grade->refresh();
        $this->assertEquals(6.5, $this->grade->grade);
        $this->assertEquals(1, $this->grade->approved);
    }

    public function test_unauthenticated_user_cannot_access_approval_routes()
    {
        $response = $this->post(route('grades.approve', $this->grade->id));
        $response->assertRedirect('/login');

        $response = $this->post(route('grades.submit', $this->grade->id));
        $response->assertRedirect('/login');
    }

    public function test_student_cannot_access_approval_routes()
    {
        $this->actingAs($this->student);

        $response = $this->post(route('grades.approve', $this->grade->id));
        $response->assertStatus(403);

        $response = $this->post(route('grades.submit', $this->grade->id));
        $response->assertStatus(403);
    }

    public function test_approval_fills_teacher1_id_when_empty()
    {
        $this->actingAs($this->teacher1);

        $this->post(route('grades.approve', $this->grade->id));

        $this->grade->refresh();
        $this->assertEquals($this->teacher1->id, $this->grade->teacher1_id);
        $this->assertNull($this->grade->teacher2_id);
    }

    public function test_approval_fills_teacher2_id_when_teacher1_id_exists()
    {
        $this->grade->update(['teacher1_id' => $this->teacher1->id]);

        $this->actingAs($this->teacher2);

        $this->post(route('grades.approve', $this->grade->id));

        $this->grade->refresh();
        $this->assertEquals($this->teacher1->id, $this->grade->teacher1_id);
        $this->assertEquals($this->teacher2->id, $this->grade->teacher2_id);
    }

    public function test_grade_with_invalid_new_grade_value_still_gets_approved()
    {
        $this->actingAs($this->admin);

        $response = $this->post(route('grades.submit', $this->grade->id), [
            'newGrade' => ''
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success', 'Item has been submitted!');

        $this->grade->refresh();
        $this->assertEquals(1, $this->grade->approved);
        $this->assertEquals(0, $this->grade->grade);
    }

    public function test_multiple_approvals_workflow_works_correctly()
    {
        $this->actingAs($this->teacher1);
        $this->post(route('grades.approve', $this->grade->id));

        $this->grade->refresh();
        $this->assertEquals(0, $this->grade->approved);
        $this->assertEquals($this->teacher1->id, $this->grade->teacher1_id);

        $this->actingAs($this->teacher2);
        $this->post(route('grades.approve', $this->grade->id));

        $this->grade->refresh();
        $this->assertEquals(0, $this->grade->approved);
        $this->assertEquals($this->teacher2->id, $this->grade->teacher2_id);

        $this->actingAs($this->teacher3);
        $this->post(route('grades.submit', $this->grade->id));

        $this->grade->refresh();
        $this->assertEquals(1, $this->grade->approved);
    }
}
