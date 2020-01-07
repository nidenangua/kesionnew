<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    <title>关键词回复</title> 
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/home.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/signin.css" rel="stylesheet">
    <link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="<?php echo UOOT ?>Public/wechat/css/editcampus.css"/>
    <script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
    <script>
    	var uoot = '<?php echo UOOT ?>';
    	
    </script>
    <style>
    	.btn.red {
		    border: 1px solid #E5412C;
		    color: #fff;
		    text-align: center;
		    background: #E5412C;
		}
		.btn {
		    display: inline-block;
		    width: 80px;
		    height: 30px;
		    line-height: 30px;
		    border: 1px solid #ddd;
		    color: #333;
		    text-align: center;
		    border-radius: 4px;
		    font-size: 14px;
		}
    	.check-item{
    		display: inline-block;
    		margin-right: 5px;
    	}
    	 .check-item .radio-inner{
			border: 1px solid #dcdfe6;
		    border-radius: 100%;
		    width: 0.7rem;
		    height: 0.7rem;
		    background-color: #fff;
		    position: relative;
		    cursor: pointer;
		    display: inline-block;
		    box-sizing: border-box;
		    vertical-align: middle;
		}
		.check-item .radio-inner.active{
			border-color: #409eff;
		    background: #409eff;
		}
		 .check-item .radio-inner .tips{
			font-size: 14px;
			padding-left:10px ;
		}
		 .check-item .radio-inner.active:after{
			width: 0.2rem;
		    height: 0.2rem;
		    border-radius: 100%;
		    background-color: #fff;
		    content: "";
		    position: absolute;
		    left: 50%;
		    top: 50%;
		    margin-top: -0.1rem;
		    margin-left: -0.1rem;
		}
		.type{
			padding-left: 20px;
		}


    </style>
</head>
	<body>
		
		<form id="form" action="<?php if(isset($values)){ echo M_URL('WeChat','doeditReply',$values['id']); }else{ echo M_URL('WeChat','saveReply');}?>" method='post'>
			<div class="edit-wrap">
				<div class="title1">规则名称</div>
				<input type="text" name="rule" id="" value="<?php if(isset($values)){ echo $values['rule']; } ?>" class="edit-input" />
			</div>
			<div class="edit-wrap">
				<div class="title1">关键字</div>
				<input type="text" name="keyword" id="" value="<?php if(isset($values)){ echo $values['keyword']; } ?>" class="edit-input" />
			</div>
			<div class="edit-wrap">
				<div class="title1">回复类型</div>
				<div class="check-item" onclick="changePay(this)" data-type='0'>
					<span class="radio-inner <?php if(isset($values) && $values['replyType']== 0){ echo 'active'; }elseif(!isset($values)){ echo 'active';} ?>"  ></span>
					<span class="tips" for=''>素材</span>
				</div>
				<div class="check-item" onclick="changePay(this)" data-type='1'>
					<span class="radio-inner <?php if(isset($values) && $values['replyType']== 1){ echo 'active'; } ?>" ></span>
					<span class="tips">文字</span>
				</div>
				<div class="check-item" onclick="changePay(this)" data-type='2'>
					<span class="radio-inner <?php if(isset($values) && $values['replyType']== 2){ echo 'active'; } ?> " ></span>
					<span class="tips">课程</span>
				</div>
				<div class="check-item" onclick="changePay(this)" data-type='3'>
					<span class="radio-inner <?php if(isset($values) && $values['replyType']== 3){ echo 'active'; } ?>"  ></span>
					<span class="tips">班级</span>	
				</div>
				<input type="hidden" name="replyType" value="<?php if(isset($values)){ echo $values['replyType']; }else{ echo 0;} ?>" />
				
			</div>
			<div class="type" style="<?php if(isset($values) && $values['replyType']== 0){ echo 'display: block'; }elseif(!isset($values)){ echo 'display:block'; }else{ echo 'display:none';} ?>">
				<input type="button" class="btn red" name="redpacket" value="选择素材 ">
					<div id="focusReplyCourse0" style="width: 200px; margin-top: 15px;<?php if(isset($values) && $values['replyType']== 0 && !empty($values['sucaiid'])){ echo 'display:block'; }else{ echo 'display:none';} ?>" >			   
						<div class="Suin Suin0" style="display:block;margin-left: 2px">
							<div class="SuinImg">
								<img onerror="this.src='//ks.kesion.com/Public/uploads/common/nopic.gif'" src="<?php echo $info['pic'] ?>" style="width:100%;height:100%;">													
							</div>
							<div class="SuinMark mt5">
								<div class="hLh30 SuinTitle">素材名称: <span><?php if(isset($values) && $values['replyType']== 3){ echo $info['title'];  } ?></span></div>
							</div>
						</div>											
					</div>
				<input class="SuninRa" type="hidden" required="" name="sucaiid" value="<?php if(isset($values) && $values['replyType']== 0){ echo $values['sucaiid']; }?>">
			</div>
			
			<div class="type" style="<?php if(isset($values) && $values['replyType']== 1){ echo 'display: block'; }else{ echo 'display: none'; } ?>">
				<textarea name="contents" rows="20" cols="1000" class="inputText bRadius5" id="content" style="height:200px;width: 95%;"><?php if(isset($values) && $values['replyType']== 1){ echo $values['contents']; } ?></textarea>
			</div>
			
			<div class="type" style="<?php if(isset($values) && $values['replyType']== 2){ echo 'display: block'; }else{ echo 'display: none'; } ?>">
				<input type="button" class="btn red" name="redpacket" value="选择课程 ">
					<div id="focusReplyCourse2" style="width: 200px; margin-top: 15px;<?php if(isset($values) && $values['replyType']== 2 && !empty($values['courseid'])){ echo 'display:block'; }else{ echo 'display:none';} ?>">			   
						<div class="Suin Suin2" style="display:block;margin-left: 2px">
							<div class="SuinImg">
								<img onerror="this.src='//ks.kesion.com/Public/uploads/common/nopic.gif'" src="<?php echo Img($info['defaultpic']); ?>" style="width:100%;height:100%;">													
							</div>
							<div class="SuinMark mt5">
								<div class="hLh30 SuinTitle">课程名称: <span><?php if(isset($values) && $values['replyType']== 2){ echo $info['title'];  } ?></span></div>
							</div>
						</div>											
					</div>
				<input class="SuninRa" type="hidden" required="" name="courseid" value="<?php if(isset($values) && $values['replyType']== 2){ echo $values['courseid']; }?>">
				
			</div>
			
			<div class="type" style="<?php if(isset($values) && $values['replyType']== 3){ echo 'display: block'; }else{ echo 'display: none'; } ?>">
				<input type="button" class="btn red" name="redpacket" value="班级 ">
					<div id="focusReplyCourse3" style="width: 200px; margin-top: 15px;<?php if(isset($values) && $values['replyType']== 3 && !empty($values['classid'])){ echo 'display:block'; }else{ echo 'display:none';} ?>">			   
						<div class="Suin Suin3" style="display:block;margin-left: 2px">
							<div class="SuinImg">
								<img onerror="this.src='//ks.kesion.com/Public/uploads/common/nopic.gif'" src="<?php echo Img($info['defaultpic']); ?>" style="width:100%;height:100%;">													
							</div>
							<div class="SuinMark mt5">
								<div class="hLh30 SuinTitle">班级名称: <span><?php if(isset($values) && $values['replyType']== 3){ echo $info['title'];  } ?></span></div>
							</div>
						</div>											
					</div>
				<input class="SuninRa" type="hidden" required="" name="classid" value="<?php if(isset($values) && $values['replyType']== 3){ echo $values['classid']; }?>">
			</div>
			<div class="edit-wrap text-center">
				<div class="btn red" style="margin-right: 10px;" onclick="insumbit()">确认</div> 
				<div class="btn" onclick="history.go(-1)">取消</div> 
			</div>
		</form>
	<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
	<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
	<script type="text/javascript">
		module.require(['$','backstage','nicescroll'],function(){
			loadScorllJs();
			$('.upload-img').click(function(){
				$('.js_uploadText').click()
			});
				
			
		});
		function insumbit(){
			document.getElementById('form').submit()
		}
		function changePay(that){
			$('.radio-inner').removeClass('active');
			$(that).find('.radio-inner').addClass('active');
			$('[name=replyType]').val($(that).attr('data-type'));
			$('.type').hide();
			$('.type').eq($(that).attr('data-type')).show();
		}
		
		
		//
	</script>
	</body>
</html>