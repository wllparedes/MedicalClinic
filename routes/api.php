<?php

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('api')->name('api.')->group(function () {


    Route::get('/categories', function (Request $request) {

        if ($request->ajax()) {
            return Category::when($request->search, function ($query, $search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
                ->get();
        }
    })->name('categories.all');
});
