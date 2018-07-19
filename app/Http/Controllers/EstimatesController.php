<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\Estimate;

class EstimatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        session_start();
        if($request->check_id){
            $check_id = $request->check_id;
            //所有商家的评价
            if($check_id == 33){
                $estimates = Estimate::orderBy('created_at','desc')->paginate(5);
            }elseif($check_id == 5){
                $estimates = Estimate::where('check_id',5)->orWhere('check_id',6)->orderBy('created_at','desc')->paginate(5);
            }else{
                $estimates = Estimate::where('check_id',$check_id)->orderBy('created_at','desc')->paginate(5);
            }
            
            return view('estimates.list',compact('estimates','check_id'));

        }else{
            //指定商家的 评价
            $store_id = $request->store_id;
            $store = Store::find($store_id);
            dump($store_id);
            $estimate_list = $store->estimates;
            $estimates = $store->estimates()->orderBy('created_at','desc')->paginate(1);

           $environment = floor($estimate_list->pluck('environment')->avg() * 100)/100;

           $service = floor($estimate_list->pluck('service')->avg() * 100)/100;

           $average = floor($estimate_list->pluck('average')->avg() * 100)/100;
            return view('estimates.index',compact('store','estimates','environment','service','average'));
        }

       
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
        $estimates = Estimate::find($id);
        if($request->check_id == 1){
            $estimates->update([
                'check_id' => 6,
                ]);
        }else{
            $estimates->update([
                'check_id' => 5,
                ]);
        }
        return response()->json([
            'errcode' => '1',
            'errmsg' => '成功审核该评论',
            ],200) ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $estimates = Estimate::find($id);
        $res = $estimates -> delete();
        return response()->json([
                            'errcode'=> '1',
                            'errmsg'=> '删除成功',
                            ], 200);
    }
}
