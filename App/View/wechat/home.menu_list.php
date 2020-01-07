<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit"> 
<title>菜单列表</title>
<link href="<?php echo UOOT;?>Public/app/css/reset.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/style.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/common.css?<?php echoHash(); ?>" rel="stylesheet" />
<link href="<?php echo UOOT;?>Public/app/css/form.css?<?php echoHash(); ?>" rel="stylesheet" />
</head>
<body class="ks-wrap">
	
<div class="">
<div class="infoBox">
    <div class=" webConBox ">
        <div class="configTab clearfix" style="display: block">
            <form target="hidframe"  action="<?php echo M_URL($this->AppName.'/Index','bathDelMenuAll','',GP(""));  ?>" method="post">
            	<div>
                <table width="100%" cellpadding="0" cellspacing="0" border="0"
                       class="ks-table">
                    <thead>
                    <tr>
                    	<th style="width: 30px;"><input name="allChecked" type="checkbox" value="allChecked"  class="verAlignMiddle checkall check-all" id="selectAll"></th>
                        <th >菜单名称</th>
                        <th >顺序</th>
                        <th class="alignCenter hLh40 pt0 pb0 fsize14 w93">操作</th>    
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($memuFirst as $k=>$v){ ?>

                        <tr>
                        	<td >
								<input type="checkbox"  class="select-checks" name="id[]" value="<?php echo $v['id'] ?>" >

							</td>
                            <td  align="left">
                            	
                              <?php  echo $v['name'];?>
                              
                            </td>
                            <td > 
                            	<?php
                                if($v["orderid"] ==1 && $v['parentid'] ==0) {
                                    echo "第".$v["rootid"]."列";
                                }else{
                                    echo $v["orderid"];
                                }
                                ?>
                                </td>
                            <td >
                            	<div class="operate">
				                    <a href="<?php echo M_URL($this->AppName.'/test','upMenu',$v["id"],GP('')); ?>"><em>向上</em><i class="iconfont icon-top"></i></a>
				                    <a href="<?php echo M_URL($this->AppName.'/test','downMenu',$v["id"],GP('')); ?>"><em>向下</em><i class="iconfont icon-bottom"></i></a>
			                    </div>
                            </td>
                        </tr>
                        
                        
                        
                        <?php $memuSec =  $app_wechat_menu->getAll("where  wxid =". $this->wxid ." and parentid = ".$v['id']." order by orderid desc"); ?>
                        	
                        	  <?php foreach($memuSec as $kt=>$vt){ ?>
                        
                        
                          <tr>
                        	<td >
								<input type="checkbox"  class="select-checks" name="id[]" value="<?php echo $vt['id'] ?>" >

							</td>
                            <td  align="left">
                            	
                              <?php  echo "---".$vt['name'];?>
                              
                            </td>
                            <td > 
                            	<?php
                                if($vt["orderid"] ==1 && $vt['parentid'] ==0) {
                                    echo "第".$vt["rootid"]."列";
                                }else{
                                    echo $vt["orderid"];
                                }
                                ?>
                                </td>
                            <td >
                            	<div class="operate">
				                    <a href="<?php echo M_URL($this->AppName.'/test','upMenu',$vt["id"],GP('')); ?>"><em>向上</em><i class="iconfont icon-top"></i></a>
				                    <a href="<?php echo M_URL($this->AppName.'/test','downMenu',$vt["id"],GP('')); ?>"><em>向下</em><i class="iconfont icon-bottom"></i></a>
			                    </div>
                            </td>
                        </tr>
                        
                         <?php }?>
                                   
                        
                    <?php }?>
                    </tbody>
                </table> 
                </div>
               
        </div>
     
         <?php echo NoC($memuFirst);?>
    </div>
</div>
</div>
<div>
 <div class="ks-bom clearfix">
      <span class="fl">
      	<label class="mr20 fl"><input type="checkbox" class="select-checks selectAll">全选</label>
      	<button type="submit" class="ks-bt bt-pue" name="batch"  value="3" >批量删除</button></span>
      
</div>
</div>
   </form>
</body>
<script src="<?php echo UOOT;?>Public/common/js/module.js?<?php echo echoHash();?>"></script>
<script>
	
	module.require(['$','backstage','nicescroll'],function(){
		loadScorllJs();
		
	})

    function upMenu(id)
    {
        var url="";
        $.ajax({
            type:"post",
            url:url,
            data:{id:id},
            success:function(data){
				alert(data);
                if (data == 1) {
                    Alert("恭喜,菜单保存成功");
                } else {
                    Alert("对不起,同步失败");
                }
            },
        error:function(){
            alert("发生了错误,请检查!");
        }
        })
    }

   function DoCheck() {
	var ch=document.getElementsByName("id[]");
	var flag = document.getElementsByName("allChecked")[0].checked ? true : false;
	
	for(var i=0;i<ch.length;i++){
		ch[i].checked=flag;
	}
	
}




</script>

</html>


