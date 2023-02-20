<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Province;
use App\Models\Ward;
use App\Services\User\UserServiceInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;
    protected $groupService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }
    public function getProvinces()
    {
        $allProvinces = Province::all();
        return response()->json(
            ['Provinces' => $allProvinces]);
    }
    public function getDistricts(Request $request)
    {
        $province_id = $request->province_id;
        $allDistricts = District::where('province_id', $province_id)->get();
        return response()->json($allDistricts);
    }
    public function getWards(Request $request)
    {
        $district_id = $request->district_id;
        $allWards = Ward::where('district_id', $district_id)->get();
        return response()->json($allWards);
    }

    public function index()
    {   
        return view('admin.user.index');
    }
    public function getUser()
    {
        $users = $this->userService->all();
        if($users){
            return response()->json([
                'users' => $users,
                'status' => 200,
            ]);
        } else{
            return response()->json([
                'status' => 404,
                "messeges" => 'Có lỗi xãy ra',
            ]);
        }
    }

    public function store(Request $request)
    {
        $user = $this->userService->create($request);
        if ($user) {
            return response()->json([
                'user' => $user,
                'status' => 200,
                'messeges' => "Thêm thành công",
            ]);

        } else {
            return response()->json([
                'status' => 400,
                "messeges" => 'Thêm không thành công',
            ]);

        }

    }

    public function show($id)
    {
        $user = $this->userService->find($id);
        if ($user) {
            return response()->json([
                'user' => $user,
                'status' => 200,
            ]);

        } else {
            return response()->json([
                "messeges" => 'Không tìm thấy người dùng',
                'status' => 404,
            ]);
        }

    }

    public function edit($id)
    {
        $user = $this->userService->find($id);
        if ($user) {
            return response()->json([
                "user" => $user,
                "status" => 200,
            ]);

        } else {

            return response()->json([
                "messeges" => 'Không tìm thấy người dùng',
                "status" => 404,
            ]);
        }

    }

    public function update($id, Request $request)
    {
        $user = $this->userService->update($request, $id);
        if ($user) {

            return response()->json([
                'user' => $user,
                'messeges' => 'Cập nhật thành công',
                "status" => 200,
            ]);
        } else {

            return response()->json([
                'messeges' => 'Cập nhật không thành công',
                "status" => 400,
            ]);
        }

    }

    public function destroy($id)
    {
        $user = $this->userService->delete($id);
        if ($user) {

            return response()->json([
                'messeges' => 'Xóa thành công',
                "status" => 200,
            ]);
        } else {

            return response()->json([
                'messeges' => 'Xóa không thành công',
                "status" => 404,
            ]);
        }
    }
    public function getTrashCan()
    {
        $users = $this->userService->getTrashed();
        if ($users) {

            return response()->json([
                'users' => $users,
                'status' => 200,
            ]);
        } else {

            return response()->json([
                'messeges' => 'Có lỗi xãy ra',
                'status' => 404,
            ]);
        }

    }

    public function restore($id)
    {
        $user = $this->userService->restore($id);
        if ($user) {
            return response()->json([
                'messeges' => "Khôi phục thành công",
                'status' => 200,
            ]);

        } else {

            return response()->json([
                'messege' => 'Khôi phục không thành công',
                'status' => 404,
            ]);
        }
    }

    public function force_destroy($id)
    {
        $user = $this->userService->force_destroy($id);
        if ($user) {

            return response()->json([
                'messeges' => "Xóa thành công",
                'status' => 200,
            ]);

        } else {

            return response()->json([
                'messeges' => 'Xóa không thành công',
                'status' => 404,
            ]);
        }

    }
  

}
