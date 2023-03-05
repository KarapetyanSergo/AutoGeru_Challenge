<?php

namespace App\Services\Api;

use App\Models\Product;

class ProductService
{
    public function createProduct(array $requestData): Product
    {
        return Product::create($requestData);
    }
}
