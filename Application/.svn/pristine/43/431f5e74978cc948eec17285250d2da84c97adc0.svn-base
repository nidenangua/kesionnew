<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title><?php if(!isset($users)){echo '添加分类';}else{echo '修改分类';} ?></title>
<link href="<?php echo UOOT;?>Public/admin/css/html5.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/page.animate.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<body class="gray-bg"> 

<div id="manage_top" class="menu_top_fixed  p15 height73" >
    <div class="ibox-title">
        <h3 class="fl">&nbsp;&nbsp;<?php if(!isset($app)){echo '添加应用分类';}else{echo '修改应用分类';} ?></h3>
        <div class="fr">
             <div class="fl ks-top-search">
			<!--搜索-->
            <button  class="bt-back  fr" type="button" onclick="history.back()">
            	<i class="iconfont icon-fanhui"></i>返回
            </button> 
			<!--搜索--> 
			</div> 
        </div>
    </div>
</div>

<br /><br />
<br /><br />
    <div class="row bg-white p15"  style="border-radius: 10px;">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <form target="hidframe"  action="<?php if(!isset($category)){echo M_URL('UsersCategory','doaddCategory');}else{echo M_URL('UsersCategory','doeditCategory',$category['categoryid'],GP('p-'.$now_page));} ?>" method="post" class="form-horizontal">
                    <?php if(isset($category)){echo "<input type='hidden' name='categoryid' value='$category[categoryid]' />";} ?>
                    
                        <div class="form-group">
                            <label class="col-sm-2 control-label">所属分类</label>

                            <div class="col-sm-4">
                                <select name="parentid" <?php if(isset($category)){echo 'disabled'; } ?> class="form-control">
                                    <?php 
									$html = '<option value="0">无--作为一级栏目</option>';
									foreach($userscategory as $k=>$v)
									{
										
										if(!isset($category))
										{
											 $html .= '<option value="'.$v['categoryid'].'">'.KS_INDENT($v['depth']).$v['categoryname'].'</option>';
										}else{
											
											 $html .= '<option value="'.$v['categoryid'].'"';
											 if($category['parentid']==$v['categoryid'])
											 {
												 $html .= 'selected="selected"';
												 }
											 $html .= ' >'.KS_INDENT($v['depth']).$v['categoryname'].'</option>';
										}
									}
									echo $html;	
                                   ?>
                                </select>
                            </div>
                     
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">分类名称</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control"  name="categoryname" <?php if(isset($category))echo "value='$category[categoryname]'";  ?>>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">英文名</label>

                            <div class="col-sm-4">
                                <input type="text" class="form-control"  name="categoryename" <?php if(isset($category))echo "value='$category[categoryename]'";  ?>>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">介绍</label>

                            <div class="col-sm-4">
                                <input type="text" class="form-control"  name="intro" <?php if(isset($category))echo "value='$category[intro]'";  ?>>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="footer-page">
                        <div class="col-sm-5"></div>
                            <div class="col-sm-3 mt3">
                                <button class="btn btn-default btn-s-md mt10" type="submit"><?php if(!isset($category)){echo '确定添加';}else{echo '确定修改';} ?></button>
                                <a href="javascript:history.go(-1);" class="btn  bt-gray btn-s-md mt10">取消修改</a>
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
</script>
</body>
</html>