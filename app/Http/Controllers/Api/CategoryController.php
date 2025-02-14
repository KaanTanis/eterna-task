<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CategoryRequest;
use App\Http\Resources\Api\CategoryResource;

class CategoryController extends Controller
{
    public function index()
    {
        return response()->json(auth()->user()->categories);   
    }

    public function show($id)
    {
        $category = auth()->user()->categories()->find($id);
        return new CategoryResource($category);
    }

    public function update(CategoryRequest $request, $id)
    {
        
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

    public function store(CategoryRequest $request)
    {
        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories', 'public');
        }

        auth()->user()->categories()->create([
            'name' => $request->name,
            'slug' => $request->slug,
            'image' => $imagePath,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Kategori başarıyla oluşturuldu'
        ]);
    }

    public function destroy($id)
    {
        $category = auth()->user()->categories()->find($id);
        
        $category->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Kategori başarıyla silindi'
        ]);
    }
}
