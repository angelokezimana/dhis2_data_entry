<?php

namespace App\Livewire\Patients;

use App\Models\Patient;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PatientDetailsList extends Component
{
    public Patient $patient;

    public function mount($patient = null)
    {
        $this->patient = $patient;
    }

    public function delete(int $hiv_testing_id)
    {
        DB::table('hiv_testings')->delete($hiv_testing_id);

        return redirect()->route('patients.show', $this->patient->id)
            ->with('is_success', true)
            ->with('response', "Record successfully deleted!");
    }

    public function render()
    {
        return view('livewire.patients.patient-details-list', [
            'hiv_testings' => DB::table('hiv_testings')
                ->join('data_elements', 'data_elements.id', '=', 'hiv_testings.data_element_id')
                ->join('data_sets', 'data_sets.id', '=', 'data_elements.data_set_id')
                ->where('hiv_testings.patient_id', '=', $this->patient->id)
                ->select(
                    'hiv_testings.id as id',
                    'hiv_testings.created_at as date_occurred',
                    'data_elements.display_name as data_element',
                    'data_sets.display_name as dataset'
                )->get(),
        ]);
    }
}
