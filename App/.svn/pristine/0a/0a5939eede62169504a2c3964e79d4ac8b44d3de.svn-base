<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit"> 
<title>专栏管理</title>
<meta name="Keywords" content="kesion教育平台"/>
<meta name="Description" content="kesion教育平台" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/course.css?<?php echoHash(); ?>" rel="stylesheet" />
<style>
    .code-box {
        position: absolute;
        background: #fff;
        left: 15px;
        padding: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.16);
        top: 40px;
        display:none;
    
    }
    .code-hover:hover .code-box{
        display:block;
    }
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

<body class="ks-wrap">  
<div class="ks-wbox bRadius10">
	<!--header-->
	
	<div class="ks-head-box clearfix">
        <div class="ks-head-nav">
            <!--标题-->
            <a href="javascript:history.go(-1);">拼团</a><em>/</em> 未成团详情<!--标题-->
                 <div class="fr">  
                    <a class="ks-setting-icon fl ml10" target="_blank" href="https://store.kesion.com/home/help#anchor57"><i class="iconfont icon-qm"></i></a>
                 </div>
        </div>
	</div>
	<!--header-->

	<!--widget-->
	<div class="ks-head-widget clearfix">
		<div class="fl">

			<div class="ks-search-box">
                
				<!--搜索框组件-->
              
				<!-- <form target="hidframe">
                    <select class="w150 inputText bRadius5  fl" id="keytype">
                            <option value="1" selected="">全部</option>
                        
                    </select>
					<div class="ks-top-search ml15 fl">
					<input type="text" class="sc-text ml0" name="searchText" id="keyword" >
					<button type="submit" class="ks-head-search" onClick="searchByClass('')"><i class="iconfont icon-sousuo"></i></button>  
					</div>
				</form> -->
				<!--搜索框组件-->
			</div>					
		</div>
	
		<div class="fr">
			<ul class="ks-head-choice">
			<li>
			<div class="ks-head-el">
				<!-- <button class="ks-heade-button ks-head-primary" type="button" onclick="choiceClick(this)"><i class="icon-filter-2 iconfont "></i></button>
				<div class="ks-head-content ks-head-content-pr w400">
				
				</div> -->
			</div>
			</li>
			<li>
			<div class="ks-head-el">
            <!-- <button class="ks-heade-button ks-head-primary" type="button" onclick="choiceClick(this)"><i class="icon-filter-2 iconfont "></i></button>    -->
			</div>
			</li>
		
		
			</ul>
		</div>
	</div>
	<!--/widget-->
	<form target="hidframe"  action="" method="post" id="myform" >
	<!--table-->
	<table class="ks-table">
		<thead>
			<tr>
                <th>时间</th>
                <th>团长</th>
                <th>已参与人数</th>
                <th>团二维码</th>
                <th>状态</th>
                <th>操作</th>			
			</tr>
		</thead>
		<tbody>
			<?php foreach ($values as $k => $v) { ?>
            <tr>
            	
                <td>
                    <?php echo date('Y-m-d H:i:s',$v['addtime']); ?>
                </td>
                <td>

                    <img src="<?php echo $this->upload->getHead($v['memberid'],4,0); ?>" class="cirle-user">                      
                    <span class="cirle-span"> <?php echo $v['username']; ?></span>
                </td>
                <td>
                   <font style="color:#03A9F4"><?php echo $v['num']; ?></font> /<?php echo $people; ?>
                </td>
                <td class="code-hover">
                    <i class="icon-erweima1 iconfont"></i>    
                   <div class="code-box">
                     <img src="<?php echo UOOT.'Images/QRcode/'.createQRcode(ROOT.'Images/QRcode/','https://'.APP_DOMAIN.'/h5market/collage?h5id='.$id.'&groupid='.$v['groupid'],'L',4,'weimenhu');?>">   
                   </div>            
                </td>
                <td>
                    <?php if($v['successful'] == 1){
                    	echo '拼团成功';
                    }elseif ($v['successful'] == 0) {
                    	if(($v['addtime']+$addtiem) < time()){
                    		echo '拼团失败';
                    	}else{
                    		echo '拼团中';
                    	}
                    } ?>
                </td>
                <td class="ks-head-el">
					<i onclick="choiceClick(this)" class="iconfont icon-more"></i>
					<div class="ks-head-content ks-head-content-pc w150" style="width:120px!important">
						<ul class="opeart">
                            <li>
                                <a href="javascript:addTypeChange('<?php echo M_URL('h5market/Index','checkcollage','',GP('groupid-'.$v['groupid'])); ?>','500px','400px',{title:'拼团情况'});">查看拼团情况</a>
                            </li>                  										
						</ul>
					</div>
				</td>
            </tr>
        <?php } ?>
		</tbody>
	</table>
	<?php echo Noc($values); ?>
	<!--/table-->

	<input type="hidden" name="batch" id="batch1" />
	<div class="ks-bom clearfix">
		
		<div class="fr">
		
		</div>
	</div>	
	
	</form>

</div>
<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
		module.require(['$','webuploader','backstage'],function(){			
			
		});
	

</script>
</body>
</html>


