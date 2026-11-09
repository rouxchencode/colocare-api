<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Food;

// 測試用最簡化 API
Route::get('/foods', function (Request $request) {
    $keyword = $request->input('keyword');

    return Food::when($keyword, function ($query, $keyword) {
        $query->where('food_name', 'like', "%{$keyword}%");
        })->get()->map(function ($food) {
        $food->light = match ((int) $food->gas_label) {
            2 => 'red',
            1 => 'yellow',
            default => 'green',
        };
        return $food;
    });
});