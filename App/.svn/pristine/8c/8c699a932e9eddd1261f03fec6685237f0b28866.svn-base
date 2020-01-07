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
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />

</head>
<body class="ks-wrap">
	
	<div class="ks-wbox bRadius10">
		
		<!--header-->
	     <div class="ks-head-box">
	     		<h3 class="ks-head-title2">评论管理
	     			<!--<div class="fr"> 	
	     			<a class="ks-setting-icon fl ml10" onClick="appSetUp({title:'应用设置',type:'app',appid:<?php echo $this->appid; ?>,wxid:<?php echo $this->wxid; ?>})">
	     			<i class="iconfont icon-setting"></i>
	     			</a>
	     			</div>-->
	     		</h3>
	     </div>
	     <!--header-->
	     
	     <!--widget-->
							<div class="ks-head-widget clearfix">
								<div class="fl">
									<div class="ks-search-box">
									<form target="hidframe" action="<?php echo  M_URL($this->AppName.'/Index','Index','',GP('')); ?>" method="post" >
										<!--搜索-->

										<select class="w150 inputText bRadius5 fl" id="keytype">
											<option value="1" <?php if($keytype==1) echo "selected"; ?>>消息内容</option>
											<option value="2" <?php if($keytype==2) echo "selected"; ?>>提问者</option>
										</select>
										<div class="ks-top-search fl" >
											<input type="text" class="sc-text" name="searchText" id="keyword"  value="<?php if(isset($keyword)) echo $keyword; ?>">
											<button type="submit" class="ks-head-search" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','index'); ?>','<?php echo URL_MODEL;?>')"><i class="iconfont icon-sousuo"></i></button>
										</div>
									</form>


					                
								</div>			
								</div>
								
						
									<div class="fr">
										<ul class="ks-head-choice">
										
											<li>
												<div class="ks-head-el">
													<button class="ks-heade-button ks-head-primary" type="button" onclick="choiceClick(this)"><i class="icon-filter-2 iconfont "></i></button>
													<div class="ks-head-content ks-head-content-pr w400">
																								
														<ul class="screen">															
															<li>
																<span>互动状态：</span>
																<div>
																	<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP("status-3,appid-$this->appid",true)); ?>" <?php if($status == 3){ echo 'class="choice-active"';}?>>所有问题</a>
																	<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP("status-1,appid-$this->appid",true)); ?>" <?php if($status == 1){ echo 'class="choice-active"';}?>>已审核</a>
																	<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP("status-0,appid-$this->appid",true)); ?>" <?php if($status == 0){ echo 'class="choice-active"';}?>>未审核</a>							
															</li>		
														</ul>
													</div>
											
												</div>
									<!--/widget-->
				     
													</div>
											</li>
											
										</ul>	
								</div>	
	



<form target="hidframe"  action="<?php echo M_URL($this->AppName.'/Index','batch','',GP('p-'.$page->now_page));  ?>" method="post" id="myform">       		
       		
             <table width="100%" cellpadding="0" cellspacing="0" border="0"
                   class="ks-table" style="border-bottom:0;">
                <thead>
                    <tr>
                        <th style="width: 30px;"><input type="checkbox"class="select-checks selectAll" ></th>
                        <th>应用ID</th>
                        <th class="ta-left">互动消息</th>
                        <th>提问者</th>
                        <th>时间</th>
                        <th>状态</th>              
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
             <?php foreach($values as $k=>$v){?> 
                <tr>
                    <td>
                         <input type="checkbox" class="select-checks" name="id[]" value="<?php echo $v['interactid']; ?>">
                    </td>
                    <td><?php echo $v['appid']?></td>
                    <td class="ta-left" width="35%"> 
                         <?php echo $v['interact']?>
                    </td>
                    <td><?php echo $v['membername']?></td>
                    <td><?php echo date('Y-m-d H:i:s',$v['adddate']) ?></td>
                    <td onClick="updatesStatus('<?php echo M_URL($this->AppName.'/Index','updatestatus',$v['interactid'],GP('')); ?>',<?php echo $v['interactid']?>)" id="a<?php echo $v['interactid']?>">
                    <?php if($v['status']==0){?>
                    	<span style="color: red;">未审核</span>
                    <?php }elseif($v['status']==1){?>
                    	<span style="color: green;">已审核</span>
                    <?php }?>      
                    </td>
                    <td nowrap="nowrap">
                    	<div class="operate">
	                      <!--  <a href="<?php echo M_URL($this->AppName.'/Index','edit',$v['id'],GP('')); ?>"><em>编辑</em><i class="iconfont">&#xe63d;</i> </a>-->
	                        <a href="javascript:void(0);"  onclick="Confirm('是否删除此问题？该操作不可逆!','<?php echo M_URL($this->AppName.'/Index','delinteract',$v['interactid'],GP('')); ?>')"><em>删除</em><i class="iconfont">&#xe638;</i> </a>
                        </div>
                    </td>
                </tr>
                <?php }?>
                </tbody>
            </table>
            <?php echo NoC($values);?>
          
            <input type="hidden" name="batch" id="batch1" />	
            </form>		
            
         <?php if(!empty($values)){?>

			<div class="ks-bom clearfix">
				<span class="fl">
					<label class="mr20 fl"><input type="checkbox" class="select-checks selectAll">全选</label>
					<button class="ks-heade-button mr10" onclick="submitform(1);"><i class="iconfont icon-shanchu1"></i></button>
					<button class="ks-heade-button mr10"  onclick="submitform(2);" >批量审核</button>
			        <button class="ks-heade-button" onclick="submitform(3);">批量取消审核</button>
				</span>
				<div class="fr"><?php echo $page->show(3); ?></div>
			</div>
			
			<?php }?>	
    </div>
</div>
    

<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
	module.require(['$','backstage','nicescroll'],function(){
			loadScorllJs();
		
	})
function updatesStatus(url,interactid){ 
	  $.ajax({
			type:"get",
			url:url,
			success:function(data){
				if(data==0){
					$("#a"+interactid).html('<span style="color: red;">未审核</span>');
				}else if(data==1){
					$("#a"+interactid).html('<span style="color: green;">已审核</span>');
				}
			},
			error:function(){
				alert("发生了错误,请检查!");
			}
	   })
}
function submitform(type){
	$('#batch1').val(type);
	$('#myform').submit();
}	
</script>
</body>
</html>








