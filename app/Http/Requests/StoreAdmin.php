<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdmin extends FormRequest {

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
            //
            "email" => "required|email|unique:users,email,null,id,deleted_at,NULL",
            "group_id" => "required",
            "name" => "required|unique:users,name,null,id,deleted_at,NULL",
            "country_id" => "required",
            "phone" => "required|numeric|unique:users,phone,null,id,deleted_at,NULL",
            "password" => "required",
        ];
    }

}
