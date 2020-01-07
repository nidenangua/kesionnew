<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>kesion教育平台</title>
<meta name="Keywords" content="kesion教育平台"/>
<meta name="Description" content="kesion教育平台" />
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<style>
/*	tbody td{
		border: 1px solid gainsboro;
	}
.ks-table1 .ks-table-td {padding: 30px 10px;border: 1px solid #eee;position: relative;}	
.ks-table1 .ks-table-txt {border: 1px solid #eee;padding-left: 20px;padding-top: 20px;padding-right: 10px;position: relative;}
.ks-table1 .ks-table-tdt {height: 40px;}
.ks-table1 .ks-table-tdt input{position: relative;top:5px}
.ks-information {display: block;position: absolute;display: block;top: 30%;right: -80%;padding:15px;background: #f5f5f5;display: none;z-index: 9;text-align: left;min-width: 130px;}
.ks-table td{position: relative;}
.showbox_left{right: 100%;}*/
.ks-course-cc {height: 40px;line-height: 40px;background: #1095c8;}
.ks-course-cc .ks-course-cb{color:#fff;font-size: 16px;padding-left: 30px;}
.ks-course-p200{padding-left: 200px !important;}
.ks-course-teacher li {float: left;height: 40px;line-height: 40px;width: 25%;}
.ks-course-teacher li a{border-right: 1px solid #eee;display: block;text-align: center;font-size: 16px;}
.ks-course-teacher{border: 1px solid #eee;margin-top: 10px;}
.ks-course-teacher li:last-child a{border-right: 0;text-align: center;}
.ks-course-content li{float: left;width: 12.4%;height: 40px;line-height: 40px;text-align: center;font-size: 16px;color: #666;border-right: 1px solid #eee;box-sizing: border-box;}
.ks-course-data {position: relative;padding-left: 40px;padding-right: 40px;overflow: hidden;border: 1px solid #eee;margin-top: 10px;}
.ks-course-prev{position: absolute;height: 40px;width: 40px;left: 0;top: 0;line-height: 40px;text-align: center;}
.ks-course-next{position: absolute;height: 40px;width: 40px;right: 0;top: 0;line-height: 40px;text-align: center;}
.ks-table{border:0;margin-top: 10px;}
.ks-table th, .ks-table td{border:0;border-bottom: 1px solid #eee;}
.ks-table th{border-top:1px solid #eee}
.ks-course-list span{display: block;}

</style>
</head>
<body class="ks-wrap">
	<!--开始-->
	<div class="bRadius10 bg-white ks-wbox">
		<div id="ksBoxHead">	
		<div class="generalTitle clearfix">
			<div class="fl back-bt">
				<a href="javascript:history.go(-1);"><i class="iconfont icon-jiantou-copy"></i>班级管理</a><span>/</span>课表		    		
			</div>
			  	
	  

		</div>
		</div>
    
		<div id="ksBoxContent">
		
	<!--	<table width="100%" border="1" cellpadding="2" cellspacing="2" class="ks-table"> 
		    <tr style="height: 100px;"> 
		        <th colspan='7'> 
		            <?php 
		            echo date ( 'n', mktime ( 0, 0, 0, $month, 1, $year ) ) . '-' .$year;  
		            ?> 
		        </th> 
		    </tr> 
		    <tr style="height: 100px;"> 
		        <th>日</th> 
		        <th>一</th> 
		        <th>二</th> 
		        <th>三</th> 
		        <th>四</th> 
		        <th>五</th> 
		        <th>六</th> 
		    </tr>  
		<?php 
		foreach ( $week as $k => $v ) {  
		    echo '<tr style="height: 100px;">';  
		    for($i = 0; $i < 7; $i ++) {  
		        echo '<td align="center" id="pm'.$v[$i].'"><a href="javascript:void(0)" onclick="addTypeChange(\''.M_URL($this->AppName.'/Index','addClasstable',$classroomid,GP('')).'\',\'800px\',\'600px\',{title:\'添加课表\',type:\'top\'});">' . $v[$i] . '</a><div class="ks-information" data-name="pm'.$v[$i].'"><div class="ks-infor-title">标题:测试1</div><div class="ks-infor-user">用户名：name1</div><div class="ks-infor-teachr">教师名：teacher1</div></td>';  
		    }  
		    echo "</tr>";  
		}  
		?>
		</table>		-->
		<div class="ks-course-cc">
			<span class="ks-course-cb">英语加强班</span>
			<span class="ks-course-cb ks-course-p200">班主任：刘娜老师</span>
		</div>
		<div class="ks-course-teacher">
			<ul class="clearfix">
				<li><a>刘娜老师</a></li>
				<li><a>张峰老师</a></li>
				<li><a>刘丹老师</a></li>
				<li><a>徐俊老师</a></li>
			</ul>
		</div>
		<div class="ks-course-data">
			<div class="ks-course-prev"><i class="iconfont icon-jiantou-copy1"></i></div>
			<div class="ks-course-next"><i class="iconfont icon-jiantou-copy2"></i></div>
			<div class="ks-course-content">
				<ul class="clearfix">
					<li>12.25-12.31</li>
					<li>12.25-12.31</li>
					<li>12.25-12.31</li>
					<li>12.25-12.31</li>
					<li>12.25-12.31</li>
					<li>12.25-12.31</li>
					<li>12.25-12.31</li>
					<li>12.25-12.31</li>
			</div>
		</div>
		<table width="100%" border="1" cellpadding="2" cellspacing="2" class="ks-table"> 
		   <thead>
		   	<tr>
		   		<th>时间</th>
		   		<th>星期一</th>
		   		<th>星期二</th>
		   		<th>星期三</th>
		   		<th>星期四</th>
		   		<th>星期五</th>
		   		<th>星期六</th>
		   		<th>星期日</th>
		   	</tr>
		   	
		   </thead>
		  <tbody>
		  	<tr>
		  		<td>8:00-10:00</td>
		  		<td></td>
		  		<td></td>
		  		<td></td>
		  		<td></td>
		  		<td></td>
		  		<td>
		  			<div class="ks-course-list">
		  				<span>英语单词加强</span>
		  				<span>刘娜老师</span>
		  				<span class="ks-course-live">线上直播</span>
		  			</div>
		  		</td>
		  		<td>
		  			<div class="ks-course-list">
		  				<span>英语单词加强</span>
		  				<span>刘娜老师</span>
		  				<span class="ks-course-live">线上直播</span>
		  			</div>
		  		</td>
		  	</tr>
		  	<tr>
		  		<td>10:00-12:00</td>
		  		<td></td>
		  		<td></td>
		  		<td></td>
		  		<td></td>
		  		<td></td>
		  		<td></td>
		  		<td>
		  			<div class="ks-course-list">
		  				<span>英语单词加强</span>
		  				<span>刘娜老师</span>
		  				<span class="ks-course-live">线上直播</span>
		  			</div>
		  		</td>
		  	</tr>
		  	<tr>
		  		<td>14:00-16:00</td>
		  		<td></td>
		  		<td></td>
		  		<td></td>
		  		<td></td>
		  		<td></td>
		  		<td></td>
		  		<td>
		  			<div class="ks-course-list">
		  				<span>英语单词加强</span>
		  				<span>刘娜老师</span>
		  				<span class="ks-course-live">线上直播</span>
		  			</div>
		  		</td>
		  	</tr>
		  	<tr>
		  		<td>16:00-18:00</td>
		  		<td></td>
		  		<td></td>
		  		<td></td>
		  		<td></td>
		  		<td></td>
		  		<td></td>
		  		<td>
		  			<div class="ks-course-list">
		  				<span>英语单词加强</span>
		  				<span>刘娜老师</span>
		  				<span class="ks-course-live">线上直播</span>
		  		</td>
		  	</tr>
		  	<tr>
		  		<td>18:00-20:00</td>
		  		<td>
		  			<div class="ks-course-list">
		  				<span>英语单词加强</span>
		  				<span>刘娜老师</span>
		  				<span class="ks-course-live">线上直播</span>
		  			</div>
		  		</td>
		  		<td>
		  			<div class="ks-course-list">
		  				<span>英语单词加强</span>
		  				<span>刘娜老师</span>
		  				<span class="ks-course-live">线上直播</span>
		  			</div>
		  		</td>
		  		<td>
		  			<div class="ks-course-list">
		  				<span>英语单词加强</span>
		  				<span>刘娜老师</span>
		  				<span class="ks-course-live">线上直播</span>
		  			</div>
		  		</td>
		  		<td>
		  			<div class="ks-course-list">
		  				<span>英语单词加强</span>
		  				<span>刘娜老师</span>
		  				<span class="ks-course-live">线上直播</span>
		  			</div>
		  		</td>
		  		<td>
		  			<div class="ks-course-list">
		  				<span>英语单词加强</span>
		  				<span>刘娜老师</span>
		  				<span class="ks-course-live">线上直播</span>
		  			</div>
		  		</td>
		  		<td></td>
		  		<td></td>
		  	</tr>
		  	
		  
		  </tbody>
		</table>
		</div>
		<div id="ksBoxFooter">
			
		</div>
</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js" type="text/javascript"></script>
<script>

	 
	 var typeId = 0;

$('.ks-table td').hover(function(){
	 typeId = $(this).attr('id');

		var isLeft = false;
			if($(this).offset().left>window.innerWidth/2){
				isLeft = true;
			};
			
		  if(isLeft&&$('.ks-information[data-name="'+typeId+'"]')[0].className.indexOf('showbox_left')==-1){
			   $('.ks-information[data-name="'+typeId+'"]').addClass('showbox_left');
		  }
		$(this).find('.ks-information').show(); 
		   if(typeId=='pm'){
	    	console.log(typeId)
	    	$(this).find('.ks-information').hide(); 
	    }
	
		
	 },function(){
	 	
		 $(this).find('.ks-information').hide();
	 });
</script>
</body>
</html>

