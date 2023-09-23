<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data entries') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table>
                        <tr>
                            <td>Organisation Unit</td>
                            <td>: {{ $data_set->orgUnit }}</td>
                        </tr>
                        <tr>
                            <td>Data Set</td>
                            <td>: {{ $data_set->dataSet }}</td>
                        </tr>
                        <tr>
                            <td>Period</td>
                            <td>: {{ $data_set->period }}</td>
                        </tr>
                    </table>
                    <table class="border-collapse border">
                        <thead>
                            <tr>
                                <th></th>
                                <th class="border">&lt;15y</th>
                                <th class="border">15-24y</th>
                                <th class="border">25-49y</th>
                                <th class="border">&gt;49y</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($data_values as $data_element => $values)
                            <tr>
                                <td class="border">{{ $data_element }}</td>
                                <td class="border">{{ $values['<15y'] ?? 0 }}</td>
                                <td class="border">{{ $values['15-24y'] ?? 0 }}</td>
                                <td class="border">{{ $values['25-49y'] ?? 0 }}</td>
                                <td class="border">{{ $values['>49y'] ?? 0 }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>