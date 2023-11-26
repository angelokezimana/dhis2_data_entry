<div>
    <div class="">
        <p class="font-semibold text-lg uppercase text-gray-600">
            {{ __('Patient List') }}
        </p>
        <div class="w-1/2">
            <x-text-input wire:model.live="search_name" type="text" class="mt-1 block w-full" autofocus
                autocomplete="name" placeholder="Search user by their name ..." />
        </div>
    </div>

    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="min-w-full text-left text-sm font-light">
                        <thead class="border-b font-medium dark:border-neutral-500">
                            <tr>
                                <th scope="col" class="px-6 py-3">Name</th>
                                <th scope="col" class="px-6 py-3">Date of birth</th>
                                <th scope="col" class="px-6 py-3">Telephone</th>
                                <th scope="col" class="px-6 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($patients as $patient)
                                <tr wire:key="{{ $patient->id }}" class="border-b dark:border-neutral-500">
                                    <td class="whitespace-nowrap px-6 py-4">{{ $patient->full_name }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        {{ \Carbon\Carbon::parse($patient->dob)->format('d/m/Y') }}
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">{{ $patient->telephone }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <a href="{{ route('patients.show', $patient->id) }}"
                                            style="-webkit-appearance: button;-moz-appearance: button;appearance: button;"
                                            class="bg-green-600 border border-transparent rounded-md text-white hover:bg-green-500 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </a>
                                        <button type="button"
                                            wire:click="$dispatch('set-patient', { patient: '{{ $patient->id }}' })"
                                            class="ml-3 bg-blue-600 border border-transparent rounded-md text-white hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                            </svg>
                                        </button>
                                        <button type="button" wire:click="delete('{{ $patient->id }}')"
                                            wire:confirm="Are you sure you want to delete this patient?"
                                            class="ml-3 bg-red-600 border border-transparent rounded-md text-white hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr class="border-b dark:border-neutral-500">
                                    <td colspan="4"
                                        class="whitespace-nowrap px-6 py-4 text-center text-lg font-bold">
                                        @if ($search_name)
                                            The patient with the name '{{ $search_name }}' does not exist.
                                        @else
                                            No patients in the database.
                                        @endif
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{ $patients->links() }}
    </div>
</div>
