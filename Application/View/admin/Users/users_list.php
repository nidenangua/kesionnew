<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<link rel="shortcut icon" href="favicon.ico">
<link href="<?php echo UOOT;?>Public/admin/fonts/iconfont.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
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
	.shaixuan .asc-i { top: 3px;}
	.shaixuan .desc-i { top: 3px;}
	.act{
		color: blue!important;
	}
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
    color: white;
    border-radius: 10px;
}
</style>
<body class="gray-bg">
<div class="wrapper" style="margin-top:35px">
<div class="row">
<div id="manage_top" class="menu_top_fixed  p15 height73" >
    <div class="ibox-title clearfix"> 
        <h3 class="fl ">&nbsp;&nbsp;<span class="mr20">其他用户</span>
        	<!--<?php if($usertype==1){echo '教师管理';}else{echo '机构会员';}; ?> -->
        		
        	<a href="<?php echo M_URL('Users','','',GP('usertype-1')); ?>" class="mr20 <?php if($usertype==1){echo 'act';}?>">教师管理</a> 
        	<a href="<?php echo M_URL('Users','','',GP('usertype-2')); ?>" class="mr20 <?php if($usertype!=1){echo 'act';}?>">机构会员</a>  
        	<a href="<?php echo M_URL('Users','','',GP('usertype-3')); ?>" class="mr20">学员管理</a> 
        	<a href="javascript:;"><?php if($usertype==1){echo '教师个数&nbsp;&nbsp;<font class="defColor" size="5px">'.$options['totalput'].'</font>';}else{echo '机构个数&nbsp;&nbsp;<font class="defColor" size="5px">'.$options['totalput'].'</font>';}; ?></a>
        	&nbsp;&nbsp;&nbsp;&nbsp;本年新增&nbsp;&nbsp;<font class="defColor" size="4px"><?php echo $yearCout; ?></font>
        	&nbsp;&nbsp;&nbsp;&nbsp;本月新增&nbsp;&nbsp;<font class="defColor" size="4px"><?php echo $mCout; ?></font>
        	&nbsp;&nbsp;&nbsp;&nbsp;本周新增&nbsp;&nbsp;<font class="defColor" size="4px"><?php echo $weekCount; ?></font>
        	&nbsp;&nbsp;&nbsp;&nbsp;今日新增&nbsp;&nbsp;<font class="defColor" size="4px"><?php echo $dayCout; ?></font>

        	&nbsp;&nbsp;&nbsp;&nbsp;本周活跃&nbsp;&nbsp;<font class="defColor" size="4px"><?php echo $weekHYCount; ?></font>
            &nbsp;&nbsp;&nbsp;&nbsp;今日活跃&nbsp;&nbsp;<font class="defColor" size="4px"><?php echo $dayHYCout; ?></font>
        	
        </h3>
        <!-- <a class="btn btn-tool btn-rounded btn-s-md fl" href="<?php echo M_URL('Users','addUsers','',GP('')); ?>" style="margin-left:15px">添加会员</a> -->
        <div class="fr">
             <div class="fl ks-top-search">
			<!--搜索-->
			
					
			<select class="inputText bRadius5 fl" id="keytype" style="width: 150px;">
                <option value="1" <?php if($keytype==1){echo 'selected="selected"';} ?>>用户账号</option>
			   
              	<option value="2" <?php if($keytype==2){echo 'selected="selected"';} ?>><?php if($usertype==1){echo '教师名称';}elseif($usertype==2){echo '机构名称';} ?></option>
              	<option value="3" <?php if($keytype==3){echo 'selected="selected"';} ?>><?php if($usertype==1){echo '教师邮箱';}elseif($usertype==2){echo '机构邮箱';} ?></option>
                 <option value="4" <?php if($keytype==4){echo 'selected="selected"';} ?>>网校ID</option>
                 <option value="5" <?php if($keytype==5){echo 'selected="selected"';} ?>>用户ID</option>
	  	    </select>
			
			<form target="hidframe" class="fr">
				<input type="text" class="sc-text"style="width: 200px;" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>">
            <input type="submit" class="sc-button" onclick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL('Users','index'); ?>','<?php echo URL_MODEL;?>')" name="searchBtn" value="搜索">
			</form>
						
			<!--搜索-->
			</div> 
              
              
        </div>
    </div>
</div>


</div>

<div>
	<div style="margin-top:10px;">
		
	<div class="H5-gameListScreen" style="height: 45px;">
		<ul class=" nav nav-tabs">
			<!-- <li><input class="selectAll select-checks" name="check1" type="checkbox"></li> -->
			<!--<li>转换率<i class="iconfont icon-sort-double-down"></i></li>-->
                <li class="fl hLh40 pl10 pr10 mr20 fsize18 <?php if($status==3) echo " curr" ;?>"><a href="<?php echo M_URL('Users','index','',GP('usertype-'.$usertype.',status-3',true)); ?>" >全部</a></li>
                <li class="fl hLh40 pl10 pr10 mr20 fsize18 <?php if($status==1) echo " curr" ;?>"><a href="<?php echo M_URL('Users','index','',GP('usertype-'.$usertype.',status-1',true)); ?>" >可使用</a></li>
                <li class="fl hLh40 pl10 pr10 mr20 fsize18 <?php if($status==0) echo " curr" ;?>"><a href="<?php echo M_URL('Users','index','',GP('usertype-'.$usertype.',status-0',true)); ?>">不可使用</a></li>			
		</ul>
	</div>
 <form  id="myform" target="hidframe" action="<?php echo M_URL('Users','batch','',GP('')); ?>" method="post">
	<div class="H5-gameListConts" style="background: #fff;padding: 13px;">
	   <table class="ks-table" style="background: #fff;">
                    <thead style="background: #cccccc9c;">
                        <tr>
                            <th>选择</th>
                            <th >网校ID</th>                           
                            <th >用户ID</th>                           
                            <th >用户头像</th>                           
                            <th ><?php if($usertype==1){echo '教师名称';}elseif($usertype==2){echo '机构名称';} ?></th>                           
                            <th >账号</th>   
                            <?php if($usertype==1){?>
                               <th>教学等级</th>
							<?php } ?>                         
                            <th >联系电话</th>
                            <th>电子邮箱</th>
                             <th class="shaixuan">
                                <?php if($money == 2){?>
                                    <a class="desc" href="<?php echo M_URL('home/Users','index','',GP("money-1")); ?>"><i class="desc-i"></i>账户余额</a>       
                                <?php }else{ ?>
                                    <a class="desc" href="<?php echo M_URL('home/Users','index','',GP("money-2")); ?>"><i class="asc-i"></i>账户余额</a>
                                            
                                <?php }?>
                            </th>
                            <th class="shaixuan"><?php if($adddate == 2){?>
                        <a class="desc" href="<?php echo M_URL('home/Users','index','',GP("adddate-1")); ?>"><i class="desc-i"></i>注册时间</a>     
                    <?php }else{ ?>
                        <a class="desc" href="<?php echo M_URL('home/Users','index','',GP("adddate-2")); ?>"><i class="asc-i"></i>注册时间</a>
                                
                    <?php }?></th>
                           
                            <!-- <th></th> -->
                            <th>状态</th>
                            <th>删除</th>
                            <th>操作</th>
                        </tr>
                    </thead>

                    <tbody>
                    	<?php foreach($UsersAll as $k=>$v){ ?>
                    	<tr>
                    		<td><input type="checkbox" class="select-checks " name="id[]" value="<?php echo $v['userid']; ?>"></td>
                    		<td><?php echo $v['wxid']; ?></td>
                    		<td><?php echo $v['userid']; ?></td>
                    		<td>
                            <img style="    width: 74px;" class="showImg" onerror="this.src='<?php echo nopic();?>'" src="<?php echo $this->upload->getHead($v['userid'],6,$usertype);?>"></td>
                    		<td><?php echo Field($v['name']); ?><?php if($usertype==1){if($v['Sex'] == 2){ echo '<i class="iconfont icon-nan nv" style="color:pink;">';}else{echo '<i class="iconfont icon-nan nan" style="color:blue;">';  }}?></i></td>
                    		<td><?php echo Field($v['username']); ?></td>
                    		<?php if($usertype==1){?>
                               <td><?php echo  Field($v['teacherzc']);?></td>
							<?php } ?>   
                    		<td><?php echo Field($v['mobile']); ?></td>
                    		<td><?php echo Field($v['email']); ?></td>
                    		<td><?php echo $v['money'];?></td>
                    		<td><?php echo date('Y-m-d H:i:s',$v['regdate']);?></td>
                    		<!-- <td><?php echo Field($v['sum']); ?></td> -->
                    		<td>
                    			<span class="link-switch<?php if($v['status'] ==1){ echo ' open'; } ?>" data-off="<?php echo M_URL('Users','updatestatus',$v['userid'],GP('')); ?>" data-open="<?php echo M_URL('Users','updatestatus',$v['userid'],GP('')); ?>"><i></i></span>
                    		</td>
                    		<td>
                    			 <span onclick="Confirm('是否删除？该操作不可逆!','<?php echo M_URL('Users','deleteUsers',$v['userid'],GP('p-'.$page->now_page)); ?>')"><i class="iconfont icon-lajitong"></i></span>
                    		</td>
                    		<td class="ks-head-el">
                                <i onclick="choiceClick(this)" class="iconfont icon-more"></i>
                                <div class="ks-head-content ks-head-content-pc">
                                    <ul class="opeart">
                                        <li>
                                            <a href="<?php echo M_URL('Users','editUsers',$v['userid'],GP('p-'.$page->now_page)); ?>">编辑</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo M_URL('Users','userdetails',$v['userid'],GP('p-'.$page->now_page)); ?>">查看详情</a>
                                        </li>
                                    </ul>
                                </div>
                    			
                    		</td>
                    	</tr>
                   
                <?php }?>
                 </tbody>
            </table>
		<?php echo Noc($UsersAll); ?>
		</br>
	
		</div>
	<div>
		 <div class="footer-page h60">
    <div class="col-sm-5">
        <div class="checkbox fl checkbox-info" style="margin-top:20px;margin-right:10px">
            <input  class="selectAll select-checks" name="check1" type="checkbox" id="sAll">
            <label for="sAll">全选 </label>
         </div>
    </div>
    <?php echo $page->show(3); ?>

 </div>
		
		
	</div>
	</div>


</div>



</body>

</html>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
    </div>
    <div class="footer-page h60">
    <div class="col-sm-5">
        <div class="checkbox fl checkbox-info" style="margin-top:20px;margin-right:10px">
            <input class="selectAll select-checks" name="check1" type="checkbox">
            <label for="checkboxAll">全选</label>
         </div>
        <button class="btn mt10 btn-default" type="submit"  name="batch" value="0">锁定</button>
        <button class="btn mt10 btn-default" type="submit"  name="batch" value="1">解锁</button>
        <button class="btn mt10 btn-default" type="submit"  name="batch" value="2">批量审核</button>
        <button class="btn mt10 btn-default" type="submit"  name="batch" value="3">取消审核</button>
        <button class="btn mt10 btn-default" type="submit" name="batch" value="4">删除</button>
    </div>
    <?php echo $page->show(3); ?>
    </div>
    </form>
</div>
<script src="<?php echo UOOT;?>Public/common/js/nicescroll.js"></script>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script src="<?php echo UOOT;?>Public/common/js/backstage.js"></script>
<script type="text/javascript">
	$('.link-switch').each(function(){
        setLinkSwitch(this)
    })
</script>
<script>
loadScorllJs();
remind();
var selectInputs = $('.check0'); // 所有勾选框
var checkAllInputs = $('.check-all') // 全选框
selectall(selectInputs,checkAllInputs);
function des(obj,ID){
	$(obj).addClass('active').siblings().removeClass('active');
	$('.tabpane'+ID+':eq('+$(obj).index()+')').show().siblings().hide();
}
</script>
<script>
function getHide(ID)
{
	//var url = '/Plus/Kesion.ajax.php?act=getHide';
	var url = "<?php echo M_URL('Ajax','getHide');?>";
	if($('#User_'+ID).attr('data')=="0")
	{
		$.ajax({
				type:"post",
				url:url,
				data:{
					'userid':ID,
					'usertype':'<?php echo $usertype; ?>'
				},
				dataType:"json",
				success:function(data){
					$("#User_"+ID).after(data);
					$('#User_'+ID).attr('data','1')
				}
			 });
	}else if($('#User_'+ID).attr('data')=="1"){
		  $("#Hide_"+ID).hide();
		  $('#User_'+ID).attr('data','2')
	}else if($('#User_'+ID).attr('data')=="2"){
		  $("#Hide_"+ID).show();
		  $('#User_'+ID).attr('data','1')
	}
}
function do_reg()
    {
	   $("#myform").submit();	
    }
</script>
</body>
</html>