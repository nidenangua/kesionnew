<template>
  <div class="my-zan">
    <ks-page-scroll-container
      :page="p"
      :page-count="pageCount"
      v-if="list.length > 0"
      @page-change="getZan"
    >
      <topic-item
        class="ks-mt10"
        :jump-link="true"
        :item="item"
        :group-id="item.team_id"
        v-for="(item,i) in list"
        :key="i"
      />
    </ks-page-scroll-container>
    <ks-empty class="ks-bg-white" msg="暂时还未有点赞~" type="notest" v-else-if="loaded"/>
  </div>
</template>

<script>
import TopicItem from "../../group/components/TopicItem";
import { getMyTeamZan } from "@/api/group";
export default {
  name: "UserGroupZanList",
  data() {
    return {
      list: [],
      pageCount: null,
      p: 1,
      loaded: false
    };
  },
  methods: {
    getZan(p = 1) {
      if (p == 1) {
        this.loaded = false;
        this.list = [];
      }
      this.p = p;
      getMyTeamZan({
        p: this.p,
        maxperpage: 10
      }).then(res => {
        res.list.map(item => {
          let filePath = [];
          if (item.file_path) {
            item.id = item.infoid;
            item.file_path.map(src => {
              filePath.push({
                src: src,
                w: "",
                h: ""
              });
            });
            item.file_path = filePath;
          }
        });
        this.list = this.list.concat(res.list);
        this.pageCount = res.page.total_pages;
        this.loaded = true;
      });
    }
  },
  mounted() {
    this.getZan();
  },
  components: {
    TopicItem
  }
};
</script>
<style scoped>
.my-zan__item {
  background: #fff;
  padding: 15px 60px 15px 15px;
}
.my-zan__opeart {
  position: absolute;
  right: 10px;
  top: 30px;
  width: 50px;
  text-align: center;
}
.my-zan__opeart .ks-icon {
  display: block;
}
</style>




