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
    <form target="hidframe" id="SOIDJF"  action="<?php  echo M_URL($this->AppName.'/Index','bacthsmall',$id,GP('p-'.$page->now_page)); ?>" method="post">
<div class="wrapper" style="margin-top:35px">

<div class="row">
<div id="manage_top" class="menu_top_fixed  p15 height73" >
    <div class="ibox-title">
        <h3 class="fl">&nbsp;&nbsp;查看拼团
        	 <!-- &nbsp;&nbsp;&nbsp;&nbsp;流动总金额&nbsp;&nbsp;<font class="defColor" size="5px">￥<?php if($allcomoney){ echo $allcomoney;}else{echo 0;} ?></font>
            &nbsp;&nbsp;&nbsp;&nbsp;总支出&nbsp;&nbsp;<font class="defColor" size="4px">￥<?php if($successcomoney){echo $successcomoney;}else{echo 0;} ?></font>
            &nbsp;&nbsp;&nbsp;&nbsp;总收入&nbsp;&nbsp;<font class="defColor" size="4px">￥<?php if($outmoney){echo $outmoney;}else{echo 0;} ?></font> -->
        </h3>
        <div class="fr">
             <div class="fl ks-top-search">
			<!--搜索-->
			<form target="hidframe" class="fr">		
				<select class="inputText bRadius5 fl" id="keytype" style="width: 150px;">
				     <option value="1" <?php if($keytype==1){echo 'selected="selected"';} ?>>用户名称</option>
		  	    </select>
			   
			
				<input type="text" class="sc-text" name="searchText" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>">
           		<input type="button" class="sc-button fl" onclick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL('h5market/Index','collagesituation',$id); ?>','<?php echo URL_MODEL;?>');" name="searchBtn" value="搜索">
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
                <li class="fl hLh40 pl10 pr10 mr20 fsize18 <?php if($s==3) echo " curr" ;?>"><a href="<?php echo M_URL('h5market/Index','collagesituation',$id,GP('status-3')); ?>" >全部</a></li>
                <li class="fl hLh40 pl10 pr10 mr20 fsize18 <?php if($s==1) echo " curr" ;?>"><a href="<?php echo M_URL('h5market/Index','collagesituation',$id,GP('status-1')); ?>" >已成团</a></li>
                <li class="fl hLh40 pl10 pr10 mr20 fsize18 <?php if($s==0) echo " curr" ;?>"><a href="<?php echo M_URL('h5market/Index','collagesituation',$id,GP('status-0')); ?>">未成团</a></li>            
        </ul>	
	</div>
	

	<div class="H5-gameListConts school-online">
		<div class="Created-push" id="ksBoxContent" style="padding:15px;">
		<table class="ks-table">
		<thead>
			<tr>
                <th>选择</th>
                <th>时间</th>
                <th>团长</th>
                <th>已参与人数</th>
                <th>团二维码</th>
                <th>状态</th>
                <th>删除</th>
                <th>操作</th>			
			</tr>
		</thead>
		<tbody>
			<?php foreach ($values as $k => $v) { ?>
            <tr>
            	<td style="width: 30px;"><input type="checkbox" class="select-checks" name="check[]" value="<?php echo $v['id'];?>"></td>
                <td>
                    <?php echo date('Y-m-d H:i:s',$v['addtime']); ?>
                </td>
                <td>

                    <img style="width: 52px;" src="<?php echo $this->upload->getHead($v['memberid'],4,0); ?>" class="cirle-user">                      
                    <span class="cirle-span"> <?php echo $v['membername']?></span>
                </td>
                <td>
                   <font style="color:#03A9F4"><?php echo $v['num']; ?></font> /<?php echo $people; ?>
                </td>
                <td class="code-hover" style="position: relative;">
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
                <td>
                    <span onclick="Confirm('是否删除？该操作不可逆!','<?php echo M_URL('h5market/Index','deletesmall',$v['id'],GP('groupid-'.$v['groupid'].',id-'.$id)); ?>')"><i class="iconfont icon-lajitong"></i></span>
                </td>
                <td class="ks-head-el">
					
                    <li>
                        <a href="javascript:addTypeChange('<?php echo M_URL('h5market/Index','checkcollage','',GP('groupid-'.$v['groupid'])); ?>','500px','400px',{title:'拼团情况'});">查看情况</a>
                    </li>                  										
						
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
    <div class="col-sm-4">
        
         <div class="checkbox fl checkbox-info" style="margin-top:20px;margin-right:10px">
            <input id="checkboxAll" name="check1" type="checkbox" class="selectAll">
            <label for="checkboxAll">
                全选
            </label>
         </div>
        <button class="btn mt10 btn-default" type="submit" onclick="reg_submit(1)" value="1" name="batch">
            删除
        </button>
    </div>
    <div class="col-sm-5 mt7 labs">

    </div>
	<div class="col-sm-7 mt7"> <?php echo $page->show(3); ?></div>
</div>
</form>
 <script>
        function reg_submit(type){
        $('#SOIDJF').submit();
     }
	var start = {
	  elem: '#start',
	  format: 'YYYY/MM/DD hh:mm:ss',
	  //min: laydate.now(), //设定最小日期为当前日期
	  max: '2099-06-16 23:59:59', //最大日期
	  istime: true,
	  istoday: false,
	  choose: function(datas){
	     end.min = datas; //开始日选好后，重置结束日的最小日期
	     end.start = datas //将结束日的初始值设定为开始日
	  }
	};
	var end = {
	  elem: '#end',
	  format: 'YYYY/MM/DD hh:mm:ss',
	  min: laydate.now(),
	  max: '2099-06-16 23:59:59',
	  istime: true,
	  istoday: false,
	 
	};
	laydate(start);
	laydate(end);	
</script>  
</body>

</html>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>