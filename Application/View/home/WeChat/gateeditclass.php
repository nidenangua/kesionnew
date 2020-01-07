<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    <title>编辑班级</title>
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/home.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/setgate.css" rel="stylesheet">
    <style>
      
      .edit-box {
          position:relative;
          height:3rem;
          line-height:3rem;
          padding-left:4rem;
          border-bottom:1px solid #dcdfe6
      }
      .edit-title {
          position: absolute;
          left: 0;
          color:#888;
         
      }
      .edit-select,.eding-title {
          border:0;
          color:#888;
          height:3rem!important
      }
      .edit-select {
          direction: rtl;
          padding-right:1.5rem
      }
      .cover-wrap .cover-img {
          height:2rem;
          width:3rem;
          position: absolute;
          right: 0;
          top:0.25rem
      }
      .cover-wrap .cover-btn-wrap .cover-btn {
          border:0;
          width:100%;
          top:0;
          height:3rem;
          z-index:99
      }
      .bottomset {
          width:95%;
          left:2.5%;
          bottom:0.5rem;
          
      }
      .bottomset .item {
          background: #37a7ed;
          border-radius:0.2rem
      }
      .eding-title:focus {
          border:0;
          
      }
      .cover-wrap .cover-btn-wrap {
          overflow: initial;        
      }
      .eding-title {
          text-align:right;
      }
      #selectfiles {
        position: absolute;
        width: 100%;
        height: 100%;
        left: 0;
        top: 0;
        z-index: 1;
    }
     .number1 {
    	position: absolute;
    	right: 0;
    	top: 0;
    	font-size: 0.7rem;
    	color:#888
    }
    input[type="file"] {
        z-index: 2;
    }
  </style>
    <script>
        var uoot = '<?php echo UOOT ?>';	
        var __wxid = '<?php echo $this->wxid; ?>'
    </script> 	
</head>
<body style="background:#fff">
	<div id="loadings" style="display: block;"></div>
</body>

	<script src="<?php echo UOOT ?>Public/wechat/js/microportal/zepto.js"></script>
	<script src="<?php echo UOOT ?>Public/wechat/js/microportal/current.js"></script>
    <script src="<?php echo UOOT ?>Public/wechat/js/setclassgate.js?201896"></script> 
    <script src="https://store.kesion.com/Public/common/js/aliyun/alioss/lib/plupload-2.1.2/js/plupload.full.min.js"></script>
    <script src="https://store.kesion.com/Public/common/js/aliyun/alioss/upload.js?2018821"></script>
</html>