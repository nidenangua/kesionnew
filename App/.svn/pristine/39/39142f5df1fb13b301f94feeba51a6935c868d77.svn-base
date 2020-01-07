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
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="//www.ketangjie.cn/Public/admin/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/common/css/laydate.css" rel="stylesheet">
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<script src="<?php echo UOOT;?>Public/common/js/aliyun/vod-sdk-upload-1.0.6.min.js" type="text/javascript"></script>
<script src="<?php echo UOOT;?>Public/common/js/aliyun/aliyun-sdk.min.js" type="text/javascript"></script>

 <style>
 .laydate-icon {
border: 1px solid #ccc;
background-image: url(<?php echo UOOT;?>Public/admin/images/icon.png);
height:37px
}
 </style>
</head>
<body class="bg-gary p15">
<div >
 <ul class="nav nav-tabs">
    <li class="active fl"><a href="<?php echo M_URL($this->AppName.'/index','index','',GP('')); ?>">课程管理</a></li>
    <li class="fl"><a href="<?php echo M_URL('course/index','basics','',GP(''))  ?>">课程编辑</a></li>
 </ul>
<?php include CURR_VIEW_PATH.'head.php';?>
 </div> 
<div class="courseBox clearfix mt20">
    <div class="lLightBox bg-white bRadius10 pt30 borderSo">
         <ul>
            <li class="posRe pl50 mb20">
                <em class="vLine bg-green posAb"></em>
                <a href="javascript:void(0)" class="firstN fsize14 c-92">课程资料</a>
                <div class="liveCsecond pl20" style="display:block">
                    <a href="<?php echo M_URL($this->AppName.'/index','basics',$courseid,GP('')) ?>"    class="block  fsize14 ">基本资料</a>
                    <a href="<?php echo M_URL($this->AppName.'/index','info',$courseid,GP('')) ?>"  class="block  fsize14">详细资料</a>
                    <!-- <a href="<?php echo M_URL($this->AppName.'/index','seo',$courseid,GP('')) ?>"  class="block fsize14" >SEO设置</a> -->
                </div>
            </li>
           
            <li class="posRe pl50 mb20 curr">
                <em class="vLine bg-green posAb"></em>
                <a href="<?php echo M_URL($this->AppName.'/index','period',$courseid,GP('')) ?>"  class="firstN fsize14 c-92">课程学时</a>
            </li>
              <li class="posRe pl50 mb20 ">
                <em class="vLine bg-green posAb"></em>
                <a href="<?php echo M_URL($this->AppName.'/index','uploadfile',$courseid,GP('')) ?>"  class="firstN fsize14  c-92">上传文件</a>
            </li>
            <li class="posRe pl50 mb20">
                <em class="vLine bg-green posAb"></em>
                <a href="<?php echo M_URL($this->AppName.'/index','student',$courseid,GP('')) ?>"   class="firstN fsize14 c-92">课程学员</a>

            </li>
            <li class="posRe pl50 mb20 ">
                <em class="vLine bg-green posAb"></em>
                <a href="<?php echo M_URL($this->AppName.'/index','comment',$courseid,GP('')) ?>" class="firstN fsize14  c-92">评论管理</a>
            </li>
             <li class="posRe pl50 mb20 ">
                <em class="vLine bg-green posAb"></em>
                <a href="<?php echo M_URL($this->AppName.'/index','exam',$courseid,GP('')) ?>"  class="firstN fsize14  c-92">考试管理</a>
            </li>
            <li class="posRe pl50 mb20">
                <em class="vLine bg-green posAb"></em>
                  <a href="<?php echo M_URL($this->AppName.'/index','room',$courseid,GP('')) ?>" class="firstN fsize14 c-92">房间管理</a>
            </li>
        </ul>
    </div>
    <div class="sRightBox ml20 bg-white bRadius10 borderSo pt20" style="margin-left:220px">
         <div class="courseKeshi">
<form target="hidframe" id="myform"  action="<?php  if($typeKeshi == 'add'){echo M_URL($this->AppName.'/index','doaddkeshi',$courseid,GP(''));}else{echo M_URL($this->AppName.'/index','doeditkeshi',$courseid,$now_page,GP("chapterid=$chapterid"));} ?>" method="post" class="form-horizontal">
     <table width="100%" cellpadding="0" cellspacing="0" border="0" class="gTable">
        <tr>
            <td class="leftTd alignRight fsize16 c-79 w100p borderBda pr20">课时类型</td>
            <td class="leftTd alignLife fsize12 c-92 pr10 borderBda">
                <select name="chaptertype" class="inputText bRadius5 w300 pl30 valid" onchange="getChoice(this)" id="type" aria-invalid="false">
                    <option value="1" <?php if($type==1) echo 'selected' ?>>点播</option>
                    <option value="2" <?php if($type==2) echo 'selected' ?>>直播</option>
                    <option value="3" <?php if($type==3) echo 'selected' ?>>面授</option>                  
                </select>
            </td>

        </tr>
      <tr>
	     <td class="leftTd alignRight fsize16 c-79 w150">标题</td>
		 <td class="rightTd alignLife">
		   <input type="text" name="title" value="<?php if(isset($chapter))echo $chapter["title"]; ?>" class="inputText bRadius5 w400 c-79" required>
           <label class="radioLabel fr " style="padding-right:100px;padding-top:5px">
				<input type="checkbox" name="chargetype" class="radioInput"  value="1"  <?php if(isset($chapter)){if($chapter["chargetype"]==1) echo "checked";}?> >
				<span class="radioName fsize16 c-92">免费课时</span>
			</label>
		 </td>
	   </tr>
	   <tr>
	     <td class="leftTd alignRight fsize16 c-79 w150">所属章节</td>
		 <td class="rightTd alignLife">
             <select class="inputText bRadius5 w400 c-79 mr30" name="parentid">
                 <?php
				  if(isset($chapterAll)){ 
				  echo "<option value='0'>无--作为一级分类</option>";
					foreach($chapterAll as $k=>$v){
						 $html="<option value='$v[chapterid]' ";
                       if($v['chapterid']==$parentid)
                       {
                           $html=$html."selected = 'selected'";
                       }
                       $html=$html.">".KS_INDENT($v['depth'])."$v[title]</option>" ;

                       echo $html;
					}
				  }else{
					  echo "<option value='0'>无--作为一级分类</option>";
					  }
                    ?>
            </select>
		 </td>
	   </tr>
       <tr>
           <td>    <A href="javascript:void(0)"
              <?php if(isset($chapter)){ ?>
             onclick="addCourseKpoint('<?php echo M_URL($this->AppName.'/index','addKpoint',$courseid,GP('chapterid-'.$chapter['chapterid'])) ?>')"
             <?php  }else{ ?>
              onclick="addCourseKpoint('<?php echo M_URL($this->AppName.'/index','addKpoint',$courseid,GP('')) ?>')"
             <?php } ?>  
            class="fr btn-blue c-fff bRadius5 alignCenter hLh30 fsize14 w93 bg-2d" id="addStudent">+知识点</A></td>
       </tr>
       <tr>
             <td>该课时所绑定知识点</td>
             <td id="knowledge">
               <?php if(isset($values))foreach($values as $k=>$v){ ?>
                    <li class="chapterKption" id="kption<?php echo $v['id'] ?>"><?php  echo $v['title'] ?><button type="button" onclick="delKption(<?php echo $v['id'] ?>)">删除</button>
			        <input type="hidden" name="kpoint[]" value="<?php echo $v['id'] ?>" /></li>
               <?php } ?>
             </td>
       </tr>
       <tr>
	     <td class="leftTd alignRight fsize16 c-79 w150">简介</td>
		 <td class="rightTd alignLife">
		 	<textarea class="inputText bRadius5 w400 c-79" name="intro"><?php if(isset($chapter))echo $chapter["intro"]; ?></textarea>
		 </td>
	   </tr>
       </table>
     <table width="100%" cellpadding="0" cellspacing="0" border="0" class="gTable">
     <!--点播-->
    <tbody class="itemBox"  id="point" style="display:table-row-group"> 
     <tr >
	     <td class="leftTd alignRight fsize16 c-79 w150">类型</td>
		 <td class="rightTd alignLife">
							<label class="radioLabel fl">
								<input type="radio" name="playtype"  class="radioInput"  value="0" <?php if(isset($chapter)){if($chapter["playtype"]==0) echo "checked";}else{echo "checked";} ?>>
								<span class="radioName fsize16 c-92">视频</span>
							</label>
							<label class="radioLabel fl">
								<input type="radio" name="playtype" class="radioInput" value="1" <?php if(isset($chapter)){if($chapter["playtype"]==1) echo "checked";} ?>>
								<span class="radioName fsize16 c-92">音频</span>
							</label>
                            <label class="radioLabel fl">
								<input type="radio" name="playtype" class="radioInput" value="2" <?php if(isset($chapter)){if($chapter["playtype"]==2) echo "checked";} ?>>
								<span class="radioName fsize16 c-92">Flash</span>
							</label>
							<label class="radioLabel fl">
								<input type="radio" name="playtype" class="radioInput"  value="3" <?php if(isset($chapter)){if($chapter["playtype"]==3) echo "checked";} ?>>
								<span class="radioName fsize16 c-92">图文</span>
							</label>
                            <label class="radioLabel fl">
								<input type="radio" name="playtype" class="radioInput"  value="4" <?php if(isset($chapter)){if($chapter["playtype"]==4) echo "checked";} ?>>
								<span class="radioName fsize16 c-92">PPT</span>
							</label>
						</td>
	   </tr>
       <tr>
	     <td class="leftTd alignRight fsize16 c-79 w150"><input type="file" name="file" id="files" multiple/></td>
		 <td class="rightTd alignLife">
		 	<button type="button" onClick="startabc()" >上传文件</button>
            <div id="progressbar"></div>
		 </td>
	   </tr>
        <tr>
	     <td class="leftTd alignRight fsize16 c-79 w150"><input type="file" name="file" id="files" multiple/></td>
		 <td class="rightTd alignLife">
		 	<button type="button" onClick="startcba()" >上传文件百度</button>
            <div id="progressbar"></div>
		 </td>
	   </tr>
        <tr>
	     <td class="leftTd alignRight fsize16 c-79 w150">课程时长</td>
		 <td class="rightTd alignLife">
		 	<input type="text" name="playtime1" value="<?php if(isset($chapter))echo $chapter["playtime"]; ?>" class="inputText bRadius5 w400 c-79">
		 </td>
	   </tr>
	   <tr>
	     <td class="leftTd alignRight fsize16 c-79 w150">视频
         <button type="button" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/index','getVodList',$courseid,'',GP("chapterid-0")) ?>','850px','600px');">
         获取视频列表</button></td>
		 <td class="rightTd alignLife">
		 	<input type="text" readonly name="playurl1" id="playurl1" value="<?php if(isset($chapter))echo $chapter["videoId"]; ?>" class="inputText bRadius5 w400 c-79">
		 </td>
	   </tr>
	   <tr>
	     <td class="leftTd alignRight fsize16 c-79 w150">购买后有效天数</td>
		 <td class="rightTd alignLife">
		   <input type="text" name="validedays" value="<?php if(isset($chapter))echo $chapter["validedays"]; ?>" class="inputText bRadius5 w400 c-79">
		 </td>
	   </tr>
	 
	 
	  </tbody>
      <!--直播-->
      <tbody class="itemBox" id="live">
        <tr>
	     <td class="leftTd alignRight fsize16 c-79 w150">课程时长</td>
		 <td class="rightTd alignLife">
		 	<input type="text" name="playtime2" value="<?php if(isset($chapter))echo $chapter["playtime"]; ?>" class="inputText bRadius5 w400 c-79">
		 </td>
	   </tr>
       <tr>
	     <td class="leftTd alignRight fsize16 c-79 w150">直播视频类型</td>
		 <td class="rightTd alignLife">
		 	<select name="serverid" class="inputText bRadius5 w300 pl30 valid">
               <option value="0">KS云</option>
               <option value="1">其他</option>
            </select>
		 </td>
	   </tr>
      </tbody>
      <!--面授-->
      <tbody class="itemBox"  id="buy613">
       
       
      </tbody>
	 <!--  <tr>
	     <td class="leftTd alignRight w150"></td>
		 <td class="rightTd alignLife"></td>
	   </tr>-->
      
	 </table>
     
     <table id="shownone" width="100%" cellpadding="0" cellspacing="0" border="0" class="gTable">
     <tr>
	     <td class="leftTd alignRight fsize16 c-79 w150">开始时间</td>
		 <td class="rightTd alignLife">
		 	<input id="start" type="text" name="begindate2" value="<?php if(isset($chapter))echo $chapter["begindate"]; ?>" class="inputText start laydate-icon bRadius5 w400 c-79">
		 </td>
	   </tr>
       <tr>
        <tr>
	     <td class="leftTd alignRight fsize16 c-79 w150">结束时间</td>
		 <td class="rightTd alignLife">
		 	<input id="end" type="text" name="enddate2" value="<?php if(isset($chapter))echo $chapter["enddate"]; ?>" class="inputText  laydate-icon bRadius5 w400 c-79">
		 </td>
	   </tr>
     </table>
<input  type="button" onClick="do_reg()" class="generalBtn c-fff fsize16 bRadius5" value="确认" name="confirm">
	   </form>
                   </div><!--courseKeshi-->
            <div class="clear blank30"></div>
            <div class="clear blank30"></div>
        </div>

    <!--lRightBox-->
<input type="hidden" id="uploadAuth" size="20" value="">
<input type="hidden" id="uploadAddress" size="20" value="">
<input type="hidden" id="accessKeyId" size="20" value="">
<input type="hidden" id="accessKeySecret" size="40" value="">
<input type="hidden" id="secretToken" size="40" value="">
<input type="hidden" id="expireTime" size="20" value="">
<input type="hidden" id="endpoint" size="40" value="">
<input type="hidden" id="bucket" size="20" value="">
<input type="hidden" id="objectPre" size="20" value="uploadtest/">

<script>
  	var uploader;
	function startabc(){
        var files = document.getElementById("files").files;
		data = {"filename":(files[0].name),"filesize":(files[0].size)};
	    var url = '<?php echo M_URL($this->AppName.'/Ajax','getAuther','',GP('')) ;?>';
	    $.ajax({
	        type : "post",
	        url : url,
			data : data,
	        success:function(data){ 
			    var obj = JSON.parse(data);
				$('#uploadAddress').val(obj.UploadAddress);
				$('#uploadAuth').val(obj.UploadAuth);
				$('#playurl1').val(obj.VideoId); 
			    start();
			}
		});		
	}
    window.onload = new function() {
        uploader = new VODUpload({
            // 文件上传失败
            'onUploadFailed': function (uploadInfo, code, message) {
				alert(上传失败);     
            },
            // 文件上传完成
            'onUploadSucceed': function (uploadInfo) {
                 var str = JSON.stringify(uploadInfo);	
            },
            // 文件上传进度
            'onUploadProgress': function (uploadInfo, totalSize, uploadedSize) {
				
				$('#progressbar').html("onUploadProgress:file:" + uploadInfo.file.name + ", fileSize:" + totalSize + ", percent:" + Math.ceil(uploadedSize * 100 / totalSize) + "%");
                
            },
            // STS临时账号会过期，过期时触发函数
            'onUploadTokenExpired': function () {
    
                if (isVodMode()) {
                    // 实现时，从新获取UploadAuth
                     uploader.resumeUploadWithAuth(uploadAuth);
                } else if (isSTSMode()) {
                    // 实现时，从新获取STS临时账号用于恢复上传
                     uploader.resumeUploadWithToken(accessKeyId, accessKeySecret, secretToken, expireTime);
                }
            },
            // 开始上传
            'onUploadstarted': function (uploadInfo) {
                if (isVodMode()) {
					
                    var uploadAuth = document.getElementById("uploadAuth").value;
                    var uploadAddress = document.getElementById("uploadAddress").value;
                    uploader.setUploadAuthAndAddress(uploadInfo, uploadAuth, uploadAddress);
                }
                
            }
        });

        var accessKeyId = document.getElementById("accessKeyId").value;
        var accessKeySecret = document.getElementById("accessKeySecret").value;
        var secretToken = document.getElementById("secretToken").value;
        var expireTime = document.getElementById("expireTime").value;

        if (isVodMode()) {
            // 点播上传。每次上传都是独立的鉴权，所以初始化时，不需要设置鉴权
            uploader.init();
        } else if (isSTSMode()) {
            // OSS直接上传:STS方式，安全但是较为复杂，建议生产环境下使用。
            // 临时账号过期时，在onUploadTokenExpired事件中，用resumeWithToken更新临时账号，上传会续传。
            uploader.init(accessKeyId, accessKeySecret, secretToken, expireTime);
        } else {
            // OSS直接上传:AK方式，简单但是不够安全，建议测试环境下使用。
            uploader.init(accessKeyId, accessKeySecret);
        }
    };

    document.getElementById("files")
        .addEventListener('change', function (event) {
            var endpoint = document.getElementById("endpoint").value;
            var bucket = document.getElementById("bucket").value;
            var objectPre = document.getElementById("objectPre").value;
            var userData;
            if (isVodMode()) {
                userData = '{"Vod":{"UserData":"{"IsShowWaterMark":"false","Priority":"7"}"}}';
            } else {
                userData = '{"Vod":{"Title":"this is title.我是标题","Description":"this is desc.我是描述","CateId":"19",\
                "Tags":"tag1,tag2,标签3","UserData":"user data"}}';
            }
            for(var i=0; i<event.target.files.length; i++) {
                
                if (isVodMode()) {
                    // 点播上传。每次上传都是独立的OSS object，所以添加文件时，不需要设置OSS的属性
                    uploader.addFile(event.target.files[i], null, null, null, userData);
                } else {
                    uploader.addFile(event.target.files[i], endpoint, bucket, objectPre + event.target.files[i].name, userData);
                }
            }
        });

    var textarea=document.getElementById("textarea");

    function start() {
        uploader.startUpload();
    }

    function stop() {
      
        uploader.stopUpload();
    }

    function resumeWithToken() {

        var uploadAuth = document.getElementById("uploadAuth").value;

        var accessKeyId = document.getElementById("accessKeyId").value;
        var accessKeySecret = document.getElementById("accessKeySecret").value;
        var secretToken = document.getElementById("secretToken").value;
        var expireTime = document.getElementById("expireTime").value;

        if (isVodMode()) {
            uploader.resumeUploadWithAuth(uploadAuth);
        } else if (isSTSMode()) {
            uploader.resumeUploadWithToken(accessKeyId, accessKeySecret, secretToken, expireTime);
        }
    }

    $('#files').on('click',function(){
		
        uploader.cleanList();
	
	});

    function getList() {

        var list = uploader.listFiles();
        for (var i=0; i<list.length; i++) {
            
        }
    }

    function deleteFile() {
        if (document.getElementById("deleteIndex").value) {
            var index = document.getElementById("deleteIndex").value

            uploader.deleteFile(index);
        }
    }

    function cancelFile() {
        if (document.getElementById("cancelIndex").value) {
            var index = document.getElementById("cancelIndex").value

            uploader.cancelFile(index);
        }
    }

    function resumeFile() {
        if (document.getElementById("resumeIndex").value) {
            var index = document.getElementById("resumeIndex").value

            uploader.resumeFile(index);
        }
    }

   
    function isVodMode() {
        var uploadAuth = document.getElementById("uploadAuth").value;
        return (uploadAuth && uploadAuth.length > 0);
    }

    function isSTSMode() {
        var secretToken = document.getElementById("secretToken").value;
        var expireTime = document.getElementById("expireTime").value;
        if (!isVodMode()) {
            if (secretToken && secretToken.length > 0 && expireTime && expireTime.length > 0) {
                return true;
            }
        }
        return false;
    }

</script>
<script src="<?php echo UOOT;?>Public/common/js/common.js" ></script>
<script>
   IncreaseClass();
   starttime('#start');
   endtime('#end');
loadScorllJs();
</script>
<script src="<?php echo UOOT;?>Public/common/js/jquery.cookie.js" type="text/javascript"></script> 
<script>
	$(function(){
			var text = parseInt($("#type").val()) - 1;
              $('.itemBox:eq(' + text + ')').show().siblings().hide()
		})
		$(function(){
			var s1 =$('#type').val();
			if(s1=='1')
			{
				$('#shownone').hide();
				}	
			//优化复选框 0未选 1选中
			$('.bind-checkbox-style').each(function() {
                if($(this).is(':checked')==true){
					$(this).before('<div class="checkbox-style checkbox-style-on" data-flag="1"><i></i></div>');
				}else{
					$(this).before('<div class="checkbox-style" data-flag="0"><i></i></div>');
				};
            });		
			$('.checkbox-style').on('click',function(){
				var flagId = $(this).attr('data-flag');
				if(flagId==0){
					$(this).addClass('checkbox-style-on');
					$(this).next('.bind-checkbox-style').attr('checked',true);
					$(this).attr('data-flag',1);
				}else{
					$(this).removeClass('checkbox-style-on');
					$(this).next('.bind-checkbox-style').attr('checked',false);
					$(this).attr('data-flag',0);
				};
			});
			
			if($('#shoujia-flag').is(':checked')==true){
					$('#shoujia').show();
				}else{
					$('#shoujia').hide();
			};
			
			$('#shoujia-flag').prev('.checkbox-style').on('click',function(){
				if($('#shoujia-flag').is(':checked')==true){
						$('#shoujia').fadeIn(300);
					}else{
						$('#shoujia').stop().fadeOut(300);
				};
			});
			
			$('#cancel').on('click',function(){
					var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
					parent.layer.close(index);
			});			
		});	
	 function getChoice(obj) {
        var text = parseInt($(obj).val())-1 ;
        $('.itemBox:eq(' + text + ')').show().siblings().hide();
		if(text=='0'){
			$('#shownone').hide();
		}else{
			$('#shownone').show();
		}
    }
   
function addCourseKpoint(url){

	$.cookie('addKption','',{ expires: -1 });
 
   layer.open({
        type: 2,
        area: ['850px', '600px'],
        fixed: false, //不固定
        maxmin: true,
		title: ['添加课程知识点', 'font-size:18px;'],
        content:url
    });
};
function delKption(id){
	$("#kption"+id).remove();
}	
</script>

<script>
function do_reg()
{
	var title = $("input[name='title']").val();
	/*数字验证*/
	var num =/^[0-9]*$/;
    if(title==''){
		Alert('章节题目');
		return false;	
    }
	$("#myform").submit();	
}
</script>

</body>
</html>
