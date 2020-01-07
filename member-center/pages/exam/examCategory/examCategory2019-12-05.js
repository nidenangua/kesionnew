return {
  data:function() {
    return {
      state: {},
      /**全部分类 */
      allClass: [], 
      active: null, 
      /** 课程id*/
      id: null, 
      /**课程名称 */
      classes: null, 
      show: false
    }
  },
  methods: {
    /** 选择课程并存储*/ 
    setClasses:function(id,classes, childsClass) {
      console.log(id,classes, childsClass)
      var that = this
      this.classes = classes;
      this.id = id;
      this.$store.ready(function(state) {
        localStorage["classes_" + state.userId] = classes;
        localStorage["id_" + state.userId] = id;
        if (childsClass) {
          localStorage.childsClass = JSON.stringify(childsClass);
        }
        that.active = id;
        that.$router.push({
    
          name: "MyExam",
          query: {
            categoryid: id
          }
        });
      });
 
    },
    getAllPaperCategory: function() {
      var that = this;
      /** 请求接口获取一级课程列表*/
      GetAllPaperCategory({
        apptoken: that.state.appToken
      }).then(function(res) {
        that.allClass = res.data;
        localStorage.allClass = JSON.stringify(res.data);
      });
    }
    
  },
  created: function() {
  },
  activated: function() {
    var that = this;
    that.$store.ready(function(state) {
      that.state = state;
      if (localStorage["classes_" + state.userId]) {
        that.$router.push({
  
          name: "MyExam",
          query: {
            categoryid: localStorage["id_" + state.userId]
          }
        });
      } else {
        that.show = true;
        that.getAllPaperCategory();
        if (localStorage["classes_" + state.userId]) {
          that.classes = localStorage["classes_" + state.userId];
        }
        if (localStorage["id_" + state.userId]) {
          that.id = localStorage["id_" + state.userId];
          that.active = localStorage["id_" + state.userId];
        }
      }
    });
  }
};
