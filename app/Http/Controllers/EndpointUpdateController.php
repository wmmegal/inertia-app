<?php

namespace App\Http\Controllers;

use App\Models\Endpoint;
use Illuminate\Http\Request;

class EndpointUpdateController extends Controller
{
    public function __invoke(Request $request, Endpoint $endpoint)
    {
        $endpoint->update($request->only('location', 'frequency'));

        return back();
    }
}
