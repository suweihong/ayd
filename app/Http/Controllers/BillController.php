<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Bill;
use App\Models\Store;
use App\Models\Status;
use App\Models\Order;

use Excel;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        session_start();
        $stores = Store::orderBy('created_at','asc')->get();//所有的店铺
        $bills = Bill::orderBy('created_at','desc')->get();

    
        return view('bills.index',compact('stores','bills','status_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //添加账单 
    public function create(Request $request)
    {
        $stores = Store::orderBy('created_at','asc')->get();//所有的店铺
        $start=date('Y-m-01 00:00:00',time());//获取指定月份的第一天
        $s = date('Y-m-01',time());
        $end=date('Y-m-t 23:59:59',time()); //获取指定月份的最后一天

        $today_start = date('Y-m-d 00:00:00',time());//今天的开始时间
        $today = date('Y-m-d H:i:s',time()); //今天的时间
        $today_end = date('Y-m-d 23:59:59',time());//今天的结束时间
        // dump($today_start);
        // dump($today);
        // dump($today_end);
        // dump($start);
        // dump($end);
        // dump($s);

        $orders = Order::where('status_id','1')->where('updated_at','>=',$start)->where('updated_at','<=',$today)->get();
        $orders = $orders->groupBy('store_id');
        if($orders->isEmpty()){
            $bills = [];
        }else{
                foreach ($orders as $key => $order) {
                $bills[$key]['total'] = $order->pluck('total')->sum();//订单金额  
                $bills[$key]['collection'] = $order->pluck('collection')->sum();//代收金额
                $bills[$key]['balance'] = $bills[$key]['total'] - $bills[$key]['collection'];//结算金额
               }
        }
        
    

        dump($orders);
        dump($bills);
       // if($today_start == $start){
       //      foreach ($stores as $key => $store) {
       //          $res = Bill::create([
       //              'store_id' => $store->id,
       //              'time' => $s.' 至 ',
       //          ]);
       //      }
       // }
       // if($res){
       //  dump(11);
       // }else{
       //  dump(22);
       // }

        //核销订单后 修改账单数据

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //添加账单
    public function store(Request $request)
    {
        
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

    public function export_bills(Request $request){
    	$time = date('Y-m-d H-i-s');
    	$bills_list = Bill::orderBy('created_at','desc')->get();
    	foreach ($bills_list as $key => $bill) {
    		$bills[$key]['id'] = $key;
    		$bills[$key]['store'] = $bill->store->title;
    		$bills[$key]['time'] = (string)$bill['created_at'];
    		$bills[$key]['order_price'] = 33;
    		$bills[$key]['d_price'] = 33;
    		$bills[$key]['j_price'] = 33;
    		$bills[$key]['status'] = $bill->check->name;
    		$bills[$key]['q_time'] = (string)$bill['updated_at'];

    	}
    	array_unshift($bills,['序号','场馆','账单时间','订单金额','代收金额','结算金额','确认状态','确认时间']);

    	$fw='A1:H'.count($bills);//居中的范围
		Excel::create(iconv('UTF-8', 'GBK', '帐单列表'.$time),function($excel) use ($bills,$fw){
                $f=$fw;
				$excel->sheet('score', function($sheet) use ($bills,$f){
	            $sheet->rows($bills);
                $sheet->setWidth([               // 设置多个列  
                'A' => 10,  
                'B' => 15,
                'C' => 20,
                'D'=> 12,
                'E'=> 20,
                'F' => 15,  
                'G' => 15,
                'H' => 20,
            ]);
                $sheet->cells($f,function($cells) { //$f是范围。匿名函数设置居中对齐
                   $cells->setAlignment('center');
                });
		    });
		})->export('xls');
    	

    }
}
