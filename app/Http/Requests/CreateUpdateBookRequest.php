<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUpdateBookRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required',
            'subtitle' => 'nullable',
            'description' => 'nullable',
            'language' => 'required',
            'price' => 'required|numeric|between:5,500',
            'quantity' => 'required|integer|between:1,500',
            'image' => 'nullable|mimes:jpg,jpeg,png,bmp,webp',
            'weight' => 'nullable',
            'width' => 'nullable',
            'height' => 'nullable',
            'length' => 'nullable',
            'pages' => 'nullable|integer',
            'isbn' => 'required|numeric|unique:books|min:9|max:13',
            'year' => 'nullable|integer|between:1000,'.date('y'),
            'genre_id' => 'required|exists:genre,id',
            'author_id' => 'required|exists:author,id',
            'publisher_id' => 'required|exists:publisher,id',
        ];
    }
}
