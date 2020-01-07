<template>
<div class="course-data">
  <div class="course-data-list" v-if="list.length">
    <div
      class="course-data-list__item"
      v-for="(item,index) in list"
      @click="download(item.id)"
      :key="item.id"
      :class="index < list.length-1 && 'ks-line'"
    >
      <data-format class="course-data-list__format" height="36px" :type="item.type" />
      <ks-text font-size="14px">{{item.title}}</ks-text>
      
      <div class="course-data-list__info ks-color-info">
        <span>{{item.down_num}}次下载</span>
        <span>{{item.size}}</span>
      </div>
    </div>
  </div>
  <ks-empty msg="该课程下暂无资料~" v-else></ks-empty>
</div>
</template>
<script>
import { getMaterialsList } from "@/api/data";
import DataFormat from "../../data/components/DataFormat";
export default {
    name:'CourseData',
    components:{
        DataFormat
    },
    props:{
        courseid:[String,Number]
    },
    data(){
        return {
            list:[]
        }
    },
    methods:{
        /**
         * 下载
         */
        download(id){
            this.$router.push('/data/'+id)
        }
    },
    mounted(){
        getMaterialsList({
            courseid: this.courseid,
            maxperpage: 10,
            p: 1
        }).then(res=>{
            res.list.map(item => {
                let typeMatch = item.file_name.split(".");
                let _type = typeMatch ? typeMatch[typeMatch.length - 1] : "";
                item.type = _type;
            });
            this.list = res.list
        })
    }
}
</script>

<style scoped>
.course-data{
    background: #fff;
}
.course-data-list__item {
  padding: 15px 20px 15px 60px;
  position: relative;
}

.course-data-list__info {
  margin-top: 5px;
}
.course-data-list__info span{
    margin-right: 15px;
}
.course-data-list__format {
  position: absolute;
  left: 15px;
  top: 20px;
}
.course-data-list__item .course-data-list__button{
    position: absolute;
    right: 15px;
    top:15px;
    padding: 0 10px;
    border-radius: 40px;
}
</style>

