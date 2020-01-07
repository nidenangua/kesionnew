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
    <link href="<?php echo UOOT;?>Public/app/css/main.css?<?php echoHash(); ?>" rel="stylesheet" />
    <link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
    <script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
    <style>
        .generalBeen {
            display: inline-block;
            padding: 0 20px;
            height: 34px;
            line-height: 34px;
            text-align: center;
            background-color: limegreen;
            border: none;
        }
        .generalTitle {margin-bottom: 30px}
        .w47 {width: 47px;!important;}
        .h27 {height: 27px !important;}
        table thead tr th {border-bottom: 1px solid #eee}
    </style>
</head>

<body class="bg-gary">
<div class="gSmallBox contentBox bRadius10 bg-white w100">
    <div class="generalTitle">
        <span class="gTitle fsize18 c-3e verAlignMiddle">修改成绩段</span>
         当前所在<?php echo $this->userinfo['username'] ?>分数管理界面
        <a class="generalBeen c-fff fsize16 bRadius5 fr" href="<?php echo  M_URL($this->AppName.'/Index','scoreRank','',GP(''));?>" >返回</a>
    </div>
    <div class="infoBox">
        <div class="clearfix p20">
            <form target="hidframe"  action="<?php if(isset($ScoreRank)){ echo M_URL($this->AppName.'/Index','doEditScoreRank',$ScoreRank['rankid'],GP('')); }
			                     else{ echo M_URL($this->AppName.'/Index','doAddScoreRank','',GP(''));} ?>" method="post">
                <table width="100%" cellpadding="0" cellspacing="0" border="0" class="gTable">
                    <tr>
                        <td class="leftTd alignRight fsize14 c-92 w93 ">成绩段名称</td>
                        <td class="rightTd alignLife">
                            <input type="text"class="inputText bRadius5 w400" name="title" value="<?php if(isset($ScoreRank)) echo $ScoreRank['title'] ;?>">
                        </td>
                    </tr>
                    <tr>
                        <td class="leftTd alignRight fsize14 c-92 w93">是否默认</td>
                        <td class="rightTd alignLife">
                           <input name="isdisplay" type="checkbox" value="<?php if(isset($ScoreRank['isDefault'])){echo $ScoreRank['isDefault'];}else{echo "1";} ?>>"
                                 class="bind-checkbox-style" style="display:none;"<?php  if(isset($ScoreRank['isDefault'])&&$ScoreRank['isDefault']=='1'){echo "checked";} ?>>
                        </td>
                    </tr>
                    <tr>
                        <td class="leftTd alignRight fsize14 c-92 w93 verAlignTop " >选项数量</td>
                        <td class="rightTd alignLife">
                            <input type="text"class="inputText bRadius5 w400" name="domainName" id="number">
                            <button type="button" class="generalBeen  c-fff fsize16 bRadius5" id="addcount">增加选项</button>
                        </td>
                    </tr>




                    <tr>
                        <td class="leftTd alignRight fsize14 c-92 w93 ">设置分数段</td>

                        <td class="rightTd alignLife">
                            <table width="40%" cellpadding="0" cellspacing="0" border="0"
                                   class="gTable text20171 borderTable borderSo" style="border-bottom:0;" >

                                <thead id="number-table">
                                <tr style="border-bottom:1px solid #ededed ">
                                    <th class="alignCenter hLh40 pt0 pb0 c-92 fsize14"> 编号</th>
                                    <th class="alignCenter hLh40 pt0 pb0 c-92 fsize14">成绩名称</th>
                                    <th class="alignCenter hLh40 pt0 pb0 c-92 fsize14">成绩范围</th>
                                    <th class="alignCenter hLh40 pt0 pb0 c-92 fsize14 ">赠送积分</th>
                                    <th class="alignCenter hLh40 pt0 pb0 c-92 fsize14 ">排序号</th>

                                </tr>
                                </thead>
                                <tbody>
                               <?php $i=0; if(isset($ScoreRankItem))foreach($ScoreRankItem as $k=> $v){ $i++;  ?>
								<tr>
                                    <td class="alignCenter hLh40 pt0 pb0 fsize14 c-92 number "><?php echo $i;  ?></td>
                                    <td class="alignCenter hLh40 pt0 pb0 fsize14  c-92 ">
                                    <input type="text" class="inputText h27  w93 " name="itemTitle[]" value="<?php echo $v['itemTitle']; ?>" > 
                                    <input type="hidden" class="inputText h27  w93 " name="itemId[]" value="<?php echo $v['itemId']; ?>" ></td>
                                    <td class="alignCenter hLh40 pt0 pb0 fsize14 c-92"><input type="text"class="inputText h27 w47 " name="minscore[]" 
                                    value="<?php echo $v['minscore']?>"> 
                                      <input type="text"class="inputText h27 w47  " name="maxscore[]" value="<?php echo $v['maxscore']?>"></td>
                                    <td class="alignCenter hLh40 pt0 pb0 fsize14 c-92">
                                    <input type="text"class="inputText h27 w47 " name="score[]" value="<?php echo $v['score']?>"></td>
                                    <td class="alignCenter hLh40 pt0 pb0 fsize14 c-92"><input type="text"class="inputText h27 w47 " name="itemOrderId[]"
                                    value="<?php echo $v['itemOrderId']?>"></td>
                                </tr>
                         <?php } ?>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td class="leftTd alignRight fsize14 c-92 w93 verAlignTop ">排序号</td>
                        <td class="rightTd alignLife">
                            <input type="text"class="inputText bRadius5 w400" name="orderId" value="<?php if(isset($ScoreRank)) echo $ScoreRank['orderId'] ;?>">
                            <p class="c-92 fsize12 mt5">序号越小排在越前面</p>
                        </td>
                    </tr>
                    <tr>
                        <td class="leftTd alignRight w93"></td>
                        <td class="rightTd alignLife"><input type="submit" class="generalBtn c-fff fsize16 bRadius5" value="确认" name="confirm">
                            <input type="submit" class="generalBtn c-fff fsize16 bg-d7 c-92 bRadius5" value="取消" name="confirm">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>

<script>
    $(function () {
        $('#addcount').click(function(){
			var html='';
            var n= $('#number').val();
			$('.del').remove();
			for(var i=1;i<=n;i++)
			{
			    html +='<tr class="del">';
				html +='<td class="alignCenter hLh40 pt0 pb0 fsize14 c-92 number ">'+i+'</td>';
				html +='<td class="alignCenter hLh40 pt0 pb0 fsize14  c-92 "><input type="text"class="inputText h27  w93 " name="itemTitle[]"></td>';
				html +='<td class="alignCenter hLh40 pt0 pb0 fsize14 c-92"><input type="text"class="inputText h27 w47 " name="minscore[]"> <input type="text"class="inputText h27 w47  " name="maxscore[]"></td>';
				html +='<td class="alignCenter hLh40 pt0 pb0 fsize14 c-92"><input type="text"class="inputText h27 w47 " name="score[]"></td>';
				html +='<td class="alignCenter hLh40 pt0 pb0 fsize14 c-92"><input type="text"class="inputText h27 w47 " name="itemOrderId[]"></td>';
				html +='</tr>';  
			}
		$('#number-table').after(html);
             
    });
    })
    /*slide-滑块*/
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
</script>
</body>
</html>
