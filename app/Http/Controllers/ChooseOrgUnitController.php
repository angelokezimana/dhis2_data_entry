<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\OrganisationUnit;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ChooseOrgUnitController extends Controller
{
    /**
     * Display the choose org unit view.
     */
    public function index(): View
    {
        $org_units = DB::table('organisation_units')
            ->join('organisation_users', 'organisation_units.id', '=', 'organisation_users.org_id')
            ->where('organisation_users.user_id', '=', Auth::id())
            ->select(
                'organisation_units.id',
                'organisation_units.display_name'
            )->get();


        return view('choose-org-unit.index', [
            'org_units' => $org_units
        ]);
    }

    public function save(Request $request, OrganisationUnit $org_unit)
    {
        $org_unit = DB::table('organisation_users')
            ->where('organisation_users.user_id', '=', Auth::id())
            ->where('organisation_users.org_id', '=', $org_unit->id)
            ->select('organisation_users.org_id AS id')
            ->first();

        if ($org_unit) {
            $request->session()->put('org_unit', $org_unit->id);
        }

        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
