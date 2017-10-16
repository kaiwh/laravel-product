<?php

namespace App\Models;

use App;
use Illuminate\Database\Eloquent\Model;

class ProductOrder extends Model
{
    /*
     * Products
     */
    public function products()
    {
        return $this->hasMany('App\Models\ProductOrderProduct', 'order_id');
    }
    /*
     * Hostories
     */
    public function histories()
    {
        return $this->hasMany('App\Models\ProductOrderHistory', 'order_id');
    }
    /*
     * Totals
     */
    public function totals()
    {
        return $this->hasMany('App\Models\ProductOrderTotal', 'order_id');
    }
    /*
     * Shipping
     */
    public function shipping()
    {
        return $this->hasOne('App\Models\ProductOrderShipping', 'order_id');
    }
}
