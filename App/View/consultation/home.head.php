
<div id="ksBoxHead" >
		<!--结束-->
		<div class="Header-tool clearfix"> 
			<div class="Tool-Title">
			
			<!--图像-->
			<span class="Tool-icon">
				<i class="iconfont icon-kechengxitong"></i>
			</span>
			<!--图像-->
			
			
			<!--标题-->
			<p>意向通</p>
			<!--标题-->
			
			</div>
			<!--操作范围-->
			
			<!--按钮组件-->
			<div class="fl ks-view-tab mt10" style="overflow: inherit;">
				<ul>  
					<li <?php if(ACTION=='index'){echo 'class="curr"';}?>><a href="<?php echo M_URL($this->AppName.'/Index','index','',GP(''));  ?>">我的意向本</a></li>
					<li <?php if(ACTION=='manageindex'){echo 'class="curr"';}?>><a href="<?php echo M_URL($this->AppName.'/Index','manageindex','',GP('')); ?>">意向记录</a> </li>
					<li <?php if(ACTION=='consultingPool'){echo 'class="curr"';}?>><a href="<?php echo M_URL($this->AppName.'/Index','consultingPool','',GP('')); ?>">意向池</a> </li>
					<li <?php if(ACTION=='invalidpool'){echo 'class="curr"';}?>><a href="<?php echo M_URL($this->AppName.'/Index','invalidpool','',GP('')); ?>">无效池</a> </li>
		<!--			<li ><a href="<?php echo M_URL($this->AppName.'/Index','index','',GP('htmltype-2'));  ?>">我的咨询本</a> </li>-->
					<li <?php if(ACTION=='listenmanagement'){echo 'class="curr"';}?>><a href="<?php echo M_URL($this->AppName.'/Index','listenmanagement','',GP(''));  ?>">试听管理</a></li>
					<li <?php if(ACTION=='showchannel'){echo 'class="curr"';}?>><a href="<?php echo M_URL($this->AppName.'/Index','showchannel','',GP(''));  ?>">渠道管理</a></li>
					
				</ul>
				
			</div>
			<?php 
				if(ACTION=='showchannel'){?>
		
					<div class="Tool-btnGroup">
						<a class="ks-bt bt-pur mr10" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','showchanneladd','',GP('')) ?>','500px','300px',{title:'新增渠道',type:'top'})" class="alignCenter">
							<i class="iconfont icon-jiahao"></i>新增渠道 </a>
					</div>
				<?php }else{?>
					<?php if(ACTION=='manageindex'){?>
						<div class="Tool-btnGroup">
						<a class="ks-bt bt-pur mr10" href="<?php echo M_URL($this->AppName.'/Index','outExcel','',GP('')) ?>" class="alignCenter">
							导出 </a>
					</div>
					<?php }?>	
					<div class="Tool-btnGroup">
						<a class="ks-bt bt-pur mr10" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','Import','',GP('')) ?>','477px','300px',{title:'批量导入',type:'top'})" class="alignCenter">
							批量导入 </a>
					</div>
					<div class="Tool-btnGroup">
						<a class="ks-bt bt-pur " href="<?php echo M_URL($this->AppName.'/Index','addrecord','',GP(''))?>" class="alignCenter">
							<i class="iconfont icon-jiahao"></i>新增意向 </a>
					</div>
				<?php }?>
				
			
			<!--按钮组件-->
			
			<!--搜索框组件-->
			<div class="clearfix ks-top-tab fr">
		  <?php	if(ACTION=='manageindex'||ACTION=='consultingPool'||ACTION=='invalidpool'||ACTION=='listenmanagement'){?>
			<div class="fl ks-top-search">
			<!--搜索-->
			
					
			<!--<select class="w150 inputText bRadius5 fl" id="keytype">
			     <option value="1">课程名称</option>
	  	  </select>-->
	  	  
	  	  <select class=" inputText bRadius5 mr10 fl" style="width: 100px;" id="keytype">
			     <option value="1">学员姓名</option>
	  	    </select>     
			<form target="hidframe"  class="fr">
				<input type="text" class="sc-text" name="searchText" id="keyword"  value="<?php if(isset($keyword)) echo $keyword; ?>">
            <input type="submit" class="sc-button" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index',ACTION); ?>','<?php echo URL_MODEL;?>')" name="searchBtn" value="搜索" >
			</form>
						
			<!--搜索-->
			</div>
			<?php }?>
			</div>
			
			<!--搜索框组件-->
			
			<!--操作范围-->
		
		</div>
	</div>