<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\District;
use App\Models\Province;
use App\Models\User;
use App\Models\Ward;
use App\Services\User\UserServiceInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

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
        $users = User::All();
        return response()->json([
            'users' => $users,
        ]);
    }

    public function store(Request $request)
    {
        try {
            $user = $this->userService->create($request);

            return response()->json([
                'status' => 200,
                'messenger' => "thành công"
            ]);

        } catch (Exception $e) {
            return response()->json([
                'status' => 400,
                'error' => "lỗi"
            ]);

        }
    }

    public function show($id)
    {
        $user = $this->userService->find($id);
        return view('admin.users.detail', compact('user'));
    }

    public function edit($id)
    {
        try {
            $user = $this->userService->find($id);
            return response()->json([
                "user" => $user,
                "status" => 200,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "messege" => 'user not found',
                "status" => 404,
            ]);
        }
       

    }

    public function update($id,Request $request)
    {
        try {

            if($this->userService->update($request, $id)){

                return response()->json([
                    "status" => 200,
                ]);
            }
            
        } catch (Exception $e) {
            return response()->json([
                "status" => 400,
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            $this->userService->delete($id);
            return response()->json([
                "status" => 200,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => 404,
            ]);
        }
    }
    public function getTrashCan()
    {
        try {
        $users = $this->userService->getTrashed();
        return response()->json([
            'users' => $users,
            'status' => 200,
        ]);
        } catch (\Exception $e) {
            return response()->json([
                'messege' => 'not fund',
                'status' => 404,
            ]);
        }
       

     
    }

    public function restore($id)
    {
        try {
            $this->userService->restore($id);
            return response()->json([
                'message' => "Khôi phục thành công",
                'status' => 200,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'messege' => 'Khôi phục không thành công',
                'status' => 404,
            ]);
        }
    }

    public function force_destroy($id)
    {
        try {
            $this->userService->force_destroy($id);
            return response()->json([
                'message' => "Xóa thành công",
                'status' => 200,
            ]);

        } catch (Exception $e) {
            return response()->json([
                'messege' => 'Xóa không thành công',
                'status' => 404,
            ]);
        }
    }
    public function info()
    {
        $item = Auth()->user();
        return view('admin.Users.infor', compact('item'));
    }

    public function update_info(Request $request, $id)
    {
        try {
            $item = $this->userService->update_info($request, $id);
        } catch (\Exception$e) {
        }
    }
    public function change_password(Request $request)
    {
        if ($request->renewpassword == $request->newpassword) {
            if ((Hash::check($request->password, Auth::user()->password))) {
                $item = User::find(Auth()->user()->id);
                $item->password = bcrypt($request->newpassword);
                $item->save();
            } else {

            }
        } else {

        }
    }
    public function password_by_email(Request $request)
    {
        if ($request->email == Auth()->user()->email) {
            $password = Str::random(6);
            $item = User::find(Auth()->user()->id);
            $item->password = bcrypt($password);
            $item->save();
            $params = [
                'name' => Auth()->user()->name,
                'password' => $password,
            ];
            Mail::send('admin.emails.password', compact('params'), function ($email) {
                $email->subject('TCC-Shop');
                $email->to(Auth()->user()->email, Auth()->user()->name);
            });
            return redirect()->route('user.info');
        } else {
            return redirect()->route('user.info');
        }
    }
    public function accountByEmail(Request $request)
    {
        $user = DB::table('users')->where('email', $request->email)->first();
        if ($request->email == $user->email) {
            try {
                $password = Str::random(6);
                $item = User::find($user->id);
                $item->password = bcrypt($password);
                $item->save();
                $params = [
                    'name' => $user->name,
                    'password' => $password,
                ];
                Mail::send('admin.emails.password', compact('params'), function ($email) use ($user) {
                    $email->subject('TCC-Shop');
                    $email->to($user->email, $user->name);
                });
                Session::flash('success', config('define.update.succes'));
                return redirect()->route('login');
            } catch (\Exception$e) {
                Log::error('message: ' . $e->getMessage() . 'line: ' . $e->getLine() . 'file: ' . $e->getFile());
            }
        } else {
            Session::flash('error', config('define.update.error'));
            return redirect()->route('login');
        }
    }
    public function changePassByEmailCustomer(Request $request)
    {
        $customer = DB::table('customers')->where('email', $request->email)->first();
        if (!$customer) {
            return response()->json([
                'message' => 'Mail không tồn tại',
                'status' => false,
            ], 401);
        }
        if ($request->email == $customer->email && $customer->phone != 0) {
            try {
                $password = Str::random(6);
                $item = Customer::find($customer->id);
                $item->password = bcrypt($password);
                $item->save();
                $params = [
                    'name' => $customer->name,
                    'password' => $password,
                ];
                Mail::send('admin.emails.password', compact('params'), function ($email) use ($customer) {
                    $email->subject('TCC-Shop');
                    $email->to($customer->email, $customer->name);
                });
                return response()->json([
                    'message' => 'Gửi mật khẩu về mail thành công',
                    'user' => $customer,
                ], 201);
            } catch (\Exception$e) {
                Log::error('message: ' . $e->getMessage() . 'line: ' . $e->getLine() . 'file: ' . $e->getFile());
                return response()->json([
                    'message' => 'Mail không tồn tại',
                    'status' => false,
                ], 401);
            }
        } else {
            return response()->json([
                'message' => 'Mail không tồn tại',
                'status' => false,
            ], 401);
        }
    }
}
