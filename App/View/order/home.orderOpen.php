<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit"> 
<title>学员开课</title>
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/html5.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<body>
		<form target="hidframe" id="myform" action="<?php echo M_URL('order/Index','doOrderOpen','',GP(''));?>" method="post" >
			<div class="configTab" style="display: block;">
				<ul>
					<li>
						
						
							<div class="Created-ing clearfix">
								<ul>
                                    <li>
                                        <h4>开通方式</h4>
                                        <div style="display: inline-block;"><input type="radio" id="showStudent" class="label-on"  value="1" name="opentype" checked>学生账号</div>
                                        <div style="display: inline-block;"><input type="radio" id="showuser" class="label-on"  value="2" name="opentype">用户组</div>
                                    </li>
                                    <li id="student">
										<h4>学生账号:</h4>
										<div class="Created-Content">
											<div class="word-all">
											<input class="form-textbox w300" name="username" id="username" value="" type="text" />
											</div>								
										</div> 	<span>提示：同时给多个学生开课，请用英文逗号隔开。</span>
									</li>
                                    <li id="user-group" style="display: none;">
                                        <h4>用户组:</h4>
                                        <div class="Created-ing clearfix">
                                            <select class="w300 inputText bRadius5 fl" id="type" name="user_group">
                                                <option value="-1">请选择用户组</option>
                                                <?php if(!empty($group)){
                                                foreach($group as $k =>$i){?>
                                                <option value="<?php echo $i['id']?>"><?php echo $i['name']?></option>
                                                <?php } }?>
                                            </select>
                                        </div> <span>提示：请选择用户组名称</span>
                                    </li>
									<li>
										<h4>开通类型</h4>
                                        <div class="Created-ing clearfix">
                                        <select class="w300 inputText bRadius5 fl" id="showCourse" name="type" onchange="getinfo(this)">
							            <option value="-1">选择开通类型</option>
							            <option value="0">课程</option>
                                        <?php  //这里仅控制是否显示，不进一步判断是不是VIP
                                        if (ismoduleopen($this->wxid,106,0,0)){
                                            echo('<option value="7">专栏</option>');
                                        }
                                        if (ismoduleopen($this->wxid,3,0,0)){
                                            echo('<option value="9">VIP会员卡</option>');
                                        }
                                        if (ismoduleopen($this->wxid,35,0,0)){
                                            echo('<option value="10">社群</option>');
                                        }
                                        ?>
							           
							            
						            </select>
                                     </div>
                                        <br/>
                                     <div class="Created-ing clearfix">
						            <select style="height: 100px" multiple class="w300 inputText bRadius5 fl" id="showCourse1"  name="infoid[]">
							            <!--<option value="0">选择对应课程</option>-->
						            </select>
                                            </div><span>提示：按Ctrl进行多选</span>
									</li>
									
								</ul>
							</div>
					</li>
                   
					</ul>
				</div>
				
				<!--ks-bom-->
				<div class="ks-bom form-footer clearfix">
					<span style="display: inline-block;">
						<input type="button" onclick="return(submitform())"  class="ks-bt bt-pue w120" value="确认开通" name="save">
						<a href="javascript:top.closePopup('all');" class="ks-bt w120 bt-white ml10" style="box-sizing: border-box;" >取消</a>
					</span>
				</div>
				<!--ks-bom end-->
			
			</div>	
			<?php 
            if (checkIsVipVersion($this->wxid)==false){?>
			<div style="margin:20px;margin-top:50px;font-size:16px;">说明：您当前使用的版本套餐，最多只能开通<?php echo wx_version_itemvalue(23,$this->wxid); ?>人次的学员学习订单。</div>
		    <?php } ?>
		</div>

		</form>
	</div>

	<script src="<?php echo UOOT;?>/Public/common/js/module.js?<?php echo echoHash();?>"></script>
	<script>
        $("#showStudent").on("click",function () {
            $("#student").css("display","block");
            $("#user-group").css("display","none")
        })
        $("#showuser").on("click",function () {
            $("#student").css("display","none");
            $("#user-group").css("display","block");
        })
   function getinfo(that){
	var obj = that;
	$('#showCourse1').show();
	var url = "/Json/index.php?act=Microportal.Store.getCourseList";
	var type = $(obj).val();
	$.post(url,{
	    type:type
    },function(res){
        var datas = res.filter(function (item) {
            return item.courseType != 8
        })
        //var datas = JSON.parse(datas);
        $('#showCourse1').html('');
        var str = '';
        if(datas.length>0){
            for(var i = 0;i<datas.length;i++){
                str += '<option value="'+datas[i].id+'" price="'+datas[i].price+'">'+datas[i].title+'</option>'
            }
            $('#showCourse1').append(str);
        }
    },'json')
   }
function submitform(){
	var username = $('#username').val();
	/*if(username==''){Alert('开通的学员必须填写！');return false;}*/
	$('#myform').submit();
}	
		module.require(['backstage','nicescroll'],function(){
			loadScorllJs();
			$('.top-menu li').click(function(){
				$(this).addClass('curr').siblings().removeClass('curr');
				$('.configTab:eq('+$(this).index()+')').show().siblings().hide()
			});
			$('#StartBtn').on('click', function() {
					
					$("#myform").submit()
			})	
		})
	
	</script>
</body>
</html>
