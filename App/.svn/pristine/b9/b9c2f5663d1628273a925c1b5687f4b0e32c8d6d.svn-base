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



namespace Kesion\Model\App;
use Kesion\Model;
class PaperModel extends Model{
	public function updateOrderid($tmType){
		$sql = "UPDATE `$this->table` SET `orderId`=orderId-1 WHERE paperid =$tmType[paperid] and orderId > $tmType[orderId]";
		$GLOBALS['db']->execSql($sql);
	}
	//进入试卷列表
	public function paperlist($Data001){
		$setting        = appSetting($Data001['wxid'],$Data001['appid']);//获取App配置
		$category       = $this->cache->GetHCache('appcategory',$Data001['wxid']);//读出缓存
		$CategoryModel  = new CategoryModel('app_category');
		$papertypeModel = M('app_paper_type');
		$where          = 'where a.wxid='.$Data001['wxid'];		
		//分类
		$categoryid = null !==GF('categoryid') ? GF('categoryid'):0;
		if($categoryid!=0) {
			$where .= " and (b.parentidpath like '%$categoryid,%' or b.categoryid=$categoryid)";
		}	
		//关键字搜索
		$keyword = KS_S('keyword');
		$keytype = null !==GF('keytype') ? GF('keytype'):0;
	    if(!empty($keyword)){ 
		    if($keytype==1){$where.=" and a.Title like '%$keyword%'";
	        }elseif($keytype==2){$where.=" and c.typeName ='%$keyword%'";
			}elseif($keytype==3){$where.=" and a.inputer like '%$keyword%'";
			}elseif($keytype==0){$where.='';}		   
		}
		$status    = null !==GF('status') ? GF('status'):2;	
		$exam_type = null !==GF('exam_type') ? GF('exam_type'):0;	
		if($status ==0 || $status ==1 ){$where.=' and a.Status='.$status;}
		if($exam_type!=0){$where.=' and a.exam_type='.$exam_type;}
		$where=" as a left join $CategoryModel->table as b on a.categoryid = b.categoryid left join $papertypeModel->table as c on a.paperType = c.id $where";
		$options = $this->AppModel->getOptions('10',$where);//分页参数设置
		$page    = Page($options);
		$paper   = $this->AppModel->getPage($page,'a.paperid desc',$where);
		foreach($paper as $k =>$v){
			$paper[$k]['paperTypename'] = M('app_paper_type')->getOne('typeName','where wxid='.$Data001['wxid'].' and id='.$v['paperType']);
		}
		$result['page']      = $page;
		$result['values']    = $value;
		return $result;
	}
	//考试记录
	public function paperanswer($Data002){
		
	}
}