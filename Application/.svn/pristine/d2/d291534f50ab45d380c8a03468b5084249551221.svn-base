<!DOCTYPE html>
<html>
<head lang="en">
<meta charset="UTF-8">
<title></title>
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/fonts/iconfont.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
<style>
.pl15{padding-left: 15px}
.field{ height: 22px; line-height: 22px; float: left; border: 1px solid #FFccCC; margin: 5px;  padding-left: 15px; padding-right:15px; background: #FFFFEC; font-weight: bold; }
.w200 {width:200px !important}
</style>
</head>
<body class="gray-bg">
<div class="wrapper">

<div class="row bg-white p15">
<form target="hidframe" id="myform" class="form-horizontal" action="<?php if(empty($value)){echo M_URL('Label','LabeldoAdd','',GP('labeltype-'.$labeltype));}else{echo M_URL('Label','LabeldoEdit',$labelid,GP('p-'.$now_page));} ?>" method="post" enctype="multipart/form-data">
       
        <div class="form-group">
            <label class="col-sm-2 control-label">标签类型：</label>
            <div class="col-sm-2 w200">
            -<?php echo BCT($labeltype);?>-
            <input type="hidden" value="<?php echo $labeltype;?>" id="basictype">  
            <input type="hidden" value="6" id="appid">
            </div>
        </div>
        <div class="line line-dashed b-b line-lg pull-in"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">缓存时间：</label>
            <div class="w100 fl pl15">
                <input type="number" class="form-control" value="<?php if(!empty($value)){echo $Label->GetParam($value['labelcontent'],'CacheTime');}else{echo 0;} ?>" id="CacheTime" />
            </div>
            <div class="control-label fl"><strong>分钟</strong>Tips:设置为“0”不启用缓存，设置为“-1”永久缓存。</div>

        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-8">对查询出来的数据没有经常更新的标签，建议设置一个缓存时间，减少数据库查询，整个系统的性能将得到很好的提升。</div>
        </div>
        <div class="line line-dashed b-b line-lg pull-in"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">查询条数：</label>
            <div class="col-sm-8">
               <div class="w100 fl">
                   <input class="form-control" type="number" value="<?php if(!empty($value)){echo $Label->GetParam($value['labelcontent'],'Num');}else{echo 10;} ?>" id="Num" />
               </div>
                <label class="control-label fl">条</label>
                <label class="control-label fl">排序方式：</label>
                <div class="w150 fl">
                <select class="form-control" id="Order">
                     <option <?php if(!empty($value)){if($Label->GetParam($value['labelcontent'],'Order')=='I.InfoID desc'){?>selected="selected"<?php }}?> value="I.InfoID desc">信息ID降序</option>
                        <option <?php if(!empty($value)){if($Label->GetParam($value['labelcontent'],'Order')=='I.InfoID asc'){?>selected="selected"<?php }}?> value="I.InfoID asc">信息ID升序</option>
                        <option <?php if(!empty($value)){if($Label->GetParam($value['labelcontent'],'Order')=='I.adddate desc'){?>selected="selected"<?php }}?> value="I.adddate desc">更新时间降序</option>
                        <option <?php if(!empty($value)){if($Label->GetParam($value['labelcontent'],'Order')=='I.adddate asc'){?>selected="selected"<?php }}?> value="I.adddate asc">更新时间升序</option>
                        <option <?php if(!empty($value)){if($Label->GetParam($value['labelcontent'],'Order')=='i.commentnum desc'){?>selected="selected"<?php }}?> value="i.commentnum desc">总评论数降序</option>
                        <option <?php if(!empty($value)){if($Label->GetParam($value['labelcontent'],'Order')=='i.commentnum asc'){?>selected="selected"<?php }}?> value="i.commentnum asc">总评论数升序</option>
                        <option <?php if(!empty($value)){if($Label->GetParam($value['labelcontent'],'Order')=='i.hits desc'){?>selected="selected"<?php }}?> value="i.hits desc">总浏览数降序</option>
                        <option <?php if(!empty($value)){if($Label->GetParam($value['labelcontent'],'Order')=='i.hits asc'){?>selected="selected"<?php }}?> value="i.hits asc">总浏览数升序</option>
                        <option <?php if(!empty($value)){if($Label->GetParam($value['labelcontent'],'Order')=='i.hitsbymonth desc'){?>selected="selected"<?php }}?> value="i.hitsbymonth desc">月浏览数降序</option>
                        <option <?php if(!empty($value)){if($Label->GetParam($value['labelcontent'],'Order')=='i.hitsbymonth asc'){?>selected="selected"<?php }}?> value="i.hitsbymonth asc">月浏览数升序</option>
                        <option <?php if(!empty($value)){if($Label->GetParam($value['labelcontent'],'Order')=='i.hitsbyweek desc'){?>selected="selected"<?php }}?> value="i.hitsbyweek desc">周浏览数降序</option>
                        <option <?php if(!empty($value)){if($Label->GetParam($value['labelcontent'],'Order')=='i.hitsbyweek asc'){?>selected="selected"<?php }}?> value="i.hitsbyweek asc">周浏览数升序</option>
                        <option <?php if(!empty($value)){if($Label->GetParam($value['labelcontent'],'Order')=='i.hitsbyday desc'){?>selected="selected"<?php }}?> value="i.hitsbyday desc">日浏览数降序</option>
                        <option <?php if(!empty($value)){if($Label->GetParam($value['labelcontent'],'Order')=='i.hitsbyday asc'){?>selected="selected"<?php }}?> value="i.hitsbyday asc">日浏览数升序</option>
                        <option <?php if(!empty($value)){if($Label->GetParam($value['labelcontent'],'Order')=='i.goodnum asc'){?>selected="selected"<?php }}?> value="i.goodnum asc">点赞数升序</option>
                        <option <?php if(!empty($value)){if($Label->GetParam($value['labelcontent'],'Order')=='i.goodnum desc'){?>selected="selected"<?php }}?> value="i.goodnum desc">点赞数降序</option>
                        <option <?php if(!empty($value)){if($Label->GetParam($value['labelcontent'],'Order')=='i.favnum asc'){?>selected="selected"<?php }}?> value="i.favnum asc">收藏数升序</option>
                        <option <?php if(!empty($value)){if($Label->GetParam($value['labelcontent'],'Order')=='i.favnum desc'){?>selected="selected"<?php }}?> value="i.favnum desc">收藏数降序</option>
                        <option <?php if(!empty($value)){if($Label->GetParam($value['labelcontent'],'Order')=='i.sharenum asc'){?>selected="selected"<?php }}?> value="i.sharenum asc">分享数升序</option>
                        <option <?php if(!empty($value)){if($Label->GetParam($value['labelcontent'],'Order')=='i.sharenum desc'){?>selected="selected"<?php }}?> value="i.sharenum desc">分享数降序</option>
                        <option <?php if(!empty($value)){if($Label->GetParam($value['labelcontent'],'Order')=='newid()'){?>selected="selected"<?php }}?> value="newid()">随机显示</option>
                </select>
                </div>
                
            </div>
        </div>
        <div class="line line-dashed b-b line-lg pull-in"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">所属栏目：</label>
            <div class="col-sm-4">
               <select id="classid1" class="form-control" multiple style="min-height: 120px">
                   <option value="0">-不指定栏目-</option>
                   <option value="-1" class="red">当前栏目通用</option>
                   <?php foreach($appcategory as $k=>$v){ ?>
                   <option value="<?php echo $v['categoryid'];?>"><?php echo KS_INDENT($v['depth']).$v['categoryname'];?></option>
                   <?php }?>
               </select>
            </div>
            
        </div>
        <div class="line line-dashed b-b line-lg pull-in"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label">属性控制：</label>

            <div class="fl mt7">
                <div class="checkbox checkbox-info checkbox-inline">
                <input id="hot" value="1" type="checkbox" <?php if(!empty($value)){if($Label->GetParam($value['labelcontent'],'Hot')==1){?>checked="checked"<?php }}?> >
                <label for="hot">是否热门</label>
                </div><div class="checkbox checkbox-info checkbox-inline">
                <input id="allowcomment" value="1" type="checkbox" <?php if(!empty($value)){if($Label->GetParam($value['labelcontent'],'Allowcomment')==1){?>checked="checked"<?php }}?>>
                <label for="allowcomment">允许评论</label>
            </div><div class="checkbox checkbox-info checkbox-inline">
                <input id="roll" value="1" type="checkbox" <?php if(!empty($value)){if($Label->GetParam($value['labelcontent'],'Roll')==1){?>checked="checked"<?php }}?>>
                <label for="roll">是否滚动 </label>
            </div><div class="checkbox checkbox-info checkbox-inline">
                <input id="recommend" value="1" type="checkbox" <?php if(!empty($value)){if($Label->GetParam($value['labelcontent'],'Recommend')==1){?>checked="checked"<?php }}?>>
                <label for="recommend"> 是否推荐</label>
            </div>
                <div class="checkbox checkbox-info checkbox-inline">
                <input id="slide" value="1" type="checkbox" <?php if(!empty($value)){if($Label->GetParam($value['labelcontent'],'Slide')==1){?>checked="checked"<?php }}?>>
                <label for="slide">是否幻灯  </label>
            </div>
            </div>
        </div>
        <div class="line line-dashed b-b line-lg pull-in"></div>
        <div class="form-group">
            <div class="col-sm-2 control-label">选择样式：</div>
            <div class="col-sm-10">
                <div class="frame-format">
                    <div id="formatCarousel">
                        <ul>
                            
                        </ul>
                    </div>

                </div>
            </div>
        </div>

        <div class="line line-dashed b-b line-lg pull-in"></div>
        <div class="form-group">
            <div class="col-sm-2 control-label">修改标签：</div>
            <div class="col-sm-8">
                <input name="format" type="checkbox" value="" class="drag-checkbox" style="display:none;" />
            </div>
        </div>
        <div id="label-content" style="display: none;">
            <div class="line line-dashed b-b line-lg pull-in"></div>
            <div class="form-group">
                <label class="col-sm-2 control-label">可用字段：</label>
                <div class="col-sm-8 taps-li">
                  <ul id="field"><li onclick="InsertLabel('courseid','-1')">课程ID</li><li onclick="InsertLabel('userid','-1')">用户ID</li><li onclick="InsertLabel('categoryid','14')">分类</li><li onclick="InsertLabel('title','1')">标题</li><li onclick="InsertLabel('defaultpic','1')">默认封面</li><li onclick="InsertLabel('enablechapter','1')">是否开启章节</li><li onclick="InsertLabel('chargetype','1')">章节类型</li><li onclick="InsertLabel('adddate','15')">添加时间</li><li onclick="InsertLabel('teacherid','1')">老师ID</li><li onclick="InsertLabel('name','1')">老师名称</li><li onclick="InsertLabel('common','1')">评论数</li><li onclick="InsertLabel('studentcount','1')">学员数</li><li onclick="InsertLabel('intro','1')">课程介绍</li><li onclick="InsertLabel('price_market','1')">课程参考价</li><li onclick="InsertLabel('discount','1')">折扣</li><li onclick="InsertLabel('price','1')">实际销售价</li><li onclick="InsertLabel('validedays','1')">有效天数</li><li onclick="InsertLabel('recommend','6')">是否推荐</li><li onclick="InsertLabel('slide','6')">是否幻灯</li><li onclick="InsertLabel('hits','1')">课程人气</li><li onclick="InsertLabel('soldnum','1')">课程销售量</li><li onclick="InsertLabel('status','5')">审核状态</li><li onclick="InsertLabel('chaptertable','6')">章节分表名</li><li onclick="InsertLabel('content','6')">课程详细介绍</li><li onclick="InsertLabel('announce','6')">课程公告</li></ul>
                </div>
            </div>
            <div class="line line-dashed b-b line-lg pull-in"></div>
            <div class="form-group">
                <label class="col-sm-2" style="word-break: normal">样式循环体：自动编号变量<span class="red">{$Auto}n取值范围0-6之间，</span></label>
                <div class="col-sm-9">
                    <textarea class="form-control" onclick="setPos()" onkeyup="setPos()" id="KSContent_LoopBody" style="height: 300px"></textarea>
                </div>

                <div class="col-sm-2">
                    <a type="button" class="textarea-max" id="click1"></a>
                    <a type="button" class="textarea-min" id="click2"></a>
                </div>
            </div>
            <div class="form-group">
                <div class="control-label col-sm-2">
                    简要描述
                </div>
                <div class="col-sm-4">
                    <span style="color: #6666ff">1、Loop使用规则</span><br>
                    循环体格式：[loop times="n"]循环标签的内容[/loop]<br>
                    其中n表示循环次数，且n满足n&gt;=0。loop为循环关键字，此循环体可以重复使用,但是不能嵌套。 <br>
                    <span style="color: #6666ff">2、字段标签规则说明</span><br>
                    格式：{$Field(FieldName,OutType,Len)}<br>
                    FieldName  --数据库表的字段名称<br>
                    OutType    --输出格式，支持文本(text),日期(date),对象(url)<br>
                    Len        --输出长度
                </div>
                <input type="hidden" name="labelcontent" id="KSContent_LabelContent" />
            </div>
        </div>  
          
        <div class="footer-page">
            <div class="footer-btn">
                <button type="button" class="btn btn-primary btn-s-md" onClick="do_reg();"><?php if(!empty($value)){?>确定修改<?php }else{ ?>确定添加<?php } ?></button>

                <button type="button" class="btn btn-default btn-s-md" onClick="parent.closeWindow(window.name)">取消</button>
            </div>
        </div>
        
    </form>

    </div>
</div>
<script src="/Public/common/drag/js/drag.assembly.js"></script>

<script src="/Public/drag/js/frame.format.js"></script>

<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>

<script>
var getFormatUrl = '/Public/drag/label/course.php';
if(location.href.indexOf('form-m')!=-1){
	getFormatUrl = '/Public/dragphone/label/course.php'
}

format.getFormatList({
    url:getFormatUrl,
    type:'course'
});

var pos=null;
function setPos()
{	
	if (document.all){
		$("#KSContent_LoopBody").focus();
		pos = document.selection.createRange();
	}else{
		pos = $("#KSContent_LoopBody")[0].selectionStart;
	}
}
var getIframeTimer;

function do_reg(){
	var hot=0;
	if ($('#hot')[0].checked) hot = 1;
	var allowcomment = 0;
	if ($('#allowcomment')[0].checked) allowcomment = 1;
	var roll=0;
	if ($("#roll")[0].checked)roll=1;
	var recommend=0;
	if ($("#recommend")[0].checked)recommend=1;
	var slide=0;
	if ($("#slide")[0].checked)slide=1;
	var classid='';
	
	$("#classid1 option:selected").each(function() {
		if ($(this).val()!='0')
			if (classid=='') 
				 classid=$(this).val() 
			else
				 classid+=","+$(this).val();
		})
	if (classid=='') classid='0';
	var str='{KS:Label Type="IList"'
	      + ' Basictype="'+$("#basictype").val()+'"'
		  + ' Appid="'+$("#appid").val()+'"'
		  + ' CacheTime="'+$('#CacheTime').val()+'"'
		  + ' Hot="'+hot+'"'
		  + ' Allowcomment="'+allowcomment+'"'
		  + ' Roll="'+roll+'"'
		  + ' Recommend="'+recommend+'"'
		  + ' Slide="'+slide+'"'
		  + ' ClassID="'+classid+'"'
		  + ' Order="'+$('#Order').val()+'"'
		  + ' Num="'+$('#Num').val()+'"'
		  + ' SQLCondition="' + $('#SQLCondition').val() + '"'
		  + '}' + $('#KSContent_LoopBody').val() + '{/KS:Label}'; 
		  
	$("#KSContent_LabelContent").val(str);
	if($("#basictype").val()==0){
		Alert('请选择应用的基类型!');return false;
	}
	if($("#appid").val()==0){
		Alert('请选择具体的应用!');return false;
	}
	$("#myform").submit();
}

function labelSuccessBack(data){
	if(location.href.indexOf('LabelAdd')!=-1){
		data.flag = 'add';
	}else{
		data.flag = 'edit';
	}
    data.windowName = window.name;
    parent.LabelBack(data);
}


function InsertLabel(fieldname,fieldtype)
{
	var appid=$("#appid").val();
    if(pos==null) {Alert('请先定位插入位置!');return false;}
    var url_model = '<?php echo URL_MODEL; ?>';

	if(url_model == '1')
	{
      addTypeChange('<?php echo M_URL('Label','LoopAdd');?>?fieldname-'+fieldname+',fieldtype-'+fieldtype+',appid-'+appid,'480px','420px');
	}else{
	  addTypeChange('<?php echo M_URL('Label','LoopAdd');?>&fieldname='+fieldname+'&fieldtype='+fieldtype+'&appid='+appid,'480px','420px');
	}
}
//插入到循环体
function InsertValue(Val) {
	if (pos == null) { Alert('请先定位插入位置!', null); return false; }
	if (document.all){
	   pos.text=Val;
	}else{
	   var obj=jQuery("#KSContent_LoopBody");
	   var lstr=obj.val().substring(0,pos);
	   var rstr=obj.val().substring(pos);
	   obj.val(lstr+Val+rstr);
    }
}
     

$(function(){
	var i =1;
	var h = $('#KSContent_LoopBody').height();
	//#click1 和#click2适用于增加textarea的高度
	$('#click1').click(function(){
		if(i<10)
		{
			h = h+50;
			$('#KSContent_LoopBody').height(h);
			i++;
	    }
	})
	//#click1 和#click2适用于增加textarea的高度 
	$('#click2').click(function(){
		if(i>1)
		{
			h = h-50;
			$('#KSContent_LoopBody').height(h);
			i--;
		}
	})
})
</script>
</body>
</html>