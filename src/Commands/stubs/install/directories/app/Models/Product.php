<?php

namespace App\Models;

use App;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /*
     * Descriptions
     */
    public function descriptions()
    {
        return $this->hasMany('App\Models\ProductDescription', 'product_id');
    }
    /*
     * 当前语言
     */
    public function description()
    {
        return $this->hasOne('App\Models\ProductDescription', 'product_id')->where('language', App::getLocale());
    }

    /*
     * Images
     */
    public function images()
    {
        return $this->hasMany('App\Models\ProductImage', 'product_id')->orderBy('sort_order', 'ASC');
    }

    /*
     * Categories
     */
    public function toCategories()
    {
        return $this->hasMany('App\Models\ProductToCategory', 'product_id');
    }
    /*
     * Categories
     */
    public function categories()
    {
        return $this->hasManyThrough('App\Models\ProductCategory', 'App\Models\ProductToCategory', 'product_id', 'id');
    }

    /*
     * Options
     */
    public function options()
    {
        return $this->hasMany('App\Models\ProductOption', 'product_id')->orderBy('sort_order', 'ASC');
    }
    /*
     * OptionDescriptions
     */
    public function optionDescriptions()
    {
        return $this->hasMany('App\Models\ProductOptionDescription', 'product_id');
    }
}
