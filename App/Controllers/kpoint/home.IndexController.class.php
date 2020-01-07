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
    public function indexAction(){
		    $category = $this->cache->GetHCache('appcategory',$this->wxid);//读出缓存
		    $categoryModel = M('app_category');
		    $where = " as a left join $categoryModel->table as b on a.categoryid=b.categoryid where a.wxid = $this->wxid";
		    $categoryid =null !==GF('categoryid') ? GF('categoryid'):'0'; 
			  $keyword = ChkSQL(KS_S('keyword'));
			  $keytype = ChkClng(KS_S('keytype',1));
			  if(!empty($keyword)){if($keytype==1){$where.=" and  a.title like '%$keyword%'";}}
			  if($categoryid!=0){$where.="  and  (b.parentidpath like '%$categoryid,%' or b.categoryid=$categoryid)";}
			  $options = $this->AppModel->getOptions('8',$where);//分页参数设置
			  $page = Page($options);
			  $values = $this->AppModel->getPage($page,'id desc',$where,'a.*');
		  	include  CURR_VIEW_PATH . "index.php";
	 }
	 //批量处理
	 public function batchAction(){
				$id = ChkSQL(KS_G('id'));
				if(empty($id)){KS_INFO('请选择');}
				$now_page    = ChkClng(KS_S('p',1));
				$batch       = ChkClng(KS_G('post.batch')); 
				$url         = M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
				if($batch ==1){
				      foreach($id as $k=>$v){$id = ChkClng($v);$this->AppModel->delete("id=$v");}
					    KS_INFO('删除成功',0,$url);
				}
	 }
	 // 进入知识点添加
	 public function addKpointAction(){
				$Linkage = Linkage(array());
				$Linkage -> cachename  = 'appcategory';
				$Linkage -> wxid       =  $this->wxid;
				$Linkage -> inputname  = 'categoryid';
				include  CURR_VIEW_PATH . "addKpoint.php";
	 }
	 //进行知识点添加
	 public function doaddKpointAction(){
				$Data['userid'] = $this->userid; 
				$Data['wxid']   = $this->wxid; 
				$Data['categoryid'] = ChkClng(KS_G('post.categoryid'));
				$Data['title'] = ChkSQL(KS_G('post.title'));
				$Data['intro'] =  ChkSQL(KS_G('post.intro'));
				$this->AppModel->doadd($Data,'id');
				$url1=M_URL('kpoint/Index','index','',GP(''));
				KS_INFO("添加成功",0,$url1);
	 }
	 //进入编辑
	 public function editKpointAction(){
			 $now_page = ChkClng(KS_G('requst.p'));
			 $id       = ChkClng(KS_G('get.id'));
			 $value    = $this->AppModel->getRow('where id ='.$id.' limit 1');
		   $Linkage = Linkage(array());
			 $Linkage ->cachename   = 'appcategory';
			 $Linkage ->wxid        = $this->wxid;
			 $Linkage ->inputname   = 'categoryid';
			 $Linkage ->categoryid  = $value['categoryid'];
			 include  CURR_VIEW_PATH . "addKpoint.php";
	}
	//进行编辑
	public function doeditKpointAction(){
		   $id =ChkClng(KS_G('get.id'));
		   $now_page = ChkClng(KS_G('requst.p'));
		   $Data['categoryid'] = ChkClng(KS_G('post.categoryid'));
		   $Data['title'] = ChkSQL(KS_G('post.title'));
		   $Data['intro'] =  ChkSQL(KS_G('post.intro'));
		   $this->AppModel->update($Data,'id='.$id);
		   $url1=M_URL('kpoint/Index','index','',GP('p-'.$now_page));
			 KS_INFO('',3,$url1);
	}
	 //进行知识点删除
	 public function delKpointAction(){
		   $now_page = ChkClng(KS_G('requst.p'));
		   $id =ChkClng(KS_G('get.id'));
		 	 $this->AppModel->delete('id='.$id);
		   $url1=M_URL('kpoint/Index','index','',GP('p-'.$now_page));
		   $html = "<script>location.href='".$url1."';</script>";
	     echo $html;exit;
	}
	 //知识点应用配置
	public function settingAction(){
		   echo '知识点应用配置';exit;
	} 
}