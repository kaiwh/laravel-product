<?php

namespace App\Http\Controllers\Desktop;

use App\Http\Controllers\Controller;
use App\Repositories\ProductRepository;

class ProductController extends Controller
{
    private $model;
    public function __construct(ProductRepository $repository)
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
        $products = $this->model->paginate([
            'status' => 1,
        ]);

        return view('desktop::product.index')
            ->with('products', $products);
    }
    /**
     * Show Product
     *
     * @return 视图
     */
    public function show($id)
    {
        $product = $this->model->enabled($id);

        if (!$product) {
            return view('errors.404');
        }

        return view('desktop::product.show')
            ->with('product', $product);
    }
}
