<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\ProductCartRepository;
use App\Repositories\productRepository;

class ProductCartProductRepository
{
    protected $product;
    protected $productCart;
    public function __construct(productRepository $product, ProductCartRepository $productCart)
    {
        $this->product      = $product;
        $this->productCart = $productCart;
    }
    protected $products = [];
    public function products(User $user)
    {
        if (!$this->products) {
            $this->setProducts($user);
        }
        return $this->products;
    }
    public function setProducts(User $user)
    {
        $productCarts = $this->all([
            'user_id' => $user->id,
        ]);
        $products = [];
        foreach ($productCarts as $value) {
            $products[] = $this->setProduct($value);
        }
        $this->products = $products;
    }
    public function setProduct(ProductCart $productCart)
    {
        $product = $this->product->enabled($productCart->product_id);
        if (is_null($product)) {
            return null;
        }

        $product_option = $product->options->where('id', $productCart->option_id)->first();
        if ($productCart->option_id && is_null($product_option)) {
            return null;
        }
        return [
            'product_id' => $productCart->product_id,
            'option_id'  => $productCart->option_id,
            'quantity'   => $productCart->quantity,
            'title'      => $product_option ? $product_option->description->title : $product->description->title,
            'image'      => $product_option ? $product_option->image : $product->image,
            'price'      => $product_option ? $product_option->price : $product->price,
            'total'      => $product_option ? $product_option->price * $productCart->quantity : $product->price * $productCart->quantity,
        ];

    }
}
