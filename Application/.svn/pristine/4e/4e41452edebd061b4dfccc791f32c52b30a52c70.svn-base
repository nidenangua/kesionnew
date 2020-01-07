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
class SettingModel extends Model{
	public function getBase(){
		$sql = "select fieldvalue,fieldname from $this->table";
        $result = $GLOBALS['db']->getAll($sql);
		return $result;
	 }
	 public function updateSetting($data){
		foreach ($data as $key => $value)
		{
			$sql = "update $this->table set fieldvalue = '$value' where fieldname = '$key'";
			$GLOBALS['db']->execSql($sql);
		}
	}

     /**************************************************************** 支付平台设置 begin ***********************************************/
     public function PayConfigStatus0(){
		 $sql = "UPDATE $this->table SET status=0";
		 $GLOBALS['db']->execSql($sql);
     }
     public function PayConfigStatus1($id){
         foreach($id as $key =>$v){
             $sql = "UPDATE $this->table SET status=1 where id=$v";
             $GLOBALS['db']->execSql($sql);
         }
     }
     public function PayConfigIsdefault0(){
         $sql = "UPDATE $this->table SET Isdefault=0";
         $GLOBALS['db']->execSql($sql);
     }
     public function PayConfigIsdefault1($id){
         $sql = "UPDATE $this->table SET Isdefault=1 where id=$id";
         $GLOBALS['db']->execSql($sql);
     }
    /*************************************************************** 支付平台设置 end ***********************************************/






    /**************************************************************地区配置 begin***************************************************/
     public function getArea($depth =''){
         if(empty($depth)){
             $sql ="select * from $this->table where depth = 1 or depth = 2 order by orderid";
         }else{
             $depth = ChkClng($depth);
             $sql = "select * from $this->table where depth = $depth order by orderid";
         }
         $areas = $GLOBALS['db']->getAll($sql);
         return $areas;
     }
     public function getAreaOne($id){
         $sql   = "select * from $this->table where id = $id limit 1";
         $areas = $GLOBALS['db']->getRow($sql);
         return $areas;
     }
     //插入时排序问题
     public function insterOrderArea($orderid,$parentid){
         $sql = "select id from $this->table where orderid = $orderid and parentid = $parentid";
         $id = $GLOBALS['db']->getOne($sql);
         $maxorderid=$this->getAreaOrderId($parentid);
         if(!empty($id)){
             $sql = "update $this->table set orderid = $maxorderid+1  where id = $id";
             $GLOBALS['db']->execSql($sql);
             return $orderid;
         }
         return $maxorderid+1;
     }
     //查询子地区id
     public function selectSonArea($id){
         $id  = ChkClng($id);
         $sql = "select id from $this->table where parentid = $id";
         $areaid = $GLOBALS['db']->getAll($sql);
         return $areaid;
     }
     //获取orderid最大值
     public function getAreaOrderId($id){
         $id = ChkClng($id);
         return $GLOBALS['db']->getMaxValue($this->table,'orderid',"parentid = $id");
     }
     //删除地区
     public function delArea($id){
         $id  = ChkClng($id);
         $sql = "delete from $this->table where id = $id";
         $GLOBALS['db']->execSql($sql);
     }
     //删除
     public function delAreas($id){
         $id = ChkClng($id);
         $sql = "select depth from $this->table where id = $id";
         $depth = $GLOBALS['db']->getOne($sql);
         if($depth==1){
             $twoid = $this->selectSonArea($id);//查询一级的子地区
             foreach($twoid as $Ek=>$Ev){
                 $threeid = $this->selectSonArea($id);//查询二级的子地区
                 foreach($threeid as $Erk=>$Erv){$this->delArea($Erv["id"]);}//删除三级
                 $this->delArea($Ev["id"]);//删除二级
             }
             $this->delArea($id);//删除一级
         }else if($depth==2){
             $threeid = $this->selectSonArea($id);
             foreach($threeid as $Erk=>$Erv){$this->delArea($Erv["id"]);}
             $this->delArea($id);
         }else if($depth==3){
             $this->delArea($id);
         }
     }
     public function updateArea($id,$city,$letter,$orderid){
         foreach ($id as $key => $value){
             $sql = "update $this->table set city = '$city[$key]',letter = '$letter[$key]',orderid = '$orderid[$key]' where id = $value ";
             $GLOBALS['db']->execSql($sql);
         }
     }
     public function reOrderArea($id){
         $result=$this->getAreaOne($id);
         $orderid =(int)$result["orderid"];
         $parentid =(int)$result["parentid"];
         $sql = "update $this->table set orderid = orderid-1  where orderid > $orderid and parentid = $parentid";
         $GLOBALS['db']->execSql($sql);
     }
     /**************************************************************地区配置 end***************************************************/









}