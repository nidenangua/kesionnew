<template>
	<view>
	             <textarea
	              v-model="item.useranswer"
	              class="short-answer"
	              placeholder="请输入答案"
	              @input="handleBlur"
				  v-if="showTextarea"
	            ></textarea>
	        </view>
</template>

<script>
	export default{
		props: {
			showTextarea:{
				type: Boolean,
				default: false
			},
		      /**题目对象 */
		      item: {
		        type: Object,
		        default: function() {
		          return {};
		        }
		      },
			  /**是否是组合题 */
			  isCombinationQuestion: {
			    type: Boolean,
			    default: false
			  },
			  /**小题下标*/
			  index:Number,
			  /**父级tkid */
			  parenttkid: {
			    type: Number,
			    default: 0
			  }
		    },
			data(){
				return {
					
				}
			},
		    methods: {
		      handleBlur: function () {
		        this.$emit("callback", this.item,this.isCombinationQuestion, this.parenttkid, this.index);
		      }
		    }
	}
</script>

<style scoped>
	/*简答题*/
	  .short-answer {
	    display: block;
	    resize: vertical;
	    padding: 10px 15px;
	    line-height: 1.5;
	    box-sizing: border-box;
	    width: 100%;
	    height: 10rem;
	    font-size: 14px;
	    color: #606266;
	    background-color: #fff;
	    background-image: none;
	    border: 1px solid #dcdfe6;
	    border-radius: 4px;
	    transition: border-color 0.2s cubic-bezier(0.645, 0.045, 0.355, 1);
	    margin-top:10px;
	  }
	  .short-answer:focus{
	    border: 1px solid #9fb9f3;
	  }
</style>
