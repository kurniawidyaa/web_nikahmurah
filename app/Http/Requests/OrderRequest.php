<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'user_id' => 'required',
            'order_status' => 'required',
            'order_time' => 'required',
            'subtotal' => 'required',
            'total' => 'required',
            'payment_status' => 'required',
            'payment_link' => 'required',
            'jml_cicilan' => 'required',

        ];
    }
}
