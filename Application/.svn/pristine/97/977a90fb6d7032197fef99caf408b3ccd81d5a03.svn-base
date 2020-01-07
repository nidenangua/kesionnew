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
class SettingController extends CommonController{
    /**
     * 配置首页(总入口）
     */
    public function indexAction(){
        include  CURR_VIEW_PATH . "Setting/admin.Setting.php";
    }


	/****************************************************** 网站基本设置  begin***************************************************/
    /**
     * 平台基本信息设置
     */
    public function platSettingAction(){
		$site = $this->cache->GetACache('setting');//读出缓存
        include  CURR_VIEW_PATH . "Setting/Plat/admin.PlatSetting.php";
    }
	/**
	 * 保存平台基本信息设置
	 */
	public function savePlatSettingAction(){
	    $settingModel = new SettingModel('common_setting');
		//邮件信息
		$Data['emailServer']   = ChkSQL(KS_G('post.emailServer'));
		$Data['emailPort']     = ChkSQL(KS_G('post.emailPort'));
		$Data['emailSender']   = ChkSQL(KS_G('post.emailSender'));
		$Data['emailUser']     = ChkSQL(KS_G('post.emailUser'));
		$Data['emailPassword'] = ChkSQL(KS_G('post.emailPassword'));
        //网站信息
		$Data['sitename']      = ChkSQL(KS_G('post.sitename'));
		$Data['domain']        = ChkSQL(KS_G('post.domain'));
		$Data['jshash']        = ChkSQL(KS_G('post.jshash'));
        /*$logo = ChkSQL(KS_G('post.logo'));
		$upload = new Upload();
		$upload->upliadOne($logo);*/
	    //上传文件信息
		$Data['uploadSize'] = ChkSQL(KS_G('post.uploadSize'));


		$Data['uploadExts'] = ChkSQL(KS_G('post.uploadExts'));
		$Data['uploadPath'] = ChkSQL(KS_G('post.uploadPath'));
		//提现配置信息
		$Data['poundage']       = ChkSQL(KS_G('post.poundage'));
		$Data['sumincome']      = ChkSQL(KS_G('post.sumincome'));
		$Data['collection']     = ChkSQL(KS_G('post.collection'));

		$Data['sumincome1']      = ChkSQL(KS_G('post.sumincome1'));
		$Data['collection1']     = ChkSQL(KS_G('post.collection1'));

		$Data['sumincome2']      = ChkSQL(KS_G('post.sumincome2'));
		$Data['collection2']     = ChkSQL(KS_G('post.collection2'));

		$Data['salesincome1']     = ChkSQL(KS_G('post.salesincome1'));
		$Data['salesincome2']     = ChkSQL(KS_G('post.salesincome2'));

		$Data['poundage1']       = ChkSQL(KS_G('post.poundage1'));
		$Data['withdrawnum1']    = ChkSQL(KS_G('post.withdrawnum1'));
		$Data['withdrawmoney1']  = ChkSQL(KS_G('post.withdrawmoney1'));

		$Data['withdrawnum']    = ChkSQL(KS_G('post.withdrawnum'));
		$Data['withdrawmoney']  = ChkSQL(KS_G('post.withdrawmoney'));

		$Data['smsremind1']     = ChkSQL(KS_G('post.smsremind1'));
		$Data['smsremind2']     = ChkSQL(KS_G('post.smsremind2'));
		$Data['smsremind3']     = ChkSQL(KS_G('post.smsremind3'));
		$Data['emailremind1']   = ChkSQL(KS_G('post.emailremind1'));
		$Data['emailremind2']   = ChkSQL(KS_G('post.emailremind2'));
		$Data['emailremind3']   = ChkSQL(KS_G('post.emailremind3'));
		$Data['smswordnumber']  = ChkSQL(KS_G('post.smswordnumber'));
	    //短信设置
	    $Data['messageState'] = ChkSQL(KS_G('post.messageState'));
	    if( $Data['messageState'] == 1){
			$Data['messageUser']        = (KS_G('post.messageUser'));
			$Data['messagePass']        = (KS_G('post.messagePass'));
			$Data['messagePassEncrypt'] = (KS_G('post.messagePassEncrypt'));
			$Data['messageInter']       = (KS_G('post.messageInter'));
			$Data['messageSuccess']     = (KS_G('post.messageSuccess'));
			$Data['messageCode']        = (KS_G('post.messageCode'));
			$Data['messageBalance']     = (KS_G('post.messageBalance'));
			$Data['messageBalanceBegin']= (KS_G('post.messageBalanceBegin'));
			$Data['messageBalanceEnd']  = (KS_G('post.messageBalanceEnd'));
			$Data['smsSignature']       = (KS_G('post.smsSignature'));
			$Data['smsTime']            = ChkClng(KS_G('post.smsTime'));
	    }
	    //会员注册选项
	    $Data['reviewTeacher'] = ChkClng(KS_G('post.reviewTeacher'));
	    $Data['reviewSchool']  = ChkClng(KS_G('post.reviewSchool'));
	    $Data['reviewMember']  = ChkClng(KS_G('post.reviewMember'));
	    $Data['mbings']        = ChkClng(KS_G('post.mbings'));
	    $Data['ebings']        = ChkClng(KS_G('post.ebings'));
		$Data['registerlogin'] = ChkClng(KS_G('post.registerlogin'));
		$Data['registerinfo']  = ChkClng(KS_G('post.registerinfo'));

		$Data['isrealname']         = ChkClng(KS_G('post.isrealname'));
		$Data['initialemailmodel']  = ChkClng(KS_G('post.initialemailmodel'));
		$Data['initialsmsmodel']    = ChkClng(KS_G('post.initialsmsmodel'));
		$Data['initialmassage']     = ChkClng(KS_G('post.initialmassage'));
		$Data['regsitename']        = ChkClng(KS_G('post.regsitename'));
	    //点播
	    $Data['vodmoney']      = ChkSQL(KS_G('post.vodmoney'));//赠送代金券
	    $Data['storageprice']  = ChkSQL(KS_G('post.storageprice'));//存储单价
	    $Data['flowprice']     = ChkSQL(KS_G('post.flowprice'));//流量单价
	    $Data['vodfrequency']  = ChkSQL(KS_G('post.vodfrequency'));//频率
	    $Data['vodspace']      = ChkSQL(KS_G('post.vodspace'));//初始空间
	    //直播
	    $Data['livemoney']         = ChkSQL(KS_G('post.livemoney'));//赠送代金券
	    $Data['liveflowprice']     = ChkSQL(KS_G('post.liveflowprice'));//流量单价
	    $Data['livevodfrequency']  = ChkSQL(KS_G('post.livevodfrequency'));//频率
		//验证
		$Rule['sitename']          = '站点名称|isEmpty';
		$Rule['domain']            = '站点域名|isEmpty';
		$Rule['emailServer']       = '邮箱服务器|isEmpty';
		$Rule['emailPort']         = '邮箱端口|isEmpty';
		$Rule['emailSender']       = '邮箱发送人|isEmpty,isEmail';
		$Rule['emailUser']         = '邮箱账号|isEmpty';
		$Rule['emailPassword']     = '邮箱密码|isEmpty';
		$Rule['uploadSize']        = '上传大小|isEmpty,isNumber';
		$Rule['uploadExts']        = '上传文件类型|isEmpty';
		$Rule['uploadPath']        = '文件保存路径|isEmpty';
		if($Data['messageState'] == 1){
			$Rule['messageUser']         = '短信账号|isEmpty';
			$Rule['messagePass']         = '短信密码|isEmpty';
			$Rule['messageInter']        = '短信接口|isEmpty';
			$Rule['messageSuccess']      = '发送返回标志|isEmpty';
			$Rule['messageBalance']      = '查询余额链接|isEmpty';
			$Rule['messageBalanceBegin'] = '查询返回开始标志|isEmpty';
			$Rule['messageBalanceEnd']   = '查询返回结束标志|isEmpty';
			$Rule['smsSignature']        = '短信签名|isEmpty';
		}
		Chkpost($Data,$Rule,$settingModel);
		$settingModel->updateSetting($Data);
		$this->cache->PutACache('setting');//存入缓存
		KS_INFO("更新成功",0,M_URL('Setting'));
	}
    /**************************************************************网站基本设置  end ***************************************************/










    /**************************************************************支付接口配置 begin ***************************************************/
    /**
     * 支付接口设置(首页）
     */
    public function paySettingAction(){
		$payconfig = $this->cache->GetACache('payconfig');//取出缓存
		include  CURR_VIEW_PATH . "Setting/Pay/admin.pay.index.php";
	}
    /**
     * 支付接口编辑(界面）
     */
    function editPayAction(){
	    $id = ChkClng(KS_G('request.id'));
	    $payconf = $this->cache->GetA('payconfig','id',$id,'',true);
	    include  CURR_VIEW_PATH . "Setting/Pay/admin.pay.add.php";
	}
    /**
     * 保存接口配置
     */
    public function saveEditPayAction(){
	    $id       = ChkClng(KS_G('request.id'));
	    $contents = ChkSQL(KS_G('post.contents'));
	    $PayModel = M('common_pay_content');
	    $content  = $this->cache->GetA('payconfig','id',$id,'content');
	    $PArr     = explode('$$$',$content);
	    foreach($PArr as $k=>$v){
            $v = explode('|$|',$v);
            $v['1'] = $contents[$k];
            $TArr[$k] = implode('|$|',$v);
	    }
	    $Data['content'] = implode('$$$',$TArr);
	    $Data['payname'] = ChkSQL(KS_G('post.payname'));
	    $Data['intro']   = ChkSQL(KS_G('post.intro'));
	    $Data['counter'] = ChkSQL(KS_G('post.counter'));
	    $Data['status']  = ChkClng(KS_G('post.status'));
		if(!empty($_FILES['file']['tmp_name'])){
			$defaultpic = $PayModel->getOne('defaultpic',"where id=$id limit 1");
			$this->upload->removefile($defaultpic);
			$this->upload->savePath = 'logo/'; // 设置附件上传（子）目录
			$info = $this->upload->uploadOne($_FILES['file']);
			if(!$info) {KS_INFO($this->upload->getError());}//上传错误提示错误信息
			else{
				$Data['defaultpic'] = ChkSQL($this->upload->uootPath.$info['savepath'].$info['savename']);//应用封面图片
			}
		}
	    $Rule['payname']  = '支付平台名称|isEmpty';
	    Chkpost($Data,$Rule,$PayModel,"id!=$id");
	    $PayModel->update($Data,"id=$id");
	    $this->cache->PutACache('payconfig');//存入缓存
	    $url = M_URL('Setting','paySetting',$id);
	    KS_INFO("更新成功",0,$url);
	}
    /**
     * 批量保存支付配置
     */
    public function saveBatchPayAction(){
        $PayModel = new SettingModel('common_pay_content');
		$PayModel->PayConfigStatus0();
		$statusid = null!==ChkSQL(KS_G('post.status')) ? ChkSQL(KS_G('post.status')): "";
		if(!empty($statusid)){$PayModel->PayConfigStatus1($statusid);}
		$Isdefaultid = ChkClng(KS_G('post.Isdefault'));
		$PayModel->PayConfigIsdefault0();
		$PayModel->PayConfigIsdefault1($Isdefaultid);
		$id = ChkSQL(KS_G('post.id'));
		$payname = ChkSQL(KS_G('post.payname'));
		foreach ($id as $k => $v)
		{
		    $Data['payname'] = $payname[$k];
		    $PayModel->update($Data,"id = $v");
		}
		$this->cache->PutACache('payconfig');//存入缓存
		$url=M_URL('Setting','paySetting');
		KS_INFO("更新成功",0,$url);
    }
    /**************************************************************支付接口配置 end***************************************************/








    /**************************************************************地区配置 begin***************************************************/

    /**
     * 进入地区管理页面
     */
    public function areaIndexAction(){
        $areaModel = M('common_area');
        $parentid  = ChkClng(KS_G('get.id'));
        if ($parentid>0){
            $param='WHERE parentid='.$parentid;
        }else{
            $param='WHERE depth=1';
        }
        $options   = $areaModel->getOptions('15',$param);//分页参数设置
        $page      = Page($options);
        $pageapps  = $areaModel->getPage($page,'orderid',$param);
        include  CURR_VIEW_PATH . "Setting/Area/area.admin.list.php";
	}
	/**
     * 进入地区增加页面
	 */
	public function addAreaAction(){
        $areaModel = new SettingModel('common_area');
        $result   =  $areaModel->getArea();
        $areas = \Core\Phptree::makeTreeForHtml($result);
        $areaid ="0";
        if(!empty(KS_G('get.id'))){$areaid = KS_G('get.id');}
        $orderid  = ($areaModel->getAreaOrderId($areaid))+1;
        include  CURR_VIEW_PATH . "Setting/Area/area.admin.add.php";
	}
	//获取排序
	public function getAreaOrderIdAction(){
		$areaModel = new SettingModel('common_area');
		$areaid    = KS_G('post.parentid');
		$orderid   = ($areaModel->getAreaOrderId($areaid))+1;
		echo $orderid;
	}
	//添加地区
	public function doAddAreaAction(){
		$areaModel = new SettingModel('common_area');
		$areas     =  $areaModel->getAreaOne(ChkClng(KS_G('post.parentid')));
		$Data['depth'] = (int)$areas["depth"] + 1;
		$Data['ecity'] = ChkSQL(KS_G('post.ecity'));
		$Data['city'] = ChkSQL(KS_G('post.city'));
		$Data['parentid'] = ChkClng(KS_G('post.parentid'));
		$Data['letter'] = ChkSQL(KS_G('post.letter'));
		$Data['orderid'] = ChkClng(KS_G('post.orderid'));
		$Data['orderid'] = $areaModel->insterOrderArea($Data['orderid'],$Data['parentid']);
		$areaModel = new SettingModel('common_area');
		$Rule['city']  = '城市名称|isEmpty';
		$Rule['orderid']  = '排序|isEmpty';
		Chkpost($Data,$Rule,$areaModel);
		$result = $areaModel->doAdd($Data,'id');
		$areone = $areaModel->getAreaOne($result);//写入缓存
		$area = $this->cache->PutACache('areainfo');
		$url1=M_URL('Setting','addArea',$Data['parentid']);
		$url2=M_URL('Setting','areaIndex',$Data['parentid']);
		KS_INFO("添加成功，是否继续添加",1,$url1,$url2);
	}
	//删除地区
	public function delAreaAction(){
		$id        = ChkClng(KS_G('get.id'));
		$now_page  = ChkClng(KS_S('p'));
		$areaModel = new SettingModel('common_area');
		//进行重新排序
		$areaModel->reOrderArea($id);
		$result =$areaModel->delAreas($id);
		//写入缓存
		$area = $this->cache->PutACache('areainfo');
		$url = M_URL('Setting','areaIndex',ChkClng(KS_S('parentid')),GP('p-'.$now_page));
		ks_header($url);
    }
    //批量更新
	public function updateAreaAction(){
		$areaModel = new  SettingModel('common_area');
		$id =$_POST["id"];
		$city =$_POST["city"];
		$letter = $_POST["letter"];
		$orderid = $_POST["orderid"];
		$result =$areaModel->updateArea($id,$city,$letter,$orderid);//写入缓存
		$area = $this->cache->PutACache('areainfo');
		KS_INFO("更新成功");
	}

    /**************************************************************地区配置 end***************************************************/




    /**************************************************************第三方登录配置 begin ***************************************************/
    /**
     * 第三方登录配置
     */
    public function loginConfAction(){
		$loginconf = $this->cache->GetACache('loginconf');//取出缓存
		$site = $this->cache->GetACache('setting');//读出缓存
		include  CURR_VIEW_PATH . "Setting/Login/admin.login.configlist.php";
	}
	/**
	 * 保存第三方登录配置
	 */
	public function saveLoginConfAction(){
		$Datas['loginState'] = ChkClng(KS_G('post.loginState'));
		$Rule['loginState']  = '首次登录是否创建设置|isEmpty';
		$settingModel        = new SettingModel('common_setting');
		Chkpost($Datas,$Rule,$settingModel);
		$settingModel->updateSetting($Datas);
		$this->cache->PutACache('setting');//存入缓存
		$loginModel = M('Application/LoginModel/common_login_content');
		$loginModel->status0();
		$statusid = null!==ChkSQL(KS_G('post.status')) ? ChkSQL(KS_G('post.status')): "";
		if(!empty($statusid)){$loginModel->status1($statusid);}
		$id      = ChkSQL(KS_G('post.id'));
		$login   = ChkSQL(KS_G('post.login'));
		$apiID   = ChkSQL(KS_G('post.apiID'));
		$apiKey  = ChkSQL(KS_G('post.apiKey'));
		$backurl = ChkSQL(KS_G('post.backurl'));
		foreach ($id as $k => $v){
		    $Data['login']   = $login[$k];
			$Data['apiID']   = $apiID[$k];
			$Data['apiKey']  = $apiKey[$k];
			$Data['backurl'] = $backurl[$k];
		    $loginModel->update($Data,"id = $v");
		}
		$this->cache->PutACache('loginconf');//存入缓存
		$url=M_URL('Setting','loginConf');
		KS_INFO("更新成功",0,$url);
	}
    /**************************************************************第三方登录配置 end ***************************************************/

	/**************************************************************表字段扩展管理 begin ***************************************************/

	//进入章节表管理页
	public function extendIndexAction(){
		$extendTable = new ExtendTableModel('common_extends_table');
		$values      = $extendTable->getAll('GROUP BY type','*,count(*)');
		$tables      = $extendTable->getTables();
		include  CURR_VIEW_PATH . "Setting/ExtendTable/admin.extendTable_index.php";
	}
	public function extendAddTableTypeAction(){
		$extendTable = new ExtendTableModel('common_extends_table');
		$typemax = $extendTable->getMaxValue('type');
		$Data['type'] = $typemax+1;
		$Data['tablename'] = substr(ChkSQL(KS_G('post.tablename')), 3);
		$Data['itemname'] = '原型表';
		$Data['Isdefault'] = 1;
		$Data['issys'] = 1;
		$Data['title'] = ChkSQL(KS_G('post.title'));
		$extendTable->doAdd($Data,'tableid');
		$this->cache->putACache('extable');//写入缓存
		$url1=M_URL('Setting','extendIndex');
		KS_INFO("添加成功",0,$url1);
	}
	public function extendDelTypeAction(){
		$extendTable = new ExtendTableModel('common_extends_table');
		$type=ChkClng(KS_G('get.id'));
		$count = $extendTable->getOne('count(*)','where type = '.$type);
		$url1=M_URL('Setting','extendIndex');
		if($count>1){KS_INFO("该项目不允许删除",0,$url1);}
		$extendTable->delete('type = '.$type);
		$this->cache->putACache('extable');//写入缓存
		ks_header($url1);
	}
	//进入扩展表
	public function extendTableListAction(){
		$extendTable = new ExtendTableModel('common_extends_table');
		$type=ChkClng(KS_G('get.id'));
		$values = $extendTable->getAll('where type = '.$type);
		foreach($values as $k=>$v){
			$result = $extendTable->istable($v['tablename']);
			if(!$result){
				$table = $extendTable->getRow('where issys =1 and type = '.$type);
				$extendTable->doCreateTable('ks_'.$v['tablename'],'ks_'.$table['tablename']);
			}
			$values[$k]['count'] = $extendTable->getTableRow($v['tablename']);
		}
		include  CURR_VIEW_PATH . "Setting/ExtendTable/admin.extend_table_list.php";
	}
	/**
     * 进入添加表页
	 */
	public function extendAddTableAction(){
		$type=ChkClng(KS_G('get.id'));
		$extendTable = new ExtendTableModel('common_extends_table');
		$table = $extendTable->getOne('tablename','where issys =1 and type = '.$type);
		include  CURR_VIEW_PATH . "Setting/ExtendTable/admin.extend_table_add.php";
	}
	/**
     * 保存进入添加扩展表
	 */
	public function extendDoaddtableAction(){
		$type=ChkClng(KS_G('get.id'));
		$extendTable = new ExtendTableModel('common_extends_table');
		$table = $extendTable->getRow('where issys =1 and type = '.$type);
		$Data['type'] = $type;
		$Data['title'] = $table['title'];
		$Data['itemname'] = ChkSQL(KS_G('post.itemname'));
		$Data['tablename'] = $table['tablename'].ChkSQL(KS_G('post.tablename'));
		$istable = $extendTable->selectTable('ks_'.$Data['tablename']);
		if($istable){KS_INFO("该张表名已存在，请检查");}
		$Data['Isdefault'] = ChkSQL(KS_G('post.Isdefault'));
		$Rule['tablename']  = '表名|isEmpty';
		Chkpost($Data,$Rule,$extendTable);
		if($Data['Isdefault']==1){$extendTable->updatedefault($type);}
		$tablename='ks_'.$Data['tablename'];
		$extendTable->doCreateTable($tablename,'ks_'.$table['tablename']);
		$extendTable->doAdd($Data,'tableid');
		$this->cache->putACache('extable');//写入缓存
		$url1=M_URL('Setting','extendTableList',$type);
		KS_INFO('添加成功',3,$url1);
	}
	//删除章节表
	public function extendDeltableAction(){
		$extendTable = new ExtendTableModel('common_extends_table');
		$id=ChkClng(KS_G('get.id'));
		$table=$extendTable->getRow("where tableid =$id");
		$url1=M_URL('Setting','extendTableList',$table['type']);
		if($table["Isdefault"]==1){KS_INFO("该张表是默认表不能删除",0,$url1);}
		if($table["issys"]==1){KS_INFO("该张表系统表不能删除",0,$url1);}
		$count = $extendTable->getTableRow($table['tablename']);
		if($count!=0){KS_INFO("该张表有数据不能删除",0,$url1);}
		$extendTable->delete("tableid = $table[tableid]");
		$extendTable->dodelTable($table["tablename"]);
		$this->cache->putACache('extable');//写入缓存
		ks_header($url1);
//KS_INFO("删除成功",0,$url1);
	}
	//保存配置
	public function extendBatchAction(){
		$type=ChkClng(KS_G('get.id'));
		$extendTable = new ExtendTableModel('common_extends_table');
		$id = $_POST["tableid"];
		$name =$_POST["itemname"];
		$statusid=ChkClng(KS_G('post.Isdefault'));
		//改变默认表
		$Data["Isdefault"]=1;
		$extendTable->updatedefault($type);
		$extendTable->update($Data,"tableid=$statusid");
		//更新表别名
		$extendTable->updataname($id,$name);
		$this->cache->putACache('extable');//写入缓存
		KS_INFO("保存成功");
	}
	/**************************************************************表字段扩展管理 end ***************************************************/

	/**************************************************************字段管理 begin ***************************************************/
	//进入模型列表页
	public function fieldindexAction(){
		$tableModel = new FieldModel('common_table');//实例化模型表
		$options    = $tableModel->getOptions('15');//分页参数设置
		$page       = Page($options);
		$pagetables = $tableModel->getPage($page,'orderid');
		include  CURR_VIEW_PATH . "Setting/Field/admin.table_list.php";
	}
	//进入添加模型页
	public function addTableAction(){
		$tableModel = new FieldModel();//实例化模型表
		$tables     = $tableModel->getTables();
		include  CURR_VIEW_PATH . "Setting/Field/admin.table_add.php";
	}
	//添加模型操作
	public function doaddTableAction(){
		$Data['itemname']  = ChkSQL(KS_G('post.itemname'));//模型名称
		$Data['tablename'] = ChkSQL(KS_G('post.tablename'));//表名
		$Data['intro']     = ChkSQL(KS_G('post.intro'));//介绍
		$tableModel        = new FieldModel('common_table');//实例化模型表
		$Data['orderid']   = $tableModel->getMaxValue('orderid')+1;//排序
		$Rule['itemname']  = '模型名称|isEmpty,isDbexis';
		$Rule['tablename'] = '数据表名|isEmpty,isDbexis';
		Chkpost($Data,$Rule,$tableModel);
		//对模型表进行增加操作
		$tableid           = $tableModel->doAdd($Data,'tableid');//添加模型
		//在数据库中实现
		//$tableModel->doCreateTable($tablename);
		$fieldgroupModel   = new FieldModel('common_table_fieldgroup');
		$DataG['groupname']= '自定义字段';//表ID
		$DataG['orderid']  = '1';
		$DataG['tableid']  = $tableid;
		$groupid           = $fieldgroupModel->doAdd($DataG,"groupid");
		ks_header(M_URL('Setting','fieldindex'));
	}
	//进入编辑模型页
	public function editTableAction(){
		$tableid    = KS_G('id');//表ID
		$fieldModel = new FieldModel('common_table');//实例化模型表
		//获得单个模型
		$table      = $fieldModel->getRow("where tableid=$tableid");//得到一条记录
		include  CURR_VIEW_PATH . "Setting/Field/admin.table_add.php";
	}
	//编辑模型操作
	public function doeditTableAction(){
		$tableid           = ChkClng(KS_G('post.tableid'));//表ID
		$Data['itemname']  = ChkSQL(KS_G('post.itemname'));//模型名称
		$Data['tablename'] = ChkSQL(KS_G('post.tablename'));//表名
		$Data['intro']     = ChkSQL(KS_G('post.intro'));//介绍
		$tableModel        = new FieldModel('common_table');
		//确认修改判断规则，详见ks_cls文件夹中的kesion.chkpost
		$Rule['itemname']  = '模型名称|isEmpty,isDbexis';
		$Rule['tablename'] = '数据表名|isEmpty,isDbexis';
		Chkpost($Data,$Rule,$tableModel,"tableid!=$tableid");
		//对管理员表进行修改操作
		$result = $tableModel->update($Data,"tableid=$tableid");//
		ks_header(M_URL('Setting','fieldindex'));
	}
	//删除模型操作
	public function deleteTableAction(){
		$tableid    = KS_G('id');//表ID
		$fieldModel = new FieldModel('common_table_field');
		$fieldname  = $fieldModel->getAll("where tableid='$tableid'",'fieldname');
		$tableModel = new FieldModel('common_table');//实例化模型表
		$tablename  = $tableModel->getOne('tablename',"where tableid='$tableid'");
		$tableModel->dropAllField($tablename,$fieldname);
		$orderid    = $tableModel->getOne('orderid',"where tableid='$tableid'");
		$fieldModel->delete("tableid='$tableid'");
		$tableModel->delete("tableid='$tableid'");
		$GLOBALS['db']->execSql("UPDATE `$tableModel->table` SET `orderid`=orderid-1 WHERE orderid>$orderid");
		$fieldgroupModel = new FieldModel('common_table_fieldgroup');
		$fieldgroupModel->delete("tableid='$tableid'");
		ks_header(M_URL('Setting','fieldindex'));
	}
	/*-------------------------------------字段表 查增改删----------------------------------------------*/
	//进入据表字段列表页
	public function indexFieldAction(){
		$groupid = null !==GF('groupid') ? GF('groupid'):'';
		$tableid = ChkClng(KS_G('request.id'));//表ID
		$fieldgroupModel = new FieldModel('common_table_fieldgroup');
		if(empty($groupid)){
			$groupid = $fieldgroupModel->getOne('groupid',"where tableid='$tableid' and issys=0 limit 1");
			if(empty($groupid)){
				$where ="where tableid = $tableid";
			}else{
				$where ="where tableid = $tableid and groupid = $groupid";
			}
		}else{
			if(empty($groupid)){
				$where ="where tableid = $tableid";
			}else{
				$where ="where tableid = $tableid and groupid = $groupid";
			}
		}
		$now_page   =  ChkClng(KS_S('p',1));
		$fieldModel = new FieldModel('common_table_field');
		$options    = $fieldModel->getOptions('15',$where);
		$page       = Page($options);
		$pagefields = $fieldModel->getPage($page,'orderid', $where);
		$tableModel = new FieldModel('common_table');
		$table      = $tableModel->getRow("where tableid=$tableid limit 1");
		$fieldgroup = $fieldgroupModel->getAll("where tableid='$tableid' order by orderid asc");
		include  CURR_VIEW_PATH . "Setting/Field/admin.field_list.php";
	}
	//进入添加字段页
	public function fieldaddFieldAction(){
		$tableid         = ChkClng(KS_G('request.id'));//表ID
		$tableModel      = new FieldModel('common_table');
		$table           = $tableModel->getRow("where tableid=$tableid limit 1");
		$fieldgroupModel = new FieldModel('common_table_fieldgroup');
		$fieldgroup      = $fieldgroupModel->getAll("where tableid='$tableid' order by orderid asc");
		$groupid         = $fieldgroupModel->getOne('groupid',"where tableid='$tableid' and issys=0 limit 1");
		if(empty($groupid)){
			$where ="where tableid=$tableid and isentry=1 and status=1 and showtitle!='' order by orderid";
		}else{
			$where ="where tableid=$tableid and isentry=1 and status=1 and groupid = $groupid and showtitle!='' order by orderid";
		}
		$fieldModel = new FieldModel('common_table_field');//实例化字段表
		$smallgroup = $fieldModel->getAll($where);
		include  CURR_VIEW_PATH . "Setting/Field/admin.field_add.php";
	}
	//添加字段操作
	public function doaddFieldAction(){//模型id
		$Data['tableid']   = ChkClng(KS_G('request.id'));
		$Data['groupid']   = ChkClng(KS_G('post.groupid'));
		$Data['title']     = ChkSQL(KS_G('post.title'));
		$Data['fieldname'] = ChkSQL(KS_G('post.fieldname'));
		$Data['prompt']    = ChkSQL(KS_G('post.prompt'));
		$Data['fieldtype'] = ChkClng(KS_G('post.fieldtype'));
		$Data['defaultval']= ChkSQL(KS_G('post.defaultval'));
		$Data['width']     = ChkSQL(KS_G('post.width'));
		$Data['height']    = ChkSQL(KS_G('post.height'));
		$Data['isentry']   = ChkSQL(KS_G('post.isentry'));
		$Data['mustinput'] = ChkSQL(KS_G('post.mustinput'));
		$Data['manageitem']= ChkSQL(KS_G('post.manageitem'));
		$Data['isshow']    = ChkSQL(KS_G('post.isshow'));
		$Data['showtitle'] = ChkSQL(KS_G('post.showtitle'));
		$Data['status']    = ChkSQL(KS_G('post.status'));
		$Data['fiesys']    = 1;
		$tableModel        = new FieldModel('common_table');
		$tablename         = $tableModel->getOne('tablename',"where tableid='$Data[tableid]'");
		$fieldModel        = new FieldModel('common_table_field');
		$Data['orderid']   = $fieldModel->getMaxValue('orderid',"tableid='$Data[tableid]'")+1;//排序
		//确认修改判断规则，详见ks_cls文件夹中的kesion.chkpost
		$Rule['title']     = '字段别称|isEmpty';
		$Rule['fieldname'] = '字段名称|isEmpty,isEnglish';
		$Rule['fieldtype'] = '字段类型|isEmpty,isNumber';
		Chkpost($Data,$Rule,$fieldModel);
		//在数据库中实现
		$fieldModel->doCreateField($tablename,$Data);
		//对字段表进行增加操作
		$result = $fieldModel->doAdd($Data,'fieldid');
		$url    = M_URL('Setting','indexField',$Data['tableid'],GP('groupid-'.$Data['groupid']));
		KS_INFO('添加成功',0,$url);
	}
	//进入编辑字段页
	public function editFieldAction(){
		$fieldid    = ChkClng(KS_G('request.id'));//字段ID
		$now_page   =  ChkClng(KS_S('p',1));
		$tableid    = null !==GF('tableid') ? GF('tableid'):'';
		$fieldModel = new FieldModel('common_table_field');
		//获得单个字段
		$field = $fieldModel->getRow("where fieldid=$fieldid limit 1");
		$tableModel = new FieldModel('common_table');
		$table = $tableModel->getRow("where tableid=$tableid limit 1");
		$fieldgroupModel = new FieldModel('common_table_fieldgroup');
		$fieldgroup = $fieldgroupModel->getAll("where tableid='$tableid' order by orderid asc");
		$smallgroup = $fieldModel->getAll("where tableid=$tableid and isentry=1 and status=1 and groupid=$field[groupid] and fieldid!=$fieldid and showtitle!='' order by orderid");
		include  CURR_VIEW_PATH . "Setting/Field/admin.field_add.php";
	}
	//编辑字段操作
	public function doeditFieldAction(){
		$fieldid = KS_G('request.id'); //字段ID
		$tableid = null !==GF('tableid') ? GF('tableid'):'';
		$Data['groupid'] = ChkClng(KS_G('post.groupid'));
		$Data['title'] = ChkSQL(KS_G('post.title'));//字段标题
		$Data['fieldname'] = ChkSQL(KS_G('post.fieldname'));//字段名
		$Data['prompt'] = ChkSQL(KS_G('post.prompt'));
		$Data['defaultval'] = ChkSQL(KS_G('post.defaultval'));
		$Data['width'] = ChkSQL(KS_G('post.width'));
		$Data['height'] = ChkSQL(KS_G('post.height'));
		$Data['isentry'] = ChkSQL(KS_G('post.isentry'));
		$Data['mustinput'] = ChkSQL(KS_G('post.mustinput'));
		$Data['manageitem'] = ChkSQL(KS_G('post.manageitem'));
		$Data['showtitle'] = ChkSQL(KS_G('post.showtitle'));
		if($Data['showtitle']!==''){
			$Data['isshow'] = 0;
		}else{
			$Data['isshow'] = ChkSQL(KS_G('post.isshow'));
		}
		$Data['status'] = ChkSQL(KS_G('post.status'));
		$fieldModel     = new FieldModel('common_table');
		$tablename      = $fieldModel->getOne('tablename',"where tableid='$tableid'");
		$fieldModel     = new FieldModel('common_table_field');//实例化字段表
		//在数据库中实现
		//$fieldModel->editField($tablename,$Data,$fieldid,'fieldid');
		//对字段表进行修改操作
		$fieldModel->update($Data,"fieldid=$fieldid");//编辑字段
		$url = M_URL('Setting','indexField',$tableid,GP('groupid-'.$Data['groupid']));
		ks_header($url);
	}
	//删除字段操作
	public function ddeleteFieldAction(){
		$fieldid    = KS_G('request.id'); //字段ID
		$tableid    = null !==GF('tableid') ? GF('tableid'):'';
		$now_page   =  ChkClng(KS_S('p',1));
		$fieldModel = new FieldModel('common_table');//实例化模型表
		$tablename  = $fieldModel->getOne('tablename',"where tableid='$tableid'");//传进表id得到表名
		$fieldModel = new FieldModel('common_table_field');//实例化字段表
		$orderid    = $fieldModel->getOne('orderid',"where tableid='$tableid'");
		//在数据库中实现
		$fieldModel->dropField($tablename,$fieldid,'fieldid');
		//对字段表进行删除操作
		$result = $fieldModel->delete("fieldid=$fieldid");//删除字段
		$GLOBALS['db']->execSql("UPDATE `$fieldModel->table` SET `orderid`=orderid-1 WHERE orderid>$orderid and tableid=$tableid");
		$url = M_URL('Setting','indexField',$tableid,GP('p-'.$now_page));
		ks_header($url);
	}
	public function fieldPreviewAction(){
		/*==================begin========================*/
		$this->AppName = 'article';
		$userid  =  0;
		$appid=null !==GF('appid') ? GF('appid'):'0';
		$groupid=null !==GF('groupid') ? GF('groupid'):'';
		$this->cache = new \Core\Cache();
		$app = $this->cache->GetA('appinfo','appid',$appid,'',true);
		if($app['isweb']==0){
			$title = '网站分类';
		}else{
			$title = '应用分类';
		}
		$ArticleModel = new AppModel('app_'.$app['tableename']);
		/*===================end=======================*/
		$category = $this->cache->GetHCache('appcategory',$this->wxid);//读出缓存
		$Linkage  = Linkage(array(),$category);
		$Linkage->inputname = 'categoryid';
		$fieldgroupModel = new AppModel('common_table_fieldgroup');
		$fieldgroup = $fieldgroupModel->getAll("where appid='$appid' order by orderid asc");
		/*--------字段拼接------*/
		$fieldModel = new AppModel('common_table_field');//实例化字段表
		foreach($fieldgroup as $k=>$v){
			$Field[$k] = $fieldModel->getAll("where appid = $appid and groupid = $v[groupid] and isentry=1 and status=1 and isshow=0 order by orderid");
		}
		include  CURR_VIEW_PATH . "Setting/Field/admin.field_preview.php";
	}
	public function fieldGroupAction(){
		$tableid         = ChkClng(KS_G('request.id'));//表ID
		$tableModel      = new FieldModel('common_table');
		$table           = $tableModel->getRow("where tableid=$tableid limit 1");
		$fieldgroupModel = new FieldModel('common_table_fieldgroup');
		$fieldgroup      = $fieldgroupModel->getAll("where tableid='$tableid' order by orderid asc");
		include  CURR_VIEW_PATH . "Setting/Field/field_group.php";
	}
	public function addfieldGroupAction(){
		$Data['tableid']   = ChkClng(KS_G('request.id'));//表ID
		$Data['groupname'] = ChkSQL(KS_G('post.groupname'));//表ID
		$fieldgroupModel   = new FieldModel('common_table_fieldgroup');
		$Data['orderid']   = $fieldgroupModel->getMaxValue('orderid',"tableid='$Data[tableid]'")+1;
		$Data['issys']     = 1;
		$fieldgroupModel->doAdd($Data,"groupid");
		$url = M_URL('Setting','fieldGroup',$Data['tableid']);
		ks_header($url);
	}
	public function delfieldGroupAction(){
		$groupid = ChkClng(KS_G('request.id'));//表ID
		$tableid = ChkClng(GF('tableid'));//表ID
		$Field   = new FieldModel('common_table_field');
		$count   = $Field->getOne('count(*)',"where groupid='$groupid'");
		if($count>0){KS_INFO('分组下还有字段，删除后才可以删除');}
		$fieldgroupModel = new FieldModel('common_table_fieldgroup');
		$fieldgroupModel->delete("groupid='$groupid'");
		$url = M_URL('Setting','fieldGroup',$tableid);
		ks_header($url);
	}
	public function batchfieldGroupAction(){
		$groupid   = KS_G('post.groupid');//表ID
		$groupname = KS_G('post.groupname');
		$orderid   = KS_G('post.orderid');
		$fieldgroupModel = new FieldModel('common_table_fieldgroup');
		foreach ($groupid as $k => $v){
			$Data['groupname'] = $groupname[$k];
			$Data['orderid']   = $orderid[$k];
			$fieldgroupModel->update($Data,"groupid = $v");
		}
		$tableid = ChkClng(GF('tableid'));//表ID
		$url     = M_URL('Setting','fieldGroup',$tableid);
		ks_header($url);
	}
	/**************************************************************字段管理 end ****************************************************/




	/**************************************************************短信 begin ***************************************************/
	public function SmscontentAction(){
		$site = $this->cache->GetACache('smsmodel');//取出缓存
		include  CURR_VIEW_PATH . "Setting/Smscontent/admin.settingsms_list.php";
	}
	public function addModelAction(){
		include  CURR_VIEW_PATH . "Setting/Smscontent/admin.settingsms_add.php";
	}
	public function doaddModelAction(){
		$SmsModel          = M('Application/SmsModel/common_sms_content');
		$Data['model']     = ChkSQL(KS_G('post.model'));
		$Data['modelname'] = ChkSQL(KS_G('post.modelname'));
		$Data['content']   = ChkSQL(KS_G('post.content'));
		$Data['smsnum']    = ChkClng(KS_G('post.smsnum'));
		$Rule['model']     = '模型英文名|isEmpty,isDbexis';
		$Rule['modelname'] = '模型|isEmpty';
		$Rule['content']   = '内容|isEmpty';
		Chkpost($Data,$Rule,$SmsModel);
		$SmsModel->doAdd($Data,'id');
		$this->cache->PutACache('smsmodel');//存入缓存
		$url1=M_URL('Setting','addModel');
		$url2=M_URL('Setting','Smscontent');
		KS_INFO("添加成功，是否继续添加",1,$url1,$url2);
	}
	public function delModelAction(){
		$SmsModel = M('Application/SmsModel/common_sms_content');
		$smsmodelid=ChkClng(KS_G('get.id'));
		$SmsModel->delete("id=$smsmodelid");
		$this->cache->PutACache('smsmodel');//存入缓存
		$url = M_URL('Setting','Smscontent');
		ks_header($url);
	}
	public function beachAction(){
		$SmsModel = M('Application/SmsModel/common_sms_content');
		$SmsModel->status0();
		$statusid = isset($_POST["status"]) ? $_POST["status"] : "";
		if(!empty($statusid)){$SmsModel->status1($statusid);}
		$id     =$_POST["id"];
		$smsnum =$_POST["smsnum"];
		$content=$_POST["content"];
		$SmsModel->beachupdate($id,$smsnum,$content);
		$this->cache->PutACache('smsmodel');//存入缓存
		$url=M_URL('Setting','Smscontent');
		KS_INFO("更新成功",0,$url);
	}
	public function smsLogAction(){
		$sms_log  = M('Application/SmsModel/common_sms_log');
		$options  = $sms_log->getOptions('10');
		$page     = Page($options);
		$pagelogs = $sms_log->getPage($page,'adddate desc');
		include  CURR_VIEW_PATH . "Setting/Smscontent/admin.sms_log.php";
	}


	//
	public function smsreplyAction(){
		include  CURR_VIEW_PATH . "Setting/Smscontent/admin.smsreply.php";
	}


	/**************************************************************短信 end ***************************************************/


	/**************************************************************邮件 begin ***************************************************/
	//邮件模板列表
	public function emailAction(){
		$site=$this->cache->GetACache('emailmodel');//取出缓存
		include  CURR_VIEW_PATH . "Setting/Email/admin.settingemail_list.php";
	}
	//进行邮件模板编辑页面
	public function emailaddAction(){
		$kindeditor = ks_editor('content');
		include  CURR_VIEW_PATH . "Setting/Email/admin.settingemail_add.php";
	}
	//进行邮件模板编辑操作
	public function emaildoaddAction(){
		$EmailModel        = new EmailModel('common_email_content');
		$Data['model']     = ChkSQL(KS_G('post.model'));
		$Data['modelname'] = ChkSQL(KS_G('post.modelname'));
		$Data['content']   = strip_tags(ChkSQL(KS_G('post.content')));
		$Data['emailnum']  = ChkClng(KS_G('post.emailnum'));
		$Rule['model']  = '模型英文名|isEmpty,isDbexis';
		$Rule['modelname']  = '模型|isEmpty';
		$Rule['content']  = '内容|isEmpty';
		$Rule['emailnum']  = '每日发送数量|isEmpty';
		Chkpost($Data,$Rule,$EmailModel);
		$EmailModel->doAdd($Data,'id');
		$this->cache->PutACache('emailmodel');//存入缓存
		$url1=M_URL('Setting','emailaddModel');
		$url2=M_URL('Setting','email');
		KS_INFO("添加成功，是否继续添加",1,$url1,$url2);
	}
	//批量修改邮箱模板
	public function emailbeachAction(){
		$EmailModel = new EmailModel('common_email_content');
		$EmailModel->status0();
		//var_dump($_POST["status"]).die;
		$statusid=isset($_POST["status"]) ? $_POST["status"] : "";

		if(!empty($statusid)){
			$EmailModel->status1($statusid);
		}
		$id=$_POST["id"];
		$emailnum=$_POST["emailnum"];
		$EmailModel->beachupdate($id,$emailnum);
		$this->cache->PutACache('emailmodel');//存入缓存

		$url=M_URL('Setting','email');
		KS_INFO("更新成功",0,$url);
	}
	//删除邮箱模板
	public function emaildelAction(){
		$EmailModel = new EmailModel('common_email_content');
		$id=ChkClng(KS_G('get.id'));
		$EmailModel->delete("id=$id");
		$this->cache->PutACache('emailmodel');//存入缓存
		$url = M_URL('Setting','email');
		ks_header($url);
	}
	//进行邮件模板编辑页面
	public function emaileditorAction(){
		$EmailModel = new EmailModel('common_email_content');
		$id=ChkClng(KS_G('get.id'));
		$email=$EmailModel->getRow("where id=$id limit 1");
		$kindeditor = ks_editor('content',$email['content']);
		include  CURR_VIEW_PATH . "Setting/Email/admin.settingemail_add.php";
	}
	//进行邮件模板编辑操作
	public function emaildoeditorAction(){
		$EmailModel         = new EmailModel('common_email_content');
		$Data['model']      = ChkSQL(KS_G('post.model'));
		$Data['modelname']  = ChkSQL(KS_G('post.modelname'));
		$Data['content']    = strip_tags(ChkSQL(KS_G('post.content')));
		$Data['emailnum']   = ChkClng(KS_G('post.emailnum'));
		$id = ChkClng(KS_G('post.id'));
		$Rule['model']      = '模型英文名|isEmpty,isDbexis';
		$Rule['modelname']  = '模型|isEmpty';
		$Rule['content']    = '内容|isEmpty';
		$Rule['emailnum']   = '每日发送数量|isEmpty';
		Chkpost($Data,$Rule,$EmailModel,"id!=$id");
		$EmailModel->update($Data,"id=$id");
		$this->cache->PutACache('emailmodel');//存入缓存
		$url2  = M_URL('Setting','email');
		KS_INFO("保存成功",0,$url2);
	}
	//站内信模板列表页
	public function emailmassageAction(){
		$site=$this->cache->GetACache('massagemodel');//取出缓存
		include  CURR_VIEW_PATH . "Setting/Email/admin.massage_list.php";
	}
	//站内信批量操作
	public function emailmassagebeachAction(){
		$massageModel = new EmailModel('app_massage_content');
		$massageModel->status0();
		$statusid=isset($_POST["status"]) ? $_POST["status"] : "";
		if(!empty($statusid)){
			$massageModel->status1($statusid);
		}
		$id        =$_POST["id"];
		$massagenum=$_POST["massagenum"];
		$massageModel->massageupdate($id,$massagenum);
		$this->cache->PutACache('massagemodel');//存入缓存
		$url=M_URL('Setting','emailmassage');
		KS_INFO("更新成功",0,$url);
	}
	//进入站内信添加界面
	public function emailaddmassageAction(){
		$kindeditor = ks_editor('content');
		include  CURR_VIEW_PATH . "Setting/Email/admin.massage_add.php";
	}
	//进行站内信添加操作
	public function emaildoaddmassageAction(){
		$massageModel        = new EmailModel('app_massage_content');
		$Data['model']       = ChkSQL(KS_G('post.model'));
		$Data['modelname']   = ChkSQL(KS_G('post.modelname'));
		$Data['content']     = strip_tags(ChkSQL(KS_G('post.content')));
		$Data['massagenum']  = ChkClng(KS_G('post.massagenum'));
		$Rule['model']       = '模型英文名|isEmpty,isDbexis';
		$Rule['modelname']   = '模型|isEmpty';
		$Rule['content']     = '内容|isEmpty';
		$Rule['massagenum']  = '每日发送数量|isEmpty';
		Chkpost($Data,$Rule,$massageModel);
		$massageModel->doAdd($Data,'id');
		$this->cache->PutACache('massagemodel');//存入缓存
		$url1=M_URL('Setting','emailaddmassage');
		$url2=M_URL('Setting','emailmassage');
		KS_INFO("添加成功，是否继续添加",1,$url1,$url2);
	}
	//进入站内信模板编辑页
	public function emaileditormassageAction(){
		$massageModel = new EmailModel('app_massage_content');
		$id           = ChkClng(KS_G('get.id'));
		$massage      = $massageModel->getRow("where id=$id limit 1");
		$kindeditor   = ks_editor('content',$massage['content']);
		include  CURR_VIEW_PATH . "Setting/Email/admin.massage_add.php";
	}
	//进行站内信编辑操作
	public function emaildoeditormassageAction(){
		$massageModel       = new EmailModel('app_massage_content');
		$Data['model']      = ChkSQL(KS_G('post.model'));
		$Data['modelname']  = ChkSQL(KS_G('post.modelname'));
		$Data['content']    = strip_tags(ChkSQL(KS_G('post.content')));
		$Data['massagenum'] = ChkClng(KS_G('post.massagenum'));
		$id=ChkClng(KS_G('post.id'));

		$Rule['model']      = '模型英文名|isEmpty,isDbexis';
		$Rule['modelname']  = '模型|isEmpty';
		$Rule['content']    = '内容|isEmpty';
		$Rule['massagenum'] = '每日发送数量|isEmpty';
		Chkpost($Data,$Rule,$massageModel,"id!=$id");
		$massageModel->update($Data,"id=$id");
		$this->cache->PutACache('massagemodel');//存入缓存=
		$url2 = M_URL('Setting','emailmassage');
		KS_INFO("保存成功",0,$url2);
	}
	//删除站内信模板
	public function emaildelmassageAction(){
		$massageModel = new EmailModel('app_massage_content');
		$id=ChkClng(KS_G('get.id'));
		$massageModel->delete("id=$id");
		$this->cache->PutACache('massagemodel');//存入缓存
		$url = M_URL('Setting','emailmassage');
		ks_header($url);
	}
	/**************************************************************邮件 end ***************************************************/

	/**************************************************************微名片订阅消息 begin ***************************************************/
	//服务通知模板列表
	public function cardTemplateAction(){
		$site = M('common_applet_template')->getAll();
		include  CURR_VIEW_PATH . "Setting/Smscontent/admin.cardtemplate_list.php";
	}
	public function addCardTemplateAction(){
		include  CURR_VIEW_PATH . "Setting/Smscontent/admin.cardtemplate_add.php";
	}
	public function doaddCardTemplateAction()
	{
		$SmsModel          = M('common_applet_template');
		$Data['title'] = ChkSQL(KS_G('post.title'));
		$Data['templateid']   = ChkSQL(KS_G('post.templateid'));
		$Rule['title']     = '模板标题|isEmpty,isDbexis';
		$Rule['templateid'] = '模板ID|isEmpty';
		Chkpost($Data,$Rule,$SmsModel);
		$SmsModel->doAdd($Data,'id');
		$this->cache->PutACache('applettemplate');//存入缓存
		$url1=M_URL('Setting','addCardTemplate');
		$url2=M_URL('Setting','cardTemplate');
		KS_INFO("添加成功，是否继续添加",1,$url1,$url2);
	}
	public function delCardTemplateAction(){
		$SmsModel = M('common_applet_template');
		$smsmodelid=ChkClng(KS_G('get.id'));
		$SmsModel->delete("id=$smsmodelid");
		$this->cache->PutACache('applettemplate');//存入缓存
		$url = M_URL('Setting','cardTemplate');
		ks_header($url);
	}
	public function cardBeachAction(){
		$SmsModel = M('common_applet_template');
		$statusid = $_POST["status"];
		$SmsModel->update(['status'=>0],"status=1");
		if (!empty($statusid)){
			foreach ($statusid as $k=>$v){
				$SmsModel->update(['status'=>1],"id=$v");
			}
		}
		$id     =$_POST["id"];
		$templateid=$_POST["templateid"];
		$content=$_POST["content"];
		foreach ($id as $k=>$v){
			$SmsModel->update(['templateid'=>$templateid[$k],'content'=>$content[$k]],"id=$v");
		}
		$this->cache->PutACache('applettemplate');//存入缓存
		$url=M_URL('Setting','cardTemplate');
		KS_INFO("更新成功",0,$url);
	}
	/**************************************************************微名片订阅消息 end ***************************************************/




	/**********************************************************视频服务配置 begin ***************************************************/
	/**
	 * 第三方视频管理列表
	 */
	public function livecloudmanageAction(){
		$type           = KS_S('type',1);

		$interfaceModel = M('common_managevdo');
		$values         = $interfaceModel->getAll('where type ='.$type );
		include  CURR_VIEW_PATH . "Setting/ThirdInterface/admin.cloudmanage.php";
	}
	//直播配置页面
	public function liveIndexAction(){
		$type           = null !==GF('type') ? GF('type'):'2';
		$interfaceModel = M('common_managevdo');
		$values = $interfaceModel->getAll('where type =2');
		include  CURR_VIEW_PATH . "Setting/ThirdInterface/admin.cloudmanagelive.php";
	}
	/**
	 * 进入增加接口
	 */
	public function addInterfaceAction(){
		$type           = ChkClng(KS_S('type'));
		include  CURR_VIEW_PATH . "Setting/ThirdInterface/admin.cloudInterfaceadd.php";
	}
	/**
	 * 进入直播添加
	 */
	public function addliveAction(){
		$type           = ChkClng(KS_S('type'),4);
		include  CURR_VIEW_PATH . "Setting/ThirdInterface/admin.cloudLiveadd.php";
	}
	//进行直播添加
	public function doaddliveAction(){
		$key      = ChkSQL(KS_G('post.key'));
		$keytitle = ChkSQL(KS_G('post.keytitle'));
		$Agorakey = ChkSQL(KS_G('post.Agorakey'));
		$AppCertificate    = ChkSQL(KS_G('post.AppCertificate'));
		$Data['Agora']     = $Agorakey.'〓'.$AppCertificate;
		$Data['key']       = implode('〓',$key);
		$Data['keytitle']  = implode('〓',$keytitle);
		$Data['title']     = ChkSQL(KS_G('post.title'));
		$Data['enable']    = ChkClng(KS_G('post.enable'));
		$Data['isdefault'] = ChkClng(KS_G('post.default'));
		$Data['type']      = 2;
		$interfaceModel     = M('common_managevdo');
		$interfaceModel->doAdd($Data,'id');
		$this->cache->putACache('videoservice');
		$url1=M_URL('Setting','liveIndex','',GP('type-2'));
		KS_INFO('添加成功',0,$url1);
	}
	//直播编辑
	public function editliveAction(){
		$type           = ChkClng(KS_S('type'),4);
		$id             = ChkClng(KS_G('get.id'));
		$interfaceModel = M('common_managevdo');
		$live     = $interfaceModel->getRow('where id='.$id.' limit 1');
		$key      = explode('〓',$live['key']);
		$Agora    = explode('〓',$live['Agora']);
		$keytitle = explode('〓',$live['keytitle']);
		include  CURR_VIEW_PATH . "Setting/ThirdInterface/admin.cloudLiveadd.php";
	}
	//进行编辑
	public function doeditliveAction(){
		$id =ChkClng(KS_G('get.id'));
		$key = ChkSQL(KS_G('post.key'));
		$keytitle = ChkSQL(KS_G('post.keytitle'));
		$Agorakey=ChkSQL(KS_G('post.Agorakey'));
		$AppCertificate=ChkSQL(KS_G('post.AppCertificate'));
		$Data['Agora']=$Agorakey.'〓'.$AppCertificate;
		$Data['key']=implode('〓',$key);
		$Data['keytitle']=implode('〓',$keytitle);
		$Data['title']=ChkSQL(KS_G('post.title'));
		$Data['enable'] = ChkClng(KS_G('post.enable'));
		$Data['isdefault'] = ChkClng(KS_G('post.default'));
		$Data['type'] = 2;

		$interfaceModel = M('common_managevdo');
		$interfaceModel->update($Data,'id='.$id);
		$this->cache->putACache('videoservice');
		$url1=M_URL('Setting','liveIndex','',GP('type-2'));
		KS_INFO('编辑成功',0,$url1);
	}
	/**
	 * 点播服务器增加保存
	 */
	public function doaddInterfaceAction(){
		$type=KS_S('type',1);
		$interfaceModel = M('common_managevdo');
		$Data['type'] = ChkClng($type);
		$Data['title'] = ChkSQL(KS_G('post.title'));
		$Data['pcScript'] = ChkSQL(KS_G('post.pcScript'));
		$Data['mobileScript'] = ChkSQL(KS_G('post.mobileScript'));
		$Data['appid'] = ChkSQL(KS_G('post.appid'));
		$Data['appsecret'] = ChkSQL(KS_G('post.appsecret'));
		$Data['pushflow'] = ChkSQL(KS_G('post.pushflow'));
		$Data['enable'] = ChkClng(KS_G('post.enable'));
		$Data['isdefault'] = ChkClng(KS_G('post.default'));
		$Rule['title']  = '名称|isEmpty';
		Chkpost($Data,$Rule,$interfaceModel);
		if($Data['isdefault']==1){
			$Data1['isdefault']=0;
			$interfaceModel->update($Data1,'type='.$type);
		}
		$interfaceModel->doAdd($Data,'id');
		$this->cache->putACache('videoservice');
		$url1=M_URL('Setting','livecloudmanage','',GP(''));
		KS_INFO('添加成功',0,$url1);
	}
	/**
	 * 进入编辑
	 */
	public function editInterfaceAction(){
		$type  = ChkClng(KS_S('type'));
		$id    = ChkClng(KS_G('get.id'));
		$interfaceModel = M('common_managevdo');
		$value = $interfaceModel->getRow('where id ='.$id);
		include  CURR_VIEW_PATH . "Setting/ThirdInterface/admin.cloudInterfaceadd.php";
	}
	/**
	 * 点播服务器编辑保存
	 */
	public function doeditInterfaceAction(){
		$type  = KS_S('type',1);
		$id    = ChkClng(KS_G('get.id'));
		$interfaceModel = M('common_managevdo');
		$Data['title'] = ChkSQL(KS_G('post.title'));
		$Data['pcScript'] = ChkSQL(KS_G('post.pcScript'));
		$Data['mobileScript'] = ChkSQL(KS_G('post.mobileScript'));
		$Data['appid'] = ChkSQL(KS_G('post.appid'));
		$Data['appsecret'] = ChkSQL(KS_G('post.appsecret'));
		$Data['enable'] = ChkClng(KS_G('post.enable'));
		$Data['pushflow'] = ChkSQL(KS_G('post.pushflow'));
		$Data['enable'] = ChkClng(KS_G('post.enable'));
		$Data['isdefault'] = ChkClng(KS_G('post.default'));
		$Rule['title']  = '名称|isEmpty';
		Chkpost($Data,$Rule,$interfaceModel);
		if($Data['isdefault']==1){
			$Data1['isdefault'] = 0;
			$interfaceModel->update($Data1,'type='.$type);
		}
		$interfaceModel->update($Data,'id='.$id);
		$this->cache->putACache('videoservice');
		$url1=M_URL('Setting','livecloudmanage','',GP('type-'.$type));
		KS_INFO('',0,$url1);
	}
	/**
	 * 进行删除
	 */
	public function delInterfaceAction(){
		$id =ChkClng(KS_G('get.id'));
		$interfaceModel = M('common_managevdo');
		$value = $interfaceModel -> getRow(' where id ='.$id);
		$url1=M_URL('Setting','livecloudmanage','',GP(''));
		if($value['isdefault'] == 1){
			KS_INFO('默认不能删除',0,$url1);
		}
		$interfaceModel->delete("id = $id");
		$this->cache->putACache('videoservice');
		ks_header($url1);
	}
	/**
	 * 房间列表
	 */
	public function liveChannelListAction()
	{
		$managevdoid=KS_G('service');
		$realModel = M('app_course_channel');
		$where     = "where live_service='$managevdoid'";
		$options   = $realModel->getOptions('10',$where);//分页参数设置
		$page      = Page($options);
		$values    = $realModel->getPage($page,'adddate desc',$where);
		include  CURR_VIEW_PATH . "Setting/ThirdInterface/admin.liveChannelList.php";
	}
	/**
	 * 删除房间
	 */
	public function liveChannelDelAction()
	{
		$id=KS_S('id');
		$managevdoid=KS_G('service');
		$realModel = M('app_course_channel');
		$channel = $realModel->getRow("where id=$id");
		if ($channel['status']==1){
			KS_INFO('该房间正在直播中不可删除');
		}
		$res = $realModel->delete("id=$id");
		$url =  '/admin.html/default/Setting/liveChannelList?service='.$managevdoid;
		if ($res){
			$model = new \Kesion\Model\App\LiveModel();
			$model->delChannel($channel['channelid']);
			KS_INFO('删除成功',3,$url);
		}else{
			KS_INFO('删除失败');
		}

	}
	/**
	 * 批量修改
	 */
	public function batchAction(){
		$type=KS_S('type',1);
		$interfaceModel = M('common_managevdo');
		$default = ChkClng(KS_G('post.default'));
		$enable = ChkSQL(KS_G('post.enable'));
		if(!empty($enable)){
			$enable = implode(',',$enable);
			$Data3['enable'] = 0;
			$interfaceModel->update($Data3,'type='.$type);
			$Data4['enable'] = 1;
			$interfaceModel->update($Data4,"id in ($enable)");
		}
		$id    = ChkSQL_Array(KS_G('post.id'));
		$title = ChkSQL_Array(KS_G('post.title'));
		$price = ChkSQL_Array(KS_G('post.price'));
		$Data1['isdefault']=0;
		$interfaceModel->update($Data1,'type='.$type);
		$Data2['isdefault']=1;
		$interfaceModel->update($Data2,'id='.$default);
		foreach($id as $k=>$v){
			$Data['title'] = $title[$k];
			$Data['price'] = $price[$k];
			$Rule['title']  = '名称|isEmpty';
			Chkpost($Data,$Rule,$interfaceModel);
			$interfaceModel->update($Data,'id = '.$v);
		}
		$this->cache->putACache('videoservice');
		if ($type==1){
			$url1=M_URL('Setting','livecloudmanage','',GP("type-$type"));
		}else{
			$url1=M_URL('Setting','liveIndex','',GP("type-$type"));
		}
		KS_INFO('更新成功',0,$url1);
	}
	public function liveViewAction(){
		include  CURR_VIEW_PATH . "Setting/ThirdInterface/admin.playview.php";
	}
	/**********************************************************视频服务配置 end ***************************************************/

	/**********************************************************直播互动工具 begin ***************************************************/
	public function LiveToolsAction(){
		$LiveTool =M('app_livetool');
		$list =$LiveTool->getAll();

		include  CURR_VIEW_PATH . "Setting/LiveTools/admin.index.php";
	}

	public function addToolAction(){

		include  CURR_VIEW_PATH . "Setting/LiveTools/admin.livetools_add.php";
	}

	public function doAddAction(){

		$LiveTool =M('app_livetool');

		$Data['title'] = ChkSQL(KS_G('post.title'));
		$Data['pic'] = ChkSQL(KS_G('post.ico'));
		$Data['isenable'] = ChkClng(KS_G('post.isenable'));

		$LiveTool->doAdd($Data,'id');

		$url1=M_URL('Setting','LiveTools','',GP(''));

		KS_INFO('添加成功',0,$url1);

	}

	//删除

	public function delAction(){
		$LiveTool =M('app_livetool');

		$id = ChkClng(KS_G('get.id'));

		$LiveTool->delete('id='.$id);
		$url1=M_URL('Setting','LiveTools','',GP(''));

		KS_INFO('删除成功',0,$url1);
	}
	//编辑

	public function editAction(){
		$LiveTool =M('app_livetool');
		$id = ChkClng(KS_G('get.id'));
		$values=$LiveTool->getRow('where  id='.$id.' limit 1 ');
		include  CURR_VIEW_PATH . "Setting/LiveTools/admin.livetools_add.php";

	}

	//进行编辑

	public function doeditAction(){

		$LiveTool =M('app_livetool');
		$id = ChkClng(KS_G('get.id'));
		$Data['title'] = ChkSQL(KS_G('post.title'));
		$Data['pic'] = ChkSQL(KS_G('post.ico'));
		$Data['isenable'] = ChkClng(KS_G('post.isenable'));

		$LiveTool->update($Data,'id='.$id);

		$url1=M_URL('Setting','LiveTools','',GP(''));

		KS_INFO('编辑成功',0,$url1);

	}
	/**********************************************************直播互动工具 end ***************************************************/






























	//直播配置
	public function liveSettingAction(){
		$Mode = M('common_live_setting');
		$values = $Mode->getRow('where wxid = 0');
		$Modes = M('app_carousel');
		$imgs = $Modes->getAll('where wxid = 0','img');
		$str = '';
		if(!empty($imgs)){
			foreach($imgs as $k=>$v){
				$imgs[$k]['img'] = Img($v['img']);
				if($k+1 == count($imgs)){
					$str .=$imgs[$k]['img'];
				}else{
					$str .=$imgs[$k]['img'].',';
				}

			}
		}else{
			$str = '';
		}
		include  CURR_VIEW_PATH . "Setting/liveSetting.php";
	}
	public function doliveSettingAction(){
		$Data['version'] = KS_G('post.version');
		$Data['domain'] = KS_G('post.domain');
		$Data['addr'] = KS_G('post.addr');
		$Data['logo'] = KS_G('post.defaultpic');
		$Data['wxid'] = 0;
//		var_dump($_POST);exit;
		$Mode = M('common_live_setting');
		$id=$Mode->getOne('id','where wxid=0');
		if($id){
			$Mode->update($Data,'id='.$id);
		}else{
			$Mode->doAdd($Data,'id');
		}
		$Modes = M('app_carousel');
		$Modes->delete('wxid=0');
		$img = KS_G('post.tempsrc');
		$imgs=explode(',',$img);
		$Datas['wxid']=0;
		$Datas['type']=1;

		foreach($imgs as $k=>$v){
			$Datas['img']=$v;
			$Modes->doAdd($Datas,'id');
		}
//		exit;
		KS_INFO('更新完成',3,M_URL('home/Setting','liveSetting','',GP('')));

	}
	  public function padsettingAction(){
	  	$Mode = M('app_edition');
	  	$res  = $Mode->getRow('where 1=1 order by adddate desc limit 1');
    	include  CURR_VIEW_PATH . "Setting/padSetting.php";
    }

    public function saveEditionAction(){
    	$Mode = M('app_edition');
    	$id=ChkClng(GF('id'));
    	$Data['edition'] = KS_G('post.version');
    	$Data['downurl'] = KS_G('post.domain');
    	$Data['adddate'] = time();
//  	var_dump($Data);exit;
    	$Mode->doAdd($Data,'id');
    	KS_INFO('更新完成',3,M_URL('Setting','padsetting','',GP('')));
    }

   //直播分辨率配置
   public function resolutionAction(){
   	$resoluteModel=M('common_resolution');
   	$value=$resoluteModel->getAll(' where type =1');
   	$values=$resoluteModel->getAll(' where type =2');
   	include  CURR_VIEW_PATH . "Setting/resolution.php";
   }
   //添加直播分辨率
   public function addresolutionAction(){

   	include  CURR_VIEW_PATH . "Setting/addresolution.php";

   }
   //添加分辨率
   public function doaddresolutionAction(){
   	   $Data['type'] = ChkClng(KS_G('post.type'));
   	   $Data['title'] = ChkSQL(KS_G('post.title'));
   	   $Data['blackboard'] = ChkSQL(KS_G('post.blackboard'));
   	   $Data['blackboardid'] = ChkClng(KS_G('post.blackboardid'));
   	   $Data['teacherhead'] = ChkSQL(KS_G('post.teacherhead'));
   	   $Data['teacherheadid'] = ChkClng(KS_G('post.teacherheadid'));
   	   $Data['studenthead'] = ChkSQL(KS_G('post.studenthead'));
   	   $Data['studentheadid'] = ChkClng(KS_G('post.studentheadid'));
   	   $Data['isenable'] = ChkClng(KS_G('post.isenable'));
   	   $Data['price'] = ChkClng(KS_G('post.price'));
   	    $Data['num'] = ChkClng(KS_G('post.num'));
   	   $resoluteModel=M('common_resolution');
   	   $Rule['title']    = '名称|isEmpty';
	   Chkpost($Data,$Rule,$resoluteModel);
   	   $resoluteModel->doAdd($Data,'id');
   	   KS_INFO('添加完成',3,M_URL('Setting','resolution','',GP('')));
   }
   //进入编辑
    public function editresolutionAction(){
    $id=	ChkClng(KS_G('get.id'));
   	$resoluteModel=M('common_resolution');
   	$value=$resoluteModel->getRow(' where  id='.$id.' limit 1');

   	include  CURR_VIEW_PATH . "Setting/addresolution.php";
   }
   //进行编辑
   public function doeditresolutionAction(){
   	   $id=	ChkClng(KS_G('get.id'));
   	   $Data['type'] = ChkClng(KS_G('post.type'));
   	   $Data['title'] = ChkSQL(KS_G('post.title'));
   	   $Data['blackboard'] = ChkSQL(KS_G('post.blackboard'));
   	   $Data['blackboardid'] = ChkClng(KS_G('post.blackboardid'));
   	   $Data['teacherhead'] = ChkSQL(KS_G('post.teacherhead'));
   	   $Data['teacherheadid'] = ChkClng(KS_G('post.teacherheadid'));
   	   $Data['studenthead'] = ChkSQL(KS_G('post.studenthead'));
   	   $Data['studentheadid'] = ChkClng(KS_G('post.studentheadid'));
   	   $Data['isenable'] = ChkClng(KS_G('post.isenable'));
   	   $Data['num'] = ChkClng(KS_G('post.num'));
   	   $Data['price'] = ChkSQL(KS_G('post.price'));

   	   $resoluteModel=M('common_resolution');
   	   $Rule['title']    = '名称|isEmpty';
	   Chkpost($Data,$Rule,$resoluteModel);
   	   $resoluteModel->update($Data,'id='.$id);
   	   KS_INFO('编辑成功',3,M_URL('Setting','resolution','',GP('')));
   }

   //直播秘钥
   public function SecretkeyAction(){
   	  $model=M('app_live_secret');
	  $values=$model->getAll('');
	  $websiteModel=M('common_user_website');
	  foreach($values as $k=>$v){
	  	$values[$k]['sitename'] = $websiteModel->getOne('sitename','where wxid='.$v['wxid'].' limit 1');
	  }
      include  CURR_VIEW_PATH . "Setting/SecretkeyIndex.php";
   }
   //更改状态
   public function isSecretkeyAction(){
        $type = ChkClng(KS_G('post.type'));
        $wxid = ChkClng(KS_G('post.wxid'));
        if($type==1){
        	 $Data['isenable']=1;
        }else{
        	$Data['isenable']=0;
        }

        $model=M('app_live_secret');
        $model->update($Data,'wxid='.$wxid);
        echo 'success';
   }
   //任务列表
   public function tasksAction(){
   		$Db = M('app_tasks');
   		$where = '';
   		$options = $Db->getOptions('10',$where);//分页参数设置
		$page = Page($options);
		$values = $Db->getPage($page,'',$where);
   		include  CURR_VIEW_PATH . "Setting/tasks_list.php";
   }
   //添加任务
   public function addtasksAction(){
   		include  CURR_VIEW_PATH . "Setting/addtasks.php";
   }
   //修改任务
   public function edittaskAction(){
   		$Db = M('app_tasks');
   		$id = KS_G('get.id');
   		$values = $Db->getRow('where id='.$id);
   		include  CURR_VIEW_PATH . "Setting/addtasks.php";
   }
   //do
   public function doaddtaskAction(){
   		$title = KS_G('post.title');
   		$num   = KS_G('post.num');
   		$money = KS_G('post.money');
   		$quantity = KS_G('post.quantity');
   		$url      = KS_G('post.url');
   		$type     = KS_G('post.type');
   		if (empty($title)) {
   			KS_INFO('标题不能为空');
   		}
   		if (empty($num)) {
   			KS_INFO('每日数量不能为空');
   		}
   		if (empty($money)) {
   			KS_INFO('奖励不能为空');
   		}
   		if (empty($quantity)) {
   			KS_INFO('进度最少为1');
   		}
   		$Db = M('app_tasks');
   		$Data['title'] = $title;
   		$Data['num'] = $num;
   		$Data['money'] = $money;
   		$Data['quantity'] = $quantity;
   		$Data['url'] = $url;
   		$Data['type'] = $type;
   		$Db->doAdd($Data,'id');
   		$url1 = M_URL('Setting','tasks');
   		KS_INFO('任务添加完成',3,$url1);
   }
   public function doedittaskAction(){
   		$id = KS_G('get.id');
   		$title = KS_G('post.title');
   		$num   = KS_G('post.num');
   		$money = KS_G('post.money');
   		$quantity = KS_G('post.quantity');
   		$url      = KS_G('post.url');
   		$type     = KS_G('post.type');
   		if (empty($title)) {
   			KS_INFO('标题不能为空');
   		}
   		if (empty($num)) {
   			KS_INFO('每日数量不能为空');
   		}
   		if (empty($money)) {
   			KS_INFO('奖励不能为空');
   		}
   		if (empty($quantity)) {
   			KS_INFO('进度最少为1');
   		}
   		$Db = M('app_tasks');
   		$Data['title'] = $title;
   		$Data['num'] = $num;
   		$Data['money'] = $money;
   		$Data['quantity'] = $quantity;
   		$Data['url'] = $url;
   		$Data['type'] = $type;
   		$Db->update($Data,'id='.$id);
   		$url1 = M_URL('Setting','tasks');
   		KS_INFO('任务修改完成',3,$url1);
   }
   public function deltaskAction(){
		$Db = M('app_tasks');
   		$id = KS_G('get.id');
   		$Data['status']=0;
   		$values = $Db->update($Data,'id='.$id);
   		$url1 = M_URL('Setting','tasks');
   		KS_INFO('关闭完成',3,$url1);
   }
   public function opentaskAction(){
		$Db = M('app_tasks');
   		$id = KS_G('get.id');
   		$Data['status']=1;
   		$values = $Db->update($Data,'id='.$id);
   		$url1 = M_URL('Setting','tasks');
   		KS_INFO('开启完成',3,$url1);
   }
   public function kfwecahtAction(){
	    $Db = M('common_kf');
	    $res = $Db->getRow();
	    include  CURR_VIEW_PATH . "Setting/kfwecaht.php";
   }
   public function savekfAction(){
	    $Db = M('common_kf');
	    $res = $Db->getRow();
	    $Data['wechat'] = KS_G('post.wechat');
	    if($res){
	      $Db->update($Data,'id='.$res['id']);
	    }else{
	      $Db->doAdd($Data,'id');
	    }
	    $url1 = M_URL('Setting','kfwecaht');
	    KS_INFO('设置完成',3,$url1);
   }
   //海报
   public function posterAction(){
   	    $adddate=null !==GF('adddate') ? GF('adddate'):1;
     	if($adddate == 1){
			$byname  = 'posterid desc';
		}else{
			$byname  = 'posterid ASC';
		}
		$where='';
		$keyword = ChkSQL(KS_S('keyword'));
		$keytype = ChkClng(KS_S('keytype',1));
		if(!empty($keyword)){
			if($keytype==1){$where.=" where username like '%$keyword%'";}
		}
		$adminModel = M('common_poster');
		$options    = $adminModel->getOptions('8',$where);
		$page       = Page($options);
		$pageadmins = $adminModel->getPage($page,$byname,$where);
   	    include  CURR_VIEW_PATH . "Setting/poster.php";
   }
   /**
     * 进入添加海报
     */
   public function addPosterAction(){
        include  CURR_VIEW_PATH . "Setting/addPoster.php";
   }
    //保存添加海报
   public function doaddPosterAction(){
		$Data['realname']     = ChkSQL(KS_G('post.realname'));
		if(!empty(ChkSQL(KS_G('post.defaultpic')))){
			$Data['defaultpic']     = ChkSQL(KS_G('post.defaultpic'));
		}
		/*if(!empty($_FILES['file']['tmp_name'])){
			$this->upload->savePath = 'images/'; // 设置附件上传（子）目录
			$info = $this->upload->uploadOne($_FILES['file']);
			if(!$info) {KS_INFO($this->upload->getError(),0,'','',1);}//上传错误提示错误信息
			else{
				$Data['defaultpic'] = ChkSQL($this->upload->uootPath.$info['savepath'].$info['savename']);//应用封面图片
			}
		}*/
		//确认修改判断规则，详见ks_cls文件夹中的kesion.chkpost
		$adminModel = M('common_poster');
		$adminModel->doAdd($Data,'posterid');
		KS_INFO('添加成功',0,M_URL('Setting','poster'));
    }
	/**
     * 进入编辑海报
     */
	public function editPosterAction(){
		$posterid    = ChkClng(KS_G('request.id'));
		$now_page   = ChkClng(KS_S('p'));
		$adminModel = M('common_poster');
		$admin = $adminModel->getRow("where posterid=$posterid limit 1");
        include  CURR_VIEW_PATH . "Setting/addPoster.php";
    }
	/**
     * 保存编辑海报
	 */
	public function doeditPosterAction(){
		$posterid           = ChkClng(KS_G('request.id'));
		$now_page           = ChkClng(KS_S('p'));
		$Data['realname']   = ChkSQL(KS_G('post.realname'));
		if(!empty(ChkSQL(KS_G('post.defaultpic')))){
			$Data['defaultpic']     = ChkSQL(KS_G('post.defaultpic'));
		}
		$adminModel = M('common_poster');
		$admininfo = $adminModel->getRow("where posterid=$posterid limit 1");
		$result = $adminModel->update($Data,"posterid=$posterid");
		$url    =  M_URL('Setting','poster','',GP('p-'.$now_page));
		KS_INFO('修改成功',0,$url);
    }
    //删除海报操作
	public function deletePosterAction(){
		$posterid   = ChkClng(KS_G('request.id'));
		$now_page   = ChkClng(KS_S('p'));
		$adminModel = M('common_poster');
		$result     = $adminModel->delete("posterid=$posterid");
		$url        = M_URL('Setting','poster','',GP('p-'.$now_page));
		ks_header($url);
    }
    //海报设置成默认
	public function defaultPosterAction(){
		$posterid   	= ChkClng(KS_G('request.id'));
		$now_page   	= ChkClng(KS_S('p'));
		$adminModel 	= M('common_poster');
        $Data['isdel']  = 0;
		$adminModel->update($Data,'isdel=1');
		$Data['isdel']  = 1;
		$adminModel->update($Data,"posterid=$posterid");
		$url        = M_URL('Setting','poster','',GP('p-'.$now_page));
		ks_header($url);
    }
    //批量
	public function batchPosterAction(){
		$id       = ChkSQL(KS_G('post.check'));
		$now_page = ChkClng(KS_S('p'));
		$url      = M_URL('Setting','','',GP('p-'.$now_page));
		$adminModel=M('common_poster');
		if(empty($id)){KS_INFO('请选择一个账号后再进行删除',0,$url,'',1);}
		foreach($id as $k=>$v){$adminModel->delete("posterid=$v");}
		KS_INFO('删除成功',0,$url);
	}
	//进入编辑海报拖拽页
	public function setPosterAction(){
		$posterid   = ChkClng(KS_G('request.id'));
		$now_page   = ChkClng(KS_S('p'));
		$adminModel = M('common_poster');
		$admin = $adminModel->getRow("where posterid=$posterid limit 1");
        include  CURR_VIEW_PATH . "Setting/setPoster.php";
    }
	//进入编辑海报拖拽页
	public function dosetPosterAction(){
		var_dump($_REQUEST);exit;
	 	$posterid           = ChkClng(KS_G('request.id'));
		$now_page           = ChkClng(KS_S('p'));
		$Data['realname']   = ChkSQL(KS_G('post.realname'));
		if(!empty(ChkSQL(KS_G('post.defaultpic')))){
			$Data['defaultpic']     = ChkSQL(KS_G('post.defaultpic'));
		}
		$adminModel = M('common_poster');
		$admininfo = $adminModel->getRow("where posterid=$posterid limit 1");
		$result = $adminModel->update($Data,"posterid=$posterid");
		$url    =  M_URL('Setting','poster','',GP('p-'.$now_page));
		KS_INFO('修改成功',0,$url);
    }


}