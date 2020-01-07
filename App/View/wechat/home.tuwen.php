<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
     <META HTTP-EQUIV="pragma" CONTENT="no-cache"> 
<META HTTP-EQUIV="Cache-Control" CONTENT="no-cache, must-revalidate"> 
<META HTTP-EQUIV="expires" CONTENT="0">

    <title>修改会员</title>
    
   <link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
   <link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
   <link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css" rel="stylesheet">
   
   	<link href="<?php echo UOOT;?>Public/popup/css/kesion.popup.css" rel="stylesheet">
    

    <style>
        .re-btn {position: absolute;right: 65px;top: -8px}
        .a-upload {
            padding: 4px 10px;
            height: 32px;
            line-height: 20px;
            position: relative;
            cursor: pointer;
            color: #888;
            background: #fafafa;
            border: 1px solid #ddd;
            border-radius: 4px;
            overflow: hidden;
            display: inline-block;
            *display: inline;
            *zoom: 1
        }
        #fly{
            display: none;
        }

        .a-upload  input {
            position: absolute;
            font-size: 100px;
            right: 0;
            top: 0;
            opacity: 0;
            filter: alpha(opacity=0);
            cursor: pointer
        }

        .a-upload:hover {
            color: #444;
            background: #eee;
            border-color: #ccc;
            text-decoration: none
        }
		.selectImageBtn {
    width: 90px;
    height: 35px;
    line-height: 35px;
    text-align: center;
    background: #f5f8f9;
    cursor: pointer;
    border: 1px solid #e6e9ea;
    display: inline-block;
}
        .mt10{margin-left: 10px}
        .modal-dialog {z-index: 2050 !important;}
		 .mt7{
        margin-top: 7px;
    }
    .mr20 {
        margin-right: 20px;
    }
	.mt20{margin-top:10px;}
	.tab-pane{display:none;margin-top: 35px;}
        .div_right{ position: fixed;right:40px;top:100px;width: 330px;}
        .deault_img_box{border:1px solid #ccc;height:215px ;position: relative;}
         .deault_img_box2{border:1px solid #ccc;margin-top:-1px;height:80px ;position: relative;padding: 10px;}
         .deault_img_box2 .wechat-imgbox2-title{width: 220px;font-size: 14px;color: #000;float: left;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;line-height: 60px;}
         .deault_img_box2 .wechat-imgbox2-img{width: 60px;height: 60px;background: #333;float: right;}
          .deault_img_box2 .wechat-imgbox2-img img{width: 100%;height: 100%;}
        .clear{ clear:both}
        .div_left{margin-right:385px;}
    .deault_img_box .wechat-box-mask{position: absolute;width: 100.5%;height: 40px;line-height: 30px;padding: 5px 10px;font-size: 15px;color: #fff;white-space: nowrap;text-overflow: ellipsis;bottom: -1px;overflow: hidden;background: rgba(0,0,0,0.2);}
    .deault_img_box2 .wechat-box-mask{position: absolute;width: 100.5%;height: 30px;line-height: 20px;padding: 5px 10px;font-size: 15px;color: #fff;white-space: nowrap;text-overflow: ellipsis;bottom: -1px;left:0px;overflow: hidden;background: rgba(0,0,0,0.2);display: none;}
    .deault_img_box img{width:330px;height:215px;border: none;}
    
    </style>

</head>
<body class="gray-bg">
<div class = "div_right">
    <div class = 'deault_img_box deault-num' id ="deault_img_box">
        <img id="images1" src="/Public/uploads/common/timg.jpg" alt="图片"/>
        <p class="wechat-box-mask" id="title1"><?php if(!empty($tuwen)) echo $tuwen['title'] ?></p>
    </div>
    <button onclick="copyText()" class="btn btn-primary btn-s-md" style="margin: 0 auto;display: block;">Copy Text</button>
</div>

<div  class = 'div_left'>
<form target="hidframe" method="post" id="myform"
      action="<?php echo M_URL($this->AppName.'/Index','doAddTuwen','',GP("")); ?>"
      class="form-horizontal" enctype="multipart/form-data">
     <input type="hidden" name="parentid1"  value="0" />
      <input type="hidden" name="wechat-num" value="1" />
    <input type="hidden" name="sucaitype1" value=0 />
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
           <div id="manage_top " class="menu_top_fixed p15 height73">
                <div class="ibox-title">
                <h3 class="fl"><?php echo '新建图文消息'; ?></h3>
                <a class="btn btn-info btn-rounded btn-s-md mt7" href="javascript:history.go(-1);" style="margin-left:15px">返回</a>
                <div class="ibox-tools">
                    <div class="re-btn"></div>
                    <a href="javascript:void(0)" onclick="history.go(0)" class="collapse-link">
                         <i class="icon iconfont">&#xe6aa</i>
                    </a>
                </div>
                </div>
           </div>
            <div class="tabs-container">
              <div class="tab-content">
                  <div  class="tab-pane" id="tab-pane1" style="display: block;">
                <div class="panel-body">
                 	<div class="row">
                        <div class="ibox-content">
                        <br/><br/>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">标题</label>
                            <div class="col-sm-4" >
                                <input type="text"  class="form-control" name="title1" value="<?php if(!empty($tuwen)) echo $tuwen['titles'] ?>">
                            </div>
                        </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">作者</label>
                                <div class="col-sm-4" >
                                    <input type="text"  class="form-control" name="author1" value="<?php if(!empty($tuwen)) echo $tuwen['author'] ?>" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">内容</label>
                                <div class="col-sm-4" >
                                    <textarea id="contText1" name="text1"><?php if(!empty($tuwen)) echo $tuwen['text'] ?></textarea>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                            <label class="col-sm-2 control-label">摘要</label>
                            <div class="col-sm-4" >
                                <textarea rows="4" cols="63" name="abstract1"><?php if(!empty($tuwen)){echo $tuwen['abstract'];}?></textarea>
                            </div>
                        </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">原文链接</label>
                                <div class="col-sm-3" >
                                    <input type="text"  class="form-control" name="linkurl1" value="<?php if(!empty($tuwen)){echo $tuwen['linkurl'];} ?>">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">封面</label>
                                <div class="col-sm-4">
                                    <div class="control-group js_uploadBox1">
                                        <div class="btn-upload clearfix">
                                            <a href="javascript:void(0);" class="selectImageBtn selectImageBtn1 c-89 fsize14 fl mr10 bRadius5"><span class="js_uploadText1">上传图片</span></a>
                                            <span class="fl c-d0 fsize12" style="height:37px; line-height:37px;">限制：2MB,支持jpg|png|gif</span>
                                            <input class="hide js_upFile" type="file" name="url1" id="upImg1">
                                        </div>
                                        <div class="js_showBox1 mt10"><img class="js_logoBox block" src="/Public/uploads/common/timg.jpg" width="160" ></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
               </div>
              </div>



              </div>
   </div>
            <div class="mt10">
     <div class="col-sm-2"></div>
     <div class="col0sm-2">
     	
        <button type="submit" class="btn btn-primary btn-s-md ">保存</button>
         <a href="javascript:history.go(-1);" class="btn btn-s-md btn-default">保存并群发</a>
    </div>
</div>
</form>
</div>
</div>
</div>
<div class="clear"></div>

<textarea id="editorCode" style="display: none;"><?php echo $text;?></textarea>


<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<!-- popup js-->
<script src="<?php echo UOOT;?>Public/popup/js/kesion.popup.js"></script>
<!--//popup js end-->

<script src='/Public/kindeditor/kindeditor-min.js'></script>

<script>

/*参数说明
 *1.宽
 *2.高
 *3.实际触发的上传按钮id名称
 *4.上传成功后文字变换的对象
 *5.上传的大容器名称
 *6.预览容器的名称
 *7.触发的上传按钮 
 */


uploadView('100','100','upImg1','js_uploadText1','js_uploadBox1','js_showBox1','selectImageBtn1');

loadScorllJs();
getEditor(1);

var editor; //编辑器

function getEditor(id){
	
	KindEditor.ready(function(K) {
        editor = K.create('#contText'+id+'', {
            allowFileManager : true,
            width : '700px',
            height: '300px',
            resizeType: 0  ,afterBlur:function(){this.sync();}
        });
   });
}
var imagesObjectId = 1;
var $tabContent = $('.tab-content');


$tabContent.on('click','.selectImageBtn',function(){
	imagesObjectId = $(this).find('span')[0].className.split('js_uploadText')[1]
	
})
//图片上传成功回调
var uploadCallBack = function(src){
	console.log(src)
	$('#images'+imagesObjectId+'').attr('src',src);
	
}  

 
 //默认选项卡内容
 var defalutArrow = {
 	 title:'默认标题',
 	 images:'/Public/uploads/common/timg.jpg'
 }
 var editorCode = '';

 function getTabPane(id){
 	var tabPane = '<div  class="tab-pane" id="tab-pane'+id+'">'+
                '<div class="panel-body">'+
                 	                                  '<div class="row">'+
                        '<div class="ibox-content">'+
                        '<br/><br/>'+
                    '<input type="hidden" name="parentid'+id+'"  value="<?php if(!empty($maxId)){ echo $maxId+1;}else{ echo 1;}?>"/>'+
        '<input type="hidden" name="sucaitype'+id+'"  value="0" />'+
                        '<div class="form-group">'+
                            '<label class="col-sm-2 control-label">标题</label>'+
                            '<div class="col-sm-4" >'+
                            '<input type="text" class="form-control" name="title'+id+'" value="'+defalutArrow.title+'">'+
                            '</div>'+
                        '</div>'+
                            '<div class="form-group">'+
                                '<label class="col-sm-2 control-label">作者</label>'+
                                '<div class="col-sm-4">'+
                                    '<input type="text"  class="form-control" name="author'+id+'" value="" >'+
                                '</div>'+
                            '</div>'+
                            '<div class="form-group">'+
                                '<label class="col-sm-2 control-label">内容</label>'+
                                '<div class="col-sm-4" >'+
                                '<textarea id="contText'+id+'" name="text'+id+'"></textarea>'+
                                '</div>'+
                            '</div>'+
                            '<div class="hr-line-dashed"></div>'+
                            '<div class="form-group">'+
                            '<label class="col-sm-2 control-label">摘要</label>'+
                            '<div class="col-sm-4" >'+
                                '<textarea rows="4" cols="63" name="abstract'+id+'"></textarea>'+
                            '</div>'+
                        '</div>'+
                            '<div class="hr-line-dashed"></div>'+
                            '<div class="form-group">'+
                                '<label class="col-sm-2 control-label">原文链接</label>'+
                               '<div class="col-sm-3" >'+
                                    '<input type="text"  class="form-control" name="linkurl'+id+'" value="">'+
                                '</div>'+
                            '</div>'+
                            '<div class="hr-line-dashed"></div>'+
                            '<div class="form-group">'+
                               '<label class="col-sm-2 control-label">封面</label>'+
                                '<div class="col-sm-4">'+
                                   '<div class="control-group js_uploadBox'+id+'">'+
                                        '<div class="btn-upload clearfix">'+
                                           '<a href="javascript:void(0);" class="selectImageBtn selectImageBtn'+id+' c-89 fsize14 fl mr10 bRadius5"><span class="js_uploadText'+id+'">上传图片</span></a>'+
                                          '<span class="fl c-d0 fsize12" style="height:37px; line-height:37px;">限制：2MB,支持jpg|png|gif</span>'+
                                           '<input class="hide js_upFile" type="file" name="url'+id+'" id="upImg'+id+'">'+
                                        '</div>'+
                                        
                                        '<div class="js_showBox'+id+' mt10"><img class="js_logoBox block" src="'+defalutArrow.images+'" width="160" ></div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                 '</div>'+
               '</div>';
     return tabPane;
 };
 
 var num = $('.tab-pane').length;

$('#sss').val(num);

function copyText() {
 	num++;
 	if(num<=5){
 		  var str = '<div class="deault_img_box2 clearfix deault-num" id="img_box'+num+'"><p class="wechat-imgbox2-title" id="title'+num+'">'+defalutArrow.title+'</p><div class="wechat-imgbox2-img"><img src="'+defalutArrow.images+'" id="images'+num+'" /></div><p class="wechat-box-mask"><span style="float:right"><img src="/Public/uploads/image/scdelete.png" onclick="deleteDiv('+num+')"/><span><p></div>';
     
     $(".div_right").find('.deault-num:last').after(str);
     
     var cont = getTabPane(num);
     $tabContent.append(cont);
      //渲染编辑器
      getEditor(num);
      //显示新增选项卡
      tabPaneShow(num);
      //上传事件
      uploadView('160','100','upImg'+num+'','js_uploadText'+num+'','js_uploadBox'+num+'','js_showBox'+num+'','selectImageBtn'+num+'');
      //标题回传事件
      keyupBack(num);
      //隐藏层获取
      $('input[name="wechat-num"]').val(num);
 	}
 	else{
 		popup.tips({
 			title:'您最多只可以发布5条信息'
 		})
 	}
   

 }
 
 function save(){
	
	//editor.sync();
	console.log($('textarea[name="text1"]').val())
	return false
	
}
 
 function tabPaneShow(index){
 	index-=1;
 	$tabContent.find('.tab-pane').eq(index).show().siblings('.tab-pane').hide();
 	
 }
 
 
 $(".div_right").on('click','.deault-num',function(){
 
 	$('.div_left').find('.tab-pane').eq($(this).index()).show().siblings().hide();
 	
 });
 

 keyupBack(1);
 function keyupBack(id){
 	$('input[name="title'+id+'"]').keyup(function(){
 		console.log(1)
	 	$('#title'+id+'').html($(this).val());
	 });
 };
 
 $(".div_right").on('mouseover','.deault_img_box2',function(){
 	$(this).find('.wechat-box-mask').show();
 });
  $(".div_right").on('mouseout','.deault_img_box2',function(){
 	$(this).find('.wechat-box-mask').hide();
 });
 	
 function deleteDiv(i){

 	$("#img_box"+i).remove();
 	num--;
    $('input[name="wechat-num"]').val(num);
 	
 }	

 
</script>
</body>
</html>
