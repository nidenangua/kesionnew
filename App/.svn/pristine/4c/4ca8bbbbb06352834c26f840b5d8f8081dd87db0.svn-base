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
      //审核
     public function auditedAction(){
		 
		$courseid =ChkClng(KS_G('get.id'));
		$status =  ChkClng(KS_G('post.status')); 
		 
		if($status==0){
		   $Data['status']=0;
	       $this->AppModel->update($Data,"courseid=$courseid");
		   echo "0";}
		elseif($status==2){
		   $Data['status']=2;
	       $this->AppModel->update($Data,"courseid=$courseid");
		   echo "2";}
     }
      //推荐
     public function recommendAction(){
		 
		$courseid =ChkClng(KS_G('get.id'));
		$recommend =  ChkClng(KS_G('post.recommend')); 
		 
		if($recommend==0){
		   $Data['recommend']=0;
	       $this->AppModel->update($Data,"courseid=$courseid");
		   echo "0";}
		elseif($recommend==1){
		   $Data['recommend']=1;
	       $this->AppModel->update($Data,"courseid=$courseid");
		   echo "1";}
     }
     
     //是否热门
     
      public function isCourseHotAction(){
		 
		$courseid =ChkClng(KS_G('get.id'));
		$hot =  ChkClng(KS_G('post.hot')); 
		 
		if($hot==0){
		   $Data['hot']=0;
	       $this->AppModel->update($Data,"courseid=$courseid");
		   echo "0";}
		elseif($hot==1){
		   $Data['hot']=1;
	       $this->AppModel->update($Data,"courseid=$courseid");
		   echo "1";}
     }
     
     //改变学生状态
     
     public function changeStatusAction(){
     	$courseid =ChkClng(KS_G('get.id'));
		$Data['status'] =  ChkClng(KS_G('post.status'));
		$this->AppModel->update($Data,"courseid=$courseid");
     	 echo "ok";
     	
     }
     
     
     
     
     
     //允许评论
      public function iscommonAction(){
		 
		$courseid =ChkClng(KS_G('get.id'));
		$iscommon =  ChkClng(KS_G('post.iscommon')); 
		 
		if($iscommon==0){
		   $Data['iscommon']=0;
	       $this->AppModel->update($Data,"courseid=$courseid");
		   echo "0";}
		elseif($iscommon==1){
		   $Data['iscommon']=1;
	       $this->AppModel->update($Data,"courseid=$courseid");
		   echo "1";}
     }
     
       //推荐
     public function slideAction(){
		 
		$courseid =ChkClng(KS_G('get.id'));
		$slide =  ChkClng(KS_G('post.slide')); 
		 
		if($slide==0){
		   $Data['slide']=0;
	       $this->AppModel->update($Data,"courseid=$courseid");
		   echo "0";}
		elseif($slide==1){
		   $Data['slide']=1;
	       $this->AppModel->update($Data,"courseid=$courseid");
		   echo "1";}
     }
	 //获取视频上传凭证
	 public function getAutherAction(){
		
	    $playvido = new Core\Playvdo();
		
		$return = $playvido->getUploadAuth();
	
		$vdo = json_decode($return);
		
		$filename = ChkSQL(KS_G('post.filename'));
		
		$filesize = ChkSQL(KS_G('post.filesize'));
		
		$Data['vdoId'] = $vdo->VideoId;
		
		$Data['vdoName'] = $filename;
		
		$Data['vdoSize'] = $filesize;
		
		$Data['userid'] = $this->userid;
		
		$Data['addDate'] = time();
		
		$vodModel = M('common_vdo');
		
		$id = $vodModel->doadd($Data,'id');
		
		echo $return;
		 
	} 
	//获取百度临时SK AK
	public function getBaiduAction(){
		
		 $upload =new Core\Baiduyun();
		 
		 $result = $upload->curl_upload();
		var_dump($result).die;
		 echo $result;

	}
	//发布
	function ReleaseAction(){
		$id= ChkClng(KS_G('post.id'));
		$taskModel = M('app_task');
		$Data['status']=1;
		$a = $taskModel->update($Data,' id='.$id);
		if($a==1){
			 echo 'success';
		}else{
			 echo 'error';
		}
	}
	
	
	
	
	
	//班级资料公开
	function isopenFileAction(){
		$id= ChkClng(KS_G('post.id'));
		$Data['isopen']= ChkClng(KS_G('post.value'));
		
		
		$fileModel =M('app_course_file');
		$line=$fileModel->update($Data,'id='.$id);
		
		if($line){
			$values='success';
			echo json_encode($values);
		}
	}
	//班级资料公开
	function isMaterialAction(){
		$id= ChkClng(KS_G('post.id'));
		$Data['isMaterial']= ChkClng(KS_G('post.value'));
		$uploadtableid = $this->cache ->GetA('domaininfo','wxid',$this->wxid,'uploadtableid');
	   $tablename      = $this->cache ->GetA('extable','tableid',$uploadtableid,'tablename');//取出关联表
	   $fileModel      = M($tablename);;
		$line=$fileModel->update($Data,'id='.$id);
		if($line){
			$values=$Data['isMaterial'];
			echo json_encode($values);
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
}
