<template>
    <div class="topic-item" @click="open(item.id)">
        <div class="topic-item__info">
            <ks-create-bg class="topic-item__img" :src="item.userinfo.head" type="user" />
            <div class="topic-item__txt">
                <div class="topic-item__name">
                    {{item.userinfo.name}}
                    <span class="staus-bule" v-show="item.role==2">群主</span>
                    <span class="staus-orange" v-show="item.is_hot==1">精选</span>
                    <span class="staus-green" v-show="item.is_top==1">置顶</span>  
                    <span class="staus-bule" v-show="item.is_notice==1">公告</span>                                
                </div>
                <div class="topic-item__time">
                    {{item.create_time}}
                </div>

            </div>
            <div class="topic-item__opeart" @click.stop="operate(item.is_top,item.is_hot,item.is_notice,item.id)" v-if="isJoin == 1">
                <i class="ks-icon ks-icon-arrow-ios-downward-outline"></i>
            </div>

        </div>
        <div class="topic-item__body">
            <div class="topic-item__body__tit">
            {{item.title}}
            </div>
            <div class="topic-item__body__intro">
            {{item.content}}   
            </div>   
            
        </div>
        <div class="topic-item__img_list clearfix" v-if="item.file_path && item.file_path.length == 1">
            <div class="topic-item__img__item--only" v-for="(img,index) in item.file_path" :key="index"  @click.stop="$preview(item.file_path,index)">
                <ks-image :src="img.src" class="topic-item__img__trigger"  /> 
            </div>

        </div>
        <div class="topic-item__img_list clearfix" v-else-if="item.file_path && item.file_path.length > 1">
            <div class="topic-item__img__item" v-for="(img,index) in item.file_path" :key="index">
                <ks-create-bg :ratio="1" :src="img.src">
                    <div class="topic-item__img__trigger" @click.stop="$preview(item.file_path,index)"></div>
                </ks-create-bg>
            </div>

        </div>
        <div class="topic-item__comment clearfix">
            <span class="ks-icon ks-icon-message-circle-outline" v-if="type !== 'reply'"> {{item.chat_num}}</span>
            <span class="ks-icon" @click.stop="getzan(item)" :class="item.is_zan == 1 ? 'ks-icon-dianzan ks-color-primary' : 'ks-icon-dianzan-outline'"> {{item.like_num }} </span>
        </div>
    </div> 
</template>
<script>
import {setStatus,teamShield,teamDel} from '@/api/group'
import {dianZan} from '@/api/group'
export default {
    name:'TopicItem',
    props:[
        'item',
        'role',
        'type',
        'isJoin',
        'groupId',
        'jumpLink'
    ],
    mounted(){
        console.log(this.item)
    },
    methods:{
        /**
         * 操作弹窗显示隐藏
         */
        operate(isTop,isHot,isNotice,_topicId){
            
            let list = []
            if(this.role == 0 || this.role == 2){
                list = [{
                    name:isHot == 0 ? '设为精选' : '取消精选',
                    action:'setup',
                    topicId:_topicId,
                    type:1
                },
                {
                    name:isTop == 0 ? '设为置顶' : '取消置顶',
                    action:'setup',
                    topicId:_topicId,
                    type:2
                },
                {
                    name:isNotice == 0 ? '设置为公告' : '取消公告',
                    action:'setup',
                    topicId:_topicId,
                    type:3
                }]
                
            }
            list.push({
                name:'屏蔽',
                action:'shiled',
                topicId:_topicId
            })
            if(this.role == 0 || this.role == 2){
                list.push({
                    name:'删除',
                    action:'del',
                    topicId:_topicId
                })
            }

            this.$actionSheet({
                list:list
            }).then(info=>{
                switch(info.action){
                    case 'setup':
                        this.status(info.type,info.topicId)
                        break
                    case 'shiled':
                        this.shiled(info.topicId)
                        break
                    case 'del':
                        this.teamDel(2,info.topicId)
                        break
                }
            })

        },

        /**
        * 更改操作权限
        */
        status(type,topicId){ 
            setStatus({
                team_id:this.groupId,
                topic_id:topicId,
                type:type
            }).then(res=>{
                this.$emit('change',{
                    action:'setStatus',
                    type:type
                })
            
            });
        },
    
        /**
        * 设置屏蔽
        */
        shiled(topicId){
            teamShield({
                id:topicId,
            }).then(res=>{
                this.$toast('屏蔽成功','success')
                this.$emit('change',{
                    action:'shiled',
                    topicId:topicId
                })
                
            });
        },
        /**
        * 删除动态
        */
        teamDel(type,topicId){
            teamDel({
                id:topicId,
                type:type
            }).then(res=>{
                this.$emit('change',{
                    action:'del',
                    topicId:topicId
                })
            })
        },
        /**
         * 点赞 
         */
        getzan(item){
           
            /**
             * type 5 话题点赞 6回复点赞
             */
            
            let _type = this.type === 'reply' ? 6 : 5
            
            dianZan({
                type:_type,
                id:item.id,
                team_id:this.groupId
            }).then(res=>{
                
                if(item.is_zan == 0){
                    item.like_num ++
                    item.is_zan = 1
                }else if(item.is_zan == 1){
                    item.like_num --
                    item.is_zan = 0
                }
            })
        },
        /**
        * 跳转话题列表
        */
        open(topicId){
            if(!this.jumpLink){
                return false
            }

            this.$router.push({
                name:'GroupTopic',
                query:{
                    id:topicId,
                    team_id:this.groupId
                }
            })
            
        }
    }
}
</script>
<style scoped>
.topic-item {
  padding:15px;
  background: #fff;
 
}
.topic-item:hover{
    background: #f9f9f9
}

.topic-item__info {
  display: flex;
 justify-content: flex-start;

 position: relative;
}
.topic-item__info .topic-item__img{
  width: 36px;
  height: 36px;
  border-radius: 50%
}

.topic-item__name {
  font-size: 15px;
  color: #353535;
}
.topic-item__name span {
  display: inline-block;
  width: 33px;
  height: 15px;
  line-height: 15px;
  text-align: center;
  font-size: 12px;
  margin-left: 5px;
  border-radius: 2px;
}
.topic-item__name .staus-bule {
  border:1px solid #2F83FF;
  color: #2F83FF;
}
.topic-item__name .staus-orange {
  border:1px solid #F35003;
  color: #F35003;
}
.topic-item__name .staus-green {
  border:1px solid #42C642;
  color: #42C642
}
.topic-item__time {
  color: #999;
  margin-top: 4px
}
.topic-item__txt {
  padding-left: 10px
}

.topic-item__body  {
  position: relative;
  padding-top: 15px;
}
.topic-item__body__tit {
  font-size: 16px;
  line-height: 24px;
  font-weight: 500
}
.topic-item__body__intro {
  line-height:24px;
  font-size: 14px;
  padding: 6px 0;
}
.topic-item__opeart {
  position: absolute;
  right: 0;
  top:50%;
  margin-top: -16px;
  line-height: 32px;
  text-align: center;
  width: 32px;
  height: 32px;
  color:#999
}

.topic-item__comment span{
  position: relative;
  float: right;
  margin-left: 15px;
  color: #666;
  font-size: 14px
}

.topic-item__img_list{
    margin:10px 0 0 -15px;
    padding-right: 30px;
}
.topic-item__img__item{
    width: 30%;
    float: left;
    padding:0 0 15px 15px;
    box-sizing: border-box
}
.topic-item__img__item img{
    width: 100%;
    height: 100%;
    opacity: 0;
}
.topic-item__img__item--only{
    margin-left: 15px;
}
.topic-item__img__item--only,
.topic-item__img__item--only .topic-item__img__trigger{
    max-width: 250px;
    width: inherit;
    float: inherit;
    max-height: 250px;
}
.topic-item__img__trigger{
    width:100%;
    height:100%;
    position:relative;
}

</style>
