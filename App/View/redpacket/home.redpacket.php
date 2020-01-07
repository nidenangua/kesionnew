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
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
</head>
<body class="ks-wrap">
	<!--开始-->
	<div class="bRadius10 bg-white ks-wbox ks-sBox">
	<div id="ksBoxHead">
	<div class="generalTitle clearfix">
	    <span class="title-icon"><i class="iconfont icon-myorder"></i></span>
        <span class="gTitle fsize18">红包管理</span>
	   <div class="fr">
			 <a class="ks-bt bt-def mr10"href="javascript:history.go(-1);"><i class="icon-fanhui iconfont"></i>返回</a>
			<a href="javascript:void(0)" onclick="history.go(0)" class="ks-bt bt-def"><i class="icon iconfont">&#xe6aa</i>刷新</a>
	   </div>
	</div>
	<div class="clearfix ks-top-tab">
		<div class="fl">
			<!--栏目块-->
			<ul>
		        <li class="fl  <?php if($stat==3) echo " curr" ;?>"><a href="<?php echo M_URL($this->AppName.'/Index','viewRedpacketNum',$redpacketid,GP("stat-3,appid-$this->appid",true)); ?>">红包列表</a></li>
       			<li class="fl  <?php if($stat==0) echo " curr" ;?>"><a href="<?php echo  M_URL($this->AppName.'/Index','viewRedpacketNum',$redpacketid,GP("stat-0,appid-$this->appid",true)); ?>">未使用</a></li>
        		<li class="fl  <?php if($stat==1) echo " curr" ;?>"><a href="<?php echo M_URL($this->AppName.'/Index','viewRedpacketNum',$redpacketid,GP("stat-1,appid-$this->appid",true)); ?>">已使用</a></li>
        		<li class="fl  <?php if($stat==2) echo " curr" ;?>"><a href="<?php echo  M_URL($this->AppName.'/Index','viewRedpacketNum',$redpacketid,GP("stat-2,appid-$this->appid",true)); ?>">未发放</a></li>
        		<li class="fl  <?php if($stat==4) echo " curr" ;?>"><a href="<?php echo M_URL($this->AppName.'/Index','viewRedpacketNum',$redpacketid,GP("stat-4,appid-$this->appid",true)); ?>">已发放</a></li>
		    </ul>
		    <!--栏目块-->
	    </div>
		<div class="fr">
			<label class="mr20">
	        <select class="w150 inputText bRadius5" id="keytype">
	            <option value="1" <?php if($keytype==1)echo 'selected';?>>使用人</option>
	            <option value="3" <?php if($keytype==2)echo 'selected';?>>卡号</option>
		    </select>
		    </label>
		    <input type="text" class="inputText" name="searchText" id="keyword"  value="<?php if(isset($keyword))echo $keyword;?>">
		    <input type="button" class="bg-gary searchBtn w93 fsize14 c-92 verAlignMiddle" name="searchBtn" value="搜索"  onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','viewRedpacketNum',$redpacketid); ?>','<?php echo URL_MODEL;?>')">
		</div>
	</div>
	<!--结束-->
	</div>
<div class="gSmallBox contentBox bRadius10 bg-white w100">
    <div class="infoBox">
        <div class="webConBox ">
            <div class="configTab clearfix" style="display: block">
            <form target="hidframe"  action="<?php echo M_URL($this->AppName.'/Index','bathDelRedpacketNum','',GP("p-$page->now_page"));  ?>" method="post" id="myform">
            <div class="ks-tbox">
            <table width="100%" cellpadding="0" cellspacing="0" border="0"  class="ks-table">
            <thead>
  	       <tr >
                <th class="form-in"><input name="allChecked" type="checkbox" value="allChecked" class="check-all verAlignMiddle" id="selectAll" onclick="DoCheck()"></th>
                <th>卡号</th>
                <th>面值</th>
                <th>有权使用用户</th>
                <th>使用情况</th>
                <th>发放情况</th>
                <th>管理操作</th>
            </tr>
            </thead>
                <tbody>
                <?php foreach($values as $k=>$v){ ?>
                    <tr>
                        <td class="form-in">
                            <input type="checkbox" class="verAlignMiddle mr10" name="id[]" value="<?php echo $v['id'] ?>">
                        </td>
                        <input type="hidden" name="redpacketid" value="<?php echo $v['redpacketid'] ?>">
                        <td><?php echo Field($v['redpacketnum']);?></td>
                        <td>满<?php echo Field($facevalue); ?>减<?php echo Field($minamount); ?></td>
                        <td><?php echo Field($v['username']);?></td>
                        <td><?php if($v['isuse'] == 0){echo "未使用";}else{echo "已使用";}?></td>
                        <td><?php if($v['isgive'] == 0){echo "未发放";}else{echo "已发放";}?></td>
                        <td>
                            <a href="javascript:void(0);"  onclick="Confirm('是否删除此学员？该操作不可逆!','<?php echo M_URL($this->AppName.'/Index','delRedpacketNum',$v['id'],GP('')); ?>')">
                            <i class="icon pr10 iconfont">&#xe61d</i> </a>
                         </td>
                    </tr>
                <?php }?>
                </tbody>
        </table>
           <?php echo NoC($values);?> 
           
        </div>
         </div>
	          <input type="hidden" name="batch" id="batch1" />
          </form>

        </div>
    </div>
</div>
</div>

<div class="ks-bom clearfix">
	<span class="fl">
		<button class="ks-bt bt-pue" onclick="submitform(1);"><i class="iconfont icon-lajitong"></i>批量删除</button>
	</span>
	<?php echo $page->show(3); ?>
</div>

<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
            $('.titleTab li').click(function(){
                $(this).addClass('curr').siblings().removeClass('curr');
              
            })
            loadScorllJs();
    
          function DoCheck() {
            var ch=document.getElementsByName("id[]");
            if(document.getElementsByName("allChecked")[0].checked==true)
            {
                for(var i=0;i<ch.length;i++)
                {
                    ch[i].checked=true;
                }
            }else{
                for(var i=0;i<ch.length;i++)
                {
                    ch[i].checked=false;
                }
            }
        }
        
        
        
        
function submitform(type){
	$('#batch1').val(type);
	$('#myform').submit();
}	
</script>
</body>
</html>
