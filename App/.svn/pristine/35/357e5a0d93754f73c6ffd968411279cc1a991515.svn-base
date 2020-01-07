
<!DOCTYPE html> 
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="x5-fullscreen" content="true">
        <meta name="full-screen" content="yes">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
        <meta name="renderer" content="webkit"> 
        <title><?php echo $title; ?></title>
        <link href="<?php echo UOOT ?>Public/common/drag/css/reset.css" rel="stylesheet">
        <link href="<?php echo UOOT ?>Public/wechat/css/microportal/rely.css" rel="stylesheet">
        <link href="<?php echo UOOT ?>Public/wechat/css/audioin.css?fqwfwafg" rel="stylesheet">
    	<script src="<?php echo UOOT ?>Public/common/js/aliyun/alioss/lib/plupload-2.1.2/js/plupload.full.min.js"></script>
    	<script src="<?php echo UOOT ?>Public/common/js/aliyun/alioss/upload.js?<?php echoHash(); ?>"></script>
        <script>
            var listenurl='//<?php echo MY_DOMAIN.':'.SWOOLE_PORT;?>';
            var uoot = '<?php echo UOOT ?>';
            var userid = '<?php if(isset($userid)){echo $userid;}else{ echo 0;}?>';
            var wxid = '<?php echo $this->wxid; ?>';
            var appid = '<?php echo $signPackage["appId"];?>';
            var nonceStr = '<?php echo $signPackage["nonceStr"];?>';
            var timestamps = '<?php echo $signPackage["timestamp"];?>';
            var signature = '<?php echo $signPackage["signature"];?>';
            var teacherName = '<?php echo $teacher_name;?>';
            var teacherAvatar = '<?php echo $teacher_avatar;?>';
            var studentCount = '<?php echo $studentcount; ?>';
            var _isuser = '<?php if(isset($usertype)){ echo $usertype;}else{ echo 0;}?>';//0是学生 1是老师 ;
        </script>
        <style>
            .loadings{
                display: block 
            }
        </style> 
</head>
<body>
    <div id="audioin" class="audioin" v-cloak>
    	<template v-if="_isuser==1"> 
    		<div class="goclass" @click="startlive" v-if="livetype == 0">上课</div>
    		<div class="goclass" @click="endlive" v-else>下课</div>
    		
    	</template>
        <template v-show="renderFlag">
            <div class="audioin-top line">
                <div class="p-number" v-if="livetype==1">{{Number(person) + Number(studentCount)}}人进入</div>
                <div class="g-status active" v-if="livetype==0 || !!!livetype" >直播尚未开始</div>
                <div class="g-status" v-if="livetype==1">·直播中</div>
            </div>
            <div class="audioin-body"@click="bottomtab=null">
                <div class="audio-body-top">
                    <div class="item" :class="{active:tab==1}"  @click="changetab(1)">直播间 <div class="under"></div></div>
                    <div class="item" :class="{active:tab==2}"  @click="changetab(2)">问题区<div class="under"></div></div>
                </div>
               
                <div class="audio-body-items"  id="live" :style="{height:height}" v-show="tab==1" @click="bottomdefault" style="box-sizing: border-box;padding-bottom: 100px;">
                    <div class="nowtime">{{nowtime}}</div>
                    <!--助手-->
                    <div class="item">
                            <div class="userimg"><img src="/Public/common/images/app-icon.jpg" alt=""></div>
                            <div class="item-info">
                                <div class="item-name">科汛V名师助手</div>
                                <div class="item-content pad10">
                                    欢迎进入直播间<br>
                                    1、本次直播为语音图文直播，请确保手机为非静音状态。<br>
                                    2、直播界面显示讲师发布的内容，听众发言可以在讨论区进行查看，给老师的提问可以再问题区查看。<br>
                                    3、直播结束后，您可以随时回看全部内容。<br>
                                </div>
                            </div>
                    </div>
                    <!--循环列表项-->
                    <div class="item" :class="{flexcenter:item.isback==1}"  v-for="(item, index) in liveArr" :key="index">
                            <!--isdel如果等于1表示被删除的 就不用出来了-->
                                <template v-if="item.isback==0">
                                    <div class="userimg"> <img :src="item.isuser == 0 ? teacherAvatar : item.avatar" alt="" style="margin-right: 10px"></div>
                                    <div class="item-info">
                                        <div class="item-name">{{item.isuser == 0 ? teacherName : item.membername}} {{toChangeTime(item.adddate)}}
                                            <!--操作选项--> 
                                            <!--type 0文字 1图片 2音频-->
                                          	<!--老师撤回所有人-->
                                          	<template v-if="outusertype==1">
                                          		<span v-if="item.isgq==0" class="options-tips" @click="withdraw(index,item)">撤回</span>
                                          	</template>
                                          	<!--学生撤回自己的-->
                                          	<template v-if="outusertype==0">
                                          		<span v-if="item.isgq==0&&item.memberid==outuser" class="options-tips" @click="withdraw(index,item)">撤回</span>
                                          	</template>
                                            </div>
                                        <div class="item-content pad10" v-if="item.type==0">{{item.interact}}</div>
                                        <div class="item-content" v-if="item.type == 1"> <img class="defaultpic" :src="item.interact" alt="" @click="toshowimg(item)"></div>
                                        <div class="item-content pad5" style="width:60%;display: flex;align-items: center;" :class="{active:playtab==index}" v-if="item.type==2||item.type==3" @click="audioplay(index,item)">
                                            <img src="<?php echo UOOT;?>Public/wechat/images/audiolive/audiolive_icon_audiodoc.png" class="audio-icon g">
                                            <img src="<?php echo UOOT;?>Public/wechat/images/audiolive/audiolive_icon_audiodoc.gif" class="audio-icon l">
                                            <div class="playtime" v-html="audiotime(item.audiotime)"></div>
                                            <div class="playstatus" v-if="!item.audiostatus"></div>
                                        </div>
                                        
                                    </div>
                                </template>
                                <template v-if="item.isback == 1">
                                    <div class="withdraw" style="justify-content: center">
                                        {{item.membername}}撤回了一条消息
                                    </div>
                                </template>
                                <!--红包-->
                                <template v-if="item.reward == 1">
                                    <div class="_textcenter">
                                        <div class="reward-item">
                                            {{item.name}}打赏了一个<span>{{item.rewardNumber}}</span>红包
                                        </div>
                                    </div>
                                </template>
                    </div>
                     <!--弹幕-->
	                <div class="danmu-list" id="_danmu" v-show="isdanmu" ref="danmulist" :style="{bottom:damulistbottom}" v-if="tab==1">
	                    <!-- <div class="danmu-mask"></div> -->
	                    <div class="danmu-item" v-for="(item, index) in danmulist" :key="index" v-if="item.type==0">
	                        <div class="itemed">
                                <div style="display:flex; align-items: center;width: 100%">
                                    <div v-if="item.isquestion==1" class="question">问</div>
                                    <img :src="item.isuser == 0 ? teacherAvatar : item.avatar" alt="" :class="{l50:item.isquestion==1}" class="danmu-img">
                                    <p class="con" :class="{ml70:item.isquestion==1}">{{item.interact}}</p>
                                </div>
	                        </div>
	                    </div>
	                </div>
                    
                </div>
                 <!--侧栏悬浮按钮-->
                <div class="aside" :style="{bottom:asidebottom}" v-if="tab==1">
                    <!--学生悬赏-->
                    <div class="itemed" @click.stop="openreward" v-if="_isuser==0">
                        <img src="<?php echo UOOT;?>Public/wechat/images/audiolive/audiolive_btn_tip.png" class="light">
                    </div>
                    <div class="itemed" :class="{active:isdanmu}" @click="opendanmu">
                        <img src="<?php echo UOOT;?>Public/wechat/images/audiolive/audiolive_btn_bullet_n.png" class="close">
                        <img src="<?php echo UOOT;?>Public/wechat/images/audiolive/audiolive_btn_bullet_s.png" class="light">
                    </div>
                    <div class="itemed" @click="opentalk">
                        <img src="<?php echo UOOT;?>Public/wechat/images/audiolive/audiolive_btn_discuss.png" class="light">
                    </div>
                </div>
               
                <!--问题区-->
                <div class="audio-body-items" id="question" :style="{height:height}" v-show="tab==2" @click="bottomdefault">
                  
                    <template v-if="questionArr.length>0">
                            <div class="nowtime">{{nowtime}}</div>
                            
                            <div class="item" v-for="(item, index) in questionArr" :key="index">
                                <template v-if="item.replytype==0">
                                    <div class="userimg"> <img :src="item.isuser == 0 ? teacherAvatar : item.avatar" alt="" style="margin-right: 10px"></div>
                                    <div class="item-info">
                                        <div class="item-name">{{item.membername}}
                                            <!--已回复-->
                                            <!--<span class="options-tips" style="color:#999" v-if="_isuser==1&&item.isreply==1">已回复</span>
                                            <span class="options-tips" style="color:#e64a3b" v-if="_isuser==1&&item.isreply==0">未回复</span>-->
                                        </div>
                                        <div class="ex-flex">
                                            <div class="item-content pad10" v-if="item.type==0">{{item.interact}}</div>
                                            <div class="item-content pad10" v-if="item.type==1"> <img class="defaultpic" :src="item.defaultpic" alt="" @click="toshowimg(item)"></div>
                                            <div class="item-content pad5" style="width:60%;display: flex;align-items: center;" :class="{active:playtab==index}" v-if="item.type==2 ||item.type==3" @click="audioplay(index,item)">
                                                <img src="<?php echo UOOT;?>Public/wechat/images/audiolive/audiolive_icon_audiodoc.png" class="audio-icon g">
                                                <img src="<?php echo UOOT;?>Public/wechat/images/audiolive/audiolive_icon_audiodoc.gif" class="audio-icon l">
                                                <div class="playtime"  v-html="audiotime(item.audiotime)"></div>
                                                <div class="playstatus" v-if="!item.audiostatus"></div>
                                            </div>
                                            <!--学生进入的话 隐藏所有的回复 如果是老师自己的发言也隐藏对应的回复-->
                                            <div class="reply " @click.stop ="reply(item,2)" :class="{opacity0:_isuser==0}">回复</div>
                                        </div>
                                    </div>
                                </template>
                                <template v-if="item.replytype==1">
                                        <div class="userimg"> <img :src="item.isuser == 0 ? teacherAvatar : item.avatar" alt="" style="margin-right: 10px"></div>
                                        <div class="item-info">
                                            <div class="item-name">{{item.membername}}</div>
                                            <div class="ex-flex">
                                                <!--文字回复-->
                                                <div class="item-content pad10" v-if="item.intype==0">
                                                    <span class="replyname">@  {{item.inname}}:</span>  {{item.incontent}}
                                                    <div class="inline"></div>
                                                    <div class="incontent" v-if="item.type==0">{{item.reply}}</div>
                                                    <div class="incontent" v-if="item.type==1"><img class="defaultpic" :src="item.reply" alt="" @click="toshowimg(item)"></div>
                                                    <div class="incontent" v-if="item.type==2 ||item.type==3" style="display: flex;" @click="audioplay(index,item)">
                                                            <img src="<?php echo UOOT;?>Public/wechat/images/audiolive/audiolive_icon_audiodoc.png" class="audio-icon g">
                                                            <img src="<?php echo UOOT;?>Public/wechat/images/audiolive/audiolive_icon_audiodoc.gif" class="audio-icon l">
                                                            <div class="playtime">{{item.audiotime}}"</div>
                                                            <div class="playstatus" v-if="!item.audiostatus"></div>
                                                    </div>
                                                </div>
                                                <!--图片回复-->
                                                <div class="item-content pad10" v-if="item.intype==1">
                                                    <span class="replyname">@&nbsp;{{item.inname}}:</span>[图片]
                                                    <div class="inline"></div>
                                                    <div class="incontent" v-if="item.type==0">{{item.reply}}</div>
                                                    <div class="incontent" v-if="item.type==1"><img class="defaultpic" :src="item.reply" alt="" @click="toshowimg(item)"></div>
                                                    <div class="incontent" v-if="item.type==2 || item.type==3" style="display: flex;" @click="audioplay(index,item)">
                                                            <img src="<?php echo UOOT;?>Public/wechat/images/audiolive/audiolive_icon_audiodoc.png" class="audio-icon g">
                                                            <img src="<?php echo UOOT;?>Public/wechat/images/audiolive/audiolive_icon_audiodoc.gif" class="audio-icon l">
                                                            <div class="playtime">{{item.audiotime}}"</div>
                                                            <div class="playstatus" v-if="!item.audiostatus"></div>
                                                    </div>
                                                </div>
                                                <!--语音回复-->
                                                <div class="item-content pad10" v-if="item.intype==2||item.intype==3">
                                                    <span class="replyname">@&nbsp;{{item.inname}}:</span>[语音]
                                                    <div class="inline"></div>
                                                    <div class="incontent" v-if="item.type==0">{{item.reply}}</div>
                                                    <div class="incontent" v-if="item.type==1"><img class="defaultpic" :src="item.reply" alt="" @click="toshowimg(item)"></div>
                                                    <div class="incontent" v-if="item.type==2 || item.type==3" style="display: flex;background: #f5f5f5" @click="audioplay(index,item)">
                                                            <img src="<?php echo UOOT;?>Public/wechat/images/audiolive/audiolive_icon_audiodoc.png" class="audio-icon g">
                                                            <img src="<?php echo UOOT;?>Public/wechat/images/audiolive/audiolive_icon_audiodoc.gif" class="audio-icon l">
                                                            <div class="playtime">{{item.audiotime}}"</div>
                                                            <div class="playstatus" v-if="!item.audiostatus"></div>
                                                    </div>
                                                </div>
                                                <div class="reply" style="opacity: 0;">回复</div>
                                            </div>
                                        </div>
                                </template>
                            </div>
                    </template>
                      <template v-if="questionArr.length==0">
                        <div class="noquestion">暂无问题</div>
                    </template>
                    <!--撤回消息数组-->
                     <!--TODO:要删除，不应该是在下方提示-->
                    <!-- <template v-if="withdrawArr.length>0">
                            <div class="item" style="justify-content: center" v-for="(item, index) in withdrawArr" :key="item.stamp">
                                <div class="withdraw">{{item.name}}撤回了一条消息</div>
                            </div>
                    </template> -->
                </div>
            </div>
           
            <div class="audioin-bottom">
                <!--教师的-->
                <div class="items line" v-show="_isuser==1 && questionBottomFlag">
                    <div class="item" :class="{active:bottomtab==1}" @click="arouseaudio" v-if="!talkFlag">
                        <div class="item-g">
                            <img src="<?php echo UOOT;?>Public/wechat/images/audiolive/audiolive_btn_audio_n.png" alt="">
                            <p>语音</p>
                        </div>
                        <div class="item-l">
                            <img src="<?php echo UOOT;?>Public/wechat/images/audiolive/audiolive_btn_audio_s.png" alt="">
                            <p>语音</p>
                        </div>
                    </div>
                    <div class="item" :class="{'active':bottomtab==2}" @click="arousetext">
                        <div class="item-g">
                            <img src="<?php echo UOOT;?>Public/wechat/images/audiolive/audiolive_btn_text_n.png" alt="">
                            <p>文字</p>
                        </div>
                        <div class="item-l">
                            <img src="<?php echo UOOT;?>Public/wechat/images/audiolive/audiolive_btn_text_s.png" alt="">
                            <p>文字</p>
                        </div>
                    </div>
                    <div class="item" :class="{'active':bottomtab==3}">
                        <div class="item-g" id="container">
                        	<div id="selectfiles" class="inpicture"></div>
                            <img src="<?php echo UOOT;?>Public/wechat/images/audiolive/audiolive_btn_pic_n.png" alt="">
                            <p>图片</p>
                        </div>
                    </div>
                    <div class="item" @click="arouseOption">
                        <div class="item-g">
                            <img src="<?php echo UOOT;?>Public/wechat/images/audiolive/audiolive_btn_more_n.png" alt="">
                            <p>操作</p>
                        </div>
                    </div>
                </div>
                <!--学生-->
                <div class="items" v-show="_isuser==0&&studentAudioFlag">
                	
                	<!--聊天室-->
                	<template v-if="replytab==1&&!talkFlag">
	                    <div class="_audio" v-if="setting.audio==1&&outuser!=excuseid&&livetype==1&&!talkFlag&&setting.chat==0&&setting.upperwall==1" @click="arouseaudioStudent">
	                        <img src="<?php echo UOOT;?>Public/wechat/images/audiolive/audiolive_btn_audio_n.png" alt="">
	                    </div>
	                    <input type="text" class="_student_texting" id="_student_texting1" placeholder="快来参与讨论吧" v-model="studentevaluate" :disabled="setting.chat==1 ||setting.upperwall==0|| outuser==excuseid || livetype==0" @focus="scrollIntoViewed" @blur="blurinput"/>
	                    <button type="button" :class="{bggrey:setting.chat==1 ||setting.upperwall==0|| outuser==excuseid || livetype==0}" :disabled="setting.chat==1 ||setting.upperwall==0|| outuser==excuseid || livetype==0"  class="_student_btn"  @click="studentSendText">发送</button>
                	</template>
                	<!--问题区-->
                	<template v-if="replytab==2&&!talkFlag">
                		<div class="_audio" v-if="setting.audio==1&&outuser!=excuseid&&livetype==1&&!talkFlag&&setting.chat==0" @click="arouseaudioStudent">
	                        <img src="<?php echo UOOT;?>Public/wechat/images/audiolive/audiolive_btn_audio_n.png" alt="">
	                    </div>
	                    <input type="text" class="_student_texting" id="_student_texting2" placeholder="快来参与讨论吧" v-model="studentevaluate" @focus="scrollIntoViewed" @blur="blurinput"/>
	                    <button type="button" class="_student_btn" @click="studentSendText">发送</button>
                	</template>
					<!--讨论区-->
					<template v-if="talkFlag">
						<input type="text" class="_student_texting" id="_student_texting3" placeholder="快来参与讨论吧" v-model="studentevaluate" :disabled="setting.chat==1 || outuser==excuseid" @focus="scrollIntoViewed" @blur="blurinput"/>
	                    <button type="button" :class="{bggrey : setting.chat==1 || outuser==excuseid}" :disabled="setting.chat==1 || outuser==excuseid" class="_student_btn" @click="studentSendText">发送</button>
					</template>
                	
                </div>
                <!--额外操作语音项-->
                <div class="record-options" v-show="isrecord">
                    <div class="record-student" v-if="_isuser==0" @click="arouseaudioStudent">
                        <img  src="<?php echo UOOT;?>Public/wechat/images/audiolive/audiolive_btn_more_n.png"  alt="">
                    </div>
                    <div class="record-cancel" v-if="audiotab==3" @click="cancelAudio">取消</div>
                    <div class="tops" v-html="audiotexttop"></div>
                    <div class="bodys">
                    	<div class="_item staraudio" @click.stop="startaudio" :class="audiotab==1 ? 'block':'none'" ></div>
                    	<div class="_item stopaudio"  @click.stop="stopaudio" :class="audiotab==2 ? 'block':'none'" ></div>
                    	<div class="_item sendaudio"  @click.stop="sendaudio" :class="audiotab==3 ? 'block':'none'" ></div>
                        <!--<img class="stoprecord noselect" :class="audiotab==1 ? 'block':'none'"  src="<?php echo UOOT;?>Public/wechat/images/audiolive/audiolive_btn_audio.png" alt="" @click.stop="startaudio">
                        <img class="recording noselect" :class="audiotab==2 ? 'block':'none'"  src="<?php echo UOOT;?>Public/wechat/images/audiolive/audiolive_btn_audioing.gif" alt="" @click.stop="stopaudio">
                        <img class="recording noselect":class="audiotab==3 ? 'block':'none'"  src="<?php echo UOOT;?>Public/wechat/images/audiolive/audiolive_btn_send.png" alt="" @click.stop="sendaudio">-->
                    </div>
                    <div class="bottoms">{{audiotextbottom}}</div>
                </div>
                <!--额外操作输入文字-->
                <div class="text-options" v-show="istext">
                    <input type="text" v-model="evaluate" placeholder="你要和同学们分享什么呢" id="texting" @focus="scrollIntoViewed" @blur="blurinput">
                    <div class="btn" @click="sendtext">发送</div>
                </div>
            </div>
            <!--全局遮罩层-->
            <div class="masked" v-if="maskFlag"></div>
            <!--额外操作框-->
            <transition  name="slideup">
                <div class="option-options" v-if="isoptions">
                    <div class="option-options-top">
                        <div class="line head">操作</div>
                        <div class="item line" :class="{active:setting.upperwall==1}">
                            <p>用户上墙讨论</p>
                            <div class="switch" @click="changeUserDiscuss">
                                <div class="round"></div>
                            </div>
                        </div>
                        <div class="item line" :class={active:setting.audio==1}>
                            <p>用户语音讨论</p>
                            <div class="switch" @click="changeUseAudiorDiscuss">
                                <div class="round"></div>
                            </div>
                        </div>
                        <div class="item line" :class="{active:setting.chat==1}">
                            <p>禁言模式</p>
                            <div class="switch" @click="changeUserProhibit">
                                <div class="round"></div>
                            </div>
                        </div>  
                        <div class="item line" @click="reload">
                            <p>刷新</p>
                        </div>
                        <div class="item" @click="endlive">
                            <p>结束直播</p>
                        </div>
                    </div>
                    <div class="option-options-bottom" @click="closeOptions">
                        返回
                    </div>
                </div>
            </transition>
        </template>
        <!--页面还没有出来的加载状态-->
        <template v-show="!renderFlag">
            <div class="loadings"v-show="!renderFlag"></div>
        </template>
        <template v-if="confirmMaskFlag">
            <div class="masked" v-show="confirmMaskFlag" @click="confirmMaskFlag=false"></div>
            <div class="audio-confirm">
                <div class="_confirm-body">
                    确定删除该消息?
                </div>
                <div class="_confirm-bottom">
                    <div class="_confirm-btn" @click="_confirmDelBan">删除并禁言用户</div>
                    <div class="_confirm-btn red" @click="_confirmDel">仅删除本消息</div>
                </div>
            </div>
        </template>
        <!--开始直播的弹框-->
        <template v-if="liveFlag">
        	<div class="masked" v-show="liveFlag" @click="liveFlag=false"></div>
            <div class="audio-confirm">
                <div class="_confirm-body">
                    	确定开启直播?
                </div>
                <div class="_confirm-bottom">
                    <div class="_confirm-btn" @click="_liveCancel">取消</div>
                    <div class="_confirm-btn red" @click="_liveSure">确定</div>
                </div>
            </div>
        </template>
        <template v-if="tConfirmMaskFlag">
            <div class="masked" v-show="tConfirmMaskFlag" @click="tConfirmMaskFlag=false"></div>
            <div class="audio-confirm">
                <div class="_confirm-body">
                    确定撤回该消息?
                </div>
                <div class="_confirm-bottom">
                    <div class="_confirm-btn" @click="_cancel">取消</div>
                    <div class="_confirm-btn red" @click="_sure">确定</div>
                </div>
            </div>
        </template>
        <!--讨论区-->
        <div class="newmask" v-if="talkFlag"></div>
        <transition  name="slideup">
            
            <template v-if="talkFlag">
                <div class="_talkwrap">
                    <div class="_talkheader">
                        <span>讨论区</span> 
                        <img src="<?php echo UOOT;?>Public/wechat/images/icon/close.png" alt="" class="closeimg" @click="closetalk">
                    </div>
                    <div class="_talkbody" id="talk"  @click="talkDefault">
                        <div class="_talkbody-time">{{nowtime}}</div>
                        <template v-if="talkArr.length>0">
                            <div class="item" v-for="(item, index) in talkArr" :key="index">
                                    <div class="userimg"> <img :src="item.avatar" alt="" style="margin-right: 10px"></div>
                                    <div class="item-info">
                                        <div class="item-name">{{item.membername}}</div>
                                        <div class="item-content pad10" v-if="item.type==0">{{item.interact}}</div>
                                        <div class="item-content pad10" v-if="item.type==1"> <img class="defaultpic" :src="item.defaultpic" alt="" @click="toshowimg(item)"></div>
                                        <div class="item-content pad5" style="width:60%;display: flex;align-items: center;" :class="{active:playtab==index}" v-if="item.type==2||item.type==3" @click="audioplay(index,item)">
                                            <img src="<?php echo UOOT;?>Public/wechat/images/audiolive/audiolive_icon_audiodoc.png" class="audio-icon g">
                                            <img src="<?php echo UOOT;?>Public/wechat/images/audiolive/audiolive_icon_audiodoc.gif" class="audio-icon l">
                                            <div class="playtime">{{item.audiotime}}"</div>
                                            <div class="playstatus" v-if="!item.audiostatus"></div>
                                        </div>
                                    </div>
                            </div>
                        </template>
                        <template v-else>
                                <div class="notalk">暂无讨论内容</div>
                        </template>
                    </div>
                </div>
            </template>
        </transition>
        <div class="masked" v-if="admireFlag"></div>
        
        
        <transition name="fade">
        	<template v-if="admireFlag">
	            <div class="admire-options">
	                <div class="head">
	                    <div>打赏作者</div>
	                    <img src="<?php echo UOOT ?>Images/common/close.png" alt="" @click="closeAdmire"/>
	                </div>
	                <div class="tabs" v-show="admireTab == 1">
	                    <div style="overflow: hidden;padding: 0 10px;">
	                        <div class="item">
	                            <div class="inner" data-money="1" @click="selectMoney">
	                                <span>1元</span>
	                            </div>
	                        </div>
	                        <div class="item">
	                            <div class="inner" data-money="2" @click="selectMoney">
	                                <span>2元</span>
	                            </div>
	                        </div>
	                        <div class="item">
	                            <div class="inner" data-money="5" @click="selectMoney">
	                                <span>5元</span>
	                            </div>
	                        </div>
	                        <div class="item">
	                            <div class="inner" data-money="10" @click="selectMoney">
	                                <span>10元</span>
	                            </div>
	                        </div>
	                        <div class="item">
	                            <div class="inner" data-money="20" @click="selectMoney">
	                                <span>20元</span>
	                            </div>
	                        </div>
	                        <div class="item">
	                            <div class="inner" data-money="50" @click="selectMoney">
	                                <span>50元</span>
	                            </div>
	                        </div>
	                    </div>
	                        <div class="titles" @click="changeOptions(2)">其他金额</div>
	                </div>
	                <div class="tabs" v-show="admireTab == 2">
	                    <div class="input-wrap"><span>￥</span><input type="number"  v-model="money"/></div>
	                    <div class="titles" @click="changeOptions(1)">固定金额</div>
	                    <div class="sure" @click="selectMoneyed">确定</div>
	                </div>
	            </div>
            </template>
        </transition>
         
        <template v-if="showimgFlag">
        	<div class="_showimg-wrap" @click="closeimg">
        		<img :src="showimg"/>
        	</div>
        </template>
    </div>
    <canvas id="canvas" style="display:none"></canvas>
    <audio src="" style="display: none" id="audios"></audio>
    <script src="<?php echo UOOT;?>Public/common/js/vue2.5.js"></script>
    <script src="<?php echo UOOT;?>Public/common/js/audioin.js?<?php echoHash(); ?>"></script>
	<div style='display:none'> <script type="text/javascript" src="https://s5.cnzz.com/z_stat.php?id=1277638296&web_id=1277638296"></script></div>
	
</body>
</html>