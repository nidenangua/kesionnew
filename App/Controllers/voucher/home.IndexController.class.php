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
class IndexController extends CommonController{

	/**
	 * 优惠券列表
	 */
	public function indexAction(){
		$keyword = ChkSQL(KS_S('keyword'));
		$keytype = ChkClng(KS_S('keytype'));
		$now_page = ChkClng(KS_S('p'));
		$Model = M('app_voucher_list');
		$userModel = M('common_user');
		/**********先数据过一遍过期的优惠券 begin**************/
        $data['isuse']=2;  //设置过期
        $Model->update($data,'wxid='.$this->wxid.' and awarddate=1 and isuse = 0 and redemptionendtime<'.time());
        /**********先数据过一遍过期的优惠券 end**************/


       /**********在过一遍已领完的优惠券 begin**************/
        $data['isuse']=1;   //设置领完
        $Model->update($data,'wxid='.$this->wxid.' and isuse = 0 and counts>=number');
        /**********在过一遍已领完的优惠券 end**************/


		/**********开始查询优惠券列表**************/
		$stat = KS_S('stat','3');
		$where= 'where wxid='.$this->wxid;
		if($stat == 0){
			$where .= ' and isuse = 0';
		}elseif($stat == 1){
			$where .= ' and isuse = 1';
		}elseif($stat == 2){
			$where .= ' and isuse = 2';
		}else{
			$where .= ' and isuse != -1';
		}
		if(!empty($keyword)){
			if($keytype==1){
				$where.=" and code like '%$keyword%'";
			}
		}
		$options = $Model->getOptions('10',$where);//分页参数设置
		$page = Page($options);
		$values = $Model->getPage($page,'id desc',$where);
		include  CURR_VIEW_PATH . "index.php";
	}
    /**
     * 删除优惠券
     */
    public function delRedpacketAction(){
		$id    = ChkClng(KS_G('get.id'));
		$Model = M('app_voucher_list');
        $Model->delete('id='.$id.' and wxid='.$this->wxid);
        $Model = M('app_voucher');
        $Model->delete('vid='.$id.' and wxid='.$this->wxid);
		$url = M_URL($this->AppName.'/Index','index','',GP(''));
		KS_INFO('',3,$url);
	}

    //public function delRedpacketNumAction(){
    //    $id = ChkClng(KS_G('get.id'));
    //    $now_page =  ChkClng(KS_S('p',1));
    //    $redPacketNumModel = M('app_red_packetnum');
    //    $redPacketid = $redPacketNumModel->getOne('redpacketid','where id ='.$id );
    //    $redPacketNumModel->delete("id = $id");
    //    $url=M_URL($this->AppName.'/Index','viewRedpacketNum',$redPacketid,GP('p-'.$now_page));
    //    KS_INFO("删除成功",0,$url);
    //}
    ////进行红包数系列删除
    //public function bathDelRedpacketNumAction(){
    //    $ids = ChkSQL(KS_G('post.id'));
    //    $now_page =  ChkClng(KS_S('p',1));
    //    $redPacketNumModel = M('app_red_packetnum');
    //    $redPacketid = ChkClng(KS_G('post.redpacketid'));
    //    foreach ($ids  as $id){
    //        $redPacketNumModel->delete("id = $id");
    //    }
    //    $url=M_URL($this->AppName.'/Index','viewRedpacketNum',$redPacketid,GP('p-'.$now_page));
    //    KS_INFO("删除成功",0,$url);
    //}

	//推广页面
	public function vochershareAction(){
		$id = KS_G('get.id');
		include  CURR_VIEW_PATH . "vochershare.php";
	}
	/**
     * 进入新增优惠券页面
     */
	public function addVoucherAction(){
		$db_user_group = M('common_user_group');
		$groupary = $db_user_group->getAll('where status!=-1 and type=0 and wxid='.$this->wxid);
		include  CURR_VIEW_PATH . "addVoucher.php";
	}
	/**
     * 进入编辑优惠券页面
	 */
	public function eidtVoucherAction(){
		$id = ChkClng(KS_G('get.id'));
		$url = M_URL($this->AppName.'/Index','index','',GP(''));
		$Model = M('app_voucher_list');
		/**********先数据过一遍过期的优惠券**************/
		$values = $Model->getAll('where  wxid='.$this->wxid.' and awarddate=1 and isuse = 0 and redemptionendtime<'.time());
		if(!empty($values)){
			$Datas['isuse'] = 2;
			foreach($values as $k =>$v){$Model->update($Datas,'id='.$v['id']);}
		}
		$values = $Model->getRow('where  wxid='.$this->wxid.' and id='.$id);
		if(empty($values)){
			KS_INFO('本优惠券已经过期或者出现异常，无法编辑！',3,$url);
		}
		$ids = M('app_voucher')->getAll('where vid = '.$id,'memberid');
		if(!empty($ids)){
			$uname = '';$uid   = '';
			foreach($ids as $k=>$v){
			    $name1 = M('common_user')->getOne('username','where userid='.$v['memberid']);
				$name2 = M('common_user_member')->getOne('name','where userid='.$v['memberid']);
				$uname .= (!empty($name2)?$name2:$name1).',';
				$uid   .= $v['memberid'].',';
			}
		}else{
			$uid = '';$unmae= '';
		}
		include  CURR_VIEW_PATH . "addVoucher.php";
	}
	//添加发放学员
	public function addStudentAction(){
		$UserModel     = M('common_user');
		$userStudent   = M('common_user_member');
		$studentrelate = M('app_class_studentrelate');
		$where         ='where a.wxid ='.$this->wxid .' and a.usertype = 0';
		//关键字搜索
		$keyword = ChkSQL(KS_S('keyword'));
		$keytype = null !==GF('keytype') ? GF('keytype'):0;
	    if(!empty($keyword)){
			    if($keytype==1){
			          $where.=" and b.name like '%$keyword%'";
		        }elseif($keytype==2){
					  $where.=" and a.username like '%$keyword%'";
				}
		}
		$where = "as a left join $userStudent->table as b on a.userid = b.userid $where ";
		$options = $UserModel->getOptions('14',$where);
		$page    = Page($options);
		$student = $UserModel->getPage($page,'a.userid desc',$where);
		include  CURR_VIEW_PATH . "addstudent.php";
	}
	/**
	 * 保存添加优惠券
	 */
	public function doAddVoucherAction(){
        $money=ChkFloat(KS_G('post.money'));
        if ($money<=0){
            KS_Alert('优惠券金额必须大于0','error');
        }
		$time               = KS_G('post.time');
		$Data['addtime']    = time();
		$isuser	            = KS_G('post.isuser');
		$vocherall          = KS_G('post.vocherall');   //0选择部分用户 1所有会员 2指定用户组
		$ids                = FilterIds(KS_G('post.ids'));
		$Data['money']      = ChkFloat(KS_G('post.money'));
		$Data['isuser']     = $isuser;                 //1用户领取  0指定用户
		$Data['type']       = ChkClng(KS_G('post.type'));       //0网校通用优惠券 1指定课程
		$vocher2term        = KS_G('post.vocher2term');
		//判断是否为有时间限制
		$Data['awarddate']  =  ChkClng(KS_G('post.awarddate'));  //0不限时效  1 指定时效
		if($Data['awarddate'] == 1){
			if(empty($time)){
                KS_Alert('请选择有效时间','error');
			}else{
				$times                   = explode(' - ', $time);
				$Data['redemptionstarttime']                = strtotime($times[0]);
				$Data['redemptionendtime']                = strtotime($times[1]);
			}
		}
		//先判断 是用户自己领取还是系统直接发放
		if($isuser == 0){   //指定用户的情况，要做处理
			if($vocherall ==0){    //指定学员
				if(empty($ids)){
                    KS_Alert('请选择发放的学员','error');
                }
				$ids             = explode(',', $ids);
				$Data['number']  = count($ids);
				$Data['counts']  = $Data['number'];
			}elseif($vocherall ==1){ //全部学员
				$idss = M('common_user')->getAll('where wxid='.$this->wxid.' and usertype=0','userid');
				$ids  = array();
				foreach($idss as $k=>$v){
					$ids[$k] = $v['userid'];
				}
				$Data['number']  = count($idss);
				$Data['counts'] = $Data['number'];
			}else{  //指定用户组
				$groupid        = ChkClng(KS_G('post.groupid'));
				$idss = M('common_user')->getAll('where wxid='.$this->wxid.' and groupid='.$groupid,'userid');
				$ids  = array();
				foreach($idss as $k=>$v){
					$ids[$k] = $v['userid'];
				}
				$Data['number']  = count($idss);
				$Data['counts'] = $Data['number'];
			}
		}else{          //用户领取
			$Data['number'] = ChkClng(KS_G('post.number'));
			if(empty($Data['number'])){
                KS_Alert('请填写优惠券数量','error');
			}
			if($Data['number']>300){
                KS_Alert('优惠券数量请少于300张','error');
			}
			$Data['oneusers'] = ChkClng(KS_G('post.oneusers'));  //每天限领张数
			$Data['counts'] = 0;
		}
		//判断优惠券是否有条件限制,使用条件 0是无限制 其他任意数量为满多少可以用
		if($vocher2term == 1){
			$Data['term'] = ChkFloat(KS_G('post.term'));
			if($Data['term'] < $Data['money']){
                KS_Alert('请注意！优惠金额不能大于满减条件哦','error');
			}
		}else{
			$Data['term'] = 0;
		}
		//判断优惠券是通用型还是绑定对应课程的;
		if($Data['type'] != 0){    //绑定课程的话，需要判断 是否选择课程等
			$Data['infoid'] = ChkClng(KS_G('post.infoid'));
			if(empty($Data['infoid'])){
                KS_Alert('请选择对应课程','error');
            }
			$Data['ctype'] = ChkClng(KS_G('post.ctype'));   //0课程  1直播 7专栏 10社群

		}else{
            $Data['ctype'] = 0;
        }
		if(!empty($ids)){
			echo '
			<script src="'.UOOT.'Public/common/js/jquery.js"></script>
			<script>
				var i= 0;
				function confirmpop() {
					top.popup.open(false,{
						title:"发放优惠券",
						area:["440px","400px"],
						heightAuto:true,
						content:"<div id=divt style=text-align:center;padding:20px;font-size:16px>正在发放中...</div>"
					});
				}
			confirmpop();
			</script>';
		}
		ob_flush();
		flush();
		//更新到优惠券列表去
		$Data['wxid'] = $this->wxid;
		$Model = M('app_voucher_list');
		$id = $Model ->doAdd($Data,'id');
		$number = $Data['number'];
		unset($Data['cout']);
		unset($Data['number']);
		unset($Data['oneusers']);
		unset($Data['isuser']);
		//开始预生成优惠券
		$Model                 = M('app_voucher');
		$students = array();

		for($i=0;$i<$number;$i++){
			if($Data['money']<=0){
				KS_Alert('优惠券金额必须大于0','error');
			}else{
				if(!empty($ids)){
					$Data['memberid'] = $ids[$i];
					$student[$k]='a'.$ids[$i];
					$vuserinfo = M('common_user')->getRow('where userid='.$Data['memberid'],'openid,username');
					$nickname  = M('common_user_member')->getOne('name','where userid='.$Data['memberid']);
					if(isset($vuserinfo['openid'])&&!empty($vuserinfo['openid'])){
						$linkurl = 'http://'.APP_DOMAIN.'/h5market/MyVoucherlist';
						$tempdata =array(
						    "first" => array("value"=>"你成功领取一个优惠券", "color"=>"#173177"),
						    "keyword1"=>array("value"=>!empty($nickname)?$nickname:$vuserinfo['nickname'],"color"=>"#173177"),
						    "keyword2"=>array("value"=>'面额为'.$Data['money'].'元的优惠券', "color"=>"#173177"),
						    "keyword3"=> array("value"=>date('Y-m-d H:i:s',time()), "color"=>"#173177"),
						    "remark"=> array("value"=>"请及时确认，如有问题及时联系。", "color"=>"#173177"),
						);
						//sendwxmsg($vuserinfo['openid'],'aiHdsixu5Ache1Mx8r7UNZdKtiBzvfC9R8GZssurGJI',$tempdata,$linkurl);//暂时屏蔽掉  不然会出粗
					}
				}
				$Data['vid']      = $id;
				$Data['code']     = 'A'.$this->wxid.time().rand('1000','9999');
				$Data['mark']     = '系统生成';
				$Data['title']    = "优惠券".$Data['money'];
				$Model->doAdd($Data,'id');
			}
		}
		//发放站内信
		if(!empty($student)){
			$noticeModel    = M('app_information');
			$Datamsg['student']=implode(',',$student);
			$Datamsg['title']  = '领取优惠券';
			$Datamsg['content'] = '成领取1张'.$Data['money'].'优惠券';
			$noticeModel->doAdd($Datamsg,'id');
		}
		$url = M_URL($this->AppName.'/Index','index','',GP(''));
		// exit();
		KS_INFO('发放完成',3,$url);
	}
	/**
     * 保存修改优惠券信息
	 */
	public function doEidtVoucherAction(){
		$url    = M_URL($this->AppName.'/Index','index','',GP(''));
		$id     = ChkClng(KS_G('get.id'));
		$Model  = M('app_voucher_list');
		$number = ChkClng(KS_G('post.number'));
		$info   = $Model->getRow('where wxid='.$this->wxid.' and id='.$id);
		$Models = M('app_voucher');
		if($number <= $info['number']){
            KS_Alert('数量只能增加不可减少!','error');
		}elseif($number>300){
            KS_Alert('优惠券数量请少于300张','error');
		}else{
			$is   = $number-$info['number'];
			for($i=0;$i<$is;$i++){
				$Data['vid']      = $info['id'];
				$Data['code']     = 'A'.$this->wxid.time().rand('1000','9999');
				$Data['mark']     = '系统生成';
				$Data['title']    = '代金券';
				$Data['title']    = "优惠券".$info['money'];
				$Models->doAdd($Data,'id');
			}
			$Datas['number'] = $number;
			$Model->update($Datas,'id='.$id);
			KS_INFO('修改完成!',3,$url);
		}
	}
	/**
     * 详情列表(学员列表）
	 */
	public function vlistAction(){
		$id = ChkClng(KS_G('get.id'));
		$keyword = ChkSQL(KS_S('keyword'));
		$keytype = ChkClng(KS_S('keytype'));
		$now_page = ChkClng(KS_S('p'));
		$Model = M('app_voucher');
		$userModel = M('common_user');
		/**********先数据过一遍过期的优惠券**************/
		$infos = $Model->getAll('where  wxid='.$this->wxid.' and awarddate=1 and isuse = 0 and redemptionendtime<'.time());
		if(!empty($infos)){
			$Datas['isuse'] = 2;
			foreach($infos as $k =>$v){$Model->update($Datas,'id='.$v['id']);}
		}
		/**********开始查询优惠券列表**************/
		$stat = KS_S('stat',3);
		$where= 'as a left join '.$userModel->table.' as b on a.memberid=b.userid where a.wxid='.$this->wxid.' and a.memberid !=0  and a.vid='.$id;
		if($stat == 0){
			$where .= ' and a.isuse = 0';
		}elseif($stat == 1){
			$where .= ' and a.isuse = 1';
		}elseif($stat == 2){
			$where .= ' and a.isuse = 2';
		}
		if(!empty($keyword)){
			if($keytype==1){
				$where.=" and a.code like '%$keyword%'";
			}elseif($keytype=2){
				$where.=" and b.mobile like '%$keyword%'";
			}
		}
		$options = $Model->getOptions('15',$where);//分页参数设置
		$page = Page($options);
		$values = $Model->getPage($page,'a.id desc',$where,'a.*,b.username,b.mobile');
		include  CURR_VIEW_PATH . "vindex.php";
	}
	//发放通知的窗口
	public function sendmsgAction(){
		include  CURR_VIEW_PATH . "sendmsg.php";
	}


}