<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
</head>
<style type="text/css">
	.deepRed{ color: red; cursor:pointer; }
	.deepRed:hover{ color: red; cursor:pointer; }
	.ks-operaRight{position: absolute; right: 20px; top:30px;}
	.ks-operaRight li { float: right; margin-left:0px; padding: 2px; }
	.H5-gameList>li {position: relative;padding-bottom:30px;}
	.ring{position: absolute;right: 20px;top: 15px;width:200px;height: 40px;text-align: right;line-height: 40px;}
	.H5-gameOpt>li { float: left; line-height: inherit; margin-right: 20px; font-size: 14px; }
	.shaixuan .asc-i { top: 3px;}
	.shaixuan .desc-i { top: 3px;}
</style>
<body class="gray-bg">
<div class="wrapper" style="margin-top:35px">
<div class="row">
<div id="manage_top" class="menu_top_fixed  p15 height73" >
    <div class="ibox-title">
        <h3 class="fl">&nbsp;&nbsp;管理员管理
        	
        </h3>
        <div class="fl"><a href="<?php echo M_URL('Admin','manage'); ?>" class="btn btn-tool btn-rounded btn-s-md  ml15">添加</a></div>
        <div class="fl"><a href="<?php echo M_URL('Admin','AdminLevelList'); ?>" class="btn btn-tool btn-rounded btn-s-md  ml15">权限等级管理</a></div>
        <div class="fr">
             <div class="fl ks-top-search">
       
			<!--搜索-->
			<form class="fr" action="<?php echo(M_URL('Admin'))?>" method="post">
					<select class="inputText bRadius5 fl" id="keytype" name="keytype" style="width: 150px;">
						 <option value="1" selected>管理员名称</option>
	  				</select>
				<input type="text" class="sc-text" name="keyword" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>">
            <input type="submit" class="sc-button"  name="searchBtn" value="搜索">
			</form>
			<!--搜索-->
			</div> 
        </div>
    </div>
</div>
</div>
<div id="ksBoxContent">
 <form target="hidframe"  action="<?php echo M_URL('Admin','deleteAdmin','',GP('p-'.$page->now_page)) ?>" method="post">
	<div style="margin-top: 15px;">
	<div class="H5-gameListScreen">
		<ul class="H5-gameOpt clearfix" style="padding-left: 10px;height: 35px;">
			<li style="margin-right: 15px;"><input type="checkbox"class="selectAll select-checks" id="selectAll"></li>
			<!--<li>转换率<i class="iconfont icon-sort-double-down"></i></li>-->
			<li style="margin-right: 10px;">
				<div class="shaixuan clearfix">
					<?php if($adddate == 2){?>
						<a class="desc" href="<?php echo M_URL('Admin','','',GP("adddate-1")); ?>"><i class="desc-i"></i>登录时间</a>		
					<?php }else{ ?>
						<a class="desc" href="<?php echo M_URL('Admin','','',GP("adddate-2")); ?>"><i class="asc-i"></i>登录时间</a>
								
					<?php }?>
				</div> 
			</li>
			<li style="margin-right: 10px;">
				<div class="shaixuan clearfix">
					<?php if($adddate == 2){?>
						<a class="desc" href="<?php echo M_URL('Admin','','',GP("adddate-1")); ?>"><i class="desc-i"></i>添加时间</a>		
					<?php }else{ ?>
						<a class="desc" href="<?php echo M_URL('Admin','','',GP("adddate-2")); ?>"><i class="asc-i"></i>添加时间</a>
								
					<?php }?>
				</div> 
			</li>			
			<li></li>
		</ul>	
	</div>
	<div class="H5-gameListConts">
        <table class="ks-table" style="background: #fff;">
            <thead style="background: #cccccc9c;">
                <tr>
                    <th>选择</th>
                    <th >ID</th>  
                    <th>头像</th>                         
                    <th >账号</th>                           
                    <th >真实姓名</th>
                    <th>联系方式</th>
                    <th>最近登录IP</th>
                    <th>最后一次登录时间</th>
                    <th>操作</th>
                </tr>
            </thead>

            <tbody>
                <?php  foreach($pageadmins as $k=>$v){ ?>
                    <tr>
                        <td>
                            <?php if($v['isdel'] == 0){ ?>
                            <input type="checkbox" class="select-checks" name="id[]" value="<?php  echo $v['adminid']; ?>" class="check0"/>
                            <?php }?>
                       </td>

                        <td><?php echo $v['adminid']?></td>
                        <td><img class="con-img"  src="<?php echo $v['defaultpic'] ?>"></td>
                        <td>
                            <?php  echo $v['username']; ?>&nbsp;&nbsp; • <span class="orange"><?php  if($v['admintype']==1){echo "<a class='red'>".$v['adminname']."</a>";}else{echo $v['adminname'];} ?></span>
                        </td>
                        <td><?php echo $v['realname']?></td>
                        <td><?php echo $v['mobile']?></td>
                        <td><?php  if(null!=$v['lastloginip']){echo $v['lastloginip'];} else{echo  "等待连接";}?></td>
                        <td>
                            <span class="deepBlue"><?php if($v['lastlogintime']!=0) {echo KS_DATE($v['lastlogintime']);}else{echo "尚未登录过";} ?></span>
                        </td>
                        <td>
                            <?php if($v['isdel'] == 0){ ?>
                                <a onclick="Confirm('确定删除？,该操作不可逆','<?php echo M_URL('Admin','deleteAdmin',$v['adminid'],GP('p-'.$page->now_page)); ?>');" style="float: left;">
                                    <i class="iconfont icon-lajitong"></i>
                                    <p class="class-name" >删除</p>
                                </a>
                                <?php }?>
                                <a href="<?php echo M_URL('Admin','manage',$v['adminid'],GP('p-'.$page->now_page)); ?>">
                                    <i class="iconfont icon-bianji"></i>
                                    <p class="class-name" >编辑</p>
                                </a>
                        </td>
                    </tr>
                <?php }?>
            </tbody>
        </table>
				 	<?php echo Noc($pageadmins); ?>
		<!-- </ul> -->
		<div style="height: 140px;"></div>		
		</div>
	<div>
	</div>
	</div>
</div>
<div class="footer-page h60">
	    <div class="col-sm-5">
	    <div class="checkbox fl checkbox-info" style="margin-top:20px;margin-right:10px">
	            <input id="checkboxAll" name="check1" type="checkbox" class="selectAll select-checks">
	            <label for="checkboxAll">全选 </label>
	    </div>
	        <button class="btn mt10 btn-default" type="submit" name="batch" value="4">批量删除</button>
	    </div>
	    <div class="col-sm-7 " style="margin-top:7px">
	      <?php echo $page->show(3); ?>
	    </div>
</div>
</body>
</html>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>

<!--<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>科汛在线教育</title>
    <link rel="shortcut icon" href="favicon.ico">
    <link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
    <link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
    <script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
 
</head>
<body class="gray-bg">
<div class="wrapper mt55 ">
    <div class="row">
        <div id="manage_top " class="menu_top_fixed p15 height73 " >
            <div class="ibox-title">
                <h3 class="fl" >管理员管理</h3>
                 <a  href="<?php echo M_URL('Admin','addAdmin'); ?>" class="btn btn btn-info btn-rounded btn-s-md  ml15" style="color:#676a6c;margin-left:20px">添加</a>
                <div class="ibox-tools">
                    <a href="javascript:void(0)" onclick="history.go(0)" class="collapse-link mt0">
                        <i class="reflash"></i>
                    </a>
                </div>
               <div class="search-main fr">

                            <div class="search-box w150 fl">
                                <label class="fl control-label" >
                                    类别
                                </label>
                                <select class="form-control  input-sm w90  inline"id="keytype">
                                    <option>

                                    </option>
                                </select>

                            </div>
                            <div class="search-box w240 mt7 fl" >
                                <div class="input-group">
                                    <input type="text" class=" form-control input-sm w180 fl" value="<?php if(isset($keyword)) echo $keyword; ?>">
                      <span class="input-group-btn ">
                        <button class="btn btn-sm btn-default  fl" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL('Users','index','index'); ?>','<?php echo URL_MODEL;?>')" type="button">Go!</button>
                      </span>
                                </div>
                            </div>
                        </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="tabs-container">
         
                <form target="hidframe"  action="<?php echo M_URL('Admin','batch','',GP('p-'.$page->now_page)) ?>" method="post">



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
                                                        <th>选择</th>
                                                        <th>管理员名称</th>
                                                        <th>管理员类型</th>
                                                        <th>真实姓名</th>
                                                        <th>联系方式</th>
                                                        <th>最后登录时间</th>
                                                        <th>最近登录IP</th>
                                                        <th>登录次数</th>
                                                        <th>修改</th>
                                                        <th>删除</th>
                                                    </tr>
                                                    </thead>
                                            
                                                    <?php  foreach($pageadmins as $k=>$v){ ?>
                                                    <tr class="gradeX">
                                                        <td> 
                                                        <div class="checkbox  checkbox-info" >
                                                            <input id="C<?php  echo $v['adminid']; ?>" type="checkbox" name="check[]" value="<?php  echo $v['adminid']; ?>" class="check0">
                                                            <label for="C<?php  echo $v['adminid']; ?>">
                                                           <?php  echo $v['adminid']; ?>
                                                            </label>
                                                        </div>
                                                        </td>
                                                        <td><?php  echo $v['username']; ?></td>
                                                        <td ><?php  if($v['admintype']==1){echo "<p class='red'>超级管理员</p>";}else{echo '普通管理员';} ?></td>
                                                        <td><?php echo $v['realname']?></td>
                                                        <td><?php echo $v['mobile']?></td>
                                                        <td><?php if($v['lastlogintime']!=0) {echo KS_DATE($v['lastlogintime']);}else{echo "尚未登录过";} ?></td>
                                                        <td><?php  if(null!=$v['lastloginip']){echo $v['lastloginip'];} else{echo  "等待连接";}?></td>
                                                        <td><?php  echo $v['logintimes']  ?></td>
                                                        <td class="center"><a href="<?php echo M_URL('Admin','editAdmin',$v['adminid'],GP('p-'.$page->now_page)); ?>"><i class="edit2017"></i></a></td>
                                                         <td class='center'><a href="javascript:void(0);" onclick="Confirm('确定删除？,该操作不可逆','<?php echo M_URL('admin','deleteAdmin',$v['adminid'],GP('p-'.$page->now_page)); ?>');"><i class="delete2017"></i></a></td>	
                                                    </tr>
                                                    <?php } ?>
                                                    </tbody></table>

                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <div class="footer-page">
                                <?php echo $page->show(3); ?>
                            </div>
                        </div>
                        <div id="tab-2" class="tab-pane">
                            <div class="panel-body">
                            </div>
                        </div>
                    </div>
                    <div class="footer-page h60">
                        <div class="col-sm-5">
                         <div class="checkbox fl checkbox-info" style="margin-top:20px;margin-right:10px">
                                <input id="checkboxAll" name="check1" type="checkbox" class="check-all check0">
                                <label for="checkboxAll">
                                    全选
                                </label>
                            </div>
                         
                            <button class="btn mt10 btn-default" type="submit" name="batch" value="4">
                                批量删除
                            </button>
                        </div>

                        <div class="col-sm-7 "  style="margin-top:7px">
                            <?php echo $page->show(3); ?>
                        </div>


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
    function attributeSelect(url)
    {
        window.location.href=''+url;
    }
</script>
</body>
</html>-->