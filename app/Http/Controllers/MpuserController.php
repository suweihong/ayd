<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

use App\Models\MpUser;
use App\Models\Store;

class MpuserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        session_start();
        // $store_id = $_SESSION['store_id'];
        $store_id = $request->store_id;
        $store = Store::find($store_id);
        return view('store.admin',compact('store'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mp_user = MpUser::where('account',$request->account)->get();
        if(!$mp_user->isEmpty()){
            return back()->with('warning','管理员已经存在');
        }else{
            if(!$request->account || !$request->password){
        
            // session()->flash('warning','请填写完整内容');
            // return redirect('mpusers/create?store_id='.$store_id);
                return back()->withInput()->with('warning','请填写完整内容');
            }else{
                $regex = "/^((13[0-9])|(14[5|7])|(15([0-3]|[5-9]))|(18[0-9]))\\d{8}$/";
                if(preg_match($regex,$request->account)){
                    if(preg_match("/^[\d]{6}$/",$request->password)){
                         $mp_user = MpUser::create([
                            'store_id' => $request->store_id,
                            'account' => $request->account,
                            'password' => Hash::make($request->password),
                        ]);
                         if($mp_user){   
                            return back()->withInput()->with('success','管理员设置成功');
                         }else{
                            return back()->withInput()->with('warning','管理员设置失败');
                         }
                    }else{
                        return back()->withInput()->with('warning','请输入6位数字');
                    }
                }else{
                    return back()->withInput()->with('warning','请输入正确的手机号');
                }
               
               
            }
        }
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {

        //重置密码为12345
        if($id == 'aaa'){
             return response()->json([
                                    'errcode'=> '2',
                                    'errmsg'=> '请先设置管理员',
                                    ], 200);
        }else{
            $mp_user = MpUser::find($id);
            $res = $mp_user-> update([
                    'password' => Hash::make('123456'),
                ]);
            if($res){
                return response()->json([
                                    'errcode'=> '1',
                                    'errmsg'=> '管理员密码重置成功',
                                    ], 200);
            }else{
                return response()->json([
                                'errcode'=> '2',
                                'errmsg'=> '管理员密码重置失败',
                                ], 200);
            }
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
