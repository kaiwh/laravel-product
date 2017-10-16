<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\ProductOrderRepository;

class ProductOrderController extends Controller
{
    private $model;
    public function __construct(ProductOrderRepository $repository)
    {
        $this->model = $repository;
    }
    /**
     * 列表
     *
     * @return 视图
     */
    public function index()
    {
        $orders = $this->model->paginate();

        return view('admin::product.order.index')
            ->with('orders', $orders);
    }
    /**
     * Show Media
     *
     * @return 视图
     */
    public function show($id)
    {
        $order = $this->model->first($id);

        return view('admin::product.order.show')
            ->with('order', $order);
    }
}
