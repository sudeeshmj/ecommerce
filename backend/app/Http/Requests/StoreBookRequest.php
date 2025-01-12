<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
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
        $rules =  [
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'author_id' => 'required|exists:authors,id',
            'language_id' => 'required|exists:languages,id',
            'publisher_id' => 'required|exists:publishers,id',
            'publishing_date' => 'required|date|before_or_equal:today',
            'edition' => 'required|integer|min:1',
            'format' => 'required|string',
            'isbn' => 'required|string',
            'pages' => 'required|integer|min:1',
            'summary' => 'required|string|max:1500',
            'subcategory' => 'required|array',
            'tag' => 'required|array',
            'status' => 'required',
            'price' => 'required|numeric|min:0',
            'offer_price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'threshold_stock' => 'nullable|integer|min:0',

        ];

        if ($this->isMethod('POST')) {
            $rules['book_image'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }

        return $rules;
    }
}
