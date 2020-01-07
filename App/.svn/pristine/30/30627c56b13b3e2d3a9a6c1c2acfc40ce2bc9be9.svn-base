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
<body class="ks-wrap">
    <div class="clearfix">
        <div class="fl">
            <div class="ks-search-box">
            <form target="hidframe">
                <!--搜索-->
                <div class="fl ks-top-search">
                    <input type="text" class="sc-text " name="searchText" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>" >
                    <button type="submit" class="ks-head-search" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','othershow'); ?>','<?php echo URL_MODEL;?>')"><i class="iconfont icon-sousuo"></i></button>
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
            <tr>
                <td style="width: 30px;">
                    <input type="checkbox" class="select-checks" id="columnid<?php echo $v['columnid'] ?>" name="columnid[]" value="<?php echo $v['columnid'] ?>" onclick="getTK(this)" >
                </td>
                <td><img src="<?php echo Img($v['defaultpic'])?>" class="defaultpic" style="width:93px;float:left"></td>
                <td style="text-align: left;"><?php echo $v['title']; ?></td>
                <td><?php if($v['chargetype']!=1){echo '免费';}else{echo '￥'.$v['price'];}?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table> 
<div class="clearfix ks-popup-footer">
    <div class="fl mt20">
        <span class="ks-bt bt-def mr10 ks-ctn" id="selectAll" >
                <input type="checkbox" class="fl select-checks selectAll" style="margin-top: 6px;" >全选
            </span>
        <input type="button" onclick="addtk();" class="ks-bt bt-pue mr15" value="确定" name="confirm">
    </div>
    <div class="fr mt20"><?php echo $page->show(3); ?></div>
</div>
<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>

<script>
    
    module.require(['$','backstage','nicescroll','cookie'],function(){
            loadScorllJs(); 
            
        var columnlist = $.cookie('columnlist');
        var columnAry = $.cookie('columnAry');
        
        if(columnlist){
           var ab =columnlist.split("|");
           for(var i=0;i<ab.length;i++){
               $("#columnid"+parseInt(ab[i])).attr('checked','checked');
           }
        }

        $('.selectAll').click(function(){
            var aids = document.getElementsByName('columnid[]');
            $(aids).each(function(){
                getTK(this)
            })
        })
            
    })
    
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
        
        var columnlist = $.cookie('columnlist');
        var columnAry  = $.cookie('columnAry');
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

        $.cookie('columnlist',columnlist,{ expires: 7, path: '/' });
        if(newcolumnAry.length!=0){
            $.cookie('columnAry',JSON.stringify(newcolumnAry),{ expires: 7, path: '/' });
        }else{
           $.cookie('columnAry','0',{ expires: 7, path: '/' }); 
        }
        
        
    } 
    function addtk(){
        
        var columnlist = $.cookie('columnlist');
        var columnAry  = $.cookie('columnAry');
        top.DataCallBack(columnlist);
        
        top.closePopup(window.name);
        
    }
</script>

    
</script>
</body>
</html>
