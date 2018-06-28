<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Complaint;

class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type)
    {
        session_start();
       if($type == 1){
        $complaints = Complaint::where('client_id',null)->paginate(1);
       }else{
        $complaints = Complaint::where('mp_user_id',null)->paginate(1);
       }
       return view('complaints.index',compact('complaints','type'));
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
       dump(3333);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$type,$id)
    {
        session_start();
        $complaint = Complaint::find($id);//反馈  投诉 信息
        $message = $complaint->messages()->orderBy('created_at','desc')->first(); // 回复的内容
         // return response()->json([
         //                    'complaint'=> $complaint,
         //                    'message'=> $message,
         //                    ], 200)
         //                    ->setCallback($request->input('callback'));
        return view('complaints.show',compact('complaint','type','message'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dump($id);
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
