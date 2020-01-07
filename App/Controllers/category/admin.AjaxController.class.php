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
      
	 public function getC_ChildAction(){
		 
		$now_page =  ChkClng(KS_S('p',1)); 
		 
		$Parentid = ChkClng(KS_G('post.Parentid')); 
		
	    $values = $this->AppModel->getAll("where userid=$this->userid and parentid=$Parentid ORDER BY rootid,orderid");
		
		$html = '';
		
		foreach($values as $k=>$v)
		{
			$html .= "<tr class='gradeX' attr='$v[parentidpath]' id='sub$v[categoryid]'>
							<td>$v[categoryid]</td>
							<td class='Ctd' onclick=\"getC_Child('".M_URL($this->AppName.'/Ajax','getC_Child','',GP('p-'.$now_page))."','$v[categoryid]');\">";
			if($v['child']>0)
			{		
			    $html .= KS_INDENT($v['depth'])."<a id='C$v[categoryid]' ckdata='0' at='$v[parentidpath]' attr=''><i class='close2017'></i></a>";
			}else{
				$html .= KS_INDENT($v['depth'])."<a id='C$v[categoryid]' ckdata='1' at='$v[parentidpath]' attr=''><i class='open2017'></i></a>";
			}
			$html .= "$v[categoryname]</td>
			<td>$v[categoryename]</td>
			<td>$v[intro]</td>
			<td class='center'>$v[orderid]</td>
			<td class='center'><a href='".M_URL($this->AppName.'/index','editCategory',$v['categoryid'],GP('p-'.$now_page))."'><i class='edit2017'></i></a></td>
			<td class='center'><a href='javascript:void(0);' onclick=\"Confirm('是否删除此分类？该操作不可逆！请确保该分类下无产品','".M_URL($this->AppName.'/index','delCategory',$v['categoryid'],GP('p-'.$now_page))."')\"><i class='delete2017'></i></a></td>
			</tr>";
		}
		
	    header('Content-type: application/json');
		
        echo json_encode($html);
		
     } 
}
