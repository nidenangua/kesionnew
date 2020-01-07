import Course from './Course';

/* install component */
Course.install = function(Vue) {
    Vue.component(Course.name, Course);
};

export default Course;