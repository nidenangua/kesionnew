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
<link href="<?php echo UOOT;?>Public/admin/css/page.animate.css?<?php echoHash(); ?>" rel="stylesheet" />
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
        <h3 class="fl">&nbsp;&nbsp;拼团管理
        	  &nbsp;&nbsp;&nbsp;&nbsp;流动总金额：&nbsp;&nbsp;<font class="defColor" size="5px">￥<?php if($allmoney){ echo $allmoney;}else{echo 0;} ?></font>
        </h3>
        <div class="fr">
             <div class="fl ks-top-search">
			<!--搜索-->
			<form target="hidframe" class="fr">		
				<select class="inputText bRadius5 fl" id="keytype" style="width: 150px;">
				     <option value="1" <?php if($keytype==1){echo 'selected="selected"';} ?>>活动名称</option>
		  	    </select>
			   
			
				<input type="text" class="sc-text" name="searchText" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>">
           		<input type="button" class="sc-button fl" onclick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL('h5market/Index','collage'); ?>','<?php echo URL_MODEL;?>');" name="searchBtn" value="搜索">
			</form>
						
			<!--搜索-->
			</div> 
              
              
        </div>
    </div>
</div>


</div>
<form target="hidframe" id="SOIDJF"  action="<?php  echo M_URL($this->AppName.'/Index','bacthCollage','',GP('p-'.$page->now_page)); ?>" method="post">
<div id="ksBoxContent">
	<div style="padding: 40px 0px;">
		
	<div class="H5-gameListScreen">
        <ul class=" nav nav-tabs">
            <!-- <li><input class="selectAll select-checks" name="check1" type="checkbox"></li> -->
            <!--<li>转换率<i class="iconfont icon-sort-double-down"></i></li>-->
                <li class="fl hLh40 pl10 pr10 mr20 fsize18"><a href="<?php echo M_URL('h5market/Index','collage','',GP('status-3')); ?>" >全部</a></li>
                <li class="fl hLh40 pl10 pr10 mr20 fsize18"><a href="<?php echo M_URL('h5market/Index','collage','',GP('status-1')); ?>" >进行中</a></li>
                <li class="fl hLh40 pl10 pr10 mr20 fsize18"><a href="<?php echo M_URL('h5market/Index','collage','',GP('status-0')); ?>">未开启</a></li>           
                <li class="fl hLh40 pl10 pr10 mr20 fsize18"><a href="<?php echo M_URL('h5market/Index','collage','',GP('status-2')); ?>">已结束</a></li>        
                <li class="fl hLh40 pl10 pr10 mr20 fsize18 curr"><a href="<?php echo M_URL('h5market/Index','failurelist','',GP('status-2')); ?>">退款管理</a></li>    
        </ul>
		<!-- <ul class="H5-gameOpt clearfix">  -->
			<!--<li style="margin-right: 15px;"><input  class="selectAll select-checks" name="check1" type="checkbox"></li>-->
			<!--<li>转换率<i class="iconfont icon-sort-double-down"></i></li>-->
<!-- 			<li>
				<div class="shaixuan clearfix">
					
				</div> 
			</li>
			<li class="fr gameScreen"><i class="iconfont icon-filter-2" style="float: none;"></i>&nbsp;&nbsp;筛选

				<ul class="H5-gameScreen">
					<img src="//ks.kesion.com/Public/app/images/regup.png" alt="">
					<li>
						<span>结算状态：</span>
						<div>
							
							<a href="<?php echo M_URL('home/Paylog','index','',GP('status-1')); ?>" <?php if($status==1)echo "class='active'";?>>支出订单</a>
							<a href="<?php echo M_URL('home/Paylog','index','',GP('status-0')); ?>" <?php if($status==0)echo "class='active'";?>>充值订单</a>
						</div>
					</li>
				</ul>

			</li>				
		</ul> -->	
	</div>
	

	<div class="H5-gameListConts school-online">
		<div class="Created-push" id="ksBoxContent" style="padding:15px;">
		<table class="ks-table">
		<thead>
			<tr>
				<!--<th>选择</th>-->
				<th>网校ID</th>
				<th>开团人</th>
				<th>活动名称</th>
				<th>团长价格(元)</th>
                <th>团员价(元)</th>
                
                <th style="text-align:left">成团人数</th>
                <th>参团人数</th>
                <th>拼团活动时间</th>		
                <th>状态</th>		
                <th>操作</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($ary_link as $k => $v) { ?>
             <tr> 
             	<!--<td style="width: 30px;"><input type="checkbox" class="select-checks" name="check[]" value="<?php echo $v['id'];?>"></td>-->
                 <td><?php echo $v['wxid']; ?></td>
                 <td><?php echo $v['membername']; ?></td>
                 <td><?php echo $v['name']; ?></td>
                  <td><?php echo $v['setting']['leadmoney'] ?></td>
                <td> <?php echo $v['setting']['teammoney'] ?></td>
               
                <td> <?php echo $v['setting']['rewardpeple']; ?>人团</td>
                <td> <a href="javascript:addTypeChange('<?php echo M_URL('h5market/Index','checkcollage','',GP('groupid-'.$v['groupid'])); ?>','500px','400px',{title:'拼团情况'});"><?php echo $v['haveuser']; ?></a> </td>
                
                <td>
                    <p>起：<?php echo date('Y-m-d H:i:s',$v['collagetime']); ?></p>
                    <p>止：<?php echo date('Y-m-d H:i:s',$v['setting']['endtime']); ?></p>
                </td>
                <td>
                	<?php if($v['moneystatus']==1){echo '<span style="color:green">已退款</span>';}else{echo '<span style="color:red">等待退款</span>';}?>
                </td>
                <td>
                	<?php if($v['moneystatus']==0){?>
        		  <a onclick="addTypeChange('<?php echo M_URL('h5market/Index','confirmdel1','',GP('groupid-'.$v['groupid'])); ?>','300px','250px',{title:'确认打款',type:'top'})" title="确认打款" class="deepBlue mr20">退款</a>
        		  <?php }?>
        		</td>
               <!--  <td class="ks-head-el">
					<i onclick="choiceClick(this)" class="iconfont icon-more"></i>
					<div class="ks-head-content ks-head-content-pc w100">
						<ul class="opeart">
                           
							<?php if($v['isstar'] == 0){ ?>
								 <li> <a href="<?php echo M_URL('h5market/Index','addcollage',$v['id'],GP('appid-26,edit-1')); ?>">编辑</a> </li>
                				<li ><a onclick="satr(0,<?php echo $v['id']; ?>)">开启拼团</a> </li>
                			<?php }elseif($v['isstar'] == 1){ ?>
                				<li> <a href="<?php echo M_URL('h5market/Index','addcollage',$v['id'],GP('appid-26,edit-2')); ?>">详情</a> </li>
                				<li ><a onclick="satr(1,<?php echo $v['id']; ?>)">停止拼团</a> </li>
                			<?php } ?>
							                         										
						</ul>
					</div>
				</td> -->
            </tr>
            <?php } ?>
		</tbody>
	</table>	
		<?php echo NoC($ary_link);?> 

		</div>
	</div>
	<div>
	</div>
	</div>
	
</div>


<div class="footer-page " style="height:60px;">
    <div class="col-sm-4">
       <!--<div class="checkbox fl checkbox-info" style="margin-top:20px;margin-right:10px">
        <input id="checkboxAll" name="check1" type="checkbox" class="selectAll">
        <label for="checkboxAll">
            全选
        </label>
     </div>
    <button class="btn mt10 btn-default" type="submit" onclick="reg_submit(1)" value="1" name="batch">
        删除
    </button>-->
</div>
	<div class="col-sm-7 mt7"> <?php echo $page->show(3); ?></div>
</div>
</div>
</form>
 <script>
 	function reg_submit(type){
        $('#SOIDJF').submit();
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
	laydate(start);
	laydate(end);	
</script>  
</body>

</html>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>