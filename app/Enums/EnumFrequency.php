<?php

namespace App\Enums;

enum EnumFrequency: int
{
    case TEN_SECONDS= 10;
    case ONE_MINUTE = 60;
    case FIVE_MINUTES = 300;
    case THIRTY_MINUTES = 1800;
    case ONE_HOUR = 3600;

    public function label()
    {
        return match ($this) {
            self::TEN_SECONDS => '10 seconds',
            self::ONE_MINUTE => '1 minute',
            self::FIVE_MINUTES => '5 minutes',
            self::THIRTY_MINUTES => '30 minutes',
            self::ONE_HOUR => '1 hour',
        };
    }
}
