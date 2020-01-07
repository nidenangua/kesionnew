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
<link href="<?php echo UOOT;?>Public/app/font/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
</head>

<body>

 <div class="p20 pt0">
	 <form  action="<?php echo M_URL($this->AppName.'/index','doaddStudent','',GP('')) ?>"  method="post">
		   <div class="blank10"></div>
		   <table width="100%" cellpadding="0" cellspacing="0" border="0" class="gTable borderTable borderSo" style="border-bottom:0;">
			   <tr class="bg-gary">
			     <td class="alignCenter hLh40 pt0 pb0 fsize14 w100p"></td>
				 <td class="alignCenter hLh40 pt0 pb0 fsize14 w100p">图像</td>
				 <td class="alignCenter hLh40 pt0 pb0 fsize14">ID</td>
				 <td class="alignCenter hLh40 pt0 pb0 fsize14 w93">操作</td>
			   </tr>
               <?php foreach($values as $k=>$v){ ?>
			   <tr>
			     <td class="alignCenter hLh40 pt0 pb0 fsize14 w100p"><input type="checkbox" class="chackInput check0" name="aid[]" value=""></td>
				 <td class="alignCenter hLh40 pt0 pb0 fsize14 c-92 w100p"><img src="<?php echo $v['vdoImg']; ?>" width="30px" height="30px"></td>
				 <td class="alignCenter hLh40 pt0 pb0 fsize14 c-92">
					<?php echo $v['vdoName'];  ?>
				 </td>
                 <td class="alignCenter hLh40 pt0 pb0 fsize14 w150">
                 <input type="hidden" id=<?php echo 'vdo'.$v['id'] ?> value="<?php echo $v['vdoId'] ?>">
                 <a onclick="add(<?php echo $v['id'] ?>)" class="c-green pr10 pl10">加入课时</a>
                 <a href="javascript:void(0);"  onclick="Confirm('是否删除此课程？该操作不可逆!','<?php echo M_URL($this->AppName.'/index','delvdo',$v['id'],GP('')) ?>')" class="c-green pr10 pl10" title="删除视屏">删除视屏</a></td>
			   </tr>
               <?php } ?>
			  
			</table>
          
		 <div class="fr clearfix mt30 mr30">

			 <div class="rightTd alignLife">
				 <input type="checkbox" name="" class="checkall chackInput verAlignMiddle check0 check-all ">全选
				 <input type="submit" class="generalBtn c-fff fsize16 bRadius5 ml20" value="确认" name="confirm">
			 </div>
		 </div>
			<div class="blank30"></div>
	  </form>
  </div>
<script src="<?php echo UOOT;?>Public/common/js/common.js" ></script>

<script>
$(function(){
var selectInputs = $('.check0'); // 所有勾选框
var checkAllInputs = $('.check-all')	
selectall(selectInputs,checkAllInputs);
loadScorllJs();//滚轮
})

function add(id){
	  var vdoId=$('#vdo'+id).val();
	   parent.top.frames['main'].$('#playurl1').val(vdoId);
	    var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
            parent.layer.close(index);
	
	
}
</script>
</body>
</html>
