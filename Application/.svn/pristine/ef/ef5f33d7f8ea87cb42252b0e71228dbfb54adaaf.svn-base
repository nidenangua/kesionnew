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
class LoginController extends Controller
{
     /**
      * 总平台登录
      */
     public function indexAction(){
       if (null !== getsession('admin')) {
            exit("<script>top.location.href='".M_URL()."'</script>");
        }
	    include  CURR_VIEW_PATH . "admin.login.php";
     }
	 /**
     * 检查后台登录
	  */
	 public function checkLoginAction(){
		if (null !== getsession('admin')) {
            exit("<script>top.location.href='".M_URL()."'</script>");
        }
		$adminname  = ChkSQL(KS_G('post.adminname'));
		$password   = ChkSQL(KS_G('post.password'));
        $loginModel = M('common_admin');
		$admin = $loginModel->getRow("WHERE username='$adminname' limit 1");
		//var_dump(KS_MD5($password.KS_MD5($admin['rndpasswordc'])));exit;
		if(KS_MD5($password.KS_MD5($admin['rndpasswordc']))==$admin['password']){
			$lastlogintime = time();
			$lastloginip = $_SERVER['REMOTE_ADDR'];
			$GLOBALS['db']->execSql("UPDATE `$loginModel->table` SET `lastlogintime`='$lastlogintime', `lastloginip`='$lastloginip', `logintimes`=logintimes+1 WHERE username='$adminname'");
			putsession('admin',$admin);
			exit("<script>top.location.href='".M_URL()."'</script>");
		}else{
			KS_INFO('登录失败',0,'','',1);
	    }
     }
	/*
	 * 修改密码
	 */
	public function dochangePasswordAction()
	{
		$admin = getsession('admin');
		if (null == $admin) {
			exit("<script>top.location.href='".M_URL('Login')."'</script>");
		}
		$oldpassword = ChkSQL(KS_G('post.oldpassword'));
		$password = ChkSQL(KS_G('post.password'));
		$adminModel = M('common_admin');
		if(KS_MD5($oldpassword.KS_MD5($admin['rndpasswordc']))!=$admin['password']) KS_INFO('旧密码不正确',0,'','',1);
		if ($password==$oldpassword) KS_INFO('新密码不能跟旧密码相同',0,'','',1);
		if (mb_strlen($password)<6) KS_INFO('密码大于等于6位数',0,'','',1);
		$data['rndpasswordc'] = rand(10000,99999);
		$data['password'] = KS_MD5($password.KS_MD5($data['rndpasswordc']));
		$res = $adminModel->update($data,"adminid=$admin[adminid]");
		if ($res){
			putsession('admin',null);
			KS_INFO('修改成功',4,M_URL('Login'),'');
		}else{
			KS_INFO('修改失败',0,'','',1);
		}
	}
	/*
	* 修改密码
	*/
	public function changePasswordAction()
	{
		if (null == getsession('admin')) {
			exit("<script>top.location.href='".M_URL('Login')."'</script>");
		}
		include  CURR_VIEW_PATH . "admin.changePassword.php";
	}
     /**
     * 注销总平台登录
      */
     public function logoutAction()
     {
//   	session_start();
		putsession('admin',null);
        exit("<script>top.location.href='".M_URL('Login')."'</script>");
     }
    // public function flowSettlementAction(){
    //    $username         = ChkSQL(KS_G('get.username'));
    //    $password         = ChkSQL(KS_G('get.password'));
    //    if(KS_MD5($password.KS_MD5($username))=='5b4c8c2720853db96da0d37c62c89b4a'){
    //                set_time_limit(0);
    //                $billingModel     = M('common_domain_billing');
    //                $vodModel      = M('app_vod');
    //                $vodlistModel  = M('app_vod_list');
    //                $playLog       = M('common_pay_log');//余额
    //                $dateflowModel = M('app_dayflow');

    //                $vods = $vodModel -> getAll();
    //                $time = time();
    //                $site = $this->cache->GetACache('setting');//读出缓存
    //                foreach($vods as $k=>$v){

    //                    $countflow = 0;//需要结算流量
    //                    $allflow   = 0; //总流量
    //                    $playcount = 0; //播放次数

    //                    $Price = wx_version_itemvalue(12,$v['wxid']);

    //                    $vodlist   =  $vodlistModel->getAll('where wxid = '.$v['wxid']);
    //                    foreach($vodlist as $kt=>$vt){
    //                       if($vt['vdoService']==7){

    //                            try{
    //                                 $vod  = new Core\Baiduyun();
    //                                 $a         = $vod->updateDate($vt['vdoId']);
    //                                 $playcount+=$a->aggregate->peakPlayCount;
    //                                 $Data['flow'] = ($a->aggregate->downstreamInBytes)/1024/1024;
    //                            }catch(Exception $e) {
    //                                 $Data['flow'] = $vt['flow'];
    //                                 $playcount+=$vt['playCount'];
    //                            }
    //                             $flow         = round($Data['flow'],2);
    //                             $countflow+=($flow-(float)$vt['SettledFlow']);     //每个视频的总流量-已经结算的流量
    //                             $Data1['flow'] = $flow;
    //                             $Data1['SettledFlow'] = $flow;
    //                             $vodlistModel->update($Data1,'id = '.$vt['id']);//更新视频流量
    //                             $allflow= $allflow + $flow;

    //                        }else{


    //                           try{
    //                                   $vod  = new Core\Playvdo();
    //                                   $a    = $vod->VideoPlayStatisDetail($vt['vdoId']);
    //                                $arr = json_decode($a,true);
    //                                if(count($arr['VideoPlayStatisDetails']['VideoPlayStatisDetail']) !=0){
    //                                     $times=$arr['VideoPlayStatisDetails']['VideoPlayStatisDetail'][0]['PlayDuration'];

    //                                     $Data1['flow'] =round(($times/1000*900)/8/1024,2);
    //                                     $flow         = $Data1['flow'];
    //                                     $countflow+=$flow;//每个视频的总流量-已经结算的流量
    //                                     $Data1['flow'] = $vt['flow']+$flow;
    //                                     $Data1['SettledFlow'] = $vt['flow']+$flow;
    //                                     $vodlistModel->update($Data1,'id = '.$vt['id']);//更新视频流量
    //                                     $allflow= $allflow + $Data1['flow'];
    //                                 }

    //                           }catch(Exception $e) {}




    //                        }

    //                    }

    //                    $Data2['flow'] =  $allflow;
    //                    $Data2['SettledFlow'] =  $allflow;
    //                    $Data2['number'] = count($vodlist);
    //                    $vodModel ->update($Data2,'id = '.$v['id']);//更新主表流量统计
    //                    $Date3['userid']    = $v['userid'];
    //                    $Date3['wxid']      =  $v['wxid'];
    //                    $Date3['type']      = 1;
    //                    $Date3['flow']      =  $countflow;
    //                    $Date3['adddate']   = $time;
    //                    $Date3['countdate'] = date('Y-m-d H:i:s',$time);
    //                    $Date3['playcount'] = $playcount;
    //                    $dateflowModel -> doAdd($Date3,'id');//插入结算日常表
    //            }
    //            echo 'ok';exit;
    //    }
    //    echo 'err';exit;
    //}
}