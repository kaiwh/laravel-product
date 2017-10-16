<?php

namespace App\Http\Controllers\Desktop;

use App\Http\Controllers\Controller;
use App\Repositories\ProductOrderRepository;
use Auth;

class ProductOrderController extends Controller
{
    protected $repository;
    public function __construct(ProductOrderRepository $repository)
    {
        $this->middleware('auth:user');
        $this->repository = $repository;
    }
    public function index()
    {
        $orders = $this->repository->paginate([
            'user_id' => Auth::guard('user')->user()->id,
        ]);

        return view('desktop::product.order.index')
            ->with('orders', $orders);
    }
    public function show($id)
    {
        $order = $this->repository->first($id);

        return view('desktop::product.order.show')
            ->with('order', $order);
    }
}
