<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'brand' => 'required|string',
            'name' => 'required|string',
            'price' => 'required|integer',
            'quantity' => 'required|integer',
            'description' => 'required|min:3',
            'enabled' => $this->route('product') ? 'required' : '',
            'image' => $this->route('product') ? '' : 'required|image',
        ];
    }
}
