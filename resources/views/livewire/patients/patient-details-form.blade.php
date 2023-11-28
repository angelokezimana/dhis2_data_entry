<div>
    <p class="font-semibold text-lg uppercase text-gray-600">
        {{ __('HIV Testing') }}
    </p>
    <form wire:submit="save" class="mt-6 space-y-6">

        <div>
            <x-input-label for="data_set" :value="__('Dataset')" />
            <select id="data_set" wire:model.live="data_set"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full">
                <option value="">Choose a dataset</option>
                @foreach ($data_sets as $data_s)
                    <option wire:key="{{ $data_s->id }}" value="{{ $data_s->id }}">
                        {{ $data_s->display_name }}
                    </option>
                @endforeach
            </select>
            @error('data_set')
                <x-input-error class="mt-2" :messages="$message" />
            @enderror
        </div>

        <div>
            <x-input-label for="data_element" :value="__('Data Element')" />
            <select id="data_element" wire:model.live="data_element"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full">
                <option value="">Choose a data element</option>
                @foreach ($data_elements as $data_el)
                    <option wire:key="{{ $data_el->id }}" value="{{ $data_el->id }}" {{ $data_el->id === $data_element ? 'selected' : '' }}>
                        {{ $data_el->display_name }}
                    </option>
                @endforeach
            </select>
            @error('data_element')
                <x-input-error class="mt-2" :messages="$message" />
            @enderror
        </div>

        <div>
            <x-input-label for="created_at" :value="__('Date Occurred')" />
            <x-text-input id="created_at" name="created_at" wire:model="created_at" type="datetime-local"
                class="mt-1 block w-full" autofocus autocomplete="date" />
            @error('created_at')
                <x-input-error class="mt-2" :messages="$message" />
            @enderror
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</div>
