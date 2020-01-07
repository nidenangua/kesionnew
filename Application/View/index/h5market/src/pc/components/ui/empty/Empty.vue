<template>
    <div class="ks-empty" :class="'ks-empty--'+(type || 'default')">
          {{msg}}
          <slot />
      </div>
</template>
<script>
export default {
    name:'KsEmpty',
    props:['msg','type']
}
</script>
<style scoped>
.ks-empty{
  text-align: center;
  color: #b5b5b5;
  background-repeat: no-repeat;
  background-size: auto 140px;
  background-position: 50% 40px;
  padding:170px 0 30px 0;
  font-size: 14px

}
.ks-empty--default{
  background-image: url(./empty.png)
}

</style>

