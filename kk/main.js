import Vue from 'vue'
import App from './App'

Vue.config.productionTip = false
Vue.prototype.myconfig =  {
	"url":"https://api.doudianwang.com/lazy/",
	"imgurl":"https://api.doudianwang.com/admin",
	isnull(val){
		if(val == undefined || val == "" || val == null || val == 'undefined'){
			return true;
		}else{
			return false;
		}
	}
	
};

App.mpType = 'app'

const app = new Vue({
    ...App
})
app.$mount()
