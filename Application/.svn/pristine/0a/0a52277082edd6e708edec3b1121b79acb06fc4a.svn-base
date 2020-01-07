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



namespace Kesion\Model\Application;
use Kesion\Model;
class DragModel extends Model{
	//初始化微门户首页拖拽
	public function inidrag($Data001){
		if ($Data001['type']==1){//手机
			$Data['isdiy']           = 1;
			$Data['mydiyid']         = $this->cache->GetA('domaininfo','wxid',$Data001['wxid'],'tempMid');
		}else{//PC
			$Data['ispcdiy']         = 1;
			$Data['mypcdiyid']       = $this->cache->GetA('domaininfo','wxid',$Data001['wxid'],'tempPid');
		}
		$Data002['wxid']         = $Data001['wxid'];
		$tmplContent             = $this->firstdrag($Data002);
		$Data2['htmlvalue']      = EncodeSQL($tmplContent);
		$Data2['wxid']		     = $Data001['wxid'];
		$Data2['configjson']     = $this->cache->GetA('tempinfo','tempid',$Data001['type']==1?$Data['mydiyid']:$Data['mypcdiyid'],'configjson');
		$Data2['tempid']         = $Data001['type']==1?$Data['mydiyid']:$Data['mypcdiyid'];
		$Data2['htmlname']       = '微门户首页';
	    $Data2['adddate']        = time();
		$temp_path				 = M('app_temp_path');
		$pathnum				 = $temp_path->getOne('count(id)','where mypathid=0 and wxid='.$Data001['wxid'].' and tempid='.$Data['mydiyid']);
		if(isset($Data001['modeltype'])&&$Data001['modeltype']=='ResDefault'){//恢复到默认的效果
			if($pathnum>=0&&$pathnum<5){
			}else{
				 $temp_path   ->delete('mypathid=0 and isformal!=1 and wxid='.$Data001['wxid'].' and tempid='.$Data2['tempid'].' order by id asc limit 1');
			}
			$temp_path   ->doAdd($Data2,'id');
		}elseif(isset($Data001['modeltype'])&&$Data001['modeltype']=='Opendiy'){//开通微门户DIY功能		
			if($pathnum==0){
				$temp_path   ->doAdd($Data2,'id');
			}
		}
		return $tmplContent;
	}
	//根据wxid得到首页执行后的string
	public function firstdrag($Data002){
		$Data['wxid']     = $Data002['wxid'];
		$dir              = getPortaldir($Data);
		$action           = 'Miindex';
		$this->websiteInfo= $this->cache->GetHCache('website',$Data002['wxid']);//读出缓存	
		$this->wxid       = $Data002['wxid'];
		$module           = explode('|',$this->websiteInfo['module2']);
		$courseMode       = M("app_course");$classMode = M("app_class");
		$imgModel         = M('app_carousel');
		$imgAry           = $imgModel->getAll('where wxid='.$Data002['wxid'].' and type=4');
		$allCourse        = $courseMode->getAll("where wxid=".$Data002['wxid'].' and status=2   order by courseid limit 5');
		$courseAry        = $courseMode->getAll("where wxid=".$Data002['wxid'].' and status=2  and courseType=1   order by courseid limit 5');
		$courselive       = $courseMode->getAll("where wxid=".$Data002['wxid'].' and status=2  and courseType=2  order by courseid desc limit 5');
		$courseimg        = $courseMode->getAll("where wxid=".$Data002['wxid'].' and status=2  and courseType=4  order by courseid desc limit 5');
		$coursemusic      = $courseMode->getAll("where wxid=".$Data002['wxid'].' and status=2  and courseType=3  order by courseid desc limit 5');
		$classAry         = $classMode->getAll("where wxid=".$Data002['wxid'].' and (status=2 or status=1)  order by classid limit 5');
		if(is_file($dir['dir2'].'index.php')) {
			// 读取模板文件内容
			$tmplContent =  file_get_contents($dir['dir2'].'index.php');
			$this->dir   =  $dir['dir2'];
		}
		return $tmplContent;
	}
}