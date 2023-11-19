<?php

namespace App\Livewire\Patients;

use App\Models\Patient;
use Livewire\Component;
use Livewire\WithPagination;

class PatientsList extends Component
{
    use WithPagination;

    public $search_name = '';

    public function render()
    {
        return view('livewire.patients.patients-list', [
            'patients' => Patient::where('full_name', 'like', "%{$this->search_name}%")
                ->orderBy('id', 'desc')
                ->paginate(5),
        ]);
    }
}
