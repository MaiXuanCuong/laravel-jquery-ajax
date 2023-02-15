<?php

namespace App\Http\Controllers;

use App\Services\Supplier\SupplierServiceInterface;
use Exception;
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
        // return view('');
    }

    public function store(Request $request)
    {
        try {
            $this->supplierService->create($request);
        } catch (\Exception $e) {
        }
    }

    public function edit($id)
    {
        $item = $this->supplierService->find($id);
    }

    public function update(Request $request,$id)
    {
        try {
            $this->supplierService->update($request, $id);
        } catch (\Exception $e) {
        }
    }

    public function destroy($id)
    {
        try {
            $category = $this->supplierService->delete( $id);
        } catch (\Exception $e) {
        }
    }

    public function getTrashed(Request $request){
        $suppliers = $this->supplierService->getTrashed();
    }

    public function restore($id)
    {
        try {
            $this->supplierService->restore($id);
        } catch (\Exception $e) {
        }
    }

    public function force_destroy($id)
    {
        try {
            $category = $this->supplierService->force_destroy( $id);
        } catch (Exception $e) {
        }
    }
}
