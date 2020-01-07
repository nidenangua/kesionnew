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
class WxmpController extends CommonController
{
    public function indexAction()
    {
        $userid  = null !==GF('userid') ? GF('userid'):'0';
        $common_weixin_config = M('common_weixin_config');
        $value =  $common_weixin_config->getRow("where userid=$userid");
        include CURR_VIEW_PATH . "weixin_config.php";
    }
    public function  doconfigAction()
    {
        if(isset($admin)){$Data['userid']='0';}
        $Data['status']         = ChkSQL(KS_G("post.status"));
        $Data['weixintype']     = ChkSQL(KS_G('post.weixintype'));
        $Data['weixinname']     = ChkSQL(KS_G('post.weixinname'));
        $Data['weixinid']       = ChkSQL(KS_G('post.weixinid'));
        $Data['appid']          = ChkSQL(KS_G('post.appid'));
        $Data['appsecret']      = ChkSQL(KS_G('post.appsecret'));
        $Data['encodingaeskey'] = ChkSQL(KS_G('POST.encodingaeskey'));
        $Data['weixinstatus']   = ChkSQL(KS_G('POST.weixinstatus'));
        $Rule['weixintype']     = '公众号类型|isEmpty';
        $Rule['weixinname']     = '公众号名称|isEmpty';
        $Rule['weixinid']       = '公众号原始ID|isEmpty';
        $Rule['appid']          = 'APPID|isEmpty';
        $Rule['appsecret']      = 'APPSecret|isEmpty';
        $Rule['access_token']   = 'Access_Token|isEmpty';
        $Rule['encodingaeskey'] = 'EncodingAESKey|isEmpty';
        $Rule['weixinstatus']   = '认证情况|isEmpty';
        $weixinid               = $Data['weixinid'];
        $adminModel = new  AdminModel('common_weixin_config');
        Chkpost($Data,$Rule,$adminModel);
        if($adminModel->getRow("where weixinid=$weixinid limit 1")){KS_INFO("不能重复使用同一个公众号");}
        $result  = $adminModel->doAdd($Data, 'id');
        if (null !== $result) {
            $url = M_URL('Wxmp','index');
            KS_INFO('配置成功',0,$url);
        } elseif(null==$result) {KS_INFO('配置失败');}
    }
    public function  docloseAction(){
        $userid = null !==GF('userid') ? GF('userid'):'0';
        $Data['status'] = 0;
        $common_weixin_config = M('common_weixin_config');
        $result=$common_weixin_config->update("where userid=$userid");
        if($result!=null){KS_INFO("修改成功");}
    }
    public function  fans_listAction(){
        $sex   = null !==GF('sex') ? GF('sex'):'3';
        $where = '';
        if($sex!=3){$where = 'where sex='.$sex;}
        $adminModel = M('common_weixin_user');
        $options    = $adminModel->getOptions('10',$where);
        $page       = Page($options);
        $user       = $adminModel->getPage($page,'id asc',$where);
        include  CURR_VIEW_PATH . "fans_list.php";
    }
    //获取用户的acces_token（用户id）
    public  function  get_token($userid)
    {
        $weixinModel = M('common_weixin_config');
        $info        = $weixinModel->getRow("where userid=$userid");
        $yxq=$info['token_yxq'];
        if(time()-$yxq>0) {
            $Data['access_token'] = get_token($info['appid'], $info['appsecret']);
            $Data['token_yxq'] = time() + 7200;
            $weixinModel->update($Data, "userid=$userid");
        }
        $access_token=$weixinModel->getOne('access_token',"where userid=$userid");
        return $access_token;
    }
    //获取粉丝列表（access_token,用户id）
    public  function get_fans_list($access_token,$userid)
    {
            $fansModel=M('common_weixin_user');
            $res=$fansModel->delete("userid=$userid");
            $fans_list=get_openid($access_token);
        if(($fans_list['total']-$fans_list['next_openid'])>=1000){
            array_push($fans_list,get_openid($access_token,$fans_list['next_openid']));
        }else {
            $user = $fans_list['data']['openid'];

            foreach($user as $k => $v) {
                $info = get_fans_info($access_token, $user[$k]);
                $Data['userid'] = $userid;
                $Data['openid'] = $info['openid'];
                $Data['subscribe'] = $info['subscribe'];
                $Data['nickname'] = $info['nickname'];
                $Data['sex'] = $info['sex'];
                $Data['city'] = $info['city'];
                $Data['country'] = $info['country'];
                $Data['headimgurl'] = $info['headimgurl'];
                $Data['province'] = $info['province'];
                $Data['language'] = $info['language'];
                $Data['subscribe_time'] = $info['subscribe_time'];
                $Data['groupid'] = $info['groupid'];
                $result = $fansModel->doAdd($Data, 'id');
            }
        }
        return $result;
    }
    public function get_fansAction()
    {
        $admin=$this->admininfo;
        if(($admin['username'])=='admin'){$userid=0;}

//        $adminModel = new  AdminModel('common_weixin_config');
//        $info=$adminModel->getRow("where userid=$userid");
//        $yxq=$info['token_yxq'];
//        if(time()-$yxq>0) {
//            $Data['access_token'] = get_token($info['appid'], $info['appsecret']);
//            $Data['token_yxq'] = time() + 7200;
//            $adminModel->update($Data, "userid=$userid");
//        }
//        $access_token=$adminModel->getOne('access_token',"where userid=$userid");
//        $fans_info=array();
//        $fansModel=M('common_weixin_user');
//
//        $res=$fansModel->delete("userid=$userid");
        $access_token=$this->get_token($userid);
		var_dump($access_token);
        $res=$this->get_fans_list($access_token,$userid);
        if($res){
            $url=M_URL('Wxmp','fans_list');
            ks_header($url);
        }

//        $fans_list=get_openid($access_token);
//
//        if(($fans_list['total']-$fans_list['next_openid'])>=1000){
//            array_push($fans_list,get_openid($access_token,$fans_list['next_openid']));
//        }else{
//            $user=$fans_list['data']['openid'];
//            foreach($user as $k  => $v ){
//                $info=get_fans_info($access_token,$user[$k]);
//                $Data['userid']=$userid;
//                $Data['openid']=$info['openid'];
//                $Data['subscribe']=$info['subscribe'];
//                $Data['nickname']=$info['nickname'];
//                $Data['sex']=$info['sex'];
//                $Data['city']=$info['city'];
//                $Data['country']=$info['country'];
//                $Data['headimgurl']=$info['headimgurl'];
//                $Data['province']=$info['province'];
//                $Data['language']=$info['language'];
//                $Data['subscribe_time']=$info['subscribe_time'];
//                $Data['groupid']=$info['groupid'];
//                $result=$fansModel->doAdd($Data,'id');
//            }
//        }
    }
   /* public  function msg_replyAction()
    {
        include  CURR_VIEW_PATH."msg_set.php";
    }*/
    public function attention_reply()
    { $admin=$this->admininfo;
        if(($admin['username'])=='admin'){
            $userid=0;
        }
        $access_token = $this->get_token($userid);
    }
    public function material_listAction()
    {
        include  CURR_VIEW_PATH."material_list.php";
    }
    public  function   add_materialAction(){
		$token = $this->get_token('0');
		//var_dump($token);exit;
		//获得QQ access_token登录令牌
		$data = array(
		  'filename'    => '@https://my.user.kesion.com/Public/admin/images/logo.png',
		  'content-type'=> 'image/png',  //文件类型
		  'filelength'  => '11011'         //图文大小
		);
		$url    = 'https://api.weixin.qq.com/cgi-bin/material/add_material?access_token='.$token.'&type=image';
		$result = curlPost($url,$data);
	}
}