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
class CategoryModel extends Model{
	public function doaddCategory($Data,$prikeyname){
		$prikeyname          = ChkSQL($prikeyname);
		$Data["$prikeyname"] = $GLOBALS['db']->getMaxValue($this->table,"$prikeyname")+1;
		//var_dump($Data['parentid']);exit;
		if($Data['parentid']==0){
			$Data["rootid"]       = $GLOBALS['db']->getMaxValue($this->table,'rootid',"wxid=$Data[wxid]")+1;
			$Data['orderid']      = 1;
			$Data['depth']        = 1;
		    $Data['parentidpath'] = $Data["$prikeyname"];
			$result               = $GLOBALS['db']->insert($this->table,$Data);
		}else{
			$sql             = "select * from $this->table where categoryid=$Data[parentid] limit 1";
			$parentcategory  = $GLOBALS['db']->getRow($sql);
			$Data['rootid']  = $parentcategory['rootid'];
			if($parentcategory['child']==0){
				$Data['orderid'] = $parentcategory['orderid']+1;
			}else{
				$sql       = "select * from $this->table where parentid=$Data[parentid] order by orderid desc limit 1";
			    $orderto   = $GLOBALS['db']->getRow($sql);
				$oldorders = $GLOBALS['db']->getOne("select count(*) from `$this->table` where parentidpath like '%$orderto[parentidpath],%' or categoryid=$orderto[categoryid]");
			    $Data['orderid']  = $orderto['orderid']+$oldorders;
			}
			$Data['depth']        = $parentcategory['depth']+1;
			$Data['parentidpath'] = $parentcategory['parentidpath'].','.$Data["$prikeyname"];
			$sql                  = "update $this->table set orderid=orderid+1 where orderid>=$Data[orderid] and wxid=$Data[wxid] and rootid=$Data[rootid]";
			$GLOBALS['db']->execSql($sql);
			$GLOBALS['db']->insert($this->table,$Data);
			$sql = "update $this->table set child=child+1 where categoryid=$Data[parentid]";
			$GLOBALS['db']->execSql($sql);
		}
    }
	//根据条件删除
    public function dodelCategory($prikeyid,$wxid){
		$sql = "delete from $this->table where wxid=$wxid and parentidpath like '%$prikeyid,%' or categoryid=$prikeyid";
		$GLOBALS['db']->execSql($sql);
    }
}