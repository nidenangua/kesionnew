<template>
	<div>
	    <span class="ks-switch" :class="{'ks-switch--on' : isChecked}" @click="toggle" style="position:relative">
			<div v-if="isChecked && direction.length > 0" style="width:100%;height:100%;position:absolute;padding:0 5px;line-height:20px;color:#FFF;user-select:none">
				{{direction[0]}}
			</div>
			<div v-if="!isChecked && direction.length > 0" style="width:100%;height:100%;position:absolute;padding:0 5px;right:2px;line-height:22px;color:#7A7A7A;text-align:right;user-select:none">
				{{direction[1]}}
			</div>
	    </span>
	</div>
</template>
<script>
	export default {
		name: 'KsSwitch',
		props: {
	      value: {
	        type: Boolean,
	        default: true
	      },
	      text: {
	      	type: String,
	      	default: ''
	      }
	    },
		data () {
			return {
				isChecked: this.value
			}
		},
		model:{
			prop:'value',
			event:'change'
		},
		computed: {
			direction () {
				if (this.text) {
					return this.text.split('|')
				} else {
					return []
				}
			}
		},
		watch: {
          value (val) {
            this.isChecked = val
          },
	      isChecked(val) {
	        this.$emit('change', val);
	      }
	    },
	    methods: {
	      toggle() {
	        this.isChecked = !this.isChecked;
	      }
	    }
	}	
</script>
<style scope>
	.ks-switch {
		margin: 0 5px;
	    display: block;
	    position: relative;
	    width: 40px;
	    height: 20px;
	    border: 1px solid #DFDFDF;
	    outline: 0;
	    border-radius: 16px;
	    box-sizing: border-box;
	    background-color: #DFDFDF;
	    transition: background-color 0.1s, border 0.1s;
	    cursor: pointer;
	  }
	  .ks-switch:before {
	    content: " ";
	    position: absolute;
	    top: 0;
	    left: 0;
	    width: 38px;
	    height: 18px;
	    border-radius: 15px;
	    background-color: #FDFDFD;
	    transition: transform 0.35s cubic-bezier(0.45, 1, 0.4, 1);
	  }
	  .ks-switch:after {
	    content: " ";
	    position: absolute;
	    top: 0;
	    left: 0;
	    width: 18px;
	    height: 18px;
	    border-radius: 15px;
	    background-color: #FFFFFF;
	    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.4);
	    transition: transform 0.35s cubic-bezier(0.4, 0.4, 0.25, 1.35);
	  }
	  .ks-switch--on {
	    background-color: #13ce66;
	  }
	  .ks-switch--on:before {
	    border-color: #13ce66;
	    background-color: #13ce66;
	  }
	  .ks-switch--on:after {
	    transform: translateX(19px);
	  }
</style>