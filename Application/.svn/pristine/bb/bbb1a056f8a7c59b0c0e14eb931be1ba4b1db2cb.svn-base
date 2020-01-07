<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="renderer" content="webkit">
	<title>kesion教育平台</title>
	<meta name="Keywords" content="kesion教育平台"/>
	<meta name="Description" content="kesion教育平台" />
	<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/admin/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/admin/css/html5.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
</head>


<body class="ks-wrap">
<form target="hidframe" method="post" action="<?php echo UOOT;?>admin.php/home/Setting/updateBase" class="form-horizontal" enctype="multipart/form-data">

<div id="ksBoxHead">
		<!--结束-->
		<div class="Header-tool clearfix"> 
			<div class="Tool-Title">
			<!--标题-->
			<p>
				<a href="javascript:history.go(-1);">
					<i class="iconfont icon-jiantou-copy"></i>
						商家设置<span>/</span>添加商家
				</a>
			</p>
			<!--标题-->
		
			</div>
		
			<!--操作范围-->
			
			<!--按钮组件-->
			
			<!--按钮组件-->
			
			<!--搜索框组件-->
			
			<!--搜索框组件-->
			
			<!--操作范围-->
		
		</div>
	</div>

</form>


<div >

    <form target="hidframe" class="form-horizontal" action="<?php if(empty($value)){echo M_URL('Offweb','caseManageDoSave',$id);}else{echo M_URL('Offweb','caseManageDoSave',$value['id'],GP('p-'.$now_page));} ?>" method="post" enctype="multipart/form-data">



        <div class="Created-push mt20" id="ksBoxContent" style="position: relative;">
            <ul>

                <li>
                    <div class="Created-largetTitle">
                        <!--<span>1</span>-->
                        <div class="Created-title">
                            <!--<span>基本信息</span>
						<span>(可修改部分)</span>-->
                        </div>
                    </div>
                    <div class="form-box form-upload-box" style="padding-top: 0;">
                        <div class="Created-ing">
                            <ul>
                                <li>
                                    <input name="id" type="hidden" value="" />
                                    <h4>商家名称:</h4>
                                    <div class="Created-Content clearfix">
                                        <input type="text" class="long-text" name="filename" value="<?php if(!empty($value)){echo $value['name'];} ?>" />
                                    </div>
                                </li>
                                <li>
                                    <input name="id" type="hidden" value="" />
                                    <h4>商家等级:</h4>
                                    <div class="Created-Content clearfix">
                                        <input type="text" class="long-text" name="level" value="<?php if(!empty($value)){echo $value['level'];} ?>" />
                                        <p>数字越大显示越靠前</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-upload" style="position: relative;">
                                        <div class="js_uploadBox">
                                            <div class="js_showBox">
                                                <img class="js_logoBox block fileurl" onerror="this.src='//ks.kesion.com/Public/uploads/common/nopic.gif'" src="<?php if(!empty($value)){echo XImg($value['picture'],1);} ?>" />
                                            </div>
                                            <div class="btn-upload clearfix">
                                                <a href="javascript:addTypeChange('<?php echo M_URL('Index','imageslist','',GP('type-top,name-fileurl',true));?>','930px','610px',{title:'选择图片',type:'top'});" class="selectImageBtn">
                                                    <span class="js_uploadText">上传图片</span>
                                                </a>
                                                <p>限制：2MB,支持jpg|png|gif</p>
                                                <input type="hidden" name="fileurl" value="<?php if(!empty($value)){echo XImg($value['picture'],1);} ?>" />
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>

                        </div>


                    </div>


                </li>
            </ul>

        </div>





        <div class="ks-bom" id="ksBoxFooter" style="height: 120px;">
            <div style="display: inline-block;">
                <button type="submit" class="ks-bt bt-pue mr10">确定</button>
                <a href="javascript:history.go(-1);" class="ks-bt bt-def" style="background: #CCCCCC;">取消</a>
            </div>

        </div>
    </form>	
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
</body>
<script type="text/javascript">
	$("#tablist li").click(function(){
		
		$("#tablist li").removeClass("active"); 
		$(this).addClass("active");
		
		var index = $(this).index();
		$(".Created-push").removeAttr("id")
		console.log(index);
		$(".Created-push").eq(index).attr("id","active");
	})
	radiotabs('temptype','.radio-tabs');
</script>
</html>