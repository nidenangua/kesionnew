<template>
  <div class="online-students" :style="{height:height+'px'}">
    <div class="online-students__item" v-for="(item,index) in students" :key="index">
      <ks-image :src="item.avatar" class="online-students__avatar" type="user" />
      <span
        @click="banned(item.userid)"
        v-if="teacherid != item.userid && isTeacher"
        :class="getIsBanned(item.userid) && 'banned'"
      >{{getIsBanned(item.userid) ? '已禁言' : '禁言'}}</span>
      {{item.username}}
      <img
        src="@/assets/audio-live/teacher-icon.png"
        class="online-students__teacher-icon"
        title="老师"
        v-if="teacherid == item.userid"
      >
    </div>
  </div>
</template>
<script>
export default {
  /**在线学员列表 */
  name: "OnlineStudents",
  props: {
    /**容器高度 */
    height:Number,
    /**老师id */
    teacherid: [String, Number],
    /**学生列表数组 */
    students: {
      type: Array,
      default() {
        return [];
      }
    },
    /**当前用户是否是老师 */
    isTeacher:{
      type:Boolean,
      default:false
    },
    /**已禁言的学生列表 */
    bannedList:{
      type: Array,
      default() {
        return [];
      }
    }
  },
  methods: {
    /**
     * 设置禁言
     * @param {Number} 用户id
     * @param {Boolean} 禁言开关
     */
    banned(uid) {
      this.$emit("banned", uid);
    },
    /**
     * 判断当前用户是否为禁言状态
     * @param {Number} 用户id
     */
    getIsBanned(uid){
      let is = false;
      this.bannedList.map(userid=>{
        if(`${userid}` === `${uid}`){
          is = true
        }
      });
      return is;
    }
  }
};
</script>

<style scoped>
.online-students {
  padding: 10px;
  box-sizing: border-box;
  overflow-x:hidden;
  overflow-y:auto;
}
.online-students__item {
  padding: 10px 15px 10px 55px;
  position: relative;
  line-height: 32px;
  min-height: 32px;
  font-size: 14px;
}
.online-students__avatar {
  width: 32px;
  height: 32px;
  border-radius: 50%;
  overflow: hidden;
  position: absolute;
  left: 15px;
  top: 10px;
}
.online-students__avatar img {
  width: 100%;
  height: 100%;
}
.online-students__teacher-icon {
  height: 16px;
  display: inline-block;
  position: relative;
  top: 2px;
  margin-left: 3px;
}
.online-students__item span {
  float: right;
  color: #4695fa;
  cursor: pointer;
  font-size: 12px;
}
.online-students__item .banned {
  color: #e6412d;
}
</style>
