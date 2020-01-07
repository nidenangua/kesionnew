<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>科汛V名师平台接口调试工具</title>
		<link href="https://mp.weixin.qq.com/debug/zh_CN/htmledition/style/page/page_debug1f5859.css" rel="stylesheet" type="text/css" />
	<head>
	<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
	<style>
	.logo a {
		display: block;
		width: 248px;
		height: 55px;
		overflow: hidden;
		text-decoration: none;
		background: transparent url(/Public/app/images/login/logo.png) no-repeat 0 0;
	}
	select{
		height: 32px;
        width: 330px;
	}
	input{
		    height: 26px;
	}
	</style>
	<body>
		<div class="head" id="header">
			<div class="head_box">
				<div class="inner wrp">
					<h1 class="logo">
						<a href="<?php echo M_URL('home.html/home','Login');?>" title="科汛V名师平台"></a>
					</h1>
				</div>
			</div>
		</div>
		<div id="main" class="main">
			<h1>科汛V名师平台接口调试工具</h1>
			<div class="panel">
				<div id="description" class="des">
					此工具旨在帮助开发者检测调用【科汛V名师平台开发者API】时发送的请求参数是否正确，提交相关信息后可获得服务器的验证结果				</div>
				<ol id="manual" class="manual">
					<li><b>使用说明：</b></li>
					<li>（1）选择合适的接口。</li>
					<li>（2）系统会生成该接口的参数表，您可以直接在文本框内填入对应的参数值。（红色星号表示该字段必填）</li>
					<li>（3）点击检查问题按钮，即可得到相应的调试信息。</li>
				</ol>

				<div id="content" class="content">
					<?php if($firstary){?>
					<div id="typeSelectorDiv" class="frm_control_group">
						<label class="frm_label">一、接口类型：</label>
						<div class="frm_controls">
							<select id="typeSelector" class="frm_input_box" onchange="getval(this,'<?php echo GP('1-1',true); ?>','<?php echo M_URL('home','apiinfo'); ?>','modelid','<?php echo URL_MODEL;?>')">
								<?php foreach($firstary as $k =>$v){?>
									<option value="<?php echo $v['id'] ?>" <?php if($modelid==$v['id']){echo 'selected';}?>><?php echo $v['name'] ?></option>
								<?php }?>
							</select>
						</div>
					</div>
					<?php if($second){?>
					<div id="formSelectorDiv" class="frm_control_group">
						<label class="frm_label">二、接口列表：</label>
						<div class="frm_controls">
							<select id="formSelector" class="frm_input_box" onchange="getval(this,'<?php echo GP('modelid-'.$modelid,true); ?>','<?php echo M_URL('home','apiinfo'); ?>','interfaceid','<?php echo URL_MODEL;?>')">
								<?php foreach($second as $k1 =>$v1){?>
									<option value="<?php echo $v1['id'] ?>" <?php if($interfaceid==$v1['id']){echo 'selected';}?> ><?php echo $v1['name'] ?>（<?php echo $v1['controller'] ?>.<?php echo $v1['interfaceName'] ?>）</option>
								<?php }?>
							</select>
							<span id="methodType" datatype='<?php echo $postway ?>' class="frm_tips">方法：<?php if($postway==1){echo '普通post';}elseif($postway==2){echo 'post对象';}elseif($postway==3){echo 'GET';} ?></span>
						</div>
					</div>    
					<?php if($third){?>                      
					<div id="formContent" class="frm_control_group">
						
						<form id="formelement" enctype="multipart/form-data">
							<?php if($interfaceName!='register'&&$interfaceName!='accesstoken'){?>
							<label>三、公公参数：</label>
						    <br /><br />
							<div id="formContainer">
								<?php foreach($third as $k2 =>$v2){if($v2['parameter']=='appid'||$v2['parameter']=='token'){?>
	                            <div class="inputDiv">
									<?php if($v2['isnecessary'] == 1) { ?>
										<span class="red">*</span> 
									<?php } else { ?>
										<span style="color:#eeeeee">*</span> 
									<?php } ?>
									<span class="name" style="width: 199px"><?php echo $v2['name'] ?>（<span class="parameter"><?php echo $v2['parameter'] ?></span>） : </span>
									<?php if($v2['pramType']==0){?>
										<input type="text" class="number<?php if($v2['isnecessary'] == 1) {echo ' checkedinput';}?>" name="<?php echo $v2['parameter'] ?>">
									<?php }elseif($v2['pramType']==1){?>
										<input type="file" class="number havefile" name="<?php echo $v2['parameter'] ?>">
									<?php }elseif($v2['pramType']==2){?>
										<input type="number" class="number <?php if($v2['isnecessary'] == 1) {echo ' checkedinput';}?>" name="<?php echo $v2['parameter'] ?>">
									<?php }?>
									<span class="tips" style="margin-left: 214px;"><?php echo $v2['mark'] ?></span>
									<span class="errMsg" style="margin-left: 276px;color: red;"></span>
									<br />
								</div>
								<?php }}?>
							</div>
							<label>四、参数列表</label>
						<?php }else{?>
							<label>三、参数列表：</label>
						<?php }?>
							<br /><br />
							<div id="formContainer">
								<?php foreach($third as $k2 =>$v2){if($interfaceName=='accesstoken'){?>
	                            <div class="inputDiv">
									<?php if($v2['isnecessary'] == 1) { ?>
										<span class="red">*</span> 
									<?php } else { ?>
										<span style="color:#eeeeee">*</span> 
									<?php } ?>
									<span class="name" style="width: 199px"><?php echo $v2['name'] ?>（<span class="parameter"><?php echo $v2['parameter'] ?></span>） : </span>
									<?php if($v2['pramType']==0){?>
										<input type="text" class="number<?php if($v2['isnecessary'] == 1) {echo ' checkedinput';}?>" name="<?php echo $v2['parameter'] ?>">
									<?php }elseif($v2['pramType']==1){?>
										<input type="file" class="number havefile" name="<?php echo $v2['parameter'] ?>">
									<?php }elseif($v2['pramType']==2){?>
										<input type="number" class="number<?php if($v2['isnecessary'] == 1) {echo ' checkedinput';}?>" name="<?php echo $v2['parameter'] ?>">
									<?php }?>

									<span class="tips" style="margin-left: 214px;"><?php echo $v2['mark'] ?></span>
									<span class="errMsg" style="margin-left: 276px;color: red;"></span>
									<br />
								</div>
								<?php }elseif($v2['parameter']!='appid'&&$v2['parameter']!='token'){?>
									<div class="inputDiv">
									<?php if($v2['isnecessary'] == 1) { ?>
										<span class="red">*</span> 
									<?php } else { ?>
										<span style="color:#eeeeee">*</span> 
									<?php } ?>
									<span class="name" style="width: 199px"><?php echo $v2['name'] ?>（<span class="parameter"><?php echo $v2['parameter'] ?></span>） : </span>
									<?php if($v2['pramType']==0){?>
										<input type="text" class="number<?php if($v2['isnecessary'] == 1) {echo ' checkedinput';}?>" name="<?php echo $v2['parameter'] ?>">
									<?php }elseif($v2['pramType']==1){?>
										<input type="file" class="number havefile" name="<?php echo $v2['parameter'] ?>">
									<?php }elseif($v2['pramType']==2){?>
										<input type="number" class="number <?php if($v2['isnecessary'] == 1) {echo ' checkedinput';}?>" name="<?php echo $v2['parameter'] ?>">
									<?php }?>

									<span class="tips" style="margin-left: 214px;"><?php echo $v2['mark'] ?></span>
									<span class="errMsg" style="margin-left: 276px;color: red;"></span>
									<br />
								</div>
								<?php }}?>
							</div>
							<button type="button" onclick="test()" style="margin-bottom: 32px;">检查问题</button>
					    </form>
					    <div class="frm_control_group">
							<label class="frm_label">四、结果显示：</label>
							<div class="frm_controls" id="resultContainer" style="word-break: break-all;white-space: initial;line-height: 24px;height: 300px;background: #fff;width: 660px;overflow-y: scroll;"></div>
						</div>
					</div>
					<?php }else{?>
						<div>
							暂无参数信息
						</div>
					<?php }?>
					<?php }else{?>
						<div>
							暂无接口信息
						</div>
					<?php }?>
				<?php }else{?>
					<div>
						暂无接口信息
					</div>
				<?php }?>
				</div>
				<div class="iframe-container hide">
                    <!-- <iframe frameborder="no" scrolling="no" marginheight="0" marginwidth="0" id="result-iframe" name="result-iframe" src="/debug/cgi-bin/apiinfo?name=gettoken&t=wap-apiresult" ></iframe> -->
					<!-- <iframe frameborder="no" scrolling="no" marginheight="0" marginwidth="0" id="result-iframe" name="result-iframe"></iframe> -->
				</div>
			</div>
		</div>
		<div class="footer">
			<ul class="footer-places">
				<li class="footer-about">
					<a target="_blank" href="http://www.kesion.com">关于科汛</a>
					&nbsp;|&nbsp; 
				</li>
				<li class="footer-policy"> 
					<a target="_blank" href="<?php echo M_URL('home','product');?>">服务协议</a>
					&nbsp;|&nbsp;
				</li>
				<li class="footer-contactus">
					<a target="_blank" href="<?php echo M_URL('home','question');?>">问题解答</a>
					&nbsp;|&nbsp;
				</li>
				<li class="footer-online"><a href="javascript:void(0)" id="qqclick">在线客服</a></li>
			</ul>
			<div style="clear:both">Copyright&nbsp;© 2012-2018 Tencent. All Rights Reserved.</div>
		</div>
<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>

<script src="<?php echo UOOT;?>Public/common/js/backstage.js"></script>
<script type="text/javascript">
		function $post(_url,data,fn,type){
		var xhr = new XMLHttpRequest();
		/**
		 * @method open
		 * @for xhr
		 * @param {String}  [请求类型，get or post]
		 * @param {String}  [请求url]
		 * @param {Boolean} [是否异步请求] 
		 */
		xhr.open("POST", _url, true);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");  // 添加http头，发送信息至服务器时内容编码类型
		xhr.onreadystatechange = function() {
			if(xhr.readyState == 4 ){
				if (xhr.status == 200 || xhr.status == 304) {
				switch (type){
					case "json":
						typeof fn === 'function' && fn.call(this, $json(xhr.responseText,'parse'))
						break;
					default:
						typeof fn === 'function' &&  fn.call(this, xhr.responseText)
						break;
				}
				}else{

					typeof fn === 'function' &&  fn.call(this,'请求失败')
				}
			}
		};
		
		if(typeof data === 'object'){
			data = $json(data,'stringify') 
		};
		xhr.send(data)

	};
	function $get(_url,fn,type){
		var xhr = new XMLHttpRequest();
		/**
		 * @method open
		 * @for xhr
		 * @param {String}  [请求类型，get or post]
		 * @param {String}  [请求url]
		 * @param {Boolean} [是否异步请求] 
		 */
		xhr.open("GET",_url,true);
		xhr.onreadystatechange = function() {
			if(xhr.readyState == 4 ){
				if (xhr.status == 200 || xhr.status == 304) {
				switch (type){
					case "json":
						typeof fn === 'function' && fn.call(this, $json(xhr.responseText,'parse'))
						break;
					default:
						typeof fn === 'function' &&  fn.call(this, xhr.responseText)
						break;
				}
				}else{

					typeof fn === 'function' &&  fn.call(this,'请求失败')
				}
			}
		};
		
		// if(typeof data === 'object'){
		// 	data = $json(data,'stringify') 
		// };
		xhr.send()
        // xmlDoc=xmlhttp.responseXML;
	};
	function $json(data,type){
		
		switch (type){
			case "parse":
				return JSON.parse(data)
				break;
			case "stringify":
				return JSON.stringify(data)
				break;
		}
		
	};
	function test(){

		var count =0;
		var _checkarr =  $(".checkedinput");
		for (var i=0;i<_checkarr.length;i++) {
			if($(_checkarr[i]).val()==''){
				count++
				 $(_checkarr[i]).siblings('.errMsg').text('不能为空')
			}else{
				$(_checkarr[i]).siblings('.errMsg').hide()
			}
			
		}
		if(count==0){
			var url = '/Json/index.php?act=<?php echo $Controller ?>.<?php echo $interfaceName ?>';
			var element = $('input[type="file"]');
			if(element.length==0){
                var newdata ={};
		        var _arr =  $('.inputDiv');
		        if($("#methodType").attr("datatype")==2||$("#methodType").attr("datatype")==1){
			        var str='';
			        for(var i=0;i<_arr.length;i++){
			        	var par = $(_arr[i]).find('.parameter').text()
			        	var num =$(_arr[i]).find('.number').val();
			        	if(_arr.length==(i+1)){
			        		str += '"'+par + '":"'+num+'"';
			        	}else{
			                str += '"'+par + '":"'+num+'",';
			        	}
			        	
			        }
			        if($("#methodType").attr("datatype")==2){//post对象
			        	str = '{'+str+'}';
			        }
		        	$post(url,str,function(data){
			             $("#resultContainer").text(data)
			        })
		        }else if($("#methodType").attr("datatype")==3){
		        	var str='&';
			        for(var i=0;i<_arr.length;i++){
			        	var par = $(_arr[i]).find('.parameter').text()
			        	var num =$(_arr[i]).find('.number').val();
			        	if(_arr.length==(i+1)){
			        		str += par + '='+num;
			        	}else{
			                str += par + '='+num+'&';
			        	}
			        	
			        }
	                $get(url+str,function(data){
			             $("#resultContainer").text(data)
			        })
		        }
			}else{
				var form = document.getElementById("formelement");
                var fd = new FormData(form);
                $.ajax({
		             url: url,
		             type: "POST",
		             data: fd,
		             dataType:"json",
		             processData: false,  // 告诉jQuery不要去处理发送的数据
		             contentType: false,   // 告诉jQuery不要去设置Content-Type请求头
		             success: function(response,status,xhr){
		             	var response=JSON.stringify(response)
		                $("#resultContainer").text(response)
		             },
		             error:function(XMLHttpRequest, textStatus, errorThrown){
		             	$("#resultContainer").text(XMLHttpRequest.responseText)
		             }
		        });
			}
	        
	        
		}
		
	}
</script>
	</body>
</html>