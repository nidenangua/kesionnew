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
    public  function _initialize()
    {
    	header("Access-Control-Allow-Origin: *");
		$this->memberinfo    = User_GetUserInfo();
		$this->assign('memberinfo',$this->memberinfo);
		if($this->memberinfo  != null) {
		     $this->memberid = $this->memberinfo['userid'];
			 $this->parentid = $this->memberinfo['parentid'];
			 $this->assign('memberid',$this->memberid);
			 $result = $this->upload->getHead($this->memberid,4,5);
			 if($result){$memberhead = $result;}
			 else{$memberhead = '{$UOOT}Public/uploads/common/nopic.gif';}
			 $this->assign('memberhead',$memberhead);
		     $cartcourse = $this->cache->GetUCache('cartcourse',$this->memberid);
		     $this->assign('cartNum',count($cartcourse));
		} 
		//$GLOBALS['_DoM']['wxid'];//不要这样用，后面要删掉，直接用，不用再赋值了
		$this->assign('AppName',MODULE);
		$this->assign('appid',APPID);
		$this->AppModel = M('app_'.TABLENAME);   
	}
}