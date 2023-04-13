<?php

namespace App\Http\Requests;

use App\Enums\EnumFrequency;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class EndpointUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('destroy', $this->endpoint);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'location'  => ['required'],
            'frequency' => ['required', new Enum(EnumFrequency::class)]
        ];
    }
}
