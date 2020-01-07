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
	<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
	
</head>
<body class="ks-wrap" style="padding:10px 20px 50px 20px;">
	
	<div  class="clearfix">
        <select class="inputText w100p fl" onchange="getval(this,'<?php echo GP(''); ?>','<?php echo M_URL('Index','selectTk');; ?>','courseid','<?php echo URL_MODEL;?>')">    
               <option value="0" <?php if(isset($courseid))if($courseid == 0) echo "selected"; ?>>选择课程</option>
               <?php  foreach($course as $k=>$v){ ?>
               <option value="<?php echo $v['courseid'] ?>" <?php if(isset($courseid))if($courseid == $v['courseid']) echo "selected"; ?>><?php echo $v['title'] ?> </option>
               <?php  } ?>
        </select>
         <select class="inputText w100p fl ml10" onchange="getval(this,'<?php echo GP(''); ?>','<?php echo M_URL('Index','selectTk');; ?>','tktype','<?php echo URL_MODEL;?>')">
            <option value="0" <?php if(isset($tktype))if($tktype == 0) echo "selected"; ?>>全部题型</option>
            <option value="1" <?php if(isset($tktype))if($tktype == 1) echo "selected"; ?>>单选题</option>
            <option value="2" <?php if(isset($tktype))if($tktype == 2) echo "selected"; ?>>填空题</option>
            <option value="3" <?php if(isset($tktype))if($tktype == 3) echo "selected"; ?>>判断题</option>
            <option value="4" <?php if(isset($tktype))if($tktype == 4) echo "selected"; ?>>问答题</option>
            <option value="5" <?php if(isset($tktype))if($tktype == 5) echo "selected"; ?>>材料题</option>
            <option value="6" <?php if(isset($tktype))if($tktype == 6) echo "selected"; ?>>多选题</option>
        </select>
        <select class="inputText w100p fl ml10" onchange="getval(this,'<?php echo GP(''); ?>','<?php echo M_URL('Index','selectTk'); ?>','tklevel','<?php echo URL_MODEL;?>')">
           <option value="0" <?php if(isset($tklevel))if($tklevel == 1) echo "selected"; ?>>难度</option>
           <option value="1" <?php if(isset($tklevel))if($tklevel == 1) echo "selected"; ?>>简单</option>
           <option value="2" <?php if(isset($tklevel))if($tklevel == 2) echo "selected"; ?>>一般</option>
           <option value="3" <?php if(isset($tklevel))if($tklevel == 3) echo "selected"; ?>>困难</option>
        </select>
         <select class="inputText w100p fl ml10"  onchange="getval(this,'<?php echo GP(''); ?>','<?php echo M_URL('Index','selectTk'); ?>','papertypeid','<?php echo URL_MODEL;?>')">
         	<option <option value="0">全部</option>
        	 <?php foreach($papertype as $k=>$v){?>
                <option value=" <?php echo $v['id'] ?>"  <?php  if($v['id'] == $papertypeid) echo "selected"; ?>>
                       <?php echo $v['typeName']?>
                </option>
                <?php } ?>
        </select>
        <div class="ks-top-search fr">
            <form target="hidframe" >
                <input type="text" class="sc-text w200 fl" name="searchText" id="keyword" value="<?php if(isset($keyword)) echo $keyword ;?>"> 
                <button type="button" class="ks-head-search" name="searchBtn" value="搜索" onclick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL('Index','selectTk'); ?>','<?php echo URL_MODEL;?>')"><i class="iconfont icon-sousuo"></i></button>
            </form>
	     </div>
    </div>     
    
    <div >
	    
	    <table width="100%" cellpadding="0" cellspacing="0" border="0" class="ks-table mt10" style="border-bottom:0;">
	        <thead>
		        <tr>
		            <th nowrap="nowrap">序号</th>
		            <th>题型</th>
		            <th>题目</th>
		            <th nowrap="nowrap">录入者</th>
		        </tr>
	        </thead>
	       
	        <tbody>
	        		<?php foreach($tk as $k=>$v){ 
			        if($v['tktype'] == 1){
					  $tktype = '单选题';
					  $option=explode("$$$",$v['options']);
					  $v['options']=$option[0];
					 
					}elseif($v['tktype'] == 6){ 
						$tktype = '多选题';
					  $option=explode("$$$",$v['options']);
					  $v['options']=$option[0];
					}elseif($v['tktype'] == 2){
						$tktype = '填空题';
					}elseif($v['tktype'] == 3){
						$tktype = '判断题';
					}elseif($v['tktype'] == 4){
					     $tktype = '问答题';
						 $anser = explode("$$$",$v['anser']);
						  $v['anser']=$anser[0];
					}elseif($v['tktype'] == 5){
					      $tktype = '材料题';
						  $option=explode("$$$",$v['options']);
						  $v['options']=$option[0];
						  $anser = explode("|$|",$v['anser']);
						  $v['anser']=$anser[0];
					}?>
	        <tr >
	            <td width="40" nowrap="nowrap">
	                <div class="order-product pd-b">
	                    <input type="checkbox" class="select-checks" id="tk<?php echo $v['tkid'] ?>" name="tkid[]" value=" <?php echo $v['tkid'] ?>" onClick="getTK(this)" >
	                     
	                </div>
	            </td>
	            <td nowrap="nowrap" width="100"><?php echo $tktype;?></td>
	            <td width="50%" class="td-title" style="text-align: left;"><?php echo Field(strip_tags($v['options']));?><div class="exam-anser">答案：<?php echo Field(strip_tags($v['anser']));?></div></td>
	            <td><?php echo Field($v['inputer']);?></td>
	        </tr>
	       <?php }?>
	        </tbody>
	       
	       
	    </table>
    </div>
   <div class="clearfix ks-popup-footer">
    	<div class="fl mt20">
    		<span class="ks-bt bt-def mr10 ks-ctn" id="selectAll" >
		        	<input type="checkbox" class="fl select-checks selectAll" style="margin-top: 6px;" >全选
		        </span>
    		<input type="button" onclick="addtk();" class="ks-bt bt-pue mr15" value="确定" name="confirm">
    	</div>
    	<div class="fr mt20"><?php echo $page->show(3); ?></div>
    </div>

<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>

<script>
	
	module.require(['$','backstage','nicescroll','cookie'],function(){
			loadScorllJs();	
			
		var selectTk = $.cookie('selectTk');
		
		if(selectTk){
		   var ab =selectTk.split("|");
		   for(var i=0;i<ab.length;i++){
			   $("#tk"+parseInt(ab[i])).attr('checked','checked');
		   }
		}
				
		$('.selectAll').click(function(){
			var aids = document.getElementsByName('tkid[]');
			$(aids).each(function(){
				getTK(this)
			})
		})
			
	})
	
	function getTK(obj){
		
		obj.checked ? resetCookie(obj.value,1) : resetCookie(obj.value,0)
		
		
	}
	
	//type 0减少 1增加
	function resetCookie(v,type){
		
		var selectTk = $.cookie('selectTk');
		if(selectTk){
			var data = selectTk.split('|');
			var newStr = '';
			for(var i=0;i<data.length;i++){
				if(data[i] != v){
					!newStr ? newStr=data[i] : newStr+='|'+data[i]
				}
			}
			
			type === 1 && (newStr += '|'+v)
			selectTk = newStr
		}else{
			if(type==1){
				selectTk = v;
			}
		}

		$.cookie('selectTk',selectTk,{ expires: 7, path: '/' });
		
	}

	var tmNum = <?php echo $tmNum ; ?>; 
	function addtk(){
		
		var selectTk = $.cookie('selectTk');
		top.DataCallBack(selectTk,tmNum);
		
		top.closePopup(window.name);
		
	}
</script>

</body>
</html>