<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="renderer" content="webkit">
    <title>添加试卷</title>
    <link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
    <link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
    <link href="<?php echo UOOT;?>Public/app/css/common.css" rel="stylesheet">
    <link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />

	<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
    <script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
	
	<style>
		.pricebox{margin-top:20px;}
		.pricebox .item{font-size:14px; color:#999; margin-top:10px;}
		.pricebox input{background: #fff;margin:0 10px;}
	</style>

</head>
<body class="ks-wrap"> 
	
	<div class="ks-wbox bRadius10">

		
		<div class="ks-head-nav">
			<!--标题-->
			<a href="javascript:history.go(-1);">试卷管理</a><span><em>/</em><?php if(ACTION == 'paperAdd'){ ?>添加试卷<?php }else{ ?>编辑试卷<?php } ?></span>
			<!--标题-->
		</div>
		
		<!--tab-->
     	<div class="ks-head-tab">
 			<ul class="clearfix">
		      	<li class="curr" onclick='switchChange(1,this)'>基本信息</li>
				<li onclick='switchChange(0,this)'>高级选项</li>
		    </ul>
     	</div>
     	<!--/tab-->	


		<div class='exam-add-content'>
			
				<form target="hidframe"  action=" <?php if(isset($paper)){ echo M_URL($this->AppName.'/Index','doEditPaper',$paperid,GP('p-'.$now_page));}else{
		echo M_URL($this->AppName.'/Index','doAddPaper','',GP(''));} ?>" method="post" id="myform">
					<div class="form-box">

							<div class="form-row add-form-show">
								
								<span class="form-star">*</span>
								<span class="name">试卷名称</span>
								<div class="form-limit" limit="60">
									<input type="text" name="Title" value="<?php if(isset($paper)) echo $paper['Title'] ;?>" class="form-textbox">
								</div>
								
							</div>
			        		
			        		<!-- <div class="add-form-show clearfix"><?php echo categotyCourse($value,$Linkage->Linkage(2)); ?></div> -->
			        		
<!--						   --><?php //if($setting[4]==1){ ?>
							<div class="form-row add-form-hide clearfix">
								
								<span class="form-star">*</span>
								<span class="name name-nowrap">试卷类型</span>
								<select  name="paperType" class="new-form">
					                  <?php if(isset($papertype))foreach($papertype as $k=>$v){?>
					                    <option value="<?php echo $v['id'] ?>" <?php if(isset($paper)){if($v['id']==$paper['paperType']) echo 'selected = "selected"';} ?>>
					                           <?php echo $v['typeName']?>
					                    </option>
					                    <?php } ?>
					            </select>
					           
							</div>
<!--							--><?php //} ?>
							<?php if($setting[5]==1){ ?>
							<div class="form-row add-form-hide">
								<span class="form-star">*</span>
								<span class="name name-nowrap">分数等级</span>
								<select  name="rankid"  class="new-form">
					               <?php if(isset($ScoreRank))foreach($ScoreRank as $k=>$v){?>
					                <option value="<?php echo $v['rankid'] ?>" <?php if(isset($paper)){if($v['rankid']==$paper['rankid']) echo 'selected = "selected"';} ?>>
					                       <?php echo $v['title']?>
					                </option>
					                <?php } ?>
					            </select>
					           
							</div>
					        <?php } ?>
					        
					        <div class="form-row clearfix mt15 add-form-show">

								<span class="form-star">*</span>
								<span class="name name-nowrap">考试时间</span>

								<input type="number" min="0" name="exam_time" value="<?php if(isset($paper)){echo $paper['exam_time'];}else{ echo '100';} ?>"  class="new-form">分钟
								
							</div>
					        
					        
					        <div class="add-form-show">
						        <div class="form-row clearfix">

									<span class="name name-nowrap">限制时间</span>
									
									<div class="form-switch" id="time-switch" open-value="1">
							            <label>
							                <input type="radio" name="ExamTimeLimit" value="1" <?php if(isset($paper) && $paper['ExamTimeLimit']==1) echo "checked"; ?>>是
							            </label>
							            <label>
							                <input type="radio" name="ExamTimeLimit" value="0" <?php if(!isset($paper) || $paper['ExamTimeLimit']!=1) echo "checked"; ?>> 否
							            </label>   
						            </div>
						            
								</div>
								
						
						        <div class="form-row clearfix" id="limit-time"<?php if(!isset($paper) || $paper['ExamTimeLimit']!=1) echo " style='display:none'"; ?>>
						        	<span class="name name-nowrap">时间限制</span>
						        	<div class="ks-head-tbox w300">
						        		
										<input type="text" id="selectTime" class="ks-head-input ks-head-time" value="<?php if(isset($paper)) echo date('Y/m/d H:i:s',$paper['ExamBeginTime']).' - ' ;?><?php if(isset($paper)) echo date('Y/m/d H:i:s',$paper['ExamEndTime']) ;?>" placeholder="自定义时间段"/>
										<span class="ks-head-ticon"><i class="iconfont icon-date"></i></span>
									</div>
									<input id="start" type="hidden" name="ExamBeginTime" value="<?php if(isset($paper)) echo date('Y/m/d H:i:s',$paper['ExamBeginTime']) ;?>">
									<input id="end" type="hidden" name="ExamEndTime" value="<?php if(isset($paper)) echo date('Y/m/d H:i:s',$paper['ExamEndTime']) ;?>">
	
								</div>
					        </div>
					        <div class="form-row add-form-hide clearfix" >
					        	
								<span class="form-star">*</span>
								<span class="name name-nowrap">难度</span>
								<select type="text" name="paper_level" class="new-form">
					                <option value="1" <?php if(isset($paper)){if($paper['paper_level']==1) echo 'selected = "selected"';} ?>>简单</option>
					                <option value="2" <?php if(isset($paper)){if($paper['paper_level']==2) echo 'selected = "selected"';} ?>>一般</option>
					                <option value="3" <?php if(isset($paper)){if($paper['paper_level']==3) echo 'selected = "selected"';} ?>>有点难</option>
					                <option value="4" <?php if(isset($paper)){if($paper['paper_level']==4) echo 'selected = "selected"';} ?>>难</option>
					                <option value="5" <?php if(isset($paper)){if($paper['paper_level']==5) echo 'selected = "selected"';} ?>>很难</option>
					            </select> 
					           
							</div>	
					    
					        	
					        <div class="form-row add-form-hide">
					        	<div class="form-lname">
									<span class="form-star">*</span>
									<span class="name">试卷介绍</span>
								</div>
								<div class="form-lcont">
									<?php echo $Intro; ?> 
								</div>
							</div>	
							<?php if($setting[7]==1){ ?>
							<div class="form-row add-form-hide" >
					        	<div class="clearfix"><a href="javascript:void(0)" onclick="addPaperKpoint('<?php echo M_URL($this->AppName.'/Index','addKpoint','',GP('')) ?>')" class="ks-bt bt-pur" id="addStudent"><i class="iconfont icon-jiahao"></i>课程标签/知识点</a></div>			
					               <div class="clearfix">
					               		<ul id="knowledge">
					               		<?php if(isset($kpoint))foreach($kpoint as $k=>$v){ ?>
					               	  	 <li id="kption<?php echo $v['id'] ?>" class="kpointO"><div class="ks-bt bt-def Porel"><?php echo $v['title'] ?><span class="Poabs ToPr1812" onclick="delKption(<?php echo $v['id'] ?>)"><i class="iconfont icon-quxiao"></i></span><input type="hidden"   name="kpoint[]" value="<?php echo $v['id'] ?>" /></div></li>
					               	
					               		<?php } ?>
					               	</ul >
					               </div>
							</div>	
							<?php  } ?>
								
								
							<!--<div class="form-low clearfix add-form-hide" >
								<div class="form-lname">
									<span class="form-star">*</span>
									<span class="name">试卷属性</span>
								</div>
								<div class="form-lcont">
									<label class="mt3">
										<input type="checkbox" class="fl mt5" name="setting2" value="1"  <?php if(isset($paper))if($setting2== 1)echo 'checked'; ?>>
										<span>允许保存答案</span>
									</label>
									
									<label class="mt3">
										<input type="radio" name="setting5" value="0" class="setting5" <?php if(isset($paper)){if($setting5 == 0)echo 'checked';}else{ echo 'checked';} ?>>练习模式
									</label>
									
									<label class="mt3">
										<input type="radio" name="setting5" value="1" class="setting5"  <?php if(isset($paper))if($setting5 == 1)echo 'checked'; ?>>考试模式
									</label>
								</div>	
							</div>-->
					
					        
					     <!--    <div class="form-row add-form-hide" id="setting6">
					        	<div class="form-lname">
									<span class="form-star">*</span>
									<span class="name">答卷次数</span>
								</div>
								<div class="form-lcont">
									<input type="number" name="AnswerNum" value="<?php if(isset($paper)) echo $paper['AnswerNum'] ;?>"  class="new-form">
								</div>
							</div> -->
					        
					        
					        <div class="form-row add-form-show" >
					        	<div class="form-lname">
									<span class="form-star">*</span>
									<span class="name">组卷方式</span>
								</div>
					        	<div class="form-lcont">
									<select type="text" name="exam_type" class="new-form" id="exam_type" onchange="TkType()">
						                
						                <option value="2" <?php if(isset($paper)){if($paper['exam_type']==2) echo 'selected = "selected"';} ?>>选题组卷</option>
						                <option value="1" <?php if(isset($paper)){if($paper['exam_type']==1) echo 'selected = "selected"';} ?>>随机组卷</option>
						            </select>
					            </div>
							</div>
					        <div class="form-row add-form-show" >
					        	<div class="form-lname">
									<span class="form-star">*</span>
									<span class="name">分数公布方式</span>
								</div>
					        	<div class="form-lcont">
									<select type="text" name="scoreout" class="new-form" id="scoreout" onchange="ChangeOut(this)">
						                
						                <option value="2" <?php if(isset($paper)){if($paper['scoreout']==2) echo 'selected = "selected"';} ?>>手动批卷</option>
						                <option value="1" <?php if(isset($paper)){if($paper['scoreout']==1) echo 'selected = "selected"';} ?>>自动批卷</option>
						            </select>
					            </div>
							</div>
							
					        <div class="form-row add-form-show" id="setting6">
					        	<div class="form-lname">
									<span class="form-star">*</span>
									<span class="name">题目设置</span>
								</div>
								<div class="form-lcont" id="random">
									<ul class="Tim-ul">
										<?php if(isset($paperid))foreach($tmty as $k=>$v){ ?>
											<?php $tkids = str_replace(",","|",$v['tkIds']); ?>
										<li class="tmty mt15">
											<div class="Tim-box clearfix">
												
												<select name="tkType[]" class="new-form fl tktype"  id="tktype-<?php echo $k+1; ?>"  onchange="changetktype(this)">
												<?php if($paper['scoreout']==2){?>
									                <option value="1" <?php if($v['tktype']==1) echo 'selected=selected'; ?>>单选题</option>
									                <option value="2" <?php if($v['tktype']==2) echo 'selected=selected'; ?>>填空题</option>
									                <option value="3" <?php if($v['tktype']==3) echo 'selected=selected'; ?>>判断题</option>
									                <option value="4" <?php if($v['tktype']==4) echo 'selected=selected'; ?>>问答题</option>
									                <option value="5" <?php if($v['tktype']==5) echo 'selected=selected'; ?>>材料题</option>
									                <option value="6" <?php if($v['tktype']==6) echo 'selected=selected'; ?>>多选题</option>  
									            <?php }else{?>
									            	<option value="1" <?php if($v['tktype']==1) echo 'selected=selected'; ?>>单选题</option>
									                <option value="3" <?php if($v['tktype']==3) echo 'selected=selected'; ?>>判断题</option>
									                <option value="6" <?php if($v['tktype']==6) echo 'selected=selected'; ?>>多选题</option>  
									            <?php }?>
									            </select>
												<div class="fl fsize14 ml10 test-count">题目数量：<input type="number" name="TkNum[]" class="new-form w80" id="tknum<?php echo $k+1; ?>" value="<?php echo $v['number'] ?>"/><span id="tk-<?php echo $k+1; ?>"></span></div> 
												<div class="fl fsize14 ml10">每题分值：<input type="number" name="TkScore[]" class="new-form w80" value="<?php echo $v['score'] ?>"/>分</div> 
												<button type="button" class='ks-bt bt-def ml10  select-test' href="javascript:void(0);" onclick="selectTk(<?php echo $k+1; ?>)">选择题目<span id="num<?php echo $k+1;  ?>"><?php echo "($v[number])" ?></span></button> 
												<input type="hidden" name="tmadd[]" id="tmty<?php echo $k+1; ?>" value="<?php echo $tkids ?>"  />   
												<?php  if($k !=0){ ?>
												  <!--  <input type="hidden" name="tmadd[]" id="tmty'+tmlength+'" />-->
												     <span class="ks-bt bt-def ml10"  onclick="deltmtype(this);">删除</span>                            
									    <?php   }  ?>
									    		</div>
											
										</li>
												
										<?php }else{ ?>	
										<li class="tmty mt15">
											<div class="Tim-box clearfix">
												
												<select name="tkType[]" class="new-form fl tktype"  id="tktype-1" onchange="changetktype(this)" >
									                <option value="1">单选题</option>
									                <option value="2">填空题</option>
									                <option value="3">判断题</option>
									                <option value="4">问答题</option>
									                <option value="5">材料题</option>
									                <option value="6">多选题</option>  
									            </select>
												<div class="fl fsize14 ml10  test-count">题目数量：<input class="new-form w80 " type="number" name="TkNum[]" id="tknum1"/><span id="tk-1"></span></div> 
												<div class="fl fsize14 ml10 ">每题分值：<input class="new-form w80 " type="number" name="TkScore[]"/> 分</div> 
												<button type="button" class='ks-bt bt-def ml10 select-test' href="javascript:void(0);"   onclick="selectTk(1)">选择题目<span id="num1"></span></button> 
												<input type="hidden" name="tmadd[]" id="tmty1" />
												<span class="ks-bt bt-def ml10" onclick="deltmtype(this);">删除</span>
											</div>
											
										</li>
										<?php } ?>
									</ul>
									 <div class="ks-bt bt-pur mt20 mb20" onclick="addtm()" style="float: none;"><i class="iconfont icon-jiahao"></i>添加题型</div>
								</div>
								
								
							</div>
							
                            <div class="form-title">商品信息</div>
							    <div class="form-row">
								<div class="form-lname">
									<span class="form-star">*</span>
									<span class="name">试卷价格</span>
								</div>
								<div class="form-gray">
									<div class="clearfix">
									    <label class="radioLabel fl">
											<input onclick="isFree(this)" type="radio" class="radioInput" value="1" name="chargetype" <?php if(isset($paper)){if($paper["chargetype"]==1)echo "checked"; }else{echo 'checked';}?>>收费
									    </label>
									 	<label class="radioLabel fl">
												<input onclick="isFree(this)" type="radio" class="radioInput" value="2" name="chargetype" <?php if(isset($paper)){if($paper["chargetype"]==2)echo "checked"; }?>>打赏
										</label>
									    <label class="radioLabel fl">
											<input onclick="isFree(this)" type="radio" class="radioInput" value="0" name="chargetype" <?php if(isset($paper)){if($paper["chargetype"]==0)echo "checked"; }?>>免费
									 	</label>
									</div>
									
									<div class="pricebox" id="pricebox">
										<div class="item">
											<span>商品价格</span><input type="text" name="price" class="form-textbox w180" placeholder="请输入价格" value="<?php if(isset($paper["price"]))echo $paper["price"];?>" ktj-price /> 元
										</div>
										<div class="item">
											<span>划线价格</span><input type="text" name="price_market" class="form-textbox w180" placeholder="请输入划线价格（选填）" value="<?php if(isset($paper["price_market"]))echo $paper["price_market"];?>" ktj-price/> 元
										</div>
									</div>
								</div>
							</div>
							<div class="form-title">上架设置</div>
							<div class="form-box" style="min-height: auto;">	
								<div class="form-row clearfix">
					                <span class="name name-nowrap">是否上架</span>
					               	<div class="form-switch" open-value="2">
					                    <label for="isshow0"><input type="radio" value="2" name="status" <?php if(isset($paper["Status"])){if($paper['Status']==2){echo 'checked="checked"';}}else{echo 'checked="checked"';}?> /></label>
					                    <label for="isshow1"><input type="radio" value="0" name="status" <?php if(isset($paper["Status"])&&($paper['Status']==0||$paper['Status']==1)){ echo 'checked="checked"';}?> /></label>
									</div>
					
					            </div>
							</div>
						</div>
					</form>
					    
	</div>
	
	<div class="form-footer">
		<span class="d-inline-block">
		<button type="button" onClick="do_reg()" class="ks-bt bt-pue">确认保存</button>
	    <button type="button" onclick="javascript:history.go(-1);" class="ks-bt bt-defalut">取消</button>
	    </span>
    </div>

	
</div>

<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
	module.require(['laydate','backstage','nicescroll','cookie'],function(){
		
		loadScorllJs();
		TkType();
		tkcount();
		$('#time-switch').on('click','.switch',function(){
			$(this).attr('data-flag')==1 ? $('#limit-time').show() : $('#limit-time').hide()
			
		});
		//日期时间范围
		laydate.render({
		  elem: '#selectTime',
		  format: 'yyyy/MM/dd HH:mm:ss',
		  type: 'datetime',
		  range:true
		})

	});
	var chargetype = $('input:radio[name="chargetype"]:checked').val();
		(chargetype == 0 || chargetype == 2) && $('#pricebox').hide();

	function isFree(el){
		document.getElementById('pricebox').style.display = el.value == 1 ? 'block' : 'none'
	}
	
    function  tkcount(){
    	 $(".tktype").each(function(){
           var tktype =$(this).attr('id').split('-');
           var num = tktype[1];
           selectNumTk($(this).val(),num);
     	})
    	
    };
     
    function changetktype(obj){
 	   var a = $(obj).val();
 	   var tktype =$(obj).attr('id').split('-');
       var num =tktype[1];
 	   selectNumTk(a,num)
    };
	
	function selectNumTk(tktype,num){
		var exam_type  =   $('#exam_type').val();

		exam_type == 1 && $("select[name='TkNum[]']").parent().hide();
		var categoryid = $("select[name='categoryid']").val();
	    var courseid   = $("select[name='courseid']").val();
	    var chapterid  = $("select[name='chapterid']").val();
	   
	    postData('<?php echo UOOT; ?>Plus/Kesion.ajax.php?act=getTknum',{
		   "courseid": courseid,
		   "wxid":<?php echo $this->wxid ?>,
		   "chapterid":chapterid,
		   "categoryid":categoryid,
		   "tktype":tktype
	   },function(data){
	    	 $('#tk-'+num).text(data)
	    })
					
	};
	
	
	function switchChange(state,target){
		state == 1 ? (
			$('.add-form-show').each(function(){
				$(this).css({"display":"block"});
			}),
			$('.add-form-hide').each(function(){
				$(this).css({"display":"none"});
			})
			
		) : (
			$('.add-form-show').each(function(){
				$(this).css({"display":"none"});
			}),
			$('.add-form-hide').each(function(){
				$(this).css({"display":"block"});
			})
		);
		target && $(target).addClass('curr').siblings().removeClass('curr');		
	};

	function TkType(){
		$('#exam_type').val() == 1 ? (
			$('.select-test').hide(),
			$('.test-count').show()
		) : (
			$('.select-test').show(),
			$('.test-count').hide()
		)
	};

	function addPaperKpoint(url){
		 var kpoint ='';
	     $(".kpointO").each(function(){
	        var a = $(this).find($("input")).val();
	        kpoint+=a+'|';
	     });
	    
	    if(kpoint != ''){
	    	kpoint =kpoint.substr(0,kpoint.length-1);
	    	
	    	 addTypeChange(url+',kpoint-'+kpoint,'800px','600px');
	    	 return false;
	    };
		$.cookie('addKption','',{ expires: -1 });
	    addTypeChange(url,'800px','600px')
	
	};	

	function delKption(id){
	   $("#kption"+id).remove();	
	};


	function do_reg(){
		var selectTime = document.getElementById('selectTime').value;
		selectTime && (
			document.getElementById('start').value = selectTime.split(' - ')[0],
			document.getElementById('end').value = selectTime.split(' - ')[1]
		);
	  	var Title  = $("input[name='Title']").val(); 
	  	var setting5 = $('input:radio[name="setting5"]:checked').val();
	  	var AnswerNum = $("input[name='AnswerNum']").val(); 
	    var exam_time = $("input[name='exam_time']").val(); 
	    var ExamScore = $("input[name='ExamScore']").val(); 
	  	var num =/^\d+(\.\d+)?$/;
		var number = /^\+?[1-9]\d*$/;
		var tkType = $('#exam_type option:selected').val();
	    if(tkType==1){
	    	var strinput = $("input[name='TkNum[]']")
	    	
	    }else{
	    	var strinput = $("input[name='tmadd[]']")
	    }
	  //   strinput.each(function(){
		 //       var $that = $(this)
		 //       if($(this).val()<=0||$(this).val()==''){
		 //       	 Alert('题目数量不能为空且必须大于0');
			//      return;
		 //       }
		 //    })
	  //   var scoreinput = $("input[name='TkScore[]']")
	  //   	scoreinput.each(function(){
		 //       var $that = $(this)
		 //       if($(this).val()<=0||$(this).val()==''){
		 //       	 Alert('分值不能为空且必须大于0');
			//      return;
		 //       }
		 //    })
	  	if(Title==''){
			 Alert('试卷名称不能为空');
			 return;	
	    };
	    if (Intro.getContent()==''){
	         Alert('试卷简介不能为空');
			 return;	
	    }
		$("#myform").submit()
	};
	
	function deltmtype(obj){
		$('.tmty').length == 1 ? Alert('请添加题目') : $(obj).parents('li').remove()
	};

	function addtm(){
		var tmlength =$('.tmty').length+1;
		var html='';
		html+='<li class="tmty mt15">';
		html+='<div class="Tim-box clearfix">';
	
		html+='<select name="tkType[]" class="new-form fl tktype"  id="tktype-'+tmlength+'"  onchange="changetktype(this)">';
		if($('#scoreout').val()==1){
            
    		html+='<option value="1">单选题</option>';
			html+='<option value="3">判断题</option>';
			html+='<option value="6">多选题</option>';
    	}else if($('#scoreout').val()==2){
    		html+='<option value="1">单选题</option>';
			html+='<option value="2">填空题</option>';
			html+='<option value="3">判断题</option>';
			html+='<option value="4">问答题</option>';
			html+='<option value="5">材料题</option>';
			html+='<option value="6">多选题</option>';
    	}
		html+='  </select>';
		html+='<div class="fl fsize14 ml10 test-count">题目数量：<input type="number" class="new-form w80" id="tknum'+tmlength+'" name="TkNum[]" class="Tim-num"/><span id="tk-'+tmlength+'"></span> </div> ';
		html+='<div class="fl fsize14 ml10 ">每题分值：<input type="number" class="new-form w80" name="TkScore[]" class="Tim-num"/> 分</div> ';
		html+='<button type="button" class="ks-bt bt-def ml10  select-test"  href="javascript:void(0);" onclick="selectTk('+tmlength+')">选择题目<span id="num'+tmlength+'"></span></button>';
		html+='<input type="hidden" name="tmadd[]" id="tmty'+tmlength+'" /> <span class="ks-bt bt-def ml10"  onclick="deltmtype(this);">删除</span>';
		html+='</div>';
		html+='</li>';  
		$('.Tim-ul').append(html);  
		TkType(); 
		
		 selectNumTk(1,tmlength);    
		$('input[name="TkNum[]"]').keyup(function(){
			var tmIndex = $(this).val();
			var tmNumber =$('#tk-'+tmlength).html();
			tmNumber =tmNumber.split("/");
			if(tmNumber[1]<tmIndex) {
				Alert('输入的题目数量不能大于限制题目数');
				$(this).html('27')

			}
		})                    
	}
	
	function selectTk(n){
		var tktype = $('#tktype-'+n ).val();
		
		$.cookie('selectTk', '', { expires: -1, path: '/' });
		
		var tklist = $('#tmty'+n).val();
		if(!tklist){
			tklist=0;
		}
		
		addTypeChange('<?php echo M_URL('Index','selectTk','',GP(''));?>,tmNum-'+n+',tklist-'+tklist+',tktype-'+tktype,'800px','600px',{title:'添加题目'});
	}
	
	top.DataCallBack = function(selectTk,tmNum){
		var Tk =selectTk.split("|");
		
		$('#tmty'+tmNum).val(selectTk);
		$('#num'+tmNum).text(Tk.length-1)
	}


    function ChangeOut(target){
    	console.log($(target).val())
    	var html=''
    	$(".tktype").find("option").remove();
    	if($(target).val()==1){
            
    		html+='<option value="1">单选题</option>';
			html+='<option value="3">判断题</option>';
			html+='<option value="6">多选题</option>';
    	}else if($(target).val()==2){
    		html+='<option value="1">单选题</option>';
			html+='<option value="2">填空题</option>';
			html+='<option value="3">判断题</option>';
			html+='<option value="4">问答题</option>';
			html+='<option value="5">材料题</option>';
			html+='<option value="6">多选题</option>';
    	}
    	$('.tktype').append(html) 
    }
	</script>
</body>
</html>
