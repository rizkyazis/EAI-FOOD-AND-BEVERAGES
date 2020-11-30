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
            $host = request()->getHttpHost();
            $result = [];

            foreach ($category as $item) {
                array_push($result, [
                    'id' => $item->id,
                    'name' => $item->name,
                    'image' => $host.'/images/category/' . $item->image
                ]);
            }

            return response()->json([
                'status' => true,
                'message' => 'Data Found',
                'category' => $result
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
            $host = request()->getHttpHost();
            $category->image = $host . '/images/category/' . $category->image;
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
            'name' => 'required|unique:categories|max:150',
            'image' => 'required|mimes:png,jpeg,jpg|max:2048',
        ];

        $message = [
            'name.required' => 'Category cannot be empty',
            'name.unique' => 'Category already exist',
            'name.max' => 'Category cannot be more than :max character',
            'image.required' => 'Image cannot be empty',
            'image.mimes' => 'Image format should be png, jpeg, jpg',
            'image.max' => 'Max image size 2MB',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ]);
        }

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images/category'), $imageName);

        $category = new Category();
        $category->name = $request->name;
        $category->image = $imageName;

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

    public function delete($id)
    {
        $category = Category::find($id);
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
            'name' => 'required|max:150',
            'image' => 'mimes:png,jpeg,jpg|max:2048',
        ];

        $message = [
            'name.required' => 'Category cannot be empty',
            'name.unique' => 'Category already exist',
            'name.max' => 'Category cannot be more than :max character',
            'image.required' => 'Image cannot be empty',
            'image.mimes' => 'Image format should be png, jpeg, jpg',
            'image.max' => 'Max image size 2MB',
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

        if($request->image != ''){

            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/category'), $imageName);
            $category->image = $imageName;

        }

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
