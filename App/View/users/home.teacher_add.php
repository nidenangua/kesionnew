<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>
        <?php if(!empty($userinfo)){echo "修改教师会员";}else{echo "添加教师会员";} ?>
    </title>
    <link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
    <link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
    <link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
    <link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
    <link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css" rel="stylesheet">
    <script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<style>
    .form-limit {
        float: left;
    }
    
    .form-textarea {
        min-width: 600px;
    }
    
    .form-row select,
    .form-textbox {
        width: 400px
    }
    
    .poweritem {
        padding: 10px 5px;
    }
    
    .poweritem li {
        display: block;
        line-height:20px;
        margin:5px 0;
    }
    
    .poweritem li label {
		margin-right: 0;
		display: block;
		float: none;
    }
    
    
    
    .limits-layer {
        padding: 5px 15px;
        background: #f9f9f9;
       
    }
    .limits-layer label{
        color:#333;
    }
    .limits-layer--first{
        padding: 15px;
       
    }
    .limits-layer--first + .limits-layer--first{
        border-top: 1px solid #eee;
    }
    .limits-layer--first > .limits-layer__title{
        font-weight: bold;
    }
    .limits-layer--second,
    .limits-layer--third{
        padding-left: 25px;
    }
    
    .limits-layer__title{
        height: 28px;
        line-height: 28px;
        overflow: hidden;
    }
    .limits-layer__title label{
        margin-left: 5px;
    }
    .form-upload-box {
        padding-right: 0px;
    }
</style>

<body class="ks-wrap">

    <form target="hidframe" method="post" id="myform" action="<?php if(!empty($userinfo)){echo M_URL($this->AppName.'/Index','doeditUsers',$userid,GP('p-'.$now_page));}else{echo M_URL($this->AppName.'/Index','doTeacherAdd','',GP(""));} ?>" class="form-horizontal" enctype="multipart/form-data">
        <div class="ks-wbox bRadius10">
            <div class="ks-head-nav">
                <!--标题-->
                <a href="javascript:history.go(-1);">教师管理</a><span> <em>/</em> <?php if(!empty($userinfo)){echo "修改教师";}else{echo "添加教师";} ?>
			<!--标题-->
		</div>
		
		<!--tab-->
     	<!--<div class="ks-head-tab">
 			<ul class="clearfix">
 				<li class="curr fl"><a>基本信息</a></li>
				 <?php if($this->userinfo['parentid']==0){?><li class=" fl"><a>权限管理</a></li><?php }?>
		        <?php if($this->Field->getF($tableid,'table','useradd',$userinfo)){
					echo $this->Field->getTab($tableid,'table','useradd');
				}?>
 			</ul>
     	</div>-->
     	<!--/tab-->
		
		<div class="form-box form-upload-box  tab-pane" style="display:block">
			<div class="form-row clearfix">
          		<span class="name name-nowrap"><i class="form-star">*</i>教师名称</span>
                <div class="form-limit" limit="25">
                    <input type="text" class="form-textbox" name="teachername" value="<?php if(!empty($userinfo)) echo $userinfo['name'] ?>" />
                </div>
            </div>

            <?php if (empty($userinfo)) {?>
            <div class="form-row clearfix">
                <span class="name name-nowrap">帐号类型</span>
                <label for="powertype0"><input type="radio" id="powertype0" value="0" onclick="TopToggle(0);" name="powertype" <?php  if(!empty($userinfo)){if($userinfo['powertype']==0) echo "checked";}else{echo 'checked';}?> >仅展示</label>
                <label for="powertype2"><input type="radio" id="powertype2" value="2" onclick="TopToggle(1);"  name="powertype" <?php  if(!empty($userinfo)){if($userinfo['powertype']==2) echo "checked";}?> >参与管理</label>
            </div>
            <div class="form-row clearfix" id="top"  <?php if(!empty($userinfo)&& $userinfo['powertype']==2){ echo "style='display: block'";}else{echo "style='display: none'";}?>>
                <span class="name name-nowrap">绑定子帐号</span>
                <?php if ($role_list) {?>
                    <?php if ($role_list) {?>
                        <?php foreach ($role_list as $k=>$v) {?>
                            <label for="powertype<?php echo $k+3;?>"><input type="radio" id="powertype<?php echo $k+3;?>" value="<?php echo $v['userid'];?>"  name="userid" <?php  //if(!empty($userinfo)){if($userinfo['userid']==$v['id']) echo "checked";}else{if ($k==0) echo "checked";}?> ><?php echo $v['name'];?></label>
                        <?php } ?>
                    <?php }?>
                <?php }else{ ?>
                    <a    href="<?php echo M_URL('role/Index','teacherAdd','',GP("appid-7")); ?>" ><i class="icon-jiahao iconfont "></i>添加子账号</a>
                <?php }?>
            </div>
            <?php }?>
            <div class="form-row clearfix">
                <span class="name name-nowrap"><i class="form-star">*</i>职称</span>
                <div class="form-limit" limit="25">
                    <input type="text" class="form-textbox" name="position" value="<?php if(!empty($userinfo)) echo $userinfo['position'] ?>" />
                </div>
            </div>


            <div class="form-row clearfix">
                <span class="name name-nowrap">教师英文名称</span>
                <div class="form-limit" limit="25">
                    <input type="text" class="form-textbox" name="teacherename" value="<?php if(!empty($userinfo))echo $userinfo['ename'] ?>" />
                </div>
            </div>
            <div class="form-row form-po clearfix">
                <span class="name name-nowrap">简短描述</span>
                <div class="form-limit" limit="45">
                    <input type="text" class="form-textbox" name="shortIntro" value="<?php if(isset($userinfo["shortIntro"])) echo $userinfo["shortIntro"] ?>" />
                </div>
            </div>
            <div class="form-row">
                <span class="name name-nowrap"><?php echo $title;?><i class="form-star">*</i>详情</span>
                <div class="form-editor">
                    <?php  $value=!empty($userinfo["teacherIntro"])?Img($userinfo['teacherIntro']):'';$kindeditor = ks_editor('teacherIntro',$value,'1',editorNum4(),'100%'); echo $kindeditor;?>
                </div>
            </div>
            <!--<div class="form-row clearfix">
				<span class="name name-nowrap"><i class="form-star">*</i>老师手机</span>
				<input type="text" class="form-textbox w300" name="mobile" value="<?php if(!empty($userinfo)){echo $userinfo['mobile'];} ?>" <?php if(!empty($userinfo)&&$userinfo['mobilebing']==1) echo " disabled " ?> /></div>-->
            <div class="form-row clearfix">
                <span class="name name-nowrap"><i class="form-star">*</i>邮箱</span>
                <input type="email" class="form-textbox" name="email" value="<?php if(!empty($userinfo)){echo $userinfo['email'];} ?>" style="padding-right: 0;">
            </div>
            <div class="form-row clearfix">
                <span class="name name-nowrap"><i class="form-star">*</i>所属分类</span>
                <?php echo $Linkage->Linkage(1);?>
            </div>

            <div class="form-row">
                <span class="name">所属校区</span>
                <select class="form-textbox " name="schoolid">
              			<option value="0">请选择</option>
              			<?php foreach($schoolAry as $k =>$v){?>
              			<option value="<?php echo $v['schoolid'] ?>" <?php if(!empty($userinfo)){ if($userinfo['schoolid']==$v['schoolid']){echo 'selected';}} ?> ><?php echo $v['school'] ?></option>
              			<?php }?>
                </select>
            </div>
            <div class="form-row">
                <span class="name name-nowrap">所在地区</span>
                <?php echo $link->Linkage(1);?>
            </div>
            <div class="form-upload">
                <div class="js_uploadBox">
                    <div class="js_showBox"><img class="js_logoBox block defaultpic" src="<?php if(!empty($userinfo)){echo Img($this->upload->getHead($userid,10));}else{ echo nopic(10);} ?>"></div>
                    <div class="btn-upload clearfix">
                        <a href="javascript:void(0);" onclick="addTypeChange('<?php echo M_URL('Index','imageslist','',GP('type-top,name-defaultpic',true));?>','930px','610px',{title:'选择图片',type:'top'});" class="selectImageBtn"><span class="js_uploadText">上传图片</span></a>
                        <p>限制：2MB,支持jpg|png|gif</p>
                        <input type="hidden" name="defaultpic">
                    </div>
                </div>
            </div>
        </div>
       
        <!----------------- 自定义字段添加后插入---------------->
        <?php echo $this->Field->getF($tableid,'table','useradd',$userinfo);?>


        <div class="form-footer clearfix">
            <span class="d-inline-block">
		        <button type="button" onclick="do_reg()" class="ks-bt bt-pue"><?php if(!empty($userinfo)){echo "确认修改";}else{echo "确认添加";} ?></button>
		        <button type="button" onclick="javascript:history.go(-1);" class="ks-bt bt-white">取消</button>
	    	</span>
        </div>

        </div>


    </form>

    <script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>

    <script>
        module.require(['backstage', 'nicescroll'], function() {

			$(".ks-head-tab li").click(function() {
				var index = $(this).index();
				$(this).addClass("curr").siblings().removeClass('curr');
				$(".tab-pane").hide();
				$(".tab-pane").eq(index).show()
			});

        })
        
        function TopToggle(i) {
            i == 1 ? $('#top').show() : $('#top').hide();
        };

        function LeftToggle(obj, li) {
            obj.checked ? $('#left-' + li).show().find("input[type=checkbox]").prop("checked", true) : $('#left-' + li).hide().find("input[type=checkbox]").prop("checked", false);
        };

        function LeftToggle2(obj, li) {

            if (obj.checked) {

                $('.left2-' + li).show().find("input[type=checkbox]").each(function() {
                    var datatype = $(this).attr('type-name');
                    if (datatype == 'false') {
                        $(this).attr('type-name', 'true');
                        $(this).prop("checked", true)
                    }
                })
            } else {
                $('.left2-' + li).hide().find("input[type=checkbox]").each(function() {
                    var datatype = $(this).attr('type-name');
                    if (datatype == 'true') {
                        $(this).attr('type-name', 'false');
                        $(this).prop("checked", false)
                    }
                })
            }
        };

        function do_reg() {
            var teachername = $("input[name='teachername']").val();
            var username = $("input[name='username']").val();
            var password = $("input[name='password']").val();
            var email = $("input[name='email']").val(); //数字验证
            var num = /^\d+(\.\d+)?$/; //手机验证
            var reg = /^1[34578]\d{9}$/; //邮箱验证
            var email = /^[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/;
            <?php if(empty($userinfo)){ ?>
            if (teachername == '') {
                Alert('教师名称');
                return false;
            }
            if (username == '') {
                Alert('老师账号');
                return false;
            }
            if (password == '') {
                Alert('密码');
                return false;
            }
            if (email == '') {
                Alert('邮箱不能为空');
                return false;
            }
            <?php } ?>
            $("#myform").submit();
        };
    </script>
</body>

</html>