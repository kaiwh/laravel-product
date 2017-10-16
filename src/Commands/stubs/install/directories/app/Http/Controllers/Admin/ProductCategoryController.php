<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductCategoryStore as CategoryStore;
use App\Http\Requests\Admin\ProductCategoryUpdate as CategoryUpdate;
use App\Repositories\ProductCategoryRepository as CategoryRepository;
use Illuminate\Http\Request;
use Redirect;

class ProductCategoryController extends Controller
{
    /**
     * @var categoryRepository
     */
    protected $repository;
    public function __construct(CategoryRepository $repository)
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
        $categories = $this->repository->all(['parent_id' => 0]);

        return view('admin::product.category.index')
            ->with('categories', $categories);
    }
    /**
     * 新增
     *
     * @return 视图
     */
    public function create(Request $request)
    {
        return view('admin::product.category.create');
    }
    /**
     * 添加分类
     *
     * @param Illuminate\Http\Request $request
     * @return Redirect
     */
    public function store(CategoryStore $request)
    {
        $this->repository->store($request->all());

        return Redirect::route('admin.product.category.index');
    }
    /**
     * 编辑
     *
     * @return 视图
     */
    public function edit(Request $request, $id)
    {
        $category = $this->repository->first($id);

        if (is_null($category)) {
            return Redirect::route('admin.product.category.index');
        }

        return view('admin::product.category.edit')
            ->with('category', $category);
    }
    /**
     * 修改分类
     *
     * @param Illuminate\Http\Request $request
     * @param Kai\Category\Models\Category $id
     * @return Redirect
     */
    public function update(CategoryUpdate $request, $id)
    {
        $category = $this->repository->first($id);

        if (!is_null($category)) {
            $this->repository->update($category, $request->all());
        }

        return Redirect::route('admin.product.category.index');
    }

    /**
     * 删除分类 (子类也会删除)
     *
     * @return 视图
     */
    public function destroy($id)
    {
        $category = $this->repository->first($id);

        if (!is_null($category)) {
            $this->repository->destroy($category);
        }

        return Redirect::route('admin.product.category.index');
    }
}
