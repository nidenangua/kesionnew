<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<!--<link href="Public/app/css/layer.css?<?php echoHash(); ?>" rel="stylesheet" />-->
<!--<script src="Public/app/js/layer.js" type="text/javascript"></script>-->
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<title>无标题文档</title>
</head>
<body>
   <form target="hidframe"  action="">
       <table>
         <tr>
            <th width="50px"></th>
            <th width="100px">ID</th>
            <th width="100px">名字</th> 
         </tr>
         <?php  foreach($teachers as $key=>$v){ ?>
         <tr>
             <td><input type="radio" id="radio<?php echo $v["userid"]?>" name="speaker" value="<?php echo $v["userid"] ?>"></td>
             <td id="<?php echo $v["userid"]?>"><?php  echo $v["userid"] ?></td>
             <td id="name<?php echo $v["userid"]?>"><?php  echo $v["name"] ?></td>
         </tr>
         <?php } ?>
        
       </table> 
       <?php echo NoC($teachers);?>	     
          <input type="button" class="generalBtn c-fff fsize16 bRadius5" id="abc"  value="确认" name="confirm"
    </form>
    <?php echo $page->show(3); ?>
</body>
</html>
<script src="<?php echo UOOT;?>Public/common/js/common.js" type="text/javascript"></script>
<script>
$("#abc").click(function(){
	  //var id = $("#speaker").val();
	  var id = $("input[name='speaker']:checked").val();
	  var name = $("#name"+id).text();
	  parent.$("#add").remove();
	  parent.$("#teacher1").after('<div id="add"><input type="hidden" name="speaker" value="'+id+'">'+name+'</div>');
	  var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
      parent.layer.close(index);
});
</script>