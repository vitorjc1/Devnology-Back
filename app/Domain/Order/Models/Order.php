<?php

namespace Domain\Order\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    public const TOTAL = 'total';
    public const STATUS = 'status';
    public const CUSTOMER_ID = 'customer_id';
    public const PAYMENT_METHOD = 'payment_method';
    public const ADDRESS = 'address';
    public const ADDRESS_ID = 'address_id';
    public const OrderStatus = [
        'PENDING' => 'pending',
        'APPROVED' => 'approved',
        'REJECTED' => 'rejected',
    ];

    protected $fillable = [
        self::TOTAL,
        self::STATUS,
        self::CUSTOMER_ID,
        self::PAYMENT_METHOD,
        self::ADDRESS_ID,
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function address()
    {
        return $this->hasOne(Address::class);
    }
}
