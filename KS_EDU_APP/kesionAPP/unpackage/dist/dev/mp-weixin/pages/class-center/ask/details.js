(global["webpackJsonp"] = global["webpackJsonp"] || []).push([["pages/class-center/ask/details"],{

/***/ 103:
/*!*****************************************************************************************************!*\
  !*** J:/kesionEDU_APP/KS_EDU_APP/kesionAPP/main.js?{"page":"pages%2Fclass-center%2Fask%2Fdetails"} ***!
  \*****************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
/* WEBPACK VAR INJECTION */(function(createPage) {__webpack_require__(/*! uni-pages */ 4);__webpack_require__(/*! @dcloudio/uni-stat */ 5);

var _vue = _interopRequireDefault(__webpack_require__(/*! vue */ 2));
var _details = _interopRequireDefault(__webpack_require__(/*! ./pages/class-center/ask/details.vue */ 104));function _interopRequireDefault(obj) {return obj && obj.__esModule ? obj : { default: obj };}
createPage(_details.default);
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! ./node_modules/@dcloudio/uni-mp-weixin/dist/index.js */ 1)["createPage"]))

/***/ }),

/***/ 104:
/*!********************************************************************************!*\
  !*** J:/kesionEDU_APP/KS_EDU_APP/kesionAPP/pages/class-center/ask/details.vue ***!
  \********************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _details_vue_vue_type_template_id_fdc5790e_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./details.vue?vue&type=template&id=fdc5790e&scoped=true& */ 105);
/* harmony import */ var _details_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./details.vue?vue&type=script&lang=js& */ 107);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _details_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _details_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__[key]; }) }(__WEBPACK_IMPORT_KEY__));
/* harmony import */ var _details_vue_vue_type_style_index_0_id_fdc5790e_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./details.vue?vue&type=style&index=0&id=fdc5790e&lang=scss&scoped=true& */ 109);
/* harmony import */ var _HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../../../../软件/HBuilderX.1.9.4.20190426/HBuilderX/plugins/uniapp-cli/node_modules/vue-loader/lib/runtime/componentNormalizer.js */ 14);






/* normalize component */

var component = Object(_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _details_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _details_vue_vue_type_template_id_fdc5790e_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _details_vue_vue_type_template_id_fdc5790e_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "fdc5790e",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "kesionEDU_APP/KS_EDU_APP/kesionAPP/pages/class-center/ask/details.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ 105:
/*!***************************************************************************************************************************!*\
  !*** J:/kesionEDU_APP/KS_EDU_APP/kesionAPP/pages/class-center/ask/details.vue?vue&type=template&id=fdc5790e&scoped=true& ***!
  \***************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_16_0_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_template_js_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_vue_loader_lib_index_js_vue_loader_options_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_custom_block_loader_index_js_ref_0_1_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_details_vue_vue_type_template_id_fdc5790e_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../软件/HBuilderX.1.9.4.20190426/HBuilderX/plugins/uniapp-cli/node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../../软件/HBuilderX.1.9.4.20190426/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/vue-cli-plugin-uni/packages/webpack-preprocess-loader??ref--16-0!../../../../../../软件/HBuilderX.1.9.4.20190426/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/webpack-uni-mp-loader/lib/template.js!../../../../../../软件/HBuilderX.1.9.4.20190426/HBuilderX/plugins/uniapp-cli/node_modules/vue-loader/lib??vue-loader-options!../../../../../../软件/HBuilderX.1.9.4.20190426/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/vue-cli-plugin-uni/packages/webpack-custom-block-loader??ref--0-1!../../../../../../软件/HBuilderX.1.9.4.20190426/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/webpack-uni-mp-loader/lib/style.js!./details.vue?vue&type=template&id=fdc5790e&scoped=true& */ 106);
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_16_0_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_template_js_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_vue_loader_lib_index_js_vue_loader_options_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_custom_block_loader_index_js_ref_0_1_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_details_vue_vue_type_template_id_fdc5790e_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_16_0_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_template_js_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_vue_loader_lib_index_js_vue_loader_options_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_custom_block_loader_index_js_ref_0_1_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_details_vue_vue_type_template_id_fdc5790e_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ 106:
/*!*************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/@dcloudio/vue-cli-plugin-uni/packages/webpack-preprocess-loader??ref--16-0!./node_modules/@dcloudio/webpack-uni-mp-loader/lib/template.js!./node_modules/vue-loader/lib??vue-loader-options!./node_modules/@dcloudio/vue-cli-plugin-uni/packages/webpack-custom-block-loader??ref--0-1!./node_modules/@dcloudio/webpack-uni-mp-loader/lib/style.js!J:/kesionEDU_APP/KS_EDU_APP/kesionAPP/pages/class-center/ask/details.vue?vue&type=template&id=fdc5790e&scoped=true& ***!
  \*************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ 107:
/*!*********************************************************************************************************!*\
  !*** J:/kesionEDU_APP/KS_EDU_APP/kesionAPP/pages/class-center/ask/details.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_babel_loader_lib_index_js_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_12_1_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_script_js_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_vue_loader_lib_index_js_vue_loader_options_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_custom_block_loader_index_js_ref_0_1_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_details_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../软件/HBuilderX.1.9.4.20190426/HBuilderX/plugins/uniapp-cli/node_modules/babel-loader/lib!../../../../../../软件/HBuilderX.1.9.4.20190426/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/vue-cli-plugin-uni/packages/webpack-preprocess-loader??ref--12-1!../../../../../../软件/HBuilderX.1.9.4.20190426/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/webpack-uni-mp-loader/lib/script.js!../../../../../../软件/HBuilderX.1.9.4.20190426/HBuilderX/plugins/uniapp-cli/node_modules/vue-loader/lib??vue-loader-options!../../../../../../软件/HBuilderX.1.9.4.20190426/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/vue-cli-plugin-uni/packages/webpack-custom-block-loader??ref--0-1!../../../../../../软件/HBuilderX.1.9.4.20190426/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/webpack-uni-mp-loader/lib/style.js!./details.vue?vue&type=script&lang=js& */ 108);
/* harmony import */ var _HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_babel_loader_lib_index_js_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_12_1_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_script_js_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_vue_loader_lib_index_js_vue_loader_options_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_custom_block_loader_index_js_ref_0_1_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_details_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_babel_loader_lib_index_js_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_12_1_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_script_js_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_vue_loader_lib_index_js_vue_loader_options_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_custom_block_loader_index_js_ref_0_1_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_details_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_babel_loader_lib_index_js_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_12_1_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_script_js_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_vue_loader_lib_index_js_vue_loader_options_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_custom_block_loader_index_js_ref_0_1_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_details_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_babel_loader_lib_index_js_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_12_1_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_script_js_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_vue_loader_lib_index_js_vue_loader_options_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_custom_block_loader_index_js_ref_0_1_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_details_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_babel_loader_lib_index_js_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_12_1_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_script_js_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_vue_loader_lib_index_js_vue_loader_options_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_custom_block_loader_index_js_ref_0_1_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_details_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ 108:
/*!*********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib!./node_modules/@dcloudio/vue-cli-plugin-uni/packages/webpack-preprocess-loader??ref--12-1!./node_modules/@dcloudio/webpack-uni-mp-loader/lib/script.js!./node_modules/vue-loader/lib??vue-loader-options!./node_modules/@dcloudio/vue-cli-plugin-uni/packages/webpack-custom-block-loader??ref--0-1!./node_modules/@dcloudio/webpack-uni-mp-loader/lib/style.js!J:/kesionEDU_APP/KS_EDU_APP/kesionAPP/pages/class-center/ask/details.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
/* WEBPACK VAR INJECTION */(function(uni) {Object.defineProperty(exports, "__esModule", { value: true });exports.default = void 0;






















































































































var _classCenter = __webpack_require__(/*! @/api/class-center */ 68); //
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
var KsImage = function KsImage() {return __webpack_require__.e(/*! import() | components/ks-components/image/Image */ "components/ks-components/image/Image").then(__webpack_require__.bind(null, /*! @/components/ks-components/image/Image.vue */ 575));};var KsCollect = function KsCollect() {return Promise.all(/*! import() | components/ks-components/collect/collect */[__webpack_require__.e("common/vendor"), __webpack_require__.e("components/ks-components/collect/collect")]).then(__webpack_require__.bind(null, /*! @/components/ks-components/collect/collect.vue */ 680));};var KsEmpty = function KsEmpty() {return __webpack_require__.e(/*! import() | components/ks-components/empty/empty */ "components/ks-components/empty/empty").then(__webpack_require__.bind(null, /*! @/components/ks-components/empty/empty.vue */ 582));};var UniLoadMore = function UniLoadMore() {return __webpack_require__.e(/*! import() | components/uni/uni-load-more/uni-load-more */ "components/uni/uni-load-more/uni-load-more").then(__webpack_require__.bind(null, /*! @/components/uni/uni-load-more/uni-load-more.vue */ 638));};var _default = { data: function data() {return { baseUrl: this.$store.state.SRC + "/config/app", loaded: false, askData: {}, getParameters: { topicId: 0, pageindex: 1, pagesize: 10 }, rewardArry: ['无悬赏分', '1分', '5分', '10分', '15分', '20分', '30分', '50分', '80分', '100分'], isCollect: false, conIsShow: false, pageCount: 0, moreStatus: 'more', isReply: false, isFocus: false, content: '', isMyself: false, collectClass: '', overHeight: false, iscollect: false, isHaveBest: false, rewardIndex: 0, bottomHeight: -243 };}, components: { KsImage: KsImage, KsCollect: KsCollect, KsEmpty: KsEmpty, UniLoadMore: UniLoadMore }, onLoad: function onLoad(option) {this.getParameters.topicId = option.topicid;uni.showLoading({ title: '加载中' });this.loadPage();}, onReachBottom: function onReachBottom(e) {this.getParameters.pageindex++;this.moreList();}, onShareAppMessage: function onShareAppMessage() {var that = this; // 设置菜单中的转发按钮触发转发事件时的转发内容
    var shareObj = { title: that.askData.title, path: '/pages/class-center/ask/details?topicid=' + that.getParameters.topicId, imageUrl: that.askData.imgList[0] || this.baseUrl + '/static/images/common/default-img.png', success: function success(res) {// 转发成功之后的回调
        if (res.errMsg == 'shareAppMessage:ok') {}}, fail: function fail() {// 转发失败之后的回调
        if (res.errMsg == 'shareAppMessage:fail cancel') {// 用户取消转发
        } else if (res.errMsg == 'shareAppMessage:fail') {// 转发失败，其中 detail message 为详细失败信息
        }} }; // 返回shareObj
    return shareObj;}, methods: { bindPickerChange: function bindPickerChange(e) {var _this2 = this;this.rewardIndex = e.target.value;var scoreValue = this.rewardArry[e.target.value];var score;if (scoreValue == '无悬赏分') {score = 0;} else {score = Number(scoreValue.split('分')[0]);}uni.showLoading({ title: '正在提交中' });(0, _classCenter.AddReward)({ topicid: this.getParameters.topicId, score: score }).then(function (res) {uni.hideLoading();if (res.result) {uni.showToast({ title: '设置成功', duration: 2000, icon: 'none' });_this2.loadPage();} else {uni.showToast({ title: res.msg, duration: 2000, icon: 'none' });}});}, setBottomHeight: function setBottomHeight(e) {this.isFocus = true;if (this.isReply) {this.bottomHeight = e.detail.height;}}, setNoHeight: function setNoHeight() {this.isFocus = false;if (this.isReply) {this.bottomHeight = 0;} else {this.bottomHeight = -243;}}, closeReply: function closeReply() {
      this.isReply = false;
      this.isFocus = false;
      this.bottomHeight = -243;
      this.content = '';
    },
    deleteReply: function deleteReply(topicid, postid) {var _this3 = this;
      uni.showLoading({
        title: '正在提交中' });

      (0, _classCenter.DeleteAnswer)({
        topicid: topicid,
        postid: postid }).
      then(function (res) {
        uni.hideLoading();
        if (res.result) {
          uni.showToast({
            title: '删除成功',
            duration: 2000,
            icon: 'none' });

          _this3.loadPage();
        } else {
          uni.showToast({
            title: res.msg,
            duration: 2000,
            icon: 'none' });

        }
      });
    },
    setBestAsk: function setBestAsk(topicid, postid) {var _this4 = this;
      uni.showLoading({
        title: '正在提交中' });

      (0, _classCenter.SetAskSatisfied)({
        topicid: topicid,
        postid: postid }).
      then(function (res) {
        uni.hideLoading();
        if (res.result) {
          uni.showToast({
            title: '设置成功',
            duration: 2000,
            icon: 'none' });

          _this4.loadPage();
        } else {
          uni.showToast({
            title: res.msg,
            duration: 2000,
            icon: 'none' });

        }
      });
    },
    setNoSatisfaction: function setNoSatisfaction() {
      var _this = this;
      uni.showModal({
        title: '无满意答案',
        content: '如果没有满意的回答，可点击“关闭问题”按钮结束提问',
        success: function success(res) {
          if (res.confirm) {
            _this.closeAsk();
          } else if (res.cancel) {
            console.log('用户点击取消');
          }
        } });

    },
    closeAsk: function closeAsk() {var _this5 = this;
      uni.showLoading({
        title: '正在提交中' });

      (0, _classCenter.CloseAsk)({
        topicid: this.getParameters.topicId }).
      then(function (res) {
        uni.hideLoading();
        if (res.result) {
          uni.showToast({
            title: '关闭成功',
            duration: 2000,
            icon: 'none' });

          _this5.loadPage();
        } else {
          uni.showToast({
            title: res.msg,
            duration: 2000,
            icon: 'none' });

        }
      });
    },
    moreList: function moreList() {
      if (this.getParameters.pageindex > this.pageCount) {
        this.moreStatus = 'noMore';
      } else {
        this.moreStatus = 'loading';
        this.loadPage('more');
      }
    },
    loadPage: function loadPage(status) {var _this6 = this;
      if (status == 'more') {
        (0, _classCenter.GetAskView)(this.getParameters).then(function (res) {
          _this6.moreStatus = 'more';
          if (res.result) {
            res.replyList.map(function (item, i) {
              item.isShow = false;
            });
            _this6.askData.replyList = _this6.askData.replyList.concat(res.replyList);
          }
          _this6.loaded = true;
        });
      } else {
        this.getParameters.pageindex = 1;
        (0, _classCenter.GetAskView)(this.getParameters).then(function (res) {
          if (res.result) {
            _this6.pageCount = res.pageCount;
            if (_this6.pageCount == 1) {
              _this6.moreStatus = 'noMore';
            } else {
              _this6.moreStatus = 'more';
            }
            _this6.isMyself = res.ismine;
            _this6.iscollect = res.iscollect;
            if (res.bestusername) {
              _this6.isHaveBest = true;
            } else {
              _this6.isHaveBest = false;
            }
            res.replyList.map(function (item, i) {
              item.overHeight = false;
              item.isShow = false;
            });
            _this6.askData = res;
            if (_this6.askData.issolve == '0') {
              if (_this6.isMyself) {
                _this6.collectClass = 'ks-col-5';
              } else {
                _this6.collectClass = 'ks-col-6';
              }
            } else {
              _this6.collectClass = 'ks-col-6';

            }
          } else {
            _this6.pageCount = 0;
          }
          _this6.loaded = true;
          uni.hideLoading();
          _this6.$nextTick(function () {var _this7 = this;
            var query = uni.createSelectorQuery().in(this);
            query.select('#ask-con-show').boundingClientRect(function (data) {
              if (data.height > 40) {
                _this7.overHeight = true;
              } else {
                _this7.overHeight = false;
              }
            }).exec();
            this.askData.replyList.map(function (item, i) {
              var query = uni.createSelectorQuery().in(_this7);
              query.select('#reply' + i).boundingClientRect(function (data) {
                if (data.height > 40) {
                  item.overHeight = true;
                } else {
                  item.overHeight = false;
                }
              }).exec();
            });
          });
        });

      }
    },
    setShow: function setShow(action, index) {
      if (action == 'reply') {
        this.askData.replyList[index].isShow = this.askData.replyList[index].isShow == false ? true : false;
      } else {
        this.conIsShow = this.conIsShow == false ? true : false;
      }
    },
    replyQuestion: function replyQuestion() {
      this.isReply = true;
      this.bottomHeight = 0;
    },
    cancel: function cancel() {
      this.isReply = false;
      this.isFocus = false;
      this.bottomHeight = -243;
      this.content = '';
    },
    submit: function submit() {var _this8 = this;
      if (this.content) {
        uni.showLoading({
          title: '正在提交中' });

        (0, _classCenter.ReplyAskTopic)({
          topicid: this.getParameters.topicId,
          content: this.content }).
        then(function (res) {
          uni.hideLoading();
          if (res.result) {
            uni.showToast({
              title: '提交回答成功',
              duration: 2000,
              icon: 'none' });

            _this8.loadPage();
          } else {
            uni.showToast({
              title: res.msg,
              duration: 2000,
              icon: 'none' });

          }
          _this8.content = '';
          _this8.isReply = false;
          _this8.isFocus = false;
          _this8.bottomHeight = -243;
        });
      } else {
        uni.showToast({
          title: '请输入回答内容',
          duration: 10000,
          icon: 'none' });

      }
    } } };exports.default = _default;
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! ./node_modules/@dcloudio/uni-mp-weixin/dist/index.js */ 1)["default"]))

/***/ }),

/***/ 109:
/*!******************************************************************************************************************************************!*\
  !*** J:/kesionEDU_APP/KS_EDU_APP/kesionAPP/pages/class-center/ask/details.vue?vue&type=style&index=0&id=fdc5790e&lang=scss&scoped=true& ***!
  \******************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_mini_css_extract_plugin_dist_loader_js_ref_8_oneOf_1_0_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_8_oneOf_1_1_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_css_loader_index_js_ref_8_oneOf_1_2_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_vue_loader_lib_loaders_stylePostLoader_js_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_postcss_loader_src_index_js_ref_8_oneOf_1_3_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_sass_loader_lib_loader_js_ref_8_oneOf_1_4_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_8_oneOf_1_5_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_vue_loader_lib_index_js_vue_loader_options_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_custom_block_loader_index_js_ref_0_1_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_details_vue_vue_type_style_index_0_id_fdc5790e_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../软件/HBuilderX.1.9.4.20190426/HBuilderX/plugins/uniapp-cli/node_modules/mini-css-extract-plugin/dist/loader.js??ref--8-oneOf-1-0!../../../../../../软件/HBuilderX.1.9.4.20190426/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/vue-cli-plugin-uni/packages/webpack-preprocess-loader??ref--8-oneOf-1-1!../../../../../../软件/HBuilderX.1.9.4.20190426/HBuilderX/plugins/uniapp-cli/node_modules/css-loader??ref--8-oneOf-1-2!../../../../../../软件/HBuilderX.1.9.4.20190426/HBuilderX/plugins/uniapp-cli/node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../../../软件/HBuilderX.1.9.4.20190426/HBuilderX/plugins/uniapp-cli/node_modules/postcss-loader/src??ref--8-oneOf-1-3!../../../../../../软件/HBuilderX.1.9.4.20190426/HBuilderX/plugins/uniapp-cli/node_modules/sass-loader/lib/loader.js??ref--8-oneOf-1-4!../../../../../../软件/HBuilderX.1.9.4.20190426/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/vue-cli-plugin-uni/packages/webpack-preprocess-loader??ref--8-oneOf-1-5!../../../../../../软件/HBuilderX.1.9.4.20190426/HBuilderX/plugins/uniapp-cli/node_modules/vue-loader/lib??vue-loader-options!../../../../../../软件/HBuilderX.1.9.4.20190426/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/vue-cli-plugin-uni/packages/webpack-custom-block-loader??ref--0-1!../../../../../../软件/HBuilderX.1.9.4.20190426/HBuilderX/plugins/uniapp-cli/node_modules/@dcloudio/webpack-uni-mp-loader/lib/style.js!./details.vue?vue&type=style&index=0&id=fdc5790e&lang=scss&scoped=true& */ 110);
/* harmony import */ var _HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_mini_css_extract_plugin_dist_loader_js_ref_8_oneOf_1_0_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_8_oneOf_1_1_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_css_loader_index_js_ref_8_oneOf_1_2_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_vue_loader_lib_loaders_stylePostLoader_js_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_postcss_loader_src_index_js_ref_8_oneOf_1_3_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_sass_loader_lib_loader_js_ref_8_oneOf_1_4_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_8_oneOf_1_5_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_vue_loader_lib_index_js_vue_loader_options_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_custom_block_loader_index_js_ref_0_1_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_details_vue_vue_type_style_index_0_id_fdc5790e_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_mini_css_extract_plugin_dist_loader_js_ref_8_oneOf_1_0_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_8_oneOf_1_1_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_css_loader_index_js_ref_8_oneOf_1_2_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_vue_loader_lib_loaders_stylePostLoader_js_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_postcss_loader_src_index_js_ref_8_oneOf_1_3_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_sass_loader_lib_loader_js_ref_8_oneOf_1_4_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_8_oneOf_1_5_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_vue_loader_lib_index_js_vue_loader_options_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_custom_block_loader_index_js_ref_0_1_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_details_vue_vue_type_style_index_0_id_fdc5790e_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_mini_css_extract_plugin_dist_loader_js_ref_8_oneOf_1_0_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_8_oneOf_1_1_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_css_loader_index_js_ref_8_oneOf_1_2_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_vue_loader_lib_loaders_stylePostLoader_js_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_postcss_loader_src_index_js_ref_8_oneOf_1_3_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_sass_loader_lib_loader_js_ref_8_oneOf_1_4_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_8_oneOf_1_5_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_vue_loader_lib_index_js_vue_loader_options_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_custom_block_loader_index_js_ref_0_1_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_details_vue_vue_type_style_index_0_id_fdc5790e_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_0__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_mini_css_extract_plugin_dist_loader_js_ref_8_oneOf_1_0_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_8_oneOf_1_1_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_css_loader_index_js_ref_8_oneOf_1_2_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_vue_loader_lib_loaders_stylePostLoader_js_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_postcss_loader_src_index_js_ref_8_oneOf_1_3_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_sass_loader_lib_loader_js_ref_8_oneOf_1_4_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_8_oneOf_1_5_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_vue_loader_lib_index_js_vue_loader_options_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_custom_block_loader_index_js_ref_0_1_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_details_vue_vue_type_style_index_0_id_fdc5790e_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_mini_css_extract_plugin_dist_loader_js_ref_8_oneOf_1_0_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_8_oneOf_1_1_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_css_loader_index_js_ref_8_oneOf_1_2_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_vue_loader_lib_loaders_stylePostLoader_js_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_postcss_loader_src_index_js_ref_8_oneOf_1_3_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_sass_loader_lib_loader_js_ref_8_oneOf_1_4_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_preprocess_loader_index_js_ref_8_oneOf_1_5_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_vue_loader_lib_index_js_vue_loader_options_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_vue_cli_plugin_uni_packages_webpack_custom_block_loader_index_js_ref_0_1_HBuilderX_1_9_4_20190426_HBuilderX_plugins_uniapp_cli_node_modules_dcloudio_webpack_uni_mp_loader_lib_style_js_details_vue_vue_type_style_index_0_id_fdc5790e_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ 110:
/*!*************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/mini-css-extract-plugin/dist/loader.js??ref--8-oneOf-1-0!./node_modules/@dcloudio/vue-cli-plugin-uni/packages/webpack-preprocess-loader??ref--8-oneOf-1-1!./node_modules/css-loader??ref--8-oneOf-1-2!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--8-oneOf-1-3!./node_modules/sass-loader/lib/loader.js??ref--8-oneOf-1-4!./node_modules/@dcloudio/vue-cli-plugin-uni/packages/webpack-preprocess-loader??ref--8-oneOf-1-5!./node_modules/vue-loader/lib??vue-loader-options!./node_modules/@dcloudio/vue-cli-plugin-uni/packages/webpack-custom-block-loader??ref--0-1!./node_modules/@dcloudio/webpack-uni-mp-loader/lib/style.js!J:/kesionEDU_APP/KS_EDU_APP/kesionAPP/pages/class-center/ask/details.vue?vue&type=style&index=0&id=fdc5790e&lang=scss&scoped=true& ***!
  \*************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

// extracted by mini-css-extract-plugin

/***/ })

},[[103,"common/runtime","common/vendor"]]]);
//# sourceMappingURL=../../../../.sourcemap/mp-weixin/pages/class-center/ask/details.js.map