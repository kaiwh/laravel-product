<?php

namespace App\Http\Controllers\Desktop;

use App\Http\Controllers\Controller;
use App\Repositories\ProductCartRepository;
use App\Repositories\ProductOrderRepository;
use Auth;
use Illuminate\Http\Request;
use Redirect;

class ProductConfirmController extends Controller
{
    protected $cart;
    protected $order;
    public function __construct(ProductCartRepository $cart, ProductOrderRepository $order)
    {
        $this->middleware('auth:user');
        $this->cart  = $cart;
        $this->order = $order;
    }
    public function index(Request $request)
    {
        $products = $this->cart->products(Auth::guard('user')->user());
        if (!$products) {
            return Redirect::to('/');
        }

        $address = Auth::guard('user')->user()->addresses()->where('id', $request->get('address_id'))->first();

        if (is_null($address)) {
            return Redirect::to('/');
        }

        $total = $this->cart->getTotal();

        $data = [];

        $data['user_id'] = Auth::guard('user')->user()->id;
        $data['email']   = Auth::guard('user')->user()->email;
        $data['mobile']  = Auth::guard('user')->user()->mobile;
        $data['name']    = Auth::guard('user')->user()->name;
        $data['image']   = Auth::guard('user')->user()->image;

        $data['total']           = $total;
        $data['order_status_id'] = 1;

        $data['ip']              = $request->ip();
        $data['user_agent']      = $request->server()['HTTP_USER_AGENT'];
        $data['accept_language'] = $request->server()['HTTP_ACCEPT_LANGUAGE'];

        $data['shipping'] = $address->toArray();

        $data['products'] = [];
        foreach ($products as $key => $value) {
            $data['products'][] = [
                'product_id' => $value['product_id'],
                'option_id'  => $value['option_id'],
                'title'      => $value['title'],
                'price'      => $value['price'],
                'quantity'   => $value['quantity'],
                'total'      => $value['total'],
                'subtract'   => $value['subtract'],
            ];
        }

        $this->order->store($data);

        $this->cart->clear();

        return Redirect::to('/');

    }
}
