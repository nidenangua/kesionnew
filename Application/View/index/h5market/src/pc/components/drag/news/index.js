import News from './News';

/* install component */
News.install = function(Vue) {
    Vue.component(News.name, News);
};

export default News;