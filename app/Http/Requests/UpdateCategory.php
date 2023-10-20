<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategory extends FormRequest {

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
            "ar_name" => "required|unique:categories,ar_name,$id,id,deleted_at,NULL",
            "en_name" => "required|unique:categories,en_name,$id,id,deleted_at,NULL",
            "image" => "mimes:jpeg,jpg,png,bmp,gif,svg",
        ];
    }

}
