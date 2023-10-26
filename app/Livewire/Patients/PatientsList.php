<?php

namespace App\Livewire\Patients;

use App\Models\Patient;
use Livewire\Component;
use Livewire\WithPagination;

class PatientsList extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.patients.patients-list', [
            'patients' => Patient::orderBy('id', 'desc')->paginate(5),
        ]);
    }
}
