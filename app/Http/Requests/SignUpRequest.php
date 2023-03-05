<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SignUpRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'string|required',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|confirmed',
            'user_type' => [
                'required',
                Rule::in(User::TYPES)
            ]
        ];
    }
}
