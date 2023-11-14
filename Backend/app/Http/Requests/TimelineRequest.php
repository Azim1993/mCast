<?php

namespace App\Http\Requests;

use App\Data\Enums\PreviewPrivacyTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TimelineRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'content' => 'required|max:255',
            'preview_privacy' => ['nullable', Rule::in(PreviewPrivacyTypeEnum::toArray())]
        ];
    }
}
