<?php

namespace App\Livewire\Patients;

use App\Models\Patient;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class PatientDetailsForm extends Component
{
    public Patient $patient;

    #[Validate('required', as: 'dataset')]
    public $data_set = '';

    #[Validate('required', as: 'data element')]
    public $data_element = '';

    #[Validate('required', as: 'date occurred')]
    public $created_at = '';

    public $data_elements = [];
    public $hiv_testing = '';

    public function mount($patient = null)
    {
        $this->patient = $patient;
    }

    public function updatedDataSet()
    {
        $this->data_elements = [];

        if (!empty($this->data_set)) {
            $this->data_elements = DB::table('data_elements')
                ->where('data_elements.data_set_id', '=', $this->data_set)
                ->select('data_elements.id', 'data_elements.display_name')
                ->get();
        }
    }

    #[On('set-details-patient')]
    public function setDetailsPatient(int $hiv_testing_id)
    {
        $hiv_testing = DB::table('hiv_testings')
            ->join('data_elements', 'data_elements.id', '=', 'hiv_testings.data_element_id')
            ->join('data_sets', 'data_sets.id', '=', 'data_elements.data_set_id')
            ->where('hiv_testings.id', '=', $hiv_testing_id)
            ->select(
                'hiv_testings.id as hiv_testing_id',
                'hiv_testings.created_at as date_occurred',
                'data_elements.id as data_element_id',
                'data_sets.id as dataset_id'
            )->first();


        $this->hiv_testing = $hiv_testing->hiv_testing_id;
        $this->data_set = $hiv_testing->dataset_id;
        $this->updatedDataSet();
        $this->data_element = $hiv_testing->data_element_id;
        $this->created_at = date('Y-m-d H:i', strtotime($hiv_testing->date_occurred));
    }

    public function store()
    {
        $category_option_combo = DB::table('category_option_combos')
            ->select('id', 'display_name')
            ->whereRaw(
                "
            CASE
                WHEN display_name = '<15y' AND TIMESTAMPDIFF(YEAR, ?, CURDATE()) < 15 THEN 1
                WHEN display_name = '15-24y' AND (TIMESTAMPDIFF(YEAR, ?, CURDATE()) BETWEEN 15 AND 24) THEN 1
                WHEN display_name = '25-49y' AND (TIMESTAMPDIFF(YEAR, ?, CURDATE()) BETWEEN 25 AND 49) THEN 1
                WHEN display_name = '>49y' AND TIMESTAMPDIFF(YEAR, ?, CURDATE()) > 49 THEN 1
                ELSE 0
            END = 1",
                [$this->patient->dob, $this->patient->dob, $this->patient->dob, $this->patient->dob]
            )
            ->first();

        DB::table('hiv_testings')->insert([
            'patient_id' => $this->patient->id,
            'data_element_id' => $this->data_element,
            'category_option_combo_id' => $category_option_combo->id,
            'created_at' => $this->created_at,
        ]);
    }

    public function update()
    {
        DB::table('hiv_testings')
            ->where('id', '=', $this->hiv_testing)
            ->update([
                'data_element_id' => $this->data_element,
                'created_at' => $this->created_at,
            ]);
    }

    public function save()
    {
        $this->validate();

        $response = "{$this->patient->full_name} patient details have been";

        if ($this->hiv_testing) {
            $this->update();
            $response .= " updated successfully!";
        } else {
            $this->store();
            $response .= " added successfully!";
        }

        return redirect()->route('patients.show', $this->patient->id)
            ->with('is_success', true)
            ->with('response', $response);
    }

    public function render()
    {
        return view('livewire.patients.patient-details-form', [
            'data_sets' => DB::table('data_sets')
                ->join('data_set_organisation', 'data_set_organisation.data_set_id', '=', 'data_sets.id')
                ->where('data_set_organisation.org_id', '=', session()->get('org_unit')['id'])
                ->select('data_sets.id', 'data_sets.display_name')
                ->get(),
        ]);
    }
}
