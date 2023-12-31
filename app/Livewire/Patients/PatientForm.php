<?php

namespace App\Livewire\Patients;

use App\Models\Patient;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;

class PatientForm extends Component
{
    public ?Patient $patient = null;

    #[Validate('required', as: 'full name')]
    public $full_name = '';

    #[Validate('required', as: 'date of birth')]
    public $dob = '';

    public $telephone = '';

    #[On('set-patient')]
    public function setPatient(Patient $patient)
    {
        $this->patient = $patient;

        $this->full_name = $patient->full_name;
        $this->dob = $patient->dob;
        $this->telephone = $patient->telephone;
    }

    public function store()
    {
        Patient::create([
            'full_name' => $this->full_name,
            'dob' => $this->dob,
            'telephone' => $this->telephone,
            'org_id' => session()->get('org_unit')['id'],
        ]);
    }

    public function update()
    {
        $this->patient->update(
            $this->all()
        );
    }

    public function save()
    {
        $this->validate();
        $response = "Patient {$this->full_name} successfully";

        if ($this->patient) {
            $this->update();
            $response .= " updated!";
        } else {
            $this->store();
            $response .= " added!";
        }

        return redirect()->route('patients.index')
            ->with('is_success', true)
            ->with('response', $response);
    }

    public function render()
    {
        return view('livewire.patients.patient-form');
    }
}
