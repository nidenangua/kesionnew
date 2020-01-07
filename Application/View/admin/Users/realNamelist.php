<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>科汛在线教育</title>
    <link rel="shortcut icon" href="favicon.ico">
    <link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
    <link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
    <link href="<?php echo UOOT;?>Public/admin/css/form.css" rel="stylesheet">
    <script src="<?php echo UOOT;?>Public/common/js/jquery.min.js"></script>
 
</head>
<body class="gray-bg">
<div class="wrapper  " style="margin-top: 70px;">
    <div class="row">
    
        <form class="fr" action="<?php echo M_URL('Users','realName'); ?>" method="post">
     <div id="manage_top" class="menu_top_fixed height73 p15">
            <div class="ibox-title">
                <h3 class="fl" >认证管理
                	<ul id="tablist">
			                <li <?php if($stat==3)echo "class='active'";?>>
			                <a href="<?php echo M_URL('Users','realName','',GP('stat-3',true)); ?>"> 所有</a>
			                 </li>
			                  <li <?php if($stat==1)echo "class='active'";?>>
			                <a href="<?php echo M_URL('Users','realName','',GP('stat-1',true)); ?>"> 已审核</a>
			                </li>
			                 <li <?php if($stat==0)echo "class='active'";?>>
			                <a href="<?php echo M_URL('Users','realName','',GP('stat-0',true)); ?>"> 未审核</a>
			                </li>
			            </ul>
                </h3>
                  <div class="ibox-tools mt3">
                 <!-- <a href="javascript:void(0)" onclick="history.go(0)" class="collapse-link">
                    <i class="reflash"></i>
                  </a>-->
                  <button  class="ks-bt bt-def" type="submit">Go!</button>

              </div>     
               <div class="search-main fr">
                            <div class="search-box w240 mt7 fl" >
                                <select class="inputText bRadius5 fl" id="keytype" name="keytype" style="width: 60px;">
                                        <option value="1" <?php if($keytype==1){echo 'selected="selected"';} ?>>手机</option>
                                         <option value="2" <?php if($keytype==2){echo 'selected="selected"';} ?>>网校ID</option>
                                         <option value="3" <?php if($keytype==3){echo 'selected="selected"';} ?>>姓名</option>
	  	                            </select>
                                <div class="input-group">
                                    
                                    <input type="text" name="keyword" class=" form-control input-sm w180 fl" value="<?php if(isset($keyword)) echo $keyword; ?>">
                      <span class="input-group-btn ">
                      </span>
                                </div>
                            </div>
                        </div>
                        
                    
            </div>
        </div>
                </form>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="tabs-container">
         
<form target="hidframe"  action="<?php echo M_URL('Users','realnamebatch','',GP('p-'.$page->now_page)) ?>" method="post">
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
                                        <th>网校ID</th>
                                        <th>姓名/企业名称</th>
                                        <th>电话</th>
                                        <th>个人/企业</th>
                                        <th>提交审核时间</th>
                                        <th style="text-align:center">参与扶持计划</thstyle="text-align:center">
                                        <th>状态</th>
                                        <th>查看</th>
                                        <th style="text-align:center">操作</th>
                                    </tr>
                                    </thead>
									<?php  foreach($realNames as $k=>$v){ ?>
									<tr class="gradeX">
									    <td>
									    <div class="checkbox  checkbox-info" >
									        <input id="C<?php  echo $v['id']; ?>" type="checkbox" name="id[]" value="<?php  echo $v['id']; ?>" class="check0">
									        <label for="C<?php  echo $v['id']; ?>">
									          <?php  echo $v['id']; ?>
									        </label>
									    </div></td>
									    <td><a href="<?php echo wx_Url($v['wxid'])?>" target="_blank"><?php echo $v['wxid'];?></a></td>
									    <td><?php echo $v['realName'] ?></td>
									    <td><?php echo $v['tel'] ?></td>
									    <td><?php if($v['usertype'] == 1){echo '教师';}else{ echo '机构'; } ?></td>
									    <td><?php echo date('Y-m-d H:i:s',$v['adddate']); ?></td>
									    <td style="text-align:center"><?php echo $v['from']=='apply'?'扶持申请':'-' ?></td>
									    <td><?php if($v['status'] == 1){ echo '已审核'; }elseif($v['status'] == 2){ echo '审核未通过';}elseif($v['status'] ==0){echo '待审核';} ?></td>
									    <td><a class="form-bule" href="<?php echo M_URL('Users','doreal',$v['id']);  ?>">查看</a></td>
									    <td style="text-align:center">

                                            <?php if ($v['status']!='1'){
                                            ?>
                                            <a href="<?php echo M_URL('Users','deleteRealName',$v['id'],GP('p-'.$page->now_page));?>" onclick="return confirm('确认删除吗？');">删除</a>
                                             <?php } ?>

                                        </td>
									</tr>
									<?php } ?>
                                    </tbody>
                                   </table>
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
         <!--<div class="checkbox fl checkbox-info" style="margin-top:20px;margin-right:10px">
            <input id="checkboxAll" name="check1" type="checkbox" class="check-all check0">
            <label for="checkboxAll">全选</label>
         </div>-->
            <!--<button class="btn mt10 btn-default" type="submit" name="batch" value="2">批量审核</button>
            <button class="btn mt10 btn-default" type="submit" name="batch" value="3">取消审核</button>
            <button class="btn mt10 btn-default" type="submit" name="batch" value="4">删除</button>-->
         </div>
        <div class="col-sm-7 "  style="margin-top:7px"><?php echo $page->show(3); ?></div>
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
</html>