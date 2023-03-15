<?php

namespace Domain\Product\Services;

use Domain\Product\Dtos\ProductDto;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Supplier2Services
{
    private const BASE_URL = "http://616d6bdb6dacbb001794ca17.mockapi.io/devnology/";
    private const SUPPLIER = "Supplier 2";
    private const SUPPLIER_ID = 2;

    public function GetProducts() : array
    {
        $products = json_decode(Http::get(Self::BASE_URL . 'european_provider')->body(),true);

        $productsDto = array();

        foreach ($products as $product) {
            $productsDto[] = $this->MapperToProductDto($product);
        }

        return $productsDto;
    }

    public function Get(int $id) : ProductDto
    {
        $product = Http::get(Self::BASE_URL . 'european_provider/' . $id)->body();

        return $this->MapperToProductDto(json_decode($product,true));
    }

    public function MapperToProductDto($data)
    {
        $productDto = new ProductDto();
        $productDto->external_id = $data['id'];
        $productDto->name = $data['name'];
        $productDto->description = $data['description'];
        $productDto->category = null;
        $productDto->hasDiscount = $data['hasDiscount'];
        $productDto->discount = $data['discountValue'];
        $productDto->price = $data['price'];
        $productDto->images = $data['gallery'];
        $productDto->material = $data['details']['material'];
        $productDto->departament = null;
        $productDto->adjective = $data['details']['adjective'];
        $productDto->supplier = Self::SUPPLIER;
        $productDto->supplier_id = Self::SUPPLIER_ID;

        return $productDto;
    }
}
