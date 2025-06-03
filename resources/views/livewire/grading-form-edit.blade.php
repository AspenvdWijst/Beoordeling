<div>
    <h2 class="text-lg font-semibold mb-2">Concepten</h2>
    <div class="mb-4">
        <label for="draftDropdown" class="block text-sm font-medium text-gray-700 mb-1">Selecteer een concept:</label>
        <div class="flex items-center space-x-2 relative">
            <select
                id="draftDropdown"
                wire:model="selectedDraftId"
                wire:change="handleDraftChange($event.target.value)"
                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
            >
                <option value="">-- Kies een concept --</option>
                @foreach($drafts as $draft)
                    <option value="{{ $draft->id }}">
                        {{ $draft->title }} ({{ $draft->created_at->format('d-m-Y H:i') }})
                    </option>
                @endforeach
            </select>
            @if($selectedDraftId)
                <div x-data="{ showConfirm: false }" class="flex items-center ml-2">
                    <button
                        @click="showConfirm = true"
                        class="text-red-500 hover:text-red-700 text-xl font-bold focus:outline-none px-2 py-1 rounded-full border border-transparent hover:border-red-300 transition"
                        title="Verwijder dit concept"
                        type="button"
                    >
                        &times;
                    </button>
                    <div
                        x-show="showConfirm"
                        x-transition
                        class="fixed inset-0 flex items-center justify-center z-50 bg-black/30 backdrop-blur-sm"
                        style="display: none;"
                    >
                        <div class="bg-white rounded-lg shadow-lg p-6 w-80">
                            <h3 class="text-lg font-semibold mb-2 text-red-700">Weet je het zeker?</h3>
                            <p class="mb-4">Wil je dit concept verwijderen?</p>
                            <div class="flex justify-end space-x-2">
                                <button
                                    @click="showConfirm = false"
                                    class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300"
                                    type="button"
                                >Annuleren</button>
                                <button
                                    @click="$wire.deleteDraft({{ $selectedDraftId }}); showConfirm = false"
                                    class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700"
                                    type="button"
                                >Verwijderen</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    @if($selectedDraftId)
        <div>
            @livewire('grading-form-livewire', ['draftData' => $selectedDraftData, 'draftId' => $selectedDraftId], key($selectedDraftId))
        </div>
    @endif
</div>
