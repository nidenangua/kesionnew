<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>邮箱设置</title>
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
</head>
<style type="text/css">
	.ks-clist li{padding-left:50px;border-bottom: 1px solid #EEEEEE;padding-bottom: 10px;border-radius: 0px;}
</style>
<body class="ks-wrap">
	<div class="ks-wbox bRadius10"> 
		<!--header-->
	    <div class="ks-head-box">
	     	
	     		<div class="ks-head-nav bd_e">
	     			<a href="<?php echo M_URL('email/Index','','',GP('appid-18'));?>">邮箱设置</a><span> / </span>查看邮箱使用明细</span>
	     		</div> 
	     	
	    </div>
	    <!--header-->
					     
		
		<!--widget-->
		<div class="ks-head-widget clearfix">
			<div class="fl">
				<form target="hidframe">
					<select class="w150 inputText bRadius5" id="keytype">
						<option value="1" <?php if($keytype==1){echo 'selected="selected"';} ?>>接收者</option>
						<option value="2" <?php if($keytype==2){echo 'selected="selected"';} ?>>内容</option>
					</select>
					<div class="ks-top-search fr ">
						<input type="text" class="sc-text" name="searchText" id="keyword"  value="<?php if(isset($keyword)) echo $keyword; ?>">
						<button type="submit" class="ks-head-search" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','config'); ?>','<?php echo URL_MODEL;?>')"><i class="iconfont icon-sousuo"></i></button>
	
					</div>
				</form>
		    </div>
		    
		    <div class="fr">
				<ul class="ks-head-choice">
					<li>
						<div class="ks-head-el">
							<button class="ks-heade-button ks-head-primary" type="button" onclick="choiceClick(this)"><i class="icon-filter-2 iconfont "></i></button>
							<div class="ks-head-content ks-head-content-pr w400">
																			
								<ul class="screen">															
										<li>
											<span>选择状态：</span>
											<div>
												<a href="<?php echo M_URL($this->AppName.'/Index','config','',GP("issuccess-3,appid-$this->appid",true)); ?>" <?php if($issuccess==3) echo 'class="choice-active"';?>>所有状态</a>
							<a href="<?php echo M_URL($this->AppName.'/Index','config','',GP("issuccess-1,appid-$this->appid",true)); ?>" <?php if($issuccess==1) echo 'class="choice-active"';?>>发送成功</a>
							<a href="<?php echo M_URL($this->AppName.'/Index','config','',GP("issuccess-0,appid-$this->appid",true)); ?>" <?php if($issuccess==0) echo 'class="choice-active"';?>>发送失败</a>
											</div>
										</li>	
									
				
									</ul>
							
							</div>
						</div>
					</li>

				</ul>

		    </div>
		</div>
		</form>
		
		<form target="hidframe"  action="<?php echo M_URL($this->AppName.'/Index','emailbatch','',GP("p-$page->now_page"));  ?>" method="post" id="myform">
			<div class="ks-clist" >
				<ul class="clearfix">
				<?php foreach($values as $k=>$v){ ?> 
					<li>
		       			<div class="ks-check"><input type="checkbox" class="select-checks" name="id[]" value="<?php echo $v['id'] ?>"></div>
	        			<div class="ks-ctitle clearfix">
	        			  	<h3><?php echo Field($v['content']);?></h3>	
	        			</div>
			        	<div class="ks-cbox clearfix">
		    				<div class="fl ks-txtLeft">
		        				<p>发送时间:<?php echo date('Y-m-d H:i:s',$v['adddate']) ?></p>
		    				</div>
		    				<div class="fl ks-txtLeft">
		    					<p>接受者用户名:<?php echo Field($v['username'])?></p>	        	
		    				</div>
		    				<div class="fl ks-txtLeft">
		        				<p>状态:<i style="color: lightgreen;"><?php if($v['issuccess'] == 1){echo '成功';}else{echo '失败';} ?></i></p>
		    				</div>
			        		<div class="ks-operaRight fr">
			        		<a href="javascript:void(0);" onclick="Confirm('是否删除此邮箱？该操作不可逆!','<?php echo M_URL($this->AppName.'/Index','delEmail',$v['id'],GP('p-'.$page->now_page)); ?>')"><em>删除</em></a>
							</div>
			        	</div>
		   		    </li>
				<?php }?>
				<!--</tbody>
			</table>-->
			<?php echo NoC($values);?>
			</div>
			<input type="hidden" name="batch" id="batch" />
		</form>
		<!--/widget-->
	     
		<!--table-->
		
	    <!--/table-->  
	    <?php if(count($values)!=0){?>   
		<!--footer-->
		<div class="ks-bom clearfix">
			<span class="fl">
				<label class="mr20 fl" style="margin-left: 0px;"><input type="checkbox" class="select-checks selectAll" >全选</label>
				<button type="button" class="ks-heade-button fl" onclick="submitform(1)"><i class="iconfont icon-shanchu1"></i></button>
			</span>
			<div class="fr"><?php echo $page->show(3); ?></div>
		</div>
		<!--/footer-->
		<?php } ?>
	</div>
	  
	
	<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
	<script>
		
		module.require(['$','backstage','nicescroll'],function(){
			loadScorllJs();
			$('.titleTab li').click(function(){
				$(this).addClass('curr').siblings().removeClass('curr');
			})
			
			
			
		});
		function submitform(type){
			inspectionCheckBox('id[]',function(){
				$('#batch1').val(type);
				if(type===1){
					top.popup.confirm('确认要删除所选项吗？',{
						determine:function(){
							$('#myform').submit();
						}
					})
				}else{
					$('#myform').submit();
				}
			})

		}
	
	</script>


</body>
</html>
