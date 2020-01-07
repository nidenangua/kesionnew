<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="renderer" content="webkit">
	<title><?php if(!empty($cardInfo)){echo "修改学习卡";}else{echo "添加学习卡";} ?></title>
	<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css" rel="stylesheet">
	<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/laydate.css" rel="stylesheet">	
   <script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>

    <style>
      	.re-btn{position:absolute;right:65px;top:-8px}
		.a-upload{padding:4px 10px;height:32px;line-height:20px;position:relative;cursor:pointer;color:#888;background:#fafafa;border:1px solid #ddd;border-radius:4px;overflow:hidden;display:inline-block}
		#fly{display:none}
		#category{display:none}
		.a-upload input{position:absolute;font-size:100px;right:0;top:0;opacity:0;filter:alpha(opacity=0);cursor:pointer}
		.a-upload:hover{color:#444;background:#eee;border-color:#ccc;text-decoration:none}
		.selectImageBtn{width:90px;height:35px;line-height:35px;text-align:center;background:#f5f8f9;cursor:pointer;border:1px solid #e6e9ea;display:inline-block}
		.mt10{margin-left:10px}
		.modal-dialog{z-index:2050!important}
		.mt7{margin-top:7px}
		.mr20{margin-right:20px}
		.mt20{margin-top:10px}
		.tab-pane{display:none}
		.Abox{display: block; width: 320px; height: 100px; margin-left: 100px;}
		.Aselect{ height: 100%; width: 100%;}
    </style>

</head>
<body class="ks-wrap">
	<!--开始-->
	<div class="bRadius10 ks-wbox">
		<div id="ksBoxHead">
			<div class="generalTitle">
			    <span class="title-icon"><i class="iconfont icon-myorder"></i></span>
		        <span class="gTitle fsize18">批量生成红包</span>
			    <div class="fr">
			    	<!--按钮块--->
					<a class="ks-bt bt-def mr10"href="javascript:history.go(-1);"><i class="icon-fanhui iconfont"></i>返回</a>
					<a href="javascript:void(0)" onclick="history.go(0)" class="ks-bt bt-def"><i class="icon iconfont">&#xe6aa</i>刷新</a>
					<!--按钮块--->
			    </div>
			</div>
			
			<div class="clearfix ks-top-tab">
				<div class="fl">
					<!--栏目块-->
					<ul>
				      	<li class="fl curr"><a href="javascr::">基本信息</a></li>
				    </ul>
				    <!--栏目块-->
			    </div>
				<div class="fr ks-top-search">
					<!--搜索-->
		
				</div>
			</div>	
		</div>
		<form target="hidframe"  method="post" id="myform"  action="<?php {echo M_URL($this->AppName.'/Index','createCards','',GP(""));} ?>"  enctype="multipart/form-data">
				
				<div id="ksBoxContent">
                 	<div class="form-box form-upload-box">
                     	    <input type="hidden" name="redpacketid" value="<?php echo $redpacketid ?>">
	                       <div class="form-row">
			              		<span class="name"><i class="required">*</i>红包卡号</span>
                                <input type="text" class="form-textbox" name="cardnum1" placeholder="填字母"/>
			              	     <input type="text" class="form-textbox" name="cardnum2" placeholder="数字大于10小于20"/>              		
		              	   </div>
		              	            
                            <div class="form-row">
	                        <span class="name">使用情况</span>
                                <div class="form-switch" open-value="0">
	                             <label for="isuse0"><input type="radio" value="0" name="isuse" checked>未使用</label>
	                            <label for="isuse1"><input type="radio" value="1" name="isuse" >已使用</label>
                               </div>
                             </div>

                             <div class="form-row">
	                          <span class="name">发放情况</span>
	                            <div class="form-switch" open-value="0">
	                                <label for="isgive0"><input type="radio"  value="0" name="isgive"  checked> 未发放</label>
	                                <label for="isgive1"><input type="radio" value="1" name="isgive" >已发放</label>
                                </div>
	                         </div>       
                         
		              </div>            
		                  
		        </div>
        </form>
</div>
		
        <div id="ksBoxFooter">
        	<div class="form-footer">
        		<span class="d-inline-block">
	            	<button onClick="do_reg()" class="ks-bt bt-pue">确认</button>
	           		<button onclick="javascript:history.go(-1);" class="ks-bt bt-def">取消</button>
           	    </span>
        	</div>
        </div>


<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
   
      loadScorllJs();
     function do_reg()
    {
    
      	var cardnum1 = $("input[name='cardnum1']").val();
      	var cardnum2 = $("input[name='cardnum2']").val();

      
      
          if(cardnum1==''){
      		Alert('学习卡名称');
      		return false;
          }
      	if(cardnum1==''){
      		Alert('学习卡名称');
      		return false;
          }

         $("#myform").submit();	
     }
</script>
</body>
</html>