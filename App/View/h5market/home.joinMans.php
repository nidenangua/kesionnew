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
<link href="<?php echo UOOT;?>Public/app/css/html5.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/class.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<body class="ks-wrap">
	

	<div id="ksBoxHead" class="bg-white "> 

    </div>
	<div class="bRadius10" id="ksBoxContent">	
		<div class="generalTitle bg-white  clearfix">
		    <span class="title-icon"><i class="iconfont icon-myorder"></i></span>
	        <span class="gTitle fsize18">招生营销工具</span> 
		    <div class="fr mt15 ml10">
		    	<!--按钮块--->
				<a class="ks-bt bt-pur mr10" href="javascript:void(0)" onclick="addTypeChange('//ks.zuojy.com/home.html/class/Index/addClass?appid-30','850px','480px',{type:'top'}); "><i class="iconfont icon-jiahao"></i>增加游戏</a>
				<!--按钮块--->
		    </div>
		    <div class="clearfix ks-top-tab fr mt15" style="border: 0;">
		    <div class=" ks-top-search">
				<!--搜索--> 
				<label class="mr10">
					<select class="w150 inputText bRadius5" id="keytype">
						<option value="1" selected="selected">班级名称</option>
						<!--<option value="2" >班主任名称</option>-->
					</select>
				</label>
				<form target="hidframe" class="fr">
					<div class="fr ks-top-search">
						<input type="text" class="sc-text" name="searchText" id="keyword" value="">
						<input type="submit" class="sc-button" name="searchBtn" value="搜索" onclick="searchByClass('appid-30','//ks.zuojy.com/home.html/class/Index/index','1')">
					</div>
				</form>
				<!--搜索-->
			</div>
		  </div>	
		</div>
		
		<!--结束-->
		
		<div class="H5-gameListScreen">
			<ul class="H5-gameOpt clearfix">
				<li><input type="checkbox" id="selectAll">全选</li>
				<li>转换率<i class="iconfont icon-sort-double-down"></i></li>
				<li>参加人数<i class="iconfont icon-sort-double-down"></i></li>
				<li class="fr gameScreen"><i class="iconfont icon-filter-2 fn"></i>&nbsp;&nbsp;筛选

					<ul class="H5-gameScreen">
						<img src="<?php echo UOOT;?>Public/app/images/regup.png" alt="" />
						<li>
							<span>活动不限：</span>
							<div>
								<a href="javascript:;" class="active">不限</a>
								<a href="javascript:;">进行中</a>
								<a href="javascript:;">已截止</a>
								<a href="javascript:;">已关闭</a>

							</div>
						</li>

						<li>
							<span>营销时间：</span>
							<div>
								<a href="javascript:;" class="active">不限</a>
								<a href="javascript:;">春季招生</a>
								<a href="javascript:;">儿童节</a>
								<a href="javascript:;">暑假招生</a>
								<a href="javascript:;">秋季招生</a>
								<a href="javascript:;">中秋国庆</a>
							</div>
						</li>

						<li>
							<span>营销模式：</span>
							<div>
								<a href="javascript:;" class="active">不限</a>
								<a href="javascript:;">竞技</a>
								<a href="javascript:;">助力</a>
								<a href="javascript:;">抽奖</a>								
							</div>
						</li>

						<li>
							<span>活动类型：</span>
							<div>
								<a href="javascript:;" class="active">不限</a>
								<a href="javascript:;">线上活动</a>
								<a href="javascript:;">线下活动</a>	
							</div>
						</li>					


					</ul>

				</li>				
			</ul>	
		</div>
		
		<div class="H5-gameListConts">
			<ul class="H5-gameList">
			<?php foreach($values as $k=>$v){?>
			<li>
				<div class="H5-ListWrap">
					<input type="checkbox"  class="select-check">
					<div class="H5-ListContent clearfix">
						<div class="Left-Content col-6 clearfix">
							<h4>
								<p><?php echo $v['name'] ?></p>
								<p><?php $type = $v['setting']['type'];
                       	          	if($type==1)echo "学习卡";
                       	          	if($type==2)echo "课程红包";
                       	          	if($type==3)echo "现金红包";  
                       	          	if($type==4)echo "无奖励";
                       	          	if($type==5)echo "无奖励";
	                       	  	?></p>
								<p><?php echo'班级字段待添加';?></p>
								<p><?php $stat = $v['isstar'];
									if($stat==0)echo "未开启";
                       	          	if($stat==1)echo "进行中";
                       	          	if($stat==2)echo "关闭了";
								?></p>
							</h4>
							
							<div class="H5-infoContent">
								<img src="<?php echo Img($v['ico']);?>" alt="">
								<div class="H5-infoMark">
									<h4>
										<p>参与人数 ：<?php echo $v['partake'];?></p>
										<p>报班人数：<?php echo $v['sign'];?></p>
										<p><?php echo date('Y-m-d H:i:s',$v['adddate']);?></p>
									</h4>	
									<h4>
										<p>网址：<?php echo 'http://'.APP_DOMAIN.'/h5market/inh5game?h5id='.$v['id'].'&classid='.$v['classid']; ?></p>										
									</h4>	
									<div class="H5-infoMarks">
										<img src="<?php echo UOOT.'Images/QRcode/'.createQRcode(ROOT.'Images/QRcode/','http://'.APP_DOMAIN.'/h5market/inh5game?h5id='.$v['id'].'&classid='.$v['classid'],'L',4,'qrcode');?>" alt="">
										<div class="showcode">
											<img class="dom" src="<?php echo UOOT;?>Public/app/images/regdom.png" alt="" />
											<img  src="<?php echo UOOT.'Images/QRcode/'.createQRcode(ROOT.'Images/QRcode/','http://'.APP_DOMAIN.'/h5market/inh5game?h5id='.$v['id'].'&classid='.$v['classid'],'L',4,'qrcode');?>" alt="" />
										</div>	
									</div>												
								</div>		
							</div>
							<div class="Content-vline"></div>
						</div>
						
						<div class="Right-Content clearfix  col-6">
							<div class="local-warp">
								<ul>
									<li>转化率：</li>
									<li><?php if($v['sign'] == 0){ echo 0;}else{ echo $v['sign']/$v['partake'];};?>%=</li>
									<li>
										<p>报班人数</p>
										<p>参与人数</p>
									</li>
								</ul>
								
							</div>
							
							<div class="local-warp">
								<div class="data-img"></div>	
								<span><i class="iconfont icon-lajitong"></i></span>
								<div class="H5-btnGroup">
									<button class="ks-bt bt-pue">编辑</button>
									
									<button class="ks-bt bt-gray">关闭</button>
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
			<button class="ks-bt bt-pue" onclick="submitform(1);"><i class="iconfont icon-lajitong"></i>批量删除</button>
		</span>
		<?php echo $page->show(3); ?>
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
    
</script>
</body>
</html>






