<template>
  <div>
    <el-dialog title="短信提醒限制" class="dx" :visible.sync="centerDialogVisible" width="500px" center>
      <div class="txbox">
        <p>1条/分钟: 一分钟内最多接收1条</p>
        <p>5条/小时：一个小时不会超过5条</p>
        <p>50条/日：一天不会超过50条</p>
      </div>
    </el-dialog>

    <div class="page_name">订单接收设置</div>
    <div class="page_msg">注：你可以任选接收方式，至少得选一个</div>
    <div class="tait">
      <div>
        短信提醒
        <span @click="centerDialogVisible = true">(慎用，点击查看限制)</span>
      </div>

      <span
        v-if="jieshou == 'true'"
        style="color:#67C23A;margin-left:20px; text-decoration: underline"
      >启用中...</span>
      <span v-else style="color:#909399;margin-left:20px;text-decoration: underline">已停用</span>

      <el-button
        type="primary"
        icon="el-icon-setting"
        size="mini"
        @click="changePhoneTZ()"
      >{{phoneTZmsg}}</el-button>
    </div>
    <div class="phone">
      <el-table :data="tableData" style="width: 100%" :show-header="false">
        <el-table-column label="日期">
          <template slot-scope="scope">{{ scope.row.phone }}</template>
        </el-table-column>
        <el-table-column label="操作">
          <template slot-scope="scope">
            <el-button
              type="text"
              class="qudiao"
              icon="el-icon-edit"
              @click="changePhone(scope.$index, scope.row)"
              size="small"
            >编辑</el-button>
          </template>
        </el-table-column>
      </el-table>
    </div>
    <div class="tait">
      <div>
        邮件提醒
        <span>(接收条数无限制，可设置2个，建议使用163邮箱，并且把加入白名单，防止遗漏提醒)</span>
      </div>

      <span
        v-if="emaintz == 'true'"
        style="color:#67C23A;margin-left:20px; text-decoration: underline"
      >启用中...</span>
      <span v-else style="color:#909399;margin-left:20px;text-decoration: underline">已停用</span>

      <el-button
        type="primary"
        icon="el-icon-setting"
        size="mini"
        @click="changeemailTZ()"
      >{{emaintzTZmsg}}</el-button>

      <span v-show="tableData2.length < 2">
        <el-button type="primary" icon="el-icon-plus" size="mini" @click="addemail()" style="margin-right:10px"></el-button>
      </span>
    </div>
    <div class="phone">
      <el-table :data="tableData2" style="width: 100%" :show-header="false">
        <el-table-column label="日期">
          <template slot-scope="scope">{{ scope.row.email }}</template>
        </el-table-column>
        <el-table-column label="操作">
          <template slot-scope="scope">
            <el-button
              type="text"
              class="qudiao"
              icon="el-icon-delete"
              @click="deleteemail(scope.row.id)"
              size="small"
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
      tableData: [],
      tableData2: [],
      jieshou: "",
      phoneTZmsg: "",
      emaintz: "",
      emaintzTZmsg: "",
      centerDialogVisible: false
    };
  },
  created() {
    this.findphone();
    this.findman();
    this.findemai();
  },
  watch: {
    jieshou() {
      if (this.jieshou == "true") {
        this.phoneTZmsg = "关闭";
      } else {
        this.phoneTZmsg = "开启";
      }
    },
    emaintz() {
      if (this.emaintz == "true") {
        this.emaintzTZmsg = "关闭";
      } else {
        this.emaintzTZmsg = "开启";
      }
    }
  },
  methods: {
    //查询手机号
    findphone() {
      this.$http
        .post("/index.php/home/Run/findphone", {})
        .then(response => {
          let res = response.data;
          if (res.result) {
            this.tableData = [
              {
                phone: res.content.phone
              }
            ];
            this.jieshou = res.content.jieshou;
          } else {
            this.$notify.error({
              title: "警告",
              message: "数据获取失败"
            });
          }
        })
        .catch(() => {});
    },
    //更改手机号
    changePhone() {
      this.$prompt("请输入手机号", "提示", {
        confirmButtonText: "确定",
        cancelButtonText: "取消",
        inputPattern: /^1[3456789]\d{9}$/,
        inputErrorMessage: "手机格式不正确"
      })
        .then(({ value }) => {
          this.$http
            .post(
              "/index.php/home/Run/setphone",
              this.$qs.stringify({
                phone: value
              })
            )
            .then(response => {
              let res = response.data;
              if (res.result) {
                this.$notify({
                  title: "成功",
                  message: "设置成功",
                  type: "success"
                });
                this.tableData[0].phone = res.content;
              } else {
                this.$notify.error({
                  title: "警告",
                  message: res.msg
                });
              }
            })
            .catch(() => {});
        })
        .catch(() => {
          return;
        });
    },
    //切换手机通知
    changePhoneTZ() {
      let jieshou;
      if (this.jieshou == "true") {
        jieshou = "false";
      } else {
        jieshou = "true";
      }
      this.$http
        .post(
          "/index.php/home/Run/setphone",
          this.$qs.stringify({
            jieshou
          })
        )
        .then(response => {
          let res = response.data;
          if (res.result) {
            this.$notify({
              title: "成功",
              message: "设置成功",
              type: "success"
            });
            this.jieshou = res.content;
          } else {
            this.$notify.error({
              title: "警告",
              message: res.msg
            });
          }
        })
        .catch(() => {});
    },
    //查询跑男
    findman() {
      this.$http
        .post("/index.php/home/Run/fin", {})
        .then(response => {
          let res = response.data;
          if (res.result) {
            this.emaintz = res.content.youxiangtongzhi;
          } else {
            this.$notify.error({
              title: "警告",
              message: "数据获取失败"
            });
          }
        })
        .catch(() => {});
    },
    //更改邮箱通知
    changeemailTZ() {
      let youxiangtongzhi;
      if (this.emaintz == "true") {
        youxiangtongzhi = "false";
      } else {
        youxiangtongzhi = "true";
      }
      this.$http
        .post(
          "/index.php/home/Run/set",
          this.$qs.stringify({
            youxiangtongzhi
          })
        )
        .then(response => {
          let res = response.data;
          if (res.result) {
            this.$notify({
              title: "成功",
              message: "设置成功",
              type: "success"
            });
            this.emaintz = youxiangtongzhi;
          } else {
            this.$notify.error({
              title: "警告",
              message: res.msg
            });
          }
        })
        .catch(() => {});
    },
    //添加邮箱
    addemail() {
      this.$prompt("请输入邮箱", "提示", {
        confirmButtonText: "确定",
        cancelButtonText: "取消",
        inputPattern: /[\w!#$%&'*+/=?^_`{|}~-]+(?:\.[\w!#$%&'*+/=?^_`{|}~-]+)*@(?:[\w](?:[\w-]*[\w])?\.)+[\w](?:[\w-]*[\w])?/,
        inputErrorMessage: "邮箱格式不正确"
      })
        .then(({ value }) => {
          this.$http
            .post(
              "/index.php/home/Run/addemail",
              this.$qs.stringify({
                email: value
              })
            )
            .then(response => {
              let res = response.data;
              if (res.result) {
                this.$notify({
                  title: "成功",
                  message: "设置成功",
                  type: "success"
                });
                this.findemai();
              } else {
                this.$notify.error({
                  title: "警告",
                  message: res.msg
                });
              }
            })
            .catch(() => {});
        })
        .catch(() => {
          return;
        });
    },
    //查询邮箱
    findemai() {
      this.$http
        .post("/index.php/home/Run/findemail", {})
        .then(response => {
          let res = response.data;
          if (res.result) {
            this.tableData2 = res.lists;
          } else {
            this.tableData2 = [];
          }
        })
        .catch(() => {});
    },
    //删除邮箱
    deleteemail(val) {
      this.$http
        .post(
          "/index.php/home/Run/delemail",
          this.$qs.stringify({
            id: val
          })
        )
        .then(response => {
          let res = response.data;
          if (res.result) {
            this.$notify({
              title: "成功",
              message: "设置成功",
              type: "success"
            });
            this.findemai();
          } else {
            this.$notify.error({
              title: "警告",
              message: res.msg
            });
          }
        })
        .catch(() => {});
    }
  }
};
</script>
<style lang="scss" scoped>
.tait {
  font-size: 16px;
  margin-top: 30px;
  padding-bottom: 10px;
  span {
    color: #606266;
    font-size: 12px;
    cursor: pointer;
  }
  button {
    float: right;
  }
  div {
    float: left;
  }
}
.delebtn {
  float: right;
}
.addbtn {
  margin-left: 10px;
  float: left !important;
  span {
    color: white;
  }
}
.el-icon-delete,
.el-icon-edit,
.qudiao {
  float: right;
  margin-right: 20px;
  cursor: pointer;
}
.dx {
  .txbox {
    padding: 20px;
    padding-bottom: 50px;
    p {
      line-height: 3;
    }
  }
}
</style>