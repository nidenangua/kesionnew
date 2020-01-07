
		<!--header-->
		     <div class="ks-head-box">
		     		<h3 class="ks-head-title">考试系统</h3>
		     </div>
		 <!--/header-->
		 
		 <!--tab-->
		 <div class="ks-head-tab">
 			<ul class="clearfix">
		       <li class="fl <?php   if(ACTION =='Index' || ACTION=='index'){ echo 'curr';} ?>">
      				<a href="<?php echo M_URL($this->AppName.'/Index','Index','',GP('')); ?>" class="alignCenter">试卷管理</a>
   			</li>					
			 <li class="fl <?php if(ACTION =='TkIndex'){ echo 'curr';} ?>">
      				<a href="<?php echo M_URL($this->AppName.'/Index','TkIndex','',GP('')); ?>" class="alignCenter">题库管理</a>
   			</li>
     	</div>
		<!--/tab-->
		 <!--widget-->
					<div class="ks-head-widget clearfix">
						
						<div class="col-8">
								<?php  if(ACTION=='Index' || ACTION=='index'){  ?>
		
							<div class="ks-search-box">
								
								<!--搜索框组件-->
								<select class="w150 inputText bRadius5 fl" id="keytype">
								<option value="1" <?php if($keytype == 1){echo 'selected="selected"';} ?>>考卷名称</option>
									
							  	</select>
								<div class="ks-top-search fl">
									
									<input type="text" class="sc-text" name="searchText" id="keyword"  value="<?php if(isset($keyword)) echo $keyword; ?>">
					                
					                <span class="ks-head-search" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','index'); ?>','<?php echo URL_MODEL;?>')"><i class="iconfont icon-sousuo"></i></span>  
					                
								</div>
	
								<!--搜索框组件-->
		
							</div>	
							
							  <?php }elseif(ACTION=='TkIndex'){ ?>
							<div class="ks-search-box">
								
								<!--搜索框组件-->
								<select class="w150 inputText bRadius5 fl" id="keytype">
								<option value="1" <?php if($keytype == 1){echo 'selected="selected"';} ?>>题目名称</option>
									
							  	</select>
								<div class="ks-top-search fl">
									
									<input type="text" class="sc-text" name="searchText" id="keyword"  value="<?php if(isset($keyword)) echo $keyword; ?>">
					                
					                <span class="ks-head-search" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','TkIndex'); ?>','<?php echo URL_MODEL;?>')"><i class="iconfont icon-sousuo"></i></span>  
					                
								</div>
	
								<!--搜索框组件-->
								<?php }  ?>	
						
											
						</div>
							
						<div class="col-4" style="float:right">
							<div class="fr">
								<ul class="ks-head-choice">
								
									
									<li>
										<?php if(ACTION == 'Index' || ACTION=='index'){ ?>
										<a class="ks-heade-button ks-head-primary" href="<?php echo M_URL($this->AppName.'/Index','paperAdd','',GP('')); ?>"><i class="iconfont icon-jiahao"></i>添加试卷</a>
										<?php }else if(ACTION == 'TkIndex'){ ?>	
										
										<a class="ks-heade-button ks-head-primary"  href="<?php echo M_URL($this->AppName.'/Index','addTk','',GP('')); ?>"><i class="iconfont icon-jiahao"></i>新建题目</a>
										
										<a class="ks-heade-button ks-head-primary" href="javascript:void(0);"   onclick="addTypeChange('<?php echo M_URL('Index','Import','',GP('type-2'));  ?>','600px','250px',{title:'批量导入',type:'top'});" >
											<i class="iconfont icon-bianji"></i>批量导入execl
										</a>
										  
										<?php }else if(ACTION == 'scoreRank'){ ?>	
										<a class="ks-heade-button ks-head-primary" href="<?php echo M_URL($this->AppName.'/Index','addScoreRank','',GP('')); ?>"><i class="iconfont icon-jiahao"></i>添加分数等级</a>
										<?php }else if(ACTION == 'paperType'){ ?>	 
										<a class="ks-heade-button ks-head-primary" href="<?php echo M_URL($this->AppName.'/Index','typeAdd','',GP('')); ?>"><i class="iconfont icon-jiahao"></i> 新增类型 </a>
										<?php } ?>
									</li>
									
								</ul>
							</div>
						</div>
					</div>
					<!--/widget-->
