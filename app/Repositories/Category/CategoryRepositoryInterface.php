<?php
namespace App\Repositories\Category;

use App\Repositories\RepositoryInterface;

interface CategoryRepositoryInterface extends RepositoryInterface{
    public function all();
    public function getTrashed();
    public function restore($id);
    public function force_destroy($id);

}
