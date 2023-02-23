<?php

namespace App\Http\Controllers;

use App\Exports\ProductsExport;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Size;
use App\Models\Supplier;
use App\Services\Product\ProductServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    private $productService;

    public function __construct(ProductServiceInterface $productService){
        $this->productService = $productService;
    }

    public function index()
    {   $categories = Category::get();
        $suppliers = Supplier::get();
        $sizes = Size::get();
        $params = [
            'sizes' => $sizes,
            'categories' => $categories,
            'suppliers' => $suppliers
        ];

        return view('admin.product.index',$params);
      
    }
    public function getProduct(){
        $products = $this->productService->all();
        // dd($products);
        if($products){
            return response()->json([
                'products' => $products,
                'status' => 200,
            ]);
        } else{
            return response()->json([
                'status' => 404,
                "messeges" => 'Có lỗi xãy ra',
            ]);
        }
    }

    public function create()
    {
        $categories = Category::get();
        $suppliers = Supplier::get();
        $sizes = Size::get();

        return response()->json([
            'sizes' => $sizes,
            'categories' => $categories,
            'suppliers' => $suppliers
        ]) ;
    }

    public function store(Request $request)
    {
           $product = $this->productService->create($request);
           if ($product) {
            return response()->json([
                'product' => $product,
                'status' => 200,
                'messeges' => "Thêm thành công",
            ]);

        } else {
            return response()->json([
                'status' => 400,
                "messeges" => 'Thêm không thành công',
            ]);

        }
    }

    public function show($id)
    {
        // $product = $this->productService->find($id);
        $product = Product::with(['category', 'supplier', 'product_images'])->find($id);
        if ($product) {
            return response()->json([
                'product' => $product,
                'status' => 200,
            ]);

        } else {
            return response()->json([
                "messeges" => 'Không tìm thấy sản phẩm',
                'status' => 404,
            ]);
        }
    }

    public function edit($id)
    {
        $product = $this->productService->find($id);
        $selectedSizes = old('sizes') ? old('sizes') : $product->sizes->pluck('id')->toArray();
        $productsImage = $product->product_images;
        if ($product) {
            return response()->json([
                "selectedSizes" => $selectedSizes,
                "product" => $product,
                "productsImage" => $productsImage,
                "status" => 200,
            ]);

        } else {

            return response()->json([
                "messeges" => 'Không tìm thấy người dùng',
                "status" => 404,
            ]);
        }

    }

    public function update(Request $request, $id)
    {
        $product = $this->productService->update($id, $request);
            if ($product) {

                return response()->json([
                    'product' => $product,
                    'messeges' => 'Cập nhật thành công',
                    "status" => 200,
                ]);
            } else {
    
                return response()->json([
                    'messeges' => 'Cập nhật không thành công',
                    "status" => 400,
                ]);
            }
    }

    public function destroy($id)
    {
        $product =  $this->productService->delete($id);
            if ($product) {

                return response()->json([
                    'messeges' => 'Xóa thành công',
                    "status" => 200,
                ]);
            } else {
    
                return response()->json([
                    'messeges' => 'Xóa không thành công',
                    "status" => 404,
                ]);
            }
    }
    public function getTrashCan()
    {
        $products = $this->productService->getTrashed();
        if ($products) {

            return response()->json([
                'products' => $products,
                'status' => 200,
            ]);
        } else {

            return response()->json([
                'messeges' => 'Có lỗi xãy ra',
                'status' => 404,
            ]);
        }

     
      
    }
    public function restore($id)
    {
        $product = $this->productService->restore($id);
            if ($product) {
                return response()->json([
                    'messeges' => "Khôi phục thành công",
                    'status' => 200,
                ]);
    
            } else {
    
                return response()->json([
                    'messege' => 'Khôi phục không thành công',
                    'status' => 404,
                ]);
            }
    }

    public function force_destroy($id)
    {
        $product =   $this->productService->force_destroy($id);
            if ($product) {

                return response()->json([
                    'messeges' => "Xóa thành công",
                    'status' => 200,
                ]);
    
            } else {
    
                return response()->json([
                    'messeges' => 'Xóa không thành công',
                    'status' => 404,
                ]);
            }
    }
    public function updateStatus($id, $status)
    {   
        try {
            $product = Product::findOrFail($id);
            if($status==1){
                $product->status = 0;
                $product->save();
                $product = Product::with('category')->find($product->id);
                return response()->json([
                    'product' => $product,
                    'status' => 200,
                    'message' => 'success',
                ]);
            }else{
                $product->status = 1;
                $product->save();
                $product = Product::with('category')->find($product->id);
                return response()->json([
                    'product' => $product,
                    'status' => 200,
                    'message' => 'success',
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Message: ' . $e->getMessage() . ' --- Line : ' . $e->getLine());
            return response()->json([
                'status' => 400,
                'message' => 'errr',
            ]);
        }
        


    }

  
    public function export(Request $request)
    {
        // Get data from request
        $data = $request->all();

        // Build the export
        $export = new ProductsExport($data);

        // Download the file
        return Excel::download(new ProductsExport, 'Xuat-danh-sach-san-pham-'.date("d_m_Y").'.xlsx');
    }
  

}
