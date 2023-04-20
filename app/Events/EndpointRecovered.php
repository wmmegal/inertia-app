<?php

namespace App\Events;

use App\Models\Check;
use Illuminate\Foundation\Events\Dispatchable;

class EndpointRecovered
{
    use Dispatchable;

    public function __construct(public Check $check)
    {
    }
}
