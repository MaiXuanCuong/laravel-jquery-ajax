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
    public function productSizes()
    {
        return $this->hasMany(ProductSize::class);
    }
    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'product_sizes', 'product_id', 'size_id')->withTimestamps(); //withTimestamps tự động cập nhật hai cột created_at và updated_at trong bảng liên kết.
    }
}
