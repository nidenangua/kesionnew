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
	public function indexAction(){
		$keyword = KS_S('keyword');
		$keytype = ChkClng(KS_S('keytype'));
		$redpacketid = ChkClng(KS_G('get.id'));
		$where ='';
		$now_page = ChkClng(KS_S('p'));
		$studyCardModel = M('app_red_packet');
		$putway = ChkClng(KS_G('post.redpacket'));
		$facevalue = ChkClng(KS_G('post.facevalue'));
		$stat =null !==GF('stat') ? GF('stat'):'3';
		$where.= 'where wxid ='.$this->wxid;
		if($stat == 0){
			$where .= ' and scope = 2';
		}elseif($stat == 1){
			$where .= ' and scope = 1';
		}
		if($keytype==1){
			$where.="  and  redpacket like '%".$keyword."%'";
		}else{
			$where.="  and  facevalue like '%".$keyword."%'";
		}
		$options = $this->AppModel->getOptions('10',$where);//分页参数设置
		$page = Page($options);
		$values = $this->AppModel->getPage($page,'endtime desc',$where);
		include  CURR_VIEW_PATH . "index.php";
	}
    //进入新增课程红包页面
	public function addRedpacketAction(){
		include  CURR_VIEW_PATH . "redpacket_add.php";
	}
    //对课程红包进行数据增加
	public function doAddRedpacketAction(){
		$Data['redpacket'] = ChkSQL(KS_G('post.redpacket'));
		$Data['userid'] = $this->userid;
		$Data['wxid'] = $this->wxid;
		$Data['scope'] = ChkClng(KS_G('post.scope'));
		$Data['facevalue'] = ChkClng(KS_G('post.facevalue'));
		$Data['desc'] = ChkSQL(KS_G('post.desc'));
		$Data['pic'] = ChkSQL(KS_G('post.pic'));
		$Data['minamount'] = ChkClng(KS_G('post.minamount'));
		$Data['facevalue'] = ChkClng(KS_G('post.facevalue'));
		if($Data['minamount'] >$Data['facevalue']){
			$url1= M_URL($this->AppName.'/Index','addRedpacket','',GP(''));
		    KS_INFO('最小值不能大于红包面值',0,$url1);
		}
		$Data['status']   = ChkClng(KS_G('post.status'));
		$Data['startime'] = ChkClng(strtotime(KS_G('post.startime')));
		$Data['endtime']  = ChkClng(strtotime(KS_G('post.endtime')));
		$Data['adddate']  = time();
		if($Data['startime'] >$Data['endtime']){KS_INFO('结束时间要大于开始时间');}
		$Rule['redpacket'] = '学习卡|isEmpty';
		$Rule['desc']      = '描述|isEmpty';
		Chkpost($Data,$Rule,$this->AppModel);
		$id=$this->AppModel->doadd($Data,'id');
		$url1= M_URL($this->AppName.'/Index','index',$id,GP(''));
		KS_INFO('添加成功',0,$url1);
	}
    //进入课程红包修改页面
    public function editRedpacketAction(){
		$now_page = ChkClng(KS_S('p'));
		$id = ChkClng(KS_G("get.id"));
		$redPacket = $this->AppModel->getRow('where id ='.$id ." and wxid = " .$this->wxid);
		include  CURR_VIEW_PATH . "redpacket_add.php";
	}
    //对课程红包修改页面数据修改
    public function doEditRedpacketAction(){
		$now_page = ChkClng(KS_S('p'));
		$id = ChkClng(KS_G("get.id"));
		$Data['redpacket'] = ChkSQL(KS_G('post.redpacket'));
		$Data['startime']  = ChkClng(strtotime(KS_G('post.startime')));
        $Data['endtime']   = ChkClng(strtotime(KS_G('post.endtime')));
		$Data['desc']      = ChkSQL(KS_G('post.desc'));
		$Data['minamount'] = ChkSQL(KS_G('post.minamount'));
        $Data['facevalue'] = ChkSQL(KS_G('post.facevalue'));
        $Data['pic']       = ChkSQL(KS_G('post.pic'));
        $Data['scope']     = ChkClng(KS_G('post.scope'));
        $Data['status']    = ChkClng(KS_G('post.status'));
        $Data['adddate']   = time();
        $Rule['redpacket'] = '红包|isEmpty';
		$Rule['facevalue'] = '面值|isEmpty';
		Chkpost($Data,$Rule,$this->AppModel);
		$this->AppModel->update($Data,'id='.$id );
		$url1= M_URL($this->AppName.'/Index','index',$id,GP('p-'.$now_page));
		KS_INFO('修改成功',0,$url1);
	}
	//对课程红包删除
	public function delStudycardAction(){
		$id = ChkClng(KS_G('get.id'));
		$now_page =  ChkClng(KS_S('p',1));
		$redPacketNum=M('app_red_packetnum');
		$this->AppModel->delete("id = $id");
		$redPacketNum->delete('redpacketid ='.$id);
		$url=M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
		ks_header($url);
	}
	//对课程红包进行系列删除
	public function bathDelStudycardAction(){
		$batch = ChkClng(KS_G('post.batch'));
		$ids = ChkSQL(KS_G('post.id'));
		$now_page =  ChkClng(KS_S('p',1));
		$redPacketNum=M('app_red_packetnum');
		foreach ($ids  as $id){
			$this->AppModel->delete("id = $id");
			$redPacketNum->delete('redpacketid ='.$id);
		}
		$url=M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
		KS_INFO("删除成功",0,$url);
	}
    //进入红包卡添加页面
	public function createRedpacketNumAction(){
		$redpacketid = ChkClng(KS_G('get.id'));
		include  CURR_VIEW_PATH . "redpacketnum_add.php";
	}
    //添加红包
	public function createCardsAction(){
		$list =array();
		$list['redpacketid'] = ChkClng(KS_G('post.redpacketid'));
		$cardnum1 = ChkSQL(KS_G('post.cardnum1'));
		$cardnum2 = ChkClng(KS_G('post.cardnum2'));
		$list['isgive'] = ChkClng((KS_G('post.isgive')));
		$list['isuse'] = ChkClng((KS_G('post.isuse')));
		$list['wxid'] = $this->wxid;
		$list['userid'] = $this->userid;
		$commonUser=M('common_user');
		$memberIds= $commonUser->getAll(' where wxid ='.$list['wxid'].' and usertype = 0' ,'userid');
			//var_dump($memberIds);exit;
		foreach ($memberIds as $k=>$v){
			$list['memberid'] =$v['userid'];
			list($usec, $sec) = explode(" ", microtime());
			if($cardnum2>20||$cardnum2<10)
			{
				KS_INFO('卡号长度不能大于20位小于10位');
			}else{
				$cardnum = $cardnum1.substr('000000'.((float)$usec + (float)$sec)*10000, -$cardnum2);
			}
			$list['redpacketnum'] = $cardnum;
			$redPacketNumModel = M('app_red_packetnum');
			$redPacketNumModel->doadd($list,'id');
		}
		$url1= M_URL($this->AppName.'/Index','index','',GP(''));
		KS_INFO('添加成功',0,$url1);
	}
    //产生红包Excel
	public function createRedPacketExcelAction(){
		$id = ChkClng(KS_G("get.id"));
		$redPacketNumModel = M('app_red_packetnum');
		$list = $redPacketNumModel->getAll('where redpacketid ='.$id);
		$redPacketModel = M('app_red_packet');
		$redPacket = $redPacketModel->getRow('where id ='.$id ." and wxid = " .$this->wxid);
		foreach($list as $k=>$v){
			$lis[$k]['id']=$k;
			$lis[$k]['redpacketnum']=$v['redpacketnum'];
			$lis[$k]['startime'] = KS_DATE($redPacket['startime'],1);
			$lis[$k]['endtime'] = KS_DATE($redPacket['endtime'],1);
			$lis[$k]['facevalue']=$redPacket['facevalue'];
		}
		$xlsName = '红包'.date('Ymd');
		$textRun=$redPacket['redpacket'];
		$xlsCell  = array(
		array('id','序号'),
		array('redpacketnum','卡号'),
		array('facevalue','面值'),
		array('startime','开始时间'),
		array('endtime','结束时间'),
		);
		exportExcel($xlsName,$xlsCell,$lis,$textRun);
    }
    //展示每个红包名称的红包数
	public function viewRedpacketNumAction(){
		$keyword = KS_S('keyword');
		$keytype = ChkClng(null !==GF('keytype') ? GF('keytype'):'3');
		$stat =null !==GF('stat') ? GF('stat'):'3';
		$redpacketid = ChkClng(KS_G('get.id'));
		$redPacketModel = M('app_red_packet');
		$redPacket = $redPacketModel->getRow('where id ='.$redpacketid .' and wxid = ' .$this->wxid);
		$facevalue=$redPacket['facevalue'];
		$minamount=$redPacket['minamount'];
		
		$where ='';
		$where.= 'where a.wxid ='.$this->wxid .' and  a.redpacketid ='.$redpacketid;
		if($stat == 0){
			$where .= ' and  a.isuse = 0';
		}elseif($stat == 1){
			$where .= ' and  a.isuse = 1';
		}elseif ($stat == 2){
			$where .= ' and  a.isgive = 0';
		}elseif ($stat == 4){
			$where .= ' and a.isgive = 1';
		}elseif($stat == 3){
			$where .='';
		}
		if($keytype==1){
			$where.="  and  a.useid like '%".$keyword."%'";
		}elseif($keytype==2){
			$where.="  and a.redpacketnum like '%".$keyword."%'";
		}
		$redPacketNumModel = M('app_red_packetnum');
		$line = "as a left join ks_common_user as b on a.memberid = b.userid ";
		$options = $redPacketNumModel->getOptions('10',$line.$where);//分页参数设置
		$page    = Page($options);
		$values  = $redPacketNumModel->getPage($page,'a.id desc',$line.$where);
		include  CURR_VIEW_PATH . "redpacket.php";
	}
	//对红包进行删除删除
	public function delRedpacketNumAction(){
		$id = ChkClng(KS_G('get.id'));
		$now_page =  ChkClng(KS_S('p',1));
		$redPacketNumModel = M('app_red_packetnum');
		$redPacketid = $redPacketNumModel->getOne('redpacketid','where id ='.$id );
		$redPacketNumModel->delete("id = $id");
		$url=M_URL($this->AppName.'/Index','viewRedpacketNum',$redPacketid,GP('p-'.$now_page));
		KS_INFO("删除成功",0,$url);
	}
	//进行红包数系列删除
	public function bathDelRedpacketNumAction(){
		$ids = ChkSQL(KS_G('post.id'));
		$now_page =  ChkClng(KS_S('p',1));
		$redPacketNumModel = M('app_red_packetnum');
		$redPacketid = ChkClng(KS_G('post.redpacketid'));
		foreach ($ids  as $id){
			$redPacketNumModel->delete("id = $id");
		}
		$url=M_URL($this->AppName.'/Index','viewRedpacketNum',$redPacketid,GP('p-'.$now_page));
		KS_INFO("删除成功",0,$url);
	}
	//红包应用配置
	public function settingAction(){
		echo '红包应用配置';exit;
	}
}