<?php

namespace App\Repositories;

use App\Models\ProductCart;
use App\Models\User;
use Kaiwh\Admin\Traits\Repository;
use Auth;
use DB;

class ProductCartRepository
{
    use Repository;
    protected $products = [];
    protected $productRepository;
    public function __construct(ProductCart $productCart, productRepository $productRepository)
    {
        $this->model = $productCart;

        $this->productRepository = $productRepository;
    }
    /**
     * Filter eloquent
     *
     * @return Void
     */
    protected function filter($query, $filter)
    {
        if (isset($filter['user_id']) && !is_null($filter['user_id'])) {
            $query->where('user_id', (int) $filter['user_id']);
        }
        if (isset($filter['product_id']) && !is_null($filter['product_id'])) {
            $query->where('product_id', (int) $filter['product_id']);
        }
        if (isset($filter['option_id']) && !is_null($filter['option_id'])) {
            $query->where('option_id', (int) $filter['option_id']);
        }
    }
    public function find($user_id, $product_id, $option_id)
    {
        return $this->model
            ->where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->where('option_id', $option_id)->first();
    }
    /**
     * Store
     *
     */
    public function store($user_id, $product_id, $option_id = 0, $quantity = 1)
    {
        DB::transaction(function () use ($user_id, $product_id, $option_id, $quantity) {
            $this->model->user_id    = $user_id;
            $this->model->product_id = $product_id;
            $this->model->option_id  = $option_id;
            $this->model->quantity   = $quantity;
            $this->model->save();
        });
    }
    /**
     * Update
     *
     * @return Void
     */
    public function update(ProductCart $productCart, $quantity = 1)
    {
        DB::transaction(function () use ($productCart, $quantity) {
            $productCart->quantity = $quantity;
            $productCart->save();
        });
    }
    /**
     * Destroy
     *
     * @return Void
     */
    public function destroy(ProductCart $productCart)
    {
        DB::transaction(function () use ($productCart) {
            $productCart->delete();
        });
    }
    public function truncate()
    {
    }

    /**
     * Products
     *
     */
    public function clear()
    {
        $productCarts = $this->all([
            'user_id' => Auth::guard('user')->user()->id,
        ]);

        foreach ($productCarts as $value) {
            $this->destroy($value);
        }
    }
    public function products()
    {
        if (!$this->products) {
            $this->setProducts();
        }
        return $this->products;
    }
    public function getTotal()
    {
        $total = 0;
        foreach ($this->products() as $value) {
            $total += (float) $value['total'];
        }
        return $total;
    }
    public function setProducts()
    {
        $productCarts = $this->all([
            'user_id' => Auth::guard('user')->user()->id,
        ]);
        $products = [];
        foreach ($productCarts as $value) {
            $product = $this->setProduct($value);
            if (is_null($product)) {
                $this->destroy($value);
            } else {
                $products[$product['key']] = $product;
            }
        }
        $this->products = $products;
    }
    public function setProduct(ProductCart $productCart)
    {
        $product = $this->productRepository->enabled($productCart->product_id);
        if (is_null($product)) {
            return null;
        }

        $product_option = $product->options->where('id', $productCart->option_id)->first();
        if ($productCart->option_id && is_null($product_option)) {
            return null;
        }

        return [
            'key'        => $this->getKey($productCart->product_id, $productCart->option_id),
            'product_id' => $productCart->product_id,
            'option_id'  => $productCart->option_id,
            'quantity'   => $productCart->quantity,
            'title'      => $product_option ? $product_option->description->title : $product->description->title,
            'image'      => $product_option ? $product_option->image : $product->image,
            'price'      => $product_option ? $product_option->price : $product->price,
            'total'      => $product_option ? $product_option->price * $productCart->quantity : $product->price * $productCart->quantity,
            'subtract'   => $product_option ? $product_option->subtract : $product->subtract,
        ];
    }
    public function getKey($product_id, $option_id = 0)
    {
        $product = [];

        $product['product_id'] = (int) $product_id;

        if ($option_id) {
            $product['option_id'] = (int) $option_id;
        }
        return base64_encode(serialize($product));
    }
}
