<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\Category\CategoryServiceInterface;
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

        $category = $this->categoryService->create($request);
        if ($category) {
            return response()->json([
                'status' => 200,
                'messeges' => "Thêm thành công",
            ]);

        } else {
            return response()->json([
                'status' => 404,
                'messeges' => "Thêm không thành công",
            ]);

        }

    }

    public function edit($id)
    {
        $category = $this->categoryService->find($id);
        if ($category) {
            return response()->json([
                "category" => $category,
                "status" => 200,
            ]);

        } else {

            return response()->json([
                "messeges" => "Không tìm thấy",
                "status" => 404,
            ]);
        }

    }

    public function update(Request $request, $id)
    {
        $category = $this->categoryService->update($id, $request);
        if ($category) {
            return response()->json([
                "status" => 200,
            ]);

        } else {

            return response()->json([
                "status" => 404,
            ]);
        }
    }
    public function getCategory()
    {
        $categories = $this->categoryService->all();
        if ($categories) {
            return response()->json([
                'categories' => $categories,
                'status' => 200,
            ]);
        } else {
            return response()->json([
                'messeges' => 'Có lỗi xãy ra',
                'status' => 404,
            ]);
        }
    }
    public function destroy($id)
    {
        $category = $this->categoryService->delete($id);
        if ($category) {
            return response()->json([
                'messeges' => 'Xóa thành công',
                'status' => 200,
            ]);
        } else {
            return response()->json([
                'messeges' => 'Có lỗi xãy ra',
                'status' => 404,
            ]);
        }
    }

    public function getTrashCan()
    {

        $categories = $this->categoryService->getTrashed();
        return response()->json([
            'categories' => $categories,
            'status' => 200,
        ]);
        return response()->json([
            'messeges' => 'Có lỗi xãy ra',
            'status' => 404,
        ]);
    }

    public function restore($id)
    {
        $category = $this->categoryService->restore($id);
        if ($category) {
            return response()->json([
                'messeges' => 'Khôi phục thành công',
                'status' => 200,
            ]);
        } else {
            return response()->json([
                'messeges' => 'Khôi phục không thành công',
                'status' => 404,
            ]);
        }
    }

    public function force_destroy($id)
    {
        $category = $this->categoryService->force_destroy($id);
        if ($category) {
            return response()->json([
                'messeges' => 'Xóa thành công',
                'status' => 200,
            ]);
        } else {
            return response()->json([
                'messeges' => 'Xóa không thành công',
                'status' => 404,
            ]);

        }
    }
    public function show($id)
    {
        $category = $this->categoryService->find($id);
        if ($category) {
            return response()->json([
                'category' => $category,
                'status' => 200,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'messeges' => 'Không tìm thấy',
            ]);
        }

    }
}
