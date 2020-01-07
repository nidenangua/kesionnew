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
class IndexController extends CommonController
{

    /**
     * 新闻资讯管理列表
     */
    public function indexAction(){
    	$setting = $this->cache->GetH('apprelate','appid',$this->appid,'setting',$this->wxid);
        if(!empty($setting)){$setting = explode('※',$setting);}
		$status   = ChkClng(KS_S('status','3'));
		$hits     = ChkClng(KS_S('hits'));
		$recommend= ChkClng(KS_S('recommend'));
		$allowcomment=ChkClng(KS_S('allowcomment'));
		$roll     = ChkClng(KS_S('roll'));
		$slide    = ChkClng(KS_S('slide'));
		$hot      = ChkClng(KS_S('hot'));
		$a        = ChkClng(KS_S('a'));
		//状态筛选
		if($this->rdbpower==1){
		    $where = "where a.wxid = $this->wxid";
		}else{
			$where = "where a.wxid = $this->wxid";
			//$where = "where a.wxid =$this->wxid and a.usrid=$this->usrid";
		}
		if($status==3){$where.= " and (a.status=0 or a.status=1 or a.status = 2)";}
		elseif($status==2){$where.= " and a.status=2"; }
		elseif($status==1){$where.= " and a.status=1"; }
		elseif($status==0){$where .= " and a.status=0";}
		//属性筛选
		if($recommend==1){$where.=" and a.recommend=1";}
		if($allowcomment==1){$where.=" and a.allowcomment=1";}
		if($roll==1){$where.=" and a.roll=1";}
		if($slide==1){$where.=" and a.slide=1";}
		if($hot==1){$where.=" and a.hot=1";}
		//搜索
		$keyword = ChkSQL(KS_S('keyword'));
		$keytype = ChkClng(KS_S('keytype',1));
	    //判断是否输入关键字
		if(!empty($keyword)){
		   if($keytype==1){$where.=" and a.title like '%$keyword%'";}
		   elseif($keytype==2){$where.=" and a.inputer like '%$keyword%'";}
		}
		//分类
		$categoryid=null !==GF('categoryid') ? GF('categoryid'):0;
		if($categoryid!=0) {$where .= "and (b.parentidpath like '%$categoryid,%' or b.categoryid=$categoryid)";}
		$category = $this->cache->GetHCache('appcategory1',$this->wxid);//读出缓存
		//排序
		if($hits==1){$byname = 'hits desc';}
		else{$byname = 'adddate desc';}
		$left_join   = M('app_category');
		$where       = "as a left join `$left_join->table` as b on a.categoryid = b.categoryid $where";
		$options     = $this->AppModel->getOptions('10',$where);//分页参数设置
		$page        = Page($options);
		$values      = $this->AppModel->getPage($page,$byname,$where,'b.*,a.*');
		$info          = $this->cache->GetA('domaininfo','wxid',$this->wxid,'',true);//读出缓存
		include  CURR_VIEW_PATH . "article_list.php";
	}
	public function shareAction(){
		include  CURR_VIEW_PATH . "share.php";
	}
	//进入图文增加页面
	public function addArticleAction(){
		$value='';
		include  CURR_VIEW_PATH . "article_add.php";
	}
	//图文增加
	public function doaddArticleAction(){

		$Data['userid']    = $this->userid;
		$Data['wxid']      = $this->wxid;
		$Data['title']     = ChkSQL(KS_G("post.title"));
		$Data['inputer']   = ChkSQL(KS_G('post.inputer'));
		$Data['categoryid']= ChkClng(KS_G('post.categoryid'));
		$Data['recommend'] = ChkClng(KS_G('post.recommend'));
		$Data['slide']     = ChkClng(KS_G('post.slide'));
		$Data['hot']       = ChkClng(KS_G('post.hot'));
		$Data['allowcomment'] = ChkClng(KS_G('post.allowcomment'));
		$Data['roll']      = ChkClng(KS_G('post.roll'));
		$Data['status']    = ChkClng(KS_G('post.status'));
	    $Data['adddate']   = ChkSQL(strtotime(KS_G('post.adddate')));
	    if(!empty(ChkSQL(KS_G("post.defaultpic")))){
			//分享出去的封面
			$Data['sharepic']     = getsharepic(ChkSQL(KS_G("post.defaultpic")));
		}
		/*----------------------字段拼接测试中------------------------------*/
		$fieldModel = M('common_table_field');//实例化字段表
		$Field      = $fieldModel->getAll("where appid = $this->appid and isentry=1 and status=1 and fiesys=1 order by orderid");

		foreach($Field as $Fk => $Fv){
		   $fieldname = $Fv['fieldname'];
           if (strtolower($fieldname)=="content"){
               $Data[$fieldname] = EncodeSQL(KS_G('post.'.$fieldname));
           }
		   elseif($Fv['fieldtype']==12){//12是图片，如果图片为空，不改动
			    if(!empty(ChkSQL(KS_G('post.'.$fieldname))))
			    {$Data[$fieldname] = ChkSQL(KS_G('post.'.$fieldname));}
		   }elseif($Fv['fieldtype']==3){
			    $Data[$fieldname] = Src(ChkSQL(KS_G('post.'.$fieldname)));
		   }else{
		   		$Data[$fieldname] = ChkSQL(KS_G('post.'.$fieldname));
		   }
		   if($Fv['mustinput']==1)
		   {$Rule[$fieldname]  = $Fv['title'].'|isEmpty';}
		}
		/*----------------------------------------------------*/
		$Rule['title']      = '标题|isEmpty';
		$Rule['categoryid'] = '分类|isEmpty';
		//$Rule['inputer']    = '录入员|isEmpty';;
		$Rule['adddate']    = '录入时间|isEmpty';
		$Rule['content']    = '内容|isEmpty';
        $Rule['defaultpic'] = '封面图|isEmpty';
		Chkpost($Data,$Rule,$this->AppModel);

		$id = $this->AppModel->doaddNews($Data,'id');

		$url1=M_URL($this->AppName.'/Index','addArticle','',GP(''));
		$url2=M_URL($this->AppName.'/Index','index','',GP(''));
        if (REDIS_ENABLE){
            if(!$this->redis->get('newsInfo')){
                $this->redis->set('newsInfo',serialize(array()));
            }else {
                $allnews = unserialize($this->redis->get('newsInfo'));
            }
            $Data['id']   = $id;
            $allnews[$id] = $Data;
            $this->redis->set('newsInfo',serialize($allnews));
        }
		KS_INFO("添加成功，是否继续添加",1,$url1,$url2);
	}
	//进入编辑页面
	public function editArticleAction(){
		$now_page =  ChkClng(KS_S('p',1));
		$id       =  KS_G('request.id');
		$value    =  $this->AppModel->getRow("where id=$id limit 1");
		include  CURR_VIEW_PATH . "article_add.php";
	}
	//图文编辑
	public function doEditArticleAction(){
		$now_page =  ChkClng(KS_S('p',1));
		$id = ChkClng(KS_G('request.id'));//表ID
		$Data['title'] = ChkSQL(KS_G('post.title'));
		$Data['inputer'] = ChkSQL(KS_G('post.inputer'));
		$Data['recommend']=ChkClng(KS_G('post.recommend'));
		$Data['slide']=ChkClng(KS_G('post.slide'));
		$Data['hot']=ChkClng(KS_G('post.hot'));
		$Data['allowcomment']=ChkClng(KS_G('post.allowcomment'));
		$Data['roll']=ChkClng(KS_G('post.roll'));
		$Data['status'] = ChkSQL(KS_G('post.status'));
		$Data['categoryid']=ChkClng(KS_G('post.categoryid'));
		$Data['adddate']=ChkSQL(strtotime(KS_G('post.adddate')));
		/*----------------------字段拼接测试中------------------------------*/
		$fieldModel = M('common_table_field');//实例化字段表
		$Field = $fieldModel->getAll("where appid = $this->appid and isentry=1 and status=1 and fiesys=1 order by orderid");
		foreach($Field as $Fk => $Fv){
			  $fieldname         = $Fv['fieldname'];
			  if (strtolower($fieldname)=="content"){
                  $Data[$fieldname] = EncodeSQL(KS_G('post.'.$fieldname));
              }
              elseif($Fv['fieldtype']==12){//12是图片，如果图片为空，不改动
				   if(!empty(ChkSQL(KS_G('post.'.$fieldname))))
				   {$Data[$fieldname] = ChkSQL(KS_G('post.'.$fieldname));}
			  }elseif($Fv['fieldtype']==3){
					$Data[$fieldname] = Src(ChkSQL(KS_G('post.'.$fieldname)));
			  }else{
					$Data[$fieldname] = ChkSQL(KS_G('post.'.$fieldname));
			  }
			  if($Fv['mustinput']==1)
			  {$Rule[$fieldname]  = $Fv['title'].'|isEmpty';}
		}
		/*----------------------------------------------------*/
		$Rule['title']      = '图文标题|isEmpty';
		$Rule['categoryid'] = '分类|isEmpty';
		//$Rule['inputer']    = '录入员|isEmpty';
		Chkpost($Data,$Rule,$this->AppModel,"id!=$id");
		$this->AppModel->update($Data,"id=$id");
		$url=M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
        if(REDIS_ENABLE){
            if(!$this->redis->get('newsInfo')){
                $this->redis->set('newsInfo',serialize(array()));
            }else {
                $allnews = unserialize($this->redis->get('newsInfo'));
            }
            $Data['id']   = $id;
            $allnews[$id] = $Data;
            $this->redis->set('newsInfo',serialize($allnews));
        }
		KS_INFO("保存成功",0,$url);
	}
	/**
     * 删除文章
	 */
	public function deleteAction(){
		 $id       =  ChkClng(KS_G('request.id'));
		 $now_page =  ChkClng(KS_S('p',1));
		 $this->AppModel->delete("id = $id and wxid=$this->wxid");
		 $url      =  M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
		 ks_header($url);
	}
	//批量删除
	public function batchAction(){
		$id       = isset($_POST["check"])?$_POST["check"]:'';
        $batch    = ChkClng(KS_S('batch'));
		$now_page =  ChkClng(KS_S('p',1));
		if(empty($id)){KS_INFO("请选择",0,'','',1);}

		foreach ($id as $k=>$v ){
            if ($batch==1){
                $this->AppModel->delete("id=".ChkClng($v));
            }else if ($batch==2){   //审核
                $Data['status']=1;
                $this->AppModel->update($Data,'id ='.ChkClng($v));
            }else if ($batch==3){  //取消审核
                $Data['status']=0;
                $this->AppModel->update($Data,'id ='.ChkClng($v));
            }
        }
		$url      =  M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
		KS_INFO("操作成功",0,$url);
	}
	//进入配置
	public function settingAction(){
	    $setting = getSet($this->wxid,$this->appid);//获取网站配置
		include  CURR_VIEW_PATH . "setting.php";
	 }
	//应用配置
	public function doSettingAction(){
		$setting = getSet($this->wxid,$this->appid);//获取网站配置
		$setting[0] = ChkClng(KS_G('post.setting0'));//是否开启
		$setting[1] = ChkClng(KS_G('post.setting1'));//课程是否需要审核
		$setting[2] = ChkClng(KS_G('post.setting2'));//是否开启分类
		$Data['setting'] = implode('|',$setting);
		$apprelateModel         = M('common_app_userrelate');
	    $apprelateModel->update($Data,'wxid='.$this->wxid.' and appid = '.$this->appid);
		KS_INFO('保存成功',6);
	}
	//更新用户状态
	public function updatestatusAction(){
		$id = ChkClng(KS_G("get.id"));
		if(empty($id)){KS_INFO('请选择',0,'','',1);}
		$status = $this->AppModel->getOne('status','where id ='.$id.' and wxid='.$this->wxid);
		if($status==1){
            $Data['status']=0;
        }elseif($status==0){
            $Data['status']=1;
        }
		$this->AppModel->update($Data,'id ='.$id);
		echo $Data['status'];
	}
}