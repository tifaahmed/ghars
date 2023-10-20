<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFamily extends FormRequest {

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
            'civil_id' => 'required',
            'ar_parent_status' => 'required',
            'en_parent_status' => 'required',
            'members_count' => 'required|numeric',
            'males' => 'required|numeric',
            'females' => 'required|numeric',
            'ar_responsible' => 'required',
            'en_responsible' => 'required',
            'ar_relative' => 'required',
            'en_relative' => 'required',
            'ar_career' => 'required',
            'ar_career' => 'required',
            'ar_career_status' => 'required',
            'en_career_status' => 'required',
            'responsible_civil_id' => 'required',
            'amount' => 'required',
            "image" => "required|mimes:jpeg,jpg,png,bmp,gif,svg",
        ];
    }

}
