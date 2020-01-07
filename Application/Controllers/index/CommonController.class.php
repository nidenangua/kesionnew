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
class CommonController extends Controller
{
    public  function _initialize(){
		$this->memberinfo  = getsession('member');
		$this->assign('memberinfo',$this->memberinfo);
        if($this->memberinfo  != null) {
             $this->memberinfo    = User_GetUserInfo();
             if(empty($this->memberinfo)){
                   putsession('member',null);ks_header(M_URL());
             }
             $this->memberid = $this->memberinfo['userid'];
             $result = $this->upload->getHead($this->memberid,4,5);
             if($result){$memberhead = $result;}
             else{$memberhead = '{$UOOT}Public/uploads/common/nopic.gif';}
             $this->assign('avatar',$memberhead);
             $this->assign('memberhead',$memberhead);
             $this->assign('membername',empty($this->memberinfo['name'])?$this->memberinfo['username']:$this->memberinfo['name']);
             $cartcourse = $this->cache->GetUCache('cartcourse',$this->memberid);
             $this->assign('cartNum',count($cartcourse));
        } 
        $site = $this->cache->GetACache('setting');
        $this->assign('jshash',$site['jshash']);
        $this->assign('AppName','home');
    }
}