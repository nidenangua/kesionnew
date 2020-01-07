<template>
	<div v-if="loading">
		<!-- 签到成功 -->
		<div class="sign-success" v-if="signInfo.is_success">
			<div class="sign-top">
				<div class="ks-bg-white ks-text-center">
					<img src="@/m/assets/activity/tick.gif">
					<div class="ks-color-success ks-fz18 ks-mt10" style="padding-bottom:10px;">签到成功</div>
				</div>
				<div class="ks-bg-white sign-details">
					<div class="ks-fz14 ks-mt10">
						<div class="ks-row ks-mt10">
							<div class="ks-col-5">签到课程：</div>
							<div class="ks-col-19 sign-title">{{signInfo.course_title}}</div>
						</div>
						<div class="ks-row ks-mt10" v-if="signInfo.chapter_title">
							<div class="ks-col-5">签到课时：</div>
							<div class="sign-details__time sign-title ks-col-19">{{signInfo.chapter_title}}</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- 未报名 -->
		<div class="nosign" v-else>
			<div class="nosign-des">
				<div class="ks-row ks-bg-white ks-fz14">
					<div class="ks-col-5">签到课程:</div>
					<div class="ks-col-19 nosign-title">&nbsp;{{signInfo.course_title}}</div>
				</div>
				<div class="ks-row ks-bg-white ks-fz14 ks-mt20" v-if="signInfo.chapter_title">
					<div class="ks-col-5">签到课时:</div>
					<div class="ks-col-19 nosign-title">&nbsp;{{signInfo.chapter_title}}</div>
				</div>
			</div>
			<div>
				<ks-empty type="noorder" msg="您还没有报名该课程哦~"></ks-empty>
				<div class="ks-text-center ks-mt10">
					<router-link :to="{name:'CourseView',params:{id:$route.params.id}}">
						<ks-button type="primary" class="nosign-go-registed">去报名</ks-button>
					</router-link>
				</div>
			</div>
		</div>
		<div class="footer">
			<!--底部-->
			<store-footer/>
		</div>
	</div>
</template>

<script>
import { faceSign } from "@/api/microportal";
export default {
  name: "FaceSign",
  data() {
    return {
      loading: false,
      /**签到信息 */
      signInfo: null
    };
  },
  activated() {
    this.loading = false;
    let params = {
      courseid: this.$route.params.id,
      chapterid: this.$route.query.chapterid
    };
    faceSign(params).then(res => {
      this.signInfo = res;
      this.loading = true;
    });
  }
};
</script>

<style scoped>
.sign-success {
  min-height: 100vh;
}
.sign-details {
  color: #666666;
  margin-top: 10px;
  padding: 10px;
}
.sign-top img {
  width: 130px;
}
.sign-top__ticket {
  margin: 10px;
}

.sign-list {
  padding-top: 20px;
  background-color: #fff;
}
.sign-item {
  min-width: 60px;
  padding: 5px 10px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.sign-item .sign-btn {
  width: 80px;
  font-weight: normal;
}
.sign-item .sign-time {
  margin-bottom: 10px;
}
.sign-item .no-sign {
  color: #999999;
}
.check-activity {
  width: 95%;
  margin: 25px 10px;
  max-width: 480px;
}
.sign-details__time {
  line-height: 23px;
}

.nosign {
  min-height: 100vh;
  background-color: #f5f5f5;
}
.nosign-des {
  color: #666666;
  padding: 20px;
  background-color: #fff;
}
.nosign-title,
.sign-title {
  color: #353535;
}
.nosign .nosign-go-registed {
  font-weight: normal;
  background-color: #333232;
  border: #333232;
  width: 120px;
}
.footer {
  position: absolute;
  width: 100%;
  left: 0;
  bottom: 0;
}
</style>
