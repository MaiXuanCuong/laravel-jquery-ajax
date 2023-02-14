<?php
namespace App\Repositories\Category;

use App\Models\Category;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Log;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{

    public function getModel()
    {
        return Category::class;
    }
    public function all($request)
    {
        $categories = $this->model->select('*');
        return $categories->orderBy('id', 'DESC')->paginate(100);
    }
    public function search($request){
        $category = $this->model->select('*');
        $category->where('name', 'like', '%'.$request.'%')
        ->orWhere('description','like', '%'.$request.'%');
        return $category->orderBy('id', 'DESC')->paginate(100);
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
            return true;
        } catch (\Exception$e) {
            Log::error('Message: ' . $e->getMessage() . ' --- Line : ' . $e->getLine());
            return false;
        }
    }

    public function update($id, $data)
    {
        try {
            $category = $this->model->find($id);
            $category->name = $data->name;
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
            $category->description = $data->description;
            $category->save();
            return $category;
        } catch (\Exception$e) {
            Log::error('Message: ' . $e->getMessage() . ' --- Line : ' . $e->getLine());
        }

    }
    public function delete($id)
    {
        $category = $this->model->find($id);
        try {
            $category->delete();
            return true;
        } catch (\Exception$e) {
            Log::error($e->getMessage());
            return false;
        }
        return $category;
    }
    public function getTrashed()
    {
        $category = $this->model->onlyTrashed();
        return $category->orderBy('id', 'DESC')->paginate(100);
    }
    public function restore($id)
    {
        $category = $this->model->withTrashed()->findOrFail($id);
        $category->restore();
        return $category;
    }
    public function force_destroy($id)
    {
        $category = $this->model->onlyTrashed()->findOrFail($id);
        $category->forceDelete();
        return $category;
    }

}
