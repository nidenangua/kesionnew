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
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<style>
	.ks-txtLeft h3{height: 20px;line-height: 20px;margin-bottom: 10px;}
	.ks-first {margin-left: -15px;padding-left: 13px;}
	.ml50{margin-left: 50px!important;}
	.check-crb{padding: 30px;text-align: center;}
	.check-empty{text-align: center;font-size: 16px;color:#333;margin-bottom: 20px;}
	.check-icon {display: inline-block;width: 45px;height: 45px;border-radius: 50%;background: red;vertical-align: middle;text-align: center;line-height: 45px;margin-bottom: 10px;}
	.check-icon i{font-size: 24px;color: #fff;}
	.select-dropdown li{
		float: left;
	}
	.class-opeart li{display: inline-block;margin-right: 20px;padding: 0;text-align: left;font-size: 16px;}
</style>
</head>
<body class="ks-wrap">


<div class=" ks-wbox bRadius10 clearfix">
	<div class="ks-head-nav ks-head-only-nav" style="margin-bottom: 20px;">
		<!--标题-->
		<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP(''));?>">意向本</a><span> <em>/</em> 咨询人详情</span>
	</div>
	
	<div class="ks-clist">
		
		
		<ul class="clearfix">
    		<li>
    			<div class="ks-cbox clearfix">
    				<h3 class="ks-first mb20">基本信息</h3>
    				
    			  <div class="ks-txtLbox">	
    				<div class="fl ks-txtLeft">
        				<p><?php echo Field($userinfo2['membername']);?>
        			<?php if($userinfo2['sex']==2){?><i class="iconfont icon-nv"></i><?php }else{?><i class="iconfont icon-nan"></i><?php }?></p>
        				<p>联系电话：<?php echo Field($userinfo2['mobile']);?></p>
        				<p>紧急联系人：<?php echo Field($userinfo2['emergency']);?></p>
    				</div>
    				<div class="ks-ctxt fl">
    				<p>性别：<?php if($userinfo2['sex']==1){?>男<?php }else{?>女<?php }?></p>
						<p>电子邮件：<?php echo Field($userinfo2['email']);?></p>
    					<p>紧急联系人电话：<?php echo Field($userinfo2['emergencymobile']);?></p>
    					
    				</div>
    				<div class="fl ks-txtLeft">
    					<p style="height: 24.5px;"></p>
			        				<p>来源渠道：<?php echo $userinfo2['channel'] ?></p>
			        				<p>主动联系：<?php if($userinfo2['active']==1){echo '是';}else{echo '否';}?></p>
			        				
		        				</div>
    				<div class="ks-ctxt fl">
    					<p style="height: 24.5px;"></p>
    					<p>微信：<?php echo Field($userinfo2['wxnumber']);?></p>
    					<p class="small-txt">所在地区：<?php 
    						if($userinfo2['counid']){
								echo $userinfo2['pid'].'省'.$userinfo2['cid'].'市'.$userinfo2['counid'];
								
							}else{
								echo '暂无';
							}
    						?></p>
    				</div>
    			</div>
    			</div>
   		   </li>
		</ul>
	</div>
</div>
<div class=" mt20 ks-wbox bRadius10 clearfix">
			<div class="ks-clist">
				<ul class="clearfix">
					<li>
	            	<div class="ks-cbox clearfix">
						<h3 class="ks-first mb20">咨询信息</h3>
								  <div class="ks-txtLbox">	
		        				<div class="fl ks-txtLeft">
			        				<p>咨询类别： <?php if($userinfo2['classify']==1){echo '小班';}elseif($userinfo2['classify']==2){echo '一对一';}elseif($userinfo2['classify']==3){echo '大班';}?></p>
			        				
			        				<p>班级/课程名称： <?php echo $userinfo2['coursename']; ?></p>
			        				
		        				</div>
		        				<div class="ks-ctxt fl">
		        					<p style="height: 24.5px;"> 跟进状态：	<?php  if($userinfo2['status']==0){echo '未跟进';}elseif($userinfo2['status']==1){echo '跟进中';}elseif($userinfo2['status']==3){echo '已成单';} ?></p>
									<p>意向度：	<?php  if($userinfo2['intentionality']==0){echo '无';}elseif($userinfo2['intentionality']==1){echo '高';}elseif($userinfo2['intentionality']==2){echo '低';}elseif($userinfo2['intentionality']==3){echo '中';} ?></p>
		        					
		        					
		        				</div>
		        				<div class="ks-ctxt fl">
		        					<p>咨询校区：<?php echo $userinfo2['schoolroomid']; ?></p>
		        					<p>咨询老师：<?php echo $userinfo2['teachername'];?></p>
		        					
		        				</div>
		        				<div class="ks-ctxt fl">
		        					<p>咨询类型：<?php if($userinfo2['type']==1){echo '课程';}elseif($userinfo2['type']==2){echo '班级';} ?></p>
		        					
		        				</div>
		        			</div>
					</div>
			        </li>
				</ul>
			</div>
</div>
<div class=" mt20 ks-wbox bRadius10 clearfix">
			<div class="ks-clist">
				<ul class="clearfix">
					<li>
	            	<div class="ks-cbox clearfix">
						<h3 class="ks-first mb20">操作栏</h3>
						 <div class="ks-txtLbox">	
		        			<div class="">
			        		  <ul class="class-opeart" > 
	            	  			
            	  				<?php if($userinfo2['status']!=3){?>
			            	   		<?php if($userinfo2['restult']!=3&&$userinfo2['restult']!=4){?>
			            	   		<li>
			            	   			<a class="c-86A8F mr10"  onclick="Confirm('是否确定加入试听？','<?php echo M_URL($this->AppName.'/Index','addlestion',$userinfo2['id'],GP('p-'.$now_page)); ?>')" >加入试听</a>
			            	   		</li>
			            	   		<?php }?>
			            	   		<li>
			            	   		    <a class="c-86A8F mr10" onclick="Confirm('是否放弃该记录？该操作不可逆!','<?php echo M_URL($this->AppName.'/Index','delRec',$userinfo2['id'],GP('p-'.$now_page)); ?>')">放弃</a>
			            	   	    </li>
			            	   	<?php }?>
	            	  			</li>
	            	  			
	            	  				<li>
			            	    		<a class="c-86A8F mr10" href="<?php echo M_URL($this->AppName.'/Index','editRed',$userinfo2['id'],GP('p-'.$now_page)); ?>">编辑</a>
			            	    	</li>
<!--		            	   	
                               	<li>
			            	   	<a class="c-86A8F mr10" href="<?php echo M_URL($this->AppName.'/Index','returnlist',$userinfo2['id'],GP('p-'.$now_page)) ?>">回访记录</a>
		            	   		</li>-->
		            	   		
		            	   		<li>
		            	   			<a class="c-86A8F mr10" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','returnvisit',$userinfo2['id'],GP('')) ?>','850px','600px',{title:'添加回访记录',type:'top'})">添加回访</a>
		            	   		</li>
		            	   		<?php if($userinfo2['restult']!=4){?>
		            	   			<li>
			            	    	<a class="c-86A8F mr10"  onclick="Confirm('是否确定将该咨询人加入学员列表，成功加入后默认密码为123456，账号为手机号','<?php echo M_URL($this->AppName.'/Index','signup',$userinfo2['id'],GP('p-'.$now_page)); ?>')" >加入学员档案</a>
			            	   </li>
			            	   <?php }?>
			            	   	<?php if($userinfo2['restult']!=5){?>
			            	   		<li>
	            	    		<a class="c-86A8F mr10" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','invalidate',$userinfo2['id'],GP('')) ?>','850px','600px',{title:'变更为无效',type:'top'})">设置为无效</a>
	            	              </li>
	            	    <?php }?>
	            	  		</ul>
			        				
		        				</div>
		        			</div>
					</div>
			        </li>
				</ul>
			</div>
</div>
<div class="bRadius10 bg-white ks-wbox mt20" >

		<div class="detail"> 	
              	<h3 class="ks-first mb10 mb20" style="margin-left: 0;">沟通记录</h3>
              	
            	<table width="100%" cellpadding="0" cellspacing="0" border="0" class="ks-table">
            <thead>
                <tr>
                    <th>沟通人</th>
                    <th>回访日期</th>
                    <th>回访结果</th>
                    <th>备注</th>
                </tr>
            </thead>
            
            <tbody>
            	<?php  foreach($wordAry as $k =>$v){?>
             <tr>
             	
            	<td><?php echo $v['name']; ?></td>
            	  <td style="color: green"><?php echo $v['startime'] ?></td>
            	  <td class="c-86A8F"><?php if($v['restult']==0){echo '考虑中';}elseif($v['restult']==1){echo '已成单';}elseif($v['restult']==2){echo '无意向';}elseif($v['restult']==3){echo '想试听';}elseif($v['restult']==4){echo '已加入学生档案';}elseif($v['restult']==5){echo '无效';}  ?></td>
            	  <td style="text-align: left;"><?php echo $v['mark'] ?></td>
            </tr>
            <?php  }?>
            </tbody>
            </table>
		        <?php echo NoC($wordAry);?>
		 </div>
		
	     <div class="clearfix ks-popup-footer form-footer">
		 	<div class="d-inline-block mt20">
			<span class="d-inline-block">
					
			       	<input type="button" onclick="history.go(-1);" class="ks-bt bt-white" value="返回">
			</span>
			</div>
		</div> 
</div>
</div>


<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
module.require(['$','backstage','nicescroll'],function(){
	loadScorllJs();
})	
function Payswitch(usersstyle){
	var url = "<?php echo M_URL($this->AppName.'/Index','isshowswitch',$id,GP('')); ?>";
	$.ajax({
		type:"post",
		url:url,
		data:{'usersstyle':usersstyle},
		success:function(data){},
	    error:function(){
		    location.reload();
		}
	});
}
</script>
</body>
</html>

