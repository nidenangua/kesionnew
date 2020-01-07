(global["webpackJsonp"]=global["webpackJsonp"]||[]).push([["components/ks-components/answer-sheet/answer-sheet"],{1805:function(t,e,n){"use strict";(function(t){Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var n={props:{visible:{type:Boolean,default:!1}},data:function(){return{answerSheetHeight:"",answerSheet:[]}},mounted:function(){var e=this;t.getSystemInfo({success:function(t){e.answerSheetHeight=t.windowHeight-57}})},activated:function(){this.answerSheet=[]},methods:{reset:function(t){this.answerSheet=t.answerList},skipTm:function(t){this.$emit("callback",t)},submit:function(){this.$emit("submit")}}};e.default=n}).call(this,n("6e42")["default"])},"361f":function(t,e,n){"use strict";n.r(e);var a=n("700a"),i=n("a41f");for(var u in i)"default"!==u&&function(t){n.d(e,t,function(){return i[t]})}(u);n("7b99");var s=n("2877"),r=Object(s["a"])(i["default"],a["a"],a["b"],!1,null,"fce9e504",null);e["default"]=r.exports},"700a":function(t,e,n){"use strict";var a=function(){var t=this,e=t.$createElement;t._self._c},i=[];n.d(e,"a",function(){return a}),n.d(e,"b",function(){return i})},"7b99":function(t,e,n){"use strict";var a=n("ee86"),i=n.n(a);i.a},a41f:function(t,e,n){"use strict";n.r(e);var a=n("1805"),i=n.n(a);for(var u in a)"default"!==u&&function(t){n.d(e,t,function(){return a[t]})}(u);e["default"]=i.a},ee86:function(t,e,n){}}]);
;(global["webpackJsonp"] = global["webpackJsonp"] || []).push([
    'components/ks-components/answer-sheet/answer-sheet-create-component',
    {
        'components/ks-components/answer-sheet/answer-sheet-create-component':(function(module, exports, __webpack_require__){
            __webpack_require__('6e42')['createComponent'](__webpack_require__("361f"))
        })
    },
    [['components/ks-components/answer-sheet/answer-sheet-create-component']]
]);                
