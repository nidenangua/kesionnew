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
    <script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
</head>
<body class="gray-bg">

<div class="wrapper wrapper-content mt55">

	

    <div class="row">
        <div class="col-sm-12">
           
            <div id="manage_top" class="menu_top_fixed height73 p15">
            <div class="ibox-title ">
                <h3 class="fl  mr15">模型列表</h3>
           <a href="javascript:void(0)" onClick="addTypeChange('<?php echo M_URL('Setting','extendAddTable',$type); ?>','850px','600px')" class="btn btn-info btn-rounded btn-s-md " name="batch" value="2"> 添加数据表</a>
                <div class="ibox-tools">
                    <a href="javascript:void(0)" onclick="history.go(0)" class="collapse-link mt0">
                         <i class="reflash"></i>
                    </a>

                </div>

                <ul>
                    <li id="p2"> </li>
                </ul>
                 </div>
            </div>
<form target="hidframe"  action="<?php echo M_URL('Setting','extendBatch',$type); ?>" method="post">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                <div class="panel-heading"><?php echo $values[0]['title']?></div>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>数据表ID</th>
                            <th>数据表名称</th>
                            <th>数据表</th>
                            <th>类型</th>
                            <th>数据量</th>
                            <th>是否默认</th>
                            <th>删除</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; foreach($values as $v){  ?>
                        <tr>

                            <td><?php echo $v["tableid"]?></td>
                            <td><input type="text" class="form-control" name="itemname[]" value="<?php echo $v["itemname"]?>" style="width:250px">
                            <input type="hidden"  name="tableid[]" value="<?php echo $v["tableid"]?>" style="width:250px"></td>
                            <td><?php echo 'ks_'.$v["tablename"] ?></td>
                            <td><?php if($v["issys"]==1){echo "系统表";}else{ echo "自建表";}?></td>
                            <td class="red"><?php echo $v['count'] ?></td>
                            <td>
                            <div class="radio radio-info radio-inline">
                                <input type="radio" id="radio<?php echo $i?>" name="Isdefault" <?php if( $v["Isdefault"]==1) echo "checked"; ?> 
                                value="<?php echo $v["tableid"] ;?>">
                                <label for="radio<?php echo $i?>"></label>
                            </div>
                            </td>
                            <?php if($v["issys"]==1){ ?>
                            <td>--</td>
                            <?php } else{?>
                            <td>
                               <a href="javascript:void(0);" onclick="Confirm('是否删除此表？该操作不可逆!','<?php echo M_URL('Setting','extendDelType',$v["tableid"]);?>')"><i class="delete2017"></i></a>
                            </td>
                            <?php }?>
                        </tr>
                        <?php $i++;}?>
                     <!--  <tr>

                            <td>1</td>
                            <td><input type="text" class="form-control" placeholder="自带问吧回复表" style="width:250px"></td>
                            <td>KS_AskPost</td>
                            <td class="green">自建表</td>
                            <td class="red">111</td>
                            <td>
                                <div class="radio radio-info radio-inline">
                                    <input type="radio" id="radio2" name="radioInline">
                                    <label for="radio2"></label>
                                </div>
                            </td>
                            <td>
                                <i class=" fa fa-remove red"></i>
                            </td>

                        </tr>-->
                        </tbody>
                    </table>

                </div>
            </div>
<div class="footer-page h60">
  <div class="col-sm-5"></div>
  <div class="col-sm-7" >
 <button class="btn btn-primary mt7">确定保存</button>
  
</div>
</form>
        </div>
    </div>
</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js" type="text/javascript"></script>

</body>
</html>