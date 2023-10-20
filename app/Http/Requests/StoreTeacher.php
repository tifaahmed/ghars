<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeacher extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'active' => 'required',
            'country_id' => 'required',
            'gender' => 'required',
            'ar_name' => 'required',
            'en_name' => 'required',
            'ar_nationality' => 'required',
            'en_nationality' => 'required',
            'birth_date' => 'required',
            'ar_address' => 'required',
            'en_address' => 'required',
            'ar_status' => 'required',
            'en_status' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'ar_qualification' => 'required',
            'en_qualification' => 'required',
            'ar_qualification_source' => 'required',
            'en_qualification_source' => 'required',
            'qualification_date' => 'required',
            'ar_specialization' => 'required',
            'en_specialization' => 'required',
            'ar_career' => 'required',
            'en_career' => 'required',
            'ar_quran' => 'required',
            'en_quran' => 'required',
            'responsible_country_id' => 'required',
            'ar_responsible_address' => 'required',
            'en_responsible_address' => 'required',
            'responsible_email' => 'required|email',
            'responsible_phone' => 'required',
            'ar_responsible' => 'required',
            'en_responsible' => 'required',
            'amount' => 'required',
            "image" => "required|mimes:jpeg,jpg,png,bmp,gif,svg",
        ];
    }

}
