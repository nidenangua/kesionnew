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
class AppController extends CommonController
{
	/*------------------------------------云服务表 查增改删-----------------------------------------------*/
    /**
     * 进入云服务列表页
     */
    public function indexAction(){
		//选项卡
		$option   =  KS_S('option',5);
		if($option==1){$where = 'where issys=0';}
		elseif($option==2){$where = 'where issys=1';}
		elseif($option==3){$where = 'where MustChoose=1';}
		elseif($option==4){$where = 'where isweb=1';}
		elseif($option==5){$where = 'where 1=1';}
		//审核
		$status = null !==GF('status') ? GF('status'):'2';
		if($status==0){$where .= ' and status=0';}
		elseif($status==1){$where .= ' and status=1';}
		elseif($status==2){$where .= ' and (status=0 or status=1)';}
		//是否收费
		$isprice  = KS_S('isprice',2);
		if($isprice==0){$where .= ' and isprice=0';}
		elseif($isprice==1){$where .= ' and isprice=1';}

		//搜索
		$keyword=KS_S('keyword');
		$keytype=KS_S('keytype',1);
		if(!empty($keyword)){
			 if($keytype==1){$where.=" and appname like '%$keyword%'";}
			 elseif($keytype==2){$where.=" and author like '%$keyword%'";}
		}
		//分类
		$categoryid= ChkClng(KS_S('categoryid'));
		if($categoryid!=0){$where .= " and (b.parentidpath like '%$categoryid,%' or b.categoryid=$categoryid)";}
		//升序和降序
		$by = null !==GF('by') ? GF('by'):'0';
		if($by==0){$order = 'desc';}else{$order = 'asc';}//排序
		$orderby=null !==GF('orderby') ? GF('orderby'):'0';
		if($orderby==0){
		     $byname = 'appid '.$order;
		}elseif($orderby==1){
		     $byname = 'installs '.$order;
		}elseif($orderby==2){
		     $byname = 'appid '.$order;
		}elseif($orderby==3){
		     $byname = 'hits '.$order;
		}
		$appcategory    = $this->cache->getACache('appcategory');//取出缓存
		$appModel       = new AppModel('common_app');//实例化云服务表
		$app_categoryid = new AppModel('common_app_categoryid');
		$where    = "as a left join `$app_categoryid->table` as b on a.categoryid = b.categoryid $where";
		$options  = $appModel->getOptions('6',$where);//分页参数设置
		$page     = Page($options);
		$pageapps = $appModel->getPage($page,$byname,$where,'b.*,a.*');
	    include  CURR_VIEW_PATH . "App/admin.appList.php";
    }
	/**
     * 进入添加应用
	 */
	public function appManageAction(){
        $appid    =  ChkClng(KS_G('id'));//表ID
		$now_page =  ChkClng(KS_S('p',1));

        if ($appid>0){  //编辑
            $app = $this->cache->GetA('appinfo','appid',$appid,'',true);//获得单个云服务
        }

        $Linkage  = Linkage(array());
		$Linkage->cachename  = 'appcategory';
		$Linkage->inputname = 'categoryid';
        if ($app){
            $Linkage->categoryid = $app['categoryid'];
        }

		//H5营销工具
		$db=M('app_h5_market');
		$where = ' where del=1';
		$h5Values=$db->getAll($where,'id,h5name');
        include  CURR_VIEW_PATH . "App/admin.appManage.php";
    }
	/**
     * 添加云服务保存
	 */
	public function appManageDoSaveAction(){
        $appid    = ChkClng(KS_G('request.id')); //表ID
        $nowpage = ChkClng(KS_S('p',1));
		$Data['appname']    = ChkSQL(KS_G('post.appname'));//应用名称
		$Data['appename']   = ChkSQL(KS_G('post.appename'));//英文名称
		$Data['issys']      = ChkSQL(KS_G('post.issys'));//是否内置
		$Data['shortcut']   = ChkSQL(KS_G('post.shortcut'));//是否快捷
		$Data['isrec']      = ChkSQL(KS_G('post.isrec'));//是否推荐
		$Data['MustChoose'] = ChkSQL(KS_G('post.MustChoose'));//是否用户必选
		$Data['isoffc']     = ChkSQL(KS_G('post.isoffc'));//是否官方
		$Data['isweb']      = ChkClng(KS_G('post.isweb'));//网站应用or机构应用
		$Data['categoryid'] = ChkSQL(KS_G('post.categoryid'));//应用分类ID
		$Data['apptype']    = ChkSQL(KS_G('post.apptype'));//应用适用范围
		$Data['isprice']    = ChkSQL(KS_G('post.isprice'));//应用售价
		if($Data['isprice'] == 1){
		    $Data['price'] = ChkSQL(KS_G('post.price'));//应用售价
		    $Data['appchargetype'] = ChkClng(KS_G('post.appchargetype'));//应用周期
		}

        $allowversion = KS_G('post.allowversion');
        $allowversionvalue=implode(',',$allowversion);

        $Data['allowversion']= $allowversionvalue; //允许使用的版本套餐
		$Data['istable']    = ChkSQL(KS_G('post.istable'));//应用售价
		$Data['proname']    = ChkSQL(KS_G('post.proname'));//项目名称
		$Data['fonts']      = ChkSQL(KS_G('post.fonts'));//项目图标
		$Data['unti']       = ChkSQL(KS_G('post.unti'));//项目单位
		$Data['power']      = preg_replace('/( |　|\s)*/','',ChkSQL(KS_G('post.power')));//应用权限
		$Data['shortdesc']  = preg_replace('/( |　|\s)*/','',ChkSQL(KS_G('post.shortdesc')));//简短描述
		$Data['intro']      = ChkSQL(KS_G('post.intro'));//介绍
		$Data['author']     = ChkSQL(KS_G('post.author'));//作者
		$Data['adddate']    = ChkClng(time());//应用上架时间
		if(!empty($_FILES['file']['tmp_name'])){
			$this->upload->savePath = 'images/'; // 设置附件上传（子）目录
			$info = $this->upload->uploadOne($_FILES['file']);
			if(!$info) {KS_INFO($this->upload->getError(),0,'','',1);}//上传错误提示错误信息
			else{
				$Data['defaultpic'] = ChkSQL($this->upload->ruootPath.$info['savepath'].$info['savename']);//应用封面图片
			}
		}
		$appModel = new AppModel('common_app');//实例化云服务表
		$Rule['appname']     = '应用名称|isEmpty,isDbexis';
		$Rule['appename']    = '应用英文名称|isEmpty,isDbexis';

        $url = M_URL('App','Index','',GP('p-'.$nowpage));
        if ($appid<=0){
            $Data['basictype']  = ChkSQL(KS_G('post.basictype'));//基类型
            $Data['tableename'] = ChkSQL(KS_G('post.tableename'));//表名称
            $Rule['defaultpic']  = '应用封面图片|isEmpty';
            Chkpost($Data,$Rule,$appModel);
            $appid = $appModel->doAddapp($Data,'appid');//添加云服务//对云服务表进行增加操作
            $this->cache->PutACache('appinfo'); //把app信息存入缓存
            if($Data['isprice'] == 1){
                if ($appid<=0){    //添加的情况
                    $fieldgroupModel = new AppModel('common_table_fieldgroup');
                    $DataG['groupname'] = '基本信息';//表ID
                    $DataG['orderid'] = '1';
                    $DataG['appid'] = $appid;
                    $groupid = $fieldgroupModel->doAdd($DataG,"groupid");
                    if($Data['issys'] == 0){
                        $appModel->doCreateTable($Data['tableename'],$appid,$groupid,$Data['isweb']);//在数据库中实现
                    }
                }
            }
            KS_INFO('添加成功',0,$url);

        }else{
            Chkpost($Data,$Rule,$appModel,"appid!=$appid");
            $appModel->update($Data,"appid=$appid");//修改操作
            $this->cache->PutACache('appinfo'); //把app信息存入缓存
            KS_INFO('修改成功',0,$url);

        }



    }

	/**
     * 删除云服务操作
	 */
	public function deleteAppAction(){
		$appid      = ChkClng(KS_G('request.id'));//表ID
		$now_page   = ChkClng(KS_S('p',1));
		$appModel   = new AppModel('common_app');//实例化云服务表
		$fieldModel = new AppModel('common_table_field');
		$app        = $appModel->getRow("where appid=$appid limit 1");
		//是否是内置表，内置不能删表，不是内置要删表
		if($app['issys'] == 0){
		   $appModel->dropTable($app['tableename'],$app['isweb']);
		}else{
		   $fieldname = $fieldModel->getAll("where appid='$appid'",'fieldname');
		   $fieldModel->dropAllField($app['tableename'],$fieldname);
		}
		$fieldModel->delete("appid=$appid");
	    $appModel  ->delete("appid=$appid");
	    $fieldgroupModel = new AppModel('common_table_fieldgroup');
		$fieldgroupModel->delete("appid='$appid'");

        //$this->upload->removefile($app['defaultpic']);
	    $this->cache->PutACache('appinfo'); //把app信息存入缓存
	    $url = M_URL('App','','',GP('p-'.$now_page));
	    ks_header($url);
    }

	public function FieldAction(){
		$groupid= null !==GF('groupid') ? GF('groupid'):'';//分组id
		$appid  = ChkClng(KS_G('request.id'));//表ID
		$fieldgroupModel = new AppModel('common_table_fieldgroup');
		if(empty($groupid)){
			 $groupid = $fieldgroupModel->getOne('groupid',"where appid='$appid' and issys=0 limit 1");
			 if(empty($groupid)){$where ="where appid = $appid";}
			 else{$where ="where appid = $appid and groupid = $groupid";}
		}else{
			 if(empty($groupid)){$where ="where appid = $appid";}
			 else{$where ="where appid = $appid and groupid = $groupid";}
		}
		$now_page =  ChkClng(KS_S('p',1));
		$fieldModel = new AppModel('common_table_field');
		$options = $fieldModel->getOptions('25',$where);
		$page = Page($options);
		$pagefields = $fieldModel->getPage($page,'orderid', $where);
		$appModel = new AppModel('common_app');
		$app = $appModel->getRow("where appid=$appid limit 1",'appname,tableename,isweb');
		$fieldgroup = $fieldgroupModel->getAll("where appid='$appid' order by orderid asc");
	    include  CURR_VIEW_PATH . "App/appfield_list.php";
    }
	//为自定义字段进行排序
	public function fieldOrderAction(){
		$appid      = ChkClng(KS_G('request.id'));//表ID
		$groupid    = null !==GF('groupid') ? GF('groupid'):'';//分组id
		$orderarr   = ChkSQL(KS_G('request.orderarr'));//表ID
		$fieldModel = new AppModel('common_table_field');
		$values = $fieldModel->getAll("where appid = $appid and groupid = $groupid order by orderid asc");
		foreach($values as $k=>$v){
			$Data['orderid'] = ChkClng($orderarr[$k]);
			$fieldModel->update($Data,"appid=$appid and groupid=$groupid and fieldid=$v[fieldid]");
		}
		$url = M_URL('App','Field',$appid,GP('groupid-'.$groupid));
		KS_INFO('修改排序成功',0,$url);

    }
    //进入添加字段页
	public function addFieldAction(){
		$appid    = ChkClng(KS_G('request.id'));//表ID
		$appModel = new AppModel('common_app');
		$app = $appModel->getRow("where appid=$appid limit 1",'appname,tableename,isweb');
		$fieldgroupModel = new AppModel('common_table_fieldgroup');
		$fieldgroup = $fieldgroupModel->getAll("where appid='$appid' order by orderid asc");
		$groupid = $fieldgroupModel->getOne('groupid',"where appid='$appid' and issys=0 limit 1");
		if(empty($groupid)){
		   $where ="where appid=$appid and isentry=1 and status=1 and showtitle!='' order by orderid";
		}else{
		   $where ="where appid=$appid and isentry=1 and status=1 and groupid = $groupid and showtitle!='' order by orderid";
		}
		$fieldModel = new AppModel('common_table_field');//实例化字段表
		$smallgroup = $fieldModel->getAll($where);
        include  CURR_VIEW_PATH . "App/appfield_add.php";
    }
	//添加字段操作
	public function doaddFieldAction(){
		$Data['appid']     = ChkClng(KS_G('request.id'));//模型id
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
		$appModel = new AppModel('common_app');
		$app = $appModel->getRow("where appid=$Data[appid] limit 1",'appname,tableename,isweb');
		$fieldModel = new AppModel('common_table_field');
		$Data['orderid'] = $fieldModel->getMaxValue('orderid',"appid='$Data[appid]'")+1;//排序
		//确认修改判断规则，详见ks_cls文件夹中的kesion.chkpost
		$Rule['title']      = '字段别称|isEmpty';
		$Rule['fieldname']  = '字段名称|isEmpty,isEnglish';
		$Rule['fieldtype']  = '字段类型|isEmpty,isNumber';
		Chkpost($Data,$Rule,$fieldModel);
		//在数据库中实现
		$fieldModel->doCreateField($app['tableename'],$Data);
		//对字段表进行增加操作
		$result = $fieldModel->doAdd($Data,'fieldid');
		$url = M_URL('App','Field',$Data['appid'],GP('groupid-'.$Data['groupid']));
		KS_INFO('添加成功',0,$url);
    }
    //进入编辑字段页
	public function editFieldAction(){
		$fieldid  = ChkClng(KS_G('request.id'));//字段ID
		$now_page =  ChkClng(KS_S('p',1));
		$appid=null !==GF('appid') ? GF('appid'):'';
		$fieldModel = new AppModel('common_table_field');
		$field = $fieldModel->getRow("where fieldid=$fieldid limit 1");//获得单个字段
		$appModel = new AppModel('common_app');
		$app = $appModel->getRow("where appid=$appid limit 1",'appname,tableename,isweb');
		$fieldgroupModel = new AppModel('common_table_fieldgroup');
		$fieldgroup = $fieldgroupModel->getAll("where appid='$appid' order by orderid asc");
		$smallgroup = $fieldModel->getAll("where appid=$appid and isentry=1 and status=1 and groupid=$field[groupid] and fieldid!=$fieldid and showtitle!='' order by orderid");
        include  CURR_VIEW_PATH . "App/appfield_add.php";
    }
	//编辑字段操作
	public function doeditFieldAction(){
		$now_page =  ChkClng(KS_S('p',1));
		$fieldid  =  ChkClng(KS_G('request.id'));//字段ID
		$appid    =  null !==GF('appid') ? GF('appid'):'2';
		$Data['groupid']   = ChkClng(KS_G('post.groupid'));
		$Data['title']     = ChkSQL(KS_G('post.title'));
		$Data['fieldname'] = ChkSQL(KS_G('post.fieldname'));
		$Data['prompt']    = ChkSQL(KS_G('post.prompt'));
		$Data['defaultval']= ChkSQL(KS_G('post.defaultval'));
		$Data['width']     = ChkSQL(KS_G('post.width'));
		$Data['height']    = ChkSQL(KS_G('post.height'));
		$Data['isentry']   = ChkSQL(KS_G('post.isentry'));
		$Data['mustinput'] = ChkSQL(KS_G('post.mustinput'));
		$Data['manageitem']= ChkSQL(KS_G('post.manageitem'));
		$Data['showtitle'] = ChkSQL(KS_G('post.showtitle'));
		if($Data['showtitle']!==''){
			$Data['isshow']  = 0;
		}else{
			$Data['isshow']  = ChkSQL(KS_G('post.isshow'));
	    }
		$Data['status'] = ChkSQL(KS_G('post.status'));
		$fieldModel = new AppModel('common_table_field');//实例化字段表
		//在数据库中实现
		//$fieldModel->editField($tablename,$Data,$fieldid,'fieldid');
		//对字段表进行修改操作
		$fieldModel->update($Data,"fieldid=$fieldid");//编辑字段
		$url = M_URL('App','Field',$appid,GP('groupid-'.$Data['groupid'].',p-'.$now_page));
		KS_INFO('修改成功',0,$url);
    }
	//删除字段操作
	public function deleteFieldAction(){
		$appid=null !==GF('appid') ? GF('appid'):'';
		$now_page =  ChkClng(KS_S('p',1));
		$fieldid  = ChkClng(KS_G('request.id'));//字段ID
		$appModel = new AppModel('common_app');//实例化模型表
		$app = $appModel->getRow("where appid=$appid limit 1",'appname,tableename,isweb');
		$fieldModel = new AppModel('common_table_field');//实例化字段表
		$field = $fieldModel->getRow("where fieldid=$fieldid limit 1");
		$fieldModel->dropField($app['tableename'],$field['fieldname']);//在数据库中实现
		$fieldModel->delete("fieldid=$fieldid");//删除字段//对字段表进行删除操作
		$GLOBALS['db']->execSql("UPDATE `$fieldModel->table` SET `orderid`=orderid-1 WHERE orderid>$field[orderid] and appid=$appid");
		$url = M_URL('App','Field',$appid,GP('p-'.$now_page));
		ks_header($url);
    }
	public function PreviewAction(){
		$appid=null !==GF('appid') ? GF('appid'):'0';
	    include  CURR_VIEW_PATH . "App/appfield_preview.php";
    }
	public function fieldGroupAction(){
		$appid    = ChkClng(KS_G('request.id'));//表ID
		$appModel = new AppModel('common_app');
		$app = $appModel->getRow("where appid=$appid limit 1",'appname,tableename');
		$fieldgroupModel = new AppModel('common_table_fieldgroup');
		$fieldgroup = $fieldgroupModel->getAll("where appid='$appid' order by orderid asc");
		include  CURR_VIEW_PATH . "App/appfield_group.php";
	}
	public function addfieldGroupAction(){
		$Data['appid']     = ChkClng(KS_G('request.id'));//表ID
		$Data['groupname'] = ChkSQL(KS_G('post.groupname'));//表ID
		$fieldgroupModel   = new AppModel('common_table_fieldgroup');
		$Data['orderid']   = $fieldgroupModel->getMaxValue('orderid',"appid='$Data[appid]'")+1;
		$Data['issys']     = 1;
		$fieldgroupModel->doAdd($Data,"groupid");
		$url               = M_URL('App','fieldGroup',$Data['appid']);
		KS_INFO('添加成功',0,$url);
		//header("Location: ".M_URL('app','fieldGroup',$Data['appid']));
	}
	public function delfieldGroupAction(){
		$groupid = ChkClng(KS_G('request.id'));//表ID
		$appid   = ChkClng(GF('appid'));//表ID
		$Field   = new AppModel('common_table_field');
		$count   = $Field->getOne('count(*)',"where groupid='$groupid'");
		if($count>0){KS_INFO('分组下还有字段，删除后才可以删除',0,'','',1);}
		$fieldgroupModel = new AppModel('common_table_fieldgroup');
		$fieldgroupModel->delete("groupid='$groupid'");
		$url = M_URL('App','fieldGroup',$appid);
		ks_header($url);
	}
	public function batchfieldGroupAction(){
		$groupid   = KS_G('post.groupid');//表ID
		$groupname = KS_G('post.groupname');
		$orderid   = KS_G('post.orderid');
		$fieldgroupModel = new AppModel('common_table_fieldgroup');
		foreach ($groupid as $k => $v){
		    $Data['groupname'] = $groupname[$k];
			$Data['orderid'] = $orderid[$k];
			$fieldgroupModel->update($Data,"groupid = $v");
		}
		$appid = ChkClng(GF('appid'));//表ID
		$url = M_URL('App','fieldGroup',$appid);
		KS_INFO('批量保存成功',0,$url);
	}
	//审核应用
	public function unAppstatusAction(){
		$id            = ChkClng(KS_G('request.id'));
		$now_page      = ChkClng(KS_S('p',1));
		$common_domain = M('common_app');
		$data['status']    = 0;
		$common_domain->update($data, "appid=$id");
		$url = M_URL('home/App','index','',GP('p-'.$now_page));
		ks_header($url);
	}
	//方向审核
	public function AppstatusAction(){
		$id            = ChkClng(KS_G('request.id'));
		$now_page      = ChkClng(KS_S('p',1));
		$common_domain = M('common_app');
		$data['status']    = 1;
		$common_domain->update($data, "appid=$id");
		$url = M_URL('home/App','index','',GP('p-'.$now_page));
		ks_header($url);
	}
}