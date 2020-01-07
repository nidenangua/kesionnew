import Field from './Field'
/* install component */
Field.install = function(Vue) {
    Vue.component(Field.name, Field);
};
export default Field