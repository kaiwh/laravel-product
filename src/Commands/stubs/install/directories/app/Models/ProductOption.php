<?php

namespace App\Models;

use App;
use Illuminate\Database\Eloquent\Model;

class ProductOption extends Model
{
    public $timestamps = false;

    /*
     * Descriptions
     */
    public function descriptions()
    {
        return $this->hasMany('App\Models\ProductOptionDescription', 'option_id');
    }
    /*
     * 当前语言
     */
    public function description()
    {
        return $this->hasOne('App\Models\ProductOptionDescription', 'option_id')->where('language', App::getLocale());
    }
}
