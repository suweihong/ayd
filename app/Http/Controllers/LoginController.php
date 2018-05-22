<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Models\User;



class LoginController extends Controller
{
    //login
    public function login(Request $request){
        if($request->isMethod('post')){
            $name = 'ayd1';
        $password = $request->input('password');
         if($password == ''){
           session()->flash('warning','密码不能为空');
            return redirect('/login');
        }else{
            if(Auth::attempt(['name' => $name, 'password' => $password], 1)){
                    //记录本次登录的时间
                  $this_time = now();
                  $user = User::where('name',$name)->first();
                  $user->this_time = $this_time;
                  $user->save();

                   session()->flash('success','登录成功');
                    return redirect('/');
            }else{
                    session()->flash('warning','密码错误');
                    return redirect('/login');
            }
        }

        }else{
            return view('login');
        }

    	

    }

    //logout
    public function logout()
    {
       $name = 'ayd1';
        //上次登录的时间
      $user = User::where('name',$name)->first();
      $user->last_time = $user->this_time;
      $user->save();

        Auth::logout();
        return redirect('/login');

    }
        //首页
    public function index()
    {
        $user = Auth::user();
        // $last_time = $user->last_time;
        return view('index');
    }
}
