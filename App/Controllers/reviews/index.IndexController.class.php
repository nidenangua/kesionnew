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
//前端的评价控制器
class IndexController extends CommonController
{
     public function indexAction(){
		$info = $this->cache->GetHCache('website',$GLOBALS['_DoM']['wxid']);//读出缓存
		$isquestion = getSetting(7,$info['setting']);
		if($isquestion == 0){KS_INFO('未开通',4);}
		$where ='where userid ='.$GLOBALS['_DoM']['wxid'];
        $options = $this->AppModel->getOptions('2',$where);//分页参数设置
		$page = Page($options);
		$values = $this->AppModel->getPage($page,'adddate desc',$where);
		$this->assign('id',7);
		$this->display('question/index.html'); 
     }
	 //进入问题添加
	 public function addReviewsAction(){
		check_login($this->memberinfo);//检查是登录权限
		$courseid = ChkClng(KS_G("request.id"));//课程id
		
		$ordersn = ChkSQL(null !==GF('ordersn') ? GF('ordersn'):'');
		if(!empty($ordersn)){
			$order_courses = M('app_order_info');
			$dt = $order_courses->getAll('where wxid='.$GLOBALS['_DoM']['wxid'].' and memberid='.$this->memberid.' and ordersn ='.$ordersn);
			foreach($dt as $k=>$v)
			{
				$dt[$k]['buytime'] = $v['adddate'];//分页参数设置
			}
		}else{
			$app_course = M('app_course');
			$value = $app_course->getRow('where wxid='.$GLOBALS['_DoM']['wxid'].' and courseid ='.$courseid.' limit 1');
			if(empty($value)){
				$this->assign('getMessage','没有该课程');
	            $this->display('404.html');
			}
			if(!empty($courseid))
			{
				 if($value['status']!=2){
					 $this->assign('getMessage','该课程已下架');
	                 $this->display('404.html');
				 } 
				 $havecourses = $this->cache->GetU('havecourses','courseid',$courseid,'',$this->memberid,true);//读出缓存
				 if($havecourses['paystatus']!=1||$havecourses['reviewsid']!=0){KS_INFO('您已经评价过了',5);}//throw new Exception('您已经评价过了');
				 $dt[0] = $value;//分页参数设置
				 $dt[0]['buytime'] = $havecourses['adddate'];//分页参数设置
			}
		}
		$this->assign('dt',$dt);
		$this->display('reviews/addreviews.html'); 
     }
	 //进行增加
	 public function doaddReviewsAction(){
		//检查是登录权限
		check_login($this->memberinfo);
		$courseid = ChkSQL(KS_G("post.courseid"));
		$star = ChkSQL(KS_G("post.star"));
		$reviews = ChkSQL(KS_G("post.reviews"));
		$Data['appid'] = APPID;
		$Data['userid'] = $GLOBALS['_DoM']['wxid'];
		$Data['memberid'] = $this->memberid;
		$Data['membername'] = $this->memberinfo['username'];
		$Data['adddate'] = time();
		$app_course = M('app_course');
		$app_order_info = M('app_order_info');
		foreach($courseid as $k=>$v)
		{
			$Data['courseid'] = $v;
			$Data['reviews'] = $reviews[$k];
			$Data['star'] = $star[$k];
			$Data['grade'] = ChkSQL(KS_G('post.grade'.$v)); 
			$DataThree['reviewsid'] = $this->AppModel->doAdd($Data,'reviewsid');
			$app_order_info->update($DataThree,"paystatus=1 and userid=$this->memberid and courseid=$v");
			
			$reviewsNum = $this->AppModel->getOne('count(*)','where appid='.APPID.' and wxid='.$GLOBALS['_DoM']['wxid'].' and memberid='.$this->memberid.' and courseid='.$v);
			$goodNum = $this->AppModel->getOne('count(*)','where grade=0 and appid='.APPID.' and wxid='.$GLOBALS['_DoM']['wxid'].' and memberid='.$this->memberid.' and courseid='.$v);
			$middleNum = $this->AppModel->getOne('count(*)','where grade=1 and appid='.APPID.' and wxid='.$GLOBALS['_DoM']['wxid'].' and memberid='.$this->memberid.' and courseid='.$v);
			
			$attribute = $app_course->getOne('attribute','where wxid='.$GLOBALS['_DoM']['wxid'].' and courseid='.$v);
			$attribute = explode('※',$attribute);
		    $attribute[0] = number_format($goodNum/$reviewsNum*100, 2);//好评率
			$attribute[1] = number_format($middleNum/$reviewsNum*100, 2);//中评率
			$attribute[2] = number_format(100-$attribute[0]-$attribute[1], 2);//差评率
		    $DataTwo['attribute'] = implode('※',$attribute);
            $app_course->update($DataTwo,'wxid='.$GLOBALS['_DoM']['wxid'].' and courseid='.$v);
			
		}
		$this->cache->PutUCache('havecourses',$this->memberid);
		KS_INFO('评价成功',5);
	 }	
}