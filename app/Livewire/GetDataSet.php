<?php

namespace App\Livewire;

use App\Models\OrganisationUnit;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class GetDataSet extends Component
{
    public $org = '';
    public $datasets = [];
    public $dataset = '';
    public $periods = [];
    public $period = '';
    public $dataValues = [];

    public function getDataSets()
    {
        $this->datasets = [];

        if (!empty($this->org)) {
            $this->datasets = DB::table('organisation_units')
                ->join('data_set_organisation', 'organisation_units.id', '=', 'data_set_organisation.org_id')
                ->join('data_sets', 'data_set_organisation.data_set_id', '=', 'data_sets.id')
                ->where('data_set_organisation.org_id', '=', $this->org)
                ->select(
                    'data_sets.id AS dataSetId',
                    'data_sets.display_name AS dataSet'
                )
                ->get();
        }
    }

    public function getPeriods()
    {
        $this->periods = [];

        if (!empty($this->dataset)) {
            $this->periods = DB::table('data_elements')
                ->join('hiv_testings', 'data_elements.id', '=', 'hiv_testings.data_element_id')
                ->where('data_elements.data_set_id', '=', $this->dataset)
                ->select(
                    DB::raw("DATE_FORMAT(hiv_testings.created_at, '%Y%m') AS period"),
                    DB::raw("DATE_FORMAT(hiv_testings.created_at, '%M %Y') AS DisplayPeriod"),
                )
                ->distinct()
                ->orderBy('period')
                ->get();
        }
    }

    public function getDataValues()
    {
        $this->dataValues = [];

        if (!empty($this->period)) {
            $data_values = DB::table('data_sets')
                ->join('data_elements', 'data_sets.id', '=', 'data_elements.data_set_id')
                ->join('hiv_testings', 'data_elements.id', '=', 'hiv_testings.data_element_id')
                ->join('category_option_combos', 'hiv_testings.category_option_combo_id', '=', 'category_option_combos.id')
                ->where('data_sets.id', '=', $this->dataset)
                ->where(DB::raw("DATE_FORMAT(hiv_testings.created_at, '%Y%m')"), '=', $this->period)
                ->select(
                    'data_elements.display_name AS dataElement',
                    'category_option_combos.display_name AS categoryOptionCombo',
                    DB::raw('COUNT(hiv_testings.patient_id) AS value'),
                )
                ->groupBy('dataElement', 'categoryOptionCombo')
                ->get();

            $table_data_values = [];

            foreach ($data_values as $data_value) {
                $data_element = $data_value->dataElement;
                $category_option_combo = $data_value->categoryOptionCombo;
                $value = $data_value->value;

                if (!isset($table_data_values[$data_element])) {
                    $table_data_values[$data_element] = [];
                }

                $table_data_values[$data_element][$category_option_combo] = $value;
            }
            $this->dataValues = $table_data_values;
        }
    }

    public function render()
    {
        return view('livewire.get-data-set', [
            'organisations' => OrganisationUnit::all()
        ]);
    }
}
