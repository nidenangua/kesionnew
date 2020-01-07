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
	//分类列表
    public function indexAction(){
		$options = $this->AppModel->getOptions('5','where parentid=0 and wxid='.$this->wxid);//分页参数设置
		$page    = Page($options); 
		$values  = $this->AppModel->getPage($page,'rootid,orderid','where parentid=0 and wxid='.$this->wxid);
        include  CURR_VIEW_PATH . "category_list.php";
    }
	//进入添加分类界面
	public function addCategoryAction(){
		$categoryid=!empty(KS_G("get.id")) ? KS_G("get.id"):0;
		$appcategory = $this->cache->GetHCache('appcategory',$this->wxid);//读出缓存
		include  CURR_VIEW_PATH . "category_add.php";
	}
	//添加分类
	public function doaddCategoryAction(){
		$Data['wxid']          = $this->wxid;
		$Data['userid']        = $this->userid;
		$Data['parentid']      = ChkClng(KS_G('post.parentid')); 
		$Data['categoryname']  = ChkSQL(KS_G('post.categoryname'));
		$Data['categoryename'] = ChkSQL(KS_G('post.categoryename'));
		$Data['intro']         = ChkSQL(KS_G('post.intro'));
		$Rule['categoryname']  = '分类名称|isEmpty';
		$Rule['categoryename'] = '分类英文名称|isEmpty,isEnglish';
		Chkpost($Data,$Rule,$this->AppModel);
		$this->AppModel->doaddCategory($Data,'categoryid');
		$this->cache->PutHCache('appcategory',$this->wxid);//写入缓存
		$url1 = M_URL($this->AppName.'/Index','addCategory',$Data['parentid'],GP(''));
		$url2 = M_URL($this->AppName.'/Index','index','',GP(''));exit;
		KS_INFO("添加成功，是否继续添加",1,$url1,$url2);
	}
	public function editCategoryAction(){
		$now_page    = ChkClng(KS_S('p',1));
		$categoryid  = ChkClng(KS_G('request.id'));
		$category    = $this->AppModel->getRow("where categoryid=$categoryid limit 1");
		$appcategory = $this->cache->GetHCache('appcategory',$this->wxid);//读出缓存
		include  CURR_VIEW_PATH . "category_add.php";
    }
	public function doeditCategoryAction(){
		$now_page              = KS_G('request.p'); 
	    $categoryid            = ChkClng(KS_G('request.id'));//表ID
		$Data['categoryname']  = ChkSQL(KS_G('post.categoryname'));
		$Data['categoryename'] = ChkSQL(KS_G('post.categoryename'));
		$Data['intro']         = ChkSQL(KS_G('post.intro'));
		$Rule['categoryname']  = '分类名称|isEmpty';
		$Rule['categoryename'] = '分类英文名称|isEmpty,isEnglish';
		Chkpost($Data,$Rule,$this->AppModel);
		$this->AppModel->update($Data,"categoryid=$categoryid");
		$this->cache->PutHCache('appcategory',$this->wxid);//写入缓存
		$url1 = M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
		KS_INFO("保存成功",0,$url1);
    }
	//删除
	public function delCategoryAction(){
		$now_page =  ChkClng(KS_S('p',1));   
	    $categoryid = ChkClng(KS_G('request.id'));//表ID
		$categoryRe = $this->AppModel->getRow("where categoryid=$categoryid limit 1");
		if($categoryRe['child']>0){
		$deleNum = $GLOBALS['db']->getOne("select count(*) from `$this->AppModel->table` where parentidpath like '%$categoryid,%' or categoryid=$categoryid");
		}else{$deleNum = 1;}
	    $this->AppModel->dodelCategory($categoryid,$wxid);
		$GLOBALS['db']->execSql("UPDATE `$this->AppModel->table` SET `child`=child-1 WHERE categoryid=$categoryRe[parentid]");
		if($categoryRe['parentid']==0){
			$GLOBALS['db']->execSql("UPDATE `$this->AppModel->table` SET `rootid`=rootid-1 WHERE rootid>$categoryRe[rootid] and wxid=$this->wxid");
		}else{
			$GLOBALS['db']->execSql("UPDATE `$this->AppModel->table` SET `orderid`=orderid-$deleNum WHERE orderid>$categoryRe[orderid] and rootid=$categoryRe[rootid]");
		}
		$this->cache->PutHCache('appcategory',$this->wxid);//写入缓存
		$url = M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
		ks_header($url);
	 } 
	 /*============================================================================================*/  
	 /*------------------------------------一级分类排序----------------------------------------------*/
	 /*============================================================================================*/  
	 public function byOneAction(){
		$options = $this->AppModel->getOptions('5','where wxid='.$this->wxid.' and parentid=0');//分页参数设置
		$page    = Page($options); 
		$appcategory = $this->AppModel->getPage($page,'rootid,orderid','where wxid='.$wxid.' and parentid=0'); 
		include  CURR_VIEW_PATH . "category_obyone.php";
     }
	 //一级排序，向上排
	 public function byOneUpAction(){
		$now_page   =  ChkClng(KS_S('p',1));
		$categoryid = ChkClng(KS_G('request.id'));
		$rootid     = ChkClng(KS_G('post.rootid'));
		$MoveNum    = ChkClng(KS_G('post.MoveNum'));
		$GLOBALS['db']->execSql("UPDATE `$this->AppModel->table` SET `rootid`=rootid+1 WHERE rootid>$rootid-$MoveNum-1 and rootid<$rootid and wxid=$this->wxid");
		$GLOBALS['db']->execSql("UPDATE `$this->AppModel->table` SET `rootid`=$rootid-$MoveNum WHERE parentidpath like '%$categoryid,%' or categoryid=$categoryid");
		$this->cache->PutHCache('appcategory',$this->wxid);//写入缓存
		$url        = M_URL($this->AppName.'/Index','byOne','',GP('p-'.$now_page));
		KS_INFO('修改成功',0,$url);
     }
	 //一级排序，向下排
	 public function byOneDownAction(){
		$now_page   =  ChkClng(KS_S('p',1)); 
		$categoryid = ChkClng(KS_G('request.id'));
		$rootid     = ChkClng(KS_G('post.rootid'));
		$MoveNum    = ChkClng(KS_G('post.MoveNum'));
		$GLOBALS['db']->execSql("UPDATE `$this->AppModel->table` SET `rootid`=rootid-1 WHERE rootid<$rootid+$MoveNum+1 and rootid>$rootid and wxid=$wxid");
		$GLOBALS['db']->execSql("UPDATE `$this->AppModel->table` SET `rootid`=$rootid+$MoveNum WHERE parentidpath like '%$categoryid,%' or categoryid=$categoryid");
        $this->cache->PutHCache('appcategory',$this->wxid);//写入缓存
		$url = M_URL($this->AppName.'/Index','byOne','',GP('p-'.$now_page));
		KS_INFO('修改成功',0,$url);
     }
	 /*============================================================================================*/  
	 /*------------------------------------N级分类排序----------------------------------------------*/
	  /*============================================================================================*/  
	 public function byAllAction(){
		$options = $this->AppModel->getOptions('10','where wxid='.$wxid);//分页参数设置
		$page    = Page($options); 
		$appcategory = $this->AppModel->getPage($page,'rootid,orderid','where wxid='.$wxid); 
		include  CURR_VIEW_PATH . "category_obyall.php";
     }
	  //N级排序，向上排
	 public function byAllUpAction(){
		$now_page   =  ChkClng(KS_S('p',1)); 
		$categoryid = ChkClng(KS_G('request.id'));
		$MoveNum    = ChkClng(KS_G('post.MoveNum'));
		//要修改排序的分类（祖先这一条记录）（在下方）
		$changeCate = $this->AppModel->getRow("where categoryid=$categoryid limit 1");	
		if($changeCate['child']>0){
			//要修改分类的长度（祖先和子孙的总长度）
			$changeLen = $GLOBALS['db']->getOne("select count(*) from `$this->AppModel->table` where parentidpath like '%$changeCate[parentidpath],%' or categoryid=$categoryid");
		}else{$changeLen=1;}//要修改分类的长度（祖先和子孙的总长度）
		//用修改分类（祖先这一条记录）的orderid和移动的数量查出	（最上方的分类）
	    $upCate = $GLOBALS['db']->getRow("select * FROM `$this->AppModel->table` where parentid=$changeCate[parentid] and orderid<=$changeCate[orderid] order by orderid desc limit $MoveNum,1");
		//（最上方分类）的orderid等于（第一个分类）的orderid
		$firstOrderid = $upCate['orderid'];
		//先把不是修改的分类（修改分类orderid减一到最上方的orderid这个范围）移下去--加	 
		$GLOBALS['db']->execSql("UPDATE `$this->AppModel->table` SET `orderid`=orderid+$changeLen WHERE orderid>=$firstOrderid and orderid<=$changeCate[orderid]-1 and rootid=$changeCate[rootid] and wxid=$wxid");
		//再把要修改的分类移上去（移多少？减
		//所以没修改前的orderid减去（要修改的分类）修改后的orderid就是要移动的数量了！！！完美
		$GLOBALS['db']->execSql("UPDATE `$this->AppModel->table` SET `orderid`=orderid-($changeCate[orderid]-$firstOrderid) WHERE parentidpath like '%$changeCate[parentidpath],%' or categoryid=$categoryid");			
	    $this->cache->PutHCache('appcategory',$this->wxid);//写入缓存
		$url = M_URL($this->AppName.'/Index','byAll','',GP('p-'.$now_page));
		KS_INFO('修改成功',0,$url);
     }
	  //N级排序，向上排
	 public function byAllDownAction(){
		$now_page   = ChkClng(KS_S('p',1)); 
		$categoryid = ChkClng(KS_G('request.id'));
		$MoveNum    = ChkClng(KS_G('post.MoveNum'));
		//要修改排序的分类（祖先这一条记录）（在上方）
		$changeCate = $this->AppModel->getRow("where categoryid=$categoryid limit 1");	
		if($changeCate['child']>0){
			//要修改分类的长度（祖先和子孙的总长度）
			$changeLen = $GLOBALS['db']->getOne("select count(*) from `$this->AppModel->table` where parentidpath like '%$changeCate[parentidpath],%' or categoryid=$categoryid");
		}else{$changeLen=1;}//要修改分类的长度（祖先和子孙的总长度）
		//用修改分类（祖先这一条记录）的orderid和移动的数量查出	（最下方的分类）
	    $lowCate = $GLOBALS['db']->getRow("select * FROM `$this->AppModel->table` where parentid=$changeCate[parentid] and orderid>=$changeCate[orderid] order by orderid asc limit $MoveNum,1");
		//查出最下方分类的长度
		$lowLen = $GLOBALS['db']->getOne("select count(*) from `$this->AppModel->table` where parentidpath like '%$lowCate[parentidpath],%' or categoryid=$lowCate[categoryid]");
		//（最下方分类）的orderid加上长度，等于（最后一个分类）的orderid
		$lastOrderid = $lowCate['orderid']+$lowLen-1;
		//先把不是修改的分类（修改分类orderid加上他的长度再加一到最下方的orderid这个范围）移上来--减	 
		$GLOBALS['db']->execSql("UPDATE `$this->AppModel->table` SET `orderid`=orderid-$changeLen WHERE orderid>=$changeCate[orderid]+$changeLen and orderid<=$lastOrderid and rootid=$changeCate[rootid] and wxid=$wxid");
		//再把要修改的分类移下去（移多少？加
		//(最后一个分类）的orderid减去（要修改的分类）的长度--求（最后一个分类）的现在的orderid
		//(要修改的分类)修改后的orderid等于最后一个分类的现在的orderid加一
		//所以（要修改的分类）修改后的orderid减去没修改前的orderid就是要移动的数量了！！！完美
		$GLOBALS['db']->execSql("UPDATE `$this->AppModel->table` SET `orderid`=orderid+$lastOrderid-$changeLen+1-$changeCate[orderid] WHERE parentidpath like '%$changeCate[parentidpath],%' or categoryid=$categoryid");		
		$this->cache->PutHCache('appcategory',$this->wxid);//写入缓存
		$url = M_URL($this->AppName.'/Index','byAll','',GP('p-'.$now_page));
		KS_INFO('修改成功',0,$url);
     }
}