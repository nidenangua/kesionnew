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
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
</head>
<body class="ks-wrap"  style="padding-top: 0;">
	
	<!--开始-->
	
	<div id="ksBoxHead" style="overflow: hidden;">
		<div class="clearfix ks-top-tab">
				<!--搜索-->
				<form  action="<?php echo M_URL($this->AppName.'/Index','addKpoint',$courseid,GP('')) ?>">
				<div class="fl ks-top-search">
					<input type="text" class="sc-text" name="searchkeyword" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>">
					<button type="button"  onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','addKpoint',$courseid); ?>','<?php echo URL_MODEL;?>');"  class="ks-head-search"/><i class="iconfont icon-sousuo"></i></button>
				</div>	
				</form>
				<!--搜索-->
			
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
    </table>
   
    <table width="100%" cellpadding="0" cellspacing="0" border="0" class="ks-table">
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
    </div>
    <div id="ksBoxFooter" stle="height:300px">
		<div class="clearfix mt10 mr30">
		    <div class="rightTd alignLife fl">
		        <input type="button" type="button" class="ks-bt bt-pue" value="确认" name="confirm" id="abc">
		    </div>
		  <div class="fr"> <?php echo $page->show(3); ?></div>  
		</div>
	</div>
	
	
</form>

<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
	module.require(['$','backstage','nicescroll','cookie'],function(){
		$(function(){ 
			 var addKption = $.cookie("addKption<?php echo $courseid; ?>");
		
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
    		 var kption = $.cookie('addKption<?php echo $courseid; ?>');
    		 var ab = new Array(); 
    		$(".select-check").each(function(){
				 ab.push($(this).val());
				 var tk = ab.join(",");
				 $.cookie('addKption<?php echo $courseid; ?>',tk);
			})
    	}
     
     var kption = $.cookie('addKption<?php echo $courseid; ?>');
     
      if(!kption){Alert('请选择');return false;}
      parent.$('.chapterKption').remove();
	  $.ajax({
			type:"POST",
			url:"<?php echo UOOT; ?>Plus/Kesion.ajax.php?act=kption",
			data:{kption:kption,courseid:<?php echo $courseid; ?>},
			success:function(text){
				parent.closePopup('all');
			   parent.$('#knowledge').append(text);
			   parent.colorRadom();
			   $.cookie('addKption<?php echo $courseid; ?>','',{ expires: -1 });
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
	 var addKption = $.cookie("addKption<?php echo $courseid; ?>");
	 if(!addKption){
		 var ab = new Array(); 
		 ab.push(b);
		 var tk = ab.join(",");
		 $.cookie('addKption<?php echo $courseid; ?>',tk);
	 }else{
         ab =addKption.split(",");
	     if(a==false){
		    ab.splice($.inArray(b,ab),1);
	        var tk = ab.join(",");
	     }else{
			ab.push(b);
			var tk = ab.join(",");
	     }
	     $.cookie('addKption<?php echo $courseid; ?>',tk);
	}
}






<?php if(!empty($course['kpoint'])){ ?>
	
	 
	
<?php } ?>	

</script>


</body>
</html>
