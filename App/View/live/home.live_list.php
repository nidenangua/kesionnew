<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>kesion教育平台</title>
<meta name="Keywords" content="kesion教育平台"/>
<meta name="Description" content="kesion教育平台" />
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/live.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/main.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<style>
.imgsize
</style>
</head>

<body class="bg-gary">
<ul class="liveTab clearfix mb30">
     <li class="fl">
        <a href="<?php echo M_URL($this->AppName.'/Index','index','',GP('')); ?>" class="alignCenter">
            <span class="block hLh40">
<i class="icon iconfont">&#xe748;</i>
            </span>
            <span class="block hLh35 fsize14">主页</span>
        </a>
    </li>
    <li class="fl  curr">
        <a href="<?php echo M_URL($this->AppName.'/Index','livelist','',GP('')); ?>" class="alignCenter">
            <span class="block  hLh40">
                 <i class="icon iconfont">&#xe609;</i>
            </span>
            <span class="block hLh35 fsize14">视频列表</span>
        </a>
    </li>
  
</ul>
<div class="clear"></div>
<div class=" contentBox bRadius10 bg-white editPerson" style="padding: 20px">
        <table>
            <tr>
              <td width="50px">序号</td>
              <td width="220px">流</td>
              <td width="200px">总流量</td>
              <td width="200px">已结算流量</td>
              <td width="200px">观看人次</td>
              <td width="200px">状态</td>
               <td width="200px">创建时间</td>
            </tr>
            <?php foreach($values as $k=>$v){ ?>
            <tr>
               <td><?php echo $k+1; ?></td>
               <td>
               <a href="<?php echo  M_URL($this->AppName.'/Index','liveAddress',$v['id'],GP('')); ?>">
			   <?php echo $v['stream'] ?>
               </a>
               </td>
               <td><?php echo $v['flow'] ?></td>
               <td><?php echo $v['SettledFlow'] ?></td>
               <td><?php echo $v['playcount'] ?></td>
               <td><?php echo $v['status'] ?></td>
               <td><?php echo date('Y-m-d H:i:s',$v['adddate']) ?></td>
            </tr>  
            <?php } ?>
        </table>
</div>
 <div class="footer-page"><?php echo $page->show(3); ?></div>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
var selectInputs = document.getElementsByClassName('verAlignMiddle'); // 所有勾选框
    var checkAllInputs = document.getElementsByClassName('check-all') // 全选框

    for(var i = 0; i < selectInputs.length; i++ ){
		
        selectInputs[i].onclick = function () {
			
            if (this.className.indexOf('check-all') >= 0) { //如果是全选，则吧所有的选择框选中
                for (var j = 0; j < selectInputs.length; j++) {
                    selectInputs[j].checked = this.checked;
                }
            }
            if (!this.checked) { //只要有一个未勾选，则取消全选框的选中状态
                for (var i = 0; i < checkAllInputs.length; i++) {
                    checkAllInputs[i].checked = false;
                }
            }

        }
    }
</script>
</body>

</html>
