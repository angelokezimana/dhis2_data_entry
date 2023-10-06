<div class="mt-3">
    <form method="POST" action="{{ route('dataentry.store') }}">
        @csrf
        <table>
            <tr>
                <td class="pr-4">
                    <label for="org" class="text-sm leading-4 font-medium text-gray-500">Organisation Unit</label>
                </td>
                <td>
                    <select id="org" wire:model="org" wire:click="getDataSets" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full">
                        <option value="">Choose an organisation unit</option>
                        @foreach($organisations as $org_unit)
                            <option value="{{ $org_unit->id }}">{{ $org_unit->display_name }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            @if(count($datasets) > 0)
                <tr>
                    <td class="pr-4">
                        <label for="dataset" class="text-sm leading-4 font-medium text-gray-500">Data Set</label>
                    </td>
                    <td>
                        <select id="dataset" name="dataset" wire:click="getPeriods" wire:model="dataset" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full">
                            <option value="">Choose a dataset</option>
                            @foreach($datasets as $data_set)
                                <option value="{{ $data_set->dataSetId }}">{{ $data_set->dataSet }}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
            @endif
            @if(count($periods) > 0)
                <tr>
                    <td class="pr-4">
                        <label for="period" class="text-sm leading-4 font-medium text-gray-500">Period</label>
                    </td>
                    <td>
                        <select id="period" name="period" wire:click="getDataValues" wire:model="period" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full">
                            <option value="">Choose a period</option>
                            @foreach($periods as $item)
                                <option value="{{ $item->period }}">{{ $item->DisplayPeriod }}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
            @endif
        </table>

        @if(count($dataValues) > 0)
        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
              <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                  <table class="min-w-full text-left text-sm font-light">
                    <thead class="border-b font-medium dark:border-neutral-500">
                      <tr>
                        <th scope="col" class="px-6 py-4"></th>
                        <th scope="col" class="px-6 py-3">&lt;15y</th>
                        <th scope="col" class="px-6 py-3">15-24y</th>
                        <th scope="col" class="px-6 py-3">25-49y</th>
                        <th scope="col" class="px-6 py-3">&gt;49y</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($this->dataValues as $data_element => $values)
                       <tr class="border-b dark:border-neutral-500">
                           <td class="whitespace-nowrap px-6 py-4">{{ $data_element }}</td>
                           <td class="whitespace-nowrap px-6 py-4">{{ $values['<15y'] ?? 0 }}</td>
                           <td class="whitespace-nowrap px-6 py-4">{{ $values['15-24y'] ?? 0 }}</td>
                           <td class="whitespace-nowrap px-6 py-4">{{ $values['25-49y'] ?? 0 }}</td>
                           <td class="whitespace-nowrap px-6 py-4">{{ $values['>49y'] ?? 0 }}</td>
                       </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
        <button type="submit" class="mt-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            Envoyer
        </button>
        @endif
    </form>
</div>