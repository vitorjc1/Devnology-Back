<?php

namespace Domain\Product\Services;

use Domain\Product\Dtos\ProductDto;
use Domain\Product\Services\Supplier1Services;

class ProductServices
{
    private Supplier1Services $supplier1Services;
    private Supplier2Services $supplier2Services;

    public function __construct(
        Supplier1Services $supplier1Services,
        Supplier2Services $supplier2Services
    ) {
        $this->supplier1Services = $supplier1Services;
        $this->supplier2Services = $supplier2Services;
    }

    public function GetProducts()
    {
        $supplier1Products =  $this->supplier1Services->getProducts();
        $supplier2Products = $this->supplier2Services->getProducts();

        $products = array_merge($supplier1Products, $supplier2Products);

        return $products;
    }

    public function GetProduct(int $external_id, int $supplier_id) : ProductDto
    {

        if ($supplier_id === 1) {
            $product = $this->supplier1Services->Get($external_id);
        } else {
            $product = $this->supplier2Services->Get($external_id);
        }

        return $product;
    }

}
