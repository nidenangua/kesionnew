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


    /**
     * 支付配置页的批量操作(第一步）
     */
    public function wechatserviceAction(){
        $type    = KS_S('type','wx');
        $do      = KS_S('do');

        if ($do=="rebind"){   //之前配置过，要重新绑定支付账号
            $db = M('app_weixin_payconfig');
            $db->delete('wxid='.$this->wxid);
            $db = M('app_pay_content');
            $db->delete('wxid='.$this->wxid." and payename='wxpay'");
        }


        if($type=='wx'){
            $app_wechat_config = M('app_weixin_payconfig');
            $weixinstatus = $app_wechat_config->getRow('where wxid='.$this->wxid);
            $payname = 'wxpay';
        }else{
            $payname = 'alipay';
        }

        $payconfig =  M('app_pay_content')->getRow('where wxid='.$this->wxid.' and payename="'.$payname.'"');
        if(empty($payconfig)){
		    $payconfig['radios']    = '||||||||||';
            if($payname=='alipay'){
                $payconfig['content']   = '支付编号（MchId）|$||$|支付编号(在线支付平台申请的商户编号)|$|0$$$合作者身份(pid)|$|2088002171003062|$|如：2083320217100332|$|0$$$交易安全校验码（key）|$|8i5otje2eyci7y0bjrjk74fd6j76as67|$|如：ftonb3nu1t322311bistoog0|$|0$$$同步回调路径(return_back)|$|'.MY_FULLDOMAIN.'/Plus/KsPay/alipay/return_url.php|$||$|1$$$异步回调路径(notify_back)|$|'.MY_FULLDOMAIN.'/Plus/KsPay/alipay/notify_url.php|$||$|1$$$商户RSA私钥 |$||$|<br/>说明：<br/>1、启用APP支付功能时必须填写；<br/>2、PKCS8格式（参数需转换为一行，不能包含空格），<a href="https://cshall.alipay.com/enterprise/help_detail.htm?help_id=474010&amp;keyword=%C8%E7%BA%CE%C9%FA%B3%C9RSA%C3%DC%D4%BF&amp;sToken=&amp;from=search" target="_blank">如何生成RSA密钥</a>|$|1';
            }else{
                $payconfig['content']   = '商户号（MchId）|$||$|微信支付商户号|$|0$$$应用ID（AppId）|$|wx3d73fc4aef554bf3|$|在微信公众平台中 “开发者中心”栏目可以查看到|$|0$$$应用密钥（AppSecret）|$|7f05188af735d7fd9c28a09f4f2ac9e5|$|在微信公众平台中 “开发者中心”栏目可以查看到|$|0$$$ API密钥（PaySignKey）|$||$|在微信商户平台中“账户设置”--“账户安全”--“设置API密钥”，只能修改不能查看|$|1$$$支付通知页面（NotifyUrl）|$|'.MY_FULLDOMAIN.'/KS_cls/Kesion/Core/KsPay/wxpay/notify.php|$||$|1';
            }
        }
        if(!empty($payconfig)){
            $radios = explode("|",$payconfig['radios']);
        }else{
            $radios = array('2','2','0');
        }
        $PArr = explode('$$$',$payconfig['content']);
        foreach($PArr as $k=>$v){
            $v = explode('|$|',$v);
            $content[$k] = $v['1'];
        }
        if($type=='wx'){
            include  CURR_VIEW_PATH . "wechatservice.php";
        }else{
            include  CURR_VIEW_PATH . "alipayserve.php";
        }
    }
    //验证是否授权成功
    public function wechatyzAction(){
//        KSLog("wechatyzACTION");
        $type    = KS_S('type','wx');
        if($type=='wx'){
            $payname = 'wxpay';
        }else{
            $payname = 'alipay';
        }
        $wxradio = KS_G('post.wxradio');
        $wxradio1 = KS_G('post.wxradio1');
        $Data['radios'] = $wxradio.'|'.$wxradio1;
        M('app_pay_content')->update($Data,' wxid='.$this->wxid.' and payename="'.$payname.'"');
        $app_wechat_config = M('app_weixin_payconfig');
        $weixinstatus = $app_wechat_config->getRow('where wxid='.$this->wxid);
        if($weixinstatus){
            if($type=='wx'){
                $datass['open_pay'] = 1;
                M('app_weixin_payconfig')->update($datass,'wxid='.$weixinstatus['wxid']);
            }
            $this->cache->PutHCache('payconfig',$this->wxid);//写入缓存
            $this->cache->PutHCache('wxpayconfig',$this->wxid);//写入缓存
            echo 'true';
        }else{
            echo  'false';
        }
    }
    /**
     * 微信支付上传(业务域名验证）
     */
    public function imgloadAction(){
        $type    = KS_S('type','wx');
        if($type=='wx'){
            $payname = 'wxpay';
        }else{
            $payname = 'alipay';
        }
//		$cache  = new \Core\Cache();
        $upload            = new \Core\Upload();
        $upload->maxSize   = 31457280 ;// 设置附件上传大小
        $upload->exts      = array('txt');// 设置附件上传类型
        $upload->rootPath  = ROOT ; // 设置附件上传根目录
        $upload->uootPath  = UOOT ; // 设置附件保存链接根路径
        $upload->ruootPath = RUOOT; // 设置附件保存链接根路径
        if(!empty($_FILES['myfile']['tmp_name'])){
            $upload->savePath = '';
            $upload->subName  ='';
            $upload->saveName = strstr($_FILES['myfile']['name'],".txt",true);
            $upload->replace  = true;
            $info = $upload->uploadOne($_FILES['myfile']);
            if(!$info) {echo json_encode(array('result'=>'error','info'=>$upload->getError()));}// 上传错误提示错误信息
            else{
                echo json_encode(array('result'=>'succeed','info'=>ChkSQL($info['savename'])));
                $data['filename'] = ChkSQL($info['savename']);

                M('app_pay_content')->update($data,'wxid='.$this->wxid.' and payename="'.$payname.'"');
            }//应用封面图片
        }exit;
    }
    public function paysuccAction(){
        $Kspay                   = new \Core\Kspay();
        $result                  = $Kspay->alipay_return();
        if($result){
            $out_trade_no        = $_GET['out_trade_no']; //商户订单号
            $trade_no            = $_GET['trade_no'];     //支付宝交易号
            $trade_status        = $_GET['trade_status']; //交易状态

            $order_info          = M('app_order_info');
            $shopModel           = M('app_order');
            $orderinfo           = $shopModel->getRow("where ordersn='$out_trade_no' limit 1",'orderid,wxid,memberid,memberip,order_amount');
            $user                = M('common_user');
            $Data['paystatus']   = 1;
            $shopModel->update($Data,"ordersn='$out_trade_no' limit 1");
            $order_info->update($Data,"wxid=$orderinfo[wxid] and orderid=$orderinfo[orderid] limit 1");
            $shopModel->delete('userid=0 and memberid=0 and gift=1');
            $order_info->delete('userid=0 and memberid=0 and gift=1 and title="测试"');
            include  CURR_VIEW_PATH . "sccprompt.php";	exit;
        }
    }
    /**
     * 微信支付生成测试支付二维码
     */
    public function paycodeAction(){

        $type    = KS_S('type','wx');
        $MchId   = KS_G('request.MchId');

        $res = array();
        if(empty($MchId)){
            echo json_encode(array('msg'=>'sss'));exit;
        }
        if($type=='wx'){
            $AppSecret = KS_G('post.AppSecret');


           // KSLog('$MchId='.$MchId.'===secret=='.$AppSecret.'==='.$type);


            if(empty($AppSecret)){
                echo json_encode(array('msg'=>'sss'));exit;
            }
            $payename = 'wxpay';
            $payid = '2';
            $app_wechat_config = M('app_weixin_payconfig');

            $weixinstatus = $app_wechat_config->getRow('where wxid='.$this->wxid);
            $DataTwo['wxid']    = $this->wxid;
            $DataTwo['payname']   = '微信支付';
            $DataTwo['payename']  = 'wxpay';
            $DataTwo['content']   = '商户号（MchId）|$|'.$MchId.'|$|微信支付商户号|$|0$$$应用ID（AppId）|$|'.$weixinstatus['appid'].'|$|在微信公众平台中 “开发者中心”栏目可以查看到|$|0$$$应用密钥（AppSecret）|$|'.$AppSecret.'|$|在微信公众平台中 “开发者中心”栏目可以查看到|$|0$$$ API密钥（PaySignKey）|$|'.$AppSecret.'|$|在微信商户平台中“账户设置”--“账户安全”--“设置API密钥”，只能修改不能查看|$|1$$$支付通知页面（NotifyUrl）|$|'.MY_FULLDOMAIN.'/KS_cls/Kesion/Core/KsPay/wxpay/notify.php|$||$|1';
            $DataTwo['defaultpic']= '/Public/uploads/logo/201709/59af8e8b9f038.png';
            $DataTwo['applyurl']  = 'https://pay.weixin.qq.com/index.php/core/home/login?return_url=%2F';
            $DataTwo['Isdefault'] = 0;
            $DataTwo['intro']     = '简单快捷，有银行卡就可以支付';
            $DataTwo['issys']     = 1;
            $types = 2;
        }else{
            $PID = KS_G('request.PID');
            $key = KS_G('request.key');
            if(empty($PID) || empty($key) ){
                include  CURR_VIEW_PATH . "zfbprompt.php";	exit;
            }
            $payename = 'alipay';
            $payid = '1';
            $DataTwo['wxid']    = $this->wxid;
            $DataTwo['payname']   = '支付宝即时到账';
            $DataTwo['payename']  = 'alipay';
            $DataTwo['content']   = '支付编号（MchId）|$|'.$MchId.'|$|支付编号(在线支付平台申请的商户编号)|$|0$$$合作者身份(pid)|$|'.$PID.'|$|如：2083320217100332|$|0$$$交易安全校验码（key）|$|'.$key.'|$|如：ftonb3nu1t322311bistoog0|$|0$$$同步回调路径(return_back)|$|https://'.APP_DOMAIN.'/home.html/pay/Index/paysucc|$||$|1$$$异步回调路径(notify_back)|$|'.MY_FULLDOMAIN.'/Payback/KsPay/alipay/notify_url.php|$||$|1$$$商户RSA私钥 |$||$|<br/>说明：<br/>1、启用APP支付功能时必须填写；<br/>2、PKCS8格式（参数需转换为一行，不能包含空格），<a href="https://cshall.alipay.com/enterprise/help_detail.htm?help_id=474010&amp;keyword=%C8%E7%BA%CE%C9%FA%B3%C9RSA%C3%DC%D4%BF&amp;sToken=&amp;from=search" target="_blank">如何生成RSA密钥</a>|$|1';
            $DataTwo['defaultpic']= '/Public/uploads/logo/201709/59ae654bcb3ee.jpg';
            $DataTwo['applyurl']  = 'https://www.alipay.com/';
            $DataTwo['Isdefault'] = 1;
            $DataTwo['intro']     = '实时到账';
            $DataTwo['issys']     = 1;
            $types =1;
        }
        $PayModel  = M('app_pay_content');
        $info = $PayModel ->getRow('where wxid='.$this->wxid.' and payename="'.$payename.'"');
        if($info){
            $PayModel->update($DataTwo,'id='.$info['id']);
        }else{
            $info['id']=$PayModel->doAdd($DataTwo,'id');
        }
//        var_dump($info['id']);die;
        $this->cache->PutHCache('payconfig',$this->wxid);//写入缓存   app_pay_content
        $this->cache->PutHCache('wxpayconfig',$this->wxid);//写入缓存 app_weixin_payconfig
        $order = M('app_order');
        $orderinfo = M('app_order_info');
        $ordersn = KS_G('request.ordersn');
        if(empty($ordersn)){
            list($usec, $sec)  = explode(" ", microtime());
            $ordersn = $this->userid.((float)$usec + (float)$sec)*10000;
        }

        $Data['ordersn']   =$ordersn;
        $Data['wxid']      = $this->wxid;
        $Data['userid']    = 0;
        $Data['source']    = 0;
        $Data['paytype']   =$payid;
        $Data['memberid']  = 0;
        $Data['type']      = $types;
        $Data['order_amount'] = 0.01;
        $Data['original_amount'] = 0.01;
        $Data['memberip']  = $_SERVER['REMOTE_ADDR'];
        $Data['adddate']   = time();
        $Data['paystatus'] = 0;
        $orderid=$order->doAdd($Data,'orderid');//添加单个课程信息
        if($orderid){
            $Datas['wxid']       = $this->wxid;
            $Datas['userid']     = 0;
            $Datas['memberid']   = 0;
            $Datas['type']       = $types;
            $Datas['courseid']       = 0;
            $Datas['title']      = '测试';
            $Datas['price']      = 0.01;
            $Datas['sumprice']      = 0.01;
            $Datas['defaultpic'] = '';
            $Datas['ordersn']    = $Data['ordersn'];
            $Datas['orderid']    = $orderid;
            $Datas['adddate']    = time();
            $Datas['paystatus'] = 0;
            $res=$orderinfo->doAdd($Datas,'id');//添加单个课程信息
        }
        $domain = wx_Url($this->wxid);
        if (!$domain){
            $domain = MY_FULLDOMAIN; //官网域名
        }
        $Kspay               = new \Core\Kspay(array('cs'=>1,'payid' => $payid,'wxid'=>$this->wxid,'payename'=>$payename));
        $Kspay->out_trade_no = $Data['ordersn'];
        $Kspay->total_fee    = 0.01;
        $Kspay->payename     = 'wxpay';            //类型：生成微信支付二维码
        $Kspay->notify_url   = $domain.'/home.html/default/Payback/wxRechargeMoneyback';
//        var_dump($Kspay->notify_url);die;
        if($payid==2){
            $wxpay = $Kspay->pay();
            if($wxpay=='error'){
                $PayModel->delete('id='.$info['id']);
                $order->delete("ordersn='$Data[ordersn]'");
                $orderinfo->delete("ordersn='$Data[ordersn]'");
                echo json_encode(array('msg'=>'error'));exit;
            }else{
               // KSLog('kspay-pay==='. $wxpay);
                echo json_encode(array('msg'=>'good','url'=>UOOT.'Images/QRcode/'.createQRcode(ROOT.'Images/QRcode/',$wxpay,'L',4,'qrcode'),'ordersn'=>$Data['ordersn']));exit;
            }

        }else{
            $Kspay->return_url   = $domain.'/home.html/pay/Index/paysucc';
            $Kspay->pay();
        }
    }
    /**
     * ajax测试支付是否成功
     */
    public function rechargebackWAction(){
        $ordersn             = ChkClng(KS_G('request.ordersn'));

        $shopModel           = M('app_order');
        $paystatus           = $shopModel->getOne('paystatus',"where wxid=".$this->wxid." and ordersn='$ordersn' limit 1");
        if($paystatus==1){     //支付成功，删除测试订单
            $shopModel          = M('app_order');
            $shopModel2         = M('app_order_info');
            $shopModel->delete('userid=0 and memberid=0 and gift=1');
            $shopModel2->delete('userid=0 and memberid=0 and gift=1 and title="测试"');

            //更新配置表的状态为正常
            $paycontent         = M('app_pay_content');
            $data['status']     = 1;
            $data['isuse']      = 1;
            $paycontent->update($data,"wxid=".$this->wxid." and payename='wxpay'");
            $this->cache->PutHCache('payconfig',$this->wxid);//写入缓存   app_pay_content
            $this->cache->PutHCache('wxpayconfig',$this->wxid);//写入缓存 app_weixin_payconfig

            echo 'succeed';exit;
        }else{
            echo 'err'.$ordersn;exit;
        }
    }


    /*
   * 删除微信独立支付信息
   */
    public function delWxPayAction(){
        $pay_db = M('app_weixin_payconfig');
        $res = $pay_db->delete('wxid='.$this->wxid);
        if ($res){

            $app_pay_content = M('app_pay_content');
            $app_pay_content->delete('wxid='.$this->wxid." and payename='wxpay'");

            $setting         = $this->cache->GetH('apprelate','appid',$this->appid,'setting',$this->wxid);
            $setting         = explode('※',$setting);
            $setting[0]      = 0;
            $Data['setting'] = implode('※',$setting);
            $apprelateModel  = M('common_app_userrelate');
            $apprelateModel->update($Data,'wxid='.$this->wxid.' and appid = '.$this->appid);
            $this->cache->PutHCache('apprelate',$this->wxid);
            $this->cache->PutHCache('wxpayconfig',$this->wxid);//写入缓存
            echo 'succeed';exit;
        }else{
            echo 'error';exit;
        }
    }

}