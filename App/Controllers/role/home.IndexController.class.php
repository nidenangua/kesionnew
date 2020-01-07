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
     * 子账号列表
     */
    public function teacherListAction()
    {
        $userModel = M('common_user');
        $teacherModel = M('common_user_teacher');
        $where = " as a left join $teacherModel->table as b on a.userid=b.userid where a.wxid=$this->wxid and b.roleid>0";
        $keyword = ChkSQL(KS_S('keyword'));
        $keytype = ChkClng(KS_S('keytype'));
        $status = ChkClng(KS_S('status',3));
        if ($keytype==1){
            if($keyword){
                $where = $where.' and a.username like "%'.$keyword.'%"';
            }
        }else{
            if($keyword){
                $where = $where.' and b.name like "%'.$keyword.'%"';
            }
        }
        if ($status==1){
            $where = $where.' and a.status=1';
        }elseif($status==2){
            $where = $where.' and a.status=0';
        }
        $options     = $userModel->getOptions('10',$where);//分页参数设置
        $page        = Page($options);
        $UsersAll      = $userModel->getPage($page,'regdate desc',$where);
        $roleModel = M('common_user_role');
        foreach ($UsersAll as $k=>$v){
            $UsersAll[$k]['role_name'] = $roleModel->getOne('title',"where wxid=$this->wxid and id=$v[roleid]");
        }
        include  CURR_VIEW_PATH . "teacher_list.php";
    }
    /*
     * 子账号添加界面
     */
    public function teacherAddAction()
    {
        $id = ChkClng(KS_G('get.id'));
//        $role_list = M('common_user_role')->getAll("where wxid=$this->wxid");
        $role_list = $this->cache->GetHCache('role',$this->wxid);
        if($id){
            $userModel = M('common_user');
            $teacherModel = M('common_user_teacher');
            $userinfo = $userModel->getRow(" as a join $teacherModel->table as b on a.userid=b.userid where a.userid=$id");
        }
        include  CURR_VIEW_PATH . "teacher_add.php";
    }
    /*
     * 子账号添加操作
     */
    public function doTeacherAddAction()
    {
        $Data1['name'] = ChkSQL(KS_G('post.name'));
        $Data1['position'] = ChkSQL(KS_G('post.position'));
        $Data1['shortIntro'] = ChkSQL(KS_G('post.shortIntro'));
        $Data1['head'] =  Img(ChkSQL(KS_G('post.defaultpic')));
        $Data1['roleid'] = ChkClng(KS_G('post.roleid'));
        $Data1['isshow'] = 0;

        if (empty($Data1['head'])) KS_INFO('请上传头像',0,'','',1);
        if (empty($Data1['roleid'])) KS_INFO('请选择角色',0,'','',1);
        $Data['status'] = ChkSQL(KS_G('post.status'));
        $Data['username'] = ChkSQL(KS_G('post.username'));
        if (is_mobile($Data['username'])) KS_INFO('子账号不可设置手机号',0,'','',1);
        $userModel = M('common_user');
        $teacherModel = M('common_user_teacher');
        $username = $userModel->getOne('userid',"where username='$Data[username]'");
        if ($username) KS_INFO('帐号已存在',0,'','',1);
        if (empty(KS_G('post.password'))) KS_INFO('密码不能为空',0,'','',1);
        $Data['rndpasswordc'] = rand(100000,999999);
        $Data['password'] = KS_MD5(ChkSQL(KS_G('post.password')).KS_MD5($Data['rndpasswordc']));
        $Data['powertype'] = 2;
        $Data['wxid'] = $this->wxid;
        $Data['parentid'] = $this->userid;
        $Data['usertype'] = 1;
        $Data['regdate'] = time();
        $Data['status'] = ChkClng(KS_G('post.status'));
        $Data['nickname'] = $Data1['name'];
        $userid = $userModel->doAdd($Data,'userid');
        if ($userid){
            $Data1['userid'] = $userid;
            $teacherModel->doEfAdd($Data1);
        }
        $url = M_URL($this->AppName.'/Index','teacherList','',GP(''));
        KS_INFO('添加成功',3,$url);
    }
    /*
     * 子账号编辑操作
     */
    public function doTeacherEditAction()
    {
        $id = ChkClng(KS_G('get.id'));
        if (empty($id)) KS_INFO('ID不存在',0,'','',1);
        $Data1['name'] = ChkSQL(KS_G('post.name'));
        $Data1['position'] = ChkSQL(KS_G('post.position'));
        $Data1['shortIntro'] = ChkSQL(KS_G('post.shortIntro'));
        $Data1['head'] =  Img(ChkSQL(KS_G('post.defaultpic')));
        $Data1['roleid'] = ChkClng(KS_G('post.roleid'));
        if (empty($Data1['head'])) KS_INFO('请上传头像',0,'','',1);
        if (empty($Data1['roleid']))  KS_INFO('请选择角色',0,'','',1);
        $Data['status'] = ChkSQL(KS_G('post.status'));
        $userModel = M('common_user');
        $teacherModel = M('common_user_teacher');
        if (!empty(KS_G('post.password'))){
            $Data['rndpasswordc'] = rand(100000,999999);
            $Data['password'] = KS_MD5(ChkSQL(KS_G('post.password')).KS_MD5($Data['rndpasswordc']));
        }
        $Data['status'] = ChkClng(KS_G('post.status'));
        $Data['nickname'] = $Data1['name'];
        $userModel->update($Data,"wxid=$this->wxid and userid=$id");
        $teacherModel->update($Data1,"userid=$id");
        User_GetUser($id,true);
        $url = M_URL($this->AppName.'/Index','teacherList','',GP(''));
        KS_INFO('修改成功',3,$url);
    }
    /*
     * 子账号删除
     */
    public function teacherDelAction()
    {
        $id = KS_G('id');
        $userModel = M('common_user');
        $teacherModel = M('common_user_teacher');

        if (is_array($id)){
            foreach ($id as $k=>$v){
                if (ChkClng($v)>0){
                    $userModel->delete("userid=$v and wxid=$this->wxid");
                    $teacherModel->delete("userid=$v");
                    User_GetUser($v,true);
                }
            }
        }else{
            if (ChkClng($id)>0){
                $userModel->delete("userid=$id and wxid=$this->wxid");
                $teacherModel->delete("userid=$id");
                User_GetUser($id,true);
            }
        }
        $url = M_URL($this->AppName.'/Index','teacherList','',GP(''));
        KS_INFO('删除成功',3,$url);
    }
    /*
     * 角色列表
     */
    public function indexAction()
    {
        $setting = $this->cache->GetH('apprelate','appid',$this->appid,'setting',$this->wxid);
        if(!empty($setting)){$setting = explode('※',$setting);}
        $where = 'where wxid='.$this->wxid;
        $keyword = KS_S('keyword');
        if($keyword){
            $where = $where.' and title like "%'.$keyword.'%"';
        }
        $options     = $this->AppModel->getOptions('10',$where);//分页参数设置
        $page        = Page($options);
        $values      = $this->AppModel->getPage($page,'adddate desc',$where);
        include  CURR_VIEW_PATH . "rolelist.php";
	}
    /**
     * 保存修改、添加角色
     */
    public function doroleAddAction()
    {
        $id                   = ChkClng(KS_G('get.id'));
        $Data['title']        = ChkSQL(KS_G('post.title'));
        $powerlist            = ChkSQL_Array(KS_G('post.powerlist'),true) ;
        $Data['shortdesc']    = ChkSQL(KS_G('post.shortdesc'));
        if (empty($Data['title'])) KS_INFO('请输入角色名称',0,'','',1);
        $where = "where title='$Data[title]' and wxid=$this->wxid";
        if (!empty($id)) $where .= " and id!=$id";
        $title = $this->AppModel->getOne('title',$where);
        if ($title) KS_INFO('角色名称已经存在',0,'','',1);
        $url                  = M_URL($this->AppName.'/Index','index','',GP(''));
        $Data['rule']         = trim(implode(',',$powerlist));
        if(empty($id)){//添加
            $Data['wxid']    = $this->wxid;
            $Data['adddate'] = time();
            $this->AppModel->doAdd($Data,'id');
            $this->cache->PutHCache('role',$this->wxid);
            KS_INFO('添加成功',3,$url);
        }else{//修改

//            var_dump($Data);die;
            $this->AppModel->update($Data,'id='.$id);
            $this->cache->PutHCache('role',$this->wxid);
            KS_INFO('修改成功',3,$url);
        }
    }
	/*
	 * 添加界面
	 */
	public function roleAddAction()
    {
        $db_user_group = M('common_user_role');
        $id = ChkClng(KS_G('get.id'));
//        $category  = $this->cache->GetACache('appcategory');//读出缓存
//        $apprelate = $this->cache->GetHCache('apprelate',$this->wxid);//读出缓存
        $menu_arr = KS_C('SUBMENU_LIST');
        foreach ($menu_arr as $k=>$v){
            foreach ($v['subtopic'] as $k1=>$v1){
                if ($v1['appid']!='7'&&$v1['key']!='sales'){
                    if ($v1['appid']==0){
                        $menu_list[$k]['title'] = $v['title'];
                        $menu_list[$k]['typesetting'] = $v['typesetting']?$v['typesetting']:'1';
                        $menu_list[$k]['type'] = $v['type'];
                        $menu_list[$k]['subtopic'][] = $v1;
                    }else{
                        if (ismoduleopen($this->wxid,$v1['appid'],$v1['subappid'])){
                            $menu_list[$k]['title'] = $v['title'];
                            $menu_list[$k]['typesetting'] = $v['typesetting']?$v['typesetting']:'1';
                            $menu_list[$k]['type'] = $v['type'];
                            $menu_list[$k]['subtopic'][] = $v1;
                        }
                    }
                }
            }
        }
        if($id){
            $value = $db_user_group->getRow('where wxid='.$this->wxid.' and id='.$id);
        }
        include  CURR_VIEW_PATH . "roleadd.php";
	}
    /*
    * 角色删除
    */
    public function roleDelAction()
    {
        $id = KS_G('id');
        $userModel = M('common_user_role');
        $teacherModel = M('common_user_teacher');
        $url = M_URL($this->AppName.'/Index','index','',GP(''));
        if (is_array($id)){
            foreach ($id as $k=>$v){
                if (ChkClng($v)>0){
                    $id1 = $teacherModel->getOne('userid',"where roleid=$v");
                    if ($id1) KS_INFO('删除失败，该角色下有子账号',3,$url,'',3);
                    $userModel->delete("id=$v and wxid=$this->wxid");
                }
            }
        }else{
            if (ChkClng($id)>0){
                $id1 = $teacherModel->getOne('userid',"where roleid=$id");
                if ($id1) KS_INFO('删除失败，该角色下有子账号',3,$url,'',3);
                $userModel->delete("id=$id and wxid=$this->wxid");
            }
        }
        $this->cache->PutHCache('role',$this->wxid);
        KS_INFO('删除成功',3,$url);
    }
    /*
     * 状态更改
     */
    public function updatestatusAction(){
        $id = ChkSQL(KS_G("get.id"));
        if(empty($id)){KS_INFO('请选择',0,'','',1);}
        $model = M('common_user');
        $status = $model->getOne('status','where userid ='.$id.' and wxid='.$this->wxid);
        if($status==1){$Data['status']=0;}elseif($status==0){$Data['status']=1;}
        $model->update($Data,'userid ='.$id);
        echo $Data['status'];
    }
}