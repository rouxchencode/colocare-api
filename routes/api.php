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
        if ($food->gas_label) {
            $food->light = 'red';
        } elseif ($food->crude_fiber > 2 || $food->fat_ratio > 10) {
            $food->light = 'yellow';
        } else {
            $food->light = 'green';
        }
        return $food;
    });
});