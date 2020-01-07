<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit"> 
    <title>得分情况</title>
    <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/home.css" rel="stylesheet">
    <link href="<?php echo UOOT ?>Public/wechat/css/signin.css" rel="stylesheet">
    <script>var uoot = '<?php echo UOOT ?>';</script> 	
</head>
<style type="text/css">
/*********************外框**********************/
.myTask{display: none;}
.myTask-mypress em{font-style: normal;}
.myTask-mypress span{ float: left;color: #888;font-size: .6rem; }
.myTask-mypress span:last-child{ float: right; }
.myTask-list > li{display: none;}
.myTask-list > li.active{display: block;}
.myTask-page{padding: .5rem;} 
.myTask-type{font-size: .75rem;}
/*********************题型**********************/
.list-title{text-align: center;position: relative;padding: .5rem;background: #FFF;border-radius: .3rem;margin-bottom: .5rem;}
.list-title>img{width: 280px;}
.list-title>p{text-align: left;float: left;}
.list-title>span{text-align: left;float: left;}
.list-title>button{}
.nobt{margin: 0rem;}
.myTask-option>li{position: relative;padding: .6rem .5rem;background: #FFF;border-radius: .3rem;margin-bottom: .3rem;box-shadow: 0 2px 14px RGB(225, 242, 253);}
.myTask-option>li.active{background: #FFE57B;}
.lvinp{border-top: none;border-left: none;border-right: none;border-bottom: 1px solid #43B747;width:4rem;background: #FFF!important;}
.redinp{border-top: none;border-left: none;border-right: none;border-bottom: 1px solid #E64A3B;width:4rem;text-decoration: line-through;color:#E64A3B;}
.myTask-textarea{padding: .5rem;background: #FFF;border-radius: .3rem;margin-bottom: 1rem;}
.myTask-textarea>textarea{width: 100%;height: 6rem;border: none;resize: none;}
.myTask-textarea>.contens{width: 100%;height: 6rem;border: none;resize: none;}
.upload{width: 100%;height: 2.2rem;position: relative;line-height: 2.2rem;}
.upload>input{position: absolute;top: 0px;left: 0px;width: 100%;height: 100%;}
.postTask{width:100%;height:100%;} 
.timu5{background:#FFF;margin-bottom:1rem;border-radius: .3rem;padding-bottom: .2rem;}
.timu5li{padding: 0rem .5rem;margin-bottom: .1rem;}
/*************************答题卡***************************/
.mTask{position: fixed;top: 0px;left: 0px;right: 0px;bottom: 0px;z-index: 10;display: none;}  
.mTask-sen{transition:all .5s;width:80%;position: absolute;top: 0px;right: 0px;bottom: 0px;z-index: 10;background: #FFF;margin-right: -80%;}
.mTask .screelst-title{line-height: 2.2rem;background: #fff;padding: 0rem 0.5rem;font-size:0.8rem ;border-bottom: 1px solid #EEEEEE;}
.mTask .screelst-lstbox{padding:0.5rem;} 
.mTask .lstbox-title{line-height: 2rem;font-size: 0.7rem;}
.mTask .lstbtn button{font-size: .7rem; border: #CCCCCC 1px solid;color:#CCCCCC;height: 1.4rem; width: 1.5rem; background: #FFF; margin-right: .5rem; margin-bottom: .5rem;}
.mTask .lstbtn button.active{color:#353535;border:#353535 1px solid;}
.mTask .lstbtn button.tip{color:#37A7ED!important;border:#37A7ED 1px solid!important;}
.mTask .lstbtn button.col{color:#f28550!important;border:#f28550 1px solid!important;}
.mTask .sign-operation{margin-top: 1rem; text-align: center; position: absolute; bottom: 0rem; right: 0rem;width: 100%;border-top: 1px solid #eeeeee;}
.mTask .sign-operation button{width: 100%;height: 2.45rem;border: none;font-size: .8rem;}
/*******************底部收藏等工具**********************/
.note{height: 1.5rem;line-height: 1.5rem;}
.note span{display: block;height: 1.1rem; width: 1.2rem;float: left;margin-left: .45rem;margin-top: .1rem;}
.note:last-child span{margin-top: .1rem;display: block;height: 1rem; width: 1.2rem;margin-left: .33rem;margin-right: .14rem;}
.note .icon-star{background: url(<?php echo UOOT ?>Public/wechat/images/star.png) no-repeat;background-size: auto 100%;}
.note .icon-map{background: url(<?php echo UOOT ?>Public/wechat/images/map.png) no-repeat;background-size: auto 100%;}
.note.active .icon-star{background: url(<?php echo UOOT ?>Public/wechat/images/star_active.png) no-repeat;background-size:auto 100%;}
.note.active .icon-map{background: url(<?php echo UOOT ?>Public/wechat/images/map_active.png) no-repeat;background-size:auto 100%;}
.note.active{color:#37A7ED;}
.note.active:last-child{color:#F28550;}
.myTask-fiex{position: fixed;bottom: 4rem;right: 1rem;} 
.myTask-tim{position: relative;height: 2.5rem;line-height: 2.5rem;width: 2.5rem;background: #FFF;font-size: 1rem;text-align: center;border-radius: .3rem;}
.myTask-tim>span{position: absolute;display: block;width:1rem;height: 1rem;line-height: 1rem;border-radius: 50%;background:#E64A3B;color: #FFF;text-align: center;font-size: .6rem;right: -.5rem;top: -.5rem}

.classmin-topTab{margin-bottom: .5rem;}
.classmin-topTab li{ float: left; width: 33.333%; text-align: center; height: 2.5rem;  background: #FFF; font-size: 0.75rem; }
.classmin-topTab li.active{ color:#37a7ed; }
.classmin-topTab li>div{  border-right:#EEEEEE solid 0.05rem; height: 2rem;  margin-top: 0.2rem;}
.classmin-topTab p{font-size: .6rem;color: #888;line-height: 1rem;}
.classmin-topTab span{font-size: 1rem;color: #000000;}
#score{}
.score-box{position: relative;} 
.score-box img{width: 100%;display: inherit;} 
.score-title{position: absolute;top: 1rem;text-align: center;width: 100%;color: #F28550;}
.score-show{position: absolute;width: 100%;top:50%;left:0px;text-align: center;margin-top: -2rem;}
.score-show span{color: #F28550;font-size:2rem;}
.score-onten{margin-top: .1rem;background: #FFF;padding:.5rem;}
.score-onten .list>li:first-child{font-size: .8rem;color: #000;}
.socre-card{padding-left:1.5rem;}
.socre-card .lstboxs-title{font-size: 0.7rem;}
.socre-card .lstbtns button{font-size: .7rem; border: #CCCCCC 1px solid;color:#CCCCCC;height: 1.2rem; width: 1.2rem; background: #FFF; margin-right: .3rem; margin-bottom: .3rem;}
.socre-card .lstbtns button.active{color:#353535;border:#353535 1px solid;}
.socre-card .lstbtns button.tip{color:#37A7ED!important;border:#37A7ED 1px solid!important;}
.socre-card .lstbtns button.col{color:#f28550!important;border:#f28550 1px solid!important;}
</style>
	<body style="background: #F6F5F0;">
	<div id="score" >
		
		<div class="score-box">
			<img src="<?php echo UOOT ?>Public/wechat/images/score_bg.png"/>
			<div class="score-title">本次得分</div>
			<div class="score-show"><span id="scores"><?php echo $info['score']; ?></span>/<?php echo $paperinfo['sumscore']?>分</div>
		</div>
		
	
		
		<div class="classmin-topTab blue-box_shadow"> 
			<ul class="clearfix">
				<li class="active"><div>
					<p>总题数</p>
					<p><span id="sum"><?php echo $sumtm;?></span> 道</p>
				</div></li>
				<li class="active"><div>
					<p>答对题数</p>
					<p><span id="good"><?php echo $sumtm-count($Myanswer);?></span> 道</p>
				</div></li>
				<li class="active"><div>
					<p>正确率</p>
					<p><span id="pec"><?php echo number_format($rights,2).'%';?></span></p>
				</div></li>
			</ul>
			<input id="histype" type="hidden" value="0">
		</div>
		
		<div class="score-onten blue-box_shadow">
			<ul class="list">
				<li class="exam-title"><?php echo $paperinfo['Title'] ?></li>
				<!-- <li>班级/课程：班级</li> -->
				<!-- <li>所属班级/课程名称：英语加强班</li> -->
				<li>作业用时：<?php echo $time?></li>
			</ul>
			<div>
				教师评价：<?php echo $info['feel']?>
			</div>
		</div>
	
		<footer class="footer">
			<button type="button" class="x-btnYell postTask" onclick="location.href='<?php echo M_URL('h5market','myPaper')?>'" style="color: #fff;">返回</button>
		</footer>
	</div>	
	
	</body>

</html>
