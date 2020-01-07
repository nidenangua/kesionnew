<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="renderer" content="webkit"> 
	<title>添加知识点</title>
	
	<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
	
</head>
<body class="ks-wrap" style="padding-top: 0px;">

	<!--开始-->
	<div class="ks-wbox" style="padding: 0;">

		<div id="ksBoxHead">
			<div class="clearfix ks-top-tab" style="margin-bottom: 10px;" >
				<div class="fl">
					<!--栏目块-->
					<div class="form-tip clearfix">
					    <span class="form-tip-blick"></span>
					    <span class="form-tip-word">添加知识点</span>
					</div>
				    <!--栏目块-->
			    </div>
			    
				<div class="fr ks-top-search">
					<!--搜索-->
					<form  action="<?php echo M_URL($this->AppName.'/Index','addKpoint',$courseid,GP('')) ?>">
					<div class="fl ks-top-search">
						<input type="text" class="sc-text" name="searchkeyword" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>">
						<button type="button" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','addKpoint'); ?>','<?php echo URL_MODEL;?>');" class="ks-head-search" value="搜索"/><i class="iconfont icon-sousuo"></i> </button>
					</div>	
					</form>
					<!--搜索-->
				</div>
			</div>	
		<!--结束-->
		</div>	
		
	<form action="<?php echo M_URL($this->AppName.'/Index','doaddKpoint',$courseid,GP('')) ?>"  method="post">
	   <div >
		   <table width="100%" cellpadding="0" cellspacing="0" border="0" class="ks-table">
		       <tr >
		         <td  class="form-in"><input type="checkbox" name=""   class="verAlignMiddle checkall check-all " id="selectAll"></td>
		         <td  class="w80">知识点</td>
		         <td class="w200 alignCenter">介绍</td>
		       </tr>
		   
		      	<?php foreach($values as $k=>$v){ ?>
		       	<tr class='abc'>
		        <td class="form-in">
		            <div class="order-product pd-b">
		            	<input type="checkbox" class="select-check" id="tk<?php echo $v['id']; ?>" name="kption" value=" <?php echo $v['id'];?>" onClick="getKption(this)" >
		            </div>
		        </td>
		        <td class="w80" id="name<?php echo Field($v['id']) ?>"><?php echo Field($v['title']); ?></td>
		        <td class="w200 alignCenter">
		            <?php echo Field($v['intro']);?> 
		        </td>
		       </tr>
		       <?php } ?>
		    </table>
		       <?php echo NoC($values);?>
	    </div>
	  	<div class="clearfix ks-popup-footer" >
	  		<div class="mt20">
			    <div class="fl">
			        <input type="button" type="button" class="ks-bt bt-pue" value="确认添加" name="confirm" id="abc">
			    </div>
			    <div class="fr">
			    	<?php echo $page->show(3); ?>
			    </div>
			</div>
		</div>
		</form>
	</div>

<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>

<script>
	module.require(['$','backstage','nicescroll','echarts','round','cookie'],function(){
		loadScorllJs();
			$(function(){ 
				 var addKption = $.cookie("addKption");
		
			 if(addKption){
			   var ab =addKption.split(",");
			   for(var i=0;i<ab.length;i++)
			   {
				   $("#tk"+parseInt(ab[i])).attr('checked','checked');
				}
			 }
		});
		
		$("#abc").click(function(){
      
    	if($('#selectAll').is(':checked')){
    		 var kption = $.cookie('addKption');
    		 var ab = new Array(); 
    		$(".select-check").each(function(){
				 ab.push($(this).val());
				 var tk = ab.join(",");
				 $.cookie('addKption',tk);
			})
    	}
  
     var kption = $.cookie('addKption');
     
		      if(!kption){Alert('请选择');return false;}
		      parent.$('.chapterKption').remove();
			  $.ajax({
					type:"POST",
					url:"<?php echo UOOT; ?>Plus/Kesion.ajax.php?act=getkption",
					data:{kption:kption },
					success:function(text){
						parent.closePopup('all');
					   parent.$('#knowledge').append(text);
					  
					},
					error:function(){
						alert("发生了错误,请检查!");
					}
			 }); 
		   
		
		});


	})

function getKption(obj){
   	 var a = $(obj).prop('checked');
	 var b =$(obj).val();
	 var addKption = $.cookie("addKption");
	 if(!addKption){
		 var ab = new Array(); 
		 ab.push(b);
		 var tk = ab.join(",");
		 $.cookie('addKption',tk);
	 }else{
         ab =addKption.split(",");
	     if(a==false){
		    ab.splice($.inArray(b,ab),1);
	        var tk = ab.join(",");
	     }else{
			ab.push(b);
			var tk = ab.join(",");
	     }
	     $.cookie('addKption',tk);
	}
}
<?php if(!empty($course['kpoint'])){ ?>
	
	 
	
<?php } ?>	
</script>


</body>
</html>
