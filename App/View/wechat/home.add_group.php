<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="renderer" content="webkit">
 <link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/live.css?<?php echoHash(); ?>" rel="stylesheet" />
 <script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>   
<title>无标题文档</title>
</head>

<body>
               <form target="hidframe"  action="<?php {echo M_URL($this->AppName.'/Index','doEditGroup',$value['id'],GP(""));} ?>" method="post" class="form-horizontal">
                                  <table width="100%" cellpadding="0" cellspacing="0" border="0" class="gTable">                     

                         <tr>
                           <td class="leftTd alignRight fsize16 c-79 w150">OpenID</td>
                         <td class="rightTd alignLife"><?php echo $value['openid'] ?></td>
						</tr>
                        <tr>
                            <td class="leftTd alignRight fsize16 c-79 w150">备注名称</td>
                            <td class="rightTd alignLife"><input type="text" name="groupname" class="inputText bRadius5 w400 c-79" value="<?php if(isset($value)) echo $value["remark"]; ?>" ></td>
                        </tr>
                                      <td class="leftTd alignRight w150"></td>
                          <td class="rightTd alignLife">
                        <input type="submit" class="generalBtn c-fff fsize16 bRadius5" value="确认" name="confirm">
                        </td>
                        </tr>
                        </table>
                </form>
                  <?php echo NoC($value);?>
</body>
</html>