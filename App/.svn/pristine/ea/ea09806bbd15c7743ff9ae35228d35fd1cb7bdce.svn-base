<?php
use Kesion\Controller;
class WxController extends Controller
{
    /**
     * 消息与事件接收
     */
    public function indexAction(){
		$appid = KS_G('get.appid');
    	$appid = rtrim($appid, "/");
    	$appid = ltrim($appid, "/");


    	if(empty($appid)&&isset($GLOBALS['_DoM']['wxid'])&&ChkClng($GLOBALS['_DoM']['wxid'])!=0){
    		$this->wxid = $GLOBALS['_DoM']['wxid'];
    		$this->webchatObj = new \Core\Wechat();
			if(!isset($_GET['echostr'])){
				$this->responseMsg1();
			}else{
				$this->webchatObj->valid();
			}
    	}else{  //第三方授权来的
    		$weixin_config    = M('app_weixin_config');
    		$this->wxid       = $weixin_config->getOne('wxid','where appid="'.$appid.'" order by id');
    		$this->appid      = $appid;
			$this->webchatObj = new \Core\Wechat($this->wxid);
			if(!isset($_GET['echostr'])){
				$this->responseMsg();
			}else{
				$this->webchatObj->valid();
			}
    	}
    }
	public function responseMsg(){
		include_once(ROOT.'Plus/wxBizMsgCrypt.php');
		$appId          = KS_C('ServiceProvider_AppId');          //第三方平台 APPID
		$token          = KS_C('ServiceProvider_Token');          //消息校验Token
		$encodingAesKey = KS_C('ServiceProvider_Key');            //消息加密KEY  在KS_cls/Conf/convention.php里配置
		$postStr = file_get_contents("php://input");
		$timeStamp  = empty($_GET['timestamp'])     ? ""    : trim($_GET['timestamp']) ;
		$nonce      = empty($_GET['nonce'])     ? ""    : trim($_GET['nonce']) ;
		$msg_sign   = empty($_GET['msg_signature']) ? ""    : trim($_GET['msg_signature']) ;
		$pcs = new WXBizMsgCrypt($token,$encodingAesKey,$appId);
		if (!empty($postStr)){
			libxml_disable_entity_loader(true);
			// 第三方收到公众号平台发送的消息
			$msg = '';
			$errCode = $pcs->decryptMsg($msg_sign, $timeStamp, $nonce, $postStr, $msg);
			$postObj      = simplexml_load_string($msg, 'SimpleXMLElement', LIBXML_NOCDATA);
            $this->Object = $postObj;
			if(!$postObj){
				$ermsg='';$errCode = $pcs->encryptMsg('',$timeStamp,$nonce,$ermsg);
				echo $ermsg; exit;
			}
			$fromUsername = $postObj->FromUserName;
			$toUsername   = $postObj->ToUserName;
			$keyword      = trim($postObj->Content);
			$time         = time();
			$evenkey      = $postObj->EventKey;
			$tmp_arr      = $this->webchatObj->getXmlArr();
			switch($postObj->MsgType){
				case 'event':
					if($postObj->Event == 'subscribe'){


                      if (strstr($evenkey,'qrscene_')==false){       //不是HOME端第一次 扫码关注来的
                            $resultStr=$this->wechatReply(1);   //关注回复
                            if ($resultStr){   //有找到
                                $msg='';
                                $errCode = $pcs->encryptMsg($resultStr,$timeStamp,$nonce,$msg);
                                if (isset($msg)){
                                    echo($msg);
                                }
                            }
                       }
                       else   //第一次注册，进HOME端扫码关注，待检查，未完善
                        {


							$userInfo = $this->GetWxinfoAction($fromUsername);//得到用户信息
							$nickname = $userInfo['nickname'];
							$headimgurl = $userInfo['headimgurl'];
							$remark   = $userInfo['remark'];
							$city     = $userInfo['province'].$userInfo['city'];
							$evenkey  = str_replace('qrscene_','',$evenkey);
                            $this->wxid = ChkClng($evenkey);
							$domain = wx_Url($this->wxid);

							if(!empty($domain)){

                                $websiteModel         = M('common_user_website');
								$Datafour['initial']  = 1;
							    $websiteModel->update($Datafour,"wxid=".$evenkey);   //关注成功，标注已初始化

								$this->cache->PutHCache('website',$this->wxid);//写入缓存
								$wxinfo      = $this->cache->GetHCache('website',$this->wxid);//读出缓存
								$Dotask  = new \Core\Dotask();
                                $Dotask->checkTask($this->wxid,2);
								//$contentStr  = "Hi~".$nickname.",欢迎来到科汛V名师！\r\n您的网校\"".$wxinfo['sitename']."\"已成功绑定公众号!\r\n微门户：".shortchain('https://'.$domain['domain'].'/h5market/Miindex/2.0');

								$url1           = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".KS_C('WeChat_AppId')."&secret=".KS_C('WeChat_AppSecret');
								$data1          = curlGet($url1);
								$access_token   = json_decode($data1,true)['access_token'];
								$url2           = "https://api.weixin.qq.com/cgi-bin/media/upload?access_token=".$access_token."&type=image";
								$cfile          = array();

								$image    = new \Core\Image(\Core\Image::IMAGE_IMAGICK);
								$img      = ROOT.'Images/QRcode/'.createQRcode(ROOT.'Images/QRcode/',$domain.'/?f=m','Q',5,'weimenhu');


								$location = array(172,941);//坐标位置

								$startimg = ROOT.'Images/images/201812/start.jpg';            //模板
								$endimg   = ROOT.'Images/images/201812/111111.jpg';           //生成的文件名
                                $image->open($startimg)->water($img,$location)->save($endimg);


                                $textttf  = ROOT.'KS_cls/Kesion/Core/Verify/zhttfs/1.ttf';
                                $image = new \Core\Image();
                                $location = array(267,730);//坐标位置
                                $image->open($endimg)->text($nickname,$textttf,35,'#000000',$location)->save($endimg);

                                $location = array(220,788);//坐标位置
                                $image->open($endimg)->text('邀请你加入'.$wxinfo['sitename'],$textttf,20,'#666666',$location)->save($endimg);

								$cfile      = curl_file_create($endimg);
								$result     = $this->https_request($url2,$cfile);
								$media_id   = json_decode($result,true)['media_id'];
			                    $resultStr  = sprintf($tmp_arr['image'], $fromUsername,$toUsername,$time,$media_id);
								$ermsg      = '';
								$errCode    = $pcs->encryptMsg($resultStr,$timeStamp,$nonce,$ermsg);

								echo isset($ermsg) ? $ermsg:null;

								//$resultStr   = sprintf($tmp_arr['text'], $fromUsername, $toUsername, $time, $contentStr);
								//$ermsg       ='';$errCode = $pcs->encryptMsg($resultStr,$timeStamp,$nonce,$ermsg);
								//echo isset($ermsg) ? $ermsg:null;
							}
						}
                    }elseif($postObj->Event == 'CLICK'){

                        $menudb   = M('app_wechat_menu');                                                       //查找菜单里的消息回复
                        $contents = $menudb->getOne('contents',"where name='".ChkSQL($evenkey)."'");
                        if ($contents){
                            $contentsArr = json_decode(EncodeHtml(DecodeSQL($contents)),true);   //对json转数组
                            $Wechat = new \Core\Wechat();
                            $resultStr=$Wechat->getWechatSucai($this->Object,$this->wxid,$contentsArr);  //调用素材的构造并输出
                            if ($resultStr){   //有找到
                                $msg='';
                                $errCode = $pcs->encryptMsg($resultStr,$timeStamp,$nonce,$msg);
                                if (isset($msg)){
                                    echo($msg);
                                }

                            }

                        }

                    }
                    elseif($postObj->Event == 'weapp_audit_success'){
						$weixin_config = M('app_wxapplet_config');
    					$Datass['isaudit'] = 2;
    					$where->update($Datass,'appid='.$this->appid);
					}elseif($postObj->Event == 'weapp_audit_fail'){
						$weixin_config = M('app_wxapplet_config');
    					$Datass['isaudit'] = 0;
    					$Datass['msg']     = $postObj->Reason;
    					$where->update($Datass,'appid='.$this->appid);
					}elseif($postObj->Event == 'SCAN'){
						$userInfo = $this->GetWxinfoAction($fromUsername);//得到用户信息
						$nickname = $userInfo['nickname'];
						$headimgurl = $userInfo['headimgurl'];
						$remark   = $userInfo['remark'];
						$city     = $userInfo['province'].$userInfo['city'];
						$domain = wx_Url($evenkey);
						if(!empty($domain)){
							$websiteModel         = M('common_user_website');
							$Datafour['initial']  = 1;
							$websiteModel->update($Datafour,"wxid=".$evenkey);
							$this->cache->PutHCache('website',$evenkey);//写入缓存
							$wxinfo      = $this->cache->GetHCache('website',$evenkey);//读出缓存
							$Dotask  = new \Core\Dotask();
                            $Dotask->checkTask($evenkey,2);
							//$contentStr  = "Hi~".$nickname.",欢迎来到科汛V名师！\r\n您的网校\"".$wxinfo['sitename']."\"已成功绑定公众号!\r\n微门户：".shortchain('https://'.$domain['domain'].'/h5market/Miindex/2.0');
							$url1           = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".KS_C('WeChat_AppId')."&secret=".KS_C('WeChat_AppSecret');
							$data1          = curlGet($url1);
							$access_token   = json_decode($data1,true)['access_token'];
							$url2           = "https://api.weixin.qq.com/cgi-bin/media/upload?access_token=".$access_token."&type=image";
							$cfile          = array();

							$image    = new \Core\Image(\Core\Image::IMAGE_IMAGICK);
							$img      = ROOT.'Images/QRcode/'.createQRcode(ROOT.'Images/QRcode/',$domain.'/?f=m','Q',5,'weimenhu');
							$location = array(172,941);//坐标位置

							$startimg = ROOT.'Images/images/201812/start.jpg';
							$endimg   = ROOT.'Images/images/201812/111111.jpg';
                            $image->open($startimg)->water($img,$location)->save($endimg);

                            $textttf  = ROOT.'KS_cls/Kesion/Core/Verify/zhttfs/1.ttf';
                            $image = new \Core\Image();
                            $location = array(267,730);//坐标位置
                            $image->open($endimg)->text($nickname,$textttf,35,'#000000',$location)->save($endimg);

                            $location = array(378,788);//坐标位置
                            $image->open($endimg)->text($wxinfo['sitename'],$textttf,20,'#666666',$location)->save($endimg);

							$cfile      = curl_file_create(ROOT.'Images/images/201812/111111.jpg');
							$result     = $this->https_request($url2,$cfile);
							$media_id   = json_decode($result,true)['media_id'];
		                    $resultStr  = sprintf($tmp_arr['image'], $fromUsername,$toUsername,$time,$media_id);
							$ermsg      = '';
							$errCode    = $pcs->encryptMsg($resultStr,$timeStamp,$nonce,$ermsg);
							echo isset($ermsg) ? $ermsg:null;
							//$resultStr   = sprintf($tmp_arr['text'], $fromUsername, $toUsername, $time, $contentStr);
							//$ermsg       ='';$errCode = $pcs->encryptMsg($resultStr,$timeStamp,$nonce,$ermsg);
							//echo isset($ermsg) ? $ermsg:null;
						}
                    }
					break;
				case 'text':   //公众号留言

                    $resultStr=$this->wechatReply(3,$keyword);   //关键字回复
                    if ($resultStr){   //有找到
                        $msg='';
                        $errCode = $pcs->encryptMsg($resultStr,$timeStamp,$nonce,$msg);
                        if (isset($msg)){
                           echo($msg);
                        }
                        return;

                    }
					else{

                        //留言回复
                        $resultStr=$this->wechatReply(2);   //关注回复
                        if ($resultStr){   //有找到
                            $msg='';
                            $errCode = $pcs->encryptMsg($resultStr,$timeStamp,$nonce,$msg);
                            if (isset($msg)){
                                echo($msg);
                            }
                        }



                        //保存留言消息
						$Data['wxid']         = $this->wxid;
						$Data['fromusername'] = $fromUsername;
						$Data['tousername']   = $toUsername;
						$Data['createtime']   = $time;
						$Data['content']      = $keyword;
						$Data['replystatus']  = 0;
						$Data['isread']       = 0;
						$Data['iscollect']    = 0;
						$messages_manage      = M('app_wechat_news');
						$access_token = getAccessToken($this->wxid);
						$url= "https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$access_token."&openid=".$Data['fromusername']."&lang=zh_CN";
                        $data = curlGet($url);
                        $userInfo = json_decode($data,true);

						$Data['nickname'] = $userInfo['nickname'];
						$Data['headimgurl'] = $userInfo['headimgurl'];
						$Data['remark'] = $userInfo['remark'];
						$Data['city'] = $userInfo['province'].$userInfo['city'];
	                    $messages_manage->doadd($Data,'id');
	                    /*$contentStr = "谢谢关注我们的微信号,稍后有人为你回复或官网https://store.kesion.com";
						$resultStr  = sprintf($tmp_arr['text'], $fromUsername,$toUsername,$time,$contentStr);
						$ermsg      = '';
						$errCode    = $pcs->encryptMsg($resultStr,$timeStamp,$nonce,$ermsg);
						echo isset($ermsg) ? $ermsg:null;*/
	                    //$contentStr = "谢谢关注我们的微信号,稍后有人为你回复或官网https://store.kesion.com";
				    }
				    break;
			}
		}else {
			$ermsg='';
			$errCode = $pcs->encryptMsg('',$timeStamp,$nonce,$ermsg);
			echo $ermsg;exit;
		}
	}


    /**
     * 微信回复
     * @param mixed $type        1关注回复 2留言回复 3关键字回复
     * @param mixed $keyword    type=3时，对应原关键字
     * @return array|null
     */
    public function wechatReply($type=3,$keyword=''){
        $wxid=$this->wxid;
        $contentsArr=array();
        if ($type==3){      //关键字回复
            $keyArr     = $this->cache->GetHCache('appwechatreply'.$type,$wxid);//读出缓存
            $keyword=strtolower($keyword);           //用户输入的关键字
            if ($keyArr){
                foreach($keyArr as $k=>$v){
                    $replyway    = $v['replyway'];                //0全部回复1随机回复一条
                    $keywordObj  = json_decode(DecodeSQL($v['keywords']));   //关键字json转对象
                    $contentsArr = json_decode(EncodeHtml(DecodeSQL($v['contents'])),true);   //对json转成数组,加true表示数组

                    $hasfindkey=false;

                    foreach($keywordObj as $ck=>$cv){
                        $ruletype = $cv->ruletype;                //0全匹配 1半匹配
                        $key      = strtolower($cv->keyword);
                        if (!empty($key)){
                            if (($ruletype==0 && $key==$keyword) || ($ruletype==1 && (strstr($keyword,$key) || strstr($key,$keyword)))){
                                $hasfindkey=true;
                                break;
                            }
                        }
                    }
                    if ($hasfindkey){                  //找到关键字,多个规则有多个相同的情况，不做考虑，只取最新一条匹配到的数据
                        if ($replyway==1){             //随机回复一条
                            shuffle($contentsArr);     //随机打乱数组
                            for($i=1;$i<=count($contentsArr);$i++){
                                unset($contentsArr[$i]);                 //只留第一行
                            }
                        }
                        break;
                    }else{
                        $contentsArr=null;   //没有找到
                    }

                }
            }
        }else if ($type==1 || $type==2){   //关注回复 及 留言回复
            $contents=$this->cache->GetH('appwechatreply'.$type,'type',$type,'contents',$wxid);
            if ($contents){
                $contentsArr=json_decode(EncodeHtml(DecodeSQL($contents)),true);
            }
        }


        $result=array();
        if ($contentsArr){
            $Wechat = new \Core\Wechat();
            $result=$Wechat->getWechatSucai($this->Object,$wxid,$contentsArr);  //调用素材的构造并输出
        }

        return $result;

  }















	//服务器请求
    public function https_request($url, $cfile = null) {
        $curl = curl_init ();
        if (stripos ( $url, "https://" ) !== FALSE) {
            curl_setopt ( $curl, CURLOPT_SSL_VERIFYPEER, FALSE );
            curl_setopt ( $curl, CURLOPT_SSL_VERIFYHOST, FALSE );
        }
        curl_setopt ( $curl, CURLOPT_URL, $url );
		$data = array('madia' => $cfile);
		curl_setopt ( $curl, CURLOPT_POST, 1 );

        curl_setopt ( $curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, 1 );
        $output = curl_exec ( $curl );
        curl_close ( $curl );
        return $output;
    }

	//获取微信昵称，头像
    public function GetWxinfoAction($fromUsername){
		$url1     = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".KS_C('WeChat_AppId').'&secret='.KS_C('WeChat_AppSecret');
		$data1    = curlGet($url1);
		$access_token  = json_decode($data1,true)['access_token'];
		$url      = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$access_token."&openid=".$fromUsername."&lang=zh_CN";
        $data     = curlGet($url);
        $userInfo = json_decode($data,true);
        return $userInfo;
    }
}