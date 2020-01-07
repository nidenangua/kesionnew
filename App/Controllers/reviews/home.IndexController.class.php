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
    //评价应用列表
    public function indexAction(){
		$status =KS_S('status',3); 
	    $where  = 'where wxid ='.$this->wxid;
	    $where .= ' and status!=-1';
		if($status == 0){$where .= ' and status=0';}
		elseif($status == 1){$where .= ' and status=1';}
		
		//关键字搜索
		$keyword = KS_S('keyword');
		$keytype = null !==GF('keytype') ? GF('keytype'):0;
		
	    if(!empty($keyword)){ 
			    if($keytype==1){
			          $where.=" and reviews like '%$keyword%'";
		        }elseif($keytype==2){
					  $where.=" and membername like '%$keyword%'";
				}		   
		}		
		
        $options = $this->AppModel->getOptions('10',$where);//分页参数设置
	    $page = Page($options);
	    $values = $this->AppModel->getPage($page,'adddate desc',$where);
		include  CURR_VIEW_PATH . "index.php";  
	}
	//批量操作
	public function batchAction(){
		$id = ChkSQL(KS_G("post.id"));
		if(empty($id)){KS_INFO('请选择');}
		$now_page  = ChkClng(KS_S('p',1));
		$batch     = ChkClng(KS_G('post.batch')); 
		$url       = M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
		if($batch==1){//删除
			foreach($id as $k=>$v){
				 $Data['status']=-1;
				 $this->AppModel->update($Data,'reviewsid ='.$v);		
		    }
		    KS_INFO('批量删除成功',0,$url);
		}elseif($batch==2){//审核
			 $Data['status']=1;
			 foreach($id as $k=>$v){
		     $this->AppModel->update($Data,'reviewsid='.$v);
			 }
			 KS_INFO('审核成功',0,$url);
		}elseif($batch==3){
			 $Data['status']=0;
			 foreach($id as $k=>$v){
		     $this->AppModel->update($Data,'reviewsid='.$v);
			 }
			 KS_INFO('取消审核成功',0,$url);
		}
	}
	//删除单个评价
	public function delreviewsAction(){
		$id = ChkSQL(KS_G("get.id"));
		if(empty($id)){KS_INFO('请选择');}
		$Data['status']=-1;
		$this->AppModel->update($Data,'reviewsid ='.$id);	
		$now_page = ChkClng(KS_S('p',1));
		$url = M_URL($this->AppName.'/Index','Index','',GP('p-'.$now_page));
		ks_header($url);
	}
	//更新单个聊天状态
	public function updatestatusAction(){
		$id = ChkSQL(KS_G("get.id"));
		if(empty($id)){KS_INFO('请选择');}
		$status = $this->AppModel->getOne('status','where reviewsid ='.$id);
		if($status==1){$Data['status']=0;}elseif($status==0){$Data['status']=1;}
		$this->AppModel->update($Data,'reviewsid ='.$id);	
		echo $Data['status'];
	}  
	//评价应用配置
	public function settingAction(){
		echo '评价应用配置';exit;
	}
	//删除
	public function delAction(){
		$id = ChkSQL(KS_G("get.id"));
		$now_page = ChkClng(KS_S('p',1));
		$this->AppModel->delete('reviewsid ='.$id);	
		$url= M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
		KS_INFO('操作成功',0,$url);
	}  
}
  