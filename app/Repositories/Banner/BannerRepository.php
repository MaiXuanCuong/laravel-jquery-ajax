<?php

namespace App\Repositories\Banner;

use App\Models\Banner;
use App\Repositories\BaseRepository;
use App\Traits\StorageImageTrait;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class BannerRepository extends BaseRepository implements BannerRepositoryInterface {
    use StorageImageTrait;
    function getModel() {
        return Banner::class;
    }
    public function all()
    {
        $banner = $this->model->select('*');
        return $banner->orderBy('id', 'DESC')->get();
    }
    function create($request) {
        try {
            $banner = $this->model;
            $banner->status = $request->status;
            $fieldName = 'inputFileAdd';
            if ($request->hasFile($fieldName)) {
                $extenshion = $request->file($fieldName)->getClientOriginalExtension();
                $fileName = rand() . '_' . time() . '.' . $extenshion;
                $path = 'storage/' . $request->file($fieldName)->storeAs('public/images/banners', $fileName);
                $path = str_replace('public/', '', $path);
                $banner->image = $path;
            }
            $banner->save();
            return $banner;
        } catch (\Exception $e) {
            if (isset($path) && !empty($path)) {
                $images = str_replace('storage', 'public',  $path);
                Storage::delete($images);
            }
            Log::error('message: ' . $e->getMessage() . ' line: ' . $e->getLine() . ' file: ' . $e->getFile());
            return false;
        }
    }
    function update($request, $id) {
        try {
            $banner = $this->model->find($id);
            $item = $banner->image;
            $banner->status = $request->status;
            $fieldName = 'inputFileUpdate';
            if ($request->hasFile($fieldName)) {
                $extenshion = $request->file($fieldName)->getClientOriginalExtension();
                $fileName = rand() . '_' . time() . '.' . $extenshion;
                $path = 'storage/' . $request->file($fieldName)->storeAs('public/images/banners', $fileName);
                $path = str_replace('public/', '', $path);
                $banner->image = $path;
            }
           
            if (isset($item) && isset($path)) {
                $images = str_replace('storage', 'public',  $item);
                Storage::delete($images);
            }
            $banner->save();
            return $banner;
        } catch (\Exception$e) {
            if (isset($path)) {
                $images = str_replace('storage', 'public', $path);
                Storage::delete($images);
            }
            Log::error('message: ' . $e->getMessage() . ' line: ' . $e->getLine() . ' file: ' . $e->getFile());
            return false;
        }
    }
  
    function delete($id) {
        try {
            $banner = $this->model->find($id);
            $item = $banner->image;
            $images = str_replace('storage', 'public', $item);
            $banner->delete();
            Storage::delete($images);
            return $banner;
        } catch (\Exception $e) {
            Log::error('message: ' . $e->getMessage() . ' line: ' . $e->getLine() . ' file: ' . $e->getFile());
            return false;
        }
    }
}