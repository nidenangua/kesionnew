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
class ExamModel extends Model
{
//	public static $tktype = [1=>'单选题',2=>'填空题',3=>'判断题',4=>'简答题',5=>'组合题',6=>'多选题'];//题目类型
	public static $tktype = [1=>'简答题',2=>'单选题',3=>'多选题',4=>'判断题',5=>'填空题',6=>'组合题'];//题目类型
	public static $tklevel = [1=>'低',2=>'中',3=>'高'];//题目难度
	public $wxid;
	public $cache_path;
	public $cache;

	public function __construct()
	{
		$this->wxid = $GLOBALS['_DoM']['wxid'];
		$this->cache_path = SCHOOLDATA_PATH.$this->wxid."/exam/";
		$this->cache = new \Core\Cache();
		$this->userinfo = User_GetUserInfo();
		$this->userid = $this->userinfo['userid'];
	}

	/*
	 * 证书发放
	 */
	public function certificate($paperid,$answerid,$sumscore)
	{
		$rateModel = M('app_certificate_rate');
		$myCertificate = $rateModel->getRow("where wxid=$this->wxid and type=1 and infoid=$answerid and userid=$this->userid");
		if (!$myCertificate){
			$model = M('app_certificate');
			$certificate = $model->getRow("where wxid=$this->wxid and infoid=$paperid and type=1");
			if ($certificate&&$certificate['sumscore']<=$sumscore){
				$json = jsonMerge($certificate['json']);
				foreach ($json as $k=>$v){
					if ($v['num_start']<=$sumscore&&$sumscore<=$v['num_end']){
						$json1 = $v;
					}
				}
				if (!empty($json1)){
					$data['userid'] = $this->userid;
					$data['type'] = 1;
					$data['infoid'] = $answerid;
					$data['certificateid'] = $certificate['id'];
					$data['json'] = jsonMerge($json1,[],true);
					$data['sumscore'] = $sumscore;
					$data['adddate'] = time();
					$data['wxid'] = $this->wxid;
					$rateModel->doAdd($data,'id');
				}
			}
		}
	}

	/**自动批卷
	 * @param $useranswer
	 * @return array
	 */
	public function batch($useranswer)
	{
		$tk_num      = 0;//总题数
		$do_tk       = [];//已做集合
		$no_num      = 0;//未做数
		$error_tk    = [];//错题集合
		$batch_num   = 0;//已批数
		$nobatch_num = 0;//未批数
		$sumscore    = 0;//总分
		$knowledgeid = [];//知识点集合
		foreach ($useranswer as $k=>$v){//大题
			foreach ($v['tklist'] as $k1=>$v1){//小题
				$tk_num += 1;
                $tkid=ChkClng($v1['tkid']);
                $useranswer[$k]['tklist'][$k1]['tkid']=$tkid;

				if ($v1['tktype']=='2'||$v1['tktype']=='3'||$v1['tktype']=='4'){//选择题，判断题，多选题
					$batch_num += 1;
					if (implode($v1['useranswer'])!==''){
						$tkinfo = $this->getTkDetail($tkid);//取出题库信息
						$do_tk = array_merge($do_tk,(array)$tkid);//合并已做
						$knowledgeid = array_merge($knowledgeid,(array)$tkinfo['knowledgeid']);//合并知识点
						if (judgeEqual($v1['useranswer'],$tkinfo['tkinfo']['answer'])){
							$useranswer[$k]['tklist'][$k1]['userscore'] = $v1['score']?$v1['score']:0;//答对给分
							$useranswer[$k]['tklist'][$k1]['mark'] = 'right';//正确
							$sumscore += $v1['score'];
						}else{
							$useranswer[$k]['tklist'][$k1]['userscore'] = 0;//答错给0分
							$useranswer[$k]['tklist'][$k1]['mark'] = 'wrong';//错误
							$error_tk = array_merge($error_tk,(array)$tkid);//合并错题
						}
					}else{
						$useranswer[$k]['tklist'][$k1]['userscore'] = 0;//没答0分
						$useranswer[$k]['tklist'][$k1]['mark'] = 'wrong';//错误
						$no_num += 1;
					}
				}elseif($v1['tktype']=='6'){//组合题
					foreach ($v1['useranswer'] as $k2=>$v2){
						if ($v2['tktype']==2||$v2['tktype']==3||$v2['tktype']==4){//选择题，多选题，判断题
							if (implode($v2['useranswer'])!==''){
								$tkinfo = $this->getTkDetail($tkid);//取出题库信息
								$do_tk = array_merge($do_tk,(array)$tkid);//合并已做
								$knowledgeid = array_merge($knowledgeid,(array)$tkinfo['knowledgeid']);//合并知识点
								if (judgeEqual($v2['useranswer'], $tkinfo['tkinfo']['childtk'][$k2]['tkinfo']['answer'])) {
									$useranswer[$k]['tklist'][$k1]['useranswer'][$k2]['userscore'] = $v2['score']?$v2['score']:0;//答对给分
									$useranswer[$k]['tklist'][$k1]['useranswer'][$k2]['mark'] = 'right';//正确
									$sumscore += $v2['score'];
								}else{
									$useranswer[$k]['tklist'][$k1]['useranswer'][$k2]['userscore'] = 0;//答错给0分
									$useranswer[$k]['tklist'][$k1]['useranswer'][$k2]['mark'] = 'wrong';//错误
									$error_tk = array_merge($error_tk,(array)$v1['tkid']);//合并错题
								}
							}else{
								$useranswer[$k]['tklist'][$k1]['useranswer'][$k2]['userscore'] = 0;//没答给0分
								$useranswer[$k]['tklist'][$k1]['useranswer'][$k2]['mark'] = 'wrong';//错误
								$no_num += 1;
							}
						}else{
							if (implode($v2['useranswer'])!==''){
								$do_tk = array_merge($do_tk,(array)$tkid);//合并已做
								$nobatch_num += 1;
							}else{
								$useranswer[$k]['tklist'][$k1]['useranswer'][$k2]['userscore'] = 0;//没答给0分
								$no_num += 1;
							}
							$useranswer[$k]['tklist'][$k1]['useranswer'][$k2]['mark'] = '';
						}
					}
				}else{
					if (implode($v1['useranswer'])!==''){
						$do_tk = array_merge($do_tk,(array)$tkid);//合并已做
						$nobatch_num += 1;
					}else{
						$useranswer[$k]['tklist'][$k1]['userscore'] = 0;//没答0分
						$no_num += 1;
					}
					$useranswer[$k]['tklist'][$k1]['mark'] = '';
				}
			}
		}
		$do_tk       = array_unique($do_tk);//去重
		$error_tk    = array_unique($error_tk);//去重
		$knowledgeid = array_unique($knowledgeid);//去重
		$result = [
			'tk_num'      => $tk_num,//总题数
			'do_tk'       => $do_tk,//已做的题目array
			'do_num'      => count($do_tk),//已做题目数
			'error_tk'    => $error_tk,
			'error_num'   => count($error_tk),
			'knowledgeid' => $knowledgeid,//知识点
			'useranswer'  => json_encode($useranswer,JSON_UNESCAPED_UNICODE),
//			'useranswer'  => $useranswer,
			'nobatch_num' => $nobatch_num,
			'sumscore'    => $sumscore,
			'iscorrect'   => $nobatch_num==0?1:0,//全部批阅了为1,
		];
		$result['accuracy'] = $this->getZhengQueLv($result['do_num'],$result['error_num']);
		return $result;
	}

	/**获取正确率
	 * @param $do_num int 已做数
	 * @param $error_num int 错误数
	 * @return int
	 */
	private function getZhengQueLv($do_num,$error_num)
	{
		if (!empty($do_num)){
			return round((($do_num-$error_num)/$do_num)*100,2);//正确率%
		}else{
			return 0;
		}
	}

	/**手动批卷
	 * @param $useranswer array
	 * @return array
	 */
	public function getAnswerScore($useranswer)
	{
		$sumscore = 0;//总分
		$nobatch_num = 0;//未批的题目数
		$dobatch_num = 0;//已批的题目数
		foreach ($useranswer as $k2=>$v2){//大题
			foreach ($v2['tklist'] as $k3=>$v3){//小题
				if ($v3['tktype']==6){//组合题
					foreach ($v3['useranswer'] as $k4=>$v4){
						if (isset($v4['userscore'])){//分数存在为已经批阅了
							$sumscore += $v4['userscore'];
							$dobatch_num += 1;
						}else{//未批阅
							$nobatch_num += 1;
						}
					}
				}else{
					if (isset($v3['userscore'])){//分数存在为已经批阅了
						$sumscore += $v3['userscore'];
						$dobatch_num += 1;
					}else{//未批阅
						$nobatch_num += 1;
					}
				}
			}
		}
		$data = [
			'sumscore' => $sumscore,
			'iscorrect' => $nobatch_num==0?1:0,//全部批阅了为1
			'answer' => json_encode($useranswer,JSON_UNESCAPED_UNICODE),
//			'answer' => $useranswer,
		];

		return $data;
	}

	/**删除
	 * @param $id
	 * @param $type 1试卷2题库3做题表
	 */
	public function del($id,$type)
	{
		$data['status'] = -1;
		if ($type==1){
			$model = M('app_paper');
			$model->update($data,"paperid=$id and wxid=$this->wxid");
		}elseif($type==2){
			$model = M('app_paper_tk');
			$model->update($data,"tkid=$id and wxid=$this->wxid");
		}elseif($type==3){
			$model = M('app_paper_answer');
			$model->update($data,"id=$id and wxid=$this->wxid");
		}
	}

	/**更新用户做题情况
	 * @param $categoryid int 分类ID
	 * @param $userid
	 * @param $type int 1整卷or随机练习 2错题练习
	 * @param $do_tk array 已经做的题目['1','2']
	 * @param $error_tk array 错误的题目['1','2']
	 * @param $knowledgeid array 知识点['1','2']
	 * @param $time int 练习时长
	 * @param $paperid int 试卷ID
	 */
	public function updateRecord($categoryid,$userid,$type,$do_tk,$error_tk=[],$knowledgeid=[],$time=0,$paperid=0)
	{
		$record = $this->getUserRecord($categoryid,$userid,true);//做题情况
		$success_tk = array_values(array_diff($do_tk,$error_tk));//做对的题库
		$data_record['total_dotktime'] = $record['total_dotktime']+$time;//做题时间累加
		$data_record['last_time'] = time();//最后一次做题时间
//		var_dump($record);die;
		if ($record['last_time']>strtotime('yesterday')&&$record['last_time']<strtotime(date('Y-m-d 0:0:0'))){//最后时间大于昨天0点并小于今天0，说明昨天练习过了，今天第一次练习
			$data_record['total_continedotkday'] = $record['total_continedotkday']+1;//连续做题天数+1
		}elseif ($record['last_time']<strtotime('yesterday')){//最后练习时间小于昨天0点，重新计算累计
			$data_record['total_continedotkday'] = 1;
		}
		if ($record['last_time']<strtotime(date('Y-m-d 0:0:0'))){//最后一次练习时间小于今天0点，说明今天未练习
			$data_record['total_dotkday'] = $record['total_dotkday']+1;//累计做题天数;
		}
		//合并每日做题记录
		if ($time>0){
			$check = false;
			$do_num = count($do_tk);
			foreach ($record['day_record'] as $k=>$v){
				if ($v['date']==date('Ymd')){
					$record['day_record'][$k]['time'] = $v['time']+$time;
					$record['day_record'][$k]['tk_num'] = $v['tk_num']+$do_num;
					$check = true;break;
				}
			}
			if ($check==false){
				$record['day_record'] = array_merge($record['day_record'],[['date'=>date('Ymd'),'time'=>$time,'do_num'=>$do_num]]);
			}
			$data_record['day_record'] = json_encode($record['day_record']);
		}
		if ($type==1||$type==2){//整卷and随机练习and收藏练习
			$do_tk1 = array_merge(array_diff($record['do_tk'],$do_tk),$do_tk);
			$data_record['knowledgeid'] = json_encode(array_unique(array_merge(array_diff($record['knowledgeid'],$knowledgeid),$knowledgeid))) ;//合并已做知识点
			$data_record['do_tk'] = json_encode($do_tk1);
			$data_record['do_num'] = count($do_tk1);
			$error_tk1 = array_merge(array_diff($record['error_tk'],$error_tk),$error_tk);//合并错题
			$error_tk1 = array_values(array_diff($error_tk1,$success_tk));//从错题库删除做对的
			$data_record['error_tk'] = json_encode($error_tk1);
			$data_record['error_num'] = count($error_tk1);
			$data_record['accuracy'] = $this->getZhengQueLv($data_record['do_num'],$data_record['error_num']);
			if (!empty($paperid)){
				$data_record['paperid'] = json_encode(array_unique(array_merge($record['paperid'],(array)$paperid)));//合并已做试卷
			}
		}else{//错题练习
			$error_tk1 = array_values(array_diff($record['error_tk'],$success_tk));
			$data_record['error_tk'] = json_encode($error_tk1);
			$data_record['error_num'] = count($error_tk1);
			$data_record['accuracy'] = $this->getZhengQueLv($record['do_num'],$data_record['error_num']);
		}
		$model_record = M('app_paper_record');
		$model_record->update($data_record,"categoryid=$categoryid and wxid=$this->wxid and userid=$userid");
		$this->getUserRecord($categoryid,$userid,true);//更新缓存
	}

	/**获取用户做题情况
	 * @param $categoryid int 分类ID
	 * @param $userid int
	 * @param bool $update 是否更新缓存true
	 * @return array|mixed
	 */
	public function getUserRecord($categoryid,$userid,$update=false)
	{
        $cacheKey = $userid.':userRecord:category:'.$categoryid;
		$detail = $this->cache->get($cacheKey,$this->cache_path);
		if ($detail==1 || empty($detail) || $update==true) {
			unset($detail);
			$model = M('app_paper_record');
			$detail = $model->getRow("where categoryid=$categoryid and wxid=$this->wxid and userid=$userid");
			if (!empty($detail)) {
				$detail['do_tk'] = !empty($detail['do_tk'])?json_decode($detail['do_tk'],true):[];
				$detail['error_tk'] = !empty($detail['error_tk'])?json_decode($detail['error_tk'],true):[];
				$detail['error_num'] = count($detail['error_tk']);
				$detail['paperid'] = !empty($detail['paperid'])?json_decode($detail['paperid'],true):[];
				$day_record = !empty($detail['day_record'])?json_decode($detail['day_record'],true):[];
				$day_record_count = count($day_record);
				//保留7天数据
				if ($day_record_count>7){
					for ($i=($day_record_count-7);$i<=($day_record_count-1);$i++){
						$day_record1[$i] = $day_record[$i];
					}
					$detail['day_record'] = array_values($day_record1);
				}else{
					$detail['day_record'] = $day_record;
				}
				$detail['paper_num'] = count($detail['paperid']);
				$detail['knowledgeid'] = !empty($detail['knowledgeid'])?json_decode($detail['knowledgeid'],true):[];
				$detail['knowledge_num'] = count($detail['knowledgeid']);
			}else{
				for ($i=6;$i>=0;$i--){
					$day_record[$i]['date'] = date('Ymd',strtotime('-'.$i.' day',time()));
					$day_record[$i]['time'] = 0;
					$day_record[$i]['tk_num'] = 0;
				}
				$data = [
					'wxid' => $this->wxid,
					'userid' => $userid,
					'categoryid' => $categoryid,
					'day_record' => json_encode(array_values($day_record),JSON_UNESCAPED_UNICODE),
				];
				$model->doAdd($data,'id');
				return $this->getUserRecord($categoryid,$userid,true);
			}
			$this->cache->put($cacheKey,$detail,$this->cache_path);
		}
		return !empty($detail)?$detail:[];
	}

	/**获取试卷详情
	 * @param $paperid
	 * @param bool $update 是否更新缓存true
	 * @return array|mixed
	 * @return $userid int 用于储存随机的题目
	 */
	public function getPaperDetail($paperid,$update=false,$userid=0)
	{
		$cacheKey = 'paperDetail:paperid:'.$paperid;
		$detail = $this->cache->get($cacheKey,$this->cache_path);
		if ($detail==1 || empty($detail) || $update==true) {
			unset($detail);
			$model = M('app_paper');
			$detail = $model->getRow('where paperid='.$paperid.' and wxid='.$this->wxid);
			if (!empty($detail)){
				if ($detail['exam_type']==1){//随机组卷
					if (!empty($userid)){
						$model_answer = M('app_paper_answer');
						$tmlist = $model_answer->getOne('answer',"where paperid=$paperid and userid=$userid and end_status=0");
						if ($tmlist){
							$tmlist = json_decode($tmlist,true);
						}else{
							$tmlist = json_decode($detail['tmlist'],true);
							$model_tk = M('app_paper_tk');
							foreach($tmlist as $k =>$v){
								$tmlist[$k]['tklist'] = $model_tk->getAll("where tktype=$v[tktype] and status=1 and wxid=$this->wxid and categoryid=$detail[categoryid] ORDER BY RAND() LIMIT $v[tk_num]",'tkid');
							}
							$data['paperid'] = $paperid;
							$data['userid'] = $userid;
							$data['wxid'] = $this->wxid;
							$data['title'] = $detail['title'];
							$data['categoryid'] = $detail['categoryid'];
							$data['answer'] = json_encode($tmlist,JSON_UNESCAPED_UNICODE);
							$model_answer->doAdd($data,'id');
						}
						foreach ($tmlist as $k=>$v){
							foreach ($v['tklist'] as $k1=>$v1){
								$tmlist[$k]['tklist'][$k1] = $this->getTkDetail($v1['tkid']);
							}
						}
					}else{
						$tmlist = json_decode($detail['tmlist'],true);
					}
				}else{//手动组卷
					$tmlist = json_decode($detail['tmlist'],true);
					foreach ($tmlist as $k=>$v){
						foreach ($v['tklist'] as $k1=>$v1){
							$tmlist[$k]['tklist'][$k1] = $this->getTkDetail($v1['tkid']);
							if ($v1['tktype']==6){
								$score = 0;
								foreach ($tmlist[$k]['tklist'][$k1]['tkinfo']['childtk'] as $k2=>$v2){
									$tmlist[$k]['tklist'][$k1]['tkinfo']['childtk'][$k2]['score'] = $v1['score'][$k2];
									$score += $v1['score'][$k2];
								}
								$tmlist[$k]['tklist'][$k1]['score'] = $score;
							}else{
								$tmlist[$k]['tklist'][$k1]['score'] = $v1['score'];
							}
						}
					}
				}

				$detail['tmlist'] = !empty($tmlist)?$tmlist:[];
				$detail['tkTemplateUrl'] = UOOT.'Public/题库导入模版.xls';
				$detail['adddate'] = KS_DATE($detail['adddate']);
			}
			if ($detail['exam_type']==2||empty($detail)){
				$this->cache->put($cacheKey,$detail,$this->cache_path);
			}
		}
		return !empty($detail)?$detail:[];
	}

	/**获取题库详情
	 * @param $tkid
	 * @param bool $update 是否更新缓存true
	 * @return array|mixed
	 */
	public function getTkDetail($tkid,$update=false)
	{
        $tkid=ChkClng($tkid);
		$cacheKey = 'tkDetail:tkid:'.$tkid;
		$detail = $this->cache->get($cacheKey,$this->cache_path);
		if ($detail==1 || empty($detail) || $update==true) {
			unset($detail);
			$model = M('app_paper_tk');
			$detail = $model->getRow("where tkid=$tkid and wxid=$this->wxid",'tkid,title,inputer,categoryid,level,tkinfo,tktype,adddate,knowledgeid');
			if (!empty($detail)) {
				$detail = $this->eachTk($detail);
			}
			$this->cache->put($cacheKey,$detail,$this->cache_path);
		}
		return !empty($detail)?$detail:[];
	}

	/**获取分类下tkid
	 * @param $categoryid
	 * @param bool $update 是否更新缓存true
	 * @return array|mixed
	 */
	public function getCategoryTk($categoryid,$update=false)
	{
        $categoryid=ChkClng($categoryid);
		$cacheKey = 'categoryTk:categoryid:'.$categoryid;
//		$cacheKey = 'categoryTk-categoryid-'.$categoryid.'-wxid-'.$this->wxid;
		$data = $this->cache->get($cacheKey,$this->cache_path);
		if ($data==1 || empty($detail) || $update==true) {
			unset($data);
			//题库集合
			$model = M('app_paper_tk');
			$where = "where wxid=$this->wxid and status=1";
			if (!empty($categoryid)) $where .= " and categoryid=$categoryid";
			$tklist = $model->getAll($where,'tkid');
			if (!empty($tklist)) {
				foreach ($tklist as $k=>$v){
					$tkids[$k] = $v['tkid'];
				}
			}
			//知识点数量
			$model_knowledge = M('app_knowledge');
			$where1 = "where wxid=$this->wxid";
			$where1 .= " and categoryid=$categoryid";
			$knowledge_num = $model_knowledge->getOne('count(id)',$where1);
			//考卷数量
			$model_paper = M('app_paper');
			$where2 = "where wxid=$this->wxid and status=1";
			$where2 .= " and categoryid=$categoryid";
			$paper_num = $model_paper->getOne('count(paperid)',$where2);
			$data = [
				'tkids' => !empty($tkids)?$tkids:[], //题库集合[]
				'tk_num' => count($tkids), //题库数
				'knowledge_num' => !empty($knowledge_num)?$knowledge_num:0,//知识点数
				'paper_num' => !empty($paper_num)?$paper_num:0,//试卷数
				'categoryid' => $categoryid,
			];
			$this->cache->put($cacheKey,$data,$this->cache_path);

		}
		return !empty($data)?$data:[];
	}

	/**题库循环
	 * @param $value
	 * @param bool $each true foreach循环
	 * @return array
	 */
	public function eachTk($value,$each=false)
	{
		if (empty($value)) return [];
		if ($each==true){
			foreach ($value as $k=>$v){
				$value[$k]['tkinfo'] = json_decode($v['tkinfo'],true);
				$value[$k]['adddate'] = KS_DATE($v['adddate']);
				$value[$k]['type_name'] = ExamModel::$tktype[$v['tktype']];
				$categoryname = $this->cache->GetH('appcategory','categoryid',$v['categoryid'],'categoryname',$this->wxid);
				$parentidpath = $this->cache->GetH('appcategory','categoryid',$v['categoryid'],'parentidpath',$this->wxid);
				$value[$k]['categoryname'] = !empty($categoryname)?$categoryname:[];
				$value[$k]['parentidpath'] = !empty($parentidpath)?explode(',',$parentidpath):[];
				$value[$k]['level'] = ExamModel::$tklevel[$v['level']];
				if ($v['tktype']==6){
					foreach ($value[$k]['tkinfo']['childtk'] as $k1=>$v1){
						$value[$k]['tkinfo']['childtk'][$k1]['type_name'] = ExamModel::$tktype[$v1['tktype']];
					}
				}
			}
		}else{
			$value['tkinfo'] = json_decode($value['tkinfo'],true);
			$value['adddate'] = KS_DATE($value['adddate']);
			$value['type_name'] = ExamModel::$tktype[$value['tktype']];
			$value['level'] = ExamModel::$tklevel[$value['level']];
			$categoryname = $this->cache->GetH('appcategory','categoryid',$value['categoryid'],'categoryname',$this->wxid);
			$parentidpath = $this->cache->GetH('appcategory','categoryid',$value['categoryid'],'parentidpath',$this->wxid);
			$value['categoryname'] = !empty($categoryname)?$categoryname:[];
			$value['parentidpath'] = !empty($parentidpath)?explode(',',$parentidpath):[];
			if ($value['tktype']==6){
				foreach ($value['tkinfo']['childtk'] as $k=>$v){
					$value['tkinfo']['childtk'][$k]['type_name'] = ExamModel::$tktype[$v['tktype']];
				}
			}
		}
		return $value;
	}



}