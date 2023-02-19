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
        $products = $this->model->select('*');
        return $products->orderBy('id', 'DESC')->get();
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
            return $product;
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
            //create product
            $product = $this->model->find($id);
            $product->name = $data->name;
            $product->price = $data->price;
            $product->type_gender = $data->type_gender;
            $product->quantity = $data->quantity;
            $product->description = $data->description;
            $product->supplier_id = $data->supplier_id;
            $product->category_id = $data->category_id;
            $product->image = $data->image;
            $fieldName = 'inputFileUpdate';
            if ($data->hasFile($fieldName)) {
                $image = $product->image;
                $fullFileNameOrigin = $data->file($fieldName)->getClientOriginalName();
                $fileNameOrigin = pathinfo($fullFileNameOrigin, PATHINFO_FILENAME);
                $extenshion = $data->file($fieldName)->getClientOriginalExtension();
                $fileName = $fileNameOrigin . '-' . rand() . '_' . time() . '.' . $extenshion;
                $path = 'storage/' . $data->file($fieldName)->storeAs('public/images/products', $fileName);
                $path = str_replace('public/', '', $path);
                $product->image = $path;
            }
            $product->save();
            if(isset($path)){
                Storage::delete($image);
            }
            //create product_images
            $fieldProductImages = 'inputFileUpdateImage';
            if ($data->hasFile($fieldProductImages)) {
                $items = ProductImage::where('product_id', '=', $product->id)->get();
                foreach($items as $item){
                    $im = $item->image;
                    Storage::delete($im);
                }
                ProductImage::where('product_id', '=', $product->id)->delete();
                ProductImage::onlyTrashed()->where('product_id', '=', $product->id)->forceDelete();
                foreach ($data['file_names'] as $key => $file_detail) {
                    $fileExtension = $file_detail->getClientOriginalExtension();
                    $fileName = time(); // create file name by curent time
                    $newFileName =  $key .$fileName. '.' . $fileExtension;
                    $file_detail->storeAs('public/images/product', $newFileName);
                    $product->product_images()->saveMany([
                        new ProductImage([
                            'product_id' => $product->id,
                            'image' => $newFileName,
                        ]),
                    ]);
                }
            }
            return true;
        } catch (\Exception $e) {
            // if (isset($path) && !empty($path)) {
            //     $images = str_replace('storage', 'public',  $path);
            //     Storage::delete($images);
            // }
            // if (isset($paths) && !empty($arrImage)) {
            //     foreach ($arrImage as $value) {
            //         $images = str_replace('storage', 'public',  $value);
            //         Storage::delete($images);
            //     }
                
            // }
            Log::error($e->getMessage());
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
            Log::error($e->getMessage());
            return false;
        }
        return $product;
    }
    public function getTrashed()
    {
        $products = $this->model->onlyTrashed();
       
        return $products->orderBy('id', 'DESC')->get();
    }
    public function restore($id)
    {
        $product = $this->model->withTrashed()->findOrFail($id);
        $product->restore();
        return $product;
    }
    public function force_destroy($id)
    {
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
    }
}
