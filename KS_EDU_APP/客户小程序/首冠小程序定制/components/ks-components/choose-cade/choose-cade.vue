<template>
	<view class="boxa">
		<view class="top_kbox">
			<block v-for="(item,i) in newlist" :key="i">
				<view class="ibox" :style="{width:'calc(100% / '+newlist.length+')'}" @tap="alertnum(i)" :class="[i== i1?'actives':'']">
					<text class="uni_14">{{item}}</text>
					<image v-if="i != i1" style="width:7px;height: 7px;margin-left: 5px;" :src="baseUrl+'/static/images/choose-cade/choose-Cadex.png'" mode=""></image>
					<image v-else style="width:7px;height: 7px;margin-left: 5px;" :src="baseUrl+'/static/images/choose-cade/choose-Cades.png'" mode=""></image>
				</view>
			</block>
		</view>
		<view  :class="[show?'list_boxs2':'list_boxs']">
			<view class="lione">
				<block v-for="(item,i) in listchild" :key="i">
					<view class="mli" @tap="chooseOne(i)">
						<text :class="[i== i2?'actives':'']" class="uni_14">{{item}}</text>
						<image v-if="i == i2" class="ii" :src="baseUrl+'/static/images/choose-cade/lesson_icon_select@2x.png'" mode=""></image>
					</view>
				</block>
			</view>
			<view class="hideA" @tap="hide">
			</view>
		</view>
	</view>
</template>

<script>
	export default {
		name:'KsChooseCade',
		props: ['list', 'arr'], //数组  arr
		data() {
			return {
				baseUrl:this.$store.state.SRC+"/config/app",
				i1: null,
				i2: null,
				show: false,
				listchild: [],
				newlist: this.list,
				
			}
		},
		methods: {
			alertnum(i) {
				if (this.i1 != i) {
					this.listchild = [];
					this.i1 = i;
					this.listchild = this.arr[i];
					this.i2 = null;
					this.show = true;
					let ins = this.listchild.indexOf(this.newlist[i]);
					if (ins > -1) {
						this.i2 = ins
					}
				}

			},
			chooseOne(i) {
				this.i2 = i;
				this.newlist[this.i1] = this.listchild[i];
				this.$emit('chooseLike', [this.i1, this.i2])
			},
			hide() {
				this.show = false;
				this.i1 = null;
				this.i2 = null;
			}
		}
	}
</script>

<style>
	.hideA {
		height: calc(100% - 310upx);
	}

	.mli {
		/* border: 1upx solid red; */
		display: flex;
		justify-content: space-between;
		align-items: center;
		padding: 22upx 0;
	}

	.lione {
		background-color: #fff;
		/* height: 262upx; */
		padding: 10upx 40upx;

	}

	.list_boxs {
		background-color: rgba(84, 80, 80, 0.48);
		position: fixed;
		height: calc(100%);
		width: 100%;
		z-index: 88;
		transition: all .5s;
		transform: translateY(-120%);
	}
	.list_boxs2{
		background-color: rgba(84, 80, 80, 0.48);
		position: fixed;
		height: calc(100%);
		width: 100%;
		z-index: 88;
		transform: translateY(0);
		transition: all .5s;
	}

	.ii {
		width: 34upx;
		height: 30upx;
		display: block;
		margin-left: 12upx;
	}

	.actives {
		color: #ff663d;
	}

	.ibox {
		display: flex;
		align-items: center;
		justify-content: center;
	}

	.top_kbox {
		display: flex;
		justify-content: space-between;
		align-items: center;
		background-color: #FFFFFF;
		padding: 28upx 5%;
		position: fixed;
		top: 88upx;
		width: 90%;
		z-index: 99;
		/* #ifdef APP-PLUS */
		top: 0;
		/* #endif */
	}
	.boxa{
		padding-top: 84upx;
		position: relative;
	}
</style>
