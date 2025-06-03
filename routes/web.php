<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Http\Controllers\FormStudentViewController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\GradingTemplateList;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GradingTemplateList;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;




Route::middleware(['auth', 'verified'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    Route::get('/', [RoleController::class, 'index'])->name('dashboard');
    Route::post('/grades/{grade}/approve', [ApprovalController::class, 'approve'])->name('grades.approve');
    Route::post('/grades/{grade}/submit', [ApprovalController::class, 'submit'])->name('grades.submit');


    Route::get('/student/subjects/{subject}', [StudentController::class, 'subject'])->name('student.subject');
    Route::get('/student/subjects/{subject}/assignments/{assignment}/download', [StudentController::class, 'download'])->name('student.download.grade');

    Route::get('/teacher/subjects/{subject}', [TeacherController::class, 'subject'])->name('teacher.subject');
    Route::get('/teacher/subjects/{subject}/assignments/new', [TeacherController::class, 'addAssignment'])->name('new.assignment');
    Route::get('/teacher/subjects/{subject}/assignments/{assignment}', [TeacherController::class, 'assignment'])->name('teacher.assignment');
    Route::get('/teacher/subjects/{subject}/students/{student}', [SubjectController::class, 'student'])->name('add.student.subject');
    Route::get('/assignment/add/{subject}', [AssignmentController::class, 'create'])->name('submit.new.assignment');
    Route::get('/assignment/update/{subject}/{assignment}', [AssignmentController::class, 'update'])->name('update.assignment');

    Route::get('/user/{userid}', ['userid'])->name('users.add');

    Route::get('/users/add', [UserController::class, 'add'])->name('users.add');
    Route::post('/users/add', [UserController::class, 'add'])->name('users.add');
    Route::post('/users/save', [UserController::class, 'save'])->name('users.save');

    Route::get('/user/{user}/update', [UserController::class, 'update'])->name('users.update');
    Route::post('/user/{user}/save', [UserController::class, 'save'])->name('users.save');
    Route::get('/user/{user}/delete', [UserController::class, 'delete'])->name('users.delete');


    Route::get('/grading-form/create', function () {
        return view('grading-form');
    })->name('grading-form.create');

    Route::get('/grading-form/edit', function () {
        return view('grading-form-edit');
    })->name('grading-form.edit');

    Route::get('/admin/grading-results', function () {
        return view('admin.admin-grading-results-edit');
    })->name('admin.grading-results');

    Route::get('/grading-templates', [GradingTemplateList::class, 'index'])->name('grading-template.index');
    Route::get('/grading-template/{id}', [GradingTemplateList::class, 'show'])->name('grading-template.show');
    Route::get('/student/form/{id}', [FormStudentViewController::class, 'show'])->name('student-form.show');

});

require __DIR__.'/auth.php';
