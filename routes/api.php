<?php

use App\Http\Controllers\Api\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware("api")->group(function () {
    Route::get("/categories", [CategoryController::class, "index"])->name("categories");
});