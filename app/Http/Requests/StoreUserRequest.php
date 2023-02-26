<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'birthday' => 'required',
            'gender' => 'required',
            'province_id' => 'required',
            'district_id' => 'required',
            'ward_id' => 'required',
            'inputFileAdd' => 'required',

        ];
    }
    public function messages()
    {
        return [
            'name.required' => ' :attribute không được để trống!',
            'email.required' => ' :attribute không được để trống!',
            'birthday.required' => ' :attribute không được để trống!',
            'phone.required' => ' :attribute không được để trống!',
            'gender.required' => ' :attribute không được để trống!',
            'province_id.required' => ' :attribute không được để trống!',
            'district_id.required' => ' :attribute không được để trống!',
            'ward_id.required' => ' :attribute không được để trống!',
            'group_id.required' => ' :attribute không được để trống!',
            'inputFile.required' => ' :attribute không được để trống!',
            'email.unique' => ':attribute đã tồn tại!',
            // 'phone.unique' => 'Đã tồn tại!',


        ];

    }
}
