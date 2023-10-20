<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGift extends FormRequest {

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
            "ar_name" => "required",
            "en_name" => "required",
            "amount" => "required",
            "sort" => "required|numeric",
            "image" => "required|mimes:jpeg,jpg,png,bmp,gif,svg",
        ];
    }

}
