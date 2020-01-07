<div class="form-title2">
	<button class="ks-bt bt-pue fr" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','addCourseStudent',$courseid,GP('')) ?>','850px','600px',{title:'选择学员报课',type:'top'})" id="addStudent"><i class="iconfont icon-jiahao"></i>添加学员</button>
	
	<!--搜索-->
	<form target="hidframe" class="fr mr10">
		<div class="ks-top-search">
			<select class="w150 inputText bRadius5 selectd fl" name="courseIntor" id="keytype">
				<option value="1">学员名称</option>
			</select>
			<input type="text" class="sc-text" name="searchkeyword" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>"> 		
			<button type="submit" name="searchBtn" class="ks-head-search" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','student',$courseid); ?>','<?php echo URL_MODEL;?>');"><i class="iconfont icon-sousuo"></i></button>
		</div>
	</form>
	
	<!--搜索-->
	
	学员管理

</div>


<form target="hidframe"  action="<?php echo M_URL($this->AppName.'/Index','delStudent',$courseid,GP('')) ?>" method="post" id="myform">
	 
	<table width="100%" cellpadding="0" cellspacing="0" border="0" class="ks-table mt20">
		<thead>
			<tr>
				<th width="30">选择</th>
				<th>学生头像</th>
				<th>学员姓名</th>
				<th>用户名</th>
				<th >学习进度</th>
				<?php if ($this->courseType==2&&$this->livetype==1) {?>
					<th >上课学生</th>
				<?php }?>

				<th >操作</th>
			</tr>
		</thead>
		
		  
		<?php foreach($student as $k=>$v){  ?>
		<tr>
			<td>
             <?php if ($v['paytype']==0||$this->courseType==1) {?>
             <input type="checkbox" class="select-checks" name="aid[]" value="<?php echo $v['userid']  ?>" >
			 <?php }?>
            </td>
			<td><img src="<?php echo Img($this->upload->getHead($v['userid']));?>" style="width: 80px;height:80px;" /></td>
			<td><?php echo Field($v['name'])?></td>
			<td><?php echo Field($v['username'])?></td>
			<td>
				<div class="w180 clearfix mlr">
					<div class="fl w120 posRe learnPrg">
						<div class="posAb bg-green inLearnPrg" ></div>
					</div>
					<span class="fl c-92 ml10"><?php
                        if ($v['is_finish']==1){
                            echo '100%';
                        }elseif ($v['total_time']!=0){
                            $info= $v['finish_time']/$v['total_time']*100;
                            if ($info>=100){
                                echo '100%';
                            }else{
                                echo sprintf("%01.2f", $info).'%';
                            }
                        }else{
                            echo '0.00%';
                        }

                        ?></span>
				</div>
			</td>
			<?php if ($this->courseType==2&&$this->livetype==1) {?>
				<td><?php echo $v['status']==1?'否':'<span style="color: red">是</span>'?></td>
			<?php }?>
			<td >
				<?php if ($this->courseType==2&&$this->livetype==1) {?>
					<a  class="ml10" href="<?php echo M_URL($this->AppName.'/Index','shangkeStudent',$v['userid'],GP("courseid-$courseid")); ?>" title="设为上课学生">设为上课学生</a>
				<?php }?>
                <?php if ($v['paytype']==0){?>
				<a href="javascript:void(0);" class="c-92 pr10 pl10 r-icon posRe"  onclick="Confirm('是否删除此学员？该操作不可逆!','<?php echo M_URL($this->AppName.'/Index','delCourseStudent',$v['userid'],GP('courseid-'.$courseid)) ?>')">
				<em><i class="arrow-down"></i></em><i class="iconfont icon-shanchu1"></i></a>
                <?php }?>
			</td>
		</tr>
		<?php } ?>
	 
	</table>

	<?php echo NoC($student);?> 
	<input type="hidden" name="batch" id="batch1" />
</form>

<?php if(count($student)!=0){ ?>
<div class="ks-bom clearfix">
	<label class="mr20 fl"><input type="checkbox" class="selectAll">全选</label>
	<span class="fl ml10">
		<button type="button" class="ks-heade-button" onclick="submitform(1)" ><i class="iconfont icon-shanchu1"></i></button>
        <button type="button" class="ks-heade-button mr10" onclick="submitform1(2)">学员导出</button>
	</span>
    <span style="line-height: 37px;padding-left: 15px;color: red;font-size: 10px;">线下开通学员才可以删除；导出不勾选默认导出全部学员</span>
	<div class="fr"><?php echo $page->show(3); ?></div>
 
	</div>
<?php } ?>

<script>
	function submitform(type){
		inspectionCheckBox('aid[]',function(){
			$('#batch1').val(type);
			
			if(type===1){
				top.popup.confirm('您确定要删除所选吗？',{
					determine:function(){
						$('#myform').submit();
					}
				})
			}else{
				$('#myform').submit();
			}
		})

	}
    function submitform1(type){
        $('#batch1').val(type);
        $('#myform').submit();
    }
</script>