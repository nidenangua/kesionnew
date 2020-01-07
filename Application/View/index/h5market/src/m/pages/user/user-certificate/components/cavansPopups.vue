<template>
    <div>
        <van-overlay :show="flag" @click="flag = false">
            <div class="Canvas">
                <canvas ref="myCanvas" :width='canvasWidth' :height='canvasHeight' class="canvas-can"></canvas>
            </div>
            <div class="canImg">
                <img
                    v-if="canImg"
                    :src="canImg"
                    class="canImg-image"
                    :style="{width:canvasWidth / 4+'px',height:canvasHeight / 4 +'px'}"
                >
            </div>
            <div class="operation">
                <p>长按保存图片，发微信好友或微信群</p>
            </div>
        </van-overlay>
    </div>
</template>

<script>
import CanvasTool from '@/utils/canvas.tool.js'
export default {
    props:{
        info:Object,
    },
    data() {
        return {
            flag:false,
            /**画布宽度 */
            canvasWidth: window.innerWidth * 0.88 * 4,
            /**画布高度 */
            canvasHeight: (window.innerWidth * 0.88) / 0.66 * 4,
            canImg:''
        }
    },
    methods: {
        getcanvas() {
            this.$showLoading();
            let rnd = Math.ceil(Math.random() * 1e7)
            var c = this.$refs.myCanvas;
            var ctx = c.getContext("2d");
            let Obj = {
                ctx:ctx,
                width:this.canvasWidth,
                height:this.canvasHeight,
            }
            CanvasTool.init(Obj)
            CanvasTool.drawImage(this.info.cover + `?${rnd}`,{
                width:this.canvasWidth,
                height:this.canvasHeight ,
                containerWidth:this.canvasWidth * 0.8
            }).then(()=>{
                CanvasTool.drawImage(this.$store.state.userInfo.headimg + `?${rnd}`,{
                    x:this.canvasWidth * 0.406,
                    y:this.canvasHeight  * 0.262,
                    width:this.canvasWidth * 0.187,
                    height:this.canvasHeight  * 0.110,
                    radius:40
                }).then(()=>{
                    CanvasTool.drawImage(this.info.qrcode + `?${rnd}`,{
                        x:this.canvasWidth * 0.164,
                        y:this.canvasHeight  * 0.76,
                        width:this.canvasWidth * 0.233,
                        height:this.canvasHeight  * 0.137
                    }).then(()=>{
                        let fillStyle
                        fillStyle = this.info.cover == '/Public/app/images/certificate_bg2.png' ? 'white' :'black'
                        CanvasTool.fillText(this.info.title,{fontSize:18 * 4,padding:30,y:this.canvasHeight *0.235,fillStyle:fillStyle})
                        CanvasTool.fillText(this.$store.state.userInfo.nickname,{fontSize:16 * 4,padding:30,y:this.canvasHeight *0.425,fillStyle:fillStyle})
                        CanvasTool.fillText(`在${this.info.info_title}获得了${this.info.sumscore}分`,{fontSize:16 *4,padding:30,y:this.canvasHeight *0.471,fillStyle:fillStyle})
                        CanvasTool.fillText(this.info.json.comment,{fontSize:16 * 4,padding:30,y:this.canvasHeight *0.606,fillStyle:fillStyle})
                        CanvasTool.fillText('asdasdaasdas',{padding:30,x:this.canvasWidth * 0.44,y:this.canvasHeight *0.8,fillStyle:fillStyle,fontSize:14 * 4})
                        CanvasTool.fillText('长按保存二维码',{padding:30,x:this.canvasWidth * 0.44,y:this.canvasHeight *0.88,fillStyle:"#bdbdb0",fontSize:14 * 4})
                    }).then(()=>{
                        this.canImg = c.toDataURL("image/png");
                        this.flag = true
                        this.$hideLoading();
                    })
                })
            })
            
        },
    },
}
</script>

<style scoped>
.van-overlay{
    background-color:rgba(0,0,0,.5);
}
.canImg{
    margin-top: 45px
}
.operation{
    position: fixed;
    top: 600px;
    width: 100%;
    text-align: center;
    color: #fff;
    font-size: 14px
}
.canvas-can{
    transform: scale(0.5);
    position: fixed;
    left: 50%;
    max-width: 200%;
    transform:scale(0.5);
    transform: translateX(-50%);
    display: none;
}
.canImg-image{
    position: fixed;
    left: 50%;
    transform: translateX(-50%);
    max-width: 200%;
}
</style>
