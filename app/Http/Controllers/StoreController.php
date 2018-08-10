<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Store;
use App\Models\Store_img;
use App\Models\Type;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;


class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // session_start();
            //手动分页
        $perPage = 10;//每页多少条数据
        if ($request->has('page')) {
            $current_page = $request->input('page');
            $current_page = $current_page <= 0 ? 1 :$current_page;
          }else {
            $current_page = 1;
          }
        $offset = ( $current_page - 1 ) * $perPage;//偏移量


        $type_id = $request->type_id;//运动品类
        $search_name = $request->search_name; //搜索的名称
        $store_type = $request->store_type; //店铺 锁定 或 正常
        $types_stores = [];//所有店铺的 运动品类

        if($type_id){
                //与该运动品类关联的店铺
            $type = Type::find($type_id);
            $stores = $type->stores()->orderBy('created_at','asc')->get()->unique();
        }elseif($search_name == '' && $store_type != ''){
            return back()->with('warning','请填写完整的搜索内容');
        }elseif($search_name != '' && $store_type != ''){

                $type = Type::where('name',$search_name)->first();//获取该名称的 运动品类
                if($type){
            
                    $stores = $type->stores()->where('switch',$store_type)->get()->unique();
                   

                }else{
                     session()->flash('warning','没有该运动品类');
                    return redirect('/stores');
                }
        }else{

            $stores = Store::orderBy('created_at','asc')->get();
        }

                //分割集合
        $item = $stores->slice($offset, $perPage);
        $total = $stores->count();//统计
        //分页类
        $stores  = new LengthAwarePaginator($item, $total, $perPage,$current_page, [
             'path' => Paginator::resolveCurrentPath(),
             'pageName' => 'page',
        ]);

            //每家店的运动品类
         foreach ($stores as $key => $store) {
                    $types = $store->types()->get();
                    foreach ($types as $k => $value) {
          			   $types_stores[$store->id][$value['id']] = $value;
                    }
            }

            
        return view('store.index',compact('stores','types_stores','search_name','store_type'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // session_start();
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

        if(!$request->title || !$request->address || !$request->map || !$request->phone || !$request->introduction){
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
            'switch' => 1,
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
    //修改店铺的 状态
    public function show(Request $request,$id)
    {
        $store_id = $request->store_id;
        $store = Store::find($store_id);
        if($store->switch == 1){
            $store->update([
                'switch' => 2,
            ]);
            return 2;
        }else{
             $store->update([
                'switch' => 1,
            ]);
            return 1;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Store $store)
    {
        // session_start();
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

        if(!$request->title || !$request->address || !$request->map || !$request->phone || !$request->introduction){
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
            $imgss = $store->imgs;
            if(!$imgss->isEmpty()){
                foreach($imgss as $img){
                    $img->delete();
                }
            }
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
