<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="renderer" content="webkit"> 
    <title>轮播图标签</title>
    <link rel="Stylesheet" href="/Public/drag/css/drag.base.css">
    <link rel="Stylesheet" href="/Public/drag/css/kesion.form.css">
    <link rel="Stylesheet" href="/Public/drag/color/colorpicker.css">
    <link rel="Stylesheet" href="/Public/drag/color/layout.css">
    <link rel="Stylesheet" href="/Public/drag/css/setcarousel.css" />

  
</head>
<body>

	<div id="setCarousel">
      	<div class="ks-title"><button class="ks-btn f-r" onclick="page.addImg()">+ 添加图片</button>图片设置</div>
        <div class="carousel-img">
            <ul id="carouselBox"> 
            </ul>
        </div>
	                  
      	<div class="ks-form">
      		<div class="ks-title">参数设置</div>
      		<ul>
      			<li>
      				<div class="ks-form-title">轮播效果</div>
      				<div id="carouselType" class="clear">
          				<div class="ks-option selected" data-value="slide">滑动</div>
                  		<div class="ks-option" data-value="fade">淡入淡出</div>
                  </div>
      			</li>
      			<li>
      				<div class="ks-form-title">滚动方向</div>
      				<div id="carouselAxis" class="clear">
          				<div class="ks-option selected" data-value="X">横轴滚动</div>
              			<div class="ks-option" data-value="Y">纵轴滚动</div>
                  </div>
      			</li>

                <li>
                	<div class="ks-form-title">设置宽度</div>
                    <input type="checkbox" name="full" class="ks-switch" />
                </li>
              
                <li id="width" class="d-none">
                	<div class="ks-form-title">宽度设置</div>
                    <input type="number" name="width" value="900" style="width: 100px;" class="ks-text mr10" /><span class="ks-tips">px</span>
                </li>
                <li>
                	<div class="ks-form-title">高度设置</div>
                    <input type="number" name="height" value="300" style="width: 100px;" class="ks-text mr10" /><span class="ks-tips">px</span>
                </li>
      			
      			<li>
                	<div class="ks-form-title">左右按钮</div>
                    <input type="checkbox" name="arrow" class="ks-switch" checked="checked" />
                </li>
                <li>
                	<div class="ks-form-title">小圆点</div>
                    <input type="checkbox" name="dots" class="ks-switch" checked="checked" />
                </li>
                <li>
                	<div class="ks-form-title">动画执行速度</div>
                    <input type="number" name="speed" value="400" style="width: 100px;" class="ks-text mr10" /><span class="ks-tips">ms</span>
                </li>
                <li>
                	<div class="ks-form-title">自动播放</div>
                    <input type="checkbox" name="autoplay" class="ks-switch" checked="checked" />
                </li>
      			<li style="border-bottom:0px;">
                	<div class="ks-form-title">自动播放间隔</div>
                    <input type="number" name="interval" value="3000" style="width: 100px;" class="ks-text mr10" /><span class="ks-tips">ms</span>
                </li>
      			
      		</ul>
      	</div>

	         
	</div>
	
	<div class="ks-footer" id="footer"><span class="d-inline-block"><div class="ks-btn ks-btn-normal" onClick="page.determine()" id="determine">确定</div><div class="ks-btn" onClick="parent.closePopup(window.name)">取消</div></span></div>
	
    <div class="set-link-box">
      
          <div class="title"><span class="close" onClick="closeLinkBox()"></span>设置链接</div>
          <div class="ks-tab ks-tab-small">
              <ul>
                  <li class="active"><span>常用</span></li>
                  <li><span>栏目</span></li>
                  <li><span>内容</span></li>
              </ul>
          </div>
          <div class="clear"></div>
          <div class="tab-box">
              
              <div class="box">
                  <div class="box-rt" style="margin-left:0;">
                      <ul id="commonClass" class="selectClass">
                          
                      </ul>
                  </div>
              </div>
              
              <div class="box d-none">
                  <div class="box-lt">
                      <ul id="modelClass" class="mClass">
                      </ul>
                  </div>
                  <div class="box-rt">
                      <ul id="classCont" class="selectClass">
                          <div class="tips">请先选择模型</div>
                      </ul>
                  </div>
              </div>
              
              <div class="box d-none">
                  <div class="box-lt">
                      <ul id="viewClass" class="mClass">
                      </ul>
                  </div>
                  <div class="box-rt">
                      <div class="rt-sc">
                          <div class="class-select" id="select">
                              <div class="checked"><i class="icon-xiala"></i><span>全部</span></div>
                              <ul>
                                 <!--子分类赋值-->
                              </ul>
                          </div>
                          <input name="sckey" type="text" class="sc-text"><input name="" value="&#xe60a;" type="button" class="sc-button drag-font" onClick="contSearch()">
                      </div><!--rt-sc-->
                      
                      <div>
                          <ul id="viewCont" class="selectClass" style="height:120px;">
                              <div class="tips">请先选择模型</div>
                          </ul>
                      </div>
                  </div>
              </div>
              
              <div class="clear"></div>
             
          </div>
          
          
     </div>
     
    <textarea id="labelContent" class="d-none"><?php if(!empty($value)){?><?php echo $value['labelcontent'];?><?php }?></textarea>
     
    <script src="/Public/drag/js/utils.js"></script>
   	<script>utils.loadJs(['jquery','nicescroll','colorpicker','form'])</script>

	<script>
		
		var $carouselBox = $('#carouselBox'),
			imgTextTarget = _id('imgurl_1'),
			labelFlag = 'add';
			
		top.imgUploadBack = function(src){
			imgTextTarget.value = src;
		};
		
		var page = new utils.page({
			ready:function(){
				var that = this;		
				_id('setCarousel').style.height = window.innerHeight-_id('footer').offsetHeight+'px';
				
				$("#setCarousel").niceScroll({  
					cursorcolor:"rgba(0,0,0,0.3)",  
					cursoropacitymax:1,  
					touchbehavior:false,  
					cursorwidth:"7px",  
					cursorborder:"0", 
					cursorborderradius:"10px"  
				}); 
				$('.ks-option').click(function(){
					$(this).addClass('selected').siblings().removeClass('selected');
				});
				
				//编辑轮播图
				if(location.href.indexOf('LabelEdit')!=-1){
					
					labelFlag = 'edit';
					
					//获取标签内容
					var labelContentValue = '<div drag-carousel="'+_id('labelContent').value.split('<div drag-carousel="')[1].replace('{/KS:Label}','');
					
					//定义标签对象
					var $labelContent = $(labelContentValue);
					var index = 0;
			    	$labelContent.find('li').each(function(){
			    		index++;
			    		var bgColor = $(this).css('background-color'),
			    			bgUrl = $(this).css('background-image');
			    		bgColor = parent.colorHexBack(bgColor);
			    		
			    		if(bgUrl.indexOf('url(')==-1){
			    			bgUrl = '';
			    		}else{
			    			bgUrl = bgUrl.replace('url("','').replace('")','');
			    		};
			    		var link = '';
			    		var target = 1;
			    		if($(this).find('a').length!=0){
			    			link = $(this).find('a').attr('href');
			    			if($(this).find('a').attr('target')!='_blank'){
			    				target = 0;
			    			}
			    		};
			
			    		var liCode = that.getLiCode(index,bgColor,bgUrl,link,target);
						$carouselBox.append(liCode);
			    	});
					
					//获取轮播图配置信息
			    	var parameter = $labelContent.attr('drag-carousel').split(',');
					var parameterLength = parameter.length;
					var carouselArray = {};
					for(i=0;i<parameterLength;i++){
						var nodeName = parameter[i].split(':')[0];
						var nodeContent = parameter[i].split(':')[1];
						if(nodeContent=='true'){
							nodeContent = true;
						};
						if(nodeName=='speed'||nodeName=='interval'){
							nodeContent = Number(nodeContent)
						};
						carouselArray[nodeName] = nodeContent;
					};
					
					//轮播效果
					if(carouselArray.scrollType!='slide'){
						$('input[name="arrow"]')[0].checked = false;
						$('#carouselType').find('.ks-option').eq(1).click();
					};
			
					//左右按钮
					if(carouselArray.arrow!=true){
						$('input[name="arrow"]')[0].checked = false;
					};
			
					//自动播放
					if(carouselArray.autoPlay!=true){
						$('input[name="autoplay"]')[0].checked = false;
					};
			
					//滚动方向
					if(carouselArray.axis!='X'&&carouselArray.axis!='x'){
						$('#carouselAxis').find('.ks-option[data-value="Y"]').click();
					};
			
					//小圆点
					if(carouselArray.dots!='1'){
						$('input[name="dots"]')[0].checked = false;
					};
					//宽度
					if(carouselArray.width!='100%'){
						$('input[name="full"]')[0].checked = true;
						$('#width').show();
						$('input[name="width"]')[0].value = carouselArray.width;
					};
					//高度
					$('input[name="height"]')[0].value = carouselArray.height;
			
					//播放速度
					$('input[name="speed"]')[0].value = carouselArray.speed;
			
					//播放间隔
					$('input[name="interval"]')[0].value = carouselArray.interval;
								
				}else{
					this.addImg();
				};
				

				form.switch($('.ks-switch'));
				
				$('[check-name="full"]').click(function(){
				  	if($('input[name="full"]')[0].checked){
				  	 	$('#width').show();
				  	}else{
				  		$('#width').hide();
				  	}
				});
				
				//颜色赋值
				this.setcolor();
				
			},
			upload:function(target){
				
				imgTextTarget = _id(target.getAttribute('data-id'));
				
				//选择图片
				top.popup.open({
					url:'<?php echo M_URL('Index','imageslist','',GP('type-other,name-imgurl',true));?>',
					area:[800,600],
					zIndex:99999,
				});
			},
			addImg:function(){
				 var imgLength = $carouselBox.find('li').length,
				 	 imgId = imgLength+1;
				 var liCode = this.getLiCode(imgId,'#ffffff','','',1);
				 $carouselBox.append(liCode);
			 	  
				 this.setcolor();
				 
			},
			//获取添加图片代码
			getLiCode:function(imgId,bgColor,bgUrl,link,target){
			  	 var linkDataFlag = 0,
			  	 	 linkDisabled = 'disabled',
			  	 	 linkOn = '',
			  	 	 targetOption = '<option value="0">当前窗口</option><option value="1" selected>新窗口</option>';
			  	 if(target==0){
			  	 	targetOption = '<option value="0" selected>当前窗口</option><option value="1">新窗口</option>';
			  	 }
			  	 if(link!=''&&link!=undefined){
			  	 	linkDataFlag = 1;
			  	 	linkDisabled = '';
			  	 	linkOn = ' flag-link-on';
			  	 };
			  	 var img = '';
			  	 if(bgUrl!=''){
			  	 	img = '<img src="'+bgUrl+'">'
			  	 };
			  	 var linkText = link || '';
			  	 var code = '<li>'+
							'	<div class="btn-delete" onclick="page.imgDelete(this)" title="删除"></div>'+
							'	<div class="li-tit">图片'+imgId+'</div>'+
		           			'	<div class="img-text"><input name="" type="text" value="'+bgColor+'" class="colorpickerField" /><em>|</em><input name="imgurl" type="text" placeholder="图片地址" value="'+bgUrl+'" class="text" id="imgurl_'+imgId+'_text" /></div>'+
		           			'	<input data-id="imgurl_'+imgId+'" type="button" value="选择图片" class="btn btn2" onclick="SelectFiles(this)" /><div class="img_preview" id="imgurl_'+imgId+'">'+img+'</div>'+
		        			'	<div class="clear"></div>'+
		            		'	<div class="carousel-text">'+
		            		'		<div class="c-text"><input name="linktext" type="text" value="'+linkText+'" placeholder="链接地址" class="text" '+linkDisabled+' /><div class="flag-link'+linkOn+'" data-flag="'+linkDataFlag+'" onClick="linkFlagClick(this)"></div><div class="link-icon" onclick="setLink(this)"></div></div>'+
		            		'		<div class="item-select"><select class="ks-select">'+targetOption+'</select></div>'+
		            		'	</div>'+
							'	<div class="clear"></div>'+
							'</li>';
				return code;
			  
			},
			setcolor:function(){
				$('.colorpickerField').each(function() {
					  var $that = $(this);
					  $(this).ColorPicker({
						  onSubmit: function(hsb, hex, rgb, el) {
							  $(el).val(hex);
							  $(el).ColorPickerHide();
						  },
						  onBeforeShow: function () {
							  $(this).ColorPickerSetColor(this.value);
						  },
						  onChange: function (hsb, hex, rgb) {
							 $that.val('#'+hex);
						  }
					  }).bind('keyup', function(){
						  $(this).ColorPickerSetColor(this.value);
					  });
		            
		        });
		 	},
		 	imgDelete:function(target){
		 		if($carouselBox.find('li').length<=1){
				   parent.popup.tips({
				   	 title:'至少需要一张图片'
				   });
				   return false;
				};
		 		$(target).parent().remove();
		 	},
		 	determine:function(){
		 		
			 	var carouselContent = '';
				var liLength = $carouselBox.find('li').length;
				for(var l=0;l<liLength;l++){
				  var bgColor = $carouselBox.find('li').eq(l).find('.colorpickerField').val();
				  var imgUrl = $carouselBox.find('li').eq(l).find('input[name="imgurl"]').val();
				  var imgLink = $carouselBox.find('li').eq(l).find('input[name="linktext"]').val();
				  var linkFlag = $carouselBox.find('li').eq(l).find('.flag-link').attr('data-flag');
				  var target = $carouselBox.find('li').eq(l).find('.ks-select option:selected').val();
				 
				  if(target==1){
				  	  target = ' target="_blank"';
				  }else{
				  	  target = '';
				  };
				  
				  if($.trim(imgLink)==''){
				  	 imgLink = '/'
				  }
				
				  var backgroundUrl = '';
				  if($.trim(imgUrl)!=''){
				    backgroundUrl = ' url('+imgUrl+') no-repeat 50% 50%'
				  };
				
				  var a = '<a href="'+imgLink+'"'+target+'></a>';
				  if(linkFlag==0){
				  	  a = '';
				  };
				  
				  carouselContent += '		<li style="background:'+bgColor+''+backgroundUrl+'">'+a+'</li>\n';	
				 
				};
				
				
				var type = $('#carouselType').find('.selected').attr('data-value');
				var axis = $('#carouselAxis').find('.selected').attr('data-value');
				var width = '100%';
				if($('input[name="full"]')[0].checked){
					  width = $('input[name="width"]').val();
				};
				var height = $('input[name="height"]').val();
				var speed = $('input[name="speed"]').val();
				var interval = $('input[name="interval"]').val();
				var autoplay = $('input[name="autoplay"]')[0].checked;
				var arrow = $('input[name="arrow"]')[0].checked;
				var dots = $('input[name="dots"]')[0].checked;
				if(dots==true){
					 dots = 'dots:1,';
				}else{
					dots = '';
				};
								
				//得到标签内容
			    carouselContent = '<div drag-carousel="object:li,scrollType:'+type+',axis:'+axis+',width:'+width+',height:'+height+',arrow:'+arrow+',autoPlay:'+autoplay+','+dots+'speed:'+speed+',interval:'+interval+'">\n'+
			  			'	<ul>\n'+
						''+carouselContent+''+
						'	</ul>\n'+
						'</div>';
			 	
			 	
			 	
				var labelCont = '{KS:Label Type="State" CacheTime="0"}'+carouselContent+'{/KS:Label}';
			
				if(labelFlag=='edit'){
					<?php if(!empty($value)){?>
					//编辑标签
					$.post('/Plus/Ajaxlabel.php?act=EditLabel&pathid='+parent.pathid+'&tempid='+parent.tempid+'&labeltype=<?php echo $labeltype;?>&labelid=<?php echo $labelid;?>',{labelcontent:labelCont},function(data){
						
						parent.carouselBack('edit',data,window.name);
						
					},"json");
					<?php }?>
				}else if(labelFlag=='add'){
					
					
					//添加标签
					$.post('/Plus/Ajaxlabel.php?act=SaveLabel&pathid='+parent.pathid+'&tempid='+parent.tempid+'&labeltype=<?php echo $labeltype;?>',{labelcontent:labelCont},function(data){
						
						parent.carouselBack('add',data,window.name);
						
					},"json");
				
				};

			}
			 	
			
		});
		
		//链接开关
	  function linkFlagClick(obj){
		  if($(obj).attr('data-flag')==1){
			  $(obj).removeClass('flag-link-on');
			  $(obj).prev().attr('disabled',true);
			  $(obj).attr('data-flag',0);
		  }else{
			  $(obj).addClass('flag-link-on');
			  $(obj).prev().attr('disabled',false);
			  $(obj).attr('data-flag',1);
		  };
	  };

	  //关闭连接窗口
	  function closeLinkBox(){
		  $setLinkBox.fadeOut(300);
		  $('.link-icon').removeClass('active');
	  };
	  	
	  //设置链接
	  function setLink(obj){
		  $(obj).addClass('active');
		  $linktext = $(obj).parent().find('input[name=linktext]');
		  $linktext.focus();
		  var ofTop = $(obj).offset().top+35;
		  var ofBot = $(window).height()-ofTop+45;
		  $setLinkBox.fadeIn(300);
		  if(ofTop<$(window).height()/2){
			  $setLinkBox.css({top:ofTop});
		  }else{
			  $setLinkBox.css({top:'auto',bottom:ofBot});
		  };
		  
		  if(loadFlag==false){
			  $.ajax({
				  url:"/plus/ajaxlabel.aspx?action=navcommonlist",
				  success:function(data){
					  $('#commonClass').html(data);		
					  loadFlag = true;
				  }
			  });
			  
		  };
					
	  };
		
		
	</script>

</body>
</html>