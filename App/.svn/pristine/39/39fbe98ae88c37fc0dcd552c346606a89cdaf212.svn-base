
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>问答模块</title>
<link rel="stylesheet" type="text/css" href="<?php echo UOOT;?>Public/common/css/public.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo UOOT;?>Public/common/css/wenda.css"/>
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<style>
::-webkit-textarea-placeholder { /* WebKit browsers */ 
	font-size:14px;color:#c5c5c5;
	} 
	:-moz-placeholder { /* Mozilla Firefox 4 to 18 */ 
	font-size:14px;color:#c5c5c5;
	} 
	::-moz-placeholder { /* Mozilla Firefox 19+ */ 
	font-size:14px;color:#c5c5c5;
	} 
	:-ms-textarea-placeholder { /* Internet Explorer 10+ */ 
	font-size:14px;color:#c5c5c5;
	}
	::-webkit-input-placeholder { /* WebKit browsers */ 
	font-size:14px;
	} 
	:-moz-placeholder { /* Mozilla Firefox 4 to 18 */ 
	font-size:14px;
	} 
	::-moz-placeholder { /* Mozilla Firefox 19+ */ 
	font-size:14px;
	} 
	:-ms-input-placeholder { /* Internet Explorer 10+ */ 
	font-size:14px;
	}
	.content_bleft_t1{font-size: 18px;font-weight: 700;line-height: 25px; text-align:center;}
	.content_bix_wrp{padding: 40px 34px 30px;}
	.ke-container-default{ width:600px !important;}
</style>
<body>
	



<div class="content"  style=" background-color:#f2f2f2">
<form target="hidframe"  method="post" action="<?php if(isset($value)){echo M_URL($this->AppName.'/Index','doedit',$value['id'],GP('')); }else{echo M_URL($this->AppName.'/Index','doaddquestion','',GP(''));} ?>"  id="myform">
	<div class="content_bix"  style="padding-top:10px; padding-bottom:10px;">
    	<div class="content_bix_left" style="background-color:white; min-height:1000px;">
        	<div class="content_bix_wrp" >
            	<div class="content_bleft_t1">描述您的问题</div>
                <div style="font-size: 15px;margin: 40px 0 10px; float:left; width:100%;"><strong>问题描述</strong>
                	<span style="color: #a3a3a3; font-size:12px;">（必填）</span>
                    <span style="color: red; font-size:12px;">*</span>
                    <!--<span style="color: #a3a3a3; font-size:12px; float:right;">还可以输入<strong>40</strong>个字</span>-->
                </div>
                <div><input style="width:100%; height:35px;text-indent: 10px; border-radius:3px; border:1px solid #C5C5C5" name="problem" placeholder="一句话描述您的问题"
                         value="<?php if(isset($value))echo $value['problem'] ?>"></div>
               <div style=" height:50px; line-height:50px">
                    <span style="color: #a3a3a3; font-size:12px; float:left;">问题补充说明：</span>
              <!--      <span style="color: #a3a3a3; font-size:12px; float:right;">还可以输入<strong>200</strong>个字</span>-->
                </div>
                <div>
                	 <?php echo $describe ?>
                </div>
                
                <div style="font-size: 15px;margin: 40px 0 10px; width:100%;"><strong>问题分类</strong>
                    <span style="color: #a3a3a3; font-size:12px; float:right;">正确的标签能够获得更专业的回答</span>
                </div>
                <div style=" height:50px; width:100%;">
                <?php echo $link->Linkage(3); ?>
                 </div>
                <div style="font-size: 15px;  width:100%; height:30px;"><strong>问题悬赏</strong> </div>
                <div style=" height:50px; width:100%;">
                    <input style="width:100px; height:35px;float:left; text-indent:10px; border-radius:3px; border:1px solid #C5C5C5" name="points" placeholder="0"
                    value="<?php  if(isset($value))echo $value['points'] ?>">
                   <!-- <img src="{$install}Public/image/r_d.png" style="width:20px; height:20px; position:relative; float:left; margin-left:-32px; margin-top:8px">-->
	`				<div style=" width:100px; background-color:white; position:relative; margin-top:20px; z-index:2; border:1px solid #CCC; display:none;">
    					<div style="width:100%; height:35px; line-height:35px; background-color:#999; text-indent:10px">特使1</div>
    					<div style="width:100%; height:35px; line-height:35px; background-color:#999; text-indent:10px">特使1</div>
    					<div style="width:100%; height:35px; line-height:35px; background-color:#999; text-indent:10px">特使1</div>
                    </div>

                </div>
                
                
               
                
                <div style="font-size: 15px;  width:100%; height:100px; margin-top:30px; ">
                	<input type="checkbox" style="background-color:white; width:16px; height:16px; float:left; margin-top:20px;" value="1" name="anonymous"
                     <?php if(isset($value))if($value['anonymous']==1) echo 'checked'; ?>>
                    <span style="font-size:14px; float:left; margin-top:18px; margin-left:8px">匿名</span>
                	<input type="button" onClick="do_reg()" style="background-color:#337eff; border:none; height:46px; width:156px; font-size:20px; color:white; float:right; font-weight:500;" value="提 交">
                </div>

            </div>
            
        
        </div>
        <div style="width:315px; float:right;background-color:white; min-height:300px; padding-bottom:20px;">
        	<div style="padding: 18px 20px 24px;">
            	<div style="text-align: center; font-size: 16px; line-height: 24px; font-weight: 700; padding-bottom: 18px; border-bottom: 1px solid #f0f0f0;">提问的正确姿势</div>
            	<div style="width:100%;line-height: 22px;color: #a3a3a3;font-size:14px; margin-top:20px;"><span>① </span>问题要具体、语句通顺，不寻求模糊空洞的答案。广告等违反社区规则的提问将被删除并给予处罚。</div>
            	<div style="width:100%;line-height: 22px;color: #a3a3a3;font-size:14px; margin-top:20px;"><span>② </span>句式、标点符号使用严谨，问题尽量不含有与问题本身无关的词语（如：跪求大神，急急急）。</div>
            	<div style="width:100%;line-height: 22px;color: #a3a3a3;font-size:14px; margin-top:20px;"><span>③ </span>打上正确的标签、添加悬赏将有助于更快地获得满意回答。</div>
            </div>
            
        </div>
      
    </div>
    
    
    	
    	
</div>
 </form>   
	
	

<div class="footer"></div>
</body>
</html>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
    function do_reg()
{
	
	var describe = $("input[name='problem']").val();
	var problem = $("textarea[name='describe']").val();
	var categoryid = $("select[name='categoryid']").val();
    var points = $("input[name='points']").val();
    var reg  =/^([1-9]\d*|[0]{1,1})$/;
	isok =reg.test(points)
	if(!isok)
	{
		Alert('积分为数字');
		return false;
	 }
	if(describe==''){
		Alert('问题描述不能为空');
		return false;	
    }	
	if(problem==''){
		Alert('问题不能为空');
		return false;	
    }
	if(!categoryid){
		Alert('请选择分类');
		return false;	
    }		
	
	$("#myform").submit();	
 } 
</script>
