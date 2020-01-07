
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
        	<a href="<?php echo M_URL('Paylog','livecurrency'); ?>" class="mr20" >购买记录</a> 
		    <a href="<?php echo M_URL('Paylog','livepay'); ?>" class="mr20 act">消费记录</a>   
            &nbsp;&nbsp;&nbsp;&nbsp;总时长(包括学生)&nbsp;&nbsp;<font class="defColor" size="4px"><?php if($outtime){echo number_format($outtime/60,2);}else{echo 0;} ?>分钟</span>(<?php if($outtime){echo $outtime;}else{echo 0;} ?>s)</font>
            &nbsp;&nbsp;&nbsp;&nbsp;花费(直播币)&nbsp;&nbsp;<font class="defColor" size="4px">￥<?php if($outmoney){echo $outmoney;}else{echo 0;} ?></font>
        </h3>
        <div class="fr">
            <div class="fl ks-top-search">
			<!--搜索-->
			<form target="hidframe" class="fr">		
				<select class="inputText bRadius5 fl" id="keytype" style="width: 150px;">
                     <option value="1" <?php if($keytype==1){echo 'selected="selected"';} ?>>课程或班级名</option>
                     <option value="2" <?php if($keytype==2){echo 'selected="selected"';} ?>>网校ID</option>
				     <option value="3" <?php if($keytype==3){echo 'selected="selected"';} ?>>网校名称</option>
		  	    </select>
				<input type="text" class="sc-text" name="searchText" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>">
           		<input type="button" class="sc-button fl" onclick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL('Paylog','livepay'); ?>','<?php echo URL_MODEL;?>');" name="searchBtn" value="搜索">
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
                <li class="fl hLh40 pl10 pr10 mr20 fsize18 <?php if($status==3) echo " curr" ;?>"><a href="<?php echo M_URL('home/Paylog','livepay','',GP('status-3')); ?>">全部</a></li>
                <li class="fl hLh40 pl10 pr10 mr20 fsize18 <?php if($status==1) echo " curr" ;?>"><a href="<?php echo M_URL('home/Paylog','livepay','',GP('status-1')); ?>">已结算</a></li>
                <li class="fl hLh40 pl10 pr10 mr20 fsize18 <?php if($status==0) echo " curr" ;?>"><a href="<?php echo M_URL('home/Paylog','livepay','',GP('status-0')); ?>">待结算</a></li>           
        </ul>
	</div>
	<div class="H5-gameListConts school-online">
		<div class="Created-push" id="ksBoxContent" style="padding:15px;">
		<table class="ks-table" id="tables">
			<tr style="background: #EEEEEE;">
                <th>网校ID</th>
				<th>网校名称</th>
				<th>类型</th>
				<th style="text-align: left;">课程或班级名</th>
				<th style="text-align: left;">总时长(包括学生)</th>
				<th>花费(直播币)</th>
				<th>剩余(直播币)</th>
				<th class="shaixuan">
                   <?php if($byname == 'a.adddate asc'){?>
                        <a class="desc" href="<?php echo M_URL('home/Paylog','livepay','',GP("byname-a.starttime desc")); ?>" style="float: none;"><i class="desc-i" style="top: -1px;"></i>开始时间</a>     
                    <?php }else{ ?>
                        <a class="desc" href="<?php echo M_URL('home/Paylog','livepay','',GP("byname-a.starttime asc")); ?>" style="float: none;"><i class="asc-i" style="top: -1px;"></i>开始时间</a>
                    <?php }?>            
                </th>
				<th>结束时间</th>
				<th>扣费时间</th>
				<th>摘要</th>
				<th>操作</th> 
			</tr>
					
			<?php foreach($pagelogs as $k=>$v){ ?>
                <tr>
                    <td><?php echo $v['wxid']; ?></td>
                    <td><?php echo $v['sitename']; ?></td>
					<td><?php if($v['classlevel']==1){ echo '一对一'; }elseif($v['classlevel']==2){ echo '小班'; }elseif($v['classlevel']==3){ echo '千人直播'; }?></td>
					<td style="text-align: left;"><?php echo $v['title']; ?></td>
					<td style="text-align: left;"><span style="color:red;"><?php echo number_format($v['time']/60,2);?>分钟</span>(<?php echo $v['time'];?>s)</td>
					<td><span style="color:red;"><?php echo $v['cost']; ?>元</span></td>
					<td><span style="color:red;"><?php echo $v['balance']; ?>元</span></td>
                    <td><?php echo date('y/m/d H:i:s',$v['starttime']); ?></td>
					<td><?php echo date('y/m/d H:i:s',$v['endtime']); ?></td>
					<td><?php echo date('y/m/d H:i:s',$v['settlement']); ?></td>
                    <td><?php if($v['status']==2){echo '已结算';}else{echo '待结算';}; ?></td>
                    <th><a href="javascript:" onclick="addTypeChange('/admin.html/home/Paylog/studentList?id-<?php echo $v['id'];?>','1040px','760px',{title:'上课学生',type:'top'})">学生详情</a></th>
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
     <form action="<?php echo  M_URL('home/Paylog','livepayExcel','',GP('')); ?>" method="post">
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
                <li class='active'>
                <a href="<?php echo UOOT;?>admin.php/home/Capital/index?status-3"> 所有</a>
                </li>
                <li >
                <a href="<?php echo UOOT;?>admin.php/home/Capital/index?status-1">已结算</a>
                </li>
                </li>
                <li >
                <a href="<?php echo UOOT;?>admin.php/home/Capital/index?status-0">待结算</a>
                </li>
            </ul>
                <div class="taps-button">
                    <div class="row btn-choice">
              <a href="<br />
<b>Notice</b>:  Undefined variable: hits in <b>/app/Application/View/admin/Capital/withdraw_bill.php</b> on line <b>514</b><br />
<br />
<b>Notice</b>:  Undefined property: CapitalController::$AppName in <b>/app/Application/View/admin/Capital/withdraw_bill.php</b> on line <b>514</b><br />
<?php echo UOOT;?>admin.php//index/index?hits-1"></a>
                    </div>
                </div>
<form target="hidframe" id="myform" action="<?php echo UOOT;?>admin.php/home/Domain/batch?p-1" method="post">
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
                                              <tr>
                            <td>
                                <div class="checkbox  checkbox-info" >
                            <input id="C33" type="checkbox" name="check[]" value="33" class="check0">
                            <label for="C33">33</label>
                                </div>
                            </td>
                            <td>2</td>
                            <td><span style="color: red;">ks.kesion.com</span>--/--ks.zuojy.com</td>
                            <td style="width:200px">
                                                         <label class="txt-top"><a class="ok-icon ok-pe1" href="<?php echo UOOT;?>admin.php/home/Capital/unaudited/33?p-1" title="待结算"></a></label>
                                                        </td>
                            <td>2018-02-12 10:38:20</td>
                            <td>大佬你提现了10,请等待审核,三天内到账</td>
                            <td style="width:200px">
                                                         <label class="txt-top"><a onclick="addTypeChange('<?php echo UOOT;?>admin.php/home/Capital/editwithdraw/33?p-1','750px','550px',{title:'添加凭证',type:'top'})"><i class="show2017" title="添加凭证"></i></a></label>
                             
                            <label class="txt-top">
                            <a href="javascript:void(0);" onclick="Confirm('是否删除此新闻？该操作不可逆！','<?php echo UOOT;?>admin.php/home/Capital/delect/33?p-1')"><i class="delete2017"></i></a></label>
                            </td>
                        </tr>
                                             <tr>
                            <td>
                                <div class="checkbox  checkbox-info" >
                            <input id="C32" type="checkbox" name="check[]" value="32" class="check0">
                            <label for="C32">32</label>
                                </div>
                            </td>
                            <td>2</td>
                            <td><span style="color: red;">ks.kesion.com</span>--/--ks.zuojy.com</td>
                            <td style="width:200px">
                                                         <label class="txt-top"><a class="ok-icon ok-pe2" href="<?php echo UOOT;?>admin.php/home/Capital/audited/32?p-1" title="确认结算"></a></label>
                                                        </td>
                            <td>2018-02-01 16:17:30</td>
                            <td>大佬你提现了18,请等待审核,三天内到账</td>
                            <td style="width:200px">
                                                         <label class="txt-top"><a onclick="addTypeChange('<?php echo UOOT;?>admin.php/home/Capital/editwithdraw/32?p-1','750px','550px',{title:'添加凭证',type:'top'})"><i class="show2017" title="添加凭证"></i></a></label>
                             
                            <label class="txt-top">
                            <a href="javascript:void(0);" onclick="Confirm('是否删除此新闻？该操作不可逆！','<?php echo UOOT;?>admin.php/home/Capital/delect/32?p-1')"><i class="delete2017"></i></a></label>
                            </td>
                        </tr>
                                             <tr>
                            <td>
                                <div class="checkbox  checkbox-info" >
                            <input id="C31" type="checkbox" name="check[]" value="31" class="check0">
                            <label for="C31">31</label>
                                </div>
                            </td>
                            <td>2</td>
                            <td><span style="color: red;">ks.kesion.com</span>--/--ks.zuojy.com</td>
                            <td style="width:200px">
                                                         <label class="txt-top"><a class="ok-icon ok-pe2" href="<?php echo UOOT;?>admin.php/home/Capital/audited/31?p-1" title="确认结算"></a></label>
                                                        </td>
                            <td>2018-02-01 15:22:03</td>
                            <td>大佬你提现了5,请等待审核,三天内到账</td>
                            <td style="width:200px">
                                                         <label class="txt-top"><a onclick="addTypeChange('<?php echo UOOT;?>admin.php/home/Capital/editwithdraw/31?p-1','750px','550px',{title:'结算操作',type:'top'})"><i class="edit2017"  title="修改凭证"></i></a></label>
                             
                            <label class="txt-top">
                            <a href="javascript:void(0);" onclick="Confirm('是否删除此新闻？该操作不可逆！','<?php echo UOOT;?>admin.php/home/Capital/delect/31?p-1')"><i class="delete2017"></i></a></label>
                            </td>
                        </tr>
                                             <tr>
                            <td>
                                <div class="checkbox  checkbox-info" >
                            <input id="C30" type="checkbox" name="check[]" value="30" class="check0">
                            <label for="C30">30</label>
                                </div>
                            </td>
                            <td>2</td>
                            <td><span style="color: red;">ks.kesion.com</span>--/--ks.zuojy.com</td>
                            <td style="width:200px">
                                                         <label class="txt-top"><a class="ok-icon ok-pe2" href="<?php echo UOOT;?>admin.php/home/Capital/audited/30?p-1" title="确认结算"></a></label>
                                                        </td>
                            <td>2018-02-01 15:20:05</td>
                            <td>大佬你提现了55,请等待审核,三天内到账</td>
                            <td style="width:200px">
                                                         <label class="txt-top"><a onclick="addTypeChange('<?php echo UOOT;?>admin.php/home/Capital/editwithdraw/30?p-1','750px','550px',{title:'添加凭证',type:'top'})"><i class="show2017" title="添加凭证"></i></a></label>
                             
                            <label class="txt-top">
                            <a href="javascript:void(0);" onclick="Confirm('是否删除此新闻？该操作不可逆！','<?php echo UOOT;?>admin.php/home/Capital/delect/30?p-1')"><i class="delete2017"></i></a></label>
                            </td>
                        </tr>
                                             <tr>
                            <td>
                                <div class="checkbox  checkbox-info" >
                            <input id="C29" type="checkbox" name="check[]" value="29" class="check0">
                            <label for="C29">29</label>
                                </div>
                            </td>
                            <td>2</td>
                            <td><span style="color: red;">ks.kesion.com</span>--/--ks.zuojy.com</td>
                            <td style="width:200px">
                                                         <label class="txt-top"><a class="ok-icon ok-pe1" href="<?php echo UOOT;?>admin.php/home/Capital/unaudited/29?p-1" title="待结算"></a></label>
                                                        </td>
                            <td>2018-02-01 15:19:12</td>
                            <td>大佬你提现了5,请等待审核,三天内到账</td>
                            <td style="width:200px">
                                                         <label class="txt-top"><a onclick="addTypeChange('<?php echo UOOT;?>admin.php/home/Capital/editwithdraw/29?p-1','750px','550px',{title:'添加凭证',type:'top'})"><i class="show2017" title="添加凭证"></i></a></label>
                             
                            <label class="txt-top">
                            <a href="javascript:void(0);" onclick="Confirm('是否删除此新闻？该操作不可逆！','<?php echo UOOT;?>admin.php/home/Capital/delect/29?p-1')"><i class="delete2017"></i></a></label>
                            </td>
                        </tr>
                                             <tr>
                            <td>
                                <div class="checkbox  checkbox-info" >
                            <input id="C28" type="checkbox" name="check[]" value="28" class="check0">
                            <label for="C28">28</label>
                                </div>
                            </td>
                            <td>2</td>
                            <td><span style="color: red;">ks.kesion.com</span>--/--ks.zuojy.com</td>
                            <td style="width:200px">
                                                         <label class="txt-top"><a class="ok-icon ok-pe2" href="<?php echo UOOT;?>admin.php/home/Capital/audited/28?p-1" title="确认结算"></a></label>
                                                        </td>
                            <td>2018-02-01 14:59:26</td>
                            <td>大佬你提现了1,请等待审核,三天内到账</td>
                            <td style="width:200px">
                                                         <label class="txt-top"><a onclick="addTypeChange('<?php echo UOOT;?>admin.php/home/Capital/editwithdraw/28?p-1','750px','550px',{title:'添加凭证',type:'top'})"><i class="show2017" title="添加凭证"></i></a></label>
                             
                            <label class="txt-top">
                            <a href="javascript:void(0);" onclick="Confirm('是否删除此新闻？该操作不可逆！','<?php echo UOOT;?>admin.php/home/Capital/delect/28?p-1')"><i class="delete2017"></i></a></label>
                            </td>
                        </tr>
                                             <tr>
                            <td>
                                <div class="checkbox  checkbox-info" >
                            <input id="C27" type="checkbox" name="check[]" value="27" class="check0">
                            <label for="C27">27</label>
                                </div>
                            </td>
                            <td>2</td>
                            <td><span style="color: red;">ks.kesion.com</span>--/--ks.zuojy.com</td>
                            <td style="width:200px">
                                                         <label class="txt-top"><a class="ok-icon ok-pe2" href="<?php echo UOOT;?>admin.php/home/Capital/audited/27?p-1" title="确认结算"></a></label>
                                                        </td>
                            <td>2018-02-01 11:47:13</td>
                            <td>大佬你提现了1,请等待审核,三天内到账</td>
                            <td style="width:200px">
                                                         <label class="txt-top"><a onclick="addTypeChange('<?php echo UOOT;?>admin.php/home/Capital/editwithdraw/27?p-1','750px','550px',{title:'添加凭证',type:'top'})"><i class="show2017" title="添加凭证"></i></a></label>
                             
                            <label class="txt-top">
                            <a href="javascript:void(0);" onclick="Confirm('是否删除此新闻？该操作不可逆！','<?php echo UOOT;?>admin.php/home/Capital/delect/27?p-1')"><i class="delete2017"></i></a></label>
                            </td>
                        </tr>
                                             <tr>
                            <td>
                                <div class="checkbox  checkbox-info" >
                            <input id="C26" type="checkbox" name="check[]" value="26" class="check0">
                            <label for="C26">26</label>
                                </div>
                            </td>
                            <td>2</td>
                            <td><span style="color: red;">ks.kesion.com</span>--/--ks.zuojy.com</td>
                            <td style="width:200px">
                                                         <label class="txt-top"><a class="ok-icon ok-pe1" href="<?php echo UOOT;?>admin.php/home/Capital/unaudited/26?p-1" title="待结算"></a></label>
                                                        </td>
                            <td>2018-01-31 14:03:42</td>
                            <td>大佬你提现了0.1,请等待审核,三天内到账</td>
                            <td style="width:200px">
                                                         <label class="txt-top"><a onclick="addTypeChange('<?php echo UOOT;?>admin.php/home/Capital/editwithdraw/26?p-1','750px','550px',{title:'添加凭证',type:'top'})"><i class="show2017" title="添加凭证"></i></a></label>
                             
                            <label class="txt-top">
                            <a href="javascript:void(0);" onclick="Confirm('是否删除此新闻？该操作不可逆！','<?php echo UOOT;?>admin.php/home/Capital/delect/26?p-1')"><i class="delete2017"></i></a></label>
                            </td>
                        </tr>
                                             <tr>
                            <td>
                                <div class="checkbox  checkbox-info" >
                            <input id="C25" type="checkbox" name="check[]" value="25" class="check0">
                            <label for="C25">25</label>
                                </div>
                            </td>
                            <td>2</td>
                            <td><span style="color: red;">ks.kesion.com</span>--/--ks.zuojy.com</td>
                            <td style="width:200px">
                                                         <label class="txt-top"><a class="ok-icon ok-pe1" href="<?php echo UOOT;?>admin.php/home/Capital/unaudited/25?p-1" title="待结算"></a></label>
                                                        </td>
                            <td>2018-01-31 09:38:27</td>
                            <td>大佬你提现了0.1,请等待审核,三天内到账</td>
                            <td style="width:200px">
                                                         <label class="txt-top"><a onclick="addTypeChange('<?php echo UOOT;?>admin.php/home/Capital/editwithdraw/25?p-1','750px','550px',{title:'结算操作',type:'top'})"><i class="edit2017"  title="修改凭证"></i></a></label>
                             
                            <label class="txt-top">
                            <a href="javascript:void(0);" onclick="Confirm('是否删除此新闻？该操作不可逆！','<?php echo UOOT;?>admin.php/home/Capital/delect/25?p-1')"><i class="delete2017"></i></a></label>
                            </td>
                        </tr>
                                             <tr>
                            <td>
                                <div class="checkbox  checkbox-info" >
                            <input id="C24" type="checkbox" name="check[]" value="24" class="check0">
                            <label for="C24">24</label>
                                </div>
                            </td>
                            <td>2</td>
                            <td><span style="color: red;">ks.kesion.com</span>--/--ks.zuojy.com</td>
                            <td style="width:200px">
                                                         <label class="txt-top"><a class="ok-icon ok-pe1" href="<?php echo UOOT;?>admin.php/home/Capital/unaudited/24?p-1" title="待结算"></a></label>
                                                        </td>
                            <td>2018-01-30 19:09:34</td>
                            <td>大佬你提现了11.5,请等待审核,三天内到账</td>
                            <td style="width:200px">
                                                         <label class="txt-top"><a onclick="addTypeChange('<?php echo UOOT;?>admin.php/home/Capital/editwithdraw/24?p-1','750px','550px',{title:'添加凭证',type:'top'})"><i class="show2017" title="添加凭证"></i></a></label>
                             
                            <label class="txt-top">
                            <a href="javascript:void(0);" onclick="Confirm('是否删除此新闻？该操作不可逆！','<?php echo UOOT;?>admin.php/home/Capital/delect/24?p-1')"><i class="delete2017"></i></a></label>
                            </td>
                        </tr>
                                          </tbody>
                    </table>
                     
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
                <div class="col-sm-7 "  style="margin-top:7px"><div class="page-box"><ul class="pagination-digg"><a href="/admin.php/home/Capital?p-1">首页</a>

<li class="previous-off">上一页</li>
<li class="active">1</li><li><a href="/admin.php/home/Capital?p-2">2</a></li><li><a href="/admin.php/home/Capital?p-3">3</a></li><li><a href="/admin.php/home/Capital?p-4">4</a></li><a href="/admin.php/home/Capital?p-2">下一页</a>

<a href="/admin.php/home/Capital?p-4">末页</a>

</ul><div class="page-left">总计 33 个记录分为 4 页, 当前第 1 页 ,每页 <input type="text" class="page-input" value="10" id="pageSize" size="3"> </div></div></div>
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


<!--<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="renderer" content="webkit">

    <link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
    <link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
    <script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
 
</head>
<body class="gray-bg">
<div class="wrapper  mt55 mb40">
    <div class="row">
        <div id="manage_top" class="menu_top_fixed height73 p15 " >
            <div class="ibox-title">
                <h3 class="fl mr15" >短信管理</h3>
<a  href="<?php echo M_URL('Users','addUsers','','',GP("usertype-$usertype")); ?>" class="btn btn-info btn-rounded btn-s-md " style="color:#676a6c;"> 添加</a>
                <div class="ibox-tools">
                    <a href="javascript:void(0)" onclick="history.go(0)" class="collapse-link mt0">
                        <i class="reflash"></i>
                    </a>
                </div>
               

            </div>
        </div>
        <div class="ibox-content">

                <div >
                    <div class="panel-heading">
                        资金明细记录管理
                    </div>
                 
                    <div class="p15 border2017 bg-white">
                      
                        <div class="pd-txt" >搜索记录：</div>
                        <div class="col-sm-3">
                            <input class="form-control" type="text" value="">
                        </div>
                        <div class="radio radio-info radio-inline">
                            <input type="radio" id="inlineRadio1" value="option1" name="radioInline" checked="">
                            <label for="inlineRadio1">所有 </label>
                        </div>
                        <div class="radio radio-info radio-inline">
                            <input type="radio" id="inlineRadio2" value="option1" name="radioInline" checked="">
                            <label for="inlineRadio2">成功 </label>
                        </div>
                        <div class="radio radio-info radio-inline">
                            <input type="radio" id="inlineRadio3" value="option1" name="radioInline" checked="">
                            <label for="inlineRadio3">失败 </label>
                        </div>
                        <button class="btn-primary btn-w-m btn">搜索</button>
                    </div>


                </div>

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>
                        <div class="checkbox checkbox-info">
                            <input id="checkbox4" type="checkbox">
                            <label for="checkbox4">

                            </label>
                        </div>
                    </th>
                    <th>用户名</th>
                    <th>消费时间</th>
                    <th>IP</th>
                    <th>收入（元）</th>
                    <th>支出（元）</th>
                    <th>摘要</th>
                    <th>支付方式</th>
                    <th>操作员</th>
                    <th>余额（元）</th>
                    <th>备注</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($pagelogs as $k=>$v){ ?>
                <tr>
                    <td>
                        <div class="checkbox checkbox-info">
                            <input id="checkbox<?php echo $v['id']; ?>" type="checkbox">
                            <label for="checkbox<?php echo $v['id']; ?>"></label>
                        </div>
                    </td>
                    <td><?php echo $v['username']; ?></td>
                    <td><?php echo KS_DATE($v['adddate']); ?></td>
                    <td><?php echo $v['userip']; ?></td>
                    <td><?php if($v['type']==0){echo $v['cmoney'];}else{echo '--';}; ?></td>
                    <td><?php if($v['type']==1){echo $v['cmoney'];}else{echo '--';}; ?></td>
                    <td style="color: <?php if($v['type']==0){echo 'red';}else{echo 'green';}; ?>"><?php if($v['type']==0){echo '收入';}else{echo '支出';}; ?></td>
                    <td><?php echo $v['paytype']; ?></td>
                    <td><?php if($v['type']==0){echo 'admin';}else{echo 'system';}; ?></td>
                    <td><span class="tips"><?php echo $v['balance']; ?></span></td>
                    <td><span class="tips"><?php echo $v['mark']; ?></span></td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
            <div class="row bg-waring" >
                <div class="col-sm-12">
                    <label class="control-label" style="padding-right:10px; float: left "> <strong>特别提醒:</strong></label>
                    <label class="col-sm-10 mb10 control-label">
                        如果明细记录太多，影响了系统性能，可以删除一定时间段前的记录以加快速度。
                    </label>
                </div>
                <div class="col-sm-12">


                    <label class="control-label " style="padding-right:10px; float: left;padding-top: 7px "> <strong>特别提醒:</strong></label>
                    <div class="col-sm-7">
                        <div class="radio radio-info radio-inline">
                            <input type="radio" id="r2" value="option1" name="radioInline"
                                   checked="">
                            <label for="r2">10天前 </label>
                        </div>
                        <div class="radio radio-info radio-inline">
                            <input type="radio" id="r3" value="option1" name="radioInline"
                                   checked="">
                            <label for="r3">1个月前 </label>
                        </div>
                        <div class="radio radio-info radio-inline">
                            <input type="radio" id="r4" value="option1" name="radioInline"
                                   checked="">
                            <label for="r4">2个月前 </label>
                        </div>
                        <div class="radio radio-info radio-inline">
                            <input type="radio" id="r5" value="option1" name="radioInline"
                                   checked="">
                            <label for="r5">3个月前 </label>
                        </div>
                        <div class="radio radio-info radio-inline">
                            <input type="radio" id="r6" value="option1" name="radioInline"
                                   checked="">
                            <label for="r6">6个月前 </label>
                        </div>
                        <div class="radio radio-info radio-inline">
                            <input type="radio" id="r7" value="option1" name="radioInline"
                                   checked="">
                            <label for="r7">1年前 </label>
                            <button class="btn-primary btn-w-m btn">执行删除</button>
                        </div>

                    </div>


                </div>

            </div>
            <div class="footer-page height60"> 
            <div class="col-sm-5">
            <div class="checkbox fl checkbox-info" style="margin-top:20px;margin-right:10px">
            <input id="checkboxAll" name="check1" type="checkbox" class="check-all check0">
            <label for="checkboxAll">
                全选
            </label>
           
        </div>
         <button class="btn mt10 btn-default" type="button"  >
            导出到Excel
           </button>
            </div>
             <?php echo $page->show(3); ?>
             
             </div>
          

        </div>
    </div>
</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
$(function(){
	loadScorllJs();
})
</script>
</body>
</html>-->