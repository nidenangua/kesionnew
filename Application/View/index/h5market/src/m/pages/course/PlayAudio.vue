<template>
    <div class="play-audio" :style="{height:height+'px'}">
        <div class="play-audio__bg" :style="{backgroundImage:'url('+cover+')'}">
        </div>
        <div class="play-audio__body">
            <div class="play-audio__cover">
                <img :src="cover" />
            </div>
            <div class="play-audio__title">
                诱饵效应 | 你买过套餐以外的汉堡吗？
            </div>
        </div>
        
    </div>
</template>
<script>
export default {
    name:'PlayAudio',
    data(){
        return {
            cover:'https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1572081960779&di=dd576be4463ee1237b3c27fc1b89ef5c&imgtype=0&src=http%3A%2F%2Fimg1.doubanio.com%2Fview%2Fnote%2Flarge%2Fpublic%2Fp31711827.jpg',
            height:window.innerHeight
        }
    }
}
</script>
<style scoped>
.play-audio{
    position: relative;
    width: 100%;
}
.play-audio::after{
    content: '';
    width: 100%;
    height: 100%;
    z-index: 1;
    background: rgba(0,0,0,0.3);
    left:0;
    top: 0;
    position: absolute;
}
.play-audio__bg{
    width: 100%;
    height: 100%;
    position: absolute;
    left: 0;
    top: 0;
    filter: blur(100px);
    background-repeat: no-repeat;
    background-size: cover;
}
.play-audio__body{
    position: relative;
    z-index: 10;
}
.play-audio__cover{
    width: 10rem;
    height: 10rem;
    border-radius: 50%;
    overflow: hidden;
    margin: 0 auto;
    object-fit: cover;
}
.play-audio__cover img{
    width: 100%;
    height: 100%;
}
</style>