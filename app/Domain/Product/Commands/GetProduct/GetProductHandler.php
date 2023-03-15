<?php

namespace Domain\Product\Commands\GetProduct;

use Domain\Product\Services\ProductServices;

class GetProductHandler
{
    private ProductServices $ProductService;

    public function __construct(ProductServices $ProductService)
    {
        $this->ProductService = $ProductService;
    }

    public function __invoke(GetProductCommand $getProductCommand)
    {
        $product =  $this->ProductService->GetProduct(
            $getProductCommand->external_id,
            $getProductCommand->supplier_id
        );

        return $product;
    }
}
