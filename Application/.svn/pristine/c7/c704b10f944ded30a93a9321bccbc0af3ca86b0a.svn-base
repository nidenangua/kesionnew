<template>
  <ks-container>
    <el-breadcrumb separator="/">
      <el-breadcrumb-item
        :to="{ path: '/?url=%2Fhome.html%2Fcourse%2FIndex%3Fappid-6,courseType-8' }"
      >教辅周边</el-breadcrumb-item>
      <el-breadcrumb-item>添加商品</el-breadcrumb-item>
    </el-breadcrumb>
    <div class="tips">请您遵守国家相关规定，切勿上传低俗色情、暴力恐怖、谣言诈骗、侵权盗版等相关内容，课堂街保有依据国家规定及平台规则进行处理的权利。</div>
    <div>
      <div class="info-title">基本信息</div>
      <div class="info-box">
        <div class="info-row">
          <span class="info-name">选择分类</span>
          <paper-classfiy
            v-if="merchandise.categoryid !== null"
            :categoryid="merchandise.categoryid"
            :parentid-path="parentidPath"
            @change="handleClassfiyChange"
            :visible.sync="showCategoryid"
          />
        </div>
        <div class="info-row">
          <span class="info-name">
            <span class="info-star">*</span>
            商品名称
          </span>
          <el-input
            v-model="merchandise.title"
            ref="merchandiseTitle"
            show-word-limit
            maxlength="30"
          >
            <!-- <span slot="suffix" class="info-word-limit">{{merchandise.title.length}}/30</span> -->
          </el-input>
        </div>
        <div class="info-row">
          <span class="info-name">简短描述(用于微信分享)</span>
          <el-input v-model="merchandise.shortdesc" show-word-limit maxlength="45">
            <!-- <span slot="suffix" class="info-word-limit">{{merchandise.shortdesc.length}}/45</span> -->
          </el-input>
        </div>
        <div class="info-row">
          <span class="info-name">
            <span class="info-star">*</span>
            商品封面主图
          </span>
          <el-row class="basic-info-picbox">
            <el-col :span="8">
              <ks-image :src="merchandise.defaultpic" class="basic-info-pic"/>
            </el-col>
            <el-col :span="15">
              <el-button
                @click="$uploadImages(merchandise,'defaultpic')"
                type="primary"
                plain
                class="upload-main-pic-btn"
              >上传图片</el-button>
              <div class="upload-pic-advice mt15">建议尺寸800*800pxpx，JPG、PNG格式， 图片小于1M。</div>
            </el-col>
          </el-row>
        </div>
        <div class="info-row">
          <span class="info-name">详情页主图</span>
          <div>
            <el-button type="primary" @click="uploadImg">上传图片</el-button>
            <el-button type="primary" @click="selectImg" plain>选择图片</el-button>
          </div>
          <div class="upload-pic-advice mt15">建议尺寸800*800pxpx，JPG、PNG格式， 图片小于1M，最多上传5张</div>
          <div class="upload-img" v-for="(src,i) in merchandise.json.details_img" :key="i">
            <img class="remove" src="../../assets/remove.png" @click="remove(i)">
            <img class="upload-details" :src="src.img">
          </div>
          <!-- <div class="clearfix"></div> -->
        </div>
        <div class="info-row">
          <span class="info-name">
            <span class="info-star">*</span>
            商品详情
          </span>
          <div>
            <ks-editor
              title="商品详情"
              :height="300"
              v-model="merchandise.content"
              :z-index="90"
              :wordCount="true"
            />
          </div>
        </div>
        <div class="info-row">
          <span class="info-name">商品服务</span>
          <div>
            <el-row
              v-for="(item,index) in merchandise.json.service"
              :key="index"
              class="info-service-row"
            >
              <el-form :model="item" :rules="rules" ref="ruleForm">
                <el-col :span="12">
                  <el-form-item prop="name">
                    <el-input v-model="item.name" placeholder="请输入商品服务"></el-input>
                  </el-form-item>
                </el-col>
              </el-form>
              <el-col :span="12">
                <el-tooltip effect="dark" content="删除商品服务" placement="bottom">
                  <i class="iconfont icon-shanchu1 delete-icon" @click="delService(index)"></i>
                </el-tooltip>
              </el-col>
            </el-row>
          </div>
          <div>
            <el-button type="primary" plain class="mt15" @click="addService">添加服务</el-button>
            <div class="upload-pic-advice dis-inblock">&nbsp;&nbsp;如 : 支付退换货、正品保证等</div>
          </div>
        </div>
        <div class="info-row">
          <span class="info-name">商品属性</span>
          <div>
            <el-row
              v-for="(item,index) in merchandise.json.attribute"
              :key="index"
              class="info-service-row"
            >
              <el-form :model="item" :rules="ruless" ref="ruleForm">
                <el-col :span="14">
                  <el-col :span="7">
                    <el-form-item prop="name">
                      <el-input v-model="item.name" placeholder="属性名称"></el-input>
                    </el-form-item>
                  </el-col>
                  <el-col :span="1" style="line-height:40px;text-align:center;">:</el-col>
                  <el-col :span="16">
                    <el-form-item prop="content">
                      <el-input v-model="item.content" placeholder="属性内容"></el-input>
                    </el-form-item>
                  </el-col>
                </el-col>
              </el-form>
              <el-col :span="6">
                <el-tooltip effect="dark" content="删除商品属性" placement="bottom">
                  <i class="iconfont icon-shanchu1 delete-icon" @click="delAttribute(index)"></i>
                </el-tooltip>
              </el-col>
            </el-row>
          </div>
          <div>
            <el-button type="primary" plain class="mt15" @click="addAttribute">添加属性</el-button>
            <div class="upload-pic-advice dis-inblock">&nbsp;&nbsp;如 : 尺寸 : 26*18.5cm , 包装 : 平装-胶订等</div>
          </div>
        </div>
      </div>
    </div>
    <div>
      <div class="info-title">商品信息</div>
      <div class="info-box">
        <el-form ref="form" :model="merchandise.json.goods" label-width="100px">
          <el-form-item label="售卖价格">
            <el-radio-group v-model="merchandise.json.goods.sell">
              <el-radio v-model="merchandise.json.goods.sell" label="1">固定价格</el-radio>
              <el-radio v-model="merchandise.json.goods.sell" label="2">按规格设置</el-radio>
            </el-radio-group>
          </el-form-item>
          <!-- 固定價格 -->
          <template v-if="merchandise.json.goods.sell==1">
            <el-form-item label="商品价格">
              <ks-input-number
                v-model="merchandise.json.goods.specteam.price"
                :min="0.01"
                :decimalPlaces="2"
                placeholder="请输入价格"
                max-width="200px"
                class="info-number-input"
              />元
            </el-form-item>
            <el-form-item label="划线价格">
              <ks-input-number
                v-model="merchandise.json.goods.specteam.uprice"
                :min="0.01"
                :decimalPlaces="2"
                placeholder="请输入划线价格(选填)"
                max-width="200px"
                class="info-number-input"
              />元
            </el-form-item>
            <el-form-item label="运费">
              <ks-input-number
                v-model="merchandise.json.goods.specteam.freight"
                :min="0.00"
                :decimalPlaces="2"
                placeholder="请输入费用"
                max-width="200px"
                class="info-number-input"
              />元
            </el-form-item>
            <el-form-item label="当前库存">
              <ks-input-number
                v-model="merchandise.json.goods.specteam.stock"
                :min="0"
                placeholder="请输入库存"
                max-width="200px"
                class="info-number-input"
              />件
            </el-form-item>
          </template>
          <!-- 规格设置 -->
          <template v-else>
            <el-form-item label="选择规格组">
              <el-select
                v-model="merchandise.groupSet.commodity_id"
                placeholder="请选择"
                @change="changeGroupSetId"
              >
                <el-option
                  v-for="(item,index) in merchandise.groupSet.sortCommodityList"
                  :key="index"
                  :value="item.id"
                  :label="item.name"
                ></el-option>
              </el-select>
            </el-form-item>
            <!-- 表格 -->
            <div class="stand">
              <ul>
                <li class="attr" v-for="(item,index) in standData" :key="index">
                  <el-input class="title" v-model="item.title" placeholder="请输入属性">:</el-input>
                  <div
                    class="putt"
                    v-if="item.attrs.length"
                    v-for="(subitem,i) in item.attrs"
                    :key="i"
                  >
                    <el-input v-model="subitem.attr" placeholder="请输入值"></el-input>
                    <div class="close" @click="closeAtrr(index,i)">×</div>
                  </div>
                  <div @click="addAtrr(index)" class="isappend" >添加</div>
                  <div @click="removesku(index)" class="isappend removesku">删除</div>
                  <!-- <div class="append" >+</div> -->
                </li>
              </ul>
              <div class="add">
                <el-button type="primary" @click="addStand">添加规格</el-button>
                <el-button type="primary" @click="getTable">保存生成新的规格列表</el-button>
                <!-- <el-button type="primary" @click="read">读取规格列表</el-button> -->
              </div>
            </div>
            <div class="table">
              <el-table v-if="isTable" :data="tableData" border="" style="width: 100%">
                <el-table-column prop="date" label="属性" width="180"></el-table-column>
                <el-table-column prop="name" label="划线价格" width="300">
                  <template slot-scope="scope">
                    <el-input v-model="scope.row.uprice" placeholder="请输入划线价格"></el-input>
                  </template>
                </el-table-column>
                <el-table-column label="商品价格" width="300">
                  <template slot-scope="scope">
                    <el-input v-model="scope.row.price" placeholder="请输入商品价格"></el-input>
                  </template>
                </el-table-column>
                <el-table-column label="库存">
                  <template slot-scope="scope">
                    <el-input v-model="scope.row.stock" placeholder="请输入库存"></el-input>
                  </template>
                </el-table-column>
              </el-table>
            </div>
            <el-form-item label="运费">
              <ks-input-number
                v-model="merchandise.json.goods.specteam.freight"
                :min="0.01"
                :decimalPlaces="2"
                placeholder="请输入费用"
                max-width="200px"
                class="info-number-input"
              />元
            </el-form-item>
          </template>
        </el-form>
      </div>
    </div>
    <div>
      <div class="info-title">上架设置</div>
      <div class="info-box">
        <div class="info-row">
          <span class="info-name">上架设置</span>
          <el-switch
            v-model="merchandise.status"
            active-value="2"
            inactive-value="0"
            active-color="#13ce66"
          ></el-switch>
        </div>
      </div>
    </div>
    <footer>
      <el-button type="primary" @click="saveTrainCamp()">保存返回</el-button>
      <el-button plain @click="$router.go(-1)">取消</el-button>
    </footer>
  </ks-container>
</template>

<script>
import { editCommodity } from "@/api/microportal";
import {
  editGoods,
  sortCommodity,
  showGoods,
  shelves
} from "@/api/microportal";
import PaperClassfiy from "./components/PaperClassfiy";
export default {
  name: "AddMerchandise",
  components: {
    PaperClassfiy
  },
  data() {
    return {
      sumbitFlag:true,
      cateMsg:[],
      /**SKU代码 */
      tableData: [],
      input: '',
      isTable: false,
      standData: [],
      list: [],
      group: [],
      /**显示分类id开关，有分类将变为true */
      showCategoryid: false,
      parentidPath: [],
      /**商品数据 */
      merchandise: {
        /**分类联动关系 */
        categoryid: null,
        title: "",
        shortdesc: "",
        defaultpic: "",
        json: {
          // info:[],
          details_img: [],
          service: [],
          attribute: [],
          goods: {
            sell: 1,
            specteam: {
              price: null,
              uprice: null,
              freight: null
            }
          }
        },
        info: [],
        content: "",
        status: 1,
        /**按规则设置信息 */
        groupSet: {
          freight: 10,
          commodity_id: "",
          sortCommodityList: []
        }
      },
      conItem: {
        name: "1111"
      },
      rules: {
        name: [{ required: true, message: "请输入商品服务", trigger: "blur" }]
      },
      ruless: {
        name: [{ required: true, message: "请输入属性名称", trigger: "blur" }],
        content: [
          { required: true, message: "请输入属性内容", trigger: "blur" }
        ]
      }
    };
  },
  watch: {
    /**商品名称字数限制 */
    "merchandise.title": function(newValue, oldValue) {
      if (newValue.length > 30) {
        this.merchandise.title = oldValue;
      }
    },
    /**简短描述字数限制 */
    "merchandise.shortdesc": function(newValue, oldValue) {
      if (newValue.length > 45) {
        this.merchandise.shortdesc = oldValue;
      }
    },
    $route(to, from) {
      this.$router.go(0);
    }
  },
  activated() {
    this.getSortCommodity();
    let id = this.$route.query.courseid;
    shelves()
      .then(res => {
        res.is_shelves == 1
          ? (this.merchandise.status = "2")
          : (this.merchandise.status = "0");
      })
      .then(() => {
        if (id) {
          showGoods({ id }).then(res => {
            this.merchandise.categoryid = res.categoryid;
            this.merchandise.title = res.title;
            this.merchandise.shortdesc = res.shortdesc;
            this.merchandise.defaultpic = res.defaultpic;
            this.merchandise.shortdesc = res.shortdesc;
            this.merchandise.content = res.content;
            this.merchandise.status = res.status;
            this.merchandise.json = res.json;
            this.parentidPath = res.parentidpath;

            this.merchandise.groupSet.commodity_id = res.json.goods.specteam.commodity_id
            this.isTable = true
            let catelist = []
            this.standData = res.json.goods.specteam.standdata
            console.log(this.standData)
            // for(var i = 0 ; i <this.standData.length; i++) {
            //   catelist.push(this.standData[i])
            // }
            this.standData.map((item,i)=>{
              catelist.push({title:item.title,content:item.content,name:item.name,id:item.id,attrs:[]})
              item.attrs.map(_item=>{
                catelist[i].attrs.push({attr:_item.attr})
              })
            })
            this.cateMsg = catelist
            this.tableData = res.json.goods.specteam.info
          });
        } else {
          this.merchandise.categoryid = "0";
        }
      });
    this.$nextTick(() => {
      this.merchandise.json.goods.sell = this.merchandise.json.goods.sell + "";
    });
  },
  methods: {
          // 添加规格行
          addStand (i) {
              this.sumbitFlag = false
            //  限制规格种类不超过4种
              if (this.standData.length>3) {
                  this.$message.error('不能超过四行')
              } else {
                this.standData.push({title: '', attrs: []})
              }
          },
          // 添加规格表格
          getTable () {
              this.sumbitFlag = true 
              let flag = true
              let setflag = true  
              this.standData.map(item=>{
                if(!item.title) return setflag = false
                item.attrs.map(_item=>{
                  if(!_item.attr) return flag = false
                })
              }) 
              if(!setflag) return this.$message.error("请将属性填写完整")
              if(!flag) return this.$message.error("请将属性值填写完整")
              this.isTable = true
              this.group = []
              this.list = []
              let attr = []
              const num = this.standData.length
              // console.log(this.standData)
              this.standData.forEach(item => {
                  this.list.push(item.attrs)
              });
             var arr = [] 
             var that = this 
             if(this.list && this.list.length) {
               function func(skuarr=[], i){
                for (let j=0; j<that.list[i].length; j++) {  
                    if (i<that.list.length-1) {  
                        skuarr[i] = that.list[i][j].attr  
                        func(skuarr, i+1)  
                    } else {  
                        arr.push([...skuarr,that.list[i][j].attr])  
                    }  
                }  
                return arr  
                }  
                let newList = func([], 0)
                let b
                let c 
                    newList.forEach(item => {
                        b = ''
                        c = []
                        for (let i = 0; i < num; i++) {
                            let a = this.standData[i].title
                            a = a + ':' + item[i]
                            b = b + a + ';'
                            c.push(item[i])
                        }
                        attr.push(c)
                        this.group.push(b)
                    })
                this.tableData = []
                let table = []
                for (let j = 0; j < this.group.length; j++) {
                    table.push({
                        date: this.group[j],
                        attr:attr[j],
                        price: '',
                        uprice: '',
                        stock:'',
                    })
                }
               this.tableData = table
             }
              let listcate = []
              this.standData.map((item,i)=>{
                listcate.push({title:item.title,content:item.content,name:item.name,id:item.id,attrs:[]})
                item.attrs.map((_item,index)=>{
                  listcate[i].attrs.push({attr:_item.attr})
                })
              })
              // for(var i = 0; i<this.standData.length;i++) {
              //   listcate.push(this.standData[i])
              // }
              this.cateMsg = listcate
          },
          
          // 删除规格行
          removesku (i) {
              this.sumbitFlag = false
              this.standData.splice(i,1)
          },
          // 添加属性值
          addAtrr (i) {
            this.sumbitFlag = false
            //  限制属性值不超过5个
            if (this.standData[i].attrs.length>4) {
                this.$message('不能超过5个')
             } else {
　　　　　　　　// 存的时候是存的对象
              this.standData[i].attrs.push({attr: ''})
             }
          },
          // 删除属性值
          closeAtrr (a, b) {
            this.sumbitFlag = false
            //   console.log(a, b);
              this.standData[a].attrs.splice(b,1)
          },

    /**
     * 分类变化
     * @param {String} 分类id
     */

    handleClassfiyChange(id) {
      this.merchandise.categoryid = id;
    },

    /**上传图片 */
    uploadImg() {
      if (this.merchandise.json.details_img.length >= 5) {
        return this.$message({ message: "图片最多只能上传5张", type: "error" });
      }
      this.$uploadImages(res => {
        this.merchandise.json.details_img.push({ img: res.defaultpic });
      });
    },
    remove(i) {
      this.merchandise.json.details_img.splice(i, 1);
    },
    /**添加商品服务 */
    addService() {
      if (this.merchandise.json.service.length == 8) {
        return this.$message({ message: "最多只能添加8项", type: "error" });
      } else {
        this.merchandise.json.service.push({ name: "" });
      }
    },
    /**删除商品服务 */
    delService(index) {
      this.merchandise.json.service.splice(index, 1);
    },
    /**添加商品属性 */
    addAttribute() {
      if (this.merchandise.json.attribute.length == 8) {
        return this.$message({ message: "最多只能添加8项", type: "error" });
      } else {
        this.merchandise.json.attribute.push({
          name: "",
          content: ""
        });
      }
    },
    /**删除商品属性 */
    delAttribute(index) {
      this.merchandise.json.attribute.splice(index, 1);
    },
    /** 规格组设置发生改变时触发 */
    changeGroupSetId(id) {
      this.merchandise.groupSet.commodity_id = id
      this.standData = []
      let cateList = {}
      this.merchandise.groupSet.sortCommodityList.map(item=>{
        // console.log(item)
        if(item.id == id) return cateList = item
      })
      // console.log(cateList)
      let list = []
      cateList.attr_list.map(item=>{
        // console.log(item)
        list.push({title:item.name,content:item.content,attrs:[],name:cateList.name,id:cateList.id})
      })
      list.map(item=>{
        // console.log(item)
        item.content.map(_item=>{
          item.attrs.push({attr:_item.name,json:{content:{id:_item.id,parentid:_item.parentid,name:_item.name}}})
        })
      })
      console.log(list)
      this.standData = list
      console.log(this.standData)
      // 如果后台返回的数据是这样的
      // const arr = [
      //     '颜色:红色;尺码:M;品质:好;',
      //     '颜色:红色;尺码:S;品质:好;',
      //     '颜色:白色;尺码:M;品质:好;',
      //     '颜色:白色;尺码:S;品质:好;'
      // ]
      // const a = arr[0].split(';')
      // const num =a.length-1
      // let ss = []
      // for (let tt = 0; tt < num; tt++){
      //     ss.push([])
      // }
      
      // arr.forEach(item => {
      //   for (let tt = 0; tt < num; tt++){
      //     ss[tt].push(item.split(';')[tt].split(':')[1])
      //   }
      // })
      // ss = ss.map(item => {
      //     return Array.from(new Set(item))
      // })
      // for (let s = 0; s < ss.length; s++) {
      //   for (let t = 0; t < ss[s].length; t++) {
      //       ss[s][t] = {attr:ss[s][t]}
      //   }  
      // }
      // for (let i = 0; i < num; i++) {
      //     this.standData.push({'title': a[i].split(':')[0],attrs: ss[i]})
      // }
      // console.log(this.standData);
    },
    /**
     * 添加规格组属性内容
     * @param {Number} 规格组索引
     * @param {Number} 规格组属性索引
     *
     *  */
    addGroupAttr(index, attrIndex) {
      this.merchandise.groupSet.sortCommodityList[index].attr_list[
        attrIndex
      ].content.push({
        name: "",
        is_select: false
      });
    },
    /**保存返回 */
    saveTrainCamp() {
      if(!this.sumbitFlag) return this.$message.error("请生成新的规格列表")
      let flag = true
      let setflag = true  
      this.standData.map(item=>{
        if(!item.title) return setflag = false
        item.attrs.map(_item=>{
          if(!_item.attr) return flag = false
        })
      }) 
      if(!setflag) return this.$message.error("请将属性填写完整")
      if(!flag) return this.$message.error("请将属性值填写完整")
      let priceflag = false 
      this.tableData.every(item=>{
        if(!item.price || !item.uprice || !item.stock) {
          priceflag = true
        }
      })
      if(priceflag) return this.$message.error("请将信息填写完成")
      console.log(this.tableData)
      
      //  let a = 0
      //  this.$refs.ruleForm.map(form=>{
      //    form.validate((valid) => {
      //       if (valid) {
      //         a ++
      //         console.log(222)
      //       } else {
      //         console.log('error submit!!');
      //         return false;
      //       }
      //     });
      //  })
      //  if(a ==  this.$refs.ruleForm.length){
      //   //  this.save()
      //   console.log(111)
      //  }else {
      //    console.log(222)
      //  }
      //   return
      // this.$refs.ruleForm[0].validate((valid) => {
      //     if (valid) {
      //       alert('submit!');
      //     } else {
      //       console.log('error submit!!');
      //       return false;
      //     }
      //   });
      //   return
      if (!this.merchandise.title.length) {
        this.$msg("商品名称不能为空");
        this.$refs.merchandiseTitle.focus();
        return false;
      }
      let id = this.$route.query.courseid;
      if (id) {
        this.merchandise.courseid = id;
      }
      if(this.merchandise.json.goods.sell == 2) {
        /**按规格 */
        this.merchandise.json.goods.specteam.commodity_id = this.merchandise.groupSet.commodity_id
        // this.standData
        this.merchandise.json.goods.specteam.standdata = this.cateMsg
        this.merchandise.json.goods.specteam.info = []
        this.tableData.map(item=>{
          this.merchandise.json.goods.specteam.info.push({attr:item.attr,price:item.price,uprice:item.uprice,stock:item.stock,date:item.date})
        })
        this.merchandise.json.goods.specteam.list = this.list
        console.log(this.merchandise,this.list)
      }else {
        
      }
      editGoods(this.merchandise).then(res => {
        if (res.result == "success") {
          this.$message({ message: "保存成功", type: "success" });
          setTimeout(() => {
            this.$router.push(
              "/?url=%2Fhome.html%2Fcourse%2FIndex%2Findex%3Fappid-6,courseType-8"
            );
          }, 1500);
        }
      });
    },

    /** 获得规格组列表 */
    getSortCommodity(param) {
      sortCommodity(param).then(res => {
        console.log(res);
        /**为每条数据加上是否选中状态 */
        res.list.forEach(el => {
          el.attr_list.forEach(attrel => {
            attrel.content.forEach(conel => {
              conel.is_select = false;
            });
          });
        });
        this.merchandise.groupSet.sortCommodityList = res.list;
        console.log(this.merchandise.groupSet.sortCommodityList);
      });
    },

    objectSpanMethod({ row, column, rowIndex, columnIndex }) {
      if (columnIndex === 0) {
        if (rowIndex % 2 === 0) {
          return {
            rowspan: 2,
            colspan: 1
          };
        } else {
          return {
            rowspan: 0,
            colspan: 0
          };
        }
      }
    },
    selectImg() {
      if (this.merchandise.json.details_img.length >= 5) {
        return this.$message({ message: "图片最多只能上传5张", type: "error" });
      }
      let that = this;
      top.popup.open(
        "/home.html/default/Index/imageslist?appid-6,name-defaultpic,type-fn",
        {
          area: ["1200px", "550px"],
          data: function(res) {
            that.merchandise.json.details_img.push({ img: res });
          }
        }
      );
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
.basic-info-picbox {
  width: 600px;
}
.basic-info-pic {
  width: 180px;
  height: 180px;
}
.upload-main-pic-btn {
  margin-top: 30px;
}
.info-service-row {
  margin-bottom: 10px;
}
.info-service-row:last-child {
  margin-bottom: 0;
}
.info-number-input {
  display: inline-block;
  margin-right: 5px;
}
.group-attr-input {
  width: 130px;
}

footer {
  padding-top: 20px;
  border-top: 1px solid #eeeeee;
  text-align: center;
}
/* 公用样式 */
.mt15 {
  margin-top: 15px;
}
.dis-inblock {
  display: inline-block;
}
.info-title {
  line-height: 34px;
  position: relative;
  padding-left: 15px;
  font-size: 16px;
}
.info-title::before {
  content: "";
  width: 3px;
  height: 18px;
  background: #488bff;
  position: absolute;
  left: 0;
  top: 50%;
  margin-top: -9px;
}
.info-box {
  padding: 20px;
  min-height: 200px;
}
.info-row {
  padding-bottom: 15px;
  position: relative;
}
.info-name {
  display: block;
  font-size: 14px;
  line-height: 34px;
  height: 34px;
  color: #ababab;
  padding-bottom: 10px;
}
.info-star {
  position: relative;
  color: red;
  vertical-align: middle;
}
.info-word-limit {
  line-height: 40px;
}
.upload-pic-advice {
  font-size: 13px;
  color: #ababab;
}
.delete-icon {
  color: #c2c2c2;
  margin-left: 10px;
  font-size: 20px;
  cursor: pointer;
}
.remove {
  width: 20px;
  height: 20px;
  position: absolute;
  left: 94px;
  top: 10px;
}
.upload-img {
  position: relative;
  display: inline-block;
}
.upload-details {
  width: 110px;
  height: 150px;
  padding: 10px 5px 0px;
}
.popup /deep/.el-dialog /deep/ {
  width: 1200px !important;
}

.table,.stand {
    padding: 20px 0;
}
.add {
    margin-top: 20px;
}
.attr {
    margin-bottom: 10px;
}
.el-input {
    width: auto;
    
}
.putt {
    display: inline-block;
    position: relative;
    margin-right: 10px;  
}
.isappend {
    font-size: 14px;
    color: #488bff;
    text-align: center;
    display: inline-block;
    cursor: pointer;
}
.title {
    background-color: bisque;
    margin-right: 10px;
}
.close {
    position: absolute;
    width: 18px;
    height: 18px;
    background-color: rgba(0,0,0,.2);
    border-radius: 50%;
    line-height: 15px;
    text-align: center;
    right: -7px;
    top: -7px;
    cursor: pointer;
}
.removesku{
  margin-left: 8px;
}
.el-table{
  text-align: center
}
</style>
