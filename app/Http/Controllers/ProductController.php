<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * @var User  $user
     */
    private $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function addProduct(Request $request)
    {
        $user = $this->user;
        if (!$user->categories()->where('category', $request->category)->orWhere('category_id', $request->category_id)->exists()) {
            return response()->json(["message" => "You doesn't have permission to this category"]);
        }
        $product = Product::create($request->all());

        return $product;
    }

    // Edit product with id = $product_id

    public function editProduct(Request $request, $product_id)
    {

        /** @var User $user */
        $user = $this->user;
        $product = Product::findOrFail($product_id);
        if ($user->categories()->where('category_id', $product->categories->id)->exists()) {
            $product->update($request->all());
            return response()->json($product);
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
