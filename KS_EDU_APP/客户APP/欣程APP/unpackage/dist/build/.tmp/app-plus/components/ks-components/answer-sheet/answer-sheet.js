(global["webpackJsonp"]=global["webpackJsonp"]||[]).push([["components/ks-components/answer-sheet/answer-sheet"],{"0d4a":function(t,e,n){"use strict";var a=function(){var t=this,e=t.$createElement;t._self._c},i=[];n.d(e,"a",function(){return a}),n.d(e,"b",function(){return i})},4408:function(t,e,n){},"6b82":function(t,e,n){"use strict";var a=n("4408"),i=n.n(a);i.a},a16c:function(t,e,n){"use strict";n.r(e);var a=n("b05e"),i=n.n(a);for(var u in a)"default"!==u&&function(t){n.d(e,t,function(){return a[t]})}(u);e["default"]=i.a},b05e:function(t,e,n){"use strict";(function(t){Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var n={props:{visible:{type:Boolean,default:!1}},data:function(){return{answerSheetHeight:"",answerSheet:[]}},mounted:function(){var e=this;t.getSystemInfo({success:function(t){e.answerSheetHeight=t.windowHeight-57}})},activated:function(){this.answerSheet=[]},methods:{reset:function(t){this.answerSheet=t.answerList},skipTm:function(t){this.$emit("callback",t)},submit:function(){this.$emit("submit")}}};e.default=n}).call(this,n("6e42")["default"])},f369:function(t,e,n){"use strict";n.r(e);var a=n("0d4a"),i=n("a16c");for(var u in i)"default"!==u&&function(t){n.d(e,t,function(){return i[t]})}(u);n("6b82");var s=n("2877"),c=Object(s["a"])(i["default"],a["a"],a["b"],!1,null,"1db8c077",null);e["default"]=c.exports}}]);
;(global["webpackJsonp"] = global["webpackJsonp"] || []).push([
    'components/ks-components/answer-sheet/answer-sheet-create-component',
    {
        'components/ks-components/answer-sheet/answer-sheet-create-component':(function(module, exports, __webpack_require__){
            __webpack_require__('6e42')['createComponent'](__webpack_require__("f369"))
        })
    },
    [['components/ks-components/answer-sheet/answer-sheet-create-component']]
]);
