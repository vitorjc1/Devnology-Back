<?php

namespace Domain\Order\Commands\CreateOrder;

use Domain\Address\Commands\CreateAddress\CreateAddressCommand;
use Domain\Customer\Commands\CreateCustomer\CreateCustomerCommand;
use Domain\Order\Models\Order;
use Domain\Order\Models\OrderItem;
use Domain\Product\Services\ProductServices;
use Illuminate\Support\Facades\DB;
use Support\CommandBus;

class CreateOrderHandler
{
    private ProductServices $ProductService;
    private CommandBus $commandBus;

    public function __construct(ProductServices $ProductService, CommandBus $commandBus)
    {
        $this->ProductService = $ProductService;
        $this->commandBus = $commandBus;
    }

    public function __invoke(CreateOrderCommand $createOrderCommand)
    {
        return DB::transaction(function () use ($createOrderCommand) {
            try {

                $createCustomerCommand = new CreateCustomerCommand($createOrderCommand->customer);
                $createAddressCommand = new CreateAddressCommand($createOrderCommand->address);

                $customer = $this->commandBus->handle($createCustomerCommand);
                $address = $this->commandBus->handle($createAddressCommand);
                $total = 0;

                $order = Order::create([
                    Order::CUSTOMER_ID => $customer->id,
                    Order::ADDRESS_ID => $address->id,
                    Order::PAYMENT_METHOD => $createOrderCommand->payment_method,
                    Order::STATUS => Order::OrderStatus['PENDING'],
                    Order::TOTAL => $total,
                ]);

                foreach ($createOrderCommand->items as $item) {
                    $product = $this->ProductService->GetProduct($item['external_id'], $item['supplier_id']);

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
            } catch (\Exception $e) {
                throw new \Exception($e->getMessage());
            }
        });
    }
}
