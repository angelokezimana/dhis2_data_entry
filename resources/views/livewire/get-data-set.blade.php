<div>
    <form method="POST" action="{{ route('dataentry.store') }}">
        @csrf
        <table>
            <tr>
                <td>Organisation Unit</td>
                <td>:
                    <select wire:model="org" wire:click="getDataSets" class="border border-pink-500">
                        <option value="">Choose an organisation unit</option>
                        @foreach($organisations as $org_unit)
                            <option value="{{ $org_unit->id }}">{{ $org_unit->display_name }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            @if(count($datasets) > 0)
                <tr>
                    <td>Data Set</td>
                    <td>: 
                        <select name="dataset" wire:click="getPeriods" wire:model="dataset" class="border border-pink-500">
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
                    <td>Period</td>
                    <td>: 
                        <select name="period" wire:click="getDataValues" wire:model="period" class="border border-pink-500">
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
                @foreach ($this->dataValues as $data_element => $values)
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
            <button class="border border-slate-600" type="submit">Envoyer</button>
        @endif
    </form>
</div>