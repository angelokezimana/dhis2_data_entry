<div class="mt-3">
    <form wire:submit="save" class="mt-6 space-y-6">

        <div>
            <x-input-label for="full_name" :value="__('Full Name')" />
            <x-text-input id="full_name" name="full_name" wire:model="full_name" type="text" class="mt-1 block w-full" autofocus autocomplete="name" />
            @error('full_name')
                <x-input-error class="mt-2" :messages="$message" />
            @enderror
        </div>

        <div>
            <x-input-label for="dob" :value="__('Date of Birth')" />
            <x-text-input id="dob" name="dob" wire:model="dob" type="date" class="mt-1 block w-full" autofocus autocomplete="date" />
            @error('dob')
                <x-input-error class="mt-2" :messages="$message" />
            @enderror
        </div>

        <div>
            <x-input-label for="telephone" :value="__('telephone')" />
            <x-text-input id="telephone" name="telephone" wire:model="telephone" type="tel" class="mt-1 block w-full" autofocus autocomplete="tel" />
            @error('telephone')
                <x-input-error class="mt-2" :messages="$message" />
            @enderror
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</div>
