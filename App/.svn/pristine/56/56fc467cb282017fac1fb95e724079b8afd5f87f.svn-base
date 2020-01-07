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
     * 答疑列表
     */
    public function indexAction(){
        $Model = M('app_social');
        $status =  ChkClng(KS_S('status','2'));
        $show =  ChkClng(KS_S('show','2'));
        $reply =  ChkClng(KS_S('reply','2'));
        $open =  ChkClng(KS_S('open','2'));

        $where= 'where type = 2 and wxid='.$this->wxid;

        //搜索
        $keyword = ChkSQL(KS_S('keyword'));
        $keytype = ChkClng(KS_S('keytype',1));
        //判断是否输入关键字
        if(!empty($keyword)){
            if($keytype==1){$where.=" and title like '%$keyword%'";}
        }

        if($status == 0){$where .= ' and status = 0';}
        elseif($status == 1){$where .= ' and status = 1';}
        else{$where .= ' and status != -1';}

        if($show == 0){$where .= ' and is_show = 0';}
        elseif($show == 1){$where .= ' and is_show = 1';}
        else{$where .= ' and is_show != -1';}

        if($reply == 0){$where .= ' and is_reply = 0';}
        elseif($reply == 1){$where .= ' and is_reply = 1';}
        else{$where .= ' and is_reply != -1';}

        if($open == 0){$where .= ' and is_open = 0';}
        elseif($open == 1){$where .= ' and is_open = 1';}
        else{$where .= ' and is_open != -1';}

        $options = $Model->getOptions('10',$where);//分页参数设置
        $page = Page($options);
        $values = $Model->getPage($page,'id desc',$where);
        foreach ($values as &$item){
            $item['inputer'] = User_GetUser($item['userid'])['name'];
            $json = json_decode($item['json'],true);
            $item['so_type'] = $json['type'];
        }
        include  CURR_VIEW_PATH . "index.php";
    }
    /*
     *更新审核状态
     */
    public function updatestatusAction(){
        $id = ChkClng(KS_G("get.id"));
        if(empty($id)){KS_INFO('请选择',0,'','',1);}
        $this->AppModel = M('app_social');
        $status = $this->AppModel->getOne('status','where id ='.$id.' and wxid='.$this->wxid);
        if($status==1){
            $Data['status']=0;
        }elseif($status==0){
            $Data['status']=1;
        }
        $this->AppModel->update($Data,'id ='.$id);
        echo $Data['status'];
    }
    /*
     *更新是否显示
     */
    public function updateshowAction(){
        $id = ChkClng(KS_G("get.id"));
        if(empty($id)){KS_INFO('请选择',0,'','',1);}
        $this->AppModel = M('app_social');
        $is_show = $this->AppModel->getOne('is_show','where id ='.$id.' and wxid='.$this->wxid);
        if($is_show==1){
            $Data['is_show']=0;
        }elseif($is_show==0){
            $Data['is_show']=1;
        }
        $this->AppModel->update($Data,'id ='.$id);
        echo $Data['is_show'];
    }
    /**
     * 删除
     */
    public function deleteAction(){
        $id       =  ChkClng(KS_G('request.id'));
        $now_page =  ChkClng(KS_S('p',1));
        $this->AppModel = M('app_social');
        $data['status'] = -1;
        $this->AppModel->update($data,"id = $id and wxid=$this->wxid");
        $social_reply = M('app_social_reply');
        $social_reply->delete('socialid = '.$id.'');
        $url      =  M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
        ks_header($url);
    }
    //批量删除
    public function batchAction(){
        $id       = isset($_POST["check"])?$_POST["check"]:'';
        $batch    = ChkClng(KS_S('batch'));
        $now_page =  ChkClng(KS_S('p',1));
        if(empty($id)){KS_INFO("请选择",0,'','',1);}
        $this->AppModel = M('app_social');
        $social_reply = M('app_social_reply');
        foreach ($id as $k=>$v ){
            if ($batch==1){
                $Data['status']=-1;
                $this->AppModel->update($Data,"id=".ChkClng($v));
                $social_reply->delete('socialid = '.ChkClng($v).'');
            }else if ($batch==2){   //审核
                $Data['status']=1;
                $this->AppModel->update($Data,'id ='.ChkClng($v));
            }else if ($batch==3){  //取消审核
                $Data['status']=0;
                $this->AppModel->update($Data,'id ='.ChkClng($v));
            }
        }
        $url      =  M_URL($this->AppName.'/Index','index','',GP('p-'.$now_page));
        KS_INFO("操作成功",0,$url);
    }
}