<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php if(!isset($app)){echo '添加应用';}else{echo '修改应用';} ?></title>
<link rel="shortcut icon" href="favicon.ico">
<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/html5.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/laydate.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<body class="gray-bg">
<div class="sss">
	<span></span>
    <ul><LI><DIV class="WWW"></DIV></LI></ul>
</div>
<div id="manage_top" class="menu_top_fixed  p15 height73">
    <div class="ibox-title clearfix"> 
        <h3 class="fl other">&nbsp;&nbsp;<span class="mr20">新增应用</span>
        	 <ul id="tablist">
                            <li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="true">基本参数</a></li>
                        
                            <li class=""><a data-toggle="tab" href="#tab-2" aria-expanded="false">其他参数</a></li>
                        </ul>
        </h3>
        <div class="fr">
			<a href="javascript:history.go(-1);" class="bt-back fr" type="button">
            	<i class="iconfont icon-fanhui"></i>返回
            </a>
        </div>
    </div>
</div>

<div class="wrapper mt10"><br /><br />
    <div class="row">
            <div class="ibox float-e-margins">
                <form target="hidframe"  class="form-horizontal" action="<?php if(!isset($app)){echo M_URL('App','appManageDoSave');}else{echo M_URL('App','appManageDoSave',$app['appid'],GP('p-'.$now_page));} ?>" method="post" enctype="multipart/form-data">
                    <div class="tabs-container">
                      
                        <div class="tab-content">
                            <div  class="tab-pane active">
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">应用类型   </label>
                                        <div class="col-sm-4"><?php echo $Linkage->Linkage(1);?> </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">应用中文名称</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="appname" <?php if(isset($app))echo "value='$app[appname]'";  ?> >
                                            	<em class="need">*</em>
                                        </div>
                                     
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">应用英文名称</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="appename" <?php if(isset($app))echo "value='$app[appename]' readonly";  ?> >
                                            <em class="need">*</em>
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">应用是否建表</label>
                                        <div class="col-sm-4">
                                            <div class="radio radio-info radio-inline">
                                                <label><input type="radio" onclick="showtable()" value="0" <?php if(isset($app)){if($app['istable']==0){echo "checked";}}else{echo "checked";}?> name="istable">
                                                否 </label>
                                            </div>
                                            <div class="radio radio-info radio-inline">
                                                <label><input type="radio"  onclick="showtable()" value="1" <?php if(isset($app)){if($app['istable']==1){echo "checked";}}?> name="istable">
                                                是 </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">特殊属性</label>
                                        <div class="col-sm-6">
                                            <div class="checkbox checkbox-info checkbox-inline">
                                                <input id="shortcut" type="checkbox" value="1"  <?php if(isset($app)){if($app['shortcut']==1){echo " checked ";}if($app['appid']==2){echo " disabled ";} } ?> name="shortcut">
                                                	
                                                <label for="shortcut">应用快捷</label>
                                            </div>
                                            <div class="checkbox checkbox-info checkbox-inline">
                                                <input id="isweb" type="checkbox" value="1" <?php if(isset($app)){if($app['isweb']==1){echo "checked";}if($app['appid']==2){echo " disabled ";} } ?> name="isweb">
                                                <label for="isweb">网站快捷</label>
                                            </div>
                                            <div class="checkbox checkbox-info checkbox-inline">
                                                <input id="isrec" type="checkbox" value="1"  <?php if(isset($app)){if($app['isrec']==1){echo "checked";} } ?> name="isrec">
                                                <label for="isrec">推荐</label>
                                            </div>
                                            <div class="checkbox checkbox-info checkbox-inline">
                                                <input id="MustChoose" type="checkbox" value="1" <?php if(isset($app)){if($app['MustChoose']==1){echo "checked";} } ?> name="MustChoose">
                                                <label for="MustChoose">必选</label>
                                            </div>
                                            <div class="checkbox checkbox-info checkbox-inline">
                                                <input id="isoffc" type="checkbox" value="1" <?php if(isset($app)){if($app['isoffc']==1){echo "checked";} } ?> name="isoffc">
                                                <label for="isoffc">官方应用</label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <font id="showaddtable">
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group issys" >
                                        <label class="col-sm-2 control-label">数据表名称</label>
                                        <label class=" " style="padding:7 0 0 0;float:left" id="tp">ks_app_</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control"  name="tableename" <?php if(isset($app))echo "readonly value='$app[tableename]'";  ?>>
                                        </div>
                                    </div>
                                    </font>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-upload">
						          		<div class="js_uploadBox">
						          		 	<div class="js_showBox mt10" style="height: 220px;"><img class="js_logoBox block" src="<?php if(isset($app))echo $app['defaultpic'];?>" width="180" onerror="this.src='<?php echo nopic(1);?>'"></div> 
							                <div class="btn-upload clearfix">
							                    <a href="javascript:void(0);" class="selectImageBtn">
							                    	<span class="js_uploadText">上传图片</span></a>
							                    <p>限制：2MB,支持jpg|png|gif</p> 
							                   	<input class="hide js_upFile" type="file" name="file" id="upImg">
							                   	
							               </div>
									    </div>
		          					</div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">项目名称</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="proname" <?php if(isset($app))echo "value='$app[proname]'";  ?>>
                                            	
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">项目图标</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="fonts" <?php if(isset($app))echo "value='$app[fonts]'";  ?>>
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">项目单位</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="unti" <?php if(isset($app))echo "value='$app[unti]'";  ?>>
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">基类型：</label>
                                        <div class="col-sm-2">
                                            <select <?php if(isset($app))echo "disabled";  ?> class="form-control" name="basictype">
                                            <option <?php if(isset($app)){if($app['basictype']==1){echo 'selected="selected"';}} ?> value="1">文章</option>
                                            <?php if(isset($app)){ ?>
                                            <option <?php if(isset($app)){if($app['basictype']==2){echo 'selected="selected"';}} ?> value="2">分类</option>
                                            <option <?php if(isset($app)){if($app['basictype']==3){echo 'selected="selected"';}} ?> value="3">课程</option>
                                            <option <?php if(isset($app)){if($app['basictype']==4){echo 'selected="selected"';}} ?> value="4">订单</option>
                                            <option <?php if(isset($app)){if($app['basictype']==5){echo 'selected="selected"';}} ?> value="5">学员</option>
                                            <option <?php if(isset($app)){if($app['basictype']==6){echo 'selected="selected"';}} ?> value="6">配置</option>
                                            <?php } ?>
											<?php
											 foreach($h5Values as $k=>$v){
											   $optionValue=ChkClng(1000+$v["id"]);
											   echo "<option  value='". $optionValue."'";
											   if (isset($app) && $app['basictype']== $optionValue) echo (" selected='selected'");
											   echo  ">营销-".$v["h5name"]."</option>";
											 }
											?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">应用权限</label>
                                        <div class="col-sm-4">
                                            <textarea type="text" class="form-control" style="height: 176px;" name="power" ><?php if(isset($app))echo $app['power'];  ?> </textarea>
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                </div>
                            </div>
                            <div  class="tab-pane">
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">应用作者</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="author" <?php if(isset($app))echo "value='$app[author]'";  ?>>
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" >录入时间</label>
                                        <div class="col-sm-4">
                                            <input id="test" class="laydate-icon form-control" required name="adddate" value="<?php if(isset($app)){echo date('Y-m-d H:i:s',$app['adddate']);}else{echo date('Y-m-d H:i:s',time());} ?>" readonly aria-required="true" style="height:34px">
                                        </div>
                                    </div>
                                     <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">适用套餐版本</label>
                                        <div class="col-sm-4">
                                            <div class="checkbox checkbox-info checkbox-inline">
                                                <input type="checkbox" id="allowversion1"  value="v1" <?php if(isset($app)){if(strstr($app['allowversion'],"v1")){echo "checked";}}?> name="allowversion[]">
                                                <label for="allowversion1">基础版</label>
                                            </div>
                                            <div class="checkbox checkbox-info checkbox-inline">
                                                <input type="checkbox"  id="allowversion2" value="v2" <?php if(isset($app)){if(strstr($app['allowversion'],"v2")){echo "checked";}}?> name="allowversion[]">
                                                <label for="allowversion2">高级版</label>
                                            </div>
                                            <div class="checkbox checkbox-info checkbox-inline">
                                                <input type="checkbox"  id="allowversion3"  value="v3" <?php if(isset($app)){if(strstr($app['allowversion'],"v3")){echo "checked";}}?> name="allowversion[]">
                                                <label for="allowversion3">钻石版</label>
                                            </div>
                                        </div>
                                        ( tips：所有版本可以用的话，请不要勾选。)
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">应用是否收费</label>
                                        <div class="col-sm-4">
                                            <div class="radio radio-info radio-inline">
                                                <input type="radio" id="isprice11" value="1" <?php if(isset($app)){if($app['isprice']==1){echo "checked";}}?> name="isprice">
                                                <label for="isprice11">是 </label>
                                            </div>
                                            <div class="radio radio-info radio-inline">
                                                <input type="radio" id="isprice22" value="0" <?php if(isset($app)){if($app['isprice']==0){echo "checked";}}else{echo "checked";}?> name="isprice">
                                                <label for="isprice22">否 </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed webapp isprice"  a="<?php if(isset($app))echo $app['isprice']; ?>"></div>
                                    <div class="form-group webapp isprice">
                                        <label class="col-sm-2 control-label">应用售价</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" style="width:100px;"  name="price" <?php if(isset($app))echo "value='$app[price]'";  ?>>元
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed isprice"></div>
                                    <div class="form-group isprice">
                                        <label class="col-sm-2 control-label">应用计费周期</label>
                                        <div class="col-sm-4">
                                            <div class="radio radio-info radio-inline">
                                                <input type="radio" id="appchargetype11" value="0" <?php if(isset($app)){if($app['appchargetype']==0){echo "checked";}}else{echo "checked";}?> name="appchargetype">
                                                <label for="appchargetype11">1月</label>
                                            </div>
                                            <div class="radio radio-info radio-inline">
                                                <input type="radio" id="appchargetype22" value="1" <?php if(isset($app)){if($app['appchargetype']==1){echo "checked";}}?> name="appchargetype">
                                                <label for="appchargetype22">1季</label>
                                            </div>
                                            <div class="radio radio-info radio-inline">
                                                <input type="radio" id="appchargetype33" value="2" <?php if(isset($app)){if($app['appchargetype']==2){echo "checked";}}?> name="appchargetype">
                                                <label for="appchargetype33">1年</label>
                                            </div>
                                        </div>
                                    </div>
                                   
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">应用安装包</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="" <?php if(isset($app))echo "value=''";  ?>>
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">应用适用范围</label>
                                        <div class="col-sm-4">
                                            <div class="radio radio-info radio-inline">
                                                <input type="radio" id="apptype11" value="1" <?php if(isset($app)){if($app['apptype']==1){echo "checked";}}else{echo "checked";}?> name="apptype">
                                                <label for="apptype11">通用</label>
                                            </div>
                                            <div class="radio radio-info radio-inline">
                                                <input type="radio" id="apptype22" value="2" <?php if(isset($app)){if($app['apptype']==2){echo "checked";}}?> name="apptype">
                                                <label for="apptype22">教师</label>
                                            </div>
                                            <div class="radio radio-info radio-inline">
                                                <input type="radio" id="apptype33" value="3" <?php if(isset($app)){if($app['apptype']==3){echo "checked";}}?> name="apptype">
                                                <label for="apptype33">学校</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">简短描述</label>
                                        <div class="col-sm-4">
                                            <textarea type="text" class="form-control" style="height: 176px;" name="shortdesc" ><?php if(isset($app))echo $app['shortdesc'];  ?> </textarea>
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">应用介绍</label>
                                        <div class="col-sm-8">

                                            <!--<div class="ibox-content no-padding">-->
                                            <?php $kindeditor = ks_editor('intro',(isset($app)?$app['intro']:''),'','','','300px');  echo $kindeditor;?>
                                            <div class="hr-line-dashed"></div>
                                        </div>
                                    </div>

                                  

                                </div>
                            </div>
                            <br />		
                            <br />		
                            <br />		
                            <br />		
                            
                        </div>
                        <div class="footer-page " style="height: 60px;">
                            <div class="col-sm-5"></div>
                            <div class="col-sm-3 mt10">
                                <button type="submit" class="btn btn-default btn-s-md" ><?php if(!isset($app)){echo '确定添加';}else{echo '确定修改';} ?></button>
                                <a href="javascript:history.go(-1);" class="btn bt-gray btn-s-md">取消修改</a>
                            </div>
                        </div>
                        </div>
                </form>
            </div>
      
    </div>
    
</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
    $(function(){
        taps();//选项卡
        uploadView('100','100');//图片上传	
        datatime('#test');//时间选择器
        radioTaps();
        loadScorllJs();
        showtable();
        //判断是否选中	
        //$("input[name='isweb']").reset();	
    });
    function showtable(){
    	 var v=$("input[name='istable']:checked").val();
    	if (v== "1") {
            jQuery("#showaddtable").show();
        } else {
            jQuery("#showaddtable").hide();
        }

    }
    function taps(){
    $('#tablist li').click(function(){
        $(this).addClass('active').siblings().removeClass('active');
        $('.tab-content>.tab-pane:eq('+$(this).index()+')').show().siblings().hide();
    })
}
</script>

</body>

</html>
