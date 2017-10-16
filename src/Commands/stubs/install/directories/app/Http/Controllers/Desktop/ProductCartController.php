<?php

namespace App\Http\Controllers\Desktop;

use App\Http\Controllers\Controller;
use App\Repositories\ProductCartRepository;
use App\Repositories\ProductRepository;
use Auth;
use Illuminate\Http\Request;

class ProductCartController extends Controller
{
    protected $product;
    protected $productCart;
    public function __construct(ProductRepository $product, ProductCartRepository $productCart)
    {
        $this->product      = $product;
        $this->productCart = $productCart;
        // $this->middleware('auth:user');
    }
    public function index()
    {
        $products = $this->productCart->products(Auth::guard('user')->user());

        $total = $this->productCart->getTotal();
        // dd($products);
        return view('desktop::product.cart.index')
            ->with('products', $products)
            ->with('total', $total);
    }
    /*
     * 商品加入购物车
     *
     */
    public function store(Request $request)
    {
        $json = [];

        $user_id    = Auth::guard('user')->user()->id;
        $product_id = $request->get('product_id') ? (int) $request->get('product_id') : 0;
        $option_id  = $request->get('option_id') ? (int) $request->get('option_id') : 0;
        $quantity   = $request->get('quantity') ? (int) $request->get('quantity') : 1;

        $product = $this->product->enabled($product_id);

        if (!is_null($product)) {

            if ($quantity < $product->minimum) {
                $quantity = $product->minimum;
            }

            $product_option = $product->options->where('id', $option_id)->first();

            if (Auth::guard('user')->guest()) {
                $json['error'] = trans('desktop::productCart.error.login');
            } elseif ($product->option_status && is_null($product_option)) {
                $json['error'] = trans('desktop::productCart.error.option');
            } elseif (is_null($product_option) && ($product->quantity < $quantity)) {
                $json['error'] = trans('desktop::productCart.error.stock');
            } elseif (!is_null($product_option) && ($product_option->quantity < $quantity)) {
                $json['error'] = trans('desktop::productCart.error.stock');
            }

            // $json['product']           = $product;
            // $json['product']['option'] = $product_option;

            if (empty($json['error'])) {
                $productCart = $this->productCart->find($user_id, $product_id, $option_id);

                if (is_null($productCart)) {
                    $this->productCart->store($user_id, $product_id, $option_id, $quantity);
                } else {
                    $quantity += $productCart->quantity;
                    if (!is_null($product_option) && $product_option->quantity < $quantity) {
                        $quantity = $product_option->quantity;
                    } elseif ($product->quantity < $quantity) {
                        $quantity = $product->quantity;
                    }
                    $this->productCart->update($productCart, $quantity);
                }
                $json['success'] = trans('desktop::productCart.success.store');
            }
        }

        return response()
            ->json($json);
    }
    /*
     * 修改购物车商品
     *
     */
    public function update()
    {

    }
    /*
     * 删除购物车商品
     *
     */
    public function destory()
    {

    }
}
