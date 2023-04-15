<?php

namespace App\Http\Controllers;

use App\Http\Resources\EndpointResource;
use App\Http\Resources\SiteResource;
use App\Models\Endpoint;
use App\Models\Site;
use Illuminate\Http\Request;

class EndpointIndexController extends Controller
{
    public function __invoke(Request $request, Endpoint $endpoint)
    {
        return inertia('Endpoint', [
            'endpoint' => EndpointResource::make($endpoint)
        ]);
    }
}
