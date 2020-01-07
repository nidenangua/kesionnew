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
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
</head>
<body class="ks-wrap">
	<!--开始-->
	<div class="bRadius10 bg-white ks-wbox">
	<div id="ksBoxHead">	
		<div class="generalTitle clearfix">
		    <span class="title-icon"><i class="iconfont icon-myorder"></i></span>
	        <span class="gTitle fsize18">教室管理</span>
		    <div class="fr">
		    	<!--按钮块--->
				<a href="javascript:void(0)" class="ks-bt bt-def mr10" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','addJiaoshi',$classroomid,GP('')) ?>','850px','600px',{title:'选择老师',type:'top'})" id="addJiaoshi"><i class="iconfont icon-jiahao"></i>添加教室</button></a>
				<!--按钮块--->
		    </div>
		</div>
		<div class="clearfix ks-top-tab">
			<div class="fr ks-top-search">
				<!--搜索--> 
			<label class="mr10">
				<select class="w150 inputText bRadius5" id="keytype">
					<option value="1" <?php if($keytype==1){echo 'selected="selected"';} ?>>教师名称</option>
				</select>
			</label>
			<form target="hidframe"  class="fr">
				<div class="fr ks-top-search">
					<input type="text" class="sc-text" name="searchText" id="keyword"  value="<?php if(isset($keyword)) echo $keyword; ?>">
					<input type="submit" class="sc-button" name="searchBtn" value="搜索"  onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','showJiaoshi',$classroomid); ?>','<?php echo URL_MODEL;?>')">
				</div>
			</form>
				<!--搜索-->
			</div>
		</div>	
		<!--结束-->
    </div>
<form target="hidframe"  action="<?php echo M_URL($this->AppName.'/Index','batchJiaoshi',$classroomid,GP('p-'.$page->now_page.',classroomid-'.$classroomid));  ?>" method="post" id="myform">

    <div id="ksBoxContent">
        <table width="100%" cellpadding="0" cellspacing="0" border="0" class="ks-table">
            <thead>
            <tr>
            	<th><input name="" type="checkbox" value="" class="verAlignMiddle checkall check-all" id="selectAll"></th>
                <th>教室名称</th>
                <th>所在学校</th>
                <th>地址</th>
                <th class="alignCenter hLh40 pt0 pb0 fsize14 w93">操作</th>
            </tr>
            </thead>
            <tbody>
             <?php foreach($values as $k=>$v){if($v['status']==0){$status = '<span style="color:#ef5e1e ;">未审</span>';}else{$status = "已审";} ?>
             	<tr>
             		<td class="alignCenter hLh40 pt0 pb0 fsize14 c-92 ">
            			<input type="checkbox" class="select-check" name="check[]" value="<?php echo Field($v['id']);?>">
            		</td>
             		<td><?php echo Field($v['jiaoshiname']);?></td>
             		<td>所在学校</td>
             		<td><?php echo Field($v['address'])?></td>
             		<td>
                	<div class="operate"> 
                    <a href="javascript:void(0);"  onclick="Confirm('是否删除此教室？该操作不可逆!','<?php echo M_URL($this->AppName.'/Index','delJiaoshi',$v['id'],GP('p-'.$page->now_page.',classroomid-'.$classroomid)); ?>')"><em>删除</em><i class="iconfont icon-shanchu1"></i> </a>
                	</div>
                </td>
             	</tr>
             <?php }?>

            </tbody>
        </table>
    </div>  
</div>

</form>
<div id="ksBoxFooter">
	<div class="ks-bom clearfix">
		<span class="fl">
			<button class="fr ks-bt bt-pue" onclick="do_reg()"><i class="iconfont icon-lajitong"></i>批量删除</button>
		</span>
        	<?php echo $page->show(3); ?>
	</div>
</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
function updatesStatus(id){
var url = '<?php echo UOOT;?>Plus/Kesion.ajax.php?act=classroom_teacher';      
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
function do_reg(){    
	$('#myform').submit();
}
</script>
</body>
</html>

