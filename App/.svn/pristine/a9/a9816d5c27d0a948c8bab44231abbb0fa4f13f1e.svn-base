<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>无标题文档</title>
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/live.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/main.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<style>
.inputText {
height: 32px;
line-height: 32px;
}
.orz{
margin: 15px 20px;
}
.layui-table[lay-even] tr:nth-child(even) {
background: #fafafa;
}
.searchBtn {height: 32px;}
</style>
</head>
<body>   
       <label class="fl mr30"><input type="checkbox" name="" class="checkall verAlignMiddle check0 check-all "><span class="hLh30 fsize14 c-92 verAlignMiddle">全选</span></label>
    <div class="search-box orz clearfix" >
        <select class="inputText bRadius5 w150 c-79 mr30 fl">
           <option value="0">无--作为一级栏目</option>';
              <?php foreach($userscategory as $k=>$v){?>
              <option value=<?php $v["categoryid"]?>><?php echo KS_INDENT($v['depth']).$v["categoryname"]?></option>
              <?php }?>
        </select>
        <div class="seach-input fl">
            <form target="hidframe" >
                <input type="text" class="inputText" name="searchText">
                <input type="button" class="searchBtn w93 fsize14 bg-gary c-92 verAlignMiddle" name="searchBtn" value="搜索">
            </form>
        </div>
    </div>
    <table width="100%" cellpadding="0" cellspacing="0" border="0"
           class="gTable borderTable borderSo" style="border-bottom:0;">
        <thead>
        <tr class="bg-gary">
        <th class="alignCenter hLh40 pt0 pb0 fsize14 "></th>
            <th class="alignCenter hLh40 pt0 pb0 fsize14 w93"> ID</th>
            <th class="alignCenter hLh40 pt0 pb0 fsize14">名字</th>
            <th class="alignCenter hLh40 pt0 pb0 fsize14 ">头衔</th>
            
            <th class="alignCenter hLh40 pt0 pb0 fsize14 w93">简介</th>
        </tr>
        </thead>
        <form action="<?php echo M_URL($this->AppName.'/index','addteachers',$courseid,GP(''));?>" method="post" id="myform">
        <tbody>
         <?php  foreach($teachers as $key=>$v){ ?>
        <tr>
            <td class="alignCenter hLh40 pt0 pb0 fsize14 c-92 ">
                <div class="order-product pd-b">
                    <input type="checkbox" class="verAlignMiddle mr10" id="radio<?php echo $v["userid"]?>" name="docent[]" value="<?php echo $v["userid"] ?>">
                </div>
            </td>
            <td class="alignCenter hLh40 pt0 pb0 fsize14 c-92" > <?php  echo $v["userid"] ?></td>
            <td class="alignCenter hLh40 pt0 pb0 fsize14 c-92 name"id="name<?php echo $v["userid"]?>" > <?php  echo $v["name"] ?></td>
            <td class="alignCenter hLh40 pt0 pb0 fsize14 c-92"></td>
            <td class="alignCenter hLh40 pt0 pb0 fsize14 c-92"></td>
        </tr>
        <?php } ?>
            <input type="button" class="generalBtn c-fff fsize16 bRadius5" <?php if($type == 1){echo "'id=abc'";}else{echo "'id=cba'";} ?>value="确认" name="confirm" />
        </tbody>
        </form>
    </table>
         <?php echo $page->show(3); ?>
        
</body>
</html>
<script src="<?php echo UOOT;?>Public/common/js/common.js" type="text/javascript"></script>
<script>
radiotabs('temptype','.radio-tabs');
uploadView('180','140');
loadScorllJs();
$("#abc").click(function(){
	 top.frames["main"].$(".addteacher").remove();
     $('input[name="docent"]:checked').each(function(){ 
	 var name =$(".name").filter("#name"+$(this).val()).text();
     top.frames["main"].$("#teacher2").append('<li width=150px  class="addteacher" data="'+$(this).val()+'" dataname="'+name+'" id="docent'+$(this).val()+'"><input type="hidden" name="docent[]" value="'+$(this).val()+'">'+name+'<button type="button" onclick ="speak('+$(this).val()+',\''+name+'\');">设为主讲</button><button type="button" onclick ="del('+$(this).val()+')">删除</button></li>');	 
    });
	var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
	parent.layer.close(index);
});


$('#cba').click(function(){
	$('#myform').submit();
	
})


</script>