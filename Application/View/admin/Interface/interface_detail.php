<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="renderer" content="webkit">
    <title></title>
    <link rel="shortcut icon" href="favicon.ico">
    <link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
     <link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
	<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/admin/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/font.css?<?php echoHash(); ?>" rel="stylesheet" />
    <script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<style type="text/css">
    .ks-top-search .sc-text {
        width: 265px;
        margin-left: 0px;
    }
    td{
        padding-left: 0px!important;
    }
</style>
<body class="gray-bg">

<div class="row">
	<div id="manage_top" class="menu_top_fixed  p15 height73">
	    <div class="ibox-title">
	       <h3 class="ml15">接口对应的详细信息</h3>
	        <div class="fr">
	             <div class="fl ks-top-search">

					<button type="button" class="ks-bt bt-def" onclick="history.go(-1)"><i class="iconfont icon-fanhui"></i>返回</button>

				</div>  
	              
	               
	        </div>
	    </div>
	</div>
</div>


<div class="wrapper mt0" style="margin-top: 85px;">

    <div class="row bg-white p15 " style="border-radius: 10px;">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    
                    <div class="ibox-tools">
                        <a href="javascript:void(0)" onclick="history.go(0)" class="collapse-link">
                            <i class="fa fa-refresh"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <form target="hidframe" id="myform" action="<?php if(!isset($admin)){echo M_URL('Interface','');}else{echo M_URL('Admin','',$admin['adminid'],$now_page);} ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">接口名</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" value="<?php if($id){echo $info['name'];}?>"  readonly>
                            </div>
                          
                        </div>
                         <div class="form-group">
                            <label class="col-sm-2 control-label">对应的英文名</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" value="<?php if($id){echo $info['interfaceName'];}?>"  readonly>
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">所属接口文件</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" value="<?php if($id){echo $info['controller'];}?>Model"  readonly>
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">管理员类别</label>

                            <div class="col-sm-4">
                                <input type="text" class="form-control" value="<?php if($id){echo $info['classifyname'];}?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">参数管理</label>

                            <div class="col-sm-4">
                                <?php if($values){?>
                                    <table class="ks-table">
                                       <thead>
                                            <tr>
                                                <th>参数</th>
                                                <th>值</th>
                                                <th>类型</th>
                                                <th>是否必须</th>
                                                <th>备注</th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="table-body" >
                                            <?php foreach($values as $k=>$v){?>
                                            <tr class="ks-top-search">
                                                <td><?php echo $v['name']?></td>
                                                <td><?php echo $v['parameter']?></td>
                                                <td><?php if($v['pramType']==1){echo '文件';}elseif($v['pramType']==0){echo '字符串';}elseif($v['pramType']==2){echo '数字';}?></td>
                                                <td><?php if($v['isnecessary']){echo '是';}else{echo '否';}?></td>
                                                <td><?php echo $v['mark']?></td>
                                                <td><a class="deepBlue ok-icon ok-pe2" onclick="Confirm('是否删除？该操作不可逆!','<?php echo M_URL('Interface','deleteParameter',$v['id'],GP('p-'.$now_page.',interfaceid-'.$id)); ?>')" title="删除"></a></td>
                                                <td><a onclick="addTypeChange('<?php echo M_URL('home/Interface','addshowpram',$v['id'],GP('p-'.$now_page.',interfaceid-'.$id)) ?>','530px','420px',{title:'修改参数',type:'top'});" title="修改">修改</a></td>
                                            </tr>
                                            <?php }?>
                                        </tbody>
                                    </table>
                                <?php }?>
                                <div class="button-box">
                                    <button class="btn mt10 btn-default fr" onclick="addTypeChange('<?php echo M_URL('home/Interface','addshowpram','',GP('p-'.$now_page.',interfaceid-'.$id)) ?>','530px','420px',{title:'添加参数',type:'top'});">增加参数</button>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="footer-page mt3">
                            <div class="col-sm-5"></div>
                            <div class="col-sm-4 ">
                                <a href="<?php echo $url;?>" class="btn mt10 bt-gray">返回列表页</a>
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
    $(function(){
        loadScorllJs();//滚轮
        taps();//选项卡
        uploadView('100','100');//图片上传	
    })
</script>
<script>
    function do_reg(){
        var classify = $("input[name='classify']").val();
        if(classify==''){
            Alert('不能为空');
        }
        else{
            $("#myform").submit();
        }
    } 
</script>
</body>
</html>