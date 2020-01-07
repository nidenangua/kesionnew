<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="renderer" content="webkit">
  <title></title>
  <link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
  <link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
  <link href="<?php echo UOOT;?>Public/app/css/form.css" rel="stylesheet">
  <link href="<?php echo UOOT;?>Public/admin/css/news/newstyle.css" rel="stylesheet">
</head>
<body class="gray-bg">
<br /><br /><br />
<div class="content-area mt10" style="margin-top:25px;">
     <div class="row">
    <div id="manage_top" class="menu_top_fixed p15 height73"  >
			<div class="ibox-title fl mr15 ml15">
                <h3 class="fl">增加地区管理</h3>
             
            </div>
            <div class="ibox-tools" >
                 	<button class="ks-bt" type="button" onclick="history.go(-1)"><i class="iconfont icon-fanhui"></i>返回</button>
            </div>
      </div>
       <form target="hidframe"  method="post" action="<?php echo M_URL('Setting','doAddArea') ?>" class="form-horizontal" id="myform">
       <div class="form-group">
         <label class="col-sm-2 control-label">所属地区:</label>
         <div class="col-sm-4">
           <select class="form-control" name="parentid" id ="parent_area">
                  <option value="0">--作为一级地区分类--</option>
                   <?php foreach($areas  as $k=>$v){
                       $html="<option value='$v[id]' ";
                       if($v['id']==$areaid){
                           $html=$html."selected = 'selected'";
                       }
                       $html=$html.">".KS_INDENT($v['depth'])."$v[city]</option>" ;
                       echo $html;
                   }?>             
           </select>
           </div>
          </div>
           <div class="form-group">
           <label class="col-sm-2 control-label">地区名称：</label>
           <div class="col-sm-4">
                 <input type="text" class="form-control" name="city">
           </div>
         
           </div>
           <div class="line line-dashed b-b line-lg pull-in"></div>
            <div class="form-group">
           <label class="col-sm-2 control-label">地区拼音：</label>
           <div class="col-sm-4">
                 <input type="text" class="form-control" name="ecity">
           </div>
           </div>
           <div class="line line-dashed b-b line-lg pull-in"></div>
            <div class="form-group">
           <label class="col-sm-2 control-label">首字母：</label>
           <div class="col-sm-2">
                <select class="form-control" name="letter" id="">
		           <option selected="selected" value="A">A</option>
		           <option value="B">B</option>
		           <option value="C">C</option>
		           <option value="D">D</option>
		          <option value="E">E</option>
		          <option value="F">F</option>
		          <option value="G">G</option>
		          <option value="H">H</option>
		          <option value="I">I</option>
		          <option value="J">J</option>
		          <option value="K">K</option>
		          <option value="L">L</option>
		          <option value="M">M</option>
		          <option value="N">N</option>
		          <option value="O">O</option>
		          <option value="P">P</option>
		          <option value="Q">Q</option>
		          <option value="R">R</option>
		          <option value="S">S</option>
		         <option value="T">T</option>
		          <option value="U">U</option>
		          <option value="V">V</option>
		          <option value="W">W</option>
		          <option value="X">X</option>
		         <option value="Y">Y</option>
		          <option value="Z">Z</option>
	          </select>
            </div>
            </div>
            <div class="line line-dashed b-b line-lg pull-in"></div>
             <div class="form-group">
             <label class="col-sm-2 control-label">排序：</label>
           <div class="col-sm-1">
               <input type="text" class="form-control" name="orderid" id="order" value="<?php echo $orderid ?>">


<!--               </select>-->
<!--                 <input type="text" class="form-control" name="orderid">-->
           </div>
             </div>
             <div class="line line-dashed b-b line-lg pull-in"></div>
            <div class="footer-page">
            <div class="col-sm-5"></div>
                            <div class="col-sm-3 mt10">
                                <button class="btn btn-primary btn-s-md fl" type="submit"><?php echo '确定添加' ?></button>
                                <a href="javascript:history.go(-1); fl" class="btn bt-gray btn-s-md">取消</a>
                            </div>
                        </div>
          </form>
   </div>
 </div>
</body>
</html>

<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script type="text/javascript">
 $.validator.setDefaults({
        submitHandler: function() {
             $("#myform").ajaxsubmit();
        }
    });
	
    $().ready(function() {
// 在键盘按下并释放及提交后验证提交表单
        $(".form-horizontal").validate({
            rules: {
                city: {
                    required: true,
                   
                },
                ecity: {
                    required: true,
                }
            },
            messages: {
                categoryname: {
                    required: "请输入分类名称",
                },
                categoryename: {
                    required: "请输入分类英文名称",
                }
            }	
        });
    });
</script>


<script>

    $('#parent_area').change(function(){

        var parentid =  $('#parent_area').val();
        $("#order").val("");
       
        var a ={
            parentid : parentid
        }

        var url ="<?php echo M_URL('Setting','getAreaOrderId'); ?>";
        $.ajax({
            type:"post",
            url:url,
            data:a,
            success:function(data,textStatus){
            $('#order').val(data);
             },
           error:function(){
            alert("发生了错误,请检查!");
           }
        })

    });

</script>
