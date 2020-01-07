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
class AdminController extends CommonController
{

    public $navList = [
        [
            'title' => '首页',
            'controller'=>'sys_home',
            'secondnav' => [
                ['title'=>'查看数据','controller'=>'index','action'=>'mainfirst'],
            ]
        ],
		[
			'title' => '财务管理',
            'controller'=>'sys_money',
			'secondnav' => [
                ['title'=>'客户管理','controller'=>'domain','action'=>'clientList',
                    'thirdnav'=> [
                        ['title'=>'跟进记录','controller'=>'domain','action'=>'followList'],
                        ['title'=>'添加记录','controller'=>'domain','action'=>'Follow'],
                        ['title'=>'删除记录','controller'=>'domain','action'=>'delFollow'],
                    ]
                ],
                [
                'title'=>'网校流水','controller'=>'paylog','action'=>'wxpaylog',
                'thirdnav'=> [
                      ['title'=>'订单管理','controller'=>'order','action'=>'index'],
                      ['title'=>'导出EXCEL','controller'=>'order','action'=>'indexexcel'],
                  ]
                ],
				['title'=>'平台流水','controller'=>'paylog','action'=>'index'],
				['title'=>'直播币流水','controller'=>'paylog','action'=>'livecurrency'],
				['title'=>'提现管理','controller'=>'Capital','action'=>'index']
			]
		],
		[
			'title' => '用户管理',
            'controller'=>'sys_user',
			'secondnav' => [
				['title'=>'网校管理','controller'=>'domain','action'=>'wxlist',
                 'thirdnav'=> [
                      ['title'=>'改业务员','controller'=>'domain','action'=>'changeSalesMan'],
                      ['title'=>'改资料','controller'=>'domain','action'=>'changeWxName'],
                      ['title'=>'升级','controller'=>'domain','action'=>'Service'],
                      ['title'=>'充值','controller'=>'domain','action'=>'wxrecharge'],
                      ['title'=>'直播配置','controller'=>'domain','action'=>'liveConfig'],
                      ['title'=>'删除','controller'=>'users','action'=>'deleteUserswx'],
                      ['title'=>'API网校','controller'=>'domain','action'=>'apilist'],
                      ['title'=>'查看详情','controller'=>'domain','action'=>'wxdetail'],
                      ['title'=>'导出Excel','controller'=>'domain','action'=>'wxpaylogexcel'],
                      ['title'=>'登录HOME端','controller'=>'domain','action'=>'login'],
                      ['title'=>'设置过期时间','controller'=>'domain','action'=>'setexpiretime'],
                  ]
                ],
				['title'=>'其它用户','controller'=>'users','action'=>'index'],
				['title'=>'实名审核','controller'=>'users','action'=>'realname',
                    'thirdnav'=> [
                        ['title'=>'查看','controller'=>'users','action'=>'doreal'],
                        ['title'=>'审核','controller'=>'users','action'=>'dorealName'],
                        ['title'=>'删除','controller'=>'users','action'=>'deleteRealName'],
                    ]
                ],
				['title'=>'域名管理','controller'=>'domain','action'=>'index'],
				['title'=>'短信审核','controller'=>'domain','action'=>'smslist'],
                ['title'=>'名片组管理','controller'=>'users','action'=>'cardGroup'],
                ['title'=>'名片用户管理','controller'=>'users','action'=>'cardUser']
			]
		],
        [
        'title' => '应用市场',
            'controller'=>'sys_market',
			'secondnav' => [
				['title'=>'应用管理','controller'=>'app','action'=>'index'],
				['title'=>'风格管理','controller'=>'temp','action'=>'index'],
				['title'=>'营销管理','controller'=>'h5market','action'=>'schemelist']
			]
        ],
        [
        'title' => '资源管理',
            'controller'=>'sys_zygl',
			'secondnav' => [
				['title'=>'视频管理','controller'=>'vdo','action'=>'index'],
				['title'=>'对象存储','controller'=>'vdo','action'=>'oss'],
				['title'=>'图标管理','controller'=>'ico','action'=>'index']
			]
        ],
         [
            'title' => '内容发布',
            'controller'=>'sys_content',
			'secondnav' => [

                ['title'=>'客户案例','controller'=>'Offweb','action'=>'Case',
                 'thirdnav'=> [
                      ['title'=>'发布','controller'=>'Offweb','action'=>'caseManage'],
                      ['title'=>'删除','controller'=>'Offweb','action'=>'delCase'],
                  ]
                 ],
                /* ['title'=>'问题解答','controller'=>'Offweb','action'=>'Question',
                 'thirdnav'=> [
                      ['title'=>'问题发布','controller'=>'Offweb','action'=>'questionManage'],
                      ['title'=>'问题删除','controller'=>'Offweb','action'=>'deleteQuestion'],
                      ['title'=>'分类管理','controller'=>'Offweb','action'=>'questionClassifyIndex'],
                      ['title'=>'分类发布','controller'=>'Offweb','action'=>'questionClassifyManage'],
                      ['title'=>'分类删除','controller'=>'Offweb','action'=>'deleteQuestionClassify'],
                  ]
                 ],*/
              ['title'=>'帮助中心','controller'=>'Offweb','action'=>'Helpcenter',
                 'thirdnav'=> [
                      ['title'=>'选择图片','controller'=>'Index','action'=>'imageslist'],
                      ['title'=>'帮助发布','controller'=>'Offweb','action'=>'helpManage'],
                      ['title'=>'帮助删除','controller'=>'Offweb','action'=>'deleteHelpCenter'],
                      ['title'=>'分类管理','controller'=>'Offweb','action'=>'showclassify'],
                      ['title'=>'分类发布','controller'=>'Offweb','action'=>'categoryManage'],
                      ['title'=>'分类删除','controller'=>'Offweb','action'=>'deleteCategory'],
                  ]
                 ],


				['title'=>'意见反馈','controller'=>'Content','action'=>'feedBackList',
                  'thirdnav'=> [
                      ['title'=>'查看回复','controller'=>'content','action'=>'feedBackShow'],
                      ['title'=>'删除','controller'=>'content','action'=>'deleteFeedBack'],
                  ]
                ],
				/*['title'=>'最新开发动态','controller'=>'content','action'=>'developList',
                 'thirdnav'=> [
                      ['title'=>'发布','controller'=>'content','action'=>'developManage'],
                      ['title'=>'删除','controller'=>'content','action'=>'deleteDevelop'],
                  ]
                 ],*/
				['title'=>'API接口','controller'=>'interface','action'=>'index'],
				['title'=>'API文档','controller'=>'apiwiki','action'=>'index'],
				['title'=>'任务管理','controller'=>'task','action'=>'index']
			]
        ],
         [
        'title' => '配置管理',
            'controller'=>'sys_setting',
			'secondnav' => [
				['title'=>'平台配置','controller'=>'setting','action'=>'index'],
				['title'=>'管理员管理','controller'=>'admin','action'=>'index'],
				['title'=>'套餐配置','controller'=>'domain','action'=>'package'],
				['title'=>'专业管理','controller'=>'userscategory','action'=>'package'],
				['title'=>'海报管理','controller'=>'setting','action'=>'poster'],
			]
        ]
    ];

     /**
     * 进入管理员列表页
      */
     public function indexAction(){
     	$adddate= KS_S('adddate',1);
     	if($adddate == 1){
			$byname  = 'lastlogintime desc';
		}else{
			$byname  = 'lastlogintime ASC';
		}
		$where='';
		$keyword = KS_S('keyword');
		$keytype = ChkClng(KS_S('keytype',1));
		if(!empty($keyword)){
			if($keytype==1){$where.=" where username like '%$keyword%'";}
		}
		$adminModel = M('common_admin');
		$options    = $adminModel->getOptions('8',$where);
		$page       = Page($options);
		$pageadmins = $adminModel->getPage($page,$byname,$where);
	    include  CURR_VIEW_PATH . "Admin/admin.list.php";
     }
	 /**
     * 进入添加，修改管理员页
	  */
	 public function manageAction(){
         $common_admin_power = M('common_admin_power');
         $power=$common_admin_power->getAll('');
         $adminid    = ChkClng(KS_G('request.id'));
         $now_page   = ChkClng(KS_S('p'));
         if ($adminid>0){
             $adminModel = M('common_admin');
             $admin = $adminModel->getRow("where adminid=$adminid limit 1");
         }
        include  CURR_VIEW_PATH . "Admin/admin.manage.php";
     }
	 /**
     * 保存管理员操作
	  */
	 public function manageDoSaveAction(){

         $adminid        = ChkClng(KS_G('request.id'));
         if ($adminid<=0){
             $common_admin_power = M('common_admin_power');
             $Data['username'] = ChkSQL(KS_G('post.adminname'));
             $assertpassword   = ChkSQL(KS_G('post.assertpassword'));
             $Data['realname'] = ChkSQL(KS_G('post.realname'));
             $Data['mobile']   = ChkSQL(KS_G('post.mobile'));
             $Data['defaultpic']= ChkSQL(KS_G('post.defaultpic'));
             $Data['admintype']= ChkSQL(KS_G('post.admintype'));
             $Data['adminname'] = $common_admin_power->getOne('rulename','where id='.$Data['admintype']);
             $Data['rndpasswordc']=rand(10000,99999);
             $Data['password'] = ChkSQL(KS_G('post.password'));
             if($assertpassword!==$Data['password']){KS_INFO("两次密码不一致",0,'','',1);}
             if(!empty($_FILES['file']['tmp_name'])){
                 $this->upload->savePath = 'images/'; // 设置附件上传（子）目录
                 $info = $this->upload->uploadOne($_FILES['file']);
                 if(!$info) {KS_INFO($this->upload->getError(),0,'','',1);}//上传错误提示错误信息
                 else{
                     $Data['defaultpic'] = ChkSQL($this->upload->uootPath.$info['savepath'].$info['savename']);//应用封面图片
                 }
             }
             //确认修改判断规则，详见ks_cls文件夹中的kesion.chkpost
             $Rule['username']  = '管理员用户名|isEmpty,isDbexis';
             $Rule['password']  = '密码|isEmpty,isPassword';
             $Rule['mobile']    ='电话号码|isEmpty,isMobile';
             $adminModel = M('common_admin');
             Chkpost($Data,$Rule,$adminModel);
             $Data['password'] = KS_MD5($Data['password'].KS_MD5($Data['rndpasswordc']));
             $result = $adminModel->doAdd($Data,'adminid');
             KS_INFO('添加成功',0,M_URL('Admin'));
         }else{
             $common_admin_power = M('common_admin_power');
             $now_page       = Chkclng(null !==GF('p') ? GF('p'):'0');
             $assertpassword = ChkSQL(KS_G('post.assertpassword'));
             $oldpassword    = ChkSQL(KS_G('post.oldpassword'));
             $password       = ChkSQL(KS_G('post.password'));
             if(!empty($password))
             {
                 $Data['password']  =  ChkSQL(KS_G('post.password'));
                 if($oldpassword    ==$password){KS_INFO("新密码不能与原密码一致",0,'','',1);}
                 if($assertpassword!==$password){KS_INFO("两次密码不一致",0,'','',1);}
             }
             if(!empty($oldpassword) && empty($password)){
                 KS_INFO('请输入新密码',0,'','',1);
             }
             $Data['realname']    = ChkSQL(KS_G('post.realname'));
             $Data['mobile']      = ChkSQL(KS_G('post.mobile'));
             $Data['admintype']   = ChkSQL(KS_G('post.admintype'));
             $Data['defaultpic']= ChkSQL(KS_G('post.defaultpic'));
             $Data['adminname'] = $common_admin_power->getOne('rulename','where id='.$Data['admintype']);

             $adminModel = M('common_admin');
             $Rule['mobile']      ='电话号码|isEmpty,isMobile';
             Chkpost($Data,$Rule,$adminModel);
             $admininfo = $adminModel->getRow("where adminid=$adminid limit 1");
             //确认修改判断规则，详见ks_cls文件夹中的kesion.chkpost
             $Rule = array();
             if(!empty($password)){
                 if($admininfo['password'] !== KS_MD5($oldpassword.KS_MD5($admininfo['rndpasswordc'])))
                 {
                     KS_INFO('原密码错误',0,'','',1);
                     $Rule['password'] = '密码|isPassword';
                 }else{
                     $Data['rndpasswordc']=rand(10000,99999);
                     $Data['password'] = KS_MD5($Data['password'].KS_MD5($Data['rndpasswordc']));

                 }
             }
             if(!empty($password)){}
             if(!empty($_FILES['file']['tmp_name'])){
                 $defaultpic = $adminModel->getOne('defaultpic',"where adminid=$adminid limit 1");
                 $this->upload->removefile($defaultpic);
                 $this->upload->savePath = 'images/'; // 设置附件上传（子）目录
                 $info = $this->upload->uploadOne($_FILES['file']);
                 if(!$info){KS_INFO($this->upload->getError(),0,'','',1);}//上传错误提示错误信息
                 else{
                     $Data['defaultpic'] = ChkSQL($this->upload->uootPath.$info['savepath'].$info['savename']);//应用封面图片
                 }
             }
             Chkpost($Data,$Rule,$adminModel,"adminid!=$adminid");
             $result = $adminModel->update($Data,"adminid=$adminid");
             $url =  M_URL('Admin','','',GP('p-'.$now_page));
             KS_INFO('修改成功',0,$url);
         }
     }


	 /**
     * 删除管理员操作
	  */
	 public function deleteAdminAction(){
		$adminid    = KS_G('request.id');
		$now_page   = ChkClng(KS_S('p'));
		$adminModel = M('common_admin');
        if (gettype($adminid)!='array'){
            $adminid=explode(',',$adminid);
        }
        foreach($adminid as $k=>$v){$adminModel->delete("adminid=$v");}
		$url    = M_URL('Admin','','',GP('p-'.$now_page));
        KS_INFO('删除成功',0,$url);
     }

	/*
	 * 管理等级列表
	 */
	public function AdminLevelListAction(){
		$where= 'where id >0';
		$keyword = ChkSQL(KS_S('keyword'));
		$keytype = ChkClng(KS_S('keytype',1));
		if(!empty($keyword)){
			if($keytype==1){$where.=" and rulename like '%$keyword%'";}
		}
		$common_admin_power = M('common_admin_power');
		$options = $common_admin_power->getOptions('8',$where);//分页参数设置
		$page = Page($options);
		$values = $common_admin_power->getPage($page,'',$where);
		include  CURR_VIEW_PATH . "Admin/admin.levelList.php";
	}
	/*
	 * 添加/编辑管理等级
	 */
	public function adminLevelAction(){
        $now_page   = ChkClng(KS_S('p'));
        $id = KS_G('get.id');
		//提取原有的权限
        if ($id>0){
            $common_admin_power = M('common_admin_power');
            $admin = $common_admin_power->getRow('where id='.$id);
        }

		include  CURR_VIEW_PATH . "Admin/admin.adminLevel.php";
	}
	/**
	 * 保存添加,修改权限等级
	 */
	public function adminLevelDoSaveAction(){
        $now_page   = ChkClng(KS_S('p'));
		$url =  M_URL('Admin','AdminLevelList','',GP('p-'.$now_page));

        $id = ChkClng(KS_G('get.id'));
		$data['rulename'] = KS_G('post.rulename');
		if(empty($data['rulename'])){
			KS_INFO('权限名称不能为空',0,'','',1);
		}

		if(empty($_POST['rules'])){
			KS_INFO('权限不能为空',0,'','',1);
		}
		$data['rule'] = implode(',',$_POST['rules']);
		$data['adddate'] = time();
		$common_admin_power = M('common_admin_power');
        if ($id>0){
            $common_admin_power->update($data,'id='.$id);
            KS_INFO('修改成功',3,$url);
        }else{
            $common_admin_power->doAdd($data,'id');
            KS_INFO('创建成功',3,$url);
        }


	}

	/*
	 * 删除权限等级
	 */
	public function delAdminLevelAction(){
		$id = ChkClng(KS_G('get.id'));
		$now_page   = ChkClng(KS_S('p'));
		$url =  M_URL('Admin','AdminLevelList','',GP('p-'.$now_page));
		$db = M('common_admin_power');
		$db->delete('id!=1 and id='.$id);
		KS_INFO('删除成功',3,$url);
	}
}