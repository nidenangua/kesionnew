<!DOCTYPE html>
<html>
<head >
    <title>轮播图标签</title>
    <link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
    <link href="<?php echo UOOT;?>Public/admin/fonts/iconfont.css" rel="stylesheet">
    <link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
</head>
<body scroll="auto" class="scroll_Rcontent s1" style="">
<table style="margin-top:2px" border="0" cellpadding="1" cellspacing="1" width="100%">
    <tr>
     <td class="righttd" style="text-align: right; width: 91px;"><strong>字段名称：</strong></td>
     <td class="righttd">
         <input name="FieldName" type="text" value="<?php echo $fieldname;?>" readonly id="FieldName" class="textbox" />
     </td>
    </tr>
    <?php if($fieldtype==15){?>
    <tbody id="ctl00_KSContent_datearea">
    <tr>
        <td class="righttd" style="height:30px;text-align: right; width: 91px;">
            <strong>输出格式：</strong></td>
        <td class="righttd">
            <input name='Datemb' type='text' class="textbox" id='Datemb' size='20' value="YY-MM-DD">
    		<br/>
    		<font color=red>说明：Y4或YY表示四位的年份，Y2两位年份， 　MM:月 　DD:日<br>
    		hh:时　 mm:分　 ss:秒</font>
            <br />
            <input name="days" id="days" style="text-align:center;width:30px" value="3" class="textbox" />天内日期加
            <select name="color" id="color">
                <option value="red">红</option>
                <option value="yellow">黄</option>
                <option value="blue">蓝</option>
                <option value="green">绿</option>
                <option value="brown">褐</option>
                <option value="black">黑</option>
                <option value="white">白</option>
                <option value="gray">灰</option>
            </select><br />
            <font color="red">不加颜色，请留空或是填“0”。</font>
        </td>
    </tr>
    </tbody>
    <?php }elseif($fieldtype==-1||$fieldtype==14){?>
    <tbody id="ctl00_KSContent_idarea">
    <tr>
        <td class="righttd" style="height:30px;text-align: right; width: 91px;">
            <strong>输出格式：</strong></td>
        <td class="righttd">
            <Input type='radio' name='outype' value='1' checked> 
            对象Url <br />
            <Input type='radio' name='outype' value='0'> 
            字段值<br />
        </td>
    </tr>
    </tbody>
    <?php }else{ ?>
    <tbody id="ctl00_KSContent_stringarea">
    <tr>
        <td class="righttd" style="height:30px;text-align: right; width: 91px;">
            <strong>输出长度：</strong></td>
        <td class="righttd">
            <input name='CatNum' type='text' class="textbox" id='CatNum' size='3' value="0" style="width:50px;">
            <font color='#FF0000'>为0不截断，数字则保留小数位。</font></td>
    </tr>
    <tr>
        <td class="righttd" style="height:29px;text-align: right; width: 91px;">
            <strong>截断显示：</strong></td>
        <td class="righttd" style="height: 29px">
            <Input name='CatType' type='text' id='CatType' class="textbox" value='...' size="3">
            <br/><font color='#FF0000'>为0则不显示任何标志</font></td>
    </tr>
    <tr>
        <td class="righttd" style="height:30px;text-align: right; width: 91px;">
            <strong>过滤处理：</strong></td>
        <td class="righttd">
           <select name='OutSplit' id='OutSplit'><option value='0'>解析HTML标记</option><option value='1'>不解析HTML标记</option><option value='2' selected>过滤HTML标记</option></select></td>
    </tr>
    <tr>
        <td class="righttd" style="height:30px;text-align: right; width: 91px;">
            <strong>为空时输出：</strong></td>
        <td class="righttd">
           <input name="TxtNullChar" type="text" id="TxtNullChar" class="textbox" />
    </tr>
    </tbody>
    <?php } ?>
<tr>
 <td colspan="2" align="center" class="righttd" height="35">
  <input type="button" value="确定插入" class="button" onclick="checkform()" />&nbsp;
  <input type="button" value="关闭取消" class="button" onclick="parent.closePopup(window.name);" />
 </td>
</tr>
</table>
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
    $(document).ready(function () {
    	var a = jQuery("#aspnetForm").attr("action");
    	if (a.indexOf('/') != -1) {
    		var arr = a.split('/');
    		a = arr[arr.length - 1];
    		jQuery("#aspnetForm").attr("action", a);
    	}
    }); 

    function checkform()
    {
        <?php if($fieldtype==15){?>
        var dbname="{$Field(" + $("#FieldName").val() + ",date,"+$("#Datemb").val()+","+jQuery("#days").val()+","+jQuery("#color").val()+")}";
        <?php }elseif($fieldtype==-1||$fieldtype==14){?>
         for (var i=0;i<document.all.outype.length;i++)
         if (document.all.outype[i].checked)
         var outype=document.all.outype[i].value;
         var model='<?php echo $appename;?>';
         var a="view";
         if($("#FieldName").val()=="categoryid") a="list";
         var dbname="{$Field(" + $("#FieldName").val() + ",url,"+outype+","+model+","+a+")}";
        <?php }else{ ?>
        var dbname="{$Field(" + $("#FieldName").val() + ",text,"+$("#CatNum").val()+","+$("#CatType").val()+","+$("#OutSplit option:selected").val()+","+$("#TxtNullChar").val()+")}";
        <?php } ?>
   
        parent.InsertValue(dbname);
        parent.closePopup(window.name)
    }

</script>
</body>
</html>