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
      //AJax查找子分类
	  public function category_getChildAction(){ 
		$now_page =  ChkClng(KS_S('p',1)); 
		$type =  ChkClng(KS_S('type',1));
		$parentid = ChkClng(KS_G('post.parentid'));
		$category = $this->AppModel->getAll("where wxid=$this->wxid and parentid=$parentid and type=$type ORDER BY rootid,orderid");
    $html = '';
		foreach($category as $k=>$v){
		   if($v["child"]>0){
		       $html .= "<li class='firstClass clearfix' attr='$v[parentidpath]' ckdata='0' id='sub$v[categoryid]'>";
		   }else{
			   $html .= "<li class='firstClass clearfix show' attr='$v[parentidpath]' ckdata='1' id='sub$v[categoryid]'>";
		   }
		   $html .= "<div class='firstbox firstpd clearfix'><div class='fl alignLife w70b hLh40 borderR Ctd' onclick='getChild($v[categoryid])'>".KS_INDENT($v['depth'])."
					<span class='fsize14 c-333 pl20'>$v[categoryname]</span> 
					 <em class='icon12 ml10 arrow verAlignN '></em>
					 </div>
					 <div class='fl alignLife w30b hLh40'>					   
					   <div class='operate'>
							   <a href='javascript:void(0)' onClick=\"appSetUp({title:'应用设置',type:'editClass',categoryid:$v[categoryid],categoryname:'$v[categoryname]',wxid:$v[wxid]})\"><em>编辑</em><i class='iconfont'>&#xe63d;</i></a>
							   <a href='javascript:void(0)' onClick=\"appSetUp({title:'应用设置',type:'subClass',categoryid:$v[categoryid],wxid:$v[wxid]})\"><em>添加子分类</em><i class='iconfont'>&#xe67e;</i></a>
							   <a href='javascript:void(0);' onclick=\"Confirm('是否删除此分类几子分类？该操作不可逆！','".M_URL($this->AppName.'/Index','delCategory',$v["categoryid"],GP('p-'.$now_page))."')\"><em>删除</em><i class='iconfont'>&#xe638;</i></a>
						   </div>
					   
					 </div>
					</div> 
		   </li> ";
		}	 
        echo json_encode($html);
     }
}
