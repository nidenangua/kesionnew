<template>
	<view>
		<view class="fill-blanks" v-for="(gap,index) in answerArr" :key="index">
			<text>
				答题区{{index+1}}:

			</text>
			
			<input type="text" class="fill-blanks__input" v-model="gap.options" @blur="submitAnswer" />

		</view>
	</view>
</template>

<script>
	export default {
		props: {
			/**是否是组合题 */
			isCombinationQuestion: {
				type: Boolean,
				default: false
			},
			/**小题下标*/
			index: Number,
			/**题目对象 */
			item: {
				type: Object,
				default () {
					return {}
				}
			},
			/**父级tkid */
			parenttkid: {
				type: Number,
				default: 0
			}
		},
		data(){
			return {
				answerArr:[]
			}
		},
		mounted() {
			this.updateAnswer()
		},
		methods: {
			updateAnswer(){
				let answerArr = []
				if (this.item.useranswer && this.item.useranswer.length) {
					this.item.useranswer.map((item) => {
						answerArr.push({
							options: item
						})
					})
				}else{
					answerArr = this.item.tkinfo.answer
				}
				this.answerArr = answerArr
			},
			submitAnswer() {
				this.item.tkinfo.answer = this.answerArr
				this.$emit("callback", this.item, this.isCombinationQuestion, this.parenttkid, this.index);
			}
		}
	}
</script>

<style scoped>
	/*填空题*/
	.fill-blanks {
		margin: 20px 0;
		line-height: 32px;
		color: #3e4754;
		font-size: 14px;
		display: flex;
	}

	.fill-blanks__input {
		margin-left: 10px;
		height: 30px;
		line-height: 30px;
		border: 0px;
		border-bottom: 1px solid #eee;
		font-size: 14px;
		width: 75%;
	}
</style>
