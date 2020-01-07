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
class IcoController extends CommonController
{   
     /**
      * 图标管理
      */
     public function indexAction(){
     	$chektype= null !== GF('chektype') ? GF('chektype'):'0';
		$nowdir = null !== GF('nowdir') ? GF('nowdir'):'';
		$type         = null !== GF('type') ? GF('type'):'parent';
     	$dir = ROOT.'Images/images/'.$nowdir;
     	$dirname      = array();
	    $filename     = array();
		if (is_dir($dir)) {
			 $filelist = scandir($dir,1);
			 foreach($filelist as $k=>$v){
			 	if($v !='.' and $v !='..'){
					if (is_dir($dir.$v)) {
					 	$file=scandir($dir.$v);
					 	foreach($file as $key=>$value){
					 		if($value !='.' and $value !='..'){
					 			if(!is_dir($dir.$value)){
					 				if($value !='.svn'){
					 					
					 					$filename[]= array('filePath'=>UOOT.'Images/images/'.$v.'/'.$value,'filename'=>$value);
//					 					
					 				}
					 			}
					 		}
					 	}
					}else{
						if($v !='.svn'){
					 		$filename[]= array('filePath'=>UOOT.'Images/images/'.$nowdir.'/'.$v,'filename'=>$v);
		 				}
					}
				}
			}
		}
		if(is_dir(ROOT.'Images/images/')){
			$filelist = scandir(ROOT.'Images/images/',1);
		 	foreach($filelist as $k=>$v){
		 		if($v !='.' and $v !='..'){
		 			if (is_dir(ROOT.'Images/images/'.$v)) {
		 				$dirname[] = $v;
		 			}
		 		}
		 	}
		 	$dirname=array_diff($dirname,array('..','.'));
			$dirname=array_values($dirname);
		}
//		var_dump($dirname);
		if(empty($nowdir)){
			unset($filename[0]);
		}
//		var_dump($filename);
//		$sum = count($filename);
		$options['now_page']   = null !==GF('p') ? GF('p'):'1';
		$options['maxperpage'] = 20; 
	    $options['totalput']   = count($filename);
		$page = Page($options);
		$filename   = $page->arrayPage($filename); 
		if(empty($filename)){
			$filename = array();
		}
		
       	include CURR_VIEW_PATH . "Ico/images_list.php";
     }
     public function deleteicoAction(){
     	if($_POST){
			foreach($_POST['imgary'] as $key => $v){
				$src = strstr($v, 'Images/');
				unlink(ROOT.$src);
			}
			echo '删除成功';
		}
     }
     
     
}