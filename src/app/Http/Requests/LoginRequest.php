<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'email' => ['required','email','max:255','exists:users,email'],
            'password' => ['required','string','max:255']
        ];

        return  $rules;
    }
    public function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json([
            'status' => 400 ,
            'message' => 'Validation Error !',
            'error' => $validator->errors()
        ],400));
        
    }
}
