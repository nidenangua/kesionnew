<hr />
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
class IndexController extends CommonController{

        public function indexAction(){
			
			$keyword = KS_S('keyword');
		$keytype = ChkClng(KS_S('keytype'));
		$now_page = ChkClng(KS_S('p'));
		$Model = M('app_voucher_list');
		$userModel = M('common_user');
		/**********先数据过一遍过期的优惠券**************/
		$infos = $Model->getAll('where   awarddate=1 and isuse = 0 and redemptionendtime<'.time());
		if(!empty($infos)){
			$Datas['isuse'] = 2;
			foreach($infos as $k =>$v){$Model->update($Datas,'id='.$v['id']);}
		}
		/**********在过一遍已领完的优惠券**************/
		$infos = $Model->getAll('where   isuse = 0');
		foreach($infos as $k =>$v){
			if($v['counts'] >= $v['number']){
				$Datas['isuse'] = 1; 
				$Model->update($Datas,'id='.$v['id']);
			}
		} 
		/**********开始查询优惠券列表**************/	 
		$db_website = M("common_user_website");
		$stat =null !==GF('stat') ? GF('stat'):'3';
		$where= ' as a left join '.$db_website->table.' as b on a.wxid=b.wxid where 1=1';
		if($stat == 0){
			$where .= ' and a.isuse = 0';
		}elseif($stat == 1){
			$where .= ' and a.isuse = 1';
		}elseif($stat == 2){
			$where .= ' and a.isuse = 2';
		}
		if(!empty($keyword)){
			if($keytype==1){
				 $where.=" and b.sitename like '%$keyword%'";
			}
		}	
		$options = $Model->getOptions('10',$where);//分页参数设置
		$page = Page($options);
		$values = $Model->getPage($page,'a.id desc',$where,'a.*,b.sitename');
		foreach ($values as $k => $v) {
			if($v['infoid']){
                if($v['type']==6){
                 $values[$k]['infotitle']=M('app_paper')->getOne('Title','where paperid='.$v['infoid']);
                }else{
                 $values[$k]['infotitle']=M('app_course')->getOne('title','where courseid='.$v['infoid']);
                }
			}else{
				$values[$k]['infotitle']='暂无';
			}
			
		}
//		var_dump($values);exit;
		include  CURR_VIEW_PATH . "index.php";
			
		}
	public function detailListAction(){
		$id = KS_G('get.id');
		$Model = M('app_voucher');
		$userModel = M('common_user_member');
		$db_website = M("common_user_website");
		$where= ' as a left join '.$db_website->table.' as b on a.wxid=b.wxid left join '.$userModel->table.' as c on a.memberid=c.userid  where a.vid='.$id;
		$keyword = KS_S('keyword');
		$keytype = ChkClng(KS_S('keytype'));
		$now_page = ChkClng(KS_S('p'));
		if(!empty($keyword)){
			if($keytype==1){
				 $where.=" and c.name like '%$keyword%'";
			}elseif($keytype==2){
				 $where.=" and b.sitename like '%$keyword%'";
			}
		}

        $options = $Model->getOptions('10',$where);//分页参数设置
        $options['now_page'] = $now_page;
		$page = Page($options);
		$values = $Model->getPage($page,'a.id desc',$where,'a.*,b.sitename,c.name');
		include CURR_VIEW_PATH."detaillist.php";
	}
	//删除优惠券用户
	public function deleteMemberAction(){
		$now_page = ChkClng(KS_S('p'));
		$vid = GF('vid');
		$id = KS_G('get.id');
		$Model = M('app_voucher');
		$Model->delete('id='.$id);
		$url = M_URL($this->AppName.'/Index','detailList',$vid,GP('p-'.$now_page));
		ks_header($url);
	}
	//批量删除优惠券用户
	public function batchAction(){
		$now_page = ChkClng(KS_S('p'));
		$vid = KS_G('get.id');
		$idary = KS_G('post.id');
		$Model = M('app_voucher');
		foreach ($idary as $key => $value) {
			$Model->delete('id='.$value);
		}
		
		$url = M_URL($this->AppName.'/Index','detailList',$vid,GP('p-'.$now_page));
		KS_INFO('批量删除成功',0,$url);
		// ks_header($url);
	}
	  //删除优惠券
	public function deleteAction(){
		$now_page = ChkClng(KS_S('p'));
		$id = KS_G('get.id');
		$Model = M('app_voucher');
		$listModel = M('app_voucher_list');
		$Model->delete('vid='.$id);
		$listModel->delete('id='.$id);
		$url = M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
		ks_header($url);
	}

	//批量删除优惠券
	public function batchlistAction(){
		$now_page = ChkClng(KS_S('p'));
		$idary = KS_G('post.id');
		$Model = M('app_voucher');
		$listModel = M('app_voucher_list');
		foreach ($idary as $key => $value) {
			$listModel->delete('id='.$value);
			$Model->delete('vid='.$value);
		}
		
		$url = M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
		KS_INFO('批量删除成功',0,$url);
		// ks_header($url);
	}
}
  