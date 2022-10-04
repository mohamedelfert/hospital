<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SpecialtyRequest extends FormRequest
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
            'name' => 'required|unique:specialties,name->ar,' . $this->id,
            'name_en' => 'required|unique:specialties,name->en,' . $this->id,
            // Or
//            'name' => 'required|' . Rule::unique('specialties', 'name->ar')->ignore($this->id),
//            'name_en' => 'required|' . Rule::unique('specialties', 'name->en')->ignore($this->id),
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'اسم التخصص عربي مطلوب',
            'name.unique' => 'اسم التخصص موجود مسبقا',
            'name_en.required' => 'اسم التخصص انجليزي مطلوب',
            'name_en.unique' => 'اسم التخصص انجليزي موجود مسبقا',
        ];
    }
}
