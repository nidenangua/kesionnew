import Teacher from './Teacher';

/* install component */
Teacher.install = function(Vue) {
    Vue.component(Teacher.name, Teacher);
};

export default Teacher;