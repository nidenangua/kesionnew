
	<div class="form-title2 clearfix"> 
		<a href="javascript:void(0)" class="ks-bt bt-pue ml10 class-v8" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','coursefile',$this->courseid,GP('type-5')) ?>','850px','600px',{title:'选择资料',type:'top'})" id="addStudent" style="float:right"> <i class="iconfont icon-jiahao"></i>资料</a>
     <div class="ks-top-search fr">
      <!--搜索-->
      <form target="hidframe"  class="fr">
       
						<input type="text" class="sc-text" name="searchkeyword" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>">	
						<button type="submit" class="ks-head-search"  onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','information',$this->courseid); ?>','<?php echo URL_MODEL;?>');" name="searchBtn" ><i class="iconfont icon-sousuo"></i></button>
						
      </form>
      <!--搜索--> 
    </div>
		课程资料
	</div>
	
	<form target="hidframe"  action="<?php echo M_URL($this->AppName.'/Index','batchfile',$this->courseid,GP('')) ?>" method="post" id="myform">
    <table width="100%" cellpadding="0" cellspacing="0" border="0" class="ks-table">
    	
   <?php  if(isset($files))foreach($files as $k=>$v){ ?> 	
      <tr>
        <td style="width: 30px;">
            	<div class="fl ">
                	<input type="checkbox" class="select-check" name="aid[]" value="<?php echo $v['id']; ?>" >
              	</div>
          </td>
        <td class="alignCenter"  >
        	<div class="fl class-vimg"><img src="<?php echo $v['src']; ?>"></div>
              <div class="class-vtxt fl">
                 <h3><?php echo $v['filename']; ?></h3>
                 <p ><span >添加时间：<?php echo date('Y:m:d',$v['adddate']); ?></span><span class="class-vf">大小：<?php echo $v['size']?KS_Byte($v['size']):'--'; ?></span></p>
              </div>
        </td>
        <td class="alignLife">
        	 <div class="class-vtxt fl">
        	 		<h3></h3>
        	 		<?php if($v['isMaterial'] == 1){ ?>
        	 		<p id="type<?php echo $v['fileid']; ?>" ><span class="c-86A8F">备课教案</span></p>
        	    <?php  } ?>
        	 </div>
        </td>
        <td class="class-vb" style="width: 30%">
        	<a class="class-v8 class-v50"  href="javascript:void(0);" onclick="Confirm('是否删除该文件？该操作不可逆!','<?php echo M_URL($this->AppName.'/Index','delfile',$v['id'],GP("courseid-$this->courseid")); ?>')">删除</a>
        	
        	
        	
        	<a class="class-vd fr">
                <div class="form-switch fr mt5 ml20 shen" open-value="1">
					
					
				
					

						<label for="s2<?php echo $v['id']; ?>">
							<input type="radio" id="s2<?php echo $v['id']; ?>" onclick='isopen(<?php echo $v['id']; ?>,2)';  class="shenghe" value="2" <?php if($v["isopen"]==2) echo "checked";?> >
						</label>
						<label for="s1">
							<input type="radio" id="s1<?php echo $v['id']; ?>" onclick='isopen(<?php echo $v['id']; ?>,1)'  class="shenghe" value="1" <?php if($v["isopen"]==1) echo "checked";?> >
						</label>
										</div>
            	<span class="fr job-mt7">是否公开</span>
        	</a>
        	<!--设置备课资料-->
        	
        		<a class="class-vd fr mr20">
            <div class="form-switch fr mt5 ml20 shen" open-value="1">

								<label for="a2<?php echo $v['id']; ?>" >
									<input type="radio" id="a2<?php echo $v['id']; ?>" onclick='isMaterial(<?php echo $v['fileid']; ?>,0)'; class="shenghe" value="0" <?php if($v["isMaterial"]==0) echo "checked";?>>
								</label>
								<label for="a1<?php echo $v['id']; ?>" >
									<input type="radio" id="a1<?php echo $v['id']; ?>" onclick='isMaterial(<?php echo $v['fileid']; ?>,1)';   class="shenghe" value="1" <?php if($v["isMaterial"]==1) echo "checked";?>>
								</label>
								</div>
        	<span class="fr job-mt7">设置为备课资料</span>
        	</a>
        	
        </td>
      </tr>
     <?php } ?>
    
    </table>
     <?php echo NoC($files);?>
    <input type="hidden" name="batch" id="batch1" />
  </form>
  
  <?php if(count($files)!=0){ ?> 
		<div class="ks-bom clearfix" >
			<label class="fl" style="margin-left: 10px;"><input type="checkbox" id="selectAll"> 全选</label>
      	<span class="fl ">
			  <button type="button" class="ks-heade-button" onclick="$('#myform').submit();" ><i class="iconfont icon-shanchu1"></i></button>
			  </span>
			 <div class="fr"><?php echo $page->show(3); ?></div>
		</div>
		<?php } ?> 

<script>


function isopen(id,value){	
	$.ajax({
		
        type: "POST",
        url:"<?php echo M_URL($this->AppName.'/Ajax','isopenFile',$this->courseid,GP('')) ?>",
        data:{id:id,value:value},
        success:function(text){ }
     });
}

function isMaterial(id,value){
	$.ajax({ 
		
        type: "POST",
        url:"<?php echo M_URL($this->AppName.'/Ajax','isMaterial',$this->courseid,GP('')) ?>",
        data:{id:id,value:value},
        success:function(text){
					
					if(value ==1){
							$('#type'+id).html('<span class="c-86A8F">备课教案</span>')
					}else{
						$('#type'+id).html(' ')
					}
				}
  })
	
}

</script>
