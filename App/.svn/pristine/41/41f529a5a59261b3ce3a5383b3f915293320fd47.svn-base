<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015-5-5
 * Time: 16:49
 */

use Kesion\Controller;
class WechatController extends  CommonController
{
    //获取用户id
    public function getuserinfoAction(){
        $weObj = $this->getWeObjAction();
        $json = $weObj->getOauthAccessToken();
        $user_info = $weObj->getOauthUserinfo($json['access_token'],$json['openid']);
        if(empty($user_info)){
            return null;
        }
        $user_mod = M('wechat_user');
        $is_exist = $user_mod->where(array('openid'=>$user_info['openid']))->find();
        if(!$is_exist){
            $user_info['create_time'] = now();
            $user_mod->add($user_info);
        }
        $this->assign('user_info',$user_info);
        return $user_info['openid'];
    }
    //获取微信操作对象
    private function getWeObjAction(){
        $info = M('wechat')->where(array('status'=>'1'))->find();
        $options = array(
            'token'=>$info['token'],//填写你设定的key
            'appid'=>$info['appid'], //填写高级调用功能的app id
            'appsecret'=>$info['appsecret'] //填写高级调用功能的密钥
        );

        $weObj = new qywechat($options);
        return $weObj;
    }

    public function infoAction(){
        if(IS_POST){
            $appid = I('appid');
            if(empty($appid)){
                echojson('appid不能为空');
            }
            $token = I('token');
            if(empty($token)){
                echojson('token不能为空');
            }
            M('wechat')->where(array('status'=>1))->save(array('status'=>'0'));
            M('wechat')->create();
            M('wechat')->add();
            echojson('添加成功');
        }else{
            $info = M('wechat')->where(array('status'=>1))->find();
            $this->assign('info',$info);
            $this->display();
        }
    }

    //回复文本设置
    public function answerAction(){
        if(IS_POST){
            $ans_mod = M('wechat_reply');
            $ans_mod->create();
			if(I('post.id')){
				$ans_mod->save();
				echojson('修改成功',U('Wechat/answerlist'));
			}else{
				$ans_mod->add();
				echojson('添加成功',U('Wechat/answerlist'));
			}
        }else{
			if(I('get.id')){
				$info = M('wechat_reply')->where(array('id' => I('get.id')))->find();
			}else{
				$info['type'] = 1;
			}
			$this->assign('info',$info);
            $this->display();
        }
    }
    //回复文本列表
    public function answerlistAction(){
        $ans_mod = M('wechat_reply');
        $count = $ans_mod->count();
        $p = new \Org\Util\Page($count,C('PAGE_SIZE'));
        $list = $ans_mod->limit($p->firstRow.','.$p->listRows)->select();
        $this->assign('list',$list);
        $this->assign('page',$p->show());
        $this->display();
    }
    //自动回复设置
    public function autoAction(){
        if(IS_POST){
            $ans_mod = M('wechat_auto');
            $ans_mod->create();
            $ans_mod->add();

            echojson('添加成功',U('Wechat/autolist'));
        }else{
            $ans_mod = M('wechat_reply');
            $ans_list = $ans_mod->select();
            $this->assign('ans_list',$ans_list);
            $this->display();
        }
    }
    //自动回复设置
    public function autolistAction(){
        $ans_mod = M('wechat_auto');
        $prex = C('DB_PREFIX');
        $count = $ans_mod->count();
        $p = new \Org\Util\Page($count,C('PAGE_SIZE'));
        $list = $ans_mod->field($prex.'wechat_auto.*,'.$prex.'wechat_reply.name as auto_content')->join('LEFT JOIN '.$prex.'wechat_reply ON '.$prex.'wechat_reply.id = '.$prex.'wechat_auto.reply_id ')->limit($p->firstRow.','.$p->listRows)->select();
        $this->assign('list',$list);
        $this->assign('page',$p->show());
        $this->display();
    }

    //菜单管理
    public function menuAction(){
        if(IS_POST){
            $menu_mod = M('wechat_menus');
            $menu_mod->create();
            $menu_mod->add();
            echojson('操作成功');
        }else{
            $parents = M('wechat_menus')->where(array('parent_id'=>0))->select();
            $this->assign('tops',$parents);
            $this->display();
        }
    }


    //更新菜单
    public function menusupdateAction(){
        $menu_mod = M('wechat_menus');
        $parents = $menu_mod->where(array('parent_id'=>0))->order('id asc')->limit(3)->select();
        $ms = array();
        foreach($parents as $item){
            $data = self::createbutton($item);
            $child = $menu_mod->where(array('parent_id'=>$item['id']))->order('id asc')->limit(5)->select();
            if(!empty($child)){
                unset($data['url']);
                unset($data['type']);
                unset($data['key']);
                $data['sub_button'] = array();
                foreach($child as $val){
                    $data['sub_button'][] = self::createbutton($val);
                }
            }
            $ms[] = $data;
        }
//        KSLog('tongshuai---'.json_encode($ms));
        $info = M('wechat')->where(array('status'=>'1'))->find();
        $options = array(
            'token'=>$info['token'],//填写你设定的key
            'appid'=>$info['appid'], //填写高级调用功能的app id
            'appsecret'=>$info['appsecret'] //填写高级调用功能的密钥
        );

        $weObj = new qywechat($options);
        $newmenu =  array("button"=>$ms);
        $weObj->checkAuth();
        $result = $weObj->createMenu($newmenu);
        $menus=$weObj->getMenu();
        if($result){
            echojson('操作成功~~');
        }else{
            echojson('操作失败test:'.$weObj->errMsg);
        }
    }

    //添加按钮，构造菜单数组
    private function createbuttonAction($item){
        if($item['type'] == 'click'){
            $data = array('type'=>'click','name'=>$item['name'],'key'=>$item['key']);
        }else if($item['type'] == 'view'){
            $item['url'] = str_replace('&amp;','&',$item['url']);
            $data = array('type'=>'view','name'=>$item['name'],'url'=>$item['url']);
        }
        return $data;
    }

    //菜单列表
    public function menulistAction(){
        $menu_mod = M('wechat_menus');
        $list = $menu_mod->where(array('parent_id'=>0))->select();
        for($i=0;$i<count($list);$i++){
            $list[$i]['child'] = $menu_mod->where(array('parent_id'=>$list[$i]['id']))->select();
        }
        $this->assign('list',$list);
        $this->display();
    }
    //编辑菜单
    public function menueditAction(){
        if(IS_POST){
            $menu_mod = M('wechat_menus');
            $menu_mod->create();
            $menu_mod->save();
            echojson('操作成功',U('Wechat/menulist'));
        }else{
            $id = I('id');
            $menu = M('wechat_menus')->find($id);
            $this->assign('menu',$menu);
            $parents = M('wechat_menus')->where(array('parent_id'=>0))->select();
            $this->assign('tops',$parents);
            $this->display();
        }

    }
    //删除菜单
    public function menudeleteAction(){
        if((!isset($_GET['id']) || empty($_GET['id'])) && (!isset($_POST['id']) || empty($_POST['id']))) {
            echojson('请选择要删除的菜单！');
        }
        $menus_mod = D('wechat_menus');
        if (isset($_POST['id']) && is_array($_POST['id'])) {
            $ids = implode(',', $_POST['id']);
            $menus_mod->delete($ids);
        } else {
            $id = intval($_GET['id']);
            $menus_mod->delete($id);
        }
        echojson('操作成功',U('Wechat/menulist'));
    }

    //生成推广二维码
    public function getqrcodeAction(){
        if(IS_POST){
            $name = I('name');
            $weObj = $this->getWeObj();
            $code_mod = M('wechat_qrcode');
            $info = $code_mod->where(array('user'=>$name))->find();
            if(empty($info)){
                $id = $code_mod->add(array('user'=>$name));
                $ticket = $weObj->getQRCode($id,2);
//                var_dump($weObj->errMsg);
//                var_dump($weObj->errCode);
//                var_dump($ticket);
                $img = $weObj->getQRUrl($ticket['ticket']);
//                var_dump($weObj->errMsg);
//                var_dump($weObj->errCode);exit;
//                var_dump($img);exit;
//                $this->assign('wechatimg',$img);
                $basepath = $_SERVER['DOCUMENT_ROOT'].__ROOT__;
                $file_name = time().'.jpg';
                $path = $basepath.'/Public/qrcode/'.$file_name;
                downloadImgFromWechat($img,$path);
                $code_mod->where(array('user'=>$name))->save(array('qrcode'=>$path,'ticket'=>$ticket['ticket'],'url'=>'Public/qrcode/'.$file_name));

                $path = __ROOT__.'/Public/qrcode/'.$file_name;
            }else{
                $path = __ROOT__.'/'.$info['url'];
            }
            $this->assign('name',$name);
            $this->assign('img',$path);
        }

        $count = M('wechat_qrcode')->count();
        $Page       = new \Think\Page((int)$count,C('PAGE_SIZE'));
        $qrcodes = M('wechat_qrcode')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('qrcodes',$qrcodes);
	$this->assign('page',$Page->show());
        $this->display();
    }

    public function qrcodedeleteAction(){
        if((!isset($_GET['id']) || empty($_GET['id'])) && (!isset($_POST['id']) || empty($_POST['id']))) {
            echojson('请选择要删除的菜单！');
        }
        $qrcode_mod = D('wechat_qrcode');
        if (isset($_POST['id']) && is_array($_POST['id'])) {
            $ids = implode(',', $_POST['id']);
            $qrcode_mod->delete($ids);
        } else {
            $id = intval($_GET['id']);
            $qrcode_mod->delete($id);
        }
        echojson('操作成功',U('Wechat/getqrcode'));
    }

    public function autodeleteAction(){
        if((!isset($_GET['id']) || empty($_GET['id'])) && (!isset($_POST['id']) || empty($_POST['id']))) {
            echojson('请选择要删除的菜单！');
        }
        $qrcode_mod = D('wechat_auto');
        if (isset($_POST['id']) && is_array($_POST['id'])) {
            $ids = implode(',', $_POST['id']);
            $qrcode_mod->delete($ids);
        } else {
            $id = intval($_GET['id']);
            $qrcode_mod->delete($id);
        }
        echojson('操作成功',U('Wechat/autolist'));
    }

    public function answerdeleteAction(){
        if((!isset($_GET['id']) || empty($_GET['id'])) && (!isset($_POST['id']) || empty($_POST['id']))) {
            echojson('请选择要删除的菜单！');
        }
        $qrcode_mod = D('wechat_reply');
        if (isset($_POST['id']) && is_array($_POST['id'])) {
            $ids = implode(',', $_POST['id']);
            $qrcode_mod->delete($ids);
        } else {
            $id = intval($_GET['id']);
            $qrcode_mod->delete($id);
        }
        echojson('操作成功',U('Wechat/answerlist'));
    }

//    public function eventreply(){
//        $this->display();
//    }

    public function menusAddAction(){
//        if(IS_POST){
//            $parent_id = I('parent_id',0);
//            $data = I();
//            M('wechatmenus')->add($data);
//
//        }else{
//            $parents = M('wechatmenus')->where(array('parent_id'=>0))->select();
//            $this->assign('topmenus',$parents);
//            $this->display();
//        }
    }
    public function setAutoReplyAction(){
        $type = $_POST['type'];
        $id = $_POST['id'];
        if($type == "set"){
            M('wechat_auto')->where("auto_reply=1")->save(array('auto_reply'=>0));
            M('wechat_auto')->where("id=".$id)->save(array('auto_reply'=>1));
        }else{
            M('wechat_auto')->where("auto_reply=1")->save(array('auto_reply'=>0));
        }
        echo json_encode(array('msg'=>true));
    }

}
