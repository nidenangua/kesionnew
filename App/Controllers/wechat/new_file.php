<?php

       $Data['groupid'] = ChkClng(KS_G('post.groupid'));
       
       
       
		$Data['openid'] = ChkSQL(KS_G("post.openid"));
		$app_wechat_user_group = M('app_wechat_user_group');
	    $tag_id = $app_wechat_user_group->getOne(" tag_id","where  wxid =". $this->wxid ." and id = ".$Data['groupid']);
	    $access_token = getAccessToken($this->wxid);
	    $data = '{
				  "openid_list" : [
				    "'.$Data['openid'].'"
				   ],
				  "tagid" : "'.$tag_id.'"
				}';
		//var_dump($data);exit;
		//为用户加新标签
		$url1="https://api.weixin.qq.com/cgi-bin/tags/members/batchtagging?access_token=".$access_token;				
		$modifyGroup1  = json_decode(curlPost($url1,$data),true);
		
		
		
		
		$id = ChkClng(KS_G('get.id'));
		$now_page = ChkClng(KS_S('p'));
		$Data['remark'] = ChkSQL(KS_G("post.remark"));
		$winXinUserModel = M('app_weixin_user');
		$Rule['remark'] = '备注|isEmpty';
		Chkpost($Data,$Rule,$winXinUserModel);
		$winXinUserModel->update($Data,'id='.$id );
		$url1= M_URL($this->AppName.'/Index','fansList',"",GP(''));
		KS_INFO('修改成功',3,$url1);







public function doEditRemarkAction(){
		$Data['groupid'] = ChkClng(KS_G('post.groupid'));
		$Data['openid'] = ChkSQL(KS_G("post.openid"));
		$app_wechat_user_group = M('app_wechat_user_group');
	    $tag_id = $app_wechat_user_group->getOne(" tag_id","where  wxid =". $this->wxid ." and id = ".$Data['groupid']);
	    $access_token = getAccessToken($this->wxid);
	    $url1="https://api.weixin.qq.com/cgi-bin/tags/members/batchtagging?access_token=".$access_token;
		
		$data = '{
				  "openid_list" : [
				    "'.$Data['openid'].'"
				   ],
				  "tagid" : "'.$tag_id.'"
				}';
		//var_dump($data);exit;				
		$modifyGroup1  = json_decode(curlPost($url1,$data),true);
		var_dump($modifyGroup1);exit;
		if($modifyGroup1['errmsg'] =="ok"){
			//新增分组数加1
	     $lis['groupnum'] = 'groupnum+1';
		$app_wechat_user_group->update($lis,"id = " .$Data['groupid'],1);
		}
		
		$url2 ="https://api.weixin.qq.com/cgi-bin/tags/members/batchuntagging?access_token=".$access_token;
		$modifyGroup2  = json_decode(curlPost($url2,$data),true);
		//var_dump($modifyGroup2);exit;
		if($modifyGroup2['errmsg'] =="ok"){
			//原来分组数数据减1
		$old['groupid'] = ChkClng(KS_G('post.groupidd'));
		$ls['groupnum'] = 'groupnum-1';
		$app_wechat_user_group->update($ls,"id = ". $old['groupid'],1);
		}
		$id = ChkClng(KS_G('get.id'));
		$now_page = ChkClng(KS_S('p'));
		$Data['remark'] = ChkSQL(KS_G("post.remark"));
		$winXinUserModel = M('app_weixin_user');
		$Rule['remark'] = '备注|isEmpty';
		Chkpost($Data,$Rule,$winXinUserModel);
		$winXinUserModel->update($Data,'id='.$id );
		$url1= M_URL($this->AppName.'/Index','fansList',"",GP(''));
		KS_INFO('修改成功',3,$url1);
	}







?>