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
        $where ="where wxid = $this->wxid";
        $keyword = KS_S('keyword');
		$keytype = null !==GF('keytype') ? GF('keytype'):0;
        if(!empty($keyword)){ 
	       if($keytype==1){  $where.=" and title like '%$keyword%'";}
		}		
       	$app_task = M('app_task');

        $options =$app_task->getOptions('12',$where);//分页参数设置
		$page = Page($options);
		$task = $app_task->getPage($page,' adddate desc',$where);
		$courseModel = M('app_course');
		$rateModel = M('app_course_rate');
		$answerModel = M('app_task_answer');
		foreach ($task as $k=>$v){
			$task[$k]['course_title'] = $courseModel->getOne('title',"where courseid=$v[courseid]");
			$task_count = $rateModel->getOne('count(id)',"where courseid=$v[courseid]");
			$hastask_count = $answerModel->getOne('count(id)',"where taskid=$v[id]");
			$task[$k]['count'] = $task_count.'/'.$hastask_count;
			$task[$k]['onevaluate'] = $answerModel->getOne('count(id)',"where taskid=$v[id] and status=0");
		}

        include  CURR_VIEW_PATH . "index.php";
    }

    //进行删除
    public function delTaskAction(){
	    $now_page = ChkClng(KS_S('p'));
	    $id = ChkClng(KS_G('get.id'));
	    $this->AppModel->delete('id ='.$id);
		M('app_task_answer')->delete("taskid=$id");
	    $url1=M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
	    KS_INFO("删除成功",0,$url1);
	}
    //批量删除	
    public function bathdelAction(){
	    $id = ChkSQL(KS_G("post.taskid"));
	    if(empty($id)){KS_INFO('请选择');}
	    $now_page = ChkClng(KS_S('p',1));
		$answerModel = M('app_task_answer');
	    foreach($id as $k=>$v){
			$this->AppModel->delete('id ='.$v);
			$answerModel->delete("taskid=$v");
		}
	    $url1=M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
	    KS_INFO("删除成功",0,$url1);
    }
    /*
     * 分享
     */
	public function shareAction()
	{
		include  CURR_VIEW_PATH . "share.php";
	}
	public function updatestatusAction()
	{
		$id = ChkClng(KS_G("get.id"));
		$status = $this->AppModel->getOne('status',"where id=$id and wxid=$this->wxid");
		if ($status==0){
			$this->AppModel->update(['status'=>1],"id=$id and wxid=$this->wxid");
		}else{
			$this->AppModel->update(['status'=>0],"id=$id and wxid=$this->wxid");
		}
		echo '1';
	}
}