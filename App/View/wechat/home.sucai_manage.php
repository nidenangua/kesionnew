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
	<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/wechat.css" rel="stylesheet"> 
	<link href="<?php echo UOOT;?>Public/app/css/template.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
	<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<body class="ks-wrap">
		<div class="bRadius10 ks-wbox">
			
			<!--开始-->
			<div id="ksBoxHead">
				<div class="Header-tool clearfix">
					
					
					<div class="fl">
						<!--栏目块-->
						  <input name="allChecked" type="checkbox" value="allChecked" id="selectAll">全选
							<a class="ks-bt bt-pur" href="<?php echo M_URL($this->AppName.'/Index','tuWen','',GP("")); ?>">
							<i class="iconfont icon-jiahao"></i>新增素材</a>
					    	<a class="ks-bt bt-pur" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/test','catchUpMenu','',GP("")); ?>','500px','160px');" style="margin-left:15px;display:inline-block"> 
							<i class="iconfont">&#xe614;</i>同步素材</a>
					    <!--栏目块-->
				    </div>
				  
				    
				   	
					 <div class="fr ks-top-search">
		              
						<label class="mr10">
					        <select class="w150 inputText bRadius5" id="keytype">
					            <option value="1" <?php if($keytype==1)echo 'selected';?>>标题</option>
					            <option value="2" <?php if($keytype==2)echo 'selected';?>>内容</option>
						    </select>
					    </label>
					    <input type="text" class="sc-text" name="searchText" id="keyword"  value="<?php if(isset($keyword))echo $keyword;?>">
					    <input type="button" class="sc-button" name="searchBtn" value="搜索" 
					     onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','materialManage'); ?>','<?php echo URL_MODEL;?>')">	
		     		</div>
					<!--操作范围-->
				
				</div>
				
			
		
				
				<!--结束-->
				
				
			</div>
		
			<div id="ksBoxContent">
		        <form class="form-horizontal" method="post"   target="hidframe" action="<?php {echo M_URL($this->AppName.'/test','bathDelMenutest','',GP(""));} ?>" id="myform">
					<div class="Meta-conlist">
					  <ul class="Meta-ul clearfix">

		           <?php foreach($tree as $k=>$v){ ?>
					    <li class="Meta-ul_li">
					      <div class="op_Meta-con">
					      	 <?php $treeFirst = array_slice($v,0,1)[0]; ?>
					        <a style="text-align:center; position:relative; height:37px;">
					          <input type="checkbox" name="ids" id="id[]" media_id= "<?php echo $treeFirst['media_id'];?>" value="<?php echo $treeFirst['id'] ?>" class="select-check" style="vertical-align:middle; position:absolute; top:11px; left:40%; right:40%;"></a>
					         
					        <a href="<?php echo M_URL($this->AppName.'/Index','tuWen',$treeFirst['id'],GP("")); ?>">
					          	<i class="iconfont icon-bianji4"></i>
					        </a>

	                        <a href="javascript:void(0);"  onclick="Confirm('是否删除此菜单？该操作不可逆!',
	                        '<?php if(!empty($treeFirst['media_id'])){$dd='media_id-'.$treeFirst['media_id'];}else{$dd='media_id-0';}; echo M_URL($this->AppName.'/test','delMenutest',$treeFirst['id'],GP($dd));?>')">	
					          <i class="iconfont icon-lajitong1"></i>
					        </a>
					        <div class="clear"></div>
					      </div>
					     
                         <div class="Meta-ultop">
					        <div class="Meta-ultime"><?php echo  Field(date("Y-m-d",$treeFirst['create_at']));?></div>
					        <div class="Meta-ulimgt">
					          <img src="<?php echo Field($treeFirst['pic']);?>">
					          <div class="Meta-ulimg_t">
					            <a href="#"><?php echo Field($treeFirst['titles']);?></a></div>
					        </div>
					      <?php $treeLast = array_slice($v,1);?>
					        
					        
					      </div>
					      <div class="Meta-bigBox">
					        <div class="Meta-ulbottom">
					          <ul class="Meta-ulse">
					          	 <?php foreach($treeLast as $k=>$v){ ?>
					            <li>
					              <div class="add_Meta-img_right">
					                <img src="<?php echo Field(Img($v['pic']));?>" id="img_right1"></div>
					              <div class="add_Meta-img_left1" style="float: left;">
					                <a class="title_add_sc"><?php echo Field($v['titles']);?></a></div>
					              <div class="clear"></div>
					            </li>
					            <?php }?> 
					          </ul>
					        </div>
					      </div>
					    </li>
					<?php }?>   
					</ul>
					<?php echo NoC($tree);?>
					  <div class="clear"></div>
					  <div class="norecord" style="display:none ; text-align:center;">
					    <span style="text-align:center">暂无素材</span></div>
					</div>
                    <input type="hidden" name="id"/>
                    <input type="hidden" name="media_id"/>
		        </form>
		    </div>      	  
	         
	    </div>
		
		<div id="ksBoxFooter">
			<div class="ks-bom clearfix">
				<span class="fl">
					 
			       <button class="ks-bt bt-pue" onclick="bathDelMenu()"><i class="iconfont icon-lajitong"></i>批量删除</button>
			    </span>
			
			</div>
		</div>
		


<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script src="<?php echo UOOT;?>Public/common/js/animate-common.js"></script>
<script>
	
loadScorllJs();	
function updatesStatus(id){
	  var url = '<?php echo UOOT;?>Plus/Kesion.ajax.php?act=question';      
	  $.ajax({
			type:"get",
			url:url,
			data:{id:id},
			success:function(data,textStatus){
				$("#a"+id).html(data);
			},
			error:function(){
				alert("发生了错误,请检查!");
			}
	   })
}
uploadView(180,120); 
/*设置切换*/
$(function(){	
	$('.titleTab li').click(function(){
		$(this).addClass('curr').siblings().removeClass('curr');
		$('.infoBox .webConBox>.configTab:eq('+$(this).index()+')').show().siblings().hide();	
	})
});
$(function(){
	$("input[type=file]").change(function(){$(this).parents(".uploader").find(".filename").val($(this).val());});
	$("input[type=file]").each(function(){
//	if($(this).val()==""){$(this).parents(".uploader").find(".filename").val("");}
	});
});
function cleckSitename(){
    var sitename = document.getElementById("sitename").value;
	if(sitename!= ""){
	  var url = "<?php echo M_URL('website','cleckSitename'); ?>";
	  var data ={
	   sitename:sitename,
	  };
	  $.ajax({
			type:"post",
			url:url,
			data:data,
			success:function(text){
			  
				  $("#un_ck").html(result.result_desc);
			   if(result.result_code == "OK"){
				  $("#un_ck").css("color","green");
			   }else{
				   alert("ss");
				  $("#un_ck").css("color","red");
			   }
			},
			error:function(){
				alert("发生了错误,请检查!");
			}
	  })
	}
}

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

function bathDelMenu(){
	var id       = [];
	var media_id = [];
	$('input[name="ids"]:checked').each(function () {
		id.push($(this).val());
		media_id.push($(this).attr('media_id'));
            
    });
	$('input[name="id"]').val(id);
	$('input[name="media_id"]').val(media_id);
    $('#myform').submit();
}
</script>
