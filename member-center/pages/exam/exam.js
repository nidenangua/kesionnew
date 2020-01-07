return {
  data: function data() {
    return {
      state: {},

      /********************************************标题****************************************** */

      /**二级标题菜单开关 */
      isSubtitle: false,

      /**三级分类名称 */
      name: null,

      /**当前选中课程id */
      activeCategoryid: null,

      /**二级分类名称 */
      classes: null,

      /**选中三级标题 */
      title: null,

      /**三级分类列表 */
      childsClass: null,

      /********************************************考试分类列表*********************************** */

      /**考试分类列表开关 */
      isExamSelect: false,

      /**考试分类列表*/
      allClass: [],

      /**当前选择 */
      select: null,

      /**考试分类id */
      id: null,

      /********************************************标签页*********************************** */

      /**默认考试记录页 0 */
      tab: 0,

      /** */
      titleList: [],
      showCollect: false,
      showError: false,
      chaper: null,
      knowledge: null
      /** */

    };
  },
  wacth: {},
  methods: {
    /********************************************标题****************************************** */

    /**显示二级标题菜单 */
    showSubtitle: function showSubtitle() {
      this.isSubtitle = true;
    },

    /**关闭二级标题菜单 */
    colseSubtitle: function colseSubtitle() {
      this.isSubtitle = false;
    },
    setClass: function setClass(i, id, name) {
      this.title = id;

      if (name) {
        this.name = name;
      }

      localStorage["name_" + this.state.userId] = name;
      localStorage["id_" + this.state.userId] = id;
      this.$router.push({
        query: {
          categoryid: id
        }
      });
      this.isSubtitle = false;
    },

    /********************************************考试分类列表****************************************** */

    /**打开考试分类列表 */
    showExamSelect: function showExamSelect() {
      this.$router.push({
        name:'ExamCategory',
        query:{
          reselect:1
        }
      })
    },

    /**获取所有分类课程 */
    getAllPaperCategory: function getAllPaperCategory() {
      var that = this;
      GetAllPaperCategory({
        apptoken: that.state.appToken
      }).then(function (res) {
        that.allClass = res.data;
        localStorage.allClass = JSON.stringify(res.data);
        if(that.$route.query.categoryid){
          that.allClass.map(item=>{
            if(item.categoryid == Number(that.activeCategoryid)){
              that.classes = item.categoryname
            }else{
              if(item.childs&&item.childs.length){
                item.childs.map(citem=>{
                  if(citem.categoryid==Number(that.activeCategoryid)){
                    that.classes = citem.categoryname
                  }else{
                    if(citem.childs&&citem.childs.length){
                      citem.childs.map(sitem=>{
                        if(sitem.categoryid==Number(that.activeCategoryid)){
                          that.classes = citem.categoryname
                          that.name = sitem.categoryname
                        }
                      })
                    }
                  }
                })
              }
            }
          })
        }
      });
    },

    /**选择课程并存储 */
    setClasses: function setClasses(id, classes, childsClass) {
      var that = this;
      that.classes = classes;
      that.id = id;
      that.isExamSelect = false;
      localStorage["classes_" + that.state.userId] = classes;
      localStorage["id_" + that.state.userId] = id;
      localStorage.removeItem("name_" + that.state.userId);

      if (childsClass) {
        that.childsClass = childsClass;
        localStorage.childsClass = JSON.stringify(childsClass);
      } else {
        that.childsClass = [];
        localStorage.childsClass = []; // localStorage.removeItem("childsClass")
      }

      that.name = null;
      that.title = null;
      that.select = id;
      that.$router.push({
        query: {
          categoryid: id
        }
      });
    },

    /********************************************标签页****************************************** */

    /**切换标签页 */
    changeTab: function changeTab(name) {
      this.$router.push({
        name: name,
        query: {
          categoryid: this.$route.query.categoryid
        }
      });
    },

    /*获取模块数据 **/
    getSubjectStatistics: function getSubjectStatistics() {
      var that = this;
      GetSubjectStatistics({
        categoryid: that.$route.query.categoryid,
        apptoken: that.state.appToken
      }).then(function (res) {
        if (res.result) {
          that.titleList = res.module;

          for (var i in that.titleList) {
            if (that.titleList[i].module_id == "5") {
              that.showCollect = true;
            }

            if (that.titleList[i].module_id == "4") {
              that.showError = true;
            }
          }
        } else {
          that.$router.push("/");
          that.$confirm(res.msg).then(function (_) {});
        }
      });
    }
  },
  created: function created() {
    var that = this
    that.$store.ready(function (state) {
      that.state = state;
      that.getAllPaperCategory();
    })
  },
  activated: function activated() {
    var that = this;
    this.isSubtitle = false;
    if (localStorage.childsClass) {
      this.childsClass = JSON.parse(localStorage.childsClass);
    } else {
      this.childsClass = null;
    }

    that.$store.ready(function (state) {
      that.state = state;

      if(that.$route.query.categoryid){
        that.activeCategoryid = that.$route.query.categoryid; //显示当前样式
        that.getAllPaperCategory();
      }else{
        if (localStorage["name_" + state.userId]) {
          that.name = localStorage["name_" + state.userId];
        }

        if (localStorage["id_" + state.userId]) {
          that.activeCategoryid = localStorage["id_" + state.userId];
        }

        if (localStorage["classes_" + state.userId]) {
          that.classes = localStorage["classes_" + state.userId];
        }
      }
    });
    this.getSubjectStatistics();
  }
};