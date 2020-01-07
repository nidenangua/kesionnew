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

namespace Kesion\Model\Application;
use Kesion\Model;
class VideoModel extends Model{
	public function lianmaibagain($channl,$memberid,$type=1){
		var_dump($channl['studentTable']).die;
		   $studenModel=M($channl['studentTable']);
	   	   $Data['memberid']=$memberid;
	   	   $Data['type']=$type;
	   	   $Data['starttime']=time();
	   	   if($channl['type']==2){
	   	   	   $Data['infoid']=$channl['classid'];
	   	   }else{
	   	   	   $Data['infoid']=$channl['courseid'];
	   	   }
	   	   $Data['scheduleid']=$channl['chapterid'];
	   	   $Data['status']=1;
	   	   $Data['wxid']=$channl['wxid'];
	   	   $Data['channlid']=$channlid;
		   $id = $studenModel->doAdd($Data,'id');
		   
		   
	}
	//连麦结束
	public function lianmaiend($channl,$id){
		   $studenModel=M($channl['studentTable']);
	   	   $Data['status']=2;
	   	   $Data['endtime']=time();
		   $studenModel->update($Data, ' id ='.$id);
	}
}