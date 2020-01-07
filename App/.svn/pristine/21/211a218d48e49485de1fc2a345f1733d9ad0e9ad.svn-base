
<div class="form-title2 clearfix">
	<div class="fr ml10">
		<a class="ks-bt bt-pue" href="javascript:void(0);"   onclick="addTypeChange('<?php echo M_URL('Index','Import','',GP('type-2,courseid-'.$courseid));  ?>','600px','300px',{title:'批量导入',type:'top'});"  >
		 <i class="iconfont icon-jiahao"></i>
		批量导入execl
		</a>
	 	<a class="ks-bt bt-pue ml10" href="<?php echo M_URL('exam/Index','addTk','',GP("courseid-$courseid,appid-10,bappid-$this->appid"));  ?>"   >
		 <i class="iconfont icon-jiahao"></i>添加题目
		</a>			    
	</div>
	<div class="fr">
		<ul>
			<li class="fr gameScreen ml10" style="float: right;position: relative;">
				<button class="ks-bt bt-pue" onclick="choiceClick(this)"><i class="iconfont icon-filter-2 fn"></i></button>
				<ul class="H5-gameScreen ks-head-content ks-head-content-pr" style="top: 60px;width: 360px;margin-left: -310px;">
					<li>
						<span>题目类型：</span>
						<div>
							<a href="<?php  echo M_URL($this->AppName.'/Index','Tkindex',$courseid,GP('tktype-7')) ?>" <?php if($tktype==7){echo 'class="choice-active"';} ?> >不限</a>
							<a href="<?php  echo M_URL($this->AppName.'/Index','Tkindex',$courseid,GP('tktype-1')) ?>" <?php if($tktype==1){echo 'class="choice-active"';} ?>>选择题</a>
							<a href="<?php  echo M_URL($this->AppName.'/Index','Tkindex',$courseid,GP('tktype-2')) ?>" <?php if($tktype==2){echo 'class="choice-active"';} ?>>填空题</a>
							<a href="<?php  echo M_URL($this->AppName.'/Index','Tkindex',$courseid,GP('tktype-3')) ?>" <?php if($tktype==3){echo 'class="choice-active"';} ?>>判断题</a>
							<a href="<?php  echo M_URL($this->AppName.'/Index','Tkindex',$courseid,GP('tktype-4')) ?>" <?php if($tktype==4){echo 'class="choice-active"';} ?>>问答题</a>
							<a href="<?php  echo M_URL($this->AppName.'/Index','Tkindex',$courseid,GP('tktype-5')) ?>" <?php if($tktype==5){echo 'class="choice-active"';} ?>>材料题</a>
							<a href="<?php  echo M_URL($this->AppName.'/Index','Tkindex',$courseid,GP('tktype-6')) ?>" <?php if($tktype==6){echo 'class="choice-active"';} ?>>多选题</a>
						</div>
					</li>	
				</ul>
			</li>	
		</ul>
	</div>
	
	<div class="fr">
		<form target="hidframe">
			<div class="ks-top-search fr">
				<input type="text" class="sc-text" name="searchText" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>"> 		
				<button type="submit" class="ks-head-search"onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','Tkindex',$this->courseid); ?>','<?php echo URL_MODEL;?>');"/><i class="iconfont icon-sousuo"></i></button>
			</div>
		</form>
	</div>
	
	<!--搜索-->
	题库管理

</div>

<form target="hidframe"  action="<?php  echo M_URL($this->AppName.'/Index','batchpaper',$courseid,GP('p-'.$page->now_page)) ?>" method="post" id="myform">
		<table width="100%" cellpadding="0" cellspacing="0" border="0" class="ks-table mt20">
			<thead>
				<tr>
					<th width="30">
						选择
					</th>
					<th> 题目类型</th>

					<th width="20%">标题</th>
					<th width="20%">参考答案</th>
					<th>录入人员</th>
					<th>操作</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach($tk as $k=>$v){
		   if($v['tktype'] == 1){
			  $tktype = '选择题';
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
			}elseif($v['tktype'] == 6){
				$tktype = '多选题';
				$option=explode("$$$",$v['options']);
				$v['options']=$option[0];
			}
		 ?>
		<tr>
			<td><input type="checkbox" class="select-check form-con" name="tkid[]" value="<?php echo $v['tkid'] ?>"></td>
			<td><?php echo Field($tktype) ?></td>
			<td class="w300"><?php echo Field(trim($v['options']))?></td>
			<td  class="hLh30"><?php echo Field($v['anser']) ?></td>
			<td><?php echo Field($v['inputer']) ?></td>
			<td>
			  <a href="<?php echo M_URL('exam/Index','editTk',$v['tkid'],GP("courseid-$courseid,appid-10,bappid-$this->appid"));  ?>"  >
				<i class="icon-bianji4 iconfont mr10"></i></a>
			  <a href="javascript:void(0);" onclick="Confirm('是否删除此试题？该操作不可逆!','<?php echo M_URL($this->AppName.'/Index','delTk',$v['tkid'],GP('p-'.$page->now_page)); ?>')">
				<i class="icon-shanchu1 iconfont"></i> </a>
			</td>
		</tr>
		<?php } ?>
		</tbody>
	 	<input type="hidden" name="batch" id="batch1" />

	</table>
	<?php echo NoC($tk);?>
	<input type="hidden" name="batch" id="batch1" />

</form>
<?php if(count($tk)!=0){ ?>
 <div class="ks-bom clearfix" style="width: 100%;">
 	<div>
 		<label class="fl"><input type="checkbox" class="selectAll" style="position: relative;top: 4px;">全选</label>
 		<span class="fl ml10">
			<button type="button" class="ks-heade-button" onclick="$('#batch1').val(1);$('#myform').submit();" ><i class="iconfont icon-shanchu1"></i></button>
		</span>
		<div class="fr"><?php echo $page->show(3); ?></div>
 	</div>
		
</div>
<?php } ?>		
