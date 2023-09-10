<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'thumb' => 'required',
//            'file' => 'required',
        ];
    }

    public function messages() {
        return [
            'name.required' => 'please enter product name',
            'thumb.required' => 'please add image file',
        ];
    }
}
