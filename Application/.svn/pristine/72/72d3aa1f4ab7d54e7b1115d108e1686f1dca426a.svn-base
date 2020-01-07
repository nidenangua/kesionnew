<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
    <link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
    <script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
    <title></title>
    <style >
        .wexin-header .step {
            text-align: center;
            border-bottom: 2px solid #ccc;
            height: 15px;
        }
        .wexin-header .step a {
            background: #ccc;
            display: inline-block;
            width: 30px;
            height: 30px;
            line-height: 30px;
            border-radius: 50px;
            font-weight: bold;
            font-size: 20px;
            color: #fff;
            text-decoration: none;
            text-align: center;
        }
        .select  {
            border-bottom: 2px solid #43A7DE !important;
        }
        .wexin-header .select a {
            background: #43A7DE;
            color: #fff;
        }
        .wexin-title {
            padding: 15px;
            text-align: center;
            margin-bottom: 20px;
            color: #5A9BBF;
            border-bottom: 1px dashed #ddd;
            padding-bottom: 10px;
            font-size: 14px;
            font-weight: bold;
        }
        .open-key {
            font-weight: bold;
            background-color: #f0f9fe;
            padding: 5px 10px;
            border: 1px dashed #DBDBDB;
            margin-bottom: 20px;
        }
        .img-tips {
            border-radius: 3px;
            border: 1px #ddd solid;
            background-color: #EFEFEF;
            padding: 25px;
        }
        .taps-left {
            color: #E2A63F;
            font-size: 14px;
            font-weight: 400;
            line-height: 56px;
            float: left;
            text-align: right;
        }
        .steps,.ct-m {
            margin: 40px 20px;
        }
        .first {
            background-color: #F0F9FE;
            border-color: #c2dfff;
            border-bottom-color: #f0f9fe;
        }
        .ct-mb {
            position: relative;
            border-radius: 15px 0 0px 10px;
            border-style: solid;
            border-width: 1px;
        }
        .number {
            position: absolute;
            top: -10px;
            left: -10px;
            width: 38px;
            text-align: center;
            height: 38px;
            line-height: 38px;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            border-radius: 50%;
            border-width: 1px;
            border-style: solid;
            background-color: #ffffff;
            font-size: 30px;
        }
        .first .number {
            color: #c2dfff;
            border-color: #c2dfff;
        }
        .ct-m-l {
            padding-left: 40px;
            line-height: 25px;
            margin-right: 3%;
            width: 40%;
            display: inline-block;
            vertical-align: top;
            color: #E2A63F;
            font-size: 14px;
            font-weight: 400;
            float: left;
        }
        .ct-m-r {
            display: inline-block;
            width: 50%;
            float: left;
        }
        .ct-color {
            color: #29b6f6;
        }
        .bzjt {
            bottom: -26px;
            position: absolute;
            z-index: 1;
            left: 50%;
        }
        .second {
            background-color: #F2F2F2;
            border-color: #DDDDDD;
            border-bottom-color: #F2F2F2;
        }
        .second .number {
            color: #ddd;
            border-color: #ddd;
        }
        .ct-mt {
            padding-left: 20px;
            margin-top: 10px;
            clear: both;
        }
        .ct-mt .url {
            background: #999;
            color: #fff;
            padding: 8px 0px;
            width: 150px;
            float: left;
            margin-right: 30px;
            display: inline-block;
            /* font-size: 16px; */
            margin-bottom: 10px;
            border-radius: 3px;
            box-shadow: 0 3px 4px #CCC;
            border: 0;
            font-family: "Microsoft YaHei";
            text-align: center;
            /* letter-spacing: 5px; */
            -moz-transition: all .5s;
            -o-transition: all .5s;
            -webkit-transition: all .5s;
            transition: all .5s;
        }
        .third {
            background-color: #FFFAEF;
            border-color: #E3DAB0;
        }
        .third .number {
            color: #E3DAB0;
            border-color: #E3DAB0;
        }
      .ct-mt  .url-txt  {
          clear: both;
          padding: 8px;
          background-color: #fff;
          border: 1px solid #666;
          vertical-align: middle;
          display: block;
          text-align: center;
          color: #666;
      }
        .w200 {
            width: 200px !important;
        }
        .col-sm-2 {
            width: 16.6666667%;
        }
    </style>
</head>
<body class="gray-bg" >
<div class="wrapper mt55">
    <div class="row">
        <div id="manage_top" class="menu_top_fixed height73 p15">
            <h3 class="fl mr15">微信公众号配置</h3>
            <div class="ibox-tools">
                <a href="javascript:void(0)" onclick="history.go(0)" class="collapse-link mt0">
                    <i class="reflash"></i>
                </a>
            </div>

        </div>
    </div>
    <div class="row p15 bg-white">
     <div class="wexin-header clearfix p15">
            <div class="col-sm-4 step select">
                <a href="javascript:;">1</a>
            </div>
            <div class="col-sm-4 step">
                <a href="javascript:;">2</a>
            </div>
            <div class="col-sm-4 step">
                <a href="javascript:;">3</a>
            </div>
        </div>

        <form class="form-horizontal" method="post"   target="hidframe" action="<?php echo  M_URL('Wxmp','doconfig');  ?>" enctype="multipart/form-data" id="form">
            <!--第一步-->
            <div class="win-item" >
                <div class="wexin-title">
                    第一步：填写微信公众号类型与基本信息
                </div>
        <div class="open-key clearfix">
            <span class="key-open mt7 fl">是否对接公众号：</span>
            <div class="fl">
                <div class="radio radio-info  radio-inline">
                    <input  id="mbings1"type="radio"  <?php if($value['status']==1){echo "checked";}  ?>  value="1"  name="status"><label for="mbings1"> 是 </label>
                </div>
                <div class="radio radio-info  radio-inline">
                    <input  id="mbings2"  type="radio" <?php if($value['status']==0){echo "checked";}  ?>    name="status"  value="0" ><label for="mbings2"> 否 </label>
                </div>
            </div>
        </div>
        
        <div class="show-box val-1" <?php if($value['status']==0){?>style="display:none"<?php }?>>
        <div class="form-group clearfix">
            <label class="fl mt7 col-sm-2 control-label">公众号类型</label>
            <div class="col-sm-2 w200">
                <select class="form-control" name="weixintype">
                   <option value="1" <?php if($value['weixintype']==1){echo "selected";} ?>>--服务号--</option>
                    <option value="0" <?php if($value['weixintype']==0){echo "selected";} ?>>--订阅号--</option>
                </select>
            </div>
        </div>
       <div class="form-group clearfix">
                    <label class="fl mt7 col-sm-2 control-label">认证情况 </label>
           <div class="col-sm-8 ">
               <div class="radio radio-info  radio-inline">
                   <input  id="rz1"type="radio" checked="checked" value="1"    name="weixinstatus"><label for="rz1"> 已认证 </label>
               </div>
               <div class="radio radio-info  radio-inline">
                   <input  id="rz2"  type="radio" checked="checked" value="0" name="weixinstatus"><label for="rz2"> 未认证 </label>
               </div>
<!--                   <div class="col-sm-5"><input type="text" readonly style="border: 1px solid;padding: 5px 15px;border-radius: 5px "  name="weixinstatus"  value="--><?php //  if($value['weixinstatus']==1){echo "已验证"  ;}else{ echo "未验证";}   ?><!--"></div>-->
           </div>
<!--                    <div class="col-sm-2 w200">-->
<!--                        <select class="form-control" name="weixinstatus">-->
<!--                            <option value="1">已认证</option>-->
<!--                            <option value="0">未认证</option>-->
<!--                        </select>-->
<!--                    </div>-->
        </div>
        <div class="img-tips mb15 p25 clearfix">
            <label class="col-sm-5 taps-left" >注 ：请确认您的公众账号</label>
            <div class="col-sm-2"></div>
            <div class="col-sm-5">
                <div class="w240">
                    <img src="<?php echo UOOT;?>Public/uploads/common/account1.png">
                </div>
            </div>
        </div>
        <div class="form-group clearfix">
            <label class="col-sm-2 control-label">公众号名称</label>
            <div class="col-sm-4">
              <input class="form-control" type="text" value="<?php if(!empty($value)){echo $value['weixinname'];} ?>"  name="weixinname"  placeholder="请输入公众号名称">
            </div>
        </div>
        <div class="form-group clearfix">
            <label class="col-sm-2 control-label" >公众号原始ID</label>
            <div class="col-sm-4">
                <input class="form-control" type="text" value="<?php if(!empty($value)){echo $value['weixinid'];} ?>" placeholder="请输入公众号原始ID" name="weixinid">
            </div>
        </div>
        <div class="form-group clearfix">
            <label class="col-sm-2 control-label">权限说明</label>
            <div class="col-sm-5">
<!--                <input class="form-control" type="text" readonly placeholder="您可以使用[自定义菜单]，[粉丝管理],[回复粉丝]等高级功能">-->
                <span style="line-height: 35px;" class="border">
                    您可以使用[自定义菜单]，[粉丝管理],[回复粉丝]等高级功能
                </span>
            </div>
        </div>
        </div>
        <div class="show-box val-0" <?php if($value['status']==1){?>style="display:none"<?php }?>><button type="button"   num="3"   class="btn btn-primary btn-s-md ">保存</button></div>
                <div class="footer-page mt3">
                    <div class="col-sm-5"></div>
                    <div class="col-sm-4">
                        <button type="button"  num="1"  class="btn btn-primary btn-s-md ">下一步</button>
                    </div>
                </div>
            </div>
            <!--第二步-->

            <div class="win-item" style="display: none">
                <div class="wexin-title">
                    第二步： 配置微信开发者凭据
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2">AppID(应用ID)</label>
                    <div class="col-sm-4">
                        <input class="form-control" value="<?php if(!empty($value)){echo $value['appid'];} ?>" type="text" placeholder="请输入AppId" name="appid">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2">AppSecret(应用钥匙)</label>
                    <div class="col-sm-4">
                        <input class="form-control" value="<?php if(!empty($value)){echo $value['appsecret'];} ?>" type="text" placeholder="请输入AppSecret" name="appsecret">
                    </div>
                </div>
                <div class="img-tips mb15 p25 clearfix">
                    <label class="col-sm-5 taps-left" >
                        注：返回开发者中心，将AppID(应用ID)以及AppSecret(应用密钥)拷贝到上表中
                    </label>
                    <div class="col-sm-2"></div>
                    <div class="col-sm-5">
                        <div class="w240">
                            <img src="<?php echo UOOT;?>Public/uploads/common/account3.jpg">
                        </div>
                    </div>
                </div>
                <div class="footer-page mt3">
                    <div class="col-sm-5"></div>
                    <div class="col-sm-4">
                        <button type="button" num="2" class="btn btn-primary btn-s-md ">下一步</button>
                    </div>
                   </div>
            </div>
            <!--第三步--><div class="win-item" style="display:none">
                <div class="wexin-title">
                    第三步：进入微信公众平台并设置接口
                </div>
        <div class="steps ">
            <div class="ct-mb first ">
                <div class="number">1</div>
                <div class="ct-m clearfix">
                    <div class="ct-m-l">
                        <label class="">进入微信公共平台<a class="ct-color" href="http://mp.weixin.qq.com" target="_blank">http://mp.weixin.qq.com</a></label>
                        <p>登入微信公众平台，点击进入【开发者中心】</p>
                    </div>
                    <div class="ct-m-r">
                        <img src="<?php echo UOOT;?>Public/uploads/common/account21.jpg">
                    </div>
                    <img src="<?php echo UOOT;?>Public/uploads/common/bzjt01.png" class="bzjt">
                </div>
            </div>
            <div class="ct-mb second ">
                <div class="number">2</div>
                <div class="ct-m clearfix">
                    <div class="ct-m-l">
                        <label class="">修改服务器配置</label>
                        <p>在服务器配置处，点击【修改配置】</p>
                    </div>
                    <div class="ct-m-r">
                        <img src="<?php echo UOOT;?>Public/uploads/common/account22.jpg">
                    </div>
                    <img src="<?php echo UOOT;?>Public/uploads/common/bzjt02.png" class="bzjt">
                </div>
            </div>
            <div class="ct-mb third ">
                <div class="number">3</div>
                <div class="ct-m clearfix">
                    <div class="ct-m-l">
                        <label class="">配置微信接口</label>
                        <p>分别将下方的信息复制到【接口配置信息】的输入框</p>
                        <div class="ct-mt">
                            <p class="url">Url</p>
                            <input type="text" name="url" readonly class="form-control" value="https://php.user.kesion.com:443/plus/weixin/index.php" >
                        </div>
                        <div class="ct-mt">
                            <p class="url">Token</p>
                            <input type="text" name="token" readonly class="form-control" >
                        </div>
                        <div class="ct-mt">
                            <p class="url"> EncodingAESKey</p>
                            <input type="text" name="encodingaeskey" readonly class="form-control" >
                        </div>
<!--                        <div class="ct-mt">-->
<!--                            <p class="url">token有效期</p>-->
<!--<!--                            <input type="text" name="token_yxq" class="form-control" placeholder="token有效期">-->-->
<!--                            <select name="token_yxq" class="form-control" >-->
<!--                                <option value="7200">7200秒</option>-->
<!--                            </select>-->
<!--                        </div>-->
                    </div>
                    <div class="ct-m-r">
                        <img src="<?php echo UOOT;?>Public/uploads/common/account23.png">
                    </div>
                    <img src="<?php echo UOOT;?>Public/uploads/common/bzjt02.png" class="bzjt">
                </div>
            </div>
        </div>
        			<div class="footer-page">
                    <div class="col-sm-5"></div>
                    <div class="col-sm-4"> <button class="btn btn-primary btn-s-md"  type="submit">确定添加</button></div>
                </div>
                </div>
            </div>
        </div>
        </div>
        </form>
    </div>
</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
loadScorllJs();
$('.step').click(function(){
    $(this).addClass('select').siblings().removeClass('select');
    $('.win-item:eq('+$(this).index()+')').show().siblings().hide();
})
    $('.btn').click(function() {

        var num = $(this).attr('num');
        if (num!= 3) {
//        if (num == 2) {
//            var appid = $("input[name='appid']").val();
//            var appsecret = $("input[name='appsecret']").val();
//            var url = '<?php //echo UOOT . 'Plus/Kesion.ajax.php?act=getWxtoken';?>//';
//            $.ajax({
//                type: "post",
//                url: url,
//                data: {
//                    'appid': appid,
//                    'appsecret': appsecret
//                },
//                dataType: "json",
//                success: function (data) {
//                    if (data != -1) {
//                        //var obj = JSON.parse(data);
//                        //alert(obj.access_token);
//                        $("input[name='access_token']").val(data.access_token);
//                    }
//                }
//            });
//
//        }
    }else{
            $.ajax({
                url:"<?php  echo  M_URL('Wxmp','doclose')  ?>",
                type:"post",
                data:{},
                success:function(data){
                }

            })
        }
		
        $('.step:eq('+num+')').addClass('select').siblings().removeClass('select')
        $('.win-item:eq('+num+')').show().siblings().hide();
    })
</script>
<script>
function  do_reg(){

        $("#form").submit;
    }
radiotabs('status','.show-box');
$(function(){
	var index =<?php if(!empty($value)){echo $value['status'];} ?>;
//    alert(index);
	if(index==0) {
		 $('.val-0').show()
		  $('.val-1').hide()
		}else if(index==1){
			$('.val-1').show()
		  $('.val-0').hide()
			}
	})
         var n='';
         var arr='12345567890qwertyuioppasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM'
         for(i=0;i<43;i++){
            n+=arr.substr(Math.round(Math.random()*61),1);
        }
//alert(p

</script>arseInt(Math.random(0,61)*100));
$("input[name='encodingaeskey']").val(n);
</body>
</html>