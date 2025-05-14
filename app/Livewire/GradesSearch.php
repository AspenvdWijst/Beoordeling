<?php

namespace App\Livewire;

use App\Models\Grade;
use Livewire\Component;

class GradesSearch extends Component
{
    public $search = '';        // This is the property bound to the search input
    public $searchType = 'student';  // Default search type (student or assignment)

    // Method to render the Livewire component view
    public function render()
    {
        // Build the query to search for unapproved grades
        $gradesQuery = Grade::where('approved', false);

        // Filter based on the selected search type
        if (trim($this->search) !== '') {
            if ($this->searchType === 'student') {
                // Search by student name
                $gradesQuery = $gradesQuery->whereHas('student', function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%');
                });
            } elseif ($this->searchType === 'assignment') {
                // Search by assignment name
                $gradesQuery = $gradesQuery->whereHas('assignment', function ($query) {
                    $query->where('assignment_name', 'like', '%' . $this->search . '%');
                });
            }
        }

        // Get the filtered grades from the database
        $grades = $gradesQuery->get();

        // Pass the filtered grades to the Blade view
        return view('livewire.grades-search', [
            'grades' => $grades,  // Passing the grades to the Blade view
        ]);
    }
}




