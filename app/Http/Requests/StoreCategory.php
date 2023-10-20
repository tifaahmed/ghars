<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategory extends FormRequest {

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
            "ar_name" => "required|unique:categories,ar_name,null,id,deleted_at,NULL",
            "en_name" => "required|unique:categories,en_name,null,id,deleted_at,NULL",
            "image" => "required|mimes:jpeg,jpg,png,bmp,gif,svg",
        ];
    }

}
