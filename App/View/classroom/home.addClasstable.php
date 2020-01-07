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
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<style>
.Aconts-ul{ margin-right: 15px;}
.Aconts-ul li{float: left; width: 20%;}
.Aconts-ul li input{position: absolute;top: 0px;left: 0px;opacity: 0;}
.Aconts-ul .Alert-img{overflow: hidden; position: relative;}
.Alert-conts{ padding: 15px 10px; overflow: auto; height: 381px;}
.Alert-img img{width: 100%; height:  100%; min-height: auto;min-width: auto;}
.Alert-img i{ position: absolute; top: 50%; left: 50%;font-size: 60px; margin-top: -40px; margin-left: -30px; color:#44B549;}
.Alert-shadow{position: absolute; height: 100%; width: 100%; background: #000000; opacity: 0.6;}
.Aconts-box{margin: 15px 0px 0px 15px;border: solid 1px #e5e5e5;position: relative;}
.Alert-mark{padding: 0px 10px; border-top:1px solid #E5E5E5 ;height: 30px; line-height: 30px; text-align: center;font-size: 12px;overflow : hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical;}
.ctrShaw{display: none;}
div i.icon-tianjia1{
	color:#ccc;
	margin-top:-60px;
	cursor:pointer;
	transition:all 0.2s linear;
}
.add-add{
	cursor:pointer;
	background:#eee;
}
div i.icon-tianjia1:hover{
	color:#476DBE;
}
</style>
</head>
<body>

	  
	<div class="ks-wbox">
		
	<div id="ksBoxHead">
			<div class="clearfix">
	  <div class="fr ks-top-search">
				<label class="mr0">
			   	<select class="w150 inputText bRadius5" id="keytype">
					<option value="1" <?php if($keytype==1){echo 'selected="selected"';} ?>>课程名字</option>
					<option value="2" <?php if($keytype==2){echo 'selected="selected"';} ?>>老师姓名</option>
			  	</select>
				</label>
				<div class="ks-top-search fr">
					<input type="text" class="sc-text" name="searchText" id="keyword"  value="<?php if(isset($keyword)) echo $keyword; ?>">
	                <input type="button" class="sc-button" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','addClasstable',$classroomid); ?>','<?php echo URL_MODEL;?>')" name="searchBtn" value="搜索" >
				</div>
			</div>
		</div>   
		  
		  
	</div>
	<form target="hidframe"  action="<?php  echo M_URL($this->AppName.'/Index','doaddClasstable',$classroomid,GP('p-'.$page->now_page)) ?>" method="post" id="myform">
	<div class="clearfix" style="height:400px;">
		
    <div id="ksBoxContent">
        <table width="100%" cellpadding="0" cellspacing="0" border="0" class="ks-table">
            <thead>
            <tr>
            	<th><input name="" type="checkbox" value="" class="verAlignMiddle checkall check-all" id="selectAll"></th>
                <th>课程名字</th>
                <th>指导老师</th>
                <th>上课形式</th>
                <th>上课时间</th>
            </tr>
            </thead>
            <tbody>
             <?php foreach($values as $k => $v){if($v['coursetype']==0){$coursetype = "面授";}else{$coursetype = "直播";} ?>
             	<tr>
             		<td class="alignCenter hLh40 pt0 pb0 fsize14 c-92 ">
            		<input type="checkbox" class="select-check" name="classtableid[]" value="<?php echo Field($v['userid']);?>"></td>
             		<td width="15%"><?php echo Field($v['coursename']);?></td>
             		<td width="13%"><?php echo Field($v['name']);?></td>
             		<td width="13%"><?php echo $coursetype ?></td>
             		<td><?php echo Field(date("H:i",$v['starttime']));?>-<?php echo Field(date("H:i",$v['endtime']));?></td>
             	</tr>
             <?php }?>

            </tbody>
        </table>
    </div> 
	<div >
     	 
		
	</div></div>	
		
		
		<div class="clearfix mr30">
		    <div class="rightTd alignLife fl">
		      
		        <input type="button" class="ks-bt bt-pue"  onclick="submitform()"   value="确认" name="confirm" />

		    </div>
		    
              	<?php echo $page->show(3); ?>
             
		    
		</div>
		
	

	</form>
	
	

<script src="<?php echo UOOT;?>Public/common/js/common.js" type="text/javascript"></script>
<script src="<?php echo UOOT;?>Public/common/js/jquery.cookie.js" type="text/javascript"></script>
<script>
	
function submitform(){
	$('#myform').submit();
}




loadScorllJs();//滚轮


</script>
</body>
</html>
