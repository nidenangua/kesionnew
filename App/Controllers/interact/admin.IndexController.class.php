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
class IndexController extends CommonController{
    public function indexAction(){
		$usertable = M('common_user')	;
		$keyword   = ChkSQL(GF('keyword') ? GF('keyword'):'');
		$keytype   = ChkSQL(GF('keytype') ? GF('keytype'):1);
		$stype     = ChkClng(GF('anonymous') ? GF('anonymous'):3);
		$status    = ChkClng(GF('status') ? GF('status'):3);
		$now_page  = ChkClng(GF('p') ? GF('p'):'1'); 
		$byname    = ChkSQL(GF('byname') ? GF('byname'):'desc');
		if($status==3){
		 	$where='where (a.status=0 or a.status=1)';
		}if($status==1){
		 	$where='where  a.status=1';
		}if($status==2){
		 	$where='where a.status=0';
	    }
		if($stype==3){
		 	$where=$where.' and (a.anonymous=0 or a.anonymous=1)';
		}if($stype==1){
		 	$where=$where.' and a.anonymous=1';
		}if($stype==2){
		 	$where=$where.' and a.anonymous=0';
		}
		if($keytype==2 && !empty($keyword) ){
	     	$where  = $where.' and b.username like "%'.$keyword.'%"';
		}elseif($keytype==1 && !empty($keyword) ){
		  	$where  =  $where.' and a.interact like "%'.$keyword.'%"';
		}
		$where      =  "as a left join `$usertable->table` as b on a.memberid = b.userid ".$where;
        $options = $this->AppModel->getOptions('6',$where);//分页参数设置
	    $page    = Page($options);
	    $values  = $this->AppModel->getPage($page,'adddate '.$byname,$where,'a.interactid,b.username,a.interact,a.grade,a.star,a.adddate,a.status,a.issolve,a.anonymous,a.replynum,a.type');
		include  CURR_VIEW_PATH . "index.php";  
	}
	/** 单个删除*/
	public function deloneAction(){
		$id=$now_page =  ChkClng(null !==GF('id') ? GF('id'):'');
		$Data['status'] = -1; 
    	$res=$this->AppModel->update($Data,'interactid='.$id);
		$now_page =  ChkClng(KS_S('p',1));		
		$url=M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));		
		ks_header($url);
	}
	/*批量删除*/
	public function deletepartAction(){
    	$idAry=ChkSQL(KS_G('post.id'));
    	$Data['status'] = -1;
    	foreach($idAry as $key =>$val){
    	  	$res=$this->AppModel->update($Data,'interactid = '.$val);	
    	}
		$now_page =  ChkClng(KS_S('p',1));		
		$url=M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));		
		KS_INFO("批量操作成功",0,$url);
	}	
	/*根据时间段批量删除*/
	public  function flowTimeAction(){
    	$now_page =  ChkClng(KS_S('p',1));		
		$url=M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
    	$time=ChkSQL(KS_G('post.anytime'));
    	if(empty($time)){KS_INFO("你还没有进行选择",0,$url,'',1);}
    	if($time==10){
    		$pathtime=strtotime("-$time day");
    	}else{
    		$pathtime=strtotime("-$time month");
    	}
    	$Data['status'] = -1; 
    	$res=$this->AppModel->update($Data,'adddate < '.$pathtime);	   		
		KS_INFO("执行成功",0,$url);
	}
	public function showreplyAction(){
		$keyword    =   ChkSQL(GF('keyword') ? GF('keyword'):'');
        $interactid = ChkClng(GF('id')); 
		$stype      =   ChkClng(GF('anonymous') ? GF('anonymous'):3);
		$now_page   =   ChkClng(GF('p') ? GF('p'):'1'); 
		$byname     =   ChkSQL(GF('byname') ? GF('byname'):'desc');
		$where =' where interactid='.$interactid;
		if($stype==3){
		 	$where=$where.' and (1=1)  and status=0';
		}if($stype==1){
		 	$where=$where.' and anonymous=1 and status=0';
		}if($stype==2){
		 	$where=$where.' and anonymous=0 and status=0';
		}
		if(!empty($keyword) ){
	     	$where  = $where.' and membername like "%'.$keyword.'%"';
		}
		$table=M('app_interact_reply');
        $options = $table->getOptions('6',$where);//分页参数设置
	    $page    = Page($options);
	    $values  = $table->getPage($page,'adddate '.$byname,$where,'replyid,interactid,adddate,anonymous,membername,reply');
		include  CURR_VIEW_PATH . "reply.php";  
	}
	/*单个删除回复 */
	public function deleterepAction(){
		$interactid = ChkClng(GF('questionid')); 
		$id=$now_page =  ChkClng(null !==GF('id') ? GF('id'):'');
		$Data['status'] = -1; 
		$table=M('app_interact_reply');
    	$res=$table->update($Data,'replyid='.$id);
		$now_page =  ChkClng(KS_S('p',1));		
		$url=M_URL($this->AppName.'/Index','showreply','',GP('p-'.$now_page.',id-'.$interactid));		
		ks_header($url);
	}
	/*批量删除回复*/
	public function delsomeReplyAction(){
    	$interactid = ChkClng(GF('questionid'));
    	$idAry=ChkSQL(KS_G('post.id'));
    	$Data['status'] = -1;
    	$table=M('app_interact_reply');
    	foreach($idAry as $key =>$val){
    	  	$res=$table->update($Data,'replyid = '.$val);	
    	}
		$now_page =  ChkClng(KS_S('p',1));		
		$url=M_URL($this->AppName.'/Index','showreply','',GP('p-'.$now_page.',id-'.$interactid));		
		KS_INFO("批量操作成功",0,$url);
	}	
	/*根据时间段批量删除回复*/
	public  function delbeforeAction(){
    	$interactid = ChkClng(GF('questionid'));
    	$now_page =  ChkClng(KS_S('p',1));		
		$url=M_URL($this->AppName.'/Index','showreply','',GP('p-'.$now_page.',id-'.$interactid));
    	$time=ChkSQL(KS_G('post.anytime'));
    	if(empty($time)){
    		KS_INFO("你还没有进行选择",0,$url,'',1);
    	}
    	if($time==10){
    		$pathtime=strtotime("-$time day");
    	}else{
    		$pathtime=strtotime("-$time month");
    	}
    	$Data['status'] = -1; 
    	$table=M('app_interact_reply');
    	$res=$table->update($Data,'adddate < '.$pathtime);	   		
		KS_INFO("执行成功",0,$url);
	}
}
  