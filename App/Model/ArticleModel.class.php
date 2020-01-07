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
class ArticleModel extends Model{
	public function getArticle($Data001){
		$stat  = KS_S('status',3);
		$where = 'where a.wxid='.$Data001['wxid'];
		if($stat==3){$where.= " and ( a.status=1 or a.status = 2)";}//状态筛选
		elseif($stat==1){$where.= " and a.status=1"; }
		elseif($stat==0){$where .= " and a.status=0";}
		$keyword=KS_S('keyword');//搜索
		$keytype=KS_S('keytype',1);
		if(!empty($keyword)){//判断是否输入关键字
		    if($keytype==1){$where.=" and a.title like '%$keyword%'";}
		    elseif($keytype==2){$where.=" and a.inputer like '%$keyword%'";} 
		}
		$categoryid = isset($Data001['categoryid'])?$Data001['categoryid']:(null !==GF('categoryid') ? GF('categoryid'):0);//分类	
		$categoryid = str_replace('&tdsourcetag=s_pctim_aiomsg','',$categoryid);
		if($categoryid!=0){$where .= " and (b.parentidpath like '%$categoryid,%' or b.categoryid=$categoryid)";}	
		$appcategory = $this->cache->GetHCache('appcategory',$Data001['wxid']);//取出缓存
		$sort = null !==GF('sort') ? GF('sort'):1;//升降序
	    switch($sort){
	    	case 1:$byname = 'a.adddate desc';break;
	    	case 2:$byname = 'a.adddate asc';break;
	    	case 3:$byname = 'a.adddate desc';break;
	    	case 4:$byname = 'a.adddate asc';break;
	    	case 5:$byname = 'a.adddate desc';break;
	    	case 6:$byname = 'a.adddate asc';break;
	    	case 7:$byname = 'a.adddate desc';break;
	    	case 8:$byname = 'a.adddate asc';break;
	    	default:$byname = 'a.adddate desc';break;
	    }
		//需要连表的在最后left join
		$left_join = M('app_category');
		$where     = "as a left join `$left_join->table` as b on a.categoryid = b.categoryid $where";
		$options   = $Data001['AppModel']->getOptions($Data001['maxPerPage'],$where);//分页参数设置
		$options['now_page'] = isset($Data001['p'])?$Data001['p']:(null !==GF('p') ? GF('p'):'1');
		$page    = Page($options);
		$dt      = $Data001['AppModel']->getPage($page,$byname,$where,'b.*,a.*'); 
		if($Data001['modeltype']==2){
			foreach($dt as $k=>$v){
				$dt[$k]['adddate']    = date('Y-m-d',$v['adddate']);
				$dt[$k]['defaultpic'] = Img($v['defaultpic']);
			}
		}
		$nowday1 = null !==GF('nowday') ? GF('nowday'):time();//搜索date('Y-m-d',time());
		$nowday  = date('Y-m-d',$nowday1);
		$start   = mktime(0,0,0,date("m",$nowday1),date("d",$nowday1),date("Y",$nowday1));  
        $end     = mktime(23,59,59,date("m",$nowday1),date("d",$nowday1),date("Y",$nowday1)); 
		$web_news     =  M('App/ArticleModel/web_news');
		$value        =  $web_news->getRow("where adddate>".$start." and adddate<".$end."  order by adddate desc limit 1");
		$result['categoryid'] = $categoryid;
		$result['value']      = $value;
		$result['appcategory']= $appcategory;
		$result['nowday1']    = $nowday1;
		$result['nowday']     = $nowday;
		$result['page']       = $page;	
		$result['dt']         = $dt;
		return $result;
	}
	//每日资讯
	public function webnews($Data002){
		$nowday1 = isset($Data002['nowday'])?$Data002['nowday']:(null !==GF('nowday') ? GF('nowday'):time());//搜索date('Y-m-d',time());
		$nowday  = date('Y-m-d',$nowday1);
		$start   = mktime(0,0,0,date("m",$nowday1),date("d",$nowday1),date("Y",$nowday1));  
        $end     = mktime(23,59,59,date("m",$nowday1),date("d",$nowday1),date("Y",$nowday1)); 
		$web_news     =  M('App/ArticleModel/web_news');
		$value        =  $web_news->getRow("where adddate>".$start." and adddate<".$end."  order by adddate desc limit 1");
		$result['value']      = $value;
		$result['nowday1']    = $nowday1;
		$result['nowday']     = $nowday;
		return $result;
	}
	public function getNews(){
		$sql  = "select * FROM $this->table where userid=".$_SESSION['user']['userid']." ORDER BY adddate desc";
        $news = $GLOBALS['db']->getAll($sql);
        return $news;
	}
	public function doaddNews($Data,$prikeyname){
		$prikeyname = ChkSQL($prikeyname);
		$Data["$prikeyname"] = $GLOBALS['db']->getMaxValue($this->table,"$prikeyname")+1;
		$GLOBALS['db']->insert($this->table,$Data);
	}
	/**
	 * 删除
	 * @param mixed $newsid 
	 */
	public function dodelNews($newsid){
		$sql="delete from $this->table where newsid=".$newsid;//删除对应图片
		$GLOBALS['db']->execSql($sql);
	}
	public function likeSearch($search){
		$sql = "select * FROM $this->table where userid=".$_SESSION['user']['userid']." and title like '%".$search."%' or   intro like '%".$search."%' ORDER BY adddate desc";
		$news = $GLOBALS['db']->getAll($sql);
		return $news;
	}
	//设置分页参数
	public function getNewsOptions($maxperpage,$where=''){
		$maxperpage   = ChkClng($maxperpage);
		$where        = ChkSQL($where);
		$app_news     = new  Model('app_news');
		$app_category = new  Model('app_category');
		$total        = $GLOBALS['db']->getOne("select count(*) from `$app_news->table` as a left join `$app_category->table` as b on a.categoryid = b.categoryid $where");
		$options      = array('totalput' => $total,    //总行数  
             'maxperpage'  => $maxperpage,        //每页显示量  
        );  
        return $options;
    }
	//获得分页后其中一页的数据
	public function getNewsPage($page,$byname,$where=''){
		$byname       = ChkSQL($byname);
		$where        = ChkSQL($where);
		$app_news     = M('app_news');
		$app_category = new  Model('app_category');
        $pagevalue    = $GLOBALS['db']->getAll("select * from `$app_news->table` as a left join `$app_category->table` as b on a.categoryid = b.categoryid $where order by $byname limit $page->first_row , $page->maxperpage");
        return $pagevalue;
    }
}