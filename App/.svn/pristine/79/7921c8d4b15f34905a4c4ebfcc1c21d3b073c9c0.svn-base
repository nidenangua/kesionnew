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
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/wechat.css" rel="stylesheet"> 
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<style>
#ctl00_KSContent_Panel1{padding-bottom:20px}
.openKey{font-weight:700;background-color:#f0f9fe;padding:5px 10px;border:1px dashed #DBDBDB;margin-bottom:20px}
.openKey .tishi_send_group{font-weight:400;color:red}
.group_send_dx{border:1px solid #e7e7eb;border-bottom:none;padding:10px 20px;background-color:#f5f5f9;margin:20px 0px;}
.chack_recode,.chack_recode:hover{display:block;float:right;width:100px;height:29px;line-height:29px;text-align:center;background-color:#58B1F5;color:#fff;border-radius:3px}
.group_send_dx span{margin-right:10px}
.group_send_dx span #drType{border:1px solid #ccc;vertical-align:middle}
select{background:#fff;border:1px solid #D1D6D9;min-height:34px;color:#62686A;outline:0}
.group_send_box{border:1px solid #e7e7eb;}
.group_send_box .group_send_ul{height:38px;line-height:38px;border-bottom:1px solid #ddd}
.group_send_box .group_send_ul li{width:100px;float:left;text-align:center}
.group_send_box .group_send_ul li.change a{color:#CE9542}
style.css:1104 .group_send_box .group_send_ul li a{color:#b3b3b3;vertical-align:middle}
.group_send_con .group_sc{margin:10px;padding:10px;display:none;height:230px!important;overflow:hidden}
.group_send_bottom{ margin-top: 20px;text-align:left}
.warn{color:#8d8d8d;margin-left:6px;display:inline-block;vertical-align:middle;position:relative}
.group_send_bottom .group_send_botton{float:left;width:104px;margin-right:1em;display:inline-block;height:29px;line-height:29px}
.bubble_tips_inner{padding:4.5px 10px;border:1px solid #e7e7eb;line-height:21px;background-color:#f8f8f8;word-wrap:break-word;word-break:break-all}
.bubble_tips_arrow.out{border-right-color:#e7e7eb;left:-6px}
.bubble_tips_arrow{position:absolute;top:50%;margin-top:-6px;display:inline-block;width:0;height:0;border-width:6px;border-style:dashed;border-color:transparent;border-left-width:0;border-right-color:#f8f8f8;border-right-style:solid}
.bubble_tips_arrow.in{left:-5px}
.wexin-header{box-sizing: border-box; }
*{ box-sizing:inherit; }
.bubble_tips_arrow{position:absolute;top:50%;margin-top:-6px;display:inline-block;width:0;height:0;border-width:6px;border-style:dashed;border-color:transparent;border-left-width:0;border-right-color:#f8f8f8;border-right-style:solid}
.group_send_bottom .group_send_botton{float:left;width:104px;margin-right:1em;display:inline-block;height:29px;line-height:29px}
.group_send_bottom .group_send_botton .send_button{width:100%;display:block;height:100%;color:#fff;background-color:#43A7DE;border-color:#43A7DE;color:#fff;border:0;outline:0;overflow:visible;padding:0 22px;border-radius:3px}
</style>
</head>
<body class="ks-wrap">
	<div>
		
		<!--内容-->
		
		<div class="contentBox">
		<div class="infoBox ">  
		
		<form  action="<?php echo M_URL($this->AppName.'/Index','sendAllByTag','',GP(''))  ?>" method="post" class="commentForm" enctype="multipart/form-data">
		<div class="ks-wbox bRadius10">
		<div id="ctl00_KSContent_Panel1">
		<div class="openKey" style="font-weight: normal;line-height: 30px;"> 群发消息规则：根据微信官方规定，订阅号每天可以群发1条信息，服务号每月可以群发4条信息，发送大于规定的信息数，用户将接收不到！
		<p class="tishi_send_group">注意：群发对象是按全部用户：订阅号不可用，服务号认证后可用；  群发对象是按分组选择：订阅号和服务号认证后均可用。 </p>
		</div>
		<input type="hidden" id="sendtype" name="sendtype" value="0">
		
		<div class="form-row clearfix"> 
		
		<span class="fl fsize14 hLh35 mr10">群发对象</span> 
		
		<div class="clearfix">
			<select name="drType" class="fl" id="class-kind">
				<option value="1">按全部用户</option>
				<option value="2">按分组选择</option>
			</select>			
			
			<select class="fl" name="tag_id" id="kind-grouping" style="display: none;">
				<option value="0">未分组</option>
				<?php foreach($groupList as $k=>$v){ ?>
				<option value="<?php echo $v['tag_id'];?>"><?php echo $v['name'].'('.$v['count'].')';?></option>
				<?php }?>
			</select>
			<a href="<?php echo M_URL($this->AppName.'/Index','checkTrait','',GP(''))  ?>" class="ks-bt bt-pue ml10">查看群发记录</a>
		</div>
		
		
		
		<label class="fl">发送被判定转载是否继续发送</label>
		<label for=""><input type="radio" name="send_ignore_reprint" value="1" />是 </label>
		<label for=""><input type="radio" name="send_ignore_reprint" value="0" checked="checked" />否</label>
		
		
		</div>
		
		<!--单选-->
		<div class="form-row clearfix">
		
		<!--	<div class="name">回复类型</div>-->
		
		   <div class="rightTd alignLife">
		   <label class="radioLabel fl">
		   <input type="radio" name="replyType" class="radioInput" value="0" checked="checked"/> 素材
		   </label>
		   <label class="radioLabel fl">
		   <input type="radio" name="replyType" class="radioInput" value="1" >文字
		   </label>
		  <!--<label class="radioLabel fl">
			   <input type="radio" name="replyType" class="radioInput" value="2" />课程
		   </label>-->
		   </div>
		</div>
		 
		 
		<div class="replyType form-row clearfix" value="0">
		  
		   	<div class="clearfix">
		<a href="javascript:void(0)" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','replySucai','',GP("abc-focusReplySucai3"));?>','850px','600px');" class="ks-bt bt-def"><i class="iconfont icon-jiahao"></i>从素材中选择</a>
		</div>
		<div class="form-row clearfix" >
		<div id="focusReplySucai3" style="width: 200px; margin-top: 15px;">
		<!--<?if(!empty($v['url'])){?>
		<div class="Suin" style="margin-left: 2px;"><div class="SuinImg">
			<input class="SuninRa" type="hidden" name="id" value="26">
			<img  onerror="this.src='<?php echo nopic();?>'"  src="<? ehco $v['url']?>" style="width:100%;height:100%;">													
			</div><div class="SuinMark mt5"><div class="hLh30 SuinTitle"><? echo $v['titles'] ?></div>
			<div class="SuinSt"><?php if(empty($v['media_id'])){echo "未上传";}else{echo "已经上传";}?></div></div></div>
		
			
			<input type="hidden" name="url" id="" value="<? ehco $v['url']?>" />
			<input type="hidden" name="titles" id="" value="<? echo $v['titles'] ?>" />
			<input type="hidden" name="media_id" id="" value="<? echo $v['media_id'] ?>" />
		<!--不存在为空-->
		
		</div>
		</div>
		   
		</div>
		
		
		<div class="replyType form-row clearfix" value="1" style="display: none;">
		   <!-- <div class="name">文字</div>-->
		<div class="rightTd alignLife">
		<textarea name="contents" rows="2" cols="20" class="inputText bRadius5" id="content" style="height:200px;width:40%;"><?php  if(!empty($replyInfo)) echo $replyInfo["contents"]?></textarea>
		</div>
		
		</div>
		   
		   
		    <div class="replyType form-row clearfix" value="2"style="display: none;">
		 <!--  	<div class="name">课程</div>-->
		<div class="clearfix" >
		<a href="javascript:void(0)" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','replyCourse','',GP("ab-focusReplyCourse3"));  ?>','850px','600px');"
		   class="ks-bt bt-def"><i class="iconfont icon-jiahao"></i>从课程中选择</a>
		
		</div>
		<div class="form-row clearfix" >
		<div style="width: 200px; margin-top: 15px;" id="focusReplyCourse3" >
		
		</div>
		</div>
		<!--单选-->
		
		</div> 
		<div class="group_send_bottom">
		<div class="warn">
		<div class="bubble_tips_inner">
		<p class="mass_send_tips">注：每天只能推送一次</p>
		</div>
		<i class="bubble_tips_arrow out"></i>
		<i class="bubble_tips_arrow in"></i>
		</div>
		<span class="group_send_botton">
		<input type="submit" name="ctl00$KSContent$setbtn" value="群发" onclick="return(sendCheck());" id="ctl00_KSContent_setbtn" class="send_button">
		</span>
		</div>
		</div>	
		</form>
		</div>
		
		<!--内容-->
	    <!--/table-->
	            
		<!--footer-->
		<div class="ks-bom clearfix">
			<span class="fl">
						
			</span>
					
			<div class="fr">
						
			</div>
		</div>
		<!--/footer-->
	
	</div>
	
	
	<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
	<script>
		
		module.require(['$','backstage','nicescroll'],function(){
		
			
			loadScorllJs();
			$("#class-kind").change(function(){
				if($(this).val()==2){
					$("#kind-grouping").show();
				}else{
					$("#kind-grouping").hide();
				}
			})
			/*三类切换开始*/
			$('input[name="replyType"]').click(function(){
				var value = this.value;
				$('.replyType').each(function(){
					if($(this).attr('value')==value){
						$(this).show();
					}else{
						$(this).hide();
					}
				})
			})
			
		});
		function DoCheck() {
			var ch=document.getElementsByName("id[]");
			if(document.getElementsByName("allChecked")[0].checked==true)
			{
				for(var i=0;i<ch.length;i++)
				{
					ch[i].checked=true;
				}
			}else{
				for(var i=0;i<ch.length;i++)
				{
					ch[i].checked=false;
				}
			}
		}
	
	</script>
	
</body>
</html>