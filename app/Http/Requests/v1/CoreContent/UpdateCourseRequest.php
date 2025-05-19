<?php

namespace App\Http\Requests\v1\CoreContent;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseRequest extends FormRequest
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
            'package_id' => ['required', 'exists:packages,id'],
            'national_code' => ['required', 'string','max:8', 'uppercase'],
            'aqf_level' => ['required', 'string','min:10', 'max:25'],
            'title' => ['required', 'string','min:2', 'max:255'],
            'tga_status' => ['required', 'string','min:2', 'max:10'],
            'status_code' => ['required', 'string', 'max:4', 'uppercase'],
            'nominal_hours'=> ['required', 'integer', 'min:1', 'max:1000'],
        ];
    }
}
