<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Add product

    public function addProduct(Request $request)
    {
        $product = new Product();
        $product->name = $request->get('name');
        $product->category_id = Category::where('category', $request->get('category'))->firstOrFail()->id;
        $product->image = Storage::disk('public')->putFile('avatars', $request->file('image'));
        $product->save();

        return $product;
    }

    // Edit product with id = $product_id

    public function editProduct(Request $request, $product_id)
    {


        $user = User::find(Auth::id());

        foreach ($user->categories as $category) {
            $categoryName = $category->category;
            $productName = Category::where('category', $categoryName)->first();
            foreach ($productName->product as $prod) {
                if ($prod->id == $product_id) {
                    Product::where('id', $product_id)->first()->update($request->all());
                    $product = Product::find($product_id);

                    return response()->json($product);
                }

            }

        }
        return response()->json(["message" => "You doesn't have permission to this category"]);
    }

    // Show product with id = $product

    public function showProduct($product)
    {
        $product = Product::where('id', $product)->get();
        return $product;
    }

}
