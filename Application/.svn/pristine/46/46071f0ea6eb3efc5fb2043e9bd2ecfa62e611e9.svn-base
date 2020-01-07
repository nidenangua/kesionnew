<template>
  <ks-container class="add-activity" v-if="loading">
    <el-breadcrumb separator="/">
      <el-breadcrumb-item :to="{ path: '/activityregist' }">活动报名</el-breadcrumb-item>
      <el-breadcrumb-item>编辑活动</el-breadcrumb-item>
    </el-breadcrumb>
    <div class="tips">请您遵守国家相关规定，切勿上传低俗色情、暴力恐怖、谣言诈骗、侵权盗版等相关内容，课堂街保有依据国家规定及平台规则进行处理的权利。</div>
    <div class="basic-information">
      <div class="information__title">基本信息</div>
      <div class="information__box">
        <div class="information__row">
          <span class="information__name">
            <span class="information__star">*</span>
            活动名称
          </span>
          <el-input v-model="addActivityForm.title" ref="activityTitle">
            <span slot="suffix" class="information-row-number">{{addActivityForm.title.length}}/30</span>
          </el-input>
        </div>
        <div class="information__row">
          <span class="information__name">
            简短描述<span class="shortdesc">(用于微信分享)</span>
          </span>
          <el-input v-model="addActivityForm.shortdesc" ref="activityTitle">
            <span slot="suffix" class="information-row-number">{{addActivityForm.shortdesc.length}}/45</span>
          </el-input>
        </div>
        <div class="information__row">
          <span class="information__name">
            <span class="information__star">*</span>
            活动封面
          </span>
          <div class="basic-information__pic">
            <ks-image :src="addActivityForm.defaultpic" class="ks-image"/>
            <div>
              <el-button @click="$uploadImages(addActivityForm,'defaultpic')" plain>上传图片</el-button>
              <div class="advice">建议尺寸750*465px，JPG、PNG格式， 图片小于1M。</div>
            </div>
          </div>
        </div>
        <div class="information__row">
          <span class="information__name">
            <span class="information__star">*</span>
            活动详情
          </span>
          <div>
            <ks-editor
              title="活动详情"
              v-model="addActivityForm.content"
              :z-index="90"
              :wordCount="true"
            />
          </div>
        </div>
      </div>
    </div>
    <div class="activity-information">
      <div class="information__title">活动信息</div>
      <div class="information__box">
        <div class="information__row">
          <span class="information__name">
            <span class="information__star">*</span>
            活动时间
          </span>
          <el-date-picker
            v-model="activityTime"
            type="datetimerange"
            range-separator="至"
            start-placeholder="开始日期"
            end-placeholder="结束日期"
            size="small"
            ref="activityPicker"
          ></el-date-picker>
        </div>
        <div class="information__row">
          <span class="information__name">
            <span class="information__star">*</span>
            活动地点
          </span>
          <el-input placeholder="" v-model="addActivityForm.address" ref="activityAddress"></el-input>
        </div>
        <div class="information__row">
          <span class="information__name">
            <span class="information__star">*</span>
            主办方
          </span>
          <el-input placeholder="" v-model="addActivityForm.sponsor" ref="activitySponsor"></el-input>
        </div>
      </div>
    </div>
    <div class="enroll-set">
      <div class="information__title">报名设置</div>
      <div class="information__box">
        <div class="information__row">
          <span class="deposit">是否开启保证金
            <el-popover
              placement="top"
              width="100"
              trigger="click"
              content="开启保证金后 , 保证金如需退款 , 请在线下完成退款"
            >
              <i class="iconfont icon-yiwen" slot="reference"></i>
            </el-popover>
          </span>
          <el-radio-group v-model="addActivityForm.is_pledge" @change="openDeposit">
            <el-radio label="0">关闭</el-radio>
            <el-radio label="1">开启</el-radio>
          </el-radio-group>
        </div>
        <div class="information__row" v-if="addActivityForm.is_pledge!=0">
          <span class="deposit">
            保证金付款方式
            <i class="iconfont icon-yiwen"></i>
          </span>
          <el-radio-group v-model="addActivityForm.paymodel">
            <el-radio label="1">可以只付保证金</el-radio>
            <el-radio label="0">只允许一起付</el-radio>
          </el-radio-group>
        </div>
        <div class="information__row">
          <div class="enroll-set-box">
            <el-row class="enroll-set-box__header">
              <el-col :span="3">票种名称</el-col>
              <el-col :span="3">价格 ( 元 )</el-col>
              <el-col :span="3">张数</el-col>
              <el-col :span="3">限购</el-col>
              <el-col :span="3">审核设置</el-col>
              <el-col :span="3">保证金 ( 元 )</el-col>
              <el-col :span="3">状态</el-col>
              <el-col :span="3">操作</el-col>
            </el-row>
            <el-row v-for="(item, index) in tableData" :key="index">
              <el-row class="enroll-set-box__row" v-if="!isEditing(index)">
                <el-col :span="3" class="activity__title">{{item.title}}</el-col>
                <el-col :span="3">{{item.chargetype==0?"免费":item.price}}</el-col>
                <el-col :span="3">{{item.num}}</el-col>
                <el-col :span="3">{{item.purchase_limit}}</el-col>
                <el-col :span="3">{{item.check == 1?"需要审核":"不需要审核"}}</el-col>
                <el-col :span="3">{{addActivityForm.is_pledge==0?"--":item.cash_deposit}}</el-col>
                <el-col :span="3">{{item.status==0?"暂未开始":item.status==1?"发售中":"停止发售"}}</el-col>
                <el-col :span="3" class="operation-icon">
                  <el-tooltip class="item" effect="dark" content="编辑" placement="bottom">
                    <i class="iconfont icon-bianji" @click="openEdit(index)"></i>
                  </el-tooltip>
                  <el-tooltip class="item" effect="dark" content="删除" placement="bottom">
                    <i class="iconfont icon-shanchu1" @click="deleteTicket(index)"></i>
                  </el-tooltip>
                </el-col>
              </el-row>
              <el-row class="enroll-set-box__add-row" v-else>
                <el-row>
                  <el-col :span="3">
                    <el-input
                      v-model="item.title"
                      :placeholder="item.placeholder"
                      class="add-ticket__input"
                    ></el-input>
                  </el-col>
                  <el-col :span="3" v-if="item.chargetype==0">免费</el-col>
                  <el-col :span="3" v-else>
                    <ks-input-number
                      v-model="item.price"
                      :min="0.01"
                      :decimalPlaces="2"
                      class="add-ticket__input"
                      :ref="`ticketPrice${index}`"
                    />
                  </el-col>
                  <el-col :span="3">
                    <ks-input-number
                      v-model="item.num"
                      :min="1"
                      class="add-ticket__input"
                      :ref="`ticketNum${index}`"
                      @change="handleChangeNum(index)"
                    />
                  </el-col>
                  <el-col :span="3">
                      <ks-input-number
                        v-model="item.purchase_limit"
                        :min="1"
                        :max="+item.num"
                        class="add-ticket__input"
                        :ref="`ticketLimit${index}`"
                      ></ks-input-number>
                  </el-col>
                  <el-col :span="3">
                    <el-select v-model="item.check" class="add-ticket__input">
                      <el-option value="0" label="不需要审核"></el-option>
                      <el-option value="1" label="需要审核" v-if="addActivityForm.is_pledge !=1 && !clicktype"></el-option>
                    </el-select>
                  </el-col>
                  <el-col :span="3">
                    <span v-if="addActivityForm.is_pledge==0">--</span>
                    <ks-input-number
                      v-else
                      :decimalPlaces="2"
                      :min="0.01"
                      v-model="item.cash_deposit"
                      class="add-ticket__input"
                      :ref="`ticketDeposit${index}`"
                    />
                  </el-col>
                  <el-col :span="3">--</el-col>
                  <el-col :span="3" class="operation-icon">
                    <el-tooltip class="item" effect="dark" content="保存" placement="bottom">
                      <i class="iconfont icon-success" @click="editSaveTicket(index)"></i>
                    </el-tooltip>
                    <el-tooltip class="item" effect="dark" content="删除" placement="bottom">
                      <i class="iconfont icon-shanchu1" @click="deleteTicket(index)"></i>
                    </el-tooltip>
                  </el-col>
                </el-row>
                <el-row class="add-ticket-textarea">
                  <el-col :span="2" class="title">票种说明</el-col>
                  <el-input type="textarea" v-model="item.explain"></el-input>
                </el-row>
                <el-row class="add-ticket-textarea">
                  <el-col :span="2" class="title">订购日期</el-col>
                  <el-radio-group v-model="item.order_date_type">
                    <el-radio label="0">默认为活动发布后至活动结束前</el-radio>
                    <el-radio label="1">自定义</el-radio>
                  </el-radio-group>
                </el-row>
                <el-row class="add-ticket-textarea" v-if="item.order_date_type==1">
                  <el-col :span="2" class="title"></el-col>
                  <el-date-picker
                    v-model="item.order_date"
                    type="datetimerange"
                    range-separator="至"
                    start-placeholder="开始日期"
                    end-placeholder="结束日期"
                    size="small"
                  ></el-date-picker>
                </el-row>
                <el-row class="add-ticket-textarea">
                  <el-col :span="2" class="title">有效日期</el-col>
                  <el-radio-group v-model="item.effective_date_type">
                    <el-radio label="0">默认为活动发布后至活动结束前</el-radio>
                    <el-radio label="1">自定义</el-radio>
                  </el-radio-group>
                </el-row>
                <el-row class="add-ticket-textarea" v-if="item.effective_date_type==1">
                  <el-col :span="2" class="title"></el-col>
                  <el-date-picker
                    v-model="item.effective_date"
                    type="datetimerange"
                    range-separator="至"
                    start-placeholder="开始日期"
                    end-placeholder="结束日期"
                    size="small"
                  ></el-date-picker>
                </el-row>
              </el-row>
            </el-row>
            <el-row class="enroll-set-box__add-ticket">
              <el-button plain type="primary" @click="addTicketHandle(0)">添加免费票</el-button>
              <el-button plain type="primary" @click="addTicketHandle(1)">添加付费票</el-button>
            </el-row>
          </div>
          <div style="margin-top:10px;">
            作弊人数 &nbsp;
            <el-input
              type="text"
              style="width:120px"
              v-model="addActivityForm.studentcount"
              maxlength="6"
              show-word-limit
            >
            </el-input>
          </div>
        </div>
      </div>
    </div>
    <div class="registration-from-set">
      <div class="information__title">报名表单设置</div>
      <div class="information__box">
        <div class="information__row">
          <span class="information__name">联系方式(报名用户资料 , 必填)</span>
          <div v-for="(item,index) in contact" :key="index">
            <el-row class="form-set__row" v-if="index<2">
              <el-col :span="2">
                <el-checkbox v-model="item.required" disabled true-label="1" false-label="0">必填</el-checkbox>
              </el-col>
              <el-col :span="2" class="name">{{item.name}}</el-col>
              <el-col :span="10">
                <el-input :placeholder="'报名用户的'+item.name" size="small" disabled></el-input>
              </el-col>
            </el-row>
            <el-row v-if="index==1">
              <span class="information__name">自定义表单</span>
            </el-row>
            <el-row v-if="index>=2" class="form-set__row">
              <el-col :span="2">
                <el-checkbox v-model="item.required" true-label="1" false-label="0">必填</el-checkbox>
              </el-col>
              <el-col :span="2" class="name">
                <el-input
                  v-model="item.name"
                  :placeholder="item.type=='text'?'单行文本':item.type=='textarea'?'多行文本':item.type=='radio'?'单选':'多选'"
                  size="small"
                  :ref="`customFormName${index}`"
                ></el-input>
              </el-col>
              <el-col v-if=" item.type=='text' || item.type=='textarea' " :span="10">
                <el-input placeholder="填写提示信息" v-model="item.placeholder" size="small"></el-input>
              </el-col>
              <el-col :span="2" class="custom mr10 custom-option" v-for="(conitem,conind) in item.content" :key="conind">
                  {{conitem}}
                  <i class="iconfont icon-icons-" @click="deleteOption(index,conind)"></i>
              </el-col>
              <el-col :span="2" class="mr10" v-if="item.tempValue && item.tempValue.length>=0">
                <el-input size="small" v-model="item.tempValue" @blur="confirmOption(index)" :ref="`customOption${index}`"></el-input>
              </el-col>
              <el-col v-if=" item.type=='radio' || item.type=='checkbox' " :span="2">
                  <el-button primary size="small" @click="addOption(index)">添加选项</el-button>
              </el-col>
              <el-col :span="2" class="delete-icon">
                <el-tooltip class="item" effect="dark" content="删除" placement="bottom">
                  <i class="iconfont icon-shanchu1" @click="deleteInput(index)"></i>
                </el-tooltip>
              </el-col>
            </el-row>
          </div>
          <el-row class="add-input">
            <el-button primary size="small" @click="addInput('text')">添加单行文本框</el-button>
            <el-button primary size="small" @click="addInput('textarea')">添加多行文本框</el-button>
            <el-button primary size="small" @click="addInput('radio')">添加单选</el-button>
            <el-button primary size="small" @click="addInput('checkbox')">添加多选</el-button>
          </el-row>
          
        </div>
      </div>
    </div>
    <div class="publish-set">
      <div class="information__title">发布设置</div>
      <div class="publish-set__row">
        <div class="information__row">
          <el-col :span="2">是否发布</el-col>
          <el-col :span="2">
            <el-switch
              v-model="addActivityForm.status"
              active-value="2"
              inactive-value="0"
              active-color="#13ce66"
            ></el-switch>
          </el-col>
        </div>
      </div>
    </div>
    <div class="add-activity-footer">
      <el-button type="primary" size="small" @click="saveTrainCamp">保存返回</el-button>
      <el-button plain size="small" @click="cancel">取消</el-button>
    </div>
  </ks-container>
</template>

<script>
import { addActivity, courseDetail } from "@/api/microportal";
export default {
  name: "AddActivity",
  data() {
    return {
      /**点击的票种类型 */
      clicktype:'',
      loading: false,
      addActivityForm: {
        /**微信分享 */
        shortdesc:'',
        /**活动名称*/
        title: "",
        /**封面图片地址 */
        defaultpic: "",
        studentcount:0,
        /**活动详情 */
        content: "",
        /**开始时间 */
        begindate: null,
        /**结束时间 */
        enddate: null,
        /**活动地点 */
        address: "",
        /**主办方 */
        sponsor: "",
        /**是否开启保证金  1是0否*/
        is_pledge: 0,
        /**保证金付款方式  1只付保证金0只能一起付*/
        paymodel: 1,
        /**票种信息 */
        ticket_info: [],
        /**表单字段 */
        form_field: [],
        /**是否上架 */
        status: 0
      },
      /**活动时间 */
      activityTime: [],
      /**票种信息 */
      tableData: [],
      /**正在编辑的票种 */
      editTicketIndex: [],
      /**联系方式 */
      contact: [
        {
          field: "realname",
          name: "姓名",
          type: "text",
          placeholder: "报名用户的姓名",
          content: [],
          required: "1"
        },
        {
          field: "tel",
          name: "手机号码",
          type: "text",
          placeholder: "报名用户的手机号码",
          content: [],
          required: "1"
        }
      ],
      /**当前时间 */
      currentTime: 0,
      timer: null,
      /**编辑页面的时候记住后台传过来的值  然后保存的时候在传回去 */
      ticket_max:"",
    };
  },
  computed: {
    /**
     * 是否展开编辑行
     * @param {Number} 当前点击编辑的索引
     */
    isEditing() {
      return function(index) {
        return this.editTicketIndex.includes(index);
      };
    }
  },
  watch: {
    /**活动名称字数限制 */
    "addActivityForm.title": function(newValue, oldValue) {
      if (newValue.length > 30) {
        this.addActivityForm.title = oldValue;
      }
    },
    "addActivityForm.shortdesc":function(newVal,oldVal){
      if(newVal.length > 45) {
        this.addActivityForm.shortdesc = oldVal;
      }
    },
    /**把活动时间放入要提交的表单对象里面 */
    activityTime: function() {
      if (this.activityTime) {
        let timeArr = this.activityTime.map(el => {
          return new Date(el).getTime();
        });
        this.addActivityForm.begindate = timeArr[0];
        this.addActivityForm.enddate = timeArr[1];
      }
    }
  },
  activated() {
    this.loading = false;
    this.activityTime = [];

    this.currentTime = Math.ceil(new Date().getTime() / 1000);
    this.timer = setInterval(() => {
      this.currentTime += 1;
    }, 1000);

    let id = this.$route.query.id;
    if (id) {
      courseDetail({ id }).then(res => {
        this.pageData(res.courseinfo);
        
      });
    }else{
      this.addPageData();
    }
  },
  deactivated() {
    clearInterval(this.timer);
  },
  methods: {
    openDeposit() {
      this.tableData.map(item=>{
        if(this.addActivityForm.is_pledge == 1) {
          item.check = "0"
        }
      })
    },
    /**
     * 点击出现添加票信息
     * @param {Number} 判断要添加票的种类
     *  */
    addTicketHandle(value) {
      this.clicktype = value
      let obj = {
        title: "",
        placeholder: "免费票",
        chargetype: "0",
        price: "1",
        num: "100",
        purchase_limit:"1",
        check: "0",
        cash_deposit: "10",
        status: "1",
        explain: "",
        order_date_type: "0",
        order_date: [],
        effective_date_type: "0",
        effective_date: []
      };
      if (value == 1) {
        obj.title = "";
        obj.chargetype = 1;
        obj.placeholder = "付费票";
      }
      this.editTicketIndex.push(this.tableData.length);
      this.tableData.push(obj);
    },
    /**监听订购日期改变 */
    // orderDataChange(index){
    //    if(new Date(this.tableData[index].order_date[1]).getTime()>this.addActivityForm.enddate){
    //       this.tableData[index].order_date[1] = this.formatTimestamp(this.addActivityForm.enddate);
    //    }
    //    let time1 = new Date(this.tableData[index].order_date[1]).getTime();
    //    let time2 = new Date(this.tableData[index].effective_date[1]).getTime();
    //    if(this.tableData[index].effective_date_type!=0 && time1>time2){
    //      this.tableData[index].effective_date.splice(1,1,this.tableData[index].order_date[1]);
    //    }
    // },
    /**监听有效日期改变 */
    // effectiveDataChange(index){
    //     if(new Date(this.tableData[index].effective_date[1]).getTime()>this.addActivityForm.enddate){
    //         this.tableData[index].order_date[1] = this.formatTimestamp(this.addActivityForm.enddate);
    //     }
    //     if(this.tableData[index].order_date_type==0){
    //       this.tableData[index].effective_date[1] = this.formatTimestamp(this.addActivityForm.enddate);
    //     }else{
    //       if(new Date(this.tableData[index].effective_date[1]).getTime()<new Date(this.tableData[index].order_date[1]).getTime()){
    //           this.tableData[index].effective_date[1] = this.tableData[index].order_date[1];
    //       }
    //     }
    // },
    /**
     * 编辑票种
     * @param {Number} 判断当前编辑的是哪一个
     *  */
    openEdit(index) {
      this.editTicketIndex.push(index);
      this.tableData[index].placeholder = this.tableData[index].title;
      this.tableData[index].title = "";
    },
    /**票种张数发生变化 */
    handleChangeNum(index){
      // console.log(this.tableData[index]);
      if(this.tableData[index].purchase_limit > this.tableData[index].num ){
          this.tableData[index].purchase_limit = this.tableData[index].num;
          return;
      }
    },
    /** 删除票种
     * @param {Number} 判断当前删除的是哪一个
     */
    deleteTicket(index) {
      this.tableData.splice(index, 1);
      let ind = this.editTicketIndex.findIndex(el => el == index);
      this.editTicketIndex.splice(ind, 1);
    },
    /**
     * 编辑保存
     * @param {Number} 当前要保存的票种索引
     */
    editSaveTicket(index) {
      if (!this.tableData[index].title.length > 0) {
        this.tableData[index].title = this.tableData[index].placeholder;
      }
      let ind = this.editTicketIndex.findIndex(el => el == index);
      if (this.tableData[index].order_date_type == 0) {
        if (!this.activityTime) {
          this.$msg("活动时间不能为空");
          return;
        }
        this.tableData[index].order_date = this.activityTime;
      } else {
        if (!this.tableData[index].order_date) {
          this.$msg("活动时间不能为空");
          return;
        }
      }

      if (this.tableData[index].effective_date_type == 0) {
        if (!this.activityTime) {
          this.$msg("活动时间不能为空");
          return;
        }
        this.tableData[index].effective_date = this.activityTime;
      } else {
        if (!this.tableData[index].effective_date) {
          this.$msg("活动时间不能为空");
          return;
        }
      }

      if (this.tableData[index].order_date.length == 0) {
        this.$msg("请选择活动时间");
        return;
      }

      let beginTime = Math.ceil(
        new Date(this.tableData[index].order_date[0]).getTime() / 1000
      );
      let endTime = Math.ceil(
        new Date(this.tableData[index].order_date[1]).getTime() / 1000
      );

      if (beginTime > this.currentTime) {
        this.tableData[index].status = 0;
      }

      if (beginTime <= this.currentTime && endTime >= this.currentTime) {
        this.tableData[index].status = 1;
      }

      if (endTime < this.currentTime) {
        this.tableData[index].status = 2;
      }

      if (this.tableData[index].title.length <= 0) {
        this.$msg("票种名称不能为空");
      } else if (this.tableData[index].price.length <= 0) {
        this.$msg("价格不能为空");
        this.$refs[`ticketPrice${index}`][0].focus();
      } else if (this.tableData[index].num.length <= 0) {
        this.$msg("张数不能为空");
        this.$refs[`ticketNum${index}`][0].focus();
      } else if(this.tableData[index].purchase_limit.length<=0){
        this.$msg("限购张数不能为空");
        this.$refs[`ticketLimit${index}`][0].focus();
      }else if (this.tableData[index].cash_deposit.length <= 0) {
        this.$msg("保证金不能为空");
        this.$refs[`ticketDeposit${index}`][0].focus();
      } else {
        this.editTicketIndex.splice(ind, 1);
      }
    },
    /**添加自定义表单
     * @param {String} 要添加的文本框类型
     */
    addInput(inputType) {
      let obj = {
        field: "custom" + (this.contact.length - 1),
        name: "",
        placeholder: "",
        type: inputType,
        content: [],
        required: "0"
      };
      this.contact.push(obj);
    },
    /**
     * 删除文本框
     *  @param {Number} 要删除文本框的索引
      */
    deleteInput(index) {
      this.contact.splice(index, 1);
    },
    /**
     * 添加自定义选项
     * @param {Number} 要添加选项的文本框索引
     */
    addOption(index){
      let tempContact = JSON.parse(JSON.stringify(this.contact));
      tempContact[index].tempValue = " ";
      this.contact = tempContact;
      this.$nextTick(()=>{
        this.$refs[`customOption${index}`][0].focus();
      })
    },
    /**失去焦点时保存选项 */
    confirmOption(index){
      this.contact[index].content.push(this.contact[index].tempValue);
      delete this.contact[index].tempValue;
    },
    /**
     * 删除自定义选项
     * @param {Number} 要删除选项的文本框索引
     * @param {Number} 要删除的选项的索引
    */
    deleteOption(index,conind){
      this.contact[index].content.splice(conind,1);
    },
    /**时间戳转普通日期格式 */
    formatTimestamp(timestamp) {
      let data = new Date();
      return data.setTime(timestamp);
    },
    /**编辑页面的数据 */
    pageData(courseinfo) {
      this.addActivityForm.title = KS.restr(courseinfo.title)
      this.addActivityForm.defaultpic = courseinfo.defaultpic
      this.addActivityForm.content = courseinfo.content 
      this.addActivityForm.shortdesc = KS.restr(courseinfo.shortdesc)
      this.activityTime.push(
        this.formatTimestamp(courseinfo.json.setting.begindate)
      );
      this.activityTime.push(
        this.formatTimestamp(courseinfo.json.setting.enddate)
      );
      this.addActivityForm.studentcount = courseinfo.studentcount
      this.addActivityForm.address = courseinfo.json.setting.address;
      this.addActivityForm.sponsor = courseinfo.json.setting.sponsor;
      this.addActivityForm.is_pledge = courseinfo.json.setting.is_pledge;
      this.addActivityForm.paymodel = courseinfo.json.setting.paymodel;
      this.tableData = courseinfo.json.content.ticket_info;
      this.ticket_max = courseinfo.json.content.ticket_max;
      this.tableData.forEach(el => { 
        el.order_date[0] = this.formatTimestamp(el.order_date[0]);
        el.order_date[1] = this.formatTimestamp(el.order_date[1]);
        el.effective_date[0] = this.formatTimestamp(el.effective_date[0]);
        el.effective_date[1] = this.formatTimestamp(el.effective_date[1]);
      });

      this.contact = courseinfo.json.form;
      this.addActivityForm.status = courseinfo.status;
      this.loading = true;
    },
    /**添加页面时清空数据 */
    addPageData(){
      this.addActivityForm.title = "";
      this.addActivityForm.defaultpic = "";
      this.addActivityForm.content = "";
      this.activityTime = [];
      this.addActivityForm.address = "";
      this.addActivityForm.sponsor = "";
      this.addActivityForm.is_pledge = "0";
      this.addActivityForm.paymodel = "0";
      this.tableData = [];
      this.contact = this.contact.slice(0,2);
      this.addActivityForm.status = 0;
      this.addActivityForm.shortdesc = ""
      this.loading = true;
    },
    /**
     * 保存返回
     */
    saveTrainCamp() {
      this.tableData.forEach(elObj => {
        delete elObj.placeholder;
        if (elObj.order_date_type == 0) {
          elObj.order_date[0] = new Date().valueOf();
          elObj.order_date[1] = this.addActivityForm.enddate;
        } else {
          elObj.order_date[0] = new Date(elObj.order_date[0]).getTime();
          elObj.order_date[1] = new Date(elObj.order_date[1]).getTime();
        }
        if(elObj.order_date[1]>this.addActivityForm.enddate){
          elObj.order_date[1] = this.addActivityForm.enddate;
        }

        if (elObj.effective_date_type == 0) {
          elObj.effective_date[0] = this.addActivityForm.begindate;
          elObj.effective_date[1] = this.addActivityForm.enddate;
        } else {
          elObj.effective_date[0] = new Date(elObj.effective_date[0]).getTime();
          elObj.effective_date[1] = new Date(elObj.effective_date[1]).getTime();
        }
        if(elObj.effective_date[1]>this.addActivityForm.enddate){
            elObj.effective_date[1] = this.addActivityForm.enddate;
        }
      });
      this.addActivityForm.ticket_info = this.tableData;
      this.addActivityForm.form_field = this.contact;

      if (!this.addActivityForm.title.length > 0) {
        this.$msg("活动名称不能为空");
        this.$refs.activityTitle.focus();
      } else if (!this.addActivityForm.defaultpic.length > 0) {
        this.$msg("活动封面不能为空");
      } else if (!this.addActivityForm.content.length > 0) {
        this.$msg("活动详情不能为空");
      } else if (!this.addActivityForm.begindate) {
        this.$msg("活动时间不能为空");
        this.$refs.activityPicker.focus();
      } else if (!this.addActivityForm.address.length > 0) {
        this.$msg("活动地址不能为空");
        this.$refs.activityAddress.focus();
      } else if (!this.addActivityForm.sponsor.length > 0) {
        this.$msg("主办方不能为空");
        this.$refs.activitySponsor.focus();
      } else if (!this.addActivityForm.ticket_info.length > 0) {
        this.$msg("票种信息不能为空");
      } else if (!this.addActivityForm.form_field.length > 0) {
        this.$msg("表单内容不能为空");
      } else {
        for (let i = 0; i < this.addActivityForm.form_field.length; i++) {
          if (!this.addActivityForm.form_field[i].name) {
            this.$msg("自定义表单标题不能为空");
            this.$refs[`customFormName${i}`][0].focus();
            return;
          }
        }
        let paramObj = {
          title: this.addActivityForm.title,
          studentcount:this.addActivityForm.studentcount,
          defaultpic: this.addActivityForm.defaultpic,
          content: this.addActivityForm.content,
          status: this.addActivityForm.status,
          shortdesc:this.addActivityForm.shortdesc,
          json: {
            setting: {
              begindate: this.addActivityForm.begindate,
              enddate: this.addActivityForm.enddate,
              address: this.addActivityForm.address,
              sponsor: this.addActivityForm.sponsor,
              is_pledge: this.addActivityForm.is_pledge,
              paymodel: this.addActivityForm.paymodel
            },
            content: {
              ticket_info: this.addActivityForm.ticket_info,
              ticket_max: this.ticket_max
            },
            form: this.addActivityForm.form_field
          }
        };
        if (this.$route.query.id) {
          paramObj.courseid = this.$route.query.id;
        }
        addActivity(paramObj).then(res => {
          if (res.result == "success") {
            this.$msg("保存成功", "success");
            this.$router.go(-1);
          }
        });
      }
    },
    /**取消返回 */
    cancel(){
      this.$router.go(-1);
    }
  }
};
</script>

<style scoped>
.tips {
  background-color: #fdf6ec;
  color: #e6a23c;
  line-height: 22px;
  padding: 12px 15px;
  border-radius: 4px;
  margin: 20px 0;
}

.basic-information__pic {
  display: flex;
}

.basic-information__pic .ks-image {
  height: 123px;
  width: 200px;
  margin-right: 20px;
}

.basic-information__pic .advice {
  margin-top: 20px;
  font-size: 14px;
  color: #ababab;
}

.deposit {
  margin-right: 20px;
}
.deposit i {
  color: #ffa500;
  cursor: pointer;
  position: relative;
  top: 1px;
}

.enroll-set-box {
  max-width: 1100px;
  border: 1px solid #ebeef5;
  text-align: center;
  font-size: 14px;
}
.enroll-set-box__header {
  background-color: #f6f9fb;
  height: 30px;
  line-height: 30px;
}
.enroll-set-box__row {
  height: 50px;
  line-height: 50px;
  border-bottom: 1px solid #ebeef5;
}
.enroll-set-box__add-row {
  padding: 10px 0;
  border-bottom: 1px solid #ebeef5;
}

.enroll-set-box__add-ticket {
  text-align: left;
  padding: 30px 20px;
}

.operation-icon {
  color: #ccc;
}
.operation-icon i {
  font-size: 20px;
  cursor: pointer;
}
.operation-icon i:last-child {
  margin-left: 20px;
}
.add-ticket__input {
  width: 120px;
}
.add-ticket-textarea {
  display: flex;
  justify-content: flex-start;
  margin: 20px 0;
}
.add-ticket-textarea .title {
  position: relative;
  top: -5px;
}

/* 公用样式 */
.information__title {
  line-height: 34px;
  position: relative;
  padding-left: 15px;
  font-size: 16px;
}
.information__title::before {
  content: "";
  width: 3px;
  height: 18px;
  background: #488bff;
  position: absolute;
  left: 0;
  top: 50%;
  margin-top: -9px;
}
.information__box {
  padding: 20px;
  min-height: 200px;
}
.information__row {
  padding-bottom: 15px;
  position: relative;
}
.information__name {
  display: block;
  font-size: 14px;
  line-height: 34px;
  height: 34px;
  color: #666;
  padding-bottom: 10px;
}
.information__star {
  position: relative;
  color: red;
  vertical-align: middle;
}

.form-set__row {
  display: flex;
  align-items: center;
  padding: 10px 0;
  font-size: 14px;
}
.form-set__row .name {
  color: #999999;
  font-weight: bold;
  padding-right: 10px;
}
.form-set__row .delete-icon i {
  margin-left: 10px;
  cursor: pointer;
  font-size: 20px;
  color: #c2c2c2;
}
.form-set__row .mr10{
  margin-right: 10px;
}
.form-set__row .custom{
  height: 32px;
  line-height: 32px;
  border: 1px solid #DCDFE6;
  border-radius: 4px;
  color: #DDDFE4;
  padding: 0 5px;
  text-align: center;
}
.form-set__row .custom-option{
  color: #666;
}
.form-set__row .custom i{
  font-size: 12px;
}
.add-input {
  margin-top: 10px;
}
.publish-set__row {
  padding: 20px;
  padding-bottom: 40px;
}
.add-activity-footer {
  border-top: 1px solid #eee;
  padding: 20px 0;
  text-align: center;
}

.activity__title{
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
}
</style>
