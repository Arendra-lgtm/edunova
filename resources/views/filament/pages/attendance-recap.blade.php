<x-filament-panels::page>
    <form wire:submit="$refresh">
        {{ $this->form }}

        <div class="mt-4">
            <x-filament::button type="submit">
                Apply Filter
            </x-filament::button>
        </div>
    </form>

    <div class="mt-6 p-4 bg-gray-900 rounded-xl border border-gray-700">
        <h2 class="text-lg font-bold mb-2">Filter Result</h2>

        <p><strong>Class:</strong>
            {{ $data['school_class_id'] ?? 'All Classes' }}
        </p>

        <p><strong>Start:</strong>
            {{ $data['start_date'] ?? '-' }}
        </p>

        <p><strong>End:</strong>
            {{ $data['end_date'] ?? '-' }}
        </p>
    </div>
</x-filament-panels::page>