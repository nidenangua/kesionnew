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
		
		$userModel = M('common_user');
		
		$keyword=KS_S('keyword');
		
		$keytype=null !==GF('keytype') ? GF('keytype'):0;

        $where = '';

		if(!empty($keyword)){ 
		  
			if($keytype==1){
			  
			  $where.=' where b.username ='.$keyword;
			
			}elseif($keytype==2){
			  
			  $where.=' where b.mobile ='.$keyword;
			}		   
		 }else{
			 
			$where.=' where a.userid = 0 '; 
		}	
		
		$where = " as a left join $userModel->table as b on a.userid = b.userid $where ";
		
		$options = $this->AppModel->getOptions('8',$where);//分页参数设置
		
		$page = Page($options);
		
		$values = $this->AppModel->getPage($page,'id desc',$where,'b.username,a.*');
		
		include  CURR_VIEW_PATH . "index.php";
	 }
	  
	 // 进入知识点添加
	 public function addKpointAction(){
		
		if($this->userid!=''){
			
			$category = $this->cache->GetHCache('appcategory',$this->wxid);//读出缓存		
		
		}else{
			
			$userModel = M('common_user');
			
		    $this->userinfo = $userModel->getRow('where userid = 0 limit 1');
			
			$category = $this->cache->GetHCache('appcategory',$this->wxid);//读出缓存
			
		}	
		
	   $config = array('inputname'  =>  'categoryid',);

	   $Linkage = Linkage($config,$category);
		
		include  CURR_VIEW_PATH . "addKpoint.php";
	 }
	 //进行知识点添加
	  public function doaddKpointAction(){
		  
		$Data['userid'] = $this->userid; 
		
		$Data['categoryid'] = ChkClng(KS_G('post.categoryid'));
		
		$Data['title'] = ChkSQL(KS_G('post.title'));
		
		$Data['intro'] =  ChkSQL(KS_G('post.intro'));
		
		$this->AppModel->doadd($Data,'id');
		
		$url1=M_URL('kpoint/index','index','',GP(''));
			
		KS_INFO("添加成功",0,$url1);
		
	 }
	 //进入编辑
	 public function editKpointAction(){
		  
		 $now_page = ChkClng(KS_G('requst.p'));
		 
		 $id =ChkClng(KS_G('get.id'));
		 
		 $value =$this->AppModel->getRow('where id ='.$id.' limit 1');
		 
		  $config = array(
			
			'inputname'  =>  'categoryid',             
			'categoryid'  =>   $value['categoryid'],
	  	   
		   );
		
	   $category = $this->cache->GetHCache('appcategory',$this->wxid);//读出缓存
		
	   $Linkage = Linkage($config,$category);
		 
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
		
		$url1=M_URL('kpoint/index','index','',GP('p-'.$now_page));
			
		KS_INFO('',3,$url1);
		
		 
	}
	 //进行知识点删除
	 public function delKpointAction(){
		 
		 $now_page = ChkClng(KS_G('requst.p'));
		 
		$id =ChkClng(KS_G('get.id'));
		 	
		$this->AppModel->delete('id='.$id);
		
		$url1=M_URL('kpoint/index','index','',GP('p-'.$now_page));
		
		$html = "<script>location.href='".$url1."';</script>";
	      
	    echo $html;exit;
	}
	 
	 
	 //查找用户
	 public function selectUserAction(){
		
		
		$keyword=KS_S('keyword');
		
		$keytype=null !==GF('keytype') ? GF('keytype'):'';
		
		if(!empty($keyword)){
			
			$where=" and a.name like '%$keyword%'";
		
		}else{
		
            $where = '';
					
		}
         
		if($keytype ==1){
		
		$userModel = M('common_user_school');
		
		}else{
			
		$userModel = M('common_user_teacher');
		
		}
		
		$Model = M('common_user');
		
		$where = "as a left join $Model->table as b on a.userid = b.userid where parentid = 0 $where" ;
		
	
		//分页
		$options = $userModel->getOptions('10',$where);//分页参数设置
		
		$page = Page($options);
		
		$values = $userModel->getPage($page,'a.userid desc',$where);
		
		include  CURR_VIEW_PATH . "selectUser.php";
	}
	 
}
?>