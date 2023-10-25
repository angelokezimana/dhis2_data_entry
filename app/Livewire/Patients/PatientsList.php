<?php

namespace App\Livewire\Patients;

use App\Models\Patient;
use Livewire\Component;

class PatientsList extends Component
{
    public function render()
    {
        return view('livewire.patients.patients-list', [
            'patients' => Patient::all(),
        ]);
    }
}
