<?php

namespace App\Http\Controllers;

use App\Http\Resources\SiteResource;
use App\Models\Site;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request, Site $site)
    {
        $site->update(['default' => true]);

        if ( ! $site->exists) {
            $site = $request->user()->sites()->where('default', true)->first() ?: $request->user()->sites()->first();
        }

        return inertia('Dashboard', [
            'site'  => SiteResource::make($site),
            'sites' => SiteResource::collection(Site::get())
        ]);
    }
}
