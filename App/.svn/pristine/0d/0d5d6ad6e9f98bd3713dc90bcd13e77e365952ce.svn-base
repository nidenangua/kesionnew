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
    //进入游戏主页
	public function indexAction(){
		$now_page = ChkClng(KS_S('p',1));
		$keytype  = ChkClng(KS_S('keytype'));
		$keyword  = KS_S('keyword');
		$stype    = ChkSQL(null !==GF('stype') ? GF('stype'):'3');
		$partake  = ChkSQL(null !==GF('partake') ? GF('partake'):'1');
		$turnover = ChkSQL(null !==GF('turnover') ? GF('turnover'):'1');
		$addtime  = ChkSQL(null !==GF('addtime') ? GF('addtime'):'1');
		$Data004['maxPerPage'] = 15;
	    $Data004['wxid']       = $this->wxid;
		$ClassModel            = M('App/InteractModel');
		$result                = $ClassModel->h5market($Data004);
		$page                  = $result['page'];
		$values                = $result['values'];
       	include  CURR_VIEW_PATH . "index.php";
	}
    //游戏单个删除
	public function delYouxiAction(){
		$id = ChkClng(KS_G('get.id'));
		$now_page =  ChkClng(KS_S('p',1));
        $app_h5_connect = M('app_h5_rule');
        $info = $app_h5_connect->getOne('setting','where id='.$id);
        $setting = unserialize($info);
        $file= $setting['h5index'];
        if(file_exists($file))
		{
		    unlink($file);
		}
	    $app_h5_connect->delete("id = $id");
	    M('app_h5_rulereward')->delete('h5id='.$id.' and openid is null');
	    M('app_h5_user')->delete('h5id='.$id);
        $url=M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
		KS_INFO("删除成功",0,$url);
	}
	//游戏卡全删除
	public function bathDelYouxiAction(){
		$ids = ChkSQL(KS_G('post.id'));
		$now_page =  ChkClng(KS_S('p',1));
		$app_h5_connect = M('app_h5_rule');
        foreach ($ids  as $id){
           $app_h5_connect->delete("id = $id");
           $info = $app_h5_connect->getOne('setting','where id='.$id);
	       $setting = unserialize($info);
        	$file= $setting['h5index'];
	       if(file_exists($file))
			{
			    unlink($file);
			}
		   $app_h5_connect->delete("id = $id");
		   M('app_h5_rulereward')->delete('h5id='.$id);
		   M('app_h5_user')->delete('h5id='.$id);
          }
		$url=M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
		KS_INFO("删除成功",0,$url);
	}
    //设置游戏进入数据库
	public function editStrategyAction(){
		$ruleid = ChkClng(KS_G('post.ruleid'));
        $app_h5_rule = M('app_h5_rule');
         $Data['name'] = ChkSQL(KS_G('post.name'));
        //查找introduction并进行操作
        $Lis = ChkSQL(KS_G('post.introduction'));
        $introduction = $app_h5_rule->getOne('introduction','where id ='.$ruleid ." and wxid = " .$this->wxid);
        $introduction = json_decode($introduction,true);
         // var_dump($introduction);exit;
        foreach($introduction as $k=>$v){
           $introduction[$k]['value'] = $Lis[$k];
		}
        $Data['introduction'] = json_encode($introduction,320);
       	// var_dump($Data['introduction']);exit;
        //查找setting并进行操作
        $List = ChkSQL(KS_G('post.content'));
        $setting = $app_h5_rule->getOne('setting','where id ='.$ruleid ." and wxid = " .$this->wxid);
		$setting = json_decode($setting,true);
        foreach($setting as $k=>$v){
           $setting[$k]['value'] = $List[$k];
		}
        $Data['setting'] = json_encode($setting,320);
        $Data['userid'] = $this->userid;
		$Data['wxid'] = $this->wxid;
		$Rule['introduction'] = '说明|isEmpty';
        $Rule['setting'] = '设置|isEmpty';
		Chkpost($Data,$Rule,$this->AppModel);
        $app_h5_rule = M('app_h5_rule');
        $url1= M_URL($this->AppName.'/Index','index',"",GP(""));
        $app_h5_rule->update($Data,'id='.$ruleid);
		KS_INFO('修改成功',0,$url1);
   }
	public function H5userinfoAction(){
		//获取id
		$id = ChkClng(KS_G("get.id"));//接受用户需要创建的活动ID
		$h5_user = M('app_h5_user');
		$where = '';
		$now_page =  ChkClng(KS_S('p',1));
		$keytype = ChkClng(KS_S('keytype'));
		$keyword = KS_S('keyword');
		$where .= 'where wxid ='.$this->wxid.' and h5id='.$id.' and openid is not null';
		if($keytype==1)
		{
			$where.="  and  nickname like '%".$keyword."%'";
		}
//  	var_dump($where);
		$h5_rule = M('app_h5_rule');
		$info=$h5_rule->getRow('where id='.$id);
		if($info['ismode'] == 2){
			if($info['modetype']==2){$where .=' group by groupid';}
		}
    	$options = $h5_user->getOptions('5',$where,'*');//分页参数设置
        $page    = Page($options);
		$values  = $h5_user->getPage($page,'id desc',$where,'*');
		/******查询原先设置*******/
		$Mode = M('app_h5_rule');
		$h5info = $Mode->getRow('where id='.$id);
		$setting = unserialize($h5info['setting'])['collectInfo'];

		$list = explode("/&/",$setting);
		/******查询原先设置*******/
		include  CURR_VIEW_PATH . "userinfo.php";
	}
	public function cjgameAction(){

		$staus = 0;
		$id = ChkClng(KS_G("get.id"));//接受用户需要创建的活动ID
		$app_h5_market = M('app_h5_market');
		$h5 = $app_h5_market->getRow('where id ='.$id);
		$flag = 0;
		$flagnum = 0;
		$url1= M_URL($this->AppName.'/Index','doAddyouxi',$id,GP(""));
		$str = '免费活动，不限制次数使用';
		if($h5['marketing'] == 1){
			//这时候是收费模式的H5，先去订单表查询是否有这个东西
			$order = M('common_order_info');
			$infos = $order->getAll('where wxid='.$this->wxid.' and type =5 and paystatus=1');
			foreach($infos as $key =>$v){
				if($v['appid'] = $id){
					$flag++;
					$flagnum = $v['number'];
				}
			}
			if($flag ==0){
				KS_INFO ('对不起你没购买该活动',3,$url1,'',1);
			}else{
				if($flagnum <=0){
					KS_INFO ('对不起你可使用次数不足，请充值',3,$url1,'',1);
					exit;
				}
			}
			$str = '剩余使用次数:'.$flagnum;
		}elseif($h5['marketing'] == 2){
			$website           = $this->cache->GetHCache('website',$GLOBALS['_DoM']['wxid']);
        	$package           = $website['package'];
        	if($package<$h5['package']){
        		KS_INFO ('对不起你的套餐等级不足，请先升级套餐',3,$url1,'',1);
        	}else{
        		$str = $h5['package'].'以上用户免费使用';
        	}
		}
		//分割规则，奖励规则由后台录入数据库控制,XML为基础规则
		$reward = explode('|',$h5['reward']);
		//通过XML文件读取活动配置
		$xml_array=simplexml_load_file(ROOT.$h5['xml']);
		//拆分内容一下 由于XML admin 是写入数据库的所以无视只要home下的内容
		$home = $xml_array->home;
		$gy = $home->gy;//获取相关功能介绍
		$zd = $home->zd;//活动需要的字段；
		//读取完毕，加载页面，对页面进行填充！，这里需要封装一个方法来判断input框是什么类型
		$rewards = array();
		$rewardNumber  = array();
		$Rsetting = array();
//		var_dump($xml_array);
		include  CURR_VIEW_PATH . "youxi.php";
	}
	public function editgameAction(){
		$staus = 1;
		$h5id = ChkSQL(null !==GF('h5id') ? GF('h5id'):'');
		$app_h5_market = M('app_h5_market');
		$h5 = $app_h5_market->getRow('where id ='.$h5id);
		$flag = 0;
		$flagnum = 0;
		$url1= M_URL($this->AppName.'/Index','index','',GP(""));
		$str = '免费活动，不限制次数使用';
		if($h5['marketing'] == 1){
			//这时候是收费模式的H5，先去订单表查询是否有这个东西
			$order = M('common_order_info');
			$infos = $order->getRow('where wxid='.$this->wxid.' and type =5 and paystatus=1');
			foreach($infos as $key =>$v){
				if($v['appid'] = $h5id){
					$flag++;
					$flagnum = $v['number'];
					$sid = $v['id'];
				}
			}
			if($flag ==0){
				KS_INFO ('对不起你没购买该活动',3,$url1,'',1);
			}else{
				if($flagnum <=0){
					KS_INFO ('对不起你可使用次数不足，请充值',3,$url1,'',1);
					exit;
				}else{

					$flagnum --;
					$Data['number'] = $flagnum;
					$order->update($Data,'id='.$id);
				}
			}
			$str = '剩余使用次数:'.$flagnum;
		}elseif($h5['marketing'] == 2){
			$website           = $this->cache->GetHCache('website',$this->wxid);
        	$package           = $website['package'];
        	if($package<$h5['package']){
        		KS_INFO ('对不起你的套餐等级不足，请先升级套餐',3,$url1,'',1);
        	}else{
        		$str = $h5['package'].'以上用户免费使用';
        	}
		}
		//分割规则，奖励规则由后台录入数据库控制,XML为基础规则
		$reward = explode('|',$h5['reward']);
		$id = KS_G('get.id');
		$h5_rule = M('app_h5_rule');
		$h5info= $h5_rule->getRow('where id='.$id);
		$setting = unserialize($h5info['setting']);
		$Rsetting = unserialize($h5info['reward']);
		$xml_array=simplexml_load_file(ROOT.$h5['xml']);
		//拆分内容一下 由于XML admin 是写入数据库的所以无视只要home下的内容
		$home = $xml_array->home;
		$gy = $home->gy;//获取相关功能介绍
		$zd = $home->zd;//活动需要的字段；
		//获取奖励相关数组
		$h5_reward = M('app_h5_rulereward');
		$rewards = $h5_reward->getAll('where h5id='.$id.' group by level order by id');
		$rewardNumber = $h5_reward->getAll('where h5id='.$id.' group by level order by id','count(level) as number');
		include  CURR_VIEW_PATH . "youxi.php";
	}
	public function AddGameAction(){
		$app_h5_market = M('app_h5_market');
		$id = ChkClng(KS_G("post.id"));//接受用户需要创建的活动ID
		//去查这个活动属于什么类型的
		$Data['ismode']=$ismode = $app_h5_market->getOne('ismode','where id='.$id);
		$Data['modetype']=$modetype = $app_h5_market->getOne('modetype','where id='.$id);
		$h5id = ChkClng(KS_G('post.h5id'));
		$url1= M_URL($this->AppName.'/Index','cjgame',$id,GP("appid-26"));
		$img = XImg(KS_G("post.forwardingImg"));
		$yz = strpos($img,'https://');
		if($yz ===false){
			$img = strstr($img, 'Images/');
			$ss  = getimagesize($img);
		}else{
			$ss = getimagesize($img);
		}
		if($ss[0]<300 || $ss[1]<300){KS_INFO ('选择图片大小不符合300*300请重新选择',0,'','',1);}
		$num    = KS_G('post.rewardNum');
		if($num <=0){KS_INFO ('奖励数量不能为0',0,'','',1);exit;}
		$rewardType = KS_G('post.rewardType');//奖励类型
		$infoid     = KS_G('post.infoid');//info金额
		$money = KS_G('post.money');//抵扣金额
		foreach ($rewardType as $kt => $vt) {
			if($vt == 1 || $vt == 2 || $vt == 3 || $vt == 4 || $vt == 5 || $vt == 6 || $vt == 7){
				if(is_array($infoid)){
					foreach($infoid as $k =>$v){
						if(empty($v)){
							KS_INFO ('奖励不能为空',0,'','',1);
						}
					}
				}else{
					if(empty($infoid)){
						KS_INFO ('奖励不能为空',0,'','',1);
					}
				}
			}elseif($vt == 8){
				if(is_array($money)){
					foreach($infoid as $k =>$v){
						if(empty($v)){
							KS_INFO ('奖励不能为空',0,'','',1);
						}
					}
				}else{
					if(empty($money)){
						KS_INFO ('奖励不能为空',0,'','',1);
					}
				}
			}else{
				KS_INFO ('请填写所有奖励',0,'','',1);
			}
		}

		$Data['ico'] =  $app_h5_market ->getOne('ico','where id='.$id);
		$Data['startime'] = strtotime(KS_G("post.startime"));
		$Data['endtime'] = strtotime(KS_G("post.endtime"));
		$Data['number'] = KS_G("post.number");
    	$Data['wxid'] = $this->wxid;
    	$Data['h5id'] = $id;
    	$Data['name'] =  KS_G("post.name");
    	$Data['introduction']  =  KS_G("post.instruction");
    	/*------------设置setting的相关配置------------*/
    	$newpost['title'] = $_POST['forwardingHeader'];
    	$newpost['img'] = $_POST['forwardingImg'];
    	$newpost['desc'] = $_POST['forwardingInstructions'];
    	$newpost['addparticipantsNumber'] =$_POST['addparticipantsNumber'];//是否显示参与人数 0 不显示
    	$newpost['participantsNumber'] =$_POST['participantsNumber'];//参与人数 0
    	$newpost['numberLimit'] = $_POST['numberLimit'];//是否限制参与人数 0 不限制 1 限制
    	$newpost['numberLimitValue'] = $_POST['numberLimitValue'];//限制的数量
    	$newpost['displayCampus'] = $_POST['displayCampus'];//是否显示校区
    	$newpost['campus'] = $_POST['campus'];//绑定的校区
    	$url = $app_h5_market ->getOne('url','where id='.$id);
    	$file =$url.'index_'.$this->wxid.rand(10000,99999).'.html';
    	$newpost['h5index'] = $file;//编辑用的文件路劲
    	$newpost['collectInfo'] = $_POST['collectInfo'];//需要收集的信息;
    	$newpost['collectInfoSwitch'] = $_POST['collectInfoSwitch'];//需要收集的信息;
    	/*------------设置setting的相关配置------------*/

    	$newpost['type'] = 1;
    	$Data['setting'] = serialize($newpost);//序列化存储
    	$Data['adddate'] = time();
    	//设置奖励的一些配置
    	$team =  KS_G('post.team');//奖励类型
		$teammoney = KS_G('post.teammoney');
		$specialPrice = KS_G('post.specialPrice');
		$rewardpeple = KS_G('post.rewardpeple');
		if($ismode ==2 && $modetype !=3){
			$settingR['team'] = $team;
			$settingR['teammoney'] = $teammoney;
			$settingR['rewardpeple'] = $rewardpeple;
			$settingR['specialPrice'] = $specialPrice;
			$Data['reward'] = serialize($settingR);//序列化把奖励的一些配置存储进去
		}elseif($ismode ==2 && $modetype ==3){
			$settingR['fishnum'] = KS_G('post.fishnum');
			$Data['reward'] = serialize($settingR);//序列化把奖励的一些配置存储进去
		}
    	//针对XML的字段先不任何处理，直接存入数据库，等用户开始对应的活动后在修改；
    	$app_h5_rule = M('app_h5_rule');
    	$Data['nowtype'] = 1;
    	$h5id = $app_h5_rule->doAdd($Data,'id');
    	$app_h5_rulereward = M('app_h5_rulereward');
    	//开始处理奖励相关
    	if($ismode ==2 && $modetype !=3){
    		if($modetype==1){
	    		$infoname   =  KS_G('post.infoname');//info名称
	    		$originalPrice = KS_G('post.originalPrice');
	    		$Datas['h5id'] = $h5id;
				$Datas['rewardType']  = $rewardType;
				$Datas['code'] = 'A'.$this->wxid.time().rand(1000,9999);
	    		$Datas['name'] = $infoname;
	    		$Datas['infoid']= $infoid;
	    		$Datas['originalPrice']= $originalPrice;
	    		for($i = 1;$i<=$num;$i++){
		    		$app_h5_rulereward->doAdd($Datas,'id');
	    		}
	    	}elseif($modetype ==2 || $modetype==4){
	    		$num = KS_G('post.rewardNum');
	    		if($num <=0){KS_INFO ('奖励数量不能为0',0,'','',1);exit;}
	    		$rewardType = KS_G('post.rewardType');//奖励类型
	    		$infoid = KS_G('post.infoid');//info金额
	    		if(empty($infoid)){KS_INFO ('请选择奖励',0,'','',1);exit;}
	    		$infoname  =  KS_G('post.infoname');//info名称
	    		$originalPrice = KS_G('post.originalPrice');
	    		$Datas['money'] = $specialPrice;
	    		$Datas['h5id'] = $h5id;
				$Datas['rewardType']  = $rewardType;
				$Datas['code'] = 'A'.$this->wxid.time().rand(1000,9999);
	    		$Datas['name'] = $infoname;
	    		$Datas['infoid']= $infoid;
	    		if($modetype == 2){
	    			$Datas['specialPrice']= $originalPrice;
	    		}else{
	    			$Datas['specialPrice']= $specialPrice;
	    		}
	    		$Datas['originalPrice']= $originalPrice;
	    		for($i = 1;$i<=$num;$i++){
		    		$app_h5_rulereward->doAdd($Datas,'id');
	    		}
	    	}
    	}else{
	    	$reward = KS_G('post.reward');//奖励名称
	    	$isConsolationAward = KS_G('post.isConsolationAward');
	    	$originalPrice = KS_G('post.originalPrice');
	    	$specialPrice = KS_G('post.specialPrice');
	    	$redemptionTips = KS_G('post.redemptionTips');
	    	$redemptionStartTime= KS_G('post.redemptionStartTime');
	    	$redemptionEndTime = KS_G('post.redemptionEndTime');
	    	$prizeDesc = KS_G('post.prizeDesc');
	    	$infoname  =  KS_G('post.infoname');//info金额
	    	$Datas['h5id'] = $h5id;
	    	$flag = 0;
			$flag1 =0;
			$flag2=0;
			$flag3=0;
	    	foreach($num as $k =>$v){
	    		$Datas['code'] = 'A'.$this->wxid.time().rand(1000,9999);
	    		$Datas['name'] = $reward[$k];
	    		$Datas['rewardType']  = $rewardType[$k];
	    		$Datas['isConsolationAward']  = $isConsolationAward[$k];
	    		if($isConsolationAward[$k]==1){
	    			$Datas['redemptionMethodComfort'] = KS_G('post.isConsolationAward');
	    			$Datas['awardDateComfort'] = KS_G('post.awardDateComfort');
	    			$Datas['redemptionMethod'] = KS_G('post.redemptionMethod');
	    			$Datas['awardDate'] = KS_G('post.awardDate');
	    			$Datas['level'] = 0;
	    		}else{
	    			$Datas['redemptionMethodComfort'] = KS_G('post.isConsolationAward'.$k);
	    			$Datas['awardDateComfort'] = KS_G('post.awardDateComfort'.$k);
	    			$Datas['redemptionMethod'] = KS_G('post.redemptionMethod'.$k);
	    			$Datas['awardDate'] = KS_G('post.awardDate'.$k);
	    			$Datas['level'] = $k;
	    		}
	    		$Datas['redemptionStartTime'] = strtotime($redemptionStartTime[$k]);
	    		$Datas['redemptionEndTime'] = strtotime($redemptionEndTime[$k]);
	    		$Datas['redemptionTips'] = $redemptionTips[$k];
	    		$Datas['wxid'] = $this->wxid;
	    		if($rewardType[$k] ==7){
	    			$Datas['money'] = $money[$flag1];
	    			$Datas['infoid'] = 0;
	    			$Datas['rewardname'] ='优惠券:￥'.$money[$flag1];
	    			$flag1++;
	    		}else{
	    			$Datas['money'] = 0;
	    			$Datas['infoid'] = $infoid[$flag];
	    			$Datas['rewardname']= $infoname[$flag] ;
	    			$Datas['originalPrice'] = $originalPrice[$flag3];
	    			$Datas['specialPrice'] = $specialPrice[$flag3];
	    			$flag++;
	    			$flag3++;
	    		}

	    		for($i=0;$i<$v;$i++){
	    			$app_h5_rulereward->doAdd($Datas,'id');
	    		}
	    	}
	    }
    	$Datasb['numberwx'] = 'numberwx+1';
    	$sss = $app_h5_market ->update($Datasb,'id ='.$id,1);
    	if(file_exists($file)){unlink($file);}
		file_put_contents(ROOT.$file, $_POST['h5Content']);
    	$url1= M_URL($this->AppName.'/Index','index','',GP(""));
    	KS_INFO ('创建成功',3,$url1);
	}
	public function doedittGameAction(){
		$id   = ChkClng(KS_G("post.id"));//接受用户需要创建的活动ID
		$h5id = ChkClng(KS_G('post.h5id'));
		$url1 = M_URL($this->AppName.'/Index','editgame',$id,GP("appid-26,h5id=".$h5id));
		$img  = XImg(KS_G("post.forwardingImg"));
		$yz   = strpos($img,'https://');//验证是百度的图片还是本地的图片
		if($yz ===false){$ss = getimagesize(ROOT.$img);
		}else{$ss = getimagesize($img);}
		if($ss[0]<300 || $ss[1]<300){KS_INFO ('选择图片大小不符合300*300请重新选择',0,'','',1);}
		$app_h5_market = M('app_h5_market');
		$ismode = $app_h5_market->getOne('ismode','where id='.$h5id);
		$modetype = $app_h5_market->getOne('modetype','where id='.$h5id);
		$Data['ico'] =  $app_h5_market ->getOne('ico','where id='.$h5id);
		$Data['startime'] = strtotime(KS_G("post.startime"));
		$Data['endtime'] = strtotime(KS_G("post.endtime"));
		$Data['number'] = KS_G("post.number");
    	$Data['wxid'] = $this->wxid;
    	$Data['name'] =  KS_G("post.name");
    	$Data['introduction']  =  KS_G("post.instruction");
    	$num    = KS_G('post.rewardNum');
		if($num <=0){KS_INFO ('奖励数量不能为0',0,'','',1);exit;}
		$rewardType = KS_G('post.rewardType');//奖励类型
		$infoid     = KS_G('post.infoid');//info金额
		$money = KS_G('post.money');//抵扣金额
		if($rewardType == 1 || $rewardType == 2 || $rewardType == 3 || $rewardType == 4 || $rewardType == 5 || $rewardType == 6 || $rewardType == 7){
			if(is_array($infoid)){
				foreach($infoid as $k =>$v){
					if(empty($v)){
						KS_INFO ('奖励不能为空',0,'','',1);
					}
				}
			}else{
				if(empty($infoid)){
					KS_INFO ('奖励不能为空',0,'','',1);
				}
			}
		}elseif($rewardType == 0){
			if(is_array($money)){
				foreach($infoid as $k =>$v){
					if(empty($v)){
						KS_INFO ('奖励不能为空',0,'','',1);
					}
				}
			}else{
				if(empty($money)){
					KS_INFO ('奖励不能为空',0,'','',1);
				}
			}
		}
    	/*------------设置setting的相关配置------------*/
    	$newpost['title'] = $_POST['forwardingHeader'];
    	$newpost['img'] = $_POST['forwardingImg'];
    	$newpost['desc'] = $_POST['forwardingInstructions'];
    	$newpost['addparticipantsNumber'] =$_POST['addparticipantsNumber'];//是否显示参与人数 0 不显示
    	$newpost['participantsNumber'] =$_POST['participantsNumber'];//参与人数 0
    	$newpost['numberLimit'] = $_POST['numberLimit'];//是否限制参与人数 0 不限制 1 限制
    	$newpost['numberLimitValue'] = $_POST['numberLimitValue'];//限制的数量
    	$newpost['displayCampus'] = $_POST['displayCampus'];//是否显示校区
    	$newpost['campus'] = $_POST['campus'];//绑定的校区
    	$newpost['collectInfo'] =$_POST['collectInfo'];//判断是否开启信息收集
    	$url = $app_h5_market ->getOne('url','where id='.$id);
    	$file =KS_G('post.h5index');
    	$newpost['h5index'] = $file;//编辑用的文件路劲
    	$newpost['collectInfoSwitch'] = $_POST['collectInfoSwitch'];//需要收集的信息;
    	/*------------设置setting的相关配置------------*/
    	$Data['setting'] = serialize($newpost);//序列化存储
		//奖励表
		$app_h5_rulereward = M('app_h5_rulereward');
		$app_h5_rulereward->delete('h5id='.$id);
    	//开始处理奖励相关
    	if($ismode == 2 && $modetype !=3){
    		if($modetype==1){
	    		$team =  KS_G('post.team');//奖励类型
	    		$teammoney = KS_G('post.teammoney');
	    		$infoname      =  KS_G('post.infoname');//info名称
	    		$rewardpeple   = KS_G('post.rewardpeple');
	    		$originalPrice = KS_G('post.originalPrice');
	    		$specialPrice  = KS_G('post.specialPrice');
	    		//设置奖励的一些配置
	    		$settingR['team'] = $team;
	    		$settingR['teammoney'] = $teammoney;
	    		$settingR['rewardpeple'] = $rewardpeple;
	    		$settingR['specialPrice'] = $specialPrice;
	    		$Data['reward'] = serialize($settingR);//序列化把奖励的一些配置存储进去
	    		$Datas['h5id'] = $id;
				$Datas['rewardType']  = $rewardType;
				$Datas['code'] = 'A'.$this->wxid.time().rand(1000,9999);
	    		$Datas['name'] = $infoname;
	    		$Datas['infoid']= $infoid;
	    		$Datas['originalPrice']= $originalPrice;
	    		for($i = 1;$i<=$num;$i++){$app_h5_rulereward->doAdd($Datas,'id');}
    		}elseif($modetype ==2 || $modetype==4){
	    		$specialPrice = KS_G('post.specialPrice');
	    		$infoname  =  KS_G('post.infoname');//info名称
	    		$originalPrice = KS_G('post.originalPrice');
	    		$Datas['money'] = $specialPrice;
	    		$Datas['h5id'] = $id;
				$Datas['rewardType']  = $rewardType;
				$Datas['code'] = 'A'.$this->wxid.time().rand(1000,9999);
	    		$Datas['name'] = $infoname;
	    		$Datas['infoid']= $infoid;
	    		if($modetype == 2){
	    			$Datas['specialPrice']= $originalPrice;
	    		}else{
	    			$Datas['specialPrice']= $specialPrice;
	    		}
	    		$Datas['originalPrice']= $originalPrice;
	    		for($i = 1;$i<=$num;$i++){$app_h5_rulereward->doAdd($Datas,'id');}
	    	}
    	}else{
	    	$num = KS_G('post.rewardNum');
	    	$reward = KS_G('post.reward');//奖励名称
	    	$isConsolationAward = KS_G('post.isConsolationAward');
	    	$originalPrice = KS_G('post.originalPrice');
	    	$specialPrice = KS_G('post.specialPrice');
	    	$redemptionTips = KS_G('post.redemptionTips');
	    	$redemptionStartTime= KS_G('post.redemptionStartTime');
	    	$redemptionEndTime = KS_G('post.redemptionEndTime');
	    	$prizeDesc = KS_G('post.prizeDesc');
	    	$infoname  =  KS_G('post.infoname');//info金额
	    	$Datas['h5id'] = $id;
	    	$flag =0;$flag1=0;$flag2=0;$flag3=0;
	    	foreach($num as $k =>$v){
	    		$Datas['code'] = 'A'.$this->wxid.time().rand(1000,9999);
	    		$Datas['name'] = $reward[$k];
	    		$Datas['rewardType']  = $rewardType[$k];
	    		$Datas['isConsolationAward']  = $isConsolationAward[$k];
	    		if($isConsolationAward[$k]==1){
	    			$Datas['redemptionMethodComfort'] = KS_G('post.isConsolationAward');
	    			$Datas['awardDateComfort'] = KS_G('post.awardDateComfort');
	    			$Datas['redemptionMethod'] = KS_G('post.redemptionMethod');
	    			$Datas['awardDate'] = KS_G('post.awardDate');
	    			$Datas['level'] = 0;
	    		}else{
	    			$Datas['redemptionMethodComfort'] = KS_G('post.isConsolationAward'.$k);
	    			$Datas['awardDateComfort'] = KS_G('post.awardDateComfort'.$k);
	    			$Datas['redemptionMethod'] = KS_G('post.redemptionMethod'.$k);
	    			$Datas['awardDate'] = KS_G('post.awardDate'.$k);
	    			$Datas['level'] = $k;
	    		}
	    		$Datas['redemptionStartTime'] = strtotime($redemptionStartTime[$k]);
	    		$Datas['redemptionEndTime'] = strtotime($redemptionEndTime[$k]);
	    		$Datas['redemptionTips'] = $redemptionTips[$k];
	    		$Datas['wxid'] = $this->wxid;
	    		if($rewardType[$k] ==7){
	    			$Datas['money'] = $money[$flag1];
	    			$Datas['infoid'] = 0;
	    			$Datas['rewardname'] ='优惠券:￥'.$money[$flag1];
	    			$flag1++;
	    		}else{
	    			$Datas['money'] = 0;
	    			$Datas['infoid'] = $infoid[$flag];
	    			$Datas['rewardname']= $infoname[$flag] ;
	    			$Datas['originalPrice'] = $originalPrice[$flag3];
	    			$Datas['specialPrice'] = $specialPrice[$flag3];
	    			$flag++;
	    			$flag3++;
	    		}
	    		for($i=0;$i<$v;$i++){$app_h5_rulereward->doAdd($Datas,'id');}
	    	}
	    }
	    if($ismode ==2 && $modetype ==3){
			$settingR['fishnum'] = KS_G('post.fishnum');
			$Data['reward']      = serialize($settingR);//序列化把奖励的一些配置存储进去
		}
    	//针对XML的字段先不任何处理，直接存入数据库，等用户开始对应的活动后在修改；
    	$app_h5_rule = M('app_h5_rule');
    	$Data['nowtype'] = 1;
    	$app_h5_rule->update($Data,'id='.$id);
    	if(file_exists($file)){unlink($file);}
		file_put_contents(ROOT.$file, $_POST['h5Content']);
    	$url1= M_URL($this->AppName.'/Index','index','',GP(""));
    	KS_INFO ('修改成功',3,$url1);
	}
	public function starH5Action(){
		$id          = KS_G('post.id');
		$app_h5_rule = M('app_h5_rule');
		$info = $app_h5_rule->getRow('where id='.$id);
		if(intval($info['endtime']) < time()||intval($info['startime']) > time()){
			echo json_encode(array('errcode'=>'1000','msg'=>'开启失败，活动时间错误！'));
		}else{
			$Data['isstar'] = 1;
			$app_h5_rule->update($Data,'id='.$id);
			echo json_encode(array('errcode'=>'0','msg'=>'开启成功'));
		}
	}
	public function closeH5Action(){
		$id = KS_G('post.id');
		$app_h5_rule = M('app_h5_rule');
		$info = $app_h5_rule->getRow('where id='.$id);
		$Data['isstar'] =2;
		$app_h5_rule->update($Data,'id='.$id);
		echo json_encode(array('errcode'=>'0','msg'=>'关闭成功'));
	}
	//进入增加游戏页面
	public function doAddyouxiAction(){
		$istime   =  ChkSQL(null !==GF('istime') ? GF('istime'):'0');//节日
		$isonline =  ChkSQL(null !==GF('isonline') ? GF('isonline'):'0');//
		$ismode   =  ChkSQL(null !==GF('ismode') ? GF('ismode'):'0');//
		$tab      =  ChkSQL(null !==GF('tab') ? GF('tab'):'1');
		$option   =  ChkSQL(null !==GF('option') ? GF('option'):'0');//
		$ispad    =  ChkSQL(null !==GF('ispad') ? GF('ispad'):'0');
		$p        =  ChkSQL(null !==GF('p') ? GF('p'):'1');
		$Data002['maxPerPage'] = 12;
	    //$Data002['signid']     = ChkClng(KS_G('get.signid'));
		//$Data002['class']      = $class;
	   // $Data002['classid']    = $classid;
	    $Data002['wxid']       = $this->wxid;
		$ClassModel            = M('App/InteractModel');
		$result                = $ClassModel->doAddyouxi($Data002);
		$page                  = $result['page'];
		$h5s                   = $result['h5s'];
		$festivals             = $result['festivals'];
		include  CURR_VIEW_PATH . "gamelist.php";
	}
	//编辑游戏，第一次初始化。第二次开始从数据库调取数值
	public function doEditGameAction(){
		$init = GF('init');
		$xml = GF('xml');
		$h5id = GF('h5id');
        $app_h5_connect = M('app_h5_connect');
	    $app_h5_rule = M('app_h5_rule');
        $connectID = ChkClng(KS_G("get.id"));
        if($init ==1){
        $values = $app_h5_rule->getRow('where h5id ='.$h5id ." and wxid = ".$this->wxid);
		$H5name = $values['name'];
		$introduction=$values['introduction'];
		$setting=$values['setting'];
		$introGameVal = json_decode($introduction,TRUE);
		$setGameVal = json_decode($setting,TRUE);
		$getid= $values['id'];
        }else{
        $aaaa['init'] = 1;
        $app_h5_connect->update($aaaa,'id='.$connectID.' and wxid = '.$this->wxid);
        $xml=simplexml_load_file(ROOT.$xml);
        $H5name = $xml->admin->H5name;
		//游戏设置
		$setGame = $xml->home->zd;
        $setGameDatas= json_decode(json_encode($setGame),TRUE);
		$setGameData = $setGameDatas['item'];
        foreach($setGameData as $k=>$v){$setGameVal[]= $v['@attributes'];}
	    //游戏介绍
		$introGame = $xml->home->gy;
		$introGameDatas= json_decode(json_encode($introGame),TRUE);
        $introGameData = $introGameDatas['item'];
        foreach($introGameData as $k=>$v){$introGameVal[]= $v['@attributes'];}
        $app_h5_rule = M('app_h5_rule');
	    $Data['h5id'] =$h5id;
        $Data['name'] =$H5name;
		$Data['userid'] = $this->userid;
		$Data['wxid'] = $this->wxid;
        $Setting = json_encode($setGameVal,320);
        $Data['introduction'] = json_encode($introGameVal,320);
		$Data['setting'] = $Setting;
       	$getid= $app_h5_rule->doadd($Data,'id');
		}
		include  CURR_VIEW_PATH . "test.php";
    }
    //微信应用配置
	public function rewardAction(){
		$key = KS_G('post.key');
		$app_red_packet = 	M('app_course');
        $info = $app_red_packet ->getAll('where wxid='.$this->wxid.' and (status=2 or status=1) and price>0');
        if(!empty($info)){
            foreach($info as $k =>$v){
                $info[$k]['defaultpic'] =  Img($v['defaultpic']);
            }
        }
        echo json_encode($info);exit;
	}
	public function sendmassageAction(){
		$id = KS_G('post.id');
		$h5_user = M('app_h5_user');
		$info =$h5_user->getRow('where wxid='.$this->wxid.' and id='.$id);
		if(empty($info['phonenum'])){
			echo json_encode(array('errcode'=>'10001','msg'=>'通知失败，未绑定手机号'));
		}else{
			$Sms         = new \Core\Sms();
			$rusult = $Sms->SendEx($info['phonenum'],'Login','memberCor','',$this->wxid,$info['userid']);
			echo json_encode(array('errcode'=>'10000','msg'=>'通知成功'));
		}
	}
	public function addmusic(){
		include CURR_VIEW_PATH . "addmusic.php";
	}
	public function addeditorAction(){
		include CURR_VIEW_PATH . "addeditor.php";
	}
	//编辑图片
	public function editgameImgAction(){
		include CURR_VIEW_PATH . "editgameImg.php";
	}
		//营销列表
	public function  marketinglistAction(){
		$Mode = M('app_order_info');
		$where = '';
		$status    = KS_S('status',3);
		if($status !=3){
			$where .=' and paystatus ='.$status;
		}
		$options = $Mode->getOptions('20','where ish5=1 and wxid='.$this->wxid.$where);//分页参数设置
        $page = Page($options);
		$values = $Mode->getPage($page,'id asc','where ish5=1 and wxid='.$this->wxid.$where);
		foreach ($values as $k => $v) {
			$values[$k]['username'] = M('common_user_member')->getOne('name','where userid='.$v['memberid']);
		}
		include CURR_VIEW_PATH . "marketinglist.php";
	}
	//奖励列表
	public function RewardlistAction(){
		$id  = KS_G('get.id');
		$Mode = M('app_h5_rulereward');
		$options = $Mode->getOptions('5','where h5id='.$id);//分页参数设置
        $page = Page($options);
		$values = $Mode->getPage($page,'id asc','where h5id='.$id);
		include CURR_VIEW_PATH . "Rewardlist.php";
	}
	//预览游戏
	public function  markinfoAction(){
		$id = KS_G('get.id');
		$app_h5_market = M('app_h5_market');
		$values = $app_h5_market->getRow('where id='.$id);
		$h5_rule = M('app_h5_rule');
		$h5id  = $h5_rule->getOne('id','where h5id='.$id.' and wxid=2');
		include CURR_VIEW_PATH . "markinfo.php";
	}
	//请求校区
	public function campusAction(){
		$schoolModel=M('app_schooladdress');
		$where='where wxid='.$this->wxid;
		$values = 	$schoolModel->getAll($where);
		echo json_encode($values);exit;
	}
	//开奖
	public function openH5Action(){
		$id  = KS_G('post.id');
		$RuleMode = M('app_h5_rule');
		if($RuleMode->getOne('isopen','where id='.$id) == 1){
			echo json_encode(array('errcode'=>'0','msg'=>'已经开过奖了')); exit;
		}
		$Mode = M('app_h5_rulereward');//调用
		$UserMode = M('app_h5_user');//调用参与人数
		$Userlist = $UserMode->getAll('where h5id='.$id.' order by score desc');//调取全部的参与人数 然后按照分数排序
		$Rulelist =	$Mode ->getAll('where h5id='.$id.' order by id asc');
		$i = 0;
		foreach ($Userlist as $k =>$v){
			if(!empty($Rulelist[$k])){
				$Data['phonenum'] = $v['phonenum'];
				$Data['membername'] = $v['menbername'];
				$Data['headimgurl'] = $v['headimgurl'];
				$Data['nickname'] = $v['nickname'];
				$Data['openid'] = $v['openid'];
				$Data['addtime'] = time();
				$Mode->update($Data,' id='.$Rulelist[$k]['id']);
				$Datas['rangking'] = $i+1;
				$Datas['iswin'] = 1;
				$UserMode->update($Datas,' id='.$v['id']);
				$i++;
			}
		}
		$Datasb['sign']   =$i;
		$Datasb['isopen'] = 1;
		$RuleMode->update($Datasb,'id='.$id);
		echo json_encode(array('errcode'=>'1000','msg'=>'开奖成功'));
	}
	//活动方案
	public function schemeAction(){
		$Data003['maxPerPage'] = 15;
	    $Data003['wxid']       = $this->wxid;
		$ClassModel            = M('App/InteractModel');
		$result                = $ClassModel->scheme($Data003);
		$list                  = $result['list'];
		$package               = $result['package'];
		$values                = $result['values'];
		include  CURR_VIEW_PATH . "scheme.php";
	}
	//查看活动方案详情
	public function schemeinfoAction(){
	    $Data005['wxid']       = $this->wxid;
		$ClassModel            = M('App/InteractModel');
		$result                = $ClassModel->schemeinfo($Data005);
		$package               = $result['package'];
		$info                  = $result['info'];
		include CURR_VIEW_PATH . 'schemeinfo.php';
	}
	//拼团
	public function collageAction(){
		$Mode    = M('app_h5_rule');
		$now_page       = ChkClng(KS_S('p',1));
		$keyword = ChkSQL(KS_S('keyword'));
		$where = 'where wxid='.$this->wxid.' and h5id = 19 and ismode=2 and isstar!=-1';
		if(!empty($keyword)){
			$where.=" and name like '%$keyword%'";
		}
		$options = $Mode->getOptions('20',$where);//分页参数设置
        $page    = Page($options);
		$values  = $Mode->getPage($page,'id desc',$where);
		foreach ($values as $k => $v) {
			if($v['type'] == 1 || $v['type'] == 2||$v['type'] == 3||$v['type'] == 4){
				$Mode = M('app_course');
				$info  = $Mode->getRow('where status !=-1 and wxid ='.$this->wxid.' and courseid='.$v['infoid'],'courseid as id,title,price,defaultpic');
			}elseif($v['type'] == 6){
				$Mode = M('app_paper');
				$info  = $Mode->getRow('where wxid ='.$this->wxid.' and status !=-1 and paperid='.$v['infoid'],'paperid as id,Title as title,price,defaultpic');
			}
			if(empty($info)){
				unset($values[$k]);
			}else{
				$values[$k]['title'] = $info['title'];
				$values[$k]['defaultpic'] = $info['defaultpic'];
				if(empty($values[$k]['defaultpic'])){
					$values[$k]['defaultpic']  = nopic(12);
				}else{
					$values[$k]['defaultpic']  = Img($values[$k]['defaultpic']);
				}
				$values[$k]['setting'] = unserialize($v['setting']);
				$values[$k]['groupnum'] = M('app_h5_rulereward')->getAll('where wxid='.$this->wxid.' and h5id='.$v['id']);
				$values[$k]['groupnum']  = count($values[$k]['groupnum']);
				$values[$k]['groupnum1'] = M('app_h5_rulereward')->getAll('where wxid='.$this->wxid.' and h5id='.$v['id'].' and successful = 1');
				$values[$k]['groupnum1']  = count($values[$k]['groupnum1']);
				$values[$k]['groupnum2'] = M('app_h5_rulereward')->getAll('where wxid='.$this->wxid.' and h5id='.$v['id'].' and successful = 0');
				$values[$k]['groupnum2']  = count($values[$k]['groupnum2']);
			}
		}
		include CURR_VIEW_PATH . 'collagelist.php';
	}
	//创建拼团
	public function addcollageAction(){
		$id =KS_G('get.id');
		if($id){
			$edit =ChkClng(null !==GF('edit') ? GF('edit'):'1');
			$Db = M('app_h5_rule');
			$values = $Db->getRow('where wxid='.$this->wxid.' and h5id = 19 and id='.$id.'  and isstar !=2 and isstar !=-1');
			if(empty($values)){
				$url = M_URL($this->AppName.'/Index','collage','',GP(''));
				KS_INFO('出现异常，请稍后在试！',3,$url);
			}
			if($values['type'] == 3){
				$values['type'] = 4;
			}elseif ($values['type'] == 4) {
				$values['type'] = 3;
			}
			$values['setting'] = unserialize($values['setting']);
		}
		include CURR_VIEW_PATH . 'addcollage.php';
	}
	//修改平台
	public function doeditcollageAction(){
		$id =KS_G('get.id');
		$endtime = KS_G('post.endtime');
		$Db= M('app_h5_rule');
		$values = $Db->getRow('where wxid='.$this->wxid.' and h5id = 19 and id='.$id);
		$endtime = strtotime($endtime);
		if($endtime<$values['endtime']){
			KS_INFO('结束时间不能小于原来的时间');
		}else{
			$Data['endtime'] = $endtime;
		}
		$Db->update($Data,'wxid='.$this->wxid.' and h5id = 19 and id='.$id);
		$url = M_URL($this->AppName.'/Index','collage','',GP(''));
		KS_INFO('修改完成',3,$url);
	}
    //删除拼团
    public function delectAction(){
       $now_page       = ChkClng(KS_S('p',1));
       $Data['isstar'] = -1;
       $Db= M('app_h5_rule');
       $id             = KS_G('get.id');
       $Db->update($Data,'id='.$id);
       $url = M_URL($this->AppName.'/Index','collage','',GP('p-'.$now_page));
	    ks_header($url);
    }
	//未成团详情
	public function uncollageAction(){
		$id = KS_G('get.id');
		$h5mode     = M('app_h5_rule');
		$h5info = $h5mode->getRow('where wxid='.$this->wxid.' and id='.$id);
		$h5info['setting'] = unserialize($h5info['setting']);
		if($h5info['setting']['timexz'] == 24){
			$addtiem = 86400;
		}else{
			$addtiem = 86400+86400;
		}
		$people = $h5info['setting']['rewardpeple'];
		$s =ChkClng(null !==GF('s') ? GF('s'):'0');
		$Db= M('app_h5_rulereward');
		if($s==0){
			$where = 'where wxid='.$this->wxid.' and h5id = '.$id.' and successful =0';
		}else{
			$where = 'where wxid='.$this->wxid.' and h5id = '.$id.' and successful =1';
		}
		$options = $Db->getOptions('20',$where);//分页参数设置
        $page = Page($options);
		$values = $Db->getPage($page,'id asc',$where);
		$dn_member = M('common_user_member');
		foreach ($values as $k=> $v) {
			$Db2 = M('app_h5_user');
			$values[$k]['num'] = $Db2->getAll('where groupid = "'.$v['groupid'].'"');
			$values[$k]['num'] = count($values[$k]['num']);
			$values[$k]['username'] = $dn_member->getOne('name','where userid ='.$v['memberid']);
		}
		include  CURR_VIEW_PATH . "uncollage.php";
	}
	//查看拼团详情
	public function checkcollageAction(){
		$groupid = null !==GF('groupid') ? GF('groupid'):'';
		$Db2 = M('app_h5_user');
		$values = $Db2->getAll('where groupid = "'.$groupid.'"');
		include  CURR_VIEW_PATH . "checkcollage.php";
	}

	//添加拼团
	public function doaddcollageAction(){
		$Mode = M('app_h5_rule');
		$infoid = KS_G('post.infoid');
		if(empty($infoid)){
			KS_INFO('请选择商品');
		}
		$type = KS_G('post.ctype');
		if($type == 3){
			$type =4;
		}elseif($type == 4){
			$type =3;
		}
		$res = $Mode->getRow('where wxid='.$this->wxid.' and h5id = 19 and  infoid='.$infoid.' and type='.$type.' and isstar !=2');//分页参数设置
		if(!empty($res)){
			KS_INFO('该商品已经有相关活动设置！请勿重复设置');
		}
		$Data['wxid'] = $this->wxid;
		$Data['h5id'] = 19;
		$Data['ismode']= 2;
		$teammoney = KS_G('post.teammoney');
		$leadmoney =  KS_G('post.leadmoney');
		$rewardpeple = KS_G('post.rewardpeple');
		if($rewardpeple<2){
			KS_INFO('包括团长在内的人数，建议2-10人');
		}
		if(empty($teammoney)){
			KS_INFO('请填写拼团奖励');
		}

		if($type == 1 || $type == 2||$type == 3||$type == 4){
			$Modes = M('app_course');
			$info  = $Modes->getRow('where status !=-1 and wxid ='.$this->wxid.' and courseid='.$infoid,'courseid as id,title,price,defaultpic');
		}elseif($type == 6){
			$Modes = M('app_paper');
			$info  = $Modes->getRow('where wxid ='.$this->wxid.' and status !=-1 and paperid='.$infoid,'paperid as id,Title as title,price,defaultpic');
		}
		if($teammoney>$info['price']){
			KS_INFO('拼团价格设置不得高于原价');
		}
		if($leadmoney>$teammoney){
			KS_INFO('团长价格不得高于拼团价格');
		}
		$timexz = KS_G('post.timexz');
		$startime = KS_G('post.startime');
		$endtime = KS_G('post.endtime');
		if(empty($startime) || empty($endtime)){
			KS_INFO('请选择活动时间');
		}
		if($startime == $endtime){
			KS_INFO('开始时间和结束时间不能一致');
		}
		$Data['name'] = $info['title'].'拼团活动';
		$Data['setting']  = array('timexz' =>$timexz,'teammoney'=>$teammoney,'leadmoney'=>$leadmoney,'rewardpeple'=>$rewardpeple,'endtime'=>0);
		$Data['setting']  = serialize($Data['setting']);
		$Data['startime'] = strtotime($startime);
		$Data['endtime'] = strtotime($endtime);
		$Data['isstar'] = 0;
		$Data['adddate'] = time();
		$Data['modetype'] = 1;
		$Data['infoid'] = $infoid;
		$Data['type']  = $type;
		$Mode->doAdd($Data,'id');
		$url = M_URL($this->AppName.'/Index','collage','',GP(''));
		KS_INFO('配置成功，请开启相关活动',3,$url);
	}
	public function shareAction(){
		include  CURR_VIEW_PATH . "share.php";
	}
}
