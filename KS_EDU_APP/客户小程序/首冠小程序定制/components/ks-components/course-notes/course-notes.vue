<template>
	<div style="background: #fff;padding: 0 20px;">
		<div class="player-notes-filter">
			<button :type="active == 0 &&'primary'" @click="changeTab(0)">我的笔记</button>
			<button :type="active == 1 &&'primary'" @click="changeTab(1)">同学笔记</button>

		</div>
		<div class="player-notes-list">
			<div class="player-notes-list__item" v-for="(item,i) in list" :key="i">
				<div class="player-notes-list__avatar ks-image">
					<ks-image type="user" style="width: 32px;height: 32px;" :src="item.UserFace" />
				</div>
				<div class="player-notes-list__name">
					<span class="player-notes-list__time">
						{{item.$time}}
					</span>
					{{item.username}}
				</div>
				<div class="player-notes-list__content">
					{{item.bjcontent}}
				</div>
			</div>
		
			<ks-empty type="tips" v-if="list.length == 0">没有找到任何笔记！</ks-empty>
		</div>
		<div class="player-notes-foot line line-top">
			<div class="player-notes-foot__input" @click="show = true">
				<image :src="state.SRC+'/config/app/static/course-play/images/edit.png'" />写笔记
			</div>
		</div>
		<uni-popup ref="popup" :custom="true" :show="show" type="bottom" @change="close">
			<div class="player-notes-editbox">
				<div class="player-notes-editbox__title">写笔记</div>
				<textarea class="ks-input player-notes-editbox__input" style="height: 120px;padding: 10px 15px;line-height: 24px;"
				 v-model="val"></textarea>
				 <div style="display: flex;justify-content: space-between;align-items: center;">
					<div style="display: flex;font-size: 14px;">
						<div style="height: 18px;width: 18px;border-radius: 3px;border: 1px solid #ddd;display: flex;justify-content: center;align-items: center;margin-right: 10px;" :style="isShare&&'background: #4184F5;'"  @click="isShare = !isShare">
							<image style="width: 12px;height: 12px;" mode="aspectFit"  :src="state.SRC+'/config/app/static/images/common/right.png'" v-if="isShare"></image>
						</div> 
						分享笔记
					</div>
					
					
					<button type="primary" style="margin: 0;height: 36px;line-height: 36px;font-size: 14px;" @click="save()">
						创建笔记
					</button>
				 </div>
				
			</div>
		</uni-popup>


	</div>

</template>

<script>
	import KS_Utils from 'utils/index.js'
	
	import {
		UniPopup
	} from 'components/uni/uni-popup/uni-popup'
	import {UniLoadMore} from 'components/uni/uni-load-more/uni-load-more'
	import {
		GetBj,
		SaveBj
	} from 'api/course'
	export default {
		components: {
			UniPopup,
			UniLoadMore
		},
		props: {
			periodId: Number,
			courseId: Number,
			pageChange:Number
		},
		data() {
			return {
				active: 0,
				list: [],
				val: '',
				isShare: false,
				state: {},
				show: false,
				page:1,
				pageCount:1,
				moreStatus:''
			}
		},
		watch: {
			// pageChange(val) {
			// 	this.reachBottom()
			// }
		},
		methods: {
			/*滚动加载*/
			reachBottom() {
				this.page++
				if (this.page <= this.pageCount) {
					this.getList(this.page)
				}
			},
			close(e) {
				this.show = e.show
			},
			changeTab(i) {
				this.active = i
				this.getList()
			},
			save() {
				SaveBj({
					courseid: this.courseId,
					pid: this.periodId,
					Intro: this.val,
					share: this.isShare
				}).then(res => {
					if (res.result) {
						uni.showToast({
							title: '发表成功'
						})
						this.val = ''
						this.show = false
						this.getList()
					} else {
						uni.showToast({
							title: res.msg,
							icon: 'none'
						})
					}

				})
			},
			getList(p=1){
				this.page = p
				if (this.page == 1) {
					this.list = []	
				}
				this.moreStatus = 'loading'
				GetBj({
					page: this.page,
					pagesize: 10,
					Periodid: this.periodId
				}).then(res => {
					uni.stopPullDownRefresh();
					this.pageCount = res.pagecount || 0
					if (this.page >= this.pageCount) {
						this.moreStatus = 'noMore'
					} else {
						this.moreStatus = 'more'
					}
					if (res.result) {
						res.WDbjlist.map((item)=>{
							item.$time = KS_Utils.getHistoryTime(item.adddate);
						});
						if(this.active == 0){
							this.list = this.list.concat(res.WDbjlist)	
						}else{
							this.list = this.list.concat(res.bjlist)
						}	
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
	/*笔记*/
	.player-notes {
		padding: 10px 15px 49px 15px;
	
	}

	.player-notes-filter {
		overflow: hidden;
		padding: 10px 0;
		display: flex;
		justify-content: flex-start;
	}

	.player-notes-filter button {
		font-size: 14px;
		line-height: 32px;
		height: 32px;
		margin:0 20px 0 0;
	}

	.player-notes-filter__item {
		margin-right: 15px;
		font-size: 14px;
		float: left;
		padding: 0 15px;
		background: #f6f6f6;
		border-radius: 4px;
		color: #666;
		box-sizing: border-box;
	}

	.player-notes-filter__item.active {
		color: #fff;
		background: #ff663d;
	}

	.player-notes-list {
		margin-top: 15px;
	}

	.player-notes-list__item {
		position: relative;
		padding: 0 0 20px 42px;
	}

	.player-notes-list__avatar {
		width: 32px;
		height: 32px;
		position: absolute;
		left: 0;
		top: 0;
		border-radius: 50%;
		overflow: hidden;
	}

	.player-notes-list__time {
		float: right;
		color: #999;
		font-size: 10px;
	}

	.player-notes-list__name {
		font-size: 14px;
		color: #666;
	}

	.player-notes-list__content {
		font-size: 14px;
		line-height: 20px;
		margin-top: 5px;
	}

	.player-notes-foot {
		position: fixed;
		bottom: 0;
		width: 100%;
		left: 0;
		z-index: 9;
		background: #fff;
		padding: 0 10px;
		box-sizing: border-box;
		height: 49px;
	}

	.player-notes-foot__input {
		height: 36px;
		line-height: 36px;
		background: #fafafa;
		position: relative;
		top: 7px;
		border: 1px solid #e9e9e9;
		box-sizing: border-box;
		border-radius: 4px;
		text-align: center;
		font-size: 14px;
		color: #666;
	}

	.player-notes-foot__input image {
		width: 16px;
		display: inline-block;
		height: 16px;
		position: relative;
		margin-right: 10px;
		top: 3px;
	}

	.player-notes-foot__input:active {
		background: #f6f6f6;
	}

	.player-notes-editbox-mask {
		width: 100%;
		height: 100%;
		position: fixed;
		left: 0;
		top: 0;
		z-index: 10000;
		background: rgba(0, 0, 0, 0.4);

	}

	.player-notes-editbox {
		position: fixed;
		width: 100%;
		bottom: 0;
		left: 0;
		background: #fff;
		padding: 15px;
		box-sizing: border-box;
		z-index: 10001;

		border-radius: 8px 8px 0px 0px;
	}

	.player-notes-editbox__title {
		line-height: 24px;
		font-size: 14px;
		padding-bottom: 10px;
	}

	.player-notes-editbox .ks-input {
		margin-bottom: 5px;
		-webkit-appearance: none;
		background-color: #fff;
		background-image: none;
		border-radius: 4px;
		border: 1px solid #dcdfe6;
		box-sizing: border-box;
		color: #606266;
		display: inline-block;
		font-size: inherit;
		outline: none;
		padding: 0 15px;
		transition: border-color .2s cubic-bezier(.645, .045, .355, 1);
		width: 100%;
		font-size: 14px;
	}

	.player-notes-editbox__checkbox {
		line-height: 36px;
		font-size: 14px;
		color: #999;
		position: relative;
		padding-left: 28px;
		float: left;
		content: '';
		width: 18px;
		height: 18px;
		box-sizing: border-box;
		border: 1px solid #ddd;
	
		border-radius: 3px;

	}


	.player-notes-editbox__checkbox.checked {
	
		border: 1px solid #4184f5;
	}

	.player-notes-editbox .ks-button {
		float: right;
	}
</style>
