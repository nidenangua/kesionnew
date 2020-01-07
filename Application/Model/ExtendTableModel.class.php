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
class ExtendTableModel extends Model{
	//查找所有表
	public function getTables(){
		$sql    = "show tables from ".$GLOBALS['config']['DB_NAME'];
		$result = $GLOBALS['db']->getAll($sql);
        return $result;
    }
	//判断表是否存在
	public function selectTable($table){
		$sql    = "show tables like '$table'";
		$result = $GLOBALS['db']->getOne($sql);
        return $result;
    }
	public function getTableRow($tables){
		$sql    = "select count(*) from $this->prefix$tables";
		$result = $GLOBALS['db']->getOne($sql);
        return $result;
    }
	//创建章节表
	 public function doCreateTable($tablename,$table){
		 $sql = "CREATE TABLE $tablename LIKE $table";
		 $GLOBALS['db']->execSql($sql);
    }
	//当添加时有默认时，将其他转化成0
	public function updatedefault($type){
		 $sql= "UPDATE $this->table SET Isdefault=0 where type = $type";
		 $GLOBALS['db']->execSql($sql);
	}
	//删除表
	public function dodelTable($tablename){
		 $tablename = ChkSQL($tablename);
		 $sql = "DROP TABLE ".$this->prefix."$tablename";
		 $GLOBALS['db']->execSql($sql);
	}
	//更改表别名
	public function updataname($id,$name){
		foreach($id as $k=>$v){
			$sql = "update $this->table set itemname = '$name[$k]' where tableid = $v";
			$GLOBALS['db']->execSql($sql);
		}
	}
	public function istable($tablename){
		$sql = "SHOW TABLES LIKE '".$this->prefix."$tablename'";

		 $result = $GLOBALS['db']->query($sql,'One');
		 return $result;
	}

}