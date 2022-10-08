<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name' => 'required|unique:doctors,name->ar,' . $this->id,
            'name_en' => 'required|unique:doctors,name->en,' . $this->id,
            'phone' => 'required|numeric|unique:doctors,phone,' . $this->id,
            'email' => 'required|email|unique:doctors,email,' . $this->id,
            'address' => 'required',
            'gender' => 'required|in:male,female',
            'specialty_id' => 'required',
            'image' => 'sometimes|nullable|image|mimes:png,jpg,jpeg,gif'
        ];
    }

//    /**
//     * Get the error messages for the defined validation rules.
//     *
//     * @return array
//     */
//    public function messages()
//    {
//        return [
//            'name.required' => 'اسم التخصص عربي مطلوب',
//            'name.unique' => 'اسم التخصص موجود مسبقا',
//            'name_en.required' => 'اسم التخصص انجليزي مطلوب',
//            'name_en.unique' => 'اسم التخصص انجليزي موجود مسبقا',
//        ];
//    }
}
