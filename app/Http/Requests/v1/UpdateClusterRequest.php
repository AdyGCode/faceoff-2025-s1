<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClusterRequest extends FormRequest
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
            'code' => ['required', 'string','max:10', 'uppercase'],
            'title' => ['required', 'string','min:2', 'max:255'],
            'qualification'=> ['required', 'string','max:8','uppercase'],
            'qs_code'=> ['required', 'string','max:4','uppercase'],
            'course_id' => ['required', 'exists:courses,id'],
            'unit_id' => ['required', 'exists:units,id'],
        ];
    }
}
