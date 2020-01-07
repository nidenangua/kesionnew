<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<link rel="shortcut icon" href="favicon.ico">
<link href="<?php echo UOOT;?>Public/admin/css/html5.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/common.css?<?php echo time();?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/news/newstyle.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
<link href="<?php echo UOOT;?>Public/app/css/laydate.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo UOOT;?>Public/common/js/layer/laydate.js"></script>

</head>
<style> 
	.deepRed{ color: red; cursor:pointer; }
	.deepRed:hover{ color: red; cursor:pointer; }
	.ks-operaRight{position: absolute; right: 20px; top: 50px;}
	.ks-operaRight li { float: right; margin-left:0px; padding: 2px; }
	.H5-gameList>li {position: relative;}
	.ring{position: absolute;right: 20px;top: 15px;width:250px;height: 40px;text-align: right;line-height: 40px;}
	.H5-gameOpt>li { float: left; line-height: inherit; margin-right: 20px; font-size: 14px; }
	.shaixuan .asc-i { top: 3px;}
	.shaixuan .desc-i { top: 3px;}
	.ks-table tbody tr:nth-of-type(even) {
		background: #f8f8f8
	}
	.labes label { margin-top:12px}
	.laydate-icon {
		width: 170px;
		margin-top: 15px;
	}
	@media  screen and (min-width:0px )and (max-width:1245px ) {
		.ks-operaRight{width:225px;}
		.likeCont{height:280px;}
		.this-top{margin-top: 40px;}
		.shaixuan a {font-size: 12px;margin-right: 5px;}
		.shaixuan .asc-i { top:0px!important;}
		.shaixuan .desc-i { top:0px!important;}
	}  
	.ks-head-el li{
		border-bottom: solid 1px #eceae6;
	}
   /*弹窗*/
    #choiceWindow {
        display:none;
        position:absolute;
        top:25%;
        left:25%;
        width:30%;
        height:30%;
        padding:20px;
        border:3px solid #ccc;
        background-color:white;
        z-index:2;
        overflow:auto;
    }
    #backGround {
        display:none;
        position:absolute;
        top:0%;
        left:0%;
        width:100%;
        height:1100px;
        background-color:black;
        z-index:1;
        -moz-opacity:0.8;
        opacity:.80;
        filter:alpha(opacity=88);
    }
    #x:hover {
        cursor:pointer;
        color:rgb(55,198,192);
    }
    #choiceWindow1 {
        display:none;
        position:absolute;
        top:25%;
        left:25%;
        width:30%;
        height:30%;
        padding:20px;
        border:3px solid #ccc;
        background-color:white;
        z-index:2;
        overflow:auto;
    }
    #backGround1 {
        display:none;
        position:absolute;
        top:0%;
        left:0%;
        width:100%;
        height:1100px;
        background-color:black;
        z-index:1;
        -moz-opacity:0.8;
        opacity:.80;
        filter:alpha(opacity=88);
    }
    #x1:hover {
        cursor:pointer;
        color:rgb(55,198,192);
    }
</style>
<body class="gray-bg"> 
<div class="wrapper" style="margin-top:35px">
<div class="row">
<div id="manage_top" class="menu_top_fixed  p15 height73" >
    <div class="ibox-title">
        <h3 class="fl">&nbsp;&nbsp;<span class="mr20">网校管理</span>
        	<a href="<?php echo M_URL('Domain','wxlist','',GP('')); ?>" class="mr20 act" style="color: blue;">注册网校</a>
        <?php if (checkAdminPower('Domain','apilist')){?>
        	<a href="<?php echo M_URL('Domain','apilist','',GP(''));?>" class="mr20">Api网校</a>
        <?php
              }
              ?>
        	&nbsp;&nbsp;&nbsp;&nbsp;网校个数&nbsp;&nbsp;<font class="defColor" size="5px"><?php echo $options['totalput']; ?></font>
        	&nbsp;&nbsp;&nbsp;&nbsp;本年新增&nbsp;&nbsp;<font class="defColor" size="4px"><?php echo $yearCout; ?></font>
        	&nbsp;&nbsp;&nbsp;&nbsp;本月新增&nbsp;&nbsp;<font class="defColor" size="4px"><?php echo $mCout; ?></font>
        	&nbsp;&nbsp;&nbsp;&nbsp;本周新增&nbsp;&nbsp;<font class="defColor" size="4px"><?php echo $weekCount; ?></font>
        	&nbsp;&nbsp;&nbsp;&nbsp;今日新增&nbsp;&nbsp;<font class="defColor" size="4px"><?php echo $dayCout; ?></font>
        </h3>
        
    </div>
</div>
</div>
<div id="ksBoxContent">

    <div class="fl" style="padding: 35px 0px;">
            <div class="fl ks-top-search">
           	<form class="fr" action="<?php echo M_URL('Domain','wxlist'); ?>" method="post">
            <input type="hidden" name="searchuser" value="1" />
			<!--搜索-->
			<!--<select style="width:160px" class="inputs bRadius5 fl mr10" onchange="getval(this,'<?php echo GP(''); ?>','<?php echo M_URL('Domain','wxlist'); ?>','categoryid','<?php echo URL_MODEL;?>');">
           <option value="" <?php if($keytype==1) echo "selected"; ?>>网校分类</option>
           <?php $userscategory=array();
                 if(isset($userscategory)){ 
                     echo "<option value='0'>请选择</option>";
                     foreach($userscategory as $k=>$v){
                         $html="<option value='$v[categoryid]' ";
                         if($v['categoryid']==$categoryid){
                             $html = $html."selected = 'selected'"; 
                         }
                         $html=$html.">
					   ".KS_INDENT($v['depth'])."$v[categoryname]</option>" ;
                         echo $html;
                     }
                 }else{echo "<option value='0'>请选择</option>";}?>
            </select>
			<select style="width:120px" class="inputs bRadius5 fl mr10" onchange="getval(this,'<?php echo GP(''); ?>','<?php echo M_URL('Domain','wxlist'); ?>','areaid','<?php echo URL_MODEL;?>');">
           <option value="" <?php if($keytype==1) echo "selected"; ?>>地区</option>
           <?php $areas=array();
                 if(isset($city)){ 
                     echo "<option value='0'>请选择</option>";
                     foreach($areas  as $k=>$v){
                         $html="<option value='$v[id]' ";
                         if($v['id']==$areaid){
                             $html=$html."selected = 'selected'";
                         }
                         $html=$html.">".KS_INDENT($v['depth'])."$v[city]</option>" ;
                         echo $html;
                     }
                 }else{echo "<option value='0'>请选择</option>";}?>
            </select>-->
			
		
                <select class="inputText bRadius5 fl" id="keytype" name="keytype" style="width: 150px;">
			     <option value="1" <?php if($keytype==1) echo "selected"; ?>>网校名称</option>
			     <option value="2" <?php if($keytype==2) echo "selected"; ?>>域名</option>
			     <option value="3" <?php if($keytype==3) echo "selected"; ?>>用户名</option>
			     <option value="4" <?php if($keytype==4) echo "selected"; ?>>机构ID</option>
			     <option value="5" <?php if($keytype==5) echo "selected"; ?>>手机号码</option>
			     <option value="6" <?php if($keytype==6) echo "selected"; ?>>业务员</option>
	  	    </select>
				<input type="text" style="width:150px" class="sc-text" name="keyword" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>">

               <label>
				<input type="radio" id="ratiotime" name="outtime" value="0" onclick="$('#timebox').hide()"<?php if ($outtime==0) echo "checked"; ?>/>时间不限
                   </label>
                <label>
				<input type="radio" id="ratiotime" name="outtime" value="1" onclick="$('#timebox').hide()"<?php if ($outtime==1) echo "checked"; ?>/>本周
                    </label>
                <label>
				<input type="radio" id="ratiotime" name="outtime" value="2" onclick="$('#timebox').hide()"<?php if ($outtime==2) echo "checked"; ?>/>本月
			   </label>
			    <label>
				    <input type="radio" id="ratiotime" name="outtime" value="3" onclick="$('#timebox').hide()"<?php if ($outtime==3) echo "checked"; ?>/>本年</label>
			    <label>
				    <input type="radio" id="ratiotime" name="outtime" value="4" onclick="$('#timebox').show()"<?php if ($outtime==4) echo "checked"; ?>/>自定义
			    </label>
		    <span style="display: <?php echo $startime||$endtime?'inline':'none';?>;" id="timebox">
			    <input id="start" type="text" value="<?php echo $start1; ?>" name="startime" required readonly class="laydate-icon">
				    -
			    <input id="end" type="text" value="<?php echo $end1; ?>" name="endtime" required readonly class="laydate-icon">
		    </span>
                <input type="hidden" name="excel" id="excel" value="0" />
                <input type="submit" value="搜索" class="sc-button" onclick="$('#excel').val(0);"/>
                <input type="submit" value="导出excel" class="sc-button" onclick="$('#excel').val(1);" />
			</form>
			<!--搜索-->
			</div> 
        </div>
	<div style="clear:both">
		
	<div class="H5-gameListScreen">
		<ul class="H5-gameOpt clearfix" style="min-height: 35px;"> 
			<li></li>
			<!--<li>转换率<i class="iconfont icon-sort-double-down"></i></li>-->
			<li>
				<div class="shaixuan clearfix" >
					<!-- <input  class="selectAll select-checks fl" name="check1" type="checkbox"> -->
					<?php if($id == 2){?>
						<a class="desc" href="<?php echo M_URL('Domain','wxlist','',GP("id-1")); ?>"><i class="desc-i"></i>ID</a>		
					<?php }else{ ?>
						<a class="desc" href="<?php echo M_URL('Domain','wxlist','',GP("id-2")); ?>"><i class="asc-i"></i>ID</a>
					<?php }?>
					<?php if($logintimes == 2){?>
						<a class="desc" href="?searchuser-1,logintimes-1"><i class="desc-i"></i>登陆次数</a>		
					<?php }else{ ?>
						<a class="desc" href="?searchuser-1,logintimes-2"><i class="asc-i"></i>登陆次数</a>
					<?php }?>
                    <?php if($lastlogintime == 2){?>
						<a class="desc" href="?searchuser-1,lastlogintime-1"><i class="desc-i"></i>最后登陆</a>		
					<?php }else{ ?>
						<a class="desc" href="?searchuser-1,lastlogintime-2"><i class="asc-i"></i>最后登陆</a>
					<?php }?>
					<?php if($adddate == 2){?>
						<a class="desc" href="?adddate-1"><i class="desc-i"></i>到期时间</a>		
					<?php }else{ ?>
						<a class="desc" href="?adddate-2"><i class="asc-i"></i>到期时间</a>	
					<?php }?>
					<?php if($sms == 2){?>
						<a class="desc" href="?sms-1"><i class="desc-i"></i>短信数量</a>		
					<?php }else{ ?>
						<a class="desc" href="?sms-2"><i class="asc-i"></i>短信数量</a>
					<?php }?>
					<?php if($sumsmsnum == 2){?>
						<a class="desc" href="<?php echo M_URL('Domain','wxlist','',GP("sumsmsnum-1")); ?>"><i class="desc-i"></i>短信总数量</a>		
					<?php }else{ ?>
						<a class="desc" href="<?php echo M_URL('Domain','wxlist','',GP("sumsmsnum-2")); ?>"><i class="asc-i"></i>短信总数量</a>
					<?php }?>
					<?php if($mail == 2){?>
						<a class="desc" href="<?php echo M_URL('Domain','wxlist','',GP("mail-1")); ?>"><i class="desc-i"></i>邮件数量</a>		
					<?php }else{ ?>
						<a class="desc" href="<?php echo M_URL('Domain','wxlist','',GP("mail-2")); ?>"><i class="asc-i"></i>邮件数量</a>	
					<?php }?>
					<?php if($sumemailnum == 2){?>
						<a class="desc" href="<?php echo M_URL('Domain','wxlist','',GP("sumemailnum-1")); ?>"><i class="desc-i"></i>邮件总数量</a>		
					<?php }else{ ?>
						<a class="desc" href="<?php echo M_URL('Domain','wxlist','',GP("sumemailnum-2")); ?>"><i class="asc-i"></i>邮件总数量</a>	
					<?php }?>
					<?php if($vodmoney == 2){?>
						<a class="desc" href="<?php echo M_URL('Domain','wxlist','',GP("vodmoney-1")); ?>"><i class="desc-i"></i>点播流量</a>		
					<?php }else{ ?>
						<a class="desc" href="<?php echo M_URL('Domain','wxlist','',GP("vodmoney-2")); ?>"><i class="asc-i"></i>点播流量</a>	
					<?php }?>
					<?php if($sumvodmoney == 2){?>
						<a class="desc" href="<?php echo M_URL('Domain','wxlist','',GP("sumvodmoney-1")); ?>"><i class="desc-i"></i>点播总流量</a>		
					<?php }else{ ?>
						<a class="desc" href="<?php echo M_URL('Domain','wxlist','',GP("sumvodmoney-2")); ?>"><i class="asc-i"></i>点播总流量</a>	
					<?php }?>
					<?php if($vodspace == 2){?>
						<a class="desc" href="<?php echo M_URL('Domain','wxlist','',GP("vodspace-1")); ?>"><i class="desc-i"></i>空间容量</a>		
					<?php }else{ ?>
						<a class="desc" href="<?php echo M_URL('Domain','wxlist','',GP("vodspace-2")); ?>"><i class="asc-i"></i>空间容量</a>	
					<?php }?>
					<?php if($sumvodspace == 2){?>
						<a class="desc" href="<?php echo M_URL('Domain','wxlist','',GP("sumvodspace-1")); ?>"><i class="desc-i"></i>空间总容量</a>		
					<?php }else{ ?>
						<a class="desc" href="<?php echo M_URL('Domain','wxlist','',GP("sumvodspace-2")); ?>"><i class="asc-i"></i>空间总容量</a>	
					<?php }?>
					<?php if($livemoney == 2){?>
						<a class="desc" href="<?php echo M_URL('Domain','wxlist','',GP("livemoney-1")); ?>"><i class="desc-i"></i>直播连麦币</a>		
					<?php }else{ ?>
						<a class="desc" href="<?php echo M_URL('Domain','wxlist','',GP("livemoney-2")); ?>"><i class="asc-i"></i>直播连麦币</a>	
					<?php }?>
					<?php if($sumlivemoney == 2){?>
						<a class="desc" href="<?php echo M_URL('Domain','wxlist','',GP("sumlivemoney-1")); ?>"><i class="desc-i"></i>直播总连麦币</a>		
					<?php }else{ ?>
						<a class="desc" href="<?php echo M_URL('Domain','wxlist','',GP("sumlivemoney-2")); ?>"><i class="asc-i"></i>直播总连麦币</a>	
					<?php }?>
						
				</div> 
			</li>
			<li class="gameScreen" style="position: absolute;right:0px;top:-6px;"><i class="iconfont icon-filter-2" style="float: none;"></i>&nbsp;&nbsp;筛选
				<ul class="H5-gameScreen">
					<img src="//ks.kesion.com/Public/app/images/regup.png" alt="">
					<li>
						<span>网校模式：</span>
						<div>
				<a href="<?php echo M_URL('Domain','wxlist','',GP("type-3")); ?>" class="<?php if($type ==3){ echo 'active';}?>">不限</a>
				<a href="<?php echo M_URL('Domain','wxlist','',GP("searchuser-1,type-2")); ?>" class="<?php if($type ==2){ echo 'active';}?>">机构</a>
				<a href="<?php echo M_URL('Domain','wxlist','',GP("searchuser-1,type-1")); ?>" class="<?php if($type ==1){ echo 'active';}?>">教师</a>
						</div>
					</li>
					<li>
						<span>注册来源：</span>
						<div>
							<a href="<?php echo M_URL('Domain','wxlist','',GP("befrom-0")); ?>" class="<?php if($befrom ==0){ echo 'active';}?>">不限</a>
							<a href="<?php echo M_URL('Domain','wxlist','',GP("befrom-1")); ?>" class="<?php if($befrom ==1){ echo 'active';}?>">PC端</a>
							<a href="<?php echo M_URL('Domain','wxlist','',GP("befrom-2")); ?>" class="<?php if($befrom ==2){ echo 'active';}?>">微信公众号</a>
							<a href="<?php echo M_URL('Domain','wxlist','',GP("befrom-3")); ?>" class="<?php if($befrom ==3){ echo 'active';}?>">V师名片</a>
						</div>
					</li>
					<li>
						<span>视频转码：</span>
						<div>
							<a href="<?php echo M_URL('Domain','wxlist','',GP("istranscode-0")); ?>" class="<?php if($istranscode ==0){ echo 'active';}?>">不限</a>
							<a href="<?php echo M_URL('Domain','wxlist','',GP("istranscode-1")); ?>" class="<?php if($istranscode ==1){ echo 'active';}?>">是</a>
							<a href="<?php echo M_URL('Domain','wxlist','',GP("istranscode-2")); ?>" class="<?php if($istranscode ==2){ echo 'active';}?>">否</a>
						</div>
					</li>
					<li>
						<span>营销模式：</span>
						<div>
				<a href="<?php echo M_URL('Domain','wxlist','',GP("status-3")); ?>" class="<?php if($status ==3){ echo 'active';}?>">不限</a>
				<a href="<?php echo M_URL('Domain','wxlist','',GP("status-2")); ?>" class="<?php if($status ==2){ echo 'active';}?>">已审核</a>
				<a href="<?php echo M_URL('Domain','wxlist','',GP("status-1")); ?>" class="<?php if($status ==1){ echo 'active';}?>">未审核</a>
						</div>
					</li>
					<li>
						<span>版本：</span>
						<div>
				<a href="<?php echo M_URL('Domain','wxlist','',GP("package-100")); ?>" class="<?php if($package ==100){ echo 'active';}?>">不限</a>
				<a href="<?php echo M_URL('Domain','wxlist','',GP("package-0")); ?>" class="<?php if($package ==0){ echo 'active';}?>">扶持版</a>
				<a href="<?php echo M_URL('Domain','wxlist','',GP("package-1")); ?>" class="<?php if($package ==1){ echo 'active';}?>">标准版</a>
				<a href="<?php echo M_URL('Domain','wxlist','',GP("package-2")); ?>" class="<?php if($package ==2){ echo 'active';}?>">高级版</a>
				<a href="<?php echo M_URL('Domain','wxlist','',GP("package-3")); ?>" class="<?php if($package ==3){ echo 'active';}?>">钻石版</a>
						</div>
					</li>		
					<li>
						<span>开通终端</span>
						<div>
				<a href="<?php echo M_URL('Domain','wxlist','',GP("wstatus-100")); ?>" class="<?php if($wstatus ==100){ echo 'active';}?>">不限</a>
				<a href="<?php echo M_URL('Domain','wxlist','',GP("wstatus-0")); ?>" class="<?php if($wstatus ==0){ echo 'active';}?>">关闭</a>
				<a href="<?php echo M_URL('Domain','wxlist','',GP("wstatus-1")); ?>" class="<?php if($wstatus ==1){ echo 'active';}?>">响应式</a>
				<a href="<?php echo M_URL('Domain','wxlist','',GP("wstatus-2")); ?>" class="<?php if($wstatus ==2){ echo 'active';}?>">公众号</a>
				<a href="<?php echo M_URL('Domain','wxlist','',GP("wstatus-3")); ?>" class="<?php if($wstatus ==3){ echo 'active';}?>">小程序</a>
						</div>
					</li>			
				</ul>
			</li>				
		</ul>	
	</div>
	<div class="H5-gameListConts" style="background: #fff;padding: 13px;">
		<form target="hidframe" id="myform" method="post" target="hidframe"  action="<?php echo M_URL('Domain','batch','',GP('p-'.$page->now_page)) ?>" class="form-horizontal" enctype="multipart/form-data">
              <table class="ks-table" style="background: #fff;">
                    <thead style="background: #cccccc9c;">
                        <tr>
                            <th>选择</th>
                            <th>机构ID</th>                           
                            <th style="display:none">机构LOGO</th>                           
                            <th style="text-align:left">机构信息</th>
                            <th>注册来源</th>
                            <th>用户名称</th>
                            <th>版本信息</th>
                            <th>注册信息</th>
                           <th >财富（可用/累计）</th>
                            <th>收入（未提现/已提现）</th>
                            <th>状态</th>
                            <th>业务员</th>
                            <th>操作</th>
                        </tr>
                    </thead>

                    <tbody>
                    	<?php foreach($values as $k =>$v){ ?>
                    	<tr>
						    <?php
                            $mydomain =wx_Url($v['wxid']);
                            $userinfo= User_GetUser($v['userid']);
                            ?>
                    		<td><input type="checkbox" class="select-checks" value="<?php echo $v['wxid'];?>" name='check[]'/></td>
                    		<td><a href='<?php echo $mydomain.'/?f=m';?>' title="预览手机版" target='_blank'><?php echo $v['wxid']; ?></a></td>
                    		<td style="display:none"><a href="<?php echo $mydomain;?>" target="_blank"><img style="display: inline-block;overflow: hidden;cursor: pointer;width: 79px;max-height: 63px;"  src="<?php if(empty($v['wilogo'])||strstr($v['wilogo'],'/Public/admin/images/login/logo.png')){echo '/Public/admin/images/login/wilogo.png';}else{echo Img($v['wilogo']);} ?>"></a></td>
                    		<td style="text-align: left;">
                                名称：<a href="<?php echo $mydomain;?>/?f=pc" title="浏览PC版" target="_blank"><?php echo $v['sitename'] ?></a><br/>
                                域名：<a href="<?php echo $mydomain;?>" target="_blank"><?php echo wx_Url($v['wxid']); ?></a>  <a onClick="addTypeChange('<?php echo M_URL('Domain','wxeditDomain',$v['wxid'],GP(''));?>','600px','300px',{title:'域名修改',type:'top'});"><i class="iconfont icon-bianji1 deepBlue" style="color: #0a9cf1;"></i></a>
                                <br/>学员：<a href="<?php echo M_URL('home/Users','','',GP('usertype-0,wxid-'.$v['wxid'],true));?>"><?php echo $common_user->getOne('count(userid)','where wxid='.$v['wxid'].' and usertype=0');?></a>位
                                <br/>是否转码：<?php echo wx_Domain_Field($v['wxid'],'istranscode')==1?'是':'否';?>
                            </td>
							<td><?php echo $befromArr[$v['befrom']]; ?></td>
                    		<td><a href="<?php echo $mydomain;?>" target="_blank"><?php echo $userinfo['username']; ?></a></td>
                    		
                    		<td style="text-align: left;"  nowrap>
                            版本：
                            <?php echo wx_version($v['wxid']); ?>
                            <br/>到期时间：<?php echo date('Y-m-d',$v['packendtime']);?>
                            <br/>独立收款： <?php
                                  $payToStoreAccount=checkIsOpenOwnerPay($v['wxid']);   //VIP  版本才可以使用独立收款插件
                                  if ($payToStoreAccount){
                                      echo "<span style='color:blue'>是</span>";
                                  }else{
                                      echo "否";
                                  }
                                       ?>
                            </td>
                    	
                            <td style="text-align: left;" nowrap>
                                登录次数：<a href="<?php echo M_URL('Domain','loginlog',$v['wxid'],GP('oldp-'.$now_page,true));?>"><?php echo $userinfo['logintimes'];?></a>
                                <br /><div title="注册时间：<?php echo KS_DATE($userinfo['regdate']); ?>">注册时间：<?php echo date('Y-m-d',$userinfo['regdate']);?></div>
                                <div>最后登录：<?php echo date('Y-m-d',$$userinfo['lastlogintime']);?></div>
                            </td>
                    		<td  style="text-align: left;" nowrap>
                            余额:￥<?php echo Field($v['money']); ?>/<?php echo Field($v['sunmoney']); ?><br />
                            点播流量：充：<a href='<?php echo M_URL('home/Domain','serviceRecord',4,GP('wxid-'.$v['wxid'])); ?>'><?php echo format_gt(getLimitService(3,0,$v['wxid'])/1024,2);?></i></a>/剩：<?php echo format_gt(getVodAvailableTraffic($v['wxid'])); ?> <br/>
                            空间容量剩：<?php echo format_gt(getAvailableSpace($v['wxid'])); ?> <br/>
                            短信：<i class="orange"><?php echo wx_Domain_Field($v['wxid'],'smsnum'); ?></i>/<?php echo wx_Domain_Field($v['wxid'],'sumsmsnum'); ?><br />
                            直播币：<i class="orange see1"><?php echo wx_Domain_Field($v['wxid'],'sumlivemoney'); ?></i>/<span class="see2"><?php echo number_format(getLimitService(6,0,$v['wxid']),2);?></span>

                            </td>
                    		<td>￥<?php echo Field($v['withdrawmoney']); ?>/<?php echo Field($v['withmoney']); ?></td>
                    		<td>
                    			<span class="link-switch<?php if($v["status"]==3||$v["status"]==2||$v["status"]==1){ echo ' open' ?><?php }  ?>" data-off="<?php echo M_URL('Domain','singChange',$v['wxid'],GP('p-'.$page->now_page.',status-0'));?>" data-open="<?php echo M_URL('Domain','singChange',$v['wxid'],GP('p-'.$page->now_page.',status-3')); ?>"><i></i></span>
                    		</td>
                    		<td>
                                <a onClick="addTypeChange('<?php echo M_URL('Domain','changeSalesMan',$v['wxid'],GP('p-'.$now_page)) ?>','530px','300px',{title:'修改业务员',type:'top'});" >
                    			<?php 
                                  echo Field($v['salesman']);
                                 ?>
                                </a>
                    		</td>
<td class="ks-head-el">
	<i onClick="choiceClick(this)" class="iconfont icon-more"></i>
	<div class="ks-head-content ks-head-content-pc" style="width: 113px!important;">
		<ul class="opeart">
            <?php if (checkAdminPower('Domain','changewxname')){?>
			<li>
				<a onClick="addTypeChange('<?php echo M_URL('Domain','changeWxName',$v['wxid'],GP('p-'.$now_page)) ?>','530px','300px',{title:'修改机构名称',type:'top'});" >修改名称</a>
			</li>
            <?php
             }?>
             <?php if (checkAdminPower('Domain','Service')){?>
			<li ><a href="<?php echo M_URL('Domain','Service',$v['wxid'],GP('sitename-'.$v['sitename']));?>">升级服务</a></li>
             <?php
              }?>
            <?php if (checkAdminPower('Domain','wxrecharge')){?>
			<li><a href="<?php echo M_URL('Domain','wxrecharge',$v['wxid'],GP(''));?>">扩容服务</a></li>
             <?php
                  }?>

            <?php if (checkAdminPower('Domain','setexpiretime') && $v['package']!='v0'){?>
			<li>
				<a onClick="addTypeChange('<?php echo M_URL('Domain','setExpireTime',$v['wxid'],GP('p-'.$now_page)) ?>','530px','300px',{title:'设置过期时间',type:'top'});" >过期时间</a>
			</li>
            <?php
       }?>

			<!--<li><a href="<?php echo M_URL('Domain','padsetting',$v['wxid'],GP('sitename-'.$v['sitename']));?>">Pad设置</a></li>
			<li><a href="https://<?php echo $v['domain']; ?>" target="_blank" >预览网校</a></li>-->
			<li ><a href="<?php echo M_URL('Users','dorealwx',$v['wxid'],GP(''));?>">认证材料</a></li>
             <?php if (checkAdminPower('domain','wxDetail')){?>
			<li ><a href="<?php echo M_URL('Domain','wxDetail',$v['wxid'],GP('ids-'.$v['id'].',p-'.$page->now_page));?>">详细信息</a></li>
            <?php } ?>
            <?php if (checkAdminPower('domain','wxpersonal')){?>
			<li ><a href="<?php echo M_URL('Domain','wxpersonal',$v['userid'],GP('usertype-2,urltype-1'));?>">负责人资料</a></li>
            <?php } ?>
			<?php if (checkAdminPower('domain','liveconfig')){?>
            <li style="border: none;"><a onclick="addTypeChange('<?php echo M_URL('Domain','liveConfig',$v['wxid'],GP('')); ?>','850px','480px',{type:'top',title:'直播配置'}); " >直播配置</a></li>
			<?php }?>
			<?php if (checkAdminPower('domain','vodconfig')){?>
				<li style="border: none;"><a onclick="addTypeChange('<?php echo M_URL('Domain','vodConfig',$v['wxid'],GP('')); ?>','850px','480px',{type:'top',title:'点播配置'}); " >点播配置</a></li>
			<?php }?>
            <?php if (checkAdminPower('domain','confirmdel')){?>
            <li style="border: none;"><a onClick="addTypeChange('<?php echo M_URL('Domain','confirmdel',$v['wxid'],GP('')) ?>','300px','150px',{title:'重置密码',type:'top'})">重置密码</a></li>
			<?php }?>

             <?php if (checkAdminPower('domain','loginhome')){?>
            <li style="border: none;"><a  href="<?php echo M_URL('Domain','loginHome',$v['wxid'],GP('')) ?>" target="_blank" >进入机构端</a></li>
			<?php }?>

            <?php if (checkAdminPower('Users','deleteUserswx')){?>
            <li style="border: none;"><a  onclick="Confirm('是否删除此店铺','<?php echo M_URL('Users','deleteUserswx',$v['userid'],GP('wxid-'.$v['wxid']));?>');" >网校删除</a></li>
			<?php }?>
          

        </ul>
	</div>
</td>
                    	</tr>
                    <?php }?>
                    </tbody>
                </table>
		<?php echo NoC($values);?>
		</div>
	<div>
	</div>
	</div>
	<br />	
	<br />	
	<br />	
	<br />

    <div id="choiceWindow">
        <label id="x" style="position: absolute;top:2px;left: 95%;font-size: 25px;">x</label>
        <label>短信内容：<textarea style="width: 350px;height: 100px;" name="sms_content"></textarea></label>
        <button style="margin-left: 120px" class="btn mt10 btn-default fl" onClick="do_reg();" name="batch" value="4">批量发送短信</button>
    </div>
    <div id="backGround">
    </div>
    <!--公众号弹窗-->
    <div id="choiceWindow1">
        <label id="x1" style="position: absolute;top:2px;left: 95%;font-size: 25px;">x</label>
        <label style="font-size:16px;color: #3a3d40;line-height: 70px;">具体内容：<input style="height: 31px;width: 330px;" type="text" name="p_content"/></label>
        <label style="font-size:16px;color: #3a3d40;line-height: 70px;">备&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;注：<input style="height: 31px;width: 330px;" type="text" name="p_remark"/></label>
        <button style="margin-left: 120px" class="btn mt10 btn-default fl" onClick="do_reg();" name="batch" value="5">批量发送公众号模板消息</button>
    </div>
    <div id="backGround1">
    </div>

</div>
<div class="footer-page h60">
    <div class="col-sm-7  labes">
     <div class="checkbox fl checkbox-info" style="margin-top:20px;margin-right:10px">
     		<input  class="selectAll select-checks" name="check1" type="checkbox" id="sAll">
            <label for="sAll">全选 </label>
        </div>
        <button class="btn mt10 btn-default fl" onClick="do_reg();" name="batch" value="2">批量审核</button>
        <button class="btn mt10 btn-default fl" onClick="do_reg();" name="batch" value="3">取消审核</button>
        <button class="btn mt10 btn-default fl" id="btn">批量发送短信</button>
        <button class="btn mt10 btn-default fl" id="btn1">批量发送公众号模板消息</button>
		</form>
       
    </div>
    <div class="col-sm-5 " style="margin-top:7px"><?php echo $page->show(3); ?></div>

</body>

</html>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script src="<?php echo UOOT;?>Public/common/js/backstage.js"></script>
<script>
    //弹窗 短信和公众号模板
    $(document).ready(function() {
        $("#btn").click(function() {
            $("#choiceWindow").slideDown(300);
            $("#backGround").show();

        });

        $("#x").click(function() {
            $("#choiceWindow").slideUp(300);
            $("#backGround").hide();
        })

    });
    $(document).ready(function() {
        $("#btn1").click(function() {
            $("#choiceWindow1").slideDown(300);
            $("#backGround1").show();

        });
        $("#x1").click(function() {
            $("#choiceWindow1").slideUp(300);
            $("#backGround1").hide();
        })

    });

	var start = {
		elem: '#start',
		format: 'YYYY/MM/DD hh:mm:ss',
		//min: laydate.now(), //设定最小日期为当前日期
		max: '2099-06-16 23:59:59', //最大日期
		istime: true,
		istoday: false,
		choose: function(datas){
			end.min = datas; //开始日选好后，重置结束日的最小日期
			end.start = datas //将结束日的初始值设定为开始日
		}
	};
	var end = {
		elem: '#end',
		format: 'YYYY/MM/DD hh:mm:ss',
		min: laydate.now(),
		max: '2099-06-16 23:59:59',
		istime: true,
		istoday: false,

	};
	laydate(start);
	laydate(end);
	$('.link-switch').each(function(){
        setLinkSwitch(this)
    })
    function do_reg(){
	   $("#myform").submit();	
    }
  	function float2(e){
   	 	$(e).each(function(){
     		var see = $(this).html()*1
	   	 	if(see>1000){
	    		see=see/10000;
	    		if(see>1000){
	    			see=see/10000;
	    			see=Math.floor(see * 100) / 100;
	    			see = see+"亿"
	    		}else{
	    			see=Math.floor(see * 100) / 100;
	    			see = see+"万"
	    		}
	    	}
	    	$(this).html(see);
     	})
   };float2(".see1");float2(".see2");


  

</script>