<?php

use Kesion\Controller;
class IndexController extends CommonController{
	/**数据统计
	 * 数据统计一日只能调用10次。。。。。注意次数需要先保存到数据库后在查询 今天调试用完。。。。代完善*/
	public function wechatAuthorAction(){
	        $db = M('app_weixin_config');
		    $weixinstatus = $db->getRow('where wxid='.$this->wxid);
			if(empty($weixinstatus)){
				$url=M_URL($this->AppName.'/Index','wechatConfig','',GP(''));
				echo '<script>window.location.href="'.$url.'"</script>';
				//KS_INFO("对不起你还没绑定微信公众号无法使用该功能",0,$url,'',1);
			}else{
                $access_token = getAccessToken($this->wxid);


				if ($access_token==-1){     //
						$this->wechatConfigAction();
				}



				$QRcode = $weixinstatus['qrcode_url'];
				//先去数据库取数据 看下今天是否已经录入过昨天相关信息
				$start=date('Y-m-01 00:00:00');
				$end = date('Y-m-d H:i:s');
				$startW =date("Y-m-d H:i:s",mktime(0, 0 , 0,date("m"),date("d")-date("w")+1,date("Y")));
				$app_wechat_count = M('app_wechat_count');
				$count = $app_wechat_count->getAll("where wxid = " .$this->wxid." and add_time = '".date("Y-m-d 00:00:00")."'");
				if(empty($count)){
					//获取用户增减数据
					$url ='https://api.weixin.qq.com/datacube/getusersummary?access_token='.$access_token;//access_token改成你的有效值
					//获取累计用户数据
					$url2 = 'https://api.weixin.qq.com/datacube/getusercumulate?access_token='.$access_token;
					//昨天情况
					$data=json_encode(array('begin_date'=>date("Y-m-d",strtotime("-1 day")),'end_date'=>date("Y-m-d",strtotime("-1 day"))));
					$outputYsummary= curlPost($url,$data);
					$outputYcumulate= curlPost($url2,$data);
					//
					$tokensummary= (array)json_decode($outputYsummary);
					//
		      		$tokencumulate= (array)json_decode($outputYcumulate);
		      		if(empty($tokensummary['list'])){
		      			$countdata['user_source'] = 0;
		      			$countdata['new_user'] = 0;
		      			$countdata['cancel_user'] = 0;
		      		}else{
		      			$countdata['user_source']=$tokensummary['list'][0]->user_source;
		      			$countdata['new_user']=$tokensummary['list'][0]->new_user;
		      			$countdata['cancel_user'] = $tokensummary['list'][0]->cancel_user;
		      		}
		      		if(empty($tokencumulate['list'])){
		      			$countdata['cumulate_user']=0;
		      			$countdata['ref_date'] = date("Y-m-d",strtotime("-1 day"));
		      		}else{
		      			$countdata['cumulate_user']=$tokencumulate['list'][0]->cumulate_user;
		      			$countdata['ref_date'] = $tokencumulate['list'][0]->ref_date;
		      		}
		      		$countdata['add_time'] = date("Y-m-d");
		      		$countdata['wxid'] =$this->wxid;
		      		$app_wechat_count->doAdd($countdata,'id');
				}else{
					//有就数据库直接取
					$countdata = $count[0];
				}

				//计算本周累计关注
				$day = array();
				for($i = 1 ;$i<=7;$i++){
					$startimew = date("Y-m-d H:i:s",mktime(0, 0 , 0,date("m"),date("d")-date("w")+$i,date("Y")));
					$endtimew = date("Y-m-d 23:59:59",mktime(0, 0 , 0,date("m"),date("d")-date("w")+$i,date("Y")));
					$countweek_new_userw = $app_wechat_count->getOne('new_user',"where wxid = " .$this->wxid." and add_time >= '".$startimew."' and add_time <='".$endtimew."'");
					$countweek_cancel_userw = $app_wechat_count->getOne('cancel_user',"where wxid = " .$this->wxid." and add_time >= '".$startimew."' and add_time <='".$endtimew."'");
					$cumulate_user = $app_wechat_count->getOne('cumulate_user',"where wxid = " .$this->wxid." and add_time>='".$startimew."' and add_time <='".$endtimew."'");
					$day[$i] =$countweek_new_userw - $countweek_cancel_userw;
					$days[$i] = $cumulate_user;
				}
				$countweek_new_user = $app_wechat_count->getOne('sum(new_user)',"where wxid = " .$this->wxid." and add_time >= '".$startW."' and add_time <='".$end."'");
				$countweek_cancel_user = $app_wechat_count->getOne('sum(cancel_user)',"where wxid = " .$this->wxid." and add_time >= '".$startW."' and add_time <='".$end."'");
				$countweek = $countweek_new_user -$countweek_cancel_user;
				//计算本月累计关注
				$countMon_new_user = $app_wechat_count->getOne('sum(new_user)',"where wxid = " .$this->wxid." and add_time >= '".$start."' and add_time <='".$end."'");
				$countMon_cancel_user = $app_wechat_count->getOne('sum(cancel_user)',"where wxid = " .$this->wxid." and add_time >= '".$start."' and add_time <='".$end."'");
				$countMon = $countMon_new_user-$countMon_cancel_user;
				//获取素材数量
				$app_wechat_sucai = M('app_wechat_sucai');
				//素材总数量
				$countsucai = $app_wechat_sucai->getOne('count(*)',"where wxid = " .$this->wxid." AND parentid = 0");
				//今天的素材
				$t = time();
				$start_now = mktime(0,0,0,date("m",$t),date("d",$t),date("Y",$t));
				$end_now = mktime(23,59,59,date("m",$t),date("d",$t),date("Y",$t));
				$now_countsucai = $app_wechat_sucai->getOne('count(*)',"where wxid = " .$this->wxid." AND parentid = 0 AND create_time>='".$start_now."' and create_time <= '".$end_now."'");
				//获取关键词数量
				$app_wechat_reply = M('app_wechat_reply');
				//关键词总量
				$countreply = $app_wechat_reply->getOne('count(*)',"where wxid = " .$this->wxid." AND type = 2");
				//今天的素材
				$now_countreply = $app_wechat_reply->getOne('count(*)',"where wxid = " .$this->wxid." AND type = 2 AND create_at>='".$start_now."' and create_at <= '".$end_now."'");
				//获取今天的粉丝信息
				$app_wechat_user = M('app_weixin_user');
				$userlist = $app_wechat_user->getAll("where wxid = " .$this->wxid." AND subscribe_time>='".$start_now."' and subscribe_time <= '".$end_now."'");
				//获取今日消息
				$app_wechat_news= M('app_wechat_news');
				$now_news = $app_wechat_news->getOne('count(*)',"where wxid = " .$this->wxid." AND createtime>='".$start_now."' and createtime <= '".$end_now."'");


				include  CURR_VIEW_PATH . "count.php";
			}
	}
	/**
	 * 公众号首页
	 */
	public function indexAction(){
		$db = M('app_weixin_config');
		$weixinstatus = $db->getRow('where wxid='.$this->wxid);
		if(empty($weixinstatus)){
	      	include  CURR_VIEW_PATH . "wechatopen.php";
		}else{
		   $this->wechatAuthorAction();
		}
	}


	/**
	 * 进入微信授权绑定配置页面
     */
	public function wechatConfigAction(){
		$type    = KS_S('type');
    	if($type=='wx'){                    //来自微信独立收款插件的授权
			$payname = ',wxtype-1';
    	}else{                              //来自公众号授权代运营
    		$payname = '';
    	}
		$authurl = MY_FULLDOMAIN.'/wechat/wechatauth?wxid-'.$this->wxid.',auth_type-1'.$payname;
		echo '<script>window.location.href="'.$authurl.'"</script>';
	}
    //进行微信配置
	public function  doWechatConfigAction(){
		$Data['appid']      = ChkSQL(KS_G('post.appid'));
		$Data['appsecret']  = ChkSQL(KS_G('post.appsecret'));
        $url= "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$Data['appid']."&secret=".$Data['appsecret'];
		$access_token       = curl_get($url);
		if(empty($access_token)){echo "failed";exit;}
        $Data['wxid']       = $this->wxid;
		$id                 = ChkClng(KS_G('post.id'));
		$Data['status']     = ChkClng(KS_G("post.status"));
		$Data['weixintype'] = ChkClng(KS_G('post.weixintype'));
		$Data['weixinname'] = ChkSQL(KS_G('post.weixinname'));
		$Data['weixinid']   = ChkClng(KS_G('post.weixinid'));
		$Data['encodingaeskey'] = ChkSQL(KS_G('post.encodingaeskey'));
		$Data['weixinstatus'] = ChkClng(KS_G('post.weixinstatus'));
		$Data['token']      = ChkSQL(KS_G('post.token'));
		$Data['adddate']    = time();
		//var_dump($Data);
		$Rule['weixinname'] = '公众号名称|isEmpty';
		Chkpost($Data,$Rule,$this->AppModel);
		$configinfo = $this->AppModel->getRow("where wxid=".$Data['wxid']." limit 1");
		if(!empty($configinfo)){
		    if($configinfo['appid']!=$Data['appid']){
		    	 $deletetable='app_wechat_count,app_wechat_menu,app_wechat_news,app_wechat_qunfa,app_wechat_reply,app_wechat_rnews,app_wechat_sucai,app_wechat_tag,app_wechat_template,app_wechat_user_group,app_weixin_material,app_weixin_user';
		      $tablearr = explode(',',$deletetable);
			  foreach($tablearr as $k=>$v){if(!empty($v)){$tablemodel = M($v);$tablemodel->delete("wxid=".$this->wxid);}}
		 	}
			$Data['access_token']         = "";
			$Data['access_token_adddate'] = 0;
			$this->AppModel->update($Data,'id='.$id);
			$this->cache->PutHCache('wxconfig',$this->wxid);
			echo "更新成功";
		}else{
			$this->AppModel->doAdd($Data,'id');
			$this->cache->PutHCache('wxconfig',$this->wxid);
			echo "配置成功";
		}
	}
	//展现关键词自动回复页面
	public function replyAction(){
		$app_wechat_config = M('app_weixin_config');
		$weixinstatus = $app_wechat_config->getRow('where wxid='.$this->wxid);
		if(empty($weixinstatus)){
			$url=M_URL($this->AppName.'/Index','wechatConfig','',GP(''));
			KS_INFO("对不起你还没绑定微信公众号无法使用该功能",0,$url,'',1);
		}else{
			$keyword = KS_S('keyword');
			$keytype = ChkClng(KS_S('keytype'));
			$staus=GF('staus');
            $where ='';
			$now_page = ChkClng(KS_S('p'));
			$app_wechat_reply = M('app_wechat_reply');
			$rule = ChkClng(KS_G('post.rule'));
			$where.= 'where a.wxid ='.$this->wxid." and a.type = 2";
			if($keytype==1)
			{
				$where.="  and  a.keyword like '%".$keyword."%'";
			}
			$where = "as a left join ks_app_course as b on a.courseid = b.courseid left join ks_app_wechat_sucai as c on a.sucaiid = c.id $where";
            $options = $app_wechat_reply->getOptions('10',$where);//分页参数设置
			$page = Page($options);
			$values = $app_wechat_reply->getPage($page,'a.id desc',$where,'c.*,b.*,a.*');
            include  CURR_VIEW_PATH . "reply.php";
		}
	}
	//关注时回复
	public function focusReplyNowAction(){
	   $app_wechat_reply = M('app_wechat_reply');
		$where2 = "as a left join ks_app_course as b on a.courseid = b.courseid left join ks_app_wechat_sucai as c on a.sucaiid = c.id left join ks_app_class as d on a.classid = d.classid";
	   $showFocus = $app_wechat_reply->getRow( $where2.'  where a.wxid='.$this->wxid." and a.type = 1  limit 1",'b.*,c.*,a.*,d.*');
	   $common_user_teacher = M('common_user_teacher');
       if(isset($showFocus['teacherid'])){$name = $common_user_teacher->getOne("  name","where  userid = ".$showFocus['teacherid']);}
       $text= ks_editor('text');
	   include  CURR_VIEW_PATH . "focusReplyNow.php";
	}
	//编辑关键词回复
	public function editKeyReplyAction(){
       $id = ChkClng(KS_G("get.id"));
       $app_wechat_reply = M('app_wechat_reply');
       $where = " as a left join ks_app_course as b on a.courseid = b.courseid left join ks_app_wechat_sucai as c on a.sucaiid = c.id ";
       $replyInfo = $app_wechat_reply->getRow($where.' where a.wxid = '.$this->wxid.' and a.id = '.$id .' and a.type = 2');
       $common_user_teacher = M('common_user_teacher');
	   if(isset($replyInfo['teacherid'])){
			$teacherName = $common_user_teacher->getOne("  name","where  userid = ".$replyInfo['teacherid']);
	   }
       $text= ks_editor('text');
	   include  CURR_VIEW_PATH . "editKeyReply.php";
	}
	//添加关键词
	public function addKeyReplyAction(){
	   $text= ks_editor('contents');
       include  CURR_VIEW_PATH . "addKeyReply.php";
    }
	//关键词自动回复里面的素材选择控制器
	public function replySucaiAction(){
		$keyword = KS_S('keyword');
		$keytype = ChkClng(KS_S('keytype'));
		$abc = ChkSQL(null !==GF('abc') ? GF('abc'):'');
     	$stat=KS_S('status',3);
		$where='where wxid = '.$this->wxid.' and parentid = 0';
		if($keytype==1){
			$where.=" and  titles like '%".$keyword."%'";
		}elseif($keytype==2){
			$where.=" and author like '%".$keyword."%'";
		}elseif($keytype==3){$where.="";}
		$app_wechat_sucai = M('app_wechat_sucai');
		$options =$app_wechat_sucai->getOptions('12',$where);//分页参数设置
		$page = Page($options);
		$tuwen = $app_wechat_sucai->getPage($page,'id desc',$where);
		include  CURR_VIEW_PATH . "reply_sucai.php";
	}
    //关键词自动回复里面的课程选择
	public function replyCourseAction(){
		$keyword = KS_S('keyword');
		$keytype = ChkClng(KS_S('keytype'));
        $ab = ChkSQL(null !==GF('ab') ? GF('ab'):'');
   	    $where='where a.wxid = '.$this->wxid ." and status != -1";
   	    if($keytype==1){
			$where.="  and  a.title like '%".$keyword."%'";
		}elseif($keytype==2){
			$where.="  and b.name like '%".$keyword."%'";
		}
        $app_course = M('app_course');
		$line = "as a left join ks_common_user_teacher as b on a.teacherid = b.userid ";
        $options =$app_course->getOptions('12',$line.$where);//分页参数设置
		$page = Page($options);
		$course = $app_course->getPage($page,'courseid desc',$line.$where);
        include  CURR_VIEW_PATH . "reply_course.php";
	}
	//关键词自动回复里面的班级选择
	public function replyClassAction(){
		$keyword = KS_S('keyword');
		$keytype = ChkClng(KS_S('keytype'));
        $ab = ChkSQL(null !==GF('ab') ? GF('ab'):'');
   	    $where='where a.wxid = '.$this->wxid ." and status != -1";
   	    if($keytype==1){
			$where.="  and  a.title like '%".$keyword."%'";
		}elseif($keytype==2){
			$where.="  and b.name like '%".$keyword."%'";
		}
        $app_course = M('app_class');
		$line = "as a left join ks_common_user_teacher as b on a.teacherid = b.userid ";
        $options =$app_course->getOptions('12',$line.$where);//分页参数设置
		$page = Page($options);
		$course = $app_course->getPage($page,'classid desc',$line.$where);
        include  CURR_VIEW_PATH . "reply_class.php";
	}
    //在消息回复里(关注时消息回复)
	public function focusReplyAction(){
		$Data['replyType'] = $replyType = KS_G("post.replyType");
		if($replyType == 0){
	    	$Data['sucaiid']  = ChkClng(KS_G('post.sucaiid'));
	    	$Data['contents'] =null;
	    	$Data['courseid'] =null;
	    	$Data['classid'] = null;
	    	$Rule['sucaiid'] = '素材|isEmpty';
	    }elseif($replyType == 1){
	    	$Data['contents'] = ChkSQL(KS_G("post.contents"));
	    	$Data['courseid'] =null;
	    	$Data['sucaiid'] =null;
	    	$Data['classid'] = null;
	    	$Rule['contents'] = '内容|isEmpty';
       }elseif($replyType == 2){
	    	$Data['courseid'] = ChkClng(KS_G('post.courseid'));
	    	$Data['classid'] = null;
	    	$Data['sucaiid'] =null;
	    	$Data['contents'] = null;
	    	$Rule['courseid'] = '课程|isEmpty';
       }elseif($replyType == 3){
	    	$Data['classid'] = ChkClng(KS_G('post.classid'));
	    	$Data['sucaiid'] =null;
	    	$Data['contents'] = null;
	    	$Data['courseid'] =null;
	    	$Rule['classid'] = '班级|isEmpty';
       }
		$Data['isfocus'] = ChkClng(KS_G('post.isfocus'));
		$Data['type'] = 1;
		$Data['create_at'] = time();
		$Data['wxid'] = $this->wxid;
		//$Rule['isfocus'] = '选择|isEmpty';
        $app_wechat_reply = M('app_wechat_reply');
		Chkpost($Data,$Rule,$app_wechat_reply);
		$id = $app_wechat_reply->getOne("  id","where  wxid =". $this->wxid . " and type = 1");
		$url1= M_URL($this->AppName.'/Index','reply',"",GP(""));
		if($id){
			$app_wechat_reply->update($Data,'id='.$id);
			KS_INFO('修改成功',0,$url1);
		}else{
			$app_wechat_reply->doadd($Data,'id');
			KS_INFO('添加成功',0,$url1);
		}
	}
    //关注回复的开启
	public function switchFocusAction(){
		$Data['isfocus'] = ChkClng(KS_G('post.isfocus'));
		$id = ChkClng(KS_G('post.id'));
		if($id ==0){echo "开启成功";exit;}
        $app_wechat_reply = M('app_wechat_reply');
		$aa =  $app_wechat_reply->update($Data,'id='.$id);
		if($aa){echo "更改成功";}else{echo "更改失败";}
	}
	//消息回复添加
	public function addReplyRuleAction(){
	    $replyType = ChkClng(KS_G("post.replyType"));
	    if($replyType == 0){
	    	$Data['sucaiid']  = ChkClng(KS_G('post.sucaiid'));
	    	$Data['contents'] =null;
	    	$Data['courseid'] =null;
	    	$Data['classid'] = null;
	    }elseif($replyType == 1){
	    	$Data['contents'] = ChkSQL(KS_G("post.contents"));
	    	$Data['courseid'] =null;
	    	$Data['sucaiid'] =null;
	    	$Data['classid'] = null;
       }elseif($replyType == 2){
	    	$Data['courseid'] = ChkClng(KS_G('post.courseid'));
	    	$Data['classid'] = null;
	    	$Data['sucaiid'] =null;
	    	$Data['contents'] = null;
       }elseif($replyType == 3){
	    	$Data['classid'] = ChkClng(KS_G('post.classid'));
	    	$Data['sucaiid'] =null;
	    	$Data['contents'] = null;
	    	$Data['courseid'] =null;
        }
		$now_page = ChkClng(KS_S('p'));
        $Data['rule']     = ChkSQL(KS_G("post.rule"));
		$Data['keyword']  = ChkSQL(KS_G("post.keyword"));
		$Data['type']     = 2;
		$Data['replyway'] = ChkClng(KS_G('post.replyway'));
		$Data['replyType']  = ChkClng(KS_G('post.replyType'));
		$Data['create_at'] = time();
		$Data['wxid'] = $this->wxid;
		$Rule['rule'] = '规则名|isEmpty';
		$Rule['type'] = '关键字|isEmpty';
		$app_wechat_reply = M('app_wechat_reply');
		Chkpost($Data,$Rule,$app_wechat_reply);
		$app_wechat_reply->doadd($Data,'id');
		$url1= M_URL($this->AppName.'/Index','reply',"",GP(""));
		KS_INFO('添加成功',0,$url1);
	}
	//消息回复关键词修改
	public function editReplyRuleAction(){
		$id = ChkClng(KS_G("get.id"));
	    $replyType = ChkClng(KS_G("post.replyType"));
	    if($replyType == 0){
	    	$Data['sucaiid']  = ChkClng(KS_G('post.sucaiid'));
	    	$Data['contents'] =null;
	    	$Data['courseid'] =null;
	    }elseif($replyType == 1){
	    	$Data['contents'] = ChkSQL(KS_G("post.contents"));
	    	$Data['courseid'] =null;
	    	$Data['sucaiid'] =null;
        }else{
	    	$Data['courseid'] = ChkClng(KS_G('post.courseid'));
	    	$Data['sucaiid'] =null;
	    	$Data['contents'] = null;
        }
		$now_page          = ChkClng(KS_S('p'));
        $Data['rule']      = ChkSQL(KS_G("post.rule"));
		$Data['keyword']   = ChkSQL(KS_G("post.keyword"));
		$Data['type']      = 2;
		$Data['replyway']  = ChkClng(KS_G('post.replyway'));
		$Data['replyType']  = ChkClng(KS_G('post.replyType'));
		$Data['create_at'] = time();
		$Data['wxid']      = $this->wxid;
		$Rule['rule']      = '规则名|isEmpty';
		$Rule['type']      = '关键字|isEmpty';
		$app_wechat_reply  = M('app_wechat_reply');
		Chkpost($Data,$Rule,$app_wechat_reply);
		$app_wechat_reply->update($Data,'id='.$id );
		$url1= M_URL($this->AppName.'/Index','reply',"",GP(""));
		KS_INFO('修改成功',0,$url1);
	}
    //删除单条自动回复
	public function delAutoReplyAction(){
		$id = ChkClng(KS_G('get.id'));
		$now_page =  ChkClng(KS_S('p',1));
		$app_wechat_reply = M('app_wechat_reply');
		$app_wechat_reply->delete("id = $id");
		$url=M_URL($this->AppName.'/Index','reply','',GP('p-'.$now_page));
		KS_INFO("删除成功",0,$url);
	}
	//自动回复批量删除
	public function bathDelAutoReplyAction(){
		$ids = ChkSQL(KS_G('post.id'));
		$now_page =  ChkClng(KS_S('p',1));
		$app_wechat_reply = M('app_wechat_reply');
		foreach ($ids  as $id){$app_wechat_reply->delete("id = $id");}
		$url=M_URL($this->AppName.'/Index','reply','',GP('p-'.$now_page));
		KS_INFO("删除成功",0,$url);
	}
	//微信回复推销课程
	public function wechat_menusAction(){include  CURR_VIEW_PATH . "wechat_menus.php";}
	//粉丝列表
	public function fansListAction(){
		$app_wechat_config = M('app_weixin_config');
		$weixinstatus = $app_wechat_config->getRow('where wxid='.$this->wxid);
		if(empty($weixinstatus)){
		    $url=M_URL($this->AppName.'/Index','wechatConfig','',GP(''));
			KS_INFO("对不起你还没绑定微信公众号无法使用该功能",0,$url,'',1);
		}else{
			$keyword = KS_S('keyword');
			$keytype = ChkClng(KS_S('keytype'));
			$stat =null !==GF('stat') ? GF('stat'):'3';
			$where ='';
			$where.= 'where wxid ='.$this->wxid;
			if($stat == 1){$where .= ' and sex = 1';
			}elseif($stat == 2){$where .= ' and sex = 2';
			}else{$where .= '';}
			if($keytype==1) {$where .= "  and  nickname like '%" . $keyword . "%'";
		    }elseif($keytype ==2){$where .="  and  remark like '%" . $keyword . "%'";
			}else{$where .="";}
			$now_page = ChkClng(KS_S('p'));
			$adminModel = M('app_weixin_user');
		    $options    = $adminModel->getOptions('6',$where);
			$page   = Page($options);
			$values = $adminModel->getPage($page,'subscribe_time desc',$where);
			$app_wechat_tag = M('app_wechat_tag');
	        $groups =  $app_wechat_tag->getAll("where  wxid =". $this->wxid);
	        if(!isset($groups)){$groups = array();}
			include  CURR_VIEW_PATH . "fans_list.php";
		}
	}
	//微信粉丝删除
	public function delFanslistAction(){
		$id = ChkClng(KS_G('get.id'));
		$openid=GF('openid');
		$now_page =  ChkClng(KS_S('p',1));
		$fanListModel = M('app_weixin_user');
		$fanListModel->delete("id = $id");
		$access_token = getAccessToken($this->wxid);
		$url ='https://api.weixin.qq.com/cgi-bin/tags/members/batchblacklist?access_token='.$access_token;
		$data = '{
          "openid_list":'.$openid.',
        }';
		$lahei = json_decode(curlPost($url,$data),true);
        if($lahei['errmsg'] =='ok'){
			$url=M_URL($this->AppName.'/Index','fansList','',GP('p-'.$now_page));
		    KS_INFO("删除成功",0,$url);
        }
	}
	//准备修改备注分组
	public function modifyRemarkAction(){
		$id = ChkClng(KS_G('get.id'));
	    $app_weixin_user = M('app_weixin_user');
		$value =  $app_weixin_user->getRow("where  wxid =". $this->wxid ." and id = ".$id);
		$app_wechat_tag = M('app_wechat_tag');
        $groups =  $app_wechat_tag->getAll("where  wxid =". $this->wxid);
        if(!isset($groups)){$groups = array();}
     	 // var_dump($groups);exit;
//		$access_token = getAccessToken($this->wxid);
//    	$url= "https://api.weixin.qq.com/cgi-bin/tags/get?access_token=".$access_token;
//      $data = curlGet($url);
//      $biaoqian = json_decode($data,true);
//       if(!isset($biaoqian['errcode'])){
//      	$groups = $biaoqian['tags'];
//         $result = array_shift($groups);
//         if(!isset($groups)){
//         	$groups = array();
//         }
//      }
        include  CURR_VIEW_PATH . "modify_remark.php";
    }
	//进行粉丝备注和分组(个人)
	public function doEditRemarkAction(){
		$opendid      = ChkSQL(KS_G('post.openid'));
		$list_open[0] = $opendid;
        $list_open    = json_encode($list_open);
        $remark       = ChkSQL(KS_G('post.remark'));
		$tag_id       = ChkClng(KS_G('post.groupid'));
		$access_token = getAccessToken($this->wxid);
		$data = '{"openid_list":'.$list_open.',"tagid":'.$tag_id.'}';
    	//先清除以前的便签
		$clean_url = 'https://api.weixin.qq.com/cgi-bin/tags/members/batchuntagging?access_token='.$access_token;
		$cleanGroupResult = json_decode(curlPost($clean_url,$data),true);
        $url = 'https://api.weixin.qq.com/cgi-bin/tags/members/batchtagging?access_token='.$access_token;
        $divideGroupResult = json_decode(curlPost($url,$data),true);
		$remarkUrl='https://api.weixin.qq.com/cgi-bin/user/info/updateremark?access_token='.$access_token;
		$remarkData ='{
			        "openid":"'.$opendid.'",
			        "remark":"'.$remark.'"
		           }';
		$remarkResult = json_decode(curlPost($remarkUrl,$remarkData),true);
		$url1= M_URL($this->AppName.'/Index','fansList',"",GP(''));
		if($divideGroupResult['errmsg'] =="ok" && $remarkResult['errmsg'] == "ok"){
			KS_INFO('添加分组和备注成功',0,$url1);
		}else{
			KS_INFO('添加分组和备注失败',0,$url1,'',1);
		}
	}
	//批量分组粉丝(批量)
	public function bathDivedeFanslistAction(){
		$a = ChkSQL(KS_G('post.openid'));
		$numfans = count($a);
		$tag_id = ChkClng(KS_G('post.tag_id'));
		$app_wechat_tag = M('app_wechat_tag');
		$count = $app_wechat_tag->getOne("  count"," where  wxid =". $this->wxid .'  and tag_id ='.$tag_id);
		$Data['count'] = $numfans.'+'.$count;
		$app_wechat_tag->update($Data,"  wxid =". $this->wxid .'  and tag_id ='.$tag_id);
		$openids      = json_encode(ChkSQL(KS_G('post.openid')));
		$access_token = getAccessToken($this->wxid);
		$url = 'https://api.weixin.qq.com/cgi-bin/tags/members/batchtagging?access_token='.$access_token;
		$data = '{
				  "openid_list" : '.$openids.',
				  "tagid" : '.$tag_id.'
				}';
		$result = json_decode(curlPost($url,$data),true);
		if($result['errmsg'] =="ok"){
			$url1= M_URL($this->AppName.'/Index','fansList',"",GP(''));
		    KS_INFO('批量分组成功',3,$url1);
		}
	}
    //t添加粉丝分组
	public function addGroupAction(){include  CURR_VIEW_PATH . "modify_group.php";}
	//添加粉丝分组
	public function doaddGroupAction(){
		$Data['groupname'] = ChkSQL(KS_G('post.groupname'));
		$now_page = ChkClng(KS_S('p'));
		$access_token = getAccessToken($this->wxid);
		$URL="https://api.weixin.qq.com/cgi-bin/tags/create?access_token=".$access_token;
		$data='{
		     "tag" : {
		     "name" : "'.$Data['groupname'].'"
		  }
		}';
        $group  = json_decode(curlPost($URL,$data),true);
		$url1= M_URL($this->AppName.'/Index','userGroup',"",GP('p-'.$now_page));
		if(isset($group['errcode'])){
			  KS_INFO('添加失败',0,$url1,'',1);
		}else{
			 $List['tag_id']  = $group['tag']['id'];
			 $List['name']    = $group['tag']['name'];
			 $List['wxid']    = $this->wxid;
			 $List['userid']  = $this->userid;
			 $tagModel        = M('app_wechat_tag');
             $tagModel->doadd($List,'id');
			 KS_INFO('添加成功',0,$url1);
		}
	}
    //进入分组页面
    public function userGroupAction(){
        $app_wechat_tag = M('app_wechat_tag');
  	    $where='where wxid = '.$this->wxid;
 		$options =$app_wechat_tag->getOptions('10',$where);//分页参数设置
		$page = Page($options);
		$value = $app_wechat_tag->getPage($page,'id desc',$where);
		if(!isset($value)){$value = array();}
      	 include  CURR_VIEW_PATH . "user_group.php";
    }
	//微信粉丝分组删除
	public function delGrouplistAction(){
		$tag_id = ChkClng(KS_G('get.id'));
		$now_page =  ChkClng(KS_S('p',1));
        $access_token = getAccessToken($this->wxid);
		$url = "https://api.weixin.qq.com/cgi-bin/tags/delete?access_token=".$access_token;
		$data = '{
				  "tag":{
				       "id" : "'.$tag_id.'"
				  }
		}';
		$delGroup  = json_decode(curlPost($url,$data),true);
		$url=M_URL($this->AppName.'/Index','userGroup','',GP('p-'.$now_page));
		if($delGroup['errmsg'] =="ok"){KS_INFO("删除成功",0,$url);
	    }else{KS_INFO("删除失败",0,$url,'',1);
		}
	}
	//微信粉丝分组批量删除111
	public function bathDelGrouplistAction(){
		$tag_ids   = ChkSQL(KS_G('post.id'));
		$now_page  = ChkClng(KS_S('p',1));
        foreach ($tag_ids  as $tag_id){
			if($tag_id ==2)continue;
            $access_token = getAccessToken($this->wxid);
			$url          = "https://api.weixin.qq.com/cgi-bin/tags/delete?access_token=".$access_token;
		    $data = '{
				  "tag":{
				       "id" : "'.$tag_id.'"
				  }
				}';
		    $delGroup  = json_decode(curlPost($url,$data),true);
		}
		$url=M_URL($this->AppName.'/Index','userGroup','',GP('p-'.$now_page));
		KS_INFO("删除成功",0,$url);
	}
    //修改粉丝分组
	public function modifyGroupAction(){
		$id = ChkClng(KS_G('get.id'));
		include  CURR_VIEW_PATH . "modify_group.php";
    }
	//修改粉丝备注
	public function doEditGroupAction(){
		$tag_id            = ChkClng(KS_G('get.id'));
		$now_page          = ChkClng(KS_S('p'));
		$Data['groupname'] = ChkSQL(KS_G("post.groupname"));
		$access_token      = getAccessToken($this->wxid);
		$url  = "https://api.weixin.qq.com/cgi-bin/tags/update?access_token=".$access_token;
		$data =	'{
				  "tag" : {
				    "id" : "'.$tag_id.'",
				    "name" : "'.$Data['groupname'].'"
				  }
		}';
		$updateGroup = json_decode(curlPost($url,$data),true);
		$url1= M_URL($this->AppName.'/Index','userGroup',"",GP('p-'.$now_page));
		if($updateGroup['errmsg'] == "ok"){KS_INFO('修改成功',0,$url1);
	    }else{KS_INFO('修改失败',0,$url1,'',1);}
    }
    //从微信上同步粉丝到本地
    public function fansCatchAction(){include  CURR_VIEW_PATH . "jdt.php";}
    //获取公众号关注对象
	public function getUserInfoAction(){
		$access_token = getAccessToken($this->wxid);
		$userurl      = "https://api.weixin.qq.com/cgi-bin/user/get?access_token=".$access_token;
		$userarr      = (array)json_decode(curlGet($userurl));
		if(isset($userarr['errcode']) && $userarr['errcode'] == 48001){
			echo '<script>$(".wz").html("你的公众号未认证，无法使用该功能")</script>';exit;
		}
		if(isset($userarr['total']) && $userarr['total']!=0){
			$useropenidarr = (array)$userarr['data'];$i =1;
			$num = $userarr['count'];
			foreach ($useropenidarr["openid"] as $value){
				$jg         = ($i/$num)*100;
				$infourl    =  "https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$access_token."&openid=".$value."&lang=zh_CN";
				$inforarr[] = (array)json_decode(curlGet($infourl));
				echo '<script>$(".charts").attr("w","'.$jg.'");$(".wz").html("总共用户'.$num.'个,当前同步到第'.$i.'<br/>进度为：'.round($jg,2).'%");animate()</script>';
				$i++;
				ob_flush();
			    flush();
			}
			return $inforarr;
		}else{
			return false;
		}
	}
	//进入信息管理界面
	public function info_manageAction(){include  CURR_VIEW_PATH . "info_manage.php";}
	//进入素材管理页面
	public function materialManageAction(){
		$app_wechat_config = M('app_weixin_config');
		$weixinstatus      = $app_wechat_config->getRow('where wxid='.$this->wxid);
		if(empty($weixinstatus)){
			$url=M_URL($this->AppName.'/Index','wechatConfig','',GP(''));
			KS_INFO("对不起你还没绑定微信公众号无法使用该功能",0,$url,'',1);
		}else{
			$keyword = KS_S('keyword');
			$keytype = ChkClng(KS_S('keytype'));
			$where ='';
			$where .=' where wxid = '.$this->wxid.' and parentid = 0';
			$app_wechat_sucai = M('app_wechat_sucai');
			if($keytype==1){
				$where.="  and  titles like '%".$keyword."%'";
			}elseif($keytype==2){
				$where.=" and text like '%".$keyword."%'";
			}
            $ids = $app_wechat_sucai->getAll("where  wxid =". $this->wxid .' and parentid =0','id');
            foreach($ids as $k=>$id){$a[$k]= $id['id'];}
            if(!isset($a)){$a=[];}
            foreach($a as $id){
			   $tuwenList =  $app_wechat_sucai->getAll("where  wxid =". $this->wxid .' and (parentid ='.$id.' or id ='.$id.')');
               $tree[] =  subtree($tuwenList,0,1);
            }
            if(!isset($tree)){$tree=[];}
	        include  CURR_VIEW_PATH . "sucaiManage.php";
		}
	}
	//进入新增或编辑页面图文消息页面
	public function tuWenAction(){
		$app_wechat_sucai = M('app_wechat_sucai');
        $id = ChkClng(KS_G('get.id'));
        $app_wechat_sucai = M('app_wechat_sucai');
        $tuwenList =  $app_wechat_sucai->getAll("where  wxid =". $this->wxid .' and (parentid ='.$id.' or id ='.$id.')');
        $countList = count($tuwenList);
        $tuwenData = subtree($tuwenList,0,1,1);
        $tuwenDataFirst = array_shift($tuwenData);
        if(isset($tuwenData)){
        	$tuwenDataSecond = $tuwenData;
        }else{
        	$tuwenDataSecond = array();
        }
        $text = ks_editor('text');
        if(!empty($id)){
		    include  CURR_VIEW_PATH . "editTuWen.php";
		}else{
			include  CURR_VIEW_PATH . "addTuWen.php";
        }
	}
	//添加图文消息
	public function doAddTuwenAction(){
        $countList        = ChkSQL(KS_G('post.countList'));
        $listNum          = explode(',',$countList);
        $listNum          = array_slice($listNum,1);
    	$Data['wxid']     = $this->wxid;
		$Data['create_at']= time();
		$Data['userid']   = $this->userid;
		$app_wechat_sucai = M('app_wechat_sucai');
        $Data['groupid']  = $app_wechat_sucai->getMaxValue('groupid')+1;
        $Data['titles']   = ChkSQL(KS_G('post.title1'));
        $Data['author']   = ChkSQL(KS_G('post.author1'));
        $text1  = ChkSQL(KS_G('post.text1'));

        $Data['text']     = $this->getTexted($text1,$this->wxid);
        $Data['abstract'] = ChkSQL(KS_G('post.abstract1'));
		$Data['linkurl']  = ChkSQL(KS_G('post.linkurl1'));
		$aa               = ChkSQL(KS_G('post.pic1'));
		$bb               = str_replace('//'.APP_DOMAIN,'',$aa);
        $Data['pic']      = $bb;
		$Data['parentid'] = 0;
		$Data['rootid']   = 1;
		$Data['keytype']  = ChkClng(KS_G('post.keytype1'));
        $id         = $app_wechat_sucai->doadd($Data,'id');
	    foreach($listNum as $v){
			$List['titles']   = ChkSQL(KS_G('post.title'.$v));
			$List['keytype']  = ChkClng(KS_G('post.keytype'.$v));
            $List['author']   = ChkSQL(KS_G('post.author'.$v));
			$text    = ChkSQL(KS_G('post.text'.$v));
            $List['text'] = $this->getTexted($text,$this->wxid);
            $List['abstract'] = ChkSQL(KS_G('post.abstract'.$v));
			$List['linkurl']  = ChkSQL(KS_G('post.linkurl'.$v));
			$tt =   ChkSQL(KS_G('post.pic'.$v));
		    $mm = str_replace('//'.APP_DOMAIN,'',$tt);
            $List['pic']      = $mm;
			$List['rootid']   = $v;
			$List['keytype']  = ChkClng(KS_G('post.keytype'.$v));
			$List['parentid']  = $id;
			$List['wxid']     = $this->wxid;
			$List['create_at']= time();
			$List['userid']     = $this->userid;
			$List['groupid']  = $Data['groupid'];
			$app_wechat_sucai->doadd($List,'id');
		}
	    $url1   = M_URL($this->AppName.'/Index','materialManage',"",GP(''));
	    KS_INFO('添加成功',3,$url1);
	}
    //素材内容图片转化
    function getTexted($text,$wxid){
        $access_token = getAccessToken($wxid);
        $url          = "https://api.weixin.qq.com/cgi-bin/media/uploadimg?access_token=".$access_token."&type=image";
        preg_match_all('/src="(.+?)"/', $text, $matches);
        foreach($matches[1] as $k=>$v){
            $filename = str_replace('//'.APP_DOMAIN,'',$v);
            if(class_exists('\CURLFile')) {
                 $field = array('fieldname' => new \CURLFile(ROOT.$filename));
            }else{
                 $field = array('fieldname' => '@' . $filename);
            }
            $res=$this->https_requested($url,$field);
            $text= str_replace($v,$res['url'],$text);
        }
        return $text;
    }
    function https_requested($url,$data){
	    //1.初始化curl
	    $curl = curl_init();
	    //2.设置curl的参数
	    curl_setopt($curl, CURLOPT_URL, $url);
	    curl_setopt($curl, CURLOPT_POST,true);
	    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
	    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);

	    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	     //3.采集
	    $output = curl_exec($curl);
	    //4.关闭
	    curl_close($curl);
	    return json_decode($output,true);
    }
    //编辑图文消息
	public function doedittedTuwenAction(){
		$countList        = ChkSQL(KS_G('post.countList'));
        $listNum          = explode(',',$countList);
        $listNum          = array_slice($listNum,1);
		$parentid         = ChkClng(KS_G('post.parentid'));
        $groupid          = ChkClng(KS_G('post.groupid'));
        $app_wechat_sucai = M('app_wechat_sucai');
        $app_wechat_sucai->delete('groupid='.$groupid.'  and parentid ='.$parentid);
		//更新
        $Data['wxid']     = $this->wxid;
		$Data['create_at']= time();
		$Data['userid']   = $this->userid;
		$app_wechat_sucai = M('app_wechat_sucai');
		$url1             = M_URL($this->AppName.'/Index','materialManage',"",GP(''));
		$Data['titles']   = ChkSQL(KS_G('post.title1'));
        $Data['author']   = ChkSQL(KS_G('post.author1'));
		$Data['text']     = strip_tags(ChkSQL(KS_G('post.text1')));
        $text1            = ChkSQL(KS_G('post.text1'));
        $Data['text']     = getTexted($text1,$this->wxid);
        $Data['abstract'] = ChkSQL(KS_G('post.abstract1'));
		$Data['linkurl']  = ChkSQL(KS_G('post.linkurl1'));
        $aa               =  ChkSQL(KS_G('post.pic1'));
		$bb               = str_replace('//'.APP_DOMAIN,'',$aa);
        $Data['pic']      = $bb;
		$Data['parentid'] = 0;
		$Data['groupid']  = $groupid;
		$Data['rootid']   = 1;
		$Data['keytype']  = ChkClng(KS_G('post.keytype'));
		//更新第一条
		$app_wechat_sucai->update($Data,'id='.$parentid);
		//添加数据
        foreach($listNum as $t){
            $List['titles']   = ChkSQL(KS_G('post.title'.$t));
            $List['author']   = ChkSQL(KS_G('post.author'.$t));
            $text    = ChkSQL(KS_G('post.text'.$t));
            $List['text'] = getTexted($text,$this->wxid);
            $List['abstract'] = ChkSQL(KS_G('post.abstract'.$t));
			$List['linkurl']  = ChkSQL(KS_G('post.linkurl'.$t));
            $tt =   ChkSQL(KS_G('post.pic'.$t));
		    $mm = str_replace('//'.APP_DOMAIN,'',$tt);
            $List['pic']      = $mm;
			$List['rootid']   = $t;
			$List['keytype']  = ChkClng(KS_G('post.keytype'.$t));
			$List['parentid'] = $parentid;
			$List['wxid']     = $this->wxid;
			$List['create_at']= time();
			$List['userid']   = $this->userid;
			$List['groupid']  = $groupid;
			$app_wechat_sucai->doadd($List,'id');
		}
		$url1   = M_URL($this->AppName.'/Index','materialManage',"",GP(''));
	    KS_INFO('修改成功',3,$url1);
	}
	//编辑图文材料
	public function doEditTuwenAction(){
		$access_token      = getAccessToken($this->wxid);
		$num               = ChkClng(KS_G('post.wechat-num'));
		$Data['wxid']      = $this->wxid;
		$Data['create_at'] = time();
		$Data['userid']    = $this->userid;
		$app_wechat_sucai  = M('app_wechat_sucai');
		$array             = array('media_id'=>KS_G('post.media_id'));
		$urlthumb          = 'https://api.weixin.qq.com/cgi-bin/material/update_news?access_token='.$access_token;
		for($i=1;$i<$num+1;$i++){
			$Data['titles'] = ChkSQL(KS_G('post.title'.$i));
			$Data['author'] = ChkSQL(KS_G('post.author'.$i));
			$Data['text'] = Src(ChkSQL(KS_G('post.text'.$i)));
			$Data['abstract'] = ChkSQL(KS_G('post.abstract'.$i));
			$Data['linkurl'] = ChkSQL(KS_G('post.linkurl'.$i));
			$Data['parentid'] = ChkClng(KS_G('post.parentid'.$i));
			if(!empty($_FILES['url'.$i]['tmp_name'])){
				$this->upload->savePath = 'users/'.$this->wxid.'/'; // 设置附件上传（子）目录
				$info = $this->upload->uploadOne($_FILES['url'.$i]);
				if(!$info) {KS_INFO($this->upload->getError(),0,'','',1);}//上传错误提示错误信息
				else{
					$Data['url'] = ChkSQL($this->upload->uootPath.$info['savepath'].$info['savename']);//应用封面图片
					//如果修改了封面就重新上传一次图片素材
					$file_info=array(
				    'filename'=>$Data['url'],  //图片相对于网站根目录的路径
				    'content-type'=>'image',  //文件类型
				    'filelength'=>'12345'         //图文大小
					);
					$url = "https://api.weixin.qq.com/cgi-bin/material/add_material?access_token=".$access_token."&type=thumb";
					$ch1 = curl_init ();
				    $real_path="{$_SERVER['DOCUMENT_ROOT']}{$file_info['filename']}";
				    $data= array("media"=>"@{$real_path}",'form-data'=>$file_info);
				    curl_setopt ( $ch1, CURLOPT_URL, $url );
				    curl_setopt ( $ch1, CURLOPT_POST, 1 );
				    curl_setopt ( $ch1, CURLOPT_RETURNTRANSFER, 1 );
				    curl_setopt ( $ch1, CURLOPT_CONNECTTIMEOUT, 5 );
				    curl_setopt ( $ch1, CURLOPT_SSL_VERIFYPEER, FALSE );
				    curl_setopt ( $ch1, CURLOPT_SSL_VERIFYHOST, FALSE );
				    @curl_setopt ( $ch1, CURLOPT_POSTFIELDS, $data);
				    $result = json_decode(curl_exec ($ch1) );
				    curl_close ( $ch1 );
				    $Data['Thumb_media_id'] = $result->media_id;
				}
			}
			$Data['sucaitype'] =isset($Data['url'])? ChkClng(KS_G('post.sucaitype'.$i)):null;
			$id= ChkClng(KS_G("post.id".$i));
			$app_wechat_sucai->update($Data,'id='.$id);
			$array['articles']= array(
				array(
					"title"=>$Data['titles'],
					"thumb_media_id"=>$Data['Thumb_media_id'],
	            	"author"=>$Data['author'],
					"content_source_url"=>$Data['linkurl'],
					"content"=>$Data['text'],
					"digest"=>$Data['abstract'],
		            "show_cover_pic"=>0,
		            "need_open_comment" =>0,
					"only_fans_can_comment" =>0
				)
			);
			$array['index'] = ($i-1);
			$thumb = curlPost($urlthumb,json_encode($array,JSON_UNESCAPED_UNICODE));
			$token= (array)json_decode($thumb);
		}
		$url1= M_URL($this->AppName.'/Index','materialManage',"",GP(''));
		KS_INFO('修改成功',3,$url1);
	}
	//对单个图文删除
	public function delMenuAction(){
		$id = ChkClng(KS_G('get.id'));
		$now_page =  ChkClng(KS_S('p',1));
		$app_wechat_sucai = M('app_wechat_sucai');
		$app_wechat_sucai->delete('id ='.$id);
		$app_wechat_sucai->delete(' parentid ='.$id);
		$url=M_URL($this->AppName.'/Index','materialManage','',GP('p-'.$now_page));
		KS_INFO("删除成功",0,$url);
	}
	//对图文进行系列删除
	public function bathDelMenuAction(){
		$ids              = ChkSQL(KS_G('post.id'));
		$now_page         = ChkClng(KS_S('p',1));
		$app_wechat_sucai = M('app_wechat_sucai');
		foreach ($ids  as  $id){
			$app_wechat_sucai->delete('id ='.$id);
			$app_wechat_sucai->delete(' parentid ='.$id);
		}
		$url=M_URL($this->AppName.'/Index','materialManage','',GP('p-'.$now_page));
		KS_INFO("删除成功",0,$url);
	}
	public function videoAction(){include  CURR_VIEW_PATH . "video.php";}
	public function keyword_manageAction(){include  CURR_VIEW_PATH . "keyword_manage.php";}
    //群发页面
    public function groupMessageAction(){
	    $app_wechat_config = M('app_weixin_config');
	    $weixinstatus = $app_wechat_config->getRow('where wxid='.$this->wxid);
	    if(empty($weixinstatus)){
		    $url=M_URL($this->AppName.'/Index','wechatConfig','',GP(''));
		    KS_INFO("对不起你还没绑定微信公众号无法使用该功能",0,$url,'',1);
	    }else{
		    $weixintype = $app_wechat_config->getOne("  weixintype"," where  wxid =". $this->wxid);
		    $app_wechat_qunfa = M('app_wechat_qunfa');
		    $timemonth = $app_wechat_qunfa->getMaxValue(' timemonth',' wxid='.$this->wxid);
		    $count = $app_wechat_qunfa->getOne(' count(*)'," where  wxid =". $this->wxid ."  and  timemonth =  $timemonth and status = '成功'");
		    if($weixintype ==0){$rest = 30-"$count";
		    }else{$rest = 4-"$count";}
		    $app_wechat_tag = M('app_wechat_tag');
            $groupList =  $app_wechat_tag->getAll("where  wxid =". $this->wxid);
            if(!isset($groupList)){$groupList = array();}
	        include  CURR_VIEW_PATH ."group_message.php";
        }
    }
    //进行群发
    public  function sendAllByTagAction(){
        $type = ChkClng(KS_G("post.drType"));
        if($type == 1){
        	$is_to_all ='true';
        	$tag_id ='""';
        	$Data['groupname'] = "全体粉丝";
        }else{
        	$is_to_all ='false';
        	$tag_id = ChkClng(KS_G("post.tag_id"));
        	$app_wechat_tag = M('app_wechat_tag');
            $Data['groupname'] = $app_wechat_tag->getOne(" name","where  wxid =". $this->wxid ." and tag_id = ".$tag_id);

        }
        $access_token = getAccessToken($this->wxid);
		$url = "https://api.weixin.qq.com/cgi-bin/message/mass/sendall?access_token=".$access_token;
        //$url ='https://api.weixin.qq.com/cgi-bin/message/mass/preview?access_token='.$access_token;
      	$send_ignore_reprint = ChkClng(KS_G("post.send_ignore_reprint"));
    	$replyType = ChkClng(KS_G("post.replyType"));
	    if($replyType == 0){
            $media_id = ChkSQL(KS_G('post.media_id'));
       	    $title = ChkSQL(KS_G('post.titles'));
	    	$content =null;
	    	$courseid =null;
	    }elseif($replyType == 1){
	    	$content = ChkSQL(KS_G("post.contents"));
	    	$courseid =null;
	    	$sucaiid =null;
        }else{
       	    $media_id = ChkSQL(KS_G('post.media_id'));
       	    $title = ChkSQL(KS_G('post.titles'));
	    	$sucaiid =null;
	    	$content = null;
        }
	    if($replyType == 1){
			$array='{
			   "filter":{
			      "is_to_all":'.$is_to_all.',
			      "tag_id":'.$tag_id.'
			   },
			   "text":{
			      "content":"'.$content.'"
			   },
			    "msgtype":"text",
			}';
		}else{
			$array='{
				 "filter":{
				      "is_to_all":'.$is_to_all.',
				      "tag_id":'.$tag_id.'
				   },
				   "mpnews":{
				      "media_id":"'.$media_id.'"
				   },
				    "msgtype":"mpnews",
				    "send_ignore_reprint":'.$send_ignore_reprint.'
				}';
		}
	    $final = json_decode(curlPost($url,$array),true);
	    //数据插进数据库
	   	if($replyType == 1){
	   		$Data['type'] = "文本";
	   		$Data['title'] = mb_substr($content,0,20,'utf-8');
	   	}else{
	   		$Data['type'] = "素材";
	   		$Data['title'] = $title;
	   	}
	   	$Data['time'] = time();
	   	//每月群发统计
	   	$Data['timemonth'] = date("Ym");
	   	$Data['wxid']      = $this->wxid;
        $app_wechat_qunfa  = M('app_wechat_qunfa');
	    if($final['errcode'] ==0){
	         $Data['status'] = "成功";
	    	 $app_wechat_qunfa->doAdd($Data,'id');
		}else{
			 $Data['status'] = "失败 ";
			 $app_wechat_qunfa->doAdd($Data,'id');
		}
		$url1= M_URL($this->AppName.'/Index','checkTrait',"",GP(''));
		if($final['errcode'] == '48003'){
			KS_INFO('请先到微信公众号开通群发功能',0,$url1,'',1);
		}
		KS_INFO('查看群发情况',0,$url1);

	}
    //展现群发情况
    public function checkTraitAction(){
  	    $app_wechat_qunfa = M('app_wechat_qunfa');
		$timemonth = $app_wechat_qunfa->getMaxValue(' timemonth',' wxid='.$this->wxid);
  	    $where='where wxid = '.$this->wxid;
  		$options =$app_wechat_qunfa->getOptions('10',$where);//分页参数设置
		$page = Page($options);
		$values = $app_wechat_qunfa->getPage($page,'id desc',$where);
      	include  CURR_VIEW_PATH . "trait_check.php";
    }
    //对单个群发记录删除
	public function delQunfaAction(){
	    $id = ChkClng(KS_G('get.id'));
		$now_page =  ChkClng(KS_S('p',1));
		$app_wechat_qunfa = M('app_wechat_qunfa');
		$app_wechat_qunfa->delete('id ='.$id);
    	$url=M_URL($this->AppName.'/Index','checkTrait','',GP('p-'.$now_page));
		KS_INFO("删除成功",0,$url);
	}
    //对群发记录进行系列删除
	public function bathDelQunfaAction(){
		$ids = ChkSQL(KS_G('post.id'));
		$now_page =  ChkClng(KS_S('p',1));
		$app_wechat_qunfa = M('app_wechat_qunfa');
		foreach ($ids  as  $id){$app_wechat_qunfa->delete('id ='.$id);}
		$url=M_URL($this->AppName.'/Index','checkTrait','',GP('p-'.$now_page));
		KS_INFO("删除成功",0,$url);
	}

    //消息管理模板输出
	public function infoManageAction(){
		$app_wechat_config = M('app_weixin_config');
		$weixinstatus      = $app_wechat_config->getRow('where wxid='.$this->wxid);
		if(empty($weixinstatus)){
			$url=M_URL($this->AppName.'/Index','wechatConfig','',GP(''));
			KS_INFO("对不起你还没绑定微信公众号无法使用该功能",0,$url,'',1);
		}else{
			$keyword = KS_S('keyword');
			$keytype = ChkClng(KS_S('keytype'));
			$now_page = ChkClng(KS_S('p'));
			$where ='';
			$where2 ='';
			$where .=' where  wxid = '.$this->wxid.'';
			$where2 .=' where  wxid = '.$this->wxid.' and  isread = 0';
			$app_wechat_news = M('app_wechat_news');
			if($keytype==1){
				$where .="  and  nickname  like '%".$keyword."%'";
			}elseif($keytype==2){
				$where2 .="  and  content  like '%".$keyword."%'";
			}
            $where  .="  GROUP BY fromusername";
			$where2 .="  GROUP BY fromusername";
			$options = $app_wechat_news->getOptions('10',$where);
			$page    = Page($options);
			$values  = $app_wechat_news->getPage($page,'createtime desc',$where,'*,COUNT(content) as count');
			if(!isset($values)){$values= array();}
			$weidu = $app_wechat_news->getPage($page,'createtime desc',$where2,'COUNT(content) as count');
			include  CURR_VIEW_PATH . "news_manage.php";
		}
	}
    //弹窗出消息回复进入编辑页面
	public function replyNewsAction(){
		$id               = ChkClng(KS_G('get.id'));
		$app_wechat_news  = M('app_wechat_news');
		$value            =  $app_wechat_news->getRow(" where  wxid =". $this->wxid ." and id = ".$id,' id,headimgurl,nickname,fromusername,tousername');
		$data['isread']   = 1;
		$app_wechat_news->update($data,'wxid='.$this->wxid.' and fromusername="'.$value['fromusername'].'"');
		$xiaoxi           = $app_wechat_news->getAll('where fromusername="'.$value['fromusername'].'"');
		$app_wechat_rnews = M('app_wechat_rnews');
		$xiaoxi2 = $app_wechat_rnews->getAll('where tousername="'.$value['fromusername'].'"');
		$cards   = array_merge($xiaoxi, $xiaoxi2);
		$card    = $this->my_array_multisort($cards,'createtime',SORT_ASC);
		include  CURR_VIEW_PATH . "reply_news.php";
	}
	//封装一个方法进行多维数组排序
	public function my_array_multisort($data,$sort_order_field,$sort_order=SORT_DESC,$sort_type=SORT_NUMERIC){
		foreach($data as $val){$key_arrays[]=$val[$sort_order_field];}
		array_multisort($key_arrays,$sort_order,SORT_NUMERIC,$data);
		return $data;
	}
	//回复个人消息
	public function doReplyNewsAction(){
		$id                   = ChkClng(KS_G('get.id'));
		$Data['content']      =  ChkSQL(KS_G("post.text"));
		$Data['createtime']   = time();
		$Data['fromusername'] = ChkSQL(KS_G("post.tousername"));
		//用户openid
		$Data['tousername']   =  ChkSQL(KS_G("post.fromusername"));
		$app_wechat_news      = M('app_wechat_rnews');
		$app_wechat_news->doAdd($Data,'id');
		$access_token         = getAccessToken($this->wxid);
		$url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$access_token;
		$data = '{
		        "touser":"'.$Data['tousername'].'",
		        "msgtype":"text",
		        "text":
		          {
		            "content":"'.$Data['content'].'"
		          }
		}';
		$result = curlPost($url,$data);
		$final  = json_decode($result);
		$url    = M_URL($this->AppName.'/Index','infoManage',"",GP(""));
        if($final->errcode == "0"){
            KS_INFO('消息回复成功',0,$url);
        }else{
       	   KS_INFO('超过48小时不能回复',0,$url,'',1);
        }
	}
	//微信应用配置
	public function settingAction(){echo '微信应用配置';}
	//删除与用户聊天信息
	public function bathDelCommuncationAction(){
	    $openids = ChkSQL(KS_G('post.openid'));
		$now_page =  ChkClng(KS_S('p',1));
		$app_wechat_news = M('app_wechat_news');
		$app_wechat_rnews = M('app_wechat_rnews');
        foreach ($openids as $openid){
			$app_wechat_news->delete("fromusername ='$openid'");
			$app_wechat_rnews->delete("tousername ='$openid'");

		}
		$url=M_URL($this->AppName.'/Index','infoManage','',GP('p-'.$now_page));
		KS_INFO("删除成功",0,$url);
	}
//设置模板开关
//	public function switchTemplateAction(){
//		 $isopen = ChkClng(KS_G('post.isopen'));
//		 $id = ChkClng(KS_G('post.id'));
//		 $app_weixin_config = M('app_weixin_config');
//		 $setting = $app_weixin_config->getOne("  setting","where  wxid = ".$this->wxid ." and id = ".$id);
//       $a = explode("|",$setting);
//		 $a[0] = $isopen;
//       $b= implode("|",$a);
//      // var_dump($b);exit;
//		 $Data['setting'] = $b;
//       // var_dump($Data['setting']);exit;
//		 $aa =  $app_weixin_config->update($Data,'id='.$id);
//		 //var_dump($aa);exit;
//		 if($aa){
//		 	echo "succeed";
//		 }else{
//		 	echo "failed";
//		 }
//
//}
}