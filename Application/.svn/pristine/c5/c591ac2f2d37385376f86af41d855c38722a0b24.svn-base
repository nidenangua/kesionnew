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



use Kesion\Model;
class AppModel extends Model{
	//主键自增添加@$prikeyname主键名
	public function doAddapp($Data,$prikeyname){
		$prikeyname = ChkSQL($prikeyname);
		$Data[$prikeyname] = $GLOBALS['db']->getMaxValue($this->table,"$prikeyname")+1;
		if($Data[$prikeyname]<100)$Data[$prikeyname]=100;
		$GLOBALS['db']->insert($this->table,$Data);
        return $Data["$prikeyname"];
    }
	/*------------------------------------云服务分类配置表 查增改删-----------------------------------------------*/
	//select classid,classname,parentid,parentidpath,child,root,orderid,depth FROM KS_CLASS ORDER BY root,orderid
	//得到第一级应用分类
    public function getChild($parentid){
		$sql = "select * FROM $this->table where parentid=$parentid ORDER BY rootid,orderid";
        $appcategory = $GLOBALS['db']->getAll($sql);
        return $appcategory;
    }		
	//得到应用分类
	public function getAppcategory(){
		$sql = "select * FROM $this->table ORDER BY rootid,orderid";
        $appcategory = $GLOBALS['db']->getAll($sql);
        return $appcategory;
    }
    //得到分类的孩子
	public function getAppcategoryChild($parentid){
		$sql="select * from $this->table where parentid=".$parentid;
		$category_child=$GLOBALS['db']->getAll($sql);
		return $category_child;
    }
	public function doaddAppcategory($Data,$prikeyname){
		$prikeyname = ChkSQL($prikeyname);
		$Data["$prikeyname"] = $GLOBALS['db']->getMaxValue($this->table,"$prikeyname")+1;
		if($Data['parentid']==0){
			$Data["rootid"] = $GLOBALS['db']->getMaxValue($this->table,"rootid")+1;
			$Data['orderid'] = 1;
			$Data['depth'] = 1;
		    $Data['parentidpath'] = $Data["$prikeyname"];
			$result = $GLOBALS['db']->insert($this->table,$Data);
		}else{
			$sql = "select * FROM $this->table where categoryid=$Data[parentid] limit 1";
			$parentcategory = $GLOBALS['db']->getRow($sql);
			$Data['rootid'] = $parentcategory['rootid'];
			if($parentcategory['child']==0){
				$Data['orderid'] = $parentcategory['orderid']+1;
			}else{
				$sql             = "select * FROM $this->table where parentid=$Data[parentid] order by orderid";
			    $orderto         = $GLOBALS['db']->getRow($sql);
			    $Data['orderid'] = $orderto['orderid']+$orderto['child']+1;
			}
			$Data['depth']        = $parentcategory['depth']+1;
			$Data['parentidpath'] = $parentcategory['parentidpath'].','.$Data["$prikeyname"];
			
			$sql = "update $this->table set orderid=orderid+1 where orderid>=$Data[orderid] and rootid=$Data[rootid]";
			$GLOBALS['db']->execSql($sql);
			$GLOBALS['db']->insert($this->table,$Data);
			$sql = "update $this->table set child=child+1 where categoryid=$Data[parentid]";
			$GLOBALS['db']->execSql($sql);
		}
        return $result;
    }
	//根据条件删除
    public function dodelAppcategory($prikeyid){
		$sql = "delete from $this->table where parentidpath like '%$prikeyid%'";
		$GLOBALS['db']->execSql($sql);
    }
	//对模型表对应的进行创表操作
	public function doCreateTable($appname,$appid,$groupid,$isweb=''){
		$sql = "CREATE TABLE `$this->prefix"."app_"."$appname` (
				  `id` bigint(16) NOT NULL DEFAULT '0',
				  `wxid` bigint(8) NOT NULL COMMENT '网校id',
				  `userid` bigint(16) NOT NULL COMMENT '教师或管理员id',
				  `categoryid` bigint(16) NOT NULL COMMENT '分类id',
				  `title` varchar(255) NOT NULL COMMENT '标题',
				  `adddate` int(8) DEFAULT NULL COMMENT '添加时间',
				  `inputer` varchar(50) NOT NULL COMMENT '添加者',
				  `hot` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否热门',
				  `allowcomment` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否允许评论',
				  `roll` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否滚动',
				  `recommend` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否推荐',
				  `slide` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否幻灯',
				  `hits` int(8) NOT NULL COMMENT '人气浏览量',
				  `mhits` int(8) NOT NULL COMMENT '月人气浏览量',
				  `whits` int(8) NOT NULL COMMENT '周人气浏览量',
				  `dhits` int(8) NOT NULL COMMENT '天人气浏览量',
				  `cmtnum` int(8) NOT NULL COMMENT '评论数',
				  `collectnum` int(8) NOT NULL COMMENT '文章收藏数',
                  `thumbsup` int(8) NOT NULL COMMENT '文章点赞数',
				  `status` tinyint(2) NOT NULL COMMENT '文章状态0待审 1已审 2草稿',
				  `abstract` text COMMENT '摘要',
				  `content` text COMMENT '内容',
				  `defaultpic` varchar(255) DEFAULT NULL COMMENT '新闻图',
				  PRIMARY KEY (`id`)
				) ENGINE=MyISAM DEFAULT CHARSET=gbk;";
	    $Data[0]['title'] = '主键ID';$Data[0]['fieldname'] = 'id';$Data[0]['fieldtype'] = '-1';
	    $Data[1]['title'] = '网校ID';$Data[1]['fieldname'] = 'wxid';$Data[1]['fieldtype'] = '-1';
	    $Data[2]['title'] = '用户ID';$Data[2]['fieldname'] = 'userid';$Data[2]['fieldtype'] = '-1';
	    $Data[3]['title'] = '分类';$Data[3]['fieldname'] = 'categoryid';$Data[3]['fieldtype'] = '14';$Data[3]['isentry'] = '1';
	    $Data[4]['title'] = '标题';$Data[4]['fieldname'] = 'title';$Data[4]['fieldtype'] = '1';$Data[4]['manageitem'] = '1';$Data[4]['isentry'] = '1';
	    $Data[5]['title'] = '添加时间';$Data[5]['fieldname'] = 'adddate';$Data[5]['fieldtype'] = '15';$Data[5]['manageitem'] = '1';$Data[5]['isentry'] = '1'; 
	    $Data[6]['title'] = '录入员';$Data[6]['fieldname'] = 'inputer';$Data[6]['fieldtype'] = '1';$Data[6]['manageitem'] = '1';$Data[6]['isentry'] = '1';
	    $Data[7]['title'] = '文章总浏览量';$Data[7]['fieldname'] = 'hits';$Data[7]['fieldtype'] = '8';
	    $Data[8]['title'] = '文章月浏览量';$Data[8]['fieldname'] = 'hits';$Data[8]['fieldtype'] = '8';
	    $Data[9]['title'] = '文章周浏览量';$Data[9]['fieldname'] = 'hits';$Data[9]['fieldtype'] = '8';
	    $Data[10]['title'] = '文章天浏览量';$Data[10]['fieldname'] = 'hits';$Data[10]['fieldtype'] = '8';
	    $Data[11]['title'] = '文章评论数';$Data[11]['fieldname'] = 'cmtnum';$Data[11]['fieldtype'] = '8';
	    $Data[12]['title'] = '文章收藏数';$Data[12]['fieldname'] = 'collectnum';$Data[12]['fieldtype'] = '8';
	    $Data[13]['title'] = '文章点赞数';$Data[13]['fieldname'] = 'thumbsup';$Data[13]['fieldtype'] = '8';
	    $Data[14]['title'] = '审核状态';$Data[14]['fieldname'] = 'status';$Data[14]['fieldtype'] = '5';$Data[14]['isentry'] = '1';
	    $Data[15]['title'] = '是否热门';$Data[15]['fieldname'] = 'hot';$Data[15]['fieldtype'] = '6';$Data[15]['isentry'] = '1';
	    $Data[16]['title'] = '允许评论';$Data[16]['fieldname'] = 'allowcomment';$Data[16]['fieldtype'] = '6';$Data[16]['isentry'] = '1';
	    $Data[17]['title'] = '是否滚动';$Data[17]['fieldname'] = 'roll';$Data[17]['fieldtype'] = '6';$Data[17]['isentry'] = '1';
	    $Data[18]['title'] = '是否推荐';$Data[18]['fieldname'] = 'recommend';$Data[18]['fieldtype'] = '6';$Data[18]['isentry'] = '1';
	    $Data[19]['title'] = '是否幻灯';$Data[19]['fieldname'] = 'slide';$Data[19]['fieldtype'] = '6';$Data[19]['isentry'] = '1';
	    $Data[20]['title'] = '文章的摘要';$Data[20]['fieldname'] = 'abstract';$Data[20]['fieldtype'] = '2';$Data[20]['isentry'] = '1';
	    $Data[21]['title'] = '文章的内容';$Data[21]['fieldname'] = 'content';$Data[21]['fieldtype'] = '3';$Data[21]['isentry'] = '1';
	    $Data[22]['title'] = '文章的图片';$Data[22]['fieldname'] = 'defaultpic';$Data[22]['fieldtype'] = '12';$Data[22]['isentry'] = '1';
	    $result = $GLOBALS['db']->execSql($sql);
		$fieldModel = M('common_table_field');
		//对字段表进行增加操作
		$ishotid = '';
		foreach($Data as $k=>$v){
		    $v['groupid'] = $groupid;
			$v['orderid']=$k+1;
			$v['appid'] = $appid;
			if($ishotid !==''){$v['isshow'] = $ishotid;}
			if($k==9){
				$v['showtitle'] = '特殊属性';
				$ishotid = $fieldModel->doAdd($v,'fieldid');
			}else{$fieldModel->doAdd($v,'fieldid');}
		} 
        return $result;
    }
	//对模型表对应的进行创表操作
    public function dropTable($appname,$isweb){
		if($isweb==0){
		    $sql = "DROP TABLE IF EXISTS `$this->prefix"."app_"."$appname`";
		}else{
			$sql = "DROP TABLE IF EXISTS `$this->prefix"."website_"."$appname`";
		}
		$result = $GLOBALS['db']->execSql($sql);
        return $result;
    }
	//对字段表对应的进行创字段操作
	public function doCreateField($appname,$Data){
	    $isok = $GLOBALS['db']->getOne("Describe `$this->prefix"."app_"."$appname` $Data[fieldname]");
		if($isok)KS_INFO('字段已存在'); 
		switch ($Data['fieldtype']){
			case  1:$Data['fieldtype'] = 'varchar(255)';break;//单行文本
			case  2:$Data['fieldtype'] = 'text(10000)';break;//多行文本（不支持HTML）
			case  3:$Data['fieldtype'] = 'text(10000)';break;//多行文本（支持HTML）
			case  4:$Data['fieldtype'] = 'varchar(255)';break;//下拉选项
			case  5:$Data['fieldtype'] = 'tinyint(2)';break;//单选框
			case  6:$Data['fieldtype'] = 'smallint(4)';break;//复选框
			case  7:$Data['fieldtype'] = 'varchar(255)';break;//日期 
			case  8:$Data['fieldtype'] = 'int(8)';break;//数字（Int） 
			case  9:$Data['fieldtype'] = 'Float(12,6)';break;//小数字（Float）
			case 10:$Data['fieldtype'] = 'decimal(10,2)';break;//货币（Money） 
			case 11:$Data['fieldtype'] = 'varchar(255)';break;//电子邮箱 
			case 12:$Data['fieldtype'] = 'varchar(255)';break;//图片	
			case 13:$Data['fieldtype'] = 'varchar(255)';break;//文件
			case 14:$Data['fieldtype'] = 'varchar(255)';break;//联动下拉列表
			case 15:$Data['fieldtype'] = 'varchar(255)';break;//日期+时间
			case 16:$Data['fieldtype'] = 'varchar(255)';break;//绑定其他模型
		}
		/*if($Data['defaultval']!=''){$Data['defaultval'] = "default '$Data[defaultval]'";}*/	
		$sql="alter table `$this->prefix"."app_"."$appname`
		      Add column $Data[fieldname] $Data[fieldtype] null";	  
		$result = $GLOBALS['db']->execSql($sql);
        return $result;
    }
	//对字段表对应的进行删字段操作
    public function dropField($appname,$fieldname){
		$isok = $GLOBALS['db']->getOne("Describe `$this->prefix"."app_"."$appname` $fieldname");
		if(!$isok)KS_INFO('字段不存在');
		$sql="alter table `$this->prefix"."app_"."$appname` drop column $fieldname"; 
		$result = $GLOBALS['db']->execSql($sql);
        return $result;
    }
	//对字段表对应的进行删多字段操作
    public function dropAllField($tablename,$fieldname){
		//取得字段名
		foreach($fieldname as $Fk=>$Fv){
			$Fv = ChkSQL($Fv["fieldname"]);
	     	$isok = $GLOBALS['db']->getOne("Describe `$this->prefix"."app_"."$tablename` $Fv");
		    if(empty($isok))KS_INFO($Fv.'字段不存在');
	    	$sql="alter table `$this->prefix"."app_"."$tablename` drop column $Fv";
	    	$GLOBALS['db']->execSql($sql);
		}
    }
}