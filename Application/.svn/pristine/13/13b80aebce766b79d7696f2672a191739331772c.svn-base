<!DOCTYPE html>
<html>
<head lang="en">
<meta charset="UTF-8">
<title></title>
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/form.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<style>
.tavd{background-color:white; width:300px; overflow:auto; position: relative; z-index:1200; margin-top:50px; margin-left:15px; border:solid 1px #CCCCCC;; display:none; padding:0px;}
.tavd_tab{width:100%; height:30px; line-height:30px; margin:0px; padding:0px;}
.tavd_tab a{ float:left; display:block; width:120px; margin-left:15px;  text-align:center;}
</style>
<script>
$(function(){
	$("#xinjian").hover(function(){$(".tavd").show();})	
	$("body").hover(function(){$(".tavd").hide();})	
})
</script>
<body class="gray-bg">
<div class="wrapper mt0">
    <div id="manage_top" class="menu_top_fixed p15 height73" >
    	<h3 class="fl other">
        		<span class="mr20 fl">标签管理</span>
        		<a href="#" id="xinjian" class="btn btn-tool btn-rounded btn-s-md fl">新建标签</a>
               <a href="javascript:void(0);" onclick="dellabel();" class="btn btn-tool btn-rounded btn-s-md fl">删除标签</a>
       		   <a class="btn btn-tool btn-rounded btn-s-md fl" onclick="addTypeChange('<?php echo M_URL('Label','Labelclone','',GP('')); ?>','600px','450px')">克隆到其他模板</a>	
       		   <a href="<?php echo M_URL('Label','Labelpage','',GP('')); ?>" class="btn btn-tool btn-rounded btn-s-md fl">分页样式</a>
   		
       
        <div class="tavd" >
            <div class="tavd_tab">
            	<a href="<?php echo M_URL('Label','LabelAdd','',GP('labeltype-0')); ?>"><?php echo BCT(0);?></a>
            	<a href="<?php echo M_URL('Label','LabelAdd','',GP('labeltype-1')); ?>"><?php echo BCT(1);?></a>
            </div>
            <div style="height:10px; width:100%;line-height:10px;overflow:hidden">------------------------------------------------------------------------</div>
            <div class="tavd_tab">
            	<a href="<?php echo M_URL('Label','LabelAdd','',GP('labeltype-2')); ?>"><?php echo BCT(2);?></a>
            	<a href="<?php echo M_URL('Label','LabelAdd','',GP('labeltype-3')); ?>"><?php echo BCT(3);?></a>
            	<a href="<?php echo M_URL('Label','LabelAdd','',GP('labeltype-4')); ?>"><?php echo BCT(4);?></a>
            	<a href="<?php echo M_URL('Label','LabelAdd','',GP('labeltype-5')); ?>"><?php echo BCT(5);?></a>
            	<a href="<?php echo M_URL('Label','LabelAdd','',GP('labeltype-6')); ?>"><?php echo BCT(6);?></a>
            	<a href="<?php echo M_URL('Label','LabelAdd','',GP('labeltype-7')); ?>"><?php echo BCT(7);?></a>
            </div>
            <div style="height:10px; width:100%;line-height:10px; overflow:hidden">----------------------------------------------------------------------</div>
            <div class="tavd_tab">
            	<a href="<?php echo M_URL('Label','LabelAdd','',GP('labeltype-8')); ?>"><?php echo BCT(8);?></a>
            	<a href="<?php echo M_URL('Label','LabelAdd','',GP('labeltype-9')); ?>"><?php echo BCT(9);?></a>
            	<a href="<?php echo M_URL('Label','LabelAdd','',GP('labeltype-12')); ?>"><?php echo BCT(12);?></a>
            	<a href="<?php echo M_URL('Label','LabelAdd','',GP('labeltype-13')); ?>"><?php echo BCT(13);?></a>
            	<a href="<?php echo M_URL('Label','LabelAdd','',GP('labeltype-14')); ?>"><?php echo BCT(14);?></a>
            	<a href="<?php echo M_URL('Label','LabelAdd','',GP('labeltype-15')); ?>"><?php echo BCT(15);?></a>
           </div>
           <div style="height:10px; width:100%;line-height:10px; overflow:hidden">----------------------------------------------------------------------</div>
           <div class="tavd_tab">
            	<a href="<?php echo M_URL('Label','LabelAdd','',GP('labeltype-10')); ?>"><?php echo BCT(10);?></a>
            	<a href="<?php echo M_URL('Label','LabelAdd','',GP('labeltype-11')); ?>"><?php echo BCT(11);?></a>
            	<a href="<?php echo M_URL('Label','LabelAdd','',GP('labeltype-24')); ?>"><?php echo BCT(24);?></a>
            	<a href="<?php echo M_URL('Label','LabelAdd','',GP('labeltype-25')); ?>"><?php echo BCT(25);?></a>
           </div> 
            </h3>
             <div class="ibox-tools fr">
        <button type="button" class="ks-bt bt-def back "><i class="iconfont icon-fanhui"></i>返回</button>
        </div>
    </div>
</div>
<div class="ibox-content"><br /><br /><br /><br />
    <div class="panel-heading">标签管理:<?php echo $tempval['tempid'].':';if($tempval['temptype']==0){echo '电脑';}else{echo '手机';}echo $tempval['installdir'].'----'.$tempval['tempname'];?></div>
    <table class="table " >
        <thead>
        <tr>
        	<th>
                <div class="checkbox  checkbox-info" >
                    <input id="label-1" type="checkbox" name="check[]" value="-1" class="check-all check0">
                    <label for="label-1"></label>
                </div>
            </th>
            <th>标签名称</th>
            <th>标签类型</th>
            <th>更新时间</th>
            <th>编辑</th>
            <th>删除</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($values as $k=>$v){ ?>
        <tr> 
            <td><div class="checkbox  checkbox-info" >
                <input id="label<?php echo $v["labelid"];?>" type="checkbox" name="check[]" value="<?php echo $v["labelid"];?>" class="check0">
                <label for="label<?php echo $v["labelid"];?>"><?php echo $v["labelid"];?></label>
            </div>
            </td>
            <td><i class="label-2"></i><?php echo '{KS_'.$v['labelname'].'}';?></td>
            <td><?php echo BCT($v['labeltype']);?></td>
            <td><?php echo KS_DATE($v['adddate']);?></td>
            <td class="w80"><a href="<?php echo M_URL('Label','LabelEdit',$v['labelid'],GP('labeltype-'.$v['labeltype'].',p-'.$page->now_page));?>"><i class="edit2017"></i></a></td>
            <td class="w80"><a href="javascript:void(0);" onclick="Confirm('是否删除此标签？该操作不可逆！','<?php echo M_URL('Label','deleteLabel',$v['labelid'],GP('p-'.$page->now_page));?>')"><i class="delete2017"></i></a></td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
    <?php echo NOC($values);?>
    <div class="footer-page">
        <div class="col-sm-7"></div>
        <div class="col-sm-5"><?php echo $page->show(3); ?></div>
    </div>
</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script src="<?php echo UOOT;?>Public/common/js/jquery.cookie.js" type="text/javascript"></script>
<script>
function dellabel()
{
	var Labelcheck = $.cookie('Labelcheck');
	if(!Labelcheck){
       Alert('您还没有选中标签');
	}else{
	   Confirm('是否删除选中标签？该操作不可逆！','<?php echo M_URL('Label','batchdelLabel','',GP('')); ?>');
	}
}/*var selectInputs   = $('.check0');
	var checkAllInputs = $('.check-all')
	selectall(selectInputs,checkAllInputs)*/
	
	/*function getLable(obj){
		var ischeck = $(obj).prop('checked');
		var b = $(obj).val();
		var Labelcheck = $.cookie('Labelcheck');
		if(!Labelcheck){
			var Labelarr = new Array(); 
			Labelarr.push(b);
			var checkid = Labelarr.join(",");
			$.cookie('Labelcheck',checkid,{expires:7,path:'/'});
		}else{
			Labelarr = Labelcheck.split(",");
			if(ischeck==false){
				Labelarr.splice($.inArray(b,Labelarr),1);
				var checkid = Labelarr.join(",");
			}else{
				Labelarr.push(b);
				var checkid = Labelarr.join(",");
			}
			$.cookie('Labelcheck',checkid,{ expires: 7, path: '/' });
			var Labelcheck = $.cookie('Labelcheck');
		}
   }*/
$(function(){ 
	var Labelcheck = $.cookie('Labelcheck');
	if(Labelcheck){
	    var Labelarr = Labelcheck.split(",");
	    for(var i=0;i<Labelarr.length;i++){
		    $("#label"+parseInt(Labelarr[i])).attr('checked','checked');
	    }
	}
	var selectInputs   = $('.check0');
	var checkAllInputs = $('.check-all')
	var checkednum = 0;
	for(var i = 0; i < selectInputs.length; i++ ){
		if(selectInputs[i].checked==true){checkednum++;}
        selectInputs[i].onclick = function () {
            if (this.className.indexOf('check-all') >= 0) { //如果是全选，则吧所有的选择框选中
			        //$.cookie('Labelcheck','',{ expires: -1, path: '/'}); 
					for (var j = 0; j < selectInputs.length; j++) {
				        selectInputs[j].checked = this.checked;
						if(selectInputs[j].className.indexOf('check-all')<0){
						var Labelcheck = $.cookie('Labelcheck');
						if(!Labelcheck){
							var Labelarr = new Array(); 
							Labelarr.push($(selectInputs[j]).val());
						}else{
							Labelarr = Labelcheck.split(",");
							if(this.checked==false){
								Labelarr.splice($.inArray($(selectInputs[j]).val(),Labelarr),1);
							}else{
							    if($.inArray($(selectInputs[j]).val(),Labelarr) === -1)
								{
									Labelarr.push($(selectInputs[j]).val());
								}
							}
						}
						var checkid = Labelarr.join(",");
				        $.cookie('Labelcheck',checkid,{expires:7,path:'/'});
						}
				    }
            }else{
				var Labelcheck = $.cookie('Labelcheck');
				var b = $(this).val();
				if(!Labelcheck){
					var Labelarr = new Array(); 
					Labelarr.push(b);
				}else{
					Labelarr = Labelcheck.split(",");
					if(this.checked==false){
						Labelarr.splice($.inArray(b,Labelarr),1);
					}else{
						Labelarr.push(b);
					}
				}
				var checkid = Labelarr.join(",");
				$.cookie('Labelcheck',checkid,{expires:7,path:'/'});
				//var Labelcheck = $.cookie('Labelcheck');
			}
            if (!this.checked) { //只要有一个未勾选，则取消全选框的选中状态
                for (var i = 0; i < checkAllInputs.length; i++) {
                    checkAllInputs[i].checked = false;
                }
            }
        }
    }
	if(parseInt(checkednum+1)==selectInputs.length)
	{
		selectInputs[0].checked=true;
	}
});	
</script>
</body>
</html>