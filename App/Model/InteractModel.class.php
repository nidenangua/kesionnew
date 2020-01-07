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
class InteractModel extends Model{ 
	//互动//签到查看
	public function signLook($Data001){
		$signid       = $Data001['signid'];
		$class        = $Data001['class'];
		$studentModel = M('app_class_sign_record');
		$signModel    = M('app_class_sign');
		$sign         = $signModel->getRow(' where wxid='.$Data001['wxid'].' and id='.$signid.' limit 1 ');
		$userModel    = M('common_user');
		$memberModel  = M('common_user_member');
		$where = ' as a left join '.$userModel->table.'  as b on a.memberid=b.userid left join '.$memberModel->table.' as c on c.userid=a.memberid  where  a.classid='.$Data001['classid'].' and a.signid= '.$signid;
		$status     = null !== GF('status') ? GF('status'):0;
		if($status!= 0){$where.=' and a.status='.$status;}
		$keyword = KS_S('keyword');
	    if(!empty($keyword)){$where.=" and c.name like '%$keyword%'";}
		$options = $studentModel->getOptions($Data001['maxPerPage'],$where);//分页参数设置
		if(isset($Data001['now_page'])){
			$options['now_page'] = $Data001['now_page'];
		}else{
			$options['now_page'] = null !==GF('p') ? GF('p'):'1';
		}
		$page    = Page($options);
		$student = $studentModel->getPage($page,'a.id asc',$where,'c.emergencyContact,c.emergencyContactTel,b.email,c.name,b.username,b.userid,b.mobile,a.id,a.status,a.remake');
		$result['page']     = $page;
		$result['student']  = $student;
		$result['sign']     = $sign;
		return $result;
	}
	//进入增加游戏页面
	public function doAddyouxi($Data002){
		$istime   =  ChkSQL(null !==GF('istime') ? GF('istime'):'0');
		$isonline =  ChkSQL(null !==GF('isonline') ? GF('isonline'):'0');
		$ismode   =  ChkSQL(null !==GF('ismode') ? GF('ismode'):'0');
		$tab      =  ChkSQL(null !==GF('tab') ? GF('tab'):'1');
		$option   =  ChkSQL(null !==GF('option') ? GF('option'):'0');
		$where    = 'where del =1 and isuse = 1';
		if($Data002['wxid'] == 2){$where  = 'where del =1';}
		if($tab == 1){
			if($option==1){$where .= ' and  isuses=1';}
		}elseif($tab == 2){
			if($option == 0){$where .= ' and  istime!=0';}
		}
		if($option>=200 && $option<300){$where .= ' and  istime='.$istime;}
		if($option>=300){$where .= ' and  ismode='.$ismode;}
		$ispad =  ChkSQL(null !==GF('ispad') ? GF('ispad'):'0');
		if($ispad == 1){$where .= ' and  ispad='.$ispad;}
		$keytype = ChkClng(KS_S('keytype'));
		$keyword = KS_S('keyword');
		if(!empty($keyword)){
			if($keytype==1){$where .= " and  h5name like '%".$keyword."%'";}
		}
		$app_h5_market = M('app_h5_market');
		$now_page      = ChkClng(KS_S('p',1));
		$options       = $app_h5_market->getOptions($Data002['maxPerPage'],$where);//分页参数设置
		if(isset($Data002['now_page'])){
			$options['now_page'] = $Data002['now_page'];
		}else{
			$options['now_page'] = null !==GF('p') ? GF('p'):'1';
		}
		$page          = Page($options);
		$h5s           = $app_h5_market->getPage($page,'ishot desc,id desc',$where);
		foreach($h5s as $k =>$v){
			$h5_rule             = M('app_h5_rule');
			$info                = $h5_rule->getRow('where h5id='.$v['id'].' and wxid=2');
			$h5s[$k]['h5id']     = $info['id'];
			$h5s[$k]['url1']     = '/home.html/default/WeChat/createH5/'.$v['id'];
		}
		$festival  = M('app_festival');
		$festivals = $festival->getAll();
		
		$result['page']          = $page;
		$result['h5s']           = $h5s;
		$result['festivals']     = $festivals;
		return $result;
	}
	//进入增加游戏页面
	public function scheme($Data003){
		$Mode              = M('app_scheme');
		$values            = $Mode->getAll('where isuse = 1');
		$website           = $this->cache->GetHCache('website',$Data003['wxid']);
        $package           = $website['package'];
		//读取对应的list
		foreach($values as $k =>$v){
			$schemeinfo    = M('app_h5_scheme')->getAll('where type='.$v['id'].' and del =1  order by ishot');
			foreach($schemeinfo as $kt=>$vt){
				$schemeinfo[$kt]['url'] = '/home.html/default/WeChat/schemeinfo/'.$vt['id'];
			}
			$list[$k] = $schemeinfo;
		}
		$result['list']          = $list;
		$result['package']       = $package;
		$result['values']        = $values;
		return $result;
	}
	//进入我的游戏主页
	public function h5market($Data004){
		$now_page = ChkClng(KS_S('p',1));
		$keytype  = ChkClng(KS_S('keytype'));
		$keyword  = KS_S('keyword');
		$stype    = ChkSQL(null !==GF('stype') ? GF('stype'):'3');
		$app_h5_market = M('app_h5_market');
		$where  = 'where wxid ='.$Data004['wxid'].' and nowtype = 1';
		if($stype !=3){$where .= ' and isstar = '.$stype;}
		if($keytype==1){$where.="  and  name like '%".$keyword."%'";}
		/**************排序参数接收*************/	
		$partake = ChkSQL(null !==GF('partake') ? GF('partake'):'1');
		$turnover = ChkSQL(null !==GF('turnover') ? GF('turnover'):'1');
		$addtime =ChkSQL(null !==GF('addtime') ? GF('addtime'):'1');
		/**************排序参数接收*************/
		/*---------     排序相关-----------*/
		$orderby[GN('partake')]  = 'partake/partake';
		$orderby[GN('turnover')] = 'turnover/turnover';
		$orderby[GN('addtime')]  = 'addtime/adddate';
		/*---------     排序相关-----------*/
		$app_h5_rule = M('app_h5_rule');
		$options     = $app_h5_rule->getOptions($Data004['maxPerPage'],$where);//分页参数设置
		if(isset($Data004['now_page'])){
			$options['now_page'] = $Data004['now_page'];
		}else{
			$options['now_page'] = null !==GF('p') ? GF('p'):'1';
		}
        $page        = Page($options);
        //$filename = createQRcode(ROOT.'test/',$qr_data='https://www.baidu.com','L',4,'qrcode');
    	//$pic      = UOOT.'test/'.$filename;
    	//var_dump($pic);exit;
    	 //echo "<img src='".$pic."'>";exit;
		$values = $app_h5_rule->getPage($page,OB($orderby),$where);
		if(!isset($values)){$values = array();
		}else{
			foreach($values as$k =>$v){
				$values[$k]['setting'] = unserialize($v['setting']);
			}
		}
		$result['page']          = $page;
		$result['values']        = $values;
		return $result;
	}
	//查看活动方案详情 
	public function schemeinfo($Data005){
		$id            = ChkClng(KS_G('request.id'))!=0 ? ChkClng(KS_G('request.id')):'1';
		$app_h5_scheme = M('app_h5_scheme');
		$info          = $app_h5_scheme->getRow('where id ='.$id);
		$package       = '';
		if($info['marketing'] == 2){
			$website           = $this->cache->GetHCache('website',$Data005['wxid']);
        	$package           = $website['package'];
        	if($package<$info['package']){KS_INFO ('对不起,你的套餐等级不足,请先升级套餐',3,$url1);}
		}
		$result['package']       = $package;
		$result['info']          = $info;
		return $result;
	}
	//查看活动方案详情 
	public function createH5($Data006){
		$id            = ChkClng(KS_G('request.id'))!=0 ? ChkClng(KS_G('request.id')):'1';
		$app_h5_scheme = M('app_h5_scheme');
		$info          = $app_h5_scheme->getRow('where id ='.$id);
		$package       = '';
		if($info['marketing'] == 2){
			$website           = $this->cache->GetHCache('website',$Data005['wxid']);
        	$package           = $website['package'];
        	if($package<$info['package']){KS_INFO ('对不起,你的套餐等级不足,请先升级套餐',3,$url1);}
		}
		$result['package']       = $package;
		$result['info']          = $info;
		return $result;
	}
}