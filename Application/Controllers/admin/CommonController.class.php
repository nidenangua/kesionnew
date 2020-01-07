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
        if (null === getsession('admin')) {
            exit("<script>top.location.href='".M_URL('Login')."'</script>");
        }
		$this->admininfo = getsession('admin');
		$this->wxid      = ChkClng(KS_S('wxid'));
		
        $array = array('controller'=>CONTROLLER,'action'=>ACTION,'ruletype'=>$this->admininfo['admintype']);
        if (strtolower(CONTROLLER)==='index' && (strtolower(ACTION)==='index' || strtolower(ACTION)==='mainfirst')){  //总平台框架不检查权限

        }else{
            if(!checkrule($array)){
                KS_Alert('权限等级不足','error',KS_ComeUrl());
                echo '权限等级不足';exit;
            }
        }

    }
}