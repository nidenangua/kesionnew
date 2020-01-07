<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
    <title>科汛在线教育</title>
    <link rel="shortcut icon" href="favicon.ico">
    <link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
    <link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
     <link href="<?php echo UOOT;?>Public/app/css/form.css" rel="stylesheet">
 	<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />


    <script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
    
     
    <script>
        function insertHTMLToEditor(codeStr)
        {

            editor.execCommand('insertHtml', '<hr class="pagebreak" noshade="noshade" size="5" style="-webkit-user-select: none;">');
        }

    </script>
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-sm-12">
       <div id="manage_top" class="menu_top_fixed  p15 height73">
                <div class="ibox-title fl">
                    <h5>添加新闻</h5>

               
                      
                    </div>
              <div class="ibox-tools">
			<button class="ks-bt" type="button" onclick="history.go(-1)"><i class="iconfont icon-fanhui"></i>返回</button>	
	
		
		</div>
		</div>
                <div class="ibox-content">
                    <form target="hidframe"  method="post" class="form-horizontal" action="<?php if(isset($Article)){echo M_URL($this->AppName.'/index','doEditArticle',$Article['id'],GP('appid-'.$appid));}else{echo M_URL($this->AppName.'/index','doaddArticle','',GP('appid-'.$appid.',userid-'.$userid));}?>" enctype="multipart/form-data">

                        <div class="tabs-container">
                            <ul class="nav nav-tabs">
                            <?php
							$html = '';
							foreach($fieldgroup as $k=>$v)
							{
							  $html .= '<li class="';if($v['issys']==0)$html .='active';$html .= '"><a  href="#">'.$v['groupname'].'</a></li>';
							}
							echo $html;
							?>

                            </ul>
                            <div class="tab-content">
                            <?php
							$html = '';
							foreach($fieldgroup as $k=>$v)
							{
							  /* ---------------  未来字段添加后插入   该方法详见/KS_cls/Common/Fieldpiece.functions.php -------------------   */	
							  $html .= '<div class="tab-pane ';if($v['issys']==0)$html .='active';$html .= '">
                                         <div class="panel-body">
                                          ';if(isset($Article)){$html .= Admin_Field($Field[$k],$Article,$Linkage);}else{$html .= Admin_Field($Field[$k],'',$Linkage);}$html .= '
                                         </div>
                                      </div>';
							 }
							echo $html;
							?>
                            </div>

                            <div class="hr-line-dashed"></div>
		                       <div class="footer-page mt3">
		                            <div class="col-sm-5"></div>
		                            <div class="col-sm-4 ">
		                                <button class="btn mt10 btn-default" onclick="do_reg();" type="button">确定修改</button>
		                                <a href="javascript:history.go(-1);" class="btn mt10 bt-gray">取消修改</a>
		                            </div>
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
   taps();
   uploadView('100','100')；
   datatime('#test')；
   loadScorllJs();

</script>
</body>

</html>