<?php

namespace Domain\Product\Dtos;

class ProductDto
{
    public int $external_id;
    public string $name;
    public string $description;
    public string | null $category;
    public bool | null $hasDiscount;
    public string | null $discount;
    public float $price;
    public array $images;
    public string $material;
    public string | null $departament;
    public string | null $adjective;
    public string $supplier;
    public int $supplier_id;
}
