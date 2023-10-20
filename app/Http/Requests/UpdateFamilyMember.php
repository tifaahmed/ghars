<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFamilyMember extends FormRequest {

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
        $id = $this->segment(3);
        return [
            'active' => 'required',
            'gender' => 'required',
            'birth_date'=>'required',
            'ar_name' => 'required',
            'en_name' => 'required',
            'ar_civil_type' => 'required',
            'en_civil_type' => 'required',
            'civil_id' => 'required',
            'ar_career_status' => 'required',
            'en_career_status' => 'required',
            'ar_healthy' => 'required',
            'en_healthy' => 'required',
            'ar_psychological' => 'required',
            'en_psychological' => 'required',
            "image" => "mimes:jpeg,jpg,png,bmp,gif,svg",
        ];
    }

}
