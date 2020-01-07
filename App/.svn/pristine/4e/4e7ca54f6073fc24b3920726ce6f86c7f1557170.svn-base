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
use Core\Cache;
use Core\Polyv;
use Kesion\Model;
class LiveModel extends Model
{
    public $errCode = 0;
    public $errMsg = '失败';
    public $cache;
    public $service_name;//服务商名字
    public $service_model;//服务商类

	public function __construct()
    {
        parent::__construct();
        $this->wxid = $GLOBALS['_DoM']['wxid'];
        $this->cache = new \Core\Cache();
        $videoservice = $this->cache->GetACache('videoservice');
        $service = [];//默认直播服务商
        foreach ($videoservice as $k=>$v){
            if ($v['type']==2&&$v['isdefault']==1){
                $service = $v;break;
            }
        }
        $this->service_name = $service['id']==9?'polyv':'cc';
        if ($this->service_name=='polyv'){
            $this->service_model = new Polyv();
        }
    }
    
    /**结算
     * @param $courseid int 课程id
     * @param int $chapterid
     * @param int $wxid
     * @param int $clicktime
     * @return bool
     */
    public function lianMaiSettlement($courseid,$chapterid=0,$wxid=0,$clicktime=0)
    {
        if (empty($courseid)) return false;
        if (!empty($wxid)) $this->wxid = $wxid;
        $redis = new \Redis() or die("Cannot load Redis module.");//启动redis 进行缓存
        $redis->connect(REDIS_SERVER,REDIS_PORT);
        $redis->auth(REDIS_PWD);//redis改为你的redis密码
        $model_course = M('app_course');
        $livetype = $model_course->getOne('livetype',"where courseid=$courseid and wxid=$this->wxid");
        if ($livetype==1||$livetype==2){
            $price = 0.02;
        }elseif ($livetype==3){
            $price = M('common_managevdo')->getOne('price',"where type=2 and isdefault=1");
            M('app_course_channel')->update(['status'=>0],"courseid=$courseid and wxid=$this->wxid");//更改房间状态
        }
        $list = $redis->lrange("live_student:$courseid:$chapterid",0,-1);
        $all_time = 0;//在线学生总时长
        foreach ($list as $k=>$v){
            $detail = json_decode($v,true);
            if ($detail['is_leave']==1&&!empty($detail['enddate'])){
                $all_time += $detail['enddate']-$detail['begindate'];
            }else{
                if ($livetype==3){
                    if (!empty($detail['clicktime'])){
                        $detail['enddate'] = $detail['clicktime'];
                    }else{
                        if (($detail['begindate']+300)>time()){
                            $detail['enddate'] = time();
                        }else{
                            $detail['enddate'] = time()+300;
                        }
                    }
                }else{
                    if (!empty($clicktime)){
                        $detail['enddate'] = $clicktime;
                    }else{
                        $detail['enddate'] = time();
                    }
                }
                $detail['is_leave'] = 1;//离开
                $all_time += $detail['enddate']-$detail['begindate'];
            }
            $detail['is_close'] = 1;//结算
            $redis->lset("live_student:$courseid:$chapterid",$k,json_encode($v));
            $list[$k] = $detail;
        }
        $time = ceil($all_time/60);//转分钟
        if ($time>0){
            $all_price = $time*$price;
            $Data['money'] = getLimitService(6,0,$this->wxid)-$all_price;
            $domainbillingModel=M('common_domain_billing');
            $domainbillingModel->update($Data,' wxid='.$this->wxid.' and type =6 ');
            $this->cache->PutHCache('domainbilling',$this->wxid);
        }
        $model_log = M('common_live_log');
        $data_log = [
            'json' => json_encode($list),
            'cost' => $all_price?$all_price:0,
            'time' => $all_time,
            'balance' => getLimitService(6,0,$this->wxid),
            'status' => 2,
            'endtime' => time(),
            'settlement' => time(),
        ];
        $model_log->update($data_log,"infoid=$courseid and scheduleid=$chapterid and status=0 and wxid=$this->wxid");
        $redis->del("live_student:$courseid:$chapterid");
        $redis->del("live_studentid:$courseid:$chapterid");
        $redis->set("live_status:$courseid:$chapterid",0);
        return $Data['money'];
    }

    /**创建直播记录
     * @param $courseid
     * @param int $chapterid
     * @return bool
     */
    public function addLiveLog($courseid,$chapterid=0,$wxid=0)
    {
        $model_log = M('common_live_log');
        $model_course = M('app_course');
        $live_log = $model_log->getOne('id',"where infoid=$courseid and scheduleid=$chapterid and status=0");
        if ($live_log) return false;
        $livetype = $model_course->getOne('livetype',"where courseid=$courseid");
        if ($livetype==3){
            $model_channel = M('app_course_channel');//直播房间表
            $channel = $model_channel->getRow("where courseid=$courseid");
            if ($channel['status']==1) return false;
            $model_channel->update(['status'=>1],"courseid=$courseid and channelid=$channel[channelid]");//更改房间状态
        }
        $data = [
            'wxid' => $this->wxid?$this->wxid:$wxid,
            'channlid' => $channel['channelid']?$channel['channelid']:0,
            'classlevel' => $livetype,
            'infoid' => $courseid,
            'scheduleid' => $chapterid,
            'status' => 0,
            'starttime' => time(),
            'clicktime' => time(),
        ];
        $id = $model_log->doAdd($data,'id');
        if ($id){
            return true;
        }else{
            $this->errMsg = '系统出错';
            return false;
        }
    }
    
    /**获取课程绑定的房间
     * @param $courseid
     * @return bool
     */
    public function getChannel($courseid)
    {
        $model_channel = M('app_course_channel');//直播房间表
        $channel = $model_channel->getRow("where courseid=$courseid");
        if (!empty($channel)){
            return $channel;
        }else{
            $channel_count = $model_channel->getOne('count(id)',"where live_service='$this->service_name'");
            if ($channel_count>=20){
                $id = $model_channel->getOne('channelid',"where live_service='$this->service_name' and status=0 order by id asc");
                if (!$id){
                    $this->errMsg = '当前直播房间已满~请稍等后重试'; return false;
                }
                $this->delChannel($id);
            }
            $channel = $this->addChannel($courseid);
            if ($channel){
                return $channel;
            }else{
                return false;
            }
        }
    }

    /**创建房间
     * @param $courseid
     * @return bool
     */
    public function addChannel($courseid)
    {
        $course  = M('app_course')->getRow("where wxid=$this->wxid and courseid=$courseid",'courseid,title');
        if (!$course){
            $this->errMsg = '课程不存在';return false;
        }
        $res = $this->service_model->addChannels($course['title']);
        if (!$res){
            $this->errCode = $this->service_model->errCode;
            $this->errMsg = $this->service_model->errMsg;
            return false;
        }
        $model_channel = M('app_course_channel');
        $data = [
            'title'    => $course['title'],
            'courseid' => $course['courseid'],
            'live_service' => $this->service_name,
            'wxid'     => $this->wxid,
            'adddate'  => time(),
            'channelid'=> $res['data']['channelId'],
            'password'=> $res['data']['channelPasswd'],
            'status'   => 0,
        ];
        $model_channel->doAdd($data,'id');
        return $data;
    }

    /**删除房间
     * @param $channelid
     * @return bool
     */
    public function delChannel($channelid)
    {
        $model_channel = M('app_course_channel');
        $channel = $model_channel->getRow("where channelid=$channelid");
        if ($channel['status']==1){
            $this->errMsg = '该房间正在直播中，不可删除';return false;
        }
        $res = $this->service_model->delChannels($channelid);
        if (!$res){
            $this->errCode = $this->service_model->errCode;
            $this->errMsg = $this->service_model->errMsg;
            return false;
        }
        $model_channel->delete("channelid=$channelid");
        return true;
    }









}