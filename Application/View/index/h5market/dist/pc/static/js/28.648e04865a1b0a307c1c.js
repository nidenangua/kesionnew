webpackJsonp([28],{cXWi:function(t,e,a){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var i=a("ZLEe"),n=a.n(i),s=a("0xDb"),l=a("Llv5"),o={name:"Index",data:function(){return{components:[]}},methods:{loadComponents:function(){var t=this;this.$showLoading(),this.$store.ready(function(e){var a=[],i=Object(s.a)(e.configjson);i.map(function(t){"header"===t.type&&(t.other=e.headjson.other,t.navList=e.headjson.navList,t.style=e.headjson.style),t.api&&a.push(t.api),t.api_list&&t.api_list.map(function(t){a.push(t.api)})}),Object(l.a)(a).then(function(e){var a=n()(e);i.map(function(t){t.api?a.map(function(a){t.api.callKeyName===a&&(t.list=e[a].list)}):t.api_list&&(t.list={},t.api_list.map(function(i){a.map(function(a){if(i.api.callKeyName===a){var n=Object(s.a)(i.related||{});if(n.list=e[a].list,t.list[i.belong])if(t.list[i.belong]instanceof Array)t.list[i.belong].push(n);else{var l=[t.list[i.belong]];l.push(n),t.list[i.belong]=l}else t.list[i.belong]=n}})}))}),t.components=i,t.$nextTick(function(){t.$hideLoading()})})})}},mounted:function(){"mphone"===window.name&&(window.APP=this),this.loadComponents()}},r={render:function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",[t._l(t.components,function(e,i){return a("div",{directives:[{name:"show",rawName:"v-show",value:!e.api||e.list&&e.list.length||t.$store.state.drag,expression:"!item.api || (item.list && item.list.length) || $store.state.drag"}],key:i,attrs:{drag:e.type,"drag-index":i}},[e.title?a("kd-title",{attrs:{"data-title":e.title}}):t._e(),t._v(" "),"header"===e.type?a("kd-header",{attrs:{"data-item":e}}):"swiper"==e.type?a("kd-banner",{style:{height:e.height},attrs:{"data-list":e.list,"banner-height":e.height}}):"navnew"==e.type?a("kd-navnew",{attrs:{"data-list":e.list}}):"navbanner"==e.type?a("kd-navbanner",{attrs:{"data-list":e.list}}):"synthesize"==e.type?a("kd-synthesize",{attrs:{"tabs-data":e.list.tabsData,ranking:e.list.ranking}}):"coupon"==e.type?a("kd-coupon"):"course"==e.type||"class"==e.type||"column"==e.type?a("kd-course",{attrs:{"data-style":e.style,"data-type":e.type,other:e.other,"data-list":e.list}}):"teacher"==e.type?a("kd-teacher",{attrs:{"data-list":e.list}}):"group"==e.type?a("kd-group",{attrs:{"data-list":e.list}}):"news"==e.type?a("kd-news",{attrs:{"data-list":e.list}}):"richtext"===e.type?a("kd-richtext",{attrs:{"data-code":e.code}}):t._e()],1)}),t._v(" "),a("kd-footer")],2)},staticRenderFns:[]},d=a("C7Lr")(o,r,!1,null,null,null);e.default=d.exports}});