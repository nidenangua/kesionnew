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
		<a href="javascript:history.go(-1);">机构信息</a><span> <em>/</em> 
		<!--标题-->
	    </div>
		<div class="ks-clist">
			<ul class="clearfix">
	    		<li>
	    			<div class="ks-cbox clearfix">
	    				<h3 class="ks-first">基本信息</h3>
	    				<div class="ks-cimg fl clearfix">
	    				
	    			   <img src="<?php if(strstr(Img($websiteInfo['logo']),'{img:')==false){echo Img($websiteInfo['logo']);}else{echo '/Public/admin/images/login/logo.png';} ?>">

                        
                        </div>
	    			  <div class="ks-txtLbox">	
	    				<div class="fl ks-txtLeft">

	        				<p><?php echo Field($websiteInfo['sitename']);?></p>
	        				<p>收款方式：<?php if($info['setting'][1] == 0){ echo  '平台收取';}elseif($info['setting'][1] == 1){ echo '用户收取';}else{ echo '用户未开通该功能';} ?>
     <!--<a style="color: blue;" onclick="addTypeChange('<?php echo M_URL('Domain','wxpayment',$info['wxid'],GP(''));?>','800px','400px',{title:'支付方式更改',type:'top'});"> <i class="iconfont icon-bianji1 deepBlue"></i></a> -->
        
</p>
	    					<p class="small-txt">地址：<?php echo Field($websiteInfo['address']);?></p>
	    				     <p>网站介绍：<?php echo Field($websiteInfo['intro']);?></p>
	    				</div>
	    				<div class="ks-ctxt fl">
	    				<p style="height: 24.5px;"></p>
							<p>传真：<?php echo Field($websiteInfo['fax']);?></p>
	    					<p>邮箱:<?php echo Field($websiteInfo['workemail']);?></p>
	    				</div>
	    				<div class="ks-ctxt fl" style="    width: 28%;">
	    					<p style="height: 24.5px;"></p>
	    					<p>注册日期：<?php echo Field(date('Y-m-d',$userInfo['regdate']));?></p>
	    					<p class="small-txt">联系人以及电话：
                            <?php echo str_replace("$","，",$websiteInfo['contacts']);?>
                            <?php
                            
                            $mobile=User_GetUser($websiteInfo['userid'])['mobile'];
                            echo $mobile;
                            echo Field($websiteInfo['tel']);?>
                            </p>
	    				</div>
                         
                          
                          <img src="<?php echo UOOT.'Images/QRcode/'.createQRcode(ROOT.'Images/QRcode/',wx_Url($info['wxid']),'L',4,'weimenhu');?>" style='margin-left: 334px;' />

	    			</div>
	    			</div>
	   		   </li>
			</ul>
		</div>
	</div>


    <div class="bRadius10 bg-white ks-wbox mt20">
        <div class="ks-clist">
            <ul class="clearfix">
                <li>
                    <div class="ks-cbox clearfix">
                        <h3 class="ks-first">容量信息</h3>
                        <div class="ks-txtLbox">


                            <div class="fl ks-txtLeft">
                                <p>
                                    短信条数：<i class="orange"><?php echo Field($info['smsnum']); ?></i>/<?php echo Field($info['sumsmsnum']); ?>
                                </p>
                            </div>
                                	
			<div class="fl ks-txtLeft">
                                <p>邮件条数：<i class="orange"><?php echo Field($info['emailnum']); ?></i>/<?php echo Field($info['sumemailnum']); ?></p>
                            </div>
			<div class="fl ks-txtLeft">
                                <p>点播流量：<i class="orange">充：<a href='<?php echo M_URL('home/Domain','serviceRecord',4,GP('wxid-'.$info['wxid'])); ?>'><?php echo number_format(getLimitService(3,0,$info['wxid'])/1024,2);?></i>G</a>/剩：<?php echo getVodAvailableTraffic($info['wxid']); ?>G</p>
                            </div>
			<div class="fl ks-txtLeft">
                                <p>空间容量：<i class="orange">充：<?php echo number_format(getLimitService(5,0,$info['wxid'])/1024,2); ?></i>G/剩：<?php echo getAvailableSpace($info['wxid']); ?>G</p>
                            </div>
			<!--<div class="fl ks-txtLeft">
                                <p>直播并发：<i class="orange"><?php echo Field($info['concurrent']); ?></i>/<span><?php echo Field($info['sumconcurrent']); ?></span></p>
                            </div>-->
			<div class="fl ks-txtLeft">
                                <p>直播币：<i class="orange see1"><?php echo Field($info['sumlivemoney']); ?></i>/<span class="see2"><?php echo number_format(getLimitService(6,0,$info['wxid']),2);?></span></p>
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
							<h3 class="ks-first">课程信息</h3>
									  <div class="ks-txtLbox">	
			        				
			        				<div class="fl ks-txtLeft">
				        				<p>课程数量：<?php echo Field($coursecount);?></p>
				        			
				        				
				        				<p class="small-txt"></p>
				        				
			        				</div>
			        				<div class="ks-ctxt fl">
										<p>互动课堂数量：<?php echo Field($classcount);?></p>
			        					
			        					
			        				</div>
			        				<div class="ks-ctxt fl">
			        					<p>试卷数量：<?php echo Field($papercount);?></p>
			        					<p></p>
			        					<p class="small-txt"></p>
			        				</div>
			        				<div class="fl ks-txtLeft">
				        			
				        				<p>教师数量：<?php echo Field($teachercount);?></p>
				        				
				        				<p class="small-txt"></p>
				        				
			        				</div>
			        				<div class="ks-ctxt fl">
										
			        					<p>学员数量：<?php echo Field($studengcount);?></p>
			        					
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
							<h3 class="ks-first">负责人信息</h3>
									  <div class="ks-txtLbox">	
			        				<div class="fl ks-txtLeft">
				        				<p>账号信息：<?php echo Field($userInfo['username']);?></p>
				        				<p>最近登录时间：<?php echo date('Y-m-d H:i:s',$userInfo['lastlogintime']);?></p>
				        				
			        				</div>
			        				<div class="ks-ctxt fl">
										<p>账户余额：￥<?php echo Field($userInfo['money']);?>&nbsp;&nbsp;
											<!-- <a href="javascript:void(0);" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','recharge',$id,GP('skip-1')); ?>','430px','610px ',{title:'学员充值',type:'top'})" style="color: red;">充值</a> -->
										</p>
			        					<p>登录次数：<?php echo Field($userInfo['logintimes']);?></p>
			        					
			        				</div>
			        				<div class="ks-ctxt fl">
			        					
			        					<p>实名：<?php echo Field($userInfo['realname']);?></p>
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

