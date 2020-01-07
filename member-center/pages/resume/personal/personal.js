return {
  data: function() {
    /**姓名验证 */
    var checkRealName = function(rule, value, callback) {
      var reg = /^[\u4E00-\u9FA5\uf900-\ufa2d·s]{2,5}$/;
      if (!reg.test(value)) {
        return callback(new Error("请输入2-5字中文姓名"));
      } else {
        callback();
      }
    };
    /**邮箱验证 */
    var checkEmail = function(rule, value, callback) {
      var reg = /^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i;
      if (reg.test(value)) {
        callback();
      } else {
        return callback(new Error("请输入正确的邮箱"));
      }
    };
    var checkBirthday = function(rule, value, callback) {
      
      if (value) {
        callback();
      } else {
        return callback(new Error("请输入出生年月"));
      }
    };
    var checkSex= function(rule, value, callback) {
      
      if (value) {
        callback();
      } else {
        return callback(new Error("请输入性别"));
      }
    };
    var checkHeight= function(rule, value, callback) {
      
      if (value) {
        callback();
      } else {
        return callback(new Error("请输入身高"));
      }
    };
    var checkMobile= function(rule, value, callback) {
      
      if (value) {
        callback();
      } else {
        return callback(new Error("请输入手机号码"));
      }
    };
    var _hash = Math.ceil(Math.random() * 9999999999);
    return {
      state: store.state,
      /**用户信息 */
      userInfo: {},
      /**表单数据 */
      form: {},
      /**表单验证 */
      rules: {
        realname: [
          { required: true, validator: checkRealName, trigger: "blur" }
        ],
        Email: [{ required: true, validator: checkEmail, trigger: "blur" }],
        birthday:[{ required: true, validator: checkBirthday, trigger: "blur" }],
        sex:[{ required: true, validator: checkSex, trigger: "blur" }],
        mobile:[{ required: true, validator: checkMobile, trigger: "blur" }],
        height:[{ required: true, validator: checkHeight, trigger: "blur" }],
      },
      /**设置标签开关 */
      dialogSetLabelVisible: false,
      /**省数据 */
      provinceList: [],
      /**市数据 */
      cityList: [],
      /**区数据 */
      areaList: [],
      provinceId: "",
      cityId: "",
      countyId: "",
      /**标签数据 */
      tagsList: [],
      /**选中标签 */
      xztagsList: [],
      birthday: "",
      dialogVisible: false,
      /**学历列表 */
      education: [],
      /**经验列表 */
      experienceList: [],
      marriageList: [
        { name: "未婚" },
        { name: "已婚" },
        { name: "离婚" },
        { name: "保密" }
      ],
      marriage: "",
      hash: _hash
    };
  },
  methods: {
    change: function(e) {},
    /**打开下拉框获取省级数据
     *  e 回调参数 布尔值
     */
    getProvinceList: function(e) {
      var that = this;
      if (e) {
        if (that.provinceList.length == 0) {
          GetArea({
            areaid: 0
          }).then(function(res) {
            that.provinceList = res.data;
          });
        }
      }
    },
    /**打开下拉框获取市级数据
     *  e 回调参数 布尔值
     */
    getCityList: function(e) {
      var that = this;
      if (e) {
        if (that.cityList.length == 0 && that.provinceId != "") {
          GetArea({
            areaid: that.provinceId
          }).then(function(res) {
            that.cityList = res.data;
          });
        }
      }
    },
    /**打开下拉框获取区级数据
     *  e 回调参数 布尔值
     */
    getAreaList: function(e) {
      var that = this;
      if (e) {
        if (that.areaList.length == 0 && that.cityId != "") {
          GetArea({
            areaid: that.cityId
          }).then(function(res) {
            that.areaList = res.data;
          });
        }
      }
    },
    /**选中省级菜单回调获取市级列表 */
    changeProvince: function(e) {
      var that = this;
      that.provinceId = e;
      GetArea({
        areaid: e
      }).then(function(res) {
        if (res.result == true) {
          that.cityList = res.data;
          that.cityId = res.data[0].id;
          that.form.city = res.data[0].city;
          that.countyId = "";
          that.form.county = "";
          that.areaList = [];
        } else {
          that.form.county = "";
          that.form.city = "";
          that.countyId = "";
          that.cityId = "";
          that.cityList = [];
          that.areaList = [];
        }
      });
    },
    /**选中市级菜单回调获取区县列表 */
    changeCity: function(e) {
      /**强制刷新值的方法 */
      this.$forceUpdate();
      var that = this;
      that.cityId = e;
      GetArea({
        areaid: e
      }).then(function(res) {
        if (res.result == true) {
          that.areaList = res.data;
          that.form.county = res.data[0].city;
          that.countyId = res.data[0].id;
        } else {
          that.areaList = [];
          that.form.county = "";
          that.countyId = "";
        }
      });
    },
    /**选中区县更新区县id */
    changeCounty: function(e) {
      /**强制刷新值的方法 */
      this.$forceUpdate();
      this.countyId = e;
    },

    /**设置标签 */
    setLabel: function() {
      var that = this;
      this.dialogSetLabelVisible = true;
      GetKeyTagsList({}).then(function(res) {
        that.tagsList = res.data;
      });
    },
    /**选中标签 */
    addTags: function(item) {
      var that = this;
      if (this.xztagsList.indexOf(item) == -1) {
        this.xztagsList.push(item);
        if (this.form.tagsids == "") {
          this.form.tagsids = item.tagsid;
        } else {
          this.form.tagsids = this.form.tagsids + "," + item.tagsid;
        }
      }
    },
    /**删除标签 */
    delTags: function(item) {
      var that = this;
      var index = this.xztagsList.indexOf(item);
      this.xztagsList.splice(index, 1);
      var list = this.xztagsList.map(function(item) {
        return item.tagsid;
      });
      this.form.tagsids = list.join();
    },
    /**添加标签到页面 */
    pushTags: function(item) {
      this.dialogSetLabelVisible = false;
    },
    /**提交保存资料 */
    save: function() {
      var that = this;
      that.$refs.form.validate(function(valid) {
        if (valid == true) {
          SaveUserJobBasicInfo({
            workexperience: that.form.workExperience,
            realname: that.form.realname,
            sex: that.form.sex,
            birthday: that.form.birthday,
            height: that.form.height,
            kg: that.form.kg,
            userface: that.form.photo,
            nation: that.form.nation,
            school: that.form.school,
            provinceid: that.provinceId,
            cityid: that.cityId,
            countyid: that.countyId,
            qualifications: that.form.qualifications,
            professional: that.form.professional,
            languagelevel: that.form.languagelevel,
            computerlevel: that.form.computerlevel,
            graduationtime: that.form.graduationtime,
            review: that.form.review,
            address: that.form.address,
            mobile: that.form.mobile,
            email: that.form.email,
            worktime: that.form.worktime,
            marriage: that.form.marriage,
            cardid: that.form.cardid,
            apptoken: that.state.appToken
          }).then(function(res) {
            if (res.result == true) {
              that.$message.success("修改成功");
              that.getUserJobBasicInfo();
            } else {
              that.$message.error(res.msg);
            }
          });
        }
    })
      
    },
    /**
     * 上传照片
     */
    changeAvatar: function() {
      this.$refs.file_avatar.click();
    },
    /**
     * 上传照片
     */
    uploadAvatar: function(e) {
      var that = this;
      // that.$showLoading("#userRight");
      var file = that.$refs.file_avatar.files[0];
      var formData = new FormData();
      formData.append("file", file);
      formData.append("apptoken", that.state.appToken);
      UploadFile(formData).then(function(res) {
        // that.$hideLoading("#userRight");
        if (res.result === true) {
          that.$message.success("上传成功");
          /**强制刷新值的方法 */
          that.$forceUpdate();
          that.form.photo = res.fileUrl;
        } else {
          that.$message.error("修改头像失败");
        }
      });
    },
    /** 获取求职基本资料*/
    getUserJobBasicInfo: function() {
      var that = this;
      GetUserJobBasicInfo({
        apptoken: that.state.appToken
      }).then(function(res) {
        if (res.result == true) {
          that.form = res.data;
          that.form.graduationtime = res.data.graduationtime.toString();
          that.provinceId = that.form.provinceid;
          that.cityId = that.form.cityid;
          that.countyId = that.form.countyid;
        }
      });
    },
    /** 学历设置*/
    getJobEducation: function() {
      var that = this;
      GetJobEducation({
        apptoken: that.state.appToken
      }).then(function(res) {
        that.education = res.data;
      });
    },
    /** 经验设置*/
    getExperienceList: function() {
      var that = this;
      GetJobWorkingLife({
        apptoken: that.state.appToken
      }).then(function(res) {
        that.experienceList = res.data;
      });
    }
  },
  mounted: function() {
    var that = this;
    that.$store.ready(function(state) {
      that.userInfo = state.userInfo;
      that.state = state;
      that.getUserJobBasicInfo();
      that.getJobEducation();
      that.getExperienceList();
    });
  }
};
