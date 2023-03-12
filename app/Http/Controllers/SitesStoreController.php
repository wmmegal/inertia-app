<?php

namespace App\Http\Controllers;

use App\Http\Requests\SiteStoreRequest;

class SitesStoreController extends Controller
{
    public function __invoke(SiteStoreRequest $request)
    {
        $site = $request->user()->sites()->create($request->only('domain'));

        return redirect()->route('dashboard', $site);
    }
}
