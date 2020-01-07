import Group from './Group';

/* install component */
Group.install = function(Vue) {
    Vue.component(Group.name, Group);
};

export default Group;