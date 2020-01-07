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
	<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
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
			<p>	<a href="javascript:history.go(-1);"><i class="iconfont icon-jiantou-copy"></i>学习卡管理应用</a><span>/</span><?php if(!empty($cardInfo)){echo "修改学习卡";}else{echo "添加学习卡";} ?> </p>
			<!--标题-->
			
			</div>
			
			<!--按钮组件-->
			<div class="Tool-btnGroup">
				
				 <span class="ks-bt bt-def" onClick="appSetUp({title:'应用设置',type:'app',appid:<?php echo $this->appid; ?>,wxid:<?php echo $this->wxid; ?>})"><i class="iconfont icon-setting"></i>学习卡配置</span>
			</div>
				
			<!--按钮组件-->
			<!--操作范围-->


			
			
			
			<!--操作范围-->
		
		</div>

	
  		 </div>
      
      
      
      <form target="hidframe"  method="post" id="myform"  action="<?php if(!empty($cardInfo)){echo M_URL($this->AppName.'/Index','doEditStudycard',$id,GP(''));}
       else{echo M_URL($this->AppName.'/Index','doAddStudycard','',GP(""));} ?>"
      enctype="multipart/form-data">
		<div class="bRadius10 bg-white mt20">	
			<div id="ksBoxContent">

              	<div class="form-box form-upload-box">

                   <div class="form-row">
              		  <span class="name">学习卡名称</span>
              		  <div class="form-limit" limit="50">
              		  <input type="text" class="form-textbox" name="cardname" value="<?php if(!empty($cardInfo)) echo $cardInfo['cardname'] ?>" >
              		  </div>
                   </div>  	
          	  
              	  <div class="form-row">
              		   <span class="name">介绍</span>
              		   <div class="form-limit" limit="255">
                       <textarea name="intro" rows="3" class="form-textarea"  placeholder="请输入内容"><?php if(!empty($cardInfo)){echo $cardInfo['intro'];}?></textarea>	
                      </div>
               	  </div>  
          	  

                    <div class="form-row clearfix">
                     	<span class="name">权限设置</span>
	                    <div class="clearfix fl" style="500px">
	                        <label><input name="limit" class="slect-in" type="radio" value="0"  <?php if(isset($cardInfo))if($cardInfo['limit']== 0){echo "checked";} ?>/>拥有所有权限</label>
	                        <label><input name="limit" class="slect-in" type="radio" value="2" <?php if(isset($cardInfo))if($cardInfo['limit']== 2){echo "checked";} ?>/>限制购买以下在线课程才可使用</label>
	                        <label><input name="limit" class="slect-in" type="radio" value="3" <?php if(isset($cardInfo))if($cardInfo['limit']== 3){echo "checked";} ?>/>按在线课程分类限制</label>
	                    </div>
                		
                		<div class="fl sec-2 Abox" id="fly">
                           <select multiple=“multiple” class="Aselect" name="courseid[]">
                              <?php foreach($course as $k=>$v){ ?>
                                <option  value="<?php echo $v['courseid']?>" <?php if(isset($cardInfo))if($cardInfo['courseid']==$v['courseid']){echo "selected";} ?>><?php echo $v['title']?></option>
                              <?php }?>
                           </select>
                        </div>
                        
              
                        <div class="Abox sec-3 fl"  id="category">
                            <select name="categoryid[]"  class="Aselect"  multiple=“multiple”>
                                <?php
                                $html = '<option value="0">无--作为一级分类</option>';
                                foreach($category as $k=>$v)
                                {
                                    if(!isset($category))
                                    {
                                        $html .= '<option value="'.$v['categoryid'].'">'.KS_INDENT($v['depth']).$v['categoryname'].'</option>';
                                    }else{
                                        $html .= '<option value="'.$v['categoryid'].'"';
                                        if(isset($cardInfo) && $cardInfo['categoryid']==$v['categoryid'])
                                        {
                                            $html .= 'selected="selected"';
                                        }
                                        $html .= ' >'.KS_INDENT($v['depth']).$v['categoryname'].'</option>';
                                    }
                                }
                                echo $html;
                                ?>
                            </select>
                        </div>
                    </div>
                		<div class="form-row">
		              		<span class="name">面值</span>
		              		<input type="text" id="left_price" class="form-textbox" name="facevalue" value="<?php if(!empty($cardInfo)){echo $cardInfo['facevalue'];} ?>" >
		              			
		              	</div>  	
	              	  
	              	  
          	           <div class="form-row">
		              		<span class="name">激活截止时间</span>
                           <input id="start" type="text"  name="deadline"  class="w200  laydate-icon" value="<?php if(!empty($cardInfo)){echo  date("Y-m-d",$cardInfo['deadline']);} ?>">	
                        </div>  	
              	  
          	            <div class="form-row">
		              		<span class="name">有效使用天数</span>
		              		<input type="number"  class="form-textbox" name="validity" value="<?php if(!empty($cardInfo)){ echo $cardInfo['validity'];} ?>">
          			
                        </div>  	
                           
                        <div class="form-row">
                          	<span class="name">发放方式</span>
                            <label for="inlineRadio8"><input type="radio" id="inlineRadio8" value="0" name="putway" checked="checked" <?php  if(!empty($cardInfo)){if($cardInfo['putway']==0) echo "checked";}?> >线下</label>
                            <label for="inlineRadio5"><input type="radio" id="inlineRadio5" value="1" name="putway" <?php  if(!empty($cardInfo)){if($cardInfo['putway']==1) echo "checked";}?> >线上</label>
                                
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
              	       
              	       
              	        <!--<div class="form-upload">
	              		<div class="js_uploadBox">
	              			<div class="js_showBox bRadiusn"><img class="js_logoBox block" id="defaultpic" src="<?php if(!empty($course["defaultpic"])){echo $course["defaultpic"];}else{ echo "/Public/uploads/common/timg.jpg" ;} ?>" ></div>
			                <div class="btn-upload clearfix">
			                    <a href="javascript:void(0);"  onclick="addTypeChange('<?php echo M_URL('Index','imageslist','',GP('name-defaultpic'));?>','930px','610px',{title:'选择图片'});"   class="selectImageBtn"><span class="js_uploadText" >上传图片</span></a>
			                    <p>限制：2MB,支持jpg|png|gif</p> 
			                     <input type="hidden" name="defaultpic">
			               </div>
					              
					    </div>-->
              	       
              	       
              	       
              	       
              	       
              	       
                      	     
                </div>            
                  
        </div>
		</div>
    
       <div id="ksBoxFooter" style="height: 80px">
        	<div class="form-footer">
        		<span class="d-inline-block">
	            	<button onClick="do_reg()" class="ks-bt bt-pue">确认</button>
	           		<button onclick="javascript:history.go(-1);" class="ks-bt bt-def">取消</button>
           	</span>
        	</div>
        </div>   
		</form>



<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script type="text/javascript" src="<?php echo UOOT;?>Public/common/js/layer/laydate.js"></script>
<script>

 function do_reg()
{   
	
	var cardname = $("input[name='cardname']").val();
	var intro = $("input[name='intro']").val();
	var validity = $("input[name='validity']").val();
	var facevalue = $("input[name='facevalue']").val();
    if(cardname==''){
		Alert('学习卡名称');
		return false;
    }
	if(intro==''){
		Alert('学习卡介绍');
		return false;
    }
	if(validity==''){
		Alert('有效使用天数');
		return false;
    }
    if(facevalue==''){
		Alert('请输入面值');
		return false;
    }
    $("#myform").submit();
 }
 
 
  $(function(){
     var zhi2= '<?php if(empty($cardInfo['limit'])){echo 0;}else{echo $cardInfo['limit'];}?>';
     $(".sec-"+zhi2).show();
     $(".slect-in").click(function(){
         var zhi = $(this).val();
         $(".sec-2").hide();
         $(".sec-3").hide();
         $(".sec-"+zhi).show();
     })
 });
 
 $("#left_price").keyup(function () {
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

laydate(start);
</script>

</body>
</html>
