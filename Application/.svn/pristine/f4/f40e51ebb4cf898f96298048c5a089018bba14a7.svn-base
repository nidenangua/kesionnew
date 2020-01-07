<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title><?php if(!isset($field)){echo '添加字段';}else{echo '修改字段';} ?></title>
<link rel="shortcut icon" href="favicon.ico"> 
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/admin/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
<style>
.col-sm-2{width:16.66666667%}
.radio-inline {
	display: table-cell; 
	min-width: 120px;
}
</style>
</head>
<body class="gray-bg">
<div id="manage_top" class="menu_top_fixed  p15 height73" >
    <div class="ibox-title">
        <h3 class="fl">&nbsp;&nbsp;资讯管理&nbsp;&nbsp;&nbsp;&nbsp;
        <?php $html = $app['appname'].$appModel->prefix;if($app['isweb']==0){$html .= 'website_';}else{$html .= 'app_';}$html .= $app['tableename'];if(!isset($field)){$html .= '添加字段';}else{$html .= '修改字段';} echo $html;?>
        </h3>
        	
       <div class="fr">
             <div class="fl ks-top-search">
			<!--搜索-->
				<button class="ks-bt bt-def back"><i class="iconfont icon-fanhui"></i>返回</button>
			<!--搜索-->
			</div>  
        </div>
    </div>
</div>
<br />
<br />
<br />

<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row bg-white">
	 <div class="col-sm-12">
		<div class="ibox float-e-margins">
			<br />
			<div class="ibox-content">
<form target="hidframe"  action="<?php if(!isset($field)){echo M_URL('App','doaddfield',$appid);}else{echo M_URL('App','doeditField',$field['fieldid'],GP("appid-$appid,p-$now_page"));} ?>" method="post" class="form-horizontal" id="myForm">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">所属分组：</label>
                            <div class="col-sm-2">
                                <select class="form-control" onchange="getsmallgroup(this)" name="groupid">
                                <?php
                                    $html = '';
                                    foreach($fieldgroup as $k=>$v)
                                    {
                                        if(isset($field))
                                        {
                                                if($v['groupid']==$field['groupid'])
                                                {
                                                  $html .= " <option value='$v[groupid]' selected='selected'>$v[groupname]</option>";
                                                }else{
                                                    $html .= " <option value='$v[groupid]'>$v[groupname]</option>";
                                                     }
                                        }else{
                                          $html .= " <option value='$v[groupid]'>$v[groupname]</option>";
                                        }
                                    }
                                    echo $html;
                                 ?>
                                </select>
                            </div>
						   <script>
                            function getsmallgroup(obj)
                            {
                                $(obj).find("option[value="+$(obj).val()+"]").attr("selected",true);
                                $("#isshow").html('<option value="0" >请选择</option>');
                                var url = '/Plus/Kesion.ajax.php?act=smallGroup';
                                $.ajax({
                                type:"post",
                                url:url,
                                data:{
                                       'groupid':$(obj).val(),
                                       'valuetype':'appid',
                                       'value':"<?php echo $appid;?>",
                                       'fieldid':<?php if(isset($field)){echo $field['fieldid'];}else{echo "''";}?>
                                },
                                dataType:"json",
                                success:function(data){
                                    if(data!=0)
                                    {	
                                        $("#isshow").append(data);
                                    }
                                }
                                });
                                
                            }		
                            </script> 
                    </div>
					<div class="hr-line-dashed"></div>
					<div class="form-group">
						<label class="col-sm-2 control-label">字段名称</label>
						<div class="col-sm-3">
							<input type="text" name="fieldname" <?php if(isset($field))echo "value='$field[fieldname]' readonly='readonly'";  ?> class="form-control" placeholder="英文字母组成">
							<span class="help-block m-b-none">字段名称以字母、数字、和下划线组成,并且只能以字母开头.</span>
						</div>
						<div class="col-sm-3">
							<span class="help-block m-b-none">如：你的姓名，联系方式等等</span>
						</div>
					</div>
					<div class="hr-line-dashed"></div>
					<div class="form-group">
						<label class="col-sm-2 control-label">字段别称</label>
						<div class="col-sm-3">
							<input type="text" name="title" <?php if(isset($field))echo "value='$field[title]'";  ?> class="form-control" placeholder="字段别称">
						</div>
						<div class="col-sm-3">
							<span class="help-block m-b-none">如：你的姓名，联系方式等等</span>
						</div>
					</div>

					<div class="hr-line-dashed"></div>
					<div class="form-group">
						<label class="col-sm-2 control-label">字段录入提示：</label>
						<div class="col-sm-3">
							<input type="text" name="prompt" <?php if(isset($field))echo "value='$field[prompt]'";  ?> class="form-control">
						</div>
						<div class="col-sm-3"><span class="help-block m-b-none">显示在录入框的提示信息</span></div>
					</div>
					<div class="hr-line-dashed"></div>
					<div class="form-group">
						<label class="col-sm-2 control-label">字段类别</label>
						<div class="col-sm-2">
							<div class="radio radio-info radio-inline">

								<input type="radio" id="fiesys1" value="0" disabled name="fiesys" <?php if(isset($field)){if($field['fiesys']==0)echo "checked='checked'";}  ?>>
								<label for="fiesys1">系统字段</label>
							</div>
							<div class="radio radio-info radio-inline">
								<input type="radio" id="fiesys2" value="1" disabled name="fiesys" <?php if(isset($field)){if($field['fiesys']==1)echo "checked='checked'";}else{echo "checked='checked'";}?>>
								<label for="fiesys2">自定义</label>
							</div>
						</div>
					</div>
					<div class="hr-line-dashed"></div>
					<div class="form-group">
						<label class="col-sm-2 control-label">字段类型</label>
						<div class="col-sm-6">
							<div class="col-sm-12">
								<div class="radio radio-info radio-inline">
									<input type="radio" id="fieldtype1" value="1" name="fieldtype" <?php if(isset($field)){echo "disabled "; if($field['fieldtype']==1)echo "checked='checked'";}else{echo "checked='checked'";}  ?>>
									<label for="fieldtype1">单行文本</label>
								</div>
								<div class="radio radio-info radio-inline">
									<input type="radio" id="fieldtype2" value="2" name="fieldtype" <?php if(isset($field)){echo "disabled ";if($field['fieldtype']==2)echo "checked='checked'";}  ?>>
									<label for="fieldtype2">多行文本(不支持HTML)</label>
								</div>
								<div class="radio radio-info radio-inline">
									<input type="radio" id="fieldtype3" value="3" name="fieldtype" <?php if(isset($field)){echo "disabled ";if($field['fieldtype']==3)echo "checked='checked'";}  ?>>
									<label for="fieldtype3">多行文本(支持HTML)</label>
								</div>
								<div class="radio radio-info radio-inline">
									<input type="radio" id="fieldtype4" value="4" name="fieldtype" <?php if(isset($field)){echo "disabled ";if($field['fieldtype']==4)echo "checked='checked'";}  ?>>
									<label for="fieldtype4">下拉选项</label>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="radio radio-info radio-inline">
									<input type="radio" id="fieldtype5" value="5" name="fieldtype" <?php if(isset($field)){echo "disabled ";if($field['fieldtype']==5)echo "checked='checked'";}  ?>>
									<label for="fieldtype5">单选框</label>
								</div>
								<div class="radio radio-info radio-inline">
									<input type="radio" id="fieldtype6" value="6" name="fieldtype" <?php if(isset($field)){echo "disabled ";if($field['fieldtype']==6)echo "checked='checked'";}  ?>>
									<label for="fieldtype6">复选框</label>
								</div>
								<div class="radio radio-info radio-inline">
									<input type="radio" id="fieldtype7" value="7" name="fieldtype" <?php if(isset($field)){echo "disabled ";if($field['fieldtype']==7)echo "checked='checked'";}  ?>>
									<label for="fieldtype7">日期</label>
								</div>
								<div class="radio radio-info radio-inline">
									<input type="radio" id="fieldtype8" value="8" name="fieldtype" <?php if(isset($field)){echo "disabled ";if($field['fieldtype']==8)echo "checked='checked'";}  ?>>
									<label for="fieldtype8">数字</label>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="radio radio-info radio-inline">
									<input type="radio" id="fieldtype9" value="9" name="fieldtype" <?php if(isset($field)){echo "disabled ";if($field['fieldtype']==9)echo "checked='checked'";}  ?>>
									<label for="fieldtype9">小数字</label>
								</div>
								<div class="radio radio-info radio-inline">
									<input type="radio" id="fieldtype10" value="10" name="fieldtype" <?php if(isset($field)){echo "disabled ";if($field['fieldtype']==10)echo "checked='checked'";}  ?>>
									<label for="fieldtype10"> 货币(Money)</label>
								</div>
								<div class="radio radio-info radio-inline">
									<input type="radio" id="fieldtype11" value="11" name="fieldtype" <?php if(isset($field)){echo "disabled ";if($field['fieldtype']==11)echo "checked='checked'";}  ?>>
									<label for="fieldtype11">电子邮箱</label>
								</div>
								<div class="radio radio-info radio-inline">
									<input type="radio" id="fieldtype12" value="12" name="fieldtype" <?php if(isset($field)){echo "disabled ";if($field['fieldtype']==12)echo "checked='checked'";}  ?>>
									<label for="fieldtype12">图片</label>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="radio radio-info radio-inline">
									<input type="radio" id="fieldtype13" value="13" name="fieldtype" <?php if(isset($field)){echo "disabled ";if($field['fieldtype']==13)echo "checked='checked'";}  ?>>
									<label for="fieldtype13">文件</label>
								</div>
								<div class="radio radio-info radio-inline">
									<input type="radio" id="fieldtype14" value="14" name="fieldtype" <?php if(isset($field)){echo "disabled ";if($field['fieldtype']==14)echo "checked='checked'";}  ?>>
									<label for="fieldtype14">联动下拉列表</label>
								</div>
								<div class="radio radio-info radio-inline">
									<input type="radio" id="fieldtype15" value="15" name="fieldtype" <?php if(isset($field)){echo "disabled ";if($field['fieldtype']==15)echo "checked='checked'";}  ?>>
									<label for="fieldtype15">日期+时间</label>
								</div>
								<div class="radio radio-info radio-inline">
									<input type="radio" id="fieldtype16" value="16" name="fieldtype" <?php if(isset($field)){echo "disabled ";if($field['fieldtype']==16)echo "checked='checked'";}  ?>>
									<label for="fieldtype16">绑定其他模型</label>
								</div>
							</div>
						</div>
					</div>
					<div class="hr-line-dashed"></div>
				<!--  隐藏内容 -->
					<!--1-->

                   <div class="form-group" id="cresg" <?php if(isset($field)){if($field['fieldtype']==6){echo 'style="display:block"';}else{echo 'style="display:none"';}}else{echo 'style="display:none"';}?>>
						<label class="col-sm-2 control-label">创建小分组</label>
						<div class="col-sm-2">
							<div class="radio radio-info radio-inline">
								<input type="radio" id="cresg1" name="cresg" <?php if(isset($field)){echo ' disabled ';if($field['showtitle']=='')echo "checked='checked'";}else{echo "checked='checked'";}?>>
								<label for="cresg1">否</label>
							</div>
							<div class="radio radio-info radio-inline">
								<input type="radio" id="cresg2" name="cresg" <?php if(isset($field)){echo ' disabled ';if($field['showtitle']!='')echo "checked='checked'";}?>>
								<label for="cresg2">是</label>
							</div>
						</div>
					</div>
                    
                    <div id="showtitle"  <?php if(isset($field)){if($field['fieldtype']==6){echo 'style="display:block"';}else{echo 'style="display:none"';}}else{echo 'style="display:none"';}?>>
                        <div class="form-group cresg2" <?php if(isset($field)){if($field['showtitle']==''){echo 'style="display:none"';}else{echo 'style="display:block"';}}else{echo 'style="display:none"';}?>>
                            <label class="col-sm-2 control-label">小分组名</label>
                            <div class="col-sm-2">
                                <input type="text" name="showtitle" <?php if(isset($field))echo "data='$field[showtitle]' value='$field[showtitle]'";  ?> class="form-control">
                            </div>
                        </div>
                        <div class="form-group cresg1" <?php if(isset($field)){if($field['showtitle']==''){echo 'style="display:block"';}else{echo 'style="display:none"';}}else{echo 'style="display:block"';}?>>
                                    <label class="col-sm-2 control-label">所属小分组</label>
                                    <div class="col-sm-2">
                                        <select class="form-control" name="isshow" id="isshow">
                                        <?php
                                            $html = '<option value="0" >请选择</option>';
                                            
                                            foreach($smallgroup as $k=>$v)
                                            {
                                                if(isset($field))
                                                {
                                                        if($v['fieldid']==$field['isshow'])
                                                        {
                                                          $html .= " <option value='$v[fieldid]' selected='selected'>$v[showtitle]</option>";
                                                        }else{
                                                            $html .= " <option value='$v[fieldid]'>$v[showtitle]</option>";
                                                             }
                                                }else{
                                                  $html .= "<option value='$v[fieldid]'>$v[showtitle]</option>";
                                                }
                                            }
                                            echo $html;
                                         ?>
                                        </select>
                                    </div>
                        </div>  
                   </div>   
					<div class="form-group" id="showDefaultValue"><!--1-->
						<label class="col-sm-2 control-label">默认值</label>
						<div class="col-sm-3">
							<input type="text" name="defaultval" <?php if(isset($field))echo "value='$field[defaultval]'";  ?> class="form-control">
						</div>
					</div>


					<div class="form-group" id="WidthArea"><!--2-->
						<label class="col-sm-2 control-label">显示宽度</label>
						<div class="col-sm-1">
							<input type="text" name="width" <?php if(isset($field)){echo "value='$field[width]'";}else{echo "value='300'";} ?> class="form-control">
						</div>
						<label class="col-sm-2 control-label">px <i>列如：200px</i></label>
					</div>

					<div class="form-group" id="HeightArea" style="display:none"><!--3-->
						<label class="col-sm-2 control-label">显示高度</label>
						<div class="col-sm-1">
							<input type="text" name="height" <?php if(isset($field)){echo "value='$field[height]'";}else{echo "value='150'";}  ?> class="form-control">
						</div>
						<label class="col-sm-2 control-label">px <i>列如：200px</i></label>
					</div>


					<div class="form-group" id="ToolbarArea" style="display:none"><!--4-->
						<label class="col-sm-2 control-label">编辑器类型</label>
						<div class="col-sm-2">
							<select>
								<option >简洁型编辑器</option>
							</select>
						</div>

					</div>
                    <div class="form-group" id="ParentIDArea" style="display:none"><!--8-->
						<label class="col-sm-2 control-label">所属父级字段</label>
						<div class="col-sm-2">
							<select class="form-control">
                            <option>作为一级联动</option>
                            </select>
						</div>

					</div>
					<div class="form-group" id="ListArea" style="display:none"><!--5-->
						<label class="col-sm-2 control-label">列表选项</label>
						<div class="col-sm-2">
							<textarea class="form-control"></textarea>
						</div>

					</div>
                    
                    <div class="form-group" id="FileArea" style="display:none"><!--6-->
						<label class="col-sm-2 control-label">允许上传文件类型</label>
						<div class="col-sm-2">
							<input type="text" class="form-control"/>
						</div>
					<div class="row">
                      <div class="form-group"  style="display:none"><!--7-->
						<label class="col-sm-2 control-label">允许上传文件大小</label>
						<div class="col-sm-1">
							<input type="text" class="form-control"/>
						</div>
					</div>
                    
                    </div>
                 
					</div>
	                 <div class="form-group" id="ParentIDArea" style="display:none"><!--8-->
						<label class="col-sm-2 control-label">所属父级字段</label>
						<div class="col-sm-2">
							<select class="form-control">
                            <option>作为一级联动</option>
                            </select>
						</div>
					</div>
                    <div class="form-group" id="showBindModel" style="display:none"><!--9-->
						<label class="col-sm-2 control-label">请选择要绑定的模型</label>
						<div class="col-sm-2">
							<select class="form-control">
                            <option>文章系统</option>
                            </select>
						</div>

					</div>
					<!--  end  -->
					<div class="hr-line-dashed"></div>
					<div class="form-group">
						<label class="col-sm-2 control-label">特殊属性</label>
						<div class="col-sm-6">
                            <div class="checkbox checkbox-info checkbox-inline">
								<input id="manageitem" type="checkbox" value="1" <?php if(isset($field)){if($field['manageitem']==1){echo "checked";} } ?> name="manageitem">
								<label for="manageitem">
									管理项
								</label>
							</div>
                            <div class="checkbox checkbox-info checkbox-inline">
								<input id="isentry" type="checkbox" value="1" <?php if(isset($field)){if($field['isentry']==1){echo "checked";}}else{echo "checked";} ?> name="isentry">
								<label for="isentry">
									录入项
								</label>
							</div>
							<div class="checkbox checkbox-info checkbox-inline">
								<input id="mustinput" type="checkbox" value="1" <?php if(isset($field)){if($field['mustinput']==1){echo "checked";} } ?> name="mustinput">
								<label for="mustinput">
									必填项
								</label>
							</div>
						</div>
					</div>
					<div class="hr-line-dashed"></div>
					<div class="form-group">
						<label class="col-sm-2 control-label">字段状态
							<span class="help-block m-b-none blue">只有正常状态的字段才可以使用</span>
						</label>
						<div class="col-sm-2">
							<div class="radio radio-info radio-inline">

								<input type="radio" id="isweb11" value="1" <?php if(isset($field)){if($field['status']==1){echo "checked";}}else{echo "checked";}?> name="status">
								<label for="isweb11">正常</label>
							</div>
							<div class="radio radio-info radio-inline">
								<input type="radio" id="isweb22" value="0" <?php if(isset($field)){if($field['status']==0){echo "checked";}}?> name="status">
								<label for="isweb22">禁用</label>
							</div>
						</div>
					</div>
					
					
					
					<div class="footer-page">
                    <div class="col-sm-5"></div>
						<div class="col-sm-3 mt3">
							<button class="btn btn-s-md btn-primary" type="submit"><?php if(!isset($field)){echo '确定添加';}else{echo '确定修改';} ?></button>
							<a href="javascript:history.go(-1);" class="btn btn-default btn-s-md">取消</a>
						</div>
					</div>
					</form>
					
				</div>
			</div>
		</div>
	</div>
</div>

<br />
<br />

<script>
    $(function(){
		document.getElementById("myForm").reset();
	});
	$("#cresg1").click(function(){
             $(".cresg1").show();
             $(".cresg2").hide();
			 $("input[name='showtitle']").val('');
    });
	$("#cresg2").click(function(){
		     var data = $("input[name='showtitle']").attr('data');
			 $(".cresg2").show();
             $(".cresg1").hide();
			 $("input[name='showtitle']").val(data);
    });	
	$("input[name='fieldtype']").click(function(){

		var v =$(this).val();
		
		$("#ParentIDArea").hide();
		$("#WidthArea").show();
		$("#HeightArea").hide();
		$("#FileArea").hide();
		$("#ListArea").hide();
		$("#cresg").hide();
		$("#showtitle").hide();
		$("#showBindModel").hide();
		$("#showDefaultValue").show();
		$("#ToolbarArea").hide();
		
		if (v==2||v==3){$("#showDefaultValue").hide();$("#HeightArea").show();}
		if (v==3){$("#ToolbarArea").show();}
		
		if (v==4||v==5||v==6||v==14){$("#ListArea").show();}
		
		if (v==5||v==6){$("#WidthArea").hide();}
		
		if (v==6){$("#showtitle").show();$("#cresg").show();}

		if (v==12||v==13){
			$("#FileArea").show()}	
		if (v==14){
			$("#ParentIDArea").show();}
			
		if (v == 16) {
			$("#showBindModel").show();
		} 
		

	});
</script>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
loadScorllJs();
</script>
</body>
</html>