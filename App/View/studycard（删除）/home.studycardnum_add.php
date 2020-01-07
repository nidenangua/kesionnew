
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
     <META HTTP-EQUIV="pragma" CONTENT="no-cache"> 
<META HTTP-EQUIV="Cache-Control" CONTENT="no-cache, must-revalidate"> 
<META HTTP-EQUIV="expires" CONTENT="0">

    <title>修改会员</title>

	<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
    <link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
    <link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css" rel="stylesheet">
    <link href="<?php echo UOOT;?>Public/app/css/laydate.css" rel="stylesheet">	
    <link href="<?php echo UOOT;?>Public/admin/css/awesome-bootstrap-checkbox.css" rel="stylesheet">
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
		.btn.btn-primary.btn-s-md{
			background:#476DBE;
			border:1px solid #476DBE;
		}
		.btn.btn-primary.btn-s-md:hover{
			background:#3879D9;
		}
		.btn.btn-s-md.btn-default:hover{
			background:#3879D9;
		}
    </style>

</head>
<body class="ks-wrap">
	<!--开始-->
	<div class="bRadius10 bg-white ks-wbox">
	<div class="generalTitle clearfix">
	    <span class="title-icon"><i class="iconfont icon-myorder">批量生成营销卡号</i></span>
        <span class="gTitle fsize18"></span>
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
		    <!--栏目块-->
	    </div>
		<div class="fr ks-top-search">
			<!--搜索-->

		</div>
	</div>	


<form target="hidframe"  method="post" id="myform" action="<?php {echo M_URL($this->AppName.'/Index','createCards','',GP(""));}?>"
      class="form-horizontal" enctype="multipart/form-data">
<div class="wrapper-content animated fadeInRight">
    <div class="row">
          <div class="tabs-container">
            <div class="tab-content">
              <div  class="tab-pane " style="display:block">
               <div class="panel-body ks-xBox">
                 <div class="row"  id="teacher">
                    <div >
                        <div class="ibox-content">
                        	<input type="hidden" name ="studycardid" value="<?php echo $studycardid;?>" />
	                       <div class="form-row">
		              		  <span class="name">学习卡名称</span>
		              		  <input type="text"  class="form-textbox" name="cardnum1" placeholder="字母">
		              		  <input type="text"  class="form-textbox" name="cardnum2" placeholder="生成位数,卡号在10到20位"> 

	                       </div>  	
		              	  
			              	  <div class="form-row">
			              		   <span class="name">营销卡号密码的位数：</span>
			                      <input type="num"  class="form-textbox" name="passwordnum" placeholder="密码在6到14位">
			                     
		                   	  </div>  
	              	  
          	                 <div class="form-row">
				              		<span class="name">开始时间</span>
				              	
				              		<input id="start" type="text"  name="startime"  class="w200  laydate-icon">

	                            </div>  	
	              	  
	              	          <div class="form-row">
				              		<span class="name">截止时间</span>
				              		<input id="end" type="text" name="endtime" class="w200  laydate-icon">
	              			
	                          </div>  	
	                          
		                       <div class="form-row">
			              		<span class="name">有效使用天数</span>
			              		<input type="number"  class="form-textbox" name="validity" >
			              			
			              	  </div>  	
			              	  
			              	  
			              	  <div class="form-row">
			              		<span class="name">生成数量</span>
			              		<input type="number"  class="form-textbox" name="num" id="num_card" >
			              			
			              	  </div>  	
	              	  

                            </div>
                        </div>
                    </div>
                 </div>
               </div>
    </div>

              <div class="mt10 ">
                 <div class="col-sm-2"></div>
                 <div class="col0sm-2 alignCenter">
                    <button type="button" onClick="do_reg()" class="btn btn-primary btn-s-md " >确认</button>
                    <a href="javascript:history.go(-1);" class="btn btn-s-md btn-default">取消</a>
                </div>
              </div>  </div>
</form>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script type="text/javascript" src="<?php echo UOOT;?>Public/common/js/layer/laydate.js"></script>


<script>

  loadScorllJs();
 function do_reg()
{   
	var cardnum1 = $("input[name='cardnum1']").val();
	var cardnum2 = $("input[name='cardnum2']").val();
	var passwordnum = $("input[name='passwordnum']").val();
	var validity = $("input[name='validity']").val();
	var num = $("input[name='num']").val();
    if(cardnum1==''){
		Alert('学习卡名称');
		return false;
    }
    if(cardnum2==''){
		Alert('学习卡名称');
		return false;
    }
	if(passwordnum==''){
		Alert('密码');
		return false;
    }
	if(validity==''){
		Alert('有效使用天数');
		return false;
    }
    if(num==''){
		Alert('张数');
		return false;
    }

    $("#myform").submit();
 }
 
 $("#num_card").keyup(function () {
                var reg = $(this).val().match(/^\d+(\.\d+)?$/);
                var txt = '';
                if (reg != null) {
                    txt = reg[0];
                }
                $(this).val(txt);
}).change(function () {
    $(this).keyup();
});
var start = {
  elem: '#start',
  format: 'YYYY/MM/DD hh:mm:ss',
  //min: laydate.now(), //设定最小日期为当前日期
  max: '2099-06-16 23:59:59', //最大日期
  istime: true,
  istoday: false,
  choose: function(datas){
     end.min = datas; //开始日选好后，重置结束日的最小日期
     end.start = datas //将结束日的初始值设定为开始日
  }
};
var end = {
  elem: '#end',
  format: 'YYYY/MM/DD hh:mm:ss',
  min: laydate.now(),
  max: '2099-06-16 23:59:59',
  istime: true,
  istoday: false,
 
};
laydate(start);
laydate(end);
</script>
</body>
</html>



