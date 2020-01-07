<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>kesion教育平台</title>
<meta name="Keywords" content="kesion教育平台"/>
<meta name="Description" content="kesion教育平台" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />

<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>

</head>

<body class="ks-wrap">
	<!--开始-->

    
	
	<div id="ksBoxHead">

		<div class="Header-tool  clearfix">
			<div class="Tool-Title">

				<!--标题-->
				<p>	<a href="javascript:history.go(-1);"><i class="iconfont icon-jiantou-copy"></i>考试管理</a><span>/ 考试记录</span></p>
				<!--标题-->
			</div>
			
		
			<!--结束-->
			
				
	<div class="clearfix ks-top-tab">
		<div class="fr drag-out-scored">
	    	<!--按钮块--->
			  <a class="ks-bt bt-def" href="<?php echo M_URL($this->AppName.'/Index','scoreexcel',$paperid,GP('')); ?>">导出成绩</a>
			<!--按钮块--->
	    </div>
		<div class="fr ks-top-search">
			<!--搜索-->
	
		<!--<label class="mr20">
			<span class="c-92 mr10 fsize14">分类</span>
			<select class="w150 inputText bRadius5"  onchange="getval(this,"<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','index'); ?>','categoryid','<?php echo URL_MODEL;?>')">
			<?php if(isset($userscategory)){ 
			  echo "<option value='0'>请选择</option>";
			  foreach($userscategory as $k=>$v){
				   $html="<option value='$v[categoryid]' ";
			   if($v['categoryid']==$categoryid){$html=$html."selected = 'selected'";}
			   $html=$html.">
			   ".KS_INDENT($v['depth'])."$v[categoryname]</option>" ;
				   echo $html;
				}
			  }else{echo "<option value='0'>请选择</option>";}
			?>    
			</select>
		</label>-->

		<label class="mr0">
		   	<select class="w150 inputText bRadius5" id="keytype">
		 		<option value="1" <?php if($keytype==1){echo 'selected="selected"';} ?>>学生</option>
		   	</select>
		</label>
		<form target="hidframe"  class="fr mr10">
			<div class="fr ks-top-search">
				<input type="text" class="sc-text" name="searchText" id="keyword"  value="<?php if(isset($keyword)) echo $keyword; ?>">
				<input type="button" class="sc-button" name="searchBtn" value="搜索"  onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','PaperSit',$paperid); ?>','<?php echo URL_MODEL;?>')">
			</div>
		</form>
			<!--搜索-->
		</div>
	</div>	
	

		</div>
	
	</div>	

	 
 
			        
		
	
	
	<!--结束-->
		
		
		
<form target="hidframe"  action="<?php echo M_URL($this->AppName.'/Index','batchRecord',$paperid,GP("p-$page->now_page"));  ?>" method="post" id="myform">
	<div >	

<div class=" contentBox "  id="ksBoxContent">
<div class="H5-gameListScreen">
			<ul class="H5-gameOpt clearfix">
				<li><input type="checkbox" class="selectAll select-checks" style="position: relative;top: 4px;">全选</li>
				<!--<li>转换率<i class="iconfont icon-sort-double-down"></i></li>-->
				
				<li> </li>	
				<li class="fr gameScreen" style="float: right;"><i class="iconfont icon-filter-2 fn"></i>&nbsp;&nbsp;筛选

					<ul class="H5-gameScreen">
						<img src="//ks.kesion.com/Public/app/images/regup.png" alt="">
						<li>
							<span>批改状态：</span>
							<div>
								<a href="//ks.kesion.com/home.html/course/Index/index?appid-6,status-3">批改</a>
								<a href="//ks.kesion.com/home.html/course/Index/index?appid-6,status-1">已批改</a>
							
							</div>
						</li>	
						
					

							


					</ul>

				</li>	
			
						
			</ul>	
		</div>
    <div class="ks-clist">
    	<ul class="clearfix">
    		
    			<li>
		        		<div class="ks-input"><input type="checkbox" class="select-checks form-in" name="userid[]" value="394"></div>	
		        			  <div class="ks-cimg fl clearfix">
	  							 <img src="//ks.kesion.com/Images/users/379/a02ffd91ece5e7efeb46db8f10a74059.jpg">
							  </div>
		        			  <div class="ks-txtLbox">	
		        				<div class="fl ks-txtLeft">
			        				<p>晨曦 <i  class="icon-nv iconfont"></i></p>
			        				<p>提交时间：2018-01-31</p>
			        				<p>添加老师:刘娜老师</p>
			        				
		        				</div>
		        				<div class="ks-ctxt fl">
		        					<p style="height: 24.5px;"></p>
									<p>试卷类型：在线做题</p>
		        					<p>批改方式: 教师批改</p>
		        					
		        				</div>
		        				<div class="ks-ctxt fl">
		        					<p style="height: 24.5px;"></p>
									<p>成绩：<i class="c-86A8F">95</i></p>
		        					<p>截止时间:2018-01-31 </p>
		        					
		        				</div>
		        				
		        			</div>
		        			
		        				<div class="ks-align fr">
		        					<a>查看</a>
	        					
		        				</div>
		        			
		        		
		       		   </li>
		       		   
		       	   <li>
		        		<div class="ks-input"><input type="checkbox" class="select-checks form-in" name="userid[]" value="394"></div>	
		        			  <div class="ks-cimg fl clearfix">
	  							 <img src="//ks.kesion.com/Images/users/379/a02ffd91ece5e7efeb46db8f10a74059.jpg">
							  </div>
		        			  <div class="ks-txtLbox">	
		        				<div class="fl ks-txtLeft">
			        				<p>晨曦 <i  class="icon-nv iconfont"></i></p>
			        				<p>提交时间：2018-01-31</p>
			        				<p>添加老师：刘娜老师</p>
			        				
		        				</div>
		        				<div class="ks-ctxt fl">
		        					<p style="height: 24.5px;"></p>
									<p>试卷类型：在线做题</p>
		        					<p>批改方式：教师批改</p>
		        					
		        				</div>
		        				<div class="ks-ctxt fl">
		        					<p style="height: 24.5px;"></p>
									<p>成绩：<i class="c-86A8F">100</i></p>
		        					<p>截止时间：2018-01-31 </p>
		        					
		        				</div>
		        				
		        			</div>
		        			
		        				<div class="ks-align fr">
		        					<a>查看</a>
	        					
		        				</div>
		        			
		        		
		       		   </li>	   
		       		   
                
    <!--<table width="100%" cellpadding="0" cellspacing="0" border="0"
           class="gTable borderTable borderSo ks-table">

        <thead>
        <tr >
            <th class="alignCenter hLh40 pt0 pb0 fsize14"> <input type="checkbox" class=" verAlignMiddle mr10 checkall check-all"></th>
            <th class="alignCenter hLh40 pt0 pb0 fsize14"> ID</th>
            <th class="alignCenter hLh40 pt0 p b0 fsize14">考卷名称</th>
            <th class="alignCenter hLh40 pt0 pb0 fsize14">学生</th>
            <th class="alignCenter hLh40 pt0 pb0 fsize14 ">分数</th>
            <th class="alignCenter hLh40 pt0 pb0 fsize14 ">是否已批改</th>
        </tr>
        </thead>
        <tbody>-->
      <!-- <?php foreach($record as $k=>$v){ ?>-->
       
        <!--<tr>
            <td class="alignCenter hLh40 pt0 pb0 fsize14 c-92 ">
            	<input type="checkbox" class=" verAlignMiddle mr10 " name="recoredid[]" value="<?php echo $v['id']; ?>">
            </td>
            <td class="alignCenter hLh40 pt0 pb0 fsize14 c-92 "><label class="control-label"><?php echo $k+1 ?></label></td>
            <td class="alignCenter hLh40 pt0 pb0 fsize14 c-92"><?php echo $v['Title'] ?></td>
            <td class="alignCenter hLh40 pt0 pb0 fsize14 c-92"><?php echo $v['memberName'] ?></td>
            <td class="alignCenter hLh40 pt0 pb0 fsize14 c-92"><?php echo $v['score'] ?></td>
            <?php if($v['iscorrect'] == 1){ ?>
             <td class="alignCenter hLh40 pt0 pb0 fsize14 c-92">
             <a href="<?php echo M_URL($this->AppName.'/Index','Correcting',$v['id'],GP('paperid-'.$paperid.',p-'.$page->now_page)); ?>">已批改</a>
             </td>
            <?php }else{ ?>
             <td class="alignCenter hLh40 pt0 pb0 fsize14 c-92">
             <a href="<?php echo M_URL($this->AppName.'/Index','Correcting',$v['id'],GP('paperid-'.$paperid.',p-'.$page->now_page)); ?>">未批改</a>
             </td>
            <?php } ?> 
        </tr>-->
  <!--    <?php } ?>-->
        <!--</tbody>
        
    </table>-->
    		</ul>
   
  		 </div> 
    </div>
    

</div>
<div id="ksBoxFooter" >
	<div class="ks-bom clearfix" >
		<span class="fl">
			<label class="mr20 fl"><input type="checkbox" class="selectAll select-checks">全选</label>
			<button class="ks-bt bt-pue mr10" type="submit" name="batch" value="1">批量删除</button>
	
		</span>
		<div class="fr"><?php echo $page->show(3); ?></div>
	</div>
</div>
</form>

<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>

</body>

</html>
