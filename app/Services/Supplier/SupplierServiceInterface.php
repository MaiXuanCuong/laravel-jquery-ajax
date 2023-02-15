<?php
namespace App\Services\Supplier;

use App\Services\ServiceInterface;

interface SupplierServiceInterface extends ServiceInterface
{
    public function getTrashed();
    public function restore($id);
    public function force_destroy($id);
}
