<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<title>科汛在线教育</title>
<link href="<?php echo UOOT;?>Public/admin/css/kesion-common.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/admin/css/general.css" rel="stylesheet">
<link href="<?php echo UOOT;?>Public/app/css/form.css" rel="stylesheet">
<link href="//store.kesion.com/Public/admin/fonts/iconfont.css?<?php echoHash(); ?>" rel="stylesheet" />
<script src="<?php echo UOOT;?>Public/common/js/jquery.min.js"></script>
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content mt55 animated fadeIn"  >
    <div class="row">
        <div id="manage_top" class="menu_top_fixed height73 p15 " >
            <div class="ibox-title">
              	<h3 class="fl" ><?php echo $this->app['appname']; ?>
	                <ul id="tablist" class="ml20">
	                    <li <?php if($stat==3)echo "class='active'";?>><a href="<?php echo M_URL($this->AppName.'/Index','index','',GP("appid-$this->appid,status-3",true)); ?>"> 所有</a></li>
	                    <li <?php if($stat==1)echo "class='active'";?>><a href="<?php echo M_URL($this->AppName.'/Index','index','',GP("appid-$this->appid,status-1",true)); ?>">已审核</a></li>
	                    <li <?php if($stat==0)echo "class='active'";?>><a href="<?php echo M_URL($this->AppName.'/Index','index','',GP("appid-$this->appid,status-0",true)); ?>">待审核</a></li>
           		    </ul>
              	</h3>
                <div class="fr">
		            <div class="fl ks-top-search">
					<!--搜索-->
					<?php if($this->wxid!==''){ ?>
					<select class="inputText bRadius5 fl" id="keytype" style="width: 150px;" onchange="getval(this,'<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','index');?>','categoryid','<?php echo URL_MODEL;?>');">
					    <?php if(isset($appcategory)){ ?>
                        <option value="0">请选择</option>
                        <?php foreach($appcategory as $k=>$v){?>
                        <option value="<?php echo $v['categoryid']; ?>" <?php if($v['categoryid']==$categoryid){ ?>selected = "selected"<?php }?>>
                        <?php echo KS_INDENT($v['depth']).$v['categoryname'];?>
                        </option>
                    	<?php }}else{ ?>
                        <option value="0">请选择</option>
                    	<?php } ?>
			  	    </select>
			  	    <?php } ?>
			  	    <select class="inputText bRadius5 fl" id="keytype" style="width: 150px;">
					   	<option value="1" <?php if($keytype==1) echo "selected"; ?>>标题</option>
                        <option value="2" <?php if($keytype==2) echo "selected"; ?>>录入员</option>
                        <option value="3" <?php if($keytype==3) echo "selected"; ?>>网校id</option>
			  	    </select>
					<form target="hidframe" class="fr">
						<input type="text" class="sc-text" id="keyword" value="<?php if(isset($keyword)) echo $keyword; ?>" placeholder="Search">
		            	<input type="submit" class="sc-button"onClick="searchByClass('<?php echo GP(''); ?>','<?php echo M_URL($this->AppName.'/Index','index'); ?>','<?php echo URL_MODEL;?>');" name="searchBtn" value="搜索">
					</form>
					<!--搜索-->
					</div> 
					<button type="button" class="ks-bt bt-def ml10"  onclick="history.go(-1)"><i class="iconfont icon-fanhui"></i>返回</button>
		        </div>
            </div>
        </div>
    </div>
    <div class="row"><br />
        <div class="col-sm-12 ">
            <div class="tabs-container">
                <div class="taps-button">
                    <div class="row btn-choice">
                      <a href="<?php if($hits==1){echo M_URL($this->AppName.'/Index','index','',GP('hits-0'));}else{echo M_URL($this->AppName.'/Index','index','',GP('hits-1'));} ?>"></a>
                      <div  id="choice">
                                <a href="<?php if($a==1){echo M_URL($this->AppName.'/Index','index','',GP('a-0'));}else{echo M_URL($this->AppName.'/Index','index','',GP('a-1'));} ?>">
                                    <button type="button" class='btn  btn-xs' style="position: absolute;right: 0;top:-10px;background: none;border: 1px solid #dbe2e7;"><i class="iconfont icon-filter-2"></i>属性筛选</button></a>
                                <div <?php if($a==1) {echo "class='row dis424 choice421'";}else{echo "class='row none424 choice421'";} ?>>
                                <div class="col-sm-12 ">
                                    <div class="form-group">
                                        <div class="col-sm-12 ">
                                            <!-- <a href=""></a>-->
                                            <div class="checkbox  checkbox-info" onClick="attributeSelect('<?php if($recommend==1){echo M_URL($this->AppName.'/Index','index','',GP('recommend-0'));}else{echo M_URL($this->AppName.'/Index','index','',GP('recommend-1'));} ?>')">
                                                <input id="c2" type="checkbox" <?php if($recommend==1){echo "checked";}?>>
                                                <label for="c2">推荐</label>
                                            </div>
                                            <div class="checkbox  checkbox-info" onClick="attributeSelect('<?php if($slide==1){echo M_URL($this->AppName.'/Index','index','',GP('slide-0'));}else{echo M_URL($this->AppName.'/Index','index','',GP('slide-1'));} ?>')">
                                                <input id="c3" type="checkbox" <?php if($slide==1){echo "checked";}?>>
                                                <label for="c3">幻灯</label>
                                            </div>
                                            <div class="checkbox  checkbox-info" onClick="attributeSelect('<?php if($roll==1){echo M_URL($this->AppName.'/Index','index','',GP('roll-0'));}else{echo M_URL($this->AppName.'/Index','index','',GP('roll-1'));} ?>')">
                                                <input id="c8" type="checkbox" <?php if($roll==1){echo "checked";}?>>
                                                <label for="c8">滚动</label>
                                            </div>
                                            <div class="checkbox  checkbox-info" onClick="attributeSelect('<?php if($allowcomment==1){echo M_URL($this->AppName.'/Index','index','',GP('allowcomment-0'));}else{echo M_URL($this->AppName.'/Index','index','',GP('allowcomment-1'));} ?>')">
                                                <input id="c5" type="checkbox" <?php if($allowcomment==1){echo "checked";}?> >
                                                <label for="c5">允许评论</label>
                                            </div>
                                            <div class="checkbox  checkbox-info" onClick="attributeSelect('<?php if($hot==1){echo M_URL($this->AppName.'/Index','index','',GP('hot-0'));}else{echo M_URL($this->AppName.'/Index','index','',GP('hot-1'));} ?>')">
                                                <input id="c6" type="checkbox" <?php if($hot==1){echo "checked";}?> >
                                                <label for="c6">热门</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <form target="hidframe" id="myform" action="<?php echo M_URL($this->AppName.'/Index','batch','',GP('p-'.$page->now_page)) ?>" method="post">
                    <div class="tab-content">
                      <div id="tab-1" class="tab-pane active" style="">
                        <div class="panel-body" style="padding:0">
                           <div class="row">
                              <div class="col-sm-12 ">
                                 <div class="ibox float-e-margins pt15">
                                    <div class="ibox-content">
                                     <table class="table table-bordered ">
                                        <thead>
                                        <tr>
                                            <th>序号</th>
                                            <th>网校ID</th>
                                            <!----------字段拼接-------->
                                            <?php echo $this->Field->getTH($this->appid,'app','admin');?>
											<th>特殊属性</th>
                                            <th>审核状态</th>
                                            <th>操作</th>
                                        </tr>
                                        </thead>
                                      <tbody>
                                      <?php foreach($values as $k=>$v){?>
                                        <tr>
                                        	
                                            <td>
                                                <div class="checkbox  checkbox-info" >
                                                    <input id="C<?php echo $v["id"];?>" type="checkbox" name="check[]" value="<?php echo $v["id"];?>" class="check0">
                                                    <label for="C<?php echo $v["id"];?>">
                                                     <?php echo $v["id"];?>
                                                    </label>
                                                </div>
                                            </td>
                                            <td><?php echo $v["wxid"];?></td>
                                            <!--------字段拼接--------->	
                                            <?php echo $this->Field->getTD($this->appid,'app','admin',$v);?>
											<!--------特殊属性--------->	
											<td><?php if($v["recommend"]==1){ ?><font color=green>荐</font>&nbsp;
                                            <?php }if($v["roll"]==1){ ?><font color=blue>滚</font>&nbsp;
                                            <?php }if($v["allowcomment"]==1){ ?><font color=pink>评</font>&nbsp;
                                            <?php }if($v["hot"]==1){ ?><font color=red>热</font>&nbsp;
                                            <?php }if($v["slide"]==1){ ?><font color=green>幻</font>&nbsp;
                                            <?php } ?>
                                            </td>
                                            <td style="width:200px">
                                            <?php if($v["status"]==1){ ?>
                                             <label class="txt-top">
                                                <a  class="ok-icon ok-pe1" href="<?php echo M_URL($this->AppName.'/Index','unaudited',$v['id'],GP('p-'.$page->now_page));?>" title="未审核"></a></label>
                                            <?php }else{ ?>
                                             <label class="txt-top">
                                                <a class="ok-icon ok-pe2" href="<?php echo M_URL($this->AppName.'/Index','audited',$v['id'],GP('p-'.$page->now_page));?>" title="审核"></a></label>
                                            <?php } ?>
                                            </td>
                                            <td style="width:200px"><label class="txt-top">
                                                <a href="<?php echo M_URL($this->AppName.'/Index','EditArticle',$v['id'],GP('userid-'.$v['userid'].',p-'.$page->now_page));?>"><i class='edit2017'></i></a></label>
                                                <label class="txt-top">
                                                <a href="javascript:void(0);" onclick="Confirm('是否删除此新闻？该操作不可逆！','<?php echo M_URL($this->AppName.'/Index','delect',$v['id'],GP('p-'.$page->now_page));?>')"><i class="delete2017"></i></a></label>
                                            </td>
                                        </tr>
                                     <?php } ?>
                                     </tbody>
                                    </table>
                                    <?php echo NoC($values);?> 
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="footer-page h60">
                                <div class="col-sm-5">
                                 <div class="checkbox fl checkbox-info" style="margin-top:20px;margin-right:10px">
                                    <input id="checkboxAll" name="check1" type="checkbox" class="check-all check0">
                                    <label for="checkboxAll">全选</label>
                                </div>
                                    <!--<button class="btn mt10 btn-default">
                                        <i class="icon iconfont">&#xe64f;</i>锁定
                                    </button>
                                    <button class="btn mt10 btn-default">
                                        <i class="icon iconfont">&#xe774;</i>解锁
                                    </button>-->
                                    <button class="btn mt10 btn-default" onClick="do_reg();" name="batch" value="2">批量审核</button>
                                    <button class="btn mt10 btn-default" onClick="do_reg();" name="batch" value="3">取消审核</button>
                                    <button class="btn mt10 btn-default" onClick="do_reg();" name="batch" value="1">批量删除</button>
                                </div>
                                <div class="col-sm-7" style="margin-top:7px"><?php echo $page->show(3);?></div>
                        </div>
                        <div id="tab-2" class="tab-pane">
                            <div class="panel-body"></div>
                        </div>
                      </div>
                    </div>
                </form>
           </div>
       </div>
    </div>
</div>
</script>
<script src="<?php echo UOOT;?>Public/common/js/common.js"></script>
<script>
	loadScorllJs();//滚轮
	var selectInputs = $('.check0');
	var checkAllInputs = $('.check-all')
	selectall(selectInputs,checkAllInputs)
	buttonTap()//按钮样式切换
    function attributeSelect(url){
        window.location.href=''+url;
    }
	$(function(){
		$('.table-bordered thead').find('th').each(function() {
            var thText = $.trim($(this).text());
			if(thText=='文章浏览量'){
				$(this).addClass('histClick');
				$(this).append('<a style="position:relative;top:3px" href="<?php if($hits==1){echo M_URL($this->AppName.'/Index','index','',GP('hits-0'));}else{echo M_URL($this->AppName.'/Index','index','',GP('hits-1'));} ?>"><img  src="<?php echo UOOT;?>Public/admin/images/<?php if($hits==1) {echo 'icon_排序升序.png';}else{echo 'icon_排序降序.png';} ?>" width="16" class="up pos3"></a>')
			}
        });
		$('.histClick').on('click',function(){});
	});
    function do_reg(){
	   $("#myform").submit();	
    }
</script>
</body>
</html>
