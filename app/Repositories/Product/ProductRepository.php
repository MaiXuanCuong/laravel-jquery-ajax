<?php
namespace App\Repositories\Product;

use App\Models\Product;
use App\Models\ProductImage;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{

    function getModel()
    {
        return Product::class;
    }
    public function all()
    {
        try {
        $query = $this->model->newQuery()->with('category')->orderBy('id', 'DESC');
        $products = $query->get();
       
        return $products;
 
    } catch (\Exception $e) {
        Log::error('Message: ' . $e->getMessage() . ' --- Line : ' . $e->getLine());
        
    }
    }
    public function create($data)
    {
        try {
            $product = $this->model;
            $product->name = $data->name;
            $product->price = $data->price;
            $product->type_gender = $data->type_gender;
            $product->quantity = $data->quantity;
            $product->description = $data->description;
            $product->supplier_id = $data->supplier_id;
            $product->category_id = $data->category_id;
            if($data->status == 1 || $data->status == 0){
            $product->status = $data->status;
            }
            $fieldName = 'inputFileAdd';
            if ($data->hasFile($fieldName)) {
                $fullFileNameOrigin = $data->file($fieldName)->getClientOriginalName();
                $fileNameOrigin = pathinfo($fullFileNameOrigin, PATHINFO_FILENAME);
                $extenshion = $data->file($fieldName)->getClientOriginalExtension();
                $fileName = $fileNameOrigin . '-' . rand() . '_' . time() . '.' . $extenshion;
                $path = 'storage/' . $data->file($fieldName)->storeAs('public/images/products', $fileName);
                $path = str_replace('public/', '', $path);
                $product->image = $path;
            }
            $product->save();

            //create product_images
            $arrImage = [];
            $fieldProductImages = 'file_names';
            if ($data->hasFile($fieldProductImages)) {
                foreach ($data['file_names'] as $file_detail) {
                    $fullFileNameOrigin = $file_detail->getClientOriginalName();
                    $fileNameOrigin = pathinfo($fullFileNameOrigin, PATHINFO_FILENAME);
                    $extenshion = $file_detail->getClientOriginalExtension();
                    $fileName = $fileNameOrigin . '-' . rand() . '_' . time() . '.' . $extenshion;
                    $paths = 'storage/' . $file_detail->storeAs('public/images/productsMany', $fileName);
                    $paths = str_replace('public/', '', $paths);
                    array_push($arrImage,$paths);
                    $product->product_images()->saveMany([
                        new ProductImage([
                            'image' => $paths,
                        ]),
                    ]);
                }
            }
           return Product::with('category')->find($product->id);
        } catch (\Exception $e) {
            if (isset($path) && !empty($path)) {
                $images = str_replace('storage', 'public',  $path);
                Storage::delete($images);
            }
            if (isset($paths) && !empty($arrImage)) {
                foreach ($arrImage as $value) {
                    $images = str_replace('storage', 'public',  $value);
                    Storage::delete($images);
                }
                
            }
            Log::error('Message: ' . $e->getMessage() . ' --- Line : ' . $e->getLine());
            return false;
        }
    }

    public function update($id, $data)
    {
        try {
            $product = $this->model->find($id);
            $product->name = $data->name;
            $product->price = $data->price;
            $product->type_gender = $data->type_gender;
            $product->quantity = $data->quantity;
            $product->description = $data->description;
            $product->supplier_id = $data->supplier_id;
            $product->category_id = $data->category_id;
            if($data->status == 1 || $data->status == 0){
            $product->status = $data->status;
            }
            $fieldName = 'inputFile';
            if ($data->hasFile($fieldName)) {
                $fullFileNameOrigin = $data->file($fieldName)->getClientOriginalName();
                $fileNameOrigin = pathinfo($fullFileNameOrigin, PATHINFO_FILENAME);
                $extenshion = $data->file($fieldName)->getClientOriginalExtension();
                $fileName = $fileNameOrigin . '-' . rand() . '_' . time() . '.' . $extenshion;
                $path = 'storage/' . $data->file($fieldName)->storeAs('public/images/products', $fileName);
                $path = str_replace('public/', '', $path);
                $product->image = $path;
            }
            $product->save();

            //create product_images
            $arrImage = [];
            $fieldProductImages = 'file_names';
            if ($data->hasFile($fieldProductImages)) {
                $items = ProductImage::where('product_id', '=', $product->id)->get();
                    foreach($items as $item){
                        $im = str_replace('storage', 'public',  $item->image);
                        Storage::delete($im);
                    }
                    ProductImage::where('product_id', '=', $product->id)->delete();
                    ProductImage::onlyTrashed()->where('product_id', '=', $product->id)->forceDelete();
                foreach ($data['file_names'] as $file_detail) {
                    $fullFileNameOrigin = $file_detail->getClientOriginalName();
                    $fileNameOrigin = pathinfo($fullFileNameOrigin, PATHINFO_FILENAME);
                    $extenshion = $file_detail->getClientOriginalExtension();
                    $fileName = $fileNameOrigin . '-' . rand() . '_' . time() . '.' . $extenshion;
                    $paths = 'storage/' . $file_detail->storeAs('public/images/productsMany', $fileName);
                    $paths = str_replace('public/', '', $paths);
                    array_push($arrImage,$paths);
                    $product->product_images()->saveMany([
                        new ProductImage([
                            'image' => $paths,
                        ]),
                    ]);
                }
            }
            return Product::with('category')->find($product->id);
        } catch (\Exception $e) {
            if (isset($path) && !empty($path)) {
                $images = str_replace('storage', 'public',  $path);
                Storage::delete($images);
            }
            if (isset($paths) && !empty($arrImage)) {
                foreach ($arrImage as $value) {
                    $images = str_replace('storage', 'public',  $value);
                    Storage::delete($images);
                }
                
            }
            Log::error('Message: ' . $e->getMessage() . ' --- Line : ' . $e->getLine());
            return false;
        }
        return $product;
    }
    public function delete($id)
    {
        $product = $this->model->find($id);
        try {
            $product->delete();
            return true;
        } catch (\Exception $e) {
            Log::error('Message: ' . $e->getMessage() . ' --- Line : ' . $e->getLine());
            return false;
        }
        return $product;
    }
    public function getTrashed()
    {
        try {
            $query = $this->model->newQuery()->onlyTrashed()->with('category')->orderBy('id', 'DESC');
            $products = $query->get();
            return $products;
        } catch (\Exception $e) {
            Log::error('Message: ' . $e->getMessage() . ' --- Line : ' . $e->getLine());
            return false;
        }
     
    }
    public function restore($id)
    {   
        try {
        $product = $this->model->onlyTrashed()->findOrFail($id);
        $product->restore();
        return $product;
    } catch (\Exception $e) {
        Log::error('Message: ' . $e->getMessage() . ' --- Line : ' . $e->getLine());
        return false;
    }
    }
    public function force_destroy($id)
    {
        try {
        $product = $this->model->onlyTrashed()->findOrFail($id);
        $items = ProductImage::where('product_id', '=', $product->id)->get();
        foreach($items as $item){
            $im = $item->image;
            $image = str_replace('storage', 'public', $im);
            Storage::delete($image);
        }
        ///xóa ảnh chi tiết trên CSDL
        ProductImage::where('product_id', '=', $product->id)->delete();
        ProductImage::onlyTrashed()->where('product_id', '=', $product->id)->forceDelete();

        ////xóa ảnh chính ở storage
        $image = $product->image;
        $image = str_replace('storage', 'public', $image);
        Storage::delete($image);
        ////xóa ảnh chi tiết ở storage


        $product->forceDelete();
        return $product;
    } catch (\Exception $e) {
        Log::error('Message: ' . $e->getMessage() . ' --- Line : ' . $e->getLine());
        return false;
    }
    }
}
