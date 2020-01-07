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
	<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
	<style>
		.level span{padding: 0 20px;display: inline-block; height: 24px;line-height: 24px;}
		.error {display: inline-block;float: none;color: #ababab;padding-left: 15px;}
	</style>
</head>
<body class="ks-wrap">
	<div class="ks-wbox bRadius10">
		<!--header-->
	    <div class="ks-head-box">
	     	
		<h3 class="ks-head-title">
     		修改密码
		</h3>
	    </div>
	    <!--header-->
					     
			  
		<!--widget-->
		<div class="ks-head-widget clearfix">
			<div class="ks-search-box fl">
	
			</div>					
					
			<div class="fr">
						
			</div>
					
		</div>
		<!--/widget-->
	     
		<!--table-->
		 <form target="hidframe"  class="form-horizontal" action="<?php echo M_URL('Changepwd','doeditPwd'); ?>" method="post" style="margin: 0;">
		  	<div id="ksBoxContent" class="bg-white mt20" style="border-radius: 10px;">
				  	<div  class="p30">
					   <div class="form-row">
						    <div class="name">旧密码</div>
						  	<div class="level"><input type="password" name="oldpassword" class="form-textbox w300" id="password"><div class="name"  style="display: inline-block;position: relative;top: 10px;margin-left: 20px;"> <img src="<?php echo UOOT;?>Public/app/images/exclamatmark.png" class="verAlignMiddle"> 密码由6-20位字符组成，区分大小写</div></div>  
					 </div>
						
					
						<div class="form-row">
							<div class="name">新密码</div>
						    <div><input type="password" name="newpassword" class="form-textbox w300" id="newpassword" onKeyUp=pwStrength(this.value) onBlur=pwStrength(this.value)>
						    	<div class="form-row clearfix" style="display: inline-block;position: relative;top: 20px;margin-left: 20px;">
						    <div class="level"><span class="strength low bg-de fl c-fff alignCenter mr30" id="strength_L">低</span><span class="strength in bg-de fl c-fff alignCenter mr30" id="strength_M">中</span><span class="strength strong bg-de fl c-fff alignCenter" id="strength_H">强</span></div>
							<div ></div>
						</div>	
						    </div>
							<div  class="leftTd alignLife fsize12 c-92 pr10  pl20">
							    <p class="c-92 fsize12"></p>
							</div>
						</div>
					
						<div class="form-row">
							<div class="name">确认新密码：</div>
						    <div><input type="password" name="assertpassword" class="form-textbox w300" id="assertpassword"></div>
							 <!--<div  class="leftTd alignLife fsize16 c-red borderBda">不能为空！</div>-->
						</div>
				  	</div>
				<div id="ksBoxFooter">
					<div style="height: 80px;"></div>	
				</div>
		    </div>
			<div class="alignCenter form-footer " style="border-top:0"><input type="submit" class="ks-bt bt-pue fn" value="确认修改" name="save"></div>
			</form>
	    <!--/table-->
	            
	</div>
	
	
<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
	
	module.require(['$','backstage','nicescroll','validate','messages_zh'],function(){
		loadScorllJs();
		$('#ks-content').height($(window).height()-$('.generalTitle').outerHeight());
		$(window).resize(function(){
			$('#ks-content').height($(window).height()-$('.generalTitle').outerHeight());
		});
		$.validator.setDefaults({
		    submitHandler: function() {
				$(".form-horizontal").ajaxSubmit();
		    }
		});
		$().ready(function() {
		// 在键盘按下并释放及提交后验证提交表单
		$(".form-horizontal").validate({
				rules: {
					oldpassword: {
						 required: true,
						 minlength: 6,
						 maxlength:20
						 
					   },
					newpassword: {
						 required: true,
						 minlength: 6,
						 maxlength:20
					   },
					assertpassword: {
						 required: true,
						 minlength: 6,
						 maxlength:20,
						 equalTo: "#newpassword"
					  },
				},
				messages: {
					oldpassword: {
						required: "请输入密码",
						minlength: "密码长度不能小于6 个字母"
					},
					newpassword: {
						required: "请输入密码",
						minlength: "密码长度不能小于 6 个字母"
					},
					assertpassword: {
						required: "请输入密码",
						minlength: "密码长度不能小于 6 个字母",
						equalTo: "两次密码输入不一致"
					},
				}
				});
			});
		});

function CharMode(iN){
    if (iN>=48 && iN <=57) //数字
        return 1;
    if (iN>=65 && iN <=90) //大写
        return 2;
    if (iN>=97 && iN <=122) //小写
        return 4;
    else
        return 8;
}
//bitTotal函数
//计算密码模式
function bitTotal(num){
    modes=0;
    for (i=0;i<4;i++){
        if (num & 1) modes++;
        num>>>=1;
    }
    return modes;
}
//返回强度级别
function checkStrong(sPW){
    if (sPW.length<6)
        return 0; //密码太短，不检测级别
    Modes=0;
    for (i=0;i<sPW.length;i++){
        //密码模式
        Modes|=CharMode(sPW.charCodeAt(i));
    }
    return bitTotal(Modes);
}

//显示颜色
function pwStrength(pwd){
    Dfault_color="#eeeeee";     //默认颜色
    L_color="#FF0000";      //低强度的颜色，且只显示在最左边的单元格中
    M_color="#FF9900";      //中等强度的颜色，且只显示在左边两个单元格中
    H_color="#33CC00";      //高强度的颜色，三个单元格都显示
    if (pwd==null||pwd==''){
        Lcolor=Mcolor=Hcolor=Dfault_color;
    }
    else{
        S_level=checkStrong(pwd);
        switch(S_level) {
            case 0:
                Lcolor=Mcolor=Hcolor=Dfault_color;
                break;
            case 1:
                Lcolor=L_color;
                Mcolor=Hcolor=Dfault_color;
                break;
            case 2:
                Lcolor=Mcolor=M_color;
                Hcolor=Dfault_color;
                break;
            default:
                Lcolor=Mcolor=Hcolor=H_color;
        }
    }
    document.getElementById("strength_L").style.background=Lcolor;
    document.getElementById("strength_M").style.background=Mcolor;
    document.getElementById("strength_H").style.background=Hcolor;
    return;
}

    </script> 
</body>
</html>
