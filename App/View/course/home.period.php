<style>
	/*选择课时结构*/
	.ksSelect li{width:33.3%;float:left; text-align: center;}
	.ksSelect .talk-in{padding: 40px; float:none; display: block; }
	.ksSelect li img{display: block;margin:0 auto; margin-bottom: 10px;}
	.ksSelect li span{display: inline-block;}
	/*课时管理*/
	
	.courseKeshi{padding:0 30px}
	.courseKeshi .name{line-height:24px;margin-top:15px;padding:8px 20px;color:#929292;font-size:14px;border:1px solid #e1e1e1;-webkit-transition:.3s;transition:.3s;background:#fff;position:relative}
	.courseKeshi .name .unfold{width:19px;height:19px;background:url(../images/unfold.png) no-repeat;position:absolute;left:-30px;top:50%;margin-top:-10px;border-radius:50%;font-size:12px;text-align:center}
	.courseKeshi .name .pack-up{background:url(../images/pack-up.png) no-repeat}
	.courseKeshi .try{padding: 0 5px;height: 20px;line-height: 20px; background: #40d08d;font-size:12px;border-radius: 4px; display:inline-block; color:#fff;}
	.courseKeshi .r-icon{float:right;position:relative;padding-left:20px;color:#707070}
	.courseKeshi .r-icon:before{content:'';width:1px;height:100%;position:absolute;left:0;top:-10px;padding:10px 0;background:#e1e1e1}
	.courseKeshi .r-icon span{padding:0 20px;position:relative}
	.courseKeshi .r-icon span em{width:40px;height:22px;line-height:22px;text-align:center;color:#fff;position:absolute;top:-30px;left:50%;margin-left:-20px;background:#1a1a1a;border-radius:3px;font-size:12px;display:none}
	.courseKeshi .r-icon span .arrow-down{width:8px;height:4px;position:absolute;left:50%;margin-left:-4px;bottom:-4px;background:url(../images/arrow-down.png) no-repeat}
	.courseKeshi .r-icon span .iconfont{cursor:pointer}
	.courseKeshi .r-icon span .iconfont:hover{color:#32bf71}
	.courseKeshi .r-icon span .icon-bianji,.courseKeshi .r-icon span .icon-lajitong{font-weight:700}
	.courseKeshi .r-icon span .on{color:#32bf71}
	.courseKeshi .name:hover{background:#f3f3f3}
	.courseKeshi .section{margin-left:20px}
	.courseKeshi .keshi{margin-left:40px}
	.courseKeshi .inner{position:relative}
	.courseKeshi .inner-keshi{margin-left:60px}
	.courseKeshi .inner:before{content:'';width:1px;height:100%;position:absolute;top:-15px;padding:15px 0;background:#e1e1e1;left:60px}
	.courseKeshi .addBox-style{width:150px;position:absolute;z-index:99;background:#fff;top:25px;left:0;border-radius:5px;box-shadow:0 3px 12px rgba(0,0,0,.2);border:1px solid #e1e1e1;display:none;overflow:hidden}
	.courseKeshi .addBox-style .btn{height:40px;line-height:40px;padding:0 20px;cursor:pointer}
	.courseKeshi .addBox-style .btn .iconfont{margin-right:10px;font-weight:700;font-size:13px;float:left}
	.courseKeshi .addBox-style .btn:hover{background:#f8f8f8;color:#32bf71}
	.code__content {}
</style>

<div class="form-title2">
	<?php if($course['chapterTemplate']!=0){ ?>
	<span class="fr">
	   
    	<?php if($course['chapterTemplate']==1 || $course['chapterTemplate']==2){ ?>
        <button type="button" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','addchapter',$this->courseid,GP("chapterid-0")) ?>','550px','250px',{title:'添加章',type:'top'});" class="ks-bt bt-pue mr10"><i class="iconfont icon-jiahao"></i>添加章</button>
        <?php } ?>
        <?php if($course['chapterTemplate']==1 ){ ?>
        <button id="addSection" type="button" onclick="addjie();" class="ks-bt bt-pue mr10"><i class="iconfont icon-jiahao"></i>添加节</button>
        <?php } ?>
        
        <?php if($course['chapterTemplate']==3){ ?>
        <button id="addKeshi" type="button" onclick="addKeshi('<?php echo M_URL($this->AppName.'/Index','addkeshi',$this->courseid,GP("chapterid-0")) ?>');" class="ks-bt bt-pue mr10"><i class="iconfont icon-jiahao"></i>添加课时</button>
        <?php }else{ ?>
			<button id="addKeshi" type="button" onclick="addKeshi('<?php echo M_URL($this->AppName.'/Index','addkeshi',$this->courseid,GP("chapterid-0")) ?>');" class="ks-bt bt-pue mr10"><i class="iconfont icon-jiahao"></i>添加目录</button>

			<!--<button id="addKeshi" type="button" onclick="addks('<?php echo M_URL($this->AppName.'/Index','addkeshi',$this->courseid,GP("chapterid-0")) ?>');" class="ks-bt bt-pue mr10"><i class="iconfont icon-jiahao"></i>添加课时</button> -->
        <?php } ?>
         <a href="javascript:void(0);" onclick="Confirm('重新选择章节结构，将删除章节内的所有内容，是否继续该操作？','<?php echo M_URL($this->AppName.'/Index','changeChapter',$this->courseid,GP("")); ?>')" class="ks-bt bt-pur">
	    	重新选择章节结构
	    </a>
    </span>  
	<?php } ?>
	<?php echo $title;?><?php echo $course['chapterTemplate']==4?'目录':'学时';?>
</div>



<?php if($course['chapterTemplate']==0){ ?>

<!--未选择课时结构-->
<form target="hidframe" action="<?php  echo M_URL($this->AppName.'/Index','dochapterTemplate',$this->courseid,GP('')) ?>" method="post" id="myform">
	<div class="ksSelect">
		<ul class="clearfix">
		    <li>
		        <label for="chapterTemplate1" class="talk-in">
		        	<img src="/Public/uploads/common/chapter1.jpg" />
		        	<span><input type="radio" name="chapterTemplate" id="chapterTemplate1" value="1" checked="checked"/>章-节-课时</span>
		        </lable>
		       
		    </li>
		    
		    <li>
		        <label for="chapterTemplate2" class="talk-in">
		        	<img src="/Public/uploads/common/chapter2.jpg" />
		        	<span><input type="radio"  name="chapterTemplate" id="chapterTemplate2" value="2"/>章-课时</span>
		        </lable>
		    </li>
		    
		    <li>
		        <label class="talk-in" for="chapterTemplate3">
		        	<img src="/Public/uploads/common/chapter3.jpg" />
		        	<span><input type="radio"  name="chapterTemplate" id="chapterTemplate3" value="3"/>课时</span>
		        </label>
		    </li>
		</ul>   
	</div>
	
	<div class="form-footer clearfix">
		<span class="d-inline-block">
			
			<input type="button" onclick="selectChapterTemplate();" class="ks-bt bt-pue" value="确认选择">
			
    	</span>
	</div>
	  
</form>

<script>
function selectChapterTemplate(){
    var val = $('input[name="chapterTemplate"]:checked').val();
    if(val ==null){
    	Alert('请选择');
    	return false
    };
	$('#myform').submit();
}
</script>

<?php } ?>	

<?php if($course['chapterTemplate']==1){ ?>
<div class="courseKeshi"  style="padding: 30px 0px;">
	
	<?php if(isset($chapter))foreach($chapter as $k=>$v){?>
    <div class="chapter">
        <div class="name">
            <div class="r-icon zhang"> 
            	
            
              <a href="javascript:void(0)" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','addsection',$this->courseid,GP("chapterid-$v[chapterid],p-$page->now_page")) ?>','600px','300px',{title:'添加节',type:'top'})" >  
          
            	<em><i class="arrow-down"></i></em><i class="iconfont icon-icontianjia01"></i>
             </a>
            	
            	
            <a href="javascript:void(0)" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','addchapter',$this->courseid,GP("chapterid-$v[chapterid],p-$page->now_page"))?>','550px','250px',{title:'编辑',type:'top'})" >
                <span><em>编辑<i class="arrow-down"></i></em><i class="iconfont icon-bianji"></i></span></a>
                <a href="javascript:void(0);"  onclick="Confirm('是否删除此课程？该操作不可逆!','<?php echo M_URL($this->AppName.'/Index','delchapter',$this->courseid,GP("chapterid-$v[chapterid],p-$page->now_page")) ?>')">
                <span><em>删除<i class="arrow-down"></i></em><i class="iconfont icon-lajitong"></i></span></a>
            </div>
            <?php echo $v["title"]?> &nbsp;&nbsp;
			
          
        </div>
        <?php if(isset($v["Section"]))foreach($v["Section"] as $kt=>$vt){?>
        <div class="inner">
            <div class="name section" id="ID_">
                <div class="r-icon">
                 <a href="javascript:void(0)"  onclick="addKeshi('<?php echo M_URL($this->AppName.'/Index','addkeshi',$this->courseid,GP("chapterid-$vt[chapterid]")) ?>');" >	
            <em><i class="arrow-down"></i></em><i class="iconfont icon-icontianjia01"></i>
             </a>
                	
                	
                 <a href="javascript:void(0)" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','editsection',$this->courseid,GP("chapterid-$vt[chapterid],p-$page->now_page")) ?>','600px','300px',{title:'预览',type:'top'})" >
                <span><em>编辑<i class="arrow-down"></i></em><i class="iconfont icon-bianji"></i></span></a>
             
                   <a href="javascript:void(0);" onclick="Confirm('是否删除此课程？该操作不可逆!','<?php echo M_URL($this->AppName.'/Index','delchapter',$this->courseid,GP("chapterid-$vt[chapterid],p-$page->now_page")); ?>')">
                   <span><em>删除<i class="arrow-down"></i></em><i class="iconfont icon-lajitong"></i></span></a>
                </div>
                <?php echo $vt["title"] ?> &nbsp;&nbsp;
				<?php if($vt['chaptertype'] == 1){echo '点播';}elseif($vt['chaptertype']==2){echo '直播';}?>
               
            </div>
            <div class="inner">
                <?php if(isset($vt["keshi"]))foreach($vt["keshi"] as $ktt=>$vtt){ ;?>
                    <div class="name keshi">
                    <div class="r-icon <?php if ($course['courseType']==5){echo "operate";} ?>">
                       
                       <?php if($vtt['chaptertype'] == 2){  ?>
                   		    <?php if($vtt['begindate'] > $time){ ?>
                   		        直播时间:<?php echo date("Y-m-d H:i",$vtt['begindate']).' --'.date("m-d H:i",$vtt['enddate']); ?>
                   		   <?php }elseif($vtt['begindate'] <$time && $time<$vtt['enddate']){ ?>
                   		   	     <a href="javascript:void(0)" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','liveview',$this->courseid,GP("chapterid-$v[chapterid]"))?>','800px','630px')" >正在直播</a>
                   		   <?php }else{ ?>
                   		       	直播结束
                   		   <?php } ?>		
                  	<?php }elseif($vtt['chaptertype'] == 1){ ?>	
                        <a href="javascript:void(0)" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','viewplay',$this->courseid,GP("chapterid-$vtt[chapterid]"))?>','800px','630px',{title:'预览',type:'top'})" >
                        <span><em>预览<i class="arrow-down"></i></em><i class="icon iconfont icon-yulan1"></i></span></a>
                    <?php } ?>
                        <?php if ($course['courseType']==5){
                            ?>
                            <a >
                                <em>二维码<i class="icon-erweima"></i></em>
                                <i onclick="choiceClick(this)" class="iconfont icon-erweima"></i>
                                <div class="ks-head-content ks-head-content-pc " style="width:200px!important">
                                    <p>签到二维码</p>
                                    <p>用于线下扫码签到</p>
                                    <img src="<?php echo UOOT.'Images/QRcode/'.createQRcode(ROOT.'Images/QRcode/',wx_Url($this->wxid).'/#/course/'.$vtt['courseid'].'/facesign?chapterid='.$vtt['chapterid'],'L',4,'weimenhu');?>">
                                    <p>右键可保存图片</p>
                                    <span onclick='downloadFile("<?php echo UOOT.'Images/QRcode/'.createQRcode(ROOT.'Images/QRcode/',wx_Url($this->wxid).'/#/course/'.$vtt['courseid'].'/facesign?chapterid='.$vtt['chapterid'],'L',4,'weimenhu');?>")' style="text-decoration: underline;color: #E85345;">下载可打印大图</span>
                                </div>
                            </a>
                            <a href="<?php echo M_URL($this->AppName.'/Index','signList',$this->courseid,GP("chapterid-$v[chapterid],p-$page->now_page")); ?>" >
                                <em>签到记录<i class="arrow-down"></i></em><i class="iconfont icon-bianji"></i></a>
                            <?php
                        } ?>
                    
                    
						<a href="javascript:void(0)" onclick="addKeshi('<?php echo M_URL($this->AppName.'/Index','editkeshi',$this->courseid,GP("chapterid-$vtt[chapterid],p-$page->now_page")) ?>',2)">
                       <span><em>编辑<i class="arrow-down"></i></em><i class="iconfont icon-bianji"></i></span></a>
					
					 	
                       <a href="javascript:void(0);" onclick="Confirm('是否删除此课程？该操作不可逆!','<?php echo M_URL($this->AppName.'/Index','delchapter',$this->courseid,GP("chapterid-$vtt[chapterid],p-$page->now_page")); ?>')">
                        <span><em>删除<i class="arrow-down"></i></em><i class="iconfont icon-lajitong"></i></span></a>
                    </div>
                    <?php echo $vtt["title"]?>  &nbsp;&nbsp; <?php if($vtt['freeplay'] == 1&&$this->course['chargetype']==1){ ?><span class="try"><?php if($this->courseType==4){ ?>试看<?php }else {?>试听<?php }?></span><?php }?>
                        <?php
                        if ($course['courseType']==5){
                            if ($vtt['begindate']<time()) {?> <span style="color: limegreen;float: right;padding-right: 10px;">(已授课)</span><?php ;} ?>  <span style="float: right;padding-right: 10px;">开课时间： <?php echo KS_DATE($vtt['begindate']);?></span><?php
                        } ?>

                        <div > </div>
             
                </div>
                
                <?php }?>
    		</div>
    		
    	</div>
        <?php } ?>
	</div>
    <?php }?>
 </div><!--courseKeshi-->
 <?php }elseif($course['chapterTemplate']==2){?>   
 <div class="courseKeshi" style="padding: 30px 0px;">
	
	<?php if(isset($chapter))foreach($chapter as $k=>$v){?>
    <div class="chapter">
        <div class="name">
            <div class="r-icon zhang"> 
            	
            <a href="javascript:void(0)"  onclick="addKeshi('<?php echo M_URL($this->AppName.'/Index','addkeshi',$this->courseid,GP("chapterid-$v[chapterid]")) ?>');" >	
            <em><i class="arrow-down"></i></em><i class="iconfont icon-icontianjia01"></i>
             </a>	
           	
            <a href="javascript:void(0)" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','addchapter',$this->courseid,GP("chapterid-$v[chapterid],p-$page->now_page"))?>','700px','330px',{title:'编辑章',type:'top'})" >
                <span><em>编辑<i class="arrow-down"></i></em><i class="iconfont icon-bianji"></i></span></a>
                <a href="javascript:void(0);"  onclick="Confirm('是否删除此课程？该操作不可逆!','<?php echo M_URL($this->AppName.'/Index','delchapter',$this->courseid,GP("chapterid-$v[chapterid],p-$page->now_page")) ?>')">
                <span><em>删除<i class="arrow-down"></i></em><i class="iconfont icon-lajitong"></i></span></a>
            </div>
            <?php echo $v["title"]?> &nbsp;&nbsp;
			<?php if($v['chaptertype'] == 1){echo '点播';}elseif($v['chaptertype']==2){echo '直播';}?>

        </div>
        <?php if(isset($v["keshi"]))foreach($v["keshi"] as $kt=>$vt){;?>
        <div class="inner">
            <div class="name section" id="ID_">
                <div class="r-icon <?php if ($course['courseType']==5){echo "operate";} ?>">
                        
                        <?php if($vt['chaptertype'] == 2){  ?>
                   		    <?php if($vt['begindate'] > $time){ ?>
                   		        直播时间:<?php echo date("Y-m-d H:i",$vt['begindate']).' --'.date("m-d H:i",$vt['enddate']); ?>
                   		   <?php }elseif($vt['begindate'] <$time && $time<$vt['enddate']){ ?>
                   		   	     <a href="javascript:void(0)" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','liveview',$this->courseid,GP("chapterid-$vt[chapterid]"))?>','800px','630px')" >正在直播</a>
                   		   <?php }else{ ?>
                   		       	直播结束
                   		   <?php } ?>		
                   	<?php }elseif($vt['chaptertype'] == 1){ ?>	
                        <a href="javascript:void(0)" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','viewplay',$this->courseid,GP("chapterid-$vt[chapterid]"))?>','800px','630px',{title:'预览',type:'top'})" >
                        <span><em>预览<i class="arrow-down"></i></em><i class="icon iconfont icon-yulan1"></i></span></a>
                    <?php } ?>

                    <?php if ($course['courseType']==5){
                        ?>
                        <a >
                            <em>二维码<i class="icon-erweima"></i></em>
                            <i onclick="choiceClick(this)" class="iconfont icon-erweima"></i>
                            <div class="ks-head-content ks-head-content-pc " style="width:200px!important">
                                <p>签到二维码</p>
                                <p>用于线下扫码签到</p>
                                <img src="<?php echo UOOT.'Images/QRcode/'.createQRcode(ROOT.'Images/QRcode/',wx_Url($this->wxid).'/#/course/'.$vt['courseid'].'/facesign?chapterid='.$vt['chapterid'],'L',4,'weimenhu');?>">
                                <p>右键可保存图片</p>
                                <span onclick='downloadFile("<?php echo UOOT.'Images/QRcode/'.createQRcode(ROOT.'Images/QRcode/',wx_Url($this->wxid).'/#/course/'.$vt['courseid'].'/facesign?chapterid='.$vt['chapterid'],'L',4,'weimenhu');?>")' style="text-decoration: underline;color: #E85345;">下载可打印大图</span>
                            </div>
                        </a>
                        <a href="<?php echo M_URL($this->AppName.'/Index','signList',$this->courseid,GP("chapterid-$v[chapterid],p-$page->now_page")); ?>" >
                            <em>签到记录<i class="arrow-down"></i></em><i class="iconfont icon-bianji"></i></a>
                        <?php
                    } ?>

						<a href="javascript:void(0)" onclick="addKeshi('<?php echo M_URL($this->AppName.'/Index','editkeshi',$this->courseid,GP("chapterid-$vt[chapterid],p-$page->now_page")) ?>',2)">
                       <span><em>编辑<i class="arrow-down"></i></em><i class="iconfont icon-bianji"></i></span></a>
					
                      
                       <a href="javascript:void(0);" onclick="Confirm('是否删除此课程？该操作不可逆!','<?php echo M_URL($this->AppName.'/Index','delchapter',$this->courseid,GP("chapterid-$vt[chapterid],p-$page->now_page")); ?>')">
                        <span><em>删除<i class="arrow-down"></i></em><i class="iconfont icon-lajitong"></i></span></a>
                    </div>
                    <?php echo $vt["title"]?>  &nbsp;&nbsp;
                <?php
                if ($course['courseType']==5){
                    if ($vt['begindate']<time()) {?> <span style="color: limegreen;float: right;padding-right: 10px;">(已授课)</span><?php ;} ?>  <span style="float: right;padding-right: 10px;">开课时间： <?php echo KS_DATE($vt['begindate']);?></span><?php
                } ?>
                
            </div>
    	</div>
        <?php } ?>
	</div>
    <?php }?>
 </div><!--courseKeshi-->  
 <?php }elseif($course['chapterTemplate']==3){ ?>
 <div class="courseKeshi" style="padding: 30px 0px;">
	<?php if(isset($chapter))foreach($chapter as $k=>$v){?>
    <div class="chapter">
        <div class="name">
           <div class="r-icon zhang <?php if ($course['courseType']==5){echo "operate";} ?>">
           	<?php if($v['chaptertype'] == 2){  ?>  
       		    <?php if($v['begindate']<$time && $time<$v['enddate']){ ?>
       		      <a href="javascript:void(0)" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','liveview',$this->courseid,GP("chapterid-$v[chapterid]"))?>','800px','630px')" >正在直播</a>
       		   <?php }elseif($v['begindate'] > $time){ ?>
       		   	       直播时间:<?php echo date("Y-m-d H:i",$v['begindate']).'--'.date("m-d H:i",$v['enddate']); ?>
       		   <?php }else{ ?>
       		       	直播结束
       		   <?php } ?>		
         	<?php }elseif($v['chaptertype'] == 1){ ?>	
                <a href="javascript:void(0)" onclick="addTypeChange('<?php echo M_URL($this->AppName.'/Index','viewplay',$this->courseid,GP("chapterid-$v[chapterid]"))?>','800px','630px',{title:'预览',type:'top'})" >
                <span><em>预览<i class="arrow-down"></i></em><i class="icon iconfont icon-yulan1"></i></span></a>
            <?php } ?>

               <?php if ($course['courseType']==5){
                   ?>
                   <a >
                       <em>二维码<i class="icon-erweima"></i></em>
                       <i onclick="choiceClick(this)" class="iconfont icon-erweima"></i>
                       <div class="ks-head-content ks-head-content-pc " style="width:200px!important">
                           <p>签到二维码</p>
                           <p>用于线下扫码签到</p>
                           <img src="<?php echo UOOT.'Images/QRcode/'.createQRcode(ROOT.'Images/QRcode/',wx_Url($this->wxid).'/#/course/'.$v['courseid'].'/facesign?chapterid='.$v['chapterid'],'L',4,'weimenhu');?>">
                           <p>右键可保存图片</p>
                           <span onclick='downloadFile("<?php echo UOOT.'Images/QRcode/'.createQRcode(ROOT.'Images/QRcode/',wx_Url($this->wxid).'/#/course/'.$v['courseid'].'/facesign?chapterid='.$v['chapterid'],'L',4,'weimenhu');?>")' style="text-decoration: underline;color: #E85345;">下载可打印大图</span>
                       </div>
                   </a>
                   <a href="<?php echo M_URL($this->AppName.'/Index','signList',$this->courseid,GP("chapterid-$v[chapterid],p-$page->now_page")); ?>" >
                       <em>签到记录<i class="arrow-down"></i></em><i class="iconfont icon-bianji"></i></a>
                   <?php
               } ?>
             
				<a href="javascript:void(0)" onclick="addKeshi('<?php echo M_URL($this->AppName.'/Index','editkeshi',$this->courseid,GP("chapterid-$v[chapterid],p-$page->now_page")) ?>',2)">
               <span><em>编辑<i class="arrow-down"></i></em><i class="iconfont icon-bianji"></i></span></a>
			
               <a  href="javascript:void(0);" onclick="Confirm('是否删除此课程？该操作不可逆!','<?php echo M_URL($this->AppName.'/Index','delchapter',$this->courseid,GP("chapterid-$v[chapterid],p-$page->now_page")); ?>')">
                <span><em>删除<i class="arrow-down"></i></em><i class="iconfont icon-lajitong"></i></span></a>
            </div>
            <?php echo $v["title"]?>  &nbsp;&nbsp;
            <?php
                if ($course['courseType']==5){
                    if ($v['begindate']<time()) {?> <span style="color: limegreen;float: right;padding-right: 10px;">(已授课)</span><?php ;} ?>  <span style="float: right;padding-right: 10px;">开课时间： <?php echo KS_DATE($v['begindate']);?></span><?php
                } ?>
            <?php if($v['chaptertype'] == 1){echo '点播';}elseif($v['chaptertype']==2){echo '直播';} ?>
        </div>
	</div>
    <?php }?>
 </div>
	<!--面授  开始-->
 <?php }elseif($course['chapterTemplate']==4){?>
<div class="courseKeshi" style="padding: 30px 0px;">

	<?php if(isset($chapter))foreach($chapter as $k=>$v){?>
		<div class="chapter">
			<div class="name">
				<div class="r-icon zhang operate">
					<a >
							<em>二维码<i class="icon-erweima"></i></em>
							<i onclick="choiceClick(this)" class="iconfont icon-erweima"></i>
							<div class="ks-head-content ks-head-content-pc " style="width:200px!important">
								<p>签到二维码</p>
								<p>用于线下扫码签到</p>
								<img src="<?php echo UOOT.'Images/QRcode/'.createQRcode(ROOT.'Images/QRcode/',wx_Url($this->wxid).'/#/course/'.$v['courseid'].'/facesign?chapterid='.$v['chapterid'],'L',4,'weimenhu');?>">
								<p>右键可保存图片</p>
								<span onclick="window.open('')" style="text-decoration: underline;color: #E85345;">下载可打印大图</span>
							</div>
					</a>
					<a href="<?php echo M_URL($this->AppName.'/Index','signList',$this->courseid,GP("chapterid-$v[chapterid],p-$page->now_page")); ?>" >
						<em>签到记录<i class="arrow-down"></i></em><i class="iconfont icon-bianji"></i></a>
					<a href="javascript:void(0);" onclick="addKeshi('<?php echo M_URL($this->AppName.'/Index','editkeshi',$this->courseid,GP("chapterid-$v[chapterid],p-$page->now_page")) ?>',2)">
						<em>编辑<i class="arrow-down"></i></em><i class="iconfont icon-bianji"></i></a>

					<a  href="javascript:void(0);" onclick="Confirm('是否删除此课程？该操作不可逆!','<?php echo M_URL($this->AppName.'/Index','delchapter',$this->courseid,GP("chapterid-$v[chapterid],p-$page->now_page")); ?>')">
						<em>删除<i class="arrow-down"></i></em><i class="iconfont icon-lajitong"></i></a>
				</div>
				<?php echo $v["title"]?>  &nbsp;&nbsp; <?php if ($v['begindate']<time()) {?> <span style="color: limegreen;float: right;padding-right: 10px;">(已授课)</span><?php ;}?><span style="float: right;padding-right: 10px;">开课时间： <?php echo KS_DATE($v['begindate']);?></span>

			</div>
		</div>
	<?php }?>
</div>
<?php }?>
<!--面授  结束-->


<?php echo isset($chapter) ? NoC($chapter): '';?>


<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
<script src="<?php echo UOOT;?>Public/common/js/backstage.js"></script>
<script>
	<?php if($course['chapterTemplate']==1){ ?>
	function addjie(){
		if($('.zhang').length == 0){
			Alert('请添加章');
			return false;
		}
		addTypeChange('<?php echo M_URL($this->AppName.'/Index','addsection',$this->courseid,GP("chapterid-0")) ?>','600px','300px',{title:'添加节',type:'top'});
	}
	function addks(){
		if($('.section').length == 0){
			Alert('请添加节');
			return false;
		}
		addKeshi("<?php echo M_URL($this->AppName.'/Index','addkeshi',$this->courseid,GP("chapterid-0")) ?>"); 
	}
	!document.getElementsByClassName('zhang').length && (document.getElementById('addSection').disabled = true);
	(!document.getElementsByClassName('zhang').length || !document.getElementsByClassName('section').length) && (document.getElementById('addKeshi').disabled = true);

	<?php }elseif($course['chapterTemplate']==2){ ?>
	!document.getElementsByClassName('zhang').length && (document.getElementById('addKeshi').disabled = true);
	function addks(){
		if($('.zhang').length == 0){
			Alert('请添加章');
			return false
		};
		addKeshi("<?php echo M_URL($this->AppName.'/Index','addkeshi',$this->courseid,GP("chapterid-0")) ?>")
	}
	<?php } ?>

	function addKeshi(__url,type){
		<?php if($this->courseType==4){?>
			location.href = __url
		<?php }else{ ?>
			var __title = type === 2 ? '编辑课时' : '添加课时';
			addTypeChange(__url,'700px','550px',{title:__title})
		<?php }?>
	}

    /**
     * 判断是否为Trident内核浏览器(IE等)函数
     */
    function browserIsIe() {
        if (!!window.ActiveXObject || "ActiveXObject" in window) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * 创建iframe进行下载（兼容ie）
     */
    function createIframeToDownLoad(src) {
        if ($("#downloadFrame").length === 0) {
            $('#downloadFrame').remove()
        }
        $('<iframe style="display:none;" id="downloadFrame" name="downloadFrame" onload="window.frames[\'downloadFrame\'].document.execCommand(\'SaveAs\')" width="0" height="0" src="' + src + '"></iframe>').appendTo("body");
    }

    /**
     * 下载文件
     */
    function downloadFile(src) {
        if (browserIsIe()) {
            createIframeToDownLoad(src);
        } else {
            console.log(src);
            var a = document.createElement('a');
            var fileName = src.match(/[^/]+\.\w+/g);
            fileName = fileName[fileName.length - 1];
            a.setAttribute('download', fileName);
            a.href = src;
            a.click();
        }
    }
</script>
