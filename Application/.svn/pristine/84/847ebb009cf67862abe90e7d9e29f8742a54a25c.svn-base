<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php if(!isset($app)){echo '添加应用';}else{echo '修改应用';} ?></title>
<link rel="shortcut icon" href="favicon.ico"> 
<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
</head>
<style type="text/css">
	.btn-primary{background: #FF5507;border: 1px solid #FF5507;}
	.btn-default{background: #CCCCCC;color: #3A3D40 !important;}
</style>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
     <div id="manage_top " class="menu_top_fixed  ">
            <div class="ibox-title fl mr15 ml15">
                <h3 class="fl mr15"><?php if(!isset($app)){echo '添加应用分类';}else{echo '修改应用分类';} ?></h3>
                <a href="<?php echo M_URL('Offweb','showclassify'); ?>"><i class="up-level"></i>上一级</a>
            </div>
            <div class="ibox-tools" >
                <a href="javascript:void(0)" onclick="history.go(0)" class="collapse-link"><i class="reflash"></i></a>
            </div>
    </div><br/><br/><br/>
    <div class="row bg-white p15">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
              <div class="ibox-content">
                  <form target="hidframe" action="<?php if(!isset($category)){echo M_URL('Offweb','categoryManageDoSave');}else{echo M_URL('Offweb','categoryManageDoSave',$category['categoryid'],GP('p-'.$now_page));} ?>" method="post" class="form-horizontal">
                      <div class="form-group">
                          <label class="col-sm-2 control-label">所属分类</label>
                          <div class="col-sm-4">
                              <select name="parentid" <?php if(isset($category)){echo 'disabled'; } ?> class="form-control">
                                  <?php $html = '<option value="0">无--作为一级栏目</option>';
                            foreach($appcategory as $k=>$v){
                                if(!isset($category)){
                                     $html .= '<option value="'.$v['categoryid'].'">'.KS_INDENT($v['depth']).$v['categoryname'].'</option>';
                                }else{
                                    $html .= '<option value="'.$v['categoryid'].'"';
                                    if($category['parentid']==$v['categoryid']){$html .= 'selected="selected"';}
                                    $html .= ' >'.KS_INDENT($v['depth']).$v['categoryname'].'</option>';
                                }
                            }echo $html;?>
                              </select>
                          </div>
                      </div>
                      <div class="hr-line-dashed"></div>
                      <div class="form-group">
                          <label class="col-sm-2 control-label">分类名称</label>
                          <div class="col-sm-4">
                              <input type="text" class="form-control" name="categoryname" <?php if(isset($category))echo "value='$category[categoryname]'";  ?> />
                          </div>
                      </div>
                      <div class="hr-line-dashed"></div>
                      <div class="footer-page">
                          <div class="col-sm-12">
                              <div class="col-sm-5"></div>
                              <div class="col-sm-3 mt3">
                                  <button class="btn btn-primary btn-s-md" type="submit">
                                      <?php if(!isset($category)){echo '确定添加';}else{echo '确定修改';} ?>
                                  </button>
                                  <a href="<?php echo M_URL('Offweb','showclassify'); ?>" class="btn btn-default btn-s-md">取消</a>
                              </div>

                          </div>
                      </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
loadScorllJs();
</script>
<!--<script>
function select_category(obj){
	$(obj).find("option[value="+$(obj).val()+"]").attr("selected",true); 
		var url_=$("#category_url").val();
		//alert(url_);
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
</script>-->
</body>
</html>