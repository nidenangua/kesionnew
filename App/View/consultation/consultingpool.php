<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit"> 
<title>kesion教育平台</title>
<meta name="Keywords" content="kesion教育平台"/>
<meta name="Description" content="kesion教育平台" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/course.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/laydate.css" rel="stylesheet">

</head>
<body class="ks-wrap">  
	
	<div id="ksBoxHead" >
		<!--结束-->
		<div class="Header-tool clearfix"> 
			<div class="Tool-Title">
			
			<!--图像-->
			<span class="Tool-icon">
				<i class="iconfont icon-kechengxitong"></i>
			</span>
			<!--图像-->
			
			
			<!--标题-->
			<p>咨询本</p>
			<!--标题-->
			
			</div>
			<!--操作范围-->
			
			<!--按钮组件-->
			<div class="Tool-btnGroup">
				<a class="ks-bt bt-pur mr10" href="<?php echo M_URL($this->AppName.'/Index','addrecord','',GP(''))?>" class="alignCenter">
					<i class="iconfont icon-jiahao"></i>新增咨询 </a>
			</div>
			<!--按钮组件-->
			<div class="fl ks-view-tab mt10" style="overflow: inherit;">
				<ul>  
					<li <?php if($type==1)echo 'class="curr"'; ?>><a href="<?php echo M_URL($this->AppName.'/Index','index','',GP('type-1'));  ?>">我的咨询本</a></li>
					<li <?php if($type==2)echo 'class="curr"'; ?>><a href="<?php echo M_URL($this->AppName.'/Index','consultingpool','',GP('type-2'));?>">咨询池</a> </li>
					<li <?php if($type==3)echo 'class="curr"'; ?>><a href="<?php echo M_URL($this->AppName.'/Index','index','',GP('type-3'));  ?>">咨询记录</a> </li>
					<li <?php if($type==4)echo 'class="curr"'; ?>><a href="<?php echo M_URL($this->AppName.'/Index','index','',GP('type-4'));  ?>">试听管理</a></li>
					<li <?php if($type==5)echo 'class="curr"'; ?>><a href="<?php echo M_URL($this->AppName.'/Index','index','',GP('type-5'));  ?>">渠道管理</a></li>
						<form target="hidframe"  action="<?php echo M_URL($this->AppName.'/Index','index','',GP('p-'.$page->now_page.',timetype-5'));  ?>" method="post" id="myform2">
						<div class="ks-time">
							<input id="start" type="text" value="<?php if($timetype==5){echo $start;} ?>" name="starttime"  class="w300 laydate-icon"  >
													-
							<input id="end" type="text" value="<?php if($timetype==5){echo $end;} ?>" name="endtime"  class="w300 laydate-icon" >
						    <input  type="button" value="确定" name="endtime" onclick="selecttime()"  class="ks-bt bt-pue"  style="display: inline-block;float: none;" >	
						</div>
					</form>
					</li>
				</ul>
			</div>
			<!--搜索框组件-->
			<div class="clearfix ks-top-tab fr">
			
			<div class="fl ks-top-search">
			<!--搜索-->
			
					
			<!--<select class="w150 inputText bRadius5 fl" id="keytype">
			     <option value="1">课程名称</option>
	  	    </select>-->
			   
			<form target="hidframe"  class="fr">
				<input type="text" class="sc-text" name="searchText" id="keyword"  value="<?php if(isset($keyword)) echo $keyword; ?>">
            <input type="submit" class="sc-button" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','index'); ?>','<?php echo URL_MODEL;?>')" name="searchBtn" value="搜索" >
			</form>
						
			<!--搜索-->
			</div>
			</div>
			
			<!--搜索框组件-->
			
			<!--操作范围-->
		
		</div>
	</div>
	
	
	
	    <form target="hidframe"  action="<?php  echo M_URL($this->AppName.'/Index','batch','',GP('p-'.$page->now_page)) ?>" method="post" id="myform" class=" bRadius10 ">
		<div id="ksBoxContent">
			<!--筛选-->
	   <div class="H5-gameListScreen">
			<ul class="H5-gameOpt clearfix">
				<li style="margin-right: 10px;"><input type="checkbox" class="selectAll select-checks" style="position: relative;top: 4px;">全选</li>
				<!--<li>转换率<i class="iconfont icon-sort-double-down"></i></li>-->
				<li>
					<div class="class-tab clearfix job-mtb" style="margin-top: 7px;">
			       		<ul>
			       			 <li class="active" onclick="window.location='//ks.kesion.com/home.html/default/Capital/memberbill?option-1'">今日回访</li>
			       			 <li onclick="window.location='////ks.kesion.com/home.html/default/Capital/memberbill?option-2'">明日回访</li>
			       			 <li onclick="window.location='//ks.kesion.com/home.html/default/Capital/memberbill?option-3'">三天内容</li>
			       			 <li onclick="window.location='//ks.kesion.com/home.html/default/Capital/memberbill?option-4'">一周内</li>
			       			  <li onclick="window.location='//ks.kesion.com/home.html/default/Capital/memberbill?option-4'">自定义时间段</li>
			       	 	</ul>
				</div>
				</li>
			
			
			</ul>	
		</div>	   
	<!--end-->
	<div class="ks-wbox bRadius10">
		<table width="100%" cellpadding="0" cellspacing="0" border="0" class="ks-table">
			<thead>
                <tr>
                    <th>学生姓名</th>
                    <th>联系电话</th>
                    <th>咨询类别</th>
                    <th>咨询课程/班级名称</th>
                    <th>咨询校区</th>
                    <th>关系</th>
                    <th>意向度</th>
                    <th>渠道</th>
                    <th>最新回访时间</th>
                    <th>跟进次数</th>
                    <th>咨询课程/班级名称</th>
                    <th>跟进状态</th>
                    <th>操作</th>
                   
                </tr>
            </thead>
            <tbody>
            	<tr>
	            	<td>章天天</td>
	            	  <td>13799054713</td>
	            	  <td>一对一</td>
	            	  <td>英语加强班</td>
	            	  <td>思明校区</td>
	            	  <td>本人</td>
	            	  <td class="c-red">高</td>
	            	   <td>机构网校</td>
	            	  <td>2018-04-17 15:23:23</td>
	            	  <td>2018-04-20</td>
	            	  <td>1</td>
	            	  <td>已成单</td>
	            	   <td>
	            	   	<a>详情</a>
	            	   	<a>编辑</a>
	            	   	<a>回访</a>
	            	   	<a>试听</a>
	            	   	<a>报班</a>
	            	 </td>
	            </tr>
            	
            </tbody>
		</table>
			
		</div>
		
			
			
		</div>
	</form>
</div>

<div id="ksBoxFooter" class="ks-bom clearfix">
	<div class="fl">
		<label class="mr20 fl"><input type="checkbox" class="selectAll select-checks" >全选</label>
         <button type="submit" class="ks-bt bt-pue mr10" onclick="submitform(1)" >批量删除</button>
        <button type="submit" class="ks-bt bt-pue mr10" onclick="submitform(2)" >批量上架</button>
        <button type="submit" class="ks-bt bt-pue" onclick="submitform(3)" >批量下架</button>
	</div>
	<div class="fr">
		<?php echo $page->show(3); ?>
	</div>

<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
<script src="<?php echo UOOT;?>Public/common/js/common.js" ></script>
<script>
$(function(){
		starttime("#start");
		endtime("#end")
	
		$('.ks-view-tab li').click(function(){
		var index = $(this).index();
		$(this).addClass('curr').siblings().removeClass('curr');
		
	})
	
	$('.time-click').click(function(){
		$('.ks-time').slideToggle(300)
	})
	
	
	$(".liveTab li:first").css("border-right",0);
})
tapsAction('.TcTab','.contentBox','.TcTabBox','.courseList');/*复用选项卡*/



function submitform(type){
	$('#batch1').val(type);
	$('#myform').submit();
}	

function selecttime(){
var starttime = 　Date.parse(new Date($("input[name='starttime']").val()))/1000; 

if(!starttime){
	Alert('请选择开始时间');return false;
}
var endtime =Date.parse(new Date($("input[name='endtime']").val()))/1000;
if(!endtime){
	Alert('请选择结束时间');return false;
}  

window.location.href='<?php echo M_URL($this->AppName.'/Index','index','',GP('timetype-5')); ?>,starttime-'+starttime+',endtime-'+endtime+'';
		 
}	
	
</script>
</body>
</html>
