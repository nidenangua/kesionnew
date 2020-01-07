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



namespace Kesion\Model\Application;
use Kesion\Model;
class PayModel extends Model{


/**********************************************************************************购买APP应用  begin *******************************************************************/
    /**
     * home端的在线支付APP回调函数--微信支付&阿里支付 （订购服务）
     * @param mixed $Data006
     */
    public function getAppback($Data006){
    	$out_trade_no        = ChkSQL($Data006['out_trade_no']); //商户订单号
		$trade_no            = ChkSQL($Data006['trade_no']);     //支付宝交易号
		$trade_status        = $Data006['trade_status']; //交易状态
		$total_fee    	     = $Data006['total_fee'];    //交易金额
		$order    = M('common_order');
		$orderinfo    = $order->getRow("where ordersn='$out_trade_no' limit 1",'ordersn,orderid,userid,wxid,userip,order_amount,paystatus');
		if($orderinfo['paystatus']==0){
			$user_website   = M('common_user_website');
			$Datau['money'] = "money+$total_fee";
		    $user_website->update($Datau,"wxid=$orderinfo[wxid]",1);    //给店铺增加充值的金额

			$Money          = getWxinfo($orderinfo['wxid'],'money');    //得到店铺的可用余额

			/*******************************插入充值支付明细表 begin ****************************/
			$Datapl['userid']  = $orderinfo['userid'];
			$Datapl['wxid']    = $orderinfo['wxid'];
			$Datapl['adddate'] = time();
			$Datapl['cmoney']  = $total_fee;                 //充值金额
		    $Datapl['balance'] = $Money;                     //充值后余额
			$Datapl['type']    =  0;
			$Datapl['userip']  = $orderinfo['userip'];
			$Datapl['mark']    = '用户余额不充足，充值';
			$Datapl['linepaytype'] = $Data006['linepaytype'];
			$pay_log           = M('common_pay_log');
			$pay_log->doAdd($Datapl,'id');
            /*******************************插入充值支付明细表 end ****************************/

			$this->ServiceOrderProcess($orderinfo['ordersn'],$Data006['linepaytype']);      //订单处理


		}
    }

    /**
     * 订购服务支付成功逻辑处理（create by 自由的飞  at 2019-4-13)
     * @param mixed $ordersn           订单号
     * @param mixed $linepaytype      支付类型  0 余额支付 1支付宝支付 2微信支付
     */
    public function ServiceOrderProcess($ordersn,$linepaytype=0){
        if (empty($ordersn)){
            KS_Alert('无效订单号！');
        }
        $order    = M('common_order');
        $order_apps     = M('common_order_info');
        $orderinfo    = $order->getRow("where ordersn='$ordersn' limit 1",'orderid,userid,wxid,userip,order_amount,paystatus,taskreward');
        $appidall       = $order_apps->getAll("where orderid=$orderinfo[orderid]");

        if($orderinfo['paystatus']==0){

           if($orderinfo['taskreward']){
               $orderinfo['order_amount'] = $orderinfo['order_amount']-$orderinfo['taskreward'];//扣除掉抵扣的奖励金额
           }

           $Money  = getWxinfo($orderinfo['wxid'],'money');  //实时得到店铺的余额

           if ($orderinfo['order_amount']<0){
               KS_Alert('无效订单金额！');
           }

           if($Money>=$orderinfo['order_amount']){
               $user_website   = M('common_user_website');
               $Datau['money'] = "money-".$orderinfo['order_amount'];
               $user_website->update($Datau,"wxid=$orderinfo[wxid]",1);   //扣掉余额
               $Money          = getWxinfo($orderinfo['wxid'],'money');   //扣掉后，进一步实时得到店铺的余额
               $website = $user_website->getRow("where wxid=$orderinfo[wxid]");
               if ($orderinfo['order_amount']>0&&$website['salesmantype']==1&&!empty(ChkClng($website['salesman']))&&ChkClng(KS_G('post.is_sales',1))==1){
                   $Dataplt['salesman'] = $website['salesman'];
                   $res = getSalesincome($orderinfo['order_amount'],2);
                   $Dataplt['salesincome'] = $res['salesincome'];
                   $Dataplt['salescommission'] = $res['salescommission'];
               }
               /**************************插入支付明细表 begin *************************************************/
               $Dataplt['userid']  = $orderinfo['userid'];
               $Dataplt['wxid']    = $orderinfo['wxid'];
               $Dataplt['adddate'] = time();
               $Dataplt['cmoney']  = $orderinfo['order_amount'];  //扣除金额
               $Dataplt['balance'] = $Money;                      //扣除后店铺余额
               $Dataplt['type']    = 1;
               $Dataplt['userip']  = $orderinfo['userip'];
               $Dataplt['mark']    = '购买APP:'.$appidall['appname'].'，支付订单：'.$ordersn;
               $Dataplt['linepaytype'] = $linepaytype;
               $pay_log           = M('common_pay_log');
               $pay_log->doAdd($Dataplt,'id');
                /**************************插入支付明细表 end ***************************************************/

               /***************************app关联 处理 begin ***************************************************/
               $app_userrelate = M('common_app_userrelate');
               foreach($appidall as $k=>$v){
                   /************************************************执行开通对应的APP应用 begin**********************/
                   $expireDate=openStoreAPP($orderinfo['wxid'],$orderinfo['userid'],$v['appid'],$v['numb']);
                   /************************************************执行开通对应的APP应用 end**********************/
                   /*********************************购买运营版要增加相关的容量，流量等  begin************************/
                   if ($v['appid']==KS_C('V1_APPID') || $v['appid']==KS_C('V2_APPID') ||$v['appid']==KS_C('V3_APPID')){   //V1,V2,V3版本
                       // $websiteinfo             = $this->cache->GetHCache('website',$orderinfo['wxid']);//读出缓存
                       switch($v['appid']){
                           case KS_C('V1_APPID'):
                               $Datapack['package']     = 'v1';   //基础版
                               break;
                           case KS_C('V2_APPID'):
                               $Datapack['package']     = 'v2';    //高级版
                               break;
                           case KS_C('V3_APPID'):
                               $Datapack['package']     = 'v3';    //钻石版
                               break;
                       }
                       $Datapack['packendtime'] = $expireDate;         //设置过期时间等于APP的过期时间
                       $user_website            = M('common_user_website');
                       $user_school             = M('common_user_school');
                       $userid = $orderinfo['userid'];
                       if (empty($userid)) $userid = $user_website->getOne('userid','where wxid='.$orderinfo['wxid']);
                       $userinfo = User_GetUser($userid);
                       M('common_user')->update(['usertype'=>2],'userid='.$userid);
                       M('common_realname')->update(['usertype'=>2],'userid='.$userid);
                       if (!$user_school->Exists('where userid='.$userid)){
                           $school_data['userid'] = $userid;
                           $school_data['head'] = $userinfo['head'];
                           $user_school->doEfAdd($school_data);
                       }
                       $this->cache->PutHCache('realname',$orderinfo['wxid']);
                       User_GetUser($userid,true);//更新缓存
                       $user_website->update($Datapack,'wxid='.$orderinfo['wxid']);
                       $this->cache->PutHCache('website',$orderinfo['wxid']);
                       initialStoreService($orderinfo['wxid'],$v['appid']);   //赠送容量，流量等服务
                   }
                   /*********************************购买运营版要增加相关的容量，流量等  end************************/
               }
                /***************************app关联 处理 end *********************************************************/
               $this->cache->PutHCache('apprelate',$orderinfo['wxid']);
               $Data['paystatus'] = 1;
               $order->update($Data,"ordersn='$ordersn' limit 1");         //设置订单为支付成功
               $this->cache->PutHCache('website',$orderinfo['wxid']);
           }
       }
   }
    /**********************************************************************************购买APP应用  end *******************************************************************/


    
    /**
     * 店铺的微信支付成功处理（买课程，专栏等）
     * @param mixed $paytype   支付方式 0线下付款  1支付宝 2 微信 100优惠后0元购的情况
     * @param mixed $paymoney  在线支付的情况，实际支付的金额
     */
    function storeOrderProcess($ordersn,$paytype=2,$paymoney=0){
        $order            = M('app_order');
        $orderinfo        = $order->getRow("where ordersn='$ordersn' limit 1",'orderid,paystatus,wxid,userid,memberid,memberip,order_amount,userid,distribute_userid,distribute_commission,distribute_amount');
        if($orderinfo['paystatus']==0){
            $order_info               = M('app_order_info');
            $orderinfodetail          = $order_info->getRow("where ordersn='$ordersn' limit 1",'type,courseid,price,ordersn,title,paytype,groupid,json,gift');
            if (!empty($orderinfodetail['json'])) $orderinfodetail['json'] = json_decode($orderinfodetail['json'],true);
            if ($orderinfodetail){
              $Dataode['paystatus']        =  1;
              $Dataode['paydate']      = time();   //支付时间
          /********************************************************只要是线上支付了，就要扣除掉订单手续费用等 begin **************************************/
              if ($paytype==100){  //优惠后0元购买的情况
                 // $Dataode['order_amount']     =  0;//实收金额为0
                  $order->update($Dataode,"wxid=$orderinfo[wxid] and ordersn='$ordersn' limit 1");
                  $Dataod['paystatus']=1;
                  $order_info->update($Dataod,"wxid=$orderinfo[wxid] and ordersn='$ordersn' limit 1");
              }
              else  //不是优惠后0元购的情况
              {
                  $Dataode['order_amount']     =  $paymoney;                         //微信实际支付(未扣手续费)
                  $isVIP = checkIsVipVersion($orderinfo['wxid']);                    //是否VIP版本（注：vip版本免扣交易佣金,体验期也是免交易佣金）
                  $icomemoney = wx_WebSite_Field($orderinfo['wxid'],'icomemoney');   //店铺的总收入
                  $base       = $this->cache->GetACache('setting');                  //读出平台的基本信息设置缓存

                  /******************************************************分销 begin**********************************************/
                  $distribute_amount=0;    //本单佣金
                  if(ChkClng($orderinfo['distribute_userid'])>0){    //推广人的UserId
                      $distribute_amount = ($orderinfo['distribute_commission']*$paymoney*0.01*100)/100;  //本单佣金
//                      KSLog("distributemoney=".$distribute_amount);
                      if ($distribute_amount>0){
                          $Dataode['distribute_amount'] = $distribute_amount;    //分销的佣金，记录订单表
                          $member=M('common_user_member');
                          $withdraw['distributionMoney'] = 'distributionMoney+'.$distribute_amount;
                          $withdraw['withdraw']          = 'withdraw+'.$distribute_amount;
                          $member->update($withdraw,'userid='.ChkClng($orderinfo['distribute_userid']),1);
                      }
                  }
                  if ($distribute_amount>$paymoney) $distribute_amount=$paymoney;
                  /******************************************************分销  end**********************************************/
                  $website = $this->cache->GetHCache('website',$orderinfo['wxid']);//读出缓存


                  if ($isVIP&&$website['istry']!=1){                 //VIP版本免交易佣金 (有启用分销的情况，走的是平台的支付，要扣分销的佣金）
                      $Dataode['collection']       = 0;
                      $Dataode['poundage']         = 0;
                      if ($distribute_amount>0){
                          $Dataode['actual_amount']    =  $Dataode['order_amount']-$distribute_amount;//(扣完佣金的订单金额,VIP用户，主要扣分销等没有走平台的佣金）
                      }else{
                          $Dataode['actual_amount']    =  $Dataode['order_amount'];
                      }
                  }else{
                      $collection=0; //给平台的佣金比率
                      if($icomemoney<=$base['sumincome']&&$base['collection']>0){//大于指定金额扣分佣(且不是VIP)
                          $collection = $base['collection'];   //给平台的佣金百分比
                      }elseif($icomemoney>$base['sumincome']&&$icomemoney<=$base['sumincome1']&&$base['collection1']>0){//大于指定金额扣分佣(且不是VIP)
                          $collection = $base['collection1'];  //给平台的佣金百分比
                      }elseif($icomemoney>$base['sumincome2']&&$base['collection2']>0){//大于指定金额扣分佣(且不是VIP)
                          $collection = $base['collection2'];  //给平台的佣金百分比
                      }
                      $collection=$collection/100;
                      $Dataode['collection']       =  $collection;//给平台的佣金百分比

                      $Dataode['poundage']         =  $collection*$Dataode['order_amount'];//给平台的佣金
                      $Dataode['actual_amount']    =  $Dataode['order_amount']-$Dataode['poundage']-$distribute_amount;//扣完佣金的订单金额(普通用户扣平台服务费+如果有分销再扣分销佣金）
                      //有推广人并且是扶持版扣推广金
                      if ($orderinfo['order_amount']>0&&$website['salesmantype']==1&&!empty(ChkClng($website['salesman']))&&$website['istry']==1){
                          $Dataode['salesman'] = $website['salesman'];
                          $res = getSalesincome($Dataode['poundage'],1);
                          $Dataode['salesincome'] = $res['salesincome'];
                          $Dataode['salescommission'] = $res['salescommission'];
                          $Dataode['poundage'] = $Dataode['poundage']-$res['salesincome'];
                      }

                  }



                  $Dataod['paystatus']=1;
                  $order_info->update($Dataod,"wxid=$orderinfo[wxid] and ordersn='$ordersn' limit 1");
                  $Money                  = $orderinfodetail['price'];
                  $orderinfo['title']     = $orderinfodetail['title'];

                  $apnlog = M('Application/LogModel');
                  $orderinfo['linepaytype'] = 2;
                  $apnlog->memberlog($orderinfo,$Money,4);        //产生充值记录
                  $apnlog->memberpaylog($orderinfo,$Money,4);     //产生扣钱记录



//                $app_wechat_config = M('app_weixin_payconfig');
//                $config = $app_wechat_config->getRow('where wxid='.$orderinfo['wxid'].' and open_pay=1' );

                $istoplat = checkIsOpenOwnerPay($orderinfo['wxid']);   //是否开启独立支付 false到平台  true到机构账户
                if ($orderinfodetail['paytype']==3) $istoplat = false;//小程序支付直接到平台
                //if($istoplat && $Dataode['poundage']>0 && !empty($config) && empty($orderinfodetail['groupid'])){  //开启独立支付且订单不是拼团订单  需要给平台支付佣金
                //    $MyMoney["money"]=getWxinfo($orderinfo['wxid'],'money')-$Dataode['poundage'];
                //    $db=M("common_user_website");
                //    $db->update($MyMoney,"wxid=$orderinfo[wxid]");
                //    $db               = M('common_pay_log');
                //    $Dataplt['userid']      = $orderinfo['userid'];
                //    $Dataplt['wxid']        = $orderinfo['wxid'];
                //    $Dataplt['adddate']     = time();
                //    $Dataplt['cmoney']      = $Dataode['poundage'];
                //    $Dataplt['balance']     = $Money["money"];
                //    $Dataplt['type']        = 1;
                //    $Dataplt['userip']      = $_SERVER['REMOTE_ADDR'];
                //    $Dataplt['mark']       = '支付订单佣金';
                //    $db->doAdd($Dataplt,'id');
                //}

                if($istoplat){  //到机构的情况，无需加可提现金额
                    $Dataode['ispaytoplat'] = 1;//独立收款订单
                }else{
                    if(empty($orderinfodetail['groupid'])){//不是拼团订单时  直接加上
                        $Datawx['withdrawmoney'] = getWxinfo($orderinfo['wxid'],'withdrawmoney')+$Dataode['actual_amount']; //网校可提现金额(扣除提走的佣金)
                        $Datawx['withdrawsum']   = getWxinfo($orderinfo['wxid'],'withdrawsum')+$Dataode['actual_amount'];   //网校可提现金额(累计)
                    }

                }
                $order->update($Dataode,"wxid=$orderinfo[wxid] and ordersn='$ordersn' limit 1");

                  if(empty($orderinfodetail['groupid'])){//不是拼团订单时  直接加上
                    $Datawx['icomemoney']    = getWxinfo($orderinfo['wxid'],'icomemoney')+$Dataode['order_amount'];   //累计收入（未扣给平台的分佣）
                    $db           = M('common_user_website');
                    $db->update($Datawx,"wxid=$orderinfo[wxid]");
                }
                $this->cache->PutHCache('website',$orderinfo['wxid']);

                //if($orderinfodetail['type']==1){   //原来的公众号里活动推广，先屏掉
                //    $Data00009['wxid'] = $orderinfo['wxid'];
                //    $Data00009['taskid'] = 3;
                //    spreadaudit($Data00009);
                //}

              }
             /********************************************************只要是线上支付了，就要扣除掉订单手续费用等 end**************************************/

            /********************************************** 创建直播关联部分  begin *****************************************/
            if($orderinfodetail['type']==0 ||$orderinfodetail['type']==7||$orderinfodetail['type']==10){
                /********************************************** 插入到课程进度列表*****************************************/
                if ($orderinfodetail['gift']==1){
                    $rate_data['userid'] = $orderinfo['userid'];
                    $rate_data['wxid'] = $orderinfo['wxid'];
                    if ($orderinfodetail['paytype']==0){
                        $rate_data['paytype'] = 0;
                    }else{
                        $rate_data['paytype'] = 2;
                    }
                    $rate_data['createtime'] = time();
                    if ($orderinfodetail['type']==7 ||$orderinfodetail['type']==10){
                        $rate_data['type'] = $orderinfodetail['type'];
                    }else{
                        $app_course = M('app_course');
                        $course_data = $app_course->getRow('where courseid = '.$orderinfodetail['courseid'].'','courseType');
                        $rate_data['type'] = $course_data['courseType'];
                    }
                    $rate_data['courseid'] = $orderinfodetail['courseid'];

                    $rate_model = M('App/UsersModel');
                    $rate_model->addCourseList($rate_data['courseid'],$rate_data['type'],$rate_data['paytype'],$rate_data['userid'],$rate_data['wxid']);
                }
            }
            /********************************************** 创建直播关联部分  end *****************************************/


            /***********************************************社群支付成功 begin*********************************************/
            if ($orderinfodetail['type']==10){//加入社群
                $teamModel = new \Kesion\Model\App\TeamModel();
                $teamModel->addMember($orderinfodetail['courseid'],$orderinfo['memberid']);
            }
            if ($orderinfodetail['type']==0||$orderinfodetail['type']==1||$orderinfodetail['type']==7){//关联社群    0是课程 1是直播 7专栏
                $team_link_model = M('app_team_link');
                $where = "where infoid=$orderinfodetail[courseid] and wxid=$orderinfo[wxid]";
                if ($orderinfodetail['type']==0){
                    $where .= " and type in (1,3,4)";
                }elseif($orderinfodetail['type']==1){
                    $where .= " and type=2";
                }elseif($orderinfodetail['type']==7){
                    $where .= " and type=5";
                }
                $teamIdList = $team_link_model->getAll($where,'team_id');
                if (!empty($teamIdList)){
                    $teamModel = new \Kesion\Model\App\TeamModel();
                    foreach ($teamIdList as $k=>$v){
                        //							$isassociated = $team_model->getOne('isassociated',"where id=$v[team_id] and wxid=$orderinfo[wxid]");
                        $isassociated = $this->cache->GetH('team','id',$v['team_id'],'isassociated',$orderinfo['wxid']);
                        if (!empty($isassociated)||$isassociated==1){
                            $teamModel->addMember($v['team_id'],$orderinfo['memberid']);
                        }
                    }
                }
            }
            /*****************************************社群支付成功 end*********************************************/

            /*****************************************购买活动票 begin*********************************************/
            if ($orderinfodetail['type']==12){
                $signModel = M('app_course_sign');
                $signModel->update(['paystatus'=>1,'status'=>3],"wxid=$orderinfo[wxid] and userid=$orderinfo[userid] and id=".$orderinfodetail['json']['id']);

            }
            /*****************************************面授 begin*********************************************/
            if ($orderinfodetail['json']['faceteach'] == 1){
                $signModel = M('app_course_sign');
                $sign_data['courseid'] =$orderinfodetail['courseid'];
                $sign_data['coursetype'] =5;
                $sign_data['userid'] =$orderinfo['userid'];
                $sign_data['wxid'] =$orderinfodetail['wxid'];
                $sign_data['is_sign'] =0;
                $sign_data['paystatus'] =1;
                $sign_data['adddate'] =time();
                $sign_data['username'] =User_GetUser($orderinfo['userid'])['name'];
                $sign_data['mobile'] =User_GetUser($orderinfo['userid'])['mobile'];
                $signModel->doAdd($sign_data,'id');
            }
            /*****************************************面授 end*********************************************/
            /*****************************************助力活动 begin*********************************************/
            if ($orderinfodetail['json']['orderfrom'] == 108){
                $start_id = $orderinfodetail['json']['start_id'];
                $market_start = M('app_market_start');
                $start_data['is_buy'] = 1;
                $market_start->update($start_data,"id=$start_id");
            }
            /*****************************************助力活动 end*********************************************/
            /*****************************************微信模版消息通知 begin*********************************************/
            $Wechat = new \Core\Wechat($orderinfo['wxid']);
            $openid = M('common_user')->getOne('openid',"where userid=".$orderinfo['memberid']);
            if (!empty($openid)){
                if (empty($orderinfodetail['groupid'])){//非拼团订单
                    if ($orderinfodetail['type']==1){//直播订单
                        $model  = M('app_class_schedule');
                        $beginTime = $model->getOne('timeSlotStart',"where classid=".$orderinfodetail['courseid']);
                        $template_id = 'OPENTM408401052';
                        $data = [
                            'first'=>['value'=>'你成功报名课程','color'=>'#173177'],
                            'keyword1'=>['value'=>date('Y年m月d日 H点i分',$beginTime),'color'=>'#173177'],
                            'keyword2'=>['value'=>$orderinfodetail['title'],'color'=>'#173177'],
                            'keyword3'=>['value'=>wx_Domain_Field($orderinfo['wxid'],'domain'),'color'=>'#173177'],
                            'remark'=>['value'=>'请准时参加!','color'=>'#173177'],
                        ];
                        $url =  wx_Url($orderinfo['wxid']).'/#/user/course';
                        $Wechat->sendTemplateMessage($openid,$template_id,$url,$data);
                    }else{
                        $template_id = 'TM00015';//普通订单
                        $data = [
                            'first'=>['value'=>'恭喜您，成功购买，'.$orderinfodetail['title'],'color'=>'#173177'],
                            'orderMoneySum'=>['value'=>$orderinfodetail['price'],'color'=>'#173177'],
                            'orderProductName'=>['value'=>$orderinfodetail['title'],'color'=>'#173177'],
                            'Remark'=>['value'=>'请点此处查看订单详情','color'=>'#173177'],
                        ];
                        //$url =  'https://'.wx_Domain_Field($orderinfo['wxid'],'domain').'/h5market/myList';
                        $url =  wx_Url($orderinfo['wxid']).'/#/user/course';
                        $Wechat->sendTemplateMessage($openid,$template_id,$url,$data);
                    }
                }
            }
            /*****************************************微信模版通知 end*********************************************/
            if ($orderinfodetail['type'] ==15 || $orderinfodetail['type'] ==14){
                $order_mall = $order_info->getAll("where ordersn='$ordersn'",'courseid');
                $app_course = M('app_course');
                foreach ($order_mall as &$mall_item){
                    $stud['studentcount']  = 'studentcount+1';
                    $app_course->update($stud,'courseid='.$mall_item['courseid'],1);
                }
            }

            switch($orderinfodetail['type']){
                case 0:
                    $model = M('app_course');
                    $stud['studentcount']  = 'studentcount+1';
                    $model->update($stud,'courseid='.$orderinfodetail['courseid'],1);break;
                case 1:
                    $model = M('app_class');
                    $stud['studentnum']  = 'studentnum+1';
                    $model->update($stud,'classid='.$orderinfodetail['courseid'],1);break;
                case 5:
                    $model = M('app_paper');
                    $stud['studentcount']  = 'studentcount+1';
                    $model->update($stud,'paperid='.$orderinfodetail['courseid'],1);break;
                case 7:  //专栏
                    $model = M('app_column');
                    $stud['soldnum']  = 'soldnum+1';
                    $this->cache->PutUCache('havecolumn',$orderinfo['memberid']);
                    $model->update($stud,'columnid='.$orderinfodetail['courseid'],1);break;
                case 9:  //处理会员卡逻辑
                    User_addUserGroupBuy($orderinfodetail['courseid'],$orderinfo['memberid'],1,$orderinfo['wxid']);//调用myhan里的方法加入会员关联表
                    break;
                case 16:  //vip折扣卡 开通会员啦
                    User_vipBuy($orderinfodetail['courseid'],$orderinfo['memberid'],$orderinfo['wxid']);
                    break;
            }
            $dddd['enrollstatus'] = 1;   //报名状态，设置为已报名
            $member = M('common_user_member');
            $member->update($dddd,'userid='.$orderinfo['memberid']);


            $Dotask  = new \Core\Dotask();
            $Dotask->checkTask($orderinfo['wxid'],3);//检查是否完成任务
            $Dotask->checkTask($orderinfo['wxid'],6);//检查是否完成任务

            //$usersModel             = M('common_user');
            //$Datau['money']         = 0;
            //$usersModel->update($Datau,"userid=$orderinfo[memberid]");

            }

            $this->cache->PutUCache('haveconsumed',$orderinfo['memberid']);   //更新学员的已消费金额
            $this->cache->PutUCache('userorderinfo',$orderinfo['memberid']);   //更新学员的已购订单缓存

        }

    }



/*********************************************************************************************扩容服务 begin*************************************************************************/
    /**
     * 扩容服务的回调处理函数
     * @param mixed $ordersn      订单号
     * @param mixed $linepaytype   支付方式 0线下付款  1支付宝 2 微信 100优惠后0元购的情况
     */
    public function Serviceback($ordersn,$linepaytype=0){
        if (empty($ordersn)) return;

    	$order              = M('common_order');
		$orderinfo              = $order->getRow("where ordersn='".$ordersn."' limit 1",'orderid,wxid,type,userid,userip,order_amount,voucherid,vouchername,vouchermoney,paystatus');
		if($orderinfo['paystatus']==0){
			    $order_info             = M('common_order_info');
				$orderinfodetail        = $order_info->getRow("where ordersn='".$ordersn."' limit 1",'appid,numb,ordersn,starttime,endtime,appname');
				$serviceinfo            = $this->cache->GetA('service','serviceid',$orderinfodetail['appid'],'',true);
			    $numb                   = $orderinfodetail['numb'];
			    $serviceid              = $orderinfodetail['appid'];
			    //$servicemoney         = $orderinfo['numb']*wx_version_itemvalue($serviceinfo['seriesid']);
				//调用唤起传说中的model层
				$apnlog = M('Application/LogModel');

                $orderinfo['linepaytype']=$linepaytype;  //设置支付方式
				$apnlog->paylog($orderinfo,1,$orderinfodetail);//余额不够的情况，先充值，再扣钱
				$Dataod['paystatus']    =  1;
				$order->update($Dataod,"wxid=$orderinfo[wxid] and ordersn='".$ordersn."' limit 1");
				$order_info->update($Dataod,"wxid=$orderinfo[wxid] and ordersn='".$ordersn."' limit 1");

                //网校的服务费用的充值服务
                if($serviceinfo['seriesid']==11){
			    	serviceLivelog($orderinfo,$orderinfodetail);
			    	ServiceRecharge($numb,$serviceinfo['seriesid'],$orderinfo['wxid']);
			    }else{
			        ServiceRecharge($numb,$serviceinfo['seriesid'],$orderinfo['wxid']);
			    }


			    if(!empty($orderinfo['voucherid'])){
		            $voucher_log             =  M('common_voucher_log');
		            $voucherbalance          =  $this->cache->GetH('voucher','id',$orderinfo['voucherid'],'balance',$orderinfo['wxid']);//代金卷余额
				    $Dataplt['userid']       =  $orderinfo['userid'];
				    $Dataplt['wxid']         =  $orderinfo['wxid'];
				    $Dataplt['voucherid']    =  $orderinfo['voucherid'];
				    $Dataplt['vouchername']  =  $orderinfo['vouchername'];
				    $Dataplt['adddate']      =  time();
				    $Dataplt['cmoney']       =  $orderinfo['vouchermoney'];
				    $Dataplt['balance']      =  $voucherbalance-$orderinfo['vouchermoney'];
				    $Dataplt['type']         =  1;
				    $Dataplt['userip']       =  $_SERVER['REMOTE_ADDR'];
				    $Dataplt['mark']         =  '购买服务，代金券扣款'.$orderinfo['vouchermoney'].'元';
				    $voucher_log->doAdd($Dataplt,'id');
				    $common_voucher          =  M('common_voucher');
				    $Datau['balance']        =  $Dataplt['balance'];
			        $common_voucher->update($Datau,"wxid =".$orderinfo['wxid']." and id=".$orderinfo['voucherid']);
			        $this->cache->PutHCache('voucher',$orderinfo['wxid']);
		 	    }
				$this->cache->PutHCache('domainbilling',$orderinfo['wxid']);

		}

    }
    /*********************************************************************************************扩容服务 begin*************************************************************************/


    //home端的充值回调函数--微信支付&阿里支付
    public function rechargeback($Data003){
		$order_info          = M('common_order_info');
		$order           = M('common_order');
		$orderinfo           = $order->getRow("where ordersn='".$Data003['out_trade_no']."' limit 1",'orderid,wxid,userid,userip,order_amount,paystatus');
		if($orderinfo['paystatus']==0){
	        $Money               = getWxinfo($orderinfo['wxid'],'money');//网校的总提现金额
			//调用唤起传说中的model层
			$orderinfo['linepaytype'] = $Data003['linepaytype'] ;
			$apnlog = M('Application/LogModel');
			$apnlog->rechargelog($orderinfo,4);//网校用户直接为自己充值

			$Datau['money']      = $orderinfo['order_amount']+$Money;
			$user_website        = M('common_user_website');
			$user_website->update($Datau,"wxid=$orderinfo[wxid]");

			$Data['paystatus']   = 1;
			$order->update($Data,"ordersn='".$Data003['out_trade_no']."' limit 1");
			$order_info->update($Data,"wxid=$orderinfo[wxid] and orderid=$orderinfo[orderid] limit 1");
			$this->cache->PutHCache('website',$orderinfo['wxid']);
		}
    }





}