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
<link href="<?php echo UOOT;?>Public/app/css/live.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/main.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<style>
.courseList li{ position:relative; padding-left:229px;min-height:189px;padding-top:20px; padding-bottom:20px; padding-right:20px; border-bottom:1px solid #eee;}
.courseList li .tface{width:189px;height:189px; position:absolute;left:20px;top:20px; text-align:center;}
.TcTab li{ padding:0 20px; line-height:35px; margin-left:20px; font-size:16px; cursor:pointer;}
.TcTab li.curr{ background:#128fd1; color:#fff;}
.TcTabBox .courseList{ display:none;}
.liveTab li a .iconfont {color: #929292}
.liveTab .curr a .iconfont {color: #333}
.generalBeen {
	display: inline-block;
	padding: 0 20px;
	height: 34px;
	line-height: 34px;
	text-align: center;
	background-color: limegreen;
	border: none;
}
</style>
</head>

<body class="bg-gary">
<div class="clear">
       
</div>
<div class=" contentBox bRadius10 bg-white editPerson" style="padding: 20px">
<form action="<?php echo M_URL($this->AppName.'/Index','doCorrection',$id,GP('')); ?>" method="post">
<input type="text" value=""  name="score">总分
<input type="submit" value="提交">
</form>
    <?php echo $result[0] ?> 
</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
var selectInputs = document.getElementsByClassName('verAlignMiddle'); // 所有勾选框
    var checkAllInputs = document.getElementsByClassName('check-all') // 全选框

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
<script>
$(function(){
	
	    var answer = $("#answer").val();
	    var analy = $("#analy").val();
		var tmtypes = answer.split('↓◎↑');
		for(var i= 0;i<tmtypes.length-1;i++){
			var tmtype = tmtypes[i].split('↓↑');
			var tks = tmtype[1].split('§№§');
		     for(var k =0; k<tks.length-1;k++){
				var tk = tks[k].split('〓');
				var names =i+'#'+tk[0];
				var tktype =$("[name="+names+"]").parents('.tktype').val();
				switch (parseInt(tktype)){
				    
					case 1://选择题
					
					case 3://判断题
					     if(tk[1]!=''){ 
					        $("input[name="+names+"][value="+tk[1]+"]").attr("checked",true);
							$('.'+tmtype[0]+'a'+tk[0]).find("a").addClass('hasBeenAnswer');  
						 }
					   break;
					case 2://填空题
					   var arr = tk[1].split('※');
					   $('.'+tmtype[0]+'a'+tk[0]).find("a").addClass('hasBeenAnswer');  
					   $("input[name^="+names+"]").each(function(i){
						   if(arr[i]==''){
							   $('.'+tmtype[0]+'a'+tk[0]).find("a").removeClass('hasBeenAnswer');
							}
				           $(this).val(arr[i]);
                       });
					   break;
					case 4: //问答题
					        if(tk[1]!=''){ 
					           $("[name="+names+"]").text(tk[1]);
							   $('.'+tmtype[0]+'a'+tk[0]).find("a").addClass('hasBeenAnswer');    
							}
					   break;		
				}
			  }
		   }   		

	$('.radioOrCheck').attr('disabled','disabled');
	$('.fc-hei').attr('disabled','disabled');
	//插入解析
	
	 var analy = JSON.parse('{KS:$analy}');

	for(var i= 0;i<analy.length;i++){
		var html ='';
		  if(analy[i]['tktype'] ==2 || analy[i]['tktype'] ==1 || analy[i]['tktype'] ==3 || analy[i]['tktype'] ==6){
				analy[i]['answer1'] = analy[i]['answer1'].split("※");
				analy[i]['answer1'] = analy[i]['answer1'].join(",  ")
			if(analy[i]['correct']){
				html='<div class="tktrue">您的答案是:'+analy[i]['answer1']+',-----标准答案:'+analy[i]['answer']+',本题：'+analy[i]['tkscore']+'分，您得分：'+analy[i]['score']+'</div>';	
			}else{
				html='<div class="tkflase">您的答案是:'+analy[i]['answer1']+',-----标准答案:'+analy[i]['answer']+',本题：'+analy[i]['tkscore']+'分，您得分：'+analy[i]['score']+'</div>';
			}
		  }else{
			    html='<div class="subjective">本题为主观题，本题分数'+analy[i]['tkscore']+'</div>';
		  }
		    $('#qu_'+analy[i]['tmtypeid']+'_'+analy[i]['tkid']).after(html);
	}
	
});
</script>