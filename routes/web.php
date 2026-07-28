<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PromptController;
use App\Http\Controllers\FavoriteController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {

    return view('welcome');

});



Route::middleware(['auth'])->group(function () {


    Route::get('/dashboard', function () {

        $user = auth()->user();

        $totalPrompts = \App\Models\Prompt::where('user_id', $user->id)->count();
        $totalCategories = \App\Models\Category::count();
        $totalFavorites = \App\Models\Favorite::where('user_id', $user->id)->count();
        $recentPrompts = \App\Models\Prompt::with('category')
            ->where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();
        $categoryCounts = \App\Models\Prompt::where('user_id', $user->id)
            ->join('categories', 'prompts.category_id', '=', 'categories.id')
            ->selectRaw('categories.name, count(*) as count')
            ->groupBy('categories.name')
            ->get();

        return view('dashboard', compact(
            'user', 'totalPrompts', 'totalCategories',
            'totalFavorites', 'recentPrompts', 'categoryCounts'
        ));

    })->name('dashboard');



    Route::resource(
        'categories',
        CategoryController::class
    );



    Route::resource(
        'prompts',
        PromptController::class
    );



    Route::post(
        '/favorite/{id}',
        [FavoriteController::class, 'store']
    );



    Route::delete(
        '/favorite/{id}',
        [FavoriteController::class, 'destroy']
    );



    Route::get(
        '/favorites',
        [FavoriteController::class, 'index']
    );


});


require __DIR__.'/auth.php';