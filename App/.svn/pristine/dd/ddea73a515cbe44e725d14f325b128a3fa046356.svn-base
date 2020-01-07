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
<link href="<?php echo UOOT;?>Public/common/css/laydate.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<!--<link href="Public/app/css/layer.css?<?php echoHash(); ?>" rel="stylesheet" />-->
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>

<style>
.courseList li{ position:relative; padding-left:229px;min-height:189px;padding-top:20px; padding-bottom:20px; padding-right:20px; border-bottom:1px solid #eee;}
.courseList li .tface{width:189px;height:189px; position:absolute;left:20px;top:20px; text-align:center;}
.teacherInfo{ padding-top:6px; padding-bottom:6px; margin-top:5px;}
.TcTab{ height:35px; border-bottom:1px solid #128fd1;}
.TcTab li{ padding:0 20px; line-height:35px; margin-left:20px; font-size:16px; cursor:pointer;}
.TcTab li.curr{ background:#128fd1; color:#fff;}
.cbtn{ float:left; width:60px; height:25px; line-height:25px; color:#1ab394; border:1px solid #1ab394; text-align:center; font-size:14px; border-radius:3px;}
.addcbtn{ float:left; width:60px; height:25px; line-height:25px; color:#fff;border:1px solid #1ab394; background:#1ab394; text-align:center; font-size:14px; border-radius:3px;}
.bg-1a{ background:#1ab394;}
.TcTabBox .courseList{ display:none;}
.hLh40 {line-height: 60px!important;}
.liveTab li a .iconfont {color: #929292}
.liveTab .curr a .iconfont {color: #333}
.required:before {
    content: ' *';
    color: red;
    font-size: 150%;
}
.laydate-icon {
border: 1px solid #ccc;
background-image: url(<?php echo UOOT;?>Public/admin/images/icon.png);
}
.inputText {height:37px;width:300px!important}
.w100p {width:200px!important} 
</style>
</head>

<body class="bg-gary">
<div class="row mt55">
      <div id="manage_top " class="menu_top_fixed height73 p15">
            <div class="ibox-title">
                <h3 class="fl" style="margin-top:10px">考试管理</h3>
               
                 <a class="btn btn-info btn-rounded btn-s-md " href="<?php echo M_URL($this->AppName.'/Index','index','',GP('')); ?>"
                 style="margin-left:15px">试卷管理</a>
                 <a class="btn btn-info btn-rounded btn-s-md "  href="<?php echo M_URL($this->AppName.'/Index','TkIndex','',GP('')); ?>" 
                 style="margin-left:15px">题库管理</a>
   
            </div>
        </div>
<div class="clear"></div>
<div class="tabs-container">
<ul class="nav nav-tabs">
    <li  class="active"><a href="<?php echo M_URL($this->AppName.'/Index','paperAdd','',GP('')); ?>">试卷添加</a></li>
    <li ><a href="<?php echo M_URL($this->AppName.'/Index','addTk','',GP('')); ?>">题库添加</a></li>	
 </ul>
<div class="bRadius10 bg-white editPerson">
<form target="hidframe" id="myform" action="<?php if(isset($paper)){ echo M_URL($this->AppName.'/Index','doEditPaper',$paperid,GP('p-'.$now_page));}else{
	echo M_URL($this->AppName.'/Index','doAddPaper','',GP('userid-'.$this->userid));} ?>" method="post">
    <table width="95%" cellpadding="0" cellspacing="0" border="0" class="gTable  mlr pt20">
        <tr>
            <td class="leftTd alignRight fsize16 c-79 w100p borderBda pr20 required">当前添加用户</td>
            <td class="leftTd alignLife fsize12 c-92 pr10 borderBda"><?php echo $this->userinfo['username'] ?> 
                <a onClick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','selectUser','',GP('addtype-1')) ?>','800px','600px')"> 更改 </a>
            </td>

        </tr>
        
        <tr>
            <td class="leftTd alignRight fsize16 c-79 w100p borderBda pr20 required">试卷名称</td>
            <td class="leftTd alignLife fsize12 c-92 pr10 borderBda"><input type="text" name="Title" 
            value="<?php if(isset($paper)) echo $paper['Title'] ;?>" class="inputText bRadius5 w300 pl30"></td>

        </tr>
        <tr>
            <td class="leftTd alignRight fsize16 c-79 w100p borderBda pr20 required">专业分类</td>

            <td class="leftTd alignLife fsize12 c-92 pr10 borderBda">
                <?php echo $Linkage->Linkage(2);?>
            </td>
        </tr>
        <tr>
            <td class="leftTd alignRight fsize16 c-79 w100p borderBda pr20 required">所属课程</td>
            <td class="leftTd alignLife fsize12 c-92 pr10 borderBda">
                <select name="courseid" class="inputText bRadius5 w300 pl30 fl" id="course" onChange="getChapter(this)">
                    <?php if(isset($course))foreach($course as $k=>$v){?>
                    <option value="<?php echo $v['courseid'] ?>" <?php if($v['courseid']==$paper['courseid']) echo 'selected = "selected"'; ?>>
                           <?php echo $v['title']?>
                    </option>
                    <?php } ?>
                </select>
                <div class="leftTd alignRight fsize16 c-79 w100p  pr20 required" style="display:table-cell;vertical-align: top;">所属章节</div>
            <div class="leftTd alignLife fsize12 c-92 pr10 " style="display:table-cell">
                <select name="chapterid" class="inputText bRadius5 w300 pl30 fl" id="chapter">
                     <?php if(isset($chapter))foreach($chapter as $k=>$v){?>
                    <option value="<?php echo $v['chapterid'] ?>" <?php if($v['chapterid']==$paper['chapterid']) echo 'selected = "selected"'; ?>>
                           <?php echo KS_INDENT($v['depth']).$v['title']?>
                    </option>
                    <?php } ?>
                </select>
            </div>
            </td>
        </tr>
        
        <tr>
            <td class="leftTd alignRight fsize16 c-79 w100p borderBda pr20 required">试卷类型</td>
            <td class="leftTd alignLife fsize12 c-92 pr10 borderBda">
            <select  name="paperType"  class="inputText bRadius5 w300 pl30">
                  <?php if(isset($papertype))foreach($papertype as $k=>$v){?>
                    <option value="<?php echo $v['id'] ?>" <?php if(isset($paper)){if($v['id']==$paper['paperType']) echo 'selected = "selected"';} ?>>
                           <?php echo $v['typeName']?>
                    </option>
                    <?php } ?>
            </select></td>
        </tr>
         <tr>
            <td class="leftTd alignRight fsize16 c-79 w100p borderBda pr20 required">分数等级</td>
            <td class="leftTd alignLife fsize12 c-92 pr10 borderBda">
            <select  name="rankid"  class="inputText bRadius5 w300 pl30">
                  <?php if(isset($ScoreRank))foreach($ScoreRank as $k=>$v){?>
                    <option value="<?php echo $v['rankid'] ?>" <?php if(isset($paper)){if($v['rankid']==$paper['rankid']) echo 'selected = "selected"';} ?>>
                           <?php echo $v['title']?>
                    </option>
                    <?php } ?>
            </select></td>
        </tr>
        <tr>
            <td class="leftTd alignRight fsize16 c-79 w100p borderBda pr20 required">考试时间</td>
            <td class="leftTd alignLife fsize12 c-92 pr10 borderBda"><input type="number" name="exam_time" 
            value="<?php if(isset($paper)) echo $paper['exam_time'] ;?>" class="inputText bRadius5 w300 pl30">分钟</td>
        </tr>
          <tr>
            <td class="leftTd alignRight fsize16 c-79 w100p borderBda pr20 required">是否限制时间</td>
            <td class="leftTd alignLife fsize12 c-92 pr10 borderBda pl30">
                <label class="radioLabel fl">
                    <input type="radio" name="ExamTimeLimit" class="radioInput test1"  data="1" value="1" 
					<?php if(isset($paper))if($paper['ExamTimeLimit']==1) echo "checked"; ?>>
                    <span class="radioName fsize14 c-92">是</span>
                </label>
                <label class="radioLabel fl">
                    <input type="radio" name="ExamTimeLimit" class="radioInput test1" data="0" value="0"
                     <?php if(isset($paper)){if($paper['ExamTimeLimit']==0)echo "checked";}else{echo "checked";} ?>>
                    <span class="radioName fsize14 c-92">否</span>
                </label>
            </td>
        </tr>
        
        <tr class="text2017" id="ExamBeginTime" a=" <?php if(isset($paper))echo $paper['ExamTimeLimit']; ?>">
            <td class="leftTd alignRight fsize16 c-79 w100p borderBda pr20">考试开始时间</td>
            <td class="leftTd alignLife fsize12 c-92 pr10 borderBda"> 
            <input id="start" class="laydate-icon inputText bRadius5 w300 pl30" required name="ExamBeginTime"  readonly aria-required="true" value="<?php if(isset($paper)) echo date('Y/m/d H:i:s',$paper['ExamBeginTime']) ;?>">
            <span class="undone  ml20 fsize12" >未填的话则不限制时间</span></td>
        </tr>
        <tr class="text2017 " id="ExamEndTime">
            <td class="leftTd alignRight fsize16 c-79 w100p borderBda pr20">考试结束时间</td>
            <td class="leftTd alignLife fsize12 c-92 pr10 borderBda"> <input id="end" class="laydate-icon inputText bRadius5 w300 pl30" required name="ExamEndTime"  readonly aria-required="true" value="<?php if(isset($paper)) echo date('Y/m/d H:i:s',$paper['ExamEndTime']) ;?>"><span class="undone  ml20 fsize12" >未填的话则不限制时间</span></td>
        </tr>
        <tr>
            <td class="leftTd alignRight fsize16 c-79 w100p borderBda pr20 required" >总分</td>
            <td class="leftTd alignLife fsize12 c-92 pr10 borderBda">
            <input type="text" name="ExamScore" value="<?php if(isset($paper)) echo $paper['ExamScore'] ;?>" class="inputText bRadius5 w300 pl30"></td>
        </tr>
        <tr>
            <td class="leftTd alignRight fsize16 c-79 w100p borderBda pr20 required">难度</td>
            <td class="leftTd alignLife fsize12 c-92 pr10 borderBda">
            <select type="text" name="paper_level" class="inputText bRadius5 w300 pl30">
                <option value="1" <?php if(isset($paper)){if($paper['paper_level']==1) echo 'selected = "selected"';} ?>>简单</option>
                <option value="2" <?php if(isset($paper)){if($paper['paper_level']==2) echo 'selected = "selected"';} ?>>一般</option>
                <option value="3" <?php if(isset($paper)){if($paper['paper_level']==3) echo 'selected = "selected"';} ?>>困难</option>
            </select></td>
        </tr>
        <tr>
            <td class="leftTd alignRight fsize16 c-79 w100p borderBda pr20 required">答卷次数</td>
            <td class="leftTd alignLife fsize12 c-92 pr10 borderBda">
            <input type="number" name="AnswerNum" value="<?php if(isset($paper)) echo $paper['AnswerNum'] ;?>" class="inputText bRadius5 w300 pl30"></td>
        </tr>
        <tr>
            <td class="leftTd alignRight fsize16 c-79 w100p borderBda pr20">试卷介绍</td>
            <td class="rightTd alignLife">
                <?php echo $Intro; ?> 
            </td>
        </tr>
        <tr>
            <td class="leftTd alignRight fsize16 c-79 w100p borderBda pr20">组卷类型</td>
            <td class="leftTd alignLife fsize12 c-92 pr10 borderBda">
            <select type="text" name="exam_type" class="inputText bRadius5 w300 pl30">
                <option value="1" <?php if(isset($paper)){if($paper['exam_type']==1) echo 'selected = "selected"';} ?>>随机组卷</option>
                <option value="2" <?php if(isset($paper)){if($paper['exam_type']==2) echo 'selected = "selected"';} ?>>按提添加</option>
            </select></td>
        </tr>
        <tr>
            <td class="leftTd alignRight fsize16 c-79 w100p borderBda pr20">审核状态</td>

            <td class="leftTd alignLife fsize12 c-92 pr10 borderBda pl30">
                <label class="radioLabel fl">
                    <input type="radio" name="status" class="radioInput" <?php if(isset($paper))if($paper['Status']==0) echo "checked" ?> >
                    <span class="radioName fsize14 c-92">待审核</span>
                </label>
                <label class="radioLabel fl">
                    <input type="radio" name="status" class="radioInput" <?php if(isset($paper)){if($paper['Status']==1)echo "checked";}else{echo "checked";}?>>
                    <span class="radioName fsize14 c-92">已审核</span>
                </label>
            </td>
        </tr>
        <tr>
            <td class="leftTd alignRight fsize16 c-79 w100p pr20"></td>
            <td class="leftTd alignLife fsize12 c-92 pr10"><input type="button" onClick="do_reg();" class="generalBtn c-fff fsize16 bRadius5" value="保存" name="save"></td>
        </tr>
    </table>
    </form>
</div>
</div>
</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js" ></script>
<script>
starttime('#start');//开始时间
endtime('#end');//结束时间
loadScorllJs();//滚轮
var selectInputs = $('.verAlignMiddle');
var checkAllInputs = $('.check-all')
selectall(selectInputs,checkAllInputs);
$(function(){
	//短信不启用隐藏信息
	$(".test1").click(function(){
		var a =$(this).val();
		if(a == 0){
			$(".text2017").hide();
		}else{
			$(".text2017").show();
		}
	});
});
$(function(){
	//短信不启用隐藏信息
	var a = $(".text2017").attr('a');
	if(a == 0){
		$(".text2017").hide();
	}else{
		$(".text2017").show();
	}
});

/*var start = {
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
laydate(end);*/
</script>

<script>

  /*$(function(){
        $(".radioInput").click(function(){
            var data = $(this).attr('data');
			console.log(data)
          if(data==1){
              $('.text2017').show();
          }
            else {
              $('.text2017').hide();
          }
        })
    })
*/


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
</script>
<!--<script src="Public/app/js/layer.js" type="text/javascript"></script>-->
<script>
    //添加课时
function selectUser(url){	

layer.open({
        type: 2,
        area: ['850px', '600px'],
        fixed: false, //不固定
        maxmin: true,
		 title: ['选择用户', 'font-size:18px;'],
        content:url
    });
};

</script>
<script>
function do_reg()
{
	var title = $("input[name='Title']").val();
	var courseid = $("select[name='courseid']").val();
	var exam_time = $("input[name='exam_time']").val();
	var paperType = $("select[name='paperType']").val();
	var rankid = $("select[name='rankid']").val();
	var ExamScore = $("input[name='ExamScore']").val();
	var AnswerNum = $("input[name='AnswerNum']").val();
	/*数字验证*/
	var num =/^[0-9]*$/;
	
    if(title==''){
		Alert('试卷题目');
		return false;	
    }
	if(!courseid){
		Alert('请选着课程');
		return false;	
    }
    if(exam_time==''){
		Alert('请填写考试时间');
		return false;
	}
	if(!paperType){
		Alert('请选择试卷类型');
		return false;
	}
	if(!rankid){
		Alert('请选择分数等级');
		return false;
	}
	 if(ExamScore==''){
		Alert('请填写试卷总分');
		return false;
	}
	if(!num.test(ExamScore)){
	    Alert('分数请输入数字');
		return false;
	}
	if(AnswerNum==''){
		Alert('答题总分');
		return false;
	}
	if(!num.test(AnswerNum)){
	    Alert('答题次数必须为数字');
		return false;
	}
	$("#myform").submit();	
}
</script>

</body>
</html>
