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
class IndexController extends CommonController
{
	/*	
	 * 显示消息中心管理页面
	 */
	public function indexAction(){
		$wxtable   =   M('common_user_website');
		$keyword   =   ChkSQL(GF('keyword') ? GF('keyword'):'');
		$keytype   =   ChkSQL(GF('keytype') ? GF('keytype'):1);
		$stype     =   ChkClng(KS_S('type'),6);
		$status    =   ChkClng(GF('status') ? GF('status'):3);
		$now_page  =   ChkClng(GF('p') ? GF('p'):'1'); 
		$byname    =   ChkSQL(GF('byname') ? GF('byname'):'desc');
		if($status==3){ $where= ' where (a.status=1 or a.status=0)';}
	 	if($status==1){ $where= ' where a.status=1';}
	 	if($status==2){ $where= ' where a.status=0';}
	 	if($stype == 1){
			$where .= ' and a.type=1';
		}elseif($stype==2){
			$where .= ' and a.type=2';
		}elseif($stype==3){
			$where .= ' and a.type=3';
		}elseif($stype==4){
			$where .= ' and a.type=4';
		}elseif($stype==5){
			$where .= ' and a.type=5';
		}elseif($stype==6){
			$where .= ' and 1=1';
		}
	 	if($keytype==1){
	     	$where  = $where.' and b.sitename like "%'.$keyword.'%"';
		}elseif($keytype==2){
		  	$where  =  $where.' and a.title like "%'.$keyword.'%"';
		}
	    $now_page   =  ChkClng(KS_S('p',1));
	    $where      =  "as a left join `$wxtable->table` as b on a.wxid = b.wxid ".$where;
	    $options    =  $this->AppModel->getOptions('7',$where);//分页参数设置
		$page       =  Page($options);
		$infoary    =  $this->AppModel->getPage($page,'adddate '.$byname,$where,'a.id,b.sitename,a.title,a.type,a.adddate,a.sendnum,a.readnum,a.status');
       include  CURR_VIEW_PATH . "index.php";
	}
	/*
     * 单个删除
     */
    public function deleteAction(){
    	$recId          =  ChkClng(KS_G('request.id'));
    	$Data['status'] =  -1; 
    	$res            =  $this->AppModel->update($Data,'id='.$recId);
		$now_page       =  ChkClng(KS_S('p',1));		
		$url            =  M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));		
		ks_header($url);
    }
    /*
     * 批量删除
     */
    public function delmsgAction(){
    	$idAry          = ChkSQL(KS_G('post.id'));
    	$Data['status'] = -1;
    	foreach($idAry as $key =>$val){
    	  $res          =  $this->AppModel->update($Data,'id = '.$val);	
    	}
		$now_page       =  ChkClng(KS_S('p',1));		
		$url            =  M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));		
		KS_INFO("批量操作成功",0,$url);
    }
    /*
     * 按时间段删除
     */
    public function flowTimeAction(){
    	$now_page    =  ChkClng(KS_S('p',1));
    			
		$url         =M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
    	$time        =ChkSQL(KS_G('post.anytime'));
    	if(empty($time)){
    		KS_INFO("你还没有进行选择",0,$url);
    		exit;
    	}
    	if($time==10){
    		$pathtime = strtotime("-$time day");
    	}else{
    		$pathtime = strtotime("-$time month");
    	}
//  	var_dump($pathtime);
//  	exit;
    	$Data['status'] =  -1; 
    	$res            =  $this->AppModel->update($Data,'adddate < '.$pathtime);	   	
    	$now_page       =  ChkClng(KS_S('p',1));		
		$url            =  M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));		
		KS_INFO("执行成功",0,$url);
    }
    /**	
     * 显示修改页面，并绑定数据
     */
    public function changeAction(){
    	$msgid     =  ChkClng(null !==GF('id') ? GF('id'):'');
    	$now_page  =  ChkClng(KS_S('p',1));
		$wxtable   =  M('common_user_website');
		$where     =  "as a left join `$wxtable->table` as b on a.wxid = b.wxid WHERE a.id=".$msgid;
		$infoary   =  $this->AppModel->getRow($where,'a.id,b.sitename,a.title,a.content');
		include  CURR_VIEW_PATH . "index_detail.php";
    }
    /*
     * 保存修改信息
     */
    public function editAction(){
    	$title          =  ChkSQL(KS_G('post.title'));
    	$content        =  ChkSQL(KS_G('post.content'));
    	$id             =  ChkClng(null !==GF('id') ? GF('id'):'');
    	$now_page       =  ChkClng(KS_S('p',1));
    	$Data['title']  =  $title;
    	$Data['content'] = $content;
    	$infoary        =  $this->AppModel->update($Data,' id='.$id);
		$url            =  M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
		KS_INFO("修改成功",3,$url);
    }
    public function showstudentAction(){
    	$msgid       =  ChkClng(null !==GF('id') ? GF('id'):'');
    	$now_page    =  ChkClng(KS_S('p',1));
    	$studentstr  =  $this->AppModel->getOne('student','where id='.$msgid);
    	$newstr      =  str_replace('a','',$studentstr);
    	$newary      =  explode(',',$newstr);
//  	var_dump($newary);
    	$allAry      =  array();
    	$usertale    =  M('common_user');
    	foreach($newary as $key => $val){
    		$Data['userid']=$val;
//  		var_dump($val);
    		$Data['username']=$usertale->getOne('username','where userid='.$val);
    		$allAry[]=$Data;
    	}
    	include  CURR_VIEW_PATH . "index_data.php";
    	
    }
}
?>