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
    <link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
        <link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
    <link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
    <link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
   <style type="text/css">
   	.w47{
   		width: 132px;
   	}
   	.w93{
   		width: 150px;
   	}
   </style>
</head>

<body class="ks-wrap">
	


	
	<div class="bRadius10  ks-wbox">
		<div class="ks-head-nav">
			<!--标题-->
			<a href="javascript:history.go(-1);">成绩等级设置</a><em>/</em>添加分数等级			<!--标题-->
		</div>				
	
        <form class="forms" target="hidframe"  id="myform" action="<?php if(isset($ScoreRank)){ echo M_URL($this->AppName.'/Index','doEditScoreRank',$ScoreRank['rankid'],GP('')); }
		                     else{ echo M_URL($this->AppName.'/Index','doAddScoreRank','',GP(''));} ?>" method="post">
                       
	            <table width="100%" cellpadding="0" cellspacing="0" border="0" class="gTable">
	                <tr>
	                    <td class="leftTd alignRight fsize14 c-92 w93 ">成绩段名称</td>
	                    <td class="rightTd alignLife">
	                    	<div class="clearfix form-limit  w400" limit="30"> 
	                       		<input type="text"class="inputText w400 bRadius5" name="title" value="<?php if(isset($ScoreRank)) echo $ScoreRank['title'] ;?>">
	                        </div>
	                    </td>
	                </tr>
	                <tr>
	                    <td class="leftTd alignRight fsize14 c-92 w93">是否显示</td>
	                    <td class="rightTd alignLife">
	                       <input name="isdisplay" type="checkbox" value="<?php if(isset($ScoreRank['isDefault'])){echo $ScoreRank['isDefault'];}else{echo "1";} ?>>"
	                             class="bind-checkbox-style" style="display:none;"<?php  if(isset($ScoreRank['isDefault'])&&$ScoreRank['isDefault']=='1'){echo "checked";} ?>>
	                    </td>
	                </tr>
	                <tr>
	                    <td class="leftTd alignRight fsize14 c-92 w93 verAlignTop" >选项数量</td>
	                    <td class="rightTd alignLife">
	                        <input type="text"class="inputText bRadius5 new-form fl mr10" name="domainName" id="number" value="1" style="width: 150px;">
	                        <button type="button" class="ks-bt bt-def" onclick="addcount()">增加选项</button>
	                    </td>
	                </tr>
	
	                <tr>
	                    <td class="leftTd alignRight fsize14 c-92 w93 ">设置分数段</td>
	
	                    <td class="rightTd alignLife">
	                        <table width="60%" cellpadding="0" cellspacing="0" border="0"
	                               class="ks-table" style="border-bottom:0;width: 50%;">
	
	                            <thead id="number-table">
	                            <tr style="border-bottom:1px solid #ededed ">
	                                <th> 编号</th>
	                                <th >成绩名称</th>
	                                <th >成绩范围</th>
	                                <th >赠送积分</th>
	                                <!--<th class="alignCenter hLh40 pt0 pb0 c-92 fsize14 ">排序号</th>-->
	
	                            </tr>
	                            </thead>
	                            <tbody id="tablebody">
	                           <?php $i=0; if(isset($ScoreRankItem))foreach($ScoreRankItem as $k=> $v){ $i++;  ?>
								<tr class="del">
	                                <td ><?php echo $i;  ?></td>
	                                <td>
	                                <input type="text" class="inputText h27  w93 " name="itemTitle[]" value="<?php echo $v['itemTitle']; ?>" > 
	                                <input type="hidden" class="inputText h27  w93 " name="itemId[]" value="<?php echo $v['itemId']; ?>"></td>
	                                
	                                <td ><input type="number"class="inputText h27 w47 " name="minscore[]" 
	                                value="<?php echo $v['minscore']?>" > 
	                                  <input type="number"class="inputText h27 w47  " name="maxscore[]" value="<?php echo $v['maxscore']?>" ></td>
	                                  
	                                  
	                                <td>
	                                <input type="number"class="inputText  h27 w47 " name="score[]" value="<?php echo $v['score']?>"></td>
	                              
	                            </tr>
	                     <?php } ?>
	                            </tbody>
	                        </table>
	                    </td>
	                </tr>
	                <!--<tr>
	                    <td class="leftTd alignRight fsize14 c-92 w93 verAlignTop ">排序号</td>
	                    <td class="rightTd alignLife">
	                        <input type="number"class="inputText bRadius5 new-form" name="orderId" value="<?php if(isset($ScoreRank)) echo $ScoreRank['orderId'] ;?>">
	                        <p class="c-92 fsize12 mt5">序号越小排在越前面</p>
	                    </td>
	                </tr>-->
	                
	            </table>
	            <div class="ks-bom form-footer clearfix" >	
	            <span class="d-inline-block">	     
					<input type="button" onclick="do_reg()" class="ks-bt bt-pue" value="确认添加" name="confirm">
					<button type="button" onclick="javascript:history.go(-1);" class="ks-bt bt-defalut">取消</button>
				</span>	
			</div>
           </div>
        </form>
	

</div>

	        


<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
	module.require(['$','backstage','nicescroll'],function(){
		
		loadScorllJs();
		
		 $(function(){
		//优化复选框 0未选 1选中
			$('.bind-checkbox-style').each(function() {
				if($(this).is(':checked')==true){
		
					$(this).before('<div class="checkbox-style checkbox-style-on" data-flag="1"><i></i></div>');
				}else{
					$(this).before('<div class="checkbox-style" data-flag="0"><i></i></div>');
				};
			});
		
			$('.checkbox-style').on('click',function(){
				var flagId = $(this).attr('data-flag');
				if(flagId==0){
					$(this).addClass('checkbox-style-on');
					$(this).next('.bind-checkbox-style').attr('checked',true);
					$(this).attr('data-flag',1);
					$(this).next('.bind-checkbox-style').val(1);
				}else{
					$(this).removeClass('checkbox-style-on');
					$(this).next('.bind-checkbox-style').attr('checked',false);
					$(this).attr('data-flag',0);
					$(this).next('.bind-checkbox-style').val(0);
				};
			});					
		});
			
	})
        function addcount(){
			var html='';
            var n= $('#number').val();
            if(n!="" && n!=0 ){
            	// $('.del').remove();
            	var len = $('.del').length; 
            	var n = parseInt(n)+parseInt(len);
				for(var i=parseInt(len)+1;i<=n;i++){
				    html +='<tr class="del"><td>'+i+'</td>';
					html +='<td><input type="text"class="inputText h27  w93 " name="itemTitle[]"></td>';
					html +='<td><input type="number"class="inputText h27 w47 " name="minscore[]" style="margin-right:4px">';
					html +='<input type="number"class="inputText h27 w47  " name="maxscore[]"></td>';
					html +='<td><input type="number"class="inputText h27 w47 " name="score[]"></td></tr>';
				}
				$('#tablebody').append(html);
            }else{
            	 parent.popup.tips({
					 title:'请输入选项数量'
				 });
            }        
     }
    /*slide-滑块*/
   

<?php if(!isset($ScoreRankItem)){   ?>
          addcount();
   <?php  }  ?>


function do_reg(){
   var Title  = $("input[name='title']").val(); 
   	if(!Title){
		Alert('名称不能为空');
		return false;	
    }
	$("#myform").submit();
}	


</script>
</body>
</html>
