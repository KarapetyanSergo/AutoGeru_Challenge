<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => 'required|string',
            'type'  => 'required|string',
            'price' =>  'required|numeric',
        ];
    }
}
