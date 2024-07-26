<?php

use App\Models\Category;
use App\Models\User;
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


    Route::get('/subcategories/{category}', function (Request $request, Category $category) {

        if ($request->ajax()) {
            return $category->subCategories()->when($request->search, function ($query, $search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
                ->get();
        }
    })->name('categories.getSubcategories');

    Route::get('/doctors', function (Request $request) {

        if ($request->ajax()) {
            return User::where([
                'role' => 'doctor',
                'active' => 1
            ])
                ->when($request->search, function ($query, $search) {
                    $query->where('names', 'like', "%$search%");
                })
                ->get();
        }
    })->name('doctors.all');
});
