<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductStore;
use App\Http\Requests\Admin\ProductUpdate;
use App\Repositories\ProductRepository as ProductRepository;
use Illuminate\Http\Request;
use Redirect;

class ProductController extends Controller
{
    protected $repository;
    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }
    /**
     * 列表
     *
     * @return 视图
     */
    public function index()
    {
        $products = $this->repository->paginate();

        return view('admin::product.product.index')
            ->with('products', $products);
    }
    /**
     * 新增
     *
     * @return 视图
     */
    public function create(Request $request)
    {
        return view('admin::product.product.create');
    }
    /**
     * 添加分类
     *
     * @param Illuminate\Http\Request $request
     * @return Redirect
     */
    public function store(ProductStore $request)
    {
        $this->repository->store($request->all());

        return Redirect::route('admin.product.index');
    }
    /**
     * 编辑
     *
     * @return 视图
     */
    public function edit(Request $request, $id)
    {
        $product = $this->repository->first($id);

        if (is_null($product)) {
            return Redirect::route('admin.product.index');
        }

        return view('admin::product.product.edit')
            ->with('product', $product);
    }
    /**
     * 修改分类
     *
     * @param Illuminate\Http\Request $request
     * @param $id
     * @return Redirect
     */
    public function update(ProductUpdate $request, $id)
    {

        $product = $this->repository->first($id);

        if (!is_null($product)) {
            $this->repository->update($product, $request->all());
        }

        return Redirect::route('admin.product.index');
    }

    /**
     * 删除分类 (子类也会删除)
     *
     * @return 视图
     */
    public function destroy($id)
    {
        $product = $this->repository->first($id);

        if (!is_null($product)) {
            $this->repository->destroy($product);
        }

        return Redirect::route('admin.product.index');
    }
}
