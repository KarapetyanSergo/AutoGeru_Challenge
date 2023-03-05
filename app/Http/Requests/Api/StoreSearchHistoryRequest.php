<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreSearchHistoryRequest extends FormRequest
{
    public function rules()
    {
        return [
            'max_price' => 'required|numeric',
            'min_price' => 'required|numeric',
            'type' => 'required',
        ];
    }
}
