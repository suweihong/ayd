<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\Type;
use App\Models\Place;
use App\Models\StoreType;

class FieldsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {    
        session_start();
        $store_id = $_SESSION['store_id'];
        $store = Store::find($store_id);         
        $type_id = $request->type_id;
        $item_id = $request->item_id ?? 1;
        $types = $store->types()->where('item_id',$item_id)->get();
        
        if(!$type_id){
            if(!$store->types()->get()->isEmpty()){
                $type_id = $store->types()->first()->id;
              
            }else{
               $type_id = 0;
            }
        }
        $type = Type::find($type_id);
       if($type == null){
            $places = [];
        }else{
             $places = $type->places()->where('store_id',$store_id)->get();
        }
        if($type_id == 0){
            $hours[0] = '';
            $hours[1] = '';
        }else{
            $type_hours = StoreType::where('store_id',$store_id)
                            ->where('item_id',$item_id)
                            ->where('type_id',$type_id)
                            ->first()
                            ->hours;
            if($type_hours){
                $hours = explode('-', $type_hours);
            }else{
                $hours[0] = '';
                $hours[1] = '';
            }
        }
       
       
        return view('sale.index',compact('store','type_id','places','types','hours'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     //价格配置页 按星期
    public function create(Request $request)
    {
        session_start();
        $store_id = $_SESSION['store_id'];
        $store = Store::find($store_id);

        $type_id = $request->type_id;
        $item_id = $request->item_id ?? 1;
        $types = $store->types()->where('item_id',$item_id)->get();
        $week = $request->week ?? 1;
        $now = date('Y-m-d',time());
    
        
        if(!$type_id){
            if(!$store->types()->get()->isEmpty()){
                $type_id = $store->types()->first()->id;
              
            }else{
               $type_id = 0;
            }
        }
        $type = Type::find($type_id);

       if($type == null){
            $places = [];
        }else{
             $places = $type->places()->where('store_id',$store_id)->orderBy('created_at','asc')->get();
        }

       

        return view('sale.price_week',compact('store','type_id','places','types','week','now'));
    }


     //价格配置页 按日期
    public function price_date(Request $request)
    {
        session_start();

        $store_id = $_SESSION['store_id'];
        $store = Store::find($store_id);
  
        $type_id = $request->type_id;
        $item_id = $request->item_id ?? 1;
        $types = $store->types()->where('item_id',$item_id)->get();
        $now = date('Y-m-d',time());
        //要查询的日期
        $date = $request->date ?? $now;
        $time = strtotime($date);
        //要查询的那天是 周几
        $week = date('N',$time);
     
        
        if(!$type_id){
            if(!$store->types()->get()->isEmpty()){
                $type_id = $store->types()->first()->id;
              
            }else{
               $type_id = 0;
            }
        }
        $type = Type::find($type_id);
       if($type == null){
            $places = [];
        }else{
             $places = $type->places()->where('store_id',$store_id)->get();
        }



        return view('sale.price_date',compact('store','type_id','places','types','now'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //添加场地
    public function store(Request $request)
    {
        if($request->type_id == 0){
            return back()->with('warning','请先添加运动品类');
        }else{
            Place::create([
                'store_id' => $request->store_id,
                'type_id' => $request->type_id,
            ]);
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //按星期开关场地
    public function show(Request $request,$id)
    {
        session_start();
        $store_id = $_SESSION['store_id'];
        $store = Store::find($store_id);


         $type_id = $request->type_id;
        $item_id = $request->item_id ?? 1;
        $types = $store->types()->where('item_id',$item_id)->get();
        $week = $request->week ?? 1;
        $now = date('Y-m-d',time());
        
        if(!$type_id){
            if(!$store->types()->get()->isEmpty()){
                $type_id = $store->types()->first()->id;
              
            }else{
               $type_id = 0;
            }
        }
        $type = Type::find($type_id);
       if($type == null){
            $places = [];
        }else{
             $places = $type->places()->where('store_id',$store_id)->get();
        }

        return view('sale.switch_week',compact('store','type_id','places','types','week','now'));
    }

    //按日期开关场地
    public function switch_date(Request $request)
    {
        session_start();
        $store_id = $_SESSION['store_id'];
        $store = Store::find($store_id);



         $type_id = $request->type_id;
        $item_id = $request->item_id ?? 1;
        $types = $store->types()->where('item_id',$item_id)->get();
        $now = date('Y-m-d',time());
        
        if(!$type_id){
            if(!$store->types()->get()->isEmpty()){
                $type_id = $store->types()->first()->id;
              
            }else{
               $type_id = 0;
            }
        }
        $type = Type::find($type_id);
       if($type == null){
            $places = [];
        }else{
             $places = $type->places()->where('store_id',$store_id)->get();
        }
        return view('sale.switch_date',compact('store','type_id','places','types','now'));
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
    public function destroy($id)
    {
        //
    }
}
