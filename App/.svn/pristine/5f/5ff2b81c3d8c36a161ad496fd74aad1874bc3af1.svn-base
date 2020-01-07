<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="renderer" content="webkit">
   <link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
    <link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
    <script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>
<style>
.control-label {padding-top:7px}
</style>
    
<title>无标题文档</title>
</head>

<body class="gray-bg p15">

<div class="clearfix p15">
      <div class="search-main fr">
                    <div class="search-box mt7 w150 fl">
                        <label class="fl linh30 control-label">
                            类别
                        </label>
                        <select class="form-control  input-sm w90  inline" id="keytype">
                            <option value="1" selected="">名称</option>
                            <option value="2">作者</option>
                        </select>

                    </div>
                    <div class="search-box w240 fl" style="margin-top: 7px">
                        <div class="input-group">
                          <input type="text" class=" form-control2017 input-sm w180 fl" id="keyword" value="" placeholder="Search">
                          <span class="input-group-btn ">
                            <button class="btn btn-sm btn-default  fl" type="button" onclick="searchByClass();">Go!</button>
                          </span>
                        </div>
                    </div>
                   
       </div>
       </div>
       <div class="tabs-container">
       <ul class="nav nav-tabs">
        <li <?php if($keytype==2)echo 'class="active"';  ?>><a href="<?php echo M_URL($this->AppName.'/Index','selectUser','',GP('keytype-2')); ?>">老师</a></li>
       	<li <?php if($keytype==1)echo 'class="active"';  ?>><a href="<?php echo M_URL($this->AppName.'/Index','selectUser','',GP('keytype-1')); ?>">机构</a></li>
        
     </ul>
        <div class="tab-content">
                <div class="tap-pane" style="display: block">
                    <div class="panel-body">
           <table class="table table-bordered ">
         <thead>
             <tr>
                <th width="50px"></th>
                <th width="100px">ID</th>
                <th width="100px">名字</th> 
             </tr>
             </thead>
             <?php  foreach($values as $key=>$v){ ?>
             <tr>
                 <td><input type="radio" id="radio<?php echo $v["userid"]?>" name="speaker" value="<?php echo $v["userid"] ?>"></td>
                 <td id="<?php echo $v["userid"]?>"><?php  echo $v["userid"] ?></td>
                 <td id="name<?php echo $v["userid"]?>"><?php  echo $v["name"] ?></td>
             </tr>
             <?php } ?>
            
           </table>  
           </div>
           </div>
           </div>
           </div>
           <div class="group-form mt20">
           <div class="col-sm-2 mt7"> <input type="button" class="btn btn-s-md btn-primary" id="abc"  onClick="addPaper()"  value="确认" name="confirm" /></div>   
             <div class="col-sm-10"> <?php echo $page->show(3); ?></div>
        	</div>
         
		 
		 <script>
		 function addPaper(){ 
		 
         var userid = $('input:radio:checked').val();
		
		 var url = '<?php echo M_URL($this->AppName.'/Index','addKpoint','',GP('')); ?>,userid-'+userid;
			 
		 parent.location.href=url;
         
		 }
         
		 $(function(){
	      $('.nav-tabs li').click(function(){
            $(this).addClass('active').siblings().removeClass('active');
          
        })
	})
         </script>
         
         
</body>
</html>

