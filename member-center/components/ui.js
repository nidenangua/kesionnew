/**科汛图片组件 */
Vue.component('KsImage', {
        props: {
            /**图片地址 */
            src: String,
            /**图片类型 defailt | user | logo */
            type: String,
            /*图片如何适应到容器框*/
            fit: {
                type: String,
                default: "cover"
            }
        },
        data: function() {
            var _defaultImg = "/ks_inc/member-center/images/default/default-img.png";
            switch (this.type) {
                case "user":
                    _defaultImg = "/ks_inc/member-center/images/default/default-avatar.jpg";
                    break;
                case "logo":
                    _defaultImg = "/ks_inc/member-center/images/default/default-logo.png";
                    break;
                case "exam":
                    _defaultImg = "/ks_inc/member-center/images/default/testpsck_bg.png";
                    break;
            }
            return {
                imgSrc: this.src,
                defaultImg: _defaultImg
            }
        },
        methods: {
            /**
             * 处理图片加载出错
             */
            onerror: function() {
      
                this.imgSrc = this.defaultImg;
               
            }
        },
        watch: {
            src: function(_imgSrc) {
            
                this.imgSrc = _imgSrc;
            }
        },
        template: '<div class="ks-image"  @click="$emit(\'click\',$event)">'+
    '<img style="width: 100%; height: 100%;" :src="imgSrc" @error="onerror" :style="{objectFit:fit}" />'+
    '<slot />'+
  '</div>'
    })
    /**个人中心标题组件 */
Vue.component('KsTitle', {
    props: {
        /**标题 */
        title: String,
        /**下划线开关 */
        underline: {
            default: true,
            type: Boolean,
        }
    },
    data: function() {

        return {

        }

    },
    template: '<div class="ks-title" :class="{underline:underline==true}">{{title}}</div>',

})


/**考试学习图表组件 */
Vue.component('echarts', {
    props: {
        width:{
            type: Number,
        },
        height: {
            type: Number,
        },
        dataList: {
            type:Array,
            default: function() {
                return []
            }
        },
        title: String,
        titleColor: String,
        grid: {
            type: Object,
            default: function() {
                return {
                    top: '12%',
                    bottom: '12%',
                    left: '6%',
                    right: '4%'
                }
            }
        },
        axisLine: {
            type: Boolean,
            default: true
        },
        areaStyle: {
            type: Object,
            default: function() {
                return {
                    color: 'rgb(255,255,255)'
                }
            }
        },
        smooth: {
            type: Boolean,
            default: true
        },
        itemType: {
            type: String,
            default: '1'
        }
    },
    data: function() {
        return {
            canvas:'',
            echarts: {
                title: {
                    text: this.title,
                    textStyle: {
                        fontSize: 16,
                        color: this.titleColor,
                        fontWeight: 400
                    }
                },
                backgroundColor: '#FFF',
                grid: {
                    top: this.grid.top,
                    bottom: this.grid.bottom,
                    left: this.grid.left,
                    right: this.grid.right
                },
                tooltip: {
                    trigger: 'axis',
                    label: {
                        show: true
                    }
                },
                xAxis: {
                    boundaryGap: true, //默认，坐标轴留白策略
                    axisLine: {
                        show: this.axisLine
                    },
                    splitLine: {
                        show: false
                    },
                    axisTick: {
                        show: false,
                        alignWithLabel: true
                    },
                    data: [
                        '还没有学习记录'
                    ]
                },
                yAxis: {
                    axisLine: {
                        show: this.axisLine
                    },
                    splitLine: {
                        show: true,
                        lineStyle: {
                            type: 'dashed',
                            color: 'rgba(210,225,251,1)'
                        }
                    },
                    axisTick: {
                        show: false
                    },
                    splitArea: {
                        show: true,
                        areaStyle: {
                            color: this.areaStyle.color
                        }
                    }
                },
                series: {
                    type: 'line',
                    symbol: 'circle',
                    smooth: this.smooth,
                    symbolSize: 7,
                    lineStyle: {
                        color: 'rgb(60,129,249)',
                        shadowBlur: 12,
                        shadowColor: 'rgb(60,129,249,0.9)',
                        shadowOffsetX: 1,
                        shadowOffsetY: 1
                    },
                    itemStyle: {
                        color: 'rgb(60,129,249)',
                        borderWidth: 1,
                        borderColor: '#FFF'
                    },
                    label: {
                        show: false,
                        distance: 1,
                        emphasis: {
                            show: true,
                            offset: [25, -2],
                            //borderWidth:1,
                            // borderColor:'rgb(60,129,249)',
                            //formatter:'{bg|{b}\n数据量:{c}}',
                            backgroundColor: 'rgb(60,129,249)',
                            color: '#FFF',
                            padding: [10, 10, 10, 10],
                            //width:60,
                            // height: 30,
                            formatter: function(params) {
                                var name = params.name;
                                var value = params.data;
                                if(Math.floor(value/60) == 0){
                                    if (this.itemType === '1') {
                                    
                                        var str = '学习时间：'  + value%60+'分钟'
                                    } else {
                                        var str = name + '\n学习时间：' + value%60+'分钟'
                                    }
                                }else{
                                    if (this.itemType === '1') {
                                    
                                        var str = '学习时间：' + Math.floor(value/60)+'小时' + value%60+'分钟'
                                    } else {
                                        var str = name + '\n学习时间：' + Math.floor(value/60)+'小时' + value%60+'分钟'
                                    }
                                }
                                
                                return str;
                            },
                            rich: {
                                bg: {
                                    backgroundColor: {
                                        image: ''
                                    },
                                    width: 78,
                                    //height:42,
                                    color: '#FFF',
                                    padding: [20, 0, 20, 10]
                                },
                                br: {
                                    width: '100%',
                                    height: '100%'
                                }

                            }
                        }
                    },
                    data: [
                        0
                    ]
                }
            },

        }
    },
    watch: {
        'dataList': function(list) {
            var that = this
            if(typeof echarts === 'object'){
                that.ready(list)
            }else{
                var script = document.createElement('script');
                script.src = '/ks_inc/member-center/js/echart/echarts.min.js';
                script.onload = function(){
                    that.ready(list)
                }
                document.body.appendChild(script)
                
            }
            
        }
    },
    methods: {
        
        ready:function(list) {
            this.echarts.xAxis.data = []
            this.echarts.series.data = []
            var datax = []
            var datay = []
                if (list.length > 0) {
                    for (var i = 0; i < list.length; i++) {
                        datax.push(list[i].date)
                    }
                    for (var n = 0; n < list.length; n++) {
                        datay.push(list[n].time)
                    }
                    this.echarts.xAxis.data = datax
                    this.echarts.series.data = datay
                }else {
                    this.echarts.xAxis.data = ['还没有学习记录']
                    this.echarts.series.data = [0]
                }
                var that = this
                this.$nextTick(function(){
                   
                    var myChart = echarts.init(that.$refs.mainChart);
                    // 绘制图表
                    myChart.setOption(
                        that.echarts, true
                    )
                })  
                
        }, 
    },
    mounted: function(){
       
    },    
    template: '<div class="echarts" ref="mainChart"></div>'

})


/**个人中心标题组件 */
Vue.component('ExamSort', {
    props: {
        sort: Boolean
    },
    data: function() {
        return {
            /**窗口开关 */
            visible: true,
        }
    },
    methods: {
        getExam: function(isrand) {
            this.$emit('openExam', isrand)
        },
        handleClose: function() {
            this.$emit('close')
            this.visible = true
        }
    },
    mounted: function() {

    },
    template: '<el-dialog title="选择做题模式" visible="visible" :before-close="handleClose" width="750px">'+
        '<div class="exam-sort">'+
            '<div class="exam-sort__box1" @click="getExam(0)">'+
                '<div class="exam-sort__box1-img"></div>'+
                '<p>顺序练习</p>'+
            '</div>'+
            '<div class="exam-sort__box2" @click="getExam(1)">'+
                '<div class="exam-sort__box2-img"></div>'+
                '<p>随机练习</p>'+
            '</div>'+
        '</div>'+
'</el-dialog>',

})

/**无内容提示组件 */
Vue.component('KsEmpty', {
    props: {
        msg: String,
        type: String
    },
    data: function() {
        return {

        }
    },

    template: '<div class="ks-empty" :class="\'ks-empty--\'+(type || \'default\')">'+
    '{{msg}}'+
    '<slot />'+
'</div>',

})
var editorIndex = 0;
var editorJsLoaded = false;
/**富文本组件 */
Vue.component('KsEditor', {
    props: {
        /**标题 */
        title: String,
        /**编辑器内容 */
        content: String,
        /**编辑器高度 */
        height: {
            type: Number,
            default: 100
        },
        /**字数限制 */
        maximumWords: {
            type: Number,
            default: 10000
        },
        /**是否开启字数统计 */
        wordCount: {
            type: Boolean,
            default: false
        },
        /**编辑器浮层高度 */
        zIndex: {
            type: Number,
            default: 9999
        }
    },
    model: {
        prop: "content",
        event: "change"
    },
    data: function() {
        editorIndex++;
        return {
            id: editorIndex
        };
    },
    mounted: function() {
        this.createEditor(this.id);
    },
    methods: {
        /**
         * 创建编辑器
         */
        createEditor: function(id) {
            var that = this
            this.editor = UE.getEditor('KsEditor' + id, {
                initialFrameWidth: "100%",
                initialFrameHeight: this.height,
                maximumWords: this.maximumWords,
                wordCount: this.wordCount,
                zIndex: this.zIndex,
                toolbars: [
                    [
                        "fullscreen",
                        "myinsertimage",
                        "|",
                        // "fontsize",
                        // "forecolor",
                        "bold",
                        "italic",
                        "underline",
                        "strikethrough",
                        "|",
                        "superscript",
                        "subscript",
                        "removeformat"
                    ]
                ]
            });
            /**修改图片点击操作 */
            this.editor.commands["myinsertimage"] = {
                execCommand: function() {
                    that.$uploadImages(function(res) {
                        that.editor.setContent('<img src="${res.defaultpic}" />', true);
                        var _content = that.editor.getContent();
                        that.$emit("change", _content);
                    });
                }
            };
            this.editor.addListener("ready", function(e) {
                that.editor.setContent(that.content);
                that.editor.addListener("blur", function(e) {
                    var _content = that.editor.getContent();
                    that.$emit("change", _content);
                });
            });
        }
    },
    watch: {
        content: function(_content) {
            this.editor.setContent(_content);
        }
    },

    template: '<div class="ks-editor"><div :id="\'KsEditor\'+id"></div></div>',

})

/**支付组件 */
Vue.component('KsPay', {
    props: {
        msg: String,
        type: String,
        data: {
            type: Object,
            default: {}
        }
    },
    data: function() {
        return {
            userInfo: {},
            state: {},
            visible: true,
            activePay: -1,
            payId: 0,
            /**选择器选项 */
            options: [{
                value: '选项1',
                label: '全部'
            }, {
                value: '选项2',
                label: '按学习时间'
            }, {
                value: '选项3',
                label: '按更新时间'
            }],
            /**选择器默认值 */
            value: '全部',
            exchange: false,
        }
    },
    methods: {
        /**选择支付类型 */
        payType: function(i) {
            this.activePay = i
            if (i == -1) {
                this.payId = 0
            } else {
                console.log(this.paymentList)
                this.payId = this.paymentList[i].payid
            }
        },
        /**支付 */
        pay: function() {
            this.$emit('pay', this.payId)

        },
    },
    mounted: function() {
        var that = this
        that.$store.ready(function(state) {
            that.userInfo = state.userInfo
            that.state = state
        })
    },
    template: '<el-dialog title="支付订单" :visible.sync="visible" width="800px">'+
    '<div class="ks-pay">'+
        '<div class="ks-pay__row">'+
            '<el-row :gutter="20">'+
                '<el-col :span=\'4\' style="width:180px">'+
                    '<img style="width: 100%;height:100%" src="/ks_inc/member-center/images/account/rechargepsck_bg@2x.png" v-if="data.cardtype == 1" />'+
                    '<img style="width: 100%;height:100%" src="/ks_inc/member-center/images/account/marketpsck_bg@2x.png" v-else />'+
                '</el-col>'+
                '<el-col :span=\'18\'>'+
                    '<p style="color: #2F3133">'+
                        '{{data.title}}'+
                    '</p>'+
                    '<p style="font-size: 14px;color:#888888;" v-if="type==1">'+
                        '价格：<i style="font-size: 18px;color:#E91C35;font-style:normal">￥{{data.price}}</i>（原价:<i style="text-decoration:line-through;font-style:normal">{{data.price_market}}</i>）'+
                    '</p>'+
                    '<p style="font-size: 14px;color:#888888;" v-else-if="type==2">'+
                        '早鸟票：<i style="font-size: 18px;color:#E91C35;font-style:normal">￥{{data.price}}</i>（活动报名）'+
                    '</p>'+
                '</el-col>'+
            '</el-row>'+
            '<el-row :gutter="20" style="text-align: right;border-bottom: 1px solid #E6E9ED">'+
                '<el-col :span=\'8\' :offset="8">'+
                    '<div v-if="type==1">'+
                        '<p>金额：</p>'+
                        '<p>订单总额：</p>'+
                    '</div>'+
                    '<div v-else-if="type==2">'+
                        '<p>票务金额：</p>'+
                        '<p>预付保证金<i style="font-style: normal;color:#cccccc">（签到后可线下退）</i>：</p>'+
                        '<p>可用优惠券：</p>'+
                        '<p v-if="exchange">&nbsp;</p>'+
                        '<p>订单总额：</p>'+
                    '</div>'+
                '</el-col>'+
                '<el-col :span=\'5\'>'+
                    '<div v-if="type==1">'+
                        '<p>￥{{data.price}}</p>'+
                        '<p style="color: #E91C35;font-size:24px">￥{{data.price}}</p>'+
                    '</div>'+
                    '<div v-else-if="type==2">'+
                        '<p>￥{{data.price}}</p>'+
                        '<p>￥{{data.price}}</p>'+
                        '<el-select style="line-height: 40px" v-model="value" placeholder="选择优惠券" size="medium">'+
                            '<el-option v-for="item in options" :key="item.value" :label="item.label" :value="item.value">'+
                            '</el-option>'+
                        '</el-select>'+
                        '<el-input v-if="exchange" style="line-height: 40px" placeholder="输入券号" size="medium"></el-input>'+
                        '<p style="color: #E91C35;font-size:22px">￥{{data.price}}</p>'+
                    '</div>'+
                '</el-col>'+
                '<el-col :span=\'3\' v-if="type==2">'+
                    '<p style="margin-top: 80px;text-align: left;color: #3C81F9;cursor: pointer;" @click="exchange = exchange ? false : true">输入券号</p>'+
                    '<el-button style="margin-top: 2px;" type="primary" size="medium" v-if="exchange">使用</el-button>'+
                '</el-col>'+
            '</el-row>'+
        '</div>'+
        '<h1>选择支付方式：</h1>'+
        '<div class="ks-pay__list">'+
            '<div class="ks-pay__item" :class="{\'active-pay\':activePay == -1}" @click="payType(-1)">'+
                '<span>余额支付</span>'+
                '<i v-if="activePay == -1"></i>'+
            '</div>'+
            '<div></div>'+
            '<div class="ks-pay__item" v-for="(item,i) in data.payment_list" :key="i" :class="{\'active-pay\':activePay == i}" @click="payType(i)">'+
                '<img :src="item.logo" />'+
                '<i v-if="activePay == i"></i>'+
            '</div>'+
        '</div>'+
        '<div class="ks-used">可用余额￥{{userInfo.Money}}</div>'+
       
        '<div class="ks-pay__btn">'+
            '<el-button type="warning" @click="pay()">立即支付</el-button>'+
        '</div>'+
    '</div>'+
'</el-dialog>',

})