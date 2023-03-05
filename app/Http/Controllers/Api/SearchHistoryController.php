<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreSearchHistoryRequest;
use App\Models\Product;
use App\Models\SearchHistory;
use App\Models\SearchHistoryProduct;
use Illuminate\Http\JsonResponse;

class SearchHistoryController extends Controller
{
    public function store(StoreSearchHistoryRequest $request): JsonResponse
    {
        $searchHistory = SearchHistory::create([
            'user_id' => auth()->user()->id,
            'max_price' => $request->max_price,
            'min_price' => $request->min_price,
            'type' => $request->type,
        ]);

        $products = Product::where(function ($q) use ($request) {
            $q->where('price', '>=', $request->min_price)
            ->orWhere('price', '<=', $request->max_price);
        })
        ->where('type', 'LIKE', $request->type)
        ->when($request->title, function ($q) use ($request) {
            $q->where('title', 'LIKE', $request->title);
        })
        ->get();

        foreach ($products as $product) {
            SearchHistoryProduct::create([
                'search_history_id' => $searchHistory->id,
                'product_id' => $product->id
            ]);
        }

        return response()->json($this->getSuccessResponse($products));
    }

    public function getSalesmanSearchHistory(): JsonResponse
    {
        return response()->json($this->getSuccessResponse(
            SearchHistory::whereHas('search_history_products', function ($q) {
                $q->whereHas('product', function ($q) {
                    $q->whereHas('user', function ($q) {
                        $q->where('id', auth()->user()->id);
                    });
                });
            })
            ->with(
                ['search_history_products' => function ($q) {
                    $q->with('product');
                }],
            )
            ->get()
        ));
    }

    public function getBuyerSearchHistory(): JsonResponse
    {
        return response()->json($this->getSuccessResponse(
            SearchHistory::where('user_id', auth()->user()->id)
            ->with(
                ['search_history_products' => function ($q) {
                    $q->with('product');
                }],
            )
            ->get()
        ));
    }
}
