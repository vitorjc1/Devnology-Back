<?php

namespace Domain\Address\Models;

use Domain\Order\Models\Order;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'addresses';

    private const ZIP_CODE = 'zip_code';
    private const STREET = 'street';
    private const NUMBER = 'number';
    private const COMPLEMENT = 'complement';
    private const DISTRICT = 'district';
    private const CITY = 'city';

    protected $fillable = [
        self::ZIP_CODE,
        self::STREET,
        self::NUMBER,
        self::COMPLEMENT,
        self::DISTRICT,
        self::CITY,
    ];

    public function Order()
    {
        return $this->belongsTo(Order::class);
    }
}
