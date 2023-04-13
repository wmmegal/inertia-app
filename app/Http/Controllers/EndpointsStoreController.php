<?php

namespace App\Http\Controllers;

use App\Http\Requests\EndpointStoreRequest;
use App\Models\Site;

class EndpointsStoreController extends Controller
{
    public function __invoke(EndpointStoreRequest $request, Site $site)
    {
        $site->endpoints()->create($request->only('frequency', 'location'));

        return back();
    }
}
