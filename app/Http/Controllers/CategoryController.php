<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\CategoryStoreRequest;

class CategoryController extends Controller
{

    public function index()
    {
        $num = config('setting.pagination_category_list');
        $categories = Category::paginate($num);
        return view('categories.index')->with('categories', $categories);
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $category = Category::create($request->all());
        return redirect(route('category.index'));
    }

    public function edit($id)
    {
            $category = Category::find($id);
            if(empty($category)){
                return redirect(route('category.index'));
            }
        return view('categories.edit')->with('category', $category);
    }

    public function update($id, Request $request)
    {
        $category = Category::find($id);
        if(empty($category)){
            return redirect(route('category.index'));
        }
        $category -> save();
        return redirect(route('category.index'));
    }

    public function delete($id)
    {
        $category = Category::find($id);
        if(empty($category)){
            return redirect(route('category.index'));
        }
        $category -> delete();
        return redirect(route('category.index'));
    }

    public function deleteAjax($id)
    {
        $category = Category::find($id);
        if(empty($category)) {
            return response()->json([
            'success' => false,
            'message' => 'category was not found. '
            ]);
        }
        $category -> delete();
        return response()->json([
            'success' => true,
            'message' => 'Category was deleted successfully'
        ]);
    }
}
