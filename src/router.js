import Vue from "vue"
import Router from 'vue-router'
import NProgress from 'nprogress'
import 'nprogress/nprogress.css'
import instance from './config'
Vue.use(Router)

//定义请求
Vue.prototype.$http = instance.axios;

//消除重复路由导致的报错
const originalPush = Router.prototype.push
Router.prototype.push = function push(location, onResolve, onReject) {
  if (onResolve || onReject) return originalPush.call(this, location, onResolve, onReject)
  return originalPush.call(this, location).catch(err => err)
}

let router = new Router({
  routes: [
    //系统功能页面
    {

      path: '/',
      name: 'home',
      component: () => import('./views/Home/home.vue'),
      children: [
        {
          path: '/sheup_yingye',
          name: 'sheup_yingye',
          component: () => import('./views/Shezhi/yingye.vue'),
        },
        {
          path: '/sheup_tongzhi',
          name: 'sheup_tongzhi',
          component: () => import('./views/Shezhi/tongzhi.vue'),
        },
        {
          path: '/sheup_paisong',
          name: 'sheup_paisong',
          component: () => import('./views/Shezhi/paisongyuan.vue'),
        },
        {
          path: '/sheup_biaodan',
          name: 'sheup_biaodan',
          component: () => import('./views/Shezhi/biaodan.vue'),
        },
      ],
      //是否需要登陆授权
      meta: { requiresAuth: true }
    },
    //登陆
    {
      path: '/login',
      name: 'login',
      component: () => import('./views/Login/login.vue'),
    },

    //404
    {
      path: '*',
      name: 'nofound',
      component: () => import('./views/Public/nofound.vue'),
    },
  ]
});


//验证是否登陆函数
let Verification_login = function (to, from, next) {
  instance.axios.get(
    "/index.php/home/login/Api_Verification")
    .then(response => {
      let re = response.data;
      if (re.result) {
        next();
      } else {
        next({
          path: '/login',
          query: { redirect: to.fullPath }
        })
      }
    })
    .catch(() => {
      next({
        path: '/login',
        query: { redirect: to.fullPath }
      })
    });
}

router.beforeEach((to, from, next) => {
  NProgress.start()
  if (to.matched.some(record => record.meta.requiresAuth)) {
    Verification_login(to, from, next);
  } else {
    next();
  }
})
router.afterEach(() => {
  NProgress.done();
});




export default router;
