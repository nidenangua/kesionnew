(global["webpackJsonp"]=global["webpackJsonp"]||[]).push([["components/ks-components/fill-blanks/fill-blanks"],{"35b6":function(t,n,e){},4582:function(t,n,e){"use strict";var i=e("35b6"),r=e.n(i);r.a},"52a8":function(t,n,e){"use strict";e.r(n);var i=e("93bc"),r=e("f3a9");for(var a in r)"default"!==a&&function(t){e.d(n,t,function(){return r[t]})}(a);e("4582");var s=e("2877"),u=Object(s["a"])(r["default"],i["a"],i["b"],!1,null,"3898d29c",null);n["default"]=u.exports},"93bc":function(t,n,e){"use strict";var i=function(){var t=this,n=t.$createElement;t._self._c},r=[];e.d(n,"a",function(){return i}),e.d(n,"b",function(){return r})},c42a:function(t,n,e){"use strict";Object.defineProperty(n,"__esModule",{value:!0}),n.default=void 0;var i={props:{isCombinationQuestion:{type:Boolean,default:!1},index:Number,item:{type:Object,default:function(){return{}}},parenttkid:{type:Number,default:0}},data:function(){return{answerArr:[]}},mounted:function(){this.updateAnswer()},methods:{updateAnswer:function(){var t=[];this.item.useranswer&&this.item.useranswer.length?this.item.useranswer.map(function(n){t.push({options:n})}):t=this.item.tkinfo.answer,this.answerArr=t},submitAnswer:function(){this.item.tkinfo.answer=this.answerArr,this.$emit("callback",this.item,this.isCombinationQuestion,this.parenttkid,this.index)}}};n.default=i},f3a9:function(t,n,e){"use strict";e.r(n);var i=e("c42a"),r=e.n(i);for(var a in i)"default"!==a&&function(t){e.d(n,t,function(){return i[t]})}(a);n["default"]=r.a}}]);
;(global["webpackJsonp"] = global["webpackJsonp"] || []).push([
    'components/ks-components/fill-blanks/fill-blanks-create-component',
    {
        'components/ks-components/fill-blanks/fill-blanks-create-component':(function(module, exports, __webpack_require__){
            __webpack_require__('6e42')['createComponent'](__webpack_require__("52a8"))
        })
    },
    [['components/ks-components/fill-blanks/fill-blanks-create-component']]
]);
