(global["webpackJsonp"]=global["webpackJsonp"]||[]).push([["pages/user/settings/basicinfo"],{"0a5b":function(e,n,t){},"1b77":function(e,n,t){"use strict";var i=function(){var e=this,n=e.$createElement;e._self._c},o=[];t.d(n,"a",function(){return i}),t.d(n,"b",function(){return o})},5674:function(e,n,t){"use strict";(function(e){t("3099"),t("921b");i(t("66fd"));var n=i(t("7db7"));function i(e){return e&&e.__esModule?e:{default:e}}e(n.default)}).call(this,t("6e42")["createPage"])},"6a57":function(e,n,t){"use strict";(function(e){Object.defineProperty(n,"__esModule",{value:!0}),n.default=void 0;var i=t("3ae9"),o=function(){return t.e("components/ks-components/image/Image").then(t.bind(null,"32e8"))},r=function(){return t.e("components/uni/mpvue-picker/mpvue-picker").then(t.bind(null,"5195"))},u=function(){return Promise.all([t.e("common/vendor"),t.e("components/uni/mpvue-citypicker/mpvue-citypicker")]).then(t.bind(null,"15e2"))},s={components:{KsImage:o,MpvuePicker:r,MpvueCityPicker:u},data:function(){return{email:"",photoUrl:"",pickerText:{label:"请选择"},pickerCityText:{name:"请选择"},cityPickerValueDefault:[0,0,1],themeColor:"#007AFF",pickerValueDefault:[1],pickerValueArray:[{label:"男",value:"男"},{label:"女",value:"女"}],userInfo:{},state:{}}},onShow:function(){var e=this;this.$store.ready(function(n){e.state=n,e.userInfo=n.userInfo,e.userInfo.province&&e.userInfo.city&&e.userInfo.county&&(e.pickerCityText.name=e.userInfo.province+"-"+e.userInfo.city+"-"+e.userInfo.county),e.pickerCityText.ids=[e.userInfo.ProID,e.userInfo.CityID,e.userInfo.CountyID],e.userInfo.Sex&&(e.pickerText.label=e.userInfo.Sex),e.userInfo.RealName=e.userInfo.RealName?e.userInfo.RealName:"",e.photoUrl=e.userInfo.UserFace+"?"+Math.ceil(9999999999*Math.random())})},methods:{save:function(){var n=this;(0,i.SaveUesrBasicInfo)({email:this.userInfo.Email,realname:this.userInfo.RealName,sex:this.pickerText.label,provinceid:this.pickerCityText.ids[0]||null,cityid:this.pickerCityText.ids[1]||null,countyid:this.pickerCityText.ids[2]||null}).then(function(t){t.result?n.$store.dispatch("getUserInfo").then(function(){n.$store.ready(function(e){n.userInfo=e.userInfo})}):(e.showToast({title:t.msg,icon:"none"}),n.$store.ready(function(e){n.userInfo=e.userInfo}))})},changeAvatar:function(){var n=this;e.chooseImage({count:1,sizeType:["original","compressed"],sourceType:["album"],success:function(t){var i=t.tempFilePaths;e.uploadFile({url:n.state.SRC+"/webapi/user/ModifyUserFace",filePath:i[0],name:"file",formData:{userid:n.userInfo.UserID,apptoken:n.userInfo.ApiToken},success:function(t){var i=JSON.parse(t.data);i.result?(n.photoUrl=i.userface+"?"+Math.ceil(9999999999*Math.random()),n.$store.dispatch("getUserInfo").then(function(){n.$store.ready(function(e){n.userInfo=e.userInfo})})):e.showToast({title:"修改头像失败",icon:"none"})}})}})},onCityConfirm:function(e){this.pickerCityText=e,this.save()},onConfirm:function(e){this.pickerText=e,this.save()},showMulLinkageThreePicker:function(){this.$refs.mpvueCityPicker.show()},showPicker:function(){this.$refs.mpvuePicker.show()}}};n.default=s}).call(this,t("6e42")["default"])},"7db7":function(e,n,t){"use strict";t.r(n);var i=t("1b77"),o=t("9727");for(var r in o)"default"!==r&&function(e){t.d(n,e,function(){return o[e]})}(r);t("ca58");var u=t("2877"),s=Object(u["a"])(o["default"],i["a"],i["b"],!1,null,"20de62e5",null);n["default"]=s.exports},9727:function(e,n,t){"use strict";t.r(n);var i=t("6a57"),o=t.n(i);for(var r in i)"default"!==r&&function(e){t.d(n,e,function(){return i[e]})}(r);n["default"]=o.a},ca58:function(e,n,t){"use strict";var i=t("0a5b"),o=t.n(i);o.a}},[["5674","common/runtime","common/vendor"]]]);