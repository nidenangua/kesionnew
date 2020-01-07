<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit"> 
<title>添加学生</title>
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/imageslist.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
</head>
<style>
   
</style>
<body class="ks-wrap">
    <div class="clearfix">
        <div class="fl">
            <div class="ks-search-box">
            <form id="sousuo" method="post" enctype="multipart/form-data" action="<?php echo M_URL($this->AppName.'/Index','getColumnList'); ?>">
                <!--搜索-->
                <select class="w150 inputText bRadius5 fl" id="keytype" name="type">
                    <?php foreach ($typeName as $k=>$v) {?>
                    <option value="<?php echo $k?>" <?php if($type==$k){echo 'selected="selected"';} ?>><?php echo $v?></option>
                    <?php }?>
                </select>
                <div class="fl ks-top-search">
                    <input type="text" class="sc-text " name="keyword" id="keyword" value="<?php if(!empty($keyword)) echo $keyword; ?>" placeholder="标题" >
                    <button type="submit" class="ks-head-search" onclick="sousuo()" ><i class="iconfont icon-sousuo"></i></button>
                </div>
            </form>
        </div>          
    </div>      
    <div class="fr">
        <ul class="ks-head-choice">
            <li>
                <!-- <div class="ks-head-el">
                    <a class="ks-heade-button ks-head-primary" href="javascript:void(0)" onclick="excelUser();" id="addStudent"><i class="iconfont icon-jiahao"></i>excel导入学员</a></a>
                </div> -->
            </li>
        </ul>
    </div>                      
</div>
    <table class="ks-table" style="    margin-top: 32px;">
        <tbody>
        <?php foreach ($values as $k => $v) { ?>
            <tr class="checked">
                <td style="width: 30px;">
                    <input type="checkbox" class="select-checks" name="infoid[]" value="<?php echo $v['infoid'] ?>" >
                </td>
                <td><img src="<?php echo Img($v['defaultpic'])?>" class="defaultpic" style="width:93px;float:left"></td>
                <td style="text-align: left;" class="title"><?php echo $v['title']; ?></td>
                <td class="price"><?php if($v['chargetype']!=1){echo '免费';}else{echo '￥'.$v['price'];}?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
<div class="clearfix ks-popup-footer">
    <div class="fl mt20">
        <span class="ks-bt bt-def mr10 ks-ctn" id="selectAll" >
                <input type="checkbox" class="fl select-checks selectAll" style="margin-top: 6px;" >全选
            </span>
        <input type="button"  class="ks-bt bt-pue mr15" value="确定" name="confirm">
    </div>
    <div class="fr mt20"><?php echo $page->show(3); ?></div>
</div>
</body>
</html>
<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>

<script>
    
    module.require(['$','backstage','nicescroll','cookie'],function(){
            loadScorllJs(); 
            

        $('#keytype').change(function () {
            var type = $('select[name="type"]').val();
            window.location.href = '/home.html/team/Index/getColumnList?type-'+type;
        })
        $('input[name="confirm"]').click(function () {
            $('.checked').each(function(){
                if ($(this).find(".select-checks").is(':checked')==true){
                    var id = $(this).find(".select-checks").val();
                    var img = $(this).find("img").attr('src');
                    var title = $(this).find(".title").html();
                    var price = $(this).find(".price").html();
                    var type = '<?php echo $type;?>';
                    var typeName = '<?php echo $typeName[$type];?>';
                    var html ='';
                    html+= '<div class="form-row"><div class="correlationItem"><div class="itemImageWrapper"><img src="'+img+'"></div><div class="infoWrapper"><div class="infoTitle">'+title+'</div>';
                    html+='<div class="infoPrice">'+price+'</div>';
                    html+='<input name="infoid[]" type="hidden" value="'+id+'">';
                    html+='<input name="type[]" type="hidden" value="'+type+'">';
//                    html+='<input name="img[]" type="hidden" value="'+img+'">';
//                    html+='<input name="infotitle[]" type="hidden" value="'+title+'">';
//                    html+='<input name="infoprice[]" type="hidden" value="'+price+'">';
//                    html+='<input name="typeName[]" type="hidden" value="'+typeName+'">';
                    html+='</div><div class="infoType">'+typeName+'</div><div class="itemIconBtn" onclick="del(this)">取消关联</div></div></div>'
                    top.frames['main'].$('#appendhtml').append(html);
                }

            });

            top.closePopup(window.name);
        })

    })
  
    function sousuo(){
        $('#sousuo').submit();
    }
    function getTK(obj,ary=[]){
        var ary=[];
        var columAry = <?php echo json_encode($values); ?>;
        for (var i=0;i<columAry.length;i++) {
            if(columAry[i].columnid == obj.value.replace(/\s*/g,"")){
               ary = columAry[i]
            }
        }
        obj.checked ? resetCookie(obj.value,1,ary) : resetCookie(obj.value,0)
        
        
    }
    
    //type 0减少 1增加
    function resetCookie(v,type,ary=[]){
        
        var columnlist = $.cookie('infolist');
        var columnAry  = $.cookie('infoAry');
        if(columnlist){
            var data = columnlist.split('|');
            var newStr = '';
            var newcolumnAry = [];
            for(var i=0;i<data.length;i++){
                if(data[i] != v){
                    !newStr ? newStr=data[i] : newStr+='|'+data[i]
                }
            }
            if(columnAry!=0){
                var jsonary = JSON.parse(columnAry)
               for (var i=0;i<jsonary.length;i++) {
                    if(jsonary[i].columnid != v.replace(/\s*/g,"")){
                       newcolumnAry.push(jsonary[i])
                    }
                }
                
            }
            if(type === 1){
                if(ary){
                    newcolumnAry.push(ary)
                }
            }
            type === 1 && (newStr += '|'+v)
            columnlist = newStr
        }else{
            if(type==1){
                columnlist = v;
            }
        }

        $.cookie('infolist',columnlist,{ expires: 7, path: '/' });
        if(newcolumnAry.length!=0){
            $.cookie('infoAry',JSON.stringify(newcolumnAry),{ expires: 7, path: '/' });
        }else{
            $.cookie('infoAry','0',{ expires: 7, path: '/' });
        }
        
        
    }
    
    function addtk(){
        var html='</div><div class="infoType">专栏</div><div class="itemIconBtn"  >取消关联</div></div></div>';

//        var columnlist = $.cookie('infolist');
//        var columnAry  = $.cookie('infoAry');
        parent.$('#appendhtml').append(html);
//        top.DataCallBack(columnlist);

        top.closePopup(window.name);

    }
    top.DataCallBack = function(columnlist){
        var Tk =columnlist.split("|");
        parent.$('#columnidbox').val(columnlist);
        var columnAry  = $.cookie('infoAry');
        var newary = JSON.parse(columnAry)
        var html ='';
        for (var i = 0; i<newary.length; i++) {
            html+= '<div class="form-row"><div class="correlationItem"><div class="itemImageWrapper"><img src="'+newary[i].defaultpic+'"></div><div class="infoWrapper"><div class="infoTitle">'+newary[i].title+'</div>';
            if(newary[i].chargetype!=1){
                html+='<div class="infoPrice">免费</div>';
            }else{
                html+='<div class="infoPrice">'+newary[i].price+'</div>'
            }
            html+='</div><div class="infoType">专栏</div><div class="itemIconBtn"  onclick="cel(this,'+newary[i].columnid+')">取消关联</div></div></div>'
        }
        parent.$('#appendhtml').html(html)
    }
</script>

    
</script>

