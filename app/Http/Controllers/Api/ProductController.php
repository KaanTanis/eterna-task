<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ProductRequest;
use App\Http\Resources\Api\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        return response()->json(ProductResource::collection(auth()->user()->products()->with('categories')->get())->collection);
    }


    public function show($id)
    {
        $product = auth()->user()->products()->with('categories')->find($id);
        return response()->json(new ProductResource($product));
    }

    public function store(ProductRequest $request)
    {
        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $product = auth()->user()->products()->create([
            'name' => $request->name,
            'slug' => $request->slug,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        if ($request->has('categories')) {
            $product->categories()->sync($request->categories);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Ürün başarıyla oluşturuldu'
        ]);
    }

    public function update(ProductRequest $request, $id)
    {
        $product = auth()->user()->products()->find($id);

        if (!$product) {
            return response()->json(['message' => 'Ürün bulunamadı'], 404);
        }

        $imagePath = $product->image;

        if ($request->hasFile('image')) {
            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $product->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        if ($request->has('categories')) {
            $product->categories()->sync($request->categories);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Ürün başarıyla güncellendi'
        ]);
    }

    public function destroy($id)
    {
        $product = auth()->user()->products()->find($id);
        
        if (!$product) {
            return response()->json(['message' => 'Ürün bulunamadı'], 404);
        }

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Ürün başarıyla silindi'
        ]);
    }
}
