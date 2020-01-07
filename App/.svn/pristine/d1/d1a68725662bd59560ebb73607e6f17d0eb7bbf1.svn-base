<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="renderer" content="webkit">
    <title>kesion教育平台</title>
    <meta name="Keywords" content="kesion教育平台" />
    <meta name="Description" content="kesion教育平台" />
    <link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
    <link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
    <link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
    <link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
    <style>
        .share-box-title {
            font-weight: normal;
            line-height: 24px;
            font-size: 18px;
            color: #303133;
            text-align: center;
        }

        .tab-box .tab-box-download {
            text-align: left;
            position: relative;
        }

        .tab-box .tab-box-qrcode {
            position: relative;
        }

        .tab-box .tab-box-content,
        .tab-box-qrcode img {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%,-50%);
        }

        .tab-box .tab-box-content-save {
            color: #686a6c;
            font-size: 12px;
        }

        .tab-box .tab-box-content-link {
            color: #e64a3b;
            text-decoration: underline;
        }
    </style>
</head>

<body>

<div class="share-box mt20">
    <h3 class="share-box-title">二维码签到</h3>
    <div class="tab-box">
        <div class="code fl tab-box-qrcode">
            <img src="<?php echo UOOT.'Images/QRcode/'.createQRcode(ROOT.'Images/QRcode/',wx_Url($this->wxid).'/#/course/'.$this->courseid.'/facesign','L',4,'weimenhu');?>" />
        </div>
        <div class="code fr tab-box-download">
            <div class="tab-box-content">
                <p class="tab-box-content-save">用于线下扫码签到 , 右键保存图片</p>
                <a class="tab-box-content-link"
                   href="<?php echo UOOT.'Images/QRcode/'.createQRcode(ROOT.'Images/QRcode/',wx_Url($this->wxid).'/#/course/'.$this->courseid.'/facesign','L',4,'weimenhu');?>"
                   download="<?php echo UOOT.'Images/QRcode/'.createQRcode(ROOT.'Images/QRcode/',wx_Url($this->wxid).'/#/course/'.$this->courseid.'/facesign','L',4,'weimenhu');?>">点击下载可打印大图</a>
            </div>
        </div>
    </div>
</div>
<input type="text" style="height:0px;border:0px;" id="url2" value="http://t.cn/AiTMpmNs" />
<script src="//ks.zuojy.com/Public/common/js/module.js?2018113115421"></script>
<script>
    module.require(['$', 'backstage'], function () {

    })
</script>
</body>

</html>