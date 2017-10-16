<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductCategoryStore extends FormRequest
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
            'descriptions.*.title'            => trans('admin::productCategory.form.title'),
            'descriptions.*.meta_title'       => trans('admin::productCategory.form.meta_title'),
            'descriptions.*.meta_description' => trans('admin::productCategory.form.meta_description'),
            'descriptions.*.meta_keyword'     => trans('admin::productCategory.form.meta_keyword'),
        ];
    }
}
