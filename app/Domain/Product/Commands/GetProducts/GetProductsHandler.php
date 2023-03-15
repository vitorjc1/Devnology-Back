<?php

namespace Domain\Product\Commands\GetProducts;

use Domain\Product\Services\ProductServices;

class GetProductsHandler
{
    private ProductServices $ProductServices;

    public function __construct(ProductServices $ProductServices)
    {
        $this->ProductServices = $ProductServices;
    }

    public function __invoke()
    {
        $products =  $this->ProductServices->GetProducts();

        return $products;
    }
}
