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
	/*
	 * 资料列表
	 */
    public function indexAction()
	{
		//搜索
		$keyword = ChkSQL(KS_S('keyword'));
		$keytype = ChkClng(KS_S('keytype',1));
		$isopen = ChkClng(KS_S('isopen',3));
		$where = "where wxid = $this->wxid";
		if ($isopen==1){
			$where .= " and isopen=1";
		}
		//判断是否输入关键字
		if(!empty($keyword)){
			if($keytype==1){$where.=" and title like '%$keyword%'";}
			elseif($keytype==2){$where.=" and realname like '%$keyword%'";}
		}
		$courseFile  = M('app_course_file');
		$options     = $courseFile->getOptions('10',$where);//分页参数设置
		$page        = Page($options);
		$values      = $courseFile->getPage($page,'adddate desc',$where,'id,title,down_num,price,chargetype,isopen,size');
		include  CURR_VIEW_PATH . "index.php";
	}
	/*
	 * 添加页面
	 */
	public function addAction()
	{
		$now_page =  ChkClng(KS_S('p',1));
		$id =ChkSQL(KS_S('id'));
		if (!empty($id)){
			$model = M('app_course_file');
			$value = $model->getRow("where id=$id and wxid=$this->wxid");
		}
		include  CURR_VIEW_PATH . "add.php";
	}
	/*
	 * 添加操作
	 */
	public function doaddAction()
	{
		$now_page = ChkClng(KS_S('p',1));
		$id = ChkSQL(KS_S('id'));
		$Data['title'] = ChkSQL(KS_G("post.title"));//标题
		if (empty($Data['title'])) KS_INFO("请输入标题");
		$model = M('app_course_file');
		$title = $model->getOne('id',"where title='$Data[title]' and wxid=$this->wxid");
		if (!empty($title)) KS_INFO("已存在该文件");
		$Data['defaultpic'] = ChkSQL(KS_G("post.defaultpic"));//封面
		if (empty($Data['defaultpic'])) KS_INFO("请上传图片");
		$Data['chargetype'] = ChkSQL(KS_G("post.chargetype"));//收费类型
		$Data['price'] = ChkSQL(KS_G("post.price"));//价格
		$Data['isopen'] = ChkClng(KS_G('post.isopen',1));//状态
		$Data['wxid'] = $this->wxid;
		$Data['adddate'] = time();
		$id = $model->doAdd($Data,'id');
		$url1=M_URL($this->AppName.'/Index','add','',GP(''));
		$url2=M_URL($this->AppName.'/Index','index','',GP(''));
		if ($id){
			KS_INFO("添加成功，是否继续添加",1,$url1,$url2);
		}else{
			KS_INFO("添加失败");
		}
	}
	/*
	 * 修改操作
	 */
	public function doeditAction()
	{
		$now_page = ChkClng(KS_S('p',1));
		$id = ChkSQL(KS_S('id'));
		$Data['title'] = ChkSQL(KS_G("post.title"));//标题
		if (empty($Data['title'])) KS_INFO("请输入标题");
		$model = M('app_course_file');
		$title = $model->getOne('id',"where title='$Data[title]' and wxid=$this->wxid");
		if (!empty($title)) KS_INFO("已存在该文件");
		$Data['defaultpic'] = ChkSQL(KS_G("post.defaultpic"));//封面
		if (empty($Data['defaultpic'])) KS_INFO("请上传图片");
		$Data['chargetype'] = ChkSQL(KS_G("post.chargetype"));//收费类型
		$Data['price'] = ChkSQL(KS_G("post.price"));//价格
		$Data['isopen'] = ChkClng(KS_G('post.isopen',1));//状态
		$model->update($Data,"id=$id and wxid=$this->wxid");
		$url1=M_URL($this->AppName.'/Index','add','',GP(''));
		$url2=M_URL($this->AppName.'/Index','index','',GP(''));
		KS_INFO("添加成功，是否继续添加",1,$url1,$url2);
	}
	/*
	 * 删除
	 */
	public function delAction()
	{
		$id =ChkSQL(KS_S('id'));
		if(empty($id)){
			KS_INFO("请选择",0,'','',1);
		}
		$model = M('app_course_file');
		if (is_array($id)){
			foreach ($id as $k=>$v){
				$model->delete("id=".ChkClng($v)." and wxid=$this->wxid");
			}
		}else{
			$model->delete("id=".ChkClng($id)." and wxid=$this->wxid");
		}
		$url = KS_ComeUrl();//上个页面地址
		ks_header($url,1);
	}
	/*
	 * 更改状态
	 */
	public function updatestatusAction()
	{
		$id =ChkClng(KS_S('id'));
		$model = M('app_course_file');
		$hot =  $model->getOne('isopen',"where id='$id'");
		if($hot==0){
			$Data['isopen']=1;
			$model->update($Data,"id=$id");
//		    echo "1";
		} elseif($hot==1){
			$Data['isopen']=0;
			$model->update($Data,"id=$id");
//		    echo "0";
		}
	}
	public function shareAction(){
		include  CURR_VIEW_PATH . "share.php";
	}
}
  