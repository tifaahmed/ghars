<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompany extends FormRequest {

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
            "email" => "required|email|unique:users,email,$id,id,deleted_at,NULL",
            "name" => "required|unique:users,name,$id,id,deleted_at,NULL",
            "ar_name" => "required|unique:users,ar_name,$id,id,deleted_at,NULL",
            "en_name" => "required|unique:users,en_name,$id,id,deleted_at,NULL",
            "country_id" => "required",
            "phone" => "required|numeric|unique:users,phone,$id,id,deleted_at,NULL",
        ];
    }

}
