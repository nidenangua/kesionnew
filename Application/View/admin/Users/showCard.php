<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns="http://www.w3.org/1999/html">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<link rel="shortcut icon" href="favicon.ico">
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<style>
	.fn{float: none;}
	.info-ul{}
	.info-ul ul{ padding-top: 20px;}
	.info-ul li{font-size: 16px;margin-bottom: 20px; text-align: center;}
	.info-ul li input{border: #E5E5E5 1px solid;border-radius: 3px;height:35px; width: 300px;margin-left:10px;padding-left: 10px;box-sizing: border-box;}
</style>
<body>
	<div class="info-ul">
		<ul style="margin-left: 50px">
            <li style="height: 40px">
                <label>头像：</label><img style="width: 50px;height:50px;margin-right:483px;" src="<?php echo $data['head']?>"/>
            </li></br>
			<li>
               <label>用户名：<input name="domain" value="<?php echo $data['username']?>"> </label>
            </li></br>
            <li>
                <label>手机号：<input name="domain" value="<?php echo $data['username']?>"></label>
            </li></br>
            <li>
                <label>类型：<?php if ($data['usertype'] == 0){echo '学员';}elseif ($data['usertype']==1){echo '老师';}elseif ($data['usertype'] == 2){echo '机构';}?></label>
            </li></br>
            <li>
                <label>简介：<?php echo $data['text_intro']?></label>
            </li></br>
            <li>
                <label>头衔：<?php echo $data['title_tag']?></label>
            </li></br>
            <li>
                <label>微信号：<?php echo $data['title_tag']?></label>
            </li></br>
            <li>
                <label>公司：<?php echo $data['company']?></label>
            </li></br>
            <li>
                <label>详细地址：<?php echo $data['position']?></label>
            </li></br>
            <li>
                <label>教龄：<?php echo $data['age']?></label>
            </li></br>
		</ul>
	</div>
</body>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
</html>



