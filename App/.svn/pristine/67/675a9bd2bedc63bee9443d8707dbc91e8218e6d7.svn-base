<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php if(!isset($app)){echo '添加应用';}else{echo '修改应用';} ?></title>
<link rel="shortcut icon" href="favicon.ico"> 
<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<body class="gray-bg">
<div class="wrapper mt40 wrapper-content animated fadeInRight">
<div id="manage_top " class="menu_top_fixed  ">
    <div class="ibox-title fl ml15 ">
        <h3 class="fl mr15"><?php if(!isset($app)){echo '添加应用分类';}else{echo '修改应用分类';} ?></h3>
        <a href="<?php echo M_URL($this->AppName.'/Index','index','',GP('')); ?>"><i class="up-level"></i>上一级</a>
    </div>
    <div class="ibox-tools" >
        <a href="javascript:void(0)" onclick="history.go(0)" class="collapse-link">
            <i class="reflash"></i>
        </a>
    </div>
</div>
    <div class="row bg-white p15">
      <div class="col-sm-12">
         <div class="ibox float-e-margins">
            <div class="ibox-content">
<form target="hidframe" id="myform" action="<?php if(!isset($category)){echo M_URL($this->AppName.'/Index','doaddCategory','',GP(''));}else{echo M_URL($this->AppName.'/Index','doeditCategory',$category['categoryid'],GP('p-'.$now_page));} ?>" method="post" class="form-horizontal">
            <div class="form-group">
                <label class="col-sm-2 control-label">所属分类</label>
                <div class="col-sm-4">
                    <select name="parentid" <?php if(isset($category)){echo 'disabled'; } ?> class="form-control">
                        <?php 
                            $html = '<option value="0">无--作为一级栏目</option>';
                            foreach($appcategory as $k=>$v)
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
            <div class="footer-page draggable">
            <div class="col-sm-5"></div>
                <div class="col-sm-3" style="margin-top:3px">
                    <button class="btn btn-primary btn-s-md" type="button" onclick="do_reg();"><?php if(!isset($category)){echo '确定添加';}else{echo '确定修改';} ?></button>
                    <a href="<?php echo M_URL($this->AppName.'/Index','index','',GP('')); ?>" class="btn btn-default btn-s-md">取消</a>
                </div>
            </div>
</form>
           </div>
        </div>
     </div>
  </div>
</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
loadScorllJs();
</script>
<script>
function do_reg()
{
	var categoryname = $("input[name='categoryname']").val();
	var categoryename = $("input[name='categoryename']").val();
	
	if (!categoryname) 
	{
		Alert('分类名称不能为空');
		return false;
	}
	if (!categoryename) 
	{
		Alert('英文名不能为空');
		return false;
	}
	$("#myform").submit();	
}
</script>
</body>
</html>