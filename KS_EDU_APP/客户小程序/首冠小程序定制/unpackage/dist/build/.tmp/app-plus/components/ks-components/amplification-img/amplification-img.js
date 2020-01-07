(global["webpackJsonp"]=global["webpackJsonp"]||[]).push([["components/ks-components/amplification-img/amplification-img"],{"17d5":function(t,n,i){"use strict";var e=function(){var t=this,n=t.$createElement;t._self._c},o=[];i.d(n,"a",function(){return e}),i.d(n,"b",function(){return o})},"75f8":function(t,n,i){"use strict";i.r(n);var e=i("17d5"),o=i("e8b3");for(var r in o)"default"!==r&&function(t){i.d(n,t,function(){return o[t]})}(r);i("b19b");var s=i("2877"),c=Object(s["a"])(o["default"],e["a"],e["b"],!1,null,"1621f6dc",null);n["default"]=c.exports},b19b:function(t,n,i){"use strict";var e=i("e13c"),o=i.n(e);o.a},dca1:function(t,n,i){"use strict";Object.defineProperty(n,"__esModule",{value:!0}),n.default=void 0;var e=function(){return i.e("components/ks-components/image/Image").then(i.bind(null,"32e8"))},o={name:"KsAmplification",props:{src:String,index:0,imgArr:Array},data:function(){return{indicatorDots:!1,autoplay:!1,interval:2e3,duration:500,curr:this.index,isShow:!1}},components:{KsImage:e},methods:{isShowImg:function(){this.isShow=!0,this.$emit("isShowStatus",this.isShow)},close:function(){this.isShow=!1,this.curr=this.index,this.$emit("isShowStatus",this.isShow)},setIndex:function(t){this.curr=t.detail.current}},watch:{index:function(){this.curr=this.index}}};n.default=o},e13c:function(t,n,i){},e8b3:function(t,n,i){"use strict";i.r(n);var e=i("dca1"),o=i.n(e);for(var r in e)"default"!==r&&function(t){i.d(n,t,function(){return e[t]})}(r);n["default"]=o.a}}]);
;(global["webpackJsonp"] = global["webpackJsonp"] || []).push([
    'components/ks-components/amplification-img/amplification-img-create-component',
    {
        'components/ks-components/amplification-img/amplification-img-create-component':(function(module, exports, __webpack_require__){
            __webpack_require__('6e42')['createComponent'](__webpack_require__("75f8"))
        })
    },
    [['components/ks-components/amplification-img/amplification-img-create-component']]
]);                
