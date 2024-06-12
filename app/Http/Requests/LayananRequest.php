<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LayananRequest extends FormRequest
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
            'category_id' => 'required',
            'name' => 'required',
            'thumbnail' => ['image', 'file', 'mimes:jpeg,jpg,png', 'max:1024'],
            'description' => 'required',
            // 'note' => 'required',
            'qty' => 'required',
            'price' => ['required', 'min:5', 'max:12']

        ];
    }
}
