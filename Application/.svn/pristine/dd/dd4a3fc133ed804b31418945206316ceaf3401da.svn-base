<template>
  <ks-container>
    <el-breadcrumb separator="/">
      <el-breadcrumb-item :to="{name:'FriendHelp'}">好友助力</el-breadcrumb-item>
      <el-breadcrumb-item>添加好友助力</el-breadcrumb-item>
    </el-breadcrumb>
    <el-row class="activity">
      <el-col :span="12" class="activity-box">
        <h2>活动信息</h2>
        <el-form :model="activityForm" :rules="rules" ref="resetFrom" label-width="90px">
          <el-form-item label="活动名称" prop="title">
            <el-input v-model="activityForm.title" placeholder="活动名称不超过10个字"></el-input>
          </el-form-item>
          <el-form-item label="活动时间" required prop="date">
            <el-date-picker
              v-model="activityForm.date"
              type="datetimerange"
              range-separator="至"
              start-placeholder="开始日期"
              end-placeholder="结束日期"
              style="width: 100%;max-width:600px;"
            ></el-date-picker>
          </el-form-item>
          <el-form-item label="助力人数" prop="num">
            <el-input v-model.number="activityForm.num" placeholder="可设置2-50人" @blur="monitor"></el-input>
          </el-form-item>
          <el-form-item class="activity-box__num-des">用户助力达到指定人数即可活动免费听课资格</el-form-item>
          <el-form-item label="优惠力度">
            <el-radio-group v-model="isDiscount">
              <el-radio :label="true">免费</el-radio>
              <el-radio :label="false">折扣</el-radio>
            </el-radio-group>
            <ks-input-number
              v-if="!isDiscount"
              v-model="discount"
              :min="0.1"
              :max="10"
              :decimalPlaces="2"
              max-width="150px"
              placeholder="设置范围0.1-10折"
            />
          </el-form-item>
        </el-form>
      </el-col>
      <el-col :span="12" class="activity-box">
        <h2>活动商品</h2>
        <el-button icon="el-icon-plus" class="activity-box__add-btn" @click="addCourse">添加商品</el-button>
        <!-- 表格 -->
        <el-table
          ref="multipleTable"
          :data="tableDataList"
          tooltip-effect="dark"
          style="width: 100%"
          @selection-change="handleSelectionChange"
          class="activity-table"
        >
          <el-table-column type="selection" width="55"></el-table-column>
          <el-table-column min-width="500">
            <template slot-scope="scope">
              <img :src="scope.row.defaultpic">
              <div class="activity-table__detail">
                <div class="activity-table__detail-title">{{scope.row.title}}</div>
                <div class="activity-table__detail-price">￥{{scope.row.price}}</div>
                <div
                  class="activity-table__detail-type"
                >商品类型:{{judgeCourseType(scope.row.course_type)}}</div>
              </div>
            </template>
          </el-table-column>
          <el-table-column label="操作" align="center" width="100">
            <template slot-scope="scope">
              <span @click="deleteCourse(scope.$index)">删除</span>
            </template>
          </el-table-column>
        </el-table>
        <!-- / -->
        <el-button plain size="mini" class="activity-box__delete-btn" @click="deleteSelectCourse">
          <i class="iconfont icon-shanchu1"></i>
        </el-button>
      </el-col>
    </el-row>
    <div class="footer">
      <el-button type="primary" @click="saveTrainCamp">保存返回</el-button>
      <el-button plain @click="cancel">取消</el-button>
    </div>
    <el-dialog title="添加商品" :visible.sync="dialogFormVisible" width="30%" class="add-dialog">
      <el-form :model="addInfo">
        <el-form-item label="【选择类型】">
          <el-select v-model="addInfo.name" placeholder="请选择添加类型" @change="getCourseData">
            <el-option label="课程" value="2"></el-option>
          </el-select>
        </el-form-item>
        <el-form-item label="【选择课程】">
          <el-select v-model="addInfo.courseIndex" placeholder="请选择活动区域">
            <el-option
              v-for="(item,index) in addInfo.list"
              :key="index"
              :label="item.title"
              :value="index"
              :disabled="disabledCourse(item.courseid)"
            ></el-option>
          </el-select>
        </el-form-item>
      </el-form>
      <div slot="footer" class="dialog-footer">
        <el-button type="primary" @click="confirmAddCourse">确 定</el-button>
      </div>
    </el-dialog>
  </ks-container>
</template>

<script>
// import { getStoreData } from "@/api/store";
import { addMarket, showMarket, getCourseList } from "@/api/friends.help";
export default {
  name: "FriendHelpAdd",
  data() {
    return {
      /**助力信息 */
      activityForm: {
        title: "", //活动标题
        date: [], //活动时间
        num: "" //需要助力人数
      },
      /**是否免费 */
      isDiscount: true,
      /**折扣信息 */
      discount: "",
      /**商品信息 */
      tableDataList: [],
      /**是否显示添加商品弹窗 */
      dialogFormVisible: false,

      /**添加商品 */
      addInfo: {
        name: "",
        courseIndex: "",
        list: []
      },
      /**表格选中的商品 */
      selectCourseList: [],
      /**表单验证规则 */
      rules: {
        title: [
          { required: true, message: "请输入活动名称" },
          { min: 0, max: 10, message: "长度在 0 到 10 个字符" }
        ],
        date: [
          {
            type: "array",
            required: true,
            message: "请选择日期"
          }
        ],
        num: [
          { required: true, message: "请输入人数" },
          { type: "number", message: "年龄必须为数字值", trigger: "change" }
        ]
      }
    };
  },
  computed: {
    /**判断商品类型 */
    judgeCourseType() {
      return function(num) {
        if (num == 1) {
          return "视频";
        } else if (num == 2) {
          return "直播";
        } else if (num == 3) {
          return "音频";
        } else if (num == 4) {
          return "图文";
        } else if (num == 5) {
          return "面授";
        } else if (num == 6) {
          return "活动";
        } else if (num == 7) {
          return "训练营";
        }
      };
    },
    /**禁止选择已选择的商品 */
    disabledCourse() {
      return function(courseid) {
        if (this.tableDataList.length > 0) {
          return this.tableDataList.some((el, index) => {
            return el.courseid == courseid;
          });
        }
      };
    }
  },
  activated() {
    if (this.$route.query.id) {
      showMarket({ id: this.$route.query.id }).then(res => {
        if ((res.result = "success")) {
          this.activityForm.title = res.title;
          this.activityForm.date = [];
          this.activityForm.date.push(
            this.formatTimestamp(res.starttime * 1000)
          );
          this.activityForm.date.push(this.formatTimestamp(res.endtime * 1000));
          this.activityForm.num = +res.num;
          if (res.discount == 0) {
            this.discount = "";
            this.isDiscount = true;
          } else {
            this.discount = res.discount;
            this.isDiscount = false;
          }
          this.tableDataList = res.json;
        }
      });
    } else {
      this.$refs.resetFrom.resetFields();
      this.discount = "";
      this.tableDataList = [];
    }
  },
  methods: {
    /**监听助力人数 */
    monitor() {
      if (this.activityForm.num > 0) {
        if (this.activityForm.num < 2) {
          this.activityForm.num = 2;
        } else if (this.activityForm.num > 50) {
          this.activityForm.num = 50;
        }
      }
    },
    /**表格选项发生改变时触发 */
    handleSelectionChange(value) {
      this.selectCourseList = value;
    },

    /**添加商品 */
    addCourse() {
      this.addInfo.name = "";
      this.addInfo.courseIndex = "";
      this.addInfo.list = [];
      this.dialogFormVisible = true;
    },
    /**添加商品时 类型改变时触发 */
    getCourseData() {
      // let param = [
      //   {
      //     act: "appCourse",
      //     callKeyName: "courseList",
      //     data: {
      //       courseType: 1,
      //       sql_or_like: {
      //         title: ""
      //       }
      //     },
      //     p: 1,
      //   },
      // ];
      // getStoreData(param).then(res => {
      //   console.log(res.courseList.list);
      //   this.addInfo.list = res.courseList.list;
      // });
      getCourseList({id:this.$route.query.id}).then(res => {
        this.addInfo.list = res;
      });
    },
    /**确定添加商品*/
    confirmAddCourse() {
      let ind = this.addInfo.courseIndex;
      this.tableDataList.push(this.addInfo.list[ind]);
      this.dialogFormVisible = false;
    },
    /**删除商品 */
    deleteCourse(index) {
      this.tableDataList.splice(index, 1);
    },
    /**删除选中商品 */
    deleteSelectCourse() {
      if (this.selectCourseList.length > 0) {
        this.selectCourseList.forEach(el => {
          let ind = this.tableDataList.findIndex(ele => {
            return el.courseid == ele.courseid;
          });
          this.tableDataList.splice(ind, 1);
        });
      }
    },

    /**保存返回 */
    saveTrainCamp() {
      this.$refs.resetFrom.validate(valid => {
        if (valid) {
          if (this.tableDataList.length == 0) {
            this.$msg("必须添加一种活动商品");
            return false;
          }
          let params = {
            title: this.activityForm.title,
            starttime: new Date(this.activityForm.date[0]).getTime(),
            endtime: new Date(this.activityForm.date[1]).getTime(),
            num: this.activityForm.num,
            discount: this.isDiscount ? "0" : this.discount,
            json: []
          };
          if (this.$route.query.id) {
            params.marketid = this.$route.query.id;
          }

          this.tableDataList.forEach(el => {
            let obj = {
              courseid: el.courseid,
              course_type: el.course_type
            };
            params.json.push(obj);
          });
          addMarket(params).then(res => {
            if ((res.result = "success")) {
              this.$router.go(-1);
            }
          });
        }
      });
    },
    /**取消返回 */
    cancel() {
      this.$router.go(-1);
    },
    /**时间戳转普通日期格式 */
    formatTimestamp(timestamp) {
      let data = new Date();
      return data.setTime(timestamp);
    }
  }
};
</script>

<style scoped>
.activity {
  padding: 20px 0;
}

.activity-box {
  padding: 0 20px;
}
.activity-box h2 {
  font-weight: normal;
  position: relative;
  padding-left: 15px;
  margin-bottom: 15px;
}
.activity-box h2::before {
  content: "";
  width: 3px;
  height: 18px;
  background: #488bff;
  position: absolute;
  left: 0;
  top: 50%;
  margin-top: -9px;
}
.activity-box-star {
  position: relative;
  color: red;
  vertical-align: middle;
}
.activity-box-time-line {
  text-align: center;
}
.activity-box__num-des {
  color: #a0a0a0;
}
.activity-box__add-btn {
  color: #488bfe;
  border: 1px dashed #488bfe;
  margin-bottom: 22px;
}
.activity-table img {
  width: 150px;
  height: 92px;
}
.activity-table__detail {
  width: calc(100% - 160px);

  display: inline-block;
  height: 92px;
  margin-left: 5px;
  vertical-align: top;
}
.activity-table__detail-title {
  font-size: 16px;
  min-height: 46px;
  font-weight: bold;
}
.activity-table__detail-price {
  color: #f03b3b;
  font-weight: bold;
}
.activity-table__detail-type {
  color: #aeaeae;
}
.activity-box__delete-btn {
  margin-top: 20px;
}
.footer {
  text-align: center;
}
.dialog-footer {
  text-align: center;
}
</style>
