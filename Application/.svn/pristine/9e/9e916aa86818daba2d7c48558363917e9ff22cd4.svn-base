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
class CouponController extends CommonController
{
	/*	
	 * 显示优惠券管理页面
	 */
	public function indexAction(){
//		$keyword=ChkSQL(GF('keyword') ? GF('keyword'):'');
//		var_dump($keyword);
//		include  CURR_VIEW_PATH . "Coupon/coupon_manage.php";
//		exit;
		$table = M('common_voucher_add');
		$keyword=ChkSQL(GF('keyword') ? GF('keyword'):'');
		$status=ChkClng(GF('status') ? GF('status'):3);
		$now_page=ChkClng(GF('p') ? GF('p'):'1'); 
		$byname = ChkSQL(GF('byname') ? GF('byname'):'desc');
		if($status==3){ $where= ' where (status=1 or status=0)';}
	 	if($status==1){ $where= ' where status=1';}
	 	if($status==2){ $where= ' where status=0';}
	 	if(!empty($keyword)){
	     	$where  = $where.' and voucher like "%'.$keyword.'%"';
	    }
		$now_page =  ChkClng(KS_S('p',1));
		$options = $table->getOptions('5',$where);//分页参数设置
		$page = Page($options);
		$infoary = $table->getPage($page,'adddate '.$byname,$where,'id,voucher,minamount,facevalue,startime,adddate,maxnum,endtime,descript,scope,status,grantnum,buildnum,headnum');
		include  CURR_VIEW_PATH . "Coupon/coupon_manage.php";
	}
	//显示添加页面
	public function couponaddAction(){
		if(!empty(KS_G('request.id'))){
			$couponId = KS_G('request.id');
			$table = M('common_voucher_add');
			$ary=$table->getRow('where id='.$couponId,'id,voucher,minamount,facevalue,startime,adddate,maxnum,endtime,descript,scope,type,headnum,status');
		}
		$now_page =  ChkClng(KS_S('p',1));		
		include  CURR_VIEW_PATH . "Coupon/coupon.php";
	}
	//显示生成优惠券页面
	public function buildAction(){
		$couId = ChkSQL(KS_G('request.id'));
		$now_page =  ChkClng(KS_S('p',1));
		include  CURR_VIEW_PATH . "Coupon/coupon_build.php";
	}	
	
	//添加优惠券
	public function addcouponAction(){
		$couponAry = $_POST;
		$table = M('common_voucher_add');
		$couponname = ChkSQL($couponAry['couponname']? $couponAry['couponname']:'');//优惠券名
		$price = ChkClng($couponAry['price']? $couponAry['price']:'');//价格
		$status = ChkClng($couponAry['status']? $couponAry['status']:'');//优惠券使用状态
		$startime = ChkSQL($couponAry['startime']? $couponAry['startime']:'');//开始时间
		$endtime = ChkSQL($couponAry['endtime']? $couponAry['endtime']:'');//结束时间
		$coupontype = ChkClng($couponAry['coupontype']? $couponAry['coupontype']:'');//优惠券类型
		$maxnum = ChkClng($couponAry['maxnum']? $couponAry['maxnum']:'');//优惠券最大发放数量
		$minamount = ChkClng($couponAry['minamount']? $couponAry['minamount']:'');//优惠券类型
		$desc = ChkSQL($couponAry['desc']? $couponAry['desc']:'');//优惠券描述
		$headnum = ChkSQL($couponAry['headnum']? $couponAry['headnum']:'');//优惠券号前缀
		if(empty($couponname)||empty($price)||empty($startime)||empty($endtime)||empty($maxnum)||empty($minamount)||empty($headnum)){
			KS_INFO("信息不完整",0);
			exit;
		}
		$data['headnum'] =$headnum;
		$data['facevalue'] = $price;
		$data['voucher'] = $couponname;
		$data['adddate'] = time();
		$data['minamount'] =$minamount;
		$data['maxnum'] = $maxnum;
		$data['descript'] = $desc;
		if(strtotime($startime)<time()){
			KS_INFO("开始时间不正确",0);
			exit;
		}
		$validTime=strtotime($endtime)-strtotime($startime);//计算优惠券的有效时间
		if($validTime<86400){
			KS_INFO("优惠券有效期最少一天",0);
			exit;
		}
		$data['startime'] = strtotime($startime);
		$data['endtime'] = strtotime($endtime);
        $data['status'] = $status;
	    $data['scope'] = $coupontype;
	    //当优惠券不是通用型时；
		if($coupontype==1){
			$concretetypeAry = null !==$couponAry['concretetype']? $couponAry['concretetype']:array();
			if(count($concretetypeAry)==0){		
		        KS_INFO("你的具体类型还没有选择",0);
			}else{
				$str='';
				foreach($concretetypeAry as $key => $val){
					if($key != count($concretetypeAry)-1){
						$str.=$val.'|';
					}else{
						$str.=$val;
					}
					
				}
				$data['type'] = $str;
			}
		}
			$table->doadd($data,'id');
			KS_INFO("添加成功",0,M_URL('Coupon','couponadd','',GP(''))); 
			//$this->cache->PutHCache('voucher',$wxid);//代金卷更新缓存
	}
	/*
	 * 生成优惠券。
	 */
	public function buildcouAction(){
		$table = M('common_voucher_add');
		$buildnum = ChkClng(KS_G('post.buildnum'));//生成数量
		$couId = ChkClng(KS_G('post.couponId'));//优惠券id
        if(intval($buildnum)>1){
	        $detailvou=$table->getRow('where id='.$couId,'voucher,facevalue,startime,endtime,scope,type,grantnum,headnum,buildnum,maxnum');
	        if(intval($detailvou['maxnum'])<intval($buildnum)){
	        	KS_INFO("你输入的数值超过了最大值,请重新去生成",'',M_URL('Coupon','index','',GP('')));
	        }
			$data['buildnum'] = intval($buildnum)+intval($detailvou['buildnum']); 
		    $res = $table->update($data,'id='.$couId);      	
        }
		$Data['vouid'] = $couId;
		$Data['voucher'] = $detailvou['voucher'];
		$Data['money'] = $detailvou['facevalue'];
		$Data['balance'] = $detailvou['facevalue'];
		$Data['adddate'] = $detailvou['startime'];
		$Data['enddate'] = $detailvou['endtime'];
		$Data['type'] = $detailvou['scope'];
		$Data['othertype'] = $detailvou['type'];
		include  CURR_VIEW_PATH . "Coupon/jdt.php";
	    for ($i = 0; $i <$buildnum ; $i ++) { 
			$str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';  
			$randStr = str_shuffle($str);//打乱字符串  
			$rands = substr($randStr,0,6);//substr(string,start,length);返回字符串的一部分 
			$Data['vouchernum']=$detailvou['headnum'].$rands;
			$sectable = M('common_voucher');
			$res=$sectable->doadd($Data,'id');
			$jg = ($i/$buildnum)*100;
            echo '<script>$(".charts").attr("w","'.$jg.'");$(".wz").html("总共文件'.$buildnum.'个,当前同步到第'.$i.'<br/>进度为：'.round($jg,2).'%");animate()</script>';
            if($jg==100){
            	KS_INFO("优惠券生成完毕",0,M_URL('Coupon','index','',GP('')));
            }
		}
	}
	/**
	 * 修改优惠券信息
	 */
	public function editcouponAction(){	
		$couponAry = $_POST;
		$table = M('common_voucher_add');
		$couId = ChkClng($couponAry['couponId']? $couponAry['couponId']:'');
		$couponname = ChkSQL($couponAry['couponname']? $couponAry['couponname']:'');//优惠券名
		$price = ChkSQL($couponAry['price']? $couponAry['price']:'');//价格
		$status = ChkClng($couponAry['status']? $couponAry['status']:'');//优惠券使用状态
		$startime = ChkSQL($couponAry['startime']? $couponAry['startime']:'');//开始时间
		$endtime = ChkSQL($couponAry['endtime']? $couponAry['endtime']:'');//结束时间
		$coupontype = ChkClng($couponAry['coupontype']? $couponAry['coupontype']:'');//优惠券类型
		$maxnum = ChkClng($couponAry['maxnum']? $couponAry['maxnum']:'');//优惠券最大发放数量
		$minamount = ChkSQL($couponAry['minamount']? $couponAry['minamount']:'');//优惠券限用价格
		$desc = ChkSQL($couponAry['desc']? $couponAry['desc']:'');//优惠券描述
		$headnum = ChkSQL($couponAry['headnum']? $couponAry['headnum']:'');//优惠券号前缀
		if(empty($couponname)||empty($price)||empty($startime)||empty($endtime)||empty($maxnum)||empty($minamount)||empty($headnum)){
			KS_INFO("信息不正确，请检查",0);
			exit;
		}
		$data['facevalue'] = $price;
		$data['voucher'] = $couponname;
		$data['minamount'] = $minamount;
		$data['maxnum'] = $maxnum;
		$data['descript'] = $desc;
		$data['headnum'] = $headnum;
		if(strtotime($startime)<time()){
			KS_INFO("开始时间不正确",0);
			exit;
		}
		$validTime=strtotime($endtime)-strtotime($startime);//计算优惠券的有效时间
		if($validTime<86400){
			KS_INFO("优惠券有效期最少一天",0);
			exit;
		}
		$data['startime'] = strtotime($startime);
		$data['endtime'] = strtotime($endtime);

	    $data['scope'] = $coupontype;
	    //当优惠券不是通用型时；
		if($coupontype==1){
			$concretetypeAry=null !==$couponAry['concretetype']? $couponAry['concretetype']:array();
			if(count($concretetypeAry)==0){		
		        KS_INFO("你的具体类型还没有选择",0);
			}else{
				$str='';
				foreach($concretetypeAry as $key => $val){
					if($key != count($concretetypeAry)-1){
						$str.=$val.'|';
					}else{
						$str.=$val;
					}
					
				}
				$data['type'] = $str;
			}
		}
			$table->update($data,'id='.$couId);
			KS_INFO("修改成功",0,M_URL('Coupon','index','',GP(''))); 
	}
	/**
	 * 单个删除
	 */
	public function deleteAction(){
		$table = M('common_voucher_add');
		$id=ChkSQL(KS_G('request.id'));
		$Data['status'] = -1; 
    	$res=$table->update($Data,'id='.$id);
		$now_page =  ChkClng(KS_S('p',1));		
		$url=M_URL('Coupon','index','',GP('p-'.$now_page));		
		ks_header($url);
	}
	/**
	 * 批量删除
	 */
	public function somedelAction(){
		$idAry = ChkSQL('' !==KS_G('post.id') ? KS_G('post.id'):array());
    	$Data['status'] = -1;
    	$table = M('common_voucher_add');
    	$now_page =  ChkClng(KS_S('p',1));
    	if(count($idAry)==0){
	    	$url = M_URL('Coupon','index','',GP('p-'.$now_page));			
			KS_INFO("请选择需要删除的数据",0,$url);	
    	}
    	foreach($idAry as $key =>$val){
    	  $res = $table ->update($Data,'id = '.$val.' and endtime<'.time());	
    	}		
		$url = M_URL('Coupon','index','',GP('p-'.$now_page));			
		KS_INFO("批量操作成功",0,$url);
	}
	/**
	 * 修改状态
	 */
	public function changeStatusAction(){
		$id=ChkSQL(KS_G('request.id'));
        $status =null !==GF('status') ? GF('status'):'';
        if($status==1){
        	$Data['status'] = 0;
        }else if($status==0){
        	$Data['status'] = 1;
        }
    	
    	$table = M('common_voucher_add');
    	  $res=$table ->update($Data,'id = '.$id);	
		$now_page =  ChkClng(KS_S('p',1));		
		$url=M_URL('Coupon','index','',GP('p-'.$now_page));			
		KS_INFO("更改成功",0,$url);
	}
	/*
	 * 显示发送页面
	 */
	public function showgrantAction(){
		$scope=ChkClng(null!==GF('scope') ? GF('scope'):'1');
//		var_dump($scope);
//exit;
		$now_page =  ChkClng(KS_S('p',1));
		$sumid =  ChkClng(null !==GF('maxid') ? GF('maxid'):'');
		$type =  ChkClng(null !==GF('type') ? GF('type'):'');
		$couId =  ChkClng(null !==GF('j') ? GF('j'):'');	
		if(!empty($couId)){
			$table = M('common_voucher');
			$detail=$table->getOne('vouchernum','where id='.$couId);	
		}else{
			$table = M('common_voucher_add');
			$detail=$table->getOne('voucher','where id='.$sumid);
		}	 
		include  CURR_VIEW_PATH . "Coupon/coupon_grant.php";	
//		$category = $this->cache->GetHCache('appcategory',$this->wxid);//读出缓存
//		var_dump($couponAry);
	}
	/*
	 * 搜索网校信息
	 */
	public function searchAction(){
		$ary=$_POST;
		$wxtable = M('common_user_website');
		$wxtable2 = M('common_domain');
		if($ary['keytype']==1){
			$values  =  $wxtable->getAll('where sitename like "%'.$ary['key'].'%"','wxid,sitename'); 
		}elseif($ary['keytype']==2){
			$values  =  $wxtable->getAll('where wxid='.$ary['key'],'wxid,sitename'); 
		}elseif($ary['keytype']==3){
			$where="as a left join `$wxtable2->table` as b on a.wxid = b.wxid where b.domain like '%".$ary['key']."%'";
			$values  =  $wxtable->getAll($where,'a.wxid,a.sitename'); 
		}
		header('Content-Type:application/json;charset=utf-8');
		echo json_encode($values);
	}
	/*
	 * 发放优惠券
	 */
	public function grantAction(){
		$wxid=ChkSQL(KS_G('request.user'));
		$scope=ChkClng(KS_G('request.scope'));
		$coupon =  ChkClng(null !==GF('j') ? GF('j'):'');//具体的优惠券id
        $addid=ChkClng(null !==GF('coupon') ? GF('coupon'):'');//优惠券大类的id
        $type=ChkClng(null !==GF('type') ? GF('type'):'');//进口位置
        $notify=ChkSQL(KS_G('post.messagetype'));//通知方式
        $first=M('common_voucher_add');
        $sectable = M('common_voucher');
        $usertable = M('common_user');
        $wxtable=M('common_user_website');
        $detailvou=$first->getRow('where id='.$addid,'grantnum,buildnum');
        $Data['grantstatus'] = 1;
	    $Data['addtime'] = time();
	    if($scope==1){
	    	
	    	$wxidsum=$wxtable->getAll('','wxid');
		    foreach($wxidsum as $k=>$v){
				$wxid[$k]=$v['wxid'];
			}
	    }
        if($type==1){
        	if(count($wxid)>1){
        		$url = M_URL('Coupon','showgrant','',GP('type-'.$type.',maxid-'.$addid.',j-'.$coupon));
        		KS_INFO("只能选择一个人",0,$url);	
        	}else{
				$Data['wxid'] = $wxid[0];
				$res=$sectable->update($Data,'id='.$coupon);
				$this->cache->PutHCache('voucher',$wxid[0]);//代金卷更新缓存
				$count['grantnum'] = intval($detailvou['grantnum'])+1;
				$res=$first ->update($count,'id = '.$addid);//更新优惠券发放数量	
				$userinfo = $wxtable->getRow("as a left join `$usertable->table` as b on a.userid = b.userid where a.wxid=".$wxid[0],'a.userid,b.email,b.mobile');
				//发送通知
       	   	    $data['type'] = 4;
       	   	    $data['modelname'] ='Sendvoucher';
       	   	    $data['memberid']  = $userinfo['userid'];
              	$IndexModel   =   M('Application/IndexModel');
              	$IndexModel   -> SendEx($notify,$data);
                $count['grantnum'] = intval($detailvou['grantnum'])+1;
		        $res=$first ->update($count,'id = '.$addid);//更新优惠券发放数量	
				$url = M_URL('Coupon','showgrant','',GP('type-'.$type.',maxid-'.$addid.',j-'.$coupon));	
				KS_INFO("发送成功",0,$url);	
		        }			  
        }
        if($type==2){
        	$couponAry=$sectable->getAll('where grantstatus=0','id');
        	if(count($couponAry)<count($wxid)){	
        		$url = M_URL('Coupon','showgrant','',GP('type-'.$type.',maxid-'.$addid.',j-'.$coupon));
		        KS_INFO("优惠券数量不够",0,$url);	
        	}else{
        		
        		foreach($wxid as $key =>$val){
        		    $Data['wxid'] = $val;
					$res=$sectable->update($Data,'id='.intval($couponAry[$key]['id']));
					$this->cache->PutHCache('voucher',$val);//代金卷更新缓存
					$userinfo = $wxtable->getRow("as a left join `$usertable->table` as b on a.userid = b.userid where a.wxid=".$val,'a.userid,b.email,b.mobile');
					//发送通知
			         $data['type'] = 4;
	       	   	    $data['modelname'] ='Sendvoucher';
	       	   	    $data['memberid']  = $userinfo['userid'];
	              	$IndexModel   =   M('Application/IndexModel');
	              	$IndexModel   -> SendEx($notify,$data);
        		}
        	
        		$count['grantnum'] = intval($detailvou['grantnum'])+count($wxid);
				$res=$first ->update($count,'id = '.$addid);//更新优惠券发放数量		
				$url = M_URL('Coupon','showgrant','',GP('type-'.$type.',maxid-'.$addid.',j-'.$coupon));
				KS_INFO("发送成功",0,$url);	
        	}
        }
	}
	/**
	 * 批量发送优惠券
	 */
//	public function grantsomeAction(){
//		$idAry  =  ChkSQL(KS_G('post.id'));
//		$wxid=ChkSQL(KS_G('request.id'));
//		$coupon =  ChkClng(null !==GF('j') ? GF('j'):'');//优惠券id
//      $addid=ChkClng(null !==GF('coupon') ? GF('coupon'):'');
//      $table=M('common_voucher_add');
//      $detailvou=$table->getOne('grantnum','where id='.$addid);
//		$Data['wxid'] = $wxid;
//		$Data['grantstatus'] = 1;
//		$Data['addtime']=time();
//		$sectable = M('common_voucher');
//		$res=$sectable->update($Data,'id='.$coupon);
//		$this->cache->PutHCache('voucher',$wxid);//代金卷更新缓存
//		$count['grantnum'] = intval($detailvou['grantnum'])+1;
//		$res=$table ->update($count,'id = '.$addid);//更新优惠券发放数量	
//		exit;
//		$url = M_URL('Coupon','showDetail','',GP(''));		
//		KS_INFO("发送成功",0,$url);	
//	}
	/**
	 * 显示对应优惠券的使用情况
	 */
	public function showDetailAction(){
		$couId=ChkClng(GF('id') );
		$keyword=KS_S('keyword');
		$status=ChkClng(GF('status') ? GF('status'):3); 
		$now_page=ChkClng(GF('p') ? GF('p'):'1'); 
		$byname = ChkSQL(GF('byname') ? GF('byname'):'desc');
		if($status==3){ $where.= ' where (a.status=1 or a.status=0) and a.vouid='.$couId;}
	 	if($status==1){ $where.= ' where (a.status=1) and a.vouid='.$couId;}
	 	if($status==2){ $where.= ' where (a.status=0) and a.vouid='.$couId;}
	 	if($status==4){ $where.= ' where (a.grantstatus=0) and a.vouid='.$couId;}
	 	if($status==5){ $where.= ' where (a.grantstatus=1) and a.vouid='.$couId;}
	 	$wxModel = M('common_user_website');
		$where      = "as a left join `$wxModel->table` as b on a.wxid = b.wxid ".$where;
         if(!empty($keyword)){
         	$where      = $where.' and vouchernum like "%'.$keyword.'%"';
         }
		$table = M('common_voucher_add');
		$detail = $table->getOne('voucher','where id='.$couId);
		$table2 = M('common_voucher');
		$singlepage=6;
        $options =  $table2->getOptions($singlepage,$where);//分页参数设置
	    $page    =  Page($options);
	    $values  =  $table2->getPage($page,'addtime '.$byname,$where,'a.id,b.sitename,a.money,a.balance,a.type,a.addtime,a.status,a.vouchernum,a.grantstatus');   
		include  CURR_VIEW_PATH . "Coupon/coupon_detail.php";
	}
}


?>