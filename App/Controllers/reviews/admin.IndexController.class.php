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
		$appModel =   M('common_app');
		$keyword   =   ChkSQL(GF('keyword') ? GF('keyword'):'');
		$keytype   =   ChkSQL(GF('keytype') ? GF('keytype'):1);
		$status    =   ChkClng(GF('grade') ? GF('grade'):5);
		$anonymous    =   ChkClng(GF('anonymous') ? GF('anonymous'):3);
		$byname    =   ChkSQL(GF('byname') ? GF('byname'):'desc');
		if($status==5){ $where= ' where (1=1)';}//评级等级
	 	elseif($status==1){ $where= ' where a.grade=0';}
	 	elseif($status==2){ $where= ' where a.grade=1';}
	 	elseif($status==3){ $where= ' where a.grade=2';}
	 	elseif($status==4){ $where= ' where a.grade=3';}
	 	if($anonymous==3){ $where.= ' and (1=1)';}//是否匿名
	 	elseif($anonymous==2){ $where=$where. ' and a.anonymous=0';}
	 	elseif($anonymous==1){ $where=$where. ' and a.anonymous=1';}
	 	if($keytype==1){
	     	$where  = $where.' and a.membername like "%'.$keyword.'%"';
		}elseif($keytype==2){
		  	$where  =  $where.' and b.appname like "%'.$keyword.'%"';
		}
	    $where      =  "as a left join `$appModel->table` as b on a.appid = b.appid ".$where;
	    $options    =  $this->AppModel->getOptions('10',$where);//分页参数设置
		$page       =  Page($options);
		$infoary    =  $this->AppModel->getPage($page,'adddate '.$byname,$where,'a.reviewsid,a.membername,b.appname,a.wxid,a.reviews,a.adddate,a.grade,a.star,a.anonymous,a.issolve');
        foreach($infoary as $k =>$v){
        	if($v['grade']==0){
        		$infoary[$k]['grade'] = '没有评级';
        	}elseif($v['grade']==1){
        		$infoary[$k]['grade'] = '好评';
        	}elseif($v['grade']==2){
        		$infoary[$k]['grade'] = '中评';
        	}elseif($v['grade']==3){
        		$infoary[$k]['grade'] = '差评';
        	}
        }
        include  CURR_VIEW_PATH . "index.php"; 
    }
    public  function deleteAction(){
     	$now_page = ChkClng(KS_S('p',1)); 
		$id       = ChkClng(GF('reviewsid'));
		$status   = ChkClng(GF('status'));
//		var_dump($id);
//		var_dump($status);
			$Data['status'] = -1;
		$this->AppModel->update($Data,'reviewsid='.$id);
		$url            =  M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));		
		ks_header($url);
    }
    /*
     * 批量操作，审核，删除，取消审核
     */
     public  function someDelAction(){
     	$now_page = ChkClng(KS_S('p',1)); 
		$idAry=ChkSQL(KS_G('post.id'));
		$type=ChkSQL(KS_G('post.batch'));
		$Data['status'] = -1;
			foreach($idAry as $k => $v){
				$this->AppModel->update($Data,'reviewsid='.$v);
			}
		$url            =  M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));		
		ks_header($url);
    }
}
