<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<link rel="shortcut icon" href="favicon.ico">
<link href="<?php echo UOOT;?>Public/admin/css/html5.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
<link href="<?php echo UOOT;?>Public/app/css/laydate.css" rel="stylesheet">
</head>

<body class="gray-bg">
<div class="wrapper" style="margin-top:35px">
<form target="hidframe"  method="post" target="hidframe"  action="<?php echo UOOT;?>admin.php/home/Setting/updateBase" class="form-horizontal" enctype="multipart/form-data">
<div class="row">
<div id="manage_top" class="menu_top_fixed  p15 height73" >
    <div class="ibox-title">
        <h3 class="fl">&nbsp;&nbsp;网校流水
		    <a href="<?php echo M_URL('Paylog','wxpaylog'); ?>" class="mr20" >消费明细</a> 
		    <a href="<?php echo M_URL('order/Index','index','',GP('appid-4',true)); ?>" class="mr20 act">订单管理</a>  
        	&nbsp;&nbsp;&nbsp;&nbsp;订单个数&nbsp;&nbsp;<font class="defColor" size="5px"><?php echo $options['totalput']; ?></font>
        	&nbsp;&nbsp;&nbsp;&nbsp;本年新增&nbsp;&nbsp;<font class="defColor" size="4px"><?php echo $yearCout; ?></font>
        	&nbsp;&nbsp;&nbsp;&nbsp;本月新增&nbsp;&nbsp;<font class="defColor" size="4px"><?php echo $mCout; ?></font>
        	&nbsp;&nbsp;&nbsp;&nbsp;本周新增&nbsp;&nbsp;<font class="defColor" size="4px"><?php echo $weekCount; ?></font>
        	&nbsp;&nbsp;&nbsp;&nbsp;今日新增&nbsp;&nbsp;<font class="defColor" size="4px"><?php echo $dayCout; ?></font>
        	&nbsp;&nbsp;&nbsp;&nbsp;总金额(含线下)&nbsp;&nbsp;<font class="defColor" size="4px"><?php echo $allcount; ?></font>
			&nbsp;&nbsp;&nbsp;&nbsp;线上实收&nbsp;&nbsp;<font class="defColor" size="4px"><?php echo $onlinecount; ?></font>
			&nbsp;&nbsp;&nbsp;&nbsp;手续费总计&nbsp;&nbsp;<font class="defColor" size="4px"><?php echo $poundage; ?></font>
        </h3>
        <div class="fr">
             <div class="fl ks-top-search">
			<!--搜索-->
			<form target="hidframe" class="fr">
					
			<select class="inputText bRadius5 fl" id="keytype" style="width: 78px;">
			    <option  value="1" <?php if($keytype==1){echo 'selected="selected"';} ?>>订单号</option>
				<option  value="2" <?php if($keytype==2){echo 'selected="selected"';} ?>>用户名</option>
				<option  value="3" <?php if($keytype==3){echo 'selected="selected"';} ?>>网校id</option>
	  	    </select>
			<input type="text" class="sc-text" name="searchText" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>" style="width: 157px;margin-left:0;">
            <input type="button" class="sc-button" onclick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','index'); ?>','<?php echo URL_MODEL;?>');" name="searchBtn" value="搜索" style="position: relative;top: -3px;width: 50px;">
			</form>
						
			<!--搜索-->
			</div> 
              
              
        </div>
        
    </div>
</div>


<!-- </div> -->

<div id="ksBoxContent">
	<div style="padding: 30px 0px;">
		
	<div class="H5-gameListScreen">
		<ul class="H5-gameOpt clearfix"> 
			<!--<li style="margin-right: 15px;"><input  class="selectAll select-checks" name="check1" type="checkbox"></li>-->
			<!--<li>转换率<i class="iconfont icon-sort-double-down"></i></li>-->
			<li>
				<div class="shaixuan clearfix">
					<?php if($byname == 'a.adddate asc'){?>
						<a class="desc" href="<?php echo M_URL($this->AppName.'/Index','','',GP("byname-a.adddate desc")); ?>"><i class="ace-i"></i>购买时间</a>		
					<?php }else{ ?>
						<a class="desc" href="<?php echo M_URL($this->AppName.'/Index','','',GP("byname-a.adddate asc")); ?>"><i class="desc-i"></i>购买时间</a>
					<?php }?>
				</div> 
			</li>
			<li class="fr gameScreen"><i class="iconfont icon-filter-2" style="float: none;"></i>&nbsp;&nbsp;筛选

				<ul class="H5-gameScreen">
					<img src="//ks.kesion.com/Public/app/images/regup.png" alt="">
					<li>
						<span>订单状态：</span>
						<div>
							<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP("paystatus-3")); ?>" class="<?php if($paystatus==3){ echo 'active';}?>">不限</a>
							<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP("paystatus-1")); ?>" class="<?php if($paystatus ==1){ echo 'active';}?>">已购买</a>
							<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP("paystatus-2")); ?>" class="<?php if($paystatus ==2){ echo 'active';}?>">待付款</a>
						</div>
					</li>
					<li>
						<span>购买类型：</span>
						<div>
							<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP("type-6")); ?>" class="<?php if($stype ==6){ echo 'active';}?>">不限</a>
							<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP("type-1")); ?>" class="<?php if($stype ==1){ echo 'active';}?>">班级</a>
							<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP("type-2")); ?>" class="<?php if($stype ==2){ echo 'active';}?>">充值</a>
							<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP("type-3")); ?>" class="<?php if($stype ==3){ echo 'active';}?>">课程</a>

						</div>
					</li>
				</ul>

			</li>				
		</ul>	
	</div>

	<div class="H5-gameListConts school-online">
		<div class="Created-push" id="ksBoxContent" style="padding:15px;">
		<table class="ks-table" id="tables">
			<tr style="background: #EEEEEE;">
				<!--<th><input type="checkbox" class="select-checks" /></th>-->
				<th>网校ID</th>
				<th>订单号</th>
				<th>用户名</th>
				<th>订单原价</th>
				<th>支付金额</th>
				<th>服务费</th>
				<th>推广金</th>
				<th>实际到账</th>
				<th>状态</th>
				<th>订单类型</th>
				<th>支付方式</th>
				<th>下单日期</th> 
				<th>查看</th>
				<th>删除</th>
			</tr>
			<?php foreach($OrderAll as $k=>$v){ ?>		
			<tr <?php if($k%2==0){ echo 'class="gy"';} ?>>
				<!--<td><input type="checkbox" class="select-checks" /></td>-->
				<td><?php echo "<a href='".wx_Url($v['wxid'])."' target='_blank' title='查看店铺'>".$v['wxid']."</a>"; ?></td>
				<td><?php echo $v['ordersn']; ?></td>
				<td><?php echo User_GetUserName($v['userid']); ?></td>
                <td><?php echo $v['original_amount']; ?></td>
				<td><?php echo $v['price']; ?></td>
				<td>￥<?php echo Field($v['poundage']);?>元</td>
				<td>￥<?php echo Field($v['salesincome']);?>元</td>
				<td>￥<?php echo Field($v['actual_amount']);?>元</td>
				<td><?php 
                    if($v['paystatus']==0){
                        if ($v['status']==-1){
                            echo '<span style="color:#ccc" title="机构或学员已删除">回收站</span>'; 
                        }else{
                            echo '<span style="color:red;">未支付</span>';
                        } 
                    }
                    else{
                          echo '<span style="color:green;">已支付</span>';
                    } ?></td>
				<td>
					<?php 
						if($v['type']==0){echo '购买课程';
						}elseif($v['type']==1){ echo '购买班级';
						}elseif($v['type']==2){ echo '购买充值';
						}
					?>
				</td>
				<td><?php if ($v['ispaytoplat']==1){echo '微信直达机构';}else{if($v['paytype']==0){echo '线下支付';}elseif($v['paytype']==1){echo '支付宝';}elseif($v['paytype']==2){echo '微信';}} ?></td>
				<td><?php echo date('Y-m-d H:i:s',$v['adddate']); ?></td>
				<td><span onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','showdetail','',GP('orderid-'.$v['orderid'])) ?>','930px','450px',{title:'查看详情',type:'top'});
">查看详细信息</span></td>
                <td>
                    <?php if ($v['paystatus']==0){?>
                	<a class="deepBlue mr20" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','confirmdel',$v['orderid'],GP('')) ?>','300px','150px',{title:'确认删除',type:'top'})">删除</a>
                    <?php
                          }else{
                              echo ('---');
                          }?>
                </td>			
			</tr>	
			<?php } ?>
		</table>	
		<?php echo Noc($OrderAll); ?>
		</div>
		
	</div>
	
	
	<div>
		
		
		
	</div>
	</div>
	
</div>


<div class="footer-page h60">
    <div class="col-sm-7" style="padding-top: 16px;">
    	<!-- <div class="fr" style="    width: 418px;"> -->
						<form action="<?php echo  M_URL($this->AppName.'/Index','indexexcel','',GP('keyword-'.$keyword.',keytype-'.$keytype.',p-'.$page->now_page.',byname-'.$byname)); ?>" method="post">
							<label for="ratiotime" class="label-on" >
								<input type="radio" id="ratiotime" name="outtime" value="2" onclick="$('#timebox').hide()"/>本月</span>
							</label>
							<label for="ratiotime" class="label-on" >
								<input type="radio" id="ratiotime" name="outtime" value="3" onclick="$('#timebox').hide()"/>本年</label>
							<!--<label for="ratiotime" class="label-on">
								<input type="radio" id="ratiotime" name="anytime" value="6" />6个月前</label>
							<label for="ratiotime" class="label-on">
								<input type="radio" id="ratiotime" name="anytime" value="7" />一年前</label>-->
							<label for="ratiotime" class="label-on" >
								<input type="radio" id="ratiotime" name="outtime" value="4" onclick="$('#timebox').show()"/>自定义
								<div style="display: none;float: right;" id="timebox">
									<input id="start" type="text" value="" name="startime" required readonly class="w220 laydate-icon">
										-
									<input id="end" type="text" value=""name="endtime" required readonly class="w220 laydate-icon">
								</div>
								</label>
								<label for="ratiotime" class="label-on">
								<input type="submit" class="sc-button btn  btn-default" name="outexcel" value="导出Excel" /></label>
						</form>
						 <form action="<?php echo  M_URL($this->AppName.'/Index','indexexcel','',GP('keyword-'.$keyword.',keytype-'.$keytype.',p-'.$page->now_page.',byname-'.$byname)); ?>" method="post">
						<input type="hidden" name="outtime"  value="1"   />
						<input type="submit" id="ratiotime" class="sc-button btn  btn-default" name="" value="导出本页" /></label>
					</form>  
					<!-- </div> -->
     <!--<div class="checkbox fl checkbox-info" style="margin-top:20px;margin-right:10px">
            <input  class="selectAll select-checks" name="check1" type="checkbox">
            <label for="checkboxAll">全选 </label>
        </div>
     
        <button class="btn mt10 btn-default" type="submit" name="batch" value="4">锁定</button>
        <button class="btn mt10 btn-default" type="submit" name="batch" value="4">解锁</button>
        <button class="btn mt10 btn-default" type="submit" name="batch" value="4">通过</button>
        <button class="btn mt10 btn-default" type="submit" name="batch" value="4">待审核</button>-->


    </div>

    <div class="col-sm-5 " style="margin-top:7px">
    	<div class="page-box">
    		<?php echo $page->show(3); ?>
    	</div>
</body>
<script type="text/javascript" src="<?php echo UOOT;?>Public/common/js/layer/laydate.js"></script>
 <script>
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
	laydate(start);
	laydate(end);	
</script> 
</html>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>