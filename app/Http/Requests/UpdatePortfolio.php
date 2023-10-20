<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePortfolio extends FormRequest {

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
            'active' => 'required',
            'user_id' => 'required',
            'ar_name' => 'required',
            'en_name' => 'required',
            "image" => "mimes:jpeg,jpg,png,bmp,gif,svg",
            "images" => "array|mimes:jpeg,jpg,png,bmp,gif,svg",
        ];
    }

}
