<?php

namespace App\Http\Controllers;

use App\Services\Supplier\SupplierServiceInterface;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    private $supplierService;
    public function __construct(SupplierServiceInterface $supplierService)
    {
        $this->supplierService = $supplierService;
    }

    public function index(Request $request)
    {
        return view('admin.supplier.index');
    }

    public function store(Request $request)
    {

        $supplier = $this->supplierService->create($request);
        if ($supplier) {
            return response()->json([
                'supplier' => $supplier,
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

    public function getSupplier()
    {
        $suppliers = $this->supplierService->all();
        if($suppliers){
            return response()->json([
                'suppliers' => $suppliers,
                'status' => 200,
            ]);
        } else{
            return response()->json([
                'status' => 404,
                "messeges" => 'Có lỗi xãy ra',
            ]);
        }
    }

    public function edit($id)
    {
        $supplier = $this->supplierService->find($id);
        if ($supplier) {
            return response()->json([
                "supplier" => $supplier,
                "status" => 200,
            ]);

        } else {

            return response()->json([
                "messeges" => 'Không tìm thấy nhà cung cấp',
                "status" => 404,
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $supplier = $this->supplierService->update($request, $id);
        if ($supplier) {

            return response()->json([
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
        $supplier = $this->supplierService->delete($id);
        if ($supplier) {

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
        $suppliers = $this->supplierService->getTrashed();
        if ($suppliers) {

            return response()->json([
                'suppliers' => $suppliers,
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

        $supplier = $this->supplierService->restore($id);
        if ($supplier) {
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

        $supplier = $this->supplierService->force_destroy($id);

        if ($supplier) {

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
}
