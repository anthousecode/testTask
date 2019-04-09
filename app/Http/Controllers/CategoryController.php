<?php

namespace App\Http\Controllers;

use App\Category;
use App\User;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    // Show all category

    public function showCategory()
    {
        $category = Category::all();
        return response()->json($category);
    }

    // Show category with id = $category

    public function storeCategory($category)
    {
        $category = Category::where('id', $category)->with('product')->get();
        return response()->json($category);
    }

    // Assign category to admin

    public function adminCategory(Request $request)
    {
        /** @var User $user */
        /** @var Category $category */

        [$user, $category] = [User::role('AdminManager')->where('id', '=', $request->user_id)->firstOrFail(), Category::findOrFail($request->category_id)];
        $user->categories()->syncWithoutDetaching($category);
        return response()->json(["message" => "Category assigned to admin manager!"]);

    }
}
