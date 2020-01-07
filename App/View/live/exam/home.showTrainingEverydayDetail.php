<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="renderer" content="webkit">
	<title>kesion教育平台</title>
	<meta name="Keywords" content="kesion教育平台"/>
	<meta name="Description" content="kesion教育平台" />
	<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
	<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
	
	<style>
		.st-select{width:220px;height:32px; line-height: 32px;background: #476dbe;color:#fff; font-size:14px; position: relative; cursor: pointer;}

	</style>
	
</head>
<body class="ks-wrap">

	<div class="bRadius10 bg-white ks-wbox">
		<div id="ksBoxHead">
			<div class="generalTitle clearfix">
			    <div class="fl back-bt" onclick="location.href='<?php echo M_URL($this->AppName.'/Index','showTrainingEveryday','',GP('')) ?>'">
			    	<i class="iconfont icon-jiantou-copy"></i>查看课程试卷

			    </div>
			    
		        <div class="fr ks-top-search">
					
					<label class="mr0">
					   	<!--<select class="w150 inputText bRadius5" id="keytype">
							<option value="1">录入者</option>
							<option value="2">知识点</option>
					  	</select>-->
					</label>
					<form target="hidframe" class="fr">
					<div class="ks-top-search">
						<!--<input type="text" class="sc-text" name="searchText" id="keyword"  value="<?php if(isset($keyword)) echo $keyword; ?>">
		                <input type="submit" class="sc-button fl" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','trainingEveryday',$courseid,GP('')); ?>','<?php echo URL_MODEL;?>')" name="searchBtn" value="搜索" >-->
					</div>
					</form>
				</div>
			</div>
			
			<!--END HEAD-->
		</div>
		    
		<div id="ksBoxContent">
		    <form target="hidframe"  method="post" action="<?php echo M_URL($this->AppName.'/Index','filterTrainingEveryday','',GP(''));?>" id="myform">
		    
			    <table width="100%" cellpadding="0" cellspacing="0" border="0" class="gTable borderTable borderSo ks-table" style="border-bottom:0;">
			        <thead>
			        <tr>
			            <th> 
			         <!--    <input type="checkbox" id="selectAll" onclick="checkboxClick()">-->
			            </th>
			            <th width="40%" class="ta-left">题目</th>
			            <th width="20%" class="ta-left">答案</th>
			            <th width="20%" class="ta-left">答案分析</th>
			            <th width="20%" class="ta-left">选项</th>
			
			        </tr>
			        </thead>
			        <tbody>
			        <?php foreach($allvalue as $k=>$v){ ?>
			            <tr>
			                <td>
<!--			                      <input type="checkbox" onclick="checkboxClick(this)" class="select-check" name="tkids" id ="tknum" value="<?php echo $v['tkid'] ?>" >-->
			                </td>
			                 <td  width="40%" class="ta-left topic"><?php echo $k+1;?><?php echo Field($v['option']); ?></td>
			                 <td  width="20%" class="ta-left"><?php echo Field($v['answer']); ?></td>
			                 <td  width="20%" class="ta-left"><?php echo Field($v['analysis']); ?></td>
			                 <td  width="20%" class="ta-left">
			                 	<?php  
			                 	  $aa ='';
			                 	  if(isset($v['select'])){
			                 		 foreach($v['select'] as $k=>$v){
                                      $aa .= $v['xx'].'<br/>';
                                      }
			                 	    }
                                    echo Field($aa);
                               ?></td>
			            </tr>
			        <?php } ?>
			        </tbody>
			    </table>
			    
			    <?php echo NoC($allvalue);?>
		     	
		    </form>
			
		</div>
		
			
	</div>
	
	<div id="ksBoxFooter" class="ks-bom clearfix">
		<div class="fl">
			<div class="course-st-list">
				<div class="st-list-box"></div>
				<!--<div class="st-select" onclick="submitForm()">创建试卷 (<span id="topicTotal">0</span>)</div>-->
			</div>
		</div>
		<div class="fr">
			<?php echo $page->show(3); ?>	
		</div>
		
	</div>
	
	<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
	<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
	<script src="<?php echo UOOT;?>Public/common/js/jquery.cookie.js"></script>
	<script>

	    if(location.href.indexOf(',p-')==-1){
	    	//清空选择数据
	    	top.dailyPracticeData = [];
	    };
	    if(top.dailyPracticeData){
	    	
	    	//遍历选中值
	    	for(var i=0;i<top.dailyPracticeData.length;i++){
    			var thisValue = top.dailyPracticeData[i].value;
    			
    			for(var s=0;s<$('.select-check').length;s++){
    				if($('.select-check')[s].value==thisValue){
    					
    					$('.select-check')[s].checked = true;
    					
    				}
    			}
    			
    		}
    		
    		setTopicTotal();
	    	
	    }else{
	    	top.dailyPracticeData = [];
	    }
	    
	    function checkboxClick(target){			
			//选择题目
			if(target.checked){
				var topic = $(target).parent().next().text();
				addTopic(target.value,topic);
				setTopicTotal();
			}else{
				removeTopic(target.value);
				setTopicTotal();
			}
			
		};
		
		//题目数量
		function setTopicTotal(){
			
			document.getElementById('topicTotal').innerHTML = top.dailyPracticeData.length; 
			
		}
	    
	    //添加题目
	    function addTopic(_value,topic){
	    	
	    	var topicJson = {
	    		topic:topic,
	    		value:_value
	    	}
	    	
	    	if(top.dailyPracticeData.length==0){
	    		top.dailyPracticeData.push(topicJson);
	    	
	    	}else{
	    		
	    		//检查是否有重复值
				var valueRepeat = false;
	    		for(var i=0;i<top.dailyPracticeData.length;i++){
	    			var thisValue = top.dailyPracticeData[i].value;
	    			//检测到重复值，跳出循环
	    			if(_value==thisValue){
	    				valueRepeat = true;
	    				break;
	    			};	
	    		}
	    		
	    		//值不重复的情况下，追加值
	    		if(valueRepeat==false){
	    			top.dailyPracticeData.push(topicJson);
	    		}

	    	}

	    }
	    
	    //删除题目
	    function removeTopic(_value){
	    	for(var i=0;i<top.dailyPracticeData.length;i++){
    			var thisValue = top.dailyPracticeData[i].value;
    			//检测到相同值，执行删除
    			if(_value==thisValue){
    				top.dailyPracticeData.splice(i,i+1);
    			};	
    		}
	    
	    }
		
		//获取题目值
		function getTopicValue(){
			var topicValue = '';
			for(var i=0;i<top.dailyPracticeData.length;i++){
    			var thisValue = top.dailyPracticeData[i].value;
    			//检测到相同值，执行删除
    			if(i==0){
    				topicValue += thisValue;
    			}else{
    				topicValue += ','+thisValue;
    			}
    		}
    		
			return topicValue;
			
		}
		
		//提交创建试卷
	function submitForm(){
		var aa=getTopicValue();
        var url="<?php echo M_URL($this->AppName.'/Index','filterTrainingEveryday','',GP(''));?>";
         $.ajax({
			type:"post",
			url:url,
			data:{tkids:aa},
            success:function(data,textStatus){
				Alert(data);
			},
			error:function(){
				Alert("发生了错误,请检查!");
			}
	})
		  	
};
	
	
	</script>
</body>
</html>
