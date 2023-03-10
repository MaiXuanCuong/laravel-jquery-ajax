<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $table = 'sizes';
    use HasFactory;
   
    public function productSizes()
    {
        return $this->hasMany(ProductSize::class);
    }
}
