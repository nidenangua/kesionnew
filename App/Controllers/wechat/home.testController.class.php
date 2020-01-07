<?php

use Kesion\Controller;
class testController extends CommonController{

    /**
     * 同步微信模版到数据库
     */
    public function gettemplateManageAction()
    {
        $app_wechat_template = M('app_wechat_template');
        $Wechat = new \Core\Wechat($this->wxid);
        $msg_template = $Wechat->msg_template;//获取默认模版
        foreach ($msg_template as $k=>$v){
            $template = $app_wechat_template->getOne('id','where wxid='.$this->wxid.' and number="'.$v['number'].'"');//获取用户的模版
            if (empty($template)){
                $res = $Wechat->addTemplateMessage($v['number']);//添加模版
                if ($res['errcode']==0){
                    $Data['template_id'] = $res['template_id'];
                    $Data['title'] = $v['title'];
                    $Data['number'] = $v['number'];//模版编码
                    $Data['wxid'] = $this->wxid;
                    $Data['create_time'] = time();
                    $app_wechat_template->doAdd($Data,'id');
                }else{
                    KS_INFO('同步失败，请登录你的公众平台检查模版数量是否超出上限');
                }
            }
        }
        $cache = new \Core\Cache();//缓存类
        $cache->PutHCache('wxtemplate',$this->wxid);
        $url=M_URL($this->AppName.'/test','templateManage','',GP(''));
        KS_INFO('同步完成',3,$url);
    }
    public function testAction()
    {
		$orderinfodetail['courseid'] = 766;
		$orderinfodetail['type'] = 1;
		$orderinfo['wxid'] = 2;
		
		$team_link_model = M('app_team_link');
		$team_model = M('app_team');
		$where = "where infoid=$orderinfodetail[courseid] and wxid=$orderinfo[wxid]";
		if ($orderinfodetail['type']==0){
			$where .= " and type in (1,3,4)";
		}elseif($orderinfodetail['type']==1){
			$where .= " and type=2";
		}elseif($orderinfodetail['type']==7){
			$where .= " and type=5";
		}
		$teamIdList = $team_link_model->getAll($where,'team_id');
		if (!empty($teamIdList)){
			$teamModel = new \Kesion\Model\App\TeamModel();
			foreach ($teamIdList as $k=>$v){
				$isassociated = $team_model->getOne('isassociated',"where id=$v[team_id] and wxid=$orderinfo[wxid]");
				if (!empty($isassociated)||$isassociated==1){
					$teamModel->addMember($v['team_id'],$orderinfo['memberid']);
				}
			}
		}
//		$Wechat = new \Core\Wechat($this->wxid);
//		$res = $Wechat->get_industry();
//		if ($res){
//			var_dump($res);die;
//		}else{
//			var_dump($Wechat->errMsg);die;
//		}
//
//		if (!empty(strstr($res,'IT科技'))||!empty(strstr($res,'互联网|电子商务'))){
//			var_dump(1);
//		}else{
//			var_dump(2);
//		}
//		die;
//        $Wechat = new \Core\Wechat($this->wxid);
//        $data = [
//            'first'=>['value'=>'测试中','color'=>'#173177'],
//            'orderMoneySum'=>['value'=>'1234123','color'=>'#173177'],
//            'orderProductName'=>['value'=>'测试中','color'=>'#173177'],
//            'Remark'=>['value'=>'测试中测试中测试中测试中测试中测试中测试中测试中','color'=>'#173177'],
//        ];
//        $res = $Wechat->sendTemplateMessage('oRu5FwsT-Xif7sicKphE4gtSRhSE','TM00015','https://baidu.com',$data);
//        var_dump($Wechat->errMsg);
//        var_dump($res);die;
    }
    /*
     * 删除模版
     */
    public function delTemplateAction()
    {
        $app_wechat_template = M('app_wechat_template');
        $id = ChkClng(KS_G('get.id'));
        $template = $app_wechat_template->getRow('where id='.$id.' and wxid='.$this->wxid);//获取用户的模版
        if (empty($template)){
            KS_INFO('此条记录不存在');
        }
        $res = $app_wechat_template->delete("id=$id and wxid=".$this->wxid);
        if ($res){
            $Wechat = new \Core\Wechat($this->wxid);
            $Wechat->delTemplateMessage($template['template_id']);
            $cache = new \Core\Cache();//缓存类
            $cache->PutHCache('wxtemplate',$this->wxid);
            $url=M_URL($this->AppName.'/test','templateManage','',GP(''));
            KS_INFO('删除成功',3,$url);
        }else{
            KS_INFO('删除失败');
        }

    }
    /**
     * 模版列表
     */
    public function templateManageAction(){
        $cache = new \Core\Cache();//缓存类
        $weixinstatus = $cache->GetHCache('wxconfig',$this->wxid);
        if(empty($weixinstatus[0])){
            $url=M_URL($this->AppName.'/Index','wechatConfig','',GP(''));
            KS_INFO("对不起你还没绑定微信公众号无法使用该功能",0,$url);
        }else{
            $setting= explode('|',$weixinstatus[0]['setting']);
            if($setting[0]==0 || empty($setting[0])){
                $template=0;
            }else{
                $app_wechat_template = M('app_wechat_template');
                $template = $app_wechat_template->getAll('where wxid='.$this->wxid);
            }
            include  CURR_VIEW_PATH . "template.php";
        }
    }
    /**
     * 设置是否启用模版功能
     */
    public function openTempAction()
    {
        if(empty($_POST)){
            echo 'error';
        }else{
            $pz=$_POST['pz'];
            $app_wechat_config = M('app_weixin_config');
            $weixinstatus = $app_wechat_config->getRow('where wxid='.$this->wxid);
            if(empty($weixinstatus)){
                echo "对不起你还没绑定微信公众号无法使用该功能";
            }else{
                $setting= explode('|',$weixinstatus['setting']);
                $setting[0] = $pz;
                $data['setting']=implode('|',$setting);
                $app_wechat_config->update($data,'wxid='.$this->wxid);
                $cache = new \Core\Cache();//缓存类
                $cache->PutHCache('wxconfig',$this->wxid);
                echo '设置成功';
            }
        }
    }


	//获取咨询课程或者班级
	public function getsucaiAction(){
		$type = ChkClng(KS_G('post.type'));
		switch($type)
		{
			//
			case 1:
			  	$Mode = M('app_course');
			  	$info = $Mode->getAll('where wxid='.$this->wxid.' and status !=-1 and courseType=1');
			  	echo json_encode($info);exit;
			break;

			case 2:
			  	$Mode = M('app_course');
			  	$info = $Mode->getAll('where wxid='.$this->wxid.' and status !=-1 and courseType=2');
			  	echo json_encode($info);exit;
			break;
		 	case 3:
			 	$Mode = M('app_course');
			  	$info = $Mode->getAll('where wxid='.$this->wxid.' and status !=-1 and courseType=3');
			  	echo json_encode($info);exit;
	  		break;
	  		case 4:
			 	$Mode = M('app_course');
			  	$info = $Mode->getAll('where wxid='.$this->wxid.' and status !=-1 and courseType=4');
			  	echo json_encode($info);exit;
	  		break;
	  		case 5:
			 	$Mode = M('app_class');
			  	$info = $Mode->getAll('where wxid='.$this->wxid.' and status !=-1');
			  	echo json_encode($info);exit;
	  		break;
	  		case 6:
			 	$Mode = M('app_paper');
			  	$info = $Mode->getAll('where wxid='.$this->wxid.' and status !=-1');
			  	echo json_encode($info);exit;
	  		break;
			default:
				echo json_encode(array());exit;
			break;
		}
	}





	//获取菜单信息
	public function wechatMenusAction(){
		$id   = ChkClng(KS_G('get.id'));
		 $type = null !==GF('type') ? GF('type'):'0';
		$app_wechat_menu = M('app_wechat_menu');
		if($type == 1){
		   $keyModel = M('app_wechat_reply');
		   $keyreplay = $keyModel->getAll('where wxid ='.$this->wxid." and type = 2");
		}
		$memuFirst =  $app_wechat_menu->getAll("where  wxid =". $this->wxid ." and parentid = 0 order by rootid");
        $memuFirstOp =  $app_wechat_menu->getRow('where  wxid ='. $this->wxid .' and id = '.$id);
	    $menu = $app_wechat_menu->getRow('where id = '.$id.' limit 1');
        if($menu){
	    $result = true;
	  }else{
	   $result = false;
	  }
	  if($menu['parentid'] == 0 && $id!==0){
	     $count = $app_wechat_menu->getRow('where parentid = '.$id,'count(*)');
		 $menu['child'] = $count['count(*)'];
	 }
		$module['ismoduleopen'][0]      = ismoduleopen($this->wxid,6,4);
		$module['ismoduleopen'][1]      = ismoduleopen($this->wxid,6,3);
		$module['ismoduleopen'][2]      = ismoduleopen($this->wxid,6,1);
		$module['ismoduleopen'][3]      = ismoduleopen($this->wxid,6,2);
		$module['ismoduleopen'][4]      = ismoduleopen($this->wxid,30);
		$module['ismoduleopen'][5]      = ismoduleopen($this->wxid,10);
		include  CURR_VIEW_PATH . "menu.php";
	}




	//对菜单进行编辑
	public function domenusxxAction(){
		$id = ChkClng(KS_G('get.id'));
		$type = null !==GF('type') ? GF('type'):'0';
	    $app_wechat_menu = M('app_wechat_menu');
		if($type == 3){
		    $Data['name'] = ChkSQL(KS_G('post.name'));
		    $val = $app_wechat_menu->getRow('where id = '.$id);
			$orderid = $app_wechat_menu->getMaxValue('orderid','parentid = '.$id);
			$Data['parentid'] = $id;
			$Data['rootid'] =$val["rootid"];
			$Data['orderid'] =$orderid+1;
			$Data['wxid'] = $this->wxid;
		    $Data['userid'] = $this->userid;
			$Rule['name'] = '菜单|isEmpty';
		    Chkpost($Data,$Rule,$app_wechat_menu);
		    $app_wechat_menu->doAdd($Data,'id');

		}elseif($type == 2){
			$Data['url']=ChkSQL(KS_G('post.url'));
			$Data['type'] = 2;
			$app_wechat_menu->update($Data,'id ='.$id);
		}elseif($type == 1){
			$Data['type'] = 1;
			$Data['keywords'] =ChkSQL(KS_G('post.key'));
			$app_wechat_menu->update($Data,'id ='.$id);

		}elseif($type == 4){
			$Data['name']=ChkSQL(KS_G('post.name'));
			$app_wechat_menu->update($Data,'id ='.$id);
		}elseif($type ==5){
			$rootid = $app_wechat_menu->getMaxValue('rootid','wxid='.$this->wxid);
			$Data['parentid'] = 0;
			$Data['rootid'] = isset($rootid)?$rootid+1: 1;
			$Data['orderid'] = 1;
			$Data['wxid'] = $this->wxid;
		    $Data['userid'] = $this->userid;
			$Data['name'] = ChkSQL(KS_G('post.name'));
			$Rule['name'] = '菜单|isEmpty';
		    Chkpost($Data,$Rule,$app_wechat_menu);
		    $app_wechat_menu->doadd($Data,'id');
		}
	    $url1 = M_URL($this->AppName.'/test','wechatMenus',$id,GP('appid-'.$this->appid,true));
		KS_INFO('更新成功',0,$url1);
	}




	//删除菜单
	public function delMenuAction(){
	   $id = ChkClng(KS_G('get.id'));
       $url1 = M_URL($this->AppName.'/Index','wechatMenus','',GP(''));
	   	if($id ==0){
	        KS_INFO('请选择要删除的选项',0,$url1);
	   	}
		$app_wechat_menu = M('app_wechat_menu');
		$menu = $app_wechat_menu->getRow('where id ='.$id.' limit 1');
		if($menu['parentid'] ==0){
			$Data['rootid'] = 'rootid-1';
			$app_wechat_menu->update($Data,'rootid>'.$menu['rootid'],1);
			$app_wechat_menu->delete('id ='.$id.' or parentid ='.$id );
	    }else{
		    $Data['orderid'] = 'orderid-1';
			$app_wechat_menu->update($Data,'rootid = '.$menu['rootid'].' and orderid>'.$menu['orderid'],1);
			$app_wechat_menu->delete('id ='.$id );
		}

		KS_INFO('删除成功',0,$url1);
	}


	/**
	 * 发送模版消息
	 * $touser 发给谁的openid
	 * $template 模版ID
	 * $data 内容
	 */
	public function sendAction($touser,$template,$data){
		$app_wechat_template = M('app_wechat_template');
		$access_token = getAccessToken($this->wxid);
		//先通过$template查询 判断模版是否开启。如果不开启就停止。开启就给用户发送相关东西 ------待完善
		$url = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token={$access_token}';//access_token改成你的有效值
		$template_msg=array('touser'=>$touser,'template_id'=>$template,'topcolor'=>'#FF0000','data'=>$data);
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,FALSE);
		curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,FALSE);
		// 不输出header头信息
		curl_setopt($curl, CURLOPT_HEADER, 0);
		// 伪装浏览器
		curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36');
		// 保存到字符串而不是输出
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		// post数据
		curl_setopt($curl, CURLOPT_POST, 1);
		// 请求数据
		curl_setopt($curl,CURLOPT_POSTFIELDS,json_encode($template_msg));
		$response = curl_exec($curl);
		curl_close($curl);
		echo $response;
	}
	public function cessssssAction(){
		$i=GetOpenAccessToken();
		//获取预授权码 每个只有20分钟
		$url  = 'https://api.weixin.qq.com/cgi-bin/component/api_create_preauthcode?component_access_token='.$i;
		$appid = KS_C('ServiceProvider_AppId');          //第三方平台 APPID
		$msg=array('component_appid'=>$appid);
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,FALSE);
		curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,FALSE);
		// 不输出header头信息
		curl_setopt($curl, CURLOPT_HEADER, 0);
		// 伪装浏览器
		curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36');
		// 保存到字符串而不是输出
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		// post数据
		curl_setopt($curl, CURLOPT_POST, 1);
		// 请求数据
		curl_setopt($curl,CURLOPT_POSTFIELDS,json_encode($msg));
		$response = curl_exec($curl);
		$pre_auth_code = json_decode($response)->pre_auth_code;
		$redirect_uri =  M_URL($this->AppName.'/test','cesa','',GP('wxid-'.$this->wxid));
		$redirect_uri='https:'.$redirect_uri;
		$authurl = 'https://mp.weixin.qq.com/cgi-bin/componentloginpage?component_appid='.$appid.'&pre_auth_code='.$pre_auth_code.'&redirect_uri='.$redirect_uri;
		echo '<script>window.location.href="'.$authurl.'"</script>';
	}
	public function cesaAction(){
		//接收相关微信授权码和有效期，然后换取相关东西

	}
	/**
	 * 获取二维码生成
	 */
	public function getQRcodeAction(){
		if(empty($_POST['QRtime'])){
			$QRtime=1800;
		}else{
			$QRtime=$_POST['QRtime'];
		}
		$scene_id=10000;
		//获取ticket
		$access_token = getAccessToken($this->wxid);
		$url = 'https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token='.$access_token;
		$data = array("expire_seconds"=>$QRtime,"action_name"=>"QR_SCENE",'action_info'=>array("scene"=>array("scene_id"=>$scene_id)));
		$output= curlPost($url,json_encode($data));
		$token= (array)json_decode($output);
		$ticket = $token['ticket'];
		//通过ticket换取二维码
		$QRurl = "https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=".$ticket;
		echo $QRurl;
	}
	/**
	 * 二维码管理页面
	 */
	public function QRcodeAction(){
		$app_wechat_config = M('app_weixin_config');
		$weixinstatus = $app_wechat_config->getRow('where wxid='.$this->wxid);
		if(empty($weixinstatus)){
			$url=M_URL($this->AppName.'/Index','wechatConfig','',GP(''));
			KS_INFO("对不起你还没绑定微信公众号无法使用该功能",0,$url);
		}else{
			$QRcode = $weixinstatus['qrcode_url'];
			include  CURR_VIEW_PATH . "QRcode.php";
		}
	}
	/**
	 * 测试图文
	 */
	public function catchUpMenuAction(){
		$access_token = getAccessToken($this->wxid);
		include  CURR_VIEW_PATH . "twjdt.php";
		$app_wechat_sucai = M('app_wechat_sucai');
		$sucai= $app_wechat_sucai->getAll("where wxid = " .$this->wxid);
        $sucais = $app_wechat_sucai->getAll("where wxid = " .$this->wxid ." and Thumb_media_id=''");

        $url = M_URL($this->AppName.'/Index','materialManage','',GP(''));
		$num = count($sucais);
		$i =1;

		if(!empty($sucais)){
           foreach ($sucais as $key => $value) {
           //判断缩略图是否上传没上传进行上传处理并录入数据库
			$file_info=array(
		    'filename'=>$value['pic'],  //图片相对于网站根目录的路径
		    'content-type'=>'image',  //文件类型
		    'filelength'=>'12345'         //图文大小
			);
			$jg = ($i/$num)*100;
			echo '<script>$(".charts").attr("w","'.$jg.'");$(".wz").html("<span class=v-l>正在封面同步图片ing<br/>总'.$num.'个,当前同步到第'.$i.'<span/><span class=v-r>进度为：'.round($jg,2).'%</span>");animate()</script>';
			$i++;
			ob_flush();
		    flush();
			$urlPic = "https://api.weixin.qq.com/cgi-bin/material/add_material?access_token=".$access_token."&type=thumb";
            $result = $this->getTuWenCatchUp($file_info,$urlPic);
           if(!empty($result->errcode)){

           	if($token['$result'] == 45009){
                 KS_INFO('更新失败！接口次数上限',0,$url);
			}else{
				 KS_INFO('更新出错',0,$url);
			}
          }else{
			 //var_dump($result);exit;
		    $newdata['Thumb_media_id'] = $result->media_id;
		    $app_wechat_sucai->update($newdata,'id ='.$value['id']);
		    }
          }
	    }


		$sucaisM = $app_wechat_sucai->getAll("where wxid = " .$this->wxid." and parentid = 0 and media_id=''");
		$numM = count($sucaisM);
		$j =1;
		$url = M_URL($this->AppName.'/Index','materialManage','',GP(''));
		foreach ($sucaisM as $key => $value) {

			//判断素材是否上传微信服务器的media_id是否存在，不存在就上传获取media_id。注意这API只有10次机会
				$array = array(
					array(
						"title"=>$value['titles'],
						"thumb_media_id"=>$value['Thumb_media_id'],
			            "author"=>$value['author'],
						"content_source_url"=>$value['content_source_url'],
						"content"=>$value['text'],
						"digest"=>$value['abstract'],
                        "show_cover_pic"=>1,
					)
				);
				//判断是不是多图文，如果是就一起打包
				foreach($sucai as $k => $val){
					if($value['id'] == $val['parentid']){
						$duoarray = array(
							"title"=>$val['titles'],
							"thumb_media_id"=>$val['Thumb_media_id'],
			            	"author"=>$val['author'],
							"content_source_url"=>$val['content_source_url'],
							"content"=>Img($val['text']),
							"digest"=>$val['abstract'],
				            "show_cover_pic"=>1,

						);
						array_push($array,$duoarray);
					}
				}
				$urlthumb = "https://api.weixin.qq.com/cgi-bin/material/add_news?access_token=".$access_token."&type=news";
				$Postdata = array(
	                "articles"=>$array,
	            );
				$thumb = curlPost($urlthumb,json_encode($Postdata,JSON_UNESCAPED_UNICODE));
				$token= (array)json_decode($thumb);
				//var_dump($token);exit;
				if(!empty($token['errcode'])){
					if($token['errcode'] == 45009){
                    	KS_INFO('更新失败！接口次数上限',0,$url);
					}
				}else{
					$media_id['media_id'] = $token['media_id'];
					$media_id['synchronize'] = 1;
					$app_wechat_sucai->update($media_id,'id ='.$value['id']);
					$jg = ($j/$numM)*100;
			    echo '<script>$(".charts").attr("w","'.$jg.'");$(".wz").html("<span class=v-l>正在封面同步图文ing</span><span class=v-r>总'.$num.'个,当前同步到第'.$i.'进度为：'.round($jg,2).'%</span>");animate()</script>';
				$i++;
				ob_flush();
			    flush();
			    KS_INFO('更新完成',0,$url);
				}

		}
		 KS_INFO('更新完成',0,$url);

    }






function getTuWenCatchUp($file_info,$url){
	$ch1 = curl_init ();
    $real_path="{$_SERVER['DOCUMENT_ROOT']}{$file_info['filename']}";
	$data= array("media"=>'@'.$real_path,'form-data'=>$file_info);
    curl_setopt ($ch1, CURLOPT_URL, $url);
    curl_setopt ($ch1, CURLOPT_POST, 1 );
    curl_setopt ($ch1, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt ($ch1, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt ($ch1, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt ($ch1, CURLOPT_SSL_VERIFYHOST, FALSE);
    @curl_setopt ($ch1, CURLOPT_POSTFIELDS,$data);
    $result = json_decode(curl_exec($ch1));
    curl_close ($ch1);
    return 	$result;
}





	/**
	 * 获取微信图文列表
	 */
	public function WXsucaiDonloadAction(){ //图文拉取完成。
		//首先先获取 微信公众号现在一共多少条图文
		$access_token = getAccessToken($this->wxid);
		$url = 'https://api.weixin.qq.com/cgi-bin/material/get_materialcount?access_token='.$access_token;
		$count=curlGet($url);
		$token= (array)json_decode($count);
		$app_wechat_sucai = M('app_wechat_sucai');
		if($token['news_count']!=0){
			$post = 20;
			$offset = 0;
			$news_count=ceil($token['news_count']/$post);
			$url1 ='https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token='.$access_token;
			for($i=0;$i<$news_count;$i++){
				$offset_now = $offset+ ($i*$post);
				$data = array("type"=>'news','offset'=>$offset_now,'count'=>$post);
				$news = curlPost($url1,json_encode($data));
				$newstoken= (array)json_decode($news);
				foreach($newstoken['item'] as $key =>$value){
					if(count($value->content->news_item) !=1){
						$parentid = 0;
						foreach($value->content->news_item as $k =>$v){
							if($k == 0){
								$newsdata['titles'] = urldecode($v->title);
								$newsdata['author'] = urldecode($v->author);
								$newsdata['text'] = urldecode($v->content);
								$newsdata['abstract'] = urldecode($v->digest);
								$newsdata['linkurl'] = urldecode($v->url);
								$newsdata['wxid'] = $this->wxid;
								$newsdata['Thumb_media_id'] = $v->thumb_media_id;
								$newsdata['parentid'] = 0;
								$now = $app_wechat_sucai->getRow('where media_id ="'.$value->media_id.'"');
								if($now){
									$update = $app_wechat_sucai->update($newsdata,'media_id ="'.$value->media_id.'"');
								}else{
									$newsdata['media_id'] = $value->media_id;
									$newsdata['url'] = $value->content->news_item[0]->thumb_url;
									$app_wechat_sucai->doAdd($newsdata,'id');
								}
								$parentid = $now['id'];
								$app_wechat_sucai->delete('parentid = '.$parentid);
							}else{
								$newsdata['titles'] = urldecode($v->title);
								$newsdata['author'] = urldecode($v->author);
								$newsdata['text'] = urldecode($v->content);
								$newsdata['abstract'] = urldecode($v->digest);
								$newsdata['linkurl'] = urldecode($v->url);
								$newsdata['parentid'] = $parentid;
								$newsdata['wxid'] = $this->wxid;
								$newsdata['create_at'] = $value->update_time;
								$newsdata['Thumb_media_id'] = $v->thumb_media_id;
								$app_wechat_sucai->delete('parentid = '.$parentid);
								$app_wechat_sucai->doAdd($newsdata,'id');
							}

						}
					}else{
						$newsdata['titles'] = urldecode($value->content->news_item[0]->title);
						$newsdata['author'] = urldecode($value->content->news_item[0]->author);
						$newsdata['text'] = urldecode($value->content->news_item[0]->content);
						$newsdata['abstract'] = urldecode($value->content->news_item[0]->digest);
						$newsdata['linkurl'] = urldecode($value->content->news_item[0]->url);
						$newsdata['parentid'] = 0;
						$now = $app_wechat_sucai->getRow('where media_id ="'.$value->media_id.'"');
						if($now){
							$update = $app_wechat_sucai->update($newsdata,'media_id ="'.$value->media_id.'"');
						}else{
							$newsdata['media_id'] = $value->media_id;
							$newsdata['wxid'] = $this->wxid;
							$newsdata['url'] = $value->content->news_item[0]->thumb_url;
							$newsdata['create_at'] = $value->update_time;
							$newsdata['Thumb_media_id'] = $value->content->news_item[0]->thumb_media_id;
							$app_wechat_sucai->doAdd($newsdata,'id');
						}
					}
				}
			}
		}
	}




	//对单个图文删除
	public function delMenutestAction(){

		$id = ChkClng(KS_G('get.id'));
		$media_id = GF('media_id');
		if($media_id){
			$access_token = getAccessToken($this->wxid);
			$url = "https://api.weixin.qq.com/cgi-bin/material/del_material?access_token=".$access_token;
			$data= array('media_id'=>$media_id);
			$delMenu=curlPost($url,json_encode($data));
			$token= (array)json_decode($delMenu);
		}
		$now_page =  ChkClng(KS_S('p',1));
		$app_wechat_sucai = M('app_wechat_sucai');
		$app_wechat_sucai->delete('id ='.$id);
		$app_wechat_sucai->delete(' parentid ='.$id);
		$url=M_URL($this->AppName.'/Index','materialManage','',GP('p-'.$now_page));
		KS_INFO("删除成功",0,$url);
	}




	//对图文进行系列删除
	public function bathDelMenutestAction(){
		$ids       = ChkSQL(KS_G('post.id'));
		$ids       = explode(',',$ids);
		$media_ids = KS_G('post.media_id').',';
		$media_ids = explode(',',$media_ids);
		$now_page  =  ChkClng(KS_S('p',1));
		$app_wechat_sucai = M('app_wechat_sucai');
		$access_token = getAccessToken($this->wxid);
		$url      = "https://api.weixin.qq.com/cgi-bin/material/del_material?access_token=".$access_token;
		foreach ($ids  as  $id){
			$app_wechat_sucai->delete('id ='.$id);
			$app_wechat_sucai->delete(' parentid ='.$id);
		}
		if(!empty($media_ids[0])){
			foreach ($media_ids  as  $media_id){
			    $data    = array('media_id'=>$media_id);
			    $delMenu = curlPost($url,json_encode($data));
			    $token   = (array)json_decode($delMenu);
		    }
		}
		$url=M_URL($this->AppName.'/Index','materialManage','',GP('p-'.$now_page));
		KS_INFO("删除成功",0,$url);
	}
	/**
	 * 对单个课程进行上传到微信
	 */
	public function UpdatecourseAction(){
		$courseid = ChkClng(KS_G('get.id'));
		$now_page =  ChkClng(KS_S('p',1));
		$urlp=M_URL('course/Index','index','',GP('p-'.$now_page));
		$access_token = getAccessToken($this->wxid);
		$app_course = M('app_course');
		$course = $app_course->getRow("where courseid = " .$courseid);
		$file_info=array(
		    'filename'=>$course['defaultpic'],  //图片相对于网站根目录的路径
		    'content-type'=>'image',  //文件类型
		    'filelength'=>'12345'         //图文大小
		);
		$url = "https://api.weixin.qq.com/cgi-bin/material/add_material?access_token=".$access_token."&type=thumb";
		$ch1 = curl_init ();
	    $real_path="{$_SERVER['DOCUMENT_ROOT']}{$file_info['filename']}";
	    $data= array("media"=>"@{$real_path}",'form-data'=>$file_info);
	    curl_setopt ( $ch1, CURLOPT_URL, $url );
	    curl_setopt ( $ch1, CURLOPT_POST, 1 );
	    curl_setopt ( $ch1, CURLOPT_RETURNTRANSFER, 1 );
	    curl_setopt ( $ch1, CURLOPT_CONNECTTIMEOUT, 5 );
	    curl_setopt ( $ch1, CURLOPT_SSL_VERIFYPEER, FALSE );
	    curl_setopt ( $ch1, CURLOPT_SSL_VERIFYHOST, FALSE );
	    @curl_setopt ( $ch1, CURLOPT_POSTFIELDS, $data);
	    $result = json_decode(curl_exec ($ch1) );
	    curl_close ( $ch1 );
	    $course['Thumb_media_id'] = $result->media_id;
		//组装成微信需要的data格式
		$array = array(
			array(
				"title"=>$course['title'],
				"thumb_media_id"=>$course['Thumb_media_id'],
	            "author"=>'ks',
				"content_source_url"=>'',//课程详情的链接 等待更新
				"content"=>Img($course['content']),
				"digest"=>$course['intro'],
	            "need_open_comment" =>0,
				"only_fans_can_comment" =>0
			)
		);
		$Postdata = array(
            "articles"=>$array,
        );
        $urlthumb = "https://api.weixin.qq.com/cgi-bin/material/add_news?access_token=".$access_token."&type=news";
        $thumb = curlPost($urlthumb,json_encode($Postdata,JSON_UNESCAPED_UNICODE));
		$token= (array)json_decode($thumb);
		if(!empty($token['errcode'])){
			KS_INFO("同步失败",0,$urlp);
		}else{
			$app_course->update($token,"courseid = " .$courseid);
			KS_INFO("同步成功",0,$urlp,'',2);
		}

	}
	/**
	 * 批量课程进行上传到微信
	 */
	public function batwx(){
		$ids = ChkSQL(KS_G('post.id'));
		$app_course = M('app_course');
		$urlp=M_URL('course/Index','index','',GP('p-'.$now_page));
		$url = "https://api.weixin.qq.com/cgi-bin/material/add_material?access_token=".$access_token."&type=thumb";
		$urlthumb = "https://api.weixin.qq.com/cgi-bin/material/add_news?access_token=".$access_token."&type=news";
		foreach($ids as $courseid){
			$course = $app_course->getRow("where courseid = " .$courseid);
			if(empty($course['media_id'])){
				$file_info=array(
				    'filename'=>$course['defaultpic'],  //图片相对于网站根目录的路径
				    'content-type'=>'image',  //文件类型
				    'filelength'=>'12345'         //图文大小
				);
				$data= array("media"=>"@{$real_path}",'form-data'=>$file_info);
				$result = curlPost($url,$data);
				$template= (array)json_decode($result);
				$course['Thumb_media_id'] = $template->media_id;
				$array = array(
					array(
						"title"=>$course['title'],
						"thumb_media_id"=>$course['Thumb_media_id'],
			            "author"=>'ks',
						"content_source_url"=>'',//课程详情的链接 等待更新
						"content"=>Img($course['content']),
						"digest"=>$course['intro'],
			            "need_open_comment" =>0,
						"only_fans_can_comment" =>0
					)
				);
				$Postdata = array(
		            "articles"=>$array,
		        );
		        $urlthumb = "https://api.weixin.qq.com/cgi-bin/material/add_news?access_token=".$access_token."&type=news";
		        $thumb = curlPost($urlthumb,json_encode($Postdata,JSON_UNESCAPED_UNICODE));
				$token= (array)json_decode($thumb);
				if(!empty($token['errcode'])){
					echo '同步出现问题';
					exit;
				}else{
					$app_course->update($token,"courseid = " .$courseid);
				}
			}
		}
		echo '同步成功';
	}
	/**
	 * 是否开启微信公众号对接
	 */
	public function statusSettingAction(){
		$data['status'] = $_POST['status'];
		$app_weixin_config = M('app_weixin_config');
		$select = $app_weixin_config->getRow('where wxid='.$this->wxid);
		if(!empty($select)){
			$update=$app_weixin_config->update($data,'wxid='.$this->wxid);
			if($update!=0){
				echo '设置成功';
			}else{
				echo '设置失败';
			}
		}else{
			echo '设置成功';
		}
	}
}