<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        auth()->loginUsingId(1);
        return response()->json(auth()->user()->categories);   
    }
}
