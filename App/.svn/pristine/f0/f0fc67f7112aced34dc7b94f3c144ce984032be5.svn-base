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

	public function getallnewAction(){
		header("Access-Control-Allow-Origin: *");
		$maxPerPage = null !=ChkClng(GF('maxPerPage')) ? ChkClng(GF('maxPerPage')):'50';
    	$picth  = ChkSQL(GF('pitch'))!='' ? ChkSQL(GF('pitch')):'';
    	$picth = strlen($picth)==1?intval($picth):$picth;
    	$categoryModel = M('app_category');
    	$db_newModel = M('app_news');
		$key=null !== GF('key') ? GF('key') : '' ;
		$wxid=null !== GF('wxid') ? GF('wxid') : '0' ;
		// $chargetype=null !== GF('chargetype') ? GF('chargetype') : 3 ;
		// $paper_level =null !== GF('paper_level') ? GF('paper_level') : '0' ;
		$where = "as a left join $categoryModel->table as b on a.categoryid = b.categoryid where a.status=1 and a.wxid = ".$wxid;
		if($key){
			$where .=" and (a.title like '%$key%')";
		}
//  	var_dump($picthcourse);
        $style          = null !==GF('style') ? GF('style'):1;
    	if($picth){
    		$picth = str_replace("@",",",$picth);
    		$where= $where.' and a.id in('.$picth.')';
    	}elseif($picth===0){
    		$options['totalput'] = 0;
    		$options['maxperpage'] = 50;

    		$page = Page($options);
    		$result['page'] = $page;
    		$result['style'] = $style;
    		$result['dt'] = array();
    		header("Content-type: application/json");
	        echo json_encode($result);exit;
    	}
		$options = $db_newModel->getOptions($maxPerPage,$where);//分页参数设置
		$options['now_page'] = null !==GF('p') ? GF('p'):'1';
		$page = Page($options);
		$dt = $db_newModel->getPage($page,'a.id desc',$where);
		foreach($dt as $k =>$v){
		 	$dt[$k]['portalurl']   = '/h5market/Minewsdetail?id='.$v['id'];
			$dt[$k]['adddate']     = date('Y/m/d',$v['adddate']);
			$dt[$k]['defaultpic']     =Img($v['defaultpic']);
		}
		// $answer = M('app_paper_answer');
		// foreach($dt as $k =>$v){
		// 	$dt[$k]['paperTime']   = $answer->getOne('count(id)','where id='.$v['id']);
		// 	$dt[$k]['portalurl']   = '/h5market/examin?id=='.$v['id'];
		// }
		$result['page'] = $page;
		$result['style'] = $style;
		$result['dt'] = $dt;
		header("Content-type: application/json");
        echo json_encode($result);exit;
	}
	//文章列表。
    public function indexAction(){
     	$maxPerPage = $this->getMaxPage('article/index.html');
     	$Data001['modeltype']   = 1;
     	$Data001['wxid']        = $GLOBALS['_DoM']['wxid'];
     	$Data001['maxPerPage']  = $maxPerPage;
     	$Data001['AppModel']    = $this->AppModel;
     	$ArticleModel     = M('App/ArticleModel');
		$result           = $ArticleModel->getArticle($Data001);

		$app_new = M('app_news');
     	$newAry = $app_new->getAll('where wxid=1519 and status!=-1 and status!=0 order by id  desc limit 13');

		$this->assign('categoryid',$result['categoryid']);
		$this->assign('newAry',$newAry);
		$this->assign('value',$result['value']);
		//$this->assign('categoryname',$categoryname);
		$this->assign('nowday1',$result['nowday1']);
		$this->assign('nowday',$result['nowday']);
	    $this->assign('page',$result['page']);
		$this->assign('dt',$result['dt']);
		$this->display('article/index.html');
    }
    //文章列表。ajax请求
    public function NewsAjaxAction(){
		$maxPerPage       = $this->getMaxPage('article/index.html');
		$Data001['modeltype']   = 2;
     	$Data001['wxid']  = $GLOBALS['_DoM']['wxid'];
     	$Data001['categoryid']  = ChkClng(KS_G("request.categoryid"));
     	$Data001['maxPerPage']  = $maxPerPage;
     	$Data001['p']           = ChkClng(KS_G("request.p"));;
     	$Data001['AppModel']    = $this->AppModel;
     	$ArticleModel     = M('App/ArticleModel');
		$result           = $ArticleModel->getArticle($Data001);
		header("Content-type: application/json");
	    echo json_encode($result);exit;
    }
	public function viewAction(){
		$id        = ChkClng(KS_G("request.id"));
		if(empty($id)){$id = $this->AppModel->getOne('id','where wxid='.$GLOBALS['_DoM']['wxid'].' limit 1');}
		$left_join = M('app_category');
		$where = 'as a left join `'.$left_join->table.'` as b on a.categoryid = b.categoryid where a.id ='.$id;
		$value = $this->AppModel->getRow($where);
		if(empty($value)){$this->assign('getMessage','您没有该资讯，到其他资讯看看哦');$this->display('404.html');exit;}
		$value['adddate'] = date('Y/m/d H:i:s',$value['adddate']);
		$GLOBALS['_DoM']['categoryid'] = $value['categoryid'];
		$content = explode(KS_C('PAGE_BREAK'),$value['content']);
		$options['now_page']   = null !==GF('p') ? GF('p'):'1';
		$options['maxperpage'] = 1;
	    $options['totalput']   = count($content);
		$page = Page($options);
		$dt   = $page->arrayPage($content);
		if(empty($dt))return null;
		//查询该网校所有新闻ID
		$newsid = $this->AppModel->getAll('where wxid='.$GLOBALS['_DoM']['wxid'],'id,title');
		foreach($newsid as $key =>$v){if($v['id'] == $id){$post = $key;}}
		$lastpost = $post-1;
		$nextpost = $post+1;
		if($post == 0){
			$last = '<a class="fc-hei fz-14">没有更多了</a>';
			if (isset($newsid[$nextpost]['title'])){
				$next = '<a class="fc-hei fz-14" href="'.M_URL('news','view',$newsid[$nextpost]['id']).'">'.$newsid[$nextpost]['title'].'</a>';
			}else{
				$next='';
			}
		}elseif($post == (count($newsid)-1)){
			$last = '<a class="fc-hei fz-14" href="'.M_URL('news','view',$newsid[$lastpost]['id']).'">'.$newsid[$lastpost]['title'].'</a>';
			$next = '<a class="fc-hei fz-14">没有更多了</a>';
		}else{
			$last = '<a class="fc-hei fz-14" href="'.M_URL('news','view',$newsid[$lastpost]['id']).'">'.$newsid[$lastpost]['title'].'</a>';
			$next = '<a class="fc-hei fz-14" href="'.M_URL('news','view',$newsid[$nextpost]['id']).'">'.$newsid[$nextpost]['title'].'</a>';
		}
		$this->assign('PreItem',$last);
		$this->assign('NextItem',$next);
		$this->assign('page',$page);
		$this->assign('content',$dt);
		$this->assign('field',$value);
		$this->assign('id',$id);
		$this->display('article/view.html');
    }
    public function view2Action(){
		$id        = ChkClng(KS_G("request.id"));
		$this->assign('id',$id);
		$this->display('article/acpassword.html');
    }
    public function checkpasswordAction(){
		$password  = ChkSQL(KS_G("request.password"));
		$id        = ChkClng(KS_G("request.id"));
		if($password!='1997'){
			echo '<script>alert("密码错误");history.go(-1);</script>';exit;
		}
		$url       = M_URL('news','view',$id);
		ks_header($url);
    }
}