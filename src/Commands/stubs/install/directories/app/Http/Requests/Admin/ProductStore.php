<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductStore extends FormRequest
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
            'descriptions.*.title'            => 'required|string|max:255',
            'descriptions.*.meta_title'       => 'required|string|max:255',
            'descriptions.*.meta_description' => 'required|string|max:255',
            'descriptions.*.meta_keyword'     => 'required|string|max:255',
            'price'                           => 'required|price',
            'quantity'                        => 'required|integer',
            'minimum'                         => 'required|integer|min:1',
            'options.*.price'                 => 'required|price',
            'options.*.quantity'              => 'required|integer',
        ];
    }
    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'descriptions.*.title'            => trans('admin::product.form.title'),
            'descriptions.*.meta_title'       => trans('admin::product.form.meta_title'),
            'descriptions.*.meta_description' => trans('admin::product.form.meta_description'),
            'descriptions.*.meta_keyword'     => trans('admin::product.form.meta_keyword'),
            'price'                           => trans('admin::product.form.price'),
            'quantity'                        => trans('admin::product.form.quantity'),
            'minimum'                         => trans('admin::product.form.minimum'),
            'options.*.price'                 => trans('admin::product.form.price'),
            'options.*.quantity'              => trans('admin::product.form.quantity'),
        ];
    }
}
