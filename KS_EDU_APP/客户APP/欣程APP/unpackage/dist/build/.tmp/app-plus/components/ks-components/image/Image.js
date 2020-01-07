(global["webpackJsonp"]=global["webpackJsonp"]||[]).push([["components/ks-components/image/Image"],{"1a69":function(t,a,e){"use strict";e.r(a);var n=e("c9f7"),c=e.n(n);for(var r in n)"default"!==r&&function(t){e.d(a,t,function(){return n[t]})}(r);a["default"]=c.a},"696d":function(t,a,e){"use strict";var n=e("8ca7a"),c=e.n(n);c.a},"8ca7a":function(t,a,e){},ad4b:function(t,a,e){"use strict";var n=function(){var t=this,a=t.$createElement;t._self._c},c=[];e.d(a,"a",function(){return n}),e.d(a,"b",function(){return c})},c9f7:function(t,a,e){"use strict";Object.defineProperty(a,"__esModule",{value:!0}),a.default=void 0;var n={name:"ks-image",props:{radius:{type:String,default:"0"},src:String,type:String,aspect:{type:String,default:"aspectFill"},hover:String},data:function(){var t=this.$store.state.SRC+"/config/app",a=t+"/static/images/common/default-img.png";switch(this.type){case"user":a=t+"/static/images/common/default-avatar.png";break;case"logo":a=t+"/static/images/common/xinchen.png?1.0";break;case"teacher":a=t+"/static/images/common/default-teacher.png";break}return{imgSrc:this.src,defaultImg:a}},methods:{onerror:function(){this.imgSrc=this.defaultImg}},watch:{src:function(t){this.imgSrc=t}}};a.default=n},cc49:function(t,a,e){"use strict";e.r(a);var n=e("ad4b"),c=e("1a69");for(var r in c)"default"!==r&&function(t){e.d(a,t,function(){return c[t]})}(r);e("696d");var i=e("2877"),s=Object(i["a"])(c["default"],n["a"],n["b"],!1,null,"0be3d473",null);a["default"]=s.exports}}]);
;(global["webpackJsonp"] = global["webpackJsonp"] || []).push([
    'components/ks-components/image/Image-create-component',
    {
        'components/ks-components/image/Image-create-component':(function(module, exports, __webpack_require__){
            __webpack_require__('6e42')['createComponent'](__webpack_require__("cc49"))
        })
    },
    [['components/ks-components/image/Image-create-component']]
]);
