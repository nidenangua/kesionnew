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
class InterfaceController extends CommonController
{
	/*	
	 * 显示优惠券管理页面
	 */
	public function indexAction(){
		$keytype=ChkClng(GF('keytype') ? GF('keytype'):'1');
		$keyword=ChkSQL(GF('keyword') ? GF('keyword'):'');
		$type=ChkClng(GF('type') ? GF('type'):0);
		$now_page=ChkClng(GF('p') ? GF('p'):'1'); 
	 	// if($type!=0){ $where= ' where a.parentid='.$type;}else{$where = '';}
	 	$where=' where 1=1';
	 	if(!empty($keyword)){
           if($keytype==1){
				$where="$where and a.name like '%$keyword%'";
			}else if($keytype==2){
				$where="$where and b.name like '%$keyword%'";
			}
	 	}
		$db_interface =M('web_interface');			
		$db_classify =M('web_interface_classify');			
		$where = "as a left join `$db_classify->table` as b on a.parentid = b.id $where";
		$options = $db_interface->getOptions('10',$where);//分页参数设置
		$page = Page($options);
		$values = $db_interface->getPage($page,'id desc',$where,'a.*,b.name as classifyname');
		include  CURR_VIEW_PATH . "Interface/interface_index.php";
	}
    public function classifyIndexAction()
    {
    	$orderid    = null !==GF('orderid') ? GF('orderid'):'1';
    	$classifyid    = null !==GF('classifyid') ? GF('classifyid'):'1';
		$money    = null !==GF('money') ? GF('money'):'1';
    	$keytype=ChkClng(GF('keytype') ? GF('keytype'):'1');
		$keyword=ChkSQL(GF('keyword') ? GF('keyword'):'');
    	$db_classify =M('web_interface_classify');			
		if(!empty($keyword)){
			$where="where  name like '%$keyword%'";
	 	}else{
	 		$where = '';
	 	}
	 	$orderby[GN('orderid')] = 'orderid/orderid';
        $orderby[GN('classifyid')]         = 'classifyid/id';

		$now_page=ChkClng(GF('p') ? GF('p'):'1'); 
		$options = $db_classify->getOptions('10',$where);//分页参数设置
		$page = Page($options);
		$values = $db_classify->getPage($page,OB($orderby),$where,'*');
		include  CURR_VIEW_PATH . "Interface/interface_classify.php";
    }
    public function showAddCAction(){
    	$id = ChkClng(KS_G('get.id'));
    	if($id){
    		$db_classify =M('web_interface_classify');
    		$info = $db_classify->getRow('where id='.$id);
    	}
    	$now_page=ChkClng(GF('p') ? GF('p'):'1');
    	include  CURR_VIEW_PATH . "Interface/add_classify.php";
    }
    public function saveClassifyAction(){
    	$db_classify =M('web_interface_classify');
    	$Data['name'] = ChkSQL(KS_G('post.classify'));
    	$Data['orderid'] = ChkSQL(KS_G('post.orderid'));
    	$db_classify->doadd($Data,'id');
    	$now_page=ChkClng(GF('p') ? GF('p'):'1');
    	$url =  M_URL('home/Interface','classifyIndex','',GP('p-'.$now_page));
		KS_INFO('',3,$url);
    }
    public function editSaveAction(){
        $id = ChkClng(KS_G('get.id'));
    	$db_classify =M('web_interface_classify');
    	$Data['name'] = ChkSQL(KS_G('post.classify'));
    	$Data['orderid'] = ChkSQL(KS_G('post.orderid'));
    	$db_classify->update($Data,'id='.$id);
    	$now_page=ChkClng(GF('p') ? GF('p'):'1');
    	$url =  M_URL('home/Interface','classifyIndex','',GP('p-'.$now_page));
		KS_INFO('',3,$url);
    }
    public function showAddIAction(){
    	$id = ChkClng(KS_G('get.id'));
    	$db_interface =M('web_interface');
    	if($id){
    		$info = $db_interface->getRow('where id='.$id);
    	}
    	$db_classify =M('web_interface_classify');
    	$values =$db_classify->getAll('');
    	$now_page=ChkClng(GF('p') ? GF('p'):'1');
    	include  CURR_VIEW_PATH . "Interface/interface_add.php";
    }
    public function doaddInterfaceAction(){

    	$Data['name'] = ChkSQL(KS_G('post.name'));
    	$Data['interfaceName'] = ChkSQL(KS_G('post.interfaceName'));
    	$Data['controller'] = ChkSQL(KS_G('post.controller'));
    	$Data['postway'] = ChkClng(KS_G('post.postway'));
    	$Data['parentid'] = ChkClng(KS_G('post.parentid'));
    	$db_interface =M('web_interface');
    	$now_page=ChkClng(GF('p') ? GF('p'):'1');
    	$db_interface->doadd($Data,'id');
    	$url =  M_URL('home/Interface','index','',GP('p-'.$now_page));
		KS_INFO('',3,$url);
    }
    public function doeditInterfaceAction(){
    	$id = ChkClng(KS_G('get.id'));
    	$Data['name'] = ChkSQL(KS_G('post.name'));
    	$Data['interfaceName'] = ChkSQL(KS_G('post.interfaceName'));
    	$Data['controller'] = ChkSQL(KS_G('post.controller'));
    	$Data['postway'] = ChkClng(KS_G('post.postway'));
    	$Data['parentid'] = ChkClng(KS_G('post.parentid'));
    	$db_interface =M('web_interface');
    	$now_page=ChkClng(GF('p') ? GF('p'):'1');
    	$db_interface->update($Data,'id='.$id);
    	$url =  M_URL('home/Interface','index','',GP('p-'.$now_page));
		KS_INFO('',3,$url);
    }
    //删除接口
    public function deleteInterfaceAction(){
    	$id = ChkClng(KS_G('get.id'));
    	$db_interface =M('web_interface');
    	$db_interface->delete('id='.$id);
    	$db_parameter =M('web_interface_parameter');
    	$db_parameter->delete('interfaceid='.$id);
    	$interfaceid=ChkClng(GF('interfaceid'));
    	$now_page=ChkClng(GF('p') ? GF('p'):'1');
    	$url =  M_URL('home/Interface','index','',GP('p-'.$now_page));
		KS_INFO('',3,$url);
    }
    //批量删除接口
    public function batchInterAction(){
    	$idary = ChkSQL(KS_G('post.id'));
    	$db_interface =M('web_interface');
    	$db_parameter =M('web_interface_parameter');
    	foreach ($idary as $k => $v) {
	    	$db_interface->delete('id='.$v);
	    	$db_parameter->delete('interfaceid='.$v);
	    	$interfaceid=ChkClng(GF('interfaceid'));
    	}
    	$now_page=ChkClng(GF('p') ? GF('p'):'1');
    	$url =  M_URL('home/Interface','index','',GP('p-'.$now_page));
		KS_INFO('删除成功',3,$url);
    }
    //接口详情页
    public function detailsAction(){
    	$id = ChkClng(KS_G('get.id'));
    	$db_interface =M('web_interface');
    	if($id){
    		$info = $db_interface->getRow(' as a left join ks_web_interface_classify as b on a.parentid where a.id='.$id,'a.*,b.name as classifyname');
    	}
    	$db_parameter =M('web_interface_parameter');
    	$values =$db_parameter->getAll('where interfaceid='.$id);
    	$now_page=ChkClng(GF('p') ? GF('p'):'1');
        $url =  M_URL('home/Interface','index','',GP('p-'.$now_page));
    	include  CURR_VIEW_PATH . "Interface/interface_detail.php";
    }
     //显示添加参数也=页面
    public function addshowpramAction(){
    	$id = ChkClng(KS_G('get.id'));
    	$db_interface =M('web_interface_parameter');
    	if($id){
    		$info = $db_interface->getRow('where id='.$id);
    	}
    	$now_page=ChkClng(GF('p') ? GF('p'):'1');
    	$interfaceid=ChkClng(GF('interfaceid') ? GF('interfaceid'):'');
    	include  CURR_VIEW_PATH . "Interface/parameter_add.php";
    }
    //增加参数
    public function saveParameterAction(){
    	$interfaceid=ChkClng(GF('interfaceid'));
    	$Data['name'] = ChkSQL(KS_G('post.name'));
    	$Data['isnecessary'] = ChkClng(KS_G('post.isnecessary'));
    	$Data['mark'] = ChkSQL(KS_G('post.mark'));
    	$Data['interfaceid'] = $interfaceid;
        $Data['parameter'] = ChkSQL(KS_G('post.parameter'));
    	$Data['pramType'] = ChkSQL(KS_G('post.pramType'));
    	$db_interface =M('web_interface_parameter');
    	// var_dump($Data);exit();
    	$db_interface->doadd($Data,'id');
    	$now_page=ChkClng(GF('p') ? GF('p'):'1');
    	$url =  M_URL('home/Interface','details',$interfaceid,GP('p-'.$now_page));
		KS_INFO('',3,$url);
    }
    //修改参数
    public function doeditParameterAction(){
    	$id = ChkClng(KS_G('get.id'));
    	$interfaceid=ChkClng(GF('interfaceid'));
    	$Data['name'] = ChkSQL(KS_G('post.name'));
    	$Data['isnecessary'] = ChkClng(KS_G('post.isnecessary'));
    	$Data['mark'] = ChkSQL(KS_G('post.mark'));
        $Data['parameter'] = ChkSQL(KS_G('post.parameter'));
    	$Data['pramType'] = ChkSQL(KS_G('post.pramType'));
    	$db_interface =M('web_interface_parameter');
    	$db_interface->update($Data,'id='.$id);
    	$now_page=ChkClng(GF('p') ? GF('p'):'1');
    	$url =  M_URL('home/Interface','details',$interfaceid,GP('p-'.$now_page));
		KS_INFO('',3,$url);
    }
    //删除参数
    public function deleteParameterAction(){
    	$id = ChkClng(KS_G('get.id'));
    	$db_interface =M('web_interface_parameter');
    	$db_interface->delete('id='.$id);
    	$interfaceid=ChkClng(GF('interfaceid'));
    	$now_page=ChkClng(GF('p') ? GF('p'):'1');
    	$url =  M_URL('home/Interface','details',$interfaceid,GP('p-'.$now_page));
		KS_INFO('',3,$url);
    }
}

?>