<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\Category\CategoryServiceInterface;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $categoryService;
    public function __construct(CategoryServiceInterface $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        return view('admin.category.index');
    }

    public function store(Request $request)
    {
        
        try {
            $this->categoryService->create($request);

            return response()->json([
                'status' => 200,
                'messenger' => "thành công"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 404,
                'messenger' => "không thành công"
            ]);
        }
        
    }

    public function edit($id)
    {
        try {
            $category = $this->categoryService->find($id);
            return response()->json([
                "category" => $category,
                "status" => 200,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "messege" => "category not found",
                "status" => 404,
            ]);
        }
      
    }

    public function update(Request $request, $id)
    {
        try {
            $this->categoryService->update($id, $request);
            return response()->json([
                "status" => 200,
            ]);
        } catch (\Exception$e) {
            return response()->json([
                "status" => 404,
            ]);
        }
    }
    public function getCategory()
    {
        $categories = Category::All();
        return response()->json([
            'categories' => $categories,
        ]);
    }
    public function destroy($id)
    {
        try {
            $category = $this->categoryService->delete($id);
        } catch (\Exception$e) {
        }
    }

    public function getTrashCan()
    {
        try {
          
            $categories = $this->categoryService->getTrashed();
            return response()->json([
                'categories' => $categories,
                'status' => 200,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'messege' => 'not fund',
                'status' => 404,
            ]);
        }
    }

    public function restore($id)
    {
        try {
            $this->categoryService->restore($id);
        } catch (\Exception$e) {
        }
    }

    public function force_destroy($id)
    {
        try {
            $category = $this->categoryService->force_destroy($id);
        } catch (Exception $e) {
        }
    }
}
