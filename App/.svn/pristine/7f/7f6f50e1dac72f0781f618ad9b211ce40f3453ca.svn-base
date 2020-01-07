
<div class="form-title2 clearfix"> 
	<ul class="fr ml10">
				
		<li>
			<div class="ks-head-el">
				<button class="ks-bt bt-pue" onclick="choiceClick(this)"><i class="iconfont icon-filter-2 fn"></i></button>
				<div class="ks-head-content ks-head-content-pr w400">
					<ul class="screen">	
					
						<li>
							<span>批改方式：</span>
							<div class="clearfix">
								<a href="<?php echo M_URL($this->AppName.'/Index','correctTask','',GP('checkstyles-3,courseid-'.$this->courseid));  ?>" <?php if($checkstyle==3){echo 'class="choice-active"';} ?>>不限</a>
								<a href="<?php echo M_URL($this->AppName.'/Index','correctTask','',GP('checkstyles-2,courseid-'.$this->courseid));  ?>" <?php if($checkstyle==2){echo 'class="choice-active"';} ?>>教师批改</a>
								<a href="<?php echo M_URL($this->AppName.'/Index','correctTask','',GP('checkstyles-1,courseid-'.$this->courseid));  ?>" <?php if($checkstyle==1){echo 'class="choice-active"';} ?>>自动批改</a>
	
							</div>
						</li>
	
						<li> 
							<span>作业类型：</span>
							<div class="clearfix">
								<a href="<?php echo M_URL($this->AppName.'/Index','correctTask','',GP('taskstyles-3,courseid-'.$this->courseid));  ?>" <?php if($taskstyle==3){echo 'class="choice-active"';} ?>>不限</a>
								<a href="<?php echo M_URL($this->AppName.'/Index','correctTask','',GP('taskstyles-1,courseid-'.$this->courseid));  ?>" <?php if($taskstyle==1){echo 'class="choice-active"';} ?>>在线做题</a>
								<a href="<?php echo M_URL($this->AppName.'/Index','correctTask','',GP('taskstyles-2,courseid-'.$this->courseid));  ?>" <?php if($taskstyle==2){echo 'class="choice-active"';} ?>>材料作业</a>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</li>				
	</ul>
	
	<form target="hidframe" class="fr">
    	<div class="ks-top-search">
			<input type="text" class="sc-text" name="searchkeyword" id="keyword" value="<?php if(isset($keyword)) echo $keyword;?>">	
			<button type="submit" class="ks-head-search" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','correctTask',$courseid); ?>','<?php echo URL_MODEL;?>');"  name="searchBtn"><i class="iconfont icon-sousuo"></i></button>
		</div>
	</form>
	
	作业批改
</div>

<form target="hidframe"  action="<?php echo M_URL($this->AppName.'/Index','bathdelTask',$this->courseid,GP('')) ?>" method="post" id="myform">
	<table width="100%" cellpadding="0" cellspacing="0" border="0" class="gTable borderTable borderSo ks-table" style="border-bottom:0;">
    	
	    <tbody>
       
      	 	<?php  if(isset($task))foreach($task as $k=>$v){ ?>
            <tr class="class-work">
                <td>
                      <input type="checkbox" class="select-check" name="taskid[]" value="<?php echo $v['id']; ?>" >
                </td>
                <td width="20%" class="ta-left ">
                	<h2><?php echo $v['title']; ?></h2>
                	<p>添加时间：<?php echo  date('Y-m-d',$v['adddate']); ?></p>	
                	<p>添加老师：<?php echo $v['inputer']; ?></p>
                </td>
                   <td style="text-align: left;">
                   	<h2></h2>
                   	<p><span class="ml10">提交作业人数：<?php echo $v['count']; ?></span></p>	
                	
                	<p>已批阅人数：<span class=""><?php echo $v['currectCount']; ?></span></p>
                <td>
                	<h2></h2>	
                	<p>作业类型：<?php if($v['taskstyle']==1){echo '上传作业材料';}elseif($v['taskstyle']==2){ echo '在线做题';}else{echo '其他/线下';} ?></p>
                	<p>批改方式：<?php if($v['checkstyle']==1){echo '自动批改';}else{ echo '手动批改';} ?></p>
                </td>
                <td>
                	<h2></h2>
                	<p>状态：<span class="class-state c-86A8F">批改中<span class="c-86A8F">(<?php echo $v['currectCount']; ?>/<?php echo $v['count']; ?>)</span></span></p>
                	<p>截止时间：<?php echo date('Y-m-d',$v['enddate']); ?></p>
                </td>
              
             
             <!-- seeTask-->
                <td>
                	<a href="<?php echo M_URL($this->AppName.'/Index','memberTask',$v['id'],GP('courseid-'.$this->courseid)); ?>">查看</a>	
                </td>
            </tr>
         <?php } ?>   
             
  
        </tbody>
	</table>
	<?php echo NoC($task);?>		

	<?php if(count($task)!=0){ ?>
	<div class="ks-bom clearfix">
		<label class="fl"><input type="checkbox" id="selectAll">全选</label>
		
		<div class="fr"><?php echo $page->show(3); ?></div>
	</div>
	<?php } ?>			
    </div>
                       
</form>
