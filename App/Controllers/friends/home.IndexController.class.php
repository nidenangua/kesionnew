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
class IndexController extends CommonController{

    /**
     * 列表
     */
    public function indexAction(){
        $Model = M('app_social');
        $where= 'where type = 1 and wxid='.$this->wxid;
        //搜索
        $keyword = ChkSQL(KS_S('keyword'));
        $keytype = ChkClng(KS_S('keytype',1));
        //判断是否输入关键字
        if(!empty($keyword)){
            if($keytype==1){$where.=" and json like '%$keyword%'";}
        }
        $options = $Model->getOptions('10',$where);//分页参数设置
        $page = Page($options);
        $values = $Model->getPage($page,'id desc',$where);
        foreach ($values as $k=>$v){
            $values[$k]['name'] = User_GetUserName($v['userid']);
            $values[$k]['json'] = json_decode($v['json'],true);
        }
        include  CURR_VIEW_PATH . "index.php";
    }
    /**
     * 删除
     */
    public function deleteAction(){
        $id       =  ChkClng(KS_G('request.id'));
        $now_page =  ChkClng(KS_S('p',1));
        $this->AppModel->delete("id = $id and wxid=$this->wxid");
        $social_reply = M('app_social_reply');
        $zanModel = M("app_cpraise_log");//点赞表
        $social_reply->delete('socialid = '.$id.' and wxid ='.$this->wxid.'');
        $zanModel->delete("type=6 and infoid=$id");
        $url      =  M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
        ks_header($url);
    }
    //批量删除
    public function batchAction(){
        $id  = isset($_POST["check"])?$_POST["check"]:'';
        $now_page =  ChkClng(KS_S('p',1));
        if(empty($id)){KS_INFO("请选择",0,'','',1);}
        $social_reply = M('app_social_reply');
        $zanModel = M("app_cpraise_log");//点赞表
        foreach ($id as $k=>$v ){
            if (ChkClng($v)>0){
                $this->AppModel->delete("id=".$v);
                $social_reply->delete('socialid = '.$v.'');
                $zanModel->delete("type=6 and infoid=$v");
            }
        }
        $url      =  M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
        KS_INFO("操作成功",0,$url);
    }
}