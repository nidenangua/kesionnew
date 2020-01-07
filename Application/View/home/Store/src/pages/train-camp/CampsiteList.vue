<template>
  <ks-container class="train-camp-list">
    <el-breadcrumb separator="/">
      <el-breadcrumb-item :to="{ path: '/traincamp' }">训练营</el-breadcrumb-item>
      <el-breadcrumb-item>营期目录</el-breadcrumb-item>
    </el-breadcrumb>
    <div class="tips">请您遵守国家相关规定，切勿上传低俗色情、暴力恐怖、谣言诈骗、侵权盗版等相关内容，科汛微门户保有依据国家规定及平台规则进行处理的权利。</div>
    <div class="train-camp-list-box">
      <div class="train-camp-list-box__header">
        <div>营期目录</div>
        <el-button type="primary" @click="addCampsiteList">添加目录</el-button>
      </div>
      <div class="train-camp-list-box__container">
        <el-row class="title-row">
          <el-col :span="15" class="grid-content">
            <div @click="allExpand">
              目录内容
              <span class="expand-all">( {{isAllExpand?"全部关闭":"全部展开"}} )</span>
            </div>
          </el-col>
          <el-col :span="5" class="grid-content"></el-col>
          <el-col :span="4" class="grid-content operate">操作</el-col>
        </el-row>
        <!--  -->
        <el-row class="train-camp-list-box__item" v-for="(item,index) in chapterList" :key="index">
          <el-row class="top">
            <el-col :span="15" class="grid-content">
              <div>
                第{{index+1}}节
                <span class="name">{{item.periodname}}</span>
              </div>
            </el-col>
            <el-col :span="5" class="grid-content">
              <div>
                <span v-if="item.child.length>0">共{{item.child.length}}个任务</span>
              </div>
            </el-col>
            <el-col :span="4" class="grid-content handle">
              <div class="bottom">
                <el-tooltip content="添加任务" placement="bottom">
                  <i class="iconfont icon-tianjia" @click="handleAddCampsite(item)"></i>
                </el-tooltip>
              </div>
              <el-tooltip content="收起" placement="bottom" v-if="item.expand">
                <i class="iconfont icon-suoxiao" @click="item.expand=!item.expand"></i>
              </el-tooltip>
              <el-tooltip content="展开" placement="bottom" v-else>
                <i class="iconfont icon-kuoda" @click="item.expand=!item.expand"></i>
              </el-tooltip>
              <el-tooltip content="编辑" placement="bottom">
                <i class="iconfont icon-bianji4"></i>
              </el-tooltip>
              <el-tooltip content="删除" placement="bottom">
                <i class="iconfont icon-shanchu1"></i>
              </el-tooltip>
            </el-col>
          </el-row>
          <el-row class="bottom" v-if="item.expand">
            <div v-for="(childItem,c) in item.child" :key="c">
              <el-row class="bottom__index" v-show="!childItem.isEdit">
                <el-col :span="15" class="grid-content">
                  <el-row class="des">
                    <el-col :span="1">{{c+1}}</el-col>
                    <el-col :span="2">{{childItem.type_name}}</el-col>
                    <el-col :span="20">
                      {{childItem.title}}
                      <span class="try-see-tag" v-if="childItem.try_it">试看</span>
                    </el-col>
                  </el-row>
                </el-col>
                <el-col :span="5" class="grid-content"></el-col>
                <el-col :span="4" class="grid-content handle">
                  <el-tooltip content="展开" placement="bottom">
                    <i class="iconfont icon-kuoda" @click="childItem.isEdit=true"></i>
                  </el-tooltip>
                  <el-tooltip content="编辑" placement="bottom">
                    <i class="iconfont icon-bianji4"></i>
                  </el-tooltip>
                  <el-tooltip content="删除" placement="bottom">
                    <i class="iconfont icon-shanchu1"></i>
                  </el-tooltip>
                </el-col>
              </el-row>
              <el-row class="bottom__index add-mission" v-show="childItem.isEdit">
                <el-col :span="15" class="add-mission">
                  <el-row class="mission">
                    <el-col :span="1" class="grid-content">1</el-col>
                    <el-col :span="2" class="grid-content">任务名称</el-col>
                    <el-col :span="20" class="grid-content">
                      <el-input v-model="childItem.title" class="mission__input" size="small">
                        <span
                          slot="suffix"
                          class="information-row-number"
                        >{{childItem.title.length}}/30</span>
                      </el-input>
                    </el-col>
                  </el-row>
                  <el-row>
                    <el-col :span="1" class="grid-content"></el-col>
                    <el-col :span="2" class="grid-content">已选商品</el-col>
                    <el-col :span="20" class="grid-content selected">
                      <div class="selected__content">
                        <img
                          src="https://obj.kesion.com/Images/school/2/201903/823d7a846a613b884080591697c76ac4.jpg"
                          alt=""
                        >
                        扁平插画风格分析
                      </div>
                      <div>
                        <span>图文</span>
                        <el-button plain size="small" class="reelect">重新选择</el-button>
                      </div>
                    </el-col>
                  </el-row>
                  <el-row>
                    <el-col :span="1" class="grid-content"></el-col>
                    <el-col :span="2" class="grid-content"></el-col>
                    <el-col :span="20" class="grid-content set-try-see">
                      <el-checkbox v-model="childItem.try_it">设为试看内容</el-checkbox>
                    </el-col>
                  </el-row>
                  <el-row>
                    <el-col :span="1" class="grid-content"></el-col>
                    <el-col :span="22" class="grid-content">
                      <el-button type="primary" size="small" @click="childItem.isEdit=false">确定保存</el-button>
                      <el-button size="small" @click="childItem.isEdit=false">取 消</el-button>
                    </el-col>
                  </el-row>
                </el-col>
              </el-row>
            </div>
          </el-row>
        </el-row>
        <!--  -->
        <el-row class="train-camp-list-box__item" v-if="addNewCampsite">
          <el-row class="top">
            <el-col :span="15" class="grid-content">
              <div class="catalog">
                第{{chapterList.length+1}}节
                <el-input v-model="trainCampName" class="catalog__input" size="small">
                  <span slot="suffix" class="information-row-number">{{trainCampName.length}}/30</span>
                </el-input>
                <el-button
                  type="primary"
                  size="small"
                  class="catalog__btn"
                  @click="saveNewCampsite"
                >保存</el-button>
                <el-button
                  plain
                  size="small"
                  class="catalog__btn"
                  @click="addNewCampsite = false"
                >取消</el-button>
              </div>
            </el-col>
          </el-row>
        </el-row>
      </div>
    </div>
    <dialogAddMission
      :centerDialogVisible="centerDialogVisible"
      :existChapterId="existChapterId"
      @changeCenterDialogVisible="listenCenterDialogVisible"
      @saveCourseList="saveCourseList"
    ></dialogAddMission>
  </ks-container>
</template>

<script>
import dialogAddMission from "./components/dialogAddMission";
export default {
  name: "CampsiteList",
  components: {
    dialogAddMission
  },
  data() {
    return {
      /**添加新的目录 */
      addNewCampsite: false,
      /** 要增加的营期目录名称 */
      trainCampName: "",
      /**是否出现添加任务对话框 */
      centerDialogVisible: false,
      /**是否全部展开 */
      isAllExpand: false,
      /**营期目录内容 */
      chapterList: [
        {
          periodid: 5236,
          periodname: "笔刷的使用，如何去创作元素",
          sum_credit: 40,
          child: [
            {
              task_type: 1, //任务的面板类型
              title: "标准点播信息", //任务标题
              infoid: 2271, //任务id
              type_name: "点播", //任务商品类型中文
              type: 1, //任务商品类型
              try_it: true, //是否试看
              must_learn: true, //是否必学
              is_time_limit: false, //是否开启时间限制
              limit_time: [], //限制的时间段
              defaultpic: "/UploadFiles/2019/112/3132061754672095.jpg", //任务商品的图片
              courseid: 1
            },
            {
              task_type: 1,
              title: "55555555555555",
              infoid: 2241,
              credit: 20,
              type_name: "点播",
              type: 1,
              try_it: "true",
              must_learn: "true",
              is_time_limit: "true",
              limit_time: ["2019-07-06 17:29:06", "2019-07-20 17:29:08"],
              defaultpic: ""
            }
          ]
        },
        {
          periodname: "扁平插画多种风格+透视构图+杂色的运用",
          child: []
        }
      ],
      /**当前添加营期 */
      addCampsiteName: "",
      /**把营期目录内容里面已经存在的数据的id放入数组 避免重复添加 专栏分类和课程分类会重复，所以要写两个数组*/
      existChapterId: {
        /**存放课程分类id */
        courseIdList: [],
        /**存放专栏分类id */
        columnIdList: []
      }
    };
  },
  watch: {
    // 营期名称字数限制
    trainCampName: function() {
      this.trainCampName = this.trainCampName.trim();
      if (this.trainCampName.length > 30) {
        this.trainCampName = this.trainCampName.slice(0, 30);
      }
    }
  },
  activated() {
    /**给对象添加两个字段用来控制展开和收起效果 */
    let tempArr = [];
    tempArr = JSON.parse(JSON.stringify(this.chapterList));
    tempArr.forEach(el => {
      el.expand = false;
      el.child.forEach(ele => {
        ele.isEdit = false;
      });
    });
    this.chapterList = tempArr;

    /**由于专栏和其它课程不在同一张表 所以用两个数组分别记录已经添加过的任务 防止重复添加 */
    this.chapterList.forEach(childsArr => {
      childsArr.child.forEach(el => {
        if (el.type_name != "专栏") {
          this.existChapterId.courseIdList.push(el.courseid);
        } else {
          this.existChapterId.columnIdList.push(el.courseid);
        }
      });
    });
  },
  methods: {
    /**添加目录 */
    addCampsiteList() {
      this.addNewCampsite = true;
    },
    /**
     * 监听子组件传值,改变centerDialogVisible状态
     */
    listenCenterDialogVisible(data) {
      this.centerDialogVisible = data;
    },
    /**
     * 添加任务
     * @param {Object} 要添加的对象
     */
    handleAddCampsite(item) {
      this.addCampsiteName = item.periodname;
      this.centerDialogVisible = true;
    },
    /**保存新的营期目录 */
    saveNewCampsite() {
      let campName = this.trainCampName.trim();
      if (campName.length > 0) {
        let obj = {
          periodname: campName,
          expand: false,
          child: []
        };
        this.chapterList.push(obj);
        this.addNewCampsite = false;
      }
    },
    /**全部展开 */
    allExpand() {
      let allExpand = this.chapterList.every(function(el) {
        return el.expand == true;
      });
      if (allExpand) {
        this.chapterList.forEach(el => {
          el.expand = false;
        });
        this.isAllExpand = false;
      } else {
        this.chapterList.forEach(el => {
          el.expand = true;
        });
        this.isAllExpand = true;
      }
    },
    /**要保存的课程内容 */
    saveCourseList(arr) {
      let index = this.chapterList.findIndex(el => {
        return el.periodname == this.addCampsiteName;
      });
      arr.forEach(el => {
        let obj = {
          type: el.courseType,
          title: el.title,
          try_it: false,
          isEdit: false
        };
        if (el.chargetype == "1") {
          obj.type_name = "图文";
        } else if (el.chargetype == "2") {
          obj.type_name = "考试";
        } else if (el.chargetype == "3") {
          obj.type_name = "社群";
        }

        // if（不是专栏）{}else if（是专栏）{}
        if (el.courseid) {
          obj.courseid = el.courseid;
          this.existChapterId.courseIdList.push(el.courseid);
        } else if (el.columnid) {
          obj.courseid = el.columnid;
          this.existChapterId.columnIdList.push(el.columnid);
        }
        this.chapterList[index].child.push(obj);
      });
    }
  }
};
</script>

<style scoped>
.train-camp-list .tips {
  background-color: #fdf6ec;
  color: #e6a23c;
  line-height: 22px;
  padding: 12px 15px;
  border-radius: 4px;
  margin: 20px 0;
}
.train-camp-list-box__header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding-left: 15px;
  font-size: 16px;
  position: relative;
}
.train-camp-list-box__header::before {
  content: "";
  width: 3px;
  height: 18px;
  background: #488bff;
  position: absolute;
  left: 0;
  top: 50%;
  margin-top: -9px;
}
.train-camp-list-box__container {
  border-radius: 5px;
  margin: 20px 0;
  color: #5e6062;
  overflow: hidden;
}
.train-camp-list-box__container .title-row {
  padding: 0 15px;
  background-color: #f6f7fb;
}
.train-camp-list-box__container .expand-all {
  color: #e64a3b;
}
.train-camp-list-box__container .grid-content {
  min-height: 36px;
  display: flex;
  align-items: center;
}
/* .train-camp-list-box__container .train-camp-list-box__title{} */
.train-camp-list-box__container .operate {
  justify-content: center;
}
.train-camp-list-box__item {
  border-bottom: 1px solid #eee;
  padding: 15px;
}
.train-camp-list-box__item .top .name {
  margin-left: 20px;
}
.train-camp-list-box__item .handle {
  display: flex;
  justify-content: flex-end;
}
.train-camp-list-box__item .handle i {
  font-size: 20px;
  margin-right: 20px;
  cursor: pointer;
}
.train-camp-list-box__item .bottom .bottom__index {
  border-bottom: 1px solid #eee;
  padding: 10px 0;
}
.train-camp-list-box__item .bottom .des {
  width: 100%;
  padding-left: 15px;
}
.train-camp-list-box__item .bottom .des .try-see-tag {
  padding: 0 5px;
  border: 1px solid #51bc55;
  color: #51bc55;
  border-radius: 2px;
  margin-left: 5px;
  box-sizing: border-box;
}
.train-camp-list-box__item .catalog {
  display: flex;
  align-items: center;
  width: 100%;
}
.train-camp-list-box__item .catalog__input {
  margin: 0 20px;
  max-width: 60%;
}
.train-camp-list-box__item .catalog__btn {
  width: 80px;
}

.train-camp-list-box__item .add-mission {
  background-color: #eef2f5;
  padding: 0 15px;
}
.train-camp-list-box__item .mission {
  width: 100%;
}
.train-camp-list-box__item .mission .grid-content {
  min-height: 50px;
}
.train-camp-list-box__item .mission__input {
  width: 300px;
}
.train-camp-list-box__item .selected {
  display: flex;
  justify-content: space-between;
  background-color: white;
  padding: 8px 10px;
  border-radius: 5px;
}
.train-camp-list-box__item .selected img {
  display: inline-block;
  width: 50px;
  height: 30px;
  margin-right: 10px;
  background-color: #cccccc;
}
.train-camp-list-box__item .selected__content {
  display: flex;
  align-items: center;
}
.train-camp-list-box__item .reelect {
  margin-left: 50px;
}
.train-camp-list-box__item .set-try-see {
  font-size: 12px;
  margin-bottom: 10px;
}
</style>
