
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit"> 
<title>kesion教育平台</title>
<meta name="Keywords" content="kesion教育平台"/>
<meta name="Description" content="kesion教育平台" />
<link href="<?php echo UOOT;?>/Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>/Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>/Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>/Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<style>
    .cirle-user {
        width:45px;
        height:45px;
        border-radius:50%;
        display:inline-block;
    }
    .cirle-span {
        display: inline-block;
        vertical-align: top;
        margin-top: 15px;
        margin-left: 10px;
    }
</style>
</head>
<body>  
    <div class="ks-wbox">
        <table class="ks-table">
                <?php foreach ($values as $k => $v) { ?>
                 <tr>
                     <td>
                         <img src="<?php echo $this->upload->getHead($v['memberid'],4,0); ?>" class="cirle-user">                      
                         <span class="cirle-span"> <?php echo $v['menbername']; ?></span>
                     </td>     
                     
                     <td><?php echo date('Y-m-d H:i:s',$v['addtime']); ?></td> 
                <tr>
                <?php } ?>
                


        </table>
        <div class="form-footer clearfix">
            <span class="d-inline-block">
                <button onclick="javascript:history.go(-1);" class="ks-bt bt-defalut">取消</button>
            </span>
        </div>
    </div>

<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
		module.require(['$','webuploader','backstage'],function(){			
			
		});
	

</script>

</body>



</html>