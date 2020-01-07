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
class NewsController extends CommonController
{
	/*	
	 * 显示消息管理页面
	 */
	public function indexAction(){
		$table    = M('app_massage');
		$wxtable  = M('common_user_website');
		$keyword  = ChkSQL(GF('keyword') ? GF('keyword'):'');
		$keytype  = ChkSQL(GF('keytype') ? GF('keytype'):1);
		$type     = ChkClng(GF('type') ? GF('type'):3);
		$now_page = ChkClng(GF('p') ? GF('p'):'1'); 
		$byname   = ChkSQL(GF('byname') ? GF('byname'):'desc');
		if($type==3){ $where= ' where (a.type=1 or a.type=0)';}
	 	if($type==1){ $where= ' where a.type=1';}
	 	if($type==2){ $where= ' where a.type=0';}
	 	if($keytype==1){
	     	$where  = $where.' and b.sitename like "%'.$keyword.'%"';
		}elseif($keytype==2){
		  	$where  = $where.' and a.title like "%'.$keyword.'%"';
		}
	    $now_page   =  ChkClng(KS_S('p',1));
	    $where      =  "as a left join `$wxtable->table` as b on a.wxid = b.wxid ".$where;
	    $options    =  $table->getOptions('7',$where);//分页参数设置
		$page       =  Page($options);
		$infoary    =  $table->getPage($page,'addtime '.$byname,$where,'a.id,b.sitename,a.title,a.type,a.addtime');
       include  CURR_VIEW_PATH . "News/news_index.php";
	}
	/*
     * 单个删除
     */
    public function deleteAction(){
    	$recId         =  ChkClng(KS_G('request.id'));
    	$Data['type']  =  -1; 
    	$table         =  M('app_massage');
    	$res           =  $table->update($Data,'id='.$recId);
		$now_page      =  ChkClng(KS_S('p',1));		
		$url           =  M_URL('News','index','',GP('p-'.$now_page));		
		KS_INFO("你已成功删除",0,$url);
    }
    /*
     * 批量删除
     */
    public function delmsgAction(){
    	$idAry        =  ChkSQL(KS_G('post.id'));
    	$Data['type'] =  -1;
    	$table        =   M('app_massage');
    	foreach($idAry as $key =>$val){
    	  $res        =   $table->update($Data,'id = '.$val);	
    	}
		$now_page     =  ChkClng(KS_S('p',1));		
		$url          =  M_URL('News','index','',GP('p-'.$now_page));		
		KS_INFO("批量操作成功",0,$url);
    }
    /*
     * 按时间段删除
     */
    public function flowTimeAction(){
    	$now_page =  ChkClng(KS_S('p',1));
    			
		$url      =  M_URL('News','index','',GP('p-'.$now_page));
    	$time     =  ChkSQL(KS_G('post.anytime'));
    	if(empty($time)){
    		KS_INFO("你还没有进行选择",0,$url);
    		exit;
    	}
    	if($time==10){
    		$pathtime=strtotime("-$time day");
    	}else{
    		$pathtime=strtotime("-$time month");
    	}
//  	var_dump($pathtime);
//  	exit;
    	$table    =  M('app_massage');
    	$Data['type'] = -1; 
    	$res      =  $table->update($Data,'addtime < '.$pathtime);	   	
    	$now_page =  ChkClng(KS_S('p',1));		
		$url      =  M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));		
		KS_INFO("执行成功",0,$url);
    }
    public function changeAction(){
    	$msgid    =  ChkClng(null !==GF('id') ? GF('id'):'');
    	$now_page =  ChkClng(KS_S('p',1));
    	$table    = M('app_massage');
		$wxtable  = M('common_user_website');
		$where    = "as a left join `$wxtable->table` as b on a.wxid = b.wxid WHERE a.id=".$msgid;
		$infoary  = $table->getRow($where,'a.id,b.sitename,a.title,a.content');
		include  CURR_VIEW_PATH . "News/news_change.php";
    }
    public function editAction(){
    	$title    =  ChkSQL(KS_G('post.title'));
    	$content  =  ChkSQL(KS_G('post.content'));
    	$id       =  ChkClng(null !==GF('id') ? GF('id'):'');
    	$now_page =  ChkClng(KS_S('p',1));
    	$table    =  M('app_massage');
    	$Data['title'] = $title;
    	$Data['content'] = $content;
    	$infoary  =  $table->update($Data,' id='.$id);
		$url      =  M_URL('News','index','',GP('p-'.$now_page));
		KS_INFO("修改成功",3,$url);
    }
}






?>