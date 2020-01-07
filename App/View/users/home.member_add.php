<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="renderer" content="webkit">
    <title>修改会员</title>
    <link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
 
</head>
<body class="ks-wrap">
<form target="hidframe"  method="post" id="myform" action="<?php if(!empty($userinfo)){echo M_URL($this->AppName.'/Index','doeditUsers',$userid,GP("p-$now_page"));}else{echo M_URL($this->AppName.'/Index','doaddUsers','',GP("usertype-$usertype"));} ?>" class="form-horizontal" enctype="multipart/form-data">
<div class="ks-wbox bRadius10">
	<div class="ks-head-nav">
			<!--标题-->
			 <a href="<?php echo M_URL($this->AppName.'/Index','index','',GP("p-$now_page"));?>">学生管理</a><span><em>/</em><?php if(!empty($userinfo)){echo "修改学生会员";}else{echo "添加学生会员";} ?></span>
			<!--标题-->
		</div>
	    <!--tab-->
     	<div class="ks-head-tab">
 			<ul class="clearfix">
		      	 <li class="curr "><a>基本信息</a></li>
                <!----------------- 自定义字段添加后插入选项卡---------------->
                <?php echo $this->Field->getTab($tableid,'table','useradd');?>
		    </ul>
     	</div>
     	<!--/tab-->	
        <div class="tab-pane " style="display:block;padding: 0;">
            <div class="form-box form-upload-box">
				<?php if(!empty($userinfo)){?>
              	<div class="form-row">
	              	<span class="name"><i class="form-star">*</i>学员账号<span style="color: red;">(登录凭证)</span></span>
	              	<input type="text"  class="form-textbox " name="username" id="username" value="<?php if(!empty($userinfo)){echo $userinfo['username'];} ?>" <?php if(!empty($userinfo)) echo " disabled " ?> />
	            </div>
				<?php }else{?>
                <div class="form-row">
	              	<span class="name"><i class="form-star">*</i>学员账号<span style="color: red;">(登录凭证)</span></span>
	              	<input type="text"  class="form-textbox " name="username" id="username" value=""/>
	            </div>
                <?php }?>
                <div class="form-row">
	              	<span class="name"><i class="form-star">*</i>登入密码</span>
	              	<input type="password" <?php if(empty($userinfo))echo "required"; ?> class="form-textbox" name="password" >
	            </div>
                <div class="form-row">
	              	<span class="name">联系电话<?php if(!empty($userinfo)&&$userinfo['mobilebing']==1){?><span style="color: red;">(已认证,可用于登录)</span><?php }?></span>
	              	<input type="text"  class="form-textbox " name="mobile"  value="<?php if(!empty($userinfo)){echo $userinfo['mobile'];} ?>" <?php if(!empty($userinfo)&&$userinfo['mobilebing']==1){echo "disabled";}?> />
	            </div>
	            <div class="form-row">
	              	<span class="name">学生姓名</span>

	              		<input type="text" class="form-textbox" name="membername" value="<?php if(!empty($userinfo)) echo $userinfo['name'] ?>" />

	            </div>
				<?php if ($this->setting[3]==1) {?>
				<div class="form-row">
					<span class="name">班主任姓名</span>
						<input type="text" class="form-textbox" name="teacher_name" value="<?php if(!empty($userinfo)) echo $userinfo['teacher_name'] ?>" />
				</div>
				<div class="form-row">
					<span class="name">班主任电话</span>
						<input type="text" class="form-textbox" name="teacher_mobile" value="<?php if(!empty($userinfo)) echo $userinfo['teacher_mobile'] ?>" />
				</div>
				<?php }?>
				<?php if(ismoduleopen($this->wxid,5)){?>
				<div class="form-row">
					<span class="name">所属分组</span>
					<select name="groupid"  class="inputText bRadius5 w300">
						<option value="0">未分组</option>
						<?php foreach ($group_list as $k=>$v) {?>
							<option value="<?php echo $v['id'];?>" <?php echo $v['id']==$userinfo['groupid']?'selected':''?>><?php echo $v['name']?></option>
						<?php }?>
					</select>
				</div>
				<?php }?>
				<div class="clearfix">
					<input type="checkbox" name="is_period" onclick="groupCourse(this)"  <?php if(!empty($userinfo)){if($userinfo["is_period"]==1)echo "checked"; }?> value="1" >
					<label for="associated" class="associated" style="float: none;">开启帐号有效期</label>
				</div>
				<div class="form-row" id="gropu-shop" style="display :  <?php if($userinfo["is_period"]==1){echo "block";}else{echo 'none';} ?>">
					<span class="name">有效期</span>
					<div class=" ks-head-tbox w300 ">
						<input type="text" value="<?php if(!empty($userinfo['indate'])){echo date('Y-m-d H:i:s',$userinfo['indate']);}else{echo date('Y-m-d H:i:s',time());} ?>" name="indate" required="" readonly="" class="ks-head-input ks-head-time selectLiveTime" >
						<span class="ks-head-ticon"><i class="iconfont icon-date"></i></span>
					</div>
				</div>
	            <div class="form-row clearfix">
	              	<span class="name name-nowrap">性别</span>
	              		<label for="inlineRadio8" class="label-on">
	              			<input type="radio" id="inlineRadio8" value="1" class="radioInput" name="Sex" <?php if(!empty($userinfo)){if($userinfo['Sex']==1){echo 'checked="checked"';}}else{echo 'checked="checked"';} ?>>男</label>
	              	<label for="inlineRadio7" class="label-on">
					    <input type="radio" id="inlineRadio7" value="2" class="radioInput" name="Sex" <?php if(!empty($userinfo)){if($userinfo['Sex']==2){echo 'checked="checked"';}}?>>女</label>
	            </div>
	           
	            
	            <!--<div class="form-row">
	              	<span class="name">紧急联系人</span>
	              	<input type="text"  class="form-textbox " name="emergencyContact"  value="<?php if(!empty($userinfo)){echo $userinfo['emergencyContact'];} ?>" />
	            </div>
	            <div class="form-row">
	              	<span class="name">紧急联系人电话</span>
	              	<input type="text"  class="form-textbox " name="emergencyContactTel"  value="<?php if(!empty($userinfo)){echo $userinfo['emergencyContactTel'];} ?>" />
	            </div>-->
				<?php if(ismoduleopen($this->wxid,29)){ 
				?>
	            <div class="form-row">
	              	<span class="name">所属校区</span>
	              	<select  class="form-textbox " name="schoolid">
	              		<option value="0">请选择</option>
	              		<?php foreach($schoolAry as $k =>$v){?>
	              		<option value="<?php echo $v['schoolid'] ?>" <?php if(!empty($userinfo)){ if($userinfo['schoolid']==$v['schoolid']){echo 'selected';}} ?> ><?php echo $v['school'] ?></option>
	              		<?php }?>
	              	</select>
	            </div>
				<?php 
				}?>

	            <div class="form-row clearfix">
	              	<span class="name name-nowrap">是否审核</span>
	              	<div class="form-switch clearfix" open-value="1">
						<label><input type="radio" name="status" value="1" <?php if(!empty($userinfo)&&$userinfo['status'] == 1){ echo 'checked="checked"'; }else{echo 'checked="checked"';}?> class="radioInput">启用</label> 
		           		<label><input type="radio" name="status" value="0" <?php if(!empty($userinfo)&&$userinfo['status'] == 0){ echo 'checked="checked"'; }?> class="radioInput">不启用</label>
	           		</div>
	              		
	              	<!--<div class="form-switch" data-openValue="1">
		              	<label for="inlineRadio9"><input type="radio" id="inlineRadio9" class="radioInput" value="1" name="status" <?php  if(!empty($userinfo)){if($userinfo['status']==1) echo "checked";}?>>锁定</label>
						<label for="inlineRadio7"><input type="radio" id="inlineRadio7" class="radioInput" value="0" name="status"<?php  if(!empty($userinfo)){if($userinfo['status']==0) echo "checked";}?>>正常 </label>
					</div>-->
	            </div>
	            <div class="form-upload">
	              	<div class="js_uploadBox">
	              		<div class="js_showBox" ><img class="js_logoBox block defaultpic" src="<?php if(!empty($userinfo)){echo Img($userinfo['head']);}else{ echo nopic(4);} ?>" ></div>
			            <div class="btn-upload clearfix">
			                <a href="javascript:void(0);" onclick="addTypeChange('<?php echo M_URL('Index','imageslist','',GP('type-top,name-defaultpic',true));?>','930px','610px',{title:'选择图片',type:'top'});" class="selectImageBtn"><span class="js_uploadText">上传图片</span></a>
			                <p>限制：2MB,支持jpg|png|gif</p> 
			                <input type="hidden" name="defaultpic">
			            </div> 
					</div>
	            </div>
            </div>
   		</div>
        <!----------------- 自定义字段添加后插入---------------->
        <div class="tab-pane">
			 <div class="form-box">
                  <div class="form-row"> 
	              	<span class="name">出生日期</span>  
	              	<div class=" ks-head-tbox w300 ">
	              	<input  type="text" value="<?php if(!empty($userinfo['birthday'])){echo date('Y-m-d H:i:s',$userinfo['birthday']);}else{echo date('Y-m-d H:i:s',time());} ?>" name="birthday" required="" readonly="" class="ks-head-input ks-head-time selectLiveTime" >
	              	<span class="ks-head-ticon"><i class="iconfont icon-date"></i></span>	
	              	</div>
	            </div>
                 <div class="form-row">
	              	<span class="name"><i class="form-star"></i>邮箱</span>
	              	<input type="email" class="form-textbox" name="email" value="<?php if(!empty($userinfo)){echo $userinfo['email'];} ?>">
	            </div>
                 <div class="form-row">
	              	<span class="name">所在地区</span>
	              	<?php echo $link->Linkage(1);?>  
	            </div>

        <?php echo $this->Field->getF($tableid,'table','useradd',$userinfo);?>
           </div>
        </div>
		<div class="form-footer">
			<span class="d-inline-block">
			<button type="button" onClick="do_reg()" class="ks-bt bt-pue"><?php if(!empty($userinfo)){echo "确认修改";}else{echo "确认添加";} ?></button>
		    <button onclick="javascript:history.go(-1);" class="ks-bt bt-white">取消</button>
		    </span>
	    </div>

	</div>
	</form>
<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
module.require(['$','backstage','nicescroll','laydate'],function(){

	//选择时间
	lay('.selectLiveTime').each(function(){
		laydate.render({
			elem: this,
			trigger: 'click',
			type: 'datetime'
		});
	});
	$(".ks-head-tab li").click(function(){
		var index = $(this).index();
		$(this).addClass("curr").siblings().removeClass('curr');
		$(".tab-pane").hide();
		$(".tab-pane").eq(index).show()
	});	
	$(".ks-view-tab li").click(function(){
		$(".ks-view-tab li").removeClass("curr");
		$(this).addClass("curr");
		var index= $(this).index();
		$(".tab-pane").hide();
		$(".tab-pane").eq(index).show();
	});

})
function groupCourse(target){
	var state = $(target).prop('checked')
	state == true ?   $('#gropu-shop').show() : $('#gropu-shop').hide()
}
function do_reg(){
	var membername  = $("input[name='membername']").val();
	var username    = $("#username").val();
	var mobile      = $("input[name='mobile']").val();
	var emergencyContactTel = $("input[name='emergencyContactTel']").val();
	var password    = $("input[name='password']").val();
	var email       = $("input[name='email']").val();
	/*数字验证*/
	var num =/^\d+(\.\d+)?$/;
	/*手机验证*/
	var reg = /^1[345789]\d{9}$/;
	/*邮箱验证*/
	var regemail =/^[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/;
    if (username == '') { Alert('学员账号'); $("#username").focus(); return false; }	
    <?php if(empty($userinfo)){?>
    if (password == '') { Alert('学员登录密码不能为空'); $("input[name='password']").focus();return false;}	
    <?php }?>
//    if (mobile == '') { Alert('学生联系电话'); $("input[name='mobile']").focus();return false;}
//    if(!reg.test(mobile)){Alert('学生联系电话不正确');return false;}
	
	$("#myform").submit();	
} 
</script>
</body>
</html>