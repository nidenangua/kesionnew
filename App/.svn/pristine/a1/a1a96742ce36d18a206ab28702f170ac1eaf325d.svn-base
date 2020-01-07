<hr />
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
	/* 页面数据显示*/
    public function indexAction(){
    	$keyword=null !==GF('keyword') ? GF('keyword'):'00';
    	$keytype=null !==GF('keytype') ? GF('keytype'):'1';
    	$byname = ChkSQL(GF('byname') ? GF('byname'):'desc');
		$status  = KS_S('status',3); 
		if($status == 2){$where = ' where a.issuccess = 0';}
	    elseif($status == 1){$where = ' where a.issuccess = 1';}
	    elseif($status == 3){$where = ' where (a.issuccess = 1 or a.issuccess = 0)';}
	    elseif($status == 4){$where = ' where a.status = -1';}
	    if(!empty($keytype) && $keyword!='00'){
	    	if($keytype==1){
			    $where="$where and b.username like '%$keyword%'";	    		
	    	}else if($keytype==2){
	    		$where="$where and a.email like '%$keyword%'";	
	    	}else  if($keytype==3){
				$where="$where and a.wxid=".$keyword;
			}
	    }
	    $left_join = M('common_user');
	    $where = "as a left join `$left_join->table` as b on a.userid = b.userid $where";
	    $singlepage=6;
        $options = $this->AppModel->getOptions($singlepage,$where);//分页参数设置
	    $page    = Page($options);
	    $values  = $this->AppModel->getPage($page,'adddate '.$byname,$where,'a.id,b.username,a.content,a.email,a.adddate,a.issuccess');
		include  CURR_VIEW_PATH . "index.php";  
	}
	/*单个删除*/
	public function deloneAction(){
		$emailid=ChkSQL(KS_G('request.id'));
		$Data['issuccess'] = -1; 
    	$res=$this->AppModel->update($Data,'id='.$emailid);
		$now_page =  ChkClng(KS_S('p',1));		
		$url=M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));		
		ks_header($url);
	}
	/*批量删除*/
    public function delsomeAction(){
    	$idAry=ChkSQL(KS_G('post.id'));
    	$Data['issuccess'] = -1;
    	foreach($idAry as $key =>$val){
    	  	$res=$this->AppModel->update($Data,'id = '.$val);	
    	}
		$now_page =  ChkClng(KS_S('p',1));		
		$url=M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));		
		KS_INFO("批量操作成功",0,$url);
    }	
    /*根据时间段批量删除*/
    public  function delpathAction(){
    	$now_page =  ChkClng(KS_S('p',1));		
		$url=M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
    	$time=ChkSQL(KS_G('post.anytime'));
    	if(empty($time)){
    		KS_INFO("你还没有进行选择",0,$url,'',1);
    	}
    	if($time==10){
    		$pathtime=strtotime("-$time day");
    	}else{
    		$pathtime=strtotime("-$time month");
    	}
    	$Data['issuccess'] = -1; 
    	$res=$this->AppModel->update($Data,'adddate < '.$pathtime);	   		
		KS_INFO("执行成功",0,$url);
    }
	//成绩导出
    public function emailexcelAction(){
    	$keytype = ChkClng(null !==GF('keytype') ? GF('keytype'):'3');
    	$keyword =  KS_S('keyword');
    	$byname =  ChkSQL(null !==GF('byname') ? GF('byname'):'desc');
    	$status =  ChkClng(null !==GF('status') ? GF('status'):'1');
		$paperid = ChkClng(KS_G('post.outtime'));
		if($status==3){ $where= ' where (a.issuccess=1 or a.issuccess=0)';}
	 	if($status==1){ $where= ' where a.issuccess=1';}
	 	if($status==2){ $where= ' where a.issuccess=0';}
	 	$left_join = M('common_user');
	 	$start = null !==KS_G('startime') ? KS_G('startime'):'';
		$endtime = null !==KS_G('endtime') ? KS_G('endtime'):'';
		$where = "as a left join `$left_join->table` as b on a.userid = b.userid $where";
		//根据搜索类型生成查询条件
		if($keytype==3){
			if($keyword!='00'){$where="$where and a.wxid=".$keyword;}
		}else if($keytype==1){
			if($keyword!='00'){$where="$where and b.username like '%$keyword%'";}
		}else if($keytype==2){
			if($keyword!='00'){$where="$where and a.email like '%$keyword%'";}
		}
		if($paperid==1){
			$options = $this->AppModel->getOptions('10',$where);//分页参数设置
		    $page = Page($options);
			$infoary = $this->AppModel->getPage($page,'adddate '.$byname,$where,'b.username,a.content,a.email,a.adddate,a.issuccess,a.memberip');
		}else if($paperid==2){
			$month = date('Y-m',time());
			$strtime = strtotime($month.'-01');
			$where=$where.' and adddate > '.$strtime;
			$infoary = $this->AppModel->getAll($where.' order by adddate '.$byname,'b.username,a.content,a.email,a.adddate,a.issuccess,a.memberip');
		}else if($paperid==3){
			$year = date('Y',time());
			$strtime = strtotime($year.'-01-01');
			$where=$where.' and adddate > '.$strtime;
			$infoary = $this->AppModel->getAll($where.' order by adddate '.$byname,'b.username,a.content,a.email,a.adddate,a.issuccess,a.memberip');
		}else if($paperid==4){
			$strtime = strtotime($start);
			$endtime = strtotime($endtime);
			$where=$where.' and adddate > '.$strtime.' and adddate < '.$endtime;
			$infoary = $this->AppModel->getAll($where.' order by adddate '.$byname,'b.username,a.content,a.email,a.adddate,a.issuccess,a.memberip');
		}
		foreach($infoary as $key =>$val){
		 	date_default_timezone_set("PRC");
		 	$infoary[$key]['adddate']=date('Y-m-d H:i:s',$val['adddate']);
		}
		$xlsName     = $infoary['0']['username'].'的邮件明细';//文件名
		$textRun     = $xlsName;//表名
		foreach($infoary as $k=>$v){$infoary[$k]['number'] = $k+1;}
		$xlsCell  = array(
			array('number','序号'),
			array('username','用户名'),
			array('content','邮件内容'),
			array('adddate','发送时间'),
			array('memberip','发送的ip地址'),
			array('issuccess','是否成功(0代表失败，1代表成功)'),
		);
		exportExcel($xlsName,$xlsCell,$infoary,$textRun);
	}
}