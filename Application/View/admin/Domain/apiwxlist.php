<!doctype html>
<html>
<head>
<meta charset="utf-8">
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
<style> 
	.deepRed{ color: red; cursor:pointer; }
	.deepRed:hover{ color: red; cursor:pointer; }
	.ks-operaRight{position: absolute; right: 20px; top: 50px;}
	.ks-operaRight li { float: right; margin-left:0px; padding: 2px; }
	.H5-gameList>li {position: relative;}
	.ring{position: absolute;right: 20px;top: 15px;width:250px;height: 40px;text-align: right;line-height: 40px;}
	.H5-gameOpt>li { float: left; line-height: inherit; margin-right: 20px; font-size: 14px; }
	.shaixuan .asc-i { top: 3px;}
	.shaixuan .desc-i { top: 3px;}
	.ks-table tbody tr:nth-of-type(even) {
		background: #f8f8f8
	}
	@media  screen and (min-width:0px )and (max-width:1245px ) {
		.ks-operaRight{width:225px;}
		.likeCont{height:280px;}
		.this-top{margin-top: 40px;}
		.shaixuan a {font-size: 12px;margin-right: 5px;}
		.shaixuan .asc-i { top:0px!important;}
		.shaixuan .desc-i { top:0px!important;}
	}  
	.ks-head-el li{
		border-bottom: solid 1px #eceae6;
	}

</style> 
<body class="gray-bg"> 
<div class="wrapper" style="margin-top:35px">
<div class="row">
<div id="manage_top" class="menu_top_fixed  p15 height73" >
    <div class="ibox-title">
        <h3 class="fl">&nbsp;&nbsp;<span class="mr20">网校管理</span>
        	<a href="<?php echo M_URL('home/Domain','wxlist','',GP('')); ?>" class="mr20">注册网校</a>  
        	<a href="<?php echo M_URL('home/Domain','apilist','',GP(''));?>" class="mr20 act" style="color: blue;">Api网校</a>
        	&nbsp;&nbsp;&nbsp;&nbsp;网校个数&nbsp;&nbsp;<font class="defColor" size="5px"><?php echo $options['totalput']; ?></font>
        	<!-- &nbsp;&nbsp;&nbsp;&nbsp;教师个数&nbsp;&nbsp;<font class="defColor"  size="4px"><?php echo $teachers; ?></font> -->
        	&nbsp;&nbsp;&nbsp;&nbsp;本年新增&nbsp;&nbsp;<font class="defColor" size="4px"><?php echo $yearCout; ?></font>
        	&nbsp;&nbsp;&nbsp;&nbsp;本月新增&nbsp;&nbsp;<font class="defColor" size="4px"><?php echo $mCout; ?></font>
        	&nbsp;&nbsp;&nbsp;&nbsp;本周新增&nbsp;&nbsp;<font class="defColor" size="4px"><?php echo $weekCount; ?></font>
        	&nbsp;&nbsp;&nbsp;&nbsp;今日新增&nbsp;&nbsp;<font class="defColor" size="4px"><?php echo $dayCout; ?></font>
        </h3>
        <div class="fr">
            <div class="fl ks-top-search">
			<select class="inputText bRadius5 fl" id="keytype" style="width: 150px;">
			     <option value="1" <?php if($keytype==1) echo "selected"; ?>>网校名称</option>
			     <option value="2" <?php if($keytype==2) echo "selected"; ?>>用户名</option>
	  	    </select>
			<form target="hidframe" class="fr">
				<input type="text" style="width:150px" class="sc-text" name="searchText" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>">
            <input type="button" class="sc-button" onclick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL('Domain','apilist'); ?>','<?php echo URL_MODEL;?>');" name="searchBtn" value="搜索">
			</form>
			<!--搜索-->
			</div> 
        </div>
    </div>
</div>
</div>
<div id="ksBoxContent">
	<div style="padding: 35px 0px;">
		
	<div class="H5-gameListScreen">
		<ul class="H5-gameOpt clearfix" style="min-height: 35px;"> 
			<li></li>
			<!--<li>转换率<i class="iconfont icon-sort-double-down"></i></li>-->			
		</ul>	
	</div>
	<div class="H5-gameListConts" style="background: #fff;padding: 13px;">
		<form target="hidframe" id="myform" method="post" target="hidframe"  action="<?php echo M_URL('home/Domain','bacthAllow','',GP('p-'.$page->now_page)) ?>" class="form-horizontal" enctype="multipart/form-data">
              <table class="ks-table" style="background: #fff;">
                    <thead style="background: #cccccc9c;">
                        <tr>
                            <th>选择</th>
                            <th>机构ID</th>                           
                            <th>机构LOGO</th>                           
                            <th style="text-align:left">机构名称</th>
                            <th>用户名称</th>
                            <th style="text-align: left;">域名</th>
                            <th>套餐类型</th>
                            <th>登录次数</th>
                            <th>学员数量</th>
                            <th>注册时间</th>
                            <th>到期时间</th>
                            <th>是否允许调用接口</th>
                            <th>缴费方式</th>
                            <th>操作</th>
                        </tr>
                    </thead>

                    <tbody>
                    	<?php foreach($values as $k =>$v){ ?>
                    	<tr>
                    		<td><input type="checkbox" class="select-checks" value="<?php echo $v['userid'];?>" name='check[]'/></td>
                    		<td><?php echo $v['wxid']; ?></td>
                    		<td><img style="display: inline-block;overflow: hidden;cursor: pointer;width: 79px;max-height: 63px;"  src="<?php if(strstr(Img($v['logo']),'{img:')==false){echo Img($v['logo']);}else{echo '/Public/admin/images/login/logo.png';} ?>">
                    		</td>
                    		<td style="text-align: left;"><?php echo $v['sitename'] ?></td>
                    		<td><?php echo $v['username']; ?></td>
                    		<td style="text-align: left;"><?php if (isset($v['domain'])) { echo $v['domain']; }?>  <a onclick="addTypeChange('<?php echo M_URL('home/Domain','wxeditDomain',isset($v['id'])?$v['id']:'0',GP(''));?>','600px','300px',{title:'域名修改',type:'top'});"><i class="iconfont icon-bianji1 deepBlue" style="color: #0a9cf1;"></i></a></td>
                    		<td><?php if(!empty($this->cache->GetA('commonpackageversion','versionename',$v['package'],'versionname'))){echo $this->cache->GetA('commonpackageversion','versionename',$v['package'],'versionname');}else{echo "暂无";};?></td>
                    		<td><?php echo $v['logintimes'];?></td>
                    		<td><?php echo $v['sum'];?></td>
                    		<td><?php echo date('Y-m-d H:i:s',$v['regdate']);?></td>
                    		<td><?php echo date('Y-m-d',$v['packendtime']);?></td>
                    		
                    		<td>
                    			<span class="link-switch<?php if($v['isallow'] ==1){ echo ' open'; } ?>" data-off="<?php echo M_URL('home/Domain','changeAllow',$v['userid'],GP('')); ?>" data-open="<?php echo M_URL('home/Domain','changeAllow',$v['userid'],GP('')); ?>"><i></i></span>
                    		</td>
                    		<td>
                    			<?php if($v["istry"]==0){ ?>
                                        <span class="grayLing"></span><a class="deepBlue ok-icon ok-pe1 " href="<?php echo M_URL('home/Domain','tryunaudited',$v['wxid'],GP('p-'.$page->now_page));?>" title="免费试用"></a>
                                        <?php }else{ ?>
                                        <span class="grayLing"></span><a class="deepBlue ok-icon ok-pe2" href="<?php echo M_URL('home/Domain','tryaudited',$v['wxid'],GP('p-'.$page->now_page));?>" title="正常缴费"></a>
                                        <?php } ?>
                    		</td>
                    		<td class="ks-head-el">
                    			<i onclick="choiceClick(this)" class="iconfont icon-more"></i>
								<div class="ks-head-content ks-head-content-pc" style="width: 113px!important;">
									<ul class="opeart">
											<li><a href="https://<?php echo $v['domain']; ?>" target="_blank" >预览网校</a></li>
											<li ><a href="<?php echo M_URL('home/Users','dorealwx',$v['wxid'],GP(''));?>">认证材料</a></li>
											<li ><a href="<?php echo M_URL('home/Domain','wxmsg',$v['wxid'],GP('p-'.$page->now_page));?>">机构信息</a></li>
											<li ><a href="<?php echo M_URL('home/Domain','wxpersonal',$v['userid'],GP('usertype-2,urltype-1'));?>">负责人资料</a></li>
											<li style="border: none;"><a  onclick="Confirm('是否删除此应用','<?php echo M_URL('home/Users','deleteUserswx',$v['userid'],GP('wxid-'.$v['wxid']));?>');" >删除</a></li>
											<li style="border: none;"><a onclick="addTypeChange('<?php echo M_URL('home/Domain','showMore',isset($v['id'])?$v['id']:'0',GP('')) ?>','930px','450px',{title:'查看更多',type:'top'});" >查看更多</a></li>
									</ul>
								</div>
                    		</td>
                    	</tr>
                    <?php }?>
                    </tbody>
                </table>
		<?php echo NoC($values);?>
		</div>
	<div>
	</div>
	</div>
	<br />	
	<br />	
	<br />	
	<br />	
</div>
<div class="footer-page h60">
    <div class="col-sm-5">
     <div class="checkbox fl checkbox-info" style="margin-top:20px;margin-right:10px">
     		<input  class="selectAll select-checks" name="check1" type="checkbox" id="sAll">
            <label for="sAll">全选 </label>
        </div>
        <button class="btn mt10 btn-default" onClick="do_reg();" name="batch" value="2">批量审核</button>
        <button class="btn mt10 btn-default" onClick="do_reg();" name="batch" value="3">取消审核</button>
        <!-- <button class="btn mt10 btn-default" onClick="do_reg();" name="batch" value="1">批量删除</button> -->
    </div>
    <div class="col-sm-7 " style="margin-top:7px"><?php echo $page->show(3); ?></div>
</body>
</form>
</html>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script src="<?php echo UOOT;?>Public/common/js/backstage.js"></script>
<script>
	$('.link-switch').each(function(){
        setLinkSwitch(this)
    })
    function do_reg(){
	   $("#myform").submit();	
    }
  	function float2(e){
   	 	$(e).each(function(){
     		var see = $(this).html()*1
	   	 	if(see>1000){
	    		see=see/10000;
	    		if(see>1000){
	    			see=see/10000;
	    			see=Math.floor(see * 100) / 100;
	    			see = see+"亿"
	    		}else{
	    			see=Math.floor(see * 100) / 100;
	    			see = see+"万"
	    		}
	    	}
	    	$(this).html(see);
     	})
   };float2(".see1");float2(".see2");


  

</script>