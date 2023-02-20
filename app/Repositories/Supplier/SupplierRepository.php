<?php
namespace App\Repositories\Supplier;

use App\Models\Supplier;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Log;

class SupplierRepository extends BaseRepository implements SupplierRepositoryInterface{

    function getModel()
    {
        return Supplier::class;
    }
    public function all()
    {
        $suppliers = $this->model->select('*');
        return $suppliers->orderBy('id','DESC')->get();
    }
    public function create($data)
    {
        try {
            $supplier = $this->model;
            $supplier->name = $data->name;
            $supplier->email = $data->email;
            $supplier->address = $data->address;
            $supplier->phone = $data->phone;
            $supplier->save();
            return $supplier;
        } catch (\Exception $e) {
            Log::error('Message: ' . $e->getMessage() . ' --- Line : ' . $e->getLine());
            return false;
        }
    }
    public function update($data, $id ){

        try {
            $supplier = $this->model->find($id);
            $supplier->name = $data->name;
            $supplier->email = $data->email;
            $supplier->address = $data->address;
            $supplier->phone = $data->phone;
            $supplier->save();
            return $supplier;
        } catch (\Exception $e) {
            Log::error('Message: ' . $e->getMessage() . ' --- Line : ' . $e->getLine());
            return false;
        }
    }
    public function delete($id){
       
        try {
            $supplier = $this->model->find($id);
            $supplier->delete();
            return true;
        } catch (\Exception $e) {
            Log::error('Message: ' . $e->getMessage() . ' --- Line : ' . $e->getLine());
            return false;
        }
        return $supplier;
    }
    public function getTrashed(){
      
       try {
        $query = $this->model->onlyTrashed();
        return $query->orderBy('deleted_at','DESC')->get();
       } catch (\Exception $e) {
        Log::error('Message: ' . $e->getMessage() . ' --- Line : ' . $e->getLine());
        return false;
       }
       
    }
    public function restore($id){
        try {
            $supplier = $this->model->onlyTrashed()->find($id);
            $supplier->restore();
            return $supplier;
        } catch (\Exception $e) {
            Log::error('Message: ' . $e->getMessage() . ' --- Line : ' . $e->getLine());
            return false;
        }
      
    }
    public function force_destroy($id){
        try {
            $supplier = $this->model->onlyTrashed()->find($id);
            $supplier->forceDelete();
            return $supplier;
        } catch (\Exception $e) {
            Log::error('Message: ' . $e->getMessage() . ' --- Line : ' . $e->getLine());
            return false;
        }
      
    }


}
