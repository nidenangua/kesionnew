import Progress from './Progress.vue'

/* install component */
Progress.install = function(Vue){
    Vue.component(Progress.name, Progress);
}

export default Progress;