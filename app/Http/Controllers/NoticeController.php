<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Message;

class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        session_start();
        $notices = Message::where('mp_user_id','0')->paginate(10);
        return view('notice.index',compact('notices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        session_start();
        return view('notice.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       if( $request->title == '' || $request->content == '<p><br></p>' ){
       
            session()->flash('warning','请填写完整内容');
            return redirect("/notices/create");
       }else{
            $notice = message::create([
            'mp_user_id' => '0',
            'title' => $request->title,
            'content' => $request->content,
        ]);
            session()->flash('success','添加成功');
            return redirect("/notices");

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
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $notice)
    {
        session_start();
        return view('notice.edit',compact('notice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $notice)
    {

        if( $request->title == '' || $request->content == '<p><br></p>' ){
                
            session()->flash('warning','请填写完整内容');
            return redirect("/notices/".$notice->id."/edit");
       }else{
            $notice = $notice->update([
        
            'title' => $request->title,
            'content' => $request->content,
        ]);
            session()->flash('success','修改成功');
            return redirect("/notices");

       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $notice)
    {
        session_start();
        $notice -> delete();
        session()->flash('success','删除成功');
        return 1;
    }
}
