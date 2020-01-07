(function(){

    /**
     * 按钮
     */
    Vue.component('KtjButton',{
        template:'<div class="ktj-button" ref="ktjButton" :style="getStyle()" :class="buttonClass" @click="click"><i class="ktj-icon" :class="icon" v-if="icon"></i><slot /></div>',
        props:[
            'type',
            'size',
            'icon',
            'width',
            'height',
            'disabled'
        ],
        data:function(){
            return {
                buttonClass:''
            }
        },
        methods:{
            /**
             * 获取按钮样式名
             */
            getClass:function(){
                var buttonClass = [];
                if(this.size){
                    buttonClass.push('ktj-button-'+this.size)
                }
                if(this.type){
                    buttonClass.push('ktj-button-'+this.type)
                }
                if(this.disabled){
                    buttonClass.push('ktj-button-disabled')
                }
                if(this.$refs.ktjButton.getAttribute('round') !== null){
                    buttonClass.push('ktj-button-round')
                }
                if(this.$refs.ktjButton.getAttribute('line') !== null){
                    buttonClass.push('ktj-button-line')
                }
                
                this.buttonClass = buttonClass.join(' ')
            },
            /**
             * 获取额外样式
             */
            getStyle:function(){
                var style = {};
                if(this.width){
                    style.width = this.width
                }
                if(this.height){
                    style.height = this.height
                }
                return style
            },
            /**
             * 点击回调
             */
            click:function(){
                if(!this.disabled){
                    this.$emit('click')
                }
            },

        },
        mounted:function(){
            this.getClass()
        }
    })

    /**
     * 创建图片容器
     */
    Vue.component('KtjCreateBg',{
        template:'<div class="ktj-create-bg" :class="type && \'ktj-create-bg-\'+type" :style="style" @click="click" ref="ktjCreateBg"><div class="ktj-create-bg__image" :style="{backgroundImage:\'url(\'+src+\')\'}"><slot /></div></div>',
        props:[
            'src',
            'type',
            'ratio',
            'borderRadius'
        ],
        data(){
            return {
                style:{}
            }
        },
        methods:{
            /**
             * 添加事件
             */
            click(){
                this.$emit('click')
            }
        },
        mounted(){
            var style = {}
            if(this.ratio){
                var width = this.$refs.ktjCreateBg.offsetWidth
                style.height = width*this.ratio+'px'
            }
            if(this.borderRadius){
                style.borderRadius = this.borderRadius
            }
            this.style = style
            var _this = this
            window.addEventListener('resize',function(){
                var width = _this.$refs.ktjCreateBg.offsetWidth
                _this.style.height = width*_this.ratio+'px'
            })
        }
    })

    /**
     * 提示框组件
     */
    var toastConstructor = Vue.extend({
        template:'<div v-if="show"><div class="ktj-toast__mask"></div><div class="ktj-toast"><i class="ktj-toast__icon ktj-toast__icon__loading" v-if="type === \'loading\'"></i><i class="ktj-toast__icon ktj-toast__icon__success" v-else-if="type === \'success\'"></i><i class="ktj-toast__icon ktj-toast__icon__error" v-else-if="type === \'error\'"></i><i class="ktj-toast__icon ktj-toast__icon__tips" v-else></i><p class="ktj-toast__content" :class="msg && msg.length > 7 && \'ktj-toast__content_size\'">{{msg}}</p></div></div>',
        data:function(){
            return {
                duration:0,
                show:false,
                msg:'',
                type:null
            }
        }
    })
    var toastInstance = new toastConstructor()
    toastInstance.$mount(document.createElement('div'))
    document.body.appendChild(toastInstance.$el)
    
    /**
     * 显示信息提示框
     * @param {String} msg 
     * @param {String} type 
     * @param {Number} duration 
     */

    Vue.prototype.$toast = function(msg, type, duration){
        return new Promise(function(resolve){
            var _type = type || 'tips'
            var _duration = duration || 1500
            toastInstance.duration = _duration
            toastInstance.msg = msg
            toastInstance.show = true
            toastInstance.type = _type
            setTimeout(function(){
                toastInstance.duration = 0
                toastInstance.show = false
                resolve()
            }, duration)
        })
    }

    /**
     * 打开加载状态
     * @param {String} msg 
     */
    Vue.prototype.$showLoading = function(msg){
        var _msg = msg || '加载中'
        toastInstance.duration = 0
        toastInstance.msg = _msg
        toastInstance.show = true
        toastInstance.type = 'loading'
    }
    /**
     * 关闭加载状态
     */
    Vue.prototype.$hideLoading = function(){
        if(toastInstance.duration === 0){
            toastInstance.show = false
        }
    }
    
})()