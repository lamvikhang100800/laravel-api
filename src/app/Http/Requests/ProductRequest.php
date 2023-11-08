<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class ProductRequest extends FormRequest
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
            'product_name' => ['required','string','max:255'],
            'product_init' => ['required','string','max:255'],
            'product_price' => ['required','integer'],
            'product_quantity' => ['required','integer'],
            'product_isActive' => ['required','boolean'],
            'category_id' => ['required','integer','exists:categories,category_id'],
            
        ];
        if ($this->method() === 'POST'){
            $rules['product_name'] = ['required','string','unique:products,product_name' ,'max:255'];
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
