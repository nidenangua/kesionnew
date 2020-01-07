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
class TempController extends CommonController
{
	 //模板列表页
     public function indexAction(){
		$temptype = ChkClng(KS_S('temptype'));//选项卡
         if ($temptype==0) {
             $temptype=2;
         }
        
		$adddate  = ChkClng(KS_S('adddate',1)); ;//选项卡

		$where = "where temptype=$temptype";

		if($adddate==1){$by= 'isdefault desc';}
		elseif($adddate==2){$by = 'adddate asc';}
		cookie('Labelcheck',null);//标签页的多选框清楚cookie值
		//$values = $this->cache->getACache('appcategory');//取出缓存
		$common_temp = M('common_temp');//实例化云服务表
		$options     = $common_temp->getoptions('8',$where);//分页参数设置
		$page        = Page($options);
		$values      = $common_temp->getPage($page,$by,$where);
	    include  CURR_VIEW_PATH . "Temp/Temp_list.php";
     }
	 //进入模板添加页
	 public function tempAddAction(){
		$temptype   = ChkClng(KS_S("temptype",2));    //模板类型
	 	$now_page = ChkClng(KS_S('p',0)); //表ID
		 switch($temptype)
		 {
			 case 2://PC风格
				 $dir=PC_PATH;
				 break;
			 case 1://公众号风格
				 $dir = M_PATH;
				 break;
			 case 3://学堂风格
				 $dir = XT_PATH;
				 break;
		 }
		$dirname = array();
		if (is_dir($dir)) {
			 $filelist = scandir($dir);
			 foreach($filelist as $k=>$v){if (is_dir($dir.$v)){$dirname[] = $v;}}
			 $dirname=array_diff($dirname,array('..','.'));
			 $dirname=array_values($dirname);
		}

		$value = '';
		include  CURR_VIEW_PATH . "Temp/Temp_add.php";
	 }
	 //do模板添加页
	 public function tempdoAddAction(){
		$Data['tempname']   = ChkSQL(KS_G('post.tempname'));
		$Data['temptype']   = ChkClng(KS_G('post.temptype'));
		if($Data['temptype']==0){
            $Data['temptype']   = 2;
        }
        $Data['skintype']   = ChkClng(KS_G('post.skintype'));
		$Data['installdir'] = ChkSQL(KS_G('post.installdir'));
		$Data['defaultpic'] = ChkSQL(KS_G('post.defaultpic'));//应用封面图片
		if(!empty(ChkSQL(KS_G('post.package')))){$Data['package'] = ChkSQL(KS_G('post.package'));}
		$Data['author']     = ChkSQL(KS_G('post.author'));
		$Data['intro']      = ChkSQL(KS_G('post.intro'));
		$Data['chargetype'] = ChkSQL(KS_G('post.chargetype'));
		$Data['configjson']   = EncodeSQL(KS_G('post.configjson'));
		$Data['price']      = ChkSQL(KS_G('post.price'));
		$Data['adddate']    = strtotime(ChkSQL(KS_G('post.adddate')));
		$Data['ispub']      = ChkClng(KS_S('post.ispub'));

		$common_temp        = M('common_temp');//实例化云服务表
		$Rule['tempname']   = '模板风格名称|isEmpty,isDbexis';
		 if ($Data['temptype']!=3){
			 $Rule['installdir'] = 'PC模板目录|isEmpty,isEnglish';

		 }
//		$Rule['defaultpic'] = '预览图片|isEmpty';
		Chkpost($Data,$Rule,$common_temp);

		//进一步判断，是否添加过了
		if ($common_temp->getOne('tempid',"where installdir='".$Data['installdir']."' and temptype=".$Data['temptype'])>0)
//		{
//			KS_INFO('对不起，您指定的模板目录已添加过了！',0,'','',3);
//		}
		$common_temp->doAdd($Data,'tempid');
		$this->cache->PutACache('tempinfo'); //把temp信息存入缓存
		$url = M_URL('Temp','','',GP('temptype-'.$Data['temptype']));
		KS_INFO('添加成功',3,$url);
	 }
	 //进入模板编辑页
	 public function tempEditAction(){
		//读取对应文件夹下的文件目录
		$tempid   = ChkClng(KS_G('request.id'));//表ID
		$now_page = ChkClng(KS_S('p',1));
		//获得单个模板信息
		$common_temp = M('common_temp');//实例化云服务表
		$value = $common_temp->getRow("where tempid=$tempid limit 1");//得到一条记录

		if (isset($value)) {
			$temptype=$value["temptype"];
			switch($temptype)
			{
				case 2://PC风格
					$dir=PC_PATH;
					break;
				case 1://公众号风格
					$dir = M_PATH;
					break;
				case 3://学堂风格
					$dir = XT_PATH;
					break;
			}
			$dirname = array();
			if (is_dir($dir)) {
				$filelist = scandir($dir);
				foreach($filelist as $k=>$v){if (is_dir($dir.$v)){$dirname[] = $v;}}
				$dirname=array_diff($dirname,array('..','.'));
				$dirname=array_values($dirname);
			}
			include  CURR_VIEW_PATH . "Temp/Temp_add.php";
		}else{
			die ("参数出错!");
		}

	 }
	 /**
     * 保存模板编辑
	  */
	 public function tempdoEditAction(){
		$tempid   = ChkClng(KS_G('request.id'));//表ID
		$now_page = ChkClng(KS_S('p',1)); //页码
		$Data['tempname']     = ChkSQL(KS_G('post.tempname'));
		$Data['temptype']     = ChkClng(KS_G('post.temptype'));
        $Data['skintype']     = ChkClng(KS_G('post.skintype'));
		$Data['adddate']      = strtotime(ChkSQL(KS_G('post.adddate')));
		$Data['configjson']   = EncodeSQL(KS_G('post.configjson'));
		$Data['headjson']   = EncodeSQL(KS_G('post.headjson'));
		$Data['footjson']   = EncodeSQL(KS_G('post.footjson'));
		$Data['stylejson']   = EncodeSQL(KS_G('post.stylejson'));
		$Data['stylecolor']   = ChkSQL(KS_G('post.stylecolor'));
		$Data['installdir']   = ChkSQL(KS_G('post.installdir'));
		$Data['ispub']        = ChkClng(KS_S('post.ispub'));
		$common_temp = M('common_temp');//实例化云服务表
		if(!empty(ChkSQL(KS_G('post.defaultpic')))){$Data['defaultpic'] = ChkSQL(KS_G('post.defaultpic'));}

        $allowversion = KS_G('post.allowversion');
        $allowversionvalue=implode(',',$allowversion);
        $Data['package'] = $allowversionvalue;

		$Data['author']      = ChkSQL(KS_G('post.author'));
		$Data['price']       = ChkSQL(KS_G('post.price'));
		$Data['intro']       = ChkSQL(KS_G('post.intro'));
		$Data['chargetype']  = ChkSQL(KS_G('post.chargetype'));
		$Data['adddate']     = strtotime(ChkSQL(KS_G('post.adddate')));
		$Rule['tempname']    = '模板风格名称|isEmpty,isDbexis';
//		$Rule['installdir']  = 'PC模板目录|isEmpty,isEnglish';
		Chkpost($Data,$Rule,$common_temp,"tempid!=$tempid");
		//进一步判断，是否添加过了
		if ($common_temp->getOne('tempid',"where tempid!=".$tempid." and installdir='".$Data['installdir']."' and temptype=".$Data['temptype'])>0)
		{
			//KS_INFO('对不起，您指定的模板目录已添加过了！',0,'','',3);
		}

		$common_temp->update($Data,'tempid='.$tempid);
		$this->cache->PutACache('tempinfo'); //把temp信息存入缓存
		$url = M_URL('Temp','','',GP(''));
		KS_INFO('修改成功',3,$url);
	}
	 //设置风格的状态
	 public function setTempStatusAction(){
		 $tempid = ChkClng(KS_S("id"));
		 $ispub  = ChkClng(KS_S("ispub"));
		 if ($tempid<=0)
		 {
			 KS_INFO('参数出错!',0,KS_ComeUrl(),'',3);
		 }
		 $db=M('common_temp');
		 $Data["ispub"]= $ispub==1?0:1;
		 $db->update($Data,"tempid=$tempid");
		 $this->cache->PutACache('tempinfo'); //把temp信息存入缓存
		 KS_INFO('恭喜，设置成功！',0,KS_ComeUrl());
	 }
	//删除模板
	public function deleteTempAction(){
		 $tempid      = ChkClng(KS_G('request.id'));//表ID
		 $now_page    = ChkClng(KS_S('p',1)); //页码
		 $value       = $this->cache->GetA('tempinfo','tempid',$tempid,'',true);
		 $common_temp = M('common_temp');//实例化云服务表
		 $common_label= M('common_label');//实例化云服务表
	     $common_temp->delete("tempid=$tempid");
		 $common_label->delete("tempid=$tempid");

		 $this->cache->PutACache('tempinfo'); //把temp信息存入缓存
		 $url = M_URL('Temp','','',GP('temptype-'.$value['temptype']));
		 ks_header($url);
	}
	//批量删除模版
	public function deleteTempsAction(){
		 $tempids      = ChkClng(KS_S('request.id'));//表ID
		 $now_page    =  ChkClng(KS_S('p',1));       //页码
		 $tempid = explode('※',$tempids);
		 foreach($tempid as $k =>$v){
		 	$common_temp = M('common_temp');//实例化云服务表
		 	$common_label= M('common_label');//实例化云服务表
	     	$common_temp->delete("tempid=$v and ispub!=1");
			 if ($common_temp->getOne("tempid","where tempid=$v")>0){
				 $common_label->delete("tempid=$v");
			 }
		 	$this->cache->PutACache('tempinfo'); //把temp信息存入缓存
		 }
		 $temptype = ChkClng(KS_S('temptype',0)); //模板类型;//选项卡
		 $url = M_URL('Temp','','',GP('temptype-'.$temptype));
		 KS_INFO('删除成功',3,$url);
	}
	//模板设为默认
	public function defaultTempAction(){
		 $tempid      = ChkClng(KS_G('request.id'));//表ID
		 $temptype    = ChkClng(KS_S('temptype',1));//选项卡
		 $skintype    = ChkClng(KS_S('skintype'));//适用
		 $now_page    = ChkClng(KS_S('p',1));       //页码
		 $value       = $this->cache->GetA('tempinfo','tempid',$tempid,'',true);
		 $common_temp = M('common_temp');//实例化云服务表
		 $Data['isdefault'] = 0;
		 $common_temp->update($Data,'temptype='.$value['temptype'].' and skintype='.$skintype);
		 $Data['isdefault'] = 1;
	     $common_temp->update($Data,"tempid=$tempid");
		 $this->cache->PutACache('tempinfo'); //把temp信息存入缓存
		 $url = M_URL('Temp','','',GP('temptype-'.$temptype));
		 ks_header($url);
	}
	//模板下文件列表
	public function tempDirlistAction(){
	    $arr_filetype = $this->File->fileType_arr();//指定可以打开的文件后缀
		$tempdir      = null !== GF('tempdir') ? GF('tempdir'):'';
		$temptype     =  ChkClng(KS_S('temptype',0));
		$first        = '';
		$now_page     = ChkClng(KS_S('p',1));
		$tempid       = ChkClng(KS_S('request.id'));//表ID
		$value = $this->cache->GetA('tempinfo','tempid',$tempid,'',true);
		if(!empty($tempdir)){
			$back = null !== GF('back') ? GF('back'):'';
			if(!empty($back)){
				$tempdir = explode('/',$tempdir);
				$tempdir = array_diff($tempdir,array('..','.',''));
				$tempdir = array_values($tempdir);

				array_pop($tempdir);
				if(count($tempdir)>3)
				{$first = 'on';}
				$tempdir = implode('/',$tempdir);

				if($value['temptype']==0){$ismatch = strpos($tempdir,'Tp/PC/'.$value['installdir']);}
				else if($value['temptype']==1){$ismatch = strpos($tempdir,'Tp/M/'.$value['installdir']);}
				if($ismatch===false){echo 'err';exit;};
				$dir = ROOT.$tempdir.'/';
			}else{
				if($value['temptype']==0){$ismatch = strpos($tempdir,'Tp/PC/'.$value['installdir']);}
				else if($value['temptype']==1){$ismatch = strpos($tempdir,'Tp/M/'.$value['installdir']);}
				if($ismatch===false){echo 'err';exit;};
				$tempdir = explode('/',$tempdir);
				$tempdir = array_diff($tempdir,array('..','.',''));
				$tempdir = array_values($tempdir);

				$nowdir = null !== GF('nowdir') ? GF('nowdir'):'';
				if(empty($nowdir)){
					if(count($tempdir)>3){$first = 'on';}
					$tempdir = implode('/',$tempdir);
				    $dir = ROOT.$tempdir.'/';
				}else{
					if(count($tempdir)>2){$first = 'on';}
					$tempdir = implode('/',$tempdir);
				    $tempdir = $tempdir.'/'.$nowdir;
				    $dir = ROOT.$tempdir.'/';
				}
			}
		}else{
			if($value['temptype']==0){
				$tempdir = 'Tp/PC/'.$value['installdir'];
				$dir     = ROOT.$tempdir.'/';
			}else if($value['temptype']==1){
				$tempdir = 'Tp/M/'.$value['installdir'];
				$dir     = ROOT.$tempdir.'/';
			}
	   }
	   //var_dump($dir);exit;
	   $dirname  = array();
	   $filename = array();
	   if (is_dir($dir)) {
			 $filelist = scandir($dir);
			 foreach($filelist as $k=>$v){
				 if (is_dir($dir.$v)) {$dirname[] = $v;}
				 else{
					$suffix = $this->File->get_file_type($v);
					foreach($arr_filetype as $kt=>$vt){
						if($suffix == $vt ){$filename[] = $v;}
					}
				 }
			 }
			 $dirname=array_diff($dirname,array('..','.'));
			 $dirname=array_values($dirname);
	   }
       include  CURR_VIEW_PATH . "Temp/Tempdir_list.php";
	}
	//进入模板文件内容编辑
	public function tempDirAddAction(){
		 $tempdir  = null !== GF('tempdir') ? GF('tempdir'):'';
		 $temptype   =  ChkClng(KS_S('temptype',0));
		 $now_page   =  ChkClng(KS_S('p',1));
		 $tempid     = ChkClng(KS_G('request.id'));//表ID
		 $value      = $this->cache->GetA('tempinfo','tempid',$tempid,'',true);
		 if($value['temptype']==0){$ismatch = strpos($tempdir,'Tp/PC/'.$value['installdir']);}
		 else if($value['temptype']==1){$ismatch = strpos($tempdir,'Tp/M/'.$value['installdir']);}
		 if($ismatch===false){echo 'err';exit;};
		 $tempdir  = explode('/',$tempdir);
		 $tempdir  = array_diff($tempdir,array('..','.',''));
		 $tempdir  = array_values($tempdir);
		 $nowdir   = null !== GF('nowdir') ? GF('nowdir'):'';
		 if(empty($nowdir))
		 {
			 if(count($tempdir)>3){$first = 'on';}
			 $tempdir = implode('/',$tempdir);
		     $dir = ROOT.$tempdir.'/';
		 }else{
			 if(count($tempdir)>2){$first = 'on';}
			 $tempdirS = implode('/',$tempdir);
		     $tempdir = $tempdirS.'/'.$nowdir;
		     $dir = ROOT.$tempdir;
		 }
		 $string_str = $this->File->read_all($dir);
		 $string_str = str_replace("</textarea>","<\/textarea>",$string_str);
		 $string_str = EncodeHtml($string_str);
		 include  CURR_VIEW_PATH . "Temp/Tempdir_add.php";
	}
	//do模板文件内容编辑
	public function tempDirdoAddAction(){
		 $tempdir  = null !== GF('tempdir') ? GF('tempdir'):'';
		 $nowdir   = null !== GF('nowdir') ? GF('nowdir'):'';
		 $temptype =  ChkClng(KS_S('temptype',0));
		 $now_page = ChkClng(KS_S('p',1));
		 $tempid   = ChkClng(KS_G('request.id'));//表ID
		 $content  = KS_G('post.content');
		 $dir      = ROOT.$tempdir.'/'.$nowdir;
		 $result   = $this->File->write_all($dir,$content);
		 $url = M_URL('Temp','tempDirlist',$tempid,GP('temptype-'.$temptype.',tempdir-'.urlencode($tempdir),true));
		 if($result){KS_INFO('恭喜，模板修改成功!',0,$url);}
		 else{KS_INFO('很遗憾，模板修改失败!');}
	}
	//删除模板文件
	public function deletetempDirAction(){
		 $tempdir  = null !== GF('tempdir') ? GF('tempdir'):'';
		 $temptype   = ChkClng(KS_S('temptype',0)); //模板类型;
		 $now_page =  ChkClng(KS_S('p',1));
		 $tempid   = ChkClng(KS_G('request.id'));//表ID
		 $nowdir   = null !== GF('nowdir') ? GF('nowdir'):'';
		 $cgtempdir= $tempdir.'/'.$nowdir;
		 $dir      = ROOT.$cgtempdir;
		 $result   = $this->File->delete_file($dir);
		 if($result)
		 {
			  $url = M_URL('Temp','tempDirlist',$tempid,GP('temptype-'.$temptype.',tempdir-'.urlencode($tempdir),true));
			  ks_header($url);
		 }else{KS_INFO('很遗憾，删除文件失败!');}
	}
	//进入新建模板文件页
	public function TempaddFileAction(){
		 $temptype   = ChkClng(KS_S('temptype',0)); //模板类型;
		 $now_page =  ChkClng(KS_S('p',1));
		 $tempid   = ChkClng(KS_G('request.id'));//表ID
		 $tempdir  = null !== GF('tempdir') ? GF('tempdir'):'';
		 $filename =  'Untitled.html';
		 $dir      = ROOT.$tempdir.'/'.$filename;
		 $i = 1;
		 while($this->File->is_exists($dir))
		 {
			 $filename =  'Untitled'.$i.'.html';
			 $dir = ROOT.$tempdir.'/'.$filename;
			 $i++;
		 }
		 //$tempdirs = iconv('gbk','utf-8',$tempdir);
		 include  CURR_VIEW_PATH . "Temp/Temp_addfile.php";
	}
	//do新建模板文件
	public function TempdoaddFileAction(){
		 $temptype   = ChkClng(KS_S('temptype')); //模板类型;
		 $now_page = ChkClng(KS_S('p',1));
		 $tempid   = ChkClng(KS_G('request.id'));//表ID
		 $tempdir  = null !== GF('tempdir') ? GF('tempdir'):'';
		 $filename = ChkSQL(KS_G('post.filename'));
		 $filename = iconv('UTF-8','GBK',$filename);
		 if(!$this->File->is_the_type($filename)){KS_INFO('很遗憾，扩展名错误！');}
		 $dir      = ROOT.$tempdir.'/'.$filename;
		 if($this->File->is_exists($dir)){KS_INFO('很遗憾，文件已存在！');}
		 $result = $this->File->write_all($dir,'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<title>无标题文档</title>
			</head>
			<body>
			</body>
			</html>');
		 if($result){$url = M_URL('Temp','tempDirlist',$tempid,GP('temptype-'.$temptype.',tempdir-'.urlencode($tempdir),true));KS_INFO('恭喜，新建模板成功!',3,$url);}
		 else{KS_INFO('很遗憾，新建模板失败!');}
	}
	public function zipAction(){
		$tempid   = ChkClng(KS_G('request.id'));//表ID
		$value    = $this->cache->GetA('tempinfo','tempid',$tempid,'',true);
		if($value['temptype']==0){
			$tempdir1 =ROOT.'Tp/BackUp/PC/'.$value['installdir'].'/';
			$tempdir =ROOT.'Tp/PC/'.$value['installdir'].'/';
		}else if($value['temptype']==3){
			$tempdir1 = ROOT.'Tp/BackUp/PCXT/'.$value['installdir'].'/';
			$tempdir = ROOT.'Tp/PCXT/'.$value['installdir'].'/';
		}
		if(!is_dir($tempdir1)){make_dir($tempdir1);}
		$filepath = $tempdir1.$value['installdir'].'.zip';
		if(is_file($filepath)){unlink($filepath);}
   		$common_label = M('common_label');
   		$where    = 'where tempid='.$tempid;
   		$label = $common_label->getAll($where);
   		$file = fopen($tempdir."label.php", "w");
   		fwrite($file,serialize($label));
   		fclose($file);
   		//读取模型一些基础信息，写入XML进行储存
   		$content='<?xml version="1.0" encoding="UTF-8"?>
			<setting>
				<tempname>'.$value['tempname'].'</tempname> <!--名称-->
				<defaultpic>'.$value['defaultpic'].'</defaultpic> <!--缩略图，支持外网-->
				<author>'.$value['author'].'</author><!--作者-->
				<price>'.$value['price'].'</price><!--价格-->
				<installdir>'.$value['installdir'].'</installdir><!--安装名称-->
				<temptype>'.$value['temptype'].'</temptype><!--类型 0:PC 1:手机-->
				<intro>'.$value['intro'].'</intro><!--介绍-->
			</setting>';
		file_put_contents($tempdir.'config.xml', $content);
   		$zip = new ZipArchive;
   		if($zip->open($filepath, ZipArchive::OVERWRITE)=== TRUE){
		   	$this->createZip(opendir($tempdir),$zip,$tempdir);
			$zip->close();
		}
//		var_dump(filesize($filepath));
// 		$this->($filepath);
		ob_end_clean();
		header("Content-Type: application/force-download");
		header('Content-Type:application/zip');
		header('Content-disposition:attachment;filename='.$value['installdir'].'.zip');
		header("Accept-Ranges: bytes");
		header('Expires: 0');
   		header('Cache-Control: must-revalidate');
		header('Content-length:'.filesize($filepath));
		readfile($filepath);

	}
	function createZip($openFile,$zipObj,$sourceAbso,$newRelat = '') {
		while(($file = readdir($openFile)) != false){
		    if($file=="." || $file=="..")
		        continue;

		    /*源目录路径(绝对路径)*/
		    $sourceTemp = $sourceAbso.'/'.$file;
		    /*目标目录路径(相对路径)*/
		    $newTemp = $newRelat==''?$file:$newRelat.'/'.$file;
		    if(is_dir($sourceTemp))
		    {
		        //echo '创建'.$newTemp.'文件夹<br/>';
		        $zipObj->addEmptyDir($newTemp);/*这里注意：php只需传递一个文件夹名称路径即可*/
		        $this->createZip(opendir($sourceTemp),$zipObj,$sourceTemp,$newTemp);
		    }
		    if(is_file($sourceTemp))
		    {
		        //echo '创建'.$newTemp.'文件<br/>';
		        $zipObj->addFile($sourceTemp,$newTemp);
		    }
		}
	}
	public function templistAction(){
		$type         = null !== GF('type') ? GF('type'):'parent';
		$name         = null !== GF('name') ? GF('name'):'';
		$tempdir      = null !== GF('tempdir') ? GF('tempdir'):'';
		$temptype     = null !== GF('temptype') ? GF('temptype'):'0';
    	$first        = '';
        $arr_filetype = $this->File->fileType_arr(array('zip'));//指定可以打开的文件后缀
        if(!empty($tempdir)){
			$back = null !== GF('back') ? GF('back'):'';
			if(!empty($back)){
				$tempdir = explode('/',$tempdir);
				$tempdir = array_diff($tempdir,array('..','.',''));
				$tempdir = array_values($tempdir);
				array_pop($tempdir);
				if(count($tempdir)>3)
				{$first = 'on';}
				$tempdir = implode('/',$tempdir);
				$ismatch = strpos($tempdir,'Images/tempZIP/');
				if($ismatch===false){echo 'err';exit;};
				$dir = ROOT.$tempdir.'/';
			}else{
//				if($value['temptype']==0){$ismatch = strpos($tempdir,'Tp/PC/'.$value['installdir']);}
//				else if($value['temptype']==1){$ismatch = strpos($tempdir,'Tp/M/'.$value['installdir']);}
//				if($ismatch===false){echo 'err';exit;};
				$tempdir = explode('/',$tempdir);
				$tempdir = array_diff($tempdir,array('..','.',''));
				$tempdir = array_values($tempdir);
				$nowdir  = null !== GF('nowdir') ? GF('nowdir'):'';
				if(empty($nowdir)){
					if(count($tempdir)>3){$first = 'on';}
					$tempdir = implode('/',$tempdir);
				    $dir = ROOT.$tempdir.'/';
				}else{
					if(count($tempdir)>2){$first = 'on';}
					$tempdir = implode('/',$tempdir);
				    $tempdir = $tempdir.'/'.$nowdir;
				    $dir = ROOT.$tempdir.'/';
				}
			}
		}else{
			$tempdir      = 'Images/tempZIP/';
		    $dir          = ROOT.$tempdir.'/';
		}
		$dirname      = array();
	    $filename     = array();
	    if (is_dir($dir)) {
			 $filelist = scandir($dir,1);
			 foreach($filelist as $k=>$v){
				 if (is_dir($dir.$v)) {$dirname[] = $v;}else{
					$suffix = $this->File->get_file_type($v);
					foreach($arr_filetype as $kt=>$vt){if($suffix == $vt ){$filename[] = $v;}}
				 }
			 }
			 $dirname=array_diff($dirname,array('..','.'));
			 $dirname=array_values($dirname);
	    }
        include  CURR_VIEW_PATH . "Index/temp_list.php";
    }
    //小课堂背景管理
    public function tempBackgroundAction(){
    	$temptype  = ChkClng(KS_S('temptype')); //模板类型;//选项卡
		$adddate = ChkClng(KS_S('adddate',1)); //选项卡
		$id      = KS_G('get.id');
		$where   = 'where tempid='.$id.' and type=1';
		$keyword = KS_S('keyword');
		$keytype = KS_S('keytype',1);
		if(!empty($keyword)){
			if($keytype==1){$where.=" and filename like '%$keyword%'";}
			elseif($keytype==2){$where.=" and wxid like '%$keyword%'";}
		}

		if($adddate==1){$by= 'adddate desc';}
		elseif($adddate==2){$by = 'adddate asc';}
		//$values = $this->cache->getACache('appcategory');//取出缓存
		$Mode        = M('common_roomsetting');
		$options     = $Mode->getoptions('8',$where);//分页参数设置
		$page        = Page($options);
		$values      = $Mode->getPage($page,$by,$where);
    	include  CURR_VIEW_PATH . "Temp/TempBackground.php";
    }
    //设置默认小课堂背景
    public function defaultBackAction(){
    	 $temptype          = ChkClng(KS_S('temptype')); //模板类型;//选项卡
    	 $id                = ChkClng(KS_G('request.id'));//表ID
		 $now_page          = ChkClng(KS_S('p',1)); //页码
		 $common_setting    = M('common_roomsetting');//实例化云服务表
		 $value             = $common_setting->getRow('where id='.$id.' limit 1');
		 $Data['ism']       = 0;
		 $common_setting->update($Data,'type='.$value['type'].' and tempid='.$value['tempid']);
		 $Data['ism']       = 1;
	     $common_setting->update($Data,'id='.$value['id']);
		 //$this->cache->PutACache('tempinfo'); //把temp信息存入缓存
		 $url = M_URL('Temp','tempBackground',$value['tempid'],GP('temptype-'.$temptype));
		 ks_header($url);
    }
    //添加背景
    public function tempbgAddAction(){
    	$id = KS_G('get.id');
    	$adddate = ChkClng(KS_S('adddate',1)) ;//选项卡
    	$now_page =  ChkClng(KS_S('p',1));
    	include  CURR_VIEW_PATH . "Temp/tempbgAdd.php";
    }
    public function bgdoAddAction(){
    	$temptype = ChkClng(KS_S('temptype',0)); //模板类型;
    	$now_page =  ChkClng(KS_S('p',1));
    	$Mode = M('common_roomsetting');
    	$Data['filename'] = KS_G('post.filename');
    	$Data['fileurl']  =KS_G('post.fileurl');
    	if(empty($Data['filename'])){KS_INFO('请输入名称');exit;}
    	if(empty($Data['fileurl'])){KS_INFO('请上传文件');exit;}
    	$Data['adddate']  = time();
    	$Data['tempid'] = KS_G('get.id');
    	$Data['type'] = 1;
    	$Mode->doAdd($Data,'id');
    	KS_INFO('添加成功',3,M_URL('home/Temp','tempBackground',KS_G('get.id'),GP('p-'.$now_page.'temptype-'.$temptype)));
    }
    public function deletebgAction(){
    	$temptype = ChkClng(KS_S('temptype')); //模板类型;
    	$now_page =  ChkClng(KS_S('p',1));
    	$tempid = null !==GF('tempid') ? GF('tempid'):'1';//选项卡
    	$Mode = M('common_roomsetting');
    	$id = KS_G('get.id');
    	$Mode->delete('id='.$id);
    	KS_INFO('删除成功',3,M_URL('home/Temp','tempBackground',$tempid,GP('p-'.$now_page.'temptype-'.$temptype)));
    }
    public function bgEditAction(){
    	$temptype = ChkClng(KS_S('temptype')); //模板类型;
    	$now_page =  ChkClng(KS_S('p',1));
    	$id = KS_G('get.id');
    	$Mode = M('common_roomsetting');
    	$value = $Mode->getRow('where id='.$id);
    	include  CURR_VIEW_PATH . "Temp/tempbgAdd.php";
    }
    public function bgdoEditAction(){
    	$temptype = ChkClng(KS_S('temptype')); //模板类型;
    	$now_page =  ChkClng(KS_S('p',1));
    	$tempid = null !==GF('tempid') ? GF('tempid'):'1';//选项卡
    	$Data['filename'] = KS_G('post.filename');
    	$Data['fileurl']  =KS_G('post.fileurl');
    	$id = KS_G('get.id');
    	$Mode = M('common_roomsetting');
    	$Mode ->update($Data,'id='.$id);
    	KS_INFO('修改成功',3,M_URL('home/Temp','tempBackground',$tempid,GP('p-'.$now_page.'temptype-'.$temptype)));
    }
    public function deletebgsAction(){
    	$id = isset($_POST["check"])?$_POST["check"]:'';
    	$now_page = ChkClng(KS_S('p',1));
    	$tempid = KS_G('get.id');
    	if(empty($id)){KS_INFO("请选择");}
    	$Mode = M('common_roomsetting');
		$url = M_URL('home/Temp','tempBackground',$tempid,GP('p-'.$now_page));
		//批量删除
		if(KS_G('post.batch')==4){
			foreach ($id as $v ){$Mode->delete('id='.$v);}
			$this->cache->putACache('domaininfo');//写入缓存
			KS_INFO('批量删除成功',0,$url);
		}
    }
    //管理小课堂音乐
    public function tempBgmAction(){
    	$temptype = ChkClng(KS_S('temptype')); //模板类型;
		$adddate = ChkClng(KS_S('adddate',1));//选项卡
		$id = KS_G('get.id');
		$where = 'where tempid='.$id.' and type=2';
		$keyword = ChkSQL(KS_S('keyword'));
		$keytype = ChkClng(KS_S('keytype',1));
		if(!empty($keyword)){
			if($keytype==1){$where.=" and filename like '%$keyword%'";}
			elseif($keytype==2){$where.=" and wxid like '%$keyword%'";}
		}
		if($adddate==1){$by= 'adddate desc';}
		elseif($adddate==2){$by = 'adddate asc';}
		//$values = $this->cache->getACache('appcategory');//取出缓存
		$Mode = M('common_roomsetting');
		$options     = $Mode->getoptions('8',$where);//分页参数设置
		$page        = Page($options);
		$values      = $Mode->getPage($page,$by,$where);
    	include  CURR_VIEW_PATH . "Temp/TempBgm.php";
    }
    //设置默认小课堂音乐
    public function defaultBgmAction(){
    	 $temptype  = ChkClng(KS_S('temptype')); //模板类型
    	 $id                = ChkClng(KS_G('request.id'));//表ID
		 $now_page          = ChkClng(KS_S('p',1)); //页码
		 $common_setting    = M('common_roomsetting');//实例化云服务表
		 $value             = $common_setting->getRow('where id='.$id.' limit 1');
		 $Data['ism']       = 0;
		 $common_setting->update($Data,'type='.$value['type'].' and tempid='.$value['tempid']);
		 $Data['ism']       = 1;
	     $common_setting->update($Data,'id='.$value['id']);
		 //$this->cache->PutACache('tempinfo'); //把temp信息存入缓存
		 $url = M_URL('Temp','tempBgm',$value['tempid'],GP('temptype-'.$temptype));
		 ks_header($url);
    }
    //添加音乐
    public function tempbgmAddAction(){
    	$id = KS_G('get.id');
    	$adddate = ChkClng(KS_S('adddate',1)); ;//选项卡
    	$now_page =  ChkClng(KS_S('p',1));
    	include  CURR_VIEW_PATH . "Temp/tempbgmAdd.php";
    }
    public function bgmdoAddAction(){
    	$temptype = ChkClng(KS_S('temptype')); //模板类型
    	$now_page =  ChkClng(KS_S('p',1));
    	$Mode = M('common_roomsetting');
    	$Data['filename'] = KS_G('post.filename');
    	$Data['fileurl']  =KS_G('post.fileurl');
    	if(empty($Data['filename'])){KS_INFO('请输入名称');exit;}
    	if(empty($Data['fileurl'])){KS_INFO('请上传文件');exit;}
    	$Data['adddate']  = time();
    	$Data['tempid'] = KS_G('get.id');
    	$Data['type'] = 2;
    	$Mode->doAdd($Data,'id');
    	KS_INFO('添加成功',3,M_URL('home/Temp','tempBgm',KS_G('get.id'),GP('p-'.$now_page.'temptype-'.$temptype)));
    }
    public function deletebgmAction(){
    	$temptype = ChkClng(KS_S('temptype')); //模板类型
    	$now_page =  ChkClng(KS_S('p',1));
    	$tempid = null !==GF('tempid') ? GF('tempid'):'1';//选项卡
    	$Mode = M('common_roomsetting');
    	$id = KS_G('get.id');
    	$Mode->delete('id='.$id);
    	ks_header(M_URL('home/Temp','tempBgm',$tempid,GP('p-'.$now_page.'temptype-'.$temptype)));
    }
    public function bgmEditAction(){
    	$temptype = ChkClng(KS_S('temptype')); //模板类型
    	$now_page =  ChkClng(KS_S('p',1));
    	$id = KS_G('get.id');
    	$Mode = M('common_roomsetting');
    	$value = $Mode->getRow('where id='.$id);
    	include  CURR_VIEW_PATH . "Temp/tempbgmAdd.php";
    }
    public function bgmdoEditAction(){
    	$temptype = ChkClng(KS_S('temptype')); //模板类型
    	$now_page =  ChkClng(KS_S('p',1));
    	$tempid = null !==GF('tempid') ? GF('tempid'):'1';//选项卡
    	$Data['filename'] = KS_G('post.filename');
    	$Data['fileurl']  =KS_G('post.fileurl');
    	$id = KS_G('get.id');
    	$Mode = M('common_roomsetting');
    	$Mode ->update($Data,'id='.$id);
    	KS_INFO('修改成功',3,M_URL('home/Temp','tempBgm',$tempid,GP('p-'.$now_page.'temptype-'.$temptype)));
    }
     public function deletebgmsAction(){
    	$id = isset($_POST["check"])?$_POST["check"]:'';
    	$now_page = ChkClng(KS_S('p',1));
    	$tempid = KS_G('get.id');
    	if(empty($id)){KS_INFO("请选择");}
    	$Mode = M('common_roomsetting');
		$url = M_URL('home/Temp','tempBgm',$tempid,GP('p-'.$now_page));
		//批量删除
		if(KS_G('post.batch')==4){
			foreach ($id as $v ){$Mode->delete('id='.$v);}
			$this->cache->putACache('domaininfo');//写入缓存
			KS_INFO('批量删除成功',0,$url);
		}
    }
    //小程序管理
    public function AppletTempAction(){
    	$common_temp  = M('app_wxapplet_temp');
    	$where       = 'where draft_id !=-1';
    	$options     = $common_temp->getoptions('8',$where);//分页参数设置
		$page        = Page($options);
		$values      = $common_temp->getPage($page,'',$where);
    	include  CURR_VIEW_PATH . "Temp/AppletTemp.php";
    }
    //拉取小程序草稿到本地
    public function gettemplatedraftlistAction(){
    	$common_temp  = M('app_wxapplet_temp');
    	$access_token = GetOpenAccessToken();
		$url = 'https://api.weixin.qq.com/wxa/gettemplatedraftlist?access_token='.$access_token;
		$curl = curl_init();
	    //设置抓取的url
	    curl_setopt($curl, CURLOPT_URL,$url);
	    //设置获取的信息以文件流的形式返回，而不是直接输出。
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	    //执行命令
	    $data = curl_exec($curl);
	    //关闭URL请求
	    curl_close($curl);
	    $response = json_decode($data);
		$str  = '';
		if($response->errcode == -1){
			$str = '系统繁忙';
		}elseif($response->errcode == 85064){
			$str = '找不到模版';

		}elseif($response->errcode == 0){
			$str = '同步完成';
			$datalist  = $response->draft_list;
			foreach($datalist as $k=>$v){
				$info = $common_temp->getRow('where draft_id='.$v->draft_id);
				$Data['create_time'] = $v->create_time;
				$Data['user_version'] = $v->user_version;
				$Data['user_desc']    = $v->user_desc;
				$Data['draft_id']     =$v->draft_id;
				$Data['source_miniprogram_appid'] = $v->source_miniprogram_appid;
				$Data['source_miniprogram']       = $v->source_miniprogram;
				$Data['developer']                = $v->developer;
				if($info){
					$common_temp->update($Data,'id='.$info['id']);
				}else{
					$common_temp->doAdd($Data,'id');
				}
			}

		}
		$url = M_URL('Temp','AppletTemp','',GP(''));
		KS_INFO($str,3,$url);
    }
     //拉取小程序模版到本地
    public function gettemplatelistAction(){
    	$common_temp  = M('app_wxapplet_temp');
    	$access_token = GetOpenAccessToken();
		$url = 'https://api.weixin.qq.com/wxa/gettemplatelist?access_token='.$access_token;
		$curl = curl_init();
	    //设置抓取的url
	    curl_setopt($curl, CURLOPT_URL,$url);
	    //设置获取的信息以文件流的形式返回，而不是直接输出。
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	    //执行命令
	    $data = curl_exec($curl);
	    //关闭URL请求
	    curl_close($curl);
	    $response = json_decode($data);
		$str  = '';
		if($response->errcode == -1){
			$str = '系统繁忙';
		}elseif($response->errcode == 85064){
			$str = '找不到模版';

		}elseif($response->errcode == 0){
			$str = '同步完成';
			$datalist  = $response->template_list;
			foreach($datalist as $k=>$v){
				$info = $common_temp->getRow('where template_id='.$v->template_id);
				$Data['create_time'] = $v->create_time;
				$Data['user_version'] = $v->user_version;
				$Data['user_desc']    = $v->user_desc;
				$Data['template_id']     =$v->template_id;
				$Data['source_miniprogram_appid'] = $v->source_miniprogram_appid;
				$Data['source_miniprogram']       = $v->source_miniprogram;
				$Data['developer']                = $v->developer;
				if($info){
					$common_temp->update($Data,'id='.$info['id']);
				}else{
					$common_temp->doAdd($Data,'id');
				}
			}

		}
		$url = M_URL('Temp','AppletTemplist','',GP(''));
		KS_INFO($str,3,$url);
    }
    //删除草稿---------微信接口暂缺
    //把草稿转化成模版
    public function addtotemplateAction(){
    	$id =   KS_G('get.id');
    	$common_temp  = M('app_wxapplet_temp');
		$response = addtotemplate($id);
		$str  = '';
		if($response->errcode == -1){
			$str = '系统繁忙';
		}elseif($response->errcode == 85065){
			$str = '模版库已满';
		}elseif($response->errcode == 85064){
			$str = '找不到草稿';
		}elseif($response->errcode == 0){
			$str = '转化成功，请到模版页使用模版同步拉取最新模版';
		}
		$url = M_URL('Temp','AppletTemp','',GP(''));
		KS_INFO($str,3,$url);
    }
    //小程序模版库管理
    public function AppletTemplistAction(){
    	$common_temp  = M('app_wxapplet_temp');
    	$where       = 'where template_id !=-1';
    	$options     = $common_temp->getoptions('8',$where);//分页参数设置
		$page        = Page($options);
		$values      = $common_temp->getPage($page,'',$where);
    	include  CURR_VIEW_PATH . "Temp/AppletTemplist.php";
    }
    //编辑模版前台展示信息
    public function AppletTempAddAction(){
    	$id = KS_G('get.id');
    	$common_temp  = M('app_wxapplet_temp');
    	$where       = 'where template_id ='.$id;
    	$value       = $common_temp->getRow($where);
    	include  CURR_VIEW_PATH . "Temp/AppletTempAdd.php";
    }
     public function AppletdoAddAction(){
    	$id = KS_G('get.id');
    	$now_page =  ChkClng(KS_S('p',1));
    	$Mode = M('app_wxapplet_temp');
    	$Data['tempname'] = KS_G('post.tempname');
    	$Data['pic']  =KS_G('post.pic');
    	if(empty($Data['tempname'])){KS_INFO('请输入名称');exit;}
    	if(empty($Data['pic'])){KS_INFO('请上传文件');exit;}
    	$Mode->update($Data,'template_id='.$id);
    	KS_INFO('修改成功',3,M_URL('home/Temp','AppletTemplist','',GP('p-'.$now_page)));
    }
    //删除模版
    public function deletetemplateAction(){
    	$id =   KS_G('get.id');
    	$common_temp  = M('app_wxapplet_temp');
		$response = deletetemplate($id);
		$str  = '';
		if($response->errcode == -1){
			$str = '系统繁忙';
		}elseif($response->errcode == 85064){
			$str = '找不到草稿';
		}elseif($response->errcode == 0){
			$str = '删除成功';
			$common_temp->delete('template_id='.$id);
		}
		$url = M_URL('Temp','AppletTemplist','',GP(''));
		KS_INFO($str,3,$url);
    }
    //批量操作模版
    public function AppletTempSetAction(){
    	$ids = $_POST['check'];
    	$common_temp  = M('app_wxapplet_temp');
    	$url = M_URL('Temp','AppletTemplist','',GP(''));
    	if(empty($ids)){

			KS_INFO('请选择一个模版操作',3,$url);
    	}
    	foreach($ids as $k=>$v){
    		$response = deletetemplate($v);
    		if($response->errcode == -1){
			$str = '系统繁忙';
			}elseif($response->errcode == 85064){
				$str = '找不到草稿';
			}elseif($response->errcode == 0){
				$str = '删除成功';
				$common_temp->delete('template_id='.$v);
			}
		}
		KS_INFO($str,3,$url);
    }
    //批量操作模版
    public function addtotemplatesAction(){
    	$ids = $_POST['check'];
    	$common_temp  = M('app_wxapplet_temp');
    	$url = M_URL('Temp','AppletTemp','',GP(''));
    	if(empty($ids)){
			KS_INFO('请选择一个草稿操作',3,$url);
    	}
    	foreach($ids as $k=>$v){
    		$id =   KS_G('get.id');
	    	$common_temp  = M('app_wxapplet_temp');
			$response = addtotemplate($v);
			$str  = '';
			if($response->errcode == -1){
				$str = '系统繁忙';
			}elseif($response->errcode == 85065){
				$str = '模版库已满';
			}elseif($response->errcode == 85064){
				$str = '找不到草稿';
			}elseif($response->errcode == 0){
				$str = '转化成功，请到模版页使用模版同步拉取最新模版';
			}
		}
		KS_INFO($str,3,$url);
    }
} 