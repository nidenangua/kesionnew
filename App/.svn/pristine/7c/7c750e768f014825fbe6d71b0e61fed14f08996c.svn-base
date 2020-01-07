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
</head>
<style>
    .topCourseBox { padding: 20px 420px 0px 200px;position: relative; background: #FFFFFF;border-top:1px solid #eee;min-height:130px}   
    .topCourseBox-right{position: absolute;height: 120px; top: 0px; right: 0px;}
    .topCourseBox-bottom{position: absolute;height: 30px; bottom: 20px; right: 0px; line-height: 30px; }
    .topCourseBox-img{width: 190px; height: 130px; position: absolute; left: 0px; top: 20px; cursor:pointer;}   
    .topCourseCont-left{position: absolute;  left: 220px; top: 16px; height:100%;}  
    .topCourseCont-right{ height:130px; overflow: auto; position:relative ; left:150px;} 
    .topCourseCont-title {height:30px;line-height:30px;font-size:16px}
    .topCourseBox-top {position: absolute;right: 20px;top:20px;color: #72c0f2;}
    .topCourseBox-top li {display: inline-block;color: #72c0f2;font-size:14px}
    .ks-title {font-size:14px;margin:15px 0}
    .packageOrderBox {
    	border: 1px solid #f5dcdc;
    width: 358px;
    padding: 14px 10px;
    border-radius: 2px;
    background-color: #fbfafa;
	    box-shadow: 0 2px 4px 0 rgba(0,0,0,.09);
	    overflow: hidden;
	    transition-duration: .2s;
	    transition-property: visibility,opacity;
	    position: absolute;
	    right: -86%;
	    top: 76px;
	    z-index: 5;
	    cursor: default;
	    opacity: 0;
	       height: 28px;
	    font-size: 14px;
	    color: #191717ba;
    }
</style>
<body class="ks-wrap">  
	<!--通用头部-->
 <div class="ks-wbox bRadius10">
	<div class="ks-head-nav">
	<!--标题-->
	    <a href="">专栏管理</a><span><em>/</em>连载内容</span>
	<!--标题-->
	</div>
	<div class="topCourseBox">
	

		<div class="topCourseBox-img" onclick="addTypeChange('','930px','610px',{title:'选择图片',type:'top'});">
				<img onerror="this.src='<?php echo XImg($Info['defaultpic'])?>'" src="<?php if($Info['defaultpic']){echo Img($Info['defaultpic']);}else{echo nopic(12);}?>" class="defaultpic" width="100%" height="100%">
		</div>
		
	
		<div class="topCourseCont">
			<div class="topCourseCont-left">
				<div class="topCourseCont-title"><?php echo $Info['title']?></div>

				<div class="mt10">
					<div class="mb10">
							<span class="fsize14 c-92">学生人数： <?php echo $Info['soldnum']?>	</span>		
					</div>				
                </div>
                
                <div class="form-row mt10 clearfix">
                    <span class="name fl">是否上架：</span>
                    <!--<div class="form-switch fl ml20" open-value="2" >-->
                        <span style="top:6px; position: relative;left: 48px;" class="link-switch<?php if($Info['status'] == 2){ echo ' open'; } ?>" data-off="<?php echo M_URL($this->AppName.'/Index','audited',$Info['columnid'],GP('status-0,p-'.$now_page));?>" data-open="<?php echo M_URL($this->AppName.'/Index','audited',$Info['columnid'],GP('status-2,p-'.$now_page)); ?>"><i></i></span>
                    <!--</div>-->
				
				 </div>
			</div>



            <div class="topCourseBox-top">
                <ul class="clearfix">
                    <li><a href="<?php echo M_URL($this->AppName.'/Index','addcolumn',$Info['columnid'])?>">编辑专栏</a></li>丨
                    <li><a href="javascript:addTypeChange('<?php echo M_URL($this->AppName.'/Index','share',$Info['columnid'],GP(''));?>','700px','400px',{title:'推广'});">推广</a></li>
                    <!--<li>分享设置</li>-->
                </ul>
            </div>
<!-- 			<div class="topCourseBox-bottom">

				<label class="fl  "><input type="checkbox" class="fl" id="recommend">是否推荐</label>


				<label class="fl"><input type="checkbox" class="fl" id="slide" name="slide" checked="">是否幻灯展示</label>

				<label class="fl "><input type="checkbox" class="fl" id="hot">是否热门</label>

			</div> -->


		</div>
	
	</div>
</div>
	<!-- //通用头部-->


<div class="ks-wbox mt20 bRadius10">
    <div class="ks-head-widget clearfix" style="margin-top:0">
    <div class="ks-search-box fl">
        <form target="hidframe">
        <!--搜索框组件-->
        <select class="w150 inputText bRadius5 fl mr10" id="keytype" onchange="location.href='<?php echo M_URL($this->AppName.'/Index','serialization',$id); ?>?keytype-'+this.value;">
			<option value="0" <?php if($keytype==0){echo 'selected="selected"';} ?>>全部</option>
			<?php if(ismoduleopen($this->wxid,6,4)){?><option value="4" <?php if($keytype==4){echo 'selected="selected"';} ?>>图文</option><?php }?>
			<?php if(ismoduleopen($this->wxid,6,3)){?><option value="3" <?php if($keytype==3){echo 'selected="selected"';} ?>>音频</option><?php }?>
			<?php if(ismoduleopen($this->wxid,6,1)){?><option value="1" <?php if($keytype==1){echo 'selected="selected"';} ?>>点播</option><?php }?>
			<?php if(ismoduleopen($this->wxid,6,2)){?><option value="2" <?php if($keytype==2){echo 'selected="selected"';} ?>>直播</option><?php }?>
		</select>
        <div class="ks-top-search fl">
            <input type="text" class="sc-text" name="searchText" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>">
            <button type="submit" class="ks-head-search" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','serialization',$id); ?>','<?php echo URL_MODEL;?>')">
            <i class="iconfont icon-sousuo"></i>
            </button>
        </div>
        <!--搜索框组件--></form>
    </div>
    <div class="fr">
        <ul class="ks-head-choice">  
        <li>
            <div class="ks-head-el">
            <a class="ks-heade-button ks-head-primary" type="button"  onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','addshop',$Info['columnid']);  ?>','1000px','650px',{title:'添加商品',type:'top'});">
                <i class="icon-jiahao iconfont "></i>添加商品</a>
            </div>
        </li>
      
        </ul>
    </div>
    </div>
    <div class="ks-title">
        专栏内单品(<?php echo count($values)?>)
    </div>
      <form action="<?php  echo M_URL($this->AppName.'/Index','deletedf',$id) ?>" method="post" id="myform">
         <table class="ks-table">
            <thead>
                <tr>
                    <td style="width: 30px;">选择</td>
                    <td style="text-align: left;">名称</td>
                    
                    <td>单品购买量</td>
                    <td>类型</td>
                    <td>上架时间</td>
                    <td>状态</td>
                    <td>单品价格</td>
                    <th>排序</th>	
                    <td>操作</td>
                </tr>                                               
            </thead> 
            <tbody>
                <?php foreach($ary_link as $k => $v){?>
                    <tr>
                    <td>
                        <input type="checkbox" class="select-checks" name="aid[]" value="<?php echo $v['id']?>"> 
                    </td>
                    <td><img src="<?php if(!empty($v["defaultpic"])){echo Img($v["defaultpic"]);}else{ echo nopic(0);} ?>" class="defaultpic" style="width:120px;float:left;height: 105px;"><span style="margin-top:20px;display:block;float:left;padding-left:20px"><?php echo $v['title']?></span></td>
                    <td> <?php echo $v['soldnum']?></td>
                    <td> <?php echo getCourseTypeName($v['courseType']);  ?></td>
                    <td><?php echo date("Y-m-d H:i:s",$v['adddate'])?></td>
                    <td>
                    	<?php if($v['courseType']==5){ ?>
                    		<span class="link-switch<?php if($v["status"]==2){ echo ' open' ?><?php }  ?>" data-off="<?php echo M_URL('class/Ajax','audited',$v['infoid'],GP('appid-30,classlevel-'.$v['classlevel'],true));?>" data-open="<?php echo M_URL('class/Ajax','audited',$v['infoid'],GP('appid-30,classlevel-'.$v['classlevel'],true)); ?>"><i></i></span>
                    	<?php }else{ ?>
                    		<span class="link-switch<?php if($v["status"]==2){ echo ' open' ?><?php }  ?>" data-off="<?php echo M_URL('course/Index','down',$v['infoid'],GP('appid-6,courseType-'.$v['courseType'],true));?>" data-open="<?php echo M_URL('course/Index','up',$v['infoid'],GP('appid-6,courseType-'.$v['courseType'],true)); ?>"><i></i></span>
                    	<?php } ?>
                    </td>
                    <td>
                        <?php if($v['chargetype']==1){echo $v['price'];}else{echo '免费';}?>
                    </td>
                    <td style="position: relative;" >
                    	<?php echo $v['orderid'] ?><a  onclick="show(this)" style="color: blue;margin-left: 14px;display: inline-block;cursor: pointer;">修改</a>
                    	<div class="packageOrderBox active">
                                            排列至第
                            <input placeholder="输入数字" type="text" onkeyup="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'')}else{this.value=this.value.replace(/\D/g,'')}" onafterpaste="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'0')}else{this.value=this.value.replace(/\D/g,'')}" value="" class="orderbox">
                            位
                            <a class="" onclick="tij(this,<?php echo $v['id'];?>)">确定</a>
                            <a  onclick="qx(this)">取消</a>
                        </div>
                    </td>
                    <td class="ks-head-el">
                        <i onclick="choiceClick(this)" class="iconfont icon-more"></i>
                        <div class="ks-head-content ks-head-content-pc w100">
                            <ul class="opeart">
                                <li > <a href="<?php if($v['courseType']!=5){echo M_URL('course/Index','basics',$v['infoid'],GP('appid-6,courseType-'.$v['courseType']));}elseif($v['courseType']==5){echo M_URL('class/Index','basics',$v['infoid'],GP('appid-30,classlevel-'.$v['classlevel'],true));}?>">编辑</a> </li>
                                <li ><a href="<?php echo $v['jumpurl'];?>" target="_blank">预览</a></li>
                                <li ><a href="javascript:addTypeChange('<?php if($v['courseType']==5){echo M_URL('class/Index','share',$v['infoid'],GP('appid-30,classlevel-'.$v['classlevel'],true));}else{echo M_URL('course/Index','share',$v['infoid'],GP('appid-6,courseType-'.$v['courseType'],true));}?>','700px','400px',{title:'推广'});">分享</a></li>
                            
                                <!-- <li > <a href="javascript:Confirm('是否删除此<?php echo $title;?>？该操作不可逆！','')"> 删除</a> </li> -->
                            </ul>
                        </div>
                    </td>
                <tr>
                <?php }?>
            </tbody>
        </table>
	  </form>
        <?php echo Noc($ary_link); ?>

    <div class="ks-bom clearfix">
		<div class="fl">
			<label class="mr20 fl"><input type="checkbox" class="selectAll" >全选</label>
			<button type="button" class="ks-heade-button mr10" onclick="submitform(1)"><i class="iconfont icon-shanchu1"></i></button>

		</div>
		<div class="fr">
		   <?php echo $page->show(3); ?>
		</div>
	</div>

    </div>


<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
module.require(['$','backstage'],function(){
	$('.link-switch').each(function(){
		setLinkSwitch(this)
	})
	$(document).click(function(){
//		close()
		
	});

	
});
function submitform(type){
    $('#myform').submit();
}

/*function show(target){
	$(target).next('.packageOrderBox').show();	
	cancelBubble()

}
*/
function tij(target,id){
	var order = $(target).siblings('.orderbox').val();
	var tjurl = '<?php  echo M_URL($this->AppName.'/Index','changeorder') ?>'+'/'+id+'?orderid-'+order;
	$.ajax({
		type:"post",
		url:tjurl,
		success:function(res){
			Alert('修改成功',2)
			$(target).parent('.packageOrderBox').hide();
			 window.location.reload()
		}
	});
}

function qx(target){
	$(target).parent('.packageOrderBox').hide();
	cancelBubble();
}


function cancelBubble(){
	
  var e = window.event || arguments[0];
  if ( e && e.stopPropagation ) {   
      e.stopPropagation()
  } else {
      window.event.cancelBubble = true
  }
};

function show(target){
	
	var $siblingTarget =$(target).next('.packageOrderBox');
	if($siblingTarget.attr('flag') === 'true' || $siblingTarget.attr('flag') === undefined){
		close();
		cancelBubble();
		$siblingTarget.attr('flag','false').css({
			display:'block',
			opacity:0
		});

		if($siblingTarget.offset().top > window.innerHeight/2){
			$siblingTarget.addClass('ks-head-content-pb').animate({
				opacity:1,
				bottom:0
			},300)
		}else{
			$siblingTarget.animate({
				opacity:1,
				top:0
			},300)
			
		}
	}
};

function close(){
	$('.packageOrderBox').each(function(){
		if($(this).attr('flag') === 'false'){
			$(this).attr('flag','true');
			if(this.className.indexOf('ks-head-content-pb') === -1){
			 	$(this).animate({
					opacity:0,
					top:0
				},300,function(){
					$(this).css({
						display:'none'
					})
				})
			 	
			 }else{
			 	$(this).animate({
					opacity:0,
					bottom:0
				},300,function(){
					$(this).css({
						display:'none'
					}).removeClass('ks-head-content-pb')
				})
			 }

		}
		
	})
};


</script>
</body>
</html>


