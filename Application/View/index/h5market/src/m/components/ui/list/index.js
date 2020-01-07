import List from './List';
import ListItem from './ListItem';
/* install component */
List.install = function(Vue) {
    Vue.component(List.name, List);
    Vue.component(ListItem.name, ListItem);
};

export default List;