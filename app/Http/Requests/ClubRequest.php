<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClubRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    //TODO: change rule for country_code to only accept vale in App\Http\Utilities\Country
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>['required','unique:clubs','max:255'],
            'phone'=>['max:50'],
            'email'=>['max:255'],
            'city'=>['max:100'],
            'country_code'=>['max:2']
        ];
    }
}
