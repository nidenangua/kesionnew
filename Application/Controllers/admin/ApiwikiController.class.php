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
class ApiwikiController extends CommonController
{
    //首页
    public function indexAction()
    {
        $keytype=ChkClng(GF('keytype') ? GF('keytype'):'1');
        $keyword=ChkSQL(GF('keyword') ? GF('keyword'):'');
        $type=ChkClng(GF('type') ? GF('type'):0);
        $now_page=ChkClng(GF('p') ? GF('p'):'1'); 
        // if($type!=0){ $where= ' where a.parentid='.$type;}else{$where = '';}
        $where=' where 1=1 and b.id!=2';
        if(!empty($keyword)){
           if($keytype==1){
                $where="$where and a.name like '%$keyword%'";
            }else if($keytype==2){
                $where="$where and b.name like '%$keyword%'";
            }
        }
        $db_interface =M('web_interface');          
        $db_classify =M('web_interface_classify');          
        $where = "as a left join `$db_classify->table` as b on a.parentid = b.id $where";
        $options = $db_interface->getOptions('10',$where);//分页参数设置
        $page = Page($options);
        $values = $db_interface->getPage($page,'id desc',$where,'a.*,b.name as classifyname');
        include  CURR_VIEW_PATH . "Apiwiki/index.php";
    }
    public function editwikiAction(){
        $now_page=ChkClng(GF('p') ? GF('p'):'1'); 
        $id = KS_G('get.id');
        $Db = M('web_api_wiki');
        $info = $Db->getOne('content','where apiid='.$id);
        if(!$info){
            $info = '';
        }
        include  CURR_VIEW_PATH . "Apiwiki/wiki.php";
        
    }
    public function doeditwikiAction(){
        $id = KS_G('get.id');
        $Db = M('web_api_wiki');
        $info = $Db->getOne('content','where apiid='.$id);
        $data['content'] = KS_G('post.detailintro');
        if($id>0){
             $data['title'] =M('web_interface')->getOne('name','where id='.$id);
        }else {
           if($id==-1){
                $data['title'] = '首页';
           }
           if($id==-2){
                $data['title'] = '开发者规范';
           }
           if($id==-3){
                $data['title'] = '更新日志';
           }
        }
        $now_page=ChkClng(GF('p') ? GF('p'):'1'); 
        if(!$info){
           $data['apiid'] = $id;
           $Db->doAdd($data,'id');
        }else{
            $Db->update($data,'apiid='.$id);
        }
        $url =  M_URL('home/Apiwiki','index','',GP('p-'.$now_page));
        KS_INFO('修改完成',3,$url);
    }
    
}