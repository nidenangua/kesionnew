<template>
	<view class="ks-comment-wrap" @click="showEmoji = false;uploads = false">
	
		<scroll-view class="ks-comment" @scrolltolower="reachBottom" scroll-y>
			<view class="ks-comment-list" :style="{paddingBottom:showEmoji&&'313px'}">
				<view class="ks-comment__li" data-topicid="item.topicid" v-for="(item,i) in list" :key="i">
					<view class="ks-comment__box ks-comment__first">

						<ks-image radius="50%" class="ks-imageuser" style="width: 43px;height: 43px;" type="user" :src="item.userface"></ks-image>
						<view class="ks-comment__user-info">
							<view class="ks-comment__username">{{item.username}}</view>
							<view class="ks-comment__content" v-html="item.content"></view>
							<view class="ks-comment-image">
								<view class="comment-image" :style="item.showpics.length>1&&'width: 80px;height:80px'" v-for="(site,s) in item.showpics" :key="s" @click="look(item.showpics,s)">
									<ks-image :src="site.pic_url" class="ks-image"></ks-image>
								</view>
							</view>
							<view class="ks-comment__bottom">
								<text style="font-size: 13px;color: #bcc3cc;line-height: 13px;margin-right: 20px;">{{item.adddate}}</text>
								<!-- <text style="font-size: 13px;color: #bcc3cc;line-height: 13px;">{{item.postnum}}个回答</text> -->
							</view>
						</view>
					</view>
					<view class="ks-comment__reply"></view>
				</view>
				<uni-load-more :status="moreStatus" v-if="pageCount > 0"></uni-load-more>
				<ks-empty type="tips" v-else>没有找到任何讨论！</ks-empty>
			</view>

		</scroll-view>
		
		<view class="ks-comment-foot">
			<view style="padding: 10px 0;display: flex;align-items: center;justify-content: center;">
				<view class="ks-comment__image"  @click.stop="uploads = !uploads;showEmoji=false">
					<image  :src="state.SRC+'/KS_Inc/static/edu/images/add.png'" />
				</view>
				<view class="ks-comment__expression"  @click.stop="showEmoji = !showEmoji;uploads=false">
					<image  :src="state.SRC+'/KS_Inc/static/edu/images/lesson_btn_face.png?2.0'" />
				</view>
				
				<view class="ks-comment__input">
					<input confirm-type="send" return-key-type="send" style="height: 20px;font-size: 14px;line-height: 20px;" v-model="textarea" placeholder="我也来聊几句..." />
				</view>
				<button type="primary" style="margin: 0 10px;height: 33px;line-height: 33px; font-size:14px;" @click="save()">发送</button>
			</view>
			<view class="ks-upload-box" v-if="uploads" @click.stop="uploads = true">
				<view class="clearfix">
					<view id="ks-upload-showimage">
						<view class="ks-upload-showui" >
							<view class="ks-upload-showui__li" v-for="(item,i) in picList" :key="i">
								<view class="ks-upload-showview" @click="deletePic(i)">
									<image class="ks-upload-delete" :src="state.SRC+'/KS_Inc/static/edu/images/delete.svg'" />
								</view>
								<image id="ks-upload-image" style="width: 80px;height: 80px;" class="ks-upload-showimage" :src="item" />
							</view>
							<view class="ks-upload-upimage ks-upload-showui__li" @click="uploadPic()" v-if="picList.length < 9">
								<image style="width:26px;height:26px" :src="state.SRC+'/KS_Inc/static/edu/images/addimage.png'" />
								上传图片
							</view>
						</view>
					</view>
				</view>
			</view>
			<scroll-view scroll-y v-if="showEmoji">
				<view class="ks-emoji" @click.stop="showEmoji = true">
					<view class="ks-emoji__item" @click.stop="setEmoji(item.name)" v-for="(item,i) in emojiList" :key="i">
						<image :src="state.SRC+item.url" class="ks-emoji-image" >
						</image>
					</view>	
				</view>
			</scroll-view>
		</view>
	</view>
</template>

<script>
	import {UniLoadMore} from 'components/uni/uni-load-more/uni-load-more'
	
	import {
		UploadFile
	} from 'api/course'
	import {
		SaveAskTopic,
		GetUserAskTopList
	} from 'api/course'
	export default {
		components: {
			UniLoadMore
		},
		props: {
			//课程id
			proid: Number,
			//课时id
			periodid: Number,
			//-1全部，1是班级,0问答，2课程，3教师，4商城5商城拼团,6点播播放页，7直播播放页
			flag: Number,
			//模型：10000问答，10001班级，10002课程，10003教师，10004点播播放页，10005播放页
			channelid: Number,
			//表示是否是在个人中心调用，from=1表示个人中心，from=0表示前台界面
			from: Number,
			//触发滚动加载
			pageChange: Number
		},
		data() {
			return {
				state: {},
				switchs: true,
				showEmoji: false,
				textarea: '',
				uploads: false,
				picList: [],
				page: 1,
				pageCount: 1,
				moreStatus: '',
				list: [],
				emojiList:[
					{name:'[微笑]',url:'/KS_Inc/static/edu/images/emoji/smiley_0.png'},
					{name:'[撇嘴]',url:'/KS_Inc/static/edu/images/emoji/smiley_1.png'},
					{name:'[色]',url:'/KS_Inc/static/edu/images/emoji/smiley_2.png'},
					{name:'[发呆]',url:'/KS_Inc/static/edu/images/emoji/smiley_3.png'},
					{name:'[得意]',url:'/KS_Inc/static/edu/images/emoji/smiley_4.png'},
					{name:'[流泪]',url:'/KS_Inc/static/edu/images/emoji/smiley_5.png'},
					{name:'[害羞]',url:'/KS_Inc/static/edu/images/emoji/smiley_6.png'},
					{name:'[闭嘴]',url:'/KS_Inc/static/edu/images/emoji/smiley_7.png'},
					{name:'[睡觉]',url:'/KS_Inc/static/edu/images/emoji/smiley_8.png'},
					{name:'[大哭]',url:'/KS_Inc/static/edu/images/emoji/smiley_9.png'},
					{name:'[尴尬]',url:'/KS_Inc/static/edu/images/emoji/smiley_10.png'},
					{name:'[怒]',url:'/KS_Inc/static/edu/images/emoji/smiley_11.png'},
					{name:'[调皮]',url:'/KS_Inc/static/edu/images/emoji/smiley_12.png'},
					{name:'[大笑]',url:'/KS_Inc/static/edu/images/emoji/smiley_13.png'},
					{name:'[惊讶]',url:'/KS_Inc/static/edu/images/emoji/smiley_14.png'},
					{name:'[难过]',url:'/KS_Inc/static/edu/images/emoji/smiley_15.png'},
					{name:'[酷]',url:'/KS_Inc/static/edu/images/emoji/smiley_16.png'},
					{name:'[冷汗]',url:'/KS_Inc/static/edu/images/emoji/smiley_17.png'},
					{name:'[抓狂]',url:'/KS_Inc/static/edu/images/emoji/smiley_18.png'},
					{name:'[吐]',url:'/KS_Inc/static/edu/images/emoji/smiley_19.png'},
					{name:'[偷笑]',url:'/KS_Inc/static/edu/images/emoji/smiley_20.png'},
					{name:'[可爱]',url:'/KS_Inc/static/edu/images/emoji/smiley_21.png'},
					{name:'[白眼]',url:'/KS_Inc/static/edu/images/emoji/smiley_22.png'},
					{name:'[傲慢]',url:'/KS_Inc/static/edu/images/emoji/smiley_23.png'},
					{name:'[饥饿]',url:'/KS_Inc/static/edu/images/emoji/smiley_24.png'},
					{name:'[困]',url:'/KS_Inc/static/edu/images/emoji/smiley_25.png'},
					{name:'[惊恐]',url:'/KS_Inc/static/edu/images/emoji/smiley_26.png'},
					{name:'[流汗]',url:'/KS_Inc/static/edu/images/emoji/smiley_27.png'},
					{name:'[憨笑]',url:'/KS_Inc/static/edu/images/emoji/smiley_28.png'},
					{name:'[大兵]',url:'/KS_Inc/static/edu/images/emoji/smiley_29.png'},
					{name:'[奋斗]',url:'/KS_Inc/static/edu/images/emoji/smiley_30.png'},
					{name:'[咒骂]',url:'/KS_Inc/static/edu/images/emoji/smiley_31.png'},
					{name:'[疑问]',url:'/KS_Inc/static/edu/images/emoji/smiley_32.png'},
					{name:'[嘘]',url:'/KS_Inc/static/edu/images/emoji/smiley_33.png'},
					{name:'[晕]',url:'/KS_Inc/static/edu/images/emoji/smiley_34.png'},
					{name:'[折磨]',url:'/KS_Inc/static/edu/images/emoji/smiley_35.png'},
					{name:'[衰]',url:'/KS_Inc/static/edu/images/emoji/smiley_36.png'},
					{name:'[骷髅]',url:'/KS_Inc/static/edu/images/emoji/smiley_37.png'},
					{name:'[敲打]',url:'/KS_Inc/static/edu/images/emoji/smiley_38.png'},
					{name:'[再见]',url:'/KS_Inc/static/edu/images/emoji/smiley_39.png'},
					{name:'[擦汗]',url:'/KS_Inc/static/edu/images/emoji/smiley_40.png'},
					{name:'[抠鼻]',url:'/KS_Inc/static/edu/images/emoji/smiley_41.png'},
					{name:'[鼓掌]',url:'/KS_Inc/static/edu/images/emoji/smiley_42.png'},
					{name:'[糗大了]',url:'/KS_Inc/static/edu/images/emoji/smiley_43.png'},
					{name:'[坏笑]',url:'/KS_Inc/static/edu/images/emoji/smiley_44.png'},
					{name:'[左哼哼]',url:'/KS_Inc/static/edu/images/emoji/smiley_45.png'},
					{name:'[右哼哼]',url:'/KS_Inc/static/edu/images/emoji/smiley_46.png'},
					{name:'[哈欠]',url:'/KS_Inc/static/edu/images/emoji/smiley_47.png'},
					{name:'[鄙视]',url:'/KS_Inc/static/edu/images/emoji/smiley_48.png'},
					{name:'[委屈]',url:'/KS_Inc/static/edu/images/emoji/smiley_49.png'},
					{name:'[快哭了]',url:'/KS_Inc/static/edu/images/emoji/smiley_50.png'},
					{name:'[阴险]',url:'/KS_Inc/static/edu/images/emoji/smiley_51.png'},
					{name:'[亲亲]',url:'/KS_Inc/static/edu/images/emoji/smiley_52.png'},
					{name:'[吓]',url:'/KS_Inc/static/edu/images/emoji/smiley_53.png'},
					{name:'[可怜]',url:'/KS_Inc/static/edu/images/emoji/smiley_54.png'},
					{name:'[菜刀]',url:'/KS_Inc/static/edu/images/emoji/smiley_55.png'},
					{name:'[西瓜]',url:'/KS_Inc/static/edu/images/emoji/smiley_56.png'},
					{name:'[啤酒]',url:'/KS_Inc/static/edu/images/emoji/smiley_57.png'},
					{name:'[篮球]',url:'/KS_Inc/static/edu/images/emoji/smiley_58.png'},
					{name:'[乒乓球]',url:'/KS_Inc/static/edu/images/emoji/smiley_59.png'},
					{name:'[咖啡]',url:'/KS_Inc/static/edu/images/emoji/smiley_60.png'},
					{name:'[饭]',url:'/KS_Inc/static/edu/images/emoji/smiley_61.png'},
					{name:'[猪头]',url:'/KS_Inc/static/edu/images/emoji/smiley_62.png'},
					{name:'[玫瑰]',url:'/KS_Inc/static/edu/images/emoji/smiley_63.png'},
					{name:'[凋谢]',url:'/KS_Inc/static/edu/images/emoji/smiley_64.png'},
					{name:'[示爱]',url:'/KS_Inc/static/edu/images/emoji/smiley_65.png'},
					{name:'[爱心]',url:'/KS_Inc/static/edu/images/emoji/smiley_66.png'},
					{name:'[心碎]',url:'/KS_Inc/static/edu/images/emoji/smiley_67.png'},
					{name:'[蛋糕]',url:'/KS_Inc/static/edu/images/emoji/smiley_68.png'},
					{name:'[闪电]',url:'/KS_Inc/static/edu/images/emoji/smiley_69.png'},
					{name:'[炸弹]',url:'/KS_Inc/static/edu/images/emoji/smiley_70.png'},
					{name:'[刀]',url:'/KS_Inc/static/edu/images/emoji/smiley_71.png'},
					{name:'[足球]',url:'/KS_Inc/static/edu/images/emoji/smiley_72.png'},
					{name:'[瓢虫]',url:'/KS_Inc/static/edu/images/emoji/smiley_73.png'},
					{name:'[便便]',url:'/KS_Inc/static/edu/images/emoji/smiley_74.png'},
					{name:'[月亮]',url:'/KS_Inc/static/edu/images/emoji/smiley_75.png'},
					{name:'[太阳]',url:'/KS_Inc/static/edu/images/emoji/smiley_76.png'},
					{name:'[礼物]',url:'/KS_Inc/static/edu/images/emoji/smiley_77.png'},
					{name:'[拥抱]',url:'/KS_Inc/static/edu/images/emoji/smiley_78.png'},
					{name:'[强]',url:'/KS_Inc/static/edu/images/emoji/smiley_79.png'},
					{name:'[弱]',url:'/KS_Inc/static/edu/images/emoji/smiley_80.png'},
					{name:'[握手]',url:'/KS_Inc/static/edu/images/emoji/smiley_81.png'},
					{name:'[胜利]',url:'/KS_Inc/static/edu/images/emoji/smiley_82.png'},
					{name:'[抱拳]',url:'/KS_Inc/static/edu/images/emoji/smiley_83.png'},
					{name:'[勾引]',url:'/KS_Inc/static/edu/images/emoji/smiley_84.png'},
					{name:'[拳头]',url:'/KS_Inc/static/edu/images/emoji/smiley_85.png'},
					{name:'[差劲]',url:'/KS_Inc/static/edu/images/emoji/smiley_86.png'},
					{name:'[爱你]',url:'/KS_Inc/static/edu/images/emoji/smiley_87.png'},
					{name:'[NO]',url:'/KS_Inc/static/edu/images/emoji/smiley_88.png'},
					{name:'[OK]',url:'/KS_Inc/static/edu/images/emoji/smiley_89.png'},
					{name:'[爱情]',url:'/KS_Inc/static/edu/images/emoji/smiley_90.png'},
					{name:'[飞吻]',url:'/KS_Inc/static/edu/images/emoji/smiley_91.png'},
					{name:'[跳跳]',url:'/KS_Inc/static/edu/images/emoji/smiley_92.png'},
					{name:'[发抖]',url:'/KS_Inc/static/edu/images/emoji/smiley_93.png'},
					{name:'[怄火]',url:'/KS_Inc/static/edu/images/emoji/smiley_94.png'},
					{name:'[转圈]',url:'/KS_Inc/static/edu/images/emoji/smiley_95.png'},
					{name:'[磕头]',url:'/KS_Inc/static/edu/images/emoji/smiley_96.png'},
					{name:'[回头]',url:'/KS_Inc/static/edu/images/emoji/smiley_97.png'},
					{name:'[跳绳]',url:'/KS_Inc/static/edu/images/emoji/smiley_98.png'},
					{name:'[挥手]',url:'/KS_Inc/static/edu/images/emoji/smiley_99.png'},
					{name:'[激动]',url:'/KS_Inc/static/edu/images/emoji/smiley_100.png'},
					{name:'[街舞]',url:'/KS_Inc/static/edu/images/emoji/smiley_101.png'},
					{name:'[献吻]',url:'/KS_Inc/static/edu/images/emoji/smiley_102.png'},
					{name:'[左太极]',url:'/KS_Inc/static/edu/images/emoji/smiley_103.png'},
					{name:'[右太极]',url:'/KS_Inc/static/edu/images/emoji/smiley_104.png'}
				]
			}
		},
		watch: {
			pageChange(val) {
				this.reachBottom()
			},
			periodid(){
				this.getList()
			}
		},
		methods: {
			look(list,i) {
				let _list = []
				list.map(item=>{
					_list.push(item.pic_src)
				})
				uni.previewImage({
					urls:_list,
					current:_list[i]
				})
			},
			/**
			 * 上传文件
			 */
			upload(list = [],index = 0){
				return new Promise(resolve=>{
					if(list[index]){
						uni.showLoading({
							title:'上传第'+(index+1)+'张图片'
						})
						uni.uploadFile({
							url:this.state.SRC+'/webapi/School/UploadFile',
							filePath:list[index],
							fileType:'image',
							name:'file',
							formData:{
								apptoken:this.state.appToken,
								userid:this.state.userId
							},
							success:res=>{
								let data = JSON.parse(res.data)
								if(data.result){
									list[index] = data.fileUrl
									this.upload(list,index+1).then(list=>{
										resolve(list)
									})
								}else{
									this.$msg(data.msg)
								}
							}
						})
					}else{
						resolve(list)
					}
				})
			},
			/*滚动加载*/
			reachBottom() {
				this.page++
				if (this.page <= this.pageCount) {
					this.getList(this.page)
				}
			},
			save() {
				if (this.state.isLogin != 1) {
					uni.showToast({
						title: '请登录',
						icon: 'none'
					})
					setTimeout(() => {
						uni.navigateTo({
							url: '/pages/user/login/index'
						})
					}, 1500)
				} else {
					if (this.textarea) {
						this.upload(this.picList).then(list=>{
							SaveAskTopic({
								content: this.textarea,
								flag: this.flag,
								proid: this.proid,
								periodid: this.periodid,
								channelid: this.channelid,
								photolist: list.toString(),
								Recommend: this.switchs ? 1 : 0
							}).then(res => {
								if (res.result) {
									uni.showToast({
										title: '发布成功'
									})
									this.textarea = ''
									this.uploads = false
									this.showEmoji = false
									this.picList = []
									this.getList()
								} else {
									this.textarea = ''
									this.picList = []
									uni.showToast({
										title: res.msg,
										icon: 'none'
									})
								}
							})
						})
						
					} else {
						this.$msg('请输入需要咨询的问题')
					}

				}

			},
			setEmoji(str) {
				this.textarea = this.textarea + str
			},
			uploadPic() {
				uni.chooseImage({
					count: 9-this.picList.length,
					sizeType: ['original', 'compressed'],
					success: res => {
						this.picList = this.picList.concat(res.tempFilePaths)
					}
				});
			},
			deletePic(i) {
				this.picList = this.picList.filter((item, t) => {
					if (i != t) {
						return item
					}
				})
			},
			getList(p = 1) {
				this.page = p
				if (this.page == 1) {
					this.list = []
				}
				this.moreStatus = 'loading'
				
				GetUserAskTopList({
					page: this.page,
					pagesize: 10,
					flag: this.flag,
					channelid: this.channelid,
					showstatus: -1,
					proid: this.proid,
					periodid: this.periodid,
					from: this.from
				}).then(res => {
					uni.stopPullDownRefresh();
					this.pageCount = res.pagecount
					if (this.page >= this.pageCount) {
						this.moreStatus = 'noMore'
					} else {
						this.moreStatus = 'more'
					}
					if (res.result) {
						if(res.data.length){
							res.data.map(item=>{
								if (item.content.match(/\[[\u4e00-\u9fa5]+\]/g) && item.content.match(/\[[\u4e00-\u9fa5]+\]/g).length) {
									item.content.match(/\[[\u4e00-\u9fa5]+\]/g).map((eitem)=> {
										for (var i = 0; i < this.emojiList.length; i++) {
											if (this.emojiList[i].name == eitem) {
												item.content = item.content.replace( eitem,`<img src="${this.state.SRC}${this.emojiList[i].url}" style="width:20px;height:20px;" class="ks-emoji-image" alt="${this.emojiList[i].name}" />`)
											}
										}
									
									})
								}
							})
						}
						this.list = this.list.concat(res.data)
					}
				})
			}
		},
		mounted() {

			this.$store.ready(state => {
				this.state = state
				this.getList()
			})
		}
	}
</script>

<style scoped>
	.ks-imageuser {
		position: absolute;
		top: 0;
		left: 0;
		height: 43px; 
		width: 43px;
	}
	.ks-comment-wrap{
		position: relative;
		height: 100%;
		padding: 0 15px ;
		box-sizing: border-box;
	}
	/*讨论*/
	.ks-comment {
		margin: 0;
		padding: 0;
		height: 100%;
		
	}

	.ks-comment__expression{
		margin-right:10px;
		
		position: relative;
	}
	.ks-comment__image {
		margin: 0 10px;
		position: relative;
	}
	.ks-comment__input{
		flex: 1;
		background: #f6f6f6;
		padding: 5px 10px;
		border-radius: 5px;
	}

	.ks-comment__expression image,
	.ks-comment__image image {
		width: 22px;
		height: 22px;
		vertical-align: middle;
	}

	.ks-comment-image .comment-image {
		display: inline-block;
		width: 180px;
		height: 120px;
		overflow: hidden;
		margin-right: 10px;
		margin-bottom: 10px;
		border-radius: 4px;
	}

	.ks-comment-image .comment-image .ks-image {
		width: 100%;
		height: 100%;
		object-fit: cover;
	}

	.ks-comment-list {
		margin-top: 10px;
		padding-bottom: 53px;
	}

	.ks-comment__li {
		padding-top: 20px;
		border-bottom: 1px solid #eee;
	}

	.ks-comment__box {
		position: relative;
		padding-left: 54px;
		padding-bottom: 20px;
		margin-bottom: 20px;
		border-bottom: 1px solid #eee;
	}
	.ks-imageuser {
		position: absolute;
		top: 0;
		left: 0;
		height: 43px;
		width: 43px;
		
	}
	.ks-comment__box {
		margin-bottom: 0;
		border-bottom: 0;
	}

	.ks-comment__first {
		margin-bottom: 0;
		border-bottom: 0;
	}

	.ks-comment__avator {
		width: 43px;
		height: 43px;
		position: absolute;
		left: 0;
		top: 0;
		overflow: hidden;
		border-radius: 43px;
	}

	.ks-comment__avator image {
		width: 100%;
		height: 100%;
		object-fit: cover;
	}

	.ks-comment__username {
		font-weight: normal;
		margin-bottom: 10px;
		color: #666;
		line-height: 14px;
		font-size: 14px;
	}

	.ks-comment__content {
		line-height: 20px;
		font-size: 14px;
		margin-bottom: 15px;
		color: #666;
	}

	.ks-comment__bottom {
		color: #bcc3cc;
		line-height: 13px;
		font-size: 13px;
		
	}

	.ks-comment__bottom text {
		margin-right: 20px;
		color: #bcc3cc;
		font-size: 13px;
		line-height: 13px;
	}

	.ks-comment-look {
		color: #3c81f9;
		cursor: pointer;
	}

	.ks-comment__reply {
		background: #f5f7fa;
		padding: 20px 20px 0;
		margin-bottom: 20px;
		display: none;
	}

	.ks-no-reply {
		padding: 0 !important;
		margin-bottom: 0 !important;
	}
	/*表情*/
	.ks-emoji {
		width: 100%;
		box-sizing: border-box;
		padding: 12px;
		box-shadow: 0 1px 20px 0 rgba(0, 0, 0, .1);
		z-index: 99;
		background: #EDEDED;
		height: 160px;
		overflow: auto;
		transition: width 2s;
		display: flex;
		flex-wrap: wrap;
	}

	.ks-emoji__item {
		height: 30px;
		width: 30;
		padding: 3px;
		cursor: pointer;
		display: flex;
		justify-content: center;
		align-items: center;
	}
	.ks-emoji-image {
		width: 24px;
		height: 24px;
	}


	.ks-emoji__item:hover {
		background: #f3f3f3;
	}

	/*图片上传*/
	.ks-upload-box {
		padding: 10px;
	}

	.ks-upload-btn {
		padding: 9px 0;
		background: #3c81f9;
		color: #FFFFFF;
		border-radius: 3px;
		border: 0;
		margin-top: 15px;
		width: 100px;
	}

	.ks-upload-upimage {
		position: relative;
		box-sizing: border-box;
		border: 1px dashed #ddd;
		font-size: 12px;
		text-align: center;
		color: #999;
	}
	.ks-upload-upimage image{
		display: block;
		margin:10px auto auto;
	}

	.ks-upload-showui__li {
		width: 130rpx;
		height: 130rpx;
		position: relative;
		overflow: hidden;
		margin:6rpx;
		float: left;
		border-radius: 10rpx;
		overflow: hidden;
	}

	.ks-upload-showui__li image.ks-upload-showimage {
		position: absolute;
		text-align: center;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
		z-index: 6;
		width: 100%;
		height: 100%;
		object-fit: cover;
	}

	.ks-upload-showview {
		position: absolute;
		z-index: 9;
		bottom: 0;
		width: 100%;
		padding: 3px;
		text-align: center;
		box-sizing: border-box;
		background: rgba(0, 0, 0, .6);
	}

	.ks-upload-showview image {
		width: 16px;
		height: 16px;
		cursor: pointer;
		margin: 0 5px;
	}

	.ks-upload-showui li:first-child image.ks-upload-left {
		opacity: .6;
		cursor: no-drop;
	}

	.ks-upload-showui li:last-child image.ks-upload-right {
		opacity: .6;
		cursor: no-drop;
	}

	.ks-upload-oneright {
		opacity: .6;
		cursor: no-drop !important;
	}

	/* 播放页的问答 */
	.ks-play-comment .ks-emoji {
		width: 320px;
		left: -102px;
		padding: 14px;
	}

	.ks-play-comment .comment-image {
		width: 50px;
		height: 50px;
	}
	.ks-comment-foot{
		position: fixed;
		bottom: 0;
		background: #fff;
		z-index: 888;
		width: 100%;
		left: 0;
		overflow: hidden;
	}
</style>
