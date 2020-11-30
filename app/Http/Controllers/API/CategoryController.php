<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        try {
            $category = Category::all();
            return response()->json([
                'status' => true,
                'message' => 'Data Found',
                'category' => $category
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'category' => []
            ]);
        }
    }

    public function detail($id)
    {
        try {
            $category = Category::find($id);
            return response()->json([
                'status' => true,
                'message' => 'Data Found',
                'category' => $category
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'category' => []
            ]);
        }
    }

    public function create(Request $request)
    {
        $rules = [
            'name' => 'required|unique:categories|max:150'
        ];

        $message = [
            'name.required' => 'Category cannot be empty',
            'name.unique' => 'Category already exist',
            'name.max' => 'Category cannot be more than :max character'
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ]);
        }

        $category = new Category();
        $category->name = $request->name;

        if ($category->save()) {
            return response()->json([
                'status' => true,
                'message' => 'Success create category ' . $request->name
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Failed create category'
        ]);
    }

    public function delete(Request $request)
    {
        $rules = [
            'id' => 'required'
        ];

        $message = [
            'id.required' => 'Id not selected',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ]);
        }

        $category = Category::find($request->id);
        $name = $category->name;
        if ($category->delete()) {
            return response()->json([
                'status' => true,
                'message' => 'Success delete category ' .$name
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Failed delete category'
        ]);

    }

    public function update(Request $request,$id)
    {
        $rules = [
            'name' => 'required|unique:categories|max:150'
        ];

        $message = [
            'name.required' => 'Category cannot be empty',
            'name.unique' => 'Category already exist',
            'name.max' => 'Category cannot be more than :max character'
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ]);
        }

        $category = Category::find($id);
        $category->name = $request->name;

        if ($category->save()) {
            return response()->json([
                'status' => true,
                'message' => 'Success update category ' . $request->name
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Failed update category'
        ]);
    }
}
