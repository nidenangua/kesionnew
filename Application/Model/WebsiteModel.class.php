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
class WebsiteModel extends Model{
	//信息是否已经存在
	public function isuser($wxid){
		$sql = "select userid from $this->table where wxid = $wxid limit 1";
        $user = $GLOBALS['db']->getRow($sql);
		return $user;
	}
	//获取基本信息
	public function getWebsite($wxid){
		$sql = "select * from $this->table where wxid = $wxid limit 1";
        $user = $GLOBALS['db']->getRow($sql);
		return $user;
	}
	//获取 二级域名信息
	public function getdomain($wxid){
		$sql = "select domain,domainbind from $this->table where wxid = $wxid limit 1";
        $domain = $GLOBALS['db']->getRow($sql);
		return $domain;
	}	
	//信息添加
	public function websiteAdd($Data){
	    $userid=$GLOBALS['db']->insert($this->table,$Data);
	}
	//判断网站名称是否重复
	public function checkSitename($sitename){
		$sql = "select sitename from $this->table where sitename = '$sitename'";
        $result = $GLOBALS['db']->getOne($sql);
		if(empty($result)){
			  echo '{"result_code":"OK","result_desc":"可用"}';
        }else{
           echo '{"result_code":"ERROR","result_desc":"不可用"}';
        }
    }
    //对模型表对应的进行创表操作
	public function doCreateTable($wxid){
		$sql = "CREATE TABLE `ks_app_images_$wxid` (
				  `id` bigint(16) NOT NULL,
				  `images` varchar(10) NOT NULL,
				  `imgurl` varchar(255) NOT NULL,
				  `type` tinyint(4) NOT NULL,
				  PRIMARY KEY (`id`)
				) ENGINE=MyISAM DEFAULT CHARSET=gbk;";
		$result = $GLOBALS['db']->execSql($sql);
        return $result;
    }
}