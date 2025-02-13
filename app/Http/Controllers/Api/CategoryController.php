<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CategoryRequest;
use App\Http\Resources\Api\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        auth()->loginUsingId(1);
        return response()->json(auth()->user()->categories);   
    }

    public function show($id)
    {
        auth()->loginUsingId(1);
        $category = auth()->user()->categories()->find($id);
        return new CategoryResource($category);
    }

    public function update(CategoryRequest $request, $id)
    {
        auth()->loginUsingId(1);
        
        $category = auth()->user()->categories()->find($id);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories', 'public');
        }

        $category->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'image' => $imagePath ?? $category->image,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Kategori başarıyla güncellendi'
        ]);
    }
}
