<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>添加试题</title>
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo UOOT;?>/Public/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo UOOT;?>/Public/ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="<?php echo UOOT;?>/Public/ueditor/lang/zh-cn/zh-cn.js"></script>
</head>
<body class="ks-wrap">
<form target="hidframe" enctype="multipart/form-data" id="myform" action="<?php if(isset($tk)){echo M_URL($this->AppName.'/Index','doeditTk',$tk['tkid'],GP(''));} else{echo M_URL($this->AppName.'/Index','doAddTk','',GP("userid-$this->userid"));} ?>" method="post" class="form-horizontal">
	<div class="bRadius10 ks-wbox">
		<!--header-->
		<div class="ks-head-box clearfix">
			<div class="ks-head-nav bd_e">
				<!--标题-->
				 <a href="javascript:history.go(-1);">试卷管理</a><span><em>/</em>添加试题</span>
				<!--标题-->
			</div>
		</div>
		<!--header-->
		<div class="form-box">
	    	<div class="form-row clearfix">
				<span class="form-star">*</span>
				<span class="name name-nowrap">题目类型</span>
				<select name="tkType" class="new-form fl" onchange="getChoice(this)" id="tktype" >
	                <option value="1" <?php if(isset($tk))if($tk['tktype'] == 1) echo "selected"; ?>>单选题</option>
	                <option value="2" <?php if(isset($tk))if($tk['tktype'] == 2) echo "selected"; ?>>填空题</option>
	                <option value="3" <?php if(isset($tk))if($tk['tktype'] == 3) echo "selected"; ?>>判断题</option>
	                <option value="4" <?php if(isset($tk))if($tk['tktype'] == 4) echo "selected"; ?>>问答题</option>
	                <option value="5" <?php if(isset($tk))if($tk['tktype'] == 5) echo "selected"; ?>>材料题</option>
	                <option value="6" <?php if(isset($tk))if($tk['tktype'] == 6) echo "selected"; ?>>多选题</option>  
	            </select>
	            <?php if(isset($tk)){ ?>
	         	<input type="hidden" name="tktype" value="<?php echo $tk['tktype']; ?>" />
	         	<?php } ?>
			</div>
			<div class="clearfix"><?php echo categotyCourse($value,$Linkage->Linkage(2));?></div>
			<div class="form-row">
				<span class="form-star">*</span>
				<span class="name name-nowrap">试题难度</span>
				
				<select name="level" class="new-form">
	                 <option value="1" <?php if(isset($tk)){if($tk['level']==1) echo 'selected = "selected"';} ?>>简单</option>
	                <option value="2"<?php if(isset($tk)){if($tk['level']==2) echo 'selected = "selected"';} ?>>一般</option>
	                <option value="3"<?php if(isset($tk)){if($tk['level']==3) echo 'selected = "selected"';} ?>>困难</option>
	            </select>
	
			</div>
			<?php  if($setting[4]==1){  ?>
			<div class="form-row">
				<span class="form-star">*</span>
				<span class="name name-nowrap">所属类型</span>
				
				<select name="paperTypeId"class="new-form">
	                 <?php foreach($papertype as $k=>$v){?>
	                    <option value="<?php echo $v['id'] ?>" <?php if(isset($paper)){if($v['id']==$paper['paperType']) echo 'selected = "selected"';} ?>>
	                           <?php echo $v['typeName']?>
	                    </option>
	                    <?php } ?>
	            </select>
		
			</div>
			<?php } ?>
			<!--<div class="form-row clearfix">
				<span class="name name-nowrap">启用音频</span>
				
				<input class="mt10" type="checkbox" id="isaudio" name="audio" value="1" >
	
			</div>-->
			<!--<div class="form-row clearfix" id="audio">
				<span class="form-star">*</span>
				<span class="name name-nowrap">上传音视频</span>
				<div id="uploader" class="fl">-->
		        <!--用来存放文件信息-->
		        	<!--<div id="thelist" class="uploader-list"></div>
			        <div class="btns">
			            <div id="picker">选择文件</div>
			            <input type="hidden" name="uploads" id="videourl" value="" />
			        </div>
		        </div>
				
			</div>-->
	
	        <?php if($setting[7]==1){ ?>
	       <div class="form-row clearfix">
	       		<span class="name name-nowrap">标签/知识点</span>
	        	<button type="button" onclick="addPaperKpoint('<?php echo M_URL($this->AppName.'/Index','addKpoint','',GP('')) ?>')" class="ks-bt bt-pur" id="addStudent"><i class="iconfont icon-jiahao"></i>课程标签/知识点</button>
	       </div>		
	      	<div class="form-row clearfix">
	      		<span class="name name-nowrap"></span>
	           	<ul id="knowledge">
	           		<?php if(isset($kpoint))foreach($kpoint as $k=>$v){ ?>
	           	   <li id="kption<?php echo $v['id'] ?>" class="kpointO"><div class="ks-bt bt-def Porel"><?php echo $v['title'] ?>
	<span class="Poabs ToPr1812" onclick="delKption(<?php echo $v['id'] ?>)"><i class="iconfont icon-quxiao"></i></span>
	<input type="hidden"   name="kpoint[]" value="<?php echo $v['id'] ?>" /></div></li>
	           	
	           		<?php } ?>
	          	</ul >
	           
			</div>	
	
			<?php } ?>
			
		<div class="clearfix">
			
	        <div class=" itemBox" id="Multiple" >
	        <div class="form-row">
				<span class="form-star">*</span>
				<span class="name">题目内容</span>
				<?php echo isset($stem1) ? $stem1 : ''; ?>
			</div>	
	        	
	        <?php if(isset($select)){foreach($select as $k=>$v){ ?>
	        	
	        <div class="form-row">
				<span class="form-star">*</span>
				<span class="name">选项<span class="EnNum"></span></span>
				<textarea name="select1[]" rows="3" cols="20" class="form-textarea" placeholder="请输入内容" ><?php echo trim($v) ?></textarea>
			</div>	
	        <?php }}else{ ?>	
	        <div class="form-row">
	        	<div class="form-limit" limit="300">
				<span class="form-star">*</span>
				<span class="name">选项<span class="EnNum"></span></span>
				<textarea name="select1[]" rows="3" class="form-textarea" placeholder="请输入题目内容"></textarea>
				</div>
			</div>	
			
			<div class="form-row">
				<div class="form-limit" limit="300">
				<span class="form-star">*</span>
				<span class="name">选项<span class="EnNum"></span></span>
				<textarea name="select1[]" rows="3" class="form-textarea"  placeholder="请输入内容"></textarea>
				</div>
			</div>
			
			<div class="form-row">
				<div class="form-limit" limit="300">
				<span class="form-star">*</span>
				<span class="form-cancel" onclick="delSelect(this)"><i class="iconfont icon-quxiao"></i></span>
				<span class="name">选项<span class="EnNum"></span></span>
				<textarea name="select1[]" rows="3" class="form-textarea"  placeholder="请输入内容"></textarea>
				</div>
			</div>
			
			<div class="form-row">
				<div class="form-limit" limit="300">
				<span class="form-star">*</span>
				<span class="name">选项<span class="EnNum"></span></span>
				<span class="form-cancel" onclick="delSelect(this)"><i class="iconfont icon-quxiao"></i></span>
				<textarea name="select1[]" rows="3" class="form-textarea"  placeholder="请输入内容"></textarea>
				</div>
			</div>	
			
	
	        <?php }?>
		       	<div class="addSelect" onclick="addSelect()">
					<span>添加选项</span>
				</div>	 	
	        	
	        	<div class="choice-word">
	        		<div class="form-row">
						<span class="form-star">*</span>
						<span class="name">正确选项</span>
						<div class=" clearfix" id="word-td">
			            <?php if(isset($select)){foreach($select as $k=>$v){ ?>
			                <label class="radioLabel EnRo">
			                    <input type="radio" name="anser1" value="<?PHP echo chr($k+65) ?>" <?php if($tk['anser']==chr($k+65)) echo "checked" ?>>
			                    <?PHP echo chr($k+65) ?>
			                </label>       
			            <?php }}else{ ?>      
			                <label class="radioLabel EnRo">
			                    <input type="radio" name="anser1" value="A"><span class="fl"></span> 
			                </label>
			                <label class="radioLabel EnRo">
			                    <input type="radio" name="anser1" class="radioInput" value="B"><span class="fl"></span> 
			                </label>
			                <label class="radioLabel EnRo">
			                    <input type="radio" name="anser1" class="radioInput" value="C"><span class="fl"></span> 
			                </label>
			                <label class="radioLabel EnRo">
			                    <input type="radio" name="anser1" class="radioInput" value="D"><span class="fl"></span> 
			                </label>
			            <?php }?>
			             </div>
					</div>	
	        	</div>
	        </div>
	        <!--end-->	
	
	        <!--填空题 -->
	        <div class=" itemBox" id="topic">
	        
		        <div class="form-row">
		        	
		        	
		        	
					<span class="form-star">*</span>
					<span class="name">题目内容 <span class="fsize12 c-red">(如选择题填写具体的选项，填空题在需要用户作答的地方放{#answer}标签，使用户编辑器时shift+Enter分段)</span></span>
					<?php echo isset($stem2) ? $stem2 : ''; ?>
					
				</div>	
				
				<div class="form-row">
					<span class="form-star">*</span>
					<span class="name">正确答案 <span class="fsize12 c-red">( Tips:填空题如果有多个空格，各个空格的参考答案之间用*隔开，一个空有多个答案的，在用丨线隔开。如1丨2*2*3表示
		                    有三个空格，第一个空格的答案可以是1或2，第二个空格的答案是2，第三个空格的答案是3)</span></span>
					<textarea rows="2" cols="20" name="anser2" style="height: 200px;width: 81%"><?php if(isset($anser2))echo trim($anser2); ?></textarea>
		
				</div>	
		
				<div class="form-row">
					<span class="form-star">*</span>
					<span class="name">答案解析 <span class="fsize12 c-red">( Tips:填空题如果有多个空格，各个空格的参考答案之间用*隔开，一个空有多个答案的，在用丨线隔开。如1丨2*2*3表示
		                    有三个空格，第一个空格的答案可以是1或2，第二个空格的答案是2，第三个空格的答案是3)</span></span>
					<div><?php if(isset($analysis2)) echo trim($analysis2); ?></div>
		
				</div>	
			
			
	        </div>
	        
	        
	        <!--end-->
	        <!-- 判断题-->
	        <div class=" itemBox" id="judge">
	        	
	        	<div class="form-row">
					<span class="form-star">*</span>
					<span class="name">题目内容 </span>
					<div class="clearfix"><?php echo isset($stem3) ? $stem3 : ''; ?></div>
				</div>
				
				<div class="form-row">
					<span class="form-star">*</span>
					<span class="name">正确答案 </span>
					<div class="clearfix">
		                <label>
		                    <input type="radio" name="anser3" value="1" <?php if(isset($anser3)){if($anser3==1) echo "checked";} ?>>正确
		                </label>
		                <label>
		                    <input type="radio" name="anser3" value="0" <?php if(isset($anser3)){if($anser3==0) echo "checked";}else{echo "checked";} ?>>错误
		                </label>
		            </div>
				</div>
	        	
	        	<div class="form-row">
					<span class="form-star">*</span>
					<span class="name">答案解析 </span>
					<div class="clearfix form-limit" limit="300">
						<textarea name="analysis3" rows="3" id="parsing0" class="form-textarea"  placeholder="请输入内容"><?php if(isset($analysis3))echo trim($analysis3); ?></textarea>
		            </div>
				</div>
	
	        </div>
	        <!--end-->
	
	        <!-- 问答题-->
	        <div class=" itemBox" id="question">
	
				<div class="form-row">
					<span class="form-star">*</span>
					<span class="name">题目内容 </span>
					<div class="clearfix">
		             <?php echo isset($stem4) ? $stem4 : ''; ?>
		            </div>
				</div>
				
				<div class="form-row">
					<span class="form-star">*</span>
					<span class="name">正确答案 </span>
					<div class="clearfix">
						<div class="form-limit" limit=200>
					<textarea name="anser4" rows="3" class="form-textarea" id="question2"  placeholder="请输入内容"><?php if(isset($anser4))echo trim($anser4); ?></textarea> </div>
		            </div>
				</div>
				
				<div class="form-row">
					<span class="form-star">*</span>
					<span class="name">关键字 <span class="fsize12 c-red">Tips:主观题将根据设置的关键词估分，多个关键词请用英文逗号（，）隔开</span></span>
					<div class="clearfix">
						<div class="form-limit" limit=200>
						<textarea name="keyword" rows="3" class="form-textarea" placeholder="请输入内容"><?php if(isset($ketword))echo trim($ketword); ?></textarea></div>
		            </div>
				</div>
	 
	 			<div class="form-row">
					<span class="form-star">*</span>
					<span class="name">答案解析</span>
					<div class="clearfix">
						<div class="form-limit" limit=200>
						<textarea name="analysis3" rows="3" class="form-textarea" placeholder="请输入内容"><?php if(isset($analysis4))echo trim($analysis4); ?></textarea></div>
		            </div>
				</div>
	        </div> 
	        
	        
	        
	        <!--材料题-->
	        <div class=" itemBox" id="addTitle">	
	        	<div class="form-row">
					<span class="form-star">*</span>
					<span class="name">题目内容</span>
					<div class="clearfix">
		          		<?php echo isset($stem5) ? $stem5 : ''; ?>
		            </div>
				</div>
				
				<div class="form-row" id="select3">
					<span class="form-star">*</span>
					<span class="name">几小题</span>
					<div class="clearfix">
						<select name="select" class="new-form" onchange="getselect1(this)" id="tktype">
	                    <option value="1" <?php if(isset($selt1))if($selt1 == 1) echo "selected"; ?>>1</option>
	                    <option value="2" <?php if(isset($selt1))if($selt1 == 2) echo "selected"; ?>>2</option>
	                    <option value="3" <?php if(isset($selt1))if($selt1 == 3) echo "selected"; ?>>3</option>
	                    <option value="4" <?php if(isset($selt1))if($selt1 == 4) echo "selected"; ?>>4</option>
	                    <option value="5" <?php if(isset($selt1))if($selt1 == 5) echo "selected"; ?>>5</option>
	                    <option value="6" <?php if(isset($selt1))if($selt1 == 6) echo "selected"; ?>>6</option>
	                    <option value="7" <?php if(isset($selt1))if($selt1 == 7) echo "selected"; ?>>7</option>
	                </select>
					</div>
					
				</div>
				
				<?php  if(isset($option)){foreach($option as $k=>$v){ ?>
				<div class="form-row html3">
					<span class="form-star">*</span>
					<span class="name">第<?php echo $k+1 ?>小题题目</span>
					<div class="clearfix">
						<textarea name="options5[]" rows="3" class="form-textarea" id="addTitle3" placeholder="请输入内容"><?php echo $v ?></textarea>
		            </div>
				</div>
	      
				<div class="form-row html4">
					<span class="form-star">*</span>
					<span class="name">第<span class="answer-span"><?php echo $k+1 ?></span>小题答案</span>
					<div class="clearfix">
						<textarea name="anser5[]" rows="3" class="form-textarea" id="addTitle3" placeholder="请输入内容"><?php echo $anser5[$k] ?></textarea>
		            </div>
				</div>
	      
	        	<?php }}else{ ?>
	        		
	        		
	        	<div class="form-row html3">
					<span class="form-star">*</span>
					<span class="name">第1小题题目</span>
					<div class="clearfix">
						<textarea name="options5[]" rows="3" class="form-textarea" id="addTitle3" placeholder="请输入内容"></textarea>
		            </div>
				</div>
	      
				<div class="form-row html4">
					<span class="form-star">*</span>
					<span class="name">第<span class="answer-span">1</span>小题答案</span>
					<div class="clearfix">
						<textarea name="anser5[]" rows="3" class="form-textarea" id="addTitle4" placeholder="请输入内容"></textarea>		
		            </div>
				</div>	
	        <?php } ?>
	        </div>
	        <!--多选题-->
	        <div class="itemBox" id="Multiple" style="display: table-row-group">
	        	
	        	<div class="form-row html4">
					<span class="form-star">*</span>
					<span class="name">第<span class="answer-span">1</span>题干</span>
					<div class="clearfix">
		          		<?php echo isset($stem7) ? $stem7 : ''; ?>
		            </div>
				</div>	
	        	
	        	<div class="form-row html4" id="select2">
					<span class="form-star">*</span>
					<span class="name">第<span class="answer-span">1</span>选项</span>
					<div class="clearfix">
		          		<select name="select" class="new-form" onchange="getselect(this)" id="tktype">
	                        <option value="2" <?php if(isset($selt))if($selt == 2) echo "selected"; ?>>2</option>
	                        <option value="3" <?php if(isset($selt))if($selt == 3) echo "selected"; ?>>3</option>
	                        <option value="4" <?php if(isset($selt))if($selt == 4) echo "selected"; ?>>4</option>
	                        <option value="5" <?php if(isset($selt))if($selt == 5) echo "selected"; ?>>5</option>
	                        <option value="6" <?php if(isset($selt))if($selt == 6) echo "selected"; ?>>6</option>
	                        <option value="7" <?php if(isset($selt))if($selt == 7) echo "selected"; ?>>7</option>
	                        <option value="8" <?php if(isset($selt))if($selt == 8) echo "selected"; ?>>8</option>
	                   </select>
		            </div>
				</div>
	        <?php if(isset($select7)){foreach($select7 as $k=>$v){ ?>
	        	
	        <div class="form-row html4">
				<span class="form-star">*</span>
				<span class="name">第<span class="answer-span">1</span>题干</span>
				<div class="clearfix">
	          		<?php echo isset($stem7) ? $stem7 : ''; ?>
	            </div>
			</div>	
			
			<div class="form-row html1">
				<span class="form-star">*</span>
				<span class="name">选项<i class="secW"><?PHP echo chr($k+65) ?></i></span>
				<div class="clearfix form-limit" limit="200">
	          		<textarea name="select2[]" rows="3" cols="20" class="form-textarea"  placeholder="请输入内容"><?php echo $v ?></textarea>
	            </div>
			</div>	
	        
	        <?php }}else{ ?>
	        	
	        <div class="form-row html1">
				<span class="form-star">*</span>
				<span class="name">选项<i class="secW">A</i></span>
				<div class="clearfix form-limit" limit="200">
	          		<textarea name="select2[]" rows="3" cols="20" class="form-textarea"  placeholder="请输入内容"></textarea>
	            </div>
			</div>	
			
			<div class="form-row html1">
				<span class="form-star">*</span>
				<span class="name">选项<i class="secW">B</i></span> 
				<div class="clearfix form-limit" limit="200">
	          		<textarea name="select2[]" rows="3" cols="20" class="form-textarea"  placeholder="请输入内容"></textarea>
	            </div>
			</div>	
	        	
	        <?php } ?>
	        <div class="form-row">
				<span class="form-star">*</span>
				<span class="name">正确选项</span>
				<div class="" id="word1-td">
	                <?php if(isset($select7)){foreach($select7 as $k=>$v){ ?>
	                     <label class="html2">
	                        <input type="checkbox" name="answer7[]" class="abc" value="<?PHP echo chr($k+65) ?>" <?php if(in_array(chr($k+65),$anser7)) echo "checked" ?>>
	                        <span><?PHP echo chr($k+65) ?></span>
	                    </label>
	                <?php } }else{?>
	                <label class="html2">
	                    <input type="checkbox" name="answer7[]" class="abc" value="A">
	                    <span>A</span>
	                </label>
	                <label class="html2">
	                    <input type="checkbox" name="answer7[]" class="" value="B">
	                    <span>B</span>
	                </label>
	                <?php } ?>
	            </div>
			</div>		
	        </div>
	        <!-- end-->
	    </div>
	    
	    </div>

    </form>
    <div class="form-footer clearfix">
			<span class="d-inline-block">
		      <input type="button" onClick="do_reg()" class="ks-bt bt-pue" value="确认添加" name="save">
		      <input type="button" onClick="history.go(-1)" class="ks-bt bt-white" value="取消" >	
	    		
	    		
	    	</span>
		</div>
    
    </div>

    
		


<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
	module.config.paths['uploader'] = '<?php echo UOOT;?>Public/common/js/webuploader.js';
	module.require(['backstage','nicescroll','cookie','uploader'],function(){
		
		loadScorllJs();
		uploaderTwo('<?php echo M_URL($this->AppName.'/Index','videoupload','',GP(''));?>');
		
		$(function(){ 
			$('#isaudio').click(function(){
			  var a = $('#isaudio').prop('checked');
			  if(a){
		 		 $('#audio').show();		  
			  }else{
				 $('#audio').hide();	
			 }
			  
		   })
		   var text = parseInt($("#tktype").val()) - 1;
		    $('.itemBox:eq(' + text + ')').show().siblings().hide();
			
			//是否启用音视频
			 var a = $('#isaudio').prop('checked');
			 
			  if(a){
			      $('#audio').show();		  
			  }else{
				 $('#audio').hide();	
			 };
			 
			$('#addBox').click(function () {
				var word = $(this).parents('tr').find('.secW').text();
				b = String.fromCharCode(word.charCodeAt() + 1);
				var html = '';
				var word1 = '';
				html += '<div><div class="leftTd alignRight fsize16 c-79 w200 borderBda">选项<i class="secW">' + b + '</i></div>';
				html += '<div class="leftTd alignLife fsize12 c-92 pr10 borderBda"><textarea name="select[]" class="inputText bRadius5 p16"cols="20" rows="2"style="height:100px;width: 40%" ></textarea></div></div>';
				$(this).parents('tr').after(html);
				word1 += '<label class="radioLabel fl"><input type="radio" name="anser1" class="radioInput" value='+b+'><span class="radioName fsize14 c-92" >'+b+'</span></label>';
				$('#number-table').after(html);
				$(this).insertAfter($(this).parents('tr').next('tr').find('textarea'));
			    var a= $('#word-td').append(word1);
			})
			
			 $('#answer-btn').click(function(){
				var answerword =parseInt($(this).parents('tr').find('.answer-span').text())+1;
				var topic ='';
				topic += '<div><div class="leftTd alignRight fsize16 c-79 w200 borderBda pr20 verAlignTop">第<span class="answer-span">'+answerword+'</span>小题题目</div>';
				topic +='  <div class="leftTd alignLife fsize12 c-92 pr10 borderBda"><textarea cols="2" rows="20" style="height: 200px;width: 95%"  id="B'+answerword+'"></textarea></div></div>'
				topic += '<div><div class="leftTd alignRight fsize16 c-79 w200 borderBda pr20 verAlignTop btnsign">第<span class="answer-span">'+answerword+'</span>小题答案</div>';
				topic +='  <div class="leftTd alignLife fsize12 c-92 pr10 borderBda"><textarea cols="2" rows="20" style="height: 200px;width: 95%" id="C'+answerword+'"></textarea></div></div>'
				$(this).parents('tr').after(topic);
				$(this).insertAfter($(this).parents('tr').next('tr').next('tr').find('textarea'));
			});
			resetSe()
		})
	});

	function tkcount(){};
	function addPaperKpoint(url){
		 var kpoint ='';
	     $(".kpointO").each(function(){
	        var a = $(this).find($("input")).val();
	        kpoint+=a+'|';
	     });
	    
	    if(kpoint != ''){
	    	kpoint =kpoint.substr(0,kpoint.length-1);
	    	
	    	 addTypeChange(url+',kpoint-'+kpoint,'800px','540px',{title:' '});
	    	 return false;
	    }
	 
		$.cookie('addKption','',{ expires: -1 });
	    addTypeChange(url,'800px','540px',{title:' '})
	
	};	
	
	function delKption(id){
	   $("#kption"+id).remove();	
	}

	function do_reg()
	{
		var tkType = $("select[name='tkType']").val();
		if(tkType == 1){
			var stem1 = $("textarea[name='stem1']").val();
			var anser1 = $("radio[name='anser1']").val();
			if(stem1==''){
			   Alert('题目不能为空');
			   return false;	
	        }	
			if(anser1==''){
			   Alert('答案不能为空');
			   return false;	
	        }	
		}
		
		if(tkType == 2){
			var stem2 = $("textarea[name='stem2']").val();
			var anser2 = $("radio[name='anser1']").val();
			if(stem2==''){
			   Alert('题目不能为空');
			   return false;	
	        }
			if(anser2==''){
			   Alert('答案不能为空');
			   return false;	
	        }		
		}
		
		if(tkType == 3){
			var stem3 = $("textarea[name='stem3']").val();
			var anser3 = $("radio[name='anser3']").val();
			if(stem3==''){
			   Alert('题目不能为空');
			   return false;	
	        }
			if(anser3==''){
			   Alert('答案不能为空');
			   return false;	
	        }	
		}
		
		if(tkType == 4){
			var stem4 = $("textarea[name='stem4']").val();
			var anser4 = $("textarea[name='anser4']").val();
			if(stem4==''){
			  Alert('题目不能为空');
			  return false;	
	        }
			if(anser4==''){
			   Alert('答案不能为空');
			   return false;	
	        }		
		}
		if(tkType == 5){
			var stem5 = $("textarea[name='stem5']").val();
			var anser5 = $("textarea[name='anser5']").val();
			if(stem5==''){
			  Alert('题目不能为空');
			  return false;	
	        }
			if(anser5==''){
			   Alert('答案不能为空');
			   return false;	
	        }		
		}
		
		if(tkType == 6){
	
			var anser6 = $("textarea[name='anser6']").val();
			
			if(anser6==''){
			   Alert('答案不能为空');
			   return false;	
	        }		
		}
		$("#myform").submit();	
	} 

 
 function getChoice(obj) {
        var text = parseInt($(obj).val()) - 1;
        $('.itemBox:eq(' + text + ')').show().siblings().hide();
    }
    


function getselect(obj){
	 var text = parseInt($(obj).val());
	 $('.html1').remove();
	 $('.html2').remove();
	 var html1 = '';
	 var html2 = '';
	 for(i=1;i<=text;i++){
	    b = String.fromCharCode(64 + i);
	    html1 +='<div class="form-row html1"><span class="form-star">*</span> <span class="name">选项<i class="secW">'+b+'</i></span><div class="clearfix form-limit" limit="200">';
	    html1 +='<textarea name="select2[]" rows="3" cols="20" class="form-textarea"  placeholder="请输入内容"></textarea> </div> </div>';
	   
		html2 +='<label class="html2"> <input type="checkbox" name="answer7[]" class="" value="'+b+'"> <span>'+b+'</span> </label>';
		
	 }
	 $('#word1-td').append(html2);
	 $('#select2').after(html1);
	 textLimit();
	 
   }
function getselect1(obj){
        var text = parseInt($(obj).val());
		 $('.html3').remove();
		 $('.html4').remove();
		var html = '';
		for(i=1;i<=text;i++){
			
			html +='<div class="form-row html3"> <span class="form-star">*</span> <span class="name">第'+i+'小题题目</span> <div class="clearfix"> <textarea name="options5[]" rows="3" class="form-textarea" id="addTitle3" placeholder="请输入内容"></textarea> </div> </div>';
      
			html +='<div class="form-row html4"> <span class="form-star">*</span> <span class="name">第<span class="answer-span">'+i+'</span>小题答案</span> <div class="clearfix"> <textarea name="anser5[]" rows="3" class="form-textarea" id="addTitle4" placeholder="请输入内容"></textarea> </div> </div>';
			
			
	    }
		$('#select3').after(html)    			 
}  


	function resetSe(){
		var i =0;
		var b =0;
		$(".EnNum").each(function(){
			i++;
			var sub = String.fromCharCode(64 + parseInt(i));
			$(this).text(sub);
		})
		$(".EnRo").each(function(){
			b++;
			var sub = String.fromCharCode(64 + parseInt(b));
			$(this).find("input").val(sub);
			$(this).find(".fl").text(sub);
			
		})
		
	}
	function addSelect(){
		var i = $(".EnNum").length;
		var sub = String.fromCharCode(64 + parseInt(i+1));
		var Data = '<div class="form-row"><div class="form-limit" limit="300"> <span class="form-star">*</span> <span class="name">选项<span class="EnNum"></span></span> ';
		Data+='<span class="form-cancel"  onclick="delSelect(this)"><i class="iconfont icon-quxiao"></i></span> <textarea name="select2[]" rows="3" class="form-textarea"  placeholder="请输入内容"></textarea></div></div>';
		var Rata='<label class="radioLabel EnRo"><input type="radio" name="anser1" class="radioInput" value=""/><span class="fl"></span></label>';
		$("#word-td").append(Rata);
		$(".addSelect").before(Data);
		resetSe();
		
		textLimit($('.form-limit'));
	}
	
	function delSelect(e){
		var $parentFormRow = $(e).parents(".form-row");
		var index= $parentFormRow.index();
		
		$(".EnRo").last().remove();
		$parentFormRow.remove();
		resetSe();
	}
	
	</script>  


</body>
</html>
