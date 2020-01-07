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
<link href="<?php echo UOOT;?>Public/app/css/live.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/main.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="//www.ketangjie.cn/Public/admin/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<style>
#teacher2 li {display:inline-block;width:150px;height:40px;margin-right:10px}
</style>

</head>

<body class="bg-gary p15">
<div class="">
 <ul class="nav nav-tabs">
    <li class="active fl"><a href="<?php echo M_URL($this->AppName.'/index','index','',GP('')); ?>">课程管理</a></li>
    <li class="fl"><a href="<?php echo M_URL('course/index','basics','',GP(''))  ?>">课程编辑</a></li>
 </ul>
<?php if(isset($course)){ ?>
<div class="topCourseBox contentBox bRadius10 bg-white p20 clearfix borderSo">
    <div class="fl ml10 courseImg"><img src="<?php if($course["defaultpic"]!=''){echo Img($course["defaultpic"]);}else{echo '/Public/uploads/common/nopic.gif';} ?>" width="100%"></div>
    <div class="fl ml20">
        <div class="clearfix"><span class="fl fsize16 c-333 hLh30"><?php echo $course['title']; ?></span><span class="fl bg-green w93    alignCenter fsize12 c-fff ml20 bRadius20 hLh30">已发布</span></div>
        <div class="mt10"><span class="fsize14 c-92">课时：12学时</span><span class="fsize14 c-92 ml20">学员：56个</span></div>
    </div>
</div>
<?php }?>
</div>   

<div class="courseBox clearfix mt20" style="margin-top: <?php if(isset($course)){echo '140px';}else{echo '40px';} ?> ">
    <div class="lLightBox bg-white  pt30 borderSo">
        <ul>
            <li class="posRe pl50 mb20 curr">
                <em class="vLine bg-green posAb"></em>
                <a href="javascript:void(0)" class="firstN fsize14 c-92">课程资料</a>
                <div class="liveCsecond pl20" style="display:block">
                    <a href="<?php echo M_URL($this->AppName.'/index','basics',$courseid,GP('')) ?>"    class="block  fsize14 ">基本资料</a>
                    <a href="<?php echo M_URL($this->AppName.'/index','info',$courseid,GP('')) ?>"  class="block curr fsize14">详细资料</a>
                    <!-- <a href="<?php echo M_URL($this->AppName.'/index','seo',$courseid,GP('')) ?>"   class="block fsize14" >SEO设置</a> -->
                </div>
            </li>
            <li class="posRe pl50 mb20  ">
                <em class="vLine bg-green posAb"></em>
                <a href="<?php echo M_URL($this->AppName.'/index','uploadfile',$courseid,GP('')) ?>"  class="firstN fsize14  c-92">上传文件</a>
            </li>
            <li class="posRe pl50 mb20">
                <em class="vLine bg-green posAb"></em>
                <a href="<?php echo M_URL($this->AppName.'/index','period',$courseid,GP('')) ?>"   class="firstN fsize14 c-92">课程学时</a>
            </li>
             <li class="posRe pl50  mb20">
                <em class="vLine bg-green posAb"></em>
                <a href="<?php echo M_URL($this->AppName.'/index','teacher',$courseid,GP('')) ?>"   class="firstN fsize14 c-92">教师管理</a>

            </li>
            <li class="posRe pl50 mb20">
                <em class="vLine bg-green posAb"></em>
                <a href="<?php echo M_URL($this->AppName.'/index','student',$courseid,GP('')) ?>"   class="firstN fsize14 c-92">课程学员</a>

            </li>
            <li class="posRe pl50 mb20 ">
                <em class="vLine bg-green posAb"></em>
                <a href="<?php echo M_URL($this->AppName.'/index','comment',$courseid,GP('')) ?>"  class="firstN fsize14  c-92">评论管理</a>
            </li>
             <li class="posRe pl50 mb20 ">
                <em class="vLine bg-green posAb"></em>
                <a href="<?php echo M_URL($this->AppName.'/index','exam',$courseid,GP('')) ?>"  class="firstN fsize14  c-92">考试管理</a>
            </li>
        <!--     <li class="posRe pl50 mb20">
                <em class="vLine bg-green posAb"></em>
                  <a href="<?php echo M_URL($this->AppName.'/index','room',$courseid,GP('')) ?>" class="firstN fsize14 c-92">房间管理</a>
            </li> -->
             <li class="posRe pl50 mb20"> 
                <em class="vLine "></em>
                 <a href="<?php echo  M_URL($this->AppName.'/index','kpoint',$courseid,GP('')) ?>"  class="firstN fsize14 c-92">知识点管理</a>
            </li>
        </ul>
    </div>
    <div class="lRightBox" id="lRightBox">
        <div class="sRightBox ml20 bg-white  borderSo pt30">
            <form target="hidframe"  action="<?php echo M_URL($this->AppName.'/index','doaddinfo',$courseid,GP('')) ?>" method="post">
                <div class="blank10"></div>
                <table width="95%" cellpadding="0" cellspacing="0" border="0" class="gTable mt-20 mlr">
                    <tr>
                        <td class="leftTd alignRight fsize16 c-666 w180 pr20">是否推荐</td>
                        <td class="rightTd alignLife">
                            <label class="radioLabel fl">
                                <input type="radio" name="recommend"  class="radioInput" value="1" 
								<?php if(isset($course["recommend"])){if($course["recommend"]=1)echo "checked"; }?> >
                                <span class="radioName fsize16 c-92">是</span>
                            </label>
                            <label class="radioLabel fl">
                                <input type="radio" name="recommend" class="radioInput"  value="0"
                                <?php if(isset($course["recommend"])){if($course["recommend"]=0)echo "checked"; }else{ echo "checked";}?>>
                                <span class="radioName fsize16 c-92">否</span>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td class="leftTd alignRight fsize16 c-666 w180 pr20">是否幻灯展示</td>
                        <td class="rightTd alignLife">
                            <label class="radioLabel fl">
                                <input type="radio" name="slide" checked="checked" class="radioInput" value="1"
                                <?php if(isset($course["slide"])){if($course["slide"]=1)echo "checked"; }?> >
                                <span class="radioName fsize16 c-92">是</span>
                            </label>
                            <label class="radioLabel fl">
                                <input type="radio" name="slide" class="radioInput"  value="0"
                                <?php if(isset($course["slide"])){if($course["slide"]=0)echo "checked"; }else{ echo "checked";}?>>
                                <span class="radioName fsize16 c-92">否</span>
                            </label>
                        </td>
                    </tr>
                   <!-- <tr>
                        <td class="leftTd alignRight fsize16 c-666 w180 pr20">课程主讲老师：</td>
                        <td class="leftTd alignLife fsize12 c-92 pr10">
                            <input type="button" class="" value="选择主老师" id="teacher1" onClick="selectSpeaker('<?php echo M_URL($this->AppName.'/index','addteacher',$courseid,'',GP("")) ?>')">
                           
                 
                        </td>
                    </tr>-->
                    <tr>
                         <td class="leftTd alignRight fsize16 c-666 w180 pr20">课程讲师：</td>
                        <td class="leftTd alignLife fsize12 c-92 pr10">
                        <input type="button" class="" value="选择讲师" onClick="addTypeChange('<?php echo M_URL($this->AppName.'/index','addDocent',$courseid,'',GP("")) ?>','800px','600px','选择讲师')">
                        <div >
                        <ul id="teacher2" class=" mt10" style="width:600px">
                         <?php foreach($speaker as $k=>$v){  if($v['isspeaker']==1) {   ?>
                                 
                        <li width=150px class="addteacher" data="<?php echo $v['id'] ?>" dataname="<?php echo $v['name'] ?>" id="docent<?php echo $v['id'] ?>" >
                        <input type="hidden"  name="speaker" value="<?php echo $v['teacherid'] ?>"><?php echo $v['name'] ?><button type="button">主讲老师</button></li>
                         <?php }else{ ?>
                         <li width=150px div class="addteacher" data="<?php echo $v['id'] ?>" dataname="<?php echo $v['name'] ?>" id="docent<?php echo $v['id'] ?>">
                         <input type="hidden" name="docent[]" value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?>
                         <button type="button" onclick ="speak(<?php echo $v['id'] ?>,'<?php echo $v['name'] ?>');">设为主讲</button>
                         <button type="button" onclick ="del('<?php echo $v['id'] ?>')">删除</button>
                         </li>
                         <?php }}?>
                        </ul>
                        </div> 
                        </td>
                        </td>
                    </tr>
                    <tr>
                        <td class="leftTd alignRight fsize14 c-92 w93 verAlignTop">课程详细介绍</td>
                        <td class="rightTd alignLife">
                           <?php  $kindeditor = ks_editor('content','');  echo $kindeditor;?>
                        </td>
                    </tr>
                    <tr>
                        <td class="leftTd alignRight fsize14 c-92 w93 verAlignTop">课程公告</td>
                        <td class="rightTd alignLife">
                        <?php  $kindeditor = ks_editor('announce','');  echo $kindeditor;?>
                  </td>
                    </tr>
                    <tr>
                        <td class="leftTd alignRight fsize16 c-79 w100p pr20"></td>
                        <td class="leftTd alignLife fsize12 c-92 pr10"><input type="submit" class="generalBtn c-fff fsize16 bRadius5" value="确认" name="confirm"><input type="submit" class="generalBtn c-92 fsize18 bRadius5 bg-d7 ml30" value="取消" name="cancel"></td>
                    </tr>
                </table>
                <div class="blank30"></div>
            </form>
        </div>
    </div>
</div>
 <script src="<?php echo UOOT;?>Public/common/js/common.js" type="text/javascript"></script>
 <script>
IncreaseClass('257','.lLightBox ul>li','.liveCsecond>a','.liveCsecond')
checkbookM();
loadScorllJs();
function speak(id,name){
	$(".addteacher").each(function(index, element) {
	var data = $(this).attr('data');
	var dataname = $(this).attr('dataname');
	$("#docent"+data).html('<li width=150px><input type="hidden" name="docent[]" value="'+data+'">'+dataname+'<button type="button" onclick ="speak('+data+',\''+dataname+'\');">设为主讲</button><button type="button" onclick ="del('+data+')">删除</button></li>');
		});
	$("#docent"+id).html('<li width=150px><input type="hidden" name="speaker" value="'+id+'">'+name+'<button type="button">主讲老师</button></li>');
	
	/*var AID=$("input[name='speaker']").attr("value");
	$("#docent"+id).remove();
	if(AID){
		alert(id);
		alert(AID);
	  var ANAME =$("#speak"+AID).text();
	$("#speak"+id).after('<div class="addteacher" id="docent'+AID+'"><input type="hidden" name="docent[]" value="'+AID+'">'+ANAME+'<button type="button" onclick ="speak('+AID+',\''+ANAME+'\');">设为主讲</button><button type="button" onclick ="del('+AID+')">删除</button></div>');  
	}
	$("#teacher2").after('<div class="addteacher" id="speak'+id+'"><input type="hidden" name="speaker" value="'+id+'">'+name+'<button type="button">主讲老师</button></div>');*/
}
/*
function selectSpeaker(url){
	var index=layer.open({
        type: 2,
        area: ['850px', '600px'],
        fixed: false, //不固定
        maxmin: true,
		 title: ['添加主讲老师', 'font-size:18px;'],
        content:url
    });
	
}
*/
function del(id)
{
	 $("#docent"+id).remove();
}
	/*左侧二级栏目*/
$(".liveTab li:first").css("border-right",0);
$('.recordData').each(function() {
	var num = $(this).find('.recordBox').size();
	$(this).attr('data-id',num);
});
/*增加和删除数据*/
$('.recordData').find('.delete:first').remove();
$('.recordBox:first').removeClass("mt10");
$(".gTable .addRecord").click(function(){
	var i = $(this).parents('.recordData').attr('data-id');
	i++;
	if(i<=3){
		var html = $(this).siblings(".recordBox:first").html();
		newHtml  = '<div class="recordBox mt10">'+html+'<a href="javascript:void(0)" class="delete c-blue ml10">删除</a></div>';
		$(this).before(newHtml);
		a = i-1;
		$(this).siblings('.recordBox:eq('+a+')').find('.inputText').val('');
	}else{
		i=3;
		parent.layer.msg('最多只能加三条记录');
	};
	$(this).parents('.recordData').attr('data-id',i);
	$(".recordBox").on('click','.delete',function(){
		i--;
		$(this).parents('.recordData').attr('data-id',i);
		$(this).parents('.recordBox').remove();
	});
});
$(".recordBox").on('click','.delete',function(){
	var i = $(this).parents('.recordData').attr('data-id');
	i--;
	$(this).parents('.recordData').attr('data-id',i);
	$(this).parents('.recordBox').remove();
});
</script>
</body>
</html>
