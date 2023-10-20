<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSlider extends FormRequest {

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
            'sort' => 'required|numeric',
            'en_name' => 'required',
            'ar_name' => 'required',
            'link' => 'required|url',
            "image" => "mimes:jpeg,jpg,png,bmp,gif,svg",
        ];
    }

}
