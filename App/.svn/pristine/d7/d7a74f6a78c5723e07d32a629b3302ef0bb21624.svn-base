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
     * 小组列表
     */
    public function indexAction(){
//        $val = $this->cache->GetHCache('team',$this->wxid);
//        $val = $this->cache->GetH('team','id','1','isassociated',$this->wxid);
//        var_dump($val);die;
    	$setting = $this->cache->GetH('apprelate','appid',$this->appid,'setting',$this->wxid);
        if(!empty($setting)){$setting = explode('※',$setting);}
		$status   = ChkClng(KS_S('status','3'));
		$hot      = ChkClng(KS_S('hot'));
		//状态筛选
        $where = "where a.wxid = $this->wxid";
		if($status==3){
		    $where.= " and a.status in (1,2)";
		} elseif($status==0){
		    $where.= " and a.status=2";
		} elseif($status==1){
		    $where.= " and a.status=1";
		}
		//属性筛选
		if($hot==1){$where.=" and a.is_hot=1";}
		//搜索
		$keyword = ChkSQL(KS_S('keyword'));
		$keytype = ChkClng(KS_S('keytype',1));
	    //判断是否输入关键字
		if(!empty($keyword)){
		   if($keytype==1){$where.=" and a.title like '%$keyword%'";}
		   elseif($keytype==2){$where.=" and b.realname like '%$keyword%'";}
		}

		$left_join   = M('common_user');
		$where       = "as a left join `$left_join->table` as b on a.create_uid = b.userid $where";
		$options     = $this->AppModel->getOptions('8',$where);//分页参数设置
		$page        = Page($options);
		$values      = $this->AppModel->getPage($page,'create_time desc',$where,'b.realname,a.*');
		$info        = $this->cache->GetA('domaininfo','wxid',$this->wxid,'',true);//读出缓存
//        var_dump($values);die;
        foreach ($values as $k=>$v){
            if ($v['chargetype']==1){
                $values[$k]['typeName'] = $v['price'];
            }else{
                $values[$k]['typeName'] = \Kesion\Model\App\TeamModel::$chargetype[$v['chargetype']];
            }
        }
		include  CURR_VIEW_PATH . "team_list.php";
	}
	public function shareAction(){
		include  CURR_VIEW_PATH . "share.php";
	}
	//进入小组增加页面
	public function addTeamAction(){
		$value='';
		include  CURR_VIEW_PATH . "team_add.php";
	}

    /*
     *绑定课程
     */
    public function serializationAction(){
        $id  = KS_G('get.id');
        $keyword = ChkSQL(KS_S('keyword'));
        $keytype = ChkClng(KS_S('keytype',0));
        $where = '';
        if(!empty($keyword)){
            $where  =' and a.title like "%'.$keyword.'%"';
        }
        $Info = $this->AppModel->getRow('WHERE id='.$id);

        $db_link = M("app_team_link");
        $db_class  = M('app_class');
        $db_course = M('app_course');
        $courseAry1 = array();
        if(ismoduleopen($this->wxid,30)){//直播的模块开关开启
            if($keytype==5||$keytype==0){
                $where1 = 'as a left join '.$db_link->table.' as b on a.classid = b.infoid where b.team_id='.$id.' and b.type=2';
                $courseAry1 = $db_class->getAll($where1.$where,'a.title,a.defaultpic,a.chargetype,a.price,a.adddate,a.soldnum,b.id,b.orderid,b.infoid,a.classlevel,a.status');
                foreach ($courseAry1 as $key => $value) {
                    $courseAry1[$key]['courseType']=5;
                }
            }
        }
        $courseAry2 = array();
        if(ismoduleopen($this->wxid,6,4)||ismoduleopen($this->wxid,6,3)||ismoduleopen($this->wxid,6,2)||ismoduleopen($this->wxid,6,1)){
            $where2 = 'as a left join '.$db_link->table.' as b on a.courseid = b.infoid where b.team_id='.$id.' and b.type=1';
            if($keytype==1||$keytype==2||$keytype==3||$keytype==4){
                $where.=' and a.courseType='.$keytype;
                $courseAry2 = $db_course->getAll($where2.$where,'a.title,a.defaultpic,a.chargetype,a.price,a.adddate,a.soldnum,b.id,b.orderid,a.courseType,b.infoid,a.status');
            }elseif($keytype==0){
                $str = '0';
                $str = empty(ismoduleopen($this->wxid,6,4))?$str:$str.',4';
                $str = empty(ismoduleopen($this->wxid,6,3))?$str:$str.',3';
                $str = empty(ismoduleopen($this->wxid,6,2))?$str:$str.',2';
                $str = empty(ismoduleopen($this->wxid,6,1))?$str:$str.',1';
                $courseAry2 = $db_course->getAll($where2.$where.' and a.courseType in('.$str.')','a.title,a.defaultpic,a.chargetype,a.price,a.adddate,a.soldnum,b.id,b.orderid,a.courseType,b.infoid,a.status');
            }
        }

        $values = array_merge($courseAry2,$courseAry1);

        array_multisort(array_column($values,'orderid'),SORT_DESC,$values);//排序
        $now_page = ChkClng(KS_S('p',1));
        $options['now_page']   = $now_page;
        $options['maxperpage'] = 6;
        $options['totalput']   = count($values);
        $page = Page($options);
        $ary_link   = $page->arrayPage($values);
        foreach ($ary_link as $k => $v) {
            $ary_link[$k]['defaultpic'] = empty($v['defaultpic'])? nopic(12):Img($v['defaultpic']);
            if($v['courseType']==1){
                $ary_link[$k]['jumpurl']    = '/h5market/Micoursedetail?id='.$v['infoid'].'&type=1';
            }elseif($v['courseType']==2){
                $ary_link[$k]['jumpurl']    = '/h5market/audiolive?id='.$v['infoid'].'&type=2';
            }elseif($v['courseType']==3){
                $ary_link[$k]['jumpurl']    = '/h5market/musicinfo?id='.$v['infoid'].'&type=3';
            }elseif($v['courseType']==4){
                $ary_link[$k]['jumpurl']    = '/h5market/imgInfo?id='.$v['infoid'].'&type=4';
            }elseif($v['courseType']==5){
                $ary_link[$k]['jumpurl']    = '/h5market/Miclassdetail?id='.$v['infoid'];
            }
        }
        include  CURR_VIEW_PATH . "serialization.php";
    }
    //单品显示页
    public function addshopAction(){
        $columnid  = ChkClng(KS_G('get.id'));
        $db_course = M('app_course');
        $AppModel  = M('app_team_link');  //专栏关联表
        $where = '';
        $keyword = KS_S('keyword');
        $keytype = ChkClng(KS_S('keytype',0));

        if(!empty($keyword)){
            $where  =' and title like "%'.$keyword.'%"';
        }


        foreach ($courseAry1 as $k => $v) {
            $courseAry1[$k]['id'] = 'C-'.$v['id'];
        }
        $courseAry2 = array();
        if(ismoduleopen($this->wxid,6,4)||ismoduleopen($this->wxid,6,3)||ismoduleopen($this->wxid,6,2)||ismoduleopen($this->wxid,6,1)){
            if($keytype==1||$keytype==2||$keytype==3||$keytype==4){//为四大知识模块中的一个时
                $where  .=' and courseType='.$keytype;
                $courseAry2 = $db_course->getAll('where wxid='.$this->wxid.' and  isassociated=1 and status=2 and courseid not in (select infoid from '.$AppModel->table.' where team_id='.$columnid.' and type=1)'.$where,'courseid as id,title,defaultpic');
            }elseif($keytype==0){  //不限
                $str = '0';
                $str = empty(ismoduleopen($this->wxid,6,4))?$str:$str.',4';
                $str = empty(ismoduleopen($this->wxid,6,3))?$str:$str.',3';
                $str = empty(ismoduleopen($this->wxid,6,2))?$str:$str.',2';
                $str = empty(ismoduleopen($this->wxid,6,1))?$str:$str.',1';
                $courseAry2 = $db_course->getAll('where wxid='.$this->wxid.' and status=2 and isassociated=1 and courseid not in (select infoid from '.$AppModel->table.' where team_id='.$columnid.' and type=1)'.$where.' and courseType in('.$str.')','courseid as id,title,defaultpic');
            }

        }

        foreach ($courseAry2 as $k => $v) {
            $courseAry2[$k]['id'] = 'S-'.$v['id'];
        }
        $values = courseAry2;
        array_multisort(array_column($values,'id'),SORT_DESC,$values);//排序
        $now_page = ChkClng(KS_S('p','1'));
        $options['now_page']   = $now_page;
        $options['maxperpage'] = 8;
        $options['totalput']   = count($values);
        $page = Page($options);
        $dt   = $page->arrayPage($values);
        foreach ($dt as $k => $v) {
            if(empty($v['defaultpic'])){
                $dt[$k]['defaultpic'] = nopic(12);
            }else{
                $dt[$k]['defaultpic'] = Img($v['defaultpic']);
            }
        }
        include  CURR_VIEW_PATH . "addshop.php";
    }
    //添加商品操作
    public function doaddshopAction(){
        $team_id  = ChkClng(KS_G('get.id'));
        $shopid   = KS_G('post.aid');
        $AppModel = M('app_team_link');
        $maxOrderid = $AppModel->getOne('max(orderid)','where team_id='.$team_id);
        if(empty($maxOrderid)){
            $maxOrderid = 0;
        }
        $Data['team_id'] = $team_id;
        foreach ($shopid as $k => $v) {
            $maxOrderid = $maxOrderid+1;
            $idary=explode('-',$v);
            if($idary[0]=='C'){
                $Data['type'] =2;
            }elseif($idary[0]=='S'){
                $Data['type'] =1;
            }
            $Data['infoid'] = ChkClng($idary[1]);
            $Data['orderid'] = $maxOrderid;
            $AppModel->doadd($Data,'id');
        }
//        $db_order_info = M('app_order_info');
//        $orderInfo = $db_order_info->getAll('where paystatus=1 and type=7 and team_id='.$team_id.' and status!=-1','memberid');
//        foreach($orderInfo as $k =>$v){
//            $this->cache->PutUCache('havecolumn',$v['memberid']);//更新购买者的缓存
//        }
        $url = M_URL($this->AppName.'/Index','serialization',$team_id,GP('appid-35'));
        KS_INFO('添加成功',3,$url);
    }
    //更改数据排序
    public function changeorderAction(){
        $id  = ChkClng(KS_G('get.id'));
        $db_link = M("app_team_link");
        $orderid = GF('orderid');
        $Data['orderid'] = $orderid;
        $db_link->update($Data,'id='.$id);
        echo 'ok';
    }
    //删除绑定单品
    public function deletedfAction(){
        $id  = ChkClng(KS_G('get.id'));
        $idAry =KS_G("post.aid");
        $idstry = 0;
        foreach ($idAry as $k => $v) {
            $idstry.=','.$v;
        }
        $db_link = M("app_team_link");
        $db_link->delete('id in ('.FilterIds($idstry).')');
        $db_order_info = M('app_order_info');
        $orderInfo = $db_order_info->getAll('where paystatus=1 and type=7 and courseid='.$id.' and status!=-1','memberid');
        foreach($orderInfo as $k =>$v){
            $this->cache->PutUCache('havecolumn',$v['memberid']);//更新购买者的缓存
        }
        $now_page = ChkClng(KS_S('p',1));
        $url = M_URL($this->AppName.'/Index','serialization',$id,GP('appid-35','p-'.$now_page));
        KS_INFO('删除成功',3,$url);
    }
    /*
     * 话题列表
     */
    public function topicListAction()
    {
        $id = ChkClng(KS_G('request.id'));
        $team = M('app_team')->getRow("where id=$id and wxid=".$this->wxid);
        if (!$team){
            KS_INFO('不存在小组','','');
        }
        $where = "where a.team_id = $id";
        //搜索
        $keyword = ChkSQL(KS_S('keyword'));
        $keytype = ChkClng(KS_S('keytype',1));

//        var_dump($keytype);die;
        //判断是否输入关键字
        if(!empty($keyword)){
            if($keytype==1) {
                $where.=" and a.title like '%$keyword%'";
            } elseif($keytype==2){
                $where.=" and b.realname like '%$keyword%'";
            }
        }
        $now_page =  ChkClng(KS_S('p',1));
        $left_join   = M('common_user');
        $where       = "as a left join `$left_join->table` as b on a.userid = b.userid $where";
        $options     = M('app_team_topic')->getOptions('10',$where);//分页参数设置
        $page        = Page($options);
        $values      = M('app_team_topic')->getPage($page,'is_hot desc,create_time desc',$where,'b.realname,b.mobile,a.*');
        $info          = $this->cache->GetA('domaininfo','wxid',$this->wxid,'',true);//读出缓存
//        var_dump($values);
        include  CURR_VIEW_PATH . "topic_list.php";
    }
    /*
     * 进入后台添加组员列表页面
     */
    public function showMemberListAction()
    {
        $id                = ChkClng(KS_G('get.id'));//小组ID
        $db_user           = M('common_user');
        $db_user2           = M('common_user_member');
        $db_user_member    = M('app_team_member');
        $keyword           = KS_S('keyword');
        $keytype           = KS_S('keytype',1);
//        $where             = 'as a left join '.$db_user->table.' as b on a.userid=b.userid left join '.$common_user_group_buy->table.' as c on a.userid=c.userid where a.userid not in(select userid from '.$common_user_group_buy->table.' where grouplevel='.$id.') and  b.usertype=0 and b.wxid='.$this->wxid;
        $where = 'as a left join '.$db_user2->table.' as b on a.userid=b.userid where a.userid not in(select userid from '.$db_user_member->table.' where team_id='.$id.' and wxid='.$this->wxid.') and a.usertype in (0,1) and a.wxid='.$this->wxid;

        if($keyword){
            if($keytype==1){
                $where .= ' and realname like "%'.$keyword.'%"';
            }else{
                $where .= ' and mobile like "%'.$keyword.'%"';
            }
        }
        $options     = $db_user->getOptions('8',$where);//分页参数设置
        $page        = Page($options);
        $values      = $db_user->getPage($page,'a.userid desc',$where,'a.userid,a.mobile,b.name');
//        var_dump($values);die;
        include  CURR_VIEW_PATH . "showMemberList.php";
    }
    /*
     * 添加组员操作
     */
    public function addMemberAction()
    {
        $userlist = KS_S('userid');
        $id = ChkClng(KS_S('get.id'));//组ID
        if(empty($id)){
            KS_INFO('出错了','','');
        }
        if(empty($userlist)){
            KS_INFO('请选择',0,'','',1);
        }
        $model = new \Kesion\Model\App\TeamModel();
        foreach ($userlist as $k=>$v){
            if ($v>0){
                $model->addMember($id,$v);
            }
        }
        $url = M_URL($this->AppName.'/Index','memberList',$id,GP(''));
        KS_INFO('添加成功',3,$url);
    }
    //进入话题详情
    public function editTopicAction(){
        $now_page =  ChkClng(KS_S('p',1));
        $id       =  KS_G('request.id');
        $value    =  M('app_team_topic')->getRow("where id=$id limit 1");

        include  CURR_VIEW_PATH . "topic_add.php";
    }
    /**
     * 获取绑定课程列表
     */
    public function getColumnListAction()
    {
        $type    = ChkClng(KS_S('type',1));
        $keyword = ChkSQL(KS_S('keyword'));
        $typeName = [1 =>'视频',2=>'直播',3=>'音频',4=>'图文',5=>'专栏',8=>'教辅周边'];
        if ($type==5){  //专栏
            $db = M('app_column');
            $where = 'where wxid='.$this->wxid.' and status=2';
            $field = 'columnid as infoid,title,defaultpic,chargetype,price';
        }else{//直播 音频 图文
             $db = M('app_course');
            $where = 'where wxid='.$this->wxid.' and status=2 and coursetype='.$type;
            $field = 'courseid as infoid,title,defaultpic,chargetype,price';
        }
        if (!empty($keyword)){
            $where .= " and title like '%$keyword%'";
        }
        $options     = $db->getOptions('10',$where);//分页参数设置
        $page        = Page($options);
        $values      = $db->getPage($page,'',$where,$field);
        foreach ($values as $k=>$v){
            $values[$k]['type'] = $type;
            $values[$k]['defaultpic'] = Img($v['defaultpic'])?Img($v['defaultpic']):nopic(12);
        }

        include  CURR_VIEW_PATH . "chosecolumn.php";
    }
	/*
	 * 组员列表
	 */
    public function memberListAction()
    {
        $id = ChkClng(KS_G('request.id'));//表ID
        $where = "where a.team_id = $id and a.wxid=".$this->wxid;
        //搜索
        $keyword = ChkSQL(KS_S('keyword'));
        $keytype = ChkClng(KS_S('keytype',1));
        $team = M('app_team')->getRow("where id=$id and wxid=".$this->wxid);
        if (!$team){
            KS_INFO('不存在社群','','');
        }
        //判断是否输入关键字
        if(!empty($keyword)){
            if($keytype==1) {
                $where.=" and b.realname like '%$keyword%'";
            } elseif($keytype==2){
                $where.=" and b.mobile like '%$keyword%'";
            }
        }
        $now_page =  ChkClng(KS_S('p',1));

        $left_join   = M('common_user_member');
        $left_join2  = M('common_user');
        $where       = "as a left join `$left_join->table` as b on a.userid = b.userid left join `$left_join2->table` as c on a.userid=c.userid $where";
        $options     = M('app_team_member')->getOptions('10',$where);//分页参数设置
        $page        = Page($options);
        $values      = M('app_team_member')->getPage($page,'role desc,create_time desc',$where,'c.mobile,a.*,b.name');
        $info        = $this->cache->GetA('domaininfo','wxid',$this->wxid,'',true);//读出缓存

        include  CURR_VIEW_PATH . "member_list.php";
    }
    /*
     * 任命群主
     */
    public function roleAction()
    {
        $id = ChkSQL(KS_G("get.id"));
        $url      =  KS_ComeUrl();
        if(empty($id)){
            KS_INFO('请选择',0,'','',1);
        }
        $role = M('app_team_member')->getOne('role','where id ='.$id.' and wxid='.$this->wxid);

        if($role==1){$Data['role']=2;}elseif($role==2){$Data['role']=1;}
        M('app_team_member')->update($Data,'id ='.$id);
        ks_header($url,1);
    }
	/**
     * 添加小组操作
     */
	public function doaddTeamAction()
    {
        $now_page =  ChkClng(KS_S('p',1));
        $Data['create_uid'] = $this->userid;
        $Data['wxid']       = $this->wxid;
        $Data['title']      = ChkSQL(KS_G("post.title"));
        if (empty($Data['title'])) KS_INFO("请输入标题");
        $teamId = $this->AppModel->getOne('id',"where title='$Data[title]' and wxid=$this->wxid");

        if (!empty($teamId)) KS_INFO("已存在该小组");
        $Data['nojoin']     = ChkClng(KS_G("post.nojoin"));//加入群是否可浏览
        $Data['chargetype']     = ChkClng(KS_G("post.chargetype"));//入群规则
        if ($Data['chargetype']==1){
            $Data['price']      = ChkFloat(KS_G("post.price"));
            if ($Data['price']<=0){
                KS_INFO("价格要大于0");
            }
        }
        $Data['jurisdiction']   = ChkClng(KS_G("post.jurisdiction",1));//未加入是否可以浏览1是2否
        $Data['isassociated']   = ChkClng(KS_G("post.isassociated",0));//是否关联
        $Data['description']   = urlencode(KS_G("post.description"));
        $Data['defaultpic']     = ChkSQL(KS_G('post.defaultpic'));
        $Data['create_time']   = time();
        $Data['is_vip']   = ChkClng(KS_G('post.is_vip',0));
        $Data['status']   = ChkClng(KS_G('post.status',1));//状态
        $infoid = KS_G('post.infoid');//关联ID
        $type   = KS_G('post.type');//关联类型
		$url1=M_URL($this->AppName.'/Index','addTeam','',GP(''));
		$url2=M_URL($this->AppName.'/Index','index','',GP(''));
		$team = $this->AppModel->getRow('where title="'.$Data['title'].'" and wxid='.$this->wxid);
		if ($team){
            KS_INFO("已存在小组");
        }
        if (empty($Data['defaultpic'])) KS_INFO("请上传图片");
//        var_dump($Data);die;
        $id = $this->AppModel->doAdd($Data,'id');
        $this->cache->PutHCache('team',$this->wxid);//缓存
        foreach ($infoid as $k=>$v){
            if ($v>0){
                $array[$k]['infoid'] = $v;
                $array[$k]['type'] = ChkClng($type[$k]);
            }
        }
        if (!empty($array)){
            $array = array_unique($array,SORT_REGULAR);
            $team_link = M('app_team_link');
            foreach ($array as $k=>$v){
                if ($v['infoid']>0){
                    $link['infoid']  = ChkClng($v['infoid']);
                    $link['type']    = ChkClng($v['type']);
                    $link['team_id'] = $id;
                    $link['wxid'] = $this->wxid;
                    $team_link->doAdd($link,'id');
                }
            }
        }
        if ($id){
            KS_INFO("添加成功，是否继续添加",1,$url1,$url2);
        }else{
            KS_INFO("添加失败");
        }
	}
	/**
     * 进入编辑小组页面
	 */
	public function editTeamAction()
    {
		$now_page =  ChkClng(KS_S('p',1));
		$id       =  ChkClng(KS_G('request.id'));
		$value    =  $this->AppModel->getRow("where id=$id limit 1");
        $value['description'] = urldecode($value['description']);
        $team_link = M('app_team_link');
        $linkList = $team_link->getAll("where team_id=$id and wxid=$this->wxid");
        foreach ($linkList as $k=>$v){
            if ($v['type']==5){//专栏
                $db = M('app_column');
                $where = 'where wxid='.$this->wxid.' and columnid='.$v['infoid'];
                $field = 'columnid as infoid,title,defaultpic,price';
                $goodinfo[$k] = $db->getRow($where,$field);
            }else{       //音频，视频，直播，图文等
                $db = M('app_course');
                $where = 'where wxid='.$this->wxid.' and courseid='.$v['infoid'];
                $field = 'courseid as infoid,title,defaultpic,price';
                $goodinfo[$k] = $db->getRow($where,$field);
            }
            $goodinfo[$k]['type'] = $v['type'];
            $goodinfo[$k]['defaultpic'] = Img($goodinfo[$k]['defaultpic'])?Img($goodinfo[$k]['defaultpic']):nopic(12);
        }

        $value['goodinfo'] = !empty($goodinfo)?$goodinfo:[];
        $typeName = [1 =>'视频',2=>'直播',3=>'音频',4=>'图文',5=>'专栏'];
		include  CURR_VIEW_PATH . "team_add.php";
	}
	/*
	 * 保存编辑
	 */
	public function doEditTeamAction(){
		$now_page =  ChkClng(KS_S('p',1));
		$id       = ChkClng(KS_G('request.id'));//表ID
        $Data['create_uid'] = $this->userid;
        $Data['wxid']      = $this->wxid;
        $Data['title']     = ChkSQL(KS_G("post.title"));
        if (empty($Data['title'])) KS_INFO("请输入标题");
        $teamId = $this->AppModel->getOne('id',"where title='$Data[title]' and wxid=$this->wxid and id!=$id");
        if (!empty($teamId)) KS_INFO("已存在该小组");
        $Data['price']     = ChkFloat(KS_G("post.price"));
        $Data['nojoin']     = ChkClng(KS_G("post.nojoin"));//加入群是否可浏览
        $Data['chargetype']     = ChkClng(KS_G("post.chargetype"));//入群规则
        if ($Data['chargetype']==1){
            $Data['price']      = ChkFloat(KS_G("post.price"));
            if ($Data['price']<=0){
                KS_INFO("价格要大于0");
            }
        }
        $Data['isassociated']   = ChkClng(KS_G("post.isassociated",0));//是否关联
        $Data['jurisdiction']   = ChkClng(KS_G("post.jurisdiction",1));//是否关联
        $Data['description']   = ChkSQL(KS_G("post.description"));
        $Data['defaultpic']     = ChkSQL(KS_G('post.defaultpic'));
        if (empty($Data['defaultpic'])) KS_INFO("请上传图片");
//        $Data['create_time']   = ChkSQL(strtotime(KS_G('post.create_time')));
        $Data['is_vip']   = ChkClng(KS_G('post.is_vip',0));
        $Data['status']   = ChkClng(KS_G('post.status',1));//状态
        $infoid = KS_G('post.infoid');//关联ID
        $type = KS_G('post.type');//关联类型
        foreach ($infoid as $k=>$v){
            if ($v>0){
                $array[$k]['infoid'] = $v;
                $array[$k]['type'] = $type[$k];
            }
        }
        if (!empty($array)){
            $array = array_unique($array,SORT_REGULAR);
            $team_link = M('app_team_link');
            $team_link->delete("team_id=$id and wxid=$this->wxid");
            foreach ($array as $k=>$v){
                if ($v['infoid']>0){
                    $link['infoid'] = ChkClng($v['infoid']);
                    $link['type']   = ChkClng($v['type']);
                    $link['team_id'] = $id;
                    $link['wxid'] = $this->wxid;
                    $team_link->doAdd($link,'id');
                }
            }
        };
        $this->AppModel->update($Data,"id=$id");

        $this->cache->PutHCache('team',$this->wxid);//缓存
		$url=M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
		KS_INFO("保存成功",0,$url);
	}
	//删除
	public function deleteAction(){
        $id       =  ChkClng(KS_G('request.id'));
        $db_id = ChkClng(KS_S("db"));//数据表
        $model = new \Kesion\Model\App\TeamModel();
        $model->del($id,$db_id);
        $url  =  KS_ComeUrl();
        ks_header($url,1);
	}

	//批量删除
	public function batchAction()
    {
        $id = ChkSQL(KS_S('check'));
        $db_id = ChkClng(KS_S("db"));//删除类型
        if(empty($id)){
            KS_INFO("请选择",0,'','',1);
        }
        $model = new \Kesion\Model\App\TeamModel();
        foreach ($id as $k=>$v){
            if ($v>0){
                $model->del(ChkClng($v),$db_id);
            }
        }
        $url      =  KS_ComeUrl();//上个页面地址
        ks_header($url,1);
	}
	//进入配置
	public function settingAction(){
	    $setting = getSet($this->wxid,$this->appid);//获取网站配置
		include  CURR_VIEW_PATH . "setting.php";
    }
}