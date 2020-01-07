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



namespace Kesion\Model\Application;
use Kesion\Model;
class IndexModel extends Model{

    /**
     * 首次进入的iframe界面的初始化参数
	 * @param mixed $Data008
	 * @return array
	 */
	public function mainfirst($Data008){
        //$appuserrelate = M('Application/IndexModel/common_app_userrelate');
		//$values        = $this->cache->GetHCache('haveapprelate',$Data008['wxid']);
		//$recommend     = $appuserrelate->getrecommend();

		$zt     = date("Y-m-d",strtotime("-1 day"));
		$nowday = date("Y-m-d");$month  = date("Y-m");
		$weeks  = date("Y-m-d H:i:s",mktime(0, 0 , 0,date("m"),date("d")-date("w")+1,date("Y")));
		$weeks  = strtotime($weeks);
		$weeke	= date("Y-m-d H:i:s",mktime	(23,59,59,date("m"),date("d")-date("w")+7,date("Y")));
		$weeke  = strtotime($weeke);



		/*$appcategory   = $this->cache->GetA('appcategory','parentid',0);//读取缓存
		$userModel     = M('common_user');//读取缓存 学生人数

		$user          = $userModel->getAll("where wxid=".$Data008['wxid']." and usertype = 0 order by userid");
		$userNum       = $userModel->getOne('count(userid)','where usertype=0 and wxid='.$Data008['wxid']);
		$userflag = 0;
		foreach($user as $k =>$v){if(date('Y-m-d',$v['regdate']) == $nowday){$userflag++;}}
		*/
		//读取缓存 微信公众号关注人数
		//$wxcount          = $this->cache->GetHCache('wxcount',$Data008['wxid'],'');//读取缓存
		//$wxnum            = array();
		//foreach($wxcount as $k =>$v){if($v['ref_date'] == $zt.' 00:00:00'){$wxnum = $v;}}
		//读取缓存 课程订单
		$app_order           = M('app_order');
		$app_order_info      = M('app_order_info');
		$sql = 'select count(*) FROM (select count(memberid) from '.$app_order->table.' where status!=-1 and paystatus=1 and wxid='.$Data008['wxid'].' group by memberid) as t';
		$payorderuser        = $GLOBALS['db']->getOne($sql);
		//$app_order->getOne('count(memberid)','where status!=-1 and paystatus=1 and wxid='.$Data008['wxid'].' group by memberid');
		$sql = 'select count(*) FROM (select count(memberid) from '.$app_order->table.' where status!=-1 and paystatus=1 and wxid='.$Data008['wxid'].' and adddate>'.strtotime($nowday).' group by memberid) as t';
		$daypayuser          = $GLOBALS['db']->getOne($sql);

        //今日线上付款金额
		$ordernum            =  $app_order->getOne('sum(order_amount)','where status!=-1 and paystatus=1 and adddate>'.strtotime($nowday).' and wxid='.$Data008['wxid']);


		/*if(empty($wxnum)){
			$app_wechat_count = M('app_wechat_count');
			$access_token = getAccessToken($Data008['wxid']);
			if(!empty($access_token)){
				//获取用户增减数据
				$url  ='https://api.weixin.qq.com/datacube/getusersummary?access_token='.$access_token;//access_token改成你的有效值
				//获取累计用户数据
				$url2 ='https://api.weixin.qq.com/datacube/getusercumulate?access_token='.$access_token;
				//昨天情况
				$data=json_encode(array('begin_date'=>date("Y-m-d",strtotime("-1 day")),'end_date'=>date("Y-m-d",strtotime("-1 day"))));
				$outputYsummary = curlPost($url,$data);
				$outputYcumulate= curlPost($url2,$data);
				//
			    $tokensummary= (array)json_decode($outputYsummary);
			    //
			  	$tokencumulate= (array)json_decode($outputYcumulate);
			  	if(empty($tokensummary['list'])){
		      		$countdata['user_source'] = 0;
		      		$countdata['new_user']    = 0;
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
		      	$countdata['wxid'] =$Data008['wxid'];
		      	$app_wechat_count->doAdd($countdata,'id');
		      	$this->cache->PutHCache('wxcount',$Data008['wxid']);
		    }else{$wxnum = array('cumulate_user'=>0,'new_user'=>0,'cancel_user'=>0);}
		}
		*/
		$websiteinfo   = $this->cache->GetHCache('website',$Data008['wxid']);//读出缓存
		$package       = $websiteinfo['package'];

        $versionname   = $this->cache->GetA('commonpackageversion','versionename',$package,'versionname');
		$result['versionname'] = $versionname;//当前网校的版本
		$result['websiteinfo'] = $websiteinfo;//当前网校的信息

		$result['ordernum']    = $ordernum;//今日销售额
		//$result['orderMnum']   = $orderMnum;//本月销售量总额
		$result['daypayuser']  = $daypayuser;//今日付费学员数
		$result['payorderuser']= $payorderuser;//总付费学员数
		return $result;
	}
	/**
     * 新注册会员，网站初始化的信息进入数据库
     * @param mixed $Data010
	 */
	public function initialStoreData($Data010){
		$Datafour['status']         = 3;
		//pc风格
		$pctemp     = $this->cache->GetA('tempinfo','temptype',2);
		foreach ($pctemp as $k => $v){
			if($v['isdefault']==1&&$v['skintype']==$Data010['userinfo']['usertype']){
				$tempid = $v['tempid'];
				break;
			}
		}
		if(empty($tempid)){
			foreach ($pctemp as $k => $v){
				if($v['isdefault']==1&&$v['skintype']==0){
					$tempid = $v['tempid'];
					break;
				}
			}
		}
		if(empty($tempid)){
			$tempid= 15;
		}
		useTemp($Data010['wxid'],$tempid,2);  //PC模板初始化
		//手机风格
		$xttemp     = $this->cache->GetA('tempinfo','temptype',1);
		foreach ($xttemp as $k => $v){
			if($v['isdefault']==1&&$v['skintype']==$Data010['userinfo']['usertype']){
				$tempid2 = $v['tempid'];
				break;
			}
		}
		if(empty($tempid2)){
			foreach ($xttemp as $k => $v){
				if($v['isdefault']==1&&$v['skintype']==0){
					$tempid2 = $v['tempid'];
					break;
				}
			}
		}
		if(empty($tempid2)){
			$tempid2= 12;
		}
	    useTemp($Data010['wxid'],$tempid2,1);  //手机公众号模板初始化
        $appids    = initialAPP();//默认开启的app
		if(is_array($appids)){
		   $number    = count($appids);
		}else{
		   $number    = 0;
		}
		$Datafour['wxid']           = $Data010['wxid'];
		$Datafour['initial']        = 0;
		$Datafour['sitename']       = isset($Data010['sitename'])?$Data010['sitename']:ChkSQL(KS_G('request.sitename'));
		$Datafour['seotitle']       = isset($Data010['sitename'])?$Data010['sitename']:ChkSQL(KS_G('request.sitename'));
		$Datafive['categoryid']     = $Datafour['categoryid'] = ChkClng(KS_G('request.categoryid'));
		//插第二张表
		$areaModel = M('common_area');
		$areaid    = ChkClng(KS_G('post.areaid'));
		if($areaid!=0){
			$depth = $areaModel->getOne('depth',"where id=$areaid limit 1");
			if($depth==3){
				$Datafive['countyid']   = $Datafour['countyid']   = $areaid;
				$Datafive['cityid']     = $Datafour['cityid']     = $areaModel->getOne('parentid',"where id=$Datafour[countyid] limit 1");
				$Datafive['provinceid'] = $Datafour['provinceid'] = $areaModel->getOne('parentid',"where id=$Datafour[cityid] limit 1");
			}elseif($depth==2){
				$Datafive['countyid']   = $Datafour['countyid']   = 0;
				$Datafive['cityid']     = $Datafour['cityid']     = $areaid;
				$Datafive['provinceid'] = $Datafour['provinceid'] = $areaModel->getOne('parentid',"where id=$Datafour[cityid] limit 1");
			}elseif($depth==1){
				$Datafive['countyid']   = $Datafour['countyid']   = 0;
				$Datafive['cityid']     = $Datafour['cityid']     = 0;
				$Datafive['provinceid'] = $Datafour['provinceid'] = $areaid;
			}
		}
		if($Data010['userinfo']['usertype'] == '1'){//用户地址
			$user_teacher    = M('common_user_teacher');
			$user_teacher->update($Datafive,'userid='.$Data010['userid']);
		}elseif($Data010['userinfo']['usertype'] == '2'){
			$user_school     = M('common_user_school');
			$user_school->update($Datafive,'userid='.$Data010['userid']);
		}
		$Datafour['logo']        = isset($Data010['logo'])?$Data010['logo']:ChkSQL(KS_G('request.logo'));
		if($Datafour['logo']!='/Public/admin/images/login/logo.png'){
			$Datafour['sharepic'] = $Datafour['wilogo'] = $Datafour['homelogo'] = $Datafour['logo'];
		}
		$websiteModel            = M('Application/WebsiteModel/common_user_website');
		$Rulefour['sitename']    = '网站名称|isEmpty';
		$Rulefour['logo']        = '网站logo|isEmpty';
		Chkpost($Datafour,$Rulefour,$websiteModel,'wxid='.$Data010['wxid']);
	
		//----------------------短信邮箱模板的初始化----------------------
		$Data005['wxid']     = $Data010['wxid'];
		$Data005['userid']   = $Data010['userid'];
		$this->OpenModel($Data005);
		//----------------------这里是app初始化----------------------
		$appuserrelate        = M('common_app_userrelate');
		$appuserrelate->delete('wxid='.$Data010['wxid']);
		$DataThree['wxid']    = $Data010['wxid'];
	    $DataThree['userid']  = $Data010['userid'];
		$DataThree['adddate'] = time();
		$site                 = $this->cache->GetACache('setting');//读出缓存

    foreach($appids as $k=>$v){
			$DataThree['appid']    = $v;
			if($v == 5 || $v == 7){
				if($site['isrealname']==1){
				    $realModel      = M('common_realname');
				    $real           = $realModel->getRow('where wxid = '.$Data010['wxid'].' and status = 1 limit 1');
				    if(!$real){
                        $url = M_URL('User','realName');
                        KS_INFO('请进行实名认证',0,$url,'',1);
                    }
				}
			}elseif($v == 6){
				$courseType[0]['subappid']=1;
                $courseType[1]['subappid']=2;
                $courseType[2]['subappid']=3;
                $courseType[3]['subappid']=4;
                $courseType[4]['subappid']=6;
				foreach($courseType as $kt=>$vt){
					$Dataseven['subappid'] = $vt['subappid'];
				 	$Dataseven['wxid']     = $Data010['wxid'];
				 	$Dataseven['adddate']  = time();
				 	$Dataseven['appid']    = $v;
				 	$Dataseven['userid']   = $Data010['userid'];
				 	$Dataseven['setting']  = beginSetting($v);
				 	$appuserrelate->doadd($Dataseven,'id');
				}
				$this->INI($v,$Data010['wxid'],$Data010['userinfo']['usertype']==1?2:1173);
			 	continue;
			}
			$setting              = beginSetting($v);//初始配置文件
			$DataThree['orderid'] = $number-$k;
			if($v==30){$DataThree['short']   = 0;}else{$DataThree['short']   = 1;}
			if(!empty($setting))$DataThree['setting'] = $setting;
			$RuleThree['appid']   = '您购买的应用|isEmpty,isDbexis';
			Chkpost($DataThree,$RuleThree,$appuserrelate,"wxid=".$Data010['wxid']." and isenabled=1",4);
			$appuserrelate->doAdd($DataThree,'id');
			$this->INI($v,$Data010['wxid']);                     //初始化网校数据
	}


        initialStoreService($Data010['wxid']);//网校的服务费用的赠送


		//----------------------这里是数据的初始化----------------------
		//---------------------------------------------
		//网站的基本信息，在前面获取了数据
        $Datafour["module"]= '["s-1","6","6-4","104","35","3","3-1","4","s-3","s-4","31"]';   //HOME首页快捷键
		$websiteModel->update($Datafour,"wxid=".$Data010['wxid']);
		$this->cache->PutHCache('website',$Data010['wxid']);//写入缓存
		$this->cache->putACache('domaininfo');
		$this->cache->PutHCache('apprelate',$Data010['wxid']);
		$this->cache->PutHCache('haveapprelate',$Data010['wxid']);

        //送代金卷------------------------------
//		$Datavoucher['wxid']     =  $Data010['wxid'];
//	    $Datavoucher['voucher']  =  '赠送代金卷'.wx_version_itemvalue(1);
//	    $Datavoucher['money']    =  wx_version_itemvalue(1);
//	    $Datavoucher['balance']  =  wx_version_itemvalue(1);
//	    $Datavoucher['adddate']  =  time();
//	    $Datavoucher['enddate']  =  time()+2592000;
//		$common_voucher          =  M('common_voucher');
//		$common_voucher->doAdd($Datavoucher,'id');



//		islive($Data010['wxid']);

	}


/**
 * 初始化app应用的数据
 * @param mixed $appid
 * @param mixed $nwxid
 * @param mixed $wxid
 * @param mixed $nuserid
 */
public function INI($appid,$nwxid,$wxid=2,$nuserid=0){
	switch($appid){
		case   2:  //网校分类
            $model = M('app_category');
            $values = $model->getAll('where wxid='.$wxid.' and parentid=0');
            $fields = $model->getFields();
		    foreach($values as $k=>$v){
                foreach($fields as $kk=>$vv){
                    $Data[$vv]= $v[$vv];
                }
                $Data['wxid']          = $nwxid;
                $Data['parentidpath'] = $model->getMaxValue('categoryid')+1;
                $Data['userid']       = $nuserid;
                $model->doAdd($Data,'categoryid');
                unset($Data);
            }
            break;
//		case  101:  //新闻资讯
//            $model = M('app_news');
//            $values = $model->getAll('where wxid='.$wxid.' and status!=-1');
//            $fields = $model->getFields();
//		    foreach($values as $k=>$v){
//                foreach($fields as $kk=>$vv){
//                    $Data[$vv]= $v[$vv];
//                }
//                $Data['wxid']          = $nwxid;
//                $Data['adddate']       = time();
//                $Data['userid']        = $nuserid;
//                $model->doAdd($Data,'id');
//                unset($Data);
//            }
//            break;
//        case 11:  //名师
//            $model = M('common_user');
//            $user_teacher    = M('common_user_teacher');
//            $values = $model->getAll('where wxid='.$wxid." and username<>'ksadmin' and usertype=1");
//            $fields = $model->getFields();
//            $teacher_fields=$user_teacher->getFields();
//            foreach($values as $k=>$v){
//                foreach($fields as $kk=>$vv){
//                    $Data[$vv]= $v[$vv];
//                }
//                $Data['wxid']=$nwxid;
//                $Data['regdate']=time();
//                $userid=$model->doAdd($Data,'userid');
//                unset($Data);
//
//                //插入名师表
//                $teacher_value  = $user_teacher->getRow('where userid='.$v['userid']);
//                foreach($teacher_fields as $tkk=>$tvv){
//                    $Data[$tvv]=  $teacher_value[$tvv];
//                }
//                $Data['userid']=$userid;
//                $user_teacher->doEfAdd($Data);
//                unset($Data);
//            }
//            break;
//            break;
//		case  5:  //用户分组
//            break;
		case  6:
            $model = M('app_course');
            $courseFields = $model->getFields();
            $values = $model->getAll('where wxid='.$wxid.' and status!=-1');
		    $chaptertableModel    = M('common_extends_table');
		    $chaptertablename     = $chaptertableModel->getOne('tablename','where Isdefault=1 and type =1');
		    $mychapterModel       = M('App/ExtendTableModel/'.$chaptertablename);
		    foreach($values as $k=>$v){

                foreach($courseFields as $kk=>$vv){
                    $Data[$vv]= $v[$vv];
                }
                $Data['wxid']          = $nwxid;
                $Data['adddate']       = time();
                $Data['chaptertable']  = $chaptertablename;
                $Data['userid']        = $nuserid;
                $courseid  = $model->doAdd($Data,'courseid');
                unset($Data);
                if(!empty($v['chaptertable'])){
                    $chapterModel      = M('App/ExtendTableModel/'.$v['chaptertable']);
                    $fields            = $chapterModel->getColumn();
                    $root              = $mychapterModel->getMaxValue("root")+1;
                    $other['oldwxid']      = $wxid;
                    $other['oldcourseid']  = $v['courseid'];
                    $relpace['wxid']       = $nwxid;
                    $relpace['courseid']   = $courseid;
                    $relpace['root']       = $root;
                    $relpace['userid']     = $nuserid;
                    $chaptervalue      = $chapterModel -> getAll('where wxid='.$other['oldwxid'].' and courseid='.$other['oldcourseid'].' and status!=-1 and parentid=0 order by chapterid asc');
                    foreach($chaptervalue as $kt=>$vt){
                        $chapterid      = $mychapterModel->getMaxValue("chapterid")+1;
                        $relpace['parentidpath']  = $chapterid;
                        $relpace['chapterid']     = $chapterid;
                        $other['where']           = "where chapterid=".$vt["chapterid"];
                        $other['oldchapterid']    = $vt["chapterid"];
                        $mychapterModel->insertdata($fields,$relpace,$chapterModel,$other['where']);
                        ReplceSubChapeter($fields,$relpace,$mychapterModel,$chapterModel,$other);
                    }
                }
            }
        break;
//        case 35:   //社群
//            $model = M('app_team');
//            $values = $model->getAll('where wxid='.$wxid.' and status!=-1');
//            $fields= $model->getFields();
//            foreach($values as $k=>$v){
//                foreach($fields as $kk=>$vv){
//                    $Data[$vv]= $v[$vv];
//                }
//                $Data['wxid']=$nwxid;
//                $Data['create_uid']=$nuserid;
//                $Data['create_time']=time();
//                $Data['topic_num']=0;
//                $model->doAdd($Data,'id');
//                unset($Data);
//            }
//            break;
        case 106: //专栏
            $model = M('app_column');
            $values = $model->getAll('where wxid='.$wxid.' and status!=-1');
            $fields= $model->getFields();
            foreach($values as $k=>$v){
                foreach($fields as $kk=>$vv){
                    $Data[$vv]= $v[$vv];
                }
                $Data['wxid']=$nwxid;
                $Data['userid']=$nuserid;
                $Data['adddate']=time();
                $model->doAdd($Data,'columnid');
                unset($Data);
            }
            break;
        case -1: //广告轮播图
            $model = M('app_carousel');
            $values = $model->getAll('where type=4 and wxid='.$wxid);
            $fields= $model->getFields();
            foreach($values as $k=>$v){
                foreach($fields as $kk=>$vv){
                    $Data[$vv]= $v[$vv];
                }
                $Data['wxid']=$nwxid;
                $model->doAdd($Data,'id');
                unset($Data);
            }
            break;
		default:;
	}
}

	//模块开关switch
	public function moduleswitch($Data008){
		$id             = isset($Data008['id'])?$Data008['id']:ChkClng(KS_G('get.id'));
		if($id>8||$id<0){KS_INFO('参数不符合要求');}
		$websiteinfo    = $this->cache->GetHCache('website',$Data008['wxid']);//读出缓存
		$module         = explode('|',$websiteinfo['module']);
		$module[$id]    = isset($Data008['switch'])&&$Data008['switch']=='on'?0:1;
		$Data['module'] = implode('|',$module);
		$websiteModel   = M('Application/WebsiteModel/common_user_website');
		//网站的基本信息，在前面获取了数据
		$websiteModel->update($Data,'wxid='.$Data008['wxid']);
		$this->cache->PutHCache('website',$Data008['wxid']);//写入缓存
		//开启模块
		if(!isset($Data008['switch'])||$Data008['switch']!='on'){
		     switch($id) {
					case 0://pc网校
					$appids = initialAPP(1);
					break;
					case 4://ERP管理
					$appids = initialAPP(8);
					break;
					case 5://招生营销
					$appids = initialAPP(5);
					break;
		     }
			 if(!empty($appids)){
			     foreach($appids as $k=>$v){
				       $Data001['userid']  = $Data008['userid'];
				       $Data001['wxid']    = $Data008['wxid'];
					   $Data001['type']    = 1;
				       $Data001['appid']   = $v;
					   $this->appopen($Data001);
				 }
			 }

		}
	}
	/**
	 * 开通app
     * @param mixed $Data001
	 * @return mixed
	 */
	public function appopen($Data001){
	    $Data['appid']    = $Data001['appid'];
	    $site             = $this->cache->GetACache('setting');//读出缓存
	    if($Data['appid'] == 5 || $Data['appid'] == 7){
	    	if($site['isrealname']==1){
	    		$realModel = M('common_realname');
			    $real      = $realModel->getRow('where wxid = '.$Data001['wxid'].' and status = 1 limit 1');
			    if(!$real){$url =  M_URL('User','realName');KS_INFO('请进行实名认证',0,$url);}
	    	}
                if($Data['appid'] == 7){
				$liveModel = M('app_live');$live = $liveModel->getRow('where wxid = '.$Data001['wxid'].'  limit 1');
				if(!$live){$Data1['wxid']    = $Data001['wxid'];$Data1['status']  = 1;$Data1['setting'] = '※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※※';$liveModel->doAdd($Data1,'id');}
			}
	    }
	    $setting        = beginSetting($Data['appid']);//初始配置文件
	    $appuserrelate  = M('common_app_userrelate');
	    $app            = $this->cache->GetH('apprelate','appid',$Data['appid'],'',$Data001['wxid'],true);
	    if($app){
	    	if($app['isenabled'] == 1){
			    if(isset($Data001['type'])&&$Data001['type']=='1'){
				    return false;
				}else{
					KS_INFO("您已开通");
				}
			}else{
	    		$Data2['short']     = 1;
	    		$Data2['isenabled'] = 1;
	    		$Data2['orderid']   = $appuserrelate->getMaxValue('orderid','wxid='.$Data001['wxid'])+1;
	    		$appuserrelate->update($Data2,'id='.$app['id']);
	    		$result             = $app['id'];
	    	}
	    }else{
		    if(isset($Data001['type'])&&$Data001['type']=='1'){
				$appcount       = $appuserrelate->getOne('count(*)','where wxid='.$Data001['wxid'].' and appid='.$Data['appid']);
			    if($appcount>0)return false;
			}
		    $Data['orderid'] = $appuserrelate->getMaxValue('orderid','wxid='.$Data001['wxid'])+1;
		    $Data['userid']  = $Data001['userid'];
		    $Data['wxid']    = $Data001['wxid'];
		    $Data['short']   = 1;
		    if(!empty($setting))$Data['setting'] = $setting;
		    $Data['adddate'] = time();
			$Rule['appid']   = '您购买的应用|isEmpty,isDbexis';
			Chkpost($Data,$Rule,$appuserrelate,'wxid='.$Data001['wxid'],4);
		    $result = $appuserrelate->doAdd($Data,'id');
		    $this->INI($Data['appid'],$Data001['wxid'],2,$Data001['userid']);
	    }
		$this->cache->PutHCache('apprelate',$Data001['wxid']);
		$this->cache->PutHCache('haveapprelate',$Data001['wxid']);
		return $result;
   }
   //获得app列表数据
   public function getappOptions($maxperpage){
		$maxperpage = ChkClng($maxperpage);
		$wxid       = ChkClng(getsession('user','wxid'));
		$appModel   = M('common_app');
		$sql        = "select count(*) from $this->table as a inner join $appModel->table as b on a.appid = b.appid where a.appid!=6 and a.wxid=$wxid and  b.status = 1 and a.isenabled=1";
		$total      = $GLOBALS['db']->getOne($sql);
		$options    = array('totalput' => $total,    //总行数
             'maxperpage'  => $maxperpage,        //每页显示量
        );
        return $options;
   }
   //得到app列表
   public function getappPage($page){
		$wxid       = ChkClng(getsession('user','wxid'));
		$appModel   = M('common_app');
        $sql        = "select * from $this->table as a inner join $appModel->table as b on a.appid = b.appid where a.appid!=6 and a.wxid=$wxid  and b.status = 1 and a.isenabled=1 order by a.orderid desc limit $page->first_row ,$page->maxperpage";
	    $pagevalue  = $GLOBALS['db']->getAll($sql);
        return $pagevalue;
    }
	//得到快捷方式
	public function getshort(){
		$wxid      = ChkClng(getsession('user','wxid'));
		$appModel  = M('common_app');
		$sql       = "select a.id,b.appname,b.basictype,b.fonts,a.appid,b.categoryid from $this->table as a inner join $appModel->table as b on a.appid = b.appid where a.wxid=$wxid and b.status = 1 and b.isweb = 1 and a.short=1 and b.MustChoose=0 order by a.orderid desc";
		//$sql       = "select a.id,b.appname,b.basictype,b.fonts,a.appid,b.categoryid from $this->table as a left join $appModel->table as b on a.appid = b.appid where a.wxid=$wxid and b.status = 1 and b.isweb = 1 and a.short=1 order by a.orderid desc";
        $shortapp  = $GLOBALS['db']->getAll($sql);
	    return	$shortapp;
	}
	//未开通的推荐应用--这个在初始页
	public function getrecommend(){
		$wxid      = ChkClng(getsession('user','wxid'));
		$appModel  = M('common_app');
		//$sql       = "select * from $appModel->table where status = 1 and isrec=1 and MustChoose=0 and appid not in(select a.appid from $this->table as a left join $appModel->table as b on a.appid = b.appid where a.wxid=$wxid and isenabled=1) order by orderid asc";

		$sql       = "select * from $appModel->table where status = 1 and isrec=1 and appid not in(select a.appid from $this->table as a left join $appModel->table as b on a.appid = b.appid where a.wxid=$wxid and isenabled=1) order by orderid asc";
		$shortapp  = $GLOBALS['db']->getAll($sql);
	    return	$shortapp;
	}
	//未开通的推荐应用--这个不在初始页
	public function getremycommend(){
		$wxid      = ChkClng(getsession('user','wxid'));
		$appModel  = M('common_app');
		$sql       = "select * from $this->table as a left join $appModel->table as b on a.appid = b.appid where a.wxid=$wxid and a.isenabled=0 order by a.orderid asc";
		$shortapp  = $GLOBALS['db']->getAll($sql);
	    return	$shortapp;
	}
	// 网站配置里那些必须应用
	public function getMustChoose(){
		$wxid           = ChkClng(getsession('user','wxid'));
		//$sql            = "select * from $this->table where status=1 and MustChoose=1";
		$sql            = "select * from $this->table where status=1";
		$nustchooseapp  = $GLOBALS['db']->getAll($sql);
	    return	$nustchooseapp;
	}
	//展示对应消息开启的情况，有展示的都是应该可以发的
    public function show_mail($Data006){
    	$smsstatus    = $this->cache->GetH('smsmodel','modelname',$Data006['modelname'],'status',$Data006['wxid']);
    	$emailstatus  = $this->cache->GetH('emailmodel','model',$Data006['modelname'],'status',$Data006['wxid']);
		$html  = '';
		if(getSetting(1,17,$Data006['wxid'])==1&&!empty($smsstatus)){
			$html .= '<label for="id1" class="label-on">
      			<input type="checkbox" id="id1" value="1" class="radioInput" name="messagetype[]" checked="">短信</label>';
		}
		if(getSetting(1,18,$Data006['wxid'])==1&&!empty($emailstatus)){
			$html .= '<label for="id2" class="label-on">
      			<input type="checkbox" id="id2" value="2" class="radioInput" name="messagetype[]" checked="">邮箱</label>';
		}
		$html .= '<label for="id3" class="label-on">
      			<input type="checkbox" id="id3" value="3" class="radioInput" name="messagetype[]" checked="">站内信息</label>';
      	$html .= '<label for="id4" class="label-on">
      			<input type="checkbox" id="id4" value="4" class="radioInput" name="messagetype[]" checked="">微信模板消息</label>';
		return $html;
    }
	//$Data['type']= 1;// 模板名(modelname):手机，邮箱
	//$Data['type']= 2;// 模板名(modelname):老师id(userid)
	//$Data['type']= 3;// 模板名(modelname):网校id(wxid):手机，邮箱:
	//$Data['type']= 4;// 模板名(modelname):学员id(memberid) $usrids
    public function SendEx($sendtype,$Data,$usrids=array()){
    	if(empty($sendtype)){return false;}
    	$rusult  = false;
    	switch($Data['type']){
case '1' :break;
case '2' :$usermodel        = M('common_user');
		  $userinfo         = $usermodel->getRow("where userid=$Data[userid] limit 1");
		  $Data['wxid']     = $userinfo['wxid'];
		  $Data['mobile']   = $userinfo['mobile'];
		  $Data['email']    = $userinfo['email'];break;
case '3' :break;
case '4' :$usermodel        = M('common_user');
		  $userinfo         = $usermodel->getRow("where userid=$Data[memberid] limit 1");
		  if(empty($userinfo)){return  false;}
		  $Data['wxid']     = $userinfo['wxid'];
		  $Data['userid']   = $userinfo['parentid'];
		  $Data['mobile']   = $userinfo['mobile'];
		  $Data['username'] = $userinfo['username'];
		  $Data['email']    = $userinfo['email'];break;
		  default:break;
	    }
    	foreach($sendtype as $k=>$v){
    		switch($v){
//发送短信
case '1' :$this->qqsendsms($Data);break;
//发送邮件
case '2' :$this->qqsendemail($Data);break;
//发送站内信
case '3' :$SmsModel=M('Application/SmsModel');$SmsModel->qqsendmail($Data,$usrids);break;
//发送微信公众号
case '4' :$this->WeChatmessage($Data);break;
			 default:break;
		    }
    	}
    	return $rusult;
    }
	//发送短信
	public function qqsendsms($Data){
		 switch($Data['type']){
case '1' :$result = $this->Sms->SendEx($Data['mobile'],$Data['modelname'],'userReg','','','',$Data);break;
case '2' :$result = $this->Sms->SendEx($Data['mobile'],$Data['modelname'],'userCor','',$Data['wxid'],$Data['userid'],$Data);break;
case '3' :$result = $this->Sms->SendEx($Data['mobile'],$Data['modelname'],'memberReg','',$Data['wxid'],'',$Data);break;
case '4' :$result = $this->Sms->SendEx($Data['mobile'],$Data['modelname'],'memberCor',$Data['memberid'],$Data['wxid'],$Data['userid'],$Data);break;
		 default:break;
		 }
	}
	//发送邮件
	public function qqsendemail($Data){
		switch($Data['type']){
case '1':$emailModel    = M('Application/SmsModel');
	     $result        = $emailModel->send_email($Data['email'],$Data['modelname'],'userReg','','','',$Data);break;
case '2':$emailModel    = M('Application/SmsModel');
	     $result        = $emailModel->send_email($Data['email'],$Data['modelname'],'userCor','',$Data['wxid'],$Data['parentid'],$Data);break;
case '3':$emailModel    = M('Application/SmsModel');
	     $result        = $emailModel->send_email($Data['email'],$Data['modelname'],'memberReg','',$Data['wxid'],'',$Data);break;
case '4':$emailModel    = M('Application/SmsModel');
	     $result        = $emailModel->send_email($Data['email'],$Data['modelname'],'memberCor',$Data['memberid'],$Data['wxid'],$Data['userid'],$Data);break;
	    default:break;
		}
	}
	//微信模板消息
	public function WeChatmessage($Data){
		return false;
		switch($Data['type']){
case '1':$emailModel    = M('Application/SmsModel');
	     $result        = $emailModel->send_email($Data['email'],$Data['modelname'],'userReg','','','',$Data);break;
case '2':$emailModel    = M('Application/SmsModel');
	     $result        = $emailModel->send_email($Data['email'],$Data['modelname'],'userCor','',$Data['wxid'],$Data['parentid'],$Data);break;
case '3':$emailModel    = M('Application/SmsModel');
	     $result        = $emailModel->send_email($Data['email'],$Data['modelname'],'memberReg','',$Data['wxid'],'',$Data);break;
case '4':$emailModel    = M('Application/SmsModel');
	     $result        = $emailModel->send_email($Data['email'],$Data['modelname'],'memberCor',$Data['memberid'],$Data['wxid'],$Data['userid'],$Data);break;
	    default:break;
		}
	}
	//开通点播
	public function OpenVod($Data){
		$vodModel            = M('app_vod');
		$Data['status']      = 1;
		$Data['spacestatus'] = 1;
		$vodModel->doAdd($Data,'id');
	}
	//开通门户模板
	public function OpenTemp($Data002){
		$app_temp                = M('app_temp');//实例化云服务表
		$common_label            = M('common_label');//实例化云服务表
		$app_label               = M('app_label');//实例化云服务表
		$value                   = $this->cache->GetA('tempinfo','tempid',$Data002['tempid'],'',true);
		$dir1                    = PC_PATH.$value['installdir'];
		$dir2                    = ROOT.'Skin/'.$Data002['wxid'].'/PC/'.$value['installdir'];
		if($Data002['tempid']!=15){$this->File->copyDir($dir1,$dir2);}
		$Data['tempid']          = $Data002['tempid'];
		$Data['wxid']            = $Data002['wxid'];
		$Data['tempname']        = $value['tempname'];
		$Data['temptype']        = 0;
		$Data['installdir']      = $value['installdir'];
		$Data['defaultpic']      = $value['defaultpic'];//应用封面图片
		$Data['author']          = $value['author'];
		$Data['intro']           = $value['intro'];
		$Rule['tempname']        = '模板风格名称|isEmpty,isDbexis';
		$Rule['installdir']      = 'PC模板目录|isEmpty,isEnglish';
		$Rule['defaultpic']      = '预览图片|isEmpty';
		Chkpost($Data,$Rule,$app_temp,'wxid='.$Data002['wxid']);
		$app_temp->doAdd($Data,'id');
		$this->cache->PutHCache('tempinfo',$Data002['wxid']); //把temp信息存入缓存
		$Labelarr                = $common_label->getAll('where tempid='.$Data002['tempid']);
		$DataTwo['tempid']       = $Data002['tempid'];
		$DataTwo['wxid']         = $Data002['wxid'];
		$DataTwo['adddate']      = time();
		foreach($Labelarr as $k=>$v){
			$DataTwo['labelid']      = $v['labelid'];
			$DataTwo['labelname']    = $v['labelname'];
			$DataTwo['labelcontent'] = EncodeSQL($v['labelcontent']);
			$DataTwo['labeltype']    = $v['labeltype'];
			$app_label->doAdd($DataTwo,'id');
		}
		$this->cache->PutLCache('labelinfo',$Data002['tempid'],'',$Data002['wxid']);

	}
	//开通PC学堂模板
	public function OpenXTTemp($Data003){
		$value                = $this->cache->GetA('tempinfo','tempid',$Data003['tempid'],'',true);
		$Data['tempid']       = $Data003['tempid'];
		$Data['wxid']         = $Data003['wxid'];
		$Data['tempname']     = $value['tempname'];
		$Data['temptype']     = 2;
		$Data['installdir']   = $value['installdir'];
		$Data['defaultpic']   = $value['defaultpic'];//应用封面图片
		$Data['author']       = $value['author'];
		$Data['intro']        = $value['intro'];
		$app_temp             = M('app_temp');//实例化云服务表
		$Rule['tempname']     = '模板风格名称|isEmpty,isDbexis';
		$Rule['installdir']   = 'PC模板目录|isEmpty,isEnglish';
		$Rule['defaultpic']   = '预览图片|isEmpty';
		Chkpost($Data,$Rule,$app_temp,'wxid='.$Data003['wxid']);
		$app_temp->doAdd($Data,'id');
		$this->cache->PutHCache('tempinfo',$Data003['wxid']); //把temp信息存入缓存

		$Data006['tempid'] = $Data['tempid'];
		$Data006['wxid']   = $Data['wxid'];
		$this->copybackgroup($Data006);

		$common_label         = M('common_label');//实例化云服务表
		$app_label            = M('app_label');//实例化云服务表
		$Labelarr             = $common_label->getAll('where tempid='.$Data003['tempid']);
		foreach($Labelarr as $k=>$v){
			$DataTwo['tempid']       = $Data003['tempid'];
			$DataTwo['wxid']         = $Data003['wxid'];
			$DataTwo['labelid']      = $v['labelid'];
			$DataTwo['labelname']    = $v['labelname'];
			$DataTwo['adddate']      = time();
			$DataTwo['labelcontent'] = EncodeSQL($v['labelcontent']);
			$DataTwo['labeltype']    = $v['labeltype'];
			$app_label->doAdd($DataTwo,'id');
		}
		$this->cache->PutLCache('labelinfo',$Data003['tempid']);
	}
	//开通PC学堂模板
	public function copybackgroup($Data006){
		$common_roomsetting   = M('common_roomsetting');//实例化云服务表
		$app_roomsetting      = M('app_roomsetting');//实例化云服务表
		if(isset($Data006['type'])&&!empty($Data006['type'])){
			$settingarr           = $common_roomsetting->getAll('where tempid='.$Data006['tempid'].' and type='.$Data006['type']);
		}else{
			$settingarr           = $common_roomsetting->getAll('where tempid='.$Data006['tempid']);
		}
		foreach($settingarr as $k=>$v){
			$Data['tempid']   = $Data006['tempid'];
			$Data['wxid']     = $Data006['wxid'];
			$Data['filename'] = $v['filename'];
			$Data['fileurl']  = $v['fileurl'];
			$Data['adddate']  = time();
			$Data['type']     = $v['type'];
			$Data['ism']      = $v['ism'];
			$app_roomsetting->doAdd($Data,'id');
		}
	}
	//学堂模板的统一设置
	public function backgroup($Data007){
		$wxid = $GLOBALS['_DoM']['wxid'];
		$result['tempPxt'] =  $this->cache->GetA('domaininfo','wxid',$wxid,'tempPxt');//写入缓存
		//用户设置的音量
		$Mode   = M('common_user_member');
		$Modes  = M('app_roomsetting');
		if(isset($Data007['memberid'])){//用户是否登录
			$backgroundStyle = $Mode->getOne('backgroundStyle','where userid='.$Data007['memberid']);
			$backgroundStyle = explode('※',$backgroundStyle);
			if(empty($backgroundStyle[0])){
				if(!empty($background['3'])){$GLOBALS['_DoM']['tempPxt'] = $background['3'];}
				$background = $Modes->getOne('fileurl','where wxid='.$wxid.' and tempid='.$GLOBALS['_DoM']['tempPxt'].' and type=1 and ism=1 limit 1');
			}else{
				$background = $Modes->getOne('fileurl','where id='.$backgroundStyle['0'].' and tempid='.$backgroundStyle['3']);
				if(empty($background)){
					$background = $Modes->getOne('fileurl','where tempid='.$backgroundStyle['3'].' and ism=1');
				}
			}
			if(empty($backgroundStyle[1])){
				$backmusic = '/Tp/PCXT/Skin01/Public/live/muxue.mp3';
			}else{
				$backmusic = $Modes->getOne('fileurl','where id='.$backgroundStyle['1']);
			}
			if(empty($backgroundStyle[2])){$volume = 50;
			}else{$volume = $backgroundStyle[2];}
		}else{
			$this->memberinfo['username']='visitor';
			$this->memberinfo['name']='游客';
			$backgroundStyle['0'] = -1;
			$backgroundStyle['1'] = -1;
			$background  = $Modes->getOne('fileurl','where tempid='.$result['tempPxt'].' and ism=1');
			$backmusic   = '/Tp/PCXT/Skin01/Public/live/muxue.mp3';
			$volume      = 50;
		}
		$result['background']       = $background;
		$result['backgroundStyle']  = $backgroundStyle;
		$result['backmusic']        = $backmusic;
		$result['volume']           = $volume;
		return $result;
	}
	//开通短信，邮箱模板
	public function OpenModel($Data005){
		$site                 = $this->cache->GetACache('setting');//读出缓存
		if($site['initialsmsmodel']==1){
			$cachemodel        = $this->cache->GetACache('smsmodel');
	   	    $Data['wxid']      = $Data005['wxid'];
	        $Data['userid']    = $Data005['userid'];
	        $Data['status']    = 1;
	        $SmsModel          = M('app_sms_content');
	   	    foreach($cachemodel as $k=>$v){
	   	    	$Data['model']     = $v['model'];
		        $Data['modelname'] = $v['modelname'];
		        $Data['content']   = $v['content'];
		        $SmsModel->doadd($Data,"id");
	   	    }
	   	    $this->cache->PutHCache('smsmodel',$Data005['wxid']);
		}
		if($site['initialemailmodel']==1){
			$commonemailModel   = M('common_email_content');
	   	    $cachemodel         = $commonemailModel->getAll('');
	   	    $Datas['wxid']      = $Data005['wxid'];
	        $Datas['userid']    = $Data005['userid'];
	        $Datas['status']    = 1;
	        $emailModel         = M('app_email_content');
	   	    foreach($cachemodel as $k=>$v){
	   	    	$Datas['model']     = $v['model'];
		        $Datas['modelname'] = $v['modelname'];
		        $Datas['content']   = $v['content'];
		   	    $emailModel->doadd($Datas,"id");
	   	    }
	   	    $this->cache->PutHCache('emailmodel',$Data005['wxid']);
		}
		if($site['initialmassage']==1){
			$massagemodel      = $this->cache->GetACache('massagemodel');
	   	    $Data['wxid']      = $Data005['wxid'];
	        $Data['userid']    = $Data005['userid'];
	        $Data['status']    = 1;
	        $massageModel      = M('app_information_content');
	   	    foreach($massagemodel as $k=>$v){
	   	    	$Data['model']     = $v['model'];
		        $Data['modelname'] = $v['modelname'];
		        $Data['content']   = $v['content'];
		        $massageModel->doadd($Data,"id");
	   	    }
	   	    $this->cache->PutHCache('massagemodel',$Data005['wxid']);
		}
	}
}