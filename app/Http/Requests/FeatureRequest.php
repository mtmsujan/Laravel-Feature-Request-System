<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Enums\FeaturePriorityEnum;
use Illuminate\Foundation\Http\FormRequest;

class FeatureRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'string|required|max:255',
            'body'=> 'string|required',
            'priority'=> ['string', 'nullable', Rule::enum(FeaturePriorityEnum::class)]
        ];
    }
}
