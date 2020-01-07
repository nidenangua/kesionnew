<template>
    <div>
        <van-popup v-model="show" position="bottom" :style="{ height: '40%' }">
            <van-area
                :area-list="areaList"
                title="请选择分类"
                @change="onChange"
                @cancel="show = !show"
                @confirm="sure"
            />
        </van-popup>
    </div>
</template>
<script>
import {courseCategory} from "@/api/courseManage";
const CityList = {
    codes:{}
}
export default {
    props:{
        isshow:Boolean
    },
    name:'KsSelectCate',
    data(){
        return {
            show:false,
            areaList: {
                province_list: {},
                city_list: {},
                county_list: {}
            }
        }
    },
    mounted(){
        this.updateAreaInfo()
    },
    methods: {
        onChange(e,current,rowIndex){
            switch (rowIndex) {
                case 0:
                case 1:
                    let code = current[rowIndex].code
                    let id = CityList.codes[code]
                    this.updateAreaInfo(id,code,rowIndex+1)
                    break;
            }
        },
        updateAreaInfo(id = 0,code = '',current = 0){
            switch (current) {
                case 0:
                    code = ''
                    break
                case 1:
                    if(!code){
                        console.error('code can not be empty')
                        return
                    }
                    code = code.substr(0,2)
                    break;
                case 2:
                    if(!code){
                        console.error('code can not be empty')
                        return
                    }
                    code = code.substr(0,4)
                    break;
            }
            this.getCityData(id,code).then(res=>{
                switch (current) {
                    case 0:
                        this.areaList.province_list = res.area
                        this.updateAreaInfo(res.original[0].id,res.original[0].code,current+1)
                        break;
                    case 1:
                        this.areaList.city_list = res.area
                        this.updateAreaInfo(res.original[0].id,res.original[0].code,current+1)
                        break
                    case 2:
                        this.areaList.county_list = res.area
                        break;
                }
            })
           
        },
        getCityData(id,code = ''){
            return new Promise(resolve=>{
                 let cityData = CityList[id]
                 if(cityData){
                    resolve(cityData)
                 }else{
                    courseCategory().then(res=>{
                        let area = {}
                        console.log(res)
                        res.map((item,i)=>{
                            item.code = code.toString() + (10+i)
                            let length = 6 - item.code.length
                            for(var a=0;a<length;a++){
                                item.code += '0'
                            }
                            area[item.code] = item.categoryname
                            CityList.codes[item.code] = item.categoryid
                        })
                        CityList[id] = {
                            original:res,
                            area:area
                        }
                        resolve(CityList[id])
                    })
                 }
                
            })
        },
        sure(val) {
            let msg = {
                site:'',
                ids:[]
            };
            let ids = []
            val.map(item=>{
                msg.site += `${item.name}/`
                msg.ids.push(CityList.codes[item.code])
            })
            console.log(msg)
            msg.site = msg.site.substr(0,msg.site.length-1)
            this.show = false
            this.$emit('getmsg',msg)
        }
    },
    watch: {
        isshow() {
            this.show = !this.show
        }
    },
}
</script>
