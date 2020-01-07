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
    <link href="<?php echo UOOT;?>Public/app/css/live.css?<?php echoHash(); ?>" rel="stylesheet" />
    <link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
  	<style>#teacher2 li {display:inline-block;height:40px;margin-right:10px} </style>
    <script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
</head>
<style type="text/css">
	.ks-wrap.add-scorll{
		overflow:auto;
	}
</style>
<style type="text/css">
	.btn-primary{background: #FF5507;border: 1px solid #FF5507;}
	.btn-default{background: #CCCCCC;color: #3A3D40 !important;}
	.btn-primary {
    background: #FF5507;
    border: 1px solid #FF5507;
}
.btn-s-md {
       width: 100px;
    height: 50px;
    border-radius: 25px;
    background: #FF5507;
    border: 1px solid #FF5507;
    color: white;
}
</style>
<body class=" add-scorll" id='tab-box'>
	<div class="ks-wrap" id="ksBoxContent">
<div class="courseBox clearfix mt20">
	<div class="lRightBox">
		<div class=" ml20 borderSo " style="position: relative; overflow: hidden;">
			<div style="">
				<div class="bg-white bRadius10 borderSo bg-white ks-wbox clearfix mb20">
					<div class="form-tip-blick"></div>
					<div class="form-tip-word">编辑帮助内容</div>
				</div>
                <form target="hidframe" action="<?php echo M_URL('Offweb','helpManageDoSave',isset($id)?$id:'',GP('p-'.$now_page)); ?>" method="post" id="myform">

                    <div class="p30 bg-white bRadius10">
                        <div class="form-row">
                            <span class="name">所属分类</span>

                            <select name="parentid" class="form-control" style="height: 36px; width: 335px;">
                                <?php
                            foreach($appcategory as $k=>$v){
                                if(!isset($values)){
                                     $html .= '<option value="'.$v['categoryid'].'">'.KS_INDENT($v['depth']).$v['categoryname'].'</option>';
                                }else{
                                    $html .= '<option value="'.$v['categoryid'].'"';
                                    if($values['categoryid']==$v['categoryid']){$html .= 'selected="selected"';}
                                    $html .= ' >'.KS_INDENT($v['depth']).$v['categoryname'].'</option>';
                                }
                            }echo $html;?>
                            </select>

                        </div>
                        <div class="form-row">
                            <span class="name">标题</span>
                            <input type="text" style="height: 35px; width: 337px;margin: 22px;" name="title" id="title" value="<?php if($values){echo $values['title'];}?>" />

                        </div>
                        <div class="form-row">
                            <span class="name">详细介绍</span>
                            <div class="rightTd alignLife" style="max-width:1400px;width:100%;">
                                <?php  $kindeditor1 = ks_editor('content',$values['content'],'1','','1400px','400px');  echo $kindeditor1;?>
                            </div>
                        </div>

                    </div>

                    <!--<div class="cinfo-pan">
					<ul class="cinfo-ul">
						<li><i class="iconfont icon-tupian"></i><p>图 片</p>	</li>
						<li><i class="iconfont icon-mokuai-shipinhuiyiweidianji"></i><p>视 频</p></li>
						<li><i class="iconfont icon-audio-enable"></i><p>音 频</p></li>
						<li><i class="iconfont icon-iconfonttoupiao"></i><p>投 票</p></li>
						<li><i class="iconfont icon-xiaochengxu"></i><p>小程序</p></li>
					</ul>
				</div>-->
                    <input type="hidden" name="typea" id="typea" />

                </form>
			</div>
				<div class="pb15 ks-bom ks-fixed-bom clearfix">
					<div class="fl">
					<input  type="button" onclick="do_reg(1);" class="btn-s-md " value="保存返回列表">
					
					<button style="background-color: gray;border:1px solid gray;" class=" btn-s-md "><a style="color: white;" href="<?php echo M_URL('Offweb','Helpcenter','',GP('')); ?>" >取消返回列表</a></button>
					</div>
				</div>
		</div>
	</div>
</div>

</div>

<script src="<?php echo UOOT;?>Public/common/js/common.js" type="text/javascript"></script>
<script>
/***********高度***********/
window.resize=function(){list();}
function list(){
	var winHeight = $(window).height();
	var headHeight = $("#ksBoxHead").height();
	var boxLine = $(".ksBoxLine").height();
	
	var contBox=winHeight-headHeight-boxLine-260;
	console.log(contBox);
	$("#lisHeight").css({
	    'height' : contBox,
	    'overflow' : 'auto'
	});


};list();	
	
	
function do_reg(type){$('#typea').val(type);$("#myform").submit();}	

var teacherTarget = $('#teacher2');
IncreaseClass(257,'.lLightBox','.liveCsecond','.liveCsecond');/*左侧高度+二级栏目*/ 
checkbookM();//复选框优化；

function speak(id,name){	
	$(".addteacher").each(function(index, element) {
	var data = $(this).attr('data');
	var dataname = $(this).attr('dataname');
	var $html='<li><input type="hidden" name="docent[]" value="'+data+'"><span class="hLh35 fl mr10 fsize14">'+dataname+'</span>';
	$html+='<button class="ks-bt bt-def fl mr10" type="button" onclick ="speak('+data+',\''+dataname+'\');">设为主讲</button>';
	$html+='<button class="ks-bt bt-def fl" type="button" onclick ="del('+data+')">删除</button></li>';
	$("#docent"+data).html($html);
	});
	
	var $hhml='<li width=150px><input type="hidden" name="speaker" value="'+id+'">';
	$hhml+='<span  class="hLh35 fl mr10 fsize14">'+name+'</span><button  class="ks-bt bt-def fl" type="button">主讲老师</button></li>';
	$("#docent"+id).html($hhml);		
}


function del(id){ $("#docent"+id).remove();}

$(function(){

	$('.recordData').each(function() {
		var num = $(this).find('.recordBox').size();
		$(this).attr('data-id',num);
	});
	
	/*增加和删除数据*/
	$('.recordData').find('.delete:first').remove();
	$('.recordBox:first').removeClass("mt10");
	
	$(".gTable .addRecord").click(function(){
		var i = $(this).parents('.recordData').attr('data-id');
		i++;
		if(i<=3){
			var html = $(this).siblings(".recordBox:first").html();
			newHtml = '<div class="recordBox mt10">'+html+'<a href="javascript:void(0)" class="delete c-blue ml10">删除</a></div>';
			$(this).before(newHtml);a = i-1;
			$(this).siblings('.recordBox:eq('+a+')').find('.inputText').val('');
		}else{i=3;parent.layer.msg('最多只能加三条记录');};
		
		$(this).parents('.recordData').attr('data-id',i);
		$(".recordBox").on('click','.delete',function(){
			i--;
			$(this).parents('.recordData').attr('data-id',i);
			$(this).parents('.recordBox').remove();
		});
	
	});
	
	
	$(".recordBox").on('click','.delete',function(){
		var i = $(this).parents('.recordData').attr('data-id');
		i--;
		
		$(this).parents('.recordData').attr('data-id',i);
		$(this).parents('.recordBox').remove();
	});

});

</script>
	<script src="/Public/drag/js/utils.js"></script>
	<script>utils.loadJs(['nicescroll'])</script>
	  
	<script>
			var format = new utils.page({
				
				ready:function(){
					this.tabheight();
					
	
				},
				tabheight:function(){
					var tabHeight = $(window).height();
					$('#tab-box').height(tabHeight);
					
					$("#tab-box").niceScroll({  
						cursorcolor:"rgba(0,0,0,0.3)",  
						cursoropacitymax:1,  
						touchbehavior:false,  
						cursorwidth:"7px",  
						cursorborder:"0", 
						cursorborderradius:"10px"  
					}); 
				}
	
			});
	
			

   </script>
</body>
</html>



<!--<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>kesion教育平台</title>
<meta name="Keywords" content="kesion教育平台"/>
<meta name="Description" content="kesion教育平台" />
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<body class="ks-wrap">
<div id="ksBoxHead">
	<!--结束-->
	<!--<div class="Header-tool clearfix" style="margin-bottom: 20px;">
		<div class="Tool-Title clearfix">
		<p><a href="<?php echo M_URL('Website'); ?>" class="fl"><i class="iconfont icon-jiantou-copy"></i>网站设置<span>/</span>网站介绍 </a></p>
	<!--</div>
	</div>	
</div>
<div class="bRadius10 ks-wbox">
	<!--END HEAD-->
   <!-- <div id="ksBoxContent">
        <form target="hidframe" id="myform" action="<?php if($values){echo M_URL('Offweb','editQuestion',$id,GP(''));}else{ echo M_URL('Offweb','Questionadd','',GP(''));}?>" method="post" enctype="multipart/form-data">
              <div class="form-row">
                            <span class="name">所属分类</span>
                            <div class="col-sm-4">
                                <select name="parentid" <?php if(isset($category)){echo 'disabled'; } ?> class="form-control">
						    <?php 
                            foreach($appcategory as $k=>$v){
                                if(!isset($category)){
                                     $html .= '<option value="'.$v['categoryid'].'">'.KS_INDENT($v['depth']).$v['categoryname'].'</option>';
                                }else{
                                    $html .= '<option value="'.$v['categoryid'].'"';
                                    if($category['parentid']==$v['categoryid']){$html .= 'selected="selected"';}
                                    $html .= ' >'.KS_INDENT($v['depth']).$v['categoryname'].'</option>';
                                }
                            }echo $html;?>
                                </select>
                            </div>
                        </div>
             <div class="form-row">
				<span class="name">问题</span>
				<textarea name="title" rows="2" cols="20" class="form-textarea" id="copyrightinfo"><?php if($values){echo $values['title'];} ?></textarea>
			</div>
	        <div class="form-row">
				<span class="name">问题解答</span>
				<textarea name="answer" rows="2" cols="20" class="form-textarea" id="copyrightinfo"><?php if($values){echo $values['answer'];} ?></textarea>
			</div>	
		
	</div>
</div>	
<div id="ksBoxFooter" style="height: 120px;">
	<div class="ks-bom" style="text-align: center;">
			<input type="submit" id="StartBtn" class="ks-bt bt-w120 bt-pue" value="确认" name="confirm">
	</div>     
</div>
</form>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
</body>
</html>-->