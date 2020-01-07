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
    <link href="<?php echo UOOT;?>Public/app/css/main.css?<?php echoHash(); ?>" rel="stylesheet" />
    <link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
    <script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
    <style>
        .generalBeen {
            display: inline-block;
            padding: 0 20px;
            height: 34px;
            line-height: 34px;
            text-align: center;
            background-color: limegreen;
            border: none;
        }
        .generalTitle {margin-bottom: 30px}
    </style>
</head>

<body class="bg-gary">
<div class="gSmallBox contentBox bRadius10 bg-white w100">
    <div class="generalTitle">
        <span class="gTitle fsize18 c-3e verAlignMiddle">修改试卷类型</span>
         当前所在<?php echo $this->userinfo['username'] ?>类型管理界面 
         <a class="generalBeen c-fff fsize16 bRadius5 fr" href="<?php echo  M_URL($this->AppName.'/Index','paperType','',GP(''));?>" >返回</a>
    </div>
    <div class="infoBox">
        <div class="clearfix p20">
            <form target="hidframe"  action="<?php if(isset($papertype)){ echo M_URL($this->AppName.'/Index','doEditPaperType',$papertype['id'],GP('')); }
			                     else{ echo M_URL($this->AppName.'/Index','dotypeAdd','',GP(''));} ?>" method="post">
                <table width="100%" cellpadding="0" cellspacing="0" border="0" class="gTable">
                    <tr>
                        <td class="leftTd alignRight fsize14 c-92 w93 ">试卷类型名称</td>
                        <td class="rightTd alignLife">
                            <input type="typeName"class="inputText bRadius5 w400" name="typeName" value="<?php if(isset($papertype)) echo $papertype['typeName'] ;?>">
                        </td>
                    </tr>
                    <tr>
                        <td class="leftTd alignRight fsize14 c-92 w93">是否显示</td>
                        <td class="rightTd alignLife">
                            <input name="isdisplay" type="checkbox" value="<?php if(isset($papertype['isdisplay'])){echo $papertype['isdisplay'];}else{echo "1";} ?>>"
                                 class="bind-checkbox-style" style="display:none;"<?php  if(isset($papertype['isdisplay'])&&$papertype['isdisplay']=='1'){echo "checked";} ?>>
                        </td>
                    </tr>
                    <tr>
                        <td class="leftTd alignRight fsize14 c-92 w93 verAlignTop ">描述</td>
                        <td class="rightTd alignLife">
                            <textarea cols="20"rows="2" class="inputText bRadius5 w400" name="intro" style="height: 150px;"><?php if(isset($papertype)) echo $papertype['intro'] ;?></textarea>
                        </td>
                    </tr>




                    <tr>
                        <td class="leftTd alignRight fsize14 c-92 w93 verAlignTop">排序号</td>

                        <td class="rightTd alignLife">
                            <label>
                                <span class="sBox fsize14 c-92 fl mr10">
                                <input type="number" class="inputText bRadius5 w400" name="orderid" value="<?php if(isset($papertype)) echo $papertype['orderid'] ;?>">
                                <span class="block c-c6 mt10">序号越小排在越前面</span></span>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td class="leftTd alignRight w93"></td>
                        <td class="rightTd alignLife"><input type="submit" class="generalBtn c-fff fsize16 bRadius5" value="确认" name="confirm">

                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<script>

  $(function(){
	//优化复选框 0未选 1选中
	$('.bind-checkbox-style').each(function() {
		if($(this).is(':checked')==true){

			$(this).before('<div class="checkbox-style checkbox-style-on" data-flag="1"><i></i></div>');
		}else{
			$(this).before('<div class="checkbox-style" data-flag="0"><i></i></div>');
		};
	});
	
	$('.checkbox-style').on('click',function(){
		var flagId = $(this).attr('data-flag');
		if(flagId==0){
			$(this).addClass('checkbox-style-on');
			$(this).next('.bind-checkbox-style').attr('checked',true);
			$(this).attr('data-flag',1);
			$(this).next('.bind-checkbox-style').val(1);
		}else{
			$(this).removeClass('checkbox-style-on');
			$(this).next('.bind-checkbox-style').attr('checked',false);
			$(this).attr('data-flag',0);
			$(this).next('.bind-checkbox-style').val(0);
		};
	});					
});
</script>
</script>
</body>
</html>
