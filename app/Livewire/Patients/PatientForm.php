<?php

namespace App\Livewire\Patients;

use App\Models\Patient;
use Livewire\Attributes\Rule;
use Livewire\Component;

class PatientForm extends Component
{
    #[Rule('required', as: 'full name')]
    public $full_name = '';

    #[Rule('required', as: 'date of birth')]
    public $dob = '';

    public $telephone = '';

    public function save()
    {
        $this->validate();

        Patient::create(
            $this->only(['full_name', 'dob', 'telephone'])
        );

        return redirect()->route('patients.index')
            ->with('is_success', true)
            ->with('response', "Patient {$this->full_name} successfully added!");
    }

    public function render()
    {
        return view('livewire.patients.patient-form');
    }
}
