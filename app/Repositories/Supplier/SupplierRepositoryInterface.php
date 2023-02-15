<?php
namespace App\Repositories\Supplier;

use App\Repositories\RepositoryInterface;

interface SupplierRepositoryInterface extends RepositoryInterface{
    public function all();
    public function getTrashed();
    public function restore($id);
    public function force_destroy($id);

}
