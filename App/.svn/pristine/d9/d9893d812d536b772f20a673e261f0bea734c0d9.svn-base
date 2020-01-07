<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>kesion教育平台</title>
<meta name="Keywords" content="kesion教育平台"/>
<meta name="Description" content="kesion教育平台"/>
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/live.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/main.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<!--<link href="Public/app/css/layer.css?<?php echoHash(); ?>" rel="stylesheet" />-->
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>

<style>
.courseList li {
    position: relative;
    padding-left: 229px;
    min-height: 189px;
    padding-top: 20px;
    padding-bottom: 20px;
    padding-right: 20px;
    border-bottom: 1px solid #eee;
}

.courseList li .tface {
    width: 189px;
    height: 189px;
    position: absolute;
    left: 20px;
    top: 20px;
    text-align: center;
}

.teacherInfo {
    padding-top: 6px;
    padding-bottom: 6px;
    margin-top: 5px;
}

.TcTab {
    height: 35px;
    border-bottom: 1px solid #128fd1;
}

.TcTab li {
    padding: 0 20px;
    line-height: 35px;
    margin-left: 20px;
    font-size: 16px;
    cursor: pointer;
}

.TcTab li.curr {
    background: #128fd1;
    color: #fff;
}

.cbtn {
    float: left;
    width: 60px;
    height: 25px;
    line-height: 25px;
    color: #1ab394;
    border: 1px solid #1ab394;
    text-align: center;
    font-size: 14px;
    border-radius: 3px;
}

.addcbtn {
    float: left;
    width: 60px;
    height: 25px;
    line-height: 25px;
    color: #fff;
    border: 1px solid #1ab394;
    background: #1ab394;
    text-align: center;
    font-size: 14px;
    border-radius: 3px;
}

.bg-1a {
    background: #1ab394;
}

.TcTabBox .courseList {
    display: none;
}

.hLh40 {
    line-height: 60px !important;
}

.liveTab li a .iconfont {
    color: #929292
}

.liveTab .curr a .iconfont {
    color: #333
}

.btn-default {
    padding: 2px 8px;
    background-color: #fff;
    border-radius: 5px;
    border: 1px solid #999
}

.w100p {
    width: 200px !important;
}

.itemBox {
    display: none
}
.ibox-title h3 {line-height:34px}
</style>
</head>
<body class="bg-gary">
<div class="row mt55">
    <div id="manage_top " class="menu_top_fixed height73 p15">
        <div class="ibox-title">
            <h3 class="fl">考试管理</h3>
            <a class="btn btn-info btn-rounded btn-s-md " href="<?php echo M_URL($this->AppName.'/Index','index','',GP('')); ?>"
             style="margin-left:15px">试卷管理</a>
             <a class="btn btn-info btn-rounded btn-s-md "  href="<?php echo M_URL($this->AppName.'/Index','TkIndex','',GP('')); ?>" 
             style="margin-left:15px">题库管理</a>
        </div>
    </div>
</div>
<div class="clear"></div>
<div class="tabs-container">
  <ul class="nav nav-tabs">
        <li ><a href="<?php echo M_URL($this->AppName.'/Index','paperAdd','',GP('')); ?>">试卷添加</a></li>
        <li class="active" ><a  href="<?php echo M_URL($this->AppName.'/Index','addTk','',GP('')); ?>"> 题库添加</a></li>
  </ul>
<div class=" contentBox bRadius10 bg-white editPerson">
<form target="hidframe"  id="myform" action="<?php if(isset($tk)){echo M_URL($this->AppName.'/Index','doeditTk',$tk['tkid'],$now_page,GP(""));}
                    else{echo M_URL($this->AppName.'/Index','doAddTk','','',GP("userid-$this->userid"));} ?>" method="post" class="form-horizontal">
    <table width="95%" cellpadding="0" cellspacing="0" border="0" class="gTable  mlr pt20">
        <tbody class="show-important" style="display: table-row-group!important;">
        <tr>
            <td class="leftTd alignRight fsize16 c-79 w100p borderBda pr20">当前添加用户</td>
            <td class="leftTd alignLife fsize12 c-92 pr10 borderBda">
                <?php echo $this->userinfo['username'] ?>
                <a onClick="selectUser('<?php echo M_URL($this->AppName.'/Index','selectUser','',GP('addtype-2')); ?>')">更改</a>
            </td>
        </tr>
        <tr>
            <td class="leftTd alignRight fsize16 c-79 w100p borderBda pr20">题目类型</td>
            <td class="leftTd alignLife fsize12 c-92 pr10 borderBda">
                <select name="tkType" class="inputText bRadius5 w300 pl30" onchange="getChoice(this)" id="tktype">
                    <option value="1" <?php if(isset($tk))if($tk['tktype'] == 1) echo "selected"; ?>>单选题</option>
                    <option value="2" <?php if(isset($tk))if($tk['tktype'] == 2) echo "selected"; ?>>填空题</option>
                    <option value="3" <?php if(isset($tk))if($tk['tktype'] == 3) echo "selected"; ?>>判断题</option>
                    <option value="4" <?php if(isset($tk))if($tk['tktype'] == 4) echo "selected"; ?>>问答题</option>
                    <option value="5" <?php if(isset($tk))if($tk['tktype'] == 5) echo "selected"; ?>>听力题</option>
                    <option value="6" <?php if(isset($tk))if($tk['tktype'] == 6) echo "selected"; ?>>录音题</option>
                </select>
            </td>
        </tr>
        <tr>
            <td class="leftTd alignRight fsize16 c-79 w100p borderBda pr20">专业分类</td>
            <td class="leftTd alignLife fsize12 c-92 pr10 borderBda">
                <?php echo $Linkage->Linkage(2);?>
            </td>
        </tr>
        <tr>
            <td class="leftTd alignRight fsize16 c-79 w100p borderBda pr20">所属课程</td>
            <td class="leftTd alignLife fsize12 c-92 pr10 borderBda">
                <select name="courseid" class="inputText bRadius5 w300 pl30 fl" id="course" onChange="getChapter(this)">
                     <?php if(isset($tk))foreach($course as $k=>$v){?>
                    <option value="<?php echo $v['courseid'] ?>" <?php if($v['courseid']==$tk['courseid']) echo 'selected = "selected"'; ?>>
                           <?php echo $v['title']?>
                    </option>
                    <?php } ?>
                </select>
            </td>
        </tr>
        <tr>
            <td class="leftTd alignRight fsize16 c-79 w100p borderBda pr20">所属章节</td>
            <td class="leftTd alignLife fsize12 c-92 pr10 borderBda">
                <select name="chapterid" class="inputText bRadius5 w300 pl30 fl" id="chapter">
                    <?php if(isset($tk))foreach($chapter as $k=>$v){?>
                    <option value="<?php echo $v['chapterid'] ?>" <?php if($v['chapterid']==$tk['chapterid']) echo 'selected = "selected"'; ?>>
                           <?php echo KS_INDENT($v['depth']).$v['title']?>
                    </option>
                    <?php } ?>
                </select>
            </td>
        </tr>
        <tr>
            <td class="leftTd alignRight fsize16 c-79 w100p borderBda pr20">试题难度</td>
            <td class="leftTd alignLife fsize12 c-92 pr10 borderBda">
            <select name="level" class="inputText bRadius5 w300 pl30">
                 <option value="1" <?php if(isset($tk)){if($tk['level']==1) echo 'selected = "selected"';} ?>>简单</option>
                <option value="2"<?php if(isset($tk)){if($tk['level']==2) echo 'selected = "selected"';} ?>>一般</option>
                <option value="3"<?php if(isset($tk)){if($tk['level']==3) echo 'selected = "selected"';} ?>>困难</option>
            </select></td>
        </tr>
         <tr>
            <td class="leftTd alignRight fsize16 c-79 w100p borderBda pr20">所属类型</td>
            <td class="leftTd alignLife fsize12 c-92 pr10 borderBda">
            <select name="paperTypeId"class="inputText bRadius5 w300 pl30">
                 <?php foreach($papertype as $k=>$v){?>
                    <option value="<?php echo $v['id'] ?>" <?php if(isset($paper)){if($v['id']==$paper['paperType']) echo 'selected = "selected"';} ?>>
                           <?php echo $v['typeName']?>
                    </option>
                    <?php } ?>
            </select></td>
        </tr>
        </tbody>
    </table>
    <table width="95%" cellpadding="0" cellspacing="0" border="0" class="gTable  mlr pt20">
        <!-- 选择题 -->
        <tbody class=" itemBox" id="Multiple" style="display: table-row-group">
       
        <tr>
            <td class="leftTd alignRight fsize16 c-79 w100p borderBda pr20">题干</td>
            <td class="leftTd alignLife fsize12 c-92 pr10 borderBda">
               
                <?php echo $stem1; ?>
               
            </td>
        </tr>
        <?php if(isset($select)){foreach($select as $k=>$v){ ?>
         <tr>
            <td class="leftTd alignRight fsize16 c-79 w100p borderBda pr20">选项<i class="secW"><?PHP echo chr($k+65) ?></i></td>
            <td class="leftTd alignLife fsize12 c-92 pr10 borderBda">
                <textarea name="select[]" rows="2" cols="20" class="inputText bRadius5 p16"
                          style="height:100px;width:40%;"><?php echo $v ?></textarea>
            </td>
        </tr>
        <?php }}else{ ?>
        <tr>
            <td class="leftTd alignRight fsize16 c-79 w100p borderBda pr20">选项<i class="secW">A</i></td>
            <td class="leftTd alignLife fsize12 c-92 pr10 borderBda">
                <textarea name="select[]" rows="2" cols="20" class="inputText bRadius5 p16"
                          style="height:100px;width:40%;"></textarea>
            </td>
        </tr>
        <tr>
            <td class="leftTd alignRight fsize16 c-79 w100p borderBda pr20">选项<i class="secW">B</i></td>
            <td class="leftTd alignLife fsize12 c-92 pr10 borderBda">
                <textarea name="select[]" rows="2" cols="20" class="inputText bRadius5 p16"
                          style="height:100px;width:40%;"></textarea>
            </td>
        </tr>
        <tr>
            <td class="leftTd alignRight fsize16 c-79 w100p borderBda pr20">选项<i class="secW">C</i></td>
            <td class="leftTd alignLife fsize12 c-92 pr10 borderBda">
                <textarea name="select[]" rows="2" cols="20" class="inputText bRadius5 p16"
                          style="height:100px;width:40%;"></textarea>
            </td>
        </tr>
        <tr>
            <td class="leftTd alignRight fsize16 c-79 w100p borderBda pr20">选项<i class="secW">D</i></td>
            <td class="leftTd alignLife fsize12 c-92 pr10 borderBda">
                <textarea name="select[]" rows="2" cols="20" class="inputText bRadius5 p16"
                          style="height:100px;width:40%;"></textarea>
                <button class="btn-default" type="button" id="addBox">增加选项</button>
            </td>
        </tr>
        <?php }?>
        <tr class="choice-word">
            <td class="leftTd alignRight fsize16 c-79 w100p borderBda pr20" >正确选项</td>
             <td class="leftTd alignLife fsize12 c-92 pr10 borderBda pl30" id="word-td">
            <?php if(isset($select)){foreach($select as $k=>$v){ ?>
                   <label class="radioLabel fl">
                    <input type="radio" name="anser1" class="radioInput abc" value="<?PHP echo chr($k+65) ?>" <?php if($tk['anser']==chr($k+65)) echo "checked" ?>>
                    <span class="radioName fsize14 c-92"><?PHP echo chr($k+65) ?></span>
                </label>       
            <?php }}else{ ?>      
                <label class="radioLabel fl">
                    <input type="radio" name="anser1" class="radioInput abc" value="A">
                    <span class="radioName fsize14 c-92">A</span>
                </label>
                <label class="radioLabel fl">
                    <input type="radio" name="anser1" class="radioInput" value="B">
                    <span class="radioName fsize14 c-92">B</span>
                </label>
                <label class="radioLabel fl">
                    <input type="radio" name="anser1" class="radioInput" value="C">
                    <span class="radioName fsize14 c-92">C</span>
                </label>
                <label class="radioLabel fl">
                    <input type="radio" name="anser1" class="radioInput" value="D">
                    <span class="radioName fsize14 c-92">D</span>
                </label>
            <?php }?>
             </td>
        </tr>
        </tbody>
        <!--end-->
        <!--填空题 -->
        <tbody class=" itemBox" id="topic">
        <tr>
            <td class="leftTd alignRight fsize16 c-79 w100p borderBda pr20 verAlignTop">题目内容
                <p class="c-red fsize1 mt20 alignRight">
                    如选择题填写具体的选项，填空题在需要用户作答的地方放{#answer}标签，使用户编辑器时shift+Enter分段
                </p>
            </td>
            <td class="leftTd alignLife fsize12 c-92 pr10 borderBda">
                 <?php echo $stem2; ?>
             

            </td>
        </tr>
        <tr>
            <td class="leftTd alignRight fsize16 c-79 w100p borderBda pr20 verAlignTop">正确答案</td>
            <td class="leftTd alignLife fsize12 c-92 pr10 borderBda">
                <textarea rows="2" cols="20" name="anser2" style="height: 200px;width: 81%"><?php if(isset($anser2))echo $anser2; ?></textarea>

                <p class="c-92 fsize12 mt10" style="width: 60%">
                    Tips:填空题如果有多个空格，各个空格的参考答案之间用*隔开，一个空有多个答案的，在用丨线隔开。如1丨2*2*3表示
                    有三个空格，第一个空格的答案可以是1或2，第二个空格的答案是2，第三个空格的答案是3
                </p>
            </td>
        </tr>
        <tr>
            <td class="leftTd alignRight fsize16 c-79 w100p borderBda pr20 verAlignTop">答案解析

            </td>
            <td class="leftTd alignLife fsize12 c-92 pr10 borderBda">
              <?php echo $analysis2; ?>
                  
            </td>
        </tr>
        </tbody>
        <!--end-->
        <!-- 判断题-->
        <tbody class=" itemBox" id="judge">
        <tr>
            <td class="leftTd alignRight fsize16 c-79 w100p borderBda pr20 verAlignTop">题目内容</td>
            <td class="leftTd alignLife fsize12 c-92 pr10 borderBda">
                <?php echo $stem3; ?>
               
            </td>
        </tr>
        <tr>
            <td class="leftTd alignRight fsize16 c-79 w100p borderBda pr20 verAlignTop">正确答案</td>
            <td class="leftTd alignLife fsize12 c-92 pr10 borderBda">
                <label class="radioLabel fl">
                    <input type="radio" name="anser3" class="radioInput" value="1" <?php if(isset($anser3)){if($anser3==1) echo "checked";} ?>>
                    <span class="radioName fsize14 c-92">正确</span>
                </label>
                <label class="radioLabel fl">
                    <input type="radio" name="anser3" class="radioInput" value="0" <?php if(isset($anser3)){if($anser3==0) echo "checked";}else{echo "checked";} ?>>
                    <span class="radioName fsize14 c-92">错误</span>
                </label>
            </td>
        </tr>
        <tr>
            <td class="leftTd alignRight fsize16 c-79 w100p borderBda pr20 verAlignTop">答案解析

            </td>
            <td class="leftTd alignLife fsize12 c-92 pr10 borderBda">
                <textarea name="analysis3" rows="2" cols="20" id="parsing0"
                          style="height:200px;width:90%;"><?php if(isset($analysis3))echo $analysis3; ?></textarea>
             
            </td>
        </tr>
        </tbody>
        <!--end-->
        <!-- 问答题-->
        <tbody class=" itemBox" id="question">
        <tr>
            <td class="leftTd alignRight fsize16 c-79 w100p borderBda pr20 verAlignTop">题目内容</td>
            <td class="leftTd alignLife fsize12 c-92 pr10 borderBda">
               <?php echo $stem4; ?>

            </td>
        </tr>
        <tr>
            <td class="leftTd alignRight fsize16 c-79 w100p borderBda pr20 verAlignTop">正确答案</td>
            <td class="leftTd alignLife fsize12 c-92 pr10 borderBda">
                <textarea name="anser4" rows="2" cols="20" id="question2"
                          style="height:200px;width:90%;"><?php if(isset($anser4))echo $anser4; ?></textarea>
               

            </td>
        </tr>
        <tr>
            <td class="leftTd alignRight fsize16 c-79 w100p borderBda pr20 verAlignTop">关键字</td>

            <td class="leftTd alignLife fsize12 c-92 pr10 borderBda">
                <textarea rows="2" cols="20" style="height: 200px;width: 81%" name="keyword"><?php if(isset($ketword))echo $ketword; ?></textarea>

                <p class="c-92 fsize12 mt10" style="width: 60%">
                    Tips:主观题将根据设置的关键词估分，多个关键词请用英文逗号（，）隔开

                </p>
            </td>
        </tr>
        <tr>
            <td class="leftTd alignRight fsize16 c-79 w100p borderBda pr20 verAlignTop">答案解析

            </td>
            <td class="leftTd alignLife fsize12 c-92 pr10 borderBda">
                <textarea name="analysis3" rows="2" cols="20" id="question3"
                          style="height:200px;width:90%;"><?php if(isset($analysis4))echo $analysis4; ?></textarea>
               

            </td>
        </tr>
        </tbody>
        <!--end-->
        <!--材料题-->
        <tbody class=" itemBox" id="addTitle">
        <tr>
            <td class="leftTd alignRight fsize16 c-79 w100p borderBda pr20 verAlignTop">题目内容</td>
            <td class="leftTd alignLife fsize12 c-92 pr10 borderBda">
                <textarea name="introeditor" rows="2" cols="20" id="addTitle1"
                          style="height:200px;width:90%;"></textarea>
              

            </td>
        </tr>
       
        <tr>
            <td class="leftTd alignRight fsize16 c-79 w100p borderBda pr20 verAlignTop">第1小题题目</td>
            <td class="leftTd alignLife fsize12 c-92 pr10 borderBda">
                <textarea name="introeditor" rows="2" cols="20" id="addTitle3"
                          style="height:200px;width:90%;"></textarea>
               

            </td>
        </tr>
        <tr>
            <td class="leftTd alignRight fsize16 c-79 w100p borderBda pr20 verAlignTop">第<span class="answer-span">1</span>小题答案</td>
            <td class="leftTd alignLife fsize12 c-92 pr10 borderBda">
                <textarea name="introeditor" rows="2" cols="20" id="addTitle4"
                          style="height:200px;width:90%;"></textarea>
                <button type="button" class="btn-default" id="answer-btn">增加选项</button>

            </td>
        </tr>
        </tbody>
        <!-- end-->
    </table>
    <input type="submit" class="generalBtn c-fff fsize16 bRadius5" value="保存" name="save">
    </form>
</div>
</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
 function getChoice(obj) {
        var text = parseInt($(obj).val()) - 1;
        $('.itemBox:eq(' + text + ')').show().siblings().hide();

    }
$(function(){ 
	   var text = parseInt($("#tktype").val()) - 1;
        $('.itemBox:eq(' + text + ')').show().siblings().hide();
	});
loadScorllJs();
</script>
<script>
$(function () {
   $('#addBox').click(function () {
		var word = $(this).parents('tr').find('.secW').text();
		b = String.fromCharCode(word.charCodeAt() + 1);
		var html = '';
		var word1 = '';
		html += '<tr><td class="leftTd alignRight fsize16 c-79 w100p borderBda">选项<i class="secW">' + b + '</i></td>';
		html += '<td class="leftTd alignLife fsize12 c-92 pr10 borderBda"><textarea name="select[]" class="inputText bRadius5 p16"cols="20" rows="2"style="height:100px;width: 40%" ></textarea></td></tr>';
		$(this).parents('tr').after(html);
		word1 += '<label class="radioLabel fl"><input type="radio" name="anser1" class="radioInput" value='+b+'><span class="radioName fsize14 c-92" >'+b+'</span></label>';
		$('#number-table').after(html);
		$(this).insertAfter($(this).parents('tr').next('tr').find('textarea'));
	    var a= $('#word-td').append(word1);
	})
  $('#answer-btn').click(function(){
		var answerword =parseInt($(this).parents('tr').find('.answer-span').text())+1;
		var topic =''
		topic += '<tr><td class="leftTd alignRight fsize16 c-79 w100p borderBda pr20 verAlignTop">第<span class="answer-span">'+answerword+'</span>小题题目</td>';
		topic +='  <td class="leftTd alignLife fsize12 c-92 pr10 borderBda"><textarea cols="2" rows="20" style="height: 200px;width: 95%"  id="B'+answerword+'"></textarea></td></tr>'
		topic += '<tr><td class="leftTd alignRight fsize16 c-79 w100p borderBda pr20 verAlignTop btnsign">第<span class="answer-span">'+answerword+'</span>小题答案</td>';
		topic +='  <td class="leftTd alignLife fsize12 c-92 pr10 borderBda"><textarea cols="2" rows="20" style="height: 200px;width: 95%" id="C'+answerword+'"></textarea></td></tr>'
		$(this).parents('tr').after(topic);
		$(this).insertAfter($(this).parents('tr').next('tr').next('tr').find('textarea'));
	});	
})
function local(obj){
 	var a =$(obj).val();
	var url = '<?php echo UOOT;?>Plus/Kesion.ajax.php?act=getCourse';
	$.ajax({
	   type : "post",
	   url : url,
	   data:{
		   "categoryid": a,
		   "userid":<?php echo $this->userid ?>,
	   },
	   success:function(data){
		    $('#course').empty();
			$('#chapter').empty();
		    $('#course').html(data);
		},
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
		   "userid":<?php echo $this->userid ?>,
	   },
	   success:function(data){
		    $('#chapter').empty();
		    $('#chapter').html(data);
		},
	
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
</body>
</html>
