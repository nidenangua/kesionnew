<?php
// +----------------------------------------------------------------------
// | KesionPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2017 http://www.kesion.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 厦门科汛软件有限公司　 版权所有 © 2006-2017
// +----------------------------------------------------------------------
// | Advice: 好的编程习惯是成功的一半，对齐，注释  你可以的！
// +----------------------------------------------------------------------



namespace Kesion\Model\App;
use Kesion\Model;
class MessageModel extends Model{
	//公告记录
	public function announceRecords($Data005){
		$entrance = null !==GF('entrance') ? GF('entrance'):'0';
		if(isset($Data005['option'])){$option = $Data005['option'];}
		else{$option = null !==GF('option') ? GF('option'):'1';}
		$keyword  = KS_S('keyword');
		if($option==1){//发送站公告
			$Massage      = M('app_class_notice');
			if(!empty($keyword)){
                $where1 = " and title like '%".$keyword."%'";
			}else{$where1 = '';}
			$where    = 'where status!=-1 and wxid='.$Data005['wxid'].$where1.' order by id desc';
			$notices  = $Massage->getAll($where);
			if(isset($Data005['now_page'])){
				$now_page = $options['now_page'] = $Data005['now_page'];
			}else{
				$now_page = $options['now_page'] = null !==GF('p') ? GF('p'):'1';
			}
			if(isset($Data005['maxperpage'])){
				$options['maxperpage']  = $Data005['maxperpage'];
			}else{
				$options['maxperpage']  = null !=ChkClng(KS_G('request.maxperpage')) ? ChkClng(KS_G('request.maxperpage')):'10';
			}

		    $options['totalput']    = count($notices);
			$page       = Page($options);
			foreach($notices as $k=>$v){
				$notices[$k]['adddate'] = date('Y-m-d H:i:s',$v['adddate']);
				$notices[$k]['url']     = '/home.html/default/Interaction/announceView?id='.$v['id'];
			}
			$Massages   = $page->arrayPage($notices);
		}else{//发送站内信
			$Massage      = M('app_information');
			if(!empty($keyword)){
                $where1 = " and title like '%".$keyword."%'";
			}else{$where1 = '';}
			$where    = 'where status!=-1 and wxid='.$Data005['wxid'].$where1.' order by id desc';
			$notices  = $Massage->getAll($where);
			if(isset($Data005['now_page'])){
				$now_page = $options['now_page'] = $Data005['now_page'];
			}else{
				$now_page = $options['now_page'] = null !==GF('p') ? GF('p'):'1';
			}
			if(isset($Data005['maxperpage'])){
				$options['maxperpage']  = $Data005['maxperpage'];
			}else{
				$options['maxperpage']  = null !=ChkClng(KS_G('request.maxperpage')) ? ChkClng(KS_G('request.maxperpage')):'10';
			}
		    $options['totalput']    = count($notices);
			$page = Page($options);
            //			foreach($notices as $k => $v){
            //				$notices[$k]['adddate']=date('Y-m-d h:i:s',$v['adddate'] );
            //				$notices[$k]['username'] = M('common_user')->getOne('username','where userid='.$v['student']);
            //			}
			$Massages       = $page->arrayPage($notices);
		}
		if(empty($Massages)){$Massages = array();}
		$result['page']     = $page;
		$result['Messages'] = $Massages;
	    return $result;
	}
	//发布公告
	public function announce($Data006){
		$entrance        = null !==GF('entrance') ? GF('entrance'):'0';
		$option          = null !==GF('option') ? GF('option'):'1';
		$option          = isset($Data006['option'])?$Data006['option']:$option;
		$Data['title']   = isset($Data006['title'])?$Data006['title']:ChkSQL(KS_G('post.title'));
		$Data['content'] = isset($Data006['content'])?$Data006['content']:ChkSQL(KS_G('post.content'));
		$Data['inputer'] = isset($Data006['inputer'])?$Data006['inputer']:ChkSQL(KS_G('post.inputer'));
		if($option==1){//发送站公告
			$Data['adddate'] =  isset($Data006['adddate'])?$Data006['adddate']:strtotime(ChkSQL(KS_G('post.adddate')));
			$Data['adddate'] =  !empty($Data['adddate'])?$Data['adddate']:time();
			if(isset($Data006['type'])&&$Data006['type']==1){
				$Data['classid']=$Data006['courseid'];
				$Data['enddate']=$Data006['enddate'];
			}
			$Data['type']    =  1;
			$Data['wxid']    =  $Data006['wxid'];
			$Mode            =  M('app_class_notice');
			$Mode->doAdd($Data,'id');
			if(isset($Data006['type'])&&$Data006['type']==1){
                return 'ok';
			}else{
				KS_INFO('发布成功!',3,M_URL('Massage','postlist','',GP('option-1')));
			}
		}else{//发送站内信
			$chargetype  = KS_G('post.chargetype');
			if($chargetype==1){//发给指定学生
				$Mode    = M('common_user');
				$names   = ChkSQL(KS_G('post.names'));
				$names   = explode(',', $names);
				$userids = array();$numb    = 0;
				foreach($names as $k =>$v){
					$userid = $Mode->getOne('userid','where wxid='.$Data006['wxid'].' and usertype=0 and username="'.$v.'"');
					if(!empty($userid)){$userids[] = 'a'.$userid;$numb++;}
				}
				if(!empty($userids)){
                    $student=implode(',',$userids);
				    noticeSend($Data006['wxid'],$student,0,$Data['title'],$Data['content'],2,$Data['inputer'],$numb);
			    }else{$student='';KS_INFO('发布失败，没有指定用户!');}
            }elseif($chargetype==2){
				$infoid     = KS_G('post.infoid');
				$Mode       = M('app_class_studentrelate');
				$userid     = $Mode->getAll('where wxid='.$Data006['wxid'].' and classid='.$infoid,'memberid');
				$userids    = array();$numb    = 0;
				foreach($userid as $k =>$v){
					if(!empty($v['memberid'])){$userids[] = 'a'.$v['memberid'];$numb++;}
				}
				if(!empty($userids)){
                    $student=implode(',',$userids);
                    noticeSend($Data006['wxid'],$student,0,$Data['title'],$Data['content'],1,$Data['inputer'],$numb);
			    }else{$student='';KS_INFO('发布失败，该班级下没有用户!');}
			}elseif($chargetype==3){
				$groupid     = KS_G('post.groupid');
				$db_user_member = M('common_group_user');
				$userid     = $db_user_member->getAll('where  grouplevel='.$groupid.' and buytime>'.time(),'userid');
				$userids    = array();$numb    = 0;
				foreach($userid as $k =>$v){
					if(!empty($v['userid'])){$userids[] = 'a'.$v['userid'];$numb++;}
				}
				if(!empty($userids)){
                    $student=implode(',',$userids);
                    noticeSend($Data006['wxid'],$student,0,$Data['title'],$Data['content'],1,$Data['inputer'],$numb);
			    }else{$student='';KS_INFO('发布失败，该会员组下没有用户!');}
			}
			if(isset($Data006['type'])&&$Data006['type']==1){
                return 'ok';
			}else{
				KS_INFO('发布成功!',3,M_URL('Massage','postlist','',GP('option-2,entrance-'.$entrance)));
			}
		}
	}
	//公告详情
	//type1:type2是学生观看直播端的
	public function announceView($Data007){
		$option           = null !==GF('option') ? GF('option'):'1';
		$option           = isset($Data007['option'])?$Data007['option']:$option;
		if($option==1){
			$Massage      = M('app_class_notice');
			$ids          = isset($Data007['id'])?$Data007['id']:ChkClng(KS_G('get.id'));
			switch($Data007['type']){
				case 1:$notice = $Massage->getRow('where id='.$ids.' order by id desc limit 1');break;
				case 2://var_dump('where wxid='.$Data007['wxid'].' and enddate>'.time().' limit 1');exit;
                    $notice = $Massage->getAll('where wxid='.$Data007['wxid'].' and enddate>'.time().' order by id desc limit 10');break;
				default:$notice = $Massage->getRow('where id='.$ids.' limit 1');break;
			}
		}else{
			$Massage      = M('app_information');
			$ids          = isset($Data007['id'])?$Data007['id']:ChkClng(KS_G('get.id'));
			$notice       = $Massage->getRow('where id='.$ids.' limit 1');
		}
		if(isset($Data007['type'])){
            switch($Data007['type']){
                case 1:
                case 2:
                    foreach($notice as $k=>$v){
                        $notice[$k]['adddate'] = date('Y-m-d H:i',$notice[$k]['adddate']);
                    }break;
                default:$notice['adddate'] = date('Y-m-d H:i',$notice['adddate']);break;
            }
        }
		$result['notice']  = $notice;
		return $result;
	}
	//添加投票
	public function addavote($Data008){
    	$app_vote           = M('app_vote');
		$Data['tktype']     = $Data008['tktype'];
		$Data['userid']     = 0;
		$Data['wxid']       = $Data008['wxid'];
		$Data['level']      = ChkClng(KS_G('post.level'));
		$Data['paperTypeId']= ChkClng(KS_G('post.paperTypeId'));
		$Data['isvideo']    = ChkClng(KS_G('post.audio'));
		if($Data['isvideo'] == 1){$Data['uploads'] = ChkClng(KS_G('post.uploads'));}
		if($Data['tktype']  == 1){//选择题
			$stem1              = $Data008['stem1'];
			$select             = $Data008['select1'];
			$select             = implode("|$|", $select);
			$Data['options']    = $Data008['title'].'$$$'.$select;
			$Data['title']      = $Data008['title'];
			$Data['courseid']   = $Data008['courseid'];
			$Data['choicetype'] = $Data008['choicetype'];
			$Data['pluses']     = $Data008['pluses'][0];
			$Data['adddate']    = time();
		}elseif($Data['tktype'] == 2){//多选题
			$stem1              = $Data008['stem1'];
			$select             = $Data008['select1'];
			$select             = implode("|$|", $select);
			$Data['options']    = $Data008['title'].'$$$'.$select;
			$Data['title']      = $Data008['title'];
			$Data['courseid']   = $Data008['courseid'];
			$Data['choicetype'] = $Data008['choicetype'];
			$Data['pluses']     = $Data008['pluses'][0];
			$Data['adddate']    = time();
		}
		$Rule['options']      = '题目|isEmpty';
		Chkpost($Data,$Rule,$app_vote);
		$id                    = $app_vote->doAdd($Data,'tkid');
		$result = $id;
		return $result;
	}
	//投票记录
	public function voteRecord($Data009){
		$vote_answer       = M('app_vote_answer');
		$where             = 'where a.wxid='.$Data009['wxid'].' and a.tkid='.$Data009['tkid'];
		$left_join         = M('common_user_member');//需要连表的在最后left join
		$where             = "as a left join `".$left_join->table."` as b on a.memberid = b.userid $where";
		$byname            = 'a.adddate desc';
		$options           = $vote_answer->getOptions($Data009['maxPerPage'],$where);//分页参数设置
		if(isset($Data009['now_page'])){
			$options['now_page'] = $Data009['now_page'];
		}else{
			$options['now_page'] = null !==GF('p') ? GF('p'):'1';
		}
		$page              = Page($options);
		$values            = $vote_answer->getPage($page,$byname,$where,'b.name,a.*');
		foreach($values as $k=>$v){
			$values[$k]['adddate'] = date('Y-m-d H:i',$v['adddate']);
		}
	    $result['page']    = $page;
		$result['values']  = $values;
		return $result;
	}
	//投票列表
	public function voteList($Data010){
		$app_vote = M('app_vote');
		//tktype='.$Data010['tktype'].' and
		if(!empty($Data010['choicetype'])){
			$where         = 'where wxid='.$Data010['wxid'].' and choicetype='.$Data010['choicetype'];
		}else{
			$where         = 'where wxid='.$Data010['wxid'];
		}
        //		$left_join         = M('app_paper_tk');//需要连表的在最后left join
        //		$where             = "as a left join `".$left_join->table."` as b on a.tkid = b.tkid $where";
		$byname            = 'adddate desc';
		$options           = $app_vote->getOptions($Data010['maxPerPage'],$where);//分页参数设置
		if(isset($Data010['now_page'])){
			$options['now_page'] = $Data010['now_page'];
		}else{
			$options['now_page'] = null !==GF('p') ? GF('p'):'1';
		}
		$page              = Page($options);
		$values            = $app_vote->getPage($page,$byname,$where);
		foreach($values as $k =>$v){
			$values[$k]['url1']    = '/home.html/default/Interaction/voteRecord?id='.$v['tkid'];
			$values[$k]['adddate'] = date('Y-m-d H:i',$v['adddate']);
		}
	    $result['page']    = $page;
		$result['values']  = $values;
		return $result;
	}
	//投票详情
	//type1:type2是学生观看直播端的
	public function voteView($Data008){
		$app_vote     = M('app_vote');
		$ids          = isset($Data008['id'])?$Data008['id']:ChkClng(KS_G('get.id'));
	    $notice            = $app_vote->getRow('where tkid='.$ids.' order by tkid desc limit 1');
	    $notice['adddate'] = date('Y-m-d H:i',$notice['adddate']);
		$result['notice']  = $notice;
		return $result;
	}
	//表扬,批评
	public function praise($Data009){
		$app_praise = M('app_praise');
		$Dataglamour['memberid']   = $Data009['userid'];
		$Dataglamour['wxid']       = $Data009['wxid'];
		$Dataglamour['courseid']   = $Data009['courseid'];
		$Dataglamour['userid']     = $Data009['userid'];
		$Dataglamour['choicetype'] = $Data009['choicetype'];
		$Dataglamour['type']       = $Data009['type'];
		$Dataglamour['praisetype'] = $Data009['praisetype'];
		$Dataglamour['textcontent']= $Data009['textcontent'];
		$Dataglamour['glamour']    = $Data009['glamour'];
		$Dataglamour['adddate']    = time();
	    $id = $app_praise->doAdd($Dataglamour,'id');
		$result['result'] = 'ok';$result['id'] = $id;return $result;
	}
	//表扬,批评列表
	public function praiselist($Data010){
		$app_praise = M('app_praise');
		if(!empty($Data010['choicetype'])){
			$where         = 'where wxid='.$Data010['wxid'].' and choicetype='.$Data010['choicetype'];
		}else{
			$where         = 'where wxid='.$Data010['wxid'];
		}
		$byname            = 'adddate desc';
		$options           = $app_praise->getOptions($Data010['maxPerPage'],$where);//分页参数设置
		if(isset($Data010['now_page'])){
			$options['now_page'] = $Data010['now_page'];
		}else{
			$options['now_page'] = null !==GF('p') ? GF('p'):'1';
		}
		$page              = Page($options);
		$values            = $app_praise->getPage($page,$byname,$where);
		$user_member       = M('common_user_member');
		foreach($values as $k=>$v){
			if(!empty($v['memberid'])){
				$allmember             = $user_member->getAll("where userid in (".$v['memberid'].")",'name');
				if(empty($allmember)){
					$values[$k]['name']    = '';
				}else{
					foreach($allmember as $kt=>$vt){
						if($kt==0){$kkk=$vt['name'];}else{$kkk .= '✜'.$vt['name'];}
					}
					$values[$k]['name']    = $kkk;
				}
			}
			$values[$k]['url1']    = $v['id'];
			$values[$k]['adddate'] = date('Y-m-d H:i',$v['adddate']);
		}
	    $result['page']    = $page;
		$result['values']  = $values;
		return $result;
	}
	//表扬,批评内容
	public function praiseview($Data007){
		$app_praise   = M('app_praise');
		$ids          = isset($Data007['id'])?$Data007['id']:ChkClng(KS_G('get.id'));
		$result       = $app_praise->getRow('where id='.$ids.' order by id desc limit 1');
		$user_member       = M('common_user_member');
		if(!empty($result['memberid'])){
            $allmember       = $user_member->getAll("where userid in (".$result['memberid'].")");
            if(empty($allmember)){
                $result['name']    = '';
            }else{
                foreach($allmember as $k=>$v){
                    if($k==0){$kkk=$v['name'];}else{$kkk .= '✜'.$v['name'];}
                }
                $result['name']    = $kkk;
            }
		}
		$result['adddate'] = date('Y-m-d H:i',$result['adddate']);
		return $result;
	}
}