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
    <script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
</head>
<style type="text/css">#teacher2 li {display:inline-block;height:40px;margin-right:10px}.ks-wrap.add-scorll{ overflow:auto; } </style>
<body class=" add-scorll" id='tab-box'>
<div style="padding: 25px;">
<?php include  CURR_VIEW_PATH . "head.php";?> 
<div class="courseBox clearfix mt20">
	<div class="lLightBox bg-white bRadius10  borderSo"><?php include  CURR_VIEW_PATH . "menu.php";?></div>
	<div class="lRightBox">
		<div class=" ml20 borderSo " style="position: relative; overflow: hidden;">
			<div class="bg-white bRadius10">
				<div class="bg-white bRadius10 borderSo bg-white ks-wbox clearfix">
					<div class="form-tip-blick"></div>
					<div class="form-tip-word">详细资料</div>
				</div>
				<form target="hidframe"  action="<?php echo M_URL($this->AppName.'/Index','doaddinfo',$courseid,GP('')) ?>" method="post" id="myform">
					
				<div class="p30 bg-white bRadius10">
					<div  class="form-row">
					<span class="name">课程公告</span>
					<div  class="rightTd alignLife" style="max-width:1000px;width:100%;margin-bottom: 20px;" >
						<?php  $kindeditor = ks_editor('announce',$course['announce'],'1',editorNum(),'100%');  echo $kindeditor;?>
					</div>
					</div>
					<div  class="form-row">
					<span class="name">课程详细介绍</span>
					<div  class="rightTd alignLife"style="max-width:1000px;width:100%;>
						<?php  $kindeditor1 = ks_editor('content',$course['content'],'1','','100%');  echo $kindeditor1;?>
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
				</div>
				--> <input type="hidden" name="typea" id="typea"  />
				
				</form>
			</div>
				<div class="ks-bom ks-fixed-bom clearfix"style="height: inherit;padding-bottom: 0px;">
					<div class="fl">
					<input  type="button" onclick="do_reg(2);" class="ks-bt bt-pue mr10" value="保存进入下一步">
					<input  type="button" onclick="do_reg(1);" class="ks-bt bt-white mr10" value="保存返回列表">
					
					<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP('')); ?>" class="ks-bt bt-white">取消返回列表</a>
					</div>
				</div>
		</div>
	</div>
</div>
</div>
</div>
</div>
<script src="/Public/drag/js/utils.js"></script>
<script>utils.loadJs(['nicescroll'])</script>
<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
	
	module.require(['$','backstage','nicescroll'],function(){
	
		
		loadScorllJs();
		var teacherTarget = $('#teacher2');
		IncreaseClass(257,'.lLightBox','.liveCsecond','.liveCsecond');/*左侧高度+二级栏目*/ 
		checkbookM();//复选框优化；
		
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
	
	
	
	
	});


	function do_reg(type){$('#typea').val(type);$("#myform").submit();}	
	
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
