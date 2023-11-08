<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;


class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = auth()->user();
        if($user->roles == 'admin'){
            return true ;
        }else{
            return  abort(response()->json(['error' => 'Your account does not have access !'], 403));
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'category_name' => ['required','string','max:255'],
            'category_isActive' => ['required','boolean']
        ];
        if ($this->method() === 'POST'){
            $rules['category_name'] = ['required','string','unique:categories,category_name' ,'max:255'];
        }
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
