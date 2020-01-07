
<div class="form-title2"><button class="ks-bt bt-pue fr" onClick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','addDocent',$courseid,GP('type-2')) ?>','850px','600px',{type:'top',title:'添加教师'})"><i class="iconfont icon-jiahao"></i>添加教师</button>教师管理</div>


<div class="course-list1 mt20">
	<table class="ks-table">
		<thead>
			<tr>
				<th>头像</th>
				<th>姓名</th>
				<th>性别</th>		
				<th>级别</th>				
				<th>课程</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
		<?php $rolename = [1=>'主讲',2=>'助教',3=>'主持人'];?>
		<?php foreach($teachers as $key=>$v){  ?>
			<tr>
				<td style="text-align: left; width: 120px;">
					<img src="<?php echo $this->upload->getHead($v['userid'],5);?>" width="80px" height="80px">
				</td>
				<td>
					<?php echo Field($v['name']) ?>
				</td>
				<td><?php if($v['Sex'] == 1){ echo "男";}elseif($v['Sex'] == 2){ echo "女";}else{ echo '未设置';} ?></td>
				<td>
					<?php echo $rolename[$v['role']]?>

				</td>
				<td>
					<?php echo Field($v['teachercount']); ?>
				</td>
				<td>
						<a class="ml10" href="<?php echo M_URL('users/Index','editUsers',$v['userid'],GP("usertype-1,appid-11")); ?>" title="编辑">编辑</a>
					
<!--					--><?php //if($v['role']==0){ ?>
						<a  class="ml10" href="<?php echo M_URL($this->AppName.'/Index','teacherSpeak',$v['userid'],GP("courseid-$courseid,role-1")); ?>" title="设为主讲">设为主讲</a>
						<a  class="ml10" href="<?php echo M_URL($this->AppName.'/Index','teacherSpeak',$v['userid'],GP("courseid-$courseid,role-2")); ?>" title="设为助教">设为助教</a>
						<a  class="ml10" href="<?php echo M_URL($this->AppName.'/Index','teacherSpeak',$v['userid'],GP("courseid-$courseid,role-3")); ?>" title="设为主持人">设为主持人</a>
<!--					--><?php //}elseif ($v['role']==0){ ?>
						<a class="ml10" href="javascript:void(0);" title="删除" onclick="Confirm('是否删除此教师？该操作不可逆!','<?php echo M_URL($this->AppName.'/Index','delspeaker',$v['id'],GP('courseid-'.$courseid)); ?>')">删除</a>
				
<!--					--><?php // }?>
				
		
			</td>
		</tr>
	<?php }?>

	
	</tbody>
	</table>
	<?php echo NoC($teachers);?>
	<?php if(count($teachers)!=0){ ?>
	<div class="ks-bo clearfix pt20" style="height: inherit;">
		<div class="fr"><?php echo $page->show(3,9); ?></div>
	</div>
	<?php } ?>
</div>
