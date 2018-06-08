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
       //  $type = Type::find($type_id);

       // if($type == null){
       //      $places = [];
       //  }else{
       //       $places = $type->places()->where('store_id',$store_id)->orderBy('created_at','asc')->get();
       //  }

        //读取所有价格
        $new_prices = Field::where('store_id',$store_id)->where('type_id',$type_id)->where('week',$week)->orderBy('place_id','asc')->get();


        $prices = $new_prices->groupBy('time')->sort();

     
      
        return view('sale.price_week',compact('store','type_id','places','types','week','now','prices'));
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
        $type = Type::find($type_id);
       if($type == null){
            $places = [];
        }else{
             $places = $type->places()->where('store_id',$store_id)->orderBy('created_at','asc')->get();
        }


         //该店铺 该运动品类 的营业时间
        $hours = StoreType::where('store_id',$store_id)
                            ->where('type_id',$type_id)
                            ->where('item_id','1')
                            ->first()
                            ->hours;
     

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

           // if('1'){

            //      // 添加该日期的价格
            //     if(!$hours){

            //         return back()->with('warning','请先设置营业时间');
            //     }else{

            //             //营业时间
            //          $new_hours = explode('-',$hours);
            //          $new_start = (int)substr($new_hours[0],0,strrpos($new_hours[0],':')); 
            //          $new_end =  substr($new_hours[1],0,strrpos($new_hours[1],':'));
            //          $new_hours = [];
            //                 for ($i=$new_start; $i < $new_end; $i++) { 
            //                     array_push($new_hours,$i);//添加元素
            //                  }

            //             //添加价格
            //
            //
            //             先添加 该日期 价格被修改的数据
            //             再重组(transform) 价格数组（$new_price）
            //
            //
            //             $fields = [];
            //             foreach ($places as $key => $place) {
            //                 foreach ($new_hours as $ke => $new_hour) {
            //                        $fields[$key][$ke]['place_id'] = $place->id;
            //                        $fields[$key][$ke]['time'] = $new_hour;
            //                        $fields[$key][$ke]['date'] = $date;
            //                        $fields[$key][$ke]['store_id'] = $store_id;
            //                        $fields[$key][$ke]['type_id'] = $type_id;
            //                        $fields[$key][$ke]['price'] = $type_id;

            //                    }
            //              }
            //     }
            //      $new_fields = [];
            //      foreach ($fields as $key => $value) {
            //         foreach ($value as $k => $field) {
            //                $new_fields[] = $field;
            //         }
            //      }
                
                // $fields = Field::insert($new_fields);
            // }else{
            // if(1){
                    //获取fields_id 修改某个场地的价格
            // }

        
        
        $prices = $new_prices->groupBy('time')->sort();


        return view('sale.price_date',compact('store','type_id','places','types','now','prices'));
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
             $places = $type->places()->where('store_id',$store_id)->orderBy('created_at','asc')->get();
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
    public function destroy(Place $place)
    {
        $place -> delete();
        return back()->with('success','删除成功');
    }
}
