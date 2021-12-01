<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'storeName' => 'required|string|min:3|max:50',
            'storePhone' => 'required|numeric|min:000000001|max:999999999999999',
            'storeLat' => 'required|numeric|min:000000001|max:9999999999999',
            'storeLng' => 'required|numeric|min:000000001|max:9999999999999',
            'storeGenreId' => 'required|numeric|min:0|max:9999',
            'storeLogo' => 'required',
        ];
    }


    // public function messages()
    // {
    //     return [
    //         'storeName.required' => 'Store name is required',
    //         'storeName.string' => 'Store name should be text',
    //         'storeName.min:3' => 'Store name should be more than (2) characters',
    //         'storeName.max:50' => 'Store name should be less than (50) characters',

    //         'storePhone.required' => 'Store phone is required',
    //         'storePhone.numeric' => 'Store phone should be a number',
    //         'storePhone.min:8' => 'Store phone should be more than (9) numbers',
    //         'storePhone.max:50' => 'Store phone should be less than (50) characters',

    //         'storeLat.required' => 'Store latitude is required',
    //         'storeLat.numeric' => 'Store latitude should be a number',
    //         'storeLat.min:8' => 'Store latitude should be more than (9) numbers',
    //         'storeLat.max:50' => 'Store latitude be less than (50) characters',

    //         'storeLng.required' => 'Store longitude is required',
    //         'storeLng.numeric' => 'Store longitude should be a number',
    //         'storeLng.min:8' => 'Store longitude should be more than (9) numbers',
    //         'storeLng.max:50' => 'Store longitude should be less than (50) characters',

    //         'storeGenreId.required' => 'Store Genre is required',
    //         'storeGenreId.numeric' => 'Store Genre should be a selected',

    //         'storeLogo.required' => 'Store photo is required'
    //     ];
    // }
}
