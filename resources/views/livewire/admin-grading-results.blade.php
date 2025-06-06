<div class="max-w-5xl mx-auto py-8 px-4">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Beoordeelde formulieren</h2>

    @if (session()->has('success'))
        <div
            x-data="{ show: true }"
            x-init="setTimeout(() => show = false, 3000)"
            x-show="show"
            class="fixed top-6 left-1/2 transform -translate-x-1/2 mb-4 px-4 py-2 bg-green-100 border border-green-300 text-green-800 rounded transition-all duration-500 z-50 shadow-lg"
        >
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded-lg overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Student</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Titel formulier</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Acties</th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
            @forelse($results as $result)
                <tr>
                    <td class="px-4 py-2">{{ $result->id }}</td>
                    <td class="px-4 py-2">{{ $result->student ? $result->student->name : 'Unknown' }}</td>
                    <td class="px-4 py-2">{{ $result->form_data['title'] ?? '' }}</td>
                    <td class="px-4 py-2 flex gap-2">
                        <button wire:click="edit({{ $result->id }})"
                                class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm transition">
                            Aanpassen
                        </button>
                        <div x-data="{ open: false }" class="inline-block">
                            <button @click="open = true"
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm transition">
                                Verwijderen
                            </button>
                            <div x-show="open" x-cloak class="fixed inset-0 flex items-center justify-center z-50">
                                <div class="bg-black bg-opacity-40 absolute inset-0"></div>
                                <div class="bg-white rounded-lg shadow-lg p-6 z-10 max-w-sm w-full">
                                    <h3 class="text-lg font-semibold mb-2 text-gray-800">Bevestig verwijderen</h3>
                                    <p class="mb-4 text-gray-600">Weet je zeker dat je dit formulier wilt verwijderen?</p>
                                    <div class="flex justify-end gap-2">
                                        <button @click="open = false"
                                                class="px-4 py-1 rounded bg-gray-200 text-gray-700 hover:bg-gray-300 transition">
                                            Annuleren
                                        </button>
                                        <button @click="open = false; $wire.delete({{ $result->id }})"
                                                class="px-4 py-1 rounded bg-red-500 text-white hover:bg-red-600 transition">
                                            Bevestigen
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-4 py-6 text-center text-gray-400">Geen gemaakte formulieren gevonden</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    @if($editingResultId)
        <div class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50" x-data="{ open: true }" x-show="open" x-cloak>
            <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl p-6 relative">
                <button @click="open = false; $wire.cancelEdit()" class="absolute top-2 right-2 text-gray-400 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <h3 class="text-xl font-semibold mb-4 text-gray-800">Formulier aanpassen #{{ $editingResultId }}</h3>
                <label for="editFormJson" class="block text-gray-700 mb-2">Formulier data (JSON)</label>
                <textarea
                    wire:model.defer="editFormJson"
                    id="editFormJson"
                    class="w-full border border-gray-300 rounded p-2 font-mono text-sm mb-2 focus:ring focus:ring-blue-200"
                    rows="10"
                    spellcheck="false"
                ></textarea>
                @if($jsonError)
                    <div class="mb-2 text-red-600 bg-red-100 rounded px-2 py-1">{{ $jsonError }}</div>
                @endif
                <div class="flex justify-end gap-2 mt-2">
                    <button @click="open = false; $wire.cancelEdit()"
                            class="px-4 py-2 rounded bg-gray-200 text-gray-700 hover:bg-gray-300 transition">
                        Annuleren
                    </button>
                    <button wire:click="save"
                            class="px-4 py-2 rounded bg-green-500 text-white hover:bg-green-600 transition">
                        Bevestigen
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
