
<div class="form-title2">SEO设置</div>
<form target="hidframe" action="<?php echo M_URL($this->AppName.'/Index','doaddseo',$courseid,GP('')) ?>" method="post" id="myform">		
	
	<div class="form-box">
		<div  class="form-row">
			<span class="name fsize14">课程SEO关键字<span class="c-red ml10 fsize12">可不填</span></span>
			<div class="clearfix form-limit" limit="200"> 
			<textarea name="seokeywords" rows="3" class="form-textarea" id="copyrightinfo" placeholder="请输入描述内容"><?php if(isset($course['seokeywords']))echo $course['seokeywords']; ?></textarea>
			</div>
			</div>
			<div  class="form-row fsize14">
			<span class="name">课程SEO描述<span class="c-red ml10 fsize12">可不填</span></span>
			<div class="clearfix form-limit" limit="200">  
			<textarea name="seodescription" rows="3" class="form-textarea" id="copyrightinfo"  placeholder="请输入描述内容"><?php if(isset($course['seodescription']))echo $course['seodescription']; ?></textarea>
			</div>
			</div>
			<div>
			</div>
	</div>

	<div class="form-footer clearfix">
		<input type="hidden" name="typea" id="typea"  />
		<input  type="button" onclick="do_reg(3);" class="ks-bt bt-pue mr10" value="保存seo配置">
		<input  type="button" onclick="do_reg(1);" class="ks-bt bt-white mr10" value="保存返回列表">
        <a href="<?php echo M_URL($this->AppName.'/Index','index','',GP('')); ?>" class="ks-bt bt-white">取消返回列表</a>
    	
	</div>
				
</form> 
