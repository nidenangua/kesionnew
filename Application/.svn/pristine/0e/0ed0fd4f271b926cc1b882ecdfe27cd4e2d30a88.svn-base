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
class WebsiteController extends CommonController
{
	//进入网站配置页
	public function indexAction(){
	 	 $appuserrelate      = M('Application/IndexModel/common_app');
		 $nustchooseapp      = $appuserrelate->getMustChoose();

		 include  CURR_VIEW_PATH . "Website/index.php";
	}
	//进入网站介绍页
	public function wxinfoAction(){
	 	 $appuserrelate      = M('Application/IndexModel/common_app');
		 $nustchooseapp      = $appuserrelate->getMustChoose();
		 include  CURR_VIEW_PATH . "Website/wxinfo.php";
	}
	/**
     * 进入域名配置页
	 */
	public function websitedomainAction(){
		$info      = $this->cache->GetA('domaininfo','wxid',$this->wxid,'',true);//读出缓存
		$userModel = M('common_user');
		$power     = $userModel->getOne('level','where userid='.$this->userid);
		include  CURR_VIEW_PATH . "Website/websitedomain.php";
    }
	//支付以获得到权限
	public function getPowerAction(){
		$payid = 1;
		list($usec, $sec) = explode(" ", microtime());
		$Data['ordersn']  = $this->userid.((float)$usec + (float)$sec)*10000;
		$Kspay = new \Core\Kspay();
		$Kspay->out_trade_no = $Data['ordersn'];
		$Kspay->total_fee    = 0.01;
		$Kspay->payid        = $payid;
		$Kspay->return_url   = M_URL('Website','getPowerback');
		$Kspay->pay();
    }
	//支付过后回调链接
	public function getPowerbackAction(){
		$userModel = M('common_user');
		$Data['level'] = 1;
		$power = $userModel->update($Data,'userid='.$this->userid);
		cookie('indoor',M_URL('Website','websitedomain'));
		ks_header(M_URL());
    }
	//域名绑定规则
	public function domainRulesAction(){
		include  CURR_VIEW_PATH . "Website/domainRules.php";
    }
	//添加域名
	public function addDomainAction(){
		if(strlen(ChkSQL(KS_G('post.domain')))<4||strlen(ChkSQL(KS_G('post.domain')))>20)
		{KS_INFO('二级域名4-20字');}
		$Data['domain']     = ChkSQL(KS_G('post.domain'));
		$Data['userid']     = $this->userid;
		$Data['adddate']    = time();
		$domainModel        = M('common_domain');
		$Rule['domain']     = '二级域名|isEmpty,isEnglish';
		Chkpost($Data,$Rule,$domainModel);
		$Data['domain']     = ChkSQL(KS_G('post.domain')).'.'.PLATDOMAIN.'';
		$Rule['domain']     = '二级域名|isEmpty,isEnglish,isDbexis';
		Chkpost($Data,$Rule,$domainModel);
		$domainModel->update($Data,"wxid=$this->wxid");
		$this->cache->putACache('domaininfo');//写入缓存
		$url =  M_URL('Website','websitedomain');
		KS_INFO('保存成功',0,$url);
	}
	//申请绑定独立域名
	public function editDomainAction(){
		$domainstatus = $this->cache->GetA('domaininfo','wxid',$this->wxid,'status');//读出缓存
		if($domainstatus==1){KS_INFO('审核中');}
		$Data['predomain'] = ChkSQL(KS_G('post.predomain'));
		$Data['status']    = 0;
		$domainModel = M('common_domain');
		if($domainstatus==0){
		$Rule['predomain'] = '独立域名|isEmpty,isEnglish';
		}else{
		$Rule['predomain'] = '独立域名|isEmpty,isEnglish,isDbexis';
		}
		Chkpost($Data,$Rule,$domainModel);
		$domainModel->update($Data,"wxid=$this->wxid");
		$this->cache->putACache('domaininfo');//写入缓存
		$url =  M_URL('Website','websitedomain');
		KS_INFO('提交审核成功',0,$url);
	}
	public function websiteContactAction(){
		$user    = $_SESSION ['user'];
		$userid  = $user["userid"];
		$websiteModel = M('Application/WebsiteModel/common_user_website');
	    $info    = $this->cache->GetHCache('website',$user);//读出缓存
		$qqno    = array();
		$qqgroup = array();
		$contacts= array();
		$qqno    = stringSplit($info["qqno"]);//字符串拆分
		$qqgroup = stringSplit($info["qqgroup"]);
		$contacts= stringSplit($info["contacts"]);
		include  CURR_VIEW_PATH . "Website/websitecontact.php";
	}
	//添加网站联系方式
	public function addContactAction(){
		$websiteModel = M('Application/WebsiteModel/common_user_website');
		$Data['customerstatus'] = ChkClng(KS_G('post.customerstatus'));
		$Data['worktime']       = ChkSQL(KS_G('post.workTime'));
		$Data['workemail']      = ChkSQL(KS_G('post.email'));
		$Data['address']        = ChkSQL(KS_G('post.address'));
		$Data['fax']            = ChkSQL(KS_G('post.fax'));
		$Data['qqno']           = stringMerging(KS_G('post.qquser/a'),KS_G('post.qq/a'));
		$Data['qqgroup']        = stringMerging(KS_G('post.qqgroudname/a'),KS_G('post.qqgroud/a'));
		$Data['contacts']       = stringMerging(KS_G('post.contactperson/a'),KS_G('post.contactnum/a'));
		if(!empty(ChkSQL(KS_G('post.weixinqr')))){
			$Data['weixinqr']   = ChkSQL(KS_G('post.weixinqr'));
		}
		$user = $websiteModel->isuser($this->wxid);
		if(empty($user)){
			$url =  M_URL('Website','websiteContact');
			KS_INFO('请先完成基本信息',0,$url);
		}else{
			$websiteModel->update($Data,"wxid=$this->wxid");
			$this->cache->PutHCache('website',$this->wxid);//写入缓存
			$url =  M_URL('Website','websiteContact');
			KS_INFO('更新成功',0,$url);
		}
   }
   //PC模板
   public function DragAction(){
	    $tempid     = ChkClng(KS_S('get.id'));
		$isDeBug    = ChkClng(KS_S('isDeBug'));
		$pathid     = ChkClng(KS_S('pathid',1));
		$mypathid   = KS_S('mypathid',0);
		$installdir = $this->cache->GetA('tempinfo','tempid',$tempid,'installdir'); //取出temp缓存
		$tpDir      = '/tp/PC/'.$installdir.'/';
	    cookie(KS_MD5('drag'),'drag');
		include  CURR_VIEW_PATH . "Website/Drag.php";
   }
   /**
     * 云端恢复模板
    */
   public function redownAction(){
	    $type       = ChkClng(KS_S('temptype'));
        $tempid     = ChkClng(KS_S('request.id'));      //common_temp表的记录ID
        $app_temp   =  M('app_temp');
        $apptempid  = $app_temp->getOne('id','where wxid='.$this->wxid.' and tempid='.$tempid);     //app_temp表的记录ID

		$parenttempid         = ChkClng(KS_S('parenttempid'));    //父模板ID
		if ($parenttempid==0 || $apptempid==0){
			KS_INFO("出错了！模板ID没值！",0,'','',1);
		}

		$value                = $this->cache->GetA('tempinfo','tempid',$parenttempid,'',true);
		if (empty($value)){
			KS_INFO("出错了！父模板没有找到！",0,'','',1);
		}

		wx_temp_app_update($this->wxid,$parenttempid,$apptempid);

		//switch($type){
		//   case 0 : $dir1     = PC_PATH.$value['installdir'];
		//            $dir2     = ROOT.'Skin/'.$this->wxid.'/PC/'.$value['installdir'];break;
		//   case 1 : $dir1     = M_PATH.$value['installdir'];
		//            $dir2     = ROOT.'Skin/'.$this->wxid.'/M/'.$value['installdir']; break;
		//   case 2 : $dir1     = PCXT_PATH.$value['installdir'];
		//            $dir2     = ROOT.'Skin/'.$this->wxid.'/PCXT/'.$value['installdir']; break;
		//   case 3 : $dir1     = MXT_PATH.$value['installdir'];
		//            $dir2     = ROOT.'Skin/'.$this->wxid.'/MXT/'.$value['installdir']; break;
		//}
		//$this->File->unlinkDir($dir2);
		//$this->File->copyDir($dir1,$dir2);
		//$common_label         = M('common_label');//实例化云服务表
		//$app_label            = M('app_label');//实例化云服务表
		//$app_label->delete('wxid='.$this->wxid.' and tempid='.$tempid);
		//$Labelarr             = $common_label->getAll("where tempid=$tempid");
		//foreach($Labelarr as $k=>$v){
		//    $DataTwo['tempid']       = $tempid;
		//    $DataTwo['wxid']         = $this->wxid;
		//    $DataTwo['labelid']      = $v['labelid'];
		//    $DataTwo['labelname']    = $v['labelname'];
		//    $DataTwo['adddate']      = time();
		//    $DataTwo['labelcontent'] = EncodeSQL($v['labelcontent']);
		//    $DataTwo['labeltype']    = $v['labeltype'];
		//    $app_label->doAdd($DataTwo,'id');
		//}
		//$this->cache->PutLCache('labelinfo',$tempid);

	    KS_INFO('风格恢复成功',0,M_URL('Website','websitetemplate',$type));
   }
   //手机模板
   public function DragPhoneAction(){
	    $tempid     = ChkClng(KS_G('get.id'));
		$isDeBug    = null !== GF('isDeBug') ? GF('isDeBug'):'0';
		$pathid     = null !== GF('pathid')  ? GF('pathid'):'1';
		$installdir = $this->cache->GetA('tempinfo','tempid',$tempid,'installdir'); //取出temp缓存
		//var_dump();exit;
		$tpDir      = '/Skin/'.$this->wxid.'/PC/'.$installdir.'/';
	    cookie(KS_MD5('drag'),'drag');
		include  CURR_VIEW_PATH . "Website/DragPhone.php";
   }
   /**
     * 模板列表
    */
   public function websitetemplateAction(){
        $type         = ChkClng(KS_G('get.id'));
        $module        = wx_module_arr($this->wxid);
        if ($module[0]==0 && $type==0){                                           //pc没有开通，跳到微门户模板
            ks_header(M_URL('Website','websitetemplate',1));
            exit;
        }


		$userwebsite  = $this->cache->GetA('domaininfo','wxid',$this->wxid,'',true);
		if($type == 0){     //pc风格
		    $temp =!empty($userwebsite['tempPid']) ? $userwebsite['tempPid'] : 0;
		}elseif($type == 1){  //公众号风格
		    $temp = !empty($userwebsite['tempMid']) ? $userwebsite['tempMid'] : 0;
		}elseif($type == 2){
			$temp = !empty($userwebsite['tempPxt']) ? $userwebsite['tempPxt'] : 0;
		}elseif($type == 3){
			$temp = !empty($userwebsite['tempMxt']) ? $userwebsite['tempMxt'] : 0;
		}elseif($type == 4){
			$temp = !empty($userwebsite['tempMxt']) ? $userwebsite['tempMxt'] : 0;
		}
		$app_temp       = M('app_temp');
		$common_temp    = M('common_temp');
    	$mytemp         = $app_temp->getAll('where wxid='.$this->wxid.' and temptype='.$type,'tempid');         //用户模板库
    	$value1         = $this->cache->GetA('tempinfo','temptype',$type);
    	if($this->wxid==1||$this->wxid==1049){
			$values1 = $value1;
			die ("官方账号，如需要修改风格请到总后台admin.php修改！");
		}else{


            $common_temp = M('Application/WebsiteModel/common_temp');
            $where    = 'where isoffc=0 and temptype = '.$type;
		    $options  = $common_temp->getOptions('4',$where);//分页参数设置
		    $page     = Page($options);
		    $values1   = $common_temp->getPage($page,'tempid='.$temp.' desc','where isoffc=0 and temptype = '.$type);
            $values=array();
		    foreach($values1 as $k=>$v){
		    	if($v['tempid'] == $temp){
                    array_unshift($values,$v);           //向数组插入新元素。新数组的值将被插入到数组的开头
		        }else{
                    array_push($values,$v);              //向数组尾部插入一个或多个元素。
                }
		    }

            $val   	= $app_temp->getAll('where temptype='.$type.' and wxid='.$this->wxid);
            foreach($values as $k=>$v){                     //遍历平台模板库
                $values[$k]['isedit'] = '0';
                foreach($val as $kt=>$vt){                  //遍历用户模板库
                    if($v['tempid']==$vt['tempid']){
                        $values[$k]['isedit'] = '1';
                    }
                }

            }


            $info       = $this->cache->GetA('domaininfo','wxid',$this->wxid,'',true);//读出缓存
            include  CURR_VIEW_PATH . "Website/websitetemplate.php";
            exit();





			$values1 = array();
			foreach($value1 as $k=>$v){
                $biaoji = 0;
		    	foreach($mytemp as $kt=>$vt){
                    if($v['tempid'] == $vt['tempid']){
                        $biaoji = 1;break;
                    }
                }
				if($v['isoffc']!=1&&$biaoji!=1){  //非官方模板，加入供选择
                    $values1[]=$v;
                }
			}
		}
		if($type<=3){
			$tempModel= M('Application/WebsiteModel/app_temp');
            $where    = 'where temptype = '.$type.' and wxid = '.$this->wxid;
		    $options  = $tempModel->getOptions('4',$where);//分页参数设置
		    $page     = Page($options);
		    $values   = $tempModel->getPage($page,'a.tempid='.$temp.' desc','as a inner join '.$common_temp->table.' as b on a.tempid=b.tempid where b.ispub=1 and a.temptype = '.$type.' and a.wxid = '.$this->wxid,'a.*,b.defaultpic,b.tempname,b.author');
		    foreach($values1 as $k=>$v){
		    	if($v['tempid'] == $temp){
                    array_unshift($values,$v);    //向数组插入新元素。新数组的值将被插入到数组的开头
		        }else{
                    array_push($values,$v);       //向数组尾部插入一个或多个元素。
                }
		    }
		}elseif($type==4){
			$tempModel= M('Application/WebsiteModel/common_temp');
		    $options  = $tempModel->getOptions('4','where temptype = '.$type);//分页参数设置.' and wxid = '.$this->wxid
		    foreach($values1 as $k=>$v){
		    	if($v['tempid'] == $temp){array_unshift($options,$v);
		        }else{array_push($options,$v);}
		    }
		    $page     = Page($options);
		    $values   = $tempModel->getPage($page, 'tempid='.$temp.' desc','where temptype = '.$type);
		    foreach($values1 as $k=>$v){
		    	if($v['tempid'] == $temp){array_unshift($values,$v);
		        }else{array_push($values,$v);}
		    }
		}
		$info       = $this->cache->GetA('domaininfo','wxid',$this->wxid,'',true);//读出缓存
		include  CURR_VIEW_PATH . "Website/websitetemplate.php";
	}
	public function cleckSitenameAction(){
		$websiteModel = M('Application/WebsiteModel/common_user_website');
		$sitename     = ChkSQL(KS_G('post.sitename'));
		$result       = $websiteModel->checkSitename($sitename);
		echo $result;
	}
	/**
	 * 使用模板
     */
	public function useTempAction(){
		$websiteModel     = M('common_domain');
		$temptype         = ChkClng(KS_S('temptype'));
		$tempid           = ChkClng(KS_G('get.id'));  //父模板库的tempid

        $result = useTemp($this->wxid,$tempid,$temptype);
        if ($result['result']=='success'){
            if ($temptype==1){  //手机风格
                $url =  '/store';
                die ("<script>top.KTJ_RouteJump('".$url."');</script>");
            }else{
                $url =  M_URL('Website','websitetemplate',$temptype);
                KS_INFO('',0,$url);
            }


        }else{
            KS_Alert($result['msg'],'error',KS_ComeUrl());
        }

	}
	public function inforAction(){
		$websiteModel = M('common_sms_content');
		$values       = $websiteModel->getAll('where uid ='.$this->userid);
		if(!$values){
			$Data1['uid']       = $this->userid;
			$Data1['model']     = '会员注册';
			$Data1['modelname'] = 'Register';
			$Data1['content']   = '尊敬的客户,您在{$sitename}网站注册验证码为{$code}。';

			$Data2['modelname'] = 'PassWord';
			$Data2['uid']       = $this->userid;
			$Data2['model']     = '取回密码';
			$Data2['content']   = '尊敬的客户,您在{$sitename}网站找回密码验证码为{$code}。';

			$Data3['modelname'] = 'Login';
			$Data3['uid']       = $this->userid;
			$Data3['model']     = '会员登录';
			$Data3['content']   = '尊敬的客户,您在{$sitename}网站会员登录验证码为{$code}。';

			$Data4['modelname'] = 'Validate';
			$Data4['uid']       = $this->userid;
			$Data4['model']     = '手机验证';
			$Data4['content']   = '尊敬的客户,您在{$sitename}网站手机验证验证码为{$code}。';
		    $websiteModel->doadd($Data1,"id");
		    $websiteModel->doadd($Data2,"id");
		    $websiteModel->doadd($Data3,"id");
		    $websiteModel->doadd($Data4,"id");
		   	$this->cache->PutHCache('smsmodel',$this->userid);
		    $values =$websiteModel->getAll('where uid ='.$this->userid);
	    }
        include  CURR_VIEW_PATH . "Website/smsindex.php";
	}
	public function doUpdateSmsAction(){
		$websiteModel = M('common_sms_content');
		$id           = ChkSQL(KS_G('post.id'));
		$content      = ChkSQL(KS_G('post.content'));
		$statusid     = isset($_POST["status"]) ? $_POST["status"] : "";
		foreach($id as $k=>$v){
			$Data['status']  = 0;
			$Data['content'] = $content[$k];
			$websiteModel->update($Data,"id=$v");
		}
		if(!empty($statusid)){
			foreach($statusid as $k=>$v){
				  $Data1['status'] =1;
				  $websiteModel->update($Data1,"id=$v");
			}
		}
		$this->cache->PutHCache('smsmodel',$this->userid);
		$url  = M_URL('Website','infor');
		KS_INFO("更新成功",0,$url);
	}
	public function testapiAction(){
		include  CURR_VIEW_PATH . "Website/testapi.php";
	}
	/**图片管理**/
	public function attachmentAction(){
		$info = $this->cache->GetHCache('website',$this->wxid);//读出缓存
    	$setting       =  explode('|',$info['setting']);
    	$isshuiyin     =  $setting[6];//提问开启水印
    	$type          = null !== GF('type') ? GF('type'):'parent';
		$name          = null !== GF('name') ? GF('name'):'';
		$chektype      = null !== GF('chektype') ? GF('chektype'):'0';
		$nowdirid      = null !== GF('nowdirid') ? GF('nowdirid'):'';
		$nowdir        = null !== GF('nowdir') ? GF('nowdir'):'';
		$app_dir       = M('app_dir');
		$uploadtableid = $this->cache ->GetA('domaininfo','wxid',$this->wxid,'uploadtableid');
		$tablename     = $this->cache ->GetA('extable','tableid',$uploadtableid,'tablename');//取出关联表
		$files         = M($tablename);
		$dirname = $app_dir->getAll('where type = 1 and wxid ='.$this->wxid.' order by adddate desc','name,id');

		$where   ='where wxid = '.$this->wxid;
		$keyword = KS_S('keyword');
	    //判断是否输入关键字
		if(!empty($keyword)){$where.=" and filename like '%$keyword%'";}
		if(!empty($nowdirid)){$where.=' and dirid ='.$nowdirid;}
	    $where.=' and type=1 order by adddate desc';
		if(!empty($nowdirid)){
			$dir      = $app_dir->getAll('where id ='.$nowdirid);
			$nowdir   = $dir[0]['name'];
			$subName  = $dir[0]['file'];
			$filename = $files->getAll($where);
		}else{
			$dir = $app_dir->getAll('where name='.date('Ym').' and wxid='.$this->wxid);
			if(empty($dir)){
				$dirData['wxid']    = $this->wxid;
				$dirData['name']    = date('Ym');
				$dirData['file']    = date('Ym');
				$dirData['type']    = 1;
				$dirData['adddate'] = time();
				$nowdirid = $app_dir->doAdd($dirData,'id');
			}else{
				$nowdirid = $dir['0']['id'];
			}
			$subName  = date('Ym');
			$nowdirid = $nowdirid;
			$filename = $files->getAll($where);
			//$filename = $files->getAll('where type = 1 and  wxid='.$this->wxid.' order by adddate desc');
		}
		$count = $files->getAll($where,'count(id) as count');
		$sum = $count[0]['count'];
		$options['now_page']   = null !==GF('p') ? GF('p'):'1';
		$options['maxperpage'] = 14;
	    $options['totalput']   = count($filename);
		$page = Page($options);
		$filename   = $page->arrayPage($filename);
		if(empty($filename)){
			$filename = array();
		}
		include  CURR_VIEW_PATH . "Website/images_list.php";
	}
	//添加图片分组
    public function TempaddFileAction(){
    	if($_POST){
	    	$type      = $_POST['type'];
			$name      = $_POST['name'];
			$nowdirid  = $_POST['nowdirid'];
			$dirname   = $_POST['tempname'];
			$dirData['type'] = $_POST['dirtype'];
			$dirData['name']    = $_POST['tempname'];
			$dir = M('app_dir');
			if(empty($dirData['name'])){
				if($dirData['type']==1){
					KS_INFO('重命名不能为空',3, M_URL('Website','attachment','',GP('nowdir-'.$name.',nowdirid-'.urlencode($nowdirid).',chektype-0',true)));
				}else{
					KS_INFO('重命名不能为空',3, M_URL('Website','wxfilegl','',GP('nowdir-'.$name.',nowdirid-'.urlencode($nowdirid).',chektype-0,type1-'.$dirData['type'],true)));
				}
			}
			$info  = $dir->getAll('where wxid='.$this->wxid.' and name="'.$dirData['name'].'"');
			if(!empty($info)){
				if($dirData['type']==1){
					KS_INFO('重复命名重复',3, M_URL('Website','attachment','',GP('nowdir-'.$dirname.',nowdirid-'.urlencode($nowdirid).',chektype-0',true)));
				}else{
					KS_INFO('重复命名重复',3, M_URL('Website','wxfilegl','',GP('nowdir-'.$dirname.',nowdirid-'.urlencode($nowdirid).',chektype-0,type1-'.$dirData['type'],true)));
				}
			}
			$dirData['wxid']    = $this->wxid;
			$dirData['file']    = date('YmdHis');
			$dirData['adddate'] = time();
			$nowdirid = $dir->doAdd($dirData,'id');
			if($dirData['type']==1){
				ks_header(M_URL('Website','attachment','',GP('nowdir-'.$dirname.',nowdirid-'.urlencode($nowdirid).',chektype-0',true)));
			}else{
				ks_header(M_URL('Website','wxfilegl','',GP('nowdir-'.$dirname.',nowdirid-'.urlencode($nowdirid).',chektype-0,type1-'.$dirData['type'],true)));
			}
    	}else{
    		include CURR_VIEW_PATH . "Website/images_list.php";
    	}
    }
	public function deleteimgAction(){
		if($_POST){
    		$uploadtableid = $this->cache ->GetA('domaininfo','wxid',$this->wxid,'uploadtableid');
			$extends_table = M('common_extends_table');
			$tablename     = $extends_table->getOne('tablename','where tableid='.$uploadtableid);
			$files         = M($tablename);
//			var_dump($_POST);exit;
			foreach($_POST['imgary'] as $key => $v){
				$filepath = $files->getOne('filePath','where id='.$v);
				$files->delete('id="'.$v.'"');
				$src = strstr($filepath, 'Images/');
				if(file_exists(ROOT.$src)){
					unlink(ROOT.$src);
				}
			}
			echo '删除成功';
		}
	}
	//图片管理删除分组
	public function deletedirAction(){
		$nowdirid = null !== GF('nowdirid') ? GF('nowdirid'):'';
		$nowdir   = null !== GF('nowdir') ? GF('nowdir'):'';
		$cache    = new \Core\Cache();
		$uploadtableid = $cache ->GetA('domaininfo','wxid',$this->wxid,'uploadtableid');
		$extends_table = M('common_extends_table');
		$tablename = $extends_table->getOne('tablename','where tableid='.$uploadtableid);
		$files = M($tablename);
		$Data['dirid'] = 0;
		$files->update($Data,'dirid='.$nowdirid);
		$dir = M('app_dir');
		$dir->delete('id='.$nowdirid);
		ks_header(M_URL('Website','attachment'));
	}
	//文件管理删除分组
	public function filedeletedirAction(){
		$nowdirid = null !== GF('nowdirid') ? GF('nowdirid'):'';
		$nowdir   = null !== GF('nowdir') ? GF('nowdir'):'';
		$cache    = new \Core\Cache();
		$uploadtableid = $cache ->GetA('domaininfo','wxid',$this->wxid,'uploadtableid');
		$extends_table = M('common_extends_table');
		$tablename = $extends_table->getOne('tablename','where tableid='.$uploadtableid);
		$files = M($tablename);
		$Data['dirid'] = 0;
		$files->update($Data,'dirid='.$nowdirid);
		$dir = M('app_dir');
		$dir->delete('id='.$nowdirid);
		ks_header(M_URL('Website','wxfilegl'));
	}
	//文件管理重命名
	public function newdirnameAction(){
		$type     = $_POST['type'];
		$name     = $_POST['name'];
		$nowdirid = $_POST['nowdirid'];
		$dirname = $_POST['tempname'];
		$dirData['type'] = $_POST['dirtype'];
		$data['name'] = $_POST['tempname'];
		$dir = M('app_dir');
		if(empty($data['name'])){
			if($dirData['type']==1){
				KS_INFO('重命名不能为空',3, M_URL('Website','attachment','',GP('nowdir-'.$name.',type-'.$type.',nowdirid-'.urlencode($nowdirid).',chektype-0',true)));
			}else{
//			 $url = M_URL('Index','wxfile','',GP('nowdir-'.$dirname.',nowdirid-'.urlencode($dirid).',name-'.$name.',type-'.$type.' ,type1-'.$dirData['type'],true));
				KS_INFO('重命名不能为空',3, M_URL('Website','wxfilegl','',GP('nowdir-'.$name.',type-'.$type.',nowdirid-'.urlencode($nowdirid).',chektype-0,type1-'.$dirData['type'],true)));
			}
		}
		$info  = $dir->getAll('where wxid='.$this->wxid.' and name="'.$data['name'].'"');
		if(!empty($info)){
			if($dirData['type']==1){
				KS_INFO('重复命名重复',3, M_URL('Website','attachment','',GP('nowdir-'.$dirname.',type-'.$type.',nowdirid-'.urlencode($nowdirid).',chektype-0',true)));
			}else{
//			 $url = M_URL('Index','wxfile','',GP('nowdir-'.$dirname.',nowdirid-'.urlencode($dirid).',name-'.$name.',type-'.$type.' ,type1-'.$dirData['type'],true));
				KS_INFO('重复命名重复',3, M_URL('Website','wxfilegl','',GP('nowdir-'.$dirname.',type-'.$type.',nowdirid-'.urlencode($nowdirid).',chektype-0,type1-'.$dirData['type'],true)));
			}
		}
		$dir->update($data,'id='.$nowdirid);
		if($dirData['type']==1){
			KS_INFO('修改成功',3, M_URL('Website','attachment','',GP('nowdir-'.$dirname.',type-'.$type.',nowdirid-'.urlencode($nowdirid).',chektype-0',true)));
		}else{
//			 $url = M_URL('Index','wxfile','',GP('nowdir-'.$dirname.',nowdirid-'.urlencode($dirid).',name-'.$name.',type-'.$type.' ,type1-'.$dirData['type'],true));
			KS_INFO('修改成功',3, M_URL('Website','wxfilegl','',GP('nowdir-'.$dirname.',type-'.$type.',nowdirid-'.urlencode($nowdirid).',chektype-0,type1-'.$dirData['type'],true)));
		}
	}
	public function wxfileglAction(){
    	$type1         = null !== GF('type1') ? GF('type1'):3;
    	$type          = null !== GF('type') ? GF('type'):'parent';
		$name          = null !== GF('name') ? GF('name'):'';
		$chektype      = null !== GF('chektype') ? GF('chektype'):'0';
		$nowdirid      = null !== GF('nowdirid') ? GF('nowdirid'):'';
		$nowdir        = null !== GF('nowdir') ? GF('nowdir'):'';
		$app_dir       = M('app_dir');
		$uploadtableid = $this->cache ->GetA('domaininfo','wxid',$this->wxid,'uploadtableid');
		$tablename     = $this->cache ->GetA('extable','tableid',$uploadtableid,'tablename');//取出关联表
		$files   = M($tablename);
		$dirname = $app_dir->getAll('where wxid ='.$this->wxid.' and type='.$type1.' order by adddate desc','name,id');
		$where   ='where wxid = '.$this->wxid;
		$keyword = KS_S('keyword');
	    //判断是否输入关键字
		if(!empty($keyword)){$where.=" and filename like '%$keyword%'";}
		if($type1 == 2){$where.=' and type =2';
	    }elseif($type1 == 3){$where.=' and  type =3';
		}elseif($type1 == 4){$where.=' and  type =4';
		}elseif($type1 == 5){$where.=' and  type =5';}
		if(!empty($nowdirid)){$where.=' and dirid ='.$nowdirid;}
	    $where.=' order by adddate desc';
		if(!empty($nowdirid)){
			$dir      = $app_dir->getAll('where id ='.$nowdirid);
			$nowdir   = $dir[0]['name'];
			$subName  = $dir[0]['file'];
			$filename = $files->getAll($where);
		}else{
			$dir      = $app_dir->getAll('where name='.date('Ym').' and wxid='.$this->wxid);
			if(empty($dir)){
				$dirData['wxid']    = $this->wxid;
				$dirData['name']    = date('Ym');
				$dirData['file']    = date('Ym');
				$dirData['type']    = $type1;
				$dirData['adddate'] = time();
				$nowdirid = $app_dir->doAdd($dirData,'id');
			}else{
				$nowdirid = $dir['0']['id'];
			}
			$subName  = date('Ym');
			$nowdirid = $nowdirid;
			$filename = $files->getAll($where);
		}
		$count = $files->getAll($where,'count(id) as count');
		$sum   = $count[0]['count'];
		$options['now_page']   = null !==GF('p') ? GF('p'):'1';
		$options['maxperpage'] = 10;
	    $options['totalput']   = count($filename);
		$page = Page($options);
		$filename   = $page->arrayPage($filename);
		if(empty($filename)){$filename = array();}
    	include  CURR_VIEW_PATH . "Website/wxfiles.php";
    }

    //小课堂背景管理
    public function tempBackgroundAction(){
    	$option  = null !==GF('option') ? GF('option'):'0';//选项卡
		$adddate = null !==GF('adddate') ? GF('adddate'):'1';//选项卡
		$recId   = ChkClng(KS_G('request.id'));
		$where   = 'where tempid='.$recId.' and type=1 and (wxid=0 or wxid='.$this->wxid.')';
		$keyword = KS_S('keyword');
		if(!empty($keyword)){$where.=" and filename like '%$keyword%'";}
		if($adddate==1){$by= 'adddate desc';}
		elseif($adddate==2){$by = 'adddate asc';}
		//$values = $this->cache->getACache('appcategory');//取出缓存
		$Mode        = M('app_roomsetting');
		$options     = $Mode->getOptions('8',$where);//分页参数设置
		if($options['totalput']==0){
			$IndexModel          = M('Application/IndexModel');
			$Data006['tempid']   = $recId;
		    $Data006['wxid']     = $this->wxid;
		    $Data006['type']     = 1;
	        $IndexModel          ->copybackgroup($Data006);
	        $options     = $Mode->getOptions('8',$where);//分页参数设置
		}
		$page        = Page($options);
		$values      = $Mode->getPage($page,$by,$where);
		foreach($values as $k =>$v){
			$values[$k]['fileurl'] = XImg($v['fileurl'],1);
		}
    	include  CURR_VIEW_PATH . "Website/TempBackground.php";
    }
    //设置默认小课堂背景
    public function defaultBackAction(){
    	 $id                = ChkClng(KS_G('request.id'));//表ID
		 $now_page          = ChkClng(KS_S('p')); //表ID
		 $app_setting       = M('app_roomsetting');//实例化云服务表
		 $value             = $app_setting->getRow('where id='.$id.' limit 1');
		 $Data['ism']       = 0;
		 $app_setting->update($Data,'type='.$value['type'].' and tempid='.$value['tempid'].' and wxid='.$this->wxid);
		 $Data['ism']       = 1;
	     $app_setting->update($Data,'id='.$value['id'].' and wxid='.$this->wxid);
		 //$this->cache->PutACache('tempinfo'); //把temp信息存入缓存
		 $url = M_URL('Website','tempBackground',$value['tempid'],GP(''));
		 ks_header($url);
    }
    //显示添加背景
    public function tempbgAddAction(){
    	$id = KS_G('get.id');
    	$adddate = null !==GF('adddate') ? GF('adddate'):'1';//选项卡
    	$now_page =  ChkClng(KS_S('p',1));
    	include  CURR_VIEW_PATH . "Website/tempbgAdd.php";
    }
    /** 添加背景*/
    public function bgdoAddAction(){
    	$option = null !==GF('option') ? GF('option'):'0';//选项卡
    	$now_page =  ChkClng(KS_S('p',1));
    	$Mode = M('app_roomsetting');
    	$Data['filename'] = KS_G('post.filename');
    	$Data['fileurl']  =KS_G('post.fileurl');
    	if(empty($Data['filename'])){KS_INFO('请输入名称');exit;}
    	if(empty($Data['fileurl'])){KS_INFO('请上传文件');exit;}
    	$Data['adddate']  = time();
    	$Data['tempid'] = KS_G('get.id');
    	$Data['type'] = 1;
    	$Data['wxid'] = $this->wxid;
    	$Mode->doAdd($Data,'id');
    	KS_INFO('添加成功',3,M_URL('Website','tempBackground',KS_G('get.id'),GP('p-'.$now_page.'option-'.$option)));
    }
    /* * 删除背景*/
    public function deletebgAction(){
    	$option = null !==GF('option') ? GF('option'):'0';//选项卡
    	$now_page =  ChkClng(KS_S('p',1));
    	$tempid = null !==GF('tempid') ? GF('tempid'):'1';//选项卡
    	$Mode = M('app_roomsetting');
    	$id = KS_G('get.id');
    	$Mode->delete('id='.$id);
    	ks_header(M_URL('Website','tempBackground',$tempid,GP('p-'.$now_page.'option-'.$option)));
    }
    /** 显示修改页面*/
    public function bgEditAction(){
    	$option = null !==GF('option') ? GF('option'):'0';//选项卡
    	$now_page =  ChkClng(KS_S('p',1));
    	$id = KS_G('get.id');
    	$Mode = M('app_roomsetting');
    	$value = $Mode->getRow('where id='.$id);
    	include  CURR_VIEW_PATH . "Website/tempbgAdd.php";
    }
    /* * 修改背景*/
    public function bgdoEditAction(){
    	$option = null !==GF('option') ? GF('option'):'0';//选项卡
    	$now_page =  ChkClng(KS_S('p',1));
    	$tempid = null !==GF('tempid') ? GF('tempid'):'1';//选项卡
    	$Data['filename'] = KS_G('post.filename');
    	$Data['fileurl']  =KS_G('post.fileurl');
    	$id = KS_G('get.id');
    	$Mode = M('app_roomsetting');
    	$Mode ->update($Data,'id='.$id);
    	KS_INFO('修改成功',0,M_URL('Website','tempBackground',$tempid,GP('p-'.$now_page.'option-'.$option)));
    }
    /** 批量删除背景*/
    public function deletebgsAction(){
    	$id = isset($_POST["check"])?$_POST["check"]:'';
    	$now_page = ChkClng(KS_S('p',1));
    	$tempid = KS_G('get.id');
    	if(empty($id)){KS_INFO("请选择");}
    	$Mode = M('app_roomsetting');
		$url = M_URL('Website','tempBackground',$tempid,GP('p-'.$now_page));
		//批量删除
		if(KS_G('post.batch')==4){
			foreach ($id as $v ){$Mode->delete('id='.$v.' and wxid='.$this->wxid);}
			$this->cache->putACache('domaininfo');//写入缓存
			KS_INFO('批量删除成功',0,$url);
		}
    }
    /** 显示设置背景音乐页面*/
    public function tempBgmAction(){
    	$option = null !==GF('option') ? GF('option'):'0';//选项卡
		$adddate = null !==GF('adddate') ? GF('adddate'):'1';//选项卡
		$id = KS_G('get.id');
		$where = 'where tempid='.$id.' and type=2  and (wxid=0 or wxid='.$this->wxid.')';
		$keyword = ChkSQL(KS_S('keyword'));
		$keytype = ChkClng(KS_S('keytype',1));
		if(!empty($keyword)){
			if($keytype==1){$where.=" and filename like '%$keyword%'";}
			elseif($keytype==2){$where.=" and wxid like '%$keyword%'";}
		}
		if($adddate==1){$by= 'adddate desc';}
		elseif($adddate==2){$by = 'adddate asc';}
		//$values = $this->cache->getACache('appcategory');//取出缓存
		$Mode = M('app_roomsetting');
		$options     = $Mode->getOptions('8',$where);//分页参数设置
		if($options['totalput']==0){
			$IndexModel          = M('Application/IndexModel');
			$Data006['tempid']   = $id;
		    $Data006['wxid']     = $this->wxid;
		    $Data006['type']     = 2;
	        $IndexModel          ->copybackgroup($Data006);
	        $options     = $Mode->getOptions('8',$where);//分页参数设置
		}
		$page        = Page($options);
		$values      = $Mode->getPage($page,$by,$where);
    	include  CURR_VIEW_PATH . "Website/TempBgm.php";
    }
    //设置默认小课堂音乐
    public function defaultBgmAction(){
    	 $id                = ChkClng(KS_G('request.id'));//表ID
		 $now_page          = ChkClng(KS_S('p')); //表ID
		 $app_setting       = M('app_roomsetting');//实例化云服务表
		 $value             = $app_setting->getRow('where id='.$id.' limit 1');
		 $Data['ism']       = 0;
		 $app_setting->update($Data,'type='.$value['type'].' and tempid='.$value['tempid']);
		 $Data['ism']       = 1;
	     $app_setting->update($Data,'id='.$value['id']);
		 $url = M_URL('Website','tempBgm',$value['tempid'],GP(''));
		 ks_header($url);
    }
    //显示添加音乐页面
    public function tempbgmAddAction(){
    	$id = KS_G('get.id');
    	$adddate = null !==GF('adddate') ? GF('adddate'):'1';//选项卡
    	$now_page =  ChkClng(KS_S('p',1));
    	include  CURR_VIEW_PATH . "Website/tempbgmAdd.php";
    }
    public function wxfileAction(){
    	$type1         = null !== GF('type1') ? GF('type1'):1;
    	$type          = null !== GF('type') ? GF('type'):'parent';
		$name          = null !== GF('name') ? GF('name'):'';
		$chektype      = null !== GF('chektype') ? GF('chektype'):'1';
		$nowdirid      = null !== GF('nowdirid') ? GF('nowdirid'):'';
		$nowdir        = null !== GF('nowdir') ? GF('nowdir'):'';
		$app_dir       = M('app_dir');
		$uploadtableid = $this->cache ->GetA('domaininfo','wxid',$this->wxid,'uploadtableid');
		$tablename     = $this->cache ->GetA('extable','tableid',$uploadtableid,'tablename');//取出关联表
		$files         = M($tablename);
		$dirname       = $app_dir->getAll('where wxid ='.$this->wxid.' and type='.$type1.' order by adddate desc','name,id');
		$where ='where wxid = '.$this->wxid;
		if($type1 == 3){$where.=' and  type =3';}
	    $where.=' order by adddate desc';
		if(!empty($nowdirid)){
			$dir = $app_dir->getAll('where id ='.$nowdirid);
			$nowdir = $dir[0]['name'];
			$subName = $dir[0]['file'];
			$filename = $files->getAll(' where dirid='.$nowdirid.' and type = '.$type1.' order by adddate desc');
		}else{
			$dir = $app_dir->getAll('where name='.date('Ym').' and wxid='.$this->wxid);
//			$nowdir = $dir[0]['name'];
			if(empty($dir)){
				$dirData['wxid'] = $this->wxid;
				$dirData['name'] = date('Ym');
				$dirData['file'] = date('Ym');
				$dirData['adddate'] = time();
				$dirData['type'] = $type1;
				$nowdirid = $app_dir->doAdd($dirData,'id');
			}else{$nowdirid = $dir['0']['id'];}
			$subName  = date('Ym');
			$nowdirid = $nowdirid;
			$filename = $files->getAll($where);
		}
		$count = $files->getAll($where,'count(id) as count');
		$sum = $count[0]['count'];
		$options['now_page']   = null !==GF('p') ? GF('p'):'1';
		$options['maxperpage'] = 10;
	    $options['totalput']   = count($filename);
		$page = Page($options);
		$filename   = $page->arrayPage($filename);
		if(empty($filename)){$filename = array();}
    	include  CURR_VIEW_PATH . "Website/music_list.php";
    }
    /** 添加音乐*/
    public function bgmdoAddAction(){
    	$option = null !==GF('option') ? GF('option'):'0';//选项卡
    	$now_page =  ChkClng(KS_S('p',1));
    	$Mode = M('app_roomsetting');
    	$Data['filename'] = KS_G('post.filename');
    	$Data['fileurl']  =KS_G('post.fileurl');
    	if(empty($Data['filename'])){KS_INFO('请输入名称');exit;}
    	if(empty($Data['fileurl'])){KS_INFO('请上传文件');exit;}
    	$Data['adddate']  = time();
    	$Data['tempid'] = KS_G('get.id');
    	$Data['type'] = 2;
    	$Data['wxid'] = $this->wxid;
    	$Mode->doAdd($Data,'id');
    	KS_INFO('添加成功',0,M_URL('Website','tempBgm',KS_G('get.id'),GP('p-'.$now_page.'option-'.$option)));
    }
    //套餐协议
    public function servicecontractAction(){
    	$id     = ChkClng(KS_G('get.id'));
    	$option = null !==GF('option') ? GF('option'):'0';//选项卡
    	include  CURR_VIEW_PATH . "Website/servicecontract.php";
    }
    public function deletebgmAction(){
    	$option = null !==GF('option') ? GF('option'):'0';//选项卡
    	$now_page =  ChkClng(KS_S('p',1));
    	$tempid = null !==GF('tempid') ? GF('tempid'):'1';//选项卡
    	$Mode = M('app_roomsetting');
    	$id = KS_G('get.id');
    	$Mode->delete('id='.$id);
    	ks_header(M_URL('Website','tempBgm',$tempid,GP('p-'.$now_page.'option-'.$option)));
    }
    public function bgmEditAction(){
    	$option = null !==GF('option') ? GF('option'):'0';//选项卡
    	$now_page =  ChkClng(KS_S('p',1));
    	$id = KS_G('get.id');
    	$Mode = M('app_roomsetting');
    	$value = $Mode->getRow('where id='.$id);
    	include  CURR_VIEW_PATH . "Website/tempbgmAdd.php";
    }
    public function bgmdoEditAction(){
    	$option = null !==GF('option') ? GF('option'):'0';//选项卡
    	$now_page =  ChkClng(KS_S('p',1));
    	$tempid = null !==GF('tempid') ? GF('tempid'):'1';//选项卡
    	$Data['filename'] = KS_G('post.filename');
    	$Data['fileurl']  =KS_G('post.fileurl');
    	$id = KS_G('get.id');
    	$Mode = M('app_roomsetting');
    	$Mode ->update($Data,'id='.$id);
    	KS_INFO('修改成功',0,M_URL('Website','tempBgm',$tempid,GP('p-'.$now_page.'option-'.$option)));
    }
     public function deletebgmsAction(){
    	$id = isset($_POST["check"])?$_POST["check"]:'';
    	$now_page = ChkClng(KS_S('p',1));
    	$tempid = KS_G('get.id');
    	if(empty($id)){KS_INFO("请选择");}
    	$Mode = M('app_roomsetting');
		$url = M_URL('Website','tempBgm',$tempid,GP('p-'.$now_page));
		//批量删除
		if(KS_G('post.batch')==4){
			foreach ($id as $v ){$Mode->delete('id='.$v);}
			$this->cache->putACache('domaininfo');//写入缓存
			KS_INFO('批量删除成功',0,$url);
		}
    }
    //问题反馈
    public function problemAction(){
    	include  CURR_VIEW_PATH . "Website/problem.php";
    }
    /**
     * 保存意见反馈
     */
    public function doAddproblemAction(){
    	$Mode = M('common_feedback');
    	$url = M_URL('Website','problem','',GP(''));
    	echo '<script src="'.UOOT.'Public/common/js/jquery.js"></script>';
		echo '<script src="'.UOOT.'Public/Zpopup/js/Zpopup-2.0.js"></script>';
    	$data['title'] =ChkSQL(KS_G('post.title'));
    	$data['content'] = EncodeSQL(KS_G('post.massage'));
    	if(empty($data['title'])){
			KS_Alert('请输入标题','error',$url)	;
    	}
    	if(empty($data['content'])){
    		KS_Alert('请输入内容','error',$url)	;
    	}
    	$data['wxid']  = $this->wxid;

    	$data['adddate'] = time();
    	$Mode->doAdd($data,'id');
    	$url = M_URL('Massage','problemlist','',GP(''));
    	KS_INFO('发送意见成功','3',$url)	;
    }


}

//store.kesion.com/admin.php/home/Index/musiclist?type-top,name-fileurl
//ks.kesion.com/home.html/default/Index/musiclist?type-top,name-fileurl