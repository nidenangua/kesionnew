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
class DistributionController extends CommonController
{
    public function _initialize()
    {
        parent::_initialize();
        check_power($this->userinfo,'distribution','adddistribution,distributioner');
    }

    /**
    * 分销管理首页列表
    */
    public function indexAction(){
        $courseType = ChkClng(KS_S('courseType',0));
        $status = KS_S('status',3);
        $where = 'where isdistribution!=0 and wxid='.$this->wxid.' and status =2';
        $keyword = ChkSQL(KS_S('keyword'));
        $db_course = M('app_course');//课程
        $db_column = M('app_column');//专栏
        if(!empty($keyword)){
            $where.=" and title like '%$keyword%'";
        }
        if($status!=3){
            if($status==2){
                $where.=' and isdistribution='.$status .' and chargetype=1';
            }else{
                $where.=' and (isdistribution= 2 and chargetype!=1) or (isdistribution= 1 and chargetype=1)';
            }

        }

        $now_page = ChkClng(KS_S('p',1));
        if($courseType==0){
            $courseAry1 = $db_course->getAll($where.' order by courseid desc','courseid,title,studentcount,price,chargetype,isdistribution,commission,courseType,adddate');
            $courseAry2 = $db_column->getAll($where.' order by columnid desc','columnid as courseid,title,soldnum as studentcount,price,chargetype,isdistribution,commission,adddate');
            foreach($courseAry2 as $k =>$v){
                $courseAry2[$k]['courseType'] = 6;
            }
            $dt = array_merge($courseAry1,$courseAry2);
            array_multisort(array_column($dt,'adddate'),SORT_DESC,$dt);//排序
            $options['now_page']   = $now_page;
            $options['maxperpage'] = 10;
            $options['totalput']   = count($dt);
            $page = Page($options);
            $values   = $page->arrayPage($dt);
        }elseif($courseType==6){
            $options = $db_column->getOptions('10',$where);//分页参数设置
            $page    = Page($options);
            $values  = $db_column->getPage($page,'columnid desc',$where,'columnid as courseid,title,soldnum as studentcount,price,chargetype,isdistribution,commission');

        }else{
            $where.= ' and courseType='.$courseType;

            $options = $db_course->getOptions('10',$where);//分页参数设置
            $page    = Page($options);
            $values  = $db_course->getPage($page,'courseid desc',$where,'courseid,title,studentcount,price,chargetype,isdistribution,commission,courseType');
        }
        $db_order     = M('app_order');
        $db_orderInfo = M('app_order_info');
        foreach($values as $k =>$v){

            $type=0;
            if ($values[$k]['courseType']==6){
                $type=7;
            }

                $values[$k]['fxcount'] = $db_order->getOne('count(*)',' as a inner join '.$db_orderInfo->table.' as b on a.ordersn=b.ordersn where b.type='.$type.' and b.courseid='.$v['courseid'].' and a.paystatus=1 and a.distribute_userid>0');

        }
        include  CURR_VIEW_PATH . "Distribution/home.index.php";
    }

   /**
    * 添加分销商品
    */
   public function addDistributionAction(){

       /***************检查是否有购买插件或是否VIP版本  begin  by 自由的飞 at 2019.4.13 **************/
           checkIsVipModule($this->wxid,105,true,true);
       /***************检查是否有购买插件或是否VIP版本  end by 自由的飞 at 2019.4.13 **************/

       $courseType = ChkClng(KS_S('courseType',0));
      if($courseType==1){
          $db_class = M('app_class');
          $where ='where isdistribution=0 and wxid='.$this->wxid.' and status=2 and chargetype=1 and price>0';
          $courseAry = $db_class->getAll($where);
      }else if($courseType==7){
          $db_column = M('app_column');
          $where ='where isdistribution=0 and wxid='.$this->wxid.' and status=2 and chargetype=1 and price>0';
          $courseAry = $db_column->getAll($where);
      }else if ($courseType==8){
          $db_class = M('app_course');
          $where ='where isdistribution=0 and wxid='.$this->wxid.' and courseType = 8 and status=2 and chargetype=1  and price>0';
          $courseAry = $db_class->getAll($where);
      }else{
          $db_class = M('app_course');
          $where ='where isdistribution=0 and wxid='.$this->wxid.' and courseType != 8 and status=2 and chargetype=1  and price>0';
          $courseAry = $db_class->getAll($where);
      }
      foreach($courseAry as $k=>$v){
      	//$courseAry[$k]['realprice'] = floor(getPoundage($this->wxid,$v['price'])*100)/100;
      }
      include  CURR_VIEW_PATH . "Distribution/home.addcourse.php";
   }

   public function saveDataAction(){
   	 $courseType =ChkClng(KS_G('post.courseType'));
   	 $id = ChkClng(KS_G('post.id'));
   	 if(empty($id)){
   	 	KS_INFO('请选择课程',4,'','',1);
   	 }
   	 $Data['commission'] = ChkClng(KS_G('post.commission'));
   	 $Data['isdistribution'] = 2;
// 	 var_dump($courseType);exit;
   	 if($courseType==1){
          $db_class = M('app_class');
           $db_class->update($Data,'classid='.$id);
      }elseif($courseType==7){
          $db_column = M('app_column');
           $db_column->update($Data,'columnid='.$id);
      }else{
          $db_class = M('app_course');
           $db_class->update($Data,'courseid='.$id);
      }
      $url = M_URL('Distribution','index');
		KS_INFO('操作成功',3,$url);
   }
  public function editdistributionAction(){
      $courseType = null !==GF('courseType') ? GF('courseType'):'1';
      $p = null !==GF('p') ? GF('p'):'1';
      $id = KS_G('get.id');
      if($id){
      	if($courseType==5){
      		$db_class = M('app_class');
      		$info = $db_class->getRow('where classid='.$id);
      		$info['realcomin'] = floor(($info['commission']*0.01*$info['price'])*100)/100;
      	}elseif($courseType==6){
      		 $db_column = M('app_column');
      		$info = $db_column->getRow('where columnid='.$id);
      		$info['realcomin'] = floor(($info['commission']*0.01*$info['price'])*100)/100;
      	}else{
      		$db_class = M('app_course');
      		$info = $db_class->getRow('where courseid='.$id);
      		$info['realcomin'] = floor(($info['commission']*0.01*$info['price'])*100)/100;
      	}
      }
   	  include  CURR_VIEW_PATH . "Distribution/edit_distribute.php";
   }
   public function saveeditAction(){
   	 $p = null !==GF('p') ? GF('p'):'1';
   	 $courseType = GF('courseType');
   	 $id = ChkClng(KS_G('get.id'));
   	 if(empty($id)){
   	 	KS_INFO('课程出错',4,'','',1);
   	 }
   	 $Data['commission'] = ChkClng(KS_G('post.commission'));
   	 if($courseType==5){
          $db_class = M('app_class');
           $db_class->update($Data,'classid='.$id);
      }elseif($courseType==6){
          $db_column = M('app_column');
           $db_column->update($Data,'columnid='.$id);
      }else{
          $db_class = M('app_course');
           $db_class->update($Data,'courseid='.$id);
      }
      $url = M_URL('Distribution','index','',GP('courseType-'.$courseType.'&p='.$p));
		KS_INFO('操作成功',3,$url);
   }
   //上架
	public function  upAction(){
		$now_page = ChkClng(KS_S('p',1));
		$id = ChkClng(KS_G('get.id'));
		$type = GF('type');
		$Data['isdistribution'] = 2;
   	    if($type==5){
          $db_class = M('app_class');
           $db_class->update($Data,'classid='.$id);
      }elseif($courseType==6){
          $db_column = M('app_column');
           $db_column->update($Data,'columnid='.$id);
      }else{
          $db_class = M('app_course');
           $db_class->update($Data,'courseid='.$id);
      }
      $courseType = ChkClng(KS_S('courseType',0));
      $url = M_URL('Distribution','index','',GP('courseType-'.$courseType.',p-'.$now_page));
	  KS_INFO('',0,$url);
    }
	//下架
	public function  downAction(){
		$now_page = ChkClng(KS_S('p',1));
		$id = ChkClng(KS_G('get.id'));
		$type = GF('type');
		$Data['isdistribution'] = 1;
   	    if($type==5){
          $db_class = M('app_class');
           $db_class->update($Data,'classid='.$id);
      }elseif($type==6){
          $db_column = M('app_column');
           $db_column->update($Data,'columnid='.$id);
      }else{
          $db_class = M('app_course');
           $db_class->update($Data,'courseid='.$id);
      }
      $courseType = ChkClng(KS_S('courseType',0));
      $url = M_URL('Distribution','index','',GP('courseType-'.$courseType.',p-'.$now_page));
	  KS_INFO('',0,$url);
    }
    public function changedisAction(){
    	$now_page = ChkClng(KS_S('p',1));
		$id = ChkClng(KS_G('get.id'));
		$type = GF('type');
		$Data['isdistribution'] = 0;
		if($type==5){
	        $db_class = M('app_class');
	        $db_class->update($Data,'classid='.$id);
	    }elseif($type==6){
          $db_column = M('app_column');
           $db_column->update($Data,'columnid='.$id);
        }else{
	        $db_class = M('app_course');
	        $db_class->update($Data,'courseid='.$id);
	    }
	    $courseType = ChkClng(KS_S('courseType',0));
	    $url = M_URL('Distribution','index','',GP('courseType-'.$courseType.',p-'.$now_page));
	    ks_header($url);
    }
    /**
     * 分销订单
     */
    public  function distributionerAction()
    {

        $db_member = M('common_user_member');
        $db_order  = M('app_order');
        $db_orderInfo = M('app_order_info');
        $now_page = ChkClng(KS_S('p',1));
        $option = ChkClng(KS_S('option',1));
        $param = ' as a inner join '.$db_orderInfo->table.' as b on a.orderid = b.orderid';
        $where=' where a.wxid = '.$this->wxid.' and a.distribute_userid>0 and a.paystatus>0';
        $keytype = ChkClng(KS_S('keytype','1'));
        $keyword = ChkSQL(KS_S('keyword'));
        $timetype= ChkClng(KS_S('timetype',4));
        if($keyword){
            if($keytype==1){
                $usermodel=M('common_user_member');
                $param.=' left join '.$usermodel->table.' as c on a.distribute_userid=c.userid '.$where." and (c.name like '%$keyword%')";
            }else{
                $param.= $where.' and b.title like "%'.$keyword.'%"';
            }
            $where=$param;
        }else{
            $where=$param.$where;
        }

        if($option==1){
			$month_start=mktime(0, 0 , 0,date("m"),1,date("Y"));
			$where .= ' and a.adddate>'.$month_start;
		}elseif($option==2){
			//$lastmonth_start=mktime(0,0,0,date('m')-1,1,date('Y'));
			//$lastmonth_end=mktime(0,0,0,date('m'),1,date('Y'))-24*3600;
            $lastmonth_start=strtotime(date('Y/m/01 0:0:0', strtotime('-1 month')));
            $lastmonth_end=strtotime(date('Y/m/t 23:59:59', strtotime('-1 month')));
			$where .= ' and a.adddate>='.$lastmonth_start.' and a.adddate<='.$lastmonth_end;
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
		}elseif($option==5){
            $starttime=ChkSQL(null !==GF('starttime') ? GF('starttime'):0);
            $endtime=ChkSQL(null !==GF('endtime') ? GF('endtime'):0);
            $start=date('Y/m/d  h:i:s',$starttime);
            $end=date('Y/m/d  h:i:s',$endtime);
            $where .= ' and a.adddate>'.$starttime.' and a.adddate<'.$endtime;

		}


        $moneyAay = $db_order->getAll($where,'a.actual_amount,a.distribute_commission,a.distribute_amount');
        $allcmoney = 0;
        $othermoney = 0;
        foreach($moneyAay as $k =>$v){
            $allcmoney+= $v['actual_amount'];
            $othermoney+= $v['distribute_amount'];
        }
        $options = $db_order->getOptions('10',$where);//分页参数设置
        $page    = Page($options);
        $values  = $db_order->getPage($page,'a.adddate desc',$where,'a.*,b.title');


        include CURR_VIEW_PATH.'Distribution/distributioner.php';
        return;











      $db_member = M('common_user_member');
      $db_order  = M('app_order');
      $db_orderInfo = M('app_order_info');
      $now_page = ChkClng(KS_S('p',1));
      $option = ChkClng(KS_S('option','1'));
      $where = ' as a left join '.$db_member->table.' as b on a.distributeid = b.userid where a.wxid = '.$this->wxid.' and a.distributeid!=0';
      $keytype = ChkClng(KS_S('keytype','1'));
      $keyword = ChkSQL(KS_S('keyword'));
      $timetype= ChkClng(KS_S('timetype',4));
      if($keyword){
      	if($keytype==1){
      		$where = $where.' and b.name like "%'.$keyword.'%"';
      	}elseif($keytype==2){
      		$where = $where.' and a.title like "%'.$keyword.'%"';
      	}

      }
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
		}elseif($option==5){
		  $starttime=null !==GF('starttime') ? GF('starttime'):0;
		  $endtime=null !==GF('endtime') ? GF('endtime'):0;
	      $start=date('Y/m/d  h:i:s',$starttime);
	      $end=date('Y/m/d  h:i:s',$endtime);
	      $where .= ' and a.adddate>'.$starttime.' and a.adddate<'.$endtime;

		}
	  $moneyAay = $db_orderInfo->getAll($where,'a.price,a.commission');
      $allcmoney = 0;
      $othermoney = 0;
      foreach($moneyAay as $k =>$v){
      	$allcmoney+= $v['price'];
      	$othermoney+= floor($v['commission']*0.01*getPoundage($this->wxid,$v['price'])*100)/100;
      }
      $options = $db_orderInfo->getOptions('10',$where);//分页参数设置
      $page    = Page($options);
      $values  = $db_orderInfo->getPage($page,'a.adddate desc',$where,'a.*,b.name as distribute');


      foreach ($values as $key => $v) {
        $values[$key]['name'] = $db_member->getOne('name','where userid='.$v['memberid']);
      }
      include CURR_VIEW_PATH.'Distribution/distributioner.php';
    }
}