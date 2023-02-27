<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CustomerController extends Controller
{
    public function changepassmail(Request $request)
    {
        $customer = DB::table('customers')->where('email', $request->email)->first();
        if (!$customer) {
           return response()->json([
            'status' => 404,
            'message' => 'Không tìm thấy'
           ]);
        }
        if ($request->emails == $customer->email) {
            try {
                $password = Str::random(6);
                $item = Customer::find($customer->id);
                $item->password = bcrypt($password);
                $item->save();
                $params = [
                    'name' => $customer->name,
                    'password' => $password,
                ];
                Mail::send('admin.mail.mailPasswordUser', compact('params'), function ($email) use ($customer) {
                    $email->subject('Xuân Cường Shop');
                    $email->to($customer->email, $customer->name);
                });
                return response()->json([
                    'status' => 200,
                    'message' => 'Thành công'
                   ]);
            } catch (\Exception$e) {
                Log::error('message: ' . $e->getMessage() . 'line: ' . $e->getLine() . 'file: ' . $e->getFile());
                return response()->json([
                    'status' => 400,
                    'message' => 'Không thành công'
                   ]);
            }
        } 
    }
}
