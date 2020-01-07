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
<link href="<?php echo UOOT;?>Public/app/css/live.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/main.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="//www.ketangjie.cn/Public/admin/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />

<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<!--<link href="Public/app/css/layer.css?<?php echoHash(); ?>" rel="stylesheet" />-->
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<style>

.form-control {width:300px;}
.form-control:focus,.new-form:focus {border-color: #545ca6 !important;border-width:1px !important;box-shadow:none!important}
#vodInfo {width: 120px;overflow:hidden;margin-top: 20px;padding: 10px;border: 1px solid #eee;}
.special-textarea{
	min-height: 120px;
}
input[type='radio']{
	width: 25px;
    height: 20px;
    margin-left: 10px;
}
</style>
</head>

<body class="bg-gary" style="padding:15px">
<div class="">
 <ul class="nav nav-tabs">
    <li class=" fl"><a href="<?php echo M_URL($this->AppName.'/index','index','',GP('')); ?>">课程管理</a></li>
    <li class="active fl"><a href="<?php echo M_URL('course/index','basics','',GP(''))  ?>">课程编辑</a></li>
 </ul>
   <?php include CURR_VIEW_PATH.'head.php';?>
</div>   
    
<div class="courseBox clearfix mt20" style="margin-top: <?php if(isset($course)){echo '140px';}else{echo '40px';} ?> " >
   
    <?php 
	
			
	 if(!empty($courseid)) {
	      $nav='
		   <div class="lLightBox spec bg-white  pt30 borderSo" style="box-shadow: 0 1px 1px rgba(0, 0, 0, .05);">
		   <ul>
            <li class=" curr">
                <em class="vLine "></em>
                <a href="javascript:void(0)" class="firstN fsize14 c-92">课程资料</a>
                <div class="liveCsecond spec2 pl20"  style="display:block">
                    <a href="'.M_URL($this->AppName.'/index','basics',$courseid,GP('')).'"   class="block curr fsize14 ">基本资料</a>
                    <a href="'.M_URL($this->AppName.'/index','info',$courseid,GP('')).'"  class="block fsize14">详细资料</a>
                   
                </div>
            </li>
			<li >
                <em class="vLine "></em>
                <a href="'.M_URL($this->AppName.'/index','uploadfile',$courseid,GP('')).'"  class="firstN fsize14 c-92">上传文件</a>
            </li>
            <li >
                <em class="vLine "></em>
                <a href="'.M_URL($this->AppName.'/index','period',$courseid,GP('')).'" class="firstN fsize14 c-92">课程学时</a>
            </li>
			 <li class="posRe pl50  mb20">
                <em class="vLine bg-green posAb"></em>
                <a href="'. M_URL($this->AppName.'/index','teacher',$courseid,GP('')).'"   class="firstN fsize14 c-92">教师管理</a>
            </li>
            <li >
                <em class="vLine "></em>
                 <a href="'.M_URL($this->AppName.'/index','student',$courseid,GP('')).'"  class="firstN fsize14 c-92">课程学员</a>
                
            </li>
             <li >
                <em class="vLine "></em>
                <a href="'.M_URL($this->AppName.'/index','comment',$courseid,GP('')).'"  class="firstN fsize14  c-92">评论管理</a>
            </li>
			 <li >
                <em class="vLine "></em>
                <a href="'.M_URL($this->AppName.'/index','exam',$courseid,GP('')).'"  class="firstN fsize14  c-92">考试管理</a>
            </li>
            </li>
			 <li>
                <em class="vLine "></em>
                 <a href="'.M_URL($this->AppName.'/index','kpoint',$courseid,GP('')).'"  class="firstN fsize14 c-92">知识点管理</a>
            </li>
        </ul>
		</div>';}
		else{
			$nav=' 
			 <div class="lLightBox spec bg-white  pt30 borderSo" style="box-shadow: 0 1px 1px rgba(0, 0, 0, .05)";>
			<ul>
            <li class="posRe pl50 mb20 curr">
                <em class="vLine "></em>
                <a href="javascript:void(0)" class="firstN fsize14 c-92">课程资料</a>
                <div class="liveCsecond  pl20"  style="display:block">
                    <a href="'.M_URL($this->AppName.'/index','basics',$courseid,GP('')).'"   class="block curr fsize14 ">基本资料</a>
                    <a  class="block fsize14 c-c6">详细资料</a>
                    <a class="block fsize14 c-c6" >SEO设置</a>
                </div>
            </li>
            <li class="posRe pl50 mb20">
                <em class="vLine bg-green posAb"></em>
                <a class="fsize14 c-c6">课程学时</a>
            </li>
            <li class="posRe pl50 mb20">
                <em class="vLine bg-green posAb"></em>
                 <a class=" fsize14 c-c6">课程学员</a>
                
            </li>
            <li class="posRe pl50 mb20">
                <em class="vLine bg-green posAb"></em>
                <a class="fsize14 c-c6">课程评论</a>
                
            </li>
            <li class="posRe pl50 mb20">
                <em class="vLine bg-green posAb"></em>
                 <a class="fsize14 c-c6">房间设置</a>
            </li>
        </ul>
			 </div>
		 	 ';  
		}
	    echo $nav;   
	
	   ?>
    </div>
    <div class="lRightBox" id="lRightBox" style="box-shadow: 0 1px 1px rgba(0, 0, 0, .05);">
         <div class="sRightBox ml20 bg-white  borderSo pt30">
	     <form target="hidframe"  id="myform"  action="<?php if(isset($course)){echo M_URL($this->AppName.'/index','doedit',$courseid,GP(''));}
		  else{echo M_URL($this->AppName.'/index','doadd','',GP(''));} ?>" method="post" enctype="multipart/form-data">
		     <div class="blank10"></div>
			 <table width="95%" cellpadding="0" cellspacing="0" border="0" class="gTable mt-20 mlr">
             <?php if(empty($courseid)){ ?>
                  <tr>
					 <td class="leftTd alignRight fsize16 c-666 w180 pr20 borderBda">当前用户</td>
					 <td class="leftTd alignLife fsize12 c-92 pr10 borderBda">
					      <?php echo  $this->userinfo['username'] ?> 
                          <a onClick="addTypeChange('<?php echo M_URL($this->AppName.'/index','selectUser','',GP(''));?>','800px','600px');">更改</a>
					 </td>
				 </tr>
                 <?php } ?>
				 <tr>
					 <td class="leftTd alignRight fsize16 c-666 w180 pr20 borderBda">课程Logo</td>
					 <td class="leftTd alignLife fsize12 c-92 pr10 borderBda">
					
					    <div class="control-group2 js_uploadBox">
							<div class="userBox fl js_showBox">
                            <img class="js_logoBox block"
                            <?php if(isset($course["defaultpic"])){ ?>
                               src="<?php echo Img($course["defaultpic"]) ?>" width="180";
                               <?php }else{ ?>
								src="<?php echo UOOT ?>Public/uploads/common/timg.jpg" width="180";
							<?php }?>
                             height="120" ></div>
							<div class="fl c-red fsize14 hLh48 ml30 mt30 selectImageBtn">点击上传</div>
							<div class="btn-upload clearfix">
							  <a href="javascript:void(0);"><span class="js_uploadText"></span></a>
							  <input class="hide js_upFile"   type="file" name="defaultpic" id="upImg">
							</div>
						</div>
					 </td>
				 </tr>
				 <tr>
					 <td class="leftTd alignRight fsize16 c-666 w180 pr20 borderBda">课程名称</td>
					 <td class="leftTd alignLife fsize12 c-92 pr10 borderBda">
					    <input type="text" class="form-control"  name="title"
                        value="<?php if(isset($course["title"])) echo $course["title"] ?>">
					 </td>
				 </tr>
				 <?php if(!empty($category)){?>
                  <tr>
					 <td class="leftTd alignRight fsize16 c-666 w180 pr20 borderBda">课程类别</td>
					 <td class="leftTd alignLife fsize12 c-92 pr10 borderBda">
					     <?php 
							   echo $Linkage->Linkage(1);
							?>
					 </td>
				 </tr>
				<?php }?>
				 <tr>
					 <td class="leftTd alignRight fsize16 c-666 w180 pr20 borderBda">是否启用章节</td>
					 <td class="leftTd alignLife fsize12 c-92 pr10 borderBda">
						 <label class="radioLabel fl">
							 <input type="radio" name="enablechapter" class="radioInput" value="1" 
                   <?php if(isset($course["enablechapter"])){if($course["enablechapter"]==1)echo "checked"; }?> checked>
							 <span class="radioName fsize14 c-92">是</span>
						 </label>
						 <label class="radioLabel fl">
							 <input type="radio" name="enablechapter" class="radioInput" value="0"
                <?php if(isset($course["enablechapter"])){if($course["enablechapter"]==0)echo "checked"; }?> >
							 <span class="radioName fsize14 c-92">否</span>
						 </label>

					 </td>
				 </tr>
                 
                  <tr>
					 <td class="leftTd alignRight fsize16 c-666 w180 pr20 borderBda">课程形式</td>
					 <td class="leftTd alignLife fsize12 c-92 pr10 borderBda">
						 <label class="radioLabel fl">
							 <input type="radio" name="courseType" class="radioInput" value="1" 
                 <?php if(isset($course['courseType'])){if($course['courseType']==1)echo "checked"; }?>>
							 <span class="radioName fsize14 c-92">点播</span>
						 </label>
						 <label class="radioLabel fl">
							 <input type="radio" name="courseType" class="radioInput" value="2"
                <?php if(isset($course['courseType'])){if($course['courseType']==2)echo "checked"; }?> >
							 <span class="radioName fsize14 c-92">直播</span>
						 </label>
                         <label class="radioLabel fl">
							 <input type="radio" name="courseType" class="radioInput" value="3"
                <?php if(isset($course['courseType'])){if($course['courseType']==3)echo "checked"; }else{echo 'checked'; }?> >
							 <span class="radioName fsize14 c-92">音频</span>
						 </label>
						 <label class="radioLabel fl">
							 <input type="radio" name="courseType" class="radioInput" value="3"
                <?php if(isset($course['courseType'])){if($course['courseType']==4)echo "checked"; }else{echo 'checked'; }?> >
							 <span class="radioName fsize14 c-92">图文</span>
						 </label>

					 </td>
				 </tr>
                 
				 <tr>
					 <td class="leftTd alignRight fsize16 c-666 w180 pr20 borderBda">课程简要介绍</td>
					 <td class="leftTd alignLife fsize12 c-92 pr10 borderBda">
					    <textarea type="text"  class="form-control special-textarea" name="intro"><?php if(isset($course["intro"])) echo $course["intro"] ?></textarea>
					 </td>
				 </tr>
				 <tr>
					 <td class="leftTd alignRight fsize16 c-666 w180 pr20 borderBda">收费方式</td>
					 <td class="leftTd alignLife fsize12 c-92 pr10 borderBda">
					    <label class="radioLabel fl">
						  <input type="radio" name="chargetype" class="radioInput" value="0"
                        <?php if(isset($course["chargetype"])){if($course["chargetype"]==0)echo "checked"; }else{echo 'checked'; }?>>
						  <span class="radioName fsize14 c-92">免费</span>
					    </label>
					    <label class="radioLabel fl">
						  <input type="radio" name="chargetype" class="radioInput" value="2"
                         <?php if(isset($course["chargetype"])){if($course["chargetype"]==2)echo "checked"; }?>>
						  <span class="radioName fsize14 c-92">打赏</span>
					    </label>
						<label class="radioLabel fl">
						  <input type="radio" name="chargetype" class="radioInput" value="1"
                         <?php if(isset($course["chargetype"])){if($course["chargetype"]==1)echo "checked"; }?>>
						  <span class="radioName fsize14 c-92">收费</span>
					    </label>
					 </td>
				 </tr>
				 <tr>
					 <td class="leftTd alignRight fsize16 c-666 w180 pr20 borderBda">参考价</td>
					 <td class="leftTd alignLife fsize12 c-92 pr10 borderBda">
					    <input type="numebr" class="form-control"   name="price_market"
                        value="<?php if(isset($course["price_market"])) echo $course["price_market"] ?>">
					 </td>
				 </tr>
				 <tr>
					 <td class="leftTd alignRight fsize16 c-666 w180 pr20 borderBda">折扣</td>
					 <td class="leftTd alignLife fsize12 c-92 pr10 borderBda">
					    <input type="number" class="form-control"  name="discount"
                       value="<?php if(isset($course["discount"])) echo $course["discount"] ?>">
					 </td>
				 </tr>
				
				 <tr>
					 <td class="leftTd alignRight fsize16 c-666 w180 pr20 borderBda">销售价</td>
					 <td class="leftTd alignLife fsize12 c-92 pr10 borderBda">
					    <input type="number" class="form-control"  name="price"
                        value="<?php if(isset($course["price"])) echo $course["price"] ?>">
					 </td>
				 </tr>
				 <tr>
					 <td class="leftTd alignRight fsize16 c-666 w180 pr20 borderBda">购买后有效天数</td>
					 <td class="leftTd alignLife fsize12 c-92 pr10 borderBda">
					    <input type="number" class="form-control"  name="validedays"
                        value="<?php if(isset($course["validedays"])) echo $course["validedays"] ?>">
					 </td>
				 </tr>
				
               <?php if(isset($course)){ ?>
                 <tr>
                 <td class="leftTd alignRight fsize16 c-666 w180 pr20 borderBda"> 是否通过审核</td>
                   <td><label class="radioLabel fl">
		 <input type="radio" name="status" class="radioInput jq" value="2"<?php if($course["status"]==1||$course["status"]==2) echo "checked";?>>
		  <span class="radioName fsize14 c-92">通过审核</span>
		   </label>
		  <label class="radioLabel fl">
	     <input type="radio" name="status" class="radioInput jq" value="0"<?php if($course["status"]==0) echo "checked";?>>
		  <span class="radioName fsize14 c-92">取消审核</span>
		  </label></td>
          </tr>
          <?php }?>
                 <tr>
					 <td class="leftTd alignRight fsize16 c-79 w100p pr20"></td>
					 <td class="leftTd alignLife fsize12 c-92 pr10">
                     <input type="button" onClick="do_reg()" class="generalBtn c-fff fsize16 bRadius5" value="确认" name="confirm"></td>
				 </tr>
			  </table>
			  <div class="blank30"></div>
		  </form>
	  </div>
    </div>
</div>

<script src="<?php echo UOOT;?>Public/common/js/common.js" type="text/javascript"></script>
<script>
IncreaseClass(140,'.spec ul>li','.spec2>a','.spec2');
uploadView('100','100');
loadScorllJs();
$(function(){
  $(".jq").click(function(){
    var status = $(this).val();
	$.ajax({
                type: "POST",
                url:"<?php echo M_URL('course/Ajax','audited',$courseid,GP('')) ?>",
                data:{status:status},
                success:function(text){
                if(text == 0){
                    alert("取消审核成功");
                }else if(text == 2){
                    alert("审核成功");
                }},
             error:function(){
                 alert("发生了错误,请检查!");
             }
      });
  });
 });
</script>
<script>
function do_reg()
{
	var title = $("input[name='title']").val();
	var price_market = $("input[name='price_market']").val();
	var number = $("input[name='number']").val();
	var discount = $("input[name='discount']").val();
	var price = $("input[name='price']").val();
	/*数字验证*/
	var num =/^\d+(\.\d+)?$/;
    if(title==''){
		Alert('课程名称');
		return false;	
    }	
	if(!num.test(price_market)){
	    Alert('参考价请输入数字');
		return false;
	}
	if(!num.test(discount)){
	    Alert('折扣');
		return false;
	}
	if(!num.test(price)){
	    Alert('销售价');
		return false;
	}
	$("#myform").submit();	
}
</script>

</body>
</html>
