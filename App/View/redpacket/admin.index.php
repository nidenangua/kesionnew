
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<link rel="shortcut icon" href="favicon.ico">
<link href="<?php echo UOOT;?>Public/admin/css/html5.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/common.css?<?php echo time();?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/news/newstyle.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<style type="text/css">
	.deepRed{ color: red; cursor:pointer; }
	.deepRed:hover{ color: red; cursor:pointer; }
	.ks-operaRight{position: absolute; right: 20px; top: 50px;}
	.ks-operaRight li { float: right; margin-left:0px; padding: 2px; }
	.H5-gameList>li {position: relative;}
	.ring{position: absolute;right: 20px;top: 15px;width:200px;height: 40px;text-align: right;line-height: 40px;}
	.H5-gameOpt>li { float: left; line-height: inherit; margin-right: 20px; font-size: 14px; }
	.shaixuan .asc-i { top: -2px;}
	.shaixuan .desc-i { top: 3px;}
	.defColor{color: #ec600e;}
    .gameScreen:hover ul{display: block;}
    .curr{
  border-image: none;
    border-style: solid;
    border-width: 1px;
    color: #555;
    cursor: default;
    border-top: 0;
    background-color: #fff!important;
}
.other a{
    padding: 10px;
    background: #e44d08;
    color: white!important;
    border-radius: 10px;
}
</style>
<body class="gray-bg">
<div class="wrapper" style="margin-top:35px">
<div class="row">
<div id="manage_top" class="menu_top_fixed  p15 height73" >
    <div class="ibox-title clearfix">
       <h3 class="fl ">&nbsp;&nbsp;<span class="mr20">课程红包管理</span>
          <!--   &nbsp;&nbsp;&nbsp;&nbsp;总人数&nbsp;&nbsp;<font class="defColor" size="5px"><?php echo $page->totalput; ?></font>
            &nbsp;&nbsp;&nbsp;&nbsp;本年新增&nbsp;&nbsp;<font class="defColor" size="4px"><?php echo $yearCout; ?></font>
            &nbsp;&nbsp;&nbsp;&nbsp;本月新增&nbsp;&nbsp;<font class="defColor" size="4px"><?php echo $mCout; ?></font>
            &nbsp;&nbsp;&nbsp;&nbsp;本周新增&nbsp;&nbsp;<font class="defColor" size="4px"><?php echo $weekCount; ?></font>
            &nbsp;&nbsp;&nbsp;&nbsp;今日新增&nbsp;&nbsp;<font class="defColor" size="4px"><?php echo $dayCout; ?></font> -->
        </h3>
        <div class="fr">
             <div class="fl ks-top-search">
			<!--搜索-->
			<select class="inputText bRadius5 fl" id="keytype" style="width: 150px;">
                <option value="1" <?php if($keytype==1){echo 'selected="selected"';} ?>>网校名称</option>
	  	    </select>
	
			<form target="hidframe" class="fr">
				<input type="text" class="sc-text" style="width: 200px;" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>">
            <input style="position: relative;" type="submit" class="sc-button" onclick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','index'); ?>','<?php echo URL_MODEL;?>')" name="searchBtn" value="搜索">
			</form>
						
			<!--搜索-->
			</div> 
              
              
        </div>
    </div>
</div>

<br />	
	
</div>

<div id="ksBoxContent">
	<div style="margin-top:10px;">	
	<div class="H5-gameListScreen" style="height: 45px;">
		<ul class=" nav nav-tabs">
			<!-- <li><input class="selectAll select-checks" name="check1" type="checkbox"></li> -->
			<!--<li>转换率<i class="iconfont icon-sort-double-down"></i></li>-->		
		</ul>	



</style>
 <form  id="myform" target="hidframe" action="<?php echo M_URL($this->AppName.'/Index','batchlist','',GP('')); ?>" method="post">	
	<div class="H5-gameListConts" style="background: #fff;padding: 13px;">
         <table width="100%" cellpadding="0" cellspacing="0" border="0"  class="ks-table">
                <thead>
                    <tr >
                        <th>选择</th>
                        <th>网校ID</th>
                        <th>网校名称</th>
                        <th >时间</th>
                        <th>优惠券种类</th>
                        <th>优惠券金额</th>
                        <th>对应类型</th>
                        <th>对应名称</th>
                        <th>使用条件</th>
                        <th>有效时间</th>
                        <th>发放方式</th>
                        <th>已领用数量</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach($values as $k=>$v){?>
                    <tr>
                        <td><input type="checkbox" class="select-checks " name="id[]" value="<?php echo $v['id']; ?>"></td>
                        <td><?php echo $v['wxid']?></td>
                        <td><?php echo $v['sitename']?></td>
                        <td><?php echo date('Y-m-d h:i:s',$v['addtime']); ?></td>   
                        <td><?php if($v['type'] == 0){ echo '网校通用优惠券';}else{ echo '指定课程优惠券';} ?></td>
                        <td>￥<?php echo $v['money'];?></td> 
                        <td><?php if($v['type']==0){ echo '无';}elseif($v['type']==1){ echo '点播';}elseif($v['type']==2){ echo '直播';}elseif($v['type']==3){ echo '音频';}elseif($v['type']==4){ echo '图文';}elseif($v['type']==5){ echo '互动';}elseif($v['type']==6){ echo '试卷';} ?></td> 
                        <td><?php echo $v['infotitle'];?></td> 
                        <td class=""><?php if($v['term']==0){ echo '无限制';}else{ echo '满'.$v['term'].'可以使用';} ?></td>    
                        <td><?php if($v['awarddate'] == 0){ echo '无限制';}else{ echo date('Y.m.d',$v['redemptionstarttime']).'-'.date('Y.m.d',$v['redemptionendtime']);} ?></td>  
                        <td><?php if($v['isuser'] == 1){ echo '用户领取';}else{echo '指定用户';} ?></td>
                        <td style="cursor:hand"><font style="color:#2a75ed" onclick="window.location.href='<?php echo  M_URL($this->AppName.'/Index','detailList',$v['id'],GP('appid-'.$this->appid,true)); ?>'"><?php echo $v['counts']; ?></font>/<?php echo $v['number']; ?></td>
                        <td>
                                            <?php if($v['isuse'] == 0){
                                                if($v['counts']>= $v['number']){
                                                    echo '<font style="color:#e5412c">已领完</font>';
                                                }else{
                                                    echo '<font style="color:#2a75ed">领取中</font>';
                                                }
                                            }elseif($v['isuse'] == 2){
                                                echo '<font style="">已过期</font>';
                                            }elseif($v['isuse'] == 1){
                                                echo '<font style="#e5412c">已领完</font>';
                                            }?>
                                        </td>
                        
                        <td>
                             <span onclick="Confirm('是否删除？该操作不可逆!','<?php echo M_URL($this->AppName.'/Index','delete',$v['id'],GP('p-'.$now_page)); ?>')"><i class="iconfont icon-lajitong"></i></span>
                        </td>    
                    </tr>
                    <?php } ?>
                </tbody>
        </table>
        <?php echo NoC($values);?>
		</div>
		<div style="height: 120px;"></div>
	<div>
	<div class="footer-page h60">
		<div class="col-sm-5">
			<div class="checkbox fl checkbox-info" style="margin-top:20px;margin-right:10px">
	            <input  class="selectAll select-checks" name="check1" type="checkbox" id="sAll">
                <label for="sAll">全选 </label>
	    </div><!-- 
	        <button class="btn mt10 btn-default" type="submit" name="batch" value="2">批量审核</button>
	        <button class="btn mt10 btn-default" type="submit" name="batch" value="3">取消审核</button> -->
	        <button class="btn mt10 btn-default" type="submit" name="batch" value="4">批量删除</button>
		</div>
	    <div class="col-sm-7" style="margin-top: 7px;">
			<?php echo $page->show(3); ?>
		</div>

    </div>
</form>
	</div>
	</div>

</div>
<script src="<?php echo UOOT;?>Public/common/js/nicescroll.js"></script>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script src="<?php echo UOOT;?>Public/common/js/backstage.js"></script>
<script type="text/javascript">
	$('.link-switch').each(function(){
        setLinkSwitch(this)
    })
</script>
</body>

</html>