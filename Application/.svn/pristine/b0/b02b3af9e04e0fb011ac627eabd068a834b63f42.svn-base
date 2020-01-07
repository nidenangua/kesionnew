
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<link rel="shortcut icon" href="favicon.ico">
<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/html5.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/page.animate.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
<link href="<?php echo UOOT;?>Public/app/css/laydate.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo UOOT;?>Public/common/js/layer/laydate.js"></script>
</head>
<style type="text/css">
	.gy{background: #F8F8F8;}
	#timebox input{width: 200px;}
	.labs label{margin-top: 10px;}
    .curr{
      border-image: none;
        border-style: solid;
        border-width: 1px;
        color: #555;
        cursor: default;
        border-top: 0;
        background-color: #fff!important;
    }
</style>
<body class="gray-bg">
<div class="wrapper" style="margin-top:35px">

<div class="row">
<div id="manage_top" class="menu_top_fixed  p15 height73" >
    <div class="ibox-title">
        <h3 class="fl">&nbsp;&nbsp;直播币流水
        	<a href="<?php echo M_URL('Paylog','livecurrency'); ?>" class="mr20 act" >购买记录</a> 
		    <a href="<?php echo M_URL('Paylog','livepay'); ?>" class="mr20">消费记录</a>  
			&nbsp;&nbsp;&nbsp;&nbsp;赠送&nbsp;&nbsp;<font class="defColor" size="4px">￥<?php if($songmoney){echo $songmoney;}else{echo 0;} ?></font>
			&nbsp;&nbsp;&nbsp;&nbsp;总发币&nbsp;&nbsp;<font class="defColor" size="4px">￥<?php if($allmoney){echo $allmoney;}else{echo 0;} ?></font>
            &nbsp;&nbsp;&nbsp;&nbsp;待充币&nbsp;&nbsp;<font class="defColor" size="4px">￥<?php if($outmoney){echo $outmoney;}else{echo 0;} ?></font>
			&nbsp;&nbsp;&nbsp;&nbsp;线上实充&nbsp;&nbsp;<font class="defColor" size="4px">￥<?php if($success){echo $success;}else{echo 0;} ?></font>
        </h3>
        <div class="fr">
             <div class="fl ks-top-search">
			<!--搜索-->
			<form target="hidframe" class="fr">		
				<select class="inputText bRadius5 fl" id="keytype" style="width: 150px;">
                     <option value="1" <?php if($keytype==1){echo 'selected="selected"';} ?>>订单号</option>
                     <option value="2" <?php if($keytype==2){echo 'selected="selected"';} ?>>网校ID</option>
				     <option value="3" <?php if($keytype==3){echo 'selected="selected"';} ?>>网校名称</option>
		  	    </select>
			   
			
				<input type="text" class="sc-text" name="searchText" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>">
           		<input type="button" class="sc-button fl" onclick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL('Paylog','livecurrency'); ?>','<?php echo URL_MODEL;?>');" name="searchBtn" value="搜索">
			</form>
						
			<!--搜索-->
			</div> 
              
              
        </div>
    </div>
</div>


</div>

<div id="ksBoxContent">
	<div style="padding: 40px 0px;">
		
	<div class="H5-gameListScreen">
        <ul class=" nav nav-tabs">
                <li class="fl hLh40 pl10 pr10 mr20 fsize18 <?php if($status==3) echo " curr" ;?>"><a href="<?php echo M_URL('home/Paylog','livecurrency','',GP('status-3')); ?>" >全部</a></li>
                <li class="fl hLh40 pl10 pr10 mr20 fsize18 <?php if($status==1) echo " curr" ;?>"><a href="<?php echo M_URL('home/Paylog','livecurrency','',GP('status-1')); ?>" >实充</a></li>
                <li class="fl hLh40 pl10 pr10 mr20 fsize18 <?php if($status==0) echo " curr" ;?>"><a href="<?php echo M_URL('home/Paylog','livecurrency','',GP('status-0')); ?>">赠送</a></li>           
        </ul>
	</div>
	

	<div class="H5-gameListConts school-online">
		<div class="Created-push" id="ksBoxContent" style="padding:15px;">
		<table class="ks-table" id="tables">
			<tr style="background: #EEEEEE;">
                <th>网校ID</th>
				<th>网校名称</th>
				<th>订单号</th> 
				<th class="shaixuan">
                   <?php if($byname == 'a.adddate asc'){?>
                        <a class="desc" href="<?php echo M_URL('home/Paylog','livecurrency','',GP("byname-a.adddate desc")); ?>" style="float: none;"><i class="desc-i" style="top: -1px;"></i>消费时间</a>     
                    <?php }else{ ?>
                        <a class="desc" href="<?php echo M_URL('home/Paylog','livecurrency','',GP("byname-a.adddate asc")); ?>" style="float: none;"><i class="asc-i" style="top: -1px;"></i>消费时间</a>
                    <?php }?>            
                </th>
				<th>IP</th>
				<th>数量</th>
				<th>支付状态</th>
				<th>支付方式</th>
				<th>单价</th>
				<th>实际支付(元)</th>
				<th>备注</th>
			</tr>
			<?php foreach($pagelogs as $k=>$v){ ?>
            <tr>
                <td><?php echo $v['wxid']; ?></td>
                <td><?php echo $v['sitename']; ?></td>
				<td><?php echo $v['ordersn'];  ?></td>
                <td><?php echo KS_DATE($v['adddate']); ?></td>
                <td><?php echo $v['userip']; ?></td>
                <td>
   					<?php 
   						switch($v['appid']){case 1:echo ($v['numb']*1000).'条';break;
   							case 2:echo ($v['numb']*1000).'封';break;
   							case 3:echo floor($v['numb']).'G';break;
   							case 4:echo floor($v['numb']).'G';break;
   							case 6:echo floor($v['numb']).'人';break;
   							case 5:echo floor($v['numb']).'个';break;
   					}?>
   				</td>
                <td style="color: <?php if($v['paystatus']==0){echo 'red';}else{echo 'green';}; ?>"><?php if($v['paystatus']==0){echo '未充值';}else{echo '已充值';}; ?></td>
				<td><?php if($v['paytype']==0){echo '后台充值';}elseif($v['paytype']==1){echo '支付宝支付';}elseif($v['paytype']==2){echo '微信支付';}?></td>
                <td>
   				<?php switch($v['appid']){case 1:echo $v['market_price'].'/千条';break;
						case 2:echo $v['market_price'].'/千封';break;
						case 3:echo  $v['market_price'].'/G/天'; break;
						case 4:echo $v['market_price'].'/G';break;
						case 6:echo $v['market_price'].'/人/月';break;
						case 5:echo $v['market_price'].'个/元';break;
				}?>
   				</td>	
                <td class="c-Orange"><?php if($v['price']==0){echo '赠送';}else{echo $v['price'].'元';} ?></td>
                <td><?php echo $v['appname']; ?></td>
            </tr>
            <?php } ?>
		</table>	
		<?php echo NoC($pagelogs);?> 

		</div>
	</div>
	<div>
	</div>
	</div>
	
</div>


<div class="footer-page " style="height:60px;">
    <div class="col-sm-5 mt7 labs">
     <form action="<?php echo  M_URL('home/Paylog','livecurrencyExcel','',GP('')); ?>" method="post">
		<input type="submit" class="sc-button btn  btn-default fl mt7" style="margin-right:10px;margin-top: 7px;" name="outexcel" value="导出Excel" />
		<label>
			<input type="radio" id="ratiotime" name="outtime" value="1" onclick="$('#timebox').hide()"/>本页</span>
		</label>
		<label>
			<input type="radio" id="ratiotime" name="outtime" value="2" onclick="$('#timebox').hide()"/>本月</span>
		</label>
		<label>
			<input type="radio" id="ratiotime" name="outtime" value="3" onclick="$('#timebox').hide()"/>本年</label>
		<label>
			<input type="radio" id="ratiotime" name="outtime" value="4" onclick="$('#timebox').show()"/>自定义
		</label>
		<span style="display: none;" id="timebox">
			<input id="start" type="text" value="" name="startime" required readonly class="laydate-icon">
				-
			<input id="end" type="text" value=""name="endtime" required readonly class="laydate-icon">
		</span> 
 
	</form>
    </div>
	<div class="col-sm-7 mt7"> <?php echo $page->show(3); ?></div>
</div>
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
</body>

</html>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>


