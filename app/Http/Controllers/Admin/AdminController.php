<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Admin\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function index(Request $request)
    {
        if($request->session()->has('ADMIN_LOGIN')){
            return redirect('admin/dashboard');
        }else{
            return view('admin.login');
        }

    }


    public function auth(Request $request)
    {
        //
        $email  = $request->post('email');
        $password  = $request->post('password');

        // $result = Admin::where(['email'=>$email, 'password'=>$password])->get();
        $result = Admin::where(['email'=>$email])->first();

        if ($result) {
            if (Hash::check($request->post('password'), $result->password)) {
                $request->session()->put('ADMIN_LOGIN',true);
                $request->session()->put('ADMIN_ID',($result->id));
                return redirect('admin/dashboard');
            }else {
                $request->session()->flash('error','Please type valid password.');
                return redirect('admin');
            }

        }else {
            $request->session()->flash('error','Please type valid email.');
            return redirect('admin');
        }
        // echo '<pre>';
        // print_r($result);

        // if(isset($result['0']->id)){
        //   $request->session()->put('ADMIN_LOGIN',true);
        //   $request->session()->put('ADMIN_ID',($result['0']->id));
        //   return redirect('Admin/dashboard');
        // }else{
        //   $request->session()->flash('error','Please type valid login details.');
        //   return redirect('Admin');
        // }
    }


    public function dashboard()
    {
        //
        return view('admin.dashboard');
    }



}
