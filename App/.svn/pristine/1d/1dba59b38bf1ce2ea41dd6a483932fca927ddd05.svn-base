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


namespace Kesion\Model\App;
use Kesion\Model;
class TeamModel extends Model
{
    public $error;
    public static $chargetype = [0 =>'免费',1 =>'收费',2 => '申请填写'];//入群条件
    public function __construct($userinfo='')
    {
        if ($userinfo==''){
            $this->wxid = $GLOBALS['_DoM']['wxid'];
        }else{
            $this->wxid = $userinfo['wxid'];
        }
    }

    /**
     * 通过小组ID，与用户ID添加组成员
     * @param $teamid int 小组ID
     * @param $userid int 用户ID
     */
	public function addMember($team_id,$userid,$mobile='')
    {
        $db_member = M('app_team_member');
        $member = $db_member->getOne('userid',"where userid=$userid and status not in (-1,0) and team_id=$team_id and wxid=".$this->wxid);
        if ($member){
            $this->error = '用户已存在';
            return false;
        }
        $data = [
            'team_id' => $team_id,
            'userid' => $userid,
            'mobile' => $mobile,
            'create_time' => time(),
            'wxid' => $this->wxid,
            'realname' => User_GetUserName($userid)
        ];
        $id = $db_member->doAdd($data,'id');
        if ($id){
            $this->updateMemberNum($team_id);//更新组员数
            return $id;
        }else{
            return false;
        }
	}
    /**
     * 添加话题
     */
    public function addTopic($data)
    {
        $db_member = M('app_team_topic');
        if (empty($data['team_id'])||empty($data['userid'])){
            $this->error = '参数错误';
            return false;
        }
        $data['wxid'] = $this->wxid;
        $data['create_time'] = time();
        $id = $db_member->doAdd($data,'id');
        if ($id){
            $this->updateTopicNum($data['team_id']);//更新动态数
            $this->updateMemberTopicNum($data['team_id'],$data['userid']);
            return $id;
        }else{
            return false;
        }
    }
    /**
     * 添加回复
     */
    public function addChat($data)
    {
        if (empty($data['team_id'])||empty($data['userid'])||empty($data['topic_id'])){
            $this->error = '参数错误';
            return false;
        }
//        $member = M('app_team_member');
//        $id = $member->getOne('id','where team_id='.$data['team_id'].' and userid='.$data['userid'].' and status=1');
//        if (empty($id)){
//            $this->error = '你未加入社群或被禁言';
//            return false;
//        }
        $db_member = M('app_team_chat');
        $data['wxid'] = $this->wxid;
        $data['create_time'] = time();
        $id = $db_member->doAdd($data,'id');
        if ($id){
            $this->updateChatNum($data['topic_id']);//更新回复数量
            return $id;
        }else{
            $this->error = '回复失败';
            return false;
        }
    }
    /**
     * 删除
     * @param $id
     * @param $type 1社群 2动态 3成员 4评论
     */
	public function del($id,$type)
    {
        if (empty($id)||empty($type)){
            $this->error = '参数错误';
            return false;
        }
        $Data['status'] = -1;
        if ($type==1){
            $res = M('app_team')->delete("id=$id and wxid=".$this->wxid);
            if ($res){
                $cache = new \Core\Cache();
                $cache->PutHCache('team',$this->wxid);//缓存
                M('app_team_member')->delete("team_id=$id and wxid=".$this->wxid);
                M('app_team_topic')->delete("team_id=$id and wxid=".$this->wxid);
                M('app_team_chat')->delete("team_id=$id and wxid=".$this->wxid);
                M('app_team_link')->delete("team_id=$id and wxid=".$this->wxid);
            }
        }elseif ($type==2){
            $topic = M('app_team_topic')->getRow("where id=$id and wxid=".$this->wxid,'team_id,userid');
            $res =  M('app_team_topic')->update($Data,"id=$id and wxid=".$this->wxid);
            if ($res){
                M('app_team_chat')->update($Data,"topic_id=$id and wxid=".$this->wxid);
                $this->updateTopicNum($topic['team_id']);
                $this->updateMemberTopicNum($topic['team_id'],$topic['userid']);
            }
        }elseif ($type==3){
            $team_id = M('app_team_member')->getOne('team_id',"where id=$id and wxid=".$this->wxid);
            $res =  M('app_team_member')->delete("id=$id and wxid=".$this->wxid);
            if ($res){
                $this->updateMemberNum($team_id);
            }
        }elseif ($type==4){
            $topic_id = M('app_team_chat')->getOne('topic_id',"where id=$id and wxid=".$this->wxid);
            $res =  M('app_team_chat')->update($Data,"id=$id and wxid=".$this->wxid);
            if ($res){
                $this->updateChatNum($topic_id);
            }
        }
        if (!empty($res)){
            return true;
        }else{
            return false;
        }
    }

    /**更新组员话题数量
     * @param $team_id
     * @param $userid
     */
    public function updateMemberTopicNum($team_id,$userid)
    {
        $count = M('app_team_topic')->getOne('count(id)',"where team_id=$team_id and status in (1,2)".' and wxid='.$this->wxid.' and userid='.$userid);
        $data['topics_num'] = $count;
        if (isset($count)){
            M('app_team_member')->update($data,"userid=$userid and team_id=$team_id and status in (1,2)");
        }
    }
    /**
     * 更新组员数量
     * @param $team_id
     */
	public function updateMemberNum($team_id)
    {
        $count = M('app_team_member')->getOne('count(id)',"where team_id=$team_id and status in (1,2)".' and wxid='.$this->wxid);
        $data['member_num'] = $count;
        if (isset($count)){
            M('app_team')->update($data,"id=$team_id");
        }
    }
    /**
     * 更新动态数量
     * @param $team_id
     */
    public function updateTopicNum($team_id)
    {
        $count = M('app_team_topic')->getOne('count(id)',"where team_id=$team_id and status in (1,2)".' and wxid='.$this->wxid);
        $data['topic_num'] = $count;
        if (isset($count)){
            M('app_team')->update($data,"id=$team_id");
        }
    }
    /**
     * 更新回复数
     * @param $topic_id
     */
    public function updateChatNum($topic_id)
    {
        $count = M('app_team_chat')->getOne('count(id)',"where topic_id=$topic_id and status in (1,2)".' and wxid='.$this->wxid);
        $data['chat_num'] = $count;
        if (isset($count)){
            M('app_team_topic')->update($data,"id=$topic_id");
        }
    }
    /**
     * 点赞
     * @param $id int 动态ID or 回复ID
     * @param $userid
     * @param $type int  5 动态 6回复
     */
    public function like($id,$userid,$type)
    {
        if (empty($id)||empty($userid)||empty($type)){
            $this->error = '参数错误';
            return false;
        }
        if ($type==5){
            $zanDb = 'app_team_topic';
        }elseif ($type==6){
            $zanDb = 'app_team_chat';
        }else{
            $this->error = '参数错误';
            return false;
        }
        $db = M('app_cpraise_log');
        $data = [
            'userid' => $userid,
            'infoid' => $id,
            'adddate' => time(),
            'type' => $type
        ];
        $like_id = $db->getOne('id','where type='.$type.' and '.'userid='.$userid.' and infoid='.$id);
        if ($like_id){
            $res = $db->delete('id='.$like_id);
            $Datas['like_num'] = 'like_num-1';
            M($zanDb)->update($Datas,'id='.$id,1);
        }else{
            $res = $db->doAdd($data,'id');
            $Datas['like_num'] = 'like_num+1';
            M($zanDb)->update($Datas,'id='.$id,1);
        }
        if ($res){
            return true;
        }else{
            return false;
        }
    }

    /**状态更新
     * @param $data
     * @return bool
     */
    public function setStatus($data)
    {
        if (empty($data['team_id'])||empty($data['type'])||empty($data['topic_id'])){
            $this->error = '参数错误';
            return false;
        }
        $model = M('app_team_topic');
        //更改类型1精选2置顶3公告4审核
        if ($data['type']==1){
            $field = 'is_hot';
        }elseif ($data['type']==2){
            $field = 'is_top';
        }elseif ($data['type']==3){
            $field = 'is_notice';
        }elseif ($data['type']==4){
            $field = 'is_check';
        }else{
            $this->error = '参数错误';
            return false;
        }
        $status =  $model->getOne($field,'where id='.$data['topic_id']);
        $Data[$field] = $status == 1?0:1;
        $res = $model->update($Data,'id='.$data['topic_id']);
        if ($res){
            return true;
        }else{
            return false;
        }
    }
}