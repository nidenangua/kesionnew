<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>添加章</title>
  <link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
  <link href="<?php echo UOOT;?>Public/app/css/live.css?<?php echoHash(); ?>" rel="stylesheet" />
  <script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>   

</head>
<body>
  <iframe name="hidframe" style="display:none"></iframe>
    <form target="hidframe"  action="<?php  if(!empty($chapter)){echo M_URL($this->AppName.'/Index','doeditchapter',$courseid,GP("chapterid-$chapterid"));} 
          else{echo M_URL($this->AppName.'/Index','doaddchapter',$courseid,GP(''));} ?>" method="post" class="form-horizontal">
          <table width="100%" cellpadding="0" cellspacing="0" border="0" class="gTable">                     
                                                  
            <tr>  
                  <td class="leftTd alignRight fsize16 c-79 w150">章名称</td>
                  <td class="rightTd alignLife">
                  <input type="text" name="title" class="inputText bRadius5 w400 c-79" value="<?php if(isset($chapter)) echo $chapter["title"]; ?>" required>
              </td>
          </tr>   
          <td class="leftTd alignRight w150"></td>
          <td class="rightTd alignLife">
            <input type="submit" class="generalBtn c-fff fsize16 bRadius5" value="确认" name="confirm">
          </td>
        </tr>
      </table>
    </form>
</body>
</html>