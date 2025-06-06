<?php

namespace App\Livewire;

use App\Models\Grade;
use App\Models\GradingResult;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AdminGradingResults extends Component
{
    public $results;
    public $editingResultId = null;
    public $editFormData = [];

    public $editFormJson = '';
    public $jsonError = null;

    public function mount()
    {
        $this->authorizeAdmin();
        $this->loadResults();
    }

    public function authorizeAdmin()
    {
        if (!Auth::user() || Auth::user()->role_id !== 3) {
            abort(403, 'Unauthorized');
        }
    }

    public function loadResults()
    {
        $this->results = GradingResult::with(['gradingForm', 'student'])->get();
    }

    public function edit($id)
    {
        $result = GradingResult::findOrFail($id);
        $this->editingResultId = $id;
        $this->editFormJson = json_encode($result->form_data, JSON_PRETTY_PRINT);
        $this->jsonError = null;
    }

    public function save()
    {
        $this->jsonError = null;
        try {
            $data = json_decode($this->editFormJson, true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            $this->jsonError = 'Invalid JSON: ' . $e->getMessage();
            return;
        }
        $result = GradingResult::findOrFail($this->editingResultId);
        $result->form_data = $data;
        $result->save();
        session()->flash('success', 'Formulier bijgewerkt.');
        $this->editingResultId = null;
        $this->editFormJson = '';
        $this->jsonError = null;
        $this->loadResults();
    }

    public function cancelEdit()
    {
        $this->editingResultId = null;
        $this->editFormData = [];
    }

    public function delete($id)
    {
        $this->authorizeAdmin();
        $result = GradingResult::findOrFail($id);
        $result->delete();
        session()->flash('success', 'Formulier verwijderd.');
        $this->loadResults();
    }

    public function render()
    {
        return view('livewire.admin-grading-results');
    }
}
