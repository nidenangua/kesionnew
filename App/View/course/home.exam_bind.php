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
<body class="ks-wrap">

	
	<div >
		  
			<div class="clearfix">

				 
				  
				  <div class="ks-top-search fl">
							<input type="text" class="sc-text" name="searchText" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>"> 		
							<button type="submit" class="ks-head-search" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','bindPaper'); ?>','<?php echo URL_MODEL;?>')" ><i class="iconfont icon-sousuo"></i></button>
						</div>
				  
					<div class="fr">
						<ul class="ks-head-choice">
						
						
						<li>
							<div class="ks-head-el">
							<a href="javascript:void(0)" onclick="addPaper()" class="ks-heade-button ks-head-primary "><i class="iconfont icon-jiahao "></i>添加新试卷</a>
		
							</div>
						</li>
						
							
						</ul>
					</div>
				</div>
			
		</div>   
		  
		  
	</div>
	<form target="hidframe"  action="<?php  echo M_URL($this->AppName.'/Index','batchBindPaper',$courseid,GP('p-'.$page->now_page)) ?>" method="post" id="myform">
	<div style="height: 350px;">
		<table width="100%" cellpadding="0" cellspacing="0" border="0" class="ks-table mt20">
			<tr>
			 	<td><input type="checkbox" class="select-checks selectAll"></td>
                <td>试卷名称</td>
                <td>分值</td>
                <td>添加时间</td>
                <td>操作</td>
		    </tr>
	        <?php foreach($values as $k=>$v){ ?>
		    <tr>
			 	<td><input type="checkbox" class="select-checks "  name="aid[]" value="<?php echo $v['paperid']; ?> "></td>
			 	<td style="text-align: left;"><?php echo $v['Title'] ?></td>
			 	<td><?php echo $v['ExamScore'] ?></td>
                <td> <?php echo date('Y/m/d',$v['adddate']);  ?> </td>
                <td>
                  <a href="<?php echo M_URL($this->AppName.'/Index','dobindPaper',$v['paperid'],GP("courseid-$courseid")) ?>"  title="加入课程">绑定课程</a>
                </td>
		   </tr>
	       <?php } ?>
	       
		</table>
			<?php echo NoC($values);?>
		<input type="hidden" name="batch" id="batch1" />
	</div>
	</form>
	<div class="ks-bom clearfix">
			<span class="fl">
				<label class="mr20 fl"><input type="checkbox" class="select-checks selectAll">全选</label>
				<button type="button" class="ks-bt bt-pue" onclick="submitform(1)" >批量添加</button>
			</span>
			<div class="fr"><?php echo $page->show(3); ?></div>
		</div>

	
</form>
</div>

<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
	
	
	module.require(['$','backstage','nicescroll','cookie'],function(){
		loadScorllJs();
		$(function(){ 
				var student = $.cookie('student');
				if(student){
				   var ab =student.split(",");
				   for(var i=0;i<ab.length;i++){
					   $("#student"+parseInt(ab[i])).attr('checked','checked');
				   }
				}
		});
		
	})
	
	
	
function submitform(type){
	$('#batch1').val(type);
	$('#myform').submit();
}
function getTK(obj){
	var a = $(obj).prop('checked');
	var b = $(obj).val();
	var student = $.cookie('student');
	if(!student){
		var ab = new Array(); 
		ab.push(b);
		var tk = ab.join(",");
		$.cookie('student',tk,{ expires: 7, path: '/' });
	}else{
		ab = student.split(",");
		if(a==false){
			ab.splice($.inArray(b,ab),1);
			var tk = ab.join(",");
		}else{
			ab.push(b);
			var tk = ab.join(",");
		}
		$.cookie('student',tk,{ expires: 7, path: '/' });
		var student = $.cookie('student');
		
	}
}	




function addPaper(){
	top.closePopup(window.name);
	addTypeChange('<?php echo M_URL('exam/Index','paperAdd',$courseid,GP("courseid-$courseid,appid-10,bappid-$this->appid")) ?>','800px','600px',{title:'添加试卷',type:'top'})
	
}









</script>
</body>
</html>
