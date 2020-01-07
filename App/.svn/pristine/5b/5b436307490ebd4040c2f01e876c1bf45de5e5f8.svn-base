<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="renderer" content="webkit">
    <title>收款设置</title>
    <link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
    <link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
    <link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
    <link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
    <link href="<?php echo UOOT;?>Public/app/css/pay.css?<?php echoHash(); ?>" rel="stylesheet" />
    <style>
        .wx-checkbox p{
            font-size:14px;
           padding:5px 0;
        }
        ..wx-confirm{
            padding-top:50px;
        }
    </style>
</head>
<body class="ks-wrap">
<div class="ks-wbox bRadius10">

    <div class="ks-head-box">
        <div class="ks-head-nav" style="border-bottom: 1px solid #eee;">
            <!--标题-->
            <a href="javascript:history.go(-1)">结算中心</a><a><em>/</em>收款设置</a><span><em>/</em>微信认证服务号</span>
            <!--标题-->
        </div>

    </div>



    <!--table-->
    <form target="hidframe" id="myform" action="" method="post">

        <div class="wx-container">
            <div class="ws-tab" >
                <div class="wx-line"></div>
                <ul class="clearfix">
                    <li class="curr">
                        <div class="wx-tab-item">
                            <span>1</span>
                            <p>授权微信认证服务号</p>
                        </div>
                    </li>
                    <li>
                        <div class="wx-tab-item">
                            <span>2</span>
                            <p>配置业务域名</p>
                        </div>
                    </li>
                    <li>
                        <div class="wx-tab-item">
                            <span>3</span>
                            <p>设置支付信息</p>
                        </div>
                    </li>
                    <li>
                        <div class="wx-tab-item">
                            <span>4</span>
                            <p>验证支付信息</p>
                        </div>
                    </li>
                    <li>
                        <div class="wx-tab-item">
                            <span>5</span>
                            <p>完成</p>
                        </div>
                    </li>
                </ul>
            </div>

            <!--微信认证服务号-->
            <div class="wx-container">
                <div class="wx-content clearfix"  >
                    <div class="wx-left">
                         
                        <?php if(empty($weixinstatus)){ ?>
                        <div class="wx-radio-box" id="radio1">
                          
                            <div class="wx-s-title">
                                1.1我已拥有微信认证服务号
                            </div>
                            <div class="wx-radio">
                                <label for="wxradio1">
                                
                                    <input type="radio" id="wxradio1" value="1" class="radioInput" name="wxradio" onclick="radioShow(this,2)"  <?php if($radios[0]==1){ echo 'checked';} ?> <?php if(!empty($weixinstatus)){echo 'disabled'; } ?>>是</label>
                                <label for="wxradio2">
                                    <input type="radio" id="wxradio2" value="2" class="radioInput" name="wxradio" onclick="radioShow(this,2)" <?php if($radios[0] != 1){ echo 'checked';} ?> <?php if(!empty($weixinstatus)){echo 'disabled'; } ?> >否
                                 </label>   
                                 <a target="_Blank" href="https://mp.weixin.qq.com/cgi-bin/readtemplate?t=register/step1_tmpl&lang=" style="color:#2a75ed">立即申请</a>
                            </div>
                        </div>
                         <?php } ?>
                        
                        <div class="wx-radio-box" style="display: none;" id="radio2">
                            <div class="wx-s-title">
                                1.2此服务号已开通微信支付
                            </div>
                            <div class="wx-radio">
                                <label for="wxradio3">
                                    <input type="radio" id="wxradio3" value="1" class="radioInput" name="wxradio1" onclick="radioShow(this,3)" <?php if($radios[1]==1){ echo 'checked';} ?> <?php if(!empty($weixinstatus)){echo 'disabled'; } ?>>是
                                </label>
                                <label for="wxradio4" class="label-on">
                                    <input type="radio" id="wxradio4" value="2" class="radioInput" name="wxradio1" onclick="radioShow(this,3)" <?php if($radios[1]!=1){ echo 'checked';} ?> <?php if(!empty($weixinstatus)){echo 'disabled'; } ?> >否
                                </label>    
                                <a target="_Blank" href="https://pay.weixin.qq.com/index.php/core/home/login?return_url=%2F" style="color:#2a75ed">立即开通</a>
                            </div>
                        </div>
               

                        <div class="wx-radio-box" style="display: none;" id="radio3">
                            <div class="wx-s-title">
                                1.3授权服务<?php if(!empty($weixinstatus)){ echo '(已授权)'; } ?>
                            </div>
                            <div class="wx-radio">
                                <?php if(empty($weixinstatus)){ ?>
                                    <button class="ks-heade-button ks-head-primary" onclick="empower()">立即授权</button>
                                <?php }else{ ?>
                                   
                                    <button class="ks-heade-button ks-head-primary" onclick="delempower()">删除授权</button>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="wx-confirm">
                            <div class="wx-checkbox">

                                <div class="wx-inline">

                                    <?php 
                                    if ($weixinstatus){
                                    ?>
                                    <p class="has_confirm_account"><span>微信公众号：</span><?php echo $weixinstatus['weixinname']; ?></p>
                                    <p class="has_confirm_account"><span>公众号appid：</span><?php echo $weixinstatus['appid']; ?></p>
                                    <p class="has_confirm_account" style="padding-bottom:15px;"><span>账户类型：</span><?php if($weixinstatus['weixintype']==2){echo '服务号';}else{echo '订阅号(不支持微信支付)';}; ?></p>
                                   
                                     <button class="ks-bt bt-gg ml20" data-code="2" onclick="tabClick(this)" id="step1">已授权，进入下一步</button>
                                      &nbsp;
                                     <button class="ks-heade-button ks-head-primary" onclick="delempower()">删除授权</button>
                                    <?php
                                          }else{?>
                                     <button class="ks-bt bt-gg ml20" data-code="2" onclick="tabClick(this)" id="step1" disabled>下一步</button>
                                    <?php
                                         }
                                          ?>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="wx-right">
                        <p style="margin-bottom: 30px;">您授权的服务号须满足以下条件:</p>
                        <p>1.该服务号为“已认证服务号”<a href="http://kf.qq.com/faq/120911VrYVrA151013MfYvYV.html">如何认证微信服务号？</a></p>
                        <?php
                        $regurl=shortchain('https://mp.weixin.qq.com/cgi-bin/readtemplate?t=register/step1_tmpl&lang=');
                        ?>
                        <p>服务号注册地址：<a target="_blank" href="<?php echo($regurl)?>" ><?php echo($regurl)?></a></p>
                        <?php
                        $regurl=shortchain('http://kf.qq.com/faq/120911VrYVrA151013MfYvYV.html');
                        ?>
                        <p>服务号注册步骤：<a target="_blank" href="<?php echo($regurl)?>"><?php echo($regurl)?></a></p>

                        <?php
                        $regurl=shortchain('http://kf.qq.com/faq/161220Brem2Q161220uUjERB.html');
                        ?>
                        <p> 服务号认证流程：<a target="_blank" href="<?php echo($regurl)?>"><?php echo($regurl)?></a></p>
                        <p>2.该服务号已开通“微信支付”<a href="http://kf.qq.com/faq/170116ZFBRRf170116AVV3Er.html">如何开通微信支付？</a></p>
                        <p>为了保证所有功能正常，授权公众号时请保持默认选择，把权限统一授权给科汛V名师。</p>
                        <p>授权服务号后，您的用户信息将会发生变更。</p>
                        <p style="color:#e5412c;">您一旦授权自己的服务号后不可更换。</p>
                    </div>
                </div>

                <!--配置业务域名-->
                <div class="wx-content clearfix"  style="display: none;">
                    <div class="wx-left">
                        <div class="wx-s-title">
                            需要登录微信公众号将以下配置文件配置到对应位置
                        </div>
                        <div class="wx-s-txt">
                            <span>业务域名文件：</span>
                            <div class="wx-s-btn">
                                <p>登入微信公众号后台下载业务域名文件，在此上传  <a href="<?php echo MY_FULLDOMAIN;?>/home/help#anchor148" target="_blank">查看详细教程</a></p>
                                <button type="button" class="ks-heade-button ks-head-primary"><input type="file" id="upload" style="opacity: 0;" /><?php if(empty($payconfig['filename'])){ echo '选择文件'; }else{ echo '重新选择'; }?></button>


                                <div id="uploadifive-wx_bus_verify_txt-queue" class="uploadifive-queue"></div>
                                <p id="current_wx_verify" <?php if(empty($payconfig['filename'])){ echo 'style="display: none;"'; }?> >
                                    <a id="filename"><?php if(!empty($payconfig['filename'])){ echo $payconfig['filename'];} ?></a>

                                </p>
                            </div>
                        </div>
                        <div class="wx-s-txt">
                            <span>业务域名：</span>
                            <div class="wx-s-btn">
                                <p>点击获取业务域名:<?php echo MY_DOMAIN; ?>，登录微信公众号后台填写保存  <a href="<?php echo MY_FULLDOMAIN;?>/home/help#anchor148" target="_blank">查看详细教程</a></p>
                                <button type="button" class="ks-heade-button ks-head-primary" onclick="copyUrl('link1')">点击复制</button>
                                <input id="link1" value="<?php echo MY_DOMAIN; ?>" type="text" style="height: 0;border: 0;"/>
                            </div>
                        </div>

                        <div class="wx-confirm">
                            <div class="wx-checkbox">
                                <label class="mr30"><input value="1" type="checkbox"name="roll" id="config1" onclick="configClick(1)">
                                    <span  >我已完成上述配置</span></label>
                                <div class="wx-inline">
                                    <button type="button" class="ks-bt bt-defalut" data-code="1" onclick="tabClick(this)">上一步</button>
                                    <button type="button" class="ks-bt bt-gg ml20"data-code="3" onclick="tabClick(this)" id="step2" disabled>下一步</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="wx-right">
                        <p style="margin-bottom: 30px;">为什么需要配置业务域名？</p>
                        <p style="margin-bottom: 40px;">如不进行业务域名配置，用户在评论时会弹出安全提示：防欺诈盗号，请勿支付或输入请求密码。<font style="color: #e5412c;">请务必正确配置</font></p>
                        <p>提示：请勿重复下载此微信业务域名文件，因为重复下载会让业务域名文件的文件名自动生成"-2","-3"等编号后缀，导致后续操作因文件名不匹配而出现配置错误提示</p>

                    </div>
                </div>


                <!--设置支付信息-->
                <div class="wx-content clearfix" style="display: none;">
                    <div class="wx-left">
                        <div class="wx-s-title">
                            需要登录微信公众号将以下配置文件配置到对应位置
                        </div>
                        <div class="wx-s-txt">
                            <span>微信商户号：</span>
                            <div class="wx-s-btn">
                                <input class="form-textbox"  name="MchId"   type="text" value="<?php if(!empty($content[0])){echo $content[0];} ?>"/>
                                <p onclick="window.open('http://kf.qq.com/faq/120911VrYVrA151013MfYvYV.html')">如何获取微信商户号</p>
                            </div>
                        </div>
                        <div class="wx-s-txt">
                            <span>微信商户API密钥：</span>
                            <div class="wx-s-btn">
                                <input class="form-textbox" maxlength="32" name="AppSecret"  type="text" value="<?php if(!empty($content[3])){echo $content[3];} ?>"/>
                                <p>如何获取微信商户API密钥</p>
                            </div>
                        </div>
                        <div class="wx-s-txt">
                            <span>支付授权目录：</span>
                            <div class="wx-s-btn">
                                <button class="ks-heade-button ks-head-primary clip" onclick="copyUrl('link2')"  style="float: none;">点击复制</button>
                                <p><?php echo MY_FULLDOMAIN; ?>/Plus/</p>
                                <input id="link2" value="<?php echo MY_FULLDOMAIN; ?>/Plus/" type="text" style="height: 0;border: 0;"/>
                            </div>
                        </div>

                        <div class="wx-confirm">
                            <div class="wx-checkbox">
                                <label class="mr30"><input value="1" type="checkbox"name="roll" id="config2" onclick="configClick(2)">
                                    <span >我已完成上述配置</span></label>
                                <div class="wx-inline">
                                    <button type="button" class="ks-bt bt-defalut" data-code="2" onclick="tabClick(this)">上一步</button>
                                    <button type="button" class="ks-bt bt-gg ml20"data-code="4" onclick="tabClick(this)" id="step3" disabled>下一步</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="wx-right">
                        <p style="margin-bottom: 30px;">为什么需要配置支付授权目录？</p>
                        <p>如未能正确配置"支付授权目录"，用户只能通过长按识别二维码的方式购买您店铺内的商品。<font style="color:#e5412c;">请务必正确配置！</font></p>
                    </div>
                </div>


                <!--验证支付信息-->
                <div class="wx-content clearfix" style="display: none;">
                    <div class="wx-left">
                        <div class="wx-code">
                            <p>扫码验证支付信息</p>
                            <div class="wx-code-img">
                                <img id="paycode" src="<?php echo UOOT;?>Public/app/images/appicon/wx-code.jpg">
                            </div>
                            <p>扫描上方二维码支付0.01元，此费用为验证支</br>付信息配置是否正确，支付成功资金将直接打入您设置的微信收款账户中。</p>
                            <p>
                                <label  id="successTxt"  for="success" class="label-on" style="display: none;">
                                    <input type="radio"value="1" class="radioInput" name="success" checked="checked">验证成功，请继续下一步</label>
                            </p>
                        </div>

                        <div class="wx-confirm">
                            <div class="wx-checkbox">

                                <div class="wx-inline">
                                    <button class="ks-bt bt-defalut" data-code="3" onclick="tabClick(this)">上一步</button>
                                    <button class="ks-bt bt-gg ml20" data-code="5" onclick="tabClick(this)" id="step4" disabled>下一步</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="wx-right">
                        <p>支付信息配置正确：</p>
                        <p style="margin-bottom: 30px;">扫码后点击支付按钮正常输入密码支付</p>
                        <p>支付信息配置有误：</p>
                        <p>点击支付后提示长按二维码支付-- 请检查支付授权目录配置是否有误</p>
                    </div>

                </div>

                <!--配置成功-->

                <div class="wx-content clearfix" style="display: none;">
                    <div class="wx-left">
                        <div class="wx-success">
                            <div class="wx-s-icon">
                                <i class="iconfont icon-zhengque"></i>
                            </div>
                            <p class="wx-s-title1">恭喜，配置成功</p>
                            <p class="wx-s-mg">通过您的店铺地址：<?php echo wx_Url($this->wxid);?> 交易的款项，将直接进入您当前配置的微信收款账号。</p>
                           <!--<p><a><?php echo wx_Url($this->wxid);?></a><button class="bt-pue">复制链接</button></p>-->
                        </div>
                    </div>
                    <div class="wx-right">
                        <p style="margin-bottom: 20px;">特别提醒：</p>
                        <p style="margin-bottom: 10px;">开启认证服务号渠道后，请勿在未认证的公众号中售卖商品，否则可能出现用户无法支付等严重后果！此种情况由微信打击跨号支付造成</p>
                        <!--<a style="color: #e5412c;">点击查看解决方案</a>-->

                    </div>
                </div>
            </div>
    </form>
</div>

<!--支付宝-->

<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script src="<?php echo UOOT;?>Public/common/js/clipboard.min.js"></script>
<script>
    module.require(['$','backstage'],function(){



        /*认证服务号*/
        var radioval =$('input:radio[name="wxradio"]:checked').val();
        var radioval2 =$('input:radio[name="wxradio1"]:checked').val();

        if(radioval==1){
            $('#radio2').show();
        }else{
            $('#radio2').hide();
        }

        if(radioval2==1){
            $('#radio3').show();
        }else{
            $('#radio3').hide();
        }

        var radis = $('.wx-radio').find('input[type="radio"]').attr('disabled');
        if(radis=='disabled') {
            $('#step1').addClass('light');
            $('#step1').removeAttr("disabled")
        }


        $('.wx-radio').find('input').each(function(){
            var radioDis = $(this).attr('disabled');
            if (radioDis=='disabled'){
                $(this).parent('label').addClass('unclick')
            }
        })




        /*设置切换*/
        $("#upload").change(function () {
            var formData = new FormData();
            formData.append("myfile", document.getElementById("upload").files[0]);
            $.ajax({
                url: "<?php echo M_URL($this->AppName.'/Index','imgload','',GP('')); ?>",
                type: "POST",
                data: formData,
                /**
                 *必须false才会自动加上正确的Content-Type
                 */
                contentType: false,
                /**
                 * 必须false才会避开jQuery对 formdata 的默认处理
                 * XMLHttpRequest会对 formdata 进行正确的处理
                 */
                processData: false,
                success: function (data) {

                    var data = JSON.parse(data);
                    if (data.result == "succeed") {
                        $('#current_wx_verify').show();
                        $('#filename').html(data.info);
                        Alert('上传成功',2);
                    }
                    if (data.result == "error") {
                        Alert(data.info);
                    }
                    $("#imgWait").hide();
                },
                error: function () {
                    alert("上传失败！");
                }
            });
        });

    });
    function configClick(step){

        if(step===1){ //第二步骤

            (getId('filename').innerText && getId('config1').checked) && (

                $('#step2').addClass('light'),

                    $('#step2').removeAttr("disabled")
            )


        }else if (step===2)	 { //第三步骤
            var textVal = $('.wx-s-btn').find('.form-textbox').val();


            if(textVal!=''&&  getId('config2').checked){
                $('#step3').addClass('light')
                $('#step3').removeAttr("disabled")
            }

        }else if(step===0){
            var radis = $('.wx-radio').find('input[type="radio"]').attr('disabled');
            if(radis=='disabled') {
                $('#step1').addClass('light')
            }

        }else if(step==3) {



        }


    }
    function tabClick(target){
        var _this = $(target);
        var code =  parseInt(_this.attr('data-code'))-1;


        configClick(code);
        var ordersn = '';
        if(code ==3){
            $.ajax({
                url: "<?php echo M_URL($this->AppName.'/Index','paycode','',GP('type-'.$type)); ?>",
                type: "POST",
                data:{MchId:$('[name=MchId]').val(),AppSecret:$('[name=AppSecret]').val()},
                success: function (data) {
                    var data = JSON.parse(data);
                    if(data.msg == 'error'){
                        Alert('设置有误，请联系客服');
                    }else if(data.msg == 'sss'){
                        Alert('请填写全部内容');
                    }else if(data.msg == 'good'){
                        Alert('保存成功',2);
                        $('#paycode').attr('src',data.url);
                        ordersn = data.ordersn;
                        $('.wx-content').eq(3).show().siblings().hide();
                        $('.ws-tab').find('li').eq(3).addClass('curr');

                        var a = function(){
                            $.ajax({
                                type:"post",
                                url:'<?php echo M_URL($this->AppName.'/Index','rechargebackW','',GP('type-'.$type));?>',
                                data:{
                                    "ordersn":ordersn,
                                },
                                success:function(data){
                                    if(data=='succeed'){

                                        $('#successTxt').show();
                                        $('#step4').removeAttr("disabled");
                                        $('#step4').addClass('light')

                                    }},
                                error:function(){
                                    return false;
                                }
                            });
                        }
                        var time = setInterval(a,5000);
                    }
                },
                error: function () {

                }
            });
        }else{
            $('.wx-content').eq(code).show().siblings().hide();
            $('.ws-tab').find('li').eq(code).addClass('curr')
        }

    }


    /*radioshow*/
    function radioShow(target,type){

        var _this =$(target);
        var code =$(_this).val();


        if (code==1) {
            $('#radio'+type).show();
        }else if(code==2){
            $('#radio'+type).hide();
        }
    }

    //授权成功执行
    function execute(){
        var wxradio = $('input:radio[name="wxradio"]:checked').val();
        var wxradio1 = $('input:radio[name="wxradio1"]:checked').val();
        $.ajax({
            url: "<?php echo M_URL($this->AppName.'/Index','wechatyz','',GP('type-'.$type)); ?>",
            type: "POST",

            data:{wxradio:wxradio,wxradio1:wxradio1},
            success: function (data) {
                $('#step1').addClass('light')
                $('#step1').removeAttr("disabled")
                if(data == 'true'){
                    location.reload();
                    $('#step1').addClass('light')
                    $('#step1').removeAttr("disabled")

                }else if(data == 'false'){
                    Alert('授权失败');

                }
            },
            error: function () {

            }
        });
    }

    //删除授权
    function delexecute(){
        $.post("<?php echo M_URL($this->AppName.'/Index','delWxPay','',GP('type-'.$type)); ?>",{},function (data) {
            if(data == 'succeed'){
                location.reload();
            }else{
                Alert('删除失败');
            }
        });
    }

    /*授权认证*/
    function empower(){
        location.href='<?php echo M_URL('wechat/Index','wechatConfig','',GP('')); ?>';
        return;
        window.open('<?php echo M_URL('wechat/Index','wechatConfig','',GP('')); ?>');
    
       top.KTJ_TipsDialog('请在新窗口中完成微信公众号授权！<a style="color:#2a75ed" href="<?php echo MY_FULLDOMAIN;?>/home/help#anchor148" target="_Blank">查看授权教程</a>',{
            buttons:[{
                 name:'授权成功',
                 type:'primary',
                 callback:function(){
                     execute()
                  }
            },{
                  name:'授权失败，重试'          
           }]
        })
        top.popup.open(false,{
            title:'提示',
            area:['640px','auto'],
            content:_html
        });
    }
    /*删除授权认证*/
    function delempower(){
        
        top.KTJ_TipsDialog('删除授权后将无法使用独立支付服务（可登陆您的<a style="color:#2a75ed" href="https://mp.weixin.qq.com/cgi-bin/loginpage?t=wxm2-login&lang=zh_CN" target="_Blank">公众平台</a>取消授权）',{
            buttons:[{
                type:'primary',
                name:'确定',
                callback:function(){
                  delexecute()
                }
            },{
                name:'取消'
            }]
        })
    }


    //文本复制
    function copyUrl(id){
        var Url2 = document.getElementById(id);
        Url2.select(); //选择对象
        document.execCommand("Copy"); //执行浏览器复制命令
        Alert("复制成功！",2)
    }


</script>
</body>
</html>
