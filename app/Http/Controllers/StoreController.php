<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Store;
use App\Models\Store_img;
use App\Models\Type;


class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        session_start();
        $type_id = $request->type_id;//运动品类
        $search_name = $request->search_name; //搜索的名称
        $store_type = $request->store_type; //店铺 锁定 或 正常
        $types_stores = [];//所有店铺的 运动品类

        if($store_type){
            if($search_name){
                $type = Type::where('name',$search_name)->first();
                if($type){
                    $stores = $type->stores()->distinct('store_id')->paginate(10);
                }else{
                     session()->flash('warning','没有该运动品类');
                    return redirect('/stores');
                }

            }else{
                $stores = Store::where('switch',$store_type)->orderBy('created_at','desc')->paginate(10);
            }
        }elseif($type_id){
            $type = Type::find($type_id);
            $stores = $type->stores()->paginate(10);
        }else{
            $stores = Store::orderBy('created_at','asc')->paginate(10);

        }
         foreach ($stores as $key => $store) {
                    $types = $store->types()->distinct('type_id')->get();
                    $types_stores[$key] = $types;
                }
        return view('store.index',compact('stores','types_stores'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        session_start();
       return view('store.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        if(!$request->title || !$request->address || !$request->map || !$request->phone || $request->introduction){
            return back()->withInput()->with('warning','请填写完整内容');

        }else{
            //添加店铺
             $store = Store::create([
            // 'neighbourhood_id' => $request->neighbourhood_id,
            'title' => $request->title,
            'address' => $request->address,
            'map_url' => $request->map,
            'phone' => $request->phone,
            'introduction' => $request->introduction,
            ]);
        }
        if($store){
            session()->flash('success','添加成功');
            return redirect(route("stores.index"));
        }else{
            session()->flash('warning','请填写完整内容');
            return redirect(route("stores.create"));
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
    public function edit(Store $store)
    {
        session_start();
        // session(['store_id'=>$store->id]);
        $time=1*51840000;
        setcookie(session_name(),session_id(),time()+$time,"/");
        $_SESSION['store_id']=$store->id;
        return view('store.edit',compact('store'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Store $store)
    {
        
        $time = now();
        $store_imgs = [];
        $imgs = ['1223','43423','34534'];

        if(!$request->title || !$request->address || !$request->map || !$request->phone || $request->introduce){
            return back()->withInput()->with('warning','请填写完整内容');

        }else{
             //修改店铺基本信息
        $store->update([
            // 'neighbourhood_id' => $request->neighbourhood_id,
            'title' => $request->title,
            'address' => $request->address,
            'map_url' => $request->map,
            'phone' => $request->phone,
            'logo' => $request->logo,
            'introduction' => $request->introduction,
            ]);

        //修改店内实拍图
        foreach ($imgs as $key => $img) {
           $store_imgs[$key]['store_id'] = $store->id;
           $store_imgs[$key]['img'] = $img;
           $store_imgs[$key]['created_at'] = $time;
        }
        $store_imgs = Store_img::insert($store_imgs);

        if($store_imgs){
           session()->flash('success','修改成功');
           return redirect(route('stores.index'));
        }else{
           session()->flash('warning','修改失败');
           return redirect(route('stores.edit',$store->id));
        }
        }

       

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store)
    {
       
    }
}
