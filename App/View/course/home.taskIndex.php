
<div class="form-title2 clearfix"> 
	<ul class="fr ml10">
		<li>
			<div class="ks-head-el">
				<button class="ks-bt bt-pue" onclick="choiceClick(this)"><i class="iconfont icon-filter-2 fn"></i></button>
		
				<div class="ks-head-content ks-head-content-pr w400">
					<ul class="screen">							
						<li>
							<span>作业类型：</span>
							<div class="clearfix">
								<a href="<?php echo M_URL($this->AppName.'/Index','task','',GP('taskstyle-4,courseid-'.$this->courseid));  ?>" <?php if($taskstyle==4){echo 'class="choice-active"';} ?>>不限</a>
								<a href="<?php echo M_URL($this->AppName.'/Index','task','',GP('taskstyle-2,courseid-'.$this->courseid));  ?>" <?php if($taskstyle==2){echo 'class="choice-active"';} ?>>在线做题</a>
								<a href="<?php echo M_URL($this->AppName.'/Index','task','',GP('taskstyle-1,courseid-'.$this->courseid));  ?>" <?php if($taskstyle==1){echo 'class="choice-active"';} ?>>材料作业</a>
								<a href="<?php echo M_URL($this->AppName.'/Index','task','',GP('taskstyle-3,courseid-'.$this->courseid));  ?>" <?php if($taskstyle==3){echo 'class="choice-active"';} ?>>线下/其他</a>

							</div>
						</li>
			
						<li>
							<span>批改方式：</span>
							<div class="clearfix">
								<a href="<?php echo M_URL($this->AppName.'/Index','task','',GP('checkstyle-3,courseid-'.$this->courseid));  ?>" <?php if($checkstyle==3){echo 'class="choice-active"';} ?>>不限</a>
								<a href="<?php echo M_URL($this->AppName.'/Index','task','',GP('checkstyle-2,courseid-'.$this->courseid));  ?>" <?php if($checkstyle==2){echo 'class="choice-active"';} ?>>手动批改</a>
								<a href="<?php echo M_URL($this->AppName.'/Index','task','',GP('checkstyle-1,courseid-'.$this->courseid));  ?>" <?php if($checkstyle==1){echo 'class="choice-active"';} ?>>自动批改</a>
							
							</div>
						</li>
						<li>
							<span>状态：</span>
							<div class="clearfix">
								<a href="<?php echo M_URL($this->AppName.'/Index','task','',GP('status-3,courseid-'.$this->courseid));  ?>"  <?php if($status==3){echo 'class="choice-active"';} ?>>不限</a>
								<a href="<?php echo M_URL($this->AppName.'/Index','task','',GP('status-1,courseid-'.$this->courseid));  ?>" <?php if($status==1){echo 'class="choice-active"';} ?>>已发布</a>
								<a href="<?php echo M_URL($this->AppName.'/Index','task','',GP('status-0,courseid-'.$this->courseid));  ?>" <?php if($status==0){echo 'class="choice-active"';} ?>>未发布</a>
							
							</div>
						</li>

					</ul>
				</div>
			</div>
		</li>				
	</ul>	
	
	<a href="javascript:void(0)" class="ks-bt bt-pue ml10 fr" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','addTask',$this->courseid,GP('')) ?>','800px','600px',{title:'发布作业',type:'top'})" id="addStudent">
	<i class="iconfont icon-jiahao"></i>发布作业</a>
	
		 
	<form target="hidframe" class="fr">
	    <div class="ks-top-search fr">
			<input type="text" class="sc-text" name="searchkeyword" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>"> 		
			<button type="submit" class="ks-head-search" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','task',$this->courseid); ?>','<?php echo URL_MODEL;?>');"  name="searchBtn"><i class="iconfont icon-sousuo"></i></button>
		</div>
	</form>
	作业管理
</div>

<form target="hidframe" action="<?php echo M_URL($this->AppName.'/Index','bathdelTask','',GP('courseid-'.$this->courseid)); ?>" method="post" id="myform">
	<table width="100%" cellpadding="0" cellspacing="0" border="0" class="gTable borderTable borderSo ks-table" style="border-bottom:0;">
		<tbody>
			<?php foreach($task as $k=>$v){ ?>
			<tr class="class-tr"> 
				<td width="30">
				<input type="checkbox" class="select-check select-po" name="taskid[]" value="<?php echo $v['id']; ?>" >
				</td>
				<td width="30%" class="ta-left">  
				<div class="class-title"><?php echo  $v['title'] ?></div>
				<div class="class-time">添加时间：<?php echo  date('Y-m-d',$v['adddate']); ?></div>
				<div class="class-teacher">添加老师：<?php echo $v['inputer']; ?></div>
				</td>
				<td>
				<div class="class-title"></div>
				<div class="class-type">作业类型:<?php if($v['taskstyle']==1){echo '上传作业材料';}elseif($v['taskstyle']==2){ echo '在线做题';}else{echo '其他/线下';} ?></div>
				<div class="class-style">批改方式：<?php if($v['checkstyle']==1){echo '自动批改';}else{ echo '手动批改';} ?></div>
				
				</td>
				<td>
				<div class="class-title"></div>
				<!--<a href="<?php echo M_URL($this->AppName.'/Index','correctTask',$v['id'],GP('courseid-'.$courseid));?>">进入批改</a>-->
				<div class="class-state" id="c<?php echo $v['id']; ?>">状态:<?php if($v['status']==0){echo '未发布';}else{ echo '发布';} ?></div>
				<div class="class-endtime">截止时间：<?php echo date('Y-m-d',$v['enddate']); ?></div>
				
				</td>
				<td></td>
				<td>
				<div class="operate fr">
				<?php if($v['status']==0){ ?>
				<a href="javascript:void(0)" onclick="Release(<?php echo $v['id']; ?>);" id="b<?php echo $v['id'] ?>">发布</a>		
				<?php }  ?>
				<a href="<?php echo M_URL($this->AppName.'/Index','seeTasks',$v['id'],GP('courseid-'.$this->courseid)); ?>">查看</a>	
				<a href="javascript:void(0)" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','editTask',$v['id'],GP('courseid-'.$v['courseid'])) ?>','800px','600px',{title:'编辑',type:'top'})">编辑 </a>
				<a href="javascript:void(0);" onclick="Confirm('是否删除此作业？该操作不可逆！','<?php echo M_URL($this->AppName.'/Index','delTask',$v['id'],GP('p-'.$page->now_page));?>')"> 删除</a>
				</div>
				</td>
			</tr>
			<?php } ?>
		
		</tbody>
	</table>
	<?php echo NoC($task);?>				
</form>
 <?php if(count($task)!=0){ ?>
 <div class="ks-bom clearfix">
	<label class="mr20 fl"><input type="checkbox" class="select-checks selectAll">全选</label>
	<span class="fl ml10">
		<button type="button" class="ks-heade-button" onclick="$('#myform').submit()" ><i class="iconfont icon-shanchu1"></i></button>
	</span>
	<div class="fr"><?php echo $page->show(3); ?></div>
</div>
<?php } ?>

	 	
<script>
	
function Release(id){
	
	$.ajax({
		type:"post",
		url:'<?php  echo  M_URL($this->AppName.'/Ajax','Release','',GP('')); ?>',
		data:{
			'id':id,
		},
		success:function(data){
		    if(data='success'){
				$('#b'+id).remove();
				$('#c'+id).text('状态:发布');
		    }
		},
		   
	});
}

</script>
