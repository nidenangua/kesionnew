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
    <link href="<?php echo UOOT;?>Public/app/css/main.css?<?php echoHash(); ?>" rel="stylesheet" />
    <link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
        <!--<link href="Public/app/css/layer.css?<?php echoHash(); ?>" rel="stylesheet" />-->
    <script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
    <style>
        .generalBeen {
            display: inline-block;
            padding: 0 20px;
            height: 34px;
            line-height: 34px;
            text-align: center;
            background-color: limegreen;
            border: none;
        }
        .generalTitle {margin-bottom: 30px}
    </style>
</head>

<body class="bg-gary">
<div class="gSmallBox contentBox bRadius10 bg-white w100">
    <div class="generalTitle">
        <!-- <span class="gTitle fsize18 c-3e verAlignMiddle">新增类型管理</span> -->
         当前所在<?php echo $this->userinfo['username'] ?>类型管理界面   &nbsp;&nbsp; 
          <a onClick="selectUser('<?php echo M_URL($this->AppName.'/Index','selectUser','',GP('addtype-4')); ?>')">更换用户</a> 
       <?php if($this->userid !=0){ ?>
        <a class="generalBeen c-fff fsize16 bRadius5 fr" href="<?php echo M_URL($this->AppName.'/Index','index','',GP('appid-'.$this->appid,true)); ?>" >返回
        </a><?php  }else{ ?>
		<a class="generalBeen c-fff fsize16 bRadius5 fr" href="<?php echo M_URL($this->AppName.'/Index','index','',GP('')); ?>" >返回</a>
		<?php	} ?>
    </div>
    <div class="infoBox">
      <!--   <div class="  ml20 mr20">
            <a class="generalBeen c-fff fsize16 bRadius5" href="<?php echo M_URL($this->AppName.'/Index','typeAdd','',GP('userid-'.$this->userid)); ?>">+新增类型</a>
        </div> -->
        <div class="clearfix p20">
        <table width="100%" cellpadding="0" cellspacing="0" border="0"
               class="gTable borderTable borderSo" style="border-bottom:0;">

            <thead>
            <tr class="bg-gary">
                <th class="alignCenter hLh40 pt0 pb0 fsize14"> ID</th>
                <th class="alignCenter hLh40 pt0 pb0 fsize14"> 标题</th>
                <th class="alignCenter hLh40 pt0 pb0 fsize14">描述</th>
                <th class="alignCenter hLh40 pt0 pb0 fsize14 ">状态</th>
                <th class="alignCenter hLh40 pt0 pb0 fsize14 ">排序</th>
                <th class="alignCenter hLh40 pt0 pb0 fsize14 w93">操作</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($paper as $k=>$v){ ?>
            <tr>
                <td class="alignCenter hLh40 pt0 pb0 fsize14 c-92 "> <?php echo $v['id'] ?> </td>
                <td class="alignCenter hLh40 pt0 pb0 fsize14  c-92 "><?php  echo $v['typeName'] ?> </td>
                <td class="alignCenter hLh40 pt0 pb0 fsize14 c-92"><?php  echo $v['intro'] ?> </td>
                <td class="alignCenter hLh40 pt0 pb0 fsize14 c-92"><?php if($v['isdisplay']==1){echo '显示';}else{ echo '隐藏';} ?></td>
                <td class="alignCenter hLh40 pt0 pb0 fsize14 c-92"><?php echo $v['orderid'] ?></td>

                <td class="alignCenter hLh40 pt0 pb0 fsize14 c-92">
                  <a href="<?php echo M_URL($this->AppName.'/Index','typeAdd',$v['id'],GP('')); ?>" > <i class="icon pr10 iconfont">&#xe616</i> </a>
                  <a href="javascript:void(0);" onclick="Confirm('是否删除此类型？该操作不可逆!','<?php echo M_URL($this->AppName.'/Index','delPaperType',$v['id'],GP('')); ?>')">  <i class="icon pr10 iconfont">&#xe61d;</i></a>
                </td>
            </tr>
             <?php } ?>
            </tbody>
        </table>
         <?php echo NoC($paper);?>
    </div>
</div>
<div class="footer-page" style="height: 60px">
    <div class="col-7 mt15">
        <?php echo $page->show(3); ?>
    </div>
  
</div>
</div>
</body>
</html>
<script src="<?php echo UOOT;?>Public/common/js/nicescroll.js"></script>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
   
taps();//选项卡
addclass();//添加课时
  var selectInputs = $('.verAlignMiddle'); // 所有勾选框
var checkAllInputs = $('.check-all') // 全选框
selectall(selectInputs,checkAllInputs);

</script>
<script>
    //添加课时
function selectUser(url){	

layer.open({
        type: 2,
        area: ['850px', '600px'],
        fixed: false, //不固定
        maxmin: true,
		 title: ['选择用户', 'font-size:18px;'],
        content:url
    });
};

</script>