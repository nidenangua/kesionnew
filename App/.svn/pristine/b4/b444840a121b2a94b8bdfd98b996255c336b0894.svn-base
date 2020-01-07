<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="renderer" content="webkit">
    <title>kesion教育平台</title>
    <meta name="Keywords" content="kesion教育平台"/>
    <meta name="Description" content="kesion教育平台" />
    <link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
    <link href="<?php echo UOOT;?>Public/app/css/main.css?<?php echoHash(); ?>" rel="stylesheet" />
    <link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
    <link href="<?php echo UOOT;?>Public/app/css/laydate.css" rel="stylesheet">
    <link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
    <script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
     <script type="text/javascript" src="<?php echo UOOT;?>Public/common/js/layer/laydate.js"></script>
    <style>
      
    </style>
</head>

<body class="ks-wrap">
	
<div class="bRadius10  ks-wbox">
	<div id="ksBoxHead">
	<!--开始-->
	<div class="generalTitle clearfix">
	    <span class="title-icon"><i class="iconfont icon-myorder"></i></span>
        <span class="gTitle fsize18">试卷添加</span>
	</div>
	
	

	</div>

<div style="position: relative; padding-bottom: 60px;">
<div class=" contentBox bRadius5 editPerson" >
	
<form target="hidframe"  action=" <?php if(isset($paper)){ echo M_URL($this->AppName.'/Index','doEditPaper',$paperid,GP('p-'.$now_page));}else{
	echo M_URL($this->AppName.'/Index','doAddPaper','',GP(''));} ?>" method="post" id="myform">
	


<div id="ksBoxContent">
	
    <div style="padding: 20px;">
		<div class="form-low">
			<div class="form-lname">
				<span class="form-star">*</span>
				<span class="name">试卷名称</span>
			</div>
			<div class="form-lcont">
				<div class="form-limit" limit=60>
					<input type="text" name="Title" value="<?php if(isset($paper)) echo $paper['Title'] ;?>" class="form-textbox">
				</div>
			</div>
		</div>
		
      
	 
		<div class="form-low">
			<div class="form-lname">
				<span class="form-star">*</span>
				<span class="name">试卷类型</span>
			</div>
			<div class="form-lcont">
				<select  name="paperType"  class="new-form">
	                  <?php if(isset($papertype))foreach($papertype as $k=>$v){?>
	                    <option value="<?php echo $v['id'] ?>" <?php if(isset($paper)){if($v['id']==$paper['paperType']) echo 'selected = "selected"';} ?>>
	                           <?php echo $v['typeName']?>
	                    </option>
	                    <?php } ?>
	            </select>
            </div>
		</div>
	
		<div class="form-low">
			<div class="form-lname">
				<span class="form-star">*</span>
				<span class="name">分数等级</span>
			</div>
			<div class="form-lcont">
				<select  name="paperType"  class="new-form">
	               <?php if(isset($ScoreRank))foreach($ScoreRank as $k=>$v){?>
	                <option value="<?php echo $v['rankid'] ?>" <?php if(isset($paper)){if($v['rankid']==$paper['rankid']) echo 'selected = "selected"';} ?>>
	                       <?php echo $v['title']?>
	                </option>
	                <?php } ?>
	            </select>
            </div>
		</div>
 
       <!-- <div>
           <div>是否收费</div>
            <div class="leftTd alignLife fsize12 c-92 pr10 borderBda">
                <input type="checkbox" name="isfree" id="isfree" value="1">
            </div>
        <div>
        <tr id="money">
            <div>价格</div>
            <div class="leftTd alignLife fsize12 c-92 pr10 borderBda">
                <input type="text" name="money" value="<?php if(isset($paper)) ?>">
            </div>
        <div>-->
        
        <div class="form-low">
			<div class="form-lname">
				<span class="form-star">*</span>
				<span class="name">考试时间</span>
			</div>
			<div class="form-lcont">
				<input type="number" min="0" name="exam_time" value="<?php if(isset($paper)) echo $paper['exam_time'] ;?>"  class="new-form">分钟
			</div>
		</div>
        
        
        <div class="form-low clearfix">
        	<div class="form-lname">
				<span class="form-star">*</span>
				<span class="name">限制时间</span>
			</div>
			<div class="form-lcont">
				<div class="form-switch" open-value="1">
		            <label>
		                <input type="radio" name="ExamTimeLimit" class="test1"  data="1" value="1" <?php if(isset($paper))if($paper['ExamTimeLimit']==1) echo "checked"; ?>>是
		            </label>
		            <label>
		                <input type="radio" name="ExamTimeLimit" class="test1" data="0" value="0" <?php if(isset($paper)){if($paper['ExamTimeLimit']==0)echo "checked";}else{echo "checked";} ?>> 否
		            </label>   
	            </div>
            </div>
		</div>
		

        
        
        
        <div class="form-low">
	        <div class="form-low text2017" id="ExamBeginTime" a=" <?php if(isset($paper))echo $paper['ExamTimeLimit']; ?>"  style="display: none;">
	        	<div class="form-lname">
					<span class="name">开始时间</span>
				</div>
				<div class="form-lcont">	
					<input id="start" class="w200  laydate-icon"  name="ExamBeginTime"    readonly aria-required="true" value="<?php if(isset($paper)) echo date('Y/m/d H:i:s',$paper['ExamBeginTime']) ;?>">
		            <span class="undone  ml20 fsize12" >未填的话则不限制时间</span>
	            </div>
			</div>
			
			<div class="form-low text2017" id="ExamEndTime"  style="display: none;">
				<div class="form-lname">
					<span class="name">结束时间</span>
				</div>
				<div class="form-lcont">
					<input id="end" class="w200  laydate-icon" required name="ExamEndTime"  readonly aria-required="true" value="<?php if(isset($paper)) echo date('Y/m/d H:i:s',$paper['ExamEndTime']) ;?>">
					<span class="undone  ml20 fsize12" >未填的话则不限制时间</span>         
				</div>   
			</div>
		</div>
        	
        <div class="form-low">
        	<div class="form-lname">
				<span class="form-star">*</span>
				<span class="name">总分</span>
			</div>
			<div class="form-lcont">
				<input type="text" name="ExamScore" value="<?php if(isset($paper)) echo $paper['ExamScore'] ;?>" class="new-form">  
			</div>   
		</div>
		
			
        <div class="form-low" >
        	<div class="form-lname">
				<span class="form-star">*</span>
				<span class="name">难度</span>
			</div>
			<div class="form-lcont">
				<select type="text" name="paper_level" class="new-form">
	                <option value="1" <?php if(isset($paper)){if($paper['paper_level']==1) echo 'selected = "selected"';} ?>>简单</option>
	                <option value="2" <?php if(isset($paper)){if($paper['paper_level']==2) echo 'selected = "selected"';} ?>>一般</option>
	                <option value="3" <?php if(isset($paper)){if($paper['paper_level']==3) echo 'selected = "selected"';} ?>>困难</option>
	            </select> 
            </div>
		</div>	
    
        	
        <div class="form-low" >
        	<div class="form-lname">
				<span class="form-star">*</span>
				<span class="name">试卷介绍</span>
			</div>
			<div class="form-lcont">
				<?php echo $Intro; ?> 
			</div>
		</div>	
			
			
		<div class="form-low clearfix" >
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
		</div>

		<!--<div class="form-low">
			<span class="name">考试次数</span>
			<input type="number" name="setting6" min="0"  class="new-form"  value="<?php if(isset($paper))echo 'setting5' ?>">
		</div>-->
        
        
        <div class="form-low" id="setting6">
        	<div class="form-lname">
				<span class="form-star">*</span>
				<span class="name">答卷次数</span>
			</div>
			<div class="form-lcont">
				<input type="number" name="AnswerNum" value="<?php if(isset($paper)) echo $paper['AnswerNum'] ;?>"  class="new-form">
			</div>
		</div>
        
        
        <div class="form-low" ">
        	<div class="form-lcont">
				<select type="text" name="exam_type" class="new-form">
	                <option value="1" <?php if(isset($paper)){if($paper['paper_level']==1) echo 'selected = "selected"';} ?>>随机组卷</option>
	                <option value="2" <?php if(isset($paper)){if($paper['paper_level']==2) echo 'selected = "selected"';} ?>>按提添加</option>
	            </select>
            </div>
		</div>
        
       
        <!--<div class="form-low clearfix">
        	<span class="form-star">*</span>
			<span class="name">审核状态</span>
			<div class="form-switch" open-value="1">
				<label class="radioLabel fl">
                	<input type="radio" name="status" class="radioInput" <?php if(isset($paper))if($paper['Status']==0) echo "checked" ?> >
                	<span class="radioName fsize14 c-92">待审核</span>
	            </label>
	            <label class="radioLabel fl">
	                <input type="radio" name="status" class="radioInput" <?php if(isset($paper)){if($paper['Status']==1)echo "checked";}else{echo "checked";}?>>
	                <span class="radioName fsize14 c-92">已审核</span>
	            </label>	
			</div>
		</div>-->
		<style>
			.Tim-ul{}
			.Tim-ul li{ }
			.Tim-box{font-size: 15px;}
			.Tim-em{ float: left; width: 200px;line-height: 35px;} 
			.Tim-hem{ float: left; width: 150px;line-height: 35px;} 
			.Tim-hem i{font-size: 18px;font-weight: 900;} 
			.Tim-num{ width: 50px; height: 30px;border: 1px solid #E5E5E5;border-radius: 5px;}
		</style>
		
        <div class="form-low" id="setting6">
        	<div class="form-lname">
				<span class="form-star">*</span>
				<span class="name">题目设置</span>
			</div>
			<div class="form-lcont">
				<ul class="Tim-ul">
					<li>
						<div class="Tim-box clearfix">
							<div class="Tim-hem"><i class="iconfont icon-yidong mr20"></i>单选题</div>
							<div class="Tim-em">题目数量：<input type="number" name="Tnum[]" class="Tim-num"/> / 0</div> 
							<div class="Tim-em">题目分值：<input type="number" name="Tpec[]" class="Tim-num"/> / 0</div> 
							<div class="Tim-em">漏选分值：<input type="number" name="Tlose[]" class="Tim-num"/> / 0</div> 
						</div>
					</li>
					
					<li>
						<div class="Tim-box clearfix">
							<div class="Tim-hem"><i class="iconfont icon-yidong mr20"></i>多选题</div>
							<div class="Tim-em">题目数量：<input type="number" name="Tnum[]" class="Tim-num"/> / 0</div> 
							<div class="Tim-em">题目分值：<input type="number" name="Tpec[]" class="Tim-num"/> / 0</div> 
							<div class="Tim-em">漏选分值：<input type="number" name="Tlose[]" class="Tim-num"/> / 0</div> 
						</div>
					</li>
					
					<li>
						<div class="Tim-box clearfix">
							<div class="Tim-hem"><i class="iconfont icon-yidong mr20"></i>问答题</div>
							<div class="Tim-em">题目数量：<input type="number" name="Tnum[]" class="Tim-num"/> / 0</div> 
							<div class="Tim-em">题目分值：<input type="number" name="Tpec[]" class="Tim-num"/> / 0</div> 
							<div class="Tim-em">漏选分值：<input type="number" name="Tlose[]" class="Tim-num"/> / 0</div> 
						</div>
					</li>
					
					<li>
						<div class="Tim-box clearfix">
							<div class="Tim-hem"><i class="iconfont icon-yidong mr20"></i>不定项选择题</div>
							<div class="Tim-em">题目数量：<input type="number" name="Tnum[]" class="Tim-num"/> / 0</div> 
							<div class="Tim-em">题目分值：<input type="number" name="Tpec[]" class="Tim-num"/> / 0</div> 
							<div class="Tim-em">漏选分值：<input type="number" name="Tlose[]" class="Tim-num"/> / 0</div> 
						</div>
					</li>
					
					<li>
						<div class="Tim-box clearfix">
							<div class="Tim-hem"><i class="iconfont icon-yidong mr20"></i>判断题</div>
							<div class="Tim-em">题目数量：<input type="number" name="Tnum[]" class="Tim-num"/> / 0</div> 
							<div class="Tim-em">题目分值：<input type="number" name="Tpec[]" class="Tim-num"/> / 0</div> 
							<div class="Tim-em">漏选分值：<input type="number" name="Tlose[]" class="Tim-num"/> / 0</div> 
						</div>
					</li>
					
					<li>
						<div class="Tim-box clearfix">
							<div class="Tim-hem"><i class="iconfont icon-yidong mr20"></i>填空题</div>
							<div class="Tim-em">题目数量：<input type="number" name="Tnum[]" class="Tim-num"/> / 0</div> 
							<div class="Tim-em">题目分值：<input type="number" name="Tpec[]" class="Tim-num"/> / 0</div> 
							<div class="Tim-em">漏选分值：<input type="number" name="Tlose[]" class="Tim-num"/> / 0</div> 
						</div>
					</li>
					
					<li>
						<div class="Tim-box clearfix">
							<div class="Tim-hem"><i class="iconfont icon-yidong mr20"></i>材料题</div>
							<div class="Tim-em">题目数量：<input type="number" name="Tnum[]" class="Tim-num"/> / 0</div> 
							<div class="Tim-em">题目分值：<input type="number" name="Tpec[]" class="Tim-num"/> / 0</div> 
							<div class="Tim-em">漏选分值：<input type="number" name="Tlose[]" class="Tim-num"/> / 0</div> 
						</div>
					</li>
				</ul>
			</div>
		</div>
      
        
       
    </div>
    </div>
    </form>
    
</div>
	<div id="ksBoxFooter" style="position: absolute; bottom: 0px;left: 0px;">
       <input type="button" onClick="do_reg()"  class="ks-bt bt-pue mr10" value="&nbsp;&nbsp;保&nbsp; 存 &nbsp;" name="save">
       	<a href="javascript:history.go(-1);" class="ks-bt bt-def">取消返回</a>
    </div>
</div>
</div>
<script type="text/javascript" src="<?php echo UOOT;?>Public/common/js/layer/laydate.js"></script>
<script src="<?php echo UOOT;?>Public/common/js/nicescroll.js"></script>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
var start = {
  elem: '#start',
  format: 'YYYY/MM/DD hh:mm:ss',
  min: laydate.now(), //设定最小日期为当前日期
  max: '2099-06-16 23:59:59', //最大日期
  istime: true,
  istoday: false,
  choose: function(datas){
     end.min = datas; //开始日选好后，重置结束日的最小日期
     end.start = datas //将结束日的初始值设定为开始日
  }
};
var end = {
  elem: '#end',
  format: 'YYYY/MM/DD hh:mm:ss',
  min: laydate.now(),
  max: '2099-06-16 23:59:59',
  istime: true,
  istoday: false,
 
};
laydate(start);
laydate(end);
</script>
<script>

function do_reg(){
  	var Title  = $("input[name='Title']").val(); 
  	var  setting5 = $('input:radio[name="setting5"]:checked').val();
  	var AnswerNum = $("input[name='AnswerNum']").val(); 
    var exam_time = $("input[name='exam_time']").val(); 
    var ExamScore = $("input[name='ExamScore']").val(); 
  	var num =/^\d+(\.\d+)?$/;
	var number = /^\+?[1-9]\d*$/;
  	if(!Title){
		Alert('试卷名称不能为空');
		return false;	
    }
  	
  	if(!number.test(exam_time)){
  		   alert(exam_time);
		     Alert('考试时间要大于零');
		     return false;
	}
	
	if(!number.test(ExamScore)){
		     Alert('总分要大于零');
		     return false;
	}
    
	

	
	
	
	
	
	if(setting5 == 1){
  		if(!number.test(AnswerNum)){
		     Alert('答题次数大于零');
		     return false;
		}
  	}
	
	$("#myform").submit(); 
   	
}

$(function(){
	//短信不启用隐藏信息
	$(".test1").click(function(){
		var a =$(this).val();
		if(a == 0){
			$(".text2017").slideUp();
		}else{
			$(".text2017").slideDown();
		}

	});
	//是否是考试模式
	$(".setting5").click(function(){
       if( $(this).val()==0 ){
		  $("#setting6").hide();   
		}else{
		  $("#setting6").show(); 	
		}
   });
	var examnum = $('input[name="setting5"]:checked').val();
	 if( examnum ==0 ){
		  $("#setting6").hide();   
		}else{
		  $("#setting6").show(); 	
		}
    //是否收费
	var val = $("#isfree").is(':checked');
	if(!val){
		$('#money').hide();
	}
	$("#isfree").click(function(){
        var val = $("#isfree").is(':checked');
		
		if(!val){
			$('#money').hide();
		}else{
		   $('#money').show();
		}
    });
 });
 
 
$(function(){
	//短信不启用隐藏信息
	var a = $(".text2017").attr('a');
	if(a == 0){
		$(".text2017").slideUp();
	}else{
		$(".text2017").slideDown();
	}
});

function local(obj){
 	var a =$(obj).val();
	var url = '<?php echo UOOT;?>Plus/Kesion.ajax.php?act=getCourse';
	$.ajax({
	   type : "post",
	   url : url,
	   data:{
		   "categoryid": a,
		   "userid":<?php echo $this->userid; ?>
	   },
	   success:function(data){
		    $('#course').empty();
			$('#chapter').empty();
		    $('#course').html(data);
		}
	});	
}

function getChapter(obj){
 	var a =$(obj).val();
	var url = '<?php echo UOOT;?>Plus/Kesion.ajax.php?act=getChapter';
	$.ajax({
	   type : "post",
	   url : url,
	   data:{
		   "courseid": a,
		   "userid":<?php echo $this->userid; ?>
	   },
	   success:function(data){
		    $('#chapter').empty();
		    $('#chapter').html(data);
		}
	
	});
}

var selectInputs = $('.verAlignMiddle'); // 所有勾选框
    var checkAllInputs = $('.check-all') // 全选框

    for(var i = 0; i < selectInputs.length; i++ ){
        selectInputs[i].onclick = function () {
            if (this.className.indexOf('check-all') >= 0) { //如果是全选，则吧所有的选择框选中
                for (var j = 0; j < selectInputs.length; j++) {
                    selectInputs[j].checked = this.checked;
                }
            }
            if (!this.checked) { //只要有一个未勾选，则取消全选框的选中状态
                for (var i = 0; i < checkAllInputs.length; i++) {
                    checkAllInputs[i].checked = false;
                }
            }
        }
    }
</script>
</body>
</html>
