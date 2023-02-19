<?php
namespace App\Repositories\Category;

use App\Models\Category;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{

    public function getModel()
    {
        return Category::class;
    }
    public function all()
    {
        $categories = $this->model->select('*');
        return $categories->orderBy('id', 'DESC')->get();
    }
    public function create($data)
    {
        try {
            $category = $this->model;
            $category->name = $data->name;
            $category->description = $data->description;
            $fieldName = 'inputFileAdd';
            if ($data->hasFile($fieldName)) {
                $fullFileNameOrigin = $data->file($fieldName)->getClientOriginalName();
                $fileNameOrigin = pathinfo($fullFileNameOrigin, PATHINFO_FILENAME);
                $extenshion = $data->file($fieldName)->getClientOriginalExtension();
                $fileName = $fileNameOrigin . '-' . rand() . '_' . time() . '.' . $extenshion;
                $path = 'storage/' . $data->file($fieldName)->storeAs('public/images/categories', $fileName);
                $path = str_replace('public/', '', $path);
                $category->image = $path;
            }
            $category->save();
            return $category;
        } catch (\Exception$e) {
            if (isset($path) && !empty($path)) {
                $images = str_replace('storage', 'public',  $path);
                Storage::delete($images);
            }
            Log::error('Message: ' . $e->getMessage() . ' --- Line : ' . $e->getLine());
            return false;
        }
    }

    public function update($id, $data)
    {
        try {
            $category = $this->model->find($id);
            $item = $category->image;
            $category->name = $data->name;
            $category->description = $data->description;
            $fieldName = 'inputFileUpdate';
            if ($data->hasFile($fieldName)) {
                $fullFileNameOrigin = $data->file($fieldName)->getClientOriginalName();
                $fileNameOrigin = pathinfo($fullFileNameOrigin, PATHINFO_FILENAME);
                $extenshion = $data->file($fieldName)->getClientOriginalExtension();
                $fileName = $fileNameOrigin . '-' . rand() . '_' . time() . '.' . $extenshion;
                $path = 'storage/' . $data->file($fieldName)->storeAs('public/images', $fileName);
                $path = str_replace('public/', '', $path);
                $category->image = $path;
            }
           
            if (isset($item) && isset($path)) {
                $images = str_replace('storage', 'public',  $item);
                Storage::delete($images);
            }
            $category->save();
            return $category;
        } catch (\Exception$e) {
            if (isset($path)) {
                $images = str_replace('storage', 'public', $path);
                Storage::delete($images);
            }
            Log::error('Message: ' . $e->getMessage() . ' --- Line : ' . $e->getLine());
            return false;
        }

    }
    public function delete($id)
    {
        $category = $this->model->find($id);
        try {
            $category->delete();
            return true;
        } catch (\Exception$e) {
            Log::error('Message: ' . $e->getMessage() . ' --- Line : ' . $e->getLine());
            return false;
        }
       
    }
    public function getTrashed()
    {
        try {
            $category = $this->model->onlyTrashed();
            return $category->orderBy('deleted_at', 'DESC')->get();
        } catch (\Exception $e) {
            Log::error('Message: ' . $e->getMessage() . ' --- Line : ' . $e->getLine());
            return false;
        }
    }
    public function restore($id)
    {   
        try {
            $category = $this->model->onlyTrashed()->find($id);
            $category->restore();
            return $category;
          
        } catch (\Exception $e) {
            Log::error('Message: ' . $e->getMessage() . ' --- Line : ' . $e->getLine());
            return false;
        }
    }
    public function force_destroy($id)
    {
        try {
            $category = $this->model->onlyTrashed()->find($id);
            $item = $category->image;
            $images = str_replace('storage', 'public', $item);
            $category->forceDelete();
            Storage::delete($images);
            return $category;
        } catch (\Exception $e) {
            Log::error('Message: ' . $e->getMessage() . ' --- Line : ' . $e->getLine());
            return false;
        }
    }

}
