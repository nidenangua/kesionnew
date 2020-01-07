<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" href="favicon.ico">
    <link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
   <link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
  <link href="<?php echo UOOT;?>Public/admin/fonts/iconfont.css" rel="stylesheet">
  <link href="<?php echo UOOT;?>Public/admin/css/awesome-bootstrap-checkbox.css" rel="stylesheet">
    <script src="<?php echo UOOT;?>Public/common/js/jquery.js"></script>
    <title>应用分类</title>
   	<style>
    #manage_top ul {float:right;margin-right:15px}
	.page-box{margin-top:15px}
    </style>
</head>

<body class="gray-bg">
<div class="wrapper wrapper-content mt55 animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
               
                <div id="manage_top" class="menu_top_fixed height73 p15">
                        <h3 class="fl mr15">当前用户 :<?php if(!empty($values)){echo $values[0]['username'];}else{echo '无此用户';} ?></h3>
						<a class="btn btn-info btn-rounded btn-s-md mt5 mr15" href="<?php echo M_URL($this->AppName.'/Index','addKpoint','',GP('')); ?>" 
                        class="btn-submit"> 添加知识点</a> 
                        
                     <div class="search-main fr" style="margin-top:7px">
                          <div class="search-box w150 fl">
                             <label class="fl  control-label" style="line-height:30px">搜索</label>
                             <select class="form-control  input-sm w90  inline" id="keytype">
                                <option value="1" <?php if($keytype==1){echo 'selected="selected"';} ?>>用户名</option>
                               <option value="2" <?php if($keytype==2){echo 'selected="selected"';} ?>>用户手机号</option>
                             </select>
                    </div>
                    <div class="search-box w240 fl" >
                        <div class="input-group">
                            <input type="text" class=" form-control input-sm w180 fl" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>">
                          <span class="input-group-btn ">
                            <button class="btn btn-sm btn-default  fl" type="button" onclick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','index'); ?>','<?php echo URL_MODEL;?>')">Go!</button>
                          </span>
                        </div>
                    </div>
                </div>                        
                   
                 
                    </div>
                </div>

                <div class="ibox-content">
                  
                    <table class="table table-striped table-bordered table-hover CTable " id="editable">
                        <thead>
                        <tr>
                            <th style="width:10%">ID</th>
                            <th style="width:20%">名称</th>
                            <th style="width:20%">介绍</th>
                            <th style="width:10%">编辑</th>
                            <th style="width:10%">删除</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($values as $k=>$v){ ?>
                            <tr>
                               <td><div class="checkbox checkbox-info checkbox-inline">
                                        <input  type="checkbox" value="<?php echo $v['id'] ?>" name="id[]" id="kption<?php echo $v["id"]?>" >
                                        <label for="kption<?php echo $v["id"]?>"> <?php echo $v['id'] ?></label>
                                    </div>
                               </td>
                               <td><?php echo $v['title'] ?></td>
                               <td><?php echo $v['intro'] ?></td>
                               <td><a href="<?php echo M_URL($this->AppName.'/Index','editKpoint',$v['id'],GP('userid-'.$v['userid'].',p-'.$page->now_page)); ?>">
                                         <i class="edit2017"></i></a></td>
                               <td><a href="javascript:void(0);" onclick="Confirm('是否删除此试卷？该操作不可逆!','<?php echo M_URL($this->AppName.'/Index','delKpoint',$v['id'],GP('p-'.$page->now_page)); ?>')"><i class="delete2017"></i></a></td>
                            </tr>     
                       <?php } ?>     
                        </tbody>
                    </table>

                </div>




                <div class="footer-page h60">
                <div class="col-sm-5">
                	<div class="checkbox fl checkbox-info" style="margin-top:20px;margin-right:10px">
                    <input id="checkboxAll" name="check1" type="checkbox" class="check-all check0">
                    <label for="checkboxAll">
                     全选
                    </label>
                    </div>
                    <button class="btn mt10 btn-default" type="submit" value="1" name="type">批量删除</button>
                </div>
                    <?php echo $page->show(3); ?>
                </div>
            </div>

        </div>
    </div>
</div>
</div>
<br/>


</body>
</html>
<script src="<?php echo UOOT;?>Public/common/js/common.js" type="text/javascript"></script>