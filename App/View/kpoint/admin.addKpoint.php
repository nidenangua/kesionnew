<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php if(!isset($app)){echo '添加应用';}else{echo '修改应用';} ?></title>
<link rel="shortcut icon" href="favicon.ico"> 
<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/fonts/iconfont.css" rel="stylesheet">
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
</head>

<body class="gray-bg">
<div class="wrapper mt40 wrapper-content animated fadeInRight">
<div id="manage_top " class="menu_top_fixed  ">
					  <div class="ibox-title fl ml15 mr15">
                      
                    
                        <a href="<?php echo M_URL($this->AppName.'/Index','index','',GP('')); ?>"><i class="up-level"></i>上一级</a>
                    </div>
                    <div class="ibox-tools" >
                        <a href="javascript:void(0)" onclick="history.go(0)" class="collapse-link">
                            <i class="icon iconfont">&#xe6aa;</i>
                        </a>
                    </div>

                </div>
    <div class="row bg-white p15">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
              
                <div class="ibox-content">
                
                    <form target="hidframe" id="myform" action="<?php if(!isset($value)){echo M_URL($this->AppName.'/Index','doaddKpoint','',GP(''));}else{echo
					                            M_URL($this->AppName.'/Index','doeditKpoint',$value['id'],GP('p-'.$now_page));} ?>" method="post" class="form-horizontal">
                          <div class="form-group">
                            <label class="col-sm-2 control-label">当前用户：</label>
                            <div class="col-sm-4">
                               <?php echo $this->userinfo['username'] ?><a  onClick="selectUser('<?php echo M_URL($this->AppName.'/Index','selectUser','',GP('addtype-1,keytype-2')) ?>')"> 更改 </a>
                            </div>
                        </div>                       
                         <div class="form-group">
                            <label class="col-sm-2 control-label">所属分类</label>
                            <div class="col-sm-10">
                                <?php 
							   echo $Linkage->Linkage(2);
							?>
                            </div>
                     
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">知识点</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control"  name="title" value="<?php if(isset($value))echo $value['title'];  ?>">
                            </div>
                        </div>
                        
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">介绍</label>

                            <div class="col-sm-4">
                               <textarea class="form-control" col="20" row="2" name="intro" style="min-height:150px"><?php if(isset($value))echo $value['intro'];  ?> </textarea>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="footer-page mt3">
                        <div class="col-sm-5"></div>
                            <div class="col-sm-3">
                                <button class="btn btn-primary btn-s-md"  type="button" onClick="do_reg()"><?php if(!isset($value)){echo '确定添加';}else{echo '确定修改';} ?></button>
                                <a href="<?php echo M_URL($this->AppName.'/Index','index','',GP('')); ?>" class="btn btn-default btn-s-md">取消</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<!--<script src="Public/app/js/layer.js" type="text/javascript"></script>-->
<script src="<?php echo UOOT;?>Public/common/js/common.js" type="text/javascript"></script>
<script>
    //添加课时
function selectUser(url){	

layer.open({
        type: 2,
        area: ['850px', '600px'],
        fixed: false, //不固定
        maxmin: true,
		 title: ['选择用户', 'font-size:18px;'],
        content:url
    });
};
function do_reg()
{
	var title = $("input[name='title']").val();

	/*数字验证*/
	var num =/^\d+(\.\d+)?$/;
    if(title==''){
		Alert('知识点名称');
		return false;	
    }	
	
	$("#myform").submit();	
}

</script>
</body>
</html>