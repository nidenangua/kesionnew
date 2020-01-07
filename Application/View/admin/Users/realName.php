
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>添加应用</title>
<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/common/css/laydate.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/html5.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/reset.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
	<style>
		#hidebg {
			position: absolute;
			left: 0;
			top: 0;
			background-color: #000;
			width: 100%;
			filter: alpha(opacity=60);
			opacity: .6;
			display: none;
			z-Index: 1500;
		}
		#hidebox img {
			max-width: 100%;
			min-width: 800px;
			height: auto;
			display: block;
			min-height: 600px;
			max-height: 600px;
			margin: 0px auto;
		}
		#hidebox {
			position: fixed;
			min-height: 200px;
			top: 100px;
			display: none;
			cursor: pointer;
			z-Index: 1501;
			width: 100%;
		}
	</style>
</head>

<body class="gray-bg">
<div class="row">
<div id="manage_top" class="menu_top_fixed  p15 height73">
    <div class="ibox-title">
        <h3 class="fl">
         
        	<ul id="tablist">
        		
        		<li>认证材料</li>
        		
        	</ul>
        </h3>
      
          <div class="ibox-tools">
                 <!-- <a href="javascript:void(0)" onclick="history.go(0)" class="collapse-link">
                    <i class="reflash"></i>
                  </a>-->
                  <button class="ks-bt bt-def" type="button" onclick="history.go(-1)"><i class="iconfont icon-fanhui"></i>返回</button>
                 
         </div>
    </div>
</div>
</div>

<form target="hidframe"  action="<?php echo M_URL('Users','dorealName',$real["id"]);  ?>" method="post" enctype="multipart/form-data">
<div id="ksBoxContent">
	<div class="Created-push" id="active">
		<ul>
			
			<li>
				
				<div class="form-box form-upload-box">
					<div class="Created-ing">
					<ul>
						<?php    if($real['usertype'] == 1){ ?>  
						<li>
							<h4>真实姓名:</h4>
							<div class="Created-Content">
								<input type="text" name="realName" value="<?php if(isset($real["realName"]))echo $real["realName"];?>" class="new-form">	
							</div>
						</li>
						<li>
							<h4>所在地区:</h4>
						 	<?php 
								echo $link->Linkage(2);
						 	?>
						</li>
						
						<li>
							<h4>联系电话:</h4>
							<div class="Created-Content">
								<input type="text" name="tel" value="<?php if(isset($real["tel"]))echo $real["tel"];?>" class="new-from">					
							</div>
						</li>
						<li>
							<h4 style="top:10px;">授课内容:</h4>
							<div class="Created-Content clearfix">
								<input type="radio" class="fn" name="course_content" value="1" <?php if($real['course_content'] == 1)echo "checked";  ?> />K12
								<input type="radio" class="fn" name="course_content" value="2" <?php if($real['course_content'] == 2)echo "checked";  ?> />证书考试
								<input type="radio" class="fn" name="course_content" value="3" <?php if($real['course_content'] == 3)echo "checked";  ?> />技能培训
								<input type="radio" class="fn" name="course_content" value="4" <?php if($real['course_content'] == 4)echo "checked";  ?> />职场提升
								<input type="radio" class="fn" name="course_content" value="5" <?php if($real['course_content'] == 5)echo "checked";  ?> />兴趣爱好
								<input type="radio" class="fn" name="course_content" value="6" <?php if($real['course_content'] == 6)echo "checked";  ?> />其他
							</div>
						</li>
						<li>
							<h4 style="top:10px;">授课类型:</h4>
							<div class="Created-Content clearfix">
								<input type="checkbox" class="fn" name="course_type[]" value="直播" <?php if(in_array('直播',$real['course_type'])) echo "checked";?> />直播
								<input type="checkbox" class="fn" name="course_type[]" value="点播" <?php if(in_array('点播',$real['course_type'])) echo "checked";  ?> />点播
								<input type="checkbox" class="fn" name="course_type[]" value="音频" <?php if(in_array('音频',$real['course_type'])) echo "checked";  ?> />音频
								<input type="checkbox" class="fn" name="course_type[]" value="图文" <?php if(in_array('图文',$real['course_type'])) echo "checked";  ?> />图文
								<input type="checkbox" class="fn" name="course_type[]" value="题库" <?php if(in_array('题库',$real['course_type'])) echo "checked";  ?> />题库
							</div>
						</li>
						<li>
							<h4 style="top:10px;">授课情况:</h4>
							<div class="Created-Content clearfix">
								<input type="radio" class="fn"  name="course_case" value="1" <?php if($real['course_case'] == 1)echo "checked";  ?> />全职
								<input type="radio" class="fn"  name="course_case" value="2" <?php if($real['course_case'] == 2)echo "checked";  ?> />兼职
							</div>

						</li>
						<li>
							<h4 style="top: 8px;">身份证正面:</h4>
							<div class="Created-Content clearfix">
								<a href="javascript:;" style="position: relative;display: block;overflow: hidden;width: 415px;">
									<img width="415" src="<?php if(isset($real)) echo Img($real['realPhoto1']);?>" alt="" />
<!--									<input type="file" name="realPhoto1" id="" value="--><?php //if(isset($real)) echo Img($real['realPhoto1']);?><!--" style="position: absolute;top: 0px;left: 0px;right: 0px;bottom: 0px;opacity: 0;"/>-->
									<div class="Qet"><i class="iconfont icon-sousuo"></i></div>
								</a>
							</div>
						</li>

						<li>
							<h4 style="top:10px;">身份证反面:</h4>
							<div class="Created-Content clearfix">
								<a href="javascript:;" style="position: relative;display: block;overflow: hidden;width: 415px;">
									<img width="415" src="<?php if(isset($real)) echo Img($real['realPhoto2']);?>" alt="" />
<!--									<input type="file" name="realPhoto2" id="" value="--><?php //if(isset($real)) echo Img($real['realPhoto2']);?><!--" style="position: absolute;top: 0px;left: 0px;right: 0px;bottom: 0px;opacity: 0;"/>-->
									<div class="Qet"><i class="iconfont icon-sousuo"></i></div>
								</a>
							</div>
						</li> 
						
						<li>
							<h4 style="top:10px;">相关资质:</h4>
							<div class="Created-Content clearfix" style="width: 1200px">
								<?php foreach ($real['teacherPhoto'] as $v) {?>
								<a href="javascript:;" style="position: relative;display: block;overflow: hidden;width: 200px;float: left;">
									<img width="200px" src="<?php echo $v;?>" alt="" />
<!--									<input type="file" name="teacherPhoto[]" id="" value="--><?php //if(isset($real)) echo Img($real['teacherPhoto']);?><!--" style="position: absolute;top: 0px;left: 0px;right: 0px;bottom: 0px;opacity: 0;"/>-->
									<div class="Qet"><i class="iconfont icon-sousuo"></i></div>
								</a>
								<?php }?>
							</div>
						</li>
						
						<?php }elseif($real['usertype'] == 2){?>
						<li>
							<h4>公司名称:</h4>
							<div class="Created-Content">
								<input type="text" name="realName" value="<?php if(isset($real["realName"]))echo $real["realName"];?>" class="new-form">	
							</div>
						</li>
						
						<li>
							<h4>营业证件号:</h4>
							<div class="Created-Content">
								<input type="text" name="numberId" value="<?php if(isset($real["numberId"]))echo $real["numberId"];?>" class="new-form">	
							</div>
						</li>
						
						<li>
							<h4>所在地区:</h4>
						 	<?php 
								echo $link->Linkage(2);
						 	?>
						</li>
						<li>
							<h4>详细地址:</h4>
							<div class="Created-Content">
								<input type="text" name="address" value="<?php if(isset($real["address"]))echo $real["address"];?>" class="new-form">					
							</div>
						</li>
						<li>
							<h4>联系人:</h4>
							<div class="Created-Content">
								<input type="text" name="contacts" value="<?php if(isset($real["contacts"]))echo $real["contacts"];?>" class="new-form">					
							</div>
						</li>
						<li>
							<h4>联系电话:</h4>
							<div class="Created-Content">
								<input type="text" name="tel" value="<?php if(isset($real["tel"]))echo $real["tel"];?>" class="new-form">					
							</div>
						</li>
						<li>
							<h4>经营类别范围:</h4>
							<div class="Created-Content">
								<input type="text" name="range" value="<?php if(isset($real["range"]))echo $real["range"];?>" class="new-form">					
							</div>
						</li>
						<li>
							<h4 style="top: 8px;">身份证正面:</h4>
							<div class="Created-Content clearfix">
								<a href="javascript:;" style="position: relative;display: block;overflow: hidden;width: 415px;">
									<img width="415" src="<?php if(isset($real)) echo Img($real['realPhoto1']);?>" alt="" />
									<div class="Qet"><i class="iconfont icon-sousuo"></i></div>
<!--									<input type="file" name="realPhoto1" id="" value="--><?php //if(isset($real)) echo Img($real['realPhoto1']);?><!--" style="position: absolute;top: 0px;left: 0px;right: 0px;bottom: 0px;opacity: 0;"/>-->
								</a>
							</div>
						</li>
						<li>
							<h4 style="top:10px;">身份证反面:</h4>
							<div class="Created-Content clearfix">
								<a href="javascript:;" style="position: relative;display: block;overflow: hidden;width: 415px;">
									<img width="415" src="<?php if(isset($real)) echo Img($real['realPhoto2']);?>" alt="" />
									<div class="Qet"><i class="iconfont icon-sousuo"></i></div>
<!--									<input type="file" name="realPhoto2" id="" value="--><?php //if(isset($real)) echo Img($real['realPhoto2']);?><!--" style="position: absolute;top: 0px;left: 0px;right: 0px;bottom: 0px;opacity: 0;"/>-->
								</a>
							</div>
						</li> 
						<li>
							<h4 style="top:10px;">
                                <?php  echo $real['usertype']==1?'教师资格证':'营业执照' ?>
                           
                            </h4>
							<div class="Created-Content clearfix">
								<a href="javascript:;" style="position: relative;display: block;overflow: hidden;width: 415px;">
									<img width="415" src="<?php if(isset($real)) echo Img($real['teacherPhoto']);?>" alt="" />
									<div class="Qet"><i class="iconfont icon-sousuo"></i></div>
<!--									<input type="file" name="teacherPhoto" id="" value="--><?php //if(isset($real)) echo Img($real['teacherPhoto']);?><!--" style="position: absolute;top: 0px;left: 0px;right: 0px;bottom: 0px;opacity: 0;"/>-->
								</a>
							</div>
						</li>
						<?php }?>
						<li>
                            <h4 style="top:10px;">审核状态:</h4>
                            <div class="Created-Content clearfix">
                                <input type="radio" class="fn" onclick="$('#showresult').hide();$('#sendsms').show()" name="status" value="1" <?php if($real['status'] == 1)echo "checked";  ?> />通过审核
                                <input type="radio" class="fn" onclick="$('#showresult').show();$('#sendsms').hide()" name="status" value="2" <?php if($real['status'] == 2)echo "checked";  ?> />审核不通过
                            </div>
						  	
						</li>
                        <li id="showresult" <?php if($real['status'] == 1 || $real['status']==0)echo " style='display:none'";  ?>>
                            <h4 style="top:10px;">审核不通过原因:</h4>
                            <div class="Created-Content clearfix">
                                <textarea name='result' style='width:420px;height:90px'><?php echo $real['result']; ?></textarea>
                            </div>
                        </li>
						<li id="sendsms" <?php if($real['status'] == 1 || $real['status']==0)echo " style='display:none'";  ?>>
							<h4 style="top:10px;">是否短信通知:</h4>
							<div class="Created-Content clearfix">
								<input type="radio" class="fn" name="is_sms" value="1" checked />是
								<input type="radio" class="fn" name="is_sms" value="2"  />否
							</div>

						</li>
					</ul>
					
				</div>
			
				</div>
				
				
			</li>
		</ul> 
		
	</div>
	
</div>

	
	<div class="footer-page">
        <div class="col-sm-5"></div>
        <div class="col-sm-6 mt10">
            <?php if ($real['status'] != 1) {?>
            <button type="submit" class="btn btn-default btn-s-md " >确定修改</button>
            <a href="javascript:history.go(-1);" class="btn bt-gray btn-s-md">取消修改</a> 
            <?php
             }else{?>
            <a href="javascript:history.go(-1);" class="btn bt-gray btn-s-md">取消返回</a>
            <?php }?>
        </div>
    </div>
</form>
<div id="hidebg"></div>
<div id="hidebox"  onClick="hide();">
	<i class="iconfont icon-shanchu"></i>
	<img onmousewheel="return bbimg(this)"/>
</div><!--/footer-->
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
	$(".Qet").click(function(){
		var src=$(this).siblings("img").attr("src")	;
		show(src);
	})
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
