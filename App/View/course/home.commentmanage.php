
	<div class="form-title2 clearfix"> 
		<div class="fr ks-top-search">
			<form target="hidframe" class="fr">
				<label class="mr10">
				   	<select class="w150 inputText bRadius5" id="keytype">
						<option value="1" <?php if($keytype == 1){ echo 'selected'; } ?>>评论内容</option>
						<option value="2" <?php if($keytype == 2){ echo 'selected'; } ?> >学员</option>
				  	</select>
				</label>				
				<input type="text" class="sc-text" name="searchText" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>"> 		
				<button type="submit" class="ks-head-search" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','comment',$courseid); ?>','<?php echo URL_MODEL;?>')" name="searchBtn" value="搜索" ><i class="iconfont icon-sousuo"></i></button>
				
			</form>
		</div>  
		评论管理
	</div>
	
	<form target="hidframe" action="" name="">
	 	
		   <table width="100%" cellpadding="0" cellspacing="0" border="0" class="ks-table mt20">
				<thead>
				<tr>
				 	<td width="30px">选择</td>
				 	<td>学员</td>
				 	<td>评论内容</td>
				 	<td>操作</td>
			   	</tr>
					
				</thead>
			   <?php if(count($values)!=0){foreach($values as $k=>$v){ ?>
			   <tr>
			   	 <td><input type="checkbox" class="select-check form-in" name="userid[]" ></td>
				 <td><?php echo Field($v['membername']); ?></td>
				 <td><?php echo Field($v['reviews']); ?></td>
				 <td>
				 	<div class="operate">
					 	<a href="javascript:void(0)" class="c-92 pr10 pl10 r-icon posRe" onClick="huiFu()">
					 	<em >回复<i class="arrow-down"></i></em>
					 	<i class="iconfont icon-huifu"></i></a>
					   	<a href="" class="c-92 pr10 pl10 r-icon posRe">
					 	<em>删除<i class="arrow-down"></i></em>
					 	<i class="iconfont icon-shanchu1"></i></a>
				 	</div>
				 </td>
			   </tr>
			   
			   
			  <?php }}?>
			  
			</table>
				 <?php echo NoC($values);?>
		
			<?php if(count($values)!=0){ ?>
			<div class="ks-bom clearfix">
				<label class="fl"><input name="" type="checkbox" value="" class="checkall check-all" id="selectAll">全选</label>
				<span class="fl ml10">
					<button type="submit" class="ks-heade-button" onclick="submitform(1)" ><i class="iconfont icon-shanchu1"></i></button>
				</span>
				<div class="fr mr30"><?php echo $page->show(3); ?></div>
			</div>
			<?php } ?>
 	</form>
