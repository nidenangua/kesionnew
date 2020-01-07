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
class H5marketController extends CommonController
{   
     
     public function indexAction(){
     	$istime=null !==GF('istime') ? GF('istime'):'0';//状态筛选 
     	$ismode=null !==GF('ismode') ? GF('ismode'):'0';
     	$isonline =null !==GF('isonline') ? GF('isonline'):'3';
     	$where = 'where id>0';
     	if($istime==1){$where .= ' and istime =1';}
		elseif($istime==2){$where .= ' and istime =2'; }
		elseif($istime==3){$where .= ' and istime =3';}
		elseif($istime==4){$where .= ' and istime =4';}
		elseif($istime==5){$where .= ' and istime =5';}
		
		if($ismode==1){$where .= ' and ismode =1';}
		elseif($ismode==2){$where .= ' and ismode =2'; }
		elseif($ismode==3){$where .= ' and ismode =3';}
		
		if($isonline==1){$where .= ' and isonline =1';}
		elseif($isonline==0){$where .= ' and isonline =0'; }

		$keyword=KS_S('keyword');
		$keytype=KS_S('keytype',1); 
		
		if(!empty($keyword)){
			if($keytype==1){$where.=" and h5name like '%$keyword%'";}
		} 
		
		$H5 = M('app_h5_market');
		$where .= ' and del=1';
		$byname=null !==GF('byname') ? GF('byname'):'addtime desc';//排序
		$options = $H5->getOptions('10',$where);//分页参数设置
		$page = Page($options);
		$values = $H5->getPage($page,$byname,$where);
		foreach($values as $k =>$v){
			$h5_rule = M('app_h5_rule');
			$info  = $h5_rule->getRow('where h5id='.$v['id'].' and wxid=2');
			$values[$k]['h5id'] = $info['id']; 
			$h5_user = M('app_h5_user');
			$info = $h5_user->getAll('where h5id='.$v['id'],'count(*) as numberusers');
			$values[$k]['numberusers']= $info[0]['numberusers'];
		}
       	include CURR_VIEW_PATH . "H5marke/h5marke_list.php";
     }
     /**
      * 添加新活动
      */
     public function H5addAction(){
     	$option=null !==GF('option') ? GF('option'):'3';//状态筛选 
     	$festival = M('app_festival');
		$festivals = $festival->getAll(); 
     	include CURR_VIEW_PATH . "H5marke/H5_add.php";
     	
     }
     /**
      * 添加活动
      */
     public function doaddH5Action(){
     	$option=ChkSQL(KS_G('post.option'));
     	$id = ChkSQL(KS_G('post.id'));
     	$xxk=null !==ChkClng(KS_G('post.reward')) ? ChkClng(KS_G('post.reward')):'0';
     	$Data['reward'] = $xxk;
     	$Data['h5name']    = ChkSQL(KS_G('post.h5name'));//活动
     	$Data['ico']    = ChkSQL(KS_G('post.ico'));//活动缩略图
     	$Data['modetype'] = KS_G('post.modetype');
     	$Data['author']    = ChkSQL(KS_G('post.author'));//作者
     	$Data['isuse']    = 1;
     	$Data['ispad']     = ChkClng(KS_G('post.ispad'));
     	$Data['ismode']    = ChkClng(KS_G('post.ismode'));
     	$Data['ishot']    = ChkClng(KS_G('post.ishot'));
     	$Data['istime'] = KS_G('post.istime'); 
     	$Data['del'] = 1;
     	$Data['addtime']    = time();
     	$Data['enname'] = ChkSQL(KS_G('post.enname'));
     	$Data['url'] = "Images/H5/".$Data['enname']."/";
     	$Data['marketing']=null !==ChkClng(KS_G('post.marketing'))? ChkClng(KS_G('post.marketing')):'0';;
     	if($Data['marketing'] == 1){
     		$Data['price'] = ChkClng(KS_G('post.price'));
     		$Data['number'] = ChkClng(KS_G('post.number'));
     		$Rule['price'] =  '活动价格|isEmpty';
     		$Rule['number'] = '活动次数|isEmpty';
     	}elseif($Data['marketing'] == 2){
     		$Data['package'] = KS_G('post.package'); 
     		if($Data['package'] == '0'){
     			$Data['package'] = '';
     		}
     		$Rule['package'] = '套餐等级|isEmpty';
     	}
      	$H5 = M('app_h5_market');
     	$Rule['h5name'] = '活动名称|isEmpty';
		$Rule['ico']    = '活动缩略图|isEmpty';
		$Rule['author']  = '活动作者|isEmpty';
		$Rule['enname']  = '英文名称|isEmpty';
     	$xmldate['intro']   = ChkSQL(KS_G('post.intro'));
     	$xmldate['instruction']	= ChkSQL(KS_G('post.instruction'));
     	$xmldate['scene']	= ChkSQL(KS_G('post.scene'));
		Chkpost($Data,$Rule,$H5);
		//创建XML文件
		$content='<?xml version="1.0" encoding="UTF-8"?>  
			<setting>
				<admin>
					<H5name>'.$Data['h5name'].'</H5name> <!--活动名称-->
					<ICO>'.$Data['ico'].'</ICO> <!--缩略图，支持外网-->
					<author>'.$Data['author'].'</author>
					<isuse>'.$Data['isuse'].'</isuse>
					<reward>'.$Data['reward'].'</reward>
				</admin>
				<home>
					<gy>';
		foreach($xmldate as $key => $values){
			$content .='<item name="'.$key.'" title="'.$key.'" type="0" value="'.$values.'"></item>';
		}
		$content.='</gy>
					<zd></zd>
				</home> 
			</setting>';
		$url = M_URL('H5market');
		$path = ROOT."Images/H5/".$Data['enname']."/";
		if(!is_dir($path)){
        	$Data['xml'] = "Images/H5/".$Data['enname']."/config.xml";
            make_dir($path);
            $this->File->createFile($path.'config.xml');
            file_put_contents($path.'config.xml', $content);
	    	$H5->doAdd($Data,'id');
	    	KS_INFO('添加成功！',3,$url);
	   	}else{
	   		KS_INFO('该英文名称已经存在，请换个ID试一试');
	    }
		
   }
   /**
    * 修改活动
    */
   public function doeditH5Action(){
   		$option=ChkSQL(KS_G('post.option'));
     	$id = ChkSQL(KS_G('post.id'));
     	$xxk=null !==ChkClng(KS_G('post.reward')) ? ChkClng(KS_G('post.reward')):'0';
     	$Data['reward'] = $xxk;
     	$Data['h5name']    = ChkSQL(KS_G('post.h5name'));//活动
     	$Data['ico']    = ChkSQL(KS_G('post.ico'));//活动缩略图
     	$Data['author']    = ChkSQL(KS_G('post.author'));//作者
     	$Data['isuse']    = 1; 
     	$Data['modetype'] = KS_G('post.modetype');
     	$Data['ishot']    = ChkClng(KS_G('post.ishot'));;
     	$Data['ismode']    = ChkClng(KS_G('post.ismode'));
     	$Data['ispad']     = ChkClng(KS_G('post.ispad'));
     	$Data['istime'] = KS_G('post.istime'); 
     	$Data['del'] = 1;
     	$Data['addtime']    = time();
     	$Data['enname'] = ChkSQL(KS_G('post.enname'));
     	$Data['url'] = "Images/H5/".$Data['enname']."/";
     	$Data['marketing']=null !==ChkClng(KS_G('post.marketing'))? ChkClng(KS_G('post.marketing')):'0';;
     	if($Data['marketing'] == 1){
     		$Data['price'] = ChkClng(KS_G('post.price'));
     		$Data['number'] = ChkClng(KS_G('post.number'));
     		$Rule['price'] =  '活动价格|isEmpty';
     		$Rule['number'] = '活动次数|isEmpty';
     	}elseif($Data['marketing'] == 2){
     		$Data['package'] = 'v1'; 
     		if($Data['package'] == '0'){
     			$Data['package'] = '';
     		}
     		$Rule['package'] = '套餐等级|isEmpty';
     	}
      	$H5 = M('app_h5_market');
     	$Rule['h5name'] = '活动名称|isEmpty';
		$Rule['ico']    = '活动缩略图|isEmpty';
		$Rule['author']  = '活动作者|isEmpty';
		$Rule['enname']  = '英文名称|isEmpty';
     	$xmldate['intro']   = ChkSQL(KS_G('post.intro'));
     	$xmldate['instruction']	= ChkSQL(KS_G('post.instruction'));
     	$xmldate['scene']	= ChkSQL(KS_G('post.scene'));
		Chkpost($Data,$Rule,$H5);
		$H5->update($Data,'id='.$id);
		$url = M_URL('H5market');
    	KS_INFO('修改成功！',3,$url);
   }
   	public function H5editAction(){
   		$option=null !==GF('option') ? GF('option'):'3';//状态筛选 
   		$id = $_GET['id'];
   		$H5 = M('app_h5_market');
   		$values = $H5->getRow('where id='.$id);
   		$xml=simplexml_load_file(ROOT.$values['xml']);
   		foreach($xml->home->gy->item as $key => $v){
   			if($v['name'] == 'intro'){
   				$intro = $v;
   			}elseif($v['name'] == 'instruction'){
   				$instruction = $v;
   			}elseif($v['name'] == 'scene'){
   				$scene = $v;
   			} 
   		}
   		$festival = M('app_festival');
		$festivals = $festival->getAll();
   		include CURR_VIEW_PATH . "H5marke/H5_add.php";
   	}
   	public function delectAction(){
   		$id = $_GET['id'];
   		$H5 = M('app_h5_market');
   		$data['del'] = 0;
   		$H5->update($data,'id='.$id);
   		$url = M_URL('H5market');
   		KS_INFO('删除成功！',3,$url);
   	}
   	public function H5zdyAddAction(){
   		$option = 3;
   		$id = $_GET['id'];
   		$H5 = M('app_h5_market');
   		$values = $H5->getRow('where id='.$id);
   		$xml=simplexml_load_file(ROOT.$values['xml']);
   		$em =$xml->home->zd->item;
   		include CURR_VIEW_PATH . "H5marke/H5zdylist.php";
   	}
   	public function doaddzdyAction(){
   		if($_POST){
   			$id = ChkSQL(KS_G('post.id'));
   			$H5 = M('app_h5_market');
   			$values = $H5->getRow('where id='.$id);
   			$dom=new DOMDocument('1.0'); 
			$dom->load(ROOT.$values['xml']); 
			$em=$dom->getElementsByTagName('zd');
			$new = $dom->createElement('item');
			$new->setAttribute('name',ChkSQL(KS_G('post.name')));
			$new->setAttribute('title',ChkSQL(KS_G('post.title')));
			$new->setAttribute('value',ChkSQL(KS_G('post.value')));
			$new->setAttribute('type',ChkClng(KS_G('post.type')));
			$em->item(0)->appendChild($new);
			$dom->save(ROOT.$values['xml']);
			$url = M_URL('H5market','H5zdyAdd',$id);
			KS_INFO('添加成功',3,$url);
   		}else{
   			$id = $_GET['id'];
   			include CURR_VIEW_PATH . "H5marke/zdy_add.php";
   		}
   		
   	}
   	public function editzdyAction(){
   		if($_POST){
   			$id = ChkSQL(KS_G('post.id'));
   			$xmlname = ChkSQL(KS_G('post.xmlname'));
   			$H5 = M('app_h5_market');
   			$values = $H5->getRow('where id='.$id);
   			$dom=new DOMDocument('1.0'); 
			$dom->load(ROOT.$values['xml']); 
   			$nodes = $dom->getElementsByTagName('item');
			$dels = array();
			for($i = 0 , $len = $nodes->length ; $i < $len ; $i++){
				if ($nodes->item($i)->getAttribute('name') == $xmlname ){
					$nodes->item($i)->setAttribute('name',ChkSQL(KS_G('post.name')));
					$nodes->item($i)->setAttribute('title',ChkSQL(KS_G('post.title')));
					$nodes->item($i)->setAttribute('value',ChkSQL(KS_G('post.value')));
					$nodes->item($i)->setAttribute('type',ChkSQL(KS_G('post.type')));
				}
			}
			$dom->save(ROOT.$values['xml']);
				$url = M_URL('H5market','H5zdyAdd',$id);
			KS_INFO('修改成功',3,$url);
   		}else{
	   		$id = $_GET['id'];
	   		$xmlname=null !==GF('name') ? GF('name'):'0';
	   		$H5 = M('app_h5_market');
	   		$values = $H5->getRow('where id='.$id);
	   		$xml=simplexml_load_file(ROOT.$values['xml']);
	   		$em =$xml->home->zd->item;
	   		$info = array();
	   		foreach($em as $v){
	   			if($v['name'] == $xmlname){
	   				$info[] = $v;
	   			}
	   		}
	   		include CURR_VIEW_PATH . "H5marke/zdy_edit.php";
   		}
   	}
   	public function delzdyAction(){
   		$id = $_GET['id'];
   		$xmlname=null !==GF('xmlname') ? GF('xmlname'):'0';
   		$H5 = M('app_h5_market');
   		$values = $H5->getRow('where id='.$id);
   		$dom=new DOMDocument('1.0'); 
		$dom->load(ROOT.$values['xml']); 
		$nodes = $dom->getElementsByTagName('item');
		$dels = array();
		for($i = 0 , $len = $nodes->length ; $i < $len ; $i++){
			if ($nodes->item($i)->getAttribute('name') == $xmlname ){
				$dels[] = $nodes->item($i) ;
			}
		}
		foreach($dels as $node ){
			$node->parentNode->removeChild($node);
		}
		$dom->save(ROOT.$values['xml']);
		$url = M_URL('H5market','H5zdyAdd',$id);
		KS_INFO('删除成功',3,$url);
   	}
   	public function H5zipAction(){
   		$id = $_GET['id'];
   		$H5 = M('app_h5_market');
   		$values = $H5->getRow('where id='.$id);
   		$path = ROOT.$values['url'];
   		$filepath = $path.'H5.zip';
   		if(is_file($filepath)){
   			unlink($filepath);
   		}
   		$zip = new ZipArchive; 
   		$sourceTemp = '/app/Images/H5ZIP';
   		if($zip->open($filepath, ZipArchive::OVERWRITE)=== TRUE){
		   	$this->createZip(opendir($path),$zip,$path);  
			$zip->close();  
		}
		$Data['zipurl'] = $values['url'].'H5.zip'; 
		$H5->update($Data,'id='.$id);
		$url = M_URL('H5market');
		KS_INFO('打包完成',3,$url);
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
    public function h5userinfoAction(){
    	include  CURR_VIEW_PATH . "H5marke/h5userinfo.php";
    }
    
    
    
    
    
    //营销工具
    public function schemelistAction(){
    	$type=null !==GF('type') ? GF('type'):'0';//状态筛选 
    	$schemeid =null !==GF('schemeid') ? GF('schemeid'):'0';//状态筛选 
     	$where = 'where id>0';
     	if($type!=0){$where .= ' and type ='.$type;}
     	if($schemeid==0){$where.="";}
		else{$where.=" and type=".$schemeid;}
		$keyword = ChkSQL(KS_S('keyword'));
		$keytype = ChkClng(KS_S('keytype',1)); 
		if(!empty($keyword)){
			if($keytype==0){$where.=" and name like '%$keyword%'";}
			elseif($keytype==1){$where.=" and name like '%$keyword%'";}
		} 
		$schemeMode = M('app_h5_scheme');
		$where .= ' and del=1';
		$byname=null !==GF('byname') ? GF('byname'):'addtime desc';//排序
		$options = $schemeMode->getOptions('10',$where);//分页参数设置
		$page = Page($options);
		$values = $schemeMode->getPage($page,$byname,$where);
		foreach($values as $k =>$v){
			$values[$k]['modename'] = M('app_scheme')->getOne('name','where id= '.$v['type']);
		}
		$Mode = M('app_scheme');
		$scheme = $Mode->getAll('where isuse = 1');
       	include CURR_VIEW_PATH . "H5marke/scheme_list.php";
    }
    //添加营销方案
    public function schemeaddAction(){
    	$option=null !==GF('option') ? GF('option'):'3';//状态筛选 
     	$Mode = M('app_scheme');
		$scheme = $Mode->getAll('where isuse = 1');
    	include CURR_VIEW_PATH . "H5marke/scheme_add.php";
    }
    //
    public function doaddschemeAction(){
     	$id = ChkSQL(KS_G('post.id'));
     	$Data['name']    = ChkSQL(KS_G('post.name'));//活动
     	$Data['author']    = ChkSQL(KS_G('post.author'));//作者
     	$Data['isuse']    = 1;
     	$Data['ishot']    = ChkClng(KS_G('post.ishot'));
     	$Data['type'] = KS_G('post.type'); 
     	$Data['del'] = 1;
     	$Data['addtime']    = time();
     	$Data['contents'] = KS_G('post.contents'); 
      	$Data['enname'] = ChkSQL(KS_G('post.enname'));
     	$Data['marketing']=null !==ChkClng(KS_G('post.marketing'))? ChkClng(KS_G('post.marketing')):'0';;
     	if($Data['marketing'] == 2){
     		$Data['package'] = KS_G('post.package'); 
     		if($Data['package'] == '0'){
     			$Data['package'] = '';
     		}
     		$Rule['package'] = '套餐等级|isEmpty';
     	}
      	$schemeMode = M('app_h5_scheme');
     	$Rule['name'] = '方案名称|isEmpty';
		$Rule['author']  = '方案作者|isEmpty';
//		$Rule['enname']  = '英文名称|isEmpty';
		$Rule['contents'] = '方案内容|isEmpty';
		Chkpost($Data,$Rule,$schemeMode);
    	$schemeMode->doAdd($Data,'id');
    	$url= M_URL('H5market','schemelist');
    	KS_INFO('添加成功！',3,$url);
    }
    //删除方案
    public function delectschemeAction(){
   		$id = $_GET['id'];
   		$schemeMode = M('app_h5_scheme');
   		$data['del'] = 0;
   		$schemeMode->update($data,'id='.$id);
   		$url = M_URL('H5market','schemelist');
   		KS_INFO('删除成功！',3,$url);
   	}
   	//
   	public function schemeeditAction(){
   		$option=null !==GF('option') ? GF('option'):'3';//状态筛选 
   		$id = $_GET['id'];
   		$schemeMode = M('app_h5_scheme');
   		$values = $schemeMode->getRow('where id='.$id);
   		$Mode = M('app_scheme');
		$scheme = $Mode->getAll('where isuse = 1');
   		include CURR_VIEW_PATH . "H5marke/scheme_add.php";
   	}
   	//修改
   	public function doeditschemeAction(){
     	$id = ChkSQL(KS_G('post.id'));
     	$Data['name']    = ChkSQL(KS_G('post.name'));//活动
     	$Data['author']    = ChkSQL(KS_G('post.author'));//作者
     	$Data['isuse']    = 1;
     	$Data['ishot']    = ChkClng(KS_G('post.ishot'));
     	$Data['type'] = KS_G('post.type'); 
     	$Data['del'] = 1;
     	$Data['addtime']    = time();
     	$Data['contents'] = KS_G('post.contents'); 
      	$Data['enname'] = ChkSQL(KS_G('post.enname'));
     	$Data['marketing']=null !==ChkClng(KS_G('post.marketing'))? ChkClng(KS_G('post.marketing')):'0';;
     	if($Data['marketing'] == 2){
     		$Data['package'] = KS_G('post.package'); 
     		if($Data['package'] == '0'){
     			$Data['package'] = '';
     		}
     		$Rule['package'] = '套餐等级|isEmpty';
     	}
      	$schemeMode = M('app_h5_scheme');
     	$Rule['name'] = '方案名称|isEmpty';
		$Rule['author']  = '方案作者|isEmpty';
//		$Rule['enname']  = '英文名称|isEmpty';
		$Rule['contents'] = '方案内容|isEmpty';
		Chkpost($Data,$Rule,$schemeMode);
    	$schemeMode->update($Data,'id='.$id);
    	$url= M_URL('H5market','schemelist');
    	KS_INFO('修改成功！',3,$url);
    }
    public function batchschemeAction(){ 
    	$id = isset($_POST["id"])?$_POST["id"]:'';
		$now_page = ChkClng(KS_S('p',1));
		if(empty($id)){KS_INFO("请选择");}
		$common_domain = M('app_h5_scheme');
		$url = M_URL('home/H5market','schemelist','',GP('p-'.$now_page));
		//批量删除
		if(KS_G('post.batch')==4){
			$Data['del'] = 0;
			foreach ($id as $v ){$common_domain->update($Data,"id=$v");}
			KS_INFO('批量删除成功',0,$url);
		}
		//批量审核
		elseif(KS_G('post.batch')==0){
		    $data['marketing'] = 0;
		    $data['package'] = '';
		    foreach ($id as $v ) {$common_domain->update($data, "id=$v");}
			KS_INFO('设置成功',0,$url);
		}
		//批量取消审核
		elseif(KS_G('post.batch')==1){
			$data['marketing'] = 2;
		    $data['package'] = 'v3';
			foreach ($id as $v ) {$common_domain->update($data, "id=$v");}
			KS_INFO('设置成功',0,$url);
		}
		elseif(KS_G('post.batch')==2){
			$data['marketing'] = 2;
		    $data['package'] = 'v4';
			foreach ($id as $v ) {$common_domain->update($data, "id=$v");}
			KS_INFO('设置成功',0,$url);
		}
    }
}