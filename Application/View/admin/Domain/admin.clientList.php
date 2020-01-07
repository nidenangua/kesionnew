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
<link href="<?php echo UOOT;?>Public/app/css/laydate.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo UOOT;?>Public/common/js/layer/laydate.js"></script>

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
	.labes label { margin-top:12px}
	.laydate-icon {
		width: 170px;
		margin-top: 15px;
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
   /*弹窗*/
    #choiceWindow {
        display:none;
        position:absolute;
        top:25%;
        left:25%;
        width:30%;
        height:30%;
        padding:20px;
        border:3px solid #ccc;
        background-color:white;
        z-index:2;
        overflow:auto;
    }
    #backGround {
        display:none;
        position:absolute;
        top:0%;
        left:0%;
        width:100%;
        height:1100px;
        background-color:black;
        z-index:1;
        -moz-opacity:0.8;
        opacity:.80;
        filter:alpha(opacity=88);
    }
    #x:hover {
        cursor:pointer;
        color:rgb(55,198,192);
    }
    #choiceWindow1 {
        display:none;
        position:absolute;
        top:25%;
        left:25%;
        width:30%;
        height:30%;
        padding:20px;
        border:3px solid #ccc;
        background-color:white;
        z-index:2;
        overflow:auto;
    }
    #backGround1 {
        display:none;
        position:absolute;
        top:0%;
        left:0%;
        width:100%;
        height:1100px;
        background-color:black;
        z-index:1;
        -moz-opacity:0.8;
        opacity:.80;
        filter:alpha(opacity=88);
    }
    #x1:hover {
        cursor:pointer;
        color:rgb(55,198,192);
    }
</style>
<body class="gray-bg"> 
<div class="wrapper" style="margin-top:35px">
<div class="row">

</div>
<div id="ksBoxContent">

    <div class="fl" style="padding: 35px 0px;">
            <div class="fl ks-top-search">
           	<form class="fr" action="<?php echo M_URL('Domain','clientList'); ?>" method="post">
                <select class="inputText bRadius5 fl" id="keytype" name="keytype" style="width: 150px;">
			     <option value="1" <?php if($keytype==1) echo "selected"; ?>>网校名称</option>
			     <option value="3" <?php if($keytype==3) echo "selected"; ?>>用户名</option>
	  	        </select>
                <select class="inputText bRadius5 fl" name="customerstatus" style="width: 150px;">
                    <option value="0" <?php if($keytype==1) echo "selected"; ?>>选择跟进状态</option>
                    <?php foreach ($this->customerstatus as $k=>$v) {?>
                    <option value="<?php echo $k;?>" <?php if($customerstatus==$k) echo "selected"; ?>><?php echo $v;?></option>
                    <?php }?>
                </select>
				<input type="text" style="width:150px" class="sc-text" name="keyword" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>">
               <label>
				<input type="radio" id="ratiotime" name="outtime" value="0" onclick="$('#timebox').hide()"<?php if ($outtime==0) echo "checked"; ?>/>时间不限
                   </label>
                <label>
                    <label>
                        <input type="radio" id="ratiotime" name="outtime" value="2" onclick="$('#timebox').hide()"<?php if ($outtime==2) echo "checked"; ?>/>今日跟进
                    </label>
                    <label>
                        <input type="radio" id="ratiotime" name="outtime" value="3" onclick="$('#timebox').hide()"<?php if ($outtime==3) echo "checked"; ?>/>待跟进
                    </label>
			    <label>
				    <input type="radio" id="ratiotime" name="outtime" value="4" onclick="$('#timebox').show()"<?php if ($outtime==4) echo "checked"; ?>/>上次跟进时间
			    </label>
                    <label>
                        <input type="radio" id="ratiotime" name="outtime" value="5" onclick="$('#timebox').show()"<?php if ($outtime==5) echo "checked"; ?>/>下次跟进时间
                    </label>
		    <span style="display: <?php echo $startime||$endtime?'inline':'none';?>;" id="timebox">
			    <input id="start" type="text" value="<?php echo $star?$star:''; ?>" name="startime" required readonly class="laydate-icon">
				    -
			    <input id="end" type="text" value="<?php echo $end?$end:''; ?>" name="endtime" required readonly class="laydate-icon">
		    </span>
                <input type="hidden" name="excel" id="excel" value="0" />
                <input type="submit" value="搜索" class="sc-button" onclick="$('#excel').val(0);"/>
<!--                <input type="submit" value="导出excel" class="sc-button" onclick="$('#excel').val(1);" />-->
               <!--<input type="button" class="sc-button" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL('Domain','wxlist'); ?>','<?php echo URL_MODEL;?>');" name="searchBtn" value="搜索">-->
			</form>

				<!--搜索-->
			</div>
		<a class="sc-button btn  btn-default fl mt7" onClick="addTypeChange('<?php echo M_URL('Domain','Client','',GP('p-'.$now_page)) ?>','530px','300px',{title:'添加客户',type:'top'});" >添加客户</a>

	</div>
	<div style="clear:both">
        <div class="H5-gameListScreen">
            <ul class="H5-gameOpt clearfix" style="min-height: 35px;">
                <li></li>
                <!--<li>转换率<i class="iconfont icon-sort-double-down"></i></li>-->
                <li>
                    <div class="shaixuan clearfix" >
                        <!-- <input  class="selectAll select-checks fl" name="check1" type="checkbox"> -->
                  
                        <?php if($logintimes == 2){?>
                            <a class="desc" href="?logintimes-1"><i class="desc-i"></i>登陆次数</a>
                        <?php }else{ ?>
                            <a class="desc" href="?logintimes-2"><i class="asc-i"></i>登陆次数</a>
                        <?php }?>
                        <?php if($lastlogintime == 2){?>
                            <a class="desc" href="?lastlogintime-1"><i class="desc-i"></i>最后登陆</a>
                        <?php }else{ ?>
                            <a class="desc" href="?lastlogintime-2"><i class="asc-i"></i>最后登陆</a>
                        <?php }?>
                        <?php if($adddate == 2){?>
                            <a class="desc" href="?adddate-1"><i class="desc-i"></i>到期时间</a>
                        <?php }else{ ?>
                            <a class="desc" href="?adddate-2"><i class="asc-i"></i>到期时间</a>
                        <?php }?>
                        <?php if($sms == 2){?>
                            <a class="desc" href="?sms-1"><i class="desc-i"></i>短信数量</a>
                        <?php }else{ ?>
                            <a class="desc" href="?sms-2"><i class="asc-i"></i>短信数量</a>
                        <?php }?>
                        <?php if($sumsmsnum == 2){?>
                            <a class="desc" href="<?php echo M_URL('Domain','clientList','',GP("sumsmsnum-1")); ?>"><i class="desc-i"></i>短信总数量</a>
                        <?php }else{ ?>
                            <a class="desc" href="<?php echo M_URL('Domain','clientList','',GP("sumsmsnum-2")); ?>"><i class="asc-i"></i>短信总数量</a>
                        <?php }?>
                        <?php if($mail == 2){?>
                            <a class="desc" href="<?php echo M_URL('Domain','clientList','',GP("mail-1")); ?>"><i class="desc-i"></i>邮件数量</a>
                        <?php }else{ ?>
                            <a class="desc" href="<?php echo M_URL('Domain','clientList','',GP("mail-2")); ?>"><i class="asc-i"></i>邮件数量</a>
                        <?php }?>
                        <?php if($sumemailnum == 2){?>
                            <a class="desc" href="<?php echo M_URL('Domain','clientList','',GP("sumemailnum-1")); ?>"><i class="desc-i"></i>邮件总数量</a>
                        <?php }else{ ?>
                            <a class="desc" href="<?php echo M_URL('Domain','clientList','',GP("sumemailnum-2")); ?>"><i class="asc-i"></i>邮件总数量</a>
                        <?php }?>
                        <?php if($vodmoney == 2){?>
                            <a class="desc" href="<?php echo M_URL('Domain','clientList','',GP("vodmoney-1")); ?>"><i class="desc-i"></i>点播流量</a>
                        <?php }else{ ?>
                            <a class="desc" href="<?php echo M_URL('Domain','clientList','',GP("vodmoney-2")); ?>"><i class="asc-i"></i>点播流量</a>
                        <?php }?>
                        <?php if($sumvodmoney == 2){?>
                            <a class="desc" href="<?php echo M_URL('Domain','clientList','',GP("sumvodmoney-1")); ?>"><i class="desc-i"></i>点播总流量</a>
                        <?php }else{ ?>
                            <a class="desc" href="<?php echo M_URL('Domain','clientList','',GP("sumvodmoney-2")); ?>"><i class="asc-i"></i>点播总流量</a>
                        <?php }?>
                        <?php if($vodspace == 2){?>
                            <a class="desc" href="<?php echo M_URL('Domain','clientList','',GP("vodspace-1")); ?>"><i class="desc-i"></i>空间容量</a>
                        <?php }else{ ?>
                            <a class="desc" href="<?php echo M_URL('Domain','clientList','',GP("vodspace-2")); ?>"><i class="asc-i"></i>空间容量</a>
                        <?php }?>
                        <?php if($sumvodspace == 2){?>
                            <a class="desc" href="<?php echo M_URL('Domain','clientList','',GP("sumvodspace-1")); ?>"><i class="desc-i"></i>空间总容量</a>
                        <?php }else{ ?>
                            <a class="desc" href="<?php echo M_URL('Domain','clientList','',GP("sumvodspace-2")); ?>"><i class="asc-i"></i>空间总容量</a>
                        <?php }?>
                        <?php if($livemoney == 2){?>
                            <a class="desc" href="<?php echo M_URL('Domain','clientList','',GP("livemoney-1")); ?>"><i class="desc-i"></i>直播连麦币</a>
                        <?php }else{ ?>
                            <a class="desc" href="<?php echo M_URL('Domain','clientList','',GP("livemoney-2")); ?>"><i class="asc-i"></i>直播连麦币</a>
                        <?php }?>
                        <?php if($sumlivemoney == 2){?>
                            <a class="desc" href="<?php echo M_URL('Domain','clientList','',GP("sumlivemoney-1")); ?>"><i class="desc-i"></i>直播总连麦币</a>
                        <?php }else{ ?>
                            <a class="desc" href="<?php echo M_URL('Domain','clientList','',GP("sumlivemoney-2")); ?>"><i class="asc-i"></i>直播总连麦币</a>
                        <?php }?>

                    </div>
                </li>
                <li class="gameScreen" style="position: absolute;right:0px;top:-6px;"><i class="iconfont icon-filter-2" style="float: none;"></i>&nbsp;&nbsp;筛选
                    <ul class="H5-gameScreen">
                        <img src="//ks.kesion.com/Public/app/images/regup.png" alt="">
                        <li>
                            <span>网校模式：</span>
                            <div>
                                <a href="<?php echo M_URL('Domain','clientList','',GP("type-3")); ?>" class="<?php if($type ==3){ echo 'active';}?>">不限</a>
                                <a href="<?php echo M_URL('Domain','clientList','',GP("type-2")); ?>" class="<?php if($type ==2){ echo 'active';}?>">机构</a>
                                <a href="<?php echo M_URL('Domain','clientList','',GP("type-1")); ?>" class="<?php if($type ==1){ echo 'active';}?>">教师</a>
                            </div>
                        </li>
                        <li>
                            <span>营销模式：</span>
                            <div>
                                <a href="<?php echo M_URL('Domain','clientList','',GP("status-3")); ?>" class="<?php if($status ==3){ echo 'active';}?>">不限</a>
                                <a href="<?php echo M_URL('Domain','clientList','',GP("status-2")); ?>" class="<?php if($status ==2){ echo 'active';}?>">已审核</a>
                                <a href="<?php echo M_URL('Domain','clientList','',GP("status-1")); ?>" class="<?php if($status ==1){ echo 'active';}?>">通过审核</a>
                            </div>
                        </li>
                        <li>
                            <span>版本：</span>
                            <div>
                                <a href="<?php echo M_URL('Domain','clientList','',GP("package-100")); ?>" class="<?php if($package ==100){ echo 'active';}?>">不限</a>
                                <a href="<?php echo M_URL('Domain','clientList','',GP("package-0")); ?>" class="<?php if($package ==0){ echo 'active';}?>">通用版</a>
                                <a href="<?php echo M_URL('Domain','clientList','',GP("package-1")); ?>" class="<?php if($package ==1){ echo 'active';}?>">高级运营版</a>
                                <a href="<?php echo M_URL('Domain','clientList','',GP("package-2")); ?>" class="<?php if($package ==2){ echo 'active';}?>">钻石运营版</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
	<div class="H5-gameListConts" style="background: #fff;padding: 13px;">
		<form target="hidframe" id="myform" method="post" target="hidframe"  action="<?php echo M_URL('Domain','batch','',GP('p-'.$page->now_page)) ?>" class="form-horizontal" enctype="multipart/form-data">
              <table class="ks-table" style="background: #fff;">
                    <thead style="background: #cccccc9c;">
                        <tr>
                            <th>选择</th>
                            <th>机构ID</th>                           
                            <th style="display:none">机构LOGO</th>                           
                            <th style="text-align:left">机构信息</th>

                            <th>版本信息</th>
                            <th>注册信息</th>
                           <th >财富（可用/累计）</th>
                            <th>业务员</th>
                            <th>上次跟进时间</th>
                            <th>下次跟进时间</th>
                            <th>星级</th>
                            <th>跟进状态</th>
                            <th>最新跟进记录</th>
                            <th>操作</th>
                        </tr>
                    </thead>

                    <tbody>
                    	<?php foreach($values as $k =>$v){ ?>
                    	<tr>
						    <?php 
                            $mydomain =wx_Url($v['wxid']);
                            ?>
                    		<td><input type="checkbox" class="select-checks" value="<?php echo $v['wxid'];?>" name='check[]'/></td>
                    		<td><a href='<?php echo $mydomain.'/?f=m';?>' title="预览手机版" target='_blank'><?php echo $v['wxid']; ?></a></td>
                    		<td style="display:none"><a href="<?php echo $mydomain;?>" target="_blank"><img style="display: inline-block;overflow: hidden;cursor: pointer;width: 79px;max-height: 63px;"  src="<?php if(empty($v['wilogo'])||strstr($v['wilogo'],'/Public/admin/images/login/logo.png')){echo '/Public/admin/images/login/wilogo.png';}else{echo Img($v['wilogo']);} ?>"></a></td>
                    		<td style="text-align: left;">
                                用户名：<a href="<?php echo $mydomain;?>" target="_blank"><?php echo $v['username']; ?></a><br/>
                                名称：<a href="<?php echo $mydomain;?>/?f=pc" title="浏览PC版" target="_blank"><?php echo $v['sitename'] ?></a><br/>
                                域名：<a href="<?php echo $mydomain;?>" target="_blank"><?php echo wx_Url($v['wxid']); ?></a>  <a onClick="addTypeChange('<?php echo M_URL('Domain','wxeditDomain',$v['id'],GP(''));?>','600px','300px',{title:'域名修改',type:'top'});"><i class="iconfont icon-bianji1 deepBlue" style="color: #0a9cf1;"></i></a>
                                <br/>学员：<a href="<?php echo M_URL('home/Users','','',GP('usertype-0,wxid-'.$v['wxid'],true));?>"><?php echo $v['sum'];?></a>位
                            </td>

                    		
                    		<td style="text-align: left;"  nowrap>
                            版本：
                            <?php echo wx_version($v['wxid']); ?>
                            <br/>到期时间：<?php echo date('Y-m-d',$v['packendtime']);?>
                            <br/>独立收款： <?php
                                  $payToStoreAccount=checkIsOpenOwnerPay($v['wxid']);   //VIP  版本才可以使用独立收款插件
                                  if ($payToStoreAccount){
                                      echo "<span style='color:blue'>是</span>";
                                  }else{
                                      echo "否";
                                  }
                                       ?>
                            </td>
                    	
                            <td style="text-align: left;" nowrap>
                            登录次数：<a href="<?php echo M_URL('Domain','loginlog',$v['wxid'],GP('oldp-'.$now_page,true));?>"><?php echo $v['logintimes'];?></a>
                            <br /><div title="注册时间：<?php echo KS_DATE($v['adddate']); ?>">注册时间：<?php echo date('Y-m-d',$v['adddate']);?></div>
                            <br/>最后登录：<?php echo date('Y-m-d',$v['lastlogintime']);?></td>
                    		<td  style="text-align: left;" nowrap>
                            余额:￥<?php echo Field($v['money']); ?>/<?php echo Field($v['sunmoney']); ?><br />
                            点播流量：充：<a href='<?php echo M_URL('home/Domain','serviceRecord',4,GP('wxid-'.$v['wxid'])); ?>'><?php echo number_format(getLimitService(3,0,$v['wxid'])/1024,2);?></i>G</a>/剩：<?php echo getVodAvailableTraffic($v['wxid']); ?>G <br/>
                            <!--空间容量剩：<?php //echo getAvailableSpace($v['wxid']); ?>G <br/>-->
                            短信：<i class="orange"><?php echo Field($v['smsnum']); ?></i>/<?php echo Field($v['sumsmsnum']); ?><br />
                            直播币：<i class="orange see1"><?php echo Field($v['sumlivemoney']); ?></i>/<span class="see2"><?php echo number_format(getLimitService(6,0,$v['wxid']),2);?></span>

                            </td>
                    		<td><?php echo Field($v['salesman']); ?></td>
                    		<td><?php echo $v['followdate']?KS_DATE($v['followdate']):'-'; ?></td>
                    		<td><?php echo $v['nextdate']?KS_DATE($v['nextdate']):'-'; ?></td>
                    		<td><?php echo $v['starlevel'].'星'; ?></td>
                    		<td><?php echo $v['customerstatus']?$v['customerstatus']:'-'; ?></td>
                    		<td><?php echo $v['follow_content']?$v['follow_content']:'-'; ?></td>
<td class="ks-head-el">
	<i onClick="choiceClick(this)" class="iconfont icon-more"></i>
	<div class="ks-head-content ks-head-content-pc" style="width: 113px!important;">
		<ul class="opeart">
			<li>
				<a href="<?php echo M_URL('Domain','followList',$v['wxid'],GP('p-'.$now_page)) ?>"  >跟进记录</a>
			</li>
            <li>
                <a onClick="addTypeChange('<?php echo M_URL('Domain','Follow',$v['wxid'],GP('p-'.$now_page.',type-1')) ?>','700px','400px',{title:'添加客户',type:'top'});" >添加跟进</a>
            </li>
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

</div>
<div class="footer-page h60">
    <div class="col-sm-7  labes">
<!--     <div class="checkbox fl checkbox-info" style="margin-top:20px;margin-right:10px">-->
<!--     		<input  class="selectAll select-checks" name="check1" type="checkbox" id="sAll">-->
<!--            <label for="sAll">全选 </label>-->
<!--        </div>-->
<!--        <button class="btn mt10 btn-default fl" onClick="do_reg();" name="batch" value="2">批量审核</button>-->
<!--        <button class="btn mt10 btn-default fl" onClick="do_reg();" name="batch" value="3">取消审核</button>-->
		</form>

    </div>
    <div class="col-sm-5 " style="margin-top:7px"><?php echo $page->show(3); ?></div>

</body>

</html>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script src="<?php echo UOOT;?>Public/common/js/backstage.js"></script>
<script>
    //弹窗 短信和公众号模板
    $(document).ready(function() {
        $("#btn").click(function() {
            $("#choiceWindow").slideDown(300);
            $("#backGround").show();

        });

        $("#x").click(function() {
            $("#choiceWindow").slideUp(300);
            $("#backGround").hide();
        })

    });
    $(document).ready(function() {
        $("#btn1").click(function() {
            $("#choiceWindow1").slideDown(300);
            $("#backGround1").show();

        });
        $("#x1").click(function() {
            $("#choiceWindow1").slideUp(300);
            $("#backGround1").hide();
        })

    });

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