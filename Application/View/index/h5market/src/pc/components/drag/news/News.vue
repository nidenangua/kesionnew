<template>
  <div class="kd-news">
    <div class="kd-news__image">
      <el-row :gutter="26">
        <el-col :span="8" v-for="(item,i) in top3" :key="i">
          <ks-image :src="item.defaultpic" @click="open(item)">
            <div class="kd-news__position" @click="open(item)">
              <div class="kd-news__position-item">
                <h3>{{item.title}}</h3>
                <span>{{item.adddate}}</span>
                <p>{{item.abstract}}</p>
              </div>
              <span class="kd-news__position-hx"></span>
            </div>
            <div class="kd-news__title">{{item.title}}</div>
          </ks-image>
        </el-col>
      </el-row>
    </div>
    <!-- 新闻 -->
    <div class="kd-news__news">
      <el-row :gutter="26">
        <el-col :span="12" v-for="(item,i) in dataAbove3" :key="i">
          <div class="kd-news__content" @click="open(item)">
            <h3>{{item.title}}</h3>
            <span>{{item.adddate}}</span>
            <p>{{item.abstract}}</p>
          </div>
          <ks-image :src="item.defaultpic" @click="open(item)" />
        </el-col>
      </el-row>
    </div>
  </div>
</template>

<script>
export default {
  name: "KdNews",
  props: {
    dataList: {
      type: Array,
      default() {
        return [];
      }
    }
  },
  data() {
    return {
      /**前3条数据 */
      top3: [],
      /**大于3的数据 */
      dataAbove3: []
    };
  },
  watch: {
    dataList: {
      handler(list) {
        let _top3 = [];
        let _dataAbove3 = [];
            if (list.length) {
              list.map((item, i) => {
                if (i < 3) {
                  _top3.push(item);
                } else if (i >= 3 && i < 5) {
                  _dataAbove3.push(item)
                }
              });
        }
        this.top3 = _top3;
        this.dataAbove3 = _dataAbove3;
      },
      immediate: true
    }
  },
  methods: {
    open(item) {
      this.$router.push({
        name: "NewsDetail",
        params: {
          id: item.id
        }
      });
    }
  }
};
</script>

<style scoped>
.kd-news {
  width: 1160px;
  padding: 10px 20px 20px 20px;
  background: #fff;
  margin: 0 auto;
  overflow: hidden;
}
.kd-news__image {
  width: 100%;
  height: 210px;
  padding-bottom: 16px;
  border-bottom: 1px solid #eeeeee;
  text-align: center;
}
.kd-news__title{
  position: absolute;
  z-index: 9;
  left: 0;
  bottom: 0;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
  padding: 0 20px;
  font-size: 15px;
  color: #fff;
  width: 100%;
  padding-top: 20px;
  height: 60px;
  line-height: 35px;
  background: -webkit-gradient(linear, left top, left bottom, from(transparent), to(rgba(0, 0, 0, 0.6)));
  background: linear-gradient(180deg, transparent, rgba(0, 0, 0, 0.6));
}
.kd-news__image .el-col {
  height: 210px;
  position: relative;
  overflow: hidden;
}
.kd-news__position {
  width:100%;
  padding: 20px;
  box-sizing: border-box;
  overflow: hidden;
}
.kd-news__image .el-col:hover .kd-news__title{
  display: none;
}
.kd-news__image .el-col:hover .kd-news__position {
  position: absolute;
  top: 0px;
  color: #fff;
  transition: all 0.4s;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  cursor: pointer;
}
.kd-news__position-hx {
  display: inline-block;
  height: 3px;
  width: 25px;
  background: #fff;
  margin-top: 5px;
}
.kd-news__position-item p {
  font-size: 12px;
  line-height: 22px;
  height: 66px;
  text-align: left;
  text-overflow: -o-ellipsis-lastline;
  overflow: hidden;
  text-overflow: ellipsis;
  display: -webkit-box;
  -webkit-line-clamp: 3;
  line-clamp: 3;
  margin-top: 20px;
  -webkit-box-orient: vertical;
}
.kd-news__position-item h3 {
  font-size: 16px;
  line-height: 24px;
  height: 24px;
  overflow: hidden;
  text-align: center;
  white-space: nowrap;
  text-overflow: ellipsis;
}
.kd-news__position-item span {
  display: block;
  font-size: 12px;
  margin: 10px 0;
}
.ks-image {
  width: 100%;
  height: 100%;
}
/* 新闻 */
.kd-news__news {
  width: 100%;
  cursor: pointer;
  overflow: hidden;
}
.kd-news__news .el-col {
  margin-top: 20px;
}
.kd-news__content {
  height: 120px;
  float: left;
  position: relative;
  overflow: hidden;
  width: calc(100% - 220px);
}

.kd-news__content h3 {
  font-size: 16px;
  color: #333;
  margin-bottom: 10px;
  height: 26px;
  line-height: 26px;
  overflow: hidden;
  display: block;
}
.kd-news__content span {
  color: #ccc;
  font-size: 14px;
}
.kd-news__content p {
  color: #666;
  font-size: 14px;
  margin-top: 10px;
  line-height: 24px;
  max-height: 48px;
  width: 300px;
  text-overflow: -o-ellipsis-lastline;
  overflow: hidden;
  text-overflow: ellipsis;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  line-clamp: 2;
  -webkit-box-orient: vertical;
}
.kd-news__news .ks-image {
  height: 120px;
  width: 200px;
  float: right;
}
</style>
