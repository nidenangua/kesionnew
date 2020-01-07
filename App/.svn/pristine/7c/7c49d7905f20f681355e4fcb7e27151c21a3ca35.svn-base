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
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/html5.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/class.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<body class="ks-wrap">
	

	<div id="ksBoxHead" class="bg-white "> 
		<div class="Header-tool  clearfix">
			<div class="Tool-Title">
			
	
			
			<!--标题-->
			<p><a href="javascript:history.go(-1);"><i class="iconfont icon-jiantou-copy"></i>招生营销工具</a><span>/</span>活动参与人数</p>
			<!--标题-->
			
			</div>
			  <div class="clearfix ks-top-tab fr mt15" style="border: 0;">
		    <div class=" ks-top-search">
				<!--搜索--> 
				<label class="mr10">
					<select class="w150 inputText bRadius5" id="keytype">
						<option value="1" selected="selected">微信名称</option>
						<!--<option value="2" >班主任名称</option>-->
					</select>
				</label>
				<form target="hidframe" class="fr">
					<div class="fr ks-top-search">
						<input type="text" class="sc-text" name="searchText" id="keyword"  value="<?php if(isset($keyword))echo $keyword;?>">
						<input type="button" class="sc-button" name="searchBtn" value="搜索" onClick="searchByClass('<?php echo GP('p-'.$now_page); ?>','<?php echo M_URL($this->AppName.'/Index','H5userinfo',$id); ?>','<?php echo URL_MODEL;?>')">
					</div>
				</form>
				<!--搜索-->
			</div>
		  </div>	
		 </div>
    </div>
    
    
	<div class="bRadius10" id="ksBoxContent">	
	
		
		
		
		
		<!--结束-->
		
		<div class="H5-gameListScreen">
			<ul class="H5-gameOpt clearfix">
				<li><input type="checkbox" class="select-checks selectAll">全选</li>
				<li>
					<div class="shaixuan fl mr20 clearfix">
						<a>参与次数 <i class="desc-i"></i></a>
					</div> 
					<!--<div class="shaixuan fl mr20 clearfix">
						<a>优惠券金额 <i class="desc-i"></i></a>
					</div> -->
					
				</li>
				<li class="fr gameScreen"><i class="iconfont icon-filter-2 fn"></i>&nbsp;&nbsp;筛选

					<ul class="H5-gameScreen">
						<img src="//ks.kesion.com/Public/app/images/regup.png" alt="">
						
						<li>
							<span>成交情况：</span>
							<div>
								<a href="//ks.kesion.com/home.html/h5market/Index/index/7?appid-26,stype-0" class="active">不限</a>
								<a href="//ks.kesion.com/home.html/h5market/Index/index/7?appid-26,stype-1" class="">已成交</a>
								<a href="//ks.kesion.com/home.html/h5market/Index/index/7?appid-26,stype-2" class="">未成交</a>
							
							</div>
						</li>
							<li>
							<span>获奖情况：</span>
							<div>
								<a href="//ks.kesion.com/home.html/h5market/Index/index/7?appid-26,stype-0" class="active">不限</a>
								<a href="//ks.kesion.com/home.html/h5market/Index/index/7?appid-26,stype-1" class="">已获奖</a>
								<a href="//ks.kesion.com/home.html/h5market/Index/index/7?appid-26,stype-2" class="">未获奖</a>
							   
							</div>
						</li>
						

					</ul>

				</li>	
			</ul>	
		</div>
		
		<div class="H5-gameListConts">
			<ul class="H5-gameList">
			<?php foreach($values as $k=>$v){ 
				$vsetting = unserialize($v['setting']);
			?>
			<li>
				<div class="H5-ListWrap">
					<input type="checkbox"  class="select-checks">
					<div class="H5-ListContent clearfix">
						<div class="Left-Content col-12 clearfix">				
							<div class="H5-infoContent"> 
								<img class="headImg"  src="<?php echo $v['headimgurl'];?>">
								<div claXss="H5-title"><?php echo $v['nickname'];?><i class='<?php if($v['sex'] == 2){echo "iconfont icon-nv";}elseif($v['sex'] == 1){echo "iconfont icon-nan";}else{echo "iconfont icon-renyao";} ?>' ></i></div>
								<ul class="clearfix padding-140px">
									<li class="col-3">
										<div class="H5-infoMarkg">											
											<h4>
												<p>联系电话：<?php echo $v['phonenum']; ?></p>										
											</h4>
											<h4>
												<p>姓名：<?php echo $v['menbername']; ?></p>										
											</h4>
																						
										</div>
									</li>
									
									<li class="col-6">
										<div class="H5-infoMarkg">
											<?php foreach($list as $k =>$vv){
												if($k>=2){
												$listData = explode('/,/',$vv);
												
											 ?>		
																					
											<h4>
												<p><?php echo $listData[1]?>：
													<?php 
														if($listData[2]==0){
															echo $vsetting['radio'.$k];
														}elseif($listData[2]==1){
															$checkbox = explode('|',$listData[3]);
															$ary = $vsetting['checkbox'.$k];
															$str = '';
															foreach($ary as $kt =>$vt){
																$str .= $checkbox[$vt].'、';
															}
															echo $str;
														}elseif($listData[2]==2){
															$checkbox = explode('|',$listData[3]);
															$ary = $vsetting['select'.$k];
															$str = '';
															$str .= $checkbox[$ary];
															echo $str;
														}
													
													?>	
												</p>										
											</h4>
											<?php }}?>
																											
										</div>
									</li>
									<li class="col-3">
										<div class="H5-infoMarkg">											
											<h4>
												<p>参与时间：<?php echo date('Y-m-d H:i:s',$v['addtime']); ?></em></p>										
											</h4>
											<h4>
												<p>参与次数：<?php echo $h5info['number']-$v['num']; ?></em></p>										
											</h4>																			
										</div>
									</li>
								</ul>		
							</div>
							
						</div>
						
						<div class="Right-Content pos-R  clearfix">
							<div class="local-warp local-warps">								
							<!--	<span><?php if($v['isbm']){ echo '已经使用';}else{ echo '待使用';}?></span>-->
									<span><?php if($v['iswin']){ echo '<i class="c-86A8F fsize16">已中奖</i>';}else{ echo '<i class="c-92 fsize16">未中奖</i>';}?></span>
								<div class="H5-btnGroup">
									<!-- <button class="ks-bt bt-pur fn" onclick='sendmassage(<?php echo $v["id"]; ?>)' type="button" flag='<?php $v['id']; ?>'>发送通知</button> -->
								</div>
								
							</div>
							
						</div>
						
					</div>
					
				</div>
				
			</li>
			<?php }?>

			
		</ul>
		</div>
	
		
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	<!--<div id="ksBoxHead">
		<div class="generalTitle clearfix">
			<div class="fl">
			<span class="title-icon"><i class="iconfont icon-myorder"></i></span>
	        <span class="gTitle fsize18">功能说明</span>
				
			</div>
		   
	         <div class="fr">
		   	<a class="ks-bt bt-pur mr10" href="<?php echo M_URL($this->AppName.'/Index','doAddyouxi','',GP("p-$page->now_page")); ?>" style="margin-left:15px;display:inline-block">
			<i class="iconfont icon-jiahao"></i>增加游戏</a>
			
	

		   </div>
	         	<div class="fr ks-top-tab" style="border:0">
		
			<div class="fr ks-top-search">
				<label class="" style="margin-right: -1px;">
		        <select class="w150 inputText bRadius5" id="keytype">
		            <option value="1" <?php if($keytype==1)echo 'selected';?>>游戏名称</option>
		            <option value="2" <?php if($keytype==2)echo 'selected';?>>创作者</option>
		           
			    </select>
			    </label>
			    <input type="text" class="sc-text" name="searchText" id="keyword"  value="<?php if(isset($keyword))echo $keyword;?>">
			    <input type="button" class="sc-button" name="searchBtn" value="搜索" onClick="searchByClass('<?php echo GP('p-'.$now_page); ?>','<?php echo M_URL($this->AppName.'/Index','index'); ?>','<?php echo URL_MODEL;?>')">
			</div>
		</div>	
		  
		</div>
		
	
		
	</div>-->
		
		

	<!--<div id="ksBoxContent">
        <form target="hidframe"  action="<?php echo M_URL($this->AppName.'/Index','bathDelYouxi','',GP("p-$page->now_page"));  ?>" method="post" id="myform">
            
            <table width="100%" cellpadding="0" cellspacing="0" border="0"  class="ks-table">
	            <thead>
		            <tr >
		                <th class="form-in"><input name="allChecked" type="checkbox" value="allChecked" id="selectAll"></th>
		                <th>游戏名称</th>
		                <th>创建时间</th>
		                <th>奖励类型</th>
		                <th>扫码预览</th>
		                <th>操作</th>
		            </tr>
	            </thead>
                <tbody>
                	
                <?php foreach($values as $k=>$v){ ?>
                    <tr>
                        <td class="form-in">
                            <input type="checkbox" class="select-check" name="id[]" value="<?php echo $v['id'] ?>">
                        </td>
                        <td class="w200"><?php echo Field($v['name']);?></td>
                        <td class="w200"><?php echo date('Y-m-d h:i:s',$v['adddate']);?></td>
			            <td class="w200"><?php $type = $v['setting']['type'];
			                       	          if($type==1)echo "学习卡<br/> ";
			                       	          if($type==2)echo "课程红包 <br/>";
			                       	          if($type==3)echo "免费指定课程<br/>";  
			                       	          if($type==4)echo "现金红包";
			                              ?></td>
			            <td class="w200"><img src="<?php echo UOOT.'Images/QRcode/'.createQRcode(ROOT.'Images/QRcode/','http://'.APP_DOMAIN.'/h5market/inh5game?h5id='.$v['id'],'L',4,'qrcode');?>" class="m-img" style = "width: 100px;height: 100px;"></td>                  
                        <td class="w200">
                        	<div class="operate">
	                            <a href="javascript:void(0);"  onclick="Confirm('是否删除此该游戏？该操作不可逆!','<?php echo M_URL($this->AppName.'/Index','delYouxi',$v['id'],GP('p-'.$now_page)); ?>')"><em>删除</em><i class="iconfont">&#xe638;</i> </a>
                           </div>
                        </td>
                    </tr>
                <?php }?>
                </tbody>
        </table>
       

	    <input type="hidden" name="batch" id="batch1" />
    	</form>
    	 <?php echo NoC($values);?> 
	</div>-->
	
	
</div>


<div id="ksBoxFooter">
	<div class="ks-bom clearfix">
		<span class="fl">
			<!--<button class="ks-bt bt-pue" onclick="submitform(1);"><i class="iconfont icon-lajitong"></i>批量删除</button>-->
			<div class="fl">
	    <label class="mr20 fl"><input type="checkbox" class="select-checks selectAll">全选</label>
		<!--<button type="button" class="ks-bt bt-pue mr10" onclick="submitform(1)">批量删除</button>-->
		<button type="button" class="ks-bt bt-pue" onclick="submitform(1)">邀请</button>
	</div>
		</span>
		<div class="fr"><?php echo $page->show(3); ?></div>
	</div>
</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>

<script type="text/javascript" src="<?php echo UOOT;?>Public/common/js/layer/laydate.js"></script>
<script>
    
function submitform(type){
	$('#batch1').val(type);
	$('#myform').submit();
}	

var start = {
  elem: '#start',
  format: 'YYYY/MM/DD hh:mm:ss',
  //min: laydate.now(), //设定最小日期为当前日期
  max: '2099-06-16 23:59:59', //最大日期
  istime: true,
  istoday: false,
  choose: function(datas){
     end.min = datas; //开始日选好后，重置结束日的最小日期
     end.start = datas //将结束日的初始值设定为开始日
  }
};
var end = {
  elem: '#end',
  format: 'YYYY/MM/DD hh:mm:ss',
  min: laydate.now(),
  max: '2099-06-16 23:59:59',
  istime: true,
  istoday: false,
 
};

var open = {
  elem: '#open',
  format: 'YYYY/MM/DD hh:mm:ss',
  min: laydate.now(),
  max: '2099-06-16 23:59:59',
  istime: true,
  istoday: false,
 
};
laydate(start);
laydate(end);
laydate(open);
function sendmassage(id){
	$.ajax({
		type:"post",
		url:"<?php echo M_URL($this->AppName.'/Index','sendmassage','',GP('')); ?>",
		data:{id:id},
		dataType:'json',
		success:function(data){
			Alert(data.msg);
		}
	});
}    
</script>
</body>
</html>






