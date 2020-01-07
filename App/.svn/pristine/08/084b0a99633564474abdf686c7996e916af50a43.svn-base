<?php


use Kesion\Controller;
class WxreplyController extends Controller
{
    //获取微信操作对象
    public function indexAction(){
		$webchatObj            = new Wechat();
		$weixin_config         = M('app_weixin_config');
        $webchatObj->token     = $weixin_config->getOne('token','where wxid='.$GLOBALS['_DoM']['wxid']);
	    $webchatObj->valid();
		//if(!isset($_GET['echostr']))
		//{
			/*$weixin_config         = M('app_weixin_config');
            $weixin_info           = $weixin_config->getRow('where wxid='.$GLOBALS['_DoM']['wxid']);
			$webchatObj->token     = $weixin_info['token'];//填写你设定的key
			$webchatObj->appid     = $weixin_info['appid'];//填写高级调用功能的app id
			$webchatObj->appsecret = $weixin_info['appsecret'];//填写高级调用功能的密钥
			$webchatObj->responseMsg();*/
		/*}else{
			
		}*/
    }
    public function inddddddexAction()
    {
//       KSLog('tong-echostrwexin123');
//		echo $_GET['echostr'];exit;
        $weObj = $this->getWeObjAction();
        $weObj->valid();//填写url的时候解开注释
        $type = $weObj->getRev()->getRevType();
//        KSLog('tong-type::' . $type);
        switch ($type) {
            case qywechat::MSGTYPE_TEXT:
//                $weObj->text(C('auto_reply'))->reply();
                self::answerkey($weObj,$weObj->getRev()->getRevContent());
                break;
            case qywechat::MSGTYPE_EVENT:
                $event = $weObj->getRev()->getRevEvent();
//                KSLog('tong-event::' . $event['event']);
//                KSLog('tong-event-content::' . json_encode($event));

                switch ($event['event']) {
                    case qywechat::EVENT_SUBSCRIBE://关注事件
//                        $weObj->text(C('auto_reply'))->reply();

                        //获取扫描二维码
                        $sceneId = $weObj->getRev()->getRevSceneId();
//                        KSLog('scanId-zhu:' . json_encode($sceneId));
//                        KSLog('zhu-scene-id:'.$sceneId);;
                        $info = $weObj->getRev()->getRevData();
//                        KSLog('tong-sub:' . json_encode($info));
                        $user_mod = M('wechat_user');
                        $openid = $info['FromUserName'];
                        $data = $weObj->getUserInfo($openid);
                        $data['from_qrcode'] = $sceneId;

                        if($sceneId!=null) {
                            $info['user'] = M('user')->where(array('uid' => $sceneId))->find();
                            $info['att'] = M('attorney')->where(array('uid' => $sceneId))->find();
                            $msg = array(
                                'Title' => $info['user']['nickname'],
                                'Description' => $info['att']['description'],
                                'PicUrl' => $info['user']['image'],
                                'Url' => C('BASE_URL') . '/' . U('Index/attorneyDetail', array('id' => $sceneId))
                            );
                            $msgs = array();
                            $msgs[0] = $msg;
//                            KSLog('msg-zhu:' . json_encode($msg));
                            $rs = $weObj->news($msgs)->reply();
//                            KSLog('rs-zhu:' . json_encode($rs));
                        }else{
                            self::answerkey($weObj, qywechat::EVENT_SUBSCRIBE);
                        }

                        $is_exists = $user_mod->where(array('openid' => $openid))->find();
//                        KSLog('tong-exit:' . json_encode($is_exists));
                        if ($is_exists) {
                            $user_mod->where(array('openid' => $data['openid']))->save($data);
                        } else {
                            $user_mod->where(array('openid' => $data['openid']))->add($data);

                            M('wechat_qrcode')->where(array('id' => $sceneId))->setInc('num');
                        }

                        break;
                    case qywechat::EVENT_SCAN://扫描带参数二维码事件
                        $sceneId = $weObj->getRev()->getRevSceneId();
                        $info['user']=M('user')->where(array('uid'=>$sceneId))->find();
                        $info['att']=M('attorney')->where(array('uid'=>$sceneId))->find();
						$image = new \Think\Image(); 
						if(strpos($info['user']['image'],'http://') !== false){
							$info['user']['image'] = substr($info['user']['image'], 21);
						}
						$image->open('.'.$info['user']['image']);
						$image->thumb(540, 300,\Think\Image::IMAGE_THUMB_SCALE_FILLED)->save('./Public/thumb/'.$sceneId.'_thumbs.jpg');
						$info['user']['image'] = 'http://m.12348.com.cn/Public/thumb/'.$sceneId.'_thumbs.jpg';
                        $msg = array(
                            'Title'=>$info['user']['nickname'],
                            'Description'=>$info['att']['description'],
                            'PicUrl'=>$info['user']['image'],
                            'Url'=>C('BASE_URL').'/'.U('Index/attorneyDetail',array('id'=>$sceneId))
                        );
                        $msgs = array();
                        $msgs[0] = $msg;
                        $weObj->news($msgs)->reply();
                        break;
                    case qywechat::EVENT_UNSUBSCRIBE://关注事件
                        self::answerkey($weObj,qywechat::EVENT_UNSUBSCRIBE);
                        break;
                }
                break;
            default:
//                $weObj->text(C('auto_reply'))->reply();
        }
        
    }
    //根据关键字回复
    private function answerkey($weObj,$key){
//        KSLog("search-key:".$key);
        $auto_mod = M('wechat_auto');

        $is_auto_reply = $auto_mod->where(array('auto_reply'=>1))->find();

        if(!empty($is_auto_reply)){
            $auto = $is_auto_reply;
        }else{
            //关键字模式
            $auto = $auto_mod->where(array('keyword'=>$key))->find();
        }
        if($key == '律师推荐'){
            $list = M('attorney')->order('integral DESC')->limit(5)->field('uid,description')->select();
            if($list){
                foreach($list as $v){
                    $info = M('user')->where(array('uid'=>$v['uid']))->find();
                    if(strpos($info['image'],'http://') === false){
                        $info['image'] = 'http://m.12348.com.cn'.$info['image'];
                    }
                    $msg = array(
                        'Title'=>$info['nickname'],
                        'Description'=>$v['description'],
                        'PicUrl'=>$info['image'],
                        'Url'=>C('BASE_URL').'/'.U('Index/attorneyDetail',array('id'=>$v['uid']))
                    );
                    $msgs[] = $msg;
                }
                if(count($msgs) > 0){
                    $weObj->news($msgs)->reply();
                    exit;
                }
            }
        }
        if(!empty($auto)){
            $reply = M('wechat_reply')->find($auto['reply_id']);
//            KSLog("search-content:".json_encode($reply));
            if(!empty($reply)){
                $reply['content'] = htmlspecialchars_decode($reply['content']);
                //普通文本回复
                if($reply['type'] == '1'){
                    $weObj->text($reply['content'])->reply();
                }else{
                    $msg = array(
                        'Title'=>$reply['title'],
                        'Description'=>$reply['description'],
                        'PicUrl'=>$reply['pic_url'],
                        'Url'=>$reply['url']
                    );
                    $msgs = array();
                    $msgs[0] = $msg;
                    $weObj->news($msgs)->reply();
                }
            }
        }else{
//            $weObj->text('欢迎使用本公众平台')->reply();
        }
    }
}