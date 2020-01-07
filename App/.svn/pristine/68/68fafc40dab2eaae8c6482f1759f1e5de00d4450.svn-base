<?php
// +----------------------------------------------------------------------
// | KesionPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2015-2019 https://www.kesion.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 厦门科汛软件有限公司　 版权所有 © 2006-2017
// +----------------------------------------------------------------------
// | Advice: 好的编程习惯是成功的一半，对齐，注释  你可以的！
// +----------------------------------------------------------------------



use Kesion\Controller;
class IndexController extends Controller
{
	public  function _initialize(){

        $this->wehchatinfo = getsession('wxuser'.getStorePayAppId());          //获取微信授权信息，如果有授权过，就从session获取，以免再次请求授权
        $this->userinfo = User_GetUserInfo();  //获取登录信息


        /**********************************自动登录  begin *************************************************/
        $ACTIONary = array('spreadinfo','videolive','spread','audiolive','audioin');    //设置必须登录的控制器方法
        if(in_array(ACTION,$ACTIONary)){
            if ($this->userinfo==null || IS_PLATFORM_DOMAIN){   //没有登录，或是主站来的情况，进入授以自动登录，切记：|| IS_PLATFORM_DOMAIN 不能少，否则无法进入授权
                if (is_weixin()){
                    if (getsession('turnurl')==null){
                        $myurl=wx_Url($this->wxid).$_SERVER["REQUEST_URI"];
                        putsession('turnurl',$myurl);
                    }
                    $wechat = new \Core\Wechat();
					if (ACTION=='videolive'){    //


						if (getsession('live_userid')==null){
							putsession('live_userid',ChkClng(KS_S('live_userid')));
							putsession('live_userip',ChkSQL(KS_S('live_userip')));
							putsession('live_courseid',ChkClng(KS_S('live_courseid')));
							putsession('live_courseid_zjid',ChkClng(KS_S('live_courseid_zjid')));
						}

						$wechatinfo=$wechat->authAction(false,$this->wxid);  //指定要自动创建账号，这里的wxid一定要传，以便将店铺的wxid，授权成功后返回
						$this->wxid    = ChkClng(KS_S('wxid'));                       //通过微信授权后，这里一定要重新从URL获取wxid
						include CURR_VIEW_PATH.'live_bm.php';
						exit;
					}else{
						$wechatinfo=$wechat->authAction(true,$this->wxid);  //指定要自动创建账号，这里的wxid一定要传，以便将店铺的wxid，授权成功后返回
					}

                      $this->wxid    = ChkClng(KS_S('wxid'));                       //通过微信授权后，这里一定要重新从URL获取wxid

                     if ($wechatinfo){   //授权成功返回
                            $param='';
                            $UserMode      = M('common_user');
                            if ($wechatinfo->unionid){
                                $param="unionid='".$wechatinfo->unionid."'";
                            }else{
                                $param="openid='".$wechatinfo->openid."'";
                            }
                            if (KS_S('get.go')=='store'){   //管理员角色
                                $param.=' and usertype>0';
                            }else{                          //学生角色
                                $param.=' and usertype=0';
                            }
                            $info        = $UserMode->getRow('where '.$param.' and wxid='.$this->wxid.' and wechatbing=1 order by lastlogintime desc limit 1');
                            if(!empty($info)){       //有登录绑定过了
                                $usertoken['h5token']    = KS_MD5(time().$wechatinfo->openid);
                                $usertoken['tokentime']  = (time() +7200);
                                $UserMode->update($usertoken,$param.' and wechatbing=1 and userid='.$info['userid']);
                                $newurl  = wx_Url($this->wxid).'/h5market/wechatlogin?go='.KS_S('get.go').'&token='.$usertoken['h5token'];   //跳到店铺进行鉴权登录
                                ks_header($newurl);
                            }
                        }


                }else{
                   ks_header(wx_Url($this->wxid).'/#/user/login');
                }
            }
        }

        /**********************************自动登录  end *************************************************/


    }


    /*****************************************************************官网公众号 学生中心 begin ********************************************/
    /**
     * 我访问过的店铺（从官网公众号菜单进入）
     */
	public function viewstoreAction(){
        if (!$this->wehchatinfo){     //未授权过，重新授权，否则从SESSION里获取
            $wechat = new \Core\Wechat();
            $this->wehchatinfo=$wechat->authAction(false);      //微信授权获取unioinId,因为是官网公众号进来的，所以不自动创建账号
        }
        if ($this->wehchatinfo){
            $UserMode      = M('common_user');
            $param = '';
            if ($this->wehchatinfo->unionid!=null || $this->wehchatinfo->openid!=null){
                if (!empty($this->wehchatinfo->unionid)){
                    $param="unionid='".$this->wehchatinfo->unionid."'";
                }else{
                    $param="openid='".$this->wehchatinfo->openid."'";
                }
            }else{
                $param=' 1=0 ';
            }
            $memberinfo = $UserMode->getAll('where '.$param.' and usertype=0 and wechatbing=1 order by lastlogintime desc');
        }else{
            $memberinfo = array();
        }

		include CURR_VIEW_PATH .'viewstore.php';
	}
    /**
     * 我购买过的课程（从官网公众号菜单进入）
     */
    public function viewbuycourseAction(){
        if (!$this->wehchatinfo){     //未授权过，重新授权，否则从SESSION里获取
            $wechat = new \Core\Wechat();
            $this->wehchatinfo=$wechat->authAction(false);      //微信授权获取unioinId,因为是官网公众号进来的，所以不自动创建账号
        }
        if ($this->wehchatinfo){
            if ($this->wehchatinfo->unionid!=null || $this->wehchatinfo->openid!=null){
                $unionid   = $this->wehchatinfo->unionid;
                $UserMode  = M('common_user');
                $usertoken['h5token']    = KS_MD5(time().$unionid);
                $usertoken['tokentime']  = (time() +7200);
                //$usertoken['h5token']='123456';   //测试用
                $UserMode->update($usertoken,"unionid='".$unionid."'");
                ks_header(wx_Url(2).'/?h5token='.$usertoken['h5token'].'#/user/course');  //官网公众号菜单进来，走ks.kesion.com
            }
        }else{
            KS_Alert('微信授权登录失败！','error','/');
        }


    }
    /**
     * 我的下过的订单（从官网公众号菜单进入）
     */
    public function viewmyorderAction(){

       if (!$this->wehchatinfo){     //未授权过，重新授权，否则从SESSION里获取
            $wechat = new \Core\Wechat();
            $this->wehchatinfo=$wechat->authAction(false);      //微信授权获取unioinId,因为是官网公众号进来的，所以不自动创建账号
        }
        if ($this->wehchatinfo){
            if ($this->wehchatinfo->unionid!=null || $this->wehchatinfo->openid!=null){
                 $unionid   = $this->wehchatinfo->unionid;
                 $UserMode  = M('common_user');
                 $usertoken['h5token']    = KS_MD5(time().$unionid);
                 $usertoken['tokentime']  = (time() +7200);
                 //$usertoken['h5token']='123456';   //测试用
                 $UserMode->update($usertoken,"unionid='".$unionid."'");
                 ks_header(wx_Url(2).'/?h5token='.$usertoken['h5token'].'#/user/order');  //官网公众号菜单进来，走ks.kesion.com
             }
         }else{
             KS_Alert('微信授权登录失败！','error','/');
         }

    }
    /*****************************************************************官网公众号 学生中心 end ********************************************/




    /**
     * 微信学员登录
     */
    public function wechatloginAction(){
        $h5token  = trim(ChkSQL(KS_G('get.token')));
        $go = ChkSQL(KS_G('get.go'));
        $url = wx_Url($this->wxid);
        if(!empty($h5token)){
            $UserMode = M('common_user');
            $info     = $UserMode->getRow('where h5token="'.$h5token.'" and tokentime>'.time());
            if(!empty($info)){
				if ($info['is_period']==1&&time()>$info['indate']) {echo '帐号已过有效期~请联系管理员';die;}
				$userinfo['userid']   = $info['userid'];
                $userinfo['username'] = $info['username'];
                $userinfo['usertype'] = $info['usertype'];
                $userinfo['wxid']     = $info['wxid'];           //网校id
                $userinfo['openid']   = $info['openid'];         //网校id

                //登录成功后，token重置掉，让其失效
                $usertoken['h5token']    = '';
                $usertoken['tokentime']  = time();
                $UserMode->update($usertoken,"userid='".$info['userid']."'");

                putsession('user',$userinfo);
                if (getsession('turnurl')!=null){                //有指定跳转地址
                    $url = getsession('turnurl');
                    putsession('turnurl',null);    //用完清空
                }else if ($userinfo['usertype']=='0'){
                    $url = wx_Url($info['wxid']).'?go=student';   //学生
                }else{
                    $url = wx_Url($info['wxid']).'/?go=store#user';        //登录店铺
                }
            }

        }
       // die("url=".$url);
        ks_header($url);
    }


    /******************************微门户相关 兼容旧的链接 ，先不删除 begin *******************************************/

	/**
     * 微门户首页（旧的） 过度期先不删除，跳到新主页下;
     */
	public function MiindexAction(){
        ks_header(wx_Url($this->wxid));
        exit();

	}
    public function MicoursedetailAction(){
		$id = Chkclng(KS_G('get.id'));
        ks_header(wx_Url($this->wxid).'/#/course/'.$id);
        exit();
    }
    public function imgInfoAction(){
        $id = Chkclng(KS_G('get.id'));
        ks_header(wx_Url($this->wxid).'/#/course/'.$id);
        exit();
    }

    /******************************微门户相关 兼容旧的链接 ，先不删除 end*******************************************/























    /******微信学生端相关****/
	//学生端首页
	public function indexAction(){
		if(getsession('member')){
			$noticeModel           = M('app_information');
		    $where                 = 'where wxid='.$this->wxid.' and status!=-1 and (isread  not like "%a'.$this->memberid.'%" or isread=null  or isread is NULL) and student like "%a'.$this->memberid.'%"';
		    $count1                = $noticeModel->getOne('count(id)',$where);
		    $noticeModel = M('app_class_notice');
		    $where2       = 'where wxid='.$this->wxid.' and type =1 and (isread  not like "%a'.$this->memberid.'%" or isread=null or isread is NULL) and status!=-1';
		    $count2 = $noticeModel->getOne('count(id)',$where2);
		    $countAll = $count1+$count2;
			include CURR_VIEW_PATH .'pupilindex.php';
    	}else{
    		//KS_INFOM('请先登录',M_URL('h5market','wechatlogin')."?actindex=".ACTION);
    		KS_INFOM('请先登录',wx_Url($this->wxid).'/#/user/login');

    	}
	}
	//微门户学生端会员页面
	public function myCardAction(){
		if(getsession('member')){
			include CURR_VIEW_PATH.'stuclass/myCard.php';
    	}else{
    		KS_INFOM('请先登录',M_URL('h5market','wechatlogin')."?actindex=".ACTION);
    	}
	}
	//微门户学生端会员页面
	public function carddetailAction(){
		if(getsession('member')){
			include CURR_VIEW_PATH.'stuclass/carddetail.php';
    	}else{
    		KS_INFOM('请先登录',M_URL('h5market','wechatlogin')."?actindex=".ACTION);
    	}
	}
	//学生端首页
	public function userindexAction(){
		if(getsession('member')){
			include CURR_VIEW_PATH.'stuclass/userindex.php';
    	}else{
    		KS_INFOM('请先登录',M_URL('h5market','wechatlogin')."?actindex=".ACTION);
    	}
	}
	//学生端课程
	public function wechatpayAction(){
		if($this->userinfo){
			include CURR_VIEW_PATH.'stuclass/wechatpay.php';
    	}else{
    		KS_INFOM('请先登录',M_URL('h5market','wechatlogin')."?actindex=".ACTION);
    	}
	}
	//学生端充值
	public function myCouseAction(){
		if($this->userinfo){
			include CURR_VIEW_PATH.'stuclass/myCouse.php';
    	}else{
    		KS_INFOM('请先登录',M_URL('h5market','wechatlogin')."?actindex=".ACTION);
    	}
	}
	//学生端签掉记录
	public function mySignAction(){
		if($this->userinfo){
			$classid =ChkClng(KS_G('request.classid'));
			ks_include($this->dir.'mySign.php');
			include $this->dir.'mySign.php';
    	}else{
    		KS_INFOM('请先登录',M_URL('h5market','wechatlogin')."?actindex=".ACTION);
    	}
	}
	//学生端作业页面
	public function myTaskAction(){
		if($this->userinfo){
			$id =ChkClng(KS_G('request.id'));
			$modeltype = null!=KS_G('request.modeltype')?ChkClng(KS_G('request.modeltype')):1;
			if($modeltype==2){
				$Model = M('app_paper');
				$info = $Model->getRow('where paperid='.$id.' and Status!=-1');
				if($info){
                    if($info['ExamTimeLimit']!=0){
                         if($info['ExamBeginTime']>time()){
                             echo "<script>alert('考试于".date('Y-m-d H:i:s',$info['ExamBeginTime'])."开始，请等待');location.href='".M_URL('h5market','myPaper')."'</script>";
                             exit();
                         }
                         if($info['ExamEndTime']<time()){
                             echo "<script>alert('考试于".date('Y-m-d H:i:s',$info['ExamEndTime'])."已结束，现在不能考试');location.href='".M_URL('h5market','myPaper')."'</script>";
                             exit();
                         }
                    }
				}else{
					echo "<script>alert('试卷出错');location.href='".M_URL('h5market','myPaper')."'</script>";
				}

			}
			include CURR_VIEW_PATH.'stuclass/myTask.php';
    	}else{
    		KS_INFOM('请先登录',M_URL('h5market','wechatlogin')."?actindex=".ACTION);
    	}
	}
	//学生端作业记录
	public function myWorkAction(){
		if($this->userinfo){
			$memberid = $this->memberid;
			include CURR_VIEW_PATH.'stuclass/myWork.php';
    	}else{
    		KS_INFOM('请先登录',M_URL('h5market','wechatlogin')."?actindex=".ACTION);
    	}
	}
	//学生端收藏的题集
	public function myCollectAction(){
		if($this->userinfo){
			$memberid = $this->memberid;
			include CURR_VIEW_PATH.'stuclass/myCollect.php';
    	}else{
    		KS_INFOM('请先登录',M_URL('h5market','wechatlogin')."?actindex=".ACTION);
    	}
	}
	//学生端订单页面
	public function myOrderAction(){
		if($this->userinfo){
			$userinfo = $this->userinfo;
			$ordersn = KS_G('request.ordersn');
			$Mode    = M('app_order_info');
			$orderinfo = $Mode->getAll('where ordersn='.$ordersn);
			$order     = M('app_order')->getRow('where ordersn='.$ordersn);

			include CURR_VIEW_PATH.'stuclass/myOrder.php';
    	}else{
    		KS_INFOM('请先登录',M_URL('h5market','wechatlogin')."?actindex=".ACTION);
    	}
	}
	//学生端查看作业
	public function myTaskreadAction(){
		if($this->userinfo){
			$id =ChkClng(KS_G('request.id'));
			$modeltype = null!=KS_G('request.modeltype')?ChkClng(KS_G('request.modeltype')):1;
			$paperModel  =  M('app_paper');
    		$paperinfo = $paperModel->getRow('where paperid='.$id.' and Status=2');//试卷信息
    		if(!$paperinfo){echo '<script>alert("无效试卷，请联系管理员");history.go(-1);</script>';exit;}
			include CURR_VIEW_PATH.'stuclass/myTask.php';
    	}else{
    		KS_INFOM('请先登录',M_URL('h5market','wechatlogin')."?actindex=".ACTION);
    	}
	}
	//学生端消费记录
	public function paylogAction(){
		if($this->userinfo || getsession('user')){
			$userinfo = $this->userinfo;
			include CURR_VIEW_PATH.'stuclass/paylog.php';
    	}else{
    		KS_INFOM('请先登录',M_URL('h5market','wechatlogin')."?actindex=".ACTION);
    	}
	}

		//学生端试卷记录
	public function myPaperAction(){
		if($this->userinfo){
			$memberid = $this->memberid;
			include CURR_VIEW_PATH.'stuclass/myPaper.php';
    	}else{
    		KS_INFOM('请先登录',M_URL('h5market','wechatlogin')."?actindex=".ACTION);
    	}
	}
	/*  试卷详情页*/
	public function examinAction(){
		ks_include($this->dir.'examin.php');
		include $this->dir.'examin.php';
		$id = KS_G('get.id');
		$conf =(object)array();
		$conf->id  =$id;
		$conf->type = 1;
		$conf->shareType = 3;
		share($this->wxid,$conf);
		$gift = KS_G('get.gift');
		if($gift == 2){
			echo "<script>toast2({content:'赠礼成功,前往个人中心查看赠礼信息',duration:2000})</script>";
		}
	}
	//学生端查看作业
	public function myTask_readAction(){
		if($this->userinfo){
			$id =ChkClng(KS_G('request.id'));
			$modeltype = null!=KS_G('request.modeltype')?ChkClng(KS_G('request.modeltype')):1;
			$paperModel  =  M('app_paper');
    		$paperinfo = $paperModel->getRow('where paperid='.$id.' and Status=2');//试卷信息
    		if(!$paperinfo){echo '<script>alert("无效试卷，请联系管理员");history.go(-1);</script>';exit;}
			include CURR_VIEW_PATH.'stuclass/myTask_read.php';
    	}else{
    		KS_INFOM('请先登录',M_URL('h5market','wechatlogin')."?actindex=".ACTION);
    	}
	}

	/*
	查看已批阅试卷
	 */
	public function showPaperreadAction(){
		if($this->userinfo || getsession('user')){
			$userinfo = $this->userinfo;
			$id =ChkClng(KS_G('request.id'));
			$Model  =  M('app_paper_answer');

    		$screModel = M('app_paper_tmtype');
    		$paperModel  =  M('app_paper');
    		$paperinfo = $paperModel->getRow('where paperid='.$id.' and Status=2');//试卷信息
    		if(!$paperinfo){echo '<script>alert("无效试卷，请联系管理员");history.go(-1);</script>';exit;}
    		$info = $Model->getRow('where paperid='.$id.' and memberid='.$this->memberid.' and status!=-1 order by id desc limit 1');//查询出用户的试卷信息

    		// var_dump($info);
    		$score = explode(',', $info['score']);
            array_shift($score);
			$info['score']=array_sum($score);
    		// var_dump($info);
    		$sumtm = 0;

    		$timuinfo = $screModel->getAll('where paperid='.$info['paperid']);//试卷拥有的所有题目
            foreach ($timuinfo as $key => $value) {//计算 试卷的题目
            	$sumtm += $value['number'];
            }
            $Myanswer = explode(',', $info['errortks']);

            // var_dump($ary);
            array_shift($Myanswer);
            // var_dump($Myanswer);
            $dfd = count($Myanswer)/$sumtm;
            $rights =(1-$dfd) *100;//计算正确率
            if ($info['time'] >3600){
		       $hours =intval($info['time']/3600);
		       $minutes = $info['time'] % 3600;
		       $time = $hours.":".gmstrftime('%M:%S',$minutes);
		   }else{
		       $time = gmstrftime('%H:%M:%S',$info['time']);
		   }
			include CURR_VIEW_PATH.'stuclass/myTask_reads1.php';
    	}else{
    		KS_INFOM('请先登录',M_URL('h5market','wechatlogin')."?actindex=".ACTION);
    	}
	}
	public function papershowAction(){
		if($this->userinfo || getsession('user')){
		    $id =ChkClng(KS_G('request.id'));
		    $modeltype = 2;
		    include CURR_VIEW_PATH.'stuclass/papershow.php';
        }else{
    		KS_INFOM('请先登录',M_URL('h5market','wechatlogin')."?actindex=".ACTION);
    	}
	}
	//查看批阅的作业
	public function myTaskreadsAction(){
		if($this->userinfo){
			$userinfo = $this->userinfo;
			$taskanswerModel =M('app_task_answer');
	  	    $taskModel=M('app_task');
	  	    $answerid=ChkClng(KS_G('get.id'));
	  	    $taskanswer =$taskanswerModel->getRow(' where id='.$answerid.' limit 1');
	  	    $task=$taskModel->getRow(' where id ='.$taskanswer['taskid'].' limit 1');
	  	    if($task['taskstyle']==1){
				   $uploadtableid = $this->cache ->GetA('domaininfo','wxid',$this->wxid,'uploadtableid');
				   $tablename      = $this->cache ->GetA('extable','tableid',$uploadtableid,'tablename');//取出关联表
				   $fileModel      = M($tablename);
				   $files=$fileModel->getAll(" where id in ($task[file])");
				 	foreach($files as $k=>$v){
						$fileName = explode('.',$v['filename']);
						$ext = isset($fileName[1]) ? $fileName[1] : '0';
						if($ext == 'txt'){
							$files[$k]['src']='/Public/uploads/common/TXT.png';
						}elseif($ext == 'mp4'){
							$files[$k]['src']='/Public/uploads/common/MOV.png';
						}elseif($ext == 'mp3'){
							$files[$k]['src']='/Public/uploads/common/MP3.png';
						}elseif($ext == 'doc' || $ext == 'docx' ){
							$files[$k]['src']='/Public/uploads/common/DOC.png';
						}elseif( $ext == 'pdf' ){
							$files[$k]['src']='/Public/uploads/common/PDF.png';
						}elseif($ext == 'PPT' || $ext == 'pptx'){
							$files[$k]['src']='/Public/uploads/common/PPT.png';
						}else{
							$files[$k]['src']=$v['filePath'];
						}
					}
					ks_include($this->dir.'myTask_reads1.php');
	  	      	    include $this->dir.'myTask_reads1.php';
	  	    }elseif($task['taskstyle']==2){
	  	      	$paperModel=M('app_paper');
			  	if(empty($task['paperid'])){echo '<script>alert("无效试卷，请联系管理员")</script>';}
			  	$paper = $paperModel->getRow(' where paperid ='.$task['paperid']);
				if(!$paper){echo '<script>alert("无效试卷，请联系管理员");history.go(-1);</script>';exit;}
	            //$papertypeModel = new PaperModel('app_paper_type');
				$tmTypeModel    = M('app_paper_tmtype');
			    $tmtype         = $tmTypeModel->getAll('where paperid = '.$task['paperid'].' order by orderId');
				$tkModel        = M('app_paper_tk');
				$paperAnswer=explode('↓◎↑',$taskanswer['answer']);
				$memberanswer=array();
				foreach($paperAnswer as $k=>$v){
	  	  			$tmty=explode('↓↑',$v);
			  	 	if(!empty($tmty[0])){
				  	 	$tmty1=$tmTypeModel->getRow('where typeId='.$tmty[0].' limit 1');//查找每个大题
				  	  	$n=$k+1;
				  	  	$memberanswer[$k]['tmtytitle']=isset($tmty1['title']) ? $tmty1['title'] : '第'.$n.'题';
				  	  	$memberanswer[$k]['score']=$tmty1['score'];
				  	  	$tks=explode('§№§',$tmty[1]);
				  	  	$answertk=array();
					  	foreach($tks as $kt=>$vt){
					  	  	 $tk=explode('〓',$vt);
					  	  	 $answertk[$kt]['answer']=isset($tk[1]) ? $tk[1] : '';//小题回答答案
					  	  	 if(!empty($tk[0])){
					  	  	 	$tk=$tkModel->getRow('where tkid='.$tk[0].' limit 1');
					  	  		 $answertk[$kt]['tk']=$tk;
					  	  	 	$answertk[$kt]['result']=checkTk($tk,$answertk[$kt]['answer'],$tmty1['score'],$tmty1['typeId']);
					  	  	}
					  	}
				  		$memberanswer[$k]['tks']=$answertk;
			 		}
		    	}
		   	    ks_include($this->dir.'myTask_reads.php');
		        include $this->dir.'myTask_reads.php';
		    }
    	}else{
    		KS_INFOM('请先登录',M_URL('h5market','wechatlogin')."?actindex=".ACTION);
    	}
	}
	//学生端订单页面
	public function myTableAction(){
		if($this->userinfo || getsession('user')){
			$classid =ChkClng(KS_G('request.classid'));
			if(empty($classid)){
				$memberid = $this->memberid;
			}else{
				$memberid = 0;
			}
			include CURR_VIEW_PATH.'stuclass/myTable.php';
    	}else{
    		KS_INFOM('请先登录',M_URL('h5market','wechatlogin')."?actindex=".ACTION);
    	}
	}
	//学生端订单页面
	public function myMsgAction(){
		if($this->userinfo){
			ks_include($this->dir.'myMsg.php');
			include $this->dir.'myMsg.php';
    	}else{
    		KS_INFOM('请先登录',M_URL('h5market','wechatlogin')."?actindex=".ACTION);
    	}
	}
	//学生端订单页面
	public function myListAction(){
		if($this->userinfo){
			include CURR_VIEW_PATH.'stuclass/myList.php';
    	}else{
    		echo "<script>alert('请先登录');location.href='".M_URL('h5market','auth')."?actindex=".ACTION."'</script>";
    	}
	}
	/******微信学生端相关****/
	/******微信家长端相关****/
	//家长端整体和学生没差别，功能一样、复制一下 主要是路口问题
	//学生端首页
	public function pindexAction(){
		if(getsession('parent')){
			ks_include($this->dir.'pindex.php');
			include $this->dir.'pindex.php';
    	}else{
    		echo "<script>alert('请先绑定学生账号');location.href='".M_URL('h5market','wechatlogin')."?actindex=index'</script>";
    	}
	}
	/******微信家长端相关****/





    ///*质询详情*/
    //public function MinewsdetailAction(){
    //    //var_dump($_SESSION);
    //    ks_include($this->dir.'newsdetail.php');
    //    include $this->dir.'newsdetail.php';
    //    $id   =ChkClng(KS_G('get.id'));
    //    $conf =(object)array();
    //    $conf->id  =$id;
    //    $conf->type = 6;
    //    $conf->shareType = 2;
    //    share($this->wxid,$conf);
    //}


	/**
     * 章节详情页
    // */
    //public function directoriesAction(){
    ////	ks_include($this->dir.'directories.php');
    //    include CURR_VIEW_PATH.'directories.php';
    //}


    public function ktjshareAction(){
		if(APP_DOMAIN ==MY_DOMAIN){//当前域名==官网域名，表示分享页跳转
			$wxid     =ChkClng(KS_G('get.wxid'));
			$id       =ChkClng(KS_G('get.id'));
			$distributeid       =ChkClng(KS_G('get.distributeid'));
			$shareact = ChkSQL(KS_G('get.shareact'));

			if($shareact=='audioin'){
				putsession('user',null); //老师账号
				putsession('member',null);//学员账号
				putsession('parent',null);
			}
			$type     = ChkClng(KS_G('get.type'));
			$ordersn  = ChkClng(KS_G('get.ordersn'));
			$domains  = $this->cache->GetA('domaininfo','wxid',$wxid,'domain');//写入缓存
            $domains  = wx_Url($wxid);
			$userid =ChkClng(KS_G('get.userid'));
			if($userid){
				$_SESSION['fxuserid'] = $userid;
			}
			$infoid       =ChkClng(KS_G('get.infoid'));
			$token     = ChkSQL(KS_G('get.token'));
			if(empty($id)&&!empty($infoid)){
			    $cid       =ChkClng(KS_G('get.cid'));
			    $newurl   = $domains.'/h5market/'.$shareact.'?infoid='.$infoid.'&share=2&type='.$type.'&ordersn='.$ordersn.'&cid='.$cid.'&actindex='.$shareact;
			    if($token){
			    	$newurl   = $newurl.'&token='.$token;
			    }
			}else{
			    $newurl   = $domains.'/h5market/'.$shareact.'?id='.$id.'&share=2&type='.$type.'&ordersn='.$ordersn.'&actindex='.$shareact;
			}
			if(!empty($distributeid)){
				$newurl = $newurl.'&distributeid='.$distributeid;
			}
	    	ks_header($newurl);
		}else{
			ks_header('https://store.kesion.com');
		}
	}

	/*timetable课表*/
	public function MitimetableAction(){
		ks_include($this->dir.'timetable.php');
		include $this->dir.'timetable.php';
	}


	/******微门户相关****/


	//进入对应的H5
	public function inh5gameAction(){
	 	$h5id = KS_G('get.h5id');
	 	$wxid = $_GET['wxid'];
	 	$rule = M('app_h5_rule');
	 	if(!empty($h5id)){
	 		$h5info  = $rule->getRow('where id = '.$h5id.' and wxid = '.$wxid);
			$mark = M('app_h5_market');
			$markinfo = $mark->getRow('where id = '.$h5info['h5id']);
			if(empty(KS_G('get.groupid'))){
	 			$url = MY_FULLDOMAIN.'/'.$markinfo['url'].'index.php?h5id='.$h5id.'&wxid='.$wxid;
		 	}else{
		 		$url = MY_FULLDOMAIN.'/'.$markinfo['url'].'index.php?h5id='.$h5id.'&wxid='.$wxid.'&groupid='.KS_G('get.groupid').'&act=game';
		 	}
	 	}
		$act = KS_G('get.act');
		if(!empty($act)){
			$openId=KS_G('get.openid');
			$url = MY_FULLDOMAIN.'/'.$markinfo['url'].'index.php?h5id='.$h5id.'&wxid='.$wxid.'&openid='.$openId.'&act='.$act;
		}
		if(!empty(KS_G('get.ordersn'))){
			$url = MY_FULLDOMAIN.'/Images/H5/index.php?ordersn='.KS_G('get.ordersn');
		}

	 	$this->payauthAction($url,$wxid);
	}

	//进入对应的H5
	public function ylh5gameAction(){
	 	$h5id = $_GET['h5id'];
	 	$wxid = $_GET['wxid'];
	 	$rule = M('app_h5_rule');
		$h5info  = $rule->getRow('where id = '.$h5id.' and wxid = '.$wxid);
		$mark = M('app_h5_market');
		$markinfo = $mark->getRow('where id = '.$h5info['h5id']);
	 	$url = MY_FULLDOMAIN.'/'.$markinfo['url'].'index.php?h5id='.$h5id.'&wxid='.$wxid.'&act=yulangidnex';
	 	$this->payauthAction($url,$wxid);
	}
	//进入学生绑定家长获取家长的openide
	public function bindingAction(){
	 	//$userid = KS_G('get.id');
	 	//$wxid = KS_G('get.wxid');
	 	//var_dump(getsession('wxuser'));
	 	//$url = MY_FULLDOMAIN.'/h5market/bindingParent?userid='.$userid.'&wxid='.$wxid;
	 	//$this->authAction($url,$wxid);
	}
	//进入学生绑定家长的页面
	public function bindingParentAction(){
 		$userid = KS_G('get.userid');
 		$wxid = KS_G('get.wxid');
 		$Mode = M('common_user');
 		$values = $Mode->getRow('as a left join ks_common_user_member as b on a.userid = b.userid where a.userid='.$userid);
 		include CURR_VIEW_PATH .'bindingview.php';
	}
	//绑定的过程
	public function dobingAction(){
	 	$Mode  = M('common_user_member');
	 	$userid = KS_G('get.id');
	 	$wxid = KS_G('get.wxid');
	 	if(!empty($wxid)){
	 		$GLOBALS['_DoM']['wxid'] = $wxid;
	 	}
	 	$Data['emergencyContact'] = KS_G('post.emergencyContact');
	 	$Data['emergencyContactTel'] = KS_G('post.emergencyContactTel');
	 	$Data['emergencyhead'] = KS_G('post.emergencyhead');
	 	$Data['emergencyopenid'] = getsession('wxuser')->openid;
	 	$Data['isreceive'] = KS_G('post.receive');
	 	$mobile = KS_G('post.mobile');
	 	if($mobile == $Data['emergencyContactTel']){KS_INFO("<script>alert('家长手机号不能和学生手机号一致');history.go(-1)</script>",-1);}
	 	$code                    = KS_G('post.code');
	 	$info             = $this->cache->GetHCache('website',$GLOBALS['_DoM']['wxid']);//读出缓存
		//$Data['integral'] = getSetting(15,$info['setting']);
		$smslog  = M('app_sms_log');
		$content = $smslog->getOne('mark',"where mobile='$Data[emergencyContactTel]' and logtype=0 and model='Register' and wxid = ".$GLOBALS['_DoM']['wxid']." and adddate>='".time()."'-10000 order by adddate desc limit 1");
		$content = substr(preg_replace('/\D/s','',$content),-6);
		if($code!=$content||empty($code)){KS_INFO("<script>alert('验证码错误');history.go(-1)</script>",-1);}
	 	if(empty($Data['emergencyContact'])){
	 		KS_INFO("<script>alert('家长姓名不能为空');history.go(-1)</script>",-1);
	 	}
	 	if(empty($Data['emergencyContactTel'])){
	 		KS_INFO("<script>alert('家长手机号不能为空');history.go(-1)</script>",-1);
	 	}
	 	$Mode->update($Data,'userid='.$userid);
	 	KS_INFO("<script>alert('绑定成功');history.go(-1);location.reload()</script>",-1);
	}



	public function getH5gameAction(){
     	echo 1;exit;
    }
    //中奖列表
    public function MywinlistAction(){
    	if(getsession('member')){
    		if(empty(getsession('member')['openid'])){
    			echo "<script>alert('请先绑定微信');location.href='".M_URL('h5market','auth')."?actindex=3'</script>";exit;
    		}
    		putsession('wxuser')->openid = getsession('member')['openid'];
    		$Mode = M('app_h5_rulereward');
    		$options = $Mode->getOptions('100000','where openid ="'.getsession('member')['openid'].'" and wxid='.getsession('member')['wxid']);//分页参数设置
	        $page = Page($options);
			$values = $Mode->getPage($page,'id asc','where openid ="'.getsession('member')['openid'].'" and wxid='.getsession('member')['wxid']);
			foreach($values as $k =>$v){
				$values[$k]['h5name'] = M('app_h5_rule')->getOne('name','where id='.$v['h5id']);
				//if($v['rewardType'] ==1){
					$values[$k]['infoname'] = M('app_course')->getOne('title','where courseid='.$v['infoid']);
				//}
			}
			include CURR_VIEW_PATH .'Mywinlist.php';
    	}else{
    		echo "<script>alert('请先登录');location.href='".M_URL('h5market','wechatlogin')."?actindex=3'</script>";
    	}

    }
    //参与记录
    public function MyPalylogAction(){
    	if(getsession('member')){
    		if(empty(getsession('member')['openid'])){
    			echo "<script>alert('请先绑定微信');location.href='".M_URL('h5market','auth')."?actindex=5'</script>";exit;
    		}
    		$empty_object=(object)null;
    		$empty_object->openid = getsession('member')['openid'];
    		$_SESSION['wxuser'] = $empty_object;
    		$Mode = M('app_h5_user');
    		$options = $Mode->getOptions('100000','where openid ="'.getsession('member')['openid'].'" and wxid='.getsession('member')['wxid']);//分页参数设置
	        $page = Page($options);
			$values = $Mode->getPage($page,'id asc','where openid ="'.getsession('member')['openid'].'" and wxid='.getsession('member')['wxid']);
			foreach($values as $k=>$v){
				$values[$k]['h5name'] = M('app_h5_rule')->getOne('name','where id='.$v['h5id']);
			}
			include CURR_VIEW_PATH .'MyPalylog.php';
    	}else{
    		echo "<script>alert('请先登录');location.href='".M_URL('h5market','wechatlogin')."?actindex=5'</script>";
    	}
    }
    //优惠券列表
    public function MyVoucherlistAction(){
    	if(getsession('member')){
    		include CURR_VIEW_PATH .'stuclass/myvoucher.html';
//  		$empty_object=(object)null;
//  		$empty_object->openid = getsession('member')['openid'];
//  		$_SESSION['wxuser'] = $empty_object;
//  		$Mode = M('app_voucher');
//  		$infos = $Mode->getAll('where memberid="'.getsession('member')['userid'].'" and wxid='.$GLOBALS['_DoM']['wxid'].' and awarddate=1 and isuse = 0 and redemptionendtime<'.time());
//  		if(!empty($infos)){
//  			$Datas['isuse'] = 2;
//  			foreach($infos as $k =>$v){
//  				$Mode->update($Datas,'id='.$v['id']);
//  			}
//  		}
//  		$options = $Mode->getOptions('10000','where memberid ="'.getsession('member')['userid'].'" and wxid='.$GLOBALS['_DoM']['wxid'] .' and isuse=0');//分页参数设置
//	        $page = Page($options);
//			$values = $Mode->getPage($page,'id asc','where memberid ="'.getsession('member')['userid'].'" and wxid='.$GLOBALS['_DoM']['wxid'].' and isuse=0');
//			//先查询没过期的优惠券
//			$options1 = $Mode->getOptions('10000','where memberid ="'.getsession('member')['userid'].'" and wxid='.$GLOBALS['_DoM']['wxid'] .' and (isuse=1 or isuse=2)');//分页参数设置
//	        $page1 = Page($options1);
//			$values1 = $Mode->getPage($page1,'id asc','where memberid ="'.getsession('member')['userid'].'"and wxid='.$GLOBALS['_DoM']['wxid'].' and (isuse=1 or isuse=2)');
//			include CURR_VIEW_PATH .'MyVoucherlist.php';
    	}else{
		    putsession('user',null); exit;//老师账号
			echo "<script>location.reload();</script>";exit;
    		//echo "<script>alert('请先登录');location.href='".M_URL('h5market','wechatlogin')."?actindex=5'</script>";
    	}

    }
    //kec 列表
    public function MystudylistAction(){
    	if(getsession('member')){

			include CURR_VIEW_PATH .'Mystudylist.php';
    	}else{
    		echo "<script>alert('请先登录');location.href='".M_URL('h5market','wechatlogin')."?actindex=4'</script>";
    	}

    }
    //领取对应的奖励
    public function receiveAction(){
    	if(getsession('member')){
    		$id = KS_G('post.key');
    		$Mode = M('app_h5_rulereward');
    		$info = $Mode->getRow('where id='.$id.' and openid="'.getsession('member')['openid'].'" and isuse!=1');
    		$str = '领取成功';
    		$Rdata['isuse'] = 1;
    		if(empty($info)){
    			echo json_encode(array('err'=>'404','msg'=>'领取失败'));
    			exit;
    		}else{

    			$Vmode = M('app_voucher');
    			//兑奖类型为兑换卷的时候或者其他的时候
    			if($info['rewardType'] == 0 ){
    				$Datas['code']= $info['code'];
	    			$Datas['addtime']=time();
					$Datas['memberid'] = getsession('member')['userid'];
					$Datas['wxid'] = $GLOBALS['_DoM']['wxid'];
					$Datas['redemptionmethod'] = $info['redemptionMethod'];
					$Datas['awarddate'] =$info['redemptionMethod'];
					$Datas['redemptionstarttime'] = $info['redemptionStartTime'];
					$Datas['redemptionendtime'] = $info['redemptionEndTime'];
//					$Datas['rewardtype'] = $info['rewardType'];
    				$Datas['money'] = $info['money'];
    				$Vmode->doAdd($Datas,'id');
    			}elseif($info['rewardType'] == 1){
    				if($info['redemptionMethod']==0){
    					$shopid           = $info['infoid'];
					    $money      	  = 0;
					    list($usec, $sec)    = explode(" ", microtime());
						$Datass['ordersn']     = getsession('member')['userid'].((float)$usec + (float)$sec)*10000;
						$shopModel           = M('app_order');
					    $Datass['memberid']      = getsession('member')['userid'];
					    $Datass['wxid']        = $GLOBALS['_DoM']['wxid'];
					    $Datass['memberip']      = $_SERVER['SERVER_ADDR'];
					    $Datass['type']        = 0;
					    $Datass['order_amount']= $money;
					    $Datass['pay_amount']  = $money;
					    $Datass['adddate']     = time();
					    $Datass['paystatus']   = 1;
					    $orderid             = $shopModel->doAdd($Datass,'orderid');
					    //订单详情
					    $order_apps          = M('app_order_info');
					    $Dataso['memberid']      = getsession('member')['userid'];
					    $Dataso['wxid']       = $GLOBALS['_DoM']['wxid'];
					    $Dataso['type']        =ChkClng(KS_G('post.type'));;
					    $Dataso['courseid']   = $shopid;
					    $Dataso['title']      = M('app_course')->getOne('title','where courseid='.$shopid);;
					    $Dataso['price']      = $money;
					    $Dataso['defaultpic'] = M('app_course')->getOne('defaultpic','where courseid='.$shopid);;
					    $Dataso['orderid']    = $orderid;
					    $Dataso['ordersn']    = $Datass['ordersn'];
					    $Dataso['paystatus']  = 1;
					    $Dataso['adddate']    = time();
						$order_apps->doAdd($Dataso,'id');//添加单个app信息
    				}else{
    					$info = getschool($info['h5id']);
    					echo json_encode(array('err'=>'500','msg'=>$info));
    					exit;
    				}
    			}elseif($info['rewardType'] == 3){
    				$info = getschool($info['h5id']);
					echo json_encode(array('err'=>'500','msg'=>$info));
					exit;
    			}elseif($info['rewardType'] == 4){
    				if($info['redemptionMethod']==0){
    					$Mode = M('app_order_info');
    					$shopid           = $info['infoid'];
    					$infos= $Mode->getRow('where wxid='.$GLOBALS['_DoM']['wxid'].' and courseid='.$shopid.' and memberid='.getsession('member')['userid'].' and type= 0 and paytype=1');
						if(empty($infos)){
							$url = 'https://ks.'.PLATDOMAIN.'/Images/H5/index.php?wxid='.$GLOBALS['_DoM']['wxid'].'&h5id='.$info['h5id'].'&courseid='.$shopid;
							echo json_encode(array('err'=>'220','msg'=>$url));
							exit;
						}else{
							$str = '你已经拥有该课程，无法优惠购买';
							$Rdata['isuse'] = 0;
						}
					}else{
    					$info = getschool($info['h5id']);
    					echo json_encode(array('err'=>'500','msg'=>$info));
    					exit;
    				}
    			}elseif($info['rewardType'] == 5){
    				if($info['redemptionMethod']==0){
    					$Mode = M('app_order_info');
    					$shopid           = $info['infoid'];
    					$infos= $Mode->getRow('where wxid='.$GLOBALS['_DoM']['wxid'].' and courseid='.$shopid.' and memberid='.getsession('member')['userid'].' and type= 0 and paytype=1');
						if(empty($infos)){
							$url = 'https://ks.'.PLATDOMAIN.'/Images/H5/index.php?wxid='.$GLOBALS['_DoM']['wxid'].'&h5id='.$info['h5id'].'&classid='.$shopid;
							echo json_encode(array('err'=>'220','msg'=>$url));
							exit;
						}else{
							$str = '你已经拥有该课程，无法优惠购买';
							$Rdata['isuse'] = 0;
						}
					}else{
    					$info = getschool($info['h5id']);
    					echo json_encode(array('err'=>'500','msg'=>$info));
    					exit;
    				}
    			}
    		}
    		$Mode->update($Rdata,'id='.$id);
    		echo json_encode(array('err'=>'200','msg'=>$str));
    	}else{
    		echo json_encode(array('err'=>'404','msg'=>'非法操作'));
    		exit;
    	}
    }

    //注册
    public function regAction(){
    	$openId   = ChkSQL(KS_G('request.openid'));
    	$wxopenId = ChkSQL(KS_G('request.wxopenid'));
    	include  CURR_VIEW_PATH . "newregister.php";
    }
    //找回密码
    public function getPassAction(){
    	$openId   = ChkSQL(KS_G('request.openid'));
    	$actindex = ChkSQL(KS_G('request.actindex'));
    	$wxopenId = ChkSQL(KS_G('request.wxopenid'));
    	include  CURR_VIEW_PATH . "newgetPass.php";
    }
    //进行注册
	public function doregisterAction(){
		$code               = ChkSQL(KS_G('post.code'));
		$Data['username']   = ChkSQL(KS_G('post.username'));
		$Data['mobile']     = ChkSQL(KS_G('post.mobile'));
		$Data['mobilebing'] = 1;
		$Data['usertype']   = 0;
		$Data['password']   = ChkSQL(KS_G('post.password'));
		$Data['rndpasswordc'] = rand(100000,999999);
		$Data['regdate']    =ChkClng(time());
		$Data['wxid']       = $GLOBALS['_DoM']['wxid'];
		$Data['status']     = 1;
		$info               = $this->cache->GetHCache('website',$GLOBALS['_DoM']['wxid']);//读出缓存
		$status             = $this->cache->GetH('smsmodel','modelname','Register','status',$GLOBALS['_DoM']['wxid']);//读出缓存
		$issms              = getSetting(0,17,$GLOBALS['_DoM']['wxid']);
		if($status==1 && $issms == 1){
			$smslog  = M('app_sms_log');
			$content = $smslog->getOne('content',"where mobile='$Data[mobile]' and logtype=0 and model='Register' and wxid = ".$GLOBALS['_DoM']['wxid']." and adddate>='".time()."'-10000 order by adddate desc limit 1");
			$content = substr(preg_replace('/\D/s','',$content),-6);
			if($code!=$content||empty($code)){
				echo 'codeerr';exit;
				KS_INFO("<script>parent.regSuccessBack('验证码错误');</script>",-1);
			}
		}
	    $usersModel       = M('common_user');
		$usernum          = $usersModel->getOne('count(*)','where username = "'.$Data['username'].'" and usertype=0');
		//一个号码只可以注册一次
        if($usernum>0){
        	echo 'exists';exit;
        	KS_INFO("<script>parent.regSuccessBack('学员账号云平台已存在');</script>",-1);
        }
		$Data['parentid'] = $usersModel->getOne('userid','where parentid=0 and wxid = '.$GLOBALS['_DoM']['wxid']);
		$Rule['mobile']   = '手机号|isEmpty,isMobile';
		$Rule['password'] = '密码|isEmpty,isPassword';
		Chkpost($Data,$Rule,$usersModel);
		$Data['password'] = KS_MD5($Data['password'].KS_MD5($Data['rndpasswordc']));
		$result           = $usersModel->doAdd($Data,'userid');
		//插入第二张表
		$Datas['userid']  = $result;
		$Datas['name']    = $Data['username'];
		$user_school      = M('common_user_member');
		$user_school->delete("userid=$Datas[userid]");
		$user_school->doEfAdd($Datas);
		$Dotask  = new \Core\Dotask();
        $Dotask->checkTask($GLOBALS['_DoM']['wxid'],9);//检查是否完成任务
		$this->cache->PutHCache('users',$GLOBALS['_DoM']['wxid']);
		$this->cache->PutHCache('user',$GLOBALS['_DoM']['wxid']);
		//注册后直接登录
		if(1){
			$lastlogintime = time();
			$lastloginip   = $_SERVER['REMOTE_ADDR'];
			$GLOBALS['db']->execSql("UPDATE `$usersModel->table` SET `lastlogintime`='$lastlogintime', `lastloginip`='$lastloginip', `logintimes`=logintimes+1 WHERE userid=$result");
			//把一些基本信息放入session
			$userinfo['userid']   = $result;
			$userinfo['username'] = $Data['username'];
			$userinfo['usertype'] = $Data['usertype'];
			$userinfo['wxid']     = $Data['wxid'];//网校id
			putsession('member',$userinfo);
			echo 'succeed';exit;
			KS_INFO("<script>parent.regSuccessBack('注册成功');</script>",-1);
		}else{
			echo 'succeed';exit;
		    KS_INFO("<script>parent.regSuccessBack('注册成功');</script>",-1);
		}
	}
	//拼团的链接页
	public function collageAction(){
		$h5id = KS_G('get.h5id');
		if(empty($h5id)){
				echo "<script>alert('异常进入，请稍后在试！');history.go(-1)</script>";exit;
			}
		//putsession('user',null); putsession('member',null); putsession('parent',null);
	    //var_dump(getsession('user')); var_dump(getsession('member'));var_dump(getsession('parent'));exit;
	    //putsession('user',null); putsession('member',null); putsession('parent',null);exit;

		if(getsession('member')){
//			$ordersn = KS_G('get.ordersn');
			$h5id = KS_G('get.h5id');
			if(empty($h5id)){
				"<script>alert('异常进入，请稍后在试！');history.go(-1)</script>";
			}
//			var_dump($ordersn);die;
//			$id   = KS_G('get.id');
//			$groupid = KS_G('get.groupid');
			$h5mode     = M('app_h5_rule');
			$h5info = $h5mode->getRow('where wxid='.$this->wxid.' and id='.$h5id);
			$ordermode = M('app_order_info');
            $Wechat = new \Core\Wechat($this->wxid);
			$res = $ordermode->getRow('where paystatus=1 and memberid='.getsession('member')['userid'].' and courseid='.$h5info['infoid'].' and wxid='.$this->wxid);
			if(!empty($res)){
				$groupid = $res['groupid'];
				$ordersn = $res['ordersn'];
                $h5user = M('app_h5_user');
                $app_h5_rulereward = M('app_h5_rulereward');
                $resdb_rulereward = $app_h5_rulereward->getRow('where wxid='.$this->wxid.' and h5id='.$h5id.' and groupid="'.$groupid.'"');

                $h5info['setting'] = unserialize($h5info['setting']);
                if(!empty($resdb_rulereward)){
                    $resdb = $h5user->getRow('where wxid='.$this->wxid.' and h5id='.$h5id.' and groupid="'.$groupid.'" and memberid='.getsession('member')['userid']);
                    if(empty($resdb)){

                        $Data['memberid'] = getsession('member')['userid'];
                        $Data['wxid']    = $this->wxid;
                        $Data['menbername'] = M('common_user')->getOne('username','where userid='.getsession('member')['userid']);
                        $Data['groupid'] = $groupid;
                        if(isset(getsession('member')['openid']) && !empty(getsession('member')['openid'])){
                            $Data['openid'] = getsession('member')['openid'];
                        }
                        $Data['h5id']    = $h5id;
                        $Data['addtime'] = time();
                        $res1 = $h5user->doAdd($Data,'id');
                        $userlist = $h5user->getAll('where wxid='.$this->wxid.' and groupid="'.$groupid.'" and h5id='.$h5id);
                        if(count($userlist) == $h5info['setting']['rewardpeple']){
                            $infoData['successful'] = 1;
                            $app_h5_rulereward->update($infoData,'wxid='.$this->wxid.' and h5id='.$h5id.' and groupid="'.$groupid.'"');

                            //拼团成功发送微信模版消息
                            foreach ($userlist as $k=>$v){
                                $template_id = 'OPENTM416810302';
                                $openid = !empty($v['openid'])?$v['openid']:M('common_user')->getOne('openid',"where userid=".$v['memberid']);
                                $data = [
                                    'first'=>['value'=>'您参加的团购活动已拼团成功','color'=>'#173177'],
                                    'keyword1'=>['value'=>$h5info['name'],'color'=>'#173177'],
                                    'keyword2'=>['value'=>$h5info['setting']['teammoney'],'color'=>'#173177'],
                                    'remark'=>['value'=>'请点此处查看团购详情','color'=>'#173177'],
                                ];
                                $url =  'https://'.wx_Domain_Field($this->wxid,'domain').'/h5market/collage?h5id='.$h5id.'&groupid='.$groupid.'&sharetype=1';
                                $Wechat->sendTemplateMessage($openid,$template_id,$url,$data);
                            }

                            $allmoney = M('app_order')->getOne('sum(a.order_amount)','as a left join '.$ordermode->table.' as b on a.orderid=b.orderid where b.paystatus=1 and  b.courseid='.$h5info['infoid'].' and b.wxid='.$this->wxid.' and b.ordersn='.$ordersn.' and b.groupid = "'.$groupid.'"');
                            $realymoney = M('app_order')->getOne('sum(a.actual_amount)','as a left join '.$ordermode->table.' as b on a.orderid=b.orderid where b.paystatus=1 and  b.courseid='.$h5info['infoid'].' and b.wxid='.$this->wxid.' and b.ordersn='.$ordersn.' and b.groupid = "'.$groupid.'"');
                            //拼团成功后计算该拼团所有的钱
                            $Datawx['withdrawmoney'] = getWxinfo($this->wxid,'withdrawmoney')+$realymoney;//网校可提现金额(扣除提走的佣金)
                            $Datawx['withdrawsum']   = getWxinfo($this->wxid,'withdrawsum')+$realymoney;//网校可提现金额(累计)
                            $Datawx['icomemoney']    = getWxinfo($this->wxid,'icomemoney')+$allmoney;//累计收入（未扣给平台的分佣）
                            $db           = M('common_user_website');
                            $db->update($Datawx,"wxid=".$this->wxid);//更新拼团成功后网校余额
                        }

                    }else{
                        if($resdb_rulereward['successful']==0){//数据库里的数据 拼团没成功
                            $userlist = $h5user->getAll('where wxid='.$this->wxid.' and groupid="'.$groupid.'" and h5id='.$h5id);
                            if(count($userlist) == $h5info['setting']['rewardpeple']){//拼团的人够了
                                $infoData['successful'] = 1;
                                $app_h5_rulereward->update($infoData,'wxid='.$this->wxid.' and h5id='.$h5id.' and groupid="'.$groupid.'"');

                                foreach ($userlist as $k=>$v){
                                    $template_id = 'OPENTM416810302';
                                    $openid = !empty($v['openid'])?$v['openid']:M('common_user')->getOne('openid',"where userid=".$v['memberid']);
                                    $data = [
                                        'first'=>['value'=>'您参加的团购活动已拼团成功','color'=>'#173177'],
                                        'keyword1'=>['value'=>$h5info['name'],'color'=>'#173177'],
                                        'keyword2'=>['value'=>$h5info['setting']['teammoney'],'color'=>'#173177'],
                                        'remark'=>['value'=>'请点此处查看团购详情','color'=>'#173177'],
                                    ];
                                    $url =  'https://'.wx_Domain_Field($this->wxid,'domain').'/h5market/collage?h5id='.$h5id.'&groupid='.$groupid.'&sharetype=1';
                                    $Wechat->sendTemplateMessage($openid,$template_id,$url,$data);
                                }


                                $allmoney = M('app_order')->getOne('sum(a.order_amount)','as a left join '.$ordermode->table.' as b on a.orderid=b.orderid where b.paystatus=1 and  b.courseid='.$h5info['infoid'].' and b.wxid='.$this->wxid.' and b.ordersn='.$ordersn.' and b.groupid = "'.$groupid.'"');
                                $realymoney = M('app_order')->getOne('sum(a.actual_amount)','as a left join '.$ordermode->table.' as b on a.orderid=b.orderid where b.paystatus=1 and  b.courseid='.$h5info['infoid'].' and b.wxid='.$this->wxid.' and b.ordersn='.$ordersn.' and b.groupid = "'.$groupid.'"');
                                //拼团成功后计算该拼团所有的钱
                                $Datawx['withdrawmoney'] = getWxinfo($this->wxid,'withdrawmoney')+$realymoney;//网校可提现金额(扣除提走的佣金)
                                $Datawx['withdrawsum']   = getWxinfo($this->wxid,'withdrawsum')+$realymoney;//网校可提现金额(累计)
                                $Datawx['icomemoney']    = getWxinfo($this->wxid,'icomemoney')+$allmoney;//累计收入（未扣给平台的分佣）
                                $db           = M('common_user_website');
                                $db->update($Datawx,"wxid=".$this->wxid);//更新拼团成功后网校余额
                            }
                        }
                    }
                }else{
                    $Datah5['memberid'] = getsession('member')['userid'];
                    $Datah5['wxid']    = $this->wxid;
                    $Datah5['menbername'] = M('common_user')->getOne('username','where userid='.getsession('member')['userid']);
                    $Datah5['groupid'] = $res['groupid'];
                    $Datah5['h5id']    = $h5id;
                    $Datah5['addtime'] = time();
                    $h5user->doAdd($Datah5,'id');
                    $Datah5['membername'] = $Datah5['menbername'];
                    unset($Datah5['menbername']);
                    $Datah5['name'] ='拼团奖励';
                    $Datah5['infoid'] = $h5info['infoid'];
                    $Datah5['rewardType'] = $h5info['type'];
                    $Datah5['isgroup'] = 1;
                    $Datah5['groupid'] = $res['groupid'];
                    $app_h5_rulereward->doAdd($Datah5,'id');

                    //给开团人发微信模版消息----by--song
                    $openid = M('common_user')->getOne('openid',"where userid=".$res['memberid']);
                    $template_id = 'OPENTM416270863';
                    $data = [
                        'first'=>['value'=>'您已经成功开启团购','color'=>'#173177'],
                        'keyword1'=>['value'=>$h5info['name'],'color'=>'#173177'],
                        'keyword2'=>['value'=>$h5info['setting']['teammoney'],'color'=>'#173177'],
                        'remark'=>['value'=>'请点此处查看团购详情，邀请好友参加拼团','color'=>'#173177'],
                    ];
//                    $url =  'https://'.wx_Domain_Field($this->wxid,'domain').'/h5market/collage?h5id='.$h5id.'&groupid='.$groupid.'&sharetype=1';
                    $url =  'https://'.wx_Domain_Field($this->wxid,'domain').'#/user/course';
                    $Wechat->sendTemplateMessage($openid,$template_id,$url,$data);

                }
            }
			//var_dump(getsession('member'));exit;
			$access_token = getAccessToken($this->wxid);
			if(empty($access_token)){
				$access_token = getAccessToken(2);
				$wxid2 = 2;
			}else{
				$wxid2 = $this->wxid;
			}
			$appid     = $this->cache->GetH('wxconfig','wxid',$wxid2,'appid',$wxid2);
			$appSecret =  '';
			include ROOT."Application/View/home/h5/jssdk.php";
			$jssdk = new JSSDK($appid,$appSecret,$access_token,$wxid2,'');
			$signPackage = $jssdk->GetSignPackage();

			include CURR_VIEW_PATH .'stuclass/collage.html';

    	}else{
    		KS_INFOM('请先登录',M_URL('h5market','wechatlogin')."?actindex=".ACTION);
    	}
	}
    //拼团列表接口
	public function getcollageAction(){
        header("Access-Control-Allow-Origin: *");
		$maxPerPage = null !=ChkClng(GF('maxPerPage')) ?ChkClng(GF('maxPerPage')):'50';
    	$picth  = ChkSQL(GF('pitch'))!='' ? ChkSQL(GF('pitch')):'';
    	$picth = strlen($picth)==1?intval($picth):$picth;
    	$db_Mode = M('app_h5_rule');
		$key=null !== GF('key') ? GF('key') : '' ;
		$wxid=null !== GF('wxid') ? GF('wxid') : '0' ;
		$where = 'where wxid='.$wxid.' and h5id = 19 and ismode=2';
		if($key){
			$where .=" and (name like '%$key%')";
		}        $style          = null !==GF('style') ? GF('style'):1;
		// var_dump($picth);
    	if($picth){
    		$picth = str_replace("@",",",$picth);
    		$where= $where.' and id in('.$picth.')';
    	}elseif($picth===0){
    		$options['totalput'] = 0;
    		$options['maxperpage'] = 50;

    		$page = Page($options);
    		$result['page'] = $page;
    		$result['style'] = $style;
    		$result['dt'] = array();
    		header("Content-type: application/json");
	        echo json_encode($result);exit;
    	}
    	$db_course = M('app_course');
    	$db_paper = M('app_paper');

		$options = $db_Mode->getOptions($maxPerPage,$where);//分页参数设置
		$options['now_page'] = null !==GF('p') ? GF('p'):'1';
		$page = Page($options);
		$dt = $db_Mode->getPage($page,'id',$where);
		foreach($dt as $k =>$v){
			if ($v['type']==6) {
				 $url = M_URL('h5market','examin').'?id='.$v['infoid'];
				$info = $db_paper->getRow('where paperid='.$v['infoid'],'price,defaultpic');
			}else{
                $info = $db_course->getRow('where courseid='.$v['infoid'],'price,defaultpic,courseType');
                if($info['courseType']==3){
                  $url = M_URL('h5market','musicinfo').'?id='.$v['infoid'];
                }elseif($info['courseType']==4){
                  $url = M_URL('h5market','imgInfo').'?id='.$v['infoid'];
                }elseif($info['courseType']==2){
                  $url = M_URL('h5market','audiolive').'?id='.$v['infoid'];
                }else{
                   $url = M_URL('h5market','Micoursedetail').'?id='.$v['infoid'];
                }
			}
			$dt[$k]['price'] =$info['price'];
			$dt[$k]['url'] =$url;
			$dt[$k]['defaultpic'] = null!=$info['defaultpic'] ? $info['defaultpic'] : nopic(12);
			$dt[$k]['nowtime'] = time();
			$dt[$k]['setting']=unserialize($v['setting']);
		}
		$result['page'] = $page;
		$result['style'] = $style;
		$result['dt'] = $dt;

		header("Content-type: application/json");
        echo json_encode($result);exit;
	}
	//视频直播详情页面
	public function videoliveAction(){
	    $infoid     =ChkClng(KS_G('get.infoid'));
		$userid     = 0;
		$username   = '';
		foreach ($_SESSION as $k => $value) {
    		if($k == 'user'){
			    $userinfo  = getsession('user');
				$userid    = $userinfo['userid'];
				$userinfo  = User_GetUserInfo();
				$username  = isset($userinfo['username'])?$userinfo['username']:'';
		//var_dump(getsession('user'));exit;
				$usertype = 1;
    		}elseif($k == 'member'){
			    $userinfo  = getsession('member');
    			$userid    = $userinfo['userid'];
    			$usertype  = 0;
				$userinfo  = User_GetUserInfo();
				$username  = isset($userinfo['name'])?$userinfo['name']:$userinfo['username'];
    		}
    	}
		$nowtime          = time();
		$avatar           = $this->upload->getHead($userid,4,5);
		$app_course       = M('app_course');
	    $value            = $app_course->getRow('where courseid='.$infoid.' limit 1');
		$value['defaultpic'] = Img($value['defaultpic']);
		$chapterModel     = M($value['chaptertable']);
		$chapter          = $chapterModel->getRow('where courseid='.$infoid.' limit 1');
		ks_include($this->dir.'videolive.php');
		include $this->dir.'videolive.php';
		$conf            = (object)array();
		$conf->infoid    = $infoid;
		$conf->cid       =ChkClng(KS_G('get.cid'));
		$conf->type      = 7;
		$conf->shareType = 3;
		share($this->wxid,$conf);
	}
	//语音直播详情页面
	public function audioliveAction(){
		ks_include($this->dir.'audiolive.html');
		include $this->dir.'audiolive.html';
		$id = KS_G('get.id');
		$conf =(object)array();
		$conf->id  =$id;
		$conf->type = 7;
		$conf->shareType = 1;
		share($this->wxid,$conf);
	}
	/**
     * 语音直播直播间页面(手机端）
	 */
	public function audioinAction(){
	    $infoid    = ChkClng(KS_G('get.infoid'));

    	if(KS_G('get.token')){
		    $live_secret   = M('app_live_secret');
		    $tockenval     = $live_secret->getRow('where wxid='.ChkClng(KS_G('get.wxid')));
			if(!empty($tockenval)){
				 if(KS_MD5($tockenval['token'])==KS_G('get.token')){
				    if(time()-$tockenval['endtime']<=7200){
					    $usersModel = M('common_user');
					    $user       = $usersModel->getRow("where wxid=".$tockenval['wxid']." and parentid=0 and powertype!=0 and usertype!=0 limit 1",'usertype,userid,username,wxid,status');
				        if(!empty($user)){
							$userinfo['userid']   = $user['userid'];
							$userinfo['username'] = $user['username'];
							$userinfo['usertype'] = 1;
							$usertype = 1;
							$this->wxid = $user['wxid'];
							$userid    = $userinfo['userid'];
							$userinfo['wxid']     = $user['wxid'];//网校id
							putsession('user',$userinfo);
						}else{
							echo '该用户权限不够';exit;
						}
					}else{
						echo 'tocken时间过期';exit;
					}
				 }else{
				    echo 'tocken错误';exit;
				 }
			}else{
			     echo '该网校没有开通接口功能';exit;
			}
		}else{

            $userinfo=User_GetUserInfo();
            if ($userinfo){
                $usertype=$userinfo['usertype'];
                $userid=$userinfo['userid'];
            }

		}
		$DB3             = M('app_course');
		$courseinfo      = $DB3->getRow('where courseid='.$infoid.' limit 1');
        if (!$courseinfo){
            die('课程不存在');
        }

        $studentcount=$courseinfo['studentcount']; //销量设置(可自由设置，作弊使用)

        /**************************主讲教师信息 begin ***********************/
        $teacher_avatar=$this->upload->getHead($courseinfo['teacherid'],5);
        $teacher_name=User_GetUserName($courseinfo['teacherid']);
        /**************************主讲教师信息 end ***********************/


		$chapterModel     = M($courseinfo['chaptertable']);
		$chapter          = $chapterModel->getRow('where courseid='.$infoid.' limit 1');
		if(empty($courseinfo['livetype'])){
		      if($usertype==1){
				  if(strpos($_SERVER['HTTP_USER_AGENT'], 'iPhone')||strpos($_SERVER['HTTP_USER_AGENT'], 'iPad')){
						ks_header('https://itunes.apple.com/cn/app/%E8%AF%BE%E5%A0%82%E8%A1%97%E6%95%99%E5%B8%88%E7%AB%AF/id1358204606?mt=8');
				  }else if(strpos($_SERVER['HTTP_USER_AGENT'], 'Android')){
							ks_header('https://a.app.qq.com/o/simple.jsp?pkgname=com.kesion.kesionlive');
				  }else{
							ks_header('https://a.app.qq.com/o/simple.jsp?pkgname=com.kesion.kesionlive');
				  }
			  }
		      $url = 'https://'.APP_DOMAIN.'/h5market/videolive?infoid='.$infoid.'&cid='.$chapter['chapterid'];
		      ks_header($url);exit;
		}
	    $title           = $courseinfo['title'];
		if(isset($usertype)&&$usertype==0){
		   //  var_dump($usertype);exit;
			if($userinfo && $userinfo['usertype'] ==0){
				$DB2        = M('app_order_info');

				$chargetype = $DB3->getOne('chargetype','where courseid='.$infoid);
				$price      = $DB3->getOne('price','where courseid='.$infoid);
				$paystatus  = $DB2->getOne('paystatus','where memberid='.$userid.' and courseid='.$infoid.' and wxid='.$this->wxid.' and status !=-1 order by adddate desc limit 1');
				if($chargetype == 1){

					if((float)$price ==0.00){$falgs = 1;
					}else{
						if($paystatus){$falgs = 1;
						}else{$falgs = 0;}
					}
				}else{$falgs = 1;}
				if($falgs==0){ks_header('https://'.APP_DOMAIN.'/h5market/audiolive?id='.$infoid);}
			}
		}

		echo '<script src="https://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>';
    	$access_token = getAccessToken($this->wxid);
		if(empty($access_token)){
			$access_token = getAccessToken(2);
			$wxid2 = 2;
		}else{
			$wxid2 = $this->wxid;
		}
		$appid       = $this->cache->GetH('wxconfig','wxid',$wxid2,'appid',$wxid2);
		$appSecret   =  '';
		include ROOT."Application/View/home/h5/jssdk.php";
		$jssdk       = new JSSDK($appid,$appSecret,$access_token,$wxid2,'');
		$signPackage = $jssdk->GetSignPackage();

		$conf            = (object)array();
		$conf->infoid    = $infoid;
		$conf->cid       =ChkClng(KS_G('get.cid'));
		$conf->type      = 7;
		$conf->shareType = 2;
		share($this->wxid,$conf);

		//ks_include(CURR_VIEW_PATH.'audioin.php');
		include CURR_VIEW_PATH.'audioin.php';
	}
	//获取更多评论
	public function commentlistAction(){
		ks_include($this->dir.'commentlist.php');
		include $this->dir.'commentlist.php';
	}
    //获取优惠券列表
	public function getvoucherAction(){
        header("Access-Control-Allow-Origin: *");
		$maxPerPage = null !=ChkClng(GF('maxPerPage')) ?ChkClng(GF('maxPerPage')):'50';
    	$picth  = ChkSQL(GF('pitch'))!='' ? ChkSQL(GF('pitch')):'';
    	$picth = strlen($picth)==1?intval($picth):$picth;
    	$db_Mode = M('app_voucher_list');
		$key=null !== GF('key') ? GF('key') : '' ;
		$wxid=null !== GF('wxid') ? GF('wxid') : '0' ;
		$where = 'where wxid='.$wxid.' and isuse = 0';
		if($key){
			$where .=" and (title like '%$key%')";
		}
		$style          = null !==GF('style') ? GF('style'):1;
    	if($picth){
    		$picth = str_replace("@",",",$picth);
    		$where= $where.' and id in('.$picth.')';
    	}elseif($picth===0){
    		$options['totalput'] = 0;
    		$options['maxperpage'] = 50;

    		$page = Page($options);
    		$result['page'] = $page;
    		$result['style'] = $style;
    		$result['dt'] = array();
    		header("Content-type: application/json");
	        echo json_encode($result);exit;
    	}
    	

		$options = $db_Mode->getOptions($maxPerPage,$where);//分页参数设置
		$options['now_page'] = null !==GF('p') ? GF('p'):'1';
		$page = Page($options);
		$dt = $db_Mode->getPage($page,'id',$where);
		// foreach($dt as $k =>$v){
		// 	if($v['type']==5){
  //                 $dt[$k]['price'] = $db_class->getOng('price','where classid='.$v['infoid']);
		// 	}elseif ($v['type']==6) {
		// 		$dt[$k]['price'] = $db_paper->getOng('price','where paperid='.$v['infoid']);
		// 	}else{
  //               $dt[$k]['price'] = $db_course->getOng('price','where courseid='.$v['infoid']);
		// 	}
		// 	$dt[$k]['nowtime'] = time();
		// 	$dt[$k]['setting']=unserialize($v['setting']);
		// }
		$result['page'] = $page;
		$result['style'] = $style;
		$result['dt'] = $dt;

		header("Content-type: application/json");
        echo json_encode($result);exit;
	}
	//分销入口处
	public function spreadAction(){
		$Db4    = M('app_tasks');
		$taskinfo = $Db4->getAll('where status = 1');
		include CURR_VIEW_PATH.'stuclass/spread.html';
	}
	//页面
	public function spreadinfoAction(){
		if(APP_DOMAIN != 'store.kesion.com'){
			$Data001['userid'] = getsession('member')['userid'];
			// spreadtask($Data001);
			$Db     = M('app_invitation_log');
			$Model  = M('common_user_website');
			$Db2    = M('app_task_money_log');
			$info   = $Db2->getAll('where userid='.getsession('member')['userid'].' order by id desc');
			$values = $Db->getALL('where userid='.getsession('member')['userid']);
			$money  = 0;
			$Db3    = M('app_news');
			$news   = $Db3->getAll('where wxid=1 and categoryid=1788 order by id desc limit 5');
			foreach ($values as $k => $v) {
				$sitename       = $Model->getOne('sitename','where userid="'.$v['inviteeid'].'"');
				$money = $money+$v['money'];
				$values[$k]['sitename'] = $sitename;
				$values[$k]['logo'] = $Model->getOne('logo','where userid="'.$v['inviteeid'].'"');
				if(!$values[$k]['logo']){
					$values[$k]['logo'] ="/Public/admin/images/login/logo.png";
				}
			}
			$Db4    = M('app_tasks');
			$taskinfo = $Db4->getAll('where status = 1');
			$beginToday=mktime(0,0,0,date('m'),date('d'),date('Y'));
			$endToday=mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
			foreach ($taskinfo as $k => $v) {
				$taskinfo[$k]['count'] = $Db->getOne('count(*)','where userid='.getsession('member')['userid'].' and taskid='.$v['id'].' and adddate >='.$beginToday.' and adddate <= '.$endToday.'  order by id desc');
			}
			if(empty($info)){
				$info['balance'] = 0;
				$info['balance'] = $money-$info['balance'];
			}else{
				$cmoney =0;
				foreach ($info as $k => $v) {
					$cmoney = $cmoney +$v['cmoney'];
				}
				$info['balance'] = $money-$cmoney;
			}
			// exit();
			@$access_token = getAccessToken($this->wxid);
			if(empty($access_token)){
				$access_token = getAccessToken(2);
				$wxid2 = 2;
			}else{
				$wxid2 = $this->wxid;
			}
			$appid       = $this->cache->GetH('wxconfig','wxid',$wxid2,'appid',$wxid2);
			$appSecret   =  '';
			include ROOT."Application/View/home/h5/jssdk.php";
			$jssdk       = new JSSDK($appid,$appSecret,$access_token,$wxid2,'');
			$signPackage = $jssdk->GetSignPackage();
			include CURR_VIEW_PATH.'stuclass/spreadinfo.html';
		}
	}
	public function spreadnewAction(){
		$Db2  = M('app_news');
		$id   = KS_G('get.id');
		$info = $Db2->getRow('where id='.$id);
		@$access_token = getAccessToken($this->wxid);
		if(empty($access_token)){
			$access_token = getAccessToken(2);
			$wxid2 = 2;
		}else{
			$wxid2 = $this->wxid;
		}
		$appid       = $this->cache->GetH('wxconfig','wxid',$wxid2,'appid',$wxid2);
		$appSecret   =  '';
		include ROOT."Application/View/home/h5/jssdk.php";
		$jssdk       = new JSSDK($appid,$appSecret,$access_token,$wxid2,'');
		$signPackage = $jssdk->GetSignPackage();
		include CURR_VIEW_PATH.'stuclass/content.html';
	}
	public function spreadtxAction(){
		$Db2  = M('app_task_money_log');

		$info = $Db2->getAll('where userid='.getsession('member')['userid'].' order by id desc');
		include CURR_VIEW_PATH.'stuclass/spreadtx.html';
	}
	public function spreadcashAction(){
		$Db = M('app_invitation_log');
		$values = $Db->getALL('where userid='.getsession('member')['userid']);
		$money = 0;
		if(!empty($values)){
			foreach ($values as $k => $v) {
				$money = $money+$v['money'];
			}
		}
		$Db2  = M('app_task_money_log');
		$info = $Db2->getAll('where userid='.getsession('member')['userid'].' order by id desc');
		if(empty($info)){
			$info['balance'] = 0;
			$info['balance'] = $money-$info['balance'];
		}else{
			$cmoney =0;
			foreach ($info as $k => $v) {
				$cmoney =$cmoney +$v['cmoney'];
			}
			$info['balance'] = $money-$cmoney;
		}

		include CURR_VIEW_PATH.'stuclass/spreadcash.html';
	}
	public function dospreadcashAction(){
		$Db = M('app_invitation_log');
		$values = $Db->getALL('where userid='.getsession('member')['userid']);
		$money = 0;
		$banknum = KS_G('post.banknum');
		$nickname = KS_G('post.nickname');
		foreach ($values as $k => $v) {
			$money = $money+$v['money'];
		}
		$balance = KS_G('post.balance');
		if($balance<10){
			echo json_encode(array('errcode' =>'404','msg'=>'提现金额不能小于10'));exit;
		}
		$Db2  = M('app_task_money_log');
		$info = $Db2->getAll('where userid='.getsession('member')['userid'].' order by id desc');
		if(!empty($info)){
			$cmoney =0;
			foreach ($info as $k => $v) {
				$cmoney =$cmoney +$v['cmoney'];
			}
			$money = $money-$cmoney;
		}
		$cmoney = $money-$balance;
		if($cmoney<0){
			echo json_encode(array('errcode' =>'404','msg'=>'您的可提现金额没这么多'));exit;
		}
		$Data002['userid']=getsession('member')['userid'];
		$Data002['cmoney'] = $balance;
		$Data002['balance'] = $cmoney;
		$Data002['adddate'] = time();
		$Data002['userip']  = $_SERVER["REMOTE_ADDR"];
		$Data002['mark']  ='大佬提现'.$balance;
		$Data002['status'] = 0;
		$Data002['bank'] = '微信';
		$Data002['banknum'] = $banknum;
		$Data002['name'] = $nickname;
		M('app_task_money_log')->doAdd($Data002,'id');//写入提现
		echo json_encode(array('errcode' =>'0','msg'=>'提现提交成功，我们的工作人员会通过微信与您联系'));exit;
	}

	public function usercontractAction(){
		include CURR_VIEW_PATH.'usercontract.php';
	}
	/**
     * 分销推广列表 (准备删除）
	 */
	public function distributeListAction(){
		$site = $this->cache->GetACache('setting');
		$wxid = $this->wxid;
		//ks_include($this->dir.'distributeList.php');
		//include $this->dir.'distributeList.php';
        include CURR_VIEW_PATH.'distributeList.php';
		echo '<script src="//res.wx.qq.com/open/js/jweixin-1.2.0.js?'.$site['jshash'].'"></script>
	    <script src="'.UOOT.'Public/wechat/js/share.js?'.$site['jshash'].'" type="text/javascript"></script>';
	    $url          = '';
//		$access_token = getAccessToken($wxid);
//		if(empty($access_token)){
			$access_token = getAccessToken(2);
			$wxid2	      = 2;
//		}else{
//			$wxid2	      = $wxid;
//		}
		//得到网校的appid
		$cache     = new \Core\Cache();
		$appid     = $cache->GetH('wxconfig','wxid',$wxid2,'appid',$wxid2);
		$appSecret =  '';
	    include ROOT."Application/View/home/h5/jssdk.php";
	    $jssdk = new JSSDK($appid,$appSecret,$access_token,$wxid2,'');
	    $signPackage = $jssdk->GetSignPackage();
	    $onshare  = 'onshare(conf);';
	    echo '<script>
			var conf  = {};
			conf.basicinfo = {};
			conf.appId = "'.$signPackage['appId'].'";
			conf.timestamp = "'.$signPackage['timestamp'].'";
			conf.nonceStr = "'.$signPackage['nonceStr'].'";
			conf.signature = "'.$signPackage['signature'].'";

			conf.basicinfo.sharetitle = "";
			conf.basicinfo.shareintr = "";
			conf.basicinfo.defaultpic = "";
			conf.url = "";
			'.$onshare.'
	    </script>';
	}
	//我的分销
	public function myDistributeAction(){
		if(getsession('member')){
			include CURR_VIEW_PATH.'stuclass/myDistribute.php';
    	}else{
    		KS_INFOM('请先登录',M_URL('h5market','wechatlogin')."?actindex=".ACTION);
    	}
	}
	//分销明细
	public function promoteDetailsAction(){
		if(getsession('member')){
			$id = KS_G('get.id');
			$type = GF('type');
			include CURR_VIEW_PATH.'stuclass/promoteDetails.php';
		}else{
			KS_INFOM('请先登录',M_URL('h5market','wechatlogin')."?actindex=".ACTION);
		}
	}

	//分销明细
	public function myWithdrawalAction(){
		if(getsession('member')){
			$id = KS_G('get.id');
			$type = GF('type');
			include CURR_VIEW_PATH.'stuclass/myWithdrawal.php';
		}else{
			KS_INFOM('请先登录',M_URL('h5market','wechatlogin')."?actindex=".ACTION);
		}
	}

	public function columnlistAction(){
		$wxid = $this->wxid;
		ks_include($this->dir.'columnList.php');
		include $this->dir.'columnList.php';
	}
	public function columndetailAction(){
		$wxid = $this->wxid;
		$id =ChkClng(KS_G('get.id'));
		if(!isMobile()){
            $isfromPc= 1;
		}else{
			$isfromPc= 2;
		}
		ks_include($this->dir.'columndetail.php');
		include $this->dir.'columndetail.php';
		$conf =(object)array();
		$conf->id  =$id;
		$conf->type = 11;
		share($this->wxid,$conf);
		$gift = KS_G('get.gift');
		if($gift == 2){
			echo "<script>toast2({content:'赠礼成功,前往个人中心查看赠礼信息',duration:2000})</script>";
		}
	}
}