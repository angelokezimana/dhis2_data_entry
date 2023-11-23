<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Choose the organizational unit you want to work on.') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-6 gap-4">
                        @forelse ($org_units as $org_unit)
                            <form method="POST" action="{{ route('save.chosen.org', $org_unit->id) }}">
                                @csrf
                                <a href="{{ route('save.chosen.org', $org_unit->id) }}"
                                    onclick="event.preventDefault();
                                            this.closest('form').submit();"
                                    class=" text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none">
                                    {{ $org_unit->display_name }}
                                </a>
                            </form>
                        @empty
                            <div class="text-gray-700 text-2xl font-bold">
                                You don't have an Organization Unit that you're working on. Contact an administrator for assistance.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
