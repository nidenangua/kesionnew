<template>
    <div>
        <van-popup v-model="show" position="bottom" :style="{ height: '40%' }">
            <van-area
                :area-list="areaList"
                title="请选择地址"
                @change="onChange"
                @cancel="show = !show"
                @confirm="sure"
            />
        </van-popup>
    </div>
</template>
<script>
import { getArea } from "@/api/mall"
const CityList = {
    codes:{}
}
export default {
    props:{
        isshow:Boolean
    },
    name:'KsSelectCity',
    data(){
        return {
            show:false,
            areaList: {
                province_list: {
                },
                city_list: {
                    // 110100: '北京市',
                    // 120100: '天津市',
                    // 120200: '县'
                },
                county_list: {
                    // 110133: '东城区',
                    // 110102: '西城区',
                    // 110105: '朝阳区',
                    // 110106: '丰台区',
                    // 120101: '和平区',
                    // 120102: '河东区',
                    // 120103: '河西区',
                    // 120104: '南开区',
                    // 120105: '河北区',
                    // // ....
                }
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
                    getArea({
                        id:id
                    }).then(res=>{
                        let area = {}
                        res.list.map((item,i)=>{
                            item.code = code.toString() + (10+i)
                            let length = 6 - item.code.length
                            for(var a=0;a<length;a++){
                                item.code += '0'
                            }
                            area[item.code] = item.city
                            CityList.codes[item.code] = item.id
                        })
                        CityList[id] = {
                            original:res.list,
                            area:area
                        }
                        resolve(CityList[id])
                    })
                 }
                
            })
        },
        sure(val) {
            console.log(val)
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
