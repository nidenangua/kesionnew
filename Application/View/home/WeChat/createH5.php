<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/home.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/common/lCalendar/css/lCalendar.css" rel="stylesheet">
    <script>
    	var uoot = '<?php echo UOOT ?>';	
    </script> 	
</head> 
<body>
	
	<div id="h5PrevBtn"></div>
	<div id="h5NextBtn"></div>
	<div id="stepList">
		<div class="step">
			<div class="step-box">
				<div class="title">基础配置</div>
				
				<div class="form-row clearfix">
              		<div class="name">活动名称</div>
              		<div class="form-limit" limit="50">
	              		<input type="text" value="体验课" class="form-textbox" name="name" onkeyup="setH5Name(this.value)">
              		</div>
				</div>
				
				<div class="form-row">
					<div class="name">参与人数</div>
					<div class="clearfix"><label for="participantsNumber0"><input type="radio" value="0" name="addparticipantsNumber" id="participantsNumber0" onclick="$_id('participantsNumberBox').style.display='none'" />隐藏</label><label for="participantsNumber1"><input type="radio" value="1"  name="addparticipantsNumber" id="participantsNumber1" onclick="$_id('participantsNumberBox').style.display='block'" checked />显示</label>
						
					</div>
					<div  class="form-info" id="participantsNumberBox">在实际参与人数上再加上 <input type="number" name="participantsNumber" value="0" class="form-textbox" style="width: 4rem;" /> 人</div>
				</div>
				
				<div class="form-row">
					<div class="name">参与人数限制</div>
					<div class="clearfix">
						<label for="numberLimit0" onclick="$_id('numberLimitBox').style.display='none'"><input type="radio" value="0" name="numberLimit" id="numberLimit0" checked />不限制</label><label for="participantsLimit1" onclick="$_id('numberLimitBox').style.display='block'"><input type="radio" value="1" name="numberLimit" id="numberLimit1"  />限制</label>
						<span id="numberLimitBox" style="display:none;"><input type="number" value="100" name="numberLimitValue" class="form-textbox w80" /> 人</span>
					</div>
				</div>
				
				<div class="form-row clearfix">
              		<div class="name">活动开始时间</div>
	              	<input id="startTime" type="text" value="2018-05-07 11:06:38" name="startime" required readonly class="w300 form-textbox" data-lcalendar="2018-1-1,2050-12-31">   		
				</div>
				<div class="form-row clearfix">
              		<div class="name">活动结束时间</div>
	              	<input id="endTime" type="text" value="2018-05-14 11:06:38" name="endtime" required readonly class="w300 form-textbox" data-lcalendar="2018-1-1,2050-12-31">
				</div>
				
			</div>
			<div class="step-bg"></div>
		</div>
		
		
	</div>
	<div id="h5"></div>
	<div class="h5-operation-button">
		<div class="button">预览活动</div>
		<div class="button button-primary">确认创建</div>
	</div>
	<script src="<?php echo UOOT ?>Public/common/js/z.methodLibrary.js?version=1.0"></script>
	<script src="<?php echo UOOT ?>Public/wechat/js/main.js?version=1.0"></script>
	<script src="<?php echo UOOT ?>Public/common/lCalendar/js/lCalendar.js"></script>
	<script>
		var H5Path = '<?php if(empty($setting)){echo UOOT.$h5['url'].'index.html';}else{ echo UOOT.$setting['h5index'];} ?>';
		admissionsShow.h5.create(H5Path,'h5');
		var a = new lCalendar()
		a.init({
			'trigger': '#startTime',
			'type': 'datetime'
		})
		$_id('stepList').findTag('span')
	</script>
</body>
</html>