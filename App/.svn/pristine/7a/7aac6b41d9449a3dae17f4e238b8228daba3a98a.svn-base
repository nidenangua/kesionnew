<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<link rel="shortcut icon" href="favicon.ico">
<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/html5.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/page.animate.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
<link href="<?php echo UOOT;?>Public/app/css/laydate.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo UOOT;?>Public/common/js/layer/laydate.js"></script>
</head>
<style type="text/css">
	.gy{background: #F8F8F8;}
	#timebox input{width: 200px;}
	.labs label{margin-top: 10px;}
    .curr{
      border-image: none;
        border-style: solid;
        border-width: 1px;
        color: #555;
        cursor: default;
        border-top: 0;
        background-color: #fff!important;
    }

    .code-box{
    	position: absolute;


    	display: none;
    	box-shadow: 0 1px 6px rgba(0,0,0,0.15);
    }


    .code-hover:hove {
    	cursor: pointer;

    }	
      .code-hover:hover .code-box {
    	display: block;
    }
</style>
<body class="gray-bg">
<div class="wrapper" style="margin-top:35px">

<div class="row">
<div id="manage_top" class="menu_top_fixed  p15 height73" >
    <div class="ibox-title">
        <h3 class="fl">&nbsp;&nbsp;独立收款插件的使用情况
        	 &nbsp;&nbsp;&nbsp;&nbsp;总数&nbsp;&nbsp;<font class="defColor" size="5px"><?php echo $page->totalput; ?></font>
            &nbsp;&nbsp;&nbsp;&nbsp;本年新增&nbsp;&nbsp;<font class="defColor" size="4px"><?php echo $yearCout; ?></font>
            &nbsp;&nbsp;&nbsp;&nbsp;本月新增&nbsp;&nbsp;<font class="defColor" size="4px"><?php echo $mCout; ?></font>
            &nbsp;&nbsp;&nbsp;&nbsp;本周新增&nbsp;&nbsp;<font class="defColor" size="4px"><?php echo $weekCount; ?></font>
            &nbsp;&nbsp;&nbsp;&nbsp;今日新增&nbsp;&nbsp;<font class="defColor" size="4px"><?php echo $dayCout; ?></font>
        </h3>
        <div class="fr">
             <div class="fl ks-top-search">
			<!--搜索-->
			<form target="hidframe" class="fr">		
				<select class="inputText bRadius5 fl" id="keytype" style="width: 150px;">
				     <option value="1" <?php if($keytype==1){echo 'selected="selected"';} ?>>网校名称</option>
		  	    </select>
			   
			
				<input type="text" class="sc-text" name="searchText" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>">
           		<input type="button" class="sc-button fl" onclick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','index'); ?>','<?php echo URL_MODEL;?>');" name="searchBtn" value="搜索">
			</form>
						
			<!--搜索-->
			</div> 
              
              
        </div>
    </div>
</div>


</div>

<div id="ksBoxContent">
	<div style="padding: 40px 0px;">
		
	<div class="H5-gameListScreen">
        <ul class=" nav nav-tabs">
            <!-- <li><input class="selectAll select-checks" name="check1" type="checkbox"></li> -->
            <!--<li>转换率<i class="iconfont icon-sort-double-down"></i></li>-->
                <li class="fl hLh40 pl10 pr10 mr20 fsize18 <?php if($s==3) echo " curr" ;?>"><a href="<?php echo M_URL($this->AppName.'/Index','index','',GP('status-3')); ?>" >全部</a></li>
                <li class="fl hLh40 pl10 pr10 mr20 fsize18 <?php if($s==1) echo " curr" ;?>"><a href="<?php echo M_URL($this->AppName.'/Index','index','',GP('status-1')); ?>" >已支付</a></li>
                <li class="fl hLh40 pl10 pr10 mr20 fsize18 <?php if($s==0) echo " curr" ;?>"><a href="<?php echo M_URL($this->AppName.'/Index','index','',GP('status-0')); ?>">未支付</a></li>            
        </ul>	
	</div>
	

	<div class="H5-gameListConts school-online">
		<div class="Created-push" id="ksBoxContent" style="padding:15px;">
		<table class="ks-table">
		<thead>
			<tr>
                <th>选择</th>
                <th>网校ID</th>
                <th>网校名称</th>
                <th>下单日期</th>
                <th>订单号</th>
                <th>状态</th>
                <th>操作</th>			
			</tr>
		</thead>
		<tbody>
			<?php foreach ($values as $k => $v) { ?>
            <tr>
                <td><input  class="select-checks" name="check[]" value="<?php echo $v["id"];?>" type="checkbox"> </td>
                <td><?php echo $v['wxid']?></td>
            	<td>                    
                    <span class="cirle-span"> <?php echo $v['sitename']?></span>
                </td>
                <td>
                    <?php echo date('Y-m-d H:i:s',$v['adddate']); ?>
                </td>
                
                <td>
                   <?php echo $v['ordersn']; ?>
                </td>
                <td>
                    <?php if($v['paystatus'] == 1){
                    	echo '已支付';
                    }elseif ($v['paystatus'] == 0) {
                    		echo '未支付';
                    } ?>
                </td>
                <td class="ks-head-el">
                  <span onclick="Confirm('是否删除？该操作不可逆!','<?php echo M_URL($this->AppName.'/Index','delete',$v['id'],GP('p-'.$now_page)); ?>')"><i class="iconfont icon-lajitong"></i></span>	
				</td>
            </tr>
        <?php } ?>
		</tbody>
	</table>
	<?php echo Noc($values); ?>

		</div>
	</div>
	<div>
	</div>
	</div>
	
</div>


<div class="footer-page " style="height:60px;">
    <div class="col-sm-5">
        <div class="checkbox fl checkbox-info" style="margin-top:20px;margin-right:10px">
            <input  class="selectAll select-checks" name="check1" type="checkbox" id="sAll">
            <label for="sAll">全选 </label>
        </div>
        <button class="btn mt10 btn-default" type="submit" name="batch" value="1">批量删除</button>
    </div>
	<div class="col-sm-7 mt7"> <?php echo $page->show(3); ?></div>
</body>

</html>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>

