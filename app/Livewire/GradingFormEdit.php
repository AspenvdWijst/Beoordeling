<?php

namespace App\Livewire;

use App\Models\GradingFormDraft;
use Livewire\Component;

class GradingFormEdit extends Component
{
    public $drafts = [];
    public $selectedDraftId = null;
    public $selectedDraftData = null;

    public function mount()
    {
        $this->drafts = GradingFormDraft::orderByDesc('created_at')->get();
    }

    public function selectDraft($draftId)
    {
        $draft = GradingFormDraft::findOrFail($draftId);
        $this->selectedDraftId = $draftId;
        $this->selectedDraftData = $draft->form_data;
        session()->flash('message', 'Concept geladen!');
    }

    public function handleDraftChange($draftId)
    {
        if (empty($draftId)) {
            $this->selectedDraftId = null;
            $this->selectedDraftData = null;
        } else {
            $this->selectDraft($draftId);
        }
    }

    public function deleteDraft($draftId)
    {
        $draft = GradingFormDraft::find($draftId);
        if ($draft) {
            $draft->delete();
            $this->drafts = GradingFormDraft::orderByDesc('created_at')->get();
            if ($this->selectedDraftId == $draftId) {
                $this->selectedDraftId = null;
                $this->selectedDraftData = null;
            }
            session()->flash('message', 'Concept verwijderd!');
        }
    }

    public function render()
    {
        return view('livewire.grading-form-edit');
    }
}
