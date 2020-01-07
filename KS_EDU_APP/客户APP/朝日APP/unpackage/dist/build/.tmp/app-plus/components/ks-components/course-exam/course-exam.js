(global["webpackJsonp"]=global["webpackJsonp"]||[]).push([["components/ks-components/course-exam/course-exam"],{"0938":function(e,t,n){"use strict";n.r(t);var o=n("86d8"),r=n("c131");for(var u in r)"default"!==u&&function(e){n.d(t,e,function(){return r[e]})}(u);n("30f8");var a=n("2877"),s=Object(a["a"])(r["default"],o["a"],o["b"],!1,null,"cdae2e28",null);t["default"]=s.exports},"30f8":function(e,t,n){"use strict";var o=n("50ea"),r=n.n(o);r.a},"50ea":function(e,t,n){},"86d8":function(e,t,n){"use strict";var o=function(){var e=this,t=e.$createElement;e._self._c},r=[];n.d(t,"a",function(){return o}),n.d(t,"b",function(){return r})},c131:function(e,t,n){"use strict";n.r(t);var o=n("ef27"),r=n.n(o);for(var u in o)"default"!==u&&function(e){n.d(t,e,function(){return o[e]})}(u);t["default"]=r.a},ef27:function(e,t,n){"use strict";(function(e){Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0;var o=n("2f6d"),r={props:{courseId:Number},data:function(){return{baseUrl:this.$store.state.SRC+"/config/app",list:[],hasCoursePower:!1}},methods:{open:function(t){t&&e.navigateTo({url:"/pages/exam/paperinfo?paperid="+t})}},mounted:function(){var e=this;this.$store.ready(function(t){(0,o.GetPaper)({courseid:e.courseId,schoolid:t.schoolId}).then(function(t){t.result&&(e.hasCoursePower=t.HasCoursePower,e.list=t.Paperlist)})})}};t.default=r}).call(this,n("6e42")["default"])}}]);
;(global["webpackJsonp"] = global["webpackJsonp"] || []).push([
    'components/ks-components/course-exam/course-exam-create-component',
    {
        'components/ks-components/course-exam/course-exam-create-component':(function(module, exports, __webpack_require__){
            __webpack_require__('6e42')['createComponent'](__webpack_require__("0938"))
        })
    },
    [['components/ks-components/course-exam/course-exam-create-component']]
]);
