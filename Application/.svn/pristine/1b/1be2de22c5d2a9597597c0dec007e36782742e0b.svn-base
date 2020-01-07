<?php
// +----------------------------------------------------------------------
// | 科汛教育微门户
// +----------------------------------------------------------------------
// | Copyright (C) 2017-2019 kesion.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 厦门科汛软件有限公司
// +----------------------------------------------------------------------
// | Advice: 好的编程习惯是成功的一半，对齐，注释  你可以的！
// +----------------------------------------------------------------------



use Kesion\Controller;
class AjaxController extends CommonController
{
	 public function getC_ChildAction(){
		$now_page   =  ChkClng(KS_S('p',1)); 
		$Parentid   = ChkClng(KS_G('post.Parentid')); 
		$Controller = ChkSQL(KS_G('post.Controller'));
		switch($Controller){
			case 'AppCategory':
			   $CategoryModel = M('common_app_categoryid');
	           $values        = $CategoryModel->getAll("where parentid=$Parentid ORDER BY rootid,orderid");
			   break;
			case 'UsersCategory':
			   $CategoryModel = M('common_user_category');
	           $values        = $CategoryModel->getAll("where parentid=$Parentid ORDER BY rootid,orderid");
			   break;
			case '':break; 
			case '':break;   
			default:
			   echo '分类类型没写';exit;
		}
		$html = '';
		foreach($values as $k=>$v){
		   $html .= "<tr class='gradeX' attr='$v[parentidpath]' id='sub$v[categoryid]'>
					<td>$v[categoryid]</td>
					<td class='Ctd' onclick=\"getC_Child('".M_URL('Ajax','getC_Child','',GP('p-'.$now_page))."','$v[categoryid]','$Controller');\">";
		   if($v['child']>0)
		   {		
			  $html .= KS_INDENT($v['depth'])."<a id='C$v[categoryid]' ckdata='0' at='$v[parentidpath]' attr=''><i class='close2017'></i></a>";
		   }else{
				$html .= KS_INDENT($v['depth'])."<a id='C$v[categoryid]' ckdata='1' at='$v[parentidpath]' attr=''><i class='open2017'></i></a>";
		   }
		   $html .= "$v[categoryname]</td>
					<td>$v[categoryename]</td>
					<td>$v[intro]</td>
					<td class='center'>$v[orderid]</td>
					<td class='center'><a href='".M_URL($Controller,'editCategory',$v['categoryid'],GP('p-'.$now_page))."'><i class='edit2017'></i></a></td>
					<td class='center'><a href='javascript:void(0);' onclick=\"Confirm('是否删除此分类？该操作不可逆！请确保该分类下无产品','".M_URL($Controller,'deleteCategory',$v['categoryid'],GP('p-'.$now_page))."')\"><i class='delete2017'></i></a></td>
				</tr>";
		}
	    header('Content-type: application/json');
        echo json_encode($html);
     } 
	 public function getHideAction(){
		 $userid     = ChkClng(KS_G('post.userid')); 
		 $usertype   = ChkClng(KS_G('post.usertype')); 
		 $tableModel = M('common_table');
		 $usersModel = M('common_user');
		 if($usertype == 0){
		    $tableid = $tableModel->getOne('tableid',"where tablename='common_user_member'");
		 }elseif($usertype == 1){
			$tableid = $tableModel->getOne('tableid',"where tablename='common_user_teacher'");
			$teacherModel = M('common_user_teacher');
			$userinfo = $usersModel->getRow("as a left join `$teacherModel->table` as b on a.userid = b.userid WHERE a.userid =$userid limit 1");
		 }elseif($usertype == 2){
			$tableid = $tableModel->getOne('tableid',"where tablename='common_user_school'");
			$schoolModel = M('common_user_school');
			$userinfo = $usersModel->getRow("as a left join `$schoolModel->table` as b on a.userid =b.userid WHERE a.userid =$userid limit 1");
		 }
		 $html = '';
		 $html .= '<div class="console-hide" id="Hide_'.$userid.'">
            <div class="tabs-container">
                <ul class="nav nav-tabs">
                    <li class="active" onclick="des(this,'.$userid.');"><a href="#">基本信息</a></li>
                    <li onclick="des(this,'.$userid.');"><a href="#">登记记录</a></li>
                    <li onclick="des(this,'.$userid.');"><a href="#">购买应用</a></li>
                </ul>
                <div class="tap-content">
                    <div class="tab-pane tabpane'.$userid.'" style="display: block">
                        <div class="panel-body">
                            <div class="console-box">
                                <div class="hide-left">
                                    <div class="hide-picture">
                                        <img src="';
	     if(!empty($userinfo["defaultpic"])){$html .= $userinfo['defaultpic'];}else{ $html .=  UOOT.'Public/uploads/common/defuser.jpg';}				
							$html .= '" class="con-img">
                                    </div>
                                </div>
                                <div class="hide-right">
                                    <h3>';$html .= $userinfo['name'].'('.$userinfo['name'].')';$html .='</h3>
                                    <p class="hide-txt">教师职称：<label class="hide-label">教授</label></p>
                                    <p class="hide-txt">联系QQ：<label class="hide-label">1203526512</label></p>
                                    <p class="hide-txt">联系微信：<label class="hide-label">cgh1225</label></p>
                                    <p class="hide-txt">注册时间：<label class="hide-label">';$html .= KS_DATE($userinfo['regdate']);$html .='</label></p>
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="tab-pane tabpane'.$userid.'" >
                        <div class="panel-body">
                            <div class="console-box">
                                <div class="panel-body" style="padding: 40px">
                            <table class="table" >
                                <thead>
                                <tr><th>登入设备</th><th>用户名</th><th>登入时间</th><th>登入IP</th><th>备注说明</th></tr>
                                </thead>
                                <tbody>
                                <tr><td>PC端</td><td>Carrie</td><td>2017/2/1 15:21:10</td><td>127.0.0.1</td><td>重复登入账户退出</td></tr>
                                <tr><td>PC端</td><td>Carrie</td><td>2017/2/1 15:21:10</td><td>127.0.0.1</td><td>重复登入账户退出</td></tr>
                                </tbody>
                            </table>
                        </div>
                            </div>
                        </div>
                    </div>
					<div class="tab-pane tabpane'.$userid.'" >
                        <div class="panel-body">
                               <div class="banner-pd clearfix">
                        <div id="carousel">
                            <div class="carousel-scroll">
                                <ul class="banner-content">
                                    <li class="banner-item">
                                        <div class="box-content">
                                            <div class="box-img">
                                                <div class="mouse-hide">
                                                    <a class="mouse-a" onclick="addFast(this,\'在线直播\',\'#\')" data-flag="0"><em class="seticon">设置为快捷方式<i class="arrow-down"></i></em><i class="iconfont ml10"></i></a>
                                                    <a class="c-fff r-icon posRe fr" href=""><em>删除<i class="arrow-down"></i></em><i class="iconfont mr10"></i></a>
                                                </div>
                                                <img class="mouse-img" src="./Public/admin/images/course2.jpg">
                                            </div>
                                            <div class="info-box">
                                                <h2 class="info-title">在线直播</h2>
                                                <div class="data-time">您的使用期限剩下：<span class="f-color">22天</span>
                                                </div>
                                                <div class="mt30">
                                                    <a href="" class="btn btn-primary" style="width: 100%" >查看详情</a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="banner-item">
                                        <div class="box-content">
                                            <div class="box-img">
                                                <div class="mouse-hide">
                                                    <a class="mouse-a" onclick="addFast(this,\'在线直播\',\'#\')" data-flag="0"><em class="seticon">设置为快捷方式<i class="arrow-down"></i></em><i class="iconfont ml10"></i></a>
                                                    <a class="c-fff r-icon posRe fr" href=""><em>删除<i class="arrow-down"></i></em><i class="iconfont mr10"></i></a>
                                                </div>
                                                <img class="mouse-img" src="./Public/admin/images/course2.jpg">
                                            </div>
                                            <div class="info-box">
                                                <h2 class="info-title">在线直播</h2>
                                                <div class="data-time">您的使用期限剩下：<span class="f-color">22天</span>
                                                </div>
                                                <div class="mt30">
                                                    <a href="" class="btn btn-primary" style="width: 100%" >查看详情</a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="banner-item">
                                        <div class="box-content">
                                            <div class="box-img">
                                                <div class="mouse-hide">
                                                    <a class="mouse-a" onclick="addFast(this,\'在线直播\',\'#\')" data-flag="0"><em class="seticon">设置为快捷方式<i class="arrow-down"></i></em><i class="iconfont ml10"></i></a>
                                                    <a class="c-fff r-icon posRe fr" href=""><em>删除<i class="arrow-down"></i></em><i class="iconfont mr10"></i></a>
                                                </div>
                                                <img class="mouse-img" src="./Public/admin/images/course2.jpg">
                                            </div>
                                            <div class="info-box">
                                                <h2 class="info-title">在线直播</h2>
                                                <div class="data-time">您的使用期限剩下：<span class="f-color">22天</span>
                                                </div>
                                                <div class="mt30">
                                                    <a href="" class="btn btn-primary" style="width: 100%" >查看详情</a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="banner-item">
                                        <div class="box-content">
                                            <div class="box-img">
                                                <div class="mouse-hide">
                                                    <a class="mouse-a" onclick="addFast(this,\'在线直播\',\'#\')" data-flag="0"><em class="seticon">设置为快捷方式<i class="arrow-down"></i></em><i class="iconfont ml10"></i></a>
                                                    <a class="c-fff r-icon posRe fr" href=""><em>删除<i class="arrow-down"></i></em><i class="iconfont mr10"></i></a>
                                                </div>
                                                <img class="mouse-img" src="./Public/admin/images/course2.jpg">
                                            </div>
                                            <div class="info-box">
                                                <h2 class="info-title">在线直播</h2>
                                                <div class="data-time">您的使用期限剩下：<span class="f-color">22天</span>
                                                </div>
                                                <div class="mt30">
                                                    <a href="" class="btn btn-primary" style="width: 100%" >查看详情</a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                              
                            </div>
                        </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
		header('Content-type: application/json');
        echo json_encode($html);
	 }
	 //为网校后台开通
	 public function addCart2Action(){
		$appid      = ChkClng(KS_G('post.appid')); 
		$wxid       = ChkClng(KS_G('post.wxid')); 
		$Controller = ChkSQL(KS_G('post.Controller')); 
		$appinfo    = $this->cache->GetA('appinfo','appid',$appid,'',true);
		$Data['userid']     = 0;
		$Data['wxid']       = $wxid;
		$Data['appid']      = $appinfo['appid'];
		$Data['appname']    = $appinfo['appname'];
		$Data['defaultpic'] = $appinfo['defaultpic'];
		$Data['price'] = $appinfo['price'];
		$Data['adddate'] = time();
		
	    $shopModel = M('common_cart');
		$count = $shopModel->getOne('count(*)',"where wxid=$wxid and appid=$appid limit 1");
		if($count==0){
			$shopModel->doAdd($Data,'id');
			$result['result']    = 'ok';
			$result['value']     = $shopModel->getRow("where wxid=$wxid and appid=$appid limit 1");
			$result['cartnum']   = $shopModel->getOne('count(*)',"where wxid=$wxid");
			$cartmoney = $shopModel->getOne('sum(price)',"where wxid=$wxid");
			$result['cartmoney'] = number_format($cartmoney,2);
			$result['value']['adddate'] = date('Y-m-d',Checktime($wxid,$appid));  
		}else{
			$result['result']  = 'err';
		}
	    header('Content-type: application/json');
		echo json_encode($result);
    } 
    public function delCartAction(){
		$appid     = ChkClng(KS_G('post.appid')); 
		$wxid      = ChkClng(KS_G('post.wxid')); 
	    $shopModel = M('common_cart');
		$shopModel->delete("wxid=$wxid and appid=$appid");
		$count = $shopModel->getOne('count(*)',"where wxid=$wxid");
		$result['result']    = 'ok';
		$result['cartnum']   = $count;
		$cartmoney = $shopModel->getOne('sum(price)',"where wxid=$wxid");
		$result['cartmoney'] = number_format($cartmoney,2);
	    header('Content-type: application/json');
		echo json_encode($result);
    } 
}
