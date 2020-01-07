<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>修改会员</title>

<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<style type="text/css">
	.Created-title span:last-child {margin-left: 0;}

</style>
</head>
<body class="gray-bg">
<form target="hidframe"  method="post" id="myform" action="<?php if(!empty($userinfo)){echo M_URL('Users','doeditUsers',$userid,GP("usertype-$usertype,p-$now_page"));}else{echo M_URL('Users','doaddUsers','',GP(''));} ?>" class="form-horizontal" enctype="multipart/form-data">
 <div class="wrapper  wrapper-content ">
    <div class="row">
        <div id="manage_top " class="menu_top_fixed  ">
            <div class="ibox-title">
              <h3 class="fl ml15"><?php if(!empty($userinfo)){if($usertype == '1'){echo "修改教师会员";}elseif($usertype == '2'){echo "修改机构会员";}elseif($usertype == '3'){echo "修改学员";}}else{if($usertype == '1'){echo "添加教师会员";}elseif($usertype == '2'){echo "添加机构会员";}elseif($usertype == '0'){echo "添加学员";}} ?></h3>
             <a class="" href="javascript:history.go(-1);" style="margin-left:15px;color:#788188"><i class="up-level" ></i>上一级</a>
             <div class="ibox-tools">
                <div class="re-btn"></div>
                <a href="javascript:void(0)" onclick="history.go(0)" class="collapse-link">
                     <i class="reflash"></i>
                </a>
             </div>
             <ul>
            
             </ul>
           </div>
        </div><br /><br /><br />
        <div class="tabs-container">
            <ul class="nav nav-tabs">
                <li class="active"><a>基本信息</a></li>
                <!----------------- 自定义字段添加后插入选项卡---------------->
                <?php echo $this->Field->getTab($tableid,'table','useradd');?>
            </ul>
        
            <div class="tab-content">
                <div  class="tab-pane " style="display:block">
                    <div class="panel-body">
                        <div class="row"  id="teacher">     
<div >
    <div class="ibox-content">
        <br/>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">用户名</label>
            <div class="col-sm-4" >
                <input type="text" required class="form-control" name="username" value="<?php if(!empty($userinfo)){echo $userinfo['username'];} ?>"  <?php if(!empty($userinfo)) echo " readonly " ?> >
            </div>登录凭证
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">登入密码</label>
            <div class="col-sm-4" >
            	<input type="password" style="display:none" name="password">
                <input type="password" <?php if(empty($userinfo)) echo "required"; ?> class="form-control" name="password" >
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">手机号</label>
            <div class="col-sm-4" >
                <input type="text" required class="form-control" name="mobile" value="<?php if(!empty($userinfo)){echo $userinfo['mobile'];} ?>"  <?php if(!empty($userinfo)) echo " readonly " ?> >
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">邮箱</label>
            <div class="col-sm-4" >
                <input type="email" required class="form-control" name="email" value="<?php if(!empty($userinfo)){echo $userinfo['email'];} ?>">
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">所属分类</label>
            <div class="col-sm-6" > 
               <?php echo $Linkage->Linkage(1);?>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label"><?php if($usertype == '1'){echo "教师名称";}elseif($usertype == '2'){echo "机构名称";}elseif($usertype == '0'){echo "学员名称";} ?></label>
            <div class="col-sm-4" >
                <input type="text" class="form-control" name="name" value="<?php if(!empty($userinfo)){echo $userinfo['name'];} ?>" >
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label"><?php if($usertype == '1'){echo "教师英文名称";}elseif($usertype == '2'){echo "机构英文名称";}elseif($usertype == '0'){echo "学员英文名称";} ?></label>
            <div class="col-sm-4" >
                <input type="text" class="form-control" name="ename" value="<?php if(!empty($userinfo)){echo $userinfo['ename'];} ?>" >
            </div>
        </div>
        <div class="hr-line-dashed"></div>

        <div class="form-group">
            <label class="col-sm-2 control-label"><?php if($usertype == '1'){echo "教师图片";}elseif($usertype == '2'){echo "机构图片";}elseif($usertype == '0'){echo "学员图片";} ?></label>
            <div class="col-sm-4">
                                                                 
 <div class="control-group js_uploadBox">
<div class="btn-upload clearfix">
<a href="javascript:void(0);" class="selectImageBtn c-89 fsize14 fl mr10 bRadius5"><span class="js_uploadText">上传</span>图片</a>
<span class="fl c-d0 fsize12" style="height:37px; line-height:37px;">限制：2MB,支持jpg|png|gif</span>
<input class="hide js_upFile" type="file" name="file" id="upImg">
</div>

<div class="js_showBox mt10 w180"><img class="js_logoBox block" src="<?php echo Img($this->upload->getHead($userid));?>" width="180" onerror="this.src='<?php echo nopic(1);?>'"></div> 
  </div>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">所在地区</label>
            <div class="col-sm-4">
              <?php echo $link->Linkage(1);?>  
            </div>
        </div>
        
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">会员状态</label>
            <div class="col-sm-4" style="margin-top:7px">
                <div class="radio radio-info radio-inline">
                    <input type="radio" id="status1" value="1" name="status" <?php  if(!empty($userinfo)){if($userinfo['status']==1)echo "checked";}else{echo "checked";}?>>
                    <label for="status1"> 正常 </label>
                </div>
                <div class="radio radio-info radio-inline">
                    <input type="radio" id="status3" value="0" name="status" <?php  if(!empty($userinfo)){if($userinfo['status']==0) echo "checked";}?>>
                    <label for="status3">待审核 </label>
                </div>
                <div class="radio radio-info radio-inline">
                    <input type="radio" id="status2" value="2" name="status" <?php  if(!empty($userinfo)){if($userinfo['status']==2) echo "checked";}?>>
                    <label for="status2"> 锁定 </label>
                </div>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
    </div>
</div>
                            </div>
                    </div>
                </div>
                <!----------------- 自定义字段添加后插入---------------->
                <?php echo $this->Field->getF($tableid,'table','useradd',$userinfo);?>
            </div>
                
           
        </div>
    </div>
</div>

<div class="footer-page">
    <div class="col-sm-5"></div>
    <div class="co-sm-3">
        <button type="button" onclick="do_reg();" class="btn btn-primary btn-s-md">确认</button>
        <a href="javascript:history.go(-1);" class="btn btn-s-md btn-default">取消</a>
    </div>
</div>
</form>
<!--<script type="text/javascript" src="<?php echo UOOT;?>Public/common/js/laydate/laydate.js"></script>-->
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
$(function(){
    loadScorllJs();//滚轮
	taps();//选项卡
	uploadView('100','100');//图片上传	
})
</script>
<script>
function do_reg(){
	var username = $("input[name='username']").val();
	if(!username) {
		Alert("请输入用户名");
		return;
	}
	var mobile = $("input[name='mobile']").val();
	var reg = /^1[34578]\d{9}$/;
	isok = reg.test(mobile);
	if (!isok){
		Alert("请输入手机号");
		return;
	}
	$("#myform").submit();	
}
</script>
</body>
</html>
