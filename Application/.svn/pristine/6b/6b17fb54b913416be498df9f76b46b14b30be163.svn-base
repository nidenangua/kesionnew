<!DOCTYPE html>  
<html>  
<head>  
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />  
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">  
<title>Hello, World</title>  
<style type="text/css">  
html{height:100%}  
body{height:100%;margin:0px;padding:0px}  
#container{height:100%}  
</style>  
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=M6RGVAp4M4izqZH55I8CPMRPavwG0XSw">
//v2.0版本的引用方式：src="http://api.map.baidu.com/api?v=2.0&ak=您的密钥"
//v1.4版本及以前版本的引用方式：src="http://api.map.baidu.com/api?v=1.4&key=您的密钥&callback=initialize"
</script>
</head>  
 
<body>  
<div id="container"></div> 
<script type="text/javascript"> 
var map = new BMap.Map("container");          // 创建地图实例  
var point = new BMap.Point(116.404, 39.915);  // 创建点坐标  
map.centerAndZoom(point, 15);  // 初始化地图，设置中心点坐标和地图级别
 var geolocation = new BMap.Geolocation();
 geolocation.getCurrentPosition(function(r){
  if(this.getStatus() == BMAP_STATUS_SUCCESS){
    //表示获取成功那么 r 这个参数就包含有当前的地理位置经纬度
　　　　//逆地址解析，就是要把当前的经纬度转为当前具体地理位置
　　　　//逆地址解析
　　　　　　var geoc = new BMap.Geocoder();
　　　　　　var pt = new BMap.Point(p_x, p_y);//实例化这两个点
　　　　　　geoc.getLocation(pt, function (rs) {
　　　　　　　　var addComp = rs.addressComponents;
　　　　　　　　$('.its-place').html(addComp.province + addComp.city + addComp.district + addComp.street + addComp.streetNumber)
　　　　　　　　alert(addComp.province + ", " + addComp.city + ", " + addComp.district + ", " + addComp.street + ", " + addComp.streetNumber);

　　　　　　　　//对应的省市区、县街道，街道号
　　　　});

}else {
   alert('failed'+this.getStatus());
  }  
 },{enableHighAccuracy: true})  
</script>  
</body>  
</html>