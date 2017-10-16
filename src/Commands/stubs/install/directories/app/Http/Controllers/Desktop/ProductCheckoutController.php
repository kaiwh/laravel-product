<?php

namespace App\Http\Controllers\Desktop;

use App\Http\Controllers\Controller;
use App\Repositories\ProductCartRepository;
use Auth;
use Redirect;

class ProductCheckoutController extends Controller
{
    protected $productCart;
    public function __construct(productCartRepository $productCart)
    {
        $this->middleware('auth:user');
        $this->productCart = $productCart;
    }
    public function index()
    {
        $products = $this->productCart->products(Auth::guard('user')->user());
        if (!$products) {
            return Redirect::to('/');
        }
        $total = $this->productCart->getTotal();
        // dd($products);
        return view('desktop::product.checkout.index')
            ->with('products', $products)
            ->with('total', $total);
    }
}
