<style type="text/css" media="screen">
.pano_close {
    margin-top: 20px;
}

.anchorBL {
    display: none;
}

.BMap_stdMpCtrl {
    top: 40px !important;
}

.BMap_scaleCtrl {
    top: 9px !important;
    left: 136px !important;
}
</style>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=g4LkNaOq48zGwXLuqoB3YdAtBVWkOGcu"></script>
<div style="position: absolute;right: 63px;width: 30%; top: 28px; z-index: 9999;line-height: 34px;background: rgba(0,0,0,0.4);padding: 5px 10px;color: #fff;border-radius: 5px;" id="r-result">请输入地址:
    <input type="text" id="suggestId" class="form-control input" style="width:75%;float: right;height: 34px;border-radius: 13px;" placeholder="{$value['address']?$value['address']:'请输入地址'}" value="{$value['address']?$value['address']:''}" />
</div>
<div id="map" style="width: 100%;height: 500px;overflow: hidden;margin:0;font-family:'微软雅黑';"></div>
<!-- 经度 -->
<input type="hidden" id="longitude" name="" value="{$value['longitude']?$value['longitude']:''}">
<!-- 纬度 -->
<input type="hidden" id="latitude" name="" value="{$value['latitude']?$value['latitude']:''}">
<!-- 市名 -->
<input type="hidden" id="city_name" name="" value="{$value['city_name']?$value['city_name']:''}">
<script type="text/javascript">
  // 百度地图API功能
  var geoc = new BMap.Geocoder();
  var map = new BMap.Map("map");
  var myValue;
  // 初始化地图,设置城市和地图级别。
  map.centerAndZoom("北京", 12);
  map.enableScrollWheelZoom(true);
  var geolocation = new BMap.Geolocation();
  // 判断是否存在经纬度
  {if condition="!empty($value['longitude']) && !empty($value['latitude'])"}
      //定时器切换地图
      window.setTimeout(function() {
        //按照经纬度设置地图中心点
          map.panTo(new BMap.Point({$value['longitude']},{$value['latitude']}),18);
          //创建标点
          map.addOverlay(new BMap.Marker({'lng':{$value['longitude']},'lat':{$value['latitude']}}));
      }, 1000);
      // 地址输入框赋值
      $('#suggestId').val("{$value['address']}")
      //地图绑定点击事件
      map.addEventListener("click", function(e) {
          //点击信息
          pp = e.point;
          //清除标点
          map.clearOverlays();
          //隐藏域经度赋值
          $('#latitude').val(pp.lat);
          // 隐藏域纬度赋值
          $('#longitude').val(pp.lng);
          //添加标点
          map.addOverlay(new BMap.Marker(pp));
      });
      {else /}
        window.setTimeout(function() {
            geolocation.getCurrentPosition(function(r) {
                if (this.getStatus() == BMAP_STATUS_SUCCESS) {
                    var mk = new BMap.Marker(r.point);
                    map.panTo(r.point);
                }
            }, { enableHighAccuracy: true })
        }, 500);
    {/if}
  //建立一个自动完成的对象
  var ac = new BMap.Autocomplete({ "input": "suggestId", "location": map });

  //鼠标点击下拉列表后的事件
  var top_left_control = new BMap.ScaleControl({ anchor: BMAP_ANCHOR_TOP_LEFT }); // 左上角，添加比例尺
  var top_left_navigation = new BMap.NavigationControl(); //左上角，添加默认缩放平移控件
  var top_right_navigation = new BMap.NavigationControl({ anchor: BMAP_ANCHOR_TOP_RIGHT, type: BMAP_NAVIGATION_CONTROL_SMALL }); //右上角，仅包含平移和缩放按钮
  var mapType1 = new BMap.MapTypeControl({ mapTypes: [BMAP_NORMAL_MAP, BMAP_HYBRID_MAP] });
  var mapType2 = new BMap.MapTypeControl({ anchor: BMAP_ANCHOR_TOP_LEFT });
  map.addControl(mapType2); //左上角，默认地图控件
  map.addControl(top_left_control);
  map.addControl(top_left_navigation);
  ac.addEventListener("onconfirm", function(e) {
      var _value = e.item.value;
      myValue = _value.province + _value.city + _value.district + _value.street + _value.business;
      $('#city_name').val(_value.city);
      setPlace();
  });
  setTimeout(function(){
    $('#suggestId').val("{$value['address']?$value['address']:''}")
  },500)
  function setPlace() {
      //清除地图上所有覆盖物
      map.clearOverlays();
      function myFun() {
          //获取第一个智能搜索的结果
          var pp = local.getResults().getPoi(0).point;
          $('#latitude').val(pp.lat);
          $('#longitude').val(pp.lng);
          map.centerAndZoom(pp, 18);
          //添加标注
          map.addOverlay(new BMap.Marker(pp));
      }
      var local = new BMap.LocalSearch(map, { //智能搜索
          onSearchComplete: myFun
      });
      local.search(myValue);
      map.addEventListener("click", function(e) {
          pp = e.point;
          map.clearOverlays();
          $('#latitude').val(pp.lat);
          $('#longitude').val(pp.lng);
          map.addOverlay(new BMap.Marker(pp));
      });
  }
   function StorageData(){
        var latitude=$("#latitude").val();
        var longitude=$("#longitude").val();
        var city_name=$("#city_name").val();
        var address=myValue;
        var returndata={lng:longitude,lat:latitude,address:address,city_name:city_name};
        return returndata;
    }
</script>