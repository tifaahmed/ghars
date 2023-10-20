<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeacherVideo extends FormRequest {

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
            'active' => 'required',
            'teacher_id' => 'required',
            'ar_name' => 'required',
            'en_name' => 'required',
            'link' => 'required|url',
            "image" => "required|mimes:jpeg,jpg,png,bmp,gif,svg",
        ];
    }

}
