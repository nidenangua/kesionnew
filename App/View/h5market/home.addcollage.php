<!doctype html>
<html>
<head>
	<?php $title = ''; ?>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="renderer" content="webkit"> 
	
	<title><?php if(empty($this->columnid)){ echo '添加'; }else{echo '编辑'.$value['title']; }?></title>
	
	<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/webuploader/webuploader.css" rel="stylesheet">	
	<style>
        .form-star{left:0;}		
        .form-box {min-height:60px;padding:15px}
        .form-row {padding-bottom:30px}
        .form-row .name, .form-info {display:inline-block;vertical-align: top;}
        .form-row .name {min-width:120px}
        .form-info {font-size:14px;color:#ababab;line-height:36px}
        .form-detail {margin-top:10px;color:#ababab}
        .add-shop {background: transparent; color: #e5412c!important; border: 1px dashed;}
</style>
</head>
<body class="ks-wrap">
	
		<div class="ks-wbox bRadius10">
			<div class="ks-head-nav">
				<!--标题-->
				<a href="javascript:history.go(-1);">拼团</a><em>/</em> 创建拼团			<!--标题-->
			</div>
		
			<div class="knowledge">
			
				


				<div class="knowledge-right">
						
					
					<!--基本资料-->
					<form target="hidframe"  id="myform" class="form-horizontal" action="<?php if(isset($values)){echo M_URL($this->AppName.'/Index','doeditcollage',$values['id'],GP(''));}else{echo M_URL($this->AppName.'/Index','doaddcollage','',GP(''));} ?>" method="post" enctype="multipart/form-data">
						<div class="form-title2">课程信息</div>
						<div class="form-box">
							<div class="form-row">
								<span class="name name-nowrap ">关联课程<i class="form-star">*</i></span>
								<div class="form-info">
                                  <select class="w300 inputText bRadius5 fl" id="showCourse"  name="ctype" onchange="getinfo(this)">
												<option value="0">选择知识课程</option>
											<option value="3" <?php if(isset($values)){if($values['type'] == 3){ echo 'selected';}} ?>>图文</option>
											<option value="4" <?php if(isset($values)){if($values['type'] == 4){ echo 'selected';}} ?>>音频</option>
											<option value="1" <?php if(isset($values)){if($values['type'] == 1){ echo 'selected';}} ?>>点播</option>
											<option value="2" <?php if(isset($values)){if($values['type'] == 2){ echo 'selected';}} ?>>语音</option>
											<option value="5" <?php if(isset($values)){if($values['type'] == 5){ echo 'selected';}} ?>>直播</option>
											<option value="6" <?php if(isset($values)){if($values['type'] == 6){ echo 'selected';}} ?>>试卷</option>
										</select>
										<select onchange="getprice(this)" class="w300 inputText bRadius5 fl" id="showCourse1" <?php if(isset($values)){if($values['type'] !=0){ echo 'style="display:block"'; }else{ echo 'style="display:none"'; }}else{ echo 'style="display:none"'; } ?>  name="infoid">
											<option value="0">选择对应课程</option>
										</select>
										
                                </div>
							</div>
							<div class="form-row">
								<span class="name name-nowrap">课程原价</span>
								<div class="form-info" id="price">
                                    0.00元
                                </div>
							</div>
						
						</div>
						<div class="form-title2">拼团信息</div>
						
						<div class="form-box" style="min-height: auto;">	
						
								<div class="form-row">
									<span class="name name-nowrap">拼团活动时间<i class="form-star">*</i></span>
                                    <div class="form-info">
                                        <input name="startime" value="<?php if(isset($values)){ echo date('Y-m-d',$values['startime']);}else{ echo '';} ?>" type="text" id="dateStart" class="ks-head-input  w300 " placeholder="开始时间" lay-key="1"> 至
                                        <input name="endtime" value="<?php if(isset($values)){ echo date('Y-m-d',$values['endtime']);}else{ echo '';} ?>" type="text" id="dateEnd"  class="ks-head-input w300 " placeholder="结束时间" lay-key="0">


                                    </div>
                                </div>	
									
                                <div class="form-row">
                                     <span class="name name-nowrap">拼团人数<i class="form-star">*</i></span>
                                     <div class="form-info">
                                             <input value="<?php if(isset($values)){ echo $values['setting']['rewardpeple'];}else{ echo '2';} ?>" type="text" name="rewardpeple"  class="ks-head-input  w150 " placeholder="输入拼团人数" lay-key="1">人
                                             <p class="form-detail">包括团长在内的人数，建议2-10人</p>
                                     </div>
                                </div>

                                  <div class="form-row">
                                     <span class="name name-nowrap">拼团时限<i class="form-star">*</i></span>
                                     <div class="form-info">
                                        <div class="clearfix">
                                            <label class="radioLabel fl label-on">
                                                <input type="radio" value="24" name="timexz"  <?php if(isset($values)){if($values['setting']['timexz'] ==24){ echo 'checked=""'; }}else{ echo 'checked=""'; } ?> >24小时
                                            </label>
                                            <label class="radioLabel fl">
                                                <input type="radio" value="48" name="timexz" <?php if(isset($values)){if($values['setting']['timexz'] ==48){ echo 'checked=""'; }} ?> >48小时
                                            </label>
                                        </div> 
                                       
                                     </div>
                                </div>


                                <div class="form-row">
                                       <span class="name name-nowrap">团员价格<i class="form-star">*</i></span>
                                       <div class="form-info">
                                       <input value="<?php if(isset($values)){ echo $values['setting']['teammoney'];}else{ echo '';} ?>" type="text"  class="ks-head-input  w150 " placeholder="请输入价格" name="teammoney"><font>元</font>
                                             <p class="form-detail">拼团价格设置不得高于原价，且不得为0</p>
                                       </div>
                                </div>
                                  <div class="form-row">
                                     <span class="name name-nowrap">团长价格<i class="form-star">*</i></span>
                                     <div class="form-info">
                                          
                                         <input type="text" value="<?php if(isset($values)){ echo $values['setting']['leadmoney'];}else{ echo '';} ?>"  class="ks-head-input  w150 " placeholder="请输入价格" name="leadmoney">
                                        <p class="form-detail">团长价格不得高于拼团价格,0为免费</p>
                                     </div>
                                </div>

                                  <div class="form-row">
                                     <span class="name name-nowrap"></span>
                                     <div class="form-info">
                                      <div class="clearfix">
                                         <button class="ks-bt bt-pue">保存</button>
                                      </div>    
                                     
                                      <p class="form-detail" style="color: red;">拼团一旦设置相关活动则不能更改上述信息，仅可延长结束时间</p>
                                      
                                     </div>
                                </div>

									
						</div>
						
					
					
					</form>
					
					
				</div>
				
			</div>
	</div>
	
	
	<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
	<script>
		module.require(['$','webuploader','backstage','laydate'],function(){
             var startDate =laydate.render({
                elem: '#dateStart',
                done:function(value,date){
                if( value !== '' ){
                endDate.config.min.year = date.year;
                endDate.config.min.month = date.month - 1;
                endDate.config.min.date = date.date + 1;
                }else{
                endDate.config.min.year = '';
                endDate.config.min.month = '';
                endDate.config.min.date = '';
                }
                }
                });


                var endDate = laydate.render({
                elem: '#dateEnd',
                done:function(value,date){
                if( value !== '' ){
                startDate.config.max.year = date.year;
                startDate.config.max.month = date.month - 1;
                startDate.config.max.date = date.date;
                
                }else{
                startDate.config.max.year = '';
                startDate.config.max.month = '';
                startDate.config.max.date = '';
                }
                }
                });

			
		});
		function isFree(el){
			document.getElementById('pricebox').style.display = el.value == 1 ? 'block' : 'none'
		}
		top.imgUploadBack = function(src,img){
			$('.defaultpic').css('background-image','url('+src+')');
			$('input[name="defaultpic"]')[0].value = img;
		};
		function do_reg(type){
			getId('typea').value = type;
			var title = $("input[name='title']").val();
			if(title==''){Alert('<?php echo $title;?>名称不能为空');return false}
	
			$("#myform").submit()
		};
		function getinfo(that){
		var obj = that;
		$('#showCourse1').show();
		var url = "<?php echo M_URL('voucher/Index','getinfo','',GP('')); ?>";
		var type = $(obj).val();
		$.ajax({
			type:"post",
			url:url,
			data:{'type':type},
			success:function(datas){
				 var datas = JSON.parse(datas);
				 $('#showCourse1').html('');
				 var str = '<option value="0">选择对应课程</option>';
				 if(datas.length>0){
					
					 for(var i = 0;i<datas.length;i++){
							str += '<option value="'+datas[i].id+'" price="'+datas[i].price+'">'+datas[i].title+'</option>'
					 }
					 $('#showCourse1').append(str);
					 // $('#price').val('￥'+datas[0].price);
					 // $('#price').show();
				 }
			},
			
		});
	}
	function getprice(that){
		var obj = that;
		var type = $(obj).find('option:selected').attr('price');
		if(typeof type ==='undefined'){
			type = '0.00';
		}
		 $('#price').html(type+'元');
		
	}
	</script>
<?php if(isset($values)){ ?>
<script src="<?php echo UOOT;?>Public/common/js/jquery.min.js"></script>
<?php if(isset($values)){if($values['type'] !=0){ ?>
<script>
	function getinfos(){
		var url = "<?php echo M_URL('voucher//Index','getinfo','',GP('')); ?>";
		var type = '<?php echo $values["type"]  ?>';
		var id = '<?php echo $values["infoid"]  ?>';
		$.ajax({
			type:"post",
			url:url,
			data:{'type':type},
			success:function(datas){
				 var datas = JSON.parse(datas);
				 $('#showCourse1').html('');
				 var str = '<option value="0">选择对应课程</option>';
				 if(datas.length>0){
					
					 for(var i = 0;i<datas.length;i++){
						 if(datas[i].id == id){
								str += '<option value="'+datas[i].id+'" selected price="'+datas[i].price+'">'+datas[i].title+'</option>'
								 $('#price').html(datas[i].price+'元');
						 }else{
								str += '<option value="'+datas[i].id+'" price="'+datas[i].price+'">'+datas[i].title+'</option>'
						 }
					 }
					 $('#showCourse1').append(str);

				 }
			},
			
		});
	}
getinfos()
</script>
<?php }} ?>
<?php if($edit == 2){ ?>
<script>
$('input').attr('disabled',true);
$('select').attr('disabled',true);
$('button').attr('disabled',true);
</script>
<?php }elseif ($edit == 1) { ?>
<script>
$('input').attr('disabled',true);
$('select').attr('disabled',true);
$('[name=endtime]').removeAttr("disabled"); 	
</script>
<?php }} ?>
</body>
</html>