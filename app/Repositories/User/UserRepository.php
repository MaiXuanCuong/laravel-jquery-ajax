<?php

namespace App\Repositories\User;
use App\Repositories\BaseRepository;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{

    public function getModel()
    {
        return User::class;
    }

    public function all()
    {
        $users = $this->model->select('*');
        return $users->orderBy('id', 'DESC')->get();
    }
 
    public function delete($id)
    {
        try {
            $user = $this->model->find($id);
            $user->delete();
            return true;
        } catch (\Exception $e) {
           Log::error('message: ' . $e->getMessage() . ' line: ' . $e->getLine() . ' file: ' . $e->getFile());
            return false;
        }
    }

    public function create($data)
    {
        try {
            $user = $this->model;
            $user->name = $data->name;
            $user->phone = $data->phone;
            $password = Str::random(6);
            $user->password = Hash::make($password);
            $user->birthday = $data->birthday;
            $user->email = $data->email;
            $user->gender = $data->gender;
            $user->province_id = $data->province_id;
            $user->ward_id = $data->ward_id;
            $user->district_id = $data->district_id;
            $fieldName = 'inputFileAdd';
            if ($data->hasFile($fieldName)) {
                $fullFileNameOrigin = $data->file($fieldName)->getClientOriginalName();
                $fileNameOrigin = pathinfo($fullFileNameOrigin, PATHINFO_FILENAME);
                $extenshion = $data->file($fieldName)->getClientOriginalExtension();
                $fileName = $fileNameOrigin . '-' . rand() . '_' . time() . '.' . $extenshion;
                $path = 'storage/' . $data->file($fieldName)->storeAs('public/images/users', $fileName);
                $path = str_replace('public/', '', $path);
                $user->image = $path;
            }

            $user->save();
                $params = [
                "password" => $password,
                'name' => $data->name,
            ];
            Mail::send('admin.mail.mailPasswordUser', compact('params'), function ($email) use ($data) {
                $email->subject('Xuân Cường Shop');
                $email->to($data->email, $data->name);
            });
            return $user;
        } catch (\Exception $e) {
            if (isset($path) && !empty($path)) {
                $images = str_replace('storage', 'public',  $path);
                Storage::delete($images);
            }
           Log::error('message: ' . $e->getMessage() . ' line: ' . $e->getLine() . ' file: ' . $e->getFile());
            return false;
        }
    }


    public function update($data, $id)
    {
        try {

            $user = $this->model->find($id);
            $item = $user->image;
            $user->name = $data->name;
            $user->phone = $data->phone;
            $user->birthday = $data->birthday;
            $user->email = $data->email;
            $user->gender = $data->gender;
            $user->province_id = $data->province_id;
            $user->ward_id = $data->ward_id;
            $user->district_id = $data->district_id;
            $fieldName = 'inputFileUpdate';
          
            if ($data->hasFile($fieldName)) {
                $fullFileNameOrigin = $data->file($fieldName)->getClientOriginalName();
                $fileNameOrigin = pathinfo($fullFileNameOrigin, PATHINFO_FILENAME);
                $extenshion = $data->file($fieldName)->getClientOriginalExtension();
                $fileName = $fileNameOrigin . '-' . rand() . '_' . time() . '.' . $extenshion;
                $path = 'storage/' . $data->file($fieldName)->storeAs('public/images/users', $fileName);
                $path = str_replace('public/', '', $path);
                $user->image = $path;
            }
             
            if (isset($item) && isset($path)) {
                $images = str_replace('storage', 'public',  $item);
                Storage::delete($images);
            }
            $user->save();
         
            return $user;
        } catch (\Exception $e) {
            if (isset($path)) {
                $images = str_replace('storage', 'public', $path);
                Storage::delete($images);
            }
           Log::error('message: ' . $e->getMessage() . ' line: ' . $e->getLine() . ' file: ' . $e->getFile());
            return false;
        }
    }
    public function getTrashed()
    {   try {
        $users = $this->model->onlyTrashed();
        return $users->orderBy('deleted_at', 'DESC')->get();
      
    } catch (\Exception $e) {
       Log::error('message: ' . $e->getMessage() . ' line: ' . $e->getLine() . ' file: ' . $e->getFile());
        return false;
    }
    }

    public function restore($id)
    {   
        try {
            $user = $this->model->onlyTrashed()->find($id);
            $user->restore();
            return true;
        } catch (\Exception $e) {
           Log::error('message: ' . $e->getMessage() . ' line: ' . $e->getLine() . ' file: ' . $e->getFile());
            return false;
        }
    }

    public function force_destroy($id)
    {   
        try {
            $user = $this->model->onlyTrashed()->find($id);
            $item = $user->image;
            $images = str_replace('storage', 'public', $item);
            $user->forceDelete();
            Storage::delete($images);
            return $user;
            ;
        } catch (\Exception $e) {
           Log::error('message: ' . $e->getMessage() . ' line: ' . $e->getLine() . ' file: ' . $e->getFile());
            return false;
        }
    }
   
}
