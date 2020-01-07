
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>添加应用</title>
<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/html5.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/form.css" rel="stylesheet">
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<style type="text/css"> 
	#tablist li{font-size: 16px; margin-right: 20px;cursor:pointer;}
	#tablist li.active{color: #6C79CB;font-weight: bold;}
	.Created-push{display: none;}
	#active{display: block!important;}
	.tab-pane{padding: 30px;
    background: #FFFFFF;
    border-radius: 10px;}
    .Created-title span:last-child{
    	margin-left: 0;
    }
    .upload-img{width: 150px;height: 125px;text-align: center;line-height:120px;float: left;border: 1px solid #eee;cursor: pointer;}
	.upload-img i{color:#666;font-size: 40px;}
	.selectImageBtn{background: none;border: 0;float: left;}
	.form-upload {position: relative;width: 300px;top: 30px;}
	.js_showBox {border-radius: 0;display: table-cell;text-align: center;vertical-align: middle;}
	.js_showBox img {width: auto!important; min-height: inherit!important; display: inline-block;vertical-align: middle;}
	.form-icon {position: relative;height: 125px;width: 150px;float: left;margin-right: 15px;}
	.form-bg {position: absolute;bottom: 0;width: 150px;z-index: 9;height: 40px;background: #000;opacity: 0.15;}
	.form-close {position: absolute;right: 0;top: 0;}
	.form-prev {position: absolute;bottom: 6px; left: 0; z-index: 999;}
	.form-next {position: absolute;bottom: 6px; right: 0; z-index: 999;}
	
	.imgList {width: 800px; position: absolute;}
	.imglist-box {height: 150px;position: relative;overflow: hidden;min-width: 800px;margin-left: 75px;display: inline-block;}
</style>
<body class="gray-bg">

<div class="row">
<div id="manage_top" class="menu_top_fixed  p15 height73">
    <div class="ibox-title">
        <h3 class="fl">
        	直播PC客户端配置
        </h3>
        <div class="fr">
             <div class="fl ks-top-search">
			<!--搜索-->
				<button class="ks-bt bt-def" onclick="history.go(-1)"><i class="iconfont icon-fanhui"></i>返回</button>
			<!--搜索-->
			</div>  
              
               
        </div>
    </div>
</div>
</div></form>


<br />

<div id="ksBoxContent" class="mt50">
<form target="hidframe"  method="post" id="myform" action="<?php echo M_URL('home/Setting','doliveSetting','',GP(''));?>" class="form-horizontal" enctype="multipart/form-data">

	
	
	
<div class="Created-push tab-pane" id="active">
		<ul>
			
		<li>
			<div class="Created-largetTitle">
					<span>1</span>
					<div class="Created-title">
						<span>基本配置</span>
						<span>(可修改部分)</span>
					</div>
				</div>
			
			
			
				
		<div class="Created-ing">
					<ul>
						<li>
							<h4>版本号:</h4>
							<div class="Created-Content clearfix">
								<input type="text" class="long-text" name="version" value="<?php if(!empty($values)){ echo $values['version'];} ?>">
							</div>
						</li>
						<li>
							<h4>网址:</h4>
							<div class="Created-Content clearfix">
								<input type="text" class="long-text" name="domain" value="<?php if(!empty($values)){ echo $values['domain'];} ?>">
							</div>
						</li>
						<li>
							<h4>公司地址:</h4>
							<div class="Created-Content clearfix">
								<input type="text" class="long-text" name="addr" value="<?php if(!empty($values)){ echo $values['addr'];} ?>">
							</div>
						</li>
						
						<li>
							<h4>Logo:</h4>
							<div class="form-upload">
				          		<div class="js_uploadBox">
				          			<div class="js_showBox"><img class="js_logoBox block defaultpic"  src="<?php if(!empty($values)){ echo $values['logo'];} ?>"></div>
					                <div class="btn-upload clearfix">
					                    <a href="javascript:addTypeChange('<?php echo M_URL("Index","imageslist","",GP("type-top,name-defaultpic",true));?>','930px','610px',{title:'选择图片',type:'top'});" class="selectImageBtn">
					                    	<span class="js_uploadText">上传图片</span></a>
					                    <p>限制：2MB,支持jpg|png|gif</p> 
					                    <input type="hidden" name="defaultpic" value="<?php if(!empty($values)){ echo $values['logo'];} ?>">
					               </div>
							    </div>
				          	</div>
						</li>
						
						<li style="margin-top: 60px;">
							<h4>启动图配置：</h4>
							

							<div class="mt20 " > 
								<div class="imglist-box">
									<div class="imgList" >	
										
					          		</div>
			          		   	</div>		          		      	
			          		      	
			              		  <a class="selectImageBtn" onclick="addicon()">
			          			  <div class="upload-img" style="width: 150px;height: 125px;">
			          			  	  <i class="iconfont icon-jia"></i>
			          			  </div>
			          			  </a>
			          			 
			          			  <input type="hidden" name="downsrc" id="tempsrc" value="" oninput="photoChange(this)">
			          			  <input type="hidden" name="tempsrc" value="<?php echo $str;?>">	
			          		</div>

							
						</div>
						
					</div>


			</div>	
		
				
			
			
			
		</li>
<div class="footer-page">
        <div class="col-sm-5"></div>
        <div class="col-sm-6 mt10">
             <button class="btn btn-default btn-s-md " onclick="do_reg()">确认</button>
       		 <a href="javascript:history.go(-1);" class="btn btn-s-md bt-gray">取消</a>
        </div>
    </div>
    </ul>
    </ul>

	
	
    	<div id="ksBoxFooter" style="height: 150px;"></div>

</form>	
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
	function do_reg(){
		$('#myform').submit();
	}
	var i= 0;
	var tempSrc =  $('input[name="tempsrc"]').val();
	
	if(tempSrc !=''){
		tempSrc = tempSrc.split(',');//路径数组
	}else{
		tempSrc = [];
	}
	for(i=0;i<tempSrc.length;i++){ //添加图片
		var contentStr ='';
 	 	contentStr+='<div class="form-icon"><img width="150px" height="125px" class="js_logoBox block tempImages fl downsrc" src="'+tempSrc[i]+'">';
 	 	contentStr+='<div class="form-bg"></div><div class="form-close" onclick="tempRemove(this)">';
 	 	contentStr+='<img src="<?php echo UOOT;?>Public/app/images/classIcon/admin-icon1.png"></div>';
 	 	contentStr+='<div class="form-prev" data-type = "prev" onclick="configPhoto(this)"><img src="<?php echo UOOT;?>Public/app/images/classIcon/admin-icon3.png"></div>';	
 	 	contentStr+='<div class="form-next" data-type="next" onclick="configPhoto(this)"><img src="<?php echo UOOT;?>Public/app/images/classIcon/admin-icon2.png"></div></div>';
 	 	$('.imgList').append(contentStr);
	}
	console.log(tempSrc)
	top.imgUploadBack = function(src){
		var str =$('input[name="tempsrc"]').val();
		if(str ==''){
			str =src;
		}else{
			str +=','+src;	
		}
		
		tempSrc.push(src);
		var contentStr ='';
	 	contentStr+='<div class="form-icon"><img width="150px" height="125px" class="js_logoBox block tempImages fl downsrc" src="'+src+'">';
	 	contentStr+='<div class="form-bg"></div><div class="form-close" onclick="tempRemove(this)">';
	 	contentStr+='<img src="<?php echo UOOT;?>Public/app/images/classIcon/admin-icon1.png"></div>';
	 	contentStr+='<div class="form-prev" data-type = "prev" onclick="configPhoto(this)"><img src="<?php echo UOOT;?>Public/app/images/classIcon/admin-icon3.png"></div>';	
	 	contentStr+='<div class="form-next" data-type="next" onclick="configPhoto(this)"><img src="<?php echo UOOT;?>Public/app/images/classIcon/admin-icon2.png"></div></div>';
	 	$('.imgList').append(contentStr);
		$('input[name="tempsrc"]').val(str);
//		$('.downsrc').attr('src',src);
	}
//		$('.tempImages').attr('src',tempSrc[0])
		
		
		//图片轮播
		
	
			
		

//		 function changeTo( num ){
//              var go = num*150;
//              $(".imgList").animate({ "left" : -go },500);            
//          }
		
	//启动图配置切换
	function configPhoto(target){
		$this = $(target)
		var type = $this.attr('data-type');
		if(type =="next"){
			
			var headerLength = $this.parents('.form-icon').nextAll().length;
			if(headerLength>0){
				//如果前面有存在的话 才执行
				var thisHtml = $this.parent()[0].outerHTML;
				console.log(thisHtml)
				var thisIndex = $this.parents('.form-icon').index(); 
				$('.imgList').find('.form-icon').eq(thisIndex+1).after(thisHtml);
				 $this.parents('.form-icon')[0].outerHTML = '';
			}
			
			
		}else if(type=="prev"){
			var headerLength = $this.parents('.form-icon').prevAll().length;
			if(headerLength>0){
				//如果前面有存在的话 才执行
				var thisHtml = $this.parent()[0].outerHTML;
				console.log(thisHtml)
				var thisIndex = $this.parents('.form-icon').index(); 
				$('.imgList').find('.form-icon').eq(thisIndex-1).before(thisHtml);
				 $this.parents('.form-icon')[0].outerHTML = '';
			}
			
		}
	}	
		
		
		
		
			
				
		     function tempRemove(target){
		     	console.log(tempSrc)
	     	var k  =$(target).index()-1;
	     	console.log(k)
	     	tempSrc.splice(k,1); //splice方法会改变数组长度，当减掉一个元素后，后面的元素都会前移，因此需要相应减少i的值  
	     	console.log(tempSrc)
	
	     	$('input[name="tempsrc"]').val(tempSrc);
	     	if(tempSrc.length>1){
	     		$('.tempImages').attr('src',tempSrc[i])
	     	}else if(tempSrc.length=0){
	     		$('.tempImages').attr('src',tempSrc[0])
	     	}else{
	     		$('.tempImages').attr('src','/Public/common/drag/images/nopic.png')
	     	}
			
	     	
	     	
	     	$(target).parents('.form-icon').remove();
//	     	$this.parent().find('.tempImages').attr("src",'');

			}
	
		
		
	/*
	    function prev()	{
	    	console.log(i);
	    	if(i==0){
	    		i=tempSrc.length;
	    	}else{
	    		i--;
	    	}
	    	console.log(i);
	    	$('.tempImages').attr('src',tempSrc[i])
	    }	
		function next()	{
			if(i==tempSrc.length){
				i=0;
			}else{
				i++;
			}
	    	$('.tempImages').attr('src',tempSrc[i])
	    }	
		//图片改变情况

	     */
	     //添加图片
	      function  addicon(){
	     	 	addTypeChange('<?php echo M_URL('Index','imageslist','',GP('type-other,name-downsrc',true));?>','930px','610px',{title:'选择图片',type:'top'});	

	     	 }
	     	 
	     	
</script>
</body>

</html>
