<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'category_id' => 'required|exists:categories,id',
            'product_name' => 'required',
            'product_code' => 'required',
            'root' => 'required',
            'buying_price' => 'required',
            'selling_price' => 'required',
            'supplier_id' => 'required|exists:suppliers,id',
            'buying_date' => 'required',
            'product_quantity' => 'required',
        ];
    }
}
