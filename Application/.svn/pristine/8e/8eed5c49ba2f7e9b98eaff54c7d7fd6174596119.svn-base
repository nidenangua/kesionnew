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
<script src="<?php echo UOOT;?>Public/common/js/jquery.js" type="text/javascript"></script>

</head>

<body >
<div class="contentBox bRadius10 bg-white w100">
  <div class="generalTitle">
     <!--<span class="roundBox mr10"><img src="<?php echo UOOT;?>Public/app/images/logo.png"></span>-->
	 <span class="gTitle fsize18 c-3e verAlignMiddle"><?php if($submit_type=='add') echo '添加分类'; else{echo '编辑分类';}?></span>
  </div>
  <div class="infoBox">
   <form target="hidframe"  action="<?php if($submit_type=='add'){ echo M_URL('category','doaddCategory');}else{echo M_URL('category','doeditCategory');} ?>" name="" method="post">
     <table width="100%" cellpadding="0" cellspacing="0" border="0" class="gTable">
	  <tr>
	     <td class="leftTd alignRight fsize14 c-92 w93 pt0">所属分类<div class="fsize12"><font color="red"><?php if($submit_type=='edit'){echo '*不能改其父类';}?></font></div></td>
		 <td class="rightTd alignLife pt0">
          <input hidden value="<?php echo M_URL('category','addCategory');?>" id="category_url">
          <input hidden name="parentid_data" id="parentid_data">
		   <div class="col-sm-4 category_list">
               
                    <?php 
					if($submit_type=='add'){
						echo '<select onChange="select_category(this)" class="bRadius5"><option value="0">无--作为一级栏目</option>';
						foreach($category as $k=>$v)
                        {
							echo "<option value='$v[categoryid]'>".KS_INDENT($v['depth'])."$v[categoryname]</option>";
                        }
						echo '</select>';
					}
					else{
						if($parentcategory!=0)
						{
							echo "<span class='fsize14'>".$parentidpath_list."</span>";
						}
						else{
							echo '<span class="fsize14">无--作为一级栏目</span>';
						}
					}
                    ?>
            </div>
           
		 </td>
         
	   </tr>
	   <tr>
	     <td class="leftTd alignRight fsize14 c-92 w93 pt0">分类名称</td>
		 <td class="rightTd alignLife pt0">
		   <input type="text" name="categoryname" value="<?php if($submit_type=='edit'){echo $category_row['categoryname'];}?>" class="inputText bRadius5">
		 </td>
	   </tr>
       <tr>
	     <td class="leftTd alignRight fsize14 c-92 w93 pt0">英文名称</td>
		 <td class="rightTd alignLife pt0">
		   <input type="text" name="categoryename" value="<?php if($submit_type=='edit'){echo $category_row['categoryename'];}?>" class="inputText bRadius5">
		 </td>
	   </tr>
       <tr>
	     <td class="leftTd alignRight fsize14 c-92 w93 pt0">介绍</td>
		 <td class="rightTd alignLife pt0">
         	<textarea name="intro" class="inputText bRadius5"><?php if($submit_type=='edit'){echo $category_row['intro'];}?></textarea>
		 </td>
	   </tr>
	   <tr>
	     <td class="leftTd alignRight w93"></td>
		 <td class="rightTd alignLife"><input type="submit" class="generalBtn c-fff fsize14 bRadius5" value="确认" name="confirm"><input type="reset" class=" ml30 generalBtn2 c-blue fsize14 bRadius5" value="取消" name="confirm"></td>
	   </tr>
	 </table>
   </form>
   <div class="hLh40"></div>
  </div>
</div>
</body>
</html>
<script>
function select_category(obj){
	$(obj).find("option[value="+$(obj).val()+"]").attr("selected",true); 
		var url_=$("#category_url").val();
		var select_='';//$('.category_list').html();
		$.ajax({
			url:url_,
			type:'get',
			dataType:"json",
			data:{
					'parentid':$(obj).val(),
					'post_type':'ajax'
			},
			success:function(json){
				if(json.length!=0){
					select_+='<select name="parentid"  class="bRadius5" onchange="select_category(this)">';
					$.each(json,function(index,element){
						select_+='<option value='+element.categoryid+'>'+element.categoryname+'</option>'
					})
					select_+='</select>';
				}
				$(obj).nextAll().remove();
				$(obj).parent('.category_list').append(select_);
				var se_length=$(".category_list select").length;
				var parentid_data=[];
				for(var i=0;i<se_length;i++){
					var parentid=$(".category_list select").eq(i).find("option:selected").val();
					parentid_data[i]=parentid;
				}
				$("#parentid_data").val(parentid_data);
			
			}
		})
}
</script>
