<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Excel;

use App\Models\Order;
use App\Models\Type;
use App\Models\Status;
use App\Models\OrderStatus;
use App\Models\Payment;
use App\Models\Store;
use App\Models\User;
use App\Models\Bill;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // session_start();
        $types = Type::all();
        $status_list = Status::all();
        $payment = Payment::all();
        $search = $request->search; //是否未条件查找
        $order_id = $request->order_id;
        $date = $request->date;
        $status = $request->status;
        $type_id = $request->type_id;
        $pay_id = $request->pay_id;

        //默认 时间区间
    	$today = strtotime(date('Y-m-d'));
        $t_start = date('Y-m-d',$today);
        $t_end = date('Y-m-d',$today+60*60*24);
        $now = $t_start.' - '.$t_end;
        
        	//今日的 0点 到明天的0点
        $today_start = date('Y-m-d H:i:s',$today);
        $today_end = date('Y-m-d H:i:s',$today+60*60*24);
        $state = $request->state;

    	if($search == 1){
        	$search = 1;
        	if(!$order_id){

        		return back()->withInput()->with('warning','请填写订单号');

        	}else if(!$date){
        		
        		return back()->withInput()->with('warning','请填写时间区间');

        	}else{
        		//查询的日期区间
        		$date = explode(' - ',$date);
        		if($type_id == 0 && $pay_id == 0){
        			$orders = Order::where('id',$order_id)->where('status_id',$status)->whereBetween('updated_at',[$date[0],$date[1]])->get();
        		}elseif($type_id != 0 && $pay_id == 0){

        			$orders = Order::where('id',$order_id)->where('status_id',$status)->where('type_id',$type_id)->whereBetween('updated_at',[$date[0],$date[1]])->get();

        		}elseif ($type_id == 0 && $pay_id != 0) {
        			$orders = Order::where('id',$order_id)->where('status_id',$status)->where('pay_id',$pay_id)->whereBetween('updated_at',[$date[0],$date[1]])->get();
        		}elseif($type_id != 0 && $pay_id != 0){
        			
        			$orders = Order::where('id',$order_id)->where('status_id',$status)->where('pay_id',$pay_id)->where('type_id',$type_id)->whereBetween('updated_at',[$date[0],$date[1]])->get();
        		}
        		$date = implode(' - ', $date);

        		//查询的订单存入session
        		$time=1*51840000;
		        setcookie(session_name(),session_id(),time()+$time,"/");
		        $_SESSION['search_orders']=$orders;
        	}
    	}elseif($state == 100){
    		//今日下单数
    		$orders = Order::where('created_at','>=',$today_start)->where('created_at','<',$today_end)->where('status_id','!=',0)->orderBy('created_at','desc')->paginate(5);
    	}elseif($state == 1){
    		//今日核销数
    		$orders = Order::where('updated_at','>=',$today_start)->where('updated_at','<',$today_end)->orderBy('updated_at','desc')->where('status_id',1)->paginate(5);
    	}elseif($state == 2){
    		//今日退单数
    		$orders = Order::where('updated_at','>=',$today_start)->where('updated_at','<',$today_end)->orderBy('updated_at','desc')->where('status_id',2)->paginate(5);
    	}else{  
        	$search = 2;
        	$state = 1000;
        	$orders = Order::orderBy('created_at','desc')->where('status_id','!=',0)->paginate(5);
     
		}
    	return view('orders.index',compact('orders','types','status_list','now','payment','search','state','status','type_id','pay_id','order_id','date'));
   
    }




    //某店铺 的订单
    public function store_orders(Request $request)
    {
    	// session_start();
    	$status_list = Status::all();//所有状态
    	$store_id = $request->store_id;//按店铺查找
    	$store = Store::find($store_id);
    	$types = $store->types()->get();

    	$order_id = $request->order_id;
    	$date = $request->date;
    	$status = $request->status;
    	$type_id = $request->type_id;

    	//默认 时间区间
    	$today = strtotime(date('Y-m-d'));
        $today_start = date('Y-m-d',$today);
        $today_end = date('Y-m-d',$today+60*60*24);
        $now = $today_start.' - '.$today_end;

    	if($types->isEmpty()){
    		$store_types = [];
    	}else{
    		 foreach ($types as $key => $type) {
	    	 $store_types[$type->id] = $type;
	        }
    	}
	   
    	if($request->search == 1){
    		//搜索
    		$search = 1;
    		if($order_id == '' || $date == ''){
    			return back()->withInput()->with('warning','请填写完整的搜索信息');
    		}else{

    			//查询的日期区间
        		$date = explode(' - ',$date);
        		if($type_id == 0){
        			$orders = Order::where('id',$order_id)->where('store_id',$store_id)->where('status_id',$status)->whereBetween('updated_at',[$date[0],$date[1]])->get();
        		}else{
        			$orders = Order::where('id',$order_id)->where('store_id',$store_id)->where('status_id',$status)->where('type_id',$type_id)->whereBetween('updated_at',[$date[0],$date[1]])->get();
        		}
        		$date = implode(' - ', $date);

        		//查询的订单存入session
        		$time=1*51840000;
		        setcookie(session_name(),session_id(),time()+$time,"/");
		        $_SESSION['search_orders']=$orders;
    		
    		}
    	}else{
    			$search = 2;
    			$orders = Order::where('store_id',$store_id)->where('status_id','!=',0)->orderBy('created_at','desc')->paginate(5);
    		}	
    	
        return view('orders.store',compact('orders','store','store_types','status_list','now','store_id','search','status','type_id','order_id'));
    }



    //按  用户 查找订单
    public function user_orders(Request $request)
    {
    	// session_start();
    	$users = User::all();
    	$status_list = Status::all();
    	$user_id = $request->user_id ?? $users[0]->id;
    	$user = User::find($user_id);
    	$types = Type::all();

    	//默认 时间区间
    	$today = strtotime(date('Y-m-d'));
        $today_start = date('Y-m-d',$today);
        $today_end = date('Y-m-d',$today+60*60*24);
        $now = $today_start.' - '.$today_end;

    	$search = $request->search;//是否为搜索
    	$date = $request->date; //时间区间
    	$status_id = $request->status_id;
    	$type_id = $request->type_id; //查询的体育品种

    	if($search == 4){
    		//查询的日期区间
        	$date = explode(' - ',$date);
        	$search = 4;
    		if($date == ''){
    			return back()->withInput()->with('warning','请填写完整的搜索信息');
    		}elseif($type_id == 0){
    			$orders = Order::where('user_id',$user_id)->where('status_id',$status_id)->whereBetween('updated_at',[$date[0],$date[1]])->paginate(1);
    		}else{
    		
    			$orders = Order::where('user_id',$user_id)->where('status_id',$status_id)->where('type_id',$type_id)->whereBetween('updated_at',[$date[0],$date[1]])->paginate(1);
    		}
    		$date = implode(' - ',$date);
    	}else{
    	
    		$search = 5;
    		$orders = Order::where('user_id',$user_id)->where('status_id','!=',0)->paginate(1);
    		
    	}
    	return view('orders.user',compact('users','types','user','orders','status_list','now','date','status_id','type_id','search','user_id'));
       
       
    }

    //按 商家  查 
    public function shop_orders(Request $request)
    {
    	// session_start();
    	$stores = Store::all();
    	$status_list = Status::all();
    	$search = $request->search;//是否 为 查询
    	$store_id =  $request->store_id ?? $stores[0]->id; //店铺id
    	$date = $request->date; //时间区间
    	$status_id = $request->status_id;
    	$type_id = $request->type_id; //查询的体育品种
    	$store = Store::find($store_id);
    	$types = Type::all();


    	//默认 时间区间
    	$today = strtotime(date('Y-m-d'));
        $today_start = date('Y-m-d',$today);
        $today_end = date('Y-m-d',$today+60*60*24);
        $now = $today_start.' - '.$today_end;
        

    	
    	if($search == 2){
    		//查询的日期区间
        	$date = explode(' - ',$date);
        	$search = 2;
    		if($date == ''){
    			return back()->withInput()->with('warning','请填写完整的搜索信息');
    		}elseif($type_id == 0){
    			$orders = Order::where('store_id',$store_id)->where('status_id',$status_id)->whereBetween('updated_at',[$date[0],$date[1]])->paginate(10);
    		}else{
    			$orders = Order::where('store_id',$store_id)->where('status_id',$status_id)->where('type_id',$type_id)->whereBetween('updated_at',[$date[0],$date[1]])->paginate(10);
    		}
    		$date = implode(' - ',$date);
    	}else{
    		$search = 3;
    		$orders = Order::where('store_id',$store_id)->where('status_id','!=',0)->orderBy('created_at','desc')->paginate(10);
    	}
    	
    	return view('orders.shop',compact('stores','types','orders','store','status_list','now','search','date','status_id','type_id','store_id'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // session_start();
        return view('orders.store');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //订单详情
    public function show($id)
    {
        // session_start();
        $orders = Order::find($id);
        $fields = $orders->fields()->get();
        foreach ($fields as $key => $field) {
           $time = $field->pivot->time;
           $place_num = $field->pivot->place_num;
           $field['time'] = $time;
           $field['place_num'] = $place_num;
        }
        return view('orders.show',compact('orders','fields'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) 
    {
        // session_start();
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //协助核销订单
    public function update(Request $request, Order $order)
    {
        $month_start = date('Y-m-01',time()); //本月的一号
        $store_id = $order->store_id;

        if($order->status_id == 1){
            return response()->json([
                'errcode' => '2',
                'errmsg' => '该订单已经被核销,不能再进行此操作'
            ],200);
        }else{
             if($order->status_id != 4){
                //订单状态不是 已完成
                 return response()->json([
                    'errcode' => '2',
                    'errmsg' => '该订单还未完成，不能进行此操作'
                 ],200);
            }else{

                  //核销订单
                    
                //开启事务
                DB::beginTransaction();
                    //创建订单的最新状态
                $order_status = OrderStatus::create([
                    'order_id' => $order->id,
                    'status_id' => 1,
                    'store_id' => $order->store_id,
                ]);

                if(!$order_status){
                        DB::rollBack();
                        return response()->json([
                            'errcode' => 2,
                            'errmsg' => '核销订单失败',
                        ],200);
                    }

                    //修改订单的状态
                $order_update = $order->update([
                    'status_id' => '1',
                ]); 

                if(!$order_update){
                        DB::rollBack();
                        return response()->json([
                            'errcode' => 2,
                            'errmsg' => '核销订单失败',
                        ],200);
                    }
                    //修改账单
               
                $bill = Bill::where('store_id',$store_id)->where('time_start',$month_start)->first();
                $new_bill = $bill->update([
                    'total' => $bill->total + $order->total,
                    'collection' => $bill->collection + $order->collection,
                    'balance' => $bill->balance + $order->balance,    
                ]);
                if(!$new_bill){
                        DB::rollBack();
                        return response()->json([
                           'errcode' => 2,
                           'errmsg' => '核销订单失败', 
                        ],200);
                    }

               $fields = $order->fields()->get();//该订单包含的商品
                        //修改商品的状态为 正常
                    foreach ($fields as $key => $field) {
                        $res = $field->update([
                            'switch' => '',
                        ]);
                        if(!$res){
                            DB::rollBack();
                            return response()->json([
                                'errcode' => 2,
                                'errmsg' => '核销订单失败', 
                            ],200);
                        }
                    }

                    //提交事务
                    DB::commit(); 

            }            
        }
        return response()->json([
                'errcode' => '1',
                'errmsg' => '订单核销成功'
             ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dump($id);
    }

    //导出数据
    public function export(Request $request)
    {

    	$time = date('Y-m-d H-i-s');
    		//今日的 0点 到明天的0点
        $today = strtotime(date('Y-m-d'));
        $today_start = date('Y-m-d H:i:s',$today);
        $today_end = date('Y-m-d H:i:s',$today+60*60*24);
        $state = $request->state;

    	if($request->search == 1){
    		//搜索
    		// session_start();
	        $orders_list = $_SESSION['search_orders'];
    	}elseif($request->search == 2){
    		//按 商家  用户 查找
    		$date = explode(' - ',$request->date);
    		if($request->type_id == 0){

    			$orders_list = Order::where('store_id',$request->store_id)->where('status_id',$request->status_id)->whereBetween('updated_at',[$date[0],$date[1]])->get();
    		}else{
    			$orders_list = Order::where('store_id',$request->store_id)->where('status_id',$request->status_id)->where('type_id',$request->type_id)->whereBetween('updated_at',[$date[0],$date[1]])->get();
    		}
    	}elseif($request->search == 4){
    		// 按用户 搜索
    		$date = explode(' - ',$request->date); 
    		if($request->type_id == 0){
    			$orders_list = Order::where('user_id',$request->user_id)->where('status_id',$request->status_id)->whereBetween('updated_at',[$date[0],$date[1]])->get();
    		}else{
    		
    			$orders_list = Order::where('user_id',$request->user_id)->where('status_id',$request->status_id)->where('type_id',$request->type_id)->whereBetween('updated_at',[$date[0],$date[1]])->get();
    		}
    	}elseif($request->user_id){
    		//按 用户 查找订单
    		$orders_list = Order::where('user_id',$request->user_id)->where('status_id','!=',0)->orderBy('created_at','desc')->get();
    	}elseif($request->store_id){
    		//某家 店铺 的订单
    		$orders_list = Order::where('store_id',$request->store_id)->where('status_id','!=',0)->orderBy('created_at','desc')->get();
    	}elseif($state == 100){
    		//今日下单数
    		$orders_list = Order::where('created_at','>=',$today_start)->where('status_id','!=',0)->where('created_at','<',$today_end)->get();
    	}elseif($state == 1){
    		//今日核销数
    		$orders_list = Order::where('updated_at','>=',$today_start)->where('updated_at','<',$today_end)->orderBy('updated_at','desc')->where('status_id',1)->get();
    	}elseif($state == 2){
    		//今日退单数
    		$orders_list = Order::where('updated_at','>=',$today_start)->where('updated_at','<',$today_end)->orderBy('updated_at','desc')->where('status_id',2)->get();
    	}else{
    		//所有订单
    		$orders_list = Order::where('status_id','!=',0)->orderBy('created_at','desc')->get();
    	}

    	if($orders_list->isEmpty()){
    		return back()->with('warning','搜索到的结果为空！');
    	}else{
    		foreach ($orders_list as $key => $order) {
		       $orders[$key]['id'] = $order['id'];
		       $orders[$key]['price'] = $order['total'];
		       $orders[$key]['store'] = $order->store->title.'【'.$order->type->name.'】';
		       $orders[$key]['user'] = $order->user->nick_name ;
		       $orders[$key]['time'] = (string)$order->created_at;
		       $orders[$key]['status'] = $order->new_status()->name;
	   		 }

        	array_unshift($orders, ['订单号','价格','场馆','购买信息','下单时间','状态']);

			$fw='A1:F'.count($orders);//居中的范围
			Excel::create(iconv('UTF-8', 'GBK', '订单列表'.$time),function($excel) use ($orders,$fw){
	                $f=$fw;
					$excel->sheet('score', function($sheet) use ($orders,$f){
		            $sheet->rows($orders);
	                $sheet->setWidth([               // 设置多个列  
	                'A' => 12,  
	                'B' => 10,
	                'C' => 25,
	                'D'=> 12,
	                'E'=> 20,
	                'F' => 15,  
	            ]);
	                $sheet->cells($f,function($cells) { //$f是范围。匿名函数设置居中对齐
	                   $cells->setAlignment('center');
	                });
			    });
			})->export('xls');
    	}
		   	                   
    }
}
