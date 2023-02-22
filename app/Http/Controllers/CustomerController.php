<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    public function register(Request $request)
    {
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->password = bcrypt($request->password);
        try {
            $customer->save();
            if (Auth::guard('customers')->attempt(['email' => $request->email, 'password' => $request->password])) {
                
            }
        } catch (\Exception$e) {
            return back()->withInput();
        }
    }
    public function login(Request $request)
    {
        $arr = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if (Auth::guard('customers')->attempt($arr)) {
            return redirect()->route('shop.home');
        } else {
            return back()->withInput();
        }
    }
    public function logout()
    {
        Auth::guard('customers')->logout();
        return redirect()->route('shop.home');
    }
    public function edit($id)
    {
        $customer = Customer::find($id);
        return view('admin.customers.edit', compact('customer'));
    }
    public function update(Request $request)
    {
        try {
            if (isset(Auth::guard('customers')->user()->id)) {
              
                $customer = Customer::find(Auth::guard('customers')->user()->id);
                $customer->name = $request->name;

                if (!empty($request->passwordOld) && !empty($request->passwordNew) && !empty($request->passwordConfirm)) {
                   
                    if ((Hash::check($request->passwordOld, $customer->password))) {
                        $customer->password = bcrypt($request->passwordNew);

                    }
                }
                $customer->save();

            }
            return redirect()->route('shop.home');
        } catch (\Exception$e) {
            Log::error('message: ' . $e->getMessage() . ' line: ' . $e->getLine() . ' file: ' . $e->getFile());
            
            return back()->withInput();
        }
    }
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        try {
            $customer->delete();

            if (!$customer->delete()) {
            }
        } catch (\Exception$e) {
            return redirect()->route('customers');

        }
        return redirect()->route('customers');
    }
    public function changepassmail(Request $request)
    {
        $customer = DB::table('customers')->where('email', $request->emails)->first();
        if (!$customer) {
            return back()->withInput();
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
                Mail::send('shop.emails.password', compact('params'), function ($email) use ($customer) {
                    $email->subject('TCC-Shop');
                    $email->to($customer->email, $customer->name);
                });
                return back()->withInput();
            } catch (\Exception$e) {
                Log::error('message: ' . $e->getMessage() . 'line: ' . $e->getLine() . 'file: ' . $e->getFile());

                return back()->withInput();
            }
        } else {

            return back()->withInput();
        }
    }
}
