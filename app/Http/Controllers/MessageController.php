<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Complaint;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('message.index');
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
       
        if($request->reply_content == ''){

            session()->flash('warning','请填写完整内容');
            return redirect('/types/1/complaints/'.$request->id);
        }else{
            Message::create([
                'mp_user_id' => $request->mp_user_id,
                'user_id' => $request->user_id,
                'complaint_id' => $request->id,
                'title' => '回复商家反馈',
                'content' => $request->reply_content,             
                'read' => '0',
            ]);

            //修改反馈的处理状态
            $complaint = Complaint::find($request->id);
            $complaint-> update([
                'check_id' => '1',
            ]);

            session()->flash('success','回复成功');
            if($request->mp_user_id){
                 return redirect('/types/1/complaints');
            }else{
                 return redirect('/types/2/complaints');
            }
           
        }
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
