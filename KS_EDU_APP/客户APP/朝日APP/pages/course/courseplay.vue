<template>
	<view class="course-play">
		<view class="course-player" v-if="learnStatus == 0">
			<view class="course-player__live-status" >
				{{msg}}
			</view>
		</view>
		<view class="course-player" :class="expand ? 'course-player--expand' : ''" v-else-if="playType == 200 && learnStatus == 1">
			<scroll-view class="course-content-scroll" scroll-y="true">
				<view class="course-content" v-html="learnContent"></view>
			</scroll-view>
			<view class="course-content__expand" @click="toggleExpand">
				<image :src="baseUrl+'/static/images/course/icon-packup.png'" v-if="expand" />
				<image :src="baseUrl+'/static/images/course/icon-expand.png'" v-else />
			</view>
		</view>
		<view class="course-player" v-else-if="learnStatus == 1">
			<polyv-player 
				:video-option="videoOption"
				v-if="playType == 5"
				@onVodPlay="onVideoPlay"
				@onVodTimeUpdate="onVideoTimeupdate"
				@onVodPause="onVideoPause"
				@onVodEnd="onVideoEnded"
				@onVodContextChange="onVideoContextChange" />
			<video 
				:src="videoSrc"
				id="courseVideo"
				autoplay
				v-else-if="playType == 0"
				@play="onVideoPlay"
				@pause="onVideoPause"
				@ended="onVideoEnded"
				@timeupdate="onVideoTimeupdate" />
			
		</view>
		
		
		<ks-tabs :value.sync="currentTab" :tabList="tabs" @change="onTabChange"></ks-tabs>
		<view v-show="currentTab == 0">
			<view class="course-head" style="display: flex;">
				<view style="flex: 1;">
					<view class="course-title">
						{{title}}
					</view>
					<view class="course-period-num">
						共{{periodList.length}}个课时
					</view>
				</view>
				<view style="font-size: 14px; color:#888;display: flex;align-items: center;" v-if="state.isCache" @click="openDownload()">
					<text>下载</text>
					<image style="width: 20px;height: 20px;margin-left: 5px;" :src="state.SRC+'/KS_Inc/static/edu/images/down.png?1.0'"></image>
				</view>
			</view>
			<scroll-view class="catalog-slide" scroll-x="true" @scroll="onScroll" :scroll-left="scrollLeft" v-if="currentTab == 0">
			   <view class="catalog-slide-item" :class="current == period.periodid ? 'catalog-slide-item--active' : ''" v-for="(period,i) in periodList" :key="i" @click="periodTap(period)">
			       <view class="catalog-period">
					   <view class="catalog-period__head">
						   <view class="catalog-period__type">{{period.$type_name}}</view>
						   <view class="catalog-period__tip" v-if="period.islistening == 1">试听</view>
						</view>
			           <view class="catalog-title">{{i+1}}.{{period.periodname}}</view>
			           <!-- <view class="catalog-period__lock" style="background: url(../../static/course/lesson_icon_lock.png) no-repeat 50% 50%;" v-if="period.periodlock == 'true'"></view> -->
			       </view>
			   </view>
			</scroll-view>
		</view>
		<view class="course-chatroom" v-show="currentTab == 1">
			<polyv-chatroom skin="white" v-if="playType == 5 && learnStatus == 1 && liveStatus == 1" />
			<comment-list :proid="courseid" :periodid="current" :flag="2" :channelid="10002"  v-else-if="current" />
		</view>
		<view v-show="currentTab == 2">
			<course-exam  :course-id="courseid" ></course-exam>
		</view>
		<view v-show="currentTab == 3">
			<course-notes :course-id="courseid" :period-id="current" ></course-notes>
		</view>

	</view>
</template>

<script>
	import CommentList from '@/components/ks-components/comment-list/comment-list'
	import PlayerLearn from '@/utils/play.learn'
	import polyvChatroom from '@/lib/polyv/components/chatroom/chatroom';
	import polyvPlayer from '@/lib/polyv/components/player/player';
	import {getCourseCatalog,PlayVod,PlayLive} from '@/api/course'
	import {CourseExam} from 'components/ks-components/course-exam/course-exam'
	import {CourseNotes} from 'components/ks-components/course-notes/course-notes'
	export default {
		components:{
			polyvChatroom,
			polyvPlayer,
			CommentList,
			CourseExam,
			CourseNotes
		},
	
		data() {
			return {
				baseUrl:this.$store.state.SRC+"/config/app",
				courseid:0,
				newScrollLeft:0,
				expand:false,
				scrollLeft:0,
				videoOption:{},
				liveStatus:-1,
				/*学习权限*/
				learnStatus:-1,
				learnContent:'',
				msg:'',
				playType:-1,
				/*0是面授 1是点播，2是组合，5是直播 3套餐 4班级*/
				costype:-1,
				/*视频地址*/
				videoSrc:'',
				/*课程标题*/
				title:'',
				/*当前播放的课时id*/
				current:0,
				/*当前选项卡*/
				currentTab:0,
				oldPeriodList:[],
				/*课时列表*/
				periodList:[],
				/*选项卡列表*/
				tabs:['课时','讨论','试卷','笔记'],
				state:{}
			}
		},
		onLoad(options){
			this.$store.ready(state=>{
				this.state = state
				this.courseid = options.courseid
				//options.periodid = 251
				getCourseCatalog({
					courseid:options.courseid
				}).then(res=>{
					this.periodList = res.periods
					this.oldPeriodList = res.periods
					if(res.periods.length){
						let current = 0
						if(options.periodid){
							this.periodList.map((item,i)=>{
								if(item.periodid == options.periodid){
									current = i
								}
							})
						}
						this.periodTap(res.periods[current])
						this.$nextTick(()=>{
							const query = uni.createSelectorQuery().in(this);
							query.select('.catalog-slide-item--active').boundingClientRect(data => {
								this.scrollLeft = data.left
							}).exec();
						})
					}
					this.costype = res.catalogData.Course.teachway
					this.title = res.catalogData.CourseName
				})
			})
			
		},
		methods:{
			openDownload(){
				uni.navigateTo({
					url:`/pages/user/local/download?courseid=${this.courseid}`
				})
			},
			toggleExpand(){
				this.expand = !this.expand
			},
			setMsg(msg){
				this.learnStatus = 0
				this.msg = msg
			},
			getPlayVod(period){
				switch(Number(period.teachWay)){
					case 5:
						/*直播*/
						PlayLive({
							courseid:this.courseid,
							periodid:period.periodid
						}).then(res=>{
							if(res.result){
								this.liveStatus = Number(res.liveStatus)
								this.learnStatus = 1
								switch(this.liveStatus){
									case 0:
										this.setMsg('直播未开始')
										break
									case 1:
										switch(Number(res.liveType)){
											case 1:
												this.handlerPolyvLive(this.liveStatus,res.roomId,res.vid)
												break
											default:
												this.setMsg('不支持的直播类型')
										}
										break
									case 2:
										switch(Number(res.playType)){
											case 0:
												/*本地回放*/
												this.videoSrc = this.$handleSrc(res.vid)
												this.playType = 0
												break
											case 5:
												this.handlerPolyvLive(this.liveStatus,res.roomId,res.vid)
												break
											default:
												this.setMsg('直播已结束')
										}
										break
								}
								
									
							}else{
								this.setMsg(res.msg)
								
							}
						})
						break
					default:
						switch(Number(period.type)){
							case 0:
								/**视频 */
								PlayVod({
									courseid:this.courseid,
									periodid:period.periodid
								}).then(res=>{
									let audition = 0
									if(period.islistening == 1){
										audition = period.listeningSeconds
									}
									if(res.result){
										this.playType = Number(res.playType)
										this.learnStatus = 1
										switch(Number(res.playType)){
											case 5:
												/*保利威*/
												this.videoOption = {
													mode: 'vod',
													vid: res.vid,
													ts: res.getTs,
													sign:res.getSign
												}
												this.playType = 5
												this.createLearnExample({
													audition,
													courseid:this.courseid,
													periodid:this.current,
													costype:this.costype
												})
												break
											case 0:
												/*本地视频*/
												this.videoSrc = res.vid
												this.createLearnExample({
													audition,
													courseid:this.courseid,
													periodid:this.current,
													costype:this.costype
												})
												this.$nextTick(()=>{
													let vodContext = uni.createVideoContext("courseVideo", this)
													this.onVideoContextChange({
														videoContext:vodContext
													})
												})
												break
											default:
												this.setMsg('不支持的视频来源')
												break
											
										}
									}else{
										this.setMsg(res.msg)
										
									}
								})
		                        break
		                    case 1:
								/**音频 */
								this.setMsg('暂不支持音频课件预览')
		                        break
		                    case 2:
								/**图文 */
								this.playType = 200
								this.learnContent = period.intro
								this.learnStatus = 1
								this.createLearnExample({
									type:2,
									courseid:this.courseid,
									periodid:this.current,
									costype:this.costype
								})
		                        break
		                    case 3:
								/**pdf */
								this.setMsg('暂不支持PDF课件预览')
							default:
								this.setMsg('不支持的课件类型')
						}
				}
			},
			/**
			 * 配置保利威直播
			 * @param {Number} liveStatus 
			 * @param {String} channelId 
			 * @param {String} vid 
			 */
			handlerPolyvLive(liveStatus,channelId,vid){
				switch(liveStatus){
					case 0:
						this.setMsg('直播未开始')
					case 1:
						this.$store.ready(state=>{
							let openId = state.isLogin == 1 ? state.userInfo.UserID : Math.ceil(Math.random() * 10000000000000)
							let userName = state.isLogin == 1 ? (state.userInfo.RealName || state.userInfo.UserName) : '游客'+openId
							let avatarUrl = state.isLogin == 1 ? state.userInfo.UserFace : ''
							this.$plvInit({
								channelId,
								userName,
								avatarUrl,
								openId
							}).then(({ detail, chat }) => {
								this.playType = 5
								this.videoOption = {
									mode: 'live',
									uid: detail.userId,
									cid: detail.roomId,
									isAutoChange: false
								}
							})
						})
						
						break
					case 2:
						if(!vid){
							this.setMsg('直播已结束')
							return
						}
						/**保利威回放*/
						this.videoOption = {
							mode: 'vod',
							vid
						}
						this.playType = 5
						break
				}
			},
			/**
			 * 滚动容器
			 */
			onScroll(e){
				this.newScrollLeft = e.detail.scrollLeft
			},
			/**
			 * 选项卡变化
			 */
			onTabChange(e){
				if(e.tab === '课时'){
					this.$nextTick(()=>{
						this.scrollLeft = this.newScrollLeft
					})
					
				}
			},
			/**
			 * 课时播放
			 */
			periodTap(period){
				this.current = period.periodid
				if(period.$isCanLearn == 1){
					this.getPlayVod(period)
				}else{
					this.setMsg('需要购买后才能学习该课时')
				}
			},
			/**
			 * 视频对象变化
			 */
			onVideoContextChange(e){
				this.videoContext = e.videoContext
			},
			/**
			 * 创建学习进度监听实例
			 * @param {Object} options
			 */
			createLearnExample(options){
				options.onAuditionEnded = ()=>{
					this.videoContext.stop()
					this.setMsg('试听结束，购买课程后可继续观看')
				}
				options.onSaveCallback = (msg)=>{
					if (msg == "nopower") {
						this.videoContext.stop()
						this.setMsg('对不起，您的学习次数已到，无权进入学习')
					}
				}
				if(this.playLearnExample){
					this.playLearnExample.init(options)
				}else{
					this.playLearnExample = new PlayerLearn(options)
				}
			},
			/**
			 * 视频监听
			 */
			onVideoPlay(e){
				this.playLearnExample && this.playLearnExample.onplay(e)
			},
			/**
			 * 视频暂停
			 */
			onVideoPause(e){
				this.playLearnExample && this.playLearnExample.onpause(e)
			},
			/**
			 * 视频播放结束
			 */
			onVideoEnded(e){
				this.playLearnExample && this.playLearnExample.onended(e)
				let currentIndex = 0
				this.periodList.map((item,i)=>{
					if(item.periodid == this.current){
						currentIndex = i
					}
				})
				let nextPeriod = this.periodList[currentIndex+1]
				if(nextPeriod && nextPeriod.$isCanLearn == 1){
					this.periodTap(nextPeriod)
				}
			},
			/**
			 * 视频进度更新
			 */
			onVideoTimeupdate(e){
				this.playLearnExample && this.playLearnExample.ontimeupdate(e)
			}
		},
		destroyed(){
			this.$plvDestory()
		}
	}
</script>

<style lang="scss">
	.course-play{
		min-height: 100vh;
		background: #fff;
	}
	.course-chatroom {
		height: calc(100vh - 44px - 420rpx);
	}
	.course-head{
		padding: 15px;
	}
	.course-title{
		font-size: 16px;
		font-weight: bold;
		color:$uni-text-color;
	}
	.course-period-num{
		font-size: 14px;
		line-height: 24px;
		color:$uni-color-grey;
		margin-top: 5px;
	}
	.course-player{
	  height: 420rpx;
	  overflow: hidden;
	  position: relative;
	  background: #000;
	  video{
		  width: 100%;
		  height: 100%;
	  }
	}
	
	.course-player__live-status{
		display: flex;
		justify-content: center;
		align-items: center;
		height: 100%;
		position: absolute;
		width: 100%;
		left: 0;
		top:0;
		color:rgba(255,255,255,0.5);
	}
	.course-player--expand{
		height: 100vh;
	}
	.course-content-scroll{
		overflow-y: auto;
		background: #fff; 
		height: 100%;
	}
	.course-content{
		padding: 20px;
	}
	.course-content__expand{
		position:absolute;
		width: 26px;
		height: 26px;
		right: 10px;
		bottom: 10px;
		padding: 5px;
		text-align: center;
		image{
			width: 100%;
			height: 100%;
		}
	}
	
	/**课时列表 */
	.catalog-slide {
	    padding:15px 15px 15px 0;
		position: relative;
		white-space: nowrap;
		overflow-x: auto;
	}
	.catalog-slide::after{
		content: '';
		width: 100%;
		height: 1px;
		background: #ddd;
		position:absolute;
		left: 15px;
		top: 0;
		transform: scaleY(0.5);
		
	}
	
	.catalog-slide-item{
		display: inline-block;
		width: 360rpx;
		position: relative;
		white-space: normal;
		margin-left: 15px;
		vertical-align: text-top;
	}
	.catalog-slide .catalog-period{
	    padding: 10px 10px 20px 10px;
	    border: 1px solid #f2f4f6;
	    background: #f2f4f6;
	    border-radius: 4px;
	}
	.catalog-slide .catalog-title{
	    border-bottom: 0px;
	    line-height: 20px;
	    font-size: 14px;
	    height: 60px;
	    overflow: hidden;
	
	}
	.catalog-slide .catalog-period__head{
		height: 20px;
	    line-height: 20px;
		display: flex;
		margin-bottom: 10px;
	}
	.catalog-slide .catalog-period__type{
	    background: #8891a6;
	    color:#fff;
	    font-size: 10px;
		padding: 0 10px;
		position: relative;
		left:-10px;
	}
	.catalog-slide .catalog-period__tip{
		flex: 1;
		text-align: right;
		font-size: 12px;
		color:$uni-color-success;
	}
	.catalog-slide-item--active .catalog-period{
	    border: 1px solid $uni-color-primary;
	    background: #fff;
	}
	.catalog-slide-item--active .ks-catalog-title{
	    color:$uni-color-primary;
	}
	.catalog-slide-item--active .catalog-period__type{
	    background: $uni-color-primary;
	    color:#fff;
	}
	.catalog-slide .catalog-period__lock{
	    width: 20px;
	    height: 20px;
	    
	    background-size: 20px;
	    position: absolute;
	    right: 10px;
	    bottom: 10px;
	}
	
</style>
