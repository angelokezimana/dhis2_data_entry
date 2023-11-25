<?php

namespace App\Http\Middleware;

use App\Models\OrganisationUnit;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureAuthenticatedUserChoseOrgUnit
{
    private function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (
            !$request->session()->has('org_unit') ||
            !array_key_exists('id', $request->session()->get('org_unit'))
        ) {
            $this->logout($request);
            return redirect('/');
        }

        $org_unit = OrganisationUnit::find($request->session()->get('org_unit')['id']);

        if (!$org_unit) {
            $this->logout($request);
            return redirect('/');
        }

        return $next($request);
    }
}
