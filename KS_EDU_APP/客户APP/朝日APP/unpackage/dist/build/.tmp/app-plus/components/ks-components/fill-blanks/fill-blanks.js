(global["webpackJsonp"]=global["webpackJsonp"]||[]).push([["components/ks-components/fill-blanks/fill-blanks"],{"18f8":function(t,n,e){},"203f":function(t,n,e){"use strict";e.r(n);var i=e("c551"),r=e.n(i);for(var s in i)"default"!==s&&function(t){e.d(n,t,function(){return i[t]})}(s);n["default"]=r.a},"4e03":function(t,n,e){"use strict";var i=e("18f8"),r=e.n(i);r.a},5613:function(t,n,e){"use strict";var i=function(){var t=this,n=t.$createElement;t._self._c},r=[];e.d(n,"a",function(){return i}),e.d(n,"b",function(){return r})},a50f:function(t,n,e){"use strict";e.r(n);var i=e("5613"),r=e("203f");for(var s in r)"default"!==s&&function(t){e.d(n,t,function(){return r[t]})}(s);e("4e03");var u=e("2877"),a=Object(u["a"])(r["default"],i["a"],i["b"],!1,null,"023cc77c",null);n["default"]=a.exports},c551:function(t,n,e){"use strict";Object.defineProperty(n,"__esModule",{value:!0}),n.default=void 0;var i={props:{isCombinationQuestion:{type:Boolean,default:!1},index:Number,item:{type:Object,default:function(){return{}}},parenttkid:{type:Number,default:0}},data:function(){return{answerArr:[]}},mounted:function(){this.updateAnswer()},methods:{updateAnswer:function(){var t=[];this.item.useranswer&&this.item.useranswer.length?this.item.useranswer.map(function(n){t.push({options:n})}):t=this.item.tkinfo.answer,this.answerArr=t},submitAnswer:function(){this.item.tkinfo.answer=this.answerArr,this.$emit("callback",this.item,this.isCombinationQuestion,this.parenttkid,this.index)}}};n.default=i}}]);
;(global["webpackJsonp"] = global["webpackJsonp"] || []).push([
    'components/ks-components/fill-blanks/fill-blanks-create-component',
    {
        'components/ks-components/fill-blanks/fill-blanks-create-component':(function(module, exports, __webpack_require__){
            __webpack_require__('6e42')['createComponent'](__webpack_require__("a50f"))
        })
    },
    [['components/ks-components/fill-blanks/fill-blanks-create-component']]
]);
