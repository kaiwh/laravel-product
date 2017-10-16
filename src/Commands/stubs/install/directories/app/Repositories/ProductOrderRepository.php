<?php

namespace App\Repositories;

use App\Models\ProductOrder;
use App\Models\ProductOrderHistory;
use App\Models\ProductOrderProduct;
use App\Models\ProductOrderShipping;
use App\Models\ProductOrderTotal;
use DB;
use Kaiwh\Admin\Traits\Repository;

class ProductOrderRepository
{
    use Repository;
    public function __construct(ProductOrder $productOrder)
    {
        $this->model = $productOrder;
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
        if (isset($filter['order_status_id']) && !is_null($filter['order_status_id'])) {
            $query->where('order_status_id', (int) $filter['order_status_id']);
        }
    }
    /**
     * Store
     *
     */
    public function store(array $data)
    {
        DB::transaction(function () use ($data) {
            $this->model->user_id         = (int) $data['user_id'];
            $this->model->email           = $data['email'];
            $this->model->mobile          = $data['mobile'];
            $this->model->name            = $data['name'];
            $this->model->image           = $data['image'];
            $this->model->total           = (float) $data['total'];
            $this->model->order_status_id = (int) $data['order_status_id'];
            $this->model->ip              = $data['ip'];
            $this->model->user_agent      = $data['user_agent'];
            $this->model->accept_language = $data['accept_language'];
            $this->model->save();

            if (!empty($data['shipping'])) {
                $shipping = new ProductOrderShipping;

                $shipping->name        = $data['shipping']['name'];
                $shipping->mobile      = $data['shipping']['mobile'];
                $shipping->province    = $data['shipping']['province'];
                $shipping->city        = $data['shipping']['city'];
                $shipping->district    = $data['shipping']['district'];
                $shipping->province_id = (int) $data['shipping']['province_id'];
                $shipping->city_id     = (int) $data['shipping']['city_id'];
                $shipping->district_id = (int) $data['shipping']['district_id'];
                $shipping->address     = $data['shipping']['address'];

                $this->model->shipping()->save($shipping);
            }

            if (!empty($data['products'])) {
                $products = [];

                foreach ($data['products'] as $key => $value) {
                    $products[$key] = new ProductOrderProduct;

                    $products[$key]->product_id = (int) $value['product_id'];
                    $products[$key]->option_id  = (int) $value['option_id'];
                    $products[$key]->title      = $value['title'];
                    $products[$key]->price      = (float) $value['price'];
                    $products[$key]->quantity   = (int) $value['quantity'];
                    $products[$key]->total      = (float) $value['total'];
                    $products[$key]->subtract   = (int) $value['subtract'];
                }
                $this->model->products()->saveMany($products);
            }
            if (!empty($data['totals'])) {
                $totals = [];

                foreach ($data['totals'] as $key => $value) {
                    $totals[$key] = new ProductOrderTotal;

                    $totals[$key]->code       = (int) $value['code'];
                    $totals[$key]->title      = $value['title'];
                    $totals[$key]->value      = (float) $value['value'];
                    $totals[$key]->sort_order = (int) $value['sort_order'];
                }
                $this->model->totals()->saveMany($products);
            }

            $this->addHistory($this->model, $data['order_status_id']);
        });
    }
    public function addHistory(ProductOrder $order, $order_status_id, $comment = '', $notify = false)
    {
        $history = new ProductOrderHistory;

        $history->order_status_id = (int) $order_status_id;
        $history->comment         = $comment;
        $history->notify          = (int) $notify;

        $order->histories()->saveMany([$history]);
    }
    /**
     * Update
     *
     * @return Void
     */
    public function update(ProductOrder $productOrder, $quantity = 1)
    {
        DB::transaction(function () use ($productOrder, $quantity) {

        });
    }
    /**
     * Destroy
     *
     * @return Void
     */
    public function destroy(ProductOrder $productOrder)
    {
        DB::transaction(function () use ($productOrder) {

        });
    }

    public function truncate()
    {
        DB::transaction(function (){

        });
    }
}
