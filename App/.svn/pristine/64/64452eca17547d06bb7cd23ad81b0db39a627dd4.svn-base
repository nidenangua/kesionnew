<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
	<style type="text/css">
		body, html,#allmap {width: 100%;height: 100%;overflow: hidden;margin:0;font-family:"微软雅黑";}
	</style>
	<script type="text/javascript" src="https://api.map.baidu.com/api?v=2.0&ak=GT09yXXRIpbwie6TCWX8qzlfuIdom5O9"></script>
	<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>


	<title>浏览器定位</title>
</head>
<body>
	<div id="l-map"></div>
	<div id="r-result">请输入:<input type="text" id="suggestId" size="20" value="百度" style="width:150px;" /></div>
	<button onclick="getAddress()">确定</button>
	<div id="searchResultPanel" style="border:1px solid #C0C0C0;width:150px;height:auto; display:none;"></div>
	<div id="allmap"></div>
</body>
</html>
<script type="text/javascript">
	// 百度地图API功能
	var map = new BMap.Map("allmap");
		map.enableScrollWheelZoom(true);
	var point = new BMap.Point(116.331398,39.897445);
	map.centerAndZoom(point,12);
	var cityName="厦门";
	
	function myFun(result){
		cityName = result.name;
		map.setCenter(cityName);
		$('#suggestId').val(cityName);
	}
	var myCity = new BMap.LocalCity();
	<?php if(empty($address)){ ?>
		myCity.get(myFun);
	<?php }else{ ?>	
	    $('#suggestId').val(<?php echo $address ?>);
	<?php } ?>
		var abc = '';
	map.addEventListener("click",function(e){
		map.removeOverlay(abc);

		point = new BMap.Point(e.point.lng,e.point.lat);
	   var marker = new BMap.Marker(point);  // 创建标注
	    abc =marker;
	   map.addOverlay(marker);
	   
	   
	   var geoc = new BMap.Geocoder();    

		var pt = point;
		geoc.getLocation(pt, function(rs){
			var addComp = rs.addressComponents;
			
			$('#suggestId').val(addComp.province+addComp.city+addComp.district+addComp.street+addComp.streetNumber);
		});        

	   
	   
	   
	   
	   
	   
	   
	   
		
	});
	
	
	    
function getAddress(){
	var  address = $('#suggestId').val();
	$(parent.document).find('#main').contents().find("#address").val(address);
	 top.closePopup(window.name);
	
	
}		
	
	
	
	
	
</script>
<script type="text/javascript">
	// 百度地图API功能
	function G(id) {
		return document.getElementById(id);
	}

	
	             

	var ac = new BMap.Autocomplete(    //建立一个自动完成的对象
		{"input" : "suggestId"
		,"location" : map
	});

	ac.addEventListener("onhighlight", function(e) {  //鼠标放在下拉列表上的事件
	var str = "";
		var _value = e.fromitem.value;
		var value = "";
		if (e.fromitem.index > -1) {
			value = _value.province +  _value.city +  _value.district +  _value.street +  _value.business;
		}    
		str = "FromItem<br />index = " + e.fromitem.index + "<br />value = " + value;
		
		value = "";
		if (e.toitem.index > -1) {
			_value = e.toitem.value;
			value = _value.province +  _value.city +  _value.district +  _value.street +  _value.business;
		}    
		str += "<br />ToItem<br />index = " + e.toitem.index + "<br />value = " + value;
		G("searchResultPanel").innerHTML = str;
	});

	var myValue;
	ac.addEventListener("onconfirm", function(e) {    //鼠标点击下拉列表后的事件
	var _value = e.item.value;
		myValue = _value.province +  _value.city +  _value.district +  _value.street +  _value.business;
		G("searchResultPanel").innerHTML ="onconfirm<br />index = " + e.item.index + "<br />myValue = " + myValue;
		
		setPlace();
	});

	function setPlace(){
		map.clearOverlays();    //清除地图上所有覆盖物
		function myFun(){
			var pp = local.getResults().getPoi(0).point;    //获取第一个智能搜索的结果
			map.centerAndZoom(pp, 18);
			map.addOverlay(new BMap.Marker(pp));    //添加标注
		}
		var local = new BMap.LocalSearch(map, { //智能搜索
		  onSearchComplete: myFun
		});
		local.search(myValue);
	}
</script>