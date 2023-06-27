<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function getLogin(){
        return view('admin.auth.login');
    }

    public function login(LoginRequest $request){

        //make validation
        $remember_me = $request->has('remember') ? true : false;

        if (auth()->guard('admin')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')], $remember_me)) {
            // $notify()->success('تم الدخول بنجاح');
          return redirect()->route('admin.dashboard');
        } else {
            // $notify()->error('خطأ في البيانات برجاء المحاولة مجددا');
            return redirect()-> back()->withErrors(['error'=>'هناك خطأ بالبيانات']);
        }

    }
}
