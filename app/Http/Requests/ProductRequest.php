<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
           
            'category_id' => [
                'required',
                'integer',
                'min:1'
            ],
            'brand_id' => [
                'required',
                'integer',
                'min:1'
            ],
             'name' => 'required|max:100',
            'slug' => 'required|max:100|unique:categories,slug|regex:~^[-_a-z0-9]+$~i',
            'image' => 'mimes:jpeg,jpg,png|max:5000',
        ];
    }
}
