<?php

namespace App\Http\Controllers;

use App\Exports\ProductExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\User;
use App\Services\Product\ProductServiceInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    private $productService;

    public function __construct(ProductServiceInterface $productService){
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        $products = $this->productService->all($request);
        $categories = Category::get();
        $suppliers = Supplier::get();
        $params = [
            'categories' => $categories,
            'suppliers' => $suppliers,
            'products' => $products
        ];
    }

    public function create()
    {
        $categories = Category::get();
        $suppliers = Supplier::get();
        $params = [
            'categories' => $categories,
            'suppliers' => $suppliers
        ];
    }

    public function store(Request $request)
    {
            $this->productService->create($request);
    }

    public function show($id)
    {
        $product = $this->productService->find($id);
        $users= User::all();
    }

    public function edit($id)
    {
        $product = $this->productService->find($id);
        $categories = Category::get();
        $suppliers = Supplier::get();
        $params = [
            'categories' => $categories,
            'product' => $product,
            'suppliers' => $suppliers,
        ];

    }

    public function update(Request $request, $id)
    {
            $data = $request->all();
            $this->productService->update($id, $data);
    }

    public function destroy($id)
    {
            $this->productService->delete($id);
    }
    public function getTrashed(Request $request)
    {
        $products = $this->productService->getTrashed($request);
        $categories = Category::get();
        $suppliers = Supplier::get();
        $params = [
            'categories' => $categories,
            'suppliers' => $suppliers,
            'products' => $products
        ];
    }
    public function restore($id)
    {
            $this->productService->restore($id);
    }

    public function force_destroy($id)
    {
            $this->productService->force_destroy($id);
    }
    public function updateStatus($id, $status)
    {
        $product = Product::findOrFail($id);
        if($status==1){
            $product->status = 0;
            $product->save();
            return response()->json([
                'code' => 0,
                'message' => 'success',
            ], status:200);
        }else{
            $product->status = 1;
            $product->save();
            return response()->json([
                'code' => 1,
                'message' => 'success',
            ], status:200);
        }


    }

    public function exportExcel(){
        // return Excel::download(new ProductExport, 'products.xlsx');
    }

}
