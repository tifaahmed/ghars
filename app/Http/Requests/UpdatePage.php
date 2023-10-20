<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePage extends FormRequest {

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
            "ar_title" => "required|unique:pages,ar_title,$id",
            "en_title" => "required|unique:pages,en_title,$id",
            "ar_desc" => "required",
            "en_desc" => "required",
            "image" => "mimes:jpeg,jpg,png,bmp,gif,svg",
        ];
    }

}
