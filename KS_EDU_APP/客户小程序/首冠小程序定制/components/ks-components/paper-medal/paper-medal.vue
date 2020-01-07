<template>
	<view class="paper-medal">
	              <view class="paper-medal__img">
					  <img  :src="baseUrl+'/static/images/exam/exam_sheet_bg.png'" />
	                <view class="paper-medal__value">
	                  <text>{{value}}<text style="font-size: 18px;font-style: normal;">{{unit}}</text></text>
	                </view>
	                <view class="paper-medal__info">{{name}}</view>
	              </view>
	            </view>
</template>

<script>
	export default {
		props: {
		      /**勋章中间内容 */
		      value: [String, Number],
		
		      /**勋章标题 */
		      name: [String, Number],
		      unit: {
		        type: String
		      }
		},
		data(){
			return {
				baseUrl:this.$store.state.SRC+"/config/app",
			}
		}	
	}
</script>

<style scoped>
	.paper-medal {
	    background: #fff;
	    padding: 20px 0;
	}
	.paper-medal__img {
	    height: 160px;
	    padding: 20px 0;
	    -webkit-box-sizing: border-box;
	    box-sizing: border-box;
	    background-size: contain;
	    position: relative;
	}
	.paper-medal__img img{
		width: 177px;
		height: 100%;
		position: absolute;
		top: 0;
		left: 50%;
		margin-left: -88.5px;
	}
	.paper-medal__value {
	    text-align: center;
	    padding-top: 22px;
	    font-weight: bold;
	}
	.paper-medal__value text {
	    font-size: 36px;
	    color: #FE7925;
	}

	.paper-medal__info {
	    position: absolute;
	    bottom: 35px;
	    text-align: center;
	    width: 100%;
	    color: #fff;
	    font-size: 13px;
	}
</style>
