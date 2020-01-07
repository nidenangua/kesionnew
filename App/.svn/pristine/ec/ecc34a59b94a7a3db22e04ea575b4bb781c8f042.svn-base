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
      //批量审核
     public function checkAction(){
         $id =ChkSQL(KS_S('check'));
         if(empty($id)){
             KS_INFO("请选择",0,'','',1);
         }
         $Data['check']=1;//通过
         foreach ($id as $k=>$v ){
             M('app_team_topic')->update($Data,"id=$v");
         }
         $url      =  KS_ComeUrl();
         ks_header($url,1);
//         KS_INFO("操作成功",0,$url);
     }
      //更改热门状态
     public function updatehotAction()
     {
		 $id =ChkClng(KS_S('id'));
         $hot =  M('app_team_topic')->getOne('is_hot',"where id='$id'");
		 if($hot==0){
		    $Data['is_hot']=1;
	        M('app_team_topic')->update($Data,"id=$id");
//		    echo "1";
		 } elseif($hot==1){
		    $Data['is_hot']=0;
		    M('app_team_topic')->update($Data,"id=$id");
//		    echo "0";
		 }
     }
    //更新状态
    public function updatestatusAction()
    {
        $id = ChkClng(KS_S("id"));//ID
        $db_id = ChkClng(KS_S("db"));//数据表
//        var_dump($status);die;
        switch ($db_id){
            case '1' :
                $db = 'app_team';
                break;
            case '2' :
                $db = 'app_team_topic';
                break;
            case '3' :
                $db = 'app_team_member';
                break;
            default:
                die('参数错误');
        }
        $model = M($db);
        $status = $model->getOne('status',"where id='$id' and wxid=$this->wxid and status!=-1");

        if($status==2||$status==0){
            $Data['status']=1;
            $model->update($Data,"id=$id and wxid=$this->wxid");
        }elseif($status==1){
            $Data['status']=2;
            $model->update($Data,"id=$id and wxid=$this->wxid");
        }
    }
     

	
	
	
	
	
	
}
