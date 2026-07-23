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
        <h2 class="text-lg font-bold mb-4">Filter Result</h2>

        <div class="space-y-2 text-sm">
            @php
                    $selectedClass = $this->classId
                        ? \App\Models\SchoolClass::find($this->classId)
                        : null;
                @endphp

                <p>
                    <span class="font-semibold text-gray-300">Class:</span>
                    <span class="text-white">
                        {{
                            $selectedClass
                                ? trim(
                                    ($selectedClass->level ?? '') . ' ' .
                                    ($selectedClass->major ?? '') . ' ' .
                                    ($selectedClass->name ?? '')
                                )
                                : 'All Classes'
                        }}
                    </span>
                </p>
            <p>
                <span class="font-semibold text-gray-300">Subject:</span>
                <span class="text-white">
                    {{
                        $this->subjectId
                            ? \App\Models\Subject::find($this->subjectId)?->name
                            : 'All Subjects'
                    }}
                </span>
            </p>

            <p>
                <span class="font-semibold text-gray-300">Start:</span>
                <span class="text-white">{{ $this->startDate }}</span>
            </p>

            <p>
                <span class="font-semibold text-gray-300">End:</span>
                <span class="text-white">{{ $this->endDate }}</span>
            </p>
        </div>
    </div>
</x-filament-panels::page>