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
        $now = date('Y-m-d',time());//默认的日期
        $bill_date = $request->bill_date;
        $date = $request->date;
        $store_id = $request->store_id;
        $balance_start = $request->balance_start;
        $balance_end = $request->balance_end;
        
        $stores = Store::orderBy('created_at','asc')->get();//所有的店铺
      
        if($request->search == 1){
            $search = 1;
            $bill_month = date('Y-m-01',time($bill_date));//要查询的 账单时间是 哪个月
            if($store_id == 0){
                $bills = Bill::where('time_start',$bill_month)->where('date',$date)->where('balance','>=',$balance_start)->where('balance','<=',$balance_end)->orderBy('balance','desc')->paginate(5);

            }else{
                $bills = Bill::where('time_start',$bill_month)->where('date',$date)->where('balance','>=',$balance_start)->where('balance','<=',$balance_end)->where('store_id',$store_id)->orderBy('balance','desc')->paginate(5);
            }
            
        }else{
            $search = 2;
            $bills = Bill::orderBy('balance','desc')->paginate(5);//所有账单
        }
       
    
        return view('bills.index',compact('stores','bills','status_list','now','bill_date','date','store_id','balance_start','balance_end','search'));
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
        $month_start = date('Y-m-01',time()); //本月的一号
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
       //              'time_start' => $month_start.' 至 今天',
       //              'total' => 0,
       //              'collection' => 0,
       //              'balance'=> 0,
       //              'check_id' => 8,
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

    //导出账单
    public function export_bills(Request $request){

    	$time = date('Y-m-d H-i-s');
        if($request->search == 1){
            $bill_date = $request->bill_date;
            $date = $request->date;
            $store_id = $request->store_id;
            $balance_start = $request->balance_start;
            $balance_end = $request->balance_end;
            $bill_month = date('Y-m-01',time($bill_date));//要查询的 账单时间是 哪个月
            if($store_id == 0){
                $bills_list = Bill::where('time_start',$bill_month)->where('date',$date)->where('balance','>=',$balance_start)->where('balance','<=',$balance_end)->orderBy('balance','desc')->get();

            }else{
                $bills_list = Bill::where('time_start',$bill_month)->where('date',$date)->where('balance','>=',$balance_start)->where('balance','<=',$balance_end)->where('store_id',$store_id)->orderBy('balance','desc')->get();
            }
        }else{
            $bills_list = Bill::orderBy('balance','desc')->get();

        }
        if($bills_list->isEmpty()){
            return back()->with('warning','搜索到的结果为空！');
        }else{
            foreach ($bills_list as $key => $bill) {
                $bills[$key]['id'] = $key+1;
                $bills[$key]['store'] = $bill->store->title;
                $bills[$key]['time'] = $bill->time_start .'至'. $bill->time_end;
                $bills[$key]['order_price'] = $bill->total;
                $bills[$key]['d_price'] = $bill->collection;
                $bills[$key]['j_price'] = $bill->balance;
                $bills[$key]['status'] = $bill->check->name;
                if($bill->check_id == 8){
                    $bills[$key]['q_time'] = '';
                }else{
                    $bills[$key]['q_time'] = (string)$bill['updated_at'];
                }

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
}
