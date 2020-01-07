<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="renderer" content="webkit">
	<title>添加图文消息</title>
	<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
    <link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
	<link href="<?php echo UOOT;?>Public/app/css/wechat.css" rel="stylesheet"> 
	<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
	<style>
		.moBan-ul li p{font-size: 14px!important; padding: 0 15px !important;box-sizing: border-box;}
	</style>
</head>
<body class="ks-wrap">
	<div class="ks-wbox bRadius10">
		<!--header-->
	   <div class="ks-head-nav">
			<!--标题-->
			 <a href="javascript:history.go(-1);">素材管理</a><span><em>/</em>编辑图文消息</span>
			<!--标题-->
		</div>
	    <!--header-->
					     
			  
		<!--widget-->
		<?php include  CURR_VIEW_PATH . "left_menu.php";?>	
		<!--/widget-->
		<!--table-->
		<div class="moBan-content" style="margin-top:20px;">
		
		<form target="hidframe" method="post" id="myform" action="<?php echo M_URL($this->AppName.'/Index','doedittedTuwen','',GP("")); ?>" class="form-horizontal" enctype="multipart/form-data">
		<div class="moBan-left">
			
			<ul class="moBan-ul">
			<input type="hidden" name="sunList" id="sunList" value="<?php echo $countList;?>" />
			<input type="hidden" name="sunLength" id="sunLength" value="<?php echo $countList;?>" />
			<input type="hidden" name="countList" id="countList"   value="" />
			<input type="hidden" name="groupid" value="<?php if(isset($tuwenDataFirst)){echo $tuwenDataFirst['groupid'];} ?>" />
			<input type="hidden" name="parentid" value="<?php echo $id;?>" />
			 
			<li id="model-1"  class="xz">
				<div class='moBan-imgBox moNum' id="moBan-imgBox">
				<div class="deault-box">
				<img class="showImg" src='<?php if(isset($tuwenDataFirst)){echo Img($tuwenDataFirst['pic']);}else{echo '/Public/uploads/common/timg.jpg';}?>' alt="图片"/>
				<p class="moBan-boxMask" id="title1" style="text-align: center;overflow : hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical;"><span class="titleMark" ><?php if(isset($tuwenDataFirst)){echo $tuwenDataFirst['titles'];} ?></span></p>
				</div>
				</div>
				<input type="hidden"  class="form-textbox keytype" name="keytype1" value="<?php if(isset($tuwenDataFirst)){echo $tuwenDataFirst['keytype'];} ?>">
				<input type="hidden"  class="form-textbox title yanzheng" name="title1" value="<?php if(isset($tuwenDataFirst)){echo $tuwenDataFirst['titles'];} ?>"> 
				<input type="hidden"  class="form-textbox author yanzheng" name="author1" value="<?php if(isset($tuwenDataFirst)){echo $tuwenDataFirst['author'];} ?>" >
				<input type="hidden"  class="form-textbox text yanzheng" name="text1" value="<?php if(isset($tuwenDataFirst)){echo $tuwenDataFirst['text'];} ?>">
				<input type="hidden"  class="form-textbox abstract yanzheng" name="abstract1" value="<?php if(isset($tuwenDataFirst)){echo $tuwenDataFirst['abstract'];} ?>" >
				<input type="hidden"  class="form-textbox linkurl yanzheng" name="linkurl1" value="<?php if(isset($tuwenDataFirst)){echo $tuwenDataFirst['linkurl'];} ?>">		
				<input type="hidden"  class="form-textbox pic yanzheng" name="pic1" value="<?php if(isset($tuwenDataFirst)){echo $tuwenDataFirst['pic'];} ?>">			
				<input type="hidden"  class="form-textbox parentID" name="parentID1" value="0">
				<input type="hidden"  class="form-textbox rootID numcal"  name="rootID1" value="1">
						
				
			</li>
			
			<!--循环体-->
			  <?php foreach($tuwenDataSecond as $k=>$v){ ?>
			<li id="model-<?php echo $k+2;?>"   style="border: 1px solid rgb(204, 204, 204);">
				<div class="moBan-imgBox2 clearfix moNum">
					<div class="moBan-title titleMark"><?php if(isset($v)){echo $v['titles'];} ?></div>
					<div class="wechat-imgbox2-img"><img class="showImg" src="<?php if(isset($v)){echo $v['pic'];}else{echo '/Public/uploads/common/timg.jpg';}?>"></div>
					<p class="moBan-boxMask">
						<span class="fr" onclick="delModel(<?php echo $k+2;?>)"><i class="iconfont icon-lajitong1"></i></span>
					</p>
				</div>
				<input type="hidden" class="form-textbox keytype" name="keytype<?php echo $k+2;?>"  value="<?php if(isset($v)){echo $v['keytype'];} ?>">
				<input type="hidden" class="form-textbox title yanzheng" name="title<?php echo $k+2;?>".  value="<?php if(isset($v)){echo $v['titles'];} ?>">
				<input type="hidden" class="form-textbox author yanzheng" name="author<?php echo $k+2;?>" value="<?php if(isset($v)){echo $v['author'];} ?>">
				<input type="hidden" class="form-textbox text yanzheng" name="text<?php echo $k+2;?>" value="<?php if(isset($v)){echo $v['text'];} ?>">
				<input type="hidden" class="form-textbox abstract yanzheng" name="abstract<?php echo $k+2;?>" value="<?php if(isset($v)){echo $v['abstract'];} ?>">
				<input type="hidden" class="form-textbox linkurl yanzheng" name="linkurl<?php echo $k+2;?>"   value="<?php if(isset($v)){echo $v['linkurl'];} ?>">
				<input type="hidden" class="form-textbox pic yanzheng" name="pic<?php echo $k+2;?>" value='<?php if(isset($v)){echo Img($v['pic']);}else{echo '/Public/uploads/common/timg.jpg';}?>'>
				<input type="hidden" class="form-textbox parentID" name="parentID<?php echo $k+2;?>"  value="<?php if(isset($v)){echo $v['parentid'];} ?>">
				<input type="hidden" class="form-textbox rootID numcal" name="rootID<?php echo $k+2;?>"  value="<?php if(isset($v)){echo $v['rootid'];} ?>">	
			</li>
			
		  <?php }?>
			<!--循环体-->
			
			</ul>
			
			<div class="addMode" onclick="addModel()">
			<i class="iconfont icon-jiahao" style="font-size: 15px; color: #C0C0C0;"></i>
			</div>
			
		</div>
		</form>
	
		<div class=" wrapper-content animated fadeInRight" id="">
			<div class="tabs-containers">
				<div class="form-row clearfix" id="keytype">
					<label><input type="radio" class="from" name="from" id="" value="zidingyi"/>自定义</label>
					<!--<label><input type="radio" class="from" name="from" id="" value="xitong"/>系统</label>-->
				</div>
					<div  class="moBan-tab"  style="display: block;" id="zidingyi">
						<div class="panel-bodys">
							<div class="row">
							<div class="ibox-content">
							<div class="form-row clearfix">
							<label class="name">标题</label>
							<div class="form-limit" limit=100 >
							<input type="text"  class="form-textbox" name="title" oninput="dataInput()"  value="<?php if(!empty($tuwen)) echo $tuwen['titles'] ?>">
							</div>
							</div>
							<div class="form-row clearfix">
							<label class="name">作者</label>
							<div class="form-limit" limit=100 >
							<input type="text"  class="form-textbox" name="author" oninput="dataInput()" value="<?php if(!empty($tuwen)) echo $tuwen['author'] ?>" >
							</div>
							</div>
							
							<div class="form-row clearfix">
							<div class="clearfix">
							<label class="name">内容</label>
							</div>
							<div class="clearfix" style="position: relative;">
							<!--<textarea id="contText1" rows="3" name="text" oninput="dataInput('text')" class="form-textarea"><?php if(!empty($tuwen)) echo $tuwen['text'] ?></textarea>-->
							<?php echo $text ;?>
							</div>
							</div>
							
							<div class="form-row clearfix">
							<label class="name">摘要</label>
							<div class="form-limit" limit=300>
							<textarea rows="4"  class="form-textarea"  name="abstract" oninput="dataInput()"><?php if(!empty($tuwen)){echo $tuwen['abstract'];}?></textarea>
							</div>
							</div>
							
							<div class="form-row clearfix">
							<label class="name">原文链接</label>
							<divclass="clearfix" >
							<input type="text"  class="form-textbox" name="linkurl" oninput="dataInput()" value="<?php if(!empty($tuwen)){echo $tuwen['linkurl'];} ?>">
							</div>
							</div>
							
							<div class="form-row clearfix">
							<div><label class="name">封面</label>	</div>

							<div class="clearfix">
						
						
							<div class="js_uploadBox">
		              			<div class="js_showBox bRadiusn"><img id="defalutimage" class="js_logoBox block" src="<?php if(!empty($course["defaultpic"])){echo Img($course["defaultpic"]);}else{ echo "/Public/uploads/common/timg.jpg" ;} ?>"  ></div>
				                <div class="btn-upload clearfix" style="text-align: center; margin-top: 30px;">
				                    <a href="javascript:void(0);"  onclick="addTypeChange('<?php echo M_URL('Index','imageslist','',GP('name-defaultpic,type-other'));?>','930px','610px',{title:'选择图片',type:'top'});"   class="selectImageBtn">
				                    <span class="js_uploadText" >上传图片</span>
				                   	</a>
				                    <p>限制：2MB,支持jpg|png|gif</p> 
				                    
				               </div>
						              
						   
							</div>
							
							</div>
							</div>
							</div>
							</div>
					</div>
					
					<div class="moBan-tab" id="xitong">
						<div style="border:1px solid #e5e5e5; height: 360px;">
							<div class="moBan-addPic" id="focusReplyCourse3" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','replyCourse','',GP("ab-focusReplyCourse3"));  ?>','850px','600px');">
								<i class="iconfont icon-jiahao bgi"></i> 
							</div>
						</div>
					</div>
				</div>
			</div>
			
		
	
	</div>
	
	 <div id="ksBoxFooter">
	        	<div class="form-footer">
	        		<span class="d-inline-block">
		            	<button type="button"  onClick="do_reg()" class="ks-bt bt-pue">确认</button>
		           		<button type="button"  onclick="javascript:history.go(-1);" class="ks-bt bt-def">取消</button>
	           	</span>
	        	</div>
	       </div>
</div>

<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
	var num=1;
	
	module.require(['$','backstage','nicescroll','Zpopup'],function(){
		
		loadScorllJs();
		var frc3= $("#focusReplyCourse3");
		var frcData ='<i class="iconfont icon-jiahao bgi"></i>';
		/****预加载****/
		$(window).load(function(){takeInput();});
		/**初始化变量***/
		 
		/***选中左侧事件****开始****/
		
		
		
		/***/
		
		$(".from").click(function(){
			var ids = $("#keytype").find("input[type=radio]:checked").val();
			var index=$("#keytype").find("input[type=radio]:checked").parent().index();
			var srcs = $(".xz").find(".pic").val();
			if(srcs==""){srcs='/Public/uploads/common/timg.jpg';}
			if(index==0){takeInput();$("#defalutimage").attr("src",srcs);}else{
				var SuinSrc = $(".xz").find(".pic").val();
				if(SuinSrc!="undefined"){
					if(SuinSrc==""){
						SuinSrc='/Public/uploads/common/timg.jpg';
					}
					MetaInput(SuinSrc);
				}
				
			}
			$(".moBan-tab").hide();
			$("#"+ids).show();
			$(".xz").find(".keytype").val(index);
		})
		/***切换定义模式****结束****/
		//选中图片返回结果
		top.imgUploadBack = function(src,img){
			document.getElementById('defalutimage').src = src;
			$(".xz").find(".showImg").attr("src",src);
			$(".xz").find(".pic").val(src);
		};

		
		
		
		
	});
	
	function meau($target,num){
		console.log($target,num);
		var keytype = $(".xz").find(".keytype").val();
		if(keytype==0){dataInput();}//将值存入隐藏hidden
		$(".moBan-ul li").removeClass("xz");
	 	$(".moBan-ul li").css("border","1px solid #ccc");
	 	$($target).css("border","0");
	 	$($target).attr("class","xz");
		
		if(keytype==0){		
			tabmModel("zidingyi",keytype);
			takeInput();
		}else{
			tabmModel("xitong",keytype);
			MetaPush();
			var SuinSrc = $(".xz").find(".pic").val();
			if(SuinSrc!="undefined"){
				if(SuinSrc==""){
					SuinSrc='/Public/uploads/common/timg.jpg';
				}
				MetaInput(SuinSrc);
			}
		}//改变样式
	}
		
	function do_reg(){
		var flag = true;
		$(".moBan-ul li").each(function(){
			var title=$(this).find(".title").val();
			var author=$(this).find(".author").val();
			var texts=$(this).find(".text").val();
			var abstract=$(this).find(".abstract").val();
			var linkurl=$(this).find(".linkurl").val();
			var pic=$(this).find(".pic").val();
			if(!title||!texts||!author||!abstract||!linkurl||!pic){
				Alert('请填写必要内容');
		 		flag = false;
		 		return false
			}
		})
		if(flag == false){return false;}  
		var countList =[];
		$(".numcal").each(function(){
		 	countList.push($(this).val());
		});
		$("#countList").val(countList);
		dataInput();
		$("#myform").submit();
	 }
	 
	/**正向输入（切卡）**/
	function takeInput(){
	
		$(".moBan-tab").eq($(".xz").find(".keytype").val()).show();
	 	$("#zidingyi").find("input[name='title']").val($(".xz").find(".title").val());
	 	$("#zidingyi").find("input[name='author']").val($(".xz").find(".author").val());
	 	var setdata= $(".xz").find(".text").val();
	 	text.setContent(setdata);
	
	 	$("#zidingyi").find("textarea[name='abstract']").val($(".xz").find(".abstract").val());
	 	$("#zidingyi").find("input[name='linkurl']").val($(".xz").find(".linkurl").val());
	 	var srcs = $(".xz").find(".showImg").attr('src');
	 	$("#defalutimage").attr("src",srcs);
		 	
	
	};
	/**反向输出**/
	function dataInput(){
		//得到编辑区域所有内容
		var title =$("#zidingyi").find("input[name='title']").val();
	 	var author =$("#zidingyi").find("input[name='author']").val();
	 	var conts =	text.getContent();
	 	var abstract =$("#zidingyi").find("textarea[name='abstract']").val();
	 	var linkurl =$("#zidingyi").find("input[name='linkurl']").val();
	 	var src =$("#defalutimage").attr("src");	
	 	//console.log(title+"|"+author+"|"+title+"|"+abstract+"|"+linkurl+"|"+src); 	
	 	
	 	//将得到的所有内容插入当前选中的input-hidden内部。
		$(".xz").find(".title").val(title);
	 	$(".xz").find(".author").val(author);
	 	$(".xz").find(".text").val(conts);
	 	$(".xz").find(".abstract").val(abstract);
	 	$(".xz").find(".linkurl").val(linkurl);
	 	$(".xz").find(".pic").val(src);
	 	$(".xz").find(".showImg").val(src);
	 	//选项卡实时刷新值
		$(".xz").find(".showImg").attr(src);
	 	$(".xz").find(".titleMark").text(title);
	
	};
	
	function MetaInput(SuinSrc){
		var SuinTitle = $(".xz").find(".title").val();
	 	var SuinSt = $(".xz").find(".author").val();
	 	var data='<div class="Suin"><div class="SuinImg"><img  src="'+SuinSrc+'"  style="width:100%;height:100%;"></div><div class="SuinMark mt5">';
		data+='<div class=" SuinTitle">'+'名称： '+SuinTitle+'</div><div class="SuinSt">'+'授课老师：'+SuinSt+'</div>';
		frc3.html(data);
	 		
	 	
		
		
		
	}
	
	function MetaPush(){
		frc3.html(frcData);	
	}
	
	/***切换定义模式****开始****/
	function tabmModel(Mode,vue){
		$(".moBan-tab").hide();
		$("#"+Mode).show();
		$(".xz").find(".keytype").val(vue);
		$("#keytype label").removeClass("label-on");
		$("#keytype label").eq(vue).addClass("label-on");
		$("#keytype").find("input[type=radio]")[vue].checked = true;	
	}
	
	
	
	
	/****增加左侧模块*****/
	function addModel(){
		var $tabContent = $(".moBan-ul");
	 	var length =$(".moBan-ul li").length;
	 	var keytype = $("#keytype").find("input[type=radio]:checked").parent().index();
	 	
	 	//console.log(length);
	 	
	 	if(length<5){
	 		
	 		num++;
	 		$("#sunList").val(num);
		    var data = '<li id="model-'+num+'" onclick="meau(this,'+num+')"><div class="moBan-imgBox2 clearfix moNum" ><div class="moBan-title titleMark"></div>';
		    data +='<div class="wechat-imgbox2-img"><img class="showImg"  src="/Public/uploads/common/timg.jpg" /></div>';
		    data +='<p class="moBan-boxMask"><span class="fr" onclick="delModel(event,'+num+')"><i class="iconfont icon-lajitong1"></i></p></div>';
		    data +='<input type="hidden"  class="form-textbox keytype" name="keytype'+num+'" value="'+keytype+'">';
		    data +='<input type="hidden"  class="form-textbox title yanzheng" name="title'+num+'" value="">';
			data +='<input type="hidden"  class="form-textbox author yanzheng" name="author'+num+'" value="" >';
			data +='<input type="hidden"  class="form-textbox text yanzheng" name="text'+num+'" value="" >';
			data +='<input type="hidden"  class="form-textbox abstract yanzheng" name="abstract'+num+'" value="" >';
			data +='<input type="hidden"  class="form-textbox linkurl yanzheng" name="linkurl'+num+'" value="">';
			data +='<input type="hidden"  class="form-textbox pic yanzheng" name="pic'+num+'" value="undefined">';	
			data +='<input type="hidden"  class="form-textbox rootID numcal" name="rootID'+num+'" value="'+num+'"></li>';	
			$tabContent.append(data);
			$("#model-"+num).click(); 
			if(keytype==1){MetaPush();}
			var lengths =$(".moBan-ul li").length;
		    $("#sunLength").val(lengths);
			//上传事件
			uploadView('160','100','upImg'+num+'','js_uploadText'+num+'','js_uploadBox'+num+'','js_showBox'+num+'','moBan-imgBt'+num+'');
	
		}else{
			Alert('您最多只可以发布5条信息');
	 	}
	
	 
	}
	
	function checkCont(){
		var flag = true;
		$(".moBan-ul li").each(function(){
			
			var title=$(this).find(".title").val();
			var author=$(this).find(".author").val();
			var texts=$(this).find(".text").val();
			
			if(title&&texts&&author){
				 flag = true;
			}else{
				flag = false;
				
				popup.tips({
		 			title:'请填写必要内容'
		 		})
		 	
			}
		})
		
		if(flag = false){
			return false;
		}
			
	}
	/****删除左侧模块****/
	function delModel(event,id){
	 	$("#model-"+id).remove();
	    var lengths =$(".moBan-ul li").length;
	    $("#sunLength").val(lengths);
		event.stopPropagation();
	}



</script>
</body>
</html>
