<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class DataEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataset = 'vc6nF5yZsPR';
        $period = '202306';

        $data_set = DB::table('organisation_units')
            ->join('data_set_organisation', 'organisation_units.id', '=', 'data_set_organisation.org_id')
            ->join('data_sets', 'data_set_organisation.data_set_id', '=', 'data_sets.id')
            ->join('data_elements', 'data_sets.id', '=', 'data_elements.data_set_id')
            ->join('hiv_testings', 'data_elements.id', '=', 'hiv_testings.data_element_id')
            ->where('data_sets.id', '=', $dataset)
            ->where(DB::raw("DATE_FORMAT(hiv_testings.created_at, '%Y%m')"), '=', $period)
            ->select(
                'organisation_units.id AS orgUnitId',
                'organisation_units.display_name AS orgUnit',
                'data_sets.id AS dataSetId',
                'data_sets.display_name AS dataSet',
                DB::raw("DATE_FORMAT(hiv_testings.created_at, '%Y%m') AS period")
            )
            ->distinct()
            ->first();

        $data_values = DB::table('data_sets')
            ->join('data_elements', 'data_sets.id', '=', 'data_elements.data_set_id')
            ->join('hiv_testings', 'data_elements.id', '=', 'hiv_testings.data_element_id')
            ->join('category_option_combos', 'hiv_testings.category_option_combo_id', '=', 'category_option_combos.id')
            ->where('data_sets.id', '=', $dataset)
            ->where(DB::raw("DATE_FORMAT(hiv_testings.created_at, '%Y%m')"), '=', $period)
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
        // dd($table_data_values, $data_values);
        return view('dataentries.index', [
            'data_set' => $data_set,
            'data_values' => $table_data_values
        ]);
    }

    /**
     * Store a newly created resource in storage (DHIS2).
     */
    public function store(Request $request)
    {
        $data_set = DB::table('organisation_units')
            ->join('data_set_organisation', 'organisation_units.id', '=', 'data_set_organisation.org_id')
            ->join('data_sets', 'data_set_organisation.data_set_id', '=', 'data_sets.id')
            ->join('data_elements', 'data_sets.id', '=', 'data_elements.data_set_id')
            ->join('hiv_testings', 'data_elements.id', '=', 'hiv_testings.data_element_id')
            ->where('data_sets.id', '=', $request->data_set)
            ->where(DB::raw("DATE_FORMAT(hiv_testings.created_at, '%Y%m')"), '=', $request->period)
            ->select(
                'data_sets.id AS dataSet',
                DB::raw('DATE(NOW()) AS completeDate'),
                DB::raw("DATE_FORMAT(hiv_testings.created_at, '%Y%m') AS period"),
                'organisation_units.id AS orgUnit',
            )
            ->distinct()
            ->first();

        $data_values = DB::table('data_sets')
            ->join('data_elements', 'data_sets.id', '=', 'data_elements.data_set_id')
            ->join('hiv_testings', 'data_elements.id', '=', 'hiv_testings.data_element_id')
            ->join('category_option_combos', 'hiv_testings.category_option_combo_id', '=', 'category_option_combos.id')
            ->where('data_sets.id', '=', $request->data_set)
            ->where(DB::raw("DATE_FORMAT(hiv_testings.created_at, '%Y%m')"), '=', $request->period)
            ->select(
                'data_elements.id AS dataElement',
                'category_option_combos.id AS categoryOptionCombo',
                DB::raw('COUNT(hiv_testings.patient_id) AS value'),
            )
            ->groupBy('dataElement', 'categoryOptionCombo')
            ->get();

        $array_data = (collect($data_set)->merge([
            "dataValues" => collect($data_values)
        ]))->toArray();

        $response = Http::withBasicAuth(config('app.dhis2_username'), config('app.dhis2_password'))
            ->post(config('app.dhis2_api_url') . '/dataValueSets', $array_data);

        return redirect()->route('dataentry.index')
            ->with('is_success', $response->successful())
            ->with('response', $response->json());
    }
}
