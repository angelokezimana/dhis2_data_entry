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
        return view('dataentries.index');
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
            ->where('data_sets.id', '=', $request->dataset)
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
            ->where('data_sets.id', '=', $request->dataset)
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

        return redirect()->route('dataentries.index')
            ->with('is_success', $response->successful())
            ->with('response', $response->json()['message']);
    }
}
