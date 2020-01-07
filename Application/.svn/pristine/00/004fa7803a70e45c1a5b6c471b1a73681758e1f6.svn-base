<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>科汛在线教育</title>
<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<script src="<?php echo UOOT;?>Public/common/js/jquery.min.js"></script>
</head>
<body class="gray-bg">

<div class="wrapper wrapper-content mt55 animated fadeIn"  >
    <div class="row">
        <div id="manage_top" class="menu_top_fixed height73 p15 " >
            <div class="ibox-title">
              <h3 class="fl" ></h3>
              <div class="ibox-tools">
                    <a href="javascript:void(0)" onclick="history.go(0)" class="collapse-link mt0">
                       <i class="reflash"></i>
                    </a>
              </div>
			<a  href="<?php echo M_URL('H5market','H5add','',GP('option-3')); ?>" class="btn btn-info btn-rounded btn-s-md " style="color:#676a6c;margin-left:20px"> 添加自定义</a>
            </div>
        </div>
    </div>
    <div class="row"><br />
        <div class="col-sm-12 ">
            <div class="tabs-container">
             <ul class="nav nav-tabs">
                <li <?php if($option==3)echo "class='active'";?>>
                <a href="<?php echo M_URL('H5market','index','',GP('option-3')); ?>"> 自定义列表</a>
                </li>
            </ul>
                <div class="taps-button">
                    <div class="row btn-choice">
              <a href="<?php if($hits==1){echo M_URL('H5marke','index','',GP('hits-0'));}else{echo M_URL($this->AppName.'/index','index','',GP('hits-1'));} ?>"></a>
                    </div>
                </div>
                <form target="hidframe" id="myform" action="<?php echo M_URL('H5market','batch','',GP('p-'.$page->now_page)) ?>" method="post">
                    <div class="tab-content">
                      <div id="tab-1" class="tab-pane active" style="">
                        <div class="panel-body" style="padding:0">
                           <div class="row">
                              <div class="col-sm-12 ">
                                 <div class="ibox float-e-margins pt15">
                                    <div class="ibox-content">
                                     <table class="table table-bordered ">
                                        <thead>
                                        <tr>
                                            <th>活动序号</th>
                                            <th>活动名称</th>
                                            <th>ICO</th>
                                            <th>启用状态</th>
                                            <th>操作</th>
                                        </tr>
                                        </thead>
                                      <tbody>
                                      <?php foreach($values as $k=>$v){?>
                                        <tr>
                                           <td><?php echo $v["id"];?></td>
                                            <td><?php echo $v["h5name"];?></td>
                                            <td><img width="50px" height="50px" src="<?php echo $v["ico"];?>"></td>
                                            <td style="width:200px">
                                            <?php if($v["isuse"]==0){ ?>
                                             <label class="txt-top">未启用</a></label>
                                            <?php }elseif($v["isuse"]==1){ ?>
                                             <label class="txt-top">启用</a></label>
                                            <?php } ?>
                                            </td>
                                            <td style="width:200px"><label class="txt-top">
                                                <a title="编辑" href="<?php echo M_URL('H5market','H5edit',$v["id"],GP('option-2')); ?>"><i class='edit2017'></i></a></label>
                                                <label class="txt-top">
                                                <a href="javascript:void(0);" onclick="Confirm('是否删除此活动？该操作不可逆！','<?php echo M_URL('home/H5market','delect',$v['id'],GP('p-'.$page->now_page));?>')">
                                                	<i class="delete2017"></i>
                                                </a>
                                                </label>
                                                <label class="txt-top">
                                                <a title="添加自定义字段" href="<?php echo M_URL('H5market','H5zdyAdd',$v["id"],GP('')); ?>">
                                                	<i class="iconfont icon-jiahao" style="font-size: 22px;font-family: '微软雅黑'; font-weight: 900; color: green;">+</i>
                                                </a>
                                                </label>
                                                
                                            	
                                            </td>
                                        </tr>
                                     <?php } ?>
                                     </tbody>
                                    </table>
                                    <?php echo NoC($values);?> 
                                    </div>
                                 </div>
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
                                    <button class="btn mt10 btn-default" onClick="do_reg();" name="batch" value="1">
                                      	 批量删除
                                    </button>
                                </div>
                                <div class="col-sm-7 "  style="margin-top:7px">
                                    <?php echo $page->show(3); ?>
                                </div>
                        </div>
                        <div id="tab-2" class="tab-pane">
                            <div class="panel-body">
                            </div>
                        </div>
                      </div>
                    </div>
                </form>
           </div>
       </div>
    </div>
</div>

</script>

<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
	loadScorllJs();//滚轮
	var selectInputs = $('.check0');
	var checkAllInputs = $('.check-all')
	selectall(selectInputs,checkAllInputs)
	buttonTap()//按钮样式切换
    function attributeSelect(url)
    {
        window.location.href=''+url;
    }

    function do_reg()
    {
	   $("#myform").submit();	
    }
</script>
</body>
</html>
