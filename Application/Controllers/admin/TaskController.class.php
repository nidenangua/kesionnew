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
class TaskController extends CommonController
{

     public function indexAction(){
     	$DB = M('common_task');
     	$where = 'where 1=1';
     	$adddate = 2;
     //	$now_page   =  null !==GF('p') ? GF('p'):1;
		$now_page =KS_S('p',1);
     	$options = $DB->getOptions('11',$where);//分页参数设置
		$page    = Page($options);
		$values  = $DB->getPage($page,'id desc',$where);
       	include CURR_VIEW_PATH . "Task/tasklist.php";
     }


     public function showaddAction(){
          $Dotask  = new \Core\Dotask();
          $alltypeary = $Dotask->getTaskType();
     	$id = ChkClng(KS_G('get.id'));
     	$DB = M('common_task');
     	$typeary = $DB->getAll('','type,id');
     	if($id>0){
     		$values = $DB->getRow('where id='.$id);
     		foreach($typeary as $k=>$v){
     			if($v['id']==$values['id']){
     				unset($typeary[$k]);
     			}
     		}
     	}
     	foreach($alltypeary as $k=>$v){
	     	foreach($typeary as $k1=>$v1){
	 			if($v['type']==$v1['type']){
                         if($v['type'] != 6 && $v['type'] != 9&& $v['type'] != 8){
                             unset($alltypeary[$k]);
                         }
	 				
	 			}
	 		}
 		}
		 if ($id<=0 && empty($alltypeary)){
			 KS_INFO("没有任务可以添加了！",0,M_URL('Task'));
		 }
     	include CURR_VIEW_PATH . "Task/addtask.php";
     }

     public function doaddtaskAction(){
     	$Data['content'] = ChkSQL(KS_G('post.content'));
     	$Data['name'] = ChkSQL(KS_G('post.name'));
     	if(empty($Data['content'])  || empty($Data['name'])){
     		KS_INFO('任务内容或者名称不能为空');
     	}
     	$Data['rewardway'] = ChkClng(KS_G('post.rewardway'));
     	$Data['link'] = KS_S('post.link');
     	$Data['type']      = ChkClng(KS_G('post.type'));
     	if(empty($Data['type'])){
     		KS_INFO('请正确选择任务类型');
     	}
          if($Data['type']==6 || $Data['type'] == 9){
              $Data['numerical'] = ChkClng(KS_G('post.numerical'));
          }
     	$Data['validity'] = ChkSQL(KS_G('post.validity'));
     	if($Data['rewardway']==2){
     		$Data['minmoney'] = ChkClng(KS_G('post.minmoney'));
     	    $Data['maxmoney'] = ChkClng(KS_G('post.maxmoney'));
     	}else{
     		$Data['money'] = ChkClng(KS_G('post.money'));
     	}
     	$Data['adddate'] = time();
     	$DB = M('common_task');
     	$DB->doadd($Data,'id');
     	 $url = M_URL('Task','index','',GP(''));
     	KS_INFO('添加成功',3,$url);
     }

     public function doedittaskAction(){
     	$id = KS_G('get.id');
     	$Data['content'] = ChkSQL(KS_G('post.content'));
     	$Data['name'] = ChkSQL(KS_G('post.name'));
     	if(empty($Data['content'])  || empty($Data['name'])){
     		KS_INFO('任务内容或者名称不能为空');
     	}
     	$Data['type'] = ChkClng(KS_G('post.type'));
     	if(empty($Data['type'])){
     		KS_INFO('请正确选择任务类型');
     	}
          if($Data['type']==6 || $Data['type'] == 9){
              $Data['numerical'] = ChkClng(KS_G('post.numerical'));
          }
     	$Data['rewardway'] = ChkClng(KS_G('post.rewardway'));
		$Data['link'] = KS_S('post.link');
     	$Data['validity'] = ChkSQL(KS_G('post.validity'));
     	if($Data['rewardway']==2){
     		$Data['minmoney'] = ChkSQL(KS_G('post.minmoney'));
     	    $Data['maxmoney'] = ChkSQL(KS_G('post.maxmoney'));
     	}else{
     		$Data['money'] = ChkSQL(KS_G('post.money'));
     	}
     	$DB = M('common_task');
     	$DB->update($Data,'id='.$id);
     	 $url = M_URL('Task','index','',GP(''));
     	KS_INFO('添加成功',3,$url);
     }

     public function alldelAction(){
     	$id           = KS_G('post.id');
    	     $str = '';
		$common_task      = M('common_task');
		foreach($id as $k =>$v){
			if($k==0){
				$str = $v;
			}else{
				$str = $str.','.$v;
			}
		}
		if($str){
			$common_task->delete('id in('.$str.')');
		}
		$url = M_URL('Task','index','',GP(''));
		KS_INFO('',3,$url);
     }

     public function delsingleAction(){
     	$id =ChkClng(KS_G('get.id'));
     	$common_task      = M('common_task');
     	$common_task->delete('id='.$id);
     	$url = M_URL('Task','index','',GP(''));
		KS_INFO('',3,$url);
     }
}