(global["webpackJsonp"]=global["webpackJsonp"]||[]).push([["components/ks-components/fill-blanks/fill-blanks"],{"4a0b":function(t,e,n){"use strict";n.r(e);var i=n("e3d0"),r=n("e12e");for(var s in r)"default"!==s&&function(t){n.d(e,t,function(){return r[t]})}(s);n("6c02");var u=n("2877"),a=Object(u["a"])(r["default"],i["a"],i["b"],!1,null,"58aad216",null);e["default"]=a.exports},5041:function(t,e,n){},"6c02":function(t,e,n){"use strict";var i=n("5041"),r=n.n(i);r.a},"9ecc":function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var i={props:{isCombinationQuestion:{type:Boolean,default:!1},index:Number,item:{type:Object,default:function(){return{}}},parenttkid:{type:Number,default:0}},data:function(){return{answerArr:[]}},mounted:function(){this.updateAnswer()},methods:{updateAnswer:function(){var t=[];this.item.useranswer&&this.item.useranswer.length?this.item.useranswer.map(function(e){t.push({options:e})}):t=this.item.tkinfo.answer,this.answerArr=t},submitAnswer:function(){this.item.tkinfo.answer=this.answerArr,this.$emit("callback",this.item,this.isCombinationQuestion,this.parenttkid,this.index)}}};e.default=i},e12e:function(t,e,n){"use strict";n.r(e);var i=n("9ecc"),r=n.n(i);for(var s in i)"default"!==s&&function(t){n.d(e,t,function(){return i[t]})}(s);e["default"]=r.a},e3d0:function(t,e,n){"use strict";var i=function(){var t=this,e=t.$createElement;t._self._c},r=[];n.d(e,"a",function(){return i}),n.d(e,"b",function(){return r})}}]);
;(global["webpackJsonp"] = global["webpackJsonp"] || []).push([
    'components/ks-components/fill-blanks/fill-blanks-create-component',
    {
        'components/ks-components/fill-blanks/fill-blanks-create-component':(function(module, exports, __webpack_require__){
            __webpack_require__('6e42')['createComponent'](__webpack_require__("4a0b"))
        })
    },
    [['components/ks-components/fill-blanks/fill-blanks-create-component']]
]);                
