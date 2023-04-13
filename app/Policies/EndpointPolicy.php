<?php

namespace App\Policies;

use App\Models\Endpoint;
use App\Models\User;

class EndpointPolicy
{
    public function destroy(User $user, Endpoint $endpoint): bool
    {
        return $user->id === $endpoint->site->user_id;
    }
}
