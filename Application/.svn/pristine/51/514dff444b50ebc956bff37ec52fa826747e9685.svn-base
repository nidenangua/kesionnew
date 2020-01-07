<template>
    <div class="ks-field" :class="line && 'ks-field--line'">
        <input :type="type === 'number' ? 'text' : type" v-model="inputValue" :placeholder="placeholder" ref="input">
        <div class="ks-field__button">
            <slot name="button" />
        </div>
    </div>
</template>
<script>
export default {
    name:'KsField',
    props:{
        line:Boolean,
        type:{
            type:String,
            default:'text'
        },
        value:String,
        placeholder:String,
        maxlength:[String,Number]
    },
    model:{
        prop:'value',
        event:'change'
    },
    data(){
        return {
            inputValue:this.value
        }
    },
    watch:{
        value(v){
            this.inputValue = v
        },
        inputValue(v){
            if(this.type === 'number'){
                v = v.match(/\d+/)
                v = v ? v[0] : ''
            }
            if(this.maxlength && v.length > this.maxlength){
                this.inputValue = v.substr(0,this.maxlength)
                return
            }
            this.inputValue = v
            this.$emit('change',v)
        }
    },
    methods:{
        focus(){
            this.$refs.input.focus()
        }
    }
}
</script>
<style scoped>
.ks-field{
    height: 49px;
    background: #fff;
    padding: 0 15px;
    display: flex;
    position: relative;
}
.ks-field input {
  width: 100%;
  height: 39px;
  position: relative;
  top: 5px;
  background: none;
  font-size: 14px;
  border: 0px;
  flex: 1;
}
.ks-field--line{
    position: relative;
}
.ks-field--line::after{
  display: block;
  content: " ";
  height: 1px;
  width: 100%;
   background: #e3e3e3;
  -webkit-transform: scaleY(0.5);
  -ms-transform: scaleY(0.5);
  transform: scaleY(0.5);
  -webkit-transform-origin: 0 100%;
  -ms-transform-origin: 0 100%;
  transform-origin: 0 100%;
  position: absolute;
  bottom: 0px;
  left: 0;
  right: 0;
  z-index: 1;

}
</style>