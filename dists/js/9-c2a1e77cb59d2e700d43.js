(window.webpackJsonp=window.webpackJsonp||[]).push([[9],{48:function(t,e,n){},59:function(t,e,n){"use strict";var i=n(48);n.n(i).a},72:function(t,e,n){"use strict";n.r(e);var i=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",[n("el-dialog",{staticClass:"dx",attrs:{title:"短信提醒限制",visible:t.centerDialogVisible,width:"500px",center:""},on:{"update:visible":function(e){t.centerDialogVisible=e}}},[n("div",{staticClass:"txbox"},[n("p",[t._v("1条/分钟: 一分钟内最多接收1条")]),t._v(" "),n("p",[t._v("5条/小时：一个小时不会超过5条")]),t._v(" "),n("p",[t._v("50条/日：一天不会超过50条")])])]),t._v(" "),n("div",{staticClass:"page_name"},[t._v("订单接收设置")]),t._v(" "),n("div",{staticClass:"page_msg"},[t._v("注：你可以任选接收方式，至少得选一个")]),t._v(" "),n("div",{staticClass:"tait"},[n("div",[t._v("\n      短信提醒\n      "),n("span",{on:{click:function(e){t.centerDialogVisible=!0}}},[t._v("(慎用，点击查看限制)")])]),t._v(" "),"true"==t.jieshou?n("span",{staticStyle:{color:"#67C23A","margin-left":"20px","text-decoration":"underline"}},[t._v("启用中...")]):n("span",{staticStyle:{color:"#909399","margin-left":"20px","text-decoration":"underline"}},[t._v("已停用")]),t._v(" "),n("el-button",{attrs:{type:"primary",icon:"el-icon-setting",size:"mini"},on:{click:function(e){return t.changePhoneTZ()}}},[t._v(t._s(t.phoneTZmsg))])],1),t._v(" "),n("div",{staticClass:"phone"},[n("el-table",{staticStyle:{width:"100%"},attrs:{data:t.tableData,"show-header":!1}},[n("el-table-column",{attrs:{label:"日期"},scopedSlots:t._u([{key:"default",fn:function(e){return[t._v(t._s(e.row.phone))]}}])}),t._v(" "),n("el-table-column",{attrs:{label:"操作"},scopedSlots:t._u([{key:"default",fn:function(e){return[n("el-button",{staticClass:"qudiao",attrs:{type:"text",icon:"el-icon-edit",size:"small"},on:{click:function(n){return t.changePhone(e.$index,e.row)}}},[t._v("编辑")])]}}])})],1)],1),t._v(" "),n("div",{staticClass:"tait"},[t._m(0),t._v(" "),"true"==t.emaintz?n("span",{staticStyle:{color:"#67C23A","margin-left":"20px","text-decoration":"underline"}},[t._v("启用中...")]):n("span",{staticStyle:{color:"#909399","margin-left":"20px","text-decoration":"underline"}},[t._v("已停用")]),t._v(" "),n("el-button",{attrs:{type:"primary",icon:"el-icon-setting",size:"mini"},on:{click:function(e){return t.changeemailTZ()}}},[t._v(t._s(t.emaintzTZmsg))]),t._v(" "),n("span",{directives:[{name:"show",rawName:"v-show",value:t.tableData2.length<2,expression:"tableData2.length < 2"}]},[n("el-button",{staticStyle:{"margin-right":"10px"},attrs:{type:"primary",icon:"el-icon-plus",size:"mini"},on:{click:function(e){return t.addemail()}}})],1)],1),t._v(" "),n("div",{staticClass:"phone"},[n("el-table",{staticStyle:{width:"100%"},attrs:{data:t.tableData2,"show-header":!1}},[n("el-table-column",{attrs:{label:"日期"},scopedSlots:t._u([{key:"default",fn:function(e){return[t._v(t._s(e.row.email))]}}])}),t._v(" "),n("el-table-column",{attrs:{label:"操作"},scopedSlots:t._u([{key:"default",fn:function(e){return[n("el-button",{staticClass:"qudiao",attrs:{type:"text",icon:"el-icon-delete",size:"small"},on:{click:function(n){return t.deleteemail(e.row.id)}}},[t._v("删除")])]}}])})],1)],1)],1)};i._withStripped=!0;var a={data:function(){return{tableData:[],tableData2:[],jieshou:"",phoneTZmsg:"",emaintz:"",emaintzTZmsg:"",centerDialogVisible:!1}},created:function(){this.findphone(),this.findman(),this.findemai()},watch:{jieshou:function(){"true"==this.jieshou?this.phoneTZmsg="关闭":this.phoneTZmsg="开启"},emaintz:function(){"true"==this.emaintz?this.emaintzTZmsg="关闭":this.emaintzTZmsg="开启"}},methods:{findphone:function(){var t=this;this.$http.post("/index.php/home/Run/findphone",{}).then((function(e){var n=e.data;n.result?(t.tableData=[{phone:n.content.phone}],t.jieshou=n.content.jieshou):t.$notify.error({title:"警告",message:"数据获取失败"})})).catch((function(){}))},changePhone:function(){var t=this;this.$prompt("请输入手机号","提示",{confirmButtonText:"确定",cancelButtonText:"取消",inputPattern:/^1[3456789]\d{9}$/,inputErrorMessage:"手机格式不正确"}).then((function(e){var n=e.value;t.$http.post("/index.php/home/Run/setphone",t.$qs.stringify({phone:n})).then((function(e){var n=e.data;n.result?(t.$notify({title:"成功",message:"设置成功",type:"success"}),t.tableData[0].phone=n.content):t.$notify.error({title:"警告",message:n.msg})})).catch((function(){}))})).catch((function(){}))},changePhoneTZ:function(){var t,e=this;t="true"==this.jieshou?"false":"true",this.$http.post("/index.php/home/Run/setphone",this.$qs.stringify({jieshou:t})).then((function(t){var n=t.data;n.result?(e.$notify({title:"成功",message:"设置成功",type:"success"}),e.jieshou=n.content):e.$notify.error({title:"警告",message:n.msg})})).catch((function(){}))},findman:function(){var t=this;this.$http.post("/index.php/home/Run/fin",{}).then((function(e){var n=e.data;n.result?t.emaintz=n.content.youxiangtongzhi:t.$notify.error({title:"警告",message:"数据获取失败"})})).catch((function(){}))},changeemailTZ:function(){var t,e=this;t="true"==this.emaintz?"false":"true",this.$http.post("/index.php/home/Run/set",this.$qs.stringify({youxiangtongzhi:t})).then((function(n){var i=n.data;i.result?(e.$notify({title:"成功",message:"设置成功",type:"success"}),e.emaintz=t):e.$notify.error({title:"警告",message:i.msg})})).catch((function(){}))},addemail:function(){var t=this;this.$prompt("请输入邮箱","提示",{confirmButtonText:"确定",cancelButtonText:"取消",inputPattern:/[\w!#$%&'*+/=?^_`{|}~-]+(?:\.[\w!#$%&'*+/=?^_`{|}~-]+)*@(?:[\w](?:[\w-]*[\w])?\.)+[\w](?:[\w-]*[\w])?/,inputErrorMessage:"邮箱格式不正确"}).then((function(e){var n=e.value;t.$http.post("/index.php/home/Run/addemail",t.$qs.stringify({email:n})).then((function(e){var n=e.data;n.result?(t.$notify({title:"成功",message:"设置成功",type:"success"}),t.findemai()):t.$notify.error({title:"警告",message:n.msg})})).catch((function(){}))})).catch((function(){}))},findemai:function(){var t=this;this.$http.post("/index.php/home/Run/findemail",{}).then((function(e){var n=e.data;n.result?t.tableData2=n.lists:t.tableData2=[]})).catch((function(){}))},deleteemail:function(t){var e=this;this.$http.post("/index.php/home/Run/delemail",this.$qs.stringify({id:t})).then((function(t){var n=t.data;n.result?(e.$notify({title:"成功",message:"设置成功",type:"success"}),e.findemai()):e.$notify.error({title:"警告",message:n.msg})})).catch((function(){}))}}},s=(n(59),n(2)),o=Object(s.a)(a,i,[function(){var t=this.$createElement,e=this._self._c||t;return e("div",[this._v("\n      邮件提醒\n      "),e("span",[this._v("(接收条数无限制，可设置2个，建议使用163邮箱，并且把加入白名单，防止遗漏提醒)")])])}],!1,null,"bc914306",null);o.options.__file="src/views/Shezhi/tongzhi.vue";e.default=o.exports}}]);
//# sourceMappingURL=9-c2a1e77cb59d2e700d43.js.map