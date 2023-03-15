<?php

namespace Domain\Order\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_items';

    public const ORDER_ID = 'order_id';
    public const QUANTITY = 'quantity';
    public const PRICE = 'price';
    public const DISCOUNT = 'discount';
    public const TOTAL = 'total';
    public const PRODUCT_ID = 'product_id';
    public const SUPPLIER_ID = 'supplier_id';

    protected $fillable = [
        self::ORDER_ID,
        self::QUANTITY,
        self::PRICE,
        self::TOTAL,
        self::DISCOUNT,
        self::PRODUCT_ID,
        self::SUPPLIER_ID,
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
