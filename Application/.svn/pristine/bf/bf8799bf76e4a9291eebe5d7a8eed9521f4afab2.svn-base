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
class DomainController extends CommonController
{
	private $customerstatus = [1=>'意向',2=>'已成交',3=>'失效',4=>'已发合同',5=>'已过期',6=>'无意向'];
	/*
 	 * 我的客户列表
     */
	public function clientListAction()
	{
		//排序
		$option=null !==GF('option') ? GF('option'):'3';//状态筛选
		$adddate       = ChkClng(KS_S('adddate'));            //到期时间
		$logintimes    = ChkClng(KS_S('logintimes',1));         //登录次数
		$lastlogintime = ChkClng(KS_S('lastlogintime',1));      //最后登录
		$now_page = null !==GF('p') ? GF('p'):1;
		$id =null !==GF('id') ? GF('id'):1;
		$sms=null !==GF('sms') ? GF('sms'):1;
		$mail=null !==GF('mail') ? GF('mail'):1;
		$type=null !==GF('type') ? GF('type'):3;
		$vodmoney =null !==GF('vodmoney') ? GF('vodmoney'):1;
		$vodspace =null !==GF('vodspace') ? GF('vodspace'):1;
		$livemoney =null !==GF('livemoney') ? GF('livemoney'):1;
		$status  = KS_S('status',3);
		$package = KS_S('package',100);
		$wstatus=null !==GF('wstatus') ? GF('wstatus'):100;
		$categoryid = null!==GF('categoryid') ? GF('categoryid'):0;
		$areaid = null!==GF('areaid') ? GF('areaid'):0;
		$sumsmsnum=null !==GF('sumsmsnum') ? GF('sumsmsnum'):1;
		$sumemailnum=null !==GF('sumemailnum') ? GF('sumemailnum'):1;
		$sumvodmoney=null !==GF('sumvodmoney') ? GF('sumvodmoney'):1;
		$sumvodspace=null !==GF('sumvodspace') ? GF('sumvodspace'):1;
		$sumlivemoney=null !==GF('sumlivemoney') ? GF('sumlivemoney'):1;
		$orderby[GN('sms')] = 'sms/a.smsnum';
		$orderby[GN('logintimes')] = 'logintimes/b.logintimes';
		$orderby[GN('lastlogintime')] = 'lastlogintime/c.lastlogintime';
		$orderby[GN('mail')]         = 'mail/a.emailnum';
		$orderby[GN('adddate')]       = 'adddate/b.packendtime';
		$orderby[GN('vodmoney')]       = 'vodmoney/a.vodmoney';
		$orderby[GN('vodspace')]       = 'vodspace/a.vodspace';
		$orderby[GN('livemoney')]       = 'livemoney/a.livemoney';
		$orderby[GN('sumsmsnum')] = 'sumsmsnum/a.sumsmsnum';
		$orderby[GN('sumemailnum')]         = 'sumemailnum/a.sumemailnum';
		$orderby[GN('sumvodmoney')]       = 'sumvodmoney/a.sumvodmoney';
		$orderby[GN('sumvodspace')]       = 'sumvodspace/a.sumvodspace';
		$orderby[GN('sumlivemoney')]       = 'sumlivemoney/a.sumlivemoney';

		//状态筛选
		$keytype = ChkClng(KS_S('keytype',1));
		$keyword = ChkSQL(KS_S('keyword'));
		$outtime = ChkClng(KS_S('outtime',0));
		if (empty($outtime)){
			$outtime =  ChkClng(GF('outtime'));
		}
		$customerstatus = ChkClng(KS_S('customerstatus',0));
		$where = " where a.status!=-1 and b.salesman='".$this->admininfo['username']."'";
		if (!empty($keyword)){
			if ($keytype==1){
				$where .= " and b.sitename like '%$keyword%'";
			}else{
				$where .= " and c.username like '%$keyword%'";
			}
		}
		if (!empty($customerstatus)){
			$where .= " and b.customerstatus=$customerstatus";
		}
		$star = ChkSQL(KS_S('startime',0));
		$end = ChkSQL(KS_S('endtime',0));
		if ($outtime!=0){
			if ($outtime==2){
				$where .= " and b.followdate>=".strtotime(date('Y-m-d'),time());
			}elseif ($outtime==3){
				$where .= " and (b.followdate=0 or b.nextdate>=".time().")";
			}elseif ($outtime==4||$outtime==5){
				$time_field = $outtime==4?'followdate':'nextdate';
				$startime = strtotime($star);
				$endtime = strtotime($end);
				if (!empty($startime)&&empty($endtime)){
					$where .= " and $time_field>=$startime";
				}
				if (empty($startime)&&!empty($endtime)){
					$where .= " and $time_field<=$endtime";
				}
				if (!empty($startime)&&!empty($endtime)){
					$where .= " and $time_field BETWEEN $startime AND $endtime";
				}
			}
		}
		if($package==0){$where.=" and b.package='v0'";}
		elseif($package==1){$where.=" and b.package='v1'";}
		elseif($package==2){$where.=" and b.package='v2'";}
		elseif($package==3){$where.=" and b.package='v3'";}
		elseif($package==4){$where.=" and b.package='v4'";}
		elseif($package==5){$where.=" and b.package='v5'";}
		if($categoryid==0){$where.="";}
		else{$where.=" and b.categoryid=".$categoryid;}

		if($areaid==0){$where.="";}
		else{$where.=" and (b.provinceid=".$areaid.' or b.cityid='.$areaid.' or b.countyid='.$areaid.')';}
		$now_page = null !==GF('p') ? GF('p'):1;
		$common_domain  = M('common_domain');
		$common_website = M('common_user_website');
		$common_user = M('common_user');
		$table = 'as a left join '.$common_website->table.' as b on a.wxid = b.wxid left join '.$common_user->table.' as c on b.userid = c.userid';
		$options = $common_domain->getOptions(15,$table.$where);//分页参数设置
		$options['now_page'] = $now_page;
		$page    = Page($options);

		$values  = $common_domain->getPage($page,OB($orderby),$table.$where,'b.wilogo,b.status as status1,b.followdate,b.nextdate,b.starlevel,a.*,b.logintimes,b.sunmoney,b.sitename,b.package,b.salesman,b.packendtime,b.money,b.withdrawmoney,b.logo,c.usertype,c.mobile,c.username,c.lastlogintime');
		$withdraw_log = M('common_withdraw_log');
		$followModel = M('common_user_follow');
		if(!empty($values)){
			foreach($values as $k =>$v){
				$follow = $followModel->getRow("where wxid=$v[wxid] order by id desc limit 1");
				if ($follow){
					$values[$k]['customerstatus'] = $this->customerstatus[$follow['customerstatus']];
					$values[$k]['follow_content'] = $follow['content'];
				}
				$sum = $common_user->getOne('count(userid)','where wxid='.$v['wxid'].' and usertype=0');
				$values[$k]['sum'] = $sum;
				$sum  = $withdraw_log->getOne('count(userid)','where wxid='.$v['wxid']);
				$values[$k]['withmoney'] = $sum;
				$setting = $this->cache->GetH('apprelate','appid',19,'setting',$v['wxid']);
				if(!empty($setting)){
					$setting = explode('※',$setting);
					$values[$k]['setting']= $setting;
				}else{
					$values[$k]['setting']= array('1'=>0);
				}
			}
		}
		include  CURR_VIEW_PATH . "Domain/admin.clientList.php";
	}
	/**
	 * 添加我的客户页面
	 */
	public function ClientAction()
	{
		$wxid = ChkClng(KS_G('get.id'));
		$now_page = GF('p');
		include CURR_VIEW_PATH.'Domain/admin.addClient.php';
	}
	/**
	 *  保存我的客户
	 */
	public function dosaveClientAction()
	{
		$username = ChkSQL(KS_G('post.username'));
		$starlevel = ChkClng(KS_G('post.starlevel'));
		$db_website= M('common_user_website');
		$userModel = M('common_user');
		$user = $userModel->getRow("where username='$username'");
		if (!$user)  KS_INFO('没有该用户',0,'','',3);
		$website = $db_website->getOne('salesman',"where wxid=$user[wxid]");
		if (!empty($website)) KS_INFO('该用户已有业务员',0,'','',3);
		$Data['salesman'] = $this->admininfo['username'];
		$Data['starlevel'] = $starlevel;
		$now_page = GF('p');
		$db_website->update($Data,'wxid='.$user['wxid']);
		$this->cache->PutHCache('website',$user['wxid']);
		$url =  M_URL('home/Domain','clientList','',GP('p-'.$now_page));
		KS_INFO('',3,$url);
	}
	/*
	 * 跟进记录列表
	 */
	public function followListAction()
	{
		$wxid = ChkClng(KS_G('get.id'));
		$where = " where wxid=$wxid";
		$now_page = null !==GF('p') ? GF('p'):1;
		$followModel = M('common_user_follow');
		$options = $followModel->getOptions(15,$where);//分页参数设置
		$options['now_page'] = $now_page;
		$page    = Page($options);
		$values  = $followModel->getPage($page,'adddate desc',$where,'');

		include  CURR_VIEW_PATH . "Domain/admin.followList.php";
	}
	/*
	 * 添加记录
	 */
	public function FollowAction()
	{
		$wxid = ChkClng(KS_G('get.id'));
		include  CURR_VIEW_PATH . "Domain/admin.addFollow.php";
	}
	/*
	 * 保存跟进记录
	 */
	public function dosaveFollowAction()
	{
		$wxid = ChkClng(KS_G('get.id'));
		$customerstatus = ChkClng(KS_G('post.customerstatus'));
		$content = ChkSQL(KS_G('post.content'));
		$followdate = strtotime(ChkSQL(KS_G('post.followdate')));
		$nextdate = strtotime(ChkSQL(KS_G('post.nextdate')));
		if (empty($followdate)) KS_INFO('请选择跟进时间',0,'','',3);
		$now_page = GF('p');
		$type = GF('type');
		$model = M('common_user_follow');
		$data['wxid'] = $wxid;
		$data['salesman'] = $this->admininfo['username'];
		$data['content'] = $content;
		$data['customerstatus'] = $customerstatus;
		$data['adddate'] = time();
		$res = $model->doAdd($data,'id');
		if ($res){
			$webstieModel = M('common_user_website');
			$data_website['followdate'] = $followdate;
			$data_website['customerstatus'] = $customerstatus;
			if (!empty($nextdate)) $data_website['nextdate'] = $nextdate;
			$webstieModel->update($data_website,"wxid=$wxid");
			if ($type==1){
				$url =  M_URL('home/Domain','clientList',$wxid,GP('p-'.$now_page));
			}else{
				$url =  M_URL('home/Domain','followList',$wxid,GP('p-'.$now_page));
			}
			KS_INFO('',3,$url);
		}else{
			KS_INFO('添加失败',0,'','');
		}
	}
	/*
	 * 删除跟进记录
	 */
	public function delFollowAction()
	{
		$id = ChkClng(KS_G('get.id'));
		$wxid = ChkClng(GF('wxid'));
		$now_page = GF('p');
		$model = M('common_user_follow');
		$res = $model->delete("id=$id");
		if ($res){
			$url =  M_URL('home/Domain','followList',$wxid,GP('p-'.$now_page));
			KS_INFO('',3,$url);
		}else{
			KS_INFO('添加失败',0,'','');
		}
	}
    /**
     * 网校管理
     */
	public function wxlistAction(){
		//$where = ' where a.status !=-1';
		$where = ' where 1=1 ';
		$option=null !==GF('option') ? GF('option'):'3';//状态筛选
		$keyword = ChkSQL(KS_S('keyword'));
		$keytype = ChkClng(KS_S('keytype',1));
		$adddate       = ChkClng(KS_S('adddate'));             //到期时间
		$logintimes    = ChkClng(KS_S('logintimes',1));         //登录次数
		$lastlogintime = ChkClng(KS_S('lastlogintime',1));      //最后登录
		$now_page = null !==GF('p') ? GF('p'):1;
		$id =null !==GF('id') ? GF('id'):1;
		$sms=null !==GF('sms') ? GF('sms'):1;
		$mail=null !==GF('mail') ? GF('mail'):1;
        $searchuser=KS_S("searchuser");             //标注是否搜索用户表 1是 0否
		$type= KS_S('type',3);     //2机构 1老师 3不限
		$istranscode= KS_S('istranscode');     //开启视频转码 2机构 1老师 3不限
		$befrom= KS_S('befrom',0);     //注册来源 1PC端 2微信公众号 3V名师
        $outtime = ChkClng(KS_G('post.outtime'));          //按注册时间段筛选
		$vodmoney =null !==GF('vodmoney') ? GF('vodmoney'):1;
		$vodspace =null !==GF('vodspace') ? GF('vodspace'):1;
		$livemoney =null !==GF('livemoney') ? GF('livemoney'):1;
		$status  = KS_S('status',3);
		$package = KS_S('package',100);        //套餐版本

        $common_domain  = M('common_domain');
		$common_website = M('common_user_website');
        $common_user = M('common_user');

        $table = 'as a ';
        if ($searchuser==1){  //查询用户表
            $table .= ' left join '.$common_user->table.' as c on a.userid = c.userid';
        }

        if (!empty($istranscode) || !empty(KS_S("vodmoney")) || !empty(KS_S("sms")) ||!empty(KS_S("sumsmsnum"))||!empty(KS_S("mail"))||!empty(KS_S("sumemailnum"))||!empty(KS_S("sumvodmoney"))||!empty(KS_S("vodspace"))||!empty(KS_S("sumvodspace"))||!empty(KS_S("livemoney"))||!empty(KS_S("sumlivemoney"))){  //启用domain表筛选
            $table .= ' left join '.$common_domain->table.' as b on a.userid = b.userid';
        }
		if ($istranscode==1){
			$where .= ' and b.istranscode=1';
		}elseif ($istranscode==2){
			$where .= ' and b.istranscode=0';
		}
		if (!empty($befrom)){
			$where.=' and befrom='.$befrom;
		}
        //搜索
        if(!empty($keyword)){
			if($keytype==1){$where.=" and a.sitename like '%$keyword%'";}
			elseif($keytype==2){$where.=" and a.wxid in(select wxid from ".$common_domain->table." Where domain like '%$keyword%')";}
			elseif($keytype==3){$where.=" and c.usertype>0 and c.username like '%$keyword%'";}
			elseif($keytype==4){$where.=" and a.wxid =$keyword";}
			elseif($keytype==5){$where.=" and c.mobile='$keyword'";}
			elseif($keytype==6){$where.=" and a.salesman ='$keyword'";}
		}


        //按版本筛选
        if ($package!=100){
            switch($package){
                case 1:
                    $where.=' and package="v1"';
                    break;
                case 2:
                    $where.=' and package="v2"';
                    break;
                case 3:
                    $where.=' and package="v3"';
                    break;
                case 0:
                    $where.=' and istry=1';
                    break;
            }
        }


        if ($outtime==1){    //本周
            $where.=" and YEARWEEK(FROM_UNIXTIME( `regdate`, '%Y-%m-%d %H:%i:%s' ) ,1) = YEARWEEK( now( ),1 )";
        }
        else if($outtime==2){           //本月
			$start = date('Y-m-01 00:00:00');
            $end = date('Y-m-d H:i:s');
			$where.=" and c.regdate>=unix_timestamp('$start') && c.regdate<=unix_timestamp('$end')";
		}else if($outtime==3){   //本年
			$start = date('Y-01-01 00:00:00');
            $end = date('Y-m-d H:i:s');
			$where.=" and c.regdate>=unix_timestamp('$start') && c.regdate<=unix_timestamp('$end')";
		}else if($outtime==4){  //自定义
			$start1 = ChkSQL(KS_S('startime'));
			$end1 = ChkSQL(KS_S('endtime'));

			$strtime = strtotime($start1);
			$endtime = strtotime($end1);
			$where.=' and c.regdate > '.$strtime.' and c.regdate < '.$endtime;
		}


		/*---------     排序相关-----------*/
		//现有量

		$orderby[GN('sms')] = 'sms/b.smsnum';

		$orderby[GN('logintimes')] = 'logintimes/c.logintimes';
		$orderby[GN('lastlogintime')] = 'lastlogintime/c.lastlogintime';
        $orderby[GN('mail')]         = 'mail/b.emailnum';
        $orderby[GN('adddate')]       = 'adddate/a.packendtime';
        $orderby[GN('vodmoney')]       = 'vodmoney/b.vodmoney';
		$orderby[GN('vodspace')]       = 'vodspace/b.vodspace';
		$orderby[GN('livemoney')]       = 'livemoney/b.livemoney';
		//总量
		$sumsmsnum=null !==GF('sumsmsnum') ? GF('sumsmsnum'):1;
		$sumemailnum=null !==GF('sumemailnum') ? GF('sumemailnum'):1;
		$sumvodmoney=null !==GF('sumvodmoney') ? GF('sumvodmoney'):1;
		$sumvodspace=null !==GF('sumvodspace') ? GF('sumvodspace'):1;
		$sumlivemoney=null !==GF('sumlivemoney') ? GF('sumlivemoney'):1;

		$orderby[GN('sumsmsnum')] = 'sumsmsnum/b.sumsmsnum';
        $orderby[GN('sumemailnum')]         = 'sumemailnum/b.sumemailnum';
        $orderby[GN('sumvodmoney')]       = 'sumvodmoney/b.sumvodmoney';
		$orderby[GN('sumvodspace')]       = 'sumvodspace/b.sumvodspace';
		$orderby[GN('sumlivemoney')]       = 'sumlivemoney/b.sumlivemoney';
		$orderby[GN('id')] = 'wxid/a.wxid';
		/*---------     排序结束-----------*/

		if($type == 1){
            $where.=" and c.usertype = 1 ";
        }elseif($type == 2){
            $where.=" and c.usertype = 2";
        }

		if($status==1){                      //状态筛选
            $where.=" and status=0";
        }
		elseif($status==2){
            $where.=" and status=3";
        }

        //查询本年
        $start = date('Y-01-01 00:00:00');
        $end = date('Y-m-d H:i:s');
        $yearCout = $common_user->getOne('count(userid)',"where usertype>0 and regdate>=unix_timestamp('$start') && regdate<=unix_timestamp('$end')");

        //查询本月
        $start = date('Y-m-01 00:00:00');
        $end = date('Y-m-d H:i:s');
        $mCout = $common_user->getOne('count(userid)',"where usertype>0 and regdate>=unix_timestamp('$start') && regdate<=unix_timestamp('$end')");

        //查询本周
        $weekCount = $common_user->getOne('count(userid)',"where usertype>0 and YEARWEEK(FROM_UNIXTIME( `regdate`, '%Y-%m-%d %H:%i:%s' ) ,1) = YEARWEEK( now( ),1 )");

        //查询本日
        $start = date('Y-m-d 00:00:00');
        $end = date('Y-m-d H:i:s');
        $dayCout = $common_user->getOne('count(userid)',"where usertype>0 and regdate>=unix_timestamp('$start') && regdate<=unix_timestamp('$end')");

		$options = $common_website->getOptions(5, $table.$where);//分页参数设置
		$options['now_page'] = $now_page;
		$page    = Page($options);
		$values  =$common_website->getPage($page,OB($orderby),$table.$where,'a.*');
		$befromArr = ['1'=>'PC端','2'=>'微信公众号','3'=>'V师名片'];

		//$values  =$common_website->getPage($page,OB($orderby),$table.$where,'b.wilogo,b.status as status1,a.*,b.logintimes,b.sunmoney,b.sitename,b.package,b.salesman,b.packendtime,b.money,b.withdrawmoney,b.logo,c.usertype,c.mobile,c.username,c.lastlogintime');
        if (KS_S('excel')=='1')
        {
            if($outtime==0 &&empty($keyword)){
               KS_Alert("请选择导出的时间段或是输入关键字搜索",'error',KS_ComeUrl());
            }

            $excelvalues = $common_domain->getAll($where,$field);
            $withdraw_log = M('common_withdraw_log');
            if(!empty($excelvalues)){
                foreach($excelvalues as $k =>$v){
                    if(!empty($this->cache->GetA('commonpackageversion','versionename',$v['package'],'versionname'))){
                        $excelvalues[$k]['version'] = $this->cache->GetA('commonpackageversion','versionename',$v['package'],'versionname');
                    }else{
                        $excelvalues[$k]['version'] = "暂无";
                    }
                    $excelvalues[$k]['adddate'] = KS_DATE($v['adddate']);
                    $excelvalues[$k]['packendtime'] = KS_DATE($v['adddate'],1);
                    $sum = $common_user->getOne('count(userid)','where wxid='.$v['wxid'].' and usertype=0');
                    $excelvalues[$k]['sum'] = $sum;
                    $sum  = $withdraw_log->getOne('count(userid)','where wxid='.$v['wxid']);
                    $excelvalues[$k]['withmoney'] = $sum;
                    $excelvalues[$k]['balance'] = '￥'.Field($v['money']).'/'.Field($v['sunmoney']);
                    $excelvalues[$k]['income'] = '￥'.Field($v['withdrawmoney']).'/'.Field($excelvalues[$k]['withmoney']);
                }
            }

            $xlsName     = '网校信息列表';//文件名
            $textRun     = $xlsName;//表名
            $xlsCell  = array(
                array('id','序号'),
                array('wxid','网校ID'),
                array('sitename','网校名称'),
                array('username','用户名'),
                array('domain','域名'),
                array('version','套餐类型'),
                array('logintimes','登录次数'),
                array('sum','学员数量'),
                array('adddate','注册时间'),
                array('salesman','业务员'),
                array('packendtime','到期时间'),
                array('balance','余额(可用/累计)'),
                array('income','收入(未提现/已提现)'),
            );
            exportExcel($xlsName,$xlsCell,$excelvalues,$textRun);
        }
		// var_dump($values);
		$link     = Linkage(array());
		$link->cachename      = 'areainfo';
		$link->inputname      = 'areaid';// <select name='' /> 里的name值
		$link->idname         = 'id';
		$link->funcname       = 'getchildtwo';
		$link->childvaluename = 'city';
		$link->childidname    = 'id';
		include  CURR_VIEW_PATH . "Domain/admin.wxlist.php";
	}

    /**
     * 获取token 登录HOME端
     */
    public function loginHomeAction(){
        $wxid      =  ChkClng(KS_G('get.id'));
        $db_user = M('common_user');
        $Data['h5token']    = KS_MD5($wxid.rand(1000,10000).time(),32);
        $Data['tokentime']  = time()+7200;
        $db_user->update($Data,'wxid='.$wxid.' and usertype>0');
        ks_header(wx_Url($wxid).'/home.html?managetoken='.KS_MD5($Data['h5token'],32));

    }

	//网校导出
	public function wxpaylogexcelAction(){
		$where = ' where a.status !=-1';
		$option=null !==GF('option') ? GF('option'):'3';//状态筛选
		$keyword = ChkSQL(KS_S('keyword'));
		$keytype = ChkClng(KS_S('keytype',1));
		$adddate=null !==GF('adddate') ? GF('adddate'):1;
		$now_page = null !==GF('p') ? GF('p'):1;
		$id =null !==GF('id') ? GF('id'):1;
		$sms=null !==GF('sms') ? GF('sms'):1;
		$mail=null !==GF('mail') ? GF('mail'):1;
		$type=null !==GF('type') ? GF('type'):3;
		$vodmoney =null !==GF('vodmoney') ? GF('vodmoney'):1;
		$vodspace =null !==GF('vodspace') ? GF('vodspace'):1;
		$logintimes =null !==GF('logintimes') ? GF('logintimes'):1;
		$livemoney =null !==GF('livemoney') ? GF('livemoney'):1;
		$status=KS_S('status',3);
		$package=null !==GF('package') ? GF('package'):0;
		$wstatus=null !==GF('wstatus') ? GF('wstatus'):100;
		$categoryid = null!==GF('categoryid') ? GF('categoryid'):0;
		$areaid = null!==GF('areaid') ? GF('areaid'):0;
		if(!empty($keyword)){
			if($keytype==1){$where.=" and b.sitename like '%$keyword%'";}
			elseif($keytype==2){$where.=" and a.domain like '%$keyword%'";}
			elseif($keytype==3){$where.=" and c.username like '%$keyword%'";}
			elseif($keytype==4){$where.=" and a.wxid =$keyword";}
		}
		$paperid = ChkClng(KS_G('post.outtime'));

		if(empty($paperid)){
			$url=M_URL('Domain','wxlist','',GP('p-'.$now_page));
			KS_INFO("请选择导出的类型",0,$url);
		}
		/*---------     排序相关-----------*/
		//现有量

		$orderby[GN('sms')] = 'sms/a.smsnum';

		$orderby[GN('logintimes')] = 'logintimes/b.logintimes';
		$orderby[GN('mail')]         = 'mail/a.emailnum';
		$orderby[GN('adddate')]       = 'adddate/b.packendtime';
		$orderby[GN('vodmoney')]       = 'vodmoney/a.vodmoney';
		$orderby[GN('vodspace')]       = 'vodspace/a.vodspace';
		$orderby[GN('livemoney')]       = 'livemoney/a.livemoney';
		//总量
		$sumsmsnum=null !==GF('sumsmsnum') ? GF('sumsmsnum'):1;
		$sumemailnum=null !==GF('sumemailnum') ? GF('sumemailnum'):1;
		$sumvodmoney=null !==GF('sumvodmoney') ? GF('sumvodmoney'):1;
		$sumvodspace=null !==GF('sumvodspace') ? GF('sumvodspace'):1;
		$sumlivemoney=null !==GF('sumlivemoney') ? GF('sumlivemoney'):1;

		$orderby[GN('sumsmsnum')] = 'sumsmsnum/a.sumsmsnum';
		$orderby[GN('sumemailnum')]         = 'sumemailnum/a.sumemailnum';
		$orderby[GN('sumvodmoney')]       = 'sumvodmoney/a.sumvodmoney';
		$orderby[GN('sumvodspace')]       = 'sumvodspace/a.sumvodspace';
		$orderby[GN('sumlivemoney')]       = 'sumlivemoney/a.sumlivemoney';
		$orderby[GN('id')] = 'id/a.id';
		/*---------     排序结束-----------*/
		if($type == 1){$where.=" and c.usertype = 1 ";}elseif($type == 2){$where.=" and c.usertype = 2";}
		if($status==1){$where.=" and b.status=0";}
		elseif($status==2){$where.=" and b.status=3";}

		if($package==1){$where.=" and b.package='v1'";}
		elseif($package==2){$where.=" and b.package='v2'";}
		elseif($package==3){$where.=" and b.package='v3'";}
		elseif($package==4){$where.=" and b.package='v4'";}
		elseif($package==5){$where.=" and b.package='v5'";}

		if($categoryid==0){$where.="";}
		else{$where.=" and b.categoryid=".$categoryid;}

		if($areaid==0){$where.="";}
		else{$where.=" and (b.provinceid=".$areaid.' or b.cityid='.$areaid.' or b.countyid='.$areaid.')';}
		$common_user = M('common_user');
		$common_domain  = M('common_domain');
		$common_website = M('common_user_website');
		$table = 'as a left join '.$common_website->table.' as b on a.wxid = b.wxid left join '.$common_user->table.' as c on b.userid = c.userid';
		$start = null !==KS_G('startime') ? KS_G('startime'):'';
		$endtime = null !==KS_G('endtime') ? KS_G('endtime'):'';
		$field = 'a.id,a.wxid,a.domain,a.adddate,b.logintimes,b.sunmoney,b.sitename,b.package,b.packendtime,b.money,b.withdrawmoney,c.username';
		if($paperid==1){
			$options = $common_domain->getOptions(15,$table.$where);//分页参数设置
			$options['now_page'] = $now_page;
			$page    = Page($options);
			$values  = $common_domain->getPage($page,OB($orderby),$table.$where,$field);
		}else if($paperid==2){
			$month = date('Y-m',time());
			$strtime = strtotime($month.'-01');
			$where=' where a.status !=-1 and a.adddate > '.$strtime.' order by adddate desc';
			$values = $common_domain->getAll($table.$where,$field);
		}else if($paperid==3){
			$year = date('Y',time());
			$strtime = strtotime($year.'-01-01');
			$where=' where a.status !=-1 and a.adddate > '.$strtime.' order by adddate desc';
			$values = $common_domain->getAll($table.$where,$field);
		}else if($paperid==4){
			$strtime = strtotime($start);
			$endtime = strtotime($endtime);
			$where=' where a.status !=-1 and a.adddate > '.$strtime.' and a.adddate < '.$endtime.' order by adddate desc';
			$values = $common_domain->getAll($table.$where,$field);
		}
		$withdraw_log = M('common_withdraw_log');
		if(!empty($values)){
			foreach($values as $k =>$v){
				if(!empty($this->cache->GetA('commonpackageversion','versionename',$v['package'],'versionname'))){
					$values[$k]['version'] = $this->cache->GetA('commonpackageversion','versionename',$v['package'],'versionname');
				}else{
					$values[$k]['version'] = "暂无";
				}
				$values[$k]['adddate'] = KS_DATE($v['adddate']);
				$values[$k]['packendtime'] = KS_DATE($v['adddate'],1);
				$sum = $common_user->getOne('count(userid)','where wxid='.$v['wxid'].' and usertype=0');
				$values[$k]['sum'] = $sum;
				$sum  = $withdraw_log->getOne('count(userid)','where wxid='.$v['wxid']);
				$values[$k]['withmoney'] = $sum;
				$values[$k]['balance'] = '￥'.Field($v['money']).'/'.Field($v['sunmoney']);
				$values[$k]['income'] = '￥'.Field($v['withdrawmoney']).'/'.Field($values[$k]['withmoney']);
			}
		}
		$xlsName     = '网校信息列表';//文件名
		$textRun     = $xlsName;//表名
		$xlsCell  = array(
			array('id','序号'),
			array('wxid','网校ID'),
			array('sitename','网校名称'),
			array('username','用户名'),
			array('domain','域名'),
			array('version','套餐类型'),
			array('logintimes','登录次数'),
			array('sum','学员数量'),
			array('adddate','注册时间'),
			array('salesman','业务员'),
			array('packendtime','到期时间'),
			array('balance','余额(可用/累计)'),
			array('income','收入(未提现/已提现)'),
		);
		exportExcel($xlsName,$xlsCell,$values,$textRun);
	}
     /**
     * 域名列表页
      */
     public function indexAction(){
		$status= ChkClng(KS_S("status"));    //状态筛选
		$db_website=M('common_user_website');
		switch ($status){
			case 1:
				$where=' where a.status=1';
				break;
			case 2:
				$where=' where a.status=2';
				break;
			case 3:
				$where=' where a.status=0';
				break;
			default:
				$where=' where 1=1';
				break;
		}

		$where1= " where predomain<>''";
		$where.=" and predomain<>''";

		$byname= KS_S('byname','adddate desc');//排序
		$keyword= KS_S('keyword');
		$keytype= KS_S('keytype',1);
		if(!empty($keyword)){
			if($keytype==1){$where.=" and a.domain like '%$keyword%'";}
			elseif($keytype==2){$where.=" and a.predomain like '%$keyword%'";}
			elseif($keytype==3){$where.=" and a.wxid like '%$keyword%'";}
			elseif($keytype==4){$where.=" and b.sitename like '%$keyword%'";}
		}
		$common_domain = M('common_domain');

        $where = ' as a left join '.$db_website->table.' as b on a.wxid=b.wxid '.$where;

		//查询本年
		$start = date('Y-01-01 00:00:00');
		$end = date('Y-m-d H:i:s');
		$yearCout = $common_domain->getOne('count(id)',$where1." and adddate>=unix_timestamp('$start') && adddate<=unix_timestamp('$end')");

		//查询本月
		$start = date('Y-m-01 00:00:00');
		$end = date('Y-m-d H:i:s');
		$mCout = $common_domain->getOne('count(id)',$where1." and adddate>=unix_timestamp('$start') && adddate<=unix_timestamp('$end')");

        //查询本周
		$weekCount = $common_domain->getOne('count(id)',$where1." and YEARWEEK(FROM_UNIXTIME( `adddate`, '%Y-%m-%d %H:%i:%s' ) ,1) = YEARWEEK( now( ),1 )");

		//查询本日
		$start = date('Y-m-d 00:00:00');
		$end = date('Y-m-d H:i:s');
		$dayCout = $common_domain->getOne('count(id)',$where1." and adddate>=unix_timestamp('$start') && adddate<=unix_timestamp('$end')");


		$options = $common_domain->getOptions('8',$where);//分页参数设置
		$page = Page($options);
		$values = $common_domain->getPage($page,'a.'.$byname,$where,'a.*,b.sitename');

		$totalnum = $common_domain->getOne('count(*)',$where1.'');       //总数
		$status0 = $common_domain->getOne('count(*)',$where1.' and status=0');       //未审核
		$status1 = $common_domain->getOne('count(*)',$where1.' and status=1');       //已通过
		$status2 = $common_domain->getOne('count(*)',$where1.' and status=2');      //未通过

        include  CURR_VIEW_PATH . "Domain/domain_list.php";
    }
    public function apilistAction(){
    	$where = ' where a.status !=-1 and c.isapi=1';
		$keyword = ChkSQL(KS_S('keyword'));
		$keytype = ChkClng(KS_S('keytype',1));
		$now_page = null !==GF('p') ? GF('p'):1;
		if(!empty($keyword)){
			if($keytype==1){$where.=" and b.sitename like '%$keyword%'";}
			elseif($keytype==2){$where.=" and c.username like '%$keyword%'";}
		}
		$common_user = M('common_user');
		$wx          = $common_user->getOne('count(userid)','where usertype = 2');
		$teachers    = $common_user->getOne('count(userid)','where usertype = 1 and parentid = 0');
		$common_domain  = M('common_domain');
		$common_website = M('common_user_website');
		$m =mktime(0,0,0,date('m'),1,date('Y'));
		$day =  mktime(0,0,0,date('m'),date('d'),date('Y'));
		if(date("w")==0){$wday = 7;}else{$wday = date("w");}
		$week =  mktime(0,0,0,date("m"),date("d")-$wday+1,date("Y"));
		$year =  mktime(0,0,0,1,1,date('Y'));

		$table = 'as a left join '.$common_domain->table.' as b on a.wxid = b.wxid left join '.$common_user->table.' as c on a.userid = c.userid';
		$yearCout = $common_website->getOne('count(a.wxid)',$table.$where.' and c.regdate>'.$year);
		$mCout = $common_website->getOne('count(a.wxid)',$table.$where.' and c.regdate>'.$m);
		$weekCount = $common_website->getOne('count(a.wxid)',$table.$where.' and c.regdate>'.$week);
		$dayCout = $common_website->getOne('count(a.wxid)',$table.$where.' and c.regdate>'.$day);
		$options = $common_website->getOptions(15,$table.$where);//分页参数设置
		$options['now_page'] = $now_page;
		$page    = Page($options);
		$values  = $common_website->getPage($page,'a.wxid desc',$table.$where,'a.userid,a.wxid,c.regdate,a.status as status1,b.domain,a.logintimes,a.sunmoney,a.sitename,a.package,a.istry,a.packendtime,a.logo,c.usertype,c.mobile,c.username,c.isallow');
		$withdraw_log = M('common_withdraw_log');
		if(!empty($values)){
			foreach($values as $k =>$v){
				$sum = $common_user->getOne('count(userid)','where wxid='.$v['wxid'].' and usertype=0');
				$values[$k]['sum'] = $sum;
				$sum  = $withdraw_log->getOne('count(userid)','where wxid='.$v['wxid']);
				$values[$k]['withmoney'] = $sum;
				$setting = $this->cache->GetH('apprelate','appid',19,'setting',$v['wxid']);
				if(!empty($setting)){
					$setting = explode('※',$setting);
	   				$values[$k]['setting']= $setting;
				}else{
					$values[$k]['setting']= array('1'=>0);
				}
			}
		}
		// var_dump($values);
		$link     = Linkage(array());
		$link->cachename      = 'areainfo';
		$link->inputname      = 'areaid';// <select name='' /> 里的name值
		$link->idname         = 'id';
		$link->funcname       = 'getchildtwo';
		$link->childvaluename = 'city';
		$link->childidname    = 'id';
    	include  CURR_VIEW_PATH . "Domain/apiwxlist.php";
    }
    //改变api网校的状态，是否允许调用接口
    public function changeAllowAction(){
       $userid = KS_G('get.id');
       $db_user = M("common_user");
       $info = $db_user->getRow('where userid='.$userid);
       if($info['isallow']==1){
       	  $Data['isallow']=0;
       }else{
       	  $Data['isallow']=1;
       }
       $now_page = ChkClng(KS_S('p',1));
       $db_user->update($Data,'userid='.$userid);
       KS_INFO('修改成功',0,M_URL('Domain','apilist','',GF('p-'.$now_page)));
    }
    public function bacthAllowAction(){
    	$userid = KS_G('post.check');
    	$db_user =M('common_user');
    	if(KS_G('post.batch')==2){
           $Data['isallow'] = 1;
    	}else{
    		$Data['isallow']=0;
    	}
    	// var_dump($userid);
    	// var_dump($Data);exit();
        foreach ($userid as $k => $v) {
        	$db_user->update($Data,'userid='.$v);
        }
        $now_page = ChkClng(KS_S('p',1));
        KS_INFO('批量操作成功',0,M_URL('Domain','apilist','',GF('p-'.$now_page)));
    }
    /**
     * 查看店铺的详情
     */
    public function wxDetailAction(){
    	$now_page = ChkClng(KS_S('p',1));
    	$id = KS_G('get.id');
    	$db_website = M('common_user_website');
    	$db_user = M('common_user');
    	$websiteInfo = $db_website->getRow('where wxid='.$id,'');
    	if($websiteInfo){
            $userInfo = $db_user->getRow('where wxid='.$id.' and parentid=0');
            if(empty($userInfo)){
            	KS_INFO('信息出错',0,M_URL('Domain','wxlist','',GF('p-'.$now_page)),'',1);
            }
            $db_course = M('app_course');
            $db_class = M('app_class');
            $db_paper = M('app_paper');
            $coursecount = $db_course->getOne('count(courseid)','where wxid='.$id.' and status!=-1');
            $classcount = $db_class->getOne('count(classid)','where wxid='.$id.' and status!=-1');
            $papercount = $db_paper->getOne('count(paperid)','where wxid='.$id.' and status!=-1');
            $studengcount = $db_user->getOne('count(userid)','where wxid='.$id.' and usertype=0');
            $teachercount = $db_user->getOne('count(userid)','where wxid='.$id.' and usertype=1 and parentid!=0');
    	}else{
    		KS_INFO('请选择',0,M_URL('Domain','wxlist','',GF('p-'.$now_page)),'',1);
    	}

        $ids = ChkClng(KS_S('ids'));
		$common_domain  = M('common_domain');
		$common_website = M('common_user_website');
        $table = 'as a left join '.$common_website->table.' as b on a.wxid = b.wxid where a.id = '.$ids;
		$info = $common_domain->getRow($table,'a.*,b.sitename');
		$setting = $this->cache->GetH('apprelate','appid',19,'setting',$info['wxid']);
		$domain      = $this->cache->GetA('domaininfo','wxid',$info['wxid'],'domain');
		if(!empty($setting)){
			$setting = explode('※',$setting);
            $info['setting']= $setting;
		}else{
			$info['setting']= array('1'=>0);
		}

    	 include  CURR_VIEW_PATH . "Domain/admin.wxdetail.php";

    }




    //网校登陆记录
    public function loginlogAction(){
    	$login_log = M('common_login_log');
    	$id = KS_G('get.id');
		$where='where status !=-1 and type=0';
		if(!empty($id)){$where .=' and wxid='.$id;}
		$keyword = ChkSQL(KS_S('keyword'));
		$keytype = ChkClng(KS_S('keytype',1));
		if(!empty($keyword)){
			if($keytype==1){$where.=" and username like '%$keyword%'";}
			elseif($keytype==2){$where.=" and username like '%$keyword%'";}
		}
		$options = $login_log->getOptions('8',$where);//分页参数设置
		$page    = Page($options);
		$byname  ='id desc';
		$values  = $login_log->getPage($page,$byname,$where);
        include  CURR_VIEW_PATH . "Domain/loginlog.php";
    }
    //网校学员记录
    public function userlistAction(){
    	$user_log = M('common_user');
    	$member   = M('common_user_member');
    	$id       = KS_G('get.id');
		$where    = ' as a left join '.$member->table.' as b on a.userid=b.userid where a.status !=-1 and a.usertype=0 and a.wxid='.$id;
		$keyword  = KS_S('keyword');
		$keytype  = KS_S('keytype',1);
		if(!empty($keyword)){
			if($keytype==1){$where.=" and a.username like '%$keyword%'";}
			elseif($keytype==2){$where.=" and b.name like '%$keyword%'";}
		}
		$options = $user_log->getOptions('15',$where);//分页参数设置
		$page    = Page($options);
		$byname  = 'userid desc';
		$values  = $user_log->getPage($page,$byname,$where,'a.*,b.name,b.sex');
        include  CURR_VIEW_PATH . "Domain/user_list.php";
    }
    //确认重置
	public function confirmdelAction(){
	    $id          =  ChkClng(KS_G('get.id'));
	    $now_page    =  ChkClng(KS_S('p',1));
	    include  CURR_VIEW_PATH . "Domain/sure.php";
	}
	//确认重置
	public function doconfirmdelAction(){
	    $password      = ChkSQL(KS_G('password'));
	    // var_dump($password);
		if($password=='654321'){
		    $id          =  ChkClng(KS_G('get.id'));
			$now_page    =  ChkClng(KS_S('p',1));
			$Data['password'] = '654321';
            $Data['rndpasswordc'] = rand(100000,999999);
            $Data['password'] = KS_MD5($Data['password'].KS_MD5($Data['rndpasswordc']));
            $common_user = M('common_user');
            $common_user->update($Data,'wxid="'.$id.'" and parentid=0 and usertype!=0');

			$url         =  M_URL('home/Domain','wxlist','',GP('p-'.$now_page));
			KS_INFO('重置成功',3,$url);
		}else{
		    KS_INFO('密码错误',0,'','',1);
		}
	}
    //扫码进入微门户
    public function qrcodeAction(){
    	$wxid = ChkClng(KS_G('get.id'));
    	$domain      = $this->cache->GetA('domaininfo','wxid',$wxid,'domain');
        include  CURR_VIEW_PATH . "Domain/qrcode.php";
    }
    //删除网校登陆记录
    public function dellogAction(){
    	$id = KS_G('get.id');
    	$login_log = M('common_login_log');
    	$data['status'] = -1;
    	$login_log->update($data,'id='.$id);
    	KS_INFO('删除成功',3,M_URL('Domain','loginlog'));
    }
    //编辑域名
	public function editDomainAction(){
		$id       = ChkClng(KS_G('request.id'));
		$common_domain = M('common_domain');
		$value    = $common_domain->getRow("where id=$id limit 1");

		include  CURR_VIEW_PATH . "Domain/domain_add.php";
	}

	//独立域名审核通过
	public function auditedAction(){
		$id                = ChkClng(KS_G('request.id'));
		$now_page          = ChkClng(KS_S('p',1));
		$common_domain     = M('common_domain');
		$domainInfo        = $common_domain->getRow("where id=$id limit 1",'predomain,domain');
		// if(empty($domainInfo['predomain'])){KS_INFO('用户还没有申请过独立域名',4);}
		$data['status']    = 1;
		$common_domain->update($data,"id=$id");
		$this->cache->putACache('domaininfo');//写入缓存
		$url = M_URL('home/Domain','index','',GP('p-'.$now_page));
		ks_header($url);
	}
	//独立域名取消审核
	public function unauditedAction(){
		$id            = ChkClng(KS_G('request.id'));
		$now_page      = ChkClng(KS_S('p',1));
		$common_domain = M('common_domain');
		$url = M_URL('home/Domain','index','',GP('p-'.$now_page));
		$domainInfo    = $common_domain->getRow("where id=$id limit 1",'predomain,domain');
		// if(empty($domainInfo['predomain'])){KS_INFO('用户还没有申请过独立域名',0,$url);}
		$data['status']    = 0;
		// $data['domain']    = $domainInfo['predomain'];
		// $data['predomain'] = $domainInfo['domain'];
		// $Rule['domain']    = '绑定域名|isEmpty,isEnglish,isDbexis';
		// Chkpost($data,$Rule,$common_domain,"id!=$id",4);
		$common_domain->update($data, "id=$id");
		$this->cache->putACache('domaininfo');//写入缓存
		$url = M_URL('home/Domain','index','',GP('p-'.$now_page));
		ks_header($url);
	}
	//删除独立域名
    public function delectAction(){
		$id = ChkClng(KS_G('request.id'));
		$now_page =  ChkClng(KS_S('p',1));
		$common_domain = M('common_domain');
		//$Data['status']= -1;
		//$common_domain->update($Data,"id = $id");
		$common_domain->delete("id = $id");
		$this->cache->putACache('domaininfo');//写入缓存
		$url=M_URL('home/Domain','index','',GP('p-'.$now_page));
		ks_header($url);
	}
	//测试模版消息
	public function testaaaAction(){
		 $data = array(
            "first" => array("value"=>"您好，XX同学你有一份考卷还没做！", "color"=>"#173177"),
            "keyword1"=>array("value"=>'第一份试卷',"color"=>"#173177"),
            "keyword2"=>array("value"=>'0', "color"=>"#173177"),
            "keyword3"=> array("value"=>date('Y-m-d H:i:s',time()), "color"=>"#173177"),
            "remark"=> array("value"=>"点击查看奖励进度！", "color"=>"#173177"),
        );
        $openid= 'oeQR80VDqSLfaLwE1PO_p8olpr10';
        $url ='http://weixin.qq.com/download';
		sendwxmsg($openid,'oW4pgCYXt1vt0pgJDT9NeL_R5XbKy-eQr7kqpIDybyE',$data,$url);
	}
	/**
     * 网校的单个审核
	 */
	public function singChangeAction(){
		$common_user_website = M('common_user_website');
		$now_page       = ChkClng(KS_S('p',1));
		$status       = ChkClng(KS_S('status',0));
		$id        = ChkClng(KS_G('get.id'));

		$Data['status'] = $status;
		$common_user_website->update($Data,"wxid=$id");
        $userid=$common_user_website->getOne('userid','where wxid='.$id);

        $userdb = M('common_user');
        $userdb->update($Data,'userid='.$userid);

		$this->cache->PutHCache('website',$id);//写入缓存
		$url = M_URL('Domain','wxlist','',GP('p-'.$now_page));
		KS_INFO('执行成功',0,$url);
	}

    //网校列表的批量操作
	public function batchAction(){
		$id = isset($_POST["check"])?$_POST["check"]:'';
		$content = ChkSQL($_POST['sms_content']);
		$p_content = ChkSQL($_POST['p_content']);
		$p_remark = ChkSQL($_POST['p_remark']);
		$now_page = ChkClng(KS_S('p',1));
		if (KS_G('post.batch')==2 || KS_G('post.batch')==3){
            if(empty($id)){KS_INFO("请选择");}
        }

		$common_user_website = M('common_user_website');
		$url = M_URL('home/Domain','wxlist','',GP('p-'.$now_page));
		//批量删除
		// if(KS_G('post.batch')==1){
		// 	$Data['status'] = -1;
		// 	foreach ($id as $v ){$common_domain->update($Data,"id=$v");}
		// 	$this->cache->putACache('domaininfo');//写入缓存
		// 	KS_INFO('批量删除成功',0,$url);
		// }
		//批量审核
		if(KS_G('post.batch')==2){
		    $data['status'] = 3;
		    foreach ($id as $v ) {
		    	$common_user_website->update($data, "wxid=$v");
		         $this->cache->PutHCache('website',$v);//写入缓存
		    }
			// $this->cache->putACache('domaininfo');//写入缓存
			KS_INFO('批量审核成功',0,$url);
		}
		//批量取消审核
		elseif(KS_G('post.batch')==3){
			$data['status'] = 0;
			foreach ($id as $v ) {
				$common_user_website->update($data, "wxid=$v");
			    $this->cache->PutHCache('website',$v);//写入缓存
		    }
			// $this->cache->putACache('domaininfo');//写入缓存
			KS_INFO('批量取消审核成功',0,$url);
		}elseif(KS_G('post.batch')==4){ //批量发送短信
		    if (empty($content)){
                KS_INFO("内容不能为空");
            }
            $Sms= new \Core\Sms();
            if (!empty($id)){
                foreach ($id as $v){
                   $userid =  $common_user_website->getRow('where wxid = '.ChkClng($v).'','userid');
                   $phone = User_GetUser($userid['userid'])['mobile'];
                   $Sms->SendSms($phone,$content,'userCor',$memberid='',$wxid='',$userid='');//关闭
                }
            }else{//全部发送
                $userid = $common_user_website->getAll('','userid');
                //var_dump($userid);exit;
                foreach ($userid as $v){
                    $phone = User_GetUser($v['userid'])['mobile'];
                    //$Sms->SendSms($phone,$content,'userCor',$memberid='',$wxid='',$userid='');//关闭
                }
            }
            //KS_INFO('发送成功',0,$url);
        }elseif (KS_G('post.batch')==5){//公众号模板消息发送
		    if (empty($p_content)){
                KS_INFO("模板内容不能为空");
            }
            if (empty($p_remark)){
                KS_INFO("备注不能为空");
            }
            $Wechat = new \Core\Wechat(2);
            $template_id = 'OPENTM207209778';
            $time = date('Y-m-s h:i:s',time());
            $data = [
                'first'=>['value'=>$p_content,'color'=>'#173177'],
                'keyword1'=>['value'=>'科汛V名师','color'=>'#173177'],
                'keyword2'=>['value'=>$time,'color'=>'#173177'],
                'remark'=>['value'=>$p_remark,'color'=>'#173177'],
            ];
            $wx_url =  'https://www.kesion.com/';
            if (!empty($id)){
                foreach ($id as $v){
                    $userid =  $common_user_website->getRow('where wxid = '.ChkClng($v).'','userid');
                    $openid = User_GetUser($userid['userid'])['openid'];
                    //$openid = "oRu5Fwh-IJFda2ibDvv4OvHP4IIA";
                    $temp = $Wechat->sendTemplate($openid,$template_id,$wx_url,$data);
                }
            }else{//全部发送
                $userid = $common_user_website->getAll('','userid');
                foreach ($userid as $v){
                    $openid = User_GetUser($v['userid'])['openid'];
                    //$Wechat->sendTemplate($openid,$template_id,$url,$data);
                }
            }
            KS_INFO('发送成功',0,$url);
        }
	}
	//批量删除log
	public function loginbatchAction(){
		$id = isset($_POST["check"])?$_POST["check"]:'';
		$now_page = ChkClng(KS_S('p',1));
		if(empty($id)){KS_INFO("请选择");}
		$login_log = M('common_login_log');
		$url = M_URL('home/Domain','loginlog','',GP('p-'.$now_page));
		$Data['status'] = -1;
		foreach ($id as $v ){$login_log->update($Data,"id=$v");}
		KS_INFO('批量删除成功',0,$url);
	}
	//批量操作
	public function DbatchAction(){
		$id = isset($_POST["check"])?$_POST["check"]:'';
		// var_dump($_POST);
		$now_page = ChkClng(KS_S('p',1));
		if(empty($id)){KS_INFO("请选择");}
		$common_domain = M('common_domain');
		$url = M_URL('home/Domain','','',GP('p-'.$now_page));
		//批量删除
		if(KS_G('post.batch')==1){
			$Data['status'] = -1;
			foreach ($id as $v ){$common_domain->update($Data,"id=$v");}
			$this->cache->putACache('domaininfo');//写入缓存
			KS_INFO('批量删除成功',0,$url);
		}
		//批量审核
		elseif(KS_G('post.batch')==2){
		    $data['status'] = 2;
		    foreach ($id as $v ) {$common_domain->update($data, "id=$v");}
			$this->cache->putACache('domaininfo');//写入缓存
			KS_INFO('批量审核成功',0,$url);
		}
		//批量取消审核
		elseif(KS_G('post.batch')==3){
			$data['status'] = 1;
			foreach ($id as $v ) {$common_domain->update($data, "id=$v");}
			$this->cache->putACache('domaininfo');//写入缓存
			KS_INFO('批量取消审核成功',0,$url);
		}
	}
	//图片列表页
    public function imageslistAction(){
    	$tempdir      = null !== GF('tempdir') ? GF('tempdir'):'';
    	$first        = '';
        $arr_filetype = $this->File->fileType_arr(array('jpg','png','jpeg'));//指定可以打开的文件后缀
        if(!empty($tempdir)){
			$back = null !== GF('back') ? GF('back'):'';
			if(!empty($back)){
				$tempdir = explode('/',$tempdir);
				$tempdir = array_diff($tempdir,array('..','.',''));
				$tempdir = array_values($tempdir);
				array_pop($tempdir);
				if(count($tempdir)>1)
				{$first = 'on';}
				$tempdir = implode('/',$tempdir);
//				$ismatch = strpos($tempdir,'Images/'.$value['installdir']);
//				if($ismatch===false){echo 'err';exit;};
				$dir = ROOT.$tempdir.'/';
			}else{
//				if($value['temptype']==0){$ismatch = strpos($tempdir,'Tp/PC/'.$value['installdir']);}
//				else if($value['temptype']==1){$ismatch = strpos($tempdir,'Tp/M/'.$value['installdir']);}
//				if($ismatch===false){echo 'err';exit;};
				$tempdir = explode('/',$tempdir);
				$tempdir = array_diff($tempdir,array('..','.',''));
				$tempdir = array_values($tempdir);

				$nowdir = null !== GF('nowdir') ? GF('nowdir'):'';

				if(empty($nowdir)){
					if(count($tempdir)>1){$first = 'on';}
					$tempdir = implode('/',$tempdir);
				    $dir = ROOT.$tempdir.'/';
				}else{
					if(count($tempdir)>0){$first = 'on';}
					$tempdir = implode('/',$tempdir);
				    $tempdir = $tempdir.'/'.$nowdir;
				    $dir = ROOT.$tempdir.'/';
				}
			}
		}else{
			$tempdir      = 'Images/';
		    $dir          = ROOT.$tempdir.'/';
		}
		$dirname      = array();
	    $filename     = array();
	    if (is_dir($dir)) {
			 $filelist = scandir($dir);
			 foreach($filelist as $k=>$v){
				 if (is_dir($dir.$v)) {$dirname[] = $v;}
				 else{
					$suffix = $this->File->get_file_type($v);
					foreach($arr_filetype as $kt=>$vt){
						if($suffix == $vt ){$filename[] = $v;}
					}
				 }
			 }
			 $dirname=array_diff($dirname,array('..','.'));
			 $dirname=array_values($dirname);
	    }
        include  CURR_VIEW_PATH . "Domain/images_list.php";
   }
    //同步图片到百度云
    public function SyncimagesAction(){
    	$this->File->fileType_arr(array('jpg','png'));//指定可以打开的文件后缀
    	$tempdir      = null !== GF('tempdir') ? GF('tempdir'):'Images/';
	    $dir          = ROOT.$tempdir;
	    if (is_dir($dir)) {
	    	 $this->File->read_all_number($dir);
	    }
	    //var_dump($this->File->file_number);exit;

        include  CURR_VIEW_PATH . "Domain/images_sync.php";
    }
    /**
     * 套餐配置
     */
    public function packageAction(){
    	$appinfo                  = $this->cache->GetACache('appinfo');
    	//var_dump($appinfo);exit;
    	$package_version          = $this->cache->GetACache('commonpackageversion');
    	$package_feature          = $this->cache->GetACache('commonpackagefeature');
        foreach($package_version as $k=>$v){
            $vesion[$k] = array();
        	foreach($package_feature as $kt=>$vt){
        		if($v['versionename'] == $vt['versionename']){
                    $vesion[$k][$vt['seriesid']]  = $vt;
                }
        	}
        }
    	include  CURR_VIEW_PATH . "Domain/admin.packagelist.php";
    }
    /**
     * 保存套餐配置
     */
    public function doEditPackageAction(){
    	$version                  = ChkSQL(KS_G('request.version'));
    	$color                    = ChkSQL(KS_G('request.color'));
    	$seriesid                 = ChkSQL(KS_G('request.seriesid'));
    	$appid                    = ChkSQL(KS_G('request.appid'));
    	$common_package_version   = M('common_package_version');
    	$common_package_feature   = M('common_package_feature');
        //保存版本信息
    	foreach($version as $k=>$v){
    		$Data['versionname']  = $v;
    		$common_package_version->update($Data,'orderid='.$k);
    	}
        //保存版本对应的项目
    	foreach($seriesid as $k=>$v){
    		$feature             = ChkSQL(KS_G('request.feature'.$v));
    		if(!empty($feature)){
                $row=0;
    			foreach($feature as $kt=>$vt){
					$Datas['featurename']  = $vt;
					$Datas['appid']        = $appid[$k];
					$Datas['color']        = $color[$k];
                    $where='';
                    if ($row==0){
                        $where='seriesid='.$v.' and versionename="n0"';
                    }else{
                        $where='seriesid='.$v.' and versionename="v'.($kt-1).'"';
                    }
                    if ($common_package_feature->Exists('where '.$where)){
                        $common_package_feature->update($Datas,$where);
                    }

                    $row++;
                    unset($Datas);
    			}
    		}
    	}
    	$this->cache->PutACache('commonpackageversion');
    	$this->cache->PutACache('commonpackagefeature');
    	$url = M_URL('home/Domain','package');
    	KS_INFO('保存成功',0,$url);
    }
    //添加套餐版本
    public function addversionAction(){
    	$common_package_version = M('common_package_version');
    	$Data['versionname']    = '输入收费类型';
    	$Data['orderid']        = $common_package_version->getMaxValue('orderid');//生成网校id
    	$Datas['versionename']  = $Data['versionename']   = 'v'.$Data['orderid'];
    	$common_package_version ->doAdd($Data,'versionid');
    	$common_package_feature = M('common_package_feature');
    	$feature                = $common_package_feature->getAll('where versionename="n0"','appid,seriesid');
    	foreach($feature as $k=>$v){
    		$Datas['seriesid']       = $v['seriesid'];
    		$Datas['appid']          = $v['appid'];
    		$Datas['featurename']    = '-----';
    		$common_package_feature ->doAdd($Datas,'featureid');
    	}
    	$this->cache->PutACache('commonpackagefeature');
    	$this->cache->PutACache('commonpackageversion');
    	echo 'ok';
    }
    //删除套餐版本
    public function delversionAction(){
    	$versionid                = ChkClng(KS_G('request.versionid'));
    	$common_package_version   = M('common_package_version');
    	$common_package_version ->delete('versionid='.$versionid);
    	$common_package_feature   = M('common_package_feature');
    	$common_package_feature ->delete('versionename="v'.($versionid-1).'"');
    	$this->cache->PutACache('commonpackageversion');
    	$this->cache->PutACache('commonpackagefeature');
    	echo 'ok';
    }
    //添加套餐功能
    public function addfeatureAction(){
    	$common_package_version   = M('common_package_version');
    	$version                  = $common_package_version->getAll('','versionename,orderid');
    	$common_package_feature   = M('common_package_feature');
    	$Data['seriesid']         = $common_package_feature->getMaxValue('seriesid')+1;//生成网校id
    	foreach($version as $k=>$v){
    		if($v['orderid']==0){
    			$Data['featurename']    = '输入收费功能';
    			$Data['orderid']        = $Data['seriesid'];
    		}else{
    			$Data['featurename']    = '-----';
    		}
	    	$Data['versionename']   = $v['versionename'];
	    	$common_package_feature ->doAdd($Data,'featureid');
    	}
    	$this->cache->PutACache('commonpackagefeature');
    	echo 'ok';
    }
    //套餐功能上移
    public function featureupAction(){
    	$seriesid               = ChkClng(KS_G('request.id'));
    	$numb                   = ChkClng(KS_G('post.numb'));
    	$common_package_feature = M('common_package_feature');
    	$orderid                = $common_package_feature ->getOne('orderid',"where seriesid=".$seriesid." and versionename='n0' limit 1");
    	$Data['orderid']        = 'orderid+1';
    	$common_package_feature ->update($Data,"orderid<$orderid and orderid>($orderid-$numb-1) and versionename='n0'",1);
    	$Datatwo['orderid']     = 'orderid-'.$numb;
    	$common_package_feature ->update($Datatwo,"seriesid=".$seriesid." and versionename='n0'",1);
    	$this->cache->PutACache('commonpackagefeature');
    	$url = M_URL('home/Domain','package');
    	KS_INFO('',0,$url);
    }
    //套餐功能下移
    public function featuredownAction(){
    	$seriesid               = ChkClng(KS_G('request.id'));
    	$numb                   = ChkClng(KS_G('post.numb'));
    	$common_package_feature = M('common_package_feature');
    	$orderid                = $common_package_feature ->getOne('orderid',"where seriesid=".$seriesid." and versionename='n0' limit 1");
    	$Data['orderid']        = 'orderid-1';
    	$common_package_feature ->update($Data,"orderid>$orderid and orderid<($orderid+$numb+1)  and versionename='n0'",1);
    	$Datatwo['orderid']     = 'orderid+'.$numb;
    	$common_package_feature ->update($Datatwo,"seriesid=".$seriesid." and versionename='n0'",1);
    	$this->cache->PutACache('commonpackagefeature');
    	$url = M_URL('home/Domain','package');
    	KS_INFO('',0,$url);
    }
    //删除套餐功能
    public function delfeatureAction(){
    	$seriesid               = ChkClng(KS_G('request.seriesid'));
    	$common_package_feature = M('common_package_feature');
    	$common_package_feature ->delete('seriesid='.$seriesid);
    	$this->cache->PutACache('commonpackagefeature');
    	echo 'ok';
    }
	public function ssssssAction(){
		include  CURR_VIEW_PATH . "TypeChange.php";
	}

	/**
	 * 修改机构的名称
	 */
	public function changeWxNameAction(){
		$wxid = ChkClng(KS_G('get.id'));
		$now_page = GF('P');
		$db_website= M('common_user_website');
		$info = $db_website->getRow('where wxid='.$wxid);
		if(!$info){
           $url =  M_URL('home/Domain','wxlist');
		   KS_INFO('信息出错',3,$url);
		}else{
			include CURR_VIEW_PATH.'Domain/admin.changeWxname.php';
		}
	}
	/**
	 * 保存修改机构的名称
	 */
	public function doSaveChangeWxNameAction(){
		$wxid = ChkClng(KS_G('get.id'));
		$name = KS_G('post.sitename');
		$Data['sitename'] = $name;
		$now_page = GF('P');
		$db_website= M('common_user_website');
		$db_website->update($Data,'wxid='.$wxid);
		$this->cache->PutHCache('website',$wxid);
		$url =  M_URL('home/Domain','wxlist','',GP('p-'.$now_page));
		KS_INFO('',3,$url);
	}

    /**
     * 修改业务员
     */
    public function changeSalesManAction()
    {
        $wxid = ChkClng(KS_G('get.id'));
		$now_page = GF('P');
		$db_website= M('common_user_website');
		$info = $db_website->getRow('where wxid='.$wxid);
		if(!$info){
           $url =  M_URL('home/Domain','wxlist');
		   KS_INFO('信息出错',3,$url);
		}else{
			include CURR_VIEW_PATH.'Domain/admin.changeSalesMan.php';
		}

    }

    /**
     * 保存修改业务员
     */
	public function doSaveChangeSalesManAction(){

		$wxid = ChkClng(KS_G('get.id'));
		$salesman = KS_G('post.salesman');
		$Data['salesman'] = $salesman;
		$now_page = GF('P');
		$db_website= M('common_user_website');
		$db_website->update($Data,'wxid='.$wxid);
		$this->cache->PutHCache('website',$wxid);
		$url =  M_URL('home/Domain','wxlist','',GP('p-'.$now_page));
		KS_INFO('',3,$url);
	}


    /**
     * 设置过期时间
     */
    public function  setExpireTimeAction(){
        $wxid = ChkClng(KS_G('get.id'));
		$now_page = GF('P');
		$db_website= M('common_user_website');
		$info = $db_website->getRow('where wxid='.$wxid);
		if(!$info){
            $url =  M_URL('home/Domain','wxlist');
            KS_INFO('信息出错',3,$url);
		}else{
			include CURR_VIEW_PATH.'Domain/admin.setExpireTime.php';
		}
    }
    /**
     * 保存设置过期时间
     */
    public function saveSetExpireTimeAction(){
        $wxid = ChkClng(KS_G('get.id'));
		$package=KS_S('package');
        $packendtime=KS_S('packendtime');
		$Data['package'] = $package;
		$Data['packendtime'] = strtotime($packendtime);
		$now_page = GF('P');
		$db_website= M('common_user_website');
		$db_website->update($Data,'wxid='.$wxid);
		$this->cache->PutHCache('website',$wxid);
		$url =  M_URL('home/Domain','wxlist','',GP('p-'.$now_page));
		KS_INFO('',3,$url);
    }

    /**
     * 编辑绑定域名
     */
	public function wxeditDomainAction(){
		$now_page =  ChkClng(KS_S('p',1));
		$id       =  ChkClng(KS_G('request.id'));
		$common_domain = M('common_domain');
		$value    = $common_domain->getRow("where wxid=$id limit 1");
//		var_dump($value);
        $db=M('common_user_website');
        $valuesite=$db->getRow('where wxid='.$id);
		include  CURR_VIEW_PATH . "Domain/wxeditDomain.php";
	}
	/**
     * 进行编辑域名操作
     */
	public function doEditDomainAction(){
		$now_page =  KS_S('p',1);
		$urltype  =  ChkClng(KS_S('urltype',1));
		$id = ChkClng(KS_G('request.id'));//表ID
		if(strlen(ChkSQL(KS_G('post.domain')))<2||strlen(ChkSQL(KS_G('post.domain')))>30)
		{KS_INFO('二级域名4-30字');}
		$Data['domain']     = ChkSQL(KS_G('post.domain'));
		$Data['predomain']  = ChkSQL(KS_G('post.predomain'));
		$Data['istranscode']  = ChkSQL(KS_G('post.istranscode'));
        $Data['status']     = ChkClng(KS_G('post.status'));
		$common_domain      = M('common_domain');
		$Rule['domain']     = '二级域名|isEmpty,isEnglish,isDbexis';
		$Rule['predomain']  = '二级域名|isEnglish';
		Chkpost($Data,$Rule,$common_domain,"id!=$id");
		$status = $common_domain->getOne('status',"where id=$id");
		if ($Data['status']==1){
			if ($status!=1){
				$Data['domain'] = ChkSQL(KS_G('post.predomain'));
				$Data['predomain'] = ChkSQL(KS_G('post.domain'));;
			}
		}else{
			if ($status==1){
				$Data['domain'] = ChkSQL(KS_G('post.predomain'));
				$Data['predomain'] = ChkSQL(KS_G('post.domain'));;
			}
		}
//		var_dump($Data);die;
		$common_domain->update($Data,"id=$id");
		$this->cache->PutACache('domaininfo');//写入缓存
		$url =  M_URL('Domain','index','',GP('p-'.$now_page));
		if($urltype == 1){
			$url =  M_URL('Domain','wxlist','',GP('p-'.$now_page));
		}
        $wxid=$common_domain->getOne('wxid','where id='.$id);
        unset($Data);
		$Data['istry']     = ChkClng(KS_G('post.istry'));
		$db=M('common_user_website');
        $db->update($Data,'wxid='.$wxid);
        $this->cache->PutHCache('website',$wxid);//写入缓存
        unset($Data);
        $db=M("common_user");
        $Data['usertype']=1;
        $db->update($Data,'wxid='.$wxid.' and usertype=2');    //设置为扶持版

		KS_INFO('保存成功',3,$url);
	}



    /***********************************************************扩容服务 begin********************************************************/
	/**
	 * 总平台扩容服务，首页
	 */
	public function wxrechargeAction(){
		$this->wxid = ChkClng(KS_G('get.id'));//wxid
		include  CURR_VIEW_PATH . "Domain/wxrecharge.php";
	}
	/**
     * 扩容服务（购买项目）
	 */
	public function coludmanageAction(){
		$this->wxid        = ChkClng(KS_S('wxid'));
	 	$serviceType       = ChkClng(KS_G('request.id'));
	    $serviceinfo       = $this->cache->GetA('service','serviceid',$serviceType,'',true);
	    $voucher           = $this->cache->GetHCache('voucher',$this->wxid);
	    $shopModel         = M('common_cart');
	    $count             = $shopModel->getOne('count(*)',"where wxid=$this->wxid limit 1");
	    //  $Expire
	    $day=1;
	    if($serviceType==3){
        $Expire=wx_getvip_expiretime($this->wxid);
	    if($Expire){
	    	$day=ceil(($Expire-time())/(3600*24));
	    }else{
	    	$Expire=strtotime("+1 year");
	    	$day=ceil(($Expire-time())/(3600*24));
	    }

	    }
	    $price= number_format(wx_version_itemvalue($serviceinfo['seriesid'],$this->wxid),2);
	    include  CURR_VIEW_PATH . "Domain/cloudmanage.php";
	}
    /**
     * 总平台扩容服务（第二步）
     */
    public function buyServiceAction(){
        $this->wxid       = ChkClng(KS_S('wxid'));
        $orderid          = ChkClng(null !==GF('orderid') ? GF('orderid'):'0');
		if(!empty($orderid)){
			ks_header(M_URL('home/Domain','confirmService','',GP('')));
		}else{
			$serviceid    = ChkClng(KS_G('request.id'));
			$serviceinfo  = $this->cache->GetA('service','serviceid',$serviceid,'',true);
			$numb         = ChkSQL(KS_G('request.numb'))!='' ?  ChkSQL(KS_G('request.numb')) : 1;//数量
			$starttime= ChkClng(KS_G('post.startime'));
    	    $endtime= ChkClng(KS_G('post.endtime'));
    	    $day               = ChkClng(KS_G('post.day'));
			ks_header(M_URL('home/Domain','confirmService',$serviceid,GP('numb-'.$numb.',starttime-'.$starttime.',endtime-'.$endtime.',days-'.$day)));
		}
    }
    /**
     * 扩容服务，确认支付
     */
    public function payServiceAction(){
        $orderid                 = ChkClng(KS_G('post.orderid'));
        if(!empty($orderid)){//有订单了还创建个鬼呀
            $pays                = ChkClng(KS_G('post.orderid'));
		    $order_info          = M('common_order_info');
			$orderinfo           = $order_info->getRow("where orderid=$orderid limit 1",'appid,numb,ordersn');
			$serviceinfo         = $this->cache->GetA('service','serviceid',$orderinfo['appid'],'',true);
		    $numb                = $orderinfo['numb'];
		    $serviceid           = $orderinfo['appid'];
		    $servicemoney        = $orderinfo['numb']*wx_version_itemvalue($serviceinfo['seriesid'],$this->wxid);
		    $Data['ordersn']     = $orderinfo['ordersn'];
        }else{
            $serviceid           = ChkClng(KS_G('post.serviceid'));
			$serviceinfo         = $this->cache->GetA('service','serviceid',$serviceid,'',true);
			$numb                = ChkClng(KS_G('post.numb'));
		    $servicemoney        = wx_version_itemvalue($serviceinfo['seriesid'],$this->wxid)*$numb;
		    if($serviceid==3){
                $day               = ChkClng(KS_G('post.day'));
                $starttime         = ChkClng(KS_G('post.starttime'));
                $endtime           = ChkClng(KS_G('post.endtime'));
                $servicemoney      = wx_version_itemvalue($serviceinfo['seriesid'],$this->wxid)*$numb*$day;
		    }elseif($serviceid==6){
                $day               = ChkClng(KS_G('post.day'));
                $starttime         = ChkClng(KS_G('post.starttime'));
                $endtime           = ChkClng(KS_G('post.endtime'));
                $servicemoney      = wx_version_itemvalue($serviceinfo['seriesid'],$this->wxid)*$numb*$day;
		    }
		    //var_dump($servicemoney);exit;
		    //$servicemoney          = ChkSQL(KS_G('request.servicemoney'));
			list($usec, $sec)        = explode(" ", microtime());
			$Data['ordersn']         = $this->wxid.((float)$usec + (float)$sec)*10000;
			$shopModel               = M('common_order');
		    $Data['userid']          = 0;
		    $Data['wxid']            = $this->wxid;
		    $Data['userip']          = $_SERVER['SERVER_ADDR'];
		    $Data['type']            = 2;
		    $Data['original_amount'] = $servicemoney;//原价
		    if(ChkSQL(KS_G('post.order_amount'))==0){
                $Data['order_amount']    = 0;//实际价格
                $youhuijin               = 0;
			}else{
				if($servicemoney-$voucherbalance<=0){
		    		$Data['order_amount'] = 0;//实际价格
		    		$youhuijin            = $servicemoney;
				}else{
		    		$Data['order_amount'] = $servicemoney-$voucherbalance;//实际价格
		    		$youhuijin            = $voucherbalance;
				}
			}

		    $Data['adddate']     = time();
		    $Data['paystatus']   = 0;
		    $orderid             = $shopModel->doAdd($Data,'orderid');
		    //订单详情
		    $order_apps          = M('common_order_info');
		    $Datas['wxid']       = $this->wxid;
		    //$Datas['starttime']  = time();
		    $Datas['appid']      = $serviceid;
		    $Datas['appname']    = $serviceinfo['servicename'];
		    $Datas['numb']       = $numb;

			if(ChkSQL(KS_G('post.order_amount'))==0){
                $Datas['price']  = 0;
			}else{
                $Datas['price']  = $servicemoney;
			}

		    switch($serviceid){
		    	case 1:
				    $Datas['sumprice']  = 0;
			    	$Datas['summarket'] =$numb/1000*wx_version_itemvalue(14,$this->wxid);
			    	$Datas['market_price'] = wx_version_itemvalue(14,$this->wxid);
                    break;
			    case 2:
				    $Datas['sumprice']  = 0;
			    	$Datas['summarket'] =$numb/1000*wx_version_itemvalue(15,$this->wxid);
			    	$Datas['market_price'] = wx_version_itemvalue(15,$this->wxid);
                    break;
			    case 3:
				    $Datas['sumprice']  = 0;
			    	$Datas['summarket'] =$numb*wx_version_itemvalue(40,$this->wxid);
			    	$Datas['market_price'] = wx_version_itemvalue(40,$this->wxid);
                    break;
			    case 4:
				    $Datas['sumprice']  = 0;
			    	$Datas['summarket'] =$numb*wx_version_itemvalue(12,$this->wxid);
			    	$Datas['market_price'] = wx_version_itemvalue(12,$this->wxid);
                    break;
			    case 6:
				    $Datas['sumprice']  = 0;
			    	$Datas['summarket'] =$numb/1000*wx_version_itemvalue(11,$this->wxid);
			    	$Datas['market_price'] = wx_version_itemvalue(11,$this->wxid);
                case 5:
				    $Datas['sumprice']  = 0;
			    	$Datas['summarket'] =$numb/1000*wx_version_itemvalue(13,$this->wxid);
			    	$Datas['market_price'] = wx_version_itemvalue(13,$this->wxid);
                    break;
		    }
		    $Datas['starttime']  = ChkClng(KS_G('post.starttime'));
		    $Datas['endtime']    = ChkClng(KS_G('post.endtime'));
		    $Datas['defaultpic'] = '/Images/images/201707/14994809769188.png';
		    $Datas['orderid']    = $orderid;
		    $Datas['ordersn']    = $Data['ordersn'];
			$order_apps->doAdd($Datas,'id');//添加单个app信息
			//插入明细表
        }

        $PayModel            = M('Application/PayModel');
        $PayModel  ->Serviceback($Datas['ordersn'],0);

        KS_Alert('恭喜，开通成功！','success',M_URL('home/Domain','wxlist','',GP('')));

    }


    /**
     * 购买记录(扩容服务)
     */
	public function serviceRecordAction(){
        $this->wxid       = ChkClng(KS_S('wxid'));
        $serviceType   = ChkClng(KS_G('request.id'));
        $order         = M('common_order');
        $orderInfo     = M('common_order_info');
        $where         = ' as a  left join '.$orderInfo->table.' as b on a.orderid=b.orderid  where a.type=2 and a.wxid ='.$this->wxid.'  and a.paystatus=1 and b.appid='.$serviceType;
        $options       = $order->getOptions('10',$where);//分页参数设置
		$page          = Page($options);
		$values        = $order->getPage($page,'a.orderid desc',$where,'a.orderid,a.original_amount,a.order_amount,a.adddate,a.ordersn,b.numb,b.appname,b.appid,b.price,b.starttime,b.endtime,b.market_price');
        include  CURR_VIEW_PATH . "Domain/admin.consumptionRecord.php";
	}
    /**
     * 消费记录    4点播
     */
	public function consumptionRecordAction(){
        $this->wxid       = ChkClng(KS_S('wxid'));
        $serviceType   = ChkClng(KS_G('request.id'));
        if($serviceType == 5){
            $livelog   = M('common_live_log');
            $where     =' where wxid='.$this->wxid.' and status =2 and classlevel !=0';
            //die('where='.$where);

            $classid   = null !==GF('classid') ? GF('classid'):'0';
            if(!empty($classid)){
                $where .= ' and infoid='.$classid;
            }
            $options   = $livelog->getOptions('10',$where);//分页参数设置
            $page      = Page($options);
            $values    = $livelog->getPage($page,'id desc',$where,'');
            $classModel=M('app_class');
            foreach($values as $k=>$v){
                $values[$k]['title']=$classModel->getOne('title',' where classid ='.$v['infoid'].' limit 1 ');
            }
        }elseif($serviceType == 4){   //播放记录
            //$dayflow=M('app_dayflow');
            // $where =' where wxid='.$this->wxid.' and status =0';
            // $options   = $dayflow->getOptions('10',$where);//分页参数设置
            // $page      = Page($options);
            // $values    = $dayflow->getPage($page,'id desc',$where,'');

            $vodrec = M('app_vod_rec');
            $vodlist= M('app_vod_list');
            $vodcourse=M('app_course');
            $where =' as a INNER JOIN '.$vodlist->table.' b ON a.vdoId=b.vdoId INNER JOIN '.$vodcourse->table.' c ON a.courseid=c.courseid WHERE a.wxid='.$this->wxid.'';
            //die($where);
            $options   = $vodrec->getOptions('10',$where);//分页参数设置
            $page      = Page($options);
            $values    = $vodrec->getPage($page,'a.id desc',$where,'a.*,b.vdoSize,c.coursehour,c.title,c.chaptertable');
        }elseif($serviceType==1){
            $this->AppModel = M('app_sms_log');
            $smsnum    = $this->cache->GetH('domainbilling','type',1,'number',$this->wxid);
            $setting   = getSet($this->wxid,17);//获取网站配置
			$issuccess = null !==GF('issuccess') ? GF('issuccess'):'3';
			$where = 'where a.wxid ='.$this->wxid;
			$where .= ' and a.status!=-1';
			if($issuccess == 0){$where .= ' and a.issuccess=0';}
			elseif($issuccess == 1){$where .= ' and a.issuccess=1';}
			$keyword = ChkSQL(KS_S('keyword'));//搜索
			$keytype = ChkClng(KS_S('keytype',1));
		    //判断是否输入关键字
			if(!empty($keyword)){
                if($keytype==1){$where.=" and a.memberid like '%$keyword%'";}
                elseif($keytype==2){$where.=" and b.username like '%$keyword%'";}
                elseif($keytype==3){$where.=" and a.mobile like '%$keyword%'";}
                elseif($keytype==4){$where.=" and a.memberip like '%$keyword%'";}
			}
			$common_user   = M('common_user');
			$where = "as a left join `$common_user->table` as b on a.memberid = b.userid $where";
			$options = $this->AppModel->getOptions('10',$where);//分页参数设置
			$page = Page($options);
			$values = $this->AppModel->getPage($page,'adddate desc',$where,'b.username,b.mobile,a.*');
        }elseif($serviceType==2){
            $emailnum    = $this->cache->GetH('domainbilling','type',2,'number',$this->wxid);
			$setting     = getSet($this->wxid,18);//获取网站配置
			$issuccess   = null !==GF('issuccess') ? GF('issuccess'):'3';
			$where = '  where a.wxid ='.$this->wxid;
			if($issuccess == 0){$where .= ' and a.issuccess=0';}
			elseif($issuccess == 1){$where .= ' and a.issuccess=1';}
			$keyword = ChkSQL(KS_S('keyword'));//搜索
			$keytype=null !==GF('keytype') ? GF('keytype'):0;
		    //判断是否输入关键字
			if(!empty($keyword)){
                if($keytype==1){$where.=" and b.username like '%$keyword%'";}
                elseif($keytype==2){$where.=" and a.content like '%$keyword%'";}
			}
			$common_user   = M('common_user');
			$EmailModel    = M('app_email_log');
			$where   = "as a left join `$common_user->table` as b on a.memberid = b.userid $where";
			$options = $EmailModel->getOptions('10',$where);//分页参数设置
			$page    = Page($options);
			$values  = $EmailModel->getPage($page,'adddate desc',$where,'b.username,a.*');
        }
        include  CURR_VIEW_PATH . "Domain/admin.consumptionRecord.php";
	}

    /***********************************************************扩容服务 end********************************************************/



















	//查看每月并发
	public function MonthConcurrentAction(){
		$this->wxid        = ChkClng(KS_S('wxid'));
	 	$model = M('common_service_log');
	 	$year  = date('Y',time());
	 	$month = date('n',time());
	 	$where =' where wxid='.$this->wxid;
 	    $options   = $model->getOptions('10',$where);//分页参数设置
		$page      = Page($options);
		$values    = $model->getPage($page,'year='.$year.' desc ,month='.$month.' desc,year asc,month asc',$where);
		include  CURR_VIEW_PATH . "Domain/Concurrent.php";
	}
	public function adminrechargeAction(){
		$wxid           = ChkClng(KS_G('get.id'));//wxid
		$common_website = M('common_user_website');
		$money          = KS_G('post.money');
		if($money<=0){KS_INFO('请输入大于0的正数');}
		$mark           = KS_G('post.mark');
		//一是充值
		if(KS_G('post.type')==1){
			$Data['money']     = 'money+'.$money;
			$Data['sunmoney']  = 'sunmoney+'.$money;
			$apnlog            = M('Application/LogModel');
			$loginfo['wxid']   = $wxid;
			$loginfo['userid'] = 0;
			$loginfo['userip'] = '127.0.0.1';
			$loginfo['order_amount'] = $money;
			$loginfo['mark']   = $mark;
			$apnlog->rechargelog($loginfo,1);//充值
			$common_website->update($Data,'wxid='.$wxid,1);
			$this->cache->PutHCache('website',$wxid);
		//邮箱
		}elseif(KS_G('post.type')==2){
			$pirce = wx_version_itemvalue('15',$wxid);
			$i = $money/$pirce;
			ServiceRecharge($i,15,$wxid,'true');
		//短信
		}elseif(KS_G('post.type')==3){
			$pirce = wx_version_itemvalue('14',$wxid);
			$i = $money/$pirce;
			ServiceRecharge($i,14,$wxid,'true');
		//空间
		}elseif(KS_G('post.type')==4){
			$pirce = wx_version_itemvalue('40',$wxid);
			$i = $money/$pirce;
			ServiceRecharge($i,40,$wxid,'true');
		}elseif(KS_G('post.type')==5){
			$pirce = wx_version_itemvalue('13',$wxid);
			$i = $money/$pirce;
			ServiceRecharge($i,13,$wxid,'true');
		}elseif(KS_G('post.type')==6){
			$pirce = wx_version_itemvalue('12',$wxid);
			$i = $money/$pirce;
			ServiceRecharge($i,12,$wxid,'true');
		}

		$url =  M_URL('home/Domain','wxlist');
		KS_INFO('充值成功',3,$url);
	}
	public function wxAuthenticAction(){
		include  CURR_VIEW_PATH . "Domain/wxAuthentic.php";
	}
	public function wxpersonalAction(){
		$now_page   = ChkClng(KS_S('p'));
		$userid     = ChkClng(KS_G('get.id'));
		$usertype   = ChkClng(KS_S('usertype',3));
		$tableModel = M('common_table');
		$usersModel = M('common_user');
		if($usertype == 0 || $usertype == 3){
		    $tableid = $tableModel->getOne('tableid',"where tablename='common_user_member'");
			$memberModel = M('common_user_member');
			$userinfo = $usersModel->getRow("as a left join `$memberModel->table` as b on a.userid = b.userid WHERE a.userid =$userid limit 1");
		}elseif($usertype == 1){
			$tableid = $tableModel->getOne('tableid',"where tablename='common_user_teacher'");
			$teacherModel = M('common_user_teacher');
			$userinfo = $usersModel->getRow("as a left join `$teacherModel->table` as b on a.userid = b.userid WHERE a.userid =$userid limit 1");
		}elseif($usertype == 2){
			$tableid = $tableModel->getOne('tableid',"where tablename='common_user_school'");
			$schoolModel = M('common_user_school');
			$userinfo = $usersModel->getRow("as a left join `$schoolModel->table` as b on a.userid =b.userid WHERE a.userid =$userid limit 1");
		}
		$Linkage  = Linkage(array());
		$Linkage->inputname  = 'categoryid';
		$Linkage->cachename  = 'userscategory';
		$Linkage->categoryid = $userinfo['categoryid'];

		$areaid   = 0;
		if($userinfo['provinceid']!=0){
			$areaid = $userinfo['provinceid'];
			if($userinfo['cityid']!=0){
				$areaid = $userinfo['cityid'];
				if($userinfo['countyid']!=0){$areaid = $userinfo['countyid'];}
			}
		}
		$link = Linkage(array());
		$link ->cachename      = 'areainfo';
		$link ->inputname      = 'areaid';
		$link ->idname         = 'id';
		$link ->funcname       = 'getchildtwo';
		$link ->childvaluename = 'city';
		$link ->childidname    = 'id';
		$link ->categoryid     =  $areaid;
		include  CURR_VIEW_PATH . "Domain/wxpersonal.php";
	}


	/**
     * 增值服务
	 */
	public function cartbatchAction(){
		$this->wxid = ChkClng(KS_G('get.id'));
		$batch  = ChkSQL(KS_G('post.batch'));
		$appids = ChkSQL(KS_G('post.appid'));
		if(empty($appids)){KS_INFO('请选择',4,'','',1);}
		$numb   = ChkClng(KS_G('request.numb'))!=0 ?  ChkClng(KS_G('request.numb')) : 1;
		if($batch==1){
			$shopModel = M('common_cart');
			foreach($appids as $k=>$v){$shopModel->delete("wxid=$this->wxid and appid=$v");}
			$url = M_URL('Domain','index');KS_INFO('删除成功',0,$url);
		}else{
			$appids = implode('@',$appids);
			ks_header(M_URL('Domain','confirmService1',$this->wxid,GP('numb-'.$numb.',appids-'.$appids.',batch-'.$batch)));
		}
    }
	/**
     * 购买应用进入订单确认页
	 */
	public function confirmService1Action(){
		$this->wxid = ChkClng(KS_G('get.id'));
	 	$batch  = ChkClng(KS_S('batch'));
		$appids = ChkSQL(KS_S('appids'));
		$appids = explode('@',$appids);
		if(empty($appids)){KS_INFO('请选择',4,'','',1);}
		$numb = ChkClng(KS_S('numb'));
		if($batch==1){
			$shopModel = M('common_cart');
			foreach($appids as $k=>$v){$shopModel->delete("wxid=$this->wxid and appid=$v");}
			$url = M_URL('Cart','index');KS_INFO('删除成功',0,$url);
		}else{
			foreach($appids as $k=>$v){$applist[$k] = $this->cache->GetA('appinfo','appid',$v,'',true);}
			$sumMoney   = 0;
			$usersModel = M('common_user');
			$Money      = getWxinfo($this->wxid,'money');
			$payconfig = $this->cache->GetACache('payconfig');//取出缓存
			include  CURR_VIEW_PATH . "Domain/Confirm_order.php";
		}
	}
	/**
     * 购买应用的支付流程
	 */
	public function payAction(){
		$this->wxid = ChkClng(KS_G('get.id'));
	    cookie('TOKEN',date("YmdHis"));
	    $appids    = ChkSQL(KS_G('post.appid'));
	    $order_amount    = ChkFloat(floatval(KS_G('post.order_amount')));
	    $shopModel = M('common_order');
	    $Porderid  = ChkClng(KS_G('post.Porderid'));
	    if($Porderid!==0){
		    $Data['ordersn']   = $shopModel->getOne('ordersn',"where orderid=$Porderid");
	    }else{
		    list($usec, $sec)  = explode(" ", microtime());
		    $Data['ordersn']   = $this->wxid.((float)$usec + (float)$sec)*10000;
		    $Data['userid']    = 0;
		    $Data['wxid']      = $this->wxid;
		    $Data['userip']    = KS_IP();
		    $Data['adddate']   = time();
		    $Data['paystatus'] = 0;

		    $orderid = $shopModel->doAdd($Data,'orderid');
	    }
	    $order_apps = M('common_order_info');
	    $cartModel  = M('common_cart');
	    $sumMoney   = 0;
	    $subject    = '';

	    foreach($appids as $k=>$v){
		    $applist             = $this->cache->GetA('appinfo','appid',$v,'',true);
		    if($k==0){$subject   .= $applist['appname'];}
		    else{$subject   .= ','.$applist['appname'];}
		    $Datas['appid']      = $v;
			$Datas['wxid']    =  $this->wxid;
			$Datas['adddate']    = time();
			$Datas['appname']    = $applist['appname'];
			$Datas['ordersn']    = $Data['ordersn'];
		    $Datas['price']      = $applist['price'];
		    $Datas['defaultpic'] = $applist['defaultpic'];
		    $Datas['numb']       = ChkClng(KS_G('post.numb_'.$v));
		    if($Porderid!==0) {$orderid = $Porderid;
		    }else{
			   $Datas['orderid'] = $orderid;
			   $order_apps->doAdd($Datas,'id');//添加单个app信息
		       $cartModel->delete("wxid=$this->wxid and appid=$v"); //删除购物车
		    }
		    $sumMoney = $sumMoney+$Datas['numb']*$Datas['price'];
	    }
		$user_website = M('common_user_website');
		$website = $user_website->getRow("where wxid=$this->wxid");


		if ($website['salesmantype']==1&&!empty(ChkClng($website['salesman']))&&$website['istry']==0&&ChkClng(KS_G('post.is_sales',1))==1){
			$Datapl['salesman'] = $website['salesman'];
			$res = getSalesincome($order_amount,2);
			$Datapl['salesincome'] = $res['salesincome'];
			$Datapl['salescommission'] = $res['salescommission'];
		}

		$Money  = getWxinfo($this->wxid,'money');  //实时得到店铺的余额
		$pay_log           = M('common_pay_log');
		$Datapl['userid']  =  0;
	    $Datapl['wxid']    =  $this->wxid;
	    $Datapl['adddate'] =  time();
	    $Datapl['cmoney']  =  $order_amount;
	    $Datapl['balance'] =  $Money;
	    $Datapl['type']    =  1;
	    $Datapl['userip']  =  KS_IP();
	    $Datapl['mark']    =  '后台开通APP，支付订单：'.$Data['ordersn'];;
		$Datapl['linepaytype'] = 0;
	    $pay_log->doAdd($Datapl,'id');

        $PayModel            = M('Application/PayModel');
        $PayModel->ServiceOrderProcess($Data['ordersn'],0);    //调用统计支付成功后的订单信息

        KS_Alert('恭喜，开通成功！','success',M_URL('Domain','Service',$this->wxid));
    }
    //增值服务
	public function ServiceAction(){
		$this->wxid = ChkClng(KS_G('get.id'));
		//用户拥有的代金券
        $voucher               = $this->cache->GetHCache('voucher',$this->wxid);//代金卷
		$common_voucher        = M('common_voucher');
		$appcategory           = $this->cache->GetACache('appcategory');//读取缓存
		$websiteinfo           = $this->cache->GetHCache('website',$this->wxid);//读出缓存
		$package               = $websiteinfo['package'];
		$status                = $websiteinfo['status'];
        $wxmoney               = $websiteinfo['money'];//网校的总金额
        $withdrawmoney         = $websiteinfo['withdrawmoney'];//网校的总金额
		$versionname           = $this->cache->GetA('commonpackageversion','versionename',$package,'versionname');

		$package_version       = $this->cache->GetACache('commonpackageversion');
    	$package_feature       = $this->cache->GetACache('commonpackagefeature');
        foreach($package_version as $k=>$v){$vesion[$k] = array();
        	foreach($package_feature as $kt=>$vt){
        		if($v['versionename'] == $vt['versionename']){$vesion[$k][$vt['seriesid']]  = $vt;}
        	}
        }
        $common_app = M('common_app');
        $appinfo    = $common_app ->getAll('where isprice=1 and status!=0');
        $shopModel = M('common_cart');
		$pagecarts = $shopModel->getAll("where wxid=$this->wxid");

        $appuserrelate  = M('common_app_userrelate');
		foreach($appinfo as $k=>$v){
			$appNum = $shopModel ->getOne('count(*)',"where wxid=$this->wxid and appid=$v[appid]");
			if($appNum>0){$appinfo[$k]['isopen'] = 1;}else{$appinfo[$k]['isopen'] = 0;}
		}
		include  CURR_VIEW_PATH . "Domain/service.php";
    }



	public function wxpaymentAction(){
		$wxid    = ChkClng(KS_G('get.id'));//wxid
		$setting = $this->cache->GetH('apprelate','appid',19,'setting',$wxid);
		if(empty($setting)){
			 $setting = array('1'=>'0');
		}else{
			 $setting = explode('※',$setting);
		}
		include  CURR_VIEW_PATH . "Domain/wxpayment.php";
	}
	public function PayswitchAction(){
		$wxid=KS_G('get.id');//wxid
        $paystyle        = ChkClng(KS_G("post.paystyle"));
        $setting         = $this->cache->GetH('apprelate','appid',19,'setting',$wxid);
	    $setting         = explode('※',$setting);
        $setting[1]      = $paystyle;
        $Data['setting'] = implode('※',$setting);
	    $apprelateModel  = M('common_app_userrelate');
	    $apprelateModel->update($Data,'wxid='.$wxid.' and appid = 19');
	    $appcategory = $this->cache->PutHCache('apprelate',$wxid);
        echo 'succeed';exit;
    	var_dump($paystyle);exit;
   }


	public function editwxAction(){
		$now_page =  ChkClng(KS_S('p',1));
		$id       = ChkClng(KS_G('request.id'));
		$common_user_website = M('common_user_website');
		$value    = $common_user_website->getRow("where wxid=$id limit 1");
		 $setting      =  explode('|',$value['setting']);
		 $ismember     =  $setting[0];//是否开启会员
		 $isregister   =  $setting[1];//是否允许注
		 $isemaillogin =  $setting[2];//是否允许邮箱登
		 $isphonelogin =  $setting[3];//是否允许手机登录
		 $isinfo       =  $setting[4];//是否强制完善信息
		 $isQuestAudit =  $setting[5];//提问是否审核
		 $isshuiyin    =  $setting[6];//提问开启水印
		 $city = $this->cache->GetACache('areainfo');//、测试地区
		 if($value['countyid'] == 0){
		 	if($value['cityid'] == 0){
		 		$areaid = $value['provinceid'];
		 	}else{
		 		$areaid=  $value['cityid'];
		 	}
		 }else{
		 	$areaid=  $value['countyid'];
		 }
		$areas = \Core\Phptree::makeTreeForHtml($city);
		include  CURR_VIEW_PATH . "Domain/editwx.php";
	}
	public function packagelogAction(){
		$wxid                = ChkClng(KS_G('get.id'));//wxid
		$common_user_package = M('common_user_package');
		$value = $common_user_package->getAll('where wxid='.$wxid);
		$common_website = M('common_user_website');
		$package = $common_website->getOne('package','where wxid='.$wxid);
		include  CURR_VIEW_PATH . "Domain/packagelog.php";
	}
	public function dowxeditAction(){
		$websiteModel            = M('Application/WebsiteModel/common_user_website');
		$this->wxid              = ChkClng(KS_G('get.id'));
		$Data['wxid']            = $this->wxid;
		$this->userid = KS_G('post.userid');
		if(!empty(ChkSQL(KS_G('post.logo')))){$Data['logo']        = ChkSQL(KS_G('post.logo'));}
		$Data['shuiyin']      = ChkSQL(KS_G('post.shuiyin'));
		$Data['isbos']        = ChkSQL(KS_G('post.isbos'));
		$Data['sitename']        = ChkSQL(KS_G('post.sitename'));
		$Data['copyright']       = ChkSQL(KS_G('post.copyright'));
		$Data['status']          = ChkClng(KS_G('post.status'));
		$Data['seotitle']        = ChkSQL(KS_G('post.seotitle'));
		$Data['metakeywords']    = ChkSQL(KS_G('post.metakeywords'));
		$Data['metadescription'] = ChkSQL(KS_G('post.metadescription'));
		$setting    = $websiteModel->getOne('setting',"where userid = $this->userid");
		$setting    = explode('|',$setting);
		$setting[0] = ChkClng(KS_G('post.ismember'));//是否开启会员
		$setting[1] = ChkClng(KS_G('post.isregister'));//是否允许注册
		$setting[2] = ChkClng(KS_G('post.isemaillogin'));//是否允许邮箱登录
		$setting[3] = ChkClng(KS_G('post.isphonelogin'));//是否允许手机登录
		$setting[4] = ChkClng(KS_G('post.isinfo'));//是否强制完善信息
		$setting[5] = ChkClng(KS_G('post.isQuestAudit'));//是否提问审核
		$setting[6] = ChkClng(KS_G('post.isshuiyin'));//是否开启水印
		$setting[7]   =   ChkClng(KS_G('post.isbos'));//提问开启bos
		$Data['setting'] = implode('|',$setting);
		/*----------------------保存地区------------------------------*/
		$areaid = ChkClng(KS_G('post.areaid'));
		$areaModel = M('common_area');
		if($areaid!=0){
			$depth = $areaModel->getOne('depth',"where id=$areaid");
			if($depth==3){
				$Data['countyid']   = $areaid;
				$Data['cityid']     = $areaModel->getOne('parentid',"where id=$Data[countyid]");
				$Data['provinceid'] = $areaModel->getOne('parentid',"where id=$Data[cityid]");
			}elseif($depth==2){
				$Data['countyid']   = 0;
				$Data['cityid']     = $areaid;
				$Data['provinceid'] = $areaModel->getOne('parentid',"where id=$Data[cityid]");
			}elseif($depth==1){
				$Data['countyid']   = 0;
				$Data['cityid']     = 0;
				$Data['provinceid'] = $areaid;
			}
		}
		/*----------------------字段拼接测试中------------------------------*/
		$tableModel = M('common_table');
		$tableid = $tableModel->getOne('tableid',"where tablename='common_user_website'");
		$fieldModel = M('common_table_field');//实例化字段表
		$Field = $fieldModel->getAll("where tableid = $tableid and isentry=1 and status=1 and fiesys=1 order by orderid");
		foreach($Field as $Fk => $Fv){
			 $fieldname = $Fv['fieldname'];
			 $Data[$fieldname] = ChkSQL(KS_G('post.'.$fieldname));
			 if($Fv['mustinput']==1)
			 {$Rule[$fieldname]  = $Fv['title'].'|isEmpty';}
		}
		$websiteModel->update($Data,"wxid=$this->wxid");
		$this->cache->PutHCache('website',$this->wxid);//写入缓存
		$url =  M_URL('home/Domain','wxlist');
		KS_INFO('更新成功',0,$url);
    }
    //短信签名
    public function smslistAction(){
    	$status=KS_S('status',3);//状态筛选
		if($status==3){$where = 'where (status=1 or status=2 or status=0)';}
		elseif($status==2){$where = 'where status=2'; }
		elseif($status==1){$where = 'where status=1';}
		elseif($status==0){$where = 'where status=0';}
		$byname=null !==GF('byname') ? GF('byname'):'wxid desc';//排序
		$keyword = ChkSQL(KS_S('keyword'));
		$keytype = ChkClng(KS_S('keytype',1));
		if(!empty($keyword)){
			if($keytype==1){$where.=" and sitename like '%$keyword%'";}
			elseif($keytype==2){$where.=" and signsms like '%$keyword%'";}
		}
		$sms_sign = M('common_sms_sign');
		$options  = $sms_sign->getOptions('8',$where);//分页参数设置
		$page     = Page($options);
		$values   = $sms_sign->getPage($page,$byname,$where);
    	include  CURR_VIEW_PATH . "Domain/smslist.php";
    }
    //短信签名批量操作
    public function smsbatchAction(){
    	$id = isset($_POST["check"])?$_POST["check"]:'';
		$now_page = ChkClng(KS_S('p',1));
		if(empty($id)){KS_INFO("请选择");}
		$common_domain = M('common_sms_sign');
		$url = M_URL('home/Domain','smslist','',GP('p-'.$now_page));
		//批量审核
		if(KS_G('post.batch')==2){
		    $data['status'] = 2;
		    foreach ($id as $v ) {$common_domain->update($data, "id=$v");}
			$this->cache->putACache('domaininfo');//写入缓存
			KS_INFO('批量审核成功',0,$url);
		}
		//批量取消审核
		elseif(KS_G('post.batch')==3){
			$data['status'] = 1;
			foreach ($id as $v ) {$common_domain->update($data, "id=$v");}
			$this->cache->putACache('domaininfo');//写入缓存
			KS_INFO('批量取消审核成功',0,$url);
		}
    }
    //短信签名审核通过
	public function smsauditedAction(){
		$wxid              = ChkClng(KS_G('request.id'));
		$now_page          = ChkClng(KS_S('p',1));
		$sms_sign          = M('common_sms_sign');
		$data['status']    = 2;
		$smssign           = $this->cache->GetHCache('smssign',$wxid);//读出缓存
		if(isset($smssign['signsms'])&&!empty($smssign['signsms'])){
			$datas["signsms"]  = $smssign['signsms'];
		}else{
			$datas["signsms"]  = '【科汛V名师】';
		}
	    $websiteModel      = M('common_user_website');
	    $websiteModel->update($datas,"wxid=$wxid");
	    $sms_sign->update($data,"wxid=$wxid");
        $this->cache->PutHCache('website',$wxid);//写入缓存
        $this->cache->PutHCache('smssign',$wxid);//写入缓存
		$url = M_URL('home/Domain','smslist','',GP('p-'.$now_page));
		ks_header($url);
	}
	//短信签名取消审核
	public function smsunauditedAction(){
		$wxid              = ChkClng(KS_G('request.id'));
		$now_page          = ChkClng(KS_S('p',1));
		$sms_sign          = M('common_sms_sign');
		$data['status']    = 1;
		$datas["signsms"]  = '【科汛V名师】';
	    $websiteModel      = M('common_user_website');
	    $websiteModel->update($datas,"wxid=$wxid");
		$sms_sign->update($data,"wxid=$wxid");
        $this->cache->PutHCache('website',$wxid);//写入缓存
		$this->cache->PutHCache('smssign',$wxid);//写入缓存
		$url = M_URL('home/Domain','smslist','',GP('p-'.$now_page));
		ks_header($url);
	}
	//直播点播配置
	public function liveConfigAction(){
		$wxid = ChkClng(KS_G('request.id'));

		$liveModel=M('app_live');
		$live =$liveModel->getRow(' where wxid='.$wxid.' limit 1');
//		if(!$live){
//			echo "<script>alert('该机构尚未开通直播服务'); top.closePopup(window.name);</script>";
//			exit;
//		}
		$onetype=explode(',',$live['onelivetype']);
		$interfaceModel = M('common_managevdo');
		$managelive=$interfaceModel->getRow('where type=2 and isdefault=1 limit 1');
		$keytitle=explode('〓',$managelive['keytitle']);
		if($live['isenable']==1){
			$Agora=explode('〓',$live['Agora']);
			$interfaceModel=M('common_managevdo');
			$key=explode('〓',$live['bypass']);
		}
		$resolutionModel=M('common_resolution');
		$resolution=$resolutionModel->getAll('where type=1 and isenable=1');

		include  CURR_VIEW_PATH . "Domain/liveConfig.php";
	}
	//点播配置
	public function vodConfigAction(){
		$wxid = ChkClng(KS_G('request.id'));
		if ($wxid){
			$liveModel=M('app_live_config');
			$live =$liveModel->getRow(' where wxid='.$wxid.' limit 1');
			if ($live) $live['json'] = json_decode($live['json'],true);
		}
		include  CURR_VIEW_PATH . "Domain/vodConfig.php";
	}

	//进行直播配置
	public function doliveAction(){


		 $onetype = ChkSQL(KS_G('post.onetype'));

		 if($onetype==0){
		 	KS_INFO('分辨率最少选择一个');
		 }
		 $Data['onelivetype']=implode(',',$onetype);

		$wxid = ChkClng(KS_G('request.id'));
		$liveModel=M('app_live');
		$Data['isssl']=ChkClng(KS_G('request.isssl'));
		$Data['isenable']=ChkClng(KS_G('request.isenable'));
		if($Data['isenable']==1){
			 $key = ChkSQL(KS_G('post.key'));
	         $keytitle = ChkSQL(KS_G('post.keytitle'));
	         $Agorakey=ChkSQL(KS_G('post.Agorakey'));
	         $AppCertificate=ChkSQL(KS_G('post.AppCertificate'));
	         $Data['Agora']=$Agorakey.'〓'.$AppCertificate;

	         $Data['bypass']=implode('〓',$key);

		}

		$liveModel->update($Data,'wxid='.$wxid);
		$url = M_URL('home/Domain','wxlist','',GP(''));
		KS_INFO('保存成功',3,$url);

	}
	public function padsettingAction(){
		$Mode = M('common_user_website');
		$wxid = ChkClng(KS_G('request.id'));
		$values = $Mode->getRow('where wxid = '.$wxid);
		$Modes = M('app_carousel');
		$imgs = $Modes->getAll('where wxid = '.$wxid.' and type=2','img');
		$str = '';
		if(!empty($imgs)){
			foreach($imgs as $k=>$v){
				$imgs[$k]['img'] = Img($v['img']);
				if($k+1 == count($imgs)){
					$str .=$imgs[$k]['img'];
				}else{
					$str .=$imgs[$k]['img'].',';
				}

			}
		}else{
			$str = '';
		}
		include CURR_VIEW_PATH . "Domain/padsetting.php";
	}
	public function dopadSettingAction(){
		$wxid          = ChkClng(KS_G('request.id'));
		$Data['intro'] = KS_G('post.intro');
		$Mode = M('common_user_website');
		$Mode->update($Data,'wxid='.$wxid);
		$Modes = M('app_carousel');
		$Modes->delete('wxid='.$wxid);
		$img  = KS_G('post.tempsrc');
		$imgs = explode(',',$img);
		$Datas['wxid'] = $wxid;
		$Datas['type'] = 2;
		foreach($imgs as $k=>$v){
			$Datas['img'] = $v;
			$Modes->doAdd($Datas,'id');
		}
		KS_INFO('更新完成',3,M_URL('home/Domain','wxlist','',GP('')));
	}

	 //购买短信什么的进入订单确认页
	 public function confirmServiceAction(){
	 	$this->wxid        = ChkClng(KS_S('wxid'));
	 	$orderid           = ChkClng(null !==GF('orderid') ? GF('orderid'):'0');
	 	if(!empty($orderid)){
	 		$pays              = ChkClng(null !==GF('pays') ? GF('pays'):'0');
		    $order_info        = M('common_order_info');
			$orderinfo         = $order_info->getRow("where orderid=$orderid limit 1",'appid,numb,starttime,endtime,ordersn,adddate');
			$serviceinfo       = $this->cache->GetA('service','serviceid',$orderinfo['appid'],'',true);
		    $numb              = $orderinfo['numb'];
		    $serviceid         = $orderinfo['appid'];
		    if($serviceid==6){
		    	$starttime         = $orderinfo['starttime'];
		        $endtime           = $orderinfo['endtime'];
		    }
		    $servicemoney      = $orderinfo['numb']*wx_version_itemvalue($serviceinfo['seriesid'],$this->wxid);
	    }else{
	   	    $serviceid         = ChkClng(KS_G('request.id'));
		    $numb              = ChkSQL(null !==GF('numb') ? GF('numb'):'1');
		    $serviceinfo       = $this->cache->GetA('service','serviceid',$serviceid,'',true);
		    $servicemoney      = wx_version_itemvalue($serviceinfo['seriesid'],$this->wxid)*$numb;

		    if($serviceid==3){
		    	   $day               = ChkClng(null !==GF('day') ? GF('day'):'1');
		    	   $starttime         = ChkClng(null !==GF('starttime') ? GF('starttime'):time());
		    	   $endtime           = ChkClng(null !==GF('endtime') ? GF('endtime'):time());
		    	   $servicemoney      = wx_version_itemvalue($serviceinfo['seriesid'],$this->wxid)*$numb*$day;
		    }elseif($serviceid==6){
//		    	    $starttime=mktime(0,0,0,date('m'),1,date('Y'));
//                  $endtime=mktime(23,59,59,date('m'),date('t'),date('Y'));
		    	   $day               = ChkClng(null !==GF('days') ? GF('days'):'1');
		    	   $starttime         = ChkClng(null !==GF('starttime') ? GF('starttime'):time());
		    	   $endtime           = ChkClng(null !==GF('endtime') ? GF('endtime'):time());
		    	   $servicemoney      = wx_version_itemvalue($serviceinfo['seriesid'],$this->wxid)*$numb*$day;
		    }
	    }
	    if($servicemoney<0){KS_INFO('系统出错，请联系管理人员');}
	    $voucher           = $this->cache->GetHCache('voucher',$this->wxid);
	    $website           = $this->cache->GetHCache('website',$this->wxid);
	    $Money             = $website['money'];//防止重复提交 如果重复提交跳转至相关页面
		if(cookie('TOKEN')!==null){cookie('TOKEN',null);$url = M_URL('Order','index');ks_header($url);}
	    $payconfig = $this->cache->GetACache('payconfig');//取出缓存
	    include  CURR_VIEW_PATH . "Domain/Confirm_order1.php";
	 }

}