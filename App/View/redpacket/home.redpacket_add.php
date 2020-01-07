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
		<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/laydate.css" rel="stylesheet">	
   <script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>

  
</head>
<body class="ks-wrap">
	<!--开始-->

	<div id="ksBoxHead">
		<!--结束-->
		<div class="Header-tool  clearfix">
			<div class="Tool-Title">
			
	
			
			<!--标题-->
			<p>	<a href="javascript:history.go(-1);"><i class="iconfont icon-jiantou-copy"></i>我的红包</a><span>/</span><?php if(!empty($redPacket)){echo "修改红包";}else{echo "添加红包";} ?> </p>
			<!--标题-->
			
			</div>
			<!--操作范围-->

		
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
	
			
			<!--操作范围-->
		
		</div>

	
   </div>
   	
		
	<div class="bRadius10 bg-white mt20">
		<form target="hidframe"  method="post" id="myform"  action="<?php if(!empty($redPacket)){echo M_URL($this->AppName.'/Index','doEditRedpacket',$id,GP('p-'.$now_page));}
		       else{echo M_URL($this->AppName.'/Index','doAddRedpacket','',GP(""));} ?>"
		      enctype="multipart/form-data">
				
				<div id="ksBoxContent">
		
		              	<div class="form-box form-upload-box">
		              		                   
                            <div class="form-row">
			              		<span class="name"><i class="required">*</i>红包名称</span>
			              		<div class="form-limit" limit="50">
			              			<input type="text" class="form-textbox" name="redpacket" value="<?php if(!empty($redPacket)) echo $redPacket['redpacket'] ?>" />
			              		</div>
		              		
		              	    </div>
	              	    	              	
			              	<div class="form-row">
			              		<span class="name">使用开始时间</span>
		                        <input id="start" type="text"  name="startime"  class="w200  laydate-icon" value="<?php if(!empty($redPacket)){echo  date("Y-m-d",$redPacket['endtime']);} ?>">	
			
			              	</div>
	              	
			               <div class="form-row">
			              		<span class="name">使用结束时间</span>
		                        <input id="end"  type="text"  name="endtime"  class="w200  laydate-icon"  value="<?php if(!empty($redPacket)){echo  date("Y-m-d",$redPacket['endtime']);} ?>">	
			              	</div> 
	              	
		                    <div class="form-row">
			              		<span class="name">红包描述</span>
		                        <textarea type="text"  class="form-textbox " name="desc"><?php if(!empty($redPacket)){echo $redPacket['desc'];}?></textarea>
			              	</div>   
	              	
                        	<div class="form-row">
		              		    <span class="name">最小订单金额</span>
		              		    <input type="text"  class="form-textbox" id="minamount" name="minamount" placeholder="*只有商品总金额达到这个数的订单才能使用这种优惠券，请不要设置小于优惠券面值。"  value="<?php if(!empty($redPacket)){echo $redPacket['minamount'];} ?>">	              			 
		              	     </div>  	
	              	  
	              	  
			              	  <div class="form-row">
			              		   <span class="name">面值</span>
			              		  <input type="text"  class="form-textbox" name="facevalue" id="facevalue"  placeholder="*可以抵销的最大金额,一旦设定建议不要再修改。"  value="<?php if(!empty($redPacket)){echo $redPacket['facevalue'];} ?>" >
		                  	  </div>  
	              	  
	              	  
	              	          <div class="form-upload">
			              		<div class="js_uploadBox">
			              			<div class="js_showBox bRadiusn"><img class="js_logoBox block pic" src="<?php if(!empty($cardInfo)){echo Img($cardInfo['pic']);}else{ echo nopic(1);} ?>"></div>
					                <div class="btn-upload clearfix">
					                    <a href="javascript:void(0);" onclick="addTypeChange('<?php echo M_URL('Index','imageslist','',GP('name-pic,type-top',true));?>','930px','610px',{title:'选择图片',type:'top'});" class="selectImageBtn"><span class="js_uploadText">选择图片</span></a>
					                    <p>限制：2MB,支持jpg|png|gif</p> 
					                     <input  type="hidden" name="pic">
					               </div> 
							    </div>
              	              </div>
	              	  
                            
			                    <div class="form-row  clearfix">
				              		 <span class="name">使用范围</span>
			                         <label for="inlineRadio9"><input type="radio" id="inlineRadio9" class="radioInput" value="0" name="scope" <?php  if(!empty($redPacket)){if($redPacket['scope']==0) echo "checked";}?> checked>不限制</label>
								     <label for="inlineRadio7"><input type="radio" id="inlineRadio7" class="radioInput"  value="1" name="scope" <?php  if(!empty($redPacket)){if($redPacket['scope']==1) echo "checked";}?>> 网授课程订单 </label>
								     <label for="inlineRadio6"><input type="radio" id="inlineRadio6" class="radioInput"  value="2" name="scope"  <?php  if(!empty($redPacket)){if($redPacket['scope']==2) echo "checked";}?>> 面授课程订单 </label>
			                 	</div>
                            
                            
	                             <div class="form-row">
			                          <span class="name">项目状态</span>
			                            <div class="form-switch" open-value="0">
			                                     <label for="inlineRadio8"><input type="radio" id="inlineRadio8" value="0" name="status" checked="checked" <?php  if(!empty($redPacket)){if($redPacket['putway']==0) echo "checked";}?> >
			                                     	checked> 正常</label>
			                                    <label for="inlineRadio5"><input type="radio" id="inlineRadio5" value="1" name="status" <?php  if(!empty($redPacket)){if($redPacket['putway']==1) echo "checked";}?> >
			                                    	停用</label>
			                                
			                            </div>
	                              </div>                
		              </div>            
		                  
		        </div>
        </form>
        
	</div>
		
   <div id="ksBoxFooter" style="height: 80px;">
		<div class="ks-bom" style="text-align: center;">
			<span  style="display: inline-block;">
				<button onClick="do_reg()" class="ks-bt bt-pue mr5">确认</button>
				<button onclick="javascript:history.go(-1);" class="ks-bt bt-def">取消</button>
			</span>
		</div>
	</div> 

<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script type="text/javascript" src="<?php echo UOOT;?>Public/common/js/layer/laydate.js"></script>
<script>

 
 function do_reg() {
    var redpacketname = $("input[name='redpacket']").val();
    var desc = $("textarea[name='desc']").val();
    var facevalue = $("input[name='facevalue']").val();
     var minamount = $("input[name='minamount']").val();
     var reg  = /^(([1-9][0-9]*)|(([0]\.\d{1,2}|[1-9][0-9]*\.\d{1,2})))$/;
     facevalue =reg.test(facevalue);
     minamount =reg.test(minamount);
    if(!facevalue)
     {
         Alert('面值为金额');
         return false;
     }
    if(!minamount)
    {
        Alert('最小订单金额');
        return false;
    }
     if(redpacketname==''){
         Alert('红包不能为空');
         return false;
     }
     if(desc==''){
         Alert('红包描述不能为空');
         return false;
     }
    $("#myform").submit();
 }
 
 $("#minamount").keyup(function () {
                var reg = $(this).val().match(/\d+\.?\d{0,2}/);
                var txt = '';
                if (reg != null) {
                    txt = reg[0];
                }
                $(this).val(txt);
            }).change(function () {
                $(this).keyup();
            });
            
$("#facevalue").keyup(function () {
                var reg = $(this).val().match(/\d+\.?\d{0,2}/);
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
  //min: laydate.now(),
  max: '2099-06-16 23:59:59',
  istime: true,
  istoday: false,
 
};
laydate(start);
laydate(end);
 
</script>

</body>
</html>

