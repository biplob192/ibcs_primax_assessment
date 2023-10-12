<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return ($this->isMethod('POST') ? $this->store() : $this->update());
    }

    protected function store()
    {
        return [
            'title'         => 'required|max:100|unique:projects',
            'description'   => 'required',
            'start_date'    => 'required|date',
            'end_date'      => 'required|date',
        ];
    }

    protected function update()
    {
        return [
            'title'         => ['required', 'max:100', Rule::unique('projects')->ignore($this->route('id'))],
            'description'   => 'required',
            'start_date'    => 'required|date',
            'end_date'      => 'required|date',
        ];
    }
}
