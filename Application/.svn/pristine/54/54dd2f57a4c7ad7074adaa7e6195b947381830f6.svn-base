<template>
	<ks-container v-if="loading">
		<ks-title name="免费请好友看" border="none"/>
		<div class="friend-con">
			<el-tabs v-model="activeName" @tab-click="handleClick">
				<!-- 免费请好友看管理 -->
				<el-tab-pane label="免费请好友看管理" name="friendManage">
					<el-table :data="freeList" tooltip-effect="dark" style="width: 100%">
						<el-table-column prop="course_title" label="课程活动" align="center" min-width="200"></el-table-column>
						<el-table-column label="免费名额" align="center">
							<template slot-scope="scope">
								<span class="active-status">{{scope.row.json.single_content_num}}</span>人
							</template>
						</el-table-column>
						<el-table-column prop="json.same_person_num" label="同一好友最多可领取数" align="center"></el-table-column>
						<el-table-column prop="initiatenum" label="已分享次数" align="center"></el-table-column>
						<el-table-column prop="helpnum" label="已领取数" align="center"></el-table-column>
						<el-table-column label="创建时间" align="center" min-width="130">
              <template slot-scope="scope">
               <span>{{formatTimestamp(scope.row.createtime*1000)}}</span>
              </template>
            </el-table-column>
						<el-table-column label="状态" align="center">
							<template slot-scope="scope">
                <el-switch
                  v-model="scope.row.status"
                  active-value="1"
                  inactive-value="0"
                  active-color="#13ce66"
                  @change="changeSatus(scope.row)"
                ></el-switch>
							</template>
						</el-table-column>
						<el-table-column label="推广" align="center">
							<template slot-scope="scope">
								<i class="iconfont icon-fen-xiang table-share" @click="handleShare(scope.row)"></i>
							</template>
						</el-table-column>
						<el-table-column label="操作" align="center">
							<template slot-scope="scope">
								<el-dropdown trigger="click" placement="bottom">
									<span class="table-operation">...</span>
									<el-dropdown-menu slot="dropdown">
										<span @click="addFriendHelp('edit',scope.row)">
											<el-dropdown-item style="text-align:center;">编辑</el-dropdown-item>
										</span>
										<span @click="deleteFriendHelp(scope.row)">
											<el-dropdown-item style="text-align:center;">删除</el-dropdown-item>
										</span>
									</el-dropdown-menu>
								</el-dropdown>
							</template>
						</el-table-column>
					</el-table>
					<el-pagination
						background=""
						layout="prev, pager, next"
						:total="+freeListPage.totalput"
						:page-size="+freeListPage.maxperpage"
						@current-change="freeListPageChange"
						class="table-page"
					></el-pagination>
				</el-tab-pane>
				<!-- 免费请好友看订单 -->
				<el-tab-pane label="免费请好友看订单" name="friendOrder">
					<!-- freeOrderList -->
					<el-table :data="freeOrderList" tooltip-effect="dark" style="width: 100%">
						<el-table-column prop="userid" label="用户ID" align="center"></el-table-column>
						<el-table-column prop="name" label="用户昵称" align="center"></el-table-column>
						<el-table-column prop="mobile" label="手机号" align="center"></el-table-column>
						<el-table-column prop="course_title" label="分享专栏" align="center" min-width="150"></el-table-column>
						<el-table-column prop="chapter_title" label="分享的章节" align="center" min-width="150"></el-table-column>
            <el-table-column label="领取次数" align="center" min-width="130">
							<template slot-scope="scope">
								<div><span class="active-status">{{scope.row.receive_count}}</span>/<span>{{scope.row.single_content_num}}</span></div>
							</template>
						</el-table-column>
						<el-table-column label="分享时间" align="center" min-width="130">
							<template slot-scope="scope">
								<span>{{formatTimestamp(scope.row.createtime*1000)}}</span>
							</template>
						</el-table-column>
						<el-table-column prop="ip" label="IP" align="center"></el-table-column>
					</el-table>
					<el-pagination
						v-if="freeOrderListPage"
						background=""
						layout="prev, pager, next"
						:total="+freeOrderListPage.totalput"
						:page-size="+freeOrderListPage.maxperpage"
						@current-change="freeOrderListPageChange"
						class="table-page"
					></el-pagination>
				</el-tab-pane>
			</el-tabs>
			<div class="friend-con-addhelp">
				<el-popover
					placement="bottom"
					width="200"
					trigger="click"
					:disabled="activeName!='friendManage'"
				>
					<div>
						<span>状态 :</span>
						<span :class="activeStatusIndex==0?'active-status':''" @click="showStatusList(0)">不限</span>
						<span :class="activeStatusIndex==1?'active-status':''" @click="showStatusList(1)">已开启</span>
						<span :class="activeStatusIndex==2?'active-status':''" @click="showStatusList(2)">未开启</span>
					</div>
					<el-button slot="reference" type="primary" icon="iconfont icon-filter" size="small"></el-button>
				</el-popover>
				<el-button type="primary" icon="iconfont icon-plus" size="small" @click="addFriendHelp('add')">添加请好友看</el-button>
			</div>
		</div>
		<el-dialog :visible.sync="dialogVisible" width="50%" class="add-dialog" :show-close="false">
			<el-form :model="addCourseList" label-width="220px">
				<div class="el-form-item-title">添加课程</div>
				<el-form-item label="【选择课程】">
					<el-select
						v-model="addCourseName"
						placeholder="请选择添加课程"
						@change="getCourseName"
						style="width:60%;"
						ref="courseid"
					>
						<el-option
							v-for="(item,index) in addCourseList"
							:key="index"
							:label="item.title"
							:value="item.courseid"
							:disabled="disabledCourse(item.courseid)"
						></el-option>
					</el-select>
					<div class="el-form-item-tip">购买课程后的用户才有免费请好友看的权限</div>
				</el-form-item>
				<div class="el-form-item-title">设置</div>
				<el-form-item label="可以免费邀请的学习的好友数">
					<ks-input-number
						v-model="single_content_num"
						:min="1"
						style="max-width:60%;"
						ref="single_content_num"
					/>
					<div class="el-form-item-tip">超过次数需用户付费购买赠送课程</div>
				</el-form-item>
				<el-form-item label="同一个好友可领取的节数">
					<ks-input-number
						v-model="same_person_num"
						:min="1"
						style="max-width:60%;"
						ref="same_person_num"
					/>
				</el-form-item>
			</el-form>
			<div slot="footer" class="dialog-footer">
        <el-button @click="dialogVisible = false">取 消</el-button>
				<el-button type="primary" @click="confirmAddColumn">确 定</el-button>
			</div>
		</el-dialog>
		<dialogShare :dialogVisible="shareDialog" :shareObj="shareObj" @closeShare="shareDialog=false"></dialogShare>
	</ks-container>
</template>

<script>
import {
  freeList,
  freeOrderList,
  shareFree,
  courseList,
  changeFree,
  addFree,
  delFree
} from "@/api/free.look";
import dialogShare from "./components/dialogShare";
export default {
  name: "PleaseFriend",
  components: {
    dialogShare
  },
  data() {
    return {
      loading: false,
      /**当前选项卡选择项 */
      activeName: "friendManage",
      /**当前状态索引 */
      activeStatusIndex: 0, //其它 不限 2未开启，1已开启,
      /**是否显示添加课程弹窗 */
      dialogVisible: false,
      /**活动id */
      freeid: null,
      /**免费请好友看管理列表 */
      freeList: [],
      /**免费请好友看管理列表分页数据 */
      freeListPage: null,
      freeListCurrentPage: 1,
      /**是否出现分享弹出框 */
      shareDialog: false,
      /**分享信息 */
      shareObj: null,
      /**免费请好友看订单列表 */
      freeOrderList: [],
      /**免费请好友看订单列表分页数据 */
      freeOrderListPage: null,
      freeOrderListCurrentPage: 1,
      /**添加请好友看课程列表 */
      addCourseList: [],
      /**选择课程 */
      addCourseName: "",
      /**课程id */
      courseid: null,
      /**	可以免费邀请的学习的好友数 */
      single_content_num: 1,
      /**同一个好友可领取的节数 */
      same_person_num: 1
    };
  },
  computed: {
    /**格式化时间戳 */
    formatTimestamp() {
      /**
       * @param {Number} 时间戳
       */
      return function(time) {
        if (time == 0) {
          return "";
        }
        let data = new Date(parseInt(time));
        let y = data.getFullYear();
        let m = data.getMonth() + 1;
        let d = data.getDate();
        let h = data.getHours();
        let mm = data.getMinutes();
        let s = data.getSeconds();
        m = m < 10 ? "0" + m : m;
        d = d < 10 ? "0" + d : d;
        h = h < 10 ? "0" + h : h;
        mm = mm < 10 ? "0" + mm : mm;
        s = s < 10 ? "0" + s : s;
        return y + "." + m + "." + d + " " + h + ":" + mm;
      };
    },
    /** 是否禁止选择 */
    disabledCourse() {
      return function(courseid) {
        this.freeList.some(el => {
          return el.courseid == courseid;
        });
      };
    }
  },
  activated() {
	this.loading = false;
	this.activeName = "friendManage";
    this.getFreeList();
  },
  methods: {
    /**选项卡选项改变时触发 */
    handleClick(tab, event) {
      if (this.activeName == "friendManage") {
        this.getFreeList();
      } else if (this.activeName == "friendOrder") {
        this.getFreeOrderList();
      }
    },
    /**根据当前状态显示列表 */
    showStatusList(index) {
      if (this.activeName == "friendManage") {
        this.activeStatusIndex = index;
        this.getFreeList({ status: index });
      }
    },
    /**添加请好友看 */
    addFriendHelp(value = "add", item) {
      let params;
      if(value == "add"){
        params = {};
      }else{
        params = {
          freeid:item.id
        }
      }
      courseList(params).then(res => {
        this.addCourseList = res;
        if (value == "add") {
          this.freeid = null;
          this.addCourseName = "";
          this.single_content_num = 1;
          this.same_person_num = 1;
        } else if (value == "edit") {
          this.freeid = item.id;
          this.courseid = item.json.courseid;
          this.addCourseName = item.course_title;
          this.single_content_num = item.json.single_content_num * 1;
          this.same_person_num = item.json.same_person_num * 1;
        }

        this.dialogVisible = true;
      });
    },
    /**确定添加课程 */
    confirmAddColumn() {
      if (this.courseid == null) {
        this.$msg("课程名称不能为空");
        this.$refs.courseid.focus();
        return false;
      }
      if (!this.single_content_num) {
        this.$msg("可以免费邀请的学习的好友数不能为空");
        this.$refs.single_content_num.focus();
        return false;
      }
      if (!this.same_person_num) {
        this.$msg("同一个好友可领取的节数");
        this.$refs.single_content_num.focus();
        return false;
      }
      let params = {
        json:{
          courseid:this.courseid,
          single_content_num:this.single_content_num,
          same_person_num:this.same_person_num,
        }
      }
      if (this.freeid) {
        params.freeid = this.freeid;
      }
      addFree(params).then(res => {
        this.getFreeList();
        this.dialogVisible = false;
      });
    },
    /** 删除请好友看 */
    deleteFriendHelp(item) {
      delFree({ freeid: item.id }).then(res => {
        this.getFreeList();
        this.dialogVisible = false;
      });
    },
    /** 课程名称变化时触发 */
    getCourseName(value) {
      this.courseid = value;
    },
    /** 打开推广弹窗 */
    handleShare(item) {
      this.shareObj = null;
      shareFree({ courseid: item.json.courseid }).then(res => {
        let obj = {
          way: "link",
          link: res.link,
          qrCode: res.qrcode
        };
        this.shareObj = obj;
        this.shareDialog = true;
      });
    },
    /** 关闭或开启活动状态 */
    changeSatus(item) {
      changeFree({ freeid: item.id }).then(res => {
        this.getFreeList();
      });
    },
    /**免费请好友看管理页数发生变化时触发 */
    freeListPageChange(value) {
      this.freeListCurrentPage = value;
      this.getFreeList({ p: value });
    },
    /**免费请好友看订单页数发生变化时触发 */
    freeOrderListPageChange(value) {
      this.freeOrderListCurrentPage = value;
      this.getFreeOrderList({ p: value });
    },
    /**获取免费请好友看管理列表 */
    getFreeList(params) {
      let defaultParams = {
        status: "",
        p: this.freeListCurrentPage,
        maxperpage: 10
      };
      freeList({ ...defaultParams, ...params }).then(res => {
        this.freeList = res.list;
        this.freeListPage = res.page;
        this.loading = true;
      });
    },
    /** 获取免费请好友看订单列表 */
    getFreeOrderList(params) {
      let defaultParams = {
        status: "",
        p: 1,
        maxperpage: 10
      };
      freeOrderList({ ...defaultParams, ...params }).then(res => {
        this.freeOrderList = res.list;
        this.freeOrderListPage = res.page;
        this.loading = true;
      });
    }
  }
};
</script>

<style scoped>
.friend-con {
  position: relative;
}
.friend-con-addhelp {
  position: absolute;
  right: 0;
  top: -6px;
}
.active-status {
  color: #409eff;
}
.table-share {
  font-size: 22px;
  color: #fc6b32;
  cursor: pointer;
}
.table-operation {
  width: 50px;
  font-size: 16px;
  font-weight: bold;
  position: relative;
  top: -5px;
}
.table-page {
  text-align: right;
  margin-top: 25px;
}
.el-form-item-title {
  font-size: 20px;
  font-weight: 500;
  margin-bottom: 10px;
}
.el-form-item-tip {
  width: 60%;
  color: #c4c4c4;
  font-size: 12px;
  line-height: 1.5;
}
</style>
