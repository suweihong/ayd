<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

// use App\Models\User;
use App\Models\Complaint;
use App\Models\Order;
use App\Models\Bill;
use App\Models\AydUser;


class LoginController extends Controller
{
    //login
    public function login(Request $request){
        if($request->isMethod('post')){
            $name = 'ayd';
            $user = AydUser::where('name',$name)->first();
            $password = $request->input('password');
             if($password == ''){
               session()->flash('warning','密码不能为空');

                return redirect('/login');
            }else{
                // if(Auth::attempt(['name' => $name, 'password' => $password], 1)){
                //         //记录本次登录的时间
                //       $this_time = now();
                //       $user = AydUser::where('name',$name)->first();
                //       $user->this_time = $this_time;
                //       $user->save();

                       // session()->flash('success','登录成功');
                if(Hash::check($password,$user->password)){
                  session_start();
                  $_SESSION['ayduser']=$name;
                  isset($PHPSESSID)?session_id($PHPSESSID):$PHPSESSID = session_id();
                  $time=1*51840000;
                  setcookie(session_name(),session_id(),time()+$time,"/");
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
      session_start();
       $name = 'ayd';
        //上次登录的时间
      $user = AydUser::where('name',$name)->first();
      $user->last_time = $user->this_time;
      $user->save();

      // $_SESSION['ayduser']='';
       unset($_SESSION['ayduser']);
        // Auth::logout();
        return redirect('/login');

    }
        //首页
    public function index(Request $request)
    {

          // $user = Auth::user();
          //最后一次登录时间 存到session
              // session_start();
              $ayd_name = $_SESSION['ayduser'];
              $user = AydUser::where('name',$ayd_name)->first();


              $_SESSION['last_time']=$user->last_time;
              isset($PHPSESSID)?session_id($PHPSESSID):$PHPSESSID = session_id();
              $time=1*51840000;
              setcookie(session_name(),session_id(),time()+$time,"/");
          // session(['last_time'=>$user->last_time]);
          // $last_time = session('last_time');

          //消息动态 最近一个月的
          $today = date('Y-m-d H:i:s');
          $date = date('Y-m-d H:i:s',strtotime('today') - 2592000);
          $complaints = Complaint::whereBetween('created_at',[$date,$today])
                                    ->orderBy('created_at','desc')
                                    ->get();
            //今日订单概览
          $today = strtotime(date('Y-m-d'));
          $today_start = date('Y-m-d H:i:s',$today);
          $today_end = date('Y-m-d H:i:s',$today+60*60*24);
                    //今日下单数量
          $num_x = Order::where('created_at','>=',$today_start)->where('created_at','<',$today_end)->where('status_id','!=',0)->count();
              //今日核销数
          $num_h = Order::where('updated_at','>=',$today_start)->where('updated_at','<',$today_end)->where('status_id',1)->count();
              //今日退单数
          $num_t = Order::where('updated_at','>=',$today_start)->where('updated_at','<',$today_end)->where('status_id',2)->count();

             //销售总额

          $orders = Order::where('status_id','!=',0)->pluck('total'); 
          $total = $orders->sum();//默认销售总额
          $total_avg = floor($orders->avg() * 100) / 100;//默认平均单价

          $yday_start = date('Y-m-d 00:00:00',time()-24*60*60);//昨天开始的时间

          $m_start=date('Y-m-01 00:00:00',time());//获取指定月份的第一天
          $m_end=date('Y-m-t 23:59:59',time()); //获取指定月份的最后一天
          $time = $request->time;
          
          if($time == 1){
                   //今日销售
              $orders = Order::where('created_at','>=',$today_start)->where('created_at','<',$today_end)->where('status_id','!=',0)->pluck('total');
              $t_total = $orders->sum();
              $t_avg = floor($orders->avg()*100)/100;
          }elseif ($time == 2) {
                  //昨日销售
              $orders = Order::where('created_at','>=',$yday_start)->where('created_at','<',$today_start)->where('status_id','!=',0)->pluck('total');
              $y_total = $orders->sum();
              $y_avg = floor($orders->avg()*100)/100;
          }elseif ($time == 3){
                 //本月销售
              $orders = Order::where('created_at','>=',$m_start)->where('created_at','<=',$m_end)->where('status_id','!=',0)->pluck('total');
              $m_total = $orders->sum();
              $m_avg = floor($orders->avg()*100)/100;
          }

        return view('index',compact('complaints','num_x','num_h','num_t','total','total_avg','t_total','t_avg','time','y_total','y_avg','m_total','m_avg'));
    }
}
