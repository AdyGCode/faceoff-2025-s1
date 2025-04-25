<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;

class StoreUnitRequest extends FormRequest
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
            'national_code' => ['required', 'string','max:10', 'uppercase'],
            'title' => ['required', 'string','min:2', 'max:255'],
            'tga_status' => ['required', 'string','min:2', 'max:10'],
            'status_code' => ['required', 'string', 'max:5', 'uppercase'],
            'nominal_hours'=> ['required', 'integer', 'min:1', 'max:1000'],
            'course_id' => ['required', 'exists:courses,id'],
            'cluster_id' => ['required', 'exists:clusters,id'],
        ];
    }
}
