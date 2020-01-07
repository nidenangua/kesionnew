<template>
	<view @click="openView('/pages/service/service')" class="service">
		在线客服
	</view>
</template>

<script>
	export default {
		data() {
			return {

			}
		},
		methods: {
			openView(url) {
				uni.navigateTo({
					url: url
				})
			}
		}
	}
</script>

<style scoped>
	.service {
		width: 25px;
		height: 85px;
		border-top-left-radius: 4px;
		border-bottom-left-radius: 4px;
		padding: 8px 0px 0px 0px;
		padding-right: 5px;
		background: #006633;
		line-height: 18px;
		position: fixed;
		color: #ffffff;
		right: 0px;
		bottom: 140px;
		cursor: pointer;
		font-size: 15px;
		text-align: right;
		z-index: 999999999999999;
	}
</style>
