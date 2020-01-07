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


namespace Kesion\Model\App;
use Kesion\Model;
class OrderModel extends Model{

    /**
     * 进行HOME端开课操作
     * @param mixed $CData
     */
	public function doOpenCourseOrder($CData){
        $id   = ChkClng($CData['courseid']);
        $type = ChkClng(isset($CData['type'])?$CData['type']:0);  //开通类型 0课程 1直播 7专栏  10社群
        $wxid = $CData['wxid'];
        $userid=$CData['userid'];
        $order_amount=ChkFloat($CData['order_amount']);   //订单价格



        $order      = M('app_order');
        $orderinfo  = M('app_order_info');                                //订单副表

        if ($orderinfo->Exists('where status!=-1 and wxid='.$wxid.' and memberid='.$userid.' and paystatus=1 and type='.$type.' and courseid='.$id)){
            if (isset($CData['isbatchopen'])) {

            }else {
                KS_Alert('对不起，学员' . User_GetUserName($userid) . '已开通过该类型的课程，不需要再开通！', 'error');
            }
            return;
        }

        //检查开能人数限制
        $maxOrderNum=wx_version_itemvalue(23,$wxid);   //得到当前套餐版本可以开通付费学员人次；
        $hasOrderNum=$order->getOne('count(1)','where wxid='.$wxid.' and paytype=0 and paystatus=1');    //查找已通过线下开通的人数
        if ($hasOrderNum>=$maxOrderNum){
            KS_Alert('对不起，您当前版本，最多只能后台开通学员'.$maxOrderNum.'人数，建议及时升级到更高级的版本套餐！','error','/home.html/default/Service/upgrade');
            return;
        }


        if($type==0){      //0 点播，语音，图文、音频
            $AppModel = M('app_course');
            $classinfo = $AppModel->getRow('where courseid='.$id,'courseid,title,price,defaultpic,commission,price_market');

        }elseif($type==1 || $type==6){//1 购买直播
            $AppModel = M('app_class');
            $classinfo = $AppModel->getRow('where classid='.$id,'title,price,defaultpic,commission,price_market');
        }elseif($type==3){//5 试卷
            $AppModel = M('app_paper');
            $classinfo = $AppModel->getRow('where paperid='.$id,'Title as title,price,defaultpic,price_market');
        }elseif($type==7){//7专栏
            $AppModel = M('app_column');
            $classinfo = $AppModel->getRow('where columnid='.$id,'title,price,defaultpic,commission,price_market');

        }elseif($type==9){ //会员（VIP)购买
            $AppModel = M('common_user_group');
            $classinfo = $AppModel->getRow('where id='.$id,'name as title,price,defaultpic,price_market');
        }elseif ($type==10){//加入社群
            $AppModel = M('app_team');
            $classinfo = $AppModel->getRow('where id='.$id,'title,price,defaultpic,is_vip');
            $classinfo['price_market']=$classinfo['price'];
        }

        list($usec, $sec)  = explode(" ", microtime());
        $Data['ordersn']   = $userid.((float)$usec + (float)$sec)*10000;
        $Data['wxid']      = $wxid;
        $Data['userid']    = $userid;        //下单人（付款人userID）
        $Data['source']    = 0;    //订单来源 1用户自行购买 0 后台HOME端开通
        $Data['paytype']   = 0;    //支付方式 0线下付款  1支付宝 2 微信 100 优惠或抵扣后0元购
        $Data['gift']      = 1;    //是否为礼物订单 1不是 2是
        $Data['memberid']  = $userid;


        $Data['type']      = $type;   //课程类型
        $Data['order_amount']    = $order_amount;       //后台开通，实际支付金额(未扣手续费)
        $Data['original_amount'] = $classinfo['price'];        //原价
        $Data['memberip']  = $_SERVER['REMOTE_ADDR'];
        $Data['adddate']   = time();
        $Data['paystatus'] = 0;

        $orderid=$order->doAdd($Data,'orderid');//添加订单主表

        if($orderid){                           //添加到订单子表
            $Datas['ordersn']    = $Data['ordersn'];
            $Datas['orderid']    = $orderid;
            $Datas['gift']       = 1;
            $Datas['wxid']       = $wxid;
            $Datas['userid']     = $userid;               //下单人（付款人userID）
            $Datas['paytype']    = 0;                 //支付方式 0线下付款  1支付宝 2 微信 100 优惠或抵扣后0元购
            $Datas['memberid']   = $userid;
            $Datas['type']       = $type;
            $Datas['courseid']   = $id;
            $Datas['title']      = ChkSQL($classinfo['title']);
            $Datas['price']      = 0;                           //实际支付金额(单价)
            $Datas['sumprice']   = 0;                          //实际支付金额(总价)
            $Datas['market_price']= $classinfo['price'];     //市场价，划线价
            $Datas['defaultpic'] = $classinfo['defaultpic'];
            $Datas['adddate']    = time();
            $Datas['numb']       = 1;
            $Datas['paystatus'] = 0;

            $res=$orderinfo->doAdd($Datas,'id');//添加单个课程信息

            $PayModel  = M('Application/PayModel');
            $PayModel->storeOrderProcess($Datas['ordersn'],100);  //调用逻辑处理

        }
		
        
    }
}