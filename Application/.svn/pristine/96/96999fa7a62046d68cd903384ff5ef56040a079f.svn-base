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
class MassageController extends CommonController
{
	public function _initialize()
	{
		parent::_initialize();
		check_power($this->userinfo,'notice');
	}

	public function indexAction(){
	 	 $Massage    = M('app_massage');
		 $Massages   = $Massage->getAll('where wxid='.$this->wxid.' and (userid=0 or userid='.$this->userid.') order by addtime desc');
		 include  CURR_VIEW_PATH . "Massage/index.php";
	}
	public function postmassageAction(){
		$entrance = null !==GF('entrance') ? GF('entrance'):'0';
		$option   = null !==GF('option') ? GF('option'):'1';
		if($option==2){
			$db_user_group = M('common_user_group');
			$groupary = $db_user_group->getAll('where status!=-1 and wxid='.$this->wxid);
		}

		include  CURR_VIEW_PATH . "Massage/postmassage.php";
	}
	/**
	 * 站内消息列表
	 */
	public function postlistAction(){
		$entrance = KS_S('entrance');
		$option   = ChkClng(KS_S('option','1'));
		$now_page = $options['now_page'] = ChkClng(KS_S('p','1'));
		$keyword  = ChkSQL(KS_S('keyword'));
		$Data005['wxid'] = $this->wxid;
		$ExamModel       = M('App/MessageModel');
		$result          = $ExamModel->announceRecords($Data005);
		$page            = $result['page'];
		$Massages        = $result['Messages'];
		include  CURR_VIEW_PATH . "Massage/postlist.php";
	}
	public function editTypeAction(){
		$id           = ChkClng(KS_G('post.id'));
		$Massage      = M('app_massage');
		$data['type'] = 0;
		$Massages     = $Massage->update($data,'id='.$id);
		echo '1';
	}
	//发送消息
	public function dosendAction(){
		$entrance        = ChkClng(KS_S('entrance'));
		$option          = null !==GF('option') ? GF('option'):'1';
	    $chargetype      = KS_G('post.chargetype');
		$Data006['wxid'] = $this->wxid;
		$ExamModel       = M('App/MessageModel');
		$ExamModel->announce($Data006);
	}
	//批量删除消息
	public function delpostAction(){
		$option   = ChkClng(KS_S('option',1));
		$ids      = KS_G('post.check');
		if (empty($ids)) KS_INFO('请选择!',0,'','',1);
		$Data['status'] = -1;
		if($option==1){
			$Massage      = M('app_class_notice');
			foreach($ids as $k => $v){
				$Massage->update($Data,'id='.ChkClng($v).' and wxid='.$this->wxid);
			}
		}else{
			$Massage        = M('app_information');
			foreach($ids as $k => $v){
				$Massage->update($Data,'id='.ChkClng($v).' and wxid='.$this->wxid);
			}
		}
		KS_INFO('删除成功!',3,M_URL('Massage','postlist','',GP('option-'.$option)));
	}
	//删除单个消息
	public function delnoticeAction(){
		$option   = null !==GF('option') ? GF('option'):'1';
		$Data['status'] = -1;
		if($option==1){
			$Massage      = M('app_class_notice');
			$ids          = ChkClng(KS_G('get.id'));
			$Massage->update($Data,'id='.$ids.' and wxid='.$this->wxid);
		}else{
			$Massage      = M('app_information');
			$ids          = ChkClng(KS_G('get.id'));
			$Massage->update($Data,'id='.$ids.' and wxid='.$this->wxid);
		}
		ks_header(M_URL('Massage','postlist','',GP('option-'.$option)));
	}
	//进入编辑单个消息页面
	public function editnoticeAction(){
		$option   = ChkClng(KS_S('option',1));
		$ids      = ChkClng(KS_G('get.id'));
		$Data007['wxid'] = $this->wxid;

        if($option==1){
			$Massage      = M('app_class_notice');
			$notice=$Massage->getRow('where id='.$ids);
		}else{
			$Massage      = M('app_information');
			$notice=$Massage->getRow('where id='.$ids);
		}
		include  CURR_VIEW_PATH . "Massage/editnotice.php";
	}
	//编辑单个消息
	public function doeditnoticeAction(){
		$option          = ChkClng(KS_S('option',1));
		$Data['title']   = ChkSQL(KS_G('post.title'));
		$Data['content'] = ChkSQL(KS_G('post.content'));
		$Data['inputer'] = ChkSQL(KS_G('post.inputer'));
		$id = ChkClng(KS_G('get.id'));
		$Data['adddate'] = time();
		$Data['readnum'] = 0;
		$Data['isread'] = '';
		if($option==1){
			$Massage      = M('app_class_notice');
			$Massage->update($Data,'id='.$id);
			KS_INFO('发送成功!',3,M_URL('Massage','postlist','',GP('option-'.$option)));
		}else{
			$Massage      = M('app_information');
			$Massage->update($Data,'id='.$id);
			KS_INFO('修改成功!',3,M_URL('Massage','postlist','',GP('option-'.$option)));
		}
	}
	//已阅学员
	public function readerlistAction(){
		$option   = ChkClng(KS_S('option',1));
		$stytype  = ChkClng(KS_S('stytype',1)); 
		$where    ='where a.wxid ='.$this->wxid .' and a.usertype = 0';
		if($option==1){//已发送学员
			$Massage      = M('app_class_notice');
			$ids          = ChkClng(KS_G('get.id'));
			$notice       = $Massage->getRow('where id='.$ids.' limit 1');
			if($stytype==1){
				$student      = str_replace('a','',$notice['student']);
				$student      = !empty($student)?substr($student,0,strlen($student)-1):0;
				$where        .=" and a.userid in ($student)";
			}elseif($stytype==2){
			    $isread       = str_replace('a','',$notice['isread']);
			    $isread       = !empty($isread)?substr($isread,0,strlen($isread)-1):0;
				$where        .=" and a.userid in ($isread)";
			}
		}else{//已读学员
			$Massage      = M('app_information');
			$ids          = ChkClng(KS_G('get.id'));
			$notice       = $Massage->getRow('where id='.$ids.' limit 1');
			if($stytype==1){
				$student      = str_replace('a','',$notice['student']);
				$student      = !empty($student)?(',' ==substr($student,strlen($student)-1,1)?substr($student,0,strlen($student)-1):$student):0;
				$where        .=" and a.userid in ($student)";
			}elseif($stytype==2){
			    $isread       = str_replace('a','',$notice['isread']);
			    $isread       = !empty($isread)?substr($isread,0,strlen($isread)-1):0;
				$where        .=" and a.userid in ($isread)";
			}
		}
		$student       = array();
		$UserModel     = M('common_user');
		$userStudent   = M('common_user_member');
		//关键字搜索
		$keyword = KS_S('keyword');
		$keytype = null !==GF('keytype') ? GF('keytype'):0;
	    if(!empty($keyword)){
		    if($keytype==1){
		          $where.=" and a.username like '%$keyword%'";
	        }elseif($keytype==2){
				  $where.=" and b.name like '%$keyword%'";
			}
		}
		$where   = "as a left join $userStudent->table as b on a.userid = b.userid $where";
		$options = $UserModel->getOptions('9',$where);
		$page    = Page($options);
		$student = $UserModel->getPage($page,'a.userid desc',$where);
		include CURR_VIEW_PATH . "Massage/readerlist.php";
	}
	//站内信模板设置页
	public function configAction(){
		$information   = M('app_information');
		$numb          = $information->getOne('count(*)','where wxid = '.$this->wxid);
   	    $values        = $this->cache->GetHCache('massagemodel',$this->wxid);
   	    $massagemodel  = $this->cache->GetACache('massagemodel');
		include  CURR_VIEW_PATH . "Massage/massageconfig.php";
	}
	//编辑站内信模板
	public function editAction(){
		$id         = ChkSQL(KS_G('get.id'));
		if(empty($id)){KS_INFO('id不能为空');}
   	    $value      = $this->cache->GetH('massagemodel','id',$id,'',$this->wxid,true);
		$content    = ks_editor('content',$value['content']);
   	    include  CURR_VIEW_PATH . "Massage/modelEdit.php";
	}
	//进行站内信编辑操作
	public function doeditAction(){
		$id                = ChkSQL(KS_G('get.id'));
		if(empty($id)){KS_INFO('id不能为空');}
		$massageModel      = M('app_information_content');
		//$Data['model']     = ChkSQL(KS_G('post.model'));
		//$Data['modelname'] = ChkSQL(KS_G('post.modelname'));
		$Data['content']   = ChkSQL(KS_G('post.content'));
		$massageModel->update($Data,'id='.$id);
		$this->cache->PutHCache('massagemodel',$this->wxid);
		$url1 = M_URL('Massage','config','',GP(""));
		KS_INFO("保存成功",3,$url1);
	}
	//删除
    public function delmassageAction(){
   	    $id       = ChkSQL(KS_G("get.id"));
   	    if(empty($id)){KS_INFO('id不能为空');}
   	    $massageModel      = M('app_information_content');
		$now_page = ChkClng(KS_S('p',1));
		$massageModel->delete('id ='.$id);
		$this->cache->PutHCache('massagemodel',$this->wxid);//标题
		$url= M_URL('Massage','config','',GP('p-'.$now_page));
		ks_header($url);
    }
    //开通模板
    public function openmodelAction(){
   	    $id = ChkClng(KS_G("get.id"));
   	    if(empty($id)){KS_INFO('id不能为空');}
   	    $cachemodel        = $this->cache->GetA('massagemodel','id',$id,'',true);
   	    $Data['wxid']      = $this->wxid;
        $Data['userid']    = $this->userid;
        $Data['model']     = $cachemodel['model'];
        $Data['modelname'] = $cachemodel['modelname'];
        $Data['content']   = $cachemodel['content'];
        $Data['status']    = 1;
        $massageModel      = M('app_information_content');
   	    $massageModel->doadd($Data,"id");
   	    $this->cache->PutHCache('massagemodel',$this->wxid);//标题
   	    $url= M_URL('Massage','config','',GP('p-'.$now_page));
		ks_header($url);
    }
    //更新单个模板
	public function modelwitchAction(){
    	$id               = ChkClng(KS_G('get.id'));
    	if(empty($id)){KS_INFO('id不能为空');}
    	$status           = $this->cache->GetH('massagemodel','id',$id,'status',$this->wxid);
    	$massageModel     = M('app_information_content');
    	if($status==1){$Data['status'] = 0;}else{$Data['status'] = 1;}
    	$massageModel->update($Data,"id=$id and wxid=$this->wxid");
    	$this->cache->PutHCache('massagemodel',$this->wxid);
    	//$this->cache->PutHCache('smsmodel',$this->wxid);exit;
    }

    /**
     * 我的意见反馈列表
     */
    public function problemlistAction(){
    	$Massage    = M('common_feedback');
		$Massages   = $Massage->getAll('where wxid='.$this->wxid.' order by adddate desc');
    	include  CURR_VIEW_PATH . "Massage/problemlist.php";
    }


    public function ignoreallAction(){
    	$id           = KS_G('post.id');
    	$str = '';
		$Massage      = M('app_massage');
		foreach($id as $k =>$v){
			if($k==0){
				$str = $v;
			}else{
				$str = $str.','.$v;
			}
		}
		$data['type'] = 0;
		if($str){
			$Massages     = $Massage->update($data,'id in('.FilterIds($str).')');
		}
		$url = M_URL('Massage','index','',GP(''));
		KS_INFO('',3,$url);
    }
}