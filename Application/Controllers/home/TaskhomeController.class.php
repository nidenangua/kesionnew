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
class TaskhomeController extends CommonController
{   
     //任务列表显示
     public function indexAction(){
 		$DB        = M('common_task');
 		$DB_link   = M('common_task_link');
     	$where     = 'where id not in(select taskid from ks_common_task_link where  wxid='.$this->wxid.')';
		$values    = $DB->getAll($where.' order by id asc','');

     	$where1    = 'as a left join '.$DB->table.' as b on b.id=a.taskid where  a.wxid='.$this->wxid;
        $wcvalues  = $DB_link->getAll($where1.' order by a.complete asc','b.*,a.complete');
        foreach ($wcvalues as $k => $v) {
           if($v['complete']==0){
               if($v['type']==1){
                  $wcvalues[$k]['jumpurl'] = M_URL('User','realName');
               }elseif($v['type']==5){
                  $wcvalues[$k]['jumpurl'] = M_URL('Capital','withdraw');
               }else{
                  $wcvalues[$k]['jumpurl'] = '';
               }
           }else{
            $wcvalues[$k]['jumpurl'] = '';
           }
        }
        $allye       = $DB_link->getOne('sum(money)','where wxid='.$this->wxid.' and complete=1 and status=0 and effectivetime>'.time());
		$allye     = empty($allye)?'0.00':$allye;
       	include CURR_VIEW_PATH . "home_task.php";
    }
    //任务奖励列表
    public function rewardAction(){
    	$common_task_link = M('common_task_link');
    	$Data['status'] = 2;
    	$common_task_link->update($Data,' wxid='.$this->wxid.' and complete=1 and effectivetime<'.time());
    	$DB          = M('common_task');
    	$allye       = $common_task_link->getOne('sum(money)','where wxid='.$this->wxid.' and complete=1 and status=0 and effectivetime>'.time());
    	$allye     = empty($allye)?'0.00':$allye;
        $taskVoucher = $common_task_link->getAll(' as a left join '.$DB->table.' as b on a.taskid=b.id where a.wxid='.$this->wxid.' and  a.complete=1','a.*,b.name');
        include CURR_VIEW_PATH . "task_reward.php";
    }
    //任务领取
    public function receiveAction(){
    	$id           = ChkClng(KS_S('get.id'));
    	$db_task      = M('common_task');
		$db_task_link = M('common_task_link');
		$taskInfo = $db_task->getRow('where id='.$id);
		$wxTask       = $db_task_link->getRow('where taskid='.$taskInfo['id'].' and wxid='.$this->wxid.' and type='.$taskInfo['type']);
		if($wxTask){//已经做过任务了，打道回府
			return false;exit;
		}

		$Data['taskid'] = $taskInfo['id'];
		$Data['type'] = $taskInfo['type'];
		$Data['wxid'] = $this->wxid;
		if($taskInfo['rewardway']==1){
	    	$Data['money'] = $taskInfo['money'];
	    }else{
	    	$Data['money'] = rand($taskInfo['minmoney'],$taskInfo['maxmoney']);
	    }
	    $db_task_link->doadd($Data,'id');
	    $cache     = new \Core\Cache();
	    $cache->PutHCache('wxtask',$this->wxid);
      $Dotask  = new \Core\Dotask();
      $Dotask->checkTask($this->wxid,$Data['type']);//检查是否完成任务
	    KS_INFO('领取成功',0,M_URL('Taskhome'));
    }
}