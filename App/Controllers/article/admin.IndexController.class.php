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
     public function indexAction(){
		$stat=KS_S('status',3);
		$hits=null !==GF('hits') ? GF('hits'):'0';
		$recommend=null !==GF('recommend') ? GF('recommend'):'0';
		$allowcomment=null !==GF('allowcomment') ? GF('allowcomment'):'0';
		$roll=null !==GF('roll') ? GF('roll'):'0';
		$slide=null !==GF('slide') ? GF('slide'):'0';
		$hot=null !==GF('hot') ? GF('hot'):'0';
		$a=null !==GF('a') ? GF('a'):'0';
		//状态筛选
		if($stat==3){$where = 'where a.userid!=4 and a.userid!=0 and a.wxid!=1 and (a.status=0 or a.status=1)';}
		elseif($stat==1){$where = 'where a.userid!=4 and a.userid!=0 and a.wxid!=1 and a.status=1'; }
		elseif($stat==0){$where = 'where a.userid!=4 and a.userid!=0 and a.wxid!=1 and a.status=0';}
		//属性筛选
		if($recommend==1){$where.=' and a.recommend=1';}
		if($allowcomment==1){$where.=' and a.allowcomment=1';}
		if($roll==1){$where.=' and a.roll=1';}
		if($slide==1){$where.=' and a.slide=1';}
		if($hot==1){$where.=' and a.hot=1';}
		//搜索
		$keyword=KS_S('keyword');
		$keytype=KS_S('keytype',1);
		//判断是否输入关键字
		if(!empty($keyword)){
		  if($keytype==1){$where.=" and a.title like '%$keyword%'";}
		  elseif($keytype==2){$where.=" and a.inputer like '%$keyword%'";} 
		  elseif($keytype==3){$where.=" and a.wxid=$keyword";}
		}
		//判断是否有用户ID
		if($this->wxid !== ''){
			$where .= ' and a.wxid='.$this->wxid;//分类
			$categoryid = null !==GF('categoryid') ? GF('categoryid'):0;	
			if($categoryid!=0){$where .= " and (b.parentidpath like '%$categoryid,%' or b.categoryid=$categoryid)";}	
			$appcategory = $this->cache->GetHCache('appcategory',$this->wxid);//取出缓存
	    }
		//排序				
		if($hits==1){$byname = 'hits desc';}
		else{$byname = 'adddate desc';}
		//需要连表的在最后left join
		$left_join = M('app_category');
		$where = "as a left join `$left_join->table` as b on a.categoryid = b.categoryid $where";
		
		$options = $this->AppModel->getOptions('15',$where);//分页参数设置
		$page = Page($options);
		$values = $this->AppModel->getPage($page,$byname,$where,'b.*,a.*');
		
        include  CURR_VIEW_PATH . "article_list.php";
    }
	public function addArticleAction(){
		$value='';
		$this->userinfo = '';
		include  CURR_VIEW_PATH . "article_add.php";
	} 
	public function doaddArticleAction(){
		$Data['title']        = ChkSQL(KS_G('post.title'));
		$Data['inputer']      = ChkSQL(KS_G('post.inputer'));
		$Data['recommend']    = ChkClng(KS_G('post.recommend'));
		$Data['slide']        = ChkClng(KS_G('post.slide'));
		$Data['hot']          = ChkClng(KS_G('post.hot'));
		$Data['allowcomment'] = ChkClng(KS_G('post.allowcomment'));
		$Data['roll']         = ChkClng(KS_G('post.roll'));
		$Data['status']       = ChkSQL(KS_G('post.status'));	
		$Data['categoryid']   = ChkClng(KS_G('post.categoryid'));
		$Data['adddate']      = ChkSQL(strtotime(KS_G('post.adddate')));
		/*----------------------字段拼接测试中------------------------------*/
		$fieldModel = M('common_table_field');//实例化字段表
		$Field = $fieldModel->getAll("where appid = $this->appid and isentry=1 and status=1 and fiesys=1 order by orderid");
		foreach($Field as $Fk => $Fv){
		   $fieldname = $Fv['fieldname'];
		   $Data[$fieldname] = ChkSQL(KS_G('post.'.$fieldname));
		   if($Fv['mustinput']==1)
		   {$Rule[$fieldname]  = $Fv['title'].'|isEmpty';}
		}
		/*----------------------------------------------------*/
		$Rule['title']      = '新闻标题|isEmpty';
		$Rule['categoryid'] = '分类|isEmpty';
		$Rule['inputer']    = '录入员|isEmpty';
		Chkpost($Data,$Rule,$this->AppModel);
		$this->AppModel->doAdd($Data,'id');
		$url=M_URL($this->AppName.'/Index','index','',GP(''));
		KS_INFO("保存成功",0,$url);
	}
	public function editArticleAction(){
		$now_page =  ChkClng(KS_S('p',1));  
		$id = ChkClng(KS_G('request.id'));
		$value = $this->AppModel->getRow("where id=$id limit 1");
		include  CURR_VIEW_PATH . "article_add.php";
	}
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
		  $fieldname = $Fv['fieldname'];
		  $Data[$fieldname] = ChkSQL(KS_G('post.'.$fieldname));
		  if($Fv['mustinput']==1)
		  {$Rule[$fieldname]  = $Fv['title'].'|isEmpty';}
		}
		/*----------------------------------------------------*/
		$Rule['title'] = '新闻标题|isEmpty';
		$Rule['categoryid'] = '分类|isEmpty';
		$Rule['inputer'] = '录入员|isEmpty';
		Chkpost($Data,$Rule,$this->AppModel,"id!=$id");
		$this->AppModel->update($Data,"id=$id");
		$url=M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
		KS_INFO("保存成功",0,$url);
	}
    public function delectAction(){
		$id = ChkClng(KS_G('request.id'));
		$now_page =  ChkClng(KS_S('p',1));
		$this->AppModel->delete("id = $id");
		$url=M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
		ks_header($url);
	}
	public function batchAction(){
		$id = isset($_POST["check"])?$_POST["check"]:'';
		$now_page = ChkClng(KS_S('p',1));
		$url = M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
		if(empty($id)){KS_INFO("请选择",0,'','',1);}
		//批量删除
		if(KS_G('post.batch')==1){
			foreach ($id as $v ){$this->AppModel->delete("id=$v");}
			KS_INFO('批量删除成功',0,$url);
		}
		//批量审核
		elseif(KS_G('post.batch')==2){
		    $data['status']=1;
		    foreach ($id as $v ) {$this->AppModel->update($data, "id=$v");}
			KS_INFO('批量审核成功',0,$url);
		}
		//批量取消审核
		elseif(KS_G('post.batch')==3){
			$data['status']=0;
			foreach ($id as $v ) {$this->AppModel->update($data, "id=$v");}
			KS_INFO('批量取消审核成功',0,$url);
		}
	}
	public function auditedAction(){
		$id       = ChkClng(KS_G('request.id'));
		$now_page = ChkClng(KS_S('p',1));
		$data['status'] = 1;
		$this->AppModel->update($data,"id=$id");
		$url = M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
		ks_header($url);
	}
	public function unauditedAction(){
		$id       = ChkClng(KS_G('request.id'));
		$now_page =  ChkClng(KS_S('p',1));
		$data['status'] = 0;
		$this->AppModel->update($data,"id=$id");
		$url = M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
		ks_header($url);
	}
	public function ssssssAction(){
		include  CURR_VIEW_PATH . "TypeChange.php";
	}
}