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
<link href="<?php echo UOOT;?>Public/app/css/live.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<style>
.courseList li{ position:relative; padding-left:280px;min-height:100px;padding-top:20px; padding-bottom:20px; padding-right:20px; border-bottom:1px solid #eee;}
.courseList li .tface{width:180px;height:140px; position:absolute;top: 50%;margin-top:-70px; left: 60px; text-align:center;}
.teacherInfo{ padding-top:6px; padding-bottom:6px; margin-top:5px;}
.TcTab{ height:35px; border-bottom:1px solid #128fd1;}
.TcTab li{ width:72px;text-align:center;line-height:35px; font-size:16px; cursor:pointer;}
.TcTab li.curr{ background:#128fd1; color:#fff;}
.TcTab li a {display:block;width:72px;}
.TcTab li.curr a {color:#fff} 
.bg-1a{ background:#1ab394;}
.TcTabBox .courseList{ display:none;}
.btn-primary{ background-color: #18a689; border-color: #18a689; color: #FFF; }
.btn-w-m { min-width: 120px; }
.btn{ display: inline-block; padding: 6px 12px; margin-bottom: 0; font-size: 14px; font-weight: 400; line-height: 1.42857143; text-align: center; white-space: nowrap; border: 1px solid transparent; border-radius: 4px; }
@media screen and (max-width: 1180px){ .w100 {width:60px} }
.optlist { line-height: 37px;}
</style>
</head>
<body class="ks-wrap">
	<!--开始-->
	<div class="bRadius10 bg-white ks-wbox">
	<div class="generalTitle clearfix">
	    <span class="title-icon"><i class="iconfont icon-myorder"></i></span>
        <span class="gTitle fsize18">课程应用</span>
	    <div class="fr">
	    	<!--按钮块--->
			<ul>
	           	<li class="fl">
	           		<a class="ks-bt bt-def" href="javascript:void(0)" onclick="addTypeChange('<?php echo M_URL('course/Index','addcourse','',GP(''))?>','850px','480px',{type:'top'})" class="alignCenter">
	           			<i class="iconfont icon-jiahao"></i>课程添加 </a>	
	           	</li>

			</ul>
			<!--按钮块--->
	    </div>
	</div>
	
	

	<div class="clearfix ks-top-tab">
		<div class="fl">
			<!--栏目块-->
			<ul>
		        
			    <li class="fl mr10  <?php if($stat==3) echo "curr"; ?>"> 
			   		<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP("status-3,appid-$this->appid",true)); ?>">所&nbsp;&nbsp;&nbsp;有</a>
			   	</li>
			   	<li class="fl mr10 <?php if($stat==2) echo "curr"; ?>">
			   		<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP("status-2,appid-$this->appid",true)); ?>">已上架</a>
			   	</li>
			    <li class="fl mr10 <?php if($stat==1) echo "curr"; ?>">
			   		<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP("status-1,appid-$this->appid",true)); ?>">未上架</a>
			   	</li>
	           	<li class="fl <?php if($stat==0) echo "curr"; ?>">
	           		<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP("status-0,appid-$this->appid",true)); ?>">未审核</a>           		
	           	</li>
		    </ul>
		    <!--栏目块-->
	    </div>
		<div class="fr ks-top-search">
			<!--搜索-->
			
			<a href="#" class="fl ks-bt bt-def mr10" >
					<i class="iconfont icon-jiantou"></i> 学员量</a>
			<a href="#" class="fl ks-bt bt-def mr10"><i class="iconfont icon-jiantou"></i>评论数</a>
			
				<label class="mr5">
				  
				   <select class="w150 inputText bRadius5 selectd"  onchange="getval(this,'<?php echo GP('p-'.$page->now_page); ?>','<?php echo M_URL($this->AppName.'/Index','index'); ?>','categoryid','<?php echo URL_MODEL;?>')">
					<?php
					  if(isset($category)){ 
						echo "<option value='0'>请选择</option>";
						foreach($category as $k=>$v){
						   $html = "<option value='$v[categoryid]' ";if($v['categoryid']==$categoryid){$html=$html."selected = 'selected'";}$html=$html.">".KS_INDENT($v['depth'])."$v[categoryname]</option>" ;
						   echo $html;
						}
					  }else{echo "<option value='0'>请选择</option>";}
					?>
				   </select>
				</label>
				<label class="mr5">
				   <select class="w150 inputText bRadius5">
			            <option value="0">请选择</option>
					    <option value="1">课程名</option>
					    <option value="2">老师</option>
					    <option value="3">机构</option>
			            <option value="4">学生</option>
				   </select>
				   
				</label>
				<form target="hidframe"  class="fr">
					<input type="text" class="inputText mr5 fl" name="searchText">
					<input type="button" class="ks-bt bt-def" name="searchBtn" value="搜索">
				</form>
				  <?php echo NoC($category);?>
			<!--搜索-->
		</div>
	</div>	
	
	 
 
			        
		
	
	
	<!--结束-->



<div class="topCourseBox contentBox clearfix bg-white bRadius10">
	
    <form target="hidframe"  action="<?php  echo M_URL($this->AppName.'/Index','batch','',GP('p-'.$page->now_page)) ?>" method="post">
	<div class="TcTabBox bg-white">
		<div class="ks-list">
	    <ul class="courseList" style="display:block;"> 
        <?php foreach($course as $v){ ?>
		  <li class="clearfix posRe">
		      <em class="posAb fsize16 c-92" style="left:20px;top: 50%;margin-top: -9px;">
                <div class="order-product pd-b"><input type="checkbox" class="verAlignMiddle mr10" name="check[]" value="<?php echo $v['courseid'];?>"></div>
              </em>
			  <div class="tface">
                 
				<img onerror="this.src='<?php echo nopic();?>'" src="<?php if($v["defaultpic"]!=''){echo Img($v["defaultpic"]);}else{echo '/Public/uploads/common/nopic.gif';}?>"  style="width:100%;height:100%;"  >
			  </div>
			  <div>
				<div class="clearfix">
				   <div class="fl"><span class="fsize18 c-333"><a href="<?php echo M_URL($this->AppName.'/Index','basics',$v['courseid'],GP(''));?>"><?php echo $v['title'];?></a></span></div>
				   <div class="fr">
					   <a class="mr10 fsize16 c-2c" href="<?php echo M_URL($this->AppName.'/Index','basics',$v['courseid'],GP(''));?>" title="编辑">编辑</a>
					   <a class="mr10 fsize16 c-2c" href="<?php echo M_URL($this->AppName.'/Index','comment',$v['courseid'],GP(''));?>" title="评价">评价<span><?php echo $v['commoncount'] ?></span></a>
					   <a class="mr10 fsize16 c-2c" href="<?php echo M_URL($this->AppName.'/Index','student',$v['courseid'],GP('')) ?>" title="学员">学员<span>(<?php echo $v['studentcount']; ?>)</span></a>
                   <?php if($v["status"]==0){ ?>
		               <a class="mr10 fsize16 c-2c" title="待审核">待审核</a>
		           <?php }elseif($v["status"]==2){ ?>
			           <a class="mr10 fsize16 c-2c" href="<?php echo M_URL($this->AppName.'/Index','down',$v['courseid'],GP('p-'.$page->now_page));?>">已上架</a>
			       <?php }elseif($v["status"]==1){ ?>
				       <a class="mr10 fsize16 c-2c" href="<?php echo M_URL($this->AppName.'/Index','up',$v['courseid'],GP('p-'.$page->now_page)); ?>">未上架</a>
				   <?php }  ?>
		               <a class="mr10 fsize16 c-2c" href="javascript:void(0);" title="删除"  onclick="Confirm('是否删除此课程？该操作不可逆！','<?php echo M_URL($this->AppName.'/Index','delect',$v['courseid'],GP('p-'.$page->now_page)); ?>')">删除</a>
				   </div>
				</div>
			  </div>
			  <div>
			  		<div>
			  			<span class="block hLh30 fsize18 c-red mr20">课程类型：
				  		<?php if($v['courseType'] == 1){ ?>点播<?php }elseif($v['courseType'] == 2){ ?>直播<?php }elseif($v['courseType'] == 4){ ?>组合<?php } ?>
				    	</span>
				    	<span class="block hLh30 fsize14 c-92">主讲老师：<?php echo $v['speakerteacher'] ?></span>
			  		</div>
			  		
			    	<div>			    		
						<span class=" fsize14">评分:<span class="fsize14 c-red ml10"><?php echo $v['price'];?></span></span>
						<span class=" ml50 fsize14 c-92">进度：<font class="c-green">50%</font></span>
						<span class="block hLh30 fsize14 c-92 mr20">评论数：<?php echo $v['commoncount']; ?></span>
			    	</div>
	
			  </div>
			  		
			  <div class="clearfix posRe fr" style="margin-top: -80px;">
                <a class="fl" href="<?php echo M_URL($this->AppName.'/Index','period',$v['courseid'],GP(''));?>">
				<div class="fl borderSo w100p pl10 pr10 teacherInfo bRadius5">
				   <div class="fl fsize14 c-92">
					 <span class="block">课程</span>
					 <span class="block">1门</span>
				   </div>
				   <div class="fr iconfont c-92 fsize30 hLh40">&#xe673;</div>
				</div>
				</a>
				<div class="fl borderSo ml30 w100p pl10 pr10 teacherInfo bRadius5">
				   <div class="fl fsize14 c-92">
					 <span class="block">资料</span>
					 <span class="block">1份</span>
				   </div>
				   <div class="fr iconfont c-92 fsize30 hLh40">&#xe604;</div>
				</div>
				<a href="<?php echo M_URL($this->AppName.'/Index','exam',$v['courseid'],GP(''));?>">	
				<div class="fl borderSo ml30 w100p pl10 pr10 teacherInfo bRadius5">
				   <div class="fl fsize14 c-92">
					 <span class="block">考卷</span>
					 <span class="block"><?php echo $v['examcount'] ?>个</span>
				   </div>
				   <div class="fr iconfont c-92 fsize30 hLh40">&#xe612;</div>
				</div>
				</a>
				<a href="<?php echo M_URL($this->AppName.'/Index','teacher',$v['courseid'],GP(''));?>">		
				<div class="fl borderSo ml30 w100p pl10 pr10 teacherInfo bRadius5">
				   <div class="fl fsize14 c-92">
					 <span class="block">老师</span>
					 <span class="block"><?php echo $v['teachercount'] ?>个</span>
				   </div>
				   <div class="fr iconfont c-92 fsize30 hLh40">&#xe603;</div>
				</div>
			    </a>
			  </div>
		  </li>
		<?php } ?>
        <?php echo NoC($course);?>
	   </ul>
	  </div>
		</div>
   	 </form>
   	 
	</div>
</div>

<div class="ks-bom clearfix">
	<span class="fl">
		<label class="mr20 fl mt10"><input type="checkbox" class=" verAlignMiddle mr10 checkall check-all"><span class="verAlignMiddle  fsize14 c-92">全选</span></label>
        <button type="submit" class="ks-bt bt-def mr10" name="batch" value="1"><i class="iconfont icon-shanchu1"></i>批量删除</button>
        <button type="submit" class="ks-bt bt-def mr10" name="batch" value="2"><i class="iconfont icon-top"></i>批量上架</button>
        <button type="submit" class="ks-bt bt-def mr10" name="batch" value="3"><i class="iconfont icon-bottom"></i>批量下架</button>
	</span>
	<?php echo $page->show(3); ?>
</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js" ></script>
<script>
$(function(){
	$(".liveTab li:first").css("border-right",0);
})
tapsAction('.TcTab','.contentBox','.TcTabBox','.courseList');/*复用选项卡*/
loadScorllJs()//滚轮；
var selectInputs = $('.verAlignMiddle'); 
	var checkAllInputs = $('.check-all');
	selectall(selectInputs,checkAllInputs);/*全选1*/
</script>
</body>
</html>
