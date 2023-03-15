<?php

namespace Domain\Order\Commands\CreateOrder;

use Domain\Order\Models\Order;
use Domain\Order\Models\OrderItem;
use Domain\Product\Services\ProductServices;
use Illuminate\Support\Facades\DB;

class CreateOrderHandler
{
    private ProductServices $ProductService;

    public function __construct(ProductServices $ProductService)
    {
        $this->ProductService = $ProductService;
    }

    public function __invoke(CreateOrderCommand $createOrderCommand)
    {
        return DB::transaction(function () use ($createOrderCommand) {
            $order = Order::create([
                Order::TOTAL => 0,
                Order::STATUS => Order::OrderStatus['PENDING'],
                Order::CUSTOMER_ID => $createOrderCommand->customer_id,
            ]);

            $total = 0;

            foreach ($createOrderCommand->items as $item) {
                $product = $this->ProductService->GetProduct($item['id'], $item['supplier_id']);

                if (!$product) {
                    throw new \Exception('Product not found');
                }

                $discount = 0;

                if (isset($product->hasDiscount) && $product->discount > 0) {
                    $discount = $product->discount;
                    $discount = $product->price * $item['quantity'] * $discount;
                }

                $orderItem = OrderItem::create([
                    OrderItem::ORDER_ID => $order->id,
                    OrderItem::PRODUCT_ID => $product->external_id,
                    OrderItem::QUANTITY => $item['quantity'],
                    OrderItem::PRICE => $product->price,
                    OrderItem::DISCOUNT => isset($product->discount) ? $product->discount : 0,
                    OrderItem::TOTAL => $product->price * $item['quantity'] - $discount,
                    OrderItem::SUPPLIER_ID => $product->supplier_id,
                ]);

                $order->items()->save($orderItem);

                $total += $orderItem->total;
            }

            $order->total = $total;
            $order->status = Order::OrderStatus['APPROVED'];
            $order->save();

            return $order;
        });
    }
}
