<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\Estimate;

class EstimatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        session_start();
        if($request->check_id == 3){
            //所有商家的评价
            $estimates = Estimate::where('check_id',3)->orderBy('created_at','desc')->paginate(10);
            return view('estimates.list',compact('estimates'));

        }else{
            //指定商家的 评价
            $store_id = $_SESSION['store_id'];
            $store = Store::find($store_id);
            $estimate_list = $store->estimates();
            $estimates = $estimate_list->orderBy('created_at','desc')->paginate(2);

           $environments = $estimate_list->pluck('environment')->toArray();
           $environment = array_sum($environments) / (count($environments)==0 ? 1 : count($environments));
          
           $services = $estimate_list->pluck('service')->toArray();
           $service = array_sum($services) / (count($services)==0 ? 1 : count($services) );

           $averages = $estimate_list->pluck('average')->toArray();
           $average = array_sum($averages) / (count($averages)==0 ? 1 : count($averages));
           
            return view('estimates.index',compact('store','estimates','environment','service','average'));
        }

       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
}
