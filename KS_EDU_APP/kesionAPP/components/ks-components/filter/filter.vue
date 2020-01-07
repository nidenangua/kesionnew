<template>
	<div class="ks-filter">
		<!-- 两个筛选的 -->
		<view v-if="action==1" class="filters">
			<view class="filter clearfix withe-bg">
				<view class="filter-col ks-col-12">
					<view class="uni-input" @click="bindFilter('sort')" :class="filterSort?'on':''">{{sortList[sortIndex].name}}</view><image :src="baseUrl+'/static/images/common/arrowed.png'" class="arrow" v-if="filterSort"></image><image :src="baseUrl+'/static/images/common/arrow.png'" class="arrow" v-else></image>
				</view>
				<view class="filter-col ks-col-12">
					<view class="uni-input" @click="bindFilter('sorts')" :class="filterSorts?'on':''">{{sortLists[sortIndexs].name}}</view><image :src="baseUrl+'/static/images/common/arrowed.png'" class="arrow" v-if="filterSorts"></image><image :src="baseUrl+'/static/images/common/arrow.png'" class="arrow" v-else></image>
				</view>
			</view>
			<view class="filter-list withe-bg filter__sort" v-if="filterSort">
				<view v-for="(item,i) in sortList" class="item" :key="item.type" :class="item.type==orderid?'curr':''" @click="selectItem(item.type,i)">
					{{item.name}}<i class="selected" :style="'background: url('+baseUrl+'/static/images/common/lesson_icon_select.png) no-repeat center;background-size:17px;'"></i>
				</view>
			</view>
			<view class="filter-list withe-bg filter__sort" v-if="filterSorts">
				<view v-for="(item,i) in sortLists" class="item" :key="item.type" :class="item.type==orderids?'curr':''" @click="selectItems(item.type,i)">
					{{item.name}}<i class="selected" :style="'background: url('+baseUrl+'/static/images/common/lesson_icon_select.png) no-repeat center;background-size:17px;'"></i>
				</view>
			</view>
		</view>
		<!-- 两个筛选的 -->
		
		<!-- 有分类的 -->
		<view v-else>
			<view class="filter clearfix withe-bg">
				<view class="filter-col ks-col-12">
					<view class="uni-input" @click="bindFilter('class')" :class="filterClass?'on':''">{{classList[classIndex].className}}</view><image :src="baseUrl+'/static/images/common/arrowed.png'" class="arrow" v-if="filterClass"></image><image :src="baseUrl+'/static/images/common/arrow.png'" class="arrow" v-else></image>
				</view>
				<view class="filter-col ks-col-12">
					<view class="uni-input" @click="bindFilter('sort')" :class="filterSort?'on':''">{{sortList[sortIndex].name}}</view><image :src="baseUrl+'/static/images/common/arrowed.png'" class="arrow" v-if="filterSort"></image><image :src="baseUrl+'/static/images/common/arrow.png'" class="arrow" v-else></image>
				</view>
			</view>
			<view class="filter-list withe-bg height50 filter__class clearfix" v-if="filterClass">
				<view class="nav first-nav">
					<view v-for="(item,i) in classList" class="item" :key="item.classID" :class="item.classID==firstClassId?'curr':''" @click="selectClassItem(0,i,item.classID)">
						{{item.className}}
					</view>
				</view>
				<view class="nav second-nav">
					<view v-for="(sitem,i) in secondClassList" class="item" :key="sitem.classID" :class="sitem.classID==secondClassId?'curr':''" @click="selectClassItem(1,i,sitem.classID)">
						{{sitem.className}}
					</view>
				</view>
				<view class="nav third-nav">
					<view v-for="(titem,i) in thirdClassList" class="item" :key="titem.classID" :class="titem.classID==thirdClassId?'curr':''" @click="selectClassItem(2,i,titem.classID)">
						{{titem.className}}
					</view>
				</view>
			</view>
			<view class="filter-list withe-bg filter__sort" v-if="filterSort">
				<view v-for="(item,i) in sortList" class="item" :key="item.type" :class="item.type==orderid?'curr':''" @click="selectItem(item.type,i)">
					{{item.name}}<i class="selected" :style="'background: url('+baseUrl+'/static/images/common/lesson_icon_select.png) no-repeat center;background-size:17px;'"></i>
				</view>
			</view>
		</view>
		<!-- 有分类的 -->
		<view class="filter-bg" v-if="filterClass || filterSort || filterSorts" @touchmove.stop.prevent @click="filterClass=false;filterSort=false;filterSorts=false"></view>
	</div>
</template>

<script>
	export default{
		name:'KsFilter',
		props:{
			action:0,//1是我的学习记录的头部筛选，0是问答、资讯头部的筛选
			// 分类的筛选
			classList: {
			  type: Array,
			  default() {
				return [];
			  }
			},
			//这个是我的学习记录，问答，资讯的头部排序筛选
			sortList: {
			  type: Array,
			  default() {
				return [];
			  }
			},
			// 这个是我的学习记录的筛选
			sortLists: {
			  type: Array,
			  default() {
				return [];
			  }
			},
		},
		data(){
			return{
				baseUrl:this.$store.state.SRC+"/config/app",
				secondClassList:[],//二级分类
				thirdClassList:[],//三级分类
				infoclassid:0,//分类选中的id
				firstClassId:0,//一级选中的分类id
				secondClassId:0,//二级选中的分类id
				thirdClassId:0,//三级选中的分类id
				orderid:0,//排序筛选选中的id
				orderids:0,//我的学习筛选选中的id
				classIndex: 0,//分类默认选中
				sortIndex:0,//排序默认选中
				sortIndexs:0,//我的学习记录排序默认选中
				filter:'',
				filterClass:false,//判断分类是否显示
				filterSort:false,//判断排序是否显示
				filterSorts:false//判断排序是否显示（我的学习记录）
			}
		},
		methods:{
			// 点击显示，隐藏的方法
			bindFilter(action){
				this.filter = action
				if(action=='class'){
					this.filterClass = this.filterClass == false
					this.filterSort = false
					this.filterSorts = false
				}else if(action=='sorts'){
					this.filterClass = false
					this.filterSort = false
					this.filterSorts = this.filterSorts == false
				}else{
					this.filterClass = false
					this.filterSorts = false
					this.filterSort = this.filterSort == false
				}
			},
			// 问答，资讯，我的记录排序筛选选中和获取id
			selectItem(orderid,index){
				this.orderid = orderid
				this.filterSort = false
				this.sortIndex = index
				this.$emit('getOrderid',orderid)
			},
			//我的记录筛选选中和获取id
			selectItems(orderid,index){
				this.orderids = orderid
				this.filterSorts = false
				this.sortIndexs = index
				this.$emit('getOrderids',orderid)
			},
			//分类筛选选中和获取id
			selectClassItem(leve,index,classid){
				this.infoclassid = classid
				if(leve==1){
					this.secondClassId = classid
					let refactoringThirdClass = []
					if(this.secondClassList[index].childList&&this.secondClassList[index].childList.length){
						refactoringThirdClass = [{childList:[],classID: classid, className: "全部"}]
						this.secondClassList[index].childList.map(titem=>{
							refactoringThirdClass.push(titem)
						})
					}else{
						this.$emit('getClassid',classid)
						this.filterClass = false
						this.thirdClassId = null
					}
					this.thirdClassList = refactoringThirdClass
				}else if(leve==2){
					this.thirdClassId = classid
					this.filterClass = false
					this.$emit('getClassid',classid)
				}else{
					this.firstClassId = classid
					let refactoringSecondClass = []
					if(this.classList[index].childList.length){
						refactoringSecondClass = [{childList:[],classID: classid, className: "全部"}]
						this.classList[index].childList.map(sitem=>{
							refactoringSecondClass.push(sitem)
						})
					}else{
						this.$emit('getClassid',classid)
						this.filterClass = false
						this.secondClassId = null
						this.thirdClassId = null
					}
					this.secondClassList = refactoringSecondClass
					this.thirdClassList = []
				}
			},
		}
	}
</script>

<style lang="scss" scoped>
	.withe-bg{
		background: #fff;
	}
	.filters{
		.filter{
			top:0px;
		}
		.filter-list{
			top: 44px;
		}
	}
	.filter{
		position: fixed;
		width: 100%;
		top:44px;
		z-index: 11;
		.filter-col{
			text-align: center;
			height: 44px;
			line-height: 44px;
			.uni-input{
				font-size: 14px;
				color: #1A1A1A;
				display: inline-block;
				vertical-align: middle;
			}
			.on{
				color: #2987EE;
			}
			.arrow{
				width: 6px;
				height: 5px;
				display: inline-block;
				margin-left: 5px;
				vertical-align: middle;
			}
			
		}
	}
	.filter::before{
		content: '';
		position:absolute;
		width: 100%;
		left: 0;
		top: 0;
		height: 1px;
		background: rgba(0,0,0,0.15);
		transform: scaleY(0.5);
		
	}
	.filter-list{
		position: fixed;
		width: 100%;
		top: 88px;
		border-top: 1px solid #eee;
		z-index:11;
		max-height: 50%;
	}
	.filter__class{
		.nav{
			width: 33.33%;
			height: 100%;
			background: #F5F5F5;
			float: left;
			overflow-y: auto;
			.item{
				line-height: 44px;
				height: 44px;
				text-align: center;
				font-size: 14px;
			}
			
		}
		.first-nav .curr,.second-nav{
			background: #FAFAFA;
		}
		.second-nav .curr,.third-nav{
			background: #fff;
		}
	}
	.filter__sort .item{
		height: 44px;
		line-height: 44px;
		padding:0 10px;
		font-size: 14px;
		border-bottom: 1px solid #eee;
		position:relative;
		.selected{
			width: 25px;
			height:44px ;
			position:absolute;
			right: 10px;
			top: 0;
			display: none;
			
			background-size:17px;
		}
	}
	.filter__sort .item:last-child{
		border-bottom: 0;
	}
	.filter__sort .curr{
		color: #2987EE;
		.selected{
			display: block;
		}
	}
	.height50{
		height: 50%;
	}
	.filter-bg{
		position: fixed;
		width: 100%;
		height: 100%;
		top: 0;
		background: rgba(84, 80, 80, 0.48);
		z-index: 10;
	}
</style>
