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
class FieldModel extends Model{
	/*------------------------------------模型表 查增改删-----------------------------------------------*/
	//对模型表对应的进行创表操作
	public function getTables(){
		$sql    = "show tables from kesioncms";
		$result = $GLOBALS['db']->getAll($sql);
        return $result;
    }
	//对模型表对应的进行创表操作
	public function doCreateTable($tablename){
		$tablename = ChkSQL($tablename);
		$sql       = "CREATE TABLE `".$GLOBALS['config']['DB_PREFIX']."$tablename` (
				  `id` bigint(16)
				) ENGINE=MyISAM DEFAULT CHARSET=gbk;";
		
		$result = $GLOBALS['db']->execSql($sql);
        return $result;
    }
	//对模型表对应的进行创表操作
    public function dropTable($prikeyid,$prikeyname){
		$prikeyid   = ChkClng($prikeyid);
		$prikeyname = ChkSQL($prikeyname);
		$sql = "select tablename from $this->table where $prikeyname=$prikeyid";
		$tablename  = $GLOBALS['db']->getOne($sql);
		$tablename  = ChkSQL($tablename);
		$sql        = "DROP TABLE IF EXISTS `".$GLOBALS['config']['DB_PREFIX']."$tablename`";
		$result     = $GLOBALS['db']->execSql($sql);
        return $result;
    }
	/*------------------------------------字段表 查增改删-----------------------------------------------*/
	//对字段表对应的进行创字段操作
	public function doCreateField($tablename,$Data){
		$tablename = ChkSQL($tablename);
		$isok = $GLOBALS['db']->getOne("Describe ".$GLOBALS['config']['DB_PREFIX']."$tablename $Data[fieldname]");
		if($isok)KS_INFO('字段已存在'); 
		switch ($Data[fieldtype])
		{
			case  1:$Data['fieldtype'] = 'varchar(255)';break;//单行文本
			case  2:$Data['fieldtype'] = 'text(10000)';break;//多行文本（不支持HTML）
			case  3:$Data['fieldtype'] = 'text(10000)';break;//多行文本（支持HTML）
			case  4:$Data['fieldtype'] = 'varchar(255)';break;//下拉选项
			case  5:$Data['fieldtype'] = 'tinyint(2)';break;//单选框
			case  6:$Data['fieldtype'] = 'smallint(4)';break;//复选框
			case  7:$Data['fieldtype'] = 'varchar(255)';break;//日期 
			case  8:$Data['fieldtype'] = 'bigint(16)';break;//数字（Int） 
			case  9:$Data['fieldtype'] = 'Float(12,6)';break;//小数字（Float）
			case 10:$Data['fieldtype'] = 'decimal(10,2)';break;//货币（Money） 
			case 11:$Data['fieldtype'] = 'varchar(255)';break;//电子邮箱 
			case 12:$Data['fieldtype'] = 'varchar(255)';break;//图片	
			case 13:$Data['fieldtype'] = 'varchar(255)';break;//文件
			case 14:$Data['fieldtype'] = 'varchar(255)';break;//联动下拉列表
			case 15:$Data['fieldtype'] = 'varchar(255)';break;//日期+时间
			case 16:$Data['fieldtype'] = 'varchar(255)';break;//绑定其他模型
		}
		/*if($Data['defaultval']!=''){$Data['defaultval'] = 'default '.$Data['defaultval'];}*/
		$sql="alter table `".$GLOBALS['config']['DB_PREFIX']."$tablename`
		      Add column $Data[fieldname] $Data[fieldtype] null";	 
		$result = $GLOBALS['db']->execSql($sql);
        return $result;
    }
	//对字段表对应的进行删字段操作
    public function dropField($tablename,$prikeyid,$prikeyname){
		$tablename = ChkSQL($tablename);//取得字段名
		$sql       = "select fieldname from $this->table where $prikeyname=$prikeyid";
		$fieldname = $GLOBALS['db']->getOne($sql);
		$fieldname = ChkSQL($fieldname);
		$isok      = $GLOBALS['db']->getOne("Describe ".$GLOBALS['config']['DB_PREFIX']."$tablename $fieldname");
		if(!$isok)KS_INFO('字段不存在');
		$sql       = "alter table `".$GLOBALS['config']['DB_PREFIX']."$tablename` drop column $fieldname"; 
		$result    = $GLOBALS['db']->execSql($sql);
        return $result;
    }
	//对字段表对应的进行删多字段操作
    public function dropAllField($tablename,$fieldname){
		$tablename = ChkSQL($tablename);
		//取得字段名
		foreach($fieldname as $Fk=>$Fv){
			$Fv = ChkSQL($Fv["fieldname"]);
	     	$isok = $GLOBALS['db']->getOne("Describe `".$GLOBALS['config']['DB_PREFIX']."$tablename` $Fv");
		    if(empty($isok))KS_INFO($Fv.'字段不存在');
	    	$sql="alter table `".$GLOBALS['config']['DB_PREFIX']."$tablename` drop column $Fv";
	    	$GLOBALS['db']->execSql($sql);
		}
    }
	//对字段对应的进行改表操作
    public function editField($tablename,$Data,$prikeyid,$prikeyname){
		$tablename = ChkSQL($tablename);
		//取得字段名
		$sql = "select fieldname from $this->table where $prikeyname=$prikeyid";
		$fieldname = $GLOBALS['db']->getOne($sql);
		$fieldname = ChkSQL($fieldname);
		$isok = $GLOBALS['db']->getOne("Describe ".$GLOBALS['config']['DB_PREFIX']."$tablename $fieldname");
		if(!$isok)KS_INFO('修改字段不存在');
		if($Data['empty']==0){
			$Data['empty'] = 'not null';
		}else{
				$Data['empty'] = 'null';
		}
		if($Data['defaultval']!=''){
			$Data['defaultval'] = 'default '.$Data['defaultval'];
		}	
		//alter table 表名称 change 字段原名称 字段新名称 字段类型 [是否允许非空
		$sql="alter table `".$GLOBALS['config']['DB_PREFIX']."$tablename` change $fieldname $Data[fieldname] $Data[fieldtype] $Data[empty] $Data[defaultval]"; 
		$result = $GLOBALS['db']->execSql($sql);
        return $result;
    }
}