<?php

namespace App\Observers;

use App\Models\Check;
use Log;

class CheckObserver
{
    public function created(Check $check): void
    {
        if (
            ! $check->isSuccessful() &&
            ($check->previous()->isSuccessful() || $check->endpoint->checks->count() === 1)
        ) {
            Log::info('Notify user');
        }
    }
}
