<!DOCTYPE HTML>
<html><head><meta charset="UTF-8">
<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no"/>
<link rel="stylesheet" href="https://g.alicdn.com/de/prismplayer/1.7.6/skins/default/index.css" />
<script type="text/javascript" src="https://g.alicdn.com/de/prismplayer/1.7.6/prism.js"></script>
</head><body><div class="prism-player" id="J_prismPlayer"></div>
<script>

var player = new prismplayer({id: "J_prismPlayer",
                              autoplay: true,width: "600px",
							  height:"540px",
							   //支持播放地址播放,此播放优先级最高
                              source : '<?php echo $playurl ?>',
							  
							 });
</script>


<!--<link rel="stylesheet" href="https://g.alicdn.com/de/prismplayer/1.7.6/skins/default/index.css" />
<script type="text/javascript" src="https://g.alicdn.com/de/prismplayer/1.7.6/prism.js"></script>
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<script type="text/javascript">
document.write("<div id = 'J_prismPlayer' style='width: 1920px;height: 1280px;' class='prism-player'></div >");
window.onload = function () {
	var url = '<?php echo UOOT;?>Plus/Play/KsPlayApi.php?act=playAuth';
	var data = {id : '<?php echo $playurl; ?>'}
	    $.ajax({
	        type : "post",
	        url : url,
			data:data,
	        success:function(data){
		       var obj = JSON.parse(data);
			   new window.prismplayer({id: "J_prismPlayer",
	                        autoplay: true,
							width: "600px",
							height: "540px",
							vid: '<?php echo $playurl; ?>',
							playauth: obj.PlayAuth,
			  });	
		}
	 });		
}
 </script>-->

</body>
</html>