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
<link href="<?php echo UOOT;?>Public/app/css/wechat.css" rel="stylesheet"> 
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
</head>
<body class="ks-wrap">	
	<div class="ks-wbox bRadius10">
		
		<form target="hidframe">	  
		
		<div class="clearfix ks-top-tab" >
			<div class="fl">
			<!--栏目块-->
			<select class="w150 inputText bRadius5 mr20" onchange="location.href=this.value">
				<option value="<?php echo M_URL($this->AppName.'/Index','fansList','',GP("stat-3,appid-$this->appid",true)); ?>"<?php if($stat==3) echo " selected" ;?>>粉丝列表</option>
				<option value="<?php echo M_URL($this->AppName.'/Index','fansList','',GP("stat-1,appid-$this->appid",true)); ?>"<?php if($stat==1) echo " selected" ;?>>男</option>
				<option value="<?php echo M_URL($this->AppName.'/Index','fansList','',GP("stat-2,appid-$this->appid",true)); ?>"<?php if($stat==2) echo " selected" ;?>>女</option>
			</select>
			<!--栏目块-->
			</div>
			<div class="fl">
			<label class="fl mr10 c-017" style="line-height: 38px;">分组</label>
			<select class="w150 inputText bRadius5 fl mr10" name = "tag_id" id="post_d"  onclick="post_se(this)">
			<?php foreach($groups as $k=>$v){ ?>
			<option  value ="<?php echo $v['tag_id'];?>"><?php echo $v['name'];?></option>
			<?php }?>
			</select>
			
			<label class="mr10">
			<select class="w150 inputText bRadius5" id="keytype">
			<option value="1" <?php if($keytype==1)echo 'selected';?>>昵称</option>
			<option value="2" <?php if($keytype==2)echo 'selected';?>>备注</option>
			</select>
			</label>
			<div class="ks-top-search fr">
				<input type="text" class="sc-text" name="searchText" id="keyword" value="<?php if(isset($keyword))echo $keyword;?>"> 		
				<button type="submit" class="ks-head-search" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','fansList'); ?>','<?php echo URL_MODEL;?>')"><i class="iconfont icon-sousuo"></i></button>
			</div>
			
			<!--<div class="fr ks-top-search">
			<input type="text" class="sc-text" name="searchText" id="keyword"  value="<?php if(isset($keyword))echo $keyword;?>">
			<input type="button" class="sc-button" name="searchBtn" value="搜索" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','fansList'); ?>','<?php echo URL_MODEL;?>')">	
			</div>-->
			</div>
			
			<div class="fr">
				<a class="ks-bt bt-pue mr10" onclick="addTypeChange('<?php echo  M_URL($this->AppName.'/Index','fansCatch',"",GP("stat-0,appid-$this->appid",true)); ?>','500px','160px');">从微信同步到本站</a>
				<a class="ks-bt bt-pue" href="<?php echo M_URL($this->AppName.'/Index','userGroup','',GP("stat-4,appid-$this->appid",true)); ?>">分组管理</a>
			</div>
		</div>	
		</form>
		
		<!--table-->
		<div class="bRadius10 mt20" >
			<form target="hidframe"  action="<?php echo M_URL($this->AppName.'/Index','bathDivedeFanslist','',GP("p-$page->now_page"));?>" method="post" id="myform">
			
			<table width="100%" cellpadding="0" cellspacing="0" border="0"  class="ks-table">
			<thead>
			<tr >
			<th>选择</th>
			<th>序号</th>
			<th>微信头像</th>
			<th>昵称(备注)</th>
			<th>性别</th>
			<th>关注时间</th>
			<th>城市</th>
			<th>所属分组</th>
			<th>操作</th>
			</tr>
			</thead>
			<tbody><input type="hidden"  name ="tag_id" id="post-se" value=""/>
			<?php foreach($values as $k=>$v){ ?>
			<tr>
			<td>
			<input type="checkbox" class="verAlignMiddle mr10" name="openid[]" value="<?php echo $v['openid'] ?>" >
			<input type="hidden" value="<?php echo $v['id'] ?>" name="id[]" id="id">   		
			</td>
			<td><?php echo $k;?></td>
			<td><img class="js_logoBox block" src="<?php echo Img($v['headimgurl']);?>" width="40"></td>
			<td><?php echo $v['nickname'];?>(<?php echo $v['remark'];?>)</td>
			<td><?php if(isset($v['sex']) and $v['sex'] == 0){echo "未知";}
			elseif(isset($v['sex']) and $v['sex'] == 1){echo "男";}else{echo "女";}?></td>
			<td><?php echo  date("Y-m-d",$v['subscribe_time'])?></td>
			<td><?php echo Field($v['province'].$v['city']);?></td>
			   <?php 
			$groupid = json_decode($v['groupid'],TRUE);
			
			$tagModel = M('app_wechat_tag');
			$tt ="";
			foreach($groupid as $vt){
				$name = $tagModel->getOne("  name"," where  wxid =". $this->wxid .' and tag_id = '.$vt);
			$tt .=$name."\r\n";
			       };
			                                  
			 ?>
			<td><?php if(!empty($tt)){echo $tt;}else{echo '.....';}?></td>
			<td>
			<div class="operate">
			<a href="javascript:void(0)" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','modifyRemark',$v['id'],GP(""));?>','850px','600px');"><em>编辑</em><i class="iconfont icon-bianji4"></i></a>
			<a href="javascript:void(0);"  onclick="Confirm('是否删除此粉丝并拉黑？该操作不可逆!','<?php echo M_URL($this->AppName.'/Index','delFanslist',$v['id'],GP("p-$page->now_page,openid-$v[openid]")); ?>')"><em>删除</em><i class="iconfont icon-shanchu1"></i></a>
			</div>
			</td>
			</tr>       
			<?php }?>
			</tbody>
			</table>
			<?php echo NoC($values);?>     
		</div>
	    <!--/table-->
	    <?php if(count($values)!=0){?>  
		<!--footer-->
		<div class="ks-bom clearfix">
			<span class="fl">
				<label class="mr20 fl"><input name="allChecked" type="checkbox" value="allChecked" class="check-all" id="selectAll" onclick="DoCheck()">全选</label>
				<button class="ks-heade-button" onclick="submitform();"><i class="iconfont icon-shanchu1"></i></button>
			</span>
			<div class="fr"><?php echo $page->show(3);?></div>
		</div>
		<!--/footer-->
		<?php } ?>
	</div>
	
	
	<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
	<script>
		
		module.require(['$','backstage','nicescroll'],function(){
		
			
			loadScorllJs()
			
		});
	
	
	</script>


	
	    <div  class="rightModel e bRadius10"> 	
		    <div class="gSmallBox contentBox w100">	
				<div class="bRadius10 ">
					
				           
				    
					<div id="ksBoxFooter" style="height: 120px;">
					
					</div>       
				        </form>
				    </div>
				</div>
    		</div>





<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>

$('.titleTab li').click(function(){
	$(this).addClass('curr').siblings().removeClass('curr');
  
})

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

function post_se(e){
	$("#post-se").val(e.value);
	//console.log($("#post-se").val());
	
}
$(function(){
	$("#post-se").val($("#post_d").val());
})
    
</script>
</body>
</html>






