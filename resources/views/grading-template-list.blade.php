<x-layouts.app :title="__('View')">
    <div class="container mx-auto py-8">
        <h2 class="text-2xl font-bold mb-6">Beschikbare templates</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach($templates as $template)
                <a href="{{ route('grading-template.show', $template->id) }}"
                   class="block bg-white shadow hover:shadow-lg rounded-lg p-6 border border-gray-200 hover:border-blue-400 transition">
                    <div class="text-lg font-semibold text-gray-800">{{ $template->title }}</div>
                </a>
            @endforeach
        </div>
    </div>
</x-layouts.app>
