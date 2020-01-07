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
  <link href="<?php echo UOOT;?>Public/app/css/form.css" rel="stylesheet">
  <link href="<?php echo UOOT;?>Public/admin/css/news/newstyle.css" rel="stylesheet">\
  	<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
</head>

<body class="gray-bg">
<div class="wrapper wrapper-content mt55 animated fadeIn">
  <div class="row">
    <div class="ibox-title">
      
      <div id="manage_top" class="menu_top_fixed height73 p15">
        <div class="ibox-title">
            <h3 class="fl mr15">短信模板管理
            	<ul id="tablist" class="ml15">
			            <li class=""><a href="<?php echo M_URL('Setting','Smscontent'); ?>">短信模块</a></li>
			            <li class="active"><a href="<?php echo M_URL('Setting','email'); ?>">邮箱模块</a></li>
			            <li class=""><a href="<?php echo M_URL('Setting','emailmassage'); ?>">站内信模块</a></li>
         				 </ul>
            </h3>
            <a class="btn btn-info btn-rounded btn-default btn-s-md " href="<?php echo M_URL('Setting','emailadd'); ?>">新增模块</a>
              <div class="ibox-tools">
              	<button class="ks-bt" type="button" onclick="history.go(-1)"><i class="iconfont icon-fanhui"></i>返回</button>
                
              </div>
              
            </div>
        </div>
    </div>
    <div class="row">
      <form target="hidframe"  action="<?php echo M_URL('Setting','emailbeach') ?>" method="post">
        <div class="tabs-container">

          <div class="tab-content ">
            <div class="tab-pane" style="display:block">
              <div class="panel-body">
               

                 
                  <table class="table table-bordered">
                    <thead>
                    <tr>
                      <th>ID</th>
                      <th >是否启用</th>
                      <th >模块名称</th>
                      <th>英文名称</th>
                      <th >每天最多发送数量</th>
                      <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                            $i=0;
                            $html="";
                            foreach($site as $k=>$v){
                    $i++;
                    $html="<tr>

                      <td>".$i."</td>
                      <td>
                        <div class='checkbox checkbox-info'>
                          <input id='checkbox".$i."' type='checkbox' name='status[]' value='".$v["id"]."' class='check0' ";
                          if($v["status"]==1){
                          $html.="checked";
                          }

                          $html.=">
                          <label for='checkbox".$i."'>
                          </label>
                        </div>
                      </td>
                      <td>
                        <h4>".$v["modelname"]."</h4>
                      </td>
                      <td>
                        <h4>".$v["model"]."</h4>
                      </td>
                      <td style='width:160px;'>
                        <div class='col-sm-9'>
                          <input class='form-control' name='emailnum[]' value='".$v["emailnum"]."' type='number' >              <input style='display:none' value='".$v["id"]."' name='id[]'>
                        </div>
                        <label class='col-sm-3 control-label' style='padding-top: 7px'>条</label>
                
                </td><td>";

                $html.=" <a href='".M_URL('Setting','emaileditor',$v["id"])."' ><i class='edit2017'></i></a>";
                if($v["issys"]==0){
                $html.="<a href='javascript:void(0);'  onclick=\"Confirm('是否删除此模块？该操作不可逆！','".M_URL('Setting','emaildel',$v["id"])."')\"><i class='delete2017'></i></a>";
                }
                $html.="</td> </tr>";
                echo $html;
                }

                ?>
                </tbody>
                </table>
                <?php echo NoC($site);?>
              </div>
            </div>
            <div class="footer-page h60">
              <div class="col-sm-5">
                        <div class="checkbox fl checkbox-info" style="margin-top:20px;margin-right:10px">
                          <input id="checkboxAll" name="check1" type="checkbox" class="check-all check0">
                          <label for="checkboxAll">全选</label>
                        </div>
                           <!--<a class="btn mt10 btn-default"  href="<?php echo M_URL('Smscontent','index'); ?>">短信模块</a>
                           <a class="btn mt10 btn-default" href="<?php echo M_URL('Setting','emailadd'); ?>">新增模块</a> -->
                          <button type="submit" name="batch" class="btn mt10 btn-default">批量修改</button>
              </div>    
            </div>

          
          </div>
        </div>
      </form>
    </div>
  </div>
  <script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
  <script src="<?php echo UOOT;?>Public/common/js/nicescroll.js"></script>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>

  <script>

    var selectInputs = $('.check0');
    // 所有勾选框
    var checkAllInputs = $('.check-all');
    // 全选框

    for(var i = 0; i < selectInputs.length; i++ ){
      selectInputs[i].onclick = function () {
        if (this.className.indexOf('check-all') >= 0) {
          //如果是全选，则吧所有的选择框选中
          for (var j = 0; j < selectInputs.length; j++) {
            selectInputs[j].checked = this.checked;
          }
        }
        if (!this.checked) {
          //只要有一个未勾选，则取消全选框的选中状态
          for (var i = 0; i < checkAllInputs.length; i++) {
            checkAllInputs[i].checked = false;
          }
        }

      }
    }


    $(function(){
      $('.nav-tabs li').click(function () {
        $(this).addClass('active').siblings().removeClass('active');
        $('.tab-content> .tab-pane:eq(' + $(this).index() + ')').show().siblings().hide();
      })
    })

  </script>
</body>
</html>


