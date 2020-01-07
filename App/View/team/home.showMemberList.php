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
                <select class="w150 inputText bRadius5 fl" id="keytype">
					<option value="1" <?php if($keytype==1){echo 'selected="selected"';} ?>>用户昵称</option>
                    <option value="2" <?php if($keytype==2){echo 'selected="selected"';} ?>>用户手机</option>
			  	</select>
                <div class="fl ks-top-search">
                    <input type="text" class="sc-text " name="searchText" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>" >
                    <button type="submit" class="ks-head-search" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','showMemberList',$id); ?>','<?php echo URL_MODEL;?>')"><i class="iconfont icon-sousuo"></i></button>
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
    <form target="hidframe"  id="myform" class="form-horizontal" action="<?php echo M_URL($this->AppName.'/Index','addMember',$id,GP(''));  ?>" method="post" enctype="multipart/form-data">

    <table class="ks-table" style="    margin-top: 32px;">
        <tbody>
        <?php foreach ($values as $k => $v) { ?>
            <tr>
                <td style="width: 30px;">
                    <input type="checkbox" class="select-checks" id="userid<?php echo $v['userid'] ?>" name="userid[]" value="<?php echo $v['userid'] ?>" onclick="getTK(this)" >
                </td>
                <td style="text-align: left;"><?php echo Field($v['name']); ?></td>
                <td style="text-align: left;"><?php echo Field($v['mobile']); ?></td>
<!--                <td >--><?php //if($v['groupname']){echo $v['groupname'];}else{echo '普通用户';} ?><!--</td>-->
<!--                <td>--><?php //if($v['grouptype']==1){echo '购买';}elseif($v['grouptype']==2){echo '消费升级';}elseif($v['grouptype']==3){echo '后台添加';}else{echo '---';}?><!--</td>-->
            </tr>
        <?php } ?>
        </tbody>
    </table> 
<div class="clearfix ks-popup-footer">
    <div class="fl mt20">
        <span class="ks-bt bt-def mr10 ks-ctn" id="selectAll" >
                <input type="checkbox" class="fl select-checks selectAll" style="margin-top: 6px;" >全选
            </span>
        	<input type="hidden" name="ueserlist" id="ueserlist" value="" />
        	<input type="button" onclick="do_reg();" class="ks-bt bt-pue mr15" value="确定" name="confirm">
        </form>
        
    </div>
    <div class="fr mt20"><?php echo $page->show(3); ?></div>
</div>
    </body>
</html>
<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>

<script>
    
    module.require(['$','backstage','nicescroll','cookie'],function(){
            loadScorllJs(); 
            
        var userlist = $.cookie('userlist');
        
        if(userlist){
           var ab =userlist.split("|");
           for(var i=0;i<ab.length;i++){
               $("#userid"+parseInt(ab[i])).attr('checked','checked');
           }
        }
                
        $('.selectAll').click(function(){
            var aids = document.getElementsByName('userid[]');
            $(aids).each(function(){
                getTK(this)
            })
        })
            
    })
    
    function getTK(obj){
        var ary=[];
        obj.checked ? resetCookie(obj.value,1) : resetCookie(obj.value,0)
        
        
    }
    
    //type 0减少 1增加
    function resetCookie(v,type){

        var userlist = $.cookie('userlist');
        if(userlist){
            var data = userlist.split('|');
            var newStr = '';
            for(var i=0;i<data.length;i++){
                if(data[i] != v){
                    !newStr ? newStr=data[i] : newStr+='|'+data[i]
                }
            }
            type === 1 && (newStr += '|'+v)
            userlist = newStr
        }else{
            if(type==1){
                userlist = v;
            }
        }
        $.cookie('userlist',userlist,{ expires: 1, path: '/' });
    }
function do_reg(type){
	// var userlist = $.cookie('userlist');
	// getId('ueserlist').value = userlist;
	// $.cookie('userlist', '', { expires: -1, path: '/' });
	$("#myform").submit()
}
</script>

    
</script>


