<template>
    <div class="ks-empty" :class="'ks-empty--'+(type || 'nogift')">
          {{msg}}
          <slot />
      </div>
</template>
<script>
export default {
    name:'KsEmpty',
    props:{
      msg:String,
      type:String
    }
}
</script>
<style scoped>
/*空数据*/
.ks-empty{
  text-align: center;
  color: var(--prompt-color);
  background-repeat: no-repeat;
  background-size: auto 140px;
  background-position: 50% 40px;
  padding:170px 0 30px 0;
  font-size: 14px

}
.ks-empty--nolesson{
  background-image: url(./assets/common_icon_nolesson.png)
}
.ks-empty--nogift{
  background-image: url(./assets/common_icon_nogift.png)
}
.ks-empty--nocoupon{
  background-image: url(./assets/common_icon_nocoupon.png)
}
.ks-empty--nomessage{
  background-image: url(./assets/common_icon_nomessage.png)
}
.ks-empty--noorder{
  background-image: url(./assets/common_icon_noorder.png)
}
.ks-empty--norecord{
  background-image: url(./assets/common_icon_norecord.png)
}
.ks-empty--nosubject{
  background-image: url(./assets/common_icon_nosubject.png)
}
.ks-empty--notest{
  background-image: url(./assets/common_icon_notest.png)
}
.ks-empty--noweb{
  background-image: url(./assets/common_icon_noweb.png)
}
.ks-empty--nocomment{
  background-image: url(./assets/common_icon_nocomment.png)
}
.ks-empty--extract{
  background-image: url(./assets/common_icon_nocertifi.png);
}
</style>

