<template>
  <div>
    <div class="page_name">今日订单</div>
    <div class="search">
      <div style="margin-top: 15px;">
        <el-input placeholder="输入订单编号..." v-model="searchval">
          <el-button slot="append" icon="el-icon-search"></el-button>
        </el-input>
      </div>
    </div>
    <div class>
      <el-table :data="showdata" stripe height="600" style="width: 100%">
        <el-table-column prop="out_trade_no" label="订单编号" width="200"></el-table-column>
        <el-table-column prop="shouhuoren" label="收件人" width="140"></el-table-column>
        <el-table-column prop="lianxidianhua" label="电话" width="180"></el-table-column>
        <el-table-column prop="shouhuodizhi" label="地址" width="270"></el-table-column>
        <el-table-column prop="createtime" label="下单时间" sortable width="120"></el-table-column>
        <el-table-column prop="paisongtime" label="取件时间" sortable width="120"></el-table-column>
        <el-table-column prop="wanchengtime" label="完成时间" sortable width="160"></el-table-column>
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
  </div>
</template>
<script>
export default {
  data() {
    return {
      searchval: "",
      tableData: [],
      ysdata: [],
      showdata: []
    };
  },
  created() {
    this.getdd();
  },
  watch: {
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
    searchval() {
      let searchval = this.searchval;
      if (/\S/.test(searchval)) {
        this.showdata = [];
        let Index = this.tableData.findIndex(function(val) {
          let ddbh = val["out_trade_no"];

          if (ddbh == searchval) {
            return true;
          }
        });
        let oldda = this.tableData;
        if (Index != 0) {
          this.showdata.push(oldda[Index]);
        }
      } else {
        this.showdata = this.tableData;
      }
    }
  },
  methods: {
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
        return h + ":" + M;
      }
    },
    handleDelete(val) {
      console.log(val);
    },
    getdd() {
      this.$http
        .post("/index.php/home/Dingdan/today_dd", this.$qs.stringify({}))
        .then(response => {
          let res = response.data;
          if (res.result) {
            this.ysdata = res.lists;
          } else {
            return;
          }
        })
        .catch(() => {
          this.$notify.error({
            title: "警告",
            message: "网络错误"
          });
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
                id: val['id']
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
                this.getdd();
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
    }
  }
};
</script>
<style lang="scss" scoped>
.search {
  float: right;
  width: 400px;
  margin: 10px 20px;
}
.qudiao {
  color: #797777;
}
</style>