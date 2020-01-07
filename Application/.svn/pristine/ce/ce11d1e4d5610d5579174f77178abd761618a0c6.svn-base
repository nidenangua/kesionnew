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
class AjaxController extends CommonController
{
	public function addCartAction(){
		$appid = ChkClng(KS_G('post.appid'));
		$Controller = ChkSQL(KS_G('post.Controller'));
		$appinfo = $this->cache->GetA('appinfo','appid',$appid,'',true);
		$Data['userid'] = $this->userid;
		$Data['wxid'] = $this->wxid;
		$Data['appid'] = $appinfo['appid'];
		$Data['appname'] = $appinfo['appname'];
		$Data['defaultpic'] = $appinfo['defaultpic'];
		$Data['price'] = $appinfo['price'];
		$Data['adddate'] = time();

	    $shopModel = M('common_cart');
		$count = $shopModel->getOne('count(*)',"where wxid=$this->wxid and appid=$appid limit 1");

		if($count==0){$rusult = $shopModel->doAdd($Data,'id');}
		else{$rusult = false;}
	    header('Content-type: application/json');

		if($rusult==false){echo json_encode(-1);}else{echo json_encode(0);}
    }
	/**
	 * 服务中心，加入购物车
	 */
	public function addCart2Action(){
		$appid = ChkClng(KS_G('post.appid'));


        $shopModel = M('common_cart');
        //如果是套餐版本，先删除原有的版本
        if ($appid==KS_C("V1_APPID") || $appid==KS_C("V2_APPID") || $appid==KS_C("V3_APPID")){
            $shopModel->delete("wxid=$this->wxid and appid in(".KS_C("V1_APPID").",".KS_C("V2_APPID").",".KS_C("V3_APPID").")");
        }

        $Controller = ChkSQL(KS_G('post.Controller'));
		$appinfo = $this->cache->GetA('appinfo','appid',$appid,'',true);
		$Data['userid'] = $this->userid;
		$Data['wxid'] = $this->wxid;
		$Data['appid'] = $appinfo['appid'];
		$Data['appname'] = $appinfo['appname'];
		$Data['defaultpic'] = $appinfo['defaultpic'];
		$Data['price'] = $appinfo['price'];
		$Data['adddate'] = time();

	    $shopModel = M('common_cart');
		$count = $shopModel->getOne('count(*)',"where wxid=$this->wxid and appid=$appid limit 1");
		if($count==0){
			$shopModel->doAdd($Data,'id');
			$result['result']    = 'ok';
			$result['value']     = $shopModel->getRow("where wxid=$this->wxid and appid=$appid limit 1");
			$result['cartnum']   = $shopModel->getOne('count(*)',"where wxid=$this->wxid");
			$cartmoney = $shopModel->getOne('sum(price)',"where wxid=$this->wxid");
			$result['cartmoney'] = number_format($cartmoney,2);
            $wx_version_info = wx_version_info($this->wxid,$appid);
            if ($wx_version_info!=null){
                $result['value']['adddate'] = date('Y-m-d',strtotime("+1 year +".$wx_version_info['trans_days']." day")). "<div style='text-align:center;color:green'> (TIPS:升级后原套餐折算增加了：".$wx_version_info['trans_days']."天）</div>";
            }else{
                $result['value']['adddate'] = date('Y-m-d',Checktime($this->wxid,$appid));
            }

		}else{
			$result['result']  = 'err';
		}
	    header('Content-type: application/json');
		echo json_encode($result);
    }
	/**
	 * 服务中心，删除购物车
	 */
	public function delCartAction(){
		$appid = ChkClng(KS_G('post.appid'));
	    $shopModel = M('common_cart');
		$shopModel->delete("wxid=$this->wxid and appid=$appid");
		$count = $shopModel->getOne('count(*)',"where wxid=$this->wxid");
		$result['result']    = 'ok';
		$result['cartnum']   = $count;
		$cartmoney = $shopModel->getOne('sum(price)',"where wxid=$this->wxid");
		$result['cartmoney'] = number_format($cartmoney,2);
	    header('Content-type: application/json');
		echo json_encode($result);
    }
    public function getC_ChildAction(){
		$now_page   =  ChkClng(KS_S('p',1));
		$Parentid   = ChkClng(KS_G('post.Parentid'));
		$Controller = ChkSQL(KS_G('post.Controller'));
		switch($Controller){
			case 'AppCategory':
			   $CategoryModel = M('web_help_classify');
	           $values        = $CategoryModel->getAll("where parentid=$Parentid ORDER BY rootid,orderid");
			   break;
			case 'UsersCategory':
			   $CategoryModel = M('common_user_category');
	           $values        = $CategoryModel->getAll("where parentid=$Parentid ORDER BY rootid,orderid");
			   break;
			case 'Offweb':
			   $CategoryModel = M('web_help_classify');
	           $values        = $CategoryModel->getAll("where parentid=$Parentid ORDER BY rootid,orderid");
			break;
			case '':break;
			default:
			   echo '分类类型没写';exit;
		}
		$html = '';
		foreach($values as $k=>$v){
		   $html .= "<tr class='gradeX' attr='$v[parentidpath]' id='sub$v[categoryid]'>
					<td>$v[categoryid]</td>
					<td class='Ctd' onclick=\"getC_Child('".M_URL('Ajax','getC_Child','',GP('p-'.$now_page))."','$v[categoryid]','$Controller');\">";
		   if($v['child']>0)
		   {
			  $html .= KS_INDENT($v['depth'])."<a id='C$v[categoryid]' ckdata='0' at='$v[parentidpath]' attr=''><i class='close2017'></i></a>";
		   }else{
				$html .= KS_INDENT($v['depth'])."<a id='C$v[categoryid]' ckdata='1' at='$v[parentidpath]' attr=''><i class='open2017'></i></a>";
		   }
		   if($Controller=='Offweb'){
		    	$html .= Field($v['categoryname'])."</td>
									<td class='center'>".Field($v['rootid'])."</td>";
							if($v['status']==2){
								$html.="<td class='center'><span class='link-switch open' style='margin: 0;'  data-off='".M_URL('Offweb','changeStatus',$v['categoryid'],GP('status-0,p-'.$now_page))."' data-open='".M_URL('Offweb','changeStatus',$v['categoryid'],GP('status-2,p-'.$now_page))."'><i></i></span></td>";
							}else{
								$html.="<td class='center'><span class='link-switch' style='margin: 0;' data-off='".M_URL('Offweb','changeStatus',$v['categoryid'],GP('status-0,p-'.$now_page))."' data-open='".M_URL('Offweb','changeStatus',$v['categoryid'],GP('status-2,p-'.$now_page))."'><i></i></span></td>";
							}

							$html.="<td class='center'><a href='".M_URL('Offweb','editCategory',$v['categoryid'],GP('p-'.$now_page))."'><i class='edit2017'></i></a></td>
									<td class='center'><a href='javascript:void(0);' onclick=\"Confirm('是否删除此分类？该操作不可逆！请确保该分类下无产品','".M_URL('Offweb','deleteCategory',$v['categoryid'],GP('p-'.$now_page))."')\"><i class='delete2017'></i></a></td>
                                </tr>";
		   }else{
		   	$html .= "$v[categoryname]</td>

					<td class='center'>$v[orderid]</td>
					<td class='center'><a href='".M_URL($Controller,'editCategory',$v['categoryid'],GP('p-'.$now_page))."'><i class='edit2017'></i></a></td>
					<td class='center'><a href='javascript:void(0);' onclick=\"Confirm('是否删除此分类？该操作不可逆！请确保该分类下无产品','".M_URL($Controller,'deleteCategory',$v['categoryid'],GP('p-'.$now_page))."')\"><i class='delete2017'></i></a></td>
				</tr>";
		   }

		}
	    header('Content-type: application/json');
        echo json_encode($html);
    }
    //引导页开关
	public function guideAjaxAction(){
		$websiteinfo         = $this->cache->GetHCache('website',$this->wxid);//读出缓存
		$wxsetting           = explode('|',$websiteinfo['setting']);
		$wxsetting[8]        = 1;
		$Data['setting']     = implode('|',$wxsetting);
		$websiteModel          = M('common_user_website');
	    $websiteModel->update($Data,'wxid='.$this->wxid);
		$this->cache->PutHCache('website',$this->wxid);//写入缓存
    }
    //每日资讯
	public function webnewsAction(){
	 	$Data002['nowday']   = ChkClng(KS_G('post.nowday'));
	 	$ArticleModel        = M('App/ArticleModel');
		$result              = $ArticleModel->webnews($Data002);
		header('Content-type: application/json');
        echo json_encode($result);
    }

}
