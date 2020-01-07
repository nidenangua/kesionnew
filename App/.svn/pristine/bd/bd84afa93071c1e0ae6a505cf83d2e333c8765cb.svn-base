<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />

<style type="text/css">
	.Porel{ position: relative;}
	.Poabs{ position: absolute;}
	.Pofix{ position: fixed;}
	.ToPr1812{top: -17px; right: -12px;opacity: 0; transition: all 0.6s;color: black;}
	#knowledge li{ padding:10px 15px  2px 0px; float: left;}
	#knowledge li :hover .ToPr1812{ opacity: 1;}
	.topCourseBox { padding: 20px 320px 20px 200px;position: relative; background: #FFFFFF;}   
	.topCourseBox-right{position: absolute;height: 120px; top: 20px; right: 0px;}
	.topCourseBox-bottom{position: absolute;height: 30px; bottom: 20px; right: 0px; line-height: 30px; width: 420px;}
	.topCourseBox-img{width: 190px; height: 130px; position: absolute; left: 0; top: 20px; cursor:pointer;}   
	.Tabcrow{ width: 600px;}  
	.topCourseCont{ position: relative; padding-left: 240px;}   
	.topCourseCont-left{position: absolute;  left: 20px; top: 0px; height:100%;}  
	.topCourseCont-right{ height:130px; overflow: auto; position:relative ; left:150px;} 
	.hos > a:hover{color: #409eff!important;}
</style>

<?php if(isset($course)){ ?>
	
<div class="ks-wbox bRadius10">
	<div class="ks-head-nav bd_e">
		<!--标题-->
			<a href="<?php echo M_URL('course/Index','index','',GP('')); ?>"><?php if($course["courseType"]==1){echo '点播';}elseif($course["courseType"]==2){echo '直播';}elseif($course["courseType"]==3){echo '面授';}elseif($course["courseType"]==4){echo '混合';}  ?>课程</a><span><em>/</em>修改课程</span>
		<!--标题-->
	</div>

	
	<div class="topCourseBox  clearfix bRadius10">
		<div class="topCourseBox-img" onclick="addTypeChange('<?php echo M_URL('Index','imageslist','',GP('name-defaultpic,type-top,courseid-'.$courseid));?>','930px','610px',{title:'选择图片',type:'top'});">
			<img onerror="this.src='<?php echo nopic();?>'" src="<?php if($course["defaultpic"]!=''){echo Img($course["defaultpic"]);}else{echo '/Public/uploads/common/nopic.gif';} ?>" class="defaultpic" width="100%" height="100%">	
		</div>
		<?php if(ACTION !='basics' ){ ?>
			<input type="hidden" name="defaultpic">
		<?php } ?>	
	
		<div  class="topCourseCont">
			<div class="topCourseCont-left">
				<div class="clearfix"><span class="fl fsize16 c-333 hLh30"><?php echo $course['title']; ?></span></div>
				<div class="mt10"><span class="fsize14 c-92">课时：<?php echo $this->keshiCount ?>学时</span><span class="fsize14 c-92 ml20">学员：<?php echo $this->studentCount ?>个</span></div>
				 
				<div class="mt10">
				<span class="name-nowrap fl hLh40 fsize16">是否上架</span>
				<div class="form-switch fl mt5 ml20 shen" open-value="2">
					<label for="status2">
						<input type="radio" id="status2" name="shenghe" class="shenghe" value="0" <?php if($course["status"]==0) echo "checked";?>>取消审核
					</label>
					
					<label for="status1">
						<input type="radio" id="status1" name="shenghe" class="shenghe" value="2" <?php if($course["status"]==1||$course["status"]==2) echo "checked";?>>通过审核
					</label>
				</div>
				
				
				</div>
				
				</div>
			
			<div  class="topCourseCont-right">    
				<div class="clearfix hos"><a href="javascript:void(0)" onclick="addCourseKpoint('<?php echo M_URL($this->AppName.'/Index','addKpoint',$courseid,GP('')) ?>',{title:'课程标签/知识点',type:'top'})" class="ks-bt c-fff  bg-2d" id="addStudent"><i class="iconfont icon-jiahao"></i>课程标签/知识点</a></div>			
				<div class="clearfix"><ul  id="knowledge"></ul ></div>
			</div >
		</div>
	 
         
	  
		<div class="topCourseBox-bottom">
			<input type="checkbox" class="fl" id="recommend"   <?php if($course["recommend"]==1)echo "checked"; ?> />
			<label class="fl <?php if($course["recommend"]==1)echo "label-on"; ?>"  >是否推荐</label>
			
			<input type="checkbox" class="fl" id="slide" name="slide" <?php if($course["slide"]==1)echo "checked"; ?>  />
			<label class="fl" >是否幻灯展示</label>
			
			<input type="checkbox" class="fl" id="iscommon" <?php if($course["iscommon"]==1)echo "checked"; ?> />
			<label class="fl ">允许评价</label>
			
			<input type="checkbox" class="fl" id="hot" <?php if($course["hot"]==1)echo "checked"; ?> />
			<label class="fl ">是否热门</label>
			
		</div>
	   
	   
	</div>
</div>

<?php }?>
<script src="<?php echo UOOT;?>Public/common/js/jquery.cookie.js" type="text/javascript"></script> 	
<script>
$(".shenghe").click(function(){
	var status = $(this).val();	
	$.ajax({
        type: "POST",
        url:"<?php echo M_URL($this->AppName.'/Ajax','audited',$this->courseid,GP('')) ?>",
        data:{status:status},
        success:function(text){
        if(text == 0){
           /*alert("取消审核成功");*/
          location.reload();
        }else if(text == 2){
            /*alert("审核成功");*/
           location.reload();
        }},
     	error:function(){
        /* alert("发生了错误,请检查!");*/
         } 
      });
     
})
$("#recommend").click(function(){
	
	if($('#recommend').is(':checked')){
    	var recommend = 1;
    }else{
    	var recommend = 0;
    }
	$.ajax({
        type: "POST",
        url:"<?php echo M_URL($this->AppName.'/Ajax','recommend',$this->courseid,GP('')) ?>",
        data:{recommend:recommend},
        success:function(text){
        },
     	error:function(){
        /* alert("发生了错误,请检查!");*/
         } 
      });
     

      
})

function changeStatus(status){
	
	$.ajax({
        type: "POST",
        url:"<?php echo M_URL($this->AppName.'/Ajax','changeStatus',$this->courseid,GP('')) ?>",
        data:{status:status},
        success:function(text){
              if(status==1){
              	$('#cstatus').html('<div id="status1" onclick="changeStatus(2)">未上架</div>	');
              console.log($('#cstatus').html())
              }else{
              	$('#cstatus').html('<div id="status2" onclick="changeStatus(1)">已上架</div>	');
             console.log($('#cstatus').html())
              }
              
        },
     	error:function(){
        /* alert("发生了错误,请检查!");*/
         } 
      });
	
	
	
}







$("#recommend").click(function(){
	
	if($('#recommend').is(':checked')){
    	var recommend = 1;
    }else{
    	var recommend = 0;
    }
	$.ajax({
        type: "POST",
        url:"<?php echo M_URL($this->AppName.'/Ajax','recommend',$this->courseid,GP('')) ?>",
        data:{recommend:recommend},
        success:function(text){
        },
     	error:function(){
        /* alert("发生了错误,请检查!");*/
         } 
      });
     

      
})


$("#slide").click(function(){

    if($('#slide').is(':checked')){
    	var slide = 1;
    }else{
    	var slide = 0;
    }
	$.ajax({
        type: "POST",
        url:"<?php echo M_URL($this->AppName.'/Ajax','slide',$this->courseid,GP('')) ?>",
        data:{slide:slide},
        success:function(text){
        },
     	error:function(){
        /* alert("发生了错误,请检查!");*/
         } 
      });
     

      
})


$("#hot").click(function(){

	if($('#hot').is(':checked')){
    	var hot = 1;
    }else{
    	var hot = 0;
    }
	$.ajax({
        type: "POST",
        url:"<?php echo M_URL($this->AppName.'/Ajax','isCourseHot',$this->courseid,GP('')) ?>",
        data:{hot:hot},
        success:function(text){
        },
     	error:function(){
         } 
     });     
})






$("#iscommon").click(function(){
	
	if($('#iscommon').is(':checked')){
    	var iscommon = 1;
    }else{
    	var iscommon = 0;
    }
	$.ajax({
        type: "POST",
        url:"<?php echo M_URL($this->AppName.'/Ajax','iscommon',$this->courseid,GP('')) ?>",
        data:{iscommon:iscommon},
        success:function(text){
        },
     	error:function(){
         } 
     });     
})


function addCourseKpoint(url){

	$.cookie('addKption<?php echo $this->courseid; ?>','',{ expires: -1 });
    addTypeChange(url,'800px','600px')

};
function delKption(id){

	var a = '<?php echo $course['kpoint'] ?>';
	  $.ajax({
			type:"POST",
			url:"<?php echo UOOT; ?>Plus/Kesion.ajax.php?act=delkption",
			data:{kption:a,courseid:<?php echo $this->courseid; ?>,kpointid:id},
			success:function(text){
				if(text == 'ok'){
				 $("#kption"+id).remove();
				}
			},
			error:function(){
				alert("发生了错误,请检查!");
			}
	 }); 
	
}	
<?php if($course['kpoint']!=''){ ?>
	  var kption = '<?php echo $course['kpoint']; ?>';
	
         $('.chapterKption').remove();
	  $.ajax({
			type:"POST",
			url:"<?php echo UOOT; ?>Plus/Kesion.ajax.php?act=getkption",
			data:{kption:kption},
			success:function(text){
				parent.closePopup('all');
		       	$('#knowledge').append(text);
		       	colorRadom();
			},
			error:function(){
				alert("发生了错误,请检查!");
			}
	 }); 
	 
	
<?php } ?>	
function colorRadom(){
	

$("#knowledge li").each(function(){
	//颜色字符串  
	var colorStr="";  
	//字符串的每一字符的范围  
	var randomArr=['188eee','118fd1','FFA500','FF3E96','FF4040','44B549','FF4040','2db7f5','44B549','FF4040']; 
	//产生一个六位的字符串 
	var num = Math.ceil(Math.random()*9);
 	colorStr=randomArr[num];
 	console.log(num);
	
	$(this).find(".ks-bt").css({
		"background":"#fdf6ec",
		"border": "1px solid #e6a23c",
		"color":"#e6a23c" 
	})
	
	
})
}
  //班级类型
$('input[type=checkbox]').click(function(){
	var state = $(this).prop('checked');

	if(state==false){

		$(this).next('label').removeClass('label-on');
	}
	if(state==true){

		$(this).next('label').addClass('label-on');
	}
})
	
</script>	
	
