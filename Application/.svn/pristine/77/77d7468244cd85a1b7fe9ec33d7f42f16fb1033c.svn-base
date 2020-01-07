<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>任务中心</title>
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />

<style type="text/css">
	.pt{
		color:#e5412c;
		display: inline-block;
		border: #e5412c 1px solid; 
		padding-left: 5px;
		padding-right: 5px;
		border-radius: 5px;
	}
 .mission_list_wrap {
    top: 90px;
    bottom: 0;
    left: 20px;
    right: 20px;
    overflow-y: auto;
    padding-top: 38px;

}
 .mission_list_wrap .mission_list_ul li {
    float: left;
    width: 97%;
    border: 1px solid #f0f0f0;
    padding: 10px 25px 15px;
    margin-bottom: 15px;
    -webkit-box-shadow: 0 1px 2px rgba(0,0,0,0.05);
    -moz-box-shadow: 0 1px 2px rgba(0,0,0,0.05);
    box-shadow: 0 1px 2px rgba(0,0,0,0.05);
    position: relative;
}
 .li_title {
    margin: 0;
    height: 40px;
    line-height: 40px;
    font-size: 16px;
    color: #333;
}
.li_des {
    height: 32px;
    line-height: 32px;
}
.li_btn_wrap {
    position: absolute;
    right: 10px;
    bottom: 0;
    height: 85px;
    -webkit-display: flex;
    display: flex;
    -webkit-align-items: center;
    align-items: center;
}
.li_btn {
    background: #0096ed;
    color: #fff;
    display: inline-block;
    padding: 0;
    font-size: 13px;
    text-align: center;
    white-space: nowrap;
    cursor: pointer;
    border: 1px solid transparent;
    border-radius: 2px;
    height: 32px;
    line-height: 32px;
    width: 80px;
    margin-right: 18px;
}
 .li_btn.disabled {
    background: #f8f8f8;
    border: 1px solid #ebebeb;
    color: #b2a9a9;
    cursor: no-drop;
}
 .li_btn.white {
    background: #fff;
    border: 1px solid #e0e0e0;
    color: #373737;
}
.li_des{
	    position: absolute;
    bottom: 25px;
}
.li_des i {
    font-style: normal;
    color: #fc5150;
    margin-right: 4px;
    font-size: 13px;
}
.li_des1 div,span{
	float: left;
}
.li_des1{
	    width: 100%;
    min-height: 34px;

}
.ng-scope{
	    padding-bottom: 58px!important;
}
a:hover{
	color: white;
}
</style>
</head>
<body class="ks-wrap"> 
	       <!--end-->
		   <form target="hidframe"  action="" method="post" id="myform">
		   	
		   	<div class="ks-wbox bRadius10">
		   		 <!--header-->
				 <div class="ks-head-box">
				 		<h3 class="ks-head-title2">任务中心
						<div class="fr">	
						<a class="ks-setting-icon fl ml10" target="_blank"  href="<?php echo MY_FULLDOMAIN;?>/home/help#anchor114"><i class="iconfont icon-qm" ></i></a>											
						</div>		
						<div class="fr" style="margin-top: 6px;">
								可用的奖励总额：￥<?php echo $allye;?>
						</div>
						</h3>
				 </div>
				 <!--header-->
				 <!--tab-->
				<div class="ks-head-tab">
					<ul class="clearfix">
						<li <?php if(ACTION=='index'){echo 'class="curr"';}?>><a href="<?php echo M_URL('Taskhome','index'); ?>">我的任务</a></li>
						<li <?php if(ACTION=='reward'){echo 'class="curr"';}?>><a href="<?php echo M_URL('Taskhome','reward');?>">任务奖励</a></li>
						
					</ul>
				</div>

			    <!--/tab-->
			    <div class="mission_list_wrap">
			    	<ul class="mission_list_ul">
			    		<?php foreach($values as $k=>$v){ ?>
				    	<li ng-repeat="item in mission_list" class="ng-scope">
									<p class="li_title ng-binding"><?php echo $v['name']; ?></p>
									<div class="li_des1">
										<span>
											条件：
										</span>
										<div class="ng-binding"><?php echo $v['content']; ?></div>
									</div>
									<div class="li_des task_jl">
										<span>奖励：</span>
										<span class="ng-binding">
											<?php if($v['rewardway']==1){?>
											    <i class="ng-binding">+<?php echo $v['money']; ?></i>余额
											<?php }else{ ?>
												<i class="ng-binding">+（<?php echo $v['minmoney']; ?>  -  <?php echo $v['maxmoney']; ?>）</i>余额
											<?php }?>  
										</span>
									</div>
									<div class="li_btn_wrap">
											<a class="li_btn"  title="领取任务" href="<?php echo M_URL('Taskhome','receive',$v['id']); ?>">领取任务</a>
											<?php if($v['link']){?>
											<a class="li_btn"  title="查看攻略" href="<?php echo $v['link'] ?>" target ="_blank" style="    background: #6d686b;">查看攻略</a>
										<?php }?>
									</div>
								</li>
							<?php }?>
							<?php foreach($wcvalues as $k=>$v){ ?>
				    	<li ng-repeat="item in mission_list" class="ng-scope">
									<p class="li_title ng-binding"><?php echo $v['name']; ?></p>
									<div class="li_des1">
										<span>
											条件：
										</span>
										<div class="ng-binding"><?php echo $v['content']; ?></div>
									</div>
									<div class="li_des task_jl">
										<span>奖励：</span>
										<span class="ng-binding">
											<?php if($v['rewardway']==1){?>
											    <i class="ng-binding">+<?php echo $v['money']; ?></i>余额
											<?php }else{ ?>
												<i class="ng-binding">+（<?php echo $v['minmoney']; ?>  -  <?php echo $v['maxmoney']; ?>）</i>余额
											<?php }?>
										</span>
									</div>
									<div class="li_btn_wrap">
											<span class="li_btn  disabled"  title=""><?php if($v['complete']==1){echo '已完成';}else{echo '未完成';}?></span>
											<?php if($v['link']){?>
											<a class="li_btn"  title="查看攻略" href="<?php echo $v['link'] ?>" style="    background: #6d686b;">查看攻略</a>
										<?php }?>
										<?php if($v['jumpurl']){?>
											<a class="li_btn"  title="去完成" href="<?php echo $v['jumpurl'] ?>" style="    background: #32ad23;">去完成</a>
										<?php }?>
									</div>
								</li>
							<?php }?>
				   </ul>
			    </div>
			</form>
		</div>

	
	<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
	
	module.require(['$','backstage','nicescroll'],function(){
		
		loadScorllJs()
		
	})
	

function updatesStatus(id){
  var url = '<?php echo UOOT;?>Plus/Kesion.ajax.php?act=question';      
  $.ajax({
			type:"get",
			url:url,
			data:{id:id},
			success:function(data,textStatus){
				$("#a"+id).html(data);
			},
			error:function(){
				alert("发生了错误,请检查!");
			}
   })
}
function submitform(type){
	$('#batch1').val(type);
	$('#myform').submit();
}	
   function confirmpop(res) {
		var res = res.split('|');

		var contentHtml ='<div style="text-align:center;padding:20px;font-size:16px">微信号：'+res[0]+'手机号:'+res[1]+'</div>'+
						 '<div class="app-footer clearfix"><div style="text-align:center"><div class="ks-bt bt-pue mr10" onclick=top.closePopup("all") style="float:none;display:inline-block">确定</div>'+
						 '</div></div>'	

			top.popup.open(false,{
			title:'个人信息',
			area:['440px','400px'],
			heightAuto:true,
			content:contentHtml
		});
}

</script>
</body>
</html>