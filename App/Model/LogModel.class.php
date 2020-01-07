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
class LogModel extends Model{
	public function status0(){
		 $sql = "UPDATE $this->table SET status=0";
		 $GLOBALS['db']->execSql($sql); 
	}
	public function status1($id){
		 foreach($id as $key =>$v){
		    $sql = "UPDATE $this->table SET status=1 where id=$v";
		    $GLOBALS['db']->execSql($sql);
		 }
	}
}