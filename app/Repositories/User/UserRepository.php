<?php

namespace App\Repositories\User;
use App\Repositories\BaseRepository;
use App\Models\User;
use App\Traits\StorageImageTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    use StorageImageTrait;

    public function getModel()
    {
        return User::class;
    }

    public function all($request)
    {
        $users = $this->model->select('*');
        return $users->orderBy('id', 'DESC')->paginate(100);
    }
    public function search($request){
        $users = $this->model->select('*');
       
        $users->where('name', 'like', '%'.$request.'%')
        ->orWhere('phone','like', '%'.$request.'%')
        ->orWhere('gender','like', '%'.$request.'%')
        ->orWhere('email','like', '%'.$request.'%');
        return $users->orderBy('id', 'DESC')->paginate(100);
    }
    public function delete($id)
    {
        $user = $this->model->findOrFail($id);
        try {
            $user->delete();
            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
        return $user;
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
                $path = 'storage/' . $data->file($fieldName)->storeAs('public/images', $fileName);
                $path = str_replace('public/', '', $path);
                $user->image = $path;
            }
            $user->save();
            //     $params = [
            //     "password" => $password,
            //     'name' => $data->name,
            // ];
            // Mail::send('admin.emails.users', compact('params'), function ($email) use ($data) {
            //     $email->subject('TCC-Shop');
            //     $email->to($data->email, $data->name);
            // });

            // DB::commit();
            // Session::flash('success', 'Thêm nhân viên' . ' ' . $data->name . ' ' . 'thành công');
            return true;
        } catch (\Exception $e) {
            // DB::rollBack();
            Log::error('Message: ' . $e->getMessage() . ' --- Line : ' . $e->getLine());
            return false;
        }
        return $user;
    }


    public function update($data, $id)
    {

        // Log::error('Message: ' . $data);
        try {

            $user = $this->model->find($id);
            $user->name = $data->username;
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
                $path = 'storage/' . $data->file($fieldName)->storeAs('public/images', $fileName);
                $path = str_replace('public/', '', $path);
                $user->image = $path;
            }
            $user->save();
         
            return true;
        } catch (\Exception $e) {
            Log::error('Message: ' . $e->getMessage() . ' --- Line : ' . $e->getLine());
            return false;
        }
    }
    public function getTrashed()
    {
        $users = $this->model->onlyTrashed();
        return $users->orderBy('id', 'DESC')->paginate(100);
    }

    public function restore($id)
    {
        $user = $this->model->onlyTrashed()->findOrFail($id);
        try {
            $user->restore();
            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
        return $user;
    }

    public function force_destroy($id)
    {
        $user = $this->model->onlyTrashed()->findOrFail($id);
        $user->forceDelete();
        return $user;
    }
    public function update_info($request,$id)
    {
        $item=User::find($id);
        $item->name = $request->name;
        $item->address = $request->address;
        $item->phone = $request->phone;
        $item->email = $request->email;
        $item->gender = $request->gender;
        $item->birthday = $request->birth_day;
        $item->province_id = $request->province_id;
        $item->district_id = $request->district_id;
        $item->ward_id = $request->ward_id;

        $file = $request->inputFile;
        if ($request->hasFile('inputFileUpdate')) {
            $images = 'public/images/user/'.$item->image;
            $fileExtension = $file->getClientOriginalName();
            //Lưu file vào thư mục storage/app/public/image với tên mới
            $request->file('inputFileUpdate')->storeAs('public/images_admin', $fileExtension);
            // Gán trường image của đối tượng task với tên mới
            $item->image = $fileExtension;
        }
        try {
            $item->save();
            if(isset($fileExtension)){
                Storage::delete($images);
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            $image = 'public/images_admin/'.$fileExtension;
            Storage::delete($image);
        }
        return $item;
    }
}
