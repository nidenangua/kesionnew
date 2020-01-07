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
class CapitalController extends CommonController
{
    public function _initialize()
    {
        parent::_initialize();
        check_power($this->userinfo,'close','paylog');
    }

    public function indexAction(){
     	$Data['status'] = 2;
        M('common_voucher')->update($Data,'enddate<'.time());//过滤掉过期的优惠券
        $this->cache->PutHCache('voucher',$this->wxid);//更新缓存
		//$userModel          = M('common_user');
		//$money              = $userModel ->getOne('money','where wxid='.$this->wxid);
        //$study_recharge     = $app_pay_log->getOne('count(cmoney)','where wxid='.$this->wxid);
        //$wx_recharge        = $common_pay_log->getOne('count(cmoney)','where wxid='.$this->wxid);
        $withdraw_log         = M('common_withdraw_log');//提现记录表部分
        $withdrawnum          = $withdraw_log->getOne('count(*)',"where wxid=".$this->wxid." and date_format(from_UNIXTIME(adddate),'%Y-%m')=date_format(now(),'%Y-%m')");
		$base                 = $this->cache->GetACache('setting');//读出缓存
        //用户拥有的代金券
        $voucher              = $this->cache->GetHCache('voucher',$this->wxid);//代金卷
        $voucher_money        = 0;
        foreach($voucher as $k=>$v){
        	if($v['enddate']>time()){
        		$voucher_money = $voucher_money+$v['balance'];
        	}
        }
        $db_task_reward = M('common_task_reward');
        $taskVoucher = $db_task_reward->getAll('where wxid='.$this->wxid.' and status=0 and effectivetime>'.time());
        //网校使用代金券的明细
        //$voucher_log          = M('common_voucher_log');//订单副表即订单课程部分
        //$voucherlog           = $voucher_log->getAll('where wxid='.$this->wxid.' order by adddate desc limit 6');
        //用户的总金额
        $wxinfo               = $this->cache->GetHCache('website',$this->wxid);//读出缓存
        $status               = $wxinfo['status'];
        //$wxmoney            = $wxinfo['money'];
        $wxmoney              = getWxinfo($this->wxid,'money');	//网校的总金额
        $withdrawmoney        = getWxinfo($this->wxid,'withdrawmoney');//网校可提现的总金额
        //学员购买课程的明细
        $order_courses        = M('app_order_info');//订单副表即订单课程部分
        $course               = $order_courses->getAll('where wxid='.$this->wxid.' order by adddate desc limit 6');
        $common_pay_log       = M('common_pay_log');//订单副表即订单课程部分
        $options              = $common_pay_log->getOptions('5','where wxid='.$this->wxid);//分页参数设置
		$page                 = Page($options);
		$wx_pay_log           = $common_pay_log->getPage($page,'adddate desc','where wxid='.$this->wxid);
        include  CURR_VIEW_PATH . "Capital/home.capital.php";
     }





     /*************************************************************结算中心 begin by 自由的飞 at 2019.4.12 *************************/
     /**
      * 结算中心（列表）
      */
     public function withdrawbillAction(){
         $withdraw_log            = M('common_withdraw_log');//提现记录表部分
         $summoney                = $withdraw_log->getOne('sum(actualmoney)','where wxid='.$this->wxid.' and status=0');//待打款金额
         $withdrawmoney           = $withdraw_log->getOne('sum(actualmoney)','where wxid='.$this->wxid.' and status=1');
         $status                  = ChkClng(KS_S('status','3'));
         $where                   = ' where a.wxid ='.$this->wxid;
         if($status == 0){$where .= ' and a.status=0';}
         elseif($status == 1){$where .= ' and a.status=1';}
         elseif($status == 3){$where .= ' and (a.status=1 or a.status=0)';}
         $adddate              = null !==GF('adddate') ? GF('adddate'):'0';
     	if($adddate== 0){$px  = 'id desc';}
         elseif($adddate==1){$px = 'id asc';}

         $option               = ChkClng(KS_S('option','1'));  //按月，季查看
         if($option==1){
             $month_start=mktime(0, 0 , 0,date("m"),1,date("Y"));
             $where .= ' and a.adddate>'.$month_start;
         }elseif($option==2){
             $lastmonth_start=mktime(0,0,0,date('m')-1,1,date('Y'));
             $lastmonth_end=mktime(0,0,0,date('m'),1,date('Y'))-24*3600;
             $where .= ' and a.adddate>'.$lastmonth_start.' and a.adddate<'.$lastmonth_end;
         }elseif($option==3){
             $season        = ceil((date('n'))/3);//当月是第几季度
             $season_start  = mktime(0, 0, 0,$season*3-3+1,1,date('Y'));
             //$season_end    = mktime(23,59,59,$season*3,date('t',mktime(0, 0 , 0,$season*3,1,date("Y"))),date('Y'));
             $where .= ' and a.adddate>'.$season_start;
         }elseif($option==4){
             $season           = ceil((date('n'))/3)-1;//上季度是第几季度
             $lastseason_start = mktime(0, 0, 0,$season*3-3+1,1,date('Y'));
             $lastseason_end   = mktime(23,59,59,$season*3,date('t',mktime(0, 0 , 0,$season*3,1,date("Y"))),date('Y'));
             $where .= ' and a.adddate>'.$lastseason_start.' and a.adddate<'.$lastseason_end;
         }
         $keyword = ChkSQL(KS_S('keyword'));//搜索
         $keytype = ChkClng(KS_S('keytype',1));
         //判断是否输入关键字
         if(!empty($keyword)){
		     if($keytype==1){$where.=" and a.memberid like '%$keyword%'";}
		     elseif($keytype==2){$where.=" and b.username like '%$keyword%'";}
		     elseif($keytype==3){$where.=" and b.mobile like '%$keyword%'";}
		     elseif($keytype==4){$where.=" and a.memberip like '%$keyword%'";}
         }
         $common_user   = M('common_user');
         $where         = "as a inner join `$common_user->table` as b on a.userid = b.userid $where";
         $options       = $withdraw_log->getOptions('10',$where);//分页参数设置
         $page          = Page($options);
         $values        = $withdraw_log->getPage($page,$px,$where,'b.username,b.mobile,a.*');
         include  CURR_VIEW_PATH . "Capital/withdraw/home.withdrawlist.php";
     }

     /**
      * 进入提现申请页
      */
     public function withdrawapplyAction(){
         $wxinfo               = $this->cache->GetHCache('website',$this->wxid);//读出缓存
         $status               = $wxinfo['status'];
         $wxmoney              = $wxinfo['money'];//网校的总金额
         $withdrawmoney        = $wxinfo['withdrawmoney'];//网校可提现的总金额

         $db = M('common_withdraw_log');
         $row= $db->getRow('where wxid='.$this->wxid.' order by adddate desc limit 1');
         if ($row){
             $name=$row['name'];
         }else{
             $name='';
         }
         include  CURR_VIEW_PATH . "Capital/withdraw/home.withdrawapply.php";
     }

     /**
      * 点申请提现，开始保存
      */
     public function savewithdrawmoneyAction(){
     	$withdrawmoney       = ChkSQL(KS_G('post.withdrawmoney'));   //本次提现金额
     	if($withdrawmoney==0){KS_INFO('提现金额不能为零',0,'','',1);}

         //运营增值服务
         $isVIP               = checkIsVipVersion($this->wxid);

       	 $withdraw_log        = M('common_withdraw_log');//提现记录表部分
         $withdrawnum         = $withdraw_log->getOne('count(*)',"where wxid=".$this->wxid." and date_format(from_UNIXTIME(adddate),'%Y-%m')=date_format(now(),'%Y-%m')");  //统计本月提现次数
         $base                = $this->cache->GetACache('setting');//读出缓存
         if($isVIP){//买了运营套餐包
		     if($withdrawnum>=$base['withdrawnum1']){KS_INFO('超过本月提现次数',0,'','',1);}
			 if($withdrawmoney<$base['withdrawmoney1']){KS_INFO('单次至少提现'.$base['withdrawmoney1'].'元',0,'','',1);}
         }else{
		     if($withdrawnum>=$base['withdrawnum']){KS_INFO('超过本月提现次数',0,'','',1);}
			 if($withdrawmoney<$base['withdrawmoney']){KS_INFO('单次至少提现'.$base['withdrawmoney'].'元',0,'','',1);}
         }

     	$wxinfo              = $this->cache->GetHCache('website',$this->wxid);//读出缓存
        $withdraw            = $wxinfo['withdrawmoney'];//网校的总提现金额
     	if(($withdraw-getWxPay($this->wxid))<$withdrawmoney){
             KS_INFO('您的余额不足',0,'','',1);
             exit;
         }

     	//插入订单明细表
         $Data['wxid']        = $this->wxid;
         $Data['userid']      = $this->userid;
         $Data['adddate']     = time();
         $Data['cmoney']      = $withdrawmoney;

         if($isVIP){ //买了运营套餐包
			 $Data['poundage']    = $withdrawmoney*$base['poundage1']*0.01;  //手续费（买过运营套餐包）
         }else{
             $Data['poundage']    = $withdrawmoney*$base['poundage']*0.01;   //手续费
         }

         $Data['actualmoney'] = $withdrawmoney-$Data['poundage'];    //实际到账=本次提现-手续费
         $Data['balance']      = $withdraw-$withdrawmoney;           //剩余可提现金额
         $Data['userip']       = $_SERVER['SERVER_ADDR'];

         $Data['paytype']      = KS_G('post.paytype');
         $Data['bank']         = KS_G('post.bank');
         if($Data['paytype'] == 0){
             $Data['banknum'] = $_POST['banknum'][0];
             if(empty($Data['banknum'])){KS_INFO('银行卡号不能为空',0,'','',1);}
             $Data['name'] = $_POST['name'][0];
             if(empty($Data['name'])){KS_INFO('姓名不能为空',0,'','',1);}
         }
         if($Data['paytype'] == 1){
             $Data['banknum'] = $_POST['banknum'][1];
             if(empty($Data['banknum'])){KS_INFO('支付宝号不能为空',0,'','',1);}
             $Data['name'] = $_POST['name'][1];
             if(empty($Data['name'])){KS_INFO('姓名不能为空',0,'','',1);}
         }
         if($Data['paytype'] == 2){
             $Data['name'] = $_POST['banknum'][2];
             if(empty($Data['name'])){KS_INFO('请先扫码绑定微信，才可以申请提现',0,'','',1);}
             $Data['banknum'] = KS_G('post.nickname');
             $Data['openid']   = KS_G('post.openid');
             if(empty($Data['openid'])){
                 KS_INFO('请绑定微信号',0,'','',1);
                 exit;
             }
         }
         $Data['usermark']    = KS_G('post.usermark');
         $Data['mark']        = '您提现了'.$withdrawmoney.'元,请等待审核,三天内到账。';
         $withdraw_log->doAdd($Data,'id');

         $Datau['withdrawmoney']= $withdraw-$withdrawmoney;
         $Datau['withdrawsum']  = $wxinfo['withdrawsum']+$withdrawmoney;
         $user_website          = M('common_user_website');
         $user_website->update($Datau,"wxid=$this->wxid");
         $this->cache->PutHCache('website',$this->wxid);
         $url                   = M_URL('Capital','withdrawbill');
         KS_INFO('提现已提交,三天内到账',0,$url);
     }
    /*************************************************************结算中心 end by 自由的飞 at 2019.4.12 *************************/

    /*************************************************************推广中心 begin by 王海松 at 2019.9.12 *************************/
    /**
     * 进入推广提现申请页
     */
    public function salesWithdrawapplyAction(){
        $common_pay_log = M('common_pay_log');
        $app_order = M('app_order');
        $app_withdraw_log = M('app_withdraw_log');
        $row= $app_withdraw_log->getRow('where wxid='.$this->wxid.' order by adddate desc limit 1');
        if ($row){
            $name=$row['name'];
        }else{
            $name='';
        }
        $salesincome1 = $app_order->getOne('sum(salesincome)',"where salesman='$this->userid' and paystatus=1");//名师收益
        $salesincome2 = $common_pay_log->getOne('sum(salesincome)',"where salesman='$this->userid' and type=1");//机构收益
        $result['all_salesincome'] = (string)($salesincome1+$salesincome2);
        $result['have_withdrawal'] = (string)ChkFloat($app_withdraw_log->getOne('sum(cmoney)',"where wxid=$this->wxid and userid=$this->userid and type=1")) ;
        $result['no_withdrawal'] = (string)($result['all_salesincome']-$result['have_withdrawal']);

        include  CURR_VIEW_PATH . "Capital/withdraw/home.salesWithdrawapply.php";
    }
    /**
     * 点申请提现，开始保存
     */
    public function saveSalesWithdrawmoneyAction(){
        $withdrawmoney       = ChkSQL(KS_G('post.withdrawmoney'));   //本次提现金额
        if($withdrawmoney==0){KS_INFO('提现金额不能为零',0,'','',1);}

        //运营增值服务
        $isVIP               = checkIsVipVersion($this->wxid);

        $app_withdraw_log        = M('app_withdraw_log');//提现记录表部分
        $common_pay_log = M('common_pay_log');
        $app_order = M('app_order');
        $withdrawnum         = $app_withdraw_log->getOne('count(*)',"where wxid=".$this->wxid." and type=1 and date_format(from_UNIXTIME(adddate),'%Y-%m')=date_format(now(),'%Y-%m')");  //统计本月提现次数
        $base                = $this->cache->GetACache('setting');//读出缓存
        if($isVIP){//买了运营套餐包
            if($withdrawnum>=$base['withdrawnum1']){KS_INFO('超过本月提现次数',0,'','',1);}
            if($withdrawmoney<$base['withdrawmoney1']){KS_INFO('单次至少提现'.$base['withdrawmoney1'].'元',0,'','',1);}
        }else{
            if($withdrawnum>=$base['withdrawnum']){KS_INFO('超过本月提现次数',0,'','',1);}
            if($withdrawmoney<$base['withdrawmoney']){KS_INFO('单次至少提现'.$base['withdrawmoney'].'元',0,'','',1);}
        }
        $wxinfo              = $this->cache->GetHCache('website',$this->wxid);//读出缓存

        $salesincome1 = $app_order->getOne('sum(salesincome)',"where salesman='$this->userid' and paystatus=1");//名师收益
        $salesincome2 = $common_pay_log->getOne('sum(salesincome)',"where salesman='$this->userid' and type=1");//机构收益
        $result['all_salesincome'] = (string)($salesincome1+$salesincome2);
        $result['have_withdrawal'] = (string)ChkFloat($app_withdraw_log->getOne('sum(cmoney)',"where wxid=$this->wxid and userid=$this->userid and type=1")) ;
        $result['no_withdrawal'] = (string)($result['all_salesincome']-$result['have_withdrawal']);

        $withdraw            = $wxinfo['withdrawmoney'];//网校的总提现金额
        if($result['no_withdrawal']<$withdrawmoney){
            KS_INFO('您的余额不足',0,'','',1);
            exit;
        }

        //插入订单明细表
        $Data['wxid']        = $this->wxid;
        $Data['userid']      = $this->userid;
        $Data['type']        = 1;
        $Data['adddate']     = time();
        $Data['cmoney']      = $withdrawmoney;

        if($isVIP){ //买了运营套餐包
            $Data['poundage']    = $withdrawmoney*$base['poundage1']*0.01;  //手续费（买过运营套餐包）
        }else{
            $Data['poundage']    = $withdrawmoney*$base['poundage']*0.01;   //手续费
        }

        $Data['actualmoney'] = $withdrawmoney-$Data['poundage'];    //实际到账=本次提现-手续费
//        $Data['balance']      = $withdraw-$withdrawmoney;           //剩余可提现金额
        $Data['userip']       = $_SERVER['SERVER_ADDR'];

        $Data['paytype']      = KS_G('post.paytype');
        $Data['bank']         = KS_G('post.bank');
        if($Data['paytype'] == 0){
            $Data['banknum'] = $_POST['banknum'][0];
            if(empty($Data['banknum'])){KS_INFO('银行卡号不能为空',0,'','',1);}
            $Data['name'] = $_POST['name'][0];
            if(empty($Data['name'])){KS_INFO('姓名不能为空',0,'','',1);}
        }
        if($Data['paytype'] == 1){
            $Data['banknum'] = $_POST['banknum'][1];
            if(empty($Data['banknum'])){KS_INFO('支付宝号不能为空',0,'','',1);}
            $Data['name'] = $_POST['name'][1];
            if(empty($Data['name'])){KS_INFO('姓名不能为空',0,'','',1);}
        }
        if($Data['paytype'] == 2){
            $Data['name'] = $_POST['banknum'][2];
            if(empty($Data['name'])){KS_INFO('请先扫码绑定微信，才可以申请提现',0,'','',1);}
            $Data['banknum'] = KS_G('post.nickname');
            $Data['openid']   = KS_G('post.openid');
            if(empty($Data['openid'])){
                KS_INFO('请绑定微信号',0,'','',1);
                exit;
            }
        }
        $Data['usermark']    = KS_G('post.usermark');
        $Data['mark']        = '您提现了'.$withdrawmoney.'元,请等待审核,三天内到账。';
        $app_withdraw_log->doAdd($Data,'id');
        KS_INFO('提现已提交,三天内到账',2,'/home.html#/Generalize');
    }
    /*************************************************************推广中心 end by 王海松 at 2019.9.12 *************************/





    /**************************************************************提现微信绑定 begin ***********************************/
     /**
      * 绑定微信账号(第一步：绑定微信号）
      */
     public function weixinbindAction(){
     	$withdraw_openid = M('common_withdraw_openid');
         $withnum         = $withdraw_openid->getOne('count(id)','where wxid='.$this->wxid);
         if($withnum==0){
             $Data['wxid']    = $this->wxid;
             $Data['status']  = 0;
             $Data['adddate'] = time();
             $withdraw_openid->doAdd($Data,'id');
         }else{
             $Data['status']  = 0;
             $Data['adddate'] = time();
             $withdraw_openid->update($Data,'wxid='.$this->wxid);
         }
     	include  CURR_VIEW_PATH . "Capital/withdraw/home.weixinbind.php";
     }
     /**
      * 检查微信账号绑定情况
      */
     public function checkwinxinbindstatusAction(){
         $wxid            = ChkClng(KS_G('request.wxid'));
     	$withdraw_openid = M('common_withdraw_openid');
         $openidinfo  = $withdraw_openid->getRow('where wxid='.$wxid.' limit 1','status,openid,nickname');
         if(!empty($openidinfo)&&$openidinfo['status']==1){
             $result['result']    = 'succeed';
             $result['nickname']  = $openidinfo['nickname'];
             $result['openid']    = $openidinfo['openid'];
         }else{
		     $result['result']   = 'err';
         }
         header('Content-Type:application/json;charset=utf-8');
         echo json_encode($result);exit;
     }
     /**
      * 获取微信OPENID（扫生成的二维码过来）
      */
     public function getOpenidAction(){
     	$code      = KS_G('get.code');
         if(empty($code)){
             $customeUrl   = MY_FULLDOMAIN.$_SERVER['REQUEST_URI'];
             $appid        =  KS_C('WeChat_AppId');
             $oauthUrl     =  'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$appid.'&redirect_uri='.urlencode($customeUrl).'&response_type=code&scope=snsapi_userinfo&state=123#wechat_redirect';
             header('Location:'.$oauthUrl);exit;
         }else{
             $appid            =  KS_C('WeChat_AppId');
             $appsecret        =  KS_C('WeChat_AppSecret');
             $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$appsecret.'&code='.$code.'&grant_type=authorization_code';
             $file = geturl($url);
             $row = json_decode($file);
             if(isset($row->errcode)){
	        	 $Data001['type'] = 1;
			     $Cinfo['access_token'] = GetOpenAccessToken($Data001);
			     $url ='https://api.weixin.qq.com/sns/oauth2/component/access_token?appid='.$appid.'&code='.$code.'&grant_type=authorization_code&component_appid='.$Cinfo['appid'].'&component_access_token='.$Cinfo['access_token'];
		         $file = geturl($url);
		         $row = json_decode($file);
             }
             $access_token = $row->access_token;
             $url = "https://api.weixin.qq.com/sns/userinfo?access_token=".$row->access_token."&openid=".$row->openid."&lang=zh_CN";
             $authInfo = geturl($url);
             $userInfo = json_decode($authInfo);

             $this->wxid  = ChkClng(KS_G('get.id'));
             $withdraw_openid = M('common_withdraw_openid');
             $withnum         = $withdraw_openid->getOne('count(id)','where wxid='.$this->wxid);
             if($withnum==0){
                 $Data['wxid']       = $this->wxid;
                 $Data['nickname']   = $userInfo->nickname;
                 $Data['openid']     = $userInfo->openid;
                 $Data['headimgurl'] = $userInfo->headimgurl;
                 $Data['adddate']    = time();
                 $Data['status']     = 1;
                 $withdraw_openid->doAdd($Data,'id');
             }else{
                 $Data['nickname']   = $userInfo->nickname;
                 $Data['openid']     = $userInfo->openid;
                 $Data['headimgurl'] = $userInfo->headimgurl;
                 $Data['adddate']    = time();
                 $Data['status']     = 1;
                 $withdraw_openid->update($Data,'wxid='.$this->wxid);
             }
             ks_header(MY_FULLDOMAIN.'/home.html/default/Capital/getOpenid2/'.$this->wxid);
         }
     }

     /**
      * 绑定成功微信里的提示信息
      */
     public function getOpenid2Action(){
         include  CURR_VIEW_PATH . "Capital/withdraw/home.weixinbindok.php";
     }
    /********************************************提现微信绑定 end ***********************************/













     /**
     * 学员消费明细
      */
     public function paylogAction(){
     	$type                 = ChkClng(KS_S('type'));
     	$db                   = M('app_pay_log');//订单副表即订单课程部分
     	$income               = $db->getOne('sum(cmoney)','where wxid='.$this->wxid.' and type=1');//账号总收入
		if(getWxinfo($this->wxid,'icomemoney')!=$income){$title = '明细有被删除';}

        $type                 = ChkClng(KS_S('type',2));         //默认列出充值记录
		$where                = '  where a.status=0 and a.wxid ='.$this->wxid;
        if ($type>0){
            if($type == 2){$where .= ' and a.type=0';}
            elseif($type == 1){$where .= ' and a.type=1';}
        }
		$option               = null !==GF('option') ? GF('option'):'1';
		if($option==1){
			$month_start=mktime(0, 0 , 0,date("m"),1,date("Y"));
			$where .= ' and a.adddate>'.$month_start;
		}elseif($option==2){
			$lastmonth_start=mktime(0,0,0,date('m')-1,1,date('Y'));
			$lastmonth_end=mktime(0,0,0,date('m'),1,date('Y'))-24*3600;
			$where .= ' and a.adddate>'.$lastmonth_start.' and a.adddate<'.$lastmonth_end;
		}elseif($option==3){
			$season        = ceil((date('n'))/3);//当月是第几季度
            $season_start  = mktime(0, 0, 0,$season*3-3+1,1,date('Y'));
            //$season_end    = mktime(23,59,59,$season*3,date('t',mktime(0, 0 , 0,$season*3,1,date("Y"))),date('Y'));
            $where .= ' and a.adddate>'.$season_start;
		}elseif($option==4){
			$season           = ceil((date('n'))/3)-1;//上季度是第几季度
            $lastseason_start = mktime(0, 0, 0,$season*3-3+1,1,date('Y'));
            $lastseason_end   = mktime(23,59,59,$season*3,date('t',mktime(0, 0 , 0,$season*3,1,date("Y"))),date('Y'));
			$where .= ' and a.adddate>'.$lastseason_start.' and a.adddate<'.$lastseason_end;
		}
		//搜索
		$keyword = ChkSQL(KS_S('keyword'));
		$keytype = ChkClng(KS_S('keytype',1));
	    //判断是否输入关键字
		if(!empty($keyword)){
            if($keytype==1){$where.=" and b.username like '%$keyword%'";}
            elseif($keytype==2){$where.=" and c.name like '%$keyword%'";}
            elseif($keytype==3){$where.=" and b.mobile like '%$keyword%'";}
            elseif($keytype==4){$where.=" and a.memberip like '%$keyword%'";}
		}

		$adddate              = null !==GF('adddate') ? GF('adddate'):'0';
     	if($adddate== 0){$px  = 'id desc';}
		elseif($adddate==1){$px = 'id asc';}

		$common_user   = M('common_user');
		$common_member   = M('common_user_member');
		$where         = "as a left join `$common_user->table` as b on a.memberid = b.userid left join ".$common_member->table." as c on a.memberid=c.userid $where";

		$options       = $db->getOptions('10',$where);//分页参数设置
		$page          = Page($options);
		$values        = $db->getPage($page,$px,$where,'b.username,b.mobile,b.money,a.*,c.name');

//   	$app_order_info       = M('app_order_info');//订单副表即订单课程部分
//		$paystatus            = ChkClng(KS_S('paystatus'),3);
//		$where                = '  where a.status=0 and a.wxid ='.$this->wxid;
//		if($paystatus == 0){$where .= ' and a.paystatus=0';}
//		elseif($paystatus == 1){$where .= ' and a.paystatus=1';}//搜索
//		$keyword = ChkSQL(KS_S('keyword'));
//		$keytype = ChkClng(KS_S('keytype',1));
//	    //判断是否输入关键字
//		if(!empty($keyword)){
//		     if($keytype==1){$where.=" and a.memberid like '%$keyword%'";}
//		     elseif($keytype==2){$where.=" and b.username like '%$keyword%'";}
//		     elseif($keytype==3){$where.=" and b.mobile like '%$keyword%'";}
//		     elseif($keytype==4){$where.=" and a.memberip like '%$keyword%'";}
//		}
//		$common_user   = M('common_user');
//		$where         = "as a left join `$common_user->table` as b on a.memberid = b.userid $where";
//		$options       = $app_order_info->getOptions('10',$where);//分页参数设置
//		$page          = Page($options);
//		$values        = $app_order_info->getPage($page,'adddate desc',$where,'b.username,b.mobile,a.*');
        include  CURR_VIEW_PATH . "Capital/home.paylog.php";
     }
     //代金券消费明细
     public function voucherbillAction(){
		$common_voucher_log   = M('common_voucher_log');//订单副表即订单课程部分
		$type                 = ChkClng(KS_S('type'));
		$where                = '  where a.status=0 and a.wxid ='.$this->wxid;
		if($type == 0){$where .= ' and a.type=0';}
		elseif($type == 1){$where .= ' and a.type=1';}
		//搜索
		$keyword = ChkSQL(KS_S('keyword'));
		$keytype = ChkClng(KS_S('keytype',1));
	    //判断是否输入关键字
		if(!empty($keyword)){
		     if($keytype==1){$where.=" and a.memberid like '%$keyword%'";}
		     elseif($keytype==2){$where.=" and b.username like '%$keyword%'";}
		     elseif($keytype==3){$where.=" and b.mobile like '%$keyword%'";}
		     elseif($keytype==4){$where.=" and a.memberip like '%$keyword%'";}
		}
		$common_user   = M('common_user');
		$where         = "as a left join `$common_user->table` as b on a.userid = b.userid $where";
		$options       = $common_voucher_log->getOptions('10',$where);//分页参数设置
		$page          = Page($options);
		$values        = $common_voucher_log->getPage($page,'id desc',$where,'b.username,b.mobile,a.*');
        include  CURR_VIEW_PATH . "Capital/voucher_bill.php";
     }
     public function packagebillAction(){
		$domain_billing   = M('common_domain_billing');//网校拥有套餐情况
		$where            = '  where wxid ='.$this->wxid;
		$options          = $domain_billing->getOptions('10',$where);//分页参数设置
		$page             = Page($options);
		$values           = $domain_billing->getPage($page,'type desc',$where);
		$websiteinfo   = $this->cache->GetHCache('website',$this->wxid);//读出缓存
		$package       = $websiteinfo['package'];
        $versionname   = $this->cache->GetA('commonpackageversion','versionename',$package,'versionname');

        include  CURR_VIEW_PATH . "Capital/package_bill.php";
     }
     public function capitalbillAction(){
     	$wxinfo               = $this->cache->GetHCache('website',$this->wxid);//读出缓存
        $status               = $wxinfo['status'];
        $wxmoney              = $wxinfo['money'];//网校的总金额
        $withdrawmoney        = $wxinfo['withdrawmoney'];//网校的总金额

     	$adddate              = null !==GF('adddate') ? GF('adddate'):'0';
     	if($adddate== 0){$px  = 'id desc';}
		elseif($adddate==1){$px = 'id asc';}

     	$common_pay_log       = M('common_pay_log');//订单副表即订单课程部分
		$type                 = ChkClng(KS_S('type'));
		$where                = 'where a.status=0 and a.wxid ='.$this->wxid;
		if($type == 0){$where .= ' and a.type=0';}
		elseif($type == 1){$where .= ' and a.type=1';}
		//搜索
		$keyword = ChkSQL(KS_S('keyword'));
		$keytype = ChkClng(KS_S('keytype',1));
	    //判断是否输入关键字
		if(!empty($keyword)){
		     if($keytype==1){$where.=" and a.memberid like '%$keyword%'";}
		     elseif($keytype==2){$where.=" and b.username like '%$keyword%'";}
		     elseif($keytype==3){$where.=" and b.mobile like '%$keyword%'";}
		     elseif($keytype==4){$where.=" and a.memberip like '%$keyword%'";}
		}

		//
		$option               = null !==GF('option') ? GF('option'):'1';
		if($option==1){
			$month_start=mktime(0, 0 , 0,date("m"),1,date("Y"));
			$where .= ' and a.adddate>'.$month_start;
		}elseif($option==2){
			$lastmonth_start=mktime(0,0,0,date('m')-1,1,date('Y'));
			$lastmonth_end=mktime(0,0,0,date('m'),1,date('Y'))-24*3600;
			$where .= ' and a.adddate>'.$lastmonth_start.' and a.adddate<'.$lastmonth_end;
		}elseif($option==3){
			$season        = ceil((date('n'))/3);//当月是第几季度
            $season_start  = mktime(0, 0, 0,$season*3-3+1,1,date('Y'));
            //$season_end    = mktime(23,59,59,$season*3,date('t',mktime(0, 0 , 0,$season*3,1,date("Y"))),date('Y'));
            $where .= ' and a.adddate>'.$season_start;
		}elseif($option==4){
			$season           = ceil((date('n'))/3)-1;//上季度是第几季度
            $lastseason_start = mktime(0, 0, 0,$season*3-3+1,1,date('Y'));
            $lastseason_end   = mktime(23,59,59,$season*3,date('t',mktime(0, 0 , 0,$season*3,1,date("Y"))),date('Y'));
			$where .= ' and a.adddate>'.$lastseason_start.' and a.adddate<'.$lastseason_end;
		}
		$common_user   = M('common_user');
		$where         = "as a left join `$common_user->table` as b on a.userid = b.userid $where";
		$options       = $common_pay_log->getOptions('10',$where);//分页参数设置
		$page          = Page($options);
		$values        = $common_pay_log->getPage($page,$px,$where,'b.username,b.mobile,a.*');
        include  CURR_VIEW_PATH . "Capital/capital_bill.php";
     }



     //查看提现凭证
     public function certificateAction(){
     	$id                    = ChkClng(KS_G('request.id'));
		$now_page              = ChkClng(KS_S('p',1));
		$common_withdraw_log   = M('common_withdraw_log');//提现部分
		$defaultpic            = $common_withdraw_log->getOne('defaultpic','where id='.$id);
     	include  CURR_VIEW_PATH . "Capital/certificate.php";
     }
     public function delwithdrawAction(){
		$common_withdraw_log   = M('common_withdraw_log');//提现部分
		$id                    = ChkClng(KS_G('request.id'));
		$now_page              = ChkClng(KS_S('p',1));
		$this->AppModel->delete("wxid=$this->wxid and id = $id");
		$url                   = M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
		ks_header($url);
     }


     /**
      * 充值
      */
     public function rechargemoneyAction(){
     	$orderid                 = ChkClng(KS_G('get.id'));
		if(!empty($orderid)){
			$common_order        = M('common_order');
			$orderinfo           = $common_order->getRow('where orderid='.$orderid,'ordersn,order_amount,paytype');
			$Data['ordersn']     = $orderinfo['ordersn'];
			$rechargemoney       = $orderinfo['order_amount'];
			$payid               = $orderinfo['paytype'];
		}else{
			$payid               = ChkClng(KS_G('post.payid'));
			$rechargemoney       = ChkSQL(KS_G('post.rechargemoney'));
			if($rechargemoney<10){
                KS_Alert('充值金额必须大于等于10元','error');
            }
	     	list($usec, $sec)    = explode(" ", microtime());
			$Data['ordersn']     = $this->userid.((float)$usec + (float)$sec)*10000;
			$shopModel           = M('common_order');
		    $Data['userid']      = $this->userid;
		    $Data['wxid']        = $this->wxid;
		    $Data['userip']      = $_SERVER['SERVER_ADDR'];
		    $Data['type']        = 4;
		    $Data['paytype']     = $payid;
		    $Data['order_amount']= $rechargemoney;
		    $Data['adddate']     = time();
		    $Data['paystatus']   = 0;
		    $orderid             = $shopModel->doAdd($Data,'orderid');
		    //订单详情
		    $order_apps          = M('common_order_info');
		    $Datas['wxid']       = $this->wxid;
		    $Datas['appid']      = 0;
		    $Datas['appname']    = '充值余额'.$rechargemoney;
		    $Datas['price']      = $rechargemoney;
		    $Datas['defaultpic'] = '/Images/images/201707/14994809769188.png';
		    $Datas['orderid']    = $orderid;
			$order_apps->doAdd($Datas,'id');//添加单个app信息
		}
     	$Kspay               = new \Core\Kspay(array('payid' => $payid));
     	$websiteinfo         = $this->cache->GetHCache('website',$this->wxid);//读出缓存
     	$Kspay->subject      = $websiteinfo['sitename'].'在线充值';
		$Kspay->out_trade_no = $Data['ordersn'];
		$Kspay->total_fee    = $rechargemoney;
		if($payid==2){
			$Kspay->notify_url   = MY_FULLDOMAIN.'/home.html/default/Payback/rechargeback';
			$url2 = $Kspay->pay();$type = 5;
			include  ROOT . "Plus/native.php";
		}else{
			$Kspay->notify_url   = MY_FULLDOMAIN.'/home.html/default/Payback/rechargeback';
			$Kspay->return_url   = M_URL('Payback','rechargeback');
			$Kspay->pay();
		}
    }

}