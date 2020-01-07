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



use KESION\Model;
class EmailModel extends Model{
	public function status0(){
		 $sql="UPDATE $this->table SET status=0";
		 $GLOBALS['db']->execSql($sql);
	}
	public function status1($id){
		foreach($id as $key =>$v){
		  $sql="UPDATE $this->table SET status=1 where id=$v";
		  $GLOBALS['db']->execSql($sql);
		}
	}
	public function checkmodel($model){
		 $sql="select * from $this->table  where model='ss' limit 1";
		 $result=$GLOBALS['db']->execSql($sql);
		 var_dump($result).die;
	}
	public function beachupdate($id,$emailnum){
		foreach ($id as $key => $value)
		{   
			$sql = "update $this->table set emailnum = '$emailnum[$key]' where id = $value ";
			$GLOBALS['db']->execSql($sql);
		}
    }
    public function massageupdate($id,$massagenum){
		foreach ($id as $key => $value)
		{   
			$sql = "update $this->table set massagenum = '$massagenum[$key]' where id = $value ";
			$GLOBALS['db']->execSql($sql);
		}
    }
}