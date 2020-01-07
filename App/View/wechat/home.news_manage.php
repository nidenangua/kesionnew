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
<link href="<?php echo UOOT;?>Public/app/css/wechat.css" rel="stylesheet"> 
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
</head>
<body class="ks-wrap">
	<div class="ks-wbox bRadius10">
	
					     
		<form target="hidframe">	  
		
		
		<div class="clearfix mt10">
			<div class="ks-top-search fl">
				<!--搜索-->
				<select class="w150 inputText bRadius5 fl" id="keytype">
	           	<option value="1" <?php if(isset($keytype) and $keytype==1)echo 'selected';?>>昵称</option>
				<!--<option value="2" <?php if(isset($keytype) and $keytype==2)echo 'selected';?>>内容</option>-->
		        </select>
		        
		  		 <div class="ks-top-search fr">
					<input type="text" class="sc-text" name="searchText" id="keyword" value="<?php if(isset($keyword))echo $keyword;?>"> 		
					<button type="submit" class="ks-head-search" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','infoManage'); ?>','<?php echo URL_MODEL;?>')"><i class="iconfont icon-sousuo"></i></button>
				</div>
		       	<!--<div class="fr ks-top-search">
			    	<input type="text" class="sc-text" name="searchText" id="keyword"  value="<?php if(isset($keyword))echo $keyword; ?>">
			    	<input type="button" class="sc-button fl" name="searchBtn" value="搜索" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','infoManage'); ?>','<?php echo URL_MODEL;?>')">
				</div>	-->
				
				<!--搜索-->
			</div>
		</div>	
		</form>
		<!--/widget-->
		<!--table-->
		<div class="configTab clearfix mt10" style="display: block">
            <form target="hidframe"  action="<?php echo M_URL($this->AppName.'/Index','bathDelCommuncation','',GP("p-$page->now_page"));  ?>" method="post" id="myform">
		        <table width="100%" cellpadding="0" cellspacing="0" border="0" class="ks-table" style="border-bottom:0;">
		        <thead>
			        <tr>
			            <th style="text-align: left;">选择</th>
	                    <th>序号</th>
			            <th>头像</th>
			            <th>昵称</th>
			            <th>城市</th>
			            <th>消息记录</th>
			            <th>操作</th>
			        </tr>
		        </thead>
		            <tbody>
		            <?php foreach($values as $k=>$v){ ?>
		                <tr>
		                    <td style="text-align: left;">
		                        <input type="checkbox" class="fl mr10" name="openid[]" value="<?php echo $v['fromusername'] ?>">
		                    </td>
		                    <td><?php if(!empty($values)){echo $k ;}?></td>
		                   
                            <td ><img class="js_logoBox block" src="<?php if(!empty($values)){echo Img($v['headimgurl']);}?>" width="60"></td>
						    <td><?php if(!empty($values)){echo $v['nickname'];}?>(<?php if(!empty($values)){echo $v['remark'];}?>)</td>
						    <td ><?php if(!empty($values)){echo $v['city'];}?></td>
						    <td >共<?php if(!empty($values)){echo $v['count'];}?>||未读:<?php if(empty($weidu[$k]["count"])){echo 0;}else{echo $weidu[$k]["count"]; }?></td>
                            <td class="alignCenter">
		                        <a href="javascript:void(0)" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','replyNews',$v['id'],GP('p-'.$now_page)) ?>','860px','700px');"  class="ks-bt bt-def fn"><i class="iconfont icon-bianji4"></i>消息回复</a>
		                    </td>
		                </tr>
		            <?php }?>
		            </tbody>
                  </table>
             <?php echo NoC($values);?>
             </form>
            </div>
	    <!--/table-->
	     <?php if(count($values)!=0){?>       
		<!--footer-->
		<div class="ks-bom clearfix">
			<span class="fl">
				<label style="margin-left: 10px;"><input name="allChecked" type="checkbox" value="allChecked" class="check-all" id="selectAll" onclick="DoCheck()">全选</label>
				<button class="ks-heade-button" onclick="submitform();"><i class="iconfont icon-shanchu1"></i></button>
			</span>
			<div class="fr"><?php echo $page->show(3); ?></div>	
		</div>
		<!--/footer-->
		<?php } ?>
	</div>
	
	
	<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
	<script>
		
		module.require(['$','backstage','nicescroll'],function(){
			loadScorllJs()
			$('.titleTab li').click(function(){
				$(this).addClass('curr').siblings().removeClass('curr');
			  
			})
			  
		});
		function DoCheck() {
			var ch=document.getElementsByName("openid[]");
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
		
		function submitform(){
			$('#myform').submit();
		}	
	
	</script>
</body>
</html>
