<?php

namespace App\Services\Supplier;

use App\Repositories\Supplier\SupplierRepositoryInterface;
use App\Services\BaseService;

class SupplierService extends BaseService implements SupplierServiceInterface {

    public $repository;
    public function __construct(SupplierRepositoryInterface $SupplierRepository)
    {
        $this->repository = $SupplierRepository;
    }
    public function all()
    {
        return $this->repository->all();
    }
    public function update($id, $data){
        return $this->repository->update($id, $data);
    }
    public function delete($id)
    {
        return $this->repository->delete($id);
    }
    public function getTrashed()
    {
        return $this->repository->getTrashed();
    }
    public function restore($id){
        return $this->repository->restore($id);
    }
    public function force_destroy($id){
        return $this->repository->force_destroy($id);
    }

}
