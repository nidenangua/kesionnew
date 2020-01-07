<template>
  <div>
    <el-select
      v-model="item.selected"
      v-for="item in categoryArray"
      class="ks-mr15"
      :key="item.level"
      @change="slideCategory(item)"
      v-show="item.options.length"
    >
      <el-option
        :label="option.categoryname"
        :value="option.categoryid"
        v-for="option in item.options"
        :key="option.categoryid"
      ></el-option>
    </el-select>
  </div>
</template>
<script>
import { getAppSetting } from "@/api/home";
import { category } from "@/api/exam";
export default {
  name: "PaperClassfiy",
  props: {
    /**显示分类*/
    visible: Boolean,
    /**
     * 当前分类id
     */
    categoryid: String,
    /**
     * 分类的级别关系
     * 例：[1,32,66]
     */
    parentidPath: {
      type: Array,
      default() {
        return [];
      }
    }
  },
  data() {
    return {
      categoryArray: []
    };
  },
  methods: {
    slideCategory(item) {
      let childCategoryItem;
      item.options.map(a => {
        if (a.categoryid == item.selected) {
          childCategoryItem = a;
        }
      });
      if (!childCategoryItem.childLoaded) {
        this.getChildCategory(childCategoryItem).then(res => {
          let offset = item.level;
          this.categoryArray.splice(offset, this.categoryArray.length - offset);
          this.categoryArray.push({
            selected: null,
            level: offset + 1,
            options: res
          });
        });
      } else {
        let offset = item.level;
        this.categoryArray.splice(offset, this.categoryArray.length - offset);
        this.categoryArray.push({
          selected: null,
          level: offset + 1,
          options: childCategoryItem.childs
        });
      }
      this.$emit("change", item.selected);
    },
    /**
     * 获取子级栏目
     */
    getChildCategory(childCategoryItem) {
      return new Promise(resolve => {
        category({
          categoryid: childCategoryItem.categoryid
        }).then(res => {
          res.map(item => {
            item.childLoaded = false;
            item.childs = [];
          });
          childCategoryItem.childs = res;
          childCategoryItem.childLoaded = true;
          resolve(res);
        });
      });
    },
    /**
     * 获取子级分类
     * @param {Array} 需获取子级分类的父级数组
     * @param {Array} 级别关系数组
     * @param {Number} 当前数组等级
     */
    getCategoryArr(parentArr, categoryPath, level) {
      let _categoryArray = [];
      let _selected = categoryPath[level];
      let _level = level + 1;
      let categoryItem;

      /**
       * 进入匹配当前等级的栏目数组是否存在保存的栏目id
       */
      for (let i = 0; i < parentArr.length; i++) {
        let item = parentArr[i];
        if (item.categoryid == _selected) {
          categoryItem = item;
          break;
        }
      }
      let selectItem = {
        selected: categoryItem ? _selected : null,
        level: _level,
        options: parentArr
      };
      this.categoryArray.push(selectItem);

      /**
       * 当前路径关系未循环完，继续进入轮询
       */
      if (categoryItem) {
        this.getChildCategory(categoryItem, categoryPath[_level]).then(res => {
          this.getCategoryArr(res, categoryPath, _level);
        });
      }
    },
    /**
     * 设置初始化分类
     */
    setCategory() {
      this.categoryArray = [];
      category().then(res => {
        if (res.length) {
          /**
           * 遍历一级分类
           * 动态增加 childLoaded , childs 节点
           * childLoaded 用于判断当前分类的子级是否已加载，避免重复加载
           * childs 存储当前分类的子级
           */
          res.map(item => {
            item.childLoaded = false;
            item.childs = [];
          });

          this.getCategoryArr(res, this.parentidPath, 0);
          this.$emit("update:visible", true);
        } else {
          this.$emit("update:visible", false);
        }
      });
    }
  },
  created() {
    this.setCategory();
    getAppSetting({
      appid: 10
    }).then(res => {
      console.log(res);
    });
  }
};
</script>





