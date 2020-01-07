<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<meta name="renderer" content="webkit">
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/live.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
 <script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>   
<title>上课信息</title>
</head>
<style>
	.ks-borde td{border:0;text-align: left;width: 10%;}
	.emptycss {text-indent: 0;}
</style>
<body  class="ks-wrap" >
         <div id="ksBoxHead">
		
		</div>	     
                 <table width="100%" cellpadding="0" cellspacing="0" border="0" class="ks-table ks-borde">                     
                         <?php if($live){ ?>                                 
                        <tr>   
	                       	 <td>房间名称:<?php echo $live['channlName'] ?></td>
	                         <td>主讲老师:<?php if(isset($speakerName)){echo  $speakerName;}else{ echo '请添加课程主讲老师，否则将无法直播';} ?></td>
	                        
						</tr>
						
                     
                         <tr>
                        	<td>密码:<?php echo $live['password']; ?></td>
                        	<td>助教讲师:<?php  foreach($values as $k=>$v){  if($k !=0){  ?>
                                		
                                		<a href="<?php echo M_URL('Assistant','login',$v['userid'],GP('secretKey-'.$v['secretKey'],true));?>" target="view_blank">
                                			<span><?php if(empty($v['name'])){echo $v['username'];}else{echo $v['name'];} ?></span>&nbsp;&nbsp;</a>
                                		
                                		<?php  } }?>	
                            </td>
                           
                        </tr>
                        
                        <tr>
                        	 <td>房间账号:<?php echo $live['channlName']; ?></td>
                        	 <td>
                        		助教登录地址: <input type="text"  class="form-textbox w200" id="url" value="http://store.kesion.com/home.html/default/Login/Assistant" />
                        		 <input type="button" onClick="copyUrl2()" class="ks-bt bt-pue" value="点击复制代码"  style="float: none;display: inline-block;"/>
                        	</td>
                        	
                        </tr>                        
                         <?php }else{ ?>
                       <div class="emptycss">暂无直播课时，请先<a class="ks-bt bt-pue" onclick="loactionClose()" href="<?php echo M_URL($this->AppName.'/Index','period',$this->courseid,GP('')) ?>" style="float:none;display: inline-block;margin-left: 10px;" >排课</a></div>
                         <?php } ?>	 
                        </table>
                        
                        
                           
                       
                </form>
             <div class="myform-box clearfix" id="ksBoxFooter" >   </div>    
                
</body>
</html>
<script src="<?php echo UOOT;?>Public/common/js/common.js" type="text/javascript"></script>
<script>
function copyUrl2()
{
	 var Url2=document.getElementById("url");
	 Url2.select(); // 选择对象
	 document.execCommand("Copy"); // 执行浏览器复制命令
	 Alert("助教登录地址 已复制好");
 }
 function loactionClose(){

	top.closePopup(window.name );
 	top.frames['main'].location.href  = "<?php echo M_URL($this->AppName.'/Index','period',$this->courseid,GP('')) ?>";
 }
 </script>
