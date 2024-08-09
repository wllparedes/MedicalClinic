<?php

use App\Models\Category;
use App\Models\Product;
use App\Models\Specialty;
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


    Route::get('/specialties/leftovers/{user}', function (Request $request, User $user) {

        if ($request->ajax()) {

            $specialties = $user->specialties()->get()->pluck('id')->toArray();

            return Specialty::when($request->search, function ($query, $search) {
                $query->where('name', 'like', "%$search%");
            })
                ->whereNotIn('id', $specialties)
                ->get();
        }
    })->name('specialties.leftovers');

    Route::get('/products', function (Request $request) {

        if ($request->ajax()) {
            return Product::when($request->search, function ($query, $search) {
                $query->where('name', 'like', "%$search%");
            })
                ->get();
        }
    })->name('products.all');
});
