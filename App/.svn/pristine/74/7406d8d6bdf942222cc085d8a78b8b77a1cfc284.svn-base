<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="renderer" content="webkit">
	<title>kesion邮件明细</title>
	<meta name="Keywords" content="kesion邮件明细" />
	<meta name="Description" content="kesion邮件明细" />
	<link rel="shortcut icon" href="favicon.ico">
	<link href="<?php echo UOOT;?>Public//admin/css/html5.css" rel="stylesheet">
	<link href="<?php echo UOOT;?>Public//admin/css/general.css" rel="stylesheet">
	<link href="<?php echo UOOT;?>Public//app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public//admin/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/laydate.css" rel="stylesheet">
	<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
	<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
	<script type="text/javascript" src="<?php echo UOOT;?>Public/common/js/layer/laydate.js"></script>
	<style>
	.from-top input[type=radio] {position: relative;top: 4px;}
	</style>
</head>


<body  class="gray-bg">
	<div>
		<div class="row clearfix">
			<div id="manage_top" class="menu_top_fixed  p15 height73">
				<div class="ibox-title clearfix">
					<h3 class="fl">&nbsp;&nbsp;邮件明细</h3>
				<div class="fr">	<a class="ks-bt bt-def ml10" href="https://store.kesion.com/admin.php/home/App">返回</a></div>
					
					<div class="fr">
						<div class="fl ks-top-search">
							<form target="hidframe" >				
								<div class="ks-top-search" target="hidframe" action="<?php echo  M_URL($this->AppName.'/Index','index','',GP('')); ?>" method="post">
									<select  class="inputText bRadius5 fl" id="keytype" style="width: 150px;cursor: pointer;line-height:34px;text-align: center;" id="keytype" >
										<option  value="1" <?php if($keytype==1){echo 'selected="selected"';} ?>>按发送名</option>
										<option  value="2" <?php if($keytype==2){echo 'selected="selected"';} ?>>按接收邮箱</option>
										<option  value="3" <?php if($keytype==3){echo 'selected="selected"';} ?>>按网校ID</option>
									</select>
									<input type="text" class="sc-text" name="searchText" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>">
									<input type="submit" class="sc-button" name="searchBtn" value="搜索" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','index'); ?>','<?php echo URL_MODEL;?>')">
								</div>
							</form>
						</div>
					</div>
					<div class="fr from-top" style="width: 457px;">
						<form action="<?php echo  M_URL($this->AppName.'/Index','emailexcel','',GP('keyword-'.$keyword.',keytype-'.$keytype.',status-'.$status.',byname-'.$byname)); ?>" method="post">
							<label for="ratiotime" class="label-on">
								<input type="radio" id="ratiotime" name="outtime" value="2" onclick="$('#timebox').hide()"/>本月</span>
							</label>
							<label for="ratiotime" class="label-on">
								<input type="radio" id="ratiotime" name="outtime" value="3" onclick="$('#timebox').hide()"/>本年</label>
							<!--<label for="ratiotime" class="label-on">
								<input type="radio" id="ratiotime" name="anytime" value="6" />6个月前</label>
							<label for="ratiotime" class="label-on">
								<input type="radio" id="ratiotime" name="anytime" value="7" />一年前</label>-->
							<label for="ratiotime" class="label-on">
								<input type="radio" id="ratiotime" name="outtime" value="4" onclick="$('#timebox').show()"/>自定义
								<div style="display: none;" id="timebox">
									<input id="start" type="text" value="" name="startime" required readonly class="w300 laydate-icon">
										-
									<input id="end" type="text" value=""name="endtime" required readonly class="w300 laydate-icon">
								</div>
								</label>
								<label for="ratiotime" class="label-on">
								<input type="submit" class="btn  btn-default" name="outexcel" value="导出Excel" /></label>
						</form>
						 <form action="<?php echo  M_URL($this->AppName.'/Index','emailexcel','',GP('keyword-'.$keyword.',keytype-'.$keytype.',status-'.$status.',byname-'.$byname)); ?>" method="post">
							<input type="hidden" name="outtime"  value="1"   />
							<input type="submit" class="btn btn-default"  id="ratiotime" name="" value="导出本页" /></label>
						</form>  
					</div>
				</div>

			</div>
		</div>
		<div id="ksBoxContent" style="margin-top: 70px; ">
			<div class="H5-gameListConts"  style="background: #fff;">
				<div class="H5-gameListScreen">
					<ul class="H5-gameOpt clearfix">
						<!--<li style="margin-right: 15px;"><input  class="selectAll select-checks" name="check1" type="checkbox"></li>-->
						<!--<li>转换率<i class="iconfont icon-sort-double-down"></i></li>-->
						<li>
							<div class="shaixuan clearfix">
								<?php if($byname == 'desc'){?>
									<a class="desc" href="<?php echo M_URL($this->AppName.'/Index','index','',GP("byname-asc")); ?>"><i class="desc-i"></i>发送日期</a>		
								<?php }else{ ?>
									<a class="desc" href="<?php echo M_URL($this->AppName.'/Index','index','',GP("byname-desc")); ?>"><i class="asc-i"></i>发送日期</a>
								<?php }?>
							</div>
						</li>
						<li>
						</li>
						<li class="fr gameScreen" style="font-size: 16px;margin-right: 20px;">
							<i class="iconfont icon-filter-2" style="float: none;"></i>&nbsp;&nbsp;筛选

							<ul class="H5-gameScreen">
								<img src="//ks.kesion.com/Public/app/images/regup.png" alt="">
								<li>
									<span>发送状态：</span>
									<div>
										<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP('p-'.$page->now_page.',status-3'));?>" class='<?php if($status==3) echo " active" ;?>'>不限</a>
										<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP('p-'.$page->now_page.',status-1'));?>" class='<?php if($status==1) echo " active" ;?>'>成功</a>
										<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP('p-'.$page->now_page.',status-2'));?>" class='<?php if($status==2) echo " active" ;?>'>失败</a>
										<a href="<?php echo M_URL($this->AppName.'/Index','index','',GP('p-'.$page->now_page.',status-4'));?>" class='<?php if($status==4) echo " active" ;?>'>回收站</a>
									</div>
								</li>
							</ul>

						</li>
					</ul>
				</div>
				<div class="H5-gameListConts school-online">
				<form target="hidframe"  action="<?php echo M_URL($this->AppName.'/Index','delsome','',GP("p-$page->now_page"));  ?>" method="post" id="myform" >
					<div id="ksBoxContent">
				            <table width="100%" cellpadding="0" cellspacing="0" border="0" class="ks-table">
					            <thead>
						            <tr>
						            	<th class="form-in"><input type="checkbox" id="selectAll"></th>
						            	<th>发送名</th>
						                <th>接收者邮箱</th>
						                <th>内容</th>
						                <th>发送时间</th>
						                <th>状态</th> 
						                <th>操作</th>              
						            </tr>
					            </thead>
					            <tbody>
					            <?php foreach($values as $k=>$v){ ?> 
						            <tr>
						            	<td class="form-in"><input type="checkbox" class="select-check" name="id[]" value="<?php echo $v['id'] ?>"></td>
						            	<td><?php echo Field($v['username']);?></td>
						                <td><?php echo Field($v['email']);?></td>
						                <td class="form-con"><?php echo Field($v['content']);?></td>
						                <td><?php echo Field(date('Y-m-d H:i:s', $v['adddate']));?></td>
						                <td><?php if($v['issuccess'] == 1){echo '成功';}else{echo '失败';} ?></td>
						                <td>
								           <div class="operate">
									           <a href="javascript:void(0);" onclick="Confirm('是否删除此邮件？该操作不可逆!','<?php echo M_URL($this->AppName.'/Index','delone',$v['id'],GP('p-'.$page->now_page)); ?>')">
						<em>删除</em><i class="icon-shanchu1 iconfont"></i></a>
								           </div>
								       </td>
						            </tr>
					            <?php }?>
					            </tbody>
					        </table>
					        <?php echo NoC($values);?>
					    </div>
				
					  <div class="footer-page">
                        <div class="col-sm-5">
                        	 <button class="btn mt10 fl btn-default" type="submit" name="batch" value="1"><i class="iconfont icon-shanchu1"></i>批量删除</button>
                           	<form action="<?php echo M_URL($this->AppName.'/Index','delpath','',GP(""));  ?>" method="post" onsubmit="return submitdel(this);">
				  	<div class="fl">
				  		<!--<button class="btn mt10 btn-default" type="submit"><i class="iconfont icon-shanchu1"></i>执行删除</button>-->
			  			<label for="timeradio" class="label-on mt20"><input type="radio" id="timeradio" name="anytime" value="10"/>10天前</label>
			  			<label for="timeradio" class="label-on mt20"><input type="radio" id="timeradio" name="anytime" value="1"/>1个月前</span></label>
			  			<label for="timeradio" class="label-on mt20"><input type="radio" id="timeradio" name="anytime" value="3"/>3个月前</label>
			  			<label for="timeradio" class="label-on mt20"><input type="radio" id="timeradio" name="anytime" value="6"/>6个月前</label>
			  			<label for="timeradio" class="label-on mt20"><input type="radio" id="timeradio" name="anytime" value="12"/>一年前</label>
			  			
			  		</div>
			</form>
                        </div>
                          
                           <div class="fr mt10"><?php echo $page->show(3); ?></div> 
                        </div>
					
				</form>
		
				</div>
			</div>
		</div>




	</div>
	<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
	<script type="text/javascript">
		loadScorllJs();
	$('.titleTab li').click(function(){
		$(this).addClass('curr').siblings().removeClass('curr');
	})
		function Payswitch(paystyle) {
			var url = "<?php echo M_URL($this->AppName.'/Index','Payswitch','',GP('p-'.$page->now_page)); ?>";
			$.ajax({
				type: "post",
				url: url,
				data: {
					'paystyle': paystyle
				},
				success: function (data) {
					if (data == 'succeed') {
						location.reload();
					} else if (data == 'faild') {
						Alert('开启失败');
					}
				},
				error: function () {
					location.reload();
				}
			});
		}
	</script>
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




















