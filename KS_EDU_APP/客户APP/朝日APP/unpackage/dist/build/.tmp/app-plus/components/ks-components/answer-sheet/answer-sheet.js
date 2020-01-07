(global["webpackJsonp"]=global["webpackJsonp"]||[]).push([["components/ks-components/answer-sheet/answer-sheet"],{2160:function(t,e,n){"use strict";var a=n("5baf"),i=n.n(a);i.a},"5baf":function(t,e,n){},"62aa":function(t,e,n){"use strict";(function(t){Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var n={props:{visible:{type:Boolean,default:!1}},data:function(){return{answerSheetHeight:"",answerSheet:[]}},mounted:function(){var e=this;t.getSystemInfo({success:function(t){e.answerSheetHeight=t.windowHeight-57}})},activated:function(){this.answerSheet=[]},methods:{reset:function(t){this.answerSheet=t.answerList},skipTm:function(t){this.$emit("callback",t)},submit:function(){this.$emit("submit")}}};e.default=n}).call(this,n("6e42")["default"])},"703e":function(t,e,n){"use strict";n.r(e);var a=n("8f63"),i=n("9d9a");for(var u in i)"default"!==u&&function(t){n.d(e,t,function(){return i[t]})}(u);n("2160");var s=n("2877"),r=Object(s["a"])(i["default"],a["a"],a["b"],!1,null,"22429f97",null);e["default"]=r.exports},"8f63":function(t,e,n){"use strict";var a=function(){var t=this,e=t.$createElement;t._self._c},i=[];n.d(e,"a",function(){return a}),n.d(e,"b",function(){return i})},"9d9a":function(t,e,n){"use strict";n.r(e);var a=n("62aa"),i=n.n(a);for(var u in a)"default"!==u&&function(t){n.d(e,t,function(){return a[t]})}(u);e["default"]=i.a}}]);
;(global["webpackJsonp"] = global["webpackJsonp"] || []).push([
    'components/ks-components/answer-sheet/answer-sheet-create-component',
    {
        'components/ks-components/answer-sheet/answer-sheet-create-component':(function(module, exports, __webpack_require__){
            __webpack_require__('6e42')['createComponent'](__webpack_require__("703e"))
        })
    },
    [['components/ks-components/answer-sheet/answer-sheet-create-component']]
]);
