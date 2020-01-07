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
class VdoController  extends CommonController{

    /**
     * 视频管理列表
     */
    public function indexAction(){
    	 $now_page =  ChkClng(KS_S('p',1));

		 $vodlistModel = M('app_vod_list');
         //$values =  $vodlistModel->getAll('');
		 $keyword = ChkSQL(KS_S('keyword'));
		 $keytype = ChkClng(KS_S('keytype',1));
		 $status=KS_S('status',3);
		 $byname=null !==GF('byname') ? GF('byname'):'desc';//排序
		 $where = 'where 1=1';
		 if($status!=3){ $where.= ' and status="'.$status.'"';}
         if($keyword){
          	if($keytype==1){
          		$where.=' and vdoName like "%'.$keyword.'%"';
            }else if ($keytype==3){
                $where.=' and vdoSize<='.$keyword;
          	}else{
          		$where.=' and wxid='.ChkClng($keyword);
            }
         }
		 $options = $vodlistModel->getOptions('10',$where);//分页参数设置
		 $page    = Page($options);
		 $values   = $vodlistModel->getPage($page,'adddate '.$byname,$where);
		 include  CURR_VIEW_PATH . "Vod/admin.vodlist.php";
    }

    public function batchAction(){
        $val=KS_S("batch");
        $ids=KS_S("vdoId");
        $ids=implode($ids,",");
        $ids="'".str_replace(",","','",$ids)."'";
        if ($val==5){
            $this->vdoUpdateAction($ids);
            KS_Alert('恭喜，更新完毕！','success',KS_ComeUrl());
        }else if ($val==4){   //批量删除
            $this->delVdoAction($ids);
        }
    }
    /**
     * 一键更新远程数据到本地，如容量,长度等
     */
    public function vdoUpdateAction($ids=''){
        set_time_limit(0);
        $db= M('app_vod_list');
        if ($ids!=''){
        $vodlist= $db->getAll('where vdoId in('.$ids.')');
        }else{
            $vodlist= $db->getAll();
        }
        echo '<li>共找到'.count($vodlist).'个视频 ，正在更新中...</li>';
        $num=0;
        $tencentvod = new Core\Tencentvdo();
        $vod = new Core\Playvdo();
        foreach($vodlist as $k=>$v){
            if ($v['vdoService']==10){    //腾讯视频
                $issuccess=$tencentvod->updateVideoInfo($v['vodId']);
            }else{                    //阿里视频
                $issuccess=$vod->updateVideoInfo($v['vdoId']);
            }
            $num=$num+1;
            echo '<li>已更新 '. $num .' 个视频   '.($issuccess?'成功':'<font color=red>失败</font>').'</li>';
            ob_flush();
            flush();
            sleep(1);                 //接口，限制100次/分钟，所以要暂停
        }
        echo '<li>更新完毕</li>';
        ob_end_flush();
        
    }

    /**
     * 单个视频同步更新
     */
    public function singleUpdateAction(){
        $vdoId= KS_S('vdoId');
        $vdoservice=ChkClng(KS_S("vdoservice"));
        if ($vdoservice==10){   //腾讯视频
            $tencentvod = new Core\Tencentvdo();
            $issuccess=$tencentvod->updateVideoInfo($vdoId);
        }else{                  //阿里视频
            $vod = new Core\Playvdo();
            $issuccess=$vod->updateVideoInfo($vdoId);
        }
        if ($issuccess){
            KS_Alert('恭喜，更新成功！','success',KS_ComeUrl(),true);
        }else{
            KS_Alert('对不起，更新失败！','error',KS_ComeUrl(),true);
        }
    }


	/**
     * 删除视频（同时删除远程的文件)
	 */
	public function delVdoAction($ids=''){
		    $now_page =  ChkClng(KS_S('p',1));
            $db = M('app_vod_list');
            if ($ids){
                $list=  $db->getAll('where vdoId in('.$ids.')');
            }else{
                $id       =  FilterIds(KS_G('get.id'));
                $list=$db->getAll('where id in('.$id.')');
            }
            if ($list){
                foreach($list as $k=>$v){
                    if ($v['vdoService']==10){
                        $tencentvod = new Core\Tencentvdo();
                        $result=$tencentvod->DeleteVideoFromService($v['vdoId']);
                    }else{
                         $vod       = new Core\Playvdo();
                         $VideoInfo = $vod->GetVideoInfo($vdoId);
                         if(!isset($VideoInfo->Code)){
                             $vod->deleteVideo($vdoId);
                         }
                    }
                    $db->delete('id='.$v['id']);
                }
            }


		$url=M_URL('Vdo','index','',GP('p-'.$now_page,true));
        ks_header($url);
	}
	/**
     * 跳出确认删除
	 */
	public function confirmdelAction(){
	    $id          =  ChkClng(KS_G('get.id'));
		$vdoId       =  ChkSQL(GF('vdoId'));
	    $now_page    =  ChkClng(KS_S('p',1));
	    include  CURR_VIEW_PATH . "Vod/admin.confirmdel.php";
	}
	/**
     * 验证确认删除
	 */
	public function doconfirmdelAction(){
	    $password      = ChkSQL(KS_G('password'));
		if($password=='654321'){
		    $vdoId       =  ChkSQL(KS_G('vdoId'));
		    $id          =  ChkClng(KS_G('get.id'));
			$now_page    =  ChkClng(KS_S('p',1));
			$url         =  M_URL('Vdo','delVdo',$id,GP('vdoId-'.$vdoId.',p-'.$now_page,true));
			KS_INFO('删除成功',3,$url,'',1);
			//ks_header($url);
		}else{
		    KS_INFO('密码错误',0,'','',1);
		}
	}
	//对象存储科汛的表
	public function OssAction(){
    	 $now_page =  ChkClng(KS_S('p',1));
		 $keyword = ChkSQL(KS_S('keyword'));
		 $keytype = ChkClng(KS_S('keytype',1));
		 $tableid=null !==GF('tableid') ? GF('tableid'):11;

		 $extendTable    = new ExtendTableModel('common_extends_table');
		 $tablename      = $extendTable->getOne('tablename','where tableid = '.$tableid);
		 $vodlistModel   = M($tablename);

		 $status=KS_S('status',3);
		 $byname=null !==GF('byname') ? GF('byname'):'desc';//排序
		 $where = 'where 1=1';
		 if($status!=3){ $where.= ' and status="'.$status.'"';}
         if($keyword){
          	if($keytype==1){
          		$where.=' and filename like "%'.$keyword.'%"';
          	}else{
          		$where.=' and wxid='.ChkClng($keyword);
            }
         }
		 $options = $vodlistModel->getOptions('10',$where);//分页参数设置
		 $page    = Page($options);
		 $values   = $vodlistModel->getPage($page,'id '.$byname,$where);


		 $type                = 4;
		 $extends_table       = $extendTable->getAll('where type = '.$type);
		 foreach($extends_table as $k=>$v){
			$result    = $extendTable->istable($v['tablename']);
			if(!$result){
				$table = $extendTable->getRow('where issys =1 and type = '.$type);
                $extendTable->doCreateTable('ks_'.$v['tablename'],'ks_'.$table['tablename']);
			}
			$extends_table[$k]['count'] = $extendTable->getTableRow($v['tablename']);
		 }
		 include  CURR_VIEW_PATH . "Vod/Oss_list.php";
    }
	public function aliyunAction(){
	    $config233 = array(
			'AccessKey'=> 'b8dbe7106c3240d1a08ff87ddd32b10f',
			'SecretKey'=> 'da6d40f69de64d758e8ebe950d2838fe', //百度云服务器
			'bucket'   => 'kesion01', //空间名称
			'rename'   => false,
			'timeout'  => 3600, //超时时间
		);
		$aliOss               = new \Core\Upload(array(),'Oss',$config233);
		$Data001['function']  = 'getPrefixList';
		$Data001['prefix']    = null !==GF('path') ? GF('path'):'';
		$values            = $aliOss->aliOss($Data001);
		$Data002['prefix']    = null !==GF('path') ? GF('path'):'';
		$Data002['function']  = 'getObjectList';
		$ObjectList           = $aliOss->aliOss($Data002);

		$now_page =  ChkClng(KS_S('p',1));
		$vodlistModel = M('app_vod_list');
		$keyword = ChkSQL(KS_S('keyword'));
		$keytype = ChkClng(KS_S('keytype',1));
		$status=KS_S('status',3);
		$byname=null !==GF('byname') ? GF('byname'):'desc';//排序
		$where = 'where 1=1';
		if($status!=3){ $where.= ' and status="'.$status.'"';}
        if($keyword){
          	if($keytype==1){
          		$where.=' and vdoName like "%'.$keyword.'%"';
         	}else{
          		$where.=' and wxid='.$keyword;
            }
      }
	  $options = $vodlistModel->getOptions('10',$where);//分页参数设置
	  $page    = Page($options);
//		$values   = $vodlistModel->getPage($page,'adddate '.$byname,$where);

		include  CURR_VIEW_PATH . "Vod/aliyun_list.php";
    }
	public function playVdoAction(){
		$videoId   = null !==GF('vdoId') ? GF('vdoId'):'0';
		if(!empty($videoId)){
		 	if(strstr($videoId,'mda-')==false){
		 		$chapter['serverid'] = 6;
		 		$chapter['videoId']  = $videoId;
		 	}else{
		 		$chapter['serverid'] = 7;
		 		$chapter['videoId']  = $videoId;
		 	}
		}else{
			$chapterid=null !==GF('chapterid') ? GF('chapterid'):'0';
			$courseid=ChkClng(KS_G("get.id"));
		    $course=$this->AppModel->getRow('where courseid='.$courseid.' limit 1');
		    $ChapterModel = new CourseModel($course['chaptertable']);
			$chapter= $chapter=$ChapterModel->getRow('where chapterid='.$chapterid.' limit 1');
		}
		if($chapter['serverid'] == 6){
		    if(empty($chapter['videoId'])){ KS_INFO('这门课还没上传视频，到其他课程看看',6);}
		    $ClassModel   = M('App/ClassModel');
	 	    $result       = $ClassModel  ->playVod($chapter['videoId']);
	 	    $player       = $result['play'];
	 	    //var_dump($player);exit;
//			$playvdo = new \Core\Playvdo();
//			$result = $playvdo->getPlayAddress($chapter['videoId']);
//			switch($result){
//				case 'Uploading'     :KS_INFO('视频上传中，到其他课程看看',6);break;
//				case 'UploadFail'    :KS_INFO('视频上传失败，到其他课程看看',6);break;
//				case 'UploadSucc'    :
//				case 'Transcoding'   :KS_INFO('视频转码中，到其他课程看看',6);break;
//				case 'TranscodeFail' :KS_INFO('视频转码失败，到其他课程看看',6);break;
//				case 'Blocked'       :KS_INFO('视频被屏蔽，到其他课程看看',6);break;
//				default              :$playurl = $result->PlayInfoList->PlayInfo[1]->PlayURL;
//			}
		}elseif($chapter['serverid'] == 7){
		    if( empty($chapter['videoId']) ){
	              KS_INFO('这门课还没上传视频，到其他课程看看',7,'','',1);
		    }else{
				$vod = new \Core\Baiduyun();//百度视频
				try{
				  $vods = $vod->selectVod($chapter['videoId']);
				  $status=$vods->status;
				  switch($status){
					  case 'PROCESSING' : KS_INFO('视频转码中，到其他课程看看',6);break;
					  case 'FAILED' : KS_INFO('视频转码错误，到其他课程看看',6);break;
					  case 'DISABLED':  KS_INFO('视频被禁用，到其他课程看看',6);break;
					  case 'BANNED' :KS_INFO('视频被禁止，到其他课程看看',6);break;
				  }
				  $play =$vods->playableUrlList;
				  foreach($play as $k=>$v){
					 $playurl[$k]['url'] = $v->url;
					 $playurl[$k]['teblemname'] = $v->transcodingPresetName;
				  }
				  $uservod = M('app_vod');
				  $vod = $uservod->getRow('where wxid = '.$this->wxid);
				  if(!$vod){$vod = $uservod->getRow('where wxid = 2');}
				  $setting = explode('※',$vod['setting']);
				  $player = getplay($playurl,$setting);
			    }catch(Exception $e){
						  KS_INFO('视频出错联系管理员',6,'','',1);
				}
		    }
		}
		include  CURR_VIEW_PATH . "Vod/playvdo.php";
	}
	//存储结算
	public function storageSettlementAction(){
		$billingModel = M('common_domain_billing');
		$voucherModel = M('common_voucher');
		$vodModel = M('app_vod');
		$vodlistModel = M('app_vod_list');
		$playLog = M('common_pay_log');
		$VoucherLog =  M('common_voucher_log');
		$vods =$vodModel -> getAll();

		$time=time();
		//$site = $this->cache->GetACache('setting');//读出缓存
		foreach($vods as $k=>$v){
			$size = 0;
			$vodlist =  $vodlistModel->getAll('where wxid = '.$v['wxid']);
			//$balance = $userModel->getOne('money','where wxid = '.$v['wxid'].' and parentid =0');//账户余额
			$Price = wx_version_itemvalue(11,$v['wxid']);
			foreach($vodlist as $kt=>$vt){$size+=$vt['vdoSize'];}
			//var_dump($size).die;
			$spend = ($size/1024) * $Price;//单价
			if($spend != 0){
			    //$Date['userid']  = $v['userid'];
				$Date['appid']   = 5;
				$Date['adddate'] = $time;
				$Data['wxid'] =$v['wxid'];
				$Date['type']    = 1 ;

				$voucher = $voucherModel -> getAll("where  balance > 0 and EndDate > $time and wxid = $v[wxid]");
				$a = 0;
				if($voucher){
					$b=0;//代金券总额
					foreach($voucher as $ktt=>$vtt){
						if($vtt['balance']>$spend){
							$dae['balance']= (float)$vtt['balance']-$spend;
							$dae['status'] = 0;
							$a = $spend;
							$spend = 0;
						}elseif($vtt['balance']=$spend){
							$dae['balance']=0;
							$dae['status'] = 1;
							$a =$spend;
							$spend = 0;
						}else{
							$dae['balance']=0;
							$dae['status'] = 1;
							$spend=$spend-(float)$vtt['balance'];
							$a =$spend+$a;
						}
						$b+=$dae['balance'];
						$voucherModel -> update($dae,'id ='.$vtt['id']);
					}
					$a = round($a,2);
					$Date['cmoney']  = $a;
					$Date['balance']  = $b;

					$Date['mark'] ='点播存储扣除'.$a.'代金券扣除'.$a;
					$VoucherLog->doAdd($Date,'id');
				}
				if($spend != 0){
					$Date['mark'] ='点播余扣除'.$spend.'代金券扣除'.$spend;
					$da['money'] = "money - $spend" ;
					$billingModel ->update($da,"wxid = $v[wxid]",1);
					$playLog->doAdd($Date,'id');
				}

			}
		//  $balance = $billingModel->getOne('money','where wxid = '.$v['wxid'].' and type =5');//账户余额

		}
    }
	public function flowSettlementAction(){
		$username         = ChkSQL(KS_G('get.username'));
		$password         = ChkSQL(KS_G('get.password'));
		if(KS_MD5($password.KS_MD5($username))=='5b4c8c2720853db96da0d37c62c89b4a'){
		            set_time_limit(0);
		            $billingModel     = M('common_domain_billing');
					$vodModel      = M('app_vod');
					$vodlistModel  = M('app_vod_list');
					$playLog       = M('common_pay_log');//余额
					$dateflowModel = M('app_dayflow');

					$vods = $vodModel -> getAll();
					$time = time();
					$site = $this->cache->GetACache('setting');//读出缓存
					foreach($vods as $k=>$v){

						$countflow = 0;//需要结算流量
						$allflow   = 0; //总流量
						$playcount = 0; //播放次数

						$Price = wx_version_itemvalue(12,$v['wxid']);

						$vodlist   =  $vodlistModel->getAll('where wxid = '.$v['wxid']);
						foreach($vodlist as $kt=>$vt){
						   if($vt['vdoService']==7){
								try{
									 $vod  = new Core\Baiduyun();
				                     $a         = $vod->updateDate($vt['vdoId']);
									 $playcount+=$a->aggregate->peakPlayCount;
								     $Data['flow'] = ($a->aggregate->downstreamInBytes)/1024/1024;
							    }catch(Exception $e) {
					                 $Data['flow'] = $vt['flow'];
					                 $playcount+=$vt['playCount'];
							    }
								 $flow         = round($Data['flow'],2);
								 $countflow+=($flow-(float)$vt['SettledFlow']);     //每个视频的总流量-已经结算的流量
								 $Data1['flow'] = $flow;
								 $Data1['SettledFlow'] = $flow;
								 $vodlistModel->update($Data1,'id = '.$vt['id']);//更新视频流量
								 $allflow= $allflow + $flow;
							}else{
							   try{
							   	    $vod  = new Core\Playvdo();
							   	    $a    = $vod->VideoPlayStatisDetail($vt['vdoId']);
				                    $arr = json_decode($a,true);
				                    if(count($arr['VideoPlayStatisDetails']['VideoPlayStatisDetail']) !=0){
				                    	 $times=$arr['VideoPlayStatisDetails']['VideoPlayStatisDetail'][0]['PlayDuration'];

				                    	 $Data1['flow'] =round(($times/1000*900)/8/1024,2);
				                    	 $flow         = $Data1['flow'];
										 $countflow+=$flow;//每个视频的总流量-已经结算的流量
										 $Data1['flow'] = $vt['flow']+$flow;
										 $Data1['SettledFlow'] = $vt['flow']+$flow;
										 $vodlistModel->update($Data1,'id = '.$vt['id']);//更新视频流量
										 $allflow= $allflow + $Data1['flow'];
				                     }

							   }catch(Exception $e) {}
							}
					    }
						$Data2['flow'] =  $allflow;
						$Data2['SettledFlow'] =  $allflow;
						$Data2['number'] = count($vodlist);
						$vodModel ->update($Data2,'id = '.$v['id']);//更新主表流量统计
						$Date3['userid']    = $v['userid'];
						$Date3['wxid']      =  $v['wxid'];
						$Date3['type']      = 1;
						$Date3['flow']      =  $countflow;
						$Date3['adddate']   = $time;
						$Date3['countdate'] = date('Y-m-d H:i:s',$time);
						$Date3['playcount'] = $playcount;
						$dateflowModel -> doAdd($Date3,'id');//插入结算日常表
		        }
		        echo 'ok';exit;
		}
		echo 'err';exit;
	}
	public function closeVdoAction(){
		$id =ChkSQL(GF('vdoId'));
		$now_page =  ChkClng(KS_S('p',1));
		$vod  = new Core\Baiduyun();
		$res = $vod->disableMedia($id);
//		var_dump();
		$vodlistModel = M('app_vod_list');
		$Data['status'] = 'DISABLED';
		$vodlistModel->update($Data,'vdoId="'.$id.'"');
		$url=M_URL('home/Vdo','index',GP('p-'.$now_page));
        KS_INFO('关闭成功',0,$url);
	}
	public function openVdoAction(){
		$id =ChkSQL(GF('vdoId'));
		$now_page =  ChkClng(KS_S('p',1));
		$vod  = new Core\Baiduyun();
		$res = $vod->publishMedia($id);
//		var_dump();
		$vodlistModel = M('app_vod_list');
		$Data['status'] = 'PUBLISHED';
		$vodlistModel->update($Data,'vdoId="'.$id.'"');
		$url=M_URL('home/Vdo','index',GP('p-'.$now_page));
        KS_INFO('开启成功',0,$url);
	}
	//直播数据统计
	public function  countliveAction(){
		$livelogModel=M('common_live_log');
		$type=null !==GF('type') ? GF('type'):1;
		if($type==1){//今天
			//var_dump(date('Y-m-d')).die;
			$starttime=strtotime(date('Y-m-d'));
			$endtime=$starttime+3600*24;
			$where ='';
		}elseif($type==2){//昨天
			$starttime=strtotime(date('Y-m-d'))-24*3600;
			$endtime=strtotime(date('Y-m-d'));
		}elseif($type==3){//指定时间内
			 $starttime=null !==GF('starttime') ? GF('starttime'):0;

			 //$starttime=$starttime-(3600*12);

		     $endtime=null !==GF('endtime') ? GF('endtime'):0;
		      //$endtime=$endtime-(3600*12);
		     $start=date('Y/m/d  H:i:s',$starttime);

	         $end=date('Y/m/d  H:i:s',$endtime);
		}
		$money=$livelogModel->getOne('sum(cost)','where settlement>'.$starttime.' and  settlement<'.$endtime);
		$time=$livelogModel->getOne('sum(time)','where settlement>'.$starttime.' and  settlement<'.$endtime);
		$time=round($time/60,2);
		include  CURR_VIEW_PATH . "Vod/livecount.php";


	}

}