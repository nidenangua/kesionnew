<template>
	<view v-if="item.tkinfo">
	        <view class="multiple-choice" v-if="item.tktype == 2 || item.tktype == 3">
	          <view class="multiple-choice__item" v-for="(option,index) in item.tkinfo.content" :key="index">
	            <!--单选、多选-->
	          
				<view
				  class="multiple-choice__inner"
				  :class="isRight[letters[index]]"
				  @click="mult(item,letters[index])"
				>
				  <view class="multiple-choice__letter">{{letters[index]}}</view>
				  <view class="multiple-choice__option" v-html="option"></view>
				</view>
	          </view>
	        </view>
	        <view class="multiple-choice" v-else-if="item.tktype == 4">
	          <!--判断题-->
	          <view class="multiple-choice__item">
	            <view class="multiple-choice__inner" @click="mult(item,'1')" :class="isRight['A']">
	              <view class="multiple-choice__letter">A</view>正确
	            </view>
	          </view>
	          <view class="multiple-choice__item">
	            <view class="multiple-choice__inner" @click="mult(item,'0')" :class="isRight['B']">
	              <view class="multiple-choice__letter">B</view>错误
	            </view>
	          </view>
	        </view>
		
	      </view>
</template>

<script>
	import MIXINS from 'mixins/index.js'
	export default{
		props: {
		      /**题目对象 */
		      item: {
		        type: Object
		      },
		  
		      /**是否是组合题 */
		      isCombinationQuestion: {
		        type: Boolean,
		        default: false
		      },
			  /**小题下标*/
			  index:Number,
		  
		      /**单选回答内容 */
		      aloneAnswer: {
		        type: String,
		        default: ""
		      },
		  
		      /**多选回答内容 */
		      userAnswer: {
		        type: Array,
		        default: function() {
		          return [];
		        }
		      },
		  
		      /**父级tkid */
		      parenttkid: {
		        type: Number,
		        default: 0
		      }
		    },
		    data: function() {
			 
		      return {

				isRight:{},
		        /**单选选择 */
		        aloneActived: '',
		  
		        /**多选选择 */
		        multipleActived: []
		      };
		    },
		    mixins: [MIXINS.exam],
			watch:{
				userAnswer:{
					handler(){
						let answer = this.userAnswer.toString()
						let _aloneActived = answer
						if(this.item.tktype == 4){
						  _aloneActived = ((answer === 'A' || answer === '1') && '1') || ((answer == 'B' || answer === '0') && '0') || ''
						}
						this.aloneActived = _aloneActived
						this.multipleActived = this.userAnswer
					},
					deep:true,
					immediate:true
				},
				aloneActived:{
					handler(){
						if(this.item.tktype == 3){
							return
						}
						let _isRight = {}
						if(this.item.tktype == 4){
							let arr = [{
								value:1,
								letter:'A'
							},{
								value:0,
								letter:'B'
							}]
							arr.map(n=>{
								let right = this.judgeIsRight(this.item,n.value)
								_isRight[n.letter] = right
							})
						}else{
							this.item.tkinfo.content.map((option,i)=>{
								let letter = this.letters[i]
								let right = this.judgeIsRight(this.item,letter)
								_isRight[letter] = right
								
							})
						}
						this.isRight = _isRight
					},
					immediate:true
				},
				multipleActived:{
					handler(){
						if(this.item.tktype == 3){
							let _isRight = {}
							this.item.tkinfo.content.map((option,i)=>{
								let letter = this.letters[i]
								let right = this.judgeIsRight(this.item,letter)
								_isRight[letter] = right
							})
							this.isRight = _isRight
						}
					},
					//数组需要深度监听
					deep:true,
					//第一次也会触发
					immediate:true
				}
			},
		    methods: {
		      /**
		       * 是否选中
		       * @param {String} 选项值，字母
		       */
		      isActived: function(option) {
		        var is = false;
		        this.selected.map(function (letter) {
		          if (`${letter}` === `${option}`) {
		            is = true;
		          }
		        });
		        return is;
		      },
		  
		      /**
		       * 选修点击
		       * @param {Object} 题目对象
		       * @param {String} 选项值，字母
		       */
		      mult: function(item, option) {
		        /**changeAnswer 为false 禁止作答 */
		        if (item.changeAnswer === false) {
		          return;
		        }
		        if (item.tktype == 2 || item.tktype == 4) {
		          this.aloneActived = `${this.aloneActived}` === `${option}` ? "" : option;
		          this.$emit("change", item, [this.aloneActived], this.isCombinationQuestion, this.parenttkid, this.index);
		        } else if (item.tktype == 3) {
		          var selected = [];
		  
		          if (this.multipleActived.length) {
		            var isRepeat = false;
		            this.multipleActived.map(function (letter) {
		              if (`${letter}` === `${option}`) {
		                isRepeat = true;
		              } else {
		                selected.push(letter);
		              }
		            });
		  
		            if (!isRepeat) {
		              selected.push(option);
		            }
		          } else {
		            selected.push(option);
		          }
		  
		          this.multipleActived = selected;
		          this.$emit("change", item, this.multipleActived, this.isCombinationQuestion, this.parenttkid, this.index);
		        }
		      },
		  
		      /**
		       * 判断题是否正确
		       * @param {Object} 题目对象
		       * @param {String} 当前选项值
		       * @param {Number} 当前选项的下标
		       */
		      judgeIsRight: function (item, option, index) {
		        var _this = this;
				
		        if (item.showAnswerStatus) {
		          if (item.tktype == 2 || item.tktype == 4) {
		            var answer = item.tkinfo.answer.toString();
		            if (item.tktype == 2) {
		              var _index;
		              /**处理选项打乱 */
		              if (item.tkinfo.real_answer && item.tkinfo.real_answer.length) {
		                _index = item.tkinfo.real_answer.indexOf(answer);
		                answer = this.getLetter(_index);
		              }
		            }
					if(this.item.tktype == 4){
						console.log(this.aloneActived,answer,option)
					}
		            if (`${this.aloneActived}` === `${option}`) {
		              return `${answer}` === `${option}` ? "right" : "error";
		            } else if (`${this.aloneActived}` !== "") {
		              return `${answer}` === `${option}` ? "right" : "";
		            }
		          } else if (item.tktype == 3) {
		            /**处理选项打乱 */
		            var _answer = [];
		            item.tkinfo.answer.map(function (letter) {
						var index;
						if (item.tkinfo.real_answer && item.tkinfo.real_answer.length) {
						  index = item.tkinfo.real_answer.indexOf(letter);
						  _answer.push(_this.getLetter(index));
						}else{
							_answer.push(letter)
						}
		            });
		            if (this.multipleActived.includes(option)) {
		              return _answer.includes(option) ? "right" : "error";
		            } else if (this.multipleActived.length) {
		              return _answer.includes(option) ? "miss" : "";
		            }
		          }
		        } else {
		          if (item.tktype == 2 || item.tktype == 4) {
		            return `${this.aloneActived}` === `${option}` ? "done" : "";
		          } else if (item.tktype == 3) {
		            return this.multipleActived.includes(option) ? "done" : "";
		          }
		        }
		      }
		    }
	}
</script>

<style scoped>
	
	  /*多选题*/
	  
	    .multiple-choice {
	      margin-top: 10px;
	    }
	    .multiple-choice__inner {
	      padding: 10px 0;
	      line-height: 28px;
	      color: #3e4754;
	      font-size: 14px;
	      display: flex;
	      align-items: center;
	    }
	    .multiple-choice__letter {
	      width: 28px;
	      height: 28px;
	      text-align: center;
	      font-size: 15px;
	      color: #3e4754;
	      border-radius: 50%;
	      border: 1px solid #e5e7eb;
	      margin-right: 15px;
	      background-size: 24px;
	      background-repeat: no-repeat;
	      background-position: 50% 50%;
	    }
	    .multiple-choice__option img{
	      max-width: 80%;
	    }
	    
	    /*回答样式*/
	    .multiple-choice .right {
	      color: #80c269;
	    }
	    .multiple-choice .right .multiple-choice__letter {
	      background-color: #80c269;
	      border: 1px solid #80c269;
	      color: #fff;
	      text-indent: 64px;
	      background-image: url(../../../static/exam/checkmark.png);
	    }
	    .multiple-choice .error {
	      color: #f95d5d;
	    }
	    .multiple-choice .error .multiple-choice__letter {
	      background-color: #f95d5d;
	      border: 1px solid #f95d5d;
	      color: #fff;
	      text-indent: 64px;
	      background-image: url(../../../static/exam/close.png);
	    }
	    .multiple-choice .miss {
	      color: #80c269;
	      position: relative;
	    }
	    .multiple-choice .miss .multiple-choice__letter {
	      background-color: #80c269;
	      border: 1px solid #80c269;
	      color: #fff;
	      text-indent: 64px;
	      position: relative;
	      overflow: hidden;
	      background-image: url(../../../static/exam/checkmark.png);
	    }
	    .multiple-choice .miss::after {
	      content: "漏选";
	      color: #80c269;
	      position: absolute;
	      background: #fff;
	      border: 1px solid #80c269;
	      line-height: 1;
	      border-radius: 15px;
	      padding: 1px 0;
	      width: 28px;
	      text-align: center;
	      left: 10px;
	      top: 3px;
	      font-size: 10px;
	    }
	    .multiple-choice .done .multiple-choice__letter {
	      background-color: #2987ee;
	      border: 1px solid #2987ee;
	      color: #fff;
	    }
</style>
