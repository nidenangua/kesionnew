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
<link href="<?php echo UOOT;?>Public/admin/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<style type="text/css">
	.gy{background: #F8F8F8;}
	.timelevel a{
	    padding: 9px;
	    border: 1px solid lightgray;
	    background-color: lightgray;
	    border-radius: 5px;
	}
	#orderdata span{
		margin-left:71px ;
	}
	#act{
		background-color: #FF5507;
		border: 1px solid #FF5507;
		color: white;
	}
	.curr{
		  border-image: none;
		    border-style: solid;
		    border-width: 1px;
		    color: #555;
		    cursor: default;
		    border-top: 0;
		    background-color: #fff!important;
		}
		.timelevel{
			position: absolute;
		    right: 53px;
		    top: 16px;
		    list-style: none;
		}
</style>
<body class="gray-bg">
<div class="wrapper" style="margin-top:35px">
<div class="row">
<div id="manage_top" class="menu_top_fixed  p15 height73" >
    <div class="ibox-title">
        <h3 class="fl">&nbsp;&nbsp;提现管理 
		<a href="<?php echo M_URL('Capital'); ?>" class="mr20" >校长收入提现</a> 
		<a href="<?php echo M_URL('Capital\toperson'); ?>" class="mr20" >微信打款到个人</a> 
		<a href="<?php echo M_URL('Capital\spreadindex'); ?>" class="mr20 act">推广提现</a>  
		<a href="<?php echo M_URL('Capital\Distribution'); ?>" class="mr20">分销提现</a> 
		</h3>
        &nbsp;&nbsp;&nbsp;&nbsp;提现总金额&nbsp;&nbsp;<font class="defColor" size="5px">￥<?php if($allcomoney){ echo $allcomoney;}else{echo 0;} ?></font>
        	&nbsp;&nbsp;&nbsp;&nbsp;已提现金额&nbsp;&nbsp;<font class="defColor" size="4px">￥<?php if($successcomoney){echo $successcomoney;}else{echo 0;} ?></font>
        	&nbsp;&nbsp;&nbsp;&nbsp;未体现金额&nbsp;&nbsp;<font class="defColor" size="4px">￥<?php if($falsecomoney){echo $falsecomoney;}else{echo 0;} ?></font>
        	<a href="<?php echo M_URL('home/Setting','kfwecaht'); ?>" class="btn btn-info btn-rounded btn-s-md  ml15" style="background: #FF5507;border: none;">客服号设置</a>
        <div class="fr">
        	
            <div class="fl ks-top-search mt7">
			<!--搜索-->
			
			<select class="inputText bRadius5 fl" id="keytype" style="width: 150px;">
			     <option value="1">用户名称</option>
	  	    </select>
	  	    <!--<span class="inputText bRadius5 fl" id="keytype" style="width: 150px;cursor: pointer;line-height:34px;text-align: center;">
	  	    	网校名称
	  	    </span>-->
			   
			<form target="hidframe" class="fr">
				<input type="text" class="sc-text" name="searchText" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>">
            <input type="button" class="sc-button" onclick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL('Capital','spreadindex'); ?>','<?php echo URL_MODEL;?>');" name="searchBtn" value="搜索">
			</form>
						
			<!--搜索-->
			</div> 
              
              
        </div>
    </div>
</div>


</div>

<div id="ksBoxContent">
	<form target="hidframe" id="myform" action="<?php echo M_URL('home/Capital','batch2','',GP('p-'.$page->now_page)) ?>" method="post">
	<div style="padding: 40px 0px;">
		
	<div class="H5-gameListScreen">
		<ul class=" nav nav-tabs">
	        <li class="fl hLh40 pl10 pr10 mr20 fsize18 <?php if($status==3) echo " curr" ;?>">
	        	<a href="<?php echo M_URL('home/Capital','spreadindex','',GP("status-3")); ?>">不限</a>
	        </li>
	        <li class="fl hLh40 pl10 pr10 mr20 fsize18 <?php if($status==1) echo " curr" ;?>">
	        	<a href="<?php echo M_URL('home/Capital','spreadindex','',GP("status-1")); ?>" >已结算</a>
	        </li>
	        <li class="fl hLh40 pl10 pr10 mr20 fsize18 <?php if($status==0) echo " curr" ;?>">
	        	<a href="<?php echo M_URL('home/Capital','spreadindex','',GP("status-0")); ?>" >未结算</a>
	        </li>
	    </ul>
	    <div>
	    	<li class="timelevel">
				<a  href="<?php echo M_URL('home/Capital','spreadindex','',GP("option-5")); ?>" id="<?php if($option ==5){ echo 'act';}?>">全部</a>
				<a  href="<?php echo M_URL('home/Capital','spreadindex','',GP("option-1,numb-0")); ?>" id="<?php if($option ==1&&$num==0){ echo 'act';}?>">本周</a>
				<a href="<?php echo M_URL('home/Capital','spreadindex','',GP("option-1,numb-1")); ?>" id="<?php if($option ==1&&$num==1){ echo 'act';}?>">上周</a>
				<a href="<?php echo M_URL('home/Capital','spreadindex','',GP("option-2,numb-0")); ?>" id="<?php if($option ==2&&$num==0){ echo 'act';}?>">本月</a>
				<a href="<?php echo M_URL('home/Capital','spreadindex','',GP("option-2,numb-1")); ?>" id="<?php if($option ==2&&$num==1){ echo 'act';}?>">上月</a>
				<a href="<?php echo M_URL('home/Capital','spreadindex','',GP("option-3,numb-0")); ?>" id="<?php if($option ==3&&$num==0){ echo 'act';}?>">本季度</a>
				<a href="<?php echo M_URL('home/Capital','spreadindex','',GP("option-3,numb-1")); ?>" id="<?php if($option ==3&&$num==1){ echo 'act';}?>">上季度</a>
			</li>
	    </div>
		<!-- <ul class="H5-gameOpt clearfix">  -->
			<!-- <li style="margin-right: 15px;"><input  class="selectAll select-checks" name="check1" type="checkbox"></li> -->
			<!--<li>转换率<i class="iconfont icon-sort-double-down"></i></li>-->
			<!-- <li>
				<div class="shaixuan clearfix">
					
				</div> 
			</li> -->
			
<!-- 			<li class="fr gameScreen"><i class="iconfont icon-filter-2" style="float: none;"></i>&nbsp;&nbsp;筛选

				<ul class="H5-gameScreen">
					<img src="//ks.kesion.com/Public/app/images/regup.png" alt="">
					<li>
						<span>结算状态：</span>
						<div>
							<a href="<?php echo M_URL('home/Capital','spreadindex','',GP('status-3')); ?>" <?php if($status==3)echo "class='active'";?>>不限</a>
							<a href="<?php echo M_URL('home/Capital','spreadindex','',GP('status-1')); ?>" <?php if($status==1)echo "class='active'";?>>已结算</a>
							<a href="<?php echo M_URL('home/Capital','spreadindex','',GP('status-0')); ?>" <?php if($status==0)echo "class='active'";?>>待结算</a>
						</div>
					</li>
				</ul> -->
<!-- 
			</li>				
		</ul>	 -->
	</div>
	

	<div class="H5-gameListConts school-online">
		<div class="Created-push" id="ksBoxContent" style="padding:15px;">
		<table class="ks-table" id="tables">
			<tr style="background: #EEEEEE;">
				<th><input type="checkbox" class="select-checks fl" /></th>
				<th>结算</th>
				<th>审核</th>
				<th class="shaixuan">
					<?php if($adddate == 2){?>
						<a class="desc" href="<?php echo M_URL('home/Capital','spreadindex','',GP("adddate-1")); ?>"   style="float: none;"><i class="desc-i" style="top: -1px;"></i>提交时间</a>		
					<?php }else{ ?>
						<a class="desc" href="<?php echo M_URL('home/Capital','spreadindex','',GP("adddate-2")); ?>"   style="float: none;"><i class="asc-i" style="top: -1px;"></i>提交时间</a>
								
					<?php }?>
				</th>
				<th>结算方式</th>
				<th>结算金额</th>
				<th>手机号</th>
				<th>用户名</th>
				<th>提现方式</th>
            	<th>提现账号</th>
                <th>提现姓名</th>
                <th>操作</th>
			</tr>
			<?php foreach($values as $k=>$v){?>		
			<tr>
				<td><input type="checkbox" class="select-checks fl" name="check[]" value="<?php echo $v["id"];?>"/></td>
				<td><?php if($v['status']==1){echo '已结算';}else{ echo '待结算';}?></td>
				<td>
					<?php if($v['status']==1){?>
						<a class="ok-icon ok-pe1" href="<?php echo M_URL('home/Capital','unaudited1',$v['id'],GP('p-'.$page->now_page));?>" title="待结算"></a>
					<?php }else{ ?>
						<a class="ok-icon ok-pe2" href="<?php echo M_URL('home/Capital','audited1',$v['id'],GP('p-'.$page->now_page));?>" title="确认结算"></a>
					<?php }?>
							
				</td>
				<td><?php echo Field(date('Y-m-d H:i:s',$v['adddate']));?></td>
                <td style="width: 480px;"><?php echo Field($v['mark']);?></td>
				<td><?php echo Field($v['cmoney']);?>元</td>
				<td><?php echo Field($v['mobile']);?></td>
				<td><?php echo Field($v['username']);?></td>
				<td><?php echo $v['bank'];?></td>
				<td><?php echo Field($v['banknum']);?></td>
				<td><?php echo Field($v['name']);?></td>
				<th>
				<?php if($v['status']==1){ ?>
					<a class="" href="<?php echo M_URL('home/Capital','sendtxmsg',$v['id'],GP('userid-'.$v['userid']));?>" title="发送通知">发送通知</a>
				<?php } ?>	
				</th>
			</tr>	
			<?php }?>


							
		</table>	
					<?php echo NoC($values);?> 
		</div>
		
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
            <input  class="selectAll select-checks" name="check1" type="checkbox">
            <label for="checkboxAll">全选 </label>
        </div>
     
        <button class="btn mt10 btn-default" type="submit" name="batch" value="2">批量审核</button>
        <button class="btn mt10 btn-default" type="submit" name="batch" value="3">取消审核</button>
    </div>

    <div class="col-sm-7 " style="margin-top:7px">
    	<?php echo $page->show(3); ?>	
    </div>
   </div>
 </form>
</body>

</html>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>





<!--<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>科汛在线教育</title>
<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<script src="<?php echo UOOT;?>Public/common/js/jquery.min.js"></script>
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content mt55 animated fadeIn"  >
    <div class="row">
        <div id="manage_top" class="menu_top_fixed height73 p15 " >
            <div class="ibox-title">
              <h3 class="fl" ></h3>
              <div class="ibox-tools">
                    <a href="javascript:void(0)" onclick="history.go(0)" class="collapse-link mt0">
                       <i class="reflash"></i>
                    </a>
              </div>提现结算
            </div>
        </div>
    </div>
    <div class="row"><br />
        <div class="col-sm-12 ">
            <div class="tabs-container">
             <ul class="nav nav-tabs">
                <li <?php if($status==3)echo "class='active'";?>>
                <a href="<?php echo M_URL('home/Capital','spreadindex','',GP('status-3')); ?>"> 所有</a>
                </li>
                <li <?php if($status==1)echo "class='active'";?>>
                <a href="<?php echo M_URL('home/Capital','spreadindex','',GP('status-1')); ?>">已结算</a>
                </li>
                </li>
                <li <?php if($status==0)echo "class='active'";?>>
                <a href="<?php echo M_URL('home/Capital','spreadindex','',GP('status-0')); ?>">待结算</a>
                </li>
            </ul>
                <div class="taps-button">
                    <div class="row btn-choice">
              <a href="<?php if($hits==1){echo M_URL('home/Domain','index','',GP('hits-0'));}else{echo M_URL($this->AppName.'/index','index','',GP('hits-1'));} ?>"></a>
                    </div>
                </div>
<form target="hidframe" id="myform" action="<?php echo M_URL('home/Domain','batch','',GP('p-'.$page->now_page)) ?>" method="post">
    <div class="tab-content">
      <div id="tab-1" class="tab-pane active" style="">
        <div class="panel-body" style="padding:0">
           <div class="row">
              <div class="col-sm-12 ">
                 <div class="ibox float-e-margins pt15">
                    <div class="ibox-content">
                     <table class="table table-bordered ">
                        <thead>
                        <tr><th>序号</th><th>网校id</th><th><span style="color: red;">绑定域名</span>--/--暂存域名</th><th>审核状态</th><th>提现时间</th><th>操作</th><th>备注</th></tr>
                        </thead>
                      <tbody>
                      <?php foreach($values as $k=>$v){?>
                        <tr>
                            <td>
                                <div class="checkbox  checkbox-info" >
                            <input id="C<?php echo $v["id"];?>" type="checkbox" name="check[]" value="<?php echo $v["id"];?>" class="check0">
                            <label for="C<?php echo $v["id"];?>"><?php echo $v["id"];?></label>
                                </div>
                            </td>
                            <td><?php echo $v["wxid"];?></td>
                            <td><span style="color: red;"><?php echo $v["domain"];?></span>--/--<?php echo $v["predomain"];?></td>
                            <td style="width:200px">
                            <?php if($v["status"]==1){ ?>
                             <label class="txt-top"><a class="ok-icon ok-pe1" href="<?php echo M_URL('home/Capital','unaudited',$v['id'],GP('p-'.$page->now_page));?>" title="待结算"></a></label>
                            <?php }elseif($v["status"]==0){ ?>
                             <label class="txt-top"><a class="ok-icon ok-pe2" href="<?php echo M_URL('home/Capital','audited',$v['id'],GP('p-'.$page->now_page));?>" title="确认结算"></a></label>
                            <?php } ?>
                            </td>
                            <td><?php echo Field(date('Y-m-d H:i:s',$v['adddate']));?></td>
                            <td><?php echo Field($v['mark']);?></td>
                            <td style="width:200px">
                            <?php if(!empty($v["defaultpic"])){ ?>
                             <label class="txt-top"><a onclick="addTypeChange('<?php echo M_URL('home/Capital','editwithdraw',$v['id'],GP('p-'.$page->now_page));?>','750px','550px',{title:'结算操作',type:'top'})"><i class="edit2017"  title="修改凭证"></i></a></label>
                            <?php }else{ ?>
                             <label class="txt-top"><a onclick="addTypeChange('<?php echo M_URL('home/Capital','editwithdraw',$v['id'],GP('p-'.$page->now_page));?>','750px','550px',{title:'添加凭证',type:'top'})"><i class="show2017" title="添加凭证"></i></a></label>
                            <?php } ?> 
                            <label class="txt-top">
                            <a href="javascript:void(0);" onclick="Confirm('是否删除此新闻？该操作不可逆！','<?php echo M_URL('home/Capital','delect',$v['id'],GP('p-'.$page->now_page));?>')"><i class="delete2017"></i></a></label>
                            </td>
                        </tr>
                     <?php } ?>
                     </tbody>
                    </table>
                    <?php echo NoC($values);?> 
                    </div>
                 </div>
              </div>
           </div>
        </div>
        <div class="footer-page h60">
                <div class="col-sm-5">
                 <div class="checkbox fl checkbox-info" style="margin-top:20px;margin-right:10px">
                    <input id="checkboxAll" name="check1" type="checkbox" class="check-all check0">
                    <label for="checkboxAll">全选</label>
                </div>
                    <button class="btn mt10 btn-default" onClick="do_reg();" name="batch" value="2">批量审核</button>
                    <button class="btn mt10 btn-default" onClick="do_reg();" name="batch" value="3">取消审核</button>
                    <button class="btn mt10 btn-default" onClick="do_reg();" name="batch" value="1">批量删除</button>
                </div>
                <div class="col-sm-7 "  style="margin-top:7px"><?php echo $page->show(3); ?></div>
        </div>
        <div id="tab-2" class="tab-pane">
            <div class="panel-body">
            </div>
        </div>
      </div>
    </div>
</form>
           </div>
       </div>
    </div>
</div>

</script>

<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
	loadScorllJs();//滚轮
	var selectInputs = $('.check0');
	var checkAllInputs = $('.check-all')
	selectall(selectInputs,checkAllInputs)
	buttonTap()//按钮样式切换
    function attributeSelect(url){
        window.location.href=''+url;
    }
    function do_reg(){
	   $("#myform").submit();	
    }
</script>
</body>
</html>-->
