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
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<body class="ks-wrap">
	


	<div id="ksBoxHead">
		<!--结束-->
		<div class="Header-tool  clearfix">
			<div class="Tool-Title">
			
	
			
			<!--标题-->
			<p>	<a href="javascript:history.go(-1);"><i class="iconfont icon-jiantou-copy"></i>我的应用</a><span>/</span>课程红包 </p>
			<!--标题-->
			
			</div>
			<!--操作范围-->

			<div class="Tool-btnGroup">
				 <a class="ks-bt bt-pur mr10" href="<?php echo M_URL($this->AppName.'/Index','addRedpacket','',GP("")); ?>" style="margin-left:15px;display:inline-block">
				<i class="iconfont icon-jiahao"></i>增加红包</a>
				
			</div>
	
			 
			<!--操作范围-->
			<div class="clearfix ks-top-tab">
				
				<div class="fr ks-top-search">
					<label class="mr10">
					<select class="w150 inputText bRadius5" id="keytype">
						<option value="1" <?php if($keytype==1)echo 'selected';?>>课程红包</option>
						<option value="3" <?php if($keytype==3)echo 'selected';?>>面值</option>
					</select>
					</label>
					<input type="text" class="sc-text" name="searchText" id="keyword"  value="<?php if(isset($keyword))echo $keyword;?>">
					<input type="button" class="sc-button" name="searchBtn" value="搜索" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','index'); ?>','<?php echo URL_MODEL;?>')">
				</div>
			</div>	
			
		</div>

	<div class="H5-gameListScreen">
			<ul class="H5-gameOpt clearfix">
				
				
				<li class="fr gameScreen" style="float: right;"><i class="iconfont icon-filter-2 fn"></i>&nbsp;&nbsp;筛选

					<ul class="H5-gameScreen">
						<img src="//ks.zuojy.com/Public/app/images/regup.png" alt="">
						<li>
							<span>红包类型：</span>
							<div>
								<ul>
									<li class="fl  <?php if($stat==3) echo " curr" ;?>"><a href="<?php echo M_URL($this->AppName.'/Index','index','',GP("stat-3,appid-$this->appid",true)); ?>">不限</a></li>
						<li class="fl  <?php if($stat==1) echo " curr" ;?>"><a href="<?php echo  M_URL($this->AppName.'/Index','index','',GP("stat-1,appid-$this->appid",true)); ?>">网授课程</a></li>
						<li class="fl  <?php if($stat==0) echo " curr" ;?>"><a href="<?php echo M_URL($this->AppName.'/Index','index','',GP("stat-0,appid-$this->appid",true)); ?>">面授课程</a></li>
								</ul>
							</div>
						</li>

							


					</ul>

				</li>	
				
				<li style="float: right;">
				<span class="ks-bt bt-def" onClick="appSetUp({title:'应用设置',type:'app',appid:<?php echo $this->appid; ?>,wxid:<?php echo $this->wxid; ?>})" style="margin-top:8px;border:0"><i class="iconfont icon-setting"></i>红包配置</span>
				</li>	
			</ul>	
	</div>
	</div>


	<div id="ksBoxContent">
		<div class="bRadius10 ks-wbox ">
        <form target="hidframe"  action="<?php echo M_URL($this->AppName.'/Index','bathDelStudycard','',GP("p-$page->now_page"));?>" method="post" id="myform">
            
            <table width="100%" cellpadding="0" cellspacing="0" border="0"  class="ks-table">
	            <thead>
		            <tr >
		                <th class="form-in"><input type="checkbox" class="select-checks selectAll"></th>
		                <th>使用范围</th>
		                <th class="ta-left">红包名称</th>
		                <th>有效期</th>
		                <th>面值</th>
		                <th>状态</th>
		                <th>操作</th>
		            </tr>
	            </thead>
                <tbody>
                <?php foreach($values as $k=>$v){ ?>
                    <tr>
                        <td class="form-in">
                            <input type="checkbox" class="select-checks" name="id[]" value="<?php echo $v['id'] ?>">
                        </td>
                        <td><?php if($v['scope'] == 0){echo "不限制";}elseif($v['scope'] == 1){echo "网授课程";}else{echo "面授课程";}?></td>
                        <td class="ta-left" width="30%">
                        	<div class="td-info">
                        		<div class="name"><?php echo $v['redpacket']?></div>
                        		<div class="btn-box">
                        			<a href="<?php echo M_URL($this->AppName.'/Index','createRedpacketNum',$v['id'],GP("appid-$this->appid",true)); ?>">发放红包</a>
                        			<a href="<?php echo M_URL($this->AppName.'/Index','createRedPacketExcel',$v['id'],GP("appid-$this->appid",true)); ?>">生成excel</a>

                        		</div>
                        	</div>
                        </td>
                        <td>
                            <?php echo  Field(date("Y-m-d",$v['startime']));?>至
                            <?php echo  Field(date("Y-m-d",$v['endtime']));?>
                        </td>
                        <td class="sub-color">满<?php echo Field($v['facevalue']);?>减<?php echo Field($v['minamount']);?></td>

                        <td >
                            <?php if($v['status'] == 0){echo "正常";}else{echo "停用";}?>
                        </td>

                        <td>
                        	<div class="operate">
                        		<a href="<?php echo M_URL($this->AppName.'/Index','viewRedpacketNum',$v['id'],GP("appid-$this->appid",true)); ?>"><em>查看</em><i class="iconfont">&#xe64b;</i></a>
 
	                            <a href="<?php echo M_URL($this->AppName.'/Index','editRedpacket',$v['id'],GP("p-$page->now_page")); ?>"><em>编辑</em><i class="iconfont">&#xe63d;</i></a>
	                            <a href="javascript:void(0);"  onclick="Confirm('是否删除此学员？该操作不可逆!','<?php echo M_URL($this->AppName.'/Index','delStudycard',$v['id'],GP('p-'.$now_page)); ?>')"><em>删除</em><i class="iconfont">&#xe638;</i> </a>
                           </div>
                        </td>
                    </tr>
                <?php }?>
                </tbody>
        </table>
        <?php echo NoC($values);?> 

	    <input type="hidden" name="batch" id="batch1" />
    	</form>

    </div>

</div>


<div id="ksBoxFooter" >
	<div class="ks-bom clearfix">
		<span class="fl">
			<label class="mr20 fl"><input type="checkbox" class="select-checks selectAll">全选</label>
			<button class="ks-bt bt-pue" onclick="submitform(1);"><i class="iconfont icon-lajitong"></i>批量删除</button>
		</span>
		<div class="fr"><?php echo $page->show(3); ?></div>
	</div>
</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
    
function submitform(type){
	$('#batch1').val(type);
	$('#myform').submit();
}	
    
</script>
</body>
</html>
