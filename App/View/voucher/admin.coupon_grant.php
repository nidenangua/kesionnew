
<!DOCTYPE html>
<html>
<head >
    <title>无标题页</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="renderer" content="webkit">
	<link rel="shortcut icon" href="favicon.ico">
	<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
	<link href="<?php echo UOOT;?>Public/admin/css/html5.css" rel="stylesheet">
	<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
	<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/admin/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/page.animate.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/admin/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
	<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
    
	  <!--<script src="/admin/images/icheck.js"></script>-->
			  <script>
			  $(document).ready(function(){
				
				//$('input[type="checkbox"],input[type="radio"]').iCheck({ 
				//  labelHover : false, 
				//  cursor : true, 
				//  checkboxClass : 'icheckbox_square-blue', 
				//  radioClass : 'iradio_square-blue', 
				//  increaseArea : '20%' 
				//}); 				
			 });
	
		</script>


<script type="text/javascript">
       function addUser() {
            var src = document.getElementById('user_search');
            var dest = document.getElementById('user');

            for (var i = 0; i < src.options.length; i++) {
                if (src.options[i].selected) {
                    var exist = false;
                    for (var j = 0; j < dest.options.length; j++) {
                        if (dest.options[j].value == src.options[i].value) {
                            exist = true;
                            break;
                        }
                    }
                    if (!exist) {
                        var opt = document.createElement('OPTION');
                        opt.value = src.options[i].value;
                        opt.text = src.options[i].text;
                        dest.options.add(opt);
                    }
                }
            }
        }
     function delUser() {
            var dest = document.getElementById('user');

            for (var i = dest.options.length - 1; i >= 0 ; i--) {
                if (dest.options[i].selected) {
                    dest.options[i] = null;
                }
            }
        }
        function check() {
                var radioary=$('.notify');
            if((radioary[0].checked==false)&&(radioary[1].checked==false)&&(radioary[2].checked==false)) {
	           alert("请选择通知方式");
	           return false;
	        }
            if (jQuery("#chosetype :radio[checked]").val() == "2") {
                var idArr = new Array();
                var dest = document.getElementById('user');
                for (var i = 0; i < dest.options.length; i++) {
                    dest.options[i].selected = "true";
                    idArr.push(dest.options[i].value);
                }
                if (idArr.length <= 0) {
                    alert("你没有选择用户!");
                    return false;
                }
                else {
                    return true;
                }
            }

        }
        function showlist() {
            if (jQuery("#chosetype :radio[checked]").val() == "2") {
                $("#list2").show();
           } else {
                $("#list2").hide();
           }
        }
       function searchUser(){
      	$.ajax({
      		type:"post",
      		dataType:"json",
      		url:"//store.kesion.com/admin.php/home/Coupon/search",
      		async:true,
      		data:{
      			'keytype':$("#keytype").val(),
      			'key':$("#key").val()
      		},
      		success:function(data){
      			var html='';
      			$(data).each(function(index, element)
				 { 
				 html +="<option value="+data[index].wxid+">"+data[index].sitename+"</option>"
				 })
				$("#user_search").append(html);
      		}
      	});
      }
</script>
	<!--[if IE 6]>
  <script src="/admin/include/iepng.js" type="text/javascript"></script>
  <script type="text/javascript">
     try{
     EvPNG.fix('div, ul, img, li, input, em, a, p,i,b,span,em,' ); 
    }catch(e){
    }
  </script>
  <![endif]-->
</head>
<body scroll="auto" class="scroll_Rcontent s1" style="">
    <form action="<?php echo M_URL($this->AppName.'/Index','grant','',GP('coupon-'.$sumid.',type-'.$type.',j-'.$couId,true)); ?>"  method="post" id="aspnetForm">          
    <div id="manage_top" class="toptitle menu_top_fixed" style="font-size: 35px;"><?php echo Field($detail) ?>的发放情况</div><div class="menu_top_fixed_height"></div> 
    <div class="content-area" style="
    margin-top: 41px;
">
    
   <span id="chosetype" onclick="showlist()">
   	<div style="<?php if($type==1){ echo 'display:none;';}?>">
	   	<input id="chosetype" type="radio" name="scope" value="1" checked="checked"  />
	   	<label for="chosetype">全部网校</label>
   	</div>
   	<input id="chosetype" type="radio" name="scope" value="2" <?php if($type==1){ echo 'checked';}?> />
   	<label for="chosetype">按指定用户发放</label></span> 
    <div id="ctl00_KSContent_Panel1" style="width:100%;">
        <div id="list2" style=" <?php if($type==1){ echo 'display:block;';}else{ echo 'display:none;';}?>;">
        <table width="100%" border="0" cellpadding="1" cellspacing="1" class="CTable"> 
          <tr>
            <td class="righttd" colspan="3">
              <select  class="inputText bRadius5 fl" id="keytype" style="width: 150px;cursor: pointer;line-height:34px;text-align: center;" id="keytype" >
					<option  value="1" >网校名称</option>
					<option  value="2">按网校id</option>
					<option  value="3">按域名</option>
				</select>
               <input type="text" class="textbox" name="key" id="key" size="20"/>
               <input type="button" value="搜索用户" class="button" onclick="searchUser();"/>
            </td>
          </tr>
          <tr align='center'>
						<td height='25' class='clefttitle' style="text-align:center">会员列表</td>
						<td  class='clefttitle' style="text-align:center">操作</td>
						<td  class='clefttitle' style="text-align:center">给下列用户发放</td>
		  </tr>
          <tr align='center'>
          	            
						<td height='25' class='righttd' style="text-align:center">
						<select name="user_search[]" id="user_search" size="15" style="height:300px;width:260px" ondblclick="addUser()" multiple="true">
							

							 	
						  </select>
						</td>
						<td  class='righttd' style="text-align:center">
						<p><input type="button" value=" > " onclick="addUser()" class="button" /></p>
						<br />
						<p><input type="button" value=" < " onclick="delUser()" class="button" /></p>
						</td>
						<td  class='righttd' style="text-align:center">
						<select name="user[]" id="user" multiple="true" size="15" style="height:300px;width:260px" ondblclick="delUser()">
							
						  </select>
						</td>
		  </tr>              
         </table>
         
    </div> 
        <table width="99%"  border="0" cellpadding="1" cellspacing="1" class="CTable"> 
          <tr>
              <td align="right" class="lefttd" height="30" style="width: 198px"><strong>通知选项：</strong></td>
              <td class="righttd">
                  <input value="2" class="notify" type="radio" name="messagetype[]"/><label for="ctl00_KSContent_CKB1">发送Email邮件通知</label>
                  <br />
                  <input value="3" class="notify" type="radio" name="messagetype[]"  /><label for="ctl00_KSContent_CKB2">发送站内短消息通知</label>
                    
                  <br />
                  <input value="1" class="notify" type="radio" name="messagetype[]" /><label for="ctl00_KSContent_CKB6">发送短信信息通知</label>
                  <br />
              </td>
          </tr>
         </table>
    <input type="submit" name="ctl00$KSContent$Button2" value="确定发放" onclick="return(check());" id="ctl00_KSContent_Button2" class="button" />
    <div id="list3">
 <!--<table width="99%"  border="0" cellpadding="1" cellspacing="1" class="CTable"> 
          <tr>
              <td align="right" class="lefttd" height="30" style="width: 198px"><strong>邮件通知选项：</strong></td>
              <td class="righttd">
                  <input id="ctl00_KSContent_CKB1" type="checkbox" name="ctl00$KSContent$CKB1" onclick="show(1);" /><label for="ctl00_KSContent_CKB1">发送Email邮件通知</label>
                  <br />
                  <input id="ctl00_KSContent_CKB2" type="checkbox" name="ctl00$KSContent$CKB2" onclick="show(2);" /><label for="ctl00_KSContent_CKB2">发送站内短消息通知</label>
                    
                  <br />
                  <input id="ctl00_KSContent_CKB6" type="checkbox" name="ctl00$KSContent$CKB6" onclick="show(6);" /><label for="ctl00_KSContent_CKB6">发送微信信息通知</label>
                  <br />
              </td>
          </tr>
          <tr>
              <td align="right" class="lefttd" height="30" style="width: 198px"><strong>优惠券模板：</strong></td>
              <td class="righttd">
                  <select name="ctl00$KSContent$DropDownList1" id="ctl00_KSContent_DropDownList1" onchange="showType(this.value)">
		<option selected="selected" value="1">123</option>

	</select>
              </td>
          </tr>
          <tr id="title">
              <td  align="right" class="lefttd" height="30" style="width: 198px">
                  <strong>消息标题模板：</strong></td>
              <td class="righttd">
                  <input name="ctl00$KSContent$txtTitle" type="text" value="123" id="ctl00_KSContent_txtTitle" class="textbox" />
                  <span class="tips">如：恭喜您在科汛网站获得5元购物优惠券。</span></td>
          </tr>
          <tr id="sendemail">
              <td align="right" class="lefttd" height="30" style="width: 198px">
                  <div>
                      <strong>发放成功发送一封邮件给用户：</strong>
                      <div class="tips">
                          标签： {$GetSiteName}：网站名称<br /> {$UserName}：用户名<br /> {$BeginDate}：使用时间<br /> {$EndDate}：过期时间<br /> {$FaceValue}：面值<br /> {$CouponNum}：优惠券号<br /> 
                      </div>
                  </div>
              </td>
              <td class="righttd">
                  <textarea name="ctl00$KSContent$TxtRegSuccMail" rows="2" cols="20" id="ctl00_KSContent_TxtRegSuccMail" style="height:120px;width:650px;">
&lt;p&gt;123&lt;/p&gt;</textarea>
                  <script>jQuery(document).ready(function(){ editor1 = UE.getEditor('ctl00_KSContent_TxtRegSuccMail',{toolbars:[  ['fullscreen', 'source', '|', 'undo', 'redo', '|','bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript','removeformat','|','insertimage', 'wordimage', 'emotion'] ],wordCount:false,autoHeightEnabled:false,scaleEnabled:false}); });</script>
                  <br />
                  Tips:内容留空将不发送！！！ </td>
          </tr>
          <tr id="sendsite">
              <td align="right" class="lefttd" height="30" style="width: 198px">
                  <div>
                      <strong>发放成功发送一条站内给用户：</strong>
                      <div class="tips">
                          标签： {$GetSiteName}：网站名称<br /> {$UserName}：用户名<br /> {$BeginDate}：使用时间<br /> {$EndDate}：过期时间<br /> {$FaceValue}：面值<br /> {$CouponNum}：优惠券号<br /> 
                      </div>
                  </div>
              </td>
              <td class="righttd">
                  <textarea name="ctl00$KSContent$TxtSendSite" rows="2" cols="20" id="ctl00_KSContent_TxtSendSite" style="height:120px;width:650px;">
&lt;p&gt;123&lt;/p&gt;</textarea>
                  <script>jQuery(document).ready(function(){ editor2 = UE.getEditor('ctl00_KSContent_TxtSendSite',{toolbars:[  ['fullscreen', 'source', '|', 'undo', 'redo', '|','bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript','removeformat','|','insertimage', 'wordimage', 'emotion'] ],wordCount:false,autoHeightEnabled:false,scaleEnabled:false}); });</script>
                  <br />
                  Tips:内容留空将不发送！！！ </td>
          </tr>
          <tr id="sendmobile">
              <td align="right" class="lefttd" height="30" style="width: 198px">
                  <div>
                      <strong>发放成功发送一条短信给用户：</strong>
                      <div class="tips">
                          标签： {$UserName}：用户名<br /> {$BeginDate}：使用时间<br /> {$FaceValue}：面值<br /> {$CouponNum}：优惠券号<br /> 
                      </div>
                  </div>
              </td>
              <td class="righttd">
                  <textarea name="ctl00$KSContent$TxtSendMobile" rows="6" cols="60" id="ctl00_KSContent_TxtSendMobile" class="textbox textarea" style="height:120px;width:650px;">
</textarea>
                  <a class="textarea_min" href="javascript:zoomtextarea(-5,'ctl00_KSContent_TxtSendMobile');"></a><a class="textarea_max" href="javascript:zoomtextarea(5,'ctl00_KSContent_TxtSendMobile');"></a>
                  <br />
                  Tips:内容留空将不发送！！！ </td>
          </tr>
          <tr>
           <td class="lefttd" colspan="2" style="text-align:center">
           <input type="submit" name="ctl00$KSContent$Button2" value="确定发放" onclick="return(check());" id="ctl00_KSContent_Button2" class="button" />
           </td>
          </tr>
         </table>-->
        </div>
        
</div>
        
 </div>   

    </form>
    <script>
//      jQuery(document).ready(function () {
//          var a = jQuery("#aspnetForm").attr("action");
//          if (a.indexOf('/') != -1) {
//              var arr = a.split('/');
//              a = arr[arr.length - 1];
//              jQuery("#aspnetForm").attr("action", a);
//          }
//     });
   </script>
   <script src="//store.kesion.com/Public/common/js/common.js"></script>
</body>
</html>







