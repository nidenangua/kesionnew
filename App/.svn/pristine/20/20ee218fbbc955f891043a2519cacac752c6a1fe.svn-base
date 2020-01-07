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
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/wechat.css" rel="stylesheet"> 
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
</head>
<body class="ks-wrap">
<div class="ks-wbox bRadius10">
		<!--header-->
	    <div class="ks-head-box">
	     	
		<h3 class="ks-head-title" style="border: none;">
     		微信公众号
		</h3>
	    </div>
	    <!--header-->
					     
			  
		<!--widget-->
		<?php include  CURR_VIEW_PATH . "left_menu.php";?>	
		<!--/widget-->
	     
		<!--table-->
	
        <input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="" />
        <input type="hidden" name="__VIEWSTATEGENERATOR" id="__VIEWSTATEGENERATOR" value="5D6D186D" />
  
    	<div class="content-area" style="overflow:hidden;margin-top: 20px;">
        <link href="<?php echo UOOT;?>Public/app/images/weixin/css/wechat-inner.css" rel="stylesheet" type="text/css" />

        <div class="prompt_bg" style="display:none" id="Loading">
            <div class="prompt_box">
                <p><img src="<?php echo UOOT;?>Public/app/images/loading.gif" />正在同步，请耐心等待...</p>
            </div>
        </div>
        <div class="prompt_bg" style="display:none" id="jinyong">
            <div class="prompt_box">
                <p><img src="<?php echo UOOT;?>Public/app/images/loading.gif" />正在禁用，请耐心等待...</p>
            </div>
        </div>
        <div id="ctl00_KSContent_Panel11">

            <div class="phone_left">
                <div class="phone_left_bottom">
                    <div class="right_img">
                  <!--  <img src="<?php echo UOOT;?>Public/app/images/dail.png"/>-->
                    </div>
                    <ul class="phone_muen">
                        <?php foreach($memuFirst as $k=>$v){ ?>
                        <li class="f_nav" >
                            <a href="<?php echo M_URL($this->AppName.'/test','wechatMenus',$v['id'],GP('appid-'.$this->appid,true)); ?>">
                                <?php if(!empty($memuFirst)) echo $v["name"]; ?>
                            </a>
                            <?php $memuSec =  $app_wechat_menu->getAll("where  wxid =". $this->wxid ." and parentid = ".$v['id']." order by orderid desc"); ?>
                            <ul class="s_nav">
                                <?php foreach($memuSec as $kt=>$vt){ ?>
                                <li>
                                    <a href="<?php echo M_URL($this->AppName.'/test','wechatMenus',$vt['id'],GP('appid-'.$this->appid,true)); ?>">
                                        <?php if(!empty($memuSec)) echo $vt["name"]; ?>
                                    </a>
                                </li>
                                <?php }?>
                            </ul>
                        </li>
                        <?php }?>
                        <div class="clear"></div>
                    </ul>
                    <div class="norecord1" style="display:none ">
                                        <span style="text-align:center">
                                        </span>
                    </div>

                    <div class="clear">
                    </div>
                </div>
            </div>
            <div style="padding-left:340px;">
                <div class="ct-tips --large" style="width: 100%;">
                    <div><i class="iconfont icon-tongzhi c-red"></i>由于微信缓存，如同步微信菜单后无变化，请取消关注公众号后重新关注。 </div>

                    <div class="__right">
<!--                        <a  class="ct-btn blue"  href="javascript:void(0)" onclick="top.openWin('菜单排序','Weixin/KS.MenuList.aspx',true,800,400)" title="菜单排序" style="padding:0 20px;" >菜单排序</a>-->
                        <a  class="ks-bt bt-pue" href="javascript:void(0)" style="height: 34px;line-height: 32px;" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','menuList',"",GP("")) ?>','850px','600px',{title:'课程类型'});"
                         >菜单排序</a>
                        <input type="button" value="同步菜单到微信" onclick="catchup();" style="margin: 10px 5px;" class="ks-bt bt-pue" />
                       <!-- <input type="submit" name="ctl00$KSContent$Button5" value="禁用自定义菜单" onclick="return(JinYong());" id="ctl00_KSContent_Button5" class="ct-btn red" />-->
                        <?php if(count($memuFirst)<3){ ?>
                        <input type="button" value="添加一级菜单" style="margin: 10px 5px;" class="ks-bt bt-pue" onclick="skip('<?php echo M_URL($this->AppName.'/test','wechatMenus','',GP('type-5')); ?>')" />
                        <?php } ?>
                        <div class="clear">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="ctl00_KSContent_Panel3">
            <div class="phone_right">
               
                <div class="title_phone">
                	<?php if(!empty($menu)){?>
                	<span class="chongming"><a href="<?php echo M_URL($this->AppName.'/test','wechatMenus',$menu['id'],GP('type-4')); ?>">重命名 </a></span>
                	<span class="chongming"> <a href="<?php echo M_URL($this->AppName.'/test','delMenu',$menu['id'],GP('')); ?>"> 删除  </a></span>
                	<?php }?>
                	
                	<span><?php if($result){if($menu['parentid'] ==0){echo '一级菜单'.$menu['name'];}else{ echo '二级菜单'.$menu['name']; } ?><?php } ?></span>
                	
                </div>
                
                <?php if(isset($type)){if($type==0){ ?>
                <div id="menuxx1">
                <?php if($result)if($menu['parentid'] ==0){
				          if($menu['child']<5){ ?>
                             <a href="<?php echo M_URL($this->AppName.'/test','wechatMenus',$menu['id'],GP('type-3')); ?>"><button class="new-subnav"></button><span>创建二级菜单</span></a>
				         <?php }
				          if($menu['child'] ==0){?>
                            <a href="<?php echo M_URL($this->AppName.'/test','wechatMenus',$menu['id'],GP('type-1')); ?>"> <button class="wechat-send"></button><span>发送消息</span></a>
                            <a href="<?php echo M_URL($this->AppName.'/test','wechatMenus',$menu['id'],GP('type-2')); ?>"> <button class="uptoweb"></button><span>跳转网页</span></a>
                         <?php } ?>      
                <?php }else{ ?>
                             <a href="<?php echo M_URL($this->AppName.'/test','wechatMenus',$menu['id'],GP('type-1')); ?>"><button class="wechat-send"></button><span>发送消息</span></a>
                           <a href="<?php echo M_URL($this->AppName.'/test','wechatMenus',$menu['id'],GP('type-2')); ?>"><button class="uptoweb"></button><span>跳转网页</span></a> 
                <?php } ?> 
                </div>
                <?php }else{ ?>
                <div id="menuxx2">
                  <form action="<?php echo M_URL($this->AppName.'/test','domenusxx',$menu['id'],GP('type-'.$type)); ?>" method="post">
                        <?php if(isset($type))if($type == 2){ ?>   <!--url-->
                        		<span style="margin-top: 15px; display: inline-block;">点击该菜单会跳到以下链接</span>
                               	<input type="text" name="url" value="<?php if(isset($type)){echo $menu['url'];} ?>" style="width: 50%; padding: 8px;margin-top: 15px;height: 32px;">
                               	<select style="padding: 8px;margin-top: 15px;height: 34px;" id="type" onchange="getsucai()">
                               		<option value="-1">常用</option>
                                    <?php if($module['ismoduleopen'][0]){ ?>
                               		<option value="1">点播</option>
                                    <?php } ?>
                                    <?php if($module['ismoduleopen'][1]){ ?>
                                    <option value="2">直播</option>
                                    <?php } ?>
                                    <?php if($module['ismoduleopen'][2]){ ?>
                                    <option value="3">音频</option>
                                    <?php } ?>
                                    <?php if($module['ismoduleopen'][3]){ ?>
                                    <option value="4">图文</option>
                                    <?php } ?>
                                    <?php if($module['ismoduleopen'][4]){ ?>
                                    <option value="5">互动</option>
                                    <?php } ?>
                                    <?php if($module['ismoduleopen'][5]){ ?>
                               		<option value="6">试卷</option>
                                    <?php } ?>
                               	</select>	
                               	<select style="padding: 8px;margin-top: 15px;height: 34px;" id="ks" onchange="linkgenerate()">
                               		<option value="0">请选择</option>
                               	</select>
                                 	<input type="submit" value="保存" class="ks-bt bt-pue fn" style="margin:10px 0 0px;">
                                 		<div class="tips tipsmargin">
                                 			提示：如果公众号菜单想要设置微门户相关链接，请使用右边下拉框快速链接
                                 		</div>
                        <?php }elseif($type == 1){ ?> <!-- 发送消息-->
                                 <div class="cz_list">
                                 	<div class="tabs">
                                 		<div class="menu1box">
                                 			<ul class="menu1 clr">
                                 				<li class="hit">
                                 					<a href="#"><i class="sm_tab wz"></i>关键词回复</a>
                                 				</li>
                                 			</ul>
                                 		</div>
                                 	</div>
                                 </div>
                                 <div class="com_form msgBox" id="mybox2" style="display: block;">
                                                        指定关键词：
                                                        <input name="ctl00$KSContent$TxtContent" type="text" id="ctl00_KSContent_TxtContent" style="width:60%;padding: 8px;border: 1px solid #ddd; display: none;">
                                                        	<select name="key" style="width:60%;padding: 8px;border: 1px solid #ddd;">
                                                              <?php foreach($keyreplay as $k=>$v){ ?>
                                                        		<option value="<?php echo $v['keyword'] ?>" <?php if($v['keyword'] == $menu['keywords'] )echo 'selected' ?>><?php echo $v['keyword'] ?></option>
                                                               <?php } ?>
                                                        	</select>
                                                        
                                                             <p>
                                                                    <input type="submit" name="ctl00$KSContent$Button4" value="保存" onclick="return(check9());" id="ctl00_KSContent_Button4" class="sub_btn">
                                                            </p>
                                                    </div>
                        <?php }elseif($type == 3 || $type ==5){ ?> <!-- 添加二级菜单-->
                        	<div style="margin-top: 15px;">还能添加1个一级菜单，请输入名称（4个汉字或8个字母以内）</div>
                                <input type="text" name="name" style="width:300px; padding: 8px;margin-top: 15px;height: 32px;margin-bottom: 15px;" >
                                <input type="submit" value="保存" class="ks-bt bt-pue fn" style="margin-left: 0;">
                        <?php }elseif($type == 4){ ?>
                             <input type="text" name="name" value="<?php if(isset($type)){echo $menu['name'];} ?>" >
                             	<input type="submit" value="保存" class="ks-bt bt-pue fn" style="margin-left: 0;">
                        <?php } ?>
                  </form>
                 <?php }} ?>          
                </div>        
            </div>
        </div>
    </div>
	    <!--/table-->
	</div>
<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
	module.require(['$','backstage','nicescroll'],function(){
		loadScorllJs()
	});
</script>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script src="<?php echo UOOT;?>Public/common/js/animate-common.js"></script>
<script>
function catchup(){
    var url="<?php echo M_URL($this->AppName.'/Index','upDowmMenu','',GP('')); ?>";
    $.ajax({
        type:"post",
        url:url,
        data:{},
        success:function(data){
        	//top.popup.tips(data,{icon:'success'});
        	Alert(data,2);
        }
    });
    return false;
}
function updatesStatus(id){
	  var url = '<?php echo UOOT;?>Plus/Kesion.ajax.php?act=question';      
	  $.ajax({
			type:"get",
			url:url,
			data:{id:id},
			success:function(data,textStatus){
				$("#a"+id).html(data);
			},
			error:function(){
				alert("发生了错误,请检查!");
			}
	   })
}
function getsucai(){
	var type = $('#type').val();
	var url = '<?php echo M_URL($this->AppName.'/test','getsucai',"",GP('')); ?>';      
	$.ajax({
		type:"post",
		url:url,
		data:{type:type},
		success:function(data,textStatus){
			var data =JSON.parse(data);
			var str ='<option value ="0">请选择</option>';
            if(type==1){
                str +='<option value ="1000">点播列表</option>';
            }
            if(type==2){
                str +='<option value ="1000">直播列表</option>';
            }
            if(type==3){
                str +='<option value ="1000">音频列表</option>';
            }
            if(type==4){
                str +='<option value ="1000">图文列表</option>';
            }
            if(type==5){
                str +='<option value ="1000">互动列表</option>';
            }
            if(type==6){
                str +='<option value ="1000">试卷列表</option>';
            }
			for(var i=0;i<data.length;i++){
				if(type== 1 || type== 2 || type== 3 || type== 4){
					str +='<option value ="'+data[i]['courseid']+'">'+data[i]['title']+'</option>';
				}else if(type == 5){
					str +='<option value ="'+data[i]['classid']+'">'+data[i]['title']+'</option>';
				}else if(type == 6){
					str +='<option value ="'+data[i]['id']+'">'+data[i]['title']+'</option>';
				}	
				
			}
			if(type==-1){
				str +='<option value ="1000">首页</option>';
                str +='<option value ="999">个人中心</option>';
                str +='<option value ="1001">我的课程</option>';
                str +='<option value ="1002">我的订单</option>';
                str +='<option value ="1003">我的优惠券</option>';
                str +='<option value ="1004">赠送记录</option>';
                str +='<option value ="1005">消息</option>';
                str +='<option value ="1006">我的试卷</option>';
			}
			$('#ks').html(str);
		},
		error:function(){
			alert("发生了错误,请检查!");
		}
   	})
}
getsucai();
function linkgenerate(){
	var type = $('#type').val();
	var id   = $('#ks').val();
	if(id !=0){
		if(type==1 || type == 2){
            var url = 'https://<?php echo APP_DOMAIN; ?>/h5market/Micoursedetail?id='+id;
            if(id == 1000  && type ==1){
                url = 'https://<?php echo APP_DOMAIN; ?>/h5market/Micourse#2';
            }
            if(id == 1000  && type ==2){
                 url = 'https://<?php echo APP_DOMAIN; ?>/h5market/Micourse#3';
            }
			
		}else if(type == 3){
            var url = 'https://<?php echo APP_DOMAIN; ?>/h5market/musicinfo?id='+id;
            if(id == 1000){
                 url = 'https://<?php echo APP_DOMAIN; ?>/h5market/Micourse#1';
            }
			
		}else if(type == 4){
            var url = 'https://<?php echo APP_DOMAIN; ?>/h5market/imgInfo?id='+id;
            if(id == 1000){
                url = 'https://<?php echo APP_DOMAIN; ?>/h5market/Micourse#0';
            }
			
		}else if(type == 5){
            var url = 'https://<?php echo APP_DOMAIN; ?>/h5market/Miclassdetail?id='+id;
            if(id == 1000){
                url = 'https://<?php echo APP_DOMAIN; ?>/h5market/Micourse#4';
            }
            
        }else if(type == 6){
            var url = 'https://<?php echo APP_DOMAIN; ?>/h5market/examin?id='+id;
            if(id == 1000){
                url = 'https://<?php echo APP_DOMAIN; ?>/h5market/Micourse#5';
            }
            
        }else if(type == -1){
            if(id = 1000){
                var url = 'https://<?php echo APP_DOMAIN; ?>/h5market/Miindex'; 
            }
            if(id = 1001){
                var url = 'https://<?php echo APP_DOMAIN; ?>/h5market/myCouse'; 
            }
            if(id = 1002){
                var url = 'https://<?php echo APP_DOMAIN; ?>/h5market/myList'; 
            }
            if(id = 1003){
                var url = 'https://<?php echo APP_DOMAIN; ?>/h5market/MyVoucherlist'; 
            }
            if(id = 1004){
                var url = 'https://<?php echo APP_DOMAIN; ?>/h5market/giftrecord'; 
            }
            if(id = 1005){
                var url = 'https://<?php echo APP_DOMAIN; ?>/h5market/myMsg'; 
            }
            if(id = 1006){
                var url = 'https://<?php echo APP_DOMAIN; ?>/h5market/myPaper'; 
            }
            if(id = 999){
                var url = 'https://<?php echo APP_DOMAIN; ?>/h5market/index'; 
            }
		}	
		$('[name=url]').val(url);
	}
}
</script>
</body>
</html>
<!--<div id ="addrulepage"class="configTab" >
    <form  action="<?php echo M_URL($this->AppName.'/Index','addFirstMenu','',GP('')); ?>"  method="post" class="commentForm" enctype="multipart/form-data">
        <input type="hidden" value="<?php if(!empty($memuFirstOp)) echo $memuFirstOp["id"]; ?>" name="parentid">
        <?php if(!empty($memuFirstOp)) echo $memuFirstOp["id"]; ?>
        <table width="100%" cellpadding="0" cellspacing="0" border="0" class="gTable">
            <tr>
                <td class="leftTd alignRight fsize16 c-92 w120">添加一级菜单，请输入名称（4个汉字或8个字母以内）</td>
                <td class="rightTd alignLife" id="focusReplySucai2">
                    <input type="text" name="name" class="inputText bRadius5 w400 c-79" value="" >添加%%%级菜单
                </td>
            </tr>
            <tr>
                <td class="leftTd alignRight w120"></td>
                <td class="rightTd alignLife"><input type="submit" class="generalBtn c-fff fsize16 bRadius5" value="确认" /></td>
            </tr>
        </table>
    </form>
</div>
-->
<!--<div id ="addrulepagee" class="configTab" >
    <form  action="<?php //echo M_URL($this->AppName.'/index','addFirstMenu','',GP('')); ?>"  method="post" class="commentForm" enctype="multipart/form-data">
        <input type="hidden" value="3" name="type">
        <table width="100%" cellpadding="0" cellspacing="0" border="0" class="gTable">
            <tr>
                <td class="leftTd alignRight fsize16 c-92 w120">一级菜单操作</td>
                <td class="rightTd alignLife" id="focusReplySucai2">
                    <input type="text" name="name" class="inputText bRadius5 w400 c-79" value="" >添加二级菜单
                </td>
                <td class="rightTd alignLife" id="focusReplySucai3">
                    <input type="text" name="name" class="inputText bRadius5 w400 c-79" value="" >跳转到网页
                </td>
            </tr>
            <tr>
                <td class="leftTd alignRight w120"></td>
                <td class="rightTd alignLife"><input type="submit" class="generalBtn c-fff fsize16 bRadius5" value="确认" /></td>
            </tr>
        </table>
    </form>
</div>-->
<script src="<?php echo UOOT;?>Public/app/images/weixin/js/Jquery.js" type="text/javascript"></script>
<script src="<?php echo UOOT;?>Public/app/images/weixin/js/tabpane.js" type="text/javascript"></script>
<script src="<?php echo UOOT;?>Public/app/images/weixin/js/comm.js"></script>
<script src="<?php echo UOOT;?>Public/app/images/weixin/js/DatePicker/WdatePicker.js"></script>
<script>
        var a = jQuery("#aspnetForm").attr("action");
        /*if (a.indexOf('/') != -1) {
            var arr = a.split('/');
            a = arr[arr.length - 1];
            jQuery("#aspnetForm").attr("action", a);
        }*/
        $(".phone_muen .f_nav").hover(function () {
                    $(this).toggleClass("show");
        })
        var w = 250;
        var h = 50;
        $(".prompt_box").css("position", "fixed");
        $(".prompt_box").css("width", w).css("height", h);
        var x = ($(window).width() - w) / 2;
        var y = ($(window).height() - h) / 3;
        $(".prompt_box").css("top", y).css("left", x);
</script>