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
    	$category = $this->cache->GetHCache('appcategory',$this->wxid);//读出缓存
		//实现不同要求页面跳转
    	$notestype=KS_S('status',3);
    	if($notestype==3){$where ="where (notestype = 0 or notestype = 1)";}
    	elseif($notestype==0){$where ="where notestype = 0";}
    	elseif($notestype==1){$where ="where notestype = 1";}
    	//搜索
		$keyword = ChkSQL(KS_S('keyword'));
		$keytype = ChkClng(KS_S('keytype',1));
	    //判断是否输入关键字
		if(!empty($keyword)){
		   if($keytype==1){$where.=" and notescreator like '%$keyword%'";}
		   elseif($keytype==2){$where.=" and notescoursename like '%$keyword%'";}
		   elseif($keytype==3){$where.=" and notesperiodname like '%$keyword%'";}
		   elseif($keytype==4){$where.=" and notescontent like '%$keyword%'";}
		}
		
		$options = $this->AppModel->getOptions('10',$where);//分页参数设置
		$page    = Page($options);
		$values  = $this->AppModel->getPage($page,'notesaddtime desc',$where);
		include  CURR_VIEW_PATH . "index.php"; 
	}
	//进入查看页面
	public function showNotesAction(){
		$id = ChkClng(KS_G("get.id"));
		$notesModel = M('app_notes'); 
    	$values = $notesModel -> getAll("where notesid = " .$id);
		include  CURR_VIEW_PATH . "showNotes.php";
	}

	//删除学员笔记
	public function delNotesAction(){
		$noew_page = ChkClng(KS_S('p',1));
		$id = ChkClng(KS_G("get.id"));
		$notesModel = M('app_notes')-> delete("notesid = " .$id);
		$url1= M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
		ks_header($url1);
	}
	public function batchNotesAction(){
		$notesModel = M('app_notes');
		$id         = isset($_POST["notesid"])?$_POST["notesid"]:'';
		if(empty($id)){KS_INFO("请选择");}
		foreach ($id as $k=>$v ){$notesModel->delete("notesid=$v");}
		$url      =  M_URL($this->AppName.'/Index','index','',GP(''));
		KS_INFO("删除成功",0,$url);
	}
		
}
  