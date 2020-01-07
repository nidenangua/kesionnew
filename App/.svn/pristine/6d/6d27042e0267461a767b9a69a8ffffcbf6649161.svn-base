<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>kesion教育平台</title>
<meta name="Keywords" content="kesion教育平台"/>
<meta name="Description" content="kesion教育平台" />
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/wechat.css" rel="stylesheet"> 
<link href="<?php echo UOOT;?>Public/app/css/common.css" rel="stylesheet"> 
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<style type="text/css"> .wexin-header{box-sizing: border-box; } *{ box-sizing:inherit; } </style>
</head>
<body class="ks-wrap">
	<div class="ks-wbox bRadius10">
		<!--header-->
	    <div class="ks-head-box">
	     	
		<h3 class="ks-head-title" style="border: none;">
     		微信公众号
		</h3>
	    </div>
	    <!--header-->
					     
		
		<!--widget-->
		<?php include  CURR_VIEW_PATH . "left_menu.php";?>	
		<!--/widget-->
		<!--table-->
		<!--内容-->
		<div class="fr ml10 mt20">
			<button style="height: 31px;line-height: 31px;" type="submit" name="open" value="<?php echo $setting[0]==0?'1':'0'?>"  class="ks-bt bt-pue"> <i class="iconfont icon-f14"></i><?php echo $setting[0]==0?'启用模版功能':'关闭模版功能'?> </button>&nbsp;&nbsp;&nbsp;
            <?php if ($setting[0]==1) {?>
            <button style="height: 31px;line-height: 31px;float: none" type="submit" name="ctl00$KSContent$Button1"  onclick="leadingTemplate()" id="ctl00_KSContent_Button1" class="ks-bt bt-pue"> <i class="iconfont icon-f14"></i>一键获取我的模板ID</button>
		    <?php }?>
        </div>
		<div class="ks-wbox mt20 bRadius10" >
			<table class="ks-table" cellspacing="0" border="0" id="ctl00_KSContent_list" >
				<tr class="CTitle">
				<!--<th class="form-in">启用</th>-->
				<th>序号</th>
                <th>模板库编号</th>
				<th>模板库ID</th>
				<th>标题</th>  
				<th>操作</th>
				</tr>
                <?php if ($template) {?>
                <?php foreach ($template as $k=>$v) {?>
                <tr>
                    <td class='form-in'><?php echo $k+1?></td>
                    <td style='width:20%;'><?php echo $v['number']?></td>
                    <td style='width:30%;'><?php echo $v['template_id']?></td>
                    <td style='width:20%;'><?php echo $v['title']?></td>
                    <td  style='width:20%;'><a class='del' data-href="<?php echo M_URL($this->AppName.'/test','delTemplate',$v['id'],GP(''));?>" href="" ><span style="color: red">删除</span></a></td>
                </tr>
                <?php }?>
                <?php }?>
<!--				   --><?php
//				if($template){
//				    foreach ($template as $key => $value) {
//				        echo '<tr>';
//
//				    echo "<td class='form-in'>".($key+1)."</td>";
//				echo "<td style='width:20%;'>".$value['template_id']."</td>";
//				echo "<td style='width:20%;'>".$value['title']."</td>";
//				echo "<td style='width:20%;'><a class='del' data-id='".$value['id']."'>删除</td>";
//				echo '</tr>';
//				    }
//				}else{
//
//				}?>
			</table>
			<?php echo NoC($template);?>

		</div>
		<div class="form-row   clearfix" >
			<input type="hidden"  name="wechatConfigID" id="wechatConfigID"  value="<?php echo $weixinstatus['id'];?>"/>
			<div class="form-row clearfix c-red  ml20"style="background: #ffe2dd;padding: 15px;">
			<p>1、只有认证通过的微信服务号才能使用本功能。</p>
			<p>2、需要登录微信公众平台中心,开通模版消息。</p>
			<p>3、需要登录微信公众平台中心，将行业分类设置为：IT科技/互联网|电子商务，教育/培训 或者教育/院校</p>
<!--			<p>4、设置相关模版，然后同步到本平台</p>-->
			</div>
		</div>	
		<!--内容-->
	    <!--/table-->
	            
		<!--footer-->
		<div class="ks-bom clearfix">
			<span class="fl">
						
			</span>
					
			<div class="fr">
						
			</div>
		</div>
		<!--/footer-->
	
	</div>
	
	
	<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
	<script>
		
		module.require(['$','backstage','nicescroll'],function(){
			loadScorllJs()
			$('[name=open]').click(function(){
                var type = $(this).val();
		    	$.ajax({
			        type : "post", 
			        data :{pz:type},
			        url : "<?php echo  M_URL($this->AppName.'/test','openTemp','',GP(''));?>", 
			        success : function (data)
			        {
			            if(data =='设置成功'){
			            	window.location.reload();
			            }else{
			            	Alert('设置出错，请稍后在试一试，如果一直这样请联系科汛客服');
			            }
			        }
		       })
		   	});
		 	$('.checkbox').change(function(){
		 		$.ajax({
			        type : "post", 
			        data :{id:$(this).val(),type:$(this).attr('opentype')},
			        url : "<?php echo  M_URL($this->AppName.'/test','opentemplate','',GP(''));?>", 
			        success : function (data)
			        {
			            if(data =='设置成功'){
			            	Alert(data);
			            }else{
			            	Alert('同步失败，请稍后在试一试，如果一直这样请联系科汛客服');
			            }
			        }
		       })
		 	});

            $('.del').click(function () {
                var href = $(this).data('href');
                var confim = '删除此条模版将同步删除公众号平台此条模版';
                if (confirm(confim)==true ){
                    window.location.href = href;
                }
                return false;
            });
		 	$('#chkall').change(function(){
		 		if($(this).is(':checked')){
		 			$('.checkbox').prop('checked','checked');
		 			var checkary=$('.checkbox');
		 			var data = [];
		 			for(var i=0;i<checkary.length;i++){
		 				var lsdata = [];
		 				lsdata.push($(checkary[i]).val());
		 				lsdata.push($(checkary[i]).attr('opentype'));
		 				data.push(lsdata);
		 			}
		 			$.ajax({
				        type : "post", 
				        data :{data:data},
				        url : "<?php echo  M_URL($this->AppName.'/test','opentemplate','',GP(''));?>", 
				        success : function (data){
				            if(data =='设置成功'){
				            	Alert(data);
				            }else{
				            	Alert('设置出错，请稍后在试一试，如果一直这样请联系科汛客服');	
				            }
				        }
		       		})
		 		}else{
		 			$('.checkbox').prop('checked',false);
		 		};
		 	});
		});
	

	    function leadingTemplate(){
	        $.ajax({
	            type : "post", 
	            url : "<?php echo  M_URL($this->AppName.'/test','gettemplateManage','',GP(''));?>", 
	            success : function (data)
	            {
	               
	                Alert(data);
	                //提示完后需要刷新。。。。代添加刷新
	            }
	        });
	    }
    
</script>
</body>
</html>