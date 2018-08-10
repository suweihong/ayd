<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StoreType;
use App\Models\Store;
use App\Models\Type;
use App\Models\Field;

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
        // session_start();
        $store_id = $_SESSION['store_id'];
        $store = Store::find($store_id);
        if($request->start_time == '' || $request->end_time == ''){
            return back()->withInput()->with('warning','请填写完整的营业时间');
        }else{

            $store_type = StoreType::where('store_id',$store_id)
                                    ->where('type_id',$request->type_id)
                                    ->where('item_id',1)
                                    ->first();
            if($store_type){
                $hours = $request->start_time . '-' . $request->end_time;
                $store_type->hours = $hours;
                $store_type->save();
                $places = $store->places()->where('type_id',$request->type_id)->orderBy('id','asc')->get();
               if($places->isEmpty()){
                    return back()->withInput()->with('success','营业时间设置成功，您可添加场地');
               }else{

                    $new_start = (int)substr($request->start_time,0,strrpos($request->start_time,':')); 
                    $new_end =  substr($request->end_time,0,strrpos($request->start_time,':'));
                    $new_hours = [];
                    for ($i=$new_start; $i < $new_end; $i++) { 
                        array_push($new_hours,$i);//添加元素
                     }
                     //改商家 改运动品类的 所有价格
                     $fields = Field::where('store_id',$store_id)->where('type_id',$request->type_id)->where('date',null)->get();
                     if(!$fields->isEmpty()){
                        foreach ($fields as $key => $field) {
                            $field -> delete();
                        }
                     }

                     //添加每个场地的价格
                     $fields = [];
                     $weeks = [1,2,3,4,5,6,7];
                     foreach ($places as $key => $place) {
                        foreach ($new_hours as $ke => $new_hour) {
                           foreach ($weeks as $k => $week) {
                               $fields[$key][$ke][$k]['place_id'] = $place->id;
                               $fields[$key][$ke][$k]['time'] = $new_hour;
                               $fields[$key][$ke][$k]['week'] = $week;
                               $fields[$key][$ke][$k]['store_id'] = $store_id;
                               $fields[$key][$ke][$k]['type_id'] = $request->type_id;
                                $fields[$key][$ke][$k]['price'] = 9999;
                                $fields[$key][$ke][$k]['item_id'] = 1;

                           }
                        }
                     }

                     $new_fields = [];
                     foreach ($fields as $key => $value) {
                        foreach ($value as $k => $field) {
                            foreach ($field as $ke => $v) {
                               $new_fields[] = $v;
                            }

                        }
                     }
                     
                     $fields = Field::insert($new_fields);
                
                    return back()->withInput()->with('success','销售数据更新成功');
               }

            }else{
                 return back()->withInput()->with('warning','请先设置运动品类');
            }

        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   //添加销售项目的页面
    public function create(Request $request)
    {
        // session_start();
        $store_id = $request->store_id;
        $types = Type::all();
        return view('sale.create',compact('store_id','types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //添加销售项目的操作
    public function store(Request $request)
    {
        $types_id = Store::find($request->store_id)->types()->where('item_id',$request->item_id)->pluck('types.id')->toArray();
        if(!in_array($request->type_id, $types_id)){
            //新增商家的 运动品类
             StoreType::create([
                'store_id' => $request->store_id,
                'type_id' => $request->type_id,
                'item_id' => $request->item_id,
             ]);
        }
       //新增销售项目
        if($request->item_id == 2){
            if(!$request->item_id || !$request->type_id || !$request->name || !$request->price || !$request->intro){
            return back()->withInput()->with('warning','请填写完整内容');

            }else{
                $res = Field::create([
                'store_id' => $request->store_id,
                'item_id' => $request->item_id,
                'type_id' => $request->type_id,
                'name' => $request->name ,
                'price' => $request->price,
                'intro' => $request->intro,
                'rule' => $request->rule,
                'item_id' => 2,
             ]);
            }
            
        }

         return back()->withInput()->with('success','销售项目添加成功');

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
        // session_start();
        $store_id = $request->store_id;
        $store = Store::find($store_id);


        $type_id = $request->type_id;
        $types = $store->types()->where('item_id',2)->orderBy('created_at','asc')->get();
        if(!$type_id){
            if(!$store->types()->get()->isEmpty()){
                $type_id = $store->types()->where('item_id',2)->orderBy('created_at','asc')->first();
                if($type_id){
                    $type_id = $type_id->id;
                }else{
                    $type_id = 0;
                }
            }else{
               $type_id = 0;
            }
        }
        //读取所有票卡
        $tickets = Field::where('store_id',$store_id)->where('type_id',$type_id)->where('item_id',2)->orderBy('created_at','asc')->get();
        return view('sale.ticket',compact('store','type_id','types','tickets'));
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
    //改变票卡的 销售状态
    public function update(Request $request, $id)
    {
        $ticket = Field::find($id);
        if($ticket->switch == ''){
            $ticket->update([
                'switch' => '1',//停止销售
                ]);
             return 1;
        }else{
            $ticket->update([
                'switch' => '',//正常销售
                ]);
            return 2;
        }
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //删除票卡
    public function destroy($id)
    {
      
        $ticket = Field::find($id);
        $ticket -> delete();
        return 1;
      
    }
}
