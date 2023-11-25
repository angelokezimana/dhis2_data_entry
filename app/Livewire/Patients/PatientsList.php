<?php

namespace App\Livewire\Patients;

use App\Models\Patient;
use Livewire\Component;
use Livewire\WithPagination;

class PatientsList extends Component
{
    use WithPagination;

    public $search_name = '';

    public function delete(Patient $patient)
    {
        $patient_name = $patient->full_name;

        $patient->delete();

        return redirect()->route('patients.index')
            ->with('is_success', true)
            ->with('response', "Patient {$patient_name} successfully deleted!");
    }

    public function render()
    {
        return view('livewire.patients.patients-list', [
            'patients' => Patient::where('org_id', '=', session()->get('org_unit')['id'])
                ->where('full_name', 'like', "%{$this->search_name}%")
                ->orderBy('id', 'desc')
                ->paginate(5),
        ]);
    }
}
