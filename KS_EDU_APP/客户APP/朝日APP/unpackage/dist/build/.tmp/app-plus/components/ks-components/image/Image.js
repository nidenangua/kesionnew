(global["webpackJsonp"]=global["webpackJsonp"]||[]).push([["components/ks-components/image/Image"],{1309:function(t,e,a){"use strict";var n=function(){var t=this,e=t.$createElement;t._self._c},c=[];a.d(e,"a",function(){return n}),a.d(e,"b",function(){return c})},"319f":function(t,e,a){"use strict";a.r(e);var n=a("1309"),c=a("9ca2");for(var r in c)"default"!==r&&function(t){a.d(e,t,function(){return c[t]})}(r);a("f0ca");var i=a("2877"),s=Object(i["a"])(c["default"],n["a"],n["b"],!1,null,"1176516b",null);e["default"]=s.exports},"5fbd":function(t,e,a){},"9ca2":function(t,e,a){"use strict";a.r(e);var n=a("9ce6"),c=a.n(n);for(var r in n)"default"!==r&&function(t){a.d(e,t,function(){return n[t]})}(r);e["default"]=c.a},"9ce6":function(t,e,a){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var n={name:"ks-image",props:{radius:{type:String,default:"0"},src:String,type:String,aspect:{type:String,default:"aspectFill"},hover:String},data:function(){var t=this.$store.state.SRC+"/config/app",e=t+"/static/images/common/default-img.png";switch(this.type){case"user":e=t+"/static/images/common/default-avatar.png";break;case"logo":e=t+"/static/images/common/zhaori.png?2.0";break;case"teacher":e=t+"/static/images/common/default-teacher.png";break}return{imgSrc:this.src,defaultImg:e}},methods:{onerror:function(){this.imgSrc=this.defaultImg}},watch:{src:function(t){this.imgSrc=t}}};e.default=n},f0ca:function(t,e,a){"use strict";var n=a("5fbd"),c=a.n(n);c.a}}]);
;(global["webpackJsonp"] = global["webpackJsonp"] || []).push([
    'components/ks-components/image/Image-create-component',
    {
        'components/ks-components/image/Image-create-component':(function(module, exports, __webpack_require__){
            __webpack_require__('6e42')['createComponent'](__webpack_require__("319f"))
        })
    },
    [['components/ks-components/image/Image-create-component']]
]);
