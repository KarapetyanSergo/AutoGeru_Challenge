<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreProductRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    public function store(StoreProductRequest $request): JsonResponse
    {
        return response()->json($this->getSuccessResponse(Product::create([
            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'price' => $request->price,
            'type' => $request->type
        ])));
    }
}
