(global["webpackJsonp"] = global["webpackJsonp"] || []).push([["common/vendor"],{

/***/ 1:
/*!************************************************************!*\
  !*** ./node_modules/@dcloudio/uni-mp-weixin/dist/index.js ***!
  \************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
Object.defineProperty(exports, "__esModule", { value: true });exports.createApp = createApp;exports.createComponent = createComponent;exports.createPage = createPage;exports.default = void 0;var _vue = _interopRequireDefault(__webpack_require__(/*! vue */ 2));function _interopRequireDefault(obj) {return obj && obj.__esModule ? obj : { default: obj };}function _slicedToArray(arr, i) {return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _nonIterableRest();}function _nonIterableRest() {throw new TypeError("Invalid attempt to destructure non-iterable instance");}function _iterableToArrayLimit(arr, i) {var _arr = [];var _n = true;var _d = false;var _e = undefined;try {for (var _i = arr[Symbol.iterator](), _s; !(_n = (_s = _i.next()).done); _n = true) {_arr.push(_s.value);if (i && _arr.length === i) break;}} catch (err) {_d = true;_e = err;} finally {try {if (!_n && _i["return"] != null) _i["return"]();} finally {if (_d) throw _e;}}return _arr;}function _arrayWithHoles(arr) {if (Array.isArray(arr)) return arr;}function _defineProperty(obj, key, value) {if (key in obj) {Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true });} else {obj[key] = value;}return obj;}function _toConsumableArray(arr) {return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _nonIterableSpread();}function _nonIterableSpread() {throw new TypeError("Invalid attempt to spread non-iterable instance");}function _iterableToArray(iter) {if (Symbol.iterator in Object(iter) || Object.prototype.toString.call(iter) === "[object Arguments]") return Array.from(iter);}function _arrayWithoutHoles(arr) {if (Array.isArray(arr)) {for (var i = 0, arr2 = new Array(arr.length); i < arr.length; i++) {arr2[i] = arr[i];}return arr2;}}

var _toString = Object.prototype.toString;
var hasOwnProperty = Object.prototype.hasOwnProperty;

function isFn(fn) {
  return typeof fn === 'function';
}

function isStr(str) {
  return typeof str === 'string';
}

function isPlainObject(obj) {
  return _toString.call(obj) === '[object Object]';
}

function hasOwn(obj, key) {
  return hasOwnProperty.call(obj, key);
}

function noop() {}

/**
                    * Create a cached version of a pure function.
                    */
function cached(fn) {
  var cache = Object.create(null);
  return function cachedFn(str) {
    var hit = cache[str];
    return hit || (cache[str] = fn(str));
  };
}

/**
   * Camelize a hyphen-delimited string.
   */
var camelizeRE = /-(\w)/g;
var camelize = cached(function (str) {
  return str.replace(camelizeRE, function (_, c) {return c ? c.toUpperCase() : '';});
});

var HOOKS = [
'invoke',
'success',
'fail',
'complete',
'returnValue'];


var globalInterceptors = {};
var scopedInterceptors = {};

function mergeHook(parentVal, childVal) {
  var res = childVal ?
  parentVal ?
  parentVal.concat(childVal) :
  Array.isArray(childVal) ?
  childVal : [childVal] :
  parentVal;
  return res ?
  dedupeHooks(res) :
  res;
}

function dedupeHooks(hooks) {
  var res = [];
  for (var i = 0; i < hooks.length; i++) {
    if (res.indexOf(hooks[i]) === -1) {
      res.push(hooks[i]);
    }
  }
  return res;
}

function removeHook(hooks, hook) {
  var index = hooks.indexOf(hook);
  if (index !== -1) {
    hooks.splice(index, 1);
  }
}

function mergeInterceptorHook(interceptor, option) {
  Object.keys(option).forEach(function (hook) {
    if (HOOKS.indexOf(hook) !== -1 && isFn(option[hook])) {
      interceptor[hook] = mergeHook(interceptor[hook], option[hook]);
    }
  });
}

function removeInterceptorHook(interceptor, option) {
  if (!interceptor || !option) {
    return;
  }
  Object.keys(option).forEach(function (hook) {
    if (HOOKS.indexOf(hook) !== -1 && isFn(option[hook])) {
      removeHook(interceptor[hook], option[hook]);
    }
  });
}

function addInterceptor(method, option) {
  if (typeof method === 'string' && isPlainObject(option)) {
    mergeInterceptorHook(scopedInterceptors[method] || (scopedInterceptors[method] = {}), option);
  } else if (isPlainObject(method)) {
    mergeInterceptorHook(globalInterceptors, method);
  }
}

function removeInterceptor(method, option) {
  if (typeof method === 'string') {
    if (isPlainObject(option)) {
      removeInterceptorHook(scopedInterceptors[method], option);
    } else {
      delete scopedInterceptors[method];
    }
  } else if (isPlainObject(method)) {
    removeInterceptorHook(globalInterceptors, method);
  }
}

function wrapperHook(hook) {
  return function (data) {
    return hook(data) || data;
  };
}

function isPromise(obj) {
  return !!obj && (typeof obj === 'object' || typeof obj === 'function') && typeof obj.then === 'function';
}

function queue(hooks, data) {
  var promise = false;
  for (var i = 0; i < hooks.length; i++) {
    var hook = hooks[i];
    if (promise) {
      promise = Promise.then(wrapperHook(hook));
    } else {
      var res = hook(data);
      if (isPromise(res)) {
        promise = Promise.resolve(res);
      }
      if (res === false) {
        return {
          then: function then() {} };

      }
    }
  }
  return promise || {
    then: function then(callback) {
      return callback(data);
    } };

}

function wrapperOptions(interceptor) {var options = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
  ['success', 'fail', 'complete'].forEach(function (name) {
    if (Array.isArray(interceptor[name])) {
      var oldCallback = options[name];
      options[name] = function callbackInterceptor(res) {
        queue(interceptor[name], res).then(function (res) {
          /* eslint-disable no-mixed-operators */
          return isFn(oldCallback) && oldCallback(res) || res;
        });
      };
    }
  });
  return options;
}

function wrapperReturnValue(method, returnValue) {
  var returnValueHooks = [];
  if (Array.isArray(globalInterceptors.returnValue)) {
    returnValueHooks.push.apply(returnValueHooks, _toConsumableArray(globalInterceptors.returnValue));
  }
  var interceptor = scopedInterceptors[method];
  if (interceptor && Array.isArray(interceptor.returnValue)) {
    returnValueHooks.push.apply(returnValueHooks, _toConsumableArray(interceptor.returnValue));
  }
  returnValueHooks.forEach(function (hook) {
    returnValue = hook(returnValue) || returnValue;
  });
  return returnValue;
}

function getApiInterceptorHooks(method) {
  var interceptor = Object.create(null);
  Object.keys(globalInterceptors).forEach(function (hook) {
    if (hook !== 'returnValue') {
      interceptor[hook] = globalInterceptors[hook].slice();
    }
  });
  var scopedInterceptor = scopedInterceptors[method];
  if (scopedInterceptor) {
    Object.keys(scopedInterceptor).forEach(function (hook) {
      if (hook !== 'returnValue') {
        interceptor[hook] = (interceptor[hook] || []).concat(scopedInterceptor[hook]);
      }
    });
  }
  return interceptor;
}

function invokeApi(method, api, options) {for (var _len = arguments.length, params = new Array(_len > 3 ? _len - 3 : 0), _key = 3; _key < _len; _key++) {params[_key - 3] = arguments[_key];}
  var interceptor = getApiInterceptorHooks(method);
  if (interceptor && Object.keys(interceptor).length) {
    if (Array.isArray(interceptor.invoke)) {
      var res = queue(interceptor.invoke, options);
      return res.then(function (options) {
        return api.apply(void 0, [wrapperOptions(interceptor, options)].concat(params));
      });
    } else {
      return api.apply(void 0, [wrapperOptions(interceptor, options)].concat(params));
    }
  }
  return api.apply(void 0, [options].concat(params));
}

var promiseInterceptor = {
  returnValue: function returnValue(res) {
    if (!isPromise(res)) {
      return res;
    }
    return res.then(function (res) {
      return res[1];
    }).catch(function (res) {
      return res[0];
    });
  } };


var SYNC_API_RE =
/^\$|restoreGlobal|getCurrentSubNVue|getMenuButtonBoundingClientRect|^report|interceptors|Interceptor$|getSubNVueById|requireNativePlugin|upx2px|hideKeyboard|canIUse|^create|Sync$|Manager$|base64ToArrayBuffer|arrayBufferToBase64/;

var CONTEXT_API_RE = /^create|Manager$/;

var CALLBACK_API_RE = /^on/;

function isContextApi(name) {
  return CONTEXT_API_RE.test(name);
}
function isSyncApi(name) {
  return SYNC_API_RE.test(name);
}

function isCallbackApi(name) {
  return CALLBACK_API_RE.test(name) && name !== 'onPush';
}

function handlePromise(promise) {
  return promise.then(function (data) {
    return [null, data];
  }).
  catch(function (err) {return [err];});
}

function shouldPromise(name) {
  if (
  isContextApi(name) ||
  isSyncApi(name) ||
  isCallbackApi(name))
  {
    return false;
  }
  return true;
}

function promisify(name, api) {
  if (!shouldPromise(name)) {
    return api;
  }
  return function promiseApi() {var options = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};for (var _len2 = arguments.length, params = new Array(_len2 > 1 ? _len2 - 1 : 0), _key2 = 1; _key2 < _len2; _key2++) {params[_key2 - 1] = arguments[_key2];}
    if (isFn(options.success) || isFn(options.fail) || isFn(options.complete)) {
      return wrapperReturnValue(name, invokeApi.apply(void 0, [name, api, options].concat(params)));
    }
    return wrapperReturnValue(name, handlePromise(new Promise(function (resolve, reject) {
      invokeApi.apply(void 0, [name, api, Object.assign({}, options, {
        success: resolve,
        fail: reject })].concat(
      params));
      /* eslint-disable no-extend-native */
      if (!Promise.prototype.finally) {
        Promise.prototype.finally = function (callback) {
          var promise = this.constructor;
          return this.then(
          function (value) {return promise.resolve(callback()).then(function () {return value;});},
          function (reason) {return promise.resolve(callback()).then(function () {
              throw reason;
            });});

        };
      }
    })));
  };
}

var EPS = 1e-4;
var BASE_DEVICE_WIDTH = 750;
var isIOS = false;
var deviceWidth = 0;
var deviceDPR = 0;

function checkDeviceWidth() {var _wx$getSystemInfoSync =




  wx.getSystemInfoSync(),platform = _wx$getSystemInfoSync.platform,pixelRatio = _wx$getSystemInfoSync.pixelRatio,windowWidth = _wx$getSystemInfoSync.windowWidth; // uni=>wx runtime 编译目标是 uni 对象，内部不允许直接使用 uni

  deviceWidth = windowWidth;
  deviceDPR = pixelRatio;
  isIOS = platform === 'ios';
}

function upx2px(number, newDeviceWidth) {
  if (deviceWidth === 0) {
    checkDeviceWidth();
  }

  number = Number(number);
  if (number === 0) {
    return 0;
  }
  var result = number / BASE_DEVICE_WIDTH * (newDeviceWidth || deviceWidth);
  if (result < 0) {
    result = -result;
  }
  result = Math.floor(result + EPS);
  if (result === 0) {
    if (deviceDPR === 1 || !isIOS) {
      return 1;
    } else {
      return 0.5;
    }
  }
  return number < 0 ? -result : result;
}

var interceptors = {
  promiseInterceptor: promiseInterceptor };




var baseApi = /*#__PURE__*/Object.freeze({
  upx2px: upx2px,
  interceptors: interceptors,
  addInterceptor: addInterceptor,
  removeInterceptor: removeInterceptor });


var previewImage = {
  args: function args(fromArgs) {
    var currentIndex = parseInt(fromArgs.current);
    if (isNaN(currentIndex)) {
      return;
    }
    var urls = fromArgs.urls;
    if (!Array.isArray(urls)) {
      return;
    }
    var len = urls.length;
    if (!len) {
      return;
    }
    if (currentIndex < 0) {
      currentIndex = 0;
    } else if (currentIndex >= len) {
      currentIndex = len - 1;
    }
    if (currentIndex > 0) {
      fromArgs.current = urls[currentIndex];
      fromArgs.urls = urls.filter(
      function (item, index) {return index < currentIndex ? item !== urls[currentIndex] : true;});

    } else {
      fromArgs.current = urls[0];
    }
    return {
      indicator: false,
      loop: false };

  } };


var protocols = {
  previewImage: previewImage };

var todos = [
'vibrate'];

var canIUses = [];

var CALLBACKS = ['success', 'fail', 'cancel', 'complete'];

function processCallback(methodName, method, returnValue) {
  return function (res) {
    return method(processReturnValue(methodName, res, returnValue));
  };
}

function processArgs(methodName, fromArgs) {var argsOption = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : {};var returnValue = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : {};var keepFromArgs = arguments.length > 4 && arguments[4] !== undefined ? arguments[4] : false;
  if (isPlainObject(fromArgs)) {// 一般 api 的参数解析
    var toArgs = keepFromArgs === true ? fromArgs : {}; // returnValue 为 false 时，说明是格式化返回值，直接在返回值对象上修改赋值
    if (isFn(argsOption)) {
      argsOption = argsOption(fromArgs, toArgs) || {};
    }
    for (var key in fromArgs) {
      if (hasOwn(argsOption, key)) {
        var keyOption = argsOption[key];
        if (isFn(keyOption)) {
          keyOption = keyOption(fromArgs[key], fromArgs, toArgs);
        }
        if (!keyOption) {// 不支持的参数
          console.warn("\u5FAE\u4FE1\u5C0F\u7A0B\u5E8F ".concat(methodName, "\u6682\u4E0D\u652F\u6301").concat(key));
        } else if (isStr(keyOption)) {// 重写参数 key
          toArgs[keyOption] = fromArgs[key];
        } else if (isPlainObject(keyOption)) {// {name:newName,value:value}可重新指定参数 key:value
          toArgs[keyOption.name ? keyOption.name : key] = keyOption.value;
        }
      } else if (CALLBACKS.indexOf(key) !== -1) {
        toArgs[key] = processCallback(methodName, fromArgs[key], returnValue);
      } else {
        if (!keepFromArgs) {
          toArgs[key] = fromArgs[key];
        }
      }
    }
    return toArgs;
  } else if (isFn(fromArgs)) {
    fromArgs = processCallback(methodName, fromArgs, returnValue);
  }
  return fromArgs;
}

function processReturnValue(methodName, res, returnValue) {var keepReturnValue = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : false;
  if (isFn(protocols.returnValue)) {// 处理通用 returnValue
    res = protocols.returnValue(methodName, res);
  }
  return processArgs(methodName, res, returnValue, {}, keepReturnValue);
}

function wrapper(methodName, method) {
  if (hasOwn(protocols, methodName)) {
    var protocol = protocols[methodName];
    if (!protocol) {// 暂不支持的 api
      return function () {
        console.error("\u5FAE\u4FE1\u5C0F\u7A0B\u5E8F \u6682\u4E0D\u652F\u6301".concat(methodName));
      };
    }
    return function (arg1, arg2) {// 目前 api 最多两个参数
      var options = protocol;
      if (isFn(protocol)) {
        options = protocol(arg1);
      }

      arg1 = processArgs(methodName, arg1, options.args, options.returnValue);

      var args = [arg1];
      if (typeof arg2 !== 'undefined') {
        args.push(arg2);
      }
      var returnValue = wx[options.name || methodName].apply(wx, args);
      if (isSyncApi(methodName)) {// 同步 api
        return processReturnValue(methodName, returnValue, options.returnValue, isContextApi(methodName));
      }
      return returnValue;
    };
  }
  return method;
}

var todoApis = Object.create(null);

var TODOS = [
'onTabBarMidButtonTap',
'subscribePush',
'unsubscribePush',
'onPush',
'offPush',
'share'];


function createTodoApi(name) {
  return function todoApi(_ref)


  {var fail = _ref.fail,complete = _ref.complete;
    var res = {
      errMsg: "".concat(name, ":fail:\u6682\u4E0D\u652F\u6301 ").concat(name, " \u65B9\u6CD5") };

    isFn(fail) && fail(res);
    isFn(complete) && complete(res);
  };
}

TODOS.forEach(function (name) {
  todoApis[name] = createTodoApi(name);
});

var providers = {
  oauth: ['weixin'],
  share: ['weixin'],
  payment: ['wxpay'],
  push: ['weixin'] };


function getProvider(_ref2)




{var service = _ref2.service,success = _ref2.success,fail = _ref2.fail,complete = _ref2.complete;
  var res = false;
  if (providers[service]) {
    res = {
      errMsg: 'getProvider:ok',
      service: service,
      provider: providers[service] };

    isFn(success) && success(res);
  } else {
    res = {
      errMsg: 'getProvider:fail:服务[' + service + ']不存在' };

    isFn(fail) && fail(res);
  }
  isFn(complete) && complete(res);
}

var extraApi = /*#__PURE__*/Object.freeze({
  getProvider: getProvider });


var getEmitter = function () {
  if (typeof getUniEmitter === 'function') {
    /* eslint-disable no-undef */
    return getUniEmitter;
  }
  var Emitter;
  return function getUniEmitter() {
    if (!Emitter) {
      Emitter = new _vue.default();
    }
    return Emitter;
  };
}();

function apply(ctx, method, args) {
  return ctx[method].apply(ctx, args);
}

function $on() {
  return apply(getEmitter(), '$on', Array.prototype.slice.call(arguments));
}
function $off() {
  return apply(getEmitter(), '$off', Array.prototype.slice.call(arguments));
}
function $once() {
  return apply(getEmitter(), '$once', Array.prototype.slice.call(arguments));
}
function $emit() {
  return apply(getEmitter(), '$emit', Array.prototype.slice.call(arguments));
}

var eventApi = /*#__PURE__*/Object.freeze({
  $on: $on,
  $off: $off,
  $once: $once,
  $emit: $emit });




var api = /*#__PURE__*/Object.freeze({});



var MPPage = Page;
var MPComponent = Component;

var customizeRE = /:/g;

var customize = cached(function (str) {
  return camelize(str.replace(customizeRE, '-'));
});

function initTriggerEvent(mpInstance) {
  {
    if (!wx.canIUse('nextTick')) {
      return;
    }
  }
  var oldTriggerEvent = mpInstance.triggerEvent;
  mpInstance.triggerEvent = function (event) {for (var _len3 = arguments.length, args = new Array(_len3 > 1 ? _len3 - 1 : 0), _key3 = 1; _key3 < _len3; _key3++) {args[_key3 - 1] = arguments[_key3];}
    return oldTriggerEvent.apply(mpInstance, [customize(event)].concat(args));
  };
}

function initHook(name, options) {
  var oldHook = options[name];
  if (!oldHook) {
    options[name] = function () {
      initTriggerEvent(this);
    };
  } else {
    options[name] = function () {
      initTriggerEvent(this);for (var _len4 = arguments.length, args = new Array(_len4), _key4 = 0; _key4 < _len4; _key4++) {args[_key4] = arguments[_key4];}
      return oldHook.apply(this, args);
    };
  }
}

Page = function Page() {var options = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};
  initHook('onLoad', options);
  return MPPage(options);
};

Component = function Component() {var options = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};
  initHook('created', options);
  return MPComponent(options);
};

var PAGE_EVENT_HOOKS = [
'onPullDownRefresh',
'onReachBottom',
'onShareAppMessage',
'onPageScroll',
'onResize',
'onTabItemTap'];


function initMocks(vm, mocks) {
  var mpInstance = vm.$mp[vm.mpType];
  mocks.forEach(function (mock) {
    if (hasOwn(mpInstance, mock)) {
      vm[mock] = mpInstance[mock];
    }
  });
}

function hasHook(hook, vueOptions) {
  if (!vueOptions) {
    return true;
  }

  if (_vue.default.options && Array.isArray(_vue.default.options[hook])) {
    return true;
  }

  vueOptions = vueOptions.default || vueOptions;

  if (isFn(vueOptions)) {
    if (isFn(vueOptions.extendOptions[hook])) {
      return true;
    }
    if (vueOptions.super &&
    vueOptions.super.options &&
    Array.isArray(vueOptions.super.options[hook])) {
      return true;
    }
    return false;
  }

  if (isFn(vueOptions[hook])) {
    return true;
  }
  var mixins = vueOptions.mixins;
  if (Array.isArray(mixins)) {
    return !!mixins.find(function (mixin) {return hasHook(hook, mixin);});
  }
}

function initHooks(mpOptions, hooks, vueOptions) {
  hooks.forEach(function (hook) {
    if (hasHook(hook, vueOptions)) {
      mpOptions[hook] = function (args) {
        return this.$vm && this.$vm.__call_hook(hook, args);
      };
    }
  });
}

function initVueComponent(Vue, vueOptions) {
  vueOptions = vueOptions.default || vueOptions;
  var VueComponent;
  if (isFn(vueOptions)) {
    VueComponent = vueOptions;
    vueOptions = VueComponent.extendOptions;
  } else {
    VueComponent = Vue.extend(vueOptions);
  }
  return [VueComponent, vueOptions];
}

function initSlots(vm, vueSlots) {
  if (Array.isArray(vueSlots) && vueSlots.length) {
    var $slots = Object.create(null);
    vueSlots.forEach(function (slotName) {
      $slots[slotName] = true;
    });
    vm.$scopedSlots = vm.$slots = $slots;
  }
}

function initVueIds(vueIds, mpInstance) {
  vueIds = (vueIds || '').split(',');
  var len = vueIds.length;

  if (len === 1) {
    mpInstance._$vueId = vueIds[0];
  } else if (len === 2) {
    mpInstance._$vueId = vueIds[0];
    mpInstance._$vuePid = vueIds[1];
  }
}

function initData(vueOptions, context) {
  var data = vueOptions.data || {};
  var methods = vueOptions.methods || {};

  if (typeof data === 'function') {
    try {
      data = data.call(context); // 支持 Vue.prototype 上挂的数据
    } catch (e) {
      if (Object({"VUE_APP_PLATFORM":"mp-weixin","NODE_ENV":"development","BASE_URL":"/"}).VUE_APP_DEBUG) {
        console.warn('根据 Vue 的 data 函数初始化小程序 data 失败，请尽量确保 data 函数中不访问 vm 对象，否则可能影响首次数据渲染速度。', data);
      }
    }
  } else {
    try {
      // 对 data 格式化
      data = JSON.parse(JSON.stringify(data));
    } catch (e) {}
  }

  if (!isPlainObject(data)) {
    data = {};
  }

  Object.keys(methods).forEach(function (methodName) {
    if (context.__lifecycle_hooks__.indexOf(methodName) === -1 && !hasOwn(data, methodName)) {
      data[methodName] = methods[methodName];
    }
  });

  return data;
}

var PROP_TYPES = [String, Number, Boolean, Object, Array, null];

function createObserver(name) {
  return function observer(newVal, oldVal) {
    if (this.$vm) {
      this.$vm[name] = newVal; // 为了触发其他非 render watcher
    }
  };
}

function initBehaviors(vueOptions, initBehavior) {
  var vueBehaviors = vueOptions['behaviors'];
  var vueExtends = vueOptions['extends'];
  var vueMixins = vueOptions['mixins'];

  var vueProps = vueOptions['props'];

  if (!vueProps) {
    vueOptions['props'] = vueProps = [];
  }

  var behaviors = [];
  if (Array.isArray(vueBehaviors)) {
    vueBehaviors.forEach(function (behavior) {
      behaviors.push(behavior.replace('uni://', "wx".concat("://")));
      if (behavior === 'uni://form-field') {
        if (Array.isArray(vueProps)) {
          vueProps.push('name');
          vueProps.push('value');
        } else {
          vueProps['name'] = {
            type: String,
            default: '' };

          vueProps['value'] = {
            type: [String, Number, Boolean, Array, Object, Date],
            default: '' };

        }
      }
    });
  }
  if (isPlainObject(vueExtends) && vueExtends.props) {
    behaviors.push(
    initBehavior({
      properties: initProperties(vueExtends.props, true) }));


  }
  if (Array.isArray(vueMixins)) {
    vueMixins.forEach(function (vueMixin) {
      if (isPlainObject(vueMixin) && vueMixin.props) {
        behaviors.push(
        initBehavior({
          properties: initProperties(vueMixin.props, true) }));


      }
    });
  }
  return behaviors;
}

function parsePropType(key, type, defaultValue, file) {
  // [String]=>String
  if (Array.isArray(type) && type.length === 1) {
    return type[0];
  }
  return type;
}

function initProperties(props) {var isBehavior = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : false;var file = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : '';
  var properties = {};
  if (!isBehavior) {
    properties.vueId = {
      type: String,
      value: '' };

    properties.vueSlots = { // 小程序不能直接定义 $slots 的 props，所以通过 vueSlots 转换到 $slots
      type: null,
      value: [],
      observer: function observer(newVal, oldVal) {
        var $slots = Object.create(null);
        newVal.forEach(function (slotName) {
          $slots[slotName] = true;
        });
        this.setData({
          $slots: $slots });

      } };

  }
  if (Array.isArray(props)) {// ['title']
    props.forEach(function (key) {
      properties[key] = {
        type: null,
        observer: createObserver(key) };

    });
  } else if (isPlainObject(props)) {// {title:{type:String,default:''},content:String}
    Object.keys(props).forEach(function (key) {
      var opts = props[key];
      if (isPlainObject(opts)) {// title:{type:String,default:''}
        var value = opts['default'];
        if (isFn(value)) {
          value = value();
        }

        opts.type = parsePropType(key, opts.type);

        properties[key] = {
          type: PROP_TYPES.indexOf(opts.type) !== -1 ? opts.type : null,
          value: value,
          observer: createObserver(key) };

      } else {// content:String
        var type = parsePropType(key, opts);
        properties[key] = {
          type: PROP_TYPES.indexOf(type) !== -1 ? type : null,
          observer: createObserver(key) };

      }
    });
  }
  return properties;
}

function wrapper$1(event) {
  // TODO 又得兼容 mpvue 的 mp 对象
  try {
    event.mp = JSON.parse(JSON.stringify(event));
  } catch (e) {}

  event.stopPropagation = noop;
  event.preventDefault = noop;

  event.target = event.target || {};

  if (!hasOwn(event, 'detail')) {
    event.detail = {};
  }

  if (isPlainObject(event.detail)) {
    event.target = Object.assign({}, event.target, event.detail);
  }

  return event;
}

function getExtraValue(vm, dataPathsArray) {
  var context = vm;
  dataPathsArray.forEach(function (dataPathArray) {
    var dataPath = dataPathArray[0];
    var value = dataPathArray[2];
    if (dataPath || typeof value !== 'undefined') {// ['','',index,'disable']
      var propPath = dataPathArray[1];
      var valuePath = dataPathArray[3];

      var vFor = dataPath ? vm.__get_value(dataPath, context) : context;

      if (Number.isInteger(vFor)) {
        context = value;
      } else if (!propPath) {
        context = vFor[value];
      } else {
        if (Array.isArray(vFor)) {
          context = vFor.find(function (vForItem) {
            return vm.__get_value(propPath, vForItem) === value;
          });
        } else if (isPlainObject(vFor)) {
          context = Object.keys(vFor).find(function (vForKey) {
            return vm.__get_value(propPath, vFor[vForKey]) === value;
          });
        } else {
          console.error('v-for 暂不支持循环数据：', vFor);
        }
      }

      if (valuePath) {
        context = vm.__get_value(valuePath, context);
      }
    }
  });
  return context;
}

function processEventExtra(vm, extra, event) {
  var extraObj = {};

  if (Array.isArray(extra) && extra.length) {
    /**
                                              *[
                                              *    ['data.items', 'data.id', item.data.id],
                                              *    ['metas', 'id', meta.id]
                                              *],
                                              *[
                                              *    ['data.items', 'data.id', item.data.id],
                                              *    ['metas', 'id', meta.id]
                                              *],
                                              *'test'
                                              */
    extra.forEach(function (dataPath, index) {
      if (typeof dataPath === 'string') {
        if (!dataPath) {// model,prop.sync
          extraObj['$' + index] = vm;
        } else {
          if (dataPath === '$event') {// $event
            extraObj['$' + index] = event;
          } else if (dataPath.indexOf('$event.') === 0) {// $event.target.value
            extraObj['$' + index] = vm.__get_value(dataPath.replace('$event.', ''), event);
          } else {
            extraObj['$' + index] = vm.__get_value(dataPath);
          }
        }
      } else {
        extraObj['$' + index] = getExtraValue(vm, dataPath);
      }
    });
  }

  return extraObj;
}

function getObjByArray(arr) {
  var obj = {};
  for (var i = 1; i < arr.length; i++) {
    var element = arr[i];
    obj[element[0]] = element[1];
  }
  return obj;
}

function processEventArgs(vm, event) {var args = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : [];var extra = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : [];var isCustom = arguments.length > 4 ? arguments[4] : undefined;var methodName = arguments.length > 5 ? arguments[5] : undefined;
  var isCustomMPEvent = false; // wxcomponent 组件，传递原始 event 对象
  if (isCustom) {// 自定义事件
    isCustomMPEvent = event.currentTarget &&
    event.currentTarget.dataset &&
    event.currentTarget.dataset.comType === 'wx';
    if (!args.length) {// 无参数，直接传入 event 或 detail 数组
      if (isCustomMPEvent) {
        return [event];
      }
      return event.detail.__args__ || event.detail;
    }
  }

  var extraObj = processEventExtra(vm, extra, event);

  var ret = [];
  args.forEach(function (arg) {
    if (arg === '$event') {
      if (methodName === '__set_model' && !isCustom) {// input v-model value
        ret.push(event.target.value);
      } else {
        if (isCustom && !isCustomMPEvent) {
          ret.push(event.detail.__args__[0]);
        } else {// wxcomponent 组件或内置组件
          ret.push(event);
        }
      }
    } else {
      if (Array.isArray(arg) && arg[0] === 'o') {
        ret.push(getObjByArray(arg));
      } else if (typeof arg === 'string' && hasOwn(extraObj, arg)) {
        ret.push(extraObj[arg]);
      } else {
        ret.push(arg);
      }
    }
  });

  return ret;
}

var ONCE = '~';
var CUSTOM = '^';

function isMatchEventType(eventType, optType) {
  return eventType === optType ||

  optType === 'regionchange' && (

  eventType === 'begin' ||
  eventType === 'end');


}

function handleEvent(event) {var _this = this;
  event = wrapper$1(event);

  // [['tap',[['handle',[1,2,a]],['handle1',[1,2,a]]]]]
  var dataset = (event.currentTarget || event.target).dataset;
  if (!dataset) {
    return console.warn("\u4E8B\u4EF6\u4FE1\u606F\u4E0D\u5B58\u5728");
  }
  var eventOpts = dataset.eventOpts || dataset['event-opts']; // 支付宝 web-view 组件 dataset 非驼峰
  if (!eventOpts) {
    return console.warn("\u4E8B\u4EF6\u4FE1\u606F\u4E0D\u5B58\u5728");
  }

  // [['handle',[1,2,a]],['handle1',[1,2,a]]]
  var eventType = event.type;

  var ret = [];

  eventOpts.forEach(function (eventOpt) {
    var type = eventOpt[0];
    var eventsArray = eventOpt[1];

    var isCustom = type.charAt(0) === CUSTOM;
    type = isCustom ? type.slice(1) : type;
    var isOnce = type.charAt(0) === ONCE;
    type = isOnce ? type.slice(1) : type;

    if (eventsArray && isMatchEventType(eventType, type)) {
      eventsArray.forEach(function (eventArray) {
        var methodName = eventArray[0];
        if (methodName) {
          var handlerCtx = _this.$vm;
          if (
          handlerCtx.$options.generic &&
          handlerCtx.$parent &&
          handlerCtx.$parent.$parent)
          {// mp-weixin,mp-toutiao 抽象节点模拟 scoped slots
            handlerCtx = handlerCtx.$parent.$parent;
          }
          if (methodName === '$emit') {
            handlerCtx.$emit.apply(handlerCtx,
            processEventArgs(
            _this.$vm,
            event,
            eventArray[1],
            eventArray[2],
            isCustom,
            methodName));

            return;
          }
          var handler = handlerCtx[methodName];
          if (!isFn(handler)) {
            throw new Error(" _vm.".concat(methodName, " is not a function"));
          }
          if (isOnce) {
            if (handler.once) {
              return;
            }
            handler.once = true;
          }
          ret.push(handler.apply(handlerCtx, processEventArgs(
          _this.$vm,
          event,
          eventArray[1],
          eventArray[2],
          isCustom,
          methodName)));

        }
      });
    }
  });

  if (
  eventType === 'input' &&
  ret.length === 1 &&
  typeof ret[0] !== 'undefined')
  {
    return ret[0];
  }
}

var hooks = [
'onShow',
'onHide',
'onError',
'onPageNotFound'];


function parseBaseApp(vm, _ref3)


{var mocks = _ref3.mocks,initRefs = _ref3.initRefs;
  if (vm.$options.store) {
    _vue.default.prototype.$store = vm.$options.store;
  }

  _vue.default.prototype.mpHost = "mp-weixin";

  _vue.default.mixin({
    beforeCreate: function beforeCreate() {
      if (!this.$options.mpType) {
        return;
      }

      this.mpType = this.$options.mpType;

      this.$mp = _defineProperty({
        data: {} },
      this.mpType, this.$options.mpInstance);


      this.$scope = this.$options.mpInstance;

      delete this.$options.mpType;
      delete this.$options.mpInstance;

      if (this.mpType !== 'app') {
        initRefs(this);
        initMocks(this, mocks);
      }
    } });


  var appOptions = {
    onLaunch: function onLaunch(args) {
      if (this.$vm) {// 已经初始化过了，主要是为了百度，百度 onShow 在 onLaunch 之前
        return;
      }
      {
        if (!wx.canIUse('nextTick')) {// 事实 上2.2.3 即可，简单使用 2.3.0 的 nextTick 判断
          console.error('当前微信基础库版本过低，请将 微信开发者工具-详情-项目设置-调试基础库版本 更换为`2.3.0`以上');
        }
      }

      this.$vm = vm;

      this.$vm.$mp = {
        app: this };


      this.$vm.$scope = this;
      // vm 上也挂载 globalData
      this.$vm.globalData = this.globalData;

      this.$vm._isMounted = true;
      this.$vm.__call_hook('mounted', args);

      this.$vm.__call_hook('onLaunch', args);
    } };


  // 兼容旧版本 globalData
  appOptions.globalData = vm.$options.globalData || {};
  // 将 methods 中的方法挂在 getApp() 中
  var methods = vm.$options.methods;
  if (methods) {
    Object.keys(methods).forEach(function (name) {
      appOptions[name] = methods[name];
    });
  }

  initHooks(appOptions, hooks);

  return appOptions;
}

var mocks = ['__route__', '__wxExparserNodeId__', '__wxWebviewId__'];

function findVmByVueId(vm, vuePid) {
  var $children = vm.$children;
  // 优先查找直属
  var parentVm = $children.find(function (childVm) {return childVm.$scope._$vueId === vuePid;});
  if (parentVm) {
    return parentVm;
  }
  // 反向递归查找
  for (var i = $children.length - 1; i >= 0; i--) {
    parentVm = findVmByVueId($children[i], vuePid);
    if (parentVm) {
      return parentVm;
    }
  }
}

function initBehavior(options) {
  return Behavior(options);
}

function isPage() {
  return !!this.route;
}

function initRelation(detail) {
  this.triggerEvent('__l', detail);
}

function initRefs(vm) {
  var mpInstance = vm.$scope;
  Object.defineProperty(vm, '$refs', {
    get: function get() {
      var $refs = {};
      var components = mpInstance.selectAllComponents('.vue-ref');
      components.forEach(function (component) {
        var ref = component.dataset.ref;
        $refs[ref] = component.$vm || component;
      });
      var forComponents = mpInstance.selectAllComponents('.vue-ref-in-for');
      forComponents.forEach(function (component) {
        var ref = component.dataset.ref;
        if (!$refs[ref]) {
          $refs[ref] = [];
        }
        $refs[ref].push(component.$vm || component);
      });
      return $refs;
    } });

}

function handleLink(event) {var _ref4 =



  event.detail || event.value,vuePid = _ref4.vuePid,vueOptions = _ref4.vueOptions; // detail 是微信,value 是百度(dipatch)

  var parentVm;

  if (vuePid) {
    parentVm = findVmByVueId(this.$vm, vuePid);
  }

  if (!parentVm) {
    parentVm = this.$vm;
  }

  vueOptions.parent = parentVm;
}

function parseApp(vm) {
  return parseBaseApp(vm, {
    mocks: mocks,
    initRefs: initRefs });

}

function createApp(vm) {
  App(parseApp(vm));
  return vm;
}

function parseBaseComponent(vueComponentOptions)


{var _ref5 = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {},isPage = _ref5.isPage,initRelation = _ref5.initRelation;var _initVueComponent =
  initVueComponent(_vue.default, vueComponentOptions),_initVueComponent2 = _slicedToArray(_initVueComponent, 2),VueComponent = _initVueComponent2[0],vueOptions = _initVueComponent2[1];

  var options = {
    multipleSlots: true,
    addGlobalClass: true };


  {
    // 微信 multipleSlots 部分情况有 bug，导致内容顺序错乱 如 u-list，提供覆盖选项
    if (vueOptions['mp-weixin'] && vueOptions['mp-weixin']['options']) {
      Object.assign(options, vueOptions['mp-weixin']['options']);
    }
  }

  var componentOptions = {
    options: options,
    data: initData(vueOptions, _vue.default.prototype),
    behaviors: initBehaviors(vueOptions, initBehavior),
    properties: initProperties(vueOptions.props, false, vueOptions.__file),
    lifetimes: {
      attached: function attached() {
        var properties = this.properties;

        var options = {
          mpType: isPage.call(this) ? 'page' : 'component',
          mpInstance: this,
          propsData: properties };


        initVueIds(properties.vueId, this);

        // 处理父子关系
        initRelation.call(this, {
          vuePid: this._$vuePid,
          vueOptions: options });


        // 初始化 vue 实例
        this.$vm = new VueComponent(options);

        // 处理$slots,$scopedSlots（暂不支持动态变化$slots）
        initSlots(this.$vm, properties.vueSlots);

        // 触发首次 setData
        this.$vm.$mount();
      },
      ready: function ready() {
        // 当组件 props 默认值为 true，初始化时传入 false 会导致 created,ready 触发, 但 attached 不触发
        // https://developers.weixin.qq.com/community/develop/doc/00066ae2844cc0f8eb883e2a557800
        if (this.$vm) {
          this.$vm._isMounted = true;
          this.$vm.__call_hook('mounted');
          this.$vm.__call_hook('onReady');
        }
      },
      detached: function detached() {
        this.$vm.$destroy();
      } },

    pageLifetimes: {
      show: function show(args) {
        this.$vm && this.$vm.__call_hook('onPageShow', args);
      },
      hide: function hide() {
        this.$vm && this.$vm.__call_hook('onPageHide');
      },
      resize: function resize(size) {
        this.$vm && this.$vm.__call_hook('onPageResize', size);
      } },

    methods: {
      __l: handleLink,
      __e: handleEvent } };



  if (Array.isArray(vueOptions.wxsCallMethods)) {
    vueOptions.wxsCallMethods.forEach(function (callMethod) {
      componentOptions.methods[callMethod] = function (args) {
        return this.$vm[callMethod](args);
      };
    });
  }

  if (isPage) {
    return componentOptions;
  }
  return [componentOptions, VueComponent];
}

function parseComponent(vueComponentOptions) {
  return parseBaseComponent(vueComponentOptions, {
    isPage: isPage,
    initRelation: initRelation });

}

var hooks$1 = [
'onShow',
'onHide',
'onUnload'];


hooks$1.push.apply(hooks$1, PAGE_EVENT_HOOKS);

function parseBasePage(vuePageOptions, _ref6)


{var isPage = _ref6.isPage,initRelation = _ref6.initRelation;
  var pageOptions = parseComponent(vuePageOptions);

  initHooks(pageOptions.methods, hooks$1, vuePageOptions);

  pageOptions.methods.onLoad = function (args) {
    this.$vm.$mp.query = args; // 兼容 mpvue
    this.$vm.__call_hook('onLoad', args);
  };

  return pageOptions;
}

function parsePage(vuePageOptions) {
  return parseBasePage(vuePageOptions, {
    isPage: isPage,
    initRelation: initRelation });

}

function createPage(vuePageOptions) {
  {
    return Component(parsePage(vuePageOptions));
  }
}

function createComponent(vueOptions) {
  {
    return Component(parseComponent(vueOptions));
  }
}

todos.forEach(function (todoApi) {
  protocols[todoApi] = false;
});

canIUses.forEach(function (canIUseApi) {
  var apiName = protocols[canIUseApi] && protocols[canIUseApi].name ? protocols[canIUseApi].name :
  canIUseApi;
  if (!wx.canIUse(apiName)) {
    protocols[canIUseApi] = false;
  }
});

var uni = {};

if (typeof Proxy !== 'undefined' && "mp-weixin" !== 'app-plus') {
  uni = new Proxy({}, {
    get: function get(target, name) {
      if (target[name]) {
        return target[name];
      }
      if (baseApi[name]) {
        return baseApi[name];
      }
      if (api[name]) {
        return promisify(name, api[name]);
      }
      {
        if (extraApi[name]) {
          return promisify(name, extraApi[name]);
        }
        if (todoApis[name]) {
          return promisify(name, todoApis[name]);
        }
      }
      if (eventApi[name]) {
        return eventApi[name];
      }
      if (!hasOwn(wx, name) && !hasOwn(protocols, name)) {
        return;
      }
      return promisify(name, wrapper(name, wx[name]));
    },
    set: function set(target, name, value) {
      target[name] = value;
      return true;
    } });

} else {
  Object.keys(baseApi).forEach(function (name) {
    uni[name] = baseApi[name];
  });

  {
    Object.keys(todoApis).forEach(function (name) {
      uni[name] = promisify(name, todoApis[name]);
    });
    Object.keys(extraApi).forEach(function (name) {
      uni[name] = promisify(name, todoApis[name]);
    });
  }

  Object.keys(eventApi).forEach(function (name) {
    uni[name] = eventApi[name];
  });

  Object.keys(api).forEach(function (name) {
    uni[name] = promisify(name, api[name]);
  });

  Object.keys(wx).forEach(function (name) {
    if (hasOwn(wx, name) || hasOwn(protocols, name)) {
      uni[name] = promisify(name, wrapper(name, wx[name]));
    }
  });
}

wx.createApp = createApp;
wx.createPage = createPage;
wx.createComponent = createComponent;

var uni$1 = uni;var _default =

uni$1;exports.default = _default;

/***/ }),

/***/ 1024:
/*!*****************************************************************!*\
  !*** J:/kesionEDU_APP/KS_EDU_APP/客户小程序/首冠小程序定制/mixins/index.js ***!
  \*****************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
Object.defineProperty(exports, "__esModule", { value: true });exports.default = void 0;var MIXINS = {
  exam: {
    data: function data() {
      var letterArr = [];

      for (var i = 65; i < 91; i++) {
        letterArr.push(String.fromCharCode(i));
      }

      return {
        letters: letterArr };

    },
    methods: {
      /**
                * 根据下标返回字母
                * @param {Number}
                */
      getLetter: function getLetter(i) {
        return this.letters[i];
      },

      /**
          * 根据子母返回下标
          * @param {Number}
          */
      getLetterIndex: function getLetterIndex(letter) {
        var index = 0;
        this.letters.map(function (ltr, i) {
          if (ltr == letter) {
            index = i;
          }
        });
        return index;
      } } } };var _default =



MIXINS;exports.default = _default;

/***/ }),

/***/ 1046:
/*!**************************************************************************************!*\
  !*** J:/kesionEDU_APP/KS_EDU_APP/客户小程序/首冠小程序定制/lib/polyv/common/player/polyv.min.js ***!
  \**************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
Object.defineProperty(exports, "__esModule", { value: true });exports.default = void 0;var _md = _interopRequireDefault(__webpack_require__(/*! ../utils/md5 */ 29));function _interopRequireDefault(obj) {return obj && obj.__esModule ? obj : { default: obj };}var polyvVodPlayer = { version: "v1.0.0", buidMetaData: 20190221, options: null, jsonHost: "https://router.polyv.net/proxy/player.polyv.net/secure/", isPreviewMode: !1, isWx: !1, token: "", seed: 0, state: "end", timeStamp: 0, time: 0, currentTime: 0, detailTime: 0, videoId: "", pid: "", uid: "", flow: 0, pd: 0, sd: 0, cts: 0, duration: 0, pn: "", pv: "", sign: "", sessionId: "", param1: "", param2: "", param3: "", param4: "", param5: "", getVideo: function getVideo(t) {this.loadJson(t);}, getPreviewVideo: function getPreviewVideo(t) {this.isPreviewMode = !0, this.loadJson(t);}, changeVid: function changeVid(t) {var e = t.vid,a = t.changeVidcallback;e && e.length > 0 && e !== this.videoId && (this.videoId = e, this.getVideoJson().then(function (t) {a(t);}).catch());}, loadJson: function loadJson(t) {var e = this.version;var a = { version: e, timeoutflow: !1, outflow: !1 };if (!t.vid) return a = { version: e, error: "vid不能为空" }, void t.callback(a);var r = "".concat(new Date().getTime(), "X").concat(Math.floor(1e6 * Math.random() + 1e6)),s = t.vid.substr(0, 10),i = this;i.videoId = t.vid, i.ts = t.ts, i.sign = t.sign, i.uid = s, i.pid = r, i.version = a.version, i.param1 = t.param1 || "", i.param2 = t.param2 || "", i.param3 = t.param3 || "", i.param4 = t.param4 || "", i.param5 = t.param5 || "", t.sid && (i.sessionId = t.sid), i.options = t, wx.request({ url: "".concat(i.jsonHost + t.vid, ".js"), method: "GET", success: function success(e) {"true" === e.data.timeoutflow ? a.timeoutflow = !0 : "true" === e.data.outflow ? a.outflow = !0 : (a.poster = e.data.first_image, a.title = e.data.title, a.teaser_url = e.data.teaser_url, a.catatree = e.data.catatree, a.adMatter = e.data.adMatter, a.ratio = e.data.ratio, a.duration = e.data.duration, a.poster = i.proxy(a.poster), a.teaser_url = i.proxy(a.teaser_url), a.adMatter = i.proxy(a.adMatter, "matterurl"), i.seed = e.data.seed, 1 === e.data.seed ? a.src = i.proxy(e.data.hls) : a.src = i.proxy(e.data.mp4), i.duration = e.data.duration), 1 === i.seed && t.wxApp && t.wxApp.isWx ? (i.isWx = !0, i.getWxToken(t, function (r) {i.token = r;for (var _r = 0; _r < e.data.hls.length; _r++) {t.hlstest ? a.src[_r] = i.resetUrl(e.data.hls[_r]).replace("hls.", "hlstest.") : a.src[_r] = i.resetUrl(e.data.hls[_r]);}t.callback(a);}, function () {a = { error: "播放token获取失败" }, t.callback(a);})) : t.callback(a), i.countInterval && clearInterval(i.countInterval), i.countInterval = setInterval(function () {i.countWholeTime();}, 1e3);}, fail: function fail(e) {a = { error: "视频数据获取失败" }, t.callback(a);} });}, getVideoJson: function getVideoJson() {var t = this;return new Promise(function (e, a) {wx.request({ url: "".concat(t.jsonHost).concat(t.videoId, ".js"), method: "GET", success: function success(a) {var r = {};"true" === a.data.timeoutflow ? (r.timeoutflow = !0, r.canplay = 0) : "true" === a.data.outflow ? (r.outflow = !0, r.canplay = 1) : (r.poster = a.data.first_image, r.title = a.data.title, r.teaser_url = a.data.teaser_url, r.catatree = a.data.catatree, r.adMatter = a.data.adMatter, r.ratio = a.data.ratio, r.duration = a.data.duration, r.poster = t.proxy(r.poster), r.teaser_url = t.proxy(r.teaser_url), r.adMatter = t.proxy(r.adMatter, "matterurl"), t.seed = a.data.seed, 1 === a.data.seed ? r.src = t.proxy(a.data.hls) : r.src = t.proxy(a.data.mp4), t.duration = a.data.duration), e(r);}, fail: function fail() {a();} });});}, getWxToken: function getWxToken(t, e) {var a = t.wxApp.wxAppUrl,r = new Date().getTime(),s = CModule.ccall("getsign", "string", ["string", "string", "string"], [t.wxApp.wxUserId, t.vid, r.toString()]),i = t.wxApp;i.iswxa = 1, i.vid = t.vid, i.ts = r, i.sign = s, wx.request({ url: a, method: "GET", data: i, success: function success(t) {var a = CModule.ccall("loadtoken", "string", ["string"], [t.data]);e(JSON.parse(a).data.token);}, fail: function fail() {} });}, timeUpdate: function timeUpdate(t) {t && t.detail && t.detail.currentTime && (this.detailTime = t.detail.currentTime);}, updateState: function updateState() {this.currentTime == this.detailTime ? this.state = "end" : (this.state = "played", this.currentTime = this.detailTime);}, countWholeTime: function countWholeTime() {var t = this,e = new Date().getTime();t.updateState(), "played" == this.state && (t.time += 1), e - t.timeStamp > 9e3 && (t.timeStamp = e, t.sendState());}, sendState: function sendState() {var t = this;var e = 0,a = 0;if (a = Math.floor(this.currentTime), (e = t.time) > 0 && "played" == t.state) {new Date().getTime();var s = "rtas.net".concat(t.pid).concat(t.videoId).concat(t.flow).concat(e).concat(a),i = (0, _md.default)(s),o = t.sessionId;var r = { pid: t.pid, uid: t.uid, vid: t.videoId, flow: 0, pd: e, sd: e, cts: a, duration: t.duration, pn: "webapp_vod_sdk", pv: t.version, sign: i, sid: o, param1: t.param1, param2: t.param2, param3: t.param3, param4: t.param4, param5: t.param5 };wx.request({ url: "https://router.polyv.net/proxy/prtas.videocc.net/v1/view", data: r });}}, proxy: function proxy(t, e) {var a = this;if (void 0 === t || 0 == t.length) return "";if ("string" == typeof t) return t = this.resetUrl(t), this.proxyUrl(t);if (arguments[1]) for (var r = 0, s = t.length; r < s; r++) {for (var _a in t[r]) {_a == e && (t[r][_a] = this.proxyUrl(t[r][_a]));}} else for (r = 0, s = t.length; r < s; r++) {if (this.isPreviewMode) {var _e = this.videoId.substring(0, 32);t[r] = t[r].replace(_e, "p_".concat(_e));}a.ts && a.sign && (t[r].indexOf("?") > -1 ? t[r] = "".concat(t[r], "&ts=").concat(a.ts, "&sign=").concat(a.sign) : t[r] = "".concat(t[r], "?ts=").concat(a.ts, "&sign=").concat(a.sign)), t[r] = this.proxyUrl(t[r]);}return t;}, proxyUrl: function proxyUrl(t) {return "" == t ? t : "https://router.polyv.net/proxy/".concat(t = t.replace(/.*?:\/\//g, ""));}, resetUrl: function resetUrl(t) {var e = this;if (this.isPreviewMode && 1 == e.seed) {var _e2 = this.videoId.substring(0, 32);t = t.replace(_e2, "p_".concat(_e2));}return e.ts && e.sign && (t = t.indexOf("?") > -1 ? "".concat(t, "&ts=").concat(e.ts, "&sign=").concat(e.sign) : "".concat(t, "?ts=").concat(e.ts, "&sign=").concat(e.sign)), e.isWx && (t = t.indexOf("?") > -1 ? "".concat(t, "&token=").concat(e.token, "&iswxa=1") + "&pid=".concat(e.pid) : "".concat(t, "?token=").concat(e.token, "&iswxa=1") + "&pid=".concat(e.pid)), t;} };var _default = polyvVodPlayer;exports.default = _default;

/***/ }),

/***/ 1089:
/*!***********************************************************************************!*\
  !*** J:/kesionEDU_APP/KS_EDU_APP/客户小程序/首冠小程序定制/lib/polyv/common/chat/emotions.js ***!
  \***********************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
var host = "https://livestatic.polyv.net/assets/images/em/",emotionslist = [{ url: host + "1.png", title: "微笑", position: "0px 0px" }, { url: host + "2.png", title: "撇嘴", position: "-48px 0px" }, { url: host + "3.png", title: "色", position: "-96px 0px" }, { url: host + "4.png", title: "发呆", position: "-144px 0px" }, { url: host + "5.png", title: "得意", position: "-192px 0px" }, { url: host + "6.png", title: "流泪", position: "-240px 0px" }, { url: host + "7.png", title: "害羞", position: "-288px 0px" }, { url: host + "8.png", title: "闭嘴", position: "-336px 0px" }, { url: host + "9.png", title: "睡", position: "-384px 0px" }, { url: host + "10.png", title: "大哭", position: "-432px 0px" }, { url: host + "11.png", title: "尴尬", position: "-480px 0px" }, { url: host + "12.png", title: "发怒", position: "-528px 0px" }, { url: host + "13.png", title: "调皮", position: "-576px 0px" }, { url: host + "14.png", title: "呲牙", position: "-624px 0px" }, { url: host + "15.png", title: "惊讶", position: "-672px 0px" }, { url: host + "16.png", title: "难过", position: "-720px 0px" }, { url: host + "17.png", title: "酷", position: "-768px 0px" }, { url: host + "18.png", title: "冷汗", position: "-816px 0px" }, { url: host + "19.png", title: "抓狂", position: "-864px 0px" }, { url: host + "20.png", title: "吐", position: "-912px 0px" }, { url: host + "21.png", title: "偷笑", position: "-960px 0px" }, { url: host + "22.png", title: "可爱", position: "-1008px 0px" }, { url: host + "23.png", title: "白眼", position: "-1056px 0px" }, { url: host + "24.png", title: "傲慢", position: "-1104px 0px" }, { url: host + "25.png", title: "饥饿", position: "-1152px 0px" }, { url: host + "26.png", title: "困", position: "-1200px 0px" }, { url: host + "27.png", title: "惊恐", position: "-1248px 0px" }, { url: host + "28.png", title: "流汗", position: "-1296px 0px" }, { url: host + "29.png", title: "憨笑", position: "-1344px 0px" }, { url: host + "30.png", title: "大兵", position: "-1392px 0px" }, { url: host + "31.png", title: "奋斗", position: "-1440px 0px" }, { url: host + "32.png", title: "咒骂", position: "-1488px 0px" }, { url: host + "33.png", title: "疑问", position: "-1536px 0px" }, { url: host + "34.png", title: "嘘", position: "-1584px 0px" }, { url: host + "35.png", title: "晕", position: "-1632px 0px" }, { url: host + "36.png", title: "折磨", position: "-1680px 0px" }, { url: host + "37.png", title: "衰", position: "-1728px 0px" }, { url: host + "38.png", title: "骷髅", position: "-1776px 0px" }, { url: host + "39.png", title: "敲打", position: "-1824px 0px" }, { url: host + "40.png", title: "再见", position: "-1872px 0px" }, { url: host + "41.png", title: "擦汗", position: "-1920px 0px" }, { url: host + "42.png", title: "抠鼻", position: "-1968px 0px" }, { url: host + "43.png", title: "鼓掌", position: "-2016px 0px" }, { url: host + "44.png", title: "糗大了", position: "-2064px 0px" }, { url: host + "45.png", title: "坏笑", position: "-2112px 0px" }, { url: host + "46.png", title: "左哼哼", position: "-2160px 0px" }, { url: host + "47.png", title: "右哼哼", position: "-2208px 0px" }, { url: host + "48.png", title: "哈欠", position: "-2256px 0px" }, { url: host + "49.png", title: "鄙视", position: "-2304px 0px" }, { url: host + "50.png", title: "委屈", position: "-2352px 0px" }, { url: host + "51.png", title: "快哭了", position: "-2400px 0px" }, { url: host + "52.png", title: "阴险", position: "-2448px 0px" }, { url: host + "53.png", title: "亲亲", position: "-2496px 0px" }, { url: host + "54.png", title: "吓", position: "-2544px 0px" }, { url: host + "55.png", title: "可怜", position: "-2592px 0px" }, { url: host + "56.png", title: "菜刀", position: "-2640px 0px" }, { url: host + "57.png", title: "西瓜", position: "-2688px 0px" }, { url: host + "58.png", title: "啤酒", position: "-2736px 0px" }, { url: host + "59.png", title: "篮球", position: "-2784px 0px" }, { url: host + "60.png", title: "乒乓", position: "-2832px 0px" }, { url: host + "61.png", title: "咖啡", position: "-2880px 0px" }, { url: host + "62.png", title: "饭", position: "-2928px 0px" }, { url: host + "63.png", title: "猪头", position: "-2976px 0px" }, { url: host + "64.png", title: "玫瑰", position: "-3024px 0px" }, { url: host + "65.png", title: "凋谢", position: "-3072px 0px" }, { url: host + "66.png", title: "示爱", position: "-3120px 0px" }, { url: host + "67.png", title: "爱心", position: "-3168px 0px" }, { url: host + "68.png", title: "心碎", position: "-3216px 0px" }, { url: host + "69.png", title: "蛋糕", position: "-3264px 0px" }, { url: host + "70.png", title: "闪电", position: "-3312px 0px" }, { url: host + "71.png", title: "炸弹", position: "-3360px 0px" }, { url: host + "72.png", title: "刀", position: "-3408px 0px" }, { url: host + "73.png", title: "足球", position: "-3456px 0px" }, { url: host + "74.png", title: "瓢虫", position: "-3504px 0px" }, { url: host + "75.png", title: "便便", position: "-3552px 0px" }, { url: host + "76.png", title: "月亮", position: "-3600px 0px" }, { url: host + "77.png", title: "太阳", position: "-3648px 0px" }, { url: host + "78.png", title: "礼物", position: "-3696px 0px" }, { url: host + "79.png", title: "拥抱", position: "-3744px 0px" }, { url: host + "80.png", title: "强", position: "-3792px 0px" }, { url: host + "81.png", title: "弱", position: "-3840px 0px" }, { url: host + "82.png", title: "握手", position: "-3888px 0px" }, { url: host + "83.png", title: "胜利", position: "-3936px 0px" }, { url: host + "84.png", title: "抱拳", position: "-3984px 0px" }, { url: host + "85.png", title: "勾引", position: "-4032px 0px" }, { url: host + "86.png", title: "拳头", position: "-4080px 0px" }, { url: host + "87.png", title: "差劲", position: "-4128px 0px" }, { url: host + "88.png", title: "爱你", position: "-4176px 0px" }, { url: host + "89.png", title: "NO", position: "-4224px 0px" }, { url: host + "90.png", title: "OK", position: "-4272px 0px" }, { url: host + "91.png", title: "爱情", position: "-4320px 0px" }, { url: host + "92.png", title: "飞吻", position: "-4368px 0px" }, { url: host + "93.png", title: "跳跳", position: "-4416px 0px" }, { url: host + "94.png", title: "发抖", position: "-4464px 0px" }, { url: host + "95.png", title: "怄火", position: "-4512px 0px" }, { url: host + "96.png", title: "转圈", position: "-4560px 0px" }, { url: host + "97.png", title: "磕头", position: "-4608px 0px" }, { url: host + "98.png", title: "回头", position: "-4656px 0px" }, { url: host + "99.png", title: "跳绳", position: "-4704px 0px" }, { url: host + "100.png", title: "挥手", position: "-4752px 0px" }],emotionSearchObj = {};emotionslist.forEach(function (t) {emotionSearchObj[t.title] = t;}), module.exports.emotionslist = emotionslist, module.exports.emotionSearchObj = emotionSearchObj;

/***/ }),

/***/ 1097:
/*!******************************************************************************************!*\
  !*** J:/kesionEDU_APP/KS_EDU_APP/客户小程序/首冠小程序定制/lib/polyv/common/player/polyvlive.min.js ***!
  \******************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
Object.defineProperty(exports, "__esModule", { value: true });exports.default = void 0;var _regenerator = _interopRequireDefault(__webpack_require__(/*! ./node_modules/@babel/runtime/regenerator */ 20));var _md = _interopRequireDefault(__webpack_require__(/*! ../../common/utils/md5 */ 29));var _jsBase = __webpack_require__(/*! ../../common/utils/js-base64 */ 1098);var _index = _interopRequireDefault(__webpack_require__(/*! ../../common/api/index */ 39));var _runtimeModule = _interopRequireDefault(__webpack_require__(/*! ../../common/regenerator-runtime/runtime-module */ 23));function _interopRequireDefault(obj) {return obj && obj.__esModule ? obj : { default: obj };}function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) {try {var info = gen[key](arg);var value = info.value;} catch (error) {reject(error);return;}if (info.done) {resolve(value);} else {Promise.resolve(value).then(_next, _throw);}}function _asyncToGenerator(fn) {return function () {var self = this,args = arguments;return new Promise(function (resolve, reject) {var gen = fn.apply(self, args);function _next(value) {asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value);}function _throw(err) {asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err);}_next(undefined);});};}function _classCallCheck(instance, Constructor) {if (!(instance instanceof Constructor)) {throw new TypeError("Cannot call a class as a function");}}function _defineProperties(target, props) {for (var i = 0; i < props.length; i++) {var descriptor = props[i];descriptor.enumerable = descriptor.enumerable || false;descriptor.configurable = true;if ("value" in descriptor) descriptor.writable = true;Object.defineProperty(target, descriptor.key, descriptor);}}function _createClass(Constructor, protoProps, staticProps) {if (protoProps) _defineProperties(Constructor.prototype, protoProps);if (staticProps) _defineProperties(Constructor, staticProps);return Constructor;}var getChannelJson = Symbol("getChannelJson"),descryptChannelJson = Symbol("descryptChannelJson"),handleJson = Symbol("handleJson"),promiseRequest = Symbol("promiseRequest");var PolyLive = /*#__PURE__*/function () {function PolyLive() {_classCallCheck(this, PolyLive);this.version = "v2.1.0", this.buildMetaData = "20190626", this.channel = {}, this.ProxyFieldArr = [], this.sendRtasTime = 10, this.apiState = "", this.apiTime = 6e3, this.apiCheckTs = 0, this.netWorkTime = 6e3, this.netWorkTs = 0, this.rtasTS = 0, this.renderInterval = null, this.playTime = 0, this.playState = "", this.stateType = { playing: "playing", pause: "pause", end: "end" }, this.changingType = "live", this.vodCurrentTime = 0, this.vodRecordTime = 0, this.uid = "", this.cid = "", this.isAutoChange = !1, this.vodsrc = "", this.success = function () {}, this.onChangeType = function () {}, this.onApiStatus = function () {}, this.onNetWorkChange = function () {}, this.statistics = {};}_createClass(PolyLive, [{ key: "resetConfig", value: function resetConfig(t) {return !(!t.uid || !t.vid) && (Object.assign(this, t), this.uid = t.uid, this.cid = t.vid, this.isSkinWhite = t.isSkinWhite, this.config = new Map([["ROUTER_HOST", "https://router.polyv.net/proxy/"], ["ASSETS_HOST", "livestatic.videocc.net/assets/wimages/"], ["JSON_URL", "https://router.polyv.net/proxy/player.polyv.net/service/v1/channel_".concat(this.uid, "_").concat(this.cid, ".json?ran=").concat(Math.floor(9999999 * Math.random()))], ["API_HOST", "https://api.polyv.net/live_status/query?stream="], ["RTAS_URL", "https://router.polyv.net/proxy/rtas.videocc.net/v2/view"]]), this.ProxyFieldArr = ["coverImage", "waitImage", "logoImage", "logoHref"], this.timeStamp = this.getDate(), t.vodsrc || (this.vodsrc = ""), this.handleRtas(), !0);} }, { key: "getRestrict", value: function getRestrict() {var _this = this;var t = { uid: this.uid, cid: this.vid, pageDomain: "https://live.polyv.cn" };return new Promise(function (e, s) {_index.default.getRestrict(t).then(function (t) {200 === t.statusCode ? e(t.data) : _this.getBackRestrict().then(function (t) {e(t);}).catch(function (t) {s(t);});}).catch(function () {_this.getBackRestrict().then(function (t) {e(t);}).catch(function (t) {s(t);});});});} }, { key: "getBackRestrict", value: function getBackRestrict() {var t = { uid: this.uid, vid: this.vid, pageDomain: "https://live.polyv.cn" };return new Promise(function (e, s) {_index.default.getBackRestrict(t).then(function (t) {200 === t.statusCode ? e(t.data) : s({ msg: "fail" });}).catch(function () {return s({ msg: "fail" });});});} }, { key: "getVideo", value: function getVideo(t) {var _this2 = this;this.resetConfig(t) && this.getRestrict().then(function (t) {t.canWatch ? _this2.normalPlay() : _this2.success(t);}).catch(function (t) {_this2.normalPlay();});} }, { key: "normalPlay", value: function normalPlay() {var _this3 = this;this[getChannelJson]().then(function () {var t = { flvSrc: _this3.channel.flvSrc, src: _this3.channel.src, poster: _this3.channel.coverImage };"function" == typeof _this3.success && _this3.success(t);}), this.setPlayId(), this.startRender();} }, { key: "getReconnectSrc", value: function getReconnectSrc(t) {var _this4 = this;this[getChannelJson]().then(function () {"function" == typeof t && t(_this4.channel.flvSrc);});} }, { key: "changeSessionId", value: function changeSessionId(t) {this.statistics.session_id = t, this.handleRtas();} }, { key: "changeLiveMode", value: function changeLiveMode() {} }, { key: "changeVodMode", value: function changeVodMode() {} }, { key: "updateTime", value: function updateTime(t) {"vod" === !this.changingType && (this.changingType = "vod"), this.vodCurrentTime = t;} }, { key: "destroy", value: function destroy() {this.renderInterval && (clearInterval(this.renderInterval), this.renderInterval = null);} }, { key: "startRender", value: function startRender() {var _this5 = this;this.destroy(), this.renderInterval = setInterval(function () {_this5.startCheckApi(), _this5.sendRtas(), _this5.startCheckNetWork();}, 1e3);} }, { key: getChannelJson, value: function () {var _value = _asyncToGenerator( /*#__PURE__*/_regenerator.default.mark(function _callee() {var t, e;return _regenerator.default.wrap(function _callee$(_context) {while (1) {switch (_context.prev = _context.next) {case 0:t = this.config.get("JSON_URL");_context.next = 3;return this[promiseRequest](t);case 3:e = _context.sent;_context.next = 6;return this[handleJson](e);case 6:case "end":return _context.stop();}}}, _callee, this);}));function value() {return _value.apply(this, arguments);}return value;}() }, { key: handleJson, value: function value(t) {var _this6 = this;Object.keys(t).forEach(function (e, s, i) {_this6.ProxyFieldArr.includes(e) && (t[e] = _this6.proxyUrl(t[e]));}), t.src = t.lines[0].m3u8, "Y" === t.isOnlyAudio && (t.src = this.concatSrc(t.src, "only-audio=1")), t.flvSrc = t.lines[0].flv, this.sendRtasTime = t.reportFreq || this.sendRtasTime, this.channel = {}, Object.assign(this.channel, t);} }, { key: descryptChannelJson, value: function value() {} }, { key: promiseRequest, value: function value(t) {var e = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};return new Promise(function (s, i) {wx.request({ url: t, method: "GET", data: e, success: function success(t) {s(t.data);} });});} }, { key: "concatSrc", value: function concatSrc(t, e) {return t.include("?") ? "".concat(t, "&").concat(e) : "".concat(t, "?").concat(e);} }, { key: "handleRtas", value: function handleRtas() {for (var t in this.statistics) {this.statistics[t] = _jsBase.Base64.encodeURI(this.statistics[t]);}/vod|live/i.test(this.changingType) && (this.statistics.param3 = _jsBase.Base64.encodeURI(this.changingType));} }, { key: "startCheckNetWork", value: function startCheckNetWork() {var _this7 = this;var t = Date.now();t - this.netWorkTs > this.netWorkTime && (this.netWorkTs = t, wx.getNetworkType({ success: function success(t) {var e = t.networkType;_this7.onNetWorkChange && _this7.onNetWorkChange("none" === e);} }));} }, { key: "startCheckApi", value: function startCheckApi() {var _this8 = this;var t = Date.now();t - this.apiCheckTs > this.apiTime && (this.apiCheckTs = t, _asyncToGenerator( /*#__PURE__*/_regenerator.default.mark(function _callee2() {var t;return _regenerator.default.wrap(function _callee2$(_context2) {while (1) {switch (_context2.prev = _context2.next) {case 0:if (_this8.channel.stream) {_context2.next = 2;break;}return _context2.abrupt("return");case 2:_context2.next = 4;return _this8[promiseRequest]("".concat(_this8.config.get("API_HOST")).concat(_this8.channel.stream));case 4:t = _context2.sent;_this8.updateApiState(t.trim());case 6:case "end":return _context2.stop();}}}, _callee2, this);}))());} }, { key: "updateApiState", value: function updateApiState(t) {var _this9 = this;_asyncToGenerator( /*#__PURE__*/_regenerator.default.mark(function _callee3() {var e, s, i, a, _t;return _regenerator.default.wrap(function _callee3$(_context3) {while (1) {switch (_context3.prev = _context3.next) {case 0:e = "", s = "", i = null;a = t;if (!(a !== _this9.apiState)) {_context3.next = 17;break;}_this9.apiState = a;if (!("end" === a)) {_context3.next = 10;break;}_context3.next = 7;return _this9.getLatestVodSrc();case 7:e = (i = _context3.sent).recordUrl;_context3.next = 15;break;case 10:_this9.playState = _this9.stateType.playing;_context3.next = 13;return _this9.getChannel();case 13:e = (i = _context3.sent).src;s = i.flvSrc;case 15:_t = { apiState: _this9.apiState, coverImage: i.coverImage, waitImage: i.waitImage, liveType: i.liveType, latestSrc: e, latestFlvSrc: s };_this9.updateChangeType(_t), _this9.onApiStatus && _this9.onApiStatus(_this9.apiState);case 17:case "end":return _context3.stop();}}}, _callee3, this);}))();} }, { key: "getChannel", value: function getChannel() {var _this10 = this;var t = this;return new Promise(function (e, s) {wx.request({ url: _this10.config.get("JSON_URL"), method: "GET", success: function success(s) {var i = {};i.title = s.data.name, i.src = s.data.m3u8Url, i.poster = t.proxyUrl(s.data.coverImage), i.waitImage = t.proxyUrl(s.data.waitImage), i.logoImage = t.proxyUrl(s.data.logoImage), i.logoHref = t.proxyUrl(s.data.logoHref), i.logoOpacity = s.data.logoOpacity, i.logoPosition = s.data.logoPosition, i.liveType = s.data.liveType;var a = i.src;"Y" === s.data.isOnlyAudio && (a.indexOf("?") > -1 ? i.src = "".concat(i.src, "&only-audio=1") : i.src = "".concat(i.src, "?only-audio=1")), i.flvSrc = "".concat(s.data.url + s.data.stream, ".flv"), "Y" == s.data.isNgbEnabled ? i.flvSrc = "".concat(s.data.ngbUrl + s.data.stream, ".flv") : "Y" == s.data.isUrlProtected && (i.flvSrc = "".concat(s.data.bakUrl + s.data.stream, ".flv")), "Y" == s.data.isUrlProtected && (i.flvSrc = "".concat(i.flvSrc, "?wsSecret=").concat(s.data.streamSign, "&wsTime=").concat(s.data.currentTimeSecs)), i.flvSrc = i.flvSrc, e(i);} });});} }, { key: "getLatestVodSrc", value: function getLatestVodSrc() {var t = this;return new Promise(function (e, s) {wx.request({ url: "https://router.polyv.net/proxy/player.polyv.net/service/v1/channel_".concat(t.uid, "_").concat(t.cid, ".json?ran=").concat(Math.floor(9999999 * Math.random())), method: "GET", success: function success(s) {var i = s.data.recordFileM3u8Url,a = s.data.recordFileUrl,n = s.data.coverImage,r = s.data.waitImage,h = s.data.liveType;var o = a || "";o || (o = i || ""), t.recordFileTest && (o = a || ""), e({ recordUrl: o, coverImage: n, waitImage: r, liveType: h });} });});} }, { key: "updateChangeType", value: function updateChangeType(t) {if (t.coverImage && (t.coverImage = t.coverImage.replace("livestatic.videocc.net", "router.polyv.net/proxy/livestatic.videocc.net")), !t.coverImage) {var _e = "".concat(this.config.get("ROUTER_HOST")).concat(this.config.get("ASSETS_HOST"), "mini-images/nolive_webapp_ppt.png"),s = "".concat(this.config.get("ROUTER_HOST")).concat(this.config.get("ASSETS_HOST"), "player/ppt/nolive_ppt_white.png");t.coverImage = this.isSkinWhite ? s : _e;}var e = !1;"live" !== t.apiState ? t.latestSrc.length > 0 && this.isAutoChange ? (this.changingType = "vod", e = !0) : t.waitImage.length > 0 && t.waitImage.indexOf(".mp4") > 0 ? (this.changingType = "warmVideo", t.latestSrc = t.waitImage) : t.coverImage.length > 0 && (t.coverImage.indexOf(".png") > 0 || t.coverImage.indexOf(".jpg") > 0 || t.coverImage.indexOf(".gif") > 0) && (this.changingType = "warmImage", t.latestSrc = t.coverImage) : "live" === t.apiState && t.latestSrc.length > 0 && (this.changingType = "live", e = !0), this.vodsrc && (this.changingType = "vod", t.latestSrc = this.vodsrc), /vod|live/i.test(this.changingType) && (this.statistics.param3 = _jsBase.Base64.encodeURI(this.changingType)), e && !this.vodsrc && (this.setPlayId(), this.playTime = 0), this.onChangeType && this.onChangeType(this.changingType, t.latestSrc, t.latestFlvSrc);} }, { key: "sendRtas", value: function sendRtas() {"live" === this.changingType && "live" === this.apiState && this.playTime++, "vod" === this.changingType && (this.vodRecordTime !== this.vodCurrentTime ? (this.playState = this.stateType.playing, this.vodRecordTime = this.vodCurrentTime, this.playTime++) : this.playState = this.stateType.pause);var t = Date.now(),e = t - this.rtasTS > 1e3 * this.sendRtasTime,s = this.playState === this.stateType.playing || this.playState === this.stateType.end,_this$statistics = this.statistics,i = _this$statistics.param1,a = _this$statistics.param2,n = _this$statistics.param3,r = _this$statistics.param4,h = _this$statistics.param5,o = _this$statistics.session_id;if (e && this.playTime > this.sendRtasTime && s) {this.rtasTS = t;var _e2 = this.getDate(),_s = "rtas.net".concat(this.pid).concat(this.cid, "0").concat(this.playTime),c = "".concat((0, _md.default)(_s)),l = { pid: this.pid, uid: this.uid, cid: this.cid, pd: this.playTime, sd: this.playTime, sign: c, flow: 0, ts: _e2, pn: "webapp_sdk_live", pv: "".concat(this.version, "_").concat(this.buildMetaData), param1: i, param2: a, param3: n, param4: r, param5: h, session_id: o };this.rtasTS = t, this[promiseRequest](this.config.get("RTAS_URL"), l);}} }, { key: "setPlayId", value: function setPlayId() {var t = "".concat(Date.now()),e = "".concat(parseInt(1e6 * Math.random() + 1e6));this.pid = "".concat(t, "X").concat(e);} }, { key: "proxyUrl", value: function proxyUrl(t) {return "" === (t = t.replace(/.*?:\/\//g, "")) ? t : "https://router.polyv.net/proxy/".concat(t);} }, { key: "getDate", value: function getDate() {return Date.now();} }]);return PolyLive;}();exports.default = PolyLive;

/***/ }),

/***/ 1098:
/*!*************************************************************************************!*\
  !*** J:/kesionEDU_APP/KS_EDU_APP/客户小程序/首冠小程序定制/lib/polyv/common/utils/js-base64.js ***!
  \*************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
/* WEBPACK VAR INJECTION */(function(global) {var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;!function (e, r) { true ? module.exports = r(e) : undefined;}("undefined" != typeof self ? self : "undefined" != typeof window ? window : "undefined" != typeof global ? global : void 0, function (global) {"use strict";var _Base64 = global.Base64,version = "2.5.0",buffer;if ( true && module.exports) try {buffer = eval("require('buffer').Buffer");} catch (e) {buffer = void 0;}var b64chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/",b64tab = function (e) {for (var r = {}, o = 0, t = e.length; o < t; o++) {r[e.charAt(o)] = o;}return r;}(b64chars),fromCharCode = String.fromCharCode,cb_utob = function cb_utob(e) {if (e.length < 2) return (r = e.charCodeAt(0)) < 128 ? e : r < 2048 ? fromCharCode(192 | r >>> 6) + fromCharCode(128 | 63 & r) : fromCharCode(224 | r >>> 12 & 15) + fromCharCode(128 | r >>> 6 & 63) + fromCharCode(128 | 63 & r);var r = 65536 + 1024 * (e.charCodeAt(0) - 55296) + (e.charCodeAt(1) - 56320);return fromCharCode(240 | r >>> 18 & 7) + fromCharCode(128 | r >>> 12 & 63) + fromCharCode(128 | r >>> 6 & 63) + fromCharCode(128 | 63 & r);},re_utob = /[\uD800-\uDBFF][\uDC00-\uDFFFF]|[^\x00-\x7F]/g,utob = function utob(e) {return e.replace(re_utob, cb_utob);},cb_encode = function cb_encode(e) {var r = [0, 2, 1][e.length % 3],o = e.charCodeAt(0) << 16 | (e.length > 1 ? e.charCodeAt(1) : 0) << 8 | (e.length > 2 ? e.charCodeAt(2) : 0);return [b64chars.charAt(o >>> 18), b64chars.charAt(o >>> 12 & 63), r >= 2 ? "=" : b64chars.charAt(o >>> 6 & 63), r >= 1 ? "=" : b64chars.charAt(63 & o)].join("");},btoa = global.btoa ? function (e) {return global.btoa(e);} : function (e) {return e.replace(/[\s\S]{1,3}/g, cb_encode);},_encode = buffer ? buffer.from && Uint8Array && buffer.from !== Uint8Array.from ? function (e) {return (e.constructor === buffer.constructor ? e : buffer.from(e)).toString("base64");} : function (e) {return (e.constructor === buffer.constructor ? e : new buffer(e)).toString("base64");} : function (e) {return btoa(utob(e));},encode = function encode(e, r) {return r ? _encode(String(e)).replace(/[+\/]/g, function (e) {return "+" == e ? "-" : "_";}).replace(/=/g, "") : _encode(String(e));},encodeURI = function encodeURI(e) {return encode(e, !0);},re_btou = new RegExp(["[À-ß][-¿]", "[à-ï][-¿]{2}", "[ð-÷][-¿]{3}"].join("|"), "g"),cb_btou = function cb_btou(e) {switch (e.length) {case 4:var r = ((7 & e.charCodeAt(0)) << 18 | (63 & e.charCodeAt(1)) << 12 | (63 & e.charCodeAt(2)) << 6 | 63 & e.charCodeAt(3)) - 65536;return fromCharCode(55296 + (r >>> 10)) + fromCharCode(56320 + (1023 & r));case 3:return fromCharCode((15 & e.charCodeAt(0)) << 12 | (63 & e.charCodeAt(1)) << 6 | 63 & e.charCodeAt(2));default:return fromCharCode((31 & e.charCodeAt(0)) << 6 | 63 & e.charCodeAt(1));}},btou = function btou(e) {return e.replace(re_btou, cb_btou);},cb_decode = function cb_decode(e) {var r = e.length,o = r % 4,t = (r > 0 ? b64tab[e.charAt(0)] << 18 : 0) | (r > 1 ? b64tab[e.charAt(1)] << 12 : 0) | (r > 2 ? b64tab[e.charAt(2)] << 6 : 0) | (r > 3 ? b64tab[e.charAt(3)] : 0),n = [fromCharCode(t >>> 16), fromCharCode(t >>> 8 & 255), fromCharCode(255 & t)];return n.length -= [0, 0, 2, 1][o], n.join("");},_atob = global.atob ? function (e) {return global.atob(e);} : function (e) {return e.replace(/\S{1,4}/g, cb_decode);},atob = function atob(e) {return _atob(String(e).replace(/[^A-Za-z0-9\+\/]/g, ""));},_decode = buffer ? buffer.from && Uint8Array && buffer.from !== Uint8Array.from ? function (e) {return (e.constructor === buffer.constructor ? e : buffer.from(e, "base64")).toString();} : function (e) {return (e.constructor === buffer.constructor ? e : new buffer(e, "base64")).toString();} : function (e) {return btou(_atob(e));},decode = function decode(e) {return _decode(String(e).replace(/[-_]/g, function (e) {return "-" == e ? "+" : "/";}).replace(/[^A-Za-z0-9\+\/]/g, ""));},noConflict = function noConflict() {var e = global.Base64;return global.Base64 = _Base64, e;};if (global.Base64 = { VERSION: version, atob: atob, btoa: btoa, fromBase64: decode, toBase64: encode, utob: utob, encode: encode, encodeURI: encodeURI, btou: btou, decode: decode, noConflict: noConflict, __buffer__: buffer }, "function" == typeof Object.defineProperty) {var noEnum = function noEnum(e) {return { value: e, enumerable: !1, writable: !0, configurable: !0 };};global.Base64.extendString = function () {Object.defineProperty(String.prototype, "fromBase64", noEnum(function () {return decode(this);})), Object.defineProperty(String.prototype, "toBase64", noEnum(function (e) {return encode(this, e);})), Object.defineProperty(String.prototype, "toBase64URI", noEnum(function () {return encode(this, !0);}));};}return global.Meteor && (Base64 = global.Base64),  true && module.exports ? module.exports.Base64 = global.Base64 :  true && !(__WEBPACK_AMD_DEFINE_ARRAY__ = [], __WEBPACK_AMD_DEFINE_RESULT__ = (function () {return global.Base64;}).apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__)), { Base64: global.Base64 };});
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! ./../../../../../../../../软件/HBuilderX.1.9.4.20190426/HBuilderX/plugins/uniapp-cli/node_modules/webpack/buildin/global.js */ 3)))

/***/ }),

/***/ 14:
/*!********************************************************************!*\
  !*** ./node_modules/vue-loader/lib/runtime/componentNormalizer.js ***!
  \********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return normalizeComponent; });
/* globals __VUE_SSR_CONTEXT__ */

// IMPORTANT: Do NOT use ES2015 features in this file (except for modules).
// This module is a runtime utility for cleaner component module output and will
// be included in the final webpack user bundle.

function normalizeComponent (
  scriptExports,
  render,
  staticRenderFns,
  functionalTemplate,
  injectStyles,
  scopeId,
  moduleIdentifier, /* server only */
  shadowMode /* vue-cli only */
) {
  // Vue.extend constructor export interop
  var options = typeof scriptExports === 'function'
    ? scriptExports.options
    : scriptExports

  // render functions
  if (render) {
    options.render = render
    options.staticRenderFns = staticRenderFns
    options._compiled = true
  }

  // functional template
  if (functionalTemplate) {
    options.functional = true
  }

  // scopedId
  if (scopeId) {
    options._scopeId = 'data-v-' + scopeId
  }

  var hook
  if (moduleIdentifier) { // server build
    hook = function (context) {
      // 2.3 injection
      context =
        context || // cached call
        (this.$vnode && this.$vnode.ssrContext) || // stateful
        (this.parent && this.parent.$vnode && this.parent.$vnode.ssrContext) // functional
      // 2.2 with runInNewContext: true
      if (!context && typeof __VUE_SSR_CONTEXT__ !== 'undefined') {
        context = __VUE_SSR_CONTEXT__
      }
      // inject component styles
      if (injectStyles) {
        injectStyles.call(this, context)
      }
      // register component module identifier for async chunk inferrence
      if (context && context._registeredComponents) {
        context._registeredComponents.add(moduleIdentifier)
      }
    }
    // used by ssr in case component is cached and beforeCreate
    // never gets called
    options._ssrRegister = hook
  } else if (injectStyles) {
    hook = shadowMode
      ? function () { injectStyles.call(this, this.$root.$options.shadowRoot) }
      : injectStyles
  }

  if (hook) {
    if (options.functional) {
      // for template-only hot-reload because in that case the render fn doesn't
      // go through the normalizer
      options._injectStyles = hook
      // register for functioal component in vue file
      var originalRender = options.render
      options.render = function renderWithStyleInjection (h, context) {
        hook.call(context)
        return originalRender(h, context)
      }
    } else {
      // inject component registration as beforeCreate hook
      var existing = options.beforeCreate
      options.beforeCreate = existing
        ? [].concat(existing, hook)
        : [hook]
    }
  }

  return {
    exports: scriptExports,
    options: options
  }
}


/***/ }),

/***/ 140:
/*!****************************************************************!*\
  !*** J:/kesionEDU_APP/KS_EDU_APP/客户小程序/首冠小程序定制/api/teacher.js ***!
  \****************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
Object.defineProperty(exports, "__esModule", { value: true });exports.GetAllTeacherList = GetAllTeacherList;exports.GetTeacherInfo = GetTeacherInfo;exports.SaveTeacherEvaluate = SaveTeacherEvaluate;exports.GetWordsList = GetWordsList;exports.SaveTeacherWords = SaveTeacherWords;exports.DoCollect = DoCollect;var _mainEntrance = __webpack_require__(/*! ./main.entrance.js */ 18);



// 名师列表
function GetAllTeacherList(params) {
  return (0, _mainEntrance.GET)('/webapi/app/GetAllTeacherList', params);
}

// 名师详情
function GetTeacherInfo(params) {
  return (0, _mainEntrance.GET)('/webapi/app/GetTeacherInfo', params, ['appToken', 'userId']);
}

// 名师评价
function SaveTeacherEvaluate(params) {
  return (0, _mainEntrance.POST)('/webapi/app/SaveTeacherEvaluate', params, ['appToken', 'userId']);
}

// 留言列表
function GetWordsList(params) {
  return (0, _mainEntrance.GET)('/webapi/app/GetWordsList', params, ['appToken', 'userId']);
}

// 留言
function SaveTeacherWords(params) {
  return (0, _mainEntrance.GET)('/webapi/app/SaveTeacherWords', params, ['appToken', 'userId']);
}

// 收藏
function DoCollect(params) {
  return (0, _mainEntrance.POST)('/webapi/app/DoCollect', params, ['appToken', 'userId']);
}

/***/ }),

/***/ 15:
/*!****************************************************************!*\
  !*** J:/kesionEDU_APP/KS_EDU_APP/客户小程序/首冠小程序定制/store/index.js ***!
  \****************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
/* WEBPACK VAR INJECTION */(function(uni) {Object.defineProperty(exports, "__esModule", { value: true });exports.default = void 0;var _vue = _interopRequireDefault(__webpack_require__(/*! vue */ 2));
var _vuex = _interopRequireDefault(__webpack_require__(/*! vuex */ 16));
var _user = __webpack_require__(/*! ../api/user */ 17);function _interopRequireDefault(obj) {return obj && obj.__esModule ? obj : { default: obj };}



_vue.default.use(_vuex.default);
var store = new _vuex.default.Store({
  state: {
    siteName: '首冠网校',
    isLogin: 0,
    userInfo: {},

    appToken: '',
    userId: '',
    readyStatus: false,
    schoolId: '',
    model: [],
    wechatOpenID: '',
    // SRC:'http://192.168.1.2:70',
    //SRC:'http://www.xkvo.net',
    // SRC:'https://e.kesion.com',
    SRC: 'https://www.shouguan.cn',
    isshowprice: true,

    JSONList: [],
    versionNum: '1.2',
    //APP是否开启缓存
    isCache: false },

  mutations: {
    /**
                * 设置状态
                */
    setState: function setState(state) {var data = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
      var keys = Object.keys(data);
      keys.map(function (k) {
        state[k] = data[k];
      });
    },
    updateUserInfo: function updateUserInfo(state, data) {
      state.isLogin = data.UserID > 0 ? 1 : 0,
      data.UserFace = data.UserFace + '?' + Math.ceil(Math.random() * 9999999999);
      state.userInfo = data;
      state.appToken = data.ApiToken || '';
      state.userId = data.UserID || '';
      state.schoolId = data.SchoolID || '';
      state.readyStatus = true;
    } },

  actions: {
    /**
              * 获取用户信息
              */
    getUserInfo: function getUserInfo(_ref) {var commit = _ref.commit;
      return new Promise(function (resolve) {
        (0, _user.GetUserInfo)().then(function (response) {
          var data = response.data[0];
          commit('updateUserInfo', data);
          resolve();
        });
      });
    },
    /**
        * 获取微信小程序当前用户的openID
        */
    getWechatOpenID: function getWechatOpenID() {var _this = this;
      return new Promise(function (resolve) {

        if (_this.state.wechatOpenID) {
          resolve(_this.state.wechatOpenID);
        } else {
          uni.login({
            provider: 'weixin',
            success: function success(loginRes) {
              if (loginRes.code) {
                (0, _user.GetMiniProgramOpenID)({
                  code: loginRes.code }).
                then(function (res) {
                  if (res.openId) {
                    store.commit('setState', {
                      wechatOpenID: res.openId });

                    resolve(res.openId);
                  } else {
                    resolve('unableget');
                  }

                });
              }
            } });

        }

      });
    },
    /**
        * 账号登陆
        */
    login: function login(store) {var data = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
      return new Promise(function (resolve) {
        store.commit('setState', {
          readyStatus: false });

        var params = false;

        if (data.username && data.password) {
          params = data;
        } else {
          /** 已存储用用户名、密码，自动登录获取apptoken*/
          if (uni.getStorageSync('userName') && uni.getStorageSync('passWord')) {
            params = {
              username: uni.getStorageSync('userName'),
              password: uni.getStorageSync('passWord') };

          }
        }
        if (params) {
          (0, _user.Login)(params).then(function (res) {
            store.dispatch('getIsVerify').then(function () {
              if (res.result) {
                uni.setStorageSync('userName', params.username);
                uni.setStorageSync('passWord', params.password);
                store.commit('updateUserInfo', res.data[0]);
              } else {
                store.commit('updateUserInfo', {});
              }
              resolve(res);
            });
          });
        } else {
          store.dispatch('getIsVerify').then(function () {
            store.commit('updateUserInfo', {});
          });

        }
      });
    },
    getIsVerify: function getIsVerify(store) {
      return new Promise(function (resolve) {
        (0, _user.GetIsVerify)().then(function (res) {
          store.commit('setState', {
            isCache: res.iscache });


          store.commit('setState', {
            isshowprice: res.isshowprice });








          resolve();
        });
      });
    },
    /**
        * 账号退出
        */
    loginout: function loginout() {
      return new Promise(function (resolve) {
        uni.setStorageSync('userName', '');
        uni.setStorageSync('passWord', '');
        store.commit('updateUserInfo', {});
        resolve();
      });
    } } });


store.dispatch('login');

/**
                          * 添加ready事件
                          */
store.ready = function (callback) {var _this2 = this;
  if (this.state.readyStatus) {
    callback(this.state);
  } else {
    setTimeout(function () {
      _this2.ready(callback);
    }, 100);
  }
};var _default =

store;exports.default = _default;
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! ./node_modules/@dcloudio/uni-mp-weixin/dist/index.js */ 1)["default"]))

/***/ }),

/***/ 16:
/*!********************************************!*\
  !*** ./node_modules/vuex/dist/vuex.esm.js ***!
  \********************************************/
/*! exports provided: Store, install, mapState, mapMutations, mapGetters, mapActions, createNamespacedHelpers, default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "Store", function() { return Store; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "install", function() { return install; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "mapState", function() { return mapState; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "mapMutations", function() { return mapMutations; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "mapGetters", function() { return mapGetters; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "mapActions", function() { return mapActions; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "createNamespacedHelpers", function() { return createNamespacedHelpers; });
/**
 * vuex v3.0.1
 * (c) 2017 Evan You
 * @license MIT
 */
var applyMixin = function (Vue) {
  var version = Number(Vue.version.split('.')[0]);

  if (version >= 2) {
    Vue.mixin({ beforeCreate: vuexInit });
  } else {
    // override init and inject vuex init procedure
    // for 1.x backwards compatibility.
    var _init = Vue.prototype._init;
    Vue.prototype._init = function (options) {
      if ( options === void 0 ) options = {};

      options.init = options.init
        ? [vuexInit].concat(options.init)
        : vuexInit;
      _init.call(this, options);
    };
  }

  /**
   * Vuex init hook, injected into each instances init hooks list.
   */

  function vuexInit () {
    var options = this.$options;
    // store injection
    if (options.store) {
      this.$store = typeof options.store === 'function'
        ? options.store()
        : options.store;
    } else if (options.parent && options.parent.$store) {
      this.$store = options.parent.$store;
    }
  }
};

var devtoolHook =
  typeof window !== 'undefined' &&
  window.__VUE_DEVTOOLS_GLOBAL_HOOK__;

function devtoolPlugin (store) {
  if (!devtoolHook) { return }

  store._devtoolHook = devtoolHook;

  devtoolHook.emit('vuex:init', store);

  devtoolHook.on('vuex:travel-to-state', function (targetState) {
    store.replaceState(targetState);
  });

  store.subscribe(function (mutation, state) {
    devtoolHook.emit('vuex:mutation', mutation, state);
  });
}

/**
 * Get the first item that pass the test
 * by second argument function
 *
 * @param {Array} list
 * @param {Function} f
 * @return {*}
 */
/**
 * Deep copy the given object considering circular structure.
 * This function caches all nested objects and its copies.
 * If it detects circular structure, use cached copy to avoid infinite loop.
 *
 * @param {*} obj
 * @param {Array<Object>} cache
 * @return {*}
 */


/**
 * forEach for object
 */
function forEachValue (obj, fn) {
  Object.keys(obj).forEach(function (key) { return fn(obj[key], key); });
}

function isObject (obj) {
  return obj !== null && typeof obj === 'object'
}

function isPromise (val) {
  return val && typeof val.then === 'function'
}

function assert (condition, msg) {
  if (!condition) { throw new Error(("[vuex] " + msg)) }
}

var Module = function Module (rawModule, runtime) {
  this.runtime = runtime;
  this._children = Object.create(null);
  this._rawModule = rawModule;
  var rawState = rawModule.state;
  this.state = (typeof rawState === 'function' ? rawState() : rawState) || {};
};

var prototypeAccessors$1 = { namespaced: { configurable: true } };

prototypeAccessors$1.namespaced.get = function () {
  return !!this._rawModule.namespaced
};

Module.prototype.addChild = function addChild (key, module) {
  this._children[key] = module;
};

Module.prototype.removeChild = function removeChild (key) {
  delete this._children[key];
};

Module.prototype.getChild = function getChild (key) {
  return this._children[key]
};

Module.prototype.update = function update (rawModule) {
  this._rawModule.namespaced = rawModule.namespaced;
  if (rawModule.actions) {
    this._rawModule.actions = rawModule.actions;
  }
  if (rawModule.mutations) {
    this._rawModule.mutations = rawModule.mutations;
  }
  if (rawModule.getters) {
    this._rawModule.getters = rawModule.getters;
  }
};

Module.prototype.forEachChild = function forEachChild (fn) {
  forEachValue(this._children, fn);
};

Module.prototype.forEachGetter = function forEachGetter (fn) {
  if (this._rawModule.getters) {
    forEachValue(this._rawModule.getters, fn);
  }
};

Module.prototype.forEachAction = function forEachAction (fn) {
  if (this._rawModule.actions) {
    forEachValue(this._rawModule.actions, fn);
  }
};

Module.prototype.forEachMutation = function forEachMutation (fn) {
  if (this._rawModule.mutations) {
    forEachValue(this._rawModule.mutations, fn);
  }
};

Object.defineProperties( Module.prototype, prototypeAccessors$1 );

var ModuleCollection = function ModuleCollection (rawRootModule) {
  // register root module (Vuex.Store options)
  this.register([], rawRootModule, false);
};

ModuleCollection.prototype.get = function get (path) {
  return path.reduce(function (module, key) {
    return module.getChild(key)
  }, this.root)
};

ModuleCollection.prototype.getNamespace = function getNamespace (path) {
  var module = this.root;
  return path.reduce(function (namespace, key) {
    module = module.getChild(key);
    return namespace + (module.namespaced ? key + '/' : '')
  }, '')
};

ModuleCollection.prototype.update = function update$1 (rawRootModule) {
  update([], this.root, rawRootModule);
};

ModuleCollection.prototype.register = function register (path, rawModule, runtime) {
    var this$1 = this;
    if ( runtime === void 0 ) runtime = true;

  if (true) {
    assertRawModule(path, rawModule);
  }

  var newModule = new Module(rawModule, runtime);
  if (path.length === 0) {
    this.root = newModule;
  } else {
    var parent = this.get(path.slice(0, -1));
    parent.addChild(path[path.length - 1], newModule);
  }

  // register nested modules
  if (rawModule.modules) {
    forEachValue(rawModule.modules, function (rawChildModule, key) {
      this$1.register(path.concat(key), rawChildModule, runtime);
    });
  }
};

ModuleCollection.prototype.unregister = function unregister (path) {
  var parent = this.get(path.slice(0, -1));
  var key = path[path.length - 1];
  if (!parent.getChild(key).runtime) { return }

  parent.removeChild(key);
};

function update (path, targetModule, newModule) {
  if (true) {
    assertRawModule(path, newModule);
  }

  // update target module
  targetModule.update(newModule);

  // update nested modules
  if (newModule.modules) {
    for (var key in newModule.modules) {
      if (!targetModule.getChild(key)) {
        if (true) {
          console.warn(
            "[vuex] trying to add a new module '" + key + "' on hot reloading, " +
            'manual reload is needed'
          );
        }
        return
      }
      update(
        path.concat(key),
        targetModule.getChild(key),
        newModule.modules[key]
      );
    }
  }
}

var functionAssert = {
  assert: function (value) { return typeof value === 'function'; },
  expected: 'function'
};

var objectAssert = {
  assert: function (value) { return typeof value === 'function' ||
    (typeof value === 'object' && typeof value.handler === 'function'); },
  expected: 'function or object with "handler" function'
};

var assertTypes = {
  getters: functionAssert,
  mutations: functionAssert,
  actions: objectAssert
};

function assertRawModule (path, rawModule) {
  Object.keys(assertTypes).forEach(function (key) {
    if (!rawModule[key]) { return }

    var assertOptions = assertTypes[key];

    forEachValue(rawModule[key], function (value, type) {
      assert(
        assertOptions.assert(value),
        makeAssertionMessage(path, key, type, value, assertOptions.expected)
      );
    });
  });
}

function makeAssertionMessage (path, key, type, value, expected) {
  var buf = key + " should be " + expected + " but \"" + key + "." + type + "\"";
  if (path.length > 0) {
    buf += " in module \"" + (path.join('.')) + "\"";
  }
  buf += " is " + (JSON.stringify(value)) + ".";
  return buf
}

var Vue; // bind on install

var Store = function Store (options) {
  var this$1 = this;
  if ( options === void 0 ) options = {};

  // Auto install if it is not done yet and `window` has `Vue`.
  // To allow users to avoid auto-installation in some cases,
  // this code should be placed here. See #731
  if (!Vue && typeof window !== 'undefined' && window.Vue) {
    install(window.Vue);
  }

  if (true) {
    assert(Vue, "must call Vue.use(Vuex) before creating a store instance.");
    assert(typeof Promise !== 'undefined', "vuex requires a Promise polyfill in this browser.");
    assert(this instanceof Store, "Store must be called with the new operator.");
  }

  var plugins = options.plugins; if ( plugins === void 0 ) plugins = [];
  var strict = options.strict; if ( strict === void 0 ) strict = false;

  var state = options.state; if ( state === void 0 ) state = {};
  if (typeof state === 'function') {
    state = state() || {};
  }

  // store internal state
  this._committing = false;
  this._actions = Object.create(null);
  this._actionSubscribers = [];
  this._mutations = Object.create(null);
  this._wrappedGetters = Object.create(null);
  this._modules = new ModuleCollection(options);
  this._modulesNamespaceMap = Object.create(null);
  this._subscribers = [];
  this._watcherVM = new Vue();

  // bind commit and dispatch to self
  var store = this;
  var ref = this;
  var dispatch = ref.dispatch;
  var commit = ref.commit;
  this.dispatch = function boundDispatch (type, payload) {
    return dispatch.call(store, type, payload)
  };
  this.commit = function boundCommit (type, payload, options) {
    return commit.call(store, type, payload, options)
  };

  // strict mode
  this.strict = strict;

  // init root module.
  // this also recursively registers all sub-modules
  // and collects all module getters inside this._wrappedGetters
  installModule(this, state, [], this._modules.root);

  // initialize the store vm, which is responsible for the reactivity
  // (also registers _wrappedGetters as computed properties)
  resetStoreVM(this, state);

  // apply plugins
  plugins.forEach(function (plugin) { return plugin(this$1); });

  if (Vue.config.devtools) {
    devtoolPlugin(this);
  }
};

var prototypeAccessors = { state: { configurable: true } };

prototypeAccessors.state.get = function () {
  return this._vm._data.$$state
};

prototypeAccessors.state.set = function (v) {
  if (true) {
    assert(false, "Use store.replaceState() to explicit replace store state.");
  }
};

Store.prototype.commit = function commit (_type, _payload, _options) {
    var this$1 = this;

  // check object-style commit
  var ref = unifyObjectStyle(_type, _payload, _options);
    var type = ref.type;
    var payload = ref.payload;
    var options = ref.options;

  var mutation = { type: type, payload: payload };
  var entry = this._mutations[type];
  if (!entry) {
    if (true) {
      console.error(("[vuex] unknown mutation type: " + type));
    }
    return
  }
  this._withCommit(function () {
    entry.forEach(function commitIterator (handler) {
      handler(payload);
    });
  });
  this._subscribers.forEach(function (sub) { return sub(mutation, this$1.state); });

  if (
     true &&
    options && options.silent
  ) {
    console.warn(
      "[vuex] mutation type: " + type + ". Silent option has been removed. " +
      'Use the filter functionality in the vue-devtools'
    );
  }
};

Store.prototype.dispatch = function dispatch (_type, _payload) {
    var this$1 = this;

  // check object-style dispatch
  var ref = unifyObjectStyle(_type, _payload);
    var type = ref.type;
    var payload = ref.payload;

  var action = { type: type, payload: payload };
  var entry = this._actions[type];
  if (!entry) {
    if (true) {
      console.error(("[vuex] unknown action type: " + type));
    }
    return
  }

  this._actionSubscribers.forEach(function (sub) { return sub(action, this$1.state); });

  return entry.length > 1
    ? Promise.all(entry.map(function (handler) { return handler(payload); }))
    : entry[0](payload)
};

Store.prototype.subscribe = function subscribe (fn) {
  return genericSubscribe(fn, this._subscribers)
};

Store.prototype.subscribeAction = function subscribeAction (fn) {
  return genericSubscribe(fn, this._actionSubscribers)
};

Store.prototype.watch = function watch (getter, cb, options) {
    var this$1 = this;

  if (true) {
    assert(typeof getter === 'function', "store.watch only accepts a function.");
  }
  return this._watcherVM.$watch(function () { return getter(this$1.state, this$1.getters); }, cb, options)
};

Store.prototype.replaceState = function replaceState (state) {
    var this$1 = this;

  this._withCommit(function () {
    this$1._vm._data.$$state = state;
  });
};

Store.prototype.registerModule = function registerModule (path, rawModule, options) {
    if ( options === void 0 ) options = {};

  if (typeof path === 'string') { path = [path]; }

  if (true) {
    assert(Array.isArray(path), "module path must be a string or an Array.");
    assert(path.length > 0, 'cannot register the root module by using registerModule.');
  }

  this._modules.register(path, rawModule);
  installModule(this, this.state, path, this._modules.get(path), options.preserveState);
  // reset store to update getters...
  resetStoreVM(this, this.state);
};

Store.prototype.unregisterModule = function unregisterModule (path) {
    var this$1 = this;

  if (typeof path === 'string') { path = [path]; }

  if (true) {
    assert(Array.isArray(path), "module path must be a string or an Array.");
  }

  this._modules.unregister(path);
  this._withCommit(function () {
    var parentState = getNestedState(this$1.state, path.slice(0, -1));
    Vue.delete(parentState, path[path.length - 1]);
  });
  resetStore(this);
};

Store.prototype.hotUpdate = function hotUpdate (newOptions) {
  this._modules.update(newOptions);
  resetStore(this, true);
};

Store.prototype._withCommit = function _withCommit (fn) {
  var committing = this._committing;
  this._committing = true;
  fn();
  this._committing = committing;
};

Object.defineProperties( Store.prototype, prototypeAccessors );

function genericSubscribe (fn, subs) {
  if (subs.indexOf(fn) < 0) {
    subs.push(fn);
  }
  return function () {
    var i = subs.indexOf(fn);
    if (i > -1) {
      subs.splice(i, 1);
    }
  }
}

function resetStore (store, hot) {
  store._actions = Object.create(null);
  store._mutations = Object.create(null);
  store._wrappedGetters = Object.create(null);
  store._modulesNamespaceMap = Object.create(null);
  var state = store.state;
  // init all modules
  installModule(store, state, [], store._modules.root, true);
  // reset vm
  resetStoreVM(store, state, hot);
}

function resetStoreVM (store, state, hot) {
  var oldVm = store._vm;

  // bind store public getters
  store.getters = {};
  var wrappedGetters = store._wrappedGetters;
  var computed = {};
  forEachValue(wrappedGetters, function (fn, key) {
    // use computed to leverage its lazy-caching mechanism
    computed[key] = function () { return fn(store); };
    Object.defineProperty(store.getters, key, {
      get: function () { return store._vm[key]; },
      enumerable: true // for local getters
    });
  });

  // use a Vue instance to store the state tree
  // suppress warnings just in case the user has added
  // some funky global mixins
  var silent = Vue.config.silent;
  Vue.config.silent = true;
  store._vm = new Vue({
    data: {
      $$state: state
    },
    computed: computed
  });
  Vue.config.silent = silent;

  // enable strict mode for new vm
  if (store.strict) {
    enableStrictMode(store);
  }

  if (oldVm) {
    if (hot) {
      // dispatch changes in all subscribed watchers
      // to force getter re-evaluation for hot reloading.
      store._withCommit(function () {
        oldVm._data.$$state = null;
      });
    }
    Vue.nextTick(function () { return oldVm.$destroy(); });
  }
}

function installModule (store, rootState, path, module, hot) {
  var isRoot = !path.length;
  var namespace = store._modules.getNamespace(path);

  // register in namespace map
  if (module.namespaced) {
    store._modulesNamespaceMap[namespace] = module;
  }

  // set state
  if (!isRoot && !hot) {
    var parentState = getNestedState(rootState, path.slice(0, -1));
    var moduleName = path[path.length - 1];
    store._withCommit(function () {
      Vue.set(parentState, moduleName, module.state);
    });
  }

  var local = module.context = makeLocalContext(store, namespace, path);

  module.forEachMutation(function (mutation, key) {
    var namespacedType = namespace + key;
    registerMutation(store, namespacedType, mutation, local);
  });

  module.forEachAction(function (action, key) {
    var type = action.root ? key : namespace + key;
    var handler = action.handler || action;
    registerAction(store, type, handler, local);
  });

  module.forEachGetter(function (getter, key) {
    var namespacedType = namespace + key;
    registerGetter(store, namespacedType, getter, local);
  });

  module.forEachChild(function (child, key) {
    installModule(store, rootState, path.concat(key), child, hot);
  });
}

/**
 * make localized dispatch, commit, getters and state
 * if there is no namespace, just use root ones
 */
function makeLocalContext (store, namespace, path) {
  var noNamespace = namespace === '';

  var local = {
    dispatch: noNamespace ? store.dispatch : function (_type, _payload, _options) {
      var args = unifyObjectStyle(_type, _payload, _options);
      var payload = args.payload;
      var options = args.options;
      var type = args.type;

      if (!options || !options.root) {
        type = namespace + type;
        if ( true && !store._actions[type]) {
          console.error(("[vuex] unknown local action type: " + (args.type) + ", global type: " + type));
          return
        }
      }

      return store.dispatch(type, payload)
    },

    commit: noNamespace ? store.commit : function (_type, _payload, _options) {
      var args = unifyObjectStyle(_type, _payload, _options);
      var payload = args.payload;
      var options = args.options;
      var type = args.type;

      if (!options || !options.root) {
        type = namespace + type;
        if ( true && !store._mutations[type]) {
          console.error(("[vuex] unknown local mutation type: " + (args.type) + ", global type: " + type));
          return
        }
      }

      store.commit(type, payload, options);
    }
  };

  // getters and state object must be gotten lazily
  // because they will be changed by vm update
  Object.defineProperties(local, {
    getters: {
      get: noNamespace
        ? function () { return store.getters; }
        : function () { return makeLocalGetters(store, namespace); }
    },
    state: {
      get: function () { return getNestedState(store.state, path); }
    }
  });

  return local
}

function makeLocalGetters (store, namespace) {
  var gettersProxy = {};

  var splitPos = namespace.length;
  Object.keys(store.getters).forEach(function (type) {
    // skip if the target getter is not match this namespace
    if (type.slice(0, splitPos) !== namespace) { return }

    // extract local getter type
    var localType = type.slice(splitPos);

    // Add a port to the getters proxy.
    // Define as getter property because
    // we do not want to evaluate the getters in this time.
    Object.defineProperty(gettersProxy, localType, {
      get: function () { return store.getters[type]; },
      enumerable: true
    });
  });

  return gettersProxy
}

function registerMutation (store, type, handler, local) {
  var entry = store._mutations[type] || (store._mutations[type] = []);
  entry.push(function wrappedMutationHandler (payload) {
    handler.call(store, local.state, payload);
  });
}

function registerAction (store, type, handler, local) {
  var entry = store._actions[type] || (store._actions[type] = []);
  entry.push(function wrappedActionHandler (payload, cb) {
    var res = handler.call(store, {
      dispatch: local.dispatch,
      commit: local.commit,
      getters: local.getters,
      state: local.state,
      rootGetters: store.getters,
      rootState: store.state
    }, payload, cb);
    if (!isPromise(res)) {
      res = Promise.resolve(res);
    }
    if (store._devtoolHook) {
      return res.catch(function (err) {
        store._devtoolHook.emit('vuex:error', err);
        throw err
      })
    } else {
      return res
    }
  });
}

function registerGetter (store, type, rawGetter, local) {
  if (store._wrappedGetters[type]) {
    if (true) {
      console.error(("[vuex] duplicate getter key: " + type));
    }
    return
  }
  store._wrappedGetters[type] = function wrappedGetter (store) {
    return rawGetter(
      local.state, // local state
      local.getters, // local getters
      store.state, // root state
      store.getters // root getters
    )
  };
}

function enableStrictMode (store) {
  store._vm.$watch(function () { return this._data.$$state }, function () {
    if (true) {
      assert(store._committing, "Do not mutate vuex store state outside mutation handlers.");
    }
  }, { deep: true, sync: true });
}

function getNestedState (state, path) {
  return path.length
    ? path.reduce(function (state, key) { return state[key]; }, state)
    : state
}

function unifyObjectStyle (type, payload, options) {
  if (isObject(type) && type.type) {
    options = payload;
    payload = type;
    type = type.type;
  }

  if (true) {
    assert(typeof type === 'string', ("Expects string as the type, but found " + (typeof type) + "."));
  }

  return { type: type, payload: payload, options: options }
}

function install (_Vue) {
  if (Vue && _Vue === Vue) {
    if (true) {
      console.error(
        '[vuex] already installed. Vue.use(Vuex) should be called only once.'
      );
    }
    return
  }
  Vue = _Vue;
  applyMixin(Vue);
}

var mapState = normalizeNamespace(function (namespace, states) {
  var res = {};
  normalizeMap(states).forEach(function (ref) {
    var key = ref.key;
    var val = ref.val;

    res[key] = function mappedState () {
      var state = this.$store.state;
      var getters = this.$store.getters;
      if (namespace) {
        var module = getModuleByNamespace(this.$store, 'mapState', namespace);
        if (!module) {
          return
        }
        state = module.context.state;
        getters = module.context.getters;
      }
      return typeof val === 'function'
        ? val.call(this, state, getters)
        : state[val]
    };
    // mark vuex getter for devtools
    res[key].vuex = true;
  });
  return res
});

var mapMutations = normalizeNamespace(function (namespace, mutations) {
  var res = {};
  normalizeMap(mutations).forEach(function (ref) {
    var key = ref.key;
    var val = ref.val;

    res[key] = function mappedMutation () {
      var args = [], len = arguments.length;
      while ( len-- ) args[ len ] = arguments[ len ];

      var commit = this.$store.commit;
      if (namespace) {
        var module = getModuleByNamespace(this.$store, 'mapMutations', namespace);
        if (!module) {
          return
        }
        commit = module.context.commit;
      }
      return typeof val === 'function'
        ? val.apply(this, [commit].concat(args))
        : commit.apply(this.$store, [val].concat(args))
    };
  });
  return res
});

var mapGetters = normalizeNamespace(function (namespace, getters) {
  var res = {};
  normalizeMap(getters).forEach(function (ref) {
    var key = ref.key;
    var val = ref.val;

    val = namespace + val;
    res[key] = function mappedGetter () {
      if (namespace && !getModuleByNamespace(this.$store, 'mapGetters', namespace)) {
        return
      }
      if ( true && !(val in this.$store.getters)) {
        console.error(("[vuex] unknown getter: " + val));
        return
      }
      return this.$store.getters[val]
    };
    // mark vuex getter for devtools
    res[key].vuex = true;
  });
  return res
});

var mapActions = normalizeNamespace(function (namespace, actions) {
  var res = {};
  normalizeMap(actions).forEach(function (ref) {
    var key = ref.key;
    var val = ref.val;

    res[key] = function mappedAction () {
      var args = [], len = arguments.length;
      while ( len-- ) args[ len ] = arguments[ len ];

      var dispatch = this.$store.dispatch;
      if (namespace) {
        var module = getModuleByNamespace(this.$store, 'mapActions', namespace);
        if (!module) {
          return
        }
        dispatch = module.context.dispatch;
      }
      return typeof val === 'function'
        ? val.apply(this, [dispatch].concat(args))
        : dispatch.apply(this.$store, [val].concat(args))
    };
  });
  return res
});

var createNamespacedHelpers = function (namespace) { return ({
  mapState: mapState.bind(null, namespace),
  mapGetters: mapGetters.bind(null, namespace),
  mapMutations: mapMutations.bind(null, namespace),
  mapActions: mapActions.bind(null, namespace)
}); };

function normalizeMap (map) {
  return Array.isArray(map)
    ? map.map(function (key) { return ({ key: key, val: key }); })
    : Object.keys(map).map(function (key) { return ({ key: key, val: map[key] }); })
}

function normalizeNamespace (fn) {
  return function (namespace, map) {
    if (typeof namespace !== 'string') {
      map = namespace;
      namespace = '';
    } else if (namespace.charAt(namespace.length - 1) !== '/') {
      namespace += '/';
    }
    return fn(namespace, map)
  }
}

function getModuleByNamespace (store, helper, namespace) {
  var module = store._modulesNamespaceMap[namespace];
  if ( true && !module) {
    console.error(("[vuex] module namespace not found in " + helper + "(): " + namespace));
  }
  return module
}

var index_esm = {
  Store: Store,
  install: install,
  version: '3.0.1',
  mapState: mapState,
  mapMutations: mapMutations,
  mapGetters: mapGetters,
  mapActions: mapActions,
  createNamespacedHelpers: createNamespacedHelpers
};


/* harmony default export */ __webpack_exports__["default"] = (index_esm);


/***/ }),

/***/ 17:
/*!*************************************************************!*\
  !*** J:/kesionEDU_APP/KS_EDU_APP/客户小程序/首冠小程序定制/api/user.js ***!
  \*************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
Object.defineProperty(exports, "__esModule", { value: true });exports.checkIsLogin = checkIsLogin;exports.GetMiniProgramOpenID = GetMiniProgramOpenID;exports.LoginOut = LoginOut;exports.SendSmsCode = SendSmsCode;exports.UserReg = UserReg;exports.ModifyPass = ModifyPass;exports.Login = Login;exports.GetUserInfo = GetUserInfo;exports.GetArea = GetArea;exports.GetPassByMobile = GetPassByMobile;exports.ModifyUserFace = ModifyUserFace;exports.SaveUesrBasicInfo = SaveUesrBasicInfo;exports.GetUserCourseOrderList = GetUserCourseOrderList;exports.InitialUserPayCourse = InitialUserPayCourse;exports.DoUserPayCourse = DoUserPayCourse;exports.DeleteUserCourseOrder = DeleteUserCourseOrder;exports.GetUserFavoriteList = GetUserFavoriteList;exports.GetUserAskFavriteList = GetUserAskFavriteList;exports.GetUserMessageReciveList = GetUserMessageReciveList;exports.GetOneSiteMsgInfo = GetOneSiteMsgInfo;exports.DoUserSiteMsg = DoUserSiteMsg;exports.GetUserUpgradeVIP = GetUserUpgradeVIP;exports.PayUserUpgradeVIP = PayUserUpgradeVIP;exports.GetUserCouponList = GetUserCouponList;exports.GetUserRedPacketList = GetUserRedPacketList;exports.GetUserAskTopList = GetUserAskTopList;exports.GetUserCourseList = GetUserCourseList;exports.GetIsVerify = GetIsVerify;exports.GetUserSpecialList = GetUserSpecialList;exports.Pasttrial = Pasttrial;exports.GetUserFeePackageList = GetUserFeePackageList;exports.GetUserFeePackageBuyList = GetUserFeePackageBuyList;exports.ActivateUserFeePackage = ActivateUserFeePackage;exports.InitialPayUserFeePackage = InitialPayUserFeePackage;exports.PayUserFeePackage = PayUserFeePackage;exports.GetUserFeePackageDetail = GetUserFeePackageDetail;exports.GetUserFeePackageBuyDetail = GetUserFeePackageBuyDetail;exports.GetMyRoomList = GetMyRoomList;exports.GetUserTkCorrectionList = GetUserTkCorrectionList;exports.DoPay = DoPay;exports.GetRechargeList = GetRechargeList;exports.MoneyExchangePoint = MoneyExchangePoint;exports.SaveMoneyExchangePoint = SaveMoneyExchangePoint;exports.ScoreExchangePoint = ScoreExchangePoint;exports.SaveScoreExchangePoint = SaveScoreExchangePoint;exports.GetUserLogPointList = GetUserLogPointList;exports.GetUserLogScoreList = GetUserLogScoreList;exports.GetUserLogMoneyList = GetUserLogMoneyList;exports.IsDistributor = IsDistributor;exports.ApplyIstitle = ApplyIstitle;exports.ApplyDistributor = ApplyDistributor;exports.ApplyDistributorlist = ApplyDistributorlist;exports.ApplySalesorder = ApplySalesorder;exports.ApplySalesorderlist = ApplySalesorderlist;exports.ApplyDistriMember = ApplyDistriMember;exports.ApplyDrawing = ApplyDrawing;exports.ApplyDrawingSave = ApplyDrawingSave;exports.ApplyYjSelect = ApplyYjSelect;exports.ApplyTxrecord = ApplyTxrecord;exports.ApplyDistributorsonlist = ApplyDistributorsonlist;exports.ApplyShop = ApplyShop;exports.ApplyUpdateShop = ApplyUpdateShop;exports.ApplyQRcode = ApplyQRcode;exports.ApplyRanking = ApplyRanking;exports.ApplySon = ApplySon;exports.ApplyCashwhere = ApplyCashwhere;exports.GetRealnameauthentication = GetRealnameauthentication;exports.ApplyCash = ApplyCash;var _mainEntrance = __webpack_require__(/*! ./main.entrance.js */ 18);

/*获取登录状态*/
function checkIsLogin(params) {
  return (0, _mainEntrance.POST)('/webapi/APP/CheckUser', params);
}
/*获取小程序加密信息 openid、access_token 等*/
function GetMiniProgramOpenID(params) {
  return (0, _mainEntrance.GET)('/webapi/user/GetMiniProgramOpenID', params);
}

/*退出登录*/
function LoginOut(params) {
  return (0, _mainEntrance.POST)('/webapi/user/LoginOut', params, ['appToken']);
}
/*手机验证码*/
function SendSmsCode(params) {
  return (0, _mainEntrance.GET)('/webapi/user/SendSmsCode', params);
}
/*用户注册*/
function UserReg(params) {
  return (0, _mainEntrance.GET)('/webapi/user/UserReg', params);
}
/*修改密码*/
function ModifyPass(params) {
  return (0, _mainEntrance.GET)('/webapi/user/ModifyPass', params, ['appToken']);
}
/*用户登录*/
function Login(params) {
  return (0, _mainEntrance.GET)('/webapi/user/Login', params);
}
/*获取用户信息*/
function GetUserInfo(params) {
  return (0, _mainEntrance.GET)('/webapi/user/GetUserInfo', params, ['appToken']);
}
/*获取省市区数据*/
function GetArea(params) {
  return (0, _mainEntrance.GET)('/webapi/user/GetArea', params);
}
/*找回密码*/
function GetPassByMobile(params) {
  return (0, _mainEntrance.GET)('/webapi/user/GetPassByMobile', params);
}
/*修改头像*/
function ModifyUserFace(params) {
  return (0, _mainEntrance.GET)('/webapi/user/ModifyUserFace', params, ['appToken', 'userId']);
}
/*修改基本资料*/
function SaveUesrBasicInfo(params) {
  return (0, _mainEntrance.GET)('/webapi/user/SaveUesrBasicInfo', params, ['appToken']);
}
/**我的订单 课程订单列表*/
function GetUserCourseOrderList(params) {
  return (0, _mainEntrance.GET)('/webapi/user/GetUserCourseOrderList', params, ['appToken']);
}
/**我的订单 课程订单支付初始化*/
function InitialUserPayCourse(params) {
  return (0, _mainEntrance.GET)('/webapi/user/InitialUserPayCourse', params, ['appToken']);
}
/**我的订单 课程订单支付*/
function DoUserPayCourse(params) {
  return (0, _mainEntrance.GET)('/webapi/user/DoUserPayCourse', params, ['appToken']);
}
/**我的订单 删除课程订单*/
function DeleteUserCourseOrder(params) {
  return (0, _mainEntrance.GET)('/webapi/user/DeleteUserCourseOrder', params, ['appToken']);
}
/**我的收藏列表*/
function GetUserFavoriteList(params) {
  return (0, _mainEntrance.POST)('/webapi/user/GetUserFavoriteList', params, ['appToken']);
}
/**问题收藏列表*/
function GetUserAskFavriteList(params) {
  return (0, _mainEntrance.POST)('/webapi/user/GetUserAskFavriteList', params, ['appToken']);
}
/**我收到的消息*/
function GetUserMessageReciveList(params) {
  return (0, _mainEntrance.POST)('/webapi/user/GetUserMessageReciveList', params, ['appToken']);
}
/**消息详情*/
function GetOneSiteMsgInfo(params) {
  return (0, _mainEntrance.POST)('/webapi/user/GetOneSiteMsgInfo', params, ['appToken']);
}
/**删除消息*/
function DoUserSiteMsg(params) {
  return (0, _mainEntrance.POST)('/webapi/user/DoUserSiteMsg', params, ['appToken']);
}
/**升级vip*/
function GetUserUpgradeVIP(params) {
  return (0, _mainEntrance.POST)('/webapi/user/GetUserUpgradeVIP', params, ['appToken']);
}
/**购买vip*/
function PayUserUpgradeVIP(params) {
  return (0, _mainEntrance.POST)('/webapi/user/PayUserUpgradeVIP', params, ['appToken']);
}
/**优惠券列表*/
function GetUserCouponList(params) {
  return (0, _mainEntrance.POST)('/webapi/user/GetUserCouponList', params, ['appToken']);
}
/**红包列表*/
function GetUserRedPacketList(params) {
  return (0, _mainEntrance.POST)('/webapi/user/GetUserRedPacketList', params, ['appToken']);
}
/**我的问答*/
function GetUserAskTopList(params) {
  return (0, _mainEntrance.GET)('/webapi/User/GetUserAskTopList', params, ['userId']);
}
/**我的课程*/
function GetUserCourseList(params) {
  return (0, _mainEntrance.POST)('/webapi/User/GetUserCourseList', params, ['appToken']);
}

/**审核状态*/
function GetIsVerify(params) {
  return (0, _mainEntrance.GET)('/webapi/Other/GetIsVerify', params);
}
/**我的专栏*/
function GetUserSpecialList(params) {
  return (0, _mainEntrance.POST)('/webapi/user/GetUserSpecialList', params, ['appToken']);
}
/**建议、举报*/
function Pasttrial(params) {
  return (0, _mainEntrance.POST)('/webapi/app/Pasttrial', params, ['appToken']);
}
/**我的学习卡*/
function GetUserFeePackageList(params) {
  return (0, _mainEntrance.POST)('/webapi/user/GetUserFeePackageList', params, ['appToken']);
}
/**学习卡列表*/
function GetUserFeePackageBuyList(params) {
  return (0, _mainEntrance.POST)('/webapi/user/GetUserFeePackageBuyList', params, ['appToken']);
}
/**激活学习卡*/
function ActivateUserFeePackage(params) {
  return (0, _mainEntrance.POST)('/webapi/user/ActivateUserFeePackage', params, ['appToken']);
}
/**初始化购买学习卡数据*/
function InitialPayUserFeePackage(params) {
  return (0, _mainEntrance.POST)('/webapi/user/InitialPayUserFeePackage', params, ['appToken']);
}
/**购买支付学习卡*/
function PayUserFeePackage(params) {
  return (0, _mainEntrance.POST)('/webapi/user/PayUserFeePackage', params, ['appToken']);
}
/**我的营销卡详情*/
function GetUserFeePackageDetail(params) {
  return (0, _mainEntrance.POST)('/webapi/user/GetUserFeePackageDetail', params, ['appToken']);
}
/**所有营销卡详情*/
function GetUserFeePackageBuyDetail(params) {
  return (0, _mainEntrance.POST)('/webapi/user/GetUserFeePackageBuyDetail', params, ['appToken']);
}
/**我的班级*/
function GetMyRoomList(params) {
  return (0, _mainEntrance.POST)('/webapi/user/GetMyRoomList', params, ['appToken']);
}
/**试题纠错*/
function GetUserTkCorrectionList(params) {
  return (0, _mainEntrance.POST)('/webapi/user/GetUserTkCorrectionList', params, ['appToken', 'userId']);
}
/**余额充值*/
function DoPay(params) {
  return (0, _mainEntrance.POST)('/webapi/user/DoPay', params, ['appToken', 'userId']);
}
/**充值记录*/
function GetRechargeList(params) {
  return (0, _mainEntrance.POST)('/webapi/user/GetRechargeList', params, ['appToken', 'userId']);
}
/**点券兑换*/
function MoneyExchangePoint(params) {
  return (0, _mainEntrance.POST)('/webapi/user/MoneyExchangePoint', params, ['appToken', 'userId']);
}
/**点券兑换*/
function SaveMoneyExchangePoint(params) {
  return (0, _mainEntrance.POST)('/webapi/user/SaveMoneyExchangePoint', params, ['appToken', 'userId']);
}
/**点券兑换*/
function ScoreExchangePoint(params) {
  return (0, _mainEntrance.POST)('/webapi/user/ScoreExchangePoint', params, ['appToken', 'userId']);
}
/**点券兑换*/
function SaveScoreExchangePoint(params) {
  return (0, _mainEntrance.POST)('/webapi/user/SaveScoreExchangePoint', params, ['appToken', 'userId']);
}
/**点券明细*/
function GetUserLogPointList(params) {
  return (0, _mainEntrance.POST)('/webapi/user/GetUserLogPointList', params, ['appToken', 'userId']);
}
/**积分明细*/
function GetUserLogScoreList(params) {
  return (0, _mainEntrance.POST)('/webapi/user/GetUserLogScoreList', params, ['appToken', 'userId']);
}
/**账户明细*/
function GetUserLogMoneyList(params) {
  return (0, _mainEntrance.POST)('/webapi/user/GetUserLogMoneyList', params, ['appToken', 'userId']);
}
/*****************分销*****************/
/**获取分销状态*/
function IsDistributor(params) {
  return (0, _mainEntrance.POST)('/webapi/user/IsDistributor', params, ['appToken', 'userId']);
}
/**校验店铺名称*/
function ApplyIstitle(params) {
  return (0, _mainEntrance.POST)('/webapi/user/ApplyIstitle', params, ['appToken']);
}
/**提交申请分销商*/
function ApplyDistributor(params) {
  return (0, _mainEntrance.POST)('/webapi/user/ApplyDistributor', params, ['appToken']);
}
/**我的分销信息*/
function ApplyDistributorlist(params) {
  return (0, _mainEntrance.POST)('/webapi/user/ApplyDistributorlist', params, ['appToken', 'userId']);
}
/**小店销售订单*/
function ApplySalesorder(params) {
  return (0, _mainEntrance.POST)('/webapi/user/ApplySalesorder', params, ['appToken', 'userId']);
}
/**小店销售订单明细*/
function ApplySalesorderlist(params) {
  return (0, _mainEntrance.POST)('/webapi/user/ApplySalesorderlist', params, ['appToken', 'userId']);
}
/**小店会员*/
function ApplyDistriMember(params) {
  return (0, _mainEntrance.POST)('/webapi/user/ApplyDistriMember', params, ['appToken', 'userId']);
}
/**获取提现账号信息*/
function ApplyDrawing(params) {
  return (0, _mainEntrance.POST)('/webapi/user/ApplyDrawing', params, ['appToken', 'userId']);
}
/**修改提现账号信息*/
function ApplyDrawingSave(params) {
  return (0, _mainEntrance.POST)('/webapi/user/ApplyDrawingSave', params, ['appToken', 'userId']);
}
/**佣金提现数据*/
function ApplyYjSelect(params) {
  return (0, _mainEntrance.POST)('/webapi/user/ApplyYjSelect', params, ['appToken', 'userId']);
}
/**分销提现记录*/
function ApplyTxrecord(params) {
  return (0, _mainEntrance.POST)('/webapi/user/ApplyTxrecord', params, ['appToken', 'userId']);
}
/**子分销商信息*/
function ApplyDistributorsonlist(params) {
  return (0, _mainEntrance.POST)('/webapi/user/ApplyDistributorsonlist', params, ['appToken', 'userId']);
}
/**获取店铺资料信息*/
function ApplyShop(params) {
  return (0, _mainEntrance.POST)('/webapi/user/ApplyShop', params, ['appToken', 'userId']);
}
/**修改店铺资料信息*/
function ApplyUpdateShop(params) {
  return (0, _mainEntrance.POST)('/webapi/user/ApplyUpdateShop', params, ['appToken', 'userId']);
}
/**店铺二维码*/
function ApplyQRcode(params) {
  return (0, _mainEntrance.POST)('/webapi/user/ApplyQRcode', params, ['appToken', 'userId']);
}
/**获取分销排名*/
function ApplyRanking(params) {
  return (0, _mainEntrance.POST)('/webapi/user/ApplyRanking', params, ['appToken', 'userId']);
}
/**获取子分销排名*/
function ApplySon(params) {
  return (0, _mainEntrance.POST)('/webapi/user/ApplySon', params, ['appToken', 'userId']);
}
/**是否实名认证*/
function ApplyCashwhere(params) {
  return (0, _mainEntrance.POST)('/webapi/user/ApplyCashwhere', params, ['appToken', 'userId']);
}
/**实名认证提交*/
function GetRealnameauthentication(params) {
  return (0, _mainEntrance.POST)('/webapi/user/GetRealnameauthentication', params, ['appToken', 'userId']);
}
/**申请提现*/
function ApplyCash(params) {
  return (0, _mainEntrance.POST)('/webapi/user/ApplyCash', params, ['appToken', 'userId']);
}

/***/ }),

/***/ 173:
/*!*********************************************************************!*\
  !*** J:/kesionEDU_APP/KS_EDU_APP/客户小程序/首冠小程序定制/api/learn-record.js ***!
  \*********************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
Object.defineProperty(exports, "__esModule", { value: true });exports.MyCourseList = MyCourseList;var _mainEntrance = __webpack_require__(/*! ./main.entrance.js */ 18);



// 学习记录列表
function MyCourseList(params) {
  return (0, _mainEntrance.GET)('/webapi/Course/MyCourseList', params, ['appToken', 'userId']);
}

/***/ }),

/***/ 18:
/*!**********************************************************************!*\
  !*** J:/kesionEDU_APP/KS_EDU_APP/客户小程序/首冠小程序定制/api/main.entrance.js ***!
  \**********************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
/* WEBPACK VAR INJECTION */(function(uni) {Object.defineProperty(exports, "__esModule", { value: true });exports.GET = GET;exports.POST = POST;
var _store = _interopRequireDefault(__webpack_require__(/*! ../store */ 15));function _interopRequireDefault(obj) {return obj && obj.__esModule ? obj : { default: obj };}
function getStore() {
  return new Promise(function (resolve) {
    if (typeof _store.default === 'object') {
      resolve(_store.default);
    } else {
      setTimeout(function () {
        getStore().then(function (store) {
          resolve(store);
        });
      }, 100);
    }
  });
}
function loginVerification(res) {
  if (res.data.msg && (res.data.msg === '无效apptoken' || res.data.msg.indexOf('请先登录') !== -1)) {
    uni.hideLoading();
    _store.default.dispatch('loginout').then(function () {
      uni.showModal({
        title: '提示',
        content: '您的账户未登陆，或在异地登陆，请重新登陆！',
        success: function success(res) {
          if (res.confirm) {
            uni.navigateTo({
              url: '/pages/user/login/index' });

          }
        } });

    });
  } else {
    return true;
  }
}
function GET(url) {var params = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};var defultParams = arguments.length > 2 ? arguments[2] : undefined;
  return new Promise(function (resolve, reject) {
    getStore().then(function (store) {
      //from有的地方传的不是student
      if (params.from === '') {
        params.from = 'student';
      }
      params.version = store.state.versionNum;
      if (typeof defultParams === 'object') {
        store.ready(function (state) {

          if (defultParams.indexOf('userId') != -1) {
            params.userid = state.userId;
          }
          if (defultParams.indexOf('appToken') != -1) {
            params.apptoken = state.appToken;
          }

          uni.request({
            url: state.SRC + url,
            method: 'GET',
            sslVerify: false,
            data: params,
            success: function success(res) {
              if (loginVerification(res)) {
                resolve(res.data);
              }
            },
            fail: function fail(err) {
              reject(err);
            } });

        });


      } else {
        uni.request({
          url: store.state.SRC + url,
          method: 'GET',
          data: params,
          sslVerify: false,
          success: function success(res) {
            if (loginVerification(res)) {
              resolve(res.data);
            }
          },
          fail: function fail(err) {
            reject(err);
          } });

      }
    });
  });
}

function POST(url) {var params = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};var defultParams = arguments.length > 2 ? arguments[2] : undefined;
  return new Promise(function (resolve, reject) {
    getStore().then(function (store) {
      if (params.from === '') {
        params.from = 'student';
      }
      params.version = store.state.versionNum;
      if (typeof defultParams === 'object') {
        store.ready(function (state) {

          if (defultParams.indexOf('userId') != -1) {
            params.userid = state.userId;
          }
          if (defultParams.indexOf('appToken') != -1) {
            params.apptoken = state.appToken;
          }
          uni.request({
            url: state.SRC + url,
            method: 'POST',
            sslVerify: false,
            data: params,
            success: function success(res) {
              if (loginVerification(res)) {
                resolve(res.data);
              }
            },
            fail: function fail(err) {
              reject(err);
            } });

        });

      } else {
        uni.request({
          url: store.state.SRC + url,
          method: 'POST',
          sslVerify: false,
          data: params,
          success: function success(res) {
            if (loginVerification(res)) {
              resolve(res.data);
            }
          },
          fail: function fail(err) {
            reject(err);
          } });

      }
    });
  });
}
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! ./node_modules/@dcloudio/uni-mp-weixin/dist/index.js */ 1)["default"]))

/***/ }),

/***/ 19:
/*!********************************************************************!*\
  !*** J:/kesionEDU_APP/KS_EDU_APP/客户小程序/首冠小程序定制/lib/polyv/index.js ***!
  \********************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
Object.defineProperty(exports, "__esModule", { value: true });exports.default = void 0;var _regenerator = _interopRequireDefault(__webpack_require__(/*! ./node_modules/@babel/runtime/regenerator */ 20));var _runtimeModule = _interopRequireDefault(__webpack_require__(/*! ./common/regenerator-runtime/runtime-module */ 23));var _chat = _interopRequireDefault(__webpack_require__(/*! ./common/chat/chat */ 27));var _index = _interopRequireDefault(__webpack_require__(/*! ./store/index */ 36));var _index2 = _interopRequireDefault(__webpack_require__(/*! ./common/api/index */ 39));var _utils = _interopRequireDefault(__webpack_require__(/*! ./common/utils/utils */ 37));function _interopRequireDefault(obj) {return obj && obj.__esModule ? obj : { default: obj };}function _slicedToArray(arr, i) {return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _nonIterableRest();}function _nonIterableRest() {throw new TypeError("Invalid attempt to destructure non-iterable instance");}function _iterableToArrayLimit(arr, i) {var _arr = [];var _n = true;var _d = false;var _e = undefined;try {for (var _i = arr[Symbol.iterator](), _s; !(_n = (_s = _i.next()).done); _n = true) {_arr.push(_s.value);if (i && _arr.length === i) break;}} catch (err) {_d = true;_e = err;} finally {try {if (!_n && _i["return"] != null) _i["return"]();} finally {if (_d) throw _e;}}return _arr;}function _arrayWithHoles(arr) {if (Array.isArray(arr)) return arr;}function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) {try {var info = gen[key](arg);var value = info.value;} catch (error) {reject(error);return;}if (info.done) {resolve(value);} else {Promise.resolve(value).then(_next, _throw);}}function _asyncToGenerator(fn) {return function () {var self = this,args = arguments;return new Promise(function (resolve, reject) {var gen = fn.apply(self, args);function _next(value) {asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value);}function _throw(err) {asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err);}_next(undefined);});};}function _objectSpread(target) {for (var i = 1; i < arguments.length; i++) {var source = arguments[i] != null ? arguments[i] : {};var ownKeys = Object.keys(source);if (typeof Object.getOwnPropertySymbols === 'function') {ownKeys = ownKeys.concat(Object.getOwnPropertySymbols(source).filter(function (sym) {return Object.getOwnPropertyDescriptor(source, sym).enumerable;}));}ownKeys.forEach(function (key) {_defineProperty(target, key, source[key]);});}return target;}function _defineProperty(obj, key, value) {if (key in obj) {Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true });} else {obj[key] = value;}return obj;}var chat;var checkParams = function checkParams(t, e) {for (var a = 0, o = e.length; a < o; a++) {var _o = e[a];if (_o.indexOf("|") > -1) {var _ret = function () {var e = _o.split("|");if (Object.keys(t).find(function (t) {return t === e[0] || t === e[1];})) return { v: void 0 };}();if (typeof _ret === "object") return _ret.v;}if (void 0 === t[_o]) throw new Error("\u7F3A\u5C11\u53C2\u6570".concat(_o));}};function initChat() {var _store$get = _index.default.get("main"),t = _store$get.userName,e = _store$get.channelId,a = _store$get.avatarUrl,o = _store$get.channelDetail,_store$get2 = _index.default.get("app"),r = _store$get2.userId,n = { userId: r, userName: t, roomName: e, pic: a, userType: o.isPPT ? "slice" : "student" };return chatClose(), (chat = new _chat.default(_objectSpread({}, n, { micUserId: n.userId }))).setup(), _index.default.set({ "main.chat": chat }), chat;}function chatClose() {chat && (chat.disconnectSocket(), chat = null);}var destory = function destory() {chatClose(), _index.default.reset();},logVersion = function logVersion() {console.log("VERSION: 1.1.0");};function setApp(t) {if (logVersion(), "object" != typeof t) throw Error("请传入正确格式参数");checkParams(t, ["apiId", "apiSecret|verifyUrl"]), _index.default.set("app", t);}var _dealDetail = /*#__PURE__*/function () {var _ref = _asyncToGenerator( /*#__PURE__*/_regenerator.default.mark(function _callee(t) {var e, _ref2, _e;return _regenerator.default.wrap(function _callee$(_context) {while (1) {switch (_context.prev = _context.next) {case 0:e = "Y" === t.playbackEnabled && t.hasPlayback;t.isPPT = "ppt" === t.scene;_context.prev = 2;if (!e) {_context.next = 11;break;}_context.next = 6;return _index2.default.getPlayBackVideos({ channelId: t.channelId });case 6:_ref2 = _context.sent;_e = _ref2.data;if (!(200 !== _e.code)) {_context.next = 10;break;}throw _e;case 10:t.playbackList = _e.data.contents;case 11:_context.next = 16;break;case 13:_context.prev = 13;_context.t0 = _context["catch"](2);console.error(_context.t0);case 16:return _context.abrupt("return", t);case 17:case "end":return _context.stop();}}}, _callee, this, [[2, 13]]);}));return function _dealDetail(_x) {return _ref.apply(this, arguments);};}(),_getPolyvUserId = function _getPolyvUserId(t) {return new Promise(function (e, a) {var o = _index.default.get("main.openId"),r = _index.default.get("app.userId");t === o && r ? e({ data: r }) : _index2.default.getUserId(t).then(function (t) {200 !== t.data.code && a(t), e(t.data);});});},_requestDetail = function _requestDetail(t) {return _index2.default.getChannelDetail(t).then(function (t) {if (200 !== t.data.code) throw t;return t.data;});};function init(t) {return new Promise(function (e, a) {_utils.default.isObj(t) || a(Error("options must be object!")), checkParams(t, ["openId", "channelId", "userName", "avatarUrl"]), t && t.pptDelayTime || (t.pptDelayTime = 3e3), _index.default.set("main", _objectSpread({}, t)), _index.default.set({ "main.userInfo": _objectSpread({}, t) });var o = t.openId,r = t.channelId,_t$immediateChat = t.immediateChat,n = _t$immediateChat === void 0 ? !0 : _t$immediateChat;Promise.all([_getPolyvUserId(o), _requestDetail(r)]).then( /*#__PURE__*/function () {var _ref3 = _asyncToGenerator( /*#__PURE__*/_regenerator.default.mark(function _callee2(a) {var _a, o, r, i, s;return _regenerator.default.wrap(function _callee2$(_context2) {while (1) {switch (_context2.prev = _context2.next) {case 0:_a = _slicedToArray(a, 2);o = _a[0];r = _a[1];i = o.data;_context2.next = 6;return _dealDetail(r.data);case 6:s = _context2.sent;s.useVideo = t.useVideo || !1, _index.default.set({ "app.userId": i, "main.channelDetail": s }), n && initChat(), e({ detail: s, chat: chat });case 8:case "end":return _context2.stop();}}}, _callee2, this);}));return function (_x2) {return _ref3.apply(this, arguments);};}()).catch(function (t) {"[object Object]" === Object.prototype.toString.call(t) && a(t.data), a(t);});});}var _default = { setApp: setApp, init: init, destory: destory, initChat: initChat, api: _index2.default };exports.default = _default;

/***/ }),

/***/ 2:
/*!******************************************************************************************!*\
  !*** ./node_modules/@dcloudio/vue-cli-plugin-uni/packages/mp-vue/dist/mp.runtime.esm.js ***!
  \******************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* WEBPACK VAR INJECTION */(function(global) {/*!
 * Vue.js v2.6.10
 * (c) 2014-2019 Evan You
 * Released under the MIT License.
 */
/*  */

var emptyObject = Object.freeze({});

// These helpers produce better VM code in JS engines due to their
// explicitness and function inlining.
function isUndef (v) {
  return v === undefined || v === null
}

function isDef (v) {
  return v !== undefined && v !== null
}

function isTrue (v) {
  return v === true
}

function isFalse (v) {
  return v === false
}

/**
 * Check if value is primitive.
 */
function isPrimitive (value) {
  return (
    typeof value === 'string' ||
    typeof value === 'number' ||
    // $flow-disable-line
    typeof value === 'symbol' ||
    typeof value === 'boolean'
  )
}

/**
 * Quick object check - this is primarily used to tell
 * Objects from primitive values when we know the value
 * is a JSON-compliant type.
 */
function isObject (obj) {
  return obj !== null && typeof obj === 'object'
}

/**
 * Get the raw type string of a value, e.g., [object Object].
 */
var _toString = Object.prototype.toString;

function toRawType (value) {
  return _toString.call(value).slice(8, -1)
}

/**
 * Strict object type check. Only returns true
 * for plain JavaScript objects.
 */
function isPlainObject (obj) {
  return _toString.call(obj) === '[object Object]'
}

function isRegExp (v) {
  return _toString.call(v) === '[object RegExp]'
}

/**
 * Check if val is a valid array index.
 */
function isValidArrayIndex (val) {
  var n = parseFloat(String(val));
  return n >= 0 && Math.floor(n) === n && isFinite(val)
}

function isPromise (val) {
  return (
    isDef(val) &&
    typeof val.then === 'function' &&
    typeof val.catch === 'function'
  )
}

/**
 * Convert a value to a string that is actually rendered.
 */
function toString (val) {
  return val == null
    ? ''
    : Array.isArray(val) || (isPlainObject(val) && val.toString === _toString)
      ? JSON.stringify(val, null, 2)
      : String(val)
}

/**
 * Convert an input value to a number for persistence.
 * If the conversion fails, return original string.
 */
function toNumber (val) {
  var n = parseFloat(val);
  return isNaN(n) ? val : n
}

/**
 * Make a map and return a function for checking if a key
 * is in that map.
 */
function makeMap (
  str,
  expectsLowerCase
) {
  var map = Object.create(null);
  var list = str.split(',');
  for (var i = 0; i < list.length; i++) {
    map[list[i]] = true;
  }
  return expectsLowerCase
    ? function (val) { return map[val.toLowerCase()]; }
    : function (val) { return map[val]; }
}

/**
 * Check if a tag is a built-in tag.
 */
var isBuiltInTag = makeMap('slot,component', true);

/**
 * Check if an attribute is a reserved attribute.
 */
var isReservedAttribute = makeMap('key,ref,slot,slot-scope,is');

/**
 * Remove an item from an array.
 */
function remove (arr, item) {
  if (arr.length) {
    var index = arr.indexOf(item);
    if (index > -1) {
      return arr.splice(index, 1)
    }
  }
}

/**
 * Check whether an object has the property.
 */
var hasOwnProperty = Object.prototype.hasOwnProperty;
function hasOwn (obj, key) {
  return hasOwnProperty.call(obj, key)
}

/**
 * Create a cached version of a pure function.
 */
function cached (fn) {
  var cache = Object.create(null);
  return (function cachedFn (str) {
    var hit = cache[str];
    return hit || (cache[str] = fn(str))
  })
}

/**
 * Camelize a hyphen-delimited string.
 */
var camelizeRE = /-(\w)/g;
var camelize = cached(function (str) {
  return str.replace(camelizeRE, function (_, c) { return c ? c.toUpperCase() : ''; })
});

/**
 * Capitalize a string.
 */
var capitalize = cached(function (str) {
  return str.charAt(0).toUpperCase() + str.slice(1)
});

/**
 * Hyphenate a camelCase string.
 */
var hyphenateRE = /\B([A-Z])/g;
var hyphenate = cached(function (str) {
  return str.replace(hyphenateRE, '-$1').toLowerCase()
});

/**
 * Simple bind polyfill for environments that do not support it,
 * e.g., PhantomJS 1.x. Technically, we don't need this anymore
 * since native bind is now performant enough in most browsers.
 * But removing it would mean breaking code that was able to run in
 * PhantomJS 1.x, so this must be kept for backward compatibility.
 */

/* istanbul ignore next */
function polyfillBind (fn, ctx) {
  function boundFn (a) {
    var l = arguments.length;
    return l
      ? l > 1
        ? fn.apply(ctx, arguments)
        : fn.call(ctx, a)
      : fn.call(ctx)
  }

  boundFn._length = fn.length;
  return boundFn
}

function nativeBind (fn, ctx) {
  return fn.bind(ctx)
}

var bind = Function.prototype.bind
  ? nativeBind
  : polyfillBind;

/**
 * Convert an Array-like object to a real Array.
 */
function toArray (list, start) {
  start = start || 0;
  var i = list.length - start;
  var ret = new Array(i);
  while (i--) {
    ret[i] = list[i + start];
  }
  return ret
}

/**
 * Mix properties into target object.
 */
function extend (to, _from) {
  for (var key in _from) {
    to[key] = _from[key];
  }
  return to
}

/**
 * Merge an Array of Objects into a single Object.
 */
function toObject (arr) {
  var res = {};
  for (var i = 0; i < arr.length; i++) {
    if (arr[i]) {
      extend(res, arr[i]);
    }
  }
  return res
}

/* eslint-disable no-unused-vars */

/**
 * Perform no operation.
 * Stubbing args to make Flow happy without leaving useless transpiled code
 * with ...rest (https://flow.org/blog/2017/05/07/Strict-Function-Call-Arity/).
 */
function noop (a, b, c) {}

/**
 * Always return false.
 */
var no = function (a, b, c) { return false; };

/* eslint-enable no-unused-vars */

/**
 * Return the same value.
 */
var identity = function (_) { return _; };

/**
 * Check if two values are loosely equal - that is,
 * if they are plain objects, do they have the same shape?
 */
function looseEqual (a, b) {
  if (a === b) { return true }
  var isObjectA = isObject(a);
  var isObjectB = isObject(b);
  if (isObjectA && isObjectB) {
    try {
      var isArrayA = Array.isArray(a);
      var isArrayB = Array.isArray(b);
      if (isArrayA && isArrayB) {
        return a.length === b.length && a.every(function (e, i) {
          return looseEqual(e, b[i])
        })
      } else if (a instanceof Date && b instanceof Date) {
        return a.getTime() === b.getTime()
      } else if (!isArrayA && !isArrayB) {
        var keysA = Object.keys(a);
        var keysB = Object.keys(b);
        return keysA.length === keysB.length && keysA.every(function (key) {
          return looseEqual(a[key], b[key])
        })
      } else {
        /* istanbul ignore next */
        return false
      }
    } catch (e) {
      /* istanbul ignore next */
      return false
    }
  } else if (!isObjectA && !isObjectB) {
    return String(a) === String(b)
  } else {
    return false
  }
}

/**
 * Return the first index at which a loosely equal value can be
 * found in the array (if value is a plain object, the array must
 * contain an object of the same shape), or -1 if it is not present.
 */
function looseIndexOf (arr, val) {
  for (var i = 0; i < arr.length; i++) {
    if (looseEqual(arr[i], val)) { return i }
  }
  return -1
}

/**
 * Ensure a function is called only once.
 */
function once (fn) {
  var called = false;
  return function () {
    if (!called) {
      called = true;
      fn.apply(this, arguments);
    }
  }
}

var ASSET_TYPES = [
  'component',
  'directive',
  'filter'
];

var LIFECYCLE_HOOKS = [
  'beforeCreate',
  'created',
  'beforeMount',
  'mounted',
  'beforeUpdate',
  'updated',
  'beforeDestroy',
  'destroyed',
  'activated',
  'deactivated',
  'errorCaptured',
  'serverPrefetch'
];

/*  */



var config = ({
  /**
   * Option merge strategies (used in core/util/options)
   */
  // $flow-disable-line
  optionMergeStrategies: Object.create(null),

  /**
   * Whether to suppress warnings.
   */
  silent: false,

  /**
   * Show production mode tip message on boot?
   */
  productionTip: "development" !== 'production',

  /**
   * Whether to enable devtools
   */
  devtools: "development" !== 'production',

  /**
   * Whether to record perf
   */
  performance: false,

  /**
   * Error handler for watcher errors
   */
  errorHandler: null,

  /**
   * Warn handler for watcher warns
   */
  warnHandler: null,

  /**
   * Ignore certain custom elements
   */
  ignoredElements: [],

  /**
   * Custom user key aliases for v-on
   */
  // $flow-disable-line
  keyCodes: Object.create(null),

  /**
   * Check if a tag is reserved so that it cannot be registered as a
   * component. This is platform-dependent and may be overwritten.
   */
  isReservedTag: no,

  /**
   * Check if an attribute is reserved so that it cannot be used as a component
   * prop. This is platform-dependent and may be overwritten.
   */
  isReservedAttr: no,

  /**
   * Check if a tag is an unknown element.
   * Platform-dependent.
   */
  isUnknownElement: no,

  /**
   * Get the namespace of an element
   */
  getTagNamespace: noop,

  /**
   * Parse the real tag name for the specific platform.
   */
  parsePlatformTagName: identity,

  /**
   * Check if an attribute must be bound using property, e.g. value
   * Platform-dependent.
   */
  mustUseProp: no,

  /**
   * Perform updates asynchronously. Intended to be used by Vue Test Utils
   * This will significantly reduce performance if set to false.
   */
  async: true,

  /**
   * Exposed for legacy reasons
   */
  _lifecycleHooks: LIFECYCLE_HOOKS
});

/*  */

/**
 * unicode letters used for parsing html tags, component names and property paths.
 * using https://www.w3.org/TR/html53/semantics-scripting.html#potentialcustomelementname
 * skipping \u10000-\uEFFFF due to it freezing up PhantomJS
 */
var unicodeRegExp = /a-zA-Z\u00B7\u00C0-\u00D6\u00D8-\u00F6\u00F8-\u037D\u037F-\u1FFF\u200C-\u200D\u203F-\u2040\u2070-\u218F\u2C00-\u2FEF\u3001-\uD7FF\uF900-\uFDCF\uFDF0-\uFFFD/;

/**
 * Check if a string starts with $ or _
 */
function isReserved (str) {
  var c = (str + '').charCodeAt(0);
  return c === 0x24 || c === 0x5F
}

/**
 * Define a property.
 */
function def (obj, key, val, enumerable) {
  Object.defineProperty(obj, key, {
    value: val,
    enumerable: !!enumerable,
    writable: true,
    configurable: true
  });
}

/**
 * Parse simple path.
 */
var bailRE = new RegExp(("[^" + (unicodeRegExp.source) + ".$_\\d]"));
function parsePath (path) {
  if (bailRE.test(path)) {
    return
  }
  var segments = path.split('.');
  return function (obj) {
    for (var i = 0; i < segments.length; i++) {
      if (!obj) { return }
      obj = obj[segments[i]];
    }
    return obj
  }
}

/*  */

// can we use __proto__?
var hasProto = '__proto__' in {};

// Browser environment sniffing
var inBrowser = typeof window !== 'undefined';
var inWeex = typeof WXEnvironment !== 'undefined' && !!WXEnvironment.platform;
var weexPlatform = inWeex && WXEnvironment.platform.toLowerCase();
var UA = inBrowser && window.navigator.userAgent.toLowerCase();
var isIE = UA && /msie|trident/.test(UA);
var isIE9 = UA && UA.indexOf('msie 9.0') > 0;
var isEdge = UA && UA.indexOf('edge/') > 0;
var isAndroid = (UA && UA.indexOf('android') > 0) || (weexPlatform === 'android');
var isIOS = (UA && /iphone|ipad|ipod|ios/.test(UA)) || (weexPlatform === 'ios');
var isChrome = UA && /chrome\/\d+/.test(UA) && !isEdge;
var isPhantomJS = UA && /phantomjs/.test(UA);
var isFF = UA && UA.match(/firefox\/(\d+)/);

// Firefox has a "watch" function on Object.prototype...
var nativeWatch = ({}).watch;
if (inBrowser) {
  try {
    var opts = {};
    Object.defineProperty(opts, 'passive', ({
      get: function get () {
      }
    })); // https://github.com/facebook/flow/issues/285
    window.addEventListener('test-passive', null, opts);
  } catch (e) {}
}

// this needs to be lazy-evaled because vue may be required before
// vue-server-renderer can set VUE_ENV
var _isServer;
var isServerRendering = function () {
  if (_isServer === undefined) {
    /* istanbul ignore if */
    if (!inBrowser && !inWeex && typeof global !== 'undefined') {
      // detect presence of vue-server-renderer and avoid
      // Webpack shimming the process
      _isServer = global['process'] && global['process'].env.VUE_ENV === 'server';
    } else {
      _isServer = false;
    }
  }
  return _isServer
};

// detect devtools
var devtools = inBrowser && window.__VUE_DEVTOOLS_GLOBAL_HOOK__;

/* istanbul ignore next */
function isNative (Ctor) {
  return typeof Ctor === 'function' && /native code/.test(Ctor.toString())
}

var hasSymbol =
  typeof Symbol !== 'undefined' && isNative(Symbol) &&
  typeof Reflect !== 'undefined' && isNative(Reflect.ownKeys);

var _Set;
/* istanbul ignore if */ // $flow-disable-line
if (typeof Set !== 'undefined' && isNative(Set)) {
  // use native Set when available.
  _Set = Set;
} else {
  // a non-standard Set polyfill that only works with primitive keys.
  _Set = /*@__PURE__*/(function () {
    function Set () {
      this.set = Object.create(null);
    }
    Set.prototype.has = function has (key) {
      return this.set[key] === true
    };
    Set.prototype.add = function add (key) {
      this.set[key] = true;
    };
    Set.prototype.clear = function clear () {
      this.set = Object.create(null);
    };

    return Set;
  }());
}

/*  */

var warn = noop;
var tip = noop;
var generateComponentTrace = (noop); // work around flow check
var formatComponentName = (noop);

if (true) {
  var hasConsole = typeof console !== 'undefined';
  var classifyRE = /(?:^|[-_])(\w)/g;
  var classify = function (str) { return str
    .replace(classifyRE, function (c) { return c.toUpperCase(); })
    .replace(/[-_]/g, ''); };

  warn = function (msg, vm) {
    var trace = vm ? generateComponentTrace(vm) : '';

    if (config.warnHandler) {
      config.warnHandler.call(null, msg, vm, trace);
    } else if (hasConsole && (!config.silent)) {
      console.error(("[Vue warn]: " + msg + trace));
    }
  };

  tip = function (msg, vm) {
    if (hasConsole && (!config.silent)) {
      console.warn("[Vue tip]: " + msg + (
        vm ? generateComponentTrace(vm) : ''
      ));
    }
  };

  formatComponentName = function (vm, includeFile) {
    {
      if(vm.$scope && vm.$scope.is){
        return vm.$scope.is
      }
    }
    if (vm.$root === vm) {
      return '<Root>'
    }
    var options = typeof vm === 'function' && vm.cid != null
      ? vm.options
      : vm._isVue
        ? vm.$options || vm.constructor.options
        : vm;
    var name = options.name || options._componentTag;
    var file = options.__file;
    if (!name && file) {
      var match = file.match(/([^/\\]+)\.vue$/);
      name = match && match[1];
    }

    return (
      (name ? ("<" + (classify(name)) + ">") : "<Anonymous>") +
      (file && includeFile !== false ? (" at " + file) : '')
    )
  };

  var repeat = function (str, n) {
    var res = '';
    while (n) {
      if (n % 2 === 1) { res += str; }
      if (n > 1) { str += str; }
      n >>= 1;
    }
    return res
  };

  generateComponentTrace = function (vm) {
    if (vm._isVue && vm.$parent) {
      var tree = [];
      var currentRecursiveSequence = 0;
      while (vm) {
        if (tree.length > 0) {
          var last = tree[tree.length - 1];
          if (last.constructor === vm.constructor) {
            currentRecursiveSequence++;
            vm = vm.$parent;
            continue
          } else if (currentRecursiveSequence > 0) {
            tree[tree.length - 1] = [last, currentRecursiveSequence];
            currentRecursiveSequence = 0;
          }
        }
        tree.push(vm);
        vm = vm.$parent;
      }
      return '\n\nfound in\n\n' + tree
        .map(function (vm, i) { return ("" + (i === 0 ? '---> ' : repeat(' ', 5 + i * 2)) + (Array.isArray(vm)
            ? ((formatComponentName(vm[0])) + "... (" + (vm[1]) + " recursive calls)")
            : formatComponentName(vm))); })
        .join('\n')
    } else {
      return ("\n\n(found in " + (formatComponentName(vm)) + ")")
    }
  };
}

/*  */

var uid = 0;

/**
 * A dep is an observable that can have multiple
 * directives subscribing to it.
 */
var Dep = function Dep () {
  this.id = uid++;
  this.subs = [];
};

Dep.prototype.addSub = function addSub (sub) {
  this.subs.push(sub);
};

Dep.prototype.removeSub = function removeSub (sub) {
  remove(this.subs, sub);
};

Dep.prototype.depend = function depend () {
  if (Dep.SharedObject.target) {
    Dep.SharedObject.target.addDep(this);
  }
};

Dep.prototype.notify = function notify () {
  // stabilize the subscriber list first
  var subs = this.subs.slice();
  if ( true && !config.async) {
    // subs aren't sorted in scheduler if not running async
    // we need to sort them now to make sure they fire in correct
    // order
    subs.sort(function (a, b) { return a.id - b.id; });
  }
  for (var i = 0, l = subs.length; i < l; i++) {
    subs[i].update();
  }
};

// The current target watcher being evaluated.
// This is globally unique because only one watcher
// can be evaluated at a time.
// fixed by xxxxxx (nvue shared vuex)
/* eslint-disable no-undef */
Dep.SharedObject = typeof SharedObject !== 'undefined' ? SharedObject : {};
Dep.SharedObject.target = null;
Dep.SharedObject.targetStack = [];

function pushTarget (target) {
  Dep.SharedObject.targetStack.push(target);
  Dep.SharedObject.target = target;
}

function popTarget () {
  Dep.SharedObject.targetStack.pop();
  Dep.SharedObject.target = Dep.SharedObject.targetStack[Dep.SharedObject.targetStack.length - 1];
}

/*  */

var VNode = function VNode (
  tag,
  data,
  children,
  text,
  elm,
  context,
  componentOptions,
  asyncFactory
) {
  this.tag = tag;
  this.data = data;
  this.children = children;
  this.text = text;
  this.elm = elm;
  this.ns = undefined;
  this.context = context;
  this.fnContext = undefined;
  this.fnOptions = undefined;
  this.fnScopeId = undefined;
  this.key = data && data.key;
  this.componentOptions = componentOptions;
  this.componentInstance = undefined;
  this.parent = undefined;
  this.raw = false;
  this.isStatic = false;
  this.isRootInsert = true;
  this.isComment = false;
  this.isCloned = false;
  this.isOnce = false;
  this.asyncFactory = asyncFactory;
  this.asyncMeta = undefined;
  this.isAsyncPlaceholder = false;
};

var prototypeAccessors = { child: { configurable: true } };

// DEPRECATED: alias for componentInstance for backwards compat.
/* istanbul ignore next */
prototypeAccessors.child.get = function () {
  return this.componentInstance
};

Object.defineProperties( VNode.prototype, prototypeAccessors );

var createEmptyVNode = function (text) {
  if ( text === void 0 ) text = '';

  var node = new VNode();
  node.text = text;
  node.isComment = true;
  return node
};

function createTextVNode (val) {
  return new VNode(undefined, undefined, undefined, String(val))
}

// optimized shallow clone
// used for static nodes and slot nodes because they may be reused across
// multiple renders, cloning them avoids errors when DOM manipulations rely
// on their elm reference.
function cloneVNode (vnode) {
  var cloned = new VNode(
    vnode.tag,
    vnode.data,
    // #7975
    // clone children array to avoid mutating original in case of cloning
    // a child.
    vnode.children && vnode.children.slice(),
    vnode.text,
    vnode.elm,
    vnode.context,
    vnode.componentOptions,
    vnode.asyncFactory
  );
  cloned.ns = vnode.ns;
  cloned.isStatic = vnode.isStatic;
  cloned.key = vnode.key;
  cloned.isComment = vnode.isComment;
  cloned.fnContext = vnode.fnContext;
  cloned.fnOptions = vnode.fnOptions;
  cloned.fnScopeId = vnode.fnScopeId;
  cloned.asyncMeta = vnode.asyncMeta;
  cloned.isCloned = true;
  return cloned
}

/*
 * not type checking this file because flow doesn't play well with
 * dynamically accessing methods on Array prototype
 */

var arrayProto = Array.prototype;
var arrayMethods = Object.create(arrayProto);

var methodsToPatch = [
  'push',
  'pop',
  'shift',
  'unshift',
  'splice',
  'sort',
  'reverse'
];

/**
 * Intercept mutating methods and emit events
 */
methodsToPatch.forEach(function (method) {
  // cache original method
  var original = arrayProto[method];
  def(arrayMethods, method, function mutator () {
    var args = [], len = arguments.length;
    while ( len-- ) args[ len ] = arguments[ len ];

    var result = original.apply(this, args);
    var ob = this.__ob__;
    var inserted;
    switch (method) {
      case 'push':
      case 'unshift':
        inserted = args;
        break
      case 'splice':
        inserted = args.slice(2);
        break
    }
    if (inserted) { ob.observeArray(inserted); }
    // notify change
    ob.dep.notify();
    return result
  });
});

/*  */

var arrayKeys = Object.getOwnPropertyNames(arrayMethods);

/**
 * In some cases we may want to disable observation inside a component's
 * update computation.
 */
var shouldObserve = true;

function toggleObserving (value) {
  shouldObserve = value;
}

/**
 * Observer class that is attached to each observed
 * object. Once attached, the observer converts the target
 * object's property keys into getter/setters that
 * collect dependencies and dispatch updates.
 */
var Observer = function Observer (value) {
  this.value = value;
  this.dep = new Dep();
  this.vmCount = 0;
  def(value, '__ob__', this);
  if (Array.isArray(value)) {
    if (hasProto) {
      {// fixed by xxxxxx 微信小程序使用 plugins 之后，数组方法被直接挂载到了数组对象上，需要执行 copyAugment 逻辑
        if(value.push !== value.__proto__.push){
          copyAugment(value, arrayMethods, arrayKeys);
        } else {
          protoAugment(value, arrayMethods);
        }
      }
    } else {
      copyAugment(value, arrayMethods, arrayKeys);
    }
    this.observeArray(value);
  } else {
    this.walk(value);
  }
};

/**
 * Walk through all properties and convert them into
 * getter/setters. This method should only be called when
 * value type is Object.
 */
Observer.prototype.walk = function walk (obj) {
  var keys = Object.keys(obj);
  for (var i = 0; i < keys.length; i++) {
    defineReactive$$1(obj, keys[i]);
  }
};

/**
 * Observe a list of Array items.
 */
Observer.prototype.observeArray = function observeArray (items) {
  for (var i = 0, l = items.length; i < l; i++) {
    observe(items[i]);
  }
};

// helpers

/**
 * Augment a target Object or Array by intercepting
 * the prototype chain using __proto__
 */
function protoAugment (target, src) {
  /* eslint-disable no-proto */
  target.__proto__ = src;
  /* eslint-enable no-proto */
}

/**
 * Augment a target Object or Array by defining
 * hidden properties.
 */
/* istanbul ignore next */
function copyAugment (target, src, keys) {
  for (var i = 0, l = keys.length; i < l; i++) {
    var key = keys[i];
    def(target, key, src[key]);
  }
}

/**
 * Attempt to create an observer instance for a value,
 * returns the new observer if successfully observed,
 * or the existing observer if the value already has one.
 */
function observe (value, asRootData) {
  if (!isObject(value) || value instanceof VNode) {
    return
  }
  var ob;
  if (hasOwn(value, '__ob__') && value.__ob__ instanceof Observer) {
    ob = value.__ob__;
  } else if (
    shouldObserve &&
    !isServerRendering() &&
    (Array.isArray(value) || isPlainObject(value)) &&
    Object.isExtensible(value) &&
    !value._isVue
  ) {
    ob = new Observer(value);
  }
  if (asRootData && ob) {
    ob.vmCount++;
  }
  return ob
}

/**
 * Define a reactive property on an Object.
 */
function defineReactive$$1 (
  obj,
  key,
  val,
  customSetter,
  shallow
) {
  var dep = new Dep();

  var property = Object.getOwnPropertyDescriptor(obj, key);
  if (property && property.configurable === false) {
    return
  }

  // cater for pre-defined getter/setters
  var getter = property && property.get;
  var setter = property && property.set;
  if ((!getter || setter) && arguments.length === 2) {
    val = obj[key];
  }

  var childOb = !shallow && observe(val);
  Object.defineProperty(obj, key, {
    enumerable: true,
    configurable: true,
    get: function reactiveGetter () {
      var value = getter ? getter.call(obj) : val;
      if (Dep.SharedObject.target) { // fixed by xxxxxx
        dep.depend();
        if (childOb) {
          childOb.dep.depend();
          if (Array.isArray(value)) {
            dependArray(value);
          }
        }
      }
      return value
    },
    set: function reactiveSetter (newVal) {
      var value = getter ? getter.call(obj) : val;
      /* eslint-disable no-self-compare */
      if (newVal === value || (newVal !== newVal && value !== value)) {
        return
      }
      /* eslint-enable no-self-compare */
      if ( true && customSetter) {
        customSetter();
      }
      // #7981: for accessor properties without setter
      if (getter && !setter) { return }
      if (setter) {
        setter.call(obj, newVal);
      } else {
        val = newVal;
      }
      childOb = !shallow && observe(newVal);
      dep.notify();
    }
  });
}

/**
 * Set a property on an object. Adds the new property and
 * triggers change notification if the property doesn't
 * already exist.
 */
function set (target, key, val) {
  if ( true &&
    (isUndef(target) || isPrimitive(target))
  ) {
    warn(("Cannot set reactive property on undefined, null, or primitive value: " + ((target))));
  }
  if (Array.isArray(target) && isValidArrayIndex(key)) {
    target.length = Math.max(target.length, key);
    target.splice(key, 1, val);
    return val
  }
  if (key in target && !(key in Object.prototype)) {
    target[key] = val;
    return val
  }
  var ob = (target).__ob__;
  if (target._isVue || (ob && ob.vmCount)) {
     true && warn(
      'Avoid adding reactive properties to a Vue instance or its root $data ' +
      'at runtime - declare it upfront in the data option.'
    );
    return val
  }
  if (!ob) {
    target[key] = val;
    return val
  }
  defineReactive$$1(ob.value, key, val);
  ob.dep.notify();
  return val
}

/**
 * Delete a property and trigger change if necessary.
 */
function del (target, key) {
  if ( true &&
    (isUndef(target) || isPrimitive(target))
  ) {
    warn(("Cannot delete reactive property on undefined, null, or primitive value: " + ((target))));
  }
  if (Array.isArray(target) && isValidArrayIndex(key)) {
    target.splice(key, 1);
    return
  }
  var ob = (target).__ob__;
  if (target._isVue || (ob && ob.vmCount)) {
     true && warn(
      'Avoid deleting properties on a Vue instance or its root $data ' +
      '- just set it to null.'
    );
    return
  }
  if (!hasOwn(target, key)) {
    return
  }
  delete target[key];
  if (!ob) {
    return
  }
  ob.dep.notify();
}

/**
 * Collect dependencies on array elements when the array is touched, since
 * we cannot intercept array element access like property getters.
 */
function dependArray (value) {
  for (var e = (void 0), i = 0, l = value.length; i < l; i++) {
    e = value[i];
    e && e.__ob__ && e.__ob__.dep.depend();
    if (Array.isArray(e)) {
      dependArray(e);
    }
  }
}

/*  */

/**
 * Option overwriting strategies are functions that handle
 * how to merge a parent option value and a child option
 * value into the final value.
 */
var strats = config.optionMergeStrategies;

/**
 * Options with restrictions
 */
if (true) {
  strats.el = strats.propsData = function (parent, child, vm, key) {
    if (!vm) {
      warn(
        "option \"" + key + "\" can only be used during instance " +
        'creation with the `new` keyword.'
      );
    }
    return defaultStrat(parent, child)
  };
}

/**
 * Helper that recursively merges two data objects together.
 */
function mergeData (to, from) {
  if (!from) { return to }
  var key, toVal, fromVal;

  var keys = hasSymbol
    ? Reflect.ownKeys(from)
    : Object.keys(from);

  for (var i = 0; i < keys.length; i++) {
    key = keys[i];
    // in case the object is already observed...
    if (key === '__ob__') { continue }
    toVal = to[key];
    fromVal = from[key];
    if (!hasOwn(to, key)) {
      set(to, key, fromVal);
    } else if (
      toVal !== fromVal &&
      isPlainObject(toVal) &&
      isPlainObject(fromVal)
    ) {
      mergeData(toVal, fromVal);
    }
  }
  return to
}

/**
 * Data
 */
function mergeDataOrFn (
  parentVal,
  childVal,
  vm
) {
  if (!vm) {
    // in a Vue.extend merge, both should be functions
    if (!childVal) {
      return parentVal
    }
    if (!parentVal) {
      return childVal
    }
    // when parentVal & childVal are both present,
    // we need to return a function that returns the
    // merged result of both functions... no need to
    // check if parentVal is a function here because
    // it has to be a function to pass previous merges.
    return function mergedDataFn () {
      return mergeData(
        typeof childVal === 'function' ? childVal.call(this, this) : childVal,
        typeof parentVal === 'function' ? parentVal.call(this, this) : parentVal
      )
    }
  } else {
    return function mergedInstanceDataFn () {
      // instance merge
      var instanceData = typeof childVal === 'function'
        ? childVal.call(vm, vm)
        : childVal;
      var defaultData = typeof parentVal === 'function'
        ? parentVal.call(vm, vm)
        : parentVal;
      if (instanceData) {
        return mergeData(instanceData, defaultData)
      } else {
        return defaultData
      }
    }
  }
}

strats.data = function (
  parentVal,
  childVal,
  vm
) {
  if (!vm) {
    if (childVal && typeof childVal !== 'function') {
       true && warn(
        'The "data" option should be a function ' +
        'that returns a per-instance value in component ' +
        'definitions.',
        vm
      );

      return parentVal
    }
    return mergeDataOrFn(parentVal, childVal)
  }

  return mergeDataOrFn(parentVal, childVal, vm)
};

/**
 * Hooks and props are merged as arrays.
 */
function mergeHook (
  parentVal,
  childVal
) {
  var res = childVal
    ? parentVal
      ? parentVal.concat(childVal)
      : Array.isArray(childVal)
        ? childVal
        : [childVal]
    : parentVal;
  return res
    ? dedupeHooks(res)
    : res
}

function dedupeHooks (hooks) {
  var res = [];
  for (var i = 0; i < hooks.length; i++) {
    if (res.indexOf(hooks[i]) === -1) {
      res.push(hooks[i]);
    }
  }
  return res
}

LIFECYCLE_HOOKS.forEach(function (hook) {
  strats[hook] = mergeHook;
});

/**
 * Assets
 *
 * When a vm is present (instance creation), we need to do
 * a three-way merge between constructor options, instance
 * options and parent options.
 */
function mergeAssets (
  parentVal,
  childVal,
  vm,
  key
) {
  var res = Object.create(parentVal || null);
  if (childVal) {
     true && assertObjectType(key, childVal, vm);
    return extend(res, childVal)
  } else {
    return res
  }
}

ASSET_TYPES.forEach(function (type) {
  strats[type + 's'] = mergeAssets;
});

/**
 * Watchers.
 *
 * Watchers hashes should not overwrite one
 * another, so we merge them as arrays.
 */
strats.watch = function (
  parentVal,
  childVal,
  vm,
  key
) {
  // work around Firefox's Object.prototype.watch...
  if (parentVal === nativeWatch) { parentVal = undefined; }
  if (childVal === nativeWatch) { childVal = undefined; }
  /* istanbul ignore if */
  if (!childVal) { return Object.create(parentVal || null) }
  if (true) {
    assertObjectType(key, childVal, vm);
  }
  if (!parentVal) { return childVal }
  var ret = {};
  extend(ret, parentVal);
  for (var key$1 in childVal) {
    var parent = ret[key$1];
    var child = childVal[key$1];
    if (parent && !Array.isArray(parent)) {
      parent = [parent];
    }
    ret[key$1] = parent
      ? parent.concat(child)
      : Array.isArray(child) ? child : [child];
  }
  return ret
};

/**
 * Other object hashes.
 */
strats.props =
strats.methods =
strats.inject =
strats.computed = function (
  parentVal,
  childVal,
  vm,
  key
) {
  if (childVal && "development" !== 'production') {
    assertObjectType(key, childVal, vm);
  }
  if (!parentVal) { return childVal }
  var ret = Object.create(null);
  extend(ret, parentVal);
  if (childVal) { extend(ret, childVal); }
  return ret
};
strats.provide = mergeDataOrFn;

/**
 * Default strategy.
 */
var defaultStrat = function (parentVal, childVal) {
  return childVal === undefined
    ? parentVal
    : childVal
};

/**
 * Validate component names
 */
function checkComponents (options) {
  for (var key in options.components) {
    validateComponentName(key);
  }
}

function validateComponentName (name) {
  if (!new RegExp(("^[a-zA-Z][\\-\\.0-9_" + (unicodeRegExp.source) + "]*$")).test(name)) {
    warn(
      'Invalid component name: "' + name + '". Component names ' +
      'should conform to valid custom element name in html5 specification.'
    );
  }
  if (isBuiltInTag(name) || config.isReservedTag(name)) {
    warn(
      'Do not use built-in or reserved HTML elements as component ' +
      'id: ' + name
    );
  }
}

/**
 * Ensure all props option syntax are normalized into the
 * Object-based format.
 */
function normalizeProps (options, vm) {
  var props = options.props;
  if (!props) { return }
  var res = {};
  var i, val, name;
  if (Array.isArray(props)) {
    i = props.length;
    while (i--) {
      val = props[i];
      if (typeof val === 'string') {
        name = camelize(val);
        res[name] = { type: null };
      } else if (true) {
        warn('props must be strings when using array syntax.');
      }
    }
  } else if (isPlainObject(props)) {
    for (var key in props) {
      val = props[key];
      name = camelize(key);
      res[name] = isPlainObject(val)
        ? val
        : { type: val };
    }
  } else if (true) {
    warn(
      "Invalid value for option \"props\": expected an Array or an Object, " +
      "but got " + (toRawType(props)) + ".",
      vm
    );
  }
  options.props = res;
}

/**
 * Normalize all injections into Object-based format
 */
function normalizeInject (options, vm) {
  var inject = options.inject;
  if (!inject) { return }
  var normalized = options.inject = {};
  if (Array.isArray(inject)) {
    for (var i = 0; i < inject.length; i++) {
      normalized[inject[i]] = { from: inject[i] };
    }
  } else if (isPlainObject(inject)) {
    for (var key in inject) {
      var val = inject[key];
      normalized[key] = isPlainObject(val)
        ? extend({ from: key }, val)
        : { from: val };
    }
  } else if (true) {
    warn(
      "Invalid value for option \"inject\": expected an Array or an Object, " +
      "but got " + (toRawType(inject)) + ".",
      vm
    );
  }
}

/**
 * Normalize raw function directives into object format.
 */
function normalizeDirectives (options) {
  var dirs = options.directives;
  if (dirs) {
    for (var key in dirs) {
      var def$$1 = dirs[key];
      if (typeof def$$1 === 'function') {
        dirs[key] = { bind: def$$1, update: def$$1 };
      }
    }
  }
}

function assertObjectType (name, value, vm) {
  if (!isPlainObject(value)) {
    warn(
      "Invalid value for option \"" + name + "\": expected an Object, " +
      "but got " + (toRawType(value)) + ".",
      vm
    );
  }
}

/**
 * Merge two option objects into a new one.
 * Core utility used in both instantiation and inheritance.
 */
function mergeOptions (
  parent,
  child,
  vm
) {
  if (true) {
    checkComponents(child);
  }

  if (typeof child === 'function') {
    child = child.options;
  }

  normalizeProps(child, vm);
  normalizeInject(child, vm);
  normalizeDirectives(child);

  // Apply extends and mixins on the child options,
  // but only if it is a raw options object that isn't
  // the result of another mergeOptions call.
  // Only merged options has the _base property.
  if (!child._base) {
    if (child.extends) {
      parent = mergeOptions(parent, child.extends, vm);
    }
    if (child.mixins) {
      for (var i = 0, l = child.mixins.length; i < l; i++) {
        parent = mergeOptions(parent, child.mixins[i], vm);
      }
    }
  }

  var options = {};
  var key;
  for (key in parent) {
    mergeField(key);
  }
  for (key in child) {
    if (!hasOwn(parent, key)) {
      mergeField(key);
    }
  }
  function mergeField (key) {
    var strat = strats[key] || defaultStrat;
    options[key] = strat(parent[key], child[key], vm, key);
  }
  return options
}

/**
 * Resolve an asset.
 * This function is used because child instances need access
 * to assets defined in its ancestor chain.
 */
function resolveAsset (
  options,
  type,
  id,
  warnMissing
) {
  /* istanbul ignore if */
  if (typeof id !== 'string') {
    return
  }
  var assets = options[type];
  // check local registration variations first
  if (hasOwn(assets, id)) { return assets[id] }
  var camelizedId = camelize(id);
  if (hasOwn(assets, camelizedId)) { return assets[camelizedId] }
  var PascalCaseId = capitalize(camelizedId);
  if (hasOwn(assets, PascalCaseId)) { return assets[PascalCaseId] }
  // fallback to prototype chain
  var res = assets[id] || assets[camelizedId] || assets[PascalCaseId];
  if ( true && warnMissing && !res) {
    warn(
      'Failed to resolve ' + type.slice(0, -1) + ': ' + id,
      options
    );
  }
  return res
}

/*  */



function validateProp (
  key,
  propOptions,
  propsData,
  vm
) {
  var prop = propOptions[key];
  var absent = !hasOwn(propsData, key);
  var value = propsData[key];
  // boolean casting
  var booleanIndex = getTypeIndex(Boolean, prop.type);
  if (booleanIndex > -1) {
    if (absent && !hasOwn(prop, 'default')) {
      value = false;
    } else if (value === '' || value === hyphenate(key)) {
      // only cast empty string / same name to boolean if
      // boolean has higher priority
      var stringIndex = getTypeIndex(String, prop.type);
      if (stringIndex < 0 || booleanIndex < stringIndex) {
        value = true;
      }
    }
  }
  // check default value
  if (value === undefined) {
    value = getPropDefaultValue(vm, prop, key);
    // since the default value is a fresh copy,
    // make sure to observe it.
    var prevShouldObserve = shouldObserve;
    toggleObserving(true);
    observe(value);
    toggleObserving(prevShouldObserve);
  }
  if (
    true
  ) {
    assertProp(prop, key, value, vm, absent);
  }
  return value
}

/**
 * Get the default value of a prop.
 */
function getPropDefaultValue (vm, prop, key) {
  // no default, return undefined
  if (!hasOwn(prop, 'default')) {
    return undefined
  }
  var def = prop.default;
  // warn against non-factory defaults for Object & Array
  if ( true && isObject(def)) {
    warn(
      'Invalid default value for prop "' + key + '": ' +
      'Props with type Object/Array must use a factory function ' +
      'to return the default value.',
      vm
    );
  }
  // the raw prop value was also undefined from previous render,
  // return previous default value to avoid unnecessary watcher trigger
  if (vm && vm.$options.propsData &&
    vm.$options.propsData[key] === undefined &&
    vm._props[key] !== undefined
  ) {
    return vm._props[key]
  }
  // call factory function for non-Function types
  // a value is Function if its prototype is function even across different execution context
  return typeof def === 'function' && getType(prop.type) !== 'Function'
    ? def.call(vm)
    : def
}

/**
 * Assert whether a prop is valid.
 */
function assertProp (
  prop,
  name,
  value,
  vm,
  absent
) {
  if (prop.required && absent) {
    warn(
      'Missing required prop: "' + name + '"',
      vm
    );
    return
  }
  if (value == null && !prop.required) {
    return
  }
  var type = prop.type;
  var valid = !type || type === true;
  var expectedTypes = [];
  if (type) {
    if (!Array.isArray(type)) {
      type = [type];
    }
    for (var i = 0; i < type.length && !valid; i++) {
      var assertedType = assertType(value, type[i]);
      expectedTypes.push(assertedType.expectedType || '');
      valid = assertedType.valid;
    }
  }

  if (!valid) {
    warn(
      getInvalidTypeMessage(name, value, expectedTypes),
      vm
    );
    return
  }
  var validator = prop.validator;
  if (validator) {
    if (!validator(value)) {
      warn(
        'Invalid prop: custom validator check failed for prop "' + name + '".',
        vm
      );
    }
  }
}

var simpleCheckRE = /^(String|Number|Boolean|Function|Symbol)$/;

function assertType (value, type) {
  var valid;
  var expectedType = getType(type);
  if (simpleCheckRE.test(expectedType)) {
    var t = typeof value;
    valid = t === expectedType.toLowerCase();
    // for primitive wrapper objects
    if (!valid && t === 'object') {
      valid = value instanceof type;
    }
  } else if (expectedType === 'Object') {
    valid = isPlainObject(value);
  } else if (expectedType === 'Array') {
    valid = Array.isArray(value);
  } else {
    valid = value instanceof type;
  }
  return {
    valid: valid,
    expectedType: expectedType
  }
}

/**
 * Use function string name to check built-in types,
 * because a simple equality check will fail when running
 * across different vms / iframes.
 */
function getType (fn) {
  var match = fn && fn.toString().match(/^\s*function (\w+)/);
  return match ? match[1] : ''
}

function isSameType (a, b) {
  return getType(a) === getType(b)
}

function getTypeIndex (type, expectedTypes) {
  if (!Array.isArray(expectedTypes)) {
    return isSameType(expectedTypes, type) ? 0 : -1
  }
  for (var i = 0, len = expectedTypes.length; i < len; i++) {
    if (isSameType(expectedTypes[i], type)) {
      return i
    }
  }
  return -1
}

function getInvalidTypeMessage (name, value, expectedTypes) {
  var message = "Invalid prop: type check failed for prop \"" + name + "\"." +
    " Expected " + (expectedTypes.map(capitalize).join(', '));
  var expectedType = expectedTypes[0];
  var receivedType = toRawType(value);
  var expectedValue = styleValue(value, expectedType);
  var receivedValue = styleValue(value, receivedType);
  // check if we need to specify expected value
  if (expectedTypes.length === 1 &&
      isExplicable(expectedType) &&
      !isBoolean(expectedType, receivedType)) {
    message += " with value " + expectedValue;
  }
  message += ", got " + receivedType + " ";
  // check if we need to specify received value
  if (isExplicable(receivedType)) {
    message += "with value " + receivedValue + ".";
  }
  return message
}

function styleValue (value, type) {
  if (type === 'String') {
    return ("\"" + value + "\"")
  } else if (type === 'Number') {
    return ("" + (Number(value)))
  } else {
    return ("" + value)
  }
}

function isExplicable (value) {
  var explicitTypes = ['string', 'number', 'boolean'];
  return explicitTypes.some(function (elem) { return value.toLowerCase() === elem; })
}

function isBoolean () {
  var args = [], len = arguments.length;
  while ( len-- ) args[ len ] = arguments[ len ];

  return args.some(function (elem) { return elem.toLowerCase() === 'boolean'; })
}

/*  */

function handleError (err, vm, info) {
  // Deactivate deps tracking while processing error handler to avoid possible infinite rendering.
  // See: https://github.com/vuejs/vuex/issues/1505
  pushTarget();
  try {
    if (vm) {
      var cur = vm;
      while ((cur = cur.$parent)) {
        var hooks = cur.$options.errorCaptured;
        if (hooks) {
          for (var i = 0; i < hooks.length; i++) {
            try {
              var capture = hooks[i].call(cur, err, vm, info) === false;
              if (capture) { return }
            } catch (e) {
              globalHandleError(e, cur, 'errorCaptured hook');
            }
          }
        }
      }
    }
    globalHandleError(err, vm, info);
  } finally {
    popTarget();
  }
}

function invokeWithErrorHandling (
  handler,
  context,
  args,
  vm,
  info
) {
  var res;
  try {
    res = args ? handler.apply(context, args) : handler.call(context);
    if (res && !res._isVue && isPromise(res) && !res._handled) {
      res.catch(function (e) { return handleError(e, vm, info + " (Promise/async)"); });
      // issue #9511
      // avoid catch triggering multiple times when nested calls
      res._handled = true;
    }
  } catch (e) {
    handleError(e, vm, info);
  }
  return res
}

function globalHandleError (err, vm, info) {
  if (config.errorHandler) {
    try {
      return config.errorHandler.call(null, err, vm, info)
    } catch (e) {
      // if the user intentionally throws the original error in the handler,
      // do not log it twice
      if (e !== err) {
        logError(e, null, 'config.errorHandler');
      }
    }
  }
  logError(err, vm, info);
}

function logError (err, vm, info) {
  if (true) {
    warn(("Error in " + info + ": \"" + (err.toString()) + "\""), vm);
  }
  /* istanbul ignore else */
  if ((inBrowser || inWeex) && typeof console !== 'undefined') {
    console.error(err);
  } else {
    throw err
  }
}

/*  */

var callbacks = [];
var pending = false;

function flushCallbacks () {
  pending = false;
  var copies = callbacks.slice(0);
  callbacks.length = 0;
  for (var i = 0; i < copies.length; i++) {
    copies[i]();
  }
}

// Here we have async deferring wrappers using microtasks.
// In 2.5 we used (macro) tasks (in combination with microtasks).
// However, it has subtle problems when state is changed right before repaint
// (e.g. #6813, out-in transitions).
// Also, using (macro) tasks in event handler would cause some weird behaviors
// that cannot be circumvented (e.g. #7109, #7153, #7546, #7834, #8109).
// So we now use microtasks everywhere, again.
// A major drawback of this tradeoff is that there are some scenarios
// where microtasks have too high a priority and fire in between supposedly
// sequential events (e.g. #4521, #6690, which have workarounds)
// or even between bubbling of the same event (#6566).
var timerFunc;

// The nextTick behavior leverages the microtask queue, which can be accessed
// via either native Promise.then or MutationObserver.
// MutationObserver has wider support, however it is seriously bugged in
// UIWebView in iOS >= 9.3.3 when triggered in touch event handlers. It
// completely stops working after triggering a few times... so, if native
// Promise is available, we will use it:
/* istanbul ignore next, $flow-disable-line */
if (typeof Promise !== 'undefined' && isNative(Promise)) {
  var p = Promise.resolve();
  timerFunc = function () {
    p.then(flushCallbacks);
    // In problematic UIWebViews, Promise.then doesn't completely break, but
    // it can get stuck in a weird state where callbacks are pushed into the
    // microtask queue but the queue isn't being flushed, until the browser
    // needs to do some other work, e.g. handle a timer. Therefore we can
    // "force" the microtask queue to be flushed by adding an empty timer.
    if (isIOS) { setTimeout(noop); }
  };
} else if (!isIE && typeof MutationObserver !== 'undefined' && (
  isNative(MutationObserver) ||
  // PhantomJS and iOS 7.x
  MutationObserver.toString() === '[object MutationObserverConstructor]'
)) {
  // Use MutationObserver where native Promise is not available,
  // e.g. PhantomJS, iOS7, Android 4.4
  // (#6466 MutationObserver is unreliable in IE11)
  var counter = 1;
  var observer = new MutationObserver(flushCallbacks);
  var textNode = document.createTextNode(String(counter));
  observer.observe(textNode, {
    characterData: true
  });
  timerFunc = function () {
    counter = (counter + 1) % 2;
    textNode.data = String(counter);
  };
} else if (typeof setImmediate !== 'undefined' && isNative(setImmediate)) {
  // Fallback to setImmediate.
  // Techinically it leverages the (macro) task queue,
  // but it is still a better choice than setTimeout.
  timerFunc = function () {
    setImmediate(flushCallbacks);
  };
} else {
  // Fallback to setTimeout.
  timerFunc = function () {
    setTimeout(flushCallbacks, 0);
  };
}

function nextTick (cb, ctx) {
  var _resolve;
  callbacks.push(function () {
    if (cb) {
      try {
        cb.call(ctx);
      } catch (e) {
        handleError(e, ctx, 'nextTick');
      }
    } else if (_resolve) {
      _resolve(ctx);
    }
  });
  if (!pending) {
    pending = true;
    timerFunc();
  }
  // $flow-disable-line
  if (!cb && typeof Promise !== 'undefined') {
    return new Promise(function (resolve) {
      _resolve = resolve;
    })
  }
}

/*  */

/* not type checking this file because flow doesn't play well with Proxy */

var initProxy;

if (true) {
  var allowedGlobals = makeMap(
    'Infinity,undefined,NaN,isFinite,isNaN,' +
    'parseFloat,parseInt,decodeURI,decodeURIComponent,encodeURI,encodeURIComponent,' +
    'Math,Number,Date,Array,Object,Boolean,String,RegExp,Map,Set,JSON,Intl,' +
    'require' // for Webpack/Browserify
  );

  var warnNonPresent = function (target, key) {
    warn(
      "Property or method \"" + key + "\" is not defined on the instance but " +
      'referenced during render. Make sure that this property is reactive, ' +
      'either in the data option, or for class-based components, by ' +
      'initializing the property. ' +
      'See: https://vuejs.org/v2/guide/reactivity.html#Declaring-Reactive-Properties.',
      target
    );
  };

  var warnReservedPrefix = function (target, key) {
    warn(
      "Property \"" + key + "\" must be accessed with \"$data." + key + "\" because " +
      'properties starting with "$" or "_" are not proxied in the Vue instance to ' +
      'prevent conflicts with Vue internals' +
      'See: https://vuejs.org/v2/api/#data',
      target
    );
  };

  var hasProxy =
    typeof Proxy !== 'undefined' && isNative(Proxy);

  if (hasProxy) {
    var isBuiltInModifier = makeMap('stop,prevent,self,ctrl,shift,alt,meta,exact');
    config.keyCodes = new Proxy(config.keyCodes, {
      set: function set (target, key, value) {
        if (isBuiltInModifier(key)) {
          warn(("Avoid overwriting built-in modifier in config.keyCodes: ." + key));
          return false
        } else {
          target[key] = value;
          return true
        }
      }
    });
  }

  var hasHandler = {
    has: function has (target, key) {
      var has = key in target;
      var isAllowed = allowedGlobals(key) ||
        (typeof key === 'string' && key.charAt(0) === '_' && !(key in target.$data));
      if (!has && !isAllowed) {
        if (key in target.$data) { warnReservedPrefix(target, key); }
        else { warnNonPresent(target, key); }
      }
      return has || !isAllowed
    }
  };

  var getHandler = {
    get: function get (target, key) {
      if (typeof key === 'string' && !(key in target)) {
        if (key in target.$data) { warnReservedPrefix(target, key); }
        else { warnNonPresent(target, key); }
      }
      return target[key]
    }
  };

  initProxy = function initProxy (vm) {
    if (hasProxy) {
      // determine which proxy handler to use
      var options = vm.$options;
      var handlers = options.render && options.render._withStripped
        ? getHandler
        : hasHandler;
      vm._renderProxy = new Proxy(vm, handlers);
    } else {
      vm._renderProxy = vm;
    }
  };
}

/*  */

var seenObjects = new _Set();

/**
 * Recursively traverse an object to evoke all converted
 * getters, so that every nested property inside the object
 * is collected as a "deep" dependency.
 */
function traverse (val) {
  _traverse(val, seenObjects);
  seenObjects.clear();
}

function _traverse (val, seen) {
  var i, keys;
  var isA = Array.isArray(val);
  if ((!isA && !isObject(val)) || Object.isFrozen(val) || val instanceof VNode) {
    return
  }
  if (val.__ob__) {
    var depId = val.__ob__.dep.id;
    if (seen.has(depId)) {
      return
    }
    seen.add(depId);
  }
  if (isA) {
    i = val.length;
    while (i--) { _traverse(val[i], seen); }
  } else {
    keys = Object.keys(val);
    i = keys.length;
    while (i--) { _traverse(val[keys[i]], seen); }
  }
}

var mark;
var measure;

if (true) {
  var perf = inBrowser && window.performance;
  /* istanbul ignore if */
  if (
    perf &&
    perf.mark &&
    perf.measure &&
    perf.clearMarks &&
    perf.clearMeasures
  ) {
    mark = function (tag) { return perf.mark(tag); };
    measure = function (name, startTag, endTag) {
      perf.measure(name, startTag, endTag);
      perf.clearMarks(startTag);
      perf.clearMarks(endTag);
      // perf.clearMeasures(name)
    };
  }
}

/*  */

var normalizeEvent = cached(function (name) {
  var passive = name.charAt(0) === '&';
  name = passive ? name.slice(1) : name;
  var once$$1 = name.charAt(0) === '~'; // Prefixed last, checked first
  name = once$$1 ? name.slice(1) : name;
  var capture = name.charAt(0) === '!';
  name = capture ? name.slice(1) : name;
  return {
    name: name,
    once: once$$1,
    capture: capture,
    passive: passive
  }
});

function createFnInvoker (fns, vm) {
  function invoker () {
    var arguments$1 = arguments;

    var fns = invoker.fns;
    if (Array.isArray(fns)) {
      var cloned = fns.slice();
      for (var i = 0; i < cloned.length; i++) {
        invokeWithErrorHandling(cloned[i], null, arguments$1, vm, "v-on handler");
      }
    } else {
      // return handler return value for single handlers
      return invokeWithErrorHandling(fns, null, arguments, vm, "v-on handler")
    }
  }
  invoker.fns = fns;
  return invoker
}

function updateListeners (
  on,
  oldOn,
  add,
  remove$$1,
  createOnceHandler,
  vm
) {
  var name, def$$1, cur, old, event;
  for (name in on) {
    def$$1 = cur = on[name];
    old = oldOn[name];
    event = normalizeEvent(name);
    if (isUndef(cur)) {
       true && warn(
        "Invalid handler for event \"" + (event.name) + "\": got " + String(cur),
        vm
      );
    } else if (isUndef(old)) {
      if (isUndef(cur.fns)) {
        cur = on[name] = createFnInvoker(cur, vm);
      }
      if (isTrue(event.once)) {
        cur = on[name] = createOnceHandler(event.name, cur, event.capture);
      }
      add(event.name, cur, event.capture, event.passive, event.params);
    } else if (cur !== old) {
      old.fns = cur;
      on[name] = old;
    }
  }
  for (name in oldOn) {
    if (isUndef(on[name])) {
      event = normalizeEvent(name);
      remove$$1(event.name, oldOn[name], event.capture);
    }
  }
}

/*  */

/*  */

function extractPropsFromVNodeData (
  data,
  Ctor,
  tag
) {
  // we are only extracting raw values here.
  // validation and default values are handled in the child
  // component itself.
  var propOptions = Ctor.options.props;
  if (isUndef(propOptions)) {
    return
  }
  var res = {};
  var attrs = data.attrs;
  var props = data.props;
  if (isDef(attrs) || isDef(props)) {
    for (var key in propOptions) {
      var altKey = hyphenate(key);
      if (true) {
        var keyInLowerCase = key.toLowerCase();
        if (
          key !== keyInLowerCase &&
          attrs && hasOwn(attrs, keyInLowerCase)
        ) {
          tip(
            "Prop \"" + keyInLowerCase + "\" is passed to component " +
            (formatComponentName(tag || Ctor)) + ", but the declared prop name is" +
            " \"" + key + "\". " +
            "Note that HTML attributes are case-insensitive and camelCased " +
            "props need to use their kebab-case equivalents when using in-DOM " +
            "templates. You should probably use \"" + altKey + "\" instead of \"" + key + "\"."
          );
        }
      }
      checkProp(res, props, key, altKey, true) ||
      checkProp(res, attrs, key, altKey, false);
    }
  }
  return res
}

function checkProp (
  res,
  hash,
  key,
  altKey,
  preserve
) {
  if (isDef(hash)) {
    if (hasOwn(hash, key)) {
      res[key] = hash[key];
      if (!preserve) {
        delete hash[key];
      }
      return true
    } else if (hasOwn(hash, altKey)) {
      res[key] = hash[altKey];
      if (!preserve) {
        delete hash[altKey];
      }
      return true
    }
  }
  return false
}

/*  */

// The template compiler attempts to minimize the need for normalization by
// statically analyzing the template at compile time.
//
// For plain HTML markup, normalization can be completely skipped because the
// generated render function is guaranteed to return Array<VNode>. There are
// two cases where extra normalization is needed:

// 1. When the children contains components - because a functional component
// may return an Array instead of a single root. In this case, just a simple
// normalization is needed - if any child is an Array, we flatten the whole
// thing with Array.prototype.concat. It is guaranteed to be only 1-level deep
// because functional components already normalize their own children.
function simpleNormalizeChildren (children) {
  for (var i = 0; i < children.length; i++) {
    if (Array.isArray(children[i])) {
      return Array.prototype.concat.apply([], children)
    }
  }
  return children
}

// 2. When the children contains constructs that always generated nested Arrays,
// e.g. <template>, <slot>, v-for, or when the children is provided by user
// with hand-written render functions / JSX. In such cases a full normalization
// is needed to cater to all possible types of children values.
function normalizeChildren (children) {
  return isPrimitive(children)
    ? [createTextVNode(children)]
    : Array.isArray(children)
      ? normalizeArrayChildren(children)
      : undefined
}

function isTextNode (node) {
  return isDef(node) && isDef(node.text) && isFalse(node.isComment)
}

function normalizeArrayChildren (children, nestedIndex) {
  var res = [];
  var i, c, lastIndex, last;
  for (i = 0; i < children.length; i++) {
    c = children[i];
    if (isUndef(c) || typeof c === 'boolean') { continue }
    lastIndex = res.length - 1;
    last = res[lastIndex];
    //  nested
    if (Array.isArray(c)) {
      if (c.length > 0) {
        c = normalizeArrayChildren(c, ((nestedIndex || '') + "_" + i));
        // merge adjacent text nodes
        if (isTextNode(c[0]) && isTextNode(last)) {
          res[lastIndex] = createTextVNode(last.text + (c[0]).text);
          c.shift();
        }
        res.push.apply(res, c);
      }
    } else if (isPrimitive(c)) {
      if (isTextNode(last)) {
        // merge adjacent text nodes
        // this is necessary for SSR hydration because text nodes are
        // essentially merged when rendered to HTML strings
        res[lastIndex] = createTextVNode(last.text + c);
      } else if (c !== '') {
        // convert primitive to vnode
        res.push(createTextVNode(c));
      }
    } else {
      if (isTextNode(c) && isTextNode(last)) {
        // merge adjacent text nodes
        res[lastIndex] = createTextVNode(last.text + c.text);
      } else {
        // default key for nested array children (likely generated by v-for)
        if (isTrue(children._isVList) &&
          isDef(c.tag) &&
          isUndef(c.key) &&
          isDef(nestedIndex)) {
          c.key = "__vlist" + nestedIndex + "_" + i + "__";
        }
        res.push(c);
      }
    }
  }
  return res
}

/*  */

function initProvide (vm) {
  var provide = vm.$options.provide;
  if (provide) {
    vm._provided = typeof provide === 'function'
      ? provide.call(vm)
      : provide;
  }
}

function initInjections (vm) {
  var result = resolveInject(vm.$options.inject, vm);
  if (result) {
    toggleObserving(false);
    Object.keys(result).forEach(function (key) {
      /* istanbul ignore else */
      if (true) {
        defineReactive$$1(vm, key, result[key], function () {
          warn(
            "Avoid mutating an injected value directly since the changes will be " +
            "overwritten whenever the provided component re-renders. " +
            "injection being mutated: \"" + key + "\"",
            vm
          );
        });
      } else {}
    });
    toggleObserving(true);
  }
}

function resolveInject (inject, vm) {
  if (inject) {
    // inject is :any because flow is not smart enough to figure out cached
    var result = Object.create(null);
    var keys = hasSymbol
      ? Reflect.ownKeys(inject)
      : Object.keys(inject);

    for (var i = 0; i < keys.length; i++) {
      var key = keys[i];
      // #6574 in case the inject object is observed...
      if (key === '__ob__') { continue }
      var provideKey = inject[key].from;
      var source = vm;
      while (source) {
        if (source._provided && hasOwn(source._provided, provideKey)) {
          result[key] = source._provided[provideKey];
          break
        }
        source = source.$parent;
      }
      if (!source) {
        if ('default' in inject[key]) {
          var provideDefault = inject[key].default;
          result[key] = typeof provideDefault === 'function'
            ? provideDefault.call(vm)
            : provideDefault;
        } else if (true) {
          warn(("Injection \"" + key + "\" not found"), vm);
        }
      }
    }
    return result
  }
}

/*  */



/**
 * Runtime helper for resolving raw children VNodes into a slot object.
 */
function resolveSlots (
  children,
  context
) {
  if (!children || !children.length) {
    return {}
  }
  var slots = {};
  for (var i = 0, l = children.length; i < l; i++) {
    var child = children[i];
    var data = child.data;
    // remove slot attribute if the node is resolved as a Vue slot node
    if (data && data.attrs && data.attrs.slot) {
      delete data.attrs.slot;
    }
    // named slots should only be respected if the vnode was rendered in the
    // same context.
    if ((child.context === context || child.fnContext === context) &&
      data && data.slot != null
    ) {
      var name = data.slot;
      var slot = (slots[name] || (slots[name] = []));
      if (child.tag === 'template') {
        slot.push.apply(slot, child.children || []);
      } else {
        slot.push(child);
      }
    } else {
      // fixed by xxxxxx 临时 hack 掉 uni-app 中的异步 name slot page
      if(child.asyncMeta && child.asyncMeta.data && child.asyncMeta.data.slot === 'page'){
        (slots['page'] || (slots['page'] = [])).push(child);
      }else{
        (slots.default || (slots.default = [])).push(child);
      }
    }
  }
  // ignore slots that contains only whitespace
  for (var name$1 in slots) {
    if (slots[name$1].every(isWhitespace)) {
      delete slots[name$1];
    }
  }
  return slots
}

function isWhitespace (node) {
  return (node.isComment && !node.asyncFactory) || node.text === ' '
}

/*  */

function normalizeScopedSlots (
  slots,
  normalSlots,
  prevSlots
) {
  var res;
  var hasNormalSlots = Object.keys(normalSlots).length > 0;
  var isStable = slots ? !!slots.$stable : !hasNormalSlots;
  var key = slots && slots.$key;
  if (!slots) {
    res = {};
  } else if (slots._normalized) {
    // fast path 1: child component re-render only, parent did not change
    return slots._normalized
  } else if (
    isStable &&
    prevSlots &&
    prevSlots !== emptyObject &&
    key === prevSlots.$key &&
    !hasNormalSlots &&
    !prevSlots.$hasNormal
  ) {
    // fast path 2: stable scoped slots w/ no normal slots to proxy,
    // only need to normalize once
    return prevSlots
  } else {
    res = {};
    for (var key$1 in slots) {
      if (slots[key$1] && key$1[0] !== '$') {
        res[key$1] = normalizeScopedSlot(normalSlots, key$1, slots[key$1]);
      }
    }
  }
  // expose normal slots on scopedSlots
  for (var key$2 in normalSlots) {
    if (!(key$2 in res)) {
      res[key$2] = proxyNormalSlot(normalSlots, key$2);
    }
  }
  // avoriaz seems to mock a non-extensible $scopedSlots object
  // and when that is passed down this would cause an error
  if (slots && Object.isExtensible(slots)) {
    (slots)._normalized = res;
  }
  def(res, '$stable', isStable);
  def(res, '$key', key);
  def(res, '$hasNormal', hasNormalSlots);
  return res
}

function normalizeScopedSlot(normalSlots, key, fn) {
  var normalized = function () {
    var res = arguments.length ? fn.apply(null, arguments) : fn({});
    res = res && typeof res === 'object' && !Array.isArray(res)
      ? [res] // single vnode
      : normalizeChildren(res);
    return res && (
      res.length === 0 ||
      (res.length === 1 && res[0].isComment) // #9658
    ) ? undefined
      : res
  };
  // this is a slot using the new v-slot syntax without scope. although it is
  // compiled as a scoped slot, render fn users would expect it to be present
  // on this.$slots because the usage is semantically a normal slot.
  if (fn.proxy) {
    Object.defineProperty(normalSlots, key, {
      get: normalized,
      enumerable: true,
      configurable: true
    });
  }
  return normalized
}

function proxyNormalSlot(slots, key) {
  return function () { return slots[key]; }
}

/*  */

/**
 * Runtime helper for rendering v-for lists.
 */
function renderList (
  val,
  render
) {
  var ret, i, l, keys, key;
  if (Array.isArray(val) || typeof val === 'string') {
    ret = new Array(val.length);
    for (i = 0, l = val.length; i < l; i++) {
      ret[i] = render(val[i], i);
    }
  } else if (typeof val === 'number') {
    ret = new Array(val);
    for (i = 0; i < val; i++) {
      ret[i] = render(i + 1, i);
    }
  } else if (isObject(val)) {
    if (hasSymbol && val[Symbol.iterator]) {
      ret = [];
      var iterator = val[Symbol.iterator]();
      var result = iterator.next();
      while (!result.done) {
        ret.push(render(result.value, ret.length));
        result = iterator.next();
      }
    } else {
      keys = Object.keys(val);
      ret = new Array(keys.length);
      for (i = 0, l = keys.length; i < l; i++) {
        key = keys[i];
        ret[i] = render(val[key], key, i);
      }
    }
  }
  if (!isDef(ret)) {
    ret = [];
  }
  (ret)._isVList = true;
  return ret
}

/*  */

/**
 * Runtime helper for rendering <slot>
 */
function renderSlot (
  name,
  fallback,
  props,
  bindObject
) {
  var scopedSlotFn = this.$scopedSlots[name];
  var nodes;
  if (scopedSlotFn) { // scoped slot
    props = props || {};
    if (bindObject) {
      if ( true && !isObject(bindObject)) {
        warn(
          'slot v-bind without argument expects an Object',
          this
        );
      }
      props = extend(extend({}, bindObject), props);
    }
    nodes = scopedSlotFn(props) || fallback;
  } else {
    nodes = this.$slots[name] || fallback;
  }

  var target = props && props.slot;
  if (target) {
    return this.$createElement('template', { slot: target }, nodes)
  } else {
    return nodes
  }
}

/*  */

/**
 * Runtime helper for resolving filters
 */
function resolveFilter (id) {
  return resolveAsset(this.$options, 'filters', id, true) || identity
}

/*  */

function isKeyNotMatch (expect, actual) {
  if (Array.isArray(expect)) {
    return expect.indexOf(actual) === -1
  } else {
    return expect !== actual
  }
}

/**
 * Runtime helper for checking keyCodes from config.
 * exposed as Vue.prototype._k
 * passing in eventKeyName as last argument separately for backwards compat
 */
function checkKeyCodes (
  eventKeyCode,
  key,
  builtInKeyCode,
  eventKeyName,
  builtInKeyName
) {
  var mappedKeyCode = config.keyCodes[key] || builtInKeyCode;
  if (builtInKeyName && eventKeyName && !config.keyCodes[key]) {
    return isKeyNotMatch(builtInKeyName, eventKeyName)
  } else if (mappedKeyCode) {
    return isKeyNotMatch(mappedKeyCode, eventKeyCode)
  } else if (eventKeyName) {
    return hyphenate(eventKeyName) !== key
  }
}

/*  */

/**
 * Runtime helper for merging v-bind="object" into a VNode's data.
 */
function bindObjectProps (
  data,
  tag,
  value,
  asProp,
  isSync
) {
  if (value) {
    if (!isObject(value)) {
       true && warn(
        'v-bind without argument expects an Object or Array value',
        this
      );
    } else {
      if (Array.isArray(value)) {
        value = toObject(value);
      }
      var hash;
      var loop = function ( key ) {
        if (
          key === 'class' ||
          key === 'style' ||
          isReservedAttribute(key)
        ) {
          hash = data;
        } else {
          var type = data.attrs && data.attrs.type;
          hash = asProp || config.mustUseProp(tag, type, key)
            ? data.domProps || (data.domProps = {})
            : data.attrs || (data.attrs = {});
        }
        var camelizedKey = camelize(key);
        var hyphenatedKey = hyphenate(key);
        if (!(camelizedKey in hash) && !(hyphenatedKey in hash)) {
          hash[key] = value[key];

          if (isSync) {
            var on = data.on || (data.on = {});
            on[("update:" + key)] = function ($event) {
              value[key] = $event;
            };
          }
        }
      };

      for (var key in value) loop( key );
    }
  }
  return data
}

/*  */

/**
 * Runtime helper for rendering static trees.
 */
function renderStatic (
  index,
  isInFor
) {
  var cached = this._staticTrees || (this._staticTrees = []);
  var tree = cached[index];
  // if has already-rendered static tree and not inside v-for,
  // we can reuse the same tree.
  if (tree && !isInFor) {
    return tree
  }
  // otherwise, render a fresh tree.
  tree = cached[index] = this.$options.staticRenderFns[index].call(
    this._renderProxy,
    null,
    this // for render fns generated for functional component templates
  );
  markStatic(tree, ("__static__" + index), false);
  return tree
}

/**
 * Runtime helper for v-once.
 * Effectively it means marking the node as static with a unique key.
 */
function markOnce (
  tree,
  index,
  key
) {
  markStatic(tree, ("__once__" + index + (key ? ("_" + key) : "")), true);
  return tree
}

function markStatic (
  tree,
  key,
  isOnce
) {
  if (Array.isArray(tree)) {
    for (var i = 0; i < tree.length; i++) {
      if (tree[i] && typeof tree[i] !== 'string') {
        markStaticNode(tree[i], (key + "_" + i), isOnce);
      }
    }
  } else {
    markStaticNode(tree, key, isOnce);
  }
}

function markStaticNode (node, key, isOnce) {
  node.isStatic = true;
  node.key = key;
  node.isOnce = isOnce;
}

/*  */

function bindObjectListeners (data, value) {
  if (value) {
    if (!isPlainObject(value)) {
       true && warn(
        'v-on without argument expects an Object value',
        this
      );
    } else {
      var on = data.on = data.on ? extend({}, data.on) : {};
      for (var key in value) {
        var existing = on[key];
        var ours = value[key];
        on[key] = existing ? [].concat(existing, ours) : ours;
      }
    }
  }
  return data
}

/*  */

function resolveScopedSlots (
  fns, // see flow/vnode
  res,
  // the following are added in 2.6
  hasDynamicKeys,
  contentHashKey
) {
  res = res || { $stable: !hasDynamicKeys };
  for (var i = 0; i < fns.length; i++) {
    var slot = fns[i];
    if (Array.isArray(slot)) {
      resolveScopedSlots(slot, res, hasDynamicKeys);
    } else if (slot) {
      // marker for reverse proxying v-slot without scope on this.$slots
      if (slot.proxy) {
        slot.fn.proxy = true;
      }
      res[slot.key] = slot.fn;
    }
  }
  if (contentHashKey) {
    (res).$key = contentHashKey;
  }
  return res
}

/*  */

function bindDynamicKeys (baseObj, values) {
  for (var i = 0; i < values.length; i += 2) {
    var key = values[i];
    if (typeof key === 'string' && key) {
      baseObj[values[i]] = values[i + 1];
    } else if ( true && key !== '' && key !== null) {
      // null is a speical value for explicitly removing a binding
      warn(
        ("Invalid value for dynamic directive argument (expected string or null): " + key),
        this
      );
    }
  }
  return baseObj
}

// helper to dynamically append modifier runtime markers to event names.
// ensure only append when value is already string, otherwise it will be cast
// to string and cause the type check to miss.
function prependModifier (value, symbol) {
  return typeof value === 'string' ? symbol + value : value
}

/*  */

function installRenderHelpers (target) {
  target._o = markOnce;
  target._n = toNumber;
  target._s = toString;
  target._l = renderList;
  target._t = renderSlot;
  target._q = looseEqual;
  target._i = looseIndexOf;
  target._m = renderStatic;
  target._f = resolveFilter;
  target._k = checkKeyCodes;
  target._b = bindObjectProps;
  target._v = createTextVNode;
  target._e = createEmptyVNode;
  target._u = resolveScopedSlots;
  target._g = bindObjectListeners;
  target._d = bindDynamicKeys;
  target._p = prependModifier;
}

/*  */

function FunctionalRenderContext (
  data,
  props,
  children,
  parent,
  Ctor
) {
  var this$1 = this;

  var options = Ctor.options;
  // ensure the createElement function in functional components
  // gets a unique context - this is necessary for correct named slot check
  var contextVm;
  if (hasOwn(parent, '_uid')) {
    contextVm = Object.create(parent);
    // $flow-disable-line
    contextVm._original = parent;
  } else {
    // the context vm passed in is a functional context as well.
    // in this case we want to make sure we are able to get a hold to the
    // real context instance.
    contextVm = parent;
    // $flow-disable-line
    parent = parent._original;
  }
  var isCompiled = isTrue(options._compiled);
  var needNormalization = !isCompiled;

  this.data = data;
  this.props = props;
  this.children = children;
  this.parent = parent;
  this.listeners = data.on || emptyObject;
  this.injections = resolveInject(options.inject, parent);
  this.slots = function () {
    if (!this$1.$slots) {
      normalizeScopedSlots(
        data.scopedSlots,
        this$1.$slots = resolveSlots(children, parent)
      );
    }
    return this$1.$slots
  };

  Object.defineProperty(this, 'scopedSlots', ({
    enumerable: true,
    get: function get () {
      return normalizeScopedSlots(data.scopedSlots, this.slots())
    }
  }));

  // support for compiled functional template
  if (isCompiled) {
    // exposing $options for renderStatic()
    this.$options = options;
    // pre-resolve slots for renderSlot()
    this.$slots = this.slots();
    this.$scopedSlots = normalizeScopedSlots(data.scopedSlots, this.$slots);
  }

  if (options._scopeId) {
    this._c = function (a, b, c, d) {
      var vnode = createElement(contextVm, a, b, c, d, needNormalization);
      if (vnode && !Array.isArray(vnode)) {
        vnode.fnScopeId = options._scopeId;
        vnode.fnContext = parent;
      }
      return vnode
    };
  } else {
    this._c = function (a, b, c, d) { return createElement(contextVm, a, b, c, d, needNormalization); };
  }
}

installRenderHelpers(FunctionalRenderContext.prototype);

function createFunctionalComponent (
  Ctor,
  propsData,
  data,
  contextVm,
  children
) {
  var options = Ctor.options;
  var props = {};
  var propOptions = options.props;
  if (isDef(propOptions)) {
    for (var key in propOptions) {
      props[key] = validateProp(key, propOptions, propsData || emptyObject);
    }
  } else {
    if (isDef(data.attrs)) { mergeProps(props, data.attrs); }
    if (isDef(data.props)) { mergeProps(props, data.props); }
  }

  var renderContext = new FunctionalRenderContext(
    data,
    props,
    children,
    contextVm,
    Ctor
  );

  var vnode = options.render.call(null, renderContext._c, renderContext);

  if (vnode instanceof VNode) {
    return cloneAndMarkFunctionalResult(vnode, data, renderContext.parent, options, renderContext)
  } else if (Array.isArray(vnode)) {
    var vnodes = normalizeChildren(vnode) || [];
    var res = new Array(vnodes.length);
    for (var i = 0; i < vnodes.length; i++) {
      res[i] = cloneAndMarkFunctionalResult(vnodes[i], data, renderContext.parent, options, renderContext);
    }
    return res
  }
}

function cloneAndMarkFunctionalResult (vnode, data, contextVm, options, renderContext) {
  // #7817 clone node before setting fnContext, otherwise if the node is reused
  // (e.g. it was from a cached normal slot) the fnContext causes named slots
  // that should not be matched to match.
  var clone = cloneVNode(vnode);
  clone.fnContext = contextVm;
  clone.fnOptions = options;
  if (true) {
    (clone.devtoolsMeta = clone.devtoolsMeta || {}).renderContext = renderContext;
  }
  if (data.slot) {
    (clone.data || (clone.data = {})).slot = data.slot;
  }
  return clone
}

function mergeProps (to, from) {
  for (var key in from) {
    to[camelize(key)] = from[key];
  }
}

/*  */

/*  */

/*  */

/*  */

// inline hooks to be invoked on component VNodes during patch
var componentVNodeHooks = {
  init: function init (vnode, hydrating) {
    if (
      vnode.componentInstance &&
      !vnode.componentInstance._isDestroyed &&
      vnode.data.keepAlive
    ) {
      // kept-alive components, treat as a patch
      var mountedNode = vnode; // work around flow
      componentVNodeHooks.prepatch(mountedNode, mountedNode);
    } else {
      var child = vnode.componentInstance = createComponentInstanceForVnode(
        vnode,
        activeInstance
      );
      child.$mount(hydrating ? vnode.elm : undefined, hydrating);
    }
  },

  prepatch: function prepatch (oldVnode, vnode) {
    var options = vnode.componentOptions;
    var child = vnode.componentInstance = oldVnode.componentInstance;
    updateChildComponent(
      child,
      options.propsData, // updated props
      options.listeners, // updated listeners
      vnode, // new parent vnode
      options.children // new children
    );
  },

  insert: function insert (vnode) {
    var context = vnode.context;
    var componentInstance = vnode.componentInstance;
    if (!componentInstance._isMounted) {
      componentInstance._isMounted = true;
      callHook(componentInstance, 'mounted');
    }
    if (vnode.data.keepAlive) {
      if (context._isMounted) {
        // vue-router#1212
        // During updates, a kept-alive component's child components may
        // change, so directly walking the tree here may call activated hooks
        // on incorrect children. Instead we push them into a queue which will
        // be processed after the whole patch process ended.
        queueActivatedComponent(componentInstance);
      } else {
        activateChildComponent(componentInstance, true /* direct */);
      }
    }
  },

  destroy: function destroy (vnode) {
    var componentInstance = vnode.componentInstance;
    if (!componentInstance._isDestroyed) {
      if (!vnode.data.keepAlive) {
        componentInstance.$destroy();
      } else {
        deactivateChildComponent(componentInstance, true /* direct */);
      }
    }
  }
};

var hooksToMerge = Object.keys(componentVNodeHooks);

function createComponent (
  Ctor,
  data,
  context,
  children,
  tag
) {
  if (isUndef(Ctor)) {
    return
  }

  var baseCtor = context.$options._base;

  // plain options object: turn it into a constructor
  if (isObject(Ctor)) {
    Ctor = baseCtor.extend(Ctor);
  }

  // if at this stage it's not a constructor or an async component factory,
  // reject.
  if (typeof Ctor !== 'function') {
    if (true) {
      warn(("Invalid Component definition: " + (String(Ctor))), context);
    }
    return
  }

  // async component
  var asyncFactory;
  if (isUndef(Ctor.cid)) {
    asyncFactory = Ctor;
    Ctor = resolveAsyncComponent(asyncFactory, baseCtor);
    if (Ctor === undefined) {
      // return a placeholder node for async component, which is rendered
      // as a comment node but preserves all the raw information for the node.
      // the information will be used for async server-rendering and hydration.
      return createAsyncPlaceholder(
        asyncFactory,
        data,
        context,
        children,
        tag
      )
    }
  }

  data = data || {};

  // resolve constructor options in case global mixins are applied after
  // component constructor creation
  resolveConstructorOptions(Ctor);

  // transform component v-model data into props & events
  if (isDef(data.model)) {
    transformModel(Ctor.options, data);
  }

  // extract props
  var propsData = extractPropsFromVNodeData(data, Ctor, tag);

  // functional component
  if (isTrue(Ctor.options.functional)) {
    return createFunctionalComponent(Ctor, propsData, data, context, children)
  }

  // extract listeners, since these needs to be treated as
  // child component listeners instead of DOM listeners
  var listeners = data.on;
  // replace with listeners with .native modifier
  // so it gets processed during parent component patch.
  data.on = data.nativeOn;

  if (isTrue(Ctor.options.abstract)) {
    // abstract components do not keep anything
    // other than props & listeners & slot

    // work around flow
    var slot = data.slot;
    data = {};
    if (slot) {
      data.slot = slot;
    }
  }

  // install component management hooks onto the placeholder node
  installComponentHooks(data);

  // return a placeholder vnode
  var name = Ctor.options.name || tag;
  var vnode = new VNode(
    ("vue-component-" + (Ctor.cid) + (name ? ("-" + name) : '')),
    data, undefined, undefined, undefined, context,
    { Ctor: Ctor, propsData: propsData, listeners: listeners, tag: tag, children: children },
    asyncFactory
  );

  return vnode
}

function createComponentInstanceForVnode (
  vnode, // we know it's MountedComponentVNode but flow doesn't
  parent // activeInstance in lifecycle state
) {
  var options = {
    _isComponent: true,
    _parentVnode: vnode,
    parent: parent
  };
  // check inline-template render functions
  var inlineTemplate = vnode.data.inlineTemplate;
  if (isDef(inlineTemplate)) {
    options.render = inlineTemplate.render;
    options.staticRenderFns = inlineTemplate.staticRenderFns;
  }
  return new vnode.componentOptions.Ctor(options)
}

function installComponentHooks (data) {
  var hooks = data.hook || (data.hook = {});
  for (var i = 0; i < hooksToMerge.length; i++) {
    var key = hooksToMerge[i];
    var existing = hooks[key];
    var toMerge = componentVNodeHooks[key];
    if (existing !== toMerge && !(existing && existing._merged)) {
      hooks[key] = existing ? mergeHook$1(toMerge, existing) : toMerge;
    }
  }
}

function mergeHook$1 (f1, f2) {
  var merged = function (a, b) {
    // flow complains about extra args which is why we use any
    f1(a, b);
    f2(a, b);
  };
  merged._merged = true;
  return merged
}

// transform component v-model info (value and callback) into
// prop and event handler respectively.
function transformModel (options, data) {
  var prop = (options.model && options.model.prop) || 'value';
  var event = (options.model && options.model.event) || 'input'
  ;(data.attrs || (data.attrs = {}))[prop] = data.model.value;
  var on = data.on || (data.on = {});
  var existing = on[event];
  var callback = data.model.callback;
  if (isDef(existing)) {
    if (
      Array.isArray(existing)
        ? existing.indexOf(callback) === -1
        : existing !== callback
    ) {
      on[event] = [callback].concat(existing);
    }
  } else {
    on[event] = callback;
  }
}

/*  */

var SIMPLE_NORMALIZE = 1;
var ALWAYS_NORMALIZE = 2;

// wrapper function for providing a more flexible interface
// without getting yelled at by flow
function createElement (
  context,
  tag,
  data,
  children,
  normalizationType,
  alwaysNormalize
) {
  if (Array.isArray(data) || isPrimitive(data)) {
    normalizationType = children;
    children = data;
    data = undefined;
  }
  if (isTrue(alwaysNormalize)) {
    normalizationType = ALWAYS_NORMALIZE;
  }
  return _createElement(context, tag, data, children, normalizationType)
}

function _createElement (
  context,
  tag,
  data,
  children,
  normalizationType
) {
  if (isDef(data) && isDef((data).__ob__)) {
     true && warn(
      "Avoid using observed data object as vnode data: " + (JSON.stringify(data)) + "\n" +
      'Always create fresh vnode data objects in each render!',
      context
    );
    return createEmptyVNode()
  }
  // object syntax in v-bind
  if (isDef(data) && isDef(data.is)) {
    tag = data.is;
  }
  if (!tag) {
    // in case of component :is set to falsy value
    return createEmptyVNode()
  }
  // warn against non-primitive key
  if ( true &&
    isDef(data) && isDef(data.key) && !isPrimitive(data.key)
  ) {
    {
      warn(
        'Avoid using non-primitive value as key, ' +
        'use string/number value instead.',
        context
      );
    }
  }
  // support single function children as default scoped slot
  if (Array.isArray(children) &&
    typeof children[0] === 'function'
  ) {
    data = data || {};
    data.scopedSlots = { default: children[0] };
    children.length = 0;
  }
  if (normalizationType === ALWAYS_NORMALIZE) {
    children = normalizeChildren(children);
  } else if (normalizationType === SIMPLE_NORMALIZE) {
    children = simpleNormalizeChildren(children);
  }
  var vnode, ns;
  if (typeof tag === 'string') {
    var Ctor;
    ns = (context.$vnode && context.$vnode.ns) || config.getTagNamespace(tag);
    if (config.isReservedTag(tag)) {
      // platform built-in elements
      vnode = new VNode(
        config.parsePlatformTagName(tag), data, children,
        undefined, undefined, context
      );
    } else if ((!data || !data.pre) && isDef(Ctor = resolveAsset(context.$options, 'components', tag))) {
      // component
      vnode = createComponent(Ctor, data, context, children, tag);
    } else {
      // unknown or unlisted namespaced elements
      // check at runtime because it may get assigned a namespace when its
      // parent normalizes children
      vnode = new VNode(
        tag, data, children,
        undefined, undefined, context
      );
    }
  } else {
    // direct component options / constructor
    vnode = createComponent(tag, data, context, children);
  }
  if (Array.isArray(vnode)) {
    return vnode
  } else if (isDef(vnode)) {
    if (isDef(ns)) { applyNS(vnode, ns); }
    if (isDef(data)) { registerDeepBindings(data); }
    return vnode
  } else {
    return createEmptyVNode()
  }
}

function applyNS (vnode, ns, force) {
  vnode.ns = ns;
  if (vnode.tag === 'foreignObject') {
    // use default namespace inside foreignObject
    ns = undefined;
    force = true;
  }
  if (isDef(vnode.children)) {
    for (var i = 0, l = vnode.children.length; i < l; i++) {
      var child = vnode.children[i];
      if (isDef(child.tag) && (
        isUndef(child.ns) || (isTrue(force) && child.tag !== 'svg'))) {
        applyNS(child, ns, force);
      }
    }
  }
}

// ref #5318
// necessary to ensure parent re-render when deep bindings like :style and
// :class are used on slot nodes
function registerDeepBindings (data) {
  if (isObject(data.style)) {
    traverse(data.style);
  }
  if (isObject(data.class)) {
    traverse(data.class);
  }
}

/*  */

function initRender (vm) {
  vm._vnode = null; // the root of the child tree
  vm._staticTrees = null; // v-once cached trees
  var options = vm.$options;
  var parentVnode = vm.$vnode = options._parentVnode; // the placeholder node in parent tree
  var renderContext = parentVnode && parentVnode.context;
  vm.$slots = resolveSlots(options._renderChildren, renderContext);
  vm.$scopedSlots = emptyObject;
  // bind the createElement fn to this instance
  // so that we get proper render context inside it.
  // args order: tag, data, children, normalizationType, alwaysNormalize
  // internal version is used by render functions compiled from templates
  vm._c = function (a, b, c, d) { return createElement(vm, a, b, c, d, false); };
  // normalization is always applied for the public version, used in
  // user-written render functions.
  vm.$createElement = function (a, b, c, d) { return createElement(vm, a, b, c, d, true); };

  // $attrs & $listeners are exposed for easier HOC creation.
  // they need to be reactive so that HOCs using them are always updated
  var parentData = parentVnode && parentVnode.data;

  /* istanbul ignore else */
  if (true) {
    defineReactive$$1(vm, '$attrs', parentData && parentData.attrs || emptyObject, function () {
      !isUpdatingChildComponent && warn("$attrs is readonly.", vm);
    }, true);
    defineReactive$$1(vm, '$listeners', options._parentListeners || emptyObject, function () {
      !isUpdatingChildComponent && warn("$listeners is readonly.", vm);
    }, true);
  } else {}
}

var currentRenderingInstance = null;

function renderMixin (Vue) {
  // install runtime convenience helpers
  installRenderHelpers(Vue.prototype);

  Vue.prototype.$nextTick = function (fn) {
    return nextTick(fn, this)
  };

  Vue.prototype._render = function () {
    var vm = this;
    var ref = vm.$options;
    var render = ref.render;
    var _parentVnode = ref._parentVnode;

    if (_parentVnode) {
      vm.$scopedSlots = normalizeScopedSlots(
        _parentVnode.data.scopedSlots,
        vm.$slots,
        vm.$scopedSlots
      );
    }

    // set parent vnode. this allows render functions to have access
    // to the data on the placeholder node.
    vm.$vnode = _parentVnode;
    // render self
    var vnode;
    try {
      // There's no need to maintain a stack becaues all render fns are called
      // separately from one another. Nested component's render fns are called
      // when parent component is patched.
      currentRenderingInstance = vm;
      vnode = render.call(vm._renderProxy, vm.$createElement);
    } catch (e) {
      handleError(e, vm, "render");
      // return error render result,
      // or previous vnode to prevent render error causing blank component
      /* istanbul ignore else */
      if ( true && vm.$options.renderError) {
        try {
          vnode = vm.$options.renderError.call(vm._renderProxy, vm.$createElement, e);
        } catch (e) {
          handleError(e, vm, "renderError");
          vnode = vm._vnode;
        }
      } else {
        vnode = vm._vnode;
      }
    } finally {
      currentRenderingInstance = null;
    }
    // if the returned array contains only a single node, allow it
    if (Array.isArray(vnode) && vnode.length === 1) {
      vnode = vnode[0];
    }
    // return empty vnode in case the render function errored out
    if (!(vnode instanceof VNode)) {
      if ( true && Array.isArray(vnode)) {
        warn(
          'Multiple root nodes returned from render function. Render function ' +
          'should return a single root node.',
          vm
        );
      }
      vnode = createEmptyVNode();
    }
    // set parent
    vnode.parent = _parentVnode;
    return vnode
  };
}

/*  */

function ensureCtor (comp, base) {
  if (
    comp.__esModule ||
    (hasSymbol && comp[Symbol.toStringTag] === 'Module')
  ) {
    comp = comp.default;
  }
  return isObject(comp)
    ? base.extend(comp)
    : comp
}

function createAsyncPlaceholder (
  factory,
  data,
  context,
  children,
  tag
) {
  var node = createEmptyVNode();
  node.asyncFactory = factory;
  node.asyncMeta = { data: data, context: context, children: children, tag: tag };
  return node
}

function resolveAsyncComponent (
  factory,
  baseCtor
) {
  if (isTrue(factory.error) && isDef(factory.errorComp)) {
    return factory.errorComp
  }

  if (isDef(factory.resolved)) {
    return factory.resolved
  }

  var owner = currentRenderingInstance;
  if (owner && isDef(factory.owners) && factory.owners.indexOf(owner) === -1) {
    // already pending
    factory.owners.push(owner);
  }

  if (isTrue(factory.loading) && isDef(factory.loadingComp)) {
    return factory.loadingComp
  }

  if (owner && !isDef(factory.owners)) {
    var owners = factory.owners = [owner];
    var sync = true;
    var timerLoading = null;
    var timerTimeout = null

    ;(owner).$on('hook:destroyed', function () { return remove(owners, owner); });

    var forceRender = function (renderCompleted) {
      for (var i = 0, l = owners.length; i < l; i++) {
        (owners[i]).$forceUpdate();
      }

      if (renderCompleted) {
        owners.length = 0;
        if (timerLoading !== null) {
          clearTimeout(timerLoading);
          timerLoading = null;
        }
        if (timerTimeout !== null) {
          clearTimeout(timerTimeout);
          timerTimeout = null;
        }
      }
    };

    var resolve = once(function (res) {
      // cache resolved
      factory.resolved = ensureCtor(res, baseCtor);
      // invoke callbacks only if this is not a synchronous resolve
      // (async resolves are shimmed as synchronous during SSR)
      if (!sync) {
        forceRender(true);
      } else {
        owners.length = 0;
      }
    });

    var reject = once(function (reason) {
       true && warn(
        "Failed to resolve async component: " + (String(factory)) +
        (reason ? ("\nReason: " + reason) : '')
      );
      if (isDef(factory.errorComp)) {
        factory.error = true;
        forceRender(true);
      }
    });

    var res = factory(resolve, reject);

    if (isObject(res)) {
      if (isPromise(res)) {
        // () => Promise
        if (isUndef(factory.resolved)) {
          res.then(resolve, reject);
        }
      } else if (isPromise(res.component)) {
        res.component.then(resolve, reject);

        if (isDef(res.error)) {
          factory.errorComp = ensureCtor(res.error, baseCtor);
        }

        if (isDef(res.loading)) {
          factory.loadingComp = ensureCtor(res.loading, baseCtor);
          if (res.delay === 0) {
            factory.loading = true;
          } else {
            timerLoading = setTimeout(function () {
              timerLoading = null;
              if (isUndef(factory.resolved) && isUndef(factory.error)) {
                factory.loading = true;
                forceRender(false);
              }
            }, res.delay || 200);
          }
        }

        if (isDef(res.timeout)) {
          timerTimeout = setTimeout(function () {
            timerTimeout = null;
            if (isUndef(factory.resolved)) {
              reject(
                 true
                  ? ("timeout (" + (res.timeout) + "ms)")
                  : undefined
              );
            }
          }, res.timeout);
        }
      }
    }

    sync = false;
    // return in case resolved synchronously
    return factory.loading
      ? factory.loadingComp
      : factory.resolved
  }
}

/*  */

function isAsyncPlaceholder (node) {
  return node.isComment && node.asyncFactory
}

/*  */

function getFirstComponentChild (children) {
  if (Array.isArray(children)) {
    for (var i = 0; i < children.length; i++) {
      var c = children[i];
      if (isDef(c) && (isDef(c.componentOptions) || isAsyncPlaceholder(c))) {
        return c
      }
    }
  }
}

/*  */

/*  */

function initEvents (vm) {
  vm._events = Object.create(null);
  vm._hasHookEvent = false;
  // init parent attached events
  var listeners = vm.$options._parentListeners;
  if (listeners) {
    updateComponentListeners(vm, listeners);
  }
}

var target;

function add (event, fn) {
  target.$on(event, fn);
}

function remove$1 (event, fn) {
  target.$off(event, fn);
}

function createOnceHandler (event, fn) {
  var _target = target;
  return function onceHandler () {
    var res = fn.apply(null, arguments);
    if (res !== null) {
      _target.$off(event, onceHandler);
    }
  }
}

function updateComponentListeners (
  vm,
  listeners,
  oldListeners
) {
  target = vm;
  updateListeners(listeners, oldListeners || {}, add, remove$1, createOnceHandler, vm);
  target = undefined;
}

function eventsMixin (Vue) {
  var hookRE = /^hook:/;
  Vue.prototype.$on = function (event, fn) {
    var vm = this;
    if (Array.isArray(event)) {
      for (var i = 0, l = event.length; i < l; i++) {
        vm.$on(event[i], fn);
      }
    } else {
      (vm._events[event] || (vm._events[event] = [])).push(fn);
      // optimize hook:event cost by using a boolean flag marked at registration
      // instead of a hash lookup
      if (hookRE.test(event)) {
        vm._hasHookEvent = true;
      }
    }
    return vm
  };

  Vue.prototype.$once = function (event, fn) {
    var vm = this;
    function on () {
      vm.$off(event, on);
      fn.apply(vm, arguments);
    }
    on.fn = fn;
    vm.$on(event, on);
    return vm
  };

  Vue.prototype.$off = function (event, fn) {
    var vm = this;
    // all
    if (!arguments.length) {
      vm._events = Object.create(null);
      return vm
    }
    // array of events
    if (Array.isArray(event)) {
      for (var i$1 = 0, l = event.length; i$1 < l; i$1++) {
        vm.$off(event[i$1], fn);
      }
      return vm
    }
    // specific event
    var cbs = vm._events[event];
    if (!cbs) {
      return vm
    }
    if (!fn) {
      vm._events[event] = null;
      return vm
    }
    // specific handler
    var cb;
    var i = cbs.length;
    while (i--) {
      cb = cbs[i];
      if (cb === fn || cb.fn === fn) {
        cbs.splice(i, 1);
        break
      }
    }
    return vm
  };

  Vue.prototype.$emit = function (event) {
    var vm = this;
    if (true) {
      var lowerCaseEvent = event.toLowerCase();
      if (lowerCaseEvent !== event && vm._events[lowerCaseEvent]) {
        tip(
          "Event \"" + lowerCaseEvent + "\" is emitted in component " +
          (formatComponentName(vm)) + " but the handler is registered for \"" + event + "\". " +
          "Note that HTML attributes are case-insensitive and you cannot use " +
          "v-on to listen to camelCase events when using in-DOM templates. " +
          "You should probably use \"" + (hyphenate(event)) + "\" instead of \"" + event + "\"."
        );
      }
    }
    var cbs = vm._events[event];
    if (cbs) {
      cbs = cbs.length > 1 ? toArray(cbs) : cbs;
      var args = toArray(arguments, 1);
      var info = "event handler for \"" + event + "\"";
      for (var i = 0, l = cbs.length; i < l; i++) {
        invokeWithErrorHandling(cbs[i], vm, args, vm, info);
      }
    }
    return vm
  };
}

/*  */

var activeInstance = null;
var isUpdatingChildComponent = false;

function setActiveInstance(vm) {
  var prevActiveInstance = activeInstance;
  activeInstance = vm;
  return function () {
    activeInstance = prevActiveInstance;
  }
}

function initLifecycle (vm) {
  var options = vm.$options;

  // locate first non-abstract parent
  var parent = options.parent;
  if (parent && !options.abstract) {
    while (parent.$options.abstract && parent.$parent) {
      parent = parent.$parent;
    }
    parent.$children.push(vm);
  }

  vm.$parent = parent;
  vm.$root = parent ? parent.$root : vm;

  vm.$children = [];
  vm.$refs = {};

  vm._watcher = null;
  vm._inactive = null;
  vm._directInactive = false;
  vm._isMounted = false;
  vm._isDestroyed = false;
  vm._isBeingDestroyed = false;
}

function lifecycleMixin (Vue) {
  Vue.prototype._update = function (vnode, hydrating) {
    var vm = this;
    var prevEl = vm.$el;
    var prevVnode = vm._vnode;
    var restoreActiveInstance = setActiveInstance(vm);
    vm._vnode = vnode;
    // Vue.prototype.__patch__ is injected in entry points
    // based on the rendering backend used.
    if (!prevVnode) {
      // initial render
      vm.$el = vm.__patch__(vm.$el, vnode, hydrating, false /* removeOnly */);
    } else {
      // updates
      vm.$el = vm.__patch__(prevVnode, vnode);
    }
    restoreActiveInstance();
    // update __vue__ reference
    if (prevEl) {
      prevEl.__vue__ = null;
    }
    if (vm.$el) {
      vm.$el.__vue__ = vm;
    }
    // if parent is an HOC, update its $el as well
    if (vm.$vnode && vm.$parent && vm.$vnode === vm.$parent._vnode) {
      vm.$parent.$el = vm.$el;
    }
    // updated hook is called by the scheduler to ensure that children are
    // updated in a parent's updated hook.
  };

  Vue.prototype.$forceUpdate = function () {
    var vm = this;
    if (vm._watcher) {
      vm._watcher.update();
    }
  };

  Vue.prototype.$destroy = function () {
    var vm = this;
    if (vm._isBeingDestroyed) {
      return
    }
    callHook(vm, 'beforeDestroy');
    vm._isBeingDestroyed = true;
    // remove self from parent
    var parent = vm.$parent;
    if (parent && !parent._isBeingDestroyed && !vm.$options.abstract) {
      remove(parent.$children, vm);
    }
    // teardown watchers
    if (vm._watcher) {
      vm._watcher.teardown();
    }
    var i = vm._watchers.length;
    while (i--) {
      vm._watchers[i].teardown();
    }
    // remove reference from data ob
    // frozen object may not have observer.
    if (vm._data.__ob__) {
      vm._data.__ob__.vmCount--;
    }
    // call the last hook...
    vm._isDestroyed = true;
    // invoke destroy hooks on current rendered tree
    vm.__patch__(vm._vnode, null);
    // fire destroyed hook
    callHook(vm, 'destroyed');
    // turn off all instance listeners.
    vm.$off();
    // remove __vue__ reference
    if (vm.$el) {
      vm.$el.__vue__ = null;
    }
    // release circular reference (#6759)
    if (vm.$vnode) {
      vm.$vnode.parent = null;
    }
  };
}

function updateChildComponent (
  vm,
  propsData,
  listeners,
  parentVnode,
  renderChildren
) {
  if (true) {
    isUpdatingChildComponent = true;
  }

  // determine whether component has slot children
  // we need to do this before overwriting $options._renderChildren.

  // check if there are dynamic scopedSlots (hand-written or compiled but with
  // dynamic slot names). Static scoped slots compiled from template has the
  // "$stable" marker.
  var newScopedSlots = parentVnode.data.scopedSlots;
  var oldScopedSlots = vm.$scopedSlots;
  var hasDynamicScopedSlot = !!(
    (newScopedSlots && !newScopedSlots.$stable) ||
    (oldScopedSlots !== emptyObject && !oldScopedSlots.$stable) ||
    (newScopedSlots && vm.$scopedSlots.$key !== newScopedSlots.$key)
  );

  // Any static slot children from the parent may have changed during parent's
  // update. Dynamic scoped slots may also have changed. In such cases, a forced
  // update is necessary to ensure correctness.
  var needsForceUpdate = !!(
    renderChildren ||               // has new static slots
    vm.$options._renderChildren ||  // has old static slots
    hasDynamicScopedSlot
  );

  vm.$options._parentVnode = parentVnode;
  vm.$vnode = parentVnode; // update vm's placeholder node without re-render

  if (vm._vnode) { // update child tree's parent
    vm._vnode.parent = parentVnode;
  }
  vm.$options._renderChildren = renderChildren;

  // update $attrs and $listeners hash
  // these are also reactive so they may trigger child update if the child
  // used them during render
  vm.$attrs = parentVnode.data.attrs || emptyObject;
  vm.$listeners = listeners || emptyObject;

  // update props
  if (propsData && vm.$options.props) {
    toggleObserving(false);
    var props = vm._props;
    var propKeys = vm.$options._propKeys || [];
    for (var i = 0; i < propKeys.length; i++) {
      var key = propKeys[i];
      var propOptions = vm.$options.props; // wtf flow?
      props[key] = validateProp(key, propOptions, propsData, vm);
    }
    toggleObserving(true);
    // keep a copy of raw propsData
    vm.$options.propsData = propsData;
  }

  // update listeners
  listeners = listeners || emptyObject;
  var oldListeners = vm.$options._parentListeners;
  vm.$options._parentListeners = listeners;
  updateComponentListeners(vm, listeners, oldListeners);

  // resolve slots + force update if has children
  if (needsForceUpdate) {
    vm.$slots = resolveSlots(renderChildren, parentVnode.context);
    vm.$forceUpdate();
  }

  if (true) {
    isUpdatingChildComponent = false;
  }
}

function isInInactiveTree (vm) {
  while (vm && (vm = vm.$parent)) {
    if (vm._inactive) { return true }
  }
  return false
}

function activateChildComponent (vm, direct) {
  if (direct) {
    vm._directInactive = false;
    if (isInInactiveTree(vm)) {
      return
    }
  } else if (vm._directInactive) {
    return
  }
  if (vm._inactive || vm._inactive === null) {
    vm._inactive = false;
    for (var i = 0; i < vm.$children.length; i++) {
      activateChildComponent(vm.$children[i]);
    }
    callHook(vm, 'activated');
  }
}

function deactivateChildComponent (vm, direct) {
  if (direct) {
    vm._directInactive = true;
    if (isInInactiveTree(vm)) {
      return
    }
  }
  if (!vm._inactive) {
    vm._inactive = true;
    for (var i = 0; i < vm.$children.length; i++) {
      deactivateChildComponent(vm.$children[i]);
    }
    callHook(vm, 'deactivated');
  }
}

function callHook (vm, hook) {
  // #7573 disable dep collection when invoking lifecycle hooks
  pushTarget();
  var handlers = vm.$options[hook];
  var info = hook + " hook";
  if (handlers) {
    for (var i = 0, j = handlers.length; i < j; i++) {
      invokeWithErrorHandling(handlers[i], vm, null, vm, info);
    }
  }
  if (vm._hasHookEvent) {
    vm.$emit('hook:' + hook);
  }
  popTarget();
}

/*  */

var MAX_UPDATE_COUNT = 100;

var queue = [];
var activatedChildren = [];
var has = {};
var circular = {};
var waiting = false;
var flushing = false;
var index = 0;

/**
 * Reset the scheduler's state.
 */
function resetSchedulerState () {
  index = queue.length = activatedChildren.length = 0;
  has = {};
  if (true) {
    circular = {};
  }
  waiting = flushing = false;
}

// Async edge case #6566 requires saving the timestamp when event listeners are
// attached. However, calling performance.now() has a perf overhead especially
// if the page has thousands of event listeners. Instead, we take a timestamp
// every time the scheduler flushes and use that for all event listeners
// attached during that flush.
var currentFlushTimestamp = 0;

// Async edge case fix requires storing an event listener's attach timestamp.
var getNow = Date.now;

// Determine what event timestamp the browser is using. Annoyingly, the
// timestamp can either be hi-res (relative to page load) or low-res
// (relative to UNIX epoch), so in order to compare time we have to use the
// same timestamp type when saving the flush timestamp.
// All IE versions use low-res event timestamps, and have problematic clock
// implementations (#9632)
if (inBrowser && !isIE) {
  var performance = window.performance;
  if (
    performance &&
    typeof performance.now === 'function' &&
    getNow() > document.createEvent('Event').timeStamp
  ) {
    // if the event timestamp, although evaluated AFTER the Date.now(), is
    // smaller than it, it means the event is using a hi-res timestamp,
    // and we need to use the hi-res version for event listener timestamps as
    // well.
    getNow = function () { return performance.now(); };
  }
}

/**
 * Flush both queues and run the watchers.
 */
function flushSchedulerQueue () {
  currentFlushTimestamp = getNow();
  flushing = true;
  var watcher, id;

  // Sort queue before flush.
  // This ensures that:
  // 1. Components are updated from parent to child. (because parent is always
  //    created before the child)
  // 2. A component's user watchers are run before its render watcher (because
  //    user watchers are created before the render watcher)
  // 3. If a component is destroyed during a parent component's watcher run,
  //    its watchers can be skipped.
  queue.sort(function (a, b) { return a.id - b.id; });

  // do not cache length because more watchers might be pushed
  // as we run existing watchers
  for (index = 0; index < queue.length; index++) {
    watcher = queue[index];
    if (watcher.before) {
      watcher.before();
    }
    id = watcher.id;
    has[id] = null;
    watcher.run();
    // in dev build, check and stop circular updates.
    if ( true && has[id] != null) {
      circular[id] = (circular[id] || 0) + 1;
      if (circular[id] > MAX_UPDATE_COUNT) {
        warn(
          'You may have an infinite update loop ' + (
            watcher.user
              ? ("in watcher with expression \"" + (watcher.expression) + "\"")
              : "in a component render function."
          ),
          watcher.vm
        );
        break
      }
    }
  }

  // keep copies of post queues before resetting state
  var activatedQueue = activatedChildren.slice();
  var updatedQueue = queue.slice();

  resetSchedulerState();

  // call component updated and activated hooks
  callActivatedHooks(activatedQueue);
  callUpdatedHooks(updatedQueue);

  // devtool hook
  /* istanbul ignore if */
  if (devtools && config.devtools) {
    devtools.emit('flush');
  }
}

function callUpdatedHooks (queue) {
  var i = queue.length;
  while (i--) {
    var watcher = queue[i];
    var vm = watcher.vm;
    if (vm._watcher === watcher && vm._isMounted && !vm._isDestroyed) {
      callHook(vm, 'updated');
    }
  }
}

/**
 * Queue a kept-alive component that was activated during patch.
 * The queue will be processed after the entire tree has been patched.
 */
function queueActivatedComponent (vm) {
  // setting _inactive to false here so that a render function can
  // rely on checking whether it's in an inactive tree (e.g. router-view)
  vm._inactive = false;
  activatedChildren.push(vm);
}

function callActivatedHooks (queue) {
  for (var i = 0; i < queue.length; i++) {
    queue[i]._inactive = true;
    activateChildComponent(queue[i], true /* true */);
  }
}

/**
 * Push a watcher into the watcher queue.
 * Jobs with duplicate IDs will be skipped unless it's
 * pushed when the queue is being flushed.
 */
function queueWatcher (watcher) {
  var id = watcher.id;
  if (has[id] == null) {
    has[id] = true;
    if (!flushing) {
      queue.push(watcher);
    } else {
      // if already flushing, splice the watcher based on its id
      // if already past its id, it will be run next immediately.
      var i = queue.length - 1;
      while (i > index && queue[i].id > watcher.id) {
        i--;
      }
      queue.splice(i + 1, 0, watcher);
    }
    // queue the flush
    if (!waiting) {
      waiting = true;

      if ( true && !config.async) {
        flushSchedulerQueue();
        return
      }
      nextTick(flushSchedulerQueue);
    }
  }
}

/*  */



var uid$2 = 0;

/**
 * A watcher parses an expression, collects dependencies,
 * and fires callback when the expression value changes.
 * This is used for both the $watch() api and directives.
 */
var Watcher = function Watcher (
  vm,
  expOrFn,
  cb,
  options,
  isRenderWatcher
) {
  this.vm = vm;
  if (isRenderWatcher) {
    vm._watcher = this;
  }
  vm._watchers.push(this);
  // options
  if (options) {
    this.deep = !!options.deep;
    this.user = !!options.user;
    this.lazy = !!options.lazy;
    this.sync = !!options.sync;
    this.before = options.before;
  } else {
    this.deep = this.user = this.lazy = this.sync = false;
  }
  this.cb = cb;
  this.id = ++uid$2; // uid for batching
  this.active = true;
  this.dirty = this.lazy; // for lazy watchers
  this.deps = [];
  this.newDeps = [];
  this.depIds = new _Set();
  this.newDepIds = new _Set();
  this.expression =  true
    ? expOrFn.toString()
    : undefined;
  // parse expression for getter
  if (typeof expOrFn === 'function') {
    this.getter = expOrFn;
  } else {
    this.getter = parsePath(expOrFn);
    if (!this.getter) {
      this.getter = noop;
       true && warn(
        "Failed watching path: \"" + expOrFn + "\" " +
        'Watcher only accepts simple dot-delimited paths. ' +
        'For full control, use a function instead.',
        vm
      );
    }
  }
  this.value = this.lazy
    ? undefined
    : this.get();
};

/**
 * Evaluate the getter, and re-collect dependencies.
 */
Watcher.prototype.get = function get () {
  pushTarget(this);
  var value;
  var vm = this.vm;
  try {
    value = this.getter.call(vm, vm);
  } catch (e) {
    if (this.user) {
      handleError(e, vm, ("getter for watcher \"" + (this.expression) + "\""));
    } else {
      throw e
    }
  } finally {
    // "touch" every property so they are all tracked as
    // dependencies for deep watching
    if (this.deep) {
      traverse(value);
    }
    popTarget();
    this.cleanupDeps();
  }
  return value
};

/**
 * Add a dependency to this directive.
 */
Watcher.prototype.addDep = function addDep (dep) {
  var id = dep.id;
  if (!this.newDepIds.has(id)) {
    this.newDepIds.add(id);
    this.newDeps.push(dep);
    if (!this.depIds.has(id)) {
      dep.addSub(this);
    }
  }
};

/**
 * Clean up for dependency collection.
 */
Watcher.prototype.cleanupDeps = function cleanupDeps () {
  var i = this.deps.length;
  while (i--) {
    var dep = this.deps[i];
    if (!this.newDepIds.has(dep.id)) {
      dep.removeSub(this);
    }
  }
  var tmp = this.depIds;
  this.depIds = this.newDepIds;
  this.newDepIds = tmp;
  this.newDepIds.clear();
  tmp = this.deps;
  this.deps = this.newDeps;
  this.newDeps = tmp;
  this.newDeps.length = 0;
};

/**
 * Subscriber interface.
 * Will be called when a dependency changes.
 */
Watcher.prototype.update = function update () {
  /* istanbul ignore else */
  if (this.lazy) {
    this.dirty = true;
  } else if (this.sync) {
    this.run();
  } else {
    queueWatcher(this);
  }
};

/**
 * Scheduler job interface.
 * Will be called by the scheduler.
 */
Watcher.prototype.run = function run () {
  if (this.active) {
    var value = this.get();
    if (
      value !== this.value ||
      // Deep watchers and watchers on Object/Arrays should fire even
      // when the value is the same, because the value may
      // have mutated.
      isObject(value) ||
      this.deep
    ) {
      // set new value
      var oldValue = this.value;
      this.value = value;
      if (this.user) {
        try {
          this.cb.call(this.vm, value, oldValue);
        } catch (e) {
          handleError(e, this.vm, ("callback for watcher \"" + (this.expression) + "\""));
        }
      } else {
        this.cb.call(this.vm, value, oldValue);
      }
    }
  }
};

/**
 * Evaluate the value of the watcher.
 * This only gets called for lazy watchers.
 */
Watcher.prototype.evaluate = function evaluate () {
  this.value = this.get();
  this.dirty = false;
};

/**
 * Depend on all deps collected by this watcher.
 */
Watcher.prototype.depend = function depend () {
  var i = this.deps.length;
  while (i--) {
    this.deps[i].depend();
  }
};

/**
 * Remove self from all dependencies' subscriber list.
 */
Watcher.prototype.teardown = function teardown () {
  if (this.active) {
    // remove self from vm's watcher list
    // this is a somewhat expensive operation so we skip it
    // if the vm is being destroyed.
    if (!this.vm._isBeingDestroyed) {
      remove(this.vm._watchers, this);
    }
    var i = this.deps.length;
    while (i--) {
      this.deps[i].removeSub(this);
    }
    this.active = false;
  }
};

/*  */

var sharedPropertyDefinition = {
  enumerable: true,
  configurable: true,
  get: noop,
  set: noop
};

function proxy (target, sourceKey, key) {
  sharedPropertyDefinition.get = function proxyGetter () {
    return this[sourceKey][key]
  };
  sharedPropertyDefinition.set = function proxySetter (val) {
    this[sourceKey][key] = val;
  };
  Object.defineProperty(target, key, sharedPropertyDefinition);
}

function initState (vm) {
  vm._watchers = [];
  var opts = vm.$options;
  if (opts.props) { initProps(vm, opts.props); }
  if (opts.methods) { initMethods(vm, opts.methods); }
  if (opts.data) {
    initData(vm);
  } else {
    observe(vm._data = {}, true /* asRootData */);
  }
  if (opts.computed) { initComputed(vm, opts.computed); }
  if (opts.watch && opts.watch !== nativeWatch) {
    initWatch(vm, opts.watch);
  }
}

function initProps (vm, propsOptions) {
  var propsData = vm.$options.propsData || {};
  var props = vm._props = {};
  // cache prop keys so that future props updates can iterate using Array
  // instead of dynamic object key enumeration.
  var keys = vm.$options._propKeys = [];
  var isRoot = !vm.$parent;
  // root instance props should be converted
  if (!isRoot) {
    toggleObserving(false);
  }
  var loop = function ( key ) {
    keys.push(key);
    var value = validateProp(key, propsOptions, propsData, vm);
    /* istanbul ignore else */
    if (true) {
      var hyphenatedKey = hyphenate(key);
      if (isReservedAttribute(hyphenatedKey) ||
          config.isReservedAttr(hyphenatedKey)) {
        warn(
          ("\"" + hyphenatedKey + "\" is a reserved attribute and cannot be used as component prop."),
          vm
        );
      }
      defineReactive$$1(props, key, value, function () {
        if (!isRoot && !isUpdatingChildComponent) {
          {
            if(vm.mpHost === 'mp-baidu'){//百度 observer 在 setData callback 之后触发，直接忽略该 warn
                return
            }
            //fixed by xxxxxx __next_tick_pending,uni://form-field 时不告警
            if(
                key === 'value' && 
                Array.isArray(vm.$options.behaviors) &&
                vm.$options.behaviors.indexOf('uni://form-field') !== -1
              ){
              return
            }
            if(vm._getFormData){
              return
            }
            var $parent = vm.$parent;
            while($parent){
              if($parent.__next_tick_pending){
                return  
              }
              $parent = $parent.$parent;
            }
          }
          warn(
            "Avoid mutating a prop directly since the value will be " +
            "overwritten whenever the parent component re-renders. " +
            "Instead, use a data or computed property based on the prop's " +
            "value. Prop being mutated: \"" + key + "\"",
            vm
          );
        }
      });
    } else {}
    // static props are already proxied on the component's prototype
    // during Vue.extend(). We only need to proxy props defined at
    // instantiation here.
    if (!(key in vm)) {
      proxy(vm, "_props", key);
    }
  };

  for (var key in propsOptions) loop( key );
  toggleObserving(true);
}

function initData (vm) {
  var data = vm.$options.data;
  data = vm._data = typeof data === 'function'
    ? getData(data, vm)
    : data || {};
  if (!isPlainObject(data)) {
    data = {};
     true && warn(
      'data functions should return an object:\n' +
      'https://vuejs.org/v2/guide/components.html#data-Must-Be-a-Function',
      vm
    );
  }
  // proxy data on instance
  var keys = Object.keys(data);
  var props = vm.$options.props;
  var methods = vm.$options.methods;
  var i = keys.length;
  while (i--) {
    var key = keys[i];
    if (true) {
      if (methods && hasOwn(methods, key)) {
        warn(
          ("Method \"" + key + "\" has already been defined as a data property."),
          vm
        );
      }
    }
    if (props && hasOwn(props, key)) {
       true && warn(
        "The data property \"" + key + "\" is already declared as a prop. " +
        "Use prop default value instead.",
        vm
      );
    } else if (!isReserved(key)) {
      proxy(vm, "_data", key);
    }
  }
  // observe data
  observe(data, true /* asRootData */);
}

function getData (data, vm) {
  // #7573 disable dep collection when invoking data getters
  pushTarget();
  try {
    return data.call(vm, vm)
  } catch (e) {
    handleError(e, vm, "data()");
    return {}
  } finally {
    popTarget();
  }
}

var computedWatcherOptions = { lazy: true };

function initComputed (vm, computed) {
  // $flow-disable-line
  var watchers = vm._computedWatchers = Object.create(null);
  // computed properties are just getters during SSR
  var isSSR = isServerRendering();

  for (var key in computed) {
    var userDef = computed[key];
    var getter = typeof userDef === 'function' ? userDef : userDef.get;
    if ( true && getter == null) {
      warn(
        ("Getter is missing for computed property \"" + key + "\"."),
        vm
      );
    }

    if (!isSSR) {
      // create internal watcher for the computed property.
      watchers[key] = new Watcher(
        vm,
        getter || noop,
        noop,
        computedWatcherOptions
      );
    }

    // component-defined computed properties are already defined on the
    // component prototype. We only need to define computed properties defined
    // at instantiation here.
    if (!(key in vm)) {
      defineComputed(vm, key, userDef);
    } else if (true) {
      if (key in vm.$data) {
        warn(("The computed property \"" + key + "\" is already defined in data."), vm);
      } else if (vm.$options.props && key in vm.$options.props) {
        warn(("The computed property \"" + key + "\" is already defined as a prop."), vm);
      }
    }
  }
}

function defineComputed (
  target,
  key,
  userDef
) {
  var shouldCache = !isServerRendering();
  if (typeof userDef === 'function') {
    sharedPropertyDefinition.get = shouldCache
      ? createComputedGetter(key)
      : createGetterInvoker(userDef);
    sharedPropertyDefinition.set = noop;
  } else {
    sharedPropertyDefinition.get = userDef.get
      ? shouldCache && userDef.cache !== false
        ? createComputedGetter(key)
        : createGetterInvoker(userDef.get)
      : noop;
    sharedPropertyDefinition.set = userDef.set || noop;
  }
  if ( true &&
      sharedPropertyDefinition.set === noop) {
    sharedPropertyDefinition.set = function () {
      warn(
        ("Computed property \"" + key + "\" was assigned to but it has no setter."),
        this
      );
    };
  }
  Object.defineProperty(target, key, sharedPropertyDefinition);
}

function createComputedGetter (key) {
  return function computedGetter () {
    var watcher = this._computedWatchers && this._computedWatchers[key];
    if (watcher) {
      if (watcher.dirty) {
        watcher.evaluate();
      }
      if (Dep.SharedObject.target) {// fixed by xxxxxx
        watcher.depend();
      }
      return watcher.value
    }
  }
}

function createGetterInvoker(fn) {
  return function computedGetter () {
    return fn.call(this, this)
  }
}

function initMethods (vm, methods) {
  var props = vm.$options.props;
  for (var key in methods) {
    if (true) {
      if (typeof methods[key] !== 'function') {
        warn(
          "Method \"" + key + "\" has type \"" + (typeof methods[key]) + "\" in the component definition. " +
          "Did you reference the function correctly?",
          vm
        );
      }
      if (props && hasOwn(props, key)) {
        warn(
          ("Method \"" + key + "\" has already been defined as a prop."),
          vm
        );
      }
      if ((key in vm) && isReserved(key)) {
        warn(
          "Method \"" + key + "\" conflicts with an existing Vue instance method. " +
          "Avoid defining component methods that start with _ or $."
        );
      }
    }
    vm[key] = typeof methods[key] !== 'function' ? noop : bind(methods[key], vm);
  }
}

function initWatch (vm, watch) {
  for (var key in watch) {
    var handler = watch[key];
    if (Array.isArray(handler)) {
      for (var i = 0; i < handler.length; i++) {
        createWatcher(vm, key, handler[i]);
      }
    } else {
      createWatcher(vm, key, handler);
    }
  }
}

function createWatcher (
  vm,
  expOrFn,
  handler,
  options
) {
  if (isPlainObject(handler)) {
    options = handler;
    handler = handler.handler;
  }
  if (typeof handler === 'string') {
    handler = vm[handler];
  }
  return vm.$watch(expOrFn, handler, options)
}

function stateMixin (Vue) {
  // flow somehow has problems with directly declared definition object
  // when using Object.defineProperty, so we have to procedurally build up
  // the object here.
  var dataDef = {};
  dataDef.get = function () { return this._data };
  var propsDef = {};
  propsDef.get = function () { return this._props };
  if (true) {
    dataDef.set = function () {
      warn(
        'Avoid replacing instance root $data. ' +
        'Use nested data properties instead.',
        this
      );
    };
    propsDef.set = function () {
      warn("$props is readonly.", this);
    };
  }
  Object.defineProperty(Vue.prototype, '$data', dataDef);
  Object.defineProperty(Vue.prototype, '$props', propsDef);

  Vue.prototype.$set = set;
  Vue.prototype.$delete = del;

  Vue.prototype.$watch = function (
    expOrFn,
    cb,
    options
  ) {
    var vm = this;
    if (isPlainObject(cb)) {
      return createWatcher(vm, expOrFn, cb, options)
    }
    options = options || {};
    options.user = true;
    var watcher = new Watcher(vm, expOrFn, cb, options);
    if (options.immediate) {
      try {
        cb.call(vm, watcher.value);
      } catch (error) {
        handleError(error, vm, ("callback for immediate watcher \"" + (watcher.expression) + "\""));
      }
    }
    return function unwatchFn () {
      watcher.teardown();
    }
  };
}

/*  */

var uid$3 = 0;

function initMixin (Vue) {
  Vue.prototype._init = function (options) {
    var vm = this;
    // a uid
    vm._uid = uid$3++;

    var startTag, endTag;
    /* istanbul ignore if */
    if ( true && config.performance && mark) {
      startTag = "vue-perf-start:" + (vm._uid);
      endTag = "vue-perf-end:" + (vm._uid);
      mark(startTag);
    }

    // a flag to avoid this being observed
    vm._isVue = true;
    // merge options
    if (options && options._isComponent) {
      // optimize internal component instantiation
      // since dynamic options merging is pretty slow, and none of the
      // internal component options needs special treatment.
      initInternalComponent(vm, options);
    } else {
      vm.$options = mergeOptions(
        resolveConstructorOptions(vm.constructor),
        options || {},
        vm
      );
    }
    /* istanbul ignore else */
    if (true) {
      initProxy(vm);
    } else {}
    // expose real self
    vm._self = vm;
    initLifecycle(vm);
    initEvents(vm);
    initRender(vm);
    callHook(vm, 'beforeCreate');
    vm.mpHost !== 'mp-toutiao' && initInjections(vm); // resolve injections before data/props  
    initState(vm);
    vm.mpHost !== 'mp-toutiao' && initProvide(vm); // resolve provide after data/props
    vm.mpHost !== 'mp-toutiao' && callHook(vm, 'created');      

    /* istanbul ignore if */
    if ( true && config.performance && mark) {
      vm._name = formatComponentName(vm, false);
      mark(endTag);
      measure(("vue " + (vm._name) + " init"), startTag, endTag);
    }

    if (vm.$options.el) {
      vm.$mount(vm.$options.el);
    }
  };
}

function initInternalComponent (vm, options) {
  var opts = vm.$options = Object.create(vm.constructor.options);
  // doing this because it's faster than dynamic enumeration.
  var parentVnode = options._parentVnode;
  opts.parent = options.parent;
  opts._parentVnode = parentVnode;

  var vnodeComponentOptions = parentVnode.componentOptions;
  opts.propsData = vnodeComponentOptions.propsData;
  opts._parentListeners = vnodeComponentOptions.listeners;
  opts._renderChildren = vnodeComponentOptions.children;
  opts._componentTag = vnodeComponentOptions.tag;

  if (options.render) {
    opts.render = options.render;
    opts.staticRenderFns = options.staticRenderFns;
  }
}

function resolveConstructorOptions (Ctor) {
  var options = Ctor.options;
  if (Ctor.super) {
    var superOptions = resolveConstructorOptions(Ctor.super);
    var cachedSuperOptions = Ctor.superOptions;
    if (superOptions !== cachedSuperOptions) {
      // super option changed,
      // need to resolve new options.
      Ctor.superOptions = superOptions;
      // check if there are any late-modified/attached options (#4976)
      var modifiedOptions = resolveModifiedOptions(Ctor);
      // update base extend options
      if (modifiedOptions) {
        extend(Ctor.extendOptions, modifiedOptions);
      }
      options = Ctor.options = mergeOptions(superOptions, Ctor.extendOptions);
      if (options.name) {
        options.components[options.name] = Ctor;
      }
    }
  }
  return options
}

function resolveModifiedOptions (Ctor) {
  var modified;
  var latest = Ctor.options;
  var sealed = Ctor.sealedOptions;
  for (var key in latest) {
    if (latest[key] !== sealed[key]) {
      if (!modified) { modified = {}; }
      modified[key] = latest[key];
    }
  }
  return modified
}

function Vue (options) {
  if ( true &&
    !(this instanceof Vue)
  ) {
    warn('Vue is a constructor and should be called with the `new` keyword');
  }
  this._init(options);
}

initMixin(Vue);
stateMixin(Vue);
eventsMixin(Vue);
lifecycleMixin(Vue);
renderMixin(Vue);

/*  */

function initUse (Vue) {
  Vue.use = function (plugin) {
    var installedPlugins = (this._installedPlugins || (this._installedPlugins = []));
    if (installedPlugins.indexOf(plugin) > -1) {
      return this
    }

    // additional parameters
    var args = toArray(arguments, 1);
    args.unshift(this);
    if (typeof plugin.install === 'function') {
      plugin.install.apply(plugin, args);
    } else if (typeof plugin === 'function') {
      plugin.apply(null, args);
    }
    installedPlugins.push(plugin);
    return this
  };
}

/*  */

function initMixin$1 (Vue) {
  Vue.mixin = function (mixin) {
    this.options = mergeOptions(this.options, mixin);
    return this
  };
}

/*  */

function initExtend (Vue) {
  /**
   * Each instance constructor, including Vue, has a unique
   * cid. This enables us to create wrapped "child
   * constructors" for prototypal inheritance and cache them.
   */
  Vue.cid = 0;
  var cid = 1;

  /**
   * Class inheritance
   */
  Vue.extend = function (extendOptions) {
    extendOptions = extendOptions || {};
    var Super = this;
    var SuperId = Super.cid;
    var cachedCtors = extendOptions._Ctor || (extendOptions._Ctor = {});
    if (cachedCtors[SuperId]) {
      return cachedCtors[SuperId]
    }

    var name = extendOptions.name || Super.options.name;
    if ( true && name) {
      validateComponentName(name);
    }

    var Sub = function VueComponent (options) {
      this._init(options);
    };
    Sub.prototype = Object.create(Super.prototype);
    Sub.prototype.constructor = Sub;
    Sub.cid = cid++;
    Sub.options = mergeOptions(
      Super.options,
      extendOptions
    );
    Sub['super'] = Super;

    // For props and computed properties, we define the proxy getters on
    // the Vue instances at extension time, on the extended prototype. This
    // avoids Object.defineProperty calls for each instance created.
    if (Sub.options.props) {
      initProps$1(Sub);
    }
    if (Sub.options.computed) {
      initComputed$1(Sub);
    }

    // allow further extension/mixin/plugin usage
    Sub.extend = Super.extend;
    Sub.mixin = Super.mixin;
    Sub.use = Super.use;

    // create asset registers, so extended classes
    // can have their private assets too.
    ASSET_TYPES.forEach(function (type) {
      Sub[type] = Super[type];
    });
    // enable recursive self-lookup
    if (name) {
      Sub.options.components[name] = Sub;
    }

    // keep a reference to the super options at extension time.
    // later at instantiation we can check if Super's options have
    // been updated.
    Sub.superOptions = Super.options;
    Sub.extendOptions = extendOptions;
    Sub.sealedOptions = extend({}, Sub.options);

    // cache constructor
    cachedCtors[SuperId] = Sub;
    return Sub
  };
}

function initProps$1 (Comp) {
  var props = Comp.options.props;
  for (var key in props) {
    proxy(Comp.prototype, "_props", key);
  }
}

function initComputed$1 (Comp) {
  var computed = Comp.options.computed;
  for (var key in computed) {
    defineComputed(Comp.prototype, key, computed[key]);
  }
}

/*  */

function initAssetRegisters (Vue) {
  /**
   * Create asset registration methods.
   */
  ASSET_TYPES.forEach(function (type) {
    Vue[type] = function (
      id,
      definition
    ) {
      if (!definition) {
        return this.options[type + 's'][id]
      } else {
        /* istanbul ignore if */
        if ( true && type === 'component') {
          validateComponentName(id);
        }
        if (type === 'component' && isPlainObject(definition)) {
          definition.name = definition.name || id;
          definition = this.options._base.extend(definition);
        }
        if (type === 'directive' && typeof definition === 'function') {
          definition = { bind: definition, update: definition };
        }
        this.options[type + 's'][id] = definition;
        return definition
      }
    };
  });
}

/*  */



function getComponentName (opts) {
  return opts && (opts.Ctor.options.name || opts.tag)
}

function matches (pattern, name) {
  if (Array.isArray(pattern)) {
    return pattern.indexOf(name) > -1
  } else if (typeof pattern === 'string') {
    return pattern.split(',').indexOf(name) > -1
  } else if (isRegExp(pattern)) {
    return pattern.test(name)
  }
  /* istanbul ignore next */
  return false
}

function pruneCache (keepAliveInstance, filter) {
  var cache = keepAliveInstance.cache;
  var keys = keepAliveInstance.keys;
  var _vnode = keepAliveInstance._vnode;
  for (var key in cache) {
    var cachedNode = cache[key];
    if (cachedNode) {
      var name = getComponentName(cachedNode.componentOptions);
      if (name && !filter(name)) {
        pruneCacheEntry(cache, key, keys, _vnode);
      }
    }
  }
}

function pruneCacheEntry (
  cache,
  key,
  keys,
  current
) {
  var cached$$1 = cache[key];
  if (cached$$1 && (!current || cached$$1.tag !== current.tag)) {
    cached$$1.componentInstance.$destroy();
  }
  cache[key] = null;
  remove(keys, key);
}

var patternTypes = [String, RegExp, Array];

var KeepAlive = {
  name: 'keep-alive',
  abstract: true,

  props: {
    include: patternTypes,
    exclude: patternTypes,
    max: [String, Number]
  },

  created: function created () {
    this.cache = Object.create(null);
    this.keys = [];
  },

  destroyed: function destroyed () {
    for (var key in this.cache) {
      pruneCacheEntry(this.cache, key, this.keys);
    }
  },

  mounted: function mounted () {
    var this$1 = this;

    this.$watch('include', function (val) {
      pruneCache(this$1, function (name) { return matches(val, name); });
    });
    this.$watch('exclude', function (val) {
      pruneCache(this$1, function (name) { return !matches(val, name); });
    });
  },

  render: function render () {
    var slot = this.$slots.default;
    var vnode = getFirstComponentChild(slot);
    var componentOptions = vnode && vnode.componentOptions;
    if (componentOptions) {
      // check pattern
      var name = getComponentName(componentOptions);
      var ref = this;
      var include = ref.include;
      var exclude = ref.exclude;
      if (
        // not included
        (include && (!name || !matches(include, name))) ||
        // excluded
        (exclude && name && matches(exclude, name))
      ) {
        return vnode
      }

      var ref$1 = this;
      var cache = ref$1.cache;
      var keys = ref$1.keys;
      var key = vnode.key == null
        // same constructor may get registered as different local components
        // so cid alone is not enough (#3269)
        ? componentOptions.Ctor.cid + (componentOptions.tag ? ("::" + (componentOptions.tag)) : '')
        : vnode.key;
      if (cache[key]) {
        vnode.componentInstance = cache[key].componentInstance;
        // make current key freshest
        remove(keys, key);
        keys.push(key);
      } else {
        cache[key] = vnode;
        keys.push(key);
        // prune oldest entry
        if (this.max && keys.length > parseInt(this.max)) {
          pruneCacheEntry(cache, keys[0], keys, this._vnode);
        }
      }

      vnode.data.keepAlive = true;
    }
    return vnode || (slot && slot[0])
  }
};

var builtInComponents = {
  KeepAlive: KeepAlive
};

/*  */

function initGlobalAPI (Vue) {
  // config
  var configDef = {};
  configDef.get = function () { return config; };
  if (true) {
    configDef.set = function () {
      warn(
        'Do not replace the Vue.config object, set individual fields instead.'
      );
    };
  }
  Object.defineProperty(Vue, 'config', configDef);

  // exposed util methods.
  // NOTE: these are not considered part of the public API - avoid relying on
  // them unless you are aware of the risk.
  Vue.util = {
    warn: warn,
    extend: extend,
    mergeOptions: mergeOptions,
    defineReactive: defineReactive$$1
  };

  Vue.set = set;
  Vue.delete = del;
  Vue.nextTick = nextTick;

  // 2.6 explicit observable API
  Vue.observable = function (obj) {
    observe(obj);
    return obj
  };

  Vue.options = Object.create(null);
  ASSET_TYPES.forEach(function (type) {
    Vue.options[type + 's'] = Object.create(null);
  });

  // this is used to identify the "base" constructor to extend all plain-object
  // components with in Weex's multi-instance scenarios.
  Vue.options._base = Vue;

  extend(Vue.options.components, builtInComponents);

  initUse(Vue);
  initMixin$1(Vue);
  initExtend(Vue);
  initAssetRegisters(Vue);
}

initGlobalAPI(Vue);

Object.defineProperty(Vue.prototype, '$isServer', {
  get: isServerRendering
});

Object.defineProperty(Vue.prototype, '$ssrContext', {
  get: function get () {
    /* istanbul ignore next */
    return this.$vnode && this.$vnode.ssrContext
  }
});

// expose FunctionalRenderContext for ssr runtime helper installation
Object.defineProperty(Vue, 'FunctionalRenderContext', {
  value: FunctionalRenderContext
});

Vue.version = '2.6.10';

/**
 * https://raw.githubusercontent.com/Tencent/westore/master/packages/westore/utils/diff.js
 */
var ARRAYTYPE = '[object Array]';
var OBJECTTYPE = '[object Object]';
// const FUNCTIONTYPE = '[object Function]'

function diff(current, pre) {
    var result = {};
    syncKeys(current, pre);
    _diff(current, pre, '', result);
    return result
}

function syncKeys(current, pre) {
    if (current === pre) { return }
    var rootCurrentType = type(current);
    var rootPreType = type(pre);
    if (rootCurrentType == OBJECTTYPE && rootPreType == OBJECTTYPE) {
        if(Object.keys(current).length >= Object.keys(pre).length){
            for (var key in pre) {
                var currentValue = current[key];
                if (currentValue === undefined) {
                    current[key] = null;
                } else {
                    syncKeys(currentValue, pre[key]);
                }
            }
        }
    } else if (rootCurrentType == ARRAYTYPE && rootPreType == ARRAYTYPE) {
        if (current.length >= pre.length) {
            pre.forEach(function (item, index) {
                syncKeys(current[index], item);
            });
        }
    }
}

function _diff(current, pre, path, result) {
    if (current === pre) { return }
    var rootCurrentType = type(current);
    var rootPreType = type(pre);
    if (rootCurrentType == OBJECTTYPE) {
        if (rootPreType != OBJECTTYPE || Object.keys(current).length < Object.keys(pre).length) {
            setResult(result, path, current);
        } else {
            var loop = function ( key ) {
                var currentValue = current[key];
                var preValue = pre[key];
                var currentType = type(currentValue);
                var preType = type(preValue);
                if (currentType != ARRAYTYPE && currentType != OBJECTTYPE) {
                    if (currentValue != pre[key]) {
                        setResult(result, (path == '' ? '' : path + ".") + key, currentValue);
                    }
                } else if (currentType == ARRAYTYPE) {
                    if (preType != ARRAYTYPE) {
                        setResult(result, (path == '' ? '' : path + ".") + key, currentValue);
                    } else {
                        if (currentValue.length < preValue.length) {
                            setResult(result, (path == '' ? '' : path + ".") + key, currentValue);
                        } else {
                            currentValue.forEach(function (item, index) {
                                _diff(item, preValue[index], (path == '' ? '' : path + ".") + key + '[' + index + ']', result);
                            });
                        }
                    }
                } else if (currentType == OBJECTTYPE) {
                    if (preType != OBJECTTYPE || Object.keys(currentValue).length < Object.keys(preValue).length) {
                        setResult(result, (path == '' ? '' : path + ".") + key, currentValue);
                    } else {
                        for (var subKey in currentValue) {
                            _diff(currentValue[subKey], preValue[subKey], (path == '' ? '' : path + ".") + key + '.' + subKey, result);
                        }
                    }
                }
            };

            for (var key in current) loop( key );
        }
    } else if (rootCurrentType == ARRAYTYPE) {
        if (rootPreType != ARRAYTYPE) {
            setResult(result, path, current);
        } else {
            if (current.length < pre.length) {
                setResult(result, path, current);
            } else {
                current.forEach(function (item, index) {
                    _diff(item, pre[index], path + '[' + index + ']', result);
                });
            }
        }
    } else {
        setResult(result, path, current);
    }
}

function setResult(result, k, v) {
    // if (type(v) != FUNCTIONTYPE) {
        result[k] = v;
    // }
}

function type(obj) {
    return Object.prototype.toString.call(obj)
}

/*  */

function flushCallbacks$1(vm) {
    if (vm.__next_tick_callbacks && vm.__next_tick_callbacks.length) {
        if (Object({"VUE_APP_PLATFORM":"mp-weixin","NODE_ENV":"development","BASE_URL":"/"}).VUE_APP_DEBUG) {
            var mpInstance = vm.$scope;
            console.log('[' + (+new Date) + '][' + (mpInstance.is || mpInstance.route) + '][' + vm._uid +
                ']:flushCallbacks[' + vm.__next_tick_callbacks.length + ']');
        }
        var copies = vm.__next_tick_callbacks.slice(0);
        vm.__next_tick_callbacks.length = 0;
        for (var i = 0; i < copies.length; i++) {
            copies[i]();
        }
    }
}

function hasRenderWatcher(vm) {
    return queue.find(function (watcher) { return vm._watcher === watcher; })
}

function nextTick$1(vm, cb) {
    //1.nextTick 之前 已 setData 且 setData 还未回调完成
    //2.nextTick 之前存在 render watcher
    if (!vm.__next_tick_pending && !hasRenderWatcher(vm)) {
        if(Object({"VUE_APP_PLATFORM":"mp-weixin","NODE_ENV":"development","BASE_URL":"/"}).VUE_APP_DEBUG){
            var mpInstance = vm.$scope;
            console.log('[' + (+new Date) + '][' + (mpInstance.is || mpInstance.route) + '][' + vm._uid +
                ']:nextVueTick');
        }
        return nextTick(cb, vm)
    }else{
        if(Object({"VUE_APP_PLATFORM":"mp-weixin","NODE_ENV":"development","BASE_URL":"/"}).VUE_APP_DEBUG){
            var mpInstance$1 = vm.$scope;
            console.log('[' + (+new Date) + '][' + (mpInstance$1.is || mpInstance$1.route) + '][' + vm._uid +
                ']:nextMPTick');
        }
    }
    var _resolve;
    if (!vm.__next_tick_callbacks) {
        vm.__next_tick_callbacks = [];
    }
    vm.__next_tick_callbacks.push(function () {
        if (cb) {
            try {
                cb.call(vm);
            } catch (e) {
                handleError(e, vm, 'nextTick');
            }
        } else if (_resolve) {
            _resolve(vm);
        }
    });
    // $flow-disable-line
    if (!cb && typeof Promise !== 'undefined') {
        return new Promise(function (resolve) {
            _resolve = resolve;
        })
    }
}

/*  */

function cloneWithData(vm) {
  // 确保当前 vm 所有数据被同步
  var ret = Object.create(null);
  var dataKeys = [].concat(
    Object.keys(vm._data || {}),
    Object.keys(vm._computedWatchers || {}));

  dataKeys.reduce(function(ret, key) {
    ret[key] = vm[key];
    return ret
  }, ret);
  //TODO 需要把无用数据处理掉，比如 list=>l0 则 list 需要移除，否则多传输一份数据
  Object.assign(ret, vm.$mp.data || {});
  if (
    Array.isArray(vm.$options.behaviors) &&
    vm.$options.behaviors.indexOf('uni://form-field') !== -1
  ) { //form-field
    ret['name'] = vm.name;
    ret['value'] = vm.value;
  }

  return JSON.parse(JSON.stringify(ret))
}

var patch = function(oldVnode, vnode) {
  var this$1 = this;

  if (vnode === null) { //destroy
    return
  }
  if (this.mpType === 'page' || this.mpType === 'component') {
    var mpInstance = this.$scope;
    var data = Object.create(null);
    try {
      data = cloneWithData(this);
    } catch (err) {
      console.error(err);
    }
    data.__webviewId__ = mpInstance.data.__webviewId__;
    var mpData = Object.create(null);
    Object.keys(data).forEach(function (key) { //仅同步 data 中有的数据
      mpData[key] = mpInstance.data[key];
    });
    var diffData = diff(data, mpData);
    if (Object.keys(diffData).length) {
      if (Object({"VUE_APP_PLATFORM":"mp-weixin","NODE_ENV":"development","BASE_URL":"/"}).VUE_APP_DEBUG) {
        console.log('[' + (+new Date) + '][' + (mpInstance.is || mpInstance.route) + '][' + this._uid +
          ']差量更新',
          JSON.stringify(diffData));
      }
      this.__next_tick_pending = true;
      mpInstance.setData(diffData, function () {
        this$1.__next_tick_pending = false;
        flushCallbacks$1(this$1);
      });
    } else {
      flushCallbacks$1(this);
    }
  }
};

/*  */

function createEmptyRender() {

}

function mountComponent$1(
  vm,
  el,
  hydrating
) {
  if (!vm.mpType) {//main.js 中的 new Vue
    return vm
  }
  if (vm.mpType === 'app') {
    vm.$options.render = createEmptyRender;
  }
  if (!vm.$options.render) {
    vm.$options.render = createEmptyRender;
    if (true) {
      /* istanbul ignore if */
      if ((vm.$options.template && vm.$options.template.charAt(0) !== '#') ||
        vm.$options.el || el) {
        warn(
          'You are using the runtime-only build of Vue where the template ' +
          'compiler is not available. Either pre-compile the templates into ' +
          'render functions, or use the compiler-included build.',
          vm
        );
      } else {
        warn(
          'Failed to mount component: template or render function not defined.',
          vm
        );
      }
    }
  }
  
  vm.mpHost !== 'mp-toutiao' && callHook(vm, 'beforeMount');

  var updateComponent = function () {
    vm._update(vm._render(), hydrating);
  };

  // we set this to vm._watcher inside the watcher's constructor
  // since the watcher's initial patch may call $forceUpdate (e.g. inside child
  // component's mounted hook), which relies on vm._watcher being already defined
  new Watcher(vm, updateComponent, noop, {
    before: function before() {
      if (vm._isMounted && !vm._isDestroyed) {
        callHook(vm, 'beforeUpdate');
      }
    }
  }, true /* isRenderWatcher */);
  hydrating = false;
  return vm
}

/*  */

function renderClass (
  staticClass,
  dynamicClass
) {
  if (isDef(staticClass) || isDef(dynamicClass)) {
    return concat(staticClass, stringifyClass(dynamicClass))
  }
  /* istanbul ignore next */
  return ''
}

function concat (a, b) {
  return a ? b ? (a + ' ' + b) : a : (b || '')
}

function stringifyClass (value) {
  if (Array.isArray(value)) {
    return stringifyArray(value)
  }
  if (isObject(value)) {
    return stringifyObject(value)
  }
  if (typeof value === 'string') {
    return value
  }
  /* istanbul ignore next */
  return ''
}

function stringifyArray (value) {
  var res = '';
  var stringified;
  for (var i = 0, l = value.length; i < l; i++) {
    if (isDef(stringified = stringifyClass(value[i])) && stringified !== '') {
      if (res) { res += ' '; }
      res += stringified;
    }
  }
  return res
}

function stringifyObject (value) {
  var res = '';
  for (var key in value) {
    if (value[key]) {
      if (res) { res += ' '; }
      res += key;
    }
  }
  return res
}

/*  */

var parseStyleText = cached(function (cssText) {
  var res = {};
  var listDelimiter = /;(?![^(]*\))/g;
  var propertyDelimiter = /:(.+)/;
  cssText.split(listDelimiter).forEach(function (item) {
    if (item) {
      var tmp = item.split(propertyDelimiter);
      tmp.length > 1 && (res[tmp[0].trim()] = tmp[1].trim());
    }
  });
  return res
});

// normalize possible array / string values into Object
function normalizeStyleBinding (bindingStyle) {
  if (Array.isArray(bindingStyle)) {
    return toObject(bindingStyle)
  }
  if (typeof bindingStyle === 'string') {
    return parseStyleText(bindingStyle)
  }
  return bindingStyle
}

/*  */

var MP_METHODS = ['createSelectorQuery', 'createIntersectionObserver', 'selectAllComponents', 'selectComponent'];

function getTarget(obj, path) {
  var parts = path.split('.');
  var key = parts[0];
  if (key.indexOf('__$n') === 0) { //number index
    key = parseInt(key.replace('__$n', ''));
  }
  if (parts.length === 1) {
    return obj[key]
  }
  return getTarget(obj[key], parts.slice(1).join('.'))
}

function internalMixin(Vue) {

  Vue.config.errorHandler = function(err) {
    console.error(err);
  };

  var oldEmit = Vue.prototype.$emit;

  Vue.prototype.$emit = function(event) {
    if (this.$scope && event) {
      this.$scope['triggerEvent'](event, {
        __args__: toArray(arguments, 1)
      });
    }
    return oldEmit.apply(this, arguments)
  };

  Vue.prototype.$nextTick = function(fn) {
    return nextTick$1(this, fn)
  };

  MP_METHODS.forEach(function (method) {
    Vue.prototype[method] = function(args) {
      if (this.$scope) {
        return this.$scope[method](args)
      }
    };
  });

  Vue.prototype.__init_provide = initProvide;

  Vue.prototype.__init_injections = initInjections;

  Vue.prototype.__call_hook = function(hook, args) {
    var vm = this;
    // #7573 disable dep collection when invoking lifecycle hooks
    pushTarget();
    var handlers = vm.$options[hook];
    var info = hook + " hook";
    var ret;
    if (handlers) {
      for (var i = 0, j = handlers.length; i < j; i++) {
        ret = invokeWithErrorHandling(handlers[i], vm, args ? [args] : null, vm, info);
      }
    }
    if (vm._hasHookEvent) {
      vm.$emit('hook:' + hook);
    }
    popTarget();
    return ret
  };

  Vue.prototype.__set_model = function(target, key, value, modifiers) {
    if (Array.isArray(modifiers)) {
      if (modifiers.indexOf('trim') !== -1) {
        value = value.trim();
      }
      if (modifiers.indexOf('number') !== -1) {
        value = this._n(value);
      }
    }
    if (!target) {
      target = this;
    }
    target[key] = value;
  };

  Vue.prototype.__set_sync = function(target, key, value) {
    if (!target) {
      target = this;
    }
    target[key] = value;
  };

  Vue.prototype.__get_orig = function(item) {
    if (isPlainObject(item)) {
      return item['$orig'] || item
    }
    return item
  };

  Vue.prototype.__get_value = function(dataPath, target) {
    return getTarget(target || this, dataPath)
  };


  Vue.prototype.__get_class = function(dynamicClass, staticClass) {
    return renderClass(staticClass, dynamicClass)
  };

  Vue.prototype.__get_style = function(dynamicStyle, staticStyle) {
    if (!dynamicStyle && !staticStyle) {
      return ''
    }
    var dynamicStyleObj = normalizeStyleBinding(dynamicStyle);
    var styleObj = staticStyle ? extend(staticStyle, dynamicStyleObj) : dynamicStyleObj;
    return Object.keys(styleObj).map(function (name) { return ((hyphenate(name)) + ":" + (styleObj[name])); }).join(';')
  };

  Vue.prototype.__map = function(val, iteratee) {
    //TODO 暂不考虑 string,number
    var ret, i, l, keys, key;
    if (Array.isArray(val)) {
      ret = new Array(val.length);
      for (i = 0, l = val.length; i < l; i++) {
        ret[i] = iteratee(val[i], i);
      }
      return ret
    } else if (isObject(val)) {
      keys = Object.keys(val);
      ret = Object.create(null);
      for (i = 0, l = keys.length; i < l; i++) {
        key = keys[i];
        ret[key] = iteratee(val[key], key, i);
      }
      return ret
    }
    return []
  };

}

/*  */

var LIFECYCLE_HOOKS$1 = [
    //App
    'onLaunch',
    'onShow',
    'onHide',
    'onUniNViewMessage',
    'onError',
    //Page
    'onLoad',
    // 'onShow',
    'onReady',
    // 'onHide',
    'onUnload',
    'onPullDownRefresh',
    'onReachBottom',
    'onTabItemTap',
    'onShareAppMessage',
    'onResize',
    'onPageScroll',
    'onNavigationBarButtonTap',
    'onBackPress',
    'onNavigationBarSearchInputChanged',
    'onNavigationBarSearchInputConfirmed',
    'onNavigationBarSearchInputClicked',
    //Component
    // 'onReady', // 兼容旧版本，应该移除该事件
    'onPageShow',
    'onPageHide',
    'onPageResize'
];
function lifecycleMixin$1(Vue) {

    //fixed vue-class-component
    var oldExtend = Vue.extend;
    Vue.extend = function(extendOptions) {
        extendOptions = extendOptions || {};

        var methods = extendOptions.methods;
        if (methods) {
            Object.keys(methods).forEach(function (methodName) {
                if (LIFECYCLE_HOOKS$1.indexOf(methodName)!==-1) {
                    extendOptions[methodName] = methods[methodName];
                    delete methods[methodName];
                }
            });
        }

        return oldExtend.call(this, extendOptions)
    };

    var strategies = Vue.config.optionMergeStrategies;
    var mergeHook = strategies.created;
    LIFECYCLE_HOOKS$1.forEach(function (hook) {
        strategies[hook] = mergeHook;
    });

    Vue.prototype.__lifecycle_hooks__ = LIFECYCLE_HOOKS$1;
}

/*  */

// install platform patch function
Vue.prototype.__patch__ = patch;

// public mount method
Vue.prototype.$mount = function(
    el ,
    hydrating 
) {
    return mountComponent$1(this, el, hydrating)
};

lifecycleMixin$1(Vue);
internalMixin(Vue);

/*  */

/* harmony default export */ __webpack_exports__["default"] = (Vue);

/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! ./../../../../../webpack/buildin/global.js */ 3)))

/***/ }),

/***/ 20:
/*!**********************************************************!*\
  !*** ./node_modules/@babel/runtime/regenerator/index.js ***!
  \**********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! regenerator-runtime */ 21);


/***/ }),

/***/ 21:
/*!************************************************************!*\
  !*** ./node_modules/regenerator-runtime/runtime-module.js ***!
  \************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/**
 * Copyright (c) 2014-present, Facebook, Inc.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

// This method of obtaining a reference to the global object needs to be
// kept identical to the way it is obtained in runtime.js
var g = (function() {
  return this || (typeof self === "object" && self);
})() || Function("return this")();

// Use `getOwnPropertyNames` because not all browsers support calling
// `hasOwnProperty` on the global `self` object in a worker. See #183.
var hadRuntime = g.regeneratorRuntime &&
  Object.getOwnPropertyNames(g).indexOf("regeneratorRuntime") >= 0;

// Save the old regeneratorRuntime in case it needs to be restored later.
var oldRuntime = hadRuntime && g.regeneratorRuntime;

// Force reevalutation of runtime.js.
g.regeneratorRuntime = undefined;

module.exports = __webpack_require__(/*! ./runtime */ 22);

if (hadRuntime) {
  // Restore the original runtime.
  g.regeneratorRuntime = oldRuntime;
} else {
  // Remove the global property added by runtime.js.
  try {
    delete g.regeneratorRuntime;
  } catch(e) {
    g.regeneratorRuntime = undefined;
  }
}


/***/ }),

/***/ 22:
/*!*****************************************************!*\
  !*** ./node_modules/regenerator-runtime/runtime.js ***!
  \*****************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/**
 * Copyright (c) 2014-present, Facebook, Inc.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

!(function(global) {
  "use strict";

  var Op = Object.prototype;
  var hasOwn = Op.hasOwnProperty;
  var undefined; // More compressible than void 0.
  var $Symbol = typeof Symbol === "function" ? Symbol : {};
  var iteratorSymbol = $Symbol.iterator || "@@iterator";
  var asyncIteratorSymbol = $Symbol.asyncIterator || "@@asyncIterator";
  var toStringTagSymbol = $Symbol.toStringTag || "@@toStringTag";

  var inModule = typeof module === "object";
  var runtime = global.regeneratorRuntime;
  if (runtime) {
    if (inModule) {
      // If regeneratorRuntime is defined globally and we're in a module,
      // make the exports object identical to regeneratorRuntime.
      module.exports = runtime;
    }
    // Don't bother evaluating the rest of this file if the runtime was
    // already defined globally.
    return;
  }

  // Define the runtime globally (as expected by generated code) as either
  // module.exports (if we're in a module) or a new, empty object.
  runtime = global.regeneratorRuntime = inModule ? module.exports : {};

  function wrap(innerFn, outerFn, self, tryLocsList) {
    // If outerFn provided and outerFn.prototype is a Generator, then outerFn.prototype instanceof Generator.
    var protoGenerator = outerFn && outerFn.prototype instanceof Generator ? outerFn : Generator;
    var generator = Object.create(protoGenerator.prototype);
    var context = new Context(tryLocsList || []);

    // The ._invoke method unifies the implementations of the .next,
    // .throw, and .return methods.
    generator._invoke = makeInvokeMethod(innerFn, self, context);

    return generator;
  }
  runtime.wrap = wrap;

  // Try/catch helper to minimize deoptimizations. Returns a completion
  // record like context.tryEntries[i].completion. This interface could
  // have been (and was previously) designed to take a closure to be
  // invoked without arguments, but in all the cases we care about we
  // already have an existing method we want to call, so there's no need
  // to create a new function object. We can even get away with assuming
  // the method takes exactly one argument, since that happens to be true
  // in every case, so we don't have to touch the arguments object. The
  // only additional allocation required is the completion record, which
  // has a stable shape and so hopefully should be cheap to allocate.
  function tryCatch(fn, obj, arg) {
    try {
      return { type: "normal", arg: fn.call(obj, arg) };
    } catch (err) {
      return { type: "throw", arg: err };
    }
  }

  var GenStateSuspendedStart = "suspendedStart";
  var GenStateSuspendedYield = "suspendedYield";
  var GenStateExecuting = "executing";
  var GenStateCompleted = "completed";

  // Returning this object from the innerFn has the same effect as
  // breaking out of the dispatch switch statement.
  var ContinueSentinel = {};

  // Dummy constructor functions that we use as the .constructor and
  // .constructor.prototype properties for functions that return Generator
  // objects. For full spec compliance, you may wish to configure your
  // minifier not to mangle the names of these two functions.
  function Generator() {}
  function GeneratorFunction() {}
  function GeneratorFunctionPrototype() {}

  // This is a polyfill for %IteratorPrototype% for environments that
  // don't natively support it.
  var IteratorPrototype = {};
  IteratorPrototype[iteratorSymbol] = function () {
    return this;
  };

  var getProto = Object.getPrototypeOf;
  var NativeIteratorPrototype = getProto && getProto(getProto(values([])));
  if (NativeIteratorPrototype &&
      NativeIteratorPrototype !== Op &&
      hasOwn.call(NativeIteratorPrototype, iteratorSymbol)) {
    // This environment has a native %IteratorPrototype%; use it instead
    // of the polyfill.
    IteratorPrototype = NativeIteratorPrototype;
  }

  var Gp = GeneratorFunctionPrototype.prototype =
    Generator.prototype = Object.create(IteratorPrototype);
  GeneratorFunction.prototype = Gp.constructor = GeneratorFunctionPrototype;
  GeneratorFunctionPrototype.constructor = GeneratorFunction;
  GeneratorFunctionPrototype[toStringTagSymbol] =
    GeneratorFunction.displayName = "GeneratorFunction";

  // Helper for defining the .next, .throw, and .return methods of the
  // Iterator interface in terms of a single ._invoke method.
  function defineIteratorMethods(prototype) {
    ["next", "throw", "return"].forEach(function(method) {
      prototype[method] = function(arg) {
        return this._invoke(method, arg);
      };
    });
  }

  runtime.isGeneratorFunction = function(genFun) {
    var ctor = typeof genFun === "function" && genFun.constructor;
    return ctor
      ? ctor === GeneratorFunction ||
        // For the native GeneratorFunction constructor, the best we can
        // do is to check its .name property.
        (ctor.displayName || ctor.name) === "GeneratorFunction"
      : false;
  };

  runtime.mark = function(genFun) {
    if (Object.setPrototypeOf) {
      Object.setPrototypeOf(genFun, GeneratorFunctionPrototype);
    } else {
      genFun.__proto__ = GeneratorFunctionPrototype;
      if (!(toStringTagSymbol in genFun)) {
        genFun[toStringTagSymbol] = "GeneratorFunction";
      }
    }
    genFun.prototype = Object.create(Gp);
    return genFun;
  };

  // Within the body of any async function, `await x` is transformed to
  // `yield regeneratorRuntime.awrap(x)`, so that the runtime can test
  // `hasOwn.call(value, "__await")` to determine if the yielded value is
  // meant to be awaited.
  runtime.awrap = function(arg) {
    return { __await: arg };
  };

  function AsyncIterator(generator) {
    function invoke(method, arg, resolve, reject) {
      var record = tryCatch(generator[method], generator, arg);
      if (record.type === "throw") {
        reject(record.arg);
      } else {
        var result = record.arg;
        var value = result.value;
        if (value &&
            typeof value === "object" &&
            hasOwn.call(value, "__await")) {
          return Promise.resolve(value.__await).then(function(value) {
            invoke("next", value, resolve, reject);
          }, function(err) {
            invoke("throw", err, resolve, reject);
          });
        }

        return Promise.resolve(value).then(function(unwrapped) {
          // When a yielded Promise is resolved, its final value becomes
          // the .value of the Promise<{value,done}> result for the
          // current iteration.
          result.value = unwrapped;
          resolve(result);
        }, function(error) {
          // If a rejected Promise was yielded, throw the rejection back
          // into the async generator function so it can be handled there.
          return invoke("throw", error, resolve, reject);
        });
      }
    }

    var previousPromise;

    function enqueue(method, arg) {
      function callInvokeWithMethodAndArg() {
        return new Promise(function(resolve, reject) {
          invoke(method, arg, resolve, reject);
        });
      }

      return previousPromise =
        // If enqueue has been called before, then we want to wait until
        // all previous Promises have been resolved before calling invoke,
        // so that results are always delivered in the correct order. If
        // enqueue has not been called before, then it is important to
        // call invoke immediately, without waiting on a callback to fire,
        // so that the async generator function has the opportunity to do
        // any necessary setup in a predictable way. This predictability
        // is why the Promise constructor synchronously invokes its
        // executor callback, and why async functions synchronously
        // execute code before the first await. Since we implement simple
        // async functions in terms of async generators, it is especially
        // important to get this right, even though it requires care.
        previousPromise ? previousPromise.then(
          callInvokeWithMethodAndArg,
          // Avoid propagating failures to Promises returned by later
          // invocations of the iterator.
          callInvokeWithMethodAndArg
        ) : callInvokeWithMethodAndArg();
    }

    // Define the unified helper method that is used to implement .next,
    // .throw, and .return (see defineIteratorMethods).
    this._invoke = enqueue;
  }

  defineIteratorMethods(AsyncIterator.prototype);
  AsyncIterator.prototype[asyncIteratorSymbol] = function () {
    return this;
  };
  runtime.AsyncIterator = AsyncIterator;

  // Note that simple async functions are implemented on top of
  // AsyncIterator objects; they just return a Promise for the value of
  // the final result produced by the iterator.
  runtime.async = function(innerFn, outerFn, self, tryLocsList) {
    var iter = new AsyncIterator(
      wrap(innerFn, outerFn, self, tryLocsList)
    );

    return runtime.isGeneratorFunction(outerFn)
      ? iter // If outerFn is a generator, return the full iterator.
      : iter.next().then(function(result) {
          return result.done ? result.value : iter.next();
        });
  };

  function makeInvokeMethod(innerFn, self, context) {
    var state = GenStateSuspendedStart;

    return function invoke(method, arg) {
      if (state === GenStateExecuting) {
        throw new Error("Generator is already running");
      }

      if (state === GenStateCompleted) {
        if (method === "throw") {
          throw arg;
        }

        // Be forgiving, per 25.3.3.3.3 of the spec:
        // https://people.mozilla.org/~jorendorff/es6-draft.html#sec-generatorresume
        return doneResult();
      }

      context.method = method;
      context.arg = arg;

      while (true) {
        var delegate = context.delegate;
        if (delegate) {
          var delegateResult = maybeInvokeDelegate(delegate, context);
          if (delegateResult) {
            if (delegateResult === ContinueSentinel) continue;
            return delegateResult;
          }
        }

        if (context.method === "next") {
          // Setting context._sent for legacy support of Babel's
          // function.sent implementation.
          context.sent = context._sent = context.arg;

        } else if (context.method === "throw") {
          if (state === GenStateSuspendedStart) {
            state = GenStateCompleted;
            throw context.arg;
          }

          context.dispatchException(context.arg);

        } else if (context.method === "return") {
          context.abrupt("return", context.arg);
        }

        state = GenStateExecuting;

        var record = tryCatch(innerFn, self, context);
        if (record.type === "normal") {
          // If an exception is thrown from innerFn, we leave state ===
          // GenStateExecuting and loop back for another invocation.
          state = context.done
            ? GenStateCompleted
            : GenStateSuspendedYield;

          if (record.arg === ContinueSentinel) {
            continue;
          }

          return {
            value: record.arg,
            done: context.done
          };

        } else if (record.type === "throw") {
          state = GenStateCompleted;
          // Dispatch the exception by looping back around to the
          // context.dispatchException(context.arg) call above.
          context.method = "throw";
          context.arg = record.arg;
        }
      }
    };
  }

  // Call delegate.iterator[context.method](context.arg) and handle the
  // result, either by returning a { value, done } result from the
  // delegate iterator, or by modifying context.method and context.arg,
  // setting context.delegate to null, and returning the ContinueSentinel.
  function maybeInvokeDelegate(delegate, context) {
    var method = delegate.iterator[context.method];
    if (method === undefined) {
      // A .throw or .return when the delegate iterator has no .throw
      // method always terminates the yield* loop.
      context.delegate = null;

      if (context.method === "throw") {
        if (delegate.iterator.return) {
          // If the delegate iterator has a return method, give it a
          // chance to clean up.
          context.method = "return";
          context.arg = undefined;
          maybeInvokeDelegate(delegate, context);

          if (context.method === "throw") {
            // If maybeInvokeDelegate(context) changed context.method from
            // "return" to "throw", let that override the TypeError below.
            return ContinueSentinel;
          }
        }

        context.method = "throw";
        context.arg = new TypeError(
          "The iterator does not provide a 'throw' method");
      }

      return ContinueSentinel;
    }

    var record = tryCatch(method, delegate.iterator, context.arg);

    if (record.type === "throw") {
      context.method = "throw";
      context.arg = record.arg;
      context.delegate = null;
      return ContinueSentinel;
    }

    var info = record.arg;

    if (! info) {
      context.method = "throw";
      context.arg = new TypeError("iterator result is not an object");
      context.delegate = null;
      return ContinueSentinel;
    }

    if (info.done) {
      // Assign the result of the finished delegate to the temporary
      // variable specified by delegate.resultName (see delegateYield).
      context[delegate.resultName] = info.value;

      // Resume execution at the desired location (see delegateYield).
      context.next = delegate.nextLoc;

      // If context.method was "throw" but the delegate handled the
      // exception, let the outer generator proceed normally. If
      // context.method was "next", forget context.arg since it has been
      // "consumed" by the delegate iterator. If context.method was
      // "return", allow the original .return call to continue in the
      // outer generator.
      if (context.method !== "return") {
        context.method = "next";
        context.arg = undefined;
      }

    } else {
      // Re-yield the result returned by the delegate method.
      return info;
    }

    // The delegate iterator is finished, so forget it and continue with
    // the outer generator.
    context.delegate = null;
    return ContinueSentinel;
  }

  // Define Generator.prototype.{next,throw,return} in terms of the
  // unified ._invoke helper method.
  defineIteratorMethods(Gp);

  Gp[toStringTagSymbol] = "Generator";

  // A Generator should always return itself as the iterator object when the
  // @@iterator function is called on it. Some browsers' implementations of the
  // iterator prototype chain incorrectly implement this, causing the Generator
  // object to not be returned from this call. This ensures that doesn't happen.
  // See https://github.com/facebook/regenerator/issues/274 for more details.
  Gp[iteratorSymbol] = function() {
    return this;
  };

  Gp.toString = function() {
    return "[object Generator]";
  };

  function pushTryEntry(locs) {
    var entry = { tryLoc: locs[0] };

    if (1 in locs) {
      entry.catchLoc = locs[1];
    }

    if (2 in locs) {
      entry.finallyLoc = locs[2];
      entry.afterLoc = locs[3];
    }

    this.tryEntries.push(entry);
  }

  function resetTryEntry(entry) {
    var record = entry.completion || {};
    record.type = "normal";
    delete record.arg;
    entry.completion = record;
  }

  function Context(tryLocsList) {
    // The root entry object (effectively a try statement without a catch
    // or a finally block) gives us a place to store values thrown from
    // locations where there is no enclosing try statement.
    this.tryEntries = [{ tryLoc: "root" }];
    tryLocsList.forEach(pushTryEntry, this);
    this.reset(true);
  }

  runtime.keys = function(object) {
    var keys = [];
    for (var key in object) {
      keys.push(key);
    }
    keys.reverse();

    // Rather than returning an object with a next method, we keep
    // things simple and return the next function itself.
    return function next() {
      while (keys.length) {
        var key = keys.pop();
        if (key in object) {
          next.value = key;
          next.done = false;
          return next;
        }
      }

      // To avoid creating an additional object, we just hang the .value
      // and .done properties off the next function object itself. This
      // also ensures that the minifier will not anonymize the function.
      next.done = true;
      return next;
    };
  };

  function values(iterable) {
    if (iterable) {
      var iteratorMethod = iterable[iteratorSymbol];
      if (iteratorMethod) {
        return iteratorMethod.call(iterable);
      }

      if (typeof iterable.next === "function") {
        return iterable;
      }

      if (!isNaN(iterable.length)) {
        var i = -1, next = function next() {
          while (++i < iterable.length) {
            if (hasOwn.call(iterable, i)) {
              next.value = iterable[i];
              next.done = false;
              return next;
            }
          }

          next.value = undefined;
          next.done = true;

          return next;
        };

        return next.next = next;
      }
    }

    // Return an iterator with no values.
    return { next: doneResult };
  }
  runtime.values = values;

  function doneResult() {
    return { value: undefined, done: true };
  }

  Context.prototype = {
    constructor: Context,

    reset: function(skipTempReset) {
      this.prev = 0;
      this.next = 0;
      // Resetting context._sent for legacy support of Babel's
      // function.sent implementation.
      this.sent = this._sent = undefined;
      this.done = false;
      this.delegate = null;

      this.method = "next";
      this.arg = undefined;

      this.tryEntries.forEach(resetTryEntry);

      if (!skipTempReset) {
        for (var name in this) {
          // Not sure about the optimal order of these conditions:
          if (name.charAt(0) === "t" &&
              hasOwn.call(this, name) &&
              !isNaN(+name.slice(1))) {
            this[name] = undefined;
          }
        }
      }
    },

    stop: function() {
      this.done = true;

      var rootEntry = this.tryEntries[0];
      var rootRecord = rootEntry.completion;
      if (rootRecord.type === "throw") {
        throw rootRecord.arg;
      }

      return this.rval;
    },

    dispatchException: function(exception) {
      if (this.done) {
        throw exception;
      }

      var context = this;
      function handle(loc, caught) {
        record.type = "throw";
        record.arg = exception;
        context.next = loc;

        if (caught) {
          // If the dispatched exception was caught by a catch block,
          // then let that catch block handle the exception normally.
          context.method = "next";
          context.arg = undefined;
        }

        return !! caught;
      }

      for (var i = this.tryEntries.length - 1; i >= 0; --i) {
        var entry = this.tryEntries[i];
        var record = entry.completion;

        if (entry.tryLoc === "root") {
          // Exception thrown outside of any try block that could handle
          // it, so set the completion value of the entire function to
          // throw the exception.
          return handle("end");
        }

        if (entry.tryLoc <= this.prev) {
          var hasCatch = hasOwn.call(entry, "catchLoc");
          var hasFinally = hasOwn.call(entry, "finallyLoc");

          if (hasCatch && hasFinally) {
            if (this.prev < entry.catchLoc) {
              return handle(entry.catchLoc, true);
            } else if (this.prev < entry.finallyLoc) {
              return handle(entry.finallyLoc);
            }

          } else if (hasCatch) {
            if (this.prev < entry.catchLoc) {
              return handle(entry.catchLoc, true);
            }

          } else if (hasFinally) {
            if (this.prev < entry.finallyLoc) {
              return handle(entry.finallyLoc);
            }

          } else {
            throw new Error("try statement without catch or finally");
          }
        }
      }
    },

    abrupt: function(type, arg) {
      for (var i = this.tryEntries.length - 1; i >= 0; --i) {
        var entry = this.tryEntries[i];
        if (entry.tryLoc <= this.prev &&
            hasOwn.call(entry, "finallyLoc") &&
            this.prev < entry.finallyLoc) {
          var finallyEntry = entry;
          break;
        }
      }

      if (finallyEntry &&
          (type === "break" ||
           type === "continue") &&
          finallyEntry.tryLoc <= arg &&
          arg <= finallyEntry.finallyLoc) {
        // Ignore the finally entry if control is not jumping to a
        // location outside the try/catch block.
        finallyEntry = null;
      }

      var record = finallyEntry ? finallyEntry.completion : {};
      record.type = type;
      record.arg = arg;

      if (finallyEntry) {
        this.method = "next";
        this.next = finallyEntry.finallyLoc;
        return ContinueSentinel;
      }

      return this.complete(record);
    },

    complete: function(record, afterLoc) {
      if (record.type === "throw") {
        throw record.arg;
      }

      if (record.type === "break" ||
          record.type === "continue") {
        this.next = record.arg;
      } else if (record.type === "return") {
        this.rval = this.arg = record.arg;
        this.method = "return";
        this.next = "end";
      } else if (record.type === "normal" && afterLoc) {
        this.next = afterLoc;
      }

      return ContinueSentinel;
    },

    finish: function(finallyLoc) {
      for (var i = this.tryEntries.length - 1; i >= 0; --i) {
        var entry = this.tryEntries[i];
        if (entry.finallyLoc === finallyLoc) {
          this.complete(entry.completion, entry.afterLoc);
          resetTryEntry(entry);
          return ContinueSentinel;
        }
      }
    },

    "catch": function(tryLoc) {
      for (var i = this.tryEntries.length - 1; i >= 0; --i) {
        var entry = this.tryEntries[i];
        if (entry.tryLoc === tryLoc) {
          var record = entry.completion;
          if (record.type === "throw") {
            var thrown = record.arg;
            resetTryEntry(entry);
          }
          return thrown;
        }
      }

      // The context.catch method must only be called with a location
      // argument that corresponds to a known catch block.
      throw new Error("illegal catch attempt");
    },

    delegateYield: function(iterable, resultName, nextLoc) {
      this.delegate = {
        iterator: values(iterable),
        resultName: resultName,
        nextLoc: nextLoc
      };

      if (this.method === "next") {
        // Deliberately forget the last sent value so that we don't
        // accidentally pass it on to the delegate.
        this.arg = undefined;
      }

      return ContinueSentinel;
    }
  };
})(
  // In sloppy mode, unbound `this` refers to the global object, fallback to
  // Function constructor if we're in global strict mode. That is sadly a form
  // of indirect eval which violates Content Security Policy.
  (function() {
    return this || (typeof self === "object" && self);
  })() || Function("return this")()
);


/***/ }),

/***/ 23:
/*!********************************************************************************************************!*\
  !*** J:/kesionEDU_APP/KS_EDU_APP/客户小程序/首冠小程序定制/lib/polyv/common/regenerator-runtime/runtime-module.js ***!
  \********************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
/* WEBPACK VAR INJECTION */(function(global) {var g = "object" == typeof global ? global : "object" == typeof window ? window : "object" == typeof self ? self : void 0,hadRuntime = g.regeneratorRuntime && Object.getOwnPropertyNames(g).indexOf("regeneratorRuntime") >= 0,oldRuntime = hadRuntime && g.regeneratorRuntime;if (g.regeneratorRuntime = void 0, module.exports = __webpack_require__(/*! ./runtime */ 24), hadRuntime) g.regeneratorRuntime = oldRuntime;else try {delete g.regeneratorRuntime;} catch (e) {g.regeneratorRuntime = void 0;}
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! ./../../../../../../../../软件/HBuilderX.1.9.4.20190426/HBuilderX/plugins/uniapp-cli/node_modules/webpack/buildin/global.js */ 3)))

/***/ }),

/***/ 24:
/*!*************************************************************************************************!*\
  !*** J:/kesionEDU_APP/KS_EDU_APP/客户小程序/首冠小程序定制/lib/polyv/common/regenerator-runtime/runtime.js ***!
  \*************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
/* WEBPACK VAR INJECTION */(function(global, process) {!function (t) {"use strict";var r,e = Object.prototype,n = e.hasOwnProperty,o = "function" == typeof Symbol ? Symbol : {},i = o.iterator || "@@iterator",a = o.toStringTag || "@@toStringTag",c = "object" == typeof module,u = t.regeneratorRuntime;if (u) c && (module.exports = u);else {(u = t.regeneratorRuntime = c ? module.exports : {}).wrap = m;var h = "suspendedStart",s = "suspendedYield",f = "executing",l = "completed",p = {},y = {};y[i] = function () {return this;};var v = Object.getPrototypeOf,d = v && v(v(N([])));d && d !== e && n.call(d, i) && (y = d);var g = b.prototype = L.prototype = Object.create(y);x.prototype = g.constructor = b, b.constructor = x, b[a] = x.displayName = "GeneratorFunction", u.isGeneratorFunction = function (t) {var r = "function" == typeof t && t.constructor;return !!r && (r === x || "GeneratorFunction" === (r.displayName || r.name));}, u.mark = function (t) {return Object.setPrototypeOf ? Object.setPrototypeOf(t, b) : (t.__proto__ = b, a in t || (t[a] = "GeneratorFunction")), t.prototype = Object.create(g), t;}, u.awrap = function (t) {return { __await: t };}, E(j.prototype), u.AsyncIterator = j, u.async = function (t, r, e, n) {var o = new j(m(t, r, e, n));return u.isGeneratorFunction(r) ? o : o.next().then(function (t) {return t.done ? t.value : o.next();});}, E(g), g[a] = "Generator", g.toString = function () {return "[object Generator]";}, u.keys = function (t) {var r = [];for (var e in t) {r.push(e);}return r.reverse(), function e() {for (; r.length;) {var n = r.pop();if (n in t) return e.value = n, e.done = !1, e;}return e.done = !0, e;};}, u.values = N, G.prototype = { constructor: G, reset: function reset(t) {if (this.prev = 0, this.next = 0, this.sent = this._sent = r, this.done = !1, this.delegate = null, this.method = "next", this.arg = r, this.tryEntries.forEach(k), !t) for (var e in this) {"t" === e.charAt(0) && n.call(this, e) && !isNaN(+e.slice(1)) && (this[e] = r);}}, stop: function stop() {this.done = !0;var t = this.tryEntries[0].completion;if ("throw" === t.type) throw t.arg;return this.rval;}, dispatchException: function dispatchException(t) {if (this.done) throw t;var e = this;function o(n, o) {return c.type = "throw", c.arg = t, e.next = n, o && (e.method = "next", e.arg = r), !!o;}for (var i = this.tryEntries.length - 1; i >= 0; --i) {var a = this.tryEntries[i],c = a.completion;if ("root" === a.tryLoc) return o("end");if (a.tryLoc <= this.prev) {var u = n.call(a, "catchLoc"),h = n.call(a, "finallyLoc");if (u && h) {if (this.prev < a.catchLoc) return o(a.catchLoc, !0);if (this.prev < a.finallyLoc) return o(a.finallyLoc);} else if (u) {if (this.prev < a.catchLoc) return o(a.catchLoc, !0);} else {if (!h) throw new Error("try statement without catch or finally");if (this.prev < a.finallyLoc) return o(a.finallyLoc);}}}}, abrupt: function abrupt(t, r) {for (var e = this.tryEntries.length - 1; e >= 0; --e) {var o = this.tryEntries[e];if (o.tryLoc <= this.prev && n.call(o, "finallyLoc") && this.prev < o.finallyLoc) {var i = o;break;}}i && ("break" === t || "continue" === t) && i.tryLoc <= r && r <= i.finallyLoc && (i = null);var a = i ? i.completion : {};return a.type = t, a.arg = r, i ? (this.method = "next", this.next = i.finallyLoc, p) : this.complete(a);}, complete: function complete(t, r) {if ("throw" === t.type) throw t.arg;return "break" === t.type || "continue" === t.type ? this.next = t.arg : "return" === t.type ? (this.rval = this.arg = t.arg, this.method = "return", this.next = "end") : "normal" === t.type && r && (this.next = r), p;}, finish: function finish(t) {for (var r = this.tryEntries.length - 1; r >= 0; --r) {var e = this.tryEntries[r];if (e.finallyLoc === t) return this.complete(e.completion, e.afterLoc), k(e), p;}}, catch: function _catch(t) {for (var r = this.tryEntries.length - 1; r >= 0; --r) {var e = this.tryEntries[r];if (e.tryLoc === t) {var n = e.completion;if ("throw" === n.type) {var o = n.arg;k(e);}return o;}}throw new Error("illegal catch attempt");}, delegateYield: function delegateYield(t, e, n) {return this.delegate = { iterator: N(t), resultName: e, nextLoc: n }, "next" === this.method && (this.arg = r), p;} };}function m(t, r, e, n) {var o = r && r.prototype instanceof L ? r : L,i = Object.create(o.prototype),a = new G(n || []);return i._invoke = function (t, r, e) {var n = h;return function (o, i) {if (n === f) throw new Error("Generator is already running");if (n === l) {if ("throw" === o) throw i;return P();}for (e.method = o, e.arg = i;;) {var a = e.delegate;if (a) {var c = _(a, e);if (c) {if (c === p) continue;return c;}}if ("next" === e.method) e.sent = e._sent = e.arg;else if ("throw" === e.method) {if (n === h) throw n = l, e.arg;e.dispatchException(e.arg);} else "return" === e.method && e.abrupt("return", e.arg);n = f;var u = w(t, r, e);if ("normal" === u.type) {if (n = e.done ? l : s, u.arg === p) continue;return { value: u.arg, done: e.done };}"throw" === u.type && (n = l, e.method = "throw", e.arg = u.arg);}};}(t, e, a), i;}function w(t, r, e) {try {return { type: "normal", arg: t.call(r, e) };} catch (t) {return { type: "throw", arg: t };}}function L() {}function x() {}function b() {}function E(t) {["next", "throw", "return"].forEach(function (r) {t[r] = function (t) {return this._invoke(r, t);};});}function j(t) {function r(e, o, i, a) {var c = w(t[e], t, o);if ("throw" !== c.type) {var u = c.arg,h = u.value;return h && "object" == typeof h && n.call(h, "__await") ? Promise.resolve(h.__await).then(function (t) {r("next", t, i, a);}, function (t) {r("throw", t, i, a);}) : Promise.resolve(h).then(function (t) {u.value = t, i(u);}, a);}a(c.arg);}var e;"object" == typeof process && process.domain && (r = process.domain.bind(r)), this._invoke = function (t, n) {function o() {return new Promise(function (e, o) {r(t, n, e, o);});}return e = e ? e.then(o, o) : o();};}function _(t, e) {var n = t.iterator[e.method];if (n === r) {if (e.delegate = null, "throw" === e.method) {if (t.iterator.return && (e.method = "return", e.arg = r, _(t, e), "throw" === e.method)) return p;e.method = "throw", e.arg = new TypeError("The iterator does not provide a 'throw' method");}return p;}var o = w(n, t.iterator, e.arg);if ("throw" === o.type) return e.method = "throw", e.arg = o.arg, e.delegate = null, p;var i = o.arg;return i ? i.done ? (e[t.resultName] = i.value, e.next = t.nextLoc, "return" !== e.method && (e.method = "next", e.arg = r), e.delegate = null, p) : i : (e.method = "throw", e.arg = new TypeError("iterator result is not an object"), e.delegate = null, p);}function O(t) {var r = { tryLoc: t[0] };1 in t && (r.catchLoc = t[1]), 2 in t && (r.finallyLoc = t[2], r.afterLoc = t[3]), this.tryEntries.push(r);}function k(t) {var r = t.completion || {};r.type = "normal", delete r.arg, t.completion = r;}function G(t) {this.tryEntries = [{ tryLoc: "root" }], t.forEach(O, this), this.reset(!0);}function N(t) {if (t) {var e = t[i];if (e) return e.call(t);if ("function" == typeof t.next) return t;if (!isNaN(t.length)) {var o = -1,a = function e() {for (; ++o < t.length;) {if (n.call(t, o)) return e.value = t[o], e.done = !1, e;}return e.value = r, e.done = !0, e;};return a.next = a;}}return { next: P };}function P() {return { value: r, done: !0 };}}("object" == typeof global ? global : "object" == typeof window ? window : "object" == typeof self ? self : void 0);
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! ./../../../../../../../../软件/HBuilderX.1.9.4.20190426/HBuilderX/plugins/uniapp-cli/node_modules/webpack/buildin/global.js */ 3), __webpack_require__(/*! ./../../../../../../../../软件/HBuilderX.1.9.4.20190426/HBuilderX/plugins/uniapp-cli/node_modules/node-libs-browser/mock/process.js */ 25)))

/***/ }),

/***/ 25:
/*!********************************************************!*\
  !*** ./node_modules/node-libs-browser/mock/process.js ***!
  \********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports.nextTick = function nextTick(fn) {
	setTimeout(fn, 0);
};

exports.platform = exports.arch = 
exports.execPath = exports.title = 'browser';
exports.pid = 1;
exports.browser = true;
exports.env = {};
exports.argv = [];

exports.binding = function (name) {
	throw new Error('No such module. (Possibly not yet loaded)')
};

(function () {
    var cwd = '/';
    var path;
    exports.cwd = function () { return cwd };
    exports.chdir = function (dir) {
        if (!path) path = __webpack_require__(/*! path */ 26);
        cwd = path.resolve(dir, cwd);
    };
})();

exports.exit = exports.kill = 
exports.umask = exports.dlopen = 
exports.uptime = exports.memoryUsage = 
exports.uvCounters = function() {};
exports.features = {};


/***/ }),

/***/ 26:
/*!***********************************************!*\
  !*** ./node_modules/path-browserify/index.js ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function(process) {// Copyright Joyent, Inc. and other Node contributors.
//
// Permission is hereby granted, free of charge, to any person obtaining a
// copy of this software and associated documentation files (the
// "Software"), to deal in the Software without restriction, including
// without limitation the rights to use, copy, modify, merge, publish,
// distribute, sublicense, and/or sell copies of the Software, and to permit
// persons to whom the Software is furnished to do so, subject to the
// following conditions:
//
// The above copyright notice and this permission notice shall be included
// in all copies or substantial portions of the Software.
//
// THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS
// OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
// MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN
// NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM,
// DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR
// OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE
// USE OR OTHER DEALINGS IN THE SOFTWARE.

// resolves . and .. elements in a path array with directory names there
// must be no slashes, empty elements, or device names (c:\) in the array
// (so also no leading and trailing slashes - it does not distinguish
// relative and absolute paths)
function normalizeArray(parts, allowAboveRoot) {
  // if the path tries to go above the root, `up` ends up > 0
  var up = 0;
  for (var i = parts.length - 1; i >= 0; i--) {
    var last = parts[i];
    if (last === '.') {
      parts.splice(i, 1);
    } else if (last === '..') {
      parts.splice(i, 1);
      up++;
    } else if (up) {
      parts.splice(i, 1);
      up--;
    }
  }

  // if the path is allowed to go above the root, restore leading ..s
  if (allowAboveRoot) {
    for (; up--; up) {
      parts.unshift('..');
    }
  }

  return parts;
}

// Split a filename into [root, dir, basename, ext], unix version
// 'root' is just a slash, or nothing.
var splitPathRe =
    /^(\/?|)([\s\S]*?)((?:\.{1,2}|[^\/]+?|)(\.[^.\/]*|))(?:[\/]*)$/;
var splitPath = function(filename) {
  return splitPathRe.exec(filename).slice(1);
};

// path.resolve([from ...], to)
// posix version
exports.resolve = function() {
  var resolvedPath = '',
      resolvedAbsolute = false;

  for (var i = arguments.length - 1; i >= -1 && !resolvedAbsolute; i--) {
    var path = (i >= 0) ? arguments[i] : process.cwd();

    // Skip empty and invalid entries
    if (typeof path !== 'string') {
      throw new TypeError('Arguments to path.resolve must be strings');
    } else if (!path) {
      continue;
    }

    resolvedPath = path + '/' + resolvedPath;
    resolvedAbsolute = path.charAt(0) === '/';
  }

  // At this point the path should be resolved to a full absolute path, but
  // handle relative paths to be safe (might happen when process.cwd() fails)

  // Normalize the path
  resolvedPath = normalizeArray(filter(resolvedPath.split('/'), function(p) {
    return !!p;
  }), !resolvedAbsolute).join('/');

  return ((resolvedAbsolute ? '/' : '') + resolvedPath) || '.';
};

// path.normalize(path)
// posix version
exports.normalize = function(path) {
  var isAbsolute = exports.isAbsolute(path),
      trailingSlash = substr(path, -1) === '/';

  // Normalize the path
  path = normalizeArray(filter(path.split('/'), function(p) {
    return !!p;
  }), !isAbsolute).join('/');

  if (!path && !isAbsolute) {
    path = '.';
  }
  if (path && trailingSlash) {
    path += '/';
  }

  return (isAbsolute ? '/' : '') + path;
};

// posix version
exports.isAbsolute = function(path) {
  return path.charAt(0) === '/';
};

// posix version
exports.join = function() {
  var paths = Array.prototype.slice.call(arguments, 0);
  return exports.normalize(filter(paths, function(p, index) {
    if (typeof p !== 'string') {
      throw new TypeError('Arguments to path.join must be strings');
    }
    return p;
  }).join('/'));
};


// path.relative(from, to)
// posix version
exports.relative = function(from, to) {
  from = exports.resolve(from).substr(1);
  to = exports.resolve(to).substr(1);

  function trim(arr) {
    var start = 0;
    for (; start < arr.length; start++) {
      if (arr[start] !== '') break;
    }

    var end = arr.length - 1;
    for (; end >= 0; end--) {
      if (arr[end] !== '') break;
    }

    if (start > end) return [];
    return arr.slice(start, end - start + 1);
  }

  var fromParts = trim(from.split('/'));
  var toParts = trim(to.split('/'));

  var length = Math.min(fromParts.length, toParts.length);
  var samePartsLength = length;
  for (var i = 0; i < length; i++) {
    if (fromParts[i] !== toParts[i]) {
      samePartsLength = i;
      break;
    }
  }

  var outputParts = [];
  for (var i = samePartsLength; i < fromParts.length; i++) {
    outputParts.push('..');
  }

  outputParts = outputParts.concat(toParts.slice(samePartsLength));

  return outputParts.join('/');
};

exports.sep = '/';
exports.delimiter = ':';

exports.dirname = function(path) {
  var result = splitPath(path),
      root = result[0],
      dir = result[1];

  if (!root && !dir) {
    // No dirname whatsoever
    return '.';
  }

  if (dir) {
    // It has a dirname, strip trailing slash
    dir = dir.substr(0, dir.length - 1);
  }

  return root + dir;
};


exports.basename = function(path, ext) {
  var f = splitPath(path)[2];
  // TODO: make this comparison case-insensitive on windows?
  if (ext && f.substr(-1 * ext.length) === ext) {
    f = f.substr(0, f.length - ext.length);
  }
  return f;
};


exports.extname = function(path) {
  return splitPath(path)[3];
};

function filter (xs, f) {
    if (xs.filter) return xs.filter(f);
    var res = [];
    for (var i = 0; i < xs.length; i++) {
        if (f(xs[i], i, xs)) res.push(xs[i]);
    }
    return res;
}

// String.prototype.substr - negative index don't work in IE8
var substr = 'ab'.substr(-1) === 'b'
    ? function (str, start, len) { return str.substr(start, len) }
    : function (str, start, len) {
        if (start < 0) start = str.length + start;
        return str.substr(start, len);
    }
;

/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! ./../node-libs-browser/mock/process.js */ 25)))

/***/ }),

/***/ 27:
/*!*******************************************************************************!*\
  !*** J:/kesionEDU_APP/KS_EDU_APP/客户小程序/首冠小程序定制/lib/polyv/common/chat/chat.js ***!
  \*******************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
Object.defineProperty(exports, "__esModule", { value: true });exports.default = void 0;var _events = _interopRequireDefault(__webpack_require__(/*! ./events */ 28));var _md = _interopRequireDefault(__webpack_require__(/*! ../utils/md5 */ 29));var _weappSocket = _interopRequireDefault(__webpack_require__(/*! ../utils/weapp.socket.io */ 30));var _eventTypes = _interopRequireDefault(__webpack_require__(/*! ./eventTypes */ 31));var _emotionList = _interopRequireDefault(__webpack_require__(/*! ./emotionList */ 32));var _api = _interopRequireDefault(__webpack_require__(/*! ./api */ 33));var _config = __webpack_require__(/*! ../utils/config */ 38);var _roomEvents;function _interopRequireDefault(obj) {return obj && obj.__esModule ? obj : { default: obj };}function _classCallCheck(instance, Constructor) {if (!(instance instanceof Constructor)) {throw new TypeError("Cannot call a class as a function");}}function _defineProperties(target, props) {for (var i = 0; i < props.length; i++) {var descriptor = props[i];descriptor.enumerable = descriptor.enumerable || false;descriptor.configurable = true;if ("value" in descriptor) descriptor.writable = true;Object.defineProperty(target, descriptor.key, descriptor);}}function _createClass(Constructor, protoProps, staticProps) {if (protoProps) _defineProperties(Constructor.prototype, protoProps);if (staticProps) _defineProperties(Constructor, staticProps);return Constructor;}function _defineProperty(obj, key, value) {if (key in obj) {Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true });} else {obj[key] = value;}return obj;}var socketHost = _config.URL.socketHost,roomEvents = (_roomEvents = {}, _defineProperty(_roomEvents, _eventTypes.default.KICK_USER, function (e, t) {t.user.userId == this.options.userId && (this.trigger(_eventTypes.default.BAN_USER_ROOM), this.disconnectSocket());}), _defineProperty(_roomEvents, _eventTypes.default.LOGIN_KICK, function (e, t) {this.trigger(_eventTypes.default.BAN_USER_ROOM), this.disconnectSocket();}), _defineProperty(_roomEvents, _eventTypes.default.LOGIN, function (e, t) {var s = this.addUserlist([t.user]);s.length > 0 && this.trigger(_eventTypes.default.UPDATEUSER, "add", s, !0);}), _defineProperty(_roomEvents, _eventTypes.default.LOGOUT, function (e, t) {var s = this.removeUser(t.uid);s && this.trigger(_eventTypes.default.UPDATEUSER, "remove", s);}), _defineProperty(_roomEvents, _eventTypes.default.CONNECT, function (e, t) {var _this = this;this.options.isMobile || this.getOnlineUserList().then(function (e) {_this.getQuestionHistoryMessage();var t = _this.addUserlist(e.data.data.userlist);t.length > 0 && _this.trigger(_eventTypes.default.UPDATEUSER, "add", t);});}), _defineProperty(_roomEvents, _eventTypes.default.MICROPHONE, function (e, t) {"open" !== this.status && this.clearChannelClock();}), _defineProperty(_roomEvents, _eventTypes.default.ONLINE_TEACHERINFO, function (e, t) {this.teacherData = t.data, this.hasClient = !0, console.log(this.teacherData);}), _defineProperty(_roomEvents, _eventTypes.default.SET_NICK, function (e, t) {"error" !== t.status && t.userId === this.userId && (this.options.userName = this.options.nick = t.nick, _api.default.setNickname(this.options.roomId, t.nick));}), _defineProperty(_roomEvents, _eventTypes.default.SLICEID, function (e, t) {this.options.session_id = t.data.sessionId;}), _defineProperty(_roomEvents, _eventTypes.default.SET_MANAGER_INFO, function (e, t) {}), _roomEvents);var Chat = /*#__PURE__*/function () {_createClass(Chat, [{ key: "suppotSocket", value: function suppotSocket() {return !0;} }, { key: "hasMoreHistory", value: function hasMoreHistory() {return this._hasMoreHistory;} }, { key: "userlist", value: function userlist() {return this._user.list;} }, { key: "addUserlist", value: function addUserlist(e) {var _this2 = this;var t = this._user,s = this._teacher,i = [];return e.forEach(function (e) {var r = e.userType;if ("teacher" !== e.userType || "chatroom" !== e.userSource) return "manager" === r || "teacher" === r || "assistant" === r ? ("teacher" === r && (_this2.hasClient = !0, _this2.teacherData = e), void (-1 === s.userId.indexOf(e.userId) && (s.list.push(e), s.id.push(e.uid), s.userId.push(e.userId), i.push(e)))) : void (-1 === t.userId.indexOf(e.userId) && (t.list.push(e), t.id.push(e.uid), t.ip.push(e.clientIp), t.userId.push(e.userId), i.push(e)));}), i;} }, { key: "removeUser", value: function removeUser(e) {var t = this._user,s = this._teacher,i = s.id.indexOf(e);if (-1 !== i) return "teacher" === s.list[i].userType && (this.hasClient = !1), s.id.splice(i, 1), s.userId.splice(i, 1), s.list.splice(i, 1);var r = t.id.indexOf(e);return -1 !== r ? (t.id.splice(r, 1), t.userId.splice(r, 1), t.list.splice(r, 1)) : void 0;} }], [{ key: "parseString", value: function parseString(e) {return e ? e.replace(/</g, "&lt;").replace(/>/g, "&gt;").trim() : "";} }, { key: "FormatTime", value: function FormatTime(e) {var t = function t(e) {return e < 10 ? "0".concat(e) : e;},s = new Date(e / 1);return "".concat(s.getFullYear(), "-").concat(t(s.getMonth() + 1), "-").concat(t(s.getDate()), " ").concat(t(s.getHours()), ":").concat(t(s.getMinutes()));} }, { key: "FormatEmotions", value: function FormatEmotions(e) {if (!e) return "";var t = e.indexOf("[");var _loop = function _loop() {var s = e.indexOf("]", t + 1);if (-1 === s) return "break";var i = e.substring(0, t),r = e.substring(s + 1);var n = e.substring(t + 1, s);if (n) {var _e = _emotionList.default.filter(function (e) {return e.title === n;}),_t = _e.length > 0 ? _e[0].url : "";_t && (n = "<img src=\"".concat(_t, "\">"));}t = (e = i + n + r).indexOf("[");};for (; t > -1;) {var _ret = _loop();if (_ret === "break") break;}return e;} }, { key: "setCookie", value: function setCookie(e, t, s) {var i = new Date().getTime() + 24 * s * 60 * 60 * 1e3;wx.setStorage({ key: "".concat(e).concat(t), data: i });} }, { key: "getCookie", value: function getCookie(e) {return wx.getStorageSync(e);} }, { key: "getUid", value: function getUid(e) {return parseInt(e / 1 % Math.pow(2, 32)) + "";} }, { key: "getSign", value: function getSign(e) {return (0, _md.default)("polyv_room_sign".concat(e));} }]);function Chat(e) {_classCallCheck(this, Chat);this.options = Object.assign({}, e), this.options.nick = e.userName, this.userId = e.userId, this.options.roomId = e.roomId || e.roomName, this.options.sign = e.sign || Chat.getSign(this.options.roomId), this.options.roomIds = e.roomIds, this.teacherData = {}, this.historyCount = 0, this._hasMoreHistory = !1, this.roomClosed = !1, this._hasHistoryMessage = !1, this.joinChannelClock = null, this.connectDelayNumber = [2e3, 3e3, 4e3, 5e3], this._user = { list: [], id: [], userId: [], ip: [] }, this._teacher = { list: [], id: [], userId: [] }, this.lastSpeakTime = 0, this.lastAskTime = 0, this.hasClient = "live" === e.liveStatus;var t = this;var s = new _events.default();s.trigger = function (e) {for (var _len = arguments.length, i = new Array(_len > 1 ? _len - 1 : 0), _key = 1; _key < _len; _key++) {i[_key - 1] = arguments[_key];}return s.emit.apply(s, [e, e].concat(i)), t;}, s.off = function (e) {for (var _len2 = arguments.length, i = new Array(_len2 > 1 ? _len2 - 1 : 0), _key2 = 1; _key2 < _len2; _key2++) {i[_key2 - 1] = arguments[_key2];}return s.removeListener.apply(s, [e].concat(i)), t;}, this.on = function (e, i) {return s.on(e, i), t;}, this.off = s.off.bind(s), this.trigger = s.trigger.bind(s), this.events = _eventTypes.default;for (var _e2 in roomEvents) {roomEvents.hasOwnProperty(_e2) && this.on(_e2, roomEvents[_e2].bind(this));}}_createClass(Chat, [{ key: "checkBanRoom", value: function checkBanRoom() {var e = "ban_user_room".concat(this.options.roomName),t = Chat.getCookie(e);return !!t && (t > new Date().getTime() || (wx.removeStorageSync(e), !1));} }, { key: "getIsKicked", value: function getIsKicked() {return _api.default.getIsKicked(this.options.roomId, this.userId).then(function (e) {if (200 === e.data.code) return !0;throw e.data;});} }, { key: "setup", value: function setup() {var _this3 = this;var e = !1;this.socket = this.connectSocket();var t = this.overtimeConnect(30);this.socket.on("connect", function () {clearTimeout(t), _this3.trigger(_eventTypes.default.CONNECT).login(), e || (_this3.receiveMessage().receiveClassMessage().receiveJoinResponseMessage().receiveJoinSuccessMessage().socketEvent(), e = !0);});} }, { key: "overtimeConnect", value: function overtimeConnect() {var _this4 = this;var e = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 30;return setTimeout(function () {_this4.trigger(_eventTypes.default.OVERTIMECONNECT);}, 1e3 * e);} }, { key: "login", value: function login() {var e = this.options;return this.socket.emit("message", JSON.stringify({ EVENT: "LOGIN", values: [e.userName, e.pic, e.userId], roomId: e.roomId, type: e.userType })), this._createHeartbeat(), this;} }, { key: "_createHeartbeat", value: function _createHeartbeat() {var _this5 = this;this.heartbeatInterval && clearInterval(this.heartbeatInterval), this.heartbeatInterval = setInterval(function () {var e = _this5.options;_this5.socket.emit("message", JSON.stringify({ EVENT: "HEARTBEAT", uid: e.userId }));}, 25e3);} }, { key: "receiveClassMessage", value: function receiveClassMessage() {var _this6 = this;return this.socket.on("class", function (e) {var t = JSON.parse(e);if (t && t.EVENT) {var _e3;switch (t.EVENT) {case "onClassStart":_e3 = _eventTypes.default.CLASSSTART;break;case "onClassEnd":_e3 = _eventTypes.default.CLASSEND;break;case "onClassControl":_e3 = _eventTypes.default.CLASSCONTROL;}if (!_e3) return;if (_e3 === _eventTypes.default.CLASSCONTROL) {_this6.trigger(_e3, t);var s = t.type;return "muteAllAudio" === s ? _e3 = _eventTypes.default.MUTEALLAUDIO : "muteAllVideo" === s ? _e3 = _eventTypes.default.MUTEALLVIDEO : "muteUserAudio" === s ? _e3 = _eventTypes.default.MUTEUSERAUDIO : "muteUserVideo" === s && (_e3 = _eventTypes.default.MUTEUSERVIDEO), t.EVENT = _e3, delete t.type, void _this6.trigger(_e3, t);}t.EVENT = _e3, _this6.trigger(_eventTypes.default.ALLOW_MICROPHONE, t);}}), this;} }, { key: "receiveJoinResponseMessage", value: function receiveJoinResponseMessage() {var _this7 = this;return this.socket.on("joinResponse", function (e) {var t = JSON.parse(e);t && (t.EVENT = _eventTypes.default.ALLOW_MICROPHONE, _this7.trigger(_eventTypes.default.ALLOW_MICROPHONE, t));}), this;} }, { key: "receiveJoinSuccessMessage", value: function receiveJoinSuccessMessage() {var _this8 = this;return this.socket.on("joinSuccess", function (e) {var t = JSON.parse(e);t && (t.EVENT = _eventTypes.default.SUCCESS_MICROPHONE, _this8.trigger(_eventTypes.default.SUCCESS_MICROPHONE, t));}), this;} }, { key: "receiveMessage", value: function receiveMessage() {var _this9 = this;return this.socket.on("message", function (e) {var t;try {t = JSON.parse(e);} catch (e) {console.error(e);}if (t && t.EVENT) {var _e4;switch (t.EVENT) {case "CLOSEROOM":_this9.roomClosed = t.value.closed, _e4 = t.value.closed ? _eventTypes.default.CLOSE_ROOM : _eventTypes.default.OPEN_ROOM;break;case "GONGGAO":_e4 = _eventTypes.default.SYSTEM_ANNOUNCEMENT;break;case "SPEAK":switch (t.status) {case "error":_e4 = _eventTypes.default.SPEAK_ERROR;break;case "censor":_e4 = _eventTypes.default.SPEAK_CENSOR;break;default:_e4 = _eventTypes.default.SPEAK;}break;case "REWARD":_e4 = _eventTypes.default.REWARD;break;case "QUESTION":_e4 = _eventTypes.default.QUESTION;break;case "CLOSE_QUESTION":_e4 = _eventTypes.default.CLOSE_QUESTION;break;case "ANSWER":_e4 = _eventTypes.default.ANSWER;break;case "CUSTOMER_MESSAGE":_e4 = _eventTypes.default.CUSTOMER_MESSAGE;break;case "ERROR":_e4 = _eventTypes.default.SERVER_ERROR;break;case "KICK":_e4 = _eventTypes.default.KICK_USER;break;case "LOGIN_KICK":_e4 = _eventTypes.default.LOGIN_KICK;break;case "REMOVE_HISTORY":_e4 = _eventTypes.default.REMOVE_HISTORY;break;case "REMOVE_CONTENT":_e4 = _eventTypes.default.REMOVE_CONTENT;break;case "CLOSE_DANMU":_e4 = _eventTypes.default.CLOSE_DANMU;break;case "LOGIN":_e4 = _eventTypes.default.LOGIN;break;case "LOGOUT":_e4 = _eventTypes.default.LOGOUT;break;case "onSliceID":_e4 = _eventTypes.default.SLICEID;break;case "onSliceStart":_e4 = _eventTypes.default.SLICESTART;break;case "onSliceControl":_e4 = _eventTypes.default.SLICECONTROL;break;case "onSliceDraw":_e4 = _eventTypes.default.SLICEDRAW;break;case "onSliceOpen":_e4 = _eventTypes.default.SLICEDOPEN;break;case "S_QUESTION":_e4 = _eventTypes.default.S_QUESTION;break;case "T_ANSWER":_e4 = _eventTypes.default.T_ANSWER;break;case "BULLETIN":_e4 = _eventTypes.default.BULLETIN;break;case "REMOVE_BULLETIN":_e4 = _eventTypes.default.REMOVE_BULLETIN;break;case "FLOWERS":_e4 = _eventTypes.default.FLOWERS;break;case "REDPAPER":_e4 = _eventTypes.default.REDPAPER;break;case "SIGN_IN":_e4 = _eventTypes.default.SIGN_IN;break;case "STOP_SIGN_IN":_e4 = _eventTypes.default.STOP_SIGN_IN;break;case "LIKES":_e4 = _eventTypes.default.LIKES;break;case "OPEN_MICROPHONE":_e4 = _eventTypes.default.MICROPHONE;break;case "SET_NICK":_e4 = _eventTypes.default.SET_NICK;break;case "O_TEACHER_INFO":_e4 = _eventTypes.default.ONLINE_TEACHERINFO;break;case "SET_MANAGER_INFO":_e4 = _eventTypes.default.SET_MANAGER_INFO;break;case "GET_TEST_QUESTION_CONTENT":_e4 = _eventTypes.default.GET_TEST_QUESTION_CONTENT;break;case "GET_TEST_QUESTION_RESULT":_e4 = _eventTypes.default.GET_TEST_QUESTION_RESULT;break;case "STOP_TEST_QUESTION":_e4 = _eventTypes.default.STOP_TEST_QUESTION;break;case "SYSTEM_MESSAGE":_e4 = _eventTypes.default.SYSTEM_MESSAGE;break;case "CHAT_IMG":_e4 = _eventTypes.default.CHAT_IMG;}if (!_e4) return;if (t.EVENT = _e4, _e4 === _eventTypes.default.S_QUESTION) {if (t.user.userId !== _this9.userId) return;t.user.nick || (t.user.nick = t.user.userName), _this9.lastAskTime = new Date().getTime(), t = _this9.parseData([t])[0];}if (_e4 === _eventTypes.default.T_ANSWER && t.s_userId !== _this9.userId) return;_e4 === _eventTypes.default.SPEAK && (t.content = t.values[0], delete t.values, t = _this9.parseData([t])[0]), _e4 === _eventTypes.default.SPEAK_ERROR && (t = _this9.parseData([t])[0]), _e4 === _eventTypes.default.FLOWERS && (t.flowers = !0), _e4 === _eventTypes.default.REWARD && (t.reward = !0), _e4 === _eventTypes.default.CUSTOMER_MESSAGE && (t.customerMessage = !0), _this9.trigger(_e4, t);}}), this;} }, { key: "socketEvent", value: function socketEvent() {var _this10 = this;return this.socket.on("disconnect", function () {_this10.trigger(_eventTypes.default.DISCONNECT);}), this.socket.on("error", function () {_this10.trigger(_eventTypes.default.ERROR);}), this.socket.on("reconnect", function (e) {_this10.trigger(_eventTypes.default.RECONNECT);}), this.socket.on("reconnect_attempt", function (e) {_this10.trigger(_eventTypes.default.RECONNECT_ATTEMPT);}), this;} }, { key: "connectSocket", value: function connectSocket() {return (0, _weappSocket.default)(socketHost, { query: { token: this.options.chatToken }, transports: [this.suppotSocket() ? "websocket" : "polling"], reconnectionDelay: this.connectDelayNumber[Math.floor(4 * Math.random())], randomizationFactor: Math.random() });} }, { key: "send", value: function send(e) {if (!this.socket) return void this.trigger(_eventTypes.default.PROHIBIT_TO_SPEAK);if (this.roomClosed) return;if (new Date().getTime() - this.lastSpeakTime < 3e3) return void this.trigger(_eventTypes.default.SYSTEM_MESSAGE, { system: !0, content: "您的发言过快，请稍后再试" });var t = Chat.parseString(e),s = this.options,i = { EVENT: "SPEAK", values: [t], roomId: s.roomId };return this.socket.emit("message", JSON.stringify(i)), this.lastSpeakTime = new Date().getTime(), this.trigger(_eventTypes.default.SEND_MESSAGE, this.parseData([{ content: t, time: new Date().getTime(), mySelfSend: !0, id: Math.floor(1e7 * Math.random()), user: { nick: s.userName, pic: s.pic, userId: s.userId, roomId: s.roomId, channelId: s.roomName } }])[0]), this;} }, { key: "kick", value: function kick(e) {var t = this.options,s = { EVENT: "KICK", roomId: t.roomId, channelId: t.roomName, userId: e, sign: t.sign };this.socket.emit("message", JSON.stringify(s));} }, { key: "prohibitSpeak", value: function prohibitSpeak(e) {var t = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : !0;var s = this.options,i = { EVENT: !0 === t ? "SHIELD" : "REMOVE_SHIELD", roomId: s.roomId, channelId: s.roomName, sign: s.sign, value: e };this.socket.emit("message", JSON.stringify(i));var r = this._user,n = r.ip.indexOf(e);r.list[n] && (r.list[n].banned = !!t);} }, { key: "sendQuestion", value: function sendQuestion(e) {var t = this.options;if (new Date().getTime() - this.lastAskTime < 3e3) return void this.trigger(_eventTypes.default.SYSTEM_MESSAGE, { system: !0, content: "您的发言过快，请稍后再试" });var s = { EVENT: "S_QUESTION", roomId: t.roomId, content: e, user: { nick: t.nick, pic: t.pic, userId: t.userId, actor: t.actor ? t.actor : "学生", userType: "slice" === t.userType ? "student" : t.userType } };this.socket.emit("message", JSON.stringify(s));} }, { key: "sendAnnouncement", value: function sendAnnouncement(e) {var t = this.options,s = { EVENT: "BULLETIN", roomId: t.roomId, channelId: t.roomName, sign: t.sign, content: e };this.socket.emit("message", JSON.stringify(s));} }, { key: "deleteAnnouncement", value: function deleteAnnouncement() {var e = this.options,t = { EVENT: "REMOVE_BULLETIN", roomId: e.roomId, channelId: e.roomName, sign: e.sign };this.socket.emit("message", JSON.stringify(t));} }, { key: "sendLike", value: function sendLike(e) {var t = this.options,s = { EVENT: "LIKES", roomId: t.roomId, channelId: t.roomName, nick: t.nick, count: e };this.socket.emit("message", JSON.stringify(s));} }, { key: "setNick", value: function setNick(e) {var t = this.options,s = { EVENT: "SET_NICK", roomId: t.roomId, channelId: t.roomName, nick: e, userId: t.userId };this.socket.emit("message", JSON.stringify(s));} }, { key: "toSign", value: function toSign(e) {var _this$options = this.options,t = _this$options.roomId,s = _this$options.userId,i = _this$options.nick;this.socket.emit("message", JSON.stringify({ EVENT: "TO_SIGN_IN", roomId: t, checkinId: e, user: { userId: s, nick: i } }));} }, { key: "sendSign", value: function sendSign(e, t) {var s = { EVENT: "SIGN_IN", roomId: this.options.roomId, data: { message: e, limitTime: t } };this.socket.emit("message", JSON.stringify(s));} }, { key: "endSign", value: function endSign() {var e = { EVENT: "STOP_SIGN_IN", roomId: this.options.roomId };this.socket.emit("message", JSON.stringify(e));} }, { key: "sendAnswer", value: function sendAnswer(e, t) {var s = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : function () {};var i = this.options,r = { EVENT: "ANSWER_TEST_QUESTION", roomId: i.roomId, nick: i.nick, userId: i.userId, option: e, questionId: t };this.socket.emit("message", JSON.stringify(r), s);} }, { key: "joinChannel", value: function joinChannel() {var _this11 = this;var e = this.options,t = { user: { nick: e.nick, pic: e.pic, userId: Chat.getUid(e.micUserId), userType: e.userType, sessionId: e.session_id }, roomId: e.roomId, sessionId: e.session_id };this.clearChannelClock(), this.socket.emit("joinRequest", JSON.stringify(t), function (e, t, s) {_this11.clearChannelClock();}), this.joinChannelClock = setTimeout(function () {_this11.trigger(_eventTypes.default.JOIN_CHANNEL_FAIL);}, 2e4);} }, { key: "clearChannelClock", value: function clearChannelClock() {clearTimeout(this.joinChannelClock);} }, { key: "joinChannelSuccess", value: function joinChannelSuccess() {var e = this.options,t = { user: { nick: e.nick, pic: e.pic, userId: Chat.getUid(e.micUserId), userType: e.userType, sessionId: e.session_id }, roomId: e.roomId, sessionId: e.session_id };this.socket.emit("joinSuccess", JSON.stringify(t));} }, { key: "cancelJoinChannel", value: function cancelJoinChannel() {var e = this.options,t = { user: { nick: e.nick, pic: e.pic, userId: Chat.getUid(e.micUserId), userType: e.userType, sessionId: e.session_id }, roomId: e.roomId, sessionId: e.session_id };this.socket.emit("joinLeave", JSON.stringify(t));} }, { key: "disconnectSocket", value: function disconnectSocket() {return this.socket && this.socket.close(), this;} }, { key: "getActor", value: function getActor(e) {var t = "";return e.actor ? t = e.actor : "teacher" === e.userType ? t = "讲师" : "manager" === e.userType ? t = "管理员" : "assistant" === e.userType && (t = "助教"), t;} }, { key: "parseData", value: function parseData(e) {var _this12 = this;return e.map(function (e) {return e.user && (e.reward = "1" === e.user.uid, e.isCustomMsg = "2" === e.user.uid, e.currentUser = e.user.userId === _this12.options.userId, e.actor = _this12.getActor(e.user), e.user.pic = _this12.dealImgUrl(e.user.pic), e.reward && e.content.gimg && (e.content.gimg = _this12.dealImgUrl(e.content.gimg))), e.content = e.reward || "chatImg" === e.msgSource ? e.content : Chat.parseString(e.content), e.time && (e.formatTime = Chat.FormatTime(e.time)), e.system = e.system || "error" === e.status, e.system && (e.content = e.message), e;});} }, { key: "dealImgUrl", value: function dealImgUrl(e) {return e.replace(/^\/\//, "https://");} }, { key: "getOnlineUserList", value: function getOnlineUserList() {var e = this.options;return _api.default.getOnlineUserList(e.roomName);} }, { key: "getHistoryMessage", value: function getHistoryMessage() {var _this13 = this;var e = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 20;var t = arguments.length > 1 ? arguments[1] : undefined;var s = null == t ? this.historyCount : t,i = this.options;return _api.default.getHistoryMessage(i, s, e).then(function (t) {var i = t.data.data;_this13.historyCount += e, _this13._hasMoreHistory = 21 === i.length, _this13.trigger(_eventTypes.default.HISTORY_MESSAGE, _this13.parseData(i.reverse().slice(_this13._hasMoreHistory ? 1 : 0)), s, s + e);}), this;} }, { key: "getQuestionHistoryMessage", value: function getQuestionHistoryMessage() {var _this14 = this;_api.default.getQuestionHistoryMessage(this.options.roomName).then(function (e) {var t = e.data.data,s = _this14.userId;0 === t.filter(function (e) {return e.user && ("teacher" === e.user.userType || "assistant" === e.user.userType || "manager" === e.user.userType) && e.s_userId === s;}).length && t.unshift({ content: "同学，您好！请问有什么问题吗？", time: new Date().getTime(), s_userId: s, user: { actor: "讲师", clientIp: "", nick: "讲师", pic: "//livestatic.polyv.net/assets/images/teacher.png", userType: "teacher" } }), _this14.trigger(_eventTypes.default.UPDATE_QUESTION_HISTROY, _this14.parseData(t.filter(function (e) {return e.user && ("student" === e.user.userType && e.user.userId === s || "student" !== e.user.userType && e.s_userId === s);})));});} }, { key: "getCurrentSignRecord", value: function getCurrentSignRecord(e) {return _api.default.getCurrentSignRecord(e);} }, { key: "getHistorySignRecord", value: function getHistorySignRecord(e) {return _api.default.getHistorySignRecord(e);} }, { key: "getBannedList", value: function getBannedList() {return _api.default.getBannedList(this.options.roomId);} }, { key: "removeHistoryMessage", value: function removeHistoryMessage(e) {var t = this.options;_api.default.removeHistoryUrl(e, t);} }, { key: "cleanHistoryMessage", value: function cleanHistoryMessage() {var e = this.options,t = { EVENT: "REMOVE_HISTORY", roomId: e.roomId, sign: e.sign, subsidiaryRoom: e.roomIds };this.socket.emit("message", JSON.stringify(t));} }, { key: "checkCurrentStatus", value: function checkCurrentStatus() {return _api.default.checkCurrentStatus(this.options.roomId);} }, { key: "sendFlower", value: function sendFlower(e) {var t = this.options,s = { EVENT: "LIKES", roomId: t.roomId, nick: t.userName, count: e };this.socket.emit("message", JSON.stringify(s));} }]);return Chat;}();Chat.events = _eventTypes.default;var _default = Chat;exports.default = _default;

/***/ }),

/***/ 278:
/*!**************************************************************!*\
  !*** J:/kesionEDU_APP/KS_EDU_APP/客户小程序/首冠小程序定制/api/other.js ***!
  \**************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
Object.defineProperty(exports, "__esModule", { value: true });exports.GetWebViewUrl = GetWebViewUrl;exports.About = About;var _mainEntrance = __webpack_require__(/*! ./main.entrance.js */ 18);

/*获取url*/
function GetWebViewUrl(params) {
  return (0, _mainEntrance.POST)('/webapi/other/GetInfo', params, ['appToken']);
}
/*关于我们*/
function About(params) {
  return (0, _mainEntrance.POST)('/webapi/other/About', params, ['appToken']);
}

/***/ }),

/***/ 28:
/*!*********************************************************************************!*\
  !*** J:/kesionEDU_APP/KS_EDU_APP/客户小程序/首冠小程序定制/lib/polyv/common/chat/events.js ***!
  \*********************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
var ReflectOwnKeys,R = "object" == typeof Reflect ? Reflect : null,ReflectApply = R && "function" == typeof R.apply ? R.apply : function (e, t, n) {return Function.prototype.apply.call(e, t, n);};function ProcessEmitWarning(e) {console && console.warn && console.warn(e);}ReflectOwnKeys = R && "function" == typeof R.ownKeys ? R.ownKeys : Object.getOwnPropertySymbols ? function (e) {return Object.getOwnPropertyNames(e).concat(Object.getOwnPropertySymbols(e));} : function (e) {return Object.getOwnPropertyNames(e);};var NumberIsNaN = Number.isNaN || function (e) {return e != e;};function EventEmitter() {EventEmitter.init.call(this);}module.exports = EventEmitter, EventEmitter.EventEmitter = EventEmitter, EventEmitter.prototype._events = void 0, EventEmitter.prototype._eventsCount = 0, EventEmitter.prototype._maxListeners = void 0;var defaultMaxListeners = 10;function $getMaxListeners(e) {return void 0 === e._maxListeners ? EventEmitter.defaultMaxListeners : e._maxListeners;}function _addListener(e, t, n, r) {var i, o, s;if ("function" != typeof n) throw new TypeError('The "listener" argument must be of type Function. Received type ' + typeof n);if (void 0 === (o = e._events) ? (o = e._events = Object.create(null), e._eventsCount = 0) : (void 0 !== o.newListener && (e.emit("newListener", t, n.listener ? n.listener : n), o = e._events), s = o[t]), void 0 === s) s = o[t] = n, ++e._eventsCount;else if ("function" == typeof s ? s = o[t] = r ? [n, s] : [s, n] : r ? s.unshift(n) : s.push(n), (i = $getMaxListeners(e)) > 0 && s.length > i && !s.warned) {s.warned = !0;var u = new Error("Possible EventEmitter memory leak detected. " + s.length + " " + String(t) + " listeners added. Use emitter.setMaxListeners() to increase limit");u.name = "MaxListenersExceededWarning", u.emitter = e, u.type = t, u.count = s.length, ProcessEmitWarning(u);}return e;}function onceWrapper() {for (var e = [], t = 0; t < arguments.length; t++) {e.push(arguments[t]);}this.fired || (this.target.removeListener(this.type, this.wrapFn), this.fired = !0, ReflectApply(this.listener, this.target, e));}function _onceWrap(e, t, n) {var r = { fired: !1, wrapFn: void 0, target: e, type: t, listener: n },i = onceWrapper.bind(r);return i.listener = n, r.wrapFn = i, i;}function _listeners(e, t, n) {var r = e._events;if (void 0 === r) return [];var i = r[t];return void 0 === i ? [] : "function" == typeof i ? n ? [i.listener || i] : [i] : n ? unwrapListeners(i) : arrayClone(i, i.length);}function listenerCount(e) {var t = this._events;if (void 0 !== t) {var n = t[e];if ("function" == typeof n) return 1;if (void 0 !== n) return n.length;}return 0;}function arrayClone(e, t) {for (var n = new Array(t), r = 0; r < t; ++r) {n[r] = e[r];}return n;}function spliceOne(e, t) {for (; t + 1 < e.length; t++) {e[t] = e[t + 1];}e.pop();}function unwrapListeners(e) {for (var t = new Array(e.length), n = 0; n < t.length; ++n) {t[n] = e[n].listener || e[n];}return t;}Object.defineProperty(EventEmitter, "defaultMaxListeners", { enumerable: !0, get: function get() {return defaultMaxListeners;}, set: function set(e) {if ("number" != typeof e || e < 0 || NumberIsNaN(e)) throw new RangeError('The value of "defaultMaxListeners" is out of range. It must be a non-negative number. Received ' + e + ".");defaultMaxListeners = e;} }), EventEmitter.init = function () {void 0 !== this._events && this._events !== Object.getPrototypeOf(this)._events || (this._events = Object.create(null), this._eventsCount = 0), this._maxListeners = this._maxListeners || void 0;}, EventEmitter.prototype.setMaxListeners = function (e) {if ("number" != typeof e || e < 0 || NumberIsNaN(e)) throw new RangeError('The value of "n" is out of range. It must be a non-negative number. Received ' + e + ".");return this._maxListeners = e, this;}, EventEmitter.prototype.getMaxListeners = function () {return $getMaxListeners(this);}, EventEmitter.prototype.emit = function (e) {for (var t = [], n = 1; n < arguments.length; n++) {t.push(arguments[n]);}var r = "error" === e,i = this._events;if (void 0 !== i) r = r && void 0 === i.error;else if (!r) return !1;if (r) {var o;if (t.length > 0 && (o = t[0]), o instanceof Error) throw o;var s = new Error("Unhandled error." + (o ? " (" + o.message + ")" : ""));throw s.context = o, s;}var u = i[e];if (void 0 === u) return !1;if ("function" == typeof u) ReflectApply(u, this, t);else {var f = u.length,v = arrayClone(u, f);for (n = 0; n < f; ++n) {ReflectApply(v[n], this, t);}}return !0;}, EventEmitter.prototype.addListener = function (e, t) {return _addListener(this, e, t, !1);}, EventEmitter.prototype.on = EventEmitter.prototype.addListener, EventEmitter.prototype.prependListener = function (e, t) {return _addListener(this, e, t, !0);}, EventEmitter.prototype.once = function (e, t) {if ("function" != typeof t) throw new TypeError('The "listener" argument must be of type Function. Received type ' + typeof t);return this.on(e, _onceWrap(this, e, t)), this;}, EventEmitter.prototype.prependOnceListener = function (e, t) {if ("function" != typeof t) throw new TypeError('The "listener" argument must be of type Function. Received type ' + typeof t);return this.prependListener(e, _onceWrap(this, e, t)), this;}, EventEmitter.prototype.removeListener = function (e, t) {var n, r, i, o, s;if ("function" != typeof t) throw new TypeError('The "listener" argument must be of type Function. Received type ' + typeof t);if (void 0 === (r = this._events)) return this;if (void 0 === (n = r[e])) return this;if (n === t || n.listener === t) 0 == --this._eventsCount ? this._events = Object.create(null) : (delete r[e], r.removeListener && this.emit("removeListener", e, n.listener || t));else if ("function" != typeof n) {for (i = -1, o = n.length - 1; o >= 0; o--) {if (n[o] === t || n[o].listener === t) {s = n[o].listener, i = o;break;}}if (i < 0) return this;0 === i ? n.shift() : spliceOne(n, i), 1 === n.length && (r[e] = n[0]), void 0 !== r.removeListener && this.emit("removeListener", e, s || t);}return this;}, EventEmitter.prototype.off = EventEmitter.prototype.removeListener, EventEmitter.prototype.removeAllListeners = function (e) {var t, n, r;if (void 0 === (n = this._events)) return this;if (void 0 === n.removeListener) return 0 === arguments.length ? (this._events = Object.create(null), this._eventsCount = 0) : void 0 !== n[e] && (0 == --this._eventsCount ? this._events = Object.create(null) : delete n[e]), this;if (0 === arguments.length) {var i,o = Object.keys(n);for (r = 0; r < o.length; ++r) {"removeListener" !== (i = o[r]) && this.removeAllListeners(i);}return this.removeAllListeners("removeListener"), this._events = Object.create(null), this._eventsCount = 0, this;}if ("function" == typeof (t = n[e])) this.removeListener(e, t);else if (void 0 !== t) for (r = t.length - 1; r >= 0; r--) {this.removeListener(e, t[r]);}return this;}, EventEmitter.prototype.listeners = function (e) {return _listeners(this, e, !0);}, EventEmitter.prototype.rawListeners = function (e) {return _listeners(this, e, !1);}, EventEmitter.listenerCount = function (e, t) {return "function" == typeof e.listenerCount ? e.listenerCount(t) : listenerCount.call(e, t);}, EventEmitter.prototype.listenerCount = listenerCount, EventEmitter.prototype.eventNames = function () {return this._eventsCount > 0 ? ReflectOwnKeys(this._events) : [];};

/***/ }),

/***/ 29:
/*!*******************************************************************************!*\
  !*** J:/kesionEDU_APP/KS_EDU_APP/客户小程序/首冠小程序定制/lib/polyv/common/utils/md5.js ***!
  \*******************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
var __WEBPACK_AMD_DEFINE_RESULT__;!function (n) {"use strict";function t(n, t) {var r = (65535 & n) + (65535 & t);return (n >> 16) + (t >> 16) + (r >> 16) << 16 | 65535 & r;}function r(n, r, e, o, u, c) {return t((f = t(t(r, n), t(o, c))) << (i = u) | f >>> 32 - i, e);var f, i;}function e(n, t, e, o, u, c, f) {return r(t & e | ~t & o, n, t, u, c, f);}function o(n, t, e, o, u, c, f) {return r(t & o | e & ~o, n, t, u, c, f);}function u(n, t, e, o, u, c, f) {return r(t ^ e ^ o, n, t, u, c, f);}function c(n, t, e, o, u, c, f) {return r(e ^ (t | ~o), n, t, u, c, f);}function f(n, r) {var f, i, a, d, h;n[r >> 5] |= 128 << r % 32, n[14 + (r + 64 >>> 9 << 4)] = r;var l = 1732584193,g = -271733879,v = -1732584194,m = 271733878;for (f = 0; f < n.length; f += 16) {i = l, a = g, d = v, h = m, l = e(l, g, v, m, n[f], 7, -680876936), m = e(m, l, g, v, n[f + 1], 12, -389564586), v = e(v, m, l, g, n[f + 2], 17, 606105819), g = e(g, v, m, l, n[f + 3], 22, -1044525330), l = e(l, g, v, m, n[f + 4], 7, -176418897), m = e(m, l, g, v, n[f + 5], 12, 1200080426), v = e(v, m, l, g, n[f + 6], 17, -1473231341), g = e(g, v, m, l, n[f + 7], 22, -45705983), l = e(l, g, v, m, n[f + 8], 7, 1770035416), m = e(m, l, g, v, n[f + 9], 12, -1958414417), v = e(v, m, l, g, n[f + 10], 17, -42063), g = e(g, v, m, l, n[f + 11], 22, -1990404162), l = e(l, g, v, m, n[f + 12], 7, 1804603682), m = e(m, l, g, v, n[f + 13], 12, -40341101), v = e(v, m, l, g, n[f + 14], 17, -1502002290), l = o(l, g = e(g, v, m, l, n[f + 15], 22, 1236535329), v, m, n[f + 1], 5, -165796510), m = o(m, l, g, v, n[f + 6], 9, -1069501632), v = o(v, m, l, g, n[f + 11], 14, 643717713), g = o(g, v, m, l, n[f], 20, -373897302), l = o(l, g, v, m, n[f + 5], 5, -701558691), m = o(m, l, g, v, n[f + 10], 9, 38016083), v = o(v, m, l, g, n[f + 15], 14, -660478335), g = o(g, v, m, l, n[f + 4], 20, -405537848), l = o(l, g, v, m, n[f + 9], 5, 568446438), m = o(m, l, g, v, n[f + 14], 9, -1019803690), v = o(v, m, l, g, n[f + 3], 14, -187363961), g = o(g, v, m, l, n[f + 8], 20, 1163531501), l = o(l, g, v, m, n[f + 13], 5, -1444681467), m = o(m, l, g, v, n[f + 2], 9, -51403784), v = o(v, m, l, g, n[f + 7], 14, 1735328473), l = u(l, g = o(g, v, m, l, n[f + 12], 20, -1926607734), v, m, n[f + 5], 4, -378558), m = u(m, l, g, v, n[f + 8], 11, -2022574463), v = u(v, m, l, g, n[f + 11], 16, 1839030562), g = u(g, v, m, l, n[f + 14], 23, -35309556), l = u(l, g, v, m, n[f + 1], 4, -1530992060), m = u(m, l, g, v, n[f + 4], 11, 1272893353), v = u(v, m, l, g, n[f + 7], 16, -155497632), g = u(g, v, m, l, n[f + 10], 23, -1094730640), l = u(l, g, v, m, n[f + 13], 4, 681279174), m = u(m, l, g, v, n[f], 11, -358537222), v = u(v, m, l, g, n[f + 3], 16, -722521979), g = u(g, v, m, l, n[f + 6], 23, 76029189), l = u(l, g, v, m, n[f + 9], 4, -640364487), m = u(m, l, g, v, n[f + 12], 11, -421815835), v = u(v, m, l, g, n[f + 15], 16, 530742520), l = c(l, g = u(g, v, m, l, n[f + 2], 23, -995338651), v, m, n[f], 6, -198630844), m = c(m, l, g, v, n[f + 7], 10, 1126891415), v = c(v, m, l, g, n[f + 14], 15, -1416354905), g = c(g, v, m, l, n[f + 5], 21, -57434055), l = c(l, g, v, m, n[f + 12], 6, 1700485571), m = c(m, l, g, v, n[f + 3], 10, -1894986606), v = c(v, m, l, g, n[f + 10], 15, -1051523), g = c(g, v, m, l, n[f + 1], 21, -2054922799), l = c(l, g, v, m, n[f + 8], 6, 1873313359), m = c(m, l, g, v, n[f + 15], 10, -30611744), v = c(v, m, l, g, n[f + 6], 15, -1560198380), g = c(g, v, m, l, n[f + 13], 21, 1309151649), l = c(l, g, v, m, n[f + 4], 6, -145523070), m = c(m, l, g, v, n[f + 11], 10, -1120210379), v = c(v, m, l, g, n[f + 2], 15, 718787259), g = c(g, v, m, l, n[f + 9], 21, -343485551), l = t(l, i), g = t(g, a), v = t(v, d), m = t(m, h);}return [l, g, v, m];}function i(n) {var t,r = "",e = 32 * n.length;for (t = 0; t < e; t += 8) {r += String.fromCharCode(n[t >> 5] >>> t % 32 & 255);}return r;}function a(n) {var t,r = [];for (r[(n.length >> 2) - 1] = void 0, t = 0; t < r.length; t += 1) {r[t] = 0;}var e = 8 * n.length;for (t = 0; t < e; t += 8) {r[t >> 5] |= (255 & n.charCodeAt(t / 8)) << t % 32;}return r;}function d(n) {var t,r,e = "";for (r = 0; r < n.length; r += 1) {t = n.charCodeAt(r), e += "0123456789abcdef".charAt(t >>> 4 & 15) + "0123456789abcdef".charAt(15 & t);}return e;}function h(n) {return unescape(encodeURIComponent(n));}function l(n) {return function (n) {return i(f(a(n), 8 * n.length));}(h(n));}function g(n, t) {return function (n, t) {var r,e,o = a(n),u = [],c = [];for (u[15] = c[15] = void 0, o.length > 16 && (o = f(o, 8 * n.length)), r = 0; r < 16; r += 1) {u[r] = 909522486 ^ o[r], c[r] = 1549556828 ^ o[r];}return e = f(u.concat(a(t)), 512 + 8 * t.length), i(f(c.concat(e), 640));}(h(n), h(t));}function v(n, t, r) {return t ? r ? g(t, n) : d(g(t, n)) : r ? l(n) : d(l(n));} true ? !(__WEBPACK_AMD_DEFINE_RESULT__ = (function () {return v;}).call(exports, __webpack_require__, exports, module),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__)) : undefined;}(void 0);

/***/ }),

/***/ 3:
/*!***********************************!*\
  !*** (webpack)/buildin/global.js ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports) {

var g;

// This works in non-strict mode
g = (function() {
	return this;
})();

try {
	// This works if eval is allowed (see CSP)
	g = g || new Function("return this")();
} catch (e) {
	// This works if the window reference is available
	if (typeof window === "object") g = window;
}

// g can still be undefined, but nothing to do about it...
// We return undefined, instead of nothing here, so it's
// easier to handle this case. if(!global) { ...}

module.exports = g;


/***/ }),

/***/ 30:
/*!*******************************************************************************************!*\
  !*** J:/kesionEDU_APP/KS_EDU_APP/客户小程序/首冠小程序定制/lib/polyv/common/utils/weapp.socket.io.js ***!
  \*******************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
function _defineProperties(target, props) {for (var i = 0; i < props.length; i++) {var descriptor = props[i];descriptor.enumerable = descriptor.enumerable || false;descriptor.configurable = true;if ("value" in descriptor) descriptor.writable = true;Object.defineProperty(target, descriptor.key, descriptor);}}function _createClass(Constructor, protoProps, staticProps) {if (protoProps) _defineProperties(Constructor.prototype, protoProps);if (staticProps) _defineProperties(Constructor, staticProps);return Constructor;}function _possibleConstructorReturn(self, call) {if (call && (typeof call === "object" || typeof call === "function")) {return call;}return _assertThisInitialized(self);}function _assertThisInitialized(self) {if (self === void 0) {throw new ReferenceError("this hasn't been initialised - super() hasn't been called");}return self;}function _getPrototypeOf(o) {_getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf : function _getPrototypeOf(o) {return o.__proto__ || Object.getPrototypeOf(o);};return _getPrototypeOf(o);}function _inherits(subClass, superClass) {if (typeof superClass !== "function" && superClass !== null) {throw new TypeError("Super expression must either be null or a function");}subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, writable: true, configurable: true } });if (superClass) _setPrototypeOf(subClass, superClass);}function _setPrototypeOf(o, p) {_setPrototypeOf = Object.setPrototypeOf || function _setPrototypeOf(o, p) {o.__proto__ = p;return o;};return _setPrototypeOf(o, p);}function _classCallCheck(instance, Constructor) {if (!(instance instanceof Constructor)) {throw new TypeError("Cannot call a class as a function");}}!function (t, e) {if (true) module.exports = e();else { var n, r; }}(window, function () {return function (t) {var e = {};function r(n) {if (e[n]) return e[n].exports;var o = e[n] = { i: n, l: !1, exports: {} };return t[n].call(o.exports, o, o.exports, r), o.l = !0, o.exports;}return r.m = t, r.c = e, r.d = function (t, e, n) {r.o(t, e) || Object.defineProperty(t, e, { enumerable: !0, get: n });}, r.r = function (t) {"undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(t, Symbol.toStringTag, { value: "Module" }), Object.defineProperty(t, "__esModule", { value: !0 });}, r.t = function (t, e) {if (1 & e && (t = r(t)), 8 & e) return t;if (4 & e && "object" == typeof t && t && t.__esModule) return t;var n = Object.create(null);if (r.r(n), Object.defineProperty(n, "default", { enumerable: !0, value: t }), 2 & e && "string" != typeof t) for (var o in t) {r.d(n, o, function (e) {return t[e];}.bind(null, o));}return n;}, r.n = function (t) {var e = t && t.__esModule ? function () {return t.default;} : function () {return t;};return r.d(e, "a", e), e;}, r.o = function (t, e) {return Object.prototype.hasOwnProperty.call(t, e);}, r.p = "", r(r.s = 24);}([function (t, e) {t.exports = function () {return function () {};};}, function (t, e) {var r;r = function () {return this;}();try {r = r || Function("return this")() || (0, eval)("this");} catch (t) {"object" == typeof window && (r = window);}t.exports = r;}, function (t, e) {var r = {}.toString;t.exports = Array.isArray || function (t) {return "[object Array]" == r.call(t);};}, function (t, e, r) {function n(t) {if (t) return function (t) {for (var e in n.prototype) {t[e] = n.prototype[e];}return t;}(t);}t.exports = n, n.prototype.on = n.prototype.addEventListener = function (t, e) {return this._callbacks = this._callbacks || {}, (this._callbacks["$" + t] = this._callbacks["$" + t] || []).push(e), this;}, n.prototype.once = function (t, e) {function r() {this.off(t, r), e.apply(this, arguments);}return r.fn = e, this.on(t, r), this;}, n.prototype.off = n.prototype.removeListener = n.prototype.removeAllListeners = n.prototype.removeEventListener = function (t, e) {if (this._callbacks = this._callbacks || {}, 0 == arguments.length) return this._callbacks = {}, this;var r,n = this._callbacks["$" + t];if (!n) return this;if (1 == arguments.length) return delete this._callbacks["$" + t], this;for (var o = 0; o < n.length; o++) {if ((r = n[o]) === e || r.fn === e) {n.splice(o, 1);break;}}return this;}, n.prototype.emit = function (t) {this._callbacks = this._callbacks || {};var e = [].slice.call(arguments, 1),r = this._callbacks["$" + t];if (r) for (var n = 0, o = (r = r.slice(0)).length; n < o; ++n) {r[n].apply(this, e);}return this;}, n.prototype.listeners = function (t) {return this._callbacks = this._callbacks || {}, this._callbacks["$" + t] || [];}, n.prototype.hasListeners = function (t) {return !!this.listeners(t).length;};}, function (t, e, r) {var n = r(0)("socket.io-parser"),o = r(3),i = r(20),s = r(2),a = r(9);function u() {}e.protocol = 4, e.types = ["CONNECT", "DISCONNECT", "EVENT", "ACK", "ERROR", "BINARY_EVENT", "BINARY_ACK"], e.CONNECT = 0, e.DISCONNECT = 1, e.EVENT = 2, e.ACK = 3, e.ERROR = 4, e.BINARY_EVENT = 5, e.BINARY_ACK = 6, e.Encoder = u, e.Decoder = h;var c = e.ERROR + '"encode error"';function f(t) {var r = "" + t.type;if (e.BINARY_EVENT !== t.type && e.BINARY_ACK !== t.type || (r += t.attachments + "-"), t.nsp && "/" !== t.nsp && (r += t.nsp + ","), null != t.id && (r += t.id), null != t.data) {var o = function (t) {try {return JSON.stringify(t);} catch (t) {return !1;}}(t.data);if (!1 === o) return c;r += o;}return n("encoded %j as %s", t, r), r;}function h() {this.reconstructor = null;}function p(t) {this.reconPack = t, this.buffers = [];}function l(t) {return { type: e.ERROR, data: "parser error: " + t };}u.prototype.encode = function (t, r) {n("encoding packet %j", t), e.BINARY_EVENT === t.type || e.BINARY_ACK === t.type ? function (t, e) {i.removeBlobs(t, function (t) {var r = i.deconstructPacket(t),n = f(r.packet),o = r.buffers;o.unshift(n), e(o);});}(t, r) : r([f(t)]);}, o(h.prototype), h.prototype.add = function (t) {var r;if ("string" == typeof t) r = function (t) {var r = 0,o = { type: Number(t.charAt(0)) };if (null == e.types[o.type]) return l("unknown packet type " + o.type);if (e.BINARY_EVENT === o.type || e.BINARY_ACK === o.type) {for (var i = ""; "-" !== t.charAt(++r) && (i += t.charAt(r), r != t.length);) {;}if (i != Number(i) || "-" !== t.charAt(r)) throw new Error("Illegal attachments");o.attachments = Number(i);}if ("/" === t.charAt(r + 1)) for (o.nsp = ""; ++r;) {if ("," === (u = t.charAt(r))) break;if (o.nsp += u, r === t.length) break;} else o.nsp = "/";var a = t.charAt(r + 1);if ("" !== a && Number(a) == a) {for (o.id = ""; ++r;) {var u;if (null == (u = t.charAt(r)) || Number(u) != u) {--r;break;}if (o.id += t.charAt(r), r === t.length) break;}o.id = Number(o.id);}if (t.charAt(++r)) {var c = function (t) {try {return JSON.parse(t);} catch (t) {return !1;}}(t.substr(r));if (!(!1 !== c && (o.type === e.ERROR || s(c)))) return l("invalid payload");o.data = c;}return n("decoded %s as %j", t, o), o;}(t), e.BINARY_EVENT === r.type || e.BINARY_ACK === r.type ? (this.reconstructor = new p(r), 0 === this.reconstructor.reconPack.attachments && this.emit("decoded", r)) : this.emit("decoded", r);else {if (!a(t) && !t.base64) throw new Error("Unknown type: " + t);if (!this.reconstructor) throw new Error("got binary data when not reconstructing a packet");(r = this.reconstructor.takeBinaryData(t)) && (this.reconstructor = null, this.emit("decoded", r));}}, h.prototype.destroy = function () {this.reconstructor && this.reconstructor.finishedReconstruction();}, p.prototype.takeBinaryData = function (t) {if (this.buffers.push(t), this.buffers.length === this.reconPack.attachments) {var e = i.reconstructPacket(this.reconPack, this.buffers);return this.finishedReconstruction(), e;}return null;}, p.prototype.finishedReconstruction = function () {this.reconPack = null, this.buffers = [];};}, function (t, e) {var r = [].slice;t.exports = function (t, e) {if ("string" == typeof e && (e = t[e]), "function" != typeof e) throw new Error("bind() requires a function");var n = r.call(arguments, 2);return function () {return e.apply(t, n.concat(r.call(arguments)));};};}, function (t, e) {t.exports = function (t, e, r) {return t.on(e, r), { destroy: function destroy() {t.removeListener(e, r);} };};}, function (t, e, r) {var n = r(4),o = r(3),i = r(18),s = r(6),a = r(5),u = r(0)("socket.io-client:socket"),c = r(17),f = r(16);t.exports = l;var h = { connect: 1, connect_error: 1, connect_timeout: 1, connecting: 1, disconnect: 1, error: 1, reconnect: 1, reconnect_attempt: 1, reconnect_failed: 1, reconnect_error: 1, reconnecting: 1, ping: 1, pong: 1 },p = o.prototype.emit;function l(t, e, r) {this.io = t, this.nsp = e, this.json = this, this.ids = 0, this.acks = {}, this.receiveBuffer = [], this.sendBuffer = [], this.connected = !1, this.disconnected = !0, this.flags = {}, r && r.query && (this.query = r.query), this.io.autoConnect && this.open();}o(l.prototype), l.prototype.subEvents = function () {if (!this.subs) {var t = this.io;this.subs = [s(t, "open", a(this, "onopen")), s(t, "packet", a(this, "onpacket")), s(t, "close", a(this, "onclose"))];}}, l.prototype.open = l.prototype.connect = function () {return this.connected ? this : (this.subEvents(), this.io.open(), "open" === this.io.readyState && this.onopen(), this.emit("connecting"), this);}, l.prototype.send = function () {var t = i(arguments);return t.unshift("message"), this.emit.apply(this, t), this;}, l.prototype.emit = function (t) {if (h.hasOwnProperty(t)) return p.apply(this, arguments), this;var e = i(arguments),r = { type: (void 0 !== this.flags.binary ? this.flags.binary : f(e)) ? n.BINARY_EVENT : n.EVENT, data: e, options: {} };return r.options.compress = !this.flags || !1 !== this.flags.compress, "function" == typeof e[e.length - 1] && (u("emitting packet with ack id %d", this.ids), this.acks[this.ids] = e.pop(), r.id = this.ids++), this.connected ? this.packet(r) : this.sendBuffer.push(r), this.flags = {}, this;}, l.prototype.packet = function (t) {t.nsp = this.nsp, this.io.packet(t);}, l.prototype.onopen = function () {if (u("transport is open - connecting"), "/" !== this.nsp) if (this.query) {var t = "object" == typeof this.query ? c.encode(this.query) : this.query;u("sending connect packet with query %s", t), this.packet({ type: n.CONNECT, query: t });} else this.packet({ type: n.CONNECT });}, l.prototype.onclose = function (t) {u("close (%s)", t), this.connected = !1, this.disconnected = !0, delete this.id, this.emit("disconnect", t);}, l.prototype.onpacket = function (t) {var e = t.nsp === this.nsp,r = t.type === n.ERROR && "/" === t.nsp;if (e || r) switch (t.type) {case n.CONNECT:this.onconnect();break;case n.EVENT:case n.BINARY_EVENT:this.onevent(t);break;case n.ACK:case n.BINARY_ACK:this.onack(t);break;case n.DISCONNECT:this.ondisconnect();break;case n.ERROR:this.emit("error", t.data);}}, l.prototype.onevent = function (t) {var e = t.data || [];u("emitting event %j", e), null != t.id && (u("attaching ack callback to event"), e.push(this.ack(t.id))), this.connected ? p.apply(this, e) : this.receiveBuffer.push(e);}, l.prototype.ack = function (t) {var e = this,r = !1;return function () {if (!r) {r = !0;var o = i(arguments);u("sending ack %j", o), e.packet({ type: f(o) ? n.BINARY_ACK : n.ACK, id: t, data: o });}};}, l.prototype.onack = function (t) {var e = this.acks[t.id];"function" == typeof e ? (u("calling ack %s with %j", t.id, t.data), e.apply(this, t.data), delete this.acks[t.id]) : u("bad ack %s", t.id);}, l.prototype.onconnect = function () {this.connected = !0, this.disconnected = !1, this.emit("connect"), this.emitBuffered();}, l.prototype.emitBuffered = function () {var t;for (t = 0; t < this.receiveBuffer.length; t++) {p.apply(this, this.receiveBuffer[t]);}for (this.receiveBuffer = [], t = 0; t < this.sendBuffer.length; t++) {this.packet(this.sendBuffer[t]);}this.sendBuffer = [];}, l.prototype.ondisconnect = function () {u("server disconnect (%s)", this.nsp), this.destroy(), this.onclose("io server disconnect");}, l.prototype.destroy = function () {if (this.subs) {for (var t = 0; t < this.subs.length; t++) {this.subs[t].destroy();}this.subs = null;}this.io.destroy(this);}, l.prototype.close = l.prototype.disconnect = function () {return this.connected && (u("performing disconnect (%s)", this.nsp), this.packet({ type: n.DISCONNECT })), this.destroy(), this.connected && this.onclose("io client disconnect"), this;}, l.prototype.compress = function (t) {return this.flags.compress = t, this;}, l.prototype.binary = function (t) {return this.flags.binary = t, this;};}, function (t, e, r) {var n = r(19),o = r(7),i = r(3),s = r(4),a = r(6),u = r(5),c = r(0)("socket.io-client:manager"),f = r(11),h = r(10),p = Object.prototype.hasOwnProperty;function l(t, e) {if (!(this instanceof l)) return new l(t, e);t && "object" == typeof t && (e = t, t = void 0), (e = e || {}).path = e.path || "/socket.io", this.nsps = {}, this.subs = [], this.opts = e, this.reconnection(!1 !== e.reconnection), this.reconnectionAttempts(e.reconnectionAttempts || 1 / 0), this.reconnectionDelay(e.reconnectionDelay || 1e3), this.reconnectionDelayMax(e.reconnectionDelayMax || 5e3), this.randomizationFactor(e.randomizationFactor || .5), this.backoff = new h({ min: this.reconnectionDelay(), max: this.reconnectionDelayMax(), jitter: this.randomizationFactor() }), this.timeout(null == e.timeout ? 2e4 : e.timeout), this.readyState = "closed", this.uri = t, this.connecting = [], this.lastPing = null, this.encoding = !1, this.packetBuffer = [];var r = e.parser || s;this.encoder = new r.Encoder(), this.decoder = new r.Decoder(), this.autoConnect = !1 !== e.autoConnect, this.autoConnect && this.open();}t.exports = l, l.prototype.emitAll = function () {for (var t in this.emit.apply(this, arguments), this.nsps) {p.call(this.nsps, t) && this.nsps[t].emit.apply(this.nsps[t], arguments);}}, l.prototype.updateSocketIds = function () {for (var t in this.nsps) {p.call(this.nsps, t) && (this.nsps[t].id = this.generateId(t));}}, l.prototype.generateId = function (t) {return ("/" === t ? "" : t + "#") + this.engine.id;}, i(l.prototype), l.prototype.reconnection = function (t) {return arguments.length ? (this._reconnection = !!t, this) : this._reconnection;}, l.prototype.reconnectionAttempts = function (t) {return arguments.length ? (this._reconnectionAttempts = t, this) : this._reconnectionAttempts;}, l.prototype.reconnectionDelay = function (t) {return arguments.length ? (this._reconnectionDelay = t, this.backoff && this.backoff.setMin(t), this) : this._reconnectionDelay;}, l.prototype.randomizationFactor = function (t) {return arguments.length ? (this._randomizationFactor = t, this.backoff && this.backoff.setJitter(t), this) : this._randomizationFactor;}, l.prototype.reconnectionDelayMax = function (t) {return arguments.length ? (this._reconnectionDelayMax = t, this.backoff && this.backoff.setMax(t), this) : this._reconnectionDelayMax;}, l.prototype.timeout = function (t) {return arguments.length ? (this._timeout = t, this) : this._timeout;}, l.prototype.maybeReconnectOnOpen = function () {!this.reconnecting && this._reconnection && 0 === this.backoff.attempts && this.reconnect();}, l.prototype.open = l.prototype.connect = function (t, e) {if (c("readyState %s", this.readyState), ~this.readyState.indexOf("open")) return this;c("opening %s", this.uri), this.engine = n(this.uri, this.opts);var r = this.engine,o = this;this.readyState = "opening", this.skipReconnect = !1;var i = a(r, "open", function () {o.onopen(), t && t();}),s = a(r, "error", function (e) {if (c("connect_error"), o.cleanup(), o.readyState = "closed", o.emitAll("connect_error", e), t) {var r = new Error("Connection error");r.data = e, t(r);} else o.maybeReconnectOnOpen();});if (!1 !== this._timeout) {var u = this._timeout;c("connect attempt will timeout after %d", u);var f = setTimeout(function () {c("connect attempt timed out after %d", u), i.destroy(), r.close(), r.emit("error", "timeout"), o.emitAll("connect_timeout", u);}, u);this.subs.push({ destroy: function destroy() {clearTimeout(f);} });}return this.subs.push(i), this.subs.push(s), this;}, l.prototype.onopen = function () {c("open"), this.cleanup(), this.readyState = "open", this.emit("open");var t = this.engine;this.subs.push(a(t, "data", u(this, "ondata"))), this.subs.push(a(t, "ping", u(this, "onping"))), this.subs.push(a(t, "pong", u(this, "onpong"))), this.subs.push(a(t, "error", u(this, "onerror"))), this.subs.push(a(t, "close", u(this, "onclose"))), this.subs.push(a(this.decoder, "decoded", u(this, "ondecoded")));}, l.prototype.onping = function () {this.lastPing = new Date(), this.emitAll("ping");}, l.prototype.onpong = function () {this.emitAll("pong", new Date() - this.lastPing);}, l.prototype.ondata = function (t) {this.decoder.add(t);}, l.prototype.ondecoded = function (t) {this.emit("packet", t);}, l.prototype.onerror = function (t) {c("error", t), this.emitAll("error", t);}, l.prototype.socket = function (t, e) {var r = this.nsps[t];if (!r) {r = new o(this, t, e), this.nsps[t] = r;var n = this;r.on("connecting", i), r.on("connect", function () {r.id = n.generateId(t);}), this.autoConnect && i();}function i() {~f(n.connecting, r) || n.connecting.push(r);}return r;}, l.prototype.destroy = function (t) {var e = f(this.connecting, t);~e && this.connecting.splice(e, 1), this.connecting.length || this.close();}, l.prototype.packet = function (t) {c("writing packet %j", t);var e = this;t.query && 0 === t.type && (t.nsp += "?" + t.query), e.encoding ? e.packetBuffer.push(t) : (e.encoding = !0, this.encoder.encode(t, function (r) {for (var n = 0; n < r.length; n++) {e.engine.write(r[n], t.options);}e.encoding = !1, e.processPacketQueue();}));}, l.prototype.processPacketQueue = function () {if (this.packetBuffer.length > 0 && !this.encoding) {var t = this.packetBuffer.shift();this.packet(t);}}, l.prototype.cleanup = function () {c("cleanup");for (var t = this.subs.length, e = 0; e < t; e++) {this.subs.shift().destroy();}this.packetBuffer = [], this.encoding = !1, this.lastPing = null, this.decoder.destroy();}, l.prototype.close = l.prototype.disconnect = function () {c("disconnect"), this.skipReconnect = !0, this.reconnecting = !1, "opening" === this.readyState && this.cleanup(), this.backoff.reset(), this.readyState = "closed", this.engine && this.engine.close();}, l.prototype.onclose = function (t) {c("onclose"), this.cleanup(), this.backoff.reset(), this.readyState = "closed", this.emit("close", t), this._reconnection && !this.skipReconnect && this.reconnect();}, l.prototype.reconnect = function () {if (this.reconnecting || this.skipReconnect) return this;var t = this;if (this.backoff.attempts >= this._reconnectionAttempts) c("reconnect failed"), this.backoff.reset(), this.emitAll("reconnect_failed"), this.reconnecting = !1;else {var e = this.backoff.duration();c("will wait %dms before reconnect attempt", e), this.reconnecting = !0;var r = setTimeout(function () {t.skipReconnect || (c("attempting reconnect"), t.emitAll("reconnect_attempt", t.backoff.attempts), t.emitAll("reconnecting", t.backoff.attempts), t.skipReconnect || t.open(function (e) {e ? (c("reconnect attempt error"), t.reconnecting = !1, t.reconnect(), t.emitAll("reconnect_error", e.data)) : (c("reconnect success"), t.onreconnect());}));}, e);this.subs.push({ destroy: function destroy() {clearTimeout(r);} });}}, l.prototype.onreconnect = function () {var t = this.backoff.attempts;this.reconnecting = !1, this.backoff.reset(), this.updateSocketIds(), this.emitAll("reconnect", t);};}, function (t, e, r) {(function (e) {t.exports = function (t) {return r && e.Buffer.isBuffer(t) || n && (t instanceof e.ArrayBuffer || o(t));};var r = "function" == typeof e.Buffer && "function" == typeof e.Buffer.isBuffer,n = "function" == typeof e.ArrayBuffer,o = n && "function" == typeof e.ArrayBuffer.isView ? e.ArrayBuffer.isView : function (t) {return t.buffer instanceof e.ArrayBuffer;};}).call(this, r(1));}, function (t, e) {function r(t) {t = t || {}, this.ms = t.min || 100, this.max = t.max || 1e4, this.factor = t.factor || 2, this.jitter = t.jitter > 0 && t.jitter <= 1 ? t.jitter : 0, this.attempts = 0;}t.exports = r, r.prototype.duration = function () {var t = this.ms * Math.pow(this.factor, this.attempts++);if (this.jitter) {var e = Math.random(),r = Math.floor(e * this.jitter * t);t = 0 == (1 & Math.floor(10 * e)) ? t - r : t + r;}return 0 | Math.min(t, this.max);}, r.prototype.reset = function () {this.attempts = 0;}, r.prototype.setMin = function (t) {this.ms = t;}, r.prototype.setMax = function (t) {this.max = t;}, r.prototype.setJitter = function (t) {this.jitter = t;};}, function (t, e) {var r = [].indexOf;t.exports = function (t, e) {if (r) return t.indexOf(e);for (var n = 0; n < t.length; ++n) {if (t[n] === e) return n;}return -1;};}, function (t, e) {var r = {}.toString;t.exports = Array.isArray || function (t) {return "[object Array]" == r.call(t);};}, function (t, e) {e.read = function (t, e, r, n, o) {var i,s,a = 8 * o - n - 1,u = (1 << a) - 1,c = u >> 1,f = -7,h = r ? o - 1 : 0,p = r ? -1 : 1,l = t[e + h];for (h += p, i = l & (1 << -f) - 1, l >>= -f, f += a; f > 0; i = 256 * i + t[e + h], h += p, f -= 8) {;}for (s = i & (1 << -f) - 1, i >>= -f, f += n; f > 0; s = 256 * s + t[e + h], h += p, f -= 8) {;}if (0 === i) i = 1 - c;else {if (i === u) return s ? NaN : 1 / 0 * (l ? -1 : 1);s += Math.pow(2, n), i -= c;}return (l ? -1 : 1) * s * Math.pow(2, i - n);}, e.write = function (t, e, r, n, o, i) {var s,a,u,c = 8 * i - o - 1,f = (1 << c) - 1,h = f >> 1,p = 23 === o ? Math.pow(2, -24) - Math.pow(2, -77) : 0,l = n ? 0 : i - 1,d = n ? 1 : -1,y = e < 0 || 0 === e && 1 / e < 0 ? 1 : 0;for (e = Math.abs(e), isNaN(e) || e === 1 / 0 ? (a = isNaN(e) ? 1 : 0, s = f) : (s = Math.floor(Math.log(e) / Math.LN2), e * (u = Math.pow(2, -s)) < 1 && (s--, u *= 2), (e += s + h >= 1 ? p / u : p * Math.pow(2, 1 - h)) * u >= 2 && (s++, u /= 2), s + h >= f ? (a = 0, s = f) : s + h >= 1 ? (a = (e * u - 1) * Math.pow(2, o), s += h) : (a = e * Math.pow(2, h - 1) * Math.pow(2, o), s = 0)); o >= 8; t[r + l] = 255 & a, l += d, a /= 256, o -= 8) {;}for (s = s << o | a, c += o; c > 0; t[r + l] = 255 & s, l += d, s /= 256, c -= 8) {;}t[r + l - d] |= 128 * y;};}, function (t, e, r) {"use strict";e.byteLength = function (t) {var e = c(t),r = e[0],n = e[1];return 3 * (r + n) / 4 - n;}, e.toByteArray = function (t) {for (var e, r = c(t), n = r[0], s = r[1], a = new i(3 * (n + s) / 4 - s), u = 0, f = s > 0 ? n - 4 : n, h = 0; h < f; h += 4) {e = o[t.charCodeAt(h)] << 18 | o[t.charCodeAt(h + 1)] << 12 | o[t.charCodeAt(h + 2)] << 6 | o[t.charCodeAt(h + 3)], a[u++] = e >> 16 & 255, a[u++] = e >> 8 & 255, a[u++] = 255 & e;}return 2 === s && (e = o[t.charCodeAt(h)] << 2 | o[t.charCodeAt(h + 1)] >> 4, a[u++] = 255 & e), 1 === s && (e = o[t.charCodeAt(h)] << 10 | o[t.charCodeAt(h + 1)] << 4 | o[t.charCodeAt(h + 2)] >> 2, a[u++] = e >> 8 & 255, a[u++] = 255 & e), a;}, e.fromByteArray = function (t) {for (var e, r = t.length, o = r % 3, i = [], s = 0, a = r - o; s < a; s += 16383) {i.push(f(t, s, s + 16383 > a ? a : s + 16383));}return 1 === o ? (e = t[r - 1], i.push(n[e >> 2] + n[e << 4 & 63] + "==")) : 2 === o && (e = (t[r - 2] << 8) + t[r - 1], i.push(n[e >> 10] + n[e >> 4 & 63] + n[e << 2 & 63] + "=")), i.join("");};for (var n = [], o = [], i = "undefined" != typeof Uint8Array ? Uint8Array : Array, s = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/", a = 0, u = s.length; a < u; ++a) {n[a] = s[a], o[s.charCodeAt(a)] = a;}function c(t) {var e = t.length;if (e % 4 > 0) throw new Error("Invalid string. Length must be a multiple of 4");var r = t.indexOf("=");return -1 === r && (r = e), [r, r === e ? 0 : 4 - r % 4];}function f(t, e, r) {for (var o, i, s = [], a = e; a < r; a += 3) {o = (t[a] << 16 & 16711680) + (t[a + 1] << 8 & 65280) + (255 & t[a + 2]), s.push(n[(i = o) >> 18 & 63] + n[i >> 12 & 63] + n[i >> 6 & 63] + n[63 & i]);}return s.join("");}o["-".charCodeAt(0)] = 62, o["_".charCodeAt(0)] = 63;}, function (t, e, r) {"use strict";(function (t) {var n = r(14),o = r(13),i = r(12);function s() {return u.TYPED_ARRAY_SUPPORT ? 2147483647 : 1073741823;}function a(t, e) {if (s() < e) throw new RangeError("Invalid typed array length");return u.TYPED_ARRAY_SUPPORT ? (t = new Uint8Array(e)).__proto__ = u.prototype : (null === t && (t = new u(e)), t.length = e), t;}function u(t, e, r) {if (!(u.TYPED_ARRAY_SUPPORT || this instanceof u)) return new u(t, e, r);if ("number" == typeof t) {if ("string" == typeof e) throw new Error("If encoding is specified then the first argument must be a string");return h(this, t);}return c(this, t, e, r);}function c(t, e, r, n) {if ("number" == typeof e) throw new TypeError('"value" argument must not be a number');return "undefined" != typeof ArrayBuffer && e instanceof ArrayBuffer ? function (t, e, r, n) {if (e.byteLength, r < 0 || e.byteLength < r) throw new RangeError("'offset' is out of bounds");if (e.byteLength < r + (n || 0)) throw new RangeError("'length' is out of bounds");return e = void 0 === r && void 0 === n ? new Uint8Array(e) : void 0 === n ? new Uint8Array(e, r) : new Uint8Array(e, r, n), u.TYPED_ARRAY_SUPPORT ? (t = e).__proto__ = u.prototype : t = p(t, e), t;}(t, e, r, n) : "string" == typeof e ? function (t, e, r) {if ("string" == typeof r && "" !== r || (r = "utf8"), !u.isEncoding(r)) throw new TypeError('"encoding" must be a valid string encoding');var n = 0 | d(e, r),o = (t = a(t, n)).write(e, r);return o !== n && (t = t.slice(0, o)), t;}(t, e, r) : function (t, e) {if (u.isBuffer(e)) {var r = 0 | l(e.length);return 0 === (t = a(t, r)).length ? t : (e.copy(t, 0, 0, r), t);}if (e) {if ("undefined" != typeof ArrayBuffer && e.buffer instanceof ArrayBuffer || "length" in e) return "number" != typeof e.length || (n = e.length) != n ? a(t, 0) : p(t, e);if ("Buffer" === e.type && i(e.data)) return p(t, e.data);}var n;throw new TypeError("First argument must be a string, Buffer, ArrayBuffer, Array, or array-like object.");}(t, e);}function f(t) {if ("number" != typeof t) throw new TypeError('"size" argument must be a number');if (t < 0) throw new RangeError('"size" argument must not be negative');}function h(t, e) {if (f(e), t = a(t, e < 0 ? 0 : 0 | l(e)), !u.TYPED_ARRAY_SUPPORT) for (var r = 0; r < e; ++r) {t[r] = 0;}return t;}function p(t, e) {var r = e.length < 0 ? 0 : 0 | l(e.length);t = a(t, r);for (var n = 0; n < r; n += 1) {t[n] = 255 & e[n];}return t;}function l(t) {if (t >= s()) throw new RangeError("Attempt to allocate Buffer larger than maximum size: 0x" + s().toString(16) + " bytes");return 0 | t;}function d(t, e) {if (u.isBuffer(t)) return t.length;if ("undefined" != typeof ArrayBuffer && "function" == typeof ArrayBuffer.isView && (ArrayBuffer.isView(t) || t instanceof ArrayBuffer)) return t.byteLength;"string" != typeof t && (t = "" + t);var r = t.length;if (0 === r) return 0;for (var n = !1;;) {switch (e) {case "ascii":case "latin1":case "binary":return r;case "utf8":case "utf-8":case void 0:return j(t).length;case "ucs2":case "ucs-2":case "utf16le":case "utf-16le":return 2 * r;case "hex":return r >>> 1;case "base64":return q(t).length;default:if (n) return j(t).length;e = ("" + e).toLowerCase(), n = !0;}}}function y(t, e, r) {var n = t[e];t[e] = t[r], t[r] = n;}function g(t, e, r, n, o) {if (0 === t.length) return -1;if ("string" == typeof r ? (n = r, r = 0) : r > 2147483647 ? r = 2147483647 : r < -2147483648 && (r = -2147483648), r = +r, isNaN(r) && (r = o ? 0 : t.length - 1), r < 0 && (r = t.length + r), r >= t.length) {if (o) return -1;r = t.length - 1;} else if (r < 0) {if (!o) return -1;r = 0;}if ("string" == typeof e && (e = u.from(e, n)), u.isBuffer(e)) return 0 === e.length ? -1 : v(t, e, r, n, o);if ("number" == typeof e) return e &= 255, u.TYPED_ARRAY_SUPPORT && "function" == typeof Uint8Array.prototype.indexOf ? o ? Uint8Array.prototype.indexOf.call(t, e, r) : Uint8Array.prototype.lastIndexOf.call(t, e, r) : v(t, [e], r, n, o);throw new TypeError("val must be string, number or Buffer");}function v(t, e, r, n, o) {var i,s = 1,a = t.length,u = e.length;if (void 0 !== n && ("ucs2" === (n = String(n).toLowerCase()) || "ucs-2" === n || "utf16le" === n || "utf-16le" === n)) {if (t.length < 2 || e.length < 2) return -1;s = 2, a /= 2, u /= 2, r /= 2;}function c(t, e) {return 1 === s ? t[e] : t.readUInt16BE(e * s);}if (o) {var f = -1;for (i = r; i < a; i++) {if (c(t, i) === c(e, -1 === f ? 0 : i - f)) {if (-1 === f && (f = i), i - f + 1 === u) return f * s;} else -1 !== f && (i -= i - f), f = -1;}} else for (r + u > a && (r = a - u), i = r; i >= 0; i--) {for (var h = !0, p = 0; p < u; p++) {if (c(t, i + p) !== c(e, p)) {h = !1;break;}}if (h) return i;}return -1;}function b(t, e, r, n) {r = Number(r) || 0;var o = t.length - r;n ? (n = Number(n)) > o && (n = o) : n = o;var i = e.length;if (i % 2 != 0) throw new TypeError("Invalid hex string");n > i / 2 && (n = i / 2);for (var s = 0; s < n; ++s) {var a = parseInt(e.substr(2 * s, 2), 16);if (isNaN(a)) return s;t[r + s] = a;}return s;}function m(t, e, r, n) {return F(j(e, t.length - r), t, r, n);}function w(t, e, r, n) {return F(function (t) {for (var e = [], r = 0; r < t.length; ++r) {e.push(255 & t.charCodeAt(r));}return e;}(e), t, r, n);}function A(t, e, r, n) {return w(t, e, r, n);}function _(t, e, r, n) {return F(q(e), t, r, n);}function E(t, e, r, n) {return F(function (t, e) {for (var r, n, o, i = [], s = 0; s < t.length && !((e -= 2) < 0); ++s) {n = (r = t.charCodeAt(s)) >> 8, o = r % 256, i.push(o), i.push(n);}return i;}(e, t.length - r), t, r, n);}function k(t, e, r) {return 0 === e && r === t.length ? n.fromByteArray(t) : n.fromByteArray(t.slice(e, r));}function B(t, e, r) {r = Math.min(t.length, r);for (var n = [], o = e; o < r;) {var i,s,a,u,c = t[o],f = null,h = c > 239 ? 4 : c > 223 ? 3 : c > 191 ? 2 : 1;if (o + h <= r) switch (h) {case 1:c < 128 && (f = c);break;case 2:128 == (192 & (i = t[o + 1])) && (u = (31 & c) << 6 | 63 & i) > 127 && (f = u);break;case 3:i = t[o + 1], s = t[o + 2], 128 == (192 & i) && 128 == (192 & s) && (u = (15 & c) << 12 | (63 & i) << 6 | 63 & s) > 2047 && (u < 55296 || u > 57343) && (f = u);break;case 4:i = t[o + 1], s = t[o + 2], a = t[o + 3], 128 == (192 & i) && 128 == (192 & s) && 128 == (192 & a) && (u = (15 & c) << 18 | (63 & i) << 12 | (63 & s) << 6 | 63 & a) > 65535 && u < 1114112 && (f = u);}null === f ? (f = 65533, h = 1) : f > 65535 && (f -= 65536, n.push(f >>> 10 & 1023 | 55296), f = 56320 | 1023 & f), n.push(f), o += h;}return function (t) {var e = t.length;if (e <= R) return String.fromCharCode.apply(String, t);for (var r = "", n = 0; n < e;) {r += String.fromCharCode.apply(String, t.slice(n, n += R));}return r;}(n);}e.Buffer = u, e.SlowBuffer = function (t) {return +t != t && (t = 0), u.alloc(+t);}, e.INSPECT_MAX_BYTES = 50, u.TYPED_ARRAY_SUPPORT = void 0 !== t.TYPED_ARRAY_SUPPORT ? t.TYPED_ARRAY_SUPPORT : function () {try {var t = new Uint8Array(1);return t.__proto__ = { __proto__: Uint8Array.prototype, foo: function foo() {return 42;} }, 42 === t.foo() && "function" == typeof t.subarray && 0 === t.subarray(1, 1).byteLength;} catch (t) {return !1;}}(), e.kMaxLength = s(), u.poolSize = 8192, u._augment = function (t) {return t.__proto__ = u.prototype, t;}, u.from = function (t, e, r) {return c(null, t, e, r);}, u.TYPED_ARRAY_SUPPORT && (u.prototype.__proto__ = Uint8Array.prototype, u.__proto__ = Uint8Array, "undefined" != typeof Symbol && Symbol.species && u[Symbol.species] === u && Object.defineProperty(u, Symbol.species, { value: null, configurable: !0 })), u.alloc = function (t, e, r) {return function (t, e, r, n) {return f(e), e <= 0 ? a(t, e) : void 0 !== r ? "string" == typeof n ? a(t, e).fill(r, n) : a(t, e).fill(r) : a(t, e);}(null, t, e, r);}, u.allocUnsafe = function (t) {return h(null, t);}, u.allocUnsafeSlow = function (t) {return h(null, t);}, u.isBuffer = function (t) {return !(null == t || !t._isBuffer);}, u.compare = function (t, e) {if (!u.isBuffer(t) || !u.isBuffer(e)) throw new TypeError("Arguments must be Buffers");if (t === e) return 0;for (var r = t.length, n = e.length, o = 0, i = Math.min(r, n); o < i; ++o) {if (t[o] !== e[o]) {r = t[o], n = e[o];break;}}return r < n ? -1 : n < r ? 1 : 0;}, u.isEncoding = function (t) {switch (String(t).toLowerCase()) {case "hex":case "utf8":case "utf-8":case "ascii":case "latin1":case "binary":case "base64":case "ucs2":case "ucs-2":case "utf16le":case "utf-16le":return !0;default:return !1;}}, u.concat = function (t, e) {if (!i(t)) throw new TypeError('"list" argument must be an Array of Buffers');if (0 === t.length) return u.alloc(0);var r;if (void 0 === e) for (e = 0, r = 0; r < t.length; ++r) {e += t[r].length;}var n = u.allocUnsafe(e),o = 0;for (r = 0; r < t.length; ++r) {var s = t[r];if (!u.isBuffer(s)) throw new TypeError('"list" argument must be an Array of Buffers');s.copy(n, o), o += s.length;}return n;}, u.byteLength = d, u.prototype._isBuffer = !0, u.prototype.swap16 = function () {var t = this.length;if (t % 2 != 0) throw new RangeError("Buffer size must be a multiple of 16-bits");for (var e = 0; e < t; e += 2) {y(this, e, e + 1);}return this;}, u.prototype.swap32 = function () {var t = this.length;if (t % 4 != 0) throw new RangeError("Buffer size must be a multiple of 32-bits");for (var e = 0; e < t; e += 4) {y(this, e, e + 3), y(this, e + 1, e + 2);}return this;}, u.prototype.swap64 = function () {var t = this.length;if (t % 8 != 0) throw new RangeError("Buffer size must be a multiple of 64-bits");for (var e = 0; e < t; e += 8) {y(this, e, e + 7), y(this, e + 1, e + 6), y(this, e + 2, e + 5), y(this, e + 3, e + 4);}return this;}, u.prototype.toString = function () {var t = 0 | this.length;return 0 === t ? "" : 0 === arguments.length ? B(this, 0, t) : function (t, e, r) {var n = !1;if ((void 0 === e || e < 0) && (e = 0), e > this.length) return "";if ((void 0 === r || r > this.length) && (r = this.length), r <= 0) return "";if ((r >>>= 0) <= (e >>>= 0)) return "";for (t || (t = "utf8");;) {switch (t) {case "hex":return T(this, e, r);case "utf8":case "utf-8":return B(this, e, r);case "ascii":return P(this, e, r);case "latin1":case "binary":return S(this, e, r);case "base64":return k(this, e, r);case "ucs2":case "ucs-2":case "utf16le":case "utf-16le":return O(this, e, r);default:if (n) throw new TypeError("Unknown encoding: " + t);t = (t + "").toLowerCase(), n = !0;}}}.apply(this, arguments);}, u.prototype.equals = function (t) {if (!u.isBuffer(t)) throw new TypeError("Argument must be a Buffer");return this === t || 0 === u.compare(this, t);}, u.prototype.inspect = function () {var t = "",r = e.INSPECT_MAX_BYTES;return this.length > 0 && (t = this.toString("hex", 0, r).match(/.{2}/g).join(" "), this.length > r && (t += " ... ")), "<Buffer " + t + ">";}, u.prototype.compare = function (t, e, r, n, o) {if (!u.isBuffer(t)) throw new TypeError("Argument must be a Buffer");if (void 0 === e && (e = 0), void 0 === r && (r = t ? t.length : 0), void 0 === n && (n = 0), void 0 === o && (o = this.length), e < 0 || r > t.length || n < 0 || o > this.length) throw new RangeError("out of range index");if (n >= o && e >= r) return 0;if (n >= o) return -1;if (e >= r) return 1;if (this === t) return 0;for (var i = (o >>>= 0) - (n >>>= 0), s = (r >>>= 0) - (e >>>= 0), a = Math.min(i, s), c = this.slice(n, o), f = t.slice(e, r), h = 0; h < a; ++h) {if (c[h] !== f[h]) {i = c[h], s = f[h];break;}}return i < s ? -1 : s < i ? 1 : 0;}, u.prototype.includes = function (t, e, r) {return -1 !== this.indexOf(t, e, r);}, u.prototype.indexOf = function (t, e, r) {return g(this, t, e, r, !0);}, u.prototype.lastIndexOf = function (t, e, r) {return g(this, t, e, r, !1);}, u.prototype.write = function (t, e, r, n) {if (void 0 === e) n = "utf8", r = this.length, e = 0;else if (void 0 === r && "string" == typeof e) n = e, r = this.length, e = 0;else {if (!isFinite(e)) throw new Error("Buffer.write(string, encoding, offset[, length]) is no longer supported");e |= 0, isFinite(r) ? (r |= 0, void 0 === n && (n = "utf8")) : (n = r, r = void 0);}var o = this.length - e;if ((void 0 === r || r > o) && (r = o), t.length > 0 && (r < 0 || e < 0) || e > this.length) throw new RangeError("Attempt to write outside buffer bounds");n || (n = "utf8");for (var i = !1;;) {switch (n) {case "hex":return b(this, t, e, r);case "utf8":case "utf-8":return m(this, t, e, r);case "ascii":return w(this, t, e, r);case "latin1":case "binary":return A(this, t, e, r);case "base64":return _(this, t, e, r);case "ucs2":case "ucs-2":case "utf16le":case "utf-16le":return E(this, t, e, r);default:if (i) throw new TypeError("Unknown encoding: " + n);n = ("" + n).toLowerCase(), i = !0;}}}, u.prototype.toJSON = function () {return { type: "Buffer", data: Array.prototype.slice.call(this._arr || this, 0) };};var R = 4096;function P(t, e, r) {var n = "";r = Math.min(t.length, r);for (var o = e; o < r; ++o) {n += String.fromCharCode(127 & t[o]);}return n;}function S(t, e, r) {var n = "";r = Math.min(t.length, r);for (var o = e; o < r; ++o) {n += String.fromCharCode(t[o]);}return n;}function T(t, e, r) {var n = t.length;(!e || e < 0) && (e = 0), (!r || r < 0 || r > n) && (r = n);for (var o = "", i = e; i < r; ++i) {o += D(t[i]);}return o;}function O(t, e, r) {for (var n = t.slice(e, r), o = "", i = 0; i < n.length; i += 2) {o += String.fromCharCode(n[i] + 256 * n[i + 1]);}return o;}function x(t, e, r) {if (t % 1 != 0 || t < 0) throw new RangeError("offset is not uint");if (t + e > r) throw new RangeError("Trying to access beyond buffer length");}function C(t, e, r, n, o, i) {if (!u.isBuffer(t)) throw new TypeError('"buffer" argument must be a Buffer instance');if (e > o || e < i) throw new RangeError('"value" argument is out of bounds');if (r + n > t.length) throw new RangeError("Index out of range");}function U(t, e, r, n) {e < 0 && (e = 65535 + e + 1);for (var o = 0, i = Math.min(t.length - r, 2); o < i; ++o) {t[r + o] = (e & 255 << 8 * (n ? o : 1 - o)) >>> 8 * (n ? o : 1 - o);}}function L(t, e, r, n) {e < 0 && (e = 4294967295 + e + 1);for (var o = 0, i = Math.min(t.length - r, 4); o < i; ++o) {t[r + o] = e >>> 8 * (n ? o : 3 - o) & 255;}}function I(t, e, r, n, o, i) {if (r + n > t.length) throw new RangeError("Index out of range");if (r < 0) throw new RangeError("Index out of range");}function N(t, e, r, n, i) {return i || I(t, 0, r, 4), o.write(t, e, r, n, 23, 4), r + 4;}function M(t, e, r, n, i) {return i || I(t, 0, r, 8), o.write(t, e, r, n, 52, 8), r + 8;}u.prototype.slice = function (t, e) {var r,n = this.length;if ((t = ~~t) < 0 ? (t += n) < 0 && (t = 0) : t > n && (t = n), (e = void 0 === e ? n : ~~e) < 0 ? (e += n) < 0 && (e = 0) : e > n && (e = n), e < t && (e = t), u.TYPED_ARRAY_SUPPORT) (r = this.subarray(t, e)).__proto__ = u.prototype;else {var o = e - t;r = new u(o, void 0);for (var i = 0; i < o; ++i) {r[i] = this[i + t];}}return r;}, u.prototype.readUIntLE = function (t, e, r) {t |= 0, e |= 0, r || x(t, e, this.length);for (var n = this[t], o = 1, i = 0; ++i < e && (o *= 256);) {n += this[t + i] * o;}return n;}, u.prototype.readUIntBE = function (t, e, r) {t |= 0, e |= 0, r || x(t, e, this.length);for (var n = this[t + --e], o = 1; e > 0 && (o *= 256);) {n += this[t + --e] * o;}return n;}, u.prototype.readUInt8 = function (t, e) {return e || x(t, 1, this.length), this[t];}, u.prototype.readUInt16LE = function (t, e) {return e || x(t, 2, this.length), this[t] | this[t + 1] << 8;}, u.prototype.readUInt16BE = function (t, e) {return e || x(t, 2, this.length), this[t] << 8 | this[t + 1];}, u.prototype.readUInt32LE = function (t, e) {return e || x(t, 4, this.length), (this[t] | this[t + 1] << 8 | this[t + 2] << 16) + 16777216 * this[t + 3];}, u.prototype.readUInt32BE = function (t, e) {return e || x(t, 4, this.length), 16777216 * this[t] + (this[t + 1] << 16 | this[t + 2] << 8 | this[t + 3]);}, u.prototype.readIntLE = function (t, e, r) {t |= 0, e |= 0, r || x(t, e, this.length);for (var n = this[t], o = 1, i = 0; ++i < e && (o *= 256);) {n += this[t + i] * o;}return n >= (o *= 128) && (n -= Math.pow(2, 8 * e)), n;}, u.prototype.readIntBE = function (t, e, r) {t |= 0, e |= 0, r || x(t, e, this.length);for (var n = e, o = 1, i = this[t + --n]; n > 0 && (o *= 256);) {i += this[t + --n] * o;}return i >= (o *= 128) && (i -= Math.pow(2, 8 * e)), i;}, u.prototype.readInt8 = function (t, e) {return e || x(t, 1, this.length), 128 & this[t] ? -1 * (255 - this[t] + 1) : this[t];}, u.prototype.readInt16LE = function (t, e) {e || x(t, 2, this.length);var r = this[t] | this[t + 1] << 8;return 32768 & r ? 4294901760 | r : r;}, u.prototype.readInt16BE = function (t, e) {e || x(t, 2, this.length);var r = this[t + 1] | this[t] << 8;return 32768 & r ? 4294901760 | r : r;}, u.prototype.readInt32LE = function (t, e) {return e || x(t, 4, this.length), this[t] | this[t + 1] << 8 | this[t + 2] << 16 | this[t + 3] << 24;}, u.prototype.readInt32BE = function (t, e) {return e || x(t, 4, this.length), this[t] << 24 | this[t + 1] << 16 | this[t + 2] << 8 | this[t + 3];}, u.prototype.readFloatLE = function (t, e) {return e || x(t, 4, this.length), o.read(this, t, !0, 23, 4);}, u.prototype.readFloatBE = function (t, e) {return e || x(t, 4, this.length), o.read(this, t, !1, 23, 4);}, u.prototype.readDoubleLE = function (t, e) {return e || x(t, 8, this.length), o.read(this, t, !0, 52, 8);}, u.prototype.readDoubleBE = function (t, e) {return e || x(t, 8, this.length), o.read(this, t, !1, 52, 8);}, u.prototype.writeUIntLE = function (t, e, r, n) {t = +t, e |= 0, r |= 0, n || C(this, t, e, r, Math.pow(2, 8 * r) - 1, 0);var o = 1,i = 0;for (this[e] = 255 & t; ++i < r && (o *= 256);) {this[e + i] = t / o & 255;}return e + r;}, u.prototype.writeUIntBE = function (t, e, r, n) {t = +t, e |= 0, r |= 0, n || C(this, t, e, r, Math.pow(2, 8 * r) - 1, 0);var o = r - 1,i = 1;for (this[e + o] = 255 & t; --o >= 0 && (i *= 256);) {this[e + o] = t / i & 255;}return e + r;}, u.prototype.writeUInt8 = function (t, e, r) {return t = +t, e |= 0, r || C(this, t, e, 1, 255, 0), u.TYPED_ARRAY_SUPPORT || (t = Math.floor(t)), this[e] = 255 & t, e + 1;}, u.prototype.writeUInt16LE = function (t, e, r) {return t = +t, e |= 0, r || C(this, t, e, 2, 65535, 0), u.TYPED_ARRAY_SUPPORT ? (this[e] = 255 & t, this[e + 1] = t >>> 8) : U(this, t, e, !0), e + 2;}, u.prototype.writeUInt16BE = function (t, e, r) {return t = +t, e |= 0, r || C(this, t, e, 2, 65535, 0), u.TYPED_ARRAY_SUPPORT ? (this[e] = t >>> 8, this[e + 1] = 255 & t) : U(this, t, e, !1), e + 2;}, u.prototype.writeUInt32LE = function (t, e, r) {return t = +t, e |= 0, r || C(this, t, e, 4, 4294967295, 0), u.TYPED_ARRAY_SUPPORT ? (this[e + 3] = t >>> 24, this[e + 2] = t >>> 16, this[e + 1] = t >>> 8, this[e] = 255 & t) : L(this, t, e, !0), e + 4;}, u.prototype.writeUInt32BE = function (t, e, r) {return t = +t, e |= 0, r || C(this, t, e, 4, 4294967295, 0), u.TYPED_ARRAY_SUPPORT ? (this[e] = t >>> 24, this[e + 1] = t >>> 16, this[e + 2] = t >>> 8, this[e + 3] = 255 & t) : L(this, t, e, !1), e + 4;}, u.prototype.writeIntLE = function (t, e, r, n) {if (t = +t, e |= 0, !n) {var o = Math.pow(2, 8 * r - 1);C(this, t, e, r, o - 1, -o);}var i = 0,s = 1,a = 0;for (this[e] = 255 & t; ++i < r && (s *= 256);) {t < 0 && 0 === a && 0 !== this[e + i - 1] && (a = 1), this[e + i] = (t / s >> 0) - a & 255;}return e + r;}, u.prototype.writeIntBE = function (t, e, r, n) {if (t = +t, e |= 0, !n) {var o = Math.pow(2, 8 * r - 1);C(this, t, e, r, o - 1, -o);}var i = r - 1,s = 1,a = 0;for (this[e + i] = 255 & t; --i >= 0 && (s *= 256);) {t < 0 && 0 === a && 0 !== this[e + i + 1] && (a = 1), this[e + i] = (t / s >> 0) - a & 255;}return e + r;}, u.prototype.writeInt8 = function (t, e, r) {return t = +t, e |= 0, r || C(this, t, e, 1, 127, -128), u.TYPED_ARRAY_SUPPORT || (t = Math.floor(t)), t < 0 && (t = 255 + t + 1), this[e] = 255 & t, e + 1;}, u.prototype.writeInt16LE = function (t, e, r) {return t = +t, e |= 0, r || C(this, t, e, 2, 32767, -32768), u.TYPED_ARRAY_SUPPORT ? (this[e] = 255 & t, this[e + 1] = t >>> 8) : U(this, t, e, !0), e + 2;}, u.prototype.writeInt16BE = function (t, e, r) {return t = +t, e |= 0, r || C(this, t, e, 2, 32767, -32768), u.TYPED_ARRAY_SUPPORT ? (this[e] = t >>> 8, this[e + 1] = 255 & t) : U(this, t, e, !1), e + 2;}, u.prototype.writeInt32LE = function (t, e, r) {return t = +t, e |= 0, r || C(this, t, e, 4, 2147483647, -2147483648), u.TYPED_ARRAY_SUPPORT ? (this[e] = 255 & t, this[e + 1] = t >>> 8, this[e + 2] = t >>> 16, this[e + 3] = t >>> 24) : L(this, t, e, !0), e + 4;}, u.prototype.writeInt32BE = function (t, e, r) {return t = +t, e |= 0, r || C(this, t, e, 4, 2147483647, -2147483648), t < 0 && (t = 4294967295 + t + 1), u.TYPED_ARRAY_SUPPORT ? (this[e] = t >>> 24, this[e + 1] = t >>> 16, this[e + 2] = t >>> 8, this[e + 3] = 255 & t) : L(this, t, e, !1), e + 4;}, u.prototype.writeFloatLE = function (t, e, r) {return N(this, t, e, !0, r);}, u.prototype.writeFloatBE = function (t, e, r) {return N(this, t, e, !1, r);}, u.prototype.writeDoubleLE = function (t, e, r) {return M(this, t, e, !0, r);}, u.prototype.writeDoubleBE = function (t, e, r) {return M(this, t, e, !1, r);}, u.prototype.copy = function (t, e, r, n) {if (r || (r = 0), n || 0 === n || (n = this.length), e >= t.length && (e = t.length), e || (e = 0), n > 0 && n < r && (n = r), n === r) return 0;if (0 === t.length || 0 === this.length) return 0;if (e < 0) throw new RangeError("targetStart out of bounds");if (r < 0 || r >= this.length) throw new RangeError("sourceStart out of bounds");if (n < 0) throw new RangeError("sourceEnd out of bounds");n > this.length && (n = this.length), t.length - e < n - r && (n = t.length - e + r);var o,i = n - r;if (this === t && r < e && e < n) for (o = i - 1; o >= 0; --o) {t[o + e] = this[o + r];} else if (i < 1e3 || !u.TYPED_ARRAY_SUPPORT) for (o = 0; o < i; ++o) {t[o + e] = this[o + r];} else Uint8Array.prototype.set.call(t, this.subarray(r, r + i), e);return i;}, u.prototype.fill = function (t, e, r, n) {if ("string" == typeof t) {if ("string" == typeof e ? (n = e, e = 0, r = this.length) : "string" == typeof r && (n = r, r = this.length), 1 === t.length) {var o = t.charCodeAt(0);o < 256 && (t = o);}if (void 0 !== n && "string" != typeof n) throw new TypeError("encoding must be a string");if ("string" == typeof n && !u.isEncoding(n)) throw new TypeError("Unknown encoding: " + n);} else "number" == typeof t && (t &= 255);if (e < 0 || this.length < e || this.length < r) throw new RangeError("Out of range index");if (r <= e) return this;var i;if (e >>>= 0, r = void 0 === r ? this.length : r >>> 0, t || (t = 0), "number" == typeof t) for (i = e; i < r; ++i) {this[i] = t;} else {var s = u.isBuffer(t) ? t : j(new u(t, n).toString()),a = s.length;for (i = 0; i < r - e; ++i) {this[i + e] = s[i % a];}}return this;};var Y = /[^+\/0-9A-Za-z-_]/g;function D(t) {return t < 16 ? "0" + t.toString(16) : t.toString(16);}function j(t, e) {var r;e = e || 1 / 0;for (var n = t.length, o = null, i = [], s = 0; s < n; ++s) {if ((r = t.charCodeAt(s)) > 55295 && r < 57344) {if (!o) {if (r > 56319) {(e -= 3) > -1 && i.push(239, 191, 189);continue;}if (s + 1 === n) {(e -= 3) > -1 && i.push(239, 191, 189);continue;}o = r;continue;}if (r < 56320) {(e -= 3) > -1 && i.push(239, 191, 189), o = r;continue;}r = 65536 + (o - 55296 << 10 | r - 56320);} else o && (e -= 3) > -1 && i.push(239, 191, 189);if (o = null, r < 128) {if ((e -= 1) < 0) break;i.push(r);} else if (r < 2048) {if ((e -= 2) < 0) break;i.push(r >> 6 | 192, 63 & r | 128);} else if (r < 65536) {if ((e -= 3) < 0) break;i.push(r >> 12 | 224, r >> 6 & 63 | 128, 63 & r | 128);} else {if (!(r < 1114112)) throw new Error("Invalid code point");if ((e -= 4) < 0) break;i.push(r >> 18 | 240, r >> 12 & 63 | 128, r >> 6 & 63 | 128, 63 & r | 128);}}return i;}function q(t) {return n.toByteArray(function (t) {if ((t = function (t) {return t.trim ? t.trim() : t.replace(/^\s+|\s+$/g, "");}(t).replace(Y, "")).length < 2) return "";for (; t.length % 4 != 0;) {t += "=";}return t;}(t));}function F(t, e, r, n) {for (var o = 0; o < n && !(o + r >= e.length || o >= t.length); ++o) {e[o + r] = t[o];}return o;}}).call(this, r(1));}, function (t, e, r) {(function (e) {var n = r(2),o = Object.prototype.toString,i = "function" == typeof Blob || "undefined" != typeof Blob && "[object BlobConstructor]" === o.call(Blob),s = "function" == typeof File || "undefined" != typeof File && "[object FileConstructor]" === o.call(File);t.exports = function t(r) {if (!r || "object" != typeof r) return !1;if (n(r)) {for (var o = 0, a = r.length; o < a; o++) {if (t(r[o])) return !0;}return !1;}if ("function" == typeof e && e.isBuffer && e.isBuffer(r) || "function" == typeof ArrayBuffer && r instanceof ArrayBuffer || i && r instanceof Blob || s && r instanceof File) return !0;if (r.toJSON && "function" == typeof r.toJSON && 1 === arguments.length) return t(r.toJSON(), !0);for (var u in r) {if (Object.prototype.hasOwnProperty.call(r, u) && t(r[u])) return !0;}return !1;};}).call(this, r(15).Buffer);}, function (t, e) {e.encode = function (t) {var e = "";for (var r in t) {t.hasOwnProperty(r) && (e.length && (e += "&"), e += encodeURIComponent(r) + "=" + encodeURIComponent(t[r]));}return e;}, e.decode = function (t) {for (var e = {}, r = t.split("&"), n = 0, o = r.length; n < o; n++) {var i = r[n].split("=");e[decodeURIComponent(i[0])] = decodeURIComponent(i[1]);}return e;};}, function (t, e) {t.exports = function (t, e) {for (var r = [], n = (e = e || 0) || 0; n < t.length; n++) {r[n - e] = t[n];}return r;};}, function (t, e, r) {window, t.exports = function (t) {var e = {};function r(n) {if (e[n]) return e[n].exports;var o = e[n] = { i: n, l: !1, exports: {} };return t[n].call(o.exports, o, o.exports, r), o.l = !0, o.exports;}return r.m = t, r.c = e, r.d = function (t, e, n) {r.o(t, e) || Object.defineProperty(t, e, { enumerable: !0, get: n });}, r.r = function (t) {"undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(t, Symbol.toStringTag, { value: "Module" }), Object.defineProperty(t, "__esModule", { value: !0 });}, r.t = function (t, e) {if (1 & e && (t = r(t)), 8 & e) return t;if (4 & e && "object" == typeof t && t && t.__esModule) return t;var n = Object.create(null);if (r.r(n), Object.defineProperty(n, "default", { enumerable: !0, value: t }), 2 & e && "string" != typeof t) for (var o in t) {r.d(n, o, function (e) {return t[e];}.bind(null, o));}return n;}, r.n = function (t) {var e = t && t.__esModule ? function () {return t.default;} : function () {return t;};return r.d(e, "a", e), e;}, r.o = function (t, e) {return Object.prototype.hasOwnProperty.call(t, e);}, r.p = "", r(r.s = 29);}([function (t, e) {var r;r = function () {return this;}();try {r = r || Function("return this")() || (0, eval)("this");} catch (t) {"object" == typeof window && (r = window);}t.exports = r;}, function (t, e, r) {(function (t) {var n,o = r(26),i = r(25),s = r(19),a = r(18),u = r(17);t && t.ArrayBuffer && (n = r(15));var c = "undefined" != typeof navigator && /Android/i.test(navigator.userAgent),f = "undefined" != typeof navigator && /PhantomJS/i.test(navigator.userAgent),h = c || f;e.protocol = 3;var p = e.packets = { open: 0, close: 1, ping: 2, pong: 3, message: 4, upgrade: 5, noop: 6 },l = o(p),d = { type: "error", data: "parser error" },y = r(14);function g(t, e, r) {for (var n = new Array(t.length), o = a(t.length, r), i = function i(t, r, o) {e(r, function (e, r) {n[t] = r, o(e, n);});}, s = 0; s < t.length; s++) {i(s, t[s], o);}}e.encodePacket = function (r, n, o, i) {"function" == typeof n && (i = n, n = !1), "function" == typeof o && (i = o, o = null);var s = void 0 === r.data ? void 0 : r.data.buffer || r.data;if (t.ArrayBuffer && s instanceof ArrayBuffer) return function (t, r, n) {if (!r) return e.encodeBase64Packet(t, n);var o = t.data,i = new Uint8Array(o),s = new Uint8Array(1 + o.byteLength);s[0] = p[t.type];for (var a = 0; a < i.length; a++) {s[a + 1] = i[a];}return n(s.buffer);}(r, n, i);if (y && s instanceof t.Blob) return function (t, r, n) {if (!r) return e.encodeBase64Packet(t, n);if (h) return function (t, r, n) {if (!r) return e.encodeBase64Packet(t, n);var o = new FileReader();return o.onload = function () {t.data = o.result, e.encodePacket(t, r, !0, n);}, o.readAsArrayBuffer(t.data);}(t, r, n);var o = new Uint8Array(1);return o[0] = p[t.type], n(new y([o.buffer, t.data]));}(r, n, i);if (s && s.base64) return function (t, r) {return i("b" + e.packets[t.type] + t.data.data);}(r);var a = p[r.type];return void 0 !== r.data && (a += o ? u.encode(String(r.data), { strict: !1 }) : String(r.data)), i("" + a);}, e.encodeBase64Packet = function (r, n) {var o,i = "b" + e.packets[r.type];if (y && r.data instanceof t.Blob) {var s = new FileReader();return s.onload = function () {var t = s.result.split(",")[1];n(i + t);}, s.readAsDataURL(r.data);}try {o = String.fromCharCode.apply(null, new Uint8Array(r.data));} catch (t) {for (var a = new Uint8Array(r.data), u = new Array(a.length), c = 0; c < a.length; c++) {u[c] = a[c];}o = String.fromCharCode.apply(null, u);}return i += t.btoa(o), n(i);}, e.decodePacket = function (t, r, n) {if (void 0 === t) return d;if ("string" == typeof t) {if ("b" === t.charAt(0)) return e.decodeBase64Packet(t.substr(1), r);if (n && !1 === (t = function (t) {try {t = u.decode(t, { strict: !1 });} catch (t) {return !1;}return t;}(t))) return d;var o = t.charAt(0);return Number(o) == o && l[o] ? t.length > 1 ? { type: l[o], data: t.substring(1) } : { type: l[o] } : d;}o = new Uint8Array(t)[0];var i = s(t, 1);return y && "blob" === r && (i = new y([i])), { type: l[o], data: i };}, e.decodeBase64Packet = function (t, e) {var r = l[t.charAt(0)];if (!n) return { type: r, data: { base64: !0, data: t.substr(1) } };var o = n.decode(t.substr(1));return "blob" === e && y && (o = new y([o])), { type: r, data: o };}, e.encodePayload = function (t, r, n) {"function" == typeof r && (n = r, r = null);var o = i(t);return r && o ? y && !h ? e.encodePayloadAsBlob(t, n) : e.encodePayloadAsArrayBuffer(t, n) : t.length ? void g(t, function (t, n) {e.encodePacket(t, !!o && r, !1, function (t) {n(null, function (t) {return t.length + ":" + t;}(t));});}, function (t, e) {return n(e.join(""));}) : n("0:");}, e.decodePayload = function (t, r, n) {if ("string" != typeof t) return e.decodePayloadAsBinary(t, r, n);var o;if ("function" == typeof r && (n = r, r = null), "" === t) return n(d, 0, 1);for (var i, s, a = "", u = 0, c = t.length; u < c; u++) {var f = t.charAt(u);if (":" === f) {if ("" === a || a != (i = Number(a))) return n(d, 0, 1);if (a != (s = t.substr(u + 1, i)).length) return n(d, 0, 1);if (s.length) {if (o = e.decodePacket(s, r, !1), d.type === o.type && d.data === o.data) return n(d, 0, 1);if (!1 === n(o, u + i, c)) return;}u += i, a = "";} else a += f;}return "" !== a ? n(d, 0, 1) : void 0;}, e.encodePayloadAsArrayBuffer = function (t, r) {if (!t.length) return r(new ArrayBuffer(0));g(t, function (t, r) {e.encodePacket(t, !0, !0, function (t) {return r(null, t);});}, function (t, e) {var n = e.reduce(function (t, e) {var r;return t + (r = "string" == typeof e ? e.length : e.byteLength).toString().length + r + 2;}, 0),o = new Uint8Array(n),i = 0;return e.forEach(function (t) {var e = "string" == typeof t,r = t;if (e) {for (var n = new Uint8Array(t.length), s = 0; s < t.length; s++) {n[s] = t.charCodeAt(s);}r = n.buffer;}o[i++] = e ? 0 : 1;var a = r.byteLength.toString();for (s = 0; s < a.length; s++) {o[i++] = parseInt(a[s]);}for (o[i++] = 255, n = new Uint8Array(r), s = 0; s < n.length; s++) {o[i++] = n[s];}}), r(o.buffer);});}, e.encodePayloadAsBlob = function (t, r) {g(t, function (t, r) {e.encodePacket(t, !0, !0, function (t) {var e = new Uint8Array(1);if (e[0] = 1, "string" == typeof t) {for (var n = new Uint8Array(t.length), o = 0; o < t.length; o++) {n[o] = t.charCodeAt(o);}t = n.buffer, e[0] = 0;}var i = (t instanceof ArrayBuffer ? t.byteLength : t.size).toString(),s = new Uint8Array(i.length + 1);for (o = 0; o < i.length; o++) {s[o] = parseInt(i[o]);}if (s[i.length] = 255, y) {var a = new y([e.buffer, s.buffer, t]);r(null, a);}});}, function (t, e) {return r(new y(e));});}, e.decodePayloadAsBinary = function (t, r, n) {"function" == typeof r && (n = r, r = null);for (var o = t, i = []; o.byteLength > 0;) {for (var a = new Uint8Array(o), u = 0 === a[0], c = "", f = 1; 255 !== a[f]; f++) {if (c.length > 310) return n(d, 0, 1);c += a[f];}o = s(o, 2 + c.length), c = parseInt(c);var h = s(o, 0, c);if (u) try {h = String.fromCharCode.apply(null, new Uint8Array(h));} catch (t) {var p = new Uint8Array(h);for (h = "", f = 0; f < p.length; f++) {h += String.fromCharCode(p[f]);}}i.push(h), o = s(o, c);}var l = i.length;i.forEach(function (t, o) {n(e.decodePacket(t, r, !0), o, l);});};}).call(this, r(0));}, function (t, e) {t.exports = function () {return function () {};};}, function (t, e) {e.encode = function (t) {var e = "";for (var r in t) {t.hasOwnProperty(r) && (e.length && (e += "&"), e += encodeURIComponent(r) + "=" + encodeURIComponent(t[r]));}return e;}, e.decode = function (t) {for (var e = {}, r = t.split("&"), n = 0, o = r.length; n < o; n++) {var i = r[n].split("=");e[decodeURIComponent(i[0])] = decodeURIComponent(i[1]);}return e;};}, function (t, e, r) {function n(t) {if (t) return function (t) {for (var e in n.prototype) {t[e] = n.prototype[e];}return t;}(t);}t.exports = n, n.prototype.on = n.prototype.addEventListener = function (t, e) {return this._callbacks = this._callbacks || {}, (this._callbacks["$" + t] = this._callbacks["$" + t] || []).push(e), this;}, n.prototype.once = function (t, e) {function r() {this.off(t, r), e.apply(this, arguments);}return r.fn = e, this.on(t, r), this;}, n.prototype.off = n.prototype.removeListener = n.prototype.removeAllListeners = n.prototype.removeEventListener = function (t, e) {if (this._callbacks = this._callbacks || {}, 0 == arguments.length) return this._callbacks = {}, this;var r,n = this._callbacks["$" + t];if (!n) return this;if (1 == arguments.length) return delete this._callbacks["$" + t], this;for (var o = 0; o < n.length; o++) {if ((r = n[o]) === e || r.fn === e) {n.splice(o, 1);break;}}return this;}, n.prototype.emit = function (t) {this._callbacks = this._callbacks || {};var e = [].slice.call(arguments, 1),r = this._callbacks["$" + t];if (r) for (var n = 0, o = (r = r.slice(0)).length; n < o; ++n) {r[n].apply(this, e);}return this;}, n.prototype.listeners = function (t) {return this._callbacks = this._callbacks || {}, this._callbacks["$" + t] || [];}, n.prototype.hasListeners = function (t) {return !!this.listeners(t).length;};}, function (t, e, r) {var n = r(1),o = r(4);function i(t) {this.path = t.path, this.hostname = t.hostname, this.port = t.port, this.secure = t.secure, this.query = t.query, this.timestampParam = t.timestampParam, this.timestampRequests = t.timestampRequests, this.readyState = "", this.agent = t.agent || !1, this.socket = t.socket, this.enablesXDR = t.enablesXDR, this.pfx = t.pfx, this.key = t.key, this.passphrase = t.passphrase, this.cert = t.cert, this.ca = t.ca, this.ciphers = t.ciphers, this.rejectUnauthorized = t.rejectUnauthorized, this.forceNode = t.forceNode, this.extraHeaders = t.extraHeaders, this.localAddress = t.localAddress;}t.exports = i, o(i.prototype), i.prototype.onError = function (t, e) {var r = new Error(t);return r.type = "TransportError", r.description = e, this.emit("error", r), this;}, i.prototype.open = function () {return "closed" !== this.readyState && "" !== this.readyState || (this.readyState = "opening", this.doOpen()), this;}, i.prototype.close = function () {return "opening" !== this.readyState && "open" !== this.readyState || (this.doClose(), this.onClose()), this;}, i.prototype.send = function (t) {if ("open" !== this.readyState) throw new Error("Transport not open");this.write(t);}, i.prototype.onOpen = function () {this.readyState = "open", this.writable = !0, this.emit("open");}, i.prototype.onData = function (t) {var e = n.decodePacket(t, this.socket.binaryType);this.onPacket(e);}, i.prototype.onPacket = function (t) {this.emit("packet", t);}, i.prototype.onClose = function () {this.readyState = "closed", this.emit("close");};}, function (t, e, r) {var n = r(27);e.websocket = n;}, function (t, e) {var r = /^(?:(?![^:@]+:[^:@\/]*@)(http|https|ws|wss):\/\/)?((?:(([^:@]*)(?::([^:@]*))?)?@)?((?:[a-f0-9]{0,4}:){2,7}[a-f0-9]{0,4}|[^:\/?#]*)(?::(\d*))?)(((\/(?:[^?#](?![^?#\/]*\.[^?#\/.]+(?:[?#]|$)))*\/?)?([^?#\/]*))(?:\?([^#]*))?(?:#(.*))?)/,n = ["source", "protocol", "authority", "userInfo", "user", "password", "host", "port", "relative", "path", "directory", "file", "query", "anchor"];t.exports = function (t) {var e = t,o = t.indexOf("["),i = t.indexOf("]");-1 != o && -1 != i && (t = t.substring(0, o) + t.substring(o, i).replace(/:/g, ";") + t.substring(i, t.length));for (var s = r.exec(t || ""), a = {}, u = 14; u--;) {a[n[u]] = s[u] || "";}return -1 != o && -1 != i && (a.source = e, a.host = a.host.substring(1, a.host.length - 1).replace(/;/g, ":"), a.authority = a.authority.replace("[", "").replace("]", "").replace(/;/g, ":"), a.ipv6uri = !0), a;};}, function (t, e) {var r = [].indexOf;t.exports = function (t, e) {if (r) return t.indexOf(e);for (var n = 0; n < t.length; ++n) {if (t[n] === e) return n;}return -1;};}, function (t, e, r) {"use strict";var n = function n(t, e) {_classCallCheck(this, n);this.target = e, this.type = t;};var o = /*#__PURE__*/function (_n) {_inherits(o, _n);function o(t, e) {var _this;_classCallCheck(this, o);_this = _possibleConstructorReturn(this, _getPrototypeOf(o).call(this, "message", e)), _this.data = t;return _this;}return o;}(n);var i = /*#__PURE__*/function (_n2) {_inherits(i, _n2);function i(t, e, r) {var _this2;_classCallCheck(this, i);_this2 = _possibleConstructorReturn(this, _getPrototypeOf(i).call(this, "close", r)), _this2.wasClean = r._closeFrameReceived && r._closeFrameSent, _this2.reason = e, _this2.code = t;return _this2;}return i;}(n);var s = /*#__PURE__*/function (_n3) {_inherits(s, _n3);function s(t) {_classCallCheck(this, s);return _possibleConstructorReturn(this, _getPrototypeOf(s).call(this, "open", t));}return s;}(n);var a = /*#__PURE__*/function (_n4) {_inherits(a, _n4);function a(t, e) {var _this3;_classCallCheck(this, a);_this3 = _possibleConstructorReturn(this, _getPrototypeOf(a).call(this, "error", e)), _this3.message = t.message, _this3.error = t;return _this3;}return a;}(n);var u = { addEventListener: function addEventListener(t, e) {function r(t) {e.call(this, new o(t, this));}function n(t, r) {e.call(this, new i(t, r, this));}function u(t) {e.call(this, new a(t, this));}function c() {e.call(this, new s(this));}"function" == typeof e && ("message" === t ? (r._listener = e, this.on(t, r)) : "close" === t ? (n._listener = e, this.on(t, n)) : "error" === t ? (u._listener = e, this.on(t, u)) : "open" === t ? (c._listener = e, this.on(t, c)) : this.on(t, e));}, removeEventListener: function removeEventListener(t, e) {var r = this.listeners(t);for (var n = 0; n < r.length; n++) {r[n] !== e && r[n]._listener !== e || this.removeListener(t, r[n]);}} };t.exports = u;}, function (t, e) {function r() {this._events = this._events || {}, this._maxListeners = this._maxListeners || void 0;}function n(t) {return "function" == typeof t;}function o(t) {return "object" == typeof t && null !== t;}function i(t) {return void 0 === t;}t.exports = r, r.EventEmitter = r, r.prototype._events = void 0, r.prototype._maxListeners = void 0, r.defaultMaxListeners = 10, r.prototype.setMaxListeners = function (t) {if ("number" != typeof t || t < 0 || isNaN(t)) throw TypeError("n must be a positive number");return this._maxListeners = t, this;}, r.prototype.emit = function (t) {var e, r, s, a, u, c;if (this._events || (this._events = {}), "error" === t && (!this._events.error || o(this._events.error) && !this._events.error.length)) {if ((e = arguments[1]) instanceof Error) throw e;var f = new Error('Uncaught, unspecified "error" event. (' + e + ")");throw f.context = e, f;}if (i(r = this._events[t])) return !1;if (n(r)) switch (arguments.length) {case 1:r.call(this);break;case 2:r.call(this, arguments[1]);break;case 3:r.call(this, arguments[1], arguments[2]);break;default:a = Array.prototype.slice.call(arguments, 1), r.apply(this, a);} else if (o(r)) for (a = Array.prototype.slice.call(arguments, 1), s = (c = r.slice()).length, u = 0; u < s; u++) {c[u].apply(this, a);}return !0;}, r.prototype.addListener = function (t, e) {var s;if (!n(e)) throw TypeError("listener must be a function");return this._events || (this._events = {}), this._events.newListener && this.emit("newListener", t, n(e.listener) ? e.listener : e), this._events[t] ? o(this._events[t]) ? this._events[t].push(e) : this._events[t] = [this._events[t], e] : this._events[t] = e, o(this._events[t]) && !this._events[t].warned && (s = i(this._maxListeners) ? r.defaultMaxListeners : this._maxListeners) && s > 0 && this._events[t].length > s && (this._events[t].warned = !0, console.error("(node) warning: possible EventEmitter memory leak detected. %d listeners added. Use emitter.setMaxListeners() to increase limit.", this._events[t].length), "function" == typeof console.trace && console.trace()), this;}, r.prototype.on = r.prototype.addListener, r.prototype.once = function (t, e) {if (!n(e)) throw TypeError("listener must be a function");var r = !1;function o() {this.removeListener(t, o), r || (r = !0, e.apply(this, arguments));}return o.listener = e, this.on(t, o), this;}, r.prototype.removeListener = function (t, e) {var r, i, s, a;if (!n(e)) throw TypeError("listener must be a function");if (!this._events || !this._events[t]) return this;if (s = (r = this._events[t]).length, i = -1, r === e || n(r.listener) && r.listener === e) delete this._events[t], this._events.removeListener && this.emit("removeListener", t, e);else if (o(r)) {for (a = s; a-- > 0;) {if (r[a] === e || r[a].listener && r[a].listener === e) {i = a;break;}}if (i < 0) return this;1 === r.length ? (r.length = 0, delete this._events[t]) : r.splice(i, 1), this._events.removeListener && this.emit("removeListener", t, e);}return this;}, r.prototype.removeAllListeners = function (t) {var e, r;if (!this._events) return this;if (!this._events.removeListener) return 0 === arguments.length ? this._events = {} : this._events[t] && delete this._events[t], this;if (0 === arguments.length) {for (e in this._events) {"removeListener" !== e && this.removeAllListeners(e);}return this.removeAllListeners("removeListener"), this._events = {}, this;}if (n(r = this._events[t])) this.removeListener(t, r);else if (r) for (; r.length;) {this.removeListener(t, r[r.length - 1]);}return delete this._events[t], this;}, r.prototype.listeners = function (t) {return this._events && this._events[t] ? n(this._events[t]) ? [this._events[t]] : this._events[t].slice() : [];}, r.prototype.listenerCount = function (t) {if (this._events) {var e = this._events[t];if (n(e)) return 1;if (e) return e.length;}return 0;}, r.listenerCount = function (t, e) {return t.listenerCount(e);};}, function (t, e, r) {var n = r(10),o = r(9),i = r(2)("weapp-socket:"),s = ["CONNECTING", "OPEN", "CLOSING", "CLOSED"];var a = /*#__PURE__*/function (_n5) {_inherits(a, _n5);function a(t, e, r) {var _this4;_classCallCheck(this, a);_this4 = _possibleConstructorReturn(this, _getPrototypeOf(a).call(this)), _this4.readyState = a.CONNECTING, _this4.protocol = "", _this4._socket = null, null !== t && (Array.isArray(e) ? e = e.join(", ") : "object" == typeof e && null !== e && (r = e, e = void 0), function (t, e, r) {Object.assign(r, { url: t, header: { "content-type": "application/json" }, protocols: e, method: "GET" }), this._socket = function (t) {var e = wx.connectSocket(t);return i("socketTask: ", e), e || { onClose: wx.onSocketClose, onOpen: wx.onSocketOpen, onError: wx.onSocketError, onMessage: wx.onSocketMessage, send: wx.sendSocketMessage, close: wx.closeSocket };}(r), this.addSocketEventListeners();}.call(_assertThisInitialized(_assertThisInitialized(_this4)), t, e, r));return _this4;}_createClass(a, [{ key: "addSocketEventListeners", value: function addSocketEventListeners() {var _this5 = this;this._socket.onOpen(function () {_this5.readyState = a.OPEN, _this5.onopen();}), this._socket.onClose(function (t) {i("onclose: ", t), _this5.readyState = a.CLOSED, _this5.onclose(t.code, t.reason);}), this._socket.onError(function (t) {i("onerror: ", t), _this5.onerror(t);}), this._socket.onMessage(function (t) {_this5.onmessage(t);});} }, { key: "send", value: function send(t) {i("send data: ", t, this.readyState), this.readyState === a.OPEN && this._socket.send({ data: t });} }, { key: "close", value: function close(t, e) {i("close socket: ", t, e), this.readyState = a.CLOSING, this._socket.close({ code: t, reason: e });} }, { key: "CONNECTING", get: function get() {return a.CONNECTING;} }, { key: "CLOSING", get: function get() {return a.CLOSING;} }, { key: "CLOSED", get: function get() {return a.CLOSED;} }, { key: "OPEN", get: function get() {return a.OPEN;} }]);return a;}(n);s.forEach(function (t, e) {a[s[e]] = e;}), ["open", "error", "close", "message"].forEach(function (t) {Object.defineProperty(a.prototype, "on".concat(t), { get: function get() {var e = this.listeners(t);for (var r = 0; r < e.length; r++) {if (e[r]._listener) return e[r]._listener;}}, set: function set(e) {var r = this.listeners(t);for (var n = 0; n < r.length; n++) {r[n]._listener && this.removeListener(t, r[n]);}this.addEventListener(t, e);} });}), a.prototype.addEventListener = o.addEventListener, a.prototype.removeEventListener = o.removeEventListener, t.exports = a;}, function (t, e, r) {"use strict";var n,o = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz-_".split(""),i = 64,s = {},a = 0,u = 0;function c(t) {var e = "";do {e = o[t % i] + e, t = Math.floor(t / i);} while (t > 0);return e;}function f() {var t = c(+new Date());return t !== n ? (a = 0, n = t) : t + "." + c(a++);}for (; u < i; u++) {s[o[u]] = u;}f.encode = c, f.decode = function (t) {var e = 0;for (u = 0; u < t.length; u++) {e = e * i + s[t.charAt(u)];}return e;}, t.exports = f;}, function (t, e) {t.exports = function (t, e) {var r = function r() {};r.prototype = e.prototype, t.prototype = new r(), t.prototype.constructor = t;};}, function (t, e, r) {(function (e) {var r = e.BlobBuilder || e.WebKitBlobBuilder || e.MSBlobBuilder || e.MozBlobBuilder,n = function () {try {return 2 === new Blob(["hi"]).size;} catch (t) {return !1;}}(),o = n && function () {try {return 2 === new Blob([new Uint8Array([1, 2])]).size;} catch (t) {return !1;}}(),i = r && r.prototype.append && r.prototype.getBlob;function s(t) {for (var e = 0; e < t.length; e++) {var r = t[e];if (r.buffer instanceof ArrayBuffer) {var n = r.buffer;if (r.byteLength !== n.byteLength) {var o = new Uint8Array(r.byteLength);o.set(new Uint8Array(n, r.byteOffset, r.byteLength)), n = o.buffer;}t[e] = n;}}}t.exports = n ? o ? e.Blob : function (t, e) {return s(t), new Blob(t, e || {});} : i ? function (t, e) {e = e || {};var n = new r();s(t);for (var o = 0; o < t.length; o++) {n.append(t[o]);}return e.type ? n.getBlob(e.type) : n.getBlob();} : void 0;}).call(this, r(0));}, function (t, e) {!function () {"use strict";for (var t = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/", r = new Uint8Array(256), n = 0; n < t.length; n++) {r[t.charCodeAt(n)] = n;}e.encode = function (e) {var r,n = new Uint8Array(e),o = n.length,i = "";for (r = 0; r < o; r += 3) {i += t[n[r] >> 2], i += t[(3 & n[r]) << 4 | n[r + 1] >> 4], i += t[(15 & n[r + 1]) << 2 | n[r + 2] >> 6], i += t[63 & n[r + 2]];}return o % 3 == 2 ? i = i.substring(0, i.length - 1) + "=" : o % 3 == 1 && (i = i.substring(0, i.length - 2) + "=="), i;}, e.decode = function (t) {var e,n,o,i,s,a = .75 * t.length,u = t.length,c = 0;"=" === t[t.length - 1] && (a--, "=" === t[t.length - 2] && a--);var f = new ArrayBuffer(a),h = new Uint8Array(f);for (e = 0; e < u; e += 4) {n = r[t.charCodeAt(e)], o = r[t.charCodeAt(e + 1)], i = r[t.charCodeAt(e + 2)], s = r[t.charCodeAt(e + 3)], h[c++] = n << 2 | o >> 4, h[c++] = (15 & o) << 4 | i >> 2, h[c++] = (3 & i) << 6 | 63 & s;}return f;};}();}, function (t, e) {t.exports = function (t) {return t.webpackPolyfill || (t.deprecate = function () {}, t.paths = [], t.children || (t.children = []), Object.defineProperty(t, "loaded", { enumerable: !0, get: function get() {return t.l;} }), Object.defineProperty(t, "id", { enumerable: !0, get: function get() {return t.i;} }), t.webpackPolyfill = 1), t;};}, function (t, e, r) {(function (t, n) {var o;!function (i) {var s = ("object" == typeof t && t && t.exports, "object" == typeof n && n);s.global !== s && s.window;var a,u,c,f = String.fromCharCode;function h(t) {for (var e, r, n = [], o = 0, i = t.length; o < i;) {(e = t.charCodeAt(o++)) >= 55296 && e <= 56319 && o < i ? 56320 == (64512 & (r = t.charCodeAt(o++))) ? n.push(((1023 & e) << 10) + (1023 & r) + 65536) : (n.push(e), o--) : n.push(e);}return n;}function p(t, e) {if (t >= 55296 && t <= 57343) {if (e) throw Error("Lone surrogate U+" + t.toString(16).toUpperCase() + " is not a scalar value");return !1;}return !0;}function l(t, e) {return f(t >> e & 63 | 128);}function d(t, e) {if (0 == (4294967168 & t)) return f(t);var r = "";return 0 == (4294965248 & t) ? r = f(t >> 6 & 31 | 192) : 0 == (4294901760 & t) ? (p(t, e) || (t = 65533), r = f(t >> 12 & 15 | 224), r += l(t, 6)) : 0 == (4292870144 & t) && (r = f(t >> 18 & 7 | 240), r += l(t, 12), r += l(t, 6)), r + f(63 & t | 128);}function y() {if (c >= u) throw Error("Invalid byte index");var t = 255 & a[c];if (c++, 128 == (192 & t)) return 63 & t;throw Error("Invalid continuation byte");}function g(t) {var e, r;if (c > u) throw Error("Invalid byte index");if (c == u) return !1;if (e = 255 & a[c], c++, 0 == (128 & e)) return e;if (192 == (224 & e)) {if ((r = (31 & e) << 6 | y()) >= 128) return r;throw Error("Invalid continuation byte");}if (224 == (240 & e)) {if ((r = (15 & e) << 12 | y() << 6 | y()) >= 2048) return p(r, t) ? r : 65533;throw Error("Invalid continuation byte");}if (240 == (248 & e) && (r = (7 & e) << 18 | y() << 12 | y() << 6 | y()) >= 65536 && r <= 1114111) return r;throw Error("Invalid UTF-8 detected");}var v = { version: "2.1.2", encode: function encode(t, e) {for (var r = !1 !== (e = e || {}).strict, n = h(t), o = n.length, i = -1, s = ""; ++i < o;) {s += d(n[i], r);}return s;}, decode: function decode(t, e) {var r = !1 !== (e = e || {}).strict;a = h(t), u = a.length, c = 0;for (var n, o = []; !1 !== (n = g(r));) {o.push(n);}return function (t) {for (var e, r = t.length, n = -1, o = ""; ++n < r;) {(e = t[n]) > 65535 && (o += f((e -= 65536) >>> 10 & 1023 | 55296), e = 56320 | 1023 & e), o += f(e);}return o;}(o);} };void 0 === (o = function () {return v;}.call(e, r, e, t)) || (t.exports = o);}();}).call(this, r(16)(t), r(0));}, function (t, e) {function r() {}t.exports = function (t, e, n) {var o = !1;return n = n || r, i.count = t, 0 === t ? e() : i;function i(t, r) {if (i.count <= 0) throw new Error("after called too many times");--i.count, t ? (o = !0, e(t), e = n) : 0 !== i.count || o || e(null, r);}};}, function (t, e) {t.exports = function (t, e, r) {var n = t.byteLength;if (e = e || 0, r = r || n, t.slice) return t.slice(e, r);if (e < 0 && (e += n), r < 0 && (r += n), r > n && (r = n), e >= n || e >= r || 0 === n) return new ArrayBuffer(0);for (var o = new Uint8Array(t), i = new Uint8Array(r - e), s = e, a = 0; s < r; s++, a++) {i[a] = o[s];}return i.buffer;};}, function (t, e) {var r = {}.toString;t.exports = Array.isArray || function (t) {return "[object Array]" == r.call(t);};}, function (t, e) {var r = {}.toString;t.exports = Array.isArray || function (t) {return "[object Array]" == r.call(t);};}, function (t, e) {e.read = function (t, e, r, n, o) {var i,s,a = 8 * o - n - 1,u = (1 << a) - 1,c = u >> 1,f = -7,h = r ? o - 1 : 0,p = r ? -1 : 1,l = t[e + h];for (h += p, i = l & (1 << -f) - 1, l >>= -f, f += a; f > 0; i = 256 * i + t[e + h], h += p, f -= 8) {;}for (s = i & (1 << -f) - 1, i >>= -f, f += n; f > 0; s = 256 * s + t[e + h], h += p, f -= 8) {;}if (0 === i) i = 1 - c;else {if (i === u) return s ? NaN : 1 / 0 * (l ? -1 : 1);s += Math.pow(2, n), i -= c;}return (l ? -1 : 1) * s * Math.pow(2, i - n);}, e.write = function (t, e, r, n, o, i) {var s,a,u,c = 8 * i - o - 1,f = (1 << c) - 1,h = f >> 1,p = 23 === o ? Math.pow(2, -24) - Math.pow(2, -77) : 0,l = n ? 0 : i - 1,d = n ? 1 : -1,y = e < 0 || 0 === e && 1 / e < 0 ? 1 : 0;for (e = Math.abs(e), isNaN(e) || e === 1 / 0 ? (a = isNaN(e) ? 1 : 0, s = f) : (s = Math.floor(Math.log(e) / Math.LN2), e * (u = Math.pow(2, -s)) < 1 && (s--, u *= 2), (e += s + h >= 1 ? p / u : p * Math.pow(2, 1 - h)) * u >= 2 && (s++, u /= 2), s + h >= f ? (a = 0, s = f) : s + h >= 1 ? (a = (e * u - 1) * Math.pow(2, o), s += h) : (a = e * Math.pow(2, h - 1) * Math.pow(2, o), s = 0)); o >= 8; t[r + l] = 255 & a, l += d, a /= 256, o -= 8) {;}for (s = s << o | a, c += o; c > 0; t[r + l] = 255 & s, l += d, s /= 256, c -= 8) {;}t[r + l - d] |= 128 * y;};}, function (t, e, r) {"use strict";e.byteLength = function (t) {var e = c(t),r = e[0],n = e[1];return 3 * (r + n) / 4 - n;}, e.toByteArray = function (t) {for (var e, r = c(t), n = r[0], s = r[1], a = new i(NaN), u = 0, f = s > 0 ? n - 4 : n, h = 0; h < f; h += 4) {e = o[t.charCodeAt(h)] << 18 | o[t.charCodeAt(h + 1)] << 12 | o[t.charCodeAt(h + 2)] << 6 | o[t.charCodeAt(h + 3)], a[u++] = e >> 16 & 255, a[u++] = e >> 8 & 255, a[u++] = 255 & e;}return 2 === s && (e = o[t.charCodeAt(h)] << 2 | o[t.charCodeAt(h + 1)] >> 4, a[u++] = 255 & e), 1 === s && (e = o[t.charCodeAt(h)] << 10 | o[t.charCodeAt(h + 1)] << 4 | o[t.charCodeAt(h + 2)] >> 2, a[u++] = e >> 8 & 255, a[u++] = 255 & e), a;}, e.fromByteArray = function (t) {for (var e, r = t.length, o = r % 3, i = [], s = 0, a = r - o; s < a; s += 16383) {i.push(f(t, s, s + 16383 > a ? a : s + 16383));}return 1 === o ? (e = t[r - 1], i.push(n[e >> 2] + n[e << 4 & 63] + "==")) : 2 === o && (e = (t[r - 2] << 8) + t[r - 1], i.push(n[e >> 10] + n[e >> 4 & 63] + n[e << 2 & 63] + "=")), i.join("");};for (var n = [], o = [], i = "undefined" != typeof Uint8Array ? Uint8Array : Array, s = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/", a = 0, u = s.length; a < u; ++a) {n[a] = s[a], o[s.charCodeAt(a)] = a;}function c(t) {var e = t.length;if (e % 4 > 0) throw new Error("Invalid string. Length must be a multiple of 4");var r = t.indexOf("=");return -1 === r && (r = e), [r, r === e ? 0 : 4 - r % 4];}function f(t, e, r) {for (var o, i, s = [], a = e; a < r; a += 3) {o = (t[a] << 16 & 16711680) + (t[a + 1] << 8 & 65280) + (255 & t[a + 2]), s.push(n[(i = o) >> 18 & 63] + n[i >> 12 & 63] + n[i >> 6 & 63] + n[63 & i]);}return s.join("");}o["-".charCodeAt(0)] = 62, o["_".charCodeAt(0)] = 63;}, function (t, e, r) {"use strict";(function (t) {var n = r(23),o = r(22),i = r(21);function s() {return u.TYPED_ARRAY_SUPPORT ? 2147483647 : 1073741823;}function a(t, e) {if (s() < e) throw new RangeError("Invalid typed array length");return u.TYPED_ARRAY_SUPPORT ? (t = new Uint8Array(e)).__proto__ = u.prototype : (null === t && (t = new u(e)), t.length = e), t;}function u(t, e, r) {if (!(u.TYPED_ARRAY_SUPPORT || this instanceof u)) return new u(t, e, r);if ("number" == typeof t) {if ("string" == typeof e) throw new Error("If encoding is specified then the first argument must be a string");return h(this, t);}return c(this, t, e, r);}function c(t, e, r, n) {if ("number" == typeof e) throw new TypeError('"value" argument must not be a number');return "undefined" != typeof ArrayBuffer && e instanceof ArrayBuffer ? function (t, e, r, n) {if (e.byteLength, r < 0 || e.byteLength < r) throw new RangeError("'offset' is out of bounds");if (e.byteLength < r + (n || 0)) throw new RangeError("'length' is out of bounds");return e = void 0 === r && void 0 === n ? new Uint8Array(e) : void 0 === n ? new Uint8Array(e, r) : new Uint8Array(e, r, n), u.TYPED_ARRAY_SUPPORT ? (t = e).__proto__ = u.prototype : t = p(t, e), t;}(t, e, r, n) : "string" == typeof e ? function (t, e, r) {if ("string" == typeof r && "" !== r || (r = "utf8"), !u.isEncoding(r)) throw new TypeError('"encoding" must be a valid string encoding');var n = 0 | d(e, r),o = (t = a(t, n)).write(e, r);return o !== n && (t = t.slice(0, o)), t;}(t, e, r) : function (t, e) {if (u.isBuffer(e)) {var r = 0 | l(e.length);return 0 === (t = a(t, r)).length ? t : (e.copy(t, 0, 0, r), t);}if (e) {if ("undefined" != typeof ArrayBuffer && e.buffer instanceof ArrayBuffer || "length" in e) return "number" != typeof e.length || (n = e.length) != n ? a(t, 0) : p(t, e);if ("Buffer" === e.type && i(e.data)) return p(t, e.data);}var n;throw new TypeError("First argument must be a string, Buffer, ArrayBuffer, Array, or array-like object.");}(t, e);}function f(t) {if ("number" != typeof t) throw new TypeError('"size" argument must be a number');if (t < 0) throw new RangeError('"size" argument must not be negative');}function h(t, e) {if (f(e), t = a(t, e < 0 ? 0 : 0 | l(e)), !u.TYPED_ARRAY_SUPPORT) for (var r = 0; r < e; ++r) {t[r] = 0;}return t;}function p(t, e) {var r = e.length < 0 ? 0 : 0 | l(e.length);t = a(t, r);for (var n = 0; n < r; n += 1) {t[n] = 255 & e[n];}return t;}function l(t) {if (t >= s()) throw new RangeError("Attempt to allocate Buffer larger than maximum size: 0x" + s().toString(16) + " bytes");return 0 | t;}function d(t, e) {if (u.isBuffer(t)) return t.length;if ("undefined" != typeof ArrayBuffer && "function" == typeof ArrayBuffer.isView && (ArrayBuffer.isView(t) || t instanceof ArrayBuffer)) return t.byteLength;"string" != typeof t && (t = "" + t);var r = t.length;if (0 === r) return 0;for (var n = !1;;) {switch (e) {case "ascii":case "latin1":case "binary":return r;case "utf8":case "utf-8":case void 0:return j(t).length;case "ucs2":case "ucs-2":case "utf16le":case "utf-16le":return 2 * r;case "hex":return r >>> 1;case "base64":return q(t).length;default:if (n) return j(t).length;e = ("" + e).toLowerCase(), n = !0;}}}function y(t, e, r) {var n = t[e];t[e] = t[r], t[r] = n;}function g(t, e, r, n, o) {if (0 === t.length) return -1;if ("string" == typeof r ? (n = r, r = 0) : r > 2147483647 ? r = 2147483647 : r < -2147483648 && (r = -2147483648), r = +r, isNaN(r) && (r = o ? 0 : t.length - 1), r < 0 && (r = t.length + r), r >= t.length) {if (o) return -1;r = t.length - 1;} else if (r < 0) {if (!o) return -1;r = 0;}if ("string" == typeof e && (e = u.from(e, n)), u.isBuffer(e)) return 0 === e.length ? -1 : v(t, e, r, n, o);if ("number" == typeof e) return e &= 255, u.TYPED_ARRAY_SUPPORT && "function" == typeof Uint8Array.prototype.indexOf ? o ? Uint8Array.prototype.indexOf.call(t, e, r) : Uint8Array.prototype.lastIndexOf.call(t, e, r) : v(t, [e], r, n, o);throw new TypeError("val must be string, number or Buffer");}function v(t, e, r, n, o) {var i,s = 1,a = t.length,u = e.length;if (void 0 !== n && ("ucs2" === (n = String(n).toLowerCase()) || "ucs-2" === n || "utf16le" === n || "utf-16le" === n)) {if (t.length < 2 || e.length < 2) return -1;s = 2, a /= 2, u /= 2, r /= 2;}function c(t, e) {return 1 === s ? t[e] : t.readUInt16BE(e * s);}if (o) {var f = -1;for (i = r; i < a; i++) {if (c(t, i) === c(e, -1 === f ? 0 : i - f)) {if (-1 === f && (f = i), i - f + 1 === u) return f * s;} else -1 !== f && (i -= i - f), f = -1;}} else for (r + u > a && (r = a - u), i = r; i >= 0; i--) {for (var h = !0, p = 0; p < u; p++) {if (c(t, i + p) !== c(e, p)) {h = !1;break;}}if (h) return i;}return -1;}function b(t, e, r, n) {r = Number(r) || 0;var o = t.length - r;n ? (n = Number(n)) > o && (n = o) : n = o;var i = e.length;if (i % 2 != 0) throw new TypeError("Invalid hex string");n > i / 2 && (n = i / 2);for (var s = 0; s < n; ++s) {var a = parseInt(e.substr(2 * s, 2), 16);if (isNaN(a)) return s;t[r + s] = a;}return s;}function m(t, e, r, n) {return F(j(e, t.length - r), t, r, n);}function w(t, e, r, n) {return F(function (t) {for (var e = [], r = 0; r < t.length; ++r) {e.push(255 & t.charCodeAt(r));}return e;}(e), t, r, n);}function A(t, e, r, n) {return w(t, e, r, n);}function _(t, e, r, n) {return F(q(e), t, r, n);}function E(t, e, r, n) {return F(function (t, e) {for (var r, n, o, i = [], s = 0; s < t.length && !((e -= 2) < 0); ++s) {n = (r = t.charCodeAt(s)) >> 8, o = r % 256, i.push(o), i.push(n);}return i;}(e, t.length - r), t, r, n);}function k(t, e, r) {return 0 === e && r === t.length ? n.fromByteArray(t) : n.fromByteArray(t.slice(e, r));}function B(t, e, r) {r = Math.min(t.length, r);for (var n = [], o = e; o < r;) {var i,s,a,u,c = t[o],f = null,h = c > 239 ? 4 : c > 223 ? 3 : c > 191 ? 2 : 1;if (o + h <= r) switch (h) {case 1:c < 128 && (f = c);break;case 2:128 == (192 & (i = t[o + 1])) && (u = (31 & c) << 6 | 63 & i) > 127 && (f = u);break;case 3:i = t[o + 1], s = t[o + 2], 128 == (192 & i) && 128 == (192 & s) && (u = (15 & c) << 12 | (63 & i) << 6 | 63 & s) > 2047 && (u < 55296 || u > 57343) && (f = u);break;case 4:i = t[o + 1], s = t[o + 2], a = t[o + 3], 128 == (192 & i) && 128 == (192 & s) && 128 == (192 & a) && (u = (15 & c) << 18 | (63 & i) << 12 | (63 & s) << 6 | 63 & a) > 65535 && u < 1114112 && (f = u);}null === f ? (f = 65533, h = 1) : f > 65535 && (f -= 65536, n.push(f >>> 10 & 1023 | 55296), f = 56320 | 1023 & f), n.push(f), o += h;}return function (t) {var e = t.length;if (e <= R) return String.fromCharCode.apply(String, t);for (var r = "", n = 0; n < e;) {r += String.fromCharCode.apply(String, t.slice(n, n += R));}return r;}(n);}e.Buffer = u, e.SlowBuffer = function (t) {return +t != t && (t = 0), u.alloc(+t);}, e.INSPECT_MAX_BYTES = 50, u.TYPED_ARRAY_SUPPORT = void 0 !== t.TYPED_ARRAY_SUPPORT ? t.TYPED_ARRAY_SUPPORT : function () {try {var t = new Uint8Array(1);return t.__proto__ = { __proto__: Uint8Array.prototype, foo: function foo() {return 42;} }, 42 === t.foo() && "function" == typeof t.subarray && 0 === t.subarray(1, 1).byteLength;} catch (t) {return !1;}}(), e.kMaxLength = s(), u.poolSize = 8192, u._augment = function (t) {return t.__proto__ = u.prototype, t;}, u.from = function (t, e, r) {return c(null, t, e, r);}, u.TYPED_ARRAY_SUPPORT && (u.prototype.__proto__ = Uint8Array.prototype, u.__proto__ = Uint8Array, "undefined" != typeof Symbol && Symbol.species && u[Symbol.species] === u && Object.defineProperty(u, Symbol.species, { value: null, configurable: !0 })), u.alloc = function (t, e, r) {return function (t, e, r, n) {return f(e), e <= 0 ? a(t, e) : void 0 !== r ? "string" == typeof n ? a(t, e).fill(r, n) : a(t, e).fill(r) : a(t, e);}(null, t, e, r);}, u.allocUnsafe = function (t) {return h(null, t);}, u.allocUnsafeSlow = function (t) {return h(null, t);}, u.isBuffer = function (t) {return !(null == t || !t._isBuffer);}, u.compare = function (t, e) {if (!u.isBuffer(t) || !u.isBuffer(e)) throw new TypeError("Arguments must be Buffers");if (t === e) return 0;for (var r = t.length, n = e.length, o = 0, i = Math.min(r, n); o < i; ++o) {if (t[o] !== e[o]) {r = t[o], n = e[o];break;}}return r < n ? -1 : n < r ? 1 : 0;}, u.isEncoding = function (t) {switch (String(t).toLowerCase()) {case "hex":case "utf8":case "utf-8":case "ascii":case "latin1":case "binary":case "base64":case "ucs2":case "ucs-2":case "utf16le":case "utf-16le":return !0;default:return !1;}}, u.concat = function (t, e) {if (!i(t)) throw new TypeError('"list" argument must be an Array of Buffers');if (0 === t.length) return u.alloc(0);var r;if (void 0 === e) for (e = 0, r = 0; r < t.length; ++r) {e += t[r].length;}var n = u.allocUnsafe(e),o = 0;for (r = 0; r < t.length; ++r) {var s = t[r];if (!u.isBuffer(s)) throw new TypeError('"list" argument must be an Array of Buffers');s.copy(n, o), o += s.length;}return n;}, u.byteLength = d, u.prototype._isBuffer = !0, u.prototype.swap16 = function () {var t = this.length;if (t % 2 != 0) throw new RangeError("Buffer size must be a multiple of 16-bits");for (var e = 0; e < t; e += 2) {y(this, e, e + 1);}return this;}, u.prototype.swap32 = function () {var t = this.length;if (t % 4 != 0) throw new RangeError("Buffer size must be a multiple of 32-bits");for (var e = 0; e < t; e += 4) {y(this, e, e + 3), y(this, e + 1, e + 2);}return this;}, u.prototype.swap64 = function () {var t = this.length;if (t % 8 != 0) throw new RangeError("Buffer size must be a multiple of 64-bits");for (var e = 0; e < t; e += 8) {y(this, e, e + 7), y(this, e + 1, e + 6), y(this, e + 2, e + 5), y(this, e + 3, e + 4);}return this;}, u.prototype.toString = function () {var t = 0 | this.length;return 0 === t ? "" : 0 === arguments.length ? B(this, 0, t) : function (t, e, r) {var n = !1;if ((void 0 === e || e < 0) && (e = 0), e > this.length) return "";if ((void 0 === r || r > this.length) && (r = this.length), r <= 0) return "";if ((r >>>= 0) <= (e >>>= 0)) return "";for (t || (t = "utf8");;) {switch (t) {case "hex":return T(this, e, r);case "utf8":case "utf-8":return B(this, e, r);case "ascii":return P(this, e, r);case "latin1":case "binary":return S(this, e, r);case "base64":return k(this, e, r);case "ucs2":case "ucs-2":case "utf16le":case "utf-16le":return O(this, e, r);default:if (n) throw new TypeError("Unknown encoding: " + t);t = (t + "").toLowerCase(), n = !0;}}}.apply(this, arguments);}, u.prototype.equals = function (t) {if (!u.isBuffer(t)) throw new TypeError("Argument must be a Buffer");return this === t || 0 === u.compare(this, t);}, u.prototype.inspect = function () {var t = "",r = e.INSPECT_MAX_BYTES;return this.length > 0 && (t = this.toString("hex", 0, r).match(/.{2}/g).join(" "), this.length > r && (t += " ... ")), "<Buffer " + t + ">";}, u.prototype.compare = function (t, e, r, n, o) {if (!u.isBuffer(t)) throw new TypeError("Argument must be a Buffer");if (void 0 === e && (e = 0), void 0 === r && (r = t ? t.length : 0), void 0 === n && (n = 0), void 0 === o && (o = this.length), e < 0 || r > t.length || n < 0 || o > this.length) throw new RangeError("out of range index");if (n >= o && e >= r) return 0;if (n >= o) return -1;if (e >= r) return 1;if (this === t) return 0;for (var i = (o >>>= 0) - (n >>>= 0), s = (r >>>= 0) - (e >>>= 0), a = Math.min(i, s), c = this.slice(n, o), f = t.slice(e, r), h = 0; h < a; ++h) {if (c[h] !== f[h]) {i = c[h], s = f[h];break;}}return i < s ? -1 : s < i ? 1 : 0;}, u.prototype.includes = function (t, e, r) {return -1 !== this.indexOf(t, e, r);}, u.prototype.indexOf = function (t, e, r) {return g(this, t, e, r, !0);}, u.prototype.lastIndexOf = function (t, e, r) {return g(this, t, e, r, !1);}, u.prototype.write = function (t, e, r, n) {if (void 0 === e) n = "utf8", r = this.length, e = 0;else if (void 0 === r && "string" == typeof e) n = e, r = this.length, e = 0;else {if (!isFinite(e)) throw new Error("Buffer.write(string, encoding, offset[, length]) is no longer supported");e |= 0, isFinite(r) ? (r |= 0, void 0 === n && (n = "utf8")) : (n = r, r = void 0);}var o = this.length - e;if ((void 0 === r || r > o) && (r = o), t.length > 0 && (r < 0 || e < 0) || e > this.length) throw new RangeError("Attempt to write outside buffer bounds");n || (n = "utf8");for (var i = !1;;) {switch (n) {case "hex":return b(this, t, e, r);case "utf8":case "utf-8":return m(this, t, e, r);case "ascii":return w(this, t, e, r);case "latin1":case "binary":return A(this, t, e, r);case "base64":return _(this, t, e, r);case "ucs2":case "ucs-2":case "utf16le":case "utf-16le":return E(this, t, e, r);default:if (i) throw new TypeError("Unknown encoding: " + n);n = ("" + n).toLowerCase(), i = !0;}}}, u.prototype.toJSON = function () {return { type: "Buffer", data: Array.prototype.slice.call(this._arr || this, 0) };};var R = 4096;function P(t, e, r) {var n = "";r = Math.min(t.length, r);for (var o = e; o < r; ++o) {n += String.fromCharCode(127 & t[o]);}return n;}function S(t, e, r) {var n = "";r = Math.min(t.length, r);for (var o = e; o < r; ++o) {n += String.fromCharCode(t[o]);}return n;}function T(t, e, r) {var n = t.length;(!e || e < 0) && (e = 0), (!r || r < 0 || r > n) && (r = n);for (var o = "", i = e; i < r; ++i) {o += D(t[i]);}return o;}function O(t, e, r) {for (var n = t.slice(e, r), o = "", i = 0; i < n.length; i += 2) {o += String.fromCharCode(n[i] + 256 * n[i + 1]);}return o;}function x(t, e, r) {if (t % 1 != 0 || t < 0) throw new RangeError("offset is not uint");if (t + e > r) throw new RangeError("Trying to access beyond buffer length");}function C(t, e, r, n, o, i) {if (!u.isBuffer(t)) throw new TypeError('"buffer" argument must be a Buffer instance');if (e > o || e < i) throw new RangeError('"value" argument is out of bounds');if (r + n > t.length) throw new RangeError("Index out of range");}function U(t, e, r, n) {e < 0 && (e = 65535 + e + 1);for (var o = 0, i = Math.min(t.length - r, 2); o < i; ++o) {t[r + o] = (e & 255 << 8 * (n ? o : 1 - o)) >>> 8 * (n ? o : 1 - o);}}function L(t, e, r, n) {e < 0 && (e = 4294967295 + e + 1);for (var o = 0, i = Math.min(t.length - r, 4); o < i; ++o) {t[r + o] = e >>> 8 * (n ? o : 3 - o) & 255;}}function I(t, e, r, n, o, i) {if (r + n > t.length) throw new RangeError("Index out of range");if (r < 0) throw new RangeError("Index out of range");}function N(t, e, r, n, i) {return i || I(t, 0, r, 4), o.write(t, e, r, n, 23, 4), r + 4;}function M(t, e, r, n, i) {return i || I(t, 0, r, 8), o.write(t, e, r, n, 52, 8), r + 8;}u.prototype.slice = function (t, e) {var r,n = this.length;if ((t = ~~t) < 0 ? (t += n) < 0 && (t = 0) : t > n && (t = n), (e = void 0 === e ? n : ~~e) < 0 ? (e += n) < 0 && (e = 0) : e > n && (e = n), e < t && (e = t), u.TYPED_ARRAY_SUPPORT) (r = this.subarray(t, e)).__proto__ = u.prototype;else {var o = e - t;r = new u(o, void 0);for (var i = 0; i < o; ++i) {r[i] = this[i + t];}}return r;}, u.prototype.readUIntLE = function (t, e, r) {t |= 0, e |= 0, r || x(t, e, this.length);for (var n = this[t], o = 1, i = 0; ++i < e && (o *= 256);) {n += this[t + i] * o;}return n;}, u.prototype.readUIntBE = function (t, e, r) {t |= 0, e |= 0, r || x(t, e, this.length);for (var n = this[t + --e], o = 1; e > 0 && (o *= 256);) {n += this[t + --e] * o;}return n;}, u.prototype.readUInt8 = function (t, e) {return e || x(t, 1, this.length), this[t];}, u.prototype.readUInt16LE = function (t, e) {return e || x(t, 2, this.length), this[t] | this[t + 1] << 8;}, u.prototype.readUInt16BE = function (t, e) {return e || x(t, 2, this.length), this[t] << 8 | this[t + 1];}, u.prototype.readUInt32LE = function (t, e) {return e || x(t, 4, this.length), (this[t] | this[t + 1] << 8 | this[t + 2] << 16) + 16777216 * this[t + 3];}, u.prototype.readUInt32BE = function (t, e) {return e || x(t, 4, this.length), 16777216 * this[t] + (this[t + 1] << 16 | this[t + 2] << 8 | this[t + 3]);}, u.prototype.readIntLE = function (t, e, r) {t |= 0, e |= 0, r || x(t, e, this.length);for (var n = this[t], o = 1, i = 0; ++i < e && (o *= 256);) {n += this[t + i] * o;}return n >= (o *= 128) && (n -= Math.pow(2, 8 * e)), n;}, u.prototype.readIntBE = function (t, e, r) {t |= 0, e |= 0, r || x(t, e, this.length);for (var n = e, o = 1, i = this[t + --n]; n > 0 && (o *= 256);) {i += this[t + --n] * o;}return i >= (o *= 128) && (i -= Math.pow(2, 8 * e)), i;}, u.prototype.readInt8 = function (t, e) {return e || x(t, 1, this.length), 128 & this[t] ? -1 * (255 - this[t] + 1) : this[t];}, u.prototype.readInt16LE = function (t, e) {e || x(t, 2, this.length);var r = this[t] | this[t + 1] << 8;return 32768 & r ? 4294901760 | r : r;}, u.prototype.readInt16BE = function (t, e) {e || x(t, 2, this.length);var r = this[t + 1] | this[t] << 8;return 32768 & r ? 4294901760 | r : r;}, u.prototype.readInt32LE = function (t, e) {return e || x(t, 4, this.length), this[t] | this[t + 1] << 8 | this[t + 2] << 16 | this[t + 3] << 24;}, u.prototype.readInt32BE = function (t, e) {return e || x(t, 4, this.length), this[t] << 24 | this[t + 1] << 16 | this[t + 2] << 8 | this[t + 3];}, u.prototype.readFloatLE = function (t, e) {return e || x(t, 4, this.length), o.read(this, t, !0, 23, 4);}, u.prototype.readFloatBE = function (t, e) {return e || x(t, 4, this.length), o.read(this, t, !1, 23, 4);}, u.prototype.readDoubleLE = function (t, e) {return e || x(t, 8, this.length), o.read(this, t, !0, 52, 8);}, u.prototype.readDoubleBE = function (t, e) {return e || x(t, 8, this.length), o.read(this, t, !1, 52, 8);}, u.prototype.writeUIntLE = function (t, e, r, n) {t = +t, e |= 0, r |= 0, n || C(this, t, e, r, Math.pow(2, 8 * r) - 1, 0);var o = 1,i = 0;for (this[e] = 255 & t; ++i < r && (o *= 256);) {this[e + i] = t / o & 255;}return e + r;}, u.prototype.writeUIntBE = function (t, e, r, n) {t = +t, e |= 0, r |= 0, n || C(this, t, e, r, Math.pow(2, 8 * r) - 1, 0);var o = r - 1,i = 1;for (this[e + o] = 255 & t; --o >= 0 && (i *= 256);) {this[e + o] = t / i & 255;}return e + r;}, u.prototype.writeUInt8 = function (t, e, r) {return t = +t, e |= 0, r || C(this, t, e, 1, 255, 0), u.TYPED_ARRAY_SUPPORT || (t = Math.floor(t)), this[e] = 255 & t, e + 1;}, u.prototype.writeUInt16LE = function (t, e, r) {return t = +t, e |= 0, r || C(this, t, e, 2, 65535, 0), u.TYPED_ARRAY_SUPPORT ? (this[e] = 255 & t, this[e + 1] = t >>> 8) : U(this, t, e, !0), e + 2;}, u.prototype.writeUInt16BE = function (t, e, r) {return t = +t, e |= 0, r || C(this, t, e, 2, 65535, 0), u.TYPED_ARRAY_SUPPORT ? (this[e] = t >>> 8, this[e + 1] = 255 & t) : U(this, t, e, !1), e + 2;}, u.prototype.writeUInt32LE = function (t, e, r) {return t = +t, e |= 0, r || C(this, t, e, 4, 4294967295, 0), u.TYPED_ARRAY_SUPPORT ? (this[e + 3] = t >>> 24, this[e + 2] = t >>> 16, this[e + 1] = t >>> 8, this[e] = 255 & t) : L(this, t, e, !0), e + 4;}, u.prototype.writeUInt32BE = function (t, e, r) {return t = +t, e |= 0, r || C(this, t, e, 4, 4294967295, 0), u.TYPED_ARRAY_SUPPORT ? (this[e] = t >>> 24, this[e + 1] = t >>> 16, this[e + 2] = t >>> 8, this[e + 3] = 255 & t) : L(this, t, e, !1), e + 4;}, u.prototype.writeIntLE = function (t, e, r, n) {if (t = +t, e |= 0, !n) {var o = Math.pow(2, 8 * r - 1);C(this, t, e, r, o - 1, -o);}var i = 0,s = 1,a = 0;for (this[e] = 255 & t; ++i < r && (s *= 256);) {t < 0 && 0 === a && 0 !== this[e + i - 1] && (a = 1), this[e + i] = (t / s >> 0) - a & 255;}return e + r;}, u.prototype.writeIntBE = function (t, e, r, n) {if (t = +t, e |= 0, !n) {var o = Math.pow(2, 8 * r - 1);C(this, t, e, r, o - 1, -o);}var i = r - 1,s = 1,a = 0;for (this[e + i] = 255 & t; --i >= 0 && (s *= 256);) {t < 0 && 0 === a && 0 !== this[e + i + 1] && (a = 1), this[e + i] = (t / s >> 0) - a & 255;}return e + r;}, u.prototype.writeInt8 = function (t, e, r) {return t = +t, e |= 0, r || C(this, t, e, 1, 127, -128), u.TYPED_ARRAY_SUPPORT || (t = Math.floor(t)), t < 0 && (t = 255 + t + 1), this[e] = 255 & t, e + 1;}, u.prototype.writeInt16LE = function (t, e, r) {return t = +t, e |= 0, r || C(this, t, e, 2, 32767, -32768), u.TYPED_ARRAY_SUPPORT ? (this[e] = 255 & t, this[e + 1] = t >>> 8) : U(this, t, e, !0), e + 2;}, u.prototype.writeInt16BE = function (t, e, r) {return t = +t, e |= 0, r || C(this, t, e, 2, 32767, -32768), u.TYPED_ARRAY_SUPPORT ? (this[e] = t >>> 8, this[e + 1] = 255 & t) : U(this, t, e, !1), e + 2;}, u.prototype.writeInt32LE = function (t, e, r) {return t = +t, e |= 0, r || C(this, t, e, 4, 2147483647, -2147483648), u.TYPED_ARRAY_SUPPORT ? (this[e] = 255 & t, this[e + 1] = t >>> 8, this[e + 2] = t >>> 16, this[e + 3] = t >>> 24) : L(this, t, e, !0), e + 4;}, u.prototype.writeInt32BE = function (t, e, r) {return t = +t, e |= 0, r || C(this, t, e, 4, 2147483647, -2147483648), t < 0 && (t = 4294967295 + t + 1), u.TYPED_ARRAY_SUPPORT ? (this[e] = t >>> 24, this[e + 1] = t >>> 16, this[e + 2] = t >>> 8, this[e + 3] = 255 & t) : L(this, t, e, !1), e + 4;}, u.prototype.writeFloatLE = function (t, e, r) {return N(this, t, e, !0, r);}, u.prototype.writeFloatBE = function (t, e, r) {return N(this, t, e, !1, r);}, u.prototype.writeDoubleLE = function (t, e, r) {return M(this, t, e, !0, r);}, u.prototype.writeDoubleBE = function (t, e, r) {return M(this, t, e, !1, r);}, u.prototype.copy = function (t, e, r, n) {if (r || (r = 0), n || 0 === n || (n = this.length), e >= t.length && (e = t.length), e || (e = 0), n > 0 && n < r && (n = r), n === r) return 0;if (0 === t.length || 0 === this.length) return 0;if (e < 0) throw new RangeError("targetStart out of bounds");if (r < 0 || r >= this.length) throw new RangeError("sourceStart out of bounds");if (n < 0) throw new RangeError("sourceEnd out of bounds");n > this.length && (n = this.length), t.length - e < n - r && (n = t.length - e + r);var o,i = n - r;if (this === t && r < e && e < n) for (o = i - 1; o >= 0; --o) {t[o + e] = this[o + r];} else if (i < 1e3 || !u.TYPED_ARRAY_SUPPORT) for (o = 0; o < i; ++o) {t[o + e] = this[o + r];} else Uint8Array.prototype.set.call(t, this.subarray(r, r + i), e);return i;}, u.prototype.fill = function (t, e, r, n) {if ("string" == typeof t) {if ("string" == typeof e ? (n = e, e = 0, r = this.length) : "string" == typeof r && (n = r, r = this.length), 1 === t.length) {var o = t.charCodeAt(0);o < 256 && (t = o);}if (void 0 !== n && "string" != typeof n) throw new TypeError("encoding must be a string");if ("string" == typeof n && !u.isEncoding(n)) throw new TypeError("Unknown encoding: " + n);} else "number" == typeof t && (t &= 255);if (e < 0 || this.length < e || this.length < r) throw new RangeError("Out of range index");if (r <= e) return this;var i;if (e >>>= 0, r = void 0 === r ? this.length : r >>> 0, t || (t = 0), "number" == typeof t) for (i = e; i < r; ++i) {this[i] = t;} else {var s = u.isBuffer(t) ? t : j(new u(t, n).toString()),a = s.length;for (i = 0; i < r - e; ++i) {this[i + e] = s[i % a];}}return this;};var Y = /[^+\/0-9A-Za-z-_]/g;function D(t) {return t < 16 ? "0" + t.toString(16) : t.toString(16);}function j(t, e) {var r;e = e || 1 / 0;for (var n = t.length, o = null, i = [], s = 0; s < n; ++s) {if ((r = t.charCodeAt(s)) > 55295 && r < 57344) {if (!o) {if (r > 56319) {(e -= 3) > -1 && i.push(239, 191, 189);continue;}if (s + 1 === n) {(e -= 3) > -1 && i.push(239, 191, 189);continue;}o = r;continue;}if (r < 56320) {(e -= 3) > -1 && i.push(239, 191, 189), o = r;continue;}r = 65536 + (o - 55296 << 10 | r - 56320);} else o && (e -= 3) > -1 && i.push(239, 191, 189);if (o = null, r < 128) {if ((e -= 1) < 0) break;i.push(r);} else if (r < 2048) {if ((e -= 2) < 0) break;i.push(r >> 6 | 192, 63 & r | 128);} else if (r < 65536) {if ((e -= 3) < 0) break;i.push(r >> 12 | 224, r >> 6 & 63 | 128, 63 & r | 128);} else {if (!(r < 1114112)) throw new Error("Invalid code point");if ((e -= 4) < 0) break;i.push(r >> 18 | 240, r >> 12 & 63 | 128, r >> 6 & 63 | 128, 63 & r | 128);}}return i;}function q(t) {return n.toByteArray(function (t) {if ((t = function (t) {return t.trim ? t.trim() : t.replace(/^\s+|\s+$/g, "");}(t).replace(Y, "")).length < 2) return "";for (; t.length % 4 != 0;) {t += "=";}return t;}(t));}function F(t, e, r, n) {for (var o = 0; o < n && !(o + r >= e.length || o >= t.length); ++o) {e[o + r] = t[o];}return o;}}).call(this, r(0));}, function (t, e, r) {(function (e) {var n = r(20),o = Object.prototype.toString,i = "function" == typeof Blob || "undefined" != typeof Blob && "[object BlobConstructor]" === o.call(Blob),s = "function" == typeof File || "undefined" != typeof File && "[object FileConstructor]" === o.call(File);t.exports = function t(r) {if (!r || "object" != typeof r) return !1;if (n(r)) {for (var o = 0, a = r.length; o < a; o++) {if (t(r[o])) return !0;}return !1;}if ("function" == typeof e && e.isBuffer && e.isBuffer(r) || "function" == typeof ArrayBuffer && r instanceof ArrayBuffer || i && r instanceof Blob || s && r instanceof File) return !0;if (r.toJSON && "function" == typeof r.toJSON && 1 === arguments.length) return t(r.toJSON(), !0);for (var u in r) {if (Object.prototype.hasOwnProperty.call(r, u) && t(r[u])) return !0;}return !1;};}).call(this, r(24).Buffer);}, function (t, e) {t.exports = Object.keys || function (t) {var e = [],r = Object.prototype.hasOwnProperty;for (var n in t) {r.call(t, n) && e.push(n);}return e;};}, function (t, e, r) {(function (e) {var n,o = r(5),i = r(1),s = r(3),a = r(13),u = r(12),c = r(2)("engine.io-client:websocket"),f = e.WebSocket || e.MozWebSocket;if ("undefined" == typeof window) try {n = r(11);} catch (t) {c("require error: ", t);}var h = f;function p(t) {t && t.forceBase64 && (this.supportsBinary = !1), this.perMessageDeflate = t.perMessageDeflate, this.usingBrowserWebSocket = f && !t.forceNode, this.protocols = t.protocols, this.usingBrowserWebSocket || (h = n), o.call(this, t);}h || "undefined" != typeof window || (h = n), t.exports = p, a(p, o), p.prototype.name = "websocket", p.prototype.supportsBinary = !0, p.prototype.doOpen = function () {if (c("wesocket do open: ", this.protocols), this.check()) {var t = this.uri(),e = this.protocols,r = { agent: this.agent, perMessageDeflate: this.perMessageDeflate };r.pfx = this.pfx, r.key = this.key, r.passphrase = this.passphrase, r.cert = this.cert, r.ca = this.ca, r.ciphers = this.ciphers, r.rejectUnauthorized = this.rejectUnauthorized, this.extraHeaders && (r.headers = this.extraHeaders), this.localAddress && (r.localAddress = this.localAddress);try {this.ws = this.usingBrowserWebSocket ? e ? new h(t, e) : new h(t) : new h(t, e, r);} catch (t) {return this.emit("error", t);}void 0 === this.ws.binaryType && (this.supportsBinary = !1), this.ws.supports && this.ws.supports.binary ? (this.supportsBinary = !0, this.ws.binaryType = "nodebuffer") : this.ws.binaryType = "arraybuffer", this.addEventListeners();}}, p.prototype.addEventListeners = function () {var t = this;this.ws.onopen = function () {t.onOpen();}, this.ws.onclose = function () {t.onClose();}, this.ws.onmessage = function (e) {t.onData(e.data);}, this.ws.onerror = function (e) {t.onError("websocket error", e);};}, p.prototype.write = function (t) {var e = this;this.writable = !1;for (var r, n = t.length, o = 0, s = n; o < s; o++) {r = t[o], i.encodePacket(r, e.supportsBinary, function (t) {try {e.ws.send(t);} catch (t) {}--n || (e.emit("flush"), setTimeout(function () {e.writable = !0, e.emit("drain");}, 0));});}}, p.prototype.onClose = function () {o.prototype.onClose.call(this);}, p.prototype.doClose = function () {void 0 !== this.ws && this.ws.close();}, p.prototype.uri = function () {var t = this.query || {},e = this.secure ? "wss" : "ws",r = "";return this.port && ("wss" === e && 443 !== Number(this.port) || "ws" === e && 80 !== Number(this.port)) && (r = ":" + this.port), this.timestampRequests && (t[this.timestampParam] = u()), this.supportsBinary || (t.b64 = 1), (t = s.encode(t)).length && (t = "?" + t), e + "://" + (-1 !== this.hostname.indexOf(":") ? "[" + this.hostname + "]" : this.hostname) + r + this.path + t;}, p.prototype.check = function () {return !(!h || "__initialize" in h && this.name === p.prototype.name);};}).call(this, r(0));}, function (t, e, r) {(function (e) {var n = r(6),o = r(4),i = r(2)("engine.io-client:socket"),s = r(8),a = r(1),u = r(7),c = r(3);function f(t, r) {if (!(this instanceof f)) return new f(t, r);r = r || {}, t && "object" == typeof t && (r = t, t = null), t ? (t = u(t), r.hostname = t.host, r.secure = "https" === t.protocol || "wss" === t.protocol, r.port = t.port, t.query && (r.query = t.query)) : r.host && (r.hostname = u(r.host).host), this.secure = null != r.secure ? r.secure : e.location && "https:" === location.protocol, r.hostname && !r.port && (r.port = this.secure ? "443" : "80"), this.agent = r.agent || !1, this.hostname = r.hostname || (e.location ? location.hostname : "localhost"), this.port = r.port || (e.location && location.port ? location.port : this.secure ? 443 : 80), this.query = r.query || {}, "string" == typeof this.query && (this.query = c.decode(this.query)), this.upgrade = !1 !== r.upgrade, this.path = (r.path || "/engine.io").replace(/\/$/, "") + "/", this.forceJSONP = !!r.forceJSONP, this.jsonp = !1 !== r.jsonp, this.forceBase64 = !!r.forceBase64, this.enablesXDR = !!r.enablesXDR, this.timestampParam = r.timestampParam || "t", this.timestampRequests = r.timestampRequests, this.transports = r.transports || ["websocket"], this.transportOptions = r.transportOptions || {}, this.readyState = "", this.writeBuffer = [], this.prevBufferLen = 0, this.policyPort = r.policyPort || 843, this.rememberUpgrade = r.rememberUpgrade || !1, this.binaryType = null, this.onlyBinaryUpgrades = r.onlyBinaryUpgrades, this.perMessageDeflate = !1 !== r.perMessageDeflate && (r.perMessageDeflate || {}), !0 === this.perMessageDeflate && (this.perMessageDeflate = {}), this.perMessageDeflate && null == this.perMessageDeflate.threshold && (this.perMessageDeflate.threshold = 1024), this.pfx = r.pfx || null, this.key = r.key || null, this.passphrase = r.passphrase || null, this.cert = r.cert || null, this.ca = r.ca || null, this.ciphers = r.ciphers || null, this.rejectUnauthorized = void 0 === r.rejectUnauthorized || r.rejectUnauthorized, this.forceNode = !!r.forceNode;var n = "object" == typeof e && e;n.global === n && (r.extraHeaders && Object.keys(r.extraHeaders).length > 0 && (this.extraHeaders = r.extraHeaders), r.localAddress && (this.localAddress = r.localAddress)), this.id = null, this.upgrades = null, this.pingInterval = null, this.pingTimeout = null, this.pingIntervalTimer = null, this.pingTimeoutTimer = null, this.open();}t.exports = f, f.priorWebsocketSuccess = !1, o(f.prototype), f.protocol = a.protocol, f.Socket = f, f.Transport = r(5), f.transports = r(6), f.parser = r(1), f.prototype.createTransport = function (t) {i('creating transport "%s"', t);var e = function (t) {var e = {};for (var r in t) {t.hasOwnProperty(r) && (e[r] = t[r]);}return e;}(this.query);e.EIO = a.protocol, e.transport = t;var r = this.transportOptions[t] || {};this.id && (e.sid = this.id);var o = new n[t]({ query: e, socket: this, agent: r.agent || this.agent, hostname: r.hostname || this.hostname, port: r.port || this.port, secure: r.secure || this.secure, path: r.path || this.path, forceJSONP: r.forceJSONP || this.forceJSONP, jsonp: r.jsonp || this.jsonp, forceBase64: r.forceBase64 || this.forceBase64, enablesXDR: r.enablesXDR || this.enablesXDR, timestampRequests: r.timestampRequests || this.timestampRequests, timestampParam: r.timestampParam || this.timestampParam, policyPort: r.policyPort || this.policyPort, pfx: r.pfx || this.pfx, key: r.key || this.key, passphrase: r.passphrase || this.passphrase, cert: r.cert || this.cert, ca: r.ca || this.ca, ciphers: r.ciphers || this.ciphers, rejectUnauthorized: r.rejectUnauthorized || this.rejectUnauthorized, perMessageDeflate: r.perMessageDeflate || this.perMessageDeflate, extraHeaders: r.extraHeaders || this.extraHeaders, forceNode: r.forceNode || this.forceNode, localAddress: r.localAddress || this.localAddress, requestTimeout: r.requestTimeout || this.requestTimeout, protocols: r.protocols || void 0 });return i("transport: ", o), o;}, f.prototype.open = function () {var t;if (this.rememberUpgrade && f.priorWebsocketSuccess && -1 !== this.transports.indexOf("websocket")) t = "websocket";else {if (0 === this.transports.length) {var e = this;return void setTimeout(function () {e.emit("error", "No transports available");}, 0);}t = this.transports[0];}this.readyState = "opening";try {t = this.createTransport(t);} catch (t) {return this.transports.shift(), void this.open();}t.open(), this.setTransport(t);}, f.prototype.setTransport = function (t) {i("setting transport %s", t.name);var e = this;this.transport && (i("clearing existing transport %s", this.transport.name), this.transport.removeAllListeners()), this.transport = t, t.on("drain", function () {e.onDrain();}).on("packet", function (t) {e.onPacket(t);}).on("error", function (t) {e.onError(t);}).on("close", function () {e.onClose("transport close");});}, f.prototype.probe = function (t) {i('probing transport "%s"', t);var e = this.createTransport(t, { probe: 1 }),r = !1,n = this;function o() {if (n.onlyBinaryUpgrades) {var o = !this.supportsBinary && n.transport.supportsBinary;r = r || o;}r || (i('probe transport "%s" opened', t), e.send([{ type: "ping", data: "probe" }]), e.once("packet", function (o) {if (!r) if ("pong" === o.type && "probe" === o.data) {if (i('probe transport "%s" pong', t), n.upgrading = !0, n.emit("upgrading", e), !e) return;f.priorWebsocketSuccess = "websocket" === e.name, i('pausing current transport "%s"', n.transport.name), n.transport.pause(function () {r || "closed" !== n.readyState && (i("changing transport and sending upgrade packet"), p(), n.setTransport(e), e.send([{ type: "upgrade" }]), n.emit("upgrade", e), e = null, n.upgrading = !1, n.flush());});} else {i('probe transport "%s" failed', t);var s = new Error("probe error");s.transport = e.name, n.emit("upgradeError", s);}}));}function s() {r || (r = !0, p(), e.close(), e = null);}function a(r) {var o = new Error("probe error: " + r);o.transport = e.name, s(), i('probe transport "%s" failed because of error: %s', t, r), n.emit("upgradeError", o);}function u() {a("transport closed");}function c() {a("socket closed");}function h(t) {e && t.name !== e.name && (i('"%s" works - aborting "%s"', t.name, e.name), s());}function p() {e.removeListener("open", o), e.removeListener("error", a), e.removeListener("close", u), n.removeListener("close", c), n.removeListener("upgrading", h);}f.priorWebsocketSuccess = !1, e.once("open", o), e.once("error", a), e.once("close", u), this.once("close", c), this.once("upgrading", h), e.open();}, f.prototype.onOpen = function () {if (i("socket open"), this.readyState = "open", f.priorWebsocketSuccess = "websocket" === this.transport.name, this.emit("open"), this.flush(), "open" === this.readyState && this.upgrade && this.transport.pause) {i("starting upgrade probes");for (var t = 0, e = this.upgrades.length; t < e; t++) {this.probe(this.upgrades[t]);}}}, f.prototype.onPacket = function (t) {if ("opening" === this.readyState || "open" === this.readyState || "closing" === this.readyState) switch (i('socket receive: type "%s", data "%s"', t.type, t.data), this.emit("packet", t), this.emit("heartbeat"), t.type) {case "open":this.onHandshake(JSON.parse(t.data));break;case "pong":this.setPing(), this.emit("pong");break;case "error":var e = new Error("server error");e.code = t.data, this.onError(e);break;case "message":this.emit("data", t.data), this.emit("message", t.data);} else i('packet received with socket readyState "%s"', this.readyState);}, f.prototype.onHandshake = function (t) {this.emit("handshake", t), this.id = t.sid, this.transport.query.sid = t.sid, this.upgrades = this.filterUpgrades(t.upgrades), this.pingInterval = t.pingInterval, this.pingTimeout = t.pingTimeout, this.onOpen(), "closed" !== this.readyState && (this.setPing(), this.removeListener("heartbeat", this.onHeartbeat), this.on("heartbeat", this.onHeartbeat));}, f.prototype.onHeartbeat = function (t) {clearTimeout(this.pingTimeoutTimer);var e = this;e.pingTimeoutTimer = setTimeout(function () {"closed" !== e.readyState && e.onClose("ping timeout");}, t || e.pingInterval + e.pingTimeout);}, f.prototype.setPing = function () {var t = this;clearTimeout(t.pingIntervalTimer), t.pingIntervalTimer = setTimeout(function () {i("writing ping packet - expecting pong within %sms", t.pingTimeout), t.ping(), t.onHeartbeat(t.pingTimeout);}, t.pingInterval);}, f.prototype.ping = function () {var t = this;this.sendPacket("ping", function () {t.emit("ping");});}, f.prototype.onDrain = function () {this.writeBuffer.splice(0, this.prevBufferLen), this.prevBufferLen = 0, 0 === this.writeBuffer.length ? this.emit("drain") : this.flush();}, f.prototype.flush = function () {"closed" !== this.readyState && this.transport.writable && !this.upgrading && this.writeBuffer.length && (i("flushing %d packets in socket", this.writeBuffer.length), this.transport.send(this.writeBuffer), this.prevBufferLen = this.writeBuffer.length, this.emit("flush"));}, f.prototype.write = f.prototype.send = function (t, e, r) {return this.sendPacket("message", t, e, r), this;}, f.prototype.sendPacket = function (t, e, r, n) {if ("function" == typeof e && (n = e, e = void 0), "function" == typeof r && (n = r, r = null), "closing" !== this.readyState && "closed" !== this.readyState) {(r = r || {}).compress = !1 !== r.compress;var o = { type: t, data: e, options: r };this.emit("packetCreate", o), this.writeBuffer.push(o), n && this.once("flush", n), this.flush();}}, f.prototype.close = function () {if ("opening" === this.readyState || "open" === this.readyState) {this.readyState = "closing";var t = this;this.writeBuffer.length ? this.once("drain", function () {this.upgrading ? n() : e();}) : this.upgrading ? n() : e();}function e() {t.onClose("forced close"), i("socket closing - telling transport to close"), t.transport.close();}function r() {t.removeListener("upgrade", r), t.removeListener("upgradeError", r), e();}function n() {t.once("upgrade", r), t.once("upgradeError", r);}return this;}, f.prototype.onError = function (t) {i("socket error %j", t), f.priorWebsocketSuccess = !1, this.emit("error", t), this.onClose("transport error", t);}, f.prototype.onClose = function (t, e) {"opening" !== this.readyState && "open" !== this.readyState && "closing" !== this.readyState || (i('socket close with reason: "%s"', t), clearTimeout(this.pingIntervalTimer), clearTimeout(this.pingTimeoutTimer), this.transport.removeAllListeners("close"), this.transport.close(), this.transport.removeAllListeners(), this.readyState = "closed", this.id = null, this.emit("close", t, e), this.writeBuffer = [], this.prevBufferLen = 0);}, f.prototype.filterUpgrades = function (t) {for (var e = [], r = 0, n = t.length; r < n; r++) {~s(this.transports, t[r]) && e.push(t[r]);}return e;};}).call(this, r(0));}, function (t, e, r) {t.exports = r(28), t.exports.parser = r(1);}]);}, function (t, e, r) {(function (t) {var n = r(2),o = r(9),i = Object.prototype.toString,s = "function" == typeof t.Blob || "[object BlobConstructor]" === i.call(t.Blob),a = "function" == typeof t.File || "[object FileConstructor]" === i.call(t.File);e.deconstructPacket = function (t) {var e = [],r = t.data,i = t;return i.data = function t(e, r) {if (!e) return e;if (o(e)) {var i = { _placeholder: !0, num: r.length };return r.push(e), i;}if (n(e)) {for (var s = new Array(e.length), a = 0; a < e.length; a++) {s[a] = t(e[a], r);}return s;}if ("object" == typeof e && !(e instanceof Date)) {s = {};for (var u in e) {s[u] = t(e[u], r);}return s;}return e;}(r, e), i.attachments = e.length, { packet: i, buffers: e };}, e.reconstructPacket = function (t, e) {return t.data = function t(e, r) {if (!e) return e;if (e && e._placeholder) return r[e.num];if (n(e)) for (var o = 0; o < e.length; o++) {e[o] = t(e[o], r);} else if ("object" == typeof e) for (var i in e) {e[i] = t(e[i], r);}return e;}(t.data, e), t.attachments = void 0, t;}, e.removeBlobs = function (t, e) {var r = 0,i = t;!function t(u, c, f) {if (!u) return u;if (s && u instanceof Blob || a && u instanceof File) {r++;var h = new FileReader();h.onload = function () {f ? f[c] = this.result : i = this.result, --r || e(i);}, h.readAsArrayBuffer(u);} else if (n(u)) for (var p = 0; p < u.length; p++) {t(u[p], p, u);} else if ("object" == typeof u && !o(u)) for (var l in u) {t(u[l], l, u);}}(i), r || e(i);};}).call(this, r(1));}, function (t, e) {var r = /^(?:(?![^:@]+:[^:@\/]*@)(http|https|ws|wss):\/\/)?((?:(([^:@]*)(?::([^:@]*))?)?@)?((?:[a-f0-9]{0,4}:){2,7}[a-f0-9]{0,4}|[^:\/?#]*)(?::(\d*))?)(((\/(?:[^?#](?![^?#\/]*\.[^?#\/.]+(?:[?#]|$)))*\/?)?([^?#\/]*))(?:\?([^#]*))?(?:#(.*))?)/,n = ["source", "protocol", "authority", "userInfo", "user", "password", "host", "port", "relative", "path", "directory", "file", "query", "anchor"];t.exports = function (t) {var e = t,o = t.indexOf("["),i = t.indexOf("]");-1 != o && -1 != i && (t = t.substring(0, o) + t.substring(o, i).replace(/:/g, ";") + t.substring(i, t.length));for (var s = r.exec(t || ""), a = {}, u = 14; u--;) {a[n[u]] = s[u] || "";}return -1 != o && -1 != i && (a.source = e, a.host = a.host.substring(1, a.host.length - 1).replace(/;/g, ":"), a.authority = a.authority.replace("[", "").replace("]", "").replace(/;/g, ":"), a.ipv6uri = !0), a;};}, function (t, e, r) {(function (e) {var n = r(21),o = r(0)("socket.io-client:url");t.exports = function (t, r) {var i = t;r = r || e.location, null == t && (t = r.protocol + "//" + r.host), "string" == typeof t && ("/" === t.charAt(0) && (t = "/" === t.charAt(1) ? r.protocol + t : r.host + t), /^(https?|wss?):\/\//.test(t) || (o("protocol-less url %s", t), t = void 0 !== r ? r.protocol + "//" + t : "https://" + t), o("parse %s", t), i = n(t)), i.port || (/^(http|ws)$/.test(i.protocol) ? i.port = "80" : /^(http|ws)s$/.test(i.protocol) && (i.port = "443")), i.path = i.path || "/";var s = -1 !== i.host.indexOf(":") ? "[" + i.host + "]" : i.host;return i.id = i.protocol + "://" + s + ":" + i.port, i.href = i.protocol + "://" + s + (r && r.port === i.port ? "" : ":" + i.port), i;};}).call(this, r(1));}, function (t, e, r) {var n = r(22),o = r(4),i = r(8),s = r(0)("socket.io-client");t.exports = e = u;var a = e.managers = {};function u(t, e) {"object" == typeof t && (e = t, t = void 0), e = e || {};var r,o = n(t),u = o.source,c = o.id,f = o.path,h = a[c] && f in a[c].nsps;return e.forceNew || e["force new connection"] || !1 === e.multiplex || h ? (s("ignoring socket cache for %s", u), r = i(u, e)) : (a[c] || (s("new io instance for %s", u), a[c] = i(u, e)), r = a[c]), o.query && !e.query && (e.query = o.query), r.socket(o.path, e);}e.protocol = o.protocol, e.connect = u, e.Manager = r(8), e.Socket = r(7);}, function (t, e, r) {t.exports = r(23);}]);});

/***/ }),

/***/ 31:
/*!*************************************************************************************!*\
  !*** J:/kesionEDU_APP/KS_EDU_APP/客户小程序/首冠小程序定制/lib/polyv/common/chat/eventTypes.js ***!
  \*************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
Object.defineProperty(exports, "__esModule", { value: true });exports.default = void 0;var _default = { CONNECT: "connect", DISCONNECT: "disconnect", RECONNECT: "reconnect", RECONNECT_ATTEMPT: "reconnect_attempt", CLOSE_ROOM: "closeRoom", OPEN_ROOM: "openRoom", SYSTEM_ANNOUNCEMENT: "gonggao", SPEAK: "speak", SPEAK_ERROR: "speakError", SPEAK_CENSOR: "speak_censor", REWARD: "reward", QUESTION: "question", CLOSE_QUESTION: "closeQuestion", ANSWER: "answer", CUSTOMER_MESSAGE: "customerMessage", SERVER_ERROR: "serverError", KICK_USER: "kickUser", REMOVE_HISTORY: "removeHistory", REMOVE_CONTENT: "removeContent", CLOSE_DANMU: "closeDanmu", ERROR: "error", HISTORY_MESSAGE: "historyMessage", SEND_MESSAGE: "sendMessage", PROHIBIT_TO_SPEAK: "prohibitToSpeak", LOGIN: "login", LOGOUT: "loginOut", UPDATEUSER: "updateUser", CLASSSTART: "onClassStart", CLASSEND: "onClassEnd", SLICEID: "onSliceID", SLICESTART: "onSliceStart", CLASSCONTROL: "onClassControl", MUTEALLVIDEO: "muteAllVideo", MUTEALLAUDIO: "muteAllAudio", MUTEUSERAUDIO: "muteUserAudio", MUTEUSERVIDEO: "muteUserVideo", SLICECONTROL: "onSliceControl", SLICEDRAW: "onSliceDraw", SLICEDOPEN: "onSliceOpen", S_QUESTION: "S_QUESTION", T_ANSWER: "T_ANSWER", UPDATE_QUESTION_HISTROY: "UPDATE_QUESTION_HISTROY", BULLETIN: "bulletin", REMOVE_BULLETIN: "removeBulletin", FLOWERS: "FLOWERS", REDPAPER: "redpaper", SIGN_IN: "SIGN_IN", STOP_SIGN_IN: "STOP_SIGN_IN", TO_SIGN_IN: "TO_SIGN_IN", LIKES: "LIKES", MICROPHONE: "OPEN_MICROPHONE", ALLOW_MICROPHONE: "ALLOW_MICROPHONE", SUCCESS_MICROPHONE: "SUCCESS_MICROPHONE", JOIN_CHANNEL_FAIL: "JOIN_CHANNEL_FAIL", SET_NICK: "SET_NICK", ONLINE_TEACHERINFO: "O_TEACHER_INFO", OVERTIMECONNECT: "overtimeConnect", SET_MANAGER_INFO: "SET_MANAGER_INFO", GET_TEST_QUESTION_CONTENT: "GET_TEST_QUESTION_CONTENT", GET_TEST_QUESTION_RESULT: "GET_TEST_QUESTION_RESULT", BAN_USER_ROOM: "ban_user_room", SYSTEM_MESSAGE: "SYSTEM_MESSAGE", CHAT_IMG: "CHAT_IMG" };exports.default = _default;

/***/ }),

/***/ 32:
/*!**************************************************************************************!*\
  !*** J:/kesionEDU_APP/KS_EDU_APP/客户小程序/首冠小程序定制/lib/polyv/common/chat/emotionList.js ***!
  \**************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
var emotionList = [{ url: "//livestatic.polyv.net/assets/images/em/1.png", title: "微笑", position: "0px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/2.png", title: "撇嘴", position: "-48px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/3.png", title: "色", position: "-96px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/4.png", title: "发呆", position: "-144px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/5.png", title: "得意", position: "-192px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/6.png", title: "流泪", position: "-240px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/7.png", title: "害羞", position: "-288px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/8.png", title: "闭嘴", position: "-336px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/9.png", title: "睡", position: "-384px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/10.png", title: "大哭", position: "-432px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/11.png", title: "尴尬", position: "-480px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/12.png", title: "发怒", position: "-528px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/13.png", title: "调皮", position: "-576px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/14.png", title: "呲牙", position: "-624px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/15.png", title: "惊讶", position: "-672px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/16.png", title: "难过", position: "-720px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/17.png", title: "酷", position: "-768px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/18.png", title: "冷汗", position: "-816px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/19.png", title: "抓狂", position: "-864px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/20.png", title: "吐", position: "-912px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/21.png", title: "偷笑", position: "-960px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/22.png", title: "可爱", position: "-1008px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/23.png", title: "白眼", position: "-1056px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/24.png", title: "傲慢", position: "-1104px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/25.png", title: "饥饿", position: "-1152px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/26.png", title: "困", position: "-1200px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/27.png", title: "惊恐", position: "-1248px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/28.png", title: "流汗", position: "-1296px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/29.png", title: "憨笑", position: "-1344px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/30.png", title: "大兵", position: "-1392px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/31.png", title: "奋斗", position: "-1440px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/32.png", title: "咒骂", position: "-1488px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/33.png", title: "疑问", position: "-1536px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/34.png", title: "嘘", position: "-1584px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/35.png", title: "晕", position: "-1632px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/36.png", title: "折磨", position: "-1680px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/37.png", title: "衰", position: "-1728px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/38.png", title: "骷髅", position: "-1776px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/39.png", title: "敲打", position: "-1824px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/40.png", title: "再见", position: "-1872px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/41.png", title: "擦汗", position: "-1920px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/42.png", title: "抠鼻", position: "-1968px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/43.png", title: "鼓掌", position: "-2016px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/44.png", title: "糗大了", position: "-2064px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/45.png", title: "坏笑", position: "-2112px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/46.png", title: "左哼哼", position: "-2160px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/47.png", title: "右哼哼", position: "-2208px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/48.png", title: "哈欠", position: "-2256px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/49.png", title: "鄙视", position: "-2304px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/50.png", title: "委屈", position: "-2352px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/51.png", title: "快哭了", position: "-2400px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/52.png", title: "阴险", position: "-2448px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/53.png", title: "亲亲", position: "-2496px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/54.png", title: "吓", position: "-2544px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/55.png", title: "可怜", position: "-2592px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/56.png", title: "菜刀", position: "-2640px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/57.png", title: "西瓜", position: "-2688px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/58.png", title: "啤酒", position: "-2736px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/59.png", title: "篮球", position: "-2784px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/60.png", title: "乒乓", position: "-2832px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/61.png", title: "咖啡", position: "-2880px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/62.png", title: "饭", position: "-2928px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/63.png", title: "猪头", position: "-2976px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/64.png", title: "玫瑰", position: "-3024px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/65.png", title: "凋谢", position: "-3072px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/66.png", title: "示爱", position: "-3120px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/67.png", title: "爱心", position: "-3168px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/68.png", title: "心碎", position: "-3216px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/69.png", title: "蛋糕", position: "-3264px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/70.png", title: "闪电", position: "-3312px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/71.png", title: "炸弹", position: "-3360px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/72.png", title: "刀", position: "-3408px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/73.png", title: "足球", position: "-3456px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/74.png", title: "瓢虫", position: "-3504px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/75.png", title: "便便", position: "-3552px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/76.png", title: "月亮", position: "-3600px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/77.png", title: "太阳", position: "-3648px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/78.png", title: "礼物", position: "-3696px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/79.png", title: "拥抱", position: "-3744px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/80.png", title: "强", position: "-3792px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/81.png", title: "弱", position: "-3840px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/82.png", title: "握手", position: "-3888px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/83.png", title: "胜利", position: "-3936px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/84.png", title: "抱拳", position: "-3984px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/85.png", title: "勾引", position: "-4032px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/86.png", title: "拳头", position: "-4080px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/87.png", title: "差劲", position: "-4128px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/88.png", title: "爱你", position: "-4176px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/89.png", title: "NO", position: "-4224px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/90.png", title: "OK", position: "-4272px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/91.png", title: "爱情", position: "-4320px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/92.png", title: "飞吻", position: "-4368px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/93.png", title: "跳跳", position: "-4416px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/94.png", title: "发抖", position: "-4464px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/95.png", title: "怄火", position: "-4512px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/96.png", title: "转圈", position: "-4560px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/97.png", title: "磕头", position: "-4608px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/98.png", title: "回头", position: "-4656px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/99.png", title: "跳绳", position: "-4704px 0px" }, { url: "//livestatic.polyv.net/assets/images/em/100.png", title: "挥手", position: "-4752px 0px" }];module.exports = emotionList;

/***/ }),

/***/ 33:
/*!******************************************************************************!*\
  !*** J:/kesionEDU_APP/KS_EDU_APP/客户小程序/首冠小程序定制/lib/polyv/common/chat/api.js ***!
  \******************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
Object.defineProperty(exports, "__esModule", { value: true });exports.default = void 0;var _plvRequest = _interopRequireDefault(__webpack_require__(/*! ../api/plv-request */ 34));var _config = __webpack_require__(/*! ../utils/config */ 38);function _interopRequireDefault(obj) {return obj && obj.__esModule ? obj : { default: obj };}var mainHost = _config.URL.mainHost,historyUrl = "".concat(mainHost, "/live/v3/channel/chat/get-history-contents"),_removeHistoryUrl = "".concat(mainHost, "/live/v3/channel/chat/remove-content"),questionHistoryUrl = "".concat(mainHost, "/live/v3/channel/chat/get-question-contents"),getCurrentSign = "".concat(mainHost, "/live/v3/channel/chat/get-checkin"),getCheckinList = "".concat(mainHost, "/live/v3/channel/chat/get-checkin-list"),userUrl = "".concat(mainHost, "/live/v3/channel/chat/get-user-list"),bannedListUrl = "".concat(mainHost, "/live/v3/channel/chat/get-banned-list"),microphoneStatusUrl = "".concat(mainHost, "/live/v3/channel/chat/get-microphone-status"),_getIsKicked = "".concat(mainHost, "/live/v3/channel/chat/is-kicked");var _default = { getIsKicked: function getIsKicked(e, t) {return (0, _plvRequest.default)(_getIsKicked, { qs: { roomId: e, userId: t }, method: "POST" });}, setNickname: function setNickname(e, t) {return (0, _plvRequest.default)("".concat(mainHost, "/").concat(e, "/set-nickname"), { body: { nickname: t } });}, getOnlineUserList: function getOnlineUserList(e) {return (0, _plvRequest.default)(userUrl, { body: { channelId: e, page: 1, pageSize: 100, hide: 0 } });}, getHistoryMessage: function getHistoryMessage(e, t, n) {return (0, _plvRequest.default)(historyUrl, { body: { channelId: e.roomName, start: t, end: t + n, hideIp: 0, fullMessage: 1 } });}, getQuestionHistoryMessage: function getQuestionHistoryMessage(e) {var t = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 0;var n = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 20;return (0, _plvRequest.default)(questionHistoryUrl, { body: { channelId: e, start: t, end: t + n } });}, getCurrentSignRecord: function getCurrentSignRecord(e) {return (0, _plvRequest.default)(getCurrentSign, { body: { channelId: e.channelId, checkinId: e.checkinId } });}, getHistorySignRecord: function getHistorySignRecord(e) {return (0, _plvRequest.default)(getCheckinList, { body: { channelId: e.channelId, startDate: e.startIndate, endDate: e.endIndate } });}, getBannedList: function getBannedList(e) {return (0, _plvRequest.default)(bannedListUrl, { body: { channelId: e, type: "ip" } });}, removeHistoryUrl: function removeHistoryUrl(e, t) {return (0, _plvRequest.default)(_removeHistoryUrl, { body: { channelId: t.roomName, id: e } });}, checkCurrentStatus: function checkCurrentStatus(e) {return (0, _plvRequest.default)(microphoneStatusUrl, { body: { channelId: e } });} };exports.default = _default;

/***/ }),

/***/ 34:
/*!*************************************************************************************!*\
  !*** J:/kesionEDU_APP/KS_EDU_APP/客户小程序/首冠小程序定制/lib/polyv/common/api/plv-request.js ***!
  \*************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
Object.defineProperty(exports, "__esModule", { value: true });exports.default = void 0;var _regenerator = _interopRequireDefault(__webpack_require__(/*! ./node_modules/@babel/runtime/regenerator */ 20));var _md = _interopRequireDefault(__webpack_require__(/*! ../utils/md5 */ 29));var _request = _interopRequireDefault(__webpack_require__(/*! ../utils/request */ 35));var _index = _interopRequireDefault(__webpack_require__(/*! ../../store/index */ 36));var _runtimeModule = _interopRequireDefault(__webpack_require__(/*! ../regenerator-runtime/runtime-module */ 23));function _interopRequireDefault(obj) {return obj && obj.__esModule ? obj : { default: obj };}function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) {try {var info = gen[key](arg);var value = info.value;} catch (error) {reject(error);return;}if (info.done) {resolve(value);} else {Promise.resolve(value).then(_next, _throw);}}function _asyncToGenerator(fn) {return function () {var self = this,args = arguments;return new Promise(function (resolve, reject) {var gen = fn.apply(self, args);function _next(value) {asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value);}function _throw(err) {asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err);}_next(undefined);});};}function _objectSpread(target) {for (var i = 1; i < arguments.length; i++) {var source = arguments[i] != null ? arguments[i] : {};var ownKeys = Object.keys(source);if (typeof Object.getOwnPropertySymbols === 'function') {ownKeys = ownKeys.concat(Object.getOwnPropertySymbols(source).filter(function (sym) {return Object.getOwnPropertyDescriptor(source, sym).enumerable;}));}ownKeys.forEach(function (key) {_defineProperty(target, key, source[key]);});}return target;}function _defineProperty(obj, key, value) {if (key in obj) {Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true });} else {obj[key] = value;}return obj;}function resortParam(t) {var e = Object.keys(t).filter(function (t) {return "sign" !== t;}).sort();var r = "";return e.forEach(function (e) {r += "".concat(e).concat(t[e]);}), r;}function getSign(t, e) {var r = _objectSpread({}, t),n = resortParam(t);return r.sign = (0, _md.default)("plyMinApp".concat(n, "plyMinApp")).toUpperCase(), (0, _request.default)(e, { qs: r });}function getSecretSign(t, e) {var r = resortParam(t);return (0, _md.default)("".concat(e).concat(r).concat(e)).toUpperCase();}var pRequest = /*#__PURE__*/function () {var _ref = _asyncToGenerator( /*#__PURE__*/_regenerator.default.mark(function _callee(t, e, r) {var _store$get, _t, _r, n, o, s, _t2;return _regenerator.default.wrap(function _callee$(_context) {while (1) {switch (_context.prev = _context.next) {case 0:if (r) {_context.next = 18;break;}_store$get = _index.default.get("app"), _t = _store$get.apiId, _r = _store$get.apiSecret, n = _store$get.verifyUrl;_context.t0 = _regenerator.default.keys(e);case 3:if ((_context.t1 = _context.t0()).done) {_context.next = 18;break;}o = _context.t1.value;if (!(("qs" === o || "body" === o) && e[o])) {_context.next = 16;break;}s = _objectSpread({}, e[o]);if (!(s.appId = _t, s.timestamp = Date.now(), n)) {_context.next = 14;break;}_context.next = 10;return getSign(s, n);case 10:_t2 = _context.sent;s.sign = _t2.data.data.sign;_context.next = 15;break;case 14:s.sign = getSecretSign(s, _r);case 15:e[o] = s;case 16:_context.next = 3;break;case 18:return _context.abrupt("return", (0, _request.default)(t, e));case 19:case "end":return _context.stop();}}}, _callee, this);}));return function pRequest(_x, _x2, _x3) {return _ref.apply(this, arguments);};}();var _default = pRequest;exports.default = _default;

/***/ }),

/***/ 35:
/*!***********************************************************************************!*\
  !*** J:/kesionEDU_APP/KS_EDU_APP/客户小程序/首冠小程序定制/lib/polyv/common/utils/request.js ***!
  \***********************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
Object.defineProperty(exports, "__esModule", { value: true });exports.default = void 0;var defaultoptions = { url: void 0, method: "GET", qs: void 0, body: void 0, headers: void 0, type: "json", contentType: "application/json", crossOrigin: !0, credentials: void 0 },makeOptions = function makeOptions(t, e) {var s = {};return e ? (s = e, t && (s.url = t)) : "string" == typeof t ? s.url = t : s = t, s = Object.assign({}, defaultoptions, s);},addQs = function addQs(t, e) {var s = "",o = t;if (e && "object" == typeof e) {var _arr = Object.keys(e);for (var _i = 0; _i < _arr.length; _i++) {var _t = _arr[_i];s += "&".concat(_t, "=").concat(e[_t]);}s.length > 0 && (t.split("?").length < 2 ? s = s.substring(1) : 0 === t.split("?")[1].length && (s = s.substring(1))), o = -1 === t.indexOf("?") ? "".concat(t, "?").concat(s) : "".concat(t).concat(s);}return o;},request = function request(t, e) {var s = makeOptions(t, e),o = s.method,n = s.body,d = s.headers,r = s.qs,i = s.type,a = s.contentType;var l = s.url;r && (l = addQs(l, r));var u = d;return d && d["content-type"] || !a || (u = Object.assign({}, d, { "content-type": a })), new Promise(function (t, e) {wx.request({ url: l, method: o, data: n, header: u, dataType: i, success: function success(s) {(s.statusCode < 200 || s.statusCode >= 300) && e(s), t(s);}, fail: function fail(t) {e(t);} });});};var _default = request;exports.default = _default;

/***/ }),

/***/ 36:
/*!**************************************************************************!*\
  !*** J:/kesionEDU_APP/KS_EDU_APP/客户小程序/首冠小程序定制/lib/polyv/store/index.js ***!
  \**************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
Object.defineProperty(exports, "__esModule", { value: true });exports.default = void 0;var _utils = _interopRequireDefault(__webpack_require__(/*! ../common/utils/utils */ 37));function _interopRequireDefault(obj) {return obj && obj.__esModule ? obj : { default: obj };}function _objectSpread(target) {for (var i = 1; i < arguments.length; i++) {var source = arguments[i] != null ? arguments[i] : {};var ownKeys = Object.keys(source);if (typeof Object.getOwnPropertySymbols === 'function') {ownKeys = ownKeys.concat(Object.getOwnPropertySymbols(source).filter(function (sym) {return Object.getOwnPropertyDescriptor(source, sym).enumerable;}));}ownKeys.forEach(function (key) {_defineProperty(target, key, source[key]);});}return target;}function _defineProperty(obj, key, value) {if (key in obj) {Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true });} else {obj[key] = value;}return obj;}function _classCallCheck(instance, Constructor) {if (!(instance instanceof Constructor)) {throw new TypeError("Cannot call a class as a function");}}function _defineProperties(target, props) {for (var i = 0; i < props.length; i++) {var descriptor = props[i];descriptor.enumerable = descriptor.enumerable || false;descriptor.configurable = true;if ("value" in descriptor) descriptor.writable = true;Object.defineProperty(target, descriptor.key, descriptor);}}function _createClass(Constructor, protoProps, staticProps) {if (protoProps) _defineProperties(Constructor.prototype, protoProps);if (staticProps) _defineProperties(Constructor, staticProps);return Constructor;}var Store = /*#__PURE__*/function () {function Store(t) {_classCallCheck(this, Store);this.state = _objectSpread({}, t), this.callbacks = {};}_createClass(Store, [{ key: "get", value: function get(t) {var _this = this;if (_utils.default.isString(t)) return this._getByStr(t);if (_utils.default.isObj(t)) {var s = _objectSpread({}, t);return Object.keys(s).forEach(function (t) {var e = s[t];_this.callbacks[t] || (_this.callbacks[t] = []), _this.callbacks[t].indexOf(e) < 0 && _this.callbacks[t].push(e), e(_this._getByStr(t));}), function () {Object.keys(s).forEach(function (t) {var e = s[t],i = _this.callbacks[t].indexOf(e);_this.callbacks[t].splice(i, 1);});};}throw Error("key must be string or object.");} }, { key: "set", value: function set(t, s) {var _this2 = this;if (_utils.default.isObj(t)) {var _s = _objectSpread({}, t);Object.keys(_s).forEach(function (t) {var e = _s[t];_this2._setItem(t, e);});} else this._setItem(t, s);} }, { key: "reset", value: function reset() {this.state.main = { chat: null, channelId: "", channelDetail: {}, chapterList: [], videoId: "", videoPoolId: "" };} }, { key: "_getItem", value: function _getItem(t, s) {this.callbacks[t] || (this.callbacks[t] = []), this.callbacks[t].push(s);var e = this._getByStr(t);return s(e), e;} }, { key: "_setItem", value: function _setItem(t, s) {var _this3 = this;var e = t.split(".");s !== this._getByStr(t) && (this._setByStr(t, s), e.reduce(function (t, s) {var e = t ? t + "." + s : s;(_this3.callbacks[e] || []).forEach(function (t) {t(_this3._getByStr(e));});}));} }, { key: "_getByStr", value: function _getByStr(t) {if (!t) return this.state;var s = t.split(".");return s.reduce(function (t, e, i) {if (!t[e] && i < s.length - 1) throw Error("".concat(e, " is undefined in state"));return t[e];}, this.state);} }, { key: "_setByStr", value: function _setByStr(t, s) {var e = t.split(".");e.reduce(function (t, i, c) {return c === e.length - 1 && (t[i] = s), t[i] = t[i] || {}, t[i];}, this.state);} }]);return Store;}();var initialState = { app: { appId: "", appSecret: "", userId: "" }, main: { chat: null, channelId: "", channelDetail: {}, chapterList: [], openId: "", userName: "", avatarUrl: "" } };var _default = new Store(initialState);exports.default = _default;

/***/ }),

/***/ 37:
/*!*********************************************************************************!*\
  !*** J:/kesionEDU_APP/KS_EDU_APP/客户小程序/首冠小程序定制/lib/polyv/common/utils/utils.js ***!
  \*********************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
/* WEBPACK VAR INJECTION */(function(uni) {Object.defineProperty(exports, "__esModule", { value: true });exports.default = void 0;function comparison(t) {return function (e, i) {var r = e[t],n = i[t];return r < n ? -1 : r > n ? 1 : 0;};}function formatTime(t) {if (!t || "number" != typeof t) return "00:00:00";var e = Math.floor(t / 3600);e < 10 && (e = "0" + e), t %= 3600;var i = Math.floor(t / 60);return i < 10 && (i = "0" + i), (t %= 60) < 10 && (t = "0" + t), e + ":" + i + ":" + t;}var getDomRect = function getDomRect(t, e) {return new Promise(function (i) {var r = uni.createSelectorQuery().in(e);r.select(t).boundingClientRect(), r.exec(function (t) {i(t[0]);});});},imagePrefixUrlMethod = function imagePrefixUrlMethod(t) {if ("string" != typeof t || "" === t.trim()) return "";if (t.indexOf("live.polyv.net") > -1 || t.indexOf("static.live.polyv.net") > -1 || t.indexOf("livestatic.videocc.net") > -1) {if (/^http/.test(t)) {if (t.indexOf(".net") > -1) {return "https://livestatic.videocc.net".concat(t.split(".net")[1]);}} else if (!/^\/\//.test(t)) return "https://livestatic.videocc.net".concat(t);} else {if (/^\/\//.test(t)) return "https:" + t;if (/^\//.test(t)) return "https://livestatic.videocc.net".concat(t);if (/^(?!\/)/.test(t) && !/^http/.test(t)) return "https://img.videocc.net/uimage/".concat(t.slice(0, 1), "/").concat(t);}return t;},isPhoneX = function isPhoneX(t) {return -1 !== t.indexOf("iPhone X");},isArray = function isArray(t) {return "[object Array]" === Object.prototype.toString.call(t);},isString = function isString(t) {return "string" == typeof t;},isFunc = function isFunc(t) {return "function" == typeof t;},isObj = function isObj(t) {return "[object Object]" === Object.prototype.toString.call(t);};var _default = { comparison: comparison, formatTime: formatTime, getDomRect: getDomRect, imagePrefixUrlMethod: imagePrefixUrlMethod, isPhoneX: isPhoneX, isArray: isArray, isString: isString, isFunc: isFunc, isObj: isObj };exports.default = _default;
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! ./node_modules/@dcloudio/uni-mp-weixin/dist/index.js */ 1)["default"]))

/***/ }),

/***/ 379:
/*!************************************************************!*\
  !*** J:/kesionEDU_APP/KS_EDU_APP/客户小程序/首冠小程序定制/api/pay.js ***!
  \************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
Object.defineProperty(exports, "__esModule", { value: true });exports.GetWeiPaySign = GetWeiPaySign;exports.WechatPay = WechatPay;exports.XiaDanWeiPay = XiaDanWeiPay;exports.XiaDanAliPay = XiaDanAliPay;var _mainEntrance = __webpack_require__(/*! ./main.entrance.js */ 18);

/*获取微信支付状态*/
function GetWeiPaySign(params) {
  return (0, _mainEntrance.GET)('/webapi/Pay/GetWeiPaySign', params, ['appToken']);
}
/*微信支付（APP版）*/
function WechatPay(params) {
  return (0, _mainEntrance.GET)('/webapi/Pay/WechatPay', params, ['appToken']);
}
/*微信小程序支付下单*/
function XiaDanWeiPay(params) {
  return (0, _mainEntrance.GET)('/webapi/Pay/XiaDanWeiPay', params, ['appToken']);
}

/*支付宝支付下单*/
function XiaDanAliPay(params) {
  return (0, _mainEntrance.GET)('/webapi/Pay/XiaDanAliPay', params, ['appToken']);
}

/***/ }),

/***/ 38:
/*!**********************************************************************************!*\
  !*** J:/kesionEDU_APP/KS_EDU_APP/客户小程序/首冠小程序定制/lib/polyv/common/utils/config.js ***!
  \**********************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
Object.defineProperty(exports, "__esModule", { value: true });exports.URL = void 0;var URL = { mainHost: "https://api.polyv.net", chatHost: "https://apichat.polyv.net", socketHost: "wss://chat.polyv.net", routerHost: "https://router.polyv.net/proxy" };exports.URL = URL;

/***/ }),

/***/ 39:
/*!*******************************************************************************!*\
  !*** J:/kesionEDU_APP/KS_EDU_APP/客户小程序/首冠小程序定制/lib/polyv/common/api/index.js ***!
  \*******************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
Object.defineProperty(exports, "__esModule", { value: true });exports.default = void 0;var _config = __webpack_require__(/*! ../utils/config */ 38);var _plvRequest = _interopRequireDefault(__webpack_require__(/*! ./plv-request */ 34));function _interopRequireDefault(obj) {return obj && obj.__esModule ? obj : { default: obj };}var mainHost = _config.URL.mainHost,routerHost = _config.URL.routerHost;var _default = { getOpenId: function getOpenId(e) {return (0, _plvRequest.default)(mainHost + "/live/v3/applet/sdk/onlogin-sdk", { qs: { code: e } });}, getUserId: function getUserId(e) {return (0, _plvRequest.default)(mainHost + "/live/v3/applet/sdk/get-chat-userId", { qs: { openId: e } });}, getChannelDetail: function getChannelDetail(e) {return (0, _plvRequest.default)(mainHost + "/live/v3/applet/sdk/get-channel-detail", { qs: { channelId: e } });}, getOrdinaryLiveStatus: function getOrdinaryLiveStatus(e) {return (0, _plvRequest.default)(mainHost + "/live_status/query", { qs: { stream: e } }, !0);}, getPlayBackVideos: function getPlayBackVideos() {var e = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : { pageSize: 500, page: 1 };return (0, _plvRequest.default)(mainHost + "/live/v3/channel/playback/list-actual-playback", { qs: e });}, getChannelKey: function getChannelKey(e) {return (0, _plvRequest.default)("".concat(mainHost, "/live/v2/channels/").concat(e, "/mic-auth"), { qs: { type: "web", timestamp: new Date().getTime() } }, !0);}, getChapterRecords: function getChapterRecords(e) {return (0, _plvRequest.default)("".concat(mainHost, "/live/v3/channel/chat/get-ppt-records"), { qs: e });}, getRestrict: function getRestrict(e) {return (0, _plvRequest.default)("".concat(routerHost, "/livejson.polyv.net/service/v3/restrict.json"), { qs: e }, !0);}, getBackRestrict: function getBackRestrict(e) {return (0, _plvRequest.default)("".concat(routerHost, "/live.polyv.net/service/v3/restrict.json"), { qs: e }, !0);}, getLatestSessionId: function getLatestSessionId(e) {return (0, _plvRequest.default)("".concat(mainHost, "/live/channel-sessionid/query"), { qs: e });} };exports.default = _default;

/***/ }),

/***/ 394:
/*!***************************************************************!*\
  !*** J:/kesionEDU_APP/KS_EDU_APP/客户小程序/首冠小程序定制/api/school.js ***!
  \***************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
Object.defineProperty(exports, "__esModule", { value: true });exports.GetSchoolList = GetSchoolList;exports.GetSchoolInfo = GetSchoolInfo;exports.GetSchoolCourseList = GetSchoolCourseList;exports.GetSchoolInfomation = GetSchoolInfomation;exports.GetSchoolTeacherList = GetSchoolTeacherList;exports.GetSchoolClassList = GetSchoolClassList;var _mainEntrance = __webpack_require__(/*! ./main.entrance.js */ 18);



// 名师列表
function GetSchoolList(params) {
  return (0, _mainEntrance.GET)('/webapi/app/GetSchoolList', params);
}

// 名师详情
function GetSchoolInfo(params) {
  return (0, _mainEntrance.GET)('/webapi/app/GetSchoolInfo', params);
}

// 机构课程查询接口
function GetSchoolCourseList(params) {
  return (0, _mainEntrance.GET)('/webapi/app/GetSchoolCourseList', params);
}

// 机构资讯查询接口
function GetSchoolInfomation(params) {
  return (0, _mainEntrance.GET)('/webapi/app/GetSchoolInfomation', params);
}

// 机构教师查询接口
function GetSchoolTeacherList(params) {
  return (0, _mainEntrance.GET)('/webapi/app/GetSchoolTeacherList', params);
}

// 机构班级查询接口
function GetSchoolClassList(params) {
  return (0, _mainEntrance.GET)('/webapi/app/GetSchoolClassList', params);
}

/***/ }),

/***/ 4:
/*!************************************************************!*\
  !*** J:/kesionEDU_APP/KS_EDU_APP/客户小程序/首冠小程序定制/pages.json ***!
  \************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


/***/ }),

/***/ 457:
/*!*************************************************************!*\
  !*** J:/kesionEDU_APP/KS_EDU_APP/客户小程序/首冠小程序定制/api/exam.js ***!
  \*************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
Object.defineProperty(exports, "__esModule", { value: true });exports.GetAllPaperCategory = GetAllPaperCategory;exports.GetSubjectStatistics = GetSubjectStatistics;exports.GetPaperKnowledge = GetPaperKnowledge;exports.GetPaperSection = GetPaperSection;exports.GetAllPaperType = GetAllPaperType;exports.GetPaperList = GetPaperList;exports.GetTestRecordList = GetTestRecordList;exports.GetPaperRecordList = GetPaperRecordList;exports.DeletePaperRecord = DeletePaperRecord;exports.GetCountErrorTk = GetCountErrorTk;exports.ErrorTkHome = ErrorTkHome;exports.CollectTkHome = CollectTkHome;exports.GetCountCollectTk = GetCountCollectTk;exports.PaperDesc = PaperDesc;exports.SetPaperCollect = SetPaperCollect;exports.GetPaperErrortype = GetPaperErrortype;exports.GetDailyTestPaper = GetDailyTestPaper;exports.GetDailyTestDateList = GetDailyTestDateList;exports.GetPaperDetail = GetPaperDetail;exports.GetTestTk = GetTestTk;exports.SetTkCorrection = SetTkCorrection;exports.SubmitPaperAnswer = SubmitPaperAnswer;exports.SetPaperAnswer = SetPaperAnswer;exports.EndTest = EndTest;exports.EndDailyTest = EndDailyTest;exports.PayPaper = PayPaper;exports.GetPerformance = GetPerformance;exports.PaperSubjective = PaperSubjective;exports.SubmitGrade = SubmitGrade;exports.GetRecordDetail = GetRecordDetail;var _mainEntrance = __webpack_require__(/*! ./main.entrance.js */ 18);

/*获取试卷分类*/
function GetAllPaperCategory(params) {
  return (0, _mainEntrance.GET)('/webapi/paper/GetAllPaperCategory', params, ['appToken', "userId"]);
}
/*获取学习记录数据*/
function GetSubjectStatistics(params) {
  return (0, _mainEntrance.POST)('/webapi/paper/SubjectStatistics', params, ['appToken', "userId"]);
}
/*练习知识点*/
function GetPaperKnowledge(params) {
  return (0, _mainEntrance.GET)('/webapi/paper/GetPaperKnowledge', params, ['appToken', "userId"]);
}
/*练习章节*/
function GetPaperSection(params) {
  return (0, _mainEntrance.POST)('/webapi/paper/GetPaperSection', params, ['appToken', "userId"]);
}
/*获取套卷分类*/
function GetAllPaperType(params) {
  return (0, _mainEntrance.GET)('/webapi/paper/GetAllPaperType', params, ['appToken', "userId"]);
}
/*每日一练*/
function GetPaperList(params) {
  return (0, _mainEntrance.GET)('/webapi/paper/GetPaperList', params, ['appToken', "userId"]);
}

/*获取练习记录*/
function GetTestRecordList(params) {
  return (0, _mainEntrance.POST)('/webapi/user/GetTestRecordList', params, ['appToken', "userId"]);
}
/*获取考试记录*/
function GetPaperRecordList(params) {
  return (0, _mainEntrance.POST)('/webapi/user/GetPaperRecordList', params, ['appToken', "userId"]);
}
/*删除考试记录*/
function DeletePaperRecord(params) {
  return (0, _mainEntrance.POST)('/webapi/user/DeletePaperRecord', params, ['appToken', "userId"]);
}
/*获取错题数*/
function GetCountErrorTk(params) {
  return (0, _mainEntrance.POST)('/webapi/user/GetCountErrorTk', params, ['appToken', "userId"]);
}
/*获取错题数*/
function ErrorTkHome(params) {
  return (0, _mainEntrance.GET)('/webapi/user/ErrorTkHome', params, ['appToken', "userId"]);
}
/*获取收藏数*/
function CollectTkHome(params) {
  return (0, _mainEntrance.GET)('/webapi/user/CollectTkHome', params, ['appToken', "userId"]);
}
/*获取收藏数*/
function GetCountCollectTk(params) {
  return (0, _mainEntrance.POST)('/webapi/user/GetCountCollectTk', params, ['appToken', "userId"]);
}
/**考试内页 */
function PaperDesc(params) {
  return (0, _mainEntrance.GET)("/webapi/paper/PaperDesc", params, ["appToken", "userId"]);
}
/**加入收藏 */
function SetPaperCollect(params) {
  return (0, _mainEntrance.POST)("/webapi/user/SetPaperCollect", params, ["appToken", "userId"]);
}
/**试题纠错类型 */
function GetPaperErrortype(params) {
  return (0, _mainEntrance.POST)("/webapi/paper/GetPaperErrortype", params, ["appToken", "userId"]);
}
/**每日一练内容 */
function GetDailyTestPaper(params) {
  return (0, _mainEntrance.GET)("/webapi/paper/GetDailyTestPaper", params, ["appToken", "userId"]);
}
/**每日一练日期 */
function GetDailyTestDateList(params) {
  return (0, _mainEntrance.GET)("/webapi/paper/GetDailyTestDateList", params, ["appToken", "userId"]);
}
/**试卷显示 */
function GetPaperDetail(params) {
  return (0, _mainEntrance.GET)("/webapi/paper/GetPaperDetail", params, ["appToken", "userId"]);
}
/**获取随机练习题目 */
function GetTestTk(params) {
  return (0, _mainEntrance.POST)("/webapi/paper/GetTestTk", params, ["appToken", "userId"]);
}
/**试题纠错 */
function SetTkCorrection(params) {
  return (0, _mainEntrance.POST)("/webapi/user/SetTkCorrection", params, ["appToken", "userId"]);
}
/**单题提交接口 */
function SubmitPaperAnswer(params) {
  return (0, _mainEntrance.POST)("/webapi/paper/SubmitPaperAnswer", params, ["appToken", "userId"]);
}
/**做题保存 */
function SetPaperAnswer(params) {
  return (0, _mainEntrance.POST)("/webapi/paper/SetPaperAnswer", params, ["appToken", "userId"]);
}
/**结束练习 */
function EndTest(params) {
  return (0, _mainEntrance.POST)("/webapi/paper/EndTest", params, ["appToken", "userId"]);
}
/**每日一练结束练习 */
function EndDailyTest(params) {
  return (0, _mainEntrance.POST)("/webapi/paper/EndDailyTest", params, ["appToken", "userId"]);
}
/**购买练习 */
function PayPaper(params) {
  return (0, _mainEntrance.POST)("/webapi/paper/PayPaper", params, ["appToken", "userId"]);
}
/**获取考试结果 */
function GetPerformance(params) {
  return (0, _mainEntrance.POST)("/webapi/paper/GetPerformance", params, ["appToken", "userId"]);
}
/**学生自己评分 */
function PaperSubjective(params) {
  return (0, _mainEntrance.POST)("/webapi/paper/PaperSubjective", params, ["appToken", "userId"]);
}
/**学生提交评分 */
function SubmitGrade(params) {
  return (0, _mainEntrance.POST)("/webapi/paper/SubmitGrade", params, ["appToken", "userId"]);
}
/**试卷解析 */
function GetRecordDetail(params) {
  return (0, _mainEntrance.GET)("/webapi/paper/GetRecordDetail", params, ["appToken", "userId"]);
}

/***/ }),

/***/ 46:
/*!***************************************************************!*\
  !*** J:/kesionEDU_APP/KS_EDU_APP/客户小程序/首冠小程序定制/api/course.js ***!
  \***************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
Object.defineProperty(exports, "__esModule", { value: true });exports.GetCourseTypeList = GetCourseTypeList;exports.GetCourseClass = GetCourseClass;exports.GetVodList = GetVodList;exports.GetcosInfo = GetcosInfo;exports.PlayVod = PlayVod;exports.PlayLive = PlayLive;exports.getCourseCatalog = getCourseCatalog;exports.GetBj = GetBj;exports.SaveBj = SaveBj;exports.GetPaper = GetPaper;exports.SaveAskTopic = SaveAskTopic;exports.GetUserAskTopList = GetUserAskTopList;exports.SaveLearnProgress = SaveLearnProgress;
var _mainEntrance = __webpack_require__(/*! ./main.entrance.js */ 18);

/*获取课程类型*/
function GetCourseTypeList(params) {
  return (0, _mainEntrance.GET)('/webapi/app/GetCourseTypeList', params, ['appToken']);
}
/*获取课程分类*/
function GetCourseClass(params) {
  return (0, _mainEntrance.GET)('/webapi/Course/GetCourseClass', params);
}
/*获取课程列表*/
function GetVodList(params) {
  return (0, _mainEntrance.GET)('/webapi/Course/GetVodList', params);
}
/*获取课时列表*/
function GetcosInfo(params) {
  return (0, _mainEntrance.GET)('/plus/ajaxs.ashx?a=getcosInfo', params, ['appToken']);
}

/*获取课时播放*/
function PlayVod(params) {
  return (0, _mainEntrance.GET)('/webapi/Course/PlayVod', params, ['appToken']);
}

/*获取直播信息*/
function PlayLive(params) {
  return (0, _mainEntrance.GET)('/webapi/Course/PlayLive', params, ['appToken']);
}

/*获取课时列表(数据重构)*/
function getCourseCatalog() {var props = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};
  return new Promise(function (resolve) {
    /**
                                          * 将秒数转换 mm:ss 格式
                                          * @param ss 秒
                                          */
    var secondsConversion = function secondsConversion(ss) {
      var time = Number(ss);
      var hour = Math.floor(time / 3600);
      var minute = Math.floor((time - hour * 3600) / 60);
      var second = time - hour * 3600 - minute * 60;
      hour = hour.toString().length < 2 ? '0' + hour : hour;
      minute = minute.toString().length < 2 ? '0' + minute : minute;
      second = second.toString().length < 2 ? '0' + second : second;
      return hour === '00' ? minute + ':' + second : hour + ':' + minute + ':' + second;
    };
    var courseType = props.courseType;
    var url = courseType === 'face' ? '/plus/ajaxs.ashx?a=getcosInfo&isface=1' : '/plus/ajaxs.ashx?a=getcosInfo';
    (0, _mainEntrance.GET)(url + '&courseid=' + props.courseid, {
      schoolid: props.schoolid },
    ['appToken']).then(function (data) {

      var coursebuyurl = data.Course.coursebuyurl;
      var teachway = data.Course.teachway;
      /**课程购买情况*/
      var courseFree = data.Course.isfree == 0;
      var specialPermission = false;
      var buyallcos_isCanLearn = false;
      var myPeriodids = [];
      var Pay = data.Pay;
      var isloginplay = data.isloginplay;
      var ispower = data.ispower;
      var timespan = data.timespan;
      /**判断是否有特殊权限*/
      if (ispower == 1) {
        specialPermission = true;

      } else if (Pay) {

        /**是否购买了整个课程*/
        var isbuyallcos = Pay.isbuyallcos;
        var shixian = Pay.shixian;
        if (isbuyallcos == 1) {
          if (shixian == 0) {
            /**该课程未限制时间*/
            buyallcos_isCanLearn = true;
          } else {
            /**限制了时间，检查课程是否已过期*/
            var enddate = new Date(Pay.enddate).getTime();
            if (enddate > timespan) {
              buyallcos_isCanLearn = true;
            }
          }

        } else {
          var _periodlist = Pay.periodlist;
          _periodlist.map(function (period_item) {
            var enddate = period_item.enddate ? new Date(period_item.enddate).getTime() : null;
            var ids = period_item.periodids.split(',');
            for (var p = 0; p < ids.length; p++) {
              myPeriodids.push({
                id: ids[p],
                shixian: period_item.shixian,
                enddate: enddate });

            }
          });
        }
      }
      /**
         * 课程学习情况
         */
      var periodlist = data.Course.periodlist || [];
      var periods = [];
      var periodArr = [];
      var chapterIndex = 0;
      var sectionIndex = 0;
      var periodIndex = 0;
      /*重新构造目录结构*/
      periodlist.map(function (item) {
        var addtype = Number(item.addtype);
        var parentid = item.parentid;
        switch (addtype) {
          case 0:
            /**章*/
            chapterIndex++;
            item.$id = chapterIndex;
            item.$unit = '第 ' + chapterIndex + ' 章';
            item.$textID = '第 ' + chapterIndex + ' 章';
            item.$enname = 'chapter';
            periods.push(item);
            break;
          case 2:
            /**节*/
            item.$enname = 'section';
            if (parentid == 0) {
              sectionIndex++;
              item.$id = sectionIndex;
              item.$unit = '第 ' + sectionIndex + ' 节';
              item.$textID = '第 ' + sectionIndex + ' 节';
              periods.push(item);
            } else {
              periods.map(function (cpt, i) {
                if (cpt.periodid == parentid) {
                  if (!cpt.$childs) {
                    cpt.$childs = [];
                  }
                  item.$id = i + 1 + '.' + (cpt.$childs.length + 1);
                  item.$unit = '第 ' + (cpt.$childs.length + 1) + ' 节';
                  item.$textID = '第' + (i + 1) + '章 ' + (cpt.$childs.length + 1) + '节';
                  cpt.$childs.push(item);
                }
              });
            }
            break;
          case 1:
          case 4:
            /**
                   * isCanLearn
                   * 0 不可观看
                   * 1 可观看
                   * 2 已过期
                   * 3 可试听
                   */
            item.$enname = 'period';
            var isCanLearn = 0;
            if (specialPermission || courseFree || item.isfree == 0 || buyallcos_isCanLearn) {
              /**该课时免费*/
              isCanLearn = 1;
            } else if (item.islistening == 1) {
              isCanLearn = 3;
            } else if (Pay) {
              if (Pay.isbuyallcos == 1 && buyallcos_isCanLearn) {
                /**
                                                                  * 购买了整个课程，并且课程未到期
                                                                  */
                isCanLearn = 1;
              } else {
                /**
                       * 按课时购买
                       * 遍历当前课时是否存在购买队列，并且课时未到期
                       */
                for (var p = 0; p < myPeriodids.length; p++) {
                  var period_item = myPeriodids[p];
                  if (period_item.id == item.periodid) {
                    if (period_item.shixian == 0) {
                      isCanLearn = 1;
                      break;
                    } else {
                      if (period_item.enddate > timespan) {
                        /**课时未到期，已满足学习条件，直接跳出循环*/
                        isCanLearn = 1;
                        break;
                      } else {
                        /**
                               * 当前课时已过期，但不跳出循环，继续查找是否有重复购买同课时并且满足学习条件
                               */
                        if (period_item.islistening == 1) {
                          isCanLearn = 3;
                        } else {
                          isCanLearn = 2;
                        }
                      }
                    }
                  }
                }
              }
            }

            switch (Number(item.type)) {
              case 0:
                item.$type_name = '视频';
                break;
              case 1:
                item.$type_name = '音频';
                break;
              case 2:
                item.$type_name = '图文';
                break;
              case 3:
                item.$type_name = 'PDF';
                break;
              default:
                item.$type_name = '';}

            /**课时时间处理 */
            if (item.type > 1) {
              item.$duration = '';
            } else if (item.timecount) {
              var time = secondsConversion(item.timecount);
              item.$duration = time;
            }
            /**直播时间 */
            if (teachway == 5 && item.livetime && item.invaliddate) {
              var timestamp_liveTime = new Date(item.livetime);
              var timestamp_invaliddate = new Date(item.invaliddate);
              if (timestamp_liveTime > timespan) {
                item.$liveStateText = '直播未开始';
                item.$liveState = 0;
              } else if (timestamp_liveTime < timespan && timestamp_invaliddate > timespan) {
                item.$liveStateText = '正在直播';
                item.$liveState = 1;
              } else if (timestamp_invaliddate < timespan) {
                item.$liveStateText = '直播已结束';
                item.$liveState = 2;
              }
              item.$livetime = timestamp_liveTime.getFullYear() + '/' + (timestamp_liveTime.getMonth() + 1) + '/' + timestamp_liveTime.getDate() + ' ' + timestamp_liveTime.getHours() + ':' + timestamp_liveTime.getMinutes();

              if (timestamp_liveTime.getFullYear() === timestamp_invaliddate.getFullYear() && timestamp_liveTime.getMonth() === timestamp_invaliddate.getMonth() && timestamp_liveTime.getDate() === timestamp_invaliddate.getDate()) {
                item.$invaliddate = timestamp_invaliddate.getHours() + ':' + timestamp_invaliddate.getMinutes();
              } else {
                item.$invaliddate = timestamp_invaliddate.getFullYear() + '/' + (timestamp_invaliddate.getMonth() + 1) + '/' + timestamp_invaliddate.getDate() + ' ' + timestamp_invaliddate.getHours() + ':' + timestamp_invaliddate.getMinutes();
              }
              item.$showLiveTime = true;
            }

            /**课时状态*/
            var stateText = '去购买';

            switch (isCanLearn) {
              case 1:
                if (teachway == 5) {
                  stateText = '进入直播';
                } else {
                  if (item.haslearnpercent > 0) {
                    stateText = '继续学习';
                  } else {
                    stateText = '开始学习';
                  }
                }
                break;
              case 2:
                stateText = '已过期';
                break;
              case 3:
                if (teachway == 5) {
                  stateText = '进入直播';
                } else {
                  stateText = '免费观看';
                }
                break;}

            item.$stateText = stateText;
            item.$isCanLearn = isCanLearn;
            /**更多按钮 */
            var btns = [];
            /**课时存在题库 */
            if (item.haspapertk) {
              btns.push({
                text: '题库练习',
                url: item.exerciseinfo.exercise_url,
                className: 'ks-catalog-title__btn-lx',
                type: 0 },
              {
                text: '练习记录',
                url: item.exerciseinfo.exercise_record_url,
                className: 'ks-catalog-title__btn-record',
                type: 1 });

            }
            /**课时存在资料 */
            if (item.hasmaterial) {
              var obj = {
                text: '课时资料',
                url: item.zlurl,
                className: 'ks-catalog-title__btn-down',
                type: 2 };

              btns.push(obj);
            }
            item.$btns = btns;
            item.$state = isCanLearn === 1 || isCanLearn === 3 ? true : false;
            var _url = isCanLearn === 1 || isCanLearn === 3 ? item.url : coursebuyurl;
            if (item.periodlock !== 'true') {
              item.$url = _url;
            }
            if (item.money) {
              item.$money = parseFloat(item.money) ? parseFloat(item.money).toFixed(2) : false;
            }
            if (parentid == 0) {
              periodIndex++;
              item.$unit = '课时 ' + periodIndex;
              item.$textID = '课时 ' + periodIndex;
              periods.push(item);
            } else {
              periods.map(function (cpt, c) {
                if (cpt.periodid == parentid) {
                  if (!cpt.$childs) {
                    cpt.$childs = [];
                  }
                  var _unit = cpt.addtype == 0 ? '章' : '节';
                  item.$unit = '课时 ' + (cpt.$childs.length + 1);
                  item.$textID = '第' + (c + 1) + _unit;
                  cpt.$childs.push(item);
                } else if (cpt.$childs) {
                  cpt.$childs.map(function (sec, s) {
                    if (sec.periodid == parentid) {
                      if (!sec.$childs) {
                        sec.$childs = [];
                      }
                      item.$unit = '课时 ' + (sec.$childs.length + 1);
                      item.$textID = '第' + (c + 1) + '章 第' + (s + 1) + '节';
                      sec.$childs.push(item);
                    }
                  });
                }
              });
            }
            periodArr.push(item);
            break;}

      });
      resolve({
        periods: periodArr,
        catalogData: data });

    });
  });
}
/*获取课时笔记*/
function GetBj(params) {
  return (0, _mainEntrance.POST)('/webapi/course/GetBj', params, ['appToken']);
}
/*保存提交笔记*/
function SaveBj(params) {
  return (0, _mainEntrance.POST)('/index.aspx?c=course&a=play&action=savebj', params, ['appToken']);
}
/*获取课程试卷*/
function GetPaper(params) {
  return (0, _mainEntrance.POST)('/WebApi/course/GetPaper', params, ['appToken', 'userId']);
}
/*提交提问数据*/
function SaveAskTopic(params) {
  return (0, _mainEntrance.POST)('/webapi/user/SaveAskTopic', params, ['appToken', 'userId']);
}
/*获取提问数据列表*/
function GetUserAskTopList(params) {

  return (0, _mainEntrance.GET)('/webapi/user/GetUserAskTopList', params, ['appToken', 'userId']);
}

/*保存学习进度*/
function SaveLearnProgress(params) {
  return (0, _mainEntrance.GET)('/index.aspx?c=course&a=play&action=save', params, ['appToken']);
}

/***/ }),

/***/ 47:
/*!*********************************************************************!*\
  !*** J:/kesionEDU_APP/KS_EDU_APP/客户小程序/首冠小程序定制/api/class-center.js ***!
  \*********************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
Object.defineProperty(exports, "__esModule", { value: true });exports.GetDataList = GetDataList;exports.GetWorksView = GetWorksView;exports.GetInfoView = GetInfoView;exports.GetAskView = GetAskView;exports.ReplyAskTopic = ReplyAskTopic;exports.CloseAsk = CloseAsk;exports.AddReward = AddReward;exports.SetAskSatisfied = SetAskSatisfied;exports.DeleteAnswer = DeleteAnswer;exports.PublishAskTopic = PublishAskTopic;exports.GetGroupListView = GetGroupListView;exports.JoinGroup = JoinGroup;exports.PublishTopic = PublishTopic;exports.ReplyTopic = ReplyTopic;exports.GetTopicView = GetTopicView;exports.GetAskClass = GetAskClass;exports.GetAllClassList = GetAllClassList;var _mainEntrance = __webpack_require__(/*! ./main.entrance.js */ 18);



// 课间列表
function GetDataList(params) {
  return (0, _mainEntrance.GET)('/webapi/app/home', params);
}
// 作品详情页
function GetWorksView(params) {
  return (0, _mainEntrance.GET)('/webapi/APP/GetWorksView', params);
}
// 资讯详情页
function GetInfoView(params) {
  return (0, _mainEntrance.GET)('/webapi/APP/GetInfoView', params);
}
// 问答详情页
function GetAskView(params) {
  return (0, _mainEntrance.GET)('/webapi/APP/GetAskView', params, ['appToken', 'userId']);
}

// 回复问答
function ReplyAskTopic(params) {
  return (0, _mainEntrance.POST)('/webapi/APP/ReplyAskTopic', params, ['appToken', 'userId']);
}

// 关闭问题
function CloseAsk(params) {
  return (0, _mainEntrance.POST)('/webapi/APP/CloseAsk', params, ['appToken', 'userId']);
}

// 增加悬赏分接口
function AddReward(params) {
  return (0, _mainEntrance.POST)('/webapi/APP/AddReward', params, ['appToken', 'userId']);
}

// 设置回答为最佳答案
function SetAskSatisfied(params) {
  return (0, _mainEntrance.POST)('/webapi/APP/SetAskSatisfied', params, ['appToken', 'userId']);
}

// 删除回复
function DeleteAnswer(params) {
  return (0, _mainEntrance.POST)('/webapi/APP/DeleteAnswer', params, ['appToken', 'userId']);
}

// 发布问题
function PublishAskTopic(params) {
  return (0, _mainEntrance.POST)('/webapi/APP/PublishAskTopic', params, ['appToken', 'userId']);
}

// 小组详情
function GetGroupListView(params) {
  return (0, _mainEntrance.GET)('/webapi/app/GetGroupListView', params, ['appToken', 'userId']);
}

// 申请加入小组
function JoinGroup(params) {
  return (0, _mainEntrance.POST)('/webapi/app/JoinGroup', params, ['appToken', 'userId']);
}

// 发表话题
function PublishTopic(params) {
  return (0, _mainEntrance.POST)('/webapi/app/PublishTopic', params, ['appToken', 'userId']);
}

// 回复话题
function ReplyTopic(params) {
  return (0, _mainEntrance.POST)('/webapi/app/ReplyTopic', params, ['appToken', 'userId']);
}

// 话题详情
function GetTopicView(params) {
  return (0, _mainEntrance.POST)('/webapi/app/GetTopicView', params, ['appToken', 'userId']);
}

// 话题详情
function GetAskClass(params) {
  return (0, _mainEntrance.GET)('/webapi/app/GetAskClass', params, ['appToken', 'userId']);
}

// 班级列表
function GetAllClassList(params) {
  return (0, _mainEntrance.GET)('/webapi/app/GetAllClassList', params);
}

/***/ }),

/***/ 48:
/*!**************************************************************!*\
  !*** J:/kesionEDU_APP/KS_EDU_APP/客户小程序/首冠小程序定制/api/index.js ***!
  \**************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
Object.defineProperty(exports, "__esModule", { value: true });exports.GetHome = GetHome;exports.Generalquery = Generalquery;exports.Getstartup = Getstartup;var _mainEntrance = __webpack_require__(/*! ./main.entrance.js */ 18);

/*获取首页数据*/
function GetHome() {
  return (0, _mainEntrance.GET)('/webapi/app/home?a=index');
}
/*通用搜索*/
function Generalquery(params) {
  return (0, _mainEntrance.POST)('/webApi/APP/Generalquery', params);
}
/*获取引导图数据*/
function Getstartup() {
  return (0, _mainEntrance.GET)('/webapi/app/home?a=getstartup');
}

/***/ }),

/***/ 5:
/*!*******************************************************!*\
  !*** ./node_modules/@dcloudio/uni-stat/dist/index.js ***!
  \*******************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
/* WEBPACK VAR INJECTION */(function(uni) {var _package = __webpack_require__(/*! ../package.json */ 6);function _possibleConstructorReturn(self, call) {if (call && (typeof call === "object" || typeof call === "function")) {return call;}return _assertThisInitialized(self);}function _assertThisInitialized(self) {if (self === void 0) {throw new ReferenceError("this hasn't been initialised - super() hasn't been called");}return self;}function _getPrototypeOf(o) {_getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf : function _getPrototypeOf(o) {return o.__proto__ || Object.getPrototypeOf(o);};return _getPrototypeOf(o);}function _inherits(subClass, superClass) {if (typeof superClass !== "function" && superClass !== null) {throw new TypeError("Super expression must either be null or a function");}subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, writable: true, configurable: true } });if (superClass) _setPrototypeOf(subClass, superClass);}function _setPrototypeOf(o, p) {_setPrototypeOf = Object.setPrototypeOf || function _setPrototypeOf(o, p) {o.__proto__ = p;return o;};return _setPrototypeOf(o, p);}function _classCallCheck(instance, Constructor) {if (!(instance instanceof Constructor)) {throw new TypeError("Cannot call a class as a function");}}function _defineProperties(target, props) {for (var i = 0; i < props.length; i++) {var descriptor = props[i];descriptor.enumerable = descriptor.enumerable || false;descriptor.configurable = true;if ("value" in descriptor) descriptor.writable = true;Object.defineProperty(target, descriptor.key, descriptor);}}function _createClass(Constructor, protoProps, staticProps) {if (protoProps) _defineProperties(Constructor.prototype, protoProps);if (staticProps) _defineProperties(Constructor, staticProps);return Constructor;}

var STAT_VERSION = _package.version;
var STAT_URL = 'https://tongji.dcloud.io/uni/stat';
var STAT_H5_URL = 'https://tongji.dcloud.io/uni/stat.gif';
var PAGE_PVER_TIME = 1800;
var APP_PVER_TIME = 300;
var OPERATING_TIME = 10;

var UUID_KEY = '__DC_STAT_UUID';
var UUID_VALUE = '__DC_UUID_VALUE';

function getUuid() {
  var uuid = '';
  if (getPlatformName() === 'n') {
    try {
      uuid = plus.runtime.getDCloudId();
    } catch (e) {
      uuid = '';
    }
    return uuid;
  }

  try {
    uuid = uni.getStorageSync(UUID_KEY);
  } catch (e) {
    uuid = UUID_VALUE;
  }

  if (!uuid) {
    uuid = Date.now() + '' + Math.floor(Math.random() * 1e7);
    try {
      uni.setStorageSync(UUID_KEY, uuid);
    } catch (e) {
      uni.setStorageSync(UUID_KEY, UUID_VALUE);
    }
  }
  return uuid;
}

var getSgin = function getSgin(statData) {
  var arr = Object.keys(statData);
  var sortArr = arr.sort();
  var sgin = {};
  var sginStr = '';
  for (var i in sortArr) {
    sgin[sortArr[i]] = statData[sortArr[i]];
    sginStr += sortArr[i] + '=' + statData[sortArr[i]] + '&';
  }
  // const options = sginStr.substr(0, sginStr.length - 1)
  // sginStr = sginStr.substr(0, sginStr.length - 1) + '&key=' + STAT_KEY;
  // const si = crypto.createHash('md5').update(sginStr).digest('hex');
  return {
    sign: '',
    options: sginStr.substr(0, sginStr.length - 1) };

};

var getSplicing = function getSplicing(data) {
  var str = '';
  for (var i in data) {
    str += i + '=' + data[i] + '&';
  }
  return str.substr(0, str.length - 1);
};

var getTime = function getTime() {
  return parseInt(new Date().getTime() / 1000);
};

var getPlatformName = function getPlatformName() {
  var platformList = {
    'app-plus': 'n',
    'h5': 'h5',
    'mp-weixin': 'wx',
    'mp-alipay': 'ali',
    'mp-baidu': 'bd',
    'mp-toutiao': 'tt',
    'mp-qq': 'qq' };

  return platformList["mp-weixin"];
};

var getPackName = function getPackName() {
  var packName = '';
  if (getPlatformName() === 'wx' || getPlatformName() === 'qq') {
    // 兼容微信小程序低版本基础库
    if (uni.canIUse('getAccountInfoSync')) {
      packName = uni.getAccountInfoSync().miniProgram.appId || '';
    }
  }
  return packName;
};

var getVersion = function getVersion() {
  return getPlatformName() === 'n' ? plus.runtime.version : '';
};

var getChannel = function getChannel() {
  var platformName = getPlatformName();
  var channel = '';
  if (platformName === 'n') {
    channel = plus.runtime.channel;
  }
  return channel;
};

var getScene = function getScene(options) {
  var platformName = getPlatformName();
  var scene = '';
  if (options) {
    return options;
  }
  if (platformName === 'wx') {
    scene = uni.getLaunchOptionsSync().scene;
  }
  return scene;
};
var First__Visit__Time__KEY = 'First__Visit__Time';
var Last__Visit__Time__KEY = 'Last__Visit__Time';

var getFirstVisitTime = function getFirstVisitTime() {
  var timeStorge = uni.getStorageSync(First__Visit__Time__KEY);
  var time = 0;
  if (timeStorge) {
    time = timeStorge;
  } else {
    time = getTime();
    uni.setStorageSync(First__Visit__Time__KEY, time);
    uni.removeStorageSync(Last__Visit__Time__KEY);
  }
  return time;
};

var getLastVisitTime = function getLastVisitTime() {
  var timeStorge = uni.getStorageSync(Last__Visit__Time__KEY);
  var time = 0;
  if (timeStorge) {
    time = timeStorge;
  } else {
    time = '';
  }
  uni.setStorageSync(Last__Visit__Time__KEY, getTime());
  return time;
};


var PAGE_RESIDENCE_TIME = '__page__residence__time';
var First_Page_residence_time = 0;
var Last_Page_residence_time = 0;


var setPageResidenceTime = function setPageResidenceTime() {
  First_Page_residence_time = getTime();
  if (getPlatformName() === 'n') {
    uni.setStorageSync(PAGE_RESIDENCE_TIME, getTime());
  }
  return First_Page_residence_time;
};

var getPageResidenceTime = function getPageResidenceTime() {
  Last_Page_residence_time = getTime();
  if (getPlatformName() === 'n') {
    First_Page_residence_time = uni.getStorageSync(PAGE_RESIDENCE_TIME);
  }
  return Last_Page_residence_time - First_Page_residence_time;
};
var TOTAL__VISIT__COUNT = 'Total__Visit__Count';
var getTotalVisitCount = function getTotalVisitCount() {
  var timeStorge = uni.getStorageSync(TOTAL__VISIT__COUNT);
  var count = 1;
  if (timeStorge) {
    count = timeStorge;
    count++;
  }
  uni.setStorageSync(TOTAL__VISIT__COUNT, count);
  return count;
};

var GetEncodeURIComponentOptions = function GetEncodeURIComponentOptions(statData) {
  var data = {};
  for (var prop in statData) {
    data[prop] = encodeURIComponent(statData[prop]);
  }
  return data;
};

var Set__First__Time = 0;
var Set__Last__Time = 0;

var getFirstTime = function getFirstTime() {
  var time = new Date().getTime();
  Set__First__Time = time;
  Set__Last__Time = 0;
  return time;
};


var getLastTime = function getLastTime() {
  var time = new Date().getTime();
  Set__Last__Time = time;
  return time;
};


var getResidenceTime = function getResidenceTime(type) {
  var residenceTime = 0;
  if (Set__First__Time !== 0) {
    residenceTime = Set__Last__Time - Set__First__Time;
  }

  residenceTime = parseInt(residenceTime / 1000);
  residenceTime = residenceTime < 1 ? 1 : residenceTime;
  if (type === 'app') {
    var overtime = residenceTime > APP_PVER_TIME ? true : false;
    return {
      residenceTime: residenceTime,
      overtime: overtime };

  }
  if (type === 'page') {
    var _overtime = residenceTime > PAGE_PVER_TIME ? true : false;
    return {
      residenceTime: residenceTime,
      overtime: _overtime };

  }

  return {
    residenceTime: residenceTime };


};

var getRoute = function getRoute() {
  var pages = getCurrentPages();
  var page = pages[pages.length - 1];
  var _self = page.$vm;

  if (getPlatformName() === 'bd') {
    return _self.$mp && _self.$mp.page.is;
  } else {
    return _self.$scope && _self.$scope.route || _self.$mp && _self.$mp.page.route;
  }
};

var getPageRoute = function getPageRoute(self) {
  var pages = getCurrentPages();
  var page = pages[pages.length - 1];
  var _self = page.$vm;
  var query = self._query;
  var str = query && JSON.stringify(query) !== '{}' ? '?' + JSON.stringify(query) : '';
  // clear
  self._query = '';
  if (getPlatformName() === 'bd') {
    return _self.$mp && _self.$mp.page.is + str;
  } else {
    return _self.$scope && _self.$scope.route + str || _self.$mp && _self.$mp.page.route + str;
  }
};

var getPageTypes = function getPageTypes(self) {
  if (self.mpType === 'page' || self.$mp && self.$mp.mpType === 'page' || self.$options.mpType === 'page') {
    return true;
  }
  return false;
};

var calibration = function calibration(eventName, options) {
  //  login 、 share 、pay_success 、pay_fail 、register 、title
  if (!eventName) {
    console.error("uni.report \u7F3A\u5C11 [eventName] \u53C2\u6570");
    return true;
  }
  if (typeof eventName !== 'string') {
    console.error("uni.report [eventName] \u53C2\u6570\u7C7B\u578B\u9519\u8BEF,\u53EA\u80FD\u4E3A String \u7C7B\u578B");
    return true;
  }
  if (eventName.length > 255) {
    console.error("uni.report [eventName] \u53C2\u6570\u957F\u5EA6\u4E0D\u80FD\u5927\u4E8E 255");
    return true;
  }

  if (typeof options !== 'string' && typeof options !== 'object') {
    console.error("uni.report [options] \u53C2\u6570\u7C7B\u578B\u9519\u8BEF,\u53EA\u80FD\u4E3A String \u6216 Object \u7C7B\u578B");
    return true;
  }

  if (typeof options === 'string' && options.length > 255) {
    console.error("uni.report [options] \u53C2\u6570\u957F\u5EA6\u4E0D\u80FD\u5927\u4E8E 255");
    return true;
  }

  if (eventName === 'title' && typeof options !== 'string') {
    console.error('uni.report [eventName] 参数为 title 时，[options] 参数只能为 String 类型');
    return true;
  }
};

var PagesJson = __webpack_require__(/*! uni-pages?{"type":"style"} */ 7).default;
var statConfig = __webpack_require__(/*! uni-stat-config */ 8).default || __webpack_require__(/*! uni-stat-config */ 8);

var resultOptions = uni.getSystemInfoSync();var

Util = /*#__PURE__*/function () {
  function Util() {_classCallCheck(this, Util);
    this.self = '';
    this._retry = 0;
    this._platform = '';
    this._query = {};
    this._navigationBarTitle = {
      config: '',
      page: '',
      report: '',
      lt: '' };

    this._operatingTime = 0;
    this._reportingRequestData = {
      '1': [],
      '11': [] };

    this.__prevent_triggering = false;

    this.__licationHide = false;
    this.__licationShow = false;
    this._lastPageRoute = '';
    this.statData = {
      uuid: getUuid(),
      ut: getPlatformName(),
      mpn: getPackName(),
      ak: statConfig.appid,
      usv: STAT_VERSION,
      v: getVersion(),
      ch: getChannel(),
      cn: '',
      pn: '',
      ct: '',
      t: getTime(),
      tt: '',
      p: resultOptions.platform === 'android' ? 'a' : 'i',
      brand: resultOptions.brand || '',
      md: resultOptions.model,
      sv: resultOptions.system.replace(/(Android|iOS)\s/, ''),
      mpsdk: resultOptions.SDKVersion || '',
      mpv: resultOptions.version || '',
      lang: resultOptions.language,
      pr: resultOptions.pixelRatio,
      ww: resultOptions.windowWidth,
      wh: resultOptions.windowHeight,
      sw: resultOptions.screenWidth,
      sh: resultOptions.screenHeight };


  }_createClass(Util, [{ key: "_applicationShow", value: function _applicationShow()

    {
      if (this.__licationHide) {
        getLastTime();
        var time = getResidenceTime('app');
        if (time.overtime) {
          var options = {
            path: this._lastPageRoute,
            scene: this.statData.sc };

          this._sendReportRequest(options);
        }
        this.__licationHide = false;
      }
    } }, { key: "_applicationHide", value: function _applicationHide(

    self, type) {

      this.__licationHide = true;
      getLastTime();
      var time = getResidenceTime();
      getFirstTime();
      var route = getPageRoute(this);
      this._sendHideRequest({
        urlref: route,
        urlref_ts: time.residenceTime },
      type);
    } }, { key: "_pageShow", value: function _pageShow()

    {
      var route = getPageRoute(this);
      var routepath = getRoute();
      this._navigationBarTitle.config = PagesJson &&
      PagesJson.pages[routepath] &&
      PagesJson.pages[routepath].titleNView &&
      PagesJson.pages[routepath].titleNView.titleText ||
      PagesJson &&
      PagesJson.pages[routepath] &&
      PagesJson.pages[routepath].navigationBarTitleText || '';

      if (this.__licationShow) {
        getFirstTime();
        this.__licationShow = false;
        // console.log('这是 onLauch 之后执行的第一次 pageShow ，为下次记录时间做准备');
        this._lastPageRoute = route;
        return;
      }

      getLastTime();
      this._lastPageRoute = route;
      var time = getResidenceTime('page');
      if (time.overtime) {
        var options = {
          path: this._lastPageRoute,
          scene: this.statData.sc };

        this._sendReportRequest(options);
      }
      getFirstTime();
    } }, { key: "_pageHide", value: function _pageHide()

    {
      if (!this.__licationHide) {
        getLastTime();
        var time = getResidenceTime('page');
        this._sendPageRequest({
          url: this._lastPageRoute,
          urlref: this._lastPageRoute,
          urlref_ts: time.residenceTime });

        this._navigationBarTitle = {
          config: '',
          page: '',
          report: '',
          lt: '' };

        return;
      }
    } }, { key: "_login", value: function _login()

    {
      this._sendEventRequest({
        key: 'login' },
      0);
    } }, { key: "_share", value: function _share()

    {
      this._sendEventRequest({
        key: 'share' },
      0);
    } }, { key: "_payment", value: function _payment(
    key) {
      this._sendEventRequest({
        key: key },
      0);
    } }, { key: "_sendReportRequest", value: function _sendReportRequest(
    options) {

      this._navigationBarTitle.lt = '1';
      var query = options.query && JSON.stringify(options.query) !== '{}' ? '?' + JSON.stringify(options.query) : '';
      this.statData.lt = '1';
      this.statData.url = options.path + query || '';
      this.statData.t = getTime();
      this.statData.sc = getScene(options.scene);
      this.statData.fvts = getFirstVisitTime();
      this.statData.lvts = getLastVisitTime();
      this.statData.tvc = getTotalVisitCount();
      if (getPlatformName() === 'n') {
        this.getProperty();
      } else {
        this.getNetworkInfo();
      }
    } }, { key: "_sendPageRequest", value: function _sendPageRequest(

    opt) {var

      url =


      opt.url,urlref = opt.urlref,urlref_ts = opt.urlref_ts;
      this._navigationBarTitle.lt = '11';
      var options = {
        ak: this.statData.ak,
        uuid: this.statData.uuid,
        lt: '11',
        ut: this.statData.ut,
        url: url,
        tt: this.statData.tt,
        urlref: urlref,
        urlref_ts: urlref_ts,
        ch: this.statData.ch,
        usv: this.statData.usv,
        t: getTime(),
        p: this.statData.p };

      this.request(options);
    } }, { key: "_sendHideRequest", value: function _sendHideRequest(

    opt, type) {var

      urlref =

      opt.urlref,urlref_ts = opt.urlref_ts;
      var options = {
        ak: this.statData.ak,
        uuid: this.statData.uuid,
        lt: '3',
        ut: this.statData.ut,
        urlref: urlref,
        urlref_ts: urlref_ts,
        ch: this.statData.ch,
        usv: this.statData.usv,
        t: getTime(),
        p: this.statData.p };

      this.request(options, type);
    } }, { key: "_sendEventRequest", value: function _sendEventRequest()



    {var _ref = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {},_ref$key = _ref.key,key = _ref$key === void 0 ? '' : _ref$key,_ref$value = _ref.value,value = _ref$value === void 0 ? "" : _ref$value;
      var route = this._lastPageRoute;
      var options = {
        ak: this.statData.ak,
        uuid: this.statData.uuid,
        lt: '21',
        ut: this.statData.ut,
        url: route,
        ch: this.statData.ch,
        e_n: key,
        e_v: typeof value === 'object' ? JSON.stringify(value) : value.toString(),
        usv: this.statData.usv,
        t: getTime(),
        p: this.statData.p };

      this.request(options);
    } }, { key: "getNetworkInfo", value: function getNetworkInfo()

    {var _this = this;
      uni.getNetworkType({
        success: function success(result) {
          _this.statData.net = result.networkType;
          _this.getLocation();
        } });

    } }, { key: "getProperty", value: function getProperty()

    {var _this2 = this;
      plus.runtime.getProperty(plus.runtime.appid, function (wgtinfo) {
        _this2.statData.v = wgtinfo.version || '';
        _this2.getNetworkInfo();
      });
    } }, { key: "getLocation", value: function getLocation()

    {var _this3 = this;
      if (statConfig.getLocation) {
        uni.getLocation({
          type: 'wgs84',
          geocode: true,
          success: function success(result) {
            if (result.address) {
              _this3.statData.cn = result.address.country;
              _this3.statData.pn = result.address.province;
              _this3.statData.ct = result.address.city;
            }

            _this3.statData.lat = result.latitude;
            _this3.statData.lng = result.longitude;
            _this3.request(_this3.statData);
          } });

      } else {
        this.statData.lat = 0;
        this.statData.lng = 0;
        this.request(this.statData);
      }
    } }, { key: "request", value: function request(

    data, type) {var _this4 = this;
      var time = getTime();
      var title = this._navigationBarTitle;
      data.ttn = title.page;
      data.ttpj = title.config;
      data.ttc = title.report;

      var requestData = this._reportingRequestData;
      if (getPlatformName() === 'n') {
        requestData = uni.getStorageSync('__UNI__STAT__DATA') || {};
      }
      if (!requestData[data.lt]) {
        requestData[data.lt] = [];
      }
      requestData[data.lt].push(data);

      if (getPlatformName() === 'n') {
        uni.setStorageSync('__UNI__STAT__DATA', requestData);
      }
      if (getPageResidenceTime() < OPERATING_TIME && !type) {
        return;
      }
      var uniStatData = this._reportingRequestData;
      if (getPlatformName() === 'n') {
        uniStatData = uni.getStorageSync('__UNI__STAT__DATA');
      }
      // 时间超过，重新获取时间戳
      setPageResidenceTime();
      var firstArr = [];
      var contentArr = [];
      var lastArr = [];var _loop = function _loop(

      i) {
        var rd = uniStatData[i];
        rd.forEach(function (elm) {
          var newData = getSplicing(elm);
          if (i === 0) {
            firstArr.push(newData);
          } else if (i === 3) {
            lastArr.push(newData);
          } else {
            contentArr.push(newData);
          }
        });};for (var i in uniStatData) {_loop(i);
      }

      firstArr.push.apply(firstArr, contentArr.concat(lastArr));
      var optionsData = {
        usv: STAT_VERSION, //统计 SDK 版本号
        t: time, //发送请求时的时间戮
        requests: JSON.stringify(firstArr) };


      this._reportingRequestData = {};
      if (getPlatformName() === 'n') {
        uni.removeStorageSync('__UNI__STAT__DATA');
      }

      if (data.ut === 'h5') {
        this.imageRequest(optionsData);
        return;
      }

      if (getPlatformName() === 'n' && this.statData.p === 'a') {
        setTimeout(function () {
          _this4._sendRequest(optionsData);
        }, 200);
        return;
      }
      this._sendRequest(optionsData);
    } }, { key: "_sendRequest", value: function _sendRequest(
    optionsData) {var _this5 = this;
      uni.request({
        url: STAT_URL,
        method: 'POST',
        // header: {
        //   'content-type': 'application/json' // 默认值
        // },
        data: optionsData,
        success: function success() {
          // if (process.env.NODE_ENV === 'development') {
          //   console.log('stat request success');
          // }
        },
        fail: function fail(e) {
          if (++_this5._retry < 3) {
            setTimeout(function () {
              _this5._sendRequest(optionsData);
            }, 1000);
          }
        } });

    }
    /**
       * h5 请求
       */ }, { key: "imageRequest", value: function imageRequest(
    data) {
      var image = new Image();
      var options = getSgin(GetEncodeURIComponentOptions(data)).options;
      image.src = STAT_H5_URL + '?' + options;
    } }, { key: "sendEvent", value: function sendEvent(

    key, value) {
      // 校验 type 参数
      if (calibration(key, value)) return;

      if (key === 'title') {
        this._navigationBarTitle.report = value;
        return;
      }
      this._sendEventRequest({
        key: key,
        value: typeof value === 'object' ? JSON.stringify(value) : value },
      1);
    } }]);return Util;}();var



Stat = /*#__PURE__*/function (_Util) {_inherits(Stat, _Util);_createClass(Stat, null, [{ key: "getInstance", value: function getInstance()
    {
      if (!this.instance) {
        this.instance = new Stat();
      }
      return this.instance;
    } }]);
  function Stat() {var _this6;_classCallCheck(this, Stat);
    _this6 = _possibleConstructorReturn(this, _getPrototypeOf(Stat).call(this));
    _this6.instance = null;
    // 注册拦截器
    if (typeof uni.addInterceptor === 'function' && "development" !== 'development') {
      _this6.addInterceptorInit();
      _this6.interceptLogin();
      _this6.interceptShare(true);
      _this6.interceptRequestPayment();
    }return _this6;
  }_createClass(Stat, [{ key: "addInterceptorInit", value: function addInterceptorInit()

    {
      var self = this;
      uni.addInterceptor('setNavigationBarTitle', {
        invoke: function invoke(args) {
          self._navigationBarTitle.page = args.title;
        } });

    } }, { key: "interceptLogin", value: function interceptLogin()

    {
      var self = this;
      uni.addInterceptor('login', {
        complete: function complete() {
          self._login();
        } });

    } }, { key: "interceptShare", value: function interceptShare(

    type) {
      var self = this;
      if (!type) {
        self._share();
        return;
      }
      uni.addInterceptor('share', {
        success: function success() {
          self._share();
        },
        fail: function fail() {
          self._share();
        } });

    } }, { key: "interceptRequestPayment", value: function interceptRequestPayment()

    {
      var self = this;
      uni.addInterceptor('requestPayment', {
        success: function success() {
          self._payment('pay_success');
        },
        fail: function fail() {
          self._payment('pay_fail');
        } });

    } }, { key: "report", value: function report(

    options, self) {
      this.self = self;
      // if (process.env.NODE_ENV === 'development') {
      //   console.log('report init');
      // }
      setPageResidenceTime();
      this.__licationShow = true;
      this._sendReportRequest(options, true);
    } }, { key: "load", value: function load(

    options, self) {
      if (!self.$scope && !self.$mp) {
        var page = getCurrentPages();
        self.$scope = page[page.length - 1];
      }
      this.self = self;
      this._query = options;
    } }, { key: "show", value: function show(

    self) {
      this.self = self;
      if (getPageTypes(self)) {
        this._pageShow(self);
      } else {
        this._applicationShow(self);
      }
    } }, { key: "ready", value: function ready(

    self) {
      // this.self = self;
      // if (getPageTypes(self)) {
      //   this._pageShow(self);
      // }
    } }, { key: "hide", value: function hide(
    self) {
      this.self = self;
      if (getPageTypes(self)) {
        this._pageHide(self);
      } else {
        this._applicationHide(self, true);
      }
    } }, { key: "error", value: function error(
    em) {
      if (this._platform === 'devtools') {
        if (true) {
          console.info('当前运行环境为开发者工具，不上报数据。');
        }
        // return;
      }
      var emVal = '';
      if (!em.message) {
        emVal = JSON.stringify(em);
      } else {
        emVal = em.stack;
      }
      var options = {
        ak: this.statData.ak,
        uuid: this.statData.uuid,
        lt: '31',
        ut: this.statData.ut,
        ch: this.statData.ch,
        mpsdk: this.statData.mpsdk,
        mpv: this.statData.mpv,
        v: this.statData.v,
        em: emVal,
        usv: this.statData.usv,
        t: getTime(),
        p: this.statData.p };

      this.request(options);
    } }]);return Stat;}(Util);


var stat = Stat.getInstance();
var isHide = false;
var lifecycle = {
  onLaunch: function onLaunch(options) {
    stat.report(options, this);
  },
  onReady: function onReady() {
    stat.ready(this);
  },
  onLoad: function onLoad(options) {
    stat.load(options, this);
    // 重写分享，获取分享上报事件
    if (this.$scope && this.$scope.onShareAppMessage) {
      var oldShareAppMessage = this.$scope.onShareAppMessage;
      this.$scope.onShareAppMessage = function (options) {
        stat.interceptShare(false);
        return oldShareAppMessage.call(this, options);
      };
    }
  },
  onShow: function onShow() {
    isHide = false;
    stat.show(this);
  },
  onHide: function onHide() {
    isHide = true;
    stat.hide(this);
  },
  onUnload: function onUnload() {
    if (isHide) {
      isHide = false;
      return;
    }
    stat.hide(this);
  },
  onError: function onError(e) {
    stat.error(e);
  } };


function main() {
  if (true) {
    uni.report = function (type, options) {};
  } else { var Vue; }
}

main();
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! ./node_modules/@dcloudio/uni-mp-weixin/dist/index.js */ 1)["default"]))

/***/ }),

/***/ 538:
/*!****************************************************************!*\
  !*** J:/kesionEDU_APP/KS_EDU_APP/客户小程序/首冠小程序定制/utils/index.js ***!
  \****************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
Object.defineProperty(exports, "__esModule", { value: true });exports.default = void 0;var Utils;
(function () {
  var letters = [];
  for (var i = 65; i < 91; i++) {
    letters.push(String.fromCharCode(i));
  }
  Utils = {
    /**
             * 数组遍历
             * @param {Array} data 
             * @param {Function} fn 
             */
    map: function map(data, fn) {
      if (data instanceof Array) {
        for (var i = 0; i < data.length; i++) {
          typeof fn === 'function' && fn(data[i], i);
        }
      } else {
        return false;
      }
    },
    /**
        * 判断数据是数组还是对象
        */
    isArrayOrObject: function isArrayOrObject(data) {
      var callType = Object.prototype.toString.call(data);
      var type = false;
      if (callType === '[object Array]') {
        type = 'Array';
      } else if (callType === '[object Object]') {
        type = 'Object';
      }
      return type;
    },

    /**
        * 根据下标返回字母
        * @param {Number}
        */
    getLetter: function getLetter(i) {
      return letters[i];
    },

    /**
        * 根据子母返回下标
        * @param {Number}
        */
    getLetterIndex: function getLetterIndex(letter) {
      var index = 0;
      letters.map(function (ltr, i) {
        if (ltr == letter) {
          index = i;
        }
      });
      return index;
    },
    /**
        * 判断是否滚动至底部
        */
    getIsScrolltolower: function getIsScrolltolower(el) {
      var isScrolltolower = false;
      if (el) {
        if (el.scrollTop + el.offsetHeight >= el.scrollHeight) {
          isScrolltolower = true;
        }
      } else {
        if (window.scrollY + window.innerHeight >= document.getElementsByTagName('body')[0].scrollHeight) {
          isScrolltolower = true;
        }
      }

      return isScrolltolower;
    },
    /**
        * 判断手机号
        */
    isPoneAvailable: function isPoneAvailable(str) {
      var myreg = /^[1][3,4,5,7,8,9][0-9]{9}$/;
      if (!myreg.test(str)) {
        return false;
      } else {
        return true;
      }
    },
    /**
            * 获取时间（仿微信消息格式）
            */
    getHistoryTime: function getHistoryTime(time, SERVER_TIME) {
      if (typeof time === 'string') {
        time = time.replace(/\-/g, '/');
      }
      var createTime = new Date(time);
      var diff = SERVER_TIME - createTime;
      if (diff <= 3000)
      return '刚刚';else
      if (diff <= 60 * 1000)
      return "1分钟内";else
      if (diff <= 1000 * 60 * 60)
      return parseInt(diff / (60 * 1000)) + '分钟前';else
      if (diff <= 1000 * 60 * 60)
      return parseInt(diff / (1000 * 60 * 60)) + '小时前';else
      if (diff <= 1000 * 60 * 60 * 12 * 2) {
        var list = createTime.toString().split(" ");
        var lastIndex = list[4].lastIndexOf(":");
        var realtime = list[4].toString().substring(0, lastIndex);
        return realtime;
      } else if (diff < 1000 * 60 * 60 * 24 * 1 * 7) {
        if (diff < 1000 * 60 * 60 * 24 * 1) {
          return parseInt(diff / (1000 * 60 * 60 * 12)) + '天前';
        }
        var t = createTime.toString().slice(0, 3);
        switch (t) {
          case "Mon":
            return '星期一';
          case "Tue":
            return '星期二';
          case "Wed":
            return '星期三';
          case "Thu":
            return '星期四';
          case "Fri":
            return '星期五';
          case "Sat":
            return '星期六';
          case "Sun":
            return '星期日';}

      } else if (diff < 1000 * 60 * 60 * 24 * 30 * 24) {
        var list = createTime.toString().split(" ");
        var month = list[1];
        var realtime = "";
        if (diff < 1000 * 60 * 60 * 24 * 30) {
          realtime += getNumberMonth(month);
        } else {
          realtime = list[3] + "-" + getNumberMonth(month);
        }
        return realtime + "-" + list[2];
      }
    } };

})();var _default =
Utils;exports.default = _default;

/***/ }),

/***/ 571:
/*!*********************************************************************!*\
  !*** J:/kesionEDU_APP/KS_EDU_APP/客户小程序/首冠小程序定制/utils/play.learn.js ***!
  \*********************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
Object.defineProperty(exports, "__esModule", { value: true });exports.default = void 0;var _course = __webpack_require__(/*! @/api/course */ 46);function _classCallCheck(instance, Constructor) {if (!(instance instanceof Constructor)) {throw new TypeError("Cannot call a class as a function");}}function _defineProperties(target, props) {for (var i = 0; i < props.length; i++) {var descriptor = props[i];descriptor.enumerable = descriptor.enumerable || false;descriptor.configurable = true;if ("value" in descriptor) descriptor.writable = true;Object.defineProperty(target, descriptor.key, descriptor);}}function _createClass(Constructor, protoProps, staticProps) {if (protoProps) _defineProperties(Constructor.prototype, protoProps);if (staticProps) _defineProperties(Constructor, staticProps);return Constructor;}var
PlayerLearn = /*#__PURE__*/function () {
  function PlayerLearn(params) {var _this = this;_classCallCheck(this, PlayerLearn);
    this.init(params);
    setInterval(function () {
      if (_this.saveFlag) {
        _this.time += 1;
        if (_this.time >= 6) {
          _this.save();
          _this.time = 0;
        }
      }
    }, 1000);
  }_createClass(PlayerLearn, [{ key: "init", value: function init()
    {var params = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};
      this.time = 0;
      this.saveFlag = false;
      this.params = params;
      if (params.type == 2) {
        this.currentTime = 1;
        this.duration = 1;
        this.save(1);
      } else {
        this.currentTime = 0;
        this.duration = 0;
      }
    } }, { key: "onplay", value: function onplay(
    e) {
      this.saveFlag = true;
    } }, { key: "onpause", value: function onpause()
    {
      this.saveFlag = false;
      this.save(1);
    } }, { key: "ontimeupdate", value: function ontimeupdate(
    e) {
      this.currentTime = Math.round(e.detail.currentTime);
      this.duration = Math.round(e.detail.duration);
      if (this.params.audition > 0 && this.currentTime >= this.params.audition) {
        if (typeof this.params.onAuditionEnded === 'function') {
          this.params.onAuditionEnded();
        }
      }
    } }, { key: "onended", value: function onended()
    {
      this.saveFlag = false;
      this.save(1);
    } }, { key: "save", value: function save()
    {var _this2 = this;var savetodb = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 0;
      if (this.saveing) {
        return;
      }
      this.saveing = true;
      (0, _course.SaveLearnProgress)({
        courseid: this.params.courseid,
        pid: this.params.periodid,
        costype: this.params.costype,
        time: this.currentTime,
        totaltime: this.duration,
        savetodb: savetodb }).
      then(function (msg) {
        _this2.saveing = false;
        if (typeof _this2.params.onSaveCallback === 'onSaveCallback') {
          _this2.params.onSaveCallback(msg);
        }
      });
    } }]);return PlayerLearn;}();var _default =



PlayerLearn;exports.default = _default;

/***/ }),

/***/ 6:
/*!******************************************************!*\
  !*** ./node_modules/@dcloudio/uni-stat/package.json ***!
  \******************************************************/
/*! exports provided: _from, _id, _inBundle, _integrity, _location, _phantomChildren, _requested, _requiredBy, _resolved, _shasum, _spec, _where, author, bugs, bundleDependencies, deprecated, description, devDependencies, files, gitHead, homepage, license, main, name, repository, scripts, version, default */
/***/ (function(module) {

module.exports = {"_from":"@dcloudio/uni-stat@^2.0.0-alpha-24420191128001","_id":"@dcloudio/uni-stat@2.0.0-v3-24020191018001","_inBundle":false,"_integrity":"sha512-nYBm5pRrYzrj2dKMqucWSF2PwInUMnn3MLHM/ik3gnLUEKSW61rzcY1RPlUwaH7c+Snm6N+bAJzmj3GvlrlVXA==","_location":"/@dcloudio/uni-stat","_phantomChildren":{},"_requested":{"type":"range","registry":true,"raw":"@dcloudio/uni-stat@^2.0.0-alpha-24420191128001","name":"@dcloudio/uni-stat","escapedName":"@dcloudio%2funi-stat","scope":"@dcloudio","rawSpec":"^2.0.0-alpha-24420191128001","saveSpec":null,"fetchSpec":"^2.0.0-alpha-24420191128001"},"_requiredBy":["/","/@dcloudio/vue-cli-plugin-uni"],"_resolved":"https://registry.npmjs.org/@dcloudio/uni-stat/-/uni-stat-2.0.0-v3-24020191018001.tgz","_shasum":"6ef04326cc0b945726413eebe442ab8f47c7536c","_spec":"@dcloudio/uni-stat@^2.0.0-alpha-24420191128001","_where":"/Users/guoshengqiang/Documents/dcloud-plugins/alpha/uniapp-cli","author":"","bugs":{"url":"https://github.com/dcloudio/uni-app/issues"},"bundleDependencies":false,"deprecated":false,"description":"","devDependencies":{"@babel/core":"^7.5.5","@babel/preset-env":"^7.5.5","eslint":"^6.1.0","rollup":"^1.19.3","rollup-plugin-babel":"^4.3.3","rollup-plugin-clear":"^2.0.7","rollup-plugin-commonjs":"^10.0.2","rollup-plugin-copy":"^3.1.0","rollup-plugin-eslint":"^7.0.0","rollup-plugin-json":"^4.0.0","rollup-plugin-node-resolve":"^5.2.0","rollup-plugin-replace":"^2.2.0","rollup-plugin-uglify":"^6.0.2"},"files":["dist","package.json","LICENSE"],"gitHead":"197e8df53cc9d4c3f6eb722b918ccf51672b5cfe","homepage":"https://github.com/dcloudio/uni-app#readme","license":"Apache-2.0","main":"dist/index.js","name":"@dcloudio/uni-stat","repository":{"type":"git","url":"git+https://github.com/dcloudio/uni-app.git","directory":"packages/uni-stat"},"scripts":{"build":"NODE_ENV=production rollup -c rollup.config.js","dev":"NODE_ENV=development rollup -w -c rollup.config.js"},"version":"2.0.0-v3-24020191018001"};

/***/ }),

/***/ 7:
/*!*****************************************************************************!*\
  !*** J:/kesionEDU_APP/KS_EDU_APP/客户小程序/首冠小程序定制/pages.json?{"type":"style"} ***!
  \*****************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
Object.defineProperty(exports, "__esModule", { value: true });exports.default = void 0;var _default = { "pages": { "pages/index/index": { "navigationBarTitleText": "首页", "navigationBarBackgroundColor": "#FFFFFF", "enablePullDownRefresh": true }, "pages/service/service": { "navigationBarTitleText": "在线客服", "navigationBarBackgroundColor": "#FFFFFF" }, "pages/course/commentlist": { "navigationBarTitleText": "提问列表", "navigationBarBackgroundColor": "#FFFFFF" }, "pages/class/commentlist": { "navigationBarTitleText": "提问列表", "navigationBarBackgroundColor": "#FFFFFF" }, "pages/class/index": { "navigationBarTitleText": "班级列表", "navigationBarBackgroundColor": "#FFFFFF", "enablePullDownRefresh": true }, "pages/class-center/index": { "navigationBarTitleText": "课间", "navigationBarBackgroundColor": "#FFFFFF" }, "pages/class-center/group/details": { "navigationBarTitleText": "小组详情", "navigationBarBackgroundColor": "#FFFFFF" }, "pages/class-center/group/topicview": { "navigationBarTitleText": "话题详情", "navigationBarBackgroundColor": "#FFFFFF" }, "pages/class-center/group/topic": { "navigationBarTitleText": "发表话题", "navigationBarBackgroundColor": "#FFFFFF" }, "pages/class-center/ask/details": { "navigationBarTitleText": "问答详情", "navigationBarBackgroundColor": "#FFFFFF" }, "pages/class-center/ask/question": { "navigationBarTitleText": "发布问题", "navigationBarBackgroundColor": "#FFFFFF" }, "pages/class-center/photo/details": { "navigationBarTitleText": "作品详情", "navigationBarBackgroundColor": "#FFFFFF" }, "pages/teacher/index": { "navigationBarTitleText": "名师", "navigationBarBackgroundColor": "#FFFFFF", "enablePullDownRefresh": true }, "pages/teacher/details": { "navigationBarTitleText": "", "navigationBarBackgroundColor": "#ff663d", "backgroundColor": "#ffffff", "navigationBarTextStyle": "white" }, "pages/teacher/evaluation": { "navigationBarTitleText": "写评价", "navigationBarBackgroundColor": "#ff663d", "navigationBarTextStyle": "white", "backgroundColor": "#ffffff" }, "pages/teacher/question": { "navigationBarTitleText": "留言", "navigationBarBackgroundColor": "#ff663d", "navigationBarTextStyle": "white", "enablePullDownRefresh": true }, "pages/learn-record/index": { "navigationBarTitleText": "学习记录", "navigationBarBackgroundColor": "#FFFFFF", "enablePullDownRefresh": true }, "pages/user/index": { "navigationBarTitleText": "我的", "navigationBarBackgroundColor": "#FFFFFF", "enablePullDownRefresh": true }, "pages/user/login/index": { "navigationBarTitleText": "登录", "navigationBarBackgroundColor": "#ff663d", "navigationBarTextStyle": "white" }, "pages/user/login/registercode": { "navigationBarTitleText": "注册账号", "navigationBarBackgroundColor": "#FFFFFF" }, "pages/user/login/register": { "navigationBarTitleText": "注册账号", "navigationBarBackgroundColor": "#FFFFFF" }, "pages/user/login/forgetcode": { "navigationBarTitleText": "忘记密码", "navigationBarBackgroundColor": "#FFFFFF" }, "pages/user/login/repassword": { "navigationBarTitleText": "忘记密码", "navigationBarBackgroundColor": "#FFFFFF" }, "pages/course/courselist": { "navigationBarTitleText": "课程列表", "navigationBarBackgroundColor": "#FFFFFF", "enablePullDownRefresh": true }, "pages/course/search": { "navigationBarTitleText": "搜索内容", "navigationBarBackgroundColor": "#FFFFFF", "enablePullDownRefresh": true }, "pages/user/settings/index": { "navigationBarTitleText": "设置", "navigationBarBackgroundColor": "#FFFFFF" }, "pages/user/settings/basicinfo": { "navigationBarTitleText": "个人资料", "navigationBarBackgroundColor": "#FFFFFF" }, "pages/user/course/index": { "navigationBarTitleText": "我的课程", "navigationBarBackgroundColor": "#FFFFFF", "enablePullDownRefresh": true }, "pages/user/share/index": { "navigationBarTitleText": "推广邀约" }, "pages/user/settings/about": { "navigationBarTitleText": "关于我们", "navigationBarBackgroundColor": "#FFFFFF" }, "pages/user/order/index": { "navigationBarTitleText": "我的订单", "navigationBarBackgroundColor": "#FFFFFF", "enablePullDownRefresh": true }, "pages/user/collect/index": { "navigationBarTitleText": "我的收藏", "navigationBarBackgroundColor": "#FFFFFF", "enablePullDownRefresh": true }, "pages/user/massage/index": { "navigationBarTitleText": "消息中心", "navigationBarBackgroundColor": "#FFFFFF" }, "pages/user/vip/index": { "navigationBarTitleText": "升级vip", "navigationBarBackgroundColor": "#FFFFFF" }, "pages/user/ask/index": { "navigationBarTitleText": "我的提问", "navigationBarBackgroundColor": "#FFFFFF", "enablePullDownRefresh": true }, "pages/user/coupon/index": { "navigationBarTitleText": "卡券包", "navigationBarBackgroundColor": "#FFFFFF" }, "pages/user/coupon/redpackage": { "navigationBarTitleText": "我的红包", "navigationBarBackgroundColor": "#FFFFFF" }, "pages/user/coupon/coupon": { "navigationBarTitleText": "我的优惠券", "navigationBarBackgroundColor": "#FFFFFF" }, "pages/user/proposal/index": { "navigationBarTitleText": "举报/建议", "navigationBarBackgroundColor": "#FFFFFF" }, "pages/user/login/modifypass": { "navigationBarTitleText": "修改密码", "navigationBarBackgroundColor": "#FFFFFF" }, "pages/web/web": { "navigationBarTitleText": "", "navigationBarBackgroundColor": "#FFFFFF" }, "pages/learn-record/exam": { "navigationBarTitleText": "学习考试", "navigationBarBackgroundColor": "#FFFFFF" }, "pages/payment/payment": { "navigationBarTitleText": "订单支付", "navigationBarBackgroundColor": "#FFFFFF" }, "pages/prompt/prompt": { "navigationBarTitleText": "提示", "navigationBarBackgroundColor": "#FFFFFF" }, "pages/school/index": { "navigationBarTitleText": "机构列表", "navigationBarBackgroundColor": "#FFFFFF", "enablePullDownRefresh": true }, "pages/school/details": { "navigationBarTitleText": "机构详情", "navigationBarBackgroundColor": "#FFFFFF" }, "pages/user/column/index": { "navigationBarTitleText": "我的专栏", "navigationBarBackgroundColor": "#FFFFFF", "enablePullDownRefresh": true }, "pages/user/local/player": { "navigationBarTitleText": "播放视频", "navigationBarBackgroundColor": "#FFFFFF" }, "pages/user/local/courselist": { "navigationBarTitleText": "下载管理", "navigationBarBackgroundColor": "#FFFFFF" }, "pages/user/card/index": { "navigationBarTitleText": "营销卡", "navigationBarBackgroundColor": "#FFFFFF", "enablePullDownRefresh": true }, "pages/user/card/detail": { "navigationBarTitleText": "营销卡详情", "navigationBarBackgroundColor": "#FFFFFF", "enablePullDownRefresh": true }, "pages/user/class/index": { "navigationBarTitleText": "我的班级", "navigationBarBackgroundColor": "#FFFFFF", "enablePullDownRefresh": true }, "pages/exam/index": { "navigationBarTitleText": "我的考试", "navigationBarBackgroundColor": "#FFFFFF" }, "pages/exam/select": { "navigationBarTitleText": "选择分类", "navigationBarBackgroundColor": "#FFFFFF" }, "pages/exam/practice": { "navigationBarTitleText": "练习中心", "navigationBarBackgroundColor": "#FFFFFF" }, "pages/exam/exambank": { "navigationBarTitleText": "套卷练习", "navigationBarBackgroundColor": "#FFFFFF", "enablePullDownRefresh": true }, "pages/exam/practicerecord": { "navigationBarTitleText": "练习记录", "navigationBarBackgroundColor": "#FFFFFF", "enablePullDownRefresh": true }, "pages/exam/examrecord": { "navigationBarTitleText": "考试记录", "navigationBarBackgroundColor": "#FFFFFF", "enablePullDownRefresh": true }, "pages/exam/errorbank": { "navigationBarTitleText": "错题练习", "navigationBarBackgroundColor": "#FFFFFF" }, "pages/exam/collectbank": { "navigationBarTitleText": "收藏练习", "navigationBarBackgroundColor": "#FFFFFF" }, "pages/exam/practicedaily": { "navigationBarTitleText": "每日一练", "navigationBarBackgroundColor": "#FFFFFF", "enablePullDownRefresh": true }, "pages/exam/paperinfo": { "navigationBarTitleText": "试卷介绍", "navigationBarBackgroundColor": "#FFFFFF" }, "pages/exam/testpage": { "navigationBarTitleText": "正在做题", "navigationBarBackgroundColor": "#FFFFFF" }, "pages/exam/result": { "navigationBarTitleText": "查看结果", "navigationBarBackgroundColor": "#FFFFFF" }, "pages/exam/ownscore": { "navigationBarTitleText": "自己评分", "navigationBarBackgroundColor": "#FFFFFF" }, "pages/exam/analysis": { "navigationBarTitleText": "查看试卷解析", "navigationBarBackgroundColor": "#FFFFFF" }, "pages/course/courseplay": { "navigationBarTitleText": "课程播放", "navigationBarBackgroundColor": "#FFFFFF" }, "pages/live/index": { "navigationBarTitleText": "直播列表", "navigationBarBackgroundColor": "#FFFFFF" }, "pages/live/courselist": { "navigationBarTitleText": "课程列表", "navigationBarBackgroundColor": "#FFFFFF" }, "pages/user/error/index": { "navigationBarTitleText": "试题纠错", "navigationBarBackgroundColor": "#FFFFFF", "enablePullDownRefresh": true }, "pages/user/account/index": { "navigationBarTitleText": "账户余额", "navigationBarBackgroundColor": "#ff663d", "navigationBarTextStyle": "white" }, "pages/user/account/record": { "navigationBarTitleText": "充值记录", "navigationBarBackgroundColor": "#ffffff" }, "pages/user/account/exchangepoint": { "navigationBarTitleText": "我的点券", "navigationBarBackgroundColor": "#ffffff" }, "pages/user/account/logscore": { "navigationBarTitleText": "积分明细", "navigationBarBackgroundColor": "#ffffff" }, "pages/user/distribution/index": { "navigationBarTitleText": "微店管理", "navigationBarBackgroundColor": "#ffffff", "enablePullDownRefresh": true }, "pages/user/distribution/apply": { "navigationBarTitleText": "申请分销", "navigationBarBackgroundColor": "#ffffff" }, "pages/user/distribution/vip": { "navigationBarTitleText": "小店会员", "navigationBarBackgroundColor": "#ffffff" }, "pages/user/distribution/secondary": { "navigationBarTitleText": "子分销商", "navigationBarBackgroundColor": "#ffffff" }, "pages/user/distribution/order": { "navigationBarTitleText": "小店销售订单", "navigationBarBackgroundColor": "#ffffff" }, "pages/user/distribution/orderdetail": { "navigationBarTitleText": "订单明细", "navigationBarBackgroundColor": "#ffffff" }, "pages/user/distribution/setaccount": { "navigationBarTitleText": "设置提现账号", "navigationBarBackgroundColor": "#ffffff" }, "pages/user/distribution/cash": { "navigationBarTitleText": "佣金提现", "navigationBarBackgroundColor": "#ffffff" }, "pages/user/distribution/applycash": { "navigationBarTitleText": "申请提现", "navigationBarBackgroundColor": "#ffffff" }, "pages/user/distribution/record": { "navigationBarTitleText": "提现记录", "navigationBarBackgroundColor": "#ffffff" }, "pages/user/distribution/info": { "navigationBarTitleText": "店铺资料", "navigationBarBackgroundColor": "#ffffff" }, "pages/user/distribution/rank": { "navigationBarTitleText": "分销商排名", "navigationBarBackgroundColor": "#ffffff", "enablePullDownRefresh": true }, "pages/user/distribution/qrcode": { "navigationBarTitleText": "店铺二维码", "navigationBarBackgroundColor": "#ffffff" } }, "globalStyle": { "navigationBarTextStyle": "black", "navigationBarTitleText": "uni-app", "navigationBarBackgroundColor": "#F0F4F7", "backgroundColor": "#F0F4F7" } };exports.default = _default;

/***/ }),

/***/ 75:
/*!************************************************************!*\
  !*** J:/kesionEDU_APP/KS_EDU_APP/客户小程序/首冠小程序定制/api/app.js ***!
  \************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
Object.defineProperty(exports, "__esModule", { value: true });exports.CheckOrder = CheckOrder;
var _mainEntrance = __webpack_require__(/*! ./main.entrance.js */ 18);

/*订单状态查询*/
function CheckOrder(params) {
  return (0, _mainEntrance.POST)('/webapi/app/CheckOrder', params, ['appToken', 'userId']);
}

/***/ }),

/***/ 8:
/*!****************************************************************************!*\
  !*** J:/kesionEDU_APP/KS_EDU_APP/客户小程序/首冠小程序定制/pages.json?{"type":"stat"} ***!
  \****************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
Object.defineProperty(exports, "__esModule", { value: true });exports.default = void 0;var _default = { "appid": "__UNI__3913D90" };exports.default = _default;

/***/ }),

/***/ 921:
/*!********************************************************************************************!*\
  !*** J:/kesionEDU_APP/KS_EDU_APP/客户小程序/首冠小程序定制/components/uni/uni-swipe-action/mpother.js ***!
  \********************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
/* WEBPACK VAR INJECTION */(function(uni) {Object.defineProperty(exports, "__esModule", { value: true });exports.default = void 0;var _default = {
  data: function data() {
    return {
      uniShow: false,
      left: 0 };

  },
  computed: {
    moveLeft: function moveLeft() {
      return "translateX(".concat(this.left, "px)");
    } },

  watch: {
    show: function show(newVal) {
      if (this.autoClose) return;
      if (newVal) {
        this.$emit('change', true);
        this.open();
      } else {
        this.$emit('change', false);
        this.close();
      }
      uni.$emit('__uni__swipe__event', this);
    } },

  onReady: function onReady() {
    this.init();
    this.getSelectorQuery();
  },
  beforeDestoy: function beforeDestoy() {
    uni.$off('__uni__swipe__event');
  },
  methods: {
    init: function init() {var _this = this;
      uni.$on('__uni__swipe__event', function (res) {
        if (res !== _this && _this.autoClose) {
          if (_this.left !== 0) {
            _this.close();
          }
        }
      });
    },
    onClick: function onClick(index, item) {
      this.$emit('click', {
        content: item,
        index: index });

    },
    touchstart: function touchstart(e) {var

      pageX =
      e.touches[0].pageX;
      if (this.disabled) return;
      var left = this.position[0].left;
      uni.$emit('__uni__swipe__event', this);
      this.width = pageX - left;
      if (this.isopen) return;
      if (this.uniShow) {
        this.uniShow = false;
        this.isopen = true;
        this.openleft = this.left + this.position[1].width;
      }
    },
    touchmove: function touchmove(e, index) {
      if (this.disabled) return;var

      pageX =
      e.touches[0].pageX;
      this.setPosition(pageX);
    },
    touchend: function touchend() {
      if (this.disabled) return;
      if (this.isopen) {
        this.move(this.openleft, 0);
        return;
      }
      this.move(this.left, -40);
    },
    setPosition: function setPosition(x, y) {
      if (!this.position[1].width) {
        return;
      }
      // const width = this.position[0].width
      this.left = x - this.width;
      this.setValue(x - this.width);
    },
    setValue: function setValue(value) {
      // 设置最大最小值
      this.left = Math.max(-this.position[1].width, Math.min(parseInt(value), 0));
      this.position[0].left = this.left;
      if (this.isopen) {
        this.openleft = this.left + this.position[1].width;
      }
    },
    move: function move(left, value) {
      if (left >= value) {
        this.$emit('change', false);
        this.close();
      } else {
        this.$emit('change', true);
        this.open();
      }
    },
    open: function open() {
      this.uniShow = true;
      this.left = -this.position[1].width;
      this.setValue(-this.position[1].width);
    },
    close: function close() {var _this2 = this;
      this.uniShow = true;
      this.setValue(0);
      setTimeout(function () {
        _this2.uniShow = false;
        _this2.isopen = false;
      }, 200);
    },
    getSelectorQuery: function getSelectorQuery() {var _this3 = this;
      var views = uni.createSelectorQuery().
      in(this);
      views.
      selectAll('.selector-query-hock').
      boundingClientRect(function (data) {
        _this3.position = data;
        if (_this3.autoClose) return;
        if (_this3.show) {
          _this3.open();
        } else {
          _this3.close();
        }
      }).
      exec();
    } } };exports.default = _default;
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! ./node_modules/@dcloudio/uni-mp-weixin/dist/index.js */ 1)["default"]))

/***/ }),

/***/ 922:
/*!***************************************************************************************!*\
  !*** J:/kesionEDU_APP/KS_EDU_APP/客户小程序/首冠小程序定制/components/uni/uni-swipe-action/mp.js ***!
  \***************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
/* WEBPACK VAR INJECTION */(function(uni) {Object.defineProperty(exports, "__esModule", { value: true });exports.default = void 0;var _default = {
  data: function data() {
    return {
      position: [],
      button: [] };

  },
  computed: {
    pos: function pos() {
      return JSON.stringify(this.position);
    },
    btn: function btn() {
      return JSON.stringify(this.button);
    } },

  watch: {
    show: function show(newVal) {
      if (this.autoClose) return;
      var valueObj = this.position[0];
      if (!valueObj) return;
      valueObj.show = newVal;
      this.$set(this.position, 0, valueObj);
    } },









  onReady: function onReady() {
    this.init();
    this.getSize();
    this.getButtonSize();
  },

  methods: {
    init: function init() {var _this = this;
      uni.$on('__uni__swipe__event', function (res) {
        if (res !== _this && _this.autoClose) {
          var valueObj = _this.position[0];
          valueObj.show = false;
          _this.$set(_this.position, 0, valueObj);
        }
      });
    },
    openSwipe: function openSwipe() {
      uni.$emit('__uni__swipe__event', this);
    },
    change: function change(e) {
      this.$emit('change', e.open);
      var valueObj = this.position[0];
      valueObj.show = e.open;
      this.$set(this.position, 0, valueObj);
      // console.log('改变', e);
    },
    onClick: function onClick(index, item) {
      this.$emit('click', {
        content: item,
        index: index });

    },
    getSize: function getSize() {var _this2 = this;
      var views = uni.createSelectorQuery().in(this);
      views.
      selectAll('.selector-query-hock').
      boundingClientRect(function (data) {
        if (_this2.autoClose) {
          data[0].show = false;
        } else {
          data[0].show = _this2.show;
        }
        _this2.position = data;
      }).
      exec();
    },
    getButtonSize: function getButtonSize() {var _this3 = this;
      var views = uni.createSelectorQuery().in(this);
      views.
      selectAll('.button-hock').
      boundingClientRect(function (data) {
        _this3.button = data;
      }).
      exec();
    } } };exports.default = _default;
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! ./node_modules/@dcloudio/uni-mp-weixin/dist/index.js */ 1)["default"]))

/***/ }),

/***/ 967:
/*!**************************************************************************************************!*\
  !*** J:/kesionEDU_APP/KS_EDU_APP/客户小程序/首冠小程序定制/components/ks-components/ucharts/u-charts.min.js ***!
  \**************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
/* WEBPACK VAR INJECTION */(function(uni) {var config = { yAxisWidth: 15, yAxisSplit: 5, xAxisHeight: 15, xAxisLineHeight: 15, legendHeight: 15, yAxisTitleWidth: 15, padding: [10, 10, 10, 10], pixelRatio: 1, rotate: !1, columePadding: 3, fontSize: 13, dataPointShape: ["circle", "circle", "circle", "circle"], colors: ["#1890ff", "#2fc25b", "#facc14", "#f04864", "#8543e0", "#90ed7d"], pieChartLinePadding: 15, pieChartTextPadding: 5, xAxisTextPadding: 3, titleColor: "#333333", titleFontSize: 20, subtitleColor: "#999999", subtitleFontSize: 15, toolTipPadding: 3, toolTipBackground: "#000000", toolTipOpacity: .7, toolTipLineHeight: 20, radarLabelTextMargin: 15, gaugeLabelTextMargin: 15 };var assign = function assign(e) {for (var _len = arguments.length, t = new Array(_len > 1 ? _len - 1 : 0), _key = 1; _key < _len; _key++) {t[_key - 1] = arguments[_key];}function i(e, t) {for (var a in t) {e[a] = e[a] && "[object Object]" === e[a].toString() ? i(e[a], t[a]) : e[a] = t[a];}return e;}if (null == e) throw new TypeError("Cannot convert undefined or null to object");return !t || 0 >= t.length ? e : (t.forEach(function (t) {e = i(e, t);}), e);};var util = { toFixed: function toFixed(e, t) {return t = t || 2, this.isFloat(e) && (e = e.toFixed(t)), e;}, isFloat: function isFloat(e) {return 0 != e % 1;}, approximatelyEqual: function approximatelyEqual(e, t) {return 1e-10 > Math.abs(e - t);}, isSameSign: function isSameSign(e, t) {var i = Math.abs;return i(e) === e && i(t) === t || i(e) !== e && i(t) !== t;}, isSameXCoordinateArea: function isSameXCoordinateArea(e, t) {return this.isSameSign(e.x, t.x);}, isCollision: function isCollision(e, t) {e.end = {}, e.end.x = e.start.x + e.width, e.end.y = e.start.y - e.height, t.end = {}, t.end.x = t.start.x + t.width, t.end.y = t.start.y - t.height;var i = t.start.x > e.end.x || t.end.x < e.start.x || t.end.y > e.start.y || t.start.y < e.end.y;return !i;} };function getH5Offset(t) {return t.mp = { changedTouches: [] }, t.mp.changedTouches.push({ x: t.offsetX, y: t.offsetY }), t;}function hexToRgb(e, t) {var i = /^#?([a-f\d])([a-f\d])([a-f\d])$/i,a = e.replace(i, function (e, t, i, a) {return t + t + i + i + a + a;}),o = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(a),n = parseInt(o[1], 16),l = parseInt(o[2], 16),r = parseInt(o[3], 16);return "rgba(" + n + "," + l + "," + r + "," + t + ")";}function findRange(e, t, i) {if (isNaN(e)) throw new Error("[uCharts] unvalid series data!");i = i || 10, t = t ? t : "upper";for (var a = 1; 1 > i;) {i *= 10, a *= 10;}for (e = "upper" === t ? Math.ceil(e * a) : Math.floor(e * a); 0 != e % i;) {"upper" === t ? e++ : e--;}return e / a;}function calCandleMA(e, t, i, a) {var o = [];for (var n, l = 0; l < e.length; l++) {n = { data: [], name: t[l], color: i[l] };for (var _t = 0, _i = a.length; _t < _i; _t++) {if (_t < e[l]) {n.data.push(null);continue;}var _i2 = 0;for (var _o = 0; _o < e[l]; _o++) {_i2 += a[_t - _o][1];}n.data.push(+(_i2 / e[l]).toFixed(3));}o.push(n);}return o;}function calValidDistance(e, t, i, a, o) {var n = o.width - o.area[1] - o.area[3],l = i.eachSpacing * (o.chartData.xAxisData.xAxisPoints.length - 1),r = t;return 0 <= t ? (r = 0, e.event.trigger("scrollLeft")) : Math.abs(t) >= l - n && (r = n - l, e.event.trigger("scrollRight")), r;}function isInAngleRange(e, t, i) {function a(e) {for (; 0 > e;) {e += 2 * o;}for (; e > 2 * o;) {e -= 2 * o;}return e;}var o = Math.PI;return e = a(e), t = a(t), i = a(i), t > i && (i += 2 * o, e < t && (e += 2 * o)), e >= t && e <= i;}function calRotateTranslate(e, t, i) {var a = e,o = i - t,n = a + (i - o - a) / 1.4142135623730951;n *= -1;return { transX: n, transY: (i - o) * (1.4142135623730951 - 1) - (i - o - a) / 1.4142135623730951 };}function createCurveControlPoints(e, t) {function i(e, t) {return !!(e[t - 1] && e[t + 1]) && (e[t].y >= n(e[t - 1].y, e[t + 1].y) || e[t].y <= o(e[t - 1].y, e[t + 1].y));}var o = Math.min,n = Math.max,l = .2,a = .2,r = null,s = null,d = null,h = null;if (1 > t ? (r = e[0].x + (e[1].x - e[0].x) * l, s = e[0].y + (e[1].y - e[0].y) * l) : (r = e[t].x + (e[t + 1].x - e[t - 1].x) * l, s = e[t].y + (e[t + 1].y - e[t - 1].y) * l), t > e.length - 3) {var x = e.length - 1;d = e[x].x - (e[x].x - e[x - 1].x) * a, h = e[x].y - (e[x].y - e[x - 1].y) * a;} else d = e[t + 1].x - (e[t + 2].x - e[t].x) * a, h = e[t + 1].y - (e[t + 2].y - e[t].y) * a;return i(e, t + 1) && (h = e[t + 1].y), i(e, t) && (s = e[t].y), (s >= n(e[t].y, e[t + 1].y) || s <= o(e[t].y, e[t + 1].y)) && (s = e[t].y), (h >= n(e[t].y, e[t + 1].y) || h <= o(e[t].y, e[t + 1].y)) && (h = e[t + 1].y), { ctrA: { x: r, y: s }, ctrB: { x: d, y: h } };}function convertCoordinateOrigin(e, t, i) {return { x: i.x + e, y: i.y - t };}function avoidCollision(e, t) {if (t) for (; util.isCollision(e, t);) {0 < e.start.x ? e.start.y-- : 0 > e.start.x ? e.start.y++ : 0 < e.start.y ? e.start.y++ : e.start.y--;}return e;}function fillSeries(e, t, i) {var a = 0;return e.map(function (e) {if (e.color || (e.color = i.colors[a], a = (a + 1) % i.colors.length), e.index || (e.index = 0), e.type || (e.type = t.type), "undefined" == typeof e.show && (e.show = !0), e.type || (e.type = t.type), e.pointShape || (e.pointShape = "circle"), !e.legendShape) switch (e.type) {case "line":e.legendShape = "line";break;case "column":e.legendShape = "rect";break;case "area":e.legendShape = "triangle";break;default:e.legendShape = "circle";}return e;});}function getDataRange(e, t) {var i = 0,a = t - e;return i = 1e4 <= a ? 1e3 : 1e3 <= a ? 100 : 100 <= a ? 10 : 10 <= a ? 5 : 1 <= a ? 1 : .1 <= a ? .1 : .01 <= a ? .01 : .001 <= a ? .001 : 1e-4 <= a ? 1e-4 : 1e-5 <= a ? 1e-5 : 1e-6, { minRange: findRange(e, "lower", i), maxRange: findRange(t, "upper", i) };}function measureText(e) {var t = 1 < arguments.length && arguments[1] !== void 0 ? arguments[1] : config.fontSize;e = e + "";var e = e.split(""),a = 0;for (var _t2, o = 0; o < e.length; o++) {_t2 = e[o], a += /[a-zA-Z]/.test(_t2) ? 7 : /[0-9]/.test(_t2) ? 5.5 : /\./.test(_t2) ? 2.7 : /-/.test(_t2) ? 3.25 : /[\u4e00-\u9fa5]/.test(_t2) ? 10 : /\(|\)/.test(_t2) ? 3.73 : /\s/.test(_t2) ? 2.5 : /%/.test(_t2) ? 8 : 10;}return a * t / 10;}function dataCombine(e) {return e.reduce(function (e, t) {return (e.data ? e.data : e).concat(t.data);}, []);}function dataCombineStack(e, t) {for (var o = Array(t), a = 0; a < o.length; a++) {o[a] = 0;}for (var n = 0; n < e.length; n++) {for (var a = 0; a < o.length; a++) {o[a] += e[n].data[a];}}return e.reduce(function (e, t) {return (e.data ? e.data : e).concat(t.data).concat(o);}, []);}function getTouches(t, i, a) {var e, o;return t.clientX ? i.rotate ? (o = i.height - t.clientX * i.pixelRatio, e = (t.pageY - a.currentTarget.offsetTop - i.height / i.pixelRatio / 2 * (i.pixelRatio - 1)) * i.pixelRatio) : (e = t.clientX * i.pixelRatio, o = (t.pageY - a.currentTarget.offsetTop - i.height / i.pixelRatio / 2 * (i.pixelRatio - 1)) * i.pixelRatio) : i.rotate ? (o = i.height - t.x * i.pixelRatio, e = t.y * i.pixelRatio) : (e = t.x * i.pixelRatio, o = t.y * i.pixelRatio), { x: e, y: o };}function getSeriesDataItem(e, t) {var i = [];for (var a, o = 0; o < e.length; o++) {if (a = e[o], null !== a.data[t] && "undefined" != typeof a.data[t] && a.show) {var _e = {};_e.color = a.color, _e.type = a.type, _e.style = a.style, _e.pointShape = a.pointShape, _e.disableLegend = a.disableLegend, _e.name = a.name, _e.show = a.show, _e.data = a.format ? a.format(a.data[t]) : a.data[t], i.push(_e);}}return i;}function getMaxTextListLength(e) {var t = e.map(function (e) {return measureText(e);});return Math.max.apply(null, t);}function getRadarCoordinateSeries(e) {for (var t = Math.PI, a = [], o = 0; o < e; o++) {a.push(2 * t / e * o);}return a.map(function (e) {return -1 * e + t / 2;});}function getToolTipData(e, t, a, i) {var o = 4 < arguments.length && void 0 !== arguments[4] ? arguments[4] : {},n = e.map(function (e) {var t = [];return t = i ? i : e.data, { text: o.format ? o.format(e, t[a]) : e.name + ": " + e.data, color: e.color };}),l = [],r = { x: 0, y: 0 };for (var _o2, _n = 0; _n < t.length; _n++) {_o2 = t[_n], "undefined" != typeof _o2[a] && null !== _o2[a] && l.push(_o2[a]);}for (var _o3, _n2 = 0; _n2 < l.length; _n2++) {_o3 = l[_n2], r.x = Math.round(_o3.x), r.y += _o3.y;}return r.y /= l.length, { textList: n, offset: r };}function getMixToolTipData(e, t, a, i) {var o = 4 < arguments.length && void 0 !== arguments[4] ? arguments[4] : {},n = e.map(function (e) {return { text: o.format ? o.format(e, i[a]) : e.name + ": " + e.data, color: e.color, disableLegend: !!e.disableLegend };});n = n.filter(function (e) {if (!0 !== e.disableLegend) return e;});var l = [],r = { x: 0, y: 0 };for (var _o4, _n3 = 0; _n3 < t.length; _n3++) {_o4 = t[_n3], "undefined" != typeof _o4[a] && null !== _o4[a] && l.push(_o4[a]);}for (var _o5, _n4 = 0; _n4 < l.length; _n4++) {_o5 = l[_n4], r.x = Math.round(_o5.x), r.y += _o5.y;}return r.y /= l.length, { textList: n, offset: r };}function getCandleToolTipData(e, t, a, o, i, n) {6 < arguments.length && void 0 !== arguments[6] ? arguments[6] : {};var l = n.color.upFill,r = n.color.downFill,s = [l, l, r, l];var d = [];var h = { text: i[o], color: null };d.push(h), t.map(function (t) {0 == o && 0 > t.data[1] - t.data[0] ? s[1] = r : (t.data[0] < e[o - 1][1] && (s[0] = r), t.data[1] < t.data[0] && (s[1] = r), t.data[2] > e[o - 1][1] && (s[2] = l), t.data[3] < e[o - 1][1] && (s[3] = r));var i = { text: "\u5F00\u76D8\uFF1A" + t.data[0], color: s[0] },a = { text: "\u6536\u76D8\uFF1A" + t.data[1], color: s[1] },n = { text: "\u6700\u4F4E\uFF1A" + t.data[2], color: s[2] },h = { text: "\u6700\u9AD8\uFF1A" + t.data[3], color: s[3] };d.push(i, a, n, h);});var x = [],c = { x: 0, y: 0 };for (var _l, _r = 0; _r < a.length; _r++) {_l = a[_r], "undefined" != typeof _l[o] && null !== _l[o] && x.push(_l[o]);}return c.x = Math.round(x[0][0].x), { textList: d, offset: c };}function filterSeries(e) {var t = [];for (var a = 0; a < e.length; a++) {!0 == e[a].show && t.push(e[a]);}return t;}function findCurrentIndex(e, t, i, a) {var o = 4 < arguments.length && void 0 !== arguments[4] ? arguments[4] : 0,n = -1,l = 0;var r = [];for (var _o6 = 0; _o6 < t[0].length; _o6++) {r.push(t[0][_o6].x);}return ("line" == i.type || "area" == i.type) && "justify" == i.xAxis.boundaryGap && (l = i.chartData.eachSpacing / 2), i.categories || (l = 0), isInExactChartArea(e, i, a) && r.forEach(function (t, i) {e.x + o + l > t && (n = i);}), n;}function findLegendIndex(e, t) {var i = -1;if (isInExactLegendArea(e, t.area)) {var a = t.points,o = -1;for (var _t3, n = 0, l = a.length; n < l; n++) {_t3 = a[n];for (var _a = 0; _a < _t3.length; _a++) {o += 1;var _n5 = _t3[_a].area;if (e.x > _n5[0] && e.x < _n5[2] && e.y > _n5[1] && e.y < _n5[3]) {i = o;break;}}}return i;}return i;}function isInExactLegendArea(e, t) {return e.x > t.start.x && e.x < t.end.x && e.y > t.start.y && e.y < t.end.y;}function isInExactChartArea(e, t) {return e.x <= t.width - t.area[1] + 10 && e.x >= t.area[3] - 10 && e.y >= t.area[0] && e.y <= t.height - t.area[2];}function findRadarChartCurrentIndex(e, t, i) {var a = Math.PI,o = 2 * a / i,n = -1;if (isInExactPieChartArea(e, t.center, t.radius)) {var l = function l(e) {return 0 > e && (e += 2 * a), e > 2 * a && (e -= 2 * a), e;},r = Math.atan2(t.center.y - e.y, e.x - t.center.x);r = -1 * r, 0 > r && (r += 2 * a);var s = t.angleList.map(function (e) {return e = l(-1 * e), e;});s.forEach(function (e, t) {var i = l(e - o / 2),s = l(e + o / 2);s < i && (s += 2 * a), (r >= i && r <= s || r + 2 * a >= i && r + 2 * a <= s) && (n = t);});}return n;}function findFunnelChartCurrentIndex(e, t) {for (var a, o = -1, n = 0, l = t.series.length; n < l; n++) {if (a = t.series[n], e.x > a.funnelArea[0] && e.x < a.funnelArea[2] && e.y > a.funnelArea[1] && e.y < a.funnelArea[3]) {o = n;break;}}return o;}function findWordChartCurrentIndex(e, t) {for (var a, o = -1, n = 0, l = t.length; n < l; n++) {if (a = t[n], e.x > a.area[0] && e.x < a.area[2] && e.y > a.area[1] && e.y < a.area[3]) {o = n;break;}}return o;}function findMapChartCurrentIndex(e, t) {for (var a, o = -1, n = t.chartData.mapData, l = t.series, r = pointToCoordinate(e.y, e.x, n.bounds, n.scale, n.xoffset, n.yoffset), s = [r.x, r.y], d = 0, h = l.length; d < h; d++) {if (a = l[d].geometry.coordinates, isPoiWithinPoly(s, a)) {o = d;break;}}return o;}function findPieChartCurrentIndex(e, t) {var a = -1;if (isInExactPieChartArea(e, t.center, t.radius)) {var o = Math.atan2(t.center.y - e.y, e.x - t.center.x);o = -o;for (var n, l = 0, r = t.series.length; l < r; l++) {if (n = t.series[l], isInAngleRange(o, n._start_, n._start_ + 2 * n._proportion_ * Math.PI)) {a = l;break;}}}return a;}function isInExactPieChartArea(e, t, i) {var a = Math.pow;return a(e.x - t.x, 2) + a(e.y - t.y, 2) <= a(i, 2);}function splitPoints(e) {var t = [],i = [];return e.forEach(function (e) {null === e ? (i.length && t.push(i), i = []) : i.push(e);}), i.length && t.push(i), t;}function calLegendData(e, t, i, a) {var o = Math.max,n = Math.floor;var l = { area: { start: { x: 0, y: 0 }, end: { x: 0, y: 0 }, width: 0, height: 0, wholeWidth: 0, wholeHeight: 0 }, points: [], widthArr: [], heightArr: [] };if (!1 === t.legend.show) return a.legendData = l, l;var r = t.legend.padding,s = t.legend.margin,d = t.legend.fontSize,h = 15 * t.pixelRatio,x = 5 * t.pixelRatio,c = o(t.legend.lineHeight * t.pixelRatio, d);if ("top" == t.legend.position || "bottom" == t.legend.position) {var _a2 = [],_n6 = 0,p = [],g = [];for (var _o7 = 0; _o7 < e.length; _o7++) {var _i3 = e[_o7],_l2 = h + x + measureText(_i3.name || "undefined", d) + t.legend.itemGap;_n6 + _l2 > t.width - t.padding[1] - t.padding[3] ? (_a2.push(g), p.push(_n6 - t.legend.itemGap), _n6 = _l2, g = [_i3]) : (_n6 += _l2, g.push(_i3));}if (g.length) {_a2.push(g), p.push(_n6 - t.legend.itemGap), l.widthArr = p;var _e2 = o.apply(null, p);switch (t.legend.float) {case "left":l.area.start.x = t.padding[3], l.area.end.x = t.padding[3] + 2 * r;break;case "right":l.area.start.x = t.width - t.padding[1] - _e2 - 2 * r, l.area.end.x = t.width - t.padding[1];break;default:l.area.start.x = (t.width - _e2) / 2 - r, l.area.end.x = (t.width + _e2) / 2 + r;}l.area.width = _e2 + 2 * r, l.area.wholeWidth = _e2 + 2 * r, l.area.height = _a2.length * c + 2 * r, l.area.wholeHeight = _a2.length * c + 2 * r + 2 * s, l.points = _a2;}} else {var _i4 = e.length,_a3 = t.height - t.padding[0] - t.padding[2] - 2 * s - 2 * r,_o8 = Math.min(n(_a3 / c), _i4);switch (l.area.height = _o8 * c + 2 * r, l.area.wholeHeight = _o8 * c + 2 * r, t.legend.float) {case "top":l.area.start.y = t.padding[0] + s, l.area.end.y = t.padding[0] + s + l.area.height;break;case "bottom":l.area.start.y = t.height - t.padding[2] - s - l.area.height, l.area.end.y = t.height - t.padding[2] - s;break;default:l.area.start.y = (t.height - l.area.height) / 2, l.area.end.y = (t.height + l.area.height) / 2;}var _p = 0 == _i4 % _o8 ? _i4 / _o8 : n(_i4 / _o8 + 1),_g = [];for (var _t4, _a4 = 0; _a4 < _p; _a4++) {_t4 = e.slice(_a4 * _o8, _a4 * _o8 + _o8), _g.push(_t4);}if (l.points = _g, _g.length) {for (var _e4 = 0; _e4 < _g.length; _e4++) {var _i5 = _g[_e4],_a5 = 0;for (var _e5, _o9 = 0; _o9 < _i5.length; _o9++) {_e5 = h + x + measureText(_i5[_o9].name || "undefined", d) + t.legend.itemGap, _e5 > _a5 && (_a5 = _e5);}l.widthArr.push(_a5), l.heightArr.push(_i5.length * c + 2 * r);}var _e3 = 0;for (var _t5 = 0; _t5 < l.widthArr.length; _t5++) {_e3 += l.widthArr[_t5];}l.area.width = _e3 - t.legend.itemGap + 2 * r, l.area.wholeWidth = l.area.width + r;}}switch (t.legend.position) {case "top":l.area.start.y = t.padding[0] + s, l.area.end.y = t.padding[0] + s + l.area.height;break;case "bottom":l.area.start.y = t.height - t.padding[2] - l.area.height - s, l.area.end.y = t.height - t.padding[2] - s;break;case "left":l.area.start.x = t.padding[3], l.area.end.x = t.padding[3] + l.area.width;break;case "right":l.area.start.x = t.width - t.padding[1] - l.area.width, l.area.end.x = t.width - t.padding[1];}return a.legendData = l, l;}function calCategoriesData(e, t, i, a) {var o = { angle: 0, xAxisHeight: i.xAxisHeight },n = e.map(function (e) {return measureText(e, t.xAxis.fontSize || i.fontSize);}),l = Math.max.apply(this, n);return !0 == t.xAxis.rotateLabel && l + 2 * i.xAxisTextPadding > a && (o.angle = 45 * Math.PI / 180, o.xAxisHeight = 2 * i.xAxisTextPadding + l * Math.sin(o.angle)), o;}function getXAxisTextList(e, t) {var a = Math.min,o = Math.max,n = 4 < arguments.length && void 0 !== arguments[4] ? arguments[4] : -1,l = dataCombine(e),r = [];l = l.filter(function (e) {return "object" == typeof e && null !== e ? e.constructor == Array ? null !== e : null !== e.value : null !== e;}), l.map(function (e) {"object" == typeof e ? e.constructor == Array ? "candle" == t.type ? e.map(function (e) {r.push(e);}) : r.push(e[0]) : r.push(e.value) : r.push(e);});var s = 0,d = 0;if (0 < r.length && (s = a.apply(this, r), d = o.apply(this, r)), -1 < n ? ("number" == typeof t.xAxis.data[n].min && (s = a(t.xAxis.data[n].min, s)), "number" == typeof t.xAxis.data[n].max && (d = o(t.xAxis.data[n].max, d))) : ("number" == typeof t.xAxis.min && (s = a(t.xAxis.min, s)), "number" == typeof t.xAxis.max && (d = o(t.xAxis.max, d))), s === d) {var h = d || 10;d += h;}for (var x = getDataRange(s, d), c = x.minRange, p = x.maxRange, g = [], y = (p - c) / t.xAxis.splitNumber, f = 0; f <= t.xAxis.splitNumber; f++) {g.push(c + y * f);}return g;}function calXAxisData(e, t, i) {var a = { angle: 0, xAxisHeight: i.xAxisHeight };a.ranges = getXAxisTextList(e, t, i), a.rangesFormat = a.ranges.map(function (e) {return e = t.xAxis.format ? t.xAxis.format(e) : util.toFixed(e, 2), e;});var o = a.ranges.map(function (e) {return e = util.toFixed(e, 2), e = t.xAxis.format ? t.xAxis.format(+e) : e, e;});a = Object.assign(a, getXAxisPoints(o, t, i));var n = a.eachSpacing,l = o.map(function (e) {return measureText(e);}),r = Math.max.apply(this, l);return r + 2 * i.xAxisTextPadding > n && (a.angle = 45 * Math.PI / 180, a.xAxisHeight = 2 * i.xAxisTextPadding + r * Math.sin(a.angle)), !0 === t.xAxis.disabled && (a.xAxisHeight = 0), a;}function getRadarDataPoints(e, t, i, a, o) {var n = Math.max,l = 5 < arguments.length && void 0 !== arguments[5] ? arguments[5] : 1,r = o.extra.radar || {};r.max = r.max || 0;var s = n(r.max, n.apply(null, dataCombine(a))),d = [];var _loop = function _loop(_n7) {var o = a[_n7],r = {};r.color = o.color, r.legendShape = o.legendShape, r.pointShape = o.pointShape, r.data = [], o.data.forEach(function (a, o) {var n = {};n.angle = e[o], n.proportion = a / s, n.position = convertCoordinateOrigin(i * n.proportion * l * Math.cos(n.angle), i * n.proportion * l * Math.sin(n.angle), t), r.data.push(n);}), d.push(r);};for (var _n7 = 0; _n7 < a.length; _n7++) {_loop(_n7);}return d;}function getPieDataPoints(e, t) {var a = 2 < arguments.length && arguments[2] !== void 0 ? arguments[2] : 1,o = 0,n = 0;for (var _a6, _n8 = 0; _n8 < e.length; _n8++) {_a6 = e[_n8], _a6.data = null === _a6.data ? 0 : _a6.data, o += _a6.data;}for (var _n9, l = 0; l < e.length; l++) {_n9 = e[l], _n9.data = null === _n9.data ? 0 : _n9.data, _n9._proportion_ = 0 === o ? 1 / e.length * a : _n9.data / o * a, _n9._radius_ = t;}for (var _a7, _o10 = 0; _o10 < e.length; _o10++) {_a7 = e[_o10], _a7._start_ = n, n += 2 * _a7._proportion_ * Math.PI;}return e;}function getFunnelDataPoints(e, t) {var a = 2 < arguments.length && arguments[2] !== void 0 ? arguments[2] : 1;e = e.sort(function (e, t) {return parseInt(t.data) - parseInt(e.data);});for (var o = 0; o < e.length; o++) {e[o].radius = e[o].data / e[0].data * t * a, e[o]._proportion_ = e[o].data / e[0].data;}return e.reverse();}function getRoseDataPoints(e, t, a, o) {var n = 4 < arguments.length && arguments[4] !== void 0 ? arguments[4] : 1,l = 0,r = 0,s = [];for (var _n10, _r2 = 0; _r2 < e.length; _r2++) {_n10 = e[_r2], _n10.data = null === _n10.data ? 0 : _n10.data, l += _n10.data, s.push(_n10.data);}var d = Math.min.apply(null, s),h = Math.max.apply(null, s);for (var _r3, _s = 0; _s < e.length; _s++) {_r3 = e[_s], _r3.data = null === _r3.data ? 0 : _r3.data, 0 === l || "area" == t ? (_r3._proportion_ = _r3.data / l * n, _r3._rose_proportion_ = 1 / e.length * n) : (_r3._proportion_ = _r3.data / l * n, _r3._rose_proportion_ = _r3.data / l * n), _r3._radius_ = a + (o - a) * ((_r3.data - d) / (h - d));}for (var _n11, _l3 = 0; _l3 < e.length; _l3++) {_n11 = e[_l3], _n11._start_ = r, r += 2 * _n11._rose_proportion_ * Math.PI;}return e;}function getArcbarDataPoints(e, t) {var a = 2 < arguments.length && arguments[2] !== void 0 ? arguments[2] : 1;1 == a && (a = .999999);for (var o, n = 0; n < e.length; n++) {o = e[n], o.data = null === o.data ? 0 : o.data;var i = void 0;i = "circle" == t.type ? 2 : t.endAngle < t.startAngle ? 2 + t.endAngle - t.startAngle : t.startAngle - t.endAngle, o._proportion_ = i * o.data * a + t.startAngle, 2 <= o._proportion_ && (o._proportion_ %= 2);}return e;}function getGaugeAxisPoints(e, t, a) {var o = t;for (var n = 0; n < e.length; n++) {e[n].value = null === e[n].value ? 0 : e[n].value, e[n]._startAngle_ = o, e[n]._endAngle_ = (t - a + 1) * e[n].value + t, 2 <= e[n]._endAngle_ && (e[n]._endAngle_ %= 2), o = e[n]._endAngle_;}return e;}function getGaugeDataPoints(e, t, a) {var o = 3 < arguments.length && arguments[3] !== void 0 ? arguments[3] : 1;for (var n, l = 0; l < e.length; l++) {if (n = e[l], n.data = null === n.data ? 0 : n.data, "auto" == a.pointer.color) {for (var _e6 = 0; _e6 < t.length; _e6++) {if (n.data <= t[_e6].value) {n.color = t[_e6].color;break;}}} else n.color = a.pointer.color;var i = a.startAngle - a.endAngle + 1;n._endAngle_ = i * n.data + a.startAngle, n._oldAngle_ = a.oldAngle, a.oldAngle < a.endAngle && (n._oldAngle_ += 2), n._proportion_ = n.data >= a.oldData ? (n._endAngle_ - n._oldAngle_) * o + a.oldAngle : n._oldAngle_ - (n._oldAngle_ - n._endAngle_) * o, 2 <= n._proportion_ && (n._proportion_ %= 2);}return e;}function getPieTextMaxLength(e) {e = getPieDataPoints(e);var t = 0;for (var a = 0; a < e.length; a++) {var i = e[a],o = i.format ? i.format(+i._proportion_.toFixed(2)) : util.toFixed(100 * i._proportion_) + "%";t = Math.max(t, measureText(o));}return t;}function fixColumeData(e, t, i, a, o, n) {return e.map(function (e) {return null === e ? null : (e.width = Math.ceil((t - 2 * o.columePadding) / i), n.extra.column && n.extra.column.width && 0 < +n.extra.column.width && (e.width = Math.min(e.width, +n.extra.column.width)), 0 >= e.width && (e.width = 1), e.x += (a + .5 - i / 2) * e.width, e);});}function fixColumeMeterData(e, t, i, a, o, n, l) {return e.map(function (e) {return null === e ? null : (e.width = Math.ceil((t - 2 * o.columePadding) / 2), n.extra.column && n.extra.column.width && 0 < +n.extra.column.width && (e.width = Math.min(e.width, +n.extra.column.width)), 0 < a && (e.width -= 2 * l), e);});}function fixColumeStackData(e, t, i, a, o, n) {return e.map(function (e) {return null === e ? null : (e.width = Math.ceil((t - 2 * o.columePadding) / 2), n.extra.column && n.extra.column.width && 0 < +n.extra.column.width && (e.width = Math.min(e.width, +n.extra.column.width)), e);});}function getXAxisPoints(e, t) {var i = t.width - t.area[1] - t.area[3],a = t.enableScroll ? Math.min(t.xAxis.itemCount, e.length) : e.length;("line" == t.type || "area" == t.type) && 1 < a && "justify" == t.xAxis.boundaryGap && (a -= 1);var o = i / a,n = [],l = t.area[3],r = t.width - t.area[1];return e.forEach(function (e, t) {n.push(l + t * o);}), "justify" !== t.xAxis.boundaryGap && (!0 === t.enableScroll ? n.push(l + e.length * o) : n.push(r)), { xAxisPoints: n, startX: l, endX: r, eachSpacing: o };}function getCandleDataPoints(e, t, i, a, o, n) {var l = Math.round,r = 7 < arguments.length && void 0 !== arguments[7] ? arguments[7] : 1,s = [],d = n.height - n.area[0] - n.area[2];return e.forEach(function (e, h) {if (null === e) s.push(null);else {var x = [];e.forEach(function (e) {var s = { x: a[h] + l(o / 2) },c = e.value || e,p = d * (c - t) / (i - t);p *= r, s.y = n.height - l(p) - n.area[2], x.push(s);}), s.push(x);}}), s;}function getDataPoints(e, t, i, a, o, n) {var l = Math.round,r = 7 < arguments.length && void 0 !== arguments[7] ? arguments[7] : 1,s = "center";("line" == n.type || "area" == n.type) && (s = n.xAxis.boundaryGap);var d = [],h = n.height - n.area[0] - n.area[2],x = n.width - n.area[1] - n.area[3];return e.forEach(function (e, c) {if (null === e) d.push(null);else {var p = { color: e.color, x: a[c] },g = e;if ("object" == typeof e && null !== e) if (e.constructor == Array) {var _t6, _i6, _a8;_t6 = [].concat(n.chartData.xAxisData.ranges), _i6 = _t6.shift(), _a8 = _t6.pop(), g = e[1], p.x = n.area[3] + x * (e[0] - _i6) / (_a8 - _i6);} else g = e.value;"center" == s && (p.x += l(o / 2));var y = h * (g - t) / (i - t);y *= r, p.y = n.height - l(y) - n.area[2], d.push(p);}}), d;}function getStackDataPoints(e, t, i, a, o, n, l, r, s) {var d = Math.round,h = 9 < arguments.length && void 0 !== arguments[9] ? arguments[9] : 1,x = [],c = n.height - n.area[0] - n.area[2];return e.forEach(function (e, l) {if (null === e) x.push(null);else {var p = { color: e.color, x: a[l] + d(o / 2) };if (0 < r) {var g = 0;for (var _e7 = 0; _e7 <= r; _e7++) {g += s[_e7].data[l];}var y = g - e,f = c * (g - t) / (i - t),u = c * (y - t) / (i - t);} else var g = e,f = c * (g - t) / (i - t),u = 0;var m = u;f *= h, m *= h, p.y = n.height - d(f) - n.area[2], p.y0 = n.height - d(m) - n.area[2], x.push(p);}}), x;}function getYAxisTextList(e, t, a, o) {var n,l = Math.min,r = Math.max,s = 4 < arguments.length && void 0 !== arguments[4] ? arguments[4] : -1;n = "stack" == o ? dataCombineStack(e, t.categories.length) : dataCombine(e);var d = [];n = n.filter(function (e) {return "object" == typeof e && null !== e ? e.constructor == Array ? null !== e : null !== e.value : null !== e;}), n.map(function (e) {"object" == typeof e ? e.constructor == Array ? "candle" == t.type ? e.map(function (e) {d.push(e);}) : d.push(e[1]) : d.push(e.value) : d.push(e);});var h = 0,x = 0;if (0 < d.length && (h = l.apply(this, d), x = r.apply(this, d)), -1 < s ? ("number" == typeof t.yAxis.data[s].min && (h = l(t.yAxis.data[s].min, h)), "number" == typeof t.yAxis.data[s].max && (x = r(t.yAxis.data[s].max, x))) : ("number" == typeof t.yAxis.min && (h = l(t.yAxis.min, h)), "number" == typeof t.yAxis.max && (x = r(t.yAxis.max, x))), h === x) {var c = x || 10;x += c;}for (var p = getDataRange(h, x), g = p.minRange, y = p.maxRange, f = [], u = (y - g) / t.yAxis.splitNumber, m = 0; m <= t.yAxis.splitNumber; m++) {f.push(g + u * m);}return f.reverse();}function calYAxisData(e, t, a) {var o = Math.max,n = assign({}, { type: "" }, t.extra.column),l = t.yAxis.data.length,r = Array(l);if (0 < l) {for (var _t7 = 0; _t7 < l; _t7++) {r[_t7] = [];for (var _i7 = 0; _i7 < e.length; _i7++) {e[_i7].index == _t7 && r[_t7].push(e[_i7]);}}var s = Array(l),d = Array(l),h = Array(l);var _loop2 = function _loop2(x, _e9) {_e9 = t.yAxis.data[x], !0 == t.yAxis.disabled && (_e9.disabled = !0), s[x] = getYAxisTextList(r[x], t, a, n.type, x);var i = _e9.fontSize || a.fontSize;h[x] = { position: _e9.position ? _e9.position : "left", width: 0 }, d[x] = s[x].map(function (t) {_e8 = _e9;return t = util.toFixed(t, 6), t = _e9.format ? _e9.format(+t) : t, h[x].width = o(h[x].width, measureText(t, i) + 5), t;});var l = _e9.calibration ? 4 * t.pixelRatio : 0;h[x].width += l + 3 * t.pixelRatio, !0 === _e9.disabled && (h[x].width = 0);_e8 = _e9;};for (var _e8, x = 0; x < l; x++) {_loop2(x, _e8);}} else {var s = [,],d = [,],h = [,];s[0] = getYAxisTextList(e, t, a, n.type), h[0] = { position: "left", width: 0 };var i = t.yAxis.fontSize || a.fontSize;d[0] = s[0].map(function (e) {return e = util.toFixed(e, 6), e = t.yAxis.format ? t.yAxis.format(+e) : e, h[0].width = o(h[0].width, measureText(e, i) + 5), e;}), h[0].width += 3 * t.pixelRatio, !0 === t.yAxis.disabled ? (h[0] = { position: "left", width: 0 }, t.yAxis.data[0] = { disabled: !0 }) : t.yAxis.data[0] = { disabled: !1, position: "left", max: t.yAxis.max, min: t.yAxis.min, format: t.yAxis.format };}return { rangesFormat: d, ranges: s, yAxisWidth: h };}function calTooltipYAxisData(e, t, a) {var o = [].concat(a.chartData.yAxisData.ranges),n = a.height - a.area[0] - a.area[2],l = a.area[0],r = [];for (var s = 0; s < o.length; s++) {var _t8 = o[s].shift(),i = o[s].pop(),d = _t8 - (_t8 - i) * (e - l) / n;d = a.yAxis.data[s].format ? a.yAxis.data[s].format(+d) : d.toFixed(0), r.push(d + "");}return r;}function calMarkLineData(e, t) {var a,o,n = t.height - t.area[0] - t.area[2];for (var l = 0; l < e.length; l++) {e[l].yAxisIndex = e[l].yAxisIndex ? e[l].yAxisIndex : 0;var i = [].concat(t.chartData.yAxisData.ranges[e[l].yAxisIndex]);a = i.pop(), o = i.shift();var r = n * (e[l].value - a) / (o - a);e[l].y = t.height - Math.round(r) - t.area[2];}return e;}function contextRotate(e, t) {var i = Math.PI;!0 === t.rotateLock ? !0 !== t._rotate_ && (e.translate(t.height, 0), e.rotate(90 * i / 180), t._rotate_ = !0) : (e.translate(t.height, 0), e.rotate(90 * i / 180));}function drawPointShape(e, t, i, a, o) {a.beginPath(), "hollow" == o.dataPointShapeType ? (a.setStrokeStyle(t), a.setFillStyle(o.background), a.setLineWidth(2 * o.pixelRatio)) : (a.setStrokeStyle("#ffffff"), a.setFillStyle(t), a.setLineWidth(1 * o.pixelRatio)), "diamond" === i ? e.forEach(function (e) {null !== e && (a.moveTo(e.x, e.y - 4.5), a.lineTo(e.x - 4.5, e.y), a.lineTo(e.x, e.y + 4.5), a.lineTo(e.x + 4.5, e.y), a.lineTo(e.x, e.y - 4.5));}) : "circle" === i ? e.forEach(function (e) {null !== e && (a.moveTo(e.x + 2.5 * o.pixelRatio, e.y), a.arc(e.x, e.y, 3 * o.pixelRatio, 0, 2 * Math.PI, !1));}) : "rect" === i ? e.forEach(function (e) {null !== e && (a.moveTo(e.x - 3.5, e.y - 3.5), a.rect(e.x - 3.5, e.y - 3.5, 7, 7));}) : "triangle" == i && e.forEach(function (e) {null !== e && (a.moveTo(e.x, e.y - 4.5), a.lineTo(e.x - 4.5, e.y + 4.5), a.lineTo(e.x + 4.5, e.y + 4.5), a.lineTo(e.x, e.y - 4.5));}), a.closePath(), a.fill(), a.stroke();}function drawRingTitle(e, t, i, a) {var o = e.title.fontSize || t.titleFontSize,n = e.subtitle.fontSize || t.subtitleFontSize,l = e.title.name || "",r = e.subtitle.name || "",s = e.title.color || t.titleColor,d = e.subtitle.color || t.subtitleColor,h = l ? o : 0,x = r ? n : 0,c = 5;if (r) {var p = measureText(r, n),g = a.x - p / 2 + (e.subtitle.offsetX || 0),y = a.y + n / 2 + (e.subtitle.offsetY || 0);l && (y += (h + c) / 2), i.beginPath(), i.setFontSize(n), i.setFillStyle(d), i.fillText(r, g, y), i.closePath(), i.stroke();}if (l) {var f = measureText(l, o),u = a.x - f / 2 + (e.title.offsetX || 0),m = a.y + o / 2 + (e.title.offsetY || 0);r && (m -= (x + c) / 2), i.beginPath(), i.setFontSize(o), i.setFillStyle(s), i.fillText(l, u, m), i.closePath(), i.stroke();}}function drawPointText(e, t, i, a) {var o = t.data;e.forEach(function (e, n) {if (null !== e) {a.beginPath(), a.setFontSize(t.textSize || i.fontSize), a.setFillStyle(t.textColor || "#666666");var l = o[n];"object" == typeof o[n] && null !== o[n] && (o[n].constructor == Array ? l = o[n][1] : l = o[n].value);var r = t.format ? t.format(l) : l;a.fillText(r + "", e.x - measureText(r, t.textSize || i.fontSize) / 2, e.y - 4), a.closePath(), a.stroke();}});}function drawGaugeLabel(e, t, i, a, o, n) {var l = Math.PI;t -= e.width / 2 + o.gaugeLabelTextMargin;var r = e.startAngle - e.endAngle + 1,s = r / e.splitLine.splitNumber,d = e.endNumber - e.startNumber,h = d / e.splitLine.splitNumber,x = e.startAngle,c = e.startNumber;for (var _r4 = 0; _r4 < e.splitLine.splitNumber + 1; _r4++) {var p = { x: t * Math.cos(x * l), y: t * Math.sin(x * l) },g = e.labelFormat ? e.labelFormat(c) : c;p.x += i.x - measureText(g) / 2, p.y += i.y;var y = p.x,f = p.y;n.beginPath(), n.setFontSize(o.fontSize), n.setFillStyle(e.labelColor || "#666666"), n.fillText(g, y, f + o.fontSize / 2), n.closePath(), n.stroke(), x += s, 2 <= x && (x %= 2), c += h;}}function drawRadarLabel(e, t, i, a, o, n) {var l = a.extra.radar || {};t += o.radarLabelTextMargin, e.forEach(function (e, r) {var s = { x: t * Math.cos(e), y: t * Math.sin(e) },d = convertCoordinateOrigin(s.x, s.y, i),h = d.x,x = d.y;util.approximatelyEqual(s.x, 0) ? h -= measureText(a.categories[r] || "") / 2 : 0 > s.x && (h -= measureText(a.categories[r] || "")), n.beginPath(), n.setFontSize(o.fontSize), n.setFillStyle(l.labelColor || "#666666"), n.fillText(a.categories[r] || "", h, x + o.fontSize / 2), n.closePath(), n.stroke();});}function drawPieText(e, t, a, o, i, n) {var l = Math.cos,r = Math.sin,s = Math.min,d = Math.max,h = Math.PI,x = a.pieChartLinePadding,c = [],p = null,g = e.map(function (e) {var t = e.format ? e.format(+e._proportion_.toFixed(2)) : util.toFixed(100 * e._proportion_.toFixed(4)) + "%";e._rose_proportion_ && (e._proportion_ = e._rose_proportion_);var i = 2 * h - (e._start_ + 2 * h * e._proportion_ / 2),a = e.color,o = e._radius_;return { arc: i, text: t, color: a, radius: o, textColor: e.textColor, textSize: e.textSize };});for (var _h = 0; _h < g.length; _h++) {var _e10 = g[_h],_t9 = l(_e10.arc) * (_e10.radius + x),_i8 = r(_e10.arc) * (_e10.radius + x),_o11 = l(_e10.arc) * _e10.radius,_n12 = r(_e10.arc) * _e10.radius,y = 0 <= _t9 ? _t9 + a.pieChartTextPadding : _t9 - a.pieChartTextPadding,f = _i8,u = measureText(_e10.text, _e10.textSize || a.fontSize),m = f;p && util.isSameXCoordinateArea(p.start, { x: y }) && (0 < y ? m = s(f, p.start.y) : 0 > _t9 ? m = d(f, p.start.y) : 0 < f ? m = d(f, p.start.y) : m = s(f, p.start.y)), 0 > y && (y -= u);var S = { lineStart: { x: _o11, y: _n12 }, lineEnd: { x: _t9, y: _i8 }, start: { x: y, y: m }, width: u, height: a.fontSize, text: _e10.text, color: _e10.color, textColor: _e10.textColor, textSize: _e10.textSize };p = avoidCollision(S, p), c.push(p);}for (var _l4 = 0; _l4 < c.length; _l4++) {var _e11 = c[_l4],_i9 = convertCoordinateOrigin(_e11.lineStart.x, _e11.lineStart.y, n),_r5 = convertCoordinateOrigin(_e11.lineEnd.x, _e11.lineEnd.y, n),_s2 = convertCoordinateOrigin(_e11.start.x, _e11.start.y, n);o.setLineWidth(1 * t.pixelRatio), o.setFontSize(a.fontSize), o.beginPath(), o.setStrokeStyle(_e11.color), o.setFillStyle(_e11.color), o.moveTo(_i9.x, _i9.y);var _d = 0 > _e11.start.x ? _s2.x + _e11.width : _s2.x,_x = 0 > _e11.start.x ? _s2.x - 5 : _s2.x + 5;o.quadraticCurveTo(_r5.x, _r5.y, _d, _s2.y), o.moveTo(_i9.x, _i9.y), o.stroke(), o.closePath(), o.beginPath(), o.moveTo(_s2.x + _e11.width, _s2.y), o.arc(_d, _s2.y, 2, 0, 2 * h), o.closePath(), o.fill(), o.beginPath(), o.setFontSize(_e11.textSize || a.fontSize), o.setFillStyle(_e11.textColor || "#666666"), o.fillText(_e11.text, _x, _s2.y + 3), o.closePath(), o.stroke(), o.closePath();}}function drawToolTipSplitLine(e, t, i, a) {var o = t.extra.tooltip || {};o.gridType = null == o.gridType ? "solid" : o.gridType, o.dashLength = null == o.dashLength ? 4 : o.dashLength;var n = t.area[0],l = t.height - t.area[2];if ("dash" == o.gridType && a.setLineDash([o.dashLength, o.dashLength]), a.setStrokeStyle(o.gridColor || "#cccccc"), a.setLineWidth(1 * t.pixelRatio), a.beginPath(), a.moveTo(e, n), a.lineTo(e, l), a.stroke(), a.setLineDash([]), o.xAxisLabel) {var _n13 = t.categories[t.tooltip.index];a.setFontSize(i.fontSize);var r = measureText(_n13, i.fontSize),s = e - .5 * r,d = l;a.beginPath(), a.setFillStyle(hexToRgb(o.labelBgColor || i.toolTipBackground, o.labelBgOpacity || i.toolTipOpacity)), a.setStrokeStyle(o.labelBgColor || i.toolTipBackground), a.setLineWidth(1 * t.pixelRatio), a.rect(s - i.toolTipPadding, d, r + 2 * i.toolTipPadding, i.fontSize + 2 * i.toolTipPadding), a.closePath(), a.stroke(), a.fill(), a.beginPath(), a.setFontSize(i.fontSize), a.setFillStyle(o.labelFontColor || i.fontColor), a.fillText(_n13 + "", s, d + i.toolTipPadding + i.fontSize), a.closePath(), a.stroke();}}function drawMarkLine(e, t, a) {var o = assign({}, { type: "solid", dashLength: 4, data: [] }, e.extra.markLine),n = e.area[3],l = e.width - e.area[1],r = calMarkLineData(o.data, e);for (var s, d = 0; d < r.length; d++) {if (s = assign({}, { lineColor: "#DE4A42", showLabel: !1, labelFontColor: "#666666", labelBgColor: "#DFE8FF", labelBgOpacity: .8, yAxisIndex: 0 }, r[d]), "dash" == o.type && a.setLineDash([o.dashLength, o.dashLength]), a.setStrokeStyle(s.lineColor), a.setLineWidth(1 * e.pixelRatio), a.beginPath(), a.moveTo(n, s.y), a.lineTo(l, s.y), a.stroke(), a.setLineDash([]), s.showLabel) {var i = e.yAxis.format ? e.yAxis.format(+s.value) : s.value;a.setFontSize(t.fontSize);var _o12 = measureText(i, t.fontSize),_n14 = e.padding[3] + t.yAxisTitleWidth - t.toolTipPadding,_l5 = Math.max(e.area[3], _o12 + 2 * t.toolTipPadding),_r6 = _l5 - _n14,_d2 = s.y;a.setFillStyle(hexToRgb(s.labelBgColor, s.labelBgOpacity)), a.setStrokeStyle(s.labelBgColor), a.setLineWidth(1 * e.pixelRatio), a.beginPath(), a.rect(_n14, _d2 - .5 * t.fontSize - t.toolTipPadding, _r6, t.fontSize + 2 * t.toolTipPadding), a.closePath(), a.stroke(), a.fill(), a.beginPath(), a.setFontSize(t.fontSize), a.setFillStyle(s.labelFontColor), a.fillText(i + "", _n14 + (_r6 - _o12) / 2, _d2 + .5 * t.fontSize), a.stroke();}}}function drawToolTipHorizentalLine(e, t, a, i) {var o = Math.max,n = assign({}, { gridType: "solid", dashLength: 4 }, e.extra.tooltip),l = e.area[3],r = e.width - e.area[1];if ("dash" == n.gridType && a.setLineDash([n.dashLength, n.dashLength]), a.setStrokeStyle(n.gridColor || "#cccccc"), a.setLineWidth(1 * e.pixelRatio), a.beginPath(), a.moveTo(l, e.tooltip.offset.y), a.lineTo(r, e.tooltip.offset.y), a.stroke(), a.setLineDash([]), n.yAxisLabel) {var _l6 = calTooltipYAxisData(e.tooltip.offset.y, e.series, e, t, i),_r7 = e.chartData.yAxisData.yAxisWidth,s = e.area[3],d = e.width - e.area[1];for (var h = 0; h < _l6.length; h++) {a.setFontSize(t.fontSize);var _i10 = void 0,x = void 0,c = void 0,p = measureText(_l6[h], t.fontSize);"left" == _r7[h].position ? (_i10 = s - _r7[h].width, x = o(_i10, _i10 + p + 2 * t.toolTipPadding)) : (_i10 = d, x = o(_i10 + _r7[h].width, _i10 + p + 2 * t.toolTipPadding)), c = x - _i10;var g = _i10 + (c - p) / 2,y = e.tooltip.offset.y;a.beginPath(), a.setFillStyle(hexToRgb(n.labelBgColor || t.toolTipBackground, n.labelBgOpacity || t.toolTipOpacity)), a.setStrokeStyle(n.labelBgColor || t.toolTipBackground), a.setLineWidth(1 * e.pixelRatio), a.rect(_i10, y - .5 * t.fontSize - t.toolTipPadding, c, t.fontSize + 2 * t.toolTipPadding), a.closePath(), a.stroke(), a.fill(), a.beginPath(), a.setFontSize(t.fontSize), a.setFillStyle(n.labelFontColor || t.fontColor), a.fillText(_l6[h], g, y + .5 * t.fontSize), a.closePath(), a.stroke(), "left" == _r7[h].position ? s -= _r7[h].width + e.yAxis.padding : d += _r7[h].width + e.yAxis.padding;}}}function drawToolTipSplitArea(e, t, i, a, o) {var n = assign({}, { activeBgColor: "#000000", activeBgOpacity: .08 }, t.extra.tooltip),l = t.area[0],r = t.height - t.area[2];a.beginPath(), a.setFillStyle(hexToRgb(n.activeBgColor, n.activeBgOpacity)), a.rect(e - o / 2, l, o, r - l), a.closePath(), a.fill();}function drawToolTip(e, t, i, a, o) {var n = Math.round,l = assign({}, { showBox: !0, bgColor: "#000000", bgOpacity: .7, fontColor: "#FFFFFF" }, i.extra.tooltip),r = 4 * i.pixelRatio,s = 5 * i.pixelRatio,d = 8 * i.pixelRatio,h = !1;("line" == i.type || "area" == i.type || "candle" == i.type || "mix" == i.type) && drawToolTipSplitLine(i.tooltip.offset.x, i, a, o), t = assign({ x: 0, y: 0 }, t), t.y -= 8 * i.pixelRatio;var x = e.map(function (e) {return measureText(e.text, a.fontSize);}),c = r + s + 4 * a.toolTipPadding + Math.max.apply(null, x),p = 2 * a.toolTipPadding + e.length * a.toolTipLineHeight;!1 == l.showBox || (t.x - Math.abs(i._scrollDistance_) + d + c > i.width && (h = !0), p + t.y > i.height && (t.y = i.height - p), o.beginPath(), o.setFillStyle(hexToRgb(l.bgColor || a.toolTipBackground, l.bgOpacity || a.toolTipOpacity)), h ? (o.moveTo(t.x, t.y + 10 * i.pixelRatio), o.lineTo(t.x - d, t.y + 10 * i.pixelRatio - 5 * i.pixelRatio), o.lineTo(t.x - d, t.y), o.lineTo(t.x - d - n(c), t.y), o.lineTo(t.x - d - n(c), t.y + p), o.lineTo(t.x - d, t.y + p), o.lineTo(t.x - d, t.y + 10 * i.pixelRatio + 5 * i.pixelRatio), o.lineTo(t.x, t.y + 10 * i.pixelRatio)) : (o.moveTo(t.x, t.y + 10 * i.pixelRatio), o.lineTo(t.x + d, t.y + 10 * i.pixelRatio - 5 * i.pixelRatio), o.lineTo(t.x + d, t.y), o.lineTo(t.x + d + n(c), t.y), o.lineTo(t.x + d + n(c), t.y + p), o.lineTo(t.x + d, t.y + p), o.lineTo(t.x + d, t.y + 10 * i.pixelRatio + 5 * i.pixelRatio), o.lineTo(t.x, t.y + 10 * i.pixelRatio)), o.closePath(), o.fill(), e.forEach(function (e, i) {if (null !== e.color) {o.beginPath(), o.setFillStyle(e.color);var n = t.x + d + 2 * a.toolTipPadding,l = t.y + (a.toolTipLineHeight - a.fontSize) / 2 + a.toolTipLineHeight * i + a.toolTipPadding + 1;h && (n = t.x - c - d + 2 * a.toolTipPadding), o.fillRect(n, l, r, a.fontSize), o.closePath();}}), e.forEach(function (e, i) {var n = t.x + d + 2 * a.toolTipPadding + r + s;h && (n = t.x - c - d + 2 * a.toolTipPadding + +r + s);var x = t.y + (a.toolTipLineHeight - a.fontSize) / 2 + a.toolTipLineHeight * i + a.toolTipPadding;o.beginPath(), o.setFontSize(a.fontSize), o.setFillStyle(l.fontColor), o.fillText(e.text, n, x + a.fontSize), o.closePath(), o.stroke();}));}function drawYAxisTitle(e, t, i, a) {var o = i.xAxisHeight + (t.height - i.xAxisHeight - measureText(e)) / 2;a.save(), a.beginPath(), a.setFontSize(i.fontSize), a.setFillStyle(t.yAxis.titleFontColor || "#333333"), a.translate(0, t.height), a.rotate(-90 * Math.PI / 180), a.fillText(e, o, t.padding[3] + .5 * i.fontSize), a.closePath(), a.stroke(), a.restore();}function drawColumnDataPoints(e, t, i, a) {var o = 4 < arguments.length && void 0 !== arguments[4] ? arguments[4] : 1,n = t.chartData.xAxisData,l = n.xAxisPoints,r = n.eachSpacing,s = assign({}, { type: "group", width: r / 2, meter: { border: 4, fillColor: "#FFFFFF" } }, t.extra.column),d = [];a.save();var h = -2,x = l.length + 2;return t._scrollDistance_ && 0 !== t._scrollDistance_ && !0 === t.enableScroll && (a.translate(t._scrollDistance_, 0), h = Math.floor(-t._scrollDistance_ / r) - 2, x = h + t.xAxis.itemCount + 4), t.tooltip && t.tooltip.textList && t.tooltip.textList.length && 1 === o && drawToolTipSplitArea(t.tooltip.offset.x, t, i, a, r), e.forEach(function (n, c) {var p, g, y;p = [].concat(t.chartData.yAxisData.ranges[n.index]), g = p.pop(), y = p.shift();var f = n.data;switch (s.type) {case "group":var u = getDataPoints(f, g, y, l, r, t, i, o),m = getStackDataPoints(f, g, y, l, r, t, i, c, e, o);d.push(m), u = fixColumeData(u, r, e.length, c, i, t);for (var _e12, _o13 = 0; _o13 < u.length; _o13++) {if (_e12 = u[_o13], null !== _e12 && _o13 > h && _o13 < x) {a.beginPath(), a.setStrokeStyle(_e12.color || n.color), a.setLineWidth(1), a.setFillStyle(_e12.color || n.color);var S = _e12.x - _e12.width / 2,T = t.height - _e12.y - t.area[2];a.moveTo(S - 1, _e12.y), a.lineTo(S + _e12.width - 2, _e12.y), a.lineTo(S + _e12.width - 2, t.height - t.area[2]), a.lineTo(S, t.height - t.area[2]), a.lineTo(S, _e12.y), a.closePath(), a.stroke(), a.fill();}};break;case "stack":var u = getStackDataPoints(f, g, y, l, r, t, i, c, e, o);d.push(u), u = fixColumeStackData(u, r, e.length, c, i, t, e);for (var _e13, _o14 = 0; _o14 < u.length; _o14++) {if (_e13 = u[_o14], null !== _e13 && _o14 > h && _o14 < x) {a.beginPath(), a.setFillStyle(_e13.color || n.color);var S = _e13.x - _e13.width / 2 + 1,T = t.height - _e13.y - t.area[2],A = t.height - _e13.y0 - t.area[2];0 < c && (T -= A), a.moveTo(S, _e13.y), a.fillRect(S, _e13.y, _e13.width - 2, T), a.closePath(), a.fill();}};break;case "meter":var u = getDataPoints(f, g, y, l, r, t, i, o);if (d.push(u), u = fixColumeMeterData(u, r, e.length, c, i, t, s.meter.border), 0 == c) {for (var _e14, _o15 = 0; _o15 < u.length; _o15++) {if (_e14 = u[_o15], null !== _e14 && _o15 > h && _o15 < x) {a.beginPath(), a.setFillStyle(s.meter.fillColor);var S = _e14.x - _e14.width / 2,T = t.height - _e14.y - t.area[2];a.moveTo(S, _e14.y), a.fillRect(S, _e14.y, _e14.width, T), a.closePath(), a.fill(), 0 < s.meter.border && (a.beginPath(), a.setStrokeStyle(n.color), a.setLineWidth(s.meter.border * t.pixelRatio), a.moveTo(S + .5 * s.meter.border, _e14.y + T), a.lineTo(S + .5 * s.meter.border, _e14.y + .5 * s.meter.border), a.lineTo(S + _e14.width - .5 * s.meter.border, _e14.y + .5 * s.meter.border), a.lineTo(S + _e14.width - .5 * s.meter.border, _e14.y + T), a.stroke());}}} else for (var _e15, _o16 = 0; _o16 < u.length; _o16++) {if (_e15 = u[_o16], null !== _e15 && _o16 > h && _o16 < x) {a.beginPath(), a.setFillStyle(_e15.color || n.color);var S = _e15.x - _e15.width / 2,T = t.height - _e15.y - t.area[2];a.moveTo(S, _e15.y), a.fillRect(S, _e15.y, _e15.width, T), a.closePath(), a.fill();}}}}), !1 !== t.dataLabel && 1 === o && e.forEach(function (n, d) {var h, x, c;h = [].concat(t.chartData.yAxisData.ranges[n.index]), x = h.pop(), c = h.shift();var p = n.data;switch (s.type) {case "group":var g = getDataPoints(p, x, c, l, r, t, i, o);g = fixColumeData(g, r, e.length, d, i, t), drawPointText(g, n, i, a);break;case "stack":var g = getStackDataPoints(p, x, c, l, r, t, i, d, e, o);drawPointText(g, n, i, a);break;case "meter":var g = getDataPoints(p, x, c, l, r, t, i, o);drawPointText(g, n, i, a);}}), a.restore(), { xAxisPoints: l, calPoints: d, eachSpacing: r };}function drawCandleDataPoints(e, t, a, i, o) {var n = 5 < arguments.length && void 0 !== arguments[5] ? arguments[5] : 1,l = assign({}, { color: {}, average: {} }, a.extra.candle);l.color = assign({}, { upLine: "#f04864", upFill: "#f04864", downLine: "#2fc25b", downFill: "#2fc25b" }, l.color), l.average = assign({}, { show: !1, name: [], day: [], color: i.colors }, l.average), a.extra.candle = l;var r = a.chartData.xAxisData,s = r.xAxisPoints,d = r.eachSpacing,h = [];o.save();var x = -2,c = s.length + 2,p = 0,g = a.width + d;return a._scrollDistance_ && 0 !== a._scrollDistance_ && !0 === a.enableScroll && (o.translate(a._scrollDistance_, 0), x = Math.floor(-a._scrollDistance_ / d) - 2, c = x + a.xAxis.itemCount + 4, p = -a._scrollDistance_ - d + a.area[3], g = p + (a.xAxis.itemCount + 4) * d), l.average.show && t.forEach(function (e) {var t, l, r;t = [].concat(a.chartData.yAxisData.ranges[e.index]), l = t.pop(), r = t.shift();var h = e.data,x = getDataPoints(h, l, r, s, d, a, i, n),c = splitPoints(x);for (var _t10, _a9 = 0; _a9 < c.length; _a9++) {if (_t10 = c[_a9], o.beginPath(), o.setStrokeStyle(e.color), o.setLineWidth(1), 1 === _t10.length) o.moveTo(_t10[0].x, _t10[0].y), o.arc(_t10[0].x, _t10[0].y, 1, 0, 2 * Math.PI);else {o.moveTo(_t10[0].x, _t10[0].y);var _e16 = 0;for (var _i11, _a10 = 0; _a10 < _t10.length; _a10++) {if (_i11 = _t10[_a10], 0 == _e16 && _i11.x > p && (o.moveTo(_i11.x, _i11.y), _e16 = 1), 0 < _a10 && _i11.x > p && _i11.x < g) {var y = createCurveControlPoints(_t10, _a10 - 1);o.bezierCurveTo(y.ctrA.x, y.ctrA.y, y.ctrB.x, y.ctrB.y, _i11.x, _i11.y);}}o.moveTo(_t10[0].x, _t10[0].y);}o.closePath(), o.stroke();}}), e.forEach(function (e) {var t, r, p;t = [].concat(a.chartData.yAxisData.ranges[e.index]), r = t.pop(), p = t.shift();var g = e.data,y = getCandleDataPoints(g, r, p, s, d, a, i, n);h.push(y);var f = splitPoints(y);for (var _t11 = 0; _t11 < f[0].length; _t11++) {if (_t11 > x && _t11 < c) {var _e17 = f[0][_t11];o.beginPath(), 0 < g[_t11][1] - g[_t11][0] ? (o.setStrokeStyle(l.color.upLine), o.setFillStyle(l.color.upFill), o.setLineWidth(1 * a.pixelRatio), o.moveTo(_e17[3].x, _e17[3].y), o.lineTo(_e17[1].x, _e17[1].y), o.lineTo(_e17[1].x - d / 4, _e17[1].y), o.lineTo(_e17[0].x - d / 4, _e17[0].y), o.lineTo(_e17[0].x, _e17[0].y), o.lineTo(_e17[2].x, _e17[2].y), o.lineTo(_e17[0].x, _e17[0].y), o.lineTo(_e17[0].x + d / 4, _e17[0].y), o.lineTo(_e17[1].x + d / 4, _e17[1].y), o.lineTo(_e17[1].x, _e17[1].y), o.moveTo(_e17[3].x, _e17[3].y)) : (o.setStrokeStyle(l.color.downLine), o.setFillStyle(l.color.downFill), o.setLineWidth(1 * a.pixelRatio), o.moveTo(_e17[3].x, _e17[3].y), o.lineTo(_e17[0].x, _e17[0].y), o.lineTo(_e17[0].x - d / 4, _e17[0].y), o.lineTo(_e17[1].x - d / 4, _e17[1].y), o.lineTo(_e17[1].x, _e17[1].y), o.lineTo(_e17[2].x, _e17[2].y), o.lineTo(_e17[1].x, _e17[1].y), o.lineTo(_e17[1].x + d / 4, _e17[1].y), o.lineTo(_e17[0].x + d / 4, _e17[0].y), o.lineTo(_e17[0].x, _e17[0].y), o.moveTo(_e17[3].x, _e17[3].y)), o.closePath(), o.fill(), o.stroke();}}}), o.restore(), { xAxisPoints: s, calPoints: h, eachSpacing: d };}function drawAreaDataPoints(e, t, i, a) {var o = 4 < arguments.length && void 0 !== arguments[4] ? arguments[4] : 1,n = assign({}, { type: "straight", opacity: .2, addLine: !1, width: 2, gradient: !1 }, t.extra.area);var l = t.chartData.xAxisData,r = l.xAxisPoints,s = l.eachSpacing,d = t.height - t.area[2],h = [];a.save();var x = 0,c = t.width + s;return t._scrollDistance_ && 0 !== t._scrollDistance_ && !0 === t.enableScroll && (a.translate(t._scrollDistance_, 0), x = -t._scrollDistance_ - s + t.area[3], c = x + (t.xAxis.itemCount + 4) * s), e.forEach(function (e) {var l, p, g;l = [].concat(t.chartData.yAxisData.ranges[e.index]), p = l.pop(), g = l.shift();var y = e.data,f = getDataPoints(y, p, g, r, s, t, i, o);h.push(f);var u = splitPoints(f);for (var _o17, _l7 = 0; _l7 < u.length; _l7++) {if (_o17 = u[_l7], a.beginPath(), a.setStrokeStyle(hexToRgb(e.color, n.opacity)), n.gradient) {var _i12 = a.createLinearGradient(0, t.area[0], 0, t.height - t.area[2]);_i12.addColorStop("0", hexToRgb(e.color, n.opacity)), _i12.addColorStop("1.0", hexToRgb("#FFFFFF", .1)), a.setFillStyle(_i12);} else a.setFillStyle(hexToRgb(e.color, n.opacity));if (a.setLineWidth(n.width * t.pixelRatio), 1 < _o17.length) {var _e18 = _o17[0],_t12 = _o17[_o17.length - 1];a.moveTo(_e18.x, _e18.y);var _i13 = 0;if ("curve" === n.type) {for (var _e19, _t13 = 0; _t13 < _o17.length; _t13++) {if (_e19 = _o17[_t13], 0 == _i13 && _e19.x > x && (a.moveTo(_e19.x, _e19.y), _i13 = 1), 0 < _t13 && _e19.x > x && _e19.x < c) {var _i14 = createCurveControlPoints(_o17, _t13 - 1);a.bezierCurveTo(_i14.ctrA.x, _i14.ctrA.y, _i14.ctrB.x, _i14.ctrB.y, _e19.x, _e19.y);}}} else for (var _e20, _t14 = 0; _t14 < _o17.length; _t14++) {_e20 = _o17[_t14], 0 == _i13 && _e20.x > x && (a.moveTo(_e20.x, _e20.y), _i13 = 1), 0 < _t14 && _e20.x > x && _e20.x < c && a.lineTo(_e20.x, _e20.y);}a.lineTo(_t12.x, d), a.lineTo(_e18.x, d), a.lineTo(_e18.x, _e18.y);} else {var _e21 = _o17[0];a.moveTo(_e21.x - s / 2, _e21.y), a.lineTo(_e21.x + s / 2, _e21.y), a.lineTo(_e21.x + s / 2, d), a.lineTo(_e21.x - s / 2, d), a.moveTo(_e21.x - s / 2, _e21.y);}if (a.closePath(), a.fill(), n.addLine) {if ("dash" == e.lineType) {var _i15 = e.dashLength ? e.dashLength : 8;_i15 *= t.pixelRatio, a.setLineDash([_i15, _i15]);}if (a.beginPath(), a.setStrokeStyle(e.color), a.setLineWidth(n.width * t.pixelRatio), 1 === _o17.length) a.moveTo(_o17[0].x, _o17[0].y), a.arc(_o17[0].x, _o17[0].y, 1, 0, 2 * Math.PI);else {a.moveTo(_o17[0].x, _o17[0].y);var _e22 = 0;if ("curve" === n.type) {for (var _t15, _i16 = 0; _i16 < _o17.length; _i16++) {if (_t15 = _o17[_i16], 0 == _e22 && _t15.x > x && (a.moveTo(_t15.x, _t15.y), _e22 = 1), 0 < _i16 && _t15.x > x && _t15.x < c) {var _e23 = createCurveControlPoints(_o17, _i16 - 1);a.bezierCurveTo(_e23.ctrA.x, _e23.ctrA.y, _e23.ctrB.x, _e23.ctrB.y, _t15.x, _t15.y);}}} else for (var _t16, _i17 = 0; _i17 < _o17.length; _i17++) {_t16 = _o17[_i17], 0 == _e22 && _t16.x > x && (a.moveTo(_t16.x, _t16.y), _e22 = 1), 0 < _i17 && _t16.x > x && _t16.x < c && a.lineTo(_t16.x, _t16.y);}a.moveTo(_o17[0].x, _o17[0].y);}a.stroke(), a.setLineDash([]);}}!1 !== t.dataPointShape && drawPointShape(f, e.color, e.pointShape, a, t);}), !1 !== t.dataLabel && 1 === o && e.forEach(function (e) {var n, l, d;n = [].concat(t.chartData.yAxisData.ranges[e.index]), l = n.pop(), d = n.shift();var h = e.data,x = getDataPoints(h, l, d, r, s, t, i, o);drawPointText(x, e, i, a);}), a.restore(), { xAxisPoints: r, calPoints: h, eachSpacing: s };}function drawLineDataPoints(e, t, i, a) {var o = 4 < arguments.length && void 0 !== arguments[4] ? arguments[4] : 1,n = assign({}, { type: "straight", width: 2 }, t.extra.line);n.width *= t.pixelRatio;var l = t.chartData.xAxisData,r = l.xAxisPoints,s = l.eachSpacing;var d = [];a.save();var h = 0,x = t.width + s;return t._scrollDistance_ && 0 !== t._scrollDistance_ && !0 === t.enableScroll && (a.translate(t._scrollDistance_, 0), h = -t._scrollDistance_ - s + t.area[3], x = h + (t.xAxis.itemCount + 4) * s), e.forEach(function (e) {var l, c, p;l = [].concat(t.chartData.yAxisData.ranges[e.index]), c = l.pop(), p = l.shift();var g = e.data,y = getDataPoints(g, c, p, r, s, t, i, o);d.push(y);var f = splitPoints(y);if ("dash" == e.lineType) {var _i18 = e.dashLength ? e.dashLength : 8;_i18 *= t.pixelRatio, a.setLineDash([_i18, _i18]);}a.beginPath(), a.setStrokeStyle(e.color), a.setLineWidth(n.width), f.forEach(function (e) {if (1 === e.length) a.moveTo(e[0].x, e[0].y), a.arc(e[0].x, e[0].y, 1, 0, 2 * Math.PI);else {a.moveTo(e[0].x, e[0].y);var _i19 = 0;if ("curve" === n.type) {for (var _o18, _n15 = 0; _n15 < e.length; _n15++) {if (_o18 = e[_n15], 0 == _i19 && _o18.x > h && (a.moveTo(_o18.x, _o18.y), _i19 = 1), 0 < _n15 && _o18.x > h && _o18.x < x) {var t = createCurveControlPoints(e, _n15 - 1);a.bezierCurveTo(t.ctrA.x, t.ctrA.y, t.ctrB.x, t.ctrB.y, _o18.x, _o18.y);}}} else for (var _t17, _o19 = 0; _o19 < e.length; _o19++) {_t17 = e[_o19], 0 == _i19 && _t17.x > h && (a.moveTo(_t17.x, _t17.y), _i19 = 1), 0 < _o19 && _t17.x > h && _t17.x < x && a.lineTo(_t17.x, _t17.y);}a.moveTo(e[0].x, e[0].y);}}), a.stroke(), a.setLineDash([]), !1 !== t.dataPointShape && drawPointShape(y, e.color, e.pointShape, a, t);}), !1 !== t.dataLabel && 1 === o && e.forEach(function (e) {var n, l, d;n = [].concat(t.chartData.yAxisData.ranges[e.index]), l = n.pop(), d = n.shift();var h = e.data,x = getDataPoints(h, l, d, r, s, t, i, o);drawPointText(x, e, i, a);}), a.restore(), { xAxisPoints: r, calPoints: d, eachSpacing: s };}function drawMixDataPoints(e, t, i, a) {var o = 4 < arguments.length && void 0 !== arguments[4] ? arguments[4] : 1,n = t.chartData.xAxisData,l = n.xAxisPoints,r = n.eachSpacing,s = t.height - t.area[2],d = [];var h = 0,x = 0;e.forEach(function (e) {"column" == e.type && (x += 1);}), a.save();var c = -2,p = l.length + 2,g = 0,y = t.width + r;if (t._scrollDistance_ && 0 !== t._scrollDistance_ && !0 === t.enableScroll && (a.translate(t._scrollDistance_, 0), c = Math.floor(-t._scrollDistance_ / r) - 2, p = c + t.xAxis.itemCount + 4, g = -t._scrollDistance_ - r + t.area[3], y = g + (t.xAxis.itemCount + 4) * r), e.forEach(function (e) {var n, f, u;n = [].concat(t.chartData.yAxisData.ranges[e.index]), f = n.pop(), u = n.shift();var m = e.data,S = getDataPoints(m, f, u, l, r, t, i, o);if (d.push(S), "column" == e.type) {S = fixColumeData(S, r, x, h, i, t);for (var _o20, _n16 = 0; _n16 < S.length; _n16++) {if (_o20 = S[_n16], null !== _o20 && _n16 > c && _n16 < p) {a.beginPath(), a.setStrokeStyle(_o20.color || e.color), a.setLineWidth(1), a.setFillStyle(_o20.color || e.color);var T = _o20.x - _o20.width / 2,A = t.height - _o20.y - t.area[2];a.moveTo(T, _o20.y), a.moveTo(T - 1, _o20.y), a.lineTo(T + _o20.width - 2, _o20.y), a.lineTo(T + _o20.width - 2, t.height - t.area[2]), a.lineTo(T, t.height - t.area[2]), a.lineTo(T, _o20.y), a.closePath(), a.stroke(), a.fill(), a.closePath(), a.fill();}}h += 1;}if ("area" == e.type) {var _o21 = splitPoints(S);for (var _n17, _l8 = 0; _l8 < _o21.length; _l8++) {if (_n17 = _o21[_l8], a.beginPath(), a.setStrokeStyle(e.color), a.setFillStyle(hexToRgb(e.color, .2)), a.setLineWidth(2 * t.pixelRatio), 1 < _n17.length) {var b = _n17[0];var _t18 = _n17[_n17.length - 1];a.moveTo(b.x, b.y);var _i20 = 0;if ("curve" === e.style) {for (var _e24, _t19 = 0; _t19 < _n17.length; _t19++) {if (_e24 = _n17[_t19], 0 == _i20 && _e24.x > g && (a.moveTo(_e24.x, _e24.y), _i20 = 1), 0 < _t19 && _e24.x > g && _e24.x < y) {var P = createCurveControlPoints(_n17, _t19 - 1);a.bezierCurveTo(P.ctrA.x, P.ctrA.y, P.ctrB.x, P.ctrB.y, _e24.x, _e24.y);}}} else for (var _e25, _t20 = 0; _t20 < _n17.length; _t20++) {_e25 = _n17[_t20], 0 == _i20 && _e25.x > g && (a.moveTo(_e25.x, _e25.y), _i20 = 1), 0 < _t20 && _e25.x > g && _e25.x < y && a.lineTo(_e25.x, _e25.y);}a.lineTo(_t18.x, s), a.lineTo(b.x, s), a.lineTo(b.x, b.y);} else {var _e26 = _n17[0];a.moveTo(_e26.x - r / 2, _e26.y), a.lineTo(_e26.x + r / 2, _e26.y), a.lineTo(_e26.x + r / 2, s), a.lineTo(_e26.x - r / 2, s), a.moveTo(_e26.x - r / 2, _e26.y);}a.closePath(), a.fill();}}if ("line" == e.type) {var _ = splitPoints(S);_.forEach(function (i) {if ("dash" == e.lineType) {var _i21 = e.dashLength ? e.dashLength : 8;_i21 *= t.pixelRatio, a.setLineDash([_i21, _i21]);}if (a.beginPath(), a.setStrokeStyle(e.color), a.setLineWidth(2 * t.pixelRatio), 1 === i.length) a.moveTo(i[0].x, i[0].y), a.arc(i[0].x, i[0].y, 1, 0, 2 * Math.PI);else {a.moveTo(i[0].x, i[0].y);var _t21 = 0;if ("curve" == e.style) {for (var _e27, _n18 = 0; _n18 < i.length; _n18++) {if (_e27 = i[_n18], 0 == _t21 && _e27.x > g && (a.moveTo(_e27.x, _e27.y), _t21 = 1), 0 < _n18 && _e27.x > g && _e27.x < y) {var o = createCurveControlPoints(i, _n18 - 1);a.bezierCurveTo(o.ctrA.x, o.ctrA.y, o.ctrB.x, o.ctrB.y, _e27.x, _e27.y);}}} else for (var _e28, _o22 = 0; _o22 < i.length; _o22++) {_e28 = i[_o22], 0 == _t21 && _e28.x > g && (a.moveTo(_e28.x, _e28.y), _t21 = 1), 0 < _o22 && _e28.x > g && _e28.x < y && a.lineTo(_e28.x, _e28.y);}a.moveTo(i[0].x, i[0].y);}a.stroke(), a.setLineDash([]);});}"point" == e.type && (e.addPoint = !0), !0 == e.addPoint && "column" !== e.type && drawPointShape(S, e.color, e.pointShape, a, t);}), !1 !== t.dataLabel && 1 === o) {var h = 0;e.forEach(function (e) {var n, s, d;n = [].concat(t.chartData.yAxisData.ranges[e.index]), s = n.pop(), d = n.shift();var c = e.data,p = getDataPoints(c, s, d, l, r, t, i, o);"column" === e.type ? (p = fixColumeData(p, r, x, h, i, t), drawPointText(p, e, i, a), h += 1) : drawPointText(p, e, i, a);});}return a.restore(), { xAxisPoints: l, calPoints: d, eachSpacing: r };}function drawToolTipBridge(e, t, i, a, o, n) {var l = e.extra.tooltip || {};l.horizentalLine && e.tooltip && 1 === a && ("line" == e.type || "area" == e.type || "column" == e.type || "candle" == e.type || "mix" == e.type) && drawToolTipHorizentalLine(e, t, i, o, n), i.save(), e._scrollDistance_ && 0 !== e._scrollDistance_ && !0 === e.enableScroll && i.translate(e._scrollDistance_, 0), e.tooltip && e.tooltip.textList && e.tooltip.textList.length && 1 === a && drawToolTip(e.tooltip.textList, e.tooltip.offset, e, t, i, o, n), i.restore();}function drawXAxis(e, t, i, a) {var o = Math.ceil;var n = t.chartData.xAxisData,l = n.xAxisPoints,r = n.startX,s = n.endX,d = n.eachSpacing;var h = "center";("line" == t.type || "area" == t.type) && (h = t.xAxis.boundaryGap);var x = t.height - t.area[2],c = t.area[0];if (t.enableScroll && t.xAxis.scrollShow) {var p = t.height - t.area[2] + i.xAxisHeight,g = s - r,y = d * (l.length - 1),f = 0;t._scrollDistance_ && (f = -t._scrollDistance_ * g / y), a.beginPath(), a.setLineCap("round"), a.setLineWidth(6 * t.pixelRatio), a.setStrokeStyle(t.xAxis.scrollBackgroundColor || "#EFEBEF"), a.moveTo(r, p), a.lineTo(s, p), a.stroke(), a.closePath(), a.beginPath(), a.setLineCap("round"), a.setLineWidth(6 * t.pixelRatio), a.setStrokeStyle(t.xAxis.scrollColor || "#A6A6A6"), a.moveTo(r + f, p), a.lineTo(r + f + g * g / y, p), a.stroke(), a.closePath(), a.setLineCap("butt");}if (a.save(), t._scrollDistance_ && 0 !== t._scrollDistance_ && a.translate(t._scrollDistance_, 0), !0 === t.xAxis.calibration && (a.setStrokeStyle(t.xAxis.gridColor || "#cccccc"), a.setLineCap("butt"), a.setLineWidth(1 * t.pixelRatio), l.forEach(function (e, i) {0 < i && (a.beginPath(), a.moveTo(e - d / 2, x), a.lineTo(e - d / 2, x + 3 * t.pixelRatio), a.closePath(), a.stroke());})), !0 !== t.xAxis.disableGrid && (a.setStrokeStyle(t.xAxis.gridColor || "#cccccc"), a.setLineCap("butt"), a.setLineWidth(1 * t.pixelRatio), "dash" == t.xAxis.gridType && a.setLineDash([t.xAxis.dashLength, t.xAxis.dashLength]), t.xAxis.gridEval = t.xAxis.gridEval || 1, l.forEach(function (e, i) {0 == i % t.xAxis.gridEval && (a.beginPath(), a.moveTo(e, x), a.lineTo(e, c), a.stroke());}), a.setLineDash([])), !0 !== t.xAxis.disabled) {var _n19 = e.length;t.xAxis.labelCount && (_n19 = t.xAxis.itemCount ? o(e.length / t.xAxis.itemCount * t.xAxis.labelCount) : t.xAxis.labelCount, _n19 -= 1);var _r8 = o(e.length / _n19),_s3 = [],_c = e.length;for (var _t22 = 0; _t22 < _c; _t22++) {0 == _t22 % _r8 ? _s3.push(e[_t22]) : _s3.push("");}_s3[_c - 1] = e[_c - 1];var u = t.xAxis.fontSize || i.fontSize;0 === i._xAxisTextAngle_ ? _s3.forEach(function (e, o) {var n = -measureText(e + "", u) / 2;"center" == h && (n += d / 2);var r = 0;t.xAxis.scrollShow && (r = 6 * t.pixelRatio), a.beginPath(), a.setFontSize(u), a.setFillStyle(t.xAxis.fontColor || "#666666"), a.fillText(e + "", l[o] + n, x + u + (i.xAxisHeight - r - u) / 2), a.closePath(), a.stroke();}) : _s3.forEach(function (e, o) {a.save(), a.beginPath(), a.setFontSize(u), a.setFillStyle(t.xAxis.fontColor || "#666666");var n = measureText(e + "", u),r = -n;"center" == h && (r += d / 2);var s = calRotateTranslate(l[o] + d / 2, x + u / 2 + 5, t.height),c = s.transX,p = s.transY;a.rotate(-1 * i._xAxisTextAngle_), a.translate(c, p), a.fillText(e + "", l[o] + r, x + u + 5), a.closePath(), a.stroke(), a.restore();});}a.restore(), t.xAxis.axisLine && (a.beginPath(), a.setStrokeStyle(t.xAxis.axisLineColor), a.setLineWidth(1 * t.pixelRatio), a.moveTo(r, t.height - t.area[2]), a.lineTo(s, t.height - t.area[2]), a.stroke());}function drawYAxisGrid(e, t, i, a) {if (!0 === t.yAxis.disableGrid) return;var o = t.height - t.area[0] - t.area[2],n = o / t.yAxis.splitNumber,l = t.area[3],r = t.chartData.xAxisData.xAxisPoints,s = t.chartData.xAxisData.eachSpacing,d = s * (r.length - 1),h = [];for (var _o23 = 0; _o23 < t.yAxis.splitNumber + 1; _o23++) {h.push(t.height - t.area[2] - n * _o23);}a.save(), t._scrollDistance_ && 0 !== t._scrollDistance_ && a.translate(t._scrollDistance_, 0), "dash" == t.yAxis.gridType && a.setLineDash([t.yAxis.dashLength, t.yAxis.dashLength]), a.setStrokeStyle(t.yAxis.gridColor), a.setLineWidth(1 * t.pixelRatio), h.forEach(function (e) {a.beginPath(), a.moveTo(l, e), a.lineTo(l + d, e), a.stroke();}), a.setLineDash([]), a.restore();}function drawYAxis(e, t, a, o) {if (!0 === t.yAxis.disabled) return;var i = t.height - t.area[0] - t.area[2],n = i / t.yAxis.splitNumber,l = t.area[3],r = t.width - t.area[1],s = t.height - t.area[2],d = s + a.xAxisHeight;t.xAxis.scrollShow && (d -= 3 * t.pixelRatio), t.xAxis.rotateLabel && (d = t.height - t.area[2] + 3), o.beginPath(), o.setFillStyle(t.background || "#ffffff"), 0 > t._scrollDistance_ && o.fillRect(0, 0, l, d), !0 == t.enableScroll && o.fillRect(r, 0, t.width, d), o.closePath(), o.stroke();var h = [];for (var _l9 = 0; _l9 <= t.yAxis.splitNumber; _l9++) {h.push(t.area[0] + n * _l9);}var x = t.area[3],c = t.width - t.area[1];var _loop3 = function _loop3(_n21, _l10) {if (_n21 = t.yAxis.data[_l10], !0 !== _n21.disabled) {var _e29 = t.chartData.yAxisData.rangesFormat[_l10],_i22 = _n21.fontSize || a.fontSize,_r9 = t.chartData.yAxisData.yAxisWidth[_l10];if (_e29.forEach(function (e, a) {var l = h[a] ? h[a] : s;o.beginPath(), o.setFontSize(_i22), o.setLineWidth(1 * t.pixelRatio), o.setStrokeStyle(_n21.axisLineColor || "#cccccc"), o.setFillStyle(_n21.fontColor || "#666666"), "left" == _r9.position ? (o.fillText(e + "", x - _r9.width, l + _i22 / 2), !0 == _n21.calibration && (o.moveTo(x, l), o.lineTo(x - 3 * t.pixelRatio, l))) : (o.fillText(e + "", c + 4 * t.pixelRatio, l + _i22 / 2), !0 == _n21.calibration && (o.moveTo(c, l), o.lineTo(c + 3 * t.pixelRatio, l))), o.closePath(), o.stroke();}), !1 !== _n21.axisLine && (o.beginPath(), o.setStrokeStyle(_n21.axisLineColor || "#cccccc"), o.setLineWidth(1 * t.pixelRatio), "left" == _r9.position ? (o.moveTo(x, t.height - t.area[2]), o.lineTo(x, t.area[0])) : (o.moveTo(c, t.height - t.area[2]), o.lineTo(c, t.area[0])), o.stroke()), t.yAxis.showTitle) {var _e30 = _n21.titleFontSize || a.fontSize,_i23 = _n21.title;o.beginPath(), o.setFontSize(_e30), o.setFillStyle(_n21.titleFontColor || "#666666"), "left" == _r9.position ? o.fillText(_i23, x - measureText(_i23, _e30) / 2, t.area[0] - 10 * t.pixelRatio) : o.fillText(_i23, c - measureText(_i23, _e30) / 2, t.area[0] - 10 * t.pixelRatio), o.closePath(), o.stroke();}"left" == _r9.position ? x -= _r9.width + t.yAxis.padding : c += _r9.width + t.yAxis.padding;}_n20 = _n21;};for (var _n20, _l10 = 0; _l10 < t.yAxis.data.length; _l10++) {_loop3(_n20, _l10);}}function drawLegend(e, t, i, a, o) {if (!1 === t.legend.show) return;var n = o.legendData,l = n.points,r = n.area,s = t.legend.padding,d = t.legend.fontSize,h = 15 * t.pixelRatio,x = 5 * t.pixelRatio,c = t.legend.itemGap,p = Math.max(t.legend.lineHeight * t.pixelRatio, d);a.beginPath(), a.setLineWidth(t.legend.borderWidth), a.setStrokeStyle(t.legend.borderColor), a.setFillStyle(t.legend.backgroundColor), a.moveTo(r.start.x, r.start.y), a.rect(r.start.x, r.start.y, r.width, r.height), a.closePath(), a.fill(), a.stroke(), l.forEach(function (e, o) {var l = 0,g = 0;l = n.widthArr[o], g = n.heightArr[o];var y = 0,f = 0;"top" == t.legend.position || "bottom" == t.legend.position ? (y = r.start.x + (r.width - l) / 2, f = r.start.y + s + o * p) : (l = 0 == o ? 0 : n.widthArr[o - 1], y = r.start.x + s + l, f = r.start.y + s + (r.height - g) / 2), a.setFontSize(i.fontSize);for (var _n22, _l11 = 0; _l11 < e.length; _l11++) {switch (_n22 = e[_l11], _n22.area = [0, 0, 0, 0], _n22.area[0] = y, _n22.area[1] = f, _n22.area[3] = f + p, a.beginPath(), a.setLineWidth(1 * t.pixelRatio), a.setStrokeStyle(_n22.show ? _n22.color : t.legend.hiddenColor), a.setFillStyle(_n22.show ? _n22.color : t.legend.hiddenColor), _n22.legendShape) {case "line":a.moveTo(y, f + .5 * p - 2 * t.pixelRatio), a.fillRect(y, f + .5 * p - 2 * t.pixelRatio, 15 * t.pixelRatio, 4 * t.pixelRatio);break;case "triangle":a.moveTo(y + 7.5 * t.pixelRatio, f + .5 * p - 5 * t.pixelRatio), a.lineTo(y + 2.5 * t.pixelRatio, f + .5 * p + 5 * t.pixelRatio), a.lineTo(y + 12.5 * t.pixelRatio, f + .5 * p + 5 * t.pixelRatio), a.lineTo(y + 7.5 * t.pixelRatio, f + .5 * p - 5 * t.pixelRatio);break;case "diamond":a.moveTo(y + 7.5 * t.pixelRatio, f + .5 * p - 5 * t.pixelRatio), a.lineTo(y + 2.5 * t.pixelRatio, f + .5 * p), a.lineTo(y + 7.5 * t.pixelRatio, f + .5 * p + 5 * t.pixelRatio), a.lineTo(y + 12.5 * t.pixelRatio, f + .5 * p), a.lineTo(y + 7.5 * t.pixelRatio, f + .5 * p - 5 * t.pixelRatio);break;case "circle":a.moveTo(y + 7.5 * t.pixelRatio, f + .5 * p), a.arc(y + 7.5 * t.pixelRatio, f + .5 * p, 5 * t.pixelRatio, 0, 2 * Math.PI);break;case "rect":a.moveTo(y, f + .5 * p - 5 * t.pixelRatio), a.fillRect(y, f + .5 * p - 5 * t.pixelRatio, 15 * t.pixelRatio, 10 * t.pixelRatio);break;default:a.moveTo(y, f + .5 * p - 5 * t.pixelRatio), a.fillRect(y, f + .5 * p - 5 * t.pixelRatio, 15 * t.pixelRatio, 10 * t.pixelRatio);}a.closePath(), a.fill(), a.stroke(), y += h + x;a.beginPath(), a.setFontSize(d), a.setFillStyle(_n22.show ? t.legend.fontColor : t.legend.hiddenColor), a.fillText(_n22.name, y, f + (.5 * p + .5 * d - 2)), a.closePath(), a.stroke(), "top" == t.legend.position || "bottom" == t.legend.position ? (y += measureText(_n22.name, d) + c, _n22.area[2] = y) : (_n22.area[2] = y + measureText(_n22.name, d) + c, y -= h + x, f += p);}});}function drawPieDataPoints(e, t, a, o) {var n = Math.PI,l = 4 < arguments.length && void 0 !== arguments[4] ? arguments[4] : 1,r = assign({}, { activeOpacity: .5, activeRadius: 10 * t.pixelRatio, offsetAngle: 0, labelWidth: 15 * t.pixelRatio, ringWidth: 0, border: !1, borderWidth: 2, borderColor: "#FFFFFF" }, t.extra.pie),s = { x: t.area[3] + (t.width - t.area[1] - t.area[3]) / 2, y: t.area[0] + (t.height - t.area[0] - t.area[2]) / 2 };0 == a.pieChartLinePadding && (a.pieChartLinePadding = r.activeRadius);var d = Math.min((t.width - t.area[1] - t.area[3]) / 2 - a.pieChartLinePadding - a.pieChartTextPadding - a._pieTextMaxLength_, (t.height - t.area[0] - t.area[2]) / 2 - a.pieChartLinePadding - a.pieChartTextPadding);e = getPieDataPoints(e, d, l);var h = r.activeRadius;if (e = e.map(function (e) {return e._start_ += r.offsetAngle * n / 180, e;}), e.forEach(function (e, i) {t.tooltip && t.tooltip.index == i && (o.beginPath(), o.setFillStyle(hexToRgb(e.color, t.extra.pie.activeOpacity || .5)), o.moveTo(s.x, s.y), o.arc(s.x, s.y, e._radius_ + h, e._start_, e._start_ + 2 * e._proportion_ * n), o.closePath(), o.fill()), o.beginPath(), o.setLineWidth(r.borderWidth * t.pixelRatio), o.lineJoin = "round", o.setStrokeStyle(r.borderColor), o.setFillStyle(e.color), o.moveTo(s.x, s.y), o.arc(s.x, s.y, e._radius_, e._start_, e._start_ + 2 * e._proportion_ * n), o.closePath(), o.fill(), !0 == r.border && o.stroke();}), "ring" === t.type) {var x = .6 * d;"number" == typeof t.extra.pie.ringWidth && 0 < t.extra.pie.ringWidth && (x = Math.max(0, d - t.extra.pie.ringWidth)), o.beginPath(), o.setFillStyle(t.background || "#ffffff"), o.moveTo(s.x, s.y), o.arc(s.x, s.y, x, 0, 2 * n), o.closePath(), o.fill();}if (!1 !== t.dataLabel && 1 === l) {for (var c = !1, p = 0, g = e.length; p < g; p++) {if (0 < e[p].data) {c = !0;break;}}c && drawPieText(e, t, a, o, d, s);}return 1 === l && "ring" === t.type && drawRingTitle(t, a, o, s), { center: s, radius: d, series: e };}function drawRoseDataPoints(e, t, a, o) {var n = Math.PI,l = 4 < arguments.length && void 0 !== arguments[4] ? arguments[4] : 1,r = assign({}, { type: "area", activeOpacity: .5, activeRadius: 10 * t.pixelRatio, offsetAngle: 0, labelWidth: 15 * t.pixelRatio, border: !1, borderWidth: 2, borderColor: "#FFFFFF" }, t.extra.rose);0 == a.pieChartLinePadding && (a.pieChartLinePadding = r.activeRadius);var s = { x: t.area[3] + (t.width - t.area[1] - t.area[3]) / 2, y: t.area[0] + (t.height - t.area[0] - t.area[2]) / 2 },d = Math.min((t.width - t.area[1] - t.area[3]) / 2 - a.pieChartLinePadding - a.pieChartTextPadding - a._pieTextMaxLength_, (t.height - t.area[0] - t.area[2]) / 2 - a.pieChartLinePadding - a.pieChartTextPadding),h = r.minRadius || .5 * d;e = getRoseDataPoints(e, r.type, h, d, l);var x = r.activeRadius;if (e = e.map(function (e) {return e._start_ += (r.offsetAngle || 0) * n / 180, e;}), e.forEach(function (e, i) {t.tooltip && t.tooltip.index == i && (o.beginPath(), o.setFillStyle(hexToRgb(e.color, r.activeOpacity || .5)), o.moveTo(s.x, s.y), o.arc(s.x, s.y, x + e._radius_, e._start_, e._start_ + 2 * e._rose_proportion_ * n), o.closePath(), o.fill()), o.beginPath(), o.setLineWidth(r.borderWidth * t.pixelRatio), o.lineJoin = "round", o.setStrokeStyle(r.borderColor), o.setFillStyle(e.color), o.moveTo(s.x, s.y), o.arc(s.x, s.y, e._radius_, e._start_, e._start_ + 2 * e._rose_proportion_ * n), o.closePath(), o.fill(), !0 == r.border && o.stroke();}), !1 !== t.dataLabel && 1 === l) {for (var c = !1, p = 0, g = e.length; p < g; p++) {if (0 < e[p].data) {c = !0;break;}}c && drawPieText(e, t, a, o, d, s);}return { center: s, radius: d, series: e };}function drawArcbarDataPoints(e, t, i, a) {var o = Math.PI,n = 4 < arguments.length && void 0 !== arguments[4] ? arguments[4] : 1,l = assign({}, { startAngle: .75, endAngle: .25, type: "default", width: 12 * t.pixelRatio, gap: 2 * t.pixelRatio }, t.extra.arcbar);e = getArcbarDataPoints(e, l, n);var r = l.center ? l.center : { x: t.width / 2, y: t.height / 2 };var s;l.radius ? s = l.radius : (s = Math.min(r.x, r.y), s -= 5 * t.pixelRatio, s -= l.width / 2);for (var _n23, d = 0; d < e.length; d++) {_n23 = e[d], a.setLineWidth(l.width), a.setStrokeStyle(l.backgroundColor || "#E9E9E9"), a.setLineCap("round"), a.beginPath(), "default" == l.type ? a.arc(r.x, r.y, s - (l.width + l.gap) * d, l.startAngle * o, l.endAngle * o, !1) : a.arc(r.x, r.y, s - (l.width + l.gap) * d, 0, 2 * o, !1), a.stroke(), a.setLineWidth(l.width), a.setStrokeStyle(_n23.color), a.setLineCap("round"), a.beginPath(), a.arc(r.x, r.y, s - (l.width + l.gap) * d, l.startAngle * o, _n23._proportion_ * o, !1), a.stroke();}return drawRingTitle(t, i, a, r), { center: r, radius: s, series: e };}function drawGaugeDataPoints(e, t, a, i, o) {var n = Math.PI,l = 5 < arguments.length && void 0 !== arguments[5] ? arguments[5] : 1,r = assign({}, { type: "default", startAngle: .75, endAngle: .25, width: 15, splitLine: { fixRadius: 0, splitNumber: 10, width: 15, color: "#FFFFFF", childNumber: 5, childWidth: 5 }, pointer: { width: 15, color: "auto" } }, a.extra.gauge);null == r.oldAngle && (r.oldAngle = r.startAngle), null == r.oldData && (r.oldData = 0), e = getGaugeAxisPoints(e, r.startAngle, r.endAngle);var s = { x: a.width / 2, y: a.height / 2 },d = Math.min(s.x, s.y);d -= 5 * a.pixelRatio, d -= r.width / 2;var h = d - r.width,x = 0;if ("progress" == r.type) {var c = d - 3 * r.width;o.beginPath();var _e31 = o.createLinearGradient(s.x, s.y - c, s.x, s.y + c);_e31.addColorStop("0", hexToRgb(t[0].color, .3)), _e31.addColorStop("1.0", hexToRgb("#FFFFFF", .1)), o.setFillStyle(_e31), o.arc(s.x, s.y, c, 0, 2 * n, !1), o.fill(), o.setLineWidth(r.width), o.setStrokeStyle(hexToRgb(t[0].color, .3)), o.setLineCap("round"), o.beginPath(), o.arc(s.x, s.y, h, r.startAngle * n, r.endAngle * n, !1), o.stroke(), x = r.startAngle - r.endAngle + 1;var _i24 = x / r.splitLine.splitNumber,p = x / r.splitLine.splitNumber / r.splitLine.childNumber,g = -d - .5 * r.width - r.splitLine.fixRadius,y = -d - r.width - r.splitLine.fixRadius + r.splitLine.width;o.save(), o.translate(s.x, s.y), o.rotate((r.startAngle - 1) * n);var f = r.splitLine.splitNumber * r.splitLine.childNumber + 1,u = t[0].data * l;for (var _e32 = 0; _e32 < f; _e32++) {o.beginPath(), u > _e32 / f ? o.setStrokeStyle(hexToRgb(t[0].color, 1)) : o.setStrokeStyle(hexToRgb(t[0].color, .3)), o.setLineWidth(3 * a.pixelRatio), o.moveTo(g, 0), o.lineTo(y, 0), o.stroke(), o.rotate(p * n);}o.restore(), t = getArcbarDataPoints(t, r, l), o.setLineWidth(r.width), o.setStrokeStyle(t[0].color), o.setLineCap("round"), o.beginPath(), o.arc(s.x, s.y, h, r.startAngle * n, t[0]._proportion_ * n, !1), o.stroke();var m = d - 2.5 * r.width;o.save(), o.translate(s.x, s.y), o.rotate((t[0]._proportion_ - 1) * n), o.beginPath(), o.setLineWidth(r.width / 3);var S = o.createLinearGradient(0, .6 * -m, 0, .6 * m);S.addColorStop("0", hexToRgb("#FFFFFF", 0)), S.addColorStop("0.5", hexToRgb(t[0].color, 1)), S.addColorStop("1.0", hexToRgb("#FFFFFF", 0)), o.setStrokeStyle(S), o.arc(0, 0, m, .85 * n, 1.15 * n, !1), o.stroke(), o.beginPath(), o.setLineWidth(1), o.setStrokeStyle(t[0].color), o.setFillStyle(t[0].color), o.moveTo(-m - r.width / 3 / 2, -4), o.lineTo(-m - r.width / 3 / 2 - 4, 0), o.lineTo(-m - r.width / 3 / 2, 4), o.lineTo(-m - r.width / 3 / 2, -4), o.stroke(), o.fill(), o.restore();} else {o.setLineWidth(r.width), o.setLineCap("butt");for (var _t23, _a11 = 0; _a11 < e.length; _a11++) {_t23 = e[_a11], o.beginPath(), o.setStrokeStyle(_t23.color), o.arc(s.x, s.y, d, _t23._startAngle_ * n, _t23._endAngle_ * n, !1), o.stroke();}o.save(), x = r.startAngle - r.endAngle + 1;var _c2 = x / r.splitLine.splitNumber,_p2 = x / r.splitLine.splitNumber / r.splitLine.childNumber,_g2 = -d - .5 * r.width - r.splitLine.fixRadius,_y = -d - .5 * r.width - r.splitLine.fixRadius + r.splitLine.width,_f = -d - .5 * r.width - r.splitLine.fixRadius + r.splitLine.childWidth;o.translate(s.x, s.y), o.rotate((r.startAngle - 1) * n);for (var _e33 = 0; _e33 < r.splitLine.splitNumber + 1; _e33++) {o.beginPath(), o.setStrokeStyle(r.splitLine.color), o.setLineWidth(2 * a.pixelRatio), o.moveTo(_g2, 0), o.lineTo(_y, 0), o.stroke(), o.rotate(_c2 * n);}o.restore(), o.save(), o.translate(s.x, s.y), o.rotate((r.startAngle - 1) * n);for (var _e34 = 0; _e34 < r.splitLine.splitNumber * r.splitLine.childNumber + 1; _e34++) {o.beginPath(), o.setStrokeStyle(r.splitLine.color), o.setLineWidth(1 * a.pixelRatio), o.moveTo(_g2, 0), o.lineTo(_f, 0), o.stroke(), o.rotate(_p2 * n);}o.restore(), t = getGaugeDataPoints(t, e, r, l);for (var _e35, _a12 = 0; _a12 < t.length; _a12++) {_e35 = t[_a12], o.save(), o.translate(s.x, s.y), o.rotate((_e35._proportion_ - 1) * n), o.beginPath(), o.setFillStyle(_e35.color), o.moveTo(r.pointer.width, 0), o.lineTo(0, -r.pointer.width / 2), o.lineTo(-h, 0), o.lineTo(0, r.pointer.width / 2), o.lineTo(r.pointer.width, 0), o.closePath(), o.fill(), o.beginPath(), o.setFillStyle("#FFFFFF"), o.arc(0, 0, r.pointer.width / 6, 0, 2 * n, !1), o.fill(), o.restore();}!1 !== a.dataLabel && drawGaugeLabel(r, d, s, a, i, o);}return drawRingTitle(a, i, o, s), 1 === l && "gauge" === a.type && (a.extra.gauge.oldAngle = t[0]._proportion_, a.extra.gauge.oldData = t[0].data), { center: s, radius: d, innerRadius: h, categories: e, totalAngle: x };}function drawRadarDataPoints(e, t, a, o) {var n = Math.cos,l = Math.sin,r = 4 < arguments.length && void 0 !== arguments[4] ? arguments[4] : 1,s = assign({}, { gridColor: "#cccccc", labelColor: "#666666", opacity: .2, gridCount: 3 }, t.extra.radar),d = getRadarCoordinateSeries(t.categories.length),h = { x: t.area[3] + (t.width - t.area[1] - t.area[3]) / 2, y: t.area[0] + (t.height - t.area[0] - t.area[2]) / 2 },x = Math.min(h.x - (getMaxTextListLength(t.categories) + a.radarLabelTextMargin), h.y - a.radarLabelTextMargin);x -= t.padding[1], o.beginPath(), o.setLineWidth(1 * t.pixelRatio), o.setStrokeStyle(s.gridColor), d.forEach(function (e) {var t = convertCoordinateOrigin(x * n(e), x * l(e), h);o.moveTo(h.x, h.y), o.lineTo(t.x, t.y);}), o.stroke(), o.closePath();for (var c = function c(e) {var i = {};o.beginPath(), o.setLineWidth(1 * t.pixelRatio), o.setStrokeStyle(s.gridColor), d.forEach(function (t, a) {var r = convertCoordinateOrigin(x / s.gridCount * e * n(t), x / s.gridCount * e * l(t), h);0 === a ? (i = r, o.moveTo(r.x, r.y)) : o.lineTo(r.x, r.y);}), o.lineTo(i.x, i.y), o.stroke(), o.closePath();}, p = 1; p <= s.gridCount; p++) {c(p);}var g = getRadarDataPoints(d, h, x, e, t, r);return g.forEach(function (e) {if (o.beginPath(), o.setFillStyle(hexToRgb(e.color, s.opacity)), e.data.forEach(function (e, t) {0 === t ? o.moveTo(e.position.x, e.position.y) : o.lineTo(e.position.x, e.position.y);}), o.closePath(), o.fill(), !1 !== t.dataPointShape) {var i = e.data.map(function (e) {return e.position;});drawPointShape(i, e.color, e.pointShape, o, t);}}), drawRadarLabel(d, x, h, t, a, o), { center: h, radius: x, angleList: d };}function normalInt(e, t, a) {a = 0 == a ? 1 : a;for (var o = [], n = 0; n < a; n++) {o[n] = Math.random();}return Math.floor(o.reduce(function (e, t) {return e + t;}) / a * (t - e)) + e;}function collisionNew(e, t, a, o) {var n = !1;for (var l = 0; l < t.length; l++) {if (t[l].area) if (!(e[3] < t[l].area[1] || e[0] > t[l].area[2] || e[1] > t[l].area[3] || e[2] < t[l].area[0])) {n = !0;break;} else if (0 > e[0] || 0 > e[1] || e[2] > a || e[3] > o) {n = !0;break;} else n = !1;}return n;}function getBoundingBox(e) {var t,a = {};a.xMin = 180, a.xMax = 0, a.yMin = 90, a.yMax = 0;for (var o, n = 0; n < e.length; n++) {o = e[n].geometry.coordinates;for (var l = 0; l < o.length; l++) {t = o[l], 1 == t.length && (t = t[0]);for (var r = 0; r < t.length; r++) {var s = t[r][0],d = t[r][1],h = { x: s, y: d };a.xMin = a.xMin < h.x ? a.xMin : h.x, a.xMax = a.xMax > h.x ? a.xMax : h.x, a.yMin = a.yMin < h.y ? a.yMin : h.y, a.yMax = a.yMax > h.y ? a.yMax : h.y;}}}return a;}function coordinateToPoint(e, t, i, a, o, n) {return { x: (t - i.xMin) * a + o, y: (i.yMax - e) * a + n };}function pointToCoordinate(e, t, i, a, o, n) {return { x: (t - o) / a + i.xMin, y: i.yMax - (e - n) / a };}function isRayIntersectsSegment(e, t, i) {if (t[1] == i[1]) return !1;if (t[1] > e[1] && i[1] > e[1]) return !1;if (t[1] < e[1] && i[1] < e[1]) return !1;if (t[1] == e[1] && i[1] > e[1]) return !1;if (i[1] == e[1] && t[1] > e[1]) return !1;if (t[0] < e[0] && i[1] < e[1]) return !1;var a = i[0] - (i[0] - t[0]) * (i[1] - e[1]) / (i[1] - t[1]);return !(a < e[0]);}function isPoiWithinPoly(e, t) {var i = 0;for (var a, o = 0; o < t.length; o++) {a = t[o][0], 1 == t.length && (a = t[o][0]);for (var _t24 = 0; _t24 < a.length - 1; _t24++) {var _o24 = a[_t24],n = a[_t24 + 1];isRayIntersectsSegment(e, _o24, n) && (i += 1);}}return !(1 != i % 2);}function drawMapDataPoints(e, t, a, o) {var n,l,r = Math.abs,s = assign({}, { border: !0, borderWidth: 1, borderColor: "#666666", fillOpacity: .6, activeBorderColor: "#f04864", activeFillColor: "#facc14", activeFillOpacity: 1 }, t.extra.map),d = e,h = getBoundingBox(d),x = t.width / r(h.xMax - h.xMin),c = t.height / r(h.yMax - h.yMin),p = x < c ? x : c,g = t.width / 2 - r(h.xMax - h.xMin) / 2 * p,y = t.height / 2 - r(h.yMax - h.yMin) / 2 * p;o.beginPath(), o.clearRect(0, 0, t.width, t.height), o.setFillStyle(t.background || "#FFFFFF"), o.rect(0, 0, t.width, t.height), o.fill();for (var f = 0; f < d.length; f++) {o.beginPath(), o.setLineWidth(s.borderWidth * t.pixelRatio), o.setStrokeStyle(s.borderColor), o.setFillStyle(hexToRgb(e[f].color, s.fillOpacity)), t.tooltip && t.tooltip.index == f && (o.setStrokeStyle(s.activeBorderColor), o.setFillStyle(hexToRgb(s.activeFillColor, s.activeFillOpacity)));for (var u = d[f].geometry.coordinates, m = 0; m < u.length; m++) {n = u[m], 1 == n.length && (n = n[0]);for (var S = 0; S < n.length; S++) {l = coordinateToPoint(n[S][1], n[S][0], h, p, g, y), 0 == S ? (o.beginPath(), o.moveTo(l.x, l.y)) : o.lineTo(l.x, l.y);}o.fill(), !0 == s.border && o.stroke();}if (!0 == t.dataLabel) {var T = d[f].properties.centroid;if (T) {l = coordinateToPoint(T[1], T[0], h, p, g, y);var _e36 = d[f].textSize || a.fontSize,_t25 = d[f].properties.name;o.beginPath(), o.setFontSize(_e36), o.setFillStyle(d[f].textColor || "#666666"), o.fillText(_t25, l.x - measureText(_t25, _e36) / 2, l.y + _e36 / 2), o.closePath(), o.stroke();}}}t.chartData.mapData = { bounds: h, scale: p, xoffset: g, yoffset: y }, drawToolTipBridge(t, a, o, 1), o.draw();}function getWordCloudPoint(e, t) {var a = e.series.sort(function (e, t) {return parseInt(t.textSize) - parseInt(e.textSize);});switch (t) {case "normal":for (var _t26 = 0; _t26 < a.length; _t26++) {var i = void 0,_o25 = void 0,n = void 0,l = a[_t26].name,r = a[_t26].textSize,s = measureText(l, r),d = 0;for (;;) {d++, i = normalInt(-e.width / 2, e.width / 2, 5) - s / 2, _o25 = normalInt(-e.height / 2, e.height / 2, 5) + r / 2, n = [i - 5 + e.width / 2, _o25 - 5 - r + e.height / 2, i + s + 5 + e.width / 2, _o25 + 5 + e.height / 2];var _t27 = collisionNew(n, a, e.width, e.height);if (!_t27) break;if (1e3 == d) {n = [-100, -100, -100, -100];break;}}a[_t26].area = n;}break;case "vertical":var o = function o() {return !!(.7 < Math.random());};;for (var _t28 = 0; _t28 < a.length; _t28++) {var _i25 = void 0,_n24 = void 0,_l12 = void 0,_r10 = void 0,_s4 = a[_t28].name,_d3 = a[_t28].textSize,h = measureText(_s4, _d3),x = o(),c = 0;for (;;) {c++;var _t29 = void 0;if (x ? (_i25 = normalInt(-e.width / 2, e.width / 2, 5) - h / 2, _n24 = normalInt(-e.height / 2, e.height / 2, 5) + _d3 / 2, _l12 = [_n24 - 5 - h + e.width / 2, -_i25 - 5 + e.height / 2, _n24 + 5 + e.width / 2, -_i25 + _d3 + 5 + e.height / 2], _r10 = [e.width - (e.width / 2 - e.height / 2) - (-_i25 + _d3 + 5 + e.height / 2) - 5, e.height / 2 - e.width / 2 + (_n24 - 5 - h + e.width / 2) - 5, e.width - (e.width / 2 - e.height / 2) - (-_i25 + _d3 + 5 + e.height / 2) + _d3, e.height / 2 - e.width / 2 + (_n24 - 5 - h + e.width / 2) + h + 5], _t29 = collisionNew(_r10, a, e.height, e.width)) : (_i25 = normalInt(-e.width / 2, e.width / 2, 5) - h / 2, _n24 = normalInt(-e.height / 2, e.height / 2, 5) + _d3 / 2, _l12 = [_i25 - 5 + e.width / 2, _n24 - 5 - _d3 + e.height / 2, _i25 + h + 5 + e.width / 2, _n24 + 5 + e.height / 2], _t29 = collisionNew(_l12, a, e.width, e.height)), !_t29) break;if (1e3 == c) {_l12 = [-1e3, -1e3, -1e3, -1e3];break;}}x ? (a[_t28].area = _r10, a[_t28].areav = _l12) : a[_t28].area = _l12, a[_t28].rotate = x;};}return a;}function drawWordCloudDataPoints(e, t, i, a) {var o = 4 < arguments.length && arguments[4] !== void 0 ? arguments[4] : 1,n = assign({}, { type: "normal", autoColors: !0 }, t.extra.word);a.beginPath(), a.setFillStyle(t.background || "#FFFFFF"), a.rect(0, 0, t.width, t.height), a.fill(), a.save();var l = t.chartData.wordCloudData;a.translate(t.width / 2, t.height / 2);for (var _n25 = 0; _n25 < l.length; _n25++) {a.save(), l[_n25].rotate && a.rotate(90 * Math.PI / 180);var _e37 = l[_n25].name,_i26 = l[_n25].textSize,r = measureText(_e37, _i26);a.beginPath(), a.setStrokeStyle(l[_n25].color), a.setFillStyle(l[_n25].color), a.setFontSize(_i26), l[_n25].rotate ? 0 < l[_n25].areav[0] && (t.tooltip ? t.tooltip.index == _n25 ? a.strokeText(_e37, (l[_n25].areav[0] + 5 - t.width / 2) * o - r * (1 - o) / 2, (l[_n25].areav[1] + 5 + _i26 - t.height / 2) * o) : a.fillText(_e37, (l[_n25].areav[0] + 5 - t.width / 2) * o - r * (1 - o) / 2, (l[_n25].areav[1] + 5 + _i26 - t.height / 2) * o) : a.fillText(_e37, (l[_n25].areav[0] + 5 - t.width / 2) * o - r * (1 - o) / 2, (l[_n25].areav[1] + 5 + _i26 - t.height / 2) * o)) : 0 < l[_n25].area[0] && (t.tooltip ? t.tooltip.index == _n25 ? a.strokeText(_e37, (l[_n25].area[0] + 5 - t.width / 2) * o - r * (1 - o) / 2, (l[_n25].area[1] + 5 + _i26 - t.height / 2) * o) : a.fillText(_e37, (l[_n25].area[0] + 5 - t.width / 2) * o - r * (1 - o) / 2, (l[_n25].area[1] + 5 + _i26 - t.height / 2) * o) : a.fillText(_e37, (l[_n25].area[0] + 5 - t.width / 2) * o - r * (1 - o) / 2, (l[_n25].area[1] + 5 + _i26 - t.height / 2) * o)), a.stroke(), a.restore();}a.restore();}function drawFunnelDataPoints(e, t, i, a) {var o = 4 < arguments.length && void 0 !== arguments[4] ? arguments[4] : 1,n = assign({}, { activeWidth: 10, activeOpacity: .3, border: !1, borderWidth: 2, borderColor: "#FFFFFF", fillOpacity: 1, labelAlign: "right" }, t.extra.funnel),l = (t.height - t.area[0] - t.area[2]) / e.length,r = { x: t.area[3] + (t.width - t.area[1] - t.area[3]) / 2, y: t.height - t.area[2] },s = n.activeWidth,d = Math.min((t.width - t.area[1] - t.area[3]) / 2 - s, (t.height - t.area[0] - t.area[2]) / 2 - s);e = getFunnelDataPoints(e, d, o), a.save(), a.translate(r.x, r.y);for (var _o26 = 0; _o26 < e.length; _o26++) {0 == _o26 ? (t.tooltip && t.tooltip.index == _o26 && (a.beginPath(), a.setFillStyle(hexToRgb(e[_o26].color, n.activeOpacity)), a.moveTo(-s, 0), a.lineTo(-e[_o26].radius - s, -l), a.lineTo(e[_o26].radius + s, -l), a.lineTo(s, 0), a.lineTo(-s, 0), a.closePath(), a.fill()), e[_o26].funnelArea = [r.x - e[_o26].radius, r.y - l, r.x + e[_o26].radius, r.y], a.beginPath(), a.setLineWidth(n.borderWidth * t.pixelRatio), a.setStrokeStyle(n.borderColor), a.setFillStyle(hexToRgb(e[_o26].color, n.fillOpacity)), a.moveTo(0, 0), a.lineTo(-e[_o26].radius, -l), a.lineTo(e[_o26].radius, -l), a.lineTo(0, 0), a.closePath(), a.fill(), !0 == n.border && a.stroke()) : (t.tooltip && t.tooltip.index == _o26 && (a.beginPath(), a.setFillStyle(hexToRgb(e[_o26].color, n.activeOpacity)), a.moveTo(0, 0), a.lineTo(-e[_o26 - 1].radius - s, 0), a.lineTo(-e[_o26].radius - s, -l), a.lineTo(e[_o26].radius + s, -l), a.lineTo(e[_o26 - 1].radius + s, 0), a.lineTo(0, 0), a.closePath(), a.fill()), e[_o26].funnelArea = [r.x - e[_o26].radius, r.y - l * (_o26 + 1), r.x + e[_o26].radius, r.y - l * _o26], a.beginPath(), a.setLineWidth(n.borderWidth * t.pixelRatio), a.setStrokeStyle(n.borderColor), a.setFillStyle(hexToRgb(e[_o26].color, n.fillOpacity)), a.moveTo(0, 0), a.lineTo(-e[_o26 - 1].radius, 0), a.lineTo(-e[_o26].radius, -l), a.lineTo(e[_o26].radius, -l), a.lineTo(e[_o26 - 1].radius, 0), a.lineTo(0, 0), a.closePath(), a.fill(), !0 == n.border && a.stroke()), a.translate(0, -l);}return a.restore(), !1 !== t.dataLabel && 1 === o && drawFunnelText(e, t, a, l, n.labelAlign, s, r), { center: r, radius: d, series: e };}function drawFunnelText(e, t, a, o, n, l, r) {var s = Math.PI;for (var d = 0; d < e.length; d++) {var i = void 0,h = void 0,x = void 0,c = void 0,p = e[d],g = p.format ? p.format(+p._proportion_.toFixed(2)) : util.toFixed(100 * p._proportion_) + "%";"right" == n ? (i = 0 == d ? (p.funnelArea[2] + r.x) / 2 : (p.funnelArea[2] + e[d - 1].funnelArea[2]) / 2, h = i + 2 * l, x = p.funnelArea[1] + o / 2, c = p.textSize || t.fontSize, a.setLineWidth(1 * t.pixelRatio), a.setStrokeStyle(p.color), a.setFillStyle(p.color), a.beginPath(), a.moveTo(i, x), a.lineTo(h, x), a.stroke(), a.closePath(), a.beginPath(), a.moveTo(h, x), a.arc(h, x, 2, 0, 2 * s), a.closePath(), a.fill(), a.beginPath(), a.setFontSize(c), a.setFillStyle(p.textColor || "#666666"), a.fillText(g, h + 5, x + c / 2 - 2), a.closePath(), a.stroke(), a.closePath()) : (i = 0 == d ? (p.funnelArea[0] + r.x) / 2 : (p.funnelArea[0] + e[d - 1].funnelArea[0]) / 2, h = i - 2 * l, x = p.funnelArea[1] + o / 2, c = p.textSize || t.fontSize, a.setLineWidth(1 * t.pixelRatio), a.setStrokeStyle(p.color), a.setFillStyle(p.color), a.beginPath(), a.moveTo(i, x), a.lineTo(h, x), a.stroke(), a.closePath(), a.beginPath(), a.moveTo(h, x), a.arc(h, x, 2, 0, 2 * s), a.closePath(), a.fill(), a.beginPath(), a.setFontSize(c), a.setFillStyle(p.textColor || "#666666"), a.fillText(g, h - 5 - measureText(g), x + c / 2 - 2), a.closePath(), a.stroke(), a.closePath());}}function drawCanvas(e, t) {t.draw();}var Timing = { easeIn: function easeIn(e) {return Math.pow(e, 3);}, easeOut: function easeOut(e) {return Math.pow(e - 1, 3) + 1;}, easeInOut: function easeInOut(e) {var t = Math.pow;return 1 > (e /= .5) ? .5 * t(e, 3) : .5 * (t(e - 2, 3) + 2);}, linear: function linear(e) {return e;} };function Animation(e) {this.isStop = !1, e.duration = "undefined" == typeof e.duration ? 1e3 : e.duration, e.timing = e.timing || "linear";var t = function () {return "undefined" == typeof setTimeout ? "undefined" == typeof requestAnimationFrame ? function (e) {e(null);} : requestAnimationFrame : function (e, t) {setTimeout(function () {var t = +new Date();e(t);}, t);};}(),i = null,_a13 = function a(o) {if (null === o || !0 === this.isStop) return e.onProcess && e.onProcess(1), void (e.onAnimationFinish && e.onAnimationFinish());if (null === i && (i = o), o - i < e.duration) {var n = (o - i) / e.duration,l = Timing[e.timing];n = l(n), e.onProcess && e.onProcess(n), t(_a13, 17);} else e.onProcess && e.onProcess(1), e.onAnimationFinish && e.onAnimationFinish();};_a13 = _a13.bind(this), t(_a13, 17);}Animation.prototype.stop = function () {this.isStop = !0;};function drawCharts(e, t, a, i) {var o = this,n = t.series,l = t.categories;n = fillSeries(n, t, a);var r = t.animation ? t.duration : 0;o.animationInstance && o.animationInstance.stop();var s = null;if ("candle" == e) {var _e38 = assign({}, t.extra.candle.average);_e38.show ? (s = calCandleMA(_e38.day, _e38.name, _e38.color, n[0].data), s = fillSeries(s, t, a), t.seriesMA = s) : t.seriesMA ? s = t.seriesMA = fillSeries(t.seriesMA, t, a) : s = n;} else s = n;t._series_ = n = filterSeries(n), t.area = [,,,,];for (var _o27 = 0; 4 > _o27; _o27++) {t.area[_o27] = t.padding[_o27];}var d = calLegendData(s, t, a, t.chartData),h = d.area.wholeHeight,x = d.area.wholeWidth;switch (t.legend.position) {case "top":t.area[0] += h;break;case "bottom":t.area[2] += h;break;case "left":t.area[3] += x;break;case "right":t.area[1] += x;}var c = {},p = 0;if ("line" === t.type || "column" === t.type || "area" === t.type || "mix" === t.type || "candle" === t.type) {if (c = calYAxisData(n, t, a), p = c.yAxisWidth, t.yAxis.showTitle) {var _e40 = 0;for (var _o29 = 0; _o29 < t.yAxis.data.length; _o29++) {_e40 = Math.max(_e40, t.yAxis.data[_o29].titleFontSize ? t.yAxis.data[_o29].titleFontSize : a.fontSize);}t.area[0] += (_e40 + 6) * t.pixelRatio;}var _e39 = 0,_o28 = 0;for (var _a14 = 0; _a14 < p.length; _a14++) {"left" == p[_a14].position ? (t.area[3] += 0 < _o28 ? p[_a14].width + t.yAxis.padding : p[_a14].width, _o28 += 1) : (t.area[1] += 0 < _e39 ? p[_a14].width + t.yAxis.padding : p[_a14].width, _e39 += 1);}} else a.yAxisWidth = p;if (t.chartData.yAxisData = c, t.categories && t.categories.length) {t.chartData.xAxisData = getXAxisPoints(t.categories, t, a);var _e41 = calCategoriesData(t.categories, t, a, t.chartData.xAxisData.eachSpacing),_i27 = _e41.xAxisHeight,_o30 = _e41.angle;a.xAxisHeight = _i27, a._xAxisTextAngle_ = _o30, t.area[2] += _i27, t.chartData.categoriesData = _e41;} else if ("line" === t.type || "area" === t.type || "points" === t.type) {t.chartData.xAxisData = calXAxisData(n, t, a), l = t.chartData.xAxisData.rangesFormat;var _e42 = calCategoriesData(l, t, a, t.chartData.xAxisData.eachSpacing),_i28 = _e42.xAxisHeight,_o31 = _e42.angle;a.xAxisHeight = _i28, a._xAxisTextAngle_ = _o31, t.area[2] += _i28, t.chartData.categoriesData = _e42;} else t.chartData.xAxisData = { xAxisPoints: [] };if (t.enableScroll && "right" == t.xAxis.scrollAlign && void 0 === t._scrollDistance_) {var _e43 = 0,_i29 = t.chartData.xAxisData.xAxisPoints,_a15 = t.chartData.xAxisData.startX,_n26 = t.chartData.xAxisData.endX,_l13 = t.chartData.xAxisData.eachSpacing,_r11 = _l13 * (_i29.length - 1);_e43 = _n26 - _a15 - _r11, o.scrollOption = { currentOffset: _e43, startTouchX: _e43, distance: 0, lastMoveTime: 0 }, t._scrollDistance_ = _e43;}switch (("pie" === e || "ring" === e || "rose" === e) && (a._pieTextMaxLength_ = !1 === t.dataLabel ? 0 : getPieTextMaxLength(s)), e) {case "word":var _d4 = assign({}, { type: "normal", autoColors: !0 }, t.extra.word);(!0 == t.updateData || null == t.updateData) && (t.chartData.wordCloudData = getWordCloudPoint(t, _d4.type)), this.animationInstance = new Animation({ timing: "easeInOut", duration: r, onProcess: function onProcess(e) {i.clearRect(0, 0, t.width, t.height), t.rotate && contextRotate(i, t), drawWordCloudDataPoints(n, t, a, i, e), drawCanvas(t, i);}, onAnimationFinish: function onAnimationFinish() {o.event.trigger("renderComplete");} });break;case "map":i.clearRect(0, 0, t.width, t.height), drawMapDataPoints(n, t, a, i);break;case "funnel":this.animationInstance = new Animation({ timing: "easeInOut", duration: r, onProcess: function onProcess(e) {i.clearRect(0, 0, t.width, t.height), t.rotate && contextRotate(i, t), t.chartData.funnelData = drawFunnelDataPoints(n, t, a, i, e), drawLegend(t.series, t, a, i, t.chartData), drawToolTipBridge(t, a, i, e), drawCanvas(t, i);}, onAnimationFinish: function onAnimationFinish() {o.event.trigger("renderComplete");} });break;case "line":this.animationInstance = new Animation({ timing: "easeIn", duration: r, onProcess: function onProcess(e) {i.clearRect(0, 0, t.width, t.height), t.rotate && contextRotate(i, t), drawYAxisGrid(l, t, a, i), drawXAxis(l, t, a, i);var o = drawLineDataPoints(n, t, a, i, e),r = o.xAxisPoints,s = o.calPoints,d = o.eachSpacing;t.chartData.xAxisPoints = r, t.chartData.calPoints = s, t.chartData.eachSpacing = d, drawYAxis(n, t, a, i), !1 !== t.enableMarkLine && 1 === e && drawMarkLine(t, a, i), drawLegend(t.series, t, a, i, t.chartData), drawToolTipBridge(t, a, i, e, d, r), drawCanvas(t, i);}, onAnimationFinish: function onAnimationFinish() {o.event.trigger("renderComplete");} });break;case "mix":this.animationInstance = new Animation({ timing: "easeIn", duration: r, onProcess: function onProcess(e) {i.clearRect(0, 0, t.width, t.height), t.rotate && contextRotate(i, t), drawYAxisGrid(l, t, a, i), drawXAxis(l, t, a, i);var o = drawMixDataPoints(n, t, a, i, e),r = o.xAxisPoints,s = o.calPoints,d = o.eachSpacing;t.chartData.xAxisPoints = r, t.chartData.calPoints = s, t.chartData.eachSpacing = d, drawYAxis(n, t, a, i), !1 !== t.enableMarkLine && 1 === e && drawMarkLine(t, a, i), drawLegend(t.series, t, a, i, t.chartData), drawToolTipBridge(t, a, i, e, d, r), drawCanvas(t, i);}, onAnimationFinish: function onAnimationFinish() {o.event.trigger("renderComplete");} });break;case "column":this.animationInstance = new Animation({ timing: "easeIn", duration: r, onProcess: function onProcess(e) {i.clearRect(0, 0, t.width, t.height), t.rotate && contextRotate(i, t), drawYAxisGrid(l, t, a, i), drawXAxis(l, t, a, i);var o = drawColumnDataPoints(n, t, a, i, e),r = o.xAxisPoints,s = o.calPoints,d = o.eachSpacing;t.chartData.xAxisPoints = r, t.chartData.calPoints = s, t.chartData.eachSpacing = d, drawYAxis(n, t, a, i), !1 !== t.enableMarkLine && 1 === e && drawMarkLine(t, a, i), drawLegend(t.series, t, a, i, t.chartData), drawToolTipBridge(t, a, i, e, d, r), drawCanvas(t, i);}, onAnimationFinish: function onAnimationFinish() {o.event.trigger("renderComplete");} });break;case "area":this.animationInstance = new Animation({ timing: "easeIn", duration: r, onProcess: function onProcess(e) {i.clearRect(0, 0, t.width, t.height), t.rotate && contextRotate(i, t), drawYAxisGrid(l, t, a, i), drawXAxis(l, t, a, i);var o = drawAreaDataPoints(n, t, a, i, e),r = o.xAxisPoints,s = o.calPoints,d = o.eachSpacing;t.chartData.xAxisPoints = r, t.chartData.calPoints = s, t.chartData.eachSpacing = d, drawYAxis(n, t, a, i), !1 !== t.enableMarkLine && 1 === e && drawMarkLine(t, a, i), drawLegend(t.series, t, a, i, t.chartData), drawToolTipBridge(t, a, i, e, d, r), drawCanvas(t, i);}, onAnimationFinish: function onAnimationFinish() {o.event.trigger("renderComplete");} });break;case "ring":case "pie":this.animationInstance = new Animation({ timing: "easeInOut", duration: r, onProcess: function onProcess(e) {i.clearRect(0, 0, t.width, t.height), t.rotate && contextRotate(i, t), t.chartData.pieData = drawPieDataPoints(n, t, a, i, e), drawLegend(t.series, t, a, i, t.chartData), drawToolTipBridge(t, a, i, e), drawCanvas(t, i);}, onAnimationFinish: function onAnimationFinish() {o.event.trigger("renderComplete");} });break;case "rose":this.animationInstance = new Animation({ timing: "easeInOut", duration: r, onProcess: function onProcess(e) {i.clearRect(0, 0, t.width, t.height), t.rotate && contextRotate(i, t), t.chartData.pieData = drawRoseDataPoints(n, t, a, i, e), drawLegend(t.series, t, a, i, t.chartData), drawToolTipBridge(t, a, i, e), drawCanvas(t, i);}, onAnimationFinish: function onAnimationFinish() {o.event.trigger("renderComplete");} });break;case "radar":this.animationInstance = new Animation({ timing: "easeInOut", duration: r, onProcess: function onProcess(e) {i.clearRect(0, 0, t.width, t.height), t.rotate && contextRotate(i, t), t.chartData.radarData = drawRadarDataPoints(n, t, a, i, e), drawLegend(t.series, t, a, i, t.chartData), drawToolTipBridge(t, a, i, e), drawCanvas(t, i);}, onAnimationFinish: function onAnimationFinish() {o.event.trigger("renderComplete");} });break;case "arcbar":this.animationInstance = new Animation({ timing: "easeInOut", duration: r, onProcess: function onProcess(e) {i.clearRect(0, 0, t.width, t.height), t.rotate && contextRotate(i, t), t.chartData.arcbarData = drawArcbarDataPoints(n, t, a, i, e), drawCanvas(t, i);}, onAnimationFinish: function onAnimationFinish() {o.event.trigger("renderComplete");} });break;case "gauge":this.animationInstance = new Animation({ timing: "easeInOut", duration: r, onProcess: function onProcess(e) {i.clearRect(0, 0, t.width, t.height), t.rotate && contextRotate(i, t), t.chartData.gaugeData = drawGaugeDataPoints(l, n, t, a, i, e), drawCanvas(t, i);}, onAnimationFinish: function onAnimationFinish() {o.event.trigger("renderComplete");} });break;case "candle":this.animationInstance = new Animation({ timing: "easeIn", duration: r, onProcess: function onProcess(e) {i.clearRect(0, 0, t.width, t.height), t.rotate && contextRotate(i, t), drawYAxisGrid(l, t, a, i), drawXAxis(l, t, a, i);var o = drawCandleDataPoints(n, s, t, a, i, e),r = o.xAxisPoints,d = o.calPoints,h = o.eachSpacing;t.chartData.xAxisPoints = r, t.chartData.calPoints = d, t.chartData.eachSpacing = h, drawYAxis(n, t, a, i), !1 !== t.enableMarkLine && 1 === e && drawMarkLine(t, a, i), s ? drawLegend(s, t, a, i, t.chartData) : drawLegend(t.series, t, a, i, t.chartData), drawToolTipBridge(t, a, i, e, h, r), drawCanvas(t, i);}, onAnimationFinish: function onAnimationFinish() {o.event.trigger("renderComplete");} });}}function Event() {this.events = {};}Event.prototype.addEventListener = function (e, t) {this.events[e] = this.events[e] || [], this.events[e].push(t);}, Event.prototype.trigger = function () {for (var e = arguments.length, t = Array(e), i = 0; i < e; i++) {t[i] = arguments[i];}var a = t[0],o = t.slice(1);!this.events[a] || this.events[a].forEach(function (e) {try {e.apply(null, o);} catch (t) {console.error(t);}});};var Charts = function Charts(e) {e.pixelRatio = e.pixelRatio ? e.pixelRatio : 1, e.fontSize = e.fontSize ? e.fontSize * e.pixelRatio : 13 * e.pixelRatio, e.title = assign({}, e.title), e.subtitle = assign({}, e.subtitle), e.duration = e.duration ? e.duration : 1e3, e.yAxis = assign({}, { data: [], showTitle: !1, disabled: !1, disableGrid: !1, splitNumber: 5, gridType: "solid", dashLength: 4 * e.pixelRatio, gridColor: "#cccccc", padding: 10, fontColor: "#666666" }, e.yAxis), e.yAxis.dashLength *= e.pixelRatio, e.yAxis.padding *= e.pixelRatio, e.xAxis = assign({}, { rotateLabel: !1, type: "calibration", gridType: "solid", dashLength: 4, scrollAlign: "left", boundaryGap: "center", axisLine: !0, axisLineColor: "#cccccc" }, e.xAxis), e.xAxis.dashLength *= e.pixelRatio, e.legend = assign({}, { show: !0, position: "bottom", float: "center", backgroundColor: "rgba(0,0,0,0)", borderColor: "rgba(0,0,0,0)", borderWidth: 0, padding: 5, margin: 5, itemGap: 10, fontSize: e.fontSize, lineHeight: e.fontSize, fontColor: "#333333", format: {}, hiddenColor: "#CECECE" }, e.legend), e.legend.borderWidth *= e.pixelRatio, e.legend.itemGap *= e.pixelRatio, e.legend.padding *= e.pixelRatio, e.legend.margin *= e.pixelRatio, e.extra = assign({}, e.extra), e.rotate = !!e.rotate, e.animation = !!e.animation, e.rotate = !!e.rotate;var t = JSON.parse(JSON.stringify(config));if (t.colors = e.colors ? e.colors : t.colors, t.yAxisTitleWidth = !0 !== e.yAxis.disabled && e.yAxis.title ? t.yAxisTitleWidth : 0, ("pie" == e.type || "ring" == e.type) && (t.pieChartLinePadding = !1 === e.dataLabel ? 0 : e.extra.pie.labelWidth * e.pixelRatio || t.pieChartLinePadding * e.pixelRatio), "rose" == e.type && (t.pieChartLinePadding = !1 === e.dataLabel ? 0 : e.extra.rose.labelWidth * e.pixelRatio || t.pieChartLinePadding * e.pixelRatio), t.pieChartTextPadding = !1 === e.dataLabel ? 0 : t.pieChartTextPadding * e.pixelRatio, t.yAxisSplit = e.yAxis.splitNumber ? e.yAxis.splitNumber : config.yAxisSplit, t.rotate = e.rotate, e.rotate) {var _t30 = e.width,i = e.height;e.width = i, e.height = _t30;}e.padding = e.padding ? e.padding : t.padding;for (var _t31 = 0; 4 > _t31; _t31++) {e.padding[_t31] *= e.pixelRatio;}t.yAxisWidth = config.yAxisWidth * e.pixelRatio, t.xAxisHeight = config.xAxisHeight * e.pixelRatio, e.enableScroll && e.xAxis.scrollShow && (t.xAxisHeight += 6 * e.pixelRatio), t.xAxisLineHeight = config.xAxisLineHeight * e.pixelRatio, t.fontSize = e.fontSize, t.titleFontSize = config.titleFontSize * e.pixelRatio, t.subtitleFontSize = config.subtitleFontSize * e.pixelRatio, t.toolTipPadding = config.toolTipPadding * e.pixelRatio, t.toolTipLineHeight = config.toolTipLineHeight * e.pixelRatio, t.columePadding = config.columePadding * e.pixelRatio, e.$this = e.$this ? e.$this : this, this.context = uni.createCanvasContext(e.canvasId, e.$this), e.chartData = {}, this.event = new Event(), this.scrollOption = { currentOffset: 0, startTouchX: 0, distance: 0, lastMoveTime: 0 }, this.opts = e, this.config = t, drawCharts.call(this, e.type, e, t, this.context);};Charts.prototype.updateData = function () {var e = 0 < arguments.length && arguments[0] !== void 0 ? arguments[0] : {};this.opts = assign({}, this.opts, e), this.opts.updateData = !0;var t = e.scrollPosition || "current";switch (t) {case "current":this.opts._scrollDistance_ = this.scrollOption.currentOffset;break;case "left":this.opts._scrollDistance_ = 0, this.scrollOption = { currentOffset: 0, startTouchX: 0, distance: 0, lastMoveTime: 0 };break;case "right":var _e44 = calYAxisData(this.opts.series, this.opts, this.config),i = _e44.yAxisWidth;this.config.yAxisWidth = i;var a = 0,o = getXAxisPoints(this.opts.categories, this.opts, this.config),n = o.xAxisPoints,l = o.startX,r = o.endX,s = o.eachSpacing,d = s * (n.length - 1);a = r - l - d, this.scrollOption = { currentOffset: a, startTouchX: a, distance: 0, lastMoveTime: 0 }, this.opts._scrollDistance_ = a;}drawCharts.call(this, this.opts.type, this.opts, this.config, this.context);}, Charts.prototype.zoom = function () {var e = Math.round,t = 0 < arguments.length && void 0 !== arguments[0] ? arguments[0] : this.opts.xAxis.itemCount;if (!0 !== this.opts.enableScroll) return void console.log("\u8BF7\u542F\u7528\u6EDA\u52A8\u6761\u540E\u4F7F\u7528\uFF01");var i = e(Math.abs(this.scrollOption.currentOffset) / this.opts.chartData.eachSpacing) + e(this.opts.xAxis.itemCount / 2);this.opts.animation = !1, this.opts.xAxis.itemCount = t.itemCount;var a = calYAxisData(this.opts.series, this.opts, this.config),o = a.yAxisWidth;this.config.yAxisWidth = o;var n = 0,l = getXAxisPoints(this.opts.categories, this.opts, this.config),r = l.xAxisPoints,s = l.startX,d = l.endX,h = l.eachSpacing,x = d - s,c = x - h * (r.length - 1);n = x / 2 - h * i, 0 < n && (n = 0), n < c && (n = c), this.scrollOption = { currentOffset: n, startTouchX: n, distance: 0, lastMoveTime: 0 }, this.opts._scrollDistance_ = n, drawCharts.call(this, this.opts.type, this.opts, this.config, this.context);}, Charts.prototype.stopAnimation = function () {this.animationInstance && this.animationInstance.stop();}, Charts.prototype.addEventListener = function (e, t) {this.event.addEventListener(e, t);}, Charts.prototype.getCurrentDataIndex = function (t) {var e = null;if (e = t.changedTouches ? t.changedTouches[0] : t.mp.changedTouches[0], e) {var i = getTouches(e, this.opts, t);return "pie" === this.opts.type || "ring" === this.opts.type || "rose" === this.opts.type ? findPieChartCurrentIndex({ x: i.x, y: i.y }, this.opts.chartData.pieData) : "radar" === this.opts.type ? findRadarChartCurrentIndex({ x: i.x, y: i.y }, this.opts.chartData.radarData, this.opts.categories.length) : "funnel" === this.opts.type ? findFunnelChartCurrentIndex({ x: i.x, y: i.y }, this.opts.chartData.funnelData) : "map" === this.opts.type ? findMapChartCurrentIndex({ x: i.x, y: i.y }, this.opts) : "word" === this.opts.type ? findWordChartCurrentIndex({ x: i.x, y: i.y }, this.opts.chartData.wordCloudData) : findCurrentIndex({ x: i.x, y: i.y }, this.opts.chartData.calPoints, this.opts, this.config, Math.abs(this.scrollOption.currentOffset));}return -1;}, Charts.prototype.getLegendDataIndex = function (t) {var e = null;if (e = t.changedTouches ? t.changedTouches[0] : t.mp.changedTouches[0], e) {var i = getTouches(e, this.opts, t);return findLegendIndex({ x: i.x, y: i.y }, this.opts.chartData.legendData);}return -1;}, Charts.prototype.touchLegend = function (t) {var e = 1 < arguments.length && void 0 !== arguments[1] ? arguments[1] : {},i = null;if (i = t.changedTouches ? t.changedTouches[0] : t.mp.changedTouches[0], i) {var a = getTouches(i, this.opts, t),o = this.getLegendDataIndex(t);0 <= o && (this.opts.series[o].show = !this.opts.series[o].show, this.opts.animation = !!e.animation, this.opts._scrollDistance_ = this.scrollOption.currentOffset, drawCharts.call(this, this.opts.type, this.opts, this.config, this.context));}}, Charts.prototype.showToolTip = function (t) {var e = 1 < arguments.length && arguments[1] !== void 0 ? arguments[1] : {},i = null;i = t.changedTouches ? t.changedTouches[0] : t.mp.changedTouches[0], i || console.log("touchError");var a = getTouches(i, this.opts, t),o = this.scrollOption.currentOffset,n = assign({}, this.opts, { _scrollDistance_: o, animation: !1 });if ("line" === this.opts.type || "area" === this.opts.type || "column" === this.opts.type) {var l = this.getCurrentDataIndex(t);if (-1 < l) {var r = getSeriesDataItem(this.opts.series, l);if (0 !== r.length) {var s = getToolTipData(r, this.opts.chartData.calPoints, l, this.opts.categories, e),d = s.textList,h = s.offset;h.y = a.y, n.tooltip = { textList: d, offset: h, option: e, index: l };}}drawCharts.call(this, n.type, n, this.config, this.context);}if ("mix" === this.opts.type) {var l = this.getCurrentDataIndex(t);if (-1 < l) {var o = this.scrollOption.currentOffset,n = assign({}, this.opts, { _scrollDistance_: o, animation: !1 }),r = getSeriesDataItem(this.opts.series, l);if (0 !== r.length) {var x = getMixToolTipData(r, this.opts.chartData.calPoints, l, this.opts.categories, e),d = x.textList,h = x.offset;h.y = a.y, n.tooltip = { textList: d, offset: h, option: e, index: l };}}drawCharts.call(this, n.type, n, this.config, this.context);}if ("candle" === this.opts.type) {var l = this.getCurrentDataIndex(t);if (-1 < l) {var o = this.scrollOption.currentOffset,n = assign({}, this.opts, { _scrollDistance_: o, animation: !1 }),r = getSeriesDataItem(this.opts.series, l);if (0 !== r.length) {var s = getCandleToolTipData(this.opts.series[0].data, r, this.opts.chartData.calPoints, l, this.opts.categories, this.opts.extra.candle, e),d = s.textList,h = s.offset;h.y = a.y, n.tooltip = { textList: d, offset: h, option: e, index: l };}}drawCharts.call(this, n.type, n, this.config, this.context);}if ("pie" === this.opts.type || "ring" === this.opts.type || "rose" === this.opts.type || "funnel" === this.opts.type) {var l = this.getCurrentDataIndex(t);if (-1 < l) {var o = this.scrollOption.currentOffset,n = assign({}, this.opts, { _scrollDistance_: o, animation: !1 }),r = this.opts._series_[l],d = [{ text: e.format ? e.format(r) : r.name + ": " + r.data, color: r.color }],h = { x: a.x, y: a.y };n.tooltip = { textList: d, offset: h, option: e, index: l };}drawCharts.call(this, n.type, n, this.config, this.context);}if ("map" === this.opts.type || "word" === this.opts.type) {var l = this.getCurrentDataIndex(t);if (-1 < l) {var o = this.scrollOption.currentOffset,n = assign({}, this.opts, { _scrollDistance_: o, animation: !1 }),r = this.opts._series_[l],d = [{ text: e.format ? e.format(r) : r.properties.name, color: r.color }],h = { x: a.x, y: a.y };n.tooltip = { textList: d, offset: h, option: e, index: l };}n.updateData = !1, drawCharts.call(this, n.type, n, this.config, this.context);}if ("radar" === this.opts.type) {var l = this.getCurrentDataIndex(t);if (-1 < l) {var o = this.scrollOption.currentOffset,n = assign({}, this.opts, { _scrollDistance_: o, animation: !1 }),r = getSeriesDataItem(this.opts.series, l);if (0 !== r.length) {var d = r.map(function (t) {return { text: e.format ? e.format(t) : t.name + ": " + t.data, color: t.color };}),h = { x: a.x, y: a.y };n.tooltip = { textList: d, offset: h, option: e, index: l };}}drawCharts.call(this, n.type, n, this.config, this.context);}}, Charts.prototype.translate = function (e) {this.scrollOption = { currentOffset: e, startTouchX: e, distance: 0, lastMoveTime: 0 };var t = assign({}, this.opts, { _scrollDistance_: e, animation: !1 });drawCharts.call(this, this.opts.type, t, this.config, this.context);}, Charts.prototype.scrollStart = function (t) {var e = null;e = t.changedTouches ? t.changedTouches[0] : t.mp.changedTouches[0];var i = getTouches(e, this.opts, t);e && !0 === this.opts.enableScroll && (this.scrollOption.startTouchX = i.x);}, Charts.prototype.scroll = function (t) {0 === this.scrollOption.lastMoveTime && (this.scrollOption.lastMoveTime = Date.now());var e = this.opts.extra.touchMoveLimit || 20,i = Date.now(),a = i - this.scrollOption.lastMoveTime;if (!(a < Math.floor(1e3 / e))) {this.scrollOption.lastMoveTime = i;var o = null;if (o = t.changedTouches ? t.changedTouches[0] : t.mp.changedTouches[0], o && !0 === this.opts.enableScroll) {var n,l = getTouches(o, this.opts, t);n = l.x - this.scrollOption.startTouchX;var r = this.scrollOption.currentOffset,s = calValidDistance(this, r + n, this.opts.chartData, this.config, this.opts);this.scrollOption.distance = n = s - r;var d = assign({}, this.opts, { _scrollDistance_: r + n, animation: !1 });return drawCharts.call(this, d.type, d, this.config, this.context), r + n;}}}, Charts.prototype.scrollEnd = function () {if (!0 === this.opts.enableScroll) {var e = this.scrollOption,t = e.currentOffset,i = e.distance;this.scrollOption.currentOffset = t + i, this.scrollOption.distance = 0;}},  true && "object" == typeof module.exports && (module.exports = Charts);
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! ./node_modules/@dcloudio/uni-mp-weixin/dist/index.js */ 1)["default"]))

/***/ })

}]);
//# sourceMappingURL=../../.sourcemap/mp-weixin/common/vendor.js.map