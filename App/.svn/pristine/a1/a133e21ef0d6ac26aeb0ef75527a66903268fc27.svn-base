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
}
