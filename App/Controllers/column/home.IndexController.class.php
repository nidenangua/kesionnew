<?php

use Kesion\Controller;
class IndexController extends CommonController{

	/**
	 * 专栏首页管理
	 */
	public function indexAction(){
		$columnModel = M('app_column');
		$where =' where wxid='.$this->wxid;
    	//实现不同要求页面跳转
    	$status= ChkClng(KS_S('status',3));
    	if($status==3){$where.=" and status !=-1 ";}
    	elseif($status==0){$where.=" and status = 0";}
    	elseif($status==1){$where.=" and status = 1";}
    	elseif($status==2){$where.=" and status = 2";}
    	//搜索
		$keyword = ChkSQL(KS_S('keyword'));
		if(!empty($keyword)){
			$where.=" and title like '%$keyword%'";
		}
		$now_page = ChkClng(KS_S('p',1));
		$options = $columnModel->getOptions('6',$where);//分页参数设置
		$page    = Page($options);
		$values  = $columnModel->getPage($page,'columnid desc',$where);
		$db_course = M('app_course');
		$db_link = M("app_column_link");
		foreach($values as $k => $v){
			    $str = '0';
                $str = empty(ismoduleopen($this->wxid,6,4))?$str:$str.',4';
                $str = empty(ismoduleopen($this->wxid,6,3))?$str:$str.',3';
                $str = empty(ismoduleopen($this->wxid,6,2))?$str:$str.',2';
                $str = empty(ismoduleopen($this->wxid,6,1))?$str:$str.',1';
                $count1 = $db_course->getOne('count(b.id)','as a left join '.$db_link->table.' as b on a.courseid = b.infoid where b.columnid='.$v['columnid'].' and b.type=1 and a.courseType in('.$str.') and a.status=2');
			    $values[$k]['nper'] = $count1;
		}
		include  CURR_VIEW_PATH . "columnList.php";
	}

	/**
     * 专栏商品详情页
	 */
	public function serializationAction(){
		$id  = ChkClng(KS_G('get.id'));
		$keyword = ChkSQL(KS_S('keyword'));
		$keytype = ChkClng(KS_S('keytype',0));
		$where = '';
		if(!empty($keyword)){
            $where  =' and a.title like "%'.$keyword.'%"';
		}
        $Info = $this->AppModel->getRow('WHERE columnid='.$id);

        $db_link = M("app_column_link");
		$db_course = M('app_course');

        $values = array();
		if(ismoduleopen($this->wxid,6,4)||ismoduleopen($this->wxid,6,3)||ismoduleopen($this->wxid,6,2)||ismoduleopen($this->wxid,6,1)){
            $where2 = 'as a left join '.$db_link->table.' as b on a.courseid = b.infoid where b.columnid='.$id.' and b.type=1';
            if($keytype==1||$keytype==2||$keytype==3||$keytype==4){
				$where.=' and a.courseType='.$keytype;
				$values = $db_course->getAll($where2.$where,'a.title,a.defaultpic,a.chargetype,a.price,a.adddate,a.soldnum,b.id,b.orderid,a.courseType,b.infoid,a.status');
			}elseif($keytype==0){
              $str = '0';
              $str = empty(ismoduleopen($this->wxid,6,4))?$str:$str.',4';
              $str = empty(ismoduleopen($this->wxid,6,3))?$str:$str.',3';
              $str = empty(ismoduleopen($this->wxid,6,2))?$str:$str.',2';
              $str = empty(ismoduleopen($this->wxid,6,1))?$str:$str.',1';
              $values = $db_course->getAll($where2.$where.' and a.courseType in('.$str.')','a.title,a.defaultpic,a.chargetype,a.price,a.adddate,a.soldnum,b.id,b.orderid,a.courseType,b.infoid,a.status');
			}
		}

		array_multisort(array_column($values,'orderid'),SORT_DESC,$values);//排序
        $now_page = ChkClng(KS_S('p',1));
		$options['now_page']   = $now_page;
		$options['maxperpage'] = 6;
	    $options['totalput']   = count($values);
		$page = Page($options);
		$ary_link   = $page->arrayPage($values);
        foreach ($ary_link as $k => $v) {
            $ary_link[$k]['defaultpic'] = empty($v['defaultpic'])? nopic(12):Img($v['defaultpic']);
			$ary_link[$k]['jumpurl']    = '/#/course/'.$v['infoid'];

        }
		include  CURR_VIEW_PATH . "serialization.php";
	}
	/**
     * 删除专栏单品
	 */
	public function deletedfAction(){
		$id  =  ChkClng(KS_G('get.id'));
		$idAry =KS_G("post.aid");
		if (empty($idAry)||!is_array($idAry)) KS_INFO('请选择',0);
		$idstry = implode(',',$idAry);
		$db_link = M("app_column_link");
		$db_link->delete('id in ('.FilterIds($idstry).')');
		$db_order_info = M('app_order_info');
		$orderInfo = $db_order_info->getAll('where paystatus=1 and type=7 and courseid='.$id.' and status!=-1','memberid');
		foreach($orderInfo as $k =>$v){
			$this->cache->PutUCache('havecolumn',$v['memberid']);//更新购买者的缓存
		}
		$now_page = ChkClng(KS_S('p',1));
		$url = M_URL($this->AppName.'/Index','serialization',$id,GP('p-'.$now_page));
		KS_INFO('删除成功',3,$url);
	}

	//更改数据排序
	public function changeorderAction(){
		$id  =     ChkClng(KS_G('get.id'));
		$db_link = M("app_column_link");
//		$id = GF('id');
		$orderid = GF('orderid');
		$Data['orderid'] = $orderid;
		$db_link->update($Data,'id='.$id);
		echo 'ok';
	}
	//显示添加专栏页
	public function addcolumnAction(){
		if($this->columnid){
			$columnInfo = $this->AppModel->getRow('where columnid='.$this->columnid);
		}
		include  CURR_VIEW_PATH . "addcolumn.php";
	}

	//单品显示页
	public function addshopAction(){
		$columnid  = ChkClng(KS_G('get.id'));
		$db_course = M('app_course');
		$AppModel  = M('app_column_link');  //专栏关联表
		$where = '';
		$keyword = ChkSQL(KS_S('keyword'));
		$keytype = ChkClng(KS_S('keytype',0));

		if(!empty($keyword)){
            $where  =' and title like "%'.$keyword.'%"';
		}

        $values = array();
		if(ismoduleopen($this->wxid,6,4)||ismoduleopen($this->wxid,6,3)||ismoduleopen($this->wxid,6,2)||ismoduleopen($this->wxid,6,1)){
			if($keytype==1||$keytype==2||$keytype==3||$keytype==4){//为四大知识模块中的一个时
                $where  .=' and courseType='.$keytype;
				$values = $db_course->getAll('where wxid='.$this->wxid.' and  isassociated=1 and status=2 and courseid not in (select infoid from '.$AppModel->table.' where columnid='.$columnid.' and type=1)'.$where,'courseid as id,title,defaultpic');
			}elseif($keytype==0){  //不限
               $str = '0';
               $str = empty(ismoduleopen($this->wxid,6,4))?$str:$str.',4';
               $str = empty(ismoduleopen($this->wxid,6,3))?$str:$str.',3';
               $str = empty(ismoduleopen($this->wxid,6,2))?$str:$str.',2';
               $str = empty(ismoduleopen($this->wxid,6,1))?$str:$str.',1';
               $values = $db_course->getAll('where wxid='.$this->wxid.' and status=2 and isassociated=1 and courseid not in (select infoid from '.$AppModel->table.' where columnid='.$columnid.' and type=1)'.$where.' and courseType in('.$str.')','courseid as id,title,defaultpic');
			}

		}

		array_multisort(array_column($values,'id'),SORT_DESC,$values);//排序
        $now_page = ChkClng(KS_S('p','1'));
		$options['now_page']   = $now_page;
		$options['maxperpage'] = 8;
	    $options['totalput']   = count($values);
		$page = Page($options);
		$dt   = $page->arrayPage($values);
		foreach ($dt as $k => $v) {
			if(empty($v['defaultpic'])){
				$dt[$k]['defaultpic'] = nopic(12);
			}else{
				$dt[$k]['defaultpic'] = Img($v['defaultpic']);
			}
		}
		include  CURR_VIEW_PATH . "addshop.php";
	}
	/**
	 * 保存添加商品
	 */
	public function doaddshopAction(){
		$columnid   = ChkClng(KS_G('get.id'));
		$shopid     = KS_G('post.aid');

		$AppModel   = M('app_column_link');
		$maxOrderid = $AppModel->getOne('max(orderid)','where columnid='.$columnid);
		if(empty($maxOrderid)){
			$maxOrderid = 0;
		}
		$Data['columnid'] = $columnid;
		foreach ($shopid as $k => $v) {
            if (ChkClng($v)>0){
                $maxOrderid = $maxOrderid+1;
                $Data['type'] =1;
                $Data['infoid'] = ChkClng($v);
                $Data['orderid'] = $maxOrderid;
                $AppModel->doadd($Data,'id');
            }
		}

		$db_order_info = M('app_order_info');
		$orderInfo = $db_order_info->getAll('where paystatus=1 and type=7 and courseid='.$columnid.' and status!=-1','memberid');

		foreach($orderInfo as $k =>$v){
			$this->cache->PutUCache('havecolumn',$v['memberid']);//更新购买者的缓存
		}
		$url = M_URL($this->AppName.'/Index','serialization',$columnid);
		KS_INFO('添加成功',3,$url);
	}
	/**
     * 添加专栏
	 */
	public function doaddcolumnAction(){
		$Data['title']        = ChkSQL(KS_G("post.title"));
		$Data['userid']       = $this->userid;
		$Data['wxid']         = $this->wxid;
		$Data['adddate']      = time();
		$Data['status']       = ChkSQL(KS_G("post.status"));
		$Data['detailintro']  = Src(EncodeSQL(KS_G("post.detailintro")));
		$Data['intro']        = ChkSQL(KS_G("post.intro"));
		$Data['defaultpic']   = nopic(12);
		if(!empty(ChkSQL(KS_G("post.defaultpic")))){
			$Data['defaultpic']   = ChkSQL(KS_G("post.defaultpic"));
			//分享出去的封面
			$Data['sharepic']     = getsharepic($Data['defaultpic']);
		}
		//分享出去的封面
		$Data['sharepic']     = getsharepic($Data['defaultpic']);
		$Data['sharetitle']   = ChkSQL($Data['title']);
		$Data['shortdesc']    = ChkSQL(KS_G('shortdesc'));
		$Data['soldnum']      = ChkClng(KS_G("post.soldnum"));
		$Data['iscopy']       = ChkSQL(KS_G("post.iscopy"));
		$Data['chargetype']   = ChkClng(KS_G("post.chargetype"));
		$Data['price_market'] = ChkSQL(KS_G("post.price_market"));
		$Data['price']        = ChkSQL(KS_G("post.price"));
		if(empty($Data['price_market'])){
			$Data['price_market'] = ChkFloat($Data['price']);
		}
		$Rule['title']        = '专栏名称|isEmpty';
		Chkpost($Data,$Rule,$this->AppModel);
		$columnid=$this->AppModel->doadd($Data,'columnid');
		$url = M_URL($this->AppName.'/Index','index');
		KS_INFO('添加成功',3,$url);
	}
	/**
     * 修改专栏
	 */
	public function doeditAction(){
		$Data['title']        = ChkSQL(KS_G("post.title"));
		$Data['userid']       = $this->userid;
		$Data['wxid']         = $this->wxid;
		$Data['adddate']      = time();
		$Data['status']       = ChkSQL(KS_G("post.status"));
		$Data['detailintro']  = EncodeSQL(KS_G("post.detailintro"));
		$Data['intro']        = ChkSQL(KS_G("post.intro"));
		if(!empty(ChkSQL(KS_G("post.defaultpic")))){
			$Data['defaultpic']   = ChkSQL(KS_G("post.defaultpic"));
			//分享出去的封面
			$Data['sharepic']     = getsharepic($Data['defaultpic']);
		}

		$Data['sharetitle']   = $Data['title'];
		$Data['shortdesc']    = ChkSQL(KS_G('shortdesc'));
		$Data['soldnum']   = ChkClng(KS_G("post.soldnum"));
		$Data['iscopy']       = ChkSQL(KS_G("post.iscopy"));
		$Data['chargetype']   = ChkClng(KS_G("post.chargetype"));
		$Data['price_market'] = ChkSQL(KS_G("post.price_market"));
		$Data['price']        = ChkSQL(KS_G("post.price"));
		if(empty($Data['price_market'])){
			$Data['price_market'] = $Data['price'];
		}
		$Rule['title']        = '专栏名称|isEmpty';
		Chkpost($Data,$Rule,$this->AppModel);
//		var_dump($Data);die;
		$this->AppModel->update($Data,'columnid='.$this->columnid);
		$url = M_URL($this->AppName.'/Index','index');
		KS_INFO('修改成功',3,$url);
	}
    //批量操作
	public function changeAction(){
		$statusType = KS_G('post.statusType');
		if($statusType==1){
           $Data['status'] = -1;
		}elseif($statusType==2){
           $Data['status'] = 2;
		}elseif($statusType==3){
           $Data['status'] = 0;
		}
		$idAry = KS_G('post.check');
		foreach ($idAry as $k => $v) {
            if ($v>0){
                $this->AppModel->update($Data,'columnid='.ChkClng($v));
            }
		}

		$now_page = ChkClng(KS_S('p',1));
		$url = M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
		KS_INFO('批量操作成功',3,$url);
	}
    //单个的操作
	public function auditedAction(){
       $now_page       = ChkClng(KS_S('p',1));
       if(GF('status')==3){
       	  $Data['status'] = -1;
       }else{
       	 $Data['status'] = ChkClng(GF('status'));
       }

       $id             = ChkClng(KS_G('get.id'));
       $this->AppModel->update($Data,'columnid='.$id);
       $url = M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
	    ks_header($url);
	}

	public function othershowAction(){
		$columnModel = M('app_column');
		$where =' where wxid='.$this->wxid.' and status=2';
    	$columnlist   = null !== GF('columnid') ? GF('columnid'):'';

   	     if(empty($_COOKIE['columnlist'])){
   	       setcookie('columnlist',$columnlist,time()+3600,'/');
   	     }
   	     $db_column = M('app_column');
		 $db_column_link = M('app_column_link');
		 $columAry = $db_column->getAll('where columnid in('.FilterIds($columnlist).') and wxid='.$this->wxid,'columnid,title,defaultpic,chargetype,price');
		 foreach ($columAry as $k => $v) {
			if(empty($v['defaultpic'])){
				$columAry[$k]['defaultpic'] = nopic(12);
			}else{
				$columAry[$k]['defaultpic'] = Img($v['defaultpic']);
			}
		}
		if(empty($_COOKIE['columnAry'])){
			if($columAry){
                setcookie('columnAry',json_encode($columAry),time()+3600,'/');
			}else{
				setcookie('columnAry','0',time()+3600,'/');
			}

   	     }
		$keyword = ChkSQL(KS_S('keyword'));
	    //判断是否输入关键字
		if(!empty($keyword)){
		   $where.=" and title like '%$keyword%'";
		}
		$now_page = ChkClng(KS_S('p',1));
		$options = $columnModel->getOptions('4',$where);//分页参数设置
		$page    = Page($options);
		$values  = $columnModel->getPage($page,'columnid desc',$where,'columnid,title,defaultpic,chargetype,price');
		foreach ($values as $k => $v) {
			if(empty($v['defaultpic'])){
				$values[$k]['defaultpic'] = nopic(12);
			}else{
				$values[$k]['defaultpic'] = Img($v['defaultpic']);
			}
		}
		include  CURR_VIEW_PATH . "chosecolumn.php";
	}
	public function shareAction(){
		$columnid = ChkClng(KS_G('get.id'));
		include  CURR_VIEW_PATH . "share.php";
	}
}