<template>
  <div>
      
    <el-drawer :title="xiangxixx.out_trade_no" :visible.sync="drawer">
      <slot>
        <el-alert
          title="订单已取消"
          type="warning"
          show-icon
          :closable="false"
          v-if="xiangxixx.tz == 'quxiao'"
        ></el-alert>
        <el-alert
          title="订单已经配送"
          type="success"
          show-icon
          :closable="false"
          v-else-if="xiangxixx.wanchengtime != '0'"
        ></el-alert>
        <el-alert
          title="待取件"
          type="warning"
          show-icon
          :closable="false"
          v-else-if="xiangxixx.paisongtime == '0'"
        ></el-alert>
        <el-alert
          title="待配送"
          type="warning"
          show-icon
          :closable="false"
          v-else-if="xiangxixx.paisongtime != '0' && xiangxixx.wanchengtime == '0'"
        ></el-alert>
        <div class="content_">
          <el-divider content-position="left" v-if="xiangxixx.quhuohao != undefined ">取货号</el-divider>
          <span>{{xiangxixx.quhuohao}}</span>
          <el-divider content-position="left" v-if="xiangxixx.huowumingcheng != undefined ">货物名称</el-divider>
          <span>{{xiangxixx.huowumingcheng}}</span>
          <el-divider content-position="left" v-if="xiangxixx.kuaididaxiao != undefined  ">快递大小</el-divider>
          <span>{{xiangxixx.kuaididaxiao}}</span>
          <el-divider content-position="left" v-if="xiangxixx.kuaidigongsi != undefined ">快递公司</el-divider>
          <span>{{xiangxixx.kuaidigongsi}}</span>
          <el-divider content-position="left" v-if="xiangxixx.quhuodidian  != undefined ">取货地点</el-divider>
          <span>{{xiangxixx.quhuodidian}}</span>
          <el-divider content-position="left" v-if="xiangxixx.qujianshijian != undefined ">取件时间</el-divider>
          <span>{{xiangxixx.qujianshijian}}</span>
          <el-divider content-position="left" v-if="xiangxixx.shangloufuwu != undefined ">上楼服务</el-divider>
          <span>{{xiangxixx.shangloufuwu}}</span>
          <el-divider content-position="left" v-if="xiangxixx.songdashijian != undefined ">期望送达时间</el-divider>
          <span>{{xiangxixx.songdashijian}}</span>
          <el-divider content-position="left" v-if="xiangxixx.tebiebeizhu != undefined ">特别备注</el-divider>
          <span>{{xiangxixx.tebiebeizhu}}</span>

          <el-divider content-position="left" v-if="xiangxixx.qujian != undefined ">取件员</el-divider>
          <span>{{xiangxixx.qujian}}</span>

          <el-divider content-position="left" v-if="xiangxixx.wancheng != undefined ">派送员</el-divider>
          <span>{{xiangxixx.wancheng}}</span>
        </div>
      </slot>
    </el-drawer>
    <div class="page">
      <div class="page_name">历史订单</div>
      <div class="infolist_tab">
        <el-table :data="showdata" stripe height="600" style="width: 100%">
          <el-table-column prop="out_trade_no" label="订单编号" width="200"></el-table-column>
          <el-table-column prop="shouhuoren" label="收件人" width="140"></el-table-column>
          <el-table-column prop="lianxidianhua" label="电话" width="180"></el-table-column>
          <el-table-column prop="shouhuodizhi" label="地址" width="270"></el-table-column>
          <el-table-column prop="createtime" label="下单时间" sortable width="120"></el-table-column>
          <el-table-column prop="paisongtime" label="取件时间" sortable width="120"></el-table-column>
          <el-table-column prop="wanchengtime" label="完成时间" sortable width="160"></el-table-column>
          <el-table-column prop="tz" label="订单状态" sortable width="160"></el-table-column>
          <el-table-column label="操作">
            <template slot-scope="scope">
              <el-button type="text" icon="el-icon-tickets" size="small" @click="find(scope.row)">查看</el-button>
              <el-button
                type="text"
                class="qudiao"
                icon="el-icon-delete"
                size="small"
                @click="dele(scope.row)"
              >删除</el-button>
            </template>
          </el-table-column>
        </el-table>
      </div>
      <div class="info_page">
        <el-pagination
          background
          layout="prev, pager, next"
          :page-size="pagesize"
          @current-change="changgeyema"
          :total="count"
        ></el-pagination>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      tableData: [],
      count: 1,
      pagesize:10,
      current_page: 1,
      
      ysdata: [],
      showdata: [],
      drawer: false,
      xiangxixx: ""
    };
  },
  created() {
    this.getAll();
  },
  computed: {},
  watch: {
    current_page() {
      this.getAll();
    },
    ysdata() {
      let dd = this.ysdata;
      let new_da = new Array();
      for (let i = 0; i < dd.length; i++) {
        let new_obj = new Object();
        for (let key in dd[i]) {
          if (
            key == "createtime" ||
            key == "wanchengtime" ||
            key == "paisongtime"
          ) {
            if (dd[i][key] != 0) {
              new_obj[key] = this.time(dd[i][key], 2);
            } else {
              new_obj[key] = "0";
            }
          } else {
            new_obj[key] = dd[i][key];
          }
        }
        new_da.push(new_obj);
      }
      this.tableData = new_da;
      this.showdata = this.tableData;
    },
  },
  
  methods: {
    find(val) {
      this.xiangxixx = Object.create({});
      this.getqujianyuan(val);
      this.drawer = true;
    },
    time(val, n) {
      var time = new Date(parseInt(val) * 1000);
      var y = time.getFullYear(); //getFullYear方法以四位数字返回年份
      var M = time.getMonth() + 1; // getMonth方法从 Date 对象返回月份 (0 ~ 11)，返回结果需要手动加一
      var d = time.getDate(); // getDate方法从 Date 对象返回一个月中的某一天 (1 ~ 31)
      var h = time.getHours(); // getHours方法返回 Date 对象的小时 (0 ~ 23)
      var m = time.getMinutes(); // getMinutes方法返回 Date 对象的分钟 (0 ~ 59)
      var s = time.getSeconds(); // getSeconds方法返回 Date 对象的秒数 (0 ~ 59)
      if (n == "1") {
        return y + "-" + M + "-" + d + " " + h + ":" + m;
      } else {
        return  M + "-" + d + " " + h + ":" + m;
      }
    },
    getAll() {
      this.$http
        .post(
          "/index.php/home/Dingdan/geralldd",
          this.$qs.stringify({
            p: this.current_page,
            pagesize: this.pagesize
          })
        )
        .then(result => {
          let re = result.data;
          if (re.result) {
            this.ysdata = re.lists;
            this.count = parseInt(re.count);
          }
        })
        .catch(() => {
          this.$message.error("网络错误");
          return;
        });
    },
    //更改页码
    changgeyema(val) {
      this.current_page = val;
    },
    
    getqujianyuan(val) {
      this.$http
        .post(
          "/index.php/home/Dingdan/ddpsxx",
          this.$qs.stringify({
            id: val['id']
          })
        )
        .then(response => {
          this.xiangxixx = val;
          let re = response.data;
          let ps = re.lists;
          for (let i = 0; i < ps.length; i++) {
            if (ps[i]["type"] == "qujian") {
              this.xiangxixx["qujian"] = ps[i]["use"];
            }
            if (ps[i]["type"] == "wancheng") {
              this.xiangxixx["wancheng"] = ps[i]["use"];
            }
          }
        })
        .catch(() => {
          return;
        });
    },
    
    dele(val) {
      let id = val["id"];
      this.$confirm("此操作将永久删除该订单, 是否继续?", "提示", {
        confirmButtonText: "确定",
        cancelButtonText: "取消",
        type: "warning"
      })
        .then(() => {
          this.$http
            .post(
              "/index.php/home/Dingdan/dele_dd",
              this.$qs.stringify({
                id: val["id"]
              })
            )
            .then(response => {
              let res = response.data;
              if (res.result) {
                this.$notify({
                  title: "成功",
                  message: "已删除",
                  type: "success"
                });
                this.getAll();
              } else {
                this.$notify.error({
                  title: "警告",
                  message: "操作失败"
                });
              }
            })
            .catch(() => {
              this.$notify.error({
                title: "警告",
                message: "网络错误"
              });
            });
        })
        .catch(() => {
          return;
        });
    },
  }
};
</script>
<style lang="scss"  scoped>
.info_page {
  text-align: center;
  padding-top: 20px;
}

.content_ {
    padding: 20px;
  span {
    font-size: 14px;
    color: #797777;
  }
}

.qudiao {
  color: #797777;
}
</style>