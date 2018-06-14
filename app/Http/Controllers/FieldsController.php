<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\Type;
use App\Models\Place;
use App\Models\StoreType;
use App\Models\Field;

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
             $places = $type->places()->where('store_id',$store_id)->orderBy('id','asc')->get();
        }
        if($type_id == 0){
            $hours[0] = '';
            $hours[1] = '';
        }else{
            $type_hours = StoreType::where('store_id',$store_id)
                            ->where('item_id',$item_id)
                            ->where('type_id',$type_id)
                            ->first();
                         
            if(!$type_hours){ 
              $hours[0] = '';
              $hours[1] = '';
            }else{
           
              $type_hours = $type_hours->hours;
            
              if(!$type_hours){
                  $hours[0] = '';
                  $hours[1] = '';
              }else{
                  $hours = explode('-', $type_hours);
              }
               
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

        //该店铺 该运动品类 的营业时间
        $store_hours = StoreType::where('store_id',$store_id)
                            ->where('type_id',$type_id)
                            ->where('item_id','1')
                            ->first();
          //运动品类营业的  开始时间
        if($store_hours){
            $hours = $store_hours->hours;
            $store_hours = explode('-', $hours);
            $start_time = (int)substr($store_hours[0],0,strrpos($store_hours[0],':')); 
        }else{
            $start_time = 0;
        }
            //读取所有价格
            $new_prices = Field::where('store_id',$store_id)->where('type_id',$type_id)->where('week',$week)->orderBy('place_id','asc')->get();

            $prices = $new_prices->groupBy('time')->sort();

            return view('sale.price_week',compact('store','type_id','start_time','types','week','now','prices'));

    }
    //  修改场地价格
    public function update_price(Request $request)
    {
        $prices = $request->arr;
        if($prices){
          $update_price = [];
          foreach ($prices as $key => $value) {
          $update_price[$value['id']] = $value['price'];
          }
        //按日期  改价格
        if($request->date){
          foreach ($update_price as $key => $value) {
            $fields = Field::find($key);
            $time = $fields->time;
            $date_fields = Field::where('place_id',$fields->place_id)->where('time',$time)->where('date',$request->date)->first();
            if($date_fields){
              $date_fields->update([
                  'price' => $value,
                ]);
            }else{
              Field::create([
                'place_id' => $fields->place_id,
                'time' => $time,
                'store_id' => $fields->store_id,
                'type_id' => $fields->type_id,
                'date' => $request->date,
                'price' => $value,
                ]);
            }

          }
        }else{
          //按星期 改价格
          foreach ($update_price as $key => $value) {
            $fields = Field::where('date',null)->find($key);
            $fields -> update([
              'price' => $value,
              ]);
          }
        }
        return response()->json([
                                'errcode'=> '1',
                                'errmsg'=> '修改成功',
                                ], 200)
                                ->setCallback($request->input('callback'));
      }else{
         return response()->json([
                            'errcode'=> '2',
                            'errmsg'=> '请修改数据',
                            ], 200)
                            ->setCallback($request->input('callback'));
      }
     
    }

     //价格配置页 按日期
    public function price_date(Request $request)
    {

        session_start();
        dump($_SESSION);
        $store_id = $_SESSION['store_id'];
        $store = Store::find($store_id);
  
        $type_id = $request->type_id;
        $item_id = $request->item_id ?? 1;
        $types = $store->types()->where('item_id',$item_id)->get();
        //现在的日期
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


         //该店铺 该运动品类 的营业时间
        $hours = StoreType::where('store_id',$store_id)
                            ->where('type_id',$type_id)
                            ->where('item_id','1')
                            ->first();
          //运动品类营业的  开始时间
        if($hours){
            $hours = $hours->hours;
            $store_hours = explode('-', $hours);
            $start_time = (int)substr($store_hours[0],0,strrpos($store_hours[0],':')); 
        }else{
            $start_time = 0;
        }

        //读取所有价格
          $new_prices = Field::where('store_id',$store_id)->where('type_id',$type_id)->where('date',$date)->orderBy('place_id','asc')->get();



        if($new_prices->isEmpty()){

            $new_prices = Field::where('store_id',$store_id)->where('type_id',$type_id)->where('week',$week)->orderBy('place_id','asc')->get();

        }else{
             $price_week = Field::where('store_id',$store_id)->where('type_id',$type_id)->where('week',$week)->orderBy('place_id','asc')->get();
             //将 星期价格 替换为 日期的价格
            foreach ($price_week as $key => $value) {
               foreach ($new_prices as $k => $v) {
                  if($value->place_id == $v->place_id && $value->time == $v->time){

                    $price_week[$key] = $v;
                  }
               }
            }
            $new_prices = $price_week;
        }
        $prices = $new_prices->groupBy('time')->sort();
        return view('sale.price_date',compact('store','type_id','start_time','types','now','prices','date'));
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
                $type_id = $store->types()->first();
                if($type_id){
                  $type_id = $type_id->id;
                }else{
                  $type_id = 0;
                }
              
            }else{
               $type_id = 0;
            }
        }
         //该店铺 该运动品类 的营业时间
        $hours = StoreType::where('store_id',$store_id)
                            ->where('type_id',$type_id)
                            ->where('item_id','1')
                            ->first();
          //运动品类营业的  开始时间
        if($hours){
            $hours = $hours->hours;
            $store_hours = explode('-', $hours);
            $start_time = (int)substr($store_hours[0],0,strrpos($store_hours[0],':')); 
        }else{
            $start_time = 0;
        }
       //读取所有价格
        $new_prices = Field::where('store_id',$store_id)->where('type_id',$type_id)->where('week',$week)->orderBy('place_id','asc')->get();

        $prices = $new_prices->groupBy('time')->sort();


        return view('sale.switch_week',compact('store','type_id','start_time','types','week','now','prices'));
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
             $places = $type->places()->where('store_id',$store_id)->orderBy('created_at','asc')->get();
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
        $fields = Field::find($id);
        $switch = $fields->switch;

            if($switch == ''){
                $new_switch = 1;
            }elseif($switch == 1){
                $new_switch = '';
            }else{
                $new_switch = 2;
            }
            $fields->switch = $new_switch;
            $fields->save();
            return $new_switch;

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
    public function destroy(Request $request,$id)
    {
        $place = Place::find($id);
        $place -> delete();
        return 1;
    }
}
