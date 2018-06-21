<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Bill;
use App\Models\Store;
use App\Models\Status;
use App\Models\Orders;

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
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
