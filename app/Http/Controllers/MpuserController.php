<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

use App\Models\MpUser;

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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $mp_user = new MpUser;
        // $mp_user->store_id = $request->store_id;
        // $mp_user->account = $request->account;
        // $mp_user->password = Crypt::encrypt($request->password);
        // $res = $mp_user->save();
        $mp_user = MpUser::create([
            'store_id' => $request->store_id,
            'account' => $request->account,
            'password' => Crypt::encrypt($request->password),
            ]);
        if($mp_user){
            return 1;
        }else{
            return 2;
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
        $request->password = '12345';
        // $de = Crypt::decrypt($mp_user->password);
        // return $de;
        $res = $mp_user-> update([
                'password' => Crypt::encrypt($request->password),
            ]);
        if($res){
            return 1;
        }else{
            return 2;
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
