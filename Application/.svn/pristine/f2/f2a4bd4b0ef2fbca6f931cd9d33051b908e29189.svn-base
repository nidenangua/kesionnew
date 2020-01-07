<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>反馈消息消息</title>
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
				<li><a href="<?php echo M_URL('Massage','index');?>">站内消息</a></li>
				<li class="<?php if(ACTION == 'problemlist'){ echo 'curr'; };?>"><a href="<?php echo M_URL('Massage','problemlist');?>">反馈列表</a></li>
			</ul>
		</div>
		<!--/tab-->
		<?php if(ACTION == 'problemlist'){ ?>
		
		<!--widget-->
		<div class="ks-head-widget clearfix">
				
			<div class="fr">
				<ul class="ks-head-choice">

					<li>
						<div class="ks-head-el">
							<a class="ks-heade-button ks-head-primary" onclick="top.popup.open('/home.html/default/Website/problem',{
								title:'',
								area:['840px','720px']
							})">问题反馈</a>

						</div>
					</li>
						
				</ul>
			</div>
		</div>
		
		<!--/widget-->

		<?php };?>					
   
     <div class="ks-clist mt20">
      <ul>
        <?php foreach($Massages as $k=>$v){ ?>
        <li class="massagesload" id="<?php echo $v['id'] ?>" onclick="toRead(this)">
				<div class="ks-cbox clearfix">
					<div class="fl ks-txtLeft ks-wauto">
	    				<span><?php echo $v['title'] ?></span>
                        <?php echo($v['isreply']==1?"<font style='color:green'>有回复</font>":"")?>
					</div>
					<div class="fr ks-txtLeft ks-wauto">
	    				<span><?php echo date('Y-m-d',$v['adddate']) ?></span>
	    				<span><i class="iconfont icon-jiantou1"></i></span>
					</div>
				</div>
				<div class="ks-message" >
					<!--测试内容-->
					<div class="ks-newsArticle">
	                   	   <div drag-setdrag="inner,news" drag-render="view">
                              <?php echo $v['content'];?>
                             <?php echo($v['isreply']==1?"<br/><strong>回复内容：</strong>".$v['reply_content']:"");?>
                              <?php echo NoC($v['content']);?>
                              </div>
					</div>
					<!--测试内容-->
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
		module.require(['$','backstage','nicescroll']);
		function submitform(type){
			$('#batch1').val(type);
			$('#myform').submit()
		};
		function toRead(target){
			$this = $(target);
			$this.toggleClass('show')
			$this.find('.ks-message').slideToggle();
		}
	</script>
</body>
</html>