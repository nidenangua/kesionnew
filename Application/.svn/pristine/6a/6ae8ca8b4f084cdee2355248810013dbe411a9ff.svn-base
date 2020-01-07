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
class OffwebController extends CommonController
{

	 /**
     * 问题解答
	  */
	 public function QuestionAction(){
	 	$now_page = null!==GF('p')?GF('p'):'1';
	 	$table = M('web_question_answer');
	 	$classify         = M('web_question_classify');//实例化云服务表
	 	$where  =' as a left join '.$classify->table.' as b on a.classify=b.categoryid';
	 	$options = $table->getOptions(5,$where);//分页参数设置
		$page = Page($options);
		$values = $table->getPage($page,'a.orderid desc',$where.' where 1=1','a.*,b.categoryname');
	    include  CURR_VIEW_PATH . "Offweb/Question/admin.questionIndex.php";
     }
	 /**
     * 添加、编辑问题解答
	  */
	 public function questionManageAction(){
	 	$table = M('web_question_classify');
     	$classifyary = $table->getAll();

	 	$values='';
	 	$id= ChkClng(KS_G('request.id'));
	 	if($id){
	 	$table = M('web_question_answer');
	 	$values = $table->getRow('where id='.$id);
	 	}
	    include  CURR_VIEW_PATH . "Offweb/Question/admin.questionManage.php";
     }
     /**
      * 保存问题解答
      */
	 public function questionManageDoSaveAction(){
         $id       = ChkSQL(KS_G('request.id'));
         $title = ChkSQL(KS_G('post.title'));
         $answer = ChkSQL(KS_G('post.answer'));
         $classify = ChkSQL(KS_G('post.classify'));
         $now_page = null!==GF('p')?GF('p'):'1';
         $table = M('web_question_answer');
         if(empty($title)||empty($answer)){
             KS_INFO("内容不能为空",0,M_URL('Offweb','shoadd','',GP('')));
             exit;
         }
         if ($id<=0){
             $data['title']    = $title;
             $data['answer']   = $answer;
             $data['classify'] = $classify;
             $data['adddate']  = time();
             $data['content']  = KS_G('post.content');
             $data['orderid']  = ChkClng(KS_G('post.orderid'));
             $table->doAdd($data,'id');
             KS_INFO("添加成功",0,M_URL('Offweb','Question','',GP('')));

         }else{
             $title    = ChkSQL(KS_G('post.title'));
             $classify = ChkSQL(KS_G('post.classify'));
             $answer   = ChkSQL(KS_G('post.answer'));
             $table    = M('web_question_answer');
             if(empty($title)||empty($answer)){
                 KS_INFO("内容不能为空",0,M_URL('Offweb','shoadd','',GP('')));exit;
             }
             $data['title']    = $title;
             $data['classify'] = $classify;
             $data['answer']   = $answer;
             $data['content']  = KS_G('post.content');
             $data['orderid']  = ChkClng(KS_G('post.orderid'));
             $table->update($data,' id='.$id);
             KS_INFO("修改成功",0,M_URL('Offweb','Question','',GP('p-'.$now_page)));
         }

     }

     /*
      * 删除问题
      */
     public function deleteQuestionAction(){
     	$now_page = null!==GF('p')?GF('p'):'1';
     	$id = ChkSQL(KS_G('request.id'));
     	$table = M('web_question_answer');
         if (gettype($id)!='array'){
             $id=explode(',',$id);
         }
         foreach($id as $k =>$v){
     		$table->delete(' id='.$v);
     	}

     	KS_INFO("删除成功",0,M_URL('Offweb','Question','',GP('p-'.$now_page)));
     }

     /**
      * 问题分类管理
      */
     public function questionClassifyIndexAction(){
     	$table = M('web_question_classify');
     	$now_page = null!==GF('p')?GF('p'):'1';
	 	$options = $table->getOptions(10,'');//分页参数设置
         $page = Page($options);
         $appcategory = $table->getPage($page,'categoryid desc');
     	include  CURR_VIEW_PATH . "Offweb/Question/admin.questionClassifyIndex.php";
     }
     /**
      * 添加、编辑问题分类
      */
     public function questionClassifyManageAction(){
     	$categoryid    = ChkClng(KS_G('request.id'));
     	if($categoryid){
     	   $table = M('web_question_classify');
     	   $category = $table->getRow('where categoryid='.$categoryid);
     	}

     	include  CURR_VIEW_PATH . "Offweb/Question/admin.questionClassifyManage.php";
     }
     /**
     * 保存添加、编辑问题分类
      */
     public function questionClassifyManageDoSaveAction(){
     	$categoryid    = ChkClng(KS_G('request.id'));
     	$table = M('web_question_classify');
         $Data['categoryname']  = ChkSQL(KS_G('post.categoryname'));
         $Rule['categoryname']  = '应用分类名称|isEmpty';
         if ($categoryid>0){
             Chkpost($Data,$Rule,$table);
             $table->update($Data,'categoryid='.$categoryid);
             KS_INFO('修改成功',3,M_URL('Offweb','questionClassifyIndex'));
         }else{
             Chkpost($Data,$Rule,$table);
             $table->doadd($Data,'categoryid');
             KS_INFO('添加成功',3,M_URL('Offweb','questionClassifyIndex'));
         }
     }
     /**
      * 删除问题分类
      */
     public function deleteQuestionClassifyAction(){
     	$now_page = null!==GF('p')?GF('p'):'1';
     	$id = ChkClng(KS_G('request.id'));
     	$table = M('web_question_classify');
     	$table->delete(' categoryid='.$id);
     	KS_INFO("删除成功",0,M_URL('Offweb','questionClassifyIndex','',GP('p-'.$now_page)));
     }





     /*******************************************************************帮助中心 begin  by 自由的飞 at 2019.5.9 **************************************************************/
     /**
      * 帮助中心
      */
     public function HelpcenterAction(){
         //   	echo '帮助中心';exit;
         $now_page = null!==GF('p')?GF('p'):'1';
         //       var_dump($now_page);
         $CategoryModel         = new CategoryModel('web_help_center');//实例化云服务表
         $classify         = M('web_help_classify');//实例化云服务表
         $where  =' as a inner join '.$classify->table.' as b on a.categoryid=b.categoryid';

         $options = $CategoryModel->getOptions(10,$where);//分页参数设置
         $options['now_page'] =$now_page;
		 $page = Page($options);
		 $values = $CategoryModel->getPage($page,'adddate desc',$where,'a.id,a.content,a.adddate,a.title,b.categoryname');
         include  CURR_VIEW_PATH . "Offweb/Help/admin.helpcenter.php";
     }
     /*
      * 删除帮助中心的内容
      */
     public function deleteHelpCenterAction(){
     	$now_page = null!==GF('p')?GF('p'):'1';
     	$id       = ChkSQL(KS_S('id'));
     	$table = M('web_help_center');
         if (gettype($id)!='array'){
             $id=explode(',',$id);
         }

     	foreach($id as $k =>$v){$table->delete(' id='.$v);}

     	KS_INFO("删除成功",0,M_URL('Offweb','Helpcenter','',GP('p-'.$now_page)));
     }
     /**
      * 添加，编辑帮助文档
      */
     public function helpManageAction(){
     	$now_page      = ChkClng(KS_S('p',1));
     	$id =ChkClng(KS_G('request.id'));
     	$values              =array();
     	$values['title']     ='';
     	$values['content']   ='';
     	$values['categoryid']='';
     	if($id){
     		$CategoryModel         = new CategoryModel('web_help_center');//实例化云服务表
             $classify         = M('web_help_classify');//实例化云服务表
             $where  =' as a inner join '.$classify->table.' as b on a.categoryid=b.categoryid where id='.$id;
             $values=$CategoryModel->getRow($where,'a.title,a.content,a.categoryid');

     	}
     	$appcategory = $this->cache->GetACache('helpcategory');//读取缓存
         include  CURR_VIEW_PATH . "Offweb/Help/admin.helpManage.php";
     }
     /**
      * 保存添加、修改帮助文档
      */
     public function helpManageDoSaveAction(){
         $id =ChkClng(KS_G('request.id'));
         $now_page      = ChkClng(KS_S('p',1));
         if ($id>0){
             $Data['categoryid']      = ChkClng(KS_G('post.parentid'));
             $Data['title']  = ChkSQL(KS_G('post.title'));
             $Data['content']  = KS_G('post.content');
             $CategoryModel         = new CategoryModel('web_help_center');//实例化云服务表
             $Rule['title']  = '标题名称|isEmpty';
             Chkpost($Data,$Rule,$CategoryModel);

             $CategoryModel->update($Data,'id='.$id);
			 $this->cache->PutACache('helpcategory');//存入缓存
             KS_INFO('修改成功',0,M_URL('Offweb','Helpcenter',GP('p-'.$now_page)));
         }else{
             $Data['categoryid']      = ChkClng(KS_G('post.parentid'));
             $Data['title']  = ChkSQL(KS_G('post.title'));
             $Data['content']  = ChkSQL(KS_G('post.content'));
             $Data['adddate']  = time();
             $CategoryModel         = new CategoryModel('web_help_center');//实例化云服务表
             $Rule['title']  = '标题名称|isEmpty';
             Chkpost($Data,$Rule,$CategoryModel);
             $CategoryModel->doAdd($Data,'id');
             //		$this->cache->PutACache('helpcategory');//存入缓存
             KS_INFO('添加成功',0,M_URL('Offweb','Helpcenter',GP('p-'.$now_page)));
         }
     }
	 /**
	  * 帮助中心分类
	  */
	 public function showclassifyAction(){
    	$CategoryModel = new CategoryModel('web_help_classify');
        $where='where 1=1';
		$options       = $CategoryModel->getOptions('15',$where);//分页参数设置
		$page          = Page($options);
		$appcategory   = $CategoryModel->getPage($page,'rootid,orderid',$where);
		include  CURR_VIEW_PATH . "Offweb/Help/admin.classifylist.php";
     }
     public function changeStatusAction(){
     	$id= KS_G('get.id');
     	$status =GF('status');
     	$now_page = null!==GF('p')?GF('p'):'1';
     	$data['status'] = $status;
     	$CategoryModel = new CategoryModel('web_help_classify');
     	$CategoryModel->update($data,'categoryid='.$id);
     	$res        = $this->cache->PutACache('helpcategory');//取出缓存
     	KS_INFO("批量操作成功",0,M_URL('Offweb','showclassify','',GP('p-'.$now_page)));
     }

     /**
      * 添加，编辑分类入口
      */
     public function categoryManageAction(){

         $now_page      = ChkClng(KS_S('p',1));
         $categoryid    = ChkClng(KS_G('request.id'));
         if ($categoryid>0){
             $CategoryModel = new CategoryModel('web_help_classify');
             $category      = $CategoryModel->getRow("where categoryid=$categoryid limit 1");
         }

		$appcategory = $this->cache->GetACache('helpcategory');//读取缓存
		include  CURR_VIEW_PATH . "Offweb/Help/admin.classifyManage.php";
     }
	 /**
	  * 保存添加/修改分类
	  */
	 public function categoryManageDoSaveAction(){
         $now_page              = ChkClng(KS_S('p',1));
         $categoryid            = ChkClng(KS_G('request.id'));//表ID
         if ($categoryid<=0){
             $Data['parentid']      = ChkClng(KS_G('post.parentid'));
             $CategoryModel         = new CategoryModel('web_help_classify');//实例化云服务表
             $parentid = $CategoryModel->getOne('depth','where categoryid='.$Data['parentid']);
             if($parentid==4){
                 KS_INFO('不能添加第五级',0,M_URL('Offweb','addCategory'));
             }
             $Data['categoryname']  = ChkSQL(KS_G('post.categoryname'));

             $Rule['categoryname']  = '应用分类名称|isEmpty';
             //$Rule['categoryename'] = '分类英文名称|isEmpty,isEnglish';
             Chkpost($Data,$Rule,$CategoryModel);
             $CategoryModel->doaddCategory($Data,'categoryid');
             $this->cache->PutACache('helpcategory');//存入缓存
             KS_INFO('添加成功',0,M_URL('Offweb','showclassify'));
         }else{
             $Data['categoryname']  = ChkSQL(KS_G('post.categoryname'));
             $CategoryModel         = new CategoryModel('web_help_classify');
             $Rule['categoryname']  = '应用分类名称|isEmpty';
             //$Rule['categoryename'] = '分类英文名称|isEmpty,isEnglish';
             Chkpost($Data,$Rule,$CategoryModel,"categoryid!=$categoryid");
             $CategoryModel->update($Data,"categoryid=$categoryid");
             $this->cache->PutACache('helpcategory');//存入缓存
             $url = M_URL('Offweb','showclassify','',GP('p-'.$now_page));
             KS_INFO('修改成功',0,$url);
         }

     }
	 /**
	  * 删除帮助中心分类
	  */
	 public function deleteCategoryAction(){
		$now_page      =  ChkClng(KS_S('p',1));
	    $categoryid    = KS_G('request.id');//表ID
		$CategoryModel = new CategoryModel('web_help_classify');//实例化云服务表
		$categoryRe    = $CategoryModel->getRow("where categoryid = $categoryid limit 1");
		if($categoryRe['child']>0){
		$deleNum = $GLOBALS['db']->getOne("select count(*) from `$CategoryModel->table` where parentidpath like '%$categoryid,%' or categoryid=$categoryid");
		}else{$deleNum = 1;}
	    $CategoryModel->dodelCategory($categoryid);
		$GLOBALS['db']->execSql("UPDATE `$CategoryModel->table` SET `child`=child-1 WHERE categoryid=$categoryRe[parentid]");
		if($categoryRe['parentid']==0){
			$GLOBALS['db']->execSql("UPDATE `$CategoryModel->table` SET `rootid`=rootid-1 WHERE rootid>$categoryRe[rootid]");
		}else{
			$GLOBALS['db']->execSql("UPDATE `$CategoryModel->table` SET `orderid`=orderid-$deleNum WHERE orderid>$categoryRe[orderid] and rootid=$categoryRe[rootid]");
		}
		$this->cache->PutACache('helpcategory');//存入缓存
		$url = M_URL('Offweb','showclassify','',GP('p-'.$now_page));
		ks_header($url);
     }
	 /**
     * 帮助中心一级分类排序
	  */
	 public function byOneAction(){
		$CategoryModel = new CategoryModel('web_help_classify');
		$options       = $CategoryModel->getOptions('5','where parentid=0');//分页参数设置
		$page          = Page($options);
		$appcategory   = $CategoryModel->getPage($page,'rootid,orderid','where parentid=0');
		include  CURR_VIEW_PATH . "Offweb/Help/admin.category_obyone.php";
     }
	 /**
	  * 保存一级排序
	  */
	 public function byOneUpAction(){
		$now_page      =  ChkClng(KS_S('p',1));
		$categoryid    = ChkClng(KS_G('request.id'));
		$rootid        = ChkClng(KS_G('post.rootid'));
		$MoveNum       = ChkClng(KS_G('post.MoveNum'));
		$CategoryModel = new CategoryModel('web_help_classify');
		$GLOBALS['db']->execSql("UPDATE `$CategoryModel->table` SET `rootid`=rootid+1 WHERE rootid>$rootid-$MoveNum-1 and rootid<$rootid");
		$GLOBALS['db']->execSql("UPDATE `$CategoryModel->table` SET `rootid`=$rootid-$MoveNum WHERE parentidpath like '%$categoryid,%' or categoryid=$categoryid");
		$this->cache->PutACache('helpcategory');//存入缓存
		$url = M_URL('Offweb','byOne','',GP('p-'.$now_page));
		KS_INFO('修改成功',0,$url);
     }
	 public function byOneDownAction(){
		$now_page   =  ChkClng(KS_S('p',1));
		$categoryid = ChkClng(KS_G('request.id'));
		$rootid     = ChkClng(KS_G('post.rootid'));
		$MoveNum    = ChkClng(KS_G('post.MoveNum'));
		$CategoryModel = new CategoryModel('web_help_classify');
		$GLOBALS['db']->execSql("UPDATE `$CategoryModel->table` SET `rootid`=rootid-1 WHERE rootid<$rootid+$MoveNum+1 and rootid>$rootid");
		$GLOBALS['db']->execSql("UPDATE `$CategoryModel->table` SET `rootid`=$rootid+$MoveNum WHERE parentidpath like '%$categoryid,%' or categoryid=$categoryid");
        $this->cache->PutACache('helpcategory');//存入缓存
		$url = M_URL('Offweb','byOne','',GP('p-'.$now_page));
		KS_INFO('修改成功',0,$url);
     }
	 /**
     * N级分类排序
	  */
	 public function byAllAction(){
		$CategoryModel = new CategoryModel('web_help_classify');
		$options       = $CategoryModel->getOptions('10');//分页参数设置
		$page          = Page($options);
		$appcategory   = $CategoryModel->getPage($page,'rootid,orderid');
		include  CURR_VIEW_PATH . "Offweb/Help/Admin.category_obyall.php";
     }
	 //向上移动
	 public function byAllUpAction(){
		$now_page      =  ChkClng(KS_S('p',1));
		$categoryid    = ChkClng(KS_G('request.id'));
		$MoveNum       = ChkClng(KS_G('post.MoveNum'));
		$CategoryModel = new CategoryModel('web_help_classify');
		//要修改排序的分类（祖先这一条记录）（在下方）
		$changeCate = $CategoryModel->getRow("where categoryid=$categoryid limit 1");
		if($changeCate['child']>0){
		//要修改分类的长度（祖先和子孙的总长度）
		$changeLen = $GLOBALS['db']->getOne("select count(*) from `$CategoryModel->table` where parentidpath like '%$changeCate[parentidpath],%' or categoryid=$categoryid");
		}else{$changeLen=1;}//要修改分类的长度（祖先和子孙的总长度）
		//用修改分类（祖先这一条记录）的orderid和移动的数量查出	（最上方的分类）
	    $upCate = $GLOBALS['db']->getRow("select * FROM `$CategoryModel->table` where parentid=$changeCate[parentid] and orderid<=$changeCate[orderid] order by orderid desc limit $MoveNum,1");
		//（最上方分类）的orderid等于（第一个分类）的orderid
		$firstOrderid = $upCate['orderid'];
		//先把不是修改的分类（修改分类orderid减一到最上方的orderid这个范围）移下去--加
		$GLOBALS['db']->execSql("UPDATE `$CategoryModel->table` SET `orderid`=orderid+$changeLen WHERE orderid>=$firstOrderid and orderid<=$changeCate[orderid]-1 and rootid=$changeCate[rootid]");
		//再把要修改的分类移上去（移多少？减
		//所以没修改前的orderid减去（要修改的分类）修改后的orderid就是要移动的数量了！！！完美
		$GLOBALS['db']->execSql("UPDATE `$CategoryModel->table` SET `orderid`=orderid-($changeCate[orderid]-$firstOrderid) WHERE parentidpath like '%$changeCate[parentidpath],%' or categoryid=$categoryid");
	    $this->cache->PutACache('helpcategory');//存入缓存
		$url = M_URL('Offweb','byAll','',GP('p-'.$now_page));
		KS_INFO('修改成功',0,$url);
     }
	 //--------------------------------------向下移动----------------------------------------------//
	 public function byAllDownAction(){
		$now_page      = ChkClng(KS_S('p',1));
		$categoryid    = ChkClng(KS_G('request.id'));
		$MoveNum       = ChkClng(KS_G('post.MoveNum'));
		$CategoryModel = new CategoryModel('web_help_classify');
		//要修改排序的分类（祖先这一条记录）（在上方）
		$changeCate    = $CategoryModel->getRow("where categoryid=$categoryid limit 1");
		if($changeCate['child']>0){
		//要修改分类的长度（祖先和子孙的总长度）
		$changeLen = $GLOBALS['db']->getOne("select count(*) from `$CategoryModel->table` where parentidpath like '%$changeCate[parentidpath],%' or categoryid=$categoryid");
		}else{$changeLen=1;}//要修改分类的长度（祖先和子孙的总长度）
		//用修改分类（祖先这一条记录）的orderid和移动的数量查出	（最下方的分类）
	    $lowCate = $GLOBALS['db']->getRow("select * FROM `$CategoryModel->table` where parentid=$changeCate[parentid] and orderid>=$changeCate[orderid] order by orderid asc limit $MoveNum,1");
		//查出最下方分类的长度
		$lowLen = $GLOBALS['db']->getOne("select count(*) from `$CategoryModel->table` where parentidpath like '%$lowCate[parentidpath],%' or categoryid=$lowCate[categoryid]");
		//（最下方分类）的orderid加上长度，等于（最后一个分类）的orderid
		$lastOrderid = $lowCate['orderid']+$lowLen-1;
		//先把不是修改的分类（修改分类orderid加上他的长度再加一到最下方的orderid这个范围）移上来--减
		$GLOBALS['db']->execSql("UPDATE `$CategoryModel->table` SET `orderid`=orderid-$changeLen WHERE orderid>=$changeCate[orderid]+$changeLen and orderid<=$lastOrderid and rootid=$changeCate[rootid]");
		//再把要修改的分类移下去（移多少？加
		//(最后一个分类）的orderid减去（要修改的分类）的长度--求（最后一个分类）的现在的orderid
		//(要修改的分类)修改后的orderid等于最后一个分类的现在的orderid加一
		//所以（要修改的分类）修改后的orderid减去没修改前的orderid就是要移动的数量了！！！完美
		$GLOBALS['db']->execSql("UPDATE `$CategoryModel->table` SET `orderid`=orderid+$lastOrderid-$changeLen+1-$changeCate[orderid] WHERE parentidpath like '%$changeCate[parentidpath],%' or categoryid=$categoryid");
		$this->cache->PutACache('helpcategory');//存入缓存
		$url = M_URL('Offweb','byAll','',GP('p-'.$now_page));
		KS_INFO('修改成功',0,$url);
     }

  /******************************************************************帮助中心 end ********************************************************************************************/




/*************************************************************合作商家   begin******************************************************************************************/

     /**
      * 合作案例列表
      */
     public function CaseAction(){
     	$now_page      = ChkClng(KS_S('p',1));
     	$adddate      = ChkClng(null !==GF('adddate') ? GF('adddate'):'1');
     	$Mode = M('web_business');
     	$options       = $Mode->getOptions('5');//分页参数设置
        $option['now_page'] =$now_page;
		$page          = Page($options);
		$value   = $Mode->getPage($page,'id desc');
		foreach($value as $k =>$v){
		        $str='https://store.kesion.com';
                if(!empty($v['picture'])){
	           	  $img  =  Img($v['picture'],1);
	           	  if(stristr($img,'https')){//判断是否有前缀
	           	  	$value[$k]['picture']=$img;
	           	  }else{
		           	   if(stristr($img,'.com')){//判断是否有域名
		           	  	$value[$k]['picture']='https:'.$img;
		           	  }else{
		           	  	$value[$k]['picture']=$str.$img;
		           	  }
	           	  }
	           }else{
	              $value[$k]['picture']  =  '';
	           }
			}
     	include  CURR_VIEW_PATH . "Offweb/Case/admin.caseList.php";
     }
     /**
      * 添加，编辑案例
      */
     public function caseManageAction(){

    	$option = null !==GF('option') ? GF('option'):'0';//选项卡
    	$now_page =  ChkClng(KS_S('p',1));
    	$value='';
    	$id = KS_G('request.id');
    	if($id){
	    	$Mode = M('web_business');
	    	$value = $Mode->getRow('where id='.$id);
    	}

    	include  CURR_VIEW_PATH . "Offweb/Case/admin.addCase.php";
    }
     /**
      * 保存案例
      */
     public function caseManageDoSaveAction(){
         $id = ChkSQL(KS_G('request.id'));
         if ($id<=0){
             $filename = ChkSQL(KS_G('post.filename'));
             $fileurl = ChkSQL(KS_G('post.fileurl'));
             $level = ChkSQL(KS_G('post.level'));
             $table = M('web_business');
             if(empty($filename)||empty($fileurl)){
                 KS_INFO("内容不能为空",0,M_URL('Offweb','caseManage','',GP('')));
                 exit;
             }
             $data['name'] =$filename;
             $data['picture'] = $fileurl;
             $data['picture'] = $fileurl;
             $data['adddate'] = time();
             $table->doAdd($data,'id');
             KS_INFO("添加成功",0,M_URL('Offweb','Case','',GP('')));
         }else{
             $now_page =  ChkClng(KS_S('p',1));
             $filename = ChkSQL(KS_G('post.filename'));
             $fileurl = ChkSQL(KS_G('post.fileurl'));
             $level = ChkSQL(KS_G('post.level'));
             $table = M('web_business');
             if(empty($filename)||empty($fileurl)){
                 KS_INFO("内容不能为空",0,M_URL('Offweb','caseManage','',GP('')));
                 exit;
             }
             $data['name'] =$filename;
             $data['level'] =$level;
             $data['picture'] = $fileurl;
             $data['adddate'] = time();
             $table->update($data,'id='.$id);
             KS_INFO("修改成功",0,M_URL('Offweb','Case','',GP('p-'.$now_page)));
         }

    }

    /**
     * 删除案例
     */
    public function delCaseAction(){
     	$now_page = null!==GF('p')?GF('p'):'1';
     	$id = ChkSQL(KS_S('id'));
     	$table = M('web_business');
         if (gettype($id)!='array'){
             $id=explode(',',$id);
         }

     	foreach($id as $k =>$v){
     		$table->delete(' id='.$v);
     	}

     	KS_INFO("删除成功",0,M_URL('Offweb','Case','',GP('p-'.$now_page)));
    }

    /*************************************************************合作商家   end******************************************************************************************/




public function DailyinfoAction(){
    	$this->AppModel   = M('web_news');
    	$this->AppName    = 'Offweb';
		$status=KS_S('status',3);
		$hits=null !==GF('hits') ? GF('hits'):'0';
		$recommend=null !==GF('recommend') ? GF('recommend'):'0';
		$allowcomment=null !==GF('allowcomment') ? GF('allowcomment'):'0';
		$roll=null !==GF('roll') ? GF('roll'):'0';
		$slide=null !==GF('slide') ? GF('slide'):'0';
		$hot=null !==GF('hot') ? GF('hot'):'0';
		$a=null !==GF('a') ? GF('a'):'0';
        $wxid=1;   //呈现在网校为1
		$where = "where 1=1";
		//$where = "where a.wxid =$this->wxid and a.usrid=$this->usrid";

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
		   elseif($keytype==3){$where.=" and a.inputer like '%$keyword%'";}
		}
		//分类
		$categoryid=null !==GF('categoryid') ? GF('categoryid'):0;
		if($categoryid!=0) {$where .= "and (b.parentidpath like '%$categoryid,%' or b.categoryid=$categoryid)";}
		$category = $this->cache->GetHCache('appcategory',$this->wxid);//读出缓存
		//排序
		if($hits==1){$byname = 'hits desc';}
		else{$byname = 'adddate desc';}
		$left_join   = M('app_category');
		$where       = "as a left join `$left_join->table` as b on a.categoryid = b.categoryid $where";
		$options     = $this->AppModel->getOptions('10',$where);//分页参数设置
		$page        = Page($options);
		$values      = $this->AppModel->getPage($page,$byname,$where,'b.*,a.*');
		$info          = $this->cache->GetA('domaininfo','wxid',$this->wxid,'',true);//读出缓存
		include  CURR_VIEW_PATH . "Offweb/article_list.php";
    }
    //进入新闻增加页面
	public function addArticleAction(){
		$value='';
		include  CURR_VIEW_PATH . "Offweb/article_add.php";
	}
	//新闻增加
	public function doaddArticleAction(){
		$this->AppModel     = M('App/ArticleModel/web_news');
		$Data['userid']     = $this->userid;
		$Data['wxid']       = $this->wxid;
		$Data['title']      = ChkSQL(KS_G("post.title"));
		$Data['abstract']   = ChkSQL(KS_G('post.abstract'));
		$Data['content']    = ChkSQL(KS_G('post.content'));
		$Data['inputer']    = ChkSQL(KS_G('post.inputer'));
		$Data['categoryid'] = ChkClng(KS_G('post.categoryid'));
		$Data['recommend']  = ChkClng(KS_G('post.recommend'));
		$Data['slide']      = ChkClng(KS_G('post.slide'));
		$Data['hot']        = ChkClng(KS_G('post.hot'));
		$Data['allowcomment'] = ChkClng(KS_G('post.allowcomment'));
		$Data['roll']       = ChkClng(KS_G('post.roll'));
		$Data['status']     = ChkSQL(KS_G('post.status'));
	    $Data['adddate']    = ChkSQL(strtotime(KS_G('post.adddate')));
//		$Rule['title']      = '新闻标题|isEmpty';
//		$Rule['categoryid'] = '分类|isEmpty';
		$Rule['inputer']    = '录入员|isEmpty';;
//		$Rule['adddate']    = '录入时间|isEmpty';
		Chkpost($Data,$Rule,$this->AppModel);
		$this->AppModel->doaddNews($Data,'id');
		$url1=M_URL('Offweb','addArticle','',GP(''));
		$url2=M_URL('Offweb','Dailyinfo','',GP(''));
		KS_INFO("添加成功，是否继续添加",1,$url1,$url2);
	}
	//进入编辑页面
	public function editArticleAction(){
		$this->AppModel = M('App/ArticleModel/web_news');
		$now_page =  ChkClng(KS_S('p',1));
		$id       =  KS_G('request.id');
		$value    =  $this->AppModel->getRow("where id=$id limit 1");
		include  CURR_VIEW_PATH . "Offweb/article_add.php";
	}
	//新闻编辑
	public function doEditArticleAction(){
		$this->AppModel = M('App/ArticleModel/web_news');
		$now_page       =  ChkClng(KS_S('p',1));
		$id             = ChkClng(KS_G('request.id'));//表ID
		$Data['title']       = ChkSQL(KS_G('post.title'));
		$Data['inputer']     = ChkSQL(KS_G('post.inputer'));
		$Data['abstract']    = ChkSQL(KS_G('post.abstract'));
		$Data['content']     = ChkSQL(KS_G('post.content'));
		$Data['recommend']   = ChkClng(KS_G('post.recommend'));
		$Data['slide']       = ChkClng(KS_G('post.slide'));
		$Data['hot']         = ChkClng(KS_G('post.hot'));
		$Data['allowcomment']= ChkClng(KS_G('post.allowcomment'));
		$Data['roll']=ChkClng(KS_G('post.roll'));
		$Data['status'] = ChkSQL(KS_G('post.status'));
		$Data['categoryid']=ChkClng(KS_G('post.categoryid'));
		$Data['adddate']=ChkSQL(strtotime(KS_G('post.adddate')));

//		$Rule['title']      = '新闻标题|isEmpty';
//		$Rule['categoryid'] = '分类|isEmpty';
		$Rule['inputer']    = '录入员|isEmpty';
		Chkpost($Data,$Rule,$this->AppModel,"id!=$id");
		$this->AppModel->update($Data,"id=$id");
		$url=M_URL('Offweb','Dailyinfo','',GP('p-'.$now_page));
		KS_INFO("保存成功",0,$url);
	}
	//删除新闻
	public function deleteAction(){
		 $this->AppModel = M('App/ArticleModel/web_news');
		 $id       =  ChkClng(KS_G('request.id'));
		 $now_page =  ChkClng(KS_S('p',1));
		 $this->AppModel->delete("id = $id");
		 $url      =  M_URL('Offweb','Dailyinfo','',GP('p-'.$now_page));
		 ks_header($url);
	}
	//批量删除
	public function batchAction(){
		$this->AppModel = M('App/ArticleModel/web_news');
		$id       = isset($_POST["check"])?$_POST["check"]:'';
		$now_page =  ChkClng(KS_S('p',1));
		if(empty($id)){KS_INFO("请选择");}
		foreach ($id as $k=>$v ){$this->AppModel->delete("id=$v");}
		$url      =  M_URL('Offweb','Dailyinfo','',GP('p-'.$now_page));
		KS_INFO("删除成功",0,$url);
	}
}