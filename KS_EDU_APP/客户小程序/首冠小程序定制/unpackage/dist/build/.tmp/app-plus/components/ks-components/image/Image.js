(global["webpackJsonp"]=global["webpackJsonp"]||[]).push([["components/ks-components/image/Image"],{"32e8":function(t,e,n){"use strict";n.r(e);var a=n("3c00"),c=n("5017");for(var r in c)"default"!==r&&function(t){n.d(e,t,function(){return c[t]})}(r);n("bc0c");var i=n("2877"),u=Object(i["a"])(c["default"],a["a"],a["b"],!1,null,"10ad9c8d",null);e["default"]=u.exports},"3c00":function(t,e,n){"use strict";var a=function(){var t=this,e=t.$createElement;t._self._c},c=[];n.d(e,"a",function(){return a}),n.d(e,"b",function(){return c})},5017:function(t,e,n){"use strict";n.r(e);var a=n("e946"),c=n.n(a);for(var r in a)"default"!==r&&function(t){n.d(e,t,function(){return a[t]})}(r);e["default"]=c.a},"98ec":function(t,e,n){},bc0c:function(t,e,n){"use strict";var a=n("98ec"),c=n.n(a);c.a},e946:function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var a={name:"ks-image",props:{radius:{type:String,default:"0"},src:String,type:String,aspect:{type:String,default:"aspectFill"},hover:String},data:function(){var t="/static/common/default-img.png";switch(this.type){case"user":t="/static/common/default-avatar.png";break;case"logo":t="/static/common/shouguan.png?2.0";break;case"teacher":t="/static/common/default-teacher.png";break}return{imgSrc:this.src,defaultImg:t}},methods:{onerror:function(){this.imgSrc=this.defaultImg}},watch:{src:function(t){this.imgSrc=t}}};e.default=a}}]);
;(global["webpackJsonp"] = global["webpackJsonp"] || []).push([
    'components/ks-components/image/Image-create-component',
    {
        'components/ks-components/image/Image-create-component':(function(module, exports, __webpack_require__){
            __webpack_require__('6e42')['createComponent'](__webpack_require__("32e8"))
        })
    },
    [['components/ks-components/image/Image-create-component']]
]);                
