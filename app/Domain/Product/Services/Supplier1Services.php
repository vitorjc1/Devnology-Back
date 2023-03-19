<?php

namespace Domain\Product\Services;

use Domain\Product\Dtos\ProductDto;
use Illuminate\Support\Facades\Http;

class Supplier1Services
{
    private const BASE_URL = "http://616d6bdb6dacbb001794ca17.mockapi.io/devnology/";
    private const SUPPLIER = "Supplier 1";
    private const SUPPLIER_ID = 1;

    public function GetProducts() : array
    {
        $products = json_decode(Http::get(Self::BASE_URL . 'brazilian_provider')->body(),true);

        $productsDto = array();

        foreach ($products as $product) {
            $productsDto[] = $this->MapperToProductDto($product);
        }

        return $productsDto;
    }

    public function GetByName(string $name): array
    {
        $products = json_decode(Http::get(Self::BASE_URL . 'brazilian_provider')->body(),true);

        $productsDto = array();

        foreach ($products as $product) {
            if (strpos($product['nome'], $name) !== false) {
                $productsDto[] = $this->MapperToProductDto($product);
            }
        }

        return $productsDto;
    }

    public function Get(int $id) : ProductDto
    {
        $product = Http::get(Self::BASE_URL . 'brazilian_provider/' . $id)->body();

        return $this->MapperToProductDto(json_decode($product,true));
    }

    public function MapperToProductDto($data)
    {
        $productDto = new ProductDto();
        $productDto->external_id = $data['id'];
        $productDto->name = $data['nome'];
        $productDto->description = $data['descricao'];
        $productDto->category = $data['categoria'];
        $productDto->hasDiscount = null;
        $productDto->discount = null;
        $productDto->price = $data['preco'];
        $productDto->images = array($data['imagem']);
        $productDto->material = $data['material'];
        $productDto->departament = $data['departamento'];
        $productDto->adjective = null;
        $productDto->supplier = Self::SUPPLIER;
        $productDto->supplier_id = Self::SUPPLIER_ID;

        return $productDto;
    }
}
