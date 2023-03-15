<?php

namespace Domain\Product\Dtos;

use Spatie\LaravelData\Data;

class SupplierProduct1Dto extends Data
{
    public string $id;
    public string $name;
    public string $description;
    public string $category;
    public string $image;
    public string $price;
    public string $material;
    public string $departament;

}
