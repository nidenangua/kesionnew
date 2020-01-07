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
<link href="<?php echo UOOT;?>Public/app/css/live.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/main.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>

<style>
.inputText {
    height: 32px;
    line-height: 32px;
}
.orz{
    margin: 15px 20px;
}
.layui-table[lay-even] tr:nth-child(even) {
    background: #fafafa;
}
.searchBtn {height: 32px;}
</style>
</head>
<body>

    <label class="fl mr30"><input type="checkbox" name="" class="checkall verAlignMiddle check0 check-all "><span class="hLh30 fsize14 c-92 verAlignMiddle">全选</span></label>
    <div class="search-box orz clearfix" >
        题型
        <select class="inputText bRadius5 w150 c-79 mr30 fl" onchange="getval(this,'<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','tkList',$typeid); ?>','tktype','<?php echo URL_MODEL;?>')">
            <option value="0" <?php if(isset($tktype))if($tktype == 1) echo "selected"; ?>></option>
            <option value="1" <?php if(isset($tktype))if($tktype == 1) echo "selected"; ?>>单选题</option>
            <option value="2" <?php if(isset($tktype))if($tktype == 2) echo "selected"; ?>>填空题</option>
            <option value="3" <?php if(isset($tktype))if($tktype == 3) echo "selected"; ?>>判断题</option>
            <option value="4" <?php if(isset($tktype))if($tktype == 4) echo "selected"; ?>>问答题</option>
            <option value="5" <?php if(isset($tktype))if($tktype == 5) echo "selected"; ?>>材料题</option>
        </select>
      </div>    
    <div class="search-box orz clearfix" >
        难度
        <select class="inputText bRadius5 w150 c-79 mr30 fl" onchange="getval(this,'<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','tkList',$typeid); ?>','tklevel','<?php echo URL_MODEL;?>')">
            <option value="0" <?php if(isset($tklevel))if($tklevel == 1) echo "selected"; ?>></option>
            <option value="1" <?php if(isset($tklevel))if($tklevel == 1) echo "selected"; ?>>简单</option>
            <option value="2" <?php if(isset($tklevel))if($tklevel == 2) echo "selected"; ?>>一般</option>
            <option value="3" <?php if(isset($tklevel))if($tklevel == 3) echo "selected"; ?>>困难</option>
        </select>
      </div>    
      <div class="search-box orz clearfix" >
        类型
        <select class="inputText bRadius5 w150 c-79 mr30 fl" onchange="getval(this,'<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','tkList',$typeid); ?>','papertypeid','<?php echo URL_MODEL;?>')">
                    <option value="0">请选择</option>
             <?php foreach($papertype as $k=>$v){?>
                    <option value=" <?php echo $v['id'] ?>"  <?php  if($v['id'] == $papertypeid) echo "selected"; ?>>
                           <?php echo $v['typeName']?>
                    </option>
             <?php } ?>
        </select>
      </div>  
    </div>
    <div class="seach-input fl">
            <form target="hidframe" >
                <input type="text" class="inputText" name="searchText" id="keyword" value="<?php if(isset($keyword)) echo $keyword ;?>"> 
                <input type="button" class="searchBtn w93 fsize14 bg-gary c-92 verAlignMiddle" name="searchBtn" value="搜索" onclick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','tkList',$typeid); ?>','<?php echo URL_MODEL;?>')">
            </form>
     </div>
    <table width="100%" cellpadding="0" cellspacing="0" border="0"
           class="gTable borderTable borderSo" style="border-bottom:0;">

        <thead>
        <tr class="bg-gary">
            <th class="alignCenter hLh40 pt0 pb0 fsize14 w93"> 序号</th>
            <th class="alignCenter hLh40 pt0 pb0 fsize14">题型</th>
            <th class="alignCenter hLh40 pt0 pb0 fsize14 ">题目</th>
            <th class="alignCenter hLh40 pt0 pb0 fsize14 ">答案</th>
            <th class="alignCenter hLh40 pt0 pb0 fsize14 w93">录入者</th>
        </tr>
        </thead>
        <form target="hidframe"  action=" <?php echo M_URL($this->AppName.'/Index','dopaperAddTk',$typeid,'',GP(""))  ?>" method="post">
        <tbody>
        <?php foreach($tk as $k=>$v){ 
		           if($v['tktype'] == 1){
				  $tktype = '选择题';
				  $option=explode("$$$",$v['options']);
				  $v['options']=$option[0];
				}elseif($v['tktype'] == 2){
					$tktype = '填空题';
				}elseif($v['tktype'] == 3){
					$tktype = '判断题';
				}elseif($v['tktype'] == 4){
				     $tktype = '问答题';
				}elseif($v['tktype'] == 5){
				     $tktype = '材料题';
				}
		 ?>
        <tr>
            <td class="alignCenter hLh40 pt0 pb0 fsize14 c-92 ">
                <div class="order-product pd-b">
                    <input type="checkbox" class="verAlignMiddle mr10" id="tk<?php echo $v['tkid'] ?>" name="tkid[]" value=" <?php echo $v['tkid'] ?>" onClick="getTK(this)" >
                     <?php echo $v['tkid'] ?>
                </div>
               
            </td>
            <td class="alignCenter hLh40 pt0 pb0 fsize14 c-92"><?php echo $tktype ?></td>
            <td class="alignCenter hLh40 pt0 pb0 fsize14 c-92"><?php echo $v['options'] ?></td>
            <td class="alignCenter hLh40 pt0 pb0 fsize14 c-92"><?php echo $v['anser'] ?></td>

            <td class="alignCenter hLh40 pt0 pb0 fsize14 c-92">
               <?php echo $v['inputer'] ?>
            </td>
        </tr>
       <?php }?>
        </tbody>
        <input type="submit" class="generalBtn c-fff fsize16 bRadius5" value="确定" name="confirm">
        </form>
    </table>
    <div class="footer-page">
        <?php echo $page->show(3); ?>
    </div>
</body>
</html>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
 <script src="<?php echo UOOT;?>Public/common/js/jquery.cookie.js" type="text/javascript"></script>
<script>
function getTK(obj){
    
	var a = $(obj).prop('checked');
	var b =$(obj).val();

	var selectTk = $.cookie("selectTk");
	if(!selectTk){
		var ab = new Array(); 
		ab.push(b);
		var tk = ab.join(",");
		$.cookie('selectTk',tk);
	}else{
    ab =selectTk.split(",");
	if(a==false){
		ab.splice($.inArray(b,ab),1);
	    var tk = ab.join(",");
	}else{
		ab.push(b);
		var tk = ab.join(",");
	}
	$.cookie('selectTk',tk);
	}
}


$(function(){ 
     
	var selectTk = $.cookie("selectTk");
	if(selectTk){
	   var ab =selectTk.split(",");
	   for(var i=0;i<ab.length;i++)
	   {
		   //alert("#tk"+);
		   $("#tk"+parseInt(ab[i])).attr('checked','checked');
		   }
	}
	
   //$.cookie('selectTk',Array());
   
 /* var selectTk = $.cookie("selectTk");
  var a =selectTk.split(",");
  */
   /* $("input:checkbox").each(function(){
		 
	 })*/
  
})
</script>