<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSite extends FormRequest {

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
            "ar_title" => "required",
            "en_title" => "required",
            "ar_desc" => "required",
            "en_desc" => "required",
            "tags" => "required",
            "whatsapp" => "required",
            "phone" => "required",
            "email" => "required|email",
            'map' => "required|url",
            "ios" => "required|url",
            "android" => "required|url",
            "childern" => "mimes:jpeg,jpg,png,bmp,gif,svg",
            "families" => "mimes:jpeg,jpg,png,bmp,gif,svg",
            "teachers" => "mimes:jpeg,jpg,png,bmp,gif,svg",
        ];
    }

}
