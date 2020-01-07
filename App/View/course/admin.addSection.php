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
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
</head>
<body>
<form target="hidframe" id="myform" action="<?php  if(!empty($chapter)){echo M_URL($this->AppName.'/index','doeditchapter',$courseid,GP("chapterid=$chapterid"));}else{echo M_URL($this->AppName.'/index','doaddsection',$courseid,GP(''));} ?> " method="post" class="form-horizontal">
<table width="100%" cellpadding="0" cellspacing="0" border="0" class="gTable">
    <tr>
        <td class="leftTd alignRight fsize16 c-79 w150">所属章</td>
        <td class="rightTd alignLife">

            <select class="inputText bRadius5 w400 c-79 mr30" name="parentid">
                 <?php
				  if(isset($chapterAll)){ 
				  echo "<option value='0'>无--作为一级分类</option>";
					foreach($chapterAll as $k=>$v){
						 $html="<option value='$v[chapterid]' ";
                       if($v['chapterid']==$chapterid)
                       {
                           $html=$html."selected = 'selected'";
                       }
                       $html=$html.">".KS_INDENT($v['depth'])."$v[title]</option>" ;

                       echo $html;
					}
				  }else{
					  echo "<option value='0'>无--作为一级分类</option>";
					  }
                    ?>
            </select>
        </td>
    </tr>
    <tr>
        <td class="leftTd alignRight fsize16 c-79 w150">章节名称</td>
        <td class="rightTd alignLife">
            <input type="text" name="title" value="<?php if(isset($chapter)) echo $chapter["title"]; ?>" class="inputText bRadius5 w400 c-79" required>
        </td>
    </tr>
    <tr>
        <td class="leftTd alignRight w150"></td>
        <td class="rightTd alignLife">
        <input type="button" onClick="do_reg()" class="generalBtn c-fff fsize16 bRadius5" value="确定" name="confirm">
        </td>
    </tr>
</table>
</form>
<script src="<?php echo UOOT;?>Public/common/js/common.js" ></script>
<script>
$(function(){
     //优化复选框 0未选 1选中      
     checkbookM();
     WebLeftSide();
});
function do_reg()
{
	var title = $("input[name='title']").val();
	var num =/^[0-9]*$/;
    if(title==''){
		Alert('章节题目');
		return false;	
    }
	$("#myform").submit();	
}
</script>
</body>
</html>
