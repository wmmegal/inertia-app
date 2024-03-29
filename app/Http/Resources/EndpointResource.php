<?php

namespace App\Http\Resources;

use App\Enums\EnumFrequency;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EndpointResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'              => $this->id,
            'location'        => $this->location,
            'frequency_label' => EnumFrequency::from($this->frequency)->label(),
            'frequency_value' => EnumFrequency::from($this->frequency)->value,
            'latest_check'    => CheckResource::make($this->check),
            'url'             => $this->url(),
            'site'            => $this->site,
            'checks'          => CheckResource::collection($this->checks()->latest()->paginate(100)),
            'uptime_percent'  => $this->uptimePercent()
        ];
    }
}
