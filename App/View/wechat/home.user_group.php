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
		<!--header-->
	    <div class="ks-head-box">
	     	
		<h3 class="ks-head-title" style="border: none;">
     		微信公众号
		</h3>
	    </div>
	    <!--header-->
					     
		
		<form target="hidframe">	  
		<!--widget-->
		<?php include  CURR_VIEW_PATH . "left_menu.php";?>	
		<!--/widget-->
		<div class="clearfix ks-top-tab">
			<div class="fl ks-top-search">
				<!--搜索-->
				
	            <select class="new-form" id="keytype" style="width: 150px;height: 34px;">
	               <option value="1" <?php if(isset($keytype) and $keytype==1)echo 'selected';?>>分组名称</option>
	            </select>
	       	
	       		<div class="ks-top-search fr">
					<input type="text" class="sc-text" name="searchText" id="keyword" value="<?php if(isset($keyword))echo $keyword;?>"> 		
					<button type="submit" class="ks-head-search" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','userGroup'); ?>','<?php echo URL_MODEL;?>')"><i class="iconfont icon-sousuo"></i></button>
				</div>
					
		       	<!--<div class="fr ks-top-search">
			    	<input type="text" class="sc-text" name="searchText" id="keyword"  value="<?php if(isset($keyword))echo $keyword; ?>">
			    	<input type="button" class="sc-button" name="searchBtn" value="搜索" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','userGroup'); ?>','<?php echo URL_MODEL;?>')">	
				</div>-->
				
			<!--搜索-->
			</div>
			
			<div class="fr">
				<a class="ks-bt bt-pue mr10" href="javascript:void(0)" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','addGroup','',GP(""));  ?>','850px','600px');">
				<i class="iconfont icon-jiahao"></i>增加分组</a>
			</div>
		</div>	
		</form>
		<!--/widget-->
	     
		<!--table-->
		 <div class="bRadius10 mt10">
			
        	<form target="hidframe"  action="<?php echo M_URL($this->AppName.'/Index','bathDelGrouplist','',GP(""));  ?>" method="post" id="myform">
		        <table width="100%" cellpadding="0" cellspacing="0" border="0" class="gTable borderTable borderSo ks-table" style="border-bottom:0;">
		            <thead>
		        	<tr>
			            <th>
			            	<input name="allChecked" type="checkbox" value="allChecked" class="check-all verAlignMiddle" id="selectAll" onclick="DoCheck()">
			            </th>
			            <th>序号</th>
			            <th>分组名称</th>
			            <th>分组人数</th>
			            <th>操作</th>
			        </tr>
		        	</thead>
		            <tbody>
		            <?php foreach($value as $k=>$v){ ?>
		                <tr>
		                     <td>
		                        <input type="checkbox" class="verAlignMiddle mr10" name="id[]" value="<?php if(isset($value)){echo $v['id'];} ?>">
		                    </td>
		                    <td><?php if(isset($value)){echo $k;} ?></td>
		                    <td><?php if(isset($value)){echo $v['name'];} ?></td>
		                    <td><?php if(isset($value)){echo $v['count'];} ?></td>
		                    <td>
		                    	<div class="operate">
			                        <a  href="javascript:void(0)" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','modifyGroup',$v['id'],GP("")) ?>','850px','600px');">
			                        <em>编辑</em><i class="iconfont icon-bianji4"></i></a>
			                        <a href="javascript:void(0);"  onclick="Confirm('是否删除此学员？该操作不可逆!','<?php echo M_URL($this->AppName.'/Index','delGrouplist',$v['id'],GP('')); ?>')">
			                        <em>删除</em><i class="iconfont icon-shanchu1"></i></a>
		                        </div>
		                    </td>
		                </tr>
		            <?php }?>
		            </tbody>
                  </table>
            <?php echo NoC($value);?>
            </form>
           </div>
	    <!--/table-->
	     <?php if(count($value)!=0){?>        
		<!--footer-->
		<div class="ks-bom clearfix">
			<span class="fl">
				<button class="ks-bt bt-pue" onclick="submitform();"><i class="iconfont icon-lajitong"></i>批量删除</button>	
			</span>
			<span class="fr">
				<?php echo $page->show(3); ?>
			</span>
			
		</div>
		<!--/footer-->
		<?php } ?>
	</div>
	
	<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
	<script>
		
		module.require(['$','backstage','nicescroll'],function(){
		
			
			loadScorllJs()
			
		});
	
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
	    
	    function submitform(){
			$('#myform').submit();
		}	
	</script>
</body>
