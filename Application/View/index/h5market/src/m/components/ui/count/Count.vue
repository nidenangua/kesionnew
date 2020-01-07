<template>
  <div class="ks-count">{{count}}</div>
</template>
<script>
export default {
  name: "KsCount",
  props: {
    number: {
      type: Number,
      default: 0
    }
  },
  data() {
    return {
      count: 0
    };
  },
  created() {
    this.countIncreaseAnimate(this.count);
  },
  methods: {
    /**
     * 数字动画
     */
    countIncreaseAnimate(_count) {
      if (this.number > _count) {
        let fluctuation = Math.ceil((this.number - _count) / 10);
        let newCount = Math.min(this.count + fluctuation, this.number);
        if(newCount.toString() === 'NaN'){
            return false
        }
        this.count = newCount
      } else {
        let fluctuation = Math.ceil((_count - this.number) / 10);
        let newCount = Math.max(this.count - fluctuation, this.number);
        if(newCount.toString() === 'NaN'){
            return false
        }
        this.count = newCount
        
      }
      if (this.count !== this.number) {
        setTimeout(() => {
          this.countIncreaseAnimate(_count);
        }, 80);
      }
    }
  },
  watch: {
    number() {
      this.countIncreaseAnimate(this.count);
    }
  }
};
</script>

<style scoped>
</style>

