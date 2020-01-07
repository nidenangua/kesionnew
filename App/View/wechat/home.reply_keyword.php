<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit"> 
<title>kesion教育平台</title>
<meta name="Keywords" content="kesion教育平台"/>
<meta name="Description" content="kesion教育平台" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/main.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
</head>
<body class="bg-gary">
	
<div class="contentBox bRadius10 bg-white w100">
    <div class="generalTitle mb0">
      <span class="roundBox mr10"><img src="<?php echo UOOT;?>Public/app/images/wzsz.png"></span>
	  <span class="gTitle fsize18 c-3e verAlignMiddle">消息回复</span>
    </div>
	<ul class="titleTab clearfix mt20 ml20 mb30 pl20 pb20">
	  <li class="fl hLh40 pl10 pr10 mr20 fsize18 curr"><a href="javascript:void(0)" class="c-92">关注时回复</a></li>
	  <li class="fl hLh40 pl10 pr10 mr20 fsize18"><a href="javascript:void(0)" class="c-92">消息自动回复</a></li>
      <li class="fl hLh40 pl10 pr10 mr20 fsize18"><a href="javascript:void(0)" class="c-92">关键词自动回复</a></li>
	</ul>
	<div class="infoBox">
		<div class="webConBox">

			   <div class="configTab" style="display:block;">
				   <form  action="<?php echo M_URL($this->AppName.'/Index','focusReply','',GP(''))  ?>" method="post" class="commentForm" enctype="multipart/form-data">
				   <table width="100%" cellpadding="0" cellspacing="0" border="0" class="gTable">
					   <tr>
						   <td class="leftTd alignRight fsize16 c-92 w120">开启关注时回复</td>
						   <input type="hidden" value="0" name="type">
						   <td class="rightTd alignLife">
							   <label class="radioLabel fl">
								   <input type="radio" name="isfocus" class="radioInput" <?php if(isset($info)){if($info['isfocus'] == 1) echo 'checked="checked"';} ?>  checked value="1"/>
								   <span class="radioName fsize16 c-92">开启</span>
							   </label>
							   <label class="radioLabel fl">
								   <input type="radio" name="isfocus" class="radioInput"<?php if(isset($info)){if($info['isfocus'] == 0) echo 'checked="checked"';} ?>  value="0" />
								   <span class="radioName fsize16 c-92">关闭</span>
							   </label>
						   </td>
					   </tr>
					   <tr>
						   <td class="leftTd alignRight fsize16 c-92 w120">素材</td>
						   <td class="rightTd alignLife" id="focusReplySucai1">
							   <a href="javascript:void(0)" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','replySucai','',GP(""));  ?>','850px','600px');"
								  class="fl c-fff bRadius5 alignCenter hLh35 fsize14 w93 ml10 bg-34b">从素材中选择<i class="iconfont icon-triangle-bottom ml10"></i></a>
						   </td>

					   </tr>
					   <tr>
						   <td class="leftTd alignRight fsize16 c-92 w120 verAlignTop">文字</td>
						   <td class="rightTd alignLife">
							   <textarea name="content" rows="2" cols="20" class="inputText bRadius5" id="content" style="height:200px;width:40%;"><?php  if(isset($info)) echo $info["content"]?></textarea>
						   </td>
						   <td></td>
					   </tr>
					   <tr >
						   <td class="leftTd alignRight fsize16 c-92 w120">课程</td>
						   <td class="rightTd alignLife" id="focusReplyCourse1">
							   <a href="javascript:void(0)" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','replyCourse','',GP(""));  ?>','850px','600px');"
								  class="fl c-fff bRadius5 alignCenter hLh35 fsize14 w93 ml10 bg-34b">从课程中选择<i class="iconfont icon-triangle-bottom ml10"></i></a>
						   </td>
					   </tr>
					   <tr>
						   <td class="leftTd alignRight w120"></td>
						   <td class="rightTd alignLife"><input type="submit" class="generalBtn c-fff fsize16 bRadius5" value="确认" name="confirm"></td>
					   </tr>
				   </table>
				   </form>
			   </div>


			<div class="configTab" style="display:none;">
				<form  action="<?php echo M_URL($this->AppName.'/Index','autoReply','',GP(''))  ?>" method="post" class="commentForm" enctype="multipart/form-data">
					<table width="100%" cellpadding="0" cellspacing="0" border="0" class="gTable">
						<tr>
							<td class="leftTd alignRight fsize16 c-92 w120">开启消息时回复</td>
							<input type="hidden" value="1" name="type">
							<td class="rightTd alignLife">
								<label class="radioLabel fl">
									<input type="radio" name="isauto" class="radioInput" <?php if(isset($info)){if($info['isauto'] == 1) echo 'checked="checked"';} ?>   value="1"/>
									<span class="radioName fsize16 c-92">开启</span>
								</label>
								<label class="radioLabel fl">
									<input type="radio" name="isauto" class="radioInput"<?php if(isset($info)){if($info['isauto'] == 0) echo 'checked="checked"';} ?>  checked value="0" />
									<span class="radioName fsize16 c-92">关闭</span>
								</label>
							</td>
						</tr>
						<tr>
							<td class="leftTd alignRight fsize16 c-92 w120">素材</td>
							<td class="rightTd alignLife" id="focusReplySucai2">
								<a href="javascript:void(0)" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','replySucai','',GP(""));  ?>','850px','600px');"
								   class="fl c-fff bRadius5 alignCenter hLh35 fsize14 w93 ml10 bg-34b">从素材中选择<i class="iconfont icon-triangle-bottom ml10"></i></a>
							</td>
                        </tr>
						<tr>
							<td class="leftTd alignRight fsize16 c-92 w120 verAlignTop">文字</td>
							<td class="rightTd alignLife">
								<textarea name="content" rows="2" cols="20" class="inputText bRadius5" id="content" style="height:200px;width:40%;"><?php  if(isset($info)) echo $info["content"]?></textarea>
							</td>
							<td></td>
						</tr>
						<tr >
							<td class="leftTd alignRight fsize16 c-92 w120">课程</td>
							<td class="rightTd alignLife" id="focusReplyCourse2">
								<a href="javascript:void(0)" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','replyCourse','',GP(""));  ?>','850px','600px');"
								   class="fl c-fff bRadius5 alignCenter hLh35 fsize14 w93 ml10 bg-34b">从课程中选择<i class="iconfont icon-triangle-bottom ml10"></i></a>
							</td>
						</tr>
						<tr>
							<td class="leftTd alignRight w120"></td>
							<td class="rightTd alignLife"><input type="submit" class="generalBtn c-fff fsize16 bRadius5" value="确认" name="confirm"></td>
						</tr>
					</table>
				</form>
			   </div>
  	           <div class="configTab" style="display:none;">
				   <a class="btn-green c-fff block w120 alignCenter fsize16 hLh30 addbtn-green" href="<?php echo M_URL($this->AppName.'/Index','addKeywordRule','',GP("")); ?>" style="margin-left:15px;display:inline-block">添加规则</a>
				   <div class="fr mt20 ml20 mb30 mr20">
					   <label class="mr20">
						   <select class="w150 inputText bRadius5" id="keytype">
							   <option value="1" <?php if(isset($keytype) and $keytype==1)echo 'selected';?>>规则</option>
						   </select>
					   </label>
					   <input type="text" class="inputText" name="searchText" id="keyword"  value="<?php if(isset($keyword))echo $keyword; ?>">
					   <input type="button" class="bg-gary searchBtn w93 fsize14 c-92 verAlignMiddle" name="searchBtn" value="搜索"
							  onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','fansList'); ?>','<?php echo URL_MODEL;?>')">
				   </div>
				   <div class="infoBox">
					   <div class="p20 webConBox ">
						   <div class="configTab clearfix" style="display: block">
							   <form target="hidframe"  action="<?php echo M_URL($this->AppName.'/Index','bathDelFanslist','',GP("p-$page->now_page"));  ?>" method="post">
								   <table width="100%" cellpadding="0" cellspacing="0" border="0"
										  class="gTable borderTable borderSo " style="border-bottom:0;">
									   <thead>
									   <tr class="bg-gary">
										   <th class="alignCenter hLh40 pt0 pb0 fsize14"></th>
										   <th class="alignCenter hLh40 pt0 pb0 fsize14">序号</th>
										   <th class="alignCenter hLh40 pt0 pb0 fsize14">规则</th>
										   <th class="alignCenter hLh40 pt0 pb0 fsize14">关键字</th>
										   <th class="alignCenter hLh40 pt0 pb0 fsize14">回复内容</th>
										   <th class="alignCenter hLh40 pt0 pb0 fsize14 w93">操作</th>
									   </tr>
									   </thead>
									   <tbody>
									   <?php foreach($values as $k=>$v){ ?>
										   <tr>
											   <td class="alignCenter hLh40 pt0 pb0 fsize14 c-92 ">
												   <input type="checkbox" class="verAlignMiddle mr10" name="id[]" value="<?php echo $v['id'] ?>" >
												   <input type="hidden" value="<?php echo $v['id'] ?>" name="id" id="id">
											   </td>
											   <td class="alignCenter hLh40 pt0 pb0 fsize14 c-92"><?php echo $k;?></td>
											   <td class="alignCenter hLh40 pt0 pb0 fsize14 c-92"><img class="js_logoBox block" src="<?php echo Img($v['headimgurl']);?>" width="100"></td>
											   <td class="alignCenter hLh40 pt0 pb0 fsize14 c-92"><?php echo $v['nickname'];?>(<?php echo $v['remark'];?>)</td>
											   <td class="alignCenter hLh40 pt0 pb0 fsize14 c-92"><?php if(isset($v['sex']) and $v['sex'] == 0){echo "未知";}
												   elseif(isset($v['sex']) and $v['sex'] == 1){echo "男";}else{echo "女";}?></td>
											   <td class="alignCenter hLh40 pt0 pb0 fsize14 c-92"><?php echo  date("Y-m-d",$v['subscribe_time'])?></td>
											   <td class="alignCenter hLh40 pt0 pb0 fsize14 c-92"><?php echo $v['city']?></td>
											   <td class="alignCenter hLh40 pt0 pb0 fsize14 c-92"><?php echo $v["groupname"]?></td>
											   <td class="alignCenter hLh40 pt0 pb0 fsize14 c-92">
												   <a href="javascript:void(0);"  onclick="Confirm('是否删除此粉丝？该操作不可逆!','<?php echo M_URL($this->AppName.'/Index','delFanslist',$v['id'],GP('p-'.$now_page)); ?>')">
													   <i class="icon pr10 iconfont">删除粉丝</i> </a>
												   <a href="javascript:void(0)" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','modifyRemark',$v['id'],GP("'p-'.$now_page")) ?>','850px','600px');"
													  class="fr c-fff bRadius5 alignCenter hLh35 fsize14 w93 ml10 bg-34b">备注分组<i class="iconfont icon-triangle-bottom ml10"></i></a>
											   </td>
										   </tr>
									   <?php }?>
									   </tbody>
								   </table>
								   <div class="fr mt20">
									   <label style="margin-right: 15px"><input name="allChecked" type="checkbox" value="allChecked" class="check-all verAlignMiddle" id="selectAll" onclick="DoCheck()"> 全选</label>
									   <button type="submit" class=" generalBtn c-fff fsize16 bRadius5" name="batch"  value="3" >批量删除</button>
								   </div>
						   </div>
	                </form>
	                  <?php echo NoC($values);?>

	       </div>
        </div>
       </div>
      </div>
     </form>
	   <div class="hLh40"></div>
       <div class="footer-page"></div>
    </div>
</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
uploadView(180,120); 
/*设置切换*/
$(function(){	
	$('.titleTab li').click(function(){
		$(this).addClass('curr').siblings().removeClass('curr');
		$('.infoBox .webConBox>.configTab:eq('+$(this).index()+')').show().siblings().hide();	
	})
});
$(function(){
	$("input[type=file]").change(function(){$(this).parents(".uploader").find(".filename").val($(this).val());});
	$("input[type=file]").each(function(){
//	if($(this).val()==""){$(this).parents(".uploader").find(".filename").val("");}
	});
});
function cleckSitename(){
    var sitename = document.getElementById("sitename").value;
	if(sitename!= ""){
	  var url = "<?php echo M_URL('website','cleckSitename'); ?>";
	  var data ={
	   sitename:sitename,
	  };
	  $.ajax({
			type:"post",
			url:url,
			data:data,
			success:function(text){
			  
				  $("#un_ck").html(result.result_desc);
			   if(result.result_code == "OK"){
				  $("#un_ck").css("color","green");
			   }else{
				   alert("ss");
				  $("#un_ck").css("color","red");
			   }
			},
			error:function(){
				alert("发生了错误,请检查!");
			}
	  })
	}
}

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


</script>
</body>
</html>
