<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-700 text-justify mx-20">
                    {{ __("This project is an educational website focused on interacting with the DHIS2 platform, specifically
                    targeting the HIV Care Monthly dataset.
                    The goal is to provide a learning resource for individuals interested in working with DHIS2 APIs and
                    gaining hands-on experience with the HIV Care Monthly data.") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
