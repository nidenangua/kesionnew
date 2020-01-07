<template>
  <div>
    <el-dialog title="选择图标" :visible.sync="visible" width="880px">
      <select-icon @sure="selectIconSure" @cancel="visible = false"/>
    </el-dialog>
    <div class="nav">
		<div class="switch" v-if="other.menuSwitch === false || other.menuSwitch === true">
			<span>是否默认开启左边菜单栏：</span>
			<el-switch
				v-model="other.menuSwitch"
				active-color="#13ce66"
				@change="change"
			>
			</el-switch>
		</div>	
      <ul>
        <li v-for="(item,index) in list" :key="index">
          <div class="icon" v-if="item.icon">
            <img :src="item.icon">
            <div class="select-img" @click="selectImg(item)">替换图标</div>
          </div>
          <div class="op">
            <span>导航名称：</span>
            <el-input class="ks-fl" size="small" v-model="item.name" />
          </div>
          <div class="op clearfix">
            <span>设置链接：</span>
            <div class="ks-link ks-fl" style="width:145px;">
              <el-input size="small" :disabled="true" v-if="item.title"/>
              <el-input size="small" v-model="item.url" v-else/>
              <div class="ks-link-title" :title="item.title" v-if="item.title">
                <i class="el-icon-close" @click="item.title = '';item.url = '';"></i>
                {{item.title}}
              </div>
            </div>
            <div class="ks-bt ks-fl ks-link-bt ks-ml5" @click="$selectLink(item)"></div>
          </div>
          <div class="ks-delete" @click="deleteData(index)"></div>
        </li>
      </ul>
    </div>
    <div align="center">
      <div class="ks-bt ks-bt-pur fn" @click="addData()">添加导航</div>
    </div>
  </div>
</template>
<script>
import SelectIcon from "../SelectIcon";
import { deleteArray, cloneArray } from "@/utils";
export default {
  name: "Nav",
  props:{
    list:{
      type:Array,
      default(){
        return []
      }
    },
    other:{
      type:Object,
      default(){
        return {}
      }
    }
  },
  data() {
    return {
      visible: false,
      selectItem: {},
			
    };
  },
  methods: {
		change(){
		},
    /**
     * 选择图片
     */
    selectImg(item) {
      this.visible = true;
      this.selectItem = item;
    },
    selectIconSure(src) {
      this.selectItem.icon = src;
      this.visible = false;
    },
    /**
     * 删除
     */
    deleteData(index) {
      if (this.list.length <= 2) {
        this.$alert("至少保留2条");
        return false;
      }
      let arr = cloneArray(this.list);
      arr.splice(index, 1);
      this.$emit("update:list", arr);
    },
    /**
     * 添加导航
     */
    addData() {
      if (this.list.length >= 5 && this.$route.name == "Drag") {
        this.$alert("您最多可添加5个导航");
        return false;
      }else if(this.list.length >= 10 ){
				this.$alert("您最多可添加10个导航");
				return false;
			}
      let arr = cloneArray(this.list);
      arr.push({
        name: "导航",
        icon: `/Public/wechat/images/microportal/nopic.png`,
        url: "#"
      });
      this.$emit("update:list", arr);
    }
  },
  components: {
    SelectIcon
  }
};
</script>
<style lang="scss" scoped>
/*导航*/
.nav {
  padding-bottom: 15px;
}
.switch{
	width: 100%;
	height: 44px;
	line-height: 44px;
	font-size: 12px;
	color: #999;
}
.switch span{
	margin-right: 20px;
}
.nav li {
  padding: 10px 0;
  position: relative;
  min-height: 66px;
}
.nav .icon {
  width: 64px;
  height: 64px;
  float:left;
  border: 1px solid #eee;
  border-radius: 4px;
  overflow: hidden;
	position:relative;
	margin-right: 10px;
	margin-top:7.5px;
}
.nav .icon img {
  height: 48px;
  display: block;
  margin: 0 auto;
  margin-top: 8px;
}
.nav li {
  border-bottom: 1px solid #eee;
	overflow:hidden;
}
.nav .op {
  position: relative;
  line-height: 36px;
  padding: 0 15px 0 70px;
  margin-top: 5px;
	float:left;
}
.nav .op span {
  position: absolute;
  left: 0;
  top: 0;
  color: #999;
}
.nav .select-img {
  height: 20px;
  line-height: 20px;
  position: absolute;
  width: 100%;
  left: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.4);
  color: #fff;
  text-align: center;
  cursor: pointer;
}


.ks-link {
  position: relative;
}
.ks-link-title {
  height: 26px;
  line-height: 26px;
  border: 1px solid #ddd;
  box-sizing: border-box;
  border-radius: 3px;
  padding: 0 30px 0 10px;
  position: absolute;
  left: 5px;
  background: #fff;
  max-width: 90%;
  white-space: nowrap;
  text-overflow: ellipsis;
  top: 5px;
  overflow: hidden;
}
.ks-link-title .el-icon-close {
  position: absolute;
  right: 0;
  top: 0;
  width: 24px;
  height: 24px;
  text-align: center;
  line-height: 24px;
  cursor: pointer;
  color:#666;
  font-size: 14px;
  
}
.ks-link-title .el-icon-close:hover {
  color: $primary-color;
}
.ks-link-bt{
  width: 32px;
  height: 32px;
  margin-top: 2px;
}

</style>
