<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>添加应用</title>
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/reset.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/common/css/laydate.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/html5.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/news/newstyle.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<body class="gray-bg">
<form target="hidframe" method="post" action="<?php echo UOOT;?>admin.php/home/Setting/updateBase" class="form-horizontal" enctype="multipart/form-data">
<div class="row">
<div id="manage_top" class="menu_top_fixed  p15 height73">
    <div class="ibox-title">
        <h3 class="fl">
        	&nbsp;&nbsp;&nbsp;&nbsp;平台配置&nbsp;&nbsp;&nbsp;&nbsp;
        	<ul id="tablist">
        		<li class="active">基本信息配置</li>
        		<li>邮件配置</li>
        		<li>上传&结算</li>
        		<li>短信配置</li>
        		<li>会员选项</li>
        		<li>点播&直播</li>
        	</ul>
        </h3>
        <div class="fr">
             <div class="fl ks-top-search">
			 <!--搜索-->
				<button class="ks-bt bt-def"><i class="iconfont icon-fanhui"></i>返回</button>
			 <!--搜索-->
			</div>  
        </div>
    </div>
</div>
</div></form>
<br />
<br />
<br />
<div id="ksBoxContent" style="background:#FFFFFF;border-radius: 10px;">
<form target="hidframe"  method="post" target="hidframe"  action="<?php echo M_URL('Setting','savePlatSetting') ?>" class="form-horizontal" enctype="multipart/form-data">
<!--基本信息配置-->
<div class="Created-push" id="active">
		<ul>
			<li>
				<div class="Created-largetTitle">
					<span>1</span>
					<div class="Created-title">
						<span>基本信息</span>
						<span>(可修改部分)</span>
					</div>
				</div>
				<div class="form-box form-upload-box">
					<div class="Created-ing">
					<ul>
						<li>
							<input name="id" type="hidden" value=""/>
							<h4>站点名称:</h4>
							<div class="Created-Content">
								<input type="text" class="long-text" name="sitename" id="sitename" value="<?php KS_Echo($site["sitename"]); ?>">
							</div>
						</li>
						
						<li>
							<h4>域名:</h4>
							<div class="Created-Content">
								<input type="text" class="long-text" name="domain" id="domain" value="<?php KS_Echo($site["domain"]); ?>">						
							</div>
						</li>

						<li>
							<h4>js脚本hash值:</h4>
							<div class="Created-Content">
								<input type="text" class="long-text" name="jshash" id="jshash" value="<?php KS_Echo($site["jshash"]); ?>">						
							</div>
						</li>

						<li>
							<h4>logo:</h4>
							<div class="Created-Content">
								<span  class="btn-Pblue">上传logo<input type="file" name="logo" id="upImg"/></span>
								<p>限制：2MB,支持jpg|png|gif</p>					
							</div>
						</li>
						<li>
							<h4></h4>
							<div class="Created-Content erweima">
								<img src="<?php echo UOOT;?>Public/uploads/<?php if(!empty($info["weixinqr"])){echo Img($info["weixinqr"]);}else{ echo "common/wxqr.png" ;} ?>" alt="" />					
							</div>
						</li>
						<li><br /><br /></li>
					</ul>
				</div>
				</div>
			</li>
		</ul>
	</div>
	<!--邮件配置-->
	<div class="Created-push">
		<ul>
			<li>
				<div class="Created-largetTitle">
					<span>2</span>
					<div class="Created-title"><span>(可修改部分)</span></div>
				</div>
				<div class="form-box form-upload-box">
					<div class="Created-ing">
					<ul>
						<li>
							<h4>SMTP服务器:</h4>
							<div class="Created-Content">
								<input type="text" class="long-text" name="emailServer" required id="emailServer" value="<?php KS_Echo($site["emailServer"]); ?>">						
							</div>
						</li>
						<li>
							<h4>SMTP端口号:</h4>
							<div class="Created-Content">
								<input type="text" class="long-text" required name="emailPort" id="emailPort" value="<?php KS_Echo($site["emailPort"]); ?>">							
							</div>
						</li>
						<li>
							<h4>发件人邮箱:</h4>
							<div class="Created-Content">
								<input type="text" class="long-text" required name="emailSender" id="emailSender" value="<?php KS_Echo($site["emailSender"]); ?>">						
							</div>
						</li>
						<li>
							<h4>发件用户名:</h4>
							<div class="Created-Content">
								<input type="text" class="long-text" name="emailUser" required id="emailUser" value="<?php KS_Echo($site["emailUser"]); ?>">					
							</div>
						</li>
						<li>
							<h4>登录密码:</h4>
							<div class="Created-Content clearfix">
								<input type="text" class="long-text" required name="emailPassword"  id="emailPassword" value="<?php KS_Echo($site["emailPassword"]); ?>">							
							
							</div>
						</li>
						<li>
							<h4>接收人邮箱:</h4>
							<div class="Created-Content clearfix">                                                                                                                                           
								<input type="text" class="form-control" id="test_mail_address" style="width: 172px;"><button type="button" class="btn btn-w-m mt10 btn-primary" onclick="sendTestEmail()" style="height: 38px;">发送测试邮件</button>				
							</div>
						</li>
						<li><br /><br /></li>
					</ul>
				</div>
				</div>
			</li>
		</ul> 
	</div>
	<!--上传结算-->
	<div class="Created-push">
		<ul>
			<li>
				<div class="Created-largetTitle">
					<span>3</span>
					<div class="Created-title">
						<span>上传项</span>
						<span>(可修改部分)</span>
					</div>
				</div>
				<div class="form-box form-upload-box">
					<div class="Created-ing">
					<ul class="chang-width">
						<li>
							<h4>平台订单佣金:</h4>
							<div class="Created-Content">
								小于等于&nbsp;<input type="text" id="sumincome"  required name="sumincome" <?php if(isset($site["sumincome"]))echo "value='$site[sumincome]'";  ?>>元
								&nbsp;收&nbsp;<input type="text" id="collection" required name="collection" <?php if(isset($site["collection"]))echo "value='$site[collection]'";  ?>>%					
							</div>
						</li>
						<li>
							<h4>&nbsp;</h4>
							<div class="Created-Content">
								小于等于&nbsp;<input type="text" id="sumincome"  required name="sumincome1" <?php if(isset($site["sumincome1"]))echo "value='$site[sumincome1]'";  ?>>元
								&nbsp;收&nbsp;<input type="text" id="collection"  required name="collection1" <?php if(isset($site["collection1"]))echo "value='$site[collection1]'";  ?>>%					
							</div>
						</li>
						<li>
							<h4>&nbsp;</h4>
							<div class="Created-Content">
								大于&nbsp;<input style="margin-left: 24px" type="text" id="sumincome" required name="sumincome2" <?php if(isset($site["sumincome2"]))echo "value='$site[sumincome2]'";  ?>>元
								&nbsp;收&nbsp;<input type="text" id="collection" required name="collection2" <?php if(isset($site["collection2"]))echo "value='$site[collection2]'";  ?>>%					
							</div>
						</li>
						<li>
							<h4>平台推广金</h4>
							<div class="Created-Content">
								名师&nbsp;<input type="text" id="collection"  required name="salesincome1" <?php if(isset($site["salesincome1"]))echo "value='$site[salesincome1]'";  ?>>%					
							</div>
						</li> 
						<li>
							<h4>&nbsp;</h4>
							<div class="Created-Content">
								机构&nbsp;<input type="text" id="collection" required name="salesincome2"" <?php if(isset($site["salesincome2"]))echo "value='$site[salesincome2]'";  ?>>%					
							</div>
						</li>  
					
						<li>
							<h4>平台提现条件:</h4>
							<div class="Created-Content">
								通用版：每月限提次数&nbsp;<input type="text" required name="withdrawnum" <?php if(isset($site["withdrawnum"]))echo "value='$site[withdrawnum]'";  ?>>次
								&nbsp;每次至少&nbsp;<input type="text" id="withdrawmoney" required name="withdrawmoney" <?php if(isset($site["withdrawmoney"]))echo "value='$site[withdrawmoney]'";  ?>>元
								&nbsp;第三方手续费(微信)&nbsp;<input type="text" id="poundage" required name="poundage" <?php if(isset($site["poundage"]))echo "value='$site[poundage]'";?>>%
							</div>
						</li>
						<li>
							<h4>&nbsp;</h4>
							<div class="Created-Content">
								VIP版：每月限提次数&nbsp;<input type="text" required name="withdrawnum1" <?php if(isset($site["withdrawnum1"]))echo "value='$site[withdrawnum1]'";  ?>>次
								&nbsp;每次至少&nbsp;<input type="text" id="withdrawmoney1" required name="withdrawmoney1" <?php if(isset($site["withdrawmoney1"]))echo "value='$site[withdrawmoney1]'";  ?>>元
								&nbsp;第三方手续费(微信)&nbsp;<input type="text" id="poundage1" required name="poundage1" <?php if(isset($site["poundage1"]))echo "value='$site[poundage1]'";?>>%
							</div>
						</li>
						 <script>                                                                
						 $("#withdrawmoney").keyup(function () {                                 
						     var reg = $(this).val().match(/\d+\.?\d{0,2}/);var txt = '';        
						     if (reg != null) {txt = reg[0];}                                    
						     $(this).val(txt);                                                   
						 }).change(function () {                                                 
						     $(this).keyup();                                                    
						 });	    	                                                            
 						</script> 
						<br/>
						<li>
							<h4>默认允许上传的文件大小:</h4>
							<div class="Created-Content">
								<input type="number" class="long-text" required name="uploadSize" <?php if(isset($site["uploadSize"]))echo "value='$site[uploadSize]'";  ?> >						
							</div>
						</li>
						<li>
							<h4>默认允许上传文件类型:</h4>
							<div class="Created-Content">
								<input type="text" class="long-text" name="uploadExts" <?php if(isset($site["uploadExts"]))echo "value='$site[uploadExts]'";  ?>>						
							</div>
						</li>
						<li>
							<input name="id" type="hidden" value=""/>
							<h4>上传文件保存路径:</h4>
							<div class="Created-Content">
								<input type="url" class="long-text" name="uploadPath" <?php if(isset($site["uploadPath"]))echo "value='$site[uploadPath]'";  ?>>						
							</div>
						</li>
						<li>
							<h4>少于多少条短信提醒:</h4>
							<div class="Created-Content">
								<input type="number"  required name="smsremind1" <?php if(isset($site["smsremind1"]))echo "value='$site[smsremind1]'";  ?>> 
								<input type="number" required name="smsremind2" <?php if(isset($site["smsremind2"]))echo "value='$site[smsremind2]'";  ?>> 
								<input type="number"  required name="smsremind3" <?php if(isset($site["smsremind3"]))echo "value='$site[smsremind3]'";  ?>> 			
							</div>
						</li>
						<li>
							<h4>少于多少条邮件提醒:</h4>
							<div class="Created-Content">
								<input type="number" required name="emailremind1" <?php if(isset($site["emailremind1"]))echo "value='$site[emailremind1]'";  ?>> 
								<input type="number" required name="emailremind2" <?php if(isset($site["emailremind2"]))echo "value='$site[emailremind2]'";  ?>> 
								<input type="number"  required name="emailremind3" <?php if(isset($site["emailremind3"]))echo "value='$site[emailremind3]'";  ?>> 					
							</div>
						</li>
						<li>
							<h4>短信计费字数:</h4>
							<div class="Created-Content">
								<input type="text"  class="long-text" required name="smswordnumber" <?php if(isset($site["smswordnumber"]))echo "value='$site[smswordnumber]'";  ?>>						
							</div>
						</li>
						
						<li><br /><br /></li>
					</ul>
				</div>
				</div>
			</li>
		</ul> 
	</div>
	<!--短信配置-->
	<div class="Created-push">
		<ul>
			<li>
				<div class="Created-largetTitle">
					<span>4</span>
					<div class="Created-title">
						<span>短信项</span>
						<span>(可修改部分)</span>
					</div>
				</div>
				<div class="form-box ">
					<div class="Created-ing">
					<ul>
						<li>
							<h4>是否启用短信:</h4>
							<div class="Created-Content">
								 <div class="radio radio-info radio-inline">                                                                                                                                                  
								     <input name="messageState" id="inlineRadio1" required type="radio"  <?php if($site["messageState"] == 1)echo  'checked="checked"' ?> value="1" /><label for="inlineRadio1"> 启用 </label>  
								 </div>                                                                                                                                                                                       
								 <div class="radio radio-info  radio-inline">                                                                                                                                                 
								     <input name="messageState" id="inlineRadio2" required type="radio" <?php if($site["messageState"] == 0)echo 'checked="checked"' ?> value="0" /><label for="inlineRadio2"> 不启用 </label>   
								 </div>                                                                                                                                                                                       				
							</div>
						</li>
						<div id="messageInfo" a="<?php echo $site["messageState"]; ?>" style="display:none">   
						<li>
							<h4>短信账号:</h4>
							<div class="Created-Content">
								<input type="text" class="long-text" name="messageUser" id="messageUser" <?php if(isset($site["messageUser"]))echo "value='$site[messageUser]'";  ?>>						
							</div>
						</li>
						<li>
							<h4>短信密码:</h4>
							<div class="Created-Content">
								<input type="text" class="long-text" minlength='5' required="required" name="messagePass" id="messagePass" <?php if(isset($site["messagePass"]))echo "value='$site[messagePass]'";  ?>>						
							</div>
						</li>
						<li>
							<input name="id" type="hidden" value=""/>
							<h4>加密方式:</h4>
							<div class="Created-Content">
								<select name="messagePassEncrypt" class="form-control" id="messagePassEncrypt">
		                            <option <?php if($site["messagePassEncrypt"] == "0")echo 'selected="selected"' ?> value="0">无需加密</option>
		                            <option <?php if($site["messagePassEncrypt"] == "16")echo 'selected="selected"' ?> value="16">md5(16位)</option>
		                            <option <?php if($site["messagePassEncrypt"] == "32")echo 'selected="selected"' ?> value="32">md5(32位)</option>
		                        </select>
							</div>
						</li>
						<li>
							<h4>短信发送接口地址:</h4>
							<div class="Created-Content clearfix">
								<input type="text" class="long-text" name="messageInter" id="messageInter" <?php if(isset($site["messageInter"]))echo "value='$site[messageInter]'";  ?> />	
								<span>发送返回标志：</span>
								<input type="text" name="messageSuccess" id="messageSuccess" <?php if(isset($site["messageSuccess"]))echo "value='$site[messageSuccess]''";  ?> />
							</div>
						</li>
						<li>
							<h4>接口使用编码:</h4>
							<div class="Created-Content clearfix">
								<select  class="form-control" name="messageCode" id="">
		                            <option <?php if($site["messageCode"] =="gbk")echo 'selected="selected"' ?> value="gbk">gbk</option>
		                            <option <?php if($site["messageCode"] =="utf-8")echo 'selected="selected"' ?> value="utf-8">utf-8</option>
		                        </select>
							</div>
						</li>
						<li>
							<h4>查询余额接口:</h4>
							<div class="Created-Content clearfix">
								<input type="text" style="width: 200px;" name="messageBalance" id="messageBalance" <?php if(isset($site["messageBalance"]))echo "value='$site[messageBalance]'";  ?> />
								<span>查询返回开始标志：</span>
								<input type="text" style="width: 200px;" name="messageBalanceBegin" id="messageBalanceBegin" <?php if(isset($site["messageBalanceBegin"]))echo "value='$site[messageBalanceBegin]'";  ?>/>
								<span>查询返回结束标志：</span>
								<input type="text" style="width: 200px;" name="messageBalanceEnd" id="messageBalanceEnd" <?php if(isset($site["messageBalance"]))echo "value='$site[messageBalanceEnd]'";  ?>/>
								<span class="bt-pue chayue" onclick="getBalance()">查询余额</span><span id="SmsBalance"></span>
							</div>
						</li>
						<li>
							<h4>短信签名:</h4>
							<div class="Created-Content clearfix">
								<input type="text" class="long-text" name="smsSignature" id="smsSignature" <?php if(isset($site["smsSignature"]))echo "value='$site[smsSignature]'";  ?>/><span>发送间隔时间：</span><input type="text" name="smsTime" id="smsTime" <?php if(isset($site["smsTime"]))echo "value='$site[smsTime]'";  ?>/> 秒
							</div>
						</li>
						<li>
							<h4>接收人手机号:</h4>
							<div class="Created-Content clearfix">
								<input type="text" class="long-text" id="test_message_number"/><span class="bt-pue chayue" onclick="SendEx()" style="margin-top:10px">发送测试短信</span>
							</div>
						</li>
						<li>
							<br />
							<br />
						</li>
						</div>
					</ul>
				</div>
				</div>
			</li>
		</ul> 
	</div>
	<!--会员选项-->
	<div class="Created-push">
		<ul>
			<li>
				<div class="Created-largetTitle">
					<span>5</span>
					<div class="Created-title">
						<span>会员项</span>
						<span>(可修改部分)</span>
					</div>
				</div>
				<div class="form-box form-upload-box">
					<div class="Created-ing">
					<ul>
						<li>
							<h4>注册是否需要审核:</h4>
							<div class="Created-Content clearfix">
								<label for="" class="mr20">
									<input id="reviewTeacher" type="checkbox" value="1" <?php if(isset($site)){if($site['reviewTeacher']==1){echo "checked";} } ?> name="reviewTeacher">
									<label for="reviewTeacher">教师</label>
								</label>
								<label for="" class="mr20">
									<input id="reviewSchool" type="checkbox" value="1" <?php if(isset($site)){if($site['reviewSchool']==1){echo "checked";} } ?> name="reviewSchool">
									<label for="reviewSchool">机构</label>
								</label>
								<label for="" class="mr20">
									<input id="reviewMember" type="checkbox" value="1" <?php if(isset($site)){if($site['reviewMember']==1){echo "checked";} } ?> name="reviewMember">
									<label for="reviewMember">学员</label>
								</label>				
							</div>
						</li>
						<li>
							<h4>手机绑定多用户:</h4>
							<div class="Created-Content clearfix">
								 <div class="radio radio-info radio-inline">
				                    <input name="mbings" id="mbings1" required type="radio"  <?php if($site["mbings"] == 1)echo  'checked="checked"' ?> value="1" /><label for="mbings1"> 是 </label>
				                </div>
				                <div class="radio radio-info  radio-inline">
				                    <input name="mbings" id="mbings2" required type="radio" <?php if($site["mbings"] == 0)echo 'checked="checked"' ?> value="0" /><label for="mbings2"> 否 </label>
				                </div>					
							</div>
						</li>
						<li>
							<h4>邮箱绑定多用户:</h4>
							<div class="Created-Content clearfix">
								<div class="radio radio-info radio-inline">
				                    <input name="ebings" id="ebings1" required type="radio"  <?php if($site["ebings"] == 1)echo  'checked="checked"' ?> value="1" /><label for="ebings1"> 是 </label>
				                </div>
				                <div class="radio radio-info  radio-inline">
				                    <input name="ebings" id="ebings2" required type="radio" <?php if($site["ebings"] == 0)echo 'checked="checked"' ?> value="0" /><label for="ebings2"> 否 </label>
				                </div>				
							</div>
						</li>
						<li>
							<h4>注册后直接登录:</h4>
							<div class="Created-Content clearfix">
								<div class="radio radio-info radio-inline">
			                        <input name="registerlogin" id="registerlogin1" required type="radio"  <?php if($site["registerlogin"] == 1)echo  'checked="checked"' ?> value="1" /><label for="registerlogin1"> 是 </label>
			                    </div>
			                    <div class="radio radio-info  radio-inline">
			                        <input name="registerlogin" id="registerlogin2" required type="radio" <?php if($site["registerlogin"] == 0)echo 'checked="checked"' ?> value="0" /><label for="registerlogin2"> 否 </label>
			                    </div>				
							</div>
						</li>
						<li>
							<h4>开通点播是否实名:</h4>
							<div class="Created-Content clearfix">
								<div class="radio radio-info radio-inline">
			                        <input name="isrealname" id="isrealname1" required type="radio"  <?php if($site["isrealname"] == 1)echo  'checked="checked"' ?> value="1" /><label for="isrealname1"> 是 </label>
			                    </div>
			                    <div class="radio radio-info  radio-inline">
			                        <input name="isrealname" id="isrealname2" required type="radio" <?php if($site["isrealname"] == 0)echo 'checked="checked"' ?> value="0" /><label for="isrealname2"> 否 </label>
			                    </div>			
							</div>
						</li>
						<li>
							<h4>注册后初始邮箱模板:</h4>
							<div class="Created-Content clearfix">
								<div class="radio radio-info radio-inline">
			                        <input name="initialemailmodel" id="initialemailmodel1" required type="radio"  <?php if($site["initialemailmodel"] == 1)echo  'checked="checked"' ?> value="1" /><label for="initialemailmodel1"> 是 </label>
			                    </div>
			                    <div class="radio radio-info  radio-inline">
			                        <input name="initialemailmodel" id="initialemailmodel2" required type="radio" <?php if($site["initialemailmodel"] == 0)echo 'checked="checked"' ?> value="0" /><label for="initialemailmodel2"> 否 </label>
			                    </div>
													
							</div>
						</li>
						<li>
							<h4>注册后初短信模板:</h4>
							<div class="Created-Content clearfix">
								<div class="radio radio-info radio-inline">
			                        <input name="initialsmsmodel" id="initialsmsmodel1" required type="radio"  <?php if($site["initialsmsmodel"] == 1)echo  'checked="checked"' ?> value="1" /><label for="initialsmsmodel1"> 是 </label>
			                    </div>
			                    <div class="radio radio-info  radio-inline">
			                        <input name="initialsmsmodel" id="initialsmsmodel2" required type="radio" <?php if($site["initialsmsmodel"] == 0)echo 'checked="checked"' ?> value="0" /><label for="initialsmsmodel2"> 否 </label>
			                    </div>					
							</div>
						</li>
						<li>
							<h4>注册后初始站内信模板:</h4>
							<div class="Created-Content clearfix">
								<div class="radio radio-info radio-inline">
			                        <input name="initialmassage" id="initialmassage1" required type="radio"  <?php if($site["initialmassage"] == 1)echo  'checked="checked"'; ?> value="1" /><label for="initialmassage1"> 是 </label>
			                    </div>
			                    <div class="radio radio-info  radio-inline">
			                        <input name="initialmassage" id="initialmassage2" required type="radio" <?php if($site["initialmassage"] == 0)echo 'checked="checked"'; ?> value="0" /><label for="initialmassage2"> 否 </label>
			                    </div>					
							</div>
						</li>
						<li>
							<h4>注册时是否填网站名称:</h4>
							<div class="Created-Content clearfix">
								<div class="radio radio-info radio-inline">
			                        <input name="regsitename" id="regsitename1" required type="radio"  <?php if($site["regsitename"] == 1)echo  'checked="checked"'; ?> value="1" /><label for="regsitename1"> 是 </label>
			                    </div>
			                    <div class="radio radio-info  radio-inline">
			                        <input name="regsitename" id="regsitename2" required type="radio" <?php if($site["regsitename"] == 0)echo 'checked="checked"'; ?> value="0" /><label for="regsitename2"> 否 </label>
			                    </div>					
							</div>
						</li>
						<li>
							<h4>注册后强制关注公众号:</h4>
							<div class="Created-Content clearfix">
								<div class="radio radio-info radio-inline">
                                  <input name="registerinfo" id="registerinfo1" required type="radio" <?php if($site["registerinfo"] == 1)echo  'checked="checked"' ?> value="1" /><label for="registerinfo1"> 是 </label>
			                    </div>
			                    <div class="radio radio-info  radio-inline">
                                  <input name="registerinfo" id="registerinfo2" required type="radio" <?php if($site["registerinfo"] == 0)echo 'checked="checked"' ?> value="0" /><label for="registerinfo2"> 否 </label>
			                    </div>					
							</div>
						</li>
					</ul>
				</div>
				</div>
			</li>
		</ul> 
	</div>
	<!--点播&直播-->
	<div class="Created-push">
		<ul>
			<li>
				<div class="Created-largetTitle">
					<span>6</span>
					<div class="Created-title">
						<span>点播/直播配置配置</span>
						<span>(可修改部分)</span>
					</div>
				</div>
				<div class="form-box form-upload-box">
					<div class="Created-ing">
					<ul>
						<li>
							<h2>点播配置</h2>
							<div class="Created-Content">
								
							</div>
						</li>
						
						<li>
							<h4>赠送代金券:</h4>
							<div class="Created-Content">
								<input type="text" class="long-text" name="vodmoney" id="sitename"  <?php if(isset($site["vodmoney"]))echo "value='$site[vodmoney]'";  ?>>元						
							</div>
						</li>
						<li>
							<h4>初始存储空间:</h4>
							<div class="Created-Content">
								<input type="text" class="long-text" name="vodspace" id="sitename"  <?php if(isset($site["vodspace"]))echo "value='$site[vodspace]'";  ?>>G						
							</div>
						</li>
						<li>
							<h4>存储单价:</h4>
							<div class="Created-Content">
								<input type="text" class="long-text" name="storageprice" id="sitename"  <?php if(isset($site["storageprice"]))echo "value='$site[storageprice]'";  ?>>G（每日/G）						
							</div>
						</li>
						<li>
							<h4>流量单价:</h4>
							<div class="Created-Content">
								<input type="text" class="long-text" name="flowprice" id="sitename"  <?php if(isset($site["flowprice"]))echo "value='$site[flowprice]'";  ?>>元（/G）						
							</div>
						</li>
						<li>
							<h4>结算频率:</h4>
							<div class="Created-Content">
								<input type="text" class="long-text" name="vodfrequency" id="sitename"  <?php if(isset($site["vodfrequency"]))echo "value='$site[vodfrequency]'";  ?>>次 （每日）					
							</div>
						</li>
						<li>
							<h2>直播配置</h2>
							<div class="Created-Content">
								
							</div>
						</li>
						<li>
							<h4>赠送代金券:</h4>
							<div class="Created-Content">
								<input type="text" class="long-text" name="livemoney" id="sitename"  <?php if(isset($site["livemoney"]))echo "value='$site[livemoney]'";  ?>>元					
							</div>
						</li>
						<li>
							<h4>流量单价:</h4>
							<div class="Created-Content">
								<input type="text" class="long-text" name="liveflowprice" id="sitename"  <?php if(isset($site["liveflowprice"]))echo "value='$site[liveflowprice]'";  ?>>元（/G）				
							</div>
						</li>
						<li>
							<h4>结算频率:</h4>
							<div class="Created-Content">
								<input type="text" class="long-text" name="livevodfrequency" id="sitename"  <?php if(isset($site["livevodfrequency"]))echo "value='$site[livevodfrequency]'";  ?>>次 （每日）					
							</div>
						</li>
					</ul>
				</div>
				</div>
			</li>
		</ul>
	</div>
	<div class="footer-page h60">
			<div class="col-sm-5"></div>
			<div class="col-sm-7 mt10">
	            <button type="submit" class="btn btn-primary btn-s-md bt-pue">确定修改</button>
	            <a href="javascript:history.go(-1);" class="btn bt-gray btn-s-md">取消修改</a> 
            </div>
    </div>
	</form>
</div>	
<div id="ksBoxFooter" style="height: 120px;"></div>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
</body>
<script type="text/javascript">
	$("#tablist li").click(function(){
		$("#tablist li").removeClass("active"); 
		$(this).addClass("active");
		var index = $(this).index();
		$(".Created-push").removeAttr("id")
		console.log(index);
		$(".Created-push").eq(index).attr("id","active");
	})
</script>
<script>
 $(function(){
	//短信不启用隐藏信息
	var a = $("#messageInfo").attr('a');
	if(a == 0){
		$("#messageInfo").hide();
	}else{
		$("#messageInfo").show();
	} 
	loadScorllJs();//滚轮	
	taps();
	uploadView('100','100');	
});
//短信不启用隐藏信息
$(":radio").click(function(){
	var a =$(this).val();
	if(a == 0){
		$("#messageInfo").hide();
	}else{
		$("#messageInfo").show();
	}
});
</script>
</html>
<!--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<link rel="shortcut icon" href="favicon.ico">
<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<body class="gray-bg">
<div class="wrapper" style="margin-top:35px">
<form target="hidframe"  method="post" target="hidframe"  action="<?php echo M_URL('Setting','updateBase') ?>" class="form-horizontal" enctype="multipart/form-data">
<div class="row">
<div id="manage_top" class="menu_top_fixed  p15 height73" >
    <div class="ibox-title">
        <h3 class="fl">平台配置
        <ul id="tablist">
    		
    		<li class="active">基本信息</li>
    		<li class="">选填项</li>
    	</ul>
        </h3>
        
        <div class="ibox-tools">
            <a href="javascript:void(0)" onclick="history.go(0)" class="collapse-link"><i class="reflash"></i></a>
        </div>
    </div>
</div>
<div class="col-sm-12"><br /><br />
<div class="tabs-container" style="padding-top:5px">
    <ul class="nav nav-tabs">
        <li class="active"><a> 基本信息配置</a></li>
        <li class=""><a>邮件配置</a></li>
        <li class=""><a>上传&结算</a></li>
        <li class=""><a>短信配置</a></li>
        <li class=""><a>会员选项</a></li>
        <li class=""><a>点播&直播</a></li>
    </ul>
    <div class="tab-content">
        <div  class="tab-pane active">
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label">站点名称：</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control"   name="sitename" id="sitename"  <?php if(isset($site["sitename"]))echo "value='$site[sitename]'";  ?>>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">域名：</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control"  name="domain" id="domain" <?php if(isset($site["domain"]))echo "value='$site[domain]'";  ?>>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">logo：</label>
                    <div class="col-sm-4">
                        <div class="control-group js_uploadBox">
                            <div class="btn-upload clearfix">
                                <a href="javascript:void(0);" class="selectImageBtn c-89 fsize14 fl mr10 bRadius5"><span class="js_uploadText">上传</span>图片</a>
                                <span class="fl c-d0 fsize12" style="height:37px; line-height:37px;">限制：2MB,支持jpg|png|gif</span>
                                <input class="hide js_upFile" type="file" name="logo" id="upImg">
                            </div>
                            <div class="js_showBox mt10 w180"><img class="js_logoBox block" src="<?php echo UOOT;?>Public/uploads/<?php if(!empty($info["weixinqr"])){echo Img($info["weixinqr"]);}else{ echo "common/wxqr.png" ;} ?>" width="180" ></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div  class="tab-pane">
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label">SMTP服务器：</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control"  name="emailServer" required id="emailServer" <?php if(isset($site["emailServer"]))echo "value='$site[emailServer]'";  ?> >
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">SMTP端口号：</label>
                    <div class="col-sm-4">
                        <input type="number" class="form-control" required name="emailPort" id="emailPort" <?php if(isset($site["emailPort"]))echo "value='$site[emailPort]'";  ?> >
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">发件人邮箱：</label>
                    <div class="col-sm-4">
                        <input type="email" class="form-control" required name="emailSender" id="emailSender" <?php if(isset($site["emailSender"]))echo "value='$site[emailSender]'";  ?>>
                    </div>
                </div>
                          <div class="form-group">
                    <label class="col-sm-2 control-label">发件用户名：</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="emailUser" required id="emailUser" <?php if(isset($site["emailUser"]))echo "value='$site[emailUser]'";  ?>>
                    </div>
                </div>
                         <div class="form-group">
                    <label class="col-sm-2 control-label">登录密码：</label>
                    <div class="col-sm-4">
                        <input type="password" class="form-control" required name="emailPassword"  id="emailPassword" <?php if(isset($site["emailPassword"]))echo "value='$site[emailPassword]'";  ?>>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-sm-2 control-label">接收人邮箱：</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="test_mail_address"><button type="button" class="btn btn-w-m mt10 btn-primary" onclick="sendTestEmail()">发送测试邮件</button>
                    </div>
                </div>
            </div>
        </div>
        <div  class="tab-pane ">
            <div class="panel-body">
            	<div class="form-group">
                    <label class="col-sm-2 control-label">上传配置：</label>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">默认允许上传的文件大小：</label>
                    <div class="col-sm-1">
                        <input type="number" class="form-control" required name="uploadSize" <?php if(isset($site["uploadSize"]))echo "value='$site[uploadSize]'";  ?>>
                    </div>
                    <label class="col-sm-1 control-label " style="text-align:left;margin-left:-15px">KB</label>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">默认允许上传文件类型：</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="uploadExts" <?php if(isset($site["uploadExts"]))echo "value='$site[uploadExts]'";  ?>>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">上传文件保存路径：</label>
                    <div class="col-sm-4">
                        <input type="url" class="form-control" name="uploadPath" <?php if(isset($site["uploadPath"]))echo "value='$site[uploadPath]'";  ?>>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">结算配置：</label>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">每月最多提现次数：</label>
                    <div class="col-sm-1">
                        <input type="number" class="form-control" required name="withdrawnum" <?php if(isset($site["withdrawnum"]))echo "value='$site[withdrawnum]'";  ?>>
                    </div>
                    <label class="col-sm-1 control-label " style="text-align:left;margin-left:-15px">次</label>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">每次最少提现金额：</label>
                    <div class="col-sm-1">
                        <input type="text" id="withdrawmoney" class="form-control" required name="withdrawmoney" <?php if(isset($site["withdrawmoney"]))echo "value='$site[withdrawmoney]'";  ?>>
                    </div>
                    <script>
                    $("#withdrawmoney").keyup(function () {
		                var reg = $(this).val().match(/\d+\.?\d{0,2}/);var txt = '';
		                if (reg != null) {txt = reg[0];}
		                $(this).val(txt);
		            }).change(function () {
		                $(this).keyup();
		            });	    	
                    </script>
                    <label class="col-sm-1 control-label " style="text-align:left;margin-left:-15px">元（人民币）</label>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">少于多少条短信提醒：</label>
                    <div class="col-sm-1">
                        <input type="number" class="form-control" required name="smsremind1" <?php if(isset($site["smsremind1"]))echo "value='$site[smsremind1]'";  ?>>
                        <input type="number" class="form-control" required name="smsremind2" <?php if(isset($site["smsremind2"]))echo "value='$site[smsremind2]'";  ?>>
                        <input type="number" class="form-control" required name="smsremind3" <?php if(isset($site["smsremind3"]))echo "value='$site[smsremind3]'";  ?>>
                    </div>
                    <label class="col-sm-1 control-label " style="text-align:left;margin-left:-15px">条</label>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">少于多少条邮件提醒：</label>
                    <div class="col-sm-1">
                        <input type="number" class="form-control" required name="emailremind1" <?php if(isset($site["emailremind1"]))echo "value='$site[emailremind1]'";  ?>>
                        <input type="number" class="form-control" required name="emailremind2" <?php if(isset($site["emailremind2"]))echo "value='$site[emailremind2]'";  ?>>
                        <input type="number" class="form-control" required name="emailremind3" <?php if(isset($site["emailremind3"]))echo "value='$site[emailremind3]'";  ?>>
                    </div>
                    <label class="col-sm-1 control-label " style="text-align:left;margin-left:-15px">封</label>
                </div>
            </div>
        </div>
        <div  class="tab-pane">
            <div class="panel-body">

                <br />

                  <div class="form-group">
                    <label class="col-sm-2 control-label" style="padding-top:0">是否启用短信：</label>
                    <div class="col-sm-4">
                        <div class="radio radio-info radio-inline">
                            <input name="messageState" id="inlineRadio1" required type="radio"  <?php if($site["messageState"] == 1)echo  'checked="checked"' ?> value="1" /><label for="inlineRadio1"> 启用 </label>
                        </div>
                        <div class="radio radio-info  radio-inline">
                            <input name="messageState" id="inlineRadio2" required type="radio" <?php if($site["messageState"] == 0)echo 'checked="checked"' ?> value="0" /><label for="inlineRadio2"> 不启用 </label>
                        </div>
                    </div>
                </div>
                              <div id="messageInfo" a="<?php echo $site["messageState"]; ?>" style="display:none">
                <div class="form-group">
                    <label class="col-sm-2 control-label">短信账号：</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="messageUser" id="messageUser" <?php if(isset($site["messageUser"]))echo "value='$site[messageUser]'";  ?>>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">短信密码：</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" minlength='5' required="required" name="messagePass" id="messagePass" <?php if(isset($site["messagePass"]))echo "value='$site[messagePass]'";  ?>>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">加密方式：</label>
                    <div class="col-sm-1  ">
                        <select name="messagePassEncrypt" class="form-control" id="messagePassEncrypt">
                            <option <?php if($site["messagePassEncrypt"] == "0")echo 'selected="selected"' ?> value="0">无需加密</option>
                            <option <?php if($site["messagePassEncrypt"] == "16")echo 'selected="selected"' ?> value="16">md5(16位)</option>
                            <option <?php if($site["messagePassEncrypt"] == "32")echo 'selected="selected"' ?> value="32">md5(32位)</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">短信发送接口地址：</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="messageInter" id="messageInter" <?php if(isset($site["messageInter"]))echo "value='$site[messageInter]'";  ?>>
                    </div>
                    <label class=" control-label" style="float:left">发送返回标志：</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="messageSuccess" id="messageSuccess" <?php if(isset($site["messageSuccess"]))echo "value='$site[messageSuccess]''";  ?>>
                    </div>
                </div>

                    <div class="form-group">
                    <label class="col-sm-2 control-label">接口使用编码：</label>
                    <div class="col-sm-1">
                        <select  class="form-control" name="messageCode" id="">
                            <option <?php if($site["messageCode"] =="gbk")echo 'selected="selected"' ?> value="gbk">gbk</option>
                            <option <?php if($site["messageCode"] =="utf-8")echo 'selected="selected"' ?> value="utf-8">utf-8</option>
                        </select>
                    </div>
                </div>
                   <div class="form-group">
                    <label class="col-sm-2 control-label">查询余额接口：</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="messageBalance" id="messageBalance" <?php if(isset($site["messageBalance"]))echo "value='$site[messageBalance]'";  ?>>
                    </div>
                    <label class=" control-label" style="float:left"> 查询返回开始标志：</label>
                    <div class="col-sm-1">
                        <input type="text" class="form-control" name="messageBalanceBegin" id="messageBalanceBegin" <?php if(isset($site["messageBalanceBegin"]))echo "value='$site[messageBalanceBegin]'";  ?>>
                    </div>
                    <label class=" control-label" style="float:left">查询返回结束标志：</label>
                    <div class="col-sm-1">
                        <input type="text" class="form-control" name="messageBalanceEnd" id="messageBalanceEnd" <?php if(isset($site["messageBalance"]))echo "value='$site[messageBalanceEnd]'";  ?>>
                    </div>
                    <button type="button" class="btn btn-primary btn-w-m"  onclick="getBalance()">查询余额</button><span id="SmsBalance"></span>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">短信签名：</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="smsSignature" id="smsSignature" <?php if(isset($site["smsSignature"]))echo "value='$site[smsSignature]'";  ?>>
                    </div>
                    <label class=" control-label" style="float:left">发送间隔时间：</label>
                    <div class="col-sm-2">
                        <input type="number" class="form-control" name="smsTime" id="smsTime" <?php if(isset($site["smsTime"]))echo "value='$site[smsTime]'";  ?>>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">接收人手机号：</label>
                    <div class="col-sm-4" >
                        <input type="text" class="form-control" id="test_message_number"><button type="button" class="btn btn-primary btn-w-m" onclick="SendEx()" style="margin-top:10px">发送测试短信</button>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div  class="tab-pane">
            <div class="panel-body">
            <br />
           <div class="form-group">
                <label class="col-sm-2 control-label" style="padding:0">注册是否需要审核</label>
                <div class="col-sm-6">
                    <div class="checkbox checkbox-info checkbox-inline">
                        <input id="reviewTeacher" type="checkbox" value="1" <?php if(isset($site)){if($site['reviewTeacher']==1){echo "checked";} } ?> name="reviewTeacher">
                        <label for="reviewTeacher">教师</label>
                    </div>
                    <div class="checkbox checkbox-info checkbox-inline">
                        <input id="reviewSchool" type="checkbox" value="1" <?php if(isset($site)){if($site['reviewSchool']==1){echo "checked";} } ?> name="reviewSchool">
                        <label for="reviewSchool">机构</label>
                    </div>
                    <div class="checkbox checkbox-info checkbox-inline">
                        <input id="reviewMember" type="checkbox" value="1" <?php if(isset($site)){if($site['reviewMember']==1){echo "checked";} } ?> name="reviewMember">
                        <label for="reviewMember">学员</label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                      <label class="col-sm-2 control-label" style="padding-top:0">手机绑定多用户</label>
                       <div class="col-sm-4">
                        <div class="radio radio-info radio-inline">
                            <input name="mbings" id="mbings1" required type="radio"  <?php if($site["mbings"] == 1)echo  'checked="checked"' ?> value="1" /><label for="mbings1"> 是 </label>
                        </div>
                        <div class="radio radio-info  radio-inline">
                            <input name="mbings" id="mbings2" required type="radio" <?php if($site["mbings"] == 0)echo 'checked="checked"' ?> value="0" /><label for="mbings2"> 否 </label>
                        </div>
                </div>
            </div>
            <div class="form-group">
                      <label class="col-sm-2 control-label" style="padding-top:0">邮箱绑定多用户</label>
                       <div class="col-sm-4">
                        <div class="radio radio-info radio-inline">
                            <input name="ebings" id="ebings1" required type="radio"  <?php if($site["ebings"] == 1)echo  'checked="checked"' ?> value="1" /><label for="ebings1"> 是 </label>
                        </div>
                        <div class="radio radio-info  radio-inline">
                            <input name="ebings" id="ebings2" required type="radio" <?php if($site["ebings"] == 0)echo 'checked="checked"' ?> value="0" /><label for="ebings2"> 否 </label>
                        </div>
                       </div>
            </div>
            <div class="form-group">
                      <label class="col-sm-2 control-label" style="padding-top:0">注册后直接登录</label>
                       <div class="col-sm-4">
                        <div class="radio radio-info radio-inline">
                            <input name="registerlogin" id="registerlogin1" required type="radio"  <?php if($site["registerlogin"] == 1)echo  'checked="checked"' ?> value="1" /><label for="registerlogin1"> 是 </label>
                        </div>
                        <div class="radio radio-info  radio-inline">
                            <input name="registerlogin" id="registerlogin2" required type="radio" <?php if($site["registerlogin"] == 0)echo 'checked="checked"' ?> value="0" /><label for="registerlogin2"> 否 </label>
                        </div>
                       </div>
            </div>
            <div class="form-group">
                      <label class="col-sm-2 control-label" style="padding-top:0">注册后强制完善信息</label>
                       <div class="col-sm-4">
                        <div class="radio radio-info radio-inline">
                            <input name="registerinfo" id="registerinfo1" required type="radio" <?php if($site["registerinfo"] == 1)echo  'checked="checked"' ?> value="1" /><label for="registerinfo1"> 是 </label>
                        </div>
                        <div class="radio radio-info  radio-inline">
                            <input name="registerinfo" id="registerinfo2" required type="radio" <?php if($site["registerinfo"] == 0)echo 'checked="checked"' ?> value="0" /><label for="registerinfo2"> 否 </label>
                        </div>
                       </div>
            </div>
        </div>
       </div>
        <div  class="tab-pane">
        	   <div class="form-group">
                    <label class="col-sm-2 control-label">点播配置：</label>
               </div>
               <div class="form-group">
                    <label class="col-sm-2 control-label">赠送代金券：</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control"   name="vodmoney" id="sitename"  <?php if(isset($site["vodmoney"]))echo "value='$site[vodmoney]'";  ?>>元
                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-sm-2 control-label">初始存储空间：</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control"   name="vodspace" id="sitename"  <?php if(isset($site["vodspace"]))echo "value='$site[vodspace]'";  ?>>G
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">存储单价：</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control"   name="storageprice" id="sitename"  <?php if(isset($site["storageprice"]))echo "value='$site[storageprice]'";  ?>>元（每日/G）
                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-sm-2 control-label">流量单价：</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control"   name="flowprice" id="sitename"  <?php if(isset($site["flowprice"]))echo "value='$site[flowprice]'";  ?>>元（/G）
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">结算频率：</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control"   name="vodfrequency" id="sitename"  <?php if(isset($site["vodfrequency"]))echo "value='$site[vodfrequency]'";  ?>>次 （每日）
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">直播配置：</label>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">赠送代金券：</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control"   name="livemoney" id="sitename"  <?php if(isset($site["livemoney"]))echo "value='$site[livemoney]'";  ?>>元
                    </div>
                </div>

                 <div class="form-group">
                    <label class="col-sm-2 control-label">流量单价：</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control"   name="liveflowprice" id="sitename"  <?php if(isset($site["liveflowprice"]))echo "value='$site[liveflowprice]'";  ?>>元（/G）
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">结算频率：</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control"   name="livevodfrequency" id="sitename"  <?php if(isset($site["livevodfrequency"]))echo "value='$site[livevodfrequency]'";  ?>>次 （每日）
                    </div>
                </div>
        </div>
</div>
</div>
</div>
</div>
<div class="footer-page">
    <div class="col-sm-5"></div>
        <div class="col-sm-3 mt3">
            <button class="btn btn-primary btn-s-md" type="submit">保存</button>
        </div>
    </div>
</form>
</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
</body>
</html>
<script>
 $(function(){
	//短信不启用隐藏信息
	var a = $("#messageInfo").attr('a');
	if(a == 0){
		$("#messageInfo").hide();
	}else{
		$("#messageInfo").show();
	} 
	loadScorllJs();//滚轮	
	taps();
	uploadView('100','100');	
});
//短信不启用隐藏信息
$(":radio").click(function(){
	var a =$(this).val();
	if(a == 0){
		$("#messageInfo").hide();
	}else{
		$("#messageInfo").show();
	}
});
</script>-->