<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>
        <?php if(!empty($userinfo)){echo "修改教师会员";}else{echo "添加教师会员";} ?>
    </title>
    <link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
    <link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
    <link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
    <link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
    <link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css" rel="stylesheet">

</head>
<style>
    .limits {
        padding: 5px 0;
        background: #f9f9f9;
    }
    
    .limits-layer {
        padding: 5px 15px;
    }
    
    .limits-layer label {
        color: #333;
    }
    
    .limits-layer--first {
        padding: 15px;
    }
    
    .limits-layer--first+.limits-layer--first {
        border-top: 1px solid #eee;
    }
    
    .limits-layer--first>.limits-layer__title {
        font-weight: bold;
    }
    
    .limits-layer--second,
    .limits-layer--third {
        padding-left: 25px;
    }
    
    .limits-layer__title {
        height: 28px;
        line-height: 28px;
        overflow: hidden;
        position: relative;
        padding-left: 14px;
    }
    
    .limits-layer__title label {
        margin-left: 5px;
    }
    
    .limits-layer--third .limits-layer__title {
        display: inline-block;
        width: 19%;
        min-width: 180px;
        box-sizing: border-box;
    }
    
    .limits-layer__arrow {
        position: absolute;
        width: 16px;
        height: 16px;
        left: 0;
        top: 5px;
        cursor: pointer;
        transition: .3s;
    }
    
    .limits-layer__arrow.expand {
        transform: rotate(-180deg)
    }
    
    .limits-layer__arrow::after {
        content: '';
        height: 0;
        width: 0;
        border: solid transparent;
        pointer-events: none;
        border-width: 5px;
        border-top-color: #c0c0c0;
        margin: 5px auto auto;
        display: block;
    }
</style>

<body class="ks-wrap">

    <form target="hidframe" method="post" id="myform" action="<?php if(!empty($value)){echo M_URL($this->AppName.'/Index','doroleAdd',$value['id'],GP('p-'.$now_page));}else{echo M_URL($this->AppName.'/Index','doroleAdd','',GP(" "));} ?>" class="form-horizontal"
        enctype="multipart/form-data">
        <div class="ks-wbox bRadius10">
            <div class="ks-head-nav">
                <!--标题-->
                <a href="javascript:history.go(-1);">角色管理</a><span> <em>/</em> <?php if(!empty($value)){echo "修改角色";}else{echo "添加角色";} ?>
				<!--标题-->
		</div>

		<div class="form-box tab-pane" style="display:block">
			<div class="form-row clearfix">
				<span class="name name-nowrap"><i class="form-star">*</i>角色名称</span>
                <div class="form-limit" limit="25">
                    <input type="text" class="form-textbox" name="title" value="<?php if(!empty($value)) echo $value['title'] ?>" />
                </div>
            </div>
            <div class="form-row form-po">
                <span class="name name-nowrap">简短描述</span>
                <div class="form-limit" limit="45">
                    <input type="text" class="form-textbox" name="shortdesc" value="<?php if(!empty($value[" shortdesc "])) echo $value["shortdesc "] ?>" />
                </div>
            </div>

            <div class="form-row" id="ctl00_KSContent_PowerPanel">
                <span class="name name-nowrap">权限设置</span>
                <div class="limits">
                    <?php foreach ($menu_list as $k=>$v) {?>
                    <div class="limits-layer limits-layer--first clearfix">
                        <div class="limits-layer__title">
                            <div class="limits-layer__arrow"></div>
                            <label>
								<input type="checkbox" /> <?php echo $v['title'];?>
							</label>
                        </div>
                        <div class="limits-layer__box">
                            <?php foreach ($v['subtopic'] as $k1=>$v1) {?>
                            <div class="limits-layer limits-layer--second">
                                <div class="limits-layer__title">
                                    <div class="limits-layer__arrow"></div>
                                    <label><input class="t1 fl" name="powerlist[]" type="checkbox" value="<?php echo $v1['key'].'|'.$v1['action'];?>" <?php if(!empty($value)){if(strstr(','.$value['rule'].',',','.$v1['key'].'|'.$v1['action'].',')){echo
									'type-name="true" checked="checked"';}}?>><?php echo $v1['title'];?></label>
                                </div>
                                <div class="limits-layer__box">
                                    <div class="limits-layer limits-layer--third">
                                        <?php foreach ($v1['childs'] as $k2=>$v2) {?>
                                        <div class="limits-layer__title">
                                            <label><?php echo $v2['title'];?>
												<input class="fl" type="checkbox" name="powerlist[]" value="<?php echo $v1['key'].'|'.$v2['action'];?>" <?php if(!empty($value)){if(strstr(','.$value['rule'].',',','.$v1['key'].'|'.$v2['action'].',')){echo
												'type-name="true" checked="checked"';}}?> >
											</label>
                                        </div>
                                        <?php }?>
                                    </div>
                                </div>
                            </div>
                            <?php }?>
                        </div>
                    </div>
                    <?php }?>

                </div>

            </div>
        </div>

        <div class="form-footer clearfix">
            <span class="d-inline-block">
		        <button type="button" onclick="do_reg()" class="ks-bt bt-pue"><?php if(!empty($value)){echo "确认修改";}else{echo "确认添加";} ?></button>
		        <button type="button" onclick="javascript:history.go(-1);" class="ks-bt bt-white">取消</button>
	    	</span>
        </div>

        </div>


    </form>

    <script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>

    <script>
        module.require(['$','backstage'], function() {
            $('.limits-layer__box').each(function() {
                var $this = $(this);
                var $checkboxs = $this.find('input[name="powerlist[]"]');
                if(!$checkboxs.length){
                    return
                }
                var checkedLength = 0;
                $checkboxs.each(function() {
                    if (this.checked) {
                        checkedLength++
                    }
                });
                
                if (checkedLength) {
                    $this.show();
                    $this.prev('.limits-layer__title').find('.limits-layer__arrow').addClass('expand');
                    $this.prev('.limits-layer__title').find('input[type="checkbox"]').prop('checked', true)
                } else {
                    $this.hide();
                    $this.prev('.limits-layer__title').find('.limits-layer__arrow').removeClass('expand');
                    $this.prev('.limits-layer__title').removeClass('expand').find('input[type="checkbox"]').prop('checked', false)
                }
                
            });

            $('.limits-layer__title').find('input[type="checkbox"]').change(function() {
                var $title = $(this).parents('.limits-layer__title').first();
                var $checkboxs = $title.next('.limits-layer__box').find('input[name="powerlist[]"]');
                $checkboxs.prop('checked', this.checked);
                if(this.checked){
                    $title.parent().parents('.limits-layer').children('.limits-layer__title').find('input[type="checkbox"]').prop('checked',true)
                }else{
                    $title.parent().parents('.limits-layer').each(function(){
                        var $checkboxs = $(this).find('.limits-layer__box input[name="powerlist[]"]');
                        var checkedLength = 0;
                        $checkboxs.each(function() {
                            if (this.checked) {
                                checkedLength++
                            }
                        });
                        if(!checkedLength){
                            $(this).children('.limits-layer__title').find('input[type="checkbox"]').prop('checked',false)
                        }
                    });
                }
            })
            $('.limits-layer__arrow').click(function(){
                $(this).toggleClass('expand').parent().next('.limits-layer__box').slideToggle()
            })

        });

        function do_reg() {
            $("#myform").submit();
        };
    </script>
</body>

</html>