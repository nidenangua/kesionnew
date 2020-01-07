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
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<style>
.courseList li{ position:relative; padding-left:229px;min-height:189px;padding-top:20px; padding-bottom:20px; padding-right:20px; border-bottom:1px solid #eee;}
.courseList li .tface{width:189px;height:189px; position:absolute;left:20px;top:20px; text-align:center;}
.TcTab li{ padding:0 20px; line-height:35px; margin-left:20px; font-size:16px; cursor:pointer;}
.TcTab li.curr{ background:#128fd1; color:#fff;}
.TcTabBox .courseList{ display:none;}
.liveTab li a .iconfont {color: #929292}
.liveTab .curr a .iconfont {color: #333}
.generalBeen {
	display: inline-block;
	padding: 0 20px;
	height: 34px;
	line-height: 34px;
	text-align: center;
	background-color: limegreen;
	border: none;
}
</style>
</head>
<body class="ks-wrap">
      <!--开始-->
<div class="bRadius10 bg-white ks-wbox">
	<div id="ksBoxHead">
		<div class="generalTitle clearfix">
		    <span class="title-icon"><i class="iconfont icon-myorder"></i></span>
	        <span class="gTitle fsize18">每日一练</span>
		     
		     <div class="fr ks-top-search">
				<label class="mr0">
			   	<select class="w150 inputText bRadius5" id="keytype">
					<option value="1">日期</option>
			
			  	</select>
				</label>
				<form target="hidframe" class="fr">
				<div class="ks-top-search">
					<input type="text" class="sc-text" name="searchText" id="keyword"  value="<?php if(isset($keyword)) echo $keyword; ?>">
	                <input type="submit" class="sc-button fl" onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','showHistory',$courseid,GP('status-0')); ?>','<?php echo URL_MODEL;?>')" name="searchBtn" value="搜索" >
				</div>
				</form>
			</div>
		
		</div>
		
	</div>
    <div id="ksBoxContent">
    <form target="hidframe"  method="post" action="<?php echo M_URL($this->AppName.'/Index','bathDelHistory',$courseid,GP(''));?>" id="myform">
    <table width="100%" cellpadding="0" cellspacing="0" border="0" class="gTable borderTable borderSo ks-table" style="border-bottom:0;">
        <thead>
        <tr>
            <th><input name="allChecked" type="checkbox" value="allChecked" class="check-all verAlignMiddle" id="selectAll" onclick="DoCheck()"></th>
            <th class="ta-left">日期</th>
            <th class="ta-left">生成excel</th>

        </tr>
        </thead>
        <tbody>
        <?php foreach($values as $k=>$v){ ?>
            <tr>
              <td class="alignCenter hLh40 pt0 pb0 fsize14 c-92 ">
                    <input type="checkbox" class="verAlignMiddle mr10" name="id[]" value="<?php echo $v['id'] ?>">
               </td> 
                 <td  class="ta-left"><a href="<?php echo M_URL($this->AppName.'/Index','showTrainingEverydayDetail',$v['id'],GP('status-0')) ?>"><?php echo $v['adddate'] ?></a></td>
                 <td  class="ta-left"><a href="<?php echo M_URL($this->AppName.'/Index','createExcel',$v['id'],GP('status-1')) ?>"><i class="iconfont icon-bianji4"></i></a></td>


            </tr>
        <?php } ?>
        </tbody>
    </table>
     <?php echo NoC($values);?>
    </form>
    </div>
</div> 
<div id="ksBoxFooter" class="ks-bom clearfix">
	<div class="fl">
		<button class="ks-bt bt-pue" onclick="submitform();"><i class="iconfont icon-lajitong"></i>批量删除</button>
	</div>
 	<div class="fr"><?php echo $page->show(3); ?></div>

</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
   function DoCheck() {
        var ch=document.getElementsByName("id[]");
        if(document.getElementsByName("allChecked")[0].checked==true)
        {
            for(var i=0;i<ch.length;i++)
            {
                ch[i].checked=true;
            }
        }else{
            for(var i=0;i<ch.length;i++)
            {
                ch[i].checked=false;
            }
        }
    }
    
    function submitform(){
     
	$('#myform').submit();
}
</script>
</body>

</html>
