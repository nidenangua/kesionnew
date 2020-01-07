<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>添加节</title>
    <link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
    <link href="<?php echo UOOT;?>Public/app/css/live.css?<?php echoHash(); ?>" rel="stylesheet" />
    <script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
    <style>
    .gTable td{
        padding:15px 0
    }
    </style>
</head>
<body>
<iframe name="hidframe" style="display:none"></iframe>
<form target="hidframe"  action="<?php  if(!empty($chapter)){echo M_URL($this->AppName.'/Index','doeditchapter',$courseid,GP("chapterid=$chapterid"));}else{echo M_URL($this->AppName.'/Index','doaddsection',$courseid,GP(''));} ?> " method="post" class="form-horizontal">
<table width="100%" cellpadding="0" cellspacing="0" border="0" class="gTable">
    <tr>
        <td class="leftTd alignRight fsize16 c-79 w150">所属章</td>
        <td class="rightTd alignLife">
        <select class="inputText bRadius5 w400 c-79 mr30" name="parentid">
             <?php
              if(isset($chapterAll)){ 
             
                foreach($chapterAll as $k=>$v){
                     $html="<option value='$v[chapterid]' ";
                   if($v['chapterid']==$chapterid)
                   {
                       $html=$html."selected = 'selected'";
                   }
                   $html=$html.">".KS_INDENT($v['depth'])."$v[title]</option>" ;

                   echo $html;
                }
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
        <input type="submit" class="generalBtn c-fff fsize16 bRadius5" value="确定" name="confirm">
        </td>
    </tr>
</table>
</form>

</body>
</html>
