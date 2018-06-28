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
        $date_start = date('Y-m-d 00:00:00',strtotime($date));//查询日期 开始的时间
        $date_end = date('Y-m-d 23:59:59',strtotime($date));//查询日期结束的时间
        $store_id = $request->store_id;
        $balance_start = $request->balance_start;
        $balance_end = $request->balance_end;
        $stores = Store::orderBy('created_at','asc')->get();//所有的店铺

        if($request->search == 1){
            $search = 1;
            $bill_month = date('Y-m-01',strtotime($bill_date));//要查询的 账单时间是 哪个月
            if($store_id == 0){
                $bills = Bill::where('time_start',$bill_month)->where('updated_at','>=',$date_start)->where('updated_at','<=',$date_end)->where('balance','>=',$balance_start)->where('balance','<=',$balance_end)->where('check_id',7)->orderBy('balance','desc')->paginate(5);

            }else{
                $bills = Bill::where('time_start',$bill_month)->where('updated_at','>=',$date_start)->where('updated_at','<=',$date_end)->where('balance','>=',$balance_start)->where('balance','<=',$balance_end)->where('store_id',$store_id)->where('check_id',7)->orderBy('balance','desc')->paginate(5);
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
   
    $start=date('Y-m-01 00:00:00',time());//获取指定月份的第一天
    $month_start = date('Y-m-01',time()); //本月的一号
    $last_start = date('Y-m-01', strtotime('-1 month'));//上个月的第一天
    $last_end = date('Y-m-t', strtotime('-1 month'));//上个月的最后一天

    $now = date('Y-m-d H:i:s',time());//现在的时间


                //每月一号添加账单
       if($now == $start){
            $stores = Store::orderBy('created_at','asc')->get();//所有的店铺
            foreach ($stores as $key => $store) {
                $res = Bill::create([
                    'store_id' => $store->id,
                    'time_start' => $month_start,
                    'time_end' => '今天',
                    'total' => 0,
                    'collection' => 0,
                    'balance'=> 0,
                    'check_id' => 8,
                ]);
            }
            $bills = Bill::where('time_start',$last_start)->get();
            foreach ($bills as $key => $bill) {
               $bill->update([
                    'time_end' => $last_end,
               ]);
}

       }
       if($res){
        dump(11);
       }else{
        dump(22);
       }

                    //核销订单后 修改账单数据
       // if($request->exit = 1){
            // $store_id = $request->store_id;
            // $time_start = $month_start;
            // $bill = Bill::where('store_id',$store_id)->where('time_start',$time_start)->first();
            // $bill->update([
            //     'total' => $bill->total + 1,
            //     'collection' => $bill->collection + 1,
            //     'balance' => $bill->balance + 1,    
            // ]);
            // dump($bill);
       // }

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
            $date_start = date('Y-m-d 00:00:00',strtotime($date));//查询日期 开始的时间
            $date_end = date('Y-m-d 23:59:59',strtotime($date));//查询日期结束的时间
            $store_id = $request->store_id;
            $balance_start = $request->balance_start;
            $balance_end = $request->balance_end;
            $bill_month = date('Y-m-01',time($bill_date));//要查询的 账单时间是 哪个月
            if($store_id == 0){
                $bills_list = Bill::where('time_start',$bill_month)->where('updated_at','>=',$date_start)->where('updated_at','<=',$date_end)->where('balance','>=',$balance_start)->where('balance','<=',$balance_end)->where('check_id',7)->orderBy('balance','desc')->get();

            }else{
                $bills_list = Bill::where('time_start',$bill_month)->where('updated_at','>=',$date_start)->where('updated_at','<=',$date_end)->where('balance','>=',$balance_start)->where('balance','<=',$balance_end)->where('store_id',$store_id)->where('check_id',7)->orderBy('balance','desc')->get();
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
                        'C' => 25,
                        'D'=> 15,
                        'E'=> 15,
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
