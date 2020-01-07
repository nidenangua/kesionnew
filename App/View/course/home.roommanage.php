
	<div class="form-title2 clearfix"> 
		<div class="fr">
			<select class="w150 inputText bRadius5" onchange="location.href=this.value">
				<option value="<?php echo M_URL($this->AppName.'/Index','room',$courseid,GP("status-4,appid-$this->appid",true)); ?>"<?php if($status==4) echo " selected" ;?>>全部直播</option>
				<option value="<?php echo M_URL($this->AppName.'/Index','room',$courseid,GP("status-1,appid-$this->appid",true)); ?>"<?php if($status==1) echo " selected" ;?>>还未开始</option>
				<option value="<?php echo M_URL($this->AppName.'/Index','room',$courseid,GP("status-2,appid-$this->appid",true)); ?>"<?php if($status==2) echo " selected" ;?>>正在直播</option>
				<option value="<?php echo M_URL($this->AppName.'/Index','room',$courseid,GP("status-3,appid-$this->appid",true)); ?>"<?php if($status==3) echo " selected" ;?>>直播结束</option>
			</select>
		</div>  
		房间管理
	</div>
	
	<form target="hidframe"  action="<?php echo M_URL($this->AppName.'/Index','delStudent',$courseid,GP('')) ?>" method="post">
	   <table width="100%" cellpadding="0" cellspacing="0" border="0" class="ks-table mt20" >
		 <thead>
		   <tr>
		   	<!--<th width="10%"><input name="" type="checkbox" value="" class="verAlignMiddle checkall check-all" id="selectAll"></th>-->
			 <th >序号</th>
			 <th>章节名</th>
			 <th>主讲老师</th>
			 <th>直播房间名</th>
			 
			 <th>密码</th>
			 <th>状态</th>
		   </tr>
		</thead>
		<tbody>
          <?php if(isset($live)){foreach($live as $k=>$v){ ?>
		   <tr onclick="skip('<?php echo M_URL($this->AppName.'/Index','studentlive',$v['id'],GP('courseid-'.$courseid)); ?>')">
			 <td >
                <?php echo Field($k+1) ?></td>
			 <td >
			    <?php echo Field($v['title']) ?>
			 </td>	
			 <td>
				<?php echo  Field($v['name']) ?>
			</td>						
			<td>
				<?php echo  Field($v['channlName']) ?>
			</td>
			
			<td>
				<?php echo  Field($v['password']) ?>
			</td>
			<td>
				<?php if($v['status'] == 1){echo '还未开始';}elseif($v['status'] == 2){echo '正在直播';}elseif($v['status'] == 3){echo '已结束';} ?>
			</td>
		   </tr>
           <?php }}?>
      
         </tbody>  
		</table>
		 <?php echo NoC($live);?>
         
        <?php if(!empty($live)){ ?>
       	<div class="ks-bom clearfix">		
			<div class="fr"><?php echo $page->show(3); ?><div>
	   	</div>
		 <?php }?>
  	</form>
