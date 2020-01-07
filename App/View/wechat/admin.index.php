
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
       <h3 class="fl ">&nbsp;&nbsp;<span class="mr20">公众号管理</span>
        	
        	&nbsp;&nbsp;&nbsp;&nbsp;总数&nbsp;&nbsp;<font class="defColor" size="5px"><?php echo $page->totalput; ?></font>
        	&nbsp;&nbsp;&nbsp;&nbsp;已认证&nbsp;&nbsp;<font class="defColor" size="4px"><?php echo $yearCout; ?></font>
        	&nbsp;&nbsp;&nbsp;&nbsp;未认证&nbsp;&nbsp;<font class="defColor" size="4px"><?php echo $mCout; ?></font>
        </h3>
        <div class="fr">
             <div class="fl ks-top-search">
			<!--搜索-->
			<select class="inputText bRadius5 fl" id="keytype" style="width: 150px;">
			    <option value="1" <?php if($keytype==1){echo 'selected="selected"';} ?>>名称</option>
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
                <li class="fl hLh40 pl10 pr10 mr20 fsize18 <?php if($status==3) echo " curr" ;?>"><a href="<?php echo M_URL($this->AppName.'/Index','index','',GP('status-3')); ?>" >全部</a></li>
                <li class="fl hLh40 pl10 pr10 mr20 fsize18 <?php if($status==1) echo " curr" ;?>"><a href="<?php echo M_URL($this->AppName.'/Index','index','',GP('status-1')); ?>" >已认证</a></li>
                <li class="fl hLh40 pl10 pr10 mr20 fsize18 <?php if($status==2) echo " curr" ;?>"><a href="<?php echo M_URL($this->AppName.'/Index','index','',GP('status-0')); ?>">未认证</a></li>			
		</ul>	



</style>
 <form  id="myform" target="hidframe" action="<?php echo M_URL($this->AppName.'/Index','batch','',GP('')); ?>" method="post">	
	<div class="H5-gameListConts" style="background: #fff;padding: 13px;">
         <table class="ks-table" style="background: #fff;">
                    <thead style="background: #cccccc9c;">
                        <tr>
                            <th>选择</th>
                            <th >网校ID</th>                           
                            <th >网校名称</th>                           
                            <th >名称</th> 
                            <th>认证方式</th>                          
                            <th >状态</th>                            
                            <th >公众号类型</th>                           
                            <th >公众号用户</th>
                            <th>体验二维码</th>
                            <!-- <th>安全域名</th> -->
                            <!-- <th>删除</th> -->
                            <th>操作</th>
                        </tr>
                    </thead>

                    <tbody>
                    	<?php foreach($values as $k=>$v){ ?>
                    	<tr>
                    		<td><input type="checkbox" class="select-checks " name="id[]" value="<?php echo $v['id']; ?>"></td>
                            <td><?php echo $v['wxid']; ?></td>
                            <td><?php echo $v['sitename']; ?></td>
                    		<td><?php echo $v['weixinname']; ?></td>
                            <td><?php if($v['verify_type_info']==0){echo "微信";}elseif($v['verify_type_info']==1){echo "新浪微博";}elseif($v['verify_type_info']==2){echo "腾讯微博";}elseif($v['verify_type_info']==3){echo "资质认证通过，未通过名称认证";}elseif($v['verify_type_info']==4){echo "资质认证、新浪微博认证通过、未通过名称认证";}elseif($v['verify_type_info']==5){echo "资质认证、腾讯微博认证通过、未通过名称认证";}else{echo '未认证';}?></td>
                    		<td><?php if($v['weixinstatus']==0){echo '未认证';}else{echo '已认证';} ?></td>
                    		<td><?php if($v['weixintype']==0){echo '订阅号';}elseif($v['weixintype']==1){echo '旧账号升级';}else{echo '服务号';} ?></td>
                    		<td style="color: blue;"><?php if(!empty($v['countuser'])){
                    			echo Field($v['countuser']);
                    		}else{echo '暂无';} ?></td>
                    		<td><img style="    width: 100px;" src="<?php echo Field($v['qrcode_url']); ?>"></td>
                    		<!-- <td><?php if(!empty($v['network']['WsRequestDomain'])&&!empty($v['network'])){echo Field($v['network']['WsRequestDomain'][0]);}else{echo '暂无';}  ?></td> -->
                    		
                    		<!-- <td>
                    		  <span onclick="Confirm('是否删除？该操作不可逆!','<?php echo M_URL($this->AppName.'/Index','delete',$v['userid'],GP('')); ?>')"><i class="iconfont icon-lajitong"></i></span>
                    		</td> -->
                    		<td>
                    			<a href="<?php echo M_URL($this->AppName.'/Index','userlist',$v['wxid'],GP('appid-'.$this->appid,true))?>">查看</a>
                    		</td>
                    	</tr>
                    
                <?php }?>
                </tbody>
                </table>
		<?php echo Noc($values); ?>
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