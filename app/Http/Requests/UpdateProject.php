<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProject extends FormRequest {

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
            'ar_name' => 'required',
            'en_name' => 'required',
            'category_id' => 'required',
            'step_id'=>'required',
            'country_id' => 'required',
            'amount' => 'required',
            'collect' => 'required',
            'type' => 'required',
            'user_id' => 'required_if:type,private',
            "image" => "mimes:jpeg,jpg,png,bmp,gif,svg",
        ];
    }

}
