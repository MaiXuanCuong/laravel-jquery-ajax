<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory ,SoftDeletes;
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id')->whereNull('deleted_at');
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class,'supplier_id')->whereNull('deleted_at');
    }
    public function product_images(){
        return $this->hasMany(ProductImage::class, 'product_id','id');
    }
}
