<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Advertisement;

class AdvertisementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $type = $request->type;
      
        $ads_main = Advertisement::where('type',1)->orderBy('created_at','desc')->get();
        if($type == 2){
            $ads = Advertisement::where('type',2)->orderBy('created_at','desc')->get();
        }else{
            $ads = Advertisement::where('type',3)->orderBy('created_at','desc')->get();

        }
        return view('advertisements',compact('ads_main','ads'));
        
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

        $type = $request->type;
        $imgs = $request->imgs;
        $imgs = [
            0 => [
                'img' => '/img/adlist3.jpg',
                'url' => 'http://wwww.baidu.com',
            ],
            1 => [
                'img' => '/img/adlist4.jpg',
                'url' => 'http://wwww.baidu.com',
            ],
            2 => [
                'img' => '/img/adlist1.jpg',
                'url' => 'http://wwww.baidu.com',
            ],
            3 => [
                'img' => '/img/adlist2.jpg',
                'url' => '',
            ],
        ];
        $id = $request->id;//主广告位的图片id
        $img = $request->img;//主广告位  单栏 的图片地址
        $img = [
                'img' => '/img/adlist3.jpg',
                'url' => 'http://wwww.baidu.com',
            ];
        $url = $request->url;//主广告位的图片链接url

            if($type == 1){
                if($url == ''){
                    return response()->json([
                        'errcode' => '2',
                        'errmsg' => '目标地址不能为空',
                    ],200);
                }else{
                    if(!$id){
                        $advertisement = Advertisement::create([
                            'type' => $type,
                            'img' => $img,
                            'url' => $url,
                         ]);
                    }else{
                        $advertisement = Advertisement::find($id);
                        $advertisement->update([
                            'type' => $type,
                            'img' => $img,
                            'url' => $url,

                        ]);
                    }
                    return response()->json([
                        'errcode' => '1',
                        'errmsg' => '提交成功',
                    ],200);
                }
               
            }else {
               
                foreach ($imgs as $key => $value) {
                   if($value['url'] == ''){
                    
                        return response()->json([
                            'errcode' => '2',
                            'errmsg' => '目标地址不能为空',
                        ],200);
                   }
                }
               
                $ads = Advertisement::where('type',3)->orwhere('type',2)->get();
                foreach ($ads as $key => $ad) {
                    $ad->delete();
                }
                
                foreach ($imgs as $ke => $i) {
                    $advertisement = Advertisement::create([
                    'type' => $type,
                    'img' => $i['img'],
                    'url' => $i['url'],
                    ]);
                }

                return response()->json([
                    'errcode' => '1',
                    'errmsg' => '提交成功',
                ],200);
                       
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

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Advertisement $advertisement)
    {

        $advertisement->update([
            'img' => $request->img,
            'url' => $request->url,

            ]);
        if($advertisement){
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
    public function destroy(Advertisement $advertisement)
    {
        $advertisement -> delete();
        return 1;
    }
}
