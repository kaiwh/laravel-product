<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\ProductDescription;
use App\Models\ProductImage;
use App\Models\ProductOption;
use App\Models\ProductOptionDescription;
use App\Models\ProductToCategory;
use Kaiwh\Admin\Traits\Repository;
use DB;

class ProductRepository
{
    use Repository;
    public function __construct(Product $product)
    {
        $this->model = $product;
    }
    /**
     * Filter eloquent
     *
     * @return Void
     */
    protected function filter($query, $filter)
    {
        if (isset($filter['status']) && !is_null($filter['status'])) {
            $query->where('status', (int) $filter['status']);
        }
    }

    /**
     * Store
     *
     * @return \App\Models\Product id
     */
    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {

            $this->model->image         = $data['image'];
            $this->model->price         = (float) $data['price'];
            $this->model->quantity      = (int) $data['quantity'];
            $this->model->minimum       = (int) $data['minimum'];
            $this->model->subtract      = (int) $data['subtract'];
            $this->model->option_status = (int) $data['option_status'];
            $this->model->status        = (int) $data['status'];
            $this->model->save();

            // Description
            $descriptions = [];
            foreach ($data['descriptions'] as $code => $value) {
                $descriptions[$code]                   = new ProductDescription;
                $descriptions[$code]->language         = $code;
                $descriptions[$code]->title            = $value['title'];
                $descriptions[$code]->summary          = $value['summary'];
                $descriptions[$code]->description      = $value['description'];
                $descriptions[$code]->meta_title       = $value['meta_title'];
                $descriptions[$code]->meta_description = $value['meta_description'];
                $descriptions[$code]->meta_keyword     = $value['meta_keyword'];
                $descriptions[$code]->option_title     = $value['option_title'];
            }
            $this->model->descriptions()->saveMany($descriptions);

            if (!empty($data['images'])) {
                $images = [];
                foreach ($data['images'] as $k => $value) {
                    $images[$k]             = new ProductImage;
                    $images[$k]->image      = $value['image'];
                    $images[$k]->title      = $value['title'];
                    $images[$k]->sort_order = (int) $value['sort_order'];
                }
                $this->model->images()->saveMany($images);
            }
            if (!empty($data['categories'])) {
                $categories = [];
                foreach ($data['categories'] as $k => $value) {
                    $categories[$k]              = new ProductToCategory;
                    $categories[$k]->category_id = $value;
                }
                $this->model->toCategories()->saveMany($categories);
            }
            if (!empty($data['options'])) {
                foreach ($data['options'] as $k => $option) {
                    $productOption             = new ProductOption;
                    $productOption->image      = $option['image'];
                    $productOption->price      = (float) $option['price'];
                    $productOption->quantity   = (int) $option['quantity'];
                    $productOption->subtract   = (int) $option['subtract'];
                    $productOption->sort_order = (int) $option['sort_order'];

                    $productOption = $this->model->options()->save($productOption);

                    foreach ($option['descriptions'] as $language => $value) {
                        $description             = new ProductOptionDescription;
                        $description->product_id = $this->model->id;
                        $description->language   = $language;
                        $description->title      = $value['title'];
                        $productOption->descriptions()->save($description);
                    }
                }

            }
            return $this->model->id;
        });
    }
    /**
     * Update
     *
     * @return Void
     */
    public function update(Product $product, array $data)
    {
        DB::transaction(function () use ($product, $data) {
            $product->image         = $data['image'];
            $product->price         = (float) $data['price'];
            $product->quantity      = (int) $data['quantity'];
            $product->minimum       = (int) $data['minimum'];
            $product->subtract      = (int) $data['subtract'];
            $product->option_status = (int) $data['option_status'];
            $product->status        = (int) $data['status'];
            $product->save();

            // Description
            $product->descriptions()->delete();

            $descriptions = [];
            foreach ($data['descriptions'] as $code => $value) {
                $descriptions[$code]                   = new ProductDescription;
                $descriptions[$code]->language         = $code;
                $descriptions[$code]->title            = $value['title'];
                $descriptions[$code]->summary          = $value['summary'];
                $descriptions[$code]->description      = $value['description'];
                $descriptions[$code]->meta_title       = $value['meta_title'];
                $descriptions[$code]->meta_description = $value['meta_description'];
                $descriptions[$code]->meta_keyword     = $value['meta_keyword'];
                $descriptions[$code]->option_title     = $value['option_title'];
            }
            $product->descriptions()->saveMany($descriptions);

            $product->images()->delete();
            if (!empty($data['images'])) {
                $images = [];
                foreach ($data['images'] as $k => $value) {
                    $images[$k]             = new ProductImage;
                    $images[$k]->image      = $value['image'];
                    $images[$k]->title      = $value['title'];
                    $images[$k]->sort_order = (int) $value['sort_order'];
                }
                $product->images()->saveMany($images);
            }
            $product->toCategories()->delete();
            if (!empty($data['categories'])) {
                $categories = [];
                foreach ($data['categories'] as $k => $value) {
                    $categories[$k]              = new ProductToCategory;
                    $categories[$k]->category_id = $value;
                }
                $product->toCategories()->saveMany($categories);
            }
            $product->optionDescriptions()->delete();
            $product->options()->delete();
            if (!empty($data['options'])) {
                foreach ($data['options'] as $k => $option) {
                    $productOption             = new ProductOption;
                    $productOption->image      = $option['image'];
                    $productOption->price      = (float) $option['price'];
                    $productOption->quantity   = (int) $option['quantity'];
                    $productOption->subtract   = (int) $option['subtract'];
                    $productOption->sort_order = (int) $option['sort_order'];

                    $productOption = $product->options()->save($productOption);

                    foreach ($option['descriptions'] as $language => $value) {
                        $description             = new ProductOptionDescription;
                        $description->product_id = $product->id;
                        $description->language   = $language;
                        $description->title      = $value['title'];
                        $productOption->descriptions()->save($description);
                    }
                }

            }
        });
    }
    /**
     * Destroy
     *
     * @return Void
     */
    public function destroy(Product $product)
    {
        DB::transaction(function () use ($product) {
            $product->optionDescriptions()->delete();
            $product->options()->delete();
            $product->toCategories()->delete();
            $product->images()->delete();
            $product->descriptions()->delete();
            $product->delete();
        });
    }

    public function truncate()
    {
    }
}
