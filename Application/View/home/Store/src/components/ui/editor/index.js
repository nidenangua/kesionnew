import Editor from './Editor'

/* install component */
Editor.install = function(Vue) {
    Vue.component(Editor.name, Editor);
};

export default Editor;