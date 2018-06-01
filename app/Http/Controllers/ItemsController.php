<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ItemType;
use App\Models\StoreType;
use App\Models\Store;
use App\Models\Type;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //店铺 每个运动品类的 营业时间
    public function index(Request $request)
    {
        if($request->start_time == '' || $request->end_time == ''){
            return back()->withInput()->with('warning','请填写完整的营业时间');
        }else{
            $store_type = StoreType::where('store_id',$request->store_id)
                                    ->where('type_id',$request->type_id)
                                    ->where('item_id',1)
                                    ->first();
            $hours = $request->start_time . '-' . $request->end_time;
            $store_type->hours = $hours;
            $store_type->save();
          
           return back()->withInput()->with('success','营业时间设置成功');
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   //添加销售项目
    public function create(Request $request)
    {
        $store_id = $request->store_id;
        return view('sale.create',compact('store_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->store_id = 1;
        // $request->type_id= 3;
        // $request->name= 333;
        // $request->rule= 13333;
        // $request->item_id= 1;
       //新增销售项目  
        ItemType::create([
            'store_id' => $request->store_id,
            'item_id' => $request->item_id,
            'type_id' => $request->type_id,
            'name' => $request->name,
            'rule' => $request->rule,
        ]);

        $types_id = Store::find($request->store_id)->types()->where('item_id',$request->item_id)->pluck('types.id')->toArray();
        if(!in_array($request->type_id, $types_id)){
            //新增商家的 运动品类
             StoreType::create([
                'store_id' => $request->store_id,
                'type_id' => $request->type_id,
                'item_id' => $request->item_id,
             ]);
             
       }
        
         return back()->with('success','添加成功');

       

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //票卡类 列表
    public function tickets_list(Request $request)
    {
        session_start();
        $store_id = $_SESSION['store_id'];
        $store = Store::find($store_id);


        $type_id = $request->type_id;
        $item_id = $request->item_id ?? 1;
        $types = $store->types()->where('item_id',$item_id)->orderBy('created_at','asc')->get();
        
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
        return view('sale.ticket',compact('store','type_id','places','types'));
    }
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
