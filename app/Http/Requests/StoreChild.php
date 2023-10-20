<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreChild extends FormRequest {

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
            'birth_date' => 'required',
            'birth_no' => 'required',
            'ar_nationality' => 'required',
            'en_nationality' => 'required',
            'ar_study_stage' => 'required',
            'en_study_stage' => 'required',
            'ar_class' => 'required',
            'en_class' => 'required',
            'ar_quran' => 'required',
            'en_quran' => 'required',
            'ar_psychological' => 'required',
            'en_psychological' => 'required',
            'ar_illness' => 'required',
            'en_illness' => 'required',
            'ar_healthy' => 'required',
            'en_healthy' => 'required',
            'death_date' => 'required',
            'ar_death_reason' => 'required',
            'en_death_reason' => 'required',
            'ar_responsible' => 'required',
            'en_responsible' => 'required',
            'ar_relative' => 'required',
            'en_relative' => 'required',
            'brothers' => 'required|numeric',
            'sisters' => 'required|numeric',
            'amount' => 'required',
            "image" => "required|mimes:jpeg,jpg,png,bmp,gif,svg",
        ];
    }

}
