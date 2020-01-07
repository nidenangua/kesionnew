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
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
</head>
<body class="ks-wrap">
	<!--开始-->
	<div class="bRadius10  ">
	<div id="ksBoxHead">	
	<div class="Header-tool clearfix">
			<div class="Tool-Title">
			<!--图像-->
			<span class="Tool-icon">
				<i class="iconfont icon-jiaoshiguanli"></i>
			</span>
			<!--图像-->
			<!--标题-->
			<p>问题解答管理</p>
			<!--标题-->
			</div>
			<!--操作范围-->
			<!--按钮组件-->
			<div class="Tool-btnGroup">
				<a class="ks-bt bt-pur mr10" href="<?php echo M_URL('Offweb','questionClassifyIndex'); ?>">分类管理</button></a>
			</div>
			<div class="Tool-btnGroup">
				<a class="ks-bt bt-pur mr10" href="<?php echo M_URL('Offweb','questionManage'); ?>"><i class="iconfont icon-jiahao"></i>添加问题</button></a>
			</div>
			
			<!--按钮组件-->
			<!--搜索框组件-->
		 <div class="clearfix ks-top-tab" >
		    		<!--
					<div class="fl">
						<select class="w150 inputText bRadius5" onchange="location.href=this.value">
							<option value="<?php echo M_URL($this->AppName.'/Index','index','',GP("status-3,appid-$this->appid",true)); ?>"<?php if($status==3) echo " selected" ;?>>所有用户</option>
							<option value="<?php echo M_URL($this->AppName.'/Index','index','',GP("status-1,appid-$this->appid",true)); ?>"<?php if($status==1) echo " selected" ;?>>正常</option>
							<option value="<?php echo M_URL($this->AppName.'/Index','index','',GP("status-0,appid-$this->appid",true)); ?>"<?php if($status==0) echo " selected" ;?>>待审</option>
						</select>
						<!--栏目块
				    </div>
				 -->   
			<div class="fr ks-top-search">
				<!--搜索--> 
			<label class="mr0">
			   	<!--<select class="w150 inputText bRadius5" id="keytype">
			 		<option value="1" <?php if($keytype==1){echo 'selected="selected"';} ?>>用户账号</option>
			 		<option value="2" <?php if($keytype==2){echo 'selected="selected"';} ?>>教师名称</option>
			   	</select>-->
			</label>
			<!--<form target="hidframe"  class="fr">
				<div class="fr ks-top-search">
					<input type="text" class="sc-text" name="searchText" id="keyword"  value="<?php if(isset($keyword)) echo $keyword; ?>">
					<input type="submit" class="sc-button" name="searchBtn" value="搜索"  onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','index'); ?>','<?php echo URL_MODEL;?>')">
				</div>
			</form>-->
				<!--搜索-->
			</div>
		</div>	
		  </div>
		
    </div>
<form target="hidframe"  action="<?php echo M_URL('Offweb','deleteQuestion','',GP('p-'.$now_page));  ?>" method="post" id="myform">

    <div id="ksBoxContent">
    		<div class="H5-gameListScreen">
		</div>
            	<div class="ks-clist">
            		<ul class="clearfix">
              <?php foreach($values as $k=>$v){ ?> 
<li>
    <div class="ks-input"><input type="checkbox" class="select-checks form-in" name="id[]" value="<?php echo Field($v['id']); ?>"></div>	
	<div class="ks-cbox clearfix">
		<div class="ks-cimg fl clearfix">
	</div>
		<div class="fl ks-txtLeft">
			<p>问题：<?php echo Field($v['title']); ?></p>
			<!--<p>答案：<?php echo Field($v['answer']); ?></p>-->
			<p>添加日期：<?php echo date("Y-m-d",$v['adddate']); ?></p>
			<p>问题分类：<?php echo $v['categoryname']; ?></p>
		</div>
		<div class="ks-operaRight fr">
			<div class="ks-state" style="cursor: pointer;"></div>
			<ul class="clearfix">
				<li >
					<a href="<?php echo M_URL('Offweb','questionManage',$v['id'],GP('p-'.$now_page));?>">
						<i class="iconfont icon-bianji1"></i>
						<p class="class-name">编辑</p>
					</a>
				</li>
				<li>
					<a href="javascript:void(0);"  onclick="Confirm('是否删除此教师？该操作不可逆!','<?php echo M_URL('Offweb','deleteQuestion',$v['id'],GP('p-'.$now_page)); ?>')">
						<i class="iconfont icon-lajitong1"></i>
						<p class="class-name">删除</p>
					</a>
				</li>
			</ul>
		</div>
	</div>
</li>
            
            	   <?php }?>
      <!--      </tbody>
        </table>-->
        
        		</ul>
        	<?php echo NoC($values);?>	
        </div>	
    </div>
</div>

<div id="ksBoxFooter">
<div class="ks-bom clearfix">
	<div class="fl">
		<label class="mr20 fl" style="margin-left: 8px;"><input type="checkbox"  class="select-checks selectAll" >全选</label>
		<button class="ks-bt bt-pue mr10" type="submit" name="batch" value="1">批量删除</button>
	</div>
	<div class="fr">
		<?php echo $page->show(3); ?>	
	</div>
	
</div>
</div>
</form>
<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
	module.require(['$','backstage']);
</script>
</body>
</html>
