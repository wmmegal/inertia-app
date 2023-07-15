<?php

namespace App\Observers;

use App\Events\EndpointRecovered;
use App\Events\EndpointWentDown;
use App\Models\Check;
use Log;

class CheckObserver
{
    public function created(Check $check): void
    {

        if (
            ! $check->isSuccessful() &&
            ($check->previous()?->isSuccessful() || $check->endpoint->checks->count() === 1)
        ) {
            EndpointWentDown::dispatch($check);
        }

        if (
            $check->isSuccessful() &&
            ! $check->previous()?->isSuccessful() && $check->endpoint->checks->count() !== 1
        ) {
            EndpointRecovered::dispatch($check);
        }
    }
}
