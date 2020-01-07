<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="renderer" content="webkit">
    <title>kesion教育平台</title>
    <meta name="Keywords" content="kesion教育平台"/>
    <meta name="Description" content="kesion教育平台" />
    <link href="<?php echo UOOT;?>Public/admin/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
     <link href="<?php echo UOOT;?>Public/admin/css/form.css" rel="stylesheet">	
    <link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
    <script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
     <style>
        .courseList li{ position:relative; padding-left:229px;min-height:189px;padding-top:20px; padding-bottom:20px; padding-right:20px; border-bottom:1px solid #eee;}
        .courseList li .tface{width:189px;height:189px; position:absolute;left:20px;top:20px; text-align:center;}
        .borders{ border: 1px solid #eee}
		 label{display:inline-block;vertical-align:middle}
    </style>
    
</head>

<body class="gray-bg">

<div class="clear"></div>
<div id="manage_top" class="menu_top_fixed  p15 height73" style="z-index: 3;">
    <div class="ibox-title">
        <h3 class="fl">&nbsp;&nbsp;创建扩展表  </h3>
        
		<div class="fr">
           <div class="fl ks-top-search">
			<!--搜索-->
				<button class="ks-bt" type="button" onclick="history.go(-1)" style="border:1px solid #eee"><i class="iconfont icon-fanhui"></i>返回</button>
			<!--搜索-->
			</div> 
              
               
        </div>
    </div>
</div>


<div class=" contentBox bRadius10 bg-white editPerson p20" style="margin-top: 75px;">
    <div class="borders" style="padding: 0 20px">
<form target="hidframe" id="myform" action="<?php echo M_URL('Setting','extendAddTableType') ?>" method="post">
    <div class="clearfix p10 borderBso" style="padding: 20px 0;">
         <label class="mr20 fsize14 c-92">
            模型：
            <select class="w200 inputText bRadius5"  name="tablename">
                    <?php foreach($tables as $v){ ?>
                    <option value="<?php echo $v['Tables_in_'.$GLOBALS['config']['DB_NAME']] ?>" ><?php echo $v['Tables_in_'.$GLOBALS['config']['DB_NAME']] ?></option>
                    <?php } ?>
            </select>
        </label>
        <label class="mr20 fsize14 c-92">
           项目名称：
            <input type="text" class="w150 inputText bRadius5" name="title">
        
        </label>
         <button class="ks-bt bt-def"  type="button" onClick="do_reg()">确定</button>  	
       
    </div>
    
   
    <div class="clearfix p10 "></div>
</form>
</div>

   <div class="ibox float-e-margins">
                <div class="ibox-content">
                <div class="panel-heading">模型列表</div>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>序号</th>
                            <th>项目名称</th>
                            <th>原型表名：</th>
                            <th>表数量：</th>
                            <th>表类别id：</th>
                            <th>删除</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($values as $v){  ?>
                        <tr onClick="skip('<?php echo M_URL('Setting','extendTableList',$v['type'])?>');">
                            <td><?php echo $v["tableid"]?></td>
                            <td><?php echo $v['title'] ?></td>
                            <td><?php echo 'ks_'.$v["tablename"] ?></td>
                            <td class="red"><?php echo $v['count(*)'] ?></td>
                            <td><?php echo $v['type'] ?></td>
                            
                            <?php if($v['count(*)']!=1){ ?>
                            <td>--</td>
                            <?php } else{?>
                            <td onClick="doNone(event);">
                               <a  onclick="Confirm('是否删除此表？该操作不可逆!','<?php echo M_URL('Setting','extendDelType',$v["type"]);?>');"><i class="delete2017"></i></a>
                            </td>
                            <?php }?>
                        </tr>
                        <?php }?>
                        </tbody>
                    </table>

                </div>
            </div>

 
<script src="<?php echo UOOT;?>Public/common/js/common.js" type="text/javascript"></script>
 <script>
function do_reg()
{
	var title = $("input[name='title']").val();

    if(title==''){
		Alert('项目名称不能为空');
		return false;	
    }
   
	$("#myform").submit();
	
}	
</script> 
</body>
</html>
