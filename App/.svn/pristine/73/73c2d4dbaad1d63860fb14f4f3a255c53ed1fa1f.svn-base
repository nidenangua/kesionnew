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



use Kesion\Controller;
class IndexController extends CommonController{
    private $abridge=[
        'rrs'=>'日日顺',
        'shunfeng'=>'顺丰',
        'ems'=>'EMS',
        'zhongtong'=>'中通',
        'yuantong'=>'圆通',
        'yunda'=>'百世快递',
        'youzhengguonei'=>'韵达快递',
        'youzhengguonei'=>'邮政包裹/平邮',
    ];
    /**
     * 订单列表页
     */
    public function indexAction(){

        $paystatus = ChkClng(KS_S('paystatus',3));
        $ordertype = ChkClng(KS_S('ordertype',3));
        $ispaytoplat = ChkClng(KS_S('ispaytoplat',3));
		$stype = ChkClng(KS_S('type'),6);
        $where = 'where a.wxid='.$this->wxid.' and a.status!=-1';
		if($paystatus == 1){
			$where .= ' and a.paystatus=1 and a.price!=0';
		}elseif($paystatus==2){
			$where .= ' and a.paystatus=0  and a.price!=0';
		}elseif($paystatus==3){
			$where .= ' ';
		}elseif($paystatus == 4){
            $where .= ' and b.type in (14,15) and a.price!=0 and b.orderstatus = 0';
        }elseif($paystatus==5){
            $where .= ' and b.type in (14,15) and a.price!=0 and b.orderstatus = 1';
        }elseif($paystatus==6){
            $where .= ' and b.type in (14,15) and a.price!=0 and b.orderstatus = 2';
        }
		if ($ordertype == 1){
            $where .= ' and b.type=0';
        }elseif($ordertype==2){
            $where .= ' and b.type in(14,15)';
        }elseif($ordertype==3){
            $where .= ' ';
        }

		if($stype == 1){
            $where .= ' and a.type=1';
		}elseif($stype==2){
            $where .= ' and a.type=2';
		}elseif($stype==3){
            $where .= ' and a.type=0';
		}elseif($stype==6){
            $where .= ' and 1=1';
		}
        if($ispaytoplat == 1){
            $where .= ' and b.ispaytoplat=1';
        }elseif($ispaytoplat==2){
            $where .= ' and b.ispaytoplat=0';
        }

        $option    = null !==GF('option') ? GF('option'):'1';
		if($option==1){
			$month_start=mktime(0, 0 , 0,date("m"),1,date("Y"));
			$where .= ' and a.adddate>'.$month_start;
		}elseif($option==2){
			$lastmonth_start=mktime(0,0,0,date('m')-1,1,date('Y'));
			$lastmonth_end=mktime(23,59,59,date('m'),1,date('Y'))-24*3600;
			$where .= ' and a.adddate>'.$lastmonth_start.' and a.adddate<'.$lastmonth_end;
		}elseif($option==3){
			$season        = ceil((date('n'))/3);//当月是第几季度
            $season_start  = mktime(0, 0, 0,$season*3-3+1,1,date('Y'));
            //$season_end    = mktime(23,59,59,$season*3,date('t',mktime(0, 0 , 0,$season*3,1,date("Y"))),date('Y'));
            $where .= ' and a.adddate>'.$season_start;
		}elseif($option==4){
			$season           = ceil((date('n'))/3)-1;//上季度是第几季度
            $lastseason_start = mktime(0, 0, 0,$season*3-3+1,1,date('Y'));
            $lastseason_end   = mktime(23,59,59,$season*3,date('t',mktime(0, 0 , 0,$season*3,1,date("Y"))),date('Y'));
			$where .= ' and a.adddate>'.$lastseason_start.' and a.adddate<'.$lastseason_end;
		}

        $byname        = KS_S('byname','a.adddate desc');//排序

        $db_order_info = M("app_order_info");
		$app_order     = M("app_order");

		//自动收货
        $setting   = $this->cache->GetHCache('apprelate',$this->wxid);
        $setting = array_filter($setting, function ($val) {
            return $val['appid'] == 6 && $val['subappid'] == 8;
        });
        foreach ($setting as &$sitem){
            $setting = $sitem['setting'];
            break;
        }
        $setting = explode('※',$setting);
        $time = $setting[2]*24*60*60;
        $goods_data = $app_order->getAll('where wxid = '.$this->wxid.' and type in(14,15) and orderstatus = 1','json,orderid');
        foreach ($goods_data as &$v){
            $json = json_decode($v['json'],true);
            if (($json['sendtime']+$time)<time()){
                $time_data['orderstatus'] = 2;
                $app_order->update($time_data,"orderid = $v[orderid]");
            }
        }

		$param         = "as a inner join `$app_order->table` as b on a.orderid = b.orderid ";

        $keyword = ChkSQL(KS_S('keyword'));//搜索
		$keytype= ChkClng(KS_S('keytype',1));
        //判断是否输入关键字
        if(!is_null($keyword)){
            if($keytype==1){
                $param=$param.' '.$where." and a.ordersn like '%$keyword%'";
            }elseif($keytype==2){
                $usermodel=M('common_user_member');
                $param.=' inner join '.$usermodel->table.' as c on a.userid=c.userid '.$where." and c.name like '%$keyword%'";
            }
        }else{
            $param=$param.' '.$where;

        }
		$options    =  $db_order_info->getOptions('10',$param,'a.ordersn');//分页参数设置
		$page       =  Page($options);
		$param=$param.' '.'GROUP BY a.ordersn';
		$OrderAll   =  $db_order_info->getPage($page,$byname,$param,'a.*,b.orderstatus,b.paytype,b.poundage,b.discount,b.actual_amount,b.order_amount,b.original_amount,b.ispaytoplat');
        if (empty($json)){
            foreach ($OrderAll as &$item){
                $json = json_decode($item['json'],true);
                if (!empty($json['orderfrom']) && $json['orderfrom']==108){
                    $item['help'] = 1;
                }

            }
        }
        include  CURR_VIEW_PATH . "index.php";

    }

    /**
     * 拼团订单未完成
     */
    public function orderGroupAction(){

		$paystatus    = null !==GF('paystatus') ? GF('paystatus'):'5';
	    $where        = 'where a.wxid ='.$this->wxid.' and a.status!=-1 and a.groupid>0';
		if($paystatus == 0){$where .= ' and a.paystatus=0';}
		elseif($paystatus == 1){$where .= ' and a.paystatus=1';}
		elseif($paystatus == 3){$where .= ' and a.paystatus=3';}
		elseif($paystatus == 4){$where .= ' and a.paystatus=4';}
		elseif($paystatus == 6){$where .= ' and a.paystatus=1 and c.successful=0';}
		$keyword = ChkSQL(KS_S('keyword'));//搜索
		$keytype=null !==GF('keytype') ? GF('keytype'):0;
        //判断是否输入关键字
		if(!empty($keyword)){
		     if($keytype==1){$where.=" and a.ordersn like '%$keyword%'";}
		     elseif($keytype==2){$where.=" and b.name like '%$keyword%'";}
		}
		$adddate = GF('adddate') ? GF('adddate'):1;
		if($adddate==1){
    		$date = 'a.adddate desc';
    	}else{
    		$date = 'a.adddate asc';
    	}
        $option               = null !==GF('option') ? GF('option'):'1';
		if($option==1){
			$month_start=mktime(0, 0 , 0,date("m"),1,date("Y"));
			$where .= ' and a.adddate>'.$month_start;
		}elseif($option==2){
			$lastmonth_start=mktime(0,0,0,date('m')-1,1,date('Y'));
			$lastmonth_end=mktime(0,0,0,date('m'),1,date('Y'))-24*3600;
			$where .= ' and a.adddate>'.$lastmonth_start.' and a.adddate<'.$lastmonth_end;
		}elseif($option==3){
			$season        = ceil((date('n'))/3);//当月是第几季度
            $season_start  = mktime(0, 0, 0,$season*3-3+1,1,date('Y'));
            //$season_end    = mktime(23,59,59,$season*3,date('t',mktime(0, 0 , 0,$season*3,1,date("Y"))),date('Y'));
            $where .= ' and a.adddate>'.$season_start;
		}elseif($option==4){
			$season           = ceil((date('n'))/3)-1;//上季度是第几季度
            $lastseason_start = mktime(0, 0, 0,$season*3-3+1,1,date('Y'));
            $lastseason_end   = mktime(23,59,59,$season*3,date('t',mktime(0, 0 , 0,$season*3,1,date("Y"))),date('Y'));
			$where .= ' and a.adddate>'.$lastseason_start.' and a.adddate<'.$lastseason_end;
		}

		$where .= ' and a.status!=-1';
		$common_user_member   = M('common_user_member');
		$app_h5_rulereward   = M('app_h5_rulereward');
		$where         = "as a inner join `$common_user_member->table` as b on a.memberid = b.userid left join `$app_h5_rulereward->table` as c on a.groupid = c.groupid  $where";

        $options = $this->AppModel->getOptions('10',$where);//分页参数设置
	    $page = Page($options);
	    $values = $this->AppModel->getPage($page,$date,$where,'a.*,b.name,b.userid,c.successful,c.h5id,c.addtime as pintuantime');
	    foreach ($values as $k => $v) {
	    	$values[$k]['successful'] =1;
	    	$infoid = M('app_order_info')->getOne('courseid','where ordersn='.$v['ordersn']);
	    	$values[$k]['title'] = M('app_order_info')->getOne('title','where ordersn='.$v['ordersn']);
	    	if($v['type'] == 0 ||$v['type'] == 1|| $v['type'] == 4 || $v['type'] == 6){
	    		$values[$k]['original_amount'] = M('app_course')->getOne('price','where courseid='.$infoid);
	    	}elseif ($v['type'] == 5 || $v['type'] == 3) {
	    		$values[$k]['original_amount'] = M('app_paper')->getOne('price','where paperid='.$infoid);
	    	}elseif ($v['type'] == 7 || $v['type'] == 8) {
	    		$values[$k]['original_amount'] = M('app_column')->getOne('price','where columnid='.$infoid);
	    	}elseif ($v['type'] == 9) {
	    		$values[$k]['original_amount'] = M('common_user_group')->getOne('price','where id='.$infoid);
	    	}
	    	if($v['groupid']){
	    		if($v['paystatus']==1&&$v['successful']==0&&!empty($v['h5id'])){
		    		$Db1      = M('app_h5_rule');

		    		$setting = $Db1->getRow('where id='.$v['h5id']);
		    		$setting['setting']  = unserialize($setting['setting']);

		    	   if($setting['isstar']==1 && $setting['endtime']>time()){
		    	   	    if($setting['setting']['timexz']==24){
							$setting['setting']['endtime'] = $v['pintuantime']+86400;
			   			}else{
			   				$setting['setting']['endtime'] = $v['pintuantime']+86400+86400;
			   			}
			    		if($setting['setting']['endtime']<time()){
			    			$values[$k]['paystatus'] = 3;
			    		}else{
			    			$values[$k]['paystatus'] = 6;
			    		}
		    	  }else{
		    	  	$values[$k]['paystatus'] =  3;
		    	  }

		    	}
	    	}

	    }

		include  CURR_VIEW_PATH . "orderGroup.php";
	}
	//订单应用配置
	public function settingAction(){
		$setting = getSet($this->wxid,$this->appid);//获取网站配置
		include  CURR_VIEW_PATH . "setting.php";
	}
	//进行订单应用配置操作
	public function doSettingAction(){
		$setting = getSet($this->wxid,$this->appid);//获取网站配置
		$setting[0] = ChkClng(KS_G('post.setting0'));//是否开启
		$Data['setting'] = implode('|',$setting);
		$apprelateModel         = M('common_app_userrelate');
	    $apprelateModel->update($Data,'wxid='.$this->wxid.' and appid = '.$this->appid);
		KS_INFO('保存成功',6);
	}
    //退款单个订单
	public function tkorderAction(){
		$orderid = ChkSQL(KS_G("get.id"));
		$Data['paystatus'] =4;
		$Db = M('app_order');
		$Db2 = M('app_order_info');
        $Db->update($Data,'orderid ='.$orderid.' and wxid='.$this->wxid);
        $Db2->update($Data,'orderid ='.$orderid.' and wxid='.$this->wxid);
		$now_page    = ChkClng(KS_S('p',1));
		$url         = M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
		ks_header($url);
	}

	/**
     * 删除单个订单
	 */
	public function delorderAction(){
		$orderid = ChkSQL(KS_G("get.id"));
		$Data['status'] =-1;
		$order_info = M('app_order_info');
        $order_info->update($Data,'orderid ='.$orderid.' and wxid='.$this->wxid);
        $this->AppModel->update($Data,'orderid ='.$orderid.' and wxid='.$this->wxid);
		$now_page    = ChkClng(KS_S('p',1));
		$url         = M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
		ks_header($url);
	}

    /**
     * 批量删除
	 */
	public function batchAction(){
		$id = ChkSQL(KS_G("post.orderid"));
		if(empty($id)){KS_INFO('请选择');}
		$now_page    = ChkClng(KS_S('p',1));
		$batch       = ChkClng(KS_G('post.batch'));
		$url         = M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
		if($batch==1){//删除
			foreach($id as $k=>$v){
				 $Data['status'] =-1;
				 $this->AppModel->update($Data,'orderid ='.$v.' and wxid='.$this->wxid);
				 $order_info = M('app_order_info');
                 $order_info->update($Data,'orderid ='.$v.' and wxid='.$this->wxid);
		   }
		}
		KS_INFO('批量删除成功',0,$url);
	}

    /**
     * 给学员开通学习订单
     */
    public function orderOpenAction(){
        $db_user_group = M('common_user_group');
        $group = $db_user_group->getAll('where type = 0 and wxid='.$this->wxid.'','id,name');
		include  CURR_VIEW_PATH . "orderOpen.php";
    }
    /**
     * 保存学员报班
     */
    public function doOrderOpenAction(){

        $opentype        = ChkClng(KS_S('opentype'));
        $username        = ChkSQL(KS_S('username'));
        $user_group      = ChkSQL(KS_S('user_group'));
        $type            = ChkClng(KS_S('type'));      //开通类型 0课程 1直播 7专栏  10社群
        $id              = ChkSQL_Array(KS_S('infoid'));   // 课程 ID等
        if (empty($opentype)){
            KS_Alert('请选择要开通的方式','error');
        }
        if (empty($id)){
            KS_Alert('请选择要开通的课程信息','error');
        }
        if ($opentype == 1){
            if (empty($username)){
                KS_Alert('请选择要开通的学员','error');
            }
            $usernamearr=explode(',',$username);
            $userModel  = M('common_user');
            foreach($usernamearr as $k=>$v){
                $userid=$userModel->getOne('userid',"where wxid=$this->wxid and usertype=0 and username='".ChkSQL($v)."'");
                if ($userid<=0){
                    KS_Alert('对不起，学员'.$v.'不存在！','error');
                }else{
                    foreach ($id as &$courseid){
                        if (ChkClng($courseid)>0){
                            $data['userid']    = $userid;
                            $data['order_amount']= ChkFloat(KS_G('post.order_amount'));
                            $data['courseid']    = ChkClng($courseid);
                            $data['type']    = $type ;    //开通类型 0课程 1直播 7专栏  10社群
                            $data['wxid']= $this->wxid;
                            $data['isbatchopen']=1;   //是否批量开通
                            $Enrolment      = M('App/OrderModel');
                            $Enrolment->doOpenCourseOrder($data);//对学员进行报课报班
                        }
                    }
                }
            }
        }else{
            if (empty($user_group)){
                KS_Alert('请选择要开通的用户组','error');
            }
            //获取用户组
            $db_group_user = M('common_user');

            //根据用户组id获取成员userid
            $values = $db_group_user->getAll('where groupid = '.$user_group.'','userid');
            if (empty($values)){
                KS_Alert('该用户组没有学员','error');
            }
            foreach($values as $k=>$v){
                if ($v['userid']<=0){
                    KS_Alert('对不起，学员'.$v.'不存在！','error');
                }else{
                    foreach ($id as &$courseid){
                        if (ChkClng($courseid)>0){
                            $data['userid']    = $v['userid'];
                            $data['order_amount']= ChkSQL(KS_G('post.order_amount'));
                            $data['courseid']    = ChkClng($courseid);
                            $data['type']    = $type ;    //开通类型 0课程 1直播 7专栏  10社群
                            $data['wxid']=$this->wxid;
                            $data['isbatchopen']=1;   //是否批量开通
                            $Enrolment      = M('App/OrderModel');
                            $Enrolment->doOpenCourseOrder($data);//对学员进行报课报班
                        }
                    }
                }
            }
        }
        KS_Alert('恭喜，开通成功','success','/home.html/order/Index?appid-4',true);
	}

    /**
     * 订单详情页
     */
    public function orderdetailAction(){

        $orderId = ChkClng(KS_G("get.id"));
		$ordermsg  = $this->AppModel->getRow('where orderid='.$orderId);
		if ($ordermsg['type'] == 14 || $ordermsg['type'] == 15){
		    if (!empty($ordermsg['json'])){
                $json = json_decode($ordermsg['json'],true);
                $ordermsg['realname'] = $json['address_info']['realname'];
                $ordermsg['street'] = $json['address_info']['street'];
                $ordermsg['telphone'] = $json['address_info']['telphone'];
                $ordermsg['freight'] = $json['address_info']['freight'];
                $ordermsg['logistics'] = $json['logistics'].','.$json['expressNumber'];
            }
        }
		$Model = M('app_order_info');
		$orderdetail=$Model->getAll('where orderid='.$orderId,'id,sumprice,courseid,title,numb,price,adddate,ispj,type,json');
        foreach ($orderdetail as &$item){
            $json = json_decode($item['json'],true);
            if (!empty($json)){
                $item['attr'] = implode(",",$json['attr']);
            }else{
                $item['attr'] = "---";
            }
        }
        include  CURR_VIEW_PATH . "orderdetail.php";

	}
	//订单发货页面
	public function showordersendAction(){
        $orderid            = ChkClng(GF('orderid'));
        $ordermsg  = $this->AppModel->getRow('where orderid='.$orderid.'','json,mark');
        if (!empty($ordermsg['json'])){
            $json = json_decode($ordermsg['json'],true);
            $ordermsg['realname'] = $json['address_info']['realname'];
            $ordermsg['street'] = $json['address_info']['street'];
            $ordermsg['telphone'] = $json['address_info']['telphone'];
        }
        include  CURR_VIEW_PATH . "ordersend.php";
    }

    /**
     *确认发货
     */
    public function ordersendAction(){
        $orderid = ChkClng(GF('orderid'));
        $expressNumber  = ChkSQL(KS_G('expressNumber'));
        $abridge  = ChkSQL(KS_G('abridge'));
        $logistics = $this->abridge[$abridge];
        if (empty($logistics)){
            KS_Alert('请填写快递方式','error');
        }
        if (empty($expressNumber)){
            KS_Alert('请填写快递单号','error');
        }
        $ordermsg  = $this->AppModel->getRow('where orderid='.$orderid.'','json');
        $json = json_decode($ordermsg['json'],true);
        $info = ["abridge"=>$abridge,"expressNumber"=>$expressNumber,"logistics"=>$logistics,"sendtime"=>time()];
        $json = array_merge($json,$info);
        $data['json'] = json_encode($json,JSON_UNESCAPED_UNICODE);
        $data['orderstatus'] = 1;
        $this->AppModel->update($data,"orderid =$orderid");
        $url= M_URL($this->AppName.'/Index','index','',GP(''));
        KS_INFO('确认成功',3,$url);
    }
    /*
     *查看收货地址
     */
    public function showAddressAction(){
        $orderid = ChkClng(GF('orderid'));
        $app_order = M('app_order');
        $app_order_data = $app_order->getRow('where orderid = '.$orderid.'','json,adddate,orderid');
        $order_info = M('app_order_info');
        $order_info_data = $order_info->getAll('where orderid = '.$app_order_data['orderid'].' ','title');
        foreach ($order_info_data as $val) {
            $val = join(",", $val);
            $temp_array[] = $val;
        }
        $title = implode(",", $temp_array);

        $json = json_decode($app_order_data['json'],true);
        $abridge = $json['abridge'];
        $goods['expressNumber'] = $json['expressNumber'];
        $goods['logistics'] = $json['logistics'];
        $goods['adddate'] = KS_DATE($app_order_data['adddate']);
        $goods['number'] = count($order_info_data);
        $goods['title'] = CutStr($title,10,0,'utf-8','...');

        $name = $abridge; //快递名称
        $number = $json['expressNumber'];//单号
        //参数设置
        $post_data = array();
        $post_data["customer"] = 'BABA797AEBAB3F57D63C68A0CAD513CE';
        $key= 'ybKPMOBK2382';

        $data['com']=$name;  //查询的快递公司的编码， 一律用小写字母
        $data['num']=$number;  //查询的快递单号， 单号的最大长度是32个字符 358263398950
        $post_data["param"] =json_encode($data);

        $url='http://poll.kuaidi100.com/poll/query.do';
        $post_data["sign"] = md5($post_data["param"].$key.$post_data["customer"]);
        $post_data["sign"] = strtoupper($post_data["sign"]);
        $o="";
        foreach ($post_data as $k=>$v)
        {
            $o.= "$k=".urlencode($v)."&";		//默认UTF-8编码格式
        }
        $post_data=substr($o,0,-1);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$post_data);
        curl_setopt($ch, CURLOPT_TIMEOUT,3);
        $result = curl_exec($ch);

        $result = json_decode($result,true);
        $result['info'] = $goods;
        //var_dump($result);exit;

        include  CURR_VIEW_PATH . "showAddress.php";
    }

    /*
     *修改价格
     */
    public function editorderAction(){
        $orderid = ChkSQL(GF('orderid'));
        $id = ChkSQL_Array(KS_G('id'));
        //$sumprice = ChkSQL_Array(KS_G('sumprice'));
        $order_amount = ChkSQL(KS_G('order_amount'));
        $sum = 0;
        $oder = $this->AppModel->getRow('where orderid  = '.$orderid.'','userid,json');
        $userid = $oder['userid'];
        $json = json_decode($oder['json'],true);
        list($usec, $sec)  = explode(" ", microtime());
        $odersn = $userid.((float)$usec + (float)$sec)*10000;
        foreach ($id as $k=>$v){
            $Model = M('app_order_info');
//            $data['sumprice'] = ChkSQL($sumprice[$k]);
//            $v = ChkClng($v);
            $data['adddate'] = time();
            $data['ordersn'] = $odersn;
            $Model->update($data,"id = $v");
            //$sum = $sum+$sumprice[$k];
        }
        $order_data['adddate'] = time();
        $order_data['ordersn'] =$odersn;
        //$order_data['order_amount'] = $sum+$json['address_info']['freight'];
        $order_data['order_amount'] = $order_amount;
        $this->AppModel->update($order_data,"orderid = $orderid");
        $url= M_URL($this->AppName.'/Index','index','',GP(''));
        KS_INFO('确认成功',3,$url);
    }
	//订单确认页
    public function showorderconfirmAction(){
    	$orderid            = ChkClng(GF('orderid'));
		include  CURR_VIEW_PATH . "orderconfirm.php";
	}

	public function orderconfirmAction(){
	    	$orderModel         = M('app_order');
        	$orderinfoModel     = M('app_order_info');
        	$userfoModel        = M('common_user');
        	$payModel           = M('app_pay_log');
        	$orderid            = ChkClng(GF('orderid'));
//      	$paytype = ChkClng(KS_G('post.paytype'));
        	$mark               = ChkSQL(KS_G('post.mark'));
//      	var_dump($orderid);
//      	var_dump($mark);
//      	exit;
          $Data010['mark']=$mark;
	  	  $Data010['orderid']=$orderid;
	  	  $Data010['userid']=$this->userid;
	  	  $PayModel          = M('App/PayModel');
		  $results               = $PayModel->surePay($Data010);
            $url1= M_URL($this->AppName.'/Index','index','',GP(''));
            if($results){
                $order = M('app_order_info');
                $order_data = $order->getRow('where orderid = '.$orderid.'','type,userid,courseid');
                if ($order_data['type'] == 0 || $order_data['type'] == 7){
                    $model = M('App/UsersModel');
                    $model->addCourseList($order_data['courseid'],$order_data['type'],'0',$order_data['userid'],$order_data['wxid']);
                }elseif($order_data['type'] == 12){
                    $course_sign = M('app_course_sign');
                    $json = json_decode($order_data['json'],true);
                    $data['paystatus'] = 1;
                    $course_sign->update($data,"id=$json[id]");
                }
            	KS_INFO('支付成功',3,$url1);
            }else{
            	KS_INFO('学员已满，不能继续支付',3,$url1);
            }

	}
}
  