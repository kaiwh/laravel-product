<?php

namespace App\Repositories;

use App\Models\ProductCategory as Category;
use App\Models\ProductCategoryDescription as CategoryDescription;
use Kaiwh\Admin\Traits\Repository;
use DB;

class ProductCategoryRepository
{
    use Repository;
    public function __construct(Category $category)
    {
        $this->model = $category;
    }
    /**
     * Filter eloquent
     *
     * @return Void
     */
    protected function filter($query, $filter)
    {
        if (isset($filter['parent_id']) && !is_null($filter['parent_id'])) {
            $query->where('parent_id', (int) $filter['parent_id']);
        }
        if (isset($filter['status']) && !is_null($filter['status'])) {
            $query->where('status', (int) $filter['status']);
        }
    }
    /**
     * Store
     *
     * @return \App\Models\ProductCategory id
     */
    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {

            $this->model->parent_id = $data['parent_id'] ? (int) $data['parent_id'] : 0;
            $this->model->image     = $data['image'];
            $this->model->status    = (int) $data['status'];

            $this->model->save();

            // Description
            $descriptions = [];
            foreach ($data['descriptions'] as $code => $value) {

                $descriptions[$code]                   = new CategoryDescription;
                $descriptions[$code]->language         = $code;
                $descriptions[$code]->title            = $value['title'];
                $descriptions[$code]->description      = $value['description'];
                // $descriptions[$code]->summary          = $value['summary'];
                $descriptions[$code]->meta_title       = $value['meta_title'];
                $descriptions[$code]->meta_description = $value['meta_description'];
                $descriptions[$code]->meta_keyword     = $value['meta_keyword'];
            }
            $this->model->descriptions()->saveMany($descriptions);

            return $this->model->id;
        });
    }
    /**
     * Update
     *
     * @return Void
     */
    public function update(Category $category, array $data)
    {
        DB::transaction(function () use ($category, $data) {
            $category->image  = $data['image'];
            $category->status = (int) $data['status'];

            $category->save();

            // Description
            $category->descriptions()->delete();

            $descriptions = [];
            foreach ($data['descriptions'] as $code => $value) {
                $descriptions[$code]                   = new CategoryDescription;
                $descriptions[$code]->language         = $code;
                $descriptions[$code]->title            = $value['title'];
                $descriptions[$code]->description      = $value['description'];
                // $descriptions[$code]->summary          = $value['summary'];
                $descriptions[$code]->meta_title       = $value['meta_title'];
                $descriptions[$code]->meta_description = $value['meta_description'];
                $descriptions[$code]->meta_keyword     = $value['meta_keyword'];
            }
            $category->descriptions()->saveMany($descriptions);
        });
    }
    /**
     * Destroy
     *
     * @return Void
     */
    public function destroy(Category $category)
    {
        DB::transaction(function () use ($category) {
            $this->delete($category);
        });
    }
    protected function delete(Category $category)
    {
        if ($category->childrens) {
            foreach ($category->childrens as $value) {
                $this->delete($value);
            }
        }
        $category->descriptions()->delete();
        $category->delete();
    }

    /**
     * 树状图
     *
     * @return \App\Models\ProductCategory
     */
    public function trees($filter = [])
    {
        $filter_parent              = $filter;
        $filter_parent['parent_id'] = 0;

        $results = $this->all($filter_parent);

        $trees = [];
        foreach ($results as $key => $value) {
            $trees[] = $this->treeRecursion($value, $filter);
        }
        return $trees;
    }
    protected function treeRecursion(Category $category, $filter = [])
    {
        $childrens = [];

        $categories = $category->childrens()->where(function ($query) use ($filter) {
            $this->filter($query, $filter);
        })->get();

        if ($categories) {
            foreach ($categories as $value) {
                $childrens[] = $this->treeRecursion($value, $filter);
            }
        }

        return [
            'id'        => $category->id,
            'title'     => $category->description->title,
            'childrens' => $childrens,
        ];
    }

    public function truncate()
    {
    }
}
