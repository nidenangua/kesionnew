<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>kesion教育平台</title>
<meta name="Keywords" content="kesion教育平台"/>
<meta name="Description" content="kesion教育平台" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<style>
html,body{height: 100%;}
.form-img{background: #fff;border-radius:5px;border:1px solid #f0f3f4; box-shadow: 1px 2px 16px rgba(0,0,0,0.1); margin-right: 20px;}
.form-img-box{position: relative;min-height: 100px;padding:15px 15px 15px 170px; text-align: left;border-top:1px solid #f0f3f4;margin-top:-1px;}
.form-img-box .images{width:140px;height: 100px; overflow: hidden; position: absolute;left:15px;top:15px;}
.form-img-box .images img{width:100%;min-height:100%;}
.form-img-box .name{font-size:16px;margin-top:15px;}
/*灰色弹窗*/
.Qet{position: absolute;bottom: 0px; right: 0px; height: 30px; width: 30px;  z-index: 10; cursor:pointer; text-align: center;background: rgba(0,0,0,0.5);}
.Qet i{ line-height: 30px; font-size: 25px;color: #fff;}
#hidebg{position:absolute;left:0;top:0;background-color:#000;width:100%;filter:alpha(opacity=60);opacity:.6;display:none;z-Index:1500}
#hidebox{position: fixed;min-height:200px;top:100px;display:none;cursor:pointer;z-Index:1501; width:100%;}
#hidebox img{ max-width:100%;min-width:800px; height:auto;display: block; min-height:600px; max-height:600px; margin:0px auto; }
#content{text-align:center;cursor:pointer;z-Index:1}
</style>
<body class="ks-wrap">
	<div class="ks-wbox bRadius10">
		<!--header-->
	    <div class="ks-head-box">
			<h3 class="ks-head-title">
     			实名认证 
			</h3>
	    </div>
	    <!--header-->
		<!--widget-->
		<div class="ks-head-widget clearfix">
			<div class="ks-search-box fl"></div>		
			<div class="fr"></div>
		</div>
		<!--/widget-->
		<!--table-->
		<div class="form-box bg-white form-upload-box mt20">
		<form target="hidframe" id="myform"  action="<?php echo M_URL('User','dorealName');  ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="from" value="<?php echo $from; ?>" />
		<!--<div class="form-row">
			<input type="radio" class="fn" name="status" value="1" checked="checked"><span style="font-size: 14px;">个人</span>
            <input type="radio" class="fn" name="status" value="2"><span style="font-size: 14px;">公司</span>
		</div>-->
            <?php if ($real['status']==2){
                      echo "<div class=\"clearfix\" style=\margin:20px;font-weight:bold;font-size:16px;color:green;\">";
                      if (!empty($real['result'])){
                        echo "您提交的申请资料没有审核通过，原因如下：".$real['result']."。请重新提交！";
                      }else{
						echo "您提交的申请资料没有审核通过，请重新提交！";						  
					  }
                      echo "</div>";
                  }
            ?>
                 
		
		
		<!-------------------------------------------------------------------------------------->
		<div id="check2" >
		    <div class="form-row">
				<span class="name">公司名称</span>
				<input type="text" name="realName" value="<?php if(isset($real["realName"]))echo $real["realName"];?>" class="form-textbox">
			</div>
		    <input type="hidden" name="usertype" value="2">
		    <div class="form-row">
				<span class="name">营业证件号</span>
				<input type="text" name="numberId" value="<?php if(isset($real["numberId"]))echo $real["numberId"];?>" class="form-textbox">
			</div>
		    <div class="form-row">
		    	<span class="name">联系人</span>
		    	<input type="text" name="contacts" value="<?php if(isset($real["contacts"]))echo $real["contacts"];?>" class="form-textbox">
		    </div>
		    <div class="form-row">
		    	<span class="name">联系电话</span>
		    	<input type="text" name="tel" value="<?php if(isset($real["tel"]))echo $real["tel"];?>" class="form-textbox">
		    </div>
		    <div class="form-row">
		    	<span class="name">经营类别范围</span>
		    	<input type="text" name="range" value="<?php if(isset($real["range"]))echo $real["range"];?>" class="form-textbox">
		    </div>
		    <div class="form-upload" style="top: 0px;">
		    	<div class="form-img">
		    		<div class="form-img-box">
		    			<div class="images">
	                   		<img class="realPhoto1" onerror="this.src='<?php echo UOOT;?>Public/app/images/upload_source_1.jpg'" src="<?php if(isset($real['realPhoto1'])) echo Img($real['realPhoto1']);?>" />
	                   		<input type="hidden" name="realPhoto1" value="<?php if(isset($real['realPhoto1'])) echo $real['realPhoto1'];  ?>"/>
	              			<div class="Qet"><i class="iconfont icon-sousuo"></i></div>
              			</div>
              			<div class="name">法人身份证照正面</div>
              			<?php if($real['status'] == 2 || $real['status'] == 3){ ?>
					        <span onclick="addTypeChange('<?php echo M_URL('Index','imageslist','',GP('type-top,name-realPhoto1',true));?>','930px','610px',{title:'选择图片',type:'top'});" class="c-red ks-bt bt-def" style="cursor: pointer;">上传</span>
					    <?php }elseif($real['status'] == 0){ ?>
					        <span class="c-red">请耐心等待审核</span>
					    <?php }elseif($real['status'] == 1){ ?>
					        <span class="c-green">审核通过</span>
					    <?php  } ?>  
          			</div>
          			<div class="form-img-box">
          				<div class="images">
          					<img class="realPhoto2" onerror="this.src='<?php echo UOOT;?>Public/app/images/upload_source_2.jpg'" src="<?php if(isset($real['realPhoto2'])) echo Img($real['realPhoto2']);?>" />
	                   		<input type="hidden" name="realPhoto2" value="<?php if(isset($real['realPhoto2'])) echo $real['realPhoto2'];  ?>" />
	              			<div class="Qet"><i class="iconfont icon-sousuo"></i></div>
          				</div>
              			<div class="name">法人身份证照反面</div>
              			<?php if($real['status'] == 2 || $real['status'] == 3){ ?>
					       <span onclick="addTypeChange('<?php echo M_URL('Index','imageslist','',GP('type-top,name-realPhoto2',true));?>','930px','610px',{title:'选择图片',type:'top'});"class="c-red ks-bt bt-def" style="cursor: pointer;">上传</span>
					    <?php }elseif($real['status'] == 0){ ?>
					        <span class="c-red">请耐心等待审核</span>
					    <?php }elseif($real['status'] == 1){ ?>
					        <span class="c-green">审核通过</span>
					    <?php  } ?>  
          			</div>
          			<div class="form-img-box">
          				<div class="images">
	                   		<img class="teacherPhoto" onerror="this.src='<?php echo UOOT;?>Public/app/images/upload_source_3.jpg'" src="<?php if(isset($real['teacherPhoto'])) echo Img($real['teacherPhoto']);?>" />
	                   		<input type="hidden" name="teacherPhoto" value="<?php if(isset($real['teacherPhoto'])) echo $real['teacherPhoto'];  ?>"/>
	              			<div class="Qet"><i class="iconfont icon-sousuo"></i></div>
              			</div>
              			<div class="name">营业执照</div>
              			<?php if($real['status'] == 2 || $real['status'] == 3){ ?>
					        <span onclick="addTypeChange('<?php echo M_URL('Index','imageslist','',GP('type-top,name-teacherPhoto',true));?>','930px','610px',{title:'选择图片',type:'top'});" class="c-red ks-bt bt-def" style="cursor: pointer;">上传</span>
					    <?php }elseif($real['status'] == 0){ ?>
					        <span class="c-red">请耐心等待审核</span>
					    <?php }elseif($real['status'] == 1){ ?>
					        <span class="c-green">审核通过</span>
					    <?php  } ?>  
          			</div>
          		</div>
		    </div>
		    <div class="form-row">
		    	<span class="name">所在省市</span>
		    	<?php echo $link->Linkage(2);?>
		    </div>
		    <div class="form-row">
		    	<span class="name">具体地址</span>
		    	<input type="text" name="address" value="<?php if(isset($real['address'])) echo $real['address']; ?>" class="form-textbox">
		    </div>	
		</div>
		</div>
	    <!--/table-->
	            
		<!--footer-->
	<div id="ksBoxFooter">
		<div class="ks-bom form-footer clearfix">
		   <?php if($real['status'] == 2 || $real['status'] == 3){ ?> 			      
			    <input type="button" onclick="do_reg();"  class="ks-bt bt-pue" value="确认提交" name="confirm">
			<?php }elseif($real['status'] == 0){ ?>
				<span class="c-red fsize16">您的申请我们已收到，预计三天内审核完毕，请耐心等待！！！</span>  
			<?php }elseif($real['status'] == 1){ ?>
				<span class="c-green fsize16">审核通过</span>  
			<?php  } ?>  
		</div>
		</form>
	</div>
	<div id="hidebg"></div>
	<div id="hidebox"  onClick="hide();">
		<i class="iconfont icon-shanchu"></i>
		<img onmousewheel="return bbimg(this)"/>
	</div><!--/footer-->
	</div>
	<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
	<script>
module.require(['$','backstage','nicescroll'],function(){
	loadScorllJs()
});
function do_reg(){
	//数字验证
	var num   =/^\d+(\.\d+)?$/;
	//手机验证
	var reg   = /^1[34578]\d{9}$/;
	var usertype    = $("input[name='usertype']:checked").val();
	if(usertype==1){
	     var realName    = $("input[name='realName1']").val();
		 var numberId    = $("input[name='numberId1']").val();
		 var tel         = $("input[name='tel1']").val();
		 var address     = $("input[name='address1']").val();
		 var realPhoto1 = $("input[name='realPhoto11']").val(); 
		 var realPhoto2 = $("input[name='realPhoto21']").val(); 
		 /*var realPhoto3 = $("input[name='realPhoto3']").val();*/
		 if(realPhoto1==''){Alert('身份证正面');return false;}	
		 if(realPhoto2==''){Alert('身份证反面');return false;}	
		 /*if(realPhoto3==''){Alert('教师资格证');return false;}*/	
		 if(realName==''){Alert('真实姓名');return false;}	
		 if(numberId==''){Alert('身份证号');return false;}	
		 if(address==''){Alert('具体地址');return false;}	
		 if(!reg.test(tel)){Alert('请输入正确手机号');return false;}
	}else if(usertype==2){
	     var realName    = $("input[name='realName']").val();
		 var numberId    = $("input[name='numberId']").val();
		 var contacts    = $("input[name='contacts']").val();
		 var tel         = $("input[name='tel']").val();
		 var address     = $("input[name='address']").val();
	     var realPhoto1  = $("input[name='realPhoto1']").val(); 
		 var realPhoto2  = $("input[name='realPhoto2']").val(); 
		 var teacherPhoto = $("input[name='teacherPhoto']").val(); 
		 if(realPhoto1==''){Alert('法人身份证正面');return false;}	
		 if(realPhoto2==''){Alert('法人身份证反面');return false;}		
		 if(teacherPhoto==''){Alert('营业执照');return false;}	
		 if(realName==''){Alert('公司名字');return false;}	
		 if(numberId==''){Alert('营业执照号');return false;}	
		 if(address==''){Alert('具体地址');return false;}	
		 if(contacts==''){Alert('联系人');return false;}
		 if(!reg.test(tel)){Alert('请输入正确手机号');return false;}
	}
	$("#myform").submit();
}
$(".Qet").click(function(){
	var src=$(this).siblings("img").attr("src")	;
	show(src);
})
function kaitong(value){  //显示隐藏层和弹出层
   console.log(value);
   if(value==1){
	   $('#check1').show();
	   $('#check2').hide();
   }else{
       $('#check2').show();
       $('#check1').hide();
   }
}
function show(src){  //显示隐藏层和弹出层
	$("#hidebox img").attr("src",src)
	var hideobj=document.getElementById("hidebg");
	hidebg.style.display="block";  //显示隐藏层
	hidebg.style.height=document.body.clientHeight+"px";//设置隐藏层的高度为当前页面高度
	document.getElementById("hidebox").style.display="block";  //显示弹出层
}
function hide(){//去除隐藏层和弹出层
   document.getElementById("hidebg").style.display="none";
   document.getElementById("hidebox").style.display="none";
}
/*鼠标滚动缩放*/
function bbimg(o){ 
var zoom=parseInt(o.style.zoom, 10)||100;
zoom+=event.wheelDelta/12;
if (zoom>0) o.style.zoom=zoom+'%';
return false;
}
</script>
</body>
</html>

