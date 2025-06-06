<div class="p-4 h-full flex flex-col">
    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
        {{ __('Recent beoordeelde rubrics') }}
    </h3>

    @if($recentGradingForms->count() > 0)
        @foreach($recentGradingForms as $form)
            <a wire:key="grading-result-{{ $form->id }}"
               href="{{ route('student-form.show', $form->id) }}"
               class="block group cursor-pointer bg-white dark:bg-neutral-800 rounded-lg border border-neutral-200 dark:border-neutral-700 p-3 hover:shadow-md hover:border-blue-300 dark:hover:border-blue-600 transition-all duration-200"
            >
                <div class="flex items-center justify-between">
                    <div class="flex-1 min-w-0">
                        <h4 class="text-sm font-medium text-gray-900 dark:text-white truncate group-hover:text-blue-600 dark:group-hover:text-blue-400">
                            {{ $form->form_data['title'] }}
                        </h4>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            {{ $form->created_at->format('M j, Y') }}
                        </p>
                    </div>
                    <div class="ml-3 flex items-center">
                        @if($form->form_data['finalGrade'])
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                        @if($form->form_data['finalGrade'] >= 8) bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                        @elseif($form->form_data['finalGrade'] >= 7) bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200
                        @elseif($form->form_data['finalGrade'] >= 5.5) bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                        @else bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200
                        @endif">
                        {{ $form->form_data['finalGrade'] }}
                    </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200">
                        {{ __('Pending') }}
                    </span>
                        @endif
                        <svg class="ml-2 h-4 w-4 text-gray-400 group-hover:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </div>
            </a>
        @endforeach
        {{$recentGradingForms->links()}}
    @else
        <div class="flex-1 flex items-center justify-center">
            <div class="text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Geen rubrics') }}</h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('Je hebt nog geen beoordeling rubrics') }}</p>
            </div>
        </div>
    @endif
</div>
