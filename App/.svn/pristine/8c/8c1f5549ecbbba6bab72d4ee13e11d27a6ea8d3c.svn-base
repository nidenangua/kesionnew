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
<div class="bRadius10 ks-wbox"> 
	
	<div id="ksBoxHead">
		<!--START HEAD-->
		<div class="generalTitle clearfix">
		    <span class="title-icon"><i class="iconfont icon-myorder"></i></span>
	        <span class="gTitle fsize18">班级课程</span>
		    <div class="fr add-margin">
			    <ul>
			        <li class="fl mr10">
			       		<a class="ks-bt bt-pur" href="<?php echo M_URL($this->AppName.'/Index','addUsers','',GP("appid-$this->appid,usertype-$usertype")); ?>">
			       	 	<i class="iconfont icon-jiahao"></i>+添加班级</a>
			        </li>
	

			        <li class="fl mr10">
			        	  <a href="javascript:void(0);"  class="ks-bt bt-def"  onclick="addTypeChange('<?php echo M_URL('Index','Import','',GP('type-1'));  ?>','600px','250px');" >
			        	  	<i class="iconfont icon-jiahao"></i>批量导入excel</a>
			        </li>

			    </ul>
		    </div>
		</div>
		<div class="clearfix ks-top-tab">
	       <div class="fr ks-top-search">
				<label class="mr0">
			   	<select class="w150 inputText bRadius5" id="keytype">
					<option value="1" <?php if($keytype==1){echo 'selected="selected"';} ?>>班级名称</option>	
			  	</select>
				</label>
				<div class="ks-top-search fr">
					<input type="text" class="sc-text" name="searchText" id="keyword"  value="<?php if(isset($keyword)) echo $keyword; ?>">
	                <input type="submit" class="sc-button" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','index'); ?>','<?php echo URL_MODEL;?>')" name="searchBtn" value="搜索" >
				</div>
			</div>
		</div>
		<!--END HEAD-->
	</div>
	<form target="hidframe"  action="<?php echo M_URL($this->AppName.'/Index','bathdeluser','',GP("usertype-$usertype,p-$page->now_page"));  ?>" method="post" id="myform">
	<div id="ksBoxContent">
            <table width="100%" cellpadding="0" cellspacing="0" border="0" class="ks-table">
	            <thead>
		            <tr>
		            	<th><input type="checkbox" id="selectAll" class="form-in"></th>
		                <th>账号</th>
		                <th>姓名</th>
		                <th>手机号码</th>
		                <th>电子邮箱</th>               
		                <th>操作</th>
		            </tr>
	            </thead>
	            <tbody>
	            <?php foreach($UsersAll as $k=>$v){ ?> 
		            <tr>
		            	<td>
		            		<input type="checkbox" class="select-check form-in" name="userid[]" value="<?php echo $v['userid'] ?>"></td>
		                <td><?php echo Field($v['username']);?></td>
		                <td><?php echo Field($v['name']);?></td>
		                <td><?php echo Field($v['mobile']);?></td>
		                <td><?php echo Field($v['email']);?></td>
		                <td nowrap="nowrap">
		                    <div class="operate">
			                    <a href="<?php echo M_URL($this->AppName.'/Index','editUsers',$v['userid'],GP("usertype-$usertype,p-$page->now_page")); ?>"><em>编辑</em><i class="iconfont icon-bianji4"></i></a>
			                    <a href="javascript:Confirm('是否删除此学员？该操作不可逆!','<?php echo M_URL($this->AppName.'/Index','deluser',$v['userid'],GP("usertype-$usertype")); ?>')"><em>删除</em><i class="iconfont icon-shanchu1"></i></a>
		                    </div>
		                </td>
		            </tr>
	            <?php }?>
	            
	            </tbody>
	        </table>
	        <?php echo NoC($UsersAll);?>
	    </div>
</div>
<div id="ksBoxFooter">
	<div class="ks-bom clearfix">
		<span class="fl">
			<button class="ks-bt bt-pue" type="submit" name="batch" value="1"><i class="iconfont icon-shanchu1"></i>批量删除</button>
		</span>
		<?php echo $page->show(3); ?>
	</div>
</div>
</form>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
function submitform(){
	$('#myform').submit();
}
</script>
</script>
</body>
</html>
