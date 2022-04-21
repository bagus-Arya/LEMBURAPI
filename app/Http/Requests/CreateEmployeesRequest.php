<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CreateEmployeesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        return [
            'name'      => 'required|min:2|unique:employees',
            'status_id'      => 'required',
            'salary'        => 'required|numeric|min:2000000|max:10000000',
        ];
    }
     /**
     * Custom error message
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'      => "Nama Wajib Diisi",
            'status_id.required'      => "Status ID Wajib Diisi",
            'salary.required'        => "Salary Wajib Diisi",
        ];
    }
}
