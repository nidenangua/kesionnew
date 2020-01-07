
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
       <h3 class="fl ">&nbsp;&nbsp;<span class="mr20">其他用户</span>
        	<a href="<?php echo M_URL('Setting','userIndex','',GP('usertype-1')); ?>" class="mr20">教师管理</a>
        	<a href="<?php echo M_URL('Setting','userIndex','',GP('usertype-2')); ?>" class="mr20">机构会员</a>
        	<a href="<?php echo M_URL('Setting','userIndex','',GP('usertype-3')); ?>" class="mr20 act" style="color: blue">学员管理</a>
        	&nbsp;&nbsp;&nbsp;&nbsp;学员人数&nbsp;&nbsp;<font class="defColor" size="5px"><?php echo $page->totalput; ?></font>
        	&nbsp;&nbsp;&nbsp;&nbsp;本年新增&nbsp;&nbsp;<font class="defColor" size="4px"><?php echo $yearCout; ?></font>
        	&nbsp;&nbsp;&nbsp;&nbsp;本月新增&nbsp;&nbsp;<font class="defColor" size="4px"><?php echo $mCout; ?></font>
        	&nbsp;&nbsp;&nbsp;&nbsp;本周新增&nbsp;&nbsp;<font class="defColor" size="4px"><?php echo $weekCount; ?></font>
        	&nbsp;&nbsp;&nbsp;&nbsp;今日新增&nbsp;&nbsp;<font class="defColor" size="4px"><?php echo $dayCout; ?></font>

            &nbsp;&nbsp;&nbsp;&nbsp;本周活跃&nbsp;&nbsp;<font class="defColor" size="4px"><?php echo $weekHYCount; ?></font>
            &nbsp;&nbsp;&nbsp;&nbsp;今日活跃&nbsp;&nbsp;<font class="defColor" size="4px"><?php echo $dayHYCout; ?></font>
        </h3>
        <div class="fr">
             <div class="fl ks-top-search">
			<!--搜索-->
			<select class="inputText bRadius5 fl" id="keytype" style="width: 150px;">
			    <option value="1" <?php if($keytype==1){echo 'selected="selected"';} ?>>用户账号</option>
              	<option value="2" <?php if($keytype==2){echo 'selected="selected"';} ?>>用户昵称</option>
                <option value="3" <?php if($keytype==3){echo 'selected="selected"';} ?>>用户邮箱</option>
                <option value="5" <?php if($keytype==5){echo 'selected="selected"';} ?>>用户ID</option>
              	<option value="4" <?php if($keytype==4){echo 'selected="selected"';} ?>>网校ID</option>
	  	    </select>
	
			<form target="hidframe" class="fr">
				<input type="text" class="sc-text" style="width: 200px;" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>">
            <input style="position: relative;" type="submit" class="sc-button" onclick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL('Setting','userIndex'); ?>','<?php echo URL_MODEL;?>')" name="searchBtn" value="搜索">
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
                <li class="fl hLh40 pl10 pr10 mr20 fsize18 <?php if($status==3) echo " curr" ;?>"><a href="<?php echo M_URL('Setting','userIndex','',GP('usertype-'.$usertype.',status-3',true)); ?>" >全部</a></li>
                <li class="fl hLh40 pl10 pr10 mr20 fsize18 <?php if($status==1) echo " curr" ;?>"><a href="<?php echo M_URL('Setting','userIndex','',GP('usertype-'.$usertype.',status-1',true)); ?>" >可使用</a></li>
                <li class="fl hLh40 pl10 pr10 mr20 fsize18 <?php if($status==0) echo " curr" ;?>"><a href="<?php echo M_URL('Setting','userIndex','',GP('usertype-'.$usertype.',status-0',true)); ?>">不可使用</a></li>
		</ul>	



</style>
 <form  id="myform" target="hidframe" action="<?php echo M_URL('Setting','userBatch','',GP('')); ?>" method="post">
	<div class="H5-gameListConts" style="background: #fff;padding: 13px;">
         <table class="ks-table" style="background: #fff;">
                    <thead style="background: #cccccc9c;">
                        <tr>
                            <th>选择</th>
                            <th >网校ID</th>                           
                            <th >用户ID</th>                           
                            <th >用户头像</th>                           
                            <th >用户名称</th>                           
                            <th >账号</th>                           
                            <th >联系电话</th>
                            <th>电子邮箱</th>
                            <th class="shaixuan"><?php if($adddate == 2){?>
                        <a class="desc" href="<?php echo M_URL('home/Users','index','',GP("adddate-1")); ?>"><i class="desc-i"></i>注册时间</a>     
                    <?php }else{ ?>
                        <a class="desc" href="<?php echo M_URL('home/Users','index','',GP("adddate-2")); ?>"><i class="asc-i"></i>注册时间</a>
                                
                    <?php }?></th>
                            <th class="shaixuan">
                                <?php if($money == 2){?>
                                    <a class="desc" href="<?php echo M_URL('home/Users','index','',GP("money-1")); ?>"><i class="desc-i"></i>账户余额</a>       
                                <?php }else{ ?>
                                    <a class="desc" href="<?php echo M_URL('home/Users','index','',GP("money-2")); ?>"><i class="asc-i"></i>账户余额</a>
                                            
                                <?php }?>
                            </th>
                            <th>学习课程总数</th>
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
                    		<td><img style="    width: 74px;" class="showImg" onerror="this.src='<?php echo nopic();?>'" src="<?php echo $this->upload->getHead($v['userid'],4,0);?>"></td>
                    		<td><?php echo Field($v['name']); ?><?php if($v['Sex'] == 2){ echo '<i class="iconfont icon-nan nv" style="color:pink;">';}else{echo '<i class="iconfont icon-nan nan" style="color:blue;">';  }?></i></td>
                    		<td><?php echo Field($v['username']); ?></td>
                    		<td><?php echo Field($v['mobile']); ?></td>
                    		<td><?php echo Field($v['email']); ?></td>
                    		<td><?php echo date('Y-m-d H:i:s',$v['regdate']); ?></td>
                    		<td><?php echo Field($v['money']); ?></td>
                    		<td><?php echo Field($v['sum']); ?></td>
                    		<td>
                    			<span class="link-switch<?php if($v['status'] ==1){ echo ' open'; } ?>" data-off="<?php echo M_URL('Setting','userUpdatestatus',$v['userid'],GP('')); ?>" data-open="<?php echo M_URL('Setting','userUpdatestatus',$v['userid'],GP('')); ?>"><i></i></span>
                    		</td>
                    		<td>
                    			 <span onclick="Confirm('是否删除？该操作不可逆!','<?php echo M_URL('Setting','userDelete',$v['userid'],GP('')); ?>')"><i class="iconfont icon-lajitong"></i></span>
                    		</td>
                    		<td class="ks-head-el">
                                <i onclick="choiceClick(this)" class="iconfont icon-more"></i>
                                <div class="ks-head-content ks-head-content-pc">
                                    <ul class="opeart">
                                        <li>
                                            <a href="<?php echo M_URL('Setting','userdetails',$v['userid'],GP('p-'.$page->now_page)); ?>">编辑</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo M_URL('Setting','userdetails',$v['userid'],GP('p-'.$page->now_page)); ?>">查看详情</a>
                                        </li>
                                    </ul>
                                </div>
                    			
                    		</td>
                    	</tr>
                    
                <?php }?>
                </tbody>
                </table>
		<?php echo Noc($UsersAll); ?>
		</div>
		<div style="height: 120px;"></div>
	<div>
	<div class="footer-page h60">
<div class="col-sm-5">
    <div class="checkbox fl checkbox-info" style="margin-top:20px;margin-right:10px">
        <input  class="selectAll select-checks" name="check1" type="checkbox" id="sAll">
        <label for="sAll">全选 </label>
     </div>
    <button class="btn mt10 btn-default" type="submit"  name="batch" value="0">锁定</button>
    <button class="btn mt10 btn-default" type="submit"  name="batch" value="1">解锁</button>
    <button class="btn mt10 btn-default" type="submit"  name="batch" value="2">批量审核</button>
    <button class="btn mt10 btn-default" type="submit"  name="batch" value="3">取消审核</button>
    <button class="btn mt10 btn-default" type="submit" name="batch" value="4">删除</button>
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




<!--<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>科汛在线教育</title>
    <link rel="shortcut icon" href="favicon.ico">
    <link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
    <link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
    <script src="<?php echo UOOT;?>Public/common/js/jquery.min.js"></script>
 
</head>
<body class="gray-bg">
<div class="wrapper mt55 ">
    <div class="row">
        <div id="manage_top " class="menu_top_fixed p15 height73 " >
        <div class="ibox-title">
            <h3 class="fl" >学员管理</h3>
             <a  href="<?php echo M_URL('Setting','addUsers','','',GP("usertype-$usertype")); ?>" class="btn btn btn-info btn-rounded btn-s-md  ml15" style="color:#676a6c;margin-left:20px">添加</a>
            <div class="ibox-tools">
                <a href="javascript:void(0)" onclick="history.go(0)" class="collapse-link mt0"><i class="reflash"></i></a>
            </div>
            <div class="search-main fr">
               <div class="search-box w150 fl">
                    <label class="fl control-label" >类别</label>
                    <select class="form-control  input-sm w90  inline"id="keytype"><option></option></select>
               </div>
               <div class="search-box w240 mt7 fl" >
                  <div class="input-group">
                  <input type="text" class=" form-control input-sm w180 fl" value="<?php if(isset($keyword)) echo $keyword; ?>">
                  <span class="input-group-btn ">
                    <button class="btn btn-sm btn-default  fl" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL('Setting','UserIndex','index'); ?>','<?php echo URL_MODEL;?>')" type="button">Go!</button>
                  </span>
                  </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    <div class="row"><br /><br />
        <div class="col-sm-12">
            <div class="tabs-container">
            <ul class="nav-tabs nav">
                <li <?php if($status==3)echo "class='active'";?>>
                <a href="<?php echo M_URL('Setting','UserIndex','',GP('usertype-'.$usertype.',status-3',true)); ?>"> 所有</a>
                </li>
                <li <?php if($status==1)echo "class='active'";?>>
                <a href="<?php echo M_URL('Setting','UserIndex','',GP('usertype-'.$usertype.',status-1',true)); ?>">正常</a>
                </li>
                <li <?php if($status==0)echo "class='active'";?>>
                <a href="<?php echo M_URL('Setting','UserIndex','',GP('usertype-'.$usertype.',status-0',true)); ?>">待审</a>
                </li>
                <li <?php if($status==2)echo "class='active'";?>>
                <a href="<?php echo M_URL('Setting','UserIndex','',GP('usertype-'.$usertype.',status-2',true)); ?>">锁定</a>
                </li>
           </ul>
<form target="hidframe"  action="<?php echo M_URL('Setting','UserBatch','',GP('p-'.$page->now_page)) ?>" method="post">
<div class="tab-content">
    <div id="tab-1" class="tab-pane active">
        <div class="panel-body" style="padding:0">
            <div class="row">
                <div class="col-sm-12 ">
                    <div class="ibox float-e-margins pt15">
                        <div class="ibox-content">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>昵称</th>
                                    <th>用户名</th>
                                    <th>联系电话</th>
                                    <th>注册时间</th>
                                    <th>学习课程总数</th>
                                    <th>最近登录IP</th>
                                    <th>状态</th>
                                    <th>修改</th>
                                    <th>删除</th>
                                </tr>
                                </thead>
                        
                                <?php  foreach($UsersAll as $k=>$v){ ?>
                                <tr class="gradeX">
                                    <td> 
                                    <div class="checkbox  checkbox-info" >
                                        <input id="C<?php  echo $v['userid']; ?>" type="checkbox" name="id[]" value="<?php  echo $v['userid']; ?>" class="check0">
                                        <label for="C<?php  echo $v['userid']; ?>"><?php  echo $v['userid']; ?></label>
                                    </div>
                                    </td>
                                    <td><?php  echo Field($v['name']); ?></td>
                                    <td><?php  echo Field($v['username']); ?></td>
                                    <td><?php  echo Field($v['mobile']); ?></td>
                                    <td><?php  echo Field(KS_DATE($v['regdate'])); ?></td>
                                    <td><?php  echo Field($v['userid']); ?></td>
                                    <td><?php  echo Field($v['lastloginip']); ?></td>
                                    <td class="center"><?php if($v['status']==0){echo '<i class="ok-icon ok-pe1 ok-pe2"></i>';}elseif($v['status']==1){echo '<i class="ok-pe1 ok-icon"></i>';}elseif($v['status']==2){echo '<i class="ok-pe2 ok-icon"></i>';} ?></td>
                                    <td class="center"><a href="<?php echo M_URL('Setting','editUsers',$v['userid'],GP('p-'.$page->now_page)); ?>"><i class="edit2017"></i></a></td>
                                    <td class='center'><a href="javascript:void(0);" onclick="Confirm('确定删除？,该操作不可逆','<?php echo M_URL('Setting','deleteUsers',$v['userid'],GP('p-'.$page->now_page)); ?>');"><i class="delete2017"></i></a></td>
                                </tr>
                                <?php } ?>
                                </tbody></table>
                           <?php echo NoC($UsersAll);?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-page"><?php echo $page->show(3); ?></div>
    </div>
    <div id="tab-2" class="tab-pane">
        <div class="panel-body"></div>
    </div>
</div>
<div class="footer-page h60">
    <div class="col-sm-5">
     <div class="checkbox fl checkbox-info" style="margin-top:20px;margin-right:10px">
        <input id="checkboxAll" name="check1" type="checkbox" class="check-all check0">
        <label for="checkboxAll">全选</label>
     </div>
        <button class="btn mt10 btn-default" type="submit" name="batch" value="0">锁定</button>
        <button class="btn mt10 btn-default" type="submit" name="batch" value="1">解锁</button>
        <button class="btn mt10 btn-default" type="submit" name="batch" value="2">批量审核</button>
        <button class="btn mt10 btn-default" type="submit" name="batch" value="3">取消审核</button>
        <button class="btn mt10 btn-default" type="submit" name="batch" value="4">删除</button>
    </div>
    <div class="col-sm-7" style="margin-top:7px"><?php echo $page->show(3); ?></div>
</div>
</form>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
loadScorllJs();
var selectInputs = $('.check0');
var checkAllInputs = $('.check-all')
selectall(selectInputs,checkAllInputs)
$().ready(function(){
    $(" #choice1 button").click(function(){

        $(this).toggleClass("btn-primary");
    });
});
function attributeSelect(url){
    window.location.href=''+url;
}
</script>
</body>
</html>-->