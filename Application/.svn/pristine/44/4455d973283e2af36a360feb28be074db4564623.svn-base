<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    <title>教室管理</title>
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/home.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/signin.css" rel="stylesheet">
    <link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="<?php echo UOOT ?>Public/wechat/css/editcampus.css"/>
    <script>
    	var uoot = '<?php echo UOOT ?>';
    </script>
</head>
	<body>
		<form id="form" action="<?php if($id){echo M_URL('WeChat','doaddClassroom',$id);}else{echo M_URL('WeChat','doaddClassroom');}?>" method='post'>
		<div class="edit-wrap">
			<div class="title1">专业分类</div>
			<select name="categoryid">
				<option value="0">请选择</option>
				<?php if($categoryAry){foreach($categoryAry as $k=>$v){?>
					<option value="<?php echo $v['categoryid']?>" <?php if($id){if($v['categoryid'] ==$values['categoryid']){echo 'selected';}} ?>><?php echo $v['categoryname']?></option>
				<?php }}?>
			</select>
		</div>
		<div class="edit-wrap">
				<div class="title1">教室名称</div>
				<input type="text" name="classroomname" id="classroom" value="<?php if($id){echo $values['classroomname'];}?>" class="edit-input"/>
		</div>
		<div class="edit-wrap">
			<div class="title1">所在学校</div>
			<select name="schoolname" id="school">
				<option value="">请选择</option>
				<?php if($school){foreach($school as $k=>$v){?>
					<option value="<?php echo $v['schoolid']?>" <?php if($id){if($v['schoolid'] ==$values['schoolname']){echo 'selected';}}?>><?php echo $v['school']?></option>
				<?php }}?>
				
			</select>
		</div>
		<div class="edit-wrap">
			<div class="title1">教室场景</div>
			<div style="display: flex;align-items: flex-end;">
				<div class="img-cr">
					<img src="<?php if($id){if($values['tempimg']){echo $values['tempimg'];}else{echo nopic(1);}}else{echo nopic(1);}?>" alt="" id="cjimg" />
					<input type="hidden" name="tempid" id="changecj" value="<?php if($id){echo $values['tempid'];}?>" />
				</div>
				<div class="edit-btn" id="" data-cjid = '<?php if($id){if($values['tempid']){echo $values['tempid'];}else{echo -1;}}else{echo -1;}?>' onclick="changeCj(this)">修改教室场景</div>
			</div>
		</div>
		<div class="edit-wrap">
				<div class="title1">教室地址</div>
				<input type="text" name="address" id="address" value="<?php if($id){echo $values['address'];}?>" class="edit-input"/>
		</div>
		<div class="edit-wrap">
				<div class="title1">容纳人数</div>
				<input type="number" name="galleryful" id="galleryful" value="<?php if($id){echo $values['galleryful'];}?>" class="edit-input"/>
		</div>
		<div class="edit-wrap">
			<div class="title1">教室图片</div>
			<div style="display: flex;align-items: flex-end;">
				<div class="img-cr">
					<img src="<?php if($id){echo Img($values['defaultpic'],1);}else{echo nopic(1);}?>" alt="" id="classRoomImg"/>
					<input type="hidden" name="defaultimg" id="defaultpic" value="<?php if($id){echo $values['defaultpic'];}?>" />
				</div>
				<div class="edit-btn" onclick="changeClassRoom()">修改教室图片</div>
				<input type="file" id="changeClassImg" style="display: none;"  name="file" onchange="inchangeClassRoom(this)"/>
			</div>
		</div>
	

		<footer class="footer">
			<div class="clearfix">
				<div class="zui-col-6">
					<div class="footer-foticon fb-white" onclick="history.go(-1)">
						取消
					</div>
				</div>
				<div class="zui-col-6" onclick="insumbit()">
					<div class="footer-foticon fb-orag">
						确认
					</div>
				</div>
			</div>
		</footer>
		</form>
		<!----------全局弹窗----------- -->
		<div class="dialog-mask" style="display: none;"></div>
		<div class="dialog-cj" style="display: none;">
			<div class="dialog-cj-search">
				<input type="search" name="" id="student" value="" placeholder="请输入学生姓名" onkeyup="search()"/>
				<i class="ion-search"></i>
			</div>
			<div class="dialog-cj-top" id="data">
				
			</div>
			<div class="dialog-cj-bottom">
				<div class="btn red" style="margin-right: 10px;" onclick="sure()">确认</div>
				<div class="btn" onclick="cancel()">取消</div>
			</div>
			
		</div>
		<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
		<script src="<?php echo UOOT; ?>Public/wechat/js/microportal/current.js"></script>
		<script type="text/javascript">
			var thisUrl = uoot + 'Json/index.php';
			var p = 1;
			var name = '';//搜索的内容
			function search(){
				name = $('#student').val();
				if(event.keyCode==13){
					$('#data').html('')
					getData()
				}
			}
			//获取数据
			function getData(){
				$.ajax({
				type:"post",
				url:thisUrl+'?act=Microportal.getTemp',
				dataType:'json',
				data:{
						"p":1,
						"name":name
					},
				success:function(res){
						if(res.getTemp.page.total_pages==0){
							$('#data').html('<div class="nodata"></div>');
							return false;
						}
						var htmls = '';
						var datas = res.getTemp.imglist;
						for(var i =0;i<datas.length;i++){
							htmls +='<div class="item" onclick="selected(this)" data-url="'+datas[i].defaultpic+'" data-id="'+datas[i].id+'"><div class="radio-inner"></div>'+
									'<div class="student-img"><img src="'+datas[i].defaultpic+'" alt="" /></div>'+
									'<div class="student-name">'+datas[i].tempname+'</div></div>'
						}
						$('#data').append(htmls)
						
						
					}
				});
			}
			getData()
			function selected(target){
				$this = $(target);
				$('#data').find('.item').each(function(){
					$(this).removeClass('active');
					$(target).addClass('active')
				})
//				if($this.hasClass('active')){
//					$this.removeClass('active')
//				}else{
//					$this.addClass('active')
//				}
			}
			//确认
			function sure(){
				var thisUrl = $('#data').find('.active').attr('data-url');
				var thisId = $('#data').find('.active').attr('data-id');
				$('#changecj').val(thisId);
				$('#cjimg').attr('src',thisUrl)
				$('.dialog-mask').hide();
				$('.dialog-cj').hide();
				
			}
			//取消
			function cancel(){
				$('.dialog-mask').hide();
				$('.dialog-cj').hide()
			}
			//选择场景图片
			function changeCj(target){
				$('.dialog-mask').show();
				$('.dialog-cj').show();
				var id = $(target).attr('data-cjid')
				if(id!=-1){
					$('#data').find('[data-id="'+id+'"]').addClass('active')
				}
				
			}
			//选择教室图片
			function changeClassRoom(id){
			    $('#changeClassImg').click();
			}
			//选择教室图片主函数
			function inchangeClassRoom(target){
				var b = target.files[0];
				var dataImg = new FormData();
				dataImg.append('file',b);
				$.ajax({
					type:'post',
					url:thisUrl+'?act=Microportal.MinUpload',
					dataType:'json',
					contentType:false,
                	data:dataImg,
                	processData:false,
					success:function(res){
						$('#classRoomImg').attr('src',res.MinUpload.info)
						$('#defaultpic').val(res.MinUpload.Jmimg)
					}
				})
			}
		function insumbit(){
			if($("#classroom").val()==''){
				toast2({
					content:'教室名字不能为空',
				})
			}else if($("#school").val()==''){
				toast2({
					content:'所在学校不能为空',
				})
			}else if($("#address").val()==''){
				toast2({
					content:'地址不能为空',
				})
			}else{
				document.getElementById('form').submit()
			}
			
		}
		</script>
	</body>
</html>