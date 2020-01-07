<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>查看用户详情</title>
<link href="<?php echo UOOT;?>Public/admin/fonts/iconfont.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
<style>
	.ks-txtLeft h3{height: 20px;line-height: 20px;margin-bottom: 10px;}
	.ml50{margin-left: 50px!important;}
	.check-crb{padding: 30px;text-align: center;}
	.check-empty{text-align: center;font-size: 16px;color:#333;margin-bottom: 20px;}
	.check-icon {display: inline-block;width: 45px;height: 45px;border-radius: 50%;background: red;vertical-align: middle;text-align: center;line-height: 45px;margin-bottom: 10px;}
	.check-icon i{font-size: 24px;color: #fff;}
	.detail {position: relative;}
	.ks-view-tab {position: absolute;right: 0;top: -10px;}
	.switch i {padding-left: 0!important;}
	.icon-nv {font-size: 18px; color: #e74881;font-weight:bold;}
	.icon-nan {font-size: 18px;color: #1ca8ca;font-weight:bold;}
	.ks-wrap {
    padding: 25px;
    position: relative;
    overflow-y: auto;
    background: #eef2f5;
}
.ks-head-nav {
    font-size: 14px;
    color: #666;
    height: 36px;
    line-height: 16px;
    border-bottom: 1px solid #eee;
}
.ks-wbox {
    padding: 25px;
    background: #fff;
        border-radius: 10px;
}
.ks-first {
    height: 34px;
    line-height: 34px;
}
.ks-cimg {
	    display: block;
    width: 120px;
    height: 90px;
    border-radius: 10px;
    overflow: hidden;
    margin-right: 20px;
    margin-top: 10px;
}
.ks-cimg img {
    border-radius: 10px;
    display: inline-block;
    width: 100%;
    min-height: 90px;
}
.fl {
    float: left;
}
.ks-ctxt, .ks-txtLeft {
    width: 20%;
}
.ks-cbox span, .ks-ctxt p, .ks-txtLeft p {
    color: #666;
    font-size: 14px;
    margin: 5px 30px 5px 0;
}
.mt20 {
    margin-top: 20px !important;
}

/*.norecord, .empty, .emptycss {
    text-align: center;
    padding: 180px 0px 40px 0px;
    color: #ccc;
    font-size: 14px;
    background: url(../images/empty.png) no-repeat 50% 40px;
}*/
.ks-cbox span, .ks-ctxt p, .ks-txtLeft p {
    color: #666;
    font-size: 14px;
    margin: 5px 30px 5px 0;
}
.switch {
    width: 46px;
    height: 28px;
    background: #d2d2d2;
    border-radius: 50px;
    position: relative;
    cursor: pointer;
    -webkit-transition: 0.3s;
    transition: 0.3s;
    float: left;
}
.switch-on {
    background: #44d58e;
}
.fanhui{
	    padding: 15px 55px 15px 55px;
    background: #da4f0c;
    border: solid 1px #da4f0c;
    color: white;
    margin-left: 46%;
    border-radius: 8px;
}
</style>
</head>
<body class="ks-wrap" style="opacity: 1;">



	

	<div class="bRadius10 bg-white ks-wbox">
		<div class="ks-head-nav ks-head-only-nav" style="margin-bottom: 20px;">
		<!--标题-->
		<a href="javascript:history.go(-1);">学员管理</a><span> <em>/</em> 学员详情
		<!--标题-->
	    </div>
		<div class="ks-clist">
			<ul class="clearfix">
	    		<li>
	    			<div class="ks-cbox clearfix">
	    				<h3 class="ks-first">基本信息</h3>
	    				<div class="ks-cimg fl clearfix">
	    				
	    			   <img src="<?php echo $this->upload->getHead($id);?>">
	    			</div>
	    			  <div class="ks-txtLbox">	
	    				<div class="fl ks-txtLeft">
	        				<p><?php echo Field($userinfo2['name']);?>
	        			<?php if($userinfo['usertype']==1){ if($userinfo2['Sex']==2){?><i class="iconfont icon-nan nv" style="color:pink;"></i><?php }else{?><i class="iconfont icon-nan nan" style="color:blue;"></i> <?php }}?></p>
	        				<p>联系电话：<?php echo Field($userinfo['mobile']);?></p>
	        				<?php if($userinfo['usertype']==1){?>
	        				<p>英文名：<?php echo Field($userinfo2['ename']);?></p>
	        			<?php }?>
	        			<?php if($userinfo['usertype']==1){?>
	    					<p class="small-txt">教师简介：<?php echo Field($userinfo2['shortIntro']);?></p>
	    					<?php }else{?>
	    					<p class="small-txt">所在地区：<?php echo Field($userinfo2['taddress']);?></p>
	    					<?php }?>
	    				</div>
	    				<div class="ks-ctxt fl">
	    				<p style="height: 24.5px;"></p>
							<p>电子邮件：<?php echo Field($userinfo['email']);?></p>
							<?php if($userinfo['usertype']==1){?>
	    					<p>职称:<?php echo Field($userinfo2['teacherzc']);?></p>
	    					<?php }?>
	    				</div>
	    				<div class="ks-ctxt fl">
	    					<p style="height: 24.5px;"></p>
	    					<p>注册日期：<?php echo Field(date('Y-m-d',$userinfo['regdate']));?></p>
	    					<?php if($userinfo['usertype']==1){?>
	    					<p class="small-txt">所在地区：<?php echo Field($userinfo2['taddress']);?></p>
	    					<?php }?>
	    				</div>
	    				<div class="ks-ctxt fl">
	    					<p style="height: 24.5px;"></p>
	    					<?php if($userinfo['usertype']==1){?>
	    					<p>性别：<?php if($userinfo2['Sex']==1){?>男<?php }else{?>女<?php }?></p>
	    					<?php }?>
	    					<p class="small-txt"></p>
	    				</div>
	    			</div>
	    			</div>
	   		   </li>
			</ul>
		</div>
	</div>

	<div class="bRadius10 bg-white ks-wbox mt20" >
				<div class="ks-clist">
					<ul class="clearfix">
						<li>
		            	<div class="ks-cbox clearfix">
							<h3 class="ks-first">其他信息</h3>
									  <div class="ks-txtLbox">	
			        				<div class="fl ks-txtLeft">
				        				<p>账号信息：<?php echo Field($userinfo['username']);?></p>
				        				<p>最近登录时间：<?php echo date('Y-m-d H:i:s',$userinfo['lastlogintime']);?></p>
				        				<?php if($userinfo['usertype']==1){?>
				        				<p>详细信息：<?php echo Field($userinfo2['teacherIntro']);?></p>
				        				<?php }?>
			        				</div>
			        				<div class="ks-ctxt fl">
										<p>账户余额：￥<?php echo Field($userinfo['money']);?>&nbsp;&nbsp;<a href="javascript:void(0);" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','recharge',$id,GP('skip-1')); ?>','430px','610px ',{title:'学员充值',type:'top'})" style="color: red;">充值</a></p>
			        					<p>登录次数：<?php echo Field($userinfo['logintimes']);?></p>
			        					
			        				</div>
			        				<div class="ks-ctxt fl">
			        					
			        					<p>
								        	<div class="fr">
												<span class="name-nowrap fl fsize14 hLh30 mr10">是否展示前台</span>
												<span class="fl">
												<div class="form-switch" open-value="1">
													<span class="link-switch<?php if($userinfo['status'] ==1){ echo ' open'; } ?>" data-off="<?php echo M_URL('Users','updatestatus',$userinfo['userid'],GP('')); ?>" data-open="<?php echo M_URL('Users','updatestatus',$userinfo['userid'],GP('')); ?>"><i></i></span>
												</div>
												</span>
											</div>
			        					</p>
			        					<p class="small-txt"></p>
			        				</div>
			        			</div>
						</div>
				        </li>
					</ul>
				</div>
	</div>
    <div class="bRadius10 bg-white ks-wbox mt20" >
		<div class="ks-clist">
			<a class="fanhui" href="javascript:history.go(-1);">返回</a>
		</div>
	</div>
	 	

<script src="<?php echo UOOT;?>Public/common/js/nicescroll.js"></script>
<!-- <script src="<?php echo UOOT;?>Public/common/js/common.js"></script> -->
<!-- <script src="<?php echo UOOT;?>Public/common/js/backstage.js"></script> -->
<script type="text/javascript">
	$('.link-switch').each(function(){
        setLinkSwitch(this)
    })

function setLinkSwitch(target){
	$(target).click(function(){
		var _href;
		this.className.indexOf('open') === -1 ? (
			_href = $(this).attr('data-open'),
			$(this).addClass('open')
		) : (
			_href = $(this).attr('data-off'),
			$(this).removeClass('open')
		);
		request(_href,function(data){
			
		})
	})
};
function request(__url,callBack,__dataType){
	$.ajax({
		type:"get",
		dataType:__dataType,
		url:__url,
		success:function(data){
			data = data.responseText || data;
			//创建回调函数
			typeof callBack === 'function' ? callBack(data) : ''
				
		},
		error:function(_error){
			_error = _error.responseText || _error;
			//创建回调函数
			typeof callBack === 'function' ? callBack(_error) : ''
			
		}
	})
}
</script>


</body>
</html>

