(global["webpackJsonp"]=global["webpackJsonp"]||[]).push([["lib/polyv/components/chat-list/chat-list"],{"12b7":function(t,e,n){"use strict";var o=n("537a"),a=n.n(o);a.a},"24c6":function(t,e,n){"use strict";n.r(e);var o=n("f7b1"),a=n.n(o);for(var r in o)"default"!==r&&function(t){n.d(e,t,function(){return o[t]})}(r);e["default"]=a.a},"537a":function(t,e,n){},"617e":function(t,e,n){"use strict";n.r(e);var o=n("70df"),a=n("24c6");for(var r in a)"default"!==r&&function(t){n.d(e,t,function(){return a[t]})}(r);n("12b7");var u=n("2877"),c=Object(u["a"])(a["default"],o["a"],o["b"],!1,null,"3de043d7",null);e["default"]=c.exports},"70df":function(t,e,n){"use strict";var o=function(){var t=this,e=t.$createElement;t._self._c},a=[];n.d(e,"a",function(){return o}),n.d(e,"b",function(){return a})},f7b1:function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var o=function(){return Promise.all([n.e("common/vendor"),n.e("lib/polyv/components/chat-list/content-parser/content-parser")]).then(n.bind(null,"f354"))},a={components:{ContentParser:o},props:{chatList:{type:Array,default:[]},hasMore:{type:Boolean,default:!1},isOnlyHost:{type:Boolean,default:!1},skin:{type:String,default:"black"}},data:function(){return{baseUrl:this.$store.state.SRC+"/config/app"}},methods:{tapSeeMore:function(){this.$emit("seemore")}}};e.default=a}}]);
;(global["webpackJsonp"] = global["webpackJsonp"] || []).push([
    'lib/polyv/components/chat-list/chat-list-create-component',
    {
        'lib/polyv/components/chat-list/chat-list-create-component':(function(module, exports, __webpack_require__){
            __webpack_require__('6e42')['createComponent'](__webpack_require__("617e"))
        })
    },
    [['lib/polyv/components/chat-list/chat-list-create-component']]
]);
