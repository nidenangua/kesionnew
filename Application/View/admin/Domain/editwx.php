
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>添加应用</title>
<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/common/css/laydate.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/html5.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/reset.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<style type="text/css"> 
	.lingBlue{color: #6FB0F1;}
	.fn{float: none!important;}
	#tablist li{font-size: 16px; margin-right: 20px;cursor:pointer;}
	#tablist li.active{color: #6C79CB;font-weight: bold;}
	.Created-push{display: none;}
	#active{display: block!important;}
	.Created-ing>ul li {  margin-top: 20px; position: relative; padding-left: 160px; color: #A3A3A3; }
	.Created-ing > ul li h4 { width: 140px; }
	.Created-Content select {
	    width: 100px;
	    border: solid 1px #e5e5e5;
	    height: 30px !important;
	    border-radius: 3px;
	}
	.Created-title span:last-child{
		margin-left: 0;
	}
	.js_showBox {height: auto;border-radius: 0;display: table-cell;vertical-align: middle;text-align: center;height: 120px;position: relative;left: 90px;}
	.js_showBox img{display: inline-block;vertical-align: middle;min-height: inherit!important;width: auto!important;}
	
</style>
<body class="gray-bg">
<div class="row">
<div id="manage_top" class="menu_top_fixed  p15 height73">
    <div class="ibox-title">
        <h3 class="fl">
        	&nbsp;&nbsp;&nbsp;<?php echo $value['sitename'] ?>&nbsp;&nbsp;&nbsp;
        	网校信息编辑
        </h3>
        <div class="fr">
             <div class="fl ks-top-search">
			<!--搜索-->
				<button type="button" class="ks-bt bt-def"><i class="iconfont icon-fanhui"></i>返回</button>
			<!--搜索-->
			</div>  
              
               
        </div>
    </div>
</div>
</div>

<br />
<br />
<br />

<div id="ksBoxContent">

<form target="hidframe" method="post" action="<?php echo M_URL('home/Domain','dowxedit',$id,GP('')); ?>" class="form-horizontal" enctype="multipart/form-data">
	<input type="hidden" name="userid" value="<?php echo $value['userid']; ?>" />
	
	
<div class="Created-push" id="active">
		<ul>
			
			<li>
				<div class="Created-largetTitle">
					<span>1</span>
					<div class="Created-title">
						<span>基本信息</span>
						<span>(可修改部分)</span>
					</div>
				</div>
				<div class="form-box form-upload-box">
					<div class="Created-ing">
					<ul>
						<li>
							<input name="id" type="hidden" value=""/>
							<h4>网站名称:</h4>
							<div class="Created-Content">
								<input type="text" class="long-text" name="sitename" flag='用户名' value="<?php echo $value['sitename'] ?>">
							</div>
						</li>
						<li>
							<h4>网站开通:</h4>
							<div class="Created-Content clearfix">
								<label for="">
									<input type="radio" value="0" name="status" <?php if($value['status'] !=3){ echo 'checked';} ?>/>禁用
								</label>
								
								<label for="">
									<input type="radio" value="3" name="status" <?php if($value['status'] ==3){ echo 'checked';} ?>/>电脑&手机
								</label>
							</div>
						</li>
						
						<li>
							<h4>是否开启图片缓存:</h4>
							<div class="Created-Content clearfix">
								<label for="">
									<input type="radio" value="1" name="isbos" <?php if($value['isbos'] ==1){ echo 'checked';} ?>/>是
								</label>
								
								<label for="">
									<input type="radio" value="0" name="isbos" <?php if($value['isbos'] ==0){ echo 'checked';} ?>/>否
								</label>					
							</div>
						</li>
						<li>
							<h4>版权信息:</h4>
							<div class="Created-Content">
								<input type="text" class="long-text" name="copyright" flag='版权信息' value="<?php echo $value['copyright'] ?>">						
							</div>
						</li>

						<li>
							<h4>是否开启水印:</h4>
							<div class="Created-Content clearfix">
								<label for="">
									<input type="radio" name="isshuiyin" value="1" <?php if($isshuiyin ==1){ echo 'checked';} ?>/>是
								</label>
								
								<label for="">
									<input type="radio" name="isshuiyin" value="0" <?php if($isshuiyin ==0){ echo 'checked';} ?>/>否
								</label>
							</div>
						</li>
						<li>
							<br />
							<br />
						
						</li>
					</ul>
					
				</div>
				
					<div class="form-upload">
		          		<div class="js_uploadBox">
		          			<div class="js_showBox"><img class="js_logoBox block logo" src='<?php echo Img($value['logo']); ?>'></div>
			                <div class="btn-upload clearfix">
			                    <a href="javascript:addTypeChange('<?php echo M_URL('Index','imageslist','',GP('type-top,name-logo',true));?>','930px','610px',{title:'选择图片',type:'top'});" class="selectImageBtn">
			                    	<span class="js_uploadText">上传图片</span></a>
			                    <p>限制：2MB,支持jpg|png|gif</p> 
			                    <input type="hidden" name="logo" value="<?php echo Img($value['logo']); ?>">
			               </div>
					    </div>
		          	</div>
				</div>
				
				
			</li>
			<li>
				<div class="Created-largetTitle">
					<span>2</span>
					<div class="Created-title">
						<span>其他配置</span>
						<span>(可修改部分)</span>
					</div>
				</div>
				<div class="Created-ing">
					<ul>
						<li>
							<h4>站点标题:</h4>
							<div class="Created-Content">
								<input type="text" class="long-text" name="seotitle" flag='站点标题' value="<?php echo $value['seotitle'];?>">						
							</div>
						</li>
						<li>
							<h4>网校地区:</h4>
							<div class="Created-Content">
								<select class="long-text" name="areaid">
									<?php if(isset($city)){ 
									    echo "<option value='0'>请选择</option>";
										foreach($areas  as $k=>$v){
					                       $html="<option value='$v[id]' ";
					                       if($v['id']==$areaid){
					                           $html=$html."selected = 'selected'";
					                       }
					                       $html=$html.">".KS_INDENT($v['depth'])."$v[city]</option>" ;
					                       echo $html;
					                    }
								  	}else{echo "<option value='0'>请选择</option>";}?>
								</select>
							</div>
						</li>
						<li>
							<h4>网站META关键词:</h4>
							<div class="Created-Content">
								<textarea name="metakeywords" rows="" cols=""><?php echo $value['metakeywords']; ?></textarea>	
								<div class="lingBlue">针对搜索引擎设置的网页关键词，多个关键词请用，号分隔</div>			
							</div>
						</li>
						
						<li>
							<h4>网站META网页描述:</h4>
							<div class="Created-Content">
								<textarea name="metadescription" rows="" cols=""><?php echo $value['metadescription']; ?></textarea>	
								<div class="lingBlue">针对搜索引擎设置的网页关键词，多个关键词请用，号分隔</div>			
							</div>
						</li>			
						
						<li>
							<h4 style="top: 0px;">网校介绍:</h4>
							<div class="Created-Content">
							<!--富文本框-->	
							<?php echo ks_editor('intro',$value['intro'],$type='1',$att='',$width='780px',$height='220px');?>			
							</div>
						</li>
					</ul>
					
				</div>
				
				
			</li>
					</ul>
		
	</div>
<div style="height:180px;"></div>
</div>	

	
	<div class="footer-page">
        <div class="col-sm-5"></div>
        <div class="col-sm-6 mt10">
            <button type="submit" class="btn btn-primary btn-s-md bt-pue"  style="background: #DA4F0C;border-color: #DA4F0C;">确定修改</button>
            <a href="javascript:history.go(-1);" class="btn btn-default btn-s-md" style="background: #DBDBDB;color: #333!important;">取消修改</a> 
        </div>
    </div>
</form>	
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
</body>
<script type="text/javascript">
	$("#tablist li").click(function(){
		
		$("#tablist li").removeClass("active"); 
		$(this).addClass("active");
		
		var index = $(this).index();
		$(".Created-push").removeAttr("id")
		console.log(index);
		$(".Created-push").eq(index).attr("id","active");
	})
</script>
</html>
