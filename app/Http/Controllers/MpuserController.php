<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

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
        $store_id = $_SESSION['store_id'];
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

        if(!$request->account || !$request->password){
        
            // session()->flash('warning','请填写完整内容');
            // return redirect('mpusers/create?store_id='.$store_id);
            return back()->withInput()->with('warning','请填写完整内容');
        }else{

            $mp_user = MpUser::create([
                'store_id' => $request->store_id,
                'account' => $request->account,
                'password' => Crypt::encrypt($request->password),
                ]);
            if($mp_user){             
                 return back()->withInput()->with('warning','管理员设置成功');
            }else{
                 return back()->withInput()->with('warning','管理员设置成功');
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
        
        $mp_user = MpUser::find($id);
        $request->password = '123456';
        $res = $mp_user-> update([
                'password' => Crypt::encrypt($request->password),
            ]);
        if($res){
            return back()->with('success','管理员密码重置成功');
        }else{
            return back()->with('success','管理员密码重置失败');
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
