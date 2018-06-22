<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Excel;

use App\Models\Order;
use App\Models\Type;
use App\Models\Status;
use App\Models\OrderStatus;
use App\Models\Payment;
use App\Models\Store;
use App\Models\Client;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        session_start();
        $types = Type::all();
        $status_list = Status::all();
        $payment = Payment::all();
        $search = $request->search; //是否未条件查找
        $order_id = $request->order_id;
        $date = $request->date;
        $status = $request->status;
        $type_id = $request->type_id;
        $pay_id = $request->pay_id;
      
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
        		// $date = implode(' - ', $date);

        		//查询的订单存入session
        		$time=1*51840000;
		        setcookie(session_name(),session_id(),time()+$time,"/");
		        $_SESSION['search_orders']=$orders;
        	}
    	}else{  
        	$search = 2;
        	$orders = Order::orderBy('created_at','desc')->paginate(5);
     
		}
    	return view('orders.index',compact('orders','types','status_list','payment','search'));
   
    }
    //某店铺 的订单
    public function store_orders(Request $request)
    {
    	session_start();
    	$status_list = Status::all();//所有状态
    	$store_id = $request->store_id;//按店铺查找
    	$store = Store::find($store_id);
    	$types = $store->types()->get();
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
    		$order_id = $request->order_id;
    		$date = $request->date;
    		$status = $request->status;
    		$type_id = $request->type_id;
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
    			$orders = Order::where('store_id',$store_id)->orderBy('created_at','desc')->paginate(5);
    		}	
        return view('orders.store',compact('orders','store','store_types','status_list','store_id','search'));
    }
    //按     用户   商家   查找订单
    public function client_orders(Request $request)
    {
    	session_start();
    	$store = $request->store; 
    	if($store == 1){
    		//按商家
    		$stores = Store::all();
    		return view('orders.client',compact('stores','store'));
    	}else{
    		//按用户
    		$clients = Client::all();
    		return view('orders.client',compact('clients','store'));
    	}
       
       
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        session_start();
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
        session_start();
        $orders = Order::find($id);
        $fields = $orders->fields()->get();
        dump($fields);
        return view('orders.show',compact('orders'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         session_start();
        return view('orders.client');
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
        dump(3333);
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

    	if($request->search == 1){
    		//搜索
    		session_start();
	        $orders_list = $_SESSION['search_orders'];
    	}elseif($request->store_id){
    		//按店铺查找
    		$orders_list = Order::where('store_id',$request->store_id)->orderBy('created_at','desc')->get();
    	}else{
    		//所有订单
    		$orders_list = Order::orderBy('created_at','desc')->get();
    	}
		foreach ($orders_list as $key => $order) {
	       $orders[$key]['id'] = $order['id'];
	       $orders[$key]['price'] = $order['total'];
	       $orders[$key]['store'] = $order->store->title.'【'.$order->type->name.'】';
	       $orders[$key]['client'] = $order->client->nick_name ;
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
                'C' => 20,
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
