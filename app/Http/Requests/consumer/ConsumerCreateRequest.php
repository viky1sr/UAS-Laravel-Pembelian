<?php

namespace App\Http\Requests\consumer;

use Illuminate\Foundation\Http\FormRequest;

class ConsumerCreateRequest extends FormRequest
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
            'nama_konsumer' => 'required|unique:consumers',
            'alamat' => 'required'
        ];
    }
}
