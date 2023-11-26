<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Patient details') }} - {{ $patient->full_name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-row gap-2">
            <div class="mb-3 bg-white overflow-hidden shadow-sm sm:rounded-lg basis-1/3">
                <div class="p-6 text-gray-900">
                    @include('components.flash-message')
                    <livewire:patients.patient-details-form :patient="$patient" />
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg basis-2/3">
                <div class="p-6 text-gray-900">
                    <livewire:patients.patient-details-list />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
