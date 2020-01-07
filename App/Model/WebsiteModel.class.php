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
class WebsiteModel extends Model{
	//信息是否已经存在
	public function isuser($id){
		$sql = "select userid from $this->table where userid = $id limit 1";
        $user = $GLOBALS['db']->getRow($sql);
		return $user;
	}
	//获取基本信息
	public function getWebsite($id){
		$sql = "select * from $this->table where userid = $id limit 1";
        $user = $GLOBALS['db']->getRow($sql);
		return $user;
	}
	//获取 二级域名信息
	public function getdomain($id){
		$sql = "select domain,domainbind from $this->table where userid = $id limit 1";
        $domain = $GLOBALS['db']->getRow($sql);
		return $domain;
	}	
	//信息添加
	public function websiteAdd($Data){
	    $userid = $GLOBALS['db']->insert($this->table,$Data);
	}
	//判断网站名称是否重复
	public function checkSitename($sitename){
		$sql    = "select sitename from $this->table where sitename = '$sitename'";
        $result = $GLOBALS['db']->getOne($sql);
		if(empty($result)){
			  echo '{"result_code":"OK","result_desc":"可用"}';
        }else{
           echo '{"result_code":"ERROR","result_desc":"不可用"}';
        }
    }
}