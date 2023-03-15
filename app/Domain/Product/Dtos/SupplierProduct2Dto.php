<?php

namespace Domain\Product\Dtos;

use Spatie\LaravelData\Data;

class SupplierProduct2Dto extends Data
{
    public string $id;
    public string $name;
    public bool $hasDiscount;
    public array $gallery;
    public string $description;
    public string $price;
    public string $discountValue;
}
