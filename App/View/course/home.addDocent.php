


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
	<title>添加教师</title>
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/imageslist.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<!--	--><?php //var_dump(12321);die;?>
</head>
<body class="ks-wrap pt0">

	<!--开始-->
	<div class="clearfix ks-top-tab">
		<div class="fl">
			<!--栏目块-->
			<!--<div class="form-tip clearfix">
			    <span class="form-tip-blick"></span>
			    <span class="form-tip-word">添加教师</span>
			</div>-->
		    <!--栏目块-->
	    </div>
		<div class="fr ks-top-search">
			<!--搜索-->
			<form target="hidframe" >
			<div class="fr ks-top-search">
				
				<input type="text" class="sc-text" name="searchText" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>">
				<button type="submit"  class="ks-head-search" name="searchBtn"  onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','addDocent',''); ?>','<?php echo URL_MODEL;?>');"/>
					<i class="iconfont icon-sousuo"></i>
				</button>
			</div>	
			</form>
			<!--搜索-->
		</div>
	</div>	
	<!--结束-->

	
    <form action="<?php echo M_URL($this->AppName.'/Index','addteachers',$courseid,GP(''));?>" method="post" id="myform">
	<div class="Alert-conts clearfix" >
		<ul class="Aconts-ul">
			<li class="card-li add" onclick="skip('<?php echo M_URL($this->AppName.'/Index','addUser',$courseid,GP("usertype-1")) ?>');">							
				<div class="Aconts-box">								
					<div class="Alert-img" autoimg="1,1">					
						<i class="iconfont icon-tianjia1"></i>
					</div>
					<div class="Alert-mark add-add">添加</div> 					
				</div>
			</li>
			<?php echo NoC($teachers);?>	 
			<?php  foreach($teachers as $key=>$v){ ?>
			<li class="card-li"><div class="Aconts-box">
			<div class="Alert-img" autoimg="1,1" style="background-image:url('<?php echo $this->upload->getHead($v['userid']);?>');">
			<div class="ctrShaw"><div class="Alert-shadow"></div><i class="iconfont icon-xuanze3"></i></div>
			</div>
			<div class="Alert-mark"><?php echo empty($v['name'])?$v['username']:$v['name'];?></div> 
				<input type="checkbox" class="select-check" id="radio<?php echo Field($v["userid"])?>" name="docent[]" value="<?php echo Field($v["userid"])  ?>">
			</div>
			</li>	
			<?php } ?>
			 
		</ul>
    </div>
    <div class="clearfix ks-popup-footer">

		    <div class="fl mt20">
		    	 <label for="selectAll" style="margin-top:5px;">
		        	<input type="checkbox" id="selectAll" class="fl" />全选
		        </label>
		        <?php if($type == 1){ ?>
		        <input type="button" class="ks-bt bt-pue" id="abc"  value="确认" name="confirm" />
		        <?php }else{ ?>
		        <input type="submit" class="ks-bt bt-pue"   value="确认" name="confirm" />
		        <?php } ?>
		       
		    </div>
		   <div class="fr mt20"><?php echo $page->show(3,5); ?></div>

	</div>
   
   </form>
    <script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
	<script>
		module.require(['$','backstage'],function(){
			
			radiotabs('temptype','.radio-tabs');
			uploadView('180','140');
			
			$('.Alert-conts').css('min-height',window.innerHeight-160);
			/**图片选中***/
			$(document).on('click','.Aconts-ul li',function(){
				$(this).find("input[type='checkbox']").prop('checked',true);
				$(this).addClass("onYes");		
				$(this).find(".ctrShaw").show();//显示打钩
			
			}).on('click','.onYes',function(){
				$(this).find(".ctrShaw").hide();
				$(this).removeClass("onYes");
				$(this).find("input[type='checkbox']").prop('checked',false);
			}).on('click','#selectAll',function(){
				this.checked ? (
					$(".Aconts-ul li").find("input[type='checkbox']").prop('checked',true),
					$(".Aconts-ul li").find(".ctrShaw").show()
				) : (
					$(".Aconts-ul li").find("input[type='checkbox']").prop('checked',false),
					$(".Aconts-ul li").find(".ctrShaw").hide()
				)
			})
		})
	</script>

</body>
</html>









