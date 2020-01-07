
<!DOCTYPE html>
<html>
<head >
    <title>无标题页</title>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <link href="/admin/images/style.css" rel="stylesheet" type="text/css" />
    <script src="../../admin/images/pannel/tabpane.js" type="text/javascript"></script>
    <link href="/admin/images/pannel/tabpane.CSS" rel="stylesheet" type="text/css" />
    <script src="/KS_Inc/Jquery.js" type="text/javascript"></script>
    <script src="/KS_Inc/Kesion.Common.js" type="text/javascript"></script>
    <script src="/admin/include/comm.js"></script>
    <script src="/KS_Inc/DatePicker/WdatePicker.js"></script>

    <!--<script src="/admin/images/icheck.js"></script>-->
    <script>
        $(document).ready(function(){

            //$('input[type="checkbox"],input[type="radio"]').iCheck({
            //  labelHover : false,
            //  cursor : true,
            //  checkboxClass : 'icheckbox_square-blue',
            //  radioClass : 'iradio_square-blue',
            //  increaseArea : '20%'
            //});
        });

    </script>


    <script type="text/javascript" charset="utf-8" src="/ks_inc/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/ks_inc/ueditor/ueditor.all.js"> </script>
    <script type="text/javascript" charset="utf-8" src="/ks_inc/ueditor/lang/zh-cn/zh-cn.js"></script>
    <!--[if IE 6]>
    <script src="/admin/include/iepng.js" type="text/javascript"></script>
    <script type="text/javascript">
        try{
            EvPNG.fix('div, ul, img, li, input, em, a, p,i,b,span,em,' );
        }catch(e){
        }
    </script>
    <![endif]-->
</head>
<body scroll="auto" class="scroll_Rcontent s1" style="">
<form name="aspnetForm" method="post" action="./ks.picmsg.aspx" id="aspnetForm">
    <div>
        <input type="hidden" name="__EVENTTARGET" id="__EVENTTARGET" value="" />
        <input type="hidden" name="__EVENTARGUMENT" id="__EVENTARGUMENT" value="" />
        <input type="hidden" name="__LASTFOCUS" id="__LASTFOCUS" value="" />
        <input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="/wEPDwUKLTg1MzgzNzMwMQ9kFgJmD2QWAmYPZBYCAgEPZBYEAgEPDxYCHgdWaXNpYmxlaGQWAmYPEGRkFgFmZAICD2QWBAIMDxYCHgtfIUl0ZW1Db3VudGYWAgIBD2QWAmYPFQEBIGQCDg9kFhACAw8PFgIeBFRleHQFATEWAh4Fc3R5bGUFK3RleHQtYWxpZ246Y2VudGVyO2JvcmRlcjoxcHggI2NjY2NjYyBzb2xpZDtkAgYPDxYCHwIFATBkZAIIDw8WAh8CBQIyMGRkAgoPDxYCHwIFATBkZAIMDw8WBh4IQ3NzQ2xhc3MFCGRpc2FibGVkHgdFbmFibGVkaB4EXyFTQgICZGQCDg8PFgYfBAUIZGlzYWJsZWQfBWgfBgICZGQCEg8PFgYfBAUIZGlzYWJsZWQfBWgfBgICZGQCFA8PFgYfBAUIZGlzYWJsZWQfBWgfBgICZGRkLRM/fQrxgiV52GtptSimwH8Fkb4=" />
    </div>

    <script type="text/javascript">
        //<![CDATA[
        var theForm = document.forms['aspnetForm'];
        if (!theForm) {
            theForm = document.aspnetForm;
        }
        function __doPostBack(eventTarget, eventArgument) {
            if (!theForm.onsubmit || (theForm.onsubmit() != false)) {
                theForm.__EVENTTARGET.value = eventTarget;
                theForm.__EVENTARGUMENT.value = eventArgument;
                theForm.submit();
            }
        }
        //]]>
    </script>


    <script src="/WebResource.axd?d=dH5AsPQAjT5AiDIj9nim7sNQCX1fzXXYrHLquC7hv2JbAmErqrpRW2PNnmE1&amp;t=636255676860000000" type="text/javascript"></script>

    <div>

        <input type="hidden" name="__VIEWSTATEGENERATOR" id="__VIEWSTATEGENERATOR" value="74A7D5E1" />
    </div>

    <link href="/admin/weixin/images/style.css?<?php echoHash(); ?>" rel="stylesheet" />
    <div id="manage_top" class="toptitle menu_top_fixed">素材管理</div><div class="menu_top_fixed_height"></div>
    <div class="content-area">
        <script>
            //加载的效果
            $(function () {
                var w = 250;
                var h = 50;
                $(".prompt_box").css("position", "fixed");
                $(".prompt_box").css("width", w).css("height", h);
                var x = ($(window).width() - w) / 2;
                var y = ($(window).height() - h) / 3;
                $(".prompt_box").css("top", y).css("left", x);
            });

        </script>
        <script type="text/javascript">
            function TongBu() {
                //同步
                //jQuery(parent.document).find("#ajaxmsg").toggle();
                $("#Loading").show();
                $.ajax({
                    url: ,'upDowmMenu',
                   // url: "KS.Picmsg.aspx?action=tongbu&rnd=" + Math.random(),
                    context: document.body,
                    type: "get",
                    success: function (data) {

                        if (data =='ok') {
                            KesionJS.Alert("恭喜,同步成功", "location.reload();");
                        } else {
                            KesionJS.Alert("对不起,同步失败", "location.reload();");
                        }
                        $("#Loading").hide();
                        //jQuery('#ajaxmsg', window.parent.document).fadeOut("slow");
                    }
                });
                return false;
            }
            function HuoQu(){
                //获取
                jQuery(parent.document).find("#ajaxmsg").toggle();
                $.ajax({
                    url: "KS.Picmsg.aspx?action=huoqu&rnd=" + Math.random(),
                    context: document.body,
                    type: "get",
                    success: function (data) {
                        // jQuery('#ajaxmsg', window.parent.document).toggle();
                        if (data =='ok') {
                            KesionJS.Alert("恭喜,获取成功", "location.reload();");
                        } else {
                            KesionJS.Alert("对不起,获取失败", "location.reload();");
                        }
                        jQuery('#ajaxmsg', window.parent.document).fadeOut("slow");
                    }
                });
                return false;


            }

        </script>

        <script>
            var num=0;
            var nowIndex=0;
            var oldnum=nowIndex;
            var editor='';
            $(function(){
                initialSelect();   //初始化选择中框
                if($("#default_title0").val()!='')
                {
                    $("#defaulttitle0").html($("#default_title0").val());
                }
                if($("#default_img0").val()!='')
                {
                    $("#img_box"+nowIndex).attr("src",$("#default_img0").val());
                }

                $('.sucai_img_list li').eq(0).click();

                for (var i=1;i<=num;i++)
                {
                    jQuery("#mybox1").append('<iframe class="editArea-ifrm" frameborder="no" border="0" src="KS.TuWenList.aspx?action=sucai&sucaiId=0" style="width:100%" name="iframemain'+i+'" id="iframemain'+i+'"> </iframe>');

                }
            });
            function initialSelect(){
                $('.sucai_img_list li').click(function(){
                    var k = $(this).attr("num");
                    oldnum=nowIndex;
                    nowIndex=k;
                    $('.sucai_img_list li').removeClass('xz');
                    $(this).addClass('xz');
                    fz(nowIndex);//赋值

                });

            }
            function fz(num)//赋值
            {
                var nowType=parseInt($("#default_type"+num).val());
                // alert(nowType);
                if (editor!=''&&nowType==0){
                    $("#default_content"+oldnum).html(editor.getContent());
                    editor.setContent('');
                }
                //切换添加面板
                $("#ctl00_KSContent_RadioButtonList1").find("input").each(function(){
                    if (parseInt($(this).attr("value"))==nowType){
                        $(this).attr("checked",true);
                    }
                });

                if (nowType==0){
                    jQuery("#xitongdetail").hide();
                    jQuery("#zidingyideatil").show();
                }else{
                    jQuery("#xitongdetail").show();
                    jQuery("#zidingyideatil").hide();
                }

                if (nowType==0){  //自定义的
                    if (editor!=''){
                        if ($("#default_content"+num).val()!=''){
                            editor.setContent($("#default_content"+num).val());
                        }else{
                            editor.setContent('');
                        }
                    }
                }else{  //系统
                    var keytype=$("#keytype"+num).val();
                    var id=$("#default_ID"+num).val();
                    $(".editArea-ifrm").hide().eq(num).show();
                    if(keytype==1)
                    {
                        $(".menu1box ul li").removeClass("hit");
                        $(".menu1box ul li").eq(0).addClass("hit");
                        $('#iframemain'+num).attr('src', 'KS.TuWenList.aspx?action=sucai&sendid='+num+'&sucaiId='+id);
                    }
                    else if(keytype==2){
                        $(".menu1box ul li").removeClass("hit");
                        $(".menu1box ul li").eq(1).addClass("hit");
                        $('#iframemain'+num).attr('src', 'KS.ShopList.aspx?action=sucai&sendid='+num+'&sucaiId='+id);
                    }
                }


                if($("#default_title"+num).val()!=''){
                    jQuery("#ctl00_KSContent_TxtTitle").val($("#default_title"+num).val());
                }
                else
                {
                    jQuery("#ctl00_KSContent_TxtTitle").val('');
                    // $("#ShowTxtTuWen0").html('');

                }

                if($("#default_url"+num).val()!=''){
                    jQuery("#ctl00_KSContent_TxtUrl").val($("#default_url"+num).val());
                }
                else
                {
                    jQuery("#ctl00_KSContent_TxtUrl").val('');
                }
                if($("#default_img"+num).val()!=''){
                    jQuery("#ctl00_KSContent_TxtPic").val($("#default_img"+num).val());
                }
                else
                {
                    jQuery("#ctl00_KSContent_TxtPic").val('');
                }
                if($("#default_intro"+num).val()!=''){
                    jQuery("#ctl00_KSContent_Txtinfo").val($("#default_intro"+num).val());
                }
                else{
                    jQuery("#ctl00_KSContent_Txtinfo").val("");
                }
                var checkrad =$("#default_ShowPic"+num).val();
                if(checkrad==1)
                {
                    $("#ctl00_KSContent_CheckBox1").attr("checked",true);
                }
                else{
                    $("#ctl00_KSContent_CheckBox1").attr("checked",false);
                }

            }

        </script>

        <script>
            function showStatus() {
                var checkrad = $("#ctl00_KSContent_RadioButtonList1 :radio[checked]").val();
                // alert(checkrad);
                if (checkrad == "1") {

                    if(confirm("确定切换到系统吗？"))
                    {
                        jQuery("#xitongdetail").show();
                        jQuery("#zidingyideatil").hide();
                        $("#default_type"+nowIndex).val('1');
                        clearziyi(nowIndex);//清空自定义

                        return true;
                    }
                    else{ //保留原状态
                        $("#ctl00_KSContent_RadioButtonList1").find("input").each(function(){
                            if (parseInt($(this).attr("value"))==parseInt($("#default_type"+nowIndex).val())){
                                $(this).attr("checked",true);
                            }
                        });
                        return false;

                    }
                } else {
                    if(confirm("确定切换到自定义吗？"))
                    {
                        jQuery("#xitongdetail").hide();
                        jQuery("#zidingyideatil").show();
                        $("#default_type"+nowIndex).val('0');
                        clear(nowIndex);//清空系统
                        return true;
                    }
                    else{  //保留原状态
                        $("#ctl00_KSContent_RadioButtonList1").find("input").each(function(){
                            if (parseInt($(this).attr("value"))==parseInt($("#default_type"+nowIndex).val())){
                                $(this).attr("checked",true);
                            }
                        });
                        return false;
                    }
                }

            }

            function checkboxOnclick(checkbox){
                if(checkbox.checked == true){
                    $("#default_ShowPic"+nowIndex).val('1');
                }
                else{
                    $("#default_ShowPic"+nowIndex).val('0');
                }
            }
            function Add(){
                if($(".sucai_img_list").find("li").length>=7)
                {
                    alert("对不起！,每个主多条图文的子多条图文最多只能7个!");
                    return;
                }
                num++;

                var defaultType=jQuery("#ctl00_KSContent_RadioButtonList1 :radio[checked]").val();
                var keytype=$("#keytype"+num).val();

                jQuery("#mybox1").append('<iframe class="editArea-ifrm" frameborder="no" border="0" src="KS.TuWenList.aspx?action=sucai&sucaiId=0" style="width:100%" name="iframemain'+num+'" id="iframemain'+num+'"> </iframe>');

                $("#tiaoshu").val(num);
                var str='<li id="appmsg_item'+num+'" num="'+num+'" >'
                    +'<div class="left_img_box_list">'
                    +'<div class="add_sc_img">'
                    +'<div class="add_sc_img_right">'
                    +'<img src="/SysImg/nopic.gif"  id="img_box'+num+'"/>'
                    +'</div>'
                    +'<div class="add_sc_img_left'+num+'" id="defaulttitle'+num+'">'
                    +'<a class="title_add_sc">标题</a>'
                    +'</div>'

                    +'<div class="clear"></div>'
                    +'</div>'
                    +'<div class="sc_default_title_bg">'
                    +'<a href="javascript:del('+num+')" class="order_by_delete"><img src="/admin/weixin/images/scdelete.png" /></a>'
                        //+'<a title="上移" href="javascript:;" onclick="pic_move(this,1);">上移</a>'
                    +'</div>'
                    +'</div> '
                    +' <input type="hidden" name="default_title'+num+'" id="default_title'+num+'" />'
                    +' <textarea id="default_content'+num+'" name="default_content'+num+'" cols="20" rows="2" style="display:none"></textarea>'
                    +' <input id="keytype'+num+'"  name="keytype'+num+'" value="1" type="hidden"  />'

                    +' <input type="hidden" name="default_url'+num+'" id="default_url'+num+'"/>'
                    +' <textarea name="default_intro'+num+'" id="default_intro'+num+'" style="display:none"></textarea>'
                    +' <input type="hidden" name="default_img'+num+'" id="default_img'+num+'"  />'
                    +' <input type="hidden" name="default_type'+num+'" id="default_type'+num+'" value="'+defaultType+'" />'
                    +' <input type="hidden" name="default_ID'+num+'>" id="default_ID'+num+'" value="0"/>'
                    +' <input type="hidden" name="default_ShowPic'+num+'" value="0" id="default_ShowPic'+num+'" />'
                    +' <input type="hidden" name="default_tuwen'+num+'" id="default_tuwen'+num+'" />'
                    +' <input type="hidden" name="default_shop'+num+'" id="default_shop'+num+'" />'

                    +' <input id="TxtTuWenID'+num+'" type="hidden"  name="TxtTuWenID'+num+'"/>'
                    +' <input id="TxtShopID'+num+'" type="hidden"  name="TxtShopID'+num+'"/>'
                    +'<textarea id="ShowTxtTuWen'+num+'" style="width:300px;height:200px;display:none"></textarea>'
                    +'<textarea id="ShowTxtShop'+num+'" style="width:300px;height:200px;display:none"></textarea>'
                    +'</li>';

                $(".sucai_img_list").append(str);
                initialSelect();

            }

            function del(id){
                // $("#tiaoshu").val(num);
                $("#appmsg_item"+id).remove();

            }
            function deletesucai(id,sucaiid){
                $.ajax({
                    url: "KS.Picmsg.aspx?action=deletechild&childID="+sucaiid,
                    context: document.body,
                    type:"get",
                    success: function (data) {
                        if (data =='ok') {
                            $("#appmsg_item"+id).remove();
                            KesionJS.Alert("删除成功");
                        } else {
                            KesionJS.Alert("删除失败");
                        }
                    }
                });
            }
            function pic_move(obj,fx){
                var box_d=jQuery(obj).parent().parent().parent();
                var box_fx='';
                if (fx==1)
                {
                    box_fx=box_d.prev();
                }
                else
                {box_fx='';}
                if ( box_fx.length > 0 ) {
                    if(fx==1) box_fx.before(box_d.clone());
                    if(fx==1 )box_d.remove();
                }


            }
            //设置编辑器内容
            function setcontent(){
                if (parseInt($("#default_type"+nowIndex).val())==0){
                    $("#default_content"+nowIndex).val(editor.getContent());
                }
            }
            function out_title(){
                var titile=jQuery("#ctl00_KSContent_TxtTitle").val();
                $("#defaulttitle"+nowIndex).html(titile);
                $("#default_title"+nowIndex).val(titile);
                setcontent();
            }
            function out_pic(){
                var pic=jQuery("#ctl00_KSContent_TxtPic").val();
                $("#img_box"+nowIndex).attr("src",pic);
                $("#default_img"+nowIndex).val(pic);
                setcontent();
            }

            function out_intro(){
                var info=jQuery("#ctl00_KSContent_Txtinfo").val();
                $("#default_intro"+nowIndex).val(info);
                setcontent();
            }
            function out_url(){
                var url=jQuery("#ctl00_KSContent_TxtUrl").val();
                $("#default_url"+nowIndex).val(url);
                setcontent();
            }
            function check(){
                setcontent();
                for(var i=0;i<=num;i++)
                {
                    var title=$("#default_title"+i).val();
                    var pic=$("#default_img"+i).val();
                    var info=$("#default_intro"+i).val();
                    var url=$("#default_url"+i).val();
                    var content=$("#default_content"+i).val();
                    var default_type=parseInt($("#default_type"+i).val());

                    if (title!=undefined && title==''){
                        if (default_type==1){
                            KesionJS.Alert("请选择图文消息"+i);
                        }else{
                            KesionJS.Alert("请输入标题","$('#ctl00_KSContent_TxtTitle').focus();");
                        }
                        return false;
                    }
                    if(pic!=undefined && pic==''){
                        KesionJS.Alert("请上传图片","$('#ctl00_KSContent_TxtPic').focus();");
                        return false;
                    }
                    if (default_type==0){

                        if(content!=undefined && content==''){
                            KesionJS.Alert("请输入内容","editor.focus();");
                            return false;
                        }
                        if(info!=undefined && info==''){
                            KesionJS.Alert("请输入摘要","$('#ctl00_KSContent_Txtinfo').focus();");
                            return false;
                        }
                        if(url!=undefined && url==''){
                            KesionJS.Alert("请输入链接","$('#ctl00_KSContent_TxtUrl').focus();");
                            return false;
                        }

                    }

                }
                return true;

            }

            function clear(nowIndex){
                //alert(nowIndex);
                $("#defaulttitle"+nowIndex).html('标题');
                $("#img_box"+nowIndex).attr("src",'/SysImg/nopic.gif');
                $("#default_img"+nowIndex).val('');
                $("#default_url"+nowIndex).val('');
                $("#default_intro"+nowIndex).val('');
                $("#default_title"+nowIndex).val('');
                $("#default_content"+nowIndex).html('');


                jQuery("#ctl00_KSContent_TxtUrl").val('');
                jQuery("#ctl00_KSContent_Txtinfo").val("");
                jQuery("#ctl00_KSContent_TxtTitle").val('');
                jQuery("#ctl00_KSContent_TxtPic").val('');
                editor.setContent('');

            }
            function clearziyi(nowIndex)
            {
                $("#defaulttitle"+nowIndex).html('标题');
                $("#img_box"+nowIndex).attr("src",'/SysImg/nopic.gif');
                $("#default_img"+nowIndex).val('');
                $("#default_title"+nowIndex).val('');

            }
        </script>

        <script>

            $(function () {
                $(".menu1box ul li").click(function () {
                    var k = $(this).index();
                    aa(k);
                });
            });
            function aa(k) {

                // alert(nowIndex);
                // return;
                var sucaiId=$("#default_ID"+nowIndex).val();

                $(".menu1box ul li").each(function (index, domEle) {
                    $(this).attr("class", "");
                });
                $(".menu1box ul li").each(function (index, domEle) {
                    if (k == index) {
                        if (k == 0) {
                            $("#keytype"+nowIndex).val('1');


                            $('#iframemain'+nowIndex).attr('src', 'KS.TuWenList.aspx?action=sucai&sendid='+nowIndex+'&sucaiId='+sucaiId);
                        }  else if (k == 1) {
                            $("#keytype"+nowIndex).val('2');
                            // alert("dd=="+nowIndex);
                            $('#iframemain'+nowIndex).attr('src', 'KS.ShopList.aspx?action=sucai&sendid='+nowIndex+'&&sucaiId='+sucaiId);
                        }

                        $(this).attr("class", "hit");
                    }
                });

            }


        </script>

        <div class="prompt_bg" style="display:none" id="Loading">
            <div class="prompt_box">
                <p><img src="/admin/weixin/images/loading.gif" />正在同步，请耐心等待...</p>
            </div>
        </div>

        <div class="content_wrap1">
            <div id="ctl00_KSContent_Panel2">

                <div class="search" style="margin-left: 2.4%; width:40%;">
                    <input name="ctl00$KSContent$TxtKey" type="text" id="ctl00_KSContent_TxtKey" class="search_box" />
                    <input type="submit" name="ctl00$KSContent$buttonsearch" value=" " id="ctl00_KSContent_buttonsearch" class="search_btn" />


                </div>

                <div style="float:right;margin-right: 20px;"><input type="submit" name="ctl00$KSContent$TbButton" value="同步素材" onclick="return(TongBu());" id="ctl00_KSContent_TbButton" class="add_sc_button" style=" margin-left:10px;" />
                    <input type="submit" name="ctl00$KSContent$Button1" value="+添加素材" id="ctl00_KSContent_Button1" class="add_sc_button" style=" margin-left:10px;" />
                    <input type="submit" name="ctl00$KSContent$Btn_Del" value="删除素材" onclick="if (GetIDS(&#39;del&#39;)){return true}else{return false};" id="ctl00_KSContent_Btn_Del" class="add_sc_button" style=" margin-left:0;" />
                    <span class="quanxuan" style="float:right; height:29px; line-height:29px;"><input type="checkbox" name="chkall" id="chkall" onClick="CheckAll(this.form);" style=" vertical-align:middle;"/>全选</span>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
                <div class="sc_show_conlist">

                    <ul class="sc_ul_con">

                        <div class="clear"></div>
                    </ul>
                    <div class="clear"></div>
                    <div class="norecord" style="display: ; text-align:center;">
                                        <span style="text-align:center">
                                            暂无素材
                                        </span>
                    </div>

                </div>


                <div class="footer_page">
                    <table cellpadding="0" cellspacing="0" style="width: 100%;">
                        <tr>
                            <td> &nbsp;</td>
                            <td style="font-size: 9pt; height: 25px; text-align: right"  onclick="jQuery('#aspnetForm').removeAttr('target');">
                                <span id="ctl00_KSContent_Page1_Label7">当前页码为：</span>
                                <input name="ctl00$KSContent$Page1$labPage" type="text" value="1" onchange="javascript:setTimeout(&#39;__doPostBack(\&#39;ctl00$KSContent$Page1$labPage\&#39;,\&#39;\&#39;)&#39;, 0)" onkeypress="if (WebForm_TextBoxKeyHandler(event) == false) return false;" id="ctl00_KSContent_Page1_labPage" style="width:30px;text-align:center;border:1px #cccccc solid;" />
                                &nbsp; &nbsp;
                                <span id="ctl00_KSContent_Page1_Label6">总页数：</span><span id="ctl00_KSContent_Page1_labTotalPage">0</span>页 每页显示：<span id="ctl00_KSContent_Page1_labperpagenum">20</span>条

                                总记录：<span id="ctl00_KSContent_Page1_labrecordcount">0</span>条
                                <a id="ctl00_KSContent_Page1_lnkbtnOne" disabled="disabled" class="disabled" style="text-decoration:none;">首页</a>
                                <a id="ctl00_KSContent_Page1_lnkbtnUp" disabled="disabled" class="disabled" style="text-decoration:none;">上一页</a>

                                <a id="ctl00_KSContent_Page1_lnkbtnNext" disabled="disabled" class="disabled" style="text-decoration:none;">下一页</a>
                                <a id="ctl00_KSContent_Page1_lnkbtnBack" disabled="disabled" class="disabled" style="text-decoration:none;">末页</a>
                                &nbsp;
                            </td>
                        </tr>
                    </table>
                </div>

            </div>

        </div>

    </div>


</form>
<script>
    jQuery(document).ready(function () {
        var a = jQuery("#aspnetForm").attr("action");
        if (a.indexOf('/') != -1) {
            var arr = a.split('/');
            a = arr[arr.length - 1];
            jQuery("#aspnetForm").attr("action", a);
        }
    });
</script>
</body>
</html>