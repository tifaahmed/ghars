<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCountry extends FormRequest {

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
            //
            "active" => "required",
            "ar_name" => "required|unique:countries,ar_name,$id",
            "en_name" => "required|unique:countries,en_name,$id",
            "code" => "required",
        ];
    }

}
