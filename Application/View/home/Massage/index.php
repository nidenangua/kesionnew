<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>站内消息</title>
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
<style>
	.ks-message {display: none;}
	.ks-clist li {box-shadow: 0 1px 10px rgba(0,0,0,0.15);padding: 10px;border-radius: 5px;}
	.show .ks-cbox {box-shadow: 0 1px 15px rgba(0,0,0,0.15);margin-bottom: 20px;padding: 20px;}
</style>
</head>
<body class="ks-wrap">

	
	<div class="ks-wbox bRadius10">
		 <!--header-->
		<div class="ks-head-box">
				<h3 class="ks-head-title2">消息管理</h3>
		</div>
		<!--header-->

		<!--tab-->
		<div class="ks-head-tab">
			<ul class="clearfix">
				<li class="curr"><a href="<?php echo M_URL('Massage','index');?>">站内消息</a></li>
				<li ><a href="<?php echo M_URL('Massage','problemlist');?>">反馈列表</a></li>
			</ul>
		</div>
		<!--/tab-->

   <form target="hidframe"  action="<?php echo M_URL('Massage','ignoreall','',GP(''));  ?>" method="post" id="myform">
    <?php if ($Massages) {?>
   	<div class="ks-bom clearfix">
				<span class="fl">
					<label class="mr20 fl"><input type="checkbox" class="selectAll select-checks">全选</label>
					
					<button type="button" class="fr ks-heade-button mr10"  onclick="submitform(2)">忽略</button>
				</span>
		</div>
<?php }?>
     <div class="ks-clist mt20">
      <ul>
        <?php foreach($Massages as $k=>$v){ ?>
        <li class="massagesload" >
        	<div class="fl ks-txtLeft ks-wauto">
				<input type="checkbox" name="id[]" class="select-checks" value="<?php echo $v['id'] ?>" style="width: 26px;"/>
			</div>
        	<div id="<?php echo $v['id'] ?>" onclick="toRead(this)">
        		<div class="ks-cbox clearfix">
					<div class="fl ks-txtLeft ks-wauto">
	    				<span><?php echo $v['title'] ?></span>
					</div>
					<div class="fr ks-txtLeft ks-wauto">
	    				<span><?php echo date('Y-m-d',$v['addtime']) ?></span>
	    				<span data-type = '<?php echo $v['id'] ?>'><?php if($v['type'] == 1){ echo '未读';}else{ echo '已读';}?></span>
	    				<span><i class="iconfont icon-jiantou1"></i></span>
					</div>
				</div>
				<div class="ks-message" >
					<!--测试内容-->
					<div class="ks-newsArticle">
	                   	   <div drag-setdrag="inner,news" drag-render="view"><?php echo $v['content'];?><?php echo NoC($v['content']);?></div>
					</div>
					<!--测试内容-->
				</div>
        	</div>
				
	   </li>
       <?php } ?>
      </ul>
     </div>	
      <!--  </tbody>
    </table>-->
     <?php echo NoC($Massages);?>
    </form>
    
	
	
	</div>
	
	<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
	
	<script>
		module.require(['$','backstage','nicescroll'],function(){

			loadScorllJs()
		});
	function submitform(){
		inspectionCheckBox('id[]',function(){
			top.popup.confirm('确认要忽略所选项吗？',{
				determine:function(){
					$('#myform').submit();
				}
			})
		})
	}
		function toRead(target){
			$this = $(target);
			$this.toggleClass('show')
			$this.find('.ks-message').slideToggle();
			var id = $this.attr("id");
			$.ajax({
		        type : "post", 
		        data :{id:id},
		        url : "<?php echo  M_URL('Massage','editType','',GP(''));?>", 
		        success : function (data){
		           if(data == 1){
		            console.log(1)
		           	$this.find('[data-type = '+id+']').html('已读');
		           }
		        }
			})
		}
	</script>
</body>
</html>