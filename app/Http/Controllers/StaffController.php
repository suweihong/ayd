<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\Staff;

use Log;
use Overtrue\Socialite\User as SocialiteUser;


class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        session_start();
        // $store_id = $_SESSION['store_id'];
     
        $store_id = $request->store_id;
        $store = Store::find($store_id);
        $staffs = $store->staffs()->get();
        return view('store.staff',compact('store','staffs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        session_start();
        $store_id = $_SESSION['store_id'];
        dump($store_id);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Staff $staff)
    {
        $staff->delete();
        return response()->json([
            'errcode' => '100',
            'errmsg' => '删除成功'
        ],200);
    }

    //获取微信 用户信息
    public function serve(Request $request)
    { 
        $user = [];
        $user = new SocialiteUser([
                'id' => array_get($user, 'openid'),
                'name' => array_get($user, 'nickname'),
                'nickname' => array_get($user, 'nickname'),
                'avatar' => array_get($user, 'headimgurl'),
                'email' => null,
                'original' => [],
                'provider' => 'WeChat',
            ]);
        session(['wechat.oauth_user.default' => $user]); // 同理，`default` 可以更换为您对应的其它配置名

       $user = session('wechat.oauth_user'); // 拿到授权用户资料
       dump(333);
        dd($user);

    }
}
