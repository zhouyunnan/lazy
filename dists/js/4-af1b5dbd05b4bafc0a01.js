(window.webpackJsonp=window.webpackJsonp||[]).push([[4],{53:function(t,i,e){},66:function(t,i,e){"use strict";var n=e(53);e.n(n).a},77:function(t,i,e){"use strict";e.r(i);var n=function(){var t=this,i=t.$createElement,e=t._self._c||i;return e("div",[e("el-drawer",{attrs:{title:t.xiangxixx.out_trade_no,visible:t.drawer},on:{"update:visible":function(i){t.drawer=i}}},[t._t("default",["quxiao"==t.xiangxixx.tz?e("el-alert",{attrs:{title:"订单已取消",type:"warning","show-icon":"",closable:!1}}):"0"!=t.xiangxixx.wanchengtime?e("el-alert",{attrs:{title:"订单已经配送",type:"success","show-icon":"",closable:!1}}):"0"==t.xiangxixx.paisongtime?e("el-alert",{attrs:{title:"待取件",type:"warning","show-icon":"",closable:!1}}):"0"!=t.xiangxixx.paisongtime&&"0"==t.xiangxixx.wanchengtime?e("el-alert",{attrs:{title:"待配送",type:"warning","show-icon":"",closable:!1}}):t._e(),t._v(" "),e("div",{staticClass:"content_"},[null!=t.xiangxixx.quhuohao?e("el-divider",{attrs:{"content-position":"left"}},[t._v("取货号")]):t._e(),t._v(" "),e("span",[t._v(t._s(t.xiangxixx.quhuohao))]),t._v(" "),null!=t.xiangxixx.huowumingcheng?e("el-divider",{attrs:{"content-position":"left"}},[t._v("货物名称")]):t._e(),t._v(" "),e("span",[t._v(t._s(t.xiangxixx.huowumingcheng))]),t._v(" "),null!=t.xiangxixx.kuaididaxiao?e("el-divider",{attrs:{"content-position":"left"}},[t._v("快递大小")]):t._e(),t._v(" "),e("span",[t._v(t._s(t.xiangxixx.kuaididaxiao))]),t._v(" "),null!=t.xiangxixx.kuaidigongsi?e("el-divider",{attrs:{"content-position":"left"}},[t._v("快递公司")]):t._e(),t._v(" "),e("span",[t._v(t._s(t.xiangxixx.kuaidigongsi))]),t._v(" "),null!=t.xiangxixx.quhuodidian?e("el-divider",{attrs:{"content-position":"left"}},[t._v("取货地点")]):t._e(),t._v(" "),e("span",[t._v(t._s(t.xiangxixx.quhuodidian))]),t._v(" "),null!=t.xiangxixx.qujianshijian?e("el-divider",{attrs:{"content-position":"left"}},[t._v("取件时间")]):t._e(),t._v(" "),e("span",[t._v(t._s(t.xiangxixx.qujianshijian))]),t._v(" "),null!=t.xiangxixx.shangloufuwu?e("el-divider",{attrs:{"content-position":"left"}},[t._v("上楼服务")]):t._e(),t._v(" "),e("span",[t._v(t._s(t.xiangxixx.shangloufuwu))]),t._v(" "),null!=t.xiangxixx.songdashijian?e("el-divider",{attrs:{"content-position":"left"}},[t._v("期望送达时间")]):t._e(),t._v(" "),e("span",[t._v(t._s(t.xiangxixx.songdashijian))]),t._v(" "),null!=t.xiangxixx.tebiebeizhu?e("el-divider",{attrs:{"content-position":"left"}},[t._v("特别备注")]):t._e(),t._v(" "),e("span",[t._v(t._s(t.xiangxixx.tebiebeizhu))]),t._v(" "),null!=t.xiangxixx.qujian?e("el-divider",{attrs:{"content-position":"left"}},[t._v("取件员")]):t._e(),t._v(" "),e("span",[t._v(t._s(t.xiangxixx.qujian))]),t._v(" "),null!=t.xiangxixx.wancheng?e("el-divider",{attrs:{"content-position":"left"}},[t._v("派送员")]):t._e(),t._v(" "),e("span",[t._v(t._s(t.xiangxixx.wancheng))])],1)])],2),t._v(" "),e("div",{staticClass:"page"},[e("div",{staticClass:"page_name"},[t._v("历史订单")]),t._v(" "),e("div",{staticClass:"infolist_tab"},[e("el-table",{staticStyle:{width:"100%"},attrs:{data:t.showdata,stripe:"",height:"600"}},[e("el-table-column",{attrs:{prop:"out_trade_no",label:"订单编号",width:"200"}}),t._v(" "),e("el-table-column",{attrs:{prop:"shouhuoren",label:"收件人",width:"140"}}),t._v(" "),e("el-table-column",{attrs:{prop:"lianxidianhua",label:"电话",width:"180"}}),t._v(" "),e("el-table-column",{attrs:{prop:"shouhuodizhi",label:"地址",width:"270"}}),t._v(" "),e("el-table-column",{attrs:{prop:"createtime",label:"下单时间",sortable:"",width:"120"}}),t._v(" "),e("el-table-column",{attrs:{prop:"paisongtime",label:"取件时间",sortable:"",width:"120"}}),t._v(" "),e("el-table-column",{attrs:{prop:"wanchengtime",label:"完成时间",sortable:"",width:"160"}}),t._v(" "),e("el-table-column",{attrs:{prop:"tz",label:"订单状态",sortable:"",width:"160"}}),t._v(" "),e("el-table-column",{attrs:{label:"操作"},scopedSlots:t._u([{key:"default",fn:function(i){return[e("el-button",{attrs:{type:"text",icon:"el-icon-tickets",size:"small"},on:{click:function(e){return t.find(i.row)}}},[t._v("查看")]),t._v(" "),e("el-button",{staticClass:"qudiao",attrs:{type:"text",icon:"el-icon-delete",size:"small"},on:{click:function(e){return t.dele(i.row)}}},[t._v("删除")])]}}])})],1)],1),t._v(" "),e("div",{staticClass:"info_page"},[e("el-pagination",{attrs:{background:"",layout:"prev, pager, next","page-size":t.pagesize,total:t.count},on:{"current-change":t.changgeyema}})],1)])],1)};n._withStripped=!0;var a={data:function(){return{tableData:[],count:1,pagesize:10,current_page:1,ysdata:[],showdata:[],drawer:!1,xiangxixx:""}},created:function(){this.getAll()},computed:{},watch:{current_page:function(){this.getAll()},ysdata:function(){for(var t=this.ysdata,i=new Array,e=0;e<t.length;e++){var n=new Object;for(var a in t[e])"createtime"==a||"wanchengtime"==a||"paisongtime"==a?0!=t[e][a]?n[a]=this.time(t[e][a],2):n[a]="0":n[a]=t[e][a];i.push(n)}this.tableData=i,this.showdata=this.tableData}},methods:{find:function(t){this.xiangxixx=Object.create({}),this.getqujianyuan(t),this.drawer=!0},time:function(t,i){var e=new Date(1e3*parseInt(t)),n=e.getFullYear(),a=e.getMonth()+1,s=e.getDate(),l=e.getHours(),o=e.getMinutes();e.getSeconds();return"1"==i?n+"-"+a+"-"+s+" "+l+":"+o:a+"-"+s+" "+l+":"+o},getAll:function(){var t=this;this.$http.post("/index.php/home/Dingdan/geralldd",this.$qs.stringify({p:this.current_page,pagesize:this.pagesize})).then((function(i){var e=i.data;e.result&&(t.ysdata=e.lists,t.count=parseInt(e.count))})).catch((function(){t.$message.error("网络错误")}))},changgeyema:function(t){this.current_page=t},getqujianyuan:function(t){var i=this;this.$http.post("/index.php/home/Dingdan/ddpsxx",this.$qs.stringify({id:t.id})).then((function(e){i.xiangxixx=t;for(var n=e.data.lists,a=0;a<n.length;a++)"qujian"==n[a].type&&(i.xiangxixx.qujian=n[a].use),"wancheng"==n[a].type&&(i.xiangxixx.wancheng=n[a].use)})).catch((function(){}))},dele:function(t){var i=this;t.id;this.$confirm("此操作将永久删除该订单, 是否继续?","提示",{confirmButtonText:"确定",cancelButtonText:"取消",type:"warning"}).then((function(){i.$http.post("/index.php/home/Dingdan/dele_dd",i.$qs.stringify({id:t.id})).then((function(t){t.data.result?(i.$notify({title:"成功",message:"已删除",type:"success"}),i.getAll()):i.$notify.error({title:"警告",message:"操作失败"})})).catch((function(){i.$notify.error({title:"警告",message:"网络错误"})}))})).catch((function(){}))}}},s=(e(66),e(2)),l=Object(s.a)(a,n,[],!1,null,"6eec8170",null);l.options.__file="src/views/Dingdan/order.vue";i.default=l.exports}}]);
//# sourceMappingURL=4-af1b5dbd05b4bafc0a01.js.map