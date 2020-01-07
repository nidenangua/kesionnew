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
class LabelController extends CommonController
{
	public function indexAction(){
		$now_page = ChkClng(KS_S('p'));
		$tempid   = ChkClng(KS_S('tempid'));
		$option   = null !==GF('option') ? GF('option'):'0';
		$where    = 'where tempid='.$tempid;
		///$values = $this->cache->getACache('appcategory');//取出缓存
		$common_temp = M('common_temp');//实例化云服务表
		$tempval     = $common_temp->getRow("where tempid=$tempid limit 1");
		$common_label = M('common_label');//实例化云服务表
		$options  = $common_label->getOptions('10',$where);//分页参数设置
		$page     = Page($options);
		$values   = $common_label->getPage($page,'adddate desc',$where);
	    include  CURR_VIEW_PATH . "Label/Lable_list.php";
    }
	public function LabelAddAction(){
		$labeltype   = ChkClng(KS_S('labeltype'));
		$tempid      = ChkClng(KS_S('tempid'));
		$common_temp = M('common_temp');//实例化云服务表
		$tempval     = $common_temp->getRow("where tempid=$tempid limit 1");
		//$common_user = M('common_user');//实例化云服务表
		//$appcategory = $this->cache->GetHCache('appcategory',2);//读出缓存
		$value       = '';
		$common_app  = M('common_app');
		$values      = $common_app->getAll('where basictype='.$labeltype,'appid,appname');
		$filename    = BC($labeltype);
		include  CURR_VIEW_PATH . $filename;
	}
	public function LabelcloneAction(){
		$tempid      = ChkClng(KS_S('tempid'));
		$common_temp = M('common_temp');//实例化云服务表
		$tempval     = $common_temp->getRow("where tempid=$tempid limit 1");
		$values      = $common_temp->getAll();
		include  CURR_VIEW_PATH . "Label/Label_clone.php";
	}
	public function LabeldocloneAction(){
		$Labelcheck    = cookie('Labelcheck');
		if(empty($Labelcheck)){KS_INFO('请选择要克隆的标签');}
		$tempid        = ChkClng(KS_G('post.tempid'));//表ID
		if(empty($tempid)){KS_INFO('请选择要克隆到的模板');}
		$RdbRepeatName = ChkClng(KS_G('post.RdbRepeatName'));//表ID
		$common_label  = M('common_label');//实例化云服务表
		$Labelarr      = $common_label->getAll("where labelid in($Labelcheck)");
		foreach($Labelarr as $k=>$v){
			$Data['tempid']       = $tempid;
			$Data['adddate']      = time();
			$Data['labelcontent'] = EncodeSQL($v['labelcontent']);
			$Data['labeltype']    = $v['labeltype'];
			$labelRepeat = $common_label->getOne('count(*)',"where tempid=$tempid and labelname='$v[labelname]'");
			if($labelRepeat==0){
				$Data['labelname']  = $v['labelname'];
				$common_label->doAdd($Data,'labelid');
			}else{
				if($RdbRepeatName==1){
				   $Data['labelname']  = $v['labelname'].'_copy';
				   $common_label->doAdd($Data,'labelid');
				}
				elseif($RdbRepeatName==2){}
				elseif($RdbRepeatName==3){
				   $Data['labelname']  = $v['labelname'];
				   $common_label->delete("tempid=$tempid and labelname='$v[labelname]'");
				   $common_label->doAdd($Data,'labelid');
				}
			}
		}
		$this->cache->PutLCache('labelinfo',$tempid,1);
		cookie('Labelcheck',null);
		$url = M_URL('Label','','',GP(''));
		KS_INFO('克隆成功',3,$url);
	}
	public function LabeldoAddAction(){
		$Data['tempid']    = ChkClng(KS_S('tempid'));
		$labeltype = ChkClng(KS_S('labeltype'));
		$Data['labelname'] = ChkSQL(KS_G('post.labelname'));
		$Data['labeltype'] = ChkClng($labeltype);
		$Data['adddate']   = time();
		$Data['labelcontent']  = EncodeHtml(KS_G('post.labelcontent'));
		$common_label          = M('common_label');//实例化云服务表
		$Rule['labelname']     = '标签名称|isEmpty,isDbexis';
		$Rule['labelcontent']  = '样式循环体|isEmpty';
		Chkpost($Data,$Rule,$common_label,"tempid=$Data[tempid]");
		$common_label->doAdd($Data,'labelid');
		$this->cache->PutLCache('labelinfo',$Data['tempid'],1);
		$url = M_URL('Label','','',GP(''));
		KS_INFO('添加成功',0,$url);
	}
	/**
	 * 编辑标签
	 */
	public function LabelEditAction(){
		$labeltype   = ChkClng(KS_S('labeltype'));
		$tempid      = ChkClng(KS_S('tempid'));
		$common_temp = M('common_temp');//实例化云服务表
		$tempval     = $common_temp->getRow("where tempid=$tempid limit 1");
		$Label       = new \Core\Label();
		$labelid     = ChkSQL(KS_G('request.id'));
		$now_page    = ChkClng(KS_S('p'));
        $common_label= M('common_label');
        $value       = $common_label->getRow('WHERE tempid='.$tempid.' and labelid='.$labelid);
        if (!$value){
            KS_INFO('出错啦,找不到标签！',0,KS_ComeUrl(),'',3);
        }

		if($labeltype == 3){$courseType = $Label->GetParam($value['labelcontent'],'courseType');}
		if($labeltype != 0){
			 $appid   = $Label->GetParam($value['labelcontent'],'Appid');
			// $appname = $this->cache->GetA('appinfo','appid',$appid,'appname');
		}
		$basictype    = $Label->GetParam($value['labelcontent'],'Basictype');
        $filename     = BC($labeltype);
		include  CURR_VIEW_PATH . $filename;
	}
	public function LoopAddAction(){
		$fieldname = null !==GF('fieldname') ? GF('fieldname'):'0';//表ID
		$fieldtype = null !==GF('fieldtype') ? GF('fieldtype'):'0';//表ID
		$appid     = null !==GF('appid') ? GF('appid'):'0';//表ID
		$appename  = $this->cache->GetA('appinfo','appid',$appid,'appename');
        include  CURR_VIEW_PATH . "Label/Loop_add.php";
	}
	/**
	 * 保存标签修改
	 */
	public function LabeldoEditAction(){
		$labelid              = ChkClng(KS_G('request.id'));//表ID
		$now_page             = ChkClng(KS_S('p')); //表ID
		$Data['tempid']       = ChkClng(KS_S('tempid'));
		$Data['labelname']    = ChkSQL(KS_G('post.labelname'));
		$Data['adddate']      = time();
		$Data['labelcontent'] = EncodeHtml(KS_G('post.labelcontent'));
		$common_label         = M('common_label');//实例化云服务表
		$Rule['labelname']    = '标签名称|isEmpty,isDbexis';
		$Rule['labelcontent'] = '样式循环体|isEmpty';
		Chkpost($Data,$Rule,$common_label,"tempid=$Data[tempid] and labelid!=$labelid");
		$common_label->update($Data,'labelid='.$labelid);
		$this->cache->PutLCache('labelinfo',$Data['tempid'],1);
		$url = M_URL('Label','','',GP('p-'.$now_page));
		KS_INFO('修改成功',0,$url);
	}
	public function deleteLabelAction(){
		$tempid = ChkClng(KS_S('tempid'));
		$labelid = ChkSQL(KS_G('request.id'));
		$now_page = ChkClng(KS_S('p'));
		$common_label = M('common_label');//实例化云服务表
		$common_label->delete("labelid=$labelid");
		$this->cache->PutLCache('labelinfo',$tempid,1);
		$url = M_URL('Label','','',GP('p-'.$now_page));
		ks_header($url);
	}
	public function batchdelLabelAction(){
		$Labelcheck    = cookie('Labelcheck');
		$now_page      = ChkClng(KS_S('p'));
		if(empty($Labelcheck)){KS_INFO('请选择要克隆的标签',4);}
		$tempid        = ChkClng(KS_S('tempid'));
		if(empty($tempid)){KS_INFO('模板为空，错误',4);}
		$common_label          = M('common_label');//实例化云服务表
		$common_label->delete("tempid=$tempid and labelid in($Labelcheck)");
		$this->cache->PutLCache('labelinfo',$tempid,1);
		cookie('Labelcheck',null);
		$url = M_URL('Label','','',GP('p-'.$now_page));
		ks_header($url);
	}
	public function LabelpageAction(){
		$values = $this->cache->GetACache('labelpage');
		include  CURR_VIEW_PATH . "Label/Labelpage_list.php";
	}
	public function PageAddAction(){
		include  CURR_VIEW_PATH . "Label/Labelpage_add.php";
	}
	public function PagedoAddAction(){
		$common_label_page    = M('common_label_page');
		$Data['labelname']    = ChkSQL(KS_G('post.labelname'));
		$Data['labelcontent'] = ChkSQL(KS_G('post.labelcontent'));
		$pageid = $common_label_page->doAdd($Data,'pageid');
		$Datat['labelename'] = '[KS:PageStr'.$pageid.']';
		$common_label_page->update($Datat,"pageid = $pageid");
		$this->cache->PutACache('labelpage');//存入缓存
		$url=M_URL('Label','Labelpage','',GP(''));
		KS_INFO("添加成功",0,$url);
	}
	public function PagedoEditAction(){
		$pageid       = ChkSQL(KS_G('post.pageid'));
		$labelname    = ChkSQL(KS_G('post.labelname'));
		$labelcontent = ChkSQL(KS_G('post.labelcontent'));
		$common_label_page = M('common_label_page');
		foreach ($pageid as $k => $v)
		{
		    $Data['labelname']    = $labelname[$k];
			$Data['labelcontent'] = $labelcontent[$k];
		    $common_label_page->update($Data,"pageid = $v");
		}
		$this->cache->PutACache('labelpage');//存入缓存
		$url = M_URL('Label','Labelpage','',GP(''));
		KS_INFO("更新成功",0,$url);
	}
	//删除分页样式
	public function deletePageAction(){
		$pageid = ChkSQL(KS_G('request.id'));
		//$now_page = ChkClng(KS_S('p'));
		$common_label_page = M('common_label_page');
		$common_label_page->delete("pageid=$pageid");
		$this->cache->PutACache('labelpage');//存入缓存
		$url = M_URL('Label','Labelpage','',GP(''));
		ks_header($url);
	}
}