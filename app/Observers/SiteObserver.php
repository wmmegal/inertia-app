<?php

namespace App\Observers;

use App\Models\Site;
use Arr;

class SiteObserver
{

    public function creating(Site $site): void
    {
        $data         = parse_url($site->domain);
        $site->scheme = Arr::get($data, 'scheme');
        $site->domain = Arr::get($data, 'host');
    }

    public function updating(Site $site): void
    {
        if (in_array('default', array_keys($site->getDirty()))) {
            $site->user->sites()->whereNot('id', $site->id)->update(['default' => false]);
        }
    }
}
