<!DOCTYPE html>
<html>
<head lang="en">
<meta charset="UTF-8">
<title>fgfdgdf</title>
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/fonts/iconfont.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<!-- <link href="<?php echo UOOT;?>Public/app/css/course.css?<?php echoHash(); ?>" rel="stylesheet" /> -->
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<style>
   .footer-page .col-sm-7 .page-box{margin-top:15px !important}
    
    .con-txt1{margin-left: 15px}
    .con-img {border-radius: 0}
    .footer-page {
        height: 60px;
    }
    .menu_top_fixed {
        height: 73px;
    }
    .tabs-container {
        padding-top: 55px;
    }
    .down{display:none}
        .mt7{margin-top:7px;}
     .down {
    display: none;
}
.pos3{
    position: relative;
    top: 4px;
}
.mrl{
    line-height: 36px;
    margin-right: 10px;
}
.w150 {width:150px}

</style>
</head> 
<body class="gray-bg p15" >
<form target="hidframe" id="SOIDJF"  action="<?php  echo M_URL($this->AppName.'/Index','batch','',GP('p-'.$page->now_page)); ?>" method="post">
	<input type="hidden" name="batch" id="batch1" />
<div class="wrapper mt40" id="scorll" >
	<div class="row">
		<div id="manage_top " class="menu_top_fixed p15">
			<div class="ibox-title">
				<h3 class="fl">课程管理</h3>
				<!-- <a class="btn btn-info btn-rounded mt7 btn-s-md " href="<?php echo M_URL($this->AppName.'/index','basics','',GP('')) ?>" 
                style="margin-left:15px">添加课程</a> -->
				<div class="search-main fr">
					<div class="fl" style="margin-right: 100px;">
				    	课程总数：<span style="font-size: 20px;color: #0e33b7;"><?php echo $options['totalput'];?></span>
				    </div>
				    <div class="fl" style="margin-right: 100px;">
				    	本月新增数量：<span style="font-size: 20px;color: #0e33b7;"><?php echo $montncount;?></span>
				    </div>
				    <div class="fl" style="margin-right: 100px;">
				    	今日新增数量：<span style="font-size: 20px;color: #0e33b7;"><?php echo $daycount;?></span>
				    </div>
					<form>
                <div class="search-box w180  fl" >
                       <label class="fl control-label">
							课程类型
						</label>
                 <select class="form-control  input-sm w90  inline" onchange="getval(this,'<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','index'); ?>','coursetype','<?php echo URL_MODEL;?>')">
                            <option value="0" <?php if($coursetype == 0)echo 'selected=selected'; ?>>所有</option>
							<option value="1" <?php if($coursetype == 1)echo 'selected=selected'; ?>>点播</option>
							<option value="2" <?php if($coursetype == 2)echo 'selected=selected'; ?>>直播</option>
                            <option value="3" <?php if($coursetype == 3)echo 'selected=selected'; ?>>音频</option>
                            <option value="4" <?php if($coursetype == 4)echo 'selected=selected'; ?>>图文</option>
						</select>
                </div>
                <div class="search-box w150  fl">
                    <label class="fl control-label">
                        条件
                    </label>
                    <select class="form-control  input-sm w90  inline"  id="keytype">
                        <option value="0" <?php if($keytype == 0)echo 'selected=selected'; ?>>请选择</option>
                        <option value="1" <?php if($keytype == 1)echo 'selected=selected'; ?>>课程名</option>
                        <option value="2" <?php if($keytype == 2)echo 'selected=selected'; ?>>机构id</option>
                    </select>
                </div>
                <div class="search-box w240 mt7 fl" >
                    <div class="input-group">
                        <input type="text" class=" form-control input-sm w180 fl" id="keyword" value="<?php if($keyword){echo $keyword;}?>" >
                  <span class="input-group-btn ">
                        <button  type="submit" class="btn btn-sm btn-default  fl"  onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','index'); ?>','<?php echo URL_MODEL;?>')">搜索</button>
                  </span>
                    </div>
                </div>
                </form>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="tabs-container">
			<ul class="nav nav-tabs">
<li class="<?php if($stat==3) echo "active"; ?>"> <a href="<?php echo M_URL($this->AppName.'/Index','index','',GP("status-3")); ?>"> 所有课程</a></li>
<li class=" <?php if($stat==0) echo "active"; ?>"> <a href="<?php echo M_URL($this->AppName.'/Index','index','',GP("status-0")); ?>">未审核</a></li>
<li class=" <?php if($stat==4) echo "active"; ?>"> <a href="<?php echo M_URL($this->AppName.'/Index','index','',GP("status-4")); ?>">已审核</a> </li>
<li class=" <?php if($stat==5) echo "active"; ?>"> <a href="<?php echo M_URL($this->AppName.'/Index','index','',GP("status-5")); ?>">回收站</a> </li>
<li class=" <?php if($stat==6) echo "active"; ?>"> <a href="<?php echo M_URL($this->AppName.'/Index','index','',GP("status-6")); ?>">分销</a> </li>

<!--                <span class="fr mrl" >
                   学生个数
                   <img  src="<?php echo UOOT;?>Public/admin/images/icon_排序升序.png" width="16" class="up pos3" id="c1">
                   <img src="<?php echo UOOT;?>Public/admin/images/icon_排序降序.png" width="16" class="down pos3"  id="c2">
              </span>
              <span class="fr mrl" >
                  应用个数
                   <img  src="<?php echo UOOT;?>Public/admin/images/icon_排序升序.png" width="16" class="up pos3"  id="c3">
                   <img src="<?php echo UOOT;?>Public/admin/images/icon_排序降序.png" width="16" class="down pos3"  id="c4">
              </span> -->
			</ul>
			<div class="tab-content">
				<div class="tap-pane" style="display: block;margin-bottom:45px">
					<div class="panel-body">
						<table class="ks-table">
		<thead>
			<tr>
			<th style="width: 59px;">选择</th>
			<th>网校ID</th>
			<th>课程ID</th>
			<th style="text-align: left;">标题</th>
			<th>课程类型</th>
			<th>所属网校</th>
			<th>主讲老师</th>
			<th>学员数量</th>
			<th style="width: 80px;">
			<!-- <?php if($commoncount == 0 ){ ?> -->
			 <a  class="desc" href="<?php echo M_URL('course/Index','index','',GP('commoncount-1'))  ?>" >价格<i class="desc-i"></i></a>	
			<!-- <?php }else{ ?>
			<a class="asc" href="<?php echo M_URL('course/Index','index','',GP('commoncount-0'))  ?>">价格<i class="asc-i"></i></a>
			<?php } ?>	 -->	
			</th>
			<th>连载</th>
<!-- 			<?php if($courseType==2){ ?>
			<th>上课</th>
			<?php }?> -->
			<th>浏览量</th>
			<th>添加日期</th>
			<th>是否通过审核</th>
			<th>删除</th>
			<th>分销奖励</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($values as $v){ ?>
			<tr>
				<td style="width: 30px;"><input type="checkbox" class="select-checks" name="check[]" value="<?php echo $v['courseid'];?>"></td>
				<td><?php echo $v['wxid'];?></td>
				<td><?php echo $v['courseid'];?></td>
				<td style="text-align: left;"><a href="<?php echo $v['jumpurl'];?>" target="_blank"><?php echo $v['title'];?></a></td>
				<td ><?php echo $v['typetitle'];?></td>
				<td ><?php echo $v['sitename'];?></td>
				<td><?php echo $v['name'];?></td>
				<td><?php echo $v['studentcount'];?></td>
				<td><?php if($v['price']==0||$v['chargetype']!=1){echo '免费';}else{echo $v['price'];} ?></td>
				<td>
				<?php if($v['coursehour']==1){?>
				<a href="<?php echo M_URL($this->AppName.'/Index','period',$v['courseid'],GP(''));?>" ><?php echo $v['keshicount'] ?></a>
				<?php }else{echo '单'.$v['typetitle'];}?>
				</td>
<!-- 				<?php if($courseType==2){ ?>
				<td>
					<?php if($v['livetype']==0){ ?>
					<a href="javascript:addTypeChange('<?php echo M_URL($this->AppName.'/Index','startlive',$v['courseid'],GP(''));?>','800px','300px',{title:'开始直播'});"><i class="iconfont icon-dashboard"></i></a>
					<?php }elseif($v['livetype']==1){ ?>
					<a href="<?php echo M_URL($this->AppName.'/Index','audiolive',$v['courseid'],GP(''));?>" target="_blank">语音直播</a>
					<?php }?>
				</td>
				<?php } ?> -->
				<td><?php echo $v['hits']?></td>
				<td><?php echo date('Y-m-d H:i:s',$v['adddate'])?></td>
				<td>
				<span class="link-switch<?php if($v["status"]==2){ echo ' open' ?><?php }  ?>" data-off="<?php echo M_URL($this->AppName.'/Index','unaudited',$v['courseid'],GP('p-'.$page->now_page));?>" data-open="<?php echo M_URL($this->AppName.'/Index','audited',$v['courseid'],GP('p-'.$page->now_page)); ?>"><i></i></span>
				</td>
				<td><span onclick="Confirm('是否删除班级？该操作不可逆!','<?php echo M_URL($this->AppName.'/Index','delect',$v['courseid'],GP('')); ?>')"><i class="iconfont icon-lajitong"></i></span></td>
			<!-- 	<td class="ks-head-el">
					<i onclick="choiceClick(this)" class="iconfont icon-more"></i>
					<div class="ks-head-content ks-head-content-pc w100">
						<ul class="opeart">
							<li ><a href="<?php echo M_URL($this->AppName.'/Index','basics',$v['courseid'],GP(''));?>">编辑</a></li>
							<?php if($v['coursehour']==1){?>
							<li ><a href="<?php echo M_URL($this->AppName.'/Index','period',$v['courseid'],GP(''));?>">连载</a> </li>
							<?php }?>	
							<?php if($courseType!=4&&$courseType!=3){?>
							<li > <a href="<?php echo M_URL($this->AppName.'/Index','information',$v['courseid'],GP(''));?>">资料</a> </li>
							<li class="w20b"> <a href="<?php echo M_URL($this->AppName.'/Index','exam',$v['courseid'],GP(''));?>">试卷</a> </li>
							<li > <a href="<?php echo M_URL($this->AppName.'/Index','teacher',$v['courseid'],GP(''));?>">老师</a> </li>
							<li > <a href="<?php echo M_URL($this->AppName.'/Index','student',$v['courseid'],GP('')) ?>">学员</a> </li>
							<?php }?>
							<li > <a href="javascript:Confirm('是否删除此<?php echo $title;?>？该操作不可逆！','<?php echo M_URL($this->AppName.'/Index','delect',$v['courseid'],GP('p-'.$page->now_page)); ?>')"> 删除</a> </li>
						</ul>
					</div>
				</td> -->
				<td>
					<?php if($v["audit"]==1){ ?>
                       <span class="grayLing"></span><a class="deepBlue ok-icon ok-pe1 "  title="免费试用"></a>
                    <?php }else{ ?>
                       <span class="grayLing"></span><a class="deepBlue ok-icon ok-pe2"  title="正常缴费"></a>
                    <?php } ?>

					<!-- <span class="link-switch<?php if($v["audit"]==1){ echo ' open' ?><?php }  ?>" data-off="<?php echo M_URL($this->AppName.'/Index','changeaudit',$v['courseid'],GP('p-'.$page->now_page.',audit-0'));?>" data-open="<?php echo M_URL($this->AppName.'/Index','changeaudit',$v['courseid'],GP('p-'.$page->now_page.',audit-1')); ?>"><i></i></span> -->
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
                    <?php echo NoC($values);?>
					</div>

				</div>
			</div>
		</div>

		<!-- 隐藏块-->

	</div>

 
</div>
<div class="footer-page">
	<div class="col-sm-4">
		
         <div class="checkbox fl checkbox-info" style="margin-top:20px;margin-right:10px">
            <input id="checkboxAll" name="check1" type="checkbox" class="selectAll">
            <label for="checkboxAll">
                全选
            </label>
         </div>
		<button class="btn mt10 btn-default" type="submit" onclick="reg_submit(2)" value="2" name="batch">
			通过
		</button>
		<button class="btn mt10 btn-default" type="submit" onclick="reg_submit(3)" value="3" name="batch">
			待审核
		</button>
		<button class="btn mt10 btn-default" type="submit" onclick="reg_submit(1)" value="1" name="batch">
			删除
		</button>
		<button class="btn mt10 btn-default" type="submit" onclick="reg_submit(4)" value="4" name="batch">
			分销审核
		</button>
	</div>
	<div class="col-sm-7"><?php echo $page->show(3); ?></div>
</div>
</form>
<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>

<script src="<?php echo UOOT;?>Public/common/js/backstage.js"></script>
<script>
    var selectInputs = $('.select-checks') ;
	var checkAllInputs = $('.check-all');
	 selectall(selectInputs,checkAllInputs);//全选
	 loadScorllJs();//滚轮
	 remind();//提醒
	 taps();//选项卡	

	function reg_submit(type){
	 // inspectionCheckBox('check[]',function(){
		$('#batch1').val(type);
		$('#SOIDJF').submit();

	// })
	 	// $("#SOIDJF").submit();
	 }

	 $('.link-switch').each(function(){
		setLinkSwitch(this)
	})

</script>

</body>
</html>