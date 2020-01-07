<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>
        <?php if(!empty($userinfo)){echo "修改子账号";}else{echo "添加子账号";} ?>
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
    
    .first-box {
        padding: 10px;
        width: 140px;
        position: absolute;
        left: 0;
        top: 0;
        border-right: 1px solid #eee;
        background: #f9f9f9;
        height: 100%;
        box-sizing: border-box;
    }
    
    .secondlayer {
        padding: 5px 10px;
        width: 20%;
        position: relative;
        box-sizing: border-box;
    }
    
    .firstlayer {
        border: 1px solid #eee;
        border-bottom: 0;
        min-height: 50px;
    }
    .firstlayer:last-child{
		border-bottom: 1px solid #eee;
	}
    
    .thirdlayer {
        background: #fff;
        z-index: 699;
		border-radius: 8px;
		
    }
    
    .form-upload-box {
        padding-right: 0px;
    }
    
    .poweritem {
        height: 200px;
        overflow-y: auto;
        min-width: 160px;
    }
    
    .firstlayer {
        padding-left:140px;
        position: relative;
    }
</style>

<body class="ks-wrap">

    <form target="hidframe" method="post" id="myform" action="<?php if(!empty($userinfo)){echo M_URL($this->AppName.'/Index','doTeacherEdit',$id,GP('p-'.$now_page));}else{echo M_URL($this->AppName.'/Index','doTeacherAdd','',GP(" usertype-$usertype
        "));} ?>" class="form-horizontal" enctype="multipart/form-data">
        <div class="ks-wbox bRadius10">
            <div class="ks-head-nav">
                <!--标题-->
                <a href="javascript:history.go(-1);">子账号管理</a><span> <em>/</em> <?php if(!empty($userinfo)){echo "修改子账号";}else{echo "添加子账号";} ?>
			<!--标题-->
		</div>
		

		
		<div class="form-box form-upload-box  tab-pane" style="display:block">
			<div class="form-row clearfix">
          		<span class="name name-nowrap"><i class="form-star">*</i>名称</span>
                <div class="form-limit" limit="25">
                    <input type="text" class="form-textbox" name="name" value="<?php if(!empty($userinfo)) echo $userinfo['name'] ?>" />
                </div>
            </div>
            <div class="form-row clearfix">
                <span class="name name-nowrap">职称</span>
                <div class="form-limit" limit="25">
                    <input type="text" class="form-textbox" name="position" value="<?php if(!empty($userinfo)) echo $userinfo['position'] ?>" />
                </div>
            </div>

            <div class="form-row clearfix">
                <span class="name name-nowrap"><i class="form-star">*</i>登录账号</span>
                <input type="text" class="form-textbox" name="username" value="<?php if(!empty($userinfo)){echo $userinfo['username'];} ?>" <?php if(!empty($userinfo)) echo " disabled " ?> />
            </div>
            <div class="form-row clearfix">
                <span class="name name-nowrap"><i class="form-star">*</i>登录密码</span>
                <input type="password"  class="form-textbox" name="password"  value="">
            </div>
            <div class="form-row form-po clearfix">
                <span class="name name-nowrap">简短描述</span>
                <div class="form-limit" limit="45">
                    <input type="text" class="form-textbox" name="shortIntro" value="<?php if(!empty($userinfo["shortIntro"])) echo $userinfo["shortIntro"] ?>" />
                </div>
            </div>
            <div class="form-row clearfix" id="top" >
                <span class="name name-nowrap">角色选择</span>
                <?php if (!empty($role_list)) {?>
                    <?php if ($role_list) {?>
                        <?php foreach ($role_list as $k=>$v) {?>
                            <label for="powertype<?php echo $k+3;?>"><input type="radio" id="powertype<?php echo $k+3;?>" value="<?php echo $v['id'];?>"  name="roleid" <?php  if(!empty($userinfo)){if($userinfo['roleid']==$v['id']) echo "checked";}else{if ($k==0) echo "checked";}?> ><?php echo $v['title'];?></label>
                        <?php } ?>
                    <?php }?>
                <?php }else {?>
                    <a href="<?php echo M_URL($this->AppName.'/Index','roleAdd','',GP("appid-$this->appid")); ?>"><i class="icon-jiahao iconfont "></i>添加角色</a>
                <?php }?>

            </div>
            <div class="form-row clearfix">
                <span class="name name-nowrap">是否启用</span>
                <div class="form-switch" open-value="1">
                    <label for="inlineRadio7"><input type="radio" id="inlineRadio7" value="1" name="status" <?php  if(!empty($userinfo)){if($userinfo['status']==1) echo "checked";} ?> >已审核 </label>
                    <label for="inlineRadio9"><input type="radio" id="inlineRadio9" value="0" name="status" <?php  if(!empty($userinfo)){if($userinfo['status']==0) echo "checked";}else{ echo 'checked'; }  ?> >待审核 </label>
                </div>
            </div>


            <div class="form-upload">
                <div class="js_uploadBox">
                    <div class="js_showBox"><img class="js_logoBox block defaultpic" src="<?php if(!empty($userinfo)){echo Img($userinfo['head']);}else{ echo nopic(10);} ?>"></div>
                    <div class="btn-upload clearfix">
                        <a href="javascript:void(0);" onclick="addTypeChange('<?php echo M_URL('Index','imageslist','',GP('type-top,name-defaultpic',true));?>','930px','610px',{title:'选择图片',type:'top'});" class="selectImageBtn"><span class="js_uploadText">上传图片</span></a>
                        <p>限制：2MB,支持jpg|png|gif</p>
                        <input type="hidden" name="defaultpic" value="<?php if(!empty($userinfo)){echo Img($userinfo['head']);}else{ echo nopic(10);} ?>">
                    </div>
                </div>
            </div>
        </div>
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
//            if ($("#powertype2").attr("checked") != "") {
//                TopToggle(0);
//			}
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
            $("#myform").submit();
        }
    </script>
</body>

</html>