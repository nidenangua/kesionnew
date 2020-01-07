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
   public function indexAction(){//进入首页
         $site          = $this->cache->GetACache('setting');//读出缓存
		 $livelistModel = M('app_live');
		 $live          = $livelistModel -> getRow('where userid ='.$this->userid);
		 $userModel     = M('common_user');
		 $balance       = $userModel->getOne('money','where userid = '.$this->userid);
		 include  CURR_VIEW_PATH . "index.php";
   }
   //直播流列表
   public function livelistAction(){
	   $listliveModel = M('app_live_list');
	   $where         = 'where wxid = '.$this->wxid;
	   $options       = $listliveModel->getOptions('5',$where);//分页参数设置
	   $page          = new page($options);
	   $values        = $listliveModel->getPage($page,' adddate desc',$where);
	   $baidu = new Baidulive($this->live['domain']);
	   foreach($values as $k=>$v){
		 try{
		    $aa  =  $baidu->selectStream($v['stream']);
			$values[$k]['status'] = $aa->status;
			$values[$k]['play']   = $aa->play->flvUrls->L1;
		 }catch(Exception $e){
			$values[$k]['status'] = '还未开通';		
		 }
	  }
	  include  CURR_VIEW_PATH . "live_list.php"; 
   }
   //更新数据
   public function liveDateAction(){
	     $baidu = new Baidulive($this->live['domain']);
	     $listliveModel = M('app_live_list');
		 $liveModel = M('app_live');
		 $lives =  $listliveModel ->getAll('where userid = '.$this->userid);
		 $flow = 0;
		 foreach($lives as $k=>$v){
			 try{
				 $aa =  $baidu->selectStreamDate($v['stream']);
				 $Data['flow'] = round($aa->aggregate->downstreamInByte/1024/1024,2);
				 $Data['playcount'] = $aa->aggregate->playCount;
				 $flow+=$Data['flow'];
				 $listliveModel->update($Data,'id='.$v['id']);
			 }catch(Exception $e){
			 }
		 }
		 $Data1['flow'] = $flow;
		 $Data1['number'] = count($lives);
		 $liveModel -> update($Data1,'wxid = '.$this->wxid);
		 $url1= M_URL($this->AppName.'/Index','index','',GP(''));
		 KS_INFO('更新成功',0,$url1);
   }
   //播放器
   public function playSettingAction(){//进入播放器配置
		$uservod = M('app_live');
		$vod = $uservod->getRow('where wxid = '.$this->wxid);
		$setting = explode('※',$vod['setting']);
		include  CURR_VIEW_PATH . "play_setting.php";
	}
	//播放器配置
	public function doplaySettingAction(){//进行播放器
		 $uservod = M('app_live');
		 $vod     = $uservod->getRow('where wxid = '.$this->wxid);
		 $setting = explode('※',$vod['setting']);
		 $setting[0] = ChkSQL(KS_G('post.title'));//播放器名称
		 $setting[1] = ChkSQL(KS_G('post.weight'));//宽度
		 $setting[2] = ChkSQL(KS_G('post.hight'));//高度
		 $setting[3] = ChkSQL(KS_G('post.skin'));//皮肤
		 if(!empty($_FILES['logo']['tmp_name'])){
			$this->upload->removefile($setting[4]);
			$this->upload->savePath = 'school/'.$this->wxid.'/'; // 设置附件上传（子）目录
			$info = $this->upload->uploadOne($_FILES['logo']);
			if(!$info) {KS_INFO($this->upload->getError());}// 上传错误提示错误信息
			else{
				$setting[4] = ChkSQL($this->upload->uootPath.$info['savepath'].$info['savename']);//应用封面图片
			}
		 }
		 $setting[5]  = ChkSQL(KS_G('post.logoPosition'));//是否显示logo
		 $setting[6]  = ChkSQL(KS_G('post.autostart'));//是否自动播放
		 //广告
		 $setting[7]  = ChkSQL(KS_G('post.isStart'));//是否启用片头广告
	     $setting[8]  = ChkSQL(KS_G('post.img1'));//片头广告图片地址
		 $setting[9]  = ChkSQL(KS_G('post.url1'));//图片地址链接
		 $setting[10] = ChkSQL(KS_G('post.time1'));//片头广告时间
		 $setting[11] = ChkSQL(KS_G('post.isSuspend'));//是否启用暂停广告
		 $setting[12] = ChkSQL(KS_G('post.img2'));//暂停片头广告图片地址
		 $setting[13] = ChkSQL(KS_G('post.url2'));//暂停广告地址链接
		 $setting[14] = ChkSQL(KS_G('post.isSuspend'));//是否结尾暂停广告
		 $setting[15] = ChkSQL(KS_G('post.img3'));//结尾广告图片地址
		 $setting[16] = ChkSQL(KS_G('post.url3'));//结尾广告链接       
		 //跑马灯
		 $setting[17] = ChkSQL(KS_G('post.isMarquee'));//是否显示跑马灯  
		 $setting[18] = ChkSQL(KS_G('post.marqueeText'));//跑马灯内容   
		 $setting[19] = ChkSQL(KS_G('post.marqueeSize'));//字体大小   
		 $setting[20] = ChkSQL(KS_G('post.marqueeColcr'));//字体颜色   
		 //自定义右键
		 $setting[21] = ChkSQL(KS_G('post.isRightclick1'));//是否定义右键1  
		 $setting[22] = ChkSQL(KS_G('post.title1'));//右键一名称   
		 $setting[23] = ChkSQL(KS_G('post.rightUrl1'));//右键一链接  
		 $setting[24] = ChkSQL(KS_G('post.isRightclick2'));//右键二   
		 $setting[25] = ChkSQL(KS_G('post.title2'));//右键二名称  
		 $setting[26] = ChkSQL(KS_G('post.rightUrl2'));//右键二链接
		 $setting[27] = ChkSQL(KS_G('post.isRightclick3'));//右键三   
		 $setting[28] = ChkSQL(KS_G('post.title3'));//右键三名称   
		 $setting[29] = ChkSQL(KS_G('post.rightUrl3'));//右键三链接   
		  
		 $Data['setting'] = implode('※',$setting);
	     $uservod->update($Data," wxid = $this->wxid");
		 $url1= M_URL($this->AppName.'/Index','playSetting','',GP(''));
		 KS_INFO('更新成功',0,$url1);
    }
	public function liveAddressAction(){
		 $uservod = M('app_live');
		 $id      = ChkClng(KS_G('get.id')); 
		 $live    = $uservod->getRow('where wxid = '.$this->wxid);
		 $url1    = M_URL($this->AppName.'/Index','livelist','',GP(''));
		 switch($live){
		    case 2  : KS_INFO('您已欠费',0,$url1);	
		    case 3  : KS_INFO('您已被停用',0,$url1);	
		 }
		 $livelistModel = M('app_live_list');
		 $stream = $livelistModel->getOne('stream','where id ='.$id);
		 $baidu  = new Baidulive($this->live['domain']);
		 try{
			 $aa  = $baidu->selectStream($stream);
			 if($aa->status != "ONGOING"){KS_INFO('直播快开始了',0,$url1);}
			 $playurl[0]['url'] =$aa->play->flvUrls->L0;
			 $playurl[0]['teblemname'] = '线路一';
			 $playurl[1]['url'] =$aa->play->flvUrls->L1;
			 $playurl[1]['teblemname'] = '线路二';
			 $playurl[2]['url'] =$aa->play->flvUrls->L2;
			 $playurl[2]['teblemname'] = '线路三';
			 $setting = explode('※',$live['setting']);
			 $player = getplay($playurl,$setting,1);
		 }catch(Exception $e){
			 KS_INFO('直播还未开始',0,$url1);		
		 }
		 include  CURR_VIEW_PATH . "live_play.php";
	} 
	//直播应用配置
	public function settingAction(){
		$setting = getSet($this->wxid,$this->appid);//获取网站配置
		include  CURR_VIEW_PATH . "setting.php";
	}
	public function doSettingAction(){
		$setting = getSet($this->wxid,$this->appid);//获取网站配置
		$setting[0] = ChkClng(KS_G('post.setting0'));//是否开启 
		$Data['setting'] = implode('|',$setting);
		$apprelateModel         = M('common_app_userrelate');
	    $apprelateModel->update($Data,'wxid='.$this->wxid.' and appid = '.$this->appid); 
		KS_INFO('保存成功',6);
	}
}