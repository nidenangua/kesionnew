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
    /*
     * 分组列表
     */
    public function indexAction()
    {
        $setting = $this->cache->GetH('apprelate','appid',$this->appid,'setting',$this->wxid);
        if(!empty($setting)){$setting = explode('※',$setting);}
        $where = 'where wxid='.$this->wxid.' and status!=-1 and type=0';
        $db_user_group = M('common_user_group');
        $userModel = M('common_user');
        $keyword = KS_S('keyword');
        if($keyword){
            $where = $where.' and name like "%'.$keyword.'%"';
        }
        $options     = $db_user_group->getOptions('10',$where);//分页参数设置
        $page        = Page($options);
        $values      = $db_user_group->getPage($page,'addtime desc',$where);
        foreach ($values as $k => $v) {
            $values[$k]['count'] = $userModel->getOne('count(userid)','where wxid='.$this->wxid.' and groupid='.$v['id']);
        }
        include  CURR_VIEW_PATH . "grouplist.php";
	}
    /**
     * 保存修改、添加分组
     */
    public function doGroupAddAction()
    {
        $id                   = ChkClng(KS_G('get.id'));
        $Data['name']         = ChkSQL(KS_G('post.name'));
        $Data['costlevel']    = ChkSQL(KS_G('post.costlevel'));
        $Data['detailintro']  = ChkSQL(KS_G('post.detailintro'));
        if(KS_G('post.defaultpic')){
            $Data['defaultpic'] = ChkSQL(KS_G('post.defaultpic'));
        }
        $Data['shortdesc']     = ChkSQL(KS_G('post.shortdesc'));
        $Data['status']        = ChkClng(KS_G('post.status'));
        $url                   = M_URL($this->AppName.'/Index','index','',GP(''));
        $db_user_group         = M('common_user_group');
        $Rule['name']          = '分组名称|isEmpty,isDbexis';
        if(empty($id)){//添加
            $Data['wxid']    = $this->wxid;
            $Data['addtime'] = time();
            Chkpost($Data,$Rule,$db_user_group,'wxid='.$this->wxid);
            $db_user_group->doAdd($Data,'id');
            KS_INFO('添加成功',3,$url);
        }else{//修改
            Chkpost($Data,$Rule,$db_user_group,'wxid='.$this->wxid.' and id!='.$id);
            $db_user_group->update($Data,'id='.$id);
            KS_INFO('修改成功',3,$url);
        }
    }
	/*
	 * 进入分组添加界面
	 */
	public function groupAddAction()
    {
        $db_user_group = M('common_user_group');
        $id = ChkClng(KS_G('get.id'));
        if($id){
            $value = $db_user_group->getRow('where wxid='.$this->wxid.' and id='.$id);
        }

        include  CURR_VIEW_PATH . "groupadd.php";
	}
    /**
     * 删除分组
     */
    public function delGroupAction()
    {
        $id                  = ChkClng(KS_G('get.id'));
        $db_user_group       = M('common_user_group');
        $db_user_group->delete('wxid='.$this->wxid.' and id='.$id);
        $url = M_URL($this->AppName.'/Index','index','',GP(''));
        KS_INFO('删除成功',3,$url);
    }
    /**
     * 批量删除分组
     */
    public function batchdelAction()
    {
        $id              = ChkSQL(KS_G('post.id'));
        $db_user_group   = M('common_user_group');
        $Datas['status'] = -1;
        foreach($id as $k =>$v){
            if ($v>0){
                $db_user_group->update($Datas,'id='.ChkClng($v));
            }
        }
        $url = M_URL($this->AppName.'/Index','index','',GP(''));
        KS_INFO('删除成功',3,$url);
    }
    /**
     * 显示会员组对应的用户列表
     */
    public function showGroupUserAction()
    {
        $id = ChkClng(KS_S('id'));
        $db_user_group = M('common_user_group');
        $db_user_member = M('common_user_member');
        $db_user = M('common_user');
        $title = $db_user_group->getOne('name','where id='.$id);
        $keyword = ChkSQL(KS_S('keyword'));
        $keytype = ChkClng(KS_S('keytype',1));
        $where ='as a inner join '.$db_user->table.' as b on a.userid=b.userid where b.groupid='.$id.' and b.usertype=0 and b.wxid='.$this->wxid;
        if($keyword){
            if($keytype==1){  //账号
                $where = $where." and b.username like '%$keyword%'";
            }else{
                $where = $where." and a.name like '%$keyword%'";
            }
        }

        $options     = $db_user_member->getOptions('10',$where);//分页参数设置
        $page        = Page($options);
        $values      = $db_user_member->getPage($page,'a.userid desc',$where,'a.*,b.username,b.mobile,b.regdate');
        include  CURR_VIEW_PATH . "groupuserlist.php";
    }
    /**
     * 显示添加会员页面
     */
    public function addGroupUserAction()
    {
        $id                = ChkClng(KS_G('get.id'));
        $db_user_member    = M('common_user_member');
        $db_user_group = M('common_user_group');
        $db_user           = M('common_user');
        $keyword           = ChkSQL(KS_S('keyword'));
        $keytype           = ChkClng(KS_S('keytype',1));
        $where             = 'as a left join '.$db_user->table.' as b on a.userid=b.userid where b.groupid!='.$id.' and  b.usertype=0 and b.wxid='.$this->wxid;
        if($keyword){
            if($keytype==1){
                $where = $where.' and a.name like "%'.$keyword.'%"';
            }else{
                $where = $where.' and b.username like "%'.$keyword.'%"';
            }
        }
        $options     = $db_user_member->getOptions('8',$where);//分页参数设置
        $page        = Page($options);
        $values      = $db_user_member->getPage($page,'a.userid desc',$where,'a.*,b.username,b.groupid');
        foreach ($values as $k=>$v){
            $values[$k]['groupname'] =  $db_user_group->getOne('name','where id='.$v['groupid']);
        }
        include  CURR_VIEW_PATH . "groupadduser.php";
    }
    /**
     * 加入组
     */
    public function doGroupAddUserAction()
    {
        $userlist = KS_S('ueserlist');
        $id = ChkClng(KS_S('get.id'));
        if($id<=0){
            $url = M_URL($this->AppName.'/Index','showgroup','',GP(''));
            KS_INFO('出错了','','');
        }
        $ary = explode('|',$userlist);
        $model = M('common_user');
        foreach ($ary as $k => $v) {
            if ($v>0){
                $model->update(['groupid'=>$id],"userid=$v and wxid=$this->wxid");
            }
        }
        $url = M_URL($this->AppName.'/Index','showGroupUser',$id,GP(''));
        KS_INFO('添加成功',3,$url);
    }
    /**
     * 删除会员组里面的用户
     */
    public function delGroupUserAction(){

        $type= KS_S('type',1);
        $id =  ChkClng(KS_G('get.id'));
        $db_user_member = M('common_user');
        if($type==1){
            $userid = ChkClng(KS_S('userid'));
            $db_user_member->update(['groupid'=>0],'wxid='.$this->wxid.' and userid='.$userid);
        }else{

            $userid = FilterIds(implode(KS_G('post.userid'),','));
            if($userid==0){
                KS_INFO('没有选择学员！','','');
            }
            $db_user_member->delete('wxid='.$this->wxid.' and userid in('.$userid.')');
        }
        $this->cache->PutHCache('usergroup',$this->wxid);//更新会员组的缓存
        $url = M_URL($this->AppName.'/Index','showGroupUser',$id,GP(''));
        KS_INFO('操作成功',3,$url);
    }
}