<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title></title>
<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet"> 
<link href="<?php echo UOOT;?>Public/admin/css/form.css" rel="stylesheet"> 	
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
</head>

<body class="gray-bg">
<div class="wrapper wrapper-content mt55 animated fadeIn">
<form target="hidframe"  action="<?php echo M_URL('Setting','beach') ?>" method="post">
    <div class="row">
     <div id="manage_top" class="menu_top_fixed height73 p15">
        <div class="ibox-title">
            <h3 class="fl mr15">短信模板管理
     		  <ul class="ml15" id="tablist">
                <li class="active"><a href="<?php echo M_URL('Setting','Smscontent'); ?>">短信模块</a></li>
                <li class=""><a href="<?php echo M_URL('Setting','email'); ?>">邮箱模块</a></li>
                <li class=""><a href="<?php echo M_URL('Setting','emailmassage'); ?>">站内信模块</a></li>
                <li class=""><a href="<?php echo M_URL('Setting','cardTemplate'); ?>">微名片服务通知</a></li>
              </ul>
            </h3>
            <a class="btn btn-default btn-rounded btn-s-md " href="<?php echo M_URL('Setting','addModel'); ?>">新增模块</a>
              <div class="ibox-tools">
              <button class="ks-bt" type="button" onclick="history.go(-1)" style="border:1px solid #eee"><i class="iconfont icon-fanhui"></i>返回</button>
                  <!--<a href="javascript:void(0)" onclick="history.go(0)" class="collapse-link mt0">
                    <i class="reflash"></i>
                  </a>-->
              </div>
              
            </div>
        </div>
    </div>

    <div class="row">
        <div class="tabs-container mt15">
          
            <div id="ksBoxContent" style="padding-bottom: 220px;">
            <div class="tab-content ">
                <div class="tab-pane" style="display: block">
                    <div class="panel-body" style="padding:0;padding-top:20px">
                       
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th >是否启用</th>
                                <th >模块名称</th>
                                <th >模块英文名称</th>
                                <th>短信内容</th>
                                <th >每天最多发送数量</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
							$html="";
							foreach($site as $k=>$v){
							  $html="<tr>
							          <td>".$v["id"]."</td>
                                      <td>
                                        <div class='checkbox checkbox-info'>
                                        <input id='checkbox".$v["id"]."' type='checkbox' name='status[]' value='".$v["id"]."' class='check0' ";
										if($v["status"]==1){$html.="checked";}
										$html.=">
                                        <label for='checkbox".$v["id"]."'>
                                        </label>
                                         </div>
                                      </td>
									  <td>
                                        <h4>".$v['modelname']."</h4>
                                      </td>
									  <td>
                                        <h4>".$v['model']."</h4>
                                      </td>
                                      <td>
									   <textarea rows='2' cols='20' class='form-control' style='width: 420px;height: 64px' name='content[]'>".$v["content"]."</textarea>
									   </td>
									   <td style='width:160px'>
                                      <div class='row'>
                                        <div class='col-sm-7'>
                                            <input class='form-control' name='smsnum[]' value='".$v["smsnum"]."' type='number' >              
											<input type='hidden' value='".$v["id"]."' name='id[]'>
                                        </div>
                                        <label class='col-sm-3 control-label' style='padding-top: 7px'>条</label>
                                      </div>
                                  </td>
                                  <td>";
                                if($v["issys"]==0) {
                                    $html .= "<a href='javascript:void(0);'  onclick=\"Confirm('是否删除此模块？该操作不可逆！','" . M_URL('Setting', 'delModel', $v["id"]) . "')\">删除</a>";
                                }
                                $html.="</td></tr>";
									  echo $html;	  	
							}
							
							?>
                            </tbody>
                        </table>
                        <?php echo NoC($site);?>
                     </div>
                     <div class="footer-page h60">
                       <div class="col-sm-5">
                        <div class="checkbox fl checkbox-info" style="margin-top:20px;margin-right:10px">
                         <input id="checkboxAll" name="check1" type="checkbox" class="check-all check0">
                          <label for="checkboxAll">全选</label>
                           </div>
                        <button class="btn mt10 btn-default" type="submit" name="batch" value="0">保存</button>
                       </div>
                     </div>
                </div>
            </div>
           </div> 
        </div> 
    </div>
</form>
</div>
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script> 
<script src="<?php echo UOOT;?>Public/common/js/nicescroll.js"></script>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
    // 所有勾选框
    var selectInputs = $('.check0'); 
	 // 全选框
    var checkAllInputs = $('.check-all');

    for(var i = 0; i < selectInputs.length; i++ )
	{
        selectInputs[i].onclick = function () {
            if (this.className.indexOf('check-all') >= 0)
			{
				 //如果是全选，则吧所有的选择框选中
                for (var j = 0; j < selectInputs.length; j++) 
				{
                    selectInputs[j].checked = this.checked;
                }
            }
            if (!this.checked) { 
			    //只要有一个未勾选，则取消全选框的选中状态
                for (var i = 0; i < checkAllInputs.length; i++) 
				{
                    checkAllInputs[i].checked = false;
                }
            }

        }
    }	


    $(function(){
        $(".nav-tabs li").click(function () {
            $(this).addClass('active').siblings().removeClass('active');
            $('.tab-content> .tab-pane:eq(' + $(this).index() + ')').show().siblings().hide();
        });
    });

</script>
</body>
</html>


