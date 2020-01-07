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
<style type="text/css"> 
	.deepRed{ color: red; cursor:pointer; }
	.deepRed:hover{ color: red; cursor:pointer; }
	.ks-operaRight{position: absolute; right: 20px; top:40px;}
	.ks-operaRight li { float: right; margin-left:0px; padding: 2px; }
	.H5-gameList>li {position: relative;}
	.ring{position: absolute;right:30px;top:5px;width:200px;height: 40px;text-align: right;line-height: 40px;}
	.H5-gameOpt>li { float: left; line-height: inherit; margin-right: 20px; font-size: 14px; }
	.shaixuan .asc-i { top: 3px;}
	.shaixuan .desc-i { top: 3px;}
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
<div class="wrapper" style="margin-top:40px">
<div class="row">
<div id="manage_top" class="menu_top_fixed  p15 height73" >
    <div class="ibox-title">
        <h3 class="fl">&nbsp;&nbsp;独立域名管理&nbsp;&nbsp;&nbsp;&nbsp;
        	&nbsp;&nbsp;&nbsp;&nbsp;域名总数&nbsp;&nbsp;<font class="defColor" size="4px"><?php echo $totalnum; //echo $options['totalput']; ?></font>
        	&nbsp;&nbsp;&nbsp;&nbsp;本年新增&nbsp;&nbsp;<font class="defColor" size="4px"><?php echo $yearCout; ?></font>
        	&nbsp;&nbsp;&nbsp;&nbsp;本月新增&nbsp;&nbsp;<font class="defColor" size="4px"><?php echo $mCout; ?></font>
        	&nbsp;&nbsp;&nbsp;&nbsp;本周新增&nbsp;&nbsp;<font class="defColor" size="4px"><?php echo $weekCount; ?></font>
        	&nbsp;&nbsp;&nbsp;&nbsp;今日新增&nbsp;&nbsp;<font class="defColor" size="4px"><?php echo $dayCout; ?></font>
        </h3>
        	
        <div class="fr">
             <div class="fl ks-top-search">
			<!--搜索-->
			
			<select class="inputText bRadius5 fl" id="keytype" style="width: 150px;">
			     <option value="1" <?php if($keytype==1) echo "selected"; ?> >二级域名</option>
			     <option value="2" <?php if($keytype==2) echo "selected"; ?> >独立域名</option>
			     <option value="3" <?php if($keytype==3) echo "selected"; ?>>网校ID</option>
			     <option value="4" <?php if($keytype==4) echo "selected"; ?>>机构名称</option>
	  	    </select>
	
			<form target="hidframe" class="fr">
				<input type="text" class="sc-text" name="searchText" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>">
           <input type="button" class="sc-button" onclick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL('Domain','index'); ?>','<?php echo URL_MODEL;?>');" name="searchBtn" value="搜索">
			</form>
						
			<!--搜索-->
			</div> 
              
              
        </div>
    </div>
</div>


</div>

<div id="ksBoxContent">
	<form target="hidframe" id="myform" action="<?php echo M_URL('Domain','Dbatch','',GP('p-'.$page->now_page)) ?>" method="post">
	<div style="margin-top: 10px;"> 
	<div class="H5-gameListScreen" style="height: 45px;">
		<ul class=" nav nav-tabs">
	        <li class="fl hLh40 pl10 pr10 mr20 fsize18 <?php if($status==0) echo " curr" ;?>">
	        	<a href="<?php echo M_URL('Domain','index','',GP("status-0")); ?>">不限</a>
	        </li>
	        <li class="fl hLh40 pl10 pr10 mr20 fsize18 <?php if($status==1) echo " curr" ;?>">
	        	<a href="<?php echo M_URL('Domain','index','',GP("status-1")); ?>" >已审核(<?php echo($status1);?>)</a>
	        </li>
	        <li class="fl hLh40 pl10 pr10 mr20 fsize18 <?php if($status==3) echo " curr" ;?>">
	        	<a href="<?php echo M_URL('Domain','index','',GP("status-3")); ?>" >未审核(<?php echo($status0);?>)</a>
	        </li>
	        <li class="fl hLh40 pl10 pr10 mr20 fsize18 <?php if($status==2) echo " curr" ;?>">
	        	<a href="<?php echo M_URL('Domain','index','',GP("status-2")); ?>" >未通过(<?php echo($status2);?>)</a>
	        </li>
	    </ul>
		<ul class="H5-gameOpt clearfix fr" style="    position: absolute;right: 0px;top: 10px;">
			<!-- <li><input  class="selectAll select-checks" name="check1" type="checkbox"></li> -->
			<!--<li>转换率<i class="iconfont icon-sort-double-down"></i></li>-->
		<!-- 	<li>
				<div class="shaixuan clearfix">
					<?php if($byname == 'adddate asc'){?>
						<a class="desc" href="<?php echo M_URL('Domain','','',GP("byname-adddate desc")); ?>"><i class="desc-i"></i>申请时间</a>		
					<?php }else{ ?>
						<a class="desc" href="<?php echo M_URL('Domain','','',GP("byname-adddate asc")); ?>"><i class="asc-i"></i>申请时间</a>
					<?php }?>
				</div> 
			</li> -->				
		</ul>	
	</div>
	<div class="H5-gameListConts" style="background: #fff;padding: 15px">
		<table class="ks-table" >
            <thead >
                <tr>
                    <th style="width: 50px;">选择</th>
                    <th>机构ID</th>                           
                    <th>用户ID</th>                           
                    <th>所属机构</th>                           
                    <th style="text-align:left">二级域名</th>
                    <th style="text-align:left">独立域名</th>
                    <th class="shaixuan">
                    	<?php if($byname == 'adddate asc'){?>
						<a class="desc" href="<?php echo M_URL('Domain','','',GP("byname-adddate desc")); ?>" style="    float: none;"><i class="desc-i"></i>申请时间</a>		
					<?php }else{ ?>
						<a class="desc" href="<?php echo M_URL('Domain','','',GP("byname-adddate asc")); ?>" style="    float: none;"><i class="asc-i"></i>申请时间</a>
					<?php }?>
                    </th>
                    <th>状态</th>
                    <th>操作</th>
                </tr>
            </thead>

            <tbody>
			<?php foreach($values as $k=>$v){?>
			    <tr>
			    	<td><input  class="select-checks" name="check[]" value="<?php echo $v["id"];?>" type="checkbox"></td>
			    	<td><?php echo $v["wxid"];?></td>
			    	<td><?php echo $v["userid"];?></td>
			    	<td><?php echo $v["sitename"];?></td>
			    	<td style="text-align:left"><a href="http://<?php echo $v["domain"];?>" target="_blank"><?php echo $v["domain"];?></a></td>
			    	<td style="text-align:left"><a href="<?php echo "http://".$v["predomain"];?>" target="_blank"><?php echo $v["predomain"];?></a></td>
			    	<td><?php echo date('Y-m-d H:i:s',$v["adddate"]);?></td>
			    	<td>
                        <?php
                        switch($v["status"])
                        {
                            case 0:
                                echo "<span style='color:red'>待审</span>";
                                break;
                            case 1:
                                echo "<span style='color:green'>已通过</span>";
                                break;
                            case 2:
                                echo "<span style='color:#ccc'>未通过</span>";
                                break;
                        }
                        ?>
                        <!--
			    		<span class="link-switch<?php if($v["status"]==1){ echo ' open' ?><?php }  ?>" data-off="<?php echo M_URL('Domain','unaudited',$v['id'],GP('p-'.$page->now_page));?>" data-open="<?php echo M_URL('Domain','audited',$v['id'],GP('p-'.$page->now_page));?>"><i></i></span>
			    	    -->
                    </td>
			    	<td>
			    		<a onclick="addTypeChange('<?php echo M_URL('Domain','wxeditDomain',$v['id'],GP('p-'.$page->now_page.',urltype-2'));?>','550px','450px')">
									<i class="iconfont icon-bianji"></i>
									<p class="class-name">编辑</p>
						</a>
			    	</td>
			    </tr>
			<?php }?>
		</tbody>
	</table>
		<!-- </ul> -->
		<?php echo NoC($values);?>
		<br />	
		<br />	
		<br />	
		<br />	
		</div>
	<div>
	</div>
	</div>
	<br />	
	<br />	
	<br />	
	<br />	
</form>
</div>
<div class="footer-page h60">
    <div class="col-sm-5">
        <div class="checkbox fl checkbox-info" style="margin-top:20px;margin-right:10px">
            <input  class="selectAll select-checks" name="check1" type="checkbox" id="sAll">
			<label for="sAll">全选 </label>
        </div>
        <button class="btn mt10 btn-default" type="submit" name="batch" value="2">批量审核</button>
        <button class="btn mt10 btn-default" type="submit" name="batch" value="3">取消审核</button>
        <!--<button class="btn mt10 btn-default" type="submit" name="batch" value="1">批量删除</button>-->
    </div>
    <div class="col-sm-7 " style="margin-top:7px">
    	<?php echo $page->show(3); ?>
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

