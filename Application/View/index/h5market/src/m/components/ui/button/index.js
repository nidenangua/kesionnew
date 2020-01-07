import Button from './Button';

/* install component */
Button.install = function(Vue) {
    Vue.component(Button.name, Button);
};

export default Button;