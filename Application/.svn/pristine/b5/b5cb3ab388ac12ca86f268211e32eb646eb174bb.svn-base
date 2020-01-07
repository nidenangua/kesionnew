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
class ContentController extends CommonController{

    /****************************************************************开发动态 begin**********************************************************/
    /**
     * 开发动态管理         (其它模块参考此开发，注意 添加、修改用 "模块名+ManageAction" ，对应的保存用 "模块名+ManageDoSaveAction")
     */
	public function developListAction(){
		$keyword    = KS_S('keyword');
		$keytype    = ChkClng(KS_S('keytype',1));
		$Mode       = M('common_massage');
		$now_page   = ChkClng(KS_S('p',1));
		$adddate    = ChkClng(KS_S('adddate',1));;
		$orderby[GN('adddate')]       = 'adddate/a.adddate';
		$where = '';
		if($keyword){
			if($keytype==1){
				$where = ' where c.username like "%'.$keyword.'%"';
			}elseif($keytype==2){
				$where = ' where b.sitename like "%'.$keyword.'%"';
			}elseif($keytype==3){
				$where = ' where a.content like "%'.$keyword.'%"';
			}
		}
		$table = 'as a left join ks_common_user_website as b on a.wxid = b.wxid left join ks_common_user as c on a.userid = c.userid';
		$options = $Mode->getOptions('8',$table.$where);//分页参数设置
		$page = Page($options);
		$values = $Mode->getPage($page,OB($orderby),$table.$where,'a.*,c.username,b.*');

		include  CURR_VIEW_PATH . "Content/admin.developList.php";
	}
    /**
     * 添加/编辑开发动态界面
     */
	public function developManageAction(){
        $id     = ChkClng(KS_G('request.id'));
		if ($id>0){
            $model  = M('common_massage');
            $values = $model->getRow('where id='.$id);
        }else{
            $values = '';
        }
		include CURR_VIEW_PATH . "Content/admin.developManage.php";
	}
	/**
     * 保存添加开发动态
	 */
	public function developManageDoSaveAction(){
        $id                = ChkClng(KS_S('request.id'));
		$now_page          = ChkClng(KS_S('p',1));
		if(empty(KS_G('post.title'))){KS_INFO('请输入标题');exit;}
		if(empty(KS_G('post.content'))){KS_INFO('请输入正文');exit;}

        $Data['title']     = ChkSQl(KS_S('request.title'));
        $Data['content']   = ChkSQl(KS_S('request.content'));
        $Data['adddate']   = strtotime(ChkSQl(KS_S('request.adddate')));
        $common_massage    = M('common_massage');

        if ($id>0){   //编辑
            $common_massage    ->update($Data,'id='.$id);
            $url = M_URL('Content','developList','',GP('p-'.$now_page));
            KS_INFO('编辑成功！',3,$url);
        }else{
            $common_massage    ->doAdd($Data,'id');
            $url = M_URL('Content','developList','',GP('p-'.$now_page));
            KS_INFO('添加成功！',3,$url);
        }
	}

	/*
     * 删除开发动态
     */
	public function deleteDevelopAction(){
        $id = ChkSQL(KS_S('id'));
		$now_page   = ChkClng(KS_S('p'));
		$model= M('common_massage');
        if (gettype($id)!='array'){
            $id=explode(',',$id);
        }
		foreach($id as $k=>$v){
			$values = $model->delete(' id='.$v);
		}
		$url=M_URL('Content','developList','',GP('p-'.$now_page));
		KS_INFO("删除成功",0,$url);
	}

    /****************************************************************开发动态 end**********************************************************/




    /****************************************************************意见反馈 begin**********************************************************/
	/**
     * 意见反馈列表
     */
	public function feedBackListAction(){
		$keyword = ChkSQL(KS_S('keyword'));
		$keytype = ChkClng(KS_S('keytype',1));
		$Mode = M('common_feedback');
		$now_page   = ChkClng(KS_S('p',1));
		$adddate= KS_S('adddate',1);
		$orderby[GN('adddate')]       = 'adddate/adddate';
		$where = '';
		if($keyword){
			if($keytype==1){
				$where = ' where c.username like "%'.$keyword.'%"';
			}elseif($keytype==2){
				$where = ' where b.sitename like "%'.$keyword.'%"';
			}elseif($keytype==3){
				$where = ' where a.content like "%'.$keyword.'%"';
			}
		}
		$table = 'as a inner join ks_common_user_website as b on a.wxid = b.wxid inner join ks_common_user as c on b.userid = c.userid';
		$options = $Mode->getOptions('15',$table.$where);//分页参数设置
		$page = Page($options);
		$values = $Mode->getPage($page,OB($orderby),$table.$where,'a.*,c.username,b.*');

		include  CURR_VIEW_PATH . "Content/admin.feedBackList.php";
	}
    /*
     * 显示意见反馈详情
     */
	public function feedBackShowAction(){
		$id= ChkClng(KS_G('request.id'));
		$model= M('common_feedback');
		$values = $model->getRow('where id='.$id);
		include  CURR_VIEW_PATH . "Content/admin.feedBackShow.php";
	}

    /**
     * 回复意见反馈(保存)
     */
    public function feedBackShowDoSaveAction(){
        $id   = ChkClng(KS_G('request.id'));
        $model= M('common_feedback');
        $data['isreply']=1;
        $data['reply_content']=KS_S("reply_content");
        $model->update($data,'id='.$id);
		$url=M_URL('Content','feedBackList','');
        KS_INFO("恭喜，已回复！",3,$url);
    }


	/*
     * 删除反馈内容
     */
	public function deleteFeedBackAction(){
        $id = ChkSQL(KS_S('id'));
		$now_page   = ChkClng(KS_S('p'));
		$model= M('common_feedback');
        if (gettype($id)!='array'){
            $id=explode(',',$id);
        }
		foreach($id as $k=>$v){
			$values = $model->delete(' id='.$v);
		}
		$url=M_URL('Content','feedBackList','',GP('p-'.$now_page));
		KS_INFO("删除成功",0,$url);

	}

    /**
     * 群发to网校
     */
    public function sendMessageAction(){
        $id   = ChkClng(KS_G('request.id'));
        $Mode = M('common_user');
        $info = $Mode->getRow('where wxid='.$id.' and parentid=0');
        include CURR_VIEW_PATH . "Content/admin.sendMessage.php";
    }
    /**
     * 保存群发to网校 (实现原理要改掉。。。。。 不能每个人发一条记录）
     */
    public function sendMessageDoSaveAction(){
        $now_page          = ChkClng(KS_S('p',1));
        $allwx             = KS_S('allwx',0);
        if(KS_G('post.type')==1){  //发站内消息
            if(empty(KS_G('post.title'))){KS_INFO('请输入标题');exit;}
            if(empty(KS_G('post.massage'))){KS_INFO('请输入正文');exit;}
            if($allwx==2){    //发布给所有的机构
                $domain  = M('common_domain');
                $allwxid = $domain->getAll('','wxid');
                foreach($allwxid as $k=>$v){
                    massageSend($v['wxid'],0,0,KS_G('post.title'),KS_G('post.massage'));
                }
            }else{
                massageSend(KS_G('post.wxid'),0,0,KS_G('post.title'),KS_G('post.massage'));
            }
        }else{  //发送短信
            if(empty(KS_G('post.massage'))){KS_INFO('请输入正文');exit;}
            $this->Sms->SendSms(KS_G('post.mobile'),strip_tags(KS_G('post.massage')),'memberReg','',KS_G('post.wxid'),'');
        }
        $backtype = KS_S('backtype',0);
        if($backtype==2){
            $url = M_URL('Content','feedBackList','',GP('p-'.$now_page));
        }else{
            $url = M_URL('Domain','wxlist','',GP('p-'.$now_page));
        }
        KS_INFO('发送成功！',3,$url);
    }
    /****************************************************************意见反馈 end**********************************************************/








}