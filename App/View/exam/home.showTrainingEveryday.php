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
    <!--开始-->
	<?php include  CURR_VIEW_PATH ."examhead.php";?>
	

		<div class="ks-clist">
			<ul class="clearfix">
				<?php foreach($values as $k=>$v){ ?>
					
				<li>
					<div class="ks-check">	<input type="checkbox" class="select-checks " name="paperid[]" value=""></div>
					<div class="ks-ctitle clearfix">
						<h3><?php echo Field($v['name']); ?></h3>	
						<span>已审核</span>	
					</div>
					<div class="ks-cbox clearfix">
						<div class="fl ks-txtLeft">
							<span>专业<i>IT专业</i></span>
							<span>试卷类型<i>章节练习</i></span>
							<span>考试记录<i>35562</i></span>
						</div>
						<div class="ks-operaRight fr">
							<ul class="clearfix">
								
							<li>
							<a>
							<i class="iconfont icon-chakan"></i>
							<p class="class-name">预览</p>
							</a>
							</li>
							
							<li>
							<a>
							<i class="iconfont icon-bianji1"></i>
							<p class="class-name">编辑</p>
							</a>
							</li>
							
							
							<li>
							<a>
							<i class="iconfont icon-lajitong1"></i>
							<p class="class-name">删除</p>
							</a>
							</li>
							
							
							</ul>
						</div>
					</div>
				</li>
				
			<?php } ?>
					 
	        </ul>
		   <?php echo NoC($values);?>
		</div>
		
		<!--<div class="ks-top-tab clearfix">
		<div class="fr ks-top-search">
		<form target="hidframe">
		<div class="ks-top-search fr">
		<input type="text" class="sc-text" name="searchText" id="keyword"  value="<?php if(isset($keyword)) echo $keyword; ?>">
		<input type="submit" class="sc-button fl" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','showTrainingEveryday'); ?>','<?php echo URL_MODEL;?>')" name="searchBtn" value="搜索" >
		</div>
		
		<select class="w150 inputText bRadius5 fl" id="keytype">
		<option value="1">课程名称</option>
		<option value="2">老师</option>
		</select>
		
		
		</form>
		</div>
		</div>
		<form target="hidframe"  method="post" action="<?php echo M_URL($this->AppName.'/Index','bathTrainingEveryday','',GP(''));?>" id="myform">
		<table width="100%" cellpadding="0" cellspacing="0" border="0" class="gTable borderTable borderSo ks-table" style="border-bottom:0;">
		<thead>
		<tr>
		<th><input name="allChecked" type="checkbox" value="allChecked" class="check-all verAlignMiddle" id="selectAll" onclick="DoCheck()"></th>
		<th class="ta-left">课程名称</th>
		<th>教师</th>
		<th>性别</th>
		<th>电话号码</th>
		<th>操作</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach($values as $k=>$v){ ?>
		<tr>
		  <td class="alignCenter hLh40 pt0 pb0 fsize14 c-92 ">
		<input type="checkbox" class="verAlignMiddle mr10" name="courseid[]" value="<?php echo $v['courseid'] ?>">
		   </td> 
		 <td  class="ta-left"><a href="<?php echo M_URL($this->AppName.'/Index','trainingEveryday',$v['courseid'],GP('status-0')) ?>"><?php echo Field($v['title']); ?></a></td>
		 <td><?php echo Field($v['name']); ?></td>
		 <td><?php echo Field($v['sex']); ?></td>
		 <td><?php echo Field($v['tel']); ?></td>
		 <td>
		<div class="operate">
		<a href="<?php echo M_URL($this->AppName.'/Index','showHistory',$v['courseid'],GP('p-'.$page->now_page)); ?>"><em>每日一练</em><i class="iconfont icon-bianji4"></i></a>
		<!--				           <a class="ks-bt bt-pur mr10" href="javascript:void(0)" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','showHistory',$v['courseid'],GP('p-'.$page->now_page));?>','850px','600px');">--***>
		 </div>
		 </td>
		</tr>
		<?php } ?>
		</tbody>
		</table>
		 <?php echo NoC($values);?>
		  
		</div>-->
	</div> 
	
	
	
	<div id="ksBoxFooter" class="ks-bom clearfix">
		<label for="selectAll" class="fl"><input name="" type="checkbox" value="" class="select-checks selectAll">全选</label>
		<div class="fl">
			
			<button class="ks-bt bt-pue" onclick="submitform();">批量生成</button>
		</div>
	 	<div class="fr"><?php echo $page->show(3); ?></div>
	
	</div>
	<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
	<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
	<script>
     function DoCheck() {
        var ch=document.getElementsByName("courseid[]");
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
    
function submitform(){
 $('#myform').submit();
}
</script>
</body>

</html>
