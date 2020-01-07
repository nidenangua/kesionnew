
	<div class="form-title2">
		<span class="fr ml10">
	  	 <a href="javascript:void(0)" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','bindPaper',$this->courseid,GP('')) ?>','1000px','600px',{title:'选择试卷',type:'top'})" class="ks-bt bt-pue"><i class="iconfont icon-jiahao"></i>试卷</a>
		</span>
		<div class="fr">
			<form target="hidframe">
				<div class="ks-top-search fr">
					<input type="text" class="sc-text" name="searchText" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>">
					<button type="submit" class="ks-head-search" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','exam',$this->courseid); ?>','<?php echo URL_MODEL;?>');"/><i class="iconfont icon-sousuo"></i></button>
				</div>
	        </form>
	      
		</div>
		试卷管理
	</div>
        	
	<form target="hidframe"  action="<?php  echo M_URL($this->AppName.'/Index','batchpaper',$this->courseid,GP('p-'.$page->now_page)) ?>" method="post" id="myform">
   
    <table width="100%" cellpadding="0" cellspacing="0" border="0" class="ks-table mt20">

        <thead>
	        <tr>
	            <th class="alignCenter ">
	            	选择
	            </th>
	            <th class='add-limit-width add-text-align-left'>试卷名称</th>
	            <th >所属章节</th>
	            <th>试卷分值</th>
	            <th>考试人数</th>
	            <th>操作</th>
	        </tr>
        </thead>
        <tbody>
<?php if(count($values)!=0){foreach($values as $k=>$v){ ?>
		<tr>
			<td style="width: 30px;"><input type="checkbox" class="select-check " name="paperid[]" value="<?php  echo Field($v['paperid']) ?>"></td>
			<td class='add-limit-width add-text-align-left'><a href="<?php echo M_URL('exam/Index','preview',$v['paperid'],GP("courseid-$this->courseid,appid-10,bappid-$this->appid")) ?>"><?php echo Field($v['Title']) ?></a></td>
			<td><?php echo Field($v['chaptertitle']) ?></td>
			<td><?php echo Field($v['sumscore']) ?></td>
			<td>0</td>
   
     		<td>
				<div class="operate">
				<!--<a  href="<?php echo M_URL('exam/Index','preview',$v['paperid'],GP("courseid-$courseid,appid-10,bappid-$this->appid")); ?>">
				<em>预览</em>
				<i class="icon-yulan1 pr10 iconfont"></i> </a> -->
				
				<a href="<?php echo M_URL('exam/Index','editPaper',$v['paperid'],GP("courseid-$this->courseid,appid-10,bappid-$this->appid,p-$page->now_page")); ?>">
				<em>编辑</em>
				<i class="icon-bianji4 pr10 iconfont"></i> </a>
				 
				<a href="javascript:void(0);" onclick="Confirm('是否删除此试卷？该操作不可逆!','<?php echo M_URL($this->AppName.'/Index','delPaper',$v['paperid'],GP("courseid-$this->courseid")); ?>')"> 
				 <em>删除</em>
				<i class="icon-shanchu1 iconfont"></i> </a>
				</div>
			</td>
		</tr>
		<?php }}?>
        </tbody>
    </table>
     <?php echo NoC($values);?>
	<input type="hidden" name="batch" id="batch1" />
  
  </form>
       

	<?php if(count($values)!=0){ ?>
	<div class="ks-bom clearfix">
		<label class="mr20 fl"><input type="checkbox" class="select-checks selectAll">全选</label>
		<button type="button" class="ks-heade-button ml10" onclick="$('#batch1').val(type);$('#myform').submit();" ><i class="iconfont icon-shanchu1"></i></button>
		<div class="fr "><?php echo $page->show(3); ?></div>
	</div>
	<?php } ?>
                
        