<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Store;
use App\Models\Store_img;


class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores = Store::orderBy('created_at','asc')->paginate(10);
        return view('store.index',compact('stores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        //添加店铺
        $store = Store::create([
            'neighbourhood_id' => $request->neighbourhood_id,
            'title' => $request->title,
            'address' => $request->address,
            'map_url' => $request->map_url,
            'phone' => $request->phone,
            'name' => $request->name,
            'introduction' => $request->introduction,
            ]);

        if($store){
            return 1;
        }else{
            return 2;
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
        return view('store.edit');
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
        $imgs = $request->imgs;

        //修改店铺基本信息
        $store->update([
            'neighbourhood_id' => $request->neighbourhood_id,
            'title' => $request->title,
            'address' => $request->address,
            'map_url' => $request->map_url,
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
            return 1;
        }else{
            return 2;
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
        $store -> delete();
        return 1;
    }
}
